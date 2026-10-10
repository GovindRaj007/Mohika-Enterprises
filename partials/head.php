<?php
/**
 * Document head and the opening <body>. Expects $seo; optional $preload
 * (photo name of the LCP image, preloaded with its srcset), $bodyClass, and
 * $styles — page-specific stylesheets (e.g. ['hero'] on the home page).
 * $preloadPhoneHigh = false keeps the preload at normal priority on phones
 * (home: there the hero text, not the photo, is the LCP element, and a
 * high-priority 130 KB photo would hold back the CSS on a slow connection).
 *
 * Fonts are self-hosted (assets/fonts/) and preloaded.
 *
 * Scripts are deferred and run in order: the Motion + Lenis bundle and
 * motion.js first — they need no jQuery, so on-screen reveals start without
 * waiting for its 85 KB — then jQuery 3.7.1 and the files that use it
 * (nav.js: menu, header; site.js: slider, FAQ, filters, form, lightbox). The page is complete and usable with JavaScript off.
 *
 * Reveal animations hide content only under html.motion-ready, which is set
 * here when the visitor has not asked for reduced motion, and removed after
 * 3 s if the motion script never confirmed it booted — so content cannot get
 * stuck invisible on a failed script load.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$gtm = ANALYTICS_GTM_ID;
?>
<!DOCTYPE html>
<html lang="en-IN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php if ($gtm !== ''): ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($gtm) ?>');</script>
<?php endif; ?>
<script>
(function (d) {
  var h = d.documentElement;
  h.classList.add('js');
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
    h.classList.add('motion-ready');
    setTimeout(function () { if (!window.__motion) { h.classList.remove('motion-ready'); } }, 3000);
  }
})(document);
</script>
<?php render_seo_head($seo); ?>
<meta name="theme-color" content="#18171b">
<meta name="format-detection" content="telephone=no">
<link rel="preload" as="font" type="font/woff2" href="/assets/fonts/lexend-latin.woff2" crossorigin>
<link rel="preload" as="font" type="font/woff2" href="/assets/fonts/source-sans-3-latin.woff2" crossorigin>
<?php if (!empty($preload) && photo_src($preload) !== ''):
    $plAttrs = 'as="image" href="' . e(asset(photo_src($preload))) . '" imagesrcset="' . e(photo_srcset($preload)) . '" imagesizes="' . e($preloadSizes ?? '100vw') . '"';
    if (($preloadPhoneHigh ?? true) === false): ?>
<link rel="preload" <?= $plAttrs ?> media="(min-width: 768px)" fetchpriority="high">
<link rel="preload" <?= $plAttrs ?> media="(max-width: 767px)">
<?php else: ?>
<link rel="preload" <?= $plAttrs ?> fetchpriority="high">
<?php endif; endif; ?>
<link rel="icon" href="/favicon.ico" sizes="32x32">
<link rel="icon" href="<?= e(asset('/assets/images/brand/favicon-48.png')) ?>" sizes="48x48" type="image/png">
<link rel="apple-touch-icon" href="<?= e(asset('/assets/images/brand/apple-touch-icon.png')) ?>">
<link rel="manifest" href="/site.webmanifest">
<link rel="stylesheet" href="<?= e(asset('/assets/css/tokens.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('/assets/css/base.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('/assets/css/layout.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('/assets/css/components.css')) ?>">
<?php foreach ($styles ?? [] as $pageStyle): ?>
<link rel="stylesheet" href="<?= e(asset('/assets/css/' . $pageStyle . '.css')) ?>">
<?php endforeach; ?>
<script src="<?= e(asset('/assets/js/vendor/motion-lenis.min.js')) ?>" defer></script>
<script src="<?= e(asset('/assets/js/motion.js')) ?>" defer></script>
<script src="<?= e(asset('/assets/js/vendor/jquery.min.js')) ?>" defer></script>
<script src="<?= e(asset('/assets/js/nav.js')) ?>" defer></script>
<script src="<?= e(asset('/assets/js/site.js')) ?>" defer></script>
</head>
<body class="<?= e($bodyClass ?? '') ?>">
<?php if ($gtm !== ''): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($gtm) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>
<a class="skip-link" href="#main">Skip to content</a>
