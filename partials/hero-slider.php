<?php
/**
 * Home hero: a cinematic slideshow with one full-bleed slide per service.
 *
 * Layers, back to front:
 *   .hero__bgs   one full-bleed photo per slide; the active one crossfades
 *                in and slowly pulls back (a zoom-out drift, a different
 *                path per slide — CSS keyframes in hero.css)
 *   .hero__shade a deliberately light shade — just enough behind the copy
 *                column and the controls for the text to stay readable, so
 *                the photo itself stays clearly visible
 *   content      the page's single H1 (constant) with the service cities
 *                under it, then the slide stage — number, service, title,
 *                tagline, summary, features and the "Explore" button — and
 *                an "at a glance" spec card on desktop
 *   controls     a nav bar naming every service with a progress line, plus
 *                previous / next / pause
 *
 * The header sits transparent over the top of this section (layout.css).
 *
 * Behaviour lives in assets/js/site.js (jQuery): autoplay 7 s, stop on
 * hover over the controls / keyboard focus, pause button, arrow keys,
 * swipe, and no autoplay under reduced motion (WCAG 2.2.2). Text entrances
 * come from motion.js. Without JS the first slide shows and each nav tab
 * links to its service page.
 *
 * Only the first background loads up front (the LCP image, preloaded in
 * <head>). The others are lazy and display:none until site.js adds
 * .is-loaded after the page's load event — a lazy image that is not
 * displayed is never fetched, so the first photo gets the bandwidth.
 *
 * Expects $services, $p (home copy).
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$heroCities = count(get_all_locations());
$slideCount = count($services);
?>
<section class="hero" aria-labelledby="hero-title" data-hero>
    <div class="hero__bgs">
        <?php $bgIndex = 0; foreach ($services as $svc):
            [$bgName, $bgAlt] = service_images($svc['slug'])['hero'];
            ?>
            <div class="hero__bg hero__bg--<?= $bgIndex + 1 ?><?= $bgIndex === 0 ? ' is-active' : '' ?>" data-hero-bg>
                <?= photo($bgName, $bgAlt, ['eager' => $bgIndex === 0, 'priority' => false, 'sizes' => '(max-width: 767px) 160vw, 100vw', 'want' => 1024, 'class' => 'hero__img']) ?>
            </div>
        <?php $bgIndex++; endforeach; ?>
    </div>
    <div class="hero__shade" aria-hidden="true"></div>

    <div class="container hero__layout">
        <header class="hero__head">
            <h1 class="hero__h1" id="hero-title"><?= e($p['h1']) ?></h1>
            <p class="hero__places"><?= icon('pin', 'icon icon--sm') ?> <?= e($p['eyebrow']) ?></p>
        </header>

        <div class="hero__stage" aria-roledescription="carousel" aria-label="Our services" data-hero-stage>
            <div class="hero__live" aria-live="off" data-hero-live>
                <?php $slideIndex = 0; foreach ($services as $svc):
                    $isFirst = $slideIndex === 0;
                    ?>
                    <article class="slide<?= $isFirst ? ' is-active' : '' ?>" id="slide-<?= e($svc['slug']) ?>" role="group" aria-roledescription="slide" aria-label="<?= $slideIndex + 1 ?> of <?= $slideCount ?>: <?= e($svc['nav_label']) ?>" data-slide<?= $isFirst ? '' : ' aria-hidden="true" inert' ?>>
                        <div class="slide__content">
                            <p class="slide__kicker" data-slide-anim>
                                <span class="slide__num"><?= str_pad((string) ($slideIndex + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <span class="slide__rule" aria-hidden="true"></span>
                                <span class="slide__service"><?= icon($svc['icon'], 'icon icon--sm') ?> <?= e($svc['nav_label']) ?></span>
                            </p>
                            <h2 class="slide__title" data-slide-anim><?= e($svc['h1']) ?></h2>
                            <p class="slide__tagline" data-slide-anim><?= e($svc['tagline']) ?></p>
                            <p class="slide__text" data-slide-anim><?= e($svc['card_summary']) ?></p>
                            <ul class="slide__feats" data-slide-anim>
                                <?php foreach ($svc['feats'] as $feat): ?><li><?= icon('check', 'icon icon--sm') ?><?= e($feat) ?></li><?php endforeach; ?>
                            </ul>
                            <div class="slide__actions" data-slide-anim>
                                <a class="btn btn--cta btn--lg" href="<?= e(service_url($svc['slug'])) ?>">Explore <?= e(str_lower($svc['nav_label'])) ?> <?= icon('arrow', 'icon icon--sm') ?></a>
                            </div>
                        </div>
                        <aside class="slide__card" data-slide-anim aria-label="<?= e($svc['nav_label']) ?> at a glance">
                            <p class="slide__card-title">At a glance</p>
                            <dl class="slide__specs">
                                <?php foreach (array_slice($svc['specs'], 0, 3) as $spec): ?>
                                    <div><dt><?= e($spec['label']) ?></dt><dd><?= e($spec['value']) ?></dd></div>
                                <?php endforeach; ?>
                            </dl>
                            <p class="slide__card-foot"><?= icon('pin', 'icon icon--sm') ?> Fitted across <?= $heroCities ?> cities in Andhra Pradesh</p>
                        </aside>
                    </article>
                <?php $slideIndex++; endforeach; ?>
            </div>
        </div>

        <div class="hero__controls">
            <nav class="hero__nav" aria-label="Choose a service slide">
                <?php $navIndex = 0; foreach ($services as $svc): ?>
                    <a class="hero__tab<?= $navIndex === 0 ? ' is-active' : '' ?>" href="<?= e(service_url($svc['slug'])) ?>" data-slide-to="<?= $navIndex ?>" aria-controls="slide-<?= e($svc['slug']) ?>"<?= $navIndex === 0 ? ' aria-current="true"' : '' ?>>
                        <span class="hero__tab-num"><?= str_pad((string) ($navIndex + 1), 2, '0', STR_PAD_LEFT) ?></span>
                        <span class="hero__tab-label"><?= e($svc['nav_label']) ?></span>
                        <span class="hero__tab-bar" aria-hidden="true"><span></span></span>
                    </a>
                <?php $navIndex++; endforeach; ?>
            </nav>
            <div class="hero__buttons">
                <button class="hero__btn" type="button" data-hero-prev aria-label="Previous slide"><?= icon('arrow', 'icon icon--sm icon--flip') ?></button>
                <button class="hero__btn" type="button" data-hero-pause aria-label="Pause slideshow" aria-pressed="false">
                    <span class="hero__pause-icon" aria-hidden="true"></span>
                </button>
                <button class="hero__btn" type="button" data-hero-next aria-label="Next slide"><?= icon('arrow', 'icon icon--sm') ?></button>
            </div>
        </div>
    </div>
</section>
