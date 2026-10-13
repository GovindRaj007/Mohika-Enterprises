<?php
/**
 * Service-area carousel (home page): one card per city in a horizontal
 * scroll-snap track. Each card is narrower than the track, so part of the
 * next card always shows — a cue that the row scrolls sideways. Touch and
 * trackpad swipe come from native scrolling; on larger screens prev/next
 * buttons step one card (site.js), and the track itself is keyboard
 * scrollable (tabindex + region label).
 *
 * The visual band at the top of each card is drawn (city name over the
 * cable motif), not a photo — there are no photos of each city, and an
 * installation photo from elsewhere would misrepresent the place.
 *
 * $railCities (optional): the locations to show — the home page passes one
 * state's list per tab; default is every location.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$railCities = $railCities ?? get_all_locations();
$railLabel  = $railLabel ?? 'Service areas';
?>
<div class="area-rail" data-area-rail data-reveal-group>
    <div class="area-rail__track" tabindex="0" role="region" aria-label="<?= e($railLabel) ?> — scroll sideways for more" data-area-track>
        <?php $railIndex = 0; foreach ($railCities as $railCity): $railIndex++; ?>
            <article class="area-card" data-reveal>
                <div class="area-card__visual" aria-hidden="true">
                    <span class="area-card__num"><?= str_pad((string) $railIndex, 2, '0', STR_PAD_LEFT) ?></span>
                    <span class="area-card__big"><?= e(city_short_name($railCity)) ?></span>
                    <span class="area-card__kicker"><?= icon('pin', 'icon icon--sm') ?> <?= e($railCity['kicker']) ?></span>
                </div>
                <div class="area-card__body">
                    <p class="area-card__region"><?= e($railCity['region']) ?> · <?= e($railCity['district']) ?></p>
                    <h3 class="area-card__name"><a href="<?= e(city_url($railCity['slug'])) ?>"><?= e(city_display_name($railCity)) ?></a></h3>
                    <p class="area-card__blurb"><?= e($railCity['blurb']) ?></p>
                    <ul class="chips" aria-label="Services in <?= e($railCity['name']) ?>">
                        <?php foreach (services_in_city($railCity['slug']) as $railSvc): ?>
                            <li><a class="chip" href="<?= e(service_location_url($railSvc['slug'], $railCity['slug'])) ?>"><?= e($railSvc['nav_label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <a class="link-arrow area-card__more" href="<?= e(city_url($railCity['slug'])) ?>">All work in <?= e(city_short_name($railCity)) ?> <?= icon('arrow', 'icon icon--sm') ?></a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="area-rail__controls">
        <button class="area-rail__btn" type="button" data-area-prev aria-label="Previous service areas" disabled><?= icon('arrow', 'icon icon--sm icon--flip') ?></button>
        <button class="area-rail__btn" type="button" data-area-next aria-label="Next service areas"><?= icon('arrow', 'icon icon--sm') ?></button>
    </div>
</div>
