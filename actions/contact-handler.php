<?php
/**
 * Quote form handler — POSTed to directly, not routed.
 *
 * CSRF + honeypot + a 30-second resubmission cooldown, the same four rules
 * the browser checks, allowlisted city/service values (unknown values are
 * dropped, never echoed), header-injection-safe subject and body, and
 * mail() with the envelope sender set so SPF aligns. Errors flash back to
 * the exact field through the session.
 */

declare(strict_types=1);

if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(__DIR__));
}

require_once ROOT_DIR . '/config/site.php';
require_once ROOT_DIR . '/core/helpers.php';
require_once ROOT_DIR . '/core/csrf.php';

if (SITE_ENV === 'production') {
    ini_set('display_errors', '0');
}

/** Back to the page the form was on (a known route only), else contact. */
function form_return_path(): string
{
    $source = (string) ($_POST['source'] ?? '');
    return preg_match('#^/[a-z0-9\-]*(\.php|\.html)?$#', $source) ? $source : '/contact-us.php';
}

function redirect_back(string $query = ''): void
{
    // Relative on purpose: the same code then works on the dev server too.
    header('Location: ' . form_return_path() . $query . '#quote', true, 303);
    exit;
}

function reject(array $errors, array $old): void
{
    $_SESSION['contact_errors'] = $errors;
    $_SESSION['contact_old'] = $old;
    redirect_back();
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: /contact-us.php', true, 303);
    exit;
}

session_begin();

// Honeypot filled: report success, send nothing — the bot learns nothing.
if (!empty($_POST['website'])) {
    redirect_back('?sent=1');
}

$services  = config_get('services');
$locations = config_get('locations');

$submitted = [
    'name'     => trim((string) ($_POST['name'] ?? '')),
    'phone'    => trim((string) ($_POST['phone'] ?? '')),
    'city'     => trim((string) ($_POST['city'] ?? '')),
    'services' => array_values(array_filter(
        is_array($_POST['services'] ?? null) ? $_POST['services'] : [],
        static fn($slug): bool => is_string($slug) && isset($services[$slug])
    )),
    'consent'  => !empty($_POST['consent']),
];
if ($submitted['city'] !== 'elsewhere' && !isset($locations[$submitted['city']])) {
    $submitted['city'] = '';
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    reject(['form' => 'Your session expired, so nothing was sent.'], $submitted);
}

if (!empty($_SESSION['contact_last_submitted']) && time() - (int) $_SESSION['contact_last_submitted'] < 30) {
    reject(['form' => 'That looks like a duplicate — please wait a moment before sending again.'], $submitted);
}

/* ── validation: the same four rules as assets/js/site.js ─────────── */
$errors = [];
if ($submitted['name'] === '' || str_length($submitted['name']) > 100) {
    $errors['name'] = 'Enter your name.';
}
$digits = preg_replace('/\D/', '', $submitted['phone']) ?? '';
if (strlen($digits) === 12 && strpos($digits, '91') === 0) {
    $digits = substr($digits, 2);
} elseif (strlen($digits) === 11 && $digits[0] === '0') {
    $digits = substr($digits, 1);
}
if (!preg_match('/^[6-9]\d{9}$/', $digits)) {
    $errors['phone'] = 'Enter a 10-digit mobile number.';
}
if ($submitted['city'] === '') {
    $errors['city'] = 'Choose your city.';
}
if (!$submitted['services']) {
    $errors['services'] = 'Pick at least one.';
}
if ($errors) {
    reject($errors, $submitted);
}

/* ── delivery ────────────────────────────────────────────────────── */
$business  = config_get('business');
$recipient = (string) ($business['contact_recipient_email'] ?? '');
if ($recipient === '') {
    error_log('Quote form: contact_recipient_email is empty; submission not sent.');
    redirect_back('?error=config');
}

// A line break inside a value could forge a header (a Bcc:) or a fake body
// field. trim() only strips the ends, so replace breaks everywhere.
$clean = static fn(string $v): string => trim(str_replace(["\r", "\n"], ' ', $v));

$cityLabel = $submitted['city'] === 'elsewhere' ? 'Elsewhere in AP or Telangana' : city_display_name($locations[$submitted['city']]) . ', ' . location_state($locations[$submitted['city']])['name'];
$wants     = implode(', ', array_map(static fn(string $s): string => $services[$s]['nav_label'], $submitted['services']));

$subject = 'Quote request — ' . $clean($submitted['name']) . ' (' . $cityLabel . ')';
$body = implode("\n", [
    'Name:     ' . $clean($submitted['name']),
    'Mobile:   +91 ' . $digits,
    'City:     ' . $cityLabel,
    'Needs:    ' . $wants,
    'Consent:  ' . ($submitted['consent'] ? 'Yes — may call or WhatsApp' : 'NOT GIVEN — do not call or WhatsApp'),
    'WhatsApp: https://wa.me/91' . $digits,
    '',
    '---',
    'Sent from ' . base_url(form_return_path()) . ' at ' . date('Y-m-d H:i:s T'),
]);

$fromHost = (string) (parse_url(BASE_URL, PHP_URL_HOST) ?: 'localhost');
$mailFrom = $clean((string) ($business['mail_from'] ?? '')) ?: 'no-reply@' . $fromHost;
$headers  = [
    'From: ' . $clean(SITE_NAME) . ' website <' . $mailFrom . '>',
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
];

if (PHP_SAPI !== 'cli-server') {
    $sent = @mail($recipient, $subject, $body, implode("\r\n", $headers), '-f' . $mailFrom);
    if (!$sent) {
        $last = error_get_last();
        error_log('Quote form: mail() failed — ' . ($last['message'] ?? 'no error detail'));
    }
} else {
    // Development (php -S has no mail transport): write the message to the
    // system temp directory — never under the web root, it holds a
    // customer's name and number. Keyed on the SAPI, not a config flag, so
    // live mail can never be diverted by a stale setting.
    $dump = rtrim(sys_get_temp_dir(), '/\\') . DIRECTORY_SEPARATOR . 'quote-' . date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.txt';
    $sent = file_put_contents($dump, implode("\r\n", array_merge(['To: ' . $recipient, 'Subject: ' . $subject], $headers, ['', $body]))) !== false;
    error_log('Quote form (development): ' . ($sent ? 'written to ' . $dump : 'could not write ' . $dump));
}

$_SESSION['contact_last_submitted'] = time();
redirect_back($sent ? '?sent=1' : '?error=send');
