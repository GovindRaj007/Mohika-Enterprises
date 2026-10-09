<?php
/**
 * WebSite schema — home page only.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

json_ld([
    '@context'  => 'https://schema.org',
    '@type'     => 'WebSite',
    '@id'       => base_url('/#website'),
    'name'      => SITE_NAME,
    'url'       => base_url('/'),
    'inLanguage'=> 'en-IN',
    'publisher' => ['@id' => base_url('/#business')],
]);
