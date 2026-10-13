<?php
/**
 * Service × city page — /{service}-in-{city}.html. Owns "{service} in
 * {city}" (and "… near me in {city}").
 *
 * Built to stay well clear of duplicate-content trouble:
 *  - every paragraph of body copy comes from this pair's own block in
 *    config/service-locations/ (intro, local, fit, material, two FAQs);
 *  - the city's own paragraphs (homes, context) are NOT repeated here —
 *    they live on the city hub — so the five services in one city do not
 *    share text with each other;
 *  - shared blocks (benefits, specs, process) are short and come after the
 *    local copy; company-wide blocks are marked data-boilerplate.
 *
 * Expects $service, $location, $content, $path.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$name     = $service['h1'];
$isSupply = ($service['kind'] ?? '') === 'supply';   // dealer: ordering, not installation
$lower    = str_lower($name);
$city     = $location['name'];
$cityFull = city_display_name($location);
$nick     = $location['nickname'] ?? '';
[$heroPhoto, $heroAlt] = service_main_photo($service['slug']);

$seo = [
    'title'        => service_location_title($service, $location, $content),
    'description'  => $content['meta'],
    'keywords'     => array_values(array_unique(array_filter([
        $lower . ' in ' . str_lower($city),
        $lower . ' ' . str_lower($city),
        $nick !== '' ? $lower . ' in ' . str_lower($nick) : '',
        $lower . ' near me',
        $service['singular'] . ' installation in ' . str_lower($city),
        $service['meta_keywords'][1] ?? '',
        $lower . ' price in ' . str_lower($city),
    ]))),
    'path'         => $path,
    'og_image'     => $service['og_image'],
    'og_image_alt' => $heroAlt,
    'placename'    => $cityFull,
    'geo_region'   => location_state($location)['code'],
];

// FAQs: the two questions from this city first, then the service's pricing
// question (always its last FAQ) — the one shared answer worth repeating.
$faqs = array_merge($content['faqs'], [end($service['faqs'])]);

// Three of the service's six benefits, a different trio per city, so the
// block is not the same six cards on every city page of this service.
$cityIndex = (int) array_search($location['slug'], array_keys(get_all_locations()), true);
$benefits  = [];
for ($i = 0; $i < 3; $i++) {
    $benefits[] = $service['benefits'][($cityIndex * 2 + $i) % count($service['benefits'])];
}

$otherServices = array_filter(services_in_city($location['slug']), static fn(array $s): bool => $s['slug'] !== $service['slug']);
$otherCities   = array_filter(cities_for_service($service['slug']), static fn(array $l): bool => $l['slug'] !== $location['slug']);
$nearby        = array_filter(array_map('get_location', $location['nearby']), static fn($l): bool => $l !== null && get_service_location($service['slug'], $l['slug']) !== null);

render_partial('head', ['seo' => $seo, 'preload' => $heroPhoto, 'preloadSizes' => '(min-width: 1024px) 44vw, 100vw', 'bodyClass' => 'page-service-location']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', [
        'crumbs'    => [[$service['nav_label'], service_url($service['slug'])], [$cityFull, city_url($location['slug'])], [$name . ' in ' . $city, $path]],
        'kicker'    => $location['kicker'] . ' · ' . $location['district'] . ', ' . location_state($location)['name'],
        'h1'        => $name . ' in ' . $cityFull,
        'tag'       => $service['h1_tag'],
        'lead'      => $content['intro'],
        'feats'     => $service['feats'],
        'photo'     => [$heroPhoto, $heroAlt],
        'photoLink' => '#photos',
        'quoteHref' => quote_url($service['slug'], $location['slug']),
        'waAbout'   => $lower . ' in ' . $city,
        'installs'  => !$isSupply,
        'ctaLabel'  => $isSupply ? $service['cta_label'] : null,
    ]); ?>

    <section class="section" aria-labelledby="local-title">
        <div class="container split">
            <div data-reveal-group>
                <p class="kicker" data-reveal><?= e($location['region']) ?></p>
                <h2 id="local-title" data-reveal>What <?= e($nick !== '' ? $nick : $city) ?> changes about <?= e($lower) ?></h2>
                <p class="lead" data-reveal><?= e($content['local']) ?></p>
            </div>
            <aside class="panel" data-reveal>
                <h3 class="panel__title"><?= icon('sun', 'icon icon--sm') ?> Materials used in <?= e($city) ?></h3>
                <p><?= e($content['material']) ?></p>
            </aside>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="near-title">
        <div class="container split">
            <div data-reveal-group>
                <p class="kicker" data-reveal>Where we work</p>
                <h2 id="near-title" data-reveal><?= e($name) ?> near me in <?= e($nick !== '' ? $nick : $city) ?></h2>
                <p data-reveal><?= e($content['fit']) ?></p>
                <h3 class="sub-title" data-reveal><?= e($name) ?> in <?= e($nick !== '' ? $nick : $city) ?> — localities we cover</h3>
                <ul class="localities" data-reveal>
                    <?php foreach ($location['localities'] as $locality): ?><li><?= e($locality) ?></li><?php endforeach; ?>
                    <li class="localities__more">and nearby areas</li>
                </ul>
                <?php if ($nearby): ?>
                    <p class="also-near" data-reveal>Also near <?= e($city) ?>:
                        <?php foreach (array_values($nearby) as $ni => $near): ?><?= $ni > 0 ? ' · ' : '' ?><a href="<?= e(service_location_url($service['slug'], $near['slug'])) ?>"><?= e($name) ?> in <?= e(city_short_name($near)) ?></a><?php endforeach; ?>
                    </p>
                <?php endif; ?>
            </div>
            <?php render_partial('spec-card', ['specs' => $service['specs'], 'title' => 'Technical specifications in ' . $city, 'note' => $isSupply ? 'Grade and thickness are written on every quotation and invoice.' : 'Confirmed for your opening on the site visit.']); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="benefits-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Why it works', 'title' => 'Benefits of ' . $lower . ' in ' . $city, 'id' => 'benefits-title']); ?>
            <div class="benefits" data-reveal-group>
                <?php foreach ($benefits as $benefit): ?>
                    <div class="benefit" data-reveal>
                        <span class="benefit__dot" aria-hidden="true"></span>
                        <h3 class="benefit__title"><?= e($benefit['heading']) ?></h3>
                        <p><?= e($benefit['text']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--dark" aria-labelledby="process-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'How it works', 'title' => $isSupply ? 'How to order invisible grill material in ' . $city : $name . ' installation process in ' . $city, 'id' => 'process-title']); ?>
            <?php render_partial('process', $isSupply ? ['steps' => $service['process_steps'], 'compact' => true] : ['installText' => $service['install_step_text'], 'compact' => true]); ?>
        </div>
    </section>

    <section class="section" id="photos" aria-labelledby="photos-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Our work', 'title' => $isSupply ? 'Invisible grill material we supply in ' . $city : $name . ' we have fitted', 'id' => 'photos-title']); ?>
        </div>
        <?php render_partial('gallery-rail', ['items' => array_slice(service_images($service['slug'])['gallery'], 0, 6), 'allHref' => '/gallery.php#' . $service['slug']]); ?>
    </section>

    <section class="section section--tint" aria-labelledby="faq-title">
        <div class="container container--narrow">
            <?php render_partial('section-head', ['kicker' => 'Questions', 'title' => $name . ' in ' . $city . ' — FAQs', 'id' => 'faq-title', 'align' => 'center']); ?>
            <?php render_partial('faq', ['faqs' => $faqs, 'openFirst' => true]); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="more-title">
        <div class="container">
            <div class="split split--even">
                <div>
                    <h2 class="h3" id="more-title">Everything we fit in <?= e($city) ?></h2>
                    <ul class="link-list" data-reveal-group>
                        <?php foreach ($otherServices as $other): ?>
                            <li data-reveal><a href="<?= e(service_location_url($other['slug'], $location['slug'])) ?>"><?= icon($other['icon'], 'icon icon--sm') ?><?= e($other['h1']) ?> in <?= e($city) ?></a></li>
                        <?php endforeach; ?>
                        <li data-reveal><a href="<?= e(city_url($location['slug'])) ?>"><?= icon('pin', 'icon icon--sm') ?>All services in <?= e($cityFull) ?></a></li>
                    </ul>
                </div>
                <div>
                    <h2 class="h3"><?= e($name) ?> in other areas</h2>
                    <?php render_partial('state-groups', [
                        'locations' => $otherCities,
                        'tag'       => 'h3',
                        'href'      => static fn(array $c): string => service_location_url($service['slug'], $c['slug']),
                        'label'     => 'city_short_name',
                        'extra'     => [$name . ' across ' . business()['region_short'], service_url($service['slug'])],
                    ]); ?>
                </div>
            </div>
        </div>
    </section>

    <?php render_partial('cta-band', $isSupply ? [
        'title'     => 'Invisible grill material in ' . $city . '? Get a written quote',
        'text'      => 'WhatsApp your opening sizes or bill of quantities with your locality in ' . $city . '. We reply with a written quote stating the wire grade, thickness and fittings.',
        'kicker'    => 'Invisible grill material supply',
        'button'    => $service['cta_label'],
        'quoteHref' => quote_url($service['slug'], $location['slug']),
        'waAbout'   => $lower . ' in ' . $city,
    ] : [
        'title'     => 'Book your free site visit in ' . $city,
        'text'      => 'WhatsApp a photo of the opening with your locality in ' . $city . '. We will fix a time to measure and give you a written quote for ' . $lower . '.',
        'quoteHref' => quote_url($service['slug'], $location['slug']),
        'waAbout'   => $lower . ' in ' . $city,
    ]); ?>
</main>
<?php
render_partial('schema/service', ['service' => $service, 'path' => $path, 'location' => $location]);
render_partial('footer');
