<?= $this->extend('cv/layout') ?>
<?= $this->section('content') ?>

<?php
  // Pilih role dari tabel keahlian (prioritaskan yang mengandung “Mobile/Android/iOS”).
  $role = 'Mobile Developer';
  if (!empty($keahlian)) {
    $preferred = array_values(array_filter($keahlian, function($k){
      return preg_match('/mobile|android|ios/i', $k['nama_keahlian'] ?? '');
    }));
    $role = $preferred[0]['nama_keahlian'] ?? ($keahlian[0]['nama_keahlian'] ?? 'Mobile Developer');
  }
?>

<!-- ================= HERO ================= -->
<section id="hero" class="relative min-h-screen w-full overflow-hidden bg-black text-white">
  <!-- Particles (2D canvas) -->
  <canvas id="particlesCanvas" class="absolute inset-0 w-full h-full"></canvas>

  <!-- Konten -->
  <div class="relative z-10 h-full container mx-auto px-6 flex flex-col justify-center">
    <div id="heroText" class="max-w-5xl">
      <p class="text-xs md:text-sm uppercase tracking-[0.35em] text-gray-400/80 mb-2">Portofolio</p>

      <h1 class="text-4xl md:text-[88px] font-extrabold leading-[1.05] tracking-tight drop-shadow-[0_0_20px_rgba(0,255,255,.15)] mb-2">
        <?= esc($biodata['nama'] ?? ($name ?? 'Nama')) ?>
      </h1>

      <!-- Badge role dengan bracket (untuk typewriter #roleText) -->
      <div class="mt-2 inline-flex items-center gap-2 px-3 py-2 rounded-full bg-white/5 backdrop-blur border border-white/10 shadow-[0_0_24px_rgba(0,255,255,.2)]">
        <span class="inline-block w-3 h-3 rounded-full bg-cyan-400 animate-ping-slow"></span>
        <span class="text-sm tracking-wide">
          <span class="bracket">▢</span>
          <span id="roleText"><?= esc($role) ?></span>
          <span class="bracket">▢</span>
        </span>
      </div>

      <p class="mt-4 max-w-2xl text-gray-300/90">
        <?= esc($biodata['deskripsi'] ?? ($description ?? 'Deskripsi singkat tentang kamu')) ?>
      </p>
    </div>

    <!-- Tombol kecil di bawah -->
    <div class="absolute left-1/2 -translate-x-1/2 bottom-8 flex items-center gap-3">
      <a href="#about" class="btn-capsule">About</a>
      <a href="#keahlian" class="btn-capsule">Projects</a>
      <a href="#contact" class="btn-capsule">Contact</a>
    </div>
  </div>

  <!-- Kartu foto mengambang (ikut parallax oleh hero-ui.js) -->
  <div id="floatingCard"
       class="hidden md:block absolute right-6 md:right-12 top-24 md:top-28 w-52 rotate-3
              bg-white/5 backdrop-blur border border-white/10 rounded-xl shadow-[0_20px_60px_rgba(0,0,0,.45)]
              overflow-hidden">
    <div class="h-28 bg-gradient-to-br from-cyan-500/20 to-transparent"></div>
    <div class="px-4 -mt-8 pb-4">
      <img class="w-20 h-20 rounded-lg ring-4 ring-black object-cover"
           src="<?= base_url('uploads/' . ($biodata['foto'] ?? 'avatar.png')) ?>" alt="Foto">
      <div class="mt-3">
        <div class="text-sm text-gray-300/90">ID CARD</div>
        <div class="font-semibold"><?= esc($biodata['nama'] ?? 'Nama') ?></div>
        <div class="text-xs text-gray-400"><?= esc($role) ?></div>
      </div>
    </div>
  </div>
</section>
<!-- =============== END HERO =============== -->


<!-- ================= ABOUT / BIODATA ================= -->
<section id="about" class="min-h-screen bg-gray-900 text-gray-100 flex items-center py-20" data-aos="fade-up">
  <div class="container mx-auto px-6 max-w-6xl grid md:grid-cols-2 gap-12">
    
    <!-- Foto kiri -->
    <div class="about-photo flex justify-center md:justify-start" data-aos="fade-right">
      <div class="relative w-56 h-56 md:w-72 md:h-72 rounded-3xl overflow-hidden shadow-[0_25px_80px_rgba(0,0,0,0.75)] border border-gray-700/70 bg-gradient-to-br from-gray-800 to-gray-950">
        <div class="absolute inset-0 opacity-40 bg-[radial-gradient(circle_at_0_0,#ec4899,transparent_50%),radial-gradient(circle_at_100%_100%,#22d3ee,transparent_50%)]"></div>
        <?php if (!empty($biodata['foto'])): ?>
          <img src="<?= base_url('uploads/'.$biodata['foto']) ?>"
               alt="Foto <?= esc($biodata['nama']) ?>"
               class="relative z-10 w-full h-full object-cover">
        <?php else: ?>
          <div class="relative z-10 w-full h-full flex items-center justify-center text-gray-400">
            Foto belum diupload
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Deskripsi kanan -->
    <div class="about-text space-y-6" data-aos="fade-left">
      <div class="space-y-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-pink-500/10 text-pink-300 text-xs tracking-[0.2em] uppercase">
          About Me
        </span>

        <h2 class="text-3xl md:text-4xl font-bold mb-1"><?= esc($biodata['nama'] ?? 'Nama') ?></h2>
        <p class="text-sm uppercase tracking-[0.25em] text-pink-300/80 mb-1">
          <?= esc($biodata['role'] ?? $role) ?>
        </p>

        <p class="text-gray-300 leading-relaxed">
          <?= esc($biodata['deskripsi_singkat'] ?? ($biodata['deskripsi'] ?? 'Tulis deskripsi singkat tentang kamu di sini.')) ?>
        </p>
      </div>

      <!-- tombol + panel data pribadi -->
      <div class="space-y-3">
        <button id="btn-data-pribadi" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-pink-500 hover:bg-pink-400 text-sm font-medium transition shadow-lg shadow-pink-500/25">
          <span>Data pribadi</span>
          <svg id="icon-chevron" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
          </svg>
        </button>

        <div id="panel-data-pribadi" class="mt-2 rounded-2xl border border-gray-700 bg-gray-950/70 px-4 py-4 hidden-panel">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="panel-cards">
            <div class="info-card rounded-xl border border-gray-700/70 bg-gray-900/60 px-3 py-3">
              <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400 mb-1">Nama</p>
              <p class="text-sm font-medium text-gray-50"><?= esc($biodata['nama'] ?? '-') ?></p>
            </div>
            <div class="info-card rounded-xl border border-gray-700/70 bg-gray-900/60 px-3 py-3">
              <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400 mb-1">Tanggal lahir</p>
              <p class="text-sm font-medium text-gray-50"><?= esc($biodata['tanggal_lahir'] ?? '-') ?></p>
            </div>
            <div class="info-card rounded-xl border border-gray-700/70 bg-gray-900/60 px-3 py-3">
              <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400 mb-1">Email</p>
              <p class="text-sm font-medium text-gray-50 break-all"><?= esc($biodata['email'] ?? '-') ?></p>
            </div>
            <div class="info-card rounded-xl border border-gray-700/70 bg-gray-900/60 px-3 py-3">
              <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400 mb-1">Telepon</p>
              <p class="text-sm font-medium text-gray-50"><?= esc($biodata['telepon'] ?? '-') ?></p>
            </div>
            <div class="info-card rounded-xl border border-gray-700/70 bg-gray-900/60 px-3 py-3 sm:col-span-2">
              <p class="text-[11px] uppercase tracking-[0.18em] text-gray-400 mb-1">Alamat</p>
              <p class="text-sm font-medium text-gray-50"><?= esc($biodata['alamat'] ?? '-') ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ================= JOURNEY ================= -->
<section id="my-journey" class="min-h-screen bg-gray-900 text-gray-100 flex items-center py-20" data-aos="fade-up">
  <div class="container mx-auto px-6 max-w-6xl grid md:grid-cols-2 gap-12">
    <div class="relative flex justify-center items-center" data-aos="fade-right">
      <div class="vertical-line"></div>
    </div>
    <div class="journey-text space-y-6" data-aos="fade-left">
      <?php foreach ($pendidikan as $pendidikanItem): ?>
        <div class="journey-item fade-in">
          <h2 class="text-3xl md:text-4xl font-semibold mb-4"><?= esc($pendidikanItem['jenjang']) ?></h2>
          <p class="text-sm text-gray-400 mb-4">
            <?= esc($pendidikanItem['institusi']) ?> (<?= esc($pendidikanItem['tahun_mulai']) ?> - <?= esc($pendidikanItem['tahun_selesai']) ?>)
          </p>
          <p class="text-gray-300"><?= esc($pendidikanItem['deskripsi'] ?? 'Deskripsi pendidikan') ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ================= KEAHLIAN ================= -->
<section id="keahlian" class="min-h-screen bg-gradient-to-br from-indigo-600 via-blue-500 to-indigo-800 text-white py-20" data-aos="fade-up">
  <div class="container mx-auto px-6 max-w-6xl grid md:grid-cols-2 gap-12">
    <!-- Kiri: deskripsi & contoh card statis -->
    <div class="keahlian-left space-y-8" data-aos="fade-right">
      <h2 class="text-3xl md:text-4xl font-semibold mb-4">Keahlian Saya</h2>
      <p class="text-lg text-gray-200">Saya memiliki berbagai keahlian dalam bidang teknologi, terutama dalam pengembangan perangkat lunak dan desain web.</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="keahlian-card rounded-xl border border-white/20 bg-white/10 p-6 shadow-xl transition-transform transform hover:scale-105 hover:shadow-2xl">
          <h3 class="text-xl font-semibold text-center">HTML/CSS</h3>
          <p class="text-gray-100 text-center mt-2">Membangun struktur & styling halaman web.</p>
        </div>
        <div class="keahlian-card rounded-xl border border-white/20 bg-white/10 p-6 shadow-xl transition-transform transform hover:scale-105 hover:shadow-2xl">
          <h3 class="text-xl font-semibold text-center">JavaScript</h3>
          <p class="text-gray-100 text-center mt-2">Interaktivitas di sisi klien.</p>
        </div>
        <div class="keahlian-card rounded-xl border border-white/20 bg-white/10 p-6 shadow-xl transition-transform transform hover:scale-105 hover:shadow-2xl">
          <h3 class="text-xl font-semibold text-center">Backend (CI4/PHP)</h3>
          <p class="text-gray-100 text-center mt-2">API, Model, dan Query yang rapi.</p>
        </div>
      </div>
    </div>

    <!-- Kanan: kanvas placeholder (bisa diisi three.js nanti) -->
    <div class="keahlian-right flex justify-center items-center" data-aos="fade-left">
      <div class="w-full h-full flex justify-center">
        <canvas id="computerCanvas" width="420" height="420"></canvas>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
