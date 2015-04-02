-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2015 at 01:03 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `radiology`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_name` varchar(24) NOT NULL DEFAULT '',
  `password` varchar(24) DEFAULT NULL,
  `class` char(1) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `date_registered` date DEFAULT NULL,
  PRIMARY KEY (`user_name`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `password`, `class`, `person_id`, `date_registered`) VALUES
('derp1111', '123456789', 'p', 99799789, '2015-03-01'),
('derp2222', '123456789', 'r', 22222, '2015-03-01'),
('ejlo', '12', 'a', 659787, '2015-03-01'),
('ejlo2', '123456789', 'r', 33333, '2015-03-01'),
('herp1', '123456789', 'r', 11111, '2015-03-01'),
('herp2', '123456789', 'p', 999999, '2015-03-01'),
('sam9116', '123456789', 'd', 123456, '2015-03-02'),
('sam9117', '123456789', 'd', 1234, '2015-03-12'),
('uio0000', '123456789', 'd', 1265, '2015-03-01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
