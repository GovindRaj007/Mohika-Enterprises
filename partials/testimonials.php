<?php
/**
 * Customer reviews — a horizontal card carousel (same swipe / prev-next
 * behaviour as the service-area row, site.js → data-area-rail).
 *
 * Source:
 *   data/testimonials.php — REAL reviews only, copied word for word with the
 *     customer's permission. Shape: quote, name, city, service, rating (1–5).
 *     Filterable by $filterCity / $filterService. No dates are shown.
 *   data/testimonials-sample.php — SAMPLE reviews for the local design
 *     preview. Loaded ONLY under PHP's built-in dev server (php -S) and only
 *     while there are no real reviews, so they can never reach the live
 *     Apache site. Invented reviews must never be published (CCPA, 2022).
 *
 * Never emits Review or AggregateRating schema. When a Google Business
 * Profile link is configured, a "Read our Google reviews" link shows too.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$tItems = load_data('testimonials');
$tIsSample = false;
if (!$tItems && PHP_SAPI === 'cli-server' && is_file(ROOT_DIR . '/data/testimonials-sample.php')) {
    $tItems = load_data('testimonials-sample');
    $tIsSample = true;
}
if (!empty($filterCity)) {
    $tItems = array_values(array_filter($tItems, static fn($t): bool => ($t['city'] ?? '') === $filterCity));
}
if (!empty($filterService)) {
    $tItems = array_values(array_filter($tItems, static fn($t): bool => ($t['service'] ?? '') === $filterService));
}
$tGbp = business()['gbp_url'] ?? null;

if (!$tItems && !$tGbp) {
    return;
}

$tInitials = static function (string $name): string {
    $parts = preg_split('/\s+/', trim(str_replace('.', '', $name))) ?: [];
    $first = $parts[0][0] ?? '';
    $last  = count($parts) > 1 ? $parts[count($parts) - 1][0] : '';
    return strtoupper($first . $last);
};
?>
<section class="section testimonials" aria-labelledby="reviews-title"<?= $tIsSample ? ' data-sample-reviews' : '' ?>>
    <div class="container">
        <div class="testimonials__head">
            <?php render_partial('section-head', [
                'kicker' => 'Reviews',
                'title'  => $title ?? 'What families across Andhra Pradesh say',
                'note'   => $note ?? 'From invisible grills in Vizag to cricket nets in Kurnool — in their own words.',
                'id'     => 'reviews-title',
            ]); ?>
            <?php if ($tGbp): ?>
                <a class="btn btn--outline testimonials__gbp" href="<?= e($tGbp) ?>" target="_blank" rel="noopener">Read our Google reviews <?= icon('arrow', 'icon icon--sm') ?></a>
            <?php endif; ?>
        </div>

        <?php if ($tItems): ?>
            <div class="area-rail review-rail" data-area-rail data-reveal-group>
                <div class="area-rail__track" tabindex="0" role="region" aria-label="Customer reviews — scroll sideways for more" data-area-track>
                    <?php foreach ($tItems as $tIndex => $tItem):
                        $tCity = get_location($tItem['city'] ?? '');
                        $tSvc  = get_service($tItem['service'] ?? '');
                        $tRating = max(1, min(5, (int) ($tItem['rating'] ?? 5)));
                        ?>
                        <figure class="review-card" data-reveal>
                            <div class="review-card__top">
                                <span class="review-card__stars" role="img" aria-label="Rated <?= $tRating ?> out of 5">
                                    <?php for ($s = 1; $s <= 5; $s++): ?><?= icon('star', 'icon icon--sm' . ($s > $tRating ? ' is-empty' : '')) ?><?php endfor; ?>
                                </span>
                                <?php if ($tSvc): ?>
                                    <a class="review-card__service" href="<?= e($tCity ? service_location_url($tSvc['slug'], $tCity['slug']) : service_url($tSvc['slug'])) ?>"><?= icon($tSvc['icon'], 'icon icon--sm') ?> <?= e($tSvc['nav_label']) ?></a>
                                <?php endif; ?>
                            </div>
                            <blockquote class="review-card__quote"><p><?= e($tItem['quote']) ?></p></blockquote>
                            <figcaption class="review-card__who">
                                <span class="review-card__avatar review-card__avatar--<?= ($tIndex % 4) + 1 ?>" aria-hidden="true"><?= e($tInitials($tItem['name'])) ?></span>
                                <span>
                                    <span class="review-card__name"><?= e($tItem['name']) ?></span>
                                    <span class="review-card__meta"><?= icon('pin', 'icon icon--sm') ?> <?= e($tCity ? ($tCity['nickname'] ?: $tCity['name']) : '') ?></span>
                                </span>
                            </figcaption>
                        </figure>
                    <?php endforeach; ?>
                </div>
                <div class="area-rail__controls">
                    <button class="area-rail__btn" type="button" data-area-prev aria-label="Previous reviews" disabled><?= icon('arrow', 'icon icon--sm icon--flip') ?></button>
                    <button class="area-rail__btn" type="button" data-area-next aria-label="Next reviews"><?= icon('arrow', 'icon icon--sm') ?></button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
