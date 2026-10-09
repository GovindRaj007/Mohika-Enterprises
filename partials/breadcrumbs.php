<?php
/**
 * Visible breadcrumb trail + its BreadcrumbList schema, from one array, so
 * the two cannot disagree. $crumbs: [[label, path], …], last = current page.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$crumbs = array_merge([['Home', '/']], $crumbs ?? []);
$last = count($crumbs) - 1;
?>
<nav class="crumbs" aria-label="Breadcrumb">
    <ol>
        <?php foreach ($crumbs as $i => [$crumbLabel, $crumbPath]): ?>
            <li>
                <?php if ($i === $last): ?>
                    <span aria-current="page"><?= e($crumbLabel) ?></span>
                <?php else: ?>
                    <a href="<?= e($crumbPath) ?>"><?= e($crumbLabel) ?></a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
<?php
json_ld([
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => array_map(static fn(int $i, array $c): array => [
        '@type'    => 'ListItem',
        'position' => $i + 1,
        'name'     => $c[0],
        'item'     => base_url($c[1]),
    ], array_keys($crumbs), $crumbs),
]);
