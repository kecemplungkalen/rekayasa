-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2013 at 10:22 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `address_book`
--

INSERT INTO `address_book` (`id_address_book`, `id_user`, `first_name`, `last_name`, `number`, `id_smsc`, `email`, `create_date`, `last_update`) VALUES
(2, 1, 'jah', 'rastafara', '+62819678421', 4, 'jah@kingofking.mail', 1366263728, 1366263728),
(8, 1, 'mbah ', 'mangun', '+6281927198', 0, 'mbah.mbagen@gmail.com', 1366633298, 1366633298),
(9, 1, 'mbah ', 'joyo', '+62789789123', 0, 'mbah_joyo_imut@ymail.com', 1366677403, 1366677403),
(10, 1, '+6287869122852', '', '+6287869122852', 3, '', 1367287159, 1367287159),
(11, 1, 'bob', 'maleh', '+62819678420', 3, 'bob_maleh@ymail.com', 1367459799, 1367459799),
(12, 1, '+62819678430', '', '+62819678430', 3, '', 1367659875, 1367659875),
(13, 1, '+62819678431', '', '+62819678431', 3, '', 1367660168, 1367660168),
(15, 1, 'revolusi', 'revolusi', '+6726823sdsd', 0, 'galang@mail.com', 1367815339, 1367815339),
(16, 1, 'galang', 'revolusi', '+62087328738283', 0, 'gr@gr.com', 1367815415, 1367815415),
(17, 1, 'mbah', 'buyut', '7839749387364', 0, 'mbah_buyut@mail.net', 1367907234, 1367907234),
(18, 1, 'rvolusi', 'indonesia', '67673864', 0, 'rev@maik.com', 1367907280, 1367907280),
(19, 1, '+628123456789', '', '+628123456789', 0, '', 1368156953, 1368156953),
(20, 0, '+6281931781912', '0', '+6281931781912', 3, '0', 1368171473, 1368171473),
(21, 1, '+6287878351478', '', '+6287878351478', 3, '', 1368172195, 1368172195),
(22, 1, '+6287845675824', '', '+6287845675824', 3, '', 1368172314, 1368172314),
(23, 1, '+6287835357712', '', '+6287835357712', 3, '', 1368172413, 1368172413),
(24, 1, '+6287867823851', '', '+6287867823851', 3, '', 1368172507, 1368172507);

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `id_blacklist` int(11) NOT NULL AUTO_INCREMENT,
  `blacklist_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id_blacklist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`id_blacklist`, `blacklist_number`) VALUES
(1, '+628123456789');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `config_modem`
--

INSERT INTO `config_modem` (`id_config_modem`, `nama_modem`, `phoneID`, `number`, `status`, `default`) VALUES
(1, 'Pro XL', 'RumahwebXL', '+62819678420', 1, 1),
(2, 'Axixs', 'RumahwebAxis0', '+62382793729837293', 1, 0),
(3, 'xl coba', 'RumahwebXL1', '+6274837648', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `config_rule`
--

CREATE TABLE IF NOT EXISTS `config_rule` (
  `id_config_rule` int(11) NOT NULL AUTO_INCREMENT,
  `id_config_modem` int(11) NOT NULL,
  `id_smsc_name` int(11) NOT NULL,
  PRIMARY KEY (`id_config_rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `config_rule`
--

