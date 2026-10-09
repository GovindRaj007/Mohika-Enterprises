<?php
/**
 * Per-service, per-city copy: [service-slug][city-slug] => block.
 *
 * This is what makes each /{service}-in-{city}.html page its own page rather
 * than the service page with a city name swapped in. A pair with no block
 * here has no page — the router returns 404 — so an unwritten combination
 * can never ship as a thin duplicate.
 *
 * Block shape (all fields required):
 *   'hook'      short phrase for the title, e.g. 'Sea-Air Safe SS 316'
 *   'meta'      unique meta description, ≤ 155 characters
 *   'intro'     opening paragraph, starts with the target phrase
 *   'local'     why the job is different in this city
 *   'fit'       where and on what buildings we fit it here
 *   'material'  the material choice this city's conditions call for
 *   'faqs'      two questions people in this city actually ask
 *
 * One file per service in config/service-locations/, to keep each readable.
 * tools/check-site.php measures every resulting page's share of text that
 * appears nowhere else on the site, and fails below 40 %.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$matrix = [];
foreach (array_keys(config_get('services')) as $serviceSlug) {
    $file = __DIR__ . '/service-locations/' . $serviceSlug . '.php';
    if (is_file($file)) {
        $matrix[$serviceSlug] = require $file;
    }
}
return $matrix;
