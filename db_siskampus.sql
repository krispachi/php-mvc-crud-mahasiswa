-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2023 at 07:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siskampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `nama`) VALUES
(1, 'Teknik Informatika'),
(2, 'Paknik Informatika'),
(3, 'Minik Informatika'),
(12, 'Senior Informatika'),
(14, 'Junior Informatika'),
(18, 'Sepupu Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `jurusans_mata_kuliahs`
--

CREATE TABLE `jurusans_mata_kuliahs` (
  `id` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_mata_kuliah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusans_mata_kuliahs`
--

INSERT INTO `jurusans_mata_kuliahs` (`id`, `id_jurusan`, `id_mata_kuliah`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 3),
(5, 3, 2),
(9, 12, 1),
(10, 12, 2),
(11, 12, 3),
(15, 14, 1),
(16, 14, 2),
(35, 18, 1),
(36, 18, 3),
(37, 18, 8);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `nim`, `nama`, `alamat`, `telepon`, `id_jurusan`) VALUES
(4, '111', 'aaaaaa', 'aaa', '111', 1),
(8, '222', 'bbbaaa', 'bbb', '222', 1),
(13, '555', 'eee', 'eee', '555', 14),
(14, '666', 'fff', 'fff', '666', 2),
(16, '333', 'ccc', 'ccc', '333', 18);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliahs`
--

CREATE TABLE `mata_kuliahs` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah_sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliahs`
--

INSERT INTO `mata_kuliahs` (`id`, `kode`, `nama`, `jumlah_sks`) VALUES
(1, 'AP', 'Algoritma dan Pemrograman', 2),
(2, 'BD', 'Basis Data', 2),
(3, 'SI', 'Sistem Operasi', 2),
(8, 'DPL', 'Desain Perangkat Lunak', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas_pendaftaran') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(19, 'aa', 'aa@a.a', '$2y$10$zuNCOIAl.heau5bWoE.QI.Qlk6wHIoQitLes50l3fPlcokNL5f4CS', 'petugas_pendaftaran'),
(20, 'ddd', 'ddd@d.d', '$2y$10$nvDtBPrFiqjFxiT/mqjH7edGLF7gYjROIIJDGK5nsy4i2o5ue6v1e', NULL),
(21, 'Emeth', 'golem@gmail.com', '$2y$10$l8JXCShOFewvLE.EOCth1enUBcDAiMimrtnX96lIshRo33hJhNI3K', 'admin'),
(22, 'a', 'a@a.a', '$2y$10$7uGjgXeziXOfVxUXChRzxuWMCzhV6MBRZtic89HtxHruxFn60Ze6m', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans_mata_kuliahs`
--
ALTER TABLE `jurusans_mata_kuliahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mata_kuliah` (`id_mata_kuliah`),
  ADD KEY `jurusans_mata_kuliahs_ibfk_3` (`id_jurusan`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jurusans_mata_kuliahs`
--
ALTER TABLE `jurusans_mata_kuliahs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurusans_mata_kuliahs`
--
ALTER TABLE `jurusans_mata_kuliahs`
  ADD CONSTRAINT `jurusans_mata_kuliahs_ibfk_2` FOREIGN KEY (`id_mata_kuliah`) REFERENCES `mata_kuliahs` (`id`),
  ADD CONSTRAINT `jurusans_mata_kuliahs_ibfk_3` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD CONSTRAINT `mahasiswas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusans` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
