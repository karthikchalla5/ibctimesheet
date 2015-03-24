-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2015 at 09:47 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ibctimesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_employee`
--

CREATE TABLE IF NOT EXISTS `project_employee` (
  `project_id` int(4) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `role` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_employee`
--

INSERT INTO `project_employee` (`project_id`, `employee_id`, `role`) VALUES
(1, '0001', 1),
(1, '1115', 1),
(1, '11156', 1),
(2, '1116', 1),
(1, '1116', 2),
(2, '11156', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_employee`
--
ALTER TABLE `project_employee`
 ADD PRIMARY KEY (`project_id`,`employee_id`), ADD KEY `project_id` (`project_id`,`employee_id`), ADD KEY `employee_id` (`employee_id`), ADD KEY `project_id_2` (`project_id`), ADD KEY `role` (`role`), ADD KEY `role_2` (`role`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_employee`
--
ALTER TABLE `project_employee`
ADD CONSTRAINT `project_employee_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `project_employee_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
