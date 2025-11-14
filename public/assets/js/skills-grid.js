// public/assets/js/skills-grid.js
(() => {
  // Reveal on scroll
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in') });
  }, { threshold: 0.15 });
  document.querySelectorAll('#keahlian .reveal').forEach(el => io.observe(el));

  // Tilt + shine
  const cards = document.querySelectorAll('#keahlian .svc-card');
  cards.forEach(card => {
    card.addEventListener('mousemove', (e) => {
      const r = card.getBoundingClientRect();
      const x = e.clientX - r.left, y = e.clientY - r.top;
      const cx = x / r.width - .5, cy = y / r.height - .5;
      card.style.transform = `translateY(-6px) rotateX(${(-cy*4).toFixed(2)}deg) rotateY(${(cx*6).toFixed(2)}deg)`;
      // geser shine
      card.style.setProperty('--mx', `${(cx*12).toFixed(2)}%`);
      card.style.setProperty('--my', `${(cy*12).toFixed(2)}%`);
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = '';
    });
  });
})();
