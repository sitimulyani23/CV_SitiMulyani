// File: public/assets/js/particles.js
document.addEventListener('DOMContentLoaded', () => {
  const SYMBOLS = ['{}', '</>', '[]', '()', '#', '+', '='];

  function spawnGlyphs(layer, opts = {}) {
    const parentSection = layer.closest('section') || document.body;
    layer.classList.add('parallax');

    const W = layer.clientWidth  || parentSection.clientWidth  || window.innerWidth;
    const H = layer.clientHeight || parentSection.clientHeight || window.innerHeight;

    const COUNT = opts.count ?? 26;       // jumlah simbol
    const sizeMin = opts.sizeMin ?? 10;   // px
    const sizeMax = opts.sizeMax ?? 28;   // px
    const durMin  = opts.durMin  ?? 9;    // s
    const durMax  = opts.durMax  ?? 17;   // s
    const dxAmp   = opts.dxAmp   ?? 120;  // px
    const dyAmp   = opts.dyAmp   ?? 160;  // px

    for (let i = 0; i < COUNT; i++) {
      const s = document.createElement('span');
      s.className = 'glyph';
      s.textContent = SYMBOLS[(Math.random() * SYMBOLS.length) | 0];

      const x = Math.random() * (W - 40);
      const y = Math.random() * (H - 40);

      const font = sizeMin + Math.random() * (sizeMax - sizeMin);
      const dur  = durMin + Math.random() * (durMax - durMin);
      const delay = (Math.random() * 6).toFixed(2) + 's';

      const dx = (Math.random() * dxAmp - dxAmp/2) + 'px';
      const dy = (Math.random() * dyAmp - dyAmp/2) + 'px';

      const o0 = (0.25 + Math.random() * 0.3).toFixed(2);
      const o1 = (0.65 + Math.random() * 0.35).toFixed(2);

      Object.assign(s.style, {
        left: x + 'px',
        top:  y + 'px',
        fontSize: font + 'px'
      });
      s.style.setProperty('--dur',  dur + 's');
      s.style.setProperty('--delay', delay);
      s.style.setProperty('--x0', '0px');
      s.style.setProperty('--y0', '0px');
      s.style.setProperty('--dx', dx);
      s.style.setProperty('--dy', dy);
      s.style.setProperty('--r0', (Math.random()*10 - 5) + 'deg');
      s.style.setProperty('--r1', (Math.random()*18 - 9) + 'deg');
      s.style.setProperty('--o0', o0);
      s.style.setProperty('--o1', o1);

      layer.appendChild(s);
    }

    // Parallax mengikuti mouse pada section induk
    parentSection.addEventListener('mousemove', (e) => {
      const r = parentSection.getBoundingClientRect();
      const nx = ((e.clientX - r.left) / r.width) * 2 - 1;
      const ny = ((e.clientY - r.top) / r.height) * 2 - 1;
      layer.style.setProperty('--px', (nx * 8) + 'px');
      layer.style.setProperty('--py', (ny * 6) + 'px');
    });
  }

  // Jalankan untuk semua .skills-floating di halaman
  document.querySelectorAll('.skills-floating').forEach(layer => spawnGlyphs(layer, {
    count: 28
  }));
});
