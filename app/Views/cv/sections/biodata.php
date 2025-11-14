<?php
// app/Views/cv/sections/biodata.php

// ===== Role: pakai dari $biodata['role'] kalau ada, jika tidak ambil dari keahlian pertama
$role = $biodata['role'] ?? ($keahlian[0]['nama_keahlian'] ?? 'Mahasiswa / Web Developer');

// ===== Normalisasi sumber foto =====
// DB boleh simpan: "aku.jpg", "uploads/aku.jpg", atau URL penuh
$rawFoto = $biodata['foto'] ?? '';
if ($rawFoto) {
    if (filter_var($rawFoto, FILTER_VALIDATE_URL)) {
        $fotoSrc = $rawFoto; // URL penuh
    } else {
        $rawFoto = ltrim($rawFoto, '/');
        if (strpos($rawFoto, 'uploads/') !== 0) {
            $rawFoto = 'uploads/' . $rawFoto; // prefix otomatis
        }
        $fotoSrc = base_url($rawFoto);
    }
} else {
    // Fallback avatar default (pastikan file ada)
    $fotoSrc = base_url('assets/img/aku.jpg');
}

// ===== Helper deskripsi multiline aman =====
$desc = $biodata['deskripsi'] ?? 'Tulis deskripsi singkat tentang kamu di sini.';
$descHtml = nl2br(esc($desc)); // ubah "\n" jadi <br> dan aman XSS
?>

<section id="about"
         class="bg-hero soft-join relative min-h-screen text-gray-100 flex items-center py-20 overflow-hidden"
         data-aos="fade-up">

  <!-- Partikel halus (tidak menghalangi klik) -->
  <canvas id="aboutParticles" class="absolute inset-0 w-full h-full pointer-events-none"></canvas>

  <div class="relative z-10 container mx-auto px-6 max-w-6xl grid md:grid-cols-2 gap-12 section-3d">
    <!-- ===== Foto kiri ===== -->
    <div class="about-photo flex justify-center md:justify-start" data-aos="fade-right">
      <div class="relative w-56 h-56 md:w-72 md:h-72 rounded-3xl overflow-hidden glow-card reveal-photo">
        <!-- overlay glow -->
        <div class="absolute inset-0 opacity-40
                    bg-[radial-gradient(circle_at_0_0,#22d3ee,transparent_50%),radial-gradient(circle_at_100%_100%,#0ea5e9,transparent_50%)]">
        </div>

        <img src="<?= esc($fotoSrc) ?>"
             alt="Foto <?= esc($biodata['nama'] ?? 'Profil') ?>"
             class="relative z-10 w-full h-full object-cover">
      </div>
    </div>

    <!-- ===== Deskripsi kanan ===== -->
    <div class="about-text space-y-6" data-aos="fade-left">
      <div class="space-y-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-300 text-xs tracking-[0.2em] uppercase">
          About Me
        </span>

        <h2 class="text-3xl md:text-4xl font-bold mb-1 reveal-item">
          <?= esc($biodata['nama'] ?? 'Nama') ?>
        </h2>

        <p class="text-sm uppercase tracking-[0.25em] text-cyan-300/80 mb-1 reveal-item">
          <?= esc($role) ?>
        </p>

        <!-- Deskripsi: sudah mendukung baris baru -->
        <p class="text-gray-200/90 leading-relaxed reveal-item">
          <?= $descHtml ?>
        </p>
      </div>

      <!-- Tombol & Panel Data Pribadi -->
      <div class="space-y-3">
        <button id="btn-data-pribadi"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-cyan-500 hover:bg-cyan-400 text-black text-sm font-medium transition shadow-lg shadow-cyan-500/25 active:scale-[.98]">
          <span>Data pribadi</span>
          <svg id="icon-chevron" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-300"
               viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                  clip-rule="evenodd"/>
          </svg>
        </button>

        <div id="panel-data-pribadi" class="mt-2 rounded-2xl panel-surface px-4 py-4 hidden-panel">
          <div id="panel-cards" class="grid grid-cols-1 sm:grid-cols-2 gap-3 card-tilt">

            <div class="info-card rounded-xl px-3 py-3">
              <p class="label">Nama</p>
              <p class="value"><?= esc($biodata['nama'] ?? '-') ?></p>
            </div>

            <div class="info-card rounded-xl px-3 py-3">
              <p class="label">Tempat & Tanggal Lahir</p>
              <p class="value">
                <?= esc(($biodata['tempat_lahir'] ?? '-') . ', ' . (@date('d F Y', strtotime($biodata['tanggal_lahir'] ?? '')) ?: '-')) ?>
              </p>
            </div>

            <div class="info-card rounded-xl px-3 py-3">
              <p class="label">Email</p>
              <p class="value break-all"><?= esc($biodata['email'] ?? '-') ?></p>
            </div>

            <div class="info-card rounded-xl px-3 py-3">
              <p class="label">Telepon</p>
              <p class="value"><?= esc($biodata['telepon'] ?? '-') ?></p>
            </div>

            <div class="info-card rounded-xl px-3 py-3 sm:col-span-2">
              <p class="label">Alamat</p>
              <p class="value"><?= esc($biodata['alamat'] ?? '-') ?></p>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- ===== /Deskripsi kanan ===== -->
  </div>
</section>
