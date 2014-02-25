-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2014 at 06:52 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ics-lib-db`
--
CREATE DATABASE IF NOT EXISTS `ics-lib-db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ics-lib-db`;

-- --------------------------------------------------------

--
-- Table structure for table `account_history`
--

CREATE TABLE IF NOT EXISTS `account_history` (
  `username_user` varchar(18) NOT NULL,
  `username_admin` varchar(18) NOT NULL,
  `email` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` enum('enable','disable','activate') NOT NULL,
  PRIMARY KEY (`username_user`,`username_admin`,`email`,`date`),
  KEY `account_history_username_admin` (`username_admin`),
  KEY `account_history_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_history`
--

INSERT INTO `account_history` (`username_user`, `username_admin`, `email`, `date`, `action`) VALUES
('Andescols', 'admin', 'RichardKHowle@jourrapide.com', '2014-02-25 05:08:17', 'activate'),
('Tharsen', 'admin', 'JesseARoberts@armyspy.com', '2014-02-25 05:09:19', 'activate'),
('Thoureprot94', 'admin', 'HardingPuddifoot@dayrep.com', '2014-02-25 05:08:54', 'activate'),
('Thoureprot94', 'admin', 'HardingPuddifoot@dayrep.com', '2014-02-25 05:09:17', 'disable'),
('Trater93', 'admin', 'RyanEPruitt@jourrapide.com', '2014-02-25 05:08:50', 'activate'),
('Trater93', 'admin', 'RyanEPruitt@jourrapide.com', '2014-02-25 05:08:56', 'disable'),
('Trater93', 'admin', 'RyanEPruitt@jourrapide.com', '2014-02-25 05:09:14', 'enable'),
('useruser', 'admin', 'user@user.user', '2014-02-25 06:50:02', 'activate');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  `username` varchar(18) NOT NULL,
  `password` varchar(65) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name_first`, `name_middle`, `name_last`, `username`, `password`) VALUES
('admin', 'mino', 'bulalo', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_content` varchar(1024) NOT NULL,
  `announcement_author` varchar(255) NOT NULL,
  `date_posted` date NOT NULL,
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_title`, `announcement_content`, `announcement_author`, `date_posted`) VALUES
(52, 'lkjasd', 'hehe', 'allanconda', '2014-02-21'),
(53, 'announcement1', 'hahah', '', '2014-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_no` varchar(12) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_type` varchar(20) NOT NULL DEFAULT 'Book',
  `abstract` varchar(1024) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `status` enum('available','borrowed','reserved') NOT NULL DEFAULT 'available',
  `description` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `date_published` year(4) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_no`, `book_title`, `book_type`, `abstract`, `author`, `status`, `description`, `publisher`, `date_published`, `tags`) VALUES
