-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2022 at 07:44 AM
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
-- Table structure for table `sch_routeassigntbl`
--

CREATE TABLE `sch_routeassigntbl` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `shift_type` int(11) DEFAULT NULL,
  `vehicle_name` varchar(30) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `travel_startdate` date DEFAULT NULL,
  `travel_enddate` date DEFAULT NULL,
  `saturday_status` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sch_routeassigntbl`
--
ALTER TABLE `sch_routeassigntbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sch_routeassigntbl`
--
ALTER TABLE `sch_routeassigntbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
