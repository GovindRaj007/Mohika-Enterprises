<?php
/**
 * City card: region, name, one-line blurb, and a chip per service that has
 * a page in that city. $location.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}
?>
<article class="city-card" data-reveal data-area-item data-area-name="<?= e(str_lower($location['name'] . ' ' . ($location['nickname'] ?? '') . ' ' . implode(' ', $location['localities']))) ?>">
    <p class="city-card__region"><?= icon('pin', 'icon icon--sm') ?> <?= e($location['region']) ?></p>
    <h3 class="city-card__name"><a href="<?= e(city_url($location['slug'])) ?>"><?= e(city_display_name($location)) ?></a></h3>
    <p class="city-card__blurb"><?= e($location['blurb']) ?></p>
    <ul class="chips" aria-label="Services in <?= e($location['name']) ?>">
        <?php foreach (services_in_city($location['slug']) as $ccSvc): ?>
            <li><a class="chip" href="<?= e(service_location_url($ccSvc['slug'], $location['slug'])) ?>"><?= e($ccSvc['nav_label']) ?></a></li>
        <?php endforeach; ?>
    </ul>
</article>
