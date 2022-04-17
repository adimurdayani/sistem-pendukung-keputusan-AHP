-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Apr 2022 pada 02.58
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-pao`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `alternatif_id` varchar(128) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baris_dua`
--

CREATE TABLE `baris_dua` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baris_dua_alternatif`
--

CREATE TABLE `baris_dua_alternatif` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baris_satu`
--

CREATE TABLE `baris_satu` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baris_satu_alternatif`
--

CREATE TABLE `baris_satu_alternatif` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baris_tiga`
--

CREATE TABLE `baris_tiga` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baris_tiga_alternatif`
--

CREATE TABLE `baris_tiga_alternatif` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `evn_normalisasi`
--

CREATE TABLE `evn_normalisasi` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `evn` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `evn_normalisasi_alternatif`
--

CREATE TABLE `evn_normalisasi_alternatif` (
  `id` int(11) NOT NULL,
  `nilai` float DEFAULT NULL,
  `nilai_dua` float DEFAULT NULL,
  `nilai_tiga` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `evn` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'subadmin', 'Sub Admin'),
(4, 'member', 'General User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_mangrove`
--

CREATE TABLE `jenis_mangrove` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_mangrove`
--

INSERT INTO `jenis_mangrove` (`id`, `nama`, `keterangan`, `created_at`) VALUES
(1, 'Rhizopora mucronata (bakau)', 'bakau', NULL),
(2, 'R. stylosa (tongke besar)', 'tongke besar', NULL),
(3, 'R. apiculata (tinjang)', 'tinjang', NULL),
(4, 'Bruguiera parvilofa (bius)', 'bius', NULL),
(5, 'B. sexangula (tancang)', 'tancang', NULL),
(6, 'B. gymnorhiza (tanjang merah)', 'tanjang merah', NULL),
(7, 'Sonneratia alba (pedada bogem)', 'pedada bogem', NULL),
(8, 'S. caseolaris (pedada)', 'pedada', NULL),
(9, 'Xylocarpus granatum (nyirih)', 'nyirih', NULL),
(10, 'Heritiera littoralis (bayur laut)', 'bayur laut', NULL),
(11, 'Lumnitzera racemora (tarumtum)', 'tarumtum', NULL),
(12, 'Carbera manghas (bintaro)', 'bintaro', NULL),
(13, 'Nypa fruticans (nipah)', 'nipah', NULL),
(14, 'Avecinea spp. (api-api)', 'api-api', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_tanah`
--

CREATE TABLE `jenis_tanah` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_tanah`
--

INSERT INTO `jenis_tanah` (`id`, `nama`, `keterangan`, `created_at`) VALUES
(2, 'Berpasir', 'tanah berpasir', NULL),
(3, 'Lumpur Berpasir', 'tanah berlumpur dan berpasir', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kriteria_id` varchar(100) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_frekuensi`
--

CREATE TABLE `nilai_frekuensi` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_frekuensi`
--

