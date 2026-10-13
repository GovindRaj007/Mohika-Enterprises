<?php
/**
 * <head> SEO tags and JSON-LD output.
 *
 * $seo keys:
 *   title        required, ≤ 60 characters
 *   description  required, ≤ 155 characters
 *   path         canonical path — taken from the matched route, never from
 *                REQUEST_URI, so "?anything" cannot create a self-canonical
 *                duplicate. Omit on the 404.
 *   keywords     optional list, ≤ 12 terms (ignored by Google; read by Bing
 *                and directories — harmless when short)
 *   robots       default 'index, follow'
 *   og_image     site-relative JPEG/PNG path, 1200×630
 *   og_image_alt
 *   og_type      default 'website'
 *   placename    city for geo.placename (state when omitted)
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

function render_seo_head(array $seo): void
{
    $d = config_get('seo-defaults');

    $title       = $seo['title'] ?? SITE_NAME;
    $description = $seo['description'] ?? $d['default_description'];
    $robots      = $seo['robots'] ?? $d['robots'];
    $ogType      = $seo['og_type'] ?? $d['og_type'];
    $ogPath      = $seo['og_image'] ?? $d['og_image'];
    $ogImage     = base_url($ogPath);
    $ogAlt       = $seo['og_image_alt'] ?? $d['og_image_alt'];
    $canonical   = isset($seo['path']) ? base_url($seo['path']) : null;

    echo '<title>' . e($title) . "</title>\n";
    echo '<meta name="description" content="' . e($description) . "\">\n";
    if (!empty($seo['keywords'])) {
        echo '<meta name="keywords" content="' . e(implode(', ', array_slice($seo['keywords'], 0, 12))) . "\">\n";
    }
    echo '<meta name="robots" content="' . e($robots) . "\">\n";
    if ($canonical !== null) {
        echo '<link rel="canonical" href="' . e($canonical) . "\">\n";
        echo '<link rel="alternate" hreflang="en-IN" href="' . e($canonical) . "\">\n";
    }

    // A location page names its own state (IN-AP / IN-TG); pages covering
    // both states carry no geo.region rather than claiming just one.
    if (!empty($seo['geo_region'])) {
        echo '<meta name="geo.region" content="' . e($seo['geo_region']) . "\">\n";
    }
    echo '<meta name="geo.placename" content="' . e($seo['placename'] ?? business()['region']) . "\">\n";
    $geo = business()['geo'] ?? null;
    if (!empty($geo['latitude'])) {
        echo '<meta name="geo.position" content="' . e($geo['latitude'] . ';' . $geo['longitude']) . "\">\n";
        echo '<meta name="ICBM" content="' . e($geo['latitude'] . ', ' . $geo['longitude']) . "\">\n";
    }

    echo '<meta property="og:site_name" content="' . e(SITE_NAME) . "\">\n";
    echo '<meta property="og:locale" content="' . e($d['locale']) . "\">\n";
    echo '<meta property="og:type" content="' . e($ogType) . "\">\n";
    echo '<meta property="og:title" content="' . e($title) . "\">\n";
    echo '<meta property="og:description" content="' . e($description) . "\">\n";
    echo '<meta property="og:url" content="' . e($canonical ?? base_url('/')) . "\">\n";
    echo '<meta property="og:image" content="' . e($ogImage) . "\">\n";
    echo '<meta property="og:image:secure_url" content="' . e($ogImage) . "\">\n";
    $type = strtolower(pathinfo($ogPath, PATHINFO_EXTENSION)) === 'png' ? 'image/png' : 'image/jpeg';
    echo '<meta property="og:image:type" content="' . $type . "\">\n";
    echo '<meta property="og:image:width" content="' . e($d['og_image_width']) . "\">\n";
    echo '<meta property="og:image:height" content="' . e($d['og_image_height']) . "\">\n";
    echo '<meta property="og:image:alt" content="' . e($ogAlt) . "\">\n";
    // Video watch pages: the clip itself, for link previews that can play it.
    if (!empty($seo['og_video'])) {
        $ogVideo = $seo['og_video'];
        echo '<meta property="og:video" content="' . e(base_url($ogVideo['src'])) . "\">\n";
        echo '<meta property="og:video:secure_url" content="' . e(base_url($ogVideo['src'])) . "\">\n";
        echo '<meta property="og:video:type" content="video/mp4">' . "\n";
        echo '<meta property="og:video:width" content="' . (int) $ogVideo['w'] . "\">\n";
        echo '<meta property="og:video:height" content="' . (int) $ogVideo['h'] . "\">\n";
    }

    echo '<meta name="twitter:card" content="' . e($d['twitter_card']) . "\">\n";
    echo '<meta name="twitter:title" content="' . e($title) . "\">\n";
    echo '<meta name="twitter:description" content="' . e($description) . "\">\n";
    echo '<meta name="twitter:image" content="' . e($ogImage) . "\">\n";
    echo '<meta name="twitter:image:alt" content="' . e($ogAlt) . "\">\n";
    echo '<link rel="image_src" href="' . e($ogImage) . "\">\n";

    // WebPage entity naming this page's image as its primary image — what
    // Google can use for the thumbnail beside the result. Same picture as
    // og:image, so every share and every result shows the same photo.
    if ($canonical !== null) {
        json_ld([
            '@context'    => 'https://schema.org',
            '@type'       => 'WebPage',
            '@id'         => $canonical . '#webpage',
            'url'         => $canonical,
            'name'        => $title,
            'description' => $description,
            'inLanguage'  => 'en-IN',
            'isPartOf'    => ['@id' => base_url('/#website')],
            'about'       => ['@id' => base_url('/#business')],
            'primaryImageOfPage' => [
                '@type'   => 'ImageObject',
                'url'     => $ogImage,
                'width'   => (int) $d['og_image_width'],
                'height'  => (int) $d['og_image_height'],
                'caption' => $ogAlt,
            ],
            'image' => $ogImage,
        ]);
    }
}

/**
 * Prints one JSON-LD block. Slashes are left unescaped for readability;
 * "</" is still escaped so the data can never close the script element.
 */
