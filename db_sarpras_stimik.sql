-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2019 pada 12.43
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sarpras_stimik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_identitas`
--

CREATE TABLE `tb_identitas` (
  `id` int(11) NOT NULL,
  `logo` mediumblob NOT NULL,
  `judul` varchar(80) NOT NULL,
  `deskripsi` text NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(18) NOT NULL,
  `kodepos` varchar(6) NOT NULL,
  `web` varchar(50) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `hakcipta` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_identitas`
--

INSERT INTO `tb_identitas` (`id`, `logo`, `judul`, `deskripsi`, `instansi`, `alamat`, `telp`, `kodepos`, `web`, `mail`, `hakcipta`) VALUES
(1, 0x32303139313231323037323532327462752e706e67, 'SIM SARPRAS', 'SIM SARPRAS merupakan aplikasi untuk \r\npengolahan sarana dan prasarana pasa sebuah instansi pendidikan seperti: SD/MI, SLTP, SLTA dan Perguruan Tinggi.', 'STIMIK TUNAS BANGSA', 'Jl. Lapangan Kalisemi Indah No. 1 Parakancanggah Banjarnegara', '083154800533', '53412', 'www.stb.ac.id', 'info@stb.ac.id', 'faizincwds');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id` int(11) NOT NULL,
  `nm_level` varchar(25) NOT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`id`, `nm_level`, `level`) VALUES
(20, 'Admin', 1),
(24, 'SARPRAS', 3),
(27, 'Pimpinan', 2),
(29, 'Pembelian', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_request`
--

