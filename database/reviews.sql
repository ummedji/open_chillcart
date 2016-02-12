-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 25, 2015 at 09:31 AM
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
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '0-deactive,1-active,2-pennding',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `order_id`, `store_id`, `customer_id`, `rating`, `message`, `status`, `created`, `updated`) VALUES
(3, 50, 3, 15, 4, 'jfjh', 3, '2015-12-24 17:49:33', '2015-12-24 17:49:33'),
(4, 49, 3, 15, 5, 'checking', 1, '2015-12-24 18:06:37', '2015-12-24 18:06:37'),
(5, 47, 3, 15, 3, 'dghhgf', 1, '2015-12-24 18:07:03', '2015-12-24 18:07:03'),
(6, 13, 2, 40, 4, 'nice store', 1, '2015-12-24 18:42:53', '2015-12-24 18:42:53'),
(7, 15, 2, 15, 1, 'jfgj', 2, '2015-12-25 09:25:13', '2015-12-25 09:25:13'),
(8, 12, 2, 40, 1, 'nice la', 2, '2015-12-25 09:28:17', '2015-12-25 09:28:17'),
(9, 10, 2, 40, 1, 'gh', 2, '2015-12-25 09:28:35', '2015-12-25 09:28:35');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
