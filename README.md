# Mohika Invisible Grills & Safety Nets — website

A mobile-first lead-generation site for **mohikaenterprises.in**. It
covers invisible grills, balcony safety nets, pigeon nets, cricket nets and
ceiling cloth hangers in Visakhapatnam (Vizag), Rajahmundry, Vijayawada,
Guntur, Kurnool and Tirupati.

Plain **PHP 8 + HTML + CSS + JS**. No framework, no database, no build step
on the server. Deploy by copying files.

## Run it locally

```bash
php -S 127.0.0.1:8010 index.php
# open http://127.0.0.1:8010
```

Quote-form submissions under `php -S` are written to the system temp folder
(`quote-*.txt`) instead of being mailed.

## Where things live

```
index.php              front controller (every page is rendered by PHP)
.htaccess              https + non-www in one hop, internal folders denied, caching
config/                ALL content and business facts
  site.php             BASE_URL, SITE_ENV, GTM id, ads landing map
  business.php         phone, email, address (null until supplied), offer
  services.php         the five services: copy, specs, FAQs, SEO
  locations.php        the six cities: local copy, localities, FAQ
  service-locations/   unique copy per service × city (one file per service)
  pages.php            copy for home, services, areas, about, gallery, blog, contact
  posts.php            blog posts
core/                  router, helpers, images, SEO head, CSRF, icons
data/                  image manifest (generated), photo lists, testimonials ([])
partials/              header, footer, heroes, cards, FAQ, form, schema/
templates/             one per page type, plus sitemap.xml and robots.txt
actions/               quote form handler (POST target)
assets/css             tokens → base → layout → components (+ hero.css on the home page)
assets/js              vendor/ (jQuery 3.7.1, Motion + Lenis bundle), nav.js, site.js, motion.js
assets/fonts           self-hosted Lexend + Source Sans 3 (OFL)
assets/images          photos/ (responsive WebP variants + hero-* slide backgrounds), og/ (1200×630 JPEG), brand/
source-images/         original photos (not served)
tools/                 check-site.php, image + motion build recipes
```

## URLs

| URL | Page |
|---|---|
| `/` | Home |
| `/services.php`, `/service-areas.php`, `/gallery.php`, `/about-us.php`, `/blog.php`, `/contact-us.php` | Static pages |
| `/{service}.php` | 5 service pages |
| `/{service}-in-{city}.html` | 30 service × city pages |
| `/invisible-grills-and-safety-nets-in-{city}.html` | 6 city hubs |
| `/{post}.php` | 4 blog posts |
| `/sitemap.xml`, `/robots.txt` | Generated |

Uppercase letters, trailing slashes, missing extensions and alias spellings
(`vizag`, `rajamahendravaram`, `bezawada`, …) all **301** to the canonical
URL. Unknown URLs return 404.

## Common edits

- **Phone, email, address, hours, price, Google profile:** edit
  `config/business.php`. Anything left `null` renders nothing, and the
  schema follows automatically.
- **Add a city:** add an entry to `config/locations.php`, then a block for it
  in each `config/service-locations/{service}.php`. A service × city page
  exists **only** when its block exists, so an unwritten pair is a 404 rather
  than a thin page. Run the checker afterwards: each new page must be at
  least 40 % unique.
- **Add a service:** add an entry to `config/services.php`, photos to
  `data/service-images.php`, an OG card to `assets/images/og/`, and a file in
  `config/service-locations/`.
- **Add photos:** put originals in `source-images/`, map them in
  `tools/make-image-variants.cjs` (the content map, or the `hero` map for a
  home slide background), and run it with `sharp` installed somewhere:
  `NODE_PATH=/path/to/node_modules node tools/make-image-variants.cjs`.
  It writes the WebP variants and `data/image-manifest.php`.
- **Reviews:** `data/testimonials-sample.php` holds sample reviews for the local
  design preview — loaded only under `php -S`, never under Apache.
- **Add a real review:** add it to `data/testimonials.php`, word for word and
  with the customer's permission. Never write one.

## Checks — run before every deploy

```bash
php -S 127.0.0.1:8010 index.php       # terminal 1
php tools/check-site.php               # terminal 2
```

The checker covers titles, descriptions, H1s, canonicals, OG images,
JSON-LD, the single business entity, images, internal links and orphans,
routing and redirects, the sitemap, image orphans, and the uniqueness of
every service × city page.

## Home hero slideshow

`partials/hero-slider.php` + `assets/css/hero.css` + the hero block in
`assets/js/site.js`. One slide per service, in `config/services.php` order;
each slide reads that service's name, tagline, summary, features and first
three specs, and its background from the `hero` entry in
`data/service-images.php`. Autoplay is 7 s, stops on hover over the controls
or on keyboard focus, has a pause button, and never runs under reduced
motion. Every background slowly pulls back (zoom-out) on its own path
(`kb-a` … `kb-e`). The header is transparent over the hero on every page and
turns solid once the page scrolls.

Full-bleed slides: the copy sits straight on each photo, which stays clearly
visible — the shade is light (a gentle darkening behind the copy column,
soft top and bottom edges) plus a feathered glow directly behind the text
and a soft text shadow. Contrast was **measured from rendered pixels** at the
first and last frame of every slide's zoom-out, against the 80th-percentile
background tone (the photos are covered in fine white cable and mesh
strands, which a bold, shadowed letter crosses without losing legibility):
small text ≥ 4.5 : 1, large text (title, tagline, slide number) ≥ 3 : 1.
If you change a background photo, re-check — a bright sky is what fails.

## Motion

`assets/js/vendor/motion-lenis.min.js` is a prebuilt, committed bundle of
[Motion](https://motion.dev) (`animate` from `motion/mini`, plus `inView`, `scroll`, `stagger`)
and [Lenis](https://lenis.darkroom.engineering). The server never builds
anything. To rebuild it:

```bash
npm i motion@14 lenis@1 esbuild
npx esbuild tools/motion-bundle/entry.js --bundle --minify --format=iife --target=es2019 --legal-comments=none --outfile=assets/js/vendor/motion-lenis.min.js
```

All motion switches off under `prefers-reduced-motion`, and every page works
with JavaScript disabled.

## Videos

Short installation clips (upright phone videos) live in `source-videos/` as
originals and are served from `assets/videos/` as H.264 MP4 — no audio,
fast-start — with a WebP poster frame. The list per service, with captions,
is `data/service-videos.php` (`'home' => true` also puts a clip on the home
page). To add a clip, drop the original in `source-videos/`, then (ffmpeg
installed):

```bash
ffmpeg -i source-videos/NAME.mp4 -an -vf "fps=30,format=yuv420p" -c:v libx264 -preset slow -crf 28 -profile:v high -level 4.0 -movflags +faststart assets/videos/NAME.mp4
ffmpeg -ss 2 -i source-videos/NAME.mp4 -frames:v 1 poster.png   # pick a good second, convert to assets/videos/NAME-poster.webp
```

and add an entry to `data/service-videos.php`. Clips play muted only while
on screen, never by themselves under reduced motion, and load nothing until
first played.
