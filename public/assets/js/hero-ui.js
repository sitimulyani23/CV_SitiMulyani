// File: public/assets/js/hero-ui.js
document.addEventListener('DOMContentLoaded', () => {
  // ------ SELECTORS ------
  const canvas = document.getElementById('particlesCanvas');
  const ctx = canvas ? canvas.getContext('2d') : null;
  const hero = document.getElementById('hero');
  const heroText = document.getElementById('heroText');
  const floatingCard = document.getElementById('floatingCard');
  const roleEl = document.getElementById('roleText');
  const buttons = document.querySelectorAll('.btn-capsule');

  // ------ CURSOR GLOW ------
  const glow = document.createElement('div');
  glow.id = 'cursorGlow';
  document.body.appendChild(glow);

  let w = window.innerWidth, h = window.innerHeight;
  let mouse = { x: w * 0.5, y: h * 0.5 };
  let smooth = { x: mouse.x, y: mouse.y };

  function onResize() {
    w = window.innerWidth; h = window.innerHeight;
    if (canvas && ctx) {
      const dpr = window.devicePixelRatio || 1;
      canvas.width = canvas.clientWidth * dpr;
      canvas.height = canvas.clientHeight * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }
  }
  window.addEventListener('resize', onResize);
  onResize();

  window.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  });

  // ------ PARTICLES 2D (glow pulse) ------
  let particles = [];
  if (canvas && ctx) {
    const COUNT = 90;
    for (let i = 0; i < COUNT; i++) {
      particles.push({
        x: Math.random() * w,
        y: Math.random() * h,
        r: Math.random() * 2 + 0.6,
        vx: (Math.random() - 0.5) * 0.35,
        vy: (Math.random() - 0.5) * 0.35,
        a: Math.random() * 0.5 + 0.2,
        pulse: Math.random() * Math.PI * 2
      });
    }
  }

  // ------ TYPEWRITER pada role ------
  if (roleEl) {
    const text = roleEl.textContent.trim();
    roleEl.textContent = '';
    let i = 0;
    const typer = () => {
      if (i <= text.length) {
        roleEl.textContent = text.slice(0, i);
        i++;
        setTimeout(typer, 38); // kecepatan ketik
      }
    };
    typer();
  }

  // ------ MAGNETIC BUTTONS ------
  buttons.forEach(btn => {
    const rect = () => btn.getBoundingClientRect();
    btn.style.willChange = 'transform';
    btn.addEventListener('mousemove', (e) => {
      const r = rect();
      const nx = ((e.clientX - r.left) / r.width) * 2 - 1;  // -1..1
      const ny = ((e.clientY - r.top) / r.height) * 2 - 1;  // -1..1
      btn.style.transform = `translate3d(${nx * 8}px, ${ny * 6}px, 0)`;
      btn.style.boxShadow = '0 0 26px rgba(0,255,255,.35)';
    });
    btn.addEventListener('mouseleave', () => {
      btn.style.transform = 'translate3d(0,0,0)';
      btn.style.boxShadow = 'none';
    });
  });

  // ------ FLOATING CARD bobbing + swing ------
  let t = 0;
  function animate() {
    requestAnimationFrame(animate);

    // smooth cursor for glow & parallax
    smooth.x += (mouse.x - smooth.x) * 0.12;
    smooth.y += (mouse.y - smooth.y) * 0.12;

    // move glow
    const gx = smooth.x - 110; // center offset (width/2)
    const gy = smooth.y - 110; // center offset (height/2)
    glow.style.transform = `translate3d(${gx}px, ${gy}px, 0)`;

    // particles
    if (ctx) {
      ctx.clearRect(0, 0, canvas.clientWidth, canvas.clientHeight);
      ctx.fillStyle = 'rgba(0,255,255,0.85)';
      particles.forEach(p => {
        p.x += p.vx + (smooth.x / w - 0.5) * 0.12;
        p.y += p.vy + (smooth.y / h - 0.5) * 0.12;
        if (p.x < -10) p.x = w + 10; if (p.x > w + 10) p.x = -10;
        if (p.y < -10) p.y = h + 10; if (p.y > h + 10) p.y = -10;
        p.pulse += 0.04;
        const pr = p.r * (1 + Math.sin(p.pulse) * 0.25);
        ctx.globalAlpha = p.a * (1 + Math.sin(p.pulse) * 0.3);
        ctx.beginPath(); ctx.arc(p.x, p.y, pr, 0, Math.PI * 2); ctx.fill();
      });
      ctx.globalAlpha = 1;
    }

    // parallax teks & bobbing kartu
    if (heroText) {
      const nx = (smooth.x / w) * 2 - 1;
      const ny = (smooth.y / h) * 2 - 1;
      heroText.style.transform = `translate3d(${nx * 10}px, ${ny * 8}px, 0)`;
    }

    if (floatingCard) {
      t += 0.02;
      const nx = (smooth.x / w) * 2 - 1;
      const ny = (smooth.y / h) * 2 - 1;
      const bobY = Math.sin(t) * 6;     // naik-turun
      const swing = Math.sin(t * 0.8) * 4; // goyangan kecil
      floatingCard.style.transform =
        `translate3d(${nx * -14}px, ${ny * -10 + bobY}px, 0) rotate3d(1,1,0, ${nx * 5 + swing}deg)`;
      floatingCard.style.boxShadow =
        `0 28px 60px rgba(0,0,0,.55), 0 0 34px rgba(0,255,255,.25)`;
    }
  }
  animate();
});




