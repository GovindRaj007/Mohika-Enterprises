<?php
/**
 * HTML sitemap — /sitemap.php, linked from the footer on every page.
 * Built from the same route table as the router and /sitemap.xml, so it
 * lists exactly the pages that exist: main pages, services, city hubs,
 * every authored service × city page (grouped by service) and the guides.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p = config_get('pages')['sitemap'];
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];

$smMain = [
    ['Home', '/'],
    ['All services', '/services.php'],
    ['Service areas', '/service-areas.php'],
    ['Gallery', '/gallery.php'],
    ['Installation videos', '/videos.php'],
    ['About us', '/about-us.php'],
    ['Blog', '/blog.php'],
    ['Contact & free quote', '/contact-us.php'],
];

render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-sitemap']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['Sitemap', $path]], 'kicker' => SITE_SHORT_NAME, 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead']]); ?>

    <section class="section">
        <div class="container">
            <div class="sitemap-grid">
                <nav class="sitemap-group" aria-labelledby="sm-main-title">
                    <h2 class="sitemap-group__title" id="sm-main-title">Main pages</h2>
                    <ul class="sitemap-list">
                        <?php foreach ($smMain as [$smLabel, $smHref]): ?>
                            <li><a href="<?= e($smHref) ?>"><?= e($smLabel) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <nav class="sitemap-group" aria-labelledby="sm-svc-title">
                    <h2 class="sitemap-group__title" id="sm-svc-title">Services</h2>
                    <ul class="sitemap-list">
                        <?php foreach (get_all_services() as $smSvc): ?>
                            <li><a href="<?= e(service_url($smSvc['slug'])) ?>"><?= e($smSvc['nav_label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <nav class="sitemap-group" aria-labelledby="sm-city-title">
                    <h2 class="sitemap-group__title" id="sm-city-title">Areas we cover</h2>
                    <?php foreach (locations_by_state() as $smStateKey => $smStateLocs): ?>
                        <h3 class="sitemap-state"><?= e(get_states()[$smStateKey]['name']) ?></h3>
                        <ul class="sitemap-list">
                            <?php foreach ($smStateLocs as $smLoc): ?>
                                <li><a href="<?= e(city_url($smLoc['slug'])) ?>">Invisible grills &amp; safety nets in <?= e(city_display_name($smLoc)) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </nav>

                <?php foreach (get_all_services() as $smSvc):
                    $smCities = cities_for_service($smSvc['slug']);
                    if (!$smCities) { continue; }
                    ?>
                    <nav class="sitemap-group" aria-labelledby="sm-<?= e($smSvc['slug']) ?>">
                        <h2 class="sitemap-group__title" id="sm-<?= e($smSvc['slug']) ?>"><?= e($smSvc['nav_label']) ?> by area</h2>
                        <?php foreach (get_states() as $smStateKey => $smState):
                            $smInState = array_filter($smCities, static fn(array $l): bool => $l['state'] === $smStateKey);
                            if (!$smInState) { continue; }
                            ?>
                            <h3 class="sitemap-state"><?= e($smState['name']) ?></h3>
                            <ul class="sitemap-list">
                                <?php foreach ($smInState as $smLoc): ?>
                                    <li><a href="<?= e(service_location_url($smSvc['slug'], $smLoc['slug'])) ?>"><?= e($smSvc['nav_label']) ?> in <?= e(city_display_name($smLoc)) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>
                    </nav>
                <?php endforeach; ?>

                <nav class="sitemap-group" aria-labelledby="sm-video-title">
                    <h2 class="sitemap-group__title" id="sm-video-title">Videos</h2>
                    <ul class="sitemap-list">
                        <?php foreach (all_videos() as $smVideo): ?>
                            <li><a href="<?= e(video_url($smVideo['slug'])) ?>"><?= e($smVideo['title']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <?php if (get_all_posts()): ?>
                    <nav class="sitemap-group" aria-labelledby="sm-blog-title">
                        <h2 class="sitemap-group__title" id="sm-blog-title">Guides</h2>
                        <ul class="sitemap-list">
                            <?php foreach (get_all_posts() as $smSlug => $smPost): ?>
                                <li><a href="<?= e(post_url($smSlug)) ?>"><?= e($smPost['title']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php render_partial('cta-band', ['title' => 'Can’t find what you need? Ask us']); ?>
</main>
<?php render_partial('footer'); ?>
