-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 09:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah_produk` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `id_penjualan`, `id_produk`, `jumlah_produk`, `sub_total`, `id_pegawai`) VALUES
(68, 64, 19, 1, 5000, NULL),
(69, 65, 8, 1, 18000, NULL),
(70, 65, 9, 1, 15000, NULL),
(71, 65, 18, 1, 15000, NULL),
(72, 65, 19, 1, 5000, NULL),
(73, 66, 8, 1, 18000, NULL),
(74, 66, 18, 1, 15000, NULL),
(75, 67, 8, 2, 36000, NULL),
(76, 67, 18, 2, 30000, NULL),
(77, 68, 18, 1, 15000, NULL),
(78, 68, 20, 1, 20000, NULL),
(79, 69, 8, 1, 18000, NULL),
(89, 73, 8, 1, 18000, 4),
(90, 73, 18, 2, 30000, 4),
(91, 73, 20, 2, 40000, 4),
(92, 74, 9, 1, 15000, 3),
(93, 74, 18, 1, 15000, 3),
(94, 75, 8, 2, 36000, 4),
(95, 75, 18, 1, 15000, 4),
(96, 75, 20, 2, 40000, 4),
(97, 76, 18, 2, 30000, 5),
(98, 76, 20, 2, 40000, 5),
(99, 77, 8, 2, 36000, 3),
(100, 77, 19, 1, 5000, 3),
(101, 77, 20, 1, 20000, 3),
(102, 78, 9, 2, 30000, 6),
(103, 79, 9, 1, 15000, 4),
(104, 79, 18, 1, 15000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`) VALUES
(4, 'Rendy'),
(5, 'Rizki');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telpon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telpon`) VALUES
(14, 'joni', 'Jakarta', '08112233'),
(15, 'ryenndy', 'jakarta', '08123456'),
(17, 'wahyu', 'bandung', '0811223344'),
(18, 'Raka', 'Jakarta', '08126543'),
(19, 'tuan muda', 'rumah', '08111'),
(20, 'aistakim', 'Jakarta', '1234565432'),
(21, 'Zaki ', 'Malaysia', '123212321'),
(22, 'Zidan', 'rumah', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_harian`
--

CREATE TABLE `pendapatan_harian` (
  `id_pendapatan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total_pendapatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendapatan_harian`
--

INSERT INTO `pendapatan_harian` (`id_pendapatan`, `tanggal`, `total_pendapatan`) VALUES
(1, '2025-04-24', 462000),
(2, '2025-04-23', 359000),
(3, '2025-04-25', 191000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `status_pembayaran` enum('Belum Lunas','Lunas') NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal_penjualan`, `total_harga`, `id_pelanggan`, `bayar`, `kembalian`, `status_pembayaran`, `id_pegawai`) VALUES
(43, '2025-04-23', 61000, 17, 100000, 39000, 'Lunas', 0),
(44, '2025-04-23', 93000, 17, 100000, 7000, 'Lunas', 0),
(45, '2025-04-23', 5000, 14, 10000, 5000, 'Lunas', 0),
(46, '2025-04-23', 100000, 14, 150000, 50000, 'Lunas', 0),
(47, '2025-04-23', 100000, 14, 200000, 100000, 'Lunas', 0),
(56, '2025-04-24', 15000, 14, 0, 0, 'Belum Lunas', 0),
(60, '2025-04-24', 48000, 17, 50000, 2000, 'Lunas', 0),
(64, '2025-04-24', 5000, 16, 0, 0, 'Belum Lunas', 0),
(65, '2025-04-24', 53000, 14, 100000, 47000, 'Lunas', 0),
(66, '2025-04-24', 33000, 16, 100000, 67000, 'Lunas', 0),
(67, '2025-04-24', 66000, 14, 100000, 34000, 'Lunas', 0),
(68, '2025-04-24', 35000, 18, 50000, 15000, 'Lunas', 0),
(69, '2025-04-24', 18000, 14, 50000, 32000, 'Lunas', 0),
(73, '2025-04-24', 88000, 19, 100000, 12000, 'Lunas', 4),
(74, '2025-04-24', 30000, 16, 100000, 70000, 'Lunas', 3),
(75, '2025-04-24', 91000, 18, 100000, 9000, 'Lunas', 4),
(76, '2025-04-25', 70000, 16, 100000, 30000, 'Lunas', 5),
(77, '2025-04-25', 61000, 19, 100000, 39000, 'Lunas', 3),
(78, '2025-04-25', 30000, 15, 50000, 20000, 'Lunas', 6),
(79, '2025-04-25', 30000, 22, 50000, 20000, 'Lunas', 4);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stock`, `foto`) VALUES
(8, 'Nasi Padang', 18000, 18, '68094ffca16b7.jpeg'),
(9, 'Ayam Geprek', 15000, 17, '6809500c88ae7.jpg'),
(18, 'Jus Mangga', 15000, 17, '680951e06bc43.jpg'),
(19, 'Teh Manis', 5000, 19, '68095204e98c9.jpg'),
(20, 'Bubur Manado', 20000, 36, '680a00256e6d5.jpeg'),
(21, 'mie kuah', 5000, 10, '680af6ac36d5c.JPG'),
(22, 'Es Buah', 15, 20, '680b0d98c659e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','kasir','manajer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(4, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(5, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir'),
(6, 'manajer', 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'manajer'),
(14, 'rendy', 'ryenndysa887', '$2y$10$fG4./8jXf5NXdHERpfSTgeLAUFdS0XHHEQ3AL.sLQWoXVeB6DroN.', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pendapatan_harian`
--
ALTER TABLE `pendapatan_harian`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pendapatan_harian`
--
ALTER TABLE `pendapatan_harian`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
