<?php
/**
 * Short installation clips per service — upright phone videos (9:16),
 * served from /assets/videos/ as H.264 MP4 (no audio, fast-start) with a
 * WebP poster frame. Originals live in source-videos/; re-encode with
 * ffmpeg as described in README → "Videos".
 *
 * 'home' => true puts a clip in the home page's "in action" section.
 * 'caption' is shown under the clip and doubles as its text alternative
 * (the clips have no speech, so a visible description is enough for
 * WCAG 1.2.1). 'duration' (ISO 8601) and 'date' feed the VideoObject schema.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    'invisible-grills' => [
        ['file' => 'invisible-grills-1', 'w' => 478, 'h' => 850, 'duration' => 'PT17S', 'date' => '2026-10-09', 'home' => true,
         'title' => 'Checking invisible grill cable tension',
         'caption' => 'Testing the tension of newly fitted invisible grill cables on an apartment balcony.'],
        ['file' => 'invisible-grills-2', 'w' => 478, 'h' => 850, 'duration' => 'PT12S', 'date' => '2026-10-09', 'home' => true,
         'title' => 'A balcony closed with invisible grills',
         'caption' => 'A balcony closed with invisible grills from railing to ceiling, right after installation.'],
        ['file' => 'invisible-grills-3', 'w' => 480, 'h' => 864, 'duration' => 'PT6S', 'date' => '2026-10-09',
         'title' => 'The view through invisible grills',
         'caption' => 'Looking out through invisible grills — the houses and the sky stay clearly in view.'],
    ],
    'ceiling-cloth-hangers' => [
        ['file' => 'ceiling-cloth-hangers', 'w' => 360, 'h' => 640, 'duration' => 'PT10S', 'date' => '2026-10-09',
         'title' => 'Ceiling cloth hanger on a balcony',
         'caption' => 'A ceiling cloth hanger fitted on a balcony — the rods lower on their pulleys and lift back up.'],
        ['file' => 'wall-mount-cloth-hangers', 'w' => 478, 'h' => 850, 'duration' => 'PT7S', 'date' => '2026-10-09',
         'title' => 'Wall mount cloth hanger on a high-rise balcony',
         'caption' => 'A wall mount cloth hanger being fitted and tested on a high-rise balcony.'],
    ],
];
