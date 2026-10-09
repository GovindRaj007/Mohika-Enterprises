# Deploying mohikainvisiblegrills.in

Shared Apache hosting with PHP 8.0+ (e.g. Hostinger). Deploy by Git or file
upload into `public_html`. The method makes no difference to speed or SEO.

## Before the first deploy — needs the client

- [ ] **Business address**: fill `address`, `geo` and `google_maps_url` in
      `config/business.php`. Until then the schema describes a
      service-area business with no street address.
- [ ] **Material specs**: confirm every line in each service's `materials`
      and `specs` (`config/services.php`) matches what Mohika fits — cable
      grade and thickness, mesh types, rod lengths.
- [ ] **Localities**: confirm the locality lists in `config/locations.php`,
      especially Kurnool and Tirupati.
- [x] **Logo**: shield + M-shaped roofline (two house gables) + grill cables —
      "a home, kept safe" — with the MOHIKA wordmark (`partials/logo.php`,
      icons in `assets/images/brand/`).
- [ ] **Reviews**: the home page shows sample reviews **only on the local dev
      server** (`data/testimonials-sample.php`; never under Apache). Before
      launch, add real Google reviews — word for word, with permission — to
      `data/testimonials.php`; they replace the samples everywhere. Optional:
      delete `data/testimonials-sample.php` from the upload.
- [x] **Photos**: the client's photo set (`source-images/`, converted to WebP
      by `tools/make-image-variants.cjs`). Nice to have: larger originals of
      `cricket-nets-1` (480 px) and `pigeon-nets-2` (371 px) — they are the
      main photos and sharing cards of those services, and any cricket photo
      ≥ 1600 px wide would sharpen the cricket slide in the home hero.
- [ ] Google Business Profile URL + review link → `gbp_url`, `gbp_review_url`.
- [ ] Google Tag Manager container ID → `ANALYTICS_GTM_ID` in `config/site.php`.
- [ ] Starting price per sq ft, if the client wants it shown → `price_from`.
      Titles then gain "From ₹X/sq ft" automatically.

## Launch checklist

- [ ] `BASE_URL` in `config/site.php` is exactly `https://mohikainvisiblegrills.in`
      (https, no www, no trailing slash).
- [ ] `SITE_ENV` is `'production'`.
- [ ] Create the mailbox **no-reply@mohikainvisiblegrills.in** in the
      hosting panel. The quote form sends from it so SPF aligns, and
      submissions go to mohikainvisiblegrills@gmail.com.
- [ ] SSL installed and **Force HTTPS** on.
- [ ] Upload everything **except** `source-images/` and `tools/` (both are
      denied by `.htaccess` anyway).
- [ ] `https://mohikainvisiblegrills.in/.git/config` → 403 (after a Git deploy).
- [ ] `https://mohikainvisiblegrills.in/config/business.php` → 403.
- [ ] `http://www.mohikainvisiblegrills.in/` → one 301 to `https://mohikainvisiblegrills.in/`.
- [ ] Send a test enquiry and check that it arrives (look in spam too).
- [ ] Share a page link in WhatsApp and check that the preview card shows the photo.
- [ ] Submit `https://mohikainvisiblegrills.in/sitemap.xml` in Google Search Console.
- [ ] Footer and contact page NAP (name, address, phone) match the Google
      Business Profile character for character.

## GTM events worth setting up

`site.js` pushes these to `dataLayer`:

- `call_click`, `whatsapp_click`, `cta_click` — each with `cta_position`
- `quote_submitted` — fired on the `?sent=1` thank-you

Mark calls, WhatsApp clicks and quote submissions as conversions.

## Asking for reviews (send after each job)

> Thank you for choosing Mohika! If you're happy with the work, a short
> Google review helps other families find us: {gbp_review_url}