function json_ld(array $data): void
{
    $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG);
    if ($json !== false) {
        echo '<script type="application/ld+json">' . $json . "</script>\n";
    }
}

/**
 * Title for a service × city page: richest candidate within 60 characters.
 * Visakhapatnam leads with "(Vizag)" — the spelling most people search.
 */
function service_location_title(array $service, array $location, array $content): string
{
    $name   = $service['h1'];
    $city   = $location['name'];
    $nick   = $location['nickname'] ?? '';
    $brand  = SITE_SHORT_NAME;
    $price  = price_label();
    $c = [];
    // An area of a city: "Invisible Grills in Gachibowli, Hyderabad | Mohika".
    if (!empty($location['parent']) && ($parent = get_location($location['parent'])) !== null) {
        $full = $city . ', ' . $parent['name'];
        $c[] = "{$name} in {$full} – {$content['hook']} | {$brand}";
        $c[] = "{$name} in {$full} | {$brand}";
        $c[] = "{$name} in {$full}";
    }
    if ($nick !== '') {
        if ($price !== '') {
            $c[] = "{$name} in {$city} ({$nick}) – From {$price} | {$brand}";
        }
        $c[] = "{$name} in {$city} ({$nick}) | {$brand}";
        $c[] = "{$name} in {$city} ({$nick})";
        $c[] = "{$name} in {$nick} – {$city} | {$brand}";
        $c[] = "{$name} in {$nick} | {$brand}";
    }
    if ($price !== '') {
        $c[] = "{$name} in {$city} – From {$price} | {$brand}";
    }
    $c[] = "{$name} in {$city} – {$content['hook']} | {$brand}";
    $c[] = "{$name} in {$city} | {$brand}";
    $c[] = "{$name} in {$city}";
    return first_fitting($c, 60);
}

/**
 * "₹139/sq ft" when a starting price is configured, otherwise ''. Every
 * price mention on the site goes through here, so removing the config value
 * removes every price.
 */
function price_label(): string
{
    $price = business()['price_from'] ?? null;
    return $price ? '₹' . $price . '/sq ft' : '';
}
