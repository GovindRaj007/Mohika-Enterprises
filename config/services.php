<?php
/**
 * The five services — the single source for service pages, service × city
 * pages, cards, menus, the quote form, schema and the sitemap.
 *
 * Writing rules followed here:
 *  - 'specs' restates 'materials' row by row and adds no new claim.
 *  - No price, warranty period, install count or certification number —
 *    none was supplied. TODO(client): confirm every material/spec line
 *    matches what Mohika actually fits before launch.
 *  - Keyword phrases come from Google India autocomplete research (see
 *    KEYWORDS.md): each service's 'keywords' list is what people type,
 *    and the copy uses those phrases where they read naturally.
 *
 * 'h1' is the bare service name (schema, breadcrumbs). The page H1 is
 * "{h1} in Andhra Pradesh"; city pages use "{h1} in {City}".
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [

    'invisible-grills' => [
        'slug'        => 'invisible-grills',
        'nav_label'   => 'Invisible Grills',
        'h1'          => 'Invisible Grills',
        'singular'    => 'invisible grill',
        'h1_tag'      => 'SS 316 cable for balconies & windows',
        'tagline'     => 'Safety you can see through',
        'icon'        => 'grill',
        'og_image'    => '/assets/images/og/og-invisible-grills.jpg',
        'service_type'=> 'Invisible grill installation',

        'title_candidates' => [
            'Invisible Grills in Andhra Pradesh – Balcony & Window | Mohika',
            'Invisible Grills in Andhra Pradesh – SS 316 Cable | Mohika',
            'Invisible Grills in Andhra Pradesh | Mohika',
        ],
        'meta_description' => 'Invisible grills for balconies and windows in Andhra Pradesh — SS 316 marine-grade cable, child-safe spacing, fitted in Vizag, Vijayawada, Guntur & more.',
        'meta_keywords'    => ['invisible grills', 'invisible grills in andhra pradesh', 'invisible grill for balcony', 'window invisible grills', 'invisible grill installation', 'invisible grills near me', 'SS 316 invisible grills', 'invisible grill price per sq ft'],

        'card_summary' => 'Thin SS 316 cables run across a balcony or window, tensioned into the structure — fall protection that keeps the view and the breeze.',
        'card_note'    => 'SS 316 cable · child-safe gap',
        'feats'        => ['SS 316 marine-grade cable', 'Child-safe 2-inch spacing', 'No welded frame, no rust stains'],

        'intro' => 'Invisible grills are for the balcony you bought for its view and do not want to cage. Instead of welded bars, the opening is crossed by slim stainless steel cables, each one tensioned between anchors set into the parapet and the slab above. A child cannot squeeze between them, a pet cannot jump through, and from the sofa you mostly forget they are there. We fit invisible grills on apartment balconies, bedroom and kitchen windows, sit-outs, staircase openings and terrace edges across Andhra Pradesh.',
        'what_is' => 'An invisible grill is a set of high-tensile stainless steel cables fixed at a set spacing across an opening and held under tension by anchors in the surrounding concrete. There is no frame across the middle and no pattern of bars, which is why it reads as open space rather than a cage. Its strength comes from the cable grade, the spacing and the tension — not from bulk — so all three are what we measure, specify and check.',

        'keyword_families' => [
            ['heading' => 'Balcony invisible grills', 'text' => 'The most common job: full-width cables from the parapet to the slab, so the balcony stays a balcony — chairs, plants and the evening breeze included — without the drop.'],
            ['heading' => 'Window invisible grills', 'text' => 'For bedroom, kitchen and staircase windows on upper floors. Cables sit inside the frame so the window still opens fully and nothing blocks the light.'],
            ['heading' => 'Invisible grills for child and pet safety', 'text' => 'A gap narrower than a toddler’s head and a cat’s shoulders, under enough tension that it does not spread when pushed or climbed.'],
        ],

        'benefits' => [
            ['heading' => 'The view stays open', 'text' => 'Fine cable at even spacing nearly disappears from a few feet back — no bars cutting up the sky.'],
            ['heading' => 'Child and pet safe', 'text' => 'Spacing set narrower than a small child’s head, under tension so it holds its gap.'],
            ['heading' => 'Rust-free for years', 'text' => 'SS 316 marine-grade cable and stainless fittings — no repainting, no rust streaks down the wall.'],
            ['heading' => 'Fits any opening', 'text' => 'Curved balconies, L-shaped corners, half-height parapets and odd window bays are measured and cut on site.'],
            ['heading' => 'Approved by most associations', 'text' => 'No change to the building’s face from the street, which is why apartment committees usually allow them.'],
            ['heading' => 'Light and air untouched', 'text' => 'Sunlight, breeze and rain pass straight through; nothing to clean except the occasional wipe.'],
        ],

        'applications' => [
            'High-floor apartment balconies with a view worth keeping',
            'Bedroom, kitchen and staircase windows on upper floors',
            'Low parapets and glass railings that leave a dangerous gap above',
            'Duplex staircases, sit-outs and open terrace edges',
        ],

        'materials' => 'We fit SS 316 marine-grade stainless steel cable, typically 2 mm to 2.5 mm thick with a nylon coating, run vertically at a 2-inch spacing. The cables sit in aluminium tracks fixed top and bottom with stainless anchor bolts into the slab and parapet concrete — never into tiles or plaster — and each run is tensioned individually so the spacing holds across the full width.',
        'specs' => [
            ['label' => 'Cable', 'value' => 'SS 316 marine-grade stainless steel, nylon-coated'],
            ['label' => 'Thickness', 'value' => 'Typically 2 mm to 2.5 mm'],
            ['label' => 'Spacing', 'value' => '2 inches, held across the full width'],
            ['label' => 'Tracks', 'value' => 'Aluminium, fixed top and bottom'],
            ['label' => 'Anchoring', 'value' => 'Stainless anchor bolts into slab and parapet concrete'],
            ['label' => 'Tension', 'value' => 'Each cable tensioned individually'],
        ],

        'why_choose' => 'With invisible grills, everything that matters is hard to see. Cable grade, spacing and tension decide whether a grill holds, and none of them shows up in a photo. We write the cable grade and thickness on the quotation, keep the spacing even across the whole run, and anchor into concrete rather than whatever is easiest to drill — so what you pay for is what goes up.',
        'install_step_text' => 'Tracks are fixed top and bottom into sound concrete, each cable is threaded and tensioned in turn, and the run is checked for even spacing before the site is cleaned.',

        'comparison' => [
            'title' => 'Invisible grills vs MS grills',
            'rows'  => [
                ['label' => 'View', 'a' => 'Open — thin cables', 'b' => 'Boxed in by bars'],
                ['label' => 'Rust', 'a' => 'SS 316 does not rust', 'b' => 'Needs repainting'],
                ['label' => 'Weight on the structure', 'a' => 'Light', 'b' => 'Heavy welded frame'],
                ['label' => 'Look from the street', 'a' => 'Barely visible', 'b' => 'Changes the facade'],
            ],
            'a' => 'Invisible grills', 'b' => 'MS grills',
        ],

        'faqs' => [
            ['question' => 'Are invisible grills strong enough to stop a fall?', 'answer' => 'Yes, when the cable grade, spacing and anchoring are right. Each cable is under tension and anchored into concrete, so the grill takes a lean, a push or a child climbing without the gap opening up. We check every run for tension before we hand over.'],
            ['question' => 'Is a 2-inch gap safe for small children?', 'answer' => 'Two inches is narrower than a toddler’s head, which is the standard the spacing is set against. Because each cable is tensioned, the gap does not widen when a child pushes on it.'],
            ['question' => 'Will invisible grills spoil the view?', 'answer' => 'Up close you can see the cables; from a few feet back the opening reads as open. Most customers stop noticing them within days, which is the whole reason to choose them over an MS grill.'],
            ['question' => 'Does the installation damage the balcony?', 'answer' => 'Tracks are fixed with anchor bolts into the slab and parapet concrete, not the tiles. Holes are filled and the area cleaned before we leave.'],
            ['question' => 'How is the invisible grill price worked out?', 'answer' => 'Invisible grills are priced per square foot of the opening, and the rate depends on the cable thickness and the fixing conditions. We measure on the site visit and give you a written quote before any work starts.'],
        ],

        'related' => ['balcony-safety-nets', 'pigeon-nets'],
    ],

    'balcony-safety-nets' => [
        'slug'        => 'balcony-safety-nets',
        'nav_label'   => 'Balcony Safety Nets',
        'h1'          => 'Balcony Safety Nets',
        'singular'    => 'balcony safety net',
        'h1_tag'      => 'Children, pet & senior safety, floor to ceiling',
        'tagline'     => 'The whole opening, closed',
        'icon'        => 'net',
        'og_image'    => '/assets/images/og/og-balcony-safety-nets.jpg',
        'service_type'=> 'Balcony safety net installation',

        'title_candidates' => [
            'Balcony Safety Nets in Andhra Pradesh – Child & Pet Safe | Mohika',
            'Balcony Safety Nets in Andhra Pradesh | Children Safety Nets',
            'Balcony Safety Nets in Andhra Pradesh | Mohika',
        ],
        'meta_description' => 'Balcony safety nets and children safety nets in Andhra Pradesh — UV-treated HDPE mesh fitted floor to ceiling for kids, pets and elders. Free site visit.',
        'meta_keywords'    => ['balcony safety nets', 'balcony safety nets in andhra pradesh', 'children safety nets', 'safety nets for balcony', 'balcony safety nets near me', 'balcony safety net installation', 'pet safety nets', 'balcony safety nets price'],

        'card_summary' => 'UV-treated HDPE mesh tensioned across the full balcony opening — nothing to open, close or remember, and the balcony stays usable.',
        'card_note'    => 'UV-treated HDPE mesh',
        'feats'        => ['Full-height, floor to ceiling', 'UV-treated HDPE mesh', 'Nothing to operate'],

        'intro' => 'Balcony safety nets are the quickest way to take the fear out of an open balcony. A toddler who has just learned to climb, a cat that sits on the parapet, a parent who leans on the rail for balance — the net closes the entire opening, top to bottom, so the balcony goes back to being a place to sit rather than a place to watch. It is passive protection: there is no door to latch and nothing anyone has to remember.',
        'what_is' => 'A balcony safety net is a UV-treated HDPE mesh stretched across the open face of a balcony and fixed to the structure on every side. It is tensioned, not hung, so it takes a running push and springs back. Because it covers the full height rather than just raising the railing, it also closes the gap above a half-height parapet — the gap most balcony accidents happen through.',

        'keyword_families' => [
            ['heading' => 'Children safety nets', 'text' => 'Mesh small enough that a child’s hand or foot cannot get a hold, fitted from the floor tile to the ceiling so there is nothing to climb over.'],
            ['heading' => 'Pet safety nets for cats and dogs', 'text' => 'Cats are the reason many families call us. The mesh stops a jump at the parapet and a paw through the gap, and pets get their balcony back.'],
            ['heading' => 'Safety nets for elderly parents', 'text' => 'When someone steadies themselves on the rail, a net behind it removes the risk of a slip over the top without changing how the balcony is used.'],
        ],

        'benefits' => [
            ['heading' => 'Covers the full opening', 'text' => 'Floor to ceiling, so the gap above a low parapet is closed too.'],
            ['heading' => 'Nothing to operate', 'text' => 'No latch, no door — the protection is always on.'],
            ['heading' => 'UV-treated for AP sun', 'text' => 'HDPE mesh treated to resist months of direct summer sun.'],
            ['heading' => 'Balcony stays usable', 'text' => 'Air, light and rain pass through; plants and drying clothes stay.'],
            ['heading' => 'Lower cost on big openings', 'text' => 'On a wide balcony a net usually costs less than a grill of the same area.'],
            ['heading' => 'Easy to remove later', 'text' => 'If you move out or redo the balcony, the net comes down cleanly.'],
        ],

        'applications' => [
            'High-floor balconies in homes with toddlers or young children',
            'Balconies used by cats and small dogs',
            'Flats with elderly residents who lean on the railing',
            'Utility balconies, staircase landings and open corridors',
        ],

        'materials' => 'We fit UV-treated HDPE balcony safety nets in a mesh size chosen for who the net is protecting — smaller for toddlers and cats, standard for general fall safety. The mesh edge is laced to a perimeter rope and fixed with stainless steel hooks and anchors into the parapet, walls and slab, spaced closely enough that the net stays taut across the whole face.',
        'specs' => [
            ['label' => 'Mesh', 'value' => 'HDPE, UV-treated'],
            ['label' => 'Mesh size', 'value' => 'Chosen for toddlers, pets or general fall safety'],
            ['label' => 'Edge', 'value' => 'Laced to a perimeter rope'],
            ['label' => 'Fixings', 'value' => 'Stainless steel hooks and anchors'],
            ['label' => 'Fixed into', 'value' => 'Parapet, walls and slab'],
            ['label' => 'Finish', 'value' => 'Taut across the whole face'],
        ],

        'why_choose' => 'A safety net is only as strong as the point it hangs from, and fixings are the part nobody checks. We anchor into the structure, not into loose plaster or the grout between tiles, space the hooks to the load, and pull the mesh taut before we leave. If a new net settles in the first weeks, call us and we come back to re-tension it.',
        'install_step_text' => 'Stainless hooks are set around the opening, the perimeter rope is threaded and drawn tight, and the mesh is tensioned across the full face and checked at every fixing.',

        'comparison' => [
            'title' => 'Balcony safety nets vs invisible grills',
            'rows'  => [
                ['label' => 'Coverage', 'a' => 'Full height, floor to ceiling', 'b' => 'Across the opening'],
                ['label' => 'Look', 'a' => 'Visible mesh', 'b' => 'Barely visible cable'],
                ['label' => 'Cost on wide balconies', 'a' => 'Usually lower', 'b' => 'Usually higher'],
                ['label' => 'Keeps pigeons out', 'a' => 'Yes, with the right mesh', 'b' => 'Yes'],
            ],
            'a' => 'Safety nets', 'b' => 'Invisible grills',
        ],

        'faqs' => [
            ['question' => 'Net or invisible grill — which is better for my balcony?', 'answer' => 'Both stop a fall. A net covers the full height and usually costs less on a wide balcony; an invisible grill keeps the view clearer. We will show you both options on the site visit and quote whichever suits the balcony.'],
            ['question' => 'Can a child or a cat damage the net?', 'answer' => 'Not by pulling or climbing — the mesh is tensioned and the strands are strong. Sharp tools or constant chewing can cut any net, so we check the mesh size and fixing for the pet you have.'],
            ['question' => 'Will the net sag over time?', 'answer' => 'A little settling in the first weeks is normal and we re-tension it. A net that keeps sagging means poor anchoring, which is why we fix into the structure rather than plaster.'],
            ['question' => 'Can we still dry clothes on the balcony?', 'answer' => 'Yes. Air and sun pass through the mesh. Many families add a ceiling cloth hanger on the same visit so the floor stays clear.'],
            ['question' => 'How is the balcony safety net price calculated?', 'answer' => 'By the square foot of the opening, and the rate depends on the mesh you choose. We measure on the site visit and give you a written quote first.'],
        ],

        'related' => ['invisible-grills', 'pigeon-nets'],
    ],

    'pigeon-nets' => [
        'slug'        => 'pigeon-nets',
        'nav_label'   => 'Pigeon Nets',
        'h1'          => 'Pigeon Nets',
        'singular'    => 'pigeon net',
        'h1_tag'      => 'Pigeon safety nets, open area nets & duct area nets',
        'tagline'     => 'Birds out, balcony back',
        'icon'        => 'bird',
        'og_image'    => '/assets/images/og/og-pigeon-nets.jpg',
        'service_type'=> 'Pigeon net installation',

        'title_candidates' => [
            'Pigeon Nets in Andhra Pradesh – Pigeon Safety Nets | Mohika',
            'Pigeon Safety Nets in Andhra Pradesh | Mohika',
            'Pigeon Nets in Andhra Pradesh | Mohika',
        ],
        'meta_description' => 'Pigeon nets in Andhra Pradesh — pigeon safety nets for balconies, open area nets for courtyards and duct area nets for shafts, sealed edge to edge.',
        'meta_keywords'    => ['pigeon nets', 'pigeon safety nets', 'pigeon nets in andhra pradesh', 'pigeon nets for balconies', 'open area nets', 'duct area nets', 'duct area safety nets', 'pigeon net installation', 'anti bird nets', 'bird nets for balcony'],

        'card_summary' => 'Anti-bird nylon mesh sealed edge to edge across balconies, open areas and duct shafts, so pigeons have no gap to come back through.',
        'card_note'    => 'Anti-bird nylon mesh',
        'feats'        => ['Sealed edge to edge', 'Balconies, open areas & ducts', 'Humane — no spikes or gel'],

        'intro' => 'Pigeon nets are the permanent answer to droppings on the balcony, nests behind the AC unit and the cooing at dawn. Spikes, gels and shiny tape only move pigeons a few feet along; a pigeon net closes the space itself, so there is nowhere left to land or nest. We fit pigeon safety nets across balconies, utility areas, duct shafts, AC ledges, sunshades and whole building facades — and we do it without harming the birds.',
        'what_is' => 'A pigeon net is a fine UV-treated nylon mesh stretched across an opening and fixed to the structure all the way round, with no gaps at the corners or around pipes. It is an exclusion, not a deterrent: the birds are not scared away, they are simply unable to get in. That is why it works permanently where other methods fade after a few weeks.',

        'keyword_families' => [
            ['heading' => 'Pigeon nets for balconies', 'text' => 'Mesh across the balcony opening, sealed against the ceiling, walls and parapet so the balcony stays open to light and air but closed to birds.'],
            ['heading' => 'Open area nets', 'text' => 'Open courtyards, terrace openings, sky-lit atriums and the open space between buildings, closed with a flat, tensioned net so birds cannot drop in.'],
            ['heading' => 'Duct area nets', 'text' => 'Duct shafts are where pigeons breed out of sight. Duct area nets close them floor by floor or at the top, with openable sections where plumbers need access.'],
            ['heading' => 'Anti-bird nets for AC ledges & facades', 'text' => 'AC platforms, sunshades, open corridors and elevation gaps — anywhere birds perch — closed with the same mesh for whole apartment blocks.'],
        ],

        'benefits' => [
            ['heading' => 'Stops the mess for good', 'text' => 'No more droppings, feathers or nests to clean every morning.'],
            ['heading' => 'Humane', 'text' => 'The birds are kept out, never trapped or hurt.'],
            ['heading' => 'Healthier home', 'text' => 'Pigeon droppings carry dust and germs — a net keeps them outside.'],
            ['heading' => 'Protects the building', 'text' => 'Acidic droppings stain paint and choke drain outlets.'],
            ['heading' => 'Nearly invisible', 'text' => 'Fine mesh in a neutral colour that hardly shows from the street.'],
            ['heading' => 'Block-wide work', 'text' => 'We net single flats or whole apartment facades and ducts.'],
        ],

        'applications' => [
            'Apartment balconies and utility areas where pigeons land',
            'Open area nets over courtyards, atriums and terrace openings',
            'Duct area nets across the service shafts of apartment blocks',
            'AC outdoor-unit ledges, sunshades and window chajjas',
            'Building facades, open corridors and parking-level openings',
        ],

        'materials' => 'We fit UV-treated nylon pigeon nets with a small mesh size that pigeons cannot push through. The edges are fixed on a stainless steel perimeter wire held by stainless hooks and anchors, and the net is sealed tight to the ceiling, walls, beams and around pipes so no corner is left open. Where a duct or ledge needs maintenance access, we leave an openable section.',
        'specs' => [
            ['label' => 'Mesh', 'value' => 'Nylon, UV-treated'],
            ['label' => 'Mesh size', 'value' => 'Small enough that pigeons cannot push through'],
            ['label' => 'Edge', 'value' => 'Stainless steel perimeter wire'],
            ['label' => 'Fixings', 'value' => 'Stainless hooks and anchors'],
            ['label' => 'Sealing', 'value' => 'Tight to ceiling, walls, beams and pipes'],
            ['label' => 'Access', 'value' => 'Openable section where maintenance is needed'],
        ],

        'why_choose' => 'Most pigeon nets fail at the edges. Pigeons are patient, and a gap at a beam, a pipe or a ceiling corner is all they need to be back within a month. We seal every edge to the structure, work around pipes and AC brackets rather than leaving them as gaps, and look over the whole opening once more before we call it finished.',
        'install_step_text' => 'Nests and droppings are cleared first, the perimeter wire is fixed around the opening, and the mesh is laced on and sealed at every corner, beam and pipe.',

        'comparison' => [
            'title' => 'Pigeon nets vs spikes and gels',
            'rows'  => [
                ['label' => 'How it works', 'a' => 'Physically closes the space', 'b' => 'Makes one spot uncomfortable'],
                ['label' => 'Lasts', 'a' => 'Permanent when sealed', 'b' => 'Birds move a few feet over'],
                ['label' => 'Harm to birds', 'a' => 'None', 'b' => 'Spikes can injure'],
                ['label' => 'Covers', 'a' => 'Whole balconies and ducts', 'b' => 'Ledges only'],
            ],
            'a' => 'Pigeon nets', 'b' => 'Spikes & gels',
        ],

        'faqs' => [
            ['question' => 'Do pigeon nets harm the birds?', 'answer' => 'No. A pigeon net is an exclusion — it stops birds getting in and nothing more. Before we fit it we clear out any nest and make sure no bird is trapped inside.'],
            ['question' => 'Why do pigeons come back after some nets are fitted?', 'answer' => 'Because a corner, beam or pipe was left open. Pigeons find the smallest gap. We seal the net to every edge so there is no way back in.'],
            ['question' => 'Can you net a duct shaft in an apartment block?', 'answer' => 'Yes. Duct area nets are fitted floor by floor or at the top of the shaft, with openable sections where plumbing access is needed. We usually quote these to the association.'],
            ['question' => 'What are open area nets?', 'answer' => 'Open area nets cover large open spaces — courtyards, terrace openings, atriums and the gap between buildings — with a flat, tensioned net so pigeons cannot drop in to roost, while light and rain still pass through.'],
            ['question' => 'Will the pigeon net block light and air?', 'answer' => 'No. The mesh is open and fine, so light and breeze pass through and from a distance it is hard to see.'],
            ['question' => 'What decides the pigeon net cost?', 'answer' => 'The area to be netted and how much sealing work the edges need — a plain balcony is quicker than a duct full of pipes. We measure and quote on the site visit.'],
        ],

        'related' => ['balcony-safety-nets', 'invisible-grills'],
    ],

    'cricket-nets' => [
        'slug'        => 'cricket-nets',
        'nav_label'   => 'Cricket Nets',
        'h1'          => 'Cricket Nets',
        'singular'    => 'cricket net',
        'h1_tag'      => 'Practice nets, box cricket & terrace nets',
        'tagline'     => 'Built to take a full swing',
        'icon'        => 'cricket',
        'og_image'    => '/assets/images/og/og-cricket-nets.jpg',
        'service_type'=> 'Cricket net installation',

        'title_candidates' => [
            'Cricket Nets in Andhra Pradesh – Practice & Box Cricket | Mohika',
            'Cricket Practice Nets in Andhra Pradesh | Mohika',
            'Cricket Nets in Andhra Pradesh | Mohika',
        ],
        'meta_description' => 'Cricket nets installation in Andhra Pradesh — cricket practice nets, box cricket enclosures and terrace nets for homes, schools, academies and turfs.',
        'meta_keywords'    => ['cricket nets', 'cricket practice nets', 'cricket nets in andhra pradesh', 'box cricket nets', 'cricket nets installation', 'terrace cricket nets', 'cricket nets for home', 'sports nets'],

        'card_summary' => 'Practice lanes, box cricket enclosures and terrace nets in heavy knotted HDPE on a pole-and-cable frame, sized to your ground.',
        'card_note'    => 'Heavy knotted HDPE',
        'feats'        => ['Practice lanes & box cricket', 'Terrace & ground level', 'Pole-and-cable framing'],

        'intro' => 'Cricket nets let you practise every day without chasing the ball across the neighbourhood. We install cricket practice nets for homes, apartment terraces, schools and colleges, and full box cricket enclosures for turf owners — from a single lane in a backyard to a floodlit cage around a rooftop turf. Every job starts with the space: how long the run-up is, how high the ball will go, and what is on the other side of the net.',
        'what_is' => 'A cricket net is a heavy knotted HDPE or nylon net hung from a frame of steel poles and tensioned cable. A practice net is a lane — usually closed on three sides and the top — that contains a batter’s shots and a bowler’s deliveries. A box cricket net encloses an entire turf on every side and over the top, so the game can be played in a small space without the ball leaving it.',

        'keyword_families' => [
            ['heading' => 'Cricket practice nets', 'text' => 'Single or multiple lanes for homes, schools and academies, with side and roof nets sized to the pitch length and run-up you have.'],
            ['heading' => 'Box cricket nets', 'text' => 'Full enclosures for turf businesses and apartment play areas — sides and roof netted, poles and cables sized for the span.'],
            ['heading' => 'Terrace cricket nets', 'text' => 'Rooftop nets for apartment terraces and independent houses, fixed so balls stay off the road and off the neighbours’ cars.'],
        ],

        'benefits' => [
            ['heading' => 'Takes hard hitting', 'text' => 'Heavy knotted mesh rated for leather and tennis balls.'],
            ['heading' => 'Sized to your space', 'text' => 'Lane length, height and roof planned around your ground.'],
            ['heading' => 'Safe for neighbours', 'text' => 'Balls stay inside — no broken windows or road hazards.'],
            ['heading' => 'Weather-ready', 'text' => 'UV-treated net and galvanised framing for open-air use.'],
            ['heading' => 'Ground or terrace', 'text' => 'Frames fixed into soil or onto a terrace slab.'],
            ['heading' => 'Practice any time', 'text' => 'Ready for floodlights on box cricket turfs.'],
        ],

        'applications' => [
            'Home and backyard practice lanes',
            'School, college and academy practice nets',
            'Box cricket turf enclosures, including rooftop turfs',
            'Apartment terraces and community play areas',
        ],

        'materials' => 'We use heavy knotted HDPE cricket netting, UV-treated for open-air use, in a mesh size that holds a cricket ball. Nets are hung from galvanised steel poles and tensioned steel cables, with the poles set in concrete footings on the ground or bolted with base plates onto a terrace slab. Lane sizes, net heights and roof netting are planned on the site visit.',
        'specs' => [
            ['label' => 'Net', 'value' => 'Heavy knotted HDPE, UV-treated'],
            ['label' => 'Mesh size', 'value' => 'Holds a cricket ball'],
            ['label' => 'Frame', 'value' => 'Galvanised steel poles'],
            ['label' => 'Support', 'value' => 'Tensioned steel cables'],
            ['label' => 'Footings', 'value' => 'Concrete on ground; base plates on a terrace'],
            ['label' => 'Layout', 'value' => 'Lane size, height and roof planned on site'],
        ],

        'why_choose' => 'A cricket net that sags or tears is worse than none — balls get through, and a falling pole is dangerous. We plan the frame for the span, set footings properly, and tension the cables so the net hangs straight. We also look at what is beyond the net — a road, a window, a parked car — and add roof or extra side netting where it is needed.',
        'install_step_text' => 'Pole positions are marked and footings set, cables are run and tensioned between the poles, and the net is hung, laced and checked for gaps at the base and the roof.',

        'comparison' => [
            'title' => 'Practice nets vs box cricket nets',
            'rows'  => [
                ['label' => 'Used for', 'a' => 'Batting & bowling practice', 'b' => 'Full games on a turf'],
                ['label' => 'Enclosure', 'a' => 'Three sides + roof', 'b' => 'All sides + roof'],
                ['label' => 'Typical buyer', 'a' => 'Homes, schools, academies', 'b' => 'Turf owners, apartments'],
                ['label' => 'Space needed', 'a' => 'One lane length', 'b' => 'Whole turf area'],
            ],
            'a' => 'Practice nets', 'b' => 'Box cricket nets',
        ],

        'faqs' => [
            ['question' => 'What size does a cricket practice net need to be?', 'answer' => 'It depends on the pitch length and run-up you have. A home lane can be shorter than an academy lane; we measure the space and plan the length, width and height around it.'],
            ['question' => 'Can you put cricket nets on an apartment terrace?', 'answer' => 'Yes. Poles are bolted onto the terrace slab with base plates instead of being set in the ground, and roof netting keeps balls from going over the edge.'],
            ['question' => 'Do you build box cricket nets for turfs?', 'answer' => 'Yes — full enclosures with side and roof netting, with poles and cables sized for the span of the turf.'],
            ['question' => 'Will the net take leather-ball cricket?', 'answer' => 'Yes. We use heavy knotted netting for leather-ball practice and can suggest a lighter option if it is only for tennis-ball play.'],
            ['question' => 'How are cricket nets priced?', 'answer' => 'By the net area plus the framing — the number of poles, the cable work and the footings. We plan the layout on the site visit and give a written quote.'],
        ],

        'related' => ['balcony-safety-nets', 'pigeon-nets'],
    ],

    'ceiling-cloth-hangers' => [
        'slug'        => 'ceiling-cloth-hangers',
        'nav_label'   => 'Ceiling Cloth Hangers',
        'h1'          => 'Ceiling Cloth Hangers',
        'singular'    => 'ceiling cloth hanger',
        'h1_tag'      => 'Ceiling & wall mount cloth drying hangers',
        'tagline'     => 'Dry clothes, clear floor',
        'icon'        => 'hanger',
        'og_image'    => '/assets/images/og/og-ceiling-cloth-hangers.jpg',
        'service_type'=> 'Ceiling cloth hanger installation',

        'title_candidates' => [
            'Ceiling Cloth Hangers in Andhra Pradesh – Installation | Mohika',
            'Ceiling Cloth Hangers in Andhra Pradesh | Mohika',
            'Ceiling Cloth Hangers | Mohika',
        ],
        'meta_description' => 'Ceiling cloth hangers and wall mount cloth hangers in Andhra Pradesh — stainless steel cloth drying hangers for balconies and utility areas, installed.',
        'meta_keywords'    => ['ceiling cloth hangers', 'wall mount cloth hangers', 'ceiling cloth hanger installation', 'cloth drying ceiling hangers', 'wall mounted cloth drying hanger', 'cloth drying hanger for balcony', 'pulley cloth hanger', 'ceiling cloth hangers in andhra pradesh'],

        'card_summary' => 'Stainless steel drying rods on a ceiling pulley or a fold-out wall mount — clothes dry up and out of the way, and the floor stays free.',
        'card_note'    => 'Stainless steel rods',
        'feats'        => ['Ceiling & wall mount', 'Stainless steel rods', 'Floor stays clear'],

        'intro' => 'Ceiling cloth hangers turn the unused space under your balcony or utility ceiling into a drying line. The rods come down on a pulley to waist height, you hang the washing, and they go back up out of the way — no stand in the middle of the floor, no wet clothes in the hall. They suit flats with small balconies, homes where the terrace is far away, and the monsoon months when nothing dries outside.',
        'what_is' => 'A ceiling cloth hanger is a set of drying rods, usually six, hung from ceiling brackets on ropes that run through pulleys. Each rod can be lowered and raised on its own, so you can load one while the others stay up drying. Hot air collects near the ceiling, which is why clothes dry faster up there than on a floor stand.',

        'keyword_families' => [
            ['heading' => 'Cloth drying ceiling hangers for balconies', 'text' => 'The usual spot: the balcony or utility ceiling, where clothes get air and light without taking floor space.'],
            ['heading' => 'Pulley cloth hangers', 'text' => 'Each rod has its own rope and pulley, so one can come down to load while the rest stay up.'],
            ['heading' => 'Wall mount cloth hangers', 'text' => 'Where the ceiling is too high, too low or a false ceiling, a wall mount cloth hanger fixes to the wall and its rods fold out to dry and back flat when not in use.'],
            ['heading' => 'Ceiling cloth hanger installation', 'text' => 'Brackets fixed into the slab, rope lengths set to your ceiling height, and the lift checked under load before we leave.'],
        ],

        'benefits' => [
            ['heading' => 'Floor stays clear', 'text' => 'No drying stand blocking the balcony or the hall.'],
            ['heading' => 'Rust-free rods', 'text' => 'Stainless steel rods that will not stain your clothes.'],
            ['heading' => 'Dries faster', 'text' => 'Warm air near the ceiling dries clothes quicker.'],
            ['heading' => 'Lifts one rod at a time', 'text' => 'Load one rod while the others stay up.'],
            ['heading' => 'Monsoon-friendly', 'text' => 'Dry indoors or under the balcony roof when it rains.'],
            ['heading' => 'Fits on the same visit', 'text' => 'Often fitted alongside a balcony net or grill.'],
        ],

        'applications' => [
            'Balcony and utility-area ceilings in apartments',
            'Flats with no terrace access for drying',
            'Indoor drying through the monsoon',
            'Independent houses with a covered sit-out',
            'Wall mount cloth hangers on terrace and balcony walls where the ceiling will not take one',
        ],

        'materials' => 'We fit ceiling cloth hangers with stainless steel rods, usually six to a set, in lengths chosen to fit the ceiling — commonly 4, 5 or 6 feet. Each rod hangs on its own rope through pulleys in the ceiling brackets, the brackets are fixed into the slab with anchor screws, and the rope lock holds each rod at the height you leave it. Wall mount cloth hangers use the same stainless rods on a fold-out bracket fixed into the wall with anchor screws.',
        'specs' => [
            ['label' => 'Rods', 'value' => 'Stainless steel, usually six to a set'],
            ['label' => 'Lengths', 'value' => 'Commonly 4, 5 or 6 feet'],
            ['label' => 'Lift', 'value' => 'Each rod on its own rope and pulley'],
            ['label' => 'Brackets', 'value' => 'Fixed into the slab with anchor screws'],
            ['label' => 'Lock', 'value' => 'Holds each rod at the height you leave it'],
            ['label' => 'Wall mount', 'value' => 'Same stainless rods on a fold-out wall bracket'],
        ],

        'why_choose' => 'A hanger full of wet clothes is heavy, and it hangs over people’s heads. We fix the brackets into the concrete slab — not into false ceilings or plaster — set the rope lengths to your ceiling height, and test the lift with weight on it before we hand it over.',
        'install_step_text' => 'Bracket positions are marked on the slab, brackets are fixed with anchor screws, rods and ropes are fitted, and every rod is raised and lowered under load.',

        'comparison' => [
            'title' => 'Ceiling cloth hangers vs floor drying stands',
            'rows'  => [
                ['label' => 'Floor space', 'a' => 'None used', 'b' => 'Takes the floor'],
                ['label' => 'Drying speed', 'a' => 'Faster near the ceiling', 'b' => 'Slower at floor level'],
                ['label' => 'Rust', 'a' => 'Stainless steel rods', 'b' => 'Often painted steel'],
                ['label' => 'Capacity', 'a' => 'A full wash load', 'b' => 'Limited'],
            ],
            'a' => 'Ceiling hangers', 'b' => 'Floor stands',
        ],

        'faqs' => [
            ['question' => 'How many rods does a ceiling cloth hanger have?', 'answer' => 'Most sets have six rods, which takes a full machine load. We can fit more or fewer depending on the ceiling width.'],
            ['question' => 'Can it be fitted to a false ceiling?', 'answer' => 'Not safely on its own. The brackets must go into the concrete slab above; where there is a false ceiling we fix through to the slab, or fit a wall mount cloth hanger instead.'],
            ['question' => 'Ceiling or wall mount cloth hanger — which do I need?', 'answer' => 'A ceiling cloth hanger suits a balcony or utility area with a reachable concrete ceiling. A wall mount cloth hanger suits high or false ceilings, terraces and narrow balconies: it fixes to the wall and folds flat when not in use. We suggest the right one on the site visit.'],
            ['question' => 'What rod length do I need?', 'answer' => 'It depends on the ceiling. Common lengths are 4, 5 and 6 feet, and we pick what fits on the site visit.'],
            ['question' => 'Can you fit it when you install our balcony net?', 'answer' => 'Yes — it is often done on the same visit, and many families add it once the balcony is netted.'],
            ['question' => 'What decides the ceiling cloth hanger price?', 'answer' => 'The rod length, the number of rods and the fixing conditions. We confirm all three on the visit and quote before fitting.'],
        ],

        'related' => ['balcony-safety-nets', 'invisible-grills'],
    ],
];
