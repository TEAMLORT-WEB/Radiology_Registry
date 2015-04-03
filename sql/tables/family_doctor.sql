-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2015 at 01:01 AM
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family_doctor`
--
ALTER TABLE `family_doctor`
  ADD CONSTRAINT `family_doctor_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `persons` (`person_id`),
  ADD CONSTRAINT `family_doctor_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `persons` (`person_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
