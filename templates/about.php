<?php
/**
 * About — /about-us.php.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p = config_get('pages')['about'];
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];
[$aboutPhoto, $aboutAlt] = service_main_photo('balcony-safety-nets');
render_partial('head', ['seo' => $seo, 'preload' => $aboutPhoto, 'bodyClass' => 'page-about']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['About us', $path]], 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead'], 'photo' => [$aboutPhoto, $aboutAlt]]); ?>

    <section class="section" aria-labelledby="story-title">
        <div class="container container--narrow" data-reveal-group>
            <p class="kicker" data-reveal>Our story</p>
            <h2 id="story-title" data-reveal><?= e($p['story_title']) ?></h2>
            <?php foreach ($p['story'] as $para): ?><p class="lead" data-reveal><?= e($para) ?></p><?php endforeach; ?>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="values-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'How we work', 'title' => $p['values_title'], 'id' => 'values-title']); ?>
            <?php render_partial('why-us'); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="svc-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Services', 'title' => 'What we install', 'id' => 'svc-title']); ?>
            <div class="svc-grid" data-reveal-group>
                <?php foreach (get_all_services() as $svc) { render_partial('service-card', ['service' => $svc]); } ?>
            </div>
        </div>
    </section>

    <section class="section section--dark" aria-labelledby="process-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Process', 'title' => 'Invisible grills & safety nets installation process', 'id' => 'process-title']); ?>
            <?php render_partial('process'); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="cities-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Coverage', 'title' => $p['cities_title'], 'id' => 'cities-title']); ?>
            <?php render_partial('state-groups', ['locations' => get_all_locations(), 'variant' => 'cards']); ?>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="faq-title">
        <div class="container container--narrow">
            <?php render_partial('section-head', ['kicker' => 'Questions', 'title' => 'About ' . SITE_SHORT_NAME . ' — FAQs', 'id' => 'faq-title', 'align' => 'center']); ?>
            <?php render_partial('faq', ['faqs' => array_merge($p['faqs'], [['question' => 'Which cities do you cover?', 'answer' => coverage_answer()]])]); ?>
        </div>
    </section>

    <?php render_partial('cta-band', ['title' => 'Talk to the team that does the work']); ?>
</main>
<?php render_partial('footer'); ?>
