<?php
/**
 * Service card — the whole card is one link. $service; optional $city
 * (a location array) to link to that service's page in that city instead,
 * and $sizes for the image.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

[$cardPhoto, $cardAlt] = service_main_photo($service['slug']);
$cardHref = !empty($city) ? service_location_url($service['slug'], $city['slug']) : service_url($service['slug']);
$cardTitle = !empty($city) ? $service['h1'] . ' in ' . $city['name'] : $service['nav_label'];
?>
<a class="svc-card" href="<?= e($cardHref) ?>" data-reveal>
    <span class="svc-card__cover">
        <?= photo($cardPhoto, $cardAlt, ['sizes' => $sizes ?? '(min-width: 1024px) 30vw, (min-width: 768px) 45vw, 90vw', 'want' => 480]) ?>
        <span class="svc-card__badge"><?= icon($service['icon'], 'icon icon--sm') ?> <?= e($service['card_note']) ?></span>
    </span>
    <span class="svc-card__body">
        <span class="svc-card__title"><?= e($cardTitle) ?></span>
        <span class="svc-card__text"><?= e($service['card_summary']) ?></span>
        <span class="svc-card__more">Explore <?= icon('arrow', 'icon icon--sm') ?></span>
    </span>
</a>
