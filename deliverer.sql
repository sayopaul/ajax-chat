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
-- Table structure for table `deliverer`
--

CREATE TABLE `deliverer` (
  `d_id` int(20) NOT NULL,
  `deliverer_name` varchar(150) NOT NULL,
  `deliverer_email` varchar(150) NOT NULL,
  `deliverer_user_name` varchar(150) NOT NULL,
  `deliverer_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliverer`
--

INSERT INTO `deliverer` (`d_id`, `deliverer_name`, `deliverer_email`, `deliverer_user_name`, `deliverer_password`) VALUES
(1, 'Okonkwo Ezeremokem Chidubem', 'okonkwo@konga.com', 'okonkwo', '$2y$10$HEQ.krtI9k8f4ywCPxu/IOk9B/o0ct2VXtGze8ddTYK0U3oXDa6re');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deliverer`
--
ALTER TABLE `deliverer`
  ADD PRIMARY KEY (`d_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deliverer`
--
ALTER TABLE `deliverer`
  MODIFY `d_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
