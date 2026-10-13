<?php
/**
 * Site checker — run against the dev server before every deploy:
 *
 *   php -S 127.0.0.1:8010 index.php          (in another terminal)
 *   php tools/check-site.php [http://127.0.0.1:8010]
 *
 * Exits non-zero on any FAIL. Checks:
 *   pages     200, no PHP error output, exactly one <h1>, canonical = own
 *             URL, title ≤ 60 & unique, description ≤ 155 & unique,
 *             og:image JPEG/PNG that exists, JSON-LD parses, exactly one
 *             business entity, meta keywords ≤ 12, every <img> exists and
 *             has width/height, internal links resolve
 *   links     inbound internal links per page; orphans
 *   routing   case/slash/extension/alias redirects, query kept, 404s,
 *             internal folders not served
 *   sitemap   URL set = route table
 *   images    manifest ⇄ files on disk ⇄ data/service-images.php
 *   unique    share of each service × city page's main text (8-word
 *             shingles, [data-boilerplate] removed) found on no other
 *             page: FAIL < 40 %, WARN < 50 %
 */

declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));
require ROOT_DIR . '/config/site.php';
require ROOT_DIR . '/core/helpers.php';
require ROOT_DIR . '/core/images.php';
require ROOT_DIR . '/core/seo.php';
require ROOT_DIR . '/core/router.php';

$base = rtrim($argv[1] ?? 'http://127.0.0.1:8010', '/');
$fails = 0;
$warns = 0;
$fail = static function (string $msg) use (&$fails): void { $fails++; echo "  FAIL  $msg\n"; };
$warn = static function (string $msg) use (&$warns): void { $warns++; echo "  WARN  $msg\n"; };

/** GET without following redirects: [status, headers, body]. */
function fetch(string $url): array
{
    $ctx = stream_context_create(['http' => ['follow_location' => 0, 'ignore_errors' => true, 'timeout' => 20]]);
    $body = @file_get_contents($url, false, $ctx);
    $headers = $http_response_header ?? [];
    $status = 0;
    if (isset($headers[0]) && preg_match('#\s(\d{3})\s#', $headers[0], $m)) {
        $status = (int) $m[1];
    }
    $location = '';
    foreach ($headers as $h) {
        if (stripos($h, 'Location:') === 0) {
            $location = trim(substr($h, 9));
        }
    }
    return [$status, $location, (string) $body];
}

function dom(string $html): DOMDocument
{
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NOERROR | LIBXML_NOWARNING);
    libxml_clear_errors();
    return $doc;
}

function main_text(DOMDocument $doc, bool $raw = false): string
{
    $xp = new DOMXPath($doc);
    $main = $xp->query('//main')->item(0);
    if (!$main) {
        return '';
    }
    $strip = $raw ? './/script' : './/*[@data-boilerplate] | .//script | .//nav[@aria-label="Breadcrumb"]';
    foreach (iterator_to_array($xp->query($strip, $main)) as $node) {
        $node->parentNode->removeChild($node);
    }
    return trim((string) preg_replace('/\s+/', ' ', $main->textContent));
}

function shingles(string $text, int $n = 8): array
{
    $words = preg_split('/\s+/', strtolower((string) preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $text)), -1, PREG_SPLIT_NO_EMPTY);
    $set = [];
    for ($i = 0, $c = count($words) - $n; $i <= $c; $i++) {
        $set[implode(' ', array_slice($words, $i, $n))] = true;
    }
    return $set;
}

$routes = all_public_routes();
echo "Checking " . count($routes) . " routes on $base\n\n";

