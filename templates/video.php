<?php
/**
 * Video watch page — /{video-slug}.php, one per installation clip.
 *
 * Google indexes a video only on a page whose main purpose is that video
 * (a "watch page"); on the home and service pages the clips are
 * supplementary, so they link here. The player sits in the first screen at
 * every width (on phones straight under the H1), with the poster, native
 * controls and the same MP4 URL as the VideoObject and the video sitemap.
 *
 * Expects $video (all_videos() entry) and $path.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$svc = get_service($video['service']);
$svcLower = strtolower($svc['nav_label']);
$seo = [
    'title'        => $video['seo_title'],
    'description'  => $video['description'],
    'keywords'     => array_slice($svc['keywords'] ?? [], 0, 6),
    'path'         => $path,
    'og_type'      => 'video.other',
    'og_image'     => $svc['og_image'],
    'og_image_alt' => $video['title'],
    'og_video'     => ['src' => video_src($video), 'w' => $video['w'], 'h' => $video['h']],
];
$others = array_filter(all_videos(), static fn(array $v): bool => $v['slug'] !== $video['slug']);

render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-video']);
render_partial('header');
?>
<main id="main">
    <article>
        <section class="page-hero watch-hero">
            <div class="page-hero__cables" aria-hidden="true"></div>
            <div class="container watch-hero__inner">
                <div class="watch-hero__head">
                    <?php render_partial('breadcrumbs', ['crumbs' => [['Videos', '/videos.php'], [$video['title'], $path]]]); ?>
                    <p class="eyebrow" data-hero-rise style="--i:0"><?= icon($svc['icon'], 'icon icon--sm') ?> <?= e($svc['nav_label']) ?> · Video</p>
                    <h1 class="page-hero__title" data-hero-rise style="--i:1"><?= e($video['title']) ?></h1>
                </div>

                <figure class="watch__player">
                    <video class="watch__video" controls playsinline preload="metadata"
                           poster="<?= e(video_poster($video)) ?>"
                           width="<?= (int) $video['w'] ?>" height="<?= (int) $video['h'] ?>"
                           aria-label="<?= e($video['title']) ?>">
                        <source src="<?= e(video_src($video)) ?>" type="video/mp4">
                    </video>
                    <figcaption class="watch__caption"><?= e($video['caption']) ?></figcaption>
                </figure>

                <div class="watch-hero__body">
                    <p class="page-hero__lead" data-hero-rise style="--i:2"><?= e($video['description']) ?></p>
                    <dl class="watch__facts" data-hero-rise style="--i:3">
                        <div><dt>Length</dt><dd><?= video_seconds($video['duration']) ?> seconds</dd></div>
                        <div><dt>Service</dt><dd><a href="<?= e(service_url($svc['slug'])) ?>"><?= e($svc['nav_label']) ?></a></dd></div>
                        <div><dt>Published</dt><dd><time datetime="<?= e($video['date']) ?>"><?= e(date('j F Y', strtotime($video['date']))) ?></time></dd></div>
                    </dl>
                    <div class="page-hero__actions" data-hero-rise style="--i:4">
                        <a class="btn btn--cta btn--lg" href="<?= e(quote_url($svc['slug'])) ?>" data-track="quote-video"><?= e(business()['offer_short']) ?> <?= icon('arrow', 'icon icon--sm') ?></a>
                        <a class="btn btn--whatsapp btn--lg" href="<?= e(whatsapp_url($svcLower)) ?>" target="_blank" rel="noopener" data-track="whatsapp-video"><?= icon('whatsapp', 'icon icon--sm') ?> WhatsApp</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="about-video">
            <div class="container container--narrow prose">
                <h2 id="about-video">About this video</h2>
                <?php foreach ($video['about'] as $para): ?><p><?= e($para) ?></p><?php endforeach; ?>
                <p><a class="link-arrow" href="<?= e(service_url($svc['slug'])) ?>"><?= e($svc['h1']) ?> in <?= e(business()['region']) ?> <?= icon('arrow', 'icon icon--sm') ?></a></p>
                <?php render_partial('state-groups', [
                    'locations' => cities_for_service($svc['slug']),
                    'tag'       => 'h3',
                    'href'      => static fn(array $c): string => service_location_url($svc['slug'], $c['slug']),
                    'label'     => static fn(array $c): string => $svc['nav_label'] . ' in ' . city_short_name($c),
                ]); ?>
            </div>
        </section>
    </article>

    <?php if ($others): ?>
        <section class="section section--tint" aria-labelledby="more-videos">
            <div class="container">
                <?php render_partial('section-head', ['kicker' => 'Keep watching', 'title' => 'More installation videos', 'id' => 'more-videos']); ?>
                <?php render_partial('video-cards', ['videos' => $others]); ?>
            </div>
        </section>
    <?php endif; ?>

    <?php render_partial('cta-band', ['title' => 'Want this at your home? Book a free site visit', 'quoteHref' => quote_url($svc['slug']), 'waAbout' => $svcLower]); ?>
</main>
<?php
json_ld(video_schema($video));
render_partial('footer');
