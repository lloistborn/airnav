-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2016 at 01:05 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airnav`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_maskapai`
--

CREATE TABLE `data_maskapai` (
  `id` int(9) NOT NULL,
  `nama_pesawat` varchar(255) DEFAULT NULL,
  `kategori_tarif` varchar(100) DEFAULT NULL,
  `faktor_berat` int(8) DEFAULT NULL,
  `faktor_jarak` int(8) DEFAULT NULL,
  `unit_rate_flight_dom` float DEFAULT NULL,
  `unit_rate_flight_int` float DEFAULT NULL,
  `alokasi` float DEFAULT NULL,
  `bobot_saw` decimal(10,2) DEFAULT NULL,
  `harga` decimal(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_maskapai`
--

INSERT INTO `data_maskapai` (`id`, `nama_pesawat`, `kategori_tarif`, `faktor_berat`, `faktor_jarak`, `unit_rate_flight_dom`, `unit_rate_flight_int`, `alokasi`, `bobot_saw`, `harga`) VALUES
(0, 'Air Asia and Citilink', 'A1', 93000, 3000, 0.65, 0.6, 0.4, '2.76', '1112000.00'),
(1, NULL, 'A2', 95000, 2000, 0.5, 0.65, 0.5, '2.44', '72280.00'),
(2, NULL, 'A3', 95000, 1500, 0.75, 0.65, 0.2, '1.72', '3336000.00'),
(3, NULL, 'A4', 95000, 25000, 0.75, 0.25, 0.35, '3.24', '1112000.00'),
(4, 'Garuda AZHT', 'A45', 95120, 4000, 0.7, 0.9, 0.98, '3.40', '72280.00'),
(5, 'Air Asia YYYY', 'A6', 1, 0, 0.3, 0.3, 4300, '1.48', '722800.00');

-- --------------------------------------------------------

--
-- Table structure for table `data_pesawat`
--

CREATE TABLE `data_pesawat` (
  `id` int(9) NOT NULL,
  `nama_pesawat` varchar(20) DEFAULT NULL,
  `kategori_tarif` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pesawat`
--

INSERT INTO `data_pesawat` (`id`, `nama_pesawat`, `kategori_tarif`) VALUES
(1, NULL, NULL),
(2, 'Air Asia ZZZ', 'A6');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` smallint(100) NOT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `type`) VALUES
(1, 'admin'),
(2, 'maskapai'),
(3, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` tinyint(100) NOT NULL,
  `id_role` tinyint(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_role`, `username`, `password`) VALUES
(1, 1, 'admin', 'dfgh'),
(2, 2, 'admin_maskapai', 'dfgh'),
(3, 3, 'manager', 'dfgh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_maskapai`
--
ALTER TABLE `data_maskapai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pesawat`
--
ALTER TABLE `data_pesawat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_maskapai`
--
ALTER TABLE `data_maskapai`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `data_pesawat`
--
ALTER TABLE `data_pesawat`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
