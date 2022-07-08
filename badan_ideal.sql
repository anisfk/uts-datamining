-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2022 pada 12.13
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `badan_ideal`
--

CREATE TABLE `badan_ideal` (
  `id` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `kategori` enum('Ideal','Tidak Ideal') NOT NULL,
  `hitung` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `badan_ideal`
--

INSERT INTO `badan_ideal` (`id`, `x`, `y`, `kategori`, `hitung`) VALUES
(1, 161, 55, 'Ideal', 17.029386365926),
(2, 145, 36, 'Tidak Ideal', 27.658633371879),
(3, 150, 40, 'Tidak Ideal', 22.090722034375),
(4, 158, 45, 'Tidak Ideal', 14.317821063276),
(5, 170, 70, 'Ideal', 28.071337695236),
(6, 167, 57, 'Ideal', 15.811388300842);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `badan_ideal`
--
ALTER TABLE `badan_ideal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `badan_ideal`
--
ALTER TABLE `badan_ideal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
