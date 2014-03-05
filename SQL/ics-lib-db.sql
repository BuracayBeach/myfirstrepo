-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2014 at 03:44 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_title`, `announcement_content`, `announcement_author`, `date_posted`) VALUES
(54, 'ICS'' social computing paper published in an international journal', 'The ICS social computing article titled "Ang Social Network sa Facebook ng mga Taga-Batangas at ng mga Taga-Laguna: Isang Paghahambing" was published in the online issue of the Asia Pacific Journal of Multidisciplinary Research (APJMR, ISSN 2350-7756). The article was a collaborative effort between Prof. Jaderick P. Pabico of ICS and Prof. Jose Rene L. Micor of the Institute of Chemistry.', 'admin', '2014-02-25'),
(55, 'PCJ publishes ICS research in crowd microsimulations', 'The Philippine Computing Journal has published in its 8th volume (series 1) the ICS paper entitled A Study on the Effect of Exit Widths and Crowd Sizes in the Formation of Arch in Clogged Crowds authored by Francisco Enrique Vicente G. Castro and Jaderick P. Pabico. The article details their findings, using multi-agent based microsimulation techniques, on the interactive effects of exit widths and crowd sizes in the formation of arching phenomenon usually observed in clogged crowds. The article must be cited as follows:\r\nCastro, F.E.V.G. and Pabico, J.P. (2013) A Study on the Effect of Exit Widths and Crowd Sizes in the Formation of Arch in Clogged Crowds. Philippine Computing Journal Vol. 8 No. 1: 21-29.', 'admin', '2014-02-25'),
(56, 'UPLB dominates NCITE 2013; Brings home two of three BPAs', 'UPLB researchers in Information Technology (IT) Education dominated the recently concluded 11th National Conference on IT Education (NCITE 2013) held in Villa Paraiso, Mambajao, Camiguin on 24-26 October 2013. The researchers from the Institute of Computer Science have been highly visible in the conference in terms of the number of papers submitted and accepted, the number of delegates from a single school who attended, the number of participation in a social challenge, the number of papers presented, the number of Best Paper Awards (BPA) received, and the number of future research topics that were developed.', 'admin', '2014-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_no` varchar(12) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_type` varchar(20) NOT NULL DEFAULT 'Book',
  `abstract` varchar(2048) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `status` enum('available','borrowed','reserved') NOT NULL DEFAULT 'available',
  `description` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `date_published` year(4) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `isbn` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_no`, `book_title`, `book_type`, `abstract`, `author`, `status`, `description`, `publisher`, `date_published`, `tags`, `isbn`) VALUES
