-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2017 at 10:53 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Maven`
--

-- --------------------------------------------------------

--
-- Table structure for table `Maven`
--

use Maven;

Drop Table if exists `Mavens`;

CREATE TABLE `Mavens` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `CouponCode` varchar(10),
  `City` varchar(30),
  `State` varchar(30),
  `Email` varchar(50),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Insert initial data for table `Mavens`
--

INSERT INTO `Mavens` (`ID`, `FirstName`, `LastName`, `CouponCode`,`City`,`State`,`Email`) VALUES
(1, 'Elizabeth', 'Young', 'Beth20','Goodson','Missouri','knesheep@gmail.com'),
(2, 'Michael', 'Miller', 'Mill20','Millersburg','Ohio','michaelm@keimlumber.com'),
(3, 'Buddy', 'Burns', 'Bud20','Spring','Texas',''),
(4, 'Brenda','Clausen','Bren20','Andover','Minnesota','ericbrenda1@msn.com');
('','Cheryl','Curtis','Curt20','Waldorf','Maryland','clc423@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
