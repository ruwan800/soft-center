-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2012 at 03:07 AM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

USE soft_center;

--
-- Database: `soft_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_type` int(10) NOT NULL,
  `cat_name` text,
  `cat_img` text,
  `cat_link` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_type`, `cat_name`, `cat_img`, `cat_link`) VALUES
(1, 1, 'java', 'java', 'java'),
(2, 1, 'perl', 'perl', 'perl'),
(3, 1, 'python', 'python', 'python'),
(4, 1, 'php', 'php', 'php'),
(5, 1, 'ruby', 'ruby', 'ruby'),
(6, 1, 'web', 'web', 'web'),
(7, 1, 'devel', 'devel', 'devel'),
(35, 1, 'debug', 'debug', 'debug'),
(19, 2, 'xfce', 'xfce', 'xfce'),
(18, 2, 'gnome', 'gnome', 'gnome'),
(13, 2, 'admin', 'admin', 'admin'),
(14, 2, 'utils', 'utils', 'utils'),
(43, 4, 'editors', 'editors', 'editors'),
(21, 2, 'kde', 'kde', 'kde'),
(22, 2, 'fonts', 'fonts', 'fonts'),
(41, 3, 'net', 'net', 'net'),
(40, 3, 'mail', 'mail', 'mail'),
(25, 2, 'localization', 'localization', 'localization'),
(26, 2, 'gnu-r', 'gnu-r', 'gnu-r'),
(39, 1, 'shells', 'shells', 'shells'),
(29, 2, 'kernel', 'kernel', 'kernel'),
(30, 2, 'otherosfs', 'otherosfs', 'otherosfs'),
(38, 1, 'database', 'database', 'database'),
(37, 1, 'vcs', 'vcs', 'vcs'),
(33, 2, 'gnustep', 'gnustep', 'gnustep'),
(36, 1, 'interpreters', 'interpreters', 'interpreters'),
(44, 4, 'tex', 'tex', 'tex'),
(45, 4, 'news', 'news', 'news'),
(46, 5, 'science', 'science', 'science'),
(48, 5, 'electronics', 'electronics', 'electronics'),
(49, 6, 'sound', 'sound', 'sound'),
(50, 6, 'video', 'video', 'video'),
(51, 6, 'hamradio', 'hamradio', 'hamradio'),
(55, 5, 'math', 'math', 'math');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
