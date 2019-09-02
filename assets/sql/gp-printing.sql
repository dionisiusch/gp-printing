-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2019 at 03:01 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gp-printing`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_sample`
--

CREATE TABLE `detail_sample` (
  `id` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `desain` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_sample`
--

INSERT INTO `detail_sample` (`id`, `id_sample`, `lokasi`, `desain`) VALUES
(1, 1, 'BD', 'logo.jpg'),
(2, 2, 'BB', 'logo.jpg'),
(3, 2, 'LKI', 'logo.jpg'),
(4, 3, 'BD', 'logo.jpg'),
(5, 3, 'LKA', 'logo.jpg'),
(6, 4, 'BD', 'logo.jpg'),
(7, 5, 'BB', 'logo.jpg'),
(8, 6, 'BD', 'logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `no_telepon`) VALUES
(1, 'Dion', 'Dago', '0821212'),
(2, 'Nathan', 'Arcamanik', '00099890');

-- --------------------------------------------------------

--
-- Table structure for table `pengerjaan`
--

CREATE TABLE `pengerjaan` (
  `id` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `tipe` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `qty_sendiri` int(11) NOT NULL,
  `tgl_selesai_sendiri` date NOT NULL,
  `qty_makloon` int(11) NOT NULL,
  `tgl_selesai_makloon` date NOT NULL,
  `status` int(11) NOT NULL,
  `qty_akhir` int(11) NOT NULL,
  `qty_awal` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengerjaan`
--

INSERT INTO `pengerjaan` (`id`, `id_sample`, `tipe`, `tgl_mulai`, `qty_sendiri`, `tgl_selesai_sendiri`, `qty_makloon`, `tgl_selesai_makloon`, `status`, `qty_akhir`, `qty_awal`, `keterangan`) VALUES
(13, 11, 0, '2019-09-02', 10, '2019-08-09', 0, '0000-00-00', 0, 0, 20, ''),
(14, 12, 2, '2019-09-02', 10, '2019-08-09', 100, '2019-08-05', 0, 0, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `revisi`
--

CREATE TABLE `revisi` (
  `id` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `id_pengerjaan` int(11) NOT NULL,
  `tipe` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status` int(11) NOT NULL,
  `qty_akhir` int(11) NOT NULL,
  `qty_awal` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `biaya` int(11) NOT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `id_pelanggan`, `tgl`, `status`, `biaya`, `deadline`) VALUES
(11, 1, '2019-09-02', 1, 100000, NULL),
(12, 2, '2019-09-02', 1, 50000, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_sample`
--
ALTER TABLE `detail_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisi`
--
ALTER TABLE `revisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_sample`
--
ALTER TABLE `detail_sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `revisi`
--
ALTER TABLE `revisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
