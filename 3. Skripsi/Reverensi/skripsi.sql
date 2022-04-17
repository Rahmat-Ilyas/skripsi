-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 11:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Admin', 'admin', '$2y$10$CPWbTBQTNQwxMfbEq0.BiuPiyH3/gWW8YY3q4ME4qEBpKfYk0HCjS');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `pupuk_id` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jatah`
--

CREATE TABLE `jatah` (
  `id` int(11) NOT NULL,
  `petani_id` int(11) NOT NULL,
  `pupuk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jatah`
--

INSERT INTO `jatah` (`id`, `petani_id`, `pupuk_id`, `jumlah`) VALUES
(3, 4, 1, 23),
(4, 4, 2, 19),
(5, 6, 1, 23),
(8, 7, 2, 12),
(9, 7, 1, 23),
(11, 36, 2, 350),
(12, 36, 4, 150),
(13, 37, 2, 200),
(14, 37, 4, 100),
(15, 38, 3, 150),
(16, 38, 1, 275),
(17, 38, 2, 150),
(18, 39, 1, 400),
(19, 39, 2, 400),
(20, 40, 2, 400),
(21, 40, 3, 400),
(22, 41, 2, 100),
(23, 41, 1, 150),
(24, 42, 2, 350),
(25, 42, 4, 200),
(26, 43, 1, 350),
(27, 43, 2, 200),
(28, 44, 2, 250),
(29, 44, 4, 200),
(30, 45, 2, 350),
(31, 45, 3, 150),
(32, 46, 2, 300),
(33, 46, 3, 150);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(11) NOT NULL,
  `nama_kelompok` varchar(255) NOT NULL,
  `jumlah_anggota` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id`, `nama_kelompok`, `jumlah_anggota`, `ket`) VALUES
(2, 'wanasari', 8, 'aktif'),
(4, 'Bunga Indah', 8, 'aktif'),
(5, 'Cahaya Pammase', 14, 'aktif'),
(6, 'Sinar Tabaroge', 10, 'aktif'),
(7, 'Dongi-Dongi Jaya', 15, 'aktif'),
(8, 'Makkaritutu', 26, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `petani_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id`, `tgl_permintaan`, `petani_id`) VALUES
(1, '2022-01-28', 36),
(2, '2022-01-28', 37),
(3, '2022-01-28', 38),
(4, '2022-01-28', 39),
(5, '2022-01-28', 40),
(6, '2022-01-28', 42),
(7, '2022-01-28', 43),
(8, '2022-01-28', 46),
(9, '2022-01-28', 44);

-- --------------------------------------------------------

--
-- Table structure for table `petani`
--

CREATE TABLE `petani` (
  `id` int(11) NOT NULL,
  `kelompok_id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petani`
--

INSERT INTO `petani` (`id`, `kelompok_id`, `nik`, `nama`) VALUES
(36, 8, '7324060101870004', 'SAMSUDDIN'),
(37, 8, '7324064209860001', 'AMALIA EKA YULIANDIRA'),
(38, 8, '7324060107530019', 'SAHRIR JALLO'),
(39, 8, '7324060702960001', 'MUH. JAFAR SAHRIR'),
(40, 8, '7315015605980001', 'IRMAYANTI'),
(42, 8, '7324055012720001', 'KARTINI'),
(43, 8, '7324062405650001', 'ABD. HAFID'),
(44, 8, '7324061302810001', 'ABIDIN AMIR'),
(45, 8, '7315036812900003', 'RATNAWATI'),
(46, 8, '7324067112780004', 'NURLINA'),
(47, 8, '7315034411790001', 'KASMAH'),
(48, 8, '7324062803880002', 'AKMAL'),
(49, 8, '7324060107700016', 'NASRUNG'),
(50, 8, '7324064801600001', 'MASNA'),
(51, 8, '7324060505810003', 'BAKRI'),
(52, 8, '7324065012880002', 'NASMA'),
(53, 8, '7324065912940002', 'SITTI KABIAH'),
(54, 8, '7324064107840007', 'MARIYANA S'),
(55, 8, '7324061608800001', 'ABDUL KADIR'),
(56, 8, '6403053112680006', 'ALIFUDDIN'),
(57, 8, '6403057012770003', 'DARAWATI'),
(58, 8, '7324060107850008', 'MUNAWIR'),
(59, 8, '7315116402890002', 'NURAENI'),
(60, 8, '7324061004640001', 'MURSON'),
(61, 8, '7324064107680014', 'BAHARIA'),
(63, 2, '7324060310720001', 'MUHAMMAD YUNUS'),
(64, 2, '7324060107450053', 'ANDI MING'),
(65, 2, '7324060611920001', 'ANDI MASDAR'),
(66, 2, '7324061001900001', 'ARDILLAH ABU'),
(67, 2, '7324060204830001', 'ANDI ALI ALATAS'),
(68, 2, '7324060107450051', 'ANDI YUSRI'),
(69, 2, '7324064611670002', 'SITTI TANG'),
(70, 2, '7324063112710029', 'SALAHUDDING'),
(71, 2, '7324063112650024', 'ABU BAKAR');

-- --------------------------------------------------------

--
-- Table structure for table `pupuk`
--

CREATE TABLE `pupuk` (
  `id` int(11) NOT NULL,
  `nama_pupuk` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pupuk`
--

INSERT INTO `pupuk` (`id`, `nama_pupuk`, `stock`, `harga`) VALUES
(1, 'NPK', 103300, 2300),
(2, 'UREA', 39955, 2250),
(3, 'ZA', 103450, 1700),
(4, 'SP-36', 30000, 2400),
(5, 'ORGANIK GRANUL', 15000, 800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jatah`
--
ALTER TABLE `jatah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petani`
--
ALTER TABLE `petani`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pupuk`
--
ALTER TABLE `pupuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jatah`
--
ALTER TABLE `jatah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `petani`
--
ALTER TABLE `petani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `pupuk`
--
ALTER TABLE `pupuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