/* ── pages ───────────────────────────────────────────────────────────── */
echo "[pages]\n";
$titles = $descs = $texts = $rawTexts = $inbound = [];
foreach ($routes as $path => $kind) {
    [$status, , $html] = fetch($base . $path);
    if ($status !== 200) { $fail("$path → HTTP $status"); continue; }
    if (preg_match('#(<b>(Warning|Notice|Fatal error|Deprecated)</b>|Uncaught |Stack trace:)#', $html)) { $fail("$path contains PHP error output"); }
    $doc = dom($html);
    $xp = new DOMXPath($doc);

    $h1 = $xp->query('//h1')->length;
    if ($h1 !== 1) { $fail("$path has $h1 <h1>"); }

    $title = trim((string) ($xp->query('//title')->item(0)?->textContent ?? ''));
    $desc  = (string) ($xp->query('//meta[@name="description"]/@content')->item(0)?->nodeValue ?? '');
    $canon = (string) ($xp->query('//link[@rel="canonical"]/@href')->item(0)?->nodeValue ?? '');
    $og    = (string) ($xp->query('//meta[@property="og:image"]/@content')->item(0)?->nodeValue ?? '');
    $kw    = (string) ($xp->query('//meta[@name="keywords"]/@content')->item(0)?->nodeValue ?? '');

    if ($title === '' || str_length($title) > 60) { $fail("$path title length " . str_length($title) . ": $title"); }
    if ($desc === '' || str_length($desc) > 155) { $fail("$path description length " . str_length($desc)); }
    $titles[$title][] = $path;
    $descs[$desc][] = $path;
    if ($canon !== base_url($path)) { $fail("$path canonical is '$canon'"); }
    if (!preg_match('#\.(jpe?g|png)$#i', $og)) { $fail("$path og:image is not JPEG/PNG: $og"); }
    elseif (!is_file(ROOT_DIR . (string) parse_url($og, PHP_URL_PATH))) { $fail("$path og:image file missing: $og"); }
    if (strpos($og, BASE_URL . '/') !== 0) { $fail("$path og:image is not an absolute " . BASE_URL . " URL: $og"); }
    $ogFile = ROOT_DIR . (string) parse_url($og, PHP_URL_PATH);
    if (is_file($ogFile)) {
        [$ogW, $ogH] = getimagesize($ogFile) ?: [0, 0];
        if ($ogW !== 1200 || $ogH !== 630) { $fail("$path og:image is {$ogW}×{$ogH}, not 1200×630"); }
        if (filesize($ogFile) > 300 * 1024) { $warn("$path og:image is over 300 KB (WhatsApp may skip the preview)"); }
    }
    // Every tag a link preview (WhatsApp, Facebook, LinkedIn, X) or Google reads.
    $meta = static fn(string $attr, string $name): string => (string) ($xp->query("//meta[@$attr=\"$name\"]/@content")->item(0)?->nodeValue ?? '');
    foreach (['og:title', 'og:description', 'og:url', 'og:type', 'og:site_name', 'og:locale', 'og:image:width', 'og:image:height', 'og:image:alt'] as $prop) {
        if ($meta('property', $prop) === '') { $fail("$path missing $prop"); }
    }
    if ($meta('property', 'og:url') !== $canon) { $fail("$path og:url differs from canonical"); }
    if ($meta('name', 'twitter:card') !== 'summary_large_image') { $fail("$path twitter:card is not summary_large_image"); }
    foreach (['twitter:title', 'twitter:description', 'twitter:image', 'twitter:image:alt'] as $tw) {
        if ($meta('name', $tw) === '') { $fail("$path missing $tw"); }
    }
    if (!str_contains($meta('name', 'robots'), 'max-image-preview:large')) { $fail("$path robots lacks max-image-preview:large"); }
    if ($xp->query('//html[@lang]')->length !== 1) { $fail("$path <html> has no lang"); }
    if (str_length($title) < 30) { $warn("$path title is short (" . str_length($title) . ')'); }
    if (str_length($desc) < 70) { $warn("$path description is short (" . str_length($desc) . ')'); }
    foreach ($xp->query('//img[not(@alt)]') as $img) { $fail("$path image without alt: " . $img->getAttribute('src')); }
    // LCP: the first image in <main> must not be lazy-loaded.
    // (A watch page's first visual is its <video> and poster, not an <img>.)
    $firstImg = $xp->query('//main//img')->item(0);
    $videoFirst = $firstImg && $xp->query('//main//video[following::img]')->length > 0;
    if ($firstImg && !$videoFirst && $firstImg->getAttribute('loading') === 'lazy') { $fail("$path first image in <main> is lazy-loaded (hurts LCP)"); }
    if ($kw !== '' && count(explode(',', $kw)) > 12) { $warn("$path has more than 12 meta keywords"); }
    if ($xp->query('//meta[@name="robots" and contains(@content, "noindex")]')->length) { $fail("$path is noindex"); }

    $business = 0;
    foreach ($xp->query('//script[@type="application/ld+json"]') as $s) {
        $data = json_decode($s->textContent, true);
        if (!is_array($data)) { $fail("$path has JSON-LD that does not parse"); continue; }
        if (($data['@type'] ?? '') === 'HomeAndConstructionBusiness') { $business++; }
        if (isset($data['aggregateRating'])) { $fail("$path emits aggregateRating"); }
    }
    if ($business !== 1) { $fail("$path has $business business entities"); }

    foreach ($xp->query('//img') as $img) {
        $src = (string) parse_url($img->getAttribute('src'), PHP_URL_PATH);
        if (!is_file(ROOT_DIR . $src)) { $fail("$path image missing: $src"); }
        if ($img->getAttribute('width') === '' || $img->getAttribute('height') === '') { $fail("$path image without width/height: $src"); }
        foreach (array_filter(array_map('trim', explode(',', $img->getAttribute('srcset')))) as $cand) {
            $file = (string) parse_url(explode(' ', $cand)[0], PHP_URL_PATH);
            if (!is_file(ROOT_DIR . $file)) { $fail("$path srcset file missing: $file"); }
        }
    }

    $seen = [];
    foreach ($xp->query('//a[@href]') as $a) {
        $href = $a->getAttribute('href');
        if ($href === '' || $href[0] !== '/' || strpos($href, '//') === 0) { continue; }
        $target = (string) parse_url($href, PHP_URL_PATH);
        if (in_array($target, ['/sitemap.xml', '/robots.txt'], true)) { continue; }
        if (isset($routes[$target])) {
            if ($target !== $path && !isset($seen[$target])) { $inbound[$target] = ($inbound[$target] ?? 0) + 1; $seen[$target] = true; }
        } elseif (!is_file(ROOT_DIR . $target)) {
            $fail("$path links to missing $target");
        }
    }

    $texts[$path] = main_text($doc);
    $rawTexts[$path] = main_text(dom($html), true);
}
foreach ($titles as $t => $paths) { if (count($paths) > 1) { $fail('duplicate title "' . $t . '" on ' . implode(', ', $paths)); } }
foreach ($descs as $d => $paths) { if (count($paths) > 1) { $fail('duplicate description on ' . implode(', ', $paths)); } }

