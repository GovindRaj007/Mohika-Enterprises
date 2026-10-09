<?php
/**
 * One installation clip as a 9:16 "reel" card. Expects $video (an entry of
 * data/service-videos.php).
 *
 * <video> is muted, looping and inline, with preload="none" and a WebP
 * poster, so nothing downloads until site.js starts it — and site.js only
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
        <video class="reel__video" muted loop playsinline controls preload="none"
               poster="<?= e(asset($rvBase . '-poster.webp')) ?>"
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
