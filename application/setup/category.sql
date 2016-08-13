-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2012 at 08:58 AM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `soft_center`
--

-- --------------------------------------------------------

USE soft_center;
--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_type` int(10) NOT NULL,
  `cat_name` text,
  `cat_img` text,
  `cat_link` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_type`, `cat_name`, `cat_img`, `cat_link`) VALUES
(1, 'java', 'java', 'java'),
(1, 'perl', 'perl', 'perl'),
(1, 'python', 'python', 'python'),
(1, 'php', 'php', 'php'),
(1, 'ruby', 'ruby', 'ruby'),
(1, 'web', 'web', 'web'),
(1, 'devel', 'devel', 'devel'),
(1, 'editors', 'editors', 'editors');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