INSERT INTO `nilai_frekuensi` (`id`, `nama`, `nilai`) VALUES
(1, 'Sama Penting Dengan', 1),
(2, 'Mendekati Sedikit Lebih Penting Dari', 2),
(3, 'Sedikit lebih penting dari', 3),
(4, 'Mendekati lebih penting dari', 4),
(5, 'Lebih penting dari', 5),
(6, 'Mendekati sangat penting dari', 6),
(7, 'Sangat penting dari', 7),
(8, '1 bagi lebih penting dari', 0.2),
(9, '1 bagi sangat penting dari', 0.14),
(10, '.1 bagi lebih penting dari', 0.33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbandingan`
--

CREATE TABLE `perbandingan` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_kriteria_dua` int(11) DEFAULT NULL,
  `nilai_kriteria` double DEFAULT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbandingan_dua`
--

CREATE TABLE `perbandingan_dua` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_alternatif_dua` int(11) DEFAULT NULL,
  `nilai_alternatif` float DEFAULT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rasio_konsistensi`
--

CREATE TABLE `rasio_konsistensi` (
  `id` int(11) NOT NULL,
  `emaks` float DEFAULT NULL,
  `ci` float DEFAULT NULL,
  `cr` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rasio_konsistensi_alternatif`
--

CREATE TABLE `rasio_konsistensi_alternatif` (
  `id` int(11) NOT NULL,
  `emaks` float DEFAULT NULL,
  `ci` float DEFAULT NULL,
  `cr` float DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_visitor`
--

CREATE TABLE `tb_visitor` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `online` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_visitor`
--

INSERT INTO `tb_visitor` (`id`, `ip`, `date`, `hits`, `online`, `time`) VALUES
(1, '::1', '2022-04-17', 3, '1650156001', '2022-04-17 02:09:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(6, '::1', NULL, '$2y$10$GPWCBUEYxd0fxjQDfZ3GyuYvfI8qTLb/E8l.QnvUP.9/LgFqgWqQe', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1646561458, 1650154154, 1, 'Admin', 'nistrator', 'Sekolah', '0812638172'),
(11, '', 'admin12', '$2y$10$u9DRpp8h3idMa7zXyzo7BeT1dPDZ8YkMmGhOa1aRBVVe8uQ9nfaUO', 'admin2@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1650156001, 1, 'Admin2', 'subadmin2', 'UNCP', '0812638172');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(7, 6, 1),
(16, 11, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `group_id`, `menu_id`) VALUES
(1, 1, 1),
(4, 1, 3),
(5, 1, 4),
(30, 1, 5),
(33, 4, 2),
(35, 4, 7),
(36, 2, 6),
(42, 2, 3),
(43, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Navigasi'),
(2, 'Data'),
(3, 'User'),
(4, 'Menu'),
(5, 'Setting'),
(6, 'Frekuensi'),
(7, 'Analisis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'backend/dashboard', 'fe-airplay', 1),
(2, 2, 'Data Kriteria', 'backend/data', 'fe-package', 1),
(3, 3, 'User Manajemen', 'backend/user', 'fe-users', 1),
(4, 4, 'Menu Manajemen', 'backend/menu', 'fe-menu', 1),
(5, 4, 'Submenu Manajemen', 'backend/submenu', 'fe-list', 1),
(7, 5, 'Profile', 'backend/setting', 'fe-settings', 1),
(8, 6, 'Data  Frekuensi', 'backend/frekuensi', 'fe-edit', 1),
(11, 7, 'Analisis Kriteria', 'backend/analisis', 'fe-database', 1),
(12, 2, 'Data Alternatif', 'backend/data/alternatif', 'fe-list', 1),
(13, 7, 'Analisis Alternatif', 'backend/alternatif', 'fe-database', 1),
(14, 2, 'Jenis Mangrove', 'backend/jenis_mangrove', 'fe-database', 1),
(15, 2, 'Jenis Tanah', 'backend/jenis_tanah', 'fe-database', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `baris_dua`
--
ALTER TABLE `baris_dua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `baris_dua_alternatif`
--
ALTER TABLE `baris_dua_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `baris_satu`
--
ALTER TABLE `baris_satu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `baris_satu_alternatif`
--
ALTER TABLE `baris_satu_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `baris_tiga`
--
ALTER TABLE `baris_tiga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `baris_tiga_alternatif`
--
ALTER TABLE `baris_tiga_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `evn_normalisasi`
--
ALTER TABLE `evn_normalisasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `evn_normalisasi_alternatif`
--
ALTER TABLE `evn_normalisasi_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_mangrove`
--
ALTER TABLE `jenis_mangrove`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_tanah`
--
ALTER TABLE `jenis_tanah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_frekuensi`
--
ALTER TABLE `nilai_frekuensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perbandingan`
--
ALTER TABLE `perbandingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `perbandingan_dua`
--
ALTER TABLE `perbandingan_dua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `rasio_konsistensi`
--
ALTER TABLE `rasio_konsistensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `rasio_konsistensi_alternatif`
--
ALTER TABLE `rasio_konsistensi_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_visitor`
--
ALTER TABLE `tb_visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baris_dua`
--
ALTER TABLE `baris_dua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baris_dua_alternatif`
--
ALTER TABLE `baris_dua_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baris_satu`
--
ALTER TABLE `baris_satu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baris_satu_alternatif`
--
ALTER TABLE `baris_satu_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baris_tiga`
--
ALTER TABLE `baris_tiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baris_tiga_alternatif`
--
ALTER TABLE `baris_tiga_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `evn_normalisasi`
--
ALTER TABLE `evn_normalisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `evn_normalisasi_alternatif`
--
ALTER TABLE `evn_normalisasi_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_mangrove`
--
ALTER TABLE `jenis_mangrove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jenis_tanah`
--
ALTER TABLE `jenis_tanah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `nilai_frekuensi`
--
ALTER TABLE `nilai_frekuensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `perbandingan`
--
ALTER TABLE `perbandingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `perbandingan_dua`
--
ALTER TABLE `perbandingan_dua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rasio_konsistensi`
--
ALTER TABLE `rasio_konsistensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rasio_konsistensi_alternatif`
--
ALTER TABLE `rasio_konsistensi_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_visitor`
--
ALTER TABLE `tb_visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `baris_dua`
--
ALTER TABLE `baris_dua`
  ADD CONSTRAINT `baris_dua_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `baris_dua_alternatif`
--
ALTER TABLE `baris_dua_alternatif`
  ADD CONSTRAINT `baris_dua_alternatif_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `baris_satu`
--
ALTER TABLE `baris_satu`
  ADD CONSTRAINT `baris_satu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `baris_satu_alternatif`
--
ALTER TABLE `baris_satu_alternatif`
  ADD CONSTRAINT `baris_satu_alternatif_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `baris_tiga`
--
ALTER TABLE `baris_tiga`
  ADD CONSTRAINT `baris_tiga_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `baris_tiga_alternatif`
--
ALTER TABLE `baris_tiga_alternatif`
  ADD CONSTRAINT `baris_tiga_alternatif_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `evn_normalisasi`
--
ALTER TABLE `evn_normalisasi`
  ADD CONSTRAINT `evn_normalisasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `evn_normalisasi_alternatif`
--
ALTER TABLE `evn_normalisasi_alternatif`
  ADD CONSTRAINT `evn_normalisasi_alternatif_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `perbandingan`
--
ALTER TABLE `perbandingan`
  ADD CONSTRAINT `perbandingan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `perbandingan_dua`
--
ALTER TABLE `perbandingan_dua`
  ADD CONSTRAINT `perbandingan_dua_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rasio_konsistensi`
--
ALTER TABLE `rasio_konsistensi`
  ADD CONSTRAINT `rasio_konsistensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rasio_konsistensi_alternatif`
--
ALTER TABLE `rasio_konsistensi_alternatif`
  ADD CONSTRAINT `rasio_konsistensi_alternatif_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
