<?php
/**
 * /robots.txt — denies the internal folders and names the sitemap. Never
 * Disallow a page that should be de-indexed: a blocked page cannot be
 * fetched, so its noindex is never read.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

echo "User-agent: *\n";
echo "Allow: /\n";
foreach (['/config/', '/core/', '/data/', '/partials/', '/templates/', '/tools/', '/source-images/', '/actions/'] as $dir) {
    echo 'Disallow: ' . $dir . "\n";
}
echo "\nSitemap: " . base_url('/sitemap.xml') . "\n";
