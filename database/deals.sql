-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2015 at 02:42 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `deal_name` varchar(100) NOT NULL,
  `main_product` int(11) NOT NULL,
  `sub_product` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `store_id`, `deal_name`, `main_product`, `sub_product`, `status`, `created`, `updated`) VALUES
(1, 1, 'Deal 1', 20, 20, 3, '0000-00-00 00:00:00', '2015-12-11 14:06:11'),
(2, 2, 'Manik', 22, 22, 1, '2015-12-11 12:36:58', '2015-12-11 12:36:58'),
(3, 1, 'Deal 2', 20, 21, 3, '2015-12-11 12:38:00', '2015-12-11 13:56:21'),
(4, 1, 'Deal 3', 20, 20, 3, '2015-12-11 12:38:15', '2015-12-11 13:56:30'),
(5, 1, 'Deal 4', 20, 20, 3, '2015-12-11 12:38:51', '2015-12-11 13:56:38'),
(6, 2, 'Deal 5', 24, 22, 1, '2015-12-11 12:40:11', '2015-12-11 13:56:44'),
(7, 1, 'check ', 7, 7, 3, '2015-12-11 14:14:05', '2015-12-11 14:14:05'),
(8, 1, 'jana', 8, 8, 1, '2015-12-11 14:31:09', '2015-12-11 14:31:09'),
(9, 1, 'checking da jana', 7, 8, 3, '2015-12-11 14:42:31', '2015-12-11 14:42:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
