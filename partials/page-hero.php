<?php
/**
 * Inner-page hero: dark cable band with breadcrumbs, kicker, the page's one
 * H1, a tag line, lead copy, feature badges, the action pair and an optional
 * photo (shown on every viewport — below the copy on phones, beside it from
 * 1024px — so no page opens on text alone).
 *
 * $h1, $tag, $lead (rich), $kicker, $crumbs, $feats[], $photo [name, alt],
 * $mosaic (list of [photo name, alt, label, href, icon] — one tile per
 * service, used on the city hubs instead of a single photo),
 * $quoteHref, $waAbout, $secondary [label, href] (replaces WhatsApp button).
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$heroPhoto  = $photo ?? null;
$heroMosaic = $mosaic ?? [];
?>
<section class="page-hero<?= ($heroPhoto || $heroMosaic) ? ' page-hero--photo' : '' ?>">
    <div class="page-hero__cables" aria-hidden="true"></div>
    <div class="container page-hero__inner">
        <div class="page-hero__copy" data-reveal-group>
            <?php render_partial('breadcrumbs', ['crumbs' => $crumbs ?? []]); ?>
            <?php if (!empty($kicker)): ?>
                <p class="eyebrow" data-reveal><?= icon('pin', 'icon icon--sm') ?> <?= e($kicker) ?></p>
            <?php endif; ?>
            <h1 class="page-hero__title" data-reveal><?= e($h1) ?></h1>
            <?php if (!empty($tag)): ?>
                <p class="page-hero__tag" data-reveal><?= e($tag) ?></p>
            <?php endif; ?>
            <?php if (!empty($lead)): ?>
                <p class="page-hero__lead" data-reveal><?= rich($lead) ?></p>
            <?php endif; ?>
            <?php if (!empty($feats)): ?>
                <ul class="badges" data-reveal>
                    <?php foreach ($feats as $heroFeat): ?>
                        <li><?= icon('check', 'icon icon--sm') ?><?= e($heroFeat) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="page-hero__actions" data-reveal>
                <a class="btn btn--cta btn--lg" href="<?= e($quoteHref ?? quote_url()) ?>" data-track="quote-hero"><?= e(business()['offer_short']) ?> <?= icon('arrow', 'icon icon--sm') ?></a>
                <?php if (!empty($secondary)): ?>
                    <a class="btn btn--ghost-light btn--lg" href="<?= e($secondary[1]) ?>"><?= e($secondary[0]) ?></a>
                <?php else: ?>
                    <a class="btn btn--whatsapp btn--lg" href="<?= e(whatsapp_url($waAbout ?? '')) ?>" target="_blank" rel="noopener" data-track="whatsapp-hero"><?= icon('whatsapp', 'icon icon--sm') ?> WhatsApp</a>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($heroMosaic): ?>
            <div class="page-hero__mosaic">
                <?php foreach ($heroMosaic as $mi => [$mPhoto, $mAlt, $mLabel, $mHref, $mIcon]): ?>
                    <a class="page-hero__tile page-hero__tile--<?= $mi + 1 ?>" href="<?= e($mHref) ?>">
                        <?= photo($mPhoto, $mAlt, ['eager' => $mi < 2, 'priority' => $mi === 0, 'sizes' => '(min-width: 1024px) 22vw, 48vw', 'want' => 480]) ?>
                        <span class="page-hero__tile-label"><?= icon($mIcon, 'icon icon--sm') ?> <?= e($mLabel) ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php elseif ($heroPhoto): ?>
            <figure class="page-hero__media" data-parallax>
                <?= photo($heroPhoto[0], $heroPhoto[1], ['eager' => true, 'sizes' => '(min-width: 1024px) 44vw, 100vw', 'want' => 800]) ?>
                <?php if (!empty($photoLink)): ?>
                    <a class="page-hero__chip" href="<?= e($photoLink) ?>"><?= icon('camera', 'icon icon--sm') ?> View photos</a>
                <?php endif; ?>
            </figure>
        <?php endif; ?>
    </div>
</section>
