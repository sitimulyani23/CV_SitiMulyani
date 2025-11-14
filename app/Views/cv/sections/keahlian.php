<?php
// app/Views/cv/sections/keahlian.php
$items = $keahlian ?? [];
?>
<section id="keahlian" class="bg-hero">
  <div id="skillsFloating" class="skills-floating pointer-events-none" aria-hidden="true"></div>
  <div class="container mx-auto px-6 max-w-6xl">
    <header class="text-center mb-10">
      <h2 class="text-3xl font-extrabold tracking-tight section-title">Skills</h2>
      <p class="text-sm text-gray-300/80">Fokus pada kemampuan inti yang sering dipakai</p>
    </header>

    <!-- GRID ala "Services" -->
    <ul class="neon-services" id="skillsGrid">
      <?php foreach ($items as $i => $row): ?>
        <li class="svc-card reveal">
          <span class="svc-accent" aria-hidden="true"></span>
          <div class="svc-body">
            <h3 class="svc-title"><?= esc($row['nama_keahlian']) ?></h3>
            <span class="svc-level">(<?= esc($row['tingkat']) ?>)</span>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
