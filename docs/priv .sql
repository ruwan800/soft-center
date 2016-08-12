-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2011 at 07:05 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `priv`
--

-- --------------------------------------------------------

--
-- Table structure for table `priv`
--

CREATE TABLE IF NOT EXISTS `priv` (
  `software` int(9) unsigned NOT NULL,
  `user` int(9) unsigned NOT NULL,
  KEY `software` (`software`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priv`
--

INSERT INTO `priv` (`software`, `user`) VALUES
(1, 3),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `softwares`
--

CREATE TABLE IF NOT EXISTS `softwares` (
  `software_name` varchar(30) NOT NULL,
  `software_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`software_id`),
  KEY `software_name` (`software_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1003 ;

--
-- Dumping data for table `softwares`
--

INSERT INTO `softwares` (`software_name`, `software_id`) VALUES
('gdebi', 1000),
('vlc', 1001),
('gimp', 1002);

-- --------------------------------------------------------

--
-- Table structure for table `software_groups`
--

CREATE TABLE IF NOT EXISTS `software_groups` (
  `software_group_name` varchar(30) NOT NULL,
  `software_group_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`software_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `software_groups`
--

INSERT INTO `software_groups` (`software_group_name`, `software_group_id`) VALUES
('all', 1),
('media', 2),
('system', 3);

-- --------------------------------------------------------

--
-- Table structure for table `software_priv`
--

CREATE TABLE IF NOT EXISTS `software_priv` (
  `software_id` int(9) unsigned NOT NULL,
  `software_group_id` int(9) unsigned NOT NULL,
  KEY `software_id` (`software_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_priv`
--

INSERT INTO `software_priv` (`software_id`, `software_group_id`) VALUES
(1001, 2),
(1002, 2),
(1000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_name` varchar(30) NOT NULL,
  `user_id` int(9) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_name` (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `user_id`) VALUES
('kamal', 1000),
('amal', 1001),
('nimal', 1002);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `user_group_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`user_group_id`, `user_group_name`) VALUES
(1, 'ALL'),
(2, 'media_unit'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_priv`
--

CREATE TABLE IF NOT EXISTS `user_priv` (
  `user_id` int(9) unsigned NOT NULL,
  `user_group_id` int(9) unsigned NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_priv`
--

INSERT INTO `user_priv` (`user_id`, `user_group_id`) VALUES
(1000, 2),
(1001, 2),
(1002, 3),
(1002, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
