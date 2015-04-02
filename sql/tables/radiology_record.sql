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
  KEY `radiologist_id` (`radiologist_id`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiology_record`
--

INSERT INTO `radiology_record` (`record_id`, `patient_id`, `doctor_id`, `radiologist_id`, `test_type`, `prescribing_date`, `test_date`, `diagnosis`, `description`) VALUES
(1, 999999, 1265, 33333, 'blood test', '2015-03-16', '2015-03-18', 'normal', 'Everything appears normal.'),
(2, 99799789, 1234, 22222, 'blood test', '2015-03-17', '2015-03-18', 'normal', 'Only a bit low on vitamin D.'),
(3, 659787, 123456, 11111, 'cancer', '2015-05-01', '2015-05-02', 'positive', 'last stage'),
(4, 659787, 123456, 11111, 'cancer', '2015-05-01', '2015-05-02', 'positive', 'final stage');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
