-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 22, 2012 at 07:17 PM
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
CREATE DATABASE IF NOT EXISTS soft_center;
USE soft_center;
-- --------------------------------------------------------


--
-- Table structure for table `software`
--
DROP TABLE IF EXISTS `software`;
CREATE TABLE `software` (
  `package` varchar(60) NOT NULL,
  `soft_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  PRIMARY KEY (`soft_id`),
  KEY `package` (`package`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
--  `software` int(11) NOT NULL,
--  `name` varchar(30) COLLATE latin1_bin NOT NULL,
--  `descr` text COLLATE latin1_bin NOT NULL,
--  `position` int(4) NOT NULL,
--  `avail` tinyint(4) NOT NULL,
--  `visible` tinyint(4) NOT NULL,
/*
  `priority`
  `section`
  `installed_size`
  `maintainer`
  `architecture`
  `version`
  `size`
  `MD5sum`
  `SHA1`
  `SHA256`
  `tag`
  `depends`
  `homepage`
  `suggests`
  `recommends`
  `source`
  `description`
  `more_info`
*/
--
-- Dumping data for table `software`
--
--
-- Table structure for table `software_tag`
--
DROP TABLE IF EXISTS `software_tag`;
CREATE TABLE `software_tag` (
  `tag` varchar(60) NOT NULL,
  `soft_id_list` int(11) NOT NULL,
  KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_tag`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
