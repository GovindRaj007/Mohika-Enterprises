<?php
/**
 * Blog index — /blog.php.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$p = config_get('pages')['blog'];
$seo = ['title' => $p['title'], 'description' => $p['description'], 'keywords' => $p['keywords'], 'path' => $path];
render_partial('head', ['seo' => $seo, 'bodyClass' => 'page-blog']);
render_partial('header');
?>
<main id="main">
    <?php render_partial('page-hero', ['crumbs' => [['Blog', $path]], 'h1' => $p['h1'], 'tag' => $p['tag'], 'lead' => $p['lead'], 'secondary' => ['Browse services', '/services.php']]); ?>
    <section class="section" aria-label="Articles">
        <div class="container">
            <div class="post-grid post-grid--two" data-reveal-group>
                <?php $bFirst = true; foreach (get_all_posts() as $post) { render_partial('blog-card', ['post' => $post, 'headingLevel' => 'h2', 'eager' => $bFirst]); $bFirst = false; } ?>
            </div>
        </div>
    </section>
    <?php render_partial('cta-band', ['title' => 'Have a question we did not answer? Ask us']); ?>
</main>
<?php
json_ld([
    '@context' => 'https://schema.org',
    '@type'    => 'Blog',
    'name'     => $p['h1'],
    'url'      => base_url($path),
    'publisher'=> ['@id' => base_url('/#business')],
    'blogPost' => array_values(array_map(static fn(array $post): array => [
        '@type' => 'BlogPosting', 'headline' => $post['title'], 'url' => base_url(post_url($post['slug'])), 'datePublished' => $post['date'],
    ], get_all_posts())),
]);
render_partial('footer');
