/*
 * Generates every served photo from source-images/ and writes
 * data/image-manifest.php. Development-only; needs Node + sharp:
 *
 *   npm i sharp            (anywhere — then point NODE_PATH at it)
 *   NODE_PATH=/path/to/node_modules node tools/make-image-variants.cjs
 *
 * Sources may be PNG, JPEG or WebP; everything served is WebP.
 *
 * Content photos → assets/images/photos/{name}-{480|800|1200}.webp
 *   (no upscaling; portrait photos stop at 800 px; ≤ 80 KB below 1000 px
 *   wide, ≤ 140 KB at 1000+; quality steps down to a floor of 50 — below
 *   that, fine mesh turns to mush, so a few dense photos stay a little over)
 * Hero slide backgrounds → {name}-{640|1024|1440}.webp, same caps.
 * Sharing cards → assets/images/og/og-{service}.jpg, 1200×630 JPEG crops of
 *   each service's main photo ("attention" crop keeps the subject in frame).
 *   JPEG, not WebP: WhatsApp and several scrapers will not show a WebP card.
 */
const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const src = path.join(root, 'source-images');
const out = path.join(root, 'assets/images/photos');
const og = path.join(root, 'assets/images/og');
fs.mkdirSync(out, { recursive: true });
fs.mkdirSync(og, { recursive: true });

// source file → served name (descriptive, lower case — read by image search)
const content = {
  'invisible-grills-1.png': 'invisible-grills-balcony-glass-railing',
  'invisible-grills-2.png': 'invisible-grills-high-rise-balcony',
  'invisible-grills-3.png': 'invisible-grills-apartment-balconies',
  'invisible-grills-4.png': 'invisible-grills-tower-view',
  'window-invisible-grills-1.webp': 'window-invisible-grills-sliding-window',
  'window-invisible-grills-4.webp': 'window-invisible-grills-living-room',

  'balcony-safety-nets-3.png': 'balcony-safety-net-wide-balcony',
  'balcony-safety-nets-1.png': 'balcony-safety-net-high-rise-family',
  'balcony-safety-nets-2.png': 'balcony-safety-net-full-height',
  'balcony-safety-nets-4.png': 'children-safety-net-close-up',
  'children-safety-nets-4.webp': 'children-safety-net-long-balcony',

  'pigeon-nets-2.png': 'pigeon-safety-net-apartment-balcony',
  'pigeon-nets-1.png': 'pigeon-net-tall-balcony',
  'pigeon-nets-4.webp': 'pigeon-safety-net-high-rise',
  'open-area-nets-1.png': 'open-area-net-terrace',
  'open-area-nets-2.png': 'open-area-net-courtyard',
  'duct-area-nets-3.webp': 'duct-area-nets-apartment-shafts',

  'cricket-nets-1.webp': 'cricket-net-ball-stopped',
  'cricket-nets-2.webp': 'cricket-practice-nets-batting',
  'cricket-nets-3.webp': 'cricket-net-knotted-mesh',
  'cricket-nets-4.png': 'cricket-practice-nets-lanes',
  'box-cricket-nets-1.webp': 'box-cricket-net-rooftop-turf',

  'ceiling-cloth-hangers-1.png': 'ceiling-cloth-hanger-utility-ceiling',
  'ceiling-cloth-hangers-2.webp': 'ceiling-cloth-hanger-balcony-ceiling',
  'ceiling-cloth-hangers-3.webp': 'ceiling-cloth-hanger-with-clothes',
  'wall-mount-cloth-hangers-1.png': 'wall-mount-cloth-hanger-terrace',
  'wall-mount-cloth-hangers-2.webp': 'wall-mount-cloth-hanger-balcony',
};

// Home hero slide backgrounds — the sharpest wide photo per service.
const hero = {
  'invisible-grills-4.png': 'hero-invisible-grills',
  'balcony-safety-nets-3.png': 'hero-balcony-safety-nets',
  'open-area-nets-2.png': 'hero-pigeon-nets',
  'cricket-nets-4.png': 'hero-cricket-nets',
  'ceiling-cloth-hangers-1.png': 'hero-ceiling-cloth-hangers',
};

