-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2015 at 11:51 AM
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
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `designation_id` int(3) NOT NULL,
  `designation` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation`) VALUES
(1, 'Developer'),
(2, 'Team leader'),
(3, 'Manager'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` varchar(20) NOT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `designation_id` int(3) NOT NULL,
  `official_mail_id` varchar(30) DEFAULT NULL,
  `personal_mail_id` varchar(30) DEFAULT NULL,
  `contact_number` bigint(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `designation_id`, `official_mail_id`, `personal_mail_id`, `contact_number`, `address`) VALUES
('0001', 'Mahesh_admin', 4, 'mahesh@gmail.com', 'mahesh@gmail.com', 7897897898, 'jntuyhyd'),
('1115', 'Challa V N Karthik Kumar', 3, 'polamaheshbabu@gmail.com', 'kumar159753@gmail.com', 9494319679, 'Room No. 119\nGodavari Hostel, JNTU, Kukatpally'),
('11156', 'Avinash', 1, 'kumar159753@gmail.com', 'kumar159753@gmail.com', 9493196794, 'Room No. 119\nGodavari Hostel, JNTU, Kukatpally'),
('1116', 'mahesh', 2, 'mahesh.pola@ideabytes.com', 'princemahesh134@gmail.com', 94943196679, 'jntuh kukatpally');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `task_id` int(4) NOT NULL,
  `fail_id` int(4) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `file_size` int(10) NOT NULL,
  `file_link` varchar(100) NOT NULL,
  `file_type` longtext NOT NULL,
  `file_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(4) NOT NULL,
  `project_name` varchar(30) DEFAULT NULL,
  `project_manager` varchar(20) NOT NULL,
  `client_name` varchar(30) DEFAULT NULL,
  `client_mail_id` varchar(30) DEFAULT NULL,
  `client_number` bigint(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_manager`, `client_name`, `client_mail_id`, `client_number`, `start_date`, `end_date`) VALUES
