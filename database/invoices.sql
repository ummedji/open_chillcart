-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 24, 2015 at 03:12 PM
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
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `total_order` int(11) NOT NULL,
  `cod_count` int(11) NOT NULL,
  `cod_price` float(10,2) NOT NULL,
  `card_count` int(11) NOT NULL,
  `card_tax` float(10,2) NOT NULL,
  `card_price` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `tax` float(10,2) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-not paid,1-paid',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `ref_id`, `store_id`, `total_order`, `cod_count`, `cod_price`, `card_count`, `card_tax`, `card_price`, `subtotal`, `tax`, `grand_total`, `start_date`, `end_date`, `status`, `created`, `updated`) VALUES
(9, '#GR0009INV', 2, 2, 1, 4500.00, 1, 90.00, 9000.00, 13500.00, 90.00, 13320.00, '2015-12-01 00:00:00', '2015-12-15 00:00:00', 0, '2015-12-24 14:03:24', '2015-12-24 14:03:24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
