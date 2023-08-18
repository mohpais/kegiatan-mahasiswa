-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 04:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_nopan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id` int(11) NOT NULL,
  `kd_user` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(455) NOT NULL,
  `login_attempts` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id`, `kd_user`, `role_id`, `nama`, `email`, `password`, `login_attempts`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, '7201190013', 1, 'M Fardian Nopandi', 'm.fardiannopandi29@gmail.com', '$2y$10$QzrvNGc5KDpAsaHiIw35MOoMFYQUk0Bfw64uI6YM9RgkbPfjSbBS6', 0, '2023-08-07 16:13:17', 'System', '2023-08-07 16:13:17', 'System'),
(7, 'admin', 4, 'Admin Website', '', '$2y$10$QzrvNGc5KDpAsaHiIw35MOoMFYQUk0Bfw64uI6YM9RgkbPfjSbBS6', 0, '2023-08-09 08:46:06', 'System', '2023-08-09 08:46:06', 'System'),
(8, '999', 3, 'Fauziyah, S.Kom, M.M.S.I', 'fauziyah29@gmail.com', '$2y$10$QzrvNGc5KDpAsaHiIw35MOoMFYQUk0Bfw64uI6YM9RgkbPfjSbBS6', 0, '2023-08-13 12:45:13', 'System', '2023-08-13 12:45:13', 'System'),
(9, '7344830029', 1, 'Ani RIyani', 'aniriyanii19@gmail.com', '$2y$10$cBVz9CPuJoIDrBLo4KvuEeREK/.rccs2A4nSGQmLgXt/lMYLSvb.m', 0, '2023-08-15 14:52:03', 'System', '2023-08-15 14:52:03', 'System'),
(10, '7201190029', 1, 'angun', '', '$2y$10$OA9O5oB4XFZVfUoTqibAROWQSe2STBW5ApxR5JGbBy769VdX3Ylom', 0, '2023-08-17 10:15:10', NULL, '2023-08-17 10:15:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `kd_kategori` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kd_kategori`, `nama`, `is_active`, `created_at`, `created_by`) VALUES
('KU', 'Kuliah Umum', 1, '2023-08-13 13:04:01', 'admin'),
('PPM', 'Pengabdian Pada Masyarakat', 1, '2023-08-13 13:03:47', 'admin'),
('SM', 'Seminar', 1, '2023-08-13 13:03:47', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lpj`
--

CREATE TABLE `tbl_lpj` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `link_foto` varchar(250) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lpj`
--

INSERT INTO `tbl_lpj` (`id`, `proposal_id`, `link_foto`, `is_active`, `created_at`, `created_by`) VALUES
(17, 27, 'https://drive.google.com/file/d/1zi5daZRgybpGuT7GcTTJMXbuadF2h10z/view?usp=sharing', 1, '2023-08-17 10:08:02', '7201190013'),
(18, 29, 'http://localhost:8080/project/skripsi-nopan/add-proposal.php', 1, '2023-08-17 10:11:39', '7201190013'),
(19, 30, 'http://localhost:8080/project/skripsi-nopan/add-proposal.php', 1, '2023-08-17 10:17:05', '7201190029'),
(20, 31, 'http://localhost:8080/project/skripsi-nopan/add-proposal.php', 1, '2023-08-17 10:18:50', '7201190029'),
(21, 32, 'http://localhost:8080/project/skripsi-nopan/add-proposal.php', 1, '2023-08-17 10:20:30', '7201190029');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proposal`
--

CREATE TABLE `tbl_proposal` (
  `id` int(11) NOT NULL,
  `kd_proposal` varchar(20) NOT NULL,
  `kd_kategori` varchar(5) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `judul` varchar(250) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `tahun_ajar_id` int(11) DEFAULT NULL,
  `link_dokumen` varchar(1000) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_proposal`
--

INSERT INTO `tbl_proposal` (`id`, `kd_proposal`, `kd_kategori`, `status_id`, `judul`, `semester`, `tahun_ajar_id`, `link_dokumen`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(27, 'PPM-00001', 'PPM', 7, 'Pengaplikasian E-Commerce pada UMKM', 'ganjil', 2, 'https://drive.google.com/file/d/1zovDEhRd6dT_Ox1KrKaMvm2UTyDOtvWY/view?usp=drive_link', 1, '2023-08-17 10:07:22', '7201190013', '2023-08-17 10:07:22', '7201190013'),
(28, 'KU-00001', 'KU', 4, 'Pentingnya E-Learning di Era Modern', 'genap', 1, 'http://localhost:8080/project/skripsi-nopan/laporan.php', 1, '2023-08-17 10:09:38', '7201190013', '2023-08-17 10:09:38', '7201190013'),
(29, 'SM-00001', 'SM', 7, 'Pentingnya E-Learning di Era Modern', 'genap', 1, 'http://localhost:8080/project/skripsi-nopan/index.php', 1, '2023-08-17 10:10:56', '7201190013', '2023-08-17 10:10:56', '7201190013'),
(30, 'SM-00002', 'SM', 7, 'Perancangan Algoritma Sistem Filter Berita Hoax Menggunakan Machine Learning', 'ganjil', 1, 'https://drive.google.com/file/d/1zi5daZRgybpGuT7GcTTJMXbuadF2h10z/view?usp=sharing', 1, '2023-08-17 10:16:17', '7201190029', '2023-08-17 10:16:17', '7201190029'),
(31, 'SM-00003', 'SM', 7, 'Pentingnya E-Learning di Era Modern', 'ganjil', 1, 'https://drive.google.com/file/d/1zi5daZRgybpGuT7GcTTJMXbuadF2h10z/view?usp=sharing', 1, '2023-08-17 10:18:10', '7201190029', '2023-08-17 10:18:10', '7201190029'),
(32, 'KU-00002', 'KU', 2, 'Perancangan Algoritma Sistem Filter Berita Hoax Menggunakan Machine Learning', 'genap', 2, 'https://drive.google.com/file/d/1zovDEhRd6dT_Ox1KrKaMvm2UTyDOtvWY/view?usp=drive_link', 1, '2023-08-17 10:19:44', '7201190029', '2023-08-17 10:19:44', '7201190029');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proposal_status`
--

CREATE TABLE `tbl_proposal_status` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `is_shown` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_proposal_status`
--

INSERT INTO `tbl_proposal_status` (`id`, `proposal_id`, `akun_id`, `status_id`, `catatan`, `created_at`, `is_shown`) VALUES
(194, 27, 6, 1, NULL, '2023-08-17 10:07:22', 1),
(195, 27, 6, 2, NULL, '2023-08-17 10:07:22', 0),
(196, 27, 8, 3, NULL, '2023-08-17 10:07:40', 1),
(197, 27, 6, 10, NULL, '2023-08-17 10:08:02', 1),
(198, 27, 6, 2, NULL, '2023-08-17 10:08:02', 0),
(199, 27, 8, 5, 'ganti foto', '2023-08-17 10:08:32', 1),
(200, 27, 8, 6, NULL, '2023-08-17 10:08:32', 1),
(201, 27, 6, 9, NULL, '2023-08-17 10:08:49', 1),
(202, 27, 6, 2, NULL, '2023-08-17 10:08:49', 0),
(203, 27, 8, 3, NULL, '2023-08-17 10:09:14', 1),
(204, 27, 8, 7, NULL, '2023-08-17 10:09:14', 1),
(205, 28, 6, 1, NULL, '2023-08-17 10:09:38', 1),
(206, 28, 6, 2, NULL, '2023-08-17 10:09:38', 0),
(207, 28, 8, 4, 'tidak sesuai judul', '2023-08-17 10:10:09', 1),
(208, 29, 6, 1, NULL, '2023-08-17 10:10:56', 1),
(209, 29, 6, 2, NULL, '2023-08-17 10:10:56', 0),
(210, 29, 8, 3, NULL, '2023-08-17 10:11:16', 1),
(211, 29, 6, 10, NULL, '2023-08-17 10:11:39', 1),
(212, 29, 6, 2, NULL, '2023-08-17 10:11:39', 0),
(213, 29, 8, 5, 'ganti judul', '2023-08-17 10:12:11', 1),
(214, 29, 8, 6, NULL, '2023-08-17 10:12:11', 1),
(215, 29, 6, 9, NULL, '2023-08-17 10:12:30', 1),
(216, 29, 6, 2, NULL, '2023-08-17 10:12:30', 0),
(217, 29, 8, 3, NULL, '2023-08-17 10:12:58', 1),
(218, 29, 8, 7, NULL, '2023-08-17 10:12:58', 1),
(219, 30, 10, 1, NULL, '2023-08-17 10:16:17', 1),
(220, 30, 10, 2, NULL, '2023-08-17 10:16:17', 0),
(221, 30, 8, 3, NULL, '2023-08-17 10:16:47', 1),
(222, 30, 10, 10, NULL, '2023-08-17 10:17:05', 1),
(223, 30, 10, 2, NULL, '2023-08-17 10:17:05', 0),
(224, 30, 8, 3, NULL, '2023-08-17 10:17:29', 1),
(225, 30, 8, 7, NULL, '2023-08-17 10:17:29', 1),
(226, 31, 10, 1, NULL, '2023-08-17 10:18:10', 1),
(227, 31, 10, 2, NULL, '2023-08-17 10:18:10', 0),
(228, 31, 8, 3, NULL, '2023-08-17 10:18:33', 1),
(229, 31, 10, 10, NULL, '2023-08-17 10:18:50', 1),
(230, 31, 10, 2, NULL, '2023-08-17 10:18:50', 0),
(231, 31, 8, 3, NULL, '2023-08-17 10:19:25', 1),
(232, 31, 8, 7, NULL, '2023-08-17 10:19:25', 1),
(233, 32, 10, 1, NULL, '2023-08-17 10:19:44', 1),
(234, 32, 10, 2, NULL, '2023-08-17 10:19:44', 0),
(235, 32, 8, 3, NULL, '2023-08-17 10:20:16', 1),
(236, 32, 10, 10, NULL, '2023-08-17 10:20:30', 1),
(237, 32, 10, 2, NULL, '2023-08-17 10:20:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `nama`, `is_active`, `created_at`, `created_by`) VALUES
(1, 'Mahasiswa', 1, '2023-08-07 15:28:39', 'System'),
(3, 'Kaprodi', 1, '2023-08-07 15:28:39', 'System'),
(4, 'Admin', 1, '2023-08-09 08:38:57', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `nama`, `deskripsi`, `is_active`) VALUES
(1, 'Submit Proposal Baru', 'Mahasiswa mensubmit proposal baru', 1),
(2, 'Menunggu Persetujuan', 'Status Pengajuan', 1),
(3, 'Pengajuan Diterima', 'Status keputusan kaprodi', 1),
(4, 'Pengajuan Ditolak', 'Status keputusan kaprodi', 1),
(5, 'Pengajuan Direvisi', 'Status keputusan kaprodi', 1),
(6, 'Menunggu Pengajuan Direvisi', 'Status Pengajuan', 1),
(7, 'Pengajuan Selesai', 'Status Pengajuan', 1),
(8, 'Merevisi Proposal', 'Mahasiswa merevisi proposal', 1),
(9, 'Merevisi LPJ', 'Mahasiswa merevisi LPJ', 1),
(10, 'Submit LPJ', 'Mahasiswa mensubmit LPJ proposal', 1),
(11, 'Pengajuan Disimpan', 'Pengajuan yang disimpan Mahasiswa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun_ajar`
--

CREATE TABLE `tbl_tahun_ajar` (
  `id` int(11) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tahun_ajar`
--

INSERT INTO `tbl_tahun_ajar` (`id`, `tahun`, `created_at`, `created_by`) VALUES
(1, '2022/2023', '2023-08-16 15:08:11', ''),
(2, '2023/2024', '2023-08-16 15:13:44', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_user` (`kd_user`),
  ADD KEY `role_fk` (`role_id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kd_kategori`),
  ADD KEY `akun_fk` (`created_by`);

--
-- Indexes for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_fk` (`proposal_id`),
  ADD KEY `akun_lpj_fk` (`created_by`);

--
-- Indexes for table `tbl_proposal`
--
ALTER TABLE `tbl_proposal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_proposal` (`kd_proposal`),
  ADD KEY `kategori_fk` (`kd_kategori`),
  ADD KEY `tahun_ajar_fk` (`tahun_ajar_id`),
  ADD KEY `status_fk` (`status_id`),
  ADD KEY `akun_proposal_fk` (`created_by`);

--
-- Indexes for table `tbl_proposal_status`
--
ALTER TABLE `tbl_proposal_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_status_fk` (`proposal_id`),
  ADD KEY `status_proposal_idx_fk` (`status_id`),
  ADD KEY `status_akun_fk` (`akun_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tahun_ajar`
--
ALTER TABLE `tbl_tahun_ajar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_proposal`
--
ALTER TABLE `tbl_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_proposal_status`
--
ALTER TABLE `tbl_proposal_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_tahun_ajar`
--
ALTER TABLE `tbl_tahun_ajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD CONSTRAINT `role_fk` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD CONSTRAINT `akun_fk` FOREIGN KEY (`created_by`) REFERENCES `tbl_akun` (`kd_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  ADD CONSTRAINT `akun_lpj_fk` FOREIGN KEY (`created_by`) REFERENCES `tbl_akun` (`kd_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proposal_fk` FOREIGN KEY (`proposal_id`) REFERENCES `tbl_proposal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_proposal`
--
ALTER TABLE `tbl_proposal`
  ADD CONSTRAINT `akun_proposal_fk` FOREIGN KEY (`created_by`) REFERENCES `tbl_akun` (`kd_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_fk` FOREIGN KEY (`kd_kategori`) REFERENCES `tbl_kategori` (`kd_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_fk` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tahun_ajar_fk` FOREIGN KEY (`tahun_ajar_id`) REFERENCES `tbl_tahun_ajar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_proposal_status`
--
ALTER TABLE `tbl_proposal_status`
  ADD CONSTRAINT `proposal_status_fk` FOREIGN KEY (`proposal_id`) REFERENCES `tbl_proposal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_akun_fk` FOREIGN KEY (`akun_id`) REFERENCES `tbl_akun` (`id`),
  ADD CONSTRAINT `status_proposal_idx_fk` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
