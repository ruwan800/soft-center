-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2012 at 03:49 AM
-- Server version: 5.0.87
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `software_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `vos_sections`
--

CREATE TABLE IF NOT EXISTS `vos_sections` (
  `section` varchar(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `desc` varchar(200) default NULL,
  PRIMARY KEY  (`section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vos_sections`
--

INSERT INTO `vos_sections` (`section`, `name`, `desc`) VALUES
('admin', 'Administration Utilities', 'Utilities to administer system resources, manage user accounts, etc.'),
('cli-mono', 'Mono/CLI', 'Everything about Mono and the Common Language Infrastructure.'),
('comm', 'Communication Programs', 'Software to use your modem in the old fashioned style.'),
('database', 'Databases', 'Database Servers and Clients.'),
('debug', 'Debug packages', 'Packages providing debugging information for executables and shared libraries.'),
('devel', 'Development', 'Development utilities, compilers, development environments, libraries, etc.'),
('doc', 'Documentation', 'FAQs, HOWTOs and other documents trying to explain everything related to Debian, and software needed to browse documentation (man, info, etc).'),
('editors', 'Editors', 'Software to edit files. Programming environments.'),
('electronics', 'Electronics', 'Electronics utilities.'),
('embedded', 'Embedded software', 'Software suitable for use in embedded applications.'),
('fonts', 'Fonts', 'Font packages.'),
('games', 'Games', 'Programs to spend a nice time with after all this setting up.'),
('gnome', 'GNOME Desktop Environment', 'The GNOME desktop environment, a powerful, easy to use set of integrated applications.'),
('gnu-r', 'GNU R Desktop Environment', 'Everything about GNU R, a statistical computation and graphics system.'),
('gnustep', 'GNUstep Desktop Environment', 'The GNUstep environment.'),
('graphics', 'Graphics', 'Editors, viewers, converters... Everything to become an artist.'),
('hamradio', 'Ham Radio', 'Software for ham radio.'),
('haskell', 'Haskell Programming Language', 'Everything about Haskell.'),
('httpd', 'Web Servers', 'Web servers and their modules.'),
('interpreters', 'Interpreters', 'All kind of interpreters for interpreted languages. Macro processors.'),
('java', 'Java Programming Language', 'Everything about Java.'),
('kde', 'KDE', 'The K Desktop Environment, a powerful, easy to use set of integrated applications.'),
('kernel', 'Kernels', 'Operating System Kernels and related modules.'),
('libdevel', 'Library development', 'Libraries necessary for developers to write programs that use them.'),
('libs', 'Libraries', 'Libraries to make other programs work. They provide special features to developers.'),
('lisp', 'Lisp Programming Language', 'Everything about Lisp.'),
('localization', 'Language packs', 'Localization support for big software packages.'),
('mail', 'Mail', 'Programs to route, read, and compose E-mail messages.'),
('math', 'Mathematics', 'Math software.'),
('misc', 'Miscellaneous', 'Miscellaneous utilities that didn''t fit well anywhere else.'),
('net', 'Network', 'Daemons and clients to connect your system to the world.'),
('news', 'Newsgroups', 'Software to access Usenet, to set up news servers, etc.'),
('ocaml', 'OCaml Programming Language', 'Everything about OCaml, an ML language implementation.'),
('oldlibs', 'Old Libraries', 'Old versions of libraries, kept for backward compatibility with old applications.'),
('otherosfs', 'Other OS''s and file systems', 'Software to run programs compiled for other operating systems, and to use their filesystems.'),
('perl', 'Perl Programming Language', 'Everything about Perl, an interpreted scripting language.'),
('php', 'PHP Programming Language', 'Everything about PHP.'),
('python', 'Python Programming Language', 'Everything about Python, an interpreted, interactive object oriented language.'),
('ruby', 'Ruby Programming Language', 'Everything about Ruby, an interpreted object oriented language.'),
('science', 'Science', 'Basic tools for scientific work'),
('shells', 'Shells', 'Command shells. Friendly user interfaces for beginners.'),
('sound', 'Sound', 'Utilities to deal with sound: mixers, players, recorders, CD players, etc.'),
('tex', 'TeX', 'The famous typesetting software and related programs.'),
('text', 'Text Processing', 'Utilities to format and print text documents.'),
('translations', 'Translations', 'Translation packages and language support meta packages.'),
('utils', 'Utilities', 'Utilities for file/disk manipulation, backup and archive tools, system monitoring, input systems, etc.'),
('vcs', 'Version Control Systems', 'Version control systems and related utilities.'),
('video', 'Video Software', 'Video viewers, editors, recording, streaming.'),
('web', 'Web Software', 'Web servers, browsers, proxies, download tools etc.'),
('x11', 'X Window System software', 'X servers, libraries, fonts, window managers, terminal emulators and many related applications.'),
('xfce', 'Xfce Desktop Environment', 'Xfce, a fast and lightweight Desktop Environment.'),
('zope', 'Zope/Plone Framework', 'Zope Application Server and Plone Content Managment System.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
