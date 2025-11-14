<?php
// app/Views/cv/sections/pendidikan.php
$items = $pendidikan ?? [];
usort($items, fn($a,$b) => intval($a['tahun_mulai'] ?? 0) <=> intval($b['tahun_mulai'] ?? 0));
?>
<section id="education" class="relative py-14 overflow-hidden">


  <!-- LAYER PARTIKEL SIMBOL TI -->
  <div id="eduFloating" class="edu-floating pointer-events-none"></div>

  <div class="container mx-auto px-6 max-w-5xl relative z-10">
    <header class="mb-8 text-center">
      <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight">Education</h2>
      
    </header>

    <div class="relative">
      <!-- track & progress -->
      <div class="edu-track"></div>
      <div class="edu-progress" id="eduProgress"></div>

      <ol class="space-y-8">
        <?php foreach ($items as $i => $row): 
          $left  = $i % 2 === 0;
          $start = $row['tahun_mulai'] ?? '';
          $end   = $row['tahun_selesai'] ?? '';
          $badge = trim(($start ?: '—') . '–' . ($end ?: '—'));
        ?>
        <li class="edu-item <?= $left ? 'left' : 'right' ?>">
          <span class="edu-dot"></span>

          <article class="edu-card edu-xs">
            <div class="edu-badge"><?= esc($badge) ?></div>
            <h3 class="edu-title text-base">
              <?= esc($row['jenjang'] ?? '-') ?>
              <?php if(!empty($row['jurusan'])): ?>
                <span class="text-cyan-300/90">· <?= esc($row['jurusan']) ?></span>
              <?php endif; ?>
            </h3>
            <p class="edu-sub text-sm"><?= esc($row['institusi'] ?? '-') ?></p>
            <?php if(!empty($row['keterangan'])): ?>
              <ul class="edu-bullets text-[12px]">
                <li><?= esc($row['keterangan']) ?></li>
              </ul>
            <?php endif; ?>
          </article>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>
