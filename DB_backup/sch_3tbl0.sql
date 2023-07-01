-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: twings_live
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sch_location_list`
--

DROP TABLE IF EXISTS `sch_location_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sch_location_list` (
  `Location_Id` int(45) NOT NULL AUTO_INCREMENT,
  `Location_short_name` varchar(255) NOT NULL,
  `Lat` double NOT NULL,
  `Lng` double NOT NULL,
  `circle_size` int(11) NOT NULL,
  `radius` float DEFAULT 500,
  `client_id` int(45) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedBy` int(11) NOT NULL,
  `UpdatedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activecode` int(45) NOT NULL,
  PRIMARY KEY (`Location_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sch_location_list`
--

LOCK TABLES `sch_location_list` WRITE;
/*!40000 ALTER TABLE `sch_location_list` DISABLE KEYS */;
INSERT INTO `sch_location_list` VALUES (1,'peelamedu',456.132654125,648.213648,0,2,371,NULL,NULL,470,'2022-05-19 14:43:46',0,'2022-05-19 12:43:46',1);
/*!40000 ALTER TABLE `sch_location_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sch_routeassigntbl`
--

DROP TABLE IF EXISTS `sch_routeassigntbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sch_routeassigntbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_name` varchar(30) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `travel_startdate` date DEFAULT NULL,
  `travel_enddate` date DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sch_routeassigntbl`
--

LOCK TABLES `sch_routeassigntbl` WRITE;
/*!40000 ALTER TABLE `sch_routeassigntbl` DISABLE KEYS */;
INSERT INTO `sch_routeassigntbl` VALUES (1,371,858,NULL,1,'2022-05-20','2022-05-21',470,NULL,NULL,'2022-05-20 09:25:57',NULL,470,NULL,NULL,'::1');
/*!40000 ALTER TABLE `sch_routeassigntbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sch_routestbl`
--

DROP TABLE IF EXISTS `sch_routestbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sch_routestbl` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `route_name` varchar(45) NOT NULL,
  `route_start_locationname` varchar(255) NOT NULL,
  `route_start_lat` double NOT NULL,
  `route_start_lng` double NOT NULL,
  `route_end_locationname` varchar(255) NOT NULL,
  `route_end_lat` double NOT NULL,
  `route_end_lng` double NOT NULL,
  `route_starttime` varchar(10) NOT NULL,
  `route_endtime` varchar(10) NOT NULL,
  `route_geo_start_id` int(11) NOT NULL,
  `route_geo_end_id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT 1,
  `ipaddress` varchar(30) DEFAULT NULL,
  `route_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sch_routestbl`
--

LOCK TABLES `sch_routestbl` WRITE;
/*!40000 ALTER TABLE `sch_routestbl` DISABLE KEYS */;
INSERT INTO `sch_routestbl` VALUES (1,371,'rte1','',0,0,'',0,0,'7:15 AM','5:15 PM',1,1,470,NULL,NULL,'2022-05-19 14:59:26',NULL,470,NULL,1,'::1',NULL);
/*!40000 ALTER TABLE `sch_routestbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'twings_live'
--
/*!50003 DROP PROCEDURE IF EXISTS `distance_from_odometer` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `distance_from_odometer`(IN `P_VEHICLE_ID` INT(12), IN `P_START_DATE` VARCHAR(25), IN `P_END_DATE` VARCHAR(25))
BEGIN
  
            SELECT ROUND(SUM(distance),2) as distance, date from(
SELECT date(fs.start_day) date,fs.start_odometer,fs.end_odometer,
 (fs.end_odometer-fs.start_odometer) AS distance FROM
  (
  SELECT ip.start_day,ip.end_odometer,ip.start_odometer FROM trip_report ip
      WHERE ip.device_no=P_VEHICLE_ID AND (ip.end_odometer - ip.start_odometer) >0  AND DATE(ip.start_day) BETWEEN P_START_DATE AND P_END_DATE AND ip.type_id='1'  ORDER BY STR_TO_DATE(ip.start_day, "%Y-%m-%d %H:%i:%s") ASC) fs ) pb2 group by date;
            
                  
  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `USP_GENERATE_DISTANCE_REPORT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `USP_GENERATE_DISTANCE_REPORT`(IN `P_VEHICLE_ID` INT(12), IN `P_START_DATE` VARCHAR(50), IN `P_END_DATE` VARCHAR(50), IN `P_START_LAT` VARCHAR(50), IN `P_START_LNG` INT(50))
BEGIN
  
            SELECT ROUND(SUM(distance),2) as distance, date from(
SELECT fs.id,fs.running_no,date(fs.modified_date) date,fs.odometer,(@lastodo + fs.odometer) AS lastodometer,
  @lastLatValue AS lastLatValue, @lastLanValue AS lastLanValue,
  IFNULL(find_distance(@lastLatValue,@lastLanValue,fs.lat,fs.lng),  0) AS distance,
  fs.lat,
  fs.lng,
  fs.speed,
  @lastSN := fs.running_no,
  @lastLatValue := fs.lat,
  @lastLanValue := fs.lng,
  @lastodo :=(@lastodo + fs.odometer) FROM
  (
  SELECT fs1.id,fs1.running_no,fs1.modified_date,fs1.distance_travelled odometer,fs1.lat_message lat,fs1.lon_message lng,fs1.speed FROM play_back_history fs1
      INNER JOIN vehicletbl v on fs1.running_no =v.deviceimei and v.vehicleid=P_VEHICLE_ID WHERE fs1.acc_status='1' AND ROUND(fs1.speed) != '0'   AND DATE(modified_date) BETWEEN P_START_DATE AND P_END_DATE  ORDER BY STR_TO_DATE(fs1.modified_date, "%Y-%m-%d %H:%i:%s") ASC) fs,
    (SELECT @lastSN:= 0,@lastLatValue:=P_START_LAT,@lastLanValue:= P_START_LNG,@lastodo:= 0) SQLVars
    ) pb2 group by date;
            
                  
  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-20 15:21:20
