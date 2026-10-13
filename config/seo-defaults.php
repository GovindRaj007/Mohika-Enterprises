<?php
/**
 * Fallbacks for anything a page's $seo array does not set.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    'title_suffix'        => ' | Mohika',
    'default_description' => 'Invisible grills, invisible grill dealers, balcony safety nets, cricket nets and cloth hangers across Andhra Pradesh & Telangana — Hyderabad, Vizag & more.',
    'og_type'             => 'website',
    'og_image'            => DEFAULT_OG_IMAGE,
    'og_image_width'      => '1200',
    'og_image_height'     => '630',
    'og_image_alt'        => 'A woman at her balcony with a glass railing, checking the invisible grill cables fitted above it',
    // Lets Google show a large image beside results (Search, Discover) and
    // full-length snippets — the opt-in that makes a page's image appear.
    'robots'              => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
    'twitter_card'        => 'summary_large_image',
    'locale'              => 'en_IN',
];
