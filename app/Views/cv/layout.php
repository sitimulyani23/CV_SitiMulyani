<?php // File: app/Views/cv/layout.php ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CV - <?= esc($biodata['nama']) ?></title>

  <!-- Tailwind (agar header/footer ber-styling sesuai kelas yang kamu pakai) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- AOS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

  <!-- CSS kamu -->
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
</head>
<body
class="bg-black text-white">
  <?= view('cv/partials/header') ?>
  <?= view('cv/hero') ?>

  <!-- GLOBAL BACKGROUND (sekali saja) -->
<div id="siteBg" class="site-bg" aria-hidden="true"></div> 

  <main>
    <?= view('cv/sections/biodata', ['biodata' => $biodata]) ?>
    <?= view('cv/sections/pendidikan', ['pendidikan' => $pendidikan]) ?>
    <?= view('cv/sections/keahlian', ['keahlian' => $keahlian]) ?>
    <?= view('cv/sections/pengalaman', ['pengalaman' => $pengalaman]) ?>
    <?= view('cv/sections/portofolio', ['portofolio' => $portofolio]) ?>
  </main>

  <?= view('cv/partials/footer') ?>

  <!-- JS: pakai CDN + file global SAJA (jangan muat hero-3d.js/hero-anim.js yang pakai import) -->
  <script src="https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true, offset: 100 });</script>

  <!-- Animasi hero + interaksi -->
  <script src="<?= base_url('assets/js/hero-3d.global.js') ?>?v=1"></script>
  <script src="<?= base_url('assets/js/main.js') ?>?v=1"></script>

  <!-- Animasi UI hero -->
<script src="<?= base_url('assets/js/hero-ui.js') ?>?v=1"></script>


<script src="<?= base_url('assets/js/edu.js') ?>?v=1"></script>

<script src="/assets/js/skills-grid.js" defer></script>

<script src="/assets/js/particles.js" defer></script>

<script src="<?= base_url('assets/js/experience.js') ?>" defer></script>

<script src="<?= base_url('assets/js/portfolio.js') ?>" defer></script>

<script src="<?= base_url('assets/js/reveal.js') ?>" defer></script>



</body>
</html>
