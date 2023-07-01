-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2022 at 07:45 AM
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
-- Table structure for table `sch_location_list`
--

CREATE TABLE `sch_location_list` (
  `Location_Id` int(45) NOT NULL,
  `Location_short_name` varchar(255) NOT NULL,
  `Lat` double NOT NULL,
  `Lng` double NOT NULL,
  `circle_size` int(11) NOT NULL,
  `radius` float DEFAULT '500',
  `client_id` int(45) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedBy` int(11) NOT NULL,
  `UpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activecode` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sch_location_list`
--
ALTER TABLE `sch_location_list`
  ADD PRIMARY KEY (`Location_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sch_location_list`
--
ALTER TABLE `sch_location_list`
  MODIFY `Location_Id` int(45) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
