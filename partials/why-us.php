<?php
/**
 * Company value props as a bento grid; the first tile carries the
 * installation count (and years) when supplied. Repeats sitewide (data-boilerplate tells the
 * uniqueness checker to leave it out of the per-page measurement).
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

// $items (supply pages) replaces the points and drops the feature tile.
$whyItems = !empty($items) ? $items : config_get('why-us');
$whyYears = !empty($items) ? '' : years_label();
$whyInstalls = !empty($items) ? '' : installs_label();
?>
<div class="bento" data-reveal-group data-boilerplate>
    <?php if ($whyInstalls !== ''): ?>
        <div class="bento__tile bento__tile--feature" data-reveal>
            <span class="bento__big" data-count="<?= (int) business()['installs_count'] ?>" data-suffix="+"><?= e($whyInstalls) ?></span>
            <span class="bento__label">installations across <?= e(business()['region_short']) ?></span>
            <p><?= $whyYears !== '' ? e($whyYears) . ' of fitting balcony safety, with local' : 'Local' ?> team members in every area we cover — they measure, fit and finish every job in their area.</p>
        </div>
    <?php elseif ($whyYears !== ''): ?>
        <div class="bento__tile bento__tile--feature" data-reveal>
            <span class="bento__big" data-count="<?= (int) business()['years_experience'] ?>" data-suffix="+"><?= e((string) business()['years_experience']) ?>+</span>
            <span class="bento__label">years fitting balcony safety</span>
            <p>Local team members in every area we cover — they measure, fit and finish every job in their area.</p>
        </div>
    <?php endif; ?>
    <?php foreach ($whyItems as $whyItem): ?>
        <div class="bento__tile" data-reveal>
            <span class="bento__icon"><?= icon($whyItem['icon']) ?></span>
            <h3 class="bento__title"><?= e($whyItem['heading']) ?></h3>
            <p><?= e($whyItem['text']) ?></p>
        </div>
    <?php endforeach; ?>
</div>
