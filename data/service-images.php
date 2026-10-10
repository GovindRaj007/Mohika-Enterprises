<?php
/**
 * Installation photos per service, with alt text describing what each photo
 * actually shows — written for a screen-reader user first and image search
 * second, never as a keyword list.
 *
 * 'main' is the service's cover, chosen by the client: the service card,
 * the hero on its pages, and (as a 1200×630 JPEG crop in /assets/images/og/)
 * its sharing card. It is also the first gallery entry.
 *
 * 'hero' is the wide background for the service's slide in the home page
 * hero — the sharpest landscape photo of the set (own 640/1024/1440
 * variants), which is not always the main photo.
 *
 * Every file named here exists in data/image-manifest.php, and every photo
 * in the manifest is named here — tools/check-site.php checks both ways.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    'invisible-grills' => [
        'main'    => 'invisible-grills-balcony-glass-railing',
        'hero'    => ['hero-invisible-grills', 'High-rise apartment towers seen clearly through invisible grill cables on a balcony'],
        'gallery' => [
            ['invisible-grills-balcony-glass-railing', 'A woman at her balcony with a glass railing, checking the invisible grill cables fitted above it'],
            ['invisible-grills-high-rise-balcony', 'Invisible grills across a high-rise balcony above a black railing, the city and greenery visible through them'],
            ['invisible-grills-tower-view', 'Invisible grills on a tower balcony with neighbouring apartment blocks and open sky beyond'],
            ['invisible-grills-apartment-balconies', 'Two apartment balconies fitted with invisible grills, one beside an AC unit and one facing tall towers'],
            ['window-invisible-grills-sliding-window', 'Window invisible grills — horizontal steel cables fitted behind a sliding glass window'],
            ['window-invisible-grills-living-room', 'Window invisible grills on living-room windows, with potted plants on the sill'],
        ],
    ],

    'balcony-safety-nets' => [
        'main'    => 'balcony-safety-net-wide-balcony',
        'hero'    => ['hero-balcony-safety-nets', 'A wide apartment balcony closed with a white balcony safety net, rooftops and the city behind the mesh'],
        'gallery' => [
            ['balcony-safety-net-wide-balcony', 'A white balcony safety net running from the railing to the ceiling across a wide apartment balcony'],
            ['balcony-safety-net-high-rise-family', 'A man standing on a high-rise balcony enclosed by a full-height balcony safety net'],
            ['balcony-safety-net-full-height', 'A long balcony closed from floor to ceiling with a safety net, a man standing beside it'],
            ['children-safety-net-close-up', 'A child looking out through a children safety net fitted on a balcony'],
            ['children-safety-net-long-balcony', 'A narrow balcony fully enclosed with a children safety net down its whole length'],
        ],
    ],

    'pigeon-nets' => [
        'main'    => 'pigeon-safety-net-apartment-balcony',
        'hero'    => ['hero-pigeon-nets', 'An open area net stretched over a courtyard between buildings to keep pigeons out'],
        'gallery' => [
            ['pigeon-safety-net-apartment-balcony', 'An apartment balcony sealed with a pigeon safety net, a man standing inside'],
            ['pigeon-net-tall-balcony', 'A tall balcony closed with a pigeon net, the city visible through the mesh'],
            ['pigeon-safety-net-high-rise', 'A pigeon safety net on a high-rise balcony, apartment towers in the distance'],
            ['open-area-net-terrace', 'An open area net laid flat over a terrace opening to keep birds out'],
            ['open-area-net-courtyard', 'An open area net covering an open courtyard and pool area from wall to wall'],
            ['duct-area-nets-apartment-shafts', 'Duct area nets fitted across the service shafts of apartment buildings'],
        ],
    ],

    'cricket-nets' => [
        'main'    => 'cricket-net-ball-stopped',
        'hero'    => ['hero-cricket-nets', 'Covered multi-lane cricket practice nets with a roof net over green turf'],
        'gallery' => [
            ['cricket-net-ball-stopped', 'A red leather cricket ball caught in a green cricket net on a lawn'],
            ['cricket-practice-nets-lanes', 'Multi-lane cricket practice nets with a top net, on green artificial turf'],
            ['box-cricket-net-rooftop-turf', 'A rooftop box cricket net enclosure over artificial turf, floodlit at night'],
            ['cricket-practice-nets-batting', 'Batters and bowlers practising inside cricket practice nets'],
            ['cricket-net-knotted-mesh', 'Close-up of heavy knotted cricket net mesh against the sky'],
        ],
    ],

    'ceiling-cloth-hangers' => [
        'main'    => 'ceiling-cloth-hanger-utility-ceiling',
        'hero'    => ['hero-ceiling-cloth-hangers', 'Stainless steel ceiling cloth hanger rods hanging from a utility ceiling on pulley ropes'],
        'gallery' => [
            ['ceiling-cloth-hanger-utility-ceiling', 'Stainless steel ceiling cloth hanger rods hanging from the ceiling of a utility area'],
            ['ceiling-cloth-hanger-balcony-ceiling', 'A pulley ceiling cloth hanger fixed to a balcony ceiling'],
            ['ceiling-cloth-hanger-with-clothes', 'A ceiling cloth hanger loaded with shirts and clothes on hangers'],
            ['wall-mount-cloth-hanger-terrace', 'A wall mount cloth hanger fixed to a terrace wall, rods folded out'],
            ['wall-mount-cloth-hanger-balcony', 'A wall mount cloth hanger fixed beside a balcony window'],
        ],
    ],
];
