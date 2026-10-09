<?php
/**
 * Blog posts — each served at /{slug}.php with Article schema. Each answers
 * an informational search that comes before a purchase (comparison, "how
 * to", sizing) and links to the matching service and city pages.
 *
 * Sections are [heading, paragraphs[]]; paragraphs may contain <strong>/<em>
 * only. 'links' are service slugs the post points readers to.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [

    'invisible-grills-vs-balcony-safety-nets' => [
        'slug'        => 'invisible-grills-vs-balcony-safety-nets',
        'title'       => 'Invisible Grills vs Balcony Safety Nets: Which Is Right for Your Balcony?',
        'seo_title'   => 'Invisible Grills vs Balcony Safety Nets | Mohika',
        'description' => 'Invisible grills or balcony safety nets? Compare view, safety, cost, upkeep and pigeon protection to pick the right one for your balcony.',
        'keywords'    => ['invisible grills vs safety nets', 'invisible grills or safety nets', 'balcony safety options', 'invisible grills', 'balcony safety nets'],
        'date'        => '2026-10-06',
        'image'       => 'invisible-grills-high-rise-balcony',
        'image_alt'   => 'Invisible grills across a high-rise balcony above a black railing, the city visible through them',
        'og_image'    => '/assets/images/og/og-invisible-grills.jpg',
        'excerpt'     => 'Both stop a fall. They differ in how much of the view they keep, what they cost on a wide opening and whether they also keep pigeons out.',
        'links'       => ['invisible-grills', 'balcony-safety-nets'],
        'sections'    => [
            ['heading' => 'Two ways to make a balcony safe', 'paragraphs' => [
                'If you are choosing between <strong>invisible grills</strong> and <strong>balcony safety nets</strong>, the good news is that both do the main job well: properly fitted, either one stops a child, a pet or an adult from falling. The choice comes down to what else you want from the balcony — the view, the budget, pigeon protection, or how it looks from the street.',
                'An invisible grill is a row of thin stainless steel cables, tensioned and anchored into the concrete around the opening. A balcony safety net is a tensioned HDPE mesh fixed around the whole opening, usually from the floor to the ceiling.',
            ]],
            ['heading' => 'View and light', 'paragraphs' => [
                'This is where invisible grills win. A few feet back from the cables, the opening reads as open space; most families stop noticing the grill within a week. A safety net is see-through too, but a mesh is naturally more visible than a row of cables, especially in direct light.',
                'If the balcony faces the sea in Vizag, the Godavari in Rajahmundry or the Tirumala hills in Tirupati, that difference usually decides it.',
            ]],
            ['heading' => 'Safety for children, pets and elders', 'paragraphs' => [
                'Both are safe when fitted correctly. An invisible grill with a 2-inch spacing is narrower than a toddler’s head. A safety net covers the full height, including the gap above a low parapet or a glass railing, and can be ordered in a smaller mesh for cats.',
                'For cats specifically, a net is often the better choice — a determined cat can squeeze surprisingly small gaps, and a fine mesh removes the question entirely.',
            ]],
            ['heading' => 'Cost on a wide balcony', 'paragraphs' => [
                'Both are priced by the square foot of the opening. On a large or full-height balcony, a safety net usually costs less than an invisible grill of the same area. On a window or a narrow balcony, the difference is smaller. We measure on the site visit and quote both if you are undecided.',
            ]],
            ['heading' => 'Pigeons', 'paragraphs' => [
                'Both keep pigeons off the balcony when the opening is closed from edge to edge. Where birds are already nesting nearby — in a duct shaft, on AC ledges or sunshades — add a dedicated <strong>pigeon net</strong> for those spaces too, so they are not simply pushed next door.',
            ]],
            ['heading' => 'Upkeep and lifespan', 'paragraphs' => [
                'SS 316 invisible grills need almost nothing: an occasional wipe, and a tension check if a cable ever feels loose. UV-treated nets also last for years; they may need re-tensioning after the first weeks as the mesh settles, and a rinse when dust builds up.',
            ]],
            ['heading' => 'So which should you choose?', 'paragraphs' => [
                'Choose an <strong>invisible grill</strong> if the view matters most. Choose a <strong>balcony safety net</strong> if you want full-height cover at a lower cost on a wide balcony, or have cats. If you are still unsure, ask us to bring samples of both to the site visit.',
            ]],
        ],
    ],

    'how-to-stop-pigeons-on-balcony' => [
        'slug'        => 'how-to-stop-pigeons-on-balcony',
        'title'       => 'How to Stop Pigeons on Your Balcony for Good: A Pigeon Nets Guide',
        'seo_title'   => 'How to Stop Pigeons on Your Balcony | Pigeon Nets Guide',
        'description' => 'Why spikes, gels and CDs fail, why pigeons return after cheap netting, and how a sealed pigeon safety net keeps birds off balconies, ducts and AC ledges.',
        'keywords'    => ['how to stop pigeons on balcony', 'pigeon nets', 'pigeon safety nets', 'anti bird nets', 'duct area nets'],
        'date'        => '2026-10-06',
        'image'       => 'pigeon-safety-net-high-rise',
        'image_alt'   => 'A pigeon safety net sealing a high-rise balcony, apartment towers in the distance',
        'og_image'    => '/assets/images/og/og-pigeon-nets.jpg',
        'excerpt'     => 'Most pigeon fixes only move the birds a few feet. Here is what actually works, and the one detail that decides whether they come back.',
        'links'       => ['pigeon-nets', 'balcony-safety-nets'],
        'sections'    => [
            ['heading' => 'Why pigeons choose your balcony', 'paragraphs' => [
                'Pigeons look for three things: a sheltered ledge, a quiet corner to nest, and a reason to come back. Apartment balconies, AC ledges and duct shafts offer all three. Once a pair has nested, they return to the same spot again and again — which is why a pigeon problem gets worse, not better, if it is left alone.',
            ]],
            ['heading' => 'What does not work for long', 'paragraphs' => [
                '<strong>Spikes</strong> stop birds landing on one narrow ledge, and they simply move a little further along. <strong>Gels and sprays</strong> wear off in the sun and rain. <strong>CDs, reflective tape and plastic owls</strong> work for a few days until the birds get used to them. None of these closes the space itself, so the birds always find somewhere next to it.',
            ]],
            ['heading' => 'What does work: a sealed pigeon net', 'paragraphs' => [
                'A <strong>pigeon safety net</strong> is a fine, UV-treated nylon mesh fixed across the opening and sealed to the structure on every side. It is an exclusion rather than a deterrent — the birds are not scared away, they are simply unable to get in. Done properly, it is permanent.',
                'It is also humane. Before a net is closed, any nest is cleared and the space is checked so no bird is trapped inside.',
            ]],
            ['heading' => 'The detail that decides everything: the edges', 'paragraphs' => [
                'When a pigeon net fails, it is almost always at the edge. A gap at a beam, a ceiling corner or around a drain pipe is all a pigeon needs, and they will find it within weeks. A good installation fixes the net on a perimeter wire and seals it tight to every surface it meets — including around pipes, AC brackets and grills.',
                'Near the coast, as in Visakhapatnam, that edge wire and the hooks must be stainless steel. Ordinary steel rusts in salt air, the edge loosens, and the gap reopens.',
            ]],
            ['heading' => 'Do not forget the duct', 'paragraphs' => [
                'In many apartment buildings the real source is the duct shaft, where pigeons breed out of sight and spread to the balconies around it. Netting your own balcony helps you, but the birds keep coming while the shaft is open. <strong>Duct area nets</strong> — fitted floor by floor or at the top of the shaft, with openable sections for plumbers — fix it for the whole building, and are usually arranged through the association.',
            ]],
            ['heading' => 'Clean up safely before the net goes on', 'paragraphs' => [
                'Pigeon droppings carry dust and germs. Wear gloves and a mask, dampen dry droppings before removing them so the dust does not lift, and wash the area down. If the build-up is heavy, ask the installer to clear it as part of the job.',
            ]],
            ['heading' => 'In short', 'paragraphs' => [
                'Skip the spikes and gels. Net the space, seal every edge, and deal with the duct if there is one. That is what keeps pigeons off a balcony for good.',
            ]],
        ],
    ],

    'cricket-practice-nets-setup-guide' => [
        'slug'        => 'cricket-practice-nets-setup-guide',
        'title'       => 'Cricket Practice Nets Setup: Planning the Size, Net and Frame',
        'seo_title'   => 'Cricket Practice Nets Setup Guide | Mohika',
        'description' => 'Planning cricket practice nets or box cricket? How to size the lane, choose the net and build a frame that lasts on a ground, a terrace or a turf.',
        'keywords'    => ['cricket nets setup', 'cricket practice nets', 'box cricket nets', 'cricket practice nets size', 'terrace cricket nets'],
        'date'        => '2026-10-06',
        'image'       => 'cricket-practice-nets-lanes',
        'image_alt'   => 'Multi-lane cricket practice nets on green artificial turf',
        'og_image'    => '/assets/images/og/og-cricket-nets.jpg',
        'excerpt'     => 'A practice net that lasts is planned around the space, the type of ball and what lies beyond the net. Here is how to get it right.',
        'links'       => ['cricket-nets'],
        'sections'    => [
            ['heading' => 'Start with the space, not the net', 'paragraphs' => [
                'Every good <strong>cricket nets setup</strong> starts with a tape measure. How long is the space? Is there room for a bowler’s run-up behind the stumps? How high can the roof net go? And what is on the other side — a road, a neighbour’s window, a parked car? Those answers decide the layout before anyone talks about netting.',
            ]],
            ['heading' => 'Practice lanes vs box cricket', 'paragraphs' => [
                'A <strong>cricket practice net</strong> is a lane, normally closed on three sides and over the top, for batting and bowling practice. A <strong>box cricket net</strong> encloses an entire turf on every side and overhead, so a full game can be played in a small space. Homes, schools and academies usually want lanes; turf owners and apartment communities usually want box cricket.',
            ]],
            ['heading' => 'Sizing a practice lane', 'paragraphs' => [
                'There is no single correct size. A full-length lane needs the pitch plus room behind both sets of stumps; a home lane is often shorter and narrower and still very useful for batting practice. The roof net keeps lofted shots inside — essential on a terrace, and wherever the ball could reach a road or a window.',
            ]],
            ['heading' => 'Choosing the net', 'paragraphs' => [
                'For leather-ball cricket, use heavy <strong>knotted HDPE netting</strong> that holds the ball without stretching through. For tennis-ball play a lighter net is enough. Outdoors, insist on <strong>UV-treated</strong> net — in an Andhra summer, untreated netting fades and turns brittle within a season or two. On heavily used lanes, a second layer behind the stumps takes the hardest hits.',
            ]],
            ['heading' => 'The frame is what makes it last', 'paragraphs' => [
                'Nets hang from steel poles and tensioned cables. Use <strong>galvanised</strong> poles so the base does not rust. On the ground, set them in concrete footings; on a terrace, bolt them down with base plates onto the slab. Near the coast, size the poles and cables for the wind — a large net behaves like a sail.',
                'Secure the bottom edge along the ground. Balls slipping under a loose net are the most common complaint about cheap setups.',
            ]],
            ['heading' => 'Lights and drainage', 'paragraphs' => [
                'If the nets will be used in the evening — and most box cricket turfs are — plan the floodlight positions with the poles, not afterwards. On open ground, plan the base so rainwater drains away from the lane.',
            ]],
            ['heading' => 'What decides the cost', 'paragraphs' => [
                'Cricket nets are priced on the net area plus the framing: the number of poles, the cable work and the footings. Roof netting, extra layers and floodlight mounts add to it. A site visit gives you a layout and a written quote you can compare properly.',
            ]],
        ],
    ],

    'ceiling-cloth-hanger-buying-guide' => [
        'slug'        => 'ceiling-cloth-hanger-buying-guide',
        'title'       => 'Ceiling Cloth Hanger Buying Guide: Rods, Lengths and Safe Fixing',
        'seo_title'   => 'Ceiling Cloth Hanger Buying Guide | Mohika',
        'description' => 'How to choose a ceiling cloth hanger — stainless vs plated rods, rod length and count, pulley systems and why it must be fixed into the concrete slab.',
        'keywords'    => ['ceiling cloth hanger', 'ceiling cloth hanger installation', 'cloth drying ceiling hanger', 'pulley cloth hanger', 'cloth drying hanger for balcony'],
        'date'        => '2026-10-06',
        'image'       => 'ceiling-cloth-hanger-with-clothes',
        'image_alt'   => 'Ceiling cloth hanger loaded with shirts and clothes on hangers',
        'og_image'    => '/assets/images/og/og-ceiling-cloth-hangers.jpg',
        'excerpt'     => 'A good ceiling cloth hanger takes a full wash load, never rusts onto your clothes and stays fixed for years. Here is what to check.',
        'links'       => ['ceiling-cloth-hangers', 'balcony-safety-nets'],
        'sections'    => [
            ['heading' => 'Why a ceiling hanger beats a floor stand', 'paragraphs' => [
                'A <strong>ceiling cloth hanger</strong> uses the one part of a balcony or utility area nobody else uses — the ceiling. The floor stays clear, and because warm air rises, clothes dry faster up there than on a stand at floor level. In the monsoon, it is often the only place washing dries at all.',
            ]],
            ['heading' => 'Stainless steel or plated rods?', 'paragraphs' => [
                'Choose <strong>stainless steel</strong> rods. Painted and chrome-plated rods are cheaper, but once the coating chips they rust — and rust transfers straight onto wet clothes. Near the sea, as in Visakhapatnam, plated rods can spot with rust within months.',
            ]],
            ['heading' => 'How many rods, and how long?', 'paragraphs' => [
                'Most families are well served by <strong>six rods</strong>, which hold roughly a full machine load. Rod length follows the ceiling: common sizes are 4, 5 and 6 feet. Measure the clear width, and check that the rods will not clash with a door swing, a ceiling fan or a light.',
            ]],
            ['heading' => 'The pulley system', 'paragraphs' => [
                'In a good <strong>pulley cloth hanger</strong>, each rod has its own rope and pulley, so you can lower one rod to load while the others stay up drying. The rope lock should hold a rod at any height without slipping. Synthetic ropes are better than cotton in humid cities — they do not rot.',
            ]],
            ['heading' => 'Fixing: the part that matters most', 'paragraphs' => [
                'A loaded hanger is heavy, and it hangs over people’s heads. The brackets must be fixed into the <strong>concrete slab</strong> with proper anchors — not into a false ceiling, plaster or a tile bed. If there is a false ceiling, the fixing has to go through it into the slab above, or the hanger should go somewhere else.',
            ]],
            ['heading' => 'Fit it with your balcony work', 'paragraphs' => [
                'If you are also getting a <strong>balcony safety net</strong> or invisible grill, have the hanger fitted on the same visit. The balcony is measured once, and the drying line is planned around the net or grill rather than squeezed in later.',
            ]],
        ],
    ],
];
