<?php
/**
 * 404 — noindex, and no canonical (no 'path'), so it never self-canonicalises.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$seo = [
    'title'       => 'Page not found | ' . SITE_SHORT_NAME,
    'description' => 'That page does not exist. Browse our services or service areas, or call us.',
    'robots'      => 'noindex, follow',
];
render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-404']);
render_partial('header');
?>
<main id="main">
    <section class="page-hero page-hero--center">
        <div class="page-hero__cables" aria-hidden="true"></div>
        <div class="container container--narrow center">
            <p class="eyebrow">Error 404</p>
            <h1 class="page-hero__title">This page has slipped through the net</h1>
            <p class="page-hero__lead">The link may be old or mistyped. Try one of these instead.</p>
            <div class="page-hero__actions page-hero__actions--center">
                <a class="btn btn--cta btn--lg" href="/">Home</a>
                <a class="btn btn--ghost-light btn--lg" href="/services.php">Services</a>
                <a class="btn btn--ghost-light btn--lg" href="/service-areas.php">Service areas</a>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="svc-grid" data-reveal-group>
                <?php foreach (get_all_services() as $svc) { render_partial('service-card', ['service' => $svc]); } ?>
            </div>
        </div>
    </section>
</main>
<?php render_partial('footer'); ?>