('AB 1234', 'Merry Ann Title', 'Book', NULL, NULL, 'reserved', 'Happy New Yeare', 'Santa Claus', 0000, 'sad'),
('asdasd', 'jh', 'Journal', NULL, 'jkh', 'available', 'jkh', 'jkhjkh', 0000, 'jljkljj'),
('CD 4321', 'How To Program in Java', '', 'abstractttt', NULL, 'available', 'Search Google Chrome', 'Not A Programmer', 0000, ''),
('EF 5678', 'How To Kill Spiders', 'Book', NULL, NULL, 'reserved', 'Shoe', 'Microsoft', 0000, NULL),
('GH 8765', 'Sleeping in Class Tips', 'Book', NULL, NULL, 'reserved', 'Sleep peacefully while in Class', 'Rey Benedicto', 0000, NULL),
('IJ 1357', 'French Fries from Potatoes', 'Book', NULL, NULL, 'reserved', 'Learn how to eat potatoes', 'McDo', 0000, NULL),
('jh', 'jk', 'Book', NULL, 'hkj', 'available', 'hjkh', 'jkh', 0000, 'kj'),
('KL 1111', 'Cram Effficiently', 'Thesis', 'dsadsa', 'Boy bulalo', 'reserved', 'Learn how to waste time then cram', 'Rey Benedicto', 0000, 'asdsa');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_no` varchar(9) NOT NULL,
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  PRIMARY KEY (`employee_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_no`, `name_first`, `name_middle`, `name_last`) VALUES
('200413341', 'Derek', 'Dickerson', 'Ochoa'),
('200611290', 'Uwaisah', 'Mawahib', 'Sidney'),
('200711154', 'Fenrir', 'Yuan', 'Chuang'),
('200810018', 'Jesse', 'Anderson', 'Edzer Josh'),
('200814416', 'Songhak', 'Taong', 'Wei'),
('200912894', 'Stephanie', 'Fisher', 'Kuefer'),
('200915041', 'Henry', 'Barker', 'Peterson'),
('201011029', 'Jordan', 'Lincoln', 'Susan'),
('201011032', 'Kemployeei', 'Rudd', 'Sutton'),
('201012501', 'Mancini', 'Davis', 'Sinegal'),
('201012598', 'David', 'Pierre', 'Kirtley'),
('201012998', 'Carolyn', 'Carolyn', 'Morrison'),
('201111134', 'Pruitt', 'Farris', 'Harlan'),
('201111139', 'Enriqueta', 'Snowden', 'Hooker'),
('201111357', 'Harding', 'Brandagamba', 'Puddifoot'),
('201112501', 'Roberts', 'Valentin', 'Padilla'),
('201213451', 'Barbara', 'Ryan', 'Calleva'),
('201215691', 'Kamuta', 'Asada', 'Sakiko'),
('201311434', 'Marshal', 'Kogan', 'Charles'),
('201313331', 'Richard', 'Emerson', 'Howle');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `username` varchar(18) NOT NULL,
  `book_no` varchar(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`book_no`),
  KEY `favorites_book_no` (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lend`
--

