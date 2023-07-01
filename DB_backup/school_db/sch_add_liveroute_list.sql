-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2022 at 07:46 AM
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
-- Table structure for table `sch_add_liveroute_list`
--

CREATE TABLE `sch_add_liveroute_list` (
  `live_routeid` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_name` varchar(30) DEFAULT NULL,
  `route_id` int(11) DEFAULT '0',
  `routename` varchar(30) DEFAULT NULL,
  `route_startid` int(11) DEFAULT NULL,
  `route_endid` int(11) DEFAULT NULL,
  `route_planstart_time` datetime DEFAULT NULL,
  `route_planend_time` datetime DEFAULT NULL,
  `route_exitime` datetime DEFAULT NULL,
  `routeend_exptime` datetime DEFAULT NULL,
  `route_entry_time` datetime DEFAULT NULL,
  `travel_date` date NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sch_add_liveroute_list`
--
ALTER TABLE `sch_add_liveroute_list`
  ADD PRIMARY KEY (`live_routeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sch_add_liveroute_list`
--
ALTER TABLE `sch_add_liveroute_list`
  MODIFY `live_routeid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
