-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 12:55 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hosteldatabase`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `alladmin` ()  SELECT * FROM admin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `allstudent` ()  NO SQL
SELECT * FROM students$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `food_order` ()  SELECT f.id,s.user_name,b.food as breakfast,l.food as lunch,sn.food AS snacks,d.food as dinner,f.date FROM students s,breakfast b,lunch l,snacks sn,dinner d,food_order f WHERE b.id=f.breakfastid AND l.id=f.lunchid AND sn.id=f.snacksid AND d.id=f.dinnerid AND s.id=f.studentid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `mail_id` varchar(500) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `designation` varchar(40) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin` the password is admin123
--


-- --------------------------------------------------------

--
-- Table structure for table `breakfast`
--

CREATE TABLE `breakfast` (
  `id` int(11) NOT NULL,
  `food` varchar(20) NOT NULL,
  `values` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breakfast`
--

-- --------------------------------------------------------

--
-- Table structure for table `dinner`
--

CREATE TABLE `dinner` (
  `id` int(11) NOT NULL,
  `food` varchar(20) NOT NULL,
  `values` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dinner`
--



-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `breakfastid` int(11) DEFAULT NULL,
  `lunchid` int(11) DEFAULT NULL,
  `snacksid` int(11) DEFAULT NULL,
  `dinnerid` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_order`
--



-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

CREATE TABLE `lunch` (
  `id` int(11) NOT NULL,
  `food` varchar(20) NOT NULL,
  `values` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lunch`
--



-- --------------------------------------------------------

--
-- Table structure for table `snacks`
--

CREATE TABLE `snacks` (
  `id` int(11) NOT NULL,
  `food` varchar(20) NOT NULL,
  `values` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `snacks`
--



-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(1) NOT NULL,
  `mail_id` varchar(500) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `usn` varchar(11) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `parent_name` varchar(30) NOT NULL,
  `parent_number` varchar(10) NOT NULL,
  `room_number` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date_of_signup` datetime NOT NULL,
  `profile_pic` varchar(500) NOT NULL,
  `date_of_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--



--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `DeleteLog` BEFORE DELETE ON `students` FOR EACH ROW INSERT INTO students_log VALUES(null,OLD.id,OLD.usn,'Deleted',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `InsertLog` AFTER INSERT ON `students` FOR EACH ROW INSERT INTO students_log VALUES(null,NEW.id,NEW.usn,'Inserted',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `students_log`
--

CREATE TABLE `students_log` (
  `id` int(11) NOT NULL,
  `student_id` int(30) NOT NULL,
  `usn` varchar(10) NOT NULL,
  `action` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_log`
--



-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `name_of_student` varchar(30) DEFAULT NULL,
  `usn` varchar(10) DEFAULT NULL,
  `parent_name` varchar(30) DEFAULT NULL,
  `phone_number` varchar(10) NOT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`,`mail_id`);

--
-- Indexes for table `breakfast`
--
ALTER TABLE `breakfast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dinner`
--
ALTER TABLE `dinner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentid` (`studentid`);

--
-- Indexes for table `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snacks`
--
ALTER TABLE `snacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`,`mail_id`);

--
-- Indexes for table `students_log`
--
ALTER TABLE `students_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `breakfast`
--
ALTER TABLE `breakfast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `dinner`
--
ALTER TABLE `dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901;

--
-- AUTO_INCREMENT for table `lunch`
--
ALTER TABLE `lunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `snacks`
--
ALTER TABLE `snacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students_log`
--
ALTER TABLE `students_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_order`
--
ALTER TABLE `food_order`
  ADD CONSTRAINT `food_order_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
