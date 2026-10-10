<?php
/**
 * Site-wide constants. Business facts live in config/business.php; this file
 * holds only what the code itself needs to know about where it runs.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

// The live domain, https, no www, no trailing slash. Canonicals, the sitemap
// and every og:url are built from this — it must match the domain exactly.
define('BASE_URL', 'https://mohikaenterprises.in');

define('SITE_NAME', 'Mohika Invisible Grills & Safety Nets');
define('SITE_SHORT_NAME', 'Mohika');

// 'production' hides PHP errors from visitors and logs them instead.
define('SITE_ENV', 'production');

// Google Tag Manager container. Empty = no tag is rendered at all.
// Not supplied by the client yet.
define('ANALYTICS_GTM_ID', '');

// Fallback sharing card for pages that do not set their own: a 1200×630 JPEG
// crop of a service hero photo. JPEG, not WebP — WhatsApp will not render a
// WebP og:image, and WhatsApp is where most links to this site get shared.
define('DEFAULT_OG_IMAGE', '/assets/images/og/og-invisible-grills.jpg');

// Google Ads landing pages, path => service slug. Deliberately empty and kept
// outside config/routes.php: a page listed in routes.php is a page in the
// sitemap, and an ads page must never be. See README → "Ads landing pages".
define('ADS_LANDING_PAGES', []);

/**
 * Absolute URL for a site-relative path.
 */
function base_url(string $path = '/'): string
{
    if ($path === '' || $path[0] !== '/') {
        $path = '/' . $path;
    }
    return rtrim(BASE_URL, '/') . $path;
}