INSERT INTO `config_rule` (`id_config_rule`, `id_config_modem`, `id_smsc_name`) VALUES
(8, 1, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `filter`
--

INSERT INTO `filter` (`id_filter`, `id_delimiter`, `filter_name`, `status`) VALUES
(6, 1, 'registrasi', 1),
(7, 1, 'Filter spam', 1),
(8, 4, 'Konfirmasi', 0),
(9, 1, 'filter saring', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `filter_action`
--

INSERT INTO `filter_action` (`id_action`, `id_filter`, `id_filter_action_type`, `id_label`, `api_post`, `api_error_email`, `order`) VALUES
(1, 6, 1, 1, '', '', 1),
(2, 6, 2, 5, 'http://www.google.com/', 'coba@gmail.com', 2),
(3, 6, 3, 5, '', '', 3),
(4, 7, 1, 5, '', '', 1),
(5, 8, 1, 7, '', '', 1),
(6, 8, 2, 5, 'http://www.websiteapi.com/stor_data/', 'xpl@gmail.com', 2),
(7, 8, 3, 5, '', '', 3),
(8, 8, 4, 5, '', '', 4),
(9, 9, 4, 5, '', '', 1),
(10, 9, 2, 5, 'http://www.google.com', '', 2),
(11, 9, 3, 5, '', '', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

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
(23, 8, 'messages', '3', 'type', 1, '', 'none', 3),
(24, 9, 'messages', '1', 'type', 2, '', 'and', 1),
(25, 9, 'messages', '2', 'regex', 0, 'REG', 'none', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id_group`, `id_address_book`, `id_user`, `id_groupname`) VALUES
(10, 9, 1, 1),
(11, 9, 1, 4),
(26, 11, 1, 4),
(72, 8, 1, 1),
(75, 2, 1, 1),
(76, 10, 1, 1),
(80, 13, 1, 1),
(83, 15, 1, 2),
(84, 16, 1, 4),
(85, 17, 1, 4),
(86, 18, 1, 2);

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
  `thread` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_address_book` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `recive_date` int(11) NOT NULL,
  `content` text NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `last_update` int(11) NOT NULL,
  `status_archive` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_inbox`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id_inbox`, `thread`, `id_user`, `id_address_book`, `number`, `recive_date`, `content`, `read_status`, `last_update`, `status_archive`, `is_delete`) VALUES
(3, '1873596087', 1, 2, '+62819678421', 1366363799, 'reg rasta sabtu legi ', 1, 1366263928, 1, 0),
(8, '1873596087', 1, 2, '+62819678421', 1366791039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 1366691039, 1, 0),
(9, '1873596087', 1, 2, '+62819678421', 1366891039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 1366691039, 1, 0),
(10, '1213962398', 1, 8, '+6281927198', 1366991039, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 1366691039, 1, 0),
(11, '1490511387', 1, 9, '+62789789123', 1366699039, 'keyword cari', 1, 1366691039, 1, 0),
(67, '1109987563', 1, 10, '+6287869122852', 1364200074, 'REG KONF 123', 1, 1367296284, 1, 0),
(68, '127905523', 1, 11, '+62819678420', 1367465994, 'Uye Maaaaaaaaaan.. Piye', 1, 1367465994, 1, 1),
(69, '1490511387', 1, 9, '+62789789123', 1367470864, 'aaaaaaaaaaaaaaaaaa', 1, 1367470864, 1, 0),
(70, '1873596087', 1, 2, '+62819678421', 1367471080, 'Bob MArlwywwwwwwwwwww', 1, 1367813958, 1, 0),
(71, '1109987563', 1, 10, '+6287869122852', 1367471127, 'test Number without name', 1, 1367471127, 1, 0),
(72, '1490511387', 1, 9, '+62789789123', 1367471179, 'test lagi brow..', 1, 1367471179, 1, 0),
(73, '97847966', 1, 12, '+62819678423', 1367471179, 'TEST DELETE ADDRSS', 1, 1367471179, 1, 0),
(74, '1490511387', 1, 9, '+62789789123', 1367471179, 'test nomer 2 lagi brow..', 1, 1367471179, 1, 0),
(75, '1490511387', 1, 9, '+62789789123', 1367471179, 'test nomer 22 lagi brow..', 1, 1367471179, 1, 0),
(76, '1109987563', 1, 10, '+6287869122852', 1364200074, 'REG TOP', 1, 1367564916, 1, 0),
(77, '1417798411', 1, 11, '+62819678420', 1364200074, 'REG TOP', 1, 1367568636, 1, 0),
(78, '1417798411', 1, 11, '+62819678420', 1364200074, 'REG TOP', 1, 1367568675, 1, 0),
(79, '1417798411', 1, 11, '+62819678420', 1364200074, 'REG TOP', 1, 1367568677, 1, 0),
(80, '1417798411', 1, 11, '+62819678420', 1364200074, 'REG TOP', 1, 1367568678, 1, 0),
(81, '728247135', 1, 11, '+62819678420', 1364200074, 'REG TOP', 1, 1367569190, 0, 0),
(82, '728247135', 1, 11, '+62819678420', 1364200074, 'REG TOP 1', 1, 1367569737, 0, 0),
(83, '728247135', 1, 11, '+62819678420', 1364200074, 'REG TOP 1111', 1, 1367569842, 0, 0),
(84, '728247135', 1, 11, '+62819678420', 1364200074, 'REG TOP 420420', 1, 1367570145, 0, 0),
(85, '728247135', 1, 11, '+62819678420', 1364200074, 'REG TOP 999999999', 1, 1367570306, 0, 0),
(87, '1505695122', 1, 12, '+62819678430', 1364200074, 'code name revolution', 1, 1367659875, 0, 0),
(88, '1165169767', 1, 13, '+62819678431', 1364200074, 'code name revolutionaries', 1, 1367660168, 0, 0),
(89, '1165169767', 1, 13, '+62819678431', 1364200074, 'Sms Ini Mau Dikirim kapan ya?', 1, 1367960168, 0, 0),
(90, '1555997036', 1, 2, '+62819678421', 1368007326, 'AAAAAAAAAAAAA  AAAAAAAAAAA', 1, 1368007326, 0, 0),
(91, '1599062565', 1, 17, '7839749387364', 1368007720, 'Piye MAAN??', 1, 1368007720, 0, 0),
(92, '1599062565', 1, 17, '7839749387364', 1368007770, 'Piye MAAN??', 1, 1368007770, 0, 0),
(93, '1599062565', 1, 17, '7839749387364', 1368007860, 'Piye Jw ?\nasbakjhs\najshka', 1, 1368007860, 0, 0),
(94, '1599062565', 1, 17, '7839749387364', 1368008035, 'AAAAAAAAAAAjhcvsj cia', 1, 1368008035, 0, 0),
(95, '728247135', 1, 11, '+62819678420', 1368008480, 'Mbaaaaaaaaaaaaaah...!', 1, 1368008480, 0, 0),
(96, '728247135', 1, 11, '+62819678420', 1368018848, 'Testing Sent Saja', 1, 1368018848, 0, 0),
(97, '1722666432', 1, 11, '+62819678420', 1368019077, 'Test New Thread..!!!!', 1, 1368019077, 0, 0),
(98, '1885174197', 1, 19, '+628123456789', 1368174474, 'Apakah Masuk Spam?', 1, 1368157145, 0, 2),
(99, '1885174197', 1, 19, '+628123456789', 1368174474, 'Spammer in Action', 1, 1368157966, 0, 2),
(100, '1885174197', 1, 19, '+628123456789', 1368185274, 'Hayoo Tak Spam..!!', 1, 1368158197, 0, 2),
(101, '685903348', 1, 20, '+6281931781912', 1368171474, 'Testing...!!', 1, 1368171474, 0, 0),
(102, '685903348', 1, 20, '+6281931781912', 1368171510, 'test brow', 1, 1368171510, 0, 0),
(103, '1783805106', 1, 21, '+6287878351478', 1368197172, 'Test SMS Gateway', 1, 1368172196, 0, 0),
(104, '98666392', 1, 22, '+6287845675824', 1368197524, 'Gammu Run One Recive Testing', 0, 1368172315, 0, 0),
(105, '2049485985', 1, 23, '+6287835357712', 1368197622, 'Gammu test SMS to 087838743088', 0, 1368172414, 0, 0),
(106, '876410452', 1, 24, '+6287867823851', 1368197716, '087838743088 Teting Saja Brotha ', 0, 1368172507, 0, 0),
(107, '1783805106', 1, 21, '+6287878351478', 1368197979, 'olehkarena itu maka penjajahan diatas dunia harus dihapuskan karena tidak sesuai dengan pri kemanusian dan pri keadilan', 1, 1368172772, 0, 0),
(108, '1783805106', 1, 21, '+6287878351478', 1368198010, 'olehkarena itu maka penjajahan diatas dunia harus dihapuskan karena tidak sesuai dengan pri kemanusian dan pri keadilan', 1, 1368172799, 0, 0),
(109, '1783805106', 1, 21, '+6287878351478', 1368173836, 'asassa', 1, 1368173836, 0, 0),
(110, '1783805106', 1, 21, '+6287878351478', 1368173863, 'System Reply Testing', 1, 1368173863, 0, 0),
(111, '1783805106', 1, 21, '+6287878351478', 1368199797, 'whooi please reply again brotha :-O', 1, 1368174595, 0, 0),
(112, '1783805106', 1, 21, '+6287878351478', 1368174926, 'AKU EMANG TAMPAN..!!!!!!!!', 1, 1368174926, 0, 0),
(113, '1783805106', 1, 21, '+6287878351478', 1368174946, 'AKU EMANG TAMPAN..!!!!!!!!', 1, 1368174946, 0, 0),
(114, '1783805106', 1, 21, '+6287878351478', 1368200460, 'hahahah Mosok?[test reply]', 1, 1368175249, 0, 0),
(115, '1783805106', 1, 21, '+6287878351478', 1368175282, 'testing reload modal', 1, 1368175282, 0, 0),
(116, '1783805106', 1, 21, '+6287878351478', 1368175293, 'testing reload modal', 1, 1368175293, 0, 0),
(117, '1783805106', 1, 21, '+6287878351478', 1368200641, 'reply lagi yak..', 1, 1368175429, 0, 0),
(118, '1783805106', 1, 21, '+6287878351478', 1368175446, 'yoo man ', 1, 1368175446, 0, 0),
(119, '1783805106', 1, 21, '+6287878351478', 1368175519, 'test rload lagi man :D', 1, 1368175519, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=449 ;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id_label`, `id_inbox`, `id_labelname`) VALUES
(96, 68, 2),
(97, 69, 2),
(98, 70, 2),
(99, 71, 2),
(100, 72, 2),
(112, 81, 1),
(113, 82, 1),
(114, 83, 1),
(115, 84, 1),
(117, 85, 1),
(184, 67, 10),
(185, 71, 10),
(186, 76, 10),
(263, 81, 7),
(267, 82, 7),
(271, 83, 7),
(275, 84, 7),
(279, 85, 7),
(291, 11, 8),
(292, 11, 9),
(294, 69, 8),
(295, 69, 9),
(297, 72, 8),
(298, 72, 9),
(300, 74, 8),
(301, 74, 9),
(303, 75, 8),
(304, 75, 9),
(306, 87, 1),
(307, 88, 1),
(393, 3, 8),
(394, 3, 9),
(395, 8, 8),
(396, 8, 9),
(397, 9, 8),
(398, 9, 9),
(399, 70, 8),
(400, 70, 9),
(410, 87, 8),
(412, 89, 3),
(414, 90, 2),
(415, 91, 2),
(416, 92, 2),
(417, 93, 2),
(418, 94, 2),
(419, 95, 2),
(420, 96, 2),
(421, 97, 2),
(422, 98, 5),
(423, 99, 5),
(424, 100, 5),
(430, 101, 2),
(431, 102, 2),
(432, 103, 1),
(433, 104, 1),
(434, 105, 1),
(435, 106, 1),
(436, 107, 1),
(437, 108, 1),
(438, 109, 2),
(439, 110, 2),
(440, 111, 1),
(441, 112, 2),
(442, 113, 2),
(443, 114, 1),
(444, 115, 2),
(445, 116, 2),
(446, 117, 1),
(447, 118, 2),
(448, 119, 2);

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
(5, 'spam', '42d692', 0),
(7, 'konfirmasi', '16a765', 1),
(8, 'Pertanyaan', '4986e7', 1),
(9, 'informasi', '42d692', 1),
(10, 'Registrasi', 'ff7537', 1);

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

--
-- Dumping data for table `operator_number`
--

INSERT INTO `operator_number` (`id_operator_number`, `operator_number`, `id_smsc_name`) VALUES
(1, '+62811', 1),
(2, '+62812', 1),
(3, '+62813', 1),
(4, '+62814', 1),
(5, '+62815', 2),
(6, '+62816', 2),
(7, '+62817', 3),
(8, '+62818', 3),
(9, '+62819', 3),
(10, '+62821', 1),
(11, '+62822', 1),
(12, '+62823', 1),
(13, '+62828', 10),
(14, '+62831', 8),
(15, '+62838', 8),
(16, '+62852', 1),
(17, '+62853', 1),
(18, '+62855', 2),
(19, '+62856', 2),
(20, '+62857', 2),
(21, '+62858', 2),
(22, '+62859', 3),
(23, '+628681', 12),
(24, '+62877', 3),
(25, '+62878', 3),
(26, '+62879', 3),
(27, '+62881', 11),
(28, '+62882', 11),
(29, '+62883', 11),
(30, '+62884', 11),
(31, '+62887', 11),
(32, '+62888', 9),
(33, '+62889', 9),
(34, '+62896', 5),
(35, '+62897', 5),
(36, '+62898', 5),
(37, '+62898', 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
(8, 'Natrindo'),
(9, 'Mobile-8'),
(10, 'Sampoerna Telekom'),
(11, 'Smart Telecom'),
(12, 'PSN');

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
