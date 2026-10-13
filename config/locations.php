<?php
/**
 * Every area Mohika serves, in the order it appears everywhere: the six
 * Andhra Pradesh cities below, then the Telangana areas from
 * config/locations-telangana.php. 'state' groups them (config/business.php
 * → states); 'parent' marks an area of a larger city (Gachibowli → Hyderabad).
 *
 * Mohika has local team members in each of them. 'localities' are areas served, shown as plain
 * text — never links, never pages of their own, never presented as branches.
 *
 * Every text field here is the city's own; none is the same paragraph with a
 * different name. 'nickname' (Vizag) is the spelling most people actually
 * search — Google autocomplete returns "… in vizag" for every service — so it
 * appears in titles and headings beside the official name, and 'alias_slugs'
 * 301 to the canonical page so the two never compete.
 *
 * TODO(client): confirm the locality lists, especially Kurnool and Tirupati,
 * before launch — list only areas the team actually travels to.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [

    'visakhapatnam' => [
        'slug'        => 'visakhapatnam',
        'name'        => 'Visakhapatnam',
        'nickname'    => 'Vizag',
        'state'       => 'andhra-pradesh',
        'parent'      => '',
        'alias_slugs' => ['vizag', 'vishakapatnam', 'visakhapatnam-vizag'],
        'district'    => 'Visakhapatnam district',
        'region'      => 'North coastal Andhra',
        'zone'        => 'coast',
        'kicker'      => 'Bay of Bengal coast',
        'blurb'       => 'Sea-facing towers, salt air and cyclone winds — Vizag balconies need marine-grade steel and anchors that hold.',
        'intro'       => 'Visakhapatnam — Vizag to almost everyone who lives here — is the busiest balcony-safety city we cover. The skyline keeps climbing along Beach Road, in MVP Colony and up the Madhurawada corridor, and most of those new flats come with a wide balcony facing the sea. Families moving in want the view and want the drop made safe, which is exactly the job invisible grills and safety nets do.',
        'homes'       => 'Older G+4 blocks in Dwaraka Nagar, Seethammadhara and Akkayyapalem sit beside 15- to 20-storey towers in Madhurawada, Yendada and PM Palem. Many sea-facing flats have a low parapet topped with glass — beautiful, and the reason so many Vizag families call us.',
        'context'     => 'Salt from the Bay of Bengal travels well inland, and cheap steel cable and mild-steel hooks stain and weaken within a few monsoons here. Cyclone season, which Vizag remembers from Hudhud, puts real wind load on upper-floor openings. That is why everything we fit in Vizag is stainless — SS 316 cable for grills, stainless hooks for every net — and anchored into concrete rather than plaster.',
        'landmarks'   => ['RK Beach and Beach Road', 'Kailasagiri', 'Rushikonda', 'Simhachalam', 'Visakhapatnam Port'],
        'localities'  => ['MVP Colony', 'Madhurawada', 'Seethammadhara', 'Dwaraka Nagar', 'Akkayyapalem', 'Siripuram', 'Lawsons Bay Colony', 'Rushikonda', 'Yendada', 'PM Palem', 'Marripalem', 'Gajuwaka', 'Pendurthi', 'Kommadi'],
        'nearby'      => ['rajahmundry', 'vijayawada'],
        'faq'         => ['question' => 'Will the fittings rust in Vizag’s sea air?', 'answer' => 'Not the ones we use. In Visakhapatnam every cable, hook and anchor we fit is stainless steel, and invisible grills use SS 316 — the marine grade made for salt exposure. Mild-steel fittings are what stain and fail near the coast, so we do not use them.'],
    ],

    'rajahmundry' => [
        'slug'        => 'rajahmundry',
        'name'        => 'Rajahmundry',
        'nickname'    => '',
        'state'       => 'andhra-pradesh',
        'parent'      => '',
        'alias_slugs' => ['rajamahendravaram', 'rajamundry', 'rajahmahendravaram'],
        'district'    => 'East Godavari district',
        'region'      => 'Godavari delta',
        'zone'        => 'river',
        'kicker'      => 'On the banks of the Godavari',
        'blurb'       => 'River humidity most of the year and heavy monsoons — Rajahmundry needs treated nets and stainless hardware.',
        'intro'       => 'Rajahmundry — officially Rajamahendravaram — spreads along the east bank of the Godavari, and the river shapes how homes here live. Flats near the ghats and along the river roads are built to catch the breeze off the water, families keep their balconies open from morning to night, and pigeons love the ledges just as much. Most of our Rajahmundry calls are for balcony safety nets and invisible grills for river-facing flats — nets that keep the pigeons out as well as the children in.',
        'homes'       => 'The old town around Innespeta, Danavaipeta and Prakash Nagar is mostly G+2 to G+4 buildings with narrow balconies and downstand beams plastered over. Newer gated communities in Morampudi, Lalacheruvu, Diwan Cheruvu and Bommuru have wider balconies and higher floors.',
        'context'     => 'The Godavari keeps the air damp for most of the year and the monsoon here is heavy. Untreated nets go brittle and rot, and plated hooks rust at the anchor first. We use UV-treated mesh, stainless fixings and, on older buildings, anchor into the beam behind the plaster rather than the plaster itself.',
        'landmarks'   => ['Pushkar Ghat', 'Kotilingala Ghat', 'Godavari Arch Bridge', 'Dowleswaram Barrage'],
        'localities'  => ['Danavaipeta', 'Innespeta', 'Prakash Nagar', 'T Nagar', 'Aryapuram', 'Kotagummam', 'Morampudi', 'Lalacheruvu', 'Diwan Cheruvu', 'Bommuru', 'Dowleswaram', 'Rajanagaram'],
        'nearby'      => ['visakhapatnam', 'vijayawada'],
        'faq'         => ['question' => 'Our flat overlooks the Godavari — will we still see the river?', 'answer' => 'Yes. Invisible grills are thin SS 316 cables, so the river stays in view from inside the room. If you choose a safety net instead, it is a fine see-through mesh, and we will show you both on the site visit.'],
    ],

    'vijayawada' => [
        'slug'        => 'vijayawada',
        'name'        => 'Vijayawada',
        'nickname'    => '',
        'state'       => 'andhra-pradesh',
        'parent'      => '',
        'alias_slugs' => ['bezawada', 'vijaywada'],
        'district'    => 'NTR district',
        'region'      => 'Krishna river',
        'zone'        => 'river',
        'kicker'      => 'On the Krishna riverfront',
        'blurb'       => 'Fierce summer heat and dense apartment blocks — Vijayawada needs materials that do not go brittle in the sun.',
        'intro'       => 'Vijayawada is one of the hottest cities in Andhra Pradesh and one of the most crowded with apartments, and both facts show up in the work we do here. Dense G+5 blocks put balconies a few feet from the neighbours’, new towers keep rising along the Eluru and Bandar roads, and with the capital region next door, families keep moving in. Safety nets, invisible grills and material supply for local contractors are our everyday jobs in the city.',
        'homes'       => 'Governorpet, Suryaraopet and Labbipet are packed with older G+4 and G+5 blocks; Benz Circle, Patamata, Gunadala, Kanuru and Poranki are where the newer high-rises are. Many flats share duct shafts and ledges that pigeons take over quickly.',
        'context'     => 'Summer afternoons regularly pass 45 °C here, and that sun destroys untreated nets and cheap plastic-coated wire within a couple of seasons. Canal and river humidity then arrives with the monsoon. We fit UV-treated mesh and nylon-coated SS 316 cable, which hold up to the heat and the damp alike.',
        'landmarks'   => ['Prakasam Barrage', 'Kanaka Durga Temple on Indrakeeladri', 'Benz Circle', 'Bhavani Island'],
        'localities'  => ['Benz Circle', 'Labbipet', 'Moghalrajpuram', 'Governorpet', 'Suryaraopet', 'Patamata', 'Gunadala', 'Kanuru', 'Poranki', 'Bhavanipuram', 'Gollapudi', 'Ramavarappadu', 'Ajit Singh Nagar'],
        'nearby'      => ['guntur', 'rajahmundry'],
        'faq'         => ['question' => 'Do the nets and grills survive a Vijayawada summer?', 'answer' => 'Yes, if the material is right. We fit UV-treated mesh and nylon-coated SS 316 cable in Vijayawada because untreated nets and cheap coated wire go brittle in 45 °C sun. The right material keeps its strength for years.'],
    ],

    'guntur' => [
        'slug'        => 'guntur',
        'name'        => 'Guntur',
        'nickname'    => '',
        'state'       => 'andhra-pradesh',
        'parent'      => '',
        'alias_slugs' => [],
        'district'    => 'Guntur district',
        'region'      => 'Krishna delta, inland',
        'zone'        => 'inland',
        'kicker'      => 'Capital region, inland Andhra',
        'blurb'       => 'Dry heat, fine dust and many independent houses — Guntur jobs often mean terraces and old MS grills too.',
        'intro'       => 'Guntur mixes busy old neighbourhoods with fast-growing apartment roads toward the capital region, and our work here follows that mix. Alongside apartment balconies, we fit a lot of jobs on independent houses — terrace edges, staircase landings and first-floor sit-outs — and replace plenty of old, rusting MS grills with invisible grills.',
        'homes'       => 'Arundelpet, Brodipet and Lakshmipuram are dense with G+3 to G+5 blocks and independent houses; newer apartments line Amaravathi Road, Pattabhipuram, Gorantla and Koritepadu. Independent houses often need terrace parapets and staircase openings covered as well as balconies.',
        'context'     => 'Guntur is inland, hot and dry for most of the year, and fine dust blows in from the farmland around the city. Nylon-coated cable sheds that dust with a wipe, and UV-treated mesh does not crack in the dry heat. When an old MS grill comes out, we fix the new tracks into sound concrete rather than the damaged patch it leaves behind.',
        'landmarks'   => ['Guntur Mirchi Yard', 'Brodipet main road', 'Amaravathi Road', 'Kondaveedu Fort nearby'],
        'localities'  => ['Arundelpet', 'Brodipet', 'Lakshmipuram', 'Kothapet', 'Pattabhipuram', 'Brindavan Gardens', 'Vidya Nagar', 'Chandramouli Nagar', 'Nallapadu', 'Gorantla', 'Koritepadu', 'Amaravathi Road'],
        'nearby'      => ['vijayawada', 'kurnool'],
        'faq'         => ['question' => 'Can you replace our old MS grill with an invisible grill?', 'answer' => 'Yes, it is one of our most common Guntur jobs. We remove the old grill, check the concrete where it was fixed, and anchor the new tracks into sound concrete. The view opens up and the rust stains stop.'],
    ],

    'kurnool' => [
        'slug'        => 'kurnool',
        'name'        => 'Kurnool',
        'nickname'    => '',
        'state'       => 'andhra-pradesh',
        'parent'      => '',
        'alias_slugs' => ['karnool'],
        'district'    => 'Kurnool district',
        'region'      => 'Rayalaseema',
        'zone'        => 'inland',
        'kicker'      => 'Gateway of Rayalaseema, on the Tungabhadra',
        'blurb'       => 'Some of the state’s hottest summers — Kurnool needs UV-treated nets and steel that shrugs off 45 °C sun.',
        'intro'       => 'Kurnool sits on the Tungabhadra at the gateway to Rayalaseema, and its homes are built for long, very hot summers. Families here spend evenings on terraces and balconies once the heat breaks, and the city’s mix of independent houses and newer apartment blocks gives us a wide range of jobs — from terrace safety for houses to balcony nets and invisible grills for flats.',
        'homes'       => 'Independent houses with open terraces are common across Kurnool, alongside newer apartment buildings in the camps and along the main roads. Houses often need terrace edges, staircase openings and first-floor balconies made safe together.',
        'context'     => 'Kurnool’s summer regularly reaches the mid-40s °C under a strong, dry sun, which is hard on any net or coating left outdoors. We use UV-treated HDPE and nylon mesh and SS 316 cable here so nothing goes brittle or fades. The dust that comes with the dry months wipes off nylon-coated cable easily.',
        'landmarks'   => ['Konda Reddy Fort', 'Tungabhadra riverfront', 'Kurnool Collectorate', 'Kurnool–Bellary Road'],
        'localities'  => ['A Camp', 'B Camp', 'C Camp', 'Budhawarpet', 'Venkataramana Colony', 'Krishna Nagar', 'Gandhi Nagar', 'Prakash Nagar', 'Bhagya Nagar', 'NR Peta', 'Kallur'],
        'nearby'      => ['guntur', 'tirupati'],
        'faq'         => ['question' => 'Do you install terrace safety for independent houses in Kurnool?', 'answer' => 'Yes. Many Kurnool homes are independent houses, and we often net or grill the terrace edge, the staircase opening and the first-floor balcony on one visit, with one quote for the lot.'],
    ],

    'tirupati' => [
        'slug'        => 'tirupati',
        'name'        => 'Tirupati',
        'nickname'    => '',
        'state'       => 'andhra-pradesh',
        'parent'      => '',
        'alias_slugs' => ['tirupathi'],
        'district'    => 'Tirupati district',
        'region'      => 'Rayalaseema, below the Seshachalam hills',
        'zone'        => 'inland',
        'kicker'      => 'At the foot of the Tirumala hills',
        'blurb'       => 'Hill views, fast-growing gated communities and a late monsoon — Tirupati balconies are worth keeping open.',
        'intro'       => 'Tirupati is growing quickly beyond the temple town — new apartments and gated communities along Air Bypass Road, Tiruchanur and Renigunta Road, many of them with balconies facing the Tirumala hills. Families here often host elders and visiting relatives for long stretches, so safe balconies and windows matter, and that hill view is the best reason we know for an invisible grill over a barred one.',
        'homes'       => 'New G+5 to G+10 apartment blocks along Air Bypass Road, Tiruchanur and Renigunta Road; independent houses and older buildings around Korlagunta, Balaji Colony and MR Palli. Many new flats have wide balconies with a clear view of the hills.',
        'context'     => 'Summers in Tirupati are hot and dry, and most of the year’s rain comes late, with the north-east monsoon from October to December. That means long months of sun on the mesh and then a short, heavy wet season — so we fit UV-treated nets and stainless fixings that handle both.',
        'landmarks'   => ['Alipiri', 'Sri Padmavathi Ammavari Temple, Tiruchanur', 'Sri Venkateswara University', 'Renigunta'],
        'localities'  => ['Tiruchanur', 'Air Bypass Road', 'Korlagunta', 'Balaji Colony', 'MR Palli', 'Padmavathi Nagar', 'KT Road', 'Mangalam', 'Tilak Road', 'Settipalli', 'Renigunta Road'],
        'nearby'      => ['kurnool', 'guntur'],
        'faq'         => ['question' => 'Do you cover apartments along Air Bypass Road and Tiruchanur?', 'answer' => 'Yes. Air Bypass Road, Tiruchanur, Renigunta Road and the localities around them are all part of our Tirupati coverage. Call or WhatsApp with your apartment name and we will fix a visit.'],
    ],
] + require __DIR__ . '/locations-telangana.php';
