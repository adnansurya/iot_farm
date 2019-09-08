-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 12:38 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `iot_farm_kontrol`
--

CREATE TABLE `iot_farm_kontrol` (
  `id` int(11) NOT NULL,
  `params` varchar(10) NOT NULL,
  `value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iot_farm_kontrol`
--

INSERT INTO `iot_farm_kontrol` (`id`, `params`, `value`) VALUES
(1, 'penyiraman', 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `iot_farm_monitor`
--

CREATE TABLE `iot_farm_monitor` (
  `id` int(11) NOT NULL,
  `suhu_udara` float NOT NULL,
  `lembab_udara` float NOT NULL,
  `lembab_tanah` float NOT NULL,
  `ph_tanah` float NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iot_farm_monitor`
--

INSERT INTO `iot_farm_monitor` (`id`, `suhu_udara`, `lembab_udara`, `lembab_tanah`, `ph_tanah`, `waktu`) VALUES
(1, 12.5, 1.1, 2.2, 0.1, '2019-09-09 06:07:06'),
(2, 3.2, 4.2, 1.8, 0.9, '2019-09-09 06:07:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iot_farm_kontrol`
--
ALTER TABLE `iot_farm_kontrol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_farm_monitor`
--
ALTER TABLE `iot_farm_monitor`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iot_farm_kontrol`
--
ALTER TABLE `iot_farm_kontrol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iot_farm_monitor`
--
ALTER TABLE `iot_farm_monitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
