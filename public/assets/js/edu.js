// File: public/assets/js/edu.js
document.addEventListener('DOMContentLoaded', () => {

  /* ========== 1) EDUCATION TIMELINE (tetap seperti semula) ========== */
  (function setupEducation() {
    const section = document.getElementById('education');
    if (!section) return;

    const items = section.querySelectorAll('.edu-item');
    const progress = document.getElementById('eduProgress');

    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('show');
          io.unobserve(e.target);
        }
      });
    }, { rootMargin: '0px 0px -12% 0px', threshold: 0.15 });

    items.forEach((el, i) => {
      el.style.transitionDelay = `${i * 70}ms`;
      io.observe(el);

      const card = el.querySelector('.edu-card');
      if (!card) return;
      card.addEventListener('mousemove', (ev) => {
        const r = card.getBoundingClientRect();
        const nx = ((ev.clientX - r.left) / r.width) * 2 - 1;
        const ny = ((ev.clientY - r.top) / r.height) * 2 - 1;
        card.style.transform =
          `translateY(-2px) scale(1.01) rotateX(${ny * -6}deg) rotateY(${nx * 6}deg)`;
      });
      card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) scale(1)';
      });
    });

    const updateProgress = () => {
      const rect = section.getBoundingClientRect();
      const total = rect.height;
      const view = window.innerHeight;
      const start = Math.max(0, view - rect.top);
      const ratio = Math.min(1, Math.max(0, start / (total + view)));
      if (progress) progress.style.height = `${ratio * 100}%`;
    };
    updateProgress();
    window.addEventListener('scroll', updateProgress, { passive: true });
    window.addEventListener('resize', updateProgress);
  })();

  /* ========== 2) ENGINE PARTIKEL GENERIK ========== */
  function spawnParticles(targetSection, layerEl, opts = {}) {
    if (!targetSection || !layerEl) return;

    layerEl.classList.add('parallax');

    const SYMBOLS = opts.symbols || ['{}', '</>', '[]', '()', '#', '+', '='];
    const COUNT   = opts.count  ?? 28;
    const W = layerEl.clientWidth  || targetSection.clientWidth  || window.innerWidth;
    const H = layerEl.clientHeight || targetSection.clientHeight || window.innerHeight;

    for (let i = 0; i < COUNT; i++) {
      const s = document.createElement('span');
      s.className = 'glyph';
      s.textContent = SYMBOLS[(Math.random() * SYMBOLS.length) | 0];

      const x = Math.random() * (W - 40);
      const y = Math.random() * (H - 40);
      const font  = 10 + Math.random() * 18;  // 10–28px
      const dur   =  9 + Math.random() *  8;  // 9–17s
      const delay = (Math.random() * 6).toFixed(2) + 's';
      const dx = (Math.random() * 120 - 60) + 'px';
      const dy = (Math.random() * 160 - 80) + 'px';
      const o0 = (0.25 + Math.random() * 0.3).toFixed(2);
      const o1 = (0.65 + Math.random() * 0.35).toFixed(2);

      s.style.left = x + 'px';
      s.style.top  = y + 'px';
      s.style.fontSize = font + 'px';
      s.style.setProperty('--dur',   dur   + 's');
      s.style.setProperty('--delay', delay);
      s.style.setProperty('--x0', '0px');
      s.style.setProperty('--y0', '0px');
      s.style.setProperty('--dx', dx);
      s.style.setProperty('--dy', dy);
      s.style.setProperty('--r0', (Math.random()*10 - 5) + 'deg');
      s.style.setProperty('--r1', (Math.random()*18 - 9) + 'deg');
      s.style.setProperty('--o0', o0);
      s.style.setProperty('--o1', o1);

      layerEl.appendChild(s);
    }

    targetSection.addEventListener('mousemove', (e) => {
      const r = targetSection.getBoundingClientRect();
      const nx = ((e.clientX - r.left) / r.width) * 2 - 1;
      const ny = ((e.clientY - r.top) / r.height) * 2 - 1;
      layerEl.style.setProperty('--px', (nx * 8) + 'px');
      layerEl.style.setProperty('--py', (ny * 6) + 'px');
    });
  }

  /* ========== 3) PANGGIL UNTUK EDUCATION & KEAHLIAN ========== */
  spawnParticles(
    document.getElementById('education'),
    document.getElementById('eduFloating'),
    { count: 28 }
  );

  spawnParticles(
    document.getElementById('keahlian'),
    document.getElementById('skillsFloating') || document.querySelector('#keahlian .skills-floating'),
    { count: 24 }
  );
});