// ====== Parallax ringan untuk ABOUT ======
(function(){
  const about = document.getElementById('about');
  const panel = document.getElementById('panel-data-pribadi');
  if (!about) return;

  // parallax pada container about saat mouse bergerak
  about.addEventListener('mousemove', (e) => {
    const r = about.getBoundingClientRect();
    const nx = ((e.clientX - r.left) / r.width) * 2 - 1;
    const ny = ((e.clientY - r.top) / r.height) * 2 - 1;
    const photo = about.querySelector('.about-photo');
    const text = about.querySelector('.about-text');
    if (photo) photo.style.transform = `translate3d(${nx * -8}px, ${ny * -6}px, 0)`;
    if (text)  text.style.transform  = `translate3d(${nx *  6}px, ${ny *  4}px, 0)`;
  });

  // saat panel dibuka, kartu muncul berurutan (fallback jika user scroll langsung)
  const cards = about.querySelectorAll('.info-card');
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if (entry.isIntersecting) {
        cards.forEach((c,i)=> setTimeout(()=> c.classList.add('show'), i*90));
        io.disconnect();
      }
    });
  }, { threshold: .15 });
  if (panel) io.observe(panel);
})();



// ===== ABOUT: Particles + Parallax + Tilt =====
(function(){
  const about = document.getElementById('about');
  const canvas = document.getElementById('aboutParticles');
  if (!about || !canvas) return;

  // ---------- Particles 2D (cepat) ----------
  const ctx = canvas.getContext('2d');
  let w, h, dpr, px = [];
  function size(){
    dpr = window.devicePixelRatio || 1;
    w = canvas.clientWidth; h = canvas.clientHeight;
    canvas.width = w * dpr; canvas.height = h * dpr;
    ctx.setTransform(dpr,0,0,dpr,0,0);
  }
  window.addEventListener('resize', size); size();

  const COUNT = 70;
  px = Array.from({length: COUNT}, () => ({
    x: Math.random()*w, y: Math.random()*h,
    vx: (Math.random()-.5)*0.5, vy:(Math.random()-.5)*0.5,
    r: Math.random()*2+0.6, a: Math.random()*0.4+0.25
  }));

  let mx = 0.5, my = 0.5, smx = mx, smy = my;
  about.addEventListener('mousemove', e=>{
    const r = about.getBoundingClientRect();
    mx = (e.clientX - r.left)/r.width;
    my = (e.clientY - r.top)/r.height;
  });

  function loop(){
    requestAnimationFrame(loop);
    smx += (mx - smx)*0.12; smy += (my - smy)*0.12;

    ctx.clearRect(0,0,w,h);
    ctx.fillStyle = 'rgba(34,211,238,.85)';
    for(const p of px){
      p.x += p.vx + (smx - .5)*0.25;
      p.y += p.vy + (smy - .5)*0.25;
      if (p.x<-10) p.x=w+10; if (p.x>w+10) p.x=-10;
      if (p.y<-10) p.y=h+10; if (p.y>h+10) p.y=-10;
      ctx.globalAlpha = p.a;
      ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, Math.PI*2); ctx.fill();
    }
    ctx.globalAlpha = 1;
  }
  loop();

  // ---------- Parallax konten ----------
  const photo = about.querySelector('.about-photo');
  const text  = about.querySelector('.about-text');
  about.addEventListener('mousemove', e=>{
    const r = about.getBoundingClientRect();
    const nx = ((e.clientX - r.left)/r.width)*2 - 1;
    const ny = ((e.clientY - r.top)/r.height)*2 - 1;
    if (photo) photo.style.transform = `translate3d(${nx*-10}px, ${ny*-8}px, 0)`;
    if (text)  text.style.transform  = `translate3d(${nx*  8}px, ${ny*  6}px, 0)`;
  });

  // ---------- Tilt magnetik kartu ----------
  const grid  = document.getElementById('panel-cards');
  if (grid){
    const maxTilt = 10; // derajat
    grid.addEventListener('mousemove', e=>{
      const t = e.target.closest('.info-card');
      if (!t) return;
      const r = t.getBoundingClientRect();
      const nx = ((e.clientX - r.left)/r.width)*2 - 1;
      const ny = ((e.clientY - r.top)/r.height)*2 - 1;
      t.style.transform = `translateY(0) scale(1.01) rotateX(${ny*-maxTilt}deg) rotateY(${nx*maxTilt}deg)`;
    });
    grid.addEventListener('mouseleave', ()=>{
      grid.querySelectorAll('.info-card').forEach(c=>{
        c.style.transform = 'translateY(0) scale(1) rotateX(0) rotateY(0)';
      });
    });
  }

  // ---------- Stagger saat panel terlihat (fallback) ----------
  const panel = document.getElementById('panel-data-pribadi');
  if (panel){
    const cards = panel.querySelectorAll('.info-card');
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(e=>{
        if (e.isIntersecting){
          cards.forEach((c,i)=> setTimeout(()=> c.classList.add('show'), i*60));
          io.disconnect();
        }
      });
    }, {threshold:.2});
    io.observe(panel);
  }
})();



