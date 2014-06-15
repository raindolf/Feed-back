-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2014 at 03:02 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cola`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--


--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customerId` int(11) NOT NULL auto_increment,
  `uName` varchar(128) NOT NULL,
  `uEmail` varchar(128) NOT NULL,
  `uMobile` varchar(128) NOT NULL,
  `uUsername` varchar(128) NOT NULL,
  `uPassword` varchar(40) NOT NULL,
  `uSalt` varchar(128) NOT NULL,
  `uActivity` datetime NOT NULL,
  `uCreated` datetime NOT NULL,
  PRIMARY KEY  (`customerId`),
  UNIQUE KEY `uUsername` (`uUsername`)
	) ENGINE=MyISAM AUTO_INCREMENT=1 ;

	
CREATE TABLE IF NOT EXISTS `customers_information` (
  `customerId` int(11) NOT NULL,
  `infoKey` varchar(128) NOT NULL,
  `InfoValue` text NOT NULL,
  PRIMARY KEY (`customerId`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `products` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(32) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `customerId` int(2) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `suggestion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `feedback`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
