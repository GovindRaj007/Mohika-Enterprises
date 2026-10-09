# Keyword research — Mohika Invisible Grills & Safety Nets

Researched 6 October 2026.

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
account. Paste the phrases from the "Primary" column, set the location to
Andhra Pradesh, and record monthly volumes here. The page targeting below
does not change, because it maps phrases to pages, but the volumes help
decide which pages to promote in Ads.

## What the data says

| Finding | Effect on the site |
|---|---|
| **"vizag"** is suggested for every service; "visakhapatnam" is suggested less often | One page per service for the city, titled "… in Visakhapatnam (Vizag)", with "Vizag" in headings and copy; `…-in-vizag.html` 301s to it |
| "pigeon **safety** nets in {city}" is the dominant pigeon phrasing in Vijayawada, Vizag, Guntur, Tirupati, Kurnool and Rajahmundry; "pigeon nets" also appears | Service named *Pigeon Nets*; H1 tag "Pigeon safety nets & anti-bird nets"; both phrasings used in copy |
| "**safety nets in {city}**" is suggested for every city | City hubs are titled "Invisible Grills & Safety Nets in {City}" |
| "cricket nets in {city}", "**cricket practice nets** in {city}", "indoor cricket nets", "cricket nets setup", "box cricket" | Cricket page covers practice lanes, box cricket and terrace nets; blog post on setup |
| "ceiling cloth hanger(s) {city}", "**cloth drying ceiling hangers** in {city}", "ceiling cloth hanger installation" | Used in titles, H3s and copy on the hanger pages |
| "balcony safety nets in {city} near me", "best balcony safety nets in {city}", "**children safety nets** in vijayawada", "balcony safety nets price" | "Children safety nets" and "pet safety nets" used as headings on the balcony nets page |
| "invisible grill for balcony in {city}", "invisible grill installation in {city}", "invisible grills in {city} price" | Used in headings and FAQs; prices are omitted until the client supplies one |
| "invisible grills near me", "balcony safety nets near me", "pigeon net near me" | `/service-areas.php` targets "near me", and every city page has a "… near me in {City}" H2 |

## Keyword → page map

Each phrase has one primary page, so pages don't compete with each other.

| Primary page | Phrases |
|---|---|
| `/` | invisible grills & safety nets in andhra pradesh · safety nets in andhra pradesh · invisible grills in andhra pradesh |
| `/invisible-grills.php` | invisible grills · invisible grill for balcony · window invisible grills · invisible grill installation · SS 316 invisible grills |
| `/balcony-safety-nets.php` | balcony safety nets · children safety nets · safety nets for balcony · pet safety nets · balcony safety net installation |
| `/pigeon-nets.php` | pigeon nets · pigeon safety nets · pigeon nets for balconies · anti bird nets · duct area safety nets |
| `/cricket-nets.php` | cricket nets · cricket practice nets · box cricket nets · terrace cricket nets · cricket nets installation |
| `/ceiling-cloth-hangers.php` | ceiling cloth hangers · cloth drying ceiling hangers · ceiling cloth hanger installation · pulley cloth hanger |
| `/{service}-in-{city}.html` (30) | {service} in {city} · {service} {city} · {service} near me in {city} · {service} installation in {city} |
| `/invisible-grills-and-safety-nets-in-{city}.html` (6) | invisible grills in {city} · safety nets in {city} · invisible grills & safety nets {city} |
| `/service-areas.php` | invisible grills near me · safety nets near me · balcony safety nets near me |
| blog posts | invisible grills vs safety nets · how to stop pigeons on balcony · cricket nets setup · ceiling cloth hanger guide |

## Where phrases are placed

Following the upgrade skill's blueprint: **title, H1, 2–3 H2s, at least one
H3, the opening paragraph, FAQs, alt text where true, and JSON-LD.** Density
is kept natural, and no page repeats a phrase for its own sake. Short
`meta keywords` (≤ 12 terms) are emitted for Bing and directories; Google
ignores them.
