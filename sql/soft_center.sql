-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2016 at 11:01 PM
-- Server version: 5.5.24-0ubuntu0.12.04.1-log
-- PHP Version: 5.3.10-1ubuntu3

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

--
-- Table structure for table `software`
--

CREATE TABLE IF NOT EXISTS `software` (
  `package` varchar(70) NOT NULL,
  `soft_id` int(11) NOT NULL AUTO_INCREMENT,
  `installed_size` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `date` int(8) DEFAULT NULL,
  `version` text,
  `priority` text,
  `section` text,
  `maintainer` text,
  `homepage` text,
  `source` text,
  `description` text,
  `architecture` text,
  `filename` text,
  `tag` text,
  `depends` text,
  `suggests` text,
  `recommends` text,
  `desc_more` text,
  `provides` text,
  `replaces` text,
  `conflicts` text,
  `more_info` text,
  PRIMARY KEY (`soft_id`),
  KEY `package` (`package`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`package`, `soft_id`, `installed_size`, `size`, `date`, `version`, `priority`, `section`, `maintainer`, `homepage`, `source`, `description`, `architecture`, `filename`, `tag`, `depends`, `suggests`, `recommends`, `desc_more`, `provides`, `replaces`, `conflicts`, `more_info`) VALUES
('2vcard', 1, 108, 14300, 20160812, '0.5-3', 'optional', 'utils', 'Martin Albisetti <argentina@gmail.com>', '', '', 'perl script to convert an addressbook to VCARD file format', 'all', 'pool/main/2/2vcard/2vcard_0.5-3_all.deb', ' implemented-in::perl, role::program, use::converting', '', '', '', ' 2vcard is a little perl script that you can use to convert the\n popular vcard file format. Currently 2vcard can only convert addressbooks\n and alias files from the following formats: abook,eudora,juno,ldif,mutt,\n mh and pine.\n</br> The VCARD format is used by gnomecard, for example, which is used by the\n balsa email client.\n', '', '', '', ''),
('3dchess', 2, 144, 34932, 20160812, '0.8.1-16', 'optional', 'games', 'Debian Games Team <pkg-games-devel@lists.alioth.debian.org>', '', '', '3D chess for X11', 'i386', 'pool/main/3/3dchess/3dchess_0.8.1-16_i386.deb', ' game::board, game::board:chess, implemented-in::c, interface::x11, role::program, uitoolkit::xlib, use::gameplaying, x11::application', 'libc6 (>= 2.7-1), libx11-6, libxext6, libxmu6, libxpm4, libxt6, xaw3dg (>= 1.5+E-1)', '', '', ' 3 dimensional Chess game for X11R6.  There are three boards, stacked\n vertically; 96 pieces of which most are the traditional chess pieces with\n just a couple of additions; 26 possible directions in which to move.  The\n AI isn''t wonderful, but provides a challenging enough game to all but the\n most highly skilled players.\n', '', '', '', ''),
('4g8', 3, 72, 12164, 20160812, '1.0-3', 'optional', 'net', 'LaMont Jones <lamont@debian.org>', '', '', 'Packet Capture and Interception for Switched Networks', 'i386', 'pool/main/4/4g8/4g8_1.0-3_i386.deb', ' admin::monitoring, protocol::{ip,tcp,udp}, role::program, works-with::network-traffic', 'libc6 (>= 2.6.1-1), libnet1 (>= 1.1.2-1), libpcap0.8 (>= 0.9.3-1)', '', '', ' 4G8 allows you to capture traffic from a third party in a switched\n environment at the expense of a slight increase in latency to that\n third party host. Utilizing ARP cache poisoning, packet capture and\n packet reconstruction techniques, 4G8 works with nearly all TCP, ICMP\n and UDP IPv4 traffic flows.\n', '', '', '', ''),
('6tunnel', 4, 68, 13544, 20160812, '0.11rc2-3.1', 'optional', 'net', 'Jari Aalto <jari.aalto@cante.net>', 'http://toxygen.net/6tunnel', '', 'TCP proxy for non-IPv6 applications', 'i386', 'pool/main/6/6tunnel/6tunnel_0.11rc2-3.1_i386.deb', ' interface::daemon, network::server, network::vpn, protocol::ipv6, role::program, use::proxying', 'libc6 (>= 2.3)', '', '', ' 6tunnel allows you to use services provided by IPv6 hosts with\n IPv4-only applications and vice versa. It can bind to any of your IPv4\n or IPv6 addresses and forward all data to IPv4 or IPv6 host.\n</br> It can be used for example as an IPv6-capable IRC proxy.\n', '', '', '', ''),
('9base', 5, 4392, 1551926, 20160812, '1:6-1', 'optional', 'utils', 'Debian Suckless Maintainers <suckless@lists.debian-maintainers.org>', 'http://tools.suckless.org/9base/', '', 'Plan 9 userland tools', 'i386', 'pool/main/9/9base/9base_6-1_i386.deb', ' admin::configuring, devel::code-generator, devel::interpreter, implemented-in::c, interface::commandline, role::program, scope::utility, works-with::file', 'libc6 (>= 2.7)', '9mount, wmii2', '', ' 9base is a port of following original Plan 9 userland tools to Unix:\n awk, basename, bc, cat, cleanname, date, dc, echo, grep, mk, rc, sed, seq,\n sleep, sort, tee, test, touch, tr, uniq, and yacc.\n</br> 9base is currently only used by wmii2 (window manager improved, version 2).\n', '', '', '', ''),
('9menu', 6, 76, 14514, 20160812, '1.8-2', 'optional', 'x11', 'Debian QA Group <packages@qa.debian.org>', 'http://tools.suckless.org/9base/', '', 'Creates X menus from the shell', 'i386', 'pool/main/9/9menu/9menu_1.8-2_i386.deb', ' implemented-in::c, interface::x11, qa::orphaned, role::program, scope::utility, x11::application', 'libc6 (>= 2.1), libx11-6, libxext6', '9mount, wmii2', '', ' This is a simple program that allows you to create X menus from\n the shell, where each menu item will run a command. 9menu is intended\n for use with 9wm, but can be used with any other window manager.\n', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
