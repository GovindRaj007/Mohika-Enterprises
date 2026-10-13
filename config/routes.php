<?php
/**
 * Static pages and redirects. Everything else — service pages, service ×
 * city pages, city hubs, blog posts — is derived from config by
 * route_table() in core/router.php, so adding a service, a city or a post
 * never touches this file.
 *
 * URL scheme:
 *   /                                              home
 *   /{page}.php                                    static pages below
 *   /{service}.php                                 service pages
 *   /{service}-in-{city}.html                      service × city pages
 *   /invisible-grills-and-safety-nets-in-{city}.html   city hubs
 *   /{post}.php                                    blog posts
 *   /{video-slug}.php                              video watch pages
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    'pages' => [
        '/'                  => 'home',
        '/services.php'      => 'services',
        '/service-areas.php' => 'service-areas',
        '/gallery.php'       => 'gallery',
        '/about-us.php'      => 'about',
        '/blog.php'          => 'blog',
        '/contact-us.php'    => 'contact',
        '/videos.php'        => 'videos',
        '/sitemap.php'       => 'sitemap',
    ],

    // Fixed redirects. Alias spellings of cities ("vizag",
    // "rajamahendravaram") are added automatically from config/locations.php,
    // and "/x" or "/x/" resolve to "/x.php" or "/x.html" when that page exists.
    'redirects' => [
        '/index.php'  => '/',
        '/index.html' => '/',
        '/home.php'   => '/',
        '/about.php'  => '/about-us.php',
        '/contact.php' => '/contact-us.php',
        // Pigeon nets was retired in October 2026; its guide goes to the
        // balcony safety nets page, which also keeps pigeons out.
        '/how-to-stop-pigeons-on-balcony.php' => '/balcony-safety-nets.php',
    ],

    // Retired service slug => the service its pages now 301 to (core/router.php).
    'retired' => [
        'pigeon-nets' => 'balcony-safety-nets',
    ],
];
