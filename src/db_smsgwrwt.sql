-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2013 at 09:54 AM
-- Server version: 5.5.25a-log
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_smsgwrwt`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `id_blacklist` int(11) NOT NULL AUTO_INCREMENT,
  `blacklist_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id_blacklist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
  `sending_limit` int(11) NOT NULL DEFAULT '0',
  `total_send` int(11) NOT NULL DEFAULT '0',
  `total_unsend` int(11) NOT NULL DEFAULT '0',
  `status_sending` enum('ready','pending','error') NOT NULL DEFAULT 'ready',
  `time_sending_limit` int(11) NOT NULL DEFAULT '3600',
  PRIMARY KEY (`id_config_modem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `config_rule`
--

CREATE TABLE IF NOT EXISTS `config_rule` (
  `id_config_rule` int(11) NOT NULL AUTO_INCREMENT,
  `id_config_modem` int(11) NOT NULL,
  `id_smsc_name` int(11) NOT NULL,
  PRIMARY KEY (`id_config_rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `config_smtp`
--

CREATE TABLE IF NOT EXISTS `config_smtp` (
  `id_config_smtp` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `port` int(11) NOT NULL DEFAULT '25',
  `ssl` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_config_smtp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `id_filter` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_delimiter` int(11) NOT NULL,
  `filter_name` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_filter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `filter_detail`
--

CREATE TABLE IF NOT EXISTS `filter_detail` (
  `id_filter_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_filter` int(11) NOT NULL,
  `type_filter` enum('number','messages') NOT NULL,
  `word` enum('1','2','3','4','5','6','7','8','9','10') DEFAULT NULL,
  `type_regex` enum('start_with','=','type','regex') NOT NULL,
  `id_filter_regex` int(11) DEFAULT NULL,
  `regex_data` varchar(50) DEFAULT NULL,
  `add_rule` enum('and','or','none') NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id_filter_detail`),
  KEY `id_filter` (`id_filter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

-- --------------------------------------------------------

--
-- Table structure for table `filter_regex`
--

CREATE TABLE IF NOT EXISTS `filter_regex` (
  `id_filter_regex` int(11) NOT NULL AUTO_INCREMENT,
  `regex` text NOT NULL,
  `regex_value` varchar(50) NOT NULL,
  PRIMARY KEY (`id_filter_regex`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_address_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_groupname` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_group`),
  KEY `id_address_book` (`id_address_book`),
  KEY `id_groupname` (`id_groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

-- --------------------------------------------------------

--
-- Table structure for table `groupname`
--

CREATE TABLE IF NOT EXISTS `groupname` (
  `id_groupname` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` text NOT NULL,
  `color` varchar(32) NOT NULL,
  PRIMARY KEY (`id_groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `id_inbox` int(11) NOT NULL AUTO_INCREMENT,
  `thread` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_address_book` int(11) NOT NULL DEFAULT '0',
  `number` varchar(20) NOT NULL DEFAULT 'Unset Number',
  `recive_date` int(11) NOT NULL,
  `content` text NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `last_update` int(11) NOT NULL,
  `status_archive` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `send_status` varchar(255) DEFAULT NULL,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_inbox`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_restriction`
--

CREATE TABLE IF NOT EXISTS `ip_restriction` (
  `id_ip_restriction` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `ip_restriction` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ip_restriction`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `operator_number`
--

CREATE TABLE IF NOT EXISTS `operator_number` (
  `id_operator_number` int(11) NOT NULL AUTO_INCREMENT,
  `operator_number` varchar(10) NOT NULL,
  `id_smsc_name` int(11) NOT NULL,
  PRIMARY KEY (`id_operator_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `role_detail`
--

CREATE TABLE IF NOT EXISTS `role_detail` (
  `id_role_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  `access` enum('read','write','none') NOT NULL,
  PRIMARY KEY (`id_role_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `smsc_name`
--

CREATE TABLE IF NOT EXISTS `smsc_name` (
  `id_smsc_name` int(11) NOT NULL AUTO_INCREMENT,
  `operator_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_smsc_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `api` tinyint(1) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
  ADD CONSTRAINT `group_ibfk_4` FOREIGN KEY (`id_groupname`) REFERENCES `groupname` (`id_groupname`) ON DELETE CASCADE ON UPDATE CASCADE;

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
