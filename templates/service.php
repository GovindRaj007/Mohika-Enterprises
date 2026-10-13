<?php
/**
 * Service page — /{service}.php. Owns the state-level query
 * "{service} in Andhra Pradesh" and the unqualified head term; city pages
 * own "{service} in {city}". Expects $service and $path.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$state  = business()['region'];
// A supply service (the dealer) shows ordering, not installation, and no installation count.
$isSupply = ($service['kind'] ?? '') === 'supply';
$name   = $service['h1'];
$lower  = str_lower($name);
$images = service_images($service['slug']);
[$heroPhoto, $heroAlt] = service_main_photo($service['slug']);
$cities = cities_for_service($service['slug']);

$seo = [
    'title'        => first_fitting($service['title_candidates'], 60),
    'description'  => $service['meta_description'],
    'keywords'     => $service['meta_keywords'],
    'path'         => $path,
    'og_image'     => $service['og_image'],
    'og_image_alt' => $heroAlt,
];
render_partial('head', ['seo' => $seo, 'preload' => $heroPhoto, 'preloadSizes' => '(min-width: 1024px) 44vw, 100vw', 'bodyClass' => 'page-service']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', [
        'crumbs'    => [['Services', '/services.php'], [$service['nav_label'], $path]],
        'kicker'    => $state,
        'h1'        => $name . ' in ' . $state,
        'tag'       => $service['h1_tag'],
        'lead'      => $service['card_summary'],
        'feats'     => $service['feats'],
        'photo'     => [$heroPhoto, $heroAlt],
        'photoLink' => '#photos',
        'quoteHref' => quote_url($service['slug']),
        'waAbout'   => $lower,
        'installs'  => !$isSupply,
        'ctaLabel'  => $isSupply ? $service['cta_label'] : null,
    ]); ?>

    <section class="section" aria-labelledby="why-svc">
        <div class="container">
            <div class="split">
                <div data-reveal-group>
                    <p class="kicker" data-reveal><?= e($service['tagline']) ?></p>
                    <h2 id="why-svc" data-reveal>Why choose <?= e($lower) ?> in <?= e($state) ?>?</h2>
                    <p class="lead" data-reveal><?= e($service['intro']) ?></p>
                </div>
                <blockquote class="promise" data-reveal>
                    <?= icon('shield', 'icon promise__icon') ?>
                    <p><?= e($service['why_choose']) ?></p>
                </blockquote>
            </div>
            <h3 class="sub-title">Benefits of <?= e($lower) ?></h3>
            <div class="benefits" data-reveal-group>
                <?php foreach ($service['benefits'] as $benefit): ?>
                    <div class="benefit" data-reveal>
                        <span class="benefit__dot" aria-hidden="true"></span>
                        <h4 class="benefit__title"><?= e($benefit['heading']) ?></h4>
                        <p><?= e($benefit['text']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--tint" id="photos" aria-labelledby="photos-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Our work', 'title' => $isSupply ? 'Invisible grill material we supply' : $name . ' installed in ' . $state . ' homes', 'id' => 'photos-title']); ?>
        </div>
        <?php render_partial('gallery-rail', ['items' => $images['gallery'], 'allHref' => '/gallery.php#' . $service['slug']]); ?>
    </section>

    <?php render_partial('video-showcase', [
        'videos' => service_videos($service['slug']),
        'kicker' => 'See it installed',
        'title'  => 'Watch ' . $lower . ' in action',
        'note'   => 'Short clips from our own installations — how ' . $lower . ' are fitted, tested and used.',
        'id'     => 'video-title',
    ]); ?>

    <section class="section" aria-labelledby="what-title">
        <div class="container">
            <div class="split split--wide">
                <div data-reveal-group>
                    <p class="kicker" data-reveal>Explained</p>
                    <h2 id="what-title" data-reveal>What are <?= e($lower) ?>?</h2>
                    <p data-reveal><?= e($service['what_is']) ?></p>
                    <?php foreach ($service['keyword_families'] as $family): ?>
                        <h3 class="sub-title" data-reveal><?= e($family['heading']) ?></h3>
                        <p data-reveal><?= e($family['text']) ?></p>
                    <?php endforeach; ?>
                </div>
                <div>
                    <h3 class="sub-title"><?= e($service['comparison']['title']) ?></h3>
                    <?php render_partial('compare-table', ['comparison' => $service['comparison']]); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="where-title">
        <div class="container split">
            <div data-reveal-group>
                <p class="kicker" data-reveal>Applications</p>
                <h2 id="where-title" data-reveal>Where we fit <?= e($lower) ?> in <?= e($state) ?></h2>
                <ul class="ticks ticks--lg" data-reveal>
                    <?php foreach ($service['applications'] as $app): ?><li><?= icon('check', 'icon icon--sm') ?><?= e($app) ?></li><?php endforeach; ?>
                </ul>
                <h3 class="sub-title" data-reveal>Materials used</h3>
                <p data-reveal><?= e($service['materials']) ?></p>
            </div>
            <?php render_partial('spec-card', ['specs' => $service['specs'], 'title' => $isSupply ? 'Material specifications' : 'Technical specifications', 'note' => $isSupply ? 'Grade and thickness are written on every quotation and invoice.' : 'Confirmed for your opening on the site visit.']); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="why-us-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Why ' . SITE_SHORT_NAME, 'title' => $isSupply ? 'Why buy invisible grill material from ' . SITE_SHORT_NAME : 'Why choose ' . SITE_SHORT_NAME . ' for ' . $lower, 'id' => 'why-us-title']); ?>
            <?php render_partial('why-us', $isSupply ? ['items' => $service['why_points']] : []); ?>
        </div>
    </section>

    <section class="section section--dark" aria-labelledby="process-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'How it works', 'title' => $isSupply ? 'How to order invisible grill material' : $name . ' installation process', 'id' => 'process-title']); ?>
            <?php render_partial('process', $isSupply ? ['steps' => $service['process_steps']] : ['installText' => $service['install_step_text']]); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="faq-title">
        <div class="container container--narrow">
            <?php render_partial('section-head', ['kicker' => 'Questions', 'title' => $name . ' in ' . $state . ' — FAQs', 'id' => 'faq-title', 'align' => 'center']); ?>
            <?php render_partial('faq', ['faqs' => $service['faqs']]); ?>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="near-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Service areas', 'title' => $name . ' near me — every area we cover', 'note' => 'Each city page covers what changes about the job there — the weather, the buildings and the localities we fit in.', 'id' => 'near-title']); ?>
            <?php render_partial('state-groups', [
                'locations' => $cities,
                'variant'   => 'links',
                'href'      => static fn(array $c): string => service_location_url($service['slug'], $c['slug']),
                'label'     => static fn(array $c): string => $name . ' in ' . city_display_name($c),
                'meta'      => static fn(array $c): string => $c['region'],
            ]); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="related-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $isSupply ? 'Related' : 'Also fitted', 'title' => $isSupply ? 'Related services' : 'Often fitted with ' . $lower, 'id' => 'related-title']); ?>
            <div class="svc-grid svc-grid--two" data-reveal-group>
                <?php foreach ($service['related'] as $relSlug) {
                    if ($rel = get_service($relSlug)) { render_partial('service-card', ['service' => $rel]); }
                } ?>
            </div>
        </div>
    </section>

    <?php render_partial('cta-band', $isSupply
        ? ['title' => $service['cta_title'], 'text' => $service['cta_text'], 'kicker' => 'Invisible grill material supply', 'button' => $service['cta_label'], 'quoteHref' => quote_url($service['slug']), 'waAbout' => $lower]
        : ['title' => 'Ready for ' . $lower . '? Book a free site visit', 'quoteHref' => quote_url($service['slug']), 'waAbout' => $lower]); ?>
</main>
<?php
render_partial('schema/service', ['service' => $service, 'path' => $path]);
render_partial('footer');
