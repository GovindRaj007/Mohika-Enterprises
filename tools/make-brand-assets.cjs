// Dev-only (needs Node + sharp, via NODE_PATH): builds the logo mark sizes
// and the favicon / app icons from source-images/brand/logo-mark.png.
const sharp = require('sharp');
const fs = require('fs');
(async () => {
  const mark = 'C:/mohika-invisible-grills/source-images/brand/logo-mark.png';
  const out = 'C:/mohika-invisible-grills/assets/images/brand/';
  for (const f of fs.readdirSync(out)) fs.unlinkSync(out + f);
  // Logo mark for the site (transparent; it sits on a white tile in CSS).
  for (const s of [40, 80, 120]) {
    await sharp(mark).resize(s, s, { kernel: 'lanczos3' }).webp({ quality: 90, alphaQuality: 100, effort: 6 }).toFile(out + `logo-mark-${s}.webp`);
  }
  // Icons: the mark centred on white with breathing room.
  const onWhite = async (size, pad, radius) => {
    const inner = Math.round(size * (1 - pad * 2));
    const m = await sharp(mark).resize(inner, inner, { kernel: 'lanczos3' }).toBuffer();
    const bg = radius
      ? Buffer.from(`<svg xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size}"><rect width="${size}" height="${size}" rx="${radius}" fill="#ffffff"/></svg>`)
      : { create: { width: size, height: size, channels: 4, background: '#ffffff' } };
    const base = radius ? sharp(bg) : sharp(bg);
    return base.composite([{ input: m, left: Math.round((size - inner) / 2), top: Math.round((size - inner) / 2) }]).png();
  };
  const png = (s) => s.png({ compressionLevel: 9, palette: true, quality: 90, effort: 10 });
  await png(await onWhite(180, 0.1, 0)).toFile(out + 'apple-touch-icon.png');
  await png(await onWhite(192, 0.1, 0)).toFile(out + 'icon-192.png');
  await png(await onWhite(512, 0.1, 0)).toFile(out + 'icon-512.png');
  await png(await onWhite(512, 0.2, 0)).toFile(out + 'icon-maskable-512.png');
  await png(await onWhite(48, 0.06, 10)).toFile(out + 'favicon-48.png');
  const png32 = await (await onWhite(32, 0.04, 7)).toBuffer();
  const h = Buffer.alloc(22);
  h.writeUInt16LE(0, 0); h.writeUInt16LE(1, 2); h.writeUInt16LE(1, 4);
  h.writeUInt8(32, 6); h.writeUInt8(32, 7); h.writeUInt8(0, 8); h.writeUInt8(0, 9);
  h.writeUInt16LE(1, 10); h.writeUInt16LE(32, 12); h.writeUInt32LE(png32.length, 14); h.writeUInt32LE(22, 18);
  fs.writeFileSync('C:/mohika-invisible-grills/favicon.ico', Buffer.concat([h, png32]));
  for (const f of fs.readdirSync(out)) console.log(f, fs.statSync(out + f).size);
})();
