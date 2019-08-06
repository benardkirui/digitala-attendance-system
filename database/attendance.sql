DROP  DATABASE IF  EXISTS attendance;

CREATE DATABASE attendance;
use attendance;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 06, 2019 at 10:21 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachees`
--

DROP TABLE IF EXISTS `attachees`;
CREATE TABLE IF NOT EXISTS `attachees` (
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `start` varchar(32) NOT NULL,
  `specialization` varchar(32) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `language` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `idnumber` varchar(32) NOT NULL,
  `subcounty` varchar(32) NOT NULL,
  `ward` varchar(32) NOT NULL,
  `institution` varchar(32) NOT NULL,
  `course` varchar(32) NOT NULL,
  PRIMARY KEY (`idnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `fullname` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `idnumber` varchar(64) DEFAULT NULL,
  `phonenumber` varchar(10) DEFAULT NULL,
  `level` varchar(10) NOT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