(1, 'Ibctimesheet', '1115', '', '', 0, '2015-12-31', '2016-12-31'),
(2, 'Ibctimesheet1', '0001', '', '', 0, '2016-12-31', '2017-12-31');

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
(1, '1116', 1),
(2, '11156', 1),
(2, '1116', 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_employee_task`
--

CREATE TABLE IF NOT EXISTS `project_employee_task` (
  `project_id` int(4) NOT NULL,
  `task_id` int(4) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `assigned_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_employee_task`
--

INSERT INTO `project_employee_task` (`project_id`, `task_id`, `employee_id`, `assigned_by`) VALUES
(1, 1, '11156', ''),
(1, 2, '11156', ''),
(1, 3, '11156', ''),
(1, 4, '11156', ''),
(1, 5, '11156', ''),
(2, 6, '11156', ''),
(2, 7, '11156', ''),
(2, 8, '11156', '1116'),
(2, 9, '11156', ''),
(2, 10, '11156', ''),
(1, 11, '1116', ''),
(1, 12, '1116', ''),
(2, 13, '1116', ''),
(2, 14, '1116', ''),
(1, 15, '11156', ''),
(2, 16, '1116', ''),
(1, 1, '11156', ''),
(1, 18, '1116', ''),
(2, 7, '11156', '');

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE IF NOT EXISTS `signin` (
  `employee_id` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL,
  `salt` varchar(1000) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`employee_id`, `username`, `password`, `salt`, `status`) VALUES
('0001', 'admin', '64496f027f9f9c40bcf4514366e8d4d99a8a80e0b9f471ba67a3a032d02384e9e3229c8059f3ec90c45b5b96972469ba4998d39ccd570f2288e0dda9867a53f8', 'Í8àç×êÉDZ¥I¿Ad4 A« é9Ê´»Õì?"XFmÔÒäEÃ½Ùh‡Ý–Z‡qŸÍÕ¨q>¥fû´0„', 1),
('11156', 'kumar159753@gmail.com', 'a4f09d0daa2b9a4aec180e948801712e0d11a98e6bd215dc5d8bbd0851fbaca370b79cce18c306824d21ba63e6ce5da600d32f0f3e08288cd52c11e594558858', '¶†µvIóÝ0}…fÍ,˜gV§y¶]ˆ»^$«núF¥1ùç …2íÚ·%ÕjÎÙÓì¤\rÇÄî!e¦<rÕeA', 1),
('1116', 'mahesh.pola@ideabytes.com', '418ae93ae05debaeafc78614b738d7ad9b1d3e1e56e606a0ea4bed0d98281fb691fcd8b3af0f482f78f34867ee9f849afb8338e3f6f2d22957dd19ad8ebd6ff5', '˜ü­¨ÕÂ\Zƒ?jØ:”RQ÷ZÓ†[ÂX!4±õ–:-Ò)r[Åœ¹‘_]Iªùž¾N´	B1Û T¿¥5œ', 1),
('1115', 'polamaheshbabu@gmail.com', 'fa5cc004f2a1174d5f7d5ff3181b7b75ff31661db61593f271a33ef842f58e080326ba5945c65424f2f0272f2fa6d7b312155e1e6a6574872292772fb454e618', 'ã 4_+p7ÑÐÁV þä>”0á.¸Ñ±Ü6Dªoß¢\rÄvDä®×*(ó‹4üŸÝµS†ùKÆ¶Èõ„N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `project_id` int(4) DEFAULT NULL,
  `task_id` int(4) NOT NULL,
  `task_name` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `estimated_time` time(6) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `progress` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`project_id`, `task_id`, `task_name`, `status`, `priority`, `description`, `estimated_time`, `start_date`, `due_date`, `progress`) VALUES
(1, 1, 'Task1', 'completed', 'Low', '', '00:00:00.000000', '2015-02-02', '2015-03-15', ''),
(1, 2, 'Task2', 'completed', 'Medium', '', '00:00:00.000000', '2015-02-10', '2015-03-16', ''),
(1, 3, 'Task3', 'pending', 'High', '', '00:00:00.000000', '2015-02-14', '2015-03-17', ''),
(1, 4, 'Task4', 'completed', 'Urgent', '', '00:00:00.000000', '2015-02-16', '2015-03-18', ''),
(1, 5, 'Task5', 'completed', 'High', '', '00:00:00.000000', '2015-02-23', '2015-03-19', ''),
(2, 6, 'Task1', 'completed', 'Low', '', '00:00:00.000000', '2015-02-05', '2015-03-13', ''),
(2, 7, 'Task2', 'Assigned', 'Medium', '', '00:00:00.000000', '2015-02-08', '2015-03-14', ''),
(2, 8, 'Task3', 'completed', 'High', '', '00:00:00.000000', '2015-02-12', '2015-03-17', ''),
(2, 9, 'Task4', 'completed', 'Urgent', '', '00:00:00.000000', '2015-02-26', '2015-03-20', ''),
(2, 10, 'Task5', 'completed', 'Medium', '', '00:00:00.000000', '2015-02-27', '2015-03-21', ''),
(1, 11, 'Task7', 'unassigned', 'Unknown', '', '00:00:00.000000', '2015-04-07', '2015-03-31', ''),
(1, 12, 'Task8', 'unassigned', 'High', '', '00:00:00.000000', '2015-04-22', '2015-04-08', ''),
(2, 13, 'Task7', 'unassigned', 'Unknown', '', '00:00:00.000000', '2015-04-19', '2015-04-21', ''),
(2, 14, 'Task8', 'unassigned', 'Unknown', '', '00:00:00.000000', '2015-04-15', '2015-03-29', ''),
(1, 15, 'Task6', 'inprogress', 'Medium', '', '00:00:00.000000', '2015-01-12', '2015-03-01', ''),
(2, 16, 'Task6', 'completed', 'Unknown', '', '00:00:00.000000', '2015-02-01', '2015-03-09', ''),
(1, 17, 'hjghjghj', 'unassigned', 'Unknown', '', '00:00:00.000000', '0000-00-00', '0000-00-00', ''),
(1, 18, 'Mahesh_task', 'Assigned', 'Unknown', '', '00:00:00.000000', '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE IF NOT EXISTS `task_status` (
  `project_id` int(4) NOT NULL,
  `task_id` int(4) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`project_id`, `task_id`, `note`, `date`, `time`, `type`, `status`) VALUES
(2, 8, '', '2015-03-18', '3:00', 'coding', 'pending'),
(1, 5, '', '2015-03-18', '2:00', 'coding', 'completed'),
(1, 5, '', '2015-03-18', '4:00', 'coding', 'completed'),
(1, 4, '', '2015-03-18', '2:00', 'coding', 'working'),
(1, 4, '', '2015-03-18', '1:00', 'coding', 'pending'),
(1, 4, '', '2015-03-18', '1:00', 'coding', 'completed'),
(1, 2, '', '2015-03-20', '10:15', 'coding', 'completed'),
(2, 7, '', '2015-03-23', '3:05', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '2:05', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '3:00', 'coding', 'completed'),
(1, 4, '', '2015-03-23', '2:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '2:00', 'coding', 'completed'),
(1, 4, '', '2015-03-23', '2:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '5:00', 'coding', 'completed'),
(1, 15, '', '2015-03-23', '2:00', 'coding', 'completed'),
(1, 5, '', '2015-03-23', '2:00', 'coding', 'completed'),
(2, 6, '', '2015-03-23', '3:00', 'coding', 'completed'),
(1, 5, '', '2015-03-23', '2:00', 'coding', 'completed'),
(2, 6, '', '2015-03-23', '3:00', 'analysis', 'completed'),
(1, 1, '', '2015-03-23', '2:00', 'coding', 'onhold'),
(1, 2, '', '2015-03-23', '4:00', 'analysis', 'completed'),
(1, 4, '', '2015-03-23', '5:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '2:00', 'analysis', 'completed'),
(2, 7, '', '2015-03-23', '17:00', 'coding', 'completed'),
(1, 1, '', '2015-03-23', '18:00', 'coding', 'completed'),
(1, 5, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'coding', 'completed'),
(1, 15, '', '2015-03-23', '15:00', 'coding', 'inprogress'),
(2, 10, '', '2015-03-23', '16:00', 'coding', 'onhold'),
(2, 10, '', '2015-03-23', '18:00', 'coding', 'inprogress'),
(1, 15, '', '2015-03-23', '21:00', 'coding', 'inprogress'),
(2, 10, '', '2015-03-23', '13:00', 'coding', 'completed'),
(2, 10, '', '2015-03-23', '14:00', 'coding', 'completed'),
(1, 4, '', '2015-03-23', '14:00', 'coding', 'completed'),
(1, 4, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 7, '', '2015-03-23', '16:00', 'coding', 'completed'),
(1, 1, '', '2015-03-23', '14:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(1, 4, '', '2015-03-23', '17:00', 'coding', 'inprogress'),
(2, 10, '', '2015-03-23', '14:00', 'coding', 'completed'),
(2, 7, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(1, 15, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(1, 15, '', '2015-03-23', '14:00', 'coding', 'inprogress'),
(1, 1, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '17:00', 'analysis', 'completed'),
(1, 4, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 10, '', '2015-03-23', '15:00', 'coding', 'inprogress'),
(2, 7, '', '2015-03-23', '9:00', 'analysis', 'completed'),
(1, 15, '', '2015-03-23', '9:00', 'coding', 'completed'),
(1, 1, '', '2015-03-23', '15:00', 'coding', 'completed'),
(1, 5, '', '2015-03-23', '19:00', 'analysis', 'completed'),
(1, 2, '', '2015-03-23', '16:00', 'coding', 'completed'),
(1, 4, '', '2015-03-23', '16:00', 'coding', 'completed'),
(1, 2, '', '2015-03-23', '17:00', 'analysis', 'inprogress'),
(1, 1, '', '2015-03-23', '15:00', 'testing', 'completed'),
(1, 15, '', '2015-03-23', '15:00', 'coding', 'completed'),
(1, 5, '', '2015-03-23', '3:00', 'testing', 'completed'),
(2, 9, '', '2015-03-23', '14:00', 'coding', 'completed'),
(1, 4, '', '2015-03-23', '16:00', 'coding', 'inprogress'),
(2, 10, '', '2015-03-23', '17:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '13:00', 'coding', 'inprogress'),
(2, 9, '', '2015-03-23', '16:00', 'coding', 'inprogress'),
(1, 4, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '14:00', 'coding', 'completed'),
(2, 10, '', '2015-03-23', '15:00', 'analysis', 'inprogress'),
(1, 4, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'onhold'),
(1, 4, '', '2015-03-23', '16:00', 'coding', 'inprogress'),
(2, 9, '', '2015-03-23', '13:00', 'coding', 'inprogress'),
(1, 2, '', '2015-03-23', '16:00', 'coding', 'inprogress'),
(2, 9, '', '2015-03-23', '12:00', 'analysis', 'inprogress'),
(2, 10, '', '2015-03-23', '14:00', 'coding', 'completed'),
(1, 2, '', '2015-03-23', '14:00', 'coding', 'completed'),
(1, 2, '', '2015-03-23', '14:00', 'coding', 'onhold'),
(2, 8, '', '2015-03-23', '14:00', 'testing', 'onhold'),
(2, 9, '', '2015-03-23', '15:00', 'analysis', 'onhold'),
(2, 9, '', '2015-03-23', '15:00', 'analysis', 'inprogress'),
(2, 6, '', '2015-03-23', '16:00', 'analysis', 'inprogress'),
(2, 6, '', '2015-03-23', '15:00', 'coding', 'inprogress'),
(2, 7, '', '2015-03-23', '16:00', 'coding', 'onhold'),
(2, 7, '', '2015-03-23', '16:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '14:00', 'coding', 'onhold'),
(1, 4, '', '2015-03-23', '13:00', 'analysis', 'completed'),
(2, 10, '', '2015-03-23', '15:00', 'coding', 'completed'),
(1, 2, '', '2015-03-23', '14:00', 'coding', 'inprogress'),
(1, 2, '', '2015-03-23', '14:00', 'coding', 'completed'),
(1, 5, '', '2015-03-23', '14:00', 'analysis', 'completed'),
(2, 8, '', '2015-03-23', '16:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '11:00', 'analysis', 'completed'),
(1, 4, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '11:00', 'testing', 'completed'),
(2, 9, '', '2015-03-23', '11:00', 'testing', 'completed'),
(2, 9, '', '2015-03-23', '14:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '1:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '4:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '3:00', 'analysis', 'completed'),
(2, 7, '', '2015-03-23', '1:00', 'testing', 'completed'),
(2, 9, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(1, 1, '', '2015-03-23', '5:00', 'coding', 'completed'),
(2, 6, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(2, 8, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 8, '', '2015-03-23', '18:00', 'coding', 'completed'),
(2, 6, '', '2015-03-23', '16:00', 'coding', 'completed'),
(2, 8, '', '2015-03-23', '18:00', 'coding', 'inprogress'),
(2, 8, '', '2015-03-23', '18:00', 'coding', 'completed'),
(2, 8, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'testing', 'inprogress'),
(2, 9, '', '2015-03-23', '16:00', 'testing', 'completed'),
(1, 2, '', '2015-03-23', '14:00', 'analysis', 'completed'),
(1, 1, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '14:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '15:00', 'testing', 'completed'),
(2, 9, '', '2015-03-23', '17:00', 'analysis', 'completed'),
(1, 2, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '17:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '15:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '15:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '18:00', 'coding', 'completed'),
(2, 9, '', '2015-03-23', '16:00', 'analysis', 'completed'),
(2, 9, '', '2015-03-23', '23:00', 'coding', 'completed'),
(1, 4, '', '2015-03-23', '15:00', 'coding', 'completed'),
(1, 2, '', '2015-03-24', '16:00', 'coding', 'completed'),
(1, 2, '', '2015-03-24', '14:00', 'analysis', 'completed'),
(2, 10, '', '2015-03-24', '15:00', 'analysis', 'completed'),
(2, 8, '', '2015-03-24', '13:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '13:00', 'testing', 'completed'),
(2, 8, '', '2015-03-24', '13:00', 'analysis', 'completed'),
(1, 15, '', '2015-03-24', '13:00', 'analysis', 'inprogress'),
(2, 8, '', '2015-03-24', '15:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '16:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '17:00', 'analysis', 'completed'),
(2, 8, '', '2015-03-24', '5:00', 'analysis', 'completed'),
(2, 8, '', '2015-03-24', '5:00', 'analysis', 'completed'),
(2, 8, '', '2015-03-24', '1:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '17:00', 'coding', 'inprogress'),
(2, 6, '', '2015-03-24', '15:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '17:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '17:00', 'coding', 'inprogress'),
(2, 8, '', '2015-03-24', '17:00', 'coding', 'inprogress'),
(2, 8, '', '2015-03-24', '17:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '17:00', 'coding', 'completed'),
(2, 8, '', '2015-03-24', '17:00', 'coding', 'completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
 ADD PRIMARY KEY (`designation_id`), ADD KEY `designation_id` (`designation_id`), ADD KEY `designation_id_2` (`designation_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`employee_id`), ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD KEY `task_id` (`task_id`), ADD KEY `task_id_2` (`task_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`project_id`), ADD KEY `project_manager` (`project_manager`);

--
-- Indexes for table `project_employee`
--
ALTER TABLE `project_employee`
 ADD PRIMARY KEY (`project_id`,`employee_id`), ADD KEY `project_id` (`project_id`,`employee_id`), ADD KEY `employee_id` (`employee_id`), ADD KEY `project_id_2` (`project_id`), ADD KEY `role` (`role`), ADD KEY `role_2` (`role`);

--
-- Indexes for table `project_employee_task`
--
ALTER TABLE `project_employee_task`
 ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`task_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
 ADD KEY `task_id` (`task_id`), ADD KEY `project_id` (`project_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`designation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`project_manager`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_employee`
--
ALTER TABLE `project_employee`
ADD CONSTRAINT `project_employee_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `project_employee_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_employee_task`
--
ALTER TABLE `project_employee_task`
ADD CONSTRAINT `project_employee_task_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_status`
--
ALTER TABLE `task_status`
ADD CONSTRAINT `task_status_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `task_status_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
