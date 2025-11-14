document.addEventListener('DOMContentLoaded', () => {
  // ===== Code Rain (pelan) =====
  const cvs = document.getElementById('pfRain');
  if (cvs) {
    const ctx = cvs.getContext('2d');
    let w, h, cols, fontSize = 16, drops = [];
    const CHARS = '01{}[]()</>+-=#*$&@ADEFHKMNPRSTUVXYZ';

    const DPR = Math.min(window.devicePixelRatio || 1, 2);
    function resize(){
      w = cvs.clientWidth; h = cvs.clientHeight;
      cvs.width = Math.floor(w * DPR);
      cvs.height = Math.floor(h * DPR);
      ctx.setTransform(DPR,0,0,DPR,0,0);
      cols = Math.floor(w / fontSize);
      drops = Array(cols).fill(0).map(() => Math.random()*(-h/2));
    }
    resize();
    window.addEventListener('resize', resize);

    function loop(){
      // transparent layer => jejak pelan
      ctx.fillStyle = 'rgba(7, 11, 16, 0.08)';
      ctx.fillRect(0,0,w,h);

      ctx.font = `${fontSize}px ui-monospace, SFMono-Regular, Menlo, Consolas, monospace`;
      for (let i=0; i<cols; i++){
        const txt = CHARS[Math.floor(Math.random()*CHARS.length)];
        const x = i * fontSize;
        const y = drops[i] * fontSize;

        ctx.fillStyle = 'rgba(103, 232, 249, 0.9)'; // cyan
        ctx.shadowColor = 'rgba(34,211,238,.6)';
        ctx.shadowBlur = 8;
        ctx.fillText(txt, x, y);

        // jatuh pelan
        if (y > h + Math.random()*100) drops[i] = Math.random()*(-20);
        else drops[i] += 0.6; // kecepatan
      }
      ctx.shadowBlur = 0;
      requestAnimationFrame(loop);
    }
    requestAnimationFrame(loop);
  }

  // ===== Reveal + Tilt =====
  const cards = document.querySelectorAll('#pfGrid .pf-card');
  const io = new IntersectionObserver((ents) => {
    ents.forEach(e => {
      if (e.isIntersecting){ e.target.classList.add('show'); io.unobserve(e.target); }
    });
  }, { threshold: .12 });
  cards.forEach((c, i) => {
    c.style.transitionDelay = `${i*60}ms`;
    io.observe(c);

    // tilt lembut
    c.addEventListener('mousemove', ev => {
      const r = c.getBoundingClientRect();
      const nx = ((ev.clientX - r.left)/r.width)*2 - 1;
      const ny = ((ev.clientY - r.top)/r.height)*2 - 1;
      c.style.transform = `translateY(-2px) rotateX(${ny*-5}deg) rotateY(${nx*5}deg)`;
    });
    c.addEventListener('mouseleave', () => {
      c.style.transform = '';
    });
  });
});
