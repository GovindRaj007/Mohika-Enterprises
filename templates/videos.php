<?php
/**
 * Video hub — /videos.php. Lists every installation clip, each linking to
 * its own watch page (templates/video.php). Linked from the footer, the
 * sitemap page and the "in action" sections.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p = config_get('pages')['videos'];
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];

render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-videos']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['Videos', $path]], 'kicker' => business()['region'], 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead']]); ?>

    <?php $vhFirst = true; foreach (get_all_services() as $vhSvc):
        $vhVideos = service_videos($vhSvc['slug']);
        if (!$vhVideos) { continue; }
        ?>
        <section class="section" aria-labelledby="videos-<?= e($vhSvc['slug']) ?>">
            <div class="container">
                <?php render_partial('section-head', ['kicker' => 'Videos', 'title' => $vhSvc['nav_label'], 'id' => 'videos-' . $vhSvc['slug']]); ?>
                <?php render_partial('video-cards', ['videos' => $vhVideos, 'eager' => $vhFirst]); $vhFirst = false; ?>
                <p class="video-hub__more"><a class="link-arrow" href="<?= e(service_url($vhSvc['slug'])) ?>">About our <?= e(strtolower($vhSvc['nav_label'])) ?> <?= icon('arrow', 'icon icon--sm') ?></a></p>
            </div>
        </section>
    <?php endforeach; ?>

    <?php render_partial('cta-band', ['title' => 'Like what you see? Book a free site visit']); ?>
</main>
<?php render_partial('footer'); ?>
