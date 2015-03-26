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
-- Table structure for table `radiology_record`
--

CREATE TABLE IF NOT EXISTS `radiology_record` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `radiologist_id` int(11) NOT NULL,
  `test_type` varchar(100) NOT NULL,
  `prescribing_date` date NOT NULL,
  `test_date` date NOT NULL,
  `diagnosis` varchar(1000) NOT NULL,
  `description` varchar(4000) NOT NULL,
  PRIMARY KEY (`record_id`),
  KEY `description` (`description`(767)),
  FULLTEXT KEY `description_2` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiology_record`
--

INSERT INTO `radiology_record` (`record_id`, `patient_id`, `doctor_id`, `radiologist_id`, `test_type`, `prescribing_date`, `test_date`, `diagnosis`, `description`) VALUES
(1, 11, 101, 1001, 'blood test', '2015-03-16', '2015-03-18', 'normal', 'Everything appears normal.'),
(2, 12, 102, 1002, 'blood test', '2015-03-17', '2015-03-18', 'normal', 'Only a bit low on vitamin D.'),
(3, 13, 101, 123456, 'blood test', '2015-03-16', '2015-03-18', 'abnormal', 'High concentration of shroom spores.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
