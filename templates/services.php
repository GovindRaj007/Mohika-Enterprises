<?php
/**
 * Services overview — /services.php.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p = config_get('pages')['services'];
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];
render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-services']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['Services', $path]], 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead']]); ?>

    <section class="section" aria-labelledby="list-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Five services', 'title' => $p['list_title'], 'id' => 'list-title']); ?>
            <div class="svc-list" data-reveal-group>
                <?php foreach (get_all_services() as $svc): [$sp, $sa] = service_main_photo($svc['slug']); ?>
                    <article class="svc-row" data-reveal>
                        <a class="svc-row__media" href="<?= e(service_url($svc['slug'])) ?>" tabindex="-1" aria-hidden="true">
                            <?= photo($sp, '', ['sizes' => '(min-width: 1024px) 38vw, 92vw', 'want' => 800]) ?>
                        </a>
                        <div class="svc-row__body">
                            <p class="kicker"><?= icon($svc['icon'], 'icon icon--sm') ?> <?= e($svc['tagline']) ?></p>
                            <h3 class="svc-row__title"><a href="<?= e(service_url($svc['slug'])) ?>"><?= e($svc['h1']) ?></a></h3>
                            <p><?= e($svc['intro']) ?></p>
                            <ul class="ticks">
                                <?php foreach ($svc['feats'] as $feat): ?><li><?= icon('check', 'icon icon--sm') ?><?= e($feat) ?></li><?php endforeach; ?>
                            </ul>
                            <div class="svc-row__actions">
                                <a class="btn btn--dark" href="<?= e(service_url($svc['slug'])) ?>">Explore <?= e(str_lower($svc['nav_label'])) ?> <?= icon('arrow', 'icon icon--sm') ?></a>
                                <a class="btn btn--outline" href="<?= e(quote_url($svc['slug'])) ?>">Get a quote</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="combo-title">
        <div class="container container--narrow center" data-reveal-group>
            <h2 id="combo-title" data-reveal><?= e($p['combo_title']) ?></h2>
            <p class="lead" data-reveal><?= e($p['combo_text']) ?></p>
        </div>
    </section>

    <section class="section" aria-labelledby="why-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Why ' . SITE_SHORT_NAME, 'title' => 'Why choose ' . SITE_SHORT_NAME, 'id' => 'why-title']); ?>
            <?php render_partial('why-us'); ?>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="areas-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Service areas', 'title' => 'Invisible grills & safety nets near me — every city', 'id' => 'areas-title']); ?>
            <div class="city-grid" data-reveal-group>
                <?php foreach (get_all_locations() as $city) { render_partial('city-card', ['location' => $city]); } ?>
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="faq-title">
        <div class="container container--narrow">
            <?php render_partial('section-head', ['kicker' => 'Questions', 'title' => 'Services — FAQs', 'id' => 'faq-title', 'align' => 'center']); ?>
            <?php render_partial('faq', ['faqs' => $p['faqs']]); ?>
        </div>
    </section>

    <?php render_partial('cta-band', ['title' => 'Not sure which one you need? Ask us']); ?>
</main>
<?php render_partial('footer'); ?>