CREATE TABLE `tb_request` (
  `id_items` varchar(11) NOT NULL,
  `tgl_ajuan` date NOT NULL,
  `nm_pemohon` varchar(60) NOT NULL,
  `nm_items` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `sat_unit` varchar(10) NOT NULL,
  `sat_harga` varchar(10) NOT NULL,
  `total_harga` varchar(10) NOT NULL,
  `total_acc` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tgl_acc` date NOT NULL,
  `acc` int(11) NOT NULL,
  `aksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_request`
--

INSERT INTO `tb_request` (`id_items`, `tgl_ajuan`, `nm_pemohon`, `nm_items`, `kategori`, `qty`, `sat_unit`, `sat_harga`, `total_harga`, `total_acc`, `status`, `tgl_acc`, `acc`, `aksi`) VALUES
('106', '2019-11-24', 'Faizin Ahmad', 'PC SERVER', 'Komputer', '2', 'Unit', '10000000', '20000000', 1, 'MENDESAK', '0000-00-00', 2, 3),
('107', '2019-11-24', 'Faizin Ahmad', 'PRINTER CANNON', 'Elektronik', '5', 'Unit', '600000', '1200000', 2, 'NORMAL', '0000-00-00', 2, 3),
('108', '2019-11-25', 'Faizin Ahmad', 'PRINTER CANNON', 'Elektronik', '2', 'Unit', '600000', '600000', 1, 'NORMAL', '0000-00-00', 2, 3),
('110', '2019-12-02', 'Faizin Ahmad', 'TV LG', 'Elektronik', '2', 'Unit', '3000000', '6000000', 2, 'NORMAL', '0000-00-00', 2, 3),
('111', '2019-12-03', 'Faizin Ahmad', 'Radio', 'Elektronik', '2', 'Unit', '50000', '100000', 2, 'MENDESAK', '0000-00-00', 1, 0),
('112', '2019-12-03', 'Faizin Ahmad', 'Kipas Angin', 'Elektronik', '10', 'Unit', '100000', '500000', 5, 'NORMAL', '0000-00-00', 2, 3),
('114', '2019-12-08', 'Faizin Ahmad', 'Proyektor', 'Elektronik', '5', 'Unit', '5000000', '25000000', 1, 'MENDESAK', '0000-00-00', 2, 3),
('118', '2019-12-09', 'Faizin Ahmad', 'laptop', 'Elektronik', '10', 'Unit', '2000000', '12000000', 6, 'NORMAL', '0000-00-00', 2, 3),
('120', '2019-12-09', 'Faizin Ahmad', 'laptop 15\"', 'Elektronik', '6', 'Unit', '5000000', '30000000', 6, 'MENDESAK', '0000-00-00', 2, 3),
('EL485', '2019-12-14', 'Faizin Ahmad', 'Proyektor Black', 'Elektronik', '10', 'Unit', '2000000', '6000000', 3, 'MENDESAK', '0000-00-00', 2, 3),
('KO695', '2019-12-16', 'Faizin Ahmad', 'Komputer Asus', 'Komputer', '12', 'Unit', '5000000', '20000000', 4, 'MENDESAK', '0000-00-00', 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stock`
--

CREATE TABLE `tb_stock` (
  `id` int(11) NOT NULL,
  `id_stock` varchar(11) NOT NULL,
  `total_stock` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jml` int(11) NOT NULL,
  `kondisi` varchar(25) NOT NULL,
  `ket` text NOT NULL,
  `sts_kondisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_stock`
--

INSERT INTO `tb_stock` (`id`, `id_stock`, `total_stock`, `tgl`, `jml`, `kondisi`, `ket`, `sts_kondisi`) VALUES
(85, '106', 0, '2019-12-10', 1, 'hilang', '<p>asfa</p>\r\n', 1),
(86, '107', 2, '2019-12-16', 1, 'Belum diperbaiki', '<p>rusak ringan</p>\r\n', 2),
(87, '108', 1, '0000-00-00', 0, '', '', 0),
(89, '110', 2, '0000-00-00', 0, '', '', 0),
(90, '112', 5, '0000-00-00', 0, '', '', 0),
(91, '114', 1, '0000-00-00', 0, '', '', 0),
(92, '118', 6, '0000-00-00', 0, '', '', 0),
(93, '120', 6, '0000-00-00', 0, '', '', 0),
(94, 'EL485', 3, '0000-00-00', 0, '', '', 0),
(95, 'KO695', 4, '0000-00-00', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `photo` mediumblob NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `level` int(1) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `log_masuk` datetime NOT NULL,
  `log_keluar` datetime NOT NULL,
  `verif` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `photo`, `nama`, `username`, `password`, `email`, `level`, `tgl_daftar`, `log_masuk`, `log_keluar`, `verif`) VALUES
(24, '', 'MasHoki2', 'ace', '360e2ece07507675dced80ba867d6dcd', 'faizincwds@gmail.com', 4, '2019-12-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'YiVNNDAgEMDYcUwryep6N2f22zErbKS9pDOX5KLqTELHKIye5b6YbdAxdCWOziUE1HQoru9aL7j4B1w6cTIVGNV4gw1HCjCPR4Ii'),
(1, 0x3230313931323132303735323034617661746172352e706e67, 'Faizin Ahmad', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'faizincwds92@gmail.com', 3, '0000-00-00', '2019-12-16 17:15:24', '2019-12-16 17:48:01', ''),
(21, 0x323031393132313230373534313161766174617230342e706e67, 'MasHoki', 'faizincwds', 'aa5be6789de6fd2c9d7f53f79415e693', 'ace123@mail.com', 3, '2019-12-12', '2019-12-12 07:53:55', '2019-12-12 08:43:26', 'JJvzZusW1ZAwxhBIlGCdIImUCvTwav4GpZ2PJnAJvmy9LR6rrxJoScnfEAEkAnhoGDT6s1b4FD4EWOJO2JWmjXU37DyX43JB6yqr');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_stock`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_stock` (
`id` varchar(11)
,`stock_bln` date
,`nm_items` varchar(100)
,`kategori` varchar(50)
,`total_stock` int(11)
,`tgl_kondisi` date
,`jml` int(11)
,`kondisi` varchar(25)
,`ket` text
,`sts_kondisi` int(11)
,`tgl_acc` date
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_stock`
--
DROP TABLE IF EXISTS `view_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock`  AS  select `tb_stock`.`id_stock` AS `id`,`tb_request`.`tgl_ajuan` AS `stock_bln`,`tb_request`.`nm_items` AS `nm_items`,`tb_request`.`kategori` AS `kategori`,`tb_stock`.`total_stock` AS `total_stock`,`tb_stock`.`tgl` AS `tgl_kondisi`,`tb_stock`.`jml` AS `jml`,`tb_stock`.`kondisi` AS `kondisi`,`tb_stock`.`ket` AS `ket`,`tb_stock`.`sts_kondisi` AS `sts_kondisi`,`tb_request`.`tgl_acc` AS `tgl_acc` from (`tb_stock` join `tb_request`) where `tb_request`.`id_items` = `tb_stock`.`id_stock` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_identitas`
--
ALTER TABLE `tb_identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`id_items`);

--
-- Indeks untuk tabel `tb_stock`
--
ALTER TABLE `tb_stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_stock` (`id_stock`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_identitas`
--
ALTER TABLE `tb_identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_stock`
--
ALTER TABLE `tb_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
