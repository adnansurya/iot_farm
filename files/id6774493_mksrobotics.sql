-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2019 at 02:36 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id6774493_mksrobotics`
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
(1, 'penyiraman', 'OFF');

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
  `gambar` varchar(200) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iot_farm_monitor`
--

INSERT INTO `iot_farm_monitor` (`id`, `suhu_udara`, `lembab_udara`, `lembab_tanah`, `ph_tanah`, `gambar`, `waktu`) VALUES
(1, 32, 49, 1, 0, '2019-10-09 00:05:46.jpg', '2019-10-09 00:05:46'),
(2, 32, 49, 1, 0, '2019-10-09 00:09:39.jpg', '2019-10-09 00:09:39'),
(3, 32, 48, 1, 0, '2019-10-09 00:09:50.jpg', '2019-10-09 00:09:50'),
(4, 32, 48, 1, 0, '2019-10-09 00:10:00.jpg', '2019-10-09 00:10:00'),
(5, 32, 48, 1, 0, '2019-10-09 00:10:08.jpg', '2019-10-09 00:10:08'),
(6, 32, 48, 1, 0, '2019-10-09 00:11:16.jpg', '2019-10-09 00:11:16'),
(7, 32, 49, 1, 0, '2019-10-09 00:12:01.jpg', '2019-10-09 00:12:01'),
(8, 32, 48, 1, 0, '2019-10-09 00:12:49.jpg', '2019-10-09 00:12:49'),
(9, 32, 48, 1, 0, '2019-10-09 00:13:09.jpg', '2019-10-09 00:13:09'),
(10, 32, 46, 1, 0, '2019-10-09 00:19:08.jpg', '2019-10-09 00:19:08'),
(11, 32, 46, 1, 0, '2019-10-09 00:19:25.jpg', '2019-10-09 00:19:25'),
(12, 32, 46, 1, 0, '2019-10-09 00:19:31.jpg', '2019-10-09 00:19:31'),
(13, 32, 46, 1, 0, '2019-10-09 00:19:51.jpg', '2019-10-09 00:19:51'),
(14, 32, 47, 1, 0, '2019-10-09 00:20:33.jpg', '2019-10-09 00:20:33'),
(15, 32, 47, 1, 0, '2019-10-09 00:21:12.jpg', '2019-10-09 00:21:12'),
(16, 32, 46, 1, 0, '2019-10-09 00:21:30.jpg', '2019-10-09 00:21:30'),
(17, 32, 46, 1, 0, '2019-10-09 00:21:36.jpg', '2019-10-09 00:21:36'),
(18, 32, 46, 1, 0, '2019-10-09 00:21:42.jpg', '2019-10-09 00:21:42'),
(19, 32, 46, 1, 0, '2019-10-09 00:22:31.jpg', '2019-10-09 00:22:31'),
(20, 32, 46, 1, 0, '2019-10-09 00:22:39.jpg', '2019-10-09 00:22:39'),
(21, 32, 46, 1, 0, '2019-10-09 00:22:54.jpg', '2019-10-09 00:22:54'),
(22, 32, 46, 1, 0, '2019-10-09 00:23:15.jpg', '2019-10-09 00:23:15'),
(23, 32, 46, 1, 0, '2019-10-09 00:23:22.jpg', '2019-10-09 00:23:22'),
(24, 32, 46, 1, 0, '2019-10-09 00:23:41.jpg', '2019-10-09 00:23:41'),
(25, 32, 46, 1, 0, '2019-10-09 00:24:17.jpg', '2019-10-09 00:24:17'),
(26, 32, 46, 1, 0, '2019-10-09 00:24:28.jpg', '2019-10-09 00:24:28'),
(27, 32, 46, 1, 0, '2019-10-09 00:24:46.jpg', '2019-10-09 00:24:46'),
(28, 32, 46, 1, 0, '2019-10-09 00:24:56.jpg', '2019-10-09 00:24:56');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
