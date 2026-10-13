<?php
/**
 * Sitewide HomeAndConstructionBusiness (a LocalBusiness subtype).
 *
 * Gated field by field on config: no address or geo until the client
 * supplies them (it is published as a service-area business meanwhile —
 * telephone + areaServed), no rating, no opening hours, no price range.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$sb = business();

$schema = [
    '@context'    => 'https://schema.org',
    '@type'       => 'HomeAndConstructionBusiness',
    '@id'         => base_url('/#business'),
    'name'        => $sb['name'],
    'alternateName' => $sb['short_name'],
    'url'         => base_url('/'),
    'logo'        => base_url('/assets/images/brand/icon-512.png'),
    'image'       => base_url(DEFAULT_OG_IMAGE),
    'description' => config_get('seo-defaults')['default_description'],
    'telephone'   => $sb['phone_e164'],
    'email'       => $sb['email'],
    // Both states, then every city and area nested inside its own state.
    'areaServed'  => array_merge(states_schema(), array_values(array_map('location_place_schema', get_all_locations()))),
    'knowsAbout'  => array_values(array_map(static fn(array $s): string => $s['nav_label'], get_all_services())),
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name'  => 'Balcony safety and netting services',
        'itemListElement' => array_values(array_map(static fn(array $s): array => [
            '@type' => 'Offer',
            'itemOffered' => ['@type' => 'Service', 'name' => $s['h1'], 'url' => base_url(service_url($s['slug']))],
        ], get_all_services())),
    ],
];

if (!empty($sb['alt_phone_e164'])) {
    $schema['contactPoint'] = [
        ['@type' => 'ContactPoint', 'telephone' => $sb['phone_e164'], 'contactType' => 'customer service', 'areaServed' => 'IN'],
        ['@type' => 'ContactPoint', 'telephone' => $sb['alt_phone_e164'], 'contactType' => 'customer service', 'areaServed' => 'IN'],
    ];
}
if (!empty($sb['address'])) {
    $schema['address'] = [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $sb['address']['street'] ?? '',
        'addressLocality' => $sb['address']['locality'] ?? '',
        'addressRegion'   => $sb['address']['region'] ?? '',
        'postalCode'      => $sb['address']['postal_code'] ?? '',
        'addressCountry'  => 'IN',
    ];
}
if (!empty($sb['geo']['latitude'])) {
    $schema['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => $sb['geo']['latitude'], 'longitude' => $sb['geo']['longitude']];
}
if (!empty($sb['google_maps_url'])) {
    $schema['hasMap'] = $sb['google_maps_url'];
}
if (!empty($sb['opening_hours'])) {
    $schema['openingHours'] = $sb['opening_hours'];
}
if (price_label() !== '') {
    $schema['priceRange'] = 'From ' . price_label();
}
$sameAs = array_values(array_filter(array_merge([$sb['gbp_url'] ?? null], array_values($sb['social'] ?? []))));
if ($sameAs) {
    $schema['sameAs'] = $sameAs;
}

json_ld($schema);
