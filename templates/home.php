<?php
/**
 * Home — targets "invisible grills & safety nets in Andhra Pradesh" and gives
 * all five services equal weight: a cinematic slideshow with one slide per
 * service (partials/hero-slider.php), a tabbed service explorer, and a
 * three-way comparison — no single service leads.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p        = config_get('pages')['home'];
$biz      = business();
$services = get_all_services();
$cities   = get_all_locations();
[$firstHero] = service_images(array_key_first($services))['hero'];

$seo = [
    'title'       => $p['title'],
    'description' => $p['description'],
    'keywords'    => $p['keywords'],
    'path'        => '/',
];
render_partial('head', ['seo' => $seo, 'preload' => $firstHero, 'preloadSizes' => '(max-width: 767px) 160vw, 100vw', 'preloadPhoneHigh' => false, 'bodyClass' => 'page-home', 'styles' => ['hero']]);
render_partial('header');

// Two photos per service for the work rail, interleaved so no service leads.
$workItems = [];
for ($i = 0; $i < 2; $i++) {
    foreach ($services as $svc) {
        $g = service_images($svc['slug'])['gallery'];
        if (isset($g[$i + 1])) {
            $workItems[] = $g[$i + 1];
        }
    }
}
$posts = array_slice(get_all_posts(), 0, 3, true);
?>
<main id="main">

    <?php render_partial('hero-slider', ['services' => $services, 'p' => $p]); ?>

    <section class="intro-band" aria-label="About our work">
        <div class="container intro-band__inner" data-reveal-group>
            <p class="intro-band__lead" data-reveal><?= rich($p['lead']) ?></p>
            <ul class="trust" data-reveal>
                <?php if (years_label() !== ''): ?><li><?= icon('shield', 'icon icon--sm') ?><?= e(years_label()) ?> experience</li><?php endif; ?>
                <li><?= icon('ruler', 'icon icon--sm') ?><?= e($biz['offer']) ?></li>
                <li><?= icon('doc', 'icon icon--sm') ?>Written quote</li>
                <li><?= icon('pin', 'icon icon--sm') ?><?= count($cities) ?> cities</li>
            </ul>
            <div class="intro-band__actions" data-reveal>
                <a class="btn btn--whatsapp" href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener" data-track="whatsapp-intro"><?= icon('whatsapp', 'icon icon--sm') ?> WhatsApp a photo</a>
                <a class="btn btn--outline" href="<?= e(tel_href()) ?>" data-track="call-intro"><?= icon('phone', 'icon icon--sm') ?> <?= e($biz['phone_display']) ?></a>
            </div>
        </div>
    </section>

    <div class="ticker" aria-hidden="true">
        <div class="ticker__track">
            <?php for ($loop = 0; $loop < 2; $loop++): ?>
                <?php foreach ($services as $svc): ?><span><?= e($svc['nav_label']) ?></span><?php endforeach; ?>
                <?php foreach ($cities as $city): ?><span class="ticker__city"><?= e($city['nickname'] ?: $city['name']) ?></span><?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>

    <section class="section" aria-labelledby="services-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $p['services_kicker'], 'title' => $p['services_title'], 'note' => $p['services_note'], 'id' => 'services-title']); ?>

            <div class="showcase" data-reveal-group>
                <?php foreach ($services as $svc): [$scPhoto, $scAlt] = service_main_photo($svc['slug']); ?>
                    <article class="showcase__card" data-reveal>
                        <div class="showcase__media">
                            <?= photo($scPhoto, $scAlt, ['sizes' => '(min-width: 1024px) 40vw, (min-width: 768px) 46vw, 92vw', 'want' => 800]) ?>
                            <span class="showcase__badge"><?= icon($svc['icon'], 'icon icon--sm') ?> <?= e($svc['card_note']) ?></span>
                        </div>
                        <div class="showcase__body">
                            <p class="showcase__kicker"><?= e($svc['tagline']) ?></p>
                            <h3 class="showcase__title"><a href="<?= e(service_url($svc['slug'])) ?>"><?= e($svc['h1']) ?></a></h3>
                            <p class="showcase__text"><?= e($svc['card_summary']) ?></p>
                            <ul class="ticks showcase__ticks">
                                <?php foreach ($svc['feats'] as $feat): ?><li><?= icon('check', 'icon icon--sm') ?><?= e($feat) ?></li><?php endforeach; ?>
                            </ul>
                            <span class="showcase__more" aria-hidden="true">Explore <?= e(str_lower($svc['nav_label'])) ?> <?= icon('arrow', 'icon icon--sm') ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php render_partial('video-showcase', [
        'videos' => service_videos('invisible-grills', true),
        'kicker' => $p['video_kicker'],
        'title'  => $p['video_title'],
        'note'   => $p['video_note'],
        'id'     => 'video-title',
        'link'   => ['Explore invisible grills', service_url('invisible-grills')],
        'tint'   => true,
    ]); ?>

    <section class="stats" aria-label="<?= e(SITE_SHORT_NAME) ?> at a glance">
        <div class="stats__cables" aria-hidden="true"></div>
        <div class="container stats__grid" data-reveal-group>
            <?php foreach ($p['stats'] as $stat):
                $value = ['years' => $biz['years_experience'], 'services' => count($services), 'cities' => count($cities)][$stat['value']] ?? null;
                if (!$value) { continue; } ?>
                <div class="stats__item" data-reveal>
                    <span class="stats__value" data-count="<?= (int) $value ?>"<?= $stat['value'] === 'years' ? ' data-suffix="+"' : '' ?>><?= (int) $value ?><?= $stat['value'] === 'years' ? '+' : '' ?></span>
                    <span class="stats__label"><?= e($stat['label']) ?></span>
                </div>
            <?php endforeach; ?>
            <div class="stats__item" data-reveal>
                <span class="stats__value stats__value--word">Free</span>
                <span class="stats__label"><?= e($p['stats_offer_label']) ?></span>
            </div>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="compare-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $p['compare_kicker'], 'title' => $p['compare_title'], 'note' => $p['compare_note'], 'id' => 'compare-title']); ?>
            <div class="compare compare--three" data-reveal>
                <table class="compare__table">
                    <caption class="sr-only"><?= e($p['compare_title']) ?></caption>
                    <thead>
                        <tr>
                            <th scope="col"><span class="sr-only">Feature</span></th>
                            <?php foreach ($p['compare']['cols'] as $col): ?><th scope="col"><?= e($col) ?></th><?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($p['compare']['rows'] as $row): ?>
                            <tr>
                                <th scope="row"><?= e($row['label']) ?></th>
                                <?php foreach ($row['cells'] as $cell): ?><td><?= e($cell) ?></td><?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php $comparePost = get_post($p['compare']['more']); if ($comparePost): ?>
                <p class="section__more"><a class="link-arrow" href="<?= e(post_url($comparePost['slug'])) ?>">Read: <?= e($comparePost['title']) ?> <?= icon('arrow', 'icon icon--sm') ?></a></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section" aria-labelledby="why-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $p['why_kicker'], 'title' => $p['why_title'], 'note' => $p['why_note'], 'id' => 'why-title']); ?>
            <?php render_partial('why-us'); ?>
        </div>
    </section>

    <section class="section section--dark" aria-labelledby="process-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $p['process_kicker'], 'title' => $p['process_title'], 'id' => 'process-title']); ?>
            <?php render_partial('process'); ?>
        </div>
    </section>

    <section class="section" aria-labelledby="work-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $p['work_kicker'], 'title' => $p['work_title'], 'id' => 'work-title']); ?>
        </div>
        <?php render_partial('gallery-rail', ['items' => $workItems, 'allHref' => '/gallery.php']); ?>
    </section>

    <section class="section section--tint" aria-labelledby="areas-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $p['areas_kicker'], 'title' => $p['areas_title'], 'note' => $p['areas_note'], 'id' => 'areas-title']); ?>
            <?php render_partial('area-rail'); ?>
            <p class="section__more"><a class="link-arrow" href="/service-areas.php">Find your locality <?= icon('arrow', 'icon icon--sm') ?></a></p>
        </div>
    </section>

    <?php render_partial('testimonials'); ?>

    <section class="section" aria-labelledby="blog-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => $p['blog_kicker'], 'title' => $p['blog_title'], 'id' => 'blog-title']); ?>
            <div class="post-grid" data-reveal-group>
                <?php foreach ($posts as $post) { render_partial('blog-card', ['post' => $post]); } ?>
            </div>
        </div>
    </section>

    <section class="section section--tint" aria-labelledby="faq-title">
        <div class="container container--narrow">
            <?php render_partial('section-head', ['kicker' => $p['faq_kicker'], 'title' => $p['faq_title'], 'id' => 'faq-title', 'align' => 'center']); ?>
            <?php render_partial('faq', ['faqs' => $p['faqs']]); ?>
        </div>
    </section>

    <?php render_partial('cta-band', ['title' => $p['cta_title'], 'text' => $p['cta_text']]); ?>
</main>
<?php
render_partial('schema/website');
render_partial('footer');
