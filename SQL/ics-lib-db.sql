-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2014 at 02:02 PM
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
  `book_no` varchar(25) NOT NULL,
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
  `other_detail` varchar(4096) NOT NULL,
  PRIMARY KEY (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_no`, `book_title`, `book_type`, `abstract`, `author`, `status`, `description`, `publisher`, `date_published`, `tags`, `isbn`, `other_detail`) VALUES
('C11 - C34', 'Pascal User and Report', 'Book', NULL, 'Jensen, K', 'available', '', 'Publishing Company', 1995, 'Pascal User', NULL, ''),
('C127 - K11', 'Microsoft Access 97', 'Book', NULL, 'O Brien, T et al', 'available', '', 'Publishing Company', 1999, 'microsoft', NULL, ''),
('C127 - K15', 'Business Data Communications', 'Book', NULL, 'FitzGerald, J', 'available', '', 'Publishing Company', 1998, '', NULL, ''),
('C127 - K19', 'Data Management and File Processing', 'Book', NULL, 'Loomis, M', 'available', '', 'ABC Publishing Company', 2000, '', NULL, ''),
('C21 - D3', 'From Basic to C', 'Book', NULL, 'Templeton, HM', 'available', '', 'Publishing Company', 2000, 'C', NULL, ''),
('CS1 - A1', 'Microcomputer Keyboarding and Document Processing', 'Book', NULL, 'Stanley, Johnson', 'available', '', 'Publishing Company', 1998, 'document processing, keyboarding', NULL, ''),
('CS1 - A12', 'Microcomputers and Microprocessors', 'Book', NULL, 'Uffenbeck, J.', 'available', '', 'Publishing Company', 1995, 'microcomputers, microprocessors', NULL, ''),
('CS1 - A15', 'Latex for Everyone', 'Book', NULL, 'Hahn, J', 'available', '', 'Publishing Company', 1995, 'latex', NULL, ''),
('CS1 - A16', 'IBM PC Advanced Troubleshooting', 'Book', NULL, 'Brenner, RC', 'available', '', 'Publishing Company', NULL, 'IBM PC', NULL, ''),
('CS1 - A2', 'The Latext Companion', 'Book', NULL, 'Goossens; Mittelbach', 'available', '', 'Publishing Company', 2000, 'latext', NULL, ''),
('CS1 - A3', 'Pagemaker 4 for the PC', 'Book', NULL, 'Webster; Tony; et al', 'available', '', 'Publishing Company', 1996, 'pagemaker', NULL, ''),
('CS1 - A4', 'Macintosh Revealed vol.1', 'Book', NULL, 'Chernicoff, S.', 'available', '', 'Rey Publishing Company', 2010, 'macintosh', NULL, ''),
('CS1 - A5', 'Inside the Norton Utilities 6.0 Third Edition', 'Book', NULL, 'Krumn, R', 'available', '', 'Ady Publishing Company', 2013, '', NULL, ''),
('CS1 - A6', 'Wordperfect 5.1 Tips, Tricks and Traps Third Edition', 'Book', NULL, 'Stewart III; et al', 'available', '', 'Publishing Company', 2000, 'tricks', NULL, ''),
('CS1 - A8', 'Mastering Harvard Graphics', 'Book', NULL, 'Larsen, G H', 'available', '', 'Publishing Company', 1999, 'Harvard Graphics', NULL, ''),
('CS100 - G1', 'HTML, JAVA, CGI, VRML, SGML Unleashed', 'Book', NULL, 'Stanek,WR', 'available', '', '', NULL, 'html', NULL, ''),
('CS100 - G23', 'ASP 3.0 Programmer’s Reference', 'Book', '', 'Richard Anderson; Dan Denault; Brian Francis; Matthew Gibbs; Marco Gregorini; Alex Homer; Craig McQueen; Simon Robinson; John Schenken; Kevin Williams', 'available', NULL, 'Wrox Press Ltd', 2000, NULL, '1-861003-23-4', ''),
('CS11 - C11', 'Hands-on Turbo Pascal', 'Book', NULL, 'Goldstein, LJ', 'available', '', '', NULL, 'Turbo Pascal', NULL, ''),
('CS11 - C18', 'Turbo Pascal Edition', 'Book', NULL, 'Savitch, WJ', 'available', '', 'Publishing Company', 2000, 'Turbo Pascal', NULL, ''),
('CS11 - C2', 'Structures and Abstractions', 'Book', NULL, 'Salmon, WI', 'available', '', 'Publishing Company', 1995, 'Abstractions', NULL, ''),
('CS11 - C3', 'Getting the Most from Turbo Pascal', 'Book', NULL, 'Smith, JT', 'available', '', 'Publishing Company', 1992, 'Turbo Pascal', NULL, ''),
('CS11 - C30', 'Computer Assisted Learning', 'Book', NULL, 'Heinemann', 'available', '', 'Publishing Company', 1998, 'computer', NULL, ''),
('CS11 - C40', 'Introduction to Computer Science', 'Book', NULL, 'Zwass, V', 'available', '', 'Publishing Company', 2000, 'Computer Science', NULL, ''),
('CS11 - C6', 'Pascal', 'Book', NULL, 'Smith, JT', 'available', '', 'Publishing Company', 2000, 'Pascal', NULL, ''),
('CS11 - C7', 'Learning Basic for the Macintosh', 'Book', NULL, 'Lien, DA', 'available', '', 'Publishing Company', 1994, 'macintosh', NULL, ''),
('CS11 - C8', 'The Science of Programming', 'Book', NULL, 'Gries, D', 'available', '', 'Publishing Company', 1993, 'programming', NULL, ''),
('CS123 - H12', 'Algorithm and Data Structures', 'Book', NULL, 'Niklaus Wirth', 'available', '', 'Publishing Company', 1999, 'data structures', NULL, ''),
('CS123 - H2', 'Programming with Data Structures', 'Book', NULL, 'Kruse, R L', 'available', '', 'Publishing Company', 1999, 'data structures', NULL, ''),
('CS123 - H6', 'Algorithm and Data Structures', 'Book', NULL, 'Kingston, JH', 'available', '', 'Publishing Company', 2000, '', NULL, ''),
('CS123 - H7', 'Data Structures Using Pascual', 'Book', NULL, 'Tanenbaum, AM', 'available', '', 'Publishing Company', 1999, 'data structures', NULL, ''),
('CS124 - I1', 'Programming in Basic with Applications', 'Book', NULL, 'Logsdon, T', 'available', '', 'Publishing Company', 2000, 'programming', NULL, ''),
('CS124 - I18', 'C++ SAMS Teach Yourself', 'Book', NULL, 'Jesse Liberty', 'available', '', 'Publishing Company', 1998, '', NULL, ''),
('CS124 - I4', 'Structured Cobol Programming', 'Book', NULL, 'Stein', 'available', '', 'Publishing Company', NULL, 'cobol', NULL, ''),
('CS124 - I5', 'Using Turbo Prolog', 'Book', NULL, 'Robinson, PR', 'available', '', 'Publishing Company', 1995, '', NULL, ''),
('CS124 - I8', 'Programming Languages', 'Book', NULL, 'Tucker, AB', 'available', '', 'Publishing Company', 2000, 'programming languages', NULL, ''),
('CS124 - I9', 'Concepts of Programming Languages', 'Book', NULL, 'Sebesta, RW', 'available', '', 'Publishing House', 1999, 'programming languages', NULL, ''),
('CS124 - J24', 'Modern Operating Systems', 'Book', NULL, 'Andrew S. Tanenbaum', 'available', '', 'AB Publishing House', 1998, 'operating systems', NULL, ''),
('CS124 - J25', 'Operating System Concepts', 'Book', NULL, 'Silverschatz Galvin', 'available', '', 'Publishing Company', 2002, 'operating systems', NULL, ''),
('CS125 - J', 'The Unix Programming Environment', 'Book', NULL, 'Kernighan, B', 'available', '', 'Publishing Company', 1994, 'unix', NULL, ''),
('CS125 - J4', 'An Introduction to Operating Systems', 'Book', NULL, 'Kernighan, B', 'available', '', 'ABC Publishing House', 1995, 'operating systems', NULL, ''),
('CS125 - J5', 'The Unix Programming Environment', 'Book', NULL, 'Brian W. Kernighan; Rob Pike', 'available', NULL, 'Prentice-Hall, Inc.', 1986, NULL, '971-17-9003-3', ''),
('CS125 - J8', 'Distributed Systems', 'Book', NULL, 'Coullouris, G', 'available', '', 'Publishing Company', 1998, '', NULL, ''),
('CS127 - K25', 'Using Dbase III Plus', 'Book', NULL, 'Jones, E', 'available', '', 'ABC Publishing Houses', 2000, '', NULL, ''),
('CS127 - K29', 'SQL Step-by-Step', 'Book', NULL, 'Rolland, FD', 'available', '', 'Rockwell Publishing house', 2001, '', NULL, ''),
('CS127 - K31', 'Using Clipper', 'Book', NULL, 'Tiley, E', 'available', '', 'Publishing Company', 1998, '', NULL, ''),
('CS127 - K37', 'Fundamentals of Database Systems', 'Book', NULL, 'Elmasri; Navathe', 'available', '', 'Publishing Company', 1997, '', NULL, ''),
('CS127 - K39', 'Database Design', 'Book', NULL, 'Gio Wiederhold', 'available', NULL, 'Philippine Graphic Arts, Inc.', 1997, NULL, '971-08-1932-1', ''),
('CS127 - K7', 'Dbase III Advanced Programming', 'Book', NULL, 'Carrabis, J', 'available', '', 'Publishing Company', 1999, 'database', NULL, ''),
('CS129 - M3', 'Compiler Design', 'Book', NULL, 'Wilhelm, R; et al', 'available', '', 'Chris Publishing House', 2001, 'compiler', NULL, ''),
('CS129 - M7', 'Understanding and Writing Compilers', 'Book', NULL, 'Bornat, R', 'available', '', 'Publishing Company', 2001, '', NULL, ''),
('CS130 - N11', 'Digital Computer Design', 'Book', NULL, 'Kline, R', 'available', '', 'Publishing Company', 1999, 'digital computer', NULL, ''),
('CS130 - N12', 'Computer Engineering Hardware Design', 'Book', NULL, 'M.Morris Mano', 'available', NULL, 'Prentice-Hall, Inc.', 1986, NULL, '971-8636-10-2', ''),
('CS130 - N3', 'Digital Computer Fundamentals', 'Book', NULL, 'Bantee, TC', 'available', '', 'Publishing Company', 1996, 'digital computer', NULL, ''),
('CS130 - N4', 'Structured Computer Organization', 'Book', NULL, 'Tanenbaum', 'available', '', 'Publishing Company', 2000, '', NULL, ''),
('CS130 - N6', 'Digital Computer Electronics', 'Book', NULL, 'Malvino, AP', 'available', '', 'Publishing Company', 2000, '', NULL, ''),
('CS131 - O13', 'Turbo Assembler Reference Guide', 'Book', NULL, '', 'available', '', 'Rey Publishing Company', NULL, 'assembler', NULL, ''),
('CS131 - O4', 'VM Performance Management', 'Book', NULL, 'Eddolls, T', 'available', '', 'Kimi Neutron', 2003, '', NULL, ''),
('CS131 - O6', 'Programmer’s Problem Solver', 'Book', NULL, 'Jourdain, R', 'available', '', 'Chrisssy bave publishing company', 1999, 'rey', NULL, ''),
('CS132 - P1', 'Structured Computer Organization', 'Book', NULL, '', 'available', '', 'Rockwell Publishing Company', 1999, 'micro processor', NULL, ''),
('CS132 - P4', 'Computer Architecture and Organization', 'Book', NULL, 'Tanenbaum, AS', 'available', '', 'Publishing Company', 2001, 'computer', NULL, ''),
('CS137 - Q5', 'Data and Computer Communications', 'Book', NULL, 'Stallings, W', 'available', '', 'Publishing Company', 1991, 'computer', NULL, ''),
('CS137 - Q9', 'Connecting to the Internet', 'Book', NULL, 'Estrada, S', 'available', '', 'Ady Publishing House', 2000, 'internet', NULL, ''),
('CS141 - R5', 'Introduction to Computer Theory', 'Book', NULL, 'Cohen, D', 'available', '', 'Publishing Company', 1994, 'computer theory', NULL, ''),
('CS142 - S1', 'The Design of Well-Structured and Correct Programs', 'Book', NULL, 'Suad alagic; Michael A. Arbib', 'available', NULL, 'Springer-Verlag, New York Inc.', 1978, 'Program design', NULL, ''),
('CS142 - T11', 'Numerical Methods', 'Book', NULL, 'Bakh Vahou, NS', 'available', '', '', 2000, '', NULL, ''),
('CS142 - T17', 'Theory of Matrices', 'Book', NULL, '', 'available', '', '', NULL, '', NULL, ''),
('CS142 - T7', 'Elementary Linear Algebra', 'Book', NULL, 'Kolman, B', 'available', '', '', NULL, '', NULL, ''),
('CS161 - U4', 'Appendix to the Notes on Neuro-anatomy', 'Book', NULL, 'Mendoza, TJ', 'available', '', '', NULL, '', NULL, ''),
('CS170 - V1', 'Guide To Expert Systems', 'Book', NULL, 'Edmunds, RA', 'available', '', 'Publishing Company', 1999, '', NULL, ''),
('CS180 - W1', 'Highly Parallel Computing', 'Book', NULL, 'George S. Almasi; Allan Gottlieb', 'available', NULL, 'The Benjamin/Cummings Publishing Company, Inc', 1994, 'parallel computing', '805304436', ''),
('CS180 - W9', 'Highly-Parallel Computing', 'Book', NULL, 'Almasi, GS', 'available', '', 'Publishing Company', 1995, '', NULL, ''),
('CS2 - B1', 'Internet Companion', 'Book', NULL, 'Lasquey, T', 'available', '', 'Publishing Company', 1996, 'internet', NULL, ''),
('CS21 - D10', 'The “C” Odyssey DOS', 'Book', NULL, 'Gandhi, M', 'available', '', 'Publishing Company', 1995, 'Odyssey DOS', NULL, ''),
('CS21 - D13', 'C Unleashed', 'Book', NULL, 'SAMS', 'available', '', 'ABC Plublisher', 1995, 'C', NULL, ''),
('CS21 - D23', 'Turbo C Version 2.0', 'Book', NULL, 'M.Morris Mano', 'available', NULL, 'Pernick Printing Corporation', 1988, NULL, '971-8636-10-2', ''),
('CS21 - E3', 'Class Construction in C and C++', 'Book', NULL, 'Sessions, R', 'available', '', '', 2000, 'C', NULL, ''),
('CS21 - E6', 'Rescued by Java', 'Book', NULL, 'Kris Jamsa', 'available', '', 'Publishing Company', 1999, 'Java', NULL, ''),
('CS21 - E9', 'Design Patterns', 'Book', NULL, 'Grady Booch', 'available', '', 'Publishing Company', 2000, 'design patterns', NULL, ''),
('CS21 - F4', 'Discrete Mathematical Structures for CS', 'Book', NULL, 'Kolman, B', 'available', '', '', NULL, 'Discrete Mathematics', NULL, ''),
('CS56 - F1', 'Discrete Mathematics', 'Book', NULL, 'Johnsonbaugh, R.', 'available', '', 'Publishing Company', 2000, 'discrete mathematics', NULL, ''),
('IT 280', 'Computer Security Management', 'Book', NULL, 'Karen A. Forcht', 'available', NULL, 'boyd & fraser publishing company', 1994, 'Computer Security', '878358811', ''),
('IT7', 'E-Commerce for Dummies', 'Book', NULL, 'Don Jones; Mark D. Scott; Richard Villars', 'available', NULL, 'Hungry Minds Inc.', 2001, 'E-commerce', '764508474', ''),
('JN 0001', 'Proceedings of the APL96 Conference', 'Journal', NULL, 'The Special Interest Group for the APL Programming Language', 'available', NULL, 'ACM Press', 1996, NULL, NULL, ''),
('MG 0001', 'How to build a successful we-enabled warehouse and why you need one', 'Magazine', NULL, 'Julie Gibbs; Bob Craig; Aaron Zornes; Bradley Brown; Rhonda Stieber; Steve Bobrowski', 'available', NULL, 'Brown Printing Co.', 1997, NULL, '1065-3171', ''),
('MG 0002', 'Reinventing business Aplication Service Providers', 'Magazine', NULL, 'Leslie Steere; Jeff Spicer; Dave Clareke Mora; Carol Tady; Patricia Waddington', 'available', NULL, NULL, 2000, 'Oracle Corporation', NULL, ''),
('REF 34', 'Econometric Methods', 'Book', NULL, 'J. Johnston', 'available', NULL, 'McGraw-Hill Kogakusha, Ltd. Tokyo', 1972, 'econometrics', NULL, ''),
('REF 35', 'Macro-Evolutionary Dynamics', 'Book', NULL, 'Niles Eldredge', 'available', NULL, 'McGraw-Hill Publishing Company', 1989, 'macro-evolutionary dynamics', '70194742', ''),
('REF 40', 'Our Language Today', 'Book', NULL, 'David A. Conlin; George R. Herman; Jerome Martin', 'available', NULL, 'California State Department of Education Sacramento', 1966, 'english language', NULL, ''),
('REF 43', 'Mastering CorelDRAW5 Special Edition', 'Book', NULL, 'Rick Altman', 'available', NULL, 'Sybex Inc', 1994, 'CorelDRAW 5', '078211508', ''),
('REF 49', 'Quantitative Approaches to Management', 'Book', NULL, 'Richard I. levin; David S. Rubin; Joel P. Stinson; Everette S. Gardner, Jr.', 'available', NULL, 'McGraw-Hill Book Company', 1989, 'management', '971084556', ''),
('REF 50', 'The Technology Connection', 'Book', NULL, 'Marc S. Gerstein', 'available', NULL, 'Adison-Wesley Publishing Company, Inc.', 1987, 'organization development', '971085089', ''),
('REF 53', 'e-Business: Roadmap for Success', 'Book', NULL, 'Dr. Ravi Kalakota; Marcia Robinson', 'available', NULL, 'Addison-Wesley', 1999, 'e-commerce', '201604809', ''),
('REF37', 'The Oxford Companion to the English Language', 'Book', NULL, 'Tom McArthur', 'available', NULL, 'Oxfor University Press', 1992, 'English language', '019214183', ''),
('SP 0001', 'Fast Search of Nucleotide Local Alignment using Makiling Compute Grid', 'SP', 'Local Alignment is a method of determining similarity between nucleotides or protein sequences. It identifies regions of optimal matches and highly similar sequences. The study presents a local alignment in parallel setup using C language and the MPI library. The implementation compares nucleotide files using the Makiling Compute Grid cluster in PC Lab 9 of the ICS (Institute of Computer Science), University of the Philippines Los Baños.', 'Jan Jacob Glenn M. Jasalin; Arian J. Jacildo', 'available', NULL, 'Jan Jacob Glenn M. Jasalin and Arian J. Jacildo', 2011, 'local alignment, Makiling Compute Grid', NULL, ''),
('SP 0002', 'Photo-Realistic Interactive Cake Designer', 'SP', 'We present a cake designer application that allows users to design photo-realistic cake models. It provides a user interface with an interactive 3D designing environment and a functionality which allows the designs to be saved to and retrieved from the computer database. A survey of thirty respondents was conducted. Given a user manual and a basic tutorial, the respondents were asked to design their own cake. After designing, they were asked to rate the cake designer according to the following categories: User-Friendliness (the ease of learning and use), Interactivity (their ability to interact with cake elements such as layers), Responsiveness (how successful were the user commands and actions), Customizability (the capacity to produce unique and personalized designs), Photo-realism (the level of resemblance of the cake models to real cakes), Visual Impact (the ability of the graphics and visuals to command attention and hold interest), and Overall Usefulness (applicability to cake manufacturers or hobbyists in real life setting). Interactivity and Photo-realism got an average rating of 4 and 3.86 respectively (out of maximum of 5). The category that has the most varied ratings is Responsiveness with a standard deviation of 0.94. Based on the survey we concluded that 3D graphics and texture mapping are effective tools or developing interactive and photo-realistic design systems.', 'Andro I. Juni; Jaderick P. Pabico', 'available', NULL, 'Andro I. Juni; Jaderick P. Pabico', 2011, 'Texture Mapping, 3-Dimensional Graphics, 3D Modeling, Photo-realism', NULL, ''),
('SP 0003', 'Real Time Cash register Event Detection', 'SP', 'In this study, a system to implement a real time activity monitoring of a cash register in business establishment was developed. Edge detection, shape matching using contours, and Euclidean Distance based color analysis are integrated to detect the event where the cash register is being opened. Each time an event or a cash register activity happens, the system automatically creates a video clip of the said transaction. The system was able to identify the events where the cash register''s drawer is open.', 'Jenneth P. Jusay; Prof. Margarita Carmen S. Paterno', 'available', NULL, 'Jenneth P. Jusay and Prof. Margarita Carmen S. Paterno', 2011, 'event detection, video surveillance', NULL, ''),
('SP 0004', 'Visualization of Student Records Using FusionCharts', 'SP', 'Increasing demands of visualizing data have been arising as data is accumulated through the years. To see the unseen information behind colossal quantities of data, it must be converted into its graphical form, thus leading to a reliable data analysis. This study suggests the use of FusionChart, an open source component, in visualizing student records, specifically UPLB Student Records. Trends and patterns have been realized after running the program to generate common queries regarding performance of students, course effectiveness, and the like.', 'Jona Rae S. Obrador; Eleasah F. Loresco; Prof. Jamie M. Samaniego', 'available', NULL, 'Jona Rae S. Obrador, Eleasah F. Loresco and Prof. Jamie M. Samaniego', 2011, 'FusionCharts, Interactive Data Visualization, PHP, MySQL', NULL, ''),
('SP 0005', 'Face Structure Model for Actor-Driven Animation', 'SP', 'This study presents a way for animation which is performance based through tracking of colored markers applied on selected facial features on an actor. In tracking of facial features , control parameters will be computed and will be used to animate a model. Evaluation of specific controlled parameters will play an important role for exhibiting more details and accuracy in the animation of the facial features.', 'Freddie L. Oliva Jr.; Dr. Vladimir Y. Mariano', 'available', NULL, 'Freddie L. Oliva Jr. and Dr. Vladimir Y. Mariano', 2011, 'actor-driven, performance-based, color tracking', NULL, ''),
('TH 0001', 'UPLB Research Project Fund Monitoring System', 'Thesis', 'The UPLB Research Project Fund Monitoring System is an IT-based application project for the University of the Philippines Los Baños Accounting Office (UPLB-AO) which manages and controls the allotment and obligation of Trust Funds of the University. It provides a centralized database management system for all the users and controllers of the system for the purpose of managing the allotments and expenditures of the university’s research and extension project funds. Project fund leaders and their designated representatives are given access to view and monitor their allotment, expenses, and project fund balance. The UPLB-AO is given administrative access and privileges in order to maintain and support this site.', 'Petronila Pamela M. Alcasid', 'available', NULL, 'Petronila Pamela M. Alcasid', 2011, 'Accounting Office, Monitoring System', NULL, ''),
('TH 0002', 'An Open Source Lodging-Related Content-Managed Information System', 'Thesis', 'The IT-based project implements an open source online reservation, booking, billing and payment system for hotel or lodging-based establishments. The open source project is a content-managed template which can be implemented for establishments with lodging-related products and services such as room use, discounted rates and, training and ancillary facilities. The clients may view the site and may proceed with the reservation process online. Clients are placed into primal consideration in providing web-based views and differentiated levels of access to administrative users. The system makes use of open source development software in the design, development and implementation. The different tests conducted for the project indicated that client and administrative access to the system is designed to be compatible with major browsers -- be they open source or proprietary. The project testing also yielded coherence in data transaction, processing, storage, retrieval, print, custom reports, content management and security features.', 'Ramiro Z. dela Cruz', 'available', NULL, 'Ramiro Z. dela Cruz', 2009, 'Open source, Information System, Content-Managed', NULL, '');

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
('2010-47325', 'Feng', 'Fang', 'Chu'),
('2010-54795', 'Daniella', 'Roelfsema', 'Spoelder'),
('2011-11341', 'Charles', 'Farris', 'Harlan'),
('2011-11390', 'Enriqueta', 'Snowden', 'Hooker'),
('2011-13575', 'Harding', 'Brandagamba', 'Puddifoot'),
('2011-25010', 'Edzer Josh', 'Valentin', 'Padilla'),
('2011-61859', 'Otis', 'McCollum', 'Lucky'),
('2012-34510', 'Barbara', 'Marshal', 'Calle'),
('2012-56916', 'Sakiko', 'Asada', 'Kamuta'),
('2013-14344', 'Ryan', 'Emerson', 'Pruitt'),
('2013-33310', 'Richard', 'Kogan', 'Howle'),
('2013-53763', 'Daniel', 'Croll', 'Burch'),
('2014-51628', 'Liane', 'Pomerleau', 'Verreau');

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
('Andescols', 'd297ffbed9b00707ea96dfda7f27e9e043de978a7f414006c68d8c2d03686dc8', 'male', 'enabled', 'RichardKHowle@jourrapide.com', 'student', '', '2013-33310', 'Richard', 'Kogan', 'Howle', '09178345223', 'BSCS', 'CAS'),
('Areimis', '057391447ac04cb17a9509703e2cd25f7cfdfd0a77bad3e742d91ab0c4bf6364', 'female', 'pending', 'SusanDSinegal@dayrep.com', 'student', '', '2010-25011', 'Susan', 'Davis', 'Sinegal', '09224123954', 'BSCS', 'CAS'),
('Ceitheart', '5aa11eae614f058339a90c3f8c56b988c89f9fdd8b0f48a7534bc8e65b98018a', 'female', 'pending', 'UwaisahMawahibKouri@jourrapide.com', 'student', '', '2006-12908', 'Uwaisah', 'Mawahib', 'Kouri', '09161324873', 'BSCS', 'CAS'),
('Cionachis95', 'f33364b5566e2a7f95a9065c4cececc3647cf0ae0bb15784c6cf5b15cec89796', 'female', 'pending', 'SongWei@jourrapide.com', 'student', '', '2008-44165', 'Song', 'Tao', 'Wei', '09177563274', 'BSCS', 'CAS'),
('Comen1985', 'd6d3f7c00561f7c80983a53e7c63c0014b70c690d89f06059f249268a0de7892', 'male', 'pending', 'DerekDOchoa@rhyta.com', 'student', '', '2004-33412', 'Derek', 'Dickerson', 'Ochoa', '09164158223', 'BSCS', 'CAS'),
('Dreme1994', 'a21f249bc2f931eaffc5560776b21021f23beb4e16a0c04e0659a480b9d3fd0d', 'female', 'pending', 'FenChu@jourrapide.com', 'student', '', '2007-11543', 'Fen', 'Yuan', 'Chu', '09153473214', 'BSCS', 'CAS'),
('edzerium', 'd92cd287a3368252034e573413fceed68110c333f0d3cbf05de9d7261adb1800', 'male', 'pending', 'dzerium@gmail.com', 'student', '', '2011-25010', 'Edzer Josh', 'Valentin', 'Padilla', '09178624975', 'BSCS', 'CAS'),
('Fany1993', '08c5b60428e1b21935ee7e9f0f74dc27f261293d69f2107323845cc258ede322', 'male', 'pending', 'HenryBPetersen@armyspy.com', 'student', '', '2009-50411', 'Henry', 'Barker', 'Peterson', '09178624678', 'BSCS', 'CAS'),
('Gloseloth', '39b76abc143846e9ac78d30b2e4b68d91e0707a9b2389c444443482a1bb8445d', 'male', 'pending', 'DavidPKirtley@dayrep.com', 'student', '', '2010-25981', 'David', 'Pierre', 'Kirtley', '09151223598', 'BSCS', 'CAS'),
('Hene1964', 'aadb281fde04ff87d5980dc7cf83e01b4002499b90cd65d089aa9734b40fe33b', 'male', 'pending', 'CharlesFHarlan@teleworm.us', 'student', '', '2011-11341', 'Charles', 'Farris', 'Harlan', '09178234756', 'BSCS', 'CAS'),
('Indess', '0d172cd3aa19db5c7294012f82cb52dccaf77b1ea5efbc4c9ccef819755d4224', 'female', 'pending', 'SidneyRSutton@rhyta.com', 'student', '', '2010-10321', 'Sidney', 'Rudd', 'Sutton', '09178627778', 'BSCS', 'CAS'),
('Lifflosight', '46c83755f8bafb647087d852f2b2457486cf47ea07eeca867e3027a4c7655263', 'female', 'pending', 'CarolynBMorrison@rhyta.com', 'student', '', '2010-29981', 'Carolyn', 'Burnham', 'Morrison', '09187230076', 'BSCS', 'CAS'),
('Mathervenrat', '453f1596b651c6a54b9796ccbbbf9571410c8b5c0262ed3ec9e75a11eaf45b6c', 'female', 'pending', 'EnriquetaSHooker@jourrapide.com', 'student', '', '2011-11390', 'Enriqueta', 'Snowden', 'Hooker', '09180143276', 'BSCS', 'CAS'),
('Procke', '2217c752f8189db27e40da2c8050fb9771a13064bfc81d26847964968637f4dc', 'female', 'pending', 'BarbaraMCalle@armyspy.com', 'student', '', '2012-34510', 'Barbara', 'Marshal', 'Calle', '09178234123', 'BSCS', 'CAS'),
('Tharsen', '191b2f7e1ceb376efd1f7fc821cf3800a787cd4a936732b9906dc83c48dca375', 'male', 'enabled', 'JesseARoberts@armyspy.com', 'student', '', '2008-00180', 'Jesse', 'Anderson', 'Roberts', '09221899976', 'BSCS', 'CAS'),
('Thoureprot94', '66f8ab5bfc03c89923730bc69170d163ca1a27eaaf5f5a08f9ea362e9ebc4cbe', 'male', 'disabled', 'HardingPuddifoot@dayrep.com', 'student', '', '2011-13575', 'Harding', 'Brandagamba', 'Puddifoot', '09176497221', 'BSCS', 'CAS'),
('Trater93', '65a32eceb2b2e177b91918d8a30c1eb6cefa3ef4c1124f6f08358fe3c0f4b22b', 'male', 'enabled', 'RyanEPruitt@jourrapide.com', 'student', '', '2013-14344', 'Ryan', 'Emerson', 'Pruitt', '09180023476', 'BSCS', 'CAS'),
('Tury1993', '2fd0393979cc4cb14d3cc3de596eae0d893df160c3d820d26c49bcd24fa97bb0', 'female', 'pending', 'SakikoKamuta@jourrapide.com', 'student', '', '2012-56916', 'Sakiko', 'Asada', 'Kamuta', '09227869432', 'BSCS', 'CAS'),
('useruser', 'e172c5654dbc12d78ce1850a4f7956ba6e5a3d2ac40f0925fc6d691ebb54f6bf', 'male', 'enabled', 'user@user.user', 'student', '', '2004-33411', 'User', 'User', 'User', '639232143048', 'MVE', 'GS'),
('Waskeend96', '8d693d3498dc12a376a8aca5a93d286756dc0c4feffb979d4846be77b42885f5', 'female', 'pending', 'StephanieKuefer@teleworm.us', 'student', '', '2009-28943', 'Stephanie', 'Fisher', 'Kuefer', '09151784993', 'BSCS', 'CAS'),
('Whattis', '21397476e8d847594fcce9b824c9f7a6e7c58eca18b92f3c47b09c31dc25b5b8', 'male', 'pending', 'JordanLMancini@teleworm.us', 'student', '', '2010-10290', 'Jordan', 'Lincoln', 'Mancini', '09154573211', 'BSCS', 'CAS');

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
