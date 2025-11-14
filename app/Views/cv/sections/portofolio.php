<?php
// $portofolio = [
//  ['nama_proyek'=>'Website DutaBaca','deskripsi'=>'Forum & diskusi komunitas','link_demo'=>'https://kopernas.id','link_github'=>'https://github.com/sitimulyani/Dutabaca','tahun'=>2025],
//  ...
// ];
$items = $portofolio ?? [];
?>
<section id="portofolio" class="pf-section bg-hero relative overflow-hidden">
  <!-- BG code-rain -->
  <canvas id="pfRain" class="pf-bg" aria-hidden="true"></canvas>

  <div class="container mx-auto px-6 max-w-6xl relative z-10">
    <header class="text-center mb-10">
      <h2 class="pf-title">Projects</h2>

    </header>

    <ul class="pf-grid" id="pfGrid">
      <?php foreach ($items as $i => $row): ?>
      <li class="pf-card" data-idx="<?= $i ?>">
        <!-- Border elektrik -->
        <span class="pf-electric" aria-hidden="true"></span>

        <div class="pf-thumb" aria-hidden="true">
          <div class="pf-badge">Coming Soon</div>
        </div>

        <div class="pf-body">
          <h3 class="pf-name"><?= esc($row['nama_proyek'] ?? '-') ?></h3>
          <?php if (!empty($row['tahun'])): ?>
            <span class="pf-year"><?= esc($row['tahun']) ?></span>
          <?php endif; ?>

          <?php if (!empty($row['deskripsi'])): ?>
            <p class="pf-desc"><?= esc($row['deskripsi']) ?></p>
          <?php endif; ?>

          <div class="pf-actions">
            <?php if (!empty($row['link_demo'])): ?>
              <a class="pf-btn" href="<?= esc($row['link_demo']) ?>" target="_blank" rel="noopener">View Project</a>
            <?php endif; ?>
            <?php if (!empty($row['link_github'])): ?>
              <a class="pf-btn ghost" href="<?= esc($row['link_github']) ?>" target="_blank" rel="noopener">GitHub</a>
            <?php endif; ?>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
