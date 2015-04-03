-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2015 at 01:02 AM
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
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `person_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(24) DEFAULT NULL,
  `last_name` varchar(24) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `first_name`, `last_name`, `address`, `email`, `phone`) VALUES
(1234, 'Derp', 'Herp', '111 main street', 'serd@ualberta.ca', '7805515522'),
(1265, 'Derp', 'Herp', '111 main street', 'vdfggnnd@ualberta.ca', '7805515522'),
(11111, 'Sam', 'Bao', '111 main street', 'sdvdsdcv@ualberta.ca', '7805515522'),
(22222, 'Derp', 'Herp', '111 main street', 'sxcvcxo@ualberta.ca', '7805515522'),
(33333, 'Tayler', 'Davis', '111 main street', 'zxcxzc@ualberta.ca', '7805515522'),
(123456, 'Sam', 'Bao', '111 main street', '1234@ualberta.ca', '7805515522'),
(659787, 'Tayler', 'Davis', '111 main street', 'xcbvcxv@ualberta.ca', '7805515522'),
(999999, 'Sam', 'Bao', '111 main street', 'sdfvds@ualberta.ca', '7805515522'),
(99799789, 'Derp', 'Herp', '111 main street', 'xcvxcvo@ualberta.ca', '7805515522');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
