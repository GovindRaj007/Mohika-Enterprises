<?php
/**
 * Blog post — /{slug}.php. Article schema, lead image, sections, and links
 * to the services (and their city pages) the post is about.
 * Expects $post and $path.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$seo = [
    'title'        => $post['seo_title'],
    'description'  => $post['description'],
    'keywords'     => $post['keywords'],
    'path'         => $path,
    'og_type'      => 'article',
    'og_image'     => $post['og_image'],
    'og_image_alt' => $post['image_alt'],
];
render_partial('head', ['seo' => $seo, 'preload' => $post['image'], 'preloadSizes' => '(min-width: 1024px) 760px, 100vw', 'bodyClass' => 'page-post']);
render_partial('header');
$linked = array_filter(array_map('get_service', $post['links']));
?>
<main id="main">
    <article>
        <header class="post-hero">
            <div class="page-hero__cables" aria-hidden="true"></div>
            <div class="container container--narrow" data-reveal-group>
                <?php render_partial('breadcrumbs', ['crumbs' => [['Blog', '/blog.php'], [$post['title'], $path]]]); ?>
                <p class="eyebrow" data-reveal><?= icon('calendar', 'icon icon--sm') ?> <time datetime="<?= e($post['date']) ?>"><?= e(date('j F Y', strtotime($post['date']))) ?></time></p>
                <h1 class="post-hero__title" data-reveal><?= e($post['title']) ?></h1>
                <p class="page-hero__lead" data-reveal><?= e($post['excerpt']) ?></p>
            </div>
        </header>

        <div class="container container--narrow prose">
            <figure class="prose__figure">
                <?= photo($post['image'], $post['image_alt'], ['eager' => true, 'sizes' => '(min-width: 1024px) 760px, 100vw', 'want' => 800]) ?>
            </figure>
            <?php foreach ($post['sections'] as $section): ?>
                <h2><?= e($section['heading']) ?></h2>
                <?php foreach ($section['paragraphs'] as $para): ?><p><?= rich($para) ?></p><?php endforeach; ?>
            <?php endforeach; ?>

            <aside class="post-links">
                <h2 class="h3">Related services</h2>
                <?php foreach ($linked as $svc): ?>
                    <p><a class="link-arrow" href="<?= e(service_url($svc['slug'])) ?>"><?= e($svc['h1']) ?> in <?= e(business()['region']) ?> <?= icon('arrow', 'icon icon--sm') ?></a></p>
                    <?php render_partial('state-groups', [
                        'locations' => cities_for_service($svc['slug']),
                        'tag'       => 'h3',
                        'href'      => static fn(array $c): string => service_location_url($svc['slug'], $c['slug']),
                        'label'     => static fn(array $c): string => $svc['nav_label'] . ' in ' . city_short_name($c),
                    ]); ?>
                <?php endforeach; ?>
            </aside>
        </div>
    </article>

    <section class="section section--tint" aria-labelledby="more-posts">
        <div class="container">
            <?php render_partial('section-head', ['kicker' => 'Keep reading', 'title' => 'More guides', 'id' => 'more-posts']); ?>
            <div class="post-grid" data-reveal-group>
                <?php foreach (get_all_posts() as $other) {
                    if ($other['slug'] !== $post['slug']) { render_partial('blog-card', ['post' => $other]); }
                } ?>
            </div>
        </div>
    </section>

    <?php render_partial('cta-band', ['title' => 'Want it done properly? Book a free site visit', 'quoteHref' => quote_url(implode(',', $post['links']))]); ?>
</main>
<?php
json_ld([
    '@context'      => 'https://schema.org',
    '@type'         => 'Article',
    'headline'      => $post['title'],
    'description'   => $post['description'],
    'image'         => base_url($post['og_image']),
    'datePublished' => $post['date'],
    'dateModified'  => $post['date'],
    'mainEntityOfPage' => base_url($path),
    'author'        => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => base_url('/')],
    'publisher'     => ['@id' => base_url('/#business')],
]);
render_partial('footer');
