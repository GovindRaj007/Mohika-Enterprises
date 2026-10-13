# Keyword research — Mohika Invisible Grills & Safety Nets

Researched 6 October 2026 (Andhra Pradesh); Telangana added 11 October 2026 —
see "Telangana" below.

## Source and method

Google Keyword Planner needs a signed-in Google Ads account and was not
available for this build, so search-volume figures are **not** included.
Instead, every phrase below comes from **Google's own autocomplete service**
queried for India (`suggestqueries.google.com`, `hl=en`, `gl=in`). Autocomplete
only suggests phrases that real users in the region search for, so it is a
reliable source for *which wording people use*. It does not give volumes.

Each service was queried in both forms, `"{service} {city}"` and
`"{service} in {city}"`, for every city served, plus the bare service names.

**To do before launch:** open Keyword Planner in the client's Google Ads
account. Paste the phrases from the "Primary" column, set the locations to
Andhra Pradesh and Telangana, and record monthly volumes here. The page targeting below
does not change, because it maps phrases to pages, but the volumes help
decide which pages to promote in Ads.

## What the data says

| Finding | Effect on the site |
|---|---|
| **"vizag"** is suggested for every service; "visakhapatnam" is suggested less often | One page per service for the city, titled "… in Visakhapatnam (Vizag)", with "Vizag" in headings and copy; `…-in-vizag.html` 301s to it |
| "**safety nets in {city}**" is suggested for every city | City hubs are titled "Invisible Grills & Safety Nets in {City}" |
| "cricket nets in {city}", "**cricket practice nets** in {city}", "indoor cricket nets", "cricket nets setup", "box cricket" | Cricket page covers practice lanes, box cricket and terrace nets; blog post on setup |
| "ceiling cloth hanger(s) {city}", "**cloth drying ceiling hangers** in {city}", "ceiling cloth hanger installation" | Used in titles, H3s and copy on the hanger pages |
| "balcony safety nets in {city} near me", "best balcony safety nets in {city}", "**children safety nets** in vijayawada", "balcony safety nets price" | "Children safety nets" and "pet safety nets" used as headings on the balcony nets page |
| "invisible grill for balcony in {city}", "invisible grill installation in {city}", "invisible grills in {city} price" | Used in headings and FAQs; prices are omitted until the client supplies one |
| "invisible grills near me", "balcony safety nets near me", "invisible grill dealers near me" | `/service-areas.php` targets "near me", and every city page has a "… near me in {City}" H2 |

## Keyword → page map

Each phrase has one primary page, so pages don't compete with each other.

| Primary page | Phrases |
|---|---|
| `/` | invisible grills & safety nets in andhra pradesh & telangana · safety nets in andhra pradesh · invisible grills in andhra pradesh |
| `/invisible-grills.php` | invisible grills · invisible grill for balcony · window invisible grills · invisible grill installation · SS 316 invisible grills |
| `/balcony-safety-nets.php` | balcony safety nets · children safety nets · safety nets for balcony · pet safety nets · balcony safety net installation |
| `/invisible-grills-dealer.php` | invisible grills dealer · invisible grill dealers near me · invisible grill material suppliers · invisible grill raw material suppliers · invisible grill wholesale · invisible grill wire price · 3mm invisible grill wire |
| `/cricket-nets.php` | cricket nets · cricket practice nets · box cricket nets · terrace cricket nets · cricket nets installation |
| `/ceiling-cloth-hangers.php` | ceiling cloth hangers · cloth drying ceiling hangers · ceiling cloth hanger installation · pulley cloth hanger |
| `/{service}-in-{city}.html` (100: 30 AP + 70 Telangana) | {service} in {city} · {service} {city} · {service} near me in {city} · {service} installation in {city} |
| `/invisible-grills-and-safety-nets-in-{city}.html` (20) | invisible grills in {city} · safety nets in {city} · invisible grills & safety nets {city} |
| `/service-areas.php` | invisible grills near me · safety nets near me · balcony safety nets near me |
| blog posts | invisible grills vs safety nets · cricket nets setup · ceiling cloth hanger guide |

## Where phrases are placed

Following the upgrade skill's blueprint: **title, H1, 2–3 H2s, at least one
H3, the opening paragraph, FAQs, alt text where true, and JSON-LD.** Density
is kept natural, and no page repeats a phrase for its own sake. Short
`meta keywords` (≤ 12 terms) are emitted for Bing and directories; Google
ignores them.

## Telangana (researched 11 October 2026)