('CS 125-j5', 'The Unix Programming Environment', 'Book', NULL, 'Brian W. Kernighan, Rob Pike', 'available', NULL, 'Prentice-Hall, Inc.', 1986, NULL, '971-17-9003-3'),
('CS 127 – K39', 'Database Design', 'Book', NULL, 'Gio Wiederhold', 'reserved', NULL, 'Philippine Graphic Arts, Inc.', 1997, NULL, '971-08-1932-1'),
('CS100 – G23', 'ASP 3.0 Programmer’s Reference', 'Book', '', 'Richard Anderson, Dan Denault, Brian Francis, Matthew Gibbs, Marco Gregorini, Alex Homer, Craig McQueen, Simon Robinson, John Schenken, Kevin Williams', 'available', NULL, 'Wrox Press Ltd', 2000, NULL, '1-861003-23-4'),
('CS130-N12', 'Computer Engineering Hardware Design', 'Book', NULL, 'M.Morris Mano', 'available', NULL, 'Prentice-Hall, Inc.', 1986, NULL, '971-8636-10-2'),
('CS142-S1', 'The Design of Well-Structured and Correct Programs', 'Book', NULL, 'Suad alagic, Michael A. Arbib', 'available', NULL, 'Springer-Verlag, New York Inc.', 1978, 'Program design', NULL),
('CS180-W1', 'Highly Parallel Computing', 'Book', NULL, 'George S. Almasi, Allan Gottlieb', 'available', NULL, 'The Benjamin/Cummings Publishing Company, Inc', 1994, 'parallel computing', '805304436'),
('CS21 – D23', 'Turbo C Version 2.0', 'Book', NULL, 'M.Morris Mano', 'available', NULL, 'Pernick Printing Corporation', 1988, NULL, '971-8636-10-2'),
('IT 280', 'Computer Security Management', 'Book', NULL, 'Karen A. Forcht', 'reserved', NULL, 'boyd & fraser publishing company', 1994, 'Computer Security', '878358811'),
('IT7', 'E-Commerce for Dummies', 'Book', NULL, 'Don Jones, Mark D. Scott, Richard Villars', 'reserved', NULL, 'Hungry Minds Inc.', 2001, 'E-commerce', '764508474'),
('JN 0001', 'Proceedings of the APL96 Conference', 'Journal', NULL, 'The Special Interest Group for the APL Programming Language', 'available', NULL, 'ACM Press', 1996, NULL, NULL),
('MG 0001', 'How to build a successful we-enabled warehouse and why you need one', 'Magazine', NULL, 'Julie Gibbs, Bob Craig, Aaron Zornes, Bradley Brown, Rhonda Stieber, Steve Bobrowski', 'available', NULL, 'Brown Printing Co.', 1997, NULL, '1065-3171'),
('MG 0002', 'Reinventing business Aplication Service Providers', 'Magazine', NULL, 'Leslie Steere, Jeff Spicer, Dave Clareke Mora, Carol Tady, Patricia Waddington', 'available', NULL, NULL, 2000, 'Oracle Corporation', NULL),
('REF 34', 'Econometric Methods', 'Book', NULL, 'J. Johnston', 'available', NULL, 'McGraw-Hill Kogakusha, Ltd. Tokyo', 1972, 'econometrics', NULL),
('REF 35', 'Macro-Evolutionary Dynamics', 'Book', NULL, 'Niles Eldredge', 'available', NULL, 'McGraw-Hill Publishing Company', 1989, 'macro-evolutionary dynamics', '70194742'),
('REF 40', 'Our Language Today', 'Book', NULL, 'David A. Conlin, George R. Herman, Jerome Martin', 'available', NULL, 'California State Department of Education Sacramento', 1966, 'english language', NULL),
('REF 43', 'Mastering CorelDRAW5 Special Edition', 'Book', NULL, 'Rick Altman', 'available', NULL, 'Sybex Inc', 1994, 'CorelDRAW 5', '078211508'),
('REF 49', 'Quantitative Approaches to Management', 'Book', NULL, 'Richard I. levin, David S. Rubin, Joel P. Stinson, Everette S. Gardner, Jr.', 'available', NULL, 'McGraw-Hill Book Company', 1989, 'management', '971084556'),
('REF 50', 'The Technology Connection', 'Book', NULL, 'Marc S. Gerstein', 'available', NULL, 'Adison-Wesley Publishing Company, Inc.', 1987, 'organization development', '971085089'),
('REF 53', 'e-Business: Roadmap for Success', 'Book', NULL, 'Dr. Ravi Kalakota, Marcia Robinson', 'available', NULL, 'Addison-Wesley', 1999, 'e-commerce', '201604809'),
('REF37', 'The Oxford Companion to the English Language', 'Book', NULL, 'Tom McArthur', 'available', NULL, 'Oxfor University Press', 1992, 'English language', '019214183'),
('SP 0001', 'Fast Search of Nucleotide Local Alignment using Makiling Compute Grid', 'SP', 'Local Alignment is a method of determining similarity between nucleotides or protein sequences. It identifies regions of optimal matches and highly similar sequences. The study presents a local alignment in parallel setup using C language and the MPI library. The implementation compares nucleotide files using the Makiling Compute Grid cluster in PC Lab 9 of the ICS (Institute of Computer Science), University of the Philippines Los Baños.', 'Jan Jacob Glenn M. Jasalin and Arian J. Jacildo', 'available', NULL, 'Jan Jacob Glenn M. Jasalin and Arian J. Jacildo', 2011, 'local alignment, Makiling Compute Grid', NULL),
('SP 0002', 'Photo-Realistic Interactive Cake Designer', 'SP', 'We present a cake designer application that allows users to design photo-realistic cake models. It provides a user interface with an interactive 3D designing environment and a functionality which allows the designs to be saved to and retrieved from the computer database. A survey of thirty respondents was conducted. Given a user manual and a basic tutorial, the respondents were asked to design their own cake. After designing, they were asked to rate the cake designer according to the following categories: User-Friendliness (the ease of learning and use), Interactivity (their ability to interact with cake elements such as layers), Responsiveness (how successful were the user commands and actions), Customizability (the capacity to produce unique and personalized designs), Photo-realism (the level of resemblance of the cake models to real cakes), Visual Impact (the ability of the graphics and visuals to command attention and hold interest), and Overall Usefulness (applicability to cake manufacturers or hobbyists in real life setting). Interactivity and Photo-realism got an average rating of 4 and 3.86 respectively (out of maximum of 5). The category that has the most varied ratings is Responsiveness with a standard deviation of 0.94. Based on the survey we concluded that 3D graphics and texture mapping are effective tools or developing interactive and photo-realistic design systems.', 'Andro I. Juni and Jaderick P. Pabico', 'available', NULL, 'Andro I. Juni and Jaderick P. Pabico', 2011, 'Texture Mapping, 3-Dimensional Graphics, 3D Modeling, Photo-realism', NULL),
('SP 0003', 'Real Time Cash register Event Detection', 'SP', 'In this study, a system to implement a real time activity monitoring of a cash register in business establishment was developed. Edge detection, shape matching using contours, and Euclidean Distance based color analysis are integrated to detect the event where the cash register is being opened. Each time an event or a cash register activity happens, the system automatically creates a video clip of the said transaction. The system was able to identify the events where the cash register''s drawer is open.', 'Jenneth P. Jusay and Prof. Margarita Carmen S. Paterno', 'available', NULL, 'Jenneth P. Jusay and Prof. Margarita Carmen S. Paterno', 2011, 'event detection, video surveillance', NULL),
('SP 0004', 'Visualization of Student Records Using FusionCharts', 'SP', 'Increasing demands of visualizing data have been arising as data is accumulated through the years. To see the unseen information behind colossal quantities of data, it must be converted into its graphical form, thus leading to a reliable data analysis. This study suggests the use of FusionChart, an open source component, in visualizing student records, specifically UPLB Student Records. Trends and patterns have been realized after running the program to generate common queries regarding performance of students, course effectiveness, and the like.', 'Jona Rae S. Obrador, Eleasah F. Loresco and Prof. Jamie M. Samaniego', 'available', NULL, 'Jona Rae S. Obrador, Eleasah F. Loresco and Prof. Jamie M. Samaniego', 2011, 'FusionCharts, Interactive Data Visualization, PHP, MySQL', NULL),
('SP 0005', 'Face Structure Model for Actor-Driven Animation', 'SP', 'This study presents a way for animation which is performance based through tracking of colored markers applied on selected facial features on an actor. In tracking of facial features , control parameters will be computed and will be used to animate a model. Evaluation of specific controlled parameters will play an important role for exhibiting more details and accuracy in the animation of the facial features.', 'Freddie L. Oliva Jr. and Dr. Vladimir Y. Mariano', 'available', NULL, 'Freddie L. Oliva Jr. and Dr. Vladimir Y. Mariano', 2011, 'actor-driven, performance-based, color tracking', NULL),
('TH 0001', 'UPLB Research Project Fund Monitoring System', 'Thesis', 'The UPLB Research Project Fund Monitoring System is an IT-based application project for the University of the Philippines Los Baños Accounting Office (UPLB-AO) which manages and controls the allotment and obligation of Trust Funds of the University. It provides a centralized database management system for all the users and controllers of the system for the purpose of managing the allotments and expenditures of the university’s research and extension project funds. Project fund leaders and their designated representatives are given access to view and monitor their allotment, expenses, and project fund balance. The UPLB-AO is given administrative access and privileges in order to maintain and support this site.', 'Petronila Pamela M. Alcasid', 'available', NULL, 'Petronila Pamela M. Alcasid', 2011, 'Accounting Office, Monitoring System', NULL),
('TH 0002', 'An Open Source Lodging-Related Content-Managed Information System', 'Thesis', 'The IT-based project implements an open source online reservation, booking, billing and payment system for hotel or lodging-based establishments. The open source project is a content-managed template which can be implemented for establishments with lodging-related products and services such as room use, discounted rates and, training and ancillary facilities. The clients may view the site and may proceed with the reservation process online. Clients are placed into primal consideration in providing web-based views and differentiated levels of access to administrative users. The system makes use of open source development software in the design, development and implementation. The different tests conducted for the project indicated that client and administrative access to the system is designed to be compatible with major browsers -- be they open source or proprietary. The project testing also yielded coherence in data transaction, processing, storage, retrieval, print, custom reports, content management and security features.', 'Ramiro Z. dela Cruz', 'borrowed', NULL, 'Ramiro Z. dela Cruz', 2009, 'Open source, Information System, Content-Managed', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'Can I have an account in the system?', '<p class="MsoNormal"><span lang="EN-PH">Only UPLB students and faculty members cannhave an account to the library system.<o:p></o:p></span></p>'),
(2, 'Can I reserve book online if I don''t have an account?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">No,\nyou can only search for books.</span></p>'),
(3, 'If I''m in LOA, is my ICS library account still activated?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">No,\nyour account will only be available if you are a registered student.</span></p>'),
(4, 'How many books can I reserve online?', 'Y<span style="font-family: inherit; font-size: 1rem; line-height: 1.6; text-indent: 0.5in;">ou can reserve as\nmany books as you like.</span><p class="MsoNormal" style="text-indent:.5in"><span lang="EN-PH"><o:p></o:p></span></p>'),
(5, 'When can I borrow the book after reserving online?', '<p class="MsoNormal"><span lang="EN-PH">You can get the book that you’ve reserved\nright after you’ve made your reservation online.<o:p></o:p></span></p>'),
(6, 'Can I extend borrowing the book online?', '<p class="MsoNormal"><span lang="EN-PH"><font size="2" face="arial">Just approach the librarian if you wish to extend it.</font></span></p>'),
(7, 'If I borrow the book from the library, will that be shown on my account?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Yes\nit will. You can view that on the myLibrary section.</span></p>'),
(8, 'Does the reserve button works like a waitlist function on systemone?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Yes it is.</span></p>'),
(9, 'Are we going to receive notifications if our due on returning the books is near?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Yes,\nthere will be an email to you stating that you have to return your borrowed\nbooks soon.</span><'),
(10, 'What am I going to do if I forgot my password?', '<p class="MsoNormal"><span lang="EN-PH">Just approach the librarian to change your\npassword. Bring a valid id or your form 5.<o:p></o:p></span></p>'),
(11, 'What is the function of add to cart?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">It\nfunctions as bookmark. Upon clicking it, the book information is stored on your\nmyLibrary for fut'),
(12, 'What am I going to do if I''m registered but my account is still deactivated?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Wait\nfor it to be activated by the administrator, if it took so long, you can\napproach the administr'),
(13, 'Can I search thesis from this system?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Yes\nyou can.</span></p>'),
(14, 'What if I reserved a book and I didn''t get it after a week, is the book still reserved under my account?', '<p class="MsoNormal"><span lang="EN-PH" style="font-size:11.0pt;font-family:\n&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-PH;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Yes.</span></p>'),
(15, 'Can I cancel my reservation online or do I have to go to the librarian to cancel?', '<p class="MsoNormal"><span lang="EN-PH">Yes you can cancel your reservation online.<o:p></o:p></span></p>');

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

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`username`, `book_no`, `date_added`) VALUES
('useruser', 'TH 0002', '2014-03-05 02:17:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lend`
--

INSERT INTO `lend` (`transaction_no`, `book_no`, `username_user`, `date_borrowed`, `date_returned`, `username_admin`) VALUES
(2, 'CS130-N12', 'useruser', '2014-03-05 02:16:24', '2014-03-05 02:16:37', 'admin'),
(3, 'TH 0002', 'useruser', '2014-03-05 02:16:25', '2014-03-05 02:16:38', 'admin'),
(4, 'CS100 – G23', 'useruser', '2014-03-05 02:16:35', '2014-03-05 02:16:36', 'admin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `username_admin`, `username_user`, `book_no`, `message`, `date_sent`, `type`) VALUES
(7, '', 'useruser', 'TH 0002', 'You may now claim your book at the library ASAP', '2014-03-05 02:14:26', 'claim'),
(8, '', 'useruser', 'CS100 – G23', 'You may now claim your book at the library ASAP', '2014-03-05 02:14:27', 'claim'),
(9, '', 'useruser', 'CS130-N12', 'You may now claim your book at the library ASAP', '2014-03-05 02:14:28', 'claim'),
(10, '', 'useruser', 'TH 0002', 'You may now claim your book at the library ASAP', '2014-03-05 02:16:47', 'claim'),
(11, '', 'useruser', 'CS100 – G23', 'You may now claim your book at the library ASAP', '2014-03-05 02:16:48', 'claim'),
(12, '', 'useruser', 'CS130-N12', 'You may now claim your book at the library ASAP', '2014-03-05 02:16:49', 'claim'),
(13, '', 'useruser', 'IT 280', 'You may now claim your book at the library ASAP', '2014-03-05 02:16:50', 'claim'),
(14, '', 'useruser', 'CS 127 – K39', 'You may now claim your book at the library ASAP', '2014-03-05 02:16:50', 'claim'),
(15, '', 'useruser', 'IT7', 'You may now claim your book at the library ASAP', '2014-03-05 02:16:51', 'claim'),
(16, '', 'useruser', 'TH 0002', 'You may now claim your book at the library ASAP', '2014-03-05 02:18:57', 'claim'),
(17, '', 'useruser', 'TH 0002', 'You may now claim your book at the library ASAP', '2014-03-05 02:19:24', 'claim'),
(18, '', 'useruser', 'TH 0002', 'You may now claim your book at the library ASAP', '2014-03-05 02:27:33', 'claim'),
(19, '', 'useruser', 'TH 0002', 'You may now claim your book at the library ASAP', '2014-03-05 02:29:51', 'claim');

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

--
-- Triggers `reserves`
--
DROP TRIGGER IF EXISTS `add_to_history`;
DELIMITER //
CREATE TRIGGER `add_to_history` AFTER INSERT ON `reserves`
 FOR EACH ROW INSERT INTO reserve_history values(NEW.book_no,NEW.username,NEW.date_reserved)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reserve_history`
--

CREATE TABLE IF NOT EXISTS `reserve_history` (
  `book_no` varchar(12) NOT NULL,
  `username` varchar(18) NOT NULL,
  `date_reserved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `reserve_history_ibfk_1` (`book_no`),
  KEY `reserve_history_ibfk_2` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `emp_no` varchar(9) DEFAULT NULL,
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
('Andescols', 'iD3cahShooj', 'male', 'enabled', 'RichardKHowle@jourrapide.com', 'student', '', '2013-33310', 'Richard', 'Kogan', 'Howle', '09178345223', 'BSCS', 'CAS'),
('Areimis', 'mah9dohH1ah', 'female', 'pending', 'SusanDSinegal@dayrep.com', 'student', '', '2010-25011', 'Susan', 'Davis', 'Sinegal', '09224123954', 'BSCS', 'CAS'),
('Ceitheart', 'aeroav0Gii', 'female', 'pending', 'UwaisahMawahibKouri@jourrapide.com', 'student', '', '2006-12908', 'Uwaisah', 'Mawahib', 'Kouri', '09161324873', 'BSCS', 'CAS'),
('Cionachis95', 'sie7El8jee', 'female', 'pending', 'SongWei@jourrapide.com', 'student', '', '2008-44165', 'Song', 'Tao', 'Wei', '09177563274', 'BSCS', 'CAS'),
('Comen1985', 'aechie2EePh', 'male', 'pending', 'DerekDOchoa@rhyta.com', 'student', '', '2004-33412', 'Derek', 'Dickerson', 'Ochoa', '09164158223', 'BSCS', 'CAS'),
('Dreme1994', 'Yeo3chiNgo', 'female', 'pending', 'FenChu@jourrapide.com', 'student', '', '2007-11543', 'Fen', 'Yuan', 'Chu', '09153473214', 'BSCS', 'CAS'),
('edzerium', 'allidaP', 'male', 'pending', 'dzerium@gmail.com', 'student', '', '2011-25010', 'Edzer Josh', 'Valentin', 'Padilla', '09178624975', 'BSCS', 'CAS'),
('Fany1993', 'bugmenot31', 'male', 'pending', 'HenryBPetersen@armyspy.com', 'student', '', '2009-50411', 'Henry', 'Barker', 'Peterson', '09178624678', 'BSCS', 'CAS'),
('Gloseloth', 'foH0yair', 'male', 'pending', 'DavidPKirtley@dayrep.com', 'student', '', '2010-25981', 'David', 'Pierre', 'Kirtley', '09151223598', 'BSCS', 'CAS'),
('Hene1964', 'ahaPhahoh6IY', 'male', 'pending', 'CharlesFHarlan@teleworm.us', 'student', '', '2011-11341', 'Charles', 'Farris', 'Harlan', '09178234756', 'BSCS', 'CAS'),
('Indess', 'Bie9pai0oo', 'female', 'pending', 'SidneyRSutton@rhyta.com', 'student', '', '2010-10321', 'Sidney', 'Rudd', 'Sutton', '09178627778', 'BSCS', 'CAS'),
('Lifflosight', 'tawooTh4c', 'female', 'pending', 'CarolynBMorrison@rhyta.com', 'student', '', '2010-29981', 'Carolyn', 'Burnham', 'Morrison', '09187230076', 'BSCS', 'CAS'),
('Mathervenrat', 'Ahmezae1', 'female', 'pending', 'EnriquetaSHooker@jourrapide.com', 'student', '', '2011-11390', 'Enriqueta', 'Snowden', 'Hooker', '09180143276', 'BSCS', 'CAS'),
('Procke', 'ya1Tie2sh', 'female', 'pending', 'BarbaraMCalle@armyspy.com', 'student', '', '2012-34510', 'Barbara', 'Marshal', 'Calle', '09178234123', 'BSCS', 'CAS'),
('Tharsen', 'iezah4aeP', 'male', 'enabled', 'JesseARoberts@armyspy.com', 'student', '', '2008-00180', 'Jesse', 'Anderson', 'Roberts', '09221899976', 'BSCS', 'CAS'),
('Thoureprot94', 'haingeiS1Io', 'male', 'disabled', 'HardingPuddifoot@dayrep.com', 'student', '', '2011-13575', 'Harding', 'Brandagamba', 'Puddifoot', '09176497221', 'BSCS', 'CAS'),
('Trater93', 'AgeFiezei2', 'male', 'enabled', 'RyanEPruitt@jourrapide.com', 'student', '', '2013-14344', 'Ryan', 'Emerson', 'Pruitt', '09180023476', 'BSCS', 'CAS'),
('Tury1993', 'Xa4IquieniVe', 'female', 'pending', 'SakikoKamuta@jourrapide.com', 'student', '', '2012-56916', 'Sakiko', 'Asada', 'Kamuta', '09227869432', 'BSCS', 'CAS'),
('useruser', 'e172c5654dbc12d78ce1850a4f7956ba6e5a3d2ac40f0925fc6d691ebb54f6bf', 'male', 'enabled', 'user@user.user', 'student', '', '2004-33411', 'user', 'user', 'user', '639232143048', 'MVE', 'GS'),
('Waskeend96', 'Ooyiush1pau', 'female', 'pending', 'StephanieKuefer@teleworm.us', 'student', '', '2009-28943', 'Stephanie', 'Fisher', 'Kuefer', '09151784993', 'BSCS', 'CAS'),
('Whattis', 'aiquai5Oo', 'male', 'pending', 'JordanLMancini@teleworm.us', 'student', '', '2010-10290', 'Jordan', 'Lincoln', 'Mancini', '09154573211', 'BSCS', 'CAS');

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
  ADD CONSTRAINT `reserves_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserves_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserve_history`
--
ALTER TABLE `reserve_history`
  ADD CONSTRAINT `reserve_history_ibfk_1` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserve_history_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
