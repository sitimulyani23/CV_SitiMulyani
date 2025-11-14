// File: public/assets/js/main.js
document.addEventListener("DOMContentLoaded", () => {
  // Smooth scroll untuk SEMUA anchor internal
  const header = document.querySelector("header");
  const offset = () => (header?.offsetHeight || 0) + 8;
  document.querySelectorAll("a[href^='#']").forEach(a => {
    a.addEventListener("click", e => {
      const hash = a.getAttribute("href");
      if (!hash || !hash.startsWith("#")) return;
      const el = document.querySelector(hash);
      if (!el) return;
      e.preventDefault();
      const top = window.scrollY + el.getBoundingClientRect().top - offset();
      window.scrollTo({ top, behavior: "smooth" });
      history.replaceState(null, "", hash);
    });
  });

  // Active nav highlight
  const navLinks = document.querySelectorAll("nav a[href^='#']");
  const sections = document.querySelectorAll("section[id]");
  window.addEventListener("scroll", () => {
    const y = window.pageYOffset + offset() + 4;
    sections.forEach(sec => {
      const top = sec.offsetTop, bottom = top + sec.offsetHeight;
      const id = sec.id;
      if (y >= top && y < bottom) {
        navLinks.forEach(a => a.classList.remove("underline"));
        const active = document.querySelector(`nav a[href='#${id}']`);
        if (active) active.classList.add("underline");
      }
    });
  });

  // Toggle panel Data Pribadi + animasi stagger cepat
  const btn   = document.getElementById('btn-data-pribadi');
  const panel = document.getElementById('panel-data-pribadi');
  const icon  = document.getElementById('icon-chevron');
  const cards = panel ? panel.querySelectorAll('.info-card') : [];
  let open = false;

  function openPanel(){
    if (!panel) return;
    panel.classList.remove('hidden-panel');
    cards.forEach(c => c.classList.remove('show'));
    if (icon) icon.style.transform = 'rotate(180deg)';
    panel.classList.add('panel-open');
    cards.forEach((card, i) => setTimeout(() => card.classList.add('show'), i * 60)); // cepat
    open = true;
  }
  function closePanel(){
    if (!panel) return;
    panel.classList.remove('panel-open');
    cards.forEach(c => c.classList.remove('show'));
    if (icon) icon.style.transform = 'rotate(0deg)';
    setTimeout(() => panel.classList.add('hidden-panel'), 100);
    open = false;
  }
  if (btn && panel) btn.addEventListener('click', () => (open ? closePanel() : openPanel()));
});
