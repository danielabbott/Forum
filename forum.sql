-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2019 at 08:02 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `CategoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) DEFAULT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpicture`
--

DROP TABLE IF EXISTS `tblpicture`;
CREATE TABLE IF NOT EXISTS `tblpicture` (
  `Id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpost`
--

DROP TABLE IF EXISTS `tblpost`;
CREATE TABLE IF NOT EXISTS `tblpost` (
  `PostID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ThreadID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `Text` text NOT NULL,
  `CreationDateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsEdited` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PostID`),
  KEY `ThreadID` (`ThreadID`),
  KEY `UserID` (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblthread`
--

DROP TABLE IF EXISTS `tblthread`;
CREATE TABLE IF NOT EXISTS `tblthread` (
  `ThreadID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CreatorUserID` int(10) UNSIGNED NOT NULL,
  `CategoryID` int(10) UNSIGNED NOT NULL,
  `PostCount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ThreadTitle` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`ThreadID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) NOT NULL,
  `Password` char(64) NOT NULL,
  `Salt` int(10) UNSIGNED NOT NULL,
  `JoinDateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLogInDateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AboutMe` text,
  `IsDeactivated` tinyint(1) NOT NULL DEFAULT '0',
  `ProfilePicture` int(4) UNSIGNED DEFAULT NULL,
  `PrivilegeLevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
