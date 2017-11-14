-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2017 at 04:34 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multiupload`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(12) NOT NULL,
  `firstname` varchar(55) COLLATE utf8mb4_german2_ci NOT NULL,
  `lastname` varchar(55) COLLATE utf8mb4_german2_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_german2_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_german2_ci NOT NULL,
  `biography` text COLLATE utf8mb4_german2_ci NOT NULL,
  `angkatan` enum('angkatan_1','angkatan_2','','') COLLATE utf8mb4_german2_ci NOT NULL,
  `website` varchar(120) COLLATE utf8mb4_german2_ci NOT NULL,
  `img` varchar(220) COLLATE utf8mb4_german2_ci NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `date_deleted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
