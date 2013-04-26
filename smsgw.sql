-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2013 at 01:44 AM
-- Server version: 5.5.25a-log
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `smsgw`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_book`
--

CREATE TABLE IF NOT EXISTS `address_book` (
  `id_address_book` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `number` varchar(20) NOT NULL,
  `id_smsc` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `create_date` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  PRIMARY KEY (`id_address_book`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `address_book`
--

INSERT INTO `address_book` (`id_address_book`, `id_user`, `first_name`, `last_name`, `number`, `id_smsc`, `email`, `create_date`, `last_update`) VALUES
(1, 1, 'bob ', 'marley', '+62819678420', 5, 'bob@mail.com', 1366263728, 1366263728),
(2, 1, 'jah', 'rastafara', '+62819678421', 5, 'jah@kingofking.mail', 1366263728, 1366263728),
(8, 1, 'mbah ', 'mangun', '+6281927198', 0, 'mbah.mbagen@gmail.com', 1366633298, 1366633298),
(9, 1, 'mbah ', 'joyo', '+62789789123', 0, 'mbah_joyo_imut@ymail.com', 1366677403, 1366677403),
(10, 1, 'mbah', 'spam', '+6200992873', 0, 'simbah_spamer@gmail.com', 1366692196, 1366692196);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `config` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `id_filter` int(11) NOT NULL AUTO_INCREMENT,
  `id_action` int(11) NOT NULL,
  `filter_name` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_filter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `filter_action`
--

CREATE TABLE IF NOT EXISTS `filter_action` (
  `id_action` int(11) NOT NULL,
  `type` enum('addlabel','api','markread','archive') NOT NULL,
  `id_label` int(11) NOT NULL,
  `api_post` text NOT NULL,
  `api_error_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filter_detail`
--

CREATE TABLE IF NOT EXISTS `filter_detail` (
  `id_filter_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_filter` int(11) NOT NULL,
  `rule` enum('number','messages') NOT NULL,
  `regex` enum('start_with','=') NOT NULL,
  PRIMARY KEY (`id_filter_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_address_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_groupname` int(11) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id_group`, `id_address_book`, `id_user`, `id_groupname`) VALUES
(1, 2, 1, 1),
(2, 1, 1, 3),
(3, 1, 1, 3),
(4, 5, 1, 1),
(5, 6, 1, 1),
(6, 6, 1, 2),
(7, 6, 1, 3),
(8, 7, 1, 2),
(9, 8, 1, 1),
(10, 9, 1, 1),
(11, 9, 1, 4),
(12, 10, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `groupname`
--

CREATE TABLE IF NOT EXISTS `groupname` (
  `id_groupname` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` text NOT NULL,
  `color` varchar(32) NOT NULL,
  PRIMARY KEY (`id_groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groupname`
--

INSERT INTO `groupname` (`id_groupname`, `nama_group`, `color`) VALUES
(1, 'reseller', 'ffc8af'),
(2, 'client', '16a765'),
(3, 'pegawai', 'ebdbde'),
(4, 'simbah-simbah', 'cca6ac');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `id_inbox` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_address_book` int(11) NOT NULL,
  `recive_date` int(11) NOT NULL,
  `content` text NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `last_update` int(11) NOT NULL,
  PRIMARY KEY (`id_inbox`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id_inbox`, `id_user`, `id_address_book`, `recive_date`, `content`, `read_status`, `last_update`) VALUES
(3, 1, 2, 1366363799, 'reg rasta sabtu legi 1366263728', 0, 1366263928),
(5, 1, 8, 1366691039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 0, 1366691039),
(7, 1, 1, 1366691039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 0, 1366691039),
(9, 1, 1, 1366691039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 0, 1366691039);

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `id_label` int(11) NOT NULL AUTO_INCREMENT,
  `id_inbox` int(11) NOT NULL,
  `id_labelname` int(11) NOT NULL,
  PRIMARY KEY (`id_label`),
  KEY `id_inbox` (`id_inbox`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id_label`, `id_inbox`, `id_labelname`) VALUES
(3, 3, 1),
(5, 3, 7),
(8, 5, 1),
(10, 7, 1),
(13, 9, 1),
(14, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `labelname`
--

CREATE TABLE IF NOT EXISTS `labelname` (
  `id_labelname` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `color` varchar(20) NOT NULL,
  `additional` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_labelname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `labelname`
--

INSERT INTO `labelname` (`id_labelname`, `name`, `color`, `additional`) VALUES
(1, 'inbox', 'b99aff', 0),
(2, 'sent', 'ffc8af', 0),
(3, 'outbox', 'ff7537', 0),
(4, 'trash', '16a765', 0),
(5, 'spam', '4986e7', 0),
(6, 'registrasi', 'ff7537', 1),
(7, 'konfirmasi', '16a765', 1),
(8, 'Pertanyaan', '4986e7', 1),
(9, 'informasi', '42d692', 1);

-- --------------------------------------------------------

--
-- Table structure for table `smsc`
--

CREATE TABLE IF NOT EXISTS `smsc` (
  `id_smsc` int(11) NOT NULL AUTO_INCREMENT,
  `smsc_number` varchar(20) NOT NULL,
  `smsc_name` text NOT NULL,
  PRIMARY KEY (`id_smsc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `smsc`
--

INSERT INTO `smsc` (`id_smsc`, `smsc_number`, `smsc_name`) VALUES
(1, '+62811000000', 'Telkomsel'),
(2, '+6281100000', 'Telkomsel'),
(3, '+62816124', 'Indosat'),
(4, '+6281615', 'Satelindo'),
(5, '+62818445009', 'Exelcomindo'),
(6, '+628315000031', 'Lippo Telecom'),
(7, '+62855000000', 'Indosat'),
(8, '+6289644000001', 'Three'),
(9, '+62816125', 'Mentari'),
(10, '+62816126', 'Mentari'),
(11, '+62816127', 'Mentari'),
(12, '+62816128', 'Mentari'),
(13, '+628184450095', 'Exelcomindo'),
(14, '+628315000032', 'Lippo Telecom'),
(15, '+6280980000', 'Flexi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `first_name`, `last_name`, `status`, `create_date`, `last_update`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'sms', 1, 1366262306, 1366262306);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`id_inbox`) REFERENCES `inbox` (`id_inbox`) ON DELETE CASCADE ON UPDATE CASCADE;
