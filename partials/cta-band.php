<?php
/**
 * Closing call-to-action band. $title (required), optional $text,
 * $quoteHref (pre-selects a service/city on the form), $waAbout (WhatsApp
 * prefill), $kicker and $button (supply pages: no site-visit wording). Marked data-boilerplate for the uniqueness checker.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$ctaBiz = business();
?>
<section class="cta-band" aria-labelledby="cta-title" data-boilerplate>
    <div class="cta-band__cables" aria-hidden="true"></div>
    <div class="container cta-band__inner" data-reveal-group>
        <div>
            <p class="kicker kicker--light" data-reveal><?= e($kicker ?? $ctaBiz['offer']) ?></p>
            <h2 class="cta-band__title" id="cta-title" data-reveal><?= e($title) ?></h2>
            <p class="cta-band__text" data-reveal><?= e($text ?? 'Send a photo of the opening on WhatsApp or call — we will measure, show you the material and give a written quote.') ?></p>
        </div>
        <div class="cta-band__actions" data-reveal>
            <a class="btn btn--cta btn--lg" href="<?= e($quoteHref ?? quote_url()) ?>" data-track="quote-cta"><?= e($button ?? 'Get a free quote') ?> <?= icon('arrow', 'icon icon--sm') ?></a>
            <a class="btn btn--whatsapp btn--lg" href="<?= e(whatsapp_url($waAbout ?? '')) ?>" target="_blank" rel="noopener" data-track="whatsapp-cta"><?= icon('whatsapp', 'icon icon--sm') ?> WhatsApp</a>
            <a class="btn btn--ghost-light btn--lg" href="<?= e(tel_href()) ?>" data-track="call-cta"><?= icon('phone', 'icon icon--sm') ?> <?= e($ctaBiz['phone_display']) ?></a>
        </div>
    </div>
</section>
