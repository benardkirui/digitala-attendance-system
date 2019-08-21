-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 21, 2019 at 09:11 AM
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
('collins kipngetich', 'collins10@gmail.com', '2019-08-23', 'Technical', 'Male', 'Data Base', '0716543345', '38678765', 'Chepalungu', 'Sigor', 'jkuat', 'BBIT');

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
('kones kip', 'kones', '33452626', '0716838766', 'not admin', '2a38a4186a3ad36740480664772af763');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
