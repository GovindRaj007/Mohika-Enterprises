<?php
/**
 * Fixed header + mobile drawer. Menus are built from config — no service or
 * city is named here. jQuery (assets/js/nav.js) runs the dropdowns, drawer,
 * focus trap and hide-on-scroll; without JS the dropdowns still open on
 * hover/focus and a "Menu" link jumps to the footer navigation.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$navCurrent  = current_path();
$navServices = get_all_services();
$navByState  = locations_by_state();
$navPages = [
    '/gallery.php'    => 'Gallery',
    '/about-us.php'   => 'About',
    '/blog.php'       => 'Blog',
    '/contact-us.php' => 'Contact',
];
$navAria = static fn(string $href): string => $href === $navCurrent ? ' aria-current="page"' : '';
$navIsServices = $navCurrent !== null && (isset(route_table()[$navCurrent]) && in_array(route_table()[$navCurrent][2], ['service', 'service-location'], true) || $navCurrent === '/services.php');
$navIsAreas    = $navCurrent !== null && (isset(route_table()[$navCurrent]) && route_table()[$navCurrent][2] === 'city' || $navCurrent === '/service-areas.php');
?>
<header class="site-header" data-header>
    <div class="container site-header__bar">
        <?php render_partial('logo'); ?>

        <nav class="nav" aria-label="Primary">
            <ul class="nav__list">
                <li class="nav__item nav__item--menu<?= $navIsServices ? ' is-current' : '' ?>">
                    <button class="nav__link nav__toggle" type="button" aria-expanded="false" aria-controls="menu-services">
                        Services <?= icon('chevron', 'icon icon--sm') ?>
                    </button>
                    <div class="mega" id="menu-services" data-dropdown>
                        <div class="mega__grid">
                            <?php foreach ($navServices as $navSvc): ?>
                                <a class="mega__item" href="<?= e(service_url($navSvc['slug'])) ?>"<?= $navAria(service_url($navSvc['slug'])) ?>>
                                    <span class="mega__icon"><?= icon($navSvc['icon']) ?></span>
                                    <span>
                                        <span class="mega__title"><?= e($navSvc['nav_label']) ?></span>
                                        <span class="mega__note"><?= e($navSvc['card_note']) ?></span>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <a class="mega__all" href="/services.php">All services <?= icon('arrow', 'icon icon--sm') ?></a>
                    </div>
                </li>
                <li class="nav__item nav__item--menu<?= $navIsAreas ? ' is-current' : '' ?>">
                    <button class="nav__link nav__toggle" type="button" aria-expanded="false" aria-controls="menu-areas">
                        Areas <?= icon('chevron', 'icon icon--sm') ?>
                    </button>
                    <div class="mega mega--areas" id="menu-areas" data-dropdown>
                        <div class="mega__states">
                            <?php foreach ($navByState as $navStateKey => $navStateCities): ?>
                                <div class="mega__state mega__state--<?= e($navStateKey) ?>">
                                    <p class="mega__state-title"><?= icon('pin', 'icon icon--sm') ?> <?= e(get_states()[$navStateKey]['name']) ?></p>
                                    <ul class="mega__places">
                                        <?php foreach ($navStateCities as $navCity): ?>
                                            <li><a class="mega__place<?= !empty($navCity['parent']) ? ' mega__place--area' : '' ?>" href="<?= e(city_url($navCity['slug'])) ?>"<?= $navAria(city_url($navCity['slug'])) ?>><?= e(city_short_name($navCity)) ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="mega__all" href="/service-areas.php">All service areas <?= icon('arrow', 'icon icon--sm') ?></a>
                    </div>
                </li>
                <?php foreach ($navPages as $navHref => $navLabel): ?>
                    <li class="nav__item"><a class="nav__link" href="<?= e($navHref) ?>"<?= $navAria($navHref) ?>><?= e($navLabel) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="site-header__actions">
            <a class="header-phone" href="<?= e(tel_href()) ?>" data-track="call-header">
                <?= icon('phone', 'icon icon--sm') ?><span><?= e(business()['phone_display']) ?></span>
            </a>
            <a class="btn btn--cta btn--sm site-header__quote" href="<?= e(quote_url()) ?>" data-track="quote-header">Free quote</a>
            <button class="burger" type="button" aria-expanded="false" aria-controls="drawer" aria-label="Open menu" data-drawer-toggle>
                <span></span><span></span><span></span>
            </button>
            <a class="menu-nojs" href="#footer-nav">Menu</a>
        </div>
    </div>
</header>

<div class="drawer" id="drawer" data-drawer data-lenis-prevent hidden>
    <div class="drawer__backdrop" data-drawer-close></div>
    <div class="drawer__panel" role="dialog" aria-modal="true" aria-label="Main menu">
        <div class="drawer__head">
            <?php render_partial('logo'); ?>
            <button class="drawer__close" type="button" aria-label="Close menu" data-drawer-close><?= icon('close') ?></button>
        </div>
        <nav class="drawer__nav" aria-label="Main menu">
            <a class="drawer__link" href="/"<?= $navAria('/') ?>>Home</a>

            <div class="drawer__group">
                <button class="drawer__link drawer__acc" type="button" aria-expanded="false" aria-controls="drawer-services">
                    Services <?= icon('chevron', 'icon icon--sm') ?>
                </button>
                <div class="drawer__sub" id="drawer-services" hidden>
                    <?php foreach ($navServices as $navSvc): ?>
                        <a href="<?= e(service_url($navSvc['slug'])) ?>"<?= $navAria(service_url($navSvc['slug'])) ?>><?= icon($navSvc['icon'], 'icon icon--sm') ?><?= e($navSvc['nav_label']) ?></a>
                    <?php endforeach; ?>
                    <a href="/services.php"<?= $navAria('/services.php') ?>>All services</a>
                </div>
            </div>

            <div class="drawer__group">
                <button class="drawer__link drawer__acc" type="button" aria-expanded="false" aria-controls="drawer-areas">
                    Service areas <?= icon('chevron', 'icon icon--sm') ?>
                </button>
                <div class="drawer__sub" id="drawer-areas" hidden>
                    <?php foreach ($navByState as $navStateKey => $navStateCities): ?>
                        <div class="drawer__group drawer__group--state">
                            <button class="drawer__acc drawer__acc--state" type="button" aria-expanded="false" aria-controls="drawer-state-<?= e($navStateKey) ?>">
                                <?= e(get_states()[$navStateKey]['name']) ?> <?= icon('chevron', 'icon icon--sm') ?>
                            </button>
                            <div class="drawer__sub drawer__sub--state" id="drawer-state-<?= e($navStateKey) ?>" hidden>
                                <?php foreach ($navStateCities as $navCity): ?>
                                    <div class="drawer__group drawer__group--city">
                                        <button class="drawer__acc drawer__acc--city" type="button" aria-expanded="false" aria-controls="drawer-city-<?= e($navCity['slug']) ?>">
                                            <?= e(city_short_name($navCity)) ?> <?= icon('chevron', 'icon icon--sm') ?>
                                        </button>
                                        <div class="drawer__sub drawer__sub--city" id="drawer-city-<?= e($navCity['slug']) ?>" hidden>
                                            <?php foreach (services_in_city($navCity['slug']) as $navSvc): ?>
                                                <a href="<?= e(service_location_url($navSvc['slug'], $navCity['slug'])) ?>"<?= $navAria(service_location_url($navSvc['slug'], $navCity['slug'])) ?>><?= e($navSvc['nav_label']) ?></a>
                                            <?php endforeach; ?>
                                            <a href="<?= e(city_url($navCity['slug'])) ?>"<?= $navAria(city_url($navCity['slug'])) ?>>All services in <?= e(city_short_name($navCity)) ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <a href="/service-areas.php"<?= $navAria('/service-areas.php') ?>>All service areas</a>
                </div>
            </div>

            <?php foreach ($navPages as $navHref => $navLabel): ?>
                <a class="drawer__link" href="<?= e($navHref) ?>"<?= $navAria($navHref) ?>><?= e($navLabel) ?></a>
            <?php endforeach; ?>
        </nav>
        <div class="drawer__foot">
            <a class="btn btn--cta btn--block" href="<?= e(quote_url()) ?>"><?= e(business()['offer']) ?></a>
            <div class="drawer__contact">
                <a class="btn btn--ghost-light" href="<?= e(tel_href()) ?>"><?= icon('phone', 'icon icon--sm') ?> Call</a>
                <a class="btn btn--whatsapp" href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 'icon icon--sm') ?> WhatsApp</a>
            </div>
        </div>
    </div>
</div>
