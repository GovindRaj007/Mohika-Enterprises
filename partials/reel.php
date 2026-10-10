<?php
/**
 * One installation clip as a 9:16 "reel" card. Expects $video (an entry of
 * data/service-videos.php).
 *
 * <video> is muted, looping and inline, with preload="none". Its still
 * frame is a lazy <img> behind the (transparent until playing) video rather
 * than a poster attribute — browsers fetch a poster at once, even far below
 * the fold, which steals bandwidth from the hero. So nothing downloads until
 * the card nears the screen, and the clip itself not until site.js starts it — and site.js only
 * starts it while at least half of it is on screen, and never under
 * prefers-reduced-motion (the play button then starts it on request). The
 * toggle button is always present and keyboard-reachable; the visible
 * caption describes the clip (no speech, so no captions track is needed).
 * The tag carries native controls, which site.js swaps for the custom
 * toggle — so without JS the clip is still playable.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$rv = $video;
$rvBase = '/assets/videos/' . $rv['file'];
?>
<figure class="reel" data-reveal>
    <div class="reel__frame">
        <img class="reel__poster" src="<?= e(asset($rvBase . '-poster.webp')) ?>" width="<?= (int) $rv['w'] ?>" height="<?= (int) $rv['h'] ?>" alt="" loading="lazy" decoding="async">
        <video class="reel__video" muted loop playsinline controls preload="none"
               width="<?= (int) $rv['w'] ?>" height="<?= (int) $rv['h'] ?>"
               aria-label="<?= e($rv['title']) ?>" data-reel>
            <source src="<?= e(asset($rvBase . '.mp4')) ?>" type="video/mp4">
        </video>
        <button class="reel__toggle" type="button" aria-pressed="false" aria-label="Play video: <?= e($rv['title']) ?>" data-reel-toggle hidden>
            <span class="reel__icon" aria-hidden="true"></span>
        </button>
    </div>
    <figcaption class="reel__caption"><?= e($rv['caption']) ?></figcaption>
</figure>
