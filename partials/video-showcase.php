<?php
/**
 * "In action" section: the copy, then a swipe row of 9:16 installation
 * clips (partials/reel.php) using all the width available. Each clip is
 * sized so the next one peeks in at the edge — a cue that there is more to
 * see — and capped by the viewport height so an upright clip never grows
 * taller than the screen. Arrows appear only when the row overflows
 * (site.js → data-area-rail).
 *
 * $videos (list), $kicker, $title, $note, $id, optional $link [label, href],
 * optional $tint (bool) for the tinted band.
 *
 * No VideoObject here: on these pages the clips are supplementary, which
 * Google will not index. Each clip has its own watch page (reel.php links
 * to it) carrying the markup — see templates/video.php.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

if (empty($videos)) {
    return;
}
?>
<section class="section video-band<?= !empty($tint) ? ' section--tint' : '' ?>" aria-labelledby="<?= e($id) ?>">
    <div class="container video-band__inner">
        <div class="video-band__copy" data-reveal-group>
            <p class="kicker" data-reveal><?= e($kicker) ?></p>
            <h2 id="<?= e($id) ?>" data-reveal><?= e($title) ?></h2>
            <?php if (!empty($note)): ?><p class="lead" data-reveal><?= e($note) ?></p><?php endif; ?>
            <?php if (!empty($link)): ?>
                <p data-reveal><a class="link-arrow" href="<?= e($link[1]) ?>"><?= e($link[0]) ?> <?= icon('arrow', 'icon icon--sm') ?></a></p>
            <?php endif; ?>
            <p data-reveal><a class="link-arrow" href="/videos.php">All installation videos <?= icon('arrow', 'icon icon--sm') ?></a></p>
        </div>
        <div class="area-rail video-band__rail" data-area-rail data-reveal-group>
            <div class="area-rail__track video-band__reels" tabindex="0" role="region" aria-label="Installation videos — scroll sideways for more" data-area-track>
                <?php foreach ($videos as $video) { render_partial('reel', ['video' => $video]); } ?>
            </div>
            <div class="area-rail__controls">
                <button class="area-rail__btn" type="button" data-area-prev aria-label="Previous video" disabled><?= icon('arrow', 'icon icon--sm icon--flip') ?></button>
                <button class="area-rail__btn" type="button" data-area-next aria-label="Next video"><?= icon('arrow', 'icon icon--sm') ?></button>
            </div>
        </div>
    </div>
</section>