/* ── internal links ──────────────────────────────────────────────────── */
echo "\n[internal links]\n";
foreach ($routes as $path => $kind) {
    $n = $inbound[$path] ?? 0;
    if ($path !== '/' && $n === 0) { $fail("$path is an orphan (no internal links)"); }
    elseif ($kind === 'service-location' && $n < 5) { $fail("$path has only $n inbound links"); }
}
$slCounts = array_map(static fn($p) => $inbound[$p] ?? 0, array_keys(array_filter($routes, static fn($k) => $k === 'service-location')));
echo '  service × city inbound links: min ' . min($slCounts) . ', max ' . max($slCounts) . "\n";

/* ── routing ─────────────────────────────────────────────────────────── */
echo "\n[routing]\n";
$expect = [
    '/Contact-Us.php'                          => [301, '/contact-us.php'],
    '/contact-us'                              => [301, '/contact-us.php'],
    '/contact-us/'                             => [301, '/contact-us.php'],
    '//contact-us.php'                         => [301, '/contact-us.php'],
    '/index.php'                               => [301, '/'],
    '/index.html'                              => [301, '/'],
    '/Invisible-Grills.php'                    => [301, '/invisible-grills.php'],
    '/invisible-grills-in-vizag.html'          => [301, '/invisible-grills-in-visakhapatnam.html'],
    '/invisible-grills-and-safety-nets-in-vizag.html' => [301, '/invisible-grills-and-safety-nets-in-visakhapatnam.html'],
    '/cricket-nets-in-rajamahendravaram.html'  => [301, '/cricket-nets-in-rajahmundry.html'],
    '/pigeon-nets-in-guntur.html'              => [301, '/balcony-safety-nets-in-guntur.html'],
    '/pigeon-nets.php'                         => [301, '/balcony-safety-nets.php'],
    '/services?x=1'                            => [301, '/services.php?x=1'],
    '/no-such-page.php'                        => [404, ''],
    '/invisible-grills-in-chennai.html'        => [404, ''],
    '/config/business.php'                     => [404, ''],
    '/data/image-manifest.php'                 => [404, ''],
];
foreach ($expect as $req => [$code, $loc]) {
    [$status, $location] = fetch($base . $req);
    if ($status !== $code || ($loc !== '' && $location !== $loc)) {
        $fail("$req → $status $location (expected $code $loc)");
    }
}

