<?php
/**
 * Gallery — /gallery.php. Every service photo, grouped by service with an
 * anchor per group (/gallery.php#pigeon-nets) and filter buttons (jQuery).
 * Without JS all groups show. Photos open in the lightbox.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p = config_get('pages')['gallery'];
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];
render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-gallery']);
render_partial('header');
$services = get_all_services();
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['Gallery', $path]], 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead']]); ?>

    <section class="section" aria-label="Photos">
        <div class="container">
            <div class="filters" role="group" aria-label="Filter photos by service" data-filters>
                <button class="filter is-active" type="button" data-filter="all" aria-pressed="true"><?= e($p['filter_all']) ?></button>
                <?php foreach ($services as $svc): ?>
                    <button class="filter" type="button" data-filter="<?= e($svc['slug']) ?>" aria-pressed="false"><?= icon($svc['icon'], 'icon icon--sm') ?><?= e($svc['nav_label']) ?></button>
                <?php endforeach; ?>
            </div>

            <?php foreach ($services as $svc): ?>
                <section class="gallery-group" id="<?= e($svc['slug']) ?>" data-filter-group="<?= e($svc['slug']) ?>" aria-labelledby="g-<?= e($svc['slug']) ?>">
                    <div class="gallery-group__head">
                        <h2 id="g-<?= e($svc['slug']) ?>"><?= e($svc['h1']) ?> photos</h2>
                        <a class="link-arrow" href="<?= e(service_url($svc['slug'])) ?>">About <?= e(str_lower($svc['nav_label'])) ?> <?= icon('arrow', 'icon icon--sm') ?></a>
                    </div>
                    <ul class="masonry" data-gallery data-reveal-group role="list">
                        <?php foreach (service_images($svc['slug'])['gallery'] as [$gName, $gAlt]): ?>
                            <li class="masonry__item" data-reveal>
                                <a href="<?= e(asset(photo_src($gName, 1200))) ?>" data-lightbox aria-label="View larger: <?= e($gAlt) ?>">
                                    <?= photo($gName, $gAlt, ['sizes' => '(min-width: 1024px) 30vw, (min-width: 768px) 45vw, 92vw', 'want' => 480]) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endforeach; ?>
        </div>
    </section>

    <?php render_partial('cta-band', ['title' => 'Like what you see? Get a free quote']); ?>
</main>
<?php render_partial('footer'); ?>
