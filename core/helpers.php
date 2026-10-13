<?php
/**
 * Shared helpers: escaping, config access, rendering, URL building and the
 * getters every template uses. Nothing here knows any business fact — those
 * all come from config/.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

/* ── output ──────────────────────────────────────────────────────────── */

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Escapes text but keeps the <strong> and <em> tags authored in config copy.
 * Config is ours, not user input, but the escape-then-restore keeps anything
 * else in it inert.
 */
function rich(?string $value): string
{
    $escaped = e($value);
    return (string) preg_replace('#&lt;(/?)(strong|em)&gt;#', '<$1$2>', $escaped);
}

/* ── config, data, partials ──────────────────────────────────────────── */

function config_get(string $name): array
{
    static $cache = [];
    if (!isset($cache[$name])) {
        $path = ROOT_DIR . '/config/' . $name . '.php';
        $cache[$name] = is_file($path) ? require $path : [];
    }
    return $cache[$name];
}

/**
 * Requires a data file inside a function so its loop variables cannot leak
 * into, and overwrite, the calling template's locals.
 */
function load_data(string $name): array
{
    static $cache = [];
    if (!isset($cache[$name])) {
        $cache[$name] = require ROOT_DIR . '/data/' . $name . '.php';
    }
    return $cache[$name];
}

function render_partial(string $name, array $vars = []): void
{
    extract($vars, EXTR_SKIP);
    require ROOT_DIR . '/partials/' . $name . '.php';
}

/**
 * Cache-busted asset URL: /assets/css/base.css?v={mtime}.
 */
function asset(string $path): string
{
    $path = '/' . ltrim($path, '/');
    $full = ROOT_DIR . $path;
    return is_file($full) ? $path . '?v=' . filemtime($full) : $path;
}

/* ── strings (no mbstring dependency) ────────────────────────────────── */

function str_lower(string $value): string
{
    return function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
}

function str_length(string $value): int
{
    if (function_exists('mb_strlen')) {
        return mb_strlen($value, 'UTF-8');
    }
    if (function_exists('iconv_strlen')) {
        $length = @iconv_strlen($value, 'UTF-8');
        if ($length !== false) {
            return $length;
        }
    }
    return strlen($value);
}

/**
 * "A, B and C".
 */
function join_names(array $names, string $conjunction = 'and'): string
{
    $names = array_values($names);
    $count = count($names);
    if ($count === 0) {
        return '';
    }
    if ($count === 1) {
        return (string) $names[0];
    }
    $last = array_pop($names);
    return implode(', ', $names) . ' ' . $conjunction . ' ' . $last;
}

/**
 * The first candidate that fits $max characters — titles and descriptions
 * are written as a list from richest to plainest.
 */
function first_fitting(array $candidates, int $max): string
{
    foreach ($candidates as $candidate) {
        if ($candidate !== '' && str_length($candidate) <= $max) {
            return $candidate;
        }
    }
    return (string) end($candidates);
}

/* ── business ────────────────────────────────────────────────────────── */

function business(): array
{
    return config_get('business');
}

function tel_href(?string $e164 = null): string
{
    return 'tel:' . ($e164 ?? business()['phone_e164']);
}

/**
 * wa.me deep link, prefilled so the message arrives half-written and the
 * business knows what it is about before replying.
 */
function whatsapp_url(string $about = ''): string
{
    $b = business();
    $digits = preg_replace('/[^0-9]/', '', $b['whatsapp_e164'] ?? $b['phone_e164']);
    $message = $b['whatsapp_message_prefix'] . ($about !== '' ? $about : 'invisible grills / safety nets') . '.';
    return 'https://wa.me/' . $digits . '?text=' . rawurlencode($message);
}

/**
 * "7+ years", or '' when the figure was not supplied.
 */
function years_label(): string
{
    $years = business()['years_experience'] ?? null;
    return $years ? $years . '+ years' : '';
}

/**
 * "3100+", or '' when the figure was not supplied.
 */
function installs_label(): string
{
    $count = business()['installs_count'] ?? null;
    return $count ? $count . '+' : '';
}

/**
 * The two proof figures, for badges and the hero strip:
 * [['3100+', 'installations'], ['7+', 'years experience']] — each only when supplied.
 */
function proof_points(): array
{
    $points = [];
    if (installs_label() !== '') { $points[] = [installs_label(), 'installations']; }
    if (!empty(business()['years_experience'])) { $points[] = [business()['years_experience'] . '+', 'years experience']; }
    return $points;
}

/* ── URLs ────────────────────────────────────────────────────────────── */

function service_url(string $slug): string
{
    return '/' . $slug . '.php';
}

function service_location_url(string $serviceSlug, string $citySlug): string
{
    return '/' . $serviceSlug . '-in-' . $citySlug . '.html';
}

function city_url(string $citySlug): string
{
    return '/invisible-grills-and-safety-nets-in-' . $citySlug . '.html';
}

function post_url(string $slug): string
{
    return '/' . $slug . '.php';
}

/**
 * The quote form, with services optionally pre-selected.
 */
function quote_url(string $serviceSlug = '', string $citySlug = ''): string
{
    $params = array_filter(['service' => $serviceSlug, 'city' => $citySlug]);
    return '/contact-us.php' . ($params ? '?' . http_build_query($params) : '') . '#quote';
}

/* ── services ────────────────────────────────────────────────────────── */