// Sharing cards — each service's main photo, as chosen by the client.
// 'top' (0–1) frames the 1200×630 band vertically where the automatic
// crop would cut a face; without it, sharp's attention crop decides.
const cards = {
  'invisible-grills-1.png': { name: 'og-invisible-grills', top: 0.12 },
  'balcony-safety-nets-3.png': { name: 'og-balcony-safety-nets' },
  'pigeon-nets-2.png': { name: 'og-pigeon-nets', top: 0.62 },
  'cricket-nets-1.webp': { name: 'og-cricket-nets' },
  'ceiling-cloth-hangers-1.png': { name: 'og-ceiling-cloth-hangers' },
};

// isHero: full-bleed backgrounds keep their full source width (up to the
// largest step) and are not held to the portrait cap; content photos stop
// at 800 px when portrait and skip near-original extras above 1000 px.
async function variants(file, name, widths, isHero = false) {
  const meta = await sharp(file).metadata();
  const portrait = !isHero && meta.height > meta.width;
  let list = widths.filter((w) => w <= meta.width && !(portrait && w > 800));
  const top = portrait ? Math.min(800, meta.width) : meta.width;
  if (list.length === 0 || (top > list[list.length - 1] && top - list[list.length - 1] > 150 && top < widths[widths.length - 1] && (isHero || top < 1000))) {
    list.push(top);
  }
  for (const w of list) {
    const dest = path.join(out, `${name}-${w}.webp`);
    const cap = w >= 1000 ? 140000 : 80000;
    let q = 76;
    await sharp(file).resize(w).webp({ quality: q, effort: 6 }).toFile(dest);
    while (fs.statSync(dest).size > cap && q - 6 >= 50) {
      q -= 6;
      await sharp(file).resize(w).webp({ quality: q, effort: 6 }).toFile(dest);
    }
    console.log(`${name}-${w}.webp  ${Math.round(fs.statSync(dest).size / 1024)} KB  q${q}`);
  }
  return { w: meta.width, h: meta.height, widths: list };
}

(async () => {
  for (const f of fs.readdirSync(out)) fs.unlinkSync(path.join(out, f));
  for (const f of fs.readdirSync(og)) fs.unlinkSync(path.join(og, f));

  const manifest = {};
  for (const [from, to] of Object.entries(content)) {
    manifest[to] = await variants(path.join(src, from), to, [480, 800, 1200]);
  }
  for (const [from, to] of Object.entries(hero)) {
    manifest[to] = await variants(path.join(src, from), to, [640, 1024, 1440], true);
  }

  let php = "<?php\n/**\n * Generated by tools/make-image-variants.cjs — do not edit by hand.\n"
    + " * name => intrinsic width/height of the source and the width variants that\n"
    + " * exist on disk as /assets/images/photos/{name}-{width}.webp.\n */\n\n"
    + "if (!defined('ROOT_DIR')) {\n    http_response_code(404);\n    exit;\n}\n\nreturn [\n";
  for (const [k, v] of Object.entries(manifest)) {
    php += `    '${k}' => ['w' => ${v.w}, 'h' => ${v.h}, 'widths' => [${v.widths.join(', ')}]],\n`;
  }
  fs.writeFileSync(path.join(root, 'data/image-manifest.php'), php + '];\n');

  for (const [from, card] of Object.entries(cards)) {
    const dest = path.join(og, card.name + '.jpg');
    let img;
    if (card.top !== undefined) {
      // Scale to 1200 wide, then take the 630-high band at the given offset.
      const buf = await sharp(path.join(src, from)).resize({ width: 1200, kernel: 'lanczos3' }).toBuffer();
      const h = (await sharp(buf).metadata()).height;
      img = sharp(buf).extract({ left: 0, top: Math.round(Math.max(0, h - 630) * card.top), width: 1200, height: Math.min(630, h) });
    } else {
      img = sharp(path.join(src, from)).resize(1200, 630, { fit: 'cover', position: sharp.strategy.attention, kernel: 'lanczos3' });
    }
    await img.sharpen({ sigma: 0.6 }).jpeg({ quality: 82, mozjpeg: true }).toFile(dest);
    console.log(`${card.name}.jpg  ${Math.round(fs.statSync(dest).size / 1024)} KB`);
  }
  console.log('done');
})();
