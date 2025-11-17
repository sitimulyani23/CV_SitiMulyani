-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2025 at 11:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvsiti`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `telepon`, `deskripsi`, `foto`) VALUES
(1, 'Siti Mulyani', 'Ciamis', '2004-09-06', 'Jl. Pelda RE.Suryanta Gg.Maruf', 'sitimulyani8646@gmail.com', '08123456789', 'Mahasiswa TI yang fokus pada web development (CI4, JS) dan UI/UX. Aktif mengerjakan proyek komunitas dan suka eksperimen animasi interaktif.', 'uploads/aku.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keahlian`
--

CREATE TABLE `keahlian` (
  `id` int NOT NULL,
  `biodata_id` int DEFAULT NULL,
  `nama_keahlian` varchar(100) DEFAULT NULL,
  `tingkat` enum('Beginner','Intermediate','Advanced') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keahlian`
--

INSERT INTO `keahlian` (`id`, `biodata_id`, `nama_keahlian`, `tingkat`) VALUES
(1, 1, 'HTML / CSS / JavaScript', 'Advanced'),
(2, 1, 'PHP & CodeIgniter 4', 'Intermediate'),
(3, 1, 'UI/UX Design (Figma)', 'Intermediate'),
(4, 1, 'Three.js (3D Web Animation)', 'Beginner');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int NOT NULL,
  `biodata_id` int DEFAULT NULL,
  `jenjang` varchar(100) DEFAULT NULL,
  `institusi` varchar(150) DEFAULT NULL,
  `jurusan` varchar(150) DEFAULT NULL,
  `tahun_mulai` year DEFAULT NULL,
  `tahun_selesai` year DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `biodata_id`, `jenjang`, `institusi`, `jurusan`, `tahun_mulai`, `tahun_selesai`, `keterangan`) VALUES
(1, 1, 'S1', 'Universitas Muhammadiyah Kota Sukabumi', 'Teknik Informatika', '2023', '2027', 'Konsentrasi di bidang Web Development dan UI/UX.'),
(2, 1, 'SD', 'SD Nanggeleng 2', '', '2011', '2017', NULL),
(3, 1, 'SMP', 'SMP Negeri 12 Kota Sukabumi', '', '2017', '2020', NULL),
(4, 1, 'MA', 'MAN 1 Kota Sukabumi', 'IPS', '2020', '2023', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman`
--

CREATE TABLE `pengalaman` (
  `id` int NOT NULL,
  `biodata_id` int DEFAULT NULL,
  `posisi` varchar(100) DEFAULT NULL,
  `instansi` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `tahun_mulai` year DEFAULT NULL,
  `tahun_selesai` year DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengalaman`
--

INSERT INTO `pengalaman` (`id`, `biodata_id`, `posisi`, `instansi`, `deskripsi`, `tahun_mulai`, `tahun_selesai`) VALUES
(1, 1, 'Frontend Developer', 'UKM Library Lovers Community', 'Mengembangkan dan mendesain tampilan website komunitas berbasis interaktif.', '2023', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio`
--

CREATE TABLE `portofolio` (
  `id` int NOT NULL,
  `biodata_id` int DEFAULT NULL,
  `nama_proyek` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `link_demo` varchar(255) DEFAULT NULL,
  `link_github` varchar(255) DEFAULT NULL,
  `tahun` year DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `portofolio`
--

INSERT INTO `portofolio` (`id`, `biodata_id`, `nama_proyek`, `deskripsi`, `link_demo`, `link_github`, `tahun`) VALUES
(1, 1, 'Website DutaBaca', 'Platform DutaBaca sebagai forum diskusi interaktif dan moderasi komunitas. Menyediakan ruang kolaborasi, fitur berbagi dokumentasi, serta agenda kegiatan literasi sekolah/daerah. Menjadi sistem informasi nomor 1 DutaBaca Kota Sukabumi ', 'https://kopernas.id', 'https://github.com/sitimulyani/Dutabaca', '2025'),
(2, 1, 'CaSastra', 'Website komunitas sastra untuk publikasi puisi, cerpen, dan esai dengan kurasi editor serta profil penulis. Mendukung tag/genre, draf pribadi, event literasi berkala, dan sistem apresiasi karya. Serta sebagai sarana diskusi bagi para pecinta buku atau komunitas sastra', 'https://casastra.example.com', 'https://github.com/sitimulyani/casastra', '2025'),
(3, 1, 'Aplikasi Donasi', 'Aplikasi donasi uang untuk korban bencana dengan alur transparan: kampanye terverifikasi, metode pembayaran beragam, bukti transaksi otomatis, dan pelaporan penyaluran dana secara real-time. Ada leaderboard donatur & riwayat donasi.', 'https://donasi-app.example.com', 'https://github.com/sitimulyani/donasi-app', '2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biodata_id` (`biodata_id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biodata_id` (`biodata_id`);

--
-- Indexes for table `pengalaman`
--
ALTER TABLE `pengalaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biodata_id` (`biodata_id`);

--
-- Indexes for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biodata_id` (`biodata_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengalaman`
--
ALTER TABLE `pengalaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD CONSTRAINT `keahlian_ibfk_1` FOREIGN KEY (`biodata_id`) REFERENCES `biodata` (`id`);

--
-- Constraints for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD CONSTRAINT `pendidikan_ibfk_1` FOREIGN KEY (`biodata_id`) REFERENCES `biodata` (`id`);

--
-- Constraints for table `pengalaman`
--
ALTER TABLE `pengalaman`
  ADD CONSTRAINT `pengalaman_ibfk_1` FOREIGN KEY (`biodata_id`) REFERENCES `biodata` (`id`);

--
-- Constraints for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD CONSTRAINT `portofolio_ibfk_1` FOREIGN KEY (`biodata_id`) REFERENCES `biodata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
