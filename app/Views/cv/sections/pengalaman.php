<?php
// Data: $pengalaman = [
//   ['posisi'=>'Frontend Developer','instansi'=>'UKM Library Lovers Community','deskripsi'=>'Mengembangkan dan mendesain tampilan website komunitas.','tahun_mulai'=>2023,'tahun_selesai'=>2024],
//   ...]
// Urutkan terbaru -> lama
$items = $pengalaman ?? [];
usort($items, fn($a,$b)=> intval($b['tahun_mulai']??0) <=> intval($a['tahun_mulai']??0));
$featured = $items[0] ?? null;
$rest = array_slice($items, 1);
$period = function($r){
  $mulai = $r['tahun_mulai'] ?? '';
  $selesai = $r['tahun_selesai'] ?? '';
  return trim(($mulai ?: '—').'–'.($selesai ?: 'Sekarang'));
};
?>
<section id="pengalaman" class="exp-section bg-hero relative overflow-hidden">
  <!-- BG animasi -->
  <canvas id="expCanvas" class="exp-bg" aria-hidden="true"></canvas>

  <div class="container mx-auto px-6 max-w-6xl relative z-10 grid grid-cols-12 gap-8 items-center">
    <!-- Kiri: Copy -->
    <div class="col-span-12 md:col-span-6">
      <p class="exp-eyebrow">Experience</p>
      <h2 class="exp-title">learn<span class="dot">.</span></h2>
      <p class="exp-sub">Beberapa cara aku berkembang lewat proyek dan peran yang nyata.</p>
      <p class="exp-desc">
        Berbekal pengalaman membangun antarmuka dan sistem desain di berbagai tim,
        aku terbiasa mengubah kebutuhan menjadi UI yang usable dan cantik—dengan proses
        yang rapi, terukur, dan berorientasi dampak.
      </p>

      <?php if(!empty($rest)): ?>
      <ul class="exp-list">
        <?php foreach ($rest as $r): ?>
          <li class="exp-item">
            <span class="exp-bullet"></span>
            <div class="exp-lines">
              <strong><?= esc($r['posisi'] ?? '-') ?></strong>
              <span class="muted"> • <?= esc($r['instansi'] ?? '-') ?> • <?= esc($period($r)) ?></span>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>

    <!-- Kanan: “Buku” (featured) -->
    <div class="col-span-12 md:col-span-6">
      <div class="exp-stack">
        <div class="exp-sheet s1" aria-hidden="true"></div>
        <div class="exp-sheet s2" aria-hidden="true"></div>

        <article class="exp-book" id="expBook">
          <div class="exp-ribbon">latest</div>

          <header class="exp-book-head">
            <span class="brand">Practical <b>UI</b></span>
            <span class="edition">v2</span>
          </header>

          <div class="exp-book-body">
            <?php if($featured): ?>
              <h3 class="book-title"><?= esc($featured['posisi'] ?? '-') ?></h3>
              <p class="book-instansi"><?= esc($featured['instansi'] ?? '-') ?></p>
              <span class="book-period"><?= esc($period($featured)) ?></span>
              <?php if(!empty($featured['deskripsi'])): ?>
                <p class="book-desc"><?= esc($featured['deskripsi']) ?></p>
              <?php endif; ?>
            <?php else: ?>
              <h3 class="book-title">Belum ada pengalaman</h3>
              <p class="book-instansi">—</p>
              <span class="book-period">—</span>
            <?php endif; ?>
          </div>

          <!-- Pola UI di cover -->
          <div class="exp-pattern" aria-hidden="true">
            <svg viewBox="0 0 400 260" preserveAspectRatio="xMidYMid slice">
              <g opacity=".25" stroke="currentColor" stroke-width="1" fill="none">
                <rect x="18" y="18" width="110" height="70" rx="6"/>
                <rect x="140" y="18" width="110" height="40" rx="6"/>
                <rect x="140" y="64" width="110" height="24" rx="4"/>
                <rect x="262" y="18" width="120" height="70" rx="8"/>
                <rect x="18" y="98" width="364" height="48" rx="6"/>
                <rect x="18" y="154" width="110" height="88" rx="6"/>
                <rect x="140" y="154" width="110" height="88" rx="6"/>
                <rect x="262" y="154" width="120" height="88" rx="8"/>
              </g>
            </svg>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>
