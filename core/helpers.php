<?php
/**
 * Shared helpers: escaping, config access, rendering, URL building and the
 * getters every template uses. Nothing here knows any business fact — those
 * all come from config/.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

/* ── output ──────────────────────────────────────────────────────────── */

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Escapes text but keeps the <strong> and <em> tags authored in config copy.
 * Config is ours, not user input, but the escape-then-restore keeps anything
 * else in it inert.
 */
function rich(?string $value): string
{
    $escaped = e($value);
    return (string) preg_replace('#&lt;(/?)(strong|em)&gt;#', '<$1$2>', $escaped);
}

/* ── config, data, partials ──────────────────────────────────────────── */

function config_get(string $name): array
{
    static $cache = [];
    if (!isset($cache[$name])) {
        $path = ROOT_DIR . '/config/' . $name . '.php';
        $cache[$name] = is_file($path) ? require $path : [];
    }
    return $cache[$name];
}

/**
 * Requires a data file inside a function so its loop variables cannot leak
 * into, and overwrite, the calling template's locals.
 */
function load_data(string $name): array
{
    static $cache = [];
    if (!isset($cache[$name])) {
        $cache[$name] = require ROOT_DIR . '/data/' . $name . '.php';
    }
    return $cache[$name];
}

function render_partial(string $name, array $vars = []): void
{
    extract($vars, EXTR_SKIP);
    require ROOT_DIR . '/partials/' . $name . '.php';
}

/**
 * Cache-busted asset URL: /assets/css/base.css?v={mtime}.
 */
function asset(string $path): string
{
    $path = '/' . ltrim($path, '/');
    $full = ROOT_DIR . $path;
    return is_file($full) ? $path . '?v=' . filemtime($full) : $path;
}

/* ── strings (no mbstring dependency) ────────────────────────────────── */

function str_lower(string $value): string
{
    return function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
}

function str_length(string $value): int
{
    if (function_exists('mb_strlen')) {
        return mb_strlen($value, 'UTF-8');
    }
    if (function_exists('iconv_strlen')) {
        $length = @iconv_strlen($value, 'UTF-8');
        if ($length !== false) {
            return $length;
        }
    }
    return strlen($value);
}

/**
 * "A, B and C".
 */
function join_names(array $names, string $conjunction = 'and'): string
{
    $names = array_values($names);
    $count = count($names);
    if ($count === 0) {
        return '';
    }
    if ($count === 1) {
        return (string) $names[0];
    }
    $last = array_pop($names);
    return implode(', ', $names) . ' ' . $conjunction . ' ' . $last;
}

/**
 * The first candidate that fits $max characters — titles and descriptions
 * are written as a list from richest to plainest.
 */
function first_fitting(array $candidates, int $max): string
{
    foreach ($candidates as $candidate) {
        if ($candidate !== '' && str_length($candidate) <= $max) {
            return $candidate;
        }
    }
    return (string) end($candidates);
}

/* ── business ────────────────────────────────────────────────────────── */

function business(): array
{
    return config_get('business');
}

function tel_href(?string $e164 = null): string
{
    return 'tel:' . ($e164 ?? business()['phone_e164']);
}

/**
 * wa.me deep link, prefilled so the message arrives half-written and the
 * business knows what it is about before replying.
 */
function whatsapp_url(string $about = ''): string
{
    $b = business();
    $digits = preg_replace('/[^0-9]/', '', $b['whatsapp_e164'] ?? $b['phone_e164']);
    $message = $b['whatsapp_message_prefix'] . ($about !== '' ? $about : 'invisible grills / safety nets') . '.';
    return 'https://wa.me/' . $digits . '?text=' . rawurlencode($message);
}

/**
 * "7+ years", or '' when the figure was not supplied.
 */
function years_label(): string
{
    $years = business()['years_experience'] ?? null;
    return $years ? $years . '+ years' : '';
}

/* ── URLs ────────────────────────────────────────────────────────────── */

function service_url(string $slug): string
{
    return '/' . $slug . '.php';
}

function service_location_url(string $serviceSlug, string $citySlug): string
{
    return '/' . $serviceSlug . '-in-' . $citySlug . '.html';
}

function city_url(string $citySlug): string
{
    return '/invisible-grills-and-safety-nets-in-' . $citySlug . '.html';
}

function post_url(string $slug): string
{
    return '/' . $slug . '.php';
}

/**
 * The quote form, with services optionally pre-selected.
 */
function quote_url(string $serviceSlug = '', string $citySlug = ''): string
{
    $params = array_filter(['service' => $serviceSlug, 'city' => $citySlug]);
    return '/contact-us.php' . ($params ? '?' . http_build_query($params) : '') . '#quote';
}

/* ── services ────────────────────────────────────────────────────────── */

/**
 * Every service keyed by slug, in config order — the order of the nav, the
 * home page, the footer and the sitemap.
 */
function get_all_services(): array
{
    return config_get('services');
}

function get_service(string $slug): ?array
{
    return config_get('services')[$slug] ?? null;
}

/* ── locations ───────────────────────────────────────────────────────── */

function get_all_locations(): array
{
    return config_get('locations');
}

function get_location(string $slug): ?array
{
    return config_get('locations')[$slug] ?? null;
}

/**
 * Authored copy for one service in one city, or null — and null means the
 * page does not exist.
 */
function get_service_location(string $serviceSlug, string $citySlug): ?array
{
    static $matrix = null;
    if ($matrix === null) {
        $matrix = config_get('service-locations');
    }
    return $matrix[$serviceSlug][$citySlug] ?? null;
}

/**
 * Cities that have an authored page for this service.
 */
function cities_for_service(string $serviceSlug): array
{
    return array_filter(get_all_locations(), static fn(array $l): bool => get_service_location($serviceSlug, $l['slug']) !== null);
}

/**
 * Services that have an authored page in this city.
 */
function services_in_city(string $citySlug): array
{
    return array_filter(get_all_services(), static fn(array $s): bool => get_service_location($s['slug'], $citySlug) !== null);
}

/**
 * "Visakhapatnam (Vizag)" where a city has a popular short name.
 */
function city_display_name(array $location): string
{
    return !empty($location['nickname']) ? $location['name'] . ' (' . $location['nickname'] . ')' : $location['name'];
}

function location_names_sentence(string $conjunction = 'and', bool $short = false): string
{
    $names = array_map(static fn(array $l): string => $short && !empty($l['nickname']) ? $l['nickname'] : $l['name'], get_all_locations());
    return join_names($names, $conjunction);
}

/* ── blog ────────────────────────────────────────────────────────────── */

function get_all_posts(): array
{
    return config_get('posts');
}

function get_post(string $slug): ?array
{
    return get_all_posts()[$slug] ?? null;
}

/* ── shared content ──────────────────────────────────────────────────── */

/**
 * The company FAQ answer about coverage, worded from config so it never
 * names a city that is not served.
 */
function coverage_answer(): string
{
    return SITE_SHORT_NAME . ' has local team members in ' . location_names_sentence() . ', covering the localities around each city. '
        . 'Your local team comes to you for the ' . str_lower(business()['offer']) . ', so call or WhatsApp with your area and we will fix a time.';
}
