-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2015 at 06:32 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `employee_id` (`employee_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
