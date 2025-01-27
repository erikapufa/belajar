-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2025 at 02:47 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_biaya`
--

CREATE TABLE `data_biaya` (
  `id` int NOT NULL,
  `nama_biaya` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_biaya`
--

INSERT INTO `data_biaya` (`id`, `nama_biaya`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 'seragam', 'blablaba', '2025-01-19', '2025-01-19 14:14:00', 0),
(20, 'kiw', 'blablabala', '2025-01-18', '2025-01-18 04:49:32', 0),
(21, 'minum', 'blablabala', '2025-01-19', '2025-01-19 15:45:24', 0),
(22, 'makan', 'blabl', '2025-01-19', '2025-01-19 16:20:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_harga_biaya`
--

CREATE TABLE `data_harga_biaya` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_biaya` int NOT NULL,
  `harga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_harga_biaya`
--

INSERT INTO `data_harga_biaya` (`id`, `id_tahun_pelajaran`, `id_biaya`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 2, 19, '22', '2025-01-20', '2025-01-20 02:40:15', 0),
(13, 2, 20, '23', '2025-01-19', '2025-01-19 15:01:48', 0),
(14, 2, 19, '300000', '2025-01-19', '2025-01-19 15:27:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_jurusan`
--

CREATE TABLE `data_jurusan` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_jurusan`
--

INSERT INTO `data_jurusan` (`id`, `id_tahun_pelajaran`, `nama_jurusan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'DKV', '2025-01-15 03:40:06', '2025-01-15 03:40:06', 1737188372),
(2, 2, 'RPL', '2025-01-15 06:54:44', '2025-01-15 06:54:44', 0),
(3, 3, 'TKJ', '2025-01-15 06:54:58', '2025-01-15 06:54:58', 0),
(4, 2, 'DKV', '2025-01-18 08:20:23', '2025-01-18 08:20:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_kelas`
--

INSERT INTO `data_kelas` (`id`, `id_tahun_pelajaran`, `id_jurusan`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 1, '10 DKV', '2025-01-15', '2025-01-15 06:55:35', 1737187682),
(2, 0, 2, '11 RPL', '2025-01-15', '2025-01-15 06:55:50', 0),
(3, 0, 3, '10 TKJ', '2025-01-15', '2025-01-15 06:56:06', 0),
(4, 0, 2, '12 RPL', '2025-01-18', '2025-01-18 07:56:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_seragam`
--

CREATE TABLE `data_seragam` (
  `id` int NOT NULL,
  `nama_seragam` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_seragam`
--

INSERT INTO `data_seragam` (`id`, `nama_seragam`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'putih ', '2025-01-17', '2025-01-17 17:33:43', 0),
(5, 'pdh', '2025-01-17', '2025-01-17 18:29:49', 0),
(6, 'olahraga', '2025-01-17', '2025-01-17 18:54:27', 0),
(7, 'putih abu', '2025-01-17', '2025-01-17 19:12:38', 0),
(10, 'rompi', '2025-01-19', '2025-01-19 16:30:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_stok`
--

CREATE TABLE `data_stok` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_seragam` int NOT NULL,
  `ukuran` varchar(100) NOT NULL,
  `stok` int NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_stok`
--

INSERT INTO `data_stok` (`id`, `id_tahun_pelajaran`, `id_seragam`, `ukuran`, `stok`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 0, 5, 'S', 98, '2025-01-19', '2025-01-19 16:50:31', 0),
(6, 3, 6, 'M', 15, '2025-01-20', '2025-01-20 02:40:42', 0),
(7, 4, 4, 'S', 90, '2025-01-20', '2025-01-20 02:41:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_tahun_pelajaran`
--

CREATE TABLE `data_tahun_pelajaran` (
  `id` int NOT NULL,
  `nama_tahun_pelajaran` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `status_tahun_pelajaran` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_tahun_pelajaran`
--

INSERT INTO `data_tahun_pelajaran` (`id`, `nama_tahun_pelajaran`, `tanggal_mulai`, `tanggal_akhir`, `status_tahun_pelajaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2025-2026', '2025-01-15', '2026-01-15', '1', '2025-01-15 03:05:10', '2025-01-15 03:05:10', 1737189105),
(2, '2026-2027', '2025-01-01', '2026-01-01', '0', '2025-01-19 14:30:21', '2025-01-19 14:30:21', 0),
(3, '2027-2028', '2025-01-01', '2026-01-01', '1', '2025-01-15 03:39:43', '2025-01-15 03:39:43', 0),
(4, '2025/2026', '2025-01-03', '2025-01-30', '1', '2025-01-18 08:32:01', '2025-01-18 08:32:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `update_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `update_at`) VALUES
(0, 'erika', '090909', 0),
(1, 'admin', '1234', 1),
(2, 'root', '5678', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_biaya`
--
ALTER TABLE `data_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_harga_biaya`
--
ALTER TABLE `data_harga_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_jurusan`
--
ALTER TABLE `data_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_seragam`
--
ALTER TABLE `data_seragam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_stok`
--
ALTER TABLE `data_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_biaya`
--
ALTER TABLE `data_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_harga_biaya`
--
ALTER TABLE `data_harga_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_jurusan`
--
ALTER TABLE `data_jurusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_seragam`
--
ALTER TABLE `data_seragam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_stok`
--
ALTER TABLE `data_stok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
