<?php
/**
 * City hub — /invisible-grills-and-safety-nets-in-{city}.html. Owns
 * "invisible grills & safety nets in {city}" and "safety nets in {city}"
 * (both strong Google autocomplete phrases), and is the internal hub that
 * links to every service page in the city. Carries the city's own copy —
 * intro, homes, context, landmarks, localities and a local FAQ.
 * Expects $location and $path.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$city     = $location['name'];
$cityFull = city_display_name($location);
$nick     = $location['nickname'] ?? '';
$services = services_in_city($location['slug']);
$nearby   = array_filter(array_map('get_location', $location['nearby']));
[$heroPhoto, $heroAlt] = service_main_photo(array_key_first($services) ?? 'invisible-grills');

$seo = [
    'title' => first_fitting([
        'Invisible Grills & Safety Nets in ' . $cityFull . ' | ' . SITE_SHORT_NAME,
        'Invisible Grills & Safety Nets in ' . $cityFull,
        'Invisible Grills & Safety Nets in ' . $city . ' | ' . SITE_SHORT_NAME,
    ], 60),
    'description' => first_fitting([
        'Invisible grills, balcony safety nets, pigeon nets, cricket nets & cloth hangers in ' . $cityFull . '. ' . $location['blurb'],
        'Invisible grills, balcony safety nets, pigeon nets, cricket nets & ceiling cloth hangers in ' . $cityFull . ' — measured, quoted and fitted by ' . SITE_SHORT_NAME . '.',
        'Invisible grills, safety nets, pigeon nets, cricket nets & cloth hangers in ' . $cityFull . '. Free site visit.',
    ], 155),
    'keywords' => array_values(array_filter([
        'invisible grills in ' . str_lower($city),
        'safety nets in ' . str_lower($city),
        $nick !== '' ? 'invisible grills in ' . str_lower($nick) : '',
        $nick !== '' ? 'safety nets in ' . str_lower($nick) : '',
        'balcony safety nets in ' . str_lower($city),
        'pigeon safety nets in ' . str_lower($city),
        'cricket nets in ' . str_lower($city),
        'ceiling cloth hangers ' . str_lower($city),
        'invisible grills near me',
    ])),
    'path'      => $path,
    'og_image_alt' => $heroAlt,
    'placename' => $city,
];

$faqs = [
    $location['faq'],
    ['question' => 'What do you install in ' . $city . '?', 'answer' => 'In ' . $city . ' we fit ' . str_lower(join_names(array_column($services, 'nav_label'))) . ' — for flats, independent houses, schools and turfs.'],
    ['question' => 'Which parts of ' . $city . ' do you cover?', 'answer' => 'We cover ' . join_names(array_slice($location['localities'], 0, 6)) . ' and the rest of ' . $city . ', along with nearby areas. Call or WhatsApp with your locality to fix a visit.'],
];

render_partial('head', ['seo' => $seo, 'preload' => $heroPhoto, 'preloadSizes' => '(min-width: 1024px) 22vw, 48vw', 'bodyClass' => 'page-city']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', [
        'crumbs'    => [['Service areas', '/service-areas.php'], [$cityFull, $path]],
        'kicker'    => $location['kicker'] . ' · ' . $location['district'],
        'h1'        => 'Invisible Grills & Safety Nets in ' . $cityFull,
        'tag'       => 'Balcony safety, pigeon nets, cricket nets & cloth hangers in ' . ($nick !== '' ? $nick : $city),
        'lead'      => $location['intro'],
        'mosaic'    => array_values(array_map(static function (array $svc) use ($location): array {
            [$mp, $ma] = service_main_photo($svc['slug']);
            return [$mp, $ma, $svc['nav_label'], service_location_url($svc['slug'], $location['slug']), $svc['icon']];
        }, $services)),
        'quoteHref' => quote_url('', $location['slug']),
        'waAbout'   => 'balcony safety work in ' . $city,
    ]); ?>

    <section class="section" aria-labelledby="homes-title">
        <div class="container split">
            <div data-reveal-group>
                <p class="kicker" data-reveal><?= e($location['region']) ?></p>
                <h2 id="homes-title" data-reveal>Homes in <?= e($city) ?> and what they need</h2>
                <p class="lead" data-reveal><?= e($location['homes']) ?></p>
                <h3 class="sub-title" data-reveal>Weather, and the materials it calls for</h3>
                <p data-reveal><?= e($location['context']) ?></p>
            </div>
            <aside class="panel" data-reveal>
                <h3 class="panel__title"><?= icon('pin', 'icon icon--sm') ?> Around <?= e($city) ?></h3>
                <ul class="ticks">
                    <?php foreach ($location['landmarks'] as $landmark): ?><li><?= icon('check', 'icon icon--sm') ?><?= e($landmark) ?></li><?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="svc-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Services', 'title' => 'Our services in ' . $cityFull, 'note' => 'Each page covers how we fit that service in ' . $city . ' — the buildings, the localities and the material the local weather calls for.', 'id' => 'svc-title']); ?>
            <div class="svc-grid" data-reveal-group>
                <?php foreach ($services as $svc) { render_partial('service-card', ['service' => $svc, 'city' => $location]); } ?>
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="loc-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Coverage', 'title' => 'Invisible grills & safety nets near me in ' . ($nick !== '' ? $nick : $city), 'id' => 'loc-title']); ?>
            <ul class="localities localities--lg" data-reveal>
                <?php foreach ($location['localities'] as $locality): ?><li><?= e($locality) ?></li><?php endforeach; ?>
                <li class="localities__more">and nearby areas</li>
            </ul>
            <?php if ($nearby): ?>
                <p class="also-near">Also nearby:
                    <?php foreach (array_values($nearby) as $ni => $near): ?><?= $ni > 0 ? ' · ' : '' ?><a href="<?= e(city_url($near['slug'])) ?>">Invisible grills &amp; safety nets in <?= e($near['nickname'] ?: $near['name']) ?></a><?php endforeach; ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section section--dark" aria-labelledby="process-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'How it works', 'title' => 'How we work in ' . $city, 'id' => 'process-title']); ?>
            <?php render_partial('process'); ?>
        </div>
    </section>

    <?php render_partial('testimonials', ['filterCity' => $location['slug'], 'title' => 'What ' . $city . ' customers say']); ?>

    <section class="section section--tint" aria-labelledby="faq-title">
        <div class="container container--narrow">
            <?php render_partial('section-head', ['kicker' => 'Questions', 'title' => 'Invisible grills & safety nets in ' . $city . ' — FAQs', 'id' => 'faq-title', 'align' => 'center']); ?>
            <?php render_partial('faq', ['faqs' => $faqs, 'openFirst' => true]); ?>
        </div>
    </section>

    <?php render_partial('cta-band', [
        'title'     => 'Book a free site visit in ' . $city,
        'quoteHref' => quote_url('', $location['slug']),
        'waAbout'   => 'balcony safety work in ' . $city,
    ]); ?>
</main>
<?php render_partial('footer'); ?>
