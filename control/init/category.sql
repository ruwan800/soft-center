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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_type`, `cat_name`, `cat_img`, `cat_link`) VALUES
( 1, 'Java', 'java', 'java'),
( 1, 'Perl', 'perl', 'perl'),
( 1, 'Python', 'python', 'python'),
( 1, 'Php', 'php', 'php'),
( 1, 'Ruby', 'ruby', 'ruby'),
( 1, 'Develper Tools', 'devel', 'devel'),
( 1, 'Documentation', 'doc', 'doc'),
( 1, 'Debug Tools', 'debug', 'debug'),
( 1, 'Database', 'database', 'database'),
( 1, 'Version Control Systems', 'vcs', 'vcs'),
( 1, 'Interpreters', 'interpreters', 'interpreters'),
( 1, 'Shells', 'shells', 'shells'),
( 2, 'Gnustep', 'gnustep', 'gnustep'),
( 2, 'Xfce', 'xfce', 'xfce'),
( 2, 'Gnome', 'gnome', 'gnome'),
( 2, 'Administrative Tools', 'admin', 'admin'),
( 2, 'Utilities', 'utils', 'utils'),
( 2, 'Kde', 'kde', 'kde'),
( 2, 'Fonts', 'fonts', 'fonts'),
( 2, 'Network', 'net', 'net'),
( 2, 'Localization', 'localization', 'localization'),
( 2, 'Gnu-r', 'gnu-r', 'gnu-r'),
( 2, 'Kernel', 'kernel', 'kernel'),
( 2, 'Other OSes and File Systems', 'otherosfs', 'otherosfs'),
( 3, 'Web Software', 'web', 'web'),
( 3, 'Mail', 'mail', 'mail'),
( 4, 'Editors', 'editors', 'editors'),
( 4, 'Text', 'text', 'text'),
( 4, 'Tex', 'tex', 'tex'),
( 4, 'News', 'news', 'news'),
( 5, 'Science', 'science', 'science'),
( 5, 'Electronics', 'electronics', 'electronics'),
( 5, 'Mathematics', 'math', 'math'),
( 6, 'Sound', 'sound', 'sound'),
( 6, 'Video', 'video', 'video'),
( 6, 'Hamradio', 'hamradio', 'hamradio');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
