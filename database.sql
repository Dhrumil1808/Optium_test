
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2016 at 05:48 AM
-- Server version: 10.0.20-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u129589226_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(100) NOT NULL,
  `category_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_parent_id`) VALUES
(27, 'Shop', 'Shops', 0),
(28, 'Fruit', 'Fruits', 0),
(20, 'Vegetables', 'Vegetables', 0),
(18, 'Mobile', 'Mobile', 27),
(25, 'Seed', 'Seed', 28),
(24, 'level 333', 'level 333', 18);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `Product_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_ID` int(11) NOT NULL,
  `Product_Name` varchar(100) NOT NULL,
  `Product_Description` varchar(1000) NOT NULL,
  `Product_Image` varchar(500) NOT NULL,
  PRIMARY KEY (`Product_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_ID`, `Category_ID`, `Product_Name`, `Product_Description`, `Product_Image`) VALUES
(45, 18, 'Motorola', 'Motorola', 'upload/motorala.jpg'),
(43, 28, 'Apple', 'Apples are good for health', 'upload/apple.jpg'),
(44, 28, 'Banana', 'Banana', 'upload/Banana.jpg'),
(47, 28, 'Guavava', 'Guavava', 'upload/images.jpg'),
(56, 18, 'Apple', 'Apple', 'upload/apple_company.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
