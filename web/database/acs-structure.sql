-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2020 at 03:18 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acs`
--

-- --------------------------------------------------------

--
-- Table structure for table `datapoints`
--

CREATE TABLE `datapoints` (
  `id` int(11) NOT NULL,
  `temperature` float NOT NULL DEFAULT -1,
  `humidity` float NOT NULL DEFAULT -1,
  `ph` float NOT NULL DEFAULT -1,
  `reservoir` float NOT NULL DEFAULT -1,
  `nitrogen` int(11) NOT NULL DEFAULT -1,
  `phosphorous` int(11) NOT NULL DEFAULT -1,
  `kalium` int(11) NOT NULL DEFAULT -1,
  `moisture` int(11) NOT NULL DEFAULT -1,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(15) NOT NULL DEFAULT '''ABNORMAL'''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disease_data`
--

CREATE TABLE `disease_data` (
  `id` int(16) NOT NULL,
  `image` varchar(500) NOT NULL,
  `bacterial_blight` float NOT NULL,
  `bacterial_spot` float NOT NULL,
  `black_rot` float NOT NULL,
  `mosaic_virus` float NOT NULL,
  `normal` float NOT NULL,
  `powedry_mildew` float NOT NULL,
  `rust` float NOT NULL,
  `scab` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Disease data';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datapoints`
--
ALTER TABLE `datapoints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease_data`
--
ALTER TABLE `disease_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disease_data`
--
ALTER TABLE `disease_data`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
