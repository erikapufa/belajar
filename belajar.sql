-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2025 at 06:54 PM
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
(22, 'makan', 'blabl', '2025-01-19', '2025-01-19 16:20:27', 0),
(23, 'eksklusif', 'blabl', '2025-01-21', '2025-01-21 04:01:27', 0);

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
(12, 2, 19, '22', '2025-01-20', '2025-01-20 02:40:15', 1737437161),
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
(2, 4, 'RPL', '2025-01-20 03:37:50', '2025-01-20 03:37:50', 1737601037),
(3, 3, 'TKJ', '2025-01-15 06:54:58', '2025-01-15 06:54:58', 0),
(4, 2, 'DKV', '2025-01-18 08:20:23', '2025-01-18 08:20:23', 0),
(5, 5, 'RPL', '2025-01-20 03:37:43', '2025-01-20 03:37:43', 1737601043),
(6, 2, 'pp', '2025-01-21 04:54:38', '2025-01-21 04:54:38', 1737435314),
(7, 2, 'kn', '2025-01-21 04:54:59', '2025-01-21 04:54:59', 1737435310),
(8, 3, 'RPL', '2025-01-23 02:57:38', '2025-01-23 02:57:38', 0),
(9, 7, 'MIPA', '2025-01-23 02:57:53', '2025-01-23 02:57:53', 0),
(10, 6, 'IPS', '2025-01-23 02:58:08', '2025-01-23 02:58:08', 0);

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
(7, 2, 4, '10 DKV', '2025-01-22', '2025-01-22 20:18:42', 0),
(8, 3, 3, '10 TKJ', '2025-01-22', '2025-01-22 20:19:22', 0),
(9, 7, 9, '11 MIPA', '2025-01-23', '2025-01-23 02:58:32', 0),
(10, 6, 10, '12 IPS', '2025-01-23', '2025-01-23 02:58:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_orang_tua`
--

CREATE TABLE `data_orang_tua` (
  `id` int NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `telepon_ayah` int NOT NULL,
  `telepon_ibu` int NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `nama_wali` varchar(100) NOT NULL,
  `telepon_wali` int NOT NULL,
  `pekerjaan_wali` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `informasi` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_orang_tua`
--

INSERT INTO `data_orang_tua` (`id`, `nama_ayah`, `nama_ibu`, `telepon_ayah`, `telepon_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `telepon_wali`, `pekerjaan_wali`, `alamat`, `informasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'budi', 'siti', 812, 812, 'pengusaha', 'ibu rumah tangga', 'tidak ada', 0, 'tidak ada', 'blabla', 'instagram', '2025-01-21 19:58:10', '2025-01-21 19:58:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_seragam`
--

CREATE TABLE `data_seragam` (
  `id` int NOT NULL,
  `nama_seragam` varchar(100) DEFAULT NULL,
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
(10, 'rompi', '2025-01-19', '2025-01-19 16:30:14', 0),
(11, 'coklat', '2025-01-20', '2025-01-20 02:51:11', 0),
(12, 'hahah', '2025-01-21', '2025-01-21 02:27:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nik` int NOT NULL,
  `agama` varchar(10) NOT NULL,
  `nisn` int NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` int NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_stok`
--

CREATE TABLE `data_stok` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_seragam` int NOT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_stok`
--

INSERT INTO `data_stok` (`id`, `id_tahun_pelajaran`, `id_seragam`, `ukuran`, `stok`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 2, 4, 'S', 68, '2025-01-21', '2025-01-21 06:59:07', 0);

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
(2, '2026-2027', '2025-01-01', '2026-01-01', '1', '2025-01-19 14:30:21', '2025-01-23 07:25:15', 0),
(3, '2027-2028', '2025-01-01', '2026-01-01', '1', '2025-01-15 03:39:43', '2025-01-23 07:25:32', 0),
(6, '2023-2024', '2025-01-17', '2025-01-15', '1', '2025-01-20 05:10:17', '2025-01-23 07:25:49', 0),
(7, '2024-2025', '2024-12-31', '2025-01-24', '1', '2025-01-21 05:07:06', '2025-01-23 07:26:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_awal`
--

CREATE TABLE `pendaftaran_awal` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `id_kelas` int NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_siswa` varchar(100) NOT NULL,
  `no_telepon_siswa` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `no_telepon_ayah` varchar(20) NOT NULL,
  `no_telepon_ibu` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `nama_wali` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_telepon_wali` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat_orang_tua` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sumber_informasi` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indexes for table `data_orang_tua`
--
ALTER TABLE `data_orang_tua`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_seragam`
--
ALTER TABLE `data_seragam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
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
-- Indexes for table `pendaftaran_awal`
--
ALTER TABLE `pendaftaran_awal`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `data_harga_biaya`
--
ALTER TABLE `data_harga_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_jurusan`
--
ALTER TABLE `data_jurusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_orang_tua`
--
ALTER TABLE `data_orang_tua`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_seragam`
--
ALTER TABLE `data_seragam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_stok`
--
ALTER TABLE `data_stok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendaftaran_awal`
--
ALTER TABLE `pendaftaran_awal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
