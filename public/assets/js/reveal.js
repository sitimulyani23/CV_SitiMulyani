// Scroll-reveal generik + stagger
(function () {
  const SELECTOR = '[data-reveal], .reveal-up, .reveal-left, .reveal-right, .reveal-fade';

  // Auto-stagger: setiap container yang punya data-reveal-stagger
  function applyStagger(container) {
    const step = parseInt(container.getAttribute('data-reveal-stagger') || '80', 10);
    const children = container.querySelectorAll(':scope > *');
    children.forEach((el, i) => el.style.setProperty('--rv-delay', `${i * step}ms`));
  }

  // siapkan stagger untuk container pengalaman/portfolio (atau apa pun)
  document.querySelectorAll('[data-reveal-stagger]').forEach(applyStagger);

  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const el = e.target;
        const delay = el.getAttribute('data-reveal-delay') || el.style.getPropertyValue('--rv-delay') || '0ms';
        el.style.transitionDelay = delay;
        el.classList.add('is-in');
        io.unobserve(el);
      }
    });
  }, { rootMargin: '0px 0px -12% 0px', threshold: 0.12 });

  document.querySelectorAll(SELECTOR).forEach(el => io.observe(el));
})();
