<?php
/**
 * Service schema for a service page (areaServed = the state + every city
 * with a page) or a service × city page ($location set: areaServed narrows
 * to that one city, so the pages describe distinct offerings).
 * $service, $path, optional $location.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$ssState = business()['state'];
$ssArea = !empty($location)
    ? ['@type' => 'City', 'name' => $location['name'], 'containedInPlace' => ['@type' => 'State', 'name' => $ssState]]
    : array_merge(
        [['@type' => 'State', 'name' => $ssState]],
        array_values(array_map(static fn(array $l): array => ['@type' => 'City', 'name' => $l['name']], cities_for_service($service['slug'])))
    );

[$ssPhoto] = service_main_photo($service['slug']);
$schema = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    'name'        => !empty($location) ? $service['h1'] . ' in ' . $location['name'] : $service['h1'],
    'serviceType' => $service['service_type'],
    'description' => $service['card_summary'],
    'url'         => base_url($path),
    'image'       => base_url($service['og_image']),
    'provider'    => ['@id' => base_url('/#business')],
    'areaServed'  => $ssArea,
];
if (price_label() !== '') {
    $schema['offers'] = [
        '@type' => 'Offer',
        'priceCurrency' => 'INR',
        'price' => (string) business()['price_from'],
        'priceSpecification' => [
            '@type' => 'UnitPriceSpecification',
            'price' => (string) business()['price_from'],
            'priceCurrency' => 'INR',
            'unitText' => 'sq ft',
        ],
    ];
}
json_ld($schema);