Same method — Google autocomplete for India — queried for Hyderabad and for
each Telangana area served: `"{service} hyderabad"`, `"{service} {area}"` and
`"{service} in {area}"`.

| Finding | Effect on the site |
|---|---|
| "invisible grills in hyderabad", "**balcony invisible grills** in hyderabad", "invisible grill installation in hyderabad", "invisible grills for windows hyderabad", "invisible grill cost hyderabad (per square foot)" | `/invisible-grills-in-hyderabad.html` uses balcony and window phrasing; its FAQ answers the cost question without inventing a price |
| "balcony safety nets hyderabad", "**children safety nets** hyderabad", "balcony safety nets kukatpally / kondapur", "balcony safety nets in kompally / warangal" | Balcony-net pages lead with children and pet safety; area pages for every phrase found |
| "cricket nets hyderabad", "**cricket practice nets** hyderabad", "**indoor cricket nets** hyderabad", "box cricket price in hyderabad", "cricket nets in warangal" | Cricket pages cover practice lanes, box cricket and indoor nets; Hyderabad FAQ covers indoor nets and box cricket cost |
| "ceiling cloth hanger hyderabad", "**cloth drying hangers** hyderabad", "balcony cloth hanger hyderabad", "**pulley cloth hanger** hyderabad", "wall mounted cloth hanger hyderabad" | Hanger pages use "pulley drying hanger" and "wall mount" wording; Madhapur page leads with wall mount options |
| "safety nets in kukatpally", "safety nets in warangal", "invisible grills gachibowli / kukatpally / kokapet / madhapur / miyapur / tellapur / manikonda" | Each area has a city hub ("Invisible Grills & Safety Nets in {area}") plus five service pages |
| Both "**mahbubnagar**" and "mahabubnagar" are searched (station and town signs use the first; the district the second) | Page uses "Mahbubnagar" with "(Mahabubnagar)" in meta descriptions; `…-mahabubnagar.html` and `…-palamuru.html` 301 to it |
| "KPHB" is used for Kukatpally | KPHB appears in Kukatpally copy, and `…-kphb.html` 301s to the Kukatpally page |

### Telangana keyword → page map

| Primary page | Phrases |
|---|---|
| `/{service}-in-hyderabad.html` (5) | {service} in hyderabad · {service} hyderabad · best {service} in hyderabad · {service} installation hyderabad |
| `/{service}-in-{area}.html` (65) | {service} in {area} · {service} {area} · {service} near me in {area} — for Secunderabad, Gachibowli, Kukatpally, Madhapur, Shamshabad, Kompally, Miyapur, Medchal, Kondapur, Kokapet, Tellapur, Mahbubnagar, Warangal |
| `/invisible-grills-and-safety-nets-in-{area}.html` (14) | invisible grills in {area} · safety nets in {area} |
| `/` and the five service pages | {service} in andhra pradesh & telangana · invisible grills & safety nets in AP & Telangana |

Areas of Hyderabad are titled "{Service} in {Area}, Hyderabad" so they rank
for the area and the city together without competing with the Hyderabad page.

## Invisible grills dealer (researched 12 October 2026)

Pigeon nets was retired as a service and replaced by **Invisible Grills
Dealer** (`/invisible-grills-dealer.php` plus one page per area). Same
method — Google autocomplete for India.

| Finding | Effect on the site |
|---|---|
| "invisible grill dealers", "invisible grill dealers **near me**", "invisible grill dealers **in hyderabad**" (singular "grill" is the common form) | Service H1 "Invisible Grills Dealer"; meta descriptions use "invisible grill dealers"; every area has a dealer page |
| "invisible grill **material suppliers** in hyderabad", "invisible grill **raw material** suppliers in hyderabad", "invisible grill material suppliers near me" | Dealer copy names the materials supplied — SS 316 wire, aluminium tracks, anchors, crimps, end caps, tensioners |
| "invisible grill **wholesale**", "invisible grill supplier", "invisible grill manufacturers in hyderabad" | Bulk / project supply for builders and contractors; no manufacturing claim is made |
| "invisible grill **wire price**", "**3mm** invisible grill wire price", "invisible grill wire roll price" | Wire offered in 2, 2.5 and 3 mm, by the roll or cut to length; price FAQ explains what decides it without inventing a rate |
| No autocomplete for "invisible grill dealers in vizag / vijayawada / guntur / warangal" yet | Pages exist for those areas anyway, targeting the same phrasing as Hyderabad, so they are ready as demand grows |
