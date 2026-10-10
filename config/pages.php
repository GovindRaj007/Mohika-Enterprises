<?php
/**
 * Copy for the static pages — home, services, service areas, about,
 * gallery, blog and contact. Kept here, not in templates, so every business
 * and city name lives in config/ and the templates stay reusable.
 *
 * Keyword targets (Google India autocomplete research, KEYWORDS.md):
 *   home           invisible grills & safety nets in andhra pradesh + every service
 *   services       balcony safety & netting services in andhra pradesh
 *   service-areas  invisible grills / safety nets near me
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [

    'home' => [
        'title'       => 'Invisible Grills & Safety Nets in Andhra Pradesh | Mohika',
        'description' => 'Invisible grills, balcony safety nets, pigeon nets, cricket nets & ceiling cloth hangers in Vizag, Vijayawada, Guntur, Rajahmundry, Kurnool & Tirupati.',
        'keywords'    => ['invisible grills in andhra pradesh', 'safety nets in andhra pradesh', 'balcony safety nets', 'pigeon nets', 'cricket nets', 'ceiling cloth hangers', 'invisible grills near me', 'invisible grills in vizag', 'invisible grills in vijayawada', 'safety nets in guntur', 'pigeon safety nets in tirupati', 'safety nets in kurnool'],
        'eyebrow'     => 'Visakhapatnam · Rajahmundry · Vijayawada · Guntur · Kurnool · Tirupati',
        'h1'          => 'Invisible Grills & Safety Nets in Andhra Pradesh',
        'lead'        => '<strong>Invisible grills and safety nets in Andhra Pradesh</strong>, fitted by local teams in every city we serve: SS 316 invisible grills, balcony safety nets for children and pets, pigeon nets, cricket practice nets and ceiling cloth hangers — measured on site and fixed into concrete.',

        'services_kicker' => 'What we install',
        'services_title'  => 'Balcony safety & netting services in Andhra Pradesh',
        'services_note'   => 'From invisible grills in Andhra Pradesh’s coastal towers to cricket nets on inland terraces — pick what you need protected. Every service is measured, quoted in writing and fitted by our own team — for flats, independent houses, schools and turfs.',

        'stats' => [
            ['value' => 'years', 'label' => 'years of experience'],
            ['value' => 'services', 'label' => 'services we install'],
            ['value' => 'cities', 'label' => 'cities across Andhra Pradesh'],
        ],
        'stats_offer_label' => 'site visit & measurement',

        'video_kicker' => 'See it installed',
        'video_title'  => 'Invisible grills in action',
        'video_note'   => 'Straight from our installations: the cables are tensioned one by one, tested by hand, and the view stays open once the balcony is safe.',

        'compare_kicker' => 'Choosing the right option',
        'compare_title'  => 'Invisible grills or safety nets — which suits your balcony?',
        'compare_note'   => 'All three stop what they are meant to stop. They differ in how much view they keep, what else they keep out and how they are priced.',
        'compare' => [
            'cols' => ['Invisible grills', 'Balcony safety nets', 'Pigeon nets'],
            'rows' => [
                ['label' => 'Best for', 'cells' => ['Keeping the view', 'Kids, pets & elders', 'Birds & droppings']],
                ['label' => 'Material', 'cells' => ['SS 316 steel cable', 'UV-treated HDPE mesh', 'UV-treated nylon mesh']],
                ['label' => 'Covers', 'cells' => ['The opening, rail to slab', 'Full height, floor to ceiling', 'Every gap, edge to edge']],
                ['label' => 'Keeps pigeons out', 'cells' => ['Yes', 'With the right mesh', 'Yes']],
                ['label' => 'Look', 'cells' => ['Barely visible', 'Fine visible mesh', 'Fine visible mesh']],
            ],
            'more' => 'invisible-grills-vs-balcony-safety-nets',
        ],

        'why_kicker' => 'Why Mohika',
        'why_title'  => 'Why families across Andhra Pradesh choose Mohika',
        'why_note'   => 'The parts of this work that matter most — grade, spacing, fixing — are the parts nobody sees. So we write them down.',

        'process_kicker' => 'How it works',
        'process_title'  => 'Invisible grills and safety nets installation, step by step',

        'work_kicker' => 'Recent work',
        'work_title'  => 'Invisible grills, safety nets and nets we have fitted',

        'areas_kicker' => 'Service areas',
        'areas_title'  => 'Invisible grills & safety nets near me — six cities',
        'areas_note'   => 'Mohika has local team members in all six cities, covering the localities around each. Pick yours to see what we fit there and how the local weather changes the job.',

        'blog_kicker' => 'Guides',
        'blog_title'  => 'Balcony safety guides & tips',

        'faq_kicker' => 'Questions',
        'faq_title'  => 'Invisible grills & safety nets in Andhra Pradesh — FAQs',
        'faqs' => [
            ['question' => 'Where can I get invisible grills near me in Andhra Pradesh?', 'answer' => 'We install invisible grills in Andhra Pradesh across Visakhapatnam (Vizag), Rajahmundry, Vijayawada, Guntur, Kurnool and Tirupati, and the localities around each city — along with balcony safety nets, pigeon nets, cricket nets and cloth hangers, with local team members in all six.'],
            ['question' => 'Are invisible grills or safety nets safer for children?', 'answer' => 'Both are safe when fitted properly. Invisible grills use a 2-inch cable spacing that a child cannot pass through; safety nets close the full height of the balcony. Nets are often preferred where there are cats, and both keep pigeons off the balcony.'],
            ['question' => 'Do invisible grills rust near the sea?', 'answer' => 'Not when they are SS 316 marine-grade stainless steel with stainless fittings, which is what we fit — especially in coastal Visakhapatnam.'],
            ['question' => 'Do pigeon nets harm birds?', 'answer' => 'No. A pigeon net only stops birds getting in. We clear nests and check no bird is trapped before sealing the net.'],
            ['question' => 'How long does installation take?', 'answer' => 'A typical apartment balcony is fitted in a single visit once measured. Cricket nets and block-wide netting take longer; we give you the timeline with the quote.'],
            ['question' => 'Will our apartment association allow invisible grills?', 'answer' => 'Most do, because invisible grills do not change how the building looks from outside. If yours needs details first, we can share the material and fixing method in writing.'],
            ['question' => 'How is the price calculated?', 'answer' => 'Grills and nets are priced per square foot of the opening, and the rate depends on the material you choose. Cricket nets add the framing; cloth hangers depend on rod length and count. You get a written quote after the site visit.'],
            ['question' => 'Can you fit several things on one visit?', 'answer' => 'Yes. Many homes have a balcony net, a window grill and a ceiling cloth hanger done together, with one quote for everything.'],
        ],

        'cta_title' => 'Make your balcony safe this week',
        'cta_text'  => 'Call or WhatsApp a photo of the balcony, window or ground. We will visit, measure, show you the material and give you a written quote.',
    ],

    'services' => [
        'title'       => 'Our Services – Invisible Grills, Safety Nets & More | Mohika',
        'description' => 'Invisible grills, balcony safety nets, pigeon nets, cricket nets and ceiling cloth hangers — every service Mohika installs across Andhra Pradesh.',
        'keywords'    => ['invisible grills', 'balcony safety nets', 'pigeon nets', 'cricket nets', 'ceiling cloth hangers', 'safety nets services andhra pradesh'],
        'h1'          => 'Our Services',
        'tag'         => 'Invisible grills, safety nets & more across Andhra Pradesh',
        'lead'        => 'Five services, with local team members in every city we cover. From an invisible grill on a sea-facing balcony to a box cricket enclosure on a rooftop, every job is measured on site, quoted in writing and fitted into concrete.',
        'list_title'  => 'Invisible grills & safety nets installation in Andhra Pradesh',
        'combo_title' => 'Often fitted together',
        'combo_text'  => 'Most homes need more than one thing. A balcony safety net with a ceiling cloth hanger, invisible grills on the windows with pigeon nets on the utility balcony — measured on one visit and quoted together.',
        'faqs' => [
            ['question' => 'Which service do I need for a balcony with small children?', 'answer' => 'Either invisible grills or a balcony safety net. Choose grills to keep the view; choose a net for full-height cover, cats, or if pigeons are also a problem.'],
            ['question' => 'Do you work for apartment associations?', 'answer' => 'Yes — block-wide pigeon and duct netting, terrace nets and play-area cricket nets are often quoted to the association.'],
            ['question' => 'Do you supply only, or supply and install?', 'answer' => 'We supply and install. Fitting is what decides how long a grill or net lasts, so we do not sell materials for others to fit.'],
        ],
    ],

    'service-areas' => [
        'title'       => 'Invisible Grills & Safety Nets Near Me – AP Cities | Mohika',
        'description' => 'Invisible grills and safety nets near you — Visakhapatnam, Rajahmundry, Vijayawada, Guntur, Kurnool & Tirupati. Find your area and book a free site visit.',
        'keywords'    => ['invisible grills near me', 'safety nets near me', 'balcony safety nets near me', 'pigeon nets near me', 'invisible grills andhra pradesh', 'safety nets andhra pradesh'],
        'h1'          => 'Invisible Grills & Safety Nets Near Me',
        'tag'         => 'Local teams in six cities across Andhra Pradesh',
        'lead'        => 'Looking for invisible grills or safety nets near you? Mohika covers Visakhapatnam, Rajahmundry, Vijayawada, Guntur, Kurnool and Tirupati, and the localities around each. Type your area to check.',
        'finder_label'=> 'Find your area',
        'finder_hint' => 'Try a city or locality — e.g. MVP Colony, Benz Circle, Tiruchanur',
        'finder_empty'=> 'No match in our list — but call or WhatsApp us; we may still cover your area.',
        'zones' => [
            'coast'  => ['title' => 'Coastal Andhra', 'text' => 'Salt air and cyclone winds: everything we fit on the coast is stainless steel, and invisible grills are SS 316 marine grade.'],
            'river'  => ['title' => 'Godavari & Krishna cities', 'text' => 'River humidity, heavy monsoons and fierce summers: UV-treated mesh, stainless fixings and anchoring into concrete beams.'],
            'inland' => ['title' => 'Inland & Rayalaseema', 'text' => 'Dry heat, strong sun and dust: UV-treated nets, nylon-coated cable that wipes clean, and terrace work for independent houses.'],
        ],
        'faqs' => [
            ['question' => 'Do you install invisible grills near me?', 'answer' => 'If you are in or around Visakhapatnam, Rajahmundry, Vijayawada, Guntur, Kurnool or Tirupati, yes. Use the finder above or call with your locality.'],
            ['question' => 'Is the site visit free?', 'answer' => 'Yes — we visit, measure and give you a written quote with no obligation.'],
            ['question' => 'Do you have people in my city?', 'answer' => 'Yes. Mohika has local team members in each of the six cities, so the people who measure and fit your job work in your area. Call or WhatsApp the main number and your local team will arrange the visit.'],
        ],
    ],

    'about' => [
        'title'       => 'About Mohika – Invisible Grills & Safety Nets in AP',
        'description' => 'Mohika Invisible Grills & Safety Nets — 7+ years fitting invisible grills, balcony safety nets, pigeon nets and more across six Andhra Pradesh cities.',
        'keywords'    => ['mohika invisible grills', 'mohika safety nets', 'invisible grills andhra pradesh', 'safety nets installers andhra pradesh'],
        'h1'          => 'About Mohika',
        'tag'         => 'Invisible grill & safety net specialists in Andhra Pradesh',
        'lead'        => 'Mohika Invisible Grills & Safety Nets is a team of installers who make balconies, windows, terraces and grounds safe — without boxing anyone in.',
        'story_title' => 'Balcony safety, done the way it should be',
        'story'       => [
            'For more than seven years we have been fitting invisible grills and safety nets for families across Andhra Pradesh. The work has grown from balconies and windows to pigeon netting for whole apartment blocks, cricket practice nets for schools and turfs, and ceiling cloth hangers for homes short on drying space.',
            'What has not changed is how we work. We measure every opening before we quote. We write the material — cable grade, mesh type, fixings — on the quotation. We fix into concrete, not tiles or plaster. And we match the material to the city: marine-grade steel on the Vizag coast, treated mesh for river-damp Rajahmundry, sun-proof materials for the heat of Vijayawada, Guntur, Kurnool and Tirupati.',
        ],
        'values_title' => 'What you can expect from us',
        'cities_title' => 'Every city we serve',
        'faqs' => [
            ['question' => 'Who does the installation?', 'answer' => 'Our own Mohika team measures and fits every job.'],
            ['question' => 'How do I get a quote?', 'answer' => 'Call or WhatsApp us, or use the quote form. We visit, measure and give you a written quote.'],
        ],
    ],

    'gallery' => [
        'title'       => 'Gallery – Invisible Grills, Safety Nets & Nets | Mohika',
        'description' => 'Photos of invisible grills, balcony safety nets, pigeon nets, cricket nets and ceiling cloth hangers — see how each looks on balconies and grounds.',
        'keywords'    => ['invisible grills photos', 'balcony safety nets photos', 'pigeon nets photos', 'cricket nets photos', 'ceiling cloth hangers photos'],
        'h1'          => 'Gallery',
        'tag'         => 'Invisible grills, safety nets, pigeon nets, cricket nets & cloth hangers',
        'lead'        => 'See how each option looks on a real balcony, window or ground before you decide. Filter by service, and tap any photo to see it larger.',
        'filter_all'  => 'All work',
    ],

    'blog' => [
        'title'       => 'Blog – Invisible Grills & Safety Nets Guides | Mohika',
        'description' => 'Guides on invisible grills, balcony safety nets, pigeon nets, cricket practice nets and ceiling cloth hangers — compare options, materials and costs.',
        'keywords'    => ['invisible grills guide', 'safety nets guide', 'pigeon nets guide', 'cricket nets setup', 'ceiling cloth hanger guide'],
        'h1'          => 'Balcony Safety Blog',
        'tag'         => 'Guides on invisible grills, safety nets and more',
        'lead'        => 'Straight answers to the questions families ask us before they choose — what to compare, what to check and what decides the cost.',
    ],

    'contact' => [
        'title'       => 'Contact Us & Free Quote | Mohika Invisible Grills',
        'description' => 'Call 91003 25366 or WhatsApp for invisible grills, safety nets, pigeon nets, cricket nets or cloth hangers anywhere we serve in Andhra Pradesh. Free quote.',
        'keywords'    => ['mohika invisible grills contact', 'invisible grills quote', 'safety nets quote', 'invisible grills near me'],
        'h1'          => 'Contact Us',
        'tag'         => 'Free quote for invisible grills & safety nets in Andhra Pradesh',
        'lead'        => 'Call, WhatsApp or send the form. A photo of the balcony on WhatsApp is the quickest way to get started.',
        'ways_title'  => 'Talk to us',
        'cover_title' => 'We cover all six cities',
    ],
    'sitemap' => [
        'title'       => 'Sitemap – All Pages | Mohika Invisible Grills',
        'description' => 'Every page on the Mohika site: invisible grills, balcony safety nets, pigeon nets, cricket nets and ceiling cloth hangers in each Andhra Pradesh city.',
        'keywords'    => ['mohika invisible grills sitemap', 'invisible grills andhra pradesh', 'safety nets andhra pradesh'],
        'h1'          => 'Sitemap',
        'tag'         => 'Every page on this site, in one place',
        'lead'        => 'All our services, every city we cover and each service-and-city page, plus our guides — one click from here.',
    ],
];
