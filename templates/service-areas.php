<?php
/**
 * Near-me hub — /service-areas.php. Owns "invisible grills near me" and
 * "safety nets near me". City directory grouped by climate zone, with a
 * type-to-filter area finder (jQuery, assets/js/site.js); without JS every
 * city and locality is simply listed.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p = config_get('pages')['service-areas'];
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];

$byZone = [];
foreach (get_all_locations() as $loc) {
    $byZone[$loc['zone']][] = $loc;
}

render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-areas']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['Service areas', $path]], 'kicker' => business()['state'], 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead']]); ?>

    <section class="section" aria-labelledby="finder-title">
        <div class="container">
            <div class="finder" data-area-finder>
                <h2 class="finder__title" id="finder-title"><?= e($p['finder_label']) ?></h2>
                <label class="sr-only" for="area-q"><?= e($p['finder_label']) ?></label>
                <div class="finder__field">
                    <?= icon('search', 'icon') ?>
                    <input class="finder__input" id="area-q" type="search" placeholder="<?= e($p['finder_hint']) ?>" autocomplete="off" data-area-input>
                </div>
                <p class="finder__empty" data-area-empty hidden role="status"><?= e($p['finder_empty']) ?></p>
            </div>

            <?php foreach ($p['zones'] as $zoneKey => $zone): if (empty($byZone[$zoneKey])) { continue; } ?>
                <div class="zone" data-area-group>
                    <div class="zone__head">
                        <h2 class="zone__title"><?= e($zone['title']) ?></h2>
                        <p><?= e($zone['text']) ?></p>
                    </div>
                    <div class="city-grid" data-reveal-group>
                        <?php foreach ($byZone[$zoneKey] as $loc): ?>
                            <?php render_partial('city-card', ['location' => $loc]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="all-loc-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Localities', 'title' => 'Every locality we cover', 'id' => 'all-loc-title']); ?>
            <div class="loc-columns">
                <?php foreach (get_all_locations() as $loc): ?>
                    <div class="loc-col">
                        <h3 class="loc-col__title"><a href="<?= e(city_url($loc['slug'])) ?>"><?= e(city_display_name($loc)) ?></a></h3>
                        <p class="loc-col__list"><?= e(implode(' · ', $loc['localities'])) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--dark" aria-labelledby="process-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'How it works', 'title' => 'From your call to a finished balcony', 'id' => 'process-title']); ?>
            <?php render_partial('process'); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="faq-title">
        <div class="container container--narrow">
            <?php render_partial('section-head', ['kicker' => 'Questions', 'title' => 'Invisible grills & safety nets near me — FAQs', 'id' => 'faq-title', 'align' => 'center']); ?>
            <?php render_partial('faq', ['faqs' => $p['faqs']]); ?>
        </div>
    </section>

    <?php render_partial('cta-band', ['title' => 'Find out if we cover your area']); ?>
</main>
<?php render_partial('footer'); ?>
