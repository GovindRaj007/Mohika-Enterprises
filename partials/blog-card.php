<?php
/**
 * Blog post card. $post; optional $headingLevel (default h3).
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$bcLevel = $headingLevel ?? 'h3';
?>
<article class="post-card" data-reveal>
    <a class="post-card__cover" href="<?= e(post_url($post['slug'])) ?>" tabindex="-1" aria-hidden="true">
        <?= photo($post['image'], '', ['sizes' => '(min-width: 1024px) 30vw, (min-width: 768px) 45vw, 90vw', 'want' => 480]) ?>
    </a>
    <div class="post-card__body">
        <p class="post-card__meta"><time datetime="<?= e($post['date']) ?>"><?= e(date('j M Y', strtotime($post['date']))) ?></time></p>
        <<?= $bcLevel ?> class="post-card__title"><a href="<?= e(post_url($post['slug'])) ?>"><?= e($post['title']) ?></a></<?= $bcLevel ?>>
        <p class="post-card__text"><?= e($post['excerpt']) ?></p>
    </div>
</article>
