-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2017 at 03:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `check24`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_comment`
--

CREATE TABLE IF NOT EXISTS `t_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `remark` text,
  `idEntry` int(12) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `t_comment`
--

INSERT INTO `t_comment` (`id`, `name`, `email`, `url`, `remark`, `idEntry`, `created`) VALUES
(1, 'moad', 'moad@gmail.com', 'https://github.com', 'I have nothing to say yet !', 2, '2017-07-10 03:16:05'),
(2, 'amin', 'amin123@gmail.com', '', 'test', 1, '2017-07-10 03:29:49'),
(3, 'ayman', 'ayman.ja@gmail.com', 'https://medium.com', 'It should be better than this dude ;)', 2, '2017-07-10 03:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `t_entry`
--

CREATE TABLE IF NOT EXISTS `t_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `authore` varchar(50) DEFAULT NULL,
  `comments` int(12) DEFAULT NULL,
  `idUser` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_entry`
--

INSERT INTO `t_entry` (`id`, `created`, `title`, `content`, `authore`, `comments`, `idUser`) VALUES
(1, '2017-07-10 01:30:47', 'test entry', ' test entry 1', 'abdel', 0, 1),
(2, '2017-07-10 02:13:06', 'Entry 2', '&lt;p&gt;This is a test for &lt;strong&gt;blog &lt;/strong&gt;&lt;em&gt;entries&lt;/em&gt;&lt;/p&gt;\r\n', 'abdel', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `postcode` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdBy` varchar(50) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updatedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `login`, `password`, `email`, `fullname`, `street`, `postcode`, `place`, `created`, `createdBy`, `updated`, `updatedBy`) VALUES
(1, 'abdel', 'abdel?12', 'aassou.abdelilah@gmail.com', 'aassou abdelilah', 'Laarassi St, S/N 62000 Nador, Morocco', '62010', 'Nador', NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
