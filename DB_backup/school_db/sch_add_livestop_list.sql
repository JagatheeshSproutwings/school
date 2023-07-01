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
-- Table structure for table `sch_add_livestop_list`
--

CREATE TABLE `sch_add_livestop_list` (
  `live_stopid` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `live_routeid` int(11) DEFAULT NULL,
  `stop_geo_id` int(11) DEFAULT NULL,
  `stopplaned_entry` datetime DEFAULT NULL,
  `stopplaned_exit` datetime DEFAULT NULL,
  `stopentry_time` datetime DEFAULT NULL,
  `stopexit_time` datetime DEFAULT NULL,
  `stop_ept_time` datetime DEFAULT NULL,
  `travel_date` date NOT NULL,
  `create_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sch_add_livestop_list`
--
ALTER TABLE `sch_add_livestop_list`
  ADD PRIMARY KEY (`live_stopid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sch_add_livestop_list`
--
ALTER TABLE `sch_add_livestop_list`
  MODIFY `live_stopid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
