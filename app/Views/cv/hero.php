<?php
// app/Views/cv/sections/hero.php

// ===== Role (tetap dari keahlian) =====
$role = $keahlian[0]['nama_keahlian'] ?? 'Mobile Developer';

// ===== Deskripsi HERO: TIDAK dari biodata, hardcoded di sini =====
$heroText = "Selamat datang di CV saya. Di sini Anda bisa melihat profil singkat, keahlian inti, serta proyek yang pernah saya kerjakan.";

// ===== Normalisasi foto untuk ID card (boleh URL penuh / uploads / nama file) =====
$rawFoto = $biodata['foto'] ?? '';
if ($rawFoto) {
  if (filter_var($rawFoto, FILTER_VALIDATE_URL)) {
    $fotoSrc = $rawFoto;
  } else {
    $rawFoto = ltrim($rawFoto, '/');
    if (strpos($rawFoto, 'uploads/') !== 0) $rawFoto = 'uploads/'.$rawFoto;
    $fotoSrc = base_url($rawFoto);
  }
} else {
  $fotoSrc = base_url('assets/img/avatar.jpg'); // pastikan file ini ada
}
?>

<section id="hero" class="relative h-screen w-full overflow-hidden bg-black text-white">
  <!-- Particles -->
  <canvas id="particlesCanvas" class="absolute inset-0 w-full h-full"></canvas>

  <!-- Waves (SVG animated) -->
  <svg class="absolute inset-x-0 bottom-0 w-[140%] -left-[20%] opacity-40" viewBox="0 0 1440 240" fill="none" aria-hidden="true">
    <path class="wave stroke-cyan-400" stroke-width="2" d="M0 120 Q 180 60 360 120 T 720 120 T 1080 120 T 1440 120"/>
    <path class="wave2 stroke-cyan-300" stroke-width="1.5" d="M0 140 Q 200 90 400 140 T 800 140 T 1200 140 T 1600 140"/>
  </svg>

  <!-- Content -->
  <div class="relative z-10 h-full container mx-auto px-6 flex flex-col justify-center">
    <div id="heroText" class="max-w-5xl">
      <h1 class="text-[42px] md:text-[88px] font-extrabold leading-[1.05] tracking-tight drop-shadow-[0_0_20px_rgba(0,255,255,.15)]">
        <?= esc($biodata['nama']) ?>
      </h1>

      <!-- Role badge -->
      <div class="mt-3 inline-flex items-center gap-2 px-3 py-2 rounded-full bg-white/5 backdrop-blur border border-white/10 shadow-[0_0_24px_rgba(0,255,255,.2)]">
        <span class="inline-block w-3 h-3 rounded-full bg-cyan-400 animate-ping-slow"></span>
        <span class="text-sm tracking-wide">
          <span class="bracket">▢</span>
          <?= esc($role) ?>
          <span class="bracket">▢</span>
        </span>
      </div>

      <!-- Deskripsi: hardcoded -->
      <p class="mt-4 max-w-2xl text-gray-300/90">
        <?= esc($heroText) ?>
      </p>
    </div>

    <!-- Tombol anchor -->
    <div class="absolute left-1/2 -translate-x-1/2 bottom-8 flex items-center gap-3">
      <a href="#about"       class="btn-capsule">About</a>
      <a href="#pengalaman"  class="btn-capsule">Experience</a>
      <a href="#portofolio"  class="btn-capsule">Project</a>
    </div>
  </div>

  <!-- Floating ID card -->
  <div id="floatingCard"
       class="hidden md:block absolute right-6 md:right-12 top-24 md:top-28 w-52 rotate-3
              bg-white/5 backdrop-blur border border-white/10 rounded-xl shadow-[0_20px_60px_rgba(0,0,0,.45)]
              overflow-hidden">
    <div class="h-28 bg-gradient-to-br from-cyan-500/20 to-transparent"></div>
    <div class="px-4 -mt-8 pb-4">
      <img class="w-20 h-20 rounded-lg ring-4 ring-black object-cover"
           src="<?= esc($fotoSrc) ?>"
           alt="Foto <?= esc($biodata['nama']) ?>">
      <div class="mt-3">
        <div class="text-sm text-gray-300/90">ID CARD</div>
        <div class="font-semibold"><?= esc($biodata['nama']) ?></div>
        <div class="text-xs text-gray-400"><?= esc($role) ?></div>
      </div>
    </div>
  </div>
</section>
