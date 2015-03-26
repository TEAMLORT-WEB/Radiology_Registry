-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2015 at 08:09 PM
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
  `user_name` char(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `class` int(1) NOT NULL,
  `person_id` int(50) NOT NULL,
  `date_registered` date NOT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='stores the name, password, class of, person_id,and time registered for each user';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `password`, `class`, `person_id`, `date_registered`) VALUES
('sam9116', '123456789', 2, 123456, '2015-03-02'),
('admin', 'admin', 3, 1, '2015-03-16'),
('mario', 'peach', 1, 101, '2015-03-19'),
('toad', 'badger', 0, 13, '2015-03-19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
