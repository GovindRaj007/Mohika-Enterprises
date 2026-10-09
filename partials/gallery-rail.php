<?php
/**
 * Horizontal swipe rail of photos (scroll-snap), each opening the lightbox.
 * Photos are shown whole (contain), not cropped. $items: [[name, alt], …];
 * optional $allHref adds a closing "view all" tile.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$railItems = $items ?? [];
if (!$railItems) {
    return;
}
?>
<div class="rail" data-gallery data-reveal-group>
    <ul class="rail__track" role="list">
        <?php foreach ($railItems as [$railName, $railAlt]): ?>
            <li class="rail__item" data-reveal>
                <a class="rail__link" href="<?= e(asset(photo_src($railName, 1200))) ?>" data-lightbox aria-label="View larger: <?= e($railAlt) ?>">
                    <?= photo($railName, $railAlt, ['sizes' => '(min-width: 1024px) 26vw, (min-width: 768px) 40vw, 78vw', 'want' => 480]) ?>
                </a>
            </li>
        <?php endforeach; ?>
        <?php if (!empty($allHref)): ?>
            <li class="rail__item rail__item--all" data-reveal>
                <a class="rail__all" href="<?= e($allHref) ?>"><?= icon('camera') ?><span>View all photos</span><?= icon('arrow', 'icon icon--sm') ?></a>
            </li>
        <?php endif; ?>
    </ul>
</div>
