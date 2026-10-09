<?php
/**
 * Company value props — shown on the home and service pages. Each is a
 * commitment about how the work is done, not a number; there is no install
 * count, rating or certification here because none was supplied.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    ['icon' => 'ruler', 'heading' => 'Measured before quoted', 'text' => 'Every opening is measured on site, so the quote is for your balcony — not a guess from a photo.'],
    ['icon' => 'doc', 'heading' => 'Material named in writing', 'text' => 'Cable grade, mesh type and fixings are written on the quote, so you know exactly what goes up.'],
    ['icon' => 'anchor', 'heading' => 'Fixed into concrete', 'text' => 'Anchors go into the slab, beam or parapet — never into tiles, grout or loose plaster.'],
    ['icon' => 'sun', 'heading' => 'Chosen for the weather', 'text' => 'Sea air in Vizag, river damp in Rajahmundry, summer heat in Vijayawada and Kurnool — the material is matched to it.'],
];
