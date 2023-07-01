-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2022 at 07:43 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twings`
--

-- --------------------------------------------------------

--
-- Table structure for table `sch_student`
--

CREATE TABLE `sch_student` (
  `student_id` int(11) NOT NULL,
  `student_rollno` int(50) NOT NULL,
  `student_name` varchar(45) NOT NULL,
  `student_dob` varchar(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `section_id` varchar(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL,
  `class_id` varchar(11) NOT NULL,
  `student_createddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_createdby` varchar(11) NOT NULL,
  `student_updateddate` datetime DEFAULT NULL,
  `student_updatedby` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sch_student`
--
ALTER TABLE `sch_student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_rollno` (`student_rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sch_student`
--
ALTER TABLE `sch_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
