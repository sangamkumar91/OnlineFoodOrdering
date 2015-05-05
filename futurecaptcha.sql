-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2013 at 11:32 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `futurecaptcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_building` text NOT NULL,
  `customer_street` varchar(50) NOT NULL,
  `customer_city` varchar(20) NOT NULL,
  `customer_state` varchar(20) NOT NULL,
  `customer_zipcode` varchar(20) NOT NULL,
  `customer_countrycode` varchar(20) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `customer_building`, `customer_street`, `customer_city`, `customer_state`, `customer_zipcode`, `customer_countrycode`) VALUES
(9, 'adadv', 'sfvbsfb', 'sdvsdv', 'sdv', '5119', ''),
(10, 'dfgn', 'sdfvdfg', 'sssfgnfg', 'sdfvsvfgnf', '34534', ''),
(11, 'dfgn', 'sdfvdfg', 'sssfgnfg', 'sdfvsvfgnf', '34534', ''),
(12, 'adv', 'sdv', 'vellore', 'sdvsdv', '56416', ''),
(13, 'dfgn', 'dd', 'vellore', 'dd', '335001', ''),
(14, 'dfgn', 'dd', 'vellore', 'dd', '335001', ''),
(15, 'dfgn', 'dd', 'vellore', 'dd', '4566', ''),
(16, 'kjbkll', 'sdfv', 'vellore', 'dcfdfc', '345', ''),
(17, 'kjbkll', 'sdfv', 'vellore', 'dcfdfc', '345', ''),
(18, 'kjbkll', 'sdfv', 'vellore', 'dcfdfc', '345', ''),
(19, 'kjbkll', 'sdfv', 'vellore', 'dcfdfc', '345', ''),
(20, 'kjbkll', 'sdfv', 'vellore', 'dcfdfc', '345', ''),
(21, 'kjbkll', 'sdfv', 'vellore', 'dcfdfc', '345', ''),
(22, 'WHITE HOUSE', 'raj PATH', 'Bangalore', 'boston', '111223', ''),
(23, 'dfbsdfbsf', 'sdfv', 'vellore', 'dsfbsd', '345', ''),
(24, 'sdvb', 'sdfvdfg', 'vellore', 'ergsdfb', '2222222', ''),
(25, 'dsfbsdb', 'sdfv', 'vellore', 'dgfbsdgb', '345', ''),
(26, 'fbsdfbfdg', 'sdfv', 'vellore', 'sdfbsdfb', '345', ''),
(27, 'sfvsdfbdfb', 'ssdfbdfbd', 'vellore', 'dfbdfbds', '345346534', ''),
(28, 'wfbgfbg', 'wrgbergb', 'vellore', 'wgbregb', '234545', ''),
(29, 'dgfdgf', 'gdfgg', 'vellore', 'gffdg', '434234', ''),
(30, 'fgfdsgsdf', 'sdfsdfsd', 'vellore', 'dgf', '222222', ''),
(31, 'sddsfdsf', 'fdsfsf', 'vellore', 'dfggf', '222222', ''),
(32, 'dgfdd', 'dfgfdgdgd', 'vellore', 'ffdgfgd', '4324323', ''),
(33, 'sfdfsdf', 'sfdfsd', 'vellore', 'fdsdfsf', '4343545', ''),
(34, 'sadaddsa', 'fgsdf', 'vellore', 'fdsgsdf', '334432', ''),
(35, 'sfdfs', 'fsds', 'vellore', 'fsdsdf', '354535', ''),
(36, 'fdsf', 'sfdsfds', 'vellore', 'sfdsdd', '4453535', ''),
(37, 'sfddfsfd', 'dfsfss', 'vellore', 'fsdfsd', '4535345', ''),
(38, 'dsffsd', 'fsddfsdffds', 'vellore', 'sdfsfsdf', '543535', ''),
(39, 'fgffgffgd', 'fdggdfg', 'vellore', 'gdgfgffg', '4534454', ''),
(40, 'fdssdsfs', 'fsdsfdfsd', 'vellore', 'dfgdgf', '4534535', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `business_info`
--

CREATE TABLE IF NOT EXISTS `business_info` (
  `location_id` int(20) NOT NULL AUTO_INCREMENT,
  `website_id` int(20) NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `business_building` varchar(50) NOT NULL,
  `business_street` varchar(50) NOT NULL,
  `business_city` varchar(20) NOT NULL,
  `business_state` varchar(20) NOT NULL,
  `business_zipcode` int(10) NOT NULL,
  `business_countrycode` int(10) NOT NULL,
  `business_contact` varchar(255) NOT NULL,
  `restaurant_type` varchar(9) NOT NULL,
  `maximum_delivery_km` int(3) NOT NULL,
  `minimum_delivery_cost` int(4) NOT NULL,
  `restaurant_cuisine` set('north indian','chinese') NOT NULL,
  `delivery_charges` int(4) NOT NULL,
  `alcohol_facility` tinyint(1) NOT NULL,
  `dine_in` tinyint(1) NOT NULL,
  `catering` tinyint(1) NOT NULL,
  `credit_card` tinyint(1) NOT NULL,
  `cost_for_two` int(11) NOT NULL,
  `air_conditioned` tinyint(1) NOT NULL,
  `tax` int(4) NOT NULL,
  `take_away` tinyint(1) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `home_delivery` tinyint(1) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `restaurant_timings` varchar(20) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `website_id` (`website_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `business_info`
--

INSERT INTO `business_info` (`location_id`, `website_id`, `business_name`, `business_building`, `business_street`, `business_city`, `business_state`, `business_zipcode`, `business_countrycode`, `business_contact`, `restaurant_type`, `maximum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `air_conditioned`, `tax`, `take_away`, `thumbnail`, `home_delivery`, `open_time`, `close_time`, `restaurant_timings`) VALUES
(1, 1, 'Sangam, Phase 3 U-78', 'U-78/43', 'vit gate 3', 'vit', 'Tamil Naud', 12345, 11, '43242111', 'veg', 2, 150, 'north indian', 0, 1, 1, 1, 0, 200, 0, 13, 1, 'locations\\thumb1(1).jpg', 1, '09:00:00', '20:00:00', '7:00 am to 10:00 pm'),
(2, 1, 'Sangam, Phase 3', 'U-22/63', 'vit phase 3', 'cmc', 'Tamil Naud', 12345, 11, '43242432', 'veg', 2, 250, 'north indian,chinese', 10, 0, 1, 0, 1, 300, 1, 5, 1, 'locations\\thumb2(1).jpg', 0, '11:00:00', '18:00:00', '1:00 pm to 8:00 pm '),
(3, 2, 'Sangam, phase 2', 'RBS', 'Sikandarpur', 'cmc', 'Tamil Naud', 12345, 11, '9876543212', 'non-veg', 4, 350, 'north indian,chinese', 50, 1, 1, 1, 1, 400, 1, 13, 0, 'locations\\thumb3(1).jpg', 1, '11:00:00', '16:00:00', '10:00 am to 1:00 pm'),
(4, 3, 'Arka, Phase 3', 'X-67', 'street 1', 'vit', 'Tamil Naud', 12345, 11, '9876456781', 'non-veg', 0, 0, 'north indian,chinese', 0, 1, 1, 0, 1, 500, 1, 13, 0, 'locations\\thumb4(1).jpg', 1, '04:00:00', '18:00:00', '10:00 am to 11:00 pm'),
(5, 4, 'Arka, Udyog', 'Z-78', 'Market road', 'cmc', 'Tamil Naud', 12345, 11, '9874567345', 'veg', 0, 0, 'north indian', 0, 0, 1, 1, 0, 320, 0, 3, 1, 'locations\\thumb5(1).jpg', 0, '16:00:00', '22:00:00', '10:00 am to 6:00 pm'),
(6, 5, 'mp singh', '7B', 'Canara road', 'vit', 'Tamil Naud', 12345, 11, '9845673216', 'non-veg', 3, 200, 'north indian,chinese', 0, 1, 1, 0, 0, 700, 1, 13, 1, 'locations\\thumb6(1).jpg', 1, '00:00:00', '00:00:00', '9:00 am to 10:00 pm'),
(7, 6, 'MP, Kailash', 'Sardar''s', 'Kailash colony', 'chitoor', 'Tamil Naud', 12345, 11, '9876789876', 'veg', 2, 220, 'chinese', 0, 1, 1, 0, 1, 450, 0, 6, 1, 'locations\\thumb7(1).jpg', 1, '00:00:00', '06:00:00', '3:00 pm to 9:00 pm');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_fname` varchar(50) NOT NULL,
  `customer_sname` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_password` varchar(32) NOT NULL,
  `customer_contact_1` varchar(15) NOT NULL,
  `customer_contact_2` varchar(15) NOT NULL DEFAULT '0000000000',
  `hash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_fname`, `customer_sname`, `customer_email`, `customer_password`, `customer_contact_1`, `customer_contact_2`, `hash`, `active`) VALUES
(37, 'Sangam', 'kumar', 'sangamkumar91@gmail.com', '447266', '43232323243', '0000000000', '941e1aaaba585b952b62c14a3a175a61', 1),
(38, 'Arkajit', 'Bhattacharya', 'arkajitb@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '546464565', '0000000000', '03afdbd66e7929b125f8597834fa83a4', 1),
(39, 'Mohinder', 'Pratap', 'mpsingh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '786756767567', '0000000000', '6cd67d9b6f0150c77bda2eda01ae484c', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE IF NOT EXISTS `customer_address` (
  `customer_id` int(20) NOT NULL,
  `address_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`customer_id`, `address_id`) VALUES
(4, 4),
(8, 9),
(9, 10),
(10, 11),
(11, 12),
(12, 13),
(13, 14),
(14, 15),
(15, 16),
(16, 17),
(17, 18),
(18, 19),
(19, 20),
(20, 21),
(21, 22),
(22, 23),
(23, 24),
(24, 25),
(25, 26),
(26, 27),
(27, 28),
(28, 29),
(29, 30),
(30, 31),
(31, 32),
(32, 33),
(33, 34),
(34, 35),
(35, 36),
(36, 37),
(37, 38),
(38, 39),
(39, 40);

-- --------------------------------------------------------

--
-- Table structure for table `customer_favourite_restaurants`
--

CREATE TABLE IF NOT EXISTS `customer_favourite_restaurants` (
  `customer_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_men`
--

CREATE TABLE IF NOT EXISTS `delivery_men` (
  `dm_id` int(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'free',
  `place` varchar(20) NOT NULL,
  `time_counter` varchar(50) NOT NULL DEFAULT '40',
  `run` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_men`
--

INSERT INTO `delivery_men` (`dm_id`, `status`, `place`, `time_counter`, `run`) VALUES
(1, 'free', '', 'stop', 0),
(2, 'free', '', 'stop', 0),
(3, 'free', '', 'stop', 0),
(4, 'free', '', 'stop', 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `member_email` varchar(50) NOT NULL,
  `member_password` varchar(20) NOT NULL,
  `member_website` varchar(50) NOT NULL,
  `member_gender` varchar(10) NOT NULL,
  `member_contact` varchar(50) NOT NULL,
  `member_street` varchar(50) NOT NULL,
  `member_city` varchar(20) NOT NULL,
  `member_state` varchar(20) NOT NULL,
  `member_zipcode` int(10) NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `second_name`, `member_email`, `member_password`, `member_website`, `member_gender`, `member_contact`, `member_street`, `member_city`, `member_state`, `member_zipcode`) VALUES
(1, 'sangam', 'kumar', 'sangamkumar91', 'sangam', 'sangam.com', 'Male', '3423423432', 'f block', 'vellore', 'tn', 12345),
(2, 'arkajit', 'bhattacharya', 'arka1392', 'arka', 'arkal.com', 'Male', '8285236648', 'b block', 'vellore', 'tn', 12345),
(3, 'mp', 'singh', 'moy', 'mp', 'mp.com', 'Male', '9876543212', 'l block', 'vellore', 'tn', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `delivery_status` tinyint(1) NOT NULL DEFAULT '0',
  `order_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `favourite_order` tinyint(1) NOT NULL DEFAULT '0',
  `order_price` int(10) NOT NULL,
  `loc` varchar(20) NOT NULL,
  `dm_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `location_id`, `delivery_status`, `order_date_time`, `favourite_order`, `order_price`, `loc`, `dm_id`) VALUES
(61, 39, 4, 0, '2013-11-10 22:11:49', 0, 316, 'vit', 1),
(62, 39, 6, 0, '2013-11-10 22:12:15', 0, 441, 'vit', 1),
(63, 39, 7, 0, '2013-11-10 22:12:47', 0, 360, 'chitoor', 2),
(64, 39, 4, 0, '2013-11-10 22:16:15', 0, 316, 'vit', 1),
(65, 39, 4, 0, '2013-11-10 22:16:39', 0, 316, 'vit', 1),
(66, 39, 3, 0, '2013-11-10 22:17:12', 0, 525, 'cmc', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE IF NOT EXISTS `order_product` (
  `order_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `product_quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `product_quantity`) VALUES
(33, 12, 4),
(34, 12, 2),
(35, 12, 2),
(36, 12, 3),
(37, 12, 2),
(38, 12, 2),
(39, 12, 2),
(40, 12, 2),
(41, 12, 2),
(42, 12, 4),
(43, 12, 2),
(44, 12, 2),
(45, 12, 2),
(46, 12, 2),
(47, 12, 3),
(48, 12, 2),
(49, 12, 2),
(50, 22, 2),
(51, 12, 2),
(52, 22, 2),
(53, 22, 2),
(54, 12, 3),
(55, 12, 3),
(56, 22, 3),
(57, 17, 5),
(58, 22, 9),
(59, 12, 2),
(60, 22, 7),
(61, 22, 7),
(62, 27, 2),
(62, 28, 2),
(62, 29, 1),
(63, 32, 4),
(63, 36, 4),
(64, 22, 7),
(65, 22, 7),
(66, 17, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(20) NOT NULL AUTO_INCREMENT,
  `location_id` int(20) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_type` varchar(10) NOT NULL,
  `product_price` int(5) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `location_id`, `product_name`, `product_description`, `product_category`, `product_type`, `product_price`) VALUES
(1, 1, 'butter paneer masaala', 'meetha paneer', 'sabzi', 'veg', 95),
(2, 2, 'mutter paneer', 'Panner and mutter', 'paneer', 'veg', 100),
(3, 1, 'Paneer Lababdar', 'Teekha paneer', 'sabzi', 'veg', 80),
(4, 1, 'Butter Roti', 'Roti with butter', 'breads', 'veg', 5),
(5, 1, 'Butter Naan', 'Naan with  butter', 'breads', 'veg', 10),
(6, 1, 'Dal Makhani', 'Kaali Daal', 'Daal', 'veg', 75),
(7, 1, 'Dal Fry', 'Yellow Dal', 'Daal', 'veg', 65),
(8, 2, 'paneer pasanda', 'paneer khatta', 'paneer', 'veg', 95),
(9, 2, 'dal punjabi', 'dal from punjab', 'dal', 'veg', 80),
(10, 2, 'tandoori roti', 'roti tandoor se', 'tandoor se', 'veg', 6),
(11, 2, 'lachhca parantha', 'lazeez paranthe', 'Paranthe', 'veg', 15),
(12, 2, 'Noodles', 'Chowmein', 'Chinese', 'veg', 150),
(13, 3, 'kadhai paneer', 'shimlamirch,onion,paneer', 'sabzi', 'veg', 90),
(14, 3, 'butter chicken', 'chicken tasty', 'sabzi', 'non-veg', 120),
(15, 3, 'Tandoori Butter roti', 'Butter wali roti', 'Roti', 'veg', 5),
(16, 3, 'Tawa roti', 'tawe wali roti', 'Roti', 'veg', 3),
(17, 3, 'egg chowmein', 'egg wali chowmein', 'Chinese', 'non-veg', 70),
(18, 4, 'Chicken lababdar', 'Spicy', 'Saag', 'non-veg', 110),
(19, 4, 'Murgi Malai', 'Hen fresh', 'Saag', 'non-veg', 110),
(20, 4, 'Aloo Parantha', 'Stuffed with potato', 'Parantha', 'veg', 25),
(21, 4, 'Pyaaz Parantha', 'Stuffed with Onion', 'Parantha', 'veg', 25),
(22, 4, 'Chicken Momos', 'Momos Spicy', 'Momos', 'non-veg', 40),
(23, 5, 'butter dal makhani', 'dal black', 'dal', 'veg', 120),
(24, 5, 'dal pindi', 'dal from pind', 'dal', 'veg', 135),
(25, 5, 'Pudhina Parantha', 'Stuffed parantha', 'parantha', 'veg', 35),
(26, 5, 'Butter Naan', 'Naan', 'Tandoor Se', 'veg', 25),
(27, 6, 'Veg Noodles', 'less spicy', 'Chinese', 'veg', 70),
(28, 6, 'Chicken Noodles', 'Non-veg chowmein', 'Chinese', 'non-veg', 100),
(29, 6, 'Veg Momos', 'Momos', 'Chinese', 'veg', 50),
(30, 6, 'butter chicken', 'Spicy chicken', 'North Indian', 'non-veg', 130),
(31, 6, 'Tawa Roti', 'Tawe ki roti', 'Roti', 'veg', 4),
(32, 7, 'Veg Momos', 'Momos Spicy veg', 'Momos', 'veg', 35),
(33, 7, 'Veg Hakka Noodles', 'Plain non spicy', 'Noodles', 'veg', 80),
(34, 7, 'Veg Singapori Noodles', 'Singapore''s Flavour', 'Noodles', 'veg', 90),
(35, 7, 'Chilly potato', 'honey chill potato, sweet', 'Starters', 'veg', 60),
(36, 7, 'Panner Momos', 'Panner stuffed ', 'Momos', 'veg', 50);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `location_id` int(20) NOT NULL,
  `restaurant_type` varchar(9) NOT NULL,
  `restaurant_timings` varchar(20) NOT NULL,
  `minimum_delivery_km` int(3) NOT NULL,
  `minimum_delivery_cost` int(4) NOT NULL,
  `restaurant_cuisine` set('north indian','chinese') NOT NULL,
  `delivery_charges` int(4) NOT NULL,
  `alcohol_facility` tinyint(1) NOT NULL,
  `dine_in` tinyint(1) NOT NULL,
  `catering` tinyint(1) NOT NULL,
  `credit_card` tinyint(1) NOT NULL,
  `cost_for_two` int(6) NOT NULL,
  `Air_conditioned` tinyint(1) NOT NULL,
  KEY `location_id` (`location_id`),
  KEY `location_id_2` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`location_id`, `restaurant_type`, `restaurant_timings`, `minimum_delivery_km`, `minimum_delivery_cost`, `restaurant_cuisine`, `delivery_charges`, `alcohol_facility`, `dine_in`, `catering`, `credit_card`, `cost_for_two`, `Air_conditioned`) VALUES
(1, 'veg', '11 pmm tp 9pm', 33, 33, 'north indian', 343, 1, 1, 1, 1, 3232, 1);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE IF NOT EXISTS `websites` (
  `website_id` int(20) NOT NULL AUTO_INCREMENT,
  `website_domain` varchar(50) NOT NULL,
  `member_id` int(20) NOT NULL,
  `about_us` varchar(255) NOT NULL,
  PRIMARY KEY (`website_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`website_id`, `website_domain`, `member_id`, `about_us`) VALUES
(1, 'eatatsangamone.com', 1, 'Eat good food'),
(2, 'eatatsangamtwo.com', 1, 'eat at sangam, palam vihar'),
(3, 'eatatmp1.com', 2, 'Eat '),
(4, 'eatatmptwo.com', 2, 'Eat a'),
(5, 'eatatarka.com', 3, 'Eat a'),
(6, 'eatatarkatwo.com', 3, 'Eat ');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_info`
--
ALTER TABLE `business_info`
  ADD CONSTRAINT `business_info_ibfk_1` FOREIGN KEY (`website_id`) REFERENCES `websites` (`website_id`);

--
-- Constraints for table `websites`
--
ALTER TABLE `websites`
  ADD CONSTRAINT `websites_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
