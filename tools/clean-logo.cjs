// Dev-only (needs Node + sharp, via NODE_PATH): cleans the client logo
// (source-images/brand/logo-original.png) — drops stray specks and faint
// haze, trims and squares it — into source-images/brand/logo-mark.png.
// Remove stray specks from the AI-generated logo: keep only connected
// shapes above a size threshold, then trim to content and square it.
const sharp = require('sharp');
(async () => {
  const src = 'C:/mohika-invisible-grills/source-images/brand/logo-original.png';
  const { data, info } = await sharp(src).ensureAlpha().raw().toBuffer({ resolveWithObject: true });
  const W = info.width, H = info.height, N = W * H;
  const solid = new Uint8Array(N);
  for (let i = 0; i < N; i++) solid[i] = data[i * 4 + 3] > 24 ? 1 : 0;
  const label = new Int32Array(N).fill(-1);
  const sizes = [];
  const stack = new Int32Array(N);
  for (let i = 0; i < N; i++) {
    if (!solid[i] || label[i] !== -1) continue;
    const id = sizes.length; let sp = 0, count = 0;
    stack[sp++] = i; label[i] = id;
    while (sp) {
      const p = stack[--sp]; count++;
      const x = p % W, y = (p / W) | 0;
      for (const [dx, dy] of [[1,0],[-1,0],[0,1],[0,-1],[1,1],[-1,-1],[1,-1],[-1,1]]) {
        const nx = x + dx, ny = y + dy;
        if (nx < 0 || ny < 0 || nx >= W || ny >= H) continue;
        const q = ny * W + nx;
        if (solid[q] && label[q] === -1) { label[q] = id; stack[sp++] = q; }
      }
    }
    sizes.push(count);
  }
  const keepMin = 1500;   // px at 1254×1254 — specks are far smaller
  let removed = 0, kept = 0;
  for (let i = 0; i < N; i++) {
    if (label[i] >= 0 && sizes[label[i]] < keepMin) { data[i * 4 + 3] = 0; removed++; }
  }
  // Also clear faint semi-transparent haze outside the kept shapes.
  for (let i = 0; i < N; i++) if (label[i] === -1 && data[i * 4 + 3] > 0) data[i * 4 + 3] = 0;
  console.log('components', sizes.length, 'kept', sizes.filter(s => s >= keepMin).length, 'speck px removed', removed);
  const clean = await sharp(data, { raw: { width: W, height: H, channels: 4 } }).png().toBuffer();
  const trimmed = await sharp(clean).trim({ threshold: 1 }).toBuffer();
  const tm = await sharp(trimmed).metadata();
  const side = Math.max(tm.width, tm.height);
  await sharp({ create: { width: side, height: side, channels: 4, background: { r: 0, g: 0, b: 0, alpha: 0 } } })
    .composite([{ input: trimmed, left: Math.round((side - tm.width) / 2), top: Math.round((side - tm.height) / 2) }])
    .png().toFile('C:/mohika-invisible-grills/source-images/brand/logo-mark.png');
  console.log('trimmed', tm.width + 'x' + tm.height, '→ square', side);
})();
