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
 * "{h1} in Andhra Pradesh & Telangana"; area pages use "{h1} in {City}".
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
            'Invisible Grills in Andhra Pradesh & Telangana | Mohika',
            'Invisible Grills in AP & Telangana – SS 316 Cable | Mohika',
            'Invisible Grills in AP & Telangana | Mohika',
        ],
        'meta_description' => 'Invisible grills for balconies & windows in Andhra Pradesh & Telangana — SS 316 cable, child-safe spacing, fitted in Hyderabad, Vizag, Vijayawada & more.',
        'meta_keywords'    => ['invisible grills', 'invisible grills in andhra pradesh', 'invisible grill for balcony', 'window invisible grills', 'invisible grill installation', 'invisible grills near me', 'SS 316 invisible grills', 'invisible grill price per sq ft'],

        'card_summary' => 'Thin SS 316 cables tensioned across a balcony or window — safety and added security with a clean, modern look, and the view and breeze kept.',
        'card_note'    => 'SS 316 cable · child-safe gap',
        'feats'        => ['SS 316 marine-grade cable', 'Child-safe 2-inch spacing', 'No welded frame, no rust stains'],

        'intro' => 'Invisible grills are for homes that want safety and security without living behind a cage. Instead of welded bars, the opening is crossed by slim stainless steel cables, each one tensioned between anchors set into the parapet and the slab above. A child cannot squeeze between them, a pet cannot jump through, the tensioned steel adds a layer of security across the opening, and the clean lines give the balcony a modern look that bars never will — while from the sofa you mostly forget they are there. We fit invisible grills on apartment balconies, bedroom and kitchen windows, sit-outs, staircase openings and terrace edges across Andhra Pradesh and Telangana.',
        'what_is' => 'An invisible grill is a set of high-tensile stainless steel cables fixed at a set spacing across an opening and held under tension by anchors in the surrounding concrete. There is no frame across the middle and no pattern of bars, which is why it reads as open space rather than a cage. Its strength comes from the cable grade, the spacing and the tension — not from bulk — so all three are what we measure, specify and check.',

        'keyword_families' => [
            ['heading' => 'Balcony invisible grills', 'text' => 'The most common job: full-width cables from the parapet to the slab, so the balcony stays a balcony — chairs, plants and the evening breeze included — without the drop.'],
            ['heading' => 'Window invisible grills', 'text' => 'For bedroom, kitchen and staircase windows on upper floors. Cables sit inside the frame so the window still opens fully and nothing blocks the light.'],
            ['heading' => 'Invisible grills for child and pet safety', 'text' => 'A gap narrower than a toddler’s head and a cat’s shoulders, under enough tension that it does not spread when pushed or climbed.'],
        ],

        'benefits' => [
            ['heading' => 'Modern look, open view', 'text' => 'Fine cable at even spacing gives a clean, modern facade and nearly disappears from a few feet back — no bars cutting up the sky.'],
            ['heading' => 'Safety and added security', 'text' => 'Spacing narrower than a small child’s head, and tensioned stainless cable that cannot simply be pushed apart — safety for the family and a layer of security for the home.'],
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

        'materials' => 'We fit SS 316 marine-grade stainless steel cable in 2 mm, 2.5 mm and 3 mm thicknesses with a nylon coating, run vertically at a 2-inch spacing — the thickness chosen for the height, the span and the wind on your opening. The cables sit in aluminium tracks fixed top and bottom with stainless anchor bolts into the slab and parapet concrete — never into tiles or plaster — and each run is tensioned individually so the spacing holds across the full width.',
        'specs' => [
            ['label' => 'Cable', 'value' => 'SS 316 marine-grade stainless steel, nylon-coated'],
            ['label' => 'Thickness', 'value' => '2 mm to 3 mm (2, 2.5 or 3 mm)'],
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

        'related' => ['invisible-grills-dealer', 'balcony-safety-nets'],
    ],

    'invisible-grills-dealer' => [
        'slug'        => 'invisible-grills-dealer',
        'kind'        => 'supply',   // a product-supply service: pages show ordering, not installation (templates/service*.php)
        'nav_label'   => 'Invisible Grills Dealer',
        'h1'          => 'Invisible Grills Dealer',
        'singular'    => 'invisible grills dealer',
        'h1_tag'      => 'Invisible grill material supply — wire, tracks & fittings',
        'tagline'     => 'Material for every job, from one roll to a tower',
        'icon'        => 'store',
        'og_image'    => '/assets/images/og/og-invisible-grills-dealer.jpg',
        'service_type'=> 'Invisible grill material supply',

        'title_candidates' => [
            'Invisible Grills Dealer in AP & Telangana – Wire & Tracks | Mohika',
            'Invisible Grills Dealer in Andhra Pradesh & Telangana | Mohika',
            'Invisible Grills Dealer in AP & Telangana | Mohika',
        ],
        'meta_description' => 'Invisible grills dealer & material supplier in AP & Telangana — SS 316 wire in 2, 2.5 & 3 mm, aluminium tracks and fittings for contractors and builders.',
        'meta_keywords'    => ['invisible grills dealer', 'invisible grill dealers near me', 'invisible grill dealers in hyderabad', 'invisible grill material suppliers', 'invisible grill raw material suppliers', 'invisible grill supplier', 'invisible grill wholesale', 'invisible grill wire price', '3mm invisible grill wire', 'invisible grill material price'],

        'card_summary' => 'SS 316 invisible grill wire, aluminium tracks and fittings supplied to contractors, builders and associations — or supplied and installed by our team.',
        'card_note'    => 'Wire, tracks & fittings · bulk supply',
        'feats'        => ['SS 316 wire in 2, 2.5 & 3 mm', 'Tracks, anchors & fittings', 'Supply only or supply & install'],

        'intro' => 'As an invisible grills dealer, Mohika supplies the material behind every job we fit — SS 316 marine-grade wire in 2 mm, 2.5 mm and 3 mm, aluminium tracks, stainless anchors, end fittings and tensioners — to contractors, builders, interior designers and apartment associations across Andhra Pradesh and Telangana. Buy the material and fit it with your own team, or have it supplied and installed by ours; either way you get the same grade we stand behind on our own installations.',
        'what_is' => 'An invisible grills dealer supplies the components an invisible grill is built from: the stainless steel wire itself, the aluminium tracks it runs through at the top and bottom of the opening, the anchors that fix those tracks into concrete, and the end fittings and tensioners that hold each run tight. The quality of a finished grill depends on those parts — the wire grade above all — which is why buying from a dealer who installs the same material matters.',

        'keyword_families' => [
            ['heading' => 'Invisible grill material suppliers', 'text' => 'Everything a job needs from one source: SS 316 wire, aluminium tracks, anchors, crimp sleeves, end caps and tensioners, matched so the parts fit together on site.'],
            ['heading' => 'Invisible grill wire in 2, 2.5 and 3 mm', 'text' => 'Nylon-coated SS 316 marine-grade wire in three thicknesses — 2 mm for most balconies and windows, 2.5 mm and 3 mm for high floors, wide spans and windy sites.'],
            ['heading' => 'Bulk supply for builders and contractors', 'text' => 'Project quantities for apartment blocks, gated communities and contractors, with a written specification and pricing for the whole order.'],
        ],

        'benefits' => [
            ['heading' => 'One grade, every order', 'text' => 'The same SS 316 marine-grade wire we fit on our own jobs — not a cheaper grade for supply-only orders.'],
            ['heading' => 'Three wire thicknesses', 'text' => '2 mm, 2.5 mm and 3 mm, so the wire can be matched to the height, span and wind on each opening.'],
            ['heading' => 'Complete kits', 'text' => 'Wire, tracks, anchors and fittings that are made to work together, so nothing is improvised on site.'],
            ['heading' => 'Supply or supply & install', 'text' => 'Fit it with your own team, or have our installers fit it — useful when your crew is stretched across sites.'],
            ['heading' => 'Project quantities', 'text' => 'From a few flats to a whole tower, priced for the order and specified in writing.'],
            ['heading' => 'Advice from installers', 'text' => 'We fit invisible grills every day, so we can tell you which thickness, spacing and fixing suits the job before you order.'],
        ],

        'applications' => [
            'Contractors and fabricators fitting invisible grills with their own crews',
            'Builders specifying invisible grills across a new apartment project',
            'Interior designers adding invisible grills to a home or villa fit-out',
            'Apartment associations replacing or standardising grills block-wide',
        ],

        'materials' => 'We supply nylon-coated SS 316 marine-grade stainless steel wire in 2 mm, 2.5 mm and 3 mm, in rolls or cut lengths; aluminium tracks for the top and bottom of the opening; stainless anchor bolts for fixing into concrete; and the crimp sleeves, end caps and tensioners that hold each run. Every component is the same as we use on our own installations, and the wire grade and thickness are written on every quotation and invoice.',
        'specs' => [
            ['label' => 'Wire', 'value' => 'SS 316 marine-grade stainless steel, nylon-coated'],
            ['label' => 'Thickness', 'value' => '2 mm, 2.5 mm and 3 mm'],
            ['label' => 'Supplied as', 'value' => 'Rolls or cut lengths, with matching fittings'],
            ['label' => 'Tracks', 'value' => 'Aluminium, for top and bottom fixing'],
            ['label' => 'Fixings', 'value' => 'Stainless anchors, crimps, end caps, tensioners'],
            ['label' => 'Orders', 'value' => 'Supply only, or supply & installation'],
        ],

        'why_choose' => 'Most invisible grill problems start with the material, not the fitting: a wire sold as SS 316 that is really a lower grade, tracks that do not suit the anchors, fittings that slip. We sell only what we install ourselves, write the grade and thickness on every quotation and invoice, and can show samples before you order — so what arrives on site is exactly what was specified.',
        'install_step_text' => 'For supply orders, the material is checked against the specification and packed by opening; for supply and installation, our team fixes the tracks into concrete, threads and tensions each wire and checks the spacing before handover.',

        // Supply pages: how an order works, and why buy the material from us.
        'cta_label'    => 'Get a material quote',
        'cta_title'    => 'Need invisible grill material? Get a written quote',
        'cta_text'     => 'WhatsApp your opening sizes or bill of quantities and tell us the wire thickness you want. We reply with a written quote stating the grade, thickness and fittings.',
        'process_steps' => [
            ['heading' => 'Send your openings', 'text' => 'WhatsApp or call with the opening sizes, a bill of quantities or the drawings — and the wire thickness, if you already know it.'],
            ['heading' => 'Written quote', 'text' => 'You get a quotation listing the wire grade and thickness, the track lengths, anchors and fittings, and the price for the order.'],
            ['heading' => 'Samples & approval', 'text' => 'Ask for samples of the wire and track profile to check, or to show your client or association before you confirm.'],
            ['heading' => 'Packed & ready', 'text' => 'The order is checked against the quote and packed by opening, flat or floor, ready for collection or delivery as agreed.'],
        ],
        'why_points' => [
            ['icon' => 'doc', 'heading' => 'Grade on every invoice', 'text' => 'The wire grade and thickness are written on the quotation and the invoice, so the site team can check what arrives.'],
            ['icon' => 'ruler', 'heading' => '2, 2.5 and 3 mm wire', 'text' => 'Three thicknesses, by the roll or cut to length, so each opening gets the wire its height and span need.'],
            ['icon' => 'anchor', 'heading' => 'Matched fittings', 'text' => 'Tracks, anchors, crimps, end caps and tensioners that are made to work together — nothing improvised on site.'],
            ['icon' => 'users', 'heading' => 'Advice before you buy', 'text' => 'Talk to people who work with this material every day about thickness, spacing and fixing before you order.'],
            ['icon' => 'shield', 'heading' => 'Project quantities', 'text' => 'From one flat to a whole tower, one specification across the order and kept on record for repeat orders.'],
            ['icon' => 'camera', 'heading' => 'Samples on request', 'text' => 'Wire and track samples to compare, or to show your client or association for approval.'],
        ],

        'comparison' => [
            'title' => 'Buying from an installing dealer vs a material-only seller',
            'rows'  => [
                ['label' => 'Wire grade', 'a' => 'SS 316, written on the invoice', 'b' => 'Often unstated'],
                ['label' => 'Thickness choice', 'a' => '2, 2.5 and 3 mm', 'b' => 'Whatever is in stock'],
                ['label' => 'Advice on the job', 'a' => 'From people who fit it daily', 'b' => 'Counter sale only'],
                ['label' => 'Installation', 'a' => 'Available from our team', 'b' => 'Not offered'],
            ],
            'a' => 'Mohika (dealer + installer)', 'b' => 'Material-only seller',
        ],

        'faqs' => [
            ['question' => 'Do you sell invisible grill material without installation?', 'answer' => 'Yes. As invisible grill dealers we supply wire, tracks, anchors and fittings to contractors, builders and designers who fit with their own teams. We can also supply and install if you prefer.'],
            ['question' => 'Which invisible grill wire thickness should I buy?', 'answer' => '2 mm suits most balconies and windows. Choose 2.5 mm or 3 mm for high floors, wide spans and windy, exposed sites. Tell us the openings and we will recommend the thickness for each.'],
            ['question' => 'Is your invisible grill wire really SS 316?', 'answer' => 'Yes — it is the same marine-grade SS 316 wire we fit on our own installations, and the grade and thickness are written on the quotation and invoice.'],
            ['question' => 'Do you supply bulk quantities for apartment projects?', 'answer' => 'Yes. We supply project quantities for builders and associations, with a written specification and pricing for the whole order.'],
            ['question' => 'How is the price of invisible grill material worked out?', 'answer' => 'It depends on the wire thickness and length, the number of track runs and fittings, and the order size. Send us the openings or a bill of quantities and we will give you a written quote.'],
        ],

        'related' => ['invisible-grills', 'balcony-safety-nets'],
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
            'Balcony Safety Nets in Andhra Pradesh & Telangana | Mohika',
            'Balcony Safety Nets in AP & Telangana – Child Safe | Mohika',
            'Balcony Safety Nets in AP & Telangana | Mohika',
        ],
        'meta_description' => 'Balcony safety nets & children safety nets in Andhra Pradesh & Telangana — UV-treated mesh, floor to ceiling, for kids, pets and elders. Free site visit.',
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

        'related' => ['invisible-grills', 'ceiling-cloth-hangers'],
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
            'Cricket Nets in Andhra Pradesh & Telangana | Mohika',
            'Cricket Practice Nets in AP & Telangana | Mohika',
            'Cricket Nets in AP & Telangana | Mohika',
        ],
        'meta_description' => 'Cricket nets in Andhra Pradesh & Telangana — cricket practice nets, box cricket enclosures and terrace nets for homes, schools, academies and turfs.',
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

        'related' => ['balcony-safety-nets', 'invisible-grills'],
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
            'Ceiling Cloth Hangers in Andhra Pradesh & Telangana | Mohika',
            'Ceiling Cloth Hangers in AP & Telangana | Mohika',
            'Ceiling Cloth Hangers | Mohika',
        ],
        'meta_description' => 'Ceiling cloth hangers & wall mount cloth hangers in Andhra Pradesh & Telangana — stainless cloth drying hangers for balconies and utility areas.',
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
