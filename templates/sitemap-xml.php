<?php
/**
 * /sitemap.xml — generated from the same route table the router uses, so
 * it cannot list a page that does not exist or miss one that does. Ads
 * landing pages are excluded.
 *
 * lastmod is the mtime of the config file(s) holding that page's copy (not
 * the template, which changes for layout reasons). A git deploy resets
 * mtimes to checkout time; Google ignores an unreliable lastmod rather than
 * penalising it.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$lastmod = static function (array $files): string {
    $latest = 0;
    foreach ($files as $file) {
        $full = ROOT_DIR . '/' . $file;
        if (is_file($full)) {
            $latest = max($latest, (int) filemtime($full));
        }
    }
    return gmdate('Y-m-d', min($latest ?: time(), time()));
};

$sources = [
    'home'             => ['config/pages.php', 'config/services.php', 'config/locations.php'],
    'page'             => ['config/pages.php'],
    'service'          => ['config/services.php'],
    'service-location' => ['config/services.php', 'config/locations.php'],
    'city'             => ['config/locations.php'],
    'post'             => ['config/posts.php'],
    'video'            => ['data/service-videos.php'],
];
$priority = ['home' => '1.0', 'service' => '0.9', 'service-location' => '0.8', 'city' => '0.8', 'page' => '0.6', 'post' => '0.6', 'video' => '0.5'];
$freq     = ['home' => 'weekly', 'service' => 'monthly', 'service-location' => 'monthly', 'city' => 'monthly', 'page' => 'monthly', 'post' => 'yearly', 'video' => 'yearly'];
$videosBySlug = all_videos();

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n";
foreach (all_public_routes() as $routePath => $kind) {
    $files = $sources[$kind] ?? ['config/pages.php'];
    if ($kind === 'service-location') {
        $files[] = 'config/service-locations/' . explode('-in-', ltrim($routePath, '/'))[0] . '.php';
    }
    if ($routePath === '/service-areas.php') {
        $files[] = 'config/locations.php';
    }
    echo "  <url>\n";
    echo '    <loc>' . e(base_url($routePath)) . "</loc>\n";
    echo '    <lastmod>' . $lastmod($files) . "</lastmod>\n";
    echo '    <changefreq>' . ($freq[$kind] ?? 'monthly') . "</changefreq>\n";
    echo '    <priority>' . ($priority[$kind] ?? '0.6') . "</priority>\n";
    // Video watch pages: Google's video extension, with exactly the URLs
    // the page's <video> tag and VideoObject use.
    if ($kind === 'video') {
        $sv = $videosBySlug[basename($routePath, '.php')];
        echo "    <video:video>\n";
        echo '      <video:thumbnail_loc>' . e(base_url(video_poster($sv))) . "</video:thumbnail_loc>\n";
        echo '      <video:title>' . e($sv['title']) . "</video:title>\n";
        echo '      <video:description>' . e($sv['description']) . "</video:description>\n";
        echo '      <video:content_loc>' . e(base_url(video_src($sv))) . "</video:content_loc>\n";
        echo '      <video:duration>' . video_seconds($sv['duration']) . "</video:duration>\n";
        echo '      <video:publication_date>' . e($sv['date']) . "</video:publication_date>\n";
        echo "      <video:family_friendly>yes</video:family_friendly>\n";
        echo "    </video:video>\n";
    }
    echo "  </url>\n";
}
echo "</urlset>\n";
