-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2020 at 07:55 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `international`
--

CREATE TABLE `international` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `threshold` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `international`
--

INSERT INTO `international` (`id`, `url`, `threshold`) VALUES
(10, 'https://api.spotify.com/v1/playlists/6TKv64XVTGNTXv0JENLNwt', 700),
(11, 'https://api.spotify.com/v1/playlists/6ThcIVNpR3uLxZSKLn8Y8s', 900),
(12, 'https://api.spotify.com/v1/playlists/7vIt0GWLgi9MVAvcu0XVwq', 8500),
(13, 'https://api.spotify.com/v1/playlists/3Th8EdtonvAdoOZR48ne8C', 7000),
(14, 'https://api.spotify.com/v1/playlists/0mRxL2t9WN3q3ty7JocPoG', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `italy`
--

CREATE TABLE `italy` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `threshold` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `italy`
--

INSERT INTO `italy` (`id`, `url`, `threshold`) VALUES
(42, 'https://api.spotify.com/v1/playlists/3QTuRDejnCMzgdf55wa8KY', 800),
(43, 'https://api.spotify.com/v1/playlists/0sKsUQ5wIzB0vyWtY5Q8DT', 1000),
(44, 'https://api.spotify.com/v1/playlists/7BWS6oYICY9ocR8tH8qdLj', 1008),
(45, 'https://api.spotify.com/v1/playlists/21Aa9e3LWsge0wTqqR72Y3', 2000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `international`
--
ALTER TABLE `international`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `italy`
--
ALTER TABLE `italy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `international`
--
ALTER TABLE `international`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `italy`
--
ALTER TABLE `italy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
