-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 12:25 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

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
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `io_mode` int(11) NOT NULL COMMENT 'ket : tabel io mode dari server',
  `tanggal_scan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `nik`, `io_mode`, `tanggal_scan`) VALUES
(1, '197311302000031001', 0, '2019-09-01 14:00:00'),
(2, '197210191999032001', 0, '2019-09-02 14:00:00'),
(3, '199012182012121002', 0, '2019-09-03 14:00:00'),
(4, '197311302000031001', 2, '2019-09-04 19:00:00'),
(5, '197210191999032001', 2, '2019-09-05 19:01:00'),
(6, '199012182012121002', 2, '2019-09-06 19:03:00'),
(7, '197311302000031001', 1, '2019-09-07 23:00:00'),
(8, '197210191999032001', 1, '2019-09-08 23:01:00'),
(9, '199012182012121002', 1, '2019-09-09 23:03:00'),
(10, '197311302000031001', 0, '2019-09-01 14:00:00'),
(11, '197210191999032001', 0, '2019-09-02 14:00:00'),
(12, '199012182012121002', 0, '2019-09-03 14:00:00'),
(13, '197311302000031001', 2, '2019-09-04 19:00:00'),
(14, '197210191999032001', 2, '2019-09-05 19:01:00'),
(15, '199012182012121002', 2, '2019-09-06 19:03:00'),
(16, '197311302000031001', 1, '2019-09-07 23:00:00'),
(17, '197210191999032001', 1, '2019-09-08 23:01:00'),
(18, '199012182012121002', 1, '2019-09-09 23:03:00'),
(19, '197210191999032001', 0, '2019-10-06 17:38:53'),
(20, '198507072014042001', 1, '2019-10-06 17:41:43'),
(21, '198609132015041001', 0, '2019-10-06 17:42:24'),
(22, '197210191999032001', 2, '2019-10-06 17:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE `mode` (
  `io_mode` tinyint(4) NOT NULL,
  `io_name` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`io_mode`, `io_name`) VALUES
(0, 'Scan Masuk'),
(1, 'Scan Keluar'),
(2, 'Keluar Istirahat'),
(3, 'Kembali Istirahat'),
(4, 'Masuk Lembur'),
(5, 'Keluar Lembur'),
(6, 'Invalid');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
  `deleted` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nik`, `first_name`, `last_name`, `gender`, `alias`, `jenis_user`, `username`, `password`, `deleted`) VALUES
(3, '197311302000031001', 'Prof. I', 'Gede Pasek Suta Wijaya,  ST.,MT.,D.Eng.', 0, 'I Gede Pasek Suta Wijaya', 3, 'pasek', '21232f297a57a5a743894a0e4a801fc3', 0),
(4, '197210191999032001', 'Dr.Eng. Budi', 'Irmawati, S.Kom.,MT.', 1, 'Budi Irmawati, S.Kom.,MT', 2, 'budi', '21232f297a57a5a743894a0e4a801fc3', 0),
(5, '199012182012121002', 'Ario', 'Yudo Husodo, ST.,MT.', 0, 'Ario Yudo Husodo, ST.,MT', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(6, '198312092012121001', 'Andy', 'Hidayat Jatmika,ST.,M.Kom.', 0, 'Andy Hidayat Jatmika,ST.', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(7, '198507072014042001', 'Royana', 'Afwani, ST.,MT.', 1, 'Royana Afwani, ST.,MT.', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(8, '198608132018032001', 'Nadiyasari', 'Agitha, S.Kom., M.MT.', 1, 'Nadiyasari Agitha, S.Kom', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(9, '198609132015041001', 'Ariyan', 'Zubaidi, S.Kom.,MT.', 0, 'Ariyan Zubaidi, S.Kom.,M', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(10, '198606222015041002', 'Fitri', 'Bimantoro, ST.,M.Kom.', 0, 'Fitri Bimantoro, ST.,M.K', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, '196604032006042001', 'Ir.', 'Sri Endang Anjarwani, M.Kom.', 1, 'Ir. Sri Endang Anjarwani', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(1, '197005141999031002', 'Ida', 'Bagus Ketut Widiartha,  ST.,MT.', 0, 'Ida Bagus Ketut Widiarth', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(11, '198211182015041001', 'I', 'Wayan Agus Arimbawa, ST.,M.Eng.', 0, 'I Wayan Agus Arimbawa, S', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(12, '198311252015041002', 'Moh.', 'Ali Albar, ST.,M.Eng.', 0, 'Moh. Ali Albar, ST.,M.En', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(13, '197902242005011001', 'Azwar', 'Faridi, ST', 0, 'Azwar Faridi., ST', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(15, '-', 'Baiq', 'Eny Mariana, SE ', 0, 'Baiq Eny Mariana, SE ', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(16, '-', 'Ahmad', 'Zafrullah M, ST., M.Eng.', 0, 'Ahmad Zafrullah M. ', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(17, '198409192018031001', 'Dr. Eng. IGP Wirarama', ' W W, ST., MT.', 0, 'I Gde Putu Wirarama Weda', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(18, '-', 'Rival', ' Biasrori, S.Kom', 0, 'Rival  Biasrori', 1, 'rival', '21232f297a57a5a743894a0e4a801fc3', 0),
(19, '199402202019031004', 'Arik', 'Aranta, S.Kom., M.Kom', 0, 'Arik Aranta', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(20, '199203232019031012', 'Gibran', 'Satya Nugraha, S.Kom., M.Eng.', 0, 'Gibran Satya Nugraha', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(21, '-', 'Ramaditia', 'Dwiyansaputra, S.T., M.Eng.', 0, 'Ramaditia Dwiyansaputra', 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`io_mode`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