CREATE TABLE IF NOT EXISTS `lend` (
  `transaction_no` int(8) NOT NULL AUTO_INCREMENT,
  `book_no` varchar(12) NOT NULL,
  `username_user` varchar(18) NOT NULL,
  `date_borrowed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_returned` timestamp NULL DEFAULT NULL,
  `username_admin` varchar(18) NOT NULL,
  PRIMARY KEY (`transaction_no`,`book_no`,`username_user`,`username_admin`),
  KEY `lend_book_no` (`book_no`),
  KEY `lend_username_user` (`username_user`),
  KEY `lend_username_admin` (`username_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username_admin` varchar(18) DEFAULT NULL,
  `username_user` varchar(18) NOT NULL,
  `book_no` varchar(12) DEFAULT NULL,
  `message` varchar(755) DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('overdue','claim','custom') NOT NULL,
  PRIMARY KEY (`id`,`username_user`),
  KEY `notifications_username_admin` (`username_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `username_admin`, `username_user`, `book_no`, `message`, `date_sent`, `type`) VALUES
(2, '', 'useruser', 'IJ 1357', 'You may now claim your book at the library ASAP', '2014-02-25 06:50:24', 'claim'),
(3, '', 'useruser', 'EF 5678', 'You may now claim your book at the library ASAP', '2014-02-25 06:50:25', 'claim'),
(4, '', 'useruser', 'asdasd', 'You may now claim your book at the library ASAP', '2014-02-25 06:50:26', 'claim'),
(5, '', 'useruser', 'AB 1234', 'You may now claim your book at the library ASAP', '2014-02-25 06:50:27', 'claim'),
(6, '', 'useruser', 'GH 8765', 'You may now claim your book at the library ASAP', '2014-02-25 06:50:28', 'claim');

-- --------------------------------------------------------

--
-- Table structure for table `our`
--

CREATE TABLE IF NOT EXISTS `our` (
  `student_no` varchar(10) NOT NULL,
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  PRIMARY KEY (`student_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `our`
--

INSERT INTO `our` (`student_no`, `name_first`, `name_middle`, `name_last`) VALUES
('2004-33411', 'Derek', 'Dickerson', 'Ochoa'),
('2006-12908', 'Uwaisah', 'Mawahib', 'Kouri'),
('2007-11543', 'Fen', 'Yuan', 'Chu'),
('2008-00180', 'Jesse', 'Anderson', 'Roberts'),
('2008-44165', 'Song', 'Tao', 'Wei'),
('2009-28943', 'Stephanie', 'Fisher', 'Kuefer'),
('2009-50411', 'Henry', 'Barker', 'Peterson'),
('2010-10290', 'Jordan', 'Lincoln', 'Mancini'),
('2010-10321', 'Sidney', 'Rudd', 'Sutton'),
('2010-25011', 'Susan', 'Davis', 'Sinegal'),
('2010-25981', 'David', 'Pierre', 'Kirtley'),
('2010-29981', 'Carolyn', 'Carolyn', 'Morrison'),
('2011-11341', 'Charles', 'Farris', 'Harlan'),
('2011-11390', 'Enriqueta', 'Snowden', 'Hooker'),
('2011-13575', 'Harding', 'Brandagamba', 'Puddifoot'),
('2011-25010', 'Edzer Josh', 'Valentin', 'Padilla'),
('2012-34510', 'Barbara', 'Marshal', 'Calle'),
('2012-56916', 'Sakiko', 'Asada', 'Kamuta'),
('2013-14344', 'Ryan', 'Emerson', 'Pruitt'),
('2013-33310', 'Richard', 'Kogan', 'Howle');

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE IF NOT EXISTS `reserves` (
  `book_no` varchar(12) NOT NULL,
  `username` varchar(18) NOT NULL,
  `date_reserved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rank` smallint(6) NOT NULL AUTO_INCREMENT,
  `notified` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`book_no`,`username`,`rank`),
  KEY `reserves_username` (`username`),
  KEY `reserves_rank` (`rank`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`book_no`, `username`, `date_reserved`, `rank`, `notified`) VALUES
('AB 1234', 'useruser', '2014-02-25 06:50:27', 6, 1),
('EF 5678', 'useruser', '2014-02-25 06:50:25', 4, 1),
('GH 8765', 'useruser', '2014-02-25 06:50:28', 7, 1),
('IJ 1357', 'useruser', '2014-02-25 06:50:24', 3, 1),
('KL 1111', 'useruser', '2014-02-25 06:50:23', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(18) NOT NULL,
  `password` varchar(65) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `status` enum('enabled','disabled','pending') NOT NULL DEFAULT 'pending',
  `email` varchar(55) NOT NULL,
  `usertype` enum('student','employee') NOT NULL,
  `emp_no` varchar(12) DEFAULT NULL,
  `student_no` varchar(10) DEFAULT NULL,
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `course` varchar(8) DEFAULT NULL,
  `college` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`username`,`email`),
  UNIQUE KEY `emp_no` (`emp_no`,`student_no`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `sex`, `status`, `email`, `usertype`, `emp_no`, `student_no`, `name_first`, `name_middle`, `name_last`, `mobile_no`, `course`, `college`) VALUES
('Andescols', 'iD3cahShooj', 'male', 'enabled', 'RichardKHowle@jourrapide.com', 'student', NULL, '2013-33310', 'Richard', 'Kogan', 'Howle', '09178345223', 'BSCS', 'CAS'),
('Areimis', 'mah9dohH1ah', 'female', 'pending', 'SusanDSinegal@dayrep.com', 'student', NULL, '2010-25011', 'Susan', 'Davis', 'Sinegal', '09224123954', 'BSCS', 'CAS'),
('Ceitheart', 'aeroav0Gii', 'female', 'pending', 'UwaisahMawahibKouri@jourrapide.com', 'student', NULL, '2006-12908', 'Uwaisah', 'Mawahib', 'Kouri', '09161324873', 'BSCS', 'CAS'),
('Cionachis95', 'sie7El8jee', 'female', 'pending', 'SongWei@jourrapide.com', 'student', NULL, '2008-44165', 'Song', 'Tao', 'Wei', '09177563274', 'BSCS', 'CAS'),
('Comen1985', 'aechie2EePh', 'male', 'pending', 'DerekDOchoa@rhyta.com', 'student', NULL, '2004-33411', 'Derek', 'Dickerson', 'Ochoa', '09164158223', 'BSCS', 'CAS'),
('Dreme1994', 'Yeo3chiNgo', 'female', 'pending', 'FenChu@jourrapide.com', 'student', NULL, '2007-11543', 'Fen', 'Yuan', 'Chu', '09153473214', 'BSCS', 'CAS'),
('edzerium', 'allidaP', 'male', 'pending', 'dzerium@gmail.com', 'student', NULL, '2011-25010', 'Edzer Josh', 'Valentin', 'Padilla', '09178624975', 'BSCS', 'CAS'),
('Fany1993', 'bugmenot31', 'male', 'pending', 'HenryBPetersen@armyspy.com', 'student', NULL, '2009-50411', 'Henry', 'Barker', 'Peterson', '09178624678', 'BSCS', 'CAS'),
('Gloseloth', 'foH0yair', 'male', 'pending', 'DavidPKirtley@dayrep.com', 'student', NULL, '2010-25981', 'David', 'Pierre', 'Kirtley', '09151223598', 'BSCS', 'CAS'),
('Hene1964', 'ahaPhahoh6IY', 'male', 'pending', 'CharlesFHarlan@teleworm.us', 'student', NULL, '2011-11341', 'Charles', 'Farris', 'Harlan', '09178234756', 'BSCS', 'CAS'),
('Indess', 'Bie9pai0oo', 'female', 'pending', 'SidneyRSutton@rhyta.com', 'student', NULL, '2010-10321', 'Sidney', 'Rudd', 'Sutton', '09178627778', 'BSCS', 'CAS'),
('Lifflosight', 'tawooTh4c', 'female', 'pending', 'CarolynBMorrison@rhyta.com', 'student', NULL, '2010-29981', 'Carolyn', 'Burnham', 'Morrison', '09187230076', 'BSCS', 'CAS'),
('Mathervenrat', 'Ahmezae1', 'female', 'pending', 'EnriquetaSHooker@jourrapide.com', 'student', NULL, '2011-11390', 'Enriqueta', 'Snowden', 'Hooker', '09180143276', 'BSCS', 'CAS'),
('Procke', 'ya1Tie2sh', 'female', 'pending', 'BarbaraMCalle@armyspy.com', 'student', NULL, '2012-34510', 'Barbara', 'Marshal', 'Calle', '09178234123', 'BSCS', 'CAS'),
('Tharsen', 'iezah4aeP', 'male', 'enabled', 'JesseARoberts@armyspy.com', 'student', NULL, '2008-00180', 'Jesse', 'Anderson', 'Roberts', '09221899976', 'BSCS', 'CAS'),
('Thoureprot94', 'haingeiS1Io', 'male', 'disabled', 'HardingPuddifoot@dayrep.com', 'student', NULL, '2011-13575', 'Harding', 'Brandagamba', 'Puddifoot', '09176497221', 'BSCS', 'CAS'),
('Trater93', 'AgeFiezei2', 'male', 'enabled', 'RyanEPruitt@jourrapide.com', 'student', NULL, '2013-14344', 'Ryan', 'Emerson', 'Pruitt', '09180023476', 'BSCS', 'CAS'),
('Tury1993', 'Xa4IquieniVe', 'female', 'pending', 'SakikoKamuta@jourrapide.com', 'student', NULL, '2012-56916', 'Sakiko', 'Asada', 'Kamuta', '09227869432', 'BSCS', 'CAS'),
('useruser', 'e172c5654dbc12d78ce1850a4f7956ba6e5a3d2ac40f0925fc6d691ebb54f6bf', 'male', 'enabled', 'user@user.user', 'student', '', '2004-33411', 'user', 'user', 'user', '639232143048', 'MVE', 'GS'),
('Waskeend96', 'Ooyiush1pau', 'female', 'pending', 'StephanieKuefer@teleworm.us', 'student', NULL, '2009-28943', 'Stephanie', 'Fisher', 'Kuefer', '09151784993', 'BSCS', 'CAS'),
('Whattis', 'aiquai5Oo', 'male', 'pending', 'JordanLMancini@teleworm.us', 'student', NULL, '2010-10290', 'Jordan', 'Lincoln', 'Mancini', '09154573211', 'BSCS', 'CAS');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_history`
--
ALTER TABLE `account_history`
  ADD CONSTRAINT `account_history_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_history_username_admin` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_history_username_user` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lend`
--
ALTER TABLE `lend`
  ADD CONSTRAINT `lend_username_admin` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lend_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lend_username_user` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_username_admin` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `reserves_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserves_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
