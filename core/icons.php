<?php
/**
 * SVG icons (24×24, stroke-based, currentColor), as an in-page sprite.
 *
 * icon() prints a tiny <svg><use href="#i-name"></svg> and records the
 * name; icon_sprite() — called once from the footer — prints each used
 * icon's <symbol> a single time. A page with a hundred icons then carries
 * each path once instead of a hundred times, and icons still render with
 * the first HTML byte (no extra request) and inherit the text colour.
 * Decorative by default: aria-hidden, no focus.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

function icon_paths(): array
{
    return [
        'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
        'arrow'    => '<path d="M5 12h14"/><path d="M13 6l6 6-6 6"/>',
        'arrow-up' => '<path d="M12 19V5"/><path d="M6 11l6-6 6 6"/>',
        'check'    => '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
        'menu'     => '<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/>',
        'close'    => '<path d="M6 6l12 12"/><path d="M18 6L6 18"/>',
        'chevron'  => '<path d="M6 9l6 6 6-6"/>',
        'pin'      => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
        'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
        'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'search'   => '<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',
        'grill'    => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7.5 3v18M12 3v18M16.5 3v18"/>',
        'net'      => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/>',
        'bird'     => '<path d="M16 7h.01"/><path d="M3.4 18H12a8 8 0 0 0 8-8V7a4 4 0 0 0-7.28-2.3L2 20"/><path d="M20 7l2 .5-2 .5"/><path d="M10 18v3M14 17.75V21"/>',
        'cricket'  => '<path d="M14.5 3.5l6 6-9.5 9.5-3.5.5.5-3.5z"/><path d="M4 20l3.5-3.5"/><circle cx="6" cy="6" r="2.5"/>',
        'hanger'   => '<path d="M12 7a2 2 0 1 1 2-2c0 1.2-2 1.7-2 3"/><path d="M12 8l9 7.5a1 1 0 0 1-.6 1.8H3.6a1 1 0 0 1-.6-1.8z"/>',
        'ruler'    => '<path d="M3 17l14-14 4 4L7 21z"/><path d="M7 13l2 2M10 10l2 2M13 7l2 2"/>',
        'doc'      => '<path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6M8 13h8M8 17h5"/>',
        'anchor'   => '<circle cx="12" cy="5" r="2.5"/><path d="M12 7.5V21M5 12H3a9 9 0 0 0 18 0h-2M8 11h8"/>',
        'sun'      => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
        'shield'   => '<path d="M12 3l8 3v6c0 4.5-3.4 8.2-8 9-4.6-.8-8-4.5-8-9V6z"/><path d="M8.5 12l2.5 2.5 4.5-5"/>',
        'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
        'camera'   => '<path d="M4 8h3l2-3h6l2 3h3a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/><circle cx="12" cy="13.5" r="3.5"/>',
        'home'     => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/>',
        'store'    => '<path d="M4 9l1.5-5h13L20 9"/><path d="M4 9h16v2a2.5 2.5 0 0 1-4 2 2.5 2.5 0 0 1-4 0 2.5 2.5 0 0 1-4 0 2.5 2.5 0 0 1-4-2z"/><path d="M5 13v7h14v-7"/><path d="M10 20v-4h4v4"/>',
        'users'    => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><path d="M16 4.5a3.5 3.5 0 0 1 0 7M18.5 20a6.5 6.5 0 0 0-3-5.5"/>',
        'quote'    => '<path d="M7 7h4v6H5V9a2 2 0 0 1 2-2zM15 7h4v6h-6V9a2 2 0 0 1 2-2z"/><path d="M5 13c0 2.5 1 4 3 4.5M13 13c0 2.5 1 4 3 4.5"/>',
    ];
}

/**
 * The WhatsApp mark is a filled brand glyph (Simple Icons, CC0) so people
 * recognise the button at a glance.
 */
function icon_whatsapp_path(): string
{
    return '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>';
}

/** Names used on this page so far — shared by icon() and icon_sprite(). */
function &icon_registry(): array
{
    static $used = [];
    return $used;
}

function icon(string $name, string $class = 'icon'): string
{
    if ($name !== 'whatsapp' && $name !== 'star' && !isset(icon_paths()[$name])) {
        return '';
    }
    $used = &icon_registry();
    $used[$name] = true;
    return '<svg class="' . e($class) . '" aria-hidden="true"><use href="#i-' . e($name) . '"></use></svg>';
}

/**
 * Prints the <symbol>s for every icon used on the page. Must run after the
 * last icon() call (the footer calls it last); <use> may point forward.
 */
function icon_sprite(): void
{
    $used = icon_registry();
    if (!$used) {
        return;
    }
    $paths = icon_paths();
    echo '<svg class="sprite" aria-hidden="true" focusable="false">';
    foreach (array_keys($used) as $name) {
        if ($name === 'whatsapp') {
            echo '<symbol id="i-whatsapp" viewBox="0 0 24 24" fill="currentColor">' . icon_whatsapp_path() . '</symbol>';
        } elseif ($name === 'star') {
            // filled star for review ratings
            echo '<symbol id="i-star" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.8l2.8 5.9 6.4.8-4.7 4.4 1.2 6.4L12 17.2l-5.7 3.1 1.2-6.4-4.7-4.4 6.4-.8z"/></symbol>';
        } else {
            echo '<symbol id="i-' . $name . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $paths[$name] . '</symbol>';
        }
    }
    echo "</svg>
";
}
