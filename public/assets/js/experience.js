// Canvas neon waves + titik melayang + tilt kartu
document.addEventListener('DOMContentLoaded', () => {
  const cvs = document.getElementById('expCanvas');
  if (!cvs) return;
  const ctx = cvs.getContext('2d', { alpha: true });

  let w, h, t = 0;
  const DPR = Math.min(window.devicePixelRatio || 1, 2);

  function resize() {
    w = cvs.clientWidth; h = cvs.clientHeight;
    cvs.width = Math.floor(w * DPR);
    cvs.height = Math.floor(h * DPR);
    ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
  }
  resize();
  window.addEventListener('resize', resize);

  // Gelombang neon
  function drawWaves(time) {
    ctx.clearRect(0,0,w,h);

    const waves = [
      { amp: 18, len: 520, speed: 0.0006, y: h*0.25, alpha:.28 },
      { amp: 26, len: 740, speed: 0.00045, y: h*0.55, alpha:.22 },
      { amp: 12, len: 360, speed: 0.0009, y: h*0.78, alpha:.35 }
    ];

    waves.forEach((wv, i) => {
      ctx.beginPath();
      for (let x=0; x<=w; x+=2) {
        const y = wv.y + Math.sin((x + time*wv.speed*2000) / wv.len * Math.PI*2) * wv.amp;
        if (x===0) ctx.moveTo(x,y); else ctx.lineTo(x,y);
      }
      const g = ctx.createLinearGradient(0, 0, w, 0);
      g.addColorStop(0, 'rgba(46,222,255,0)');
      g.addColorStop(.25, 'rgba(46,222,255,'+wv.alpha+')');
      g.addColorStop(.75, 'rgba(0,180,255,'+wv.alpha+')');
      g.addColorStop(1, 'rgba(0,180,255,0)');
      ctx.strokeStyle = g;
      ctx.lineWidth = 2;
      ctx.shadowBlur = 16;
      ctx.shadowColor = 'rgba(34,211,238,.55)';
      ctx.stroke();
      ctx.shadowBlur = 0;
    });
  }

  // Titik melayang
  const dots = Array.from({length: 28}).map(() => ({
    x: Math.random()*w, y: Math.random()*h,
    r: 1 + Math.random()*2,
    vx: (-.3 + Math.random()*.6), vy: (-.3 + Math.random()*.6)
  }));

  function drawDots() {
    ctx.save();
    ctx.fillStyle = '#5ee7ff';
    dots.forEach(d => {
      d.x += d.vx; d.y += d.vy;
      if (d.x < -10) d.x = w+10; if (d.x > w+10) d.x = -10;
      if (d.y < -10) d.y = h+10; if (d.y > h+10) d.y = -10;
      ctx.beginPath();
      ctx.arc(d.x, d.y, d.r, 0, Math.PI*2);
      ctx.globalAlpha = .6;
      ctx.fill();
    });
    ctx.restore();
  }

  // Loop
  function loop(now) {
    t = now;
    drawWaves(t);
    drawDots();
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);

  // Tilt lembut pada cover
  const book = document.getElementById('expBook');
  if (book) {
    book.addEventListener('mousemove', (e) => {
      const r = book.getBoundingClientRect();
      const nx = ((e.clientX - r.left) / r.width) * 2 - 1;
      const ny = ((e.clientY - r.top) / r.height) * 2 - 1;
      book.style.transform =
        `rotateX(${ny * -6}deg) rotateY(${nx * 6}deg) translateZ(0)`;
    });
    book.addEventListener('mouseleave', () => {
      book.style.transform = 'rotateX(0) rotateY(0)';
    });
  }
});
