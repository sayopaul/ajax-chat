-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2017 at 07:51 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.1.1-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatter`
--

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(10) NOT NULL,
  `tracking_number` varchar(150) NOT NULL,
  `buyer_name` varchar(200) NOT NULL,
  `buyer_email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `deliverer` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `tracking_number`, `buyer_name`, `buyer_email`, `password`, `deliverer`, `state`) VALUES
(1, 'blazeh123', 'sayo', 'sayo@blazeh.com', '$2y$10$ooRg7oqkKh700P5PljRuCubEVd04YX/s0x5lDv/Rvz7k5HmPrW8Ii', 'okonkwo', 'active'),
(2, 'blazeh456', 'oke', 'oke@blazeh.com', 'random', 'okonkwo', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
