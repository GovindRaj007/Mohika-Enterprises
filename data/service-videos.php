<?php
/**
 * Short installation clips per service — upright phone videos (9:16),
 * served from /assets/videos/ as H.264 MP4 (no audio, fast-start) with a
 * WebP poster frame. Originals live in source-videos/; re-encode with
 * ffmpeg as described in README → "Videos".
 *
 * Each clip has its own watch page, /{slug}.php (templates/video.php):
 * Google only indexes a video on a page whose main content is that video,
 * so the home and service pages show the clips and link to these pages,
 * and only the watch pages carry VideoObject markup and the video sitemap.
 *
 * Video and poster URLs are never cache-busted (no ?v=): the <video> tag,
 * the structured data and the sitemap must all name exactly the same URL.
 * To replace a clip, give the new file a new name.
 *
 * 'home' => true puts a clip in the home page's "in action" section.
 * 'caption' is shown under the clip and doubles as its text alternative
 * (the clips have no speech, so a visible description is enough for
 * WCAG 1.2.1). 'duration' is ISO 8601; 'date' is a full ISO 8601 date-time
 * with the India time zone, as Google's video rich results require.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    'invisible-grills' => [
        ['file' => 'invisible-grills-1', 'w' => 478, 'h' => 850, 'duration' => 'PT17S', 'date' => '2026-10-09T10:00:00+05:30', 'home' => true,
         'slug' => 'invisible-grill-cable-tension-video',
         'title' => 'Checking invisible grill cable tension',
         'seo_title' => 'Invisible Grill Cable Tension Check – Video | Mohika',
         'description' => 'Video: our installer tests the tension of newly fitted invisible grill cables on an apartment balcony, cable by cable, before handing over.',
         'caption' => 'Testing the tension of newly fitted invisible grill cables on an apartment balcony.',
         'about' => [
             'Every invisible grill is checked by hand before we hand it over. In this clip our installer runs along the newly fitted cables on an apartment balcony and presses on them to confirm each one is tight and evenly spaced.',
             'A properly tensioned cable does not sag or spread apart when pushed, which is what keeps the gap child-safe for years. If a cable gives, it is re-tensioned on the spot.',
         ]],
        ['file' => 'invisible-grills-2', 'w' => 478, 'h' => 850, 'duration' => 'PT12S', 'date' => '2026-10-09T10:00:00+05:30', 'home' => true,
         'slug' => 'balcony-invisible-grills-video',
         'title' => 'A balcony closed with invisible grills',
         'seo_title' => 'Balcony Closed With Invisible Grills – Video | Mohika',
         'description' => 'Video: a balcony closed with invisible grills from the railing up to the ceiling, filmed right after installation.',
         'caption' => 'A balcony closed with invisible grills from railing to ceiling, right after installation.',
         'about' => [
             'This clip shows a balcony right after our team finished it: invisible grill cables run from the railing all the way up to the ceiling, so the whole opening is closed.',
             'The cables are thin enough that the balcony still feels open, while the full-height coverage means there is no gap above the railing for a child to climb through.',
         ]],
        ['file' => 'invisible-grills-3', 'w' => 480, 'h' => 864, 'duration' => 'PT6S', 'date' => '2026-10-09T10:00:00+05:30',
         'slug' => 'view-through-invisible-grills-video',
         'title' => 'The view through invisible grills',
         'seo_title' => 'The View Through Invisible Grills – Video | Mohika',
         'description' => 'Video: looking out through invisible grills from inside a home — the houses and the sky stay clearly in view.',
         'caption' => 'Looking out through invisible grills — the houses and the sky stay clearly in view.',
         'about' => [
             'Families choose invisible grills over traditional grills for safety, added security and a cleaner, modern look — and for the view, which this short clip shows. It is filmed from inside, looking out through a finished installation.',
             'The neighbouring houses and the sky stay in clear view — the cables barely register — while the opening behind them is fully protected.',
         ]],
    ],
    'ceiling-cloth-hangers' => [
        ['file' => 'ceiling-cloth-hangers', 'w' => 360, 'h' => 640, 'duration' => 'PT10S', 'date' => '2026-10-09T10:00:00+05:30',
         'slug' => 'ceiling-cloth-hanger-video',
         'title' => 'Ceiling cloth hanger on a balcony',
         'seo_title' => 'Ceiling Cloth Hanger on a Balcony – Video | Mohika',
         'description' => 'Video: a ceiling cloth hanger fitted on a balcony — the drying rods lower on their pulleys and lift back up to the ceiling.',
         'caption' => 'A ceiling cloth hanger fitted on a balcony — the rods lower on their pulleys and lift back up.',
         'about' => [
             'A ceiling cloth hanger keeps clothes up and out of the way while they dry. In this clip the rods are lowered on their pulleys to hang the washing, then lifted back up towards the ceiling.',
             'With the hanger fitted to the ceiling, the balcony floor stays free, and the clothes dry in the air at the top of the balcony.',
         ]],
        ['file' => 'wall-mount-cloth-hangers', 'w' => 478, 'h' => 850, 'duration' => 'PT7S', 'date' => '2026-10-09T10:00:00+05:30',
         'slug' => 'wall-mount-cloth-hanger-video',
         'title' => 'Wall mount cloth hanger on a high-rise balcony',
         'seo_title' => 'Wall Mount Cloth Hanger Fitting – Video | Mohika',
         'description' => 'Video: a wall mount cloth hanger being fitted and tested on a high-rise balcony — an option where a ceiling hanger will not suit.',
         'caption' => 'A wall mount cloth hanger being fitted and tested on a high-rise balcony.',
         'about' => [
             'Where a ceiling hanger will not suit the balcony, a wall mount cloth hanger is the alternative. This clip shows one being fitted and tested on a high-rise balcony.',
             'It is fixed to the wall rather than the ceiling, so it works under false ceilings and on balconies where the ceiling is out of reach.',
         ]],
    ],
];
