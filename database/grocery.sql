-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2015 at 11:16 AM
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
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '2' COMMENT '0 - Deactive, 1 - Active, 2 - Pending, 3 - Delete',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `status`, `created`, `updated`) VALUES
(2, 'check1', '2', '2015-11-06 13:07:20', '2015-11-06 13:43:50'),
(4, 'ghdhfhfhhg', '2', '2015-11-06 13:46:37', '2015-11-06 13:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '2' COMMENT '0 - Deactive, 1 - Active, 2 - Pending, 3 - Delete',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `category_name`, `status`, `created`, `updated`) VALUES
(2, 0, 'mens', '2', '2015-11-07 05:08:49', '2015-11-07 05:08:49'),
(8, 2, 'hello1', '2', '2015-11-07 06:16:42', '2015-11-07 07:05:58'),
(10, 4, 'carrot', '2', '2015-11-07 06:43:34', '2015-11-07 06:43:34'),
(11, 4, 'tommato', '2', '2015-11-07 06:50:11', '2015-11-07 06:50:11'),
(12, 0, 'Womens', '2', NULL, NULL),
(13, 12, 'Dress', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '2' COMMENT '0 - Deactive, 1 - Active, 2 - Pending, 3 - Delete',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `state_id`, `city_name`, `status`, `created`, `updated`) VALUES
(1, 1, 1, 'chennai', '2', '2015-11-07 12:10:22', '2015-11-07 12:10:22'),
(2, 1, 1, 'loss angel', '2', '2015-11-11 09:03:09', '2015-11-11 09:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(25) NOT NULL,
  `iso` varchar(15) NOT NULL,
  `phone_code` varchar(5) NOT NULL,
  `currency_name` varchar(25) NOT NULL,
  `currency_code` varchar(25) NOT NULL,
  `currency_symbol` varchar(22) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=241 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `iso`, `phone_code`, `currency_name`, `currency_code`, `currency_symbol`, `created`, `updated`) VALUES
(1, 'AFGHANISTAN', 'AF', '93', 'Afghani', 'AFN', '$', '0000-00-00 00:00:00', '2015-11-06 10:45:37'),
(2, 'ALBANIA', 'AL', '355', 'Lek', 'ALL', 'Lek', '0000-00-00 00:00:00', '2015-11-05 13:53:37'),
(3, 'ALGERIA', 'DZ', '213', 'Dinar', 'DZD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AMERICAN SAMOA', 'AS', '1684', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ANDORRA', 'AD', '376', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ANGOLA', 'AO', '244', 'Kwanza', 'AOA', 'Kz', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'ANGUILLA', 'AI', '1264', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ANTARCTICA', 'AQ', '0', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'ANTIGUA AND BARBUDA', 'AG', '1268', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'ARGENTINA', 'AR', '54', 'Peso', 'ARS', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'ARMENIA', 'AM', '374', 'Dram', 'AMD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'ARUBA', 'AW', '297', 'Guilder', 'AWG', 'ƒ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'AUSTRALIA', 'AU', '61', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'AUSTRIA', 'AT', '43', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'AZERBAIJAN', 'AZ', '994', 'Manat', 'AZN', '???', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'BAHAMAS', 'BS', '1242', 'Dollar', 'BSD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'BAHRAIN', 'BH', '973', 'Dinar', 'BHD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'BANGLADESH', 'BD', '880', 'Taka', 'BDT', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BARBADOS', 'BB', '1246', 'Dollar', 'BBD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'BELARUS', 'BY', '375', 'Ruble', 'BYR', 'p.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'BELGIUM', 'BE', '32', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BELIZE', 'BZ', '501', 'Dollar', 'BZD', 'BZ$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BENIN', 'BJ', '229', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'BERMUDA', 'BM', '1441', 'Dollar', 'BMD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'BHUTAN', 'BT', '975', 'Ngultrum', 'BTN', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BOLIVIA', 'BO', '591', 'Boliviano', 'BOB', '$b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'BOSNIA AND HERZEGOVINA', 'BA', '387', 'Marka', 'BAM', 'KM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'BOTSWANA', 'BW', '267', 'Pula', 'BWP', 'P', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'BOUVET ISLAND', 'BV', '0', 'Krone', 'NOK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'BRAZIL', 'BR', '55', 'Real', 'BRL', 'R$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'BRITISH INDIAN OCEAN TERR', 'IO', '246', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'VIRGIN ISLANDS, BRITISH', 'VG', '1284', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'BRUNEI DARUSSALAM', 'BN', '673', 'Dollar', 'BND', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'BULGARIA', 'BG', '359', 'Lev', 'BGN', '??', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'BURKINA FASO', 'BF', '226', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'BURUNDI', 'BI', '257', 'Franc', 'BIF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'CAMBODIA', 'KH', '855', 'Riels', 'KHR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'CAMEROON', 'CM', '237', 'Franc', 'XAF', 'FCF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'CANADA', 'CA', '1', 'Dollar', 'CAD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'CAPE VERDE', 'CV', '238', 'Escudo', 'CVE', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'CAYMAN ISLANDS', 'KY', '1345', 'Dollar', 'KYD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'CENTRAL AFRICAN REPUBLIC', 'CF', '236', 'Franc', 'XAF', 'FCF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'CHAD', 'TD', '235', 'Franc', 'XAF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'CHILE', 'CL', '56', 'Peso', 'CLP', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'CHINA', 'CN', '86', 'Yuan Renminbi', 'CNY', '¥', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'CHRISTMAS ISLAND', 'CX', '61', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'COCOS (KEELING) ISLANDS', 'CC', '672', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'COLOMBIA', 'CO', '57', 'Peso', 'COP', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'COMOROS', 'KM', '269', 'Franc', 'KMF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'COOK ISLANDS', 'CK', '682', 'Dollar', 'NZD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'COSTA RICA', 'CR', '506', 'Colon', 'CRC', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'CROATIA', 'HR', '385', 'Kuna', 'HRK', 'kn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'CUBA', 'CU', '53', 'Peso', 'CUP', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'CYPRUS', 'CY', '357', 'Pound', 'CYP', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'CZECH REPUBLIC', 'CZ', '420', 'Koruna', 'CZK', 'K?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'CONGO, THE DEMOCRATIC REP', 'CD', '242', 'Franc', 'CDF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'DENMARK', 'DK', '45', 'Krone', 'DKK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'DJIBOUTI', 'DJ', '253', 'Franc', 'DJF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'DOMINICA', 'DM', '1767', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'DOMINICAN REPUBLIC', 'DO', '1809', 'Peso', 'DOP', 'RD$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'TIMOR-LESTE', 'TL', '670', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'ECUADOR', 'EC', '593', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'EGYPT', 'EG', '20', 'Pound', 'EGP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'EL SALVADOR', 'SV', '503', 'Colone', 'SVC', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'EQUATORIAL GUINEA', 'GQ', '240', 'Franc', 'XAF', 'FCF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'ERITREA', 'ER', '291', 'Nakfa', 'ERN', 'Nfk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'ESTONIA', 'EE', '372', 'Kroon', 'EEK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ETHIOPIA', 'ET', '251', 'Birr', 'ETB', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'FALKLAND ISLANDS (MALVINA', 'FK', '500', 'Pound', 'FKP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'FAROE ISLANDS', 'FO', '298', 'Krone', 'DKK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'FIJI', 'FJ', '679', 'Dollar', 'FJD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'FINLAND', 'FI', '358', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'FRANCE', 'FR', '33', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'FRENCH GUIANA', 'GF', '594', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'FRENCH POLYNESIA', 'PF', '689', 'Franc', 'XPF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'FRENCH SOUTHERN TERRITORI', 'TF', '0', 'Euro  ', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'GABON', 'GA', '241', 'Franc', 'XAF', 'FCF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'GAMBIA', 'GM', '220', 'Dalasi', 'GMD', 'D', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'GEORGIA', 'GE', '995', 'Lari', 'GEL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'GERMANY', 'DE', '49', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'GHANA', 'GH', '233', 'Cedi', 'GHC', '¢', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'GIBRALTAR', 'GI', '350', 'Pound', 'GIP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'GREECE', 'GR', '30', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'GREENLAND', 'GL', '299', 'Krone', 'DKK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'GRENADA', 'GD', '1473', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'GUADELOUPE', 'GP', '590', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'GUAM', 'GU', '1671', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'GUATEMALA', 'GT', '502', 'Quetzal', 'GTQ', 'Q', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'GUINEA', 'GN', '224', 'Franc', 'GNF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'GUINEA-BISSAU', 'GW', '245', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'GUYANA', 'GY', '592', 'Dollar', 'GYD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'HAITI', 'HT', '509', 'Gourde', 'HTG', 'G', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'HEARD ISLAND AND MCDONALD', 'HM', '0', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'HONDURAS', 'HN', '504', 'Lempira', 'HNL', 'L', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'HONG KONG', 'HK', '852', 'Dollar', 'HKD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'HUNGARY', 'HU', '36', 'Forint', 'HUF', 'Ft', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'ICELAND', 'IS', '354', 'Krona', 'ISK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'INDIA', 'IN', '91', 'Rupee', 'INR', 'INR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'INDONESIA', 'ID', '62', 'Rupiah', 'IDR', 'Rp', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'IRAN, ISLAMIC REPUBLIC OF', 'IR', '98', 'Rial', 'IRR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'IRAQ', 'IQ', '964', 'Dinar', 'IQD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'IRELAND', 'IE', '353', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'ISRAEL', 'IL', '972', 'Shekel', 'ILS', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'ITALY', 'IT', '39', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'COTE D IVOIRE', 'CI', '225', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'JAMAICA', 'JM', '1876', 'Dollar', 'JMD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'JAPAN', 'JP', '81', 'Yen', 'JPY', '¥', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'JORDAN', 'JO', '962', 'Dinar', 'JOD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'KAZAKHSTAN', 'KZ', '7', 'Tenge', 'KZT', '??', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'KENYA', 'KE', '254', 'Shilling', 'KES', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'KIRIBATI', 'KI', '686', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'KUWAIT', 'KW', '965', 'Dinar', 'KWD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'KYRGYZSTAN', 'KG', '996', 'Som', 'KGS', '??', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'LAO PEOPLE S DEMOCRATIC R', 'LA', '856', 'Kip', 'LAK', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'LATVIA', 'LV', '371', 'Lat', 'LVL', 'Ls', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'LEBANON', 'LB', '961', 'Pound', 'LBP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'LESOTHO', 'LS', '266', 'Loti', 'LSL', 'L', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'LIBERIA', 'LR', '231', 'Dollar', 'LRD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'LIBYAN ARAB JAMAHIRIYA', 'LY', '218', 'Dinar', 'LYD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'LIECHTENSTEIN', 'LI', '423', 'Franc', 'CHF', 'CHF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'LITHUANIA', 'LT', '370', 'Litas', 'LTL', 'Lt', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'LUXEMBOURG', 'LU', '352', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'MACAO', 'MO', '853', 'Pataca', 'MOP', 'MOP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'MACEDONIA, THE FORMER YUG', 'MK', '389', 'Denar', 'MKD', '???', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'MADAGASCAR', 'MG', '261', 'Ariary', 'MGA', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'MALAWI', 'MW', '265', 'Kwacha', 'MWK', 'MK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'MALAYSIA', 'MY', '60', 'Ringgit', 'MYR', 'RM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'MALDIVES', 'MV', '960', 'Rufiyaa', 'MVR', 'Rf', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'MALI', 'ML', '223', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'MALTA', 'MT', '356', 'Lira', 'MTL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'MARSHALL ISLANDS', 'MH', '692', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'MARTINIQUE', 'MQ', '596', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'MAURITANIA', 'MR', '222', 'Ouguiya', 'MRO', 'UM', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'MAURITIUS', 'MU', '230', 'Rupee', 'MUR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'MAYOTTE', 'YT', '269', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'MEXICO', 'MX', '52', 'Peso', 'MXN', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'MICRONESIA, FEDERATED STA', 'FM', '691', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'MOLDOVA, REPUBLIC OF', 'MD', '373', 'Leu', 'MDL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'MONACO', 'MC', '377', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'MONGOLIA', 'MN', '976', 'Tugrik', 'MNT', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'MONTSERRAT', 'MS', '1664', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'MOROCCO', 'MA', '212', 'Dirham', 'MAD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'MOZAMBIQUE', 'MZ', '258', 'Meticail', 'MZN', 'MT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'MYANMAR', 'MM', '95', 'Kyat', 'MMK', 'K', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'NAMIBIA', 'NA', '264', 'Dollar', 'NAD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'NAURU', 'NR', '674', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'NEPAL', 'NP', '977', 'Rupee', 'NPR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'NETHERLANDS', 'NL', '31', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'NETHERLANDS ANTILLES', 'AN', '599', 'Guilder', 'ANG', 'ƒ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'NEW CALEDONIA', 'NC', '687', 'Franc', 'XPF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'NEW ZEALAND', 'NZ', '64', 'Dollar', 'NZD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'NICARAGUA', 'NI', '505', 'Cordoba', 'NIO', 'C$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'NIGER', 'NE', '227', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'NIGERIA', 'NG', '234', 'Naira', 'NGN', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'NIUE', 'NU', '683', 'Dollar', 'NZD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'NORFOLK ISLAND', 'NF', '672', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'KOREA, DEMOCRATIC PEOPLE ', 'KP', '850', 'Won', 'KPW', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'NORTHERN MARIANA ISLANDS', 'MP', '1670', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'NORWAY', 'NO', '47', 'Krone', 'NOK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'OMAN', 'OM', '968', 'Rial', 'OMR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'PAKISTAN', 'PK', '92', 'Rupee', 'PKR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'PALAU', 'PW', '680', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'PALESTINIAN TERRITORY, OC', 'PS', '970', 'Shekel', 'ILS', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'PANAMA', 'PA', '507', 'Balboa', 'PAB', 'B/.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'PAPUA NEW GUINEA', 'PG', '675', 'Kina', 'PGK', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'PARAGUAY', 'PY', '595', 'Guarani', 'PYG', 'Gs', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'PERU', 'PE', '51', 'Sol', 'PEN', 'S/.', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'PHILIPPINES', 'PH', '63', 'Peso', 'PHP', 'Php', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'PITCAIRN', 'PN', '0', 'Dollar', 'NZD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'POLAND', 'PL', '48', 'Zloty', 'PLN', 'z?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'PORTUGAL', 'PT', '351', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'PUERTO RICO', 'PR', '1787', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'QATAR', 'QA', '974', 'Rial', 'QAR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'CONGO', 'CG', '242', 'Franc', 'XAF', 'FCF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'REUNION', 'RE', '262', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'ROMANIA', 'RO', '40', 'Leu', 'RON', 'lei', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'RUSSIAN FEDERATION', 'RU', '70', 'Ruble', 'RUB', '???', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'RWANDA', 'RW', '250', 'Franc', 'RWF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'SAINT HELENA', 'SH', '290', 'Pound', 'SHP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'SAINT KITTS AND NEVIS', 'KN', '1869', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'SAINT LUCIA', 'LC', '1758', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'SAINT PIERRE AND MIQUELON', 'PM', '508', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'SAINT VINCENT AND THE GRE', 'VC', '1784', 'Dollar', 'XCD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'SAMOA', 'WS', '684', 'Tala', 'WST', 'WS$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'SAN MARINO', 'SM', '378', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'SAO TOME AND PRINCIPE', 'ST', '239', 'Dobra', 'STD', 'Db', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'SAUDI ARABIA', 'SA', '966', 'Rial', 'SAR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'SENEGAL', 'SN', '221', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'SERBIA AND MONTENEGRO', 'CS', '381', 'Dinar', 'RSD', '???', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'SEYCHELLES', 'SC', '248', 'Rupee', 'SCR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'SIERRA LEONE', 'SL', '232', 'Leone', 'SLL', 'Le', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'SINGAPORE', 'SG', '65', 'Dollar', 'SGD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'SLOVAKIA', 'SK', '421', 'Koruna', 'SKK', 'Sk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'SLOVENIA', 'SI', '386', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'SOLOMON ISLANDS', 'SB', '677', 'Dollar', 'SBD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'SOMALIA', 'SO', '252', 'Shilling', 'SOS', 'S', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'SOUTH AFRICA', 'ZA', '27', 'Rand', 'ZAR', 'R', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'SOUTH GEORGIA AND THE SOU', 'GS', '0', 'Pound', 'GBP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'KOREA, REPUBLIC OF', 'KR', '82', 'Won', 'KRW', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'SPAIN', 'ES', '34', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'SRI LANKA', 'LK', '94', 'Rupee', 'LKR', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'SUDAN', 'SD', '249', 'Dinar', 'SDD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'SURINAME', 'SR', '597', 'Dollar', 'SRD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'SVALBARD AND JAN MAYEN', 'SJ', '47', 'Krone', 'NOK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'SWAZILAND', 'SZ', '268', 'Lilangeni', 'SZL', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'SWEDEN', 'SE', '46', 'Krona', 'SEK', 'kr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'SWITZERLAND', 'CH', '41', 'Franc', 'CHF', 'CHF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'SYRIAN ARAB REPUBLIC', 'SY', '963', 'Pound', 'SYP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'TAIWAN, PROVINCE OF CHINA', 'TW', '886', 'Dollar', 'TWD', 'NT$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'TAJIKISTAN', 'TJ', '992', 'Somoni', 'TJS', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'TANZANIA, UNITED REPUBLIC', 'TZ', '255', 'Shilling', 'TZS', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'THAILAND', 'TH', '66', 'Baht', 'THB', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'TOGO', 'TG', '228', 'Franc', 'XOF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'TOKELAU', 'TK', '690', 'Dollar', 'NZD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'TONGA', 'TO', '676', 'Pa anga', 'TOP', 'T$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'TRINIDAD AND TOBAGO', 'TT', '1868', 'Dollar', 'TTD', 'TT$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'TUNISIA', 'TN', '216', 'Dinar', 'TND', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'TURKEY', 'TR', '90', 'Lira', 'TRY', 'YTL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'TURKMENISTAN', 'TM', '7370', 'Manat', 'TMM', 'm', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'TURKS AND CAICOS ISLANDS', 'TC', '1649', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'TUVALU', 'TV', '688', 'Dollar', 'AUD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'VIRGIN ISLANDS, U.S.', 'VI', '1340', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'UGANDA', 'UG', '256', 'Shilling', 'UGX', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'UKRAINE', 'UA', '380', 'Hryvnia', 'UAH', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'UNITED ARAB EMIRATES', 'AE', '971', 'Dirham', 'AED', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'UNITED KINGDOM', 'GB', '44', 'Pound', 'GBP', '£', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'UNITED STATES', 'US', '1', 'Dollar', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'UNITED STATES MINOR OUTLY', 'UM', '1', 'Dollar ', 'USD', '$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'URUGUAY', 'UY', '598', 'Peso', 'UYU', '$U', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'UZBEKISTAN', 'UZ', '998', 'Som', 'UZS', '??', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'VANUATU', 'VU', '678', 'Vatu', 'VUV', 'Vt', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'HOLY SEE (VATICAN CITY ST', 'VA', '39', 'Euro', 'EUR', '€', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'VENEZUELA', 'VE', '58', 'Bolivar', 'VEF', 'Bs', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'VIET NAM', 'VN', '84', 'Dong', 'VND', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'WALLIS AND FUTUNA', 'WF', '681', 'Franc', 'XPF', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'WESTERN SAHARA', 'EH', '212', 'Dirham', 'MAD', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'YEMEN', 'YE', '967', 'Rial', 'YER', '?', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'ZAMBIA', 'ZM', '260', 'Kwacha', 'ZMK', 'ZK', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'ZIMBABWE', 'ZW', '263', 'Dollar', 'ZWD', 'Z$', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, '', '', '', '', '', '', '2015-11-06 09:12:54', '2015-11-06 09:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `news_letter_option` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `status` enum('0','1','2','3') NOT NULL DEFAULT '2' COMMENT '0 - Deactive, 1 - Active, 2 - Pending, 3 - Delete',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `first_name`, `last_name`, `customer_email`, `customer_phone`, `news_letter_option`, `status`, `created`, `updated`) VALUES
(5, 12, 'nagavalli', 'm', 'nagavalli@yahoo.com', '87620209694', 'Yes', '2', '2015-11-11 07:12:25', '2015-11-11 07:12:25'),
(6, 13, 'nagavalli', 'm', 'nagavalli@yahoo.com', '8760209694', 'Yes', '2', '2015-11-11 07:12:55', '2015-11-11 07:12:55'),
(7, 14, 'raj', 'a', 'raj@gmail.com', '7412589630', 'Yes', '2', '2015-11-11 07:28:01', '2015-11-11 07:28:01'),
(8, 15, 'rajkumar', 'a', 'rajkumar@gmail.com', '7412589630', 'Yes', '2', '2015-11-11 07:28:54', '2015-11-11 07:28:54'),
(9, 16, 'kannan', 'A', 'kannan@gmail.com', '8760209695', 'Yes', '2', '2015-11-11 08:32:21', '2015-11-11 08:32:21'),
(10, 0, 'nagavalli1', 'm', 'nagavalli@yahoo.com', '8760209694', 'Yes', '2', '2015-11-11 08:43:28', '2015-11-11 08:43:28'),
(11, 0, 'nagavalli1123', 'm', 'nagavalli@yahoo.com', '8760209694', 'Yes', '2', '2015-11-11 08:43:46', '2015-11-11 08:43:46'),
(12, 17, 'indira', 'j', 'indira@gmail.com', '8760209695', 'Yes', '2', '2015-11-11 09:16:38', '2015-11-11 09:16:38'),
(13, 46, 'manikandan', 'MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No', '2', '2015-11-21 12:51:30', '2015-11-21 13:18:20'),
(14, 47, 'jana', 'm', 'jana@gmail.com', '8760209695', 'Yes', '2', '2015-11-21 12:53:31', '2015-11-21 12:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address_books`
--

CREATE TABLE IF NOT EXISTS `customer_address_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `address_title` varchar(50) NOT NULL,
  `address` text,
  `landmark` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `address_phone` varchar(15) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '2' COMMENT '0 - Deactive, 1 - Active, 2 - Pending, 3 - Delete',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`,`state_id`,`city_id`,`location_id`),
  KEY `state_id` (`state_id`),
  KEY `city_id` (`city_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customer_address_books`
--

INSERT INTO `customer_address_books` (`id`, `customer_id`, `address_title`, `address`, `landmark`, `state_id`, `city_id`, `location_id`, `address_phone`, `status`, `created`, `updated`) VALUES
(3, 13, 'Manikandadn', 'No 7 Water Tank Road', 'Road Map Signal', 1, 1, 2, '123456789', '2', '2015-11-24 08:21:11', '2015-11-24 08:21:11'),
(4, 13, 'Raman', 'RR', 'MMDA', 1, 1, 2, '1235', '2', '2015-11-24 08:23:38', '2015-11-24 08:23:38'),
(5, 13, 'Mn', 'MN', 'Mn', 1, 1, 2, '1345689', '2', '2015-11-28 12:08:38', '2015-11-28 12:08:38'),
(6, 13, 'Silent', 'No 10 MMDA', 'Rest', 1, 1, 4, '9874563210', '2', '2015-11-30 12:14:40', '2015-11-30 12:14:40'),
(7, 13, 'Silent', 'No 10 MMDA', 'Rest', 1, 1, 4, '9874563210', '2', '2015-11-30 12:17:51', '2015-11-30 12:17:51'),
(8, 13, 'Suguna', 'Suguna ', 'RERe', 1, 1, 3, '7894561230', '2', '2015-11-30 18:04:21', '2015-11-30 18:04:21'),
(9, 13, 'Roever', 'Chennai - Trichy Bypass', 'Right side of Bypass', 1, 1, 4, '7894561230', '2', '2015-11-30 18:24:50', '2015-11-30 18:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_locations`
--

CREATE TABLE IF NOT EXISTS `delivery_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`,`location_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `delivery_locations`
--

INSERT INTO `delivery_locations` (`id`, `store_id`, `location_id`, `created`, `updated`) VALUES
(30, 2, 2, '2015-11-25 14:19:56', '2015-11-25 14:19:56'),
(32, 3, 2, '2015-11-25 14:41:39', '2015-11-25 14:41:39'),
(43, 1, 2, '2015-11-30 17:53:53', '2015-11-30 17:53:53'),
(44, 1, 3, '2015-11-30 17:53:53', '2015-11-30 17:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_time_slots`
--

CREATE TABLE IF NOT EXISTS `delivery_time_slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `delivery_charge` float NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `slot_id` (`slot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `delivery_time_slots`
--

INSERT INTO `delivery_time_slots` (`id`, `store_id`, `slot_id`, `delivery_charge`, `created`, `updated`) VALUES
(176, 2, 1, 0, '2015-11-25 14:19:56', '2015-11-25 14:19:56'),
(177, 2, 4, 0, '2015-11-25 14:19:56', '2015-11-25 14:19:56'),
(178, 2, 8, 0, '2015-11-25 14:19:56', '2015-11-25 14:19:56'),
(179, 2, 9, 0, '2015-11-25 14:19:56', '2015-11-25 14:19:56'),
(183, 3, 1, 10, '2015-11-25 14:41:39', '2015-11-25 14:41:39'),
(184, 3, 3, 15, '2015-11-25 14:41:39', '2015-11-25 14:41:39'),
(185, 3, 7, 36, '2015-11-25 14:41:39', '2015-11-25 14:41:39'),
(186, 3, 11, 0, '2015-11-25 14:41:39', '2015-11-25 14:41:39'),
(187, 3, 12, 0, '2015-11-25 14:41:39', '2015-11-25 14:41:39'),
(228, 1, 1, 10, '2015-11-30 17:53:53', '2015-11-30 17:53:53'),
(229, 1, 2, 20, '2015-11-30 17:53:53', '2015-11-30 17:53:53'),
(230, 1, 3, 0, '2015-11-30 17:53:53', '2015-11-30 17:53:53'),
(231, 1, 4, 30, '2015-11-30 17:53:54', '2015-11-30 17:53:54'),
(232, 1, 6, 0, '2015-11-30 17:53:54', '2015-11-30 17:53:54'),
(233, 1, 7, 0, '2015-11-30 17:53:54', '2015-11-30 17:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `driver_email` varchar(100) NOT NULL,
  `license_no` varchar(100) NOT NULL,
  `driver_description` text,
  `device_name` enum('Android','IO') NOT NULL DEFAULT 'Android' COMMENT 'ANDROID - Device is powered by Android OS, IOS - Device is Apple device',
  `is_logged` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-Not Logged ,1-Logged',
  `device_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `driver_trackings`
--

CREATE TABLE IF NOT EXISTS `driver_trackings` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_latitude` int(11) NOT NULL,
  `driver_longitude` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  KEY `driver_id` (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip_code` varchar(15) NOT NULL,
  `area_name` varchar(25) NOT NULL,
  `latitude` varchar(25) NOT NULL,
  `langitude` varchar(25) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '2',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `state_id`, `city_id`, `zip_code`, `area_name`, `latitude`, `langitude`, `status`, `created`, `updated`) VALUES
(2, 1, 1, '600100', 'arumpakkam', '', '', '2', '2015-11-11 09:20:01', '2015-11-11 09:20:01'),
(3, 1, 1, '600108', 'MMDA', '', '', '2', NULL, NULL),
(4, 1, 1, '600107', 'CMBT', '', '', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `ref_number` varchar(255) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `user_type` enum('Guest','Customer') NOT NULL COMMENT 'Guest',
  `order_description` text,
  `delivery_date` varchar(50) NOT NULL,
  `delivery_time_slot` varchar(50) NOT NULL,
  `delivered_time` varchar(50) NOT NULL,
  `offer_amount` float NOT NULL,
  `tax_amount` float NOT NULL,
  `delivery_charge` float NOT NULL,
  `order_sub_total` float NOT NULL,
  `order_grand_total` float NOT NULL,
  `payment_type` varchar(100) NOT NULL COMMENT 'CreditCard',
  `payment_method` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `transaction_id` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `ref_number`, `customer_name`, `customer_email`, `customer_phone`, `address`, `landmark`, `state_name`, `city_name`, `location_name`, `user_type`, `order_description`, `delivery_date`, `delivery_time_slot`, `delivered_time`, `offer_amount`, `tax_amount`, `delivery_charge`, `order_sub_total`, `order_grand_total`, `payment_type`, `payment_method`, `transaction_id`, `status`, `created`, `updated`) VALUES
(19, 13, '#ORD0019', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'MN', 'Mn', 'test1', 'chennai', 'arumpakkam', 'Customer', 'Cool...........!', '2015-12-01', '6.00 AM TO 8.00 AM', '', 0, 0, 30, 20, 50, 'cod', 'unpaid', '', 0, '2015-11-30 09:28:43', '2015-11-30 09:28:44'),
(20, 13, '#ORD0020', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'RR', 'MMDA', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '12.00 AM TO 2.00 AM', '', 0, 0, 10, 30, 40, '', 'unpaid', '', 0, '2015-11-30 09:29:28', '2015-11-30 09:29:28'),
(21, 13, '#ORD0021', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', 'Try One More Time . . . !', '2015-12-01', '12.00 AM TO 2.00 AM', '', 0, 0, 10, 20, 30, 'stripe', 'paid', '', 0, '2015-11-30 09:31:46', '2015-11-30 09:32:20'),
(22, 13, '#ORD0022', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-11-30', '4.00 PM TO 6.00 PM', '', 0, 0, 5, 20, 25, 'stripe', 'paid', '', 0, '2015-11-30 14:38:59', '2015-11-30 14:39:02'),
(23, 13, '#ORD0023', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-11-30', '8.00 PM TO 10.00 PM', '', 4.5, 0, 0, 30, 30, 'cod', 'unpaid', '', 0, '2015-11-30 17:02:18', '2015-11-30 17:02:18'),
(24, 13, '#ORD0024', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-11-30', '4.00 PM TO 6.00 PM', '', 3, 0, 5, 20, 22, 'cod', 'unpaid', '', 0, '2015-11-30 17:03:58', '2015-11-30 17:03:59'),
(25, 13, '#ORD0025', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-11-30', '8.00 PM TO 10.00 PM', '', 3, 0, 0, 20, 17, 'cod', 'unpaid', '', 0, '2015-11-30 17:39:31', '2015-11-30 17:39:31'),
(26, 13, '#ORD0026', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-11-30', '4.00 PM TO 6.00 PM', '', 0.4, 0, 0, 20, 19.6, 'cod', 'unpaid', '', 0, '2015-11-30 17:39:31', '2015-11-30 17:39:31'),
(27, 13, '#ORD0027', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '12.00 AM TO 2.00 AM', '', 0, 0, 10, 10, 20, 'stripe', 'paid', '', 0, '2015-11-30 18:21:11', '2015-11-30 18:21:15'),
(28, 13, '#ORD0028', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '6.00 AM TO 8.00 AM', '', 0.4, 0, 0, 20, 19.6, 'stripe', 'paid', '', 0, '2015-11-30 18:21:11', '2015-11-30 18:21:15'),
(29, 13, '#ORD0029', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-11-30', '8.00 PM TO 10.00 PM', '', 0, 0, 0, 10, 10, 'stripe', 'paid', '', 0, '2015-11-30 18:21:11', '2015-11-30 18:21:15'),
(30, 13, '#ORD0030', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '2.00 AM TO 4.00 AM', '', 3, 0, 20, 20, 37, '', 'unpaid', '', 0, '2015-11-30 19:05:37', '2015-11-30 19:05:37'),
(31, 13, '#ORD0031', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '6.00 AM TO 8.00 AM', '', 0.2, 0, 0, 10, 9.8, '', 'unpaid', '', 0, '2015-11-30 19:05:37', '2015-11-30 19:05:37'),
(32, 13, '#ORD0032', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '12.00 PM TO 2.00 PM', '', 0, 0, 36, 10, 46, '', 'unpaid', '', 0, '2015-11-30 19:05:37', '2015-11-30 19:05:37'),
(33, 13, '', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '12.00 PM TO 2.00 PM', '', 0, 0, 36, 0, 36, '', 'unpaid', '', 0, '2015-12-01 09:59:45', '2015-12-01 09:59:45'),
(34, 13, '', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '12.00 PM TO 2.00 PM', '', 0, 0, 36, 0, 36, '', 'unpaid', '', 0, '2015-12-01 10:00:37', '2015-12-01 10:00:37'),
(35, 13, '', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '12.00 PM TO 2.00 PM', '', 0, 0, 36, 0, 36, '', 'unpaid', '', 0, '2015-12-01 10:03:27', '2015-12-01 10:03:27'),
(36, 13, '#ORD0036', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '10.00 AM TO 12.00 PM', '', 0, 0, 0, 10, 10, 'cod', 'unpaid', '', 0, '2015-12-01 10:04:51', '2015-12-01 10:04:51'),
(37, 13, '#ORD0037', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '2.00 PM TO 4.00 PM', '', 0.2, 0, 0, 10, 9.8, 'cod', 'unpaid', '', 0, '2015-12-01 10:04:51', '2015-12-01 10:04:51'),
(38, 13, '#ORD0038', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', '', '2015-12-01', '12.00 PM TO 2.00 PM', '', 0, 0, 36, 10, 46, 'cod', 'unpaid', '', 0, '2015-12-01 10:04:51', '2015-12-01 10:04:52'),
(39, 13, '#ORD0039', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', 'Please Ring Bell', '2015-12-01', '10.00 AM TO 12.00 PM', '', 0, 0, 0, 30, 30, 'stripe', 'paid', '', 0, '2015-12-01 10:06:26', '2015-12-01 10:06:29'),
(40, 13, '#ORD0040', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', 'Please Ring Bell', '2015-12-01', '2.00 PM TO 4.00 PM', '', 0.4, 0, 0, 20, 19.6, 'stripe', 'paid', '', 0, '2015-12-01 10:06:27', '2015-12-01 10:06:29'),
(41, 13, '#ORD0041', 'manikandan MN', 'manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road', 'Road Map Signal', 'test1', 'chennai', 'arumpakkam', 'Customer', 'Please Ring Bell', '2015-12-01', '12.00 PM TO 2.00 PM', '', 0, 0, 36, 20, 56, 'stripe', 'paid', '', 0, '2015-12-01 10:06:27', '2015-12-01 10:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders_statues`
--

CREATE TABLE IF NOT EXISTS `orders_statues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`driver_id`,`status_id`),
  KEY `status_id` (`status_id`),
  KEY `driver_id` (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf16 NOT NULL,
  `price_option` enum('single','multiple') NOT NULL DEFAULT 'single',
  `product_image` varchar(100) NOT NULL,
  `product_description` text,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '2',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`,`category_id`,`sub_category_id`,`brand_id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_id` (`sub_category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `store_id`, `category_id`, `sub_category_id`, `brand_id`, `product_name`, `price_option`, `product_image`, `product_description`, `status`, `created`, `updated`) VALUES
(19, 3, 2, 8, 2, 'Test1', 'multiple', '', 'Brainstorm.\r\n\r\nThis is going to sound a little hippi dippi to some of you, but think about the product you’re selling and write down anything that comes to mind. Seriously! If you’re selling a tractor and the name “Betsy the Cow” comes to mind, just write it. Feel free to be as silly as you want. It’s just an exercise, not something all of your customers will see.', '2', '2015-11-17 09:47:57', '2015-11-23 13:29:21'),
(20, 1, 2, 8, 2, 'Test2', 'single', '', 'Turn a 50-Word Description into a 500-Word Story\r\n\r\nOne of my favorite exercises in product writing is longform stories. A long form is what it sounds like: waxing poetic about something you wouldn’t normally flesh out into a substantial story.\r\n\r\nWhen I wrote for L.L.Bean, the copywriters would pull out the top 20 products that the business wanted to get behind. We’d each try and create a longform story for each item, almost as if it was the subject of it’s own full-blown marketing campaign.\r\n\r\nI’ve done this for everything from wreaths to gift cards to canvas tote bags.\r\n\r\nDuring one exercise, I was tasked with writing a story about cotton sheets. They weren’t a fancy thread count or made from the highest quality. They were very basic—borderline boring.\r\n\r\nFor the exercise, I started to jot down notes about sheets. A few thoughts stuck, one of which reminded me of being a kid and running through them hanging on the clothesline. Then I started thinking about how great it feels to lay on sheets that have dried in the sun.\r\n\r\nAnd then a story came through. Then a headline. Eventually, new product copy, convincing the customer that these classic cotton sheets are just like the ones Mom used to hang on the line to dry. They’re soft yet sturdy, smooth to the touch—maybe with a scent of summer woven in', '2', '2015-11-17 09:49:26', '2015-11-19 10:29:22'),
(21, 1, 2, 8, 2, 'Test3', 'single', '', 'Ignore the Competition…at First\r\n\r\nWhen I’m writing copy, I love to see what similar businesses are doing. But doing that can also trip me up. How often have you looked at competitors websites and said, “Look at what they’re doing. We need to do that too!”\r\n\r\nIt’s very easy to fall in line with competitors and stay safe.\r\n\r\nYou’ve probably all heard the story about Schlitz beer. When the ad guy toured the brewery he was impressed with the vast array of machinery and technology that went into brewing. He asked if they were the only company doing that. The brewmaster said no, every beer company does it. But no one was talking about it. And thus, this famous beer ad was born.\r\n\r\nI’d never suggest ignoring the competition. Instead, don’t make it your first priority. Focus on the product and who you want to sell to first. Strategize the selling points and how to make your point clear and concise. Make sure the features of the item are obvious to any potential customer. Once you’ve checked those off your list, sure, go check to see what your frenemies are doing.', '2', '2015-11-17 09:51:57', '2015-11-19 10:29:10'),
(22, 2, 12, 13, 2, 'Test4', 'single', '', 'Sample Assignment Instructions\r\n\r\nProduct descriptions must focus on the provided keyword and be no less than 100 words. The keyword must be in the first sentences of the summary, and the additional keyword should be included somewhere else in the paragraph. Writers should avoid using “be” verbs and future tense “will” as well as first person pronouns, including I, me, my, we, us, our, etc. Maintaining either 2nd or 3rd person throughout the product description is required.', '2', '2015-11-17 09:53:32', '2015-11-19 10:26:48'),
(23, 1, 2, 8, 2, 'Test5', 'single', '', 'Read Great Copy\r\n\r\nBefore you can write great copy, you’ve got to read it. I very rarely pull out my laptop and get straight to work on copy after reading manufacturer’s notes or spec sheets. I won’t do that until I’ve collected a beefy, inspirational folder of product copy first.\r\n\r\nWhen I worked in magazines, one of my bosses used to always say, “Read the New York Times before you tackle that.” She knew the importance of reading inspired prose before you can produce it yourself.', '2', '2015-11-17 09:57:34', '2015-11-19 12:34:36'),
(24, 2, 2, 8, 2, 'Test6', 'single', '', '\r\nProduct\r\n\r\n    Olive Kids Twin Sheet Sets\r\n\r\nKeywords\r\n\r\n    Comforter Sets\r\n\r\nSample Assignment Instructions\r\n\r\nProduct descriptions must focus on the provided keyword and be no less than 100 words. The keyword must be in the first sentences of the summary, and the additional keyword should be included somewhere else in the paragraph. Writers should avoid using “be” verbs and future tense “will” as well as first person pronouns, including I, me, my, we, us, our, etc. Maintaining either 2nd or 3rd person throughout the product description is required.', '2', '2015-11-17 09:58:42', '2015-11-19 10:28:14'),
(25, 1, 12, 13, 2, 'Test7', 'single', '', 'You know what''s sucky about regular flashlights? They only come in two colors: white or that yellowish-white that reminds us of the teeth of an avid coffee drinker. What fun is that kind of flashlight? We''ll answer that: NO FUN AT ALL. You know what is fun? Using the Multi-Color LED Flashlight to cast a sickly green glow over your face while telling a zombie story around a campfire. No campfire? Make a fake one with the orange light!\r\n\r\nWhen it comes to writing your own product descriptions, start by imagining your ideal buyer. What kind of humor does he or she appreciate (if any)? What words does he use? What words does he hate? Is he okay with words like sucky and crappy? What questions does he ask that you should answer?\r\n\r\nConsider how you would speak to your ideal buyer if you were selling your product in store, face-to-face. Now try and incorporate that language into your website so you can have a similar conversation online that resonates more deeply.', '2', '2015-11-17 10:02:56', '2015-11-19 10:26:03'),
(26, 3, 2, 8, 2, 'Test11', 'single', '', '\r\nSample Content:\r\nProduct\r\n\r\n    Olive Kids Twin Sheet Sets\r\n\r\nKeywords\r\n\r\n    Comforter Sets\r\n\r\nSample Assignment Instructions\r\n\r\nProduct descriptions must focus on the provided keyword and be no less than 100 words. The keyword must be in the first sentences of the summary, and the additional keyword should be included somewhere else in the paragraph. Writers should avoid using “be” verbs and future tense “will” as well as first person pronouns, including I, me, my, we, us, our, etc. Maintaining either 2nd or 3rd person throughout the product description is required.\r\nSample Product Description\r\n\r\nSpark your child’s imagination with Olive Kids twin sheet sets. Turn naps and bedtimes into an adventure on the high seas with pirate sheets. Give the tools of the trade to your little builder with under-construction-themed sheets. Let your little girl fancy herself a mythical beauty of the ocean with sheets featuring aquatic life and mermaids. Feed your little speedster’s need for the fast and furious with race-car sheets. Find a design your child is sure to love, and look for matching comforter sets to give your child the ultimate imagination-sparking room. Whatever style floats the fancy of your child, these twin sheet sets from Olive Kids are fun, colorful and bright additions to your child’s bedroom decor.\r\nSample Product Description Keyword\r\n\r\n3D HDTVs\r\nSample Product Description Additional Keyword\r\n\r\nSony HDTVs\r\nSample Product Description\r\n\r\nPut your TV viewing into overdrive with scenes that jump off your screen when you add 3D HDTVs to your home-theater system. Alternate-frame sequencing (AFS) gives you every scene in two angles, making every image pop with clarity and intensity. This collection has HDTVs in both active and passive 3D – the difference lies in the glasses needed to view in 3D. Some models feature refresh rates as high as 600 Hz in plasma models and 480 Hz in LCD models. Look to the top names in visual entertainment, such as Panasonic, LG, Sony HDTVs and many others for 42”, 47”, 55” and larger screen sizes. Regardless of the size, adding a 3D HDTV to your home forever changes the way you watch TV with vibrant scenes that come to life.\r\n', '2', '2015-11-17 10:06:56', '2015-11-19 10:27:51'),
(27, 1, 2, 8, 2, 'Test31', 'single', '', 'Sample Product Description\r\n\r\nPut your TV viewing into overdrive with scenes that jump off your screen when you add 3D HDTVs to your home-theater system. Alternate-frame sequencing (AFS) gives you every scene in two angles, making every image pop with clarity and intensity. This collection has HDTVs in both active and passive 3D – the difference lies in the glasses needed to view in 3D. Some models feature refresh rates as high as 600 Hz in plasma models and 480 Hz in LCD models. Look to the top names in visual entertainment, such as Panasonic, LG, Sony HDTVs and many others for 42”, 47”, 55” and larger screen sizes. Regardless of the size, adding a 3D HDTV to your home forever changes the way you watch TV with vibrant scenes that come to life.', '2', '2015-11-17 10:09:10', '2015-11-19 10:27:33'),
(28, 1, 12, 13, 2, 'Test12345', 'single', '', 'When you write a product description with a huge crowd of buyers in mind, your descriptions become wishy-washy and you end up addressing no one at all.\r\n\r\nThe best product descriptions address your ideal buyer directly and personally. You ask and answer questions as if you’re having a conversation with them. You choose the words your ideal buyer uses. You use the word you.', '2', '2015-11-17 10:12:52', '2015-11-19 10:25:43'),
(29, 1, 2, 8, 2, 'MN1', 'single', '', 'MN is a Worst Boy', '2', '2015-11-17 11:05:55', '2015-11-19 09:43:07'),
(30, 3, 2, 8, 2, 'MIce1', 'single', '', 'Sample Product Description Keyword\r\n\r\n3D HDTVs\r\nSample Product Description Additional Keyword\r\n\r\nSony HDTVs', '2', '2015-11-18 04:59:05', '2015-11-19 10:27:15'),
(31, 1, 2, 8, 2, 'MIce2', 'multiple', '', 'Sample Product Description\r\n\r\nSpark your child’s imagination with Olive Kids twin sheet sets. Turn naps and bedtimes into an adventure on the high seas with pirate sheets. Give the tools of the trade to your little builder with under-construction-themed sheets. Let your little girl fancy herself a mythical beauty of the ocean with sheets featuring aquatic life and mermaids. Feed your little speedster’s need for the fast and furious with race-car sheets. Find a design your child is sure to love, and look for matching comforter sets to give your child the ultimate imagination-sparking room. Whatever style floats the fancy of your child, these twin sheet sets from Olive Kids are fun, colorful and bright additions to your child’s bedroom decor.', '2', '2015-11-18 05:00:52', '2015-11-19 10:27:00'),
(32, 3, 2, 8, 2, 'Apple', 'single', '', 'Apple  == Doctor', '2', '2015-11-23 11:01:09', '2015-11-23 11:01:09'),
(33, 3, 2, 8, 2, 'Banana', 'multiple', '', 'Banana is a good for health', '2', '2015-12-01 11:31:26', '2015-12-01 11:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE IF NOT EXISTS `product_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `orginal_price` float NOT NULL,
  `compare_price` float DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `sub_name`, `orginal_price`, `compare_price`, `quantity`, `product_code`, `created`, `updated`) VALUES
(21, 29, 'MN1', 10, 10, 10, '10', NULL, NULL),
(28, 28, 'Test12345', 10, 10, 10, '10', NULL, NULL),
(29, 25, 'Test7', 10, 10, 10, '10', NULL, NULL),
(30, 22, 'Test4', 10, 10, 10, '10', NULL, NULL),
(31, 31, 'MN1', 100, NULL, 5, '14D', '2015-11-19 10:27:00', '2015-11-19 10:27:00'),
(32, 31, 'MN2', 21, 2, 21, '21', '2015-11-19 10:27:00', '2015-11-19 10:27:00'),
(33, 30, 'MIce1', 10, 10, 10, '10', NULL, NULL),
(34, 27, 'Test31', 10, 10, 10, '10', NULL, NULL),
(35, 26, 'Test11', 10, 10, 10, '10', NULL, NULL),
(36, 24, 'Test6', 10, 10, 10, '10', NULL, NULL),
(38, 21, 'Test3', 10, 10, 10, '10', NULL, NULL),
(39, 20, 'Test2', 10, 10, 10, '10', NULL, NULL),
(42, 23, 'Test5', 10, 10, 10, '10', NULL, NULL),
(55, 32, 'Dark', 10, NULL, 25, '65CD', NULL, NULL),
(62, 19, 'Dairy Milk', 10, 8, 0, '10', '2015-11-23 13:29:21', '2015-11-23 13:29:21'),
(63, 19, 'Dairy Curd', 15, NULL, 5, '5', '2015-11-23 13:29:21', '2015-11-23 13:29:21'),
(68, 33, 'Green 1 kg', 50, 35, 12, '15DR', '2015-12-01 11:39:54', '2015-12-01 11:39:54'),
(69, 33, 'Rasthali 1 Kg', 60, 40, 96, '65FR', '2015-12-01 11:39:54', '2015-12-01 11:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_alias` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `store_id`, `product_id`, `image`, `image_alias`, `created`, `updated`) VALUES
(1, 1, 25, '7.png', '564afb50433be.7.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 26, '10.jpg', '564afc40608f3.10.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 27, '7.png', '564afcc652412.7.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 28, '7.png', '564afda44b571.7.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 28, '10.jpg', '564afda47c745.10.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 28, 'cap1.jpg', '564afda4d3b73.cap1.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 28, 'cap2.jpg', '564afda510736.cap2.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 29, 'Krishnan.jpg', '564b2714f0907.Krishnan.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 30, 'DSC06491.JPG', '564c05995095e.DSC06491.JPG', '2015-11-18 04:59:14', '2015-11-18 04:59:14'),
(14, 1, 30, 'DSC06486.JPG', '564c05aa78a3c.DSC06486.JPG', '2015-11-18 04:59:31', '2015-11-18 04:59:31'),
(15, 1, 31, '91223351_face977.jpg', '564c0604876bf.91223351_face977.jpg', '2015-11-18 05:00:52', '2015-11-18 05:00:52'),
(16, 1, 31, 'Krishnan.jpg', '564c0604e3368.Krishnan.jpg', '2015-11-18 05:00:53', '2015-11-18 05:00:53'),
(17, 1, 31, 'MN Theme.jpg', '564c060568e77.MN-Theme.jpg', '2015-11-18 05:00:54', '2015-11-18 05:00:54'),
(18, 1, 31, 'Nice123.jpg', '564c0606af79e.Nice123.jpg', '2015-11-18 05:00:54', '2015-11-18 05:00:54'),
(22, 1, 20, 'cap2.jpg', '564da2e753af5.cap2.jpg', '2015-11-19 10:22:31', '2015-11-19 10:22:31'),
(23, 1, 20, 'cap1.jpg', '564da2e7957d0.cap1.jpg', '2015-11-19 10:22:31', '2015-11-19 10:22:31'),
(24, 1, 21, 'Child.jpg', '564da2f7c380d.Child.jpg', '2015-11-19 10:22:48', '2015-11-19 10:22:48'),
(25, 1, 21, 'Dear.jpg', '564da2f83fe56.Dear.jpg', '2015-11-19 10:22:48', '2015-11-19 10:22:48'),
(26, 1, 24, 'result_displa.jpg', '564da30401e84.result_displa.jpg', '2015-11-19 10:23:00', '2015-11-19 10:23:00'),
(27, 1, 22, 'MN Theme.jpg', '564da321df65f.MN-Theme.jpg', '2015-11-19 10:23:31', '2015-11-19 10:23:31'),
(28, 1, 23, 'Samsung2.jpeg', '564dc1dc3f2e5.Samsung2.jpeg', '2015-11-19 12:34:36', '2015-11-19 12:34:36'),
(29, 1, 23, 'Sony-Ericsson-Xperia-active2.jpg', '564dc1dca8cce.Sony-Ericsson-Xperia-active2.jpg', '2015-11-19 12:34:37', '2015-11-19 12:34:37'),
(32, 3, 32, 'apple.jpg', '5652f1f52fec1.apple.jpg', '2015-11-23 11:01:09', '2015-11-23 11:01:09'),
(33, 3, 32, 'eat-an-apple.jpg', '5652f1f5700e8.eat-an-apple.jpg', '2015-11-23 11:01:09', '2015-11-23 11:01:09'),
(39, 3, 19, 'apple.jpg', '565314b196ae3.apple.jpg', '2015-11-23 13:29:21', '2015-11-23 13:29:21'),
(44, 3, 33, 'images.jpeg', '565d39b2367bc.images.jpeg', '2015-12-01 11:39:54', '2015-12-01 11:39:54'),
(45, 3, 33, 'index.jpeg', '565d39b26db34.index.jpeg', '2015-12-01 11:39:54', '2015-12-01 11:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `alias`, `created`, `updated`) VALUES
(1, 'Super Admin', 'superadmin', '2015-10-28 00:00:00', '2015-10-28 00:00:00'),
(2, 'Sub Admin', 'subadmin', '2015-10-28 00:00:00', '2015-10-28 00:00:00'),
(3, 'Store', 'store', '2015-10-28 00:00:00', '2015-10-28 00:00:00'),
(4, 'Customer', 'customer', '2015-10-28 00:00:00', '2015-10-28 00:00:00'),
(5, 'Driver', 'driver', '2015-10-28 00:00:00', '2015-10-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE IF NOT EXISTS `shopping_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_name` text,
  `category_name` varchar(100) NOT NULL,
  `sub_category_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `product_price` float NOT NULL,
  `offer_price` float NOT NULL,
  `product_total_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `shopping_carts`
--

INSERT INTO `shopping_carts` (`id`, `order_id`, `product_id`, `store_id`, `product_name`, `category_name`, `sub_category_name`, `brand_name`, `product_price`, `offer_price`, `product_total_price`, `product_quantity`, `product_description`, `session_id`, `created`, `updated`) VALUES
(1, 19, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 't10rbtuto73qsspanatcghgc15', '2015-11-30 09:28:03', '2015-11-30 09:28:03'),
(2, 19, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 't10rbtuto73qsspanatcghgc15', '2015-11-30 09:28:04', '2015-11-30 09:28:04'),
(3, 20, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', '6rhhq7fo8ivsnc348vurgrncn7', '2015-11-30 09:28:52', '2015-11-30 09:28:52'),
(4, 20, 42, 1, 'Test5 :: Test5', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', '6rhhq7fo8ivsnc348vurgrncn7', '2015-11-30 09:28:53', '2015-11-30 09:28:53'),
(5, 20, 34, 1, 'Test31 :: Test31', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', '6rhhq7fo8ivsnc348vurgrncn7', '2015-11-30 09:28:54', '2015-11-30 09:28:54'),
(6, 21, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'k7ue5llm2cnk0gdjpkrb403oj3', '2015-11-30 09:30:57', '2015-11-30 09:30:57'),
(7, 21, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'k7ue5llm2cnk0gdjpkrb403oj3', '2015-11-30 09:31:00', '2015-11-30 09:31:00'),
(14, 22, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'sqi1h710ljlitcs5tp4hbiodf1', '2015-11-30 13:49:24', '2015-11-30 13:49:24'),
(15, 22, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'sqi1h710ljlitcs5tp4hbiodf1', '2015-11-30 13:49:25', '2015-11-30 13:49:25'),
(16, 23, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'cf0k4hq89moci4mh7iakeprvt5', '2015-11-30 14:39:17', '2015-11-30 14:39:17'),
(17, 23, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'cf0k4hq89moci4mh7iakeprvt5', '2015-11-30 14:39:17', '2015-11-30 14:39:17'),
(18, 23, 42, 1, 'Test5 :: Test5', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'cf0k4hq89moci4mh7iakeprvt5', '2015-11-30 14:39:31', '2015-11-30 14:39:31'),
(19, 24, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'rf03bqqsbjea7j425h8tqes9s5', '2015-11-30 17:03:20', '2015-11-30 17:03:20'),
(20, 24, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'rf03bqqsbjea7j425h8tqes9s5', '2015-11-30 17:03:21', '2015-11-30 17:03:21'),
(21, 26, 30, 2, 'Test4 :: Test4', 'Womens', 'Dress', 'check1', 10, 0, 10, 1, '', 'gkkh2i6eprv440tnl2b08ei885', '2015-11-30 17:12:22', '2015-11-30 17:12:22'),
(22, 26, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'gkkh2i6eprv440tnl2b08ei885', '2015-11-30 17:12:24', '2015-11-30 17:12:24'),
(23, 25, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'gkkh2i6eprv440tnl2b08ei885', '2015-11-30 17:12:30', '2015-11-30 17:12:30'),
(24, 25, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'gkkh2i6eprv440tnl2b08ei885', '2015-11-30 17:12:31', '2015-11-30 17:12:31'),
(25, 29, 35, 3, 'Test11 :: Test11', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', '3llrcfbmpa2499441gjp2kmtl4', '2015-11-30 17:44:10', '2015-11-30 17:44:10'),
(26, 28, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 20, 2, '', '3llrcfbmpa2499441gjp2kmtl4', '2015-11-30 17:46:13', '2015-11-30 17:46:13'),
(27, 27, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', '3llrcfbmpa2499441gjp2kmtl4', '2015-11-30 17:53:15', '2015-11-30 17:53:15'),
(30, 30, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'ql5khst7sddpi9o01sh0nk7fd6', '2015-11-30 18:28:04', '2015-11-30 18:28:04'),
(31, 30, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'ql5khst7sddpi9o01sh0nk7fd6', '2015-11-30 18:28:04', '2015-11-30 18:28:04'),
(32, 31, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'ql5khst7sddpi9o01sh0nk7fd6', '2015-11-30 18:38:59', '2015-11-30 18:38:59'),
(33, 32, 35, 3, 'Test11 :: Test11', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'ql5khst7sddpi9o01sh0nk7fd6', '2015-11-30 18:39:02', '2015-11-30 18:39:02'),
(34, 36, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, 'Hello', 'jp7iqrnn7n1sgcinehdos59ct4', '2015-12-01 09:52:58', '2015-12-01 09:52:58'),
(35, 37, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 10, 1, 'Wait and cook', 'jp7iqrnn7n1sgcinehdos59ct4', '2015-12-01 09:53:03', '2015-12-01 09:53:03'),
(36, 38, 35, 3, 'Test11 :: Test11', 'mens', 'hello1', 'check1', 10, 0, 10, 1, 'am waiting and so Hungry', 'jp7iqrnn7n1sgcinehdos59ct4', '2015-12-01 09:53:07', '2015-12-01 09:53:07'),
(37, 39, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'nerg9b305qbtl50k4klkqjn3p6', '2015-12-01 10:05:18', '2015-12-01 10:05:18'),
(38, 39, 38, 1, 'Test3 :: Test3', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'nerg9b305qbtl50k4klkqjn3p6', '2015-12-01 10:05:19', '2015-12-01 10:05:19'),
(39, 39, 42, 1, 'Test5 :: Test5', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'nerg9b305qbtl50k4klkqjn3p6', '2015-12-01 10:05:21', '2015-12-01 10:05:21'),
(40, 40, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'nerg9b305qbtl50k4klkqjn3p6', '2015-12-01 10:05:26', '2015-12-01 10:05:26'),
(41, 40, 30, 2, 'Test4 :: Test4', 'Womens', 'Dress', 'check1', 10, 0, 10, 1, '', 'nerg9b305qbtl50k4klkqjn3p6', '2015-12-01 10:05:28', '2015-12-01 10:05:28'),
(42, 41, 35, 3, 'Test11 :: Test11', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'nerg9b305qbtl50k4klkqjn3p6', '2015-12-01 10:05:31', '2015-12-01 10:05:31'),
(43, 41, 33, 3, 'MIce1 :: MIce1', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'nerg9b305qbtl50k4klkqjn3p6', '2015-12-01 10:05:32', '2015-12-01 10:05:32'),
(44, 0, 42, 1, 'Test5 :: Test5', 'mens', 'hello1', 'check1', 10, 0, 20, 2, '', 's6vmc9mplsndhpvq20mbprrre5', '2015-12-07 18:25:20', '2015-12-07 18:25:20'),
(45, 0, 34, 1, 'Test31 :: Test31', 'mens', 'hello1', 'check1', 10, 0, 20, 2, '', 's6vmc9mplsndhpvq20mbprrre5', '2015-12-07 18:25:23', '2015-12-07 18:25:23'),
(46, 0, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 's6vmc9mplsndhpvq20mbprrre5', '2015-12-07 18:30:14', '2015-12-07 18:30:14'),
(47, 0, 21, 1, 'MN1 :: MN1', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 's6vmc9mplsndhpvq20mbprrre5', '2015-12-07 18:30:25', '2015-12-07 18:30:25'),
(48, 0, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 's6vmc9mplsndhpvq20mbprrre5', '2015-12-07 18:34:41', '2015-12-07 18:34:41'),
(49, 0, 30, 2, 'Test4 :: Test4', 'Womens', 'Dress', 'check1', 10, 0, 10, 1, '', 's6vmc9mplsndhpvq20mbprrre5', '2015-12-07 18:35:05', '2015-12-07 18:35:05'),
(50, 0, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'lcke21ind4i8u6n4kch3orkpl0', '2015-12-09 10:37:10', '2015-12-09 10:37:10'),
(52, 0, 42, 1, 'Test5 :: Test5', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'lcke21ind4i8u6n4kch3orkpl0', '2015-12-09 10:37:13', '2015-12-09 10:37:13'),
(53, 0, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'lcke21ind4i8u6n4kch3orkpl0', '2015-12-09 10:37:50', '2015-12-09 10:37:50'),
(54, 0, 30, 2, 'Test4 :: Test4', 'Womens', 'Dress', 'check1', 10, 0, 10, 1, '', 'lcke21ind4i8u6n4kch3orkpl0', '2015-12-09 10:37:52', '2015-12-09 10:37:52'),
(55, 0, 35, 3, 'Test11 :: Test11', 'mens', 'hello1', 'check1', 10, 0, 20, 2, '', 'lcke21ind4i8u6n4kch3orkpl0', '2015-12-09 10:37:59', '2015-12-09 10:37:59'),
(57, 0, 55, 3, 'Apple :: Dark', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'lcke21ind4i8u6n4kch3orkpl0', '2015-12-09 10:38:01', '2015-12-09 10:38:01'),
(58, 0, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'e0knjs78l0vmrvsgutuk25vdu0', '2015-12-09 10:49:03', '2015-12-09 10:49:03'),
(59, 0, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'e0knjs78l0vmrvsgutuk25vdu0', '2015-12-09 10:49:07', '2015-12-09 10:49:07'),
(60, 0, 63, 3, 'Test1 :: Dairy Curd', 'mens', 'hello1', 'check1', 15, 0, 75, 5, '', 'e0knjs78l0vmrvsgutuk25vdu0', '2015-12-09 10:49:16', '2015-12-09 10:49:16'),
(61, 0, 39, 1, 'Test2 :: Test2', 'mens', 'hello1', 'check1', 10, 0, 20, 2, '', 'of16bnc5q56tlu3v9942olr350', '2015-12-09 10:51:04', '2015-12-09 10:51:04'),
(62, 0, 36, 2, 'Test6 :: Test6', 'mens', 'hello1', 'check1', 10, 0, 20, 2, '', 'of16bnc5q56tlu3v9942olr350', '2015-12-09 10:51:07', '2015-12-09 10:51:07'),
(63, 0, 55, 3, 'Apple :: Dark', 'mens', 'hello1', 'check1', 10, 0, 10, 1, '', 'of16bnc5q56tlu3v9942olr350', '2015-12-09 10:55:47', '2015-12-09 10:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `sitesettings`
--

CREATE TABLE IF NOT EXISTS `sitesettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `site_logo` varchar(100) NOT NULL,
  `site_fav` varchar(100) NOT NULL,
  `search_by` enum('zip','area') NOT NULL DEFAULT 'zip',
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `contact_us_email` varchar(100) NOT NULL,
  `order_email` varchar(100) NOT NULL,
  `invoice_email` varchar(100) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `site_address` text,
  `site_country` varchar(25) NOT NULL,
  `site_state` varchar(25) NOT NULL,
  `site_city` varchar(25) NOT NULL,
  `site_zip` varchar(10) NOT NULL,
  `site_currency` varchar(10) NOT NULL,
  `site_timezone` varchar(25) NOT NULL,
  `google_analytics` text,
  `woopra_analytics` text,
  `zoopim_code` text,
  `mail_option` enum('SMTP','Normal') NOT NULL DEFAULT 'Normal',
  `smtp_host` varchar(100) NOT NULL,
  `smtp_port` varchar(25) NOT NULL,
  `smtp_username` varchar(100) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,
  `vat_no` varchar(25) NOT NULL,
  `vat_percent` float NOT NULL,
  `card_fee` float NOT NULL,
  `invoice_duration` enum('7 days','15 days') NOT NULL DEFAULT '7 days',
  `offline_status` enum('Yes','No') NOT NULL DEFAULT 'No',
  `offline_notes` text,
  `sms_token` varchar(100) NOT NULL,
  `sms_id` varchar(100) NOT NULL,
  `sms_source_number` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sitesettings`
--

INSERT INTO `sitesettings` (`id`, `user_id`, `site_name`, `site_logo`, `site_fav`, `search_by`, `admin_name`, `admin_email`, `contact_us_email`, `order_email`, `invoice_email`, `contact_phone`, `site_address`, `site_country`, `site_state`, `site_city`, `site_zip`, `site_currency`, `site_timezone`, `google_analytics`, `woopra_analytics`, `zoopim_code`, `mail_option`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `vat_no`, `vat_percent`, `card_fee`, `invoice_duration`, `offline_status`, `offline_notes`, `sms_token`, `sms_id`, `sms_source_number`, `created`, `updated`) VALUES
(1, 1, 'MN', 'logo.png', 'fav.ico', 'area', 'MN', 'Manikandan.mn@roamsoft.in', 'Manikandan.mn@roamsoft.in', 'Manikandan.mn@roamsoft.in', 'Manikandan.mn@roamsoft.in', '9994196333', 'No 7 Water Tank Road,', '1', '1', '1', '2', '', '123', '', '', NULL, 'Normal', '', '', '', '', '123', 12, 12, '7 days', 'Yes', '', '123', '123', '123', '2015-11-12 08:38:53', '2015-11-30 10:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `state_code` varchar(10) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state_name`, `state_code`, `status`, `created`, `updated`) VALUES
(1, 1, 'test1', '', '1', '2015-11-05 12:41:39', '2015-11-05 12:41:50'),
(6, 98, 'keralas', '', '1', '2015-11-05 10:58:42', '2015-11-05 12:40:06'),
(8, 98, 'tamilnadu', '', '1', '2015-11-07 12:10:00', '2015-11-07 12:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `title`, `alias`, `created`, `updated`) VALUES
(1, 'Pending', 'pending', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(2, 'Accepted', 'accepted', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(3, 'Assigned', 'assigned', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(4, 'Picked Up', 'pickedup', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(5, 'Delivered', 'delivered', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(6, 'Available', 'available', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(7, 'On Break', 'onbreak', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(8, 'End Of Shift', 'endofshift', '2015-10-29 00:00:00', '2015-10-29 00:00:00'),
(9, 'Offline', 'offline', '2015-10-29 00:00:00', '2015-10-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `storeoffers`
--

CREATE TABLE IF NOT EXISTS `storeoffers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `offer_percentage` int(11) NOT NULL,
  `offer_price` float NOT NULL,
  `from_date` varchar(15) NOT NULL,
  `to_date` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `storeoffers`
--

INSERT INTO `storeoffers` (`id`, `store_id`, `offer_percentage`, `offer_price`, `from_date`, `to_date`, `status`, `created`, `updated`) VALUES
(1, 2, 2, 10, '11/30/2015', '12/30/2015', 1, '2015-11-20 00:00:00', '2015-11-30 17:12:03'),
(2, 1, 5, 2500, '11/21/2015', '11/29/2015', 1, '2015-11-20 11:44:38', '2015-11-20 11:44:38'),
(3, 1, 2, 25, '11/24/2015', '11/29/2015', 1, '2015-11-20 11:45:44', '2015-11-20 11:58:11'),
(4, 1, 15, 15, '11/21/2015', '11/30/2015', 1, '2015-11-20 12:01:56', '2015-11-20 12:03:18'),
(5, 1, 15, 1500, '11/05/2015', '11/10/2015', 1, '2015-11-20 12:41:49', '2015-11-20 12:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `store_state` varchar(25) NOT NULL,
  `store_city` varchar(25) NOT NULL,
  `store_zip` varchar(10) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `store_phone` varchar(15) NOT NULL,
  `store_logo` varchar(100) NOT NULL,
  `store_description` text NOT NULL,
  `email_order` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `order_email` varchar(100) NOT NULL,
  `sms_option` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `sms_phone` varchar(15) NOT NULL,
  `delivery_option` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `self_delivery` enum('Yes','No') NOT NULL DEFAULT 'No',
  `minimum_order` float NOT NULL DEFAULT '0',
  `tax` float NOT NULL,
  `commission` int(15) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `user_id`, `contact_name`, `contact_phone`, `contact_email`, `street_address`, `store_state`, `store_city`, `store_zip`, `store_name`, `store_phone`, `store_logo`, `store_description`, `email_order`, `order_email`, `sms_option`, `sms_phone`, `delivery_option`, `self_delivery`, `minimum_order`, `tax`, `commission`, `created`, `updated`) VALUES
(1, 22, 'Store1', '999', 'Manikandan.mn@roamsoft.in', '12', '1', '1', '4', 'Store1', '99', '237991447242051.jpg', 'Mani', 'No', 'Manikandan.mn@roamsoft.in', 'No', '', 'Yes', 'No', 100, 0, 0, '2015-11-11 09:58:49', '2015-11-30 17:53:53'),
(2, 38, 'MN', '123', '123@roamsoft.in', '12', '1', '1', '2', 'Store2', '564', '12351447319470.jpg', 'mani', 'Yes', 'Manikandan.mn@roamsoft.in', 'No', '', 'Yes', 'No', 10, 10, 0, '2015-11-12 09:10:46', '2015-11-25 14:19:56'),
(3, 42, 'ds', '12354', 'Manikandan.mn@roamsoft.in', 'MN', '1', '1', '2', 'Store3', '123456', '222131447320044.jpg', 'MN', 'Yes', 'Manikandan.mn@roamsoft.in', 'No', '123', 'Yes', 'No', 10, 10, 10, '2015-11-12 09:20:44', '2015-11-25 14:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_customers`
--

CREATE TABLE IF NOT EXISTS `stripe_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `stripe_token_id` varchar(150) NOT NULL,
  `stripe_customer_id` varchar(150) NOT NULL,
  `card_id` varchar(150) NOT NULL,
  `card_number` varchar(150) NOT NULL,
  `card_brand` varchar(50) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `country` varchar(10) NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stripe_customers`
--

INSERT INTO `stripe_customers` (`id`, `customer_id`, `customer_name`, `stripe_token_id`, `stripe_customer_id`, `card_id`, `card_number`, `card_brand`, `card_type`, `exp_month`, `exp_year`, `country`, `client_ip`, `status`, `created`, `updated`) VALUES
(3, 13, 'Rani', 'tok_17C88YAZHYIt83y1wtheeebr', 'cus_7Rc552TqiwXG2J', 'card_17C88YAZHYIt83y1m9CiQ0Co', '1111', 'Visa', 'unknown', 6, 2020, 'US', '219.91.219.14', 1, '2015-11-28 18:19:09', '2015-11-28 18:19:09'),
(2, 13, 'MN', 'tok_17C82kAZHYIt83y1fZNv0VxQ', 'cus_7R03mgtTQZy5PP', 'card_17C82kAZHYIt83y1gcYQfA0r', '4242', 'Visa', 'credit', 3, 2021, 'US', '219.91.219.14', 1, '2015-11-28 18:13:09', '2015-11-28 18:13:09'),
(4, 13, 'DD', 'tok_7R0Kp91VcFaZvY', 'cus_7R0KlIx6SBhPLu', 'card_7R0Kj6gxFvZQws', '4242', 'Visa', 'credit', 9, 2023, 'US', '219.91.219.14', 1, '2015-11-28 18:30:33', '2015-11-28 18:30:33'),
(6, 13, 'Roamsoft', 'tok_17Cr77AZHYIt83y1UyLBmkZN', 'cus_7RkceniRFneTiK', 'card_17Cr77AZHYIt83y1cKsjqlhO', '4242', 'Visa', 'credit', 7, 2023, 'US', '219.91.219.14', 1, '2015-11-30 18:20:40', '2015-11-30 18:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE IF NOT EXISTS `time_slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_from` varchar(15) NOT NULL,
  `time_to` varchar(15) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `time_from`, `time_to`, `created`, `updated`) VALUES
(1, '12.00 AM', '2.00 AM', NULL, NULL),
(2, '2.00 AM', '4.00 AM', NULL, NULL),
(3, '4.00 AM', '6.00 AM', NULL, NULL),
(4, '6.00 AM', '8.00 AM', NULL, NULL),
(5, '8.00 AM', '10.00 AM', NULL, NULL),
(6, '10.00 AM', '12.00 PM', NULL, NULL),
(7, '12.00 PM', '2.00 PM', NULL, NULL),
(8, '2.00 PM', '4.00 PM', NULL, NULL),
(9, '4.00 PM', '6.00 PM', NULL, NULL),
(10, '6.00 PM', '8.00 PM', NULL, NULL),
(11, '8.00 PM', '10.00 PM', NULL, NULL),
(12, '10.00 PM', '12.00 AM', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `created`, `updated`) VALUES
(1, 1, 'admin', '6e0707d6ffcf99c61af09104ae54e6584ce20464', '0000-00-00 00:00:00', '2015-11-11 10:47:57'),
(22, 3, 'manikandan.mn112@roamsoft.in', '123456', '2015-11-11 09:58:49', '2015-11-30 17:53:53'),
(33, 3, 'Manikandan.mn1@roamsoft.in', '123456', '2015-11-11 12:42:11', '2015-11-11 12:42:11'),
(34, 3, 'Manikandan.mn2@roamsoft.in', '123456', '2015-11-11 12:44:38', '2015-11-11 12:44:38'),
(35, 3, 'Manikandan.mn4@roamsoft.in', '123456', '2015-11-11 12:48:01', '2015-11-11 12:48:01'),
(37, 3, 'RR@roamsoft.in', '123456', '2015-11-12 09:00:49', '2015-11-12 09:00:49'),
(38, 3, 'manikandan.mn3@roamsoft.in', '123456', '2015-11-12 09:10:46', '2015-11-25 14:19:56'),
(39, 3, 'MNN@roamsoft.in', '123456', '2015-11-12 09:12:34', '2015-11-12 09:12:34'),
(40, 3, 'manikandan.mn5@roamsoft.in', '123456', '2015-11-12 09:16:22', '2015-11-12 09:16:22'),
(41, 3, 'manikandan.mn6@roamsoft.in', '123456', '2015-11-12 09:17:07', '2015-11-12 09:17:07'),
(42, 3, 'MN12@roamsoft.in', '123456', '2015-11-12 09:20:44', '2015-11-25 14:41:39'),
(43, 3, 'MN21@roamsoft.in', '123456', '2015-11-12 09:36:23', '2015-11-12 09:36:23'),
(44, 3, 'MN22@roamsoft.in', '123456', '2015-11-12 09:43:04', '2015-11-12 09:43:04'),
(45, 3, 'MN23@roamsoft.in', '123456', '2015-11-12 09:45:26', '2015-11-12 09:45:26'),
(46, 4, 'manikandan.mn@roamsoft.in', '6e0707d6ffcf99c61af09104ae54e6584ce20464', '2015-11-21 12:51:30', '2015-11-21 12:51:30'),
(47, 4, 'jana@gmail.com', '6e0707d6ffcf99c61af09104ae54e6584ce20464', '2015-11-21 12:53:31', '2015-11-21 12:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `updated` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_id` (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_code` varchar(50) NOT NULL,
  `type_offer` enum('single','multiple') NOT NULL DEFAULT 'single',
  `offer_mode` enum('price','percentage') NOT NULL DEFAULT 'percentage',
  `offer_value` int(11) NOT NULL,
  `from_date` varchar(15) NOT NULL,
  `to_date` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '1' COMMENT '0-deactive,1-active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `voucher_code`, `type_offer`, `offer_mode`, `offer_value`, `from_date`, `to_date`, `created`, `updated`, `status`) VALUES
(9, 'checking', 'single', 'price', 3, '11/20/2015', '11/30/2015', '2015-11-20 08:34:31', '2015-11-20 08:34:31', '1'),
(10, 'demo', 'single', 'price', 4, '11/20/2015', '11/29/2015', '2015-11-20 08:37:17', '2015-11-20 08:37:17', '1'),
(11, 'jana', 'multiple', 'price', 23, '11/30/2015', '11/23/2015', '2015-11-20 08:59:42', '2015-11-20 09:12:27', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address_books`
--
ALTER TABLE `customer_address_books`
  ADD CONSTRAINT `customer_address_books_ibfk_3` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `customer_address_books_ibfk_4` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `customer_address_books_ibfk_5` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `customer_address_books_ibfk_6` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  ADD CONSTRAINT `delivery_locations_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `delivery_locations_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `delivery_time_slots`
--
ALTER TABLE `delivery_time_slots`
  ADD CONSTRAINT `delivery_time_slots_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `delivery_time_slots_ibfk_2` FOREIGN KEY (`slot_id`) REFERENCES `time_slots` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver_trackings`
--
ALTER TABLE `driver_trackings`
  ADD CONSTRAINT `driver_trackings_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `locations_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_statues`
--
ALTER TABLE `orders_statues`
  ADD CONSTRAINT `orders_statues_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_statues_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_statues_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sitesettings`
--
ALTER TABLE `sitesettings`
  ADD CONSTRAINT `sitesettings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
