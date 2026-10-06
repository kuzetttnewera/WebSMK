-- ============================================================
-- SKANDA - Update Database
-- Jalankan file ini di database `db_skanda` yang sudah ada
-- (via phpMyAdmin > Import, atau `mysql -u root db_skanda < database_update.sql`)
--
-- Menambahkan tabel untuk fitur:
-- 1. Lulusan Terbaik (menggantikan halaman Galeri lama)
-- 2. Lowongan Pekerjaan
-- 3. Produk Khas Sekolah
-- 4. Mitra / Perusahaan yang bekerja sama
-- ============================================================

-- 1. LULUSAN TERBAIK
CREATE TABLE IF NOT EXISTS `lulusan_terbaik` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `jurusan` VARCHAR(100) NOT NULL,
  `tahun_lulus` VARCHAR(4) NOT NULL,
  `prestasi` TEXT NOT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `urutan` INT(11) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2. LOWONGAN PEKERJAAN
CREATE TABLE IF NOT EXISTS `lowongan_kerja` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `posisi` VARCHAR(150) NOT NULL,
  `perusahaan` VARCHAR(150) NOT NULL,
  `lokasi` VARCHAR(150) DEFAULT NULL,
  `jenis` VARCHAR(20) NOT NULL DEFAULT 'Full Time',
  `deskripsi` TEXT NOT NULL,
  `kualifikasi` TEXT DEFAULT NULL,
  `kontak` VARCHAR(100) DEFAULT NULL,
  `tanggal_tutup` DATE DEFAULT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'Aktif',
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 3. PRODUK KHAS SEKOLAH
CREATE TABLE IF NOT EXISTS `produk_sekolah` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(150) NOT NULL,
  `jurusan` VARCHAR(100) DEFAULT NULL,
  `deskripsi` TEXT NOT NULL,
  `harga` VARCHAR(50) DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `urutan` INT(11) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 4. MITRA / PERUSAHAAN KERJASAMA
CREATE TABLE IF NOT EXISTS `mitra_perusahaan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(150) NOT NULL,
  `bidang` VARCHAR(150) DEFAULT NULL,
  `deskripsi` TEXT DEFAULT NULL,
  `logo` VARCHAR(255) DEFAULT NULL,
  `urutan` INT(11) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ============================================================
-- Contoh data awal (opsional, boleh dihapus/diubah lewat admin)
-- ============================================================

INSERT INTO `lulusan_terbaik` (`nama`, `jurusan`, `tahun_lulus`, `prestasi`, `foto`, `urutan`, `created_at`) VALUES
('Ayu Lestari', 'Rekayasa Perangkat Lunak', '2024', 'Juara 1 LKS Tingkat Provinsi, kini bekerja sebagai Junior Developer.', NULL, 1, NOW()),
('Budi Santoso', 'Teknik Kendaraan Ringan', '2024', 'Lulus dengan nilai tertinggi, diterima bekerja di PT Astra Honda Motor.', NULL, 2, NOW());

INSERT INTO `lowongan_kerja` (`posisi`, `perusahaan`, `lokasi`, `jenis`, `deskripsi`, `kualifikasi`, `kontak`, `tanggal_tutup`, `status`, `created_at`) VALUES
('Staff Produksi', 'PT Astra Honda Motor', 'Karanganyar', 'Full Time', 'Bertanggung jawab pada proses produksi dan quality control lini perakitan.', 'Lulusan SMK Teknik, sehat jasmani rohani, jujur dan disiplin.', '0271-000000', DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'Aktif', NOW());

INSERT INTO `produk_sekolah` (`nama`, `jurusan`, `deskripsi`, `harga`, `foto`, `urutan`, `created_at`) VALUES
('Kursi Kayu Jati Ukir', 'Desain Produksi Kriya Kayu', 'Kursi kayu jati hasil karya siswa dengan ukiran khas, dibuat menggunakan teknik finishing berkualitas.', 'Rp 500.000', NULL, 1, NOW());

INSERT INTO `mitra_perusahaan` (`nama`, `bidang`, `deskripsi`, `logo`, `urutan`, `created_at`) VALUES
('PT Astra Honda Motor', 'Otomotif', 'Mitra kerjasama untuk program PKL dan rekrutmen lulusan.', NULL, 1, NOW());
