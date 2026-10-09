<?php
/**
 * Brand lockup — used in the header, the drawer and the footer, so the logo
 * looks identical everywhere.
 *
 * The mark is the client's logo (source-images/brand/logo-original.png,
 * cleaned and squared into logo-mark.png by tools/clean-logo.cjs; sizes by
 * tools/make-brand-assets.cjs). Its house, grills and family are drawn in a
 * near-black brown that would vanish on the site's dark header, menu and
 * footer, so the mark always sits on a white tile — on white every detail
 * reads at > 16 : 1 and the orange roof and swoosh stay vivid.
 *
 * Motion (CSS, layout.css → "brand"): a soft light sweeps across the tile
 * every few seconds; the wordmark keeps its slow metallic flow. Still under
 * prefers-reduced-motion. The image is decorative (alt=""): the link's
 * aria-label names the business.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}
?>
<a class="brand" href="/" aria-label="<?= e(SITE_NAME) ?> — home">
    <span class="brand__tile">
        <img class="brand__img"
             src="<?= e(asset('/assets/images/brand/logo-mark-40.webp')) ?>"
             srcset="<?= e(asset('/assets/images/brand/logo-mark-40.webp')) ?> 1x, <?= e(asset('/assets/images/brand/logo-mark-80.webp')) ?> 2x, <?= e(asset('/assets/images/brand/logo-mark-120.webp')) ?> 3x"
             width="40" height="40" alt="" decoding="async">
    </span>
    <span class="brand__text">
        <span class="brand__name"><?= e(SITE_SHORT_NAME) ?></span>
        <span class="brand__tag">Invisible Grills &amp; Safety Nets</span>
    </span>
</a>
