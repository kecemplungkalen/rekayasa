-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2013 at 10:26 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `address_book`
--

INSERT INTO `address_book` (`id_address_book`, `id_user`, `first_name`, `last_name`, `number`, `id_smsc`, `email`, `create_date`, `last_update`) VALUES
(2, 1, 'jah', 'rastafara', '+62819678421', 4, 'jah@kingofking.mail', 1366263728, 1366263728),
(8, 1, 'mbah ', 'mangunjgj', '+6281927198', 0, 'mbah.mbagen@gmail.com', 1366633298, 1366633298),
(9, 1, 'mbah ', 'joyo', '+62789789123', 0, 'mbah_joyo_imut@ymail.com', 1366677403, 1366677403),
(10, 1, '+6287869122852', '', '+6287869122852', 3, '', 1367287159, 1367287159),
(11, 1, 'bob', 'maleh', '+62819678420', 3, 'bob_maleh@ymail.com', 1367459799, 1367459799),
(12, 1, 'mas', 'empat tiga', '+62819678430', 3, '', 1367659875, 1367659875),
(13, 1, '+62819678431', '', '+62819678431', 3, '', 1367660168, 1367660168),
(15, 1, 'revolusi', 'revolusi', '+6726823sdsd', 0, 'galang@mail.com', 1367815339, 1367815339),
(16, 1, 'galang', 'revolusi', '+62087328738283', 0, 'gr@gr.com', 1367815415, 1367815415),
(17, 1, 'mbah', 'buyut', '7839749387364', 0, 'mbah_buyut@mail.net', 1367907234, 1367907234),
(19, 1, '+628123456789', '', '+628123456789', 0, '', 1368156953, 1368156953),
(20, 0, '+6281931781912', '0', '+6281931781912', 3, '0', 1368171473, 1368171473),
(21, 1, '+6287878351478', '', '+6287878351478', 3, '', 1368172195, 1368172195),
(22, 1, '+6287845675824', '', '+6287845675824', 3, '', 1368172314, 1368172314),
(23, 1, '+6287835357712', '', '+6287835357712', 3, '', 1368172413, 1368172413),
(24, 1, '+6287867823851', '', '+6287867823851', 3, '', 1368172507, 1368172507),
(25, 1, 'Modem', 'XL 1', '+6287838743088', 3, 'modem@ruahweb.com', 1368422731, 1368422731),
(26, 0, '+6287838743087', '0', '+6287838743087', 3, '0', 1368425553, 1368425553),
(27, 0, '4444', '0', '4444', 0, '0', 1368427140, 1368427140),
(28, 1, 'XL-Axiata', '', 'XL-Axiata', 3, '', 1368427288, 1368427288),
(29, 0, '588', '', '588', 0, '0', 1368428447, 1368428447),
(30, 0, '*123#', '', '*123#', 0, '0', 1368428611, 1368428611),
(31, 0, '+6289678420', '', '+6289678420', 5, '0', 1368428858, 1368428858),
(32, 1, '+6287781263748', '', '+6287781263748', 3, '', 1368429506, 1368429506),
(33, 1, 'Mas ', 'Hisam', '+628562927907', 2, '', 1368510263, 1368510263);

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `id_blacklist` int(11) NOT NULL AUTO_INCREMENT,
  `blacklist_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id_blacklist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`id_blacklist`, `blacklist_number`) VALUES
(3, '+62819678430'),
(7, '+628123456789');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `config_modem`
--

INSERT INTO `config_modem` (`id_config_modem`, `nama_modem`, `phoneID`, `number`, `status`, `default`) VALUES
(4, 'Modem XL 1', 'RumahwebXL', '+6287838743088', 1, 1),
(5, 'Modem XL 2', 'RumahwebXL1', '+6287838743087', 1, 0);

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

--
-- Dumping data for table `config_rule`
--

INSERT INTO `config_rule` (`id_config_rule`, `id_config_modem`, `id_smsc_name`) VALUES
(9, 5, 3),
(10, 4, 1);

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
(9, 1, 'Test API', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `filter_action`
--

INSERT INTO `filter_action` (`id_action`, `id_filter`, `id_filter_action_type`, `id_label`, `api_post`, `api_error_email`, `order`) VALUES
(9, 9, 1, 7, '', '', 1),
(10, 9, 2, 5, 'http://trialintra.satusite.net/mod_api/smsconfirmation/add', 'revolusigalang@gmail.com', 2);

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
  `word` enum('1','2','3','4','5','6','7','8','9','10') DEFAULT NULL,
  `type_regex` enum('start_with','=','type','regex') NOT NULL,
  `id_filter_regex` int(11) DEFAULT NULL,
  `regex_data` varchar(50) DEFAULT NULL,
  `add_rule` enum('and','or','none') NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id_filter_detail`),
  KEY `id_filter` (`id_filter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `filter_detail`
--

INSERT INTO `filter_detail` (`id_filter_detail`, `id_filter`, `type_filter`, `word`, `type_regex`, `id_filter_regex`, `regex_data`, `add_rule`, `order`) VALUES
(24, 9, 'messages', '1', '=', 0, 'CONFIRM', 'and', 1),
(25, 9, 'messages', '2', 'regex', 0, '#[0-9]+', 'and', 2),
(26, 9, 'messages', '3', 'type', 2, '', 'and', 3),
(27, 9, 'messages', '4', 'type', 1, '', 'and', 4),
(28, 9, 'messages', '5', 'type', 5, '', 'and', 5),
(29, 9, 'messages', '6', 'type', 5, '', 'none', 6);

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

--
-- Dumping data for table `filter_regex`
--

INSERT INTO `filter_regex` (`id_filter_regex`, `regex`, `regex_value`) VALUES
(1, 'numeric', '/^[0-9]*$/'),
(2, 'alphabet', '/^[a-zA-Z]*$/'),
(3, 'alphanumeric', '/^[A-Za-z][A-Za-z0-9]*$/'),
(4, 'character', '/^[$-/:-?{-~!"^_`\\[\\]]*$/'),
(5, 'any', '/^[^\\n]*$/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id_group`, `id_address_book`, `id_user`, `id_groupname`) VALUES
(10, 9, 1, 1),
(11, 9, 1, 4),
(26, 11, 1, 4),
(75, 2, 1, 1),
(76, 10, 1, 1),
(80, 13, 1, 1),
(84, 16, 1, 4),
(85, 17, 1, 4),
(88, 25, 1, 4),
(89, 33, 1, 3),
(90, 8, 1, 1),
(91, 15, 1, 2);

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
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_address_book` int(11) NOT NULL DEFAULT '0',
  `number` varchar(20) NOT NULL DEFAULT 'Unset Number',
  `recive_date` int(11) NOT NULL,
  `content` text NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `last_update` int(11) NOT NULL,
  `status_archive` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_inbox`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

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
(87, '1505695122', 1, 12, '+62819678430', 1364200074, 'code name revolution', 1, 1367659875, 0, 2),
(88, '1165169767', 1, 13, '+62819678431', 1364200074, 'code name revolutionaries', 1, 1367660168, 0, 0),
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
(104, '98666392', 1, 22, '+6287845675824', 1368197524, 'Gammu Run One Recive Testing', 1, 1368172315, 0, 0),
(105, '2049485985', 1, 23, '+6287835357712', 1368197622, 'Gammu test SMS to 087838743088', 1, 1368172414, 0, 0),
(106, '876410452', 1, 24, '+6287867823851', 1368197716, '087838743088 Teting Saja Brotha ', 1, 1368172507, 0, 0),
(107, '1783805106', 1, 21, '+6287878351478', 1368197979, 'olehkarena itu maka penjajahan diatas dunia harus dihapuskan karena tidak sesuai dengan pri kemanusian dan pri keadilan', 1, 1368172772, 0, 0),
(108, '1783805106', 1, 21, '+6287878351478', 1368198010, 'olehkarena itu maka penjajahan diatas dunia harus dihapuskan karena tidak sesuai dengan pri kemanusian dan pri keadilan', 1, 1368172799, 0, 0),
(109, '1783805106', 1, 21, '+6287878351478', 1368173836, 'asassa', 1, 1368173836, 0, 0),
(110, '1783805106', 1, 21, '+6287878351478', 1368173863, 'System Reply Testing', 1, 1368173863, 0, 0),
(111, '1783805106', 1, 21, '+6287878351478', 1368199797, 'whooi please reply again brotha :-O', 1, 1368174595, 0, 0),
(112, '1783805106', 1, 21, '+6287878351478', 1368174926, 'AKU EMANG TAMPAN..!!!!!!!!', 1, 1368174926, 0, 0),
(113, '1783805106', 1, 21, '+6287878351478', 1368174946, 'AKU EMANG TAMPAN..!!!!!!!!', 1, 1368174946, 0, 1),
(114, '1783805106', 1, 21, '+6287878351478', 1368200460, 'hahahah Mosok?[test reply]', 1, 1368175249, 0, 1),
(115, '1783805106', 1, 21, '+6287878351478', 1368175282, 'testing reload modal', 1, 1368175282, 0, 0),
(116, '1783805106', 1, 21, '+6287878351478', 1368175293, 'testing reload modal', 1, 1368175293, 0, 0),
(117, '1783805106', 1, 21, '+6287878351478', 1368200641, 'reply lagi yak..', 1, 1368175429, 0, 0),
(118, '1783805106', 1, 21, '+6287878351478', 1368175446, 'yoo man ', 1, 1368175446, 0, 0),
(119, '1783805106', 1, 21, '+6287878351478', 1368175519, 'test rload lagi man :D', 1, 1368175519, 0, 0),
(121, '728247135', 1, 11, '+62819678420', 1368262925, 'test Reply yeh', 1, 1368262925, 0, 0),
(122, '1505695122', 1, 12, '+62819678430', 1368263131, 'tereply kah ??', 1, 1368263131, 0, 2),
(123, '1869105371', 1, 8, '+6281927198', 1368406266, 'Saved In Draft Yeah...', 1, 1368406266, 0, 0),
(126, '1869105371', 1, 8, '+6281927198', 1368408206, 'test saved draft and new thread\ndikirim saja ya brow...', 1, 1368408206, 0, 0),
(127, '1317901112', 0, 11, '+62819678420', 1368410615, 'Test Saved Draft Brow..', 1, 1368410615, 0, 0),
(128, '1687103744', 0, 17, '7839749387364', 1368411629, 'whooi please reply again brotha :-O', 1, 1368411629, 0, 0),
(129, '1950347926', 1, 25, '+6287838743088', 1368446817, 'ajkshkas\naklsjalksjla', 1, 1368422732, 0, 1),
(130, '384809859', 1, 26, '+6287838743087', 1368425553, '+6287838743087', 1, 1368425553, 0, 0),
(131, '1950347926', 1, 25, '+6287838743088', 1368450793, '+6287838743087', 1, 1368425583, 0, 1),
(132, '1950347926', 1, 25, '+6287838743088', 1368426340, 'REG TOP 999999999', 1, 1368426340, 0, 1),
(133, '1950347926', 1, 25, '+6287838743088', 1368451578, 'REG TOP 999999999', 1, 1368426364, 0, 1),
(134, '1067553368', 1, 27, '4444', 1368427140, 'DAFTAR', 1, 1368427140, 1, 0),
(135, '1067553368', 1, 27, '4444', 1368427158, 'DAFTAR', 1, 1368427158, 1, 0),
(136, '1067553368', 1, 27, '4444', 1368452345, 'Silahkan ketik:DAFTAR1#nama lkp#No.Identitas#Alamat.Contoh: DAFTAR1#Anindia Putri#0953081212820153#Jl. Kalibata 14 Jakarta 12490', 1, 1368427159, 1, 0),
(137, '1067553368', 1, 27, '4444', 1368452381, 'Silahkan ketik:DAFTAR1#nama lkp#No.Identitas#Alamat.Contoh: DAFTAR1#Anindia Putri#0953081212820153#Jl. Kalibata 14 Jakarta 12490', 1, 1368427191, 1, 0),
(138, '1067553368', 1, 27, '4444', 1368427267, 'DAFTAR1#Rumahweb Modem SMS#0953081212820153#Jl. Kalibata 14 Jakarta 12490', 1, 1368427267, 1, 0),
(139, '1597942620', 1, 28, 'XL-Axiata', 1368452477, 'Terima kasih, selanjutnya silahkan ketik: DAFTAR2#tempat lhr#tgl lhr(dd/mm/yyyy)#jenis kelamin(L/P). Contoh:DAFTAR2#Bandung#22/12/1982#P', 1, 1368427289, 1, 0),
(140, '1067553368', 1, 27, '4444', 1368427519, 'DAFTAR2#Yogyakarta#22/12/1982#L', 1, 1368427519, 1, 0),
(141, '1597942620', 1, 28, 'XL-Axiata', 1368452722, 'Selamat datang di XL-KU, kartu tarif MURAH & PASTI SEHARIAN bikin Pulsa Gak Abis-Abis! Info sisa pulsa dan Promo Paket Hemat di *123#. Info 817', 1, 1368427533, 1, 0),
(142, '1067553368', 1, 27, '4444', 1368452728, 'RBT Gratis berhadiah total 60 Juta. Aktifin RBT dr NOAH, Wali, Gamma1, dll di *919#. Pelanggan yg memiliki POIN tertinggi akan jd pemenang. CS: 817', 1, 1368427538, 1, 0),
(143, '1233568130', 1, 29, '588', 1368428448, '', 1, 1368428448, 0, 0),
(144, '1233568130', 1, 29, '588', 1368428462, '', 1, 1368428462, 0, 0),
(145, '1058784071', 1, 30, '*123#', 1368428611, 'cek', 1, 1368428611, 0, 0),
(146, '1890867690', 1, 31, '+6289678420', 1368428859, 'Test saja ...', 1, 1368428859, 0, 0),
(147, '882286797', 1, 32, '+6287781263748', 1368454708, 'Tetst $temp[''id_smsc'']', 1, 1368429507, 0, 0),
(148, '882286797', 1, 32, '+6287781263748', 1368455409, '087838743088test gratisan sms', 1, 1368430492, 0, 0),
(149, '882286797', 1, 32, '+6287781263748', 1368458992, 'whooooaaah nguantuk buanget brow..', 1, 1368433780, 0, 0),
(150, '882286797', 1, 32, '+6287781263748', 1368434337, 'tak sbrapa airmu...', 1, 1368434337, 0, 0),
(151, '882286797', 1, 32, '+6287781263748', 1368459782, 'bengawan solow,,,', 1, 1368434571, 0, 0),
(153, '882286797', 1, 32, '+6287781263748', 1368455409, 'CONFIRM #143 BCA 100000 14-05-2013 leli_sagita', 1, 1368509440, 0, 0),
(154, '882286797', 1, 32, '+6287781263748', 1368455409, 'CONFIRM #144 BCA 140000 14-05-2013 leli_sagita', 1, 1368509542, 0, 0),
(155, '53483849', 1, 33, '+628562927907', 1368535476, 'CONFIRM #144 BCA 140000 14-05-2013 leli_sagita', 1, 1368510263, 1, 0),
(156, '53483849', 1, 33, '+628562927907', 1368535630, 'CONF #144 BCA 140000 14-05-2013 leli_sagita', 1, 1368510418, 1, 0),
(157, '1537200085', 1, 33, '+628562927907', 1368535689, 'CONF #144 BCA 140000 14-05-2013 leli_sagita', 1, 1368510475, 0, 0),
(158, '1537200085', 2, 33, '+628562927907', 1368535742, 'maknyos', 1, 1368510528, 0, 0),
(159, '1537200085', 1, 33, '+628562927907', 1368535792, 'lupa', 1, 1368510579, 0, 0),
(160, '1537200085', 1, 33, '+628562927907', 1368510673, 'woooy yoman...', 1, 1368510673, 0, 0),
(161, '1537200085', 1, 33, '+628562927907', 1368510748, 'dddddddddddddddddddddd               fhhhhhhhhhhhhhhhdddddddddddj       dfhhhhhhhhhhhhhhhhhfdhd        dfhfghhhhhhhhhhhhhh d         fghfhggggggggggggjffhgjjjjjjjjjjj    ghhhhhhhhhhhhhfjjjjjjjjjjjjgk        fhjfffffhjjjf    fghgfhghj     ghjgjgjhgjhg', 1, 1368510748, 0, 0),
(162, '384809859', 1, 26, '+6287838743087', 1368515463, 'testing brow...', 1, 1368515463, 0, 0),
(163, '384809859', 1, 26, '+6287838743087', 1368540712, 'testing brow...', 1, 1368515498, 0, 0);

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

--
-- Dumping data for table `ip_restriction`
--

INSERT INTO `ip_restriction` (`id_ip_restriction`, `id_user`, `ip_restriction`) VALUES
(4, 2, '127.0.0.1'),
(5, 1, '192.168.1.1'),
(6, 1, '192.168.1.2'),
(7, 3, '8.8.8.8'),
(8, 4, '8.8.8.8');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=579 ;

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
(414, 90, 2),
(415, 91, 2),
(416, 92, 2),
(417, 93, 2),
(418, 94, 2),
(419, 95, 2),
(420, 96, 2),
(421, 97, 2),
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
(448, 119, 2),
(467, 121, 2),
(468, 122, 2),
(469, 87, 5),
(470, 122, 5),
(471, 77, 10),
(472, 78, 10),
(473, 79, 10),
(474, 80, 10),
(475, 123, 2),
(478, 126, 2),
(479, 127, 3),
(480, 127, 7),
(481, 128, 3),
(485, 129, 1),
(486, 130, 2),
(487, 131, 1),
(488, 132, 2),
(489, 133, 1),
(490, 133, 1),
(491, 134, 2),
(492, 135, 2),
(495, 138, 2),
(497, 140, 2),
(500, 143, 2),
(501, 144, 2),
(502, 145, 2),
(503, 146, 2),
(504, 147, 1),
(505, 148, 1),
(509, 150, 2),
(510, 151, 1),
(512, 153, 1),
(514, 154, 1),
(518, 155, 7),
(520, 156, 7),
(521, 157, 1),
(524, 159, 1),
(525, 160, 2),
(526, 161, 2),
(527, 162, 2),
(528, 163, 1),
(535, 98, 5),
(536, 99, 5),
(537, 100, 5),
(570, 81, 7),
(571, 82, 7),
(572, 83, 7),
(573, 84, 7),
(574, 85, 7),
(575, 95, 7),
(576, 96, 7),
(577, 121, 7),
(578, 88, 7);

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
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `level`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'User');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `first_name`, `last_name`, `status`, `create_date`, `last_update`, `level`, `api`, `api_key`) VALUES
(1, 'admin', 'e00cf25ad42683b3df678c61f42c6bda', 'admin', 'sms', 1, 1366262306, 1368691502, 1, 1, 'DHyUisPQk4cfuK3S8gt7bxeNzEhJaMBA'),
(2, 'galang', '7c84729cf45a522f35c8b43e658b7d5f', 'galang', 'revolusi', 1, 1368691483, 1368691483, 3, 1, 'aqJYjeDFPoIOnpGg7LWctlr29TAHk0Qx'),
(3, 'momod', 'e10adc3949ba59abbe56e057f20f883e', 'momod', 'imud', 1, 1368691691, 1368691691, 2, 1, 'IQGbHgU4oPJBp8AcjfS2wVW9Des5ZYTq');

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
