<?php
/**
 * Front controller. Every request that is not a real file is rewritten here
 * by .htaccess, and every page — the .php pages and the .html service × city
 * pages alike — is rendered by PHP from the route table in core/router.php.
 */

declare(strict_types=1);

// Buffered so a form deep in the page can still lazily start the session
// (csrf_token()) and send its cookie after markup has been produced. The
// callback drops the template indentation (about 15 % of a page's bytes):
// the site has no <pre> or <textarea> whose whitespace would matter, and
// inline scripts only lose leading spaces on each line.
ob_start(static fn(string $html): string => (string) preg_replace('/\n[ \t]+/', "\n", $html));

define('ROOT_DIR', __DIR__);

// PHP's built-in dev server calls this script for every request, real files
// included. Serve real static files directly — except the internal folders,
// which must stay denied, and /index.php, which the router 301s to "/".
if (PHP_SAPI === 'cli-server') {
    $devPath = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
    $internal = (bool) preg_match('#^/(config|core|data|partials|templates|tools|source-images)(/|$)#i', $devPath);
    if (!$internal && $devPath !== '/' && strcasecmp($devPath, '/index.php') !== 0 && is_file(ROOT_DIR . $devPath)) {
        return false;
    }
}

require ROOT_DIR . '/config/site.php';

if (SITE_ENV === 'production') {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
} else {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
}
error_reporting(E_ALL);

require ROOT_DIR . '/core/helpers.php';
require ROOT_DIR . '/core/images.php';
require ROOT_DIR . '/core/seo.php';
require ROOT_DIR . '/core/csrf.php';
require ROOT_DIR . '/core/icons.php';
require ROOT_DIR . '/core/router.php';

dispatch();
