# Deploying mohikaenterprises.in

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

- [ ] `BASE_URL` in `config/site.php` is exactly `https://mohikaenterprises.in`
      (https, no www, no trailing slash).
- [ ] `SITE_ENV` is `'production'`.
- [ ] Create the mailbox **no-reply@mohikaenterprises.in** in the
      hosting panel. The quote form sends from it so SPF aligns, and
      submissions go to mohikainvisiblegrills@gmail.com.
- [ ] SSL installed and **Force HTTPS** on.
- [ ] Upload everything **except** `source-images/`, `source-videos/` and `tools/` (all
      denied by `.htaccess` anyway).
- [ ] `https://mohikaenterprises.in/.git/config` → 403 (after a Git deploy).
- [ ] `https://mohikaenterprises.in/config/business.php` → 403.
- [ ] `http://www.mohikaenterprises.in/` → one 301 to `https://mohikaenterprises.in/`.
- [ ] Send a test enquiry and check that it arrives (look in spam too).
- [ ] Share a page link in WhatsApp and check that the preview card shows the photo.
- [ ] Submit `https://mohikaenterprises.in/sitemap.xml` in Google Search
      Console (property for **mohikaenterprises.in**). The human-readable
      sitemap is `/sitemap.php`, linked from every footer.
- [ ] View source on the live home page: `canonical`, `og:url` and
      `og:image` must all start with `https://mohikaenterprises.in/`.
- [ ] Refresh cached link previews after a domain or image change: paste a
      page URL into the Facebook Sharing Debugger and click **Scrape Again**
      (WhatsApp uses the same cache).
- [ ] Run PageSpeed Insights (mobile) on `/`, one service page and one
      service × city page: LCP under 2.5 s, CLS 0.
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
