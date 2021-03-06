-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2019 pada 16.44
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
-- Database: `absen_psti_client`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `io_mode` int(11) NOT NULL COMMENT 'ket : tabel io mode dari server',
  `tanggal_scan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absen`, `nik`, `io_mode`, `tanggal_scan`) VALUES
(1, '197311302000031001', 0, '2019-10-09 23:00:00'),
(2, '197210191999032001', 0, '2019-10-09 23:00:00'),
(3, '199012182012121002', 0, '2019-10-09 23:00:00'),
(4, '197311302000031001', 2, '2019-10-10 04:00:00'),
(5, '197210191999032001', 2, '2019-10-10 04:01:00'),
(6, '199012182012121002', 2, '2019-10-10 04:03:00'),
(7, '197311302000031001', 1, '2019-10-10 08:00:00'),
(8, '197210191999032001', 1, '2019-10-10 08:01:00'),
(9, '199012182012121002', 1, '2019-10-10 08:03:00'),
(10, '197311302000031001', 1, '2019-10-10 15:18:08'),
(11, '197311302000031001', 3, '2019-10-10 15:35:20'),
(12, '197210191999032001', 4, '2019-10-10 15:50:08'),
(13, '197210191999032001', 5, '2019-10-10 15:51:00'),
(14, '197210191999032001', 2, '2019-10-10 15:51:51'),
(15, '197311302000031001', 2, '2019-10-10 15:53:35'),
(16, '199012182012121002', 3, '2019-10-10 16:05:28'),
(17, '198312092012121001', 1, '2019-10-16 20:24:09'),
(21, '197311302000031001', 0, '2019-10-09 23:00:00'),
(22, '197210191999032001', 0, '2019-10-09 23:00:00'),
(23, '199012182012121002', 0, '2019-10-09 23:00:00'),
(24, '197311302000031001', 2, '2019-10-10 04:00:00'),
(25, '197210191999032001', 2, '2019-10-10 04:01:00'),
(26, '199012182012121002', 2, '2019-10-10 04:03:00'),
(27, '197311302000031001', 1, '2019-10-10 08:00:00'),
(28, '197210191999032001', 1, '2019-10-10 08:01:00'),
(29, '199012182012121002', 1, '2019-10-10 08:03:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mode`
--

CREATE TABLE `mode` (
  `io_mode` tinyint(4) NOT NULL,
  `io_name` varchar(30) NOT NULL DEFAULT '',
  `icon` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mode`
--

INSERT INTO `mode` (`io_mode`, `io_name`, `icon`) VALUES
(0, 'Scan Masuk', '<i class=\"fa fa-level-down\" style=\"font-size:20px;color:blue\"></i>'),
(1, 'Scan Keluar', '<i class=\"fa fa-info-circle\" style=\"font-size:20px;color:red\"></i>'),
(2, 'Keluar Istirahat', '<i class=\"fa fa-exchange\" style=\"font-size:20px;color:blue\"></i>'),
(3, 'Kembali Istirahat', '<i class=\"fa fa-exchange\" style=\"font-size:20px;color:green\"></i>'),
(4, 'Masuk Lembur', '<i class=\"fa fa-bullseye\" style=\"font-size:20px;color:green\"></i>'),
(5, 'Keluar Lembur', '<i class=\"fa fa-bullseye\" style=\"font-size:20px;color:green\"></i>'),
(6, 'Invalid', '<i class=\"fa fa-crosshairs\" style=\"font-size:20px;color:red\"></i>'),
(7, 'Sakit', '<i class=\"fa fa-exchange\" style=\"font-size:20px;color:green\"></i>'),
(8, 'Izin', '<i class=\"fa fa-bullseye\" style=\"font-size:20px;color:green\"></i>'),
(9, 'Tanpa Keterangan', '<i class=\"fa fa-bullseye\" style=\"font-size:20px;color:green\"></i>'),
(10, 'Cuti', '<i class=\"fa fa-crosshairs\" style=\"font-size:20px;color:red\"></i>'),
(11, 'Tugas Dinas', '<i class=\"fa fa-crosshairs\" style=\"font-size:20px;color:red\"></i>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nilai` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `nik`, `date_input`, `nilai`, `keterangan`) VALUES
(1, '197210191999032001', '2019-10-17 18:08:26', 0, 'fkslfk\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(32) DEFAULT '',
  `first_name` varchar(100) DEFAULT '',
  `last_name` varchar(100) DEFAULT '',
  `gender` tinyint(4) NOT NULL DEFAULT 0,
  `alias` varchar(30) DEFAULT '',
  `jenis_user` int(1) NOT NULL COMMENT '1= admin, 2=kaprodi, 3=dosen',
  `username` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nik`, `first_name`, `last_name`, `gender`, `alias`, `jenis_user`, `username`, `password`, `deleted`, `foto`) VALUES
(3, '197311302000031001', 'Prof. I', 'Gede Pasek Suta Wijaya,  ST.,MT.,D.Eng.', 0, 'I Gede Pasek Suta Wijaya', 3, 'pasek', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(4, '197210191999032001', 'Dr.Eng. Budi', 'Irmawati, S.Kom.,MT.', 1, 'Budi Irmawati, S.Kom.,MT', 2, 'budi', '21232f297a57a5a743894a0e4a801fc3', 0, '197210191999032001.png'),
(5, '199012182012121002', 'Ario', 'Yudo Husodo, ST.,MT.', 0, 'Ario Yudo Husodo, ST.,MT', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(6, '198312092012121001', 'Andy', 'Hidayat Jatmika,ST.,M.Kom.', 0, 'Andy Hidayat Jatmika,ST.', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, '198312092012121001.png'),
(7, '198507072014042001', 'Royana', 'Afwani, ST.,MT.', 1, 'Royana Afwani, ST.,MT.', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(8, '198608132018032001', 'Nadiyasari', 'Agitha, S.Kom., M.MT.', 1, 'Nadiyasari Agitha, S.Kom', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(9, '198609132015041001', 'Ariyan', 'Zubaidi, S.Kom.,MT.', 0, 'Ariyan Zubaidi, S.Kom.,M', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, '198609132015041001.png'),
(10, '198606222015041002', 'Fitri', 'Bimantoro, ST.,M.Kom.', 0, 'Fitri Bimantoro, ST.,M.K', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(2, '196604032006042001', 'Ir.', 'Sri Endang Anjarwani, M.Kom.', 1, 'Ir. Sri Endang Anjarwani', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(1, '197005141999031002', 'Ida', 'Bagus Ketut Widiartha,  ST.,MT.', 0, 'Ida Bagus Ketut Widiarth', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, '197005141999031002.png'),
(11, '198211182015041001', 'I', 'Wayan Agus Arimbawa, ST.,M.Eng.', 0, 'I Wayan Agus Arimbawa, S', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(12, '198311252015041002', 'Moh.', 'Ali Albar, ST.,M.Eng.', 0, 'Moh. Ali Albar, ST.,M.En', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(13, '197902242005011001', 'Azwar', 'Faridi, ST', 0, 'Azwar Faridi., ST', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(15, '1000001', 'Baiq', 'Eny Mariana, SE ', 0, 'Baiq Eny Mariana, SE ', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(16, '1000002', 'Ahmad', 'Zafrullah M, ST., M.Eng.', 0, 'Ahmad Zafrullah M. ', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(17, '198409192018031001', 'Dr. Eng. IGP Wirarama', ' W W, ST., MT.', 0, 'I Gde Putu Wirarama Weda', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(18, '1000004', 'Rival', ' Biasrori, S.Kom', 0, 'Rival  Biasrori', 1, 'rival', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(19, '199402202019031004', 'Arik', 'Aranta, S.Kom., M.Kom', 0, 'Arik Aranta', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(20, '199203232019031012', 'Gibran', 'Satya Nugraha, S.Kom., M.Eng.', 0, 'Gibran Satya Nugraha', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(21, '1000004', 'Ramaditia', 'Dwiyansaputra, S.T., M.Eng.', 0, 'Ramaditia Dwiyansaputra', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(28, '00001', 'M.', 'Arif', 0, 'boy arista', 1, 'arif', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(29, '00002', 'Boy', 'Arista', 0, 'boy arista', 2, 'boy', '21232f297a57a5a743894a0e4a801fc3', 0, ''),
(30, '00003', 'Anang', 'Nugroho', 0, 'Anang Nugroho', 3, 'anang', '21232f297a57a5a743894a0e4a801fc3', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`io_mode`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
