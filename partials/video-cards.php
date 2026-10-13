<?php
/**
 * Grid of links to video watch pages — on /videos.php and under each watch
 * page. The still is a lazy <img> (the poster frame); the cards hold no
 * <video>, so these pages are not mistaken for watch pages themselves.
 *
 * $videos: all_videos()-style entries; optional $eager (bool) loads the
 * stills at once — for a grid that can sit in the first screen.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}
?>
<ul class="video-cards" data-reveal-group>
    <?php foreach ($videos as $vc):
        $vcSvc = get_service($vc['service']);
        ?>
        <li class="video-card" data-reveal>
            <a class="video-card__link" href="<?= e(video_url($vc['slug'])) ?>">
                <span class="video-card__media">
                    <img src="<?= e(video_poster($vc)) ?>" width="<?= (int) $vc['w'] ?>" height="<?= (int) $vc['h'] ?>" alt="" loading="<?= !empty($eager) ? 'eager' : 'lazy' ?>" decoding="async">
                    <span class="video-card__play" aria-hidden="true"></span>
                    <span class="video-card__time"><?= video_seconds($vc['duration']) ?>s</span>
                </span>
                <span class="video-card__service"><?= e($vcSvc['nav_label']) ?></span>
                <span class="video-card__title"><?= e($vc['title']) ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
