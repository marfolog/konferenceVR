-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 12:54 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konference_vr_db`
--
CREATE DATABASE IF NOT EXISTS `konference_vr_db` DEFAULT CHARACTER SET utf16 COLLATE utf16_czech_ci;
USE `konference_vr_db`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `author` varchar(32) COLLATE utf16_czech_ci DEFAULT NULL,
  `title` varchar(32) COLLATE utf16_czech_ci NOT NULL,
  `text` text COLLATE utf16_czech_ci NOT NULL,
  `path_to_file` varchar(64) COLLATE utf16_czech_ci DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf16_czech_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_czech_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `date`, `author`, `title`, `text`, `path_to_file`, `status`) VALUES
(117, '2019-01-14', 'autor_2', 'Unity 3D - c#?', 'Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract Abstract \r\nÄŒeÅ¡tina ÄŒeÅ¡tina ÄŒeÅ¡tina ÄŒeÅ¡tina ÄŒeÅ¡tina ', '../uploads/tahak-na-zkousku_5011.pdf', '0'),
(118, '2019-01-13', 'autor_2', 'Titulek', ' Abstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract AbstractAbstract Abstract', '../uploads/DB1_5054.pdf', '0'),
(119, '2019-01-14', 'autor_1', 'HTC vive', 'NovÃ¡ technologie?', '../uploads/DB1_0514.pdf', '1'),
(120, '2019-01-13', 'autor_1', 'Knihovna VRTK', 'NovÃ¡ technologie?', '../uploads/tahak-na-zkousku_5228.pdf', '0'),
(122, '2019-01-14', 'autor_2', 'HTC vive', 'HTC vive v.46', '../uploads/DB1_1322.pdf', '0');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `id_reviewer` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `op_1` int(11) NOT NULL,
  `op_2` int(11) NOT NULL,
  `op_3` int(11) NOT NULL,
  `op_4` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_czech_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `id_reviewer`, `id_article`, `op_1`, `op_2`, `op_3`, `op_4`, `total`) VALUES
(71, 128, 119, 1, 2, 3, 4, 2.5),
(72, 128, 117, 3, 3, 3, 3, 3),
(73, 129, 117, 0, 0, 0, 0, 0),
(74, 128, 118, 1, 5, 1, 5, 3),
(75, 129, 118, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `status` enum('autor','admin','recenzent') COLLATE utf16_czech_ci NOT NULL DEFAULT 'autor',
  `login` varchar(32) COLLATE utf16_czech_ci NOT NULL,
  `password` varchar(32) COLLATE utf16_czech_ci NOT NULL,
  `block` enum('true','false') COLLATE utf16_czech_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_czech_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status`, `login`, `password`, `block`) VALUES
(77, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'false'),
(126, 'autor', 'autor_1', '69bf5e66cdb022fc1ef2ccecb73d674e', 'false'),
(127, 'autor', 'autor_2', 'e0b7ef371a53ad663fc194bacc24e356', 'false'),
(128, 'recenzent', 'recenzent_1', '6489ecd3539de45c9163370df91eab53', 'false'),
(129, 'recenzent', 'recenzent_2', '0605d29c941a0d2ef34fce360e05d49f', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