/* ── sitemap ─────────────────────────────────────────────────────────── */
echo "\n[sitemap]\n";
[$status, , $xml] = fetch($base . '/sitemap.xml');
preg_match_all('#<loc>([^<]+)</loc>#', $xml, $m);
$listed = array_map(static fn($u) => (string) parse_url($u, PHP_URL_PATH), $m[1]);
if ($status !== 200 || @simplexml_load_string($xml) === false) { $fail('sitemap.xml is not well-formed'); }
if (array_diff(array_keys($routes), $listed) || array_diff($listed, array_keys($routes))) { $fail('sitemap does not match the route table'); }
if (preg_match_all('#<lastmod>(\d{4}-\d{2}-\d{2})</lastmod>#', $xml, $lm) !== count($listed)) { $fail('a sitemap URL lacks <lastmod>'); }
echo '  ' . count($listed) . " URLs\n";

/* ── images ──────────────────────────────────────────────────────────── */
echo "\n[images]\n";
$manifest = load_data('image-manifest');
$onDisk = array_map('basename', glob(ROOT_DIR . '/assets/images/photos/*.webp') ?: []);
$expected = [];
foreach ($manifest as $name => $entry) {
    foreach ($entry['widths'] as $w) { $expected[] = "$name-$w.webp"; }
}
foreach (array_diff($onDisk, $expected) as $f) { $fail("photo on disk but not in manifest: $f"); }
foreach (array_diff($expected, $onDisk) as $f) { $fail("manifest lists a missing photo: $f"); }
$used = [];
foreach (load_data('service-images') as $set) {
    foreach ($set['gallery'] as [$n]) { $used[$n] = true; }
    if (!empty($set['hero'][0])) { $used[$set['hero'][0]] = true; }
}
foreach (array_keys($manifest) as $n) { if (!isset($used[$n])) { $fail("photo never used: $n"); } }
foreach (glob(ROOT_DIR . '/assets/images/photos/*.webp') ?: [] as $f) {
    $kb = filesize($f) / 1024;
    if ($kb > 160) { $warn(basename($f) . ' is ' . round($kb) . ' KB'); }
}

/* ── uniqueness of service × city pages ─────────────────────────────── */
echo "\n[uniqueness — service × city pages]\n";
$sets = [];
foreach ($texts as $p => $t) { $sets[$p] = shingles($t); }
$counts = [];
foreach ($sets as $set) { foreach ($set as $s => $_) { $counts[$s] = ($counts[$s] ?? 0) + 1; } }
$scores = [];
foreach ($routes as $path => $kind) {
    if ($kind !== 'service-location') { continue; }
    $set = $sets[$path];
    $unique = 0;
    foreach ($set as $s => $_) { if ($counts[$s] === 1) { $unique++; } }
    $pct = $set ? round(100 * $unique / count($set), 1) : 0;
    $scores[$path] = $pct;
    if ($pct < 40) { $fail("$path only $pct % unique"); }
    elseif ($pct < 50) { $warn("$path $pct % unique"); }
}
asort($scores);
printf("  min %.1f %%  ·  avg %.1f %%  ·  max %.1f %%  (%d pages)\n", min($scores), array_sum($scores) / count($scores), max($scores), count($scores));
printf("  lowest: %s (%.1f %%)\n", array_key_first($scores), reset($scores));

// The same measurement with nothing excluded — the whole of <main>, CTA band
// and breadcrumbs included — as an honest worst-case figure.
$rawSets = array_map('shingles', $rawTexts);
$rawCounts = [];
foreach ($rawSets as $set) { foreach ($set as $s => $_) { $rawCounts[$s] = ($rawCounts[$s] ?? 0) + 1; } }
$raw = [];
foreach (array_keys($scores) as $p) {
    $u = 0;
    foreach ($rawSets[$p] as $s => $_) { if ($rawCounts[$s] === 1) { $u++; } }
    $raw[] = 100 * $u / max(1, count($rawSets[$p]));
}
printf("  raw (nothing excluded): min %.1f %%  ·  avg %.1f %%\n", min($raw), array_sum($raw) / count($raw));

echo "\n" . ($fails ? "FAILED: $fails problem(s), $warns warning(s)\n" : "PASSED with $warns warning(s)\n");
exit($fails ? 1 : 0);
