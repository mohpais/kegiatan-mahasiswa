-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 06:39 AM
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

INSERT INTO `tbl_akun` (`id`, `kd_user`, `role_id`, `nama`, `password`, `login_attempts`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, '7201190013', 1, 'M Fardian Nopandi', '$2y$10$QzrvNGc5KDpAsaHiIw35MOoMFYQUk0Bfw64uI6YM9RgkbPfjSbBS6', 0, '2023-08-07 16:13:17', NULL, '2023-08-07 16:13:17', NULL),
(7, '14115717', 4, 'Admin', '$2y$10$QzrvNGc5KDpAsaHiIw35MOoMFYQUk0Bfw64uI6YM9RgkbPfjSbBS6', 0, '2023-08-09 08:46:06', NULL, '2023-08-09 08:46:06', NULL),
(8, '999', 3, 'Fauziyah, S.Kom., M.M.S.I', '$2y$10$QzrvNGc5KDpAsaHiIw35MOoMFYQUk0Bfw64uI6YM9RgkbPfjSbBS6', 0, '2023-08-13 12:45:13', NULL, '2023-08-13 12:45:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `jenis_kelamin` enum('Pria','Wanita') DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`nip`, `nama`, `email`, `no_telp`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('123456789', 'Fauziyah, S.Kom., M.M.S.I', 'fauziyah1220@gmail.com', NULL, 'Wanita', NULL, NULL, '2023-08-13 12:43:40', '', NULL, '');

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
('KU', 'Kuliah Umum', 1, '2023-08-13 13:04:01', 'System'),
('PPM', 'Pengabdian Pada Masyarakat', 1, '2023-08-13 13:03:47', 'System'),
('SM', 'Seminar', 1, '2023-08-13 13:03:47', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lpj`
--

CREATE TABLE `tbl_lpj` (
  `id` int(11) NOT NULL,
  `kd_proposal` varchar(20) NOT NULL,
  `link_foto` varchar(250) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lpj`
--

INSERT INTO `tbl_lpj` (`id`, `kd_proposal`, `link_foto`, `is_active`, `created_at`, `created_by`) VALUES
(2, 'SM-00001', 'http://localhost:8080/project/skripsi-nopan/index.php', 1, '2023-08-14 03:31:02', '7201190013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`nim`, `nama`, `email`, `jenis_kelamin`, `no_telp`, `tempat_lahir`, `tanggal_lahir`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('7201190013', 'M Fardian Nopandi', 'm.fardiannopandi@gmail.com', 'Pria', '0811111111', 'Tegal', '0000-00-00', '2023-08-07 15:43:24', 'System', '2023-08-07 15:43:24', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proposal`
--

CREATE TABLE `tbl_proposal` (
  `kd_proposal` varchar(20) NOT NULL,
  `status_id` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `link_dokumen` varchar(1000) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_proposal`
--

INSERT INTO `tbl_proposal` (`kd_proposal`, `status_id`, `judul`, `semester`, `tahun`, `link_dokumen`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('KU-00001', 7, 'Pengaplikasian E-Commerce pada UMKM', 'genap', '2023', 'https://drive.google.com/file/d/1zi5daZRgybpGuT7GcTTJMXbuadF2h10z/view?usp=sharing', 1, '2023-08-13 14:55:52', '7201190013', '2023-08-13 14:55:52', '7201190013'),
('PPM-00001', 4, 'Perancangan Algoritma Sistem Filter Berita Hoax Menggunakan Machine Learning', 'ganjil', '2021', 'https://drive.google.com/file/d/1zi5daZRgybpGuT7GcTTJMXbuadF2h10z/view?usp=sharing', 1, '2023-08-13 17:42:51', '7201190013', '2023-08-13 17:42:51', '7201190013'),
('SM-00001', 11, 'Pentingnya E-Learning di Era Modern', 'genap', '2022', 'https://drive.google.com/file/d/1zi5daZRgybpGuT7GcTTJMXbuadF2h10z/view?usp=sharing', 1, '2023-08-13 15:51:18', '7201190013', '2023-08-13 15:51:18', '7201190013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proposal_status`
--

CREATE TABLE `tbl_proposal_status` (
  `id` int(11) NOT NULL,
  `kd_proposal` varchar(20) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_proposal_status`
--

INSERT INTO `tbl_proposal_status` (`id`, `kd_proposal`, `akun_id`, `status_id`, `catatan`) VALUES
(3, 'KU-00001', 6, 1, NULL),
(4, 'SM-00001', 6, 1, NULL),
(5, 'KU-00001', 8, 4, NULL),
(6, 'KU-00001', 8, 4, NULL),
(7, 'KU-00001', 8, 3, NULL),
(8, 'SM-00001', 8, 3, NULL),
(9, 'SM-00001', 8, 3, NULL),
(10, 'SM-00001', 8, 3, NULL),
(11, 'KU-00001', 6, 3, NULL),
(12, 'KU-00001', 6, 3, NULL),
(13, 'KU-00001', 6, 3, NULL),
(14, 'KU-00001', 6, 3, NULL),
(15, 'PPM-00001', 6, 1, NULL),
(16, 'PPM-00001', 8, 4, NULL),
(17, 'SM-00001', 2147483647, 10, NULL);

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
(1, 'Mengajukan Proposal Baru', 'Status mahasiswa submit proposal baru', 1),
(2, 'Menunggu Persetujuan Proposal', 'Status Pengajuan', 1),
(3, 'Proposal Diterima', 'Status keputusan kaprodi', 1),
(4, 'Proposal Ditolak', 'Status keputusan kaprodi', 1),
(5, 'Proposal Direvisi', 'Status keputusan kaprodi', 1),
(6, 'Menunggu Proposal Direvisi', 'Status Pengajuan', 1),
(7, 'Proposal Selesai', 'Status Pengajuan', 1),
(10, 'Penambahan LPJ', 'Mahasiswa menambahkan LPJ untuk proposal yang sudah di Terima', 1),
(11, 'Menunggu Persetujuan LPJ', 'Status Pengajuan', 1),
(12, 'LPJ Diterima', 'Status keputusan kaprodi', 1),
(13, 'LPJ Direvisi', 'Status keputusan kaprodi', 1),
(14, 'Menunggu LPJ Direvisi', 'Status Pengajuan', 1),
(15, 'Pengajuan selesai', 'Status Pengajuan', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tbl_proposal`
--
ALTER TABLE `tbl_proposal`
  ADD PRIMARY KEY (`kd_proposal`);

--
-- Indexes for table `tbl_proposal_status`
--
ALTER TABLE `tbl_proposal_status`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_lpj`
--
ALTER TABLE `tbl_lpj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_proposal_status`
--
ALTER TABLE `tbl_proposal_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
