<?php
/**
 * Footer, floating call/WhatsApp buttons, the sitewide business schema, and
 * the closing tags. Contact details render from config/business.php and
 * skip anything not supplied (no address line until the client gives one).
 *
 * Optional $skipBusinessSchema: a page emitting its own business entity sets
 * it, so a page never carries two.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$footBiz = business();
?>
<footer class="site-footer" id="site-footer">
    <div class="site-footer__cables" aria-hidden="true"></div>
    <div class="container site-footer__grid">
        <div class="site-footer__brand">
            <?php render_partial('logo'); ?>
            <p class="site-footer__blurb"><?= e($footBiz['footer_blurb']) ?></p>
            <ul class="contact-list">
                <li><?= icon('phone', 'icon icon--sm') ?><a href="<?= e(tel_href()) ?>" data-track="call-footer"><?= e($footBiz['phone_display']) ?></a></li>
                <?php if (!empty($footBiz['alt_phone_display'])): ?>
                    <li><?= icon('phone', 'icon icon--sm') ?><a href="<?= e(tel_href($footBiz['alt_phone_e164'])) ?>"><?= e($footBiz['alt_phone_display']) ?></a></li>
                <?php endif; ?>
                <li><?= icon('mail', 'icon icon--sm') ?><a href="mailto:<?= e($footBiz['email']) ?>"><?= e($footBiz['email']) ?></a></li>
                <?php if (!empty($footBiz['address'])): ?>
                    <li><?= icon('pin', 'icon icon--sm') ?><span><?= e(implode(', ', array_filter($footBiz['address']))) ?></span></li>
                <?php else: ?>
                    <li><?= icon('pin', 'icon icon--sm') ?><span>Serving <?= e(business()['region']) ?></span></li>
                <?php endif; ?>
                <?php if (!empty($footBiz['opening_hours'])): ?>
                    <li><?= icon('clock', 'icon icon--sm') ?><span><?= e($footBiz['opening_hours']) ?></span></li>
                <?php endif; ?>
            </ul>
        </div>

        <nav class="site-footer__col" aria-label="Services">
            <h2 class="site-footer__title">Services</h2>
            <ul>
                <?php foreach (get_all_services() as $footSvc): ?>
                    <li><a href="<?= e(service_url($footSvc['slug'])) ?>"><?= e($footSvc['nav_label']) ?></a></li>
                <?php endforeach; ?>
                <li><a href="/services.php">All services</a></li>
            </ul>
        </nav>

        <nav class="site-footer__col site-footer__col--areas" aria-label="Service areas">
            <h2 class="site-footer__title">Service areas</h2>
            <?php foreach (locations_by_state() as $footStateKey => $footCities): ?>
                <h3 class="site-footer__state"><?= e(get_states()[$footStateKey]['name']) ?></h3>
                <ul class="site-footer__places site-footer__places--<?= e($footStateKey) ?>">
                    <?php foreach ($footCities as $footCity): ?>
                        <li><a href="<?= e(city_url($footCity['slug'])) ?>"><?= e(city_short_name($footCity)) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
            <ul><li><a href="/service-areas.php">Near me — all areas</a></li></ul>
        </nav>

        <nav class="site-footer__col" id="footer-nav" aria-label="Company">
            <h2 class="site-footer__title">Company</h2>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about-us.php">About us</a></li>
                <li><a href="/gallery.php">Gallery</a></li>
                <li><a href="/videos.php">Videos</a></li>
                <li><a href="/blog.php">Blog</a></li>
                <li><a href="/contact-us.php">Contact &amp; free quote</a></li>
            </ul>
        </nav>
    </div>

    <div class="container site-footer__bottom">
        <p>&copy; <?= date('Y') ?> <?= e($footBiz['name']) ?>. All rights reserved.</p>
        <nav class="site-footer__legal" aria-label="Sitemap">
            <a href="/sitemap.php">Sitemap</a>
            <a href="/sitemap.xml">XML sitemap</a>
        </nav>
        <button class="to-top" type="button" data-to-top><?= icon('arrow-up', 'icon icon--sm') ?> Back to top</button>
    </div>
</footer>

<button class="to-top-fab" type="button" aria-label="Back to top" data-to-top data-to-top-fab><?= icon('arrow-up') ?></button>

<div class="fab" aria-label="Quick contact">
    <a class="fab__btn fab__btn--call" href="<?= e(tel_href()) ?>" aria-label="Call <?= e($footBiz['phone_display']) ?>" data-track="call-fab"><?= icon('phone') ?></a>
    <a class="fab__btn fab__btn--whatsapp" href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener" aria-label="WhatsApp us" data-track="whatsapp-fab"><?= icon('whatsapp') ?></a>
</div>

<?php
if (empty($skipBusinessSchema)) {
    render_partial('schema/business');
}
// Last: every icon() call on the page has run by now.
icon_sprite();
?>
</body>
</html>
