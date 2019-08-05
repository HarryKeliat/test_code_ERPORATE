-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Agu 2019 pada 04.50
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_makanan`
--

CREATE TABLE `db_makanan` (
  `id` int(11) NOT NULL,
  `makanan` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_makanan`
--

INSERT INTO `db_makanan` (`id`, `makanan`, `harga`, `status`) VALUES
(1, 'Nasi Goreng', '15.000', 'Ready'),
(2, 'Mie Ayam', '15.000', 'Ready'),
(3, 'Mie Ayam Bakso', '18.000', 'Ready'),
(4, 'Bakso', '13.000', 'Not Ready'),
(5, 'Gado-Gado', '14.000', 'Ready'),
(6, 'Sate Ayam', '10.000', 'Not Ready'),
(7, 'Sate Kambing', '12.000', 'Not Ready'),
(8, 'Soto Ayam', '12.000', 'Ready'),
(9, 'Soto Daging', '14.000', 'Ready'),
(10, 'Lotek', '12.000', 'Not Ready');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_minuman`
--

CREATE TABLE `db_minuman` (
  `id` int(11) NOT NULL,
  `minuman` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_minuman`
--

INSERT INTO `db_minuman` (`id`, `minuman`, `harga`, `status`) VALUES
(1, 'Jeruk Es/Panas', '2.000', 'Ready'),
(2, 'Teh Es/Panas', '2.000', 'Ready'),
(3, 'Jus Alpukat', '5.000', 'Ready'),
(4, 'Juas Apel', '5.000', 'Not Ready'),
(5, 'Jus Jambu', '5.000', 'Not Ready'),
(6, 'Kopi Es/Panas', '4.000', 'Ready'),
(7, 'Wedang Ronde', '8.000', 'Not Ready'),
(8, 'Milkshake Coklat', '12.000', 'Ready'),
(9, 'Milkshake Strawberry', '12.000', 'Ready'),
(10, 'Red Velvel', '12.000', 'Not Ready');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_profil`
--

CREATE TABLE `db_profil` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('kasir','pelayan','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_profil`
--

INSERT INTO `db_profil` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Harry Keliat', 'harry', 'harry', 'kasir'),
(2, 'Herry Keliat', 'herry', 'herry', 'pelayan'),
(3, 'Admin Program', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_transaksi`
--

CREATE TABLE `db_transaksi` (
  `id` int(11) NOT NULL,
  `pemesanan` varchar(100) NOT NULL,
  `pelayan` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `nomer` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `isi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_transaksi`
--

INSERT INTO `db_transaksi` (`id`, `pemesanan`, `pelayan`, `status`, `nomer`, `nama`, `isi`) VALUES
(4, 'ERP03082019-001', 'Harry Keliat', 'Ready', '13', 'Boaz Salosa', '<p>Sate Ayam 10</p>\r\n\r\n<p>Es Jeruk 5</p>\r\n\r\n<p>Jus Alpukat 5</p>\r\n'),
(6, 'ERP03082019-001', 'Herry Keliat', 'Ready', '17', 'Bambang Pamungkas', '<p>Mie Ayam Bakso 5</p>\r\n\r\n<p>Soto Ayam 3</p>\r\n\r\n<p>Es Teh 5</p>\r\n\r\n<p>Jeruk panas 30</p>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `db_makanan`
--
ALTER TABLE `db_makanan`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `db_makanan` ADD FULLTEXT KEY `judul` (`makanan`,`harga`,`status`);

--
-- Indeks untuk tabel `db_minuman`
--
ALTER TABLE `db_minuman`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `db_minuman` ADD FULLTEXT KEY `nama` (`minuman`,`harga`,`status`);

--
-- Indeks untuk tabel `db_profil`
--
ALTER TABLE `db_profil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `db_transaksi`
--
ALTER TABLE `db_transaksi`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `db_transaksi` ADD FULLTEXT KEY `pemesanan` (`pemesanan`,`pelayan`,`nomer`,`nama`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `db_makanan`
--
ALTER TABLE `db_makanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `db_minuman`
--
ALTER TABLE `db_minuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `db_profil`
--
ALTER TABLE `db_profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `db_transaksi`
--
ALTER TABLE `db_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
