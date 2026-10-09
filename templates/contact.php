<?php
/**
 * Contact & quote — /contact-us.php.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p   = config_get('pages')['contact'];
$biz = business();
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];
render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-contact']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['Contact us', $path]], 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead'], 'secondary' => ['Jump to the form', '#quote']]); ?>

    <section class="section" aria-labelledby="ways-title">
        <div class="container contact-layout">
            <div class="contact-ways" data-reveal-group>
                <h2 id="ways-title" data-reveal><?= e($p['ways_title']) ?></h2>
                <a class="way" href="<?= e(tel_href()) ?>" data-reveal data-track="call-contact">
                    <span class="way__icon"><?= icon('phone') ?></span>
                    <span><span class="way__label">Call</span><span class="way__value"><?= e($biz['phone_display']) ?></span></span>
                </a>
                <a class="way way--whatsapp" href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener" data-reveal data-track="whatsapp-contact">
                    <span class="way__icon"><?= icon('whatsapp') ?></span>
                    <span><span class="way__label">WhatsApp — send a photo</span><span class="way__value"><?= e($biz['phone_display']) ?></span></span>
                </a>
                <?php if (!empty($biz['alt_phone_display'])): ?>
                    <a class="way" href="<?= e(tel_href($biz['alt_phone_e164'])) ?>" data-reveal>
                        <span class="way__icon"><?= icon('phone') ?></span>
                        <span><span class="way__label">Alternate number</span><span class="way__value"><?= e($biz['alt_phone_display']) ?></span></span>
                    </a>
                <?php endif; ?>
                <a class="way" href="mailto:<?= e($biz['email']) ?>" data-reveal>
                    <span class="way__icon"><?= icon('mail') ?></span>
                    <span><span class="way__label">Email</span><span class="way__value way__value--sm"><?= e($biz['email']) ?></span></span>
                </a>
                <?php if (!empty($biz['address'])): ?>
                    <div class="way" data-reveal>
                        <span class="way__icon"><?= icon('pin') ?></span>
                        <span><span class="way__label">Address</span><span class="way__value way__value--sm"><?= e(implode(', ', array_filter($biz['address']))) ?></span></span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($biz['opening_hours'])): ?>
                    <div class="way" data-reveal>
                        <span class="way__icon"><?= icon('clock') ?></span>
                        <span><span class="way__label">Hours</span><span class="way__value way__value--sm"><?= e($biz['opening_hours']) ?></span></span>
                    </div>
                <?php endif; ?>

                <div class="panel" data-reveal>
                    <h3 class="panel__title"><?= icon('pin', 'icon icon--sm') ?> <?= e($p['cover_title']) ?></h3>
                    <ul class="chips">
                        <?php foreach (get_all_locations() as $city): ?>
                            <li><a class="chip" href="<?= e(city_url($city['slug'])) ?>"><?= e($city['nickname'] ?: $city['name']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div data-reveal>
                <?php render_partial('enquiry-form'); ?>
            </div>
        </div>
    </section>

    <section class="section section--dark" aria-labelledby="process-title">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'What happens next', 'title' => 'From your message to a finished job', 'id' => 'process-title']); ?>
            <?php render_partial('process'); ?>
        </div>
    </section>
</main>
<?php render_partial('footer'); ?>
