-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 03, 2021 at 08:04 AM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `royal_side`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `user_id` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `account_category` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `username`, `email`, `password`, `account_category`) VALUES
('5ece4797eaf5e', 'SunPear', 'sunpear.sp@gmail.com', 'de5131bfae926b98c74d9521353782aeeac267fe', 'admin'),
('608b6fe14016c', 'meo meo meo', 'meomeo@gmail.com', 'de5131bfae926b98c74d9521353782aeeac267fe', 'customer'),
('608b72c6adbae', 'abc', 'abc@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_ID` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `adult` smallint(6) NOT NULL,
  `children` smallint(6) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `total_pay` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`booking_ID`),
  KEY `user_booking` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_ID`, `user_id`, `adult`, `children`, `check_in`, `check_out`, `total_pay`) VALUES
('608f8527bcb87', '5ece4797eaf5e', 2, 2, '2021-04-27 13:20:00', '2021-04-27 10:50:00', 300),
('608f85790e4e7', '5ece4797eaf5e', 4, 2, '2021-04-27 13:20:00', '2021-04-27 10:50:00', 700);

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

DROP TABLE IF EXISTS `booking_detail`;
CREATE TABLE IF NOT EXISTS `booking_detail` (
  `booking_ID` varchar(15) NOT NULL,
  `category_ID` varchar(15) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `price_on_day` int(11) NOT NULL,
  PRIMARY KEY (`booking_ID`),
  KEY `booking_room` (`category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`booking_ID`, `category_ID`, `quantity`, `price_on_day`) VALUES
('608f8527bcb87', '608bad5e18355', 2, 150),
('608f85790e4e7', '608baeb342206', 2, 350);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `category_ID` varchar(12) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` varchar(80) DEFAULT NULL,
  `identify_number` varchar(12) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_number` smallint(6) NOT NULL,
  `category_ID` varchar(15) NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`room_number`,`category_ID`),
  KEY `room_detail` (`category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_number`, `category_ID`, `state`) VALUES
(1, '608baa2d03821', 0),
(1, '608bad5e18355', 1),
(1, '608badf342206', 0),
(1, '608baeb342206', 1),
(2, '608baa2d03821', 0),
(2, '608bad5e18355', 1),
(2, '608badf342206', 0),
(2, '608baeb342206', 1),
(3, '608baa2d03821', 0),
(3, '608bad5e18355', 0),
(3, '608badf342206', 0),
(3, '608baeb342206', 0),
(4, '608baa2d03821', 0),
(4, '608bad5e18355', 0),
(5, '608baa2d03821', 0),
(5, '608bad5e18355', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--

DROP TABLE IF EXISTS `room_category`;
CREATE TABLE IF NOT EXISTS `room_category` (
  `category_ID` varchar(15) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `single_bed` tinyint(4) NOT NULL,
  `double_bed` tinyint(4) NOT NULL,
  `area` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `available` smallint(6) NOT NULL,
  `price_on_day` mediumint(9) NOT NULL,
  PRIMARY KEY (`category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`category_ID`, `category_name`, `single_bed`, `double_bed`, `area`, `description`, `available`, `price_on_day`) VALUES
('608baa2d03821', 'Economy Single', 1, 0, 23, '', 5, 100),
('608bad5e18355', 'Economy Double', 2, 0, 30, '', 3, 150),
('608badf342206', 'Honeymoon Suit', 0, 1, 35, '', 3, 200),
('608baeb342206', 'Economy Family City View', 1, 3, 42, '', 1, 350),
('608bb270bcfdb', 'Delux Family City View', 2, 2, 50, '', 0, 400);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `user_booking` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`);

--
-- Constraints for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD CONSTRAINT `booking_info` FOREIGN KEY (`booking_ID`) REFERENCES `booking` (`booking_ID`),
  ADD CONSTRAINT `booking_room` FOREIGN KEY (`category_ID`) REFERENCES `room_category` (`category_ID`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_room` FOREIGN KEY (`category_ID`) REFERENCES `room_category` (`category_ID`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `user_infor` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_detail` FOREIGN KEY (`category_ID`) REFERENCES `room_category` (`category_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
