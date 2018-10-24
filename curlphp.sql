-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 07:54 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `curlphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--
-- Creation: Oct 23, 2018 at 03:00 AM
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sort_order` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `sort_order`) VALUES
(1, 'USA', 1),
(2, 'India', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--
-- Creation: Oct 23, 2018 at 04:06 AM
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(100) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_mobile_number` varchar(12) NOT NULL,
  `emp_profile_image` text NOT NULL,
  `emp_gender` enum('M','F') NOT NULL DEFAULT 'M' COMMENT 'M=Male, F = Female',
  `emp_country_id` int(11) NOT NULL,
  `emp_state_id` int(11) NOT NULL,
  `emp_city_name` varchar(50) NOT NULL,
  `emp_reporting_manager` int(11) DEFAULT NULL COMMENT 'reporting manager is emp id',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emp_email` (`emp_email`),
  KEY `emp_state_id` (`emp_state_id`),
  KEY `emp_country_id` (`emp_country_id`),
  KEY `emp_reporting_manager` (`emp_reporting_manager`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_name`, `emp_email`, `emp_mobile_number`, `emp_profile_image`, `emp_gender`, `emp_country_id`, `emp_state_id`, `emp_city_name`, `emp_reporting_manager`, `created_date`, `updated_date`) VALUES
(33, 'janak222', 'ka344@gmai..com', '9427980204', '201810232210493299.jpg', 'M', 1, 2, 'ak', NULL, '2018-10-23 20:10:49', '2018-10-23 20:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `emp_subject_relation`
--
-- Creation: Oct 23, 2018 at 03:54 AM
--

CREATE TABLE IF NOT EXISTS `emp_subject_relation` (
  `emp_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  KEY `subject_id` (`subject_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_subject_relation`
--

INSERT INTO `emp_subject_relation` (`emp_id`, `subject_id`) VALUES
(33, 1),
(33, 4),
(33, 9);

-- --------------------------------------------------------

--
-- Table structure for table `opt_expiry`
--
-- Creation: Oct 22, 2018 at 03:28 PM
--

CREATE TABLE IF NOT EXISTS `opt_expiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `opt_number` varchar(10) NOT NULL,
  `is_expired` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not expire,1 expire',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opt_expiry`
--

INSERT INTO `opt_expiry` (`id`, `user_id`, `opt_number`, `is_expired`, `create_at`) VALUES
(1, 1, '512893', 1, '2018-10-22 19:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--
-- Creation: Oct 23, 2018 at 03:05 AM
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id_inex` (`country_id`),
  KEY `sort_order` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `country_id`, `sort_order`) VALUES
(1, 'Alabama', 1, 1),
(2, 'Alaska', 1, 2),
(3, 'Arkansas', 1, 3),
(4, 'Gujarat', 2, 4),
(5, 'Rasthan', 2, 5),
(6, 'Punjab', 2, 6),
(7, 'Madhya Pradesh', 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--
-- Creation: Oct 23, 2018 at 02:55 AM
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'C++'),
(2, 'PHP'),
(3, 'JAVA'),
(4, '.NET'),
(5, 'Wordpress'),
(6, 'Magento'),
(7, 'Core PHP'),
(8, 'Node.js'),
(9, 'Angular'),
(10, 'Rect js');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Oct 22, 2018 at 06:17 PM
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_date`, `updated_date`) VALUES
(1, 'janak kanani', 'janak@gmail.com', '1234566790', '2018-10-22 15:21:01', '2018-10-22 16:10:49'),
(2, 'Admin', 'admin@test.com', '1234567890', '2018-10-22 15:21:01', '2018-10-22 16:10:49');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`emp_state_id`) REFERENCES `state` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`emp_country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`emp_reporting_manager`) REFERENCES `employee` (`id`);

--
-- Constraints for table `emp_subject_relation`
--
ALTER TABLE `emp_subject_relation`
  ADD CONSTRAINT `emp_subject_relation_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `emp_subject_relation_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table country
--

--
-- Metadata for table employee
--

--
-- Metadata for table emp_subject_relation
--

--
-- Metadata for table opt_expiry
--

--
-- Metadata for table state
--

--
-- Metadata for table subjects
--

--
-- Metadata for table users
--

--
-- Metadata for database curlphp
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
