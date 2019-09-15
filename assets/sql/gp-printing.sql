-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Sep 2019 pada 15.25
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.31

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
-- Struktur dari tabel `detail_sample`
--

CREATE TABLE `detail_sample` (
  `id` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `desain` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_sample`
--

INSERT INTO `detail_sample` (`id`, `id_sample`, `posisi`, `desain`) VALUES
(13, 63, 'Transfer Keseluruhan', 'logo.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudang`
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
-- Dumping data untuk tabel `gudang`
--

INSERT INTO `gudang` (`id`, `id_pengerjaan`, `qty_total`, `qty_sementara`, `tgl_pengambilan`, `keterangan`, `status`) VALUES
(1, 53, 200, 200, '2019-09-09', 'masbnfkqwi', 1),
(2, 62, 4, 1, '0000-00-00', '', 0),
(3, 61, 2, 1, '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `kilo` decimal(10,3) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kilo`, `harga_beli`, `harga_jual`) VALUES
(4, 'PARABELUM', '5.000', 40000, 37000),
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
-- Struktur dari tabel `pengerjaan`
--

CREATE TABLE `pengerjaan` (
  `id` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `nomor_po` varchar(255) NOT NULL,
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
  `qty_akhir_sendiri` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `jam_kerja` int(11) NOT NULL,
  `biaya_makloon` int(11) NOT NULL,
  `meja` int(11) NOT NULL,
  `tgl_naik_barang` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengerjaan`
--

INSERT INTO `pengerjaan` (`id`, `id_sample`, `nomor_po`, `tipe`, `tgl_mulai`, `qty_sendiri`, `tgl_selesai_sendiri`, `qty_makloon`, `tgl_selesai_makloon`, `status`, `qty_awal`, `keterangan`, `qty_akhir_makloon`, `qty_akhir_sendiri`, `jumlah_orang`, `jam_kerja`, `biaya_makloon`, `meja`, `tgl_naik_barang`) VALUES
(53, 51, '', 0, '2019-09-04', 100, '2019-08-11', 0, '0000-00-00', 1, 100, '', 0, 100, 0, 0, 0, 0, NULL),
(54, 49, '', 0, '2019-09-04', 200, '2019-08-11', 0, '0000-00-00', 1, 200, '', 0, 0, 0, 0, 0, 0, NULL),
(55, 52, '', 0, '2019-09-04', 100, '2019-08-11', 0, '0000-00-00', 1, 100, '', 0, 100, 0, 0, 0, 0, NULL),
(56, 53, '', 0, '2019-09-04', 1000, '2019-08-11', 0, '0000-00-00', 1, 1000, '', 0, 0, 0, 0, 0, 0, NULL),
(58, 63, '1116027', 1, '2019-09-11', 0, '0000-00-00', 2, '2019-09-14', 0, 2, '', 0, 0, 0, 0, 12, 0, NULL),
(59, 65, '1116011', 0, '2019-09-11', 2, '2019-09-18', 0, '0000-00-00', 0, 2, '', 0, 0, 12, 12, 0, 12, NULL),
(60, 66, 'www', 0, '2019-09-12', 1, '2019-09-19', 0, '0000-00-00', 0, 1, '', 0, 0, 1, 1, 0, 1, NULL),
(61, 68, 'awd', 1, '2019-09-12', 0, '0000-00-00', 2, '2019-09-15', 1, 2, 'tes force', 1, 0, 0, 0, 2, 0, '2019-09-13'),
(62, 67, '11160111', 2, '2019-09-12', 2, '2019-09-19', 2, '2019-09-15', 0, 4, '', 0, 1, 12, 1, 12, 12, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posisi`
--

CREATE TABLE `posisi` (
  `id` int(11) NOT NULL,
  `posisi` text NOT NULL,
  `tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posisi`
--

INSERT INTO `posisi` (`id`, `posisi`, `tipe`) VALUES
(1, 'Transfer Keseluruhan', 1),
(2, 'Transfer Badan Depan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisi`
--

CREATE TABLE `revisi` (
  `id` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `id_pengerjaan` int(11) NOT NULL,
  `nomor_po` varchar(255) NOT NULL,
  `tipe` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_deadline` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status` int(11) NOT NULL,
  `qty_akhir` int(11) NOT NULL,
  `qty_awal` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `revisi`
--

INSERT INTO `revisi` (`id`, `id_sample`, `id_pengerjaan`, `nomor_po`, `tipe`, `tgl_mulai`, `tgl_deadline`, `tgl_selesai`, `status`, `qty_akhir`, `qty_awal`, `keterangan`) VALUES
(55, 69, 61, '9898283', 0, '2019-09-13', '2019-09-15', '0000-00-00', 1, 252, 250, ''),
(56, 69, 61, '9898283', 0, '2019-09-13', '2019-09-15', '0000-00-00', 1, 100, 500, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `artikel` varchar(255) NOT NULL,
  `nomor_po` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_naik_bahan` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sample`
--

INSERT INTO `sample` (`id`, `artikel`, `nomor_po`, `tgl`, `tgl_selesai`, `tgl_naik_bahan`, `status`, `biaya`) VALUES
(51, 'Dion Ganteng Artikel', '1116027', '2019-09-10', '2019-09-10', NULL, 3, 2),
(65, 'dion ahai', '1116011', '2019-09-11', '2019-09-11', NULL, 3, 2),
(67, 'awd', '11160111', '2019-09-12', '2019-09-12', NULL, 3, 2),
(68, '12awd', 'awd', '2019-09-12', '2019-09-12', '0000-00-00', 3, 2),
(69, 'awd', 'awd', '2019-09-12', '2019-09-12', '0000-00-00', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sample_obat`
--

CREATE TABLE `sample_obat` (
  `id` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sample_obat`
--

INSERT INTO `sample_obat` (`id`, `id_sample`, `qty`, `id_obat`) VALUES
(10, 63, 2, 6),
(11, 64, 2, 6),
(12, 64, 3, 7),
(13, 65, 2, 7),
(14, 65, 23, 8),
(15, 66, 2, 7),
(16, 67, 2, 4),
(17, 67, 2, 5),
(18, 67, 2, 7),
(19, 67, 2, 8),
(20, 67, 2, 9),
(21, 67, 2, 10),
(22, 67, 2, 11),
(23, 67, 2, 12),
(24, 68, 2, 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_sample`
--
ALTER TABLE `detail_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `revisi`
--
ALTER TABLE `revisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sample_obat`
--
ALTER TABLE `sample_obat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_sample`
--
ALTER TABLE `detail_sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pengerjaan`
--
ALTER TABLE `pengerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `revisi`
--
ALTER TABLE `revisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `sample_obat`
--
ALTER TABLE `sample_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
