-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 05:59 PM
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
-- Table structure for table `deposited_gudang`
--

CREATE TABLE `deposited_gudang` (
  `id` int(11) NOT NULL,
  `id_pengerjaan` int(11) NOT NULL,
  `id_revisi` int(11) NOT NULL,
  `qty_setor` int(11) NOT NULL,
  `tgl_setor` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, 6, 'BD', 'logo.jpg'),
(9, 13, 'BD', 'logo.jpg'),
(10, 14, 'BD', 'logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `id_pengerjaan` int(11) NOT NULL,
  `qty_total` int(11) NOT NULL,
  `qty_sementara` int(11) NOT NULL,
  `tgl_pengambilan` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `id_pengerjaan`, `qty_total`, `qty_sementara`, `tgl_pengambilan`, `keterangan`, `status`) VALUES
(1, 53, 200, 200, '2019-09-09', 'masbnfkqwi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `kilo` decimal(10,3) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kilo`, `harga_beli`, `harga_jual`) VALUES
(4, 'parabelum', '0.000', 40000, 37000),
(5, 'parabelum', '2.000', 40000, 50000),
(6, 'paradin', '2.000', 30000, 37000),
(7, 'parabelum', '2.000', 30000, 37000),
(8, 'parabelum', '2.000', 40000, 50000),
(9, 'parabelum', '3.000', 40000, 50000),
(10, 'parabelum', '2.000', 40000, 50000),
(11, 'parabelum', '2.500', 40000, 37000),
(12, 'PARABELUM', '2.500', 30000, 37000);

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
  `tgl_selesai_sendiri` date DEFAULT NULL,
  `qty_makloon` int(11) NOT NULL,
  `tgl_selesai_makloon` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `qty_awal` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `qty_akhir_makloon` int(11) NOT NULL,
  `qty_akhir_sendiri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengerjaan`
--

INSERT INTO `pengerjaan` (`id`, `id_sample`, `tipe`, `tgl_mulai`, `qty_sendiri`, `tgl_selesai_sendiri`, `qty_makloon`, `tgl_selesai_makloon`, `status`, `qty_awal`, `keterangan`, `qty_akhir_makloon`, `qty_akhir_sendiri`) VALUES
(53, 51, 0, '2019-09-04', 100, '2019-08-11', 0, '0000-00-00', 1, 100, '', 0, 100),
(54, 49, 0, '2019-09-04', 200, '2019-08-11', 0, '0000-00-00', 1, 200, '', 0, 0),
(55, 52, 0, '2019-09-04', 100, '2019-08-11', 0, '0000-00-00', 1, 100, '', 0, 100),
(56, 53, 0, '2019-09-04', 1000, '2019-08-11', 0, '0000-00-00', 1, 1000, '', 0, 0);

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

--
-- Dumping data for table `revisi`
--

INSERT INTO `revisi` (`id`, `id_sample`, `id_pengerjaan`, `tipe`, `tgl_mulai`, `tgl_selesai`, `status`, `qty_akhir`, `qty_awal`, `keterangan`) VALUES
(30, 48, 51, 0, '2019-09-04', '2019-08-06', 2, 6, 6, ''),
(31, 50, 52, 0, '2019-09-04', '2019-08-06', 2, 10, 4, ''),
(32, 49, 54, 0, '2019-09-04', '2019-08-06', 2, 175, 175, ''),
(33, 53, 56, 0, '2019-09-04', '2019-08-06', 2, 950, 950, '');

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `id_pelanggan`, `tgl`, `status`, `biaya`) VALUES
(47, 1, '2019-09-04', 2, 90000),
(48, 2, '2019-09-04', 2, 800),
(49, 1, '2019-09-04', 2, 90),
(50, 2, '2019-09-04', 2, 10),
(51, 1, '2019-09-04', 2, 1890),
(52, 2, '2019-09-04', 2, 1900),
(53, 2, '2019-09-04', 2, 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_sample`
--
ALTER TABLE `detail_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `revisi`
--
ALTER TABLE `revisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