/**
 * Every service keyed by slug, in config order — the order of the nav, the
 * home page, the footer and the sitemap.
 */
function get_all_services(): array
{
    return config_get('services');
}

function get_service(string $slug): ?array
{
    return config_get('services')[$slug] ?? null;
}

/* ── locations ───────────────────────────────────────────────────────── */

function get_all_locations(): array
{
    return config_get('locations');
}

function get_location(string $slug): ?array
{
    return config_get('locations')[$slug] ?? null;
}

/**
 * Authored copy for one service in one city, or null — and null means the
 * page does not exist.
 */
function get_service_location(string $serviceSlug, string $citySlug): ?array
{
    static $matrix = null;
    if ($matrix === null) {
        $matrix = config_get('service-locations');
    }
    return $matrix[$serviceSlug][$citySlug] ?? null;
}

/**
 * Cities that have an authored page for this service.
 */
function cities_for_service(string $serviceSlug): array
{
    return array_filter(get_all_locations(), static fn(array $l): bool => get_service_location($serviceSlug, $l['slug']) !== null);
}

/**
 * Services that have an authored page in this city.
 */
function services_in_city(string $citySlug): array
{
    return array_filter(get_all_services(), static fn(array $s): bool => get_service_location($s['slug'], $citySlug) !== null);
}

/**
 * Full name for headings and titles: "Visakhapatnam (Vizag)" where a city
 * has a popular short name, "Gachibowli, Hyderabad" for an area of a city.
 */
function city_display_name(array $location): string
{
    if (!empty($location['parent']) && ($parent = get_location($location['parent'])) !== null) {
        return $location['name'] . ', ' . $parent['name'];
    }
    return !empty($location['nickname']) ? $location['name'] . ' (' . $location['nickname'] . ')' : $location['name'];
}

/** Short name for menus, chips and cards: "Vizag", "Gachibowli". */
function city_short_name(array $location): string
{
    return !empty($location['nickname']) ? $location['nickname'] : $location['name'];
}

/* ── states ──────────────────────────────────────────────────────────── */

function get_states(): array
{
    return business()['states'];
}

/** The state record ['name', 'short', 'code'] a location belongs to. */
function location_state(array $location): array
{
    return get_states()[$location['state']] ?? ['name' => business()['region'], 'short' => '', 'code' => ''];
}

/**
 * Locations grouped by state, in config order:
 * ['andhra-pradesh' => [slug => location, …], 'telangana' => […]].
 */
function locations_by_state(): array
{
    $grouped = array_fill_keys(array_keys(get_states()), []);
    foreach (get_all_locations() as $slug => $location) {
        $grouped[$location['state']][$slug] = $location;
    }
    return array_filter($grouped);
}

/**
 * schema.org place for a location, nested in its state — a City, or for an
 * area of a city a Place inside that City (Gachibowli → Hyderabad →
 * Telangana).
 */
function location_place_schema(array $location): array
{
    $state = ['@type' => 'State', 'name' => location_state($location)['name']];
    if (!empty($location['parent']) && ($parent = get_location($location['parent'])) !== null) {
        return ['@type' => 'Place', 'name' => $location['name'], 'containedInPlace' => ['@type' => 'City', 'name' => $parent['name'], 'containedInPlace' => $state]];
    }
    return ['@type' => 'City', 'name' => $location['name'], 'containedInPlace' => $state];
}

/** The two states as schema.org State entities. */
function states_schema(): array
{
    return array_values(array_map(static fn(array $st): array => ['@type' => 'State', 'name' => $st['name']], get_states()));
}

/** Areas of a city (Gachibowli, Kondapur … for Hyderabad). */
function child_locations(string $parentSlug): array
{
    return array_filter(get_all_locations(), static fn(array $l): bool => ($l['parent'] ?? '') === $parentSlug);
}

/**
 * The cities (not the areas within them), joined: "Visakhapatnam, …,
 * Hyderabad, Secunderabad, Mahbubnagar and Warangal". $state limits it.
 */
function location_names_sentence(string $conjunction = 'and', bool $short = false, string $state = ''): string
{
    $cities = array_filter(get_all_locations(), static fn(array $l): bool => ($l['parent'] ?? '') === '' && ($state === '' || $l['state'] === $state));
    $names = array_map(static fn(array $l): string => $short ? city_short_name($l) : $l['name'], $cities);
    return join_names(array_values($names), $conjunction);
}

/* ── blog ────────────────────────────────────────────────────────────── */

function get_all_posts(): array
{
    return config_get('posts');
}

function get_post(string $slug): ?array
{
    return get_all_posts()[$slug] ?? null;
}

/* ── shared content ──────────────────────────────────────────────────── */

/**
 * The company FAQ answer about coverage, worded from config so it never
 * names a city that is not served.
 */
function coverage_answer(): string
{
    $hydAreas = array_map(static fn(array $l): string => $l['name'], child_locations('hyderabad'));
    return SITE_SHORT_NAME . ' has local teams across Andhra Pradesh — ' . location_names_sentence('and', false, 'andhra-pradesh') . ' — and Telangana: '
        . location_names_sentence('and', false, 'telangana') . ', including ' . join_names(array_values($hydAreas)) . ' in the Hyderabad metro. '
        . 'Your local team comes to you for the ' . str_lower(business()['offer']) . ', so call or WhatsApp with your area and we will fix a time.';
}
