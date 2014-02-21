-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2014 at 10:05 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

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

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  `username` varchar(18) NOT NULL,
  `password` varchar(18) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name_first`, `name_middle`, `name_last`, `username`, `password`) VALUES
('First', 'Middle', 'Last', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `book_no` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`book_no`,`name`),
  KEY `book_no` (`book_no`),
  KEY `book_no_2` (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`book_no`, `name`) VALUES
('AB 1234', 'Maila Medina'),
('CD 4321', 'Ysa Angeles'),
('EF 5678', 'Rey Benedicto'),
('GH 8765', 'Yay Sabado'),
('IJ 1357', 'Paulo Cuenca'),
('KL 2468', 'Kim Samaniego');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_no` varchar(12) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `status` enum('available','borrowed','reserved') NOT NULL DEFAULT 'available',
  `description` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_no`, `book_title`, `status`, `description`, `publisher`, `date_published`, `tags`) VALUES
('AB 1234', 'Merry Christmas', 'available', 'Happy New Yeare', 'Santa Claus', '2014-01-18', NULL),
('CD 4321', 'How To Program in Java', 'reserved', 'Search Google Chrome', 'Not A Programmer', '2014-01-01', NULL),
('EF 5678', 'How To Kill Spiders', 'borrowed', 'Shoe', 'Microsoft', '2013-08-06', NULL),
('GH 8765', 'Sleeping in Class Tips', 'available', 'Sleep peacefully while in Class', 'Rey Benedicto', '2014-04-18', NULL),
('IJ 1357', 'French Fries from Potatoes', 'reserved', 'Learn how to eat potatoes', 'McDo', '2013-09-17', NULL),
('KL 2468', 'Cram Efficiently', 'available', 'Learn how to waste time then cram', 'Rey Benedicto', '2012-11-06', NULL);

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
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_content` varchar(1024) NOT NULL,
  `news_author` varchar(255) NOT NULL,
  `date_posted` date NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username_admin` varchar(18) NOT NULL,
  `username_user` varchar(18) NOT NULL,
  `book_no` varchar(12) DEFAULT NULL,
  `message` varchar(755) DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('overdue','claim','custom') NOT NULL,
  PRIMARY KEY (`id`,`username_admin`,`username_user`),
  KEY `notifications_username_user` (`username_admin`),
  KEY `notifications_username_admin` (`username_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(18) NOT NULL,
  `password` varchar(50) NOT NULL,
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
('theuser', '34819d7beeabb9260a5c854bc85b3e44', 'male', 'pending', 'username@email.com', 'student', '', '1908-00001', 'The', 'Oldest', 'Student Ever', '639351624693', 'BSA', 'CA');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_history`
--
ALTER TABLE `account_history`
  ADD CONSTRAINT `account_history_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `account_history_username_admin` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `account_history_username_user` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `favorites_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `lend`
--
ALTER TABLE `lend`
  ADD CONSTRAINT `lend_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `lend_username_admin` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `lend_username_user` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_username_admin` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `notifications_username_user` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `reserves_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserves_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
