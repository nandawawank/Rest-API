-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 31 Des 2017 pada 06.40
-- Versi Server: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ema`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dkm`
--

CREATE TABLE `dkm` (
  `id_dkm` int(11) NOT NULL,
  `uname_dkm` varchar(10) DEFAULT NULL,
  `pass_dkm` varchar(50) DEFAULT NULL,
  `alamat_dkm` text,
  `tlp_dkm` varchar(16) NOT NULL,
  `email_dkm` varchar(50) DEFAULT NULL,
  `ketua_dkm` varchar(100) DEFAULT NULL,
  `masjid_dkm` varchar(30) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dkm`
--

INSERT INTO `dkm` (`id_dkm`, `uname_dkm`, `pass_dkm`, `alamat_dkm`, `tlp_dkm`, `email_dkm`, `ketua_dkm`, `masjid_dkm`, `last_login`, `create_at`, `update_at`) VALUES
(1, 'sample_one', '$1$Dtqyvz7/$wZSaZbfHgn0UbLlVi1HHp0', 'sample_alamat', '123', 'sample@example.com', 'sample_one', 'sample_masjid', '2017-12-30 22:40:22', '2017-12-29 00:00:00', '2017-12-29 00:00:00'),
(2, 'sample_two', 'sample_two', 'sample_alamat', '123', 'sample@example.com', 'sample_ketua', 'sample_masjid', '2017-12-29 00:00:00', '2017-12-29 00:00:00', '2017-12-29 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dkm_authentication`
--

CREATE TABLE `dkm_authentication` (
  `id_auth` int(4) NOT NULL,
  `id_udkm` int(4) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dkm_authentication`
--

INSERT INTO `dkm_authentication` (`id_auth`, `id_udkm`, `token`, `expired_at`, `created_at`, `updated_at`) VALUES
(0, 1, '$1$zD53MGL0$u6WAQcGiWHGtTkUETQ/Ut.', '2017-12-31 10:40:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id_event` int(4) NOT NULL,
  `nama_event` text,
  `pemateri` varchar(100) DEFAULT NULL,
  `lokasi_event` text,
  `tlp_event` int(16) DEFAULT NULL,
  `waktu_event` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id_event`, `nama_event`, `pemateri`, `lokasi_event`, `tlp_event`, `waktu_event`) VALUES
(1, 'sample_event', 'sample_pemateri', 'sample_lokasi', 988, 'sample_waktu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dkm`
--
ALTER TABLE `dkm`
  ADD PRIMARY KEY (`id_dkm`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dkm`
--
ALTER TABLE `dkm`
  MODIFY `id_dkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
