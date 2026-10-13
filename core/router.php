<?php
/**
 * Route-table router.
 *
 * Every public URL is a key in route_table(), built from config — so the
 * router, the sitemap, the navigation and the site checker all read the same
 * list and cannot drift apart. Requests are normalised (lower case, single
 * slashes) and non-canonical forms 301 to the canonical one; anything not in
 * the table is a 404.
 *
 * A service × city URL exists only when config/service-locations.php holds
 * authored copy for that pair. An unauthored pair 404s rather than rendering
 * a page with the city name pasted in — a deliberate content-quality guard.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

/**
 * path => [template, vars, kind]. kind drives sitemap priority and lets the
 * sitemap skip anything that must not be listed.
 */
function route_table(): array
{
    static $table = null;
    if ($table !== null) {
        return $table;
    }

    $table = [];
    foreach (config_get('routes')['pages'] as $path => $template) {
        $table[$path] = [$template, [], $path === '/' ? 'home' : 'page'];
    }

    foreach (get_all_services() as $slug => $service) {
        $table[service_url($slug)] = ['service', ['service' => $service], 'service'];
    }

    foreach (get_all_locations() as $citySlug => $location) {
        $table[city_url($citySlug)] = ['city', ['location' => $location], 'city'];
    }

    foreach (get_all_services() as $slug => $service) {
        foreach (get_all_locations() as $citySlug => $location) {
            $content = get_service_location($slug, $citySlug);
            if ($content === null) {
                continue;
            }
            $table[service_location_url($slug, $citySlug)] = ['service-location', [
                'service'  => $service,
                'location' => $location,
                'content'  => $content,
            ], 'service-location'];
        }
    }

    foreach (get_all_posts() as $slug => $post) {
        $table[post_url($slug)] = ['blog-post', ['post' => $post], 'post'];
    }

    // One watch page per installation clip (data/service-videos.php).
    foreach (all_videos() as $slug => $video) {
        $table[video_url($slug)] = ['video', ['video' => $video], 'video'];
    }

    foreach (ADS_LANDING_PAGES as $path => $serviceSlug) {
        $service = get_service($serviceSlug);
        if ($service !== null) {
            $table[$path] = ['ads-landing', ['service' => $service], 'ads'];
        }
    }

    return $table;
}

/**
 * Old or alternative spellings => canonical path.
 */
function redirect_table(): array
{
    static $redirects = null;
    if ($redirects !== null) {
        return $redirects;
    }

    $redirects = config_get('routes')['redirects'] ?? [];

    // Retired services (config/routes.php → 'retired'): the service page and
    // every one of its area pages 301 to the replacement service's pages, so
    // links and search results that still point at them keep working.
    foreach (config_get('routes')['retired'] ?? [] as $oldSlug => $newSlug) {
        $redirects[service_url($oldSlug)] = service_url($newSlug);
        foreach (get_all_locations() as $citySlug => $location) {
            $target = get_service_location($newSlug, $citySlug) !== null ? service_location_url($newSlug, $citySlug) : service_url($newSlug);
            $redirects[service_location_url($oldSlug, $citySlug)] = $target;
            foreach ($location['alias_slugs'] ?? [] as $alias) {
                $redirects[service_location_url($oldSlug, $alias)] = $target;
            }
        }
    }

    foreach (get_all_locations() as $citySlug => $location) {
        foreach ($location['alias_slugs'] ?? [] as $alias) {
            $redirects[city_url($alias)] = city_url($citySlug);
            foreach (get_all_services() as $slug => $service) {
                if (get_service_location($slug, $citySlug) !== null) {
                    $redirects[service_location_url($slug, $alias)] = service_location_url($slug, $citySlug);
                }
            }
        }
    }

    return $redirects;
}

/**
 * Every indexable route, for the sitemap and the site checker.
 */
function all_public_routes(): array
{
    $routes = [];
    foreach (route_table() as $path => [$template, $vars, $kind]) {
        if ($kind !== 'ads') {
            $routes[$path] = $kind;
        }
    }
    return $routes;
}

function dispatch(): void
{
    $uri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    $doubleSlash = strpos($uri, '//') === 0;
    // Before parse_url: "//x" would otherwise be read as a host.
    $uri   = '/' . ltrim($uri, '/');
    $path  = rawurldecode((string) (parse_url($uri, PHP_URL_PATH) ?: '/'));
    $query = parse_url($uri, PHP_URL_QUERY);
    $qs    = $query ? '?' . $query : '';

    if ($path === '/sitemap.xml') {
        header('Content-Type: application/xml; charset=UTF-8');
        render_template('sitemap-xml');
        return;
    }
    if ($path === '/robots.txt') {
        header('Content-Type: text/plain; charset=UTF-8');
        render_template('robots-txt');
        return;
    }

    $normalized = preg_replace('#/+#', '/', str_lower($path)) ?? '/';
    if (!preg_match('#^[a-z0-9/_.\-]*$#', $normalized)) {
        render_not_found();
        return;
    }

    $table  = route_table();
    $target = redirect_table()[$normalized] ?? null;

    // "/x" or "/x/" with no extension → "/x.php" or "/x.html" when it exists.
    if ($target === null && $normalized !== '/' && strpos(basename($normalized), '.') === false) {
        $bare = rtrim($normalized, '/');
        foreach (['.php', '.html'] as $ext) {
            if (isset($table[$bare . $ext])) {
                $target = $bare . $ext;
                break;
            }
        }
    }

    // Upper case, doubled slashes → the canonical spelling.
    if ($target === null && ($normalized !== $path || $doubleSlash) && isset($table[$normalized])) {
        $target = $normalized;
    }

    if ($target !== null) {
        header('Location: ' . $target . $qs, true, 301);
        return;
    }

    if (!isset($table[$normalized])) {
        render_not_found();
        return;
    }

    [$template, $vars] = $table[$normalized];
    $GLOBALS['__current_path'] = $normalized;
    $vars['path'] = $normalized;
    render_template($template, $vars);
}

function render_template(string $template, array $vars = []): void
{
    $file = ROOT_DIR . '/templates/' . $template . '.php';
    if (!is_file($file)) {
        render_not_found();
        return;
    }
    extract($vars, EXTR_SKIP);
    require $file;
}

function render_not_found(): void
{
    http_response_code(404);
    $GLOBALS['__current_path'] = null;
    require ROOT_DIR . '/templates/404.php';
}

/**
 * The path being rendered, for aria-current and the active nav state.
 */
function current_path(): ?string
{
    return $GLOBALS['__current_path'] ?? null;
}
