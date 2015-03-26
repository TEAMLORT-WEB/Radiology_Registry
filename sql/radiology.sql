-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2015 at 12:33 AM
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
-- Table structure for table `family_doctor`
--

CREATE TABLE IF NOT EXISTS `family_doctor` (
  `doctor_id` int(11) NOT NULL DEFAULT '0',
  `patient_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doctor_id`,`patient_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family_doctor`
--

INSERT INTO `family_doctor` (`doctor_id`, `patient_id`) VALUES
(123456, 659787),
(1265, 999999),
(1234, 99799789);

-- --------------------------------------------------------

--
-- Table structure for table `pacs_images`
--

CREATE TABLE IF NOT EXISTS `pacs_images` (
  `record_id` int(11) NOT NULL DEFAULT '0',
  `image_id` int(11) NOT NULL DEFAULT '0',
  `thumbnail` blob,
  `regular_size` blob,
  `full_size` blob,
  PRIMARY KEY (`record_id`,`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  UNIQUE KEY `email` (`email`),
  KEY `person_id` (`person_id`)
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

-- --------------------------------------------------------

--
-- Table structure for table `radiology_record`
--

CREATE TABLE IF NOT EXISTS `radiology_record` (
  `record_id` int(11) NOT NULL DEFAULT '0',
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `radiologist_id` int(11) DEFAULT NULL,
  `test_type` varchar(24) DEFAULT NULL,
  `prescribing_date` date DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `diagnosis` varchar(128) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `radiologist_id` (`radiologist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiology_record`
--

INSERT INTO `radiology_record` (`record_id`, `patient_id`, `doctor_id`, `radiologist_id`, `test_type`, `prescribing_date`, `test_date`, `diagnosis`, `description`) VALUES
(1, 999999, 1265, 33333, 'blood test', '2015-03-16', '2015-03-18', 'normal', 'Everything appears normal.'),
(2, 99799789, 1234, 22222, 'blood test', '2015-03-17', '2015-03-18', 'normal', 'Only a bit low on vitamin D.'),
(3, 659787, 123456, 11111, 'cancer', '2015-05-01', '2015-05-02', 'positive', 'last stage');

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
('ejlo', '123456789', 'p', 659787, '2015-03-01'),
('ejlo2', '123456789', 'r', 33333, '2015-03-01'),
('herp1', '123456789', 'r', 11111, '2015-03-01'),
('herp2', '123456789', 'p', 999999, '2015-03-01'),
('sam9116', '123456789', 'd', 123456, '2015-03-02'),
('sam9117', '123456789', 'd', 1234, '2015-03-12'),
('uio0000', '123456789', 'd', 1265, '2015-03-01');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family_doctor`
--
ALTER TABLE `family_doctor`
  ADD CONSTRAINT `family_doctor_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `persons` (`person_id`),
  ADD CONSTRAINT `family_doctor_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `persons` (`person_id`);

--
-- Constraints for table `pacs_images`
--
ALTER TABLE `pacs_images`
  ADD CONSTRAINT `pacs_images_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `radiology_record` (`record_id`);

--
-- Constraints for table `radiology_record`
--
ALTER TABLE `radiology_record`
  ADD CONSTRAINT `radiology_record_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `persons` (`person_id`),
  ADD CONSTRAINT `radiology_record_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `persons` (`person_id`),
  ADD CONSTRAINT `radiology_record_ibfk_3` FOREIGN KEY (`radiologist_id`) REFERENCES `persons` (`person_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
