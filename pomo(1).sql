-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2019 at 03:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pomo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '1',
  `status` enum('Walikelas','Administrator','Guru') DEFAULT 'Administrator',
  `login_terakhir` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `login_status` enum('N','Y') DEFAULT 'N',
  `ip` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`, `nama`, `level`, `status`, `login_terakhir`, `login_status`, `ip`) VALUES
('Admin', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', 'Admin', 1, 'Administrator', '2019-03-07 13:43:49', 'Y', '::1'),
('Sumardiyono', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', 'sumardiyono', 1, 'Guru', '2019-03-04 15:33:49', 'N', ''),
('Diyah', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', 'Diyah Pusparini', 1, 'Walikelas', NULL, 'N', ''),
('Rini', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', 'Rini Ratnaningsih', 1, 'Administrator', '2019-03-04 16:36:13', 'N', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_agama`
--

CREATE TABLE `tb_agama` (
  `agama_id` int(2) NOT NULL,
  `nama_agama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_agama`
--

INSERT INTO `tb_agama` (`agama_id`, `nama_agama`) VALUES
(0, ''),
(1, 'Islam'),
(2, 'Kristen'),
(3, 'Katholik'),
(4, 'Hindu'),
(5, 'Budha'),
(6, 'Kong Hu Chu'),
(7, 'Kepercayaan kpd Tuhan YME'),
(99, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kd_kelas` varchar(8) NOT NULL,
  `nama_kelas` varchar(12) NOT NULL,
  `kd_prodi` varchar(8) NOT NULL,
  `tingkat` int(2) NOT NULL,
  `siswa` int(2) NOT NULL,
  `maksi` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kd_kelas`, `nama_kelas`, `kd_prodi`, `tingkat`, `siswa`, `maksi`) VALUES
('12A5', 'XII MIPA 5', 'MIPA', 12, 36, 38),
('12A4', 'XII MIPA 4', 'MIPA', 12, 36, 38),
('12A3', 'XII MIPA 3', 'MIPA', 12, 36, 38),
('12A2', 'XII MIPA 2', 'MIPA', 12, 36, 38),
('12A1', 'XII MIPA 1', 'MIPA', 12, 36, 38),
('11S2', 'XI IPS 2', 'IPS', 10, 36, 38),
('11B1', 'XI BHS', 'MIPA', 11, 33, 38),
('11S1', 'XI IPS 1', 'IPS', 11, 36, 38),
('11A5', 'XI MIPA 5', 'MIPA', 11, 36, 38),
('11A4', 'XI MIPA 4', 'MIPA', 11, 36, 38),
('11A3', 'XI MIPA 3', 'MIPA', 11, 36, 38),
('11A2', 'XI MIPA 2', 'MIPA', 11, 36, 38),
('11A1', 'XI MIPA 1', 'MIPA', 11, 36, 38),
('10B1', 'X BHS', 'Bahasa', 10, 31, 36),
('10S4', 'X IPS 4', 'IPS', 10, 28, 36),
('10S3', 'X IPS 3', 'IPS', 10, 28, 36),
('10S2', 'X IPS 2', 'IPS', 10, 28, 36),
('10S1', 'X IPS 1', 'IPS', 10, 28, 36),
('10A5', 'X MIPA 5', 'MIPA', 10, 35, 40),
('10A4', 'X MIPA 4', 'MIPA', 10, 35, 40),
('10A3', 'X MIPA 3', 'MIPA', 10, 36, 40),
('10A2', 'X MIPA 2', 'MIPA', 10, 34, 40),
('10A1', 'X MIPA 1', 'MIPA', 10, 39, 40),
('11S3', 'XI IPS 3', 'IPS', 10, 28, 36),
('11S4', 'XI IPS  4', 'IPS', 10, 28, 36),
('12S1', 'XII IPS 1', 'IPS', 12, 35, 40),
('12S2', 'XII IPS 2', 'IPS', 12, 38, 40),
('12S3', 'XII IPS 3', 'IPS', 12, 37, 40),
('12B1', 'Bahasa 1', 'Bahasa', 12, 35, 40),
('12B2', 'Bahasa 2', 'Bahasa', 12, 34, 40);

-- --------------------------------------------------------

--
-- Table structure for table `tb_langgar`
--

CREATE TABLE `tb_langgar` (
  `no` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `induk` varchar(8) NOT NULL,
  `masalah` text NOT NULL,
  `skor_poin` varchar(8) NOT NULL,
  `oleh` varchar(80) NOT NULL,
  `solusi` text NOT NULL,
  `statusL` enum('B','S','P') NOT NULL DEFAULT 'B',
  `tangani` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_langgar`
--

INSERT INTO `tb_langgar` (`no`, `tanggal`, `induk`, `masalah`, `skor_poin`, `oleh`, `solusi`, `statusL`, `tangani`) VALUES
(21, '2019-03-04 16:05:39', '8274', 'Tidak Memasukkan baju dengan rapi', '15', 'Diyah', 'peringatan', 'S', '2019-03-04'),
(22, '2019-03-04 20:51:31', '8274', 'Membuat gaduh dikelas saat pelajaran', '15', 'Sumardiyono', 'peringatan', 'P', '2019-03-04'),
(23, '2019-03-05 11:04:51', '8274', 'Peserta didik tidak mengikuti kegiatan upacara', '10', 'Diyah', 'Teguran', 'S', '2019-03-05'),
(27, '2019-03-05 22:38:45', '9259', 'Tidak bersedia ditunjuk sebagai petugas upacara', '5', 'Rini', 'Teguran', 'B', '2019-03-05'),
(28, '2019-03-05 23:12:21', '9260', 'Petugas melakukan kesalahan dalam melaksanakan tugas pada saat upacara', '6', 'diyah', 'peringatan', 'B', '2019-03-05'),
(29, '2019-03-06 00:41:23', '9254', 'Piket kelas yang tidak melapor ke guru piket  setelah 5 (lima) menit jam pelajaran berlangsung, dimana guru mata pelajaran yang bersangkutan belum hadir', '5', 'sumardiyono', 'Teguran', 'B', '2019-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `no_login` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `user` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ip` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`no_login`, `tanggal`, `user`, `password`, `ip`, `status`) VALUES
(1, '2018-06-08 08:01:21', 'Admin', '1234567', '::1', 'sukses'),
(2, '2018-06-08 08:44:51', 'Admin', '1234567', '::1', 'sukses'),
(3, '2018-06-08 10:29:22', '21805011240027', '12345678', '::1', 'sukses'),
(4, '2018-06-08 10:59:30', 'Admin', '1234567', '::1', 'sukses'),
(5, '2018-06-08 16:18:36', 'Admin', '1234567', '::1', 'sukses'),
(6, '2018-06-08 16:48:45', 'Admin', '1234567', '::1', 'sukses'),
(7, '2018-06-08 17:16:01', '21605011121467', '1234567', '::1', 'Gagal'),
(8, '2018-06-08 17:16:13', '21605011121467', '12345678', '::1', 'Gagal'),
(9, '2018-06-08 17:16:56', '21605011121467', '1234567', '::1', 'Gagal'),
(10, '2018-06-08 17:19:08', '21605011121467', '12345678', '::1', 'Gagal'),
(11, '2018-06-08 17:19:27', '21605011121467', '1234567', '::1', 'sukses'),
(12, '2018-06-08 19:15:36', 'Admin', '1234567', '::1', 'sukses'),
(13, '2018-06-08 21:35:58', 'Admin', '1234567', '::1', 'sukses'),
(14, '2018-06-09 07:59:42', 'Admin', '1234567', '::1', 'sukses'),
(15, '2018-06-09 15:29:20', '21605011972614', '1234567', '::1', 'sukses'),
(16, '2018-06-09 15:33:18', 'Admin', '1234567', '::1', 'sukses'),
(17, '2018-06-09 16:42:18', 'Admin', '1234567', '::1', 'sukses'),
(18, '2018-06-09 17:52:03', '21605011972614', '1234567', '::1', 'sukses'),
(19, '2018-06-10 07:24:52', 'Admin', '1234567', '::1', 'sukses'),
(20, '2018-06-10 09:10:09', '21605011972614', '1234567', '::1', 'sukses'),
(21, '2018-06-10 10:02:38', 'Admin', '1234567', '::1', 'sukses'),
(22, '2018-06-10 18:45:29', 'Admin', '1234567', '::1', 'sukses'),
(23, '2018-06-10 23:20:46', '21605011972614', '1234567', '::1', 'sukses'),
(24, '2018-06-11 08:51:58', 'Admin', '1234567', '::1', 'sukses'),
(25, '2018-06-11 09:54:21', '21605011972614', '1234567', '::1', 'sukses'),
(26, '2018-06-11 09:55:24', 'Admin', '1234567', '::1', 'sukses'),
(27, '2018-06-11 17:55:06', '21605011972614', '1234567', '::1', 'sukses'),
(28, '2018-06-11 18:33:23', 'Admin', '1234567', '::1', 'sukses'),
(29, '2018-06-11 19:04:13', '21605011972614', '1234567', '::1', 'sukses'),
(30, '2018-06-11 19:35:02', 'Admin', '1234567', '::1', 'sukses'),
(31, '2018-06-12 09:36:03', 'Admin', '1234567', '::1', 'sukses'),
(32, '2018-06-12 18:10:05', 'Admin', '1234567', '::1', 'sukses'),
(33, '2018-06-12 22:01:01', 'Admin', '1234567', '::1', 'sukses'),
(34, '2018-06-13 06:24:02', 'Admin', '1234567', '::1', 'sukses'),
(35, '2018-06-13 21:16:51', 'Admin', '1234567', '::1', 'sukses'),
(36, '2018-06-14 08:58:57', 'Admin', '1234567', '::1', 'sukses'),
(37, '2018-06-14 12:02:48', 'Admin', '1234567', '::1', 'sukses'),
(38, '2018-06-14 19:28:10', 'Admin', '1234567', '::1', 'sukses'),
(39, '2018-06-15 09:25:32', 'G-02', '1234567', '::1', 'sukses'),
(40, '2018-06-15 11:16:16', 'G-02', '1234567', '::1', 'sukses'),
(41, '2018-06-15 17:56:58', 'Admin', '1234567', '::1', 'sukses'),
(42, '2018-06-15 18:28:49', 'G-02', '1234567', '::1', 'sukses'),
(43, '2018-06-15 19:20:44', 'Admin', '1234567', '::1', 'sukses'),
(44, '2018-06-15 19:57:45', 'G-02', '1234567', '::1', 'sukses'),
(45, '2018-06-15 21:54:59', '21605011972614', '1234567', '::1', 'sukses'),
(46, '2018-06-16 07:22:46', 'Admin', '1234567', '::1', 'sukses'),
(47, '2018-06-16 16:58:53', 'Admin', '1234567', '::1', 'sukses'),
(48, '2018-06-16 18:14:41', 'Admin', '1234567', '::1', 'sukses'),
(49, '2018-06-16 18:40:50', 'Admin', '1234567', '::1', 'sukses'),
(50, '2018-06-17 07:48:57', 'Admin', '1234567', '::1', 'sukses'),
(51, '2018-06-17 07:50:56', 'Admin', '1234567', '::1', 'sukses'),
(52, '2018-06-17 07:58:42', 'Admin', '1234567', '::1', 'sukses'),
(53, '2018-06-17 08:20:25', 'Admin', '1234567', '::1', 'sukses'),
(54, '2018-06-17 08:34:13', 'Admin', '1234567', '::1', 'sukses'),
(55, '2018-12-10 17:19:33', 'Admin', '1234567', '::1', 'sukses'),
(56, '2018-12-10 20:59:00', '0013211078', '1234567', '::1', 'Gagal'),
(57, '2018-12-10 20:59:37', '21605010011094', '1234567', '::1', 'sukses'),
(58, '2018-12-10 21:46:07', 'Admin', '1234567', '::1', 'sukses'),
(59, '2018-12-11 00:52:49', 'Admin', '1234567', '::1', 'sukses'),
(60, '2018-12-11 00:53:59', '21605010011094', '1234567', '::1', 'sukses'),
(61, '2018-12-11 01:12:00', '21605011860792', '1234567', '::1', 'sukses'),
(62, '2018-12-11 01:14:44', 'Admin', '1234567', '::1', 'sukses'),
(63, '2018-12-11 16:49:46', 'Admin', '1234567', '::1', 'sukses'),
(64, '2018-12-11 20:14:32', 'Admin', '1234567', '::1', 'sukses'),
(65, '2018-12-12 12:01:30', 'Admin', '1234567', '::1', 'sukses'),
(66, '2018-12-14 04:36:08', 'Admin', '1234567', '::1', 'sukses'),
(67, '2018-12-14 10:30:07', 'Admin', '1234567', '::1', 'sukses'),
(68, '2018-12-14 20:41:36', 'Admin', '1234567', '::1', 'sukses'),
(69, '2018-12-14 22:48:37', '21605011121467', '1234567', '::1', 'sukses'),
(70, '2018-12-14 23:16:54', 'Admin', '1234567', '::1', 'sukses'),
(71, '2018-12-14 23:24:09', '21605010011094', '1234567', '::1', 'sukses'),
(72, '2018-12-14 23:27:07', '21605011121467', '1234567', '::1', 'sukses'),
(73, '2018-12-14 23:32:59', '0007591337', '1234567', '::1', 'sukses'),
(74, '2018-12-14 23:35:41', 'Admin', '1234567', '::1', 'sukses'),
(75, '2018-12-14 23:49:14', 'Admin', '1234567', '::1', 'sukses'),
(76, '2018-12-15 00:38:32', '0007591337', '1234567', '::1', 'sukses'),
(77, '2018-12-15 00:39:39', 'Admin', '1234567', '::1', 'sukses'),
(78, '2018-12-15 00:48:57', 'Admin', '1234567', '::1', 'sukses'),
(79, '2018-12-15 20:36:22', 'Admin', '1234567', '::1', 'sukses'),
(80, '2018-12-15 21:34:17', 'Admin', '1234567', '::1', 'sukses'),
(81, '2018-12-16 09:46:27', 'Admin', '1234567', '::1', 'sukses'),
(82, '2018-12-16 23:14:32', 'Admin', '1234567', '::1', 'sukses'),
(83, '2019-01-24 17:39:01', 'Admin', '1234567', '::1', 'sukses'),
(84, '2019-01-24 17:54:59', 'Admin', '1234567', '::1', 'sukses'),
(85, '2019-01-24 18:03:53', 'Admin', '1234567', '::1', 'sukses'),
(86, '2019-01-24 18:07:46', 'Admin', '1234567', '::1', 'sukses'),
(87, '2019-01-24 18:09:56', 'Admin', '1234567', '::1', 'sukses'),
(88, '2019-01-24 18:14:22', 'Admin', '1234567', '::1', 'sukses'),
(89, '2019-01-24 18:19:05', 'Admin', '1234567', '::1', 'sukses'),
(90, '2019-01-25 15:51:14', 'Admin', '1234567', '::1', 'sukses'),
(91, '2019-01-27 14:44:05', 'Admin', '1234567', '::1', 'sukses'),
(92, '2019-01-27 21:51:54', 'Admin', '1234567', '::1', 'sukses'),
(93, '2019-01-28 00:57:26', 'G_01', '1234567', '::1', 'sukses'),
(94, '2019-01-28 01:04:48', 'Admin', '1234567', '::1', 'sukses'),
(95, '2019-01-28 01:06:12', 'G_01', '1234567', '::1', 'sukses'),
(96, '2019-01-28 01:08:50', 'Admin', '1234567', '::1', 'sukses'),
(97, '2019-01-28 03:10:46', 'Admin', '1234567', '::1', 'sukses'),
(98, '2019-01-28 03:16:59', 'G-01', '1234567', '::1', 'Gagal'),
(99, '2019-01-28 03:17:55', 'G-01', '1234567', '::1', 'Gagal'),
(100, '2019-01-28 03:19:18', 'G_01', '1234567', '::1', 'sukses'),
(101, '2019-01-28 03:21:53', 'G_01', '1234567', '::1', 'sukses'),
(102, '2019-01-28 03:23:33', 'Admin', '1234567', '::1', 'sukses'),
(103, '2019-01-28 03:31:18', 'G_01', '1234567', '::1', 'sukses'),
(104, '2019-01-28 03:32:56', 'Admin', '1234567', '::1', 'sukses'),
(105, '2019-01-28 03:35:47', 'G_01', '1234567', '::1', 'sukses'),
(106, '2019-01-28 03:37:06', 'Admin', '1234567', '::1', 'sukses'),
(107, '2019-01-28 03:51:16', 'Admin', '1234567', '::1', 'sukses'),
(108, '2019-01-28 17:44:18', '0007591337', '1234567', '127.0.0.1', 'sukses'),
(109, '2019-01-28 18:16:35', 'G_01', '1234567', '127.0.0.1', 'sukses'),
(110, '2019-01-28 18:53:24', 'Admin', '1234567', '::1', 'sukses'),
(111, '2019-01-28 18:54:55', 'Admin', '1234567', '::1', 'sukses'),
(112, '2019-01-28 18:57:13', 'Admin', '1234567', '::1', 'sukses'),
(113, '2019-01-28 19:06:33', 'G_01', '1234567', '::1', 'sukses'),
(114, '2019-01-28 19:07:31', 'Admin', '1234567', '::1', 'sukses'),
(115, '2019-01-28 19:08:34', 'Admin', '1234567', '::1', 'sukses'),
(116, '2019-01-28 19:23:34', 'Admin', '1234567', '::1', 'sukses'),
(117, '2019-01-28 19:28:40', 'G_01', '12334567', '::1', 'Gagal'),
(118, '2019-01-28 19:29:03', 'G_01', '1234567', '::1', 'sukses'),
(119, '2019-01-28 19:30:24', 'Admin', '1234567', '::1', 'sukses'),
(120, '2019-01-28 21:50:57', 'Admin', '1234567', '::1', 'sukses'),
(121, '2019-01-28 21:51:59', '0007591337', '1234567', '::1', 'sukses'),
(122, '2019-01-28 21:58:58', 'G_01', '1234567', '::1', 'sukses'),
(123, '2019-01-28 22:12:45', 'Admin', '1234567', '::1', 'sukses'),
(124, '2019-02-01 14:54:12', 'Admin', '1234567', '::1', 'sukses'),
(125, '2019-02-02 10:57:28', '0007591337', '1234567', '::1', 'sukses'),
(126, '2019-02-02 15:13:37', 'Admin', '1234567', '::1', 'sukses'),
(127, '2019-02-02 23:41:37', 'Admin', '1234567', '::1', 'sukses'),
(128, '2019-02-03 13:15:48', 'Admin', '1234567', '::1', 'sukses'),
(129, '2019-02-03 17:09:10', 'Admin', '1234567', '::1', 'sukses'),
(130, '2019-02-03 20:29:43', '0007591337', '1234567', '::1', 'sukses'),
(131, '2019-02-05 12:19:44', 'Admin', '1234567', '::1', 'sukses'),
(132, '2019-02-08 02:56:49', 'Admin', '1234567', '::1', 'sukses'),
(133, '2019-02-08 10:40:43', 'Admin', '1234567', '::1', 'sukses'),
(134, '2019-02-08 14:28:39', 'Admin', '1234567', '::1', 'sukses'),
(135, '2019-02-08 16:28:48', 'Admin', '1234567', '::1', 'sukses'),
(136, '2019-02-09 22:29:37', 'Admin', '1234567', '::1', 'sukses'),
(137, '2019-02-11 00:32:55', 'Admin', '1234567', '::1', 'sukses'),
(138, '2019-02-11 00:32:55', 'Admin', '1234567', '::1', 'sukses'),
(139, '2019-02-11 00:32:55', 'Admin', '1234567', '::1', 'sukses'),
(140, '2019-02-11 02:19:34', '0007591337', '1234567', '::1', 'sukses'),
(141, '2019-02-11 14:06:31', '0007591337', '1234567', '::1', 'sukses'),
(142, '2019-02-11 14:06:31', '0007591337', '1234567', '::1', 'sukses'),
(143, '2019-02-11 14:06:31', '0007591337', '1234567', '::1', 'sukses'),
(144, '2019-02-11 14:49:44', 'Admin', '1234567', '::1', 'sukses'),
(145, '2019-02-11 17:24:35', 'Admin', '1234567', '::1', 'sukses'),
(146, '2019-02-11 17:24:35', 'Admin', '1234567', '::1', 'sukses'),
(147, '2019-02-11 20:45:16', '0007591337', '1234567', '::1', 'sukses'),
(148, '2019-02-11 20:45:16', '0007591337', '1234567', '::1', 'sukses'),
(149, '2019-02-11 21:03:29', 'Admin', '1234567', '::1', 'sukses'),
(150, '2019-02-12 09:48:28', 'Admin', '1234567', '127.0.0.1', 'sukses'),
(151, '2019-02-12 20:21:41', 'Admin', '1234567', '::1', 'sukses'),
(152, '2019-02-14 06:20:55', 'Admin', '1234567', '::1', 'sukses'),
(153, '2019-02-14 12:43:07', 'Admin', '1234567', '::1', 'sukses'),
(154, '2019-02-15 19:16:28', 'Admin', '1234567', '::1', 'sukses'),
(155, '2019-02-15 22:22:28', 'Admin', '1234567', '::1', 'sukses'),
(156, '2019-02-16 03:01:34', 'Admin', '1234567', '::1', 'sukses'),
(157, '2019-02-16 11:01:38', 'Admin', '1234567', '::1', 'sukses'),
(158, '2019-02-16 15:32:35', '0007591337', '1234567', '::1', 'sukses'),
(159, '2019-02-16 15:36:13', 'Admin', '1234567', '::1', 'sukses'),
(160, '2019-02-16 16:04:09', 'G_01', '1234567', '::1', 'sukses'),
(161, '2019-02-16 16:05:49', 'Admin', '1234567', '::1', 'sukses'),
(162, '2019-02-16 22:17:41', 'Admin', '1234567', '::1', 'sukses'),
(163, '2019-02-17 01:02:30', 'Admin', '1234567', '::1', 'sukses'),
(164, '2019-02-17 12:54:44', 'Admin', '1234567', '::1', 'sukses'),
(165, '2019-02-21 22:10:27', 'Admin', '1234567', '::1', 'sukses'),
(166, '2019-02-21 22:25:53', 'Admin', '1234567', '::1', 'sukses'),
(167, '2019-02-21 23:03:01', 'Admin', '1234567', '::1', 'sukses'),
(168, '2019-02-21 23:26:38', '0007591337', '1234567', '::1', 'sukses'),
(169, '2019-02-21 23:43:13', 'Admin', '1234567', '::1', 'sukses'),
(170, '2019-02-22 15:57:24', 'Admin', '1234567', '::1', 'sukses'),
(171, '2019-02-25 08:26:59', 'Admin', '1234567', '::1', 'sukses'),
(172, '2019-02-25 10:01:05', '0012767806', '1234567', '::1', 'sukses'),
(173, '2019-02-25 10:02:16', 'Admin', '1234567', '::1', 'sukses'),
(174, '2019-02-25 10:03:55', '0012767806', '1234567', '::1', 'Gagal'),
(175, '2019-02-25 10:04:12', '0012767806', '1234567', '::1', 'sukses'),
(176, '2019-02-25 10:04:38', 'Admin', '1234567', '::1', 'sukses'),
(177, '2019-02-25 13:14:12', 'Admin', '1234567', '::1', 'sukses'),
(178, '2019-02-25 13:36:42', '0007977891', '1234567', '::1', 'sukses'),
(179, '2019-02-27 03:34:59', 'Admin', '1234567', '::1', 'sukses'),
(180, '2019-03-04 14:17:19', 'Admin', '1234567', '::1', 'sukses'),
(181, '2019-03-04 14:38:42', 'Admin', '1234567', '::1', 'sukses'),
(182, '2019-03-04 15:48:59', 'Admin', '1234567', '::1', 'sukses'),
(183, '2019-03-04 20:17:12', 'Admin', '1234567', '::1', 'sukses'),
(184, '2019-03-04 23:08:30', '0008926228', '1234567', '::1', 'sukses'),
(185, '2019-03-04 23:32:06', 'Rini', '1234567', '::1', 'sukses'),
(186, '2019-03-04 23:35:09', 'Rini', '1234567', '::1', 'sukses'),
(187, '2019-03-04 23:36:45', 'Admin', '1234567', '::1', 'sukses'),
(188, '2019-03-04 23:37:42', 'Diyah', '1234567', '::1', 'sukses'),
(189, '2019-03-04 23:47:49', 'Admin', '1234567', '::1', 'sukses'),
(190, '2019-03-05 00:14:04', 'G-03', '1234567', '::1', 'sukses'),
(191, '2019-03-05 10:09:33', 'Admin', '1234567', '::1', 'sukses'),
(192, '2019-03-05 10:59:04', '0008926228', '1234567', '::1', 'sukses'),
(193, '2019-03-05 11:01:02', '0008926228', '1234567', '::1', 'sukses'),
(194, '2019-03-05 11:04:40', 'Admin', '1234567', '::1', 'sukses'),
(195, '2019-03-05 11:12:03', '8274', '1234567', '::1', 'Gagal'),
(196, '2019-03-05 11:12:09', '0008926228', '1234567', '::1', 'sukses'),
(197, '2019-03-05 11:12:35', 'Admin', '1234567', '::1', 'sukses'),
(198, '2019-03-05 22:44:30', '0004922124', '1234567', '::1', 'sukses'),
(199, '2019-03-05 22:45:21', 'Admin', '1234567', '::1', 'sukses'),
(200, '2019-03-06 11:21:46', 'Admin', '1234567', '::1', 'sukses'),
(201, '2019-03-06 11:26:35', '0004922124', '1234567', '::1', 'sukses'),
(202, '2019-03-06 18:21:45', 'Admin', '1234567', '::1', 'sukses'),
(203, '2019-03-07 01:40:21', 'Admin', '1234567', '::1', 'sukses'),
(204, '2019-03-07 20:43:49', 'Admin', '1234567', '::1', 'sukses');

-- --------------------------------------------------------

--
-- Table structure for table `tb_negara`
--

CREATE TABLE `tb_negara` (
  `negara_id` varchar(3) NOT NULL,
  `nama_negara` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_negara`
--

INSERT INTO `tb_negara` (`negara_id`, `nama_negara`) VALUES
('AD', 'Andorra'),
('AE', 'United Arab Emirates'),
('AF', 'Afghanistan'),
('AG', 'Antigua And Barbuda'),
('AI', 'Anguilla'),
('AL', 'Albania'),
('AM', 'Armenia'),
('AN', 'Netherlands Antilles'),
('AO', 'Angola'),
('AQ', 'Antarctica'),
('AR', 'Argentina'),
('AS', 'American Samoa'),
('AT', 'Austria'),
('AU', 'Australia'),
('AW', 'Aruba'),
('AX', 'Aland Islands'),
('AZ', 'Azerbaijan'),
('BA', 'Bosnia And Herzegovina'),
('BB', 'Barbados'),
('BD', 'Bangladesh'),
('BE', 'Belgium'),
('BF', 'Burkina Faso'),
('BG', 'Bulgaria'),
('BH', 'Bahrain'),
('BI', 'Burundi'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BN', 'Brunei Darussalam'),
('BO', 'Bolivia'),
('BR', 'Brazil'),
('BS', 'Bahamas'),
('BT', 'Bhutan'),
('BV', 'Bouvet Island'),
('BW', 'Botswana'),
('BY', 'Belarus'),
('BZ', 'Belize'),
('CA', 'Canada'),
('CC', 'Cocos (Keeling) Islands'),
('CD', 'Congo, The Democratic Republic Of The'),
('CF', 'Central African Republic'),
('CG', 'Congo'),
('CH', 'Switzerland'),
('CI', 'Cote D\'Ivoire'),
('CK', 'Cook Islands'),
('CL', 'Chile'),
('CM', 'Cameroon'),
('CN', 'China'),
('CO', 'Colombia'),
('CR', 'Costa Rica'),
('CS', 'Serbia And Montenegro'),
('CU', 'Cuba'),
('CV', 'Cape Verde'),
('CX', 'Christmas Island'),
('CY', 'Cyprus'),
('CZ', 'Czech Republic'),
('DE', 'Germany'),
('DJ', 'Djibouti'),
('DK', 'Denmark'),
('DM', 'Dominica'),
('DO', 'Dominican Republic'),
('DZ', 'Algeria'),
('EC', 'Ecuador'),
('EE', 'Estonia'),
('EG', 'Egypt'),
('EH', 'Western Sahara'),
('ER', 'Eritrea'),
('ES', 'Spain'),
('ET', 'Ethiopia'),
('FI', 'Finland'),
('FJ', 'Fiji'),
('FK', 'Falkland Islands (Malvinas)'),
('FM', 'Micronesia, Federated States Of'),
('FO', 'Faroe Islands'),
('FR', 'France'),
('GA', 'Gabon'),
('GB', 'United Kingdom'),
('GD', 'Grenada'),
('GE', 'Georgia'),
('GF', 'French Guiana'),
('GG', 'Guernsey'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GL', 'Greenland'),
('GM', 'Gambia'),
('GN', 'Guinea'),
('GP', 'Guadeloupe'),
('GQ', 'Equatorial Guinea'),
('GR', 'Greece'),
('GS', 'South Georgia And The South Sandwich Islands'),
('GT', 'Guatemala'),
('GU', 'Guam'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HK', 'Hong Kong'),
('HM', 'Heard Island And Mcdonald Islands'),
('HN', 'Honduras'),
('HR', 'Croatia'),
('HT', 'Haiti'),
('HU', 'Hungary'),
('ID', 'Indonesia'),
('IE', 'Ireland'),
('IL', 'Israel'),
('IM', 'Isle Of Man'),
('IN', 'India'),
('IO', 'British Indian Ocean Territory'),
('IQ', 'Iraq'),
('IR', 'Iran, Islamic Republic Of'),
('IS', 'Iceland'),
('IT', 'Italy'),
('JE', 'Jersey'),
('JM', 'Jamaica'),
('JO', 'Jordan'),
('JP', 'Japan'),
('KE', 'Kenya'),
('KG', 'Kyrgyzstan'),
('KH', 'Cambodia'),
('KI', 'Kiribati'),
('KM', 'Comoros'),
('KN', 'Saint Kitts And Nevis'),
('KP', 'Korea, Democratic People\'S Republic Of'),
('KR', 'Korea, Republic Of'),
('KW', 'Kuwait'),
('KY', 'Cayman Islands'),
('KZ', 'Kazakhstan'),
('LA', 'Lao People\'S Democratic Republic'),
('LB', 'Lebanon'),
('LC', 'Saint Lucia'),
('LI', 'Liechtenstein'),
('LK', 'Sri Lanka'),
('LR', 'Liberia'),
('LS', 'Lesotho'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('LV', 'Latvia'),
('LY', 'Libyan Arab Jamahiriya'),
('MA', 'Morocco'),
('MC', 'Monaco'),
('MD', 'Moldova, Republic Of'),
('MG', 'Madagascar'),
('MH', 'Marshall Islands'),
('MK', 'Macedonia, The Former Yugoslav Republic Of'),
('ML', 'Mali'),
('MM', 'Myanmar'),
('MN', 'Mongolia'),
('MO', 'Macao'),
('MP', 'Northern Mariana Islands'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MS', 'Montserrat'),
('MT', 'Malta'),
('MU', 'Mauritius'),
('MV', 'Maldives'),
('MW', 'Malawi'),
('MX', 'Mexico'),
('MY', 'Malaysia'),
('MZ', 'Mozambique'),
('NA', 'Namibia'),
('NC', 'New Caledonia'),
('NE', 'Niger'),
('NF', 'Norfolk Island'),
('NG', 'Nigeria'),
('NI', 'Nicaragua'),
('NL', 'Netherlands'),
('NO', 'Norway'),
('NP', 'Nepal'),
('NR', 'Nauru'),
('NU', 'Niue'),
('NZ', 'New Zealand'),
('OM', 'Oman'),
('PA', 'Panama'),
('PE', 'Peru'),
('PF', 'French Polynesia'),
('PG', 'Papua New Guinea'),
('PH', 'Philippines'),
('PK', 'Pakistan'),
('PL', 'Poland'),
('PM', 'Saint Pierre And Miquelon'),
('PN', 'Pitcairn'),
('PR', 'Puerto Rico'),
('PS', 'Palestinian Territory, Occupied'),
('PT', 'Portugal'),
('PW', 'Palau'),
('PY', 'Paraguay'),
('QA', 'Qatar'),
('RE', 'Reunion'),
('RO', 'Romania'),
('RU', 'Russian Federation'),
('RW', 'Rwanda'),
('SA', 'Saudi Arabia'),
('SB', 'Solomon Islands'),
('SC', 'Seychelles'),
('SD', 'Sudan'),
('SE', 'Sweden'),
('SG', 'Singapore'),
('SH', 'Saint Helena'),
('SI', 'Slovenia'),
('SJ', 'Svalbard And Jan Mayen'),
('SK', 'Slovakia'),
('SL', 'Sierra Leone'),
('SM', 'San Marino'),
('SN', 'Senegal'),
('SO', 'Somalia'),
('SR', 'Suriname'),
('ST', 'Sao Tome And Principe'),
('SV', 'El Salvador'),
('SY', 'Syrian Arab Republic'),
('SZ', 'Swaziland'),
('TC', 'Turks And Caicos Islands'),
('TD', 'Chad'),
('TF', 'French Southern Territories'),
('TG', 'Togo'),
('TH', 'Thailand'),
('TJ', 'Tajikistan'),
('TK', 'Tokelau'),
('TL', 'Timor-Leste'),
('TM', 'Turkmenistan'),
('TN', 'Tunisia'),
('TO', 'Tonga'),
('TR', 'Turkey'),
('TT', 'Trinidad And Tobago'),
('TV', 'Tuvalu'),
('TW', 'Taiwan, Province Of China'),
('TZ', 'Tanzania, United Republic Of'),
('UA', 'Ukraine'),
('UG', 'Uganda'),
('UM', 'United States Minor Outlying Islands'),
('US', 'United States'),
('UY', 'Uruguay'),
('UZ', 'Uzbekistan'),
('VA', 'Holy See (Vatican City State)'),
('VC', 'Saint Vincent And The Grenadines'),
('VE', 'Venezuela'),
('VG', 'Virgin Islands, British'),
('VI', 'Virgin Islands, U.S.'),
('VN', 'Viet Nam'),
('VU', 'Vanuatu'),
('WF', 'Wallis And Futuna'),
('WS', 'Samoa'),
('YE', 'Yemen'),
('YT', 'Mayotte'),
('ZA', 'South Africa'),
('ZM', 'Zambia'),
('ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggaran`
--

CREATE TABLE `tb_pelanggaran` (
  `pelanggaran_id` varchar(20) NOT NULL,
  `nama_pelanggaran` varchar(200) NOT NULL,
  `kategori_pelanggaran` varchar(100) NOT NULL,
  `poin_pelanggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggaran`
--

INSERT INTO `tb_pelanggaran` (`pelanggaran_id`, `nama_pelanggaran`, `kategori_pelanggaran`, `poin_pelanggaran`) VALUES
('10', 'Peserta didik yang terlambat masuk ke kelas setelah guru memulai pelajaran dalam pergantian', 'Kehadiran Peserta Didik', '5'),
('11', 'Membuat kegaduhan, tertidur/mengantuk pada saat proses belajar mengajar', 'Kehadiran Peserta Didik', '10'),
('12', 'didik meninggalkan sekolah sebelum waktu KBM selesai,  tanpa ijin guru mapel / guru piket', 'Meninggalkan Sekolah', '10'),
('13', 'Peserta didik meninggalkan KBM sampai selesai KBM tanpa ijin guru mata pelajaran', 'Meninggalkan Sekolah', '20'),
('14', 'Tidak hadir tanpa surat ijin/tanpa keterangan/alpa', 'Berhalangan Hadir', '10'),
('15', 'Pemalsuan atau penyalahgunaan surat ijin', 'Berhalangan Hadir', '20'),
('16', 'Peserta didik kelas X tidak mengikuti kegiatan pengembangan diri / ekstra kurikuler pramuka', 'Kegiatan Ekstra Kurikuler', '10'),
('17', 'Peserta didik kelas X dan kelas XI tidak mengikuti ekstra kurikuler/pengembangan yang telah dipilih', 'Kegiatan Ekstra Kurikuler', '5'),
('18', 'Peserta didik tidak mentaati peraturan kegiatan pengembangan diri / ekstra kurikuler', 'Kegiatan Ekstra Kurikuler', '5'),
('19', 'Berpakaian tidak sesuai mode/jadwal yang ditentukan sekolah', 'Cara Berpakaian', '10'),
('20', 'Memakai sepatu, kaos kaki, sabuk, jilbab tidak sesuai tata tertib', 'Cara Berpakaian', '10'),
('21', 'Tidak memakai topi saat melaksanakan kegiatan Upacara atau Apel', 'Cara Berpakaian', '10'),
('22', 'Tidak berpakaian olah raga pada saat kegiatan olah raga', 'Cara Berpakaian', '10'),
('23', 'Berpakaian Pramuka tidak lengkap pada kegiatan pramuka', 'Cara Berpakaian', '10'),
('24', 'Baju atasan tidak dimasukkan/tidak rapi', 'Cara Berpakaian', '10'),
('25', 'Memakai seragam sekolah sempit, kotor atau terdapat corat-coret', 'Cara Berpakaian', '10'),
('26', 'Peserta didik putra berambut panjang/tidak rapi/diwarnai', 'Cara Berpakaian', '10'),
('27', 'Mengenakan perhiasan/asesoris/ bersolek berlebihan', 'Cara Berpakaian', '10'),
('28', 'Berkata atau berbuat tidak sopan kepada guru, karyawan atau teman', 'Keamanan Ketertiban dan Sopan Santun', '50'),
('29', 'Melakukan pemukulan/pengeroyokan terhadap guru/karyawan/ teman', 'Keamanan Ketertiban dan Sopan Santun', '100'),
('3', 'Peserta didik tidak mengikuti kegiatan upacara', 'Upacara Bendera', '10'),
('30', 'Melakukan pengrusakan terhadap sarana sekolah', 'Keamanan Ketertiban dan Sopan Santun', '75'),
('31', 'Membuat kegaduhan, membunyikan/mengendarai sepeda motor di dalam lingkungan sekolah', 'Keamanan Ketertiban dan Sopan Santun', '25'),
('32', 'Menggunakan/mengaktifkan handphone pada saat KBM tanpa seijin guru pelajaran', 'Keamanan Ketertiban dan Sopan Santun', '20'),
('33', 'Melompat Pagar', 'Keamanan Ketertiban dan Sopan Santun', '25'),
('34', 'Memarkir kendaran tidak pada tempat parkir yang ditentukan sekolah', 'Keamanan Ketertiban dan Sopan Santun', '10'),
('35', 'Mengendarai sepeda motor tidak memakai helm / tidak memiliki SIM', 'Keamanan Ketertiban dan Sopan Santun', '15'),
('36', 'Membawa teman atau orang lain ke lingkungan sekolah tanpa ijin dari guru piket', 'Keamanan Ketertiban dan Sopan Santun', '20'),
('37', 'Mencemarkan nama baik sekolah, memalsu dokumen sekolah ', 'Keamanan Ketertiban dan Sopan Santun', '75'),
('38', 'Membawa gambar, buku bacaan yang bersifat asusila, serta senjata tajam serta membawa laptop/handphone yang berisi foto/video pornografi', 'Keamanan Ketertiban dan Sopan Santun', '50'),
('39', 'Melaksanakan kegiatan dengan mengatas namakan sekolah tanpa seijin kepala sekolah', 'Keamanan Ketertiban dan Sopan Santun', '30'),
('4', 'Tidak bersedia ditunjuk sebagai petugas upacara', 'Upacara Bendera', '5'),
('40', 'Kegiatan peserta didik yang mengatas namakan sekolah tanpa disertai guru pendamping', 'Keamanan Ketertiban dan Sopan Santun', '30'),
('41', 'Berpakaian, bertingkah laku asusila/tidak sopan', 'Keamanan Ketertiban dan Sopan Santun', '75'),
('42', 'Membawa rokok di sekolah', 'Keamanan Ketertiban dan Sopan Santun', '25'),
('43', 'Menghisap rokok di sekolah', 'Keamanan Ketertiban dan Sopan Santun', '25'),
('44', 'Membawa dan minum minuman keras, memakai narkotika dan zat adiktif lainya', 'Keamanan Ketertiban dan Sopan Santun', '75'),
('45', 'Melakukan pemalakan', 'Keamanan Ketertiban dan Sopan Santun', '75'),
('46', 'Membuang sampah tidak pada tempatnya', 'Kebersihan dan Keindahan', '10'),
('47', 'Melakukan corat-coret pada meja/ruang kelas/lingkungan sekolah', 'Kebersihan dan Keindahan', '15'),
('48', 'Regu piket tidak melaksanakan kebersihan kelas setelah pelajaran berakhir', 'Kebersihan dan Keindahan', '6'),
('49', 'Anggota kelas yang tidak bersedia ditunjuk mewakili kelas dalam pengurus OSIS/pengurus kelas', ' Organisasi Siswa dan Kekeluargaan', '10'),
('5', 'Petugas melakukan kesalahan dalam melaksanakan tugas pada saat upacara', 'Upacara Bendera', '6'),
('50', 'Membuat organisasi tanpa persetujuan dari kepala sekolah', ' Organisasi Siswa dan Kekeluargaan', '25'),
('51', 'Tidak memiliki kartu anggota Organisasi Siswa Intra Sekolah', ' Organisasi Siswa dan Kekeluargaan', '50'),
('52', 'Tidak mendukung program atau kegiatan OSIS yang telah ditetapkan', ' Organisasi Siswa dan Kekeluargaan', '20'),
('53', 'Membuat provokasi untuk melakukan perpecahan terhadap teman/guru/karyawan', ' Organisasi Siswa dan Kekeluargaan', '50'),
('6', 'Peserta didik tidak hidmad atau melakukan kegaduhan dalam upacara', 'Upacara Bendera', '10'),
('7', 'Peserta didik terlambat datang ke sekolah 5 menit setelah bel masuk berbunyi', 'Kehadiran Peserta Didik', '5'),
('8', 'Peserta didik terlambat diatas 5 lima menit  ', 'Kehadiran Peserta Didik', '10'),
('9', 'Piket kelas yang tidak melapor ke guru piket  setelah 5 (lima) menit jam pelajaran berlangsung, dimana guru mata pelajaran yang bersangkutan belum hadir', 'Kehadiran Peserta Didik', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengunjung`
--

CREATE TABLE `tb_pengunjung` (
  `urut` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `ip` varchar(30) NOT NULL,
  `browser` text NOT NULL,
  `page` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_pengunjung`
--

INSERT INTO `tb_pengunjung` (`urut`, `tanggal`, `ip`, `browser`, `page`) VALUES
(101, '2018-12-16 23:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(100, '2018-12-16 18:27:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(99, '2018-12-16 09:45:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(98, '2018-12-15 21:34:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(97, '2018-12-15 20:36:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(96, '2018-12-15 00:48:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(95, '2018-12-15 00:39:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(94, '2018-12-15 00:37:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(93, '2018-12-14 23:35:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(92, '2018-12-14 23:32:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(91, '2018-12-14 23:26:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(90, '2018-12-14 23:23:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(89, '2018-12-14 23:16:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(102, '2019-01-24 17:38:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(103, '2019-01-24 17:54:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(104, '2019-01-24 18:03:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(105, '2019-01-24 18:07:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(106, '2019-01-24 18:09:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(107, '2019-01-24 18:13:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(108, '2019-01-24 18:18:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(109, '2019-01-25 15:50:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(110, '2019-01-26 12:09:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(111, '2019-01-27 14:43:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(112, '2019-01-27 21:51:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(113, '2019-01-28 00:52:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(114, '2019-01-28 01:00:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(115, '2019-01-28 01:00:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(116, '2019-01-28 01:01:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(117, '2019-01-28 01:02:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(118, '2019-01-28 01:03:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(119, '2019-01-28 01:04:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(120, '2019-01-28 01:05:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(121, '2019-01-28 01:05:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(122, '2019-01-28 01:08:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(123, '2019-01-28 03:10:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'showDataAll'),
(124, '2019-01-28 03:10:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'showDataAll'),
(125, '2019-01-28 03:16:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(126, '2019-01-28 03:18:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(127, '2019-01-28 03:21:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(128, '2019-01-28 03:23:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(129, '2019-01-28 03:30:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(130, '2019-01-28 03:32:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(131, '2019-01-28 03:35:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(132, '2019-01-28 03:36:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(133, '2019-01-28 03:51:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(134, '2019-01-28 16:52:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(135, '2019-01-28 17:09:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(136, '2019-01-28 17:09:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(137, '2019-01-28 17:18:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(138, '2019-01-28 17:27:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(139, '2019-01-28 17:27:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(140, '2019-01-28 17:30:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(141, '2019-01-28 17:38:09', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(142, '2019-01-28 17:38:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(143, '2019-01-28 17:44:27', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(144, '2019-01-28 17:44:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(145, '2019-01-28 17:46:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(146, '2019-01-28 17:47:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(147, '2019-01-28 17:50:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(148, '2019-01-28 18:03:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(149, '2019-01-28 18:04:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(150, '2019-01-28 18:06:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(151, '2019-01-28 18:07:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(152, '2019-01-28 18:08:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'home'),
(153, '2019-01-28 18:09:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'home'),
(154, '2019-01-28 18:11:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'home'),
(155, '2019-01-28 18:13:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(156, '2019-01-28 18:15:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(157, '2019-01-28 18:17:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(158, '2019-01-28 18:18:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(159, '2019-01-28 18:22:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(160, '2019-01-28 18:42:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(161, '2019-01-28 18:43:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(162, '2019-01-28 18:49:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(163, '2019-01-28 18:53:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(164, '2019-01-28 18:54:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(165, '2019-01-28 18:56:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(166, '2019-01-28 19:06:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(167, '2019-01-28 19:07:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(168, '2019-01-28 19:08:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(169, '2019-01-28 19:09:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(170, '2019-01-28 19:28:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(171, '2019-01-28 19:29:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(172, '2019-01-28 21:21:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(173, '2019-01-28 21:21:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(174, '2019-01-28 21:51:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(175, '2019-01-28 21:52:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(176, '2019-01-28 21:52:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(177, '2019-01-28 22:03:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(178, '2019-02-01 14:53:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(179, '2019-02-02 10:57:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'logout'),
(180, '2019-02-02 15:12:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'logout'),
(181, '2019-02-02 23:07:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(182, '2019-02-03 13:14:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'showDataAll'),
(183, '2019-02-03 13:14:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'showAdminModal'),
(184, '2019-02-03 17:08:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(185, '2019-02-03 19:58:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(186, '2019-02-05 12:19:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(187, '2019-02-08 02:55:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(188, '2019-02-08 10:39:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(189, '2019-02-08 14:28:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(190, '2019-02-08 16:28:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(191, '2019-02-09 22:28:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(192, '2019-02-11 00:04:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(193, '2019-02-11 02:19:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(194, '2019-02-11 13:55:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(195, '2019-02-11 14:49:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(196, '2019-02-11 17:05:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(197, '2019-02-11 20:43:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(198, '2019-02-11 21:03:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(199, '2019-02-12 09:46:53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(200, '2019-02-12 19:41:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(201, '2019-02-14 06:18:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(202, '2019-02-14 12:42:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(203, '2019-02-15 19:16:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(204, '2019-02-15 22:22:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(205, '2019-02-16 03:01:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(206, '2019-02-16 11:01:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(207, '2019-02-16 15:31:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(208, '2019-02-16 15:36:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(209, '2019-02-16 16:03:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(210, '2019-02-16 16:05:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(211, '2019-02-16 22:17:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(212, '2019-02-17 01:02:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(213, '2019-02-17 12:49:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'kirimPesan2'),
(214, '2019-02-21 22:10:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(215, '2019-02-21 22:25:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(216, '2019-02-21 23:02:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(217, '2019-02-21 23:26:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(218, '2019-02-21 23:42:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(219, '2019-02-22 15:57:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(220, '2019-02-25 08:26:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(221, '2019-02-25 10:00:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(222, '2019-02-25 10:01:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(223, '2019-02-25 10:03:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(224, '2019-02-25 10:04:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(225, '2019-02-25 13:11:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(226, '2019-02-25 13:36:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(227, '2019-02-25 13:38:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(228, '2019-02-27 02:04:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(229, '2019-03-04 14:16:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(230, '2019-03-04 14:38:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(231, '2019-03-04 14:38:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(232, '2019-03-04 15:48:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(233, '2019-03-04 20:16:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'modalEditSiswa'),
(234, '2019-03-04 20:16:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'showDataAll'),
(235, '2019-03-04 23:08:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(236, '2019-03-04 23:31:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(237, '2019-03-04 23:33:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(238, '2019-03-04 23:36:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(239, '2019-03-04 23:36:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(240, '2019-03-04 23:37:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(241, '2019-03-04 23:47:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(242, '2019-03-05 00:13:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(243, '2019-03-05 10:09:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(244, '2019-03-05 10:58:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(245, '2019-03-05 11:00:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(246, '2019-03-05 11:04:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(247, '2019-03-05 11:11:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(248, '2019-03-05 11:12:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(249, '2019-03-05 22:43:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(250, '2019-03-05 22:45:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(251, '2019-03-06 11:21:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(252, '2019-03-06 11:26:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(253, '2019-03-06 18:21:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(254, '2019-03-06 18:21:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(255, '2019-03-07 01:40:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal'),
(256, '2019-03-07 01:40:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'home'),
(257, '2019-03-07 20:43:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:60.0) Gecko/20100101 Firefox/60.0', 'awal');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesan`
--

CREATE TABLE `tb_pesan` (
  `urut` int(11) NOT NULL,
  `pengirim` varchar(30) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pesan`
--

INSERT INTO `tb_pesan` (`urut`, `pengirim`, `telpon`, `pesan`) VALUES
(1, 'Noto Setiyo Putro', '087781955877', 'aaaa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi`
--

CREATE TABLE `tb_presensi` (
  `no` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `induk` varchar(8) NOT NULL,
  `jenis` enum('S','I','A','T') NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_presensi`
--

INSERT INTO `tb_presensi` (`no`, `tanggal`, `jam`, `induk`, `jenis`) VALUES
(55, '2019-02-25', '13:24:16', '19771', 'I'),
(56, '2019-02-25', '13:24:22', '19763', 'A'),
(57, '2019-03-04', '14:26:24', '19766', 'A'),
(58, '2019-03-04', '17:32:52', '8274', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `urut` int(11) NOT NULL,
  `prodi` varchar(15) NOT NULL,
  `nama_prodi` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`urut`, `prodi`, `nama_prodi`) VALUES
(1, 'MIPA', 'Matematika dan Ilmu Pengetahuan Alam'),
(2, 'IPS', 'Ilmu Pengetahuan Sosial'),
(3, 'Bahasa', 'Bahasa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sekolah`
--

CREATE TABLE `tb_sekolah` (
  `nama_sekolah` varchar(80) NOT NULL,
  `alamat` varchar(70) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `kota` varchar(80) NOT NULL,
  `propinsi` varchar(80) NOT NULL,
  `kepsek` varchar(80) NOT NULL,
  `nip` varchar(40) NOT NULL,
  `tanggal` date NOT NULL,
  `website` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `tapel` int(4) NOT NULL DEFAULT '2017',
  `semester` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`nama_sekolah`, `alamat`, `kodepos`, `telepon`, `kota`, `propinsi`, `kepsek`, `nip`, `tanggal`, `website`, `email`, `tapel`, `semester`) VALUES
('SMA N 1 Purwareja Klampok111', 'Jl. Raya Purwareja Klampok', '53474', '(0286) 479092', 'Banjarnegara', 'Jawa Tengah', 'Sudarto, S.Pd', '197107101999031005', '0000-00-00', 'www.sman1klampok.sch.id', 'smansaklampok@yahoo.com', 2018, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `no_induk` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `thn_msk` int(4) NOT NULL DEFAULT '2018',
  `kelas` varchar(10) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `agama` int(2) NOT NULL,
  `warga` varchar(3) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `tlp_rmh` varchar(15) NOT NULL,
  `sts_tinggal3` varchar(2) NOT NULL,
  `jarak` int(2) NOT NULL,
  `waktu` int(2) NOT NULL,
  `gakin` varchar(1) NOT NULL DEFAULT 'T',
  `no_gakin` varchar(30) NOT NULL,
  `minat` varchar(10) NOT NULL,
  `nama_ayah` varchar(30) NOT NULL,
  `nik_ayah` varchar(30) NOT NULL,
  `alamat_ayah` varchar(50) NOT NULL,
  `tgl_ayah` date NOT NULL,
  `agama_ayah` int(2) NOT NULL,
  `warga_ayah` varchar(3) NOT NULL,
  `tlp_ayah` varchar(15) NOT NULL,
  `hdp_mt_ayah` varchar(1) NOT NULL DEFAULT 'Y',
  `mati_ayah` int(4) NOT NULL,
  `nama_ibu` varchar(30) NOT NULL,
  `nik_ibu` varchar(30) NOT NULL,
  `alamat_ibu` varchar(50) NOT NULL,
  `tgl_ibu` date NOT NULL,
  `agama_ibu` int(2) NOT NULL,
  `warga_ibu` varchar(3) NOT NULL,
  `tlp_ibu` varchar(15) NOT NULL,
  `hdp_mt_ibu` varchar(1) NOT NULL DEFAULT 'Y',
  `mati_ibu` int(4) NOT NULL,
  `nama_wali` varchar(30) NOT NULL,
  `nik_wali` varchar(30) NOT NULL,
  `alamat_wali` varchar(50) NOT NULL,
  `tgl_wali` date NOT NULL,
  `agama_wali` int(2) NOT NULL,
  `warga_wali` varchar(3) NOT NULL,
  `tlp_wali` varchar(15) NOT NULL,
  `hdp_mt_wali` varchar(1) NOT NULL DEFAULT 'Y',
  `mati_wali` int(4) NOT NULL,
  `th_ajaran` int(4) NOT NULL DEFAULT '2016',
  `sts_siswa` varchar(1) NOT NULL DEFAULT 'A',
  `status` varchar(8) NOT NULL DEFAULT 'siswa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `password`, `no_induk`, `nama`, `thn_msk`, `kelas`, `gender`, `tgl_lhr`, `agama`, `warga`, `alamat`, `tlp_rmh`, `sts_tinggal3`, `jarak`, `waktu`, `gakin`, `no_gakin`, `minat`, `nama_ayah`, `nik_ayah`, `alamat_ayah`, `tgl_ayah`, `agama_ayah`, `warga_ayah`, `tlp_ayah`, `hdp_mt_ayah`, `mati_ayah`, `nama_ibu`, `nik_ibu`, `alamat_ibu`, `tgl_ibu`, `agama_ibu`, `warga_ibu`, `tlp_ibu`, `hdp_mt_ibu`, `mati_ibu`, `nama_wali`, `nik_wali`, `alamat_wali`, `tgl_wali`, `agama_wali`, `warga_wali`, `tlp_wali`, `hdp_mt_wali`, `mati_wali`, `th_ajaran`, `sts_siswa`, `status`) VALUES
('0004922124', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9269', 'Fivi Wulandari', 2018, '10B1', 'P', '2000-05-17', 1, 'ID', 'MANDIRAJA WETAN	 RT 5 RW 3 Kec. Mandiraja, 53473', '082322506959', 'T', 2, 3, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0008926228', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '8274', 'Abdul Aziz Ni\'matulloh', 2016, '12A1', 'L', '2000-05-18', 1, 'ID', 'Merden RT 2 RW 4  Kec. Purwanegara', '083862348755', 'T', 2, 2, 'T', '', 'MIPA', 'ADI SUSENO', '3304043004690002', 'merden RT 2 RW 4  Kec. Purwanegara', '1969-12-11', 1, 'ID', '0817395571', 'Y', 0, 'ASYIK MARIFAH', '3304046103760003', 'merden RT 2 RW 4  Kec. Purwanegara', '1972-02-07', 1, 'ID', '', 'Y', 0, '', 'a', 'd', '2019-02-14', 1, 'ID', '0987876', 'Y', 0, 2016, '', 'siswa'),
('0013066349', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9275', 'Muhammad Rofi Angginal', 2018, '10B1', 'L', '2002-07-08', 1, 'ID', 'Rawagembol RT 1 RW 3 Kec. Purwareja Klampok, 53474', '087878670200', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0015401462', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9282', 'SITA FATIMAH NAILAH', 2018, '10B1', 'P', '2003-09-01', 1, 'ID', 'RAKIT RT 1 RW 3 Kec. Rakit', '082227906660', 'T', 2, 3, 'Y', '', '', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0016256307', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9261', 'Barya Lestari', 2018, '10B1', 'P', '2001-01-06', 1, 'ID', 'Jl. Karangcengis  Rt 01 Rw 04 Kec. Bukateja, 53382', '', 'T', 2, 2, 'T', '', 'Bahasa', 'Achmad Minanto', '3303021011730001', 'Jl. Karangcengis  Rt 01 Rw 04 Kec. Bukateja, 53382', '0000-00-00', 1, 'ID', '', 'Y', 0, 'Amiati', '3303025805820004', 'Jl. Karangcengis  Rt 01 Rw 04 Kec. Bukateja, 53382', '0000-00-00', 1, 'ID', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0017193853', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '8968', 'Awaludin Mu\'aziz', 2018, '10A1', 'L', '2001-10-20', 1, 'ID', 'Jl. Cangkring RT 5 RW 2	 Kec. Susukan, 53475', '', 'T', 2, 2, 'Y', '', 'MIPA', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0021404717', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9167', 'Rahman Arifin', 2018, '10S1', 'L', '2002-12-05', 1, 'ID', 'SOMAWANGI MUNTANG RT 5 RW 2 Kec. Mandiraja, 53473', '087782537700', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0021525495', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9280', 'SABAR WICAKSONO', 2018, '10B1', 'L', '2002-05-28', 1, 'ID', 'Jl. Ahmad Yani No. 555 RT 3 RW 9 Kec. Purwareja Klampok, 53474', '082242064012', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0023373438', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9170', 'Salsa Khoerunnisa', 2018, '10S1', 'P', '2002-08-04', 1, 'ID', 'MANDIRAJA KULON	 RT 1 RW 4 Kec. Mandiraja, 53473', '0895392709793', 'T', 2, 1, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0023615934', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9278', 'RADINAL SEDYATAMA', 2018, '12A5', 'L', '2002-04-30', 1, 'ID', 'LEMAH BENTAR	 RT 1 RW 1 Kec. Susukan, 53474', '081239595655', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0023617392', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9154', 'FAHMI NUR LATIF', 2018, '10S1', 'L', '2002-11-18', 1, 'ID', 'BRENGKOK RT 5 RW 1 Kec. Susukan 53474', '', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0024930069', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9164', 'Mutiara Nur Indah Sari', 2018, '10S1', 'P', '2002-11-02', 1, 'ID', 'SOMAKATON RT 2 RW 4 Kec. Somagede	, 53193', '081391160692', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0025933120', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9171', 'Sufi Muafidah', 2018, '10S1', 'P', '2002-09-02', 1, 'ID', 'BRENGKOK RT 5 RW 1 Kec. Susukan, 53475', '', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0027631888', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9283', 'Siti Nur Halimah', 2018, '10B1', 'P', '2002-10-18', 1, 'ID', 'Gumelem Wetan RT 2 RW 5	Kec. Susukan, 53475', '083109526927', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0027633983', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9165', 'Nur Maulida Herdiana', 2018, '10S1', 'P', '0002-06-12', 1, 'ID', 'SIDODADI RT 1 RW 2 Kec. Purwareja Klampok, 53474', '085291153301', 'T', 1, 1, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0027691797', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9273', 'Maulina Fajar Shinta Pratiwi', 2018, '10B1', 'P', '2002-08-20', 1, 'ID', 'KISUTA WIJAYA	RT 2 RW 1 Kec. Purwareja Klampok	, 53474', '', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032186247', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9281', 'Sabrina Ardana Ningrum', 2018, '10B1', 'P', '2003-08-23', 1, 'ID', 'Klampok RT 2 RW 6	 Kec. Purwareja Klampok, 53474', '081266860804', 'T', 1, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032472598', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9267', 'Fahri Hidayat', 2018, '10B1', 'L', '2003-04-02', 1, 'ID', 'RAWAGEMBOL RT 7 RW 3 Kec. Purwareja Klampok 53475', '', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032473606', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9148', 'Anugrah Panji Setyo Nugroho', 2018, '10S1', 'L', '2003-05-20', 1, 'ID', 'Kemranggon RT 1 RW 1	Kec. Susukan 53475', '085641626577', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032473610', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9162', 'Miftahul Alif', 2018, '10S1', 'L', '2003-07-03', 1, 'ID', 'Situ, RT 3 RW 4	Kec. Susukan, 53475', '081297303053', 'T', 2, 1, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032473981', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9258', 'Anisa Tri Rahayu', 2018, '10B1', 'P', '2003-07-29', 1, 'ID', 'Berta  Rt 2  Rw 1 Kec. Susukan', '', 'T', 0, 0, 'T', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032474548', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9286', 'Taufik Nur Rohman', 2018, '10B1', 'L', '2003-11-20', 1, 'ID', 'Dermasari RT 6 RW 1 Kec. Susukan, 53474', '085643238902', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032474610', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9153', 'Dwi Tusta Viandani', 2018, '10S1', 'P', '2003-08-26', 1, 'ID', 'Derik RT 2 RW 2 Kec. Susukan 53472', '083844291040', 'T', 2, 3, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032493455', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9160', 'Lina Muslimah', 2018, '10S1', 'P', '2003-08-28', 1, 'ID', 'Brengkok RT 5 RW 1 Kec. Susukan, 53475', '083149375826', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032493537', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9157', 'Inka Maulidah', 2018, '10S1', 'P', '2003-05-14', 1, 'ID', 'Jl. Susukan-lor kali RT 3 RW 5 Kec. Susukan, 53475', '085602810232', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032493541', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9255', 'Agrista Alfiana Wandari', 2018, '10B1', 'P', '2003-08-23', 1, 'ID', 'Jl.  Karangjati Rt 3 Rw  4 Kec. Susukan', '', 'T', 1, 1, 'T', '', 'Bahasa', 'Sarwan Hadi Prayitno', '', 'Jl.  Karangjati Rt 3 Rw  4 Kec. Susukan', '0000-00-00', 1, 'ID', '', 'Y', 0, 'Sartini', '', 'Jl.  Karangjati Rt 3 Rw  4 Kec. Susukan', '0000-00-00', 1, 'ID', '', 'Y', 0, '', '', 'Jl.  Karangjati RT 3 RW  4 Kec. Susukan', '0000-00-00', 0, '', '', 'Y', 0, 2018, '', 'siswa'),
('0032493712', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9287', 'Tri Uni Nuraisah', 2018, '10B1', 'P', '2003-03-25', 1, 'ID', 'Karangsalam RT 3 RW 2 Kec. Susukan, 53475', '083862447231', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0032494096', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9166', 'Rahma Insan Madani', 2018, '10S1', 'P', '2003-09-07', 1, 'ID', 'SUSUKAN RT 2 RW 2 Kec. Susukan, 53475', '081280303685', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034147907', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9260', 'Aulia Nur Fitriani', 2018, '10B1', 'P', '2003-12-12', 1, 'ID', 'Derik Rt  6 Rw 1 Kec. Susukan, 53475', '081387814002', 'T', 2, 2, 'T', '', 'Bahasa', 'Aris Purwanto', '3216081104740006', 'Derik Rt  6 Rw 1 Kec. Susukan, 53475', '0000-00-00', 1, 'ID', '', 'Y', 0, 'Sri Aning', '3216084103780016', 'Derik Rt  6 Rw 1 Kec. Susukan, 53475', '1978-10-16', 1, 'ID', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191105', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9277', 'Nanda Hamidah', 2018, '10B1', 'P', '2003-06-19', 1, 'ID', 'Jl. Kisuta Wijaya RT 1 RW 1 Kec. Purwareja Klampok, 53474', '089654377538', 'T', 2, 3, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191106', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9256', 'Ananda Bagus Dwi Kurniawan', 2018, '10B1', 'L', '2003-08-21', 1, 'ID', 'KatuhuI RT 3 RW 5 Kec. Purwareja Klampok, 53474', '', 'T', 0, 0, 'Y', '', 'Bahasa', 'Basuki Untung Parwoto', '', '', '0000-00-00', 1, 'ID', '', 'Y', 0, 'Sudiyah', '', 'KatuhuI RT 3 RW 5 Kec. Purwareja Klampok, 53474', '0000-00-00', 1, 'ID', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191156', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9158', 'Khafid Fildan Amri', 2018, '10S1', 'L', '2003-05-09', 1, 'ID', 'Kalimandi RT 1 RW 10 Kec. Purwareja Klampok, 53474', '081391269399', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191187', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9172', 'Yasikha Naftali Prabowo', 2018, '10S1', 'P', '2003-10-25', 1, 'ID', 'RAWAGEMPOL RT 3 RW	3 Kec. Purwareja Klampok	', '081578966662', 'T', 2, 1, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191190', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9168', 'Rosyida Rizka Putri', 2018, '10S1', 'P', '2003-07-07', 1, 'ID', 'Kalimandi RT 1 RW 1 Kec. Purwareja Klampok, 53474', '', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191201', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9285', 'Syakira Nabila Farihah', 2018, '10B1', 'P', '2003-12-27', 1, 'ID', 'Jl. Raya Purwareja Klampok RT 1 RW 1	Kec. Purwareja Klampok, 53474', '087715144077', 'T', 2, 1, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191263', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9146', 'Adrian Tri Kuncoro', 2018, '10S1', 'L', '2003-06-10', 1, 'ID', 'Kecitran Rt 1 Rw 2	Kec. Purwareja Klampok 53474', '', 'T', 2, 2, 'T', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191266', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9155', 'Firdaus Wahyu Putra Pratama', 2018, '10S1', 'L', '2003-07-30', 1, 'ID', 'Kecitran RT 6 RW 2	Kec. Purwareja Klampok 53474', '085325945872', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191424', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9169', 'Ruhita Nafa Sahara', 2018, '10S1', 'P', '2003-05-06', 1, 'ID', 'Kaliwinasuh RT 1 RW 3 Kec. Purwareja Klampok, 53474', '081327139424', 'T', 2, 1, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191511', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9152', 'Dwi Nur Apriliani', 2018, '10S1', 'P', '0004-05-26', 1, 'ID', 'PAGAK RT 2 RW 4 Kec. Purwareja Klampok	53474', '085879865619', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191603', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9284', 'Syafiq Nur Fadhilah', 2018, '10B1', 'P', '2003-09-23', 1, 'ID', 'Kalimandi RT 1 RW 9 Kec. Purwareja Klampok, 35474', '085601010495', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191696', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9274', 'Muh. Alif Nur Islami', 2018, '10B1', 'L', '2003-02-06', 1, 'ID', 'Binangun RT 2 RW 14 Kec. Purwareja Klampok, 53474', '083107649479', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034191709', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9163', 'Muhammad Dafa Firman Syah', 0, '10S1', 'L', '2003-03-21', 1, 'ID', 'JL. JASARA	RT 3 RW 9 Kec. Purwareja Klampok,  53474', '', 'T', 2, 1, 'Y', '', '', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192349', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9147', 'Ananda Yogi Saputra', 2018, '10S1', 'L', '2003-11-09', 1, 'ID', 'Sirkandi RT 1 RW 1	Kec. Purwareja Klampok, 53474', '082325604767', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192353', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9288', 'Yosi Nabilla Azzahra', 2018, '10B1', 'P', '2003-12-13', 1, 'ID', 'Sirkandi RT 6 RW 3 Kec. Purwareja Klampok, 53474', '088228855985', 'T', 2, 3, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192484', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9254', 'Adelia Oix Febriyani', 2018, '10B1', 'P', '2006-02-06', 1, 'ID', 'Kiringan Rt 03 Rw 01  Kec. Purwareja Klampok, 53474', '085868881166', 'T', 2, 2, 'T', '', 'Bahasa', 'Sodikin', '3304020302740001', 'Kiringan Rt 03 Rw 01  Kec. Purwareja Klampok, 5347', '0000-00-00', 1, 'ID', '', 'Y', 0, 'Uswatun Chasanah', '3304025704760002', 'Kiringan Rt 03 Rw 01  Kec. Purwareja Klampok, 5347', '0000-00-00', 1, '', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192520', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9262', 'Bianka Citra Adelia', 2018, '10B1', 'P', '2003-10-25', 1, 'ID', 'Kecitran RT 4 RW 2 Kec. Purwareja Klampok, 53474', '082314711426', 'T', 2, 3, 'Y', '', 'Bahasa', 'Riswan', '3304022703710001', 'Kecitran RT 4 RW 2 Kec. Purwareja Klampok, 53474', '1971-01-02', 1, 'ID', '', 'Y', 0, 'Suparti', '3304024909760001', 'Kecitran RT 4 RW 2 Kec. Purwareja Klampok, 53474', '1976-02-23', 1, '', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192521', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9159', 'Laeli Nurul Janah', 0, '10S1', 'P', '2002-12-15', 1, 'ID', 'PURWAREJA KLAMPOK RT 5 RW 3 Kec. Purwareja Klampok	, 53474', '081933720277', 'T', 1, 1, 'Y', '', '', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192654', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9265', 'Endah Khasanah', 2018, '10B1', 'P', '2003-09-13', 1, 'ID', 'MARGOMULYO RT 2 RW 8 Kec. Purwareja Klampok, 53474', '085802441545', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192746', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9156', 'FRISKA NURAGHISTA NINDYA UTAMI', 2018, '10S1', 'P', '2003-02-27', 1, 'ID', 'JL BIMA RT 2 RW 3 Kec. Purwareja Klampok', '083103818908', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034192747', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9276', 'Munabita Sa\'ada', 2018, '12A5', 'P', '2003-02-28', 1, 'ID', 'BAYALANGU RT 1 RW 1 Kec. Purwanegara	', '08996676846', 'T', 2, 3, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034257949', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9161', 'Merlin Nurintan', 2018, '10S1', 'P', '2003-05-12', 1, 'ID', 'Jl. Dermasari RT 3 RW 2 Kec. Susukan, 53475', '085702765692', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0034457372', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9279', 'Regita Della Purwati', 2018, '10B1', 'P', '2003-06-16', 1, 'ID', 'BLIMBING RT 3 RW 2 Kec. Mandiraja, 53473', '085803982889', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0036928086', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9263', 'DANIATUR RIZKI', 2018, '10B1', 'P', '2003-04-10', 1, 'ID', 'JL. GAJAH LAYANG NO. 04 RT 1 RW 3, Kec. Rakit, 53463', '085201539933', 'T', 2, 3, 'Y', '', 'Bahasa', 'Rokhid', '3304111106680003', 'JL. GAJAH LAYANG NO. 04 RT 1 RW 3, Kec. Rakit, 534', '0000-00-00', 1, 'ID', '', 'Y', 0, 'SRI MULYANI', '3304115305700002', 'JL. GAJAH LAYANG NO. 04 RT 1 RW 3, Kec. Rakit, 534', '0000-00-00', 1, 'ID', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0037301405', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9150', 'DESTYA ESA REFIANA', 2018, '10S1', 'P', '2003-12-23', 1, 'ID', 'JASARA	 RT 1 RW 9 Kec. Purwareja Klampok 53474', '085197414272', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0037385463', 'dDY0bDhNb0wwYnRGdEJ1eXBud3VmUT09', '9259', 'Asih Dwi Nursanti', 2018, '10B1', 'P', '2003-06-14', 1, 'ID', 'Berta Rt 5 Rw 3 Kec. Susukan, 53475', '082327219981', 'T', 2, 2, 'T', '', 'Bahasa', 'Carisan', '3304010811690001', 'Berta Rt 5 Rw 3 Kec. Susukan, 53475', '0000-00-00', 1, 'ID', '', 'Y', 0, 'Eni Tuti Rahayu', '3304015510770004', 'Berta Rt 5 Rw 3 Kec. Susukan, 53475', '0000-00-00', 1, 'ID', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0037984641', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9264', 'DESKA NUR KHOLIFAH', 2018, '10B1', 'P', '2003-06-13', 1, 'ID', 'JL. GAJAH LAYANG RAKIT ', '', 'T', 2, 3, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 0, '', 'siswa'),
('0038653171', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9268', 'Fany Eni Rahayu', 2018, '10B1', 'P', '2003-01-31', 1, 'ID', 'BLIMBING RW 6 RT 1 Kec. Mandiraja, 53473', '081327337277', 'T', 2, 3, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0039041270', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '8966', 'Alfina Dian Kartika', 2018, '10A1', 'P', '2004-08-04', 1, 'ID', 'Candi Wulan Rt 02 Rw 02 Kec. Mandiraja', '085227579800', 'T', 2, 3, 'T', '', 'MIPA', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0040171042', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9149', 'Cahya Dila Ningsih', 2018, '10S1', 'P', '2004-08-31', 1, 'ID', 'Berta RT 4 RW  1 Kec. Susukan	53473', '085701306293', 'T', 2, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0040171633', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9257', 'Andriana', 2018, '10B1', 'P', '2004-01-24', 1, 'ID', 'Gumelem Wetan Rt 1 Rw 12 Kec. Susukan, 53475', '', 'T', 2, 2, 'T', '', 'Bahasa', 'Wagimin', '3304012703740001', 'Gumelem Wetan Rt 1 Rw 12 Kec. Susukan, 53475', '0000-00-00', 0, '', '', 'Y', 0, 'Suminah Kurnia Wati', '3304014210770001', 'Gumelem Wetan Rt 1 Rw 12 Kec. Susukan, 53475', '0000-00-00', 1, 'ID', '', 'Y', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0040230701', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9272', 'LIQO HAINUR HAMIDAH', 2018, '10B1', 'P', '2004-01-18', 1, 'ID', 'BINANGUN	Kec. Purwareja Klampok, 53474', '081219072332', 'T', 1, 2, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0040297092', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9270', 'Hanifah Rifdah Nurul Azizah', 2018, '10B1', 'P', '2004-04-10', 1, 'ID', 'Pagak RT 1 RW 2 Kec. Purwareja Klampok, 53474', '082227414112', 'T', 2, 3, 'Y', '', 'Bahasa', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0040297158', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9151', 'Difa Nurul Ngafiah', 2018, '10S1', 'P', '2004-09-02', 1, 'ID', 'Kecitran RT 2 RW 1 Kec. Purwareja Klampok 53474', '082389751968', 'T', 2, 2, 'Y', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa'),
('0040312456', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', '9145', 'Aditya Bayu Saputra', 2018, '10S1', 'L', '2004-04-24', 1, 'ID', 'Purwasaba Rt 4 Rw 5	Kec. Mandiraja 53473', '0855642115858', 'T', 2, 2, 'T', '', 'IPS', '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, '', '', '', '0000-00-00', 0, '', '', 'T', 0, 2018, '', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wali`
--

CREATE TABLE `tb_wali` (
  `kelas` varchar(15) NOT NULL,
  `kd_guru` varchar(15) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `golongan` varchar(15) NOT NULL,
  `pangkat` varchar(30) NOT NULL,
  `login_terakhir` datetime NOT NULL,
  `login_status` enum('Y','N') NOT NULL DEFAULT 'N',
  `ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_wali`
--

INSERT INTO `tb_wali` (`kelas`, `kd_guru`, `password`, `nama`, `nip`, `golongan`, `pangkat`, `login_terakhir`, `login_status`, `ip`) VALUES
('10A1', 'G_01', '', 'Rini Ratnaningsih', '1234567890', 'A', 'Guru Bk', '2019-02-16 16:04:09', 'Y', '::1'),
('10A2', 'G-02', '', 'Dyah Puspita S.Pd', '213243534645767', 'IV A', 'Pembina Tk. I', '2018-06-15 19:57:45', 'N', '::1'),
('10A3', 'G-03', 'a08wODNrZmdxeXRJNXlsV20vbEJydz09', 'Sumardiyono', '13234245645647', 'B', 'Honorer', '2019-03-05 00:14:04', 'Y', '::1'),
('10A4', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('10A5', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('10aa2', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('10B1', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('10S1', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('10S2', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('10S3', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('10S4', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('11S2', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('11S3', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('11S4', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('12B1', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('12B2', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('12S1', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('12S2', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', ''),
('12S3', '', '', '', '', '', '', '0000-00-00 00:00:00', 'N', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_agama`
--
ALTER TABLE `tb_agama`
  ADD PRIMARY KEY (`agama_id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `tb_langgar`
--
ALTER TABLE `tb_langgar`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`no_login`);

--
-- Indexes for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD PRIMARY KEY (`pelanggaran_id`);

--
-- Indexes for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  ADD PRIMARY KEY (`urut`);

--
-- Indexes for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  ADD PRIMARY KEY (`urut`);

--
-- Indexes for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`urut`);

--
-- Indexes for table `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  ADD PRIMARY KEY (`nama_sekolah`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`) USING BTREE;

--
-- Indexes for table `tb_wali`
--
ALTER TABLE `tb_wali`
  ADD PRIMARY KEY (`kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_langgar`
--
ALTER TABLE `tb_langgar`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `no_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `tb_pengunjung`
--
ALTER TABLE `tb_pengunjung`
  MODIFY `urut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  MODIFY `urut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `urut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
