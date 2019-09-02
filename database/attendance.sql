-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 02, 2019 at 10:10 AM
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

--
-- Dumping data for table `attachees`
--

INSERT INTO `attachees` (`name`, `email`, `start`, `specialization`, `gender`, `language`, `phone`, `idnumber`, `subcounty`, `ward`, `institution`, `course`) VALUES
('kones kip', 'koneskip@gmail.com', '2019-08-02', 'OS Installation', 'Male', 'C#', '0716838766', '33452626', 'Chepalungu', 'Sigor', 'MKU', 'EGN'),
('collins kipngetich', 'kipngetich310@gmail.com', '2019-08-23', 'Programming', 'Male', 'Android', '0716543456', '33298572', 'Bomet Central', 'Ndarawetta', 'MKU', 'COMPUTER ENGINEERING'),
('collins kipngetich', 'collins10@gmail.com', '2019-08-23', 'Technical', 'Male', 'Data Base', '0716543345', '38678765', 'Chepalungu', 'Sigor', 'jkuat', 'BBIT'),
('Kiptoo Rashon', 'biikiptoo@gmail.com', '2019-08-09', 'Programming', 'Male', 'Android', '0702820251', '37568077', 'Konoin', 'Mogogosiek', 'jkuat', 'ece'),
('rono enock', 'bernadben41@gmail.com', '2019-09-06', 'Programming', 'Male', 'Data Base', '0713454546', '24536754', 'Bomet Central', 'Singorwet', 'jkuat', 'engineering'),
('Bernard Mutai', 'bernaben41@gmail.com', '2019-09-20', 'Networking', 'Male', 'Data Base', '0715675675', '33456734', 'Bomet Central', 'Silibwet', 'jkuat', 'bsc it');

-- --------------------------------------------------------

--
-- Table structure for table `done`
--

DROP TABLE IF EXISTS `done`;
CREATE TABLE IF NOT EXISTS `done` (
  `idnumber` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `jobdone` varchar(1000) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `done`
--

INSERT INTO `done` (`idnumber`, `fullname`, `jobdone`, `date`) VALUES
('37568077', 'Kiptoo Rashon', 'i was sent to the treasury', '2019-09-02 08:58:28'),
('37568077', 'Kiptoo Rashon', 'i was sent tot he treasury', '2019-09-02 09:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `reporting`
--

DROP TABLE IF EXISTS `reporting`;
CREATE TABLE IF NOT EXISTS `reporting` (
  `fullname` varchar(32) NOT NULL,
  `idnumber` varchar(10) NOT NULL,
  `reportin` varchar(32) NOT NULL,
  `reportout` varchar(32) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reporting`
--

INSERT INTO `reporting` (`fullname`, `idnumber`, `reportin`, `reportout`, `department`) VALUES
('Kiptoo Rashon', '37568077', '2-9-2019 11:59:53', '2-9-2019 12:0:4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

DROP TABLE IF EXISTS `supervisors`;
CREATE TABLE IF NOT EXISTS `supervisors` (
  `idnumber` int(11) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `department` varchar(32) NOT NULL,
  `phonenumber` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`idnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`idnumber`, `fullname`, `department`, `phonenumber`, `email`, `username`, `password`) VALUES
(33783245, 'kipkirui ken', 'ICT', '0723543765', 'kipkiruikip32@gmail.com', 'ken', 'adeeba08e6e63fca2ba7c530a28f29a6'),
(66455727, 'enock bett', 'ENG', '0715645756', 'bernad41@gmail.com', 'enock', '13126195d5ef15b7d922a2b392e17a0a');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fullname`, `username`, `idnumber`, `phonenumber`, `level`, `password`) VALUES
('Koech', 'koechc', '22463631', '0722336377', 'admin', '10959a2ad8d4116054b7f62a8989a9c1'),
('one direction', 'direction', '33297285', '0716837766', 'admin', '4051bc853473fa22ae96de7aa5f4939a'),
('collins kipngetich', 'collo', '33298572', '0716543456', 'not admin', '7ce38bf6811a96afd3411188577b08ee'),
('collins kipngetich', 'collo', '38678765', '0716543345', 'not admin', '2ea32bc284eef17c399199171f346caa'),
('kones kip', 'kones', '33452626', '0716838766', 'not admin', '2a38a4186a3ad36740480664772af763'),
('Kiptoo Rashon', 'kiptoo-attachee', '37568077', '0702820251', 'not admin', 'e10adc3949ba59abbe56e057f20f883e'),
('Kiptoo Rashon', 'kiptoo-admin', '34266245', '0702820251', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
('kirui Bob', 'kirui', '30406565', '0715675654', 'admin', 'e77b22ec4319553ca52d9a9398f89384'),
('rono enock', 'rono', '24536754', '0713454546', 'not admin', 'c6dee5c22a7a2d9e0be6da62b30ea5ad'),
('Bernard Mutai', 'Mutai', '33456734', '0715675675', 'not admin', '4a874a33c0220b962daa4e0cda1f0d1d');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