// ===== Reveal on scroll untuk ABOUT =====
(function(){
  const about = document.getElementById('about');
  if (!about) return;

  // Split paragraf menjadi span per-kata
  function splitWords(el){
    const text = el.textContent.trim().split(/\s+/);
    el.textContent = '';
    text.forEach((word, i) => {
      const span = document.createElement('span');
      span.className = 'w';
      span.textContent = word + (i < text.length - 1 ? ' ' : '');
      el.appendChild(span);
    });
  }

  // siapkan target
  const wordBlocks = about.querySelectorAll('.reveal-words');
  wordBlocks.forEach(splitWords);

  const singles = about.querySelectorAll('.reveal-item, .reveal-photo');

  // Observer untuk elemen biasa
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if (!e.isIntersecting) return;
      e.target.classList.add('show');
      io.unobserve(e.target);
    });
  }, { threshold: .25 });

  singles.forEach(el=> io.observe(el));

  // Observer untuk per-kata (stagger cepat)
  const ioWords = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if (!e.isIntersecting) return;
      const words = e.target.querySelectorAll('.w');
      words.forEach((w,i)=> setTimeout(()=> w.classList.add('s'), i*40)); // 40ms/word
      ioWords.unobserve(e.target);
    });
  }, { threshold: .25 });

  wordBlocks.forEach(el=> ioWords.observe(el));
})();
