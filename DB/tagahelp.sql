-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2013 at 12:49 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tagahelp`
--

-- --------------------------------------------------------

--
-- Table structure for table `funds_breakdown`
--

CREATE TABLE IF NOT EXISTS `funds_breakdown` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `breakdown` text NOT NULL,
  `percentage` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `funds_breakdown`
--

INSERT INTO `funds_breakdown` (`id`, `owner`, `breakdown`, `percentage`) VALUES
(1, 558, 'Medical', 40),
(2, 558, 'Street Children Donation', 40),
(3, 558, 'TAGBOND', 20),
(84, 568, 'red', 65),
(85, 568, 'der', 15),
(86, 568, 'TAGBOND', 20);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` text NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receiver` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `sender`, `comment`, `date`, `receiver`) VALUES
(1, 'Rienier Patron Dev', 'test', '2013-11-30 23:37:09', 558),
(2, 'Rienier Patron Dev', 'test again', '2013-11-30 23:42:25', 558),
(3, 'Rienier Patron Dev', 'test again', '2013-11-30 23:43:54', 558),
(4, 'Rienier Patron Dev', 'test again', '2013-11-30 23:44:03', 558),
(5, 'Rienier Patron Dev', 'test again', '2013-11-30 23:44:14', 558),
(6, 'Rienier Patron Dev', 'test again', '2013-11-30 23:44:43', 558),
(7, 'Rienier Patron Dev', 'test again', '2013-11-30 23:45:05', 558),
(8, 'Rienier Patron Dev', 'latest', '2013-11-30 23:45:19', 558);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
