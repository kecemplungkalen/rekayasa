-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2013 at 04:39 AM
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
  `last_name` text,
  `number` varchar(20) NOT NULL,
  `id_smsc` int(11) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  PRIMARY KEY (`id_address_book`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `address_book`
--

INSERT INTO `address_book` (`id_address_book`, `id_user`, `first_name`, `last_name`, `number`, `id_smsc`, `email`, `create_date`, `last_update`) VALUES
(2, 1, 'jah', 'rastafara', '+62819678421', 5, 'jah@kingofking.mail', 1366263728, 1366263728),
(8, 1, 'mbah ', 'mangun', '+6281927198', 0, 'mbah.mbagen@gmail.com', 1366633298, 1366633298),
(9, 1, 'mbah ', 'joyo', '+62789789123', 0, 'mbah_joyo_imut@ymail.com', 1366677403, 1366677403),
(10, 1, '+6287869122852', '', '+6287869122852', 5, '', 1367287159, 1367287159),
(11, 1, 'bob', 'maleh', '+62819678420', 5, 'bob_maleh@ymail.com', 1367459799, 1367459799);

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
-- Table structure for table `config_modem`
--

CREATE TABLE IF NOT EXISTS `config_modem` (
  `id_config_modem` int(10) NOT NULL AUTO_INCREMENT,
  `nama_modem` varchar(50) NOT NULL,
  `phoneID` varchar(50) NOT NULL,
  `number` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `default` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_config_modem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `config_modem`
--

INSERT INTO `config_modem` (`id_config_modem`, `nama_modem`, `phoneID`, `number`, `status`, `default`) VALUES
(1, 'Pro XL', 'RumahwebXL', '+62819678420', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `config_rule`
--

CREATE TABLE IF NOT EXISTS `config_rule` (
  `id_config_rule` int(11) NOT NULL AUTO_INCREMENT,
  `id_config_modem` int(11) NOT NULL,
  `id_smsc_name` int(11) NOT NULL,
  PRIMARY KEY (`id_config_rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `config_rule`
--

INSERT INTO `config_rule` (`id_config_rule`, `id_config_modem`, `id_smsc_name`) VALUES
(4, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `id_filter` int(11) NOT NULL AUTO_INCREMENT,
  `id_delimiter` int(11) NOT NULL,
  `filter_name` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_filter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `filter`
--

INSERT INTO `filter` (`id_filter`, `id_delimiter`, `filter_name`, `status`) VALUES
(6, 1, 'registrasi', 1),
(7, 1, 'Filter spam', 0),
(8, 4, 'Konfirmasi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `filter_action`
--

CREATE TABLE IF NOT EXISTS `filter_action` (
  `id_action` int(11) NOT NULL AUTO_INCREMENT,
  `id_filter` int(11) NOT NULL,
  `id_filter_action_type` int(11) NOT NULL,
  `id_label` int(11) DEFAULT NULL,
  `api_post` text,
  `api_error_email` varchar(50) DEFAULT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id_action`),
  KEY `id_filter` (`id_filter`),
  KEY `id_label` (`id_label`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `filter_action`
--

INSERT INTO `filter_action` (`id_action`, `id_filter`, `id_filter_action_type`, `id_label`, `api_post`, `api_error_email`, `order`) VALUES
(1, 6, 1, NULL, '', '', 1),
(2, 6, 2, 5, 'http://www.google.com/', 'coba@gmail.com', 2),
(3, 6, 3, 5, '', '', 3),
(4, 7, 1, 5, '', '', 1),
(5, 8, 1, 7, '', '', 1),
(6, 8, 2, 5, 'http://www.websiteapi.com/stor_data/', 'xpl@gmail.com', 2),
(7, 8, 3, 5, '', '', 3),
(8, 8, 4, 5, '', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `filter_action_type`
--

CREATE TABLE IF NOT EXISTS `filter_action_type` (
  `id_filter_action_type` int(11) NOT NULL AUTO_INCREMENT,
  `action_type` varchar(50) NOT NULL,
  `action_type_text` varchar(50) NOT NULL,
  PRIMARY KEY (`id_filter_action_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `filter_action_type`
--

INSERT INTO `filter_action_type` (`id_filter_action_type`, `action_type`, `action_type_text`) VALUES
(1, 'add_label', 'Add Label'),
(2, 'api', 'API Post'),
(3, 'mark_read', 'Mark As Read'),
(4, 'archive', 'Set Archive');

-- --------------------------------------------------------

--
-- Table structure for table `filter_delimiter`
--

CREATE TABLE IF NOT EXISTS `filter_delimiter` (
  `id_delimiter` int(11) NOT NULL AUTO_INCREMENT,
  `name_delimiter` varchar(20) NOT NULL,
  `value_delimiter` varchar(10) NOT NULL,
  PRIMARY KEY (`id_delimiter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `filter_delimiter`
--

INSERT INTO `filter_delimiter` (`id_delimiter`, `name_delimiter`, `value_delimiter`) VALUES
(1, 'Space ''  ''', ' '),
(2, 'tilde (~)', '~'),
(3, 'At ( @ )', '@'),
(4, 'Hash ( # )', '#'),
(5, 'Dollar ( $ ) ', '$'),
(6, 'Percent ( % )', '%'),
(7, 'Underscore ( _ )', '_'),
(8, 'Asterisk ( * )', '*'),
(9, 'equals ( = )', '='),
(10, 'pipe ( | )', '|'),
(11, 'Ampersand ( & )', '&'),
(12, 'slash ( / )', '/'),
(13, 'Quetion ( ? )', '?'),
(14, 'Colon ( : )', ':'),
(15, 'Semicolon ( ; )', ';');

-- --------------------------------------------------------

--
-- Table structure for table `filter_detail`
--

CREATE TABLE IF NOT EXISTS `filter_detail` (
  `id_filter_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_filter` int(11) NOT NULL,
  `type_filter` enum('number','messages') NOT NULL,
  `word` enum('1','2','3','4','5') DEFAULT NULL,
  `type_regex` enum('start_with','=','type','regex') NOT NULL,
  `id_filter_regex` int(11) DEFAULT NULL,
  `regex_data` varchar(50) DEFAULT NULL,
  `add_rule` enum('and','or','none') NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id_filter_detail`),
  KEY `id_filter` (`id_filter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `filter_detail`
--

INSERT INTO `filter_detail` (`id_filter_detail`, `id_filter`, `type_filter`, `word`, `type_regex`, `id_filter_regex`, `regex_data`, `add_rule`, `order`) VALUES
(16, 6, 'messages', '1', '=', 0, 'REG', 'and', 1),
(17, 6, 'messages', '3', 'type', 1, '', 'or', 2),
(18, 6, 'messages', '3', '=', 0, 'RASTA', 'none', 3),
(19, 7, 'number', '', '=', 0, '+62819678420', 'and', 1),
(20, 7, 'messages', '1', '=', 0, 'SPAM', 'none', 2),
(21, 8, 'messages', '1', '=', 1, 'REG', 'and', 1),
(22, 8, 'messages', '2', 'start_with', 0, 'KONF', 'and', 2),
(23, 8, 'messages', '3', 'type', 1, '', 'none', 3);

-- --------------------------------------------------------

--
-- Table structure for table `filter_regex`
--

CREATE TABLE IF NOT EXISTS `filter_regex` (
  `id_filter_regex` int(11) NOT NULL AUTO_INCREMENT,
  `regex` text NOT NULL,
  `regex_value` varchar(50) NOT NULL,
  PRIMARY KEY (`id_filter_regex`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `filter_regex`
--

INSERT INTO `filter_regex` (`id_filter_regex`, `regex`, `regex_value`) VALUES
(1, 'numeric', '/^[0-9]/'),
(2, 'alphabet', '/^[a-zA-Z]*$/'),
(3, 'alphanumeric', '/^[A-Za-z][A-Za-z0-9]*$/'),
(4, 'character', '/[$-/:-?{-~!"^_`\\[\\]]/');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_address_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_groupname` int(11) NOT NULL,
  PRIMARY KEY (`id_group`),
  KEY `id_address_book` (`id_address_book`),
  KEY `id_groupname` (`id_groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id_group`, `id_address_book`, `id_user`, `id_groupname`) VALUES
(1, 2, 1, 1),
(10, 9, 1, 1),
(11, 9, 1, 4),
(25, 8, 1, 4),
(26, 11, 1, 4);

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
  `number` varchar(20) NOT NULL,
  `recive_date` int(11) NOT NULL,
  `content` text NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `last_update` int(11) NOT NULL,
  PRIMARY KEY (`id_inbox`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id_inbox`, `id_user`, `id_address_book`, `number`, `recive_date`, `content`, `read_status`, `last_update`) VALUES
(3, 1, 2, '+62819678421', 1366363799, 'reg rasta sabtu legi 1366263728', 1, 1366263928),
(8, 1, 2, '+62819678421', 1366791039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 1366691039),
(9, 1, 2, '+62819678421', 1366891039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 1366691039),
(10, 1, 8, '+6281927198', 1366991039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 1366691039),
(11, 1, 9, '+62789789123', 1366699039, 'keyword cari', 1, 1366691039),
(67, 1, 10, '+6287869122852', 1364200074, 'REG KONF 123', 1, 1367296284),
(68, 1, 11, '+62819678420', 1367465994, 'Uye Maaaaaaaaaan.. Piye', 1, 1367465994),
(69, 1, 9, '+62789789123', 1367470864, 'aaaaaaaaaaaaaaaaaa', 1, 1367470864),
(70, 1, 2, '+62819678421', 1367471080, 'Bob MArlwywwwwwwwwwww', 1, 1367471080),
(71, 1, 10, '+6287869122852', 1367471127, 'test Number without name', 1, 1367471127),
(72, 1, 9, '+62789789123', 1367471179, 'test lagi brow..', 1, 1367471179),
(73, 1, 12, '+62819678423', 1367471179, 'TEST DELETE ADDRSS', 1, 1367471179),
(74, 1, 9, '+62789789123', 1367471179, 'test nomer 2 lagi brow..', 1, 1367471179),
(75, 1, 9, '+62789789123', 1367471179, 'test nomer 22 lagi brow..', 1, 1367471179);

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `id_label` int(11) NOT NULL AUTO_INCREMENT,
  `id_inbox` int(11) NOT NULL,
  `id_labelname` int(11) NOT NULL,
  PRIMARY KEY (`id_label`),
  KEY `id_inbox` (`id_inbox`),
  KEY `id_labelname` (`id_labelname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id_label`, `id_inbox`, `id_labelname`) VALUES
(20, 9, 1),
(22, 11, 1),
(23, 10, 8),
(26, 3, 4),
(29, 8, 10),
(93, 67, 1),
(94, 67, 10),
(95, 9, 9),
(96, 68, 3),
(97, 69, 3),
(98, 70, 3),
(99, 71, 3),
(100, 72, 3),
(101, 73, 1),
(102, 74, 1),
(103, 75, 1),
(104, 11, 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `labelname`
--

INSERT INTO `labelname` (`id_labelname`, `name`, `color`, `additional`) VALUES
(1, 'inbox', 'b99aff', 0),
(2, 'sent', 'ffc8af', 0),
(3, 'outbox', 'ff7537', 0),
(4, 'trash', '16a765', 0),
(5, 'spam', '4986e7', 0),
(7, 'konfirmasi', '16a765', 1),
(8, 'Pertanyaan', '4986e7', 1),
(9, 'informasi', '42d692', 1),
(10, 'Registrasi', 'ff7537', 1);

-- --------------------------------------------------------

--
-- Table structure for table `smsc`
--

CREATE TABLE IF NOT EXISTS `smsc` (
  `id_smsc` int(11) NOT NULL AUTO_INCREMENT,
  `smsc_number` varchar(20) NOT NULL,
  `smsc_name` int(11) NOT NULL,
  PRIMARY KEY (`id_smsc`),
  KEY `smsc_name` (`smsc_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `smsc`
--

INSERT INTO `smsc` (`id_smsc`, `smsc_number`, `smsc_name`) VALUES
(1, '+62811000000', 1),
(2, '+6281100000', 1),
(3, '+62816124', 2),
(4, '+6281615', 4),
(5, '+62818445009', 3),
(6, '+628315000031', 8),
(7, '+62855000000', 2),
(8, '+6289644000001', 5),
(9, '+62816125', 6),
(10, '+62816126', 6),
(11, '+62816127', 6),
(12, '+62816128', 6),
(13, '+628184450095', 3),
(14, '+628315000032', 8),
(15, '+6280980000', 7);

-- --------------------------------------------------------

--
-- Table structure for table `smsc_name`
--

CREATE TABLE IF NOT EXISTS `smsc_name` (
  `id_smsc_name` int(11) NOT NULL AUTO_INCREMENT,
  `operator_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_smsc_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `smsc_name`
--

INSERT INTO `smsc_name` (`id_smsc_name`, `operator_name`) VALUES
(1, 'Telkomsel'),
(2, 'Indosat'),
(3, 'Exelcomindo'),
(4, 'Satelindo'),
(5, 'Three'),
(6, 'Mentari'),
(7, 'Flexi'),
(8, 'Lippo Telecom');

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
-- Constraints for table `filter_action`
--
ALTER TABLE `filter_action`
  ADD CONSTRAINT `filter_action_ibfk_1` FOREIGN KEY (`id_filter`) REFERENCES `filter` (`id_filter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `filter_action_ibfk_3` FOREIGN KEY (`id_label`) REFERENCES `labelname` (`id_labelname`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `filter_detail`
--
ALTER TABLE `filter_detail`
  ADD CONSTRAINT `filter_detail_ibfk_1` FOREIGN KEY (`id_filter`) REFERENCES `filter` (`id_filter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`id_address_book`) REFERENCES `address_book` (`id_address_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_ibfk_2` FOREIGN KEY (`id_groupname`) REFERENCES `groupname` (`id_groupname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`id_inbox`) REFERENCES `inbox` (`id_inbox`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `label_ibfk_2` FOREIGN KEY (`id_labelname`) REFERENCES `labelname` (`id_labelname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `smsc`
--
ALTER TABLE `smsc`
  ADD CONSTRAINT `smsc_ibfk_1` FOREIGN KEY (`smsc_name`) REFERENCES `smsc_name` (`id_smsc_name`) ON DELETE CASCADE ON UPDATE CASCADE;
