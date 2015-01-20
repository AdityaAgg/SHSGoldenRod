
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 68.178.143.5
-- Generation Time: Jan 09, 2014 at 11:39 AM
-- Server version: 5.5.33
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DBGoldenerCopy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` VALUES(0, 'appdever', 'falcons2013');

-- --------------------------------------------------------

--
-- Table structure for table `student_book`
--

CREATE TABLE `student_book` (
  `SubmitID` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `booktitle` varchar(255) NOT NULL,
  `bookID` int(11) NOT NULL,
  `BookDesc` text NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SubmitID`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `student_book`
--


-- --------------------------------------------------------

--
-- Table structure for table `Teacher`
--

CREATE TABLE `Teacher` (
  `teachername` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Teacher`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `pk_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(120) NOT NULL,
  `flname` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL DEFAULT 'saratogafalcons',
  `usr_is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `st_id` int(11) NOT NULL,
  `Grader` int(11) NOT NULL DEFAULT '9',
  PRIMARY KEY (`pk_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'adityaaggarwalz200@gmail.com', 'adityaaggarwalz200@gmail.com Aggarwal', 'saratogafalcons', 0, 107070, 11);
