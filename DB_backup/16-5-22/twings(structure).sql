-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2022 at 10:01 AM
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
-- Table structure for table `accesspriviledge`
--

CREATE TABLE `accesspriviledge` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_details` int(11) DEFAULT '1',
  `vehicle_service` int(11) DEFAULT '0',
  `device_details` int(11) DEFAULT '0',
  `driver_details` int(11) DEFAULT '0',
  `insurance_reminder` int(11) DEFAULT '0',
  `fuel` int(11) DEFAULT '0',
  `current_location` int(11) DEFAULT '0',
  `view_all_vehicles` int(11) DEFAULT '0',
  `location_history` int(11) DEFAULT '0',
  `trip` int(11) DEFAULT '0',
  `ibutton` int(11) DEFAULT '0',
  `over_speed_alert` int(11) DEFAULT '0',
  `sos_alert` int(11) DEFAULT '0',
  `low_battery_alert` int(11) DEFAULT '0',
  `ignition_alert` int(11) DEFAULT '0',
  `fuel_alert` int(11) DEFAULT '0',
  `ac_alert` int(11) DEFAULT '0',
  `driver_behavoir_alerts` int(11) DEFAULT '0',
  `geoFencing` int(11) DEFAULT '0',
  `logistics` int(11) DEFAULT '0',
  `trip_report` int(11) DEFAULT '1',
  `idle_report` int(11) DEFAULT '1',
  `parking_report` int(11) DEFAULT '1',
  `distance_report` int(11) DEFAULT '1',
  `over_spead_report` int(11) DEFAULT '0',
  `ac_report` int(11) DEFAULT '0',
  `alert_report` int(11) DEFAULT '0',
  `geo_report` int(11) DEFAULT '0',
  `hub_report` int(11) DEFAULT '0',
  `engine_rpm_report` int(11) DEFAULT '0',
  `fuel_refill_drain_report` int(11) DEFAULT '0',
  `millage_report` int(11) DEFAULT '0',
  `fuel_comparision_report` int(11) DEFAULT '0',
  `fuel_consumption_eng_rpm` int(11) DEFAULT '0',
  `bucket_report` int(11) DEFAULT '0',
  `drum_rotational_report` int(11) DEFAULT '0',
  `temperature_report` int(11) DEFAULT '0',
  `obd_report` int(11) DEFAULT '0',
  `accesspriviledge` int(11) DEFAULT '0',
  `SMS_notification` int(11) DEFAULT '0',
  `stocks` int(11) DEFAULT '0',
  `geofence` int(11) DEFAULT '0',
  `hubpoint` int(11) DEFAULT '0',
  `booking_trip` int(11) DEFAULT '0',
  `vehicle_management` int(11) DEFAULT '0',
  `status_check` int(11) DEFAULT '0',
  `ST_courier_route_report` int(11) DEFAULT '0',
  `zigma_route_report` int(11) DEFAULT '0',
  `vehicle_expense` int(11) DEFAULT '0',
  `polygon_report` int(11) DEFAULT '0',
  `hour_meter` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ac_report`
--

CREATE TABLE `ac_report` (
  `report_id` int(11) NOT NULL,
  `flag` int(11) DEFAULT NULL,
  `s_lat` double DEFAULT NULL,
  `s_lng` double DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `total_km` double DEFAULT NULL,
  `e_lat` double DEFAULT NULL,
  `e_lng` double DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `fuel_usage` varchar(45) DEFAULT NULL,
  `fuel_filled` varchar(45) DEFAULT NULL,
  `initial_ltr` varchar(45) DEFAULT NULL,
  `end_ltr` varchar(45) DEFAULT NULL,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double NOT NULL DEFAULT '0',
  `start_location` text,
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `add_liveroute_list`
--

CREATE TABLE `add_liveroute_list` (
  `live_routeid` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `add_livestop_list`
--

CREATE TABLE `add_livestop_list` (
  `live_stopid` int(11) NOT NULL,
  `live_routeid` int(11) DEFAULT NULL,
  `stop_geo_id` int(11) DEFAULT NULL,
  `stopplaned_entry` datetime DEFAULT NULL,
  `stopplaned_exit` datetime DEFAULT NULL,
  `stopentry_time` datetime DEFAULT NULL,
  `stopexit_time` datetime DEFAULT NULL,
  `stop_ept_time` datetime DEFAULT NULL,
  `travel_date` date NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alert_AIS`
--

CREATE TABLE `alert_AIS` (
  `id` int(11) NOT NULL,
  `header` varchar(255) DEFAULT NULL,
  `vendor_id` varchar(50) DEFAULT NULL,
  `software_version` varchar(10) DEFAULT NULL,
  `packet_type` varchar(10) DEFAULT NULL,
  `alert_id` int(11) DEFAULT NULL,
  `packet_status` varchar(10) DEFAULT NULL,
  `IMEI` varchar(255) DEFAULT NULL,
  `vehicle_reg_no` varchar(50) DEFAULT NULL,
  `GPS_fix` int(11) DEFAULT NULL,
  `packet_date` datetime DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `latitude_direction` varchar(10) DEFAULT NULL,
  `longtitude` varchar(20) DEFAULT NULL,
  `longtitude_direction` varchar(10) DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `heading` float DEFAULT NULL,
  `no_of_statellites` int(11) DEFAULT NULL,
  `altitude` float DEFAULT NULL,
  `pdop` varchar(100) DEFAULT NULL,
  `hdop` varchar(100) DEFAULT NULL,
  `operator_name` varchar(50) DEFAULT NULL,
  `ignition` int(11) DEFAULT NULL,
  `main_power_status` int(11) DEFAULT NULL,
  `main_input_voltage` float DEFAULT NULL,
  `internal_battery_voltage` float DEFAULT NULL,
  `emergency_status` int(11) DEFAULT NULL,
  `temper_alert` char(10) DEFAULT NULL,
  `GSM_strength` int(11) DEFAULT NULL,
  `MCC` int(11) DEFAULT NULL,
  `MNC` int(11) DEFAULT NULL,
  `LAC` varchar(50) DEFAULT NULL,
  `cell_ID` varchar(11) DEFAULT NULL,
  `digital_input_status` int(11) DEFAULT NULL,
  `digital_output_status` int(11) DEFAULT NULL,
  `anlog_input_1` float DEFAULT NULL,
  `anlog_input_2` float DEFAULT NULL,
  `frame_number` int(11) DEFAULT NULL,
  `odometer` decimal(11,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `alert_AIS`
--
DELIMITER $$
CREATE TRIGGER `AIS_alert_trigger` AFTER INSERT ON `alert_AIS` FOR EACH ROW BEGIN

    SELECT vehicleid,client_id,vehiclename INTO @v_id,@c_id,@v_name FROM vehicletbl WHERE deviceimei = NEW.IMEI LIMIT 1;
    IF @v_id is not null THEN
    IF (@v_id !='')
    THEN
    CASE    
            WHEN NEW.alert_id = '7' OR NEW.packet_type = 'IN' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,3,1,1,0);


            WHEN NEW.alert_id = '8' OR NEW.packet_type = 'IF' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,4,1,1,0);

            WHEN NEW.alert_id = '4' OR NEW.packet_type = 'BL' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,23,1,1,0);

            WHEN NEW.alert_id = '13' OR NEW.packet_type = 'HB' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,13,1,1,0);

            WHEN NEW.alert_id = '14' OR NEW.packet_type = 'HA' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,12,1,1,0);
            
            WHEN NEW.alert_id = '15' OR NEW.packet_type = 'RT' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,14,1,1,0);

            WHEN NEW.alert_id = '17' OR NEW.packet_type = 'OS' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,5,1,1,0);

            WHEN NEW.alert_id = '16' OR NEW.packet_type = 'WD' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,7,1,1,0);

            WHEN NEW.alert_id = '5' OR NEW.packet_type = 'BD' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,27,1,1,0);

            WHEN NEW.alert_id = '11' OR NEW.emergency_status='0' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,49,1,1,0);

            WHEN NEW.alert_id = '10' OR NEW.packet_type = 'EA' OR NEW.emergency_status='1' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,37,1,1,0);

            WHEN NEW.alert_id = '6' OR NEW.packet_type = 'BR' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,20,1,1,0);

            WHEN NEW.alert_id = '3' AND NEW.main_power_status = '0' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,22,1,1,0);

            WHEN NEW.packet_type = 'HP' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,46,1,1,0);

            WHEN NEW.alert_id = '9' OR NEW.packet_type = 'TA' OR NEW.temper_alert = '0' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,26,1,1,0);

            WHEN NEW.temper_alert = 'O' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,21,1,1,0);

            WHEN NEW.alert_id = '12' OR NEW.packet_type = 'OA' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,44,1,1,0);

            WHEN NEW.alert_id = '22' OR NEW.packet_type = 'TI' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,45,1,1,0);

            WHEN NEW.packet_type = 'FD' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,52,1,1,0);

            WHEN NEW.packet_type = 'BH' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,53,1,1,0);

            WHEN NEW.packet_type = 'DT' THEN

                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.latitude,NEW.longtitude,now(),@v_id,@c_id,54,1,1,0);
                     
            ELSE BEGIN END;

END CASE;

END IF;
END IF; 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alert_rp01`
--

CREATE TABLE `alert_rp01` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) DEFAULT NULL,
  `alert_type` varchar(20) DEFAULT NULL,
  `speed` varchar(20) DEFAULT NULL,
  `lat_message` varchar(150) DEFAULT NULL,
  `lon_message` varchar(150) DEFAULT NULL,
  `modified_date` varchar(150) DEFAULT NULL,
  `created_date` varchar(150) DEFAULT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `packettype` varchar(20) DEFAULT NULL,
  `zap` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `alert_rp01`
--
DELIMITER $$
CREATE TRIGGER `rp01_alert_trigger` AFTER INSERT ON `alert_rp01` FOR EACH ROW BEGIN

 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alert_stx`
--

CREATE TABLE `alert_stx` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) NOT NULL,
  `alert_type` varchar(20) NOT NULL,
  `speed` double NOT NULL,
  `lat_message` double NOT NULL,
  `lon_message` double NOT NULL,
  `modified_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `packettype` int(11) DEFAULT NULL,
  `zap` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `alert_stx`
--
DELIMITER $$
CREATE TRIGGER `add_sos_alert` AFTER INSERT ON `alert_stx` FOR EACH ROW BEGIN

    SELECT vehicleid,client_id,vehiclename INTO @v_id,@c_id,@v_name FROM vehicletbl WHERE deviceimei = NEW.running_no LIMIT 1;
    IF @v_id is not null THEN
    IF (@v_id !='')
    THEN
    CASE    
    WHEN NEW.alert_type = '1' THEN

        INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,7,1,1,0);
         INSERT INTO panic_hub_trip_solution(trip_start_time,trip_s_lat,trip_s_lng,vehicle_id,vehicle_name,speed,location_status)VALUES(now(),NEW.lat_message,NEW.lon_message,@v_id,@v_name,NEW.speed,'1');


				WHEN NEW.alert_type = '2' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,20,1,1,0);

				WHEN NEW.alert_type = '3' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,22,1,1,0);

				WHEN NEW.alert_type = '4' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,23,1,1,0);

				WHEN NEW.alert_type = '5' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,24,1,1,0);

				WHEN NEW.alert_type = '6' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,25,1,1,0);

				WHEN NEW.alert_type = 'V' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,26,1,1,0);

				WHEN NEW.alert_type = 'G' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,27,1,1,0);

				WHEN NEW.alert_type = 'W' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,21,1,1,0);


				WHEN NEW.alert_type = 'T' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,28,1,1,0);

				WHEN NEW.alert_type = 'U' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,29,1,1,0);

				WHEN NEW.alert_type = 'A' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,30,1,1,0);

				WHEN NEW.alert_type = 'B' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,31,1,1,0);

				WHEN NEW.alert_type = 'c' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,32,1,1,0);

				WHEN NEW.alert_type = 'd' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,33,1,1,0);

				WHEN NEW.alert_type = 'e' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,34,1,1,0);
				 
				WHEN NEW.alert_type = 'T-U' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,9,1,1,0);
						 
				WHEN NEW.alert_type = 'T-T' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,34,1,1,0);
						 
				WHEN NEW.alert_type = 'T-O' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,5,1,1,0);
						 
				WHEN NEW.alert_type = 'T-A' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,12,1,1,0);
						 
				WHEN NEW.alert_type = 'T-B' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,13,1,1,0);
						 
				WHEN NEW.alert_type = 'T-C' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,14,1,1,0);
						 
				WHEN NEW.alert_type = 'T-P' THEN

						 INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status,status)VALUES(NEW.lat_message,NEW.lon_message,now(),@v_id,@c_id,37,1,1,0);
					 
				ELSE BEGIN END;

END CASE;

END IF;
END IF; 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alert_type`
--

CREATE TABLE `alert_type` (
  `alert_type_id` int(11) NOT NULL,
  `alert_type` varchar(450) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `alter_contacts`
--

CREATE TABLE `alter_contacts` (
  `alter_contacts_id` int(11) NOT NULL,
  `activecode` varchar(45) DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `ac_on` varchar(255) DEFAULT NULL,
  `ac_off` varchar(255) DEFAULT NULL,
  `ignition_on` varchar(45) DEFAULT NULL,
  `ignition_off` varchar(45) DEFAULT NULL,
  `speed_alert` varchar(45) DEFAULT NULL,
  `route_deviation` varchar(45) DEFAULT NULL,
  `temperature_alert` varchar(45) DEFAULT NULL,
  `sos_alert` varchar(45) DEFAULT NULL,
  `geo_fence_in_circle` varchar(10) DEFAULT NULL,
  `geo_fence_out_circle` varchar(10) DEFAULT NULL,
  `harsh_acceleration` varchar(10) DEFAULT NULL,
  `harsh_braking` varchar(10) DEFAULT NULL,
  `harsh_cornering` varchar(10) DEFAULT NULL,
  `speed_breaker_bump` varchar(10) DEFAULT NULL,
  `accident` varchar(10) DEFAULT NULL,
  `fuel_dip` int(11) DEFAULT NULL,
  `fuel_fill` int(10) DEFAULT NULL,
  `idle` varchar(10) DEFAULT NULL,
  `power_off` varchar(10) NOT NULL DEFAULT '9',
  `ac_on_sms` varchar(45) DEFAULT NULL,
  `ac_off_sms` varchar(45) DEFAULT NULL,
  `ignition_on_sms` varchar(45) DEFAULT NULL,
  `ignition_off_sms` varchar(45) DEFAULT NULL,
  `speed_alert_sms` varchar(45) DEFAULT NULL,
  `route_deviation_sms` varchar(45) DEFAULT NULL,
  `temperature_alert_sms` varchar(45) DEFAULT NULL,
  `sos_alert_sms` varchar(45) DEFAULT NULL,
  `hub_in_circle` varchar(10) DEFAULT NULL,
  `hub_out_circle` varchar(10) DEFAULT NULL,
  `geo_fence_in_circle_sms` varchar(10) DEFAULT NULL,
  `geo_fence_out_circle_sms` varchar(10) DEFAULT NULL,
  `low_battery` varchar(45) DEFAULT NULL,
  `low_battery_sms` varchar(45) DEFAULT NULL,
  `harsh_acceleration_sms` varchar(10) DEFAULT NULL,
  `harsh_braking_sms` varchar(10) DEFAULT NULL,
  `harsh_cornering_sms` varchar(10) DEFAULT NULL,
  `speed_breaker_bump_sms` varchar(10) DEFAULT NULL,
  `accident_sms` varchar(10) DEFAULT NULL,
  `box_open_sms` varchar(10) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `owner_id` varchar(45) DEFAULT NULL,
  `fuel_discount` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `apikey`
--

CREATE TABLE `apikey` (
  `id` int(11) NOT NULL,
  `apikey` varchar(250) NOT NULL,
  `status` int(10) NOT NULL,
  `version` varchar(15) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assign_geo_fenceing`
--

CREATE TABLE `assign_geo_fenceing` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `geo_location_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `activecode` int(11) NOT NULL,
  `radius` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assign_hubpoint`
--

CREATE TABLE `assign_hubpoint` (
  `id` int(11) NOT NULL,
  `trip_location_id` varchar(10) NOT NULL,
  `vehicle_id` varchar(10) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `created_on` varchar(10) NOT NULL,
  `status` int(11) DEFAULT '1',
  `createdby` int(11) DEFAULT NULL,
  `ipaddress` varchar(45) DEFAULT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assign_ibuttontbl`
--

CREATE TABLE `assign_ibuttontbl` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `ibutton_no` varchar(20) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `assign_owner`
--

CREATE TABLE `assign_owner` (
  `assign_owner_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `createdon` varchar(45) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `updatedby` int(11) NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_polygon`
--

CREATE TABLE `assign_polygon` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `polygon_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `updatedon` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `battery_report`
--

CREATE TABLE `battery_report` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) NOT NULL,
  `car_battery` double NOT NULL,
  `device_battery` double NOT NULL,
  `created_on` date NOT NULL,
  `createdon_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookinglocation_list`
--

CREATE TABLE `bookinglocation_list` (
  `Location_Id` int(45) NOT NULL,
  `Location_short_name` varchar(255) DEFAULT NULL,
  `LocationName` varchar(255) DEFAULT NULL,
  `Lat` varchar(100) DEFAULT NULL,
  `Lng` varchar(100) DEFAULT NULL,
  `Client_Id` int(45) DEFAULT NULL,
  `CreatedBy` varchar(100) DEFAULT NULL,
  `CreatedOn` date DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedOn` date DEFAULT NULL,
  `activecode` int(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookingtrip`
--

CREATE TABLE `bookingtrip` (
  `trip_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pnr_no` varchar(25) DEFAULT NULL,
  `customer_id` varchar(10) DEFAULT NULL,
  `customer_name` varchar(45) DEFAULT NULL,
  `customer_mobile` varchar(20) DEFAULT NULL,
  `pickup_place` varchar(250) DEFAULT NULL,
  `pickup_lat` varchar(20) DEFAULT NULL,
  `pickup_lng` varchar(20) DEFAULT NULL,
  `drop_place` varchar(250) DEFAULT NULL,
  `drop_lat` varchar(20) DEFAULT NULL,
  `drop_lng` varchar(20) DEFAULT NULL,
  `alter_drop_loc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `alter_drop_loc_lat` varchar(25) DEFAULT NULL,
  `alter_drop_loc_lng` varchar(25) DEFAULT NULL,
  `drop_cordinate` varchar(250) DEFAULT NULL,
  `pickup_datetime` datetime DEFAULT NULL,
  `drop_datetime` datetime DEFAULT NULL,
  `pickup_time` varchar(20) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `city_limit` int(11) DEFAULT NULL,
  `is_package` int(11) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `approx_time` varchar(10) DEFAULT NULL,
  `approx_distance` varchar(10) DEFAULT NULL,
  `approx_fare` varchar(10) DEFAULT NULL,
  `is_agent` varchar(10) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `booking_rejected_reason` varchar(25) DEFAULT NULL,
  `booking_rejected_description` varchar(25) DEFAULT NULL,
  `booking_rejected_reason_type` varchar(25) DEFAULT NULL,
  `vehicle_imei` varchar(100) DEFAULT NULL,
  `vehicle_name` varchar(255) DEFAULT NULL,
  `driver_id` varchar(10) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `assigned_date` datetime DEFAULT NULL,
  `accepted_date` datetime DEFAULT NULL,
  `trip_start_datetime` datetime DEFAULT NULL,
  `trip_start_driver` varchar(50) DEFAULT NULL,
  `trip_start_driverid` varchar(25) DEFAULT NULL,
  `trip_end_datetime` datetime DEFAULT NULL,
  `trip_end_driver` varchar(50) DEFAULT NULL,
  `trip_end_driverid` varchar(25) DEFAULT NULL,
  `start_km` varchar(50) DEFAULT '0',
  `EndKm` double DEFAULT NULL,
  `trip_distance` varchar(25) DEFAULT NULL,
  `trip_amount` varchar(25) DEFAULT NULL,
  `trip_waiting_time` varchar(25) DEFAULT NULL,
  `assign_count` int(11) DEFAULT NULL,
  `trip_status` varchar(10) DEFAULT NULL,
  `rejected_date` datetime DEFAULT NULL,
  `package` varchar(50) DEFAULT NULL,
  `trip_start_time` timestamp NULL DEFAULT NULL,
  `Is_Ac` int(11) DEFAULT NULL,
  `last_trip_time` timestamp NULL DEFAULT NULL,
  `trip_end_time` timestamp NULL DEFAULT NULL,
  `trip_type` bigint(20) DEFAULT NULL,
  `collect_fare` bigint(20) DEFAULT NULL,
  `IsRound` int(11) DEFAULT '0',
  `total_trip_time` timestamp NULL DEFAULT NULL,
  `assigned_by` varchar(30) DEFAULT NULL,
  `assigned_on` timestamp NULL DEFAULT NULL,
  `booking_rejected_by` varchar(40) DEFAULT NULL,
  `Waiting_fare` varchar(150) DEFAULT NULL,
  `trip_start_driver_mobile` varchar(20) DEFAULT NULL,
  `trip_end_driver_mobile` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookingtrip_livedetails`
--

CREATE TABLE `bookingtrip_livedetails` (
  `id` int(11) NOT NULL,
  `vehicle_imei` bigint(20) DEFAULT NULL,
  `current_datetime` datetime DEFAULT NULL,
  `logged_datetime` datetime DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `switch_status` int(11) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `packetype` int(11) DEFAULT NULL,
  `zap` longtext,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude_direction` varchar(25) DEFAULT NULL,
  `longitude_direction` varchar(25) DEFAULT NULL,
  `location_address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `bookingtrip_livedetails`
--
DELIMITER $$
CREATE TRIGGER `switch_trigger` AFTER INSERT ON `bookingtrip_livedetails` FOR EACH ROW BEGIN

DECLARE l_flag varchar(20);

DECLARE h_flag varchar(20);


 SELECT vehicleid,odometer,driver_ibutton,driver_name INTO @v_id,@odometer,@driver_ibutton,@driver_name FROM vehicletbl WHERE deviceimei = NEW.vehicle_imei ORDER BY vehicleid DESC LIMIT 1;

IF NEW.packetype != '1' THEN

SELECT flag INTO @flag FROM bookingtrip_report WHERE device_no = NEW.vehicle_imei AND flag='1' AND type_id='1' ORDER BY report_id DESC LIMIT 1;


SELECT trip_id INTO @trip_id FROM bookingtrip WHERE vehicle_imei = NEW.vehicle_imei AND trip_status='1' ORDER BY trip_id DESC LIMIT 1;

SET l_flag = @flag;
 
	IF NEW.switch_status = '1'  THEN

		IF (@trip_id IS NOT NULL) && @trip_id != '' THEN

			UPDATE
			  bookingtrip
			SET
			  trip_status=2,
			  trip_start_datetime=NEW.logged_datetime,
			  start_km=@odometer,
			  trip_start_driverid=@driver_ibutton,
			  trip_start_driver=@driver_name
			WHERE
			  vehicle_imei = NEW.vehicle_imei AND trip_status = '1';
			
			INSERT
				INTO
				  bookingtrip_report(
				    flag,
				    s_lat,
				    s_lng,
				    start_day,
				    device_no,
				    vehicle_id,
				    type_id,
				    start_odometer,
				    ibutton_no,
				    driver_name
				  )
				VALUES(
				  '1',
				  NEW.latitude,
				  NEW.longitude,
				  NEW.logged_datetime,
				  NEW.vehicle_imei,
				  @v_id,
				  '1',
				  @odometer,
				  @driver_ibutton,
				  @driver_name
				);

				ELSE


				IF (@flag = '2' || l_flag = '' || l_flag IS NULL) THEN
					INSERT INTO
					  bookingtrip_report(
					    flag,
					    s_lat,
					    s_lng,
					    start_day,
					    device_no,
					    vehicle_id,
					    type_id,
					    start_odometer,
					    unplanned_trip,
					    ibutton_no,
					    driver_name
					  )
					VALUES(
					  '1',
					  NEW.latitude,
					  NEW.longitude,
					  NEW.logged_datetime,
					  NEW.vehicle_imei,
					  @v_id,
					  '1',
					  @odometer,
					  '1',
					  @driver_ibutton,
					  @driver_name
					);

					END IF;

			END IF;

	END IF;

	IF NEW.switch_status = '0' THEN

		SELECT start_odometer INTO @start_odometer FROM bookingtrip_report WHERE device_no = NEW.vehicle_imei AND flag='1' AND type_id='1' ORDER BY report_id DESC LIMIT 1;

		SELECT trip_id,start_km INTO @trip_id,@start_km FROM bookingtrip WHERE vehicle_imei = NEW.vehicle_imei AND trip_status='2' ORDER BY trip_id DESC LIMIT 1;

		IF (@trip_id IS NOT NULL) && @trip_id != '' THEN

			UPDATE
			  bookingtrip
			SET
			  trip_status=3,
			  trip_end_datetime=NEW.logged_datetime,
			  EndKm=@odometer,
			  trip_distance=(@odometer-@start_km),
			  trip_end_driverid=@driver_ibutton,
			  trip_end_driver=@driver_name
			WHERE
			  vehicle_imei = NEW.vehicle_imei AND trip_status = '2';

			UPDATE
			  bookingtrip_report
			SET
			  flag = '2',
			  end_day = NEW.logged_datetime,
			  e_lat = NEW.latitude,
			  e_lng = NEW.longitude,
			  end_odometer=@odometer,
			  trip_km=(@odometer-@start_odometer),
			  ibutton_no=@driver_ibutton,
			  driver_name=@driver_name
			WHERE
			  device_no = NEW.vehicle_imei AND flag = '1';

		ELSE
			

				UPDATE
				  bookingtrip_report
				SET
				  flag = '2',
				  end_day = NEW.logged_datetime,
				  e_lat = NEW.latitude,
				  e_lng = NEW.longitude,
				  end_odometer=@odometer,
				  trip_km=(@odometer-@start_odometer),
				  ibutton_no=@driver_ibutton,
			  	  driver_name=@driver_name
				WHERE
				  device_no = NEW.vehicle_imei AND flag = '1';

		END IF;

	END IF;

END IF;

IF NEW.packetype = '1' THEN

SELECT flag INTO @flag FROM bookingtrip_report WHERE device_no = NEW.vehicle_imei AND flag='3' AND type_id='3' ORDER BY report_id DESC LIMIT 1;

 SET h_flag = @flag;

	IF NEW.switch_status = '1' AND  (h_flag = '4' || h_flag = '' || h_flag IS NULL) THEN

		INSERT
			INTO
			  bookingtrip_report(
			    flag,
			    s_lat,
			    s_lng,
			    start_day,
			    device_no,
			    vehicle_id,
			    type_id,
			    start_odometer,
				    ibutton_no,
				    driver_name
			  )
			VALUES(
			  '3',
			  NEW.latitude,
			  NEW.longitude,
			  NEW.logged_datetime,
			  NEW.vehicle_imei,
			  @v_id,
			  '3',
			 NEW.odometer,
			@driver_ibutton,
			@driver_name
			);

	END IF;

	IF NEW.switch_status = '0' THEN

	SELECT start_odometer INTO @start_odometer FROM bookingtrip_report WHERE device_no = NEW.vehicle_imei AND flag='3' AND type_id='3' ORDER BY report_id DESC LIMIT 1;

		UPDATE
		  bookingtrip_report
		SET
		  flag = '4',
		  end_day = NEW.logged_datetime,
		  e_lat = NEW.latitude,
		  e_lng = NEW.longitude,
		  end_odometer=NEW.odometer,
		  trip_km=(@odometer-@start_odometer),
		  ibutton_no=@driver_ibutton,
			  driver_name=@driver_name
		WHERE
		  device_no = NEW.vehicle_imei AND flag = '3';

	END IF;

END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bookingtrip_report`
--

CREATE TABLE `bookingtrip_report` (
  `report_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `flag` int(11) NOT NULL,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double DEFAULT NULL,
  `trip_km` double DEFAULT NULL,
  `ibutton_no` varchar(50) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `update_status` int(11) DEFAULT '0',
  `unplanned_trip` int(11) DEFAULT NULL,
  `start_location` varchar(255) DEFAULT NULL,
  `end_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `booking_supplier`
--

CREATE TABLE `booking_supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_mobile` varchar(50) DEFAULT NULL,
  `supplier_email` varchar(50) DEFAULT NULL,
  `supplier_address` text,
  `client_id` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `check_polygonlist`
--

CREATE TABLE `check_polygonlist` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vehicle_imei` bigint(20) DEFAULT NULL,
  `polygon_id` int(11) DEFAULT NULL,
  `polygon_name` varchar(70) DEFAULT NULL,
  `vehicle_name` varchar(70) DEFAULT NULL,
  `in_datetime` datetime DEFAULT NULL,
  `out_datetime` datetime DEFAULT NULL,
  `s_lat` double DEFAULT NULL,
  `s_lng` double DEFAULT NULL,
  `e_lat` double DEFAULT NULL,
  `e_lng` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `createdby` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clienttbl`
--

CREATE TABLE `clienttbl` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(50) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `alter_mobile` bigint(20) DEFAULT NULL,
  `logo_path` varchar(450) DEFAULT NULL,
  `client_limit` int(11) DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(10) DEFAULT '1',
  `role_id` int(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `sms_title` varchar(45) DEFAULT 'TWINGS',
  `sms_url` varchar(1000) DEFAULT NULL,
  `sms_username` varchar(45) DEFAULT NULL,
  `sms_password` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `vehicle_access` int(11) NOT NULL,
  `sms_access` int(11) NOT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `fuel_email` int(11) NOT NULL,
  `route_deviation` int(11) NOT NULL,
  `personal_track` int(11) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `pincode` int(10) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_ac_report`
--

CREATE TABLE `consolidate_ac_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `distance_km` double DEFAULT NULL,
  `running_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `trip_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_distance_report`
--

CREATE TABLE `consolidate_distance_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` bigint(20) DEFAULT NULL,
  `vehicle_register_number` varchar(40) DEFAULT NULL,
  `start_odometer` double NOT NULL,
  `end_odometer` double NOT NULL,
  `date` date DEFAULT NULL,
  `distance_km` double DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_fuelcosumed_report`
--

CREATE TABLE `consolidate_fuelcosumed_report` (
  `id` int(11) NOT NULL,
  `vehicleid` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fuel_consumed_litre` double DEFAULT NULL,
  `fuel_millege` double DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_fueldip_report`
--

CREATE TABLE `consolidate_fueldip_report` (
  `id` int(11) NOT NULL,
  `vehicleid` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fuel_dip_litre` double DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_fuelfill_report`
--

CREATE TABLE `consolidate_fuelfill_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` int(11) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fuel_fill_litre` double DEFAULT NULL,
  `start_fuel` double NOT NULL,
  `end_fuel` double NOT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_idle_report`
--

CREATE TABLE `consolidate_idle_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `idel_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_ign_report`
--

CREATE TABLE `consolidate_ign_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `distance_km` double DEFAULT NULL,
  `moving_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `trip_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_loadrpm_report`
--

CREATE TABLE `consolidate_loadrpm_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `rpm_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_normalrpm_report`
--

CREATE TABLE `consolidate_normalrpm_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `rpm_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_overloadrpm_report`
--

CREATE TABLE `consolidate_overloadrpm_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `rpm_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_park_report`
--

CREATE TABLE `consolidate_park_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` bigint(20) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `parking_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_rpm_report`
--

CREATE TABLE `consolidate_rpm_report` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vehicle_name` varchar(100) DEFAULT NULL,
  `deviceimei` bigint(20) DEFAULT NULL,
  `milege` double DEFAULT NULL,
  `normal_rpm` varchar(100) DEFAULT NULL,
  `under_load` varchar(100) DEFAULT NULL,
  `idle_rpm` varchar(100) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_complaint`
--

CREATE TABLE `customer_complaint` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `vehicleid` varchar(45) DEFAULT NULL,
  `mobilenumber` varchar(45) DEFAULT NULL,
  `subjects` varchar(450) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `ticketid` varchar(450) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `msgread` int(11) DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `db_stx`
--

CREATE TABLE `db_stx` (
  `id` bigint(11) NOT NULL,
  `running_no` bigint(20) NOT NULL,
  `Acceleration_Event` int(11) NOT NULL,
  `Threshold_Value` int(11) NOT NULL,
  `Peak_Value` double NOT NULL,
  `Duration_Over_Threshold` varchar(20) NOT NULL,
  `ignition` smallint(6) NOT NULL,
  `vms` varchar(20) NOT NULL,
  `speed` double NOT NULL,
  `lat_message` double NOT NULL,
  `lon_message` double NOT NULL,
  `modified_date` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keyword` varchar(30) NOT NULL,
  `packettype` smallint(6) NOT NULL,
  `zap` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealertbl`
--

CREATE TABLE `dealertbl` (
  `dealer_id` int(11) NOT NULL,
  `dealer_company` varchar(255) DEFAULT NULL,
  `dealer_name` varchar(255) DEFAULT NULL,
  `dealer_email` varchar(255) DEFAULT NULL,
  `dealer_mobile` varchar(20) DEFAULT NULL,
  `dealer_address` longtext,
  `dealer_logo` text,
  `dealer_limit` int(11) DEFAULT NULL,
  `dealer_color` varchar(50) DEFAULT NULL,
  `dealer_subdomain` varchar(255) DEFAULT NULL,
  `dealer_city` varchar(30) DEFAULT NULL,
  `dealer_state` varchar(30) DEFAULT NULL,
  `dealer_country` varchar(30) DEFAULT NULL,
  `dealer_pincode` int(10) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_price_list`
--

CREATE TABLE `dealer_price_list` (
  `list_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `device_type` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `createdby` int(11) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int(11) NOT NULL,
  `updatedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_tokens`
--

CREATE TABLE `dealer_tokens` (
  `token_id` int(11) NOT NULL,
  `dealer_price_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `dealer_token` int(11) NOT NULL,
  `token_status` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `createdby` int(11) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedby` int(11) NOT NULL,
  `updatedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `devicemodeltbl`
--

CREATE TABLE `devicemodeltbl` (
  `model_id` int(6) NOT NULL,
  `devicemodel` varchar(30) DEFAULT NULL,
  `type` int(6) DEFAULT NULL,
  `devicecost` varchar(10) DEFAULT NULL,
  `renewalcost` varchar(10) DEFAULT NULL,
  `devicefeatures` text,
  `deviceimages` varchar(25) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `devicetbl`
--

CREATE TABLE `devicetbl` (
  `device_id` int(11) NOT NULL,
  `device_model` varchar(30) NOT NULL,
  `deviceimei` varchar(30) NOT NULL,
  `device_categary` int(11) NOT NULL,
  `sensor_name` varchar(20) NOT NULL,
  `created_time` datetime NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `device_model`
--

CREATE TABLE `device_model` (
  `d_id` int(11) NOT NULL,
  `device_name` varchar(45) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discounttbl`
--

CREATE TABLE `discounttbl` (
  `discountid` int(11) NOT NULL,
  `discounttype` varchar(15) DEFAULT NULL,
  `discount` int(6) DEFAULT NULL,
  `clientid` int(6) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drivertbl`
--

CREATE TABLE `drivertbl` (
  `driverid` int(6) NOT NULL,
  `clientid` int(6) DEFAULT NULL,
  `groupid` int(6) DEFAULT NULL,
  `drivername` varchar(20) DEFAULT NULL,
  `drivertype` varchar(15) DEFAULT NULL,
  `ibutton` varchar(15) DEFAULT NULL,
  `address` text,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `mobilenumber` int(10) DEFAULT NULL,
  `alternatenumber` int(10) DEFAULT NULL,
  `experience` smallint(6) DEFAULT NULL,
  `licenseno` int(6) DEFAULT NULL,
  `licensetype` varchar(15) DEFAULT NULL,
  `licenseexpiredate` date DEFAULT NULL,
  `contractnumber` int(10) DEFAULT NULL,
  `dateofjoining` date DEFAULT NULL,
  `driverphoto` varchar(50) DEFAULT NULL,
  `documents` varchar(100) DEFAULT NULL,
  `employeeid` varchar(20) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_salary` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enginerpm_status`
--

CREATE TABLE `enginerpm_status` (
  `id` int(11) NOT NULL,
  `ignition` int(11) DEFAULT NULL,
  `speed` double NOT NULL DEFAULT '0',
  `ac_status` smallint(6) DEFAULT NULL,
  `battery_voltage` double DEFAULT NULL,
  `frequency` varchar(50) DEFAULT NULL,
  `enginerpm` varchar(50) DEFAULT NULL,
  `lattitute` double DEFAULT NULL,
  `longitute` double DEFAULT NULL,
  `modified_date` datetime NOT NULL,
  `packettype` smallint(6) DEFAULT NULL,
  `create_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `engine_rpms`
--

CREATE TABLE `engine_rpms` (
  `id` int(11) NOT NULL,
  `deviceimei` bigint(20) NOT NULL,
  `value` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `engine_rpms`
--
DELIMITER $$
CREATE TRIGGER `rpm_reports` AFTER INSERT ON `engine_rpms` FOR EACH ROW BEGIN
   
 SELECT
  idle_rpm,
  max_rpm,
  rpm_status,
  vehicleid,
  client_id,
  deviceimei,
  status
INTO
  @idle_rpm,
  @max_rpm,
  @rpm_status,
  @vehicleid,
  @client_id,
  @deviceimei,
  @status
FROM
  vehicletbl
WHERE
  deviceimei = NEW.deviceimei
ORDER BY
  vehicleid DESC
LIMIT 1; 

IF(
    (
      @rpm_status = 1 OR @rpm_status = 0 OR @rpm_status IS NULL
    ) AND (NEW.value >= 1 && NEW.value < @idle_rpm)
  ) THEN


          UPDATE
          vehicletbl
          SET
          rpm_status = 2
          WHERE
          deviceimei = NEW.deviceimei;


         INSERT
         INTO
          normal_rpm_report(
            flag,
            start_day,
            device_no,
            vehicle_id,
            client_id
          )
         VALUES(
          '1',
          NEW.modified_date,
          NEW.deviceimei,
          @vehicleid,
          @client_id
        );

ELSEIF(
    (
      @rpm_status = 1 OR @rpm_status = 0 OR @rpm_status IS NULL
    ) AND (NEW.value >= @idle_rpm  && NEW.value < @max_rpm)
  ) THEN


          UPDATE
          vehicletbl
          SET
          rpm_status = 3
          WHERE
          deviceimei = NEW.deviceimei;


        INSERT
         INTO
          load_rpm_report(
            flag,
            start_day,
            device_no,
            vehicle_id,
            client_id
          )
        VALUES(
          '1',
          NEW.modified_date,
          NEW.deviceimei,
          @vehicleid,
          @client_id
        );


 END IF;
 
IF(
    (
      @rpm_status = 2
    ) AND (NEW.value >= @idle_rpm  && NEW.value < @max_rpm)
  ) THEN

          UPDATE
          vehicletbl
          SET
          rpm_status = 3
          WHERE
          deviceimei = NEW.deviceimei;


          UPDATE
          normal_rpm_report
          SET
          flag = '2',
          end_day = NEW.modified_date
          WHERE
          device_no = NEW.deviceimei AND flag = '1';

         INSERT
         INTO
          load_rpm_report(
            flag,
            start_day,
            device_no,
            vehicle_id,
            client_id
          )
        VALUES(
          '1',
          NEW.modified_date,
          NEW.deviceimei,
          @vehicleid,
          @client_id
        );
        
  ELSEIF @rpm_status = 2 AND NEW.value = 0 THEN

          UPDATE
          vehicletbl
          SET
          rpm_status = 1
          WHERE
          deviceimei = NEW.deviceimei;

          UPDATE
          normal_rpm_report
          SET
          flag = '2',
          end_day = NEW.modified_date
          WHERE
          device_no = NEW.deviceimei AND flag = '1';
        
 END IF;
 
 
 IF(
    (
      @rpm_status = 3
    ) AND (NEW.value > @max_rpm)
  ) THEN

          UPDATE
          vehicletbl
          SET
          rpm_status = 4
          WHERE
          deviceimei = NEW.deviceimei;

         UPDATE
         load_rpm_report
         SET
         flag = '2',
         end_day = NEW.modified_date
         WHERE
          device_no = NEW.deviceimei AND flag = '1';


        INSERT
        INTO
        overload_rpm_report(
            flag,
            start_day,
            device_no,
            vehicle_id,
            client_id
          )
        VALUES(
          '1',
          NEW.modified_date,
          NEW.deviceimei,
          @vehicleid,
          @client_id
        );

     ELSEIF (
    (
      @rpm_status = 3
    ) AND (NEW.value >= 1 && NEW.value < @idle_rpm)
  ) THEN

        UPDATE
        vehicletbl
        SET
        rpm_status = 2
        WHERE
        deviceimei = NEW.deviceimei;


        UPDATE
        load_rpm_report
        SET
        flag = '2',
        end_day = NEW.modified_date
        WHERE
        device_no = NEW.deviceimei AND flag = '1';

       INSERT
       INTO
       normal_rpm_report(
        flag,
        start_day,
        device_no,
        vehicle_id,
        client_id,
        rpm_status
      )
      VALUES(
      '1',
      NEW.modified_date,
      NEW.deviceimei,
      @vehicleid,
      @client_id,
      @rpm_flag
    );

    ELSEIF (
    (
      @rpm_status = 3
    ) AND (NEW.value = 0)
  ) THEN

        UPDATE
        vehicletbl
        SET
        rpm_status = 1
        WHERE
        deviceimei = NEW.deviceimei;


        UPDATE
        load_rpm_report
        SET
        flag = '2',
        end_day = NEW.modified_date
        WHERE
        device_no = NEW.deviceimei AND flag = '1';

  END IF;

 IF(
    (
      @rpm_status = 4
    ) AND (NEW.value >= @idle_rpm  && NEW.value < @max_rpm)
  ) THEN

     UPDATE
     vehicletbl
     SET
     rpm_status = 3
     WHERE
     deviceimei = NEW.deviceimei;


    UPDATE
    overload_rpm_report
    SET
    flag = '2',
    end_day = NEW.modified_date
    WHERE
    device_no = NEW.deviceimei AND flag = '1';

    INSERT
    INTO
   load_rpm_report(
    flag,
    start_day,
    device_no,
    vehicle_id,
    client_id
  )
 VALUES(
  '1',
  NEW.modified_date,
  NEW.deviceimei,
  @vehicleid,
  @client_id
);


END IF;

IF(
    (
      @rpm_status = 4
    ) AND (NEW.value = 0)
  ) THEN

   UPDATE
        vehicletbl
        SET
        rpm_status = 1
        WHERE
        deviceimei = NEW.deviceimei;


        UPDATE
        overload_rpm_report
        SET
        flag = '2',
        end_day = NEW.modified_date
        WHERE
        device_no = NEW.deviceimei AND flag = '1';

 
  END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `executive_report_chk`
--

CREATE TABLE `executive_report_chk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `mileagekm` int(11) DEFAULT '1',
  `startodometer` int(11) DEFAULT '1',
  `endodometer` int(11) DEFAULT '1',
  `startenginehrmeter` int(11) DEFAULT '1',
  `endenginehrmeter` int(11) DEFAULT '1',
  `overspeedmileagekm` int(11) DEFAULT '1',
  `avgspeedrunning` int(11) DEFAULT '1',
  `maxspeedkm` int(11) DEFAULT '1',
  `runningtime` int(11) DEFAULT '1',
  `runningtime_percentagerpt` int(11) DEFAULT '1',
  `idletime_hhmmss` int(11) DEFAULT '1',
  `idletime_percentagerpt` int(11) DEFAULT '1',
  `parkingtime_hhmmss` int(11) DEFAULT '1',
  `parkingtime_percentage` int(11) DEFAULT '1',
  `actime_hhmmss` int(11) NOT NULL DEFAULT '0',
  `actime_percentage` int(11) NOT NULL DEFAULT '0',
  `rpm_opr_time_hhmmss` int(11) DEFAULT '0',
  `rpm_opr_time_percentage` int(11) DEFAULT '0',
  `rpm_opt_normal_hhmmss` int(11) DEFAULT '0',
  `rpm_opt_normal_percentage` int(11) DEFAULT '0',
  `rpm_opt_max_hhmmss` int(11) DEFAULT '0',
  `rpm_opt_max_percentage` int(11) DEFAULT '0',
  `rpm_opr_hhmmss` int(11) DEFAULT '0',
  `rpm_engine_opr_percentage` int(11) DEFAULT '0',
  `fuel_start_vol` int(11) DEFAULT '0',
  `fuel_final_vol` int(11) DEFAULT '0',
  `fuel_actual_fuel_cons` int(11) DEFAULT '0',
  `fuel_refueling_vol` int(11) DEFAULT '0',
  `fuel_draining_vol` int(11) DEFAULT '0',
  `fuel_mileage_km` int(11) DEFAULT '0',
  `fuel_mileage_vehicle_running_km` int(11) DEFAULT '0',
  `fuel_fuelconsumption_vehicle_running` int(11) DEFAULT '0',
  `fuel_fuelconsumption_vehicle_idle` int(11) DEFAULT '0',
  `fuelconsumption_engine_hour` int(11) DEFAULT '0',
  `bucket_move_time_hhmmss` int(11) DEFAULT '0',
  `bucket_move_time_percentage` int(11) DEFAULT '0',
  `bucket_idle_time_hhmmss` int(11) DEFAULT '0',
  `bucket_idle_time_percentage` int(11) DEFAULT '0',
  `drumnonmvt_time_with_hhmmss` int(11) DEFAULT '0',
  `drumnonmvt_time_with_percentage` int(11) DEFAULT '0',
  `drumnonmvt_time_withoutload_hhmmss` int(11) DEFAULT '0',
  `drumnonmvt_time_withoutload_per` int(11) DEFAULT '0',
  `drumnonmvt_time_hhmmss` int(11) DEFAULT '0',
  `drumnonmvt_time_percentage` int(11) DEFAULT '0',
  `reading_can_odomtr_start` int(11) DEFAULT '0',
  `reading_can_odomtr_end` int(11) DEFAULT '0',
  `fuelconsumptionmeter` int(11) DEFAULT '0',
  `nbsp_sec` int(11) DEFAULT '0',
  `enginehours_hhmmss` int(11) DEFAULT '0',
  `fuelconsumption1` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fueldata_smooth`
--

CREATE TABLE `fueldata_smooth` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) NOT NULL,
  `lat` varchar(250) NOT NULL,
  `lng` varchar(250) NOT NULL,
  `speed` int(50) NOT NULL,
  `flag` varchar(250) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` varchar(250) NOT NULL,
  `percent` int(11) NOT NULL,
  `raw_value` varchar(150) NOT NULL DEFAULT '0',
  `odometer` varchar(250) NOT NULL DEFAULT '0',
  `litres` varchar(100) NOT NULL,
  `packettype` int(45) NOT NULL,
  `ignition` varchar(250) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fueltanktbl`
--

CREATE TABLE `fueltanktbl` (
  `fueltankid` int(11) NOT NULL,
  `fueltanktype` varchar(15) DEFAULT NULL,
  `sensortype` varchar(15) DEFAULT NULL,
  `brandype` varchar(20) DEFAULT NULL,
  `dimension` varchar(100) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_analog`
--

CREATE TABLE `fuel_analog` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `flag` varchar(250) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `raw_value` double NOT NULL DEFAULT '0',
  `odometer` double NOT NULL DEFAULT '0',
  `i1` varchar(50) NOT NULL DEFAULT '0',
  `i2` varchar(50) NOT NULL DEFAULT '0',
  `keyword` varchar(50) DEFAULT NULL,
  `litres` varchar(50) DEFAULT NULL,
  `packettype` int(45) DEFAULT NULL,
  `zap` longtext,
  `packet` varchar(250) DEFAULT NULL,
  `ignition` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `fuel_analog`
--
DELIMITER $$
CREATE TRIGGER `fuel_analog_trigger` AFTER INSERT ON `fuel_analog` FOR EACH ROW BEGIN
DECLARE fuel_ltr varchar(50);

IF(NEW.flag = '0' AND NEW.raw_value!='' AND NEW.raw_value!='0' AND NEW.raw_value > '0') THEN

	SELECT fuel_a,fuel_b,fuel_c,fuel_tank_capacity,fuel_average,client_id INTO @fuel_a, @fuel_b,@fuel_c,@fuel_tank_capacity,@fuel_average,@client_id FROM vehicletbl_2 WHERE deviceimei = NEW.running_no ORDER BY vehicleid DESC LIMIT 1;

  
      SET fuel_ltr = (((@fuel_a)*NEW.raw_value*NEW.raw_value)+(@fuel_b*NEW.raw_value)+@fuel_c);


		INSERT INTO fuel_status(running_no, lat, lng, speed, flag, modified_date, created_date, percent, raw_value, odometer, i1, i2, keyword, litres, packettype, zap, packet, ignition) VALUES (NEW.running_no, NEW.lat, NEW.lng, NEW.speed, NEW.flag, NEW.modified_date, NEW.created_date, NEW.percent, NEW.raw_value, NEW.odometer, NEW.i1, NEW.i2, NEW.keyword, round(fuel_ltr,3), NEW.packettype, NEW.zap, NEW.packet, NEW.ignition);
	    

END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_escort_ble`
--

CREATE TABLE `fuel_escort_ble` (
  `id` int(11) NOT NULL,
  `running_no` varchar(50) DEFAULT NULL,
  `lat` float(9,7) DEFAULT NULL,
  `lng` float(9,7) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `packettype` int(45) DEFAULT NULL,
  `raw_value` varchar(150) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `odometer` float(11,3) NOT NULL DEFAULT '0.000',
  `ignition` tinyint(4) NOT NULL DEFAULT '0',
  `keyword` varchar(150) DEFAULT NULL,
  `external_volt` varchar(25) DEFAULT NULL,
  `battery_voltage` varchar(25) DEFAULT NULL,
  `device_ble_status` smallint(45) DEFAULT NULL,
  `ble_fuel_temp_1` varchar(25) DEFAULT NULL,
  `ble_battery_1` varchar(25) DEFAULT NULL,
  `ble_humidity_1` varchar(25) DEFAULT NULL,
  `ble_fuel_level_1` varchar(25) DEFAULT NULL,
  `ble_luminosity_1` varchar(25) DEFAULT NULL,
  `ble_fuel_temp_2` varchar(25) DEFAULT NULL,
  `ble_battery_2` varchar(25) DEFAULT NULL,
  `ble_humidity_2` varchar(25) DEFAULT NULL,
  `ble_fuel_level_2` varchar(25) DEFAULT NULL,
  `ble_luminosity_2` varchar(25) DEFAULT NULL,
  `ble_fuel_temp_3` varchar(25) DEFAULT NULL,
  `ble_battery_3` varchar(25) DEFAULT NULL,
  `ble_humidity_3` varchar(25) DEFAULT NULL,
  `ble_fuel_level_3` varchar(25) DEFAULT NULL,
  `ble_luminosity_3` varchar(25) DEFAULT NULL,
  `ble_fuel_temp_4` varchar(25) DEFAULT NULL,
  `ble_battery_4` varchar(25) DEFAULT NULL,
  `ble_humidity_4` varchar(25) DEFAULT NULL,
  `ble_fuel_level_4` varchar(25) DEFAULT NULL,
  `ble_luminosity_4` varchar(25) DEFAULT NULL,
  `ble_custom_1` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `fuel_escort_ble`
--
DELIMITER $$
CREATE TRIGGER `fuel_ble_trigger` AFTER INSERT ON `fuel_escort_ble` FOR EACH ROW BEGIN

DECLARE fuel_ltr varchar(50);

IF(NEW.ble_fuel_level_1!='' AND NEW.ble_fuel_level_1!='0.0') THEN

	SELECT fuel_a,fuel_b,fuel_c,fuel_tank_capacity,fuel_average,client_id,vehicleid INTO @fuel_a, @fuel_b,@fuel_c,@fuel_tank_capacity,@fuel_average,@client_id,@vehicle_id FROM vehicletbl_2 WHERE deviceimei = NEW.running_no ORDER BY vehicleid DESC LIMIT 1;

	IF(@vehicle_id = 744) THEN

	IF(NEW.ble_fuel_level_1 > 1642 && NEW.ble_fuel_level_1 < 2298) THEN

	SET fuel_ltr = (((@fuel_a)*NEW.ble_fuel_level_1*NEW.ble_fuel_level_1)+(@fuel_b*NEW.ble_fuel_level_1)+@fuel_c)*1.005;

	END IF;

	IF((NEW.ble_fuel_level_1 > 560 && NEW.ble_fuel_level_1 < 1186) || (NEW.ble_fuel_level_1 > 2611 && NEW.ble_fuel_level_1 < 2702)) THEN

	SET fuel_ltr = (((@fuel_a)*NEW.ble_fuel_level_1*NEW.ble_fuel_level_1)+(@fuel_b*NEW.ble_fuel_level_1)+@fuel_c)*0.97;

	END IF;

	IF(NEW.ble_fuel_level_1 > 1251 && NEW.ble_fuel_level_1 < 1579) THEN

          SET fuel_ltr = (((@fuel_a)*NEW.ble_fuel_level_1*NEW.ble_fuel_level_1)+(@fuel_b*NEW.ble_fuel_level_1)+@fuel_c);

	END IF;
	
	IF((NEW.ble_fuel_level_1 > 2384 && NEW.ble_fuel_level_1 < 2486) || NEW.ble_fuel_level_1 < 560) THEN

             SET fuel_ltr = (((@fuel_a)*NEW.ble_fuel_level_1*NEW.ble_fuel_level_1)+(@fuel_b*NEW.ble_fuel_level_1)+@fuel_c);

	END IF;

    
     ELSE
  
      SET fuel_ltr = (((@fuel_a)*NEW.ble_fuel_level_1*NEW.ble_fuel_level_1)+(@fuel_b*NEW.ble_fuel_level_1)+@fuel_c)*@fuel_average;

	END IF;
	
	
		INSERT INTO fuel_status(running_no, lat, lng, speed, flag, modified_date, created_date, percent, raw_value, odometer, i1, i2, keyword, litres, packettype, zap, packet, ignition) VALUES (NEW.running_no, NEW.lat, NEW.lng, NEW.speed,'0', NEW.modified_date, NEW.created_date,'', NEW.ble_fuel_level_1, NEW.odometer, '', '', NEW.keyword, round(fuel_ltr,3), NEW.packettype, '', '', NEW.ignition);

        
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_fill_dip_report`
--

CREATE TABLE `fuel_fill_dip_report` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `start_fuel` double NOT NULL,
  `end_fuel` double NOT NULL,
  `difference_fuel` double NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `type_id` smallint(11) NOT NULL COMMENT '1 - is dip / 2 -is fill',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location_name` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_fill_dip_report_bk`
--

CREATE TABLE `fuel_fill_dip_report_bk` (
  `id` int(11) NOT NULL,
  `running_no` varchar(45) NOT NULL,
  `lat` varchar(45) NOT NULL,
  `lng` varchar(45) NOT NULL,
  `start_fuel` varchar(45) NOT NULL,
  `end_fuel` varchar(45) NOT NULL,
  `difference_fuel` varchar(45) NOT NULL,
  `start_date` varchar(45) NOT NULL,
  `end_date` varchar(45) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT '1 - is dip / 2 -is fill',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location_name` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_italon`
--

CREATE TABLE `fuel_italon` (
  `id` int(11) NOT NULL,
  `running_no` varchar(50) DEFAULT NULL,
  `lat` float(9,7) DEFAULT NULL,
  `lng` float(9,7) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `flag` tinyint(4) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `percent` int(11) NOT NULL DEFAULT '0',
  `raw_value` int(50) NOT NULL DEFAULT '0',
  `odometer` float(11,3) NOT NULL DEFAULT '0.000',
  `i1` varchar(50) NOT NULL DEFAULT '0',
  `i2` varchar(50) NOT NULL DEFAULT '0',
  `keyword` varchar(150) DEFAULT NULL,
  `litres` varchar(100) DEFAULT NULL,
  `fuel_temp` varchar(25) DEFAULT NULL,
  `packettype` int(45) DEFAULT NULL,
  `zap` longtext,
  `packet` varchar(250) DEFAULT NULL,
  `ignition` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `fuel_italon`
--
DELIMITER $$
CREATE TRIGGER `fuel_2ndorder` AFTER INSERT ON `fuel_italon` FOR EACH ROW BEGIN
DECLARE fuel_ltr varchar(50);

IF(NEW.flag = '0' AND (NEW.raw_value!='' AND NEW.raw_value!='0' AND NEW.raw_value<='4095')) THEN

	SELECT fuel_a,fuel_b,fuel_c,fuel_average,vehicleid INTO @fuel_a, @fuel_b,@fuel_c,@fuel_average,@vehicle_id FROM vehicletbl WHERE deviceimei = NEW.running_no ORDER BY vehicleid DESC LIMIT 1;

	
	
        SET fuel_ltr = (((@fuel_a)*NEW.raw_value*NEW.raw_value)+(@fuel_b*NEW.raw_value)+@fuel_c);
	

	INSERT INTO fuel_status(running_no, lat, lng, speed, flag, modified_date, created_date, percent, raw_value, odometer, i1, i2, keyword, litres, packettype, zap, packet, ignition) VALUES (NEW.running_no, NEW.lat, NEW.lng, NEW.speed, NEW.flag, NEW.modified_date, NEW.created_date, NEW.percent, NEW.raw_value, NEW.odometer, NEW.i1, NEW.i2, NEW.keyword, fuel_ltr, NEW.packettype, NEW.zap, NEW.packet, NEW.ignition);
    
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_management`
--

CREATE TABLE `fuel_management` (
  `fuel_management_id` int(11) NOT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `fuel_amount` varchar(255) DEFAULT NULL,
  `fuel_date` varchar(255) DEFAULT NULL,
  `fuel_liters` varchar(255) DEFAULT NULL,
  `pre_fuel_litre` float DEFAULT NULL,
  `fuel_type_id` varchar(255) NOT NULL DEFAULT '',
  `kilo_meter` varchar(255) DEFAULT NULL,
  `payment_type_id` varchar(255) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `createdon` varchar(45) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `updatedby` int(11) NOT NULL,
  `vehicle_id` varchar(255) DEFAULT NULL,
  `activecode` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `v_imei` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_status`
--

CREATE TABLE `fuel_status` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) NOT NULL DEFAULT '0',
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `speed` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `percent` int(11) NOT NULL,
  `raw_value` varchar(50) NOT NULL DEFAULT '0',
  `odometer` varchar(50) NOT NULL DEFAULT '0',
  `i1` varchar(50) NOT NULL DEFAULT '0',
  `i2` varchar(50) NOT NULL DEFAULT '0',
  `keyword` varchar(150) NOT NULL,
  `litres` double NOT NULL DEFAULT '0',
  `packettype` int(45) NOT NULL,
  `zap` longtext NOT NULL,
  `packet` varchar(250) NOT NULL,
  `ignition` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `fuel_status`
--
DELIMITER $$
CREATE TRIGGER `fuel_dip_fill triger` BEFORE INSERT ON `fuel_status` FOR EACH ROW BEGIN 
  
    DECLARE diff_odometer varchar(50);
          
    IF NEW.packettype !=1 AND NEW.flag =0 THEN

        UPDATE vehicletbl SET litres = NEW.litres WHERE deviceimei = NEW.running_no;
    
    END IF;    
        
    
    IF (NEW.packettype !=1) AND NEW.flag =0 AND @fuel_model!=3 THEN 
  
		SELECT vehicleid,client_id,fuel_dip_ltr,fuel_ltr,fuel_model INTO @v_id, @c_id,@fuel_dip_ltr,@fuel_fill_ltr,@fuel_model FROM vehicletbl WHERE deviceimei = NEW.running_no ORDER BY vehicleid DESC LIMIT 1;
		
		SELECT litres,odometer INTO @litres_val, @odometer_val FROM fuel_status  FORCE INDEX (running_no_4) WHERE running_no = NEW.running_no and flag = 0 ORDER BY modified_date DESC LIMIT 1;
   
		SET diff_odometer = NEW.odometer-@odometer_val;
   
         IF @fuel_fill_ltr > 0 AND @fuel_fill_ltr IS NOT NULL THEN
             IF ((NEW.litres-@litres_val)) >= @fuel_fill_ltr THEN        
             
                INSERT INTO fuel_fill_dip_report(running_no,lat,lng,start_fuel,end_fuel,type_id,difference_fuel,start_date,end_date)VALUES(NEW.running_no,NEW.lat,NEW.lng,@litres_val,NEW.litres,2,(NEW.litres-@litres_val),NOW(),NOW());
                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat,NEW.lng,NEW.modified_date,@v_id,@c_id,17,1,1);
             
             END IF;
        ELSE
            IF ((NEW.litres-@litres_val)) >= 8 THEN        
             
                INSERT INTO fuel_fill_dip_report(running_no,lat,lng,start_fuel,end_fuel,type_id,difference_fuel,start_date,end_date)VALUES(NEW.running_no,NEW.lat,NEW.lng,@litres_val,NEW.litres,2,(NEW.litres-@litres_val),NOW(),NOW());
                INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat,NEW.lng,NEW.modified_date,@v_id,@c_id,17,1,1);
             
             END IF;

        END IF;

      IF @fuel_dip_ltr > 0  AND @fuel_dip_ltr IS NOT NULL THEN

          IF (NEW.litres-@litres_val) <= (0-@fuel_dip_ltr) AND NEW.speed < '5' THEN 
       
              INSERT INTO fuel_fill_dip_report(running_no,lat,lng,start_fuel,end_fuel,type_id,difference_fuel,start_date,end_date)VALUES(NEW.running_no,NEW.lat,NEW.lng,@litres_val,NEW.litres,1,(NEW.litres-@litres_val),NOW(),NOW()); 
              INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat,NEW.lng,NEW.modified_date,@v_id,@c_id,18,1,1);
          END IF;

      ELSE
       
         IF ROUND(NEW.litres-@litres_val) < -8.5 AND NEW.speed < 5 THEN
       
              INSERT INTO fuel_fill_dip_report(running_no,lat,lng,start_fuel,end_fuel,type_id,difference_fuel,start_date,end_date)VALUES(NEW.running_no,NEW.lat,NEW.lng,@litres_val,NEW.litres,1,(NEW.litres-@litres_val),NOW(),NOW()); 
              INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat,NEW.lng,NEW.modified_date,@v_id,@c_id,18,1,1);
          END IF;

      END IF;
        
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_status_011922`
--

CREATE TABLE `fuel_status_011922` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) NOT NULL DEFAULT '0',
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `speed` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `percent` int(11) NOT NULL,
  `raw_value` varchar(50) NOT NULL DEFAULT '0',
  `odometer` varchar(50) NOT NULL DEFAULT '0',
  `i1` varchar(50) NOT NULL DEFAULT '0',
  `i2` varchar(50) NOT NULL DEFAULT '0',
  `keyword` varchar(150) NOT NULL,
  `litres` varchar(100) NOT NULL,
  `packettype` int(45) NOT NULL,
  `zap` longtext NOT NULL,
  `packet` varchar(250) NOT NULL,
  `ignition` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `fuel_type_id` int(11) NOT NULL,
  `fuel_type` varchar(450) DEFAULT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_report`
--

CREATE TABLE `geofence_report` (
  `id` bigint(20) NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `geo_location_id` int(11) NOT NULL,
  `g_lat` double NOT NULL,
  `g_lng` double NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `ignition_status` smallint(6) DEFAULT NULL,
  `ac_status` smallint(6) DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `location_status` smallint(6) DEFAULT NULL,
  `out_datetime` datetime NOT NULL,
  `in_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grouptbl`
--

CREATE TABLE `grouptbl` (
  `groupid` int(6) NOT NULL,
  `clientid` int(6) DEFAULT NULL,
  `groupname` varchar(30) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_status`
--

CREATE TABLE `health_status` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) NOT NULL,
  `gpsv` smallint(6) DEFAULT '0',
  `panic` smallint(6) DEFAULT '0',
  `bcharges` float DEFAULT '0',
  `bchargel` float DEFAULT '0',
  `internal_battery_voltage` float DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mainbl` float DEFAULT NULL,
  `keyword` varchar(30) DEFAULT NULL,
  `pending` varchar(50) DEFAULT NULL,
  `packettype` smallint(6) DEFAULT NULL,
  `vms` varchar(50) DEFAULT NULL,
  `zap` longtext,
  `packet` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `health_status`
--
DELIMITER $$
CREATE TRIGGER `status_update_vehicle_table` AFTER INSERT ON `health_status` FOR EACH ROW BEGIN
   
 
UPDATE
  vehicletbl
SET
  car_battery = NEW.mainbl,
  device_battery = NEW.bchargel,
  device_charge_status = NEW.bcharges,
  internal_battery_voltage=NEW.internal_battery_voltage
WHERE
   deviceimei = NEW.running_no;
 

IF NEW.packettype != '1' THEN
SELECT
  COUNT(created_on)
INTO
  @count
FROM
  battery_report
WHERE
  running_no = NEW.running_no AND DATE(created_on) = CURDATE()
ORDER BY
  id DESC
LIMIT 1;

 IF @count = '0' THEN
INSERT
INTO
  battery_report(
    running_no,
    car_battery,
    device_battery,
    created_on,
    createdon_datetime
  )
VALUES(
  NEW.running_no,
  NEW.mainbl,
  NEW.bchargel,
  CURDATE(), NOW());
  END IF;
END IF; 
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `historytbl`
--

CREATE TABLE `historytbl` (
  `historyid` int(6) NOT NULL,
  `logid` int(6) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `actionid` int(6) DEFAULT NULL,
  `actionvalue` varchar(15) DEFAULT NULL,
  `description` text,
  `actiondatetime` datetime DEFAULT NULL,
  `url` varchar(25) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hubpoint_location`
--

CREATE TABLE `hubpoint_location` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `circle_size` varchar(10) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `client_id` int(10) NOT NULL,
  `active_code` int(11) DEFAULT NULL,
  `primary_hub` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `ipaddress` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hub_report`
--

CREATE TABLE `hub_report` (
  `id` bigint(20) NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `g_id` bigint(20) NOT NULL,
  `g_lat` double DEFAULT NULL,
  `g_lng` double DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `ignition_status` int(11) DEFAULT NULL,
  `ac_status` int(11) DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `location_status` int(11) DEFAULT NULL,
  `out_datetime` datetime NOT NULL,
  `in_datetime` datetime NOT NULL,
  `start_odometer` double NOT NULL,
  `end_odometer` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ibuttontbl`
--

CREATE TABLE `ibuttontbl` (
  `ibuttonid` int(11) NOT NULL,
  `imeinumber` varchar(20) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `idle_report`
--

CREATE TABLE `idle_report` (
  `report_id` int(11) NOT NULL,
  `flag` smallint(6) DEFAULT NULL,
  `s_lat` double DEFAULT NULL,
  `s_lng` double DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `total_km` double DEFAULT '0',
  `e_lat` double DEFAULT NULL,
  `e_lng` double DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `start_location` text,
  `end_location` text,
  `client_id` int(11) DEFAULT NULL,
  `updated_status` int(11) NOT NULL DEFAULT '0',
  `Column 17` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `immoblizer_data`
--

CREATE TABLE `immoblizer_data` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `completed_status` int(11) NOT NULL DEFAULT '1',
  `address` text,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_reminder`
--

CREATE TABLE `insurance_reminder` (
  `insurance_reminder_id` int(11) NOT NULL,
  `activecode` int(11) NOT NULL DEFAULT '1',
  `end_date` varchar(255) DEFAULT NULL,
  `polocy_no` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `fc_expiry_date` varchar(25) NOT NULL,
  `tax_expriy_date` varchar(25) NOT NULL,
  `permit_expiry_date` varchar(25) NOT NULL,
  `createdon` varchar(45) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `updatedby` int(11) NOT NULL,
  `vehicle_id` varchar(255) DEFAULT NULL,
  `alert_date` varchar(45) NOT NULL,
  `alert_status` int(11) NOT NULL,
  `insure_file` varchar(255) DEFAULT NULL,
  `rc_file` varchar(255) DEFAULT NULL,
  `fc_file` varchar(255) DEFAULT NULL,
  `tax_file` varchar(255) DEFAULT NULL,
  `permit_file` varchar(255) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `i_button_details`
--

CREATE TABLE `i_button_details` (
  `id` int(11) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `vehicle_id` bigint(20) NOT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `driver_photo` varchar(100) DEFAULT NULL,
  `driver_email` varchar(100) DEFAULT NULL,
  `driver_mobile_no` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `active_code` varchar(100) DEFAULT NULL,
  `i_button_no` varchar(45) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `i_button_livedata`
--

CREATE TABLE `i_button_livedata` (
  `id` int(11) NOT NULL,
  `imei` varchar(50) NOT NULL,
  `ibutton_id` varchar(50) NOT NULL,
  `job_status` varchar(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `latitude_direction` varchar(5) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `longitude_direction` varchar(5) NOT NULL,
  `current_datetime` datetime NOT NULL,
  `logged_datetime` datetime NOT NULL,
  `packet_type` int(11) NOT NULL,
  `odometer` double DEFAULT NULL,
  `odometer_pulse` double DEFAULT NULL,
  `packet_id` varchar(100) DEFAULT NULL,
  `raw_packet` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `i_button_report`
--

CREATE TABLE `i_button_report` (
  `report_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `ibutton_no` varchar(50) DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `flag` int(11) NOT NULL,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double DEFAULT NULL,
  `update_status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `load_rpm_report`
--

CREATE TABLE `load_rpm_report` (
  `report_id` int(11) NOT NULL,
  `flag` smallint(6) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_list`
--

CREATE TABLE `location_list` (
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

-- --------------------------------------------------------

--
-- Table structure for table `new_location_history`
--

CREATE TABLE `new_location_history` (
  `running_no` bigint(20) DEFAULT NULL,
  `device_datetime` datetime DEFAULT NULL,
  `availablity_status` smallint(6) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` float DEFAULT '0',
  `orientation` varchar(18) DEFAULT NULL,
  `io_state` tinyint(4) NOT NULL DEFAULT '0',
  `prev_io` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `latlon_address` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `distance_travelled` double DEFAULT '0',
  `status` smallint(3) DEFAULT NULL,
  `fuel` double DEFAULT NULL,
  `fuel_consume` varchar(30) DEFAULT NULL,
  `hire_status` int(11) DEFAULT NULL,
  `keyword` varchar(11) DEFAULT NULL,
  `trackersim` varchar(50) DEFAULT NULL,
  `gpssignal` int(11) DEFAULT NULL,
  `gsmsignal` int(11) NOT NULL DEFAULT '0',
  `direction` int(11) DEFAULT NULL,
  `altitude` int(11) DEFAULT NULL,
  `acc_status` smallint(6) DEFAULT '0',
  `door_status` smallint(6) DEFAULT '0',
  `gpsv` varchar(45) NOT NULL DEFAULT '0',
  `temperature_sensor` float DEFAULT NULL,
  `power_tamper_status` smallint(6) DEFAULT NULL,
  `angle` float DEFAULT '0',
  `mainpower` float DEFAULT NULL,
  `maininput` float DEFAULT NULL,
  `tamper` varchar(40) DEFAULT NULL,
  `packettype1` varchar(10) DEFAULT NULL,
  `packettype` int(10) NOT NULL DEFAULT '0',
  `zap` longtext,
  `traveled_distance` float NOT NULL DEFAULT '0',
  `vehicle_sleep` int(11) DEFAULT NULL,
  `digital_output` int(11) DEFAULT NULL,
  `cell_id` int(11) DEFAULT NULL,
  `current_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `new_location_history`
--
DELIMITER $$
CREATE TRIGGER `vehicle_update` AFTER INSERT ON `new_location_history` FOR EACH ROW BEGIN
DECLARE new_odometer varchar(50);
  
  /* START SELECT ON VEHICLE INFORMATION WHERE new.running_no */

SELECT
  lat,
  lng,
  r_acc_date_time,
  r_acc_flag,
  r_acc_km,
  r_ac_date_time,
  r_ac_flag,
  r_ac_km,
  odometer,
  his_acc_status,
  his_acc_date,
  his_acc_km,
  his_ac_status,
  his_ac_date,
  his_ac_km,
  his_date_time,
  speed,
  vehicleid,
  client_id,
  his_lat,
  his_lng,
  parked_status,
  parked_date,
  TIMESTAMPDIFF(
    MINUTE,
    parked_date,
    NEW.modified_date
  ),
  parking_alerttime,
  speed_limit,
  device_config_type,
  status,
  dealer_id,
  subdealer_id
INTO
  @lat,
  @lng,
  @acc_date_time,
  @acc_flag,
  @acc_km,
  @ac_date_time,
  @ac_flag,
  @ac_km,
  @odometer,
  @his_acc_status,
  @his_acc_date,
  @his_acc_km,
  @his_ac_status,
  @his_ac_date,
  @his_ac_km,
  @his_date_time,
  @speed,
  @vehicleid,
  @client_id,
  @his_lat,
  @his_lng,
  @parked_status,
  @parked_date,
  @diff,
  @parking_alerttime,
  @speed_limit,
  @device_config_type,
  @status,
  @dealer_id,
  @subdealer_id
FROM
  vehicletbl
WHERE
  deviceimei = NEW.running_no
ORDER BY
  vehicleid DESC
LIMIT 1; 

/* END SELECT ON VEHICLE INFORMATION WHERE new.running_no */

IF @vehicleid is not NULL AND @status = 1  AND NEW.packettype != '1' THEN
/* GP:: Basic heart beat update ---need to check better implementation*/
  UPDATE
    vehicletbl
  SET  
    updatedon = NEW.modified_date
  WHERE
    deviceimei = NEW.running_no;
END IF; 
/* END  Basic heart beat update*/

/*SET Odometer value From device*/
IF NEW.traveled_distance != '0' AND NEW.traveled_distance != '0.0' THEN
 
  SET new_odometer = NEW.traveled_distance;
  
    
  ELSEIF NEW.lat_message!= '0.0' AND NEW.lon_message!= '0.0' AND NEW.distance_travelled >= '0' THEN
  
    SET new_odometer = @odometer+NEW.distance_travelled;
    
END IF;

/*END SET Odometer value From device*/


/*START Update Report Data*/

IF @vehicleid is not NULL AND @status = 1 AND NEW.io_state!=1 THEN

IF NEW.packettype != '1' THEN   /* THIS IS FOR CURRENT PACKET DATA -----> START */

/*Get start_odometer Value */
SELECT start_odometer INTO @start_odometer FROM trip_report WHERE device_no = NEW.running_no ORDER BY report_id DESC LIMIT 1; 

  /* START CURRENT ODOMETER UPDATION */
 IF NEW.traveled_distance != '0' AND NEW.traveled_distance != '0.0' AND @device_config_type !='2' THEN
  UPDATE
    vehicletbl
  SET
    odometer =  round(NEW.traveled_distance,3)
  WHERE
    vehicleid = @vehicleid; 


  ELSEIF (NEW.distance_travelled >= 0)  AND @device_config_type !='2' THEN
  
    UPDATE
    vehicletbl
  SET
    odometer = round((@odometer+NEW.distance_travelled),3)
  WHERE
    vehicleid = @vehicleid;
    
    
END IF;  /* END CURRENT ODOMETER UPDATION */


/* START CURRENT LOCATION UPDATION */

UPDATE
  vehicletbl
SET
  acc_on = NEW.acc_status,
  updatedon = NEW.modified_date,
  lat = NEW.lat_message,
  lng = NEW.lon_message,
  altitude=NEW.altitude,
  gpssignal=NEW.gpssignal,
  gsmsignal=NEW.gsmsignal,
  angle = NEW.angle,
  speed = NEW.speed,
  vehicle_sleep=NEW.vehicle_sleep,
  latlon_address=NEW.latlon_address,
  today_km=round((new_odometer-@start_odometer),3)
WHERE
  vehicleid = @vehicleid; 

/* END CURRENT LOCATION UPDATION */

IF(
    (
      @acc_flag = 1 OR @acc_flag = 0 OR @acc_flag IS NULL
    ) AND(NEW.acc_status = 1)
  ) THEN
  
  /*Ignition on Alert*/
INSERT
INTO
  sms_alert(
    type_id,
    createdon,
    lat,
    lng,
    vehicle_id,
    client_id,
    STATUS,
    all_status,
    alert_location,
    dealer_id,
    subdealer_id
  ) VALUE(
    5,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicleid,
    @client_id,
    1,
    3,
    NEW.latlon_address,
    @dealer_id,
    @subdealer_id
  );
  /*Ignition on Alert End*/
UPDATE
  vehicletbl
SET
  r_acc_flag = 2,
  last_ign_on = NEW.modified_date,
  last_ign_off = NEW.modified_date,
  acc_date_time = NEW.modified_date
WHERE
  deviceimei = NEW.running_no;
  
  /*Start Insert Trip report */
INSERT
INTO
  trip_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    type_id,
    start_odometer,
    start_location,
    client_id
  )
VALUES(
  1,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicleid,
  1,
  round(new_odometer,3),
  NEW.latlon_address,
   @client_id
);

/*END Insert Trip Report */

/*Start Update parking Report*/

UPDATE
  parking_report
SET
  flag = 2,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 1;
  

END IF;/*END parking report Update*/

/*Start Idle Report Insert*/
IF(
  NEW.speed = 0 AND @acc_flag = 2 AND NEW.acc_status = 1
) THEN

UPDATE
  vehicletbl
SET
  r_acc_flag = 3,
  last_ign_on = NEW.modified_date,
  last_ign_off = NEW.modified_date,
  acc_date_time = NEW.modified_date
WHERE
  deviceimei = NEW.running_no;
  
  
INSERT
INTO
  idle_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    start_location,
    client_id
  )
VALUES(
  1,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicleid,
  NEW.latlon_address,
  @client_id
);

END IF;  /*END Idle Report Insert*/


/* START update Idle_report */
 IF(
  @acc_flag = 3 AND NEW.speed > 0 AND NEW.acc_status = 1
) THEN
UPDATE
  vehicletbl
SET
  r_acc_flag = 2,
  last_ign_on = NEW.modified_date,
  last_ign_off = NEW.modified_date,
  acc_date_time = NEW.modified_date
WHERE
  deviceimei = NEW.running_no;
UPDATE
  idle_report
SET
  flag = 2,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 1;
  
END IF; /* END update Idle_report */

IF(@acc_flag = 2 OR @acc_flag = 3) AND NEW.acc_status = 0 THEN
UPDATE
  vehicletbl
SET
  r_acc_flag = 0,
  r_acc_km = 0,
  last_ign_off = NEW.modified_date,
  last_ign_on = NEW.modified_date
WHERE
  deviceimei = NEW.running_no;
INSERT
INTO
  sms_alert(
    type_id,
    createdon,
    lat,
    lng,
    vehicle_id,
    client_id,
    STATUS,
    all_status,
    alert_location,
     dealer_id,
    subdealer_id
  ) VALUE(
    5,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicleid,
    @client_id,
    0,
    4,
    NEW.latlon_address,
     @dealer_id,
    @subdealer_id
  );
UPDATE
  trip_report
SET
  flag = 2,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer= round(new_odometer,3),
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 1;
INSERT
INTO
  parking_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    start_location
  )
VALUES(
  1,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicleid,
  NEW.latlon_address
);
UPDATE
  idle_report
SET
  flag = 2,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 1;
END IF; 

/* TRIPS REPORT -----> END */

/* TRIP AC REPORT ------> START */

  IF(
  (
    @ac_flag = 0 OR @ac_flag IS NULL
  ) AND(NEW.door_status = 1)
) THEN
UPDATE
  vehicletbl
SET
  ac_flag = 1,
  r_ac_flag=2
WHERE
  deviceimei = NEW.running_no;
INSERT
INTO
  ac_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    type_id,
    start_odometer
  )
VALUES(
  1,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicleid,
  1,
   round(new_odometer,3)
);
INSERT
INTO
  sms_alert(
    type_id,
    createdon,
    lat,
    lng,
    vehicle_id,
    client_id,
    STATUS,
    all_status,
    alert_location,
    dealer_id,
    subdealer_id
  ) VALUE(
    7,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicleid,
    @client_id,
    1,
    1,
    NEW.latlon_address,
    @dealer_id,
    @subdealer_id
  );
END IF; 
IF @ac_flag = 2 AND NEW.door_status = 1 THEN
UPDATE
  vehicletbl
SET
  r_ac_km = @ac_km + find_distance(
    @lat,
    @lng,
    NEW.lat_message,
    NEW.lon_message
  )
WHERE
  deviceimei = NEW.running_no;
END IF; IF @ac_flag = 2 AND NEW.door_status = 0 THEN
INSERT
INTO
  sms_alert(
    type_id,
    createdon,
    lat,
    lng,
    vehicle_id,
    client_id,
    STATUS,
    all_status,
    alert_location,
    dealer_id,
    subdealer_id
  ) VALUE(
    7,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicleid,
    @client_id,
    0,
    2,
    NEW.latlon_address,
    @dealer_id,
    @subdealer_id
  );
UPDATE
  vehicletbl
SET
  ac_flag = 0,
  ac_km = 0,
  r_ac_flag=0
WHERE
  deviceimei = NEW.running_no;
UPDATE
  ac_report
SET
  flag = 2,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer= round(new_odometer,3)
WHERE
  device_no = NEW.running_no AND flag = 1;
END IF; 
  
/* TRIP AC REPORT ------> END */
    
    

/* HELP ME ALERT START */

IF NEW.keyword = 'help me' THEN


/*insert into sms_alert(type_id,createdon,lat,lng,vehicle_id,client_id,status,all_status)value(3,NEW.modified_date,NEW.lat_message,NEW.lon_message,@vehicle_id,@client_id,0,7);*/
UPDATE
  vehicletbl
SET
  help_me_alert = NEW.modified_date
WHERE
  vehicleid = @vehicleid;
END IF; 

/* HELP ME ALERT END */

/* LOW BATTERY ALERT START */

IF NEW.keyword = 'low battery' THEN


/*insert into sms_alert(type_id,createdon,lat,lng,vehicle_id,client_id,status,all_status)value(6,NEW.modified_date,NEW.lat_message,NEW.lon_message,@vehicle_id,@client_id,0,8);*/
UPDATE
  vehicletbl
SET
  low_battery_date = NEW.modified_date,
  low_battery_flag = 2
WHERE
  vehicleid = @vehicleid;
END IF; 

/* LOW BATTERY ALERT END */

/*  PLAYBACK DATA BACKUP START */

IF NEW.acc_status = '1' AND NEW.lat_message!='0.0' AND NEW.lon_message!='0.0' AND NEW.lat_message!="000000000" AND NEW.lon_message!='000000000' AND NEW.speed>1 THEN
INSERT
INTO
  play_back_history(
    running_no,
    lat_message,
    lon_message,
    speed,
    angle,
    door_status,
    acc_status,
    modified_date,
    odometer,
    zap,
    client_id
  )
VALUES(
  NEW.running_no,
  NEW.lat_message,
  NEW.lon_message,
  NEW.speed,
  NEW.angle,
  NEW.door_status,
  NEW.acc_status,
  NEW.modified_date,
  round(new_odometer,3),
  NEW.latlon_address,
  @client_id
);
END IF;

/* PLAYBACK DATA BACKUP END */

/* START PARKING ALERT */

IF NEW.speed != '0' THEN
UPDATE
  vehicletbl
SET
  parked_status = '0',
  parked_date = '0'
WHERE
  deviceimei = NEW.running_no;
END IF; IF NEW.speed = '0' AND @parked_status != '1' AND @parked_date != '1' THEN
UPDATE
  vehicletbl
SET
  parked_status = '1',
  parked_date = NEW.modified_date
WHERE
  deviceimei = NEW.running_no;
END IF; IF @diff > @parking_alerttime AND @parked_status = '1' THEN
UPDATE
  vehicletbl
SET
  parked_status = '0',
  parked_date = '1'
WHERE
  deviceimei = NEW.running_no;
INSERT
INTO
  sms_alert(
    lat,
    lng,
    createdon,
    vehicle_id,
    client_id,
    all_status,
    show_status,
    sms_status,
    alert_location,
    dealer_id,
    subdealer_id
  )
VALUES(
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  @vehicleid,
  @client_id,
  32,
  1,
  1,
    NEW.latlon_address,
     @dealer_id,
    @subdealer_id
);
END IF; 

/* END PARKING ALERT */

/* START OVER SPEED ALERT */

IF NEW.speed >= @speed_limit THEN
SELECT
  TIMESTAMPDIFF(
    MINUTE,
    createdon,
    NEW.modified_date
  )
INTO
  @last_alert
FROM
  sms_alert
WHERE
  all_status = '5' AND vehicle_id = @vv_id
ORDER BY
  sms_alert_id DESC
LIMIT 1; IF @last_alert THEN IF @last_alert >= 2 THEN
INSERT
INTO
  sms_alert(
    speed,
    lat,
    lng,
    createdon,
    vehicle_id,
    client_id,
    all_status,
    show_status,
    sms_status,
    play_status,
    alert_location,
    dealer_id,
    subdealer_id
  )
VALUES(
  NEW.speed,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  @vehicleid,
  @client_id,
  5,
  1,
  1,
  1,
    NEW.latlon_address,
     @dealer_id,
    @subdealer_id
);
END IF; ELSE
INSERT
INTO
  sms_alert(
    speed,
    lat,
    lng,
    createdon,
    vehicle_id,
    client_id,
    all_status,
    show_status,
    sms_status,
    play_status,
    alert_location,
    dealer_id,
    subdealer_id
  )
VALUES(
  NEW.speed,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  @vehicleid,
  @client_id,
  5,
  1,
  1,
  1,
    NEW.latlon_address,
    @dealer_id,
    @subdealer_id
);
END IF;
END IF;

/* END OVER SPEED ALERT */


/* TOWING REPORT START */
IF(NEW.speed >9 AND @acc_flag != 5 AND (@acc_flag = 2 OR @acc_flag = 3) AND NEW.acc_status = 0) THEN
  UPDATE
    vehicletbl
  SET
    r_acc_flag = 5,
    last_ign_on = NEW.modified_date,
    last_ign_off = NEW.modified_date,
    acc_date_time = NEW.modified_date
  WHERE
    deviceimei = NEW.running_no;
  INSERT
  INTO
    sms_alert(
      type_id,
      createdon,
      lat,
      lng,
      vehicle_id,
      client_id,
      STATUS,
      all_status,
      alert_location,
      dealer_id,
      subdealer_id
    ) VALUE(
      5,
      NEW.modified_date,
      NEW.lat_message,
      NEW.lon_message,
      @vehicleid,
      @client_id,
      1,
      34,
      NEW.latlon_address,
       @dealer_id,
      @subdealer_id
    );
  INSERT
  INTO
     towing_report(
      flag,
      s_lat,
      s_lng,
      start_day,
      device_no,
      vehicle_id,
      type_id,
      start_odometer,
      start_location
    )
  VALUES(
    '1',
    NEW.lat_message,
    NEW.lon_message,
    NEW.modified_date,
    NEW.running_no,
    @vehicleid,
    '1',
     round(new_odometer,3),
    NEW.latlon_address
  );

END IF;

IF(NEW.speed = 0 AND @acc_flag = 5 AND NEW.acc_status = 0) THEN
UPDATE
  vehicletbl
SET
  r_acc_flag = 2,
  last_ign_on = NEW.modified_date,
  last_ign_off = NEW.modified_date,
  acc_date_time = NEW.modified_date
WHERE
  deviceimei = NEW.running_no;
UPDATE
  towing_report
SET
  flag = 2,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer= round(new_odometer,3),
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 1;

END IF;

IF(NEW.speed >9 AND @acc_flag = 5 AND NEW.acc_status = 0 AND NEW.lat_message!='0.0' AND NEW.lon_message!='0.0' AND NEW.lat_message!="000000000" AND NEW.lon_message!='000000000') THEN

INSERT
INTO
  towing_play_back(
    running_no,
    lat_message,
    lon_message,
    speed,
    door_status,
    acc_status,
    modified_date,
    odometer,
    location_address,
    angle
  )
VALUES(
  NEW.running_no,
  NEW.lat_message,
  NEW.lon_message,
  NEW.speed,
  NEW.door_status,
  NEW.acc_status,
  NEW.modified_date,
   round(new_odometer,3),
  NEW.latlon_address,
  NEW.angle
);
END IF;

/*TOWING REPORT END*/



END IF; /* THIS IS FOR CURRENT PACKET DATA -----> END */
IF NEW.packettype = '1' THEN   /* THIS IS FOR HISTORY PACKET DATA -----> START */

/* TRIPS REPORT -----> START */

  IF @his_acc_status IS NULL THEN
UPDATE
  vehicletbl
SET
  his_acc_status = NEW.acc_status,
  his_acc_date = NEW.modified_date,
  his_acc_km = 0,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  deviceimei = NEW.running_no;
END IF; IF(
  (
    @his_acc_status = 1 OR @his_acc_status = 0
  ) AND(NEW.acc_status = 1) AND(@his_acc_status IS NOT NULL)
) THEN
UPDATE
  vehicletbl
SET
  his_acc_status = 2,
  his_acc_date = NEW.modified_date,
  his_acc_km = 0,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  deviceimei = NEW.running_no;
INSERT
INTO
  trip_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    type_id,
    start_odometer,
    start_location
  )
VALUES(
  3,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicleid,
  3,
   round(new_odometer,3),
  NEW.latlon_address
);
UPDATE
  parking_report
SET
  flag = 4,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 3;
END IF; IF @his_acc_status = 2 AND NEW.acc_status = 1 THEN
UPDATE
  vehicletbl
SET
  his_acc_km = @his_acc_km + find_distance(
    @his_lat,
    @his_lng,
    NEW.lat_message,
    NEW.lon_message
  ),
  LAST = LAST + find_distance(
    @his_lat,
    @his_lng,
    NEW.lat_message,
    NEW.lon_message
  ),
  his_acc_date = NEW.modified_date,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  deviceimei = NEW.running_no;
END IF; IF @his_acc_status = 2 AND NEW.acc_status = 0 THEN
UPDATE
  vehicletbl
SET
  his_acc_status = 0,
  his_acc_km = 0,
  LAST = LAST + find_distance(
    @his_lat,
    @his_lng,
    NEW.lat_message,
    NEW.lon_message
  )
WHERE
  deviceimei = NEW.running_no;
UPDATE
  trip_report
SET
  flag = 4,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer= round(new_odometer,3),
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 3;
INSERT
INTO
  parking_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    start_location
  )
VALUES(
  3,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicleid,
  NEW.latlon_address
);
END IF; 
    
/* TRIPS REPORT -----> END */

/* AC REPORT -----> START */

  IF @his_ac_status IS NULL THEN
UPDATE
  vehicletbl
SET
  his_ac_status = 0,
  his_ac_km = 0,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  deviceimei = NEW.running_no;
END IF; IF(
  (
   @his_ac_status = 0
  ) AND(NEW.door_status = 1) AND(@his_ac_status IS NOT NULL)
) THEN
UPDATE
  vehicletbl
SET
  his_ac_status = 2,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  deviceimei = NEW.running_no;
INSERT
INTO
  ac_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    type_id,
    start_odometer
  )
VALUES(
  3,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicleid,
  '3',
   round(new_odometer,3)
);
END IF; IF @his_ac_status = 2 AND NEW.door_status = 1 THEN
UPDATE
  vehicletbl
SET
  his_ac_km = @his_ac_km + find_distance(
    @his_lat,
    @his_lng,
    NEW.lat_message,
    NEW.lon_message
  )
WHERE
  deviceimei = NEW.running_no;
END IF; IF @his_ac_status = 2 AND NEW.door_status = 0 THEN
UPDATE
  vehicletbl
SET
  his_ac_status = 0,
  his_ac_km = 0
WHERE
  deviceimei = NEW.running_no;
UPDATE
  ac_report
SET
 
  flag = 2,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer= round(new_odometer,3)
WHERE
  device_no = NEW.running_no AND flag = 3;
END IF; 

/* AC REPORT -----> END */

/* HELP ME ALERT START */

IF NEW.keyword = 'help me' THEN


/*insert into sms_alert(type_id,createdon,lat,lng,vehicle_id,client_id,status,all_status)value(3,NEW.modified_date,NEW.lat_message,NEW.lon_message,@vehicle_id,@client_id,0,7);*/
UPDATE
  vehicletbl
SET
  help_me_alert = NEW.modified_date
WHERE
  vehicleid = @vehicleid;
END IF; 

/* HELP ME ALERT END */

/* LOW BATTERY ALERT START */

IF NEW.keyword = 'low battery' THEN


/*insert into sms_alert(type_id,createdon,lat,lng,vehicle_id,client_id,status,all_status)value(6,NEW.modified_date,NEW.lat_message,NEW.lon_message,@vehicle_id,@client_id,0,8);*/
UPDATE
  vehicletbl
SET
  low_battery_date = NEW.modified_date,
  low_battery_flag = 2
WHERE
  vehicleid = @vehicleid;
END IF; 

/* LOW BATTERY ALERT END */

/*  PLAYBACK DATA BACKUP START */

IF NEW.acc_status = '1' AND NEW.lat_message!='0.0' AND NEW.lon_message!='0.0' AND NEW.lat_message!="000000000" AND NEW.lon_message!='000000000' AND NEW.speed>1 THEN
INSERT
INTO
  play_back_history(
    running_no,
    lat_message,
    lon_message,
    speed,
    angle,
    door_status,
    acc_status,
    modified_date,
    odometer,
    zap,
    client_id
  )
VALUES(
  NEW.running_no,
  NEW.lat_message,
  NEW.lon_message,
  NEW.speed,
  NEW.angle,
  NEW.door_status,
  NEW.acc_status,
  NEW.modified_date,
  round(new_odometer,3),
  NEW.latlon_address,
  @client_id
);
END IF;

/* PLAYBACK DATA BACKUP END */


/*towing_report START*/
IF(NEW.speed >9 AND @his_acc_status != 7 AND @his_acc_status = 2 AND NEW.acc_status = 0) THEN
  INSERT
  INTO
     towing_report(
      flag,
      s_lat,
      s_lng,
      start_day,
      device_no,
      vehicle_id,
      type_id,
      start_odometer,
      start_location
    )
  VALUES(
    3,
    NEW.lat_message,
    NEW.lon_message,
    NEW.modified_date,
    NEW.running_no,
    @vehicleid,
    3,
     round(new_odometer,3),
    NEW.latlon_address
  );

END IF;

IF(NEW.speed = 0 AND @his_acc_status = 7 AND NEW.acc_status = 0) THEN

UPDATE
  towing_report
SET
  flag = 4,
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer= round(new_odometer,3),
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = 3;

END IF;

IF(NEW.speed >9 AND @his_acc_status = 7 AND NEW.acc_status = 0 AND NEW.lat_message!='0.0' AND NEW.lon_message!='0.0' AND NEW.lat_message!="000000000" AND NEW.lon_message!='000000000') THEN

INSERT
INTO
  towing_play_back(
    running_no,
    lat_message,
    lon_message,
    speed,
    door_status,
    acc_status,
    modified_date,
    odometer,
    location_address,
    angle
  )
VALUES(
  NEW.running_no,
  NEW.lat_message,
  NEW.lon_message,
  NEW.speed,
  NEW.door_status,
  NEW.acc_status,
  NEW.modified_date,
   round(new_odometer,3),
  NEW.latlon_address,
  NEW.angle
);
END IF;
/*towing_report END*/



END IF;
 /* THIS IS FOR HISTORY PACKET DATA -----> END */


END IF;  




END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `nodata_vehicle`
--

CREATE TABLE `nodata_vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vehicle_name` varchar(20) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_updatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `normal_rpm_report`
--

CREATE TABLE `normal_rpm_report` (
  `report_id` int(11) NOT NULL,
  `flag` smallint(6) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification_alert`
--

CREATE TABLE `notification_alert` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL DEFAULT '0',
  `lat` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `lng` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `geo_location_name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `date_time` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vehicle_name` varchar(450) DEFAULT NULL,
  `vehicle_register_number` varchar(450) DEFAULT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `all_status` int(11) DEFAULT NULL,
  `show_status` int(11) DEFAULT '1',
  `alert_type` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `omni_distance_data`
--

CREATE TABLE `omni_distance_data` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `deviceimei` bigint(20) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `overload_rpm_report`
--

CREATE TABLE `overload_rpm_report` (
  `report_id` int(11) NOT NULL,
  `flag` smallint(6) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parking_report`
--

CREATE TABLE `parking_report` (
  `report_id` int(11) NOT NULL,
  `flag` smallint(6) DEFAULT NULL,
  `s_lat` double DEFAULT NULL,
  `s_lng` double DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `total_km` double DEFAULT NULL,
  `e_lat` double DEFAULT NULL,
  `e_lng` double DEFAULT NULL,
  `type_id` smallint(6) DEFAULT NULL,
  `ignition` smallint(6) NOT NULL DEFAULT '1',
  `start_location` varchar(70) DEFAULT NULL,
  `end_location` varchar(70) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `update_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paymenttbl`
--

CREATE TABLE `paymenttbl` (
  `paymentid` int(6) NOT NULL,
  `paymentmode` varchar(15) DEFAULT NULL,
  `transactionid` int(6) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `receivedon` datetime DEFAULT NULL,
  `userid` int(6) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history`
--

CREATE TABLE `play_back_history` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(25) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_0`
--

CREATE TABLE `play_back_history_0` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_1`
--

CREATE TABLE `play_back_history_1` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_2`
--

CREATE TABLE `play_back_history_2` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_3`
--

CREATE TABLE `play_back_history_3` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_5`
--

CREATE TABLE `play_back_history_5` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_7`
--

CREATE TABLE `play_back_history_7` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_9`
--

CREATE TABLE `play_back_history_9` (
  `id` int(11) NOT NULL,
  `running_no` varchar(45) DEFAULT NULL,
  `lat_message` varchar(60) DEFAULT NULL,
  `lon_message` varchar(60) DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_17`
--

CREATE TABLE `play_back_history_17` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_18`
--

CREATE TABLE `play_back_history_18` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_19`
--

CREATE TABLE `play_back_history_19` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_20`
--

CREATE TABLE `play_back_history_20` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_21`
--

CREATE TABLE `play_back_history_21` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_25`
--

CREATE TABLE `play_back_history_25` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_26`
--

CREATE TABLE `play_back_history_26` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_27`
--

CREATE TABLE `play_back_history_27` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_28`
--

CREATE TABLE `play_back_history_28` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_30`
--

CREATE TABLE `play_back_history_30` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_32`
--

CREATE TABLE `play_back_history_32` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_35`
--

CREATE TABLE `play_back_history_35` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_36`
--

CREATE TABLE `play_back_history_36` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_37`
--

CREATE TABLE `play_back_history_37` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_49`
--

CREATE TABLE `play_back_history_49` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_50`
--

CREATE TABLE `play_back_history_50` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_51`
--

CREATE TABLE `play_back_history_51` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_53`
--

CREATE TABLE `play_back_history_53` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_60`
--

CREATE TABLE `play_back_history_60` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_65`
--

CREATE TABLE `play_back_history_65` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_67`
--

CREATE TABLE `play_back_history_67` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_69`
--

CREATE TABLE `play_back_history_69` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_71`
--

CREATE TABLE `play_back_history_71` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_73`
--

CREATE TABLE `play_back_history_73` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_77`
--

CREATE TABLE `play_back_history_77` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_78`
--

CREATE TABLE `play_back_history_78` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_87`
--

CREATE TABLE `play_back_history_87` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_89`
--

CREATE TABLE `play_back_history_89` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_91`
--

CREATE TABLE `play_back_history_91` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_92`
--

CREATE TABLE `play_back_history_92` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_94`
--

CREATE TABLE `play_back_history_94` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_102`
--

CREATE TABLE `play_back_history_102` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_103`
--

CREATE TABLE `play_back_history_103` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_114`
--

CREATE TABLE `play_back_history_114` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_117`
--

CREATE TABLE `play_back_history_117` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_119`
--

CREATE TABLE `play_back_history_119` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_120`
--

CREATE TABLE `play_back_history_120` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_121`
--

CREATE TABLE `play_back_history_121` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_122`
--

CREATE TABLE `play_back_history_122` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_124`
--

CREATE TABLE `play_back_history_124` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_126`
--

CREATE TABLE `play_back_history_126` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_127`
--

CREATE TABLE `play_back_history_127` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_128`
--

CREATE TABLE `play_back_history_128` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_130`
--

CREATE TABLE `play_back_history_130` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_132`
--

CREATE TABLE `play_back_history_132` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_134`
--

CREATE TABLE `play_back_history_134` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_137`
--

CREATE TABLE `play_back_history_137` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_138`
--

CREATE TABLE `play_back_history_138` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_140`
--

CREATE TABLE `play_back_history_140` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_141`
--

CREATE TABLE `play_back_history_141` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_143`
--

CREATE TABLE `play_back_history_143` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_144`
--

CREATE TABLE `play_back_history_144` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_147`
--

CREATE TABLE `play_back_history_147` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_150`
--

CREATE TABLE `play_back_history_150` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_154`
--

CREATE TABLE `play_back_history_154` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_156`
--

CREATE TABLE `play_back_history_156` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_157`
--

CREATE TABLE `play_back_history_157` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_159`
--

CREATE TABLE `play_back_history_159` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_160`
--

CREATE TABLE `play_back_history_160` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_161`
--

CREATE TABLE `play_back_history_161` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_162`
--

CREATE TABLE `play_back_history_162` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_163`
--

CREATE TABLE `play_back_history_163` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_164`
--

CREATE TABLE `play_back_history_164` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_166`
--

CREATE TABLE `play_back_history_166` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_167`
--

CREATE TABLE `play_back_history_167` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_168`
--

CREATE TABLE `play_back_history_168` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_169`
--

CREATE TABLE `play_back_history_169` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_170`
--

CREATE TABLE `play_back_history_170` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_171`
--

CREATE TABLE `play_back_history_171` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_172`
--

CREATE TABLE `play_back_history_172` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_173`
--

CREATE TABLE `play_back_history_173` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_174`
--

CREATE TABLE `play_back_history_174` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_175`
--

CREATE TABLE `play_back_history_175` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_177`
--

CREATE TABLE `play_back_history_177` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_178`
--

CREATE TABLE `play_back_history_178` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_180`
--

CREATE TABLE `play_back_history_180` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_182`
--

CREATE TABLE `play_back_history_182` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_183`
--

CREATE TABLE `play_back_history_183` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_184`
--

CREATE TABLE `play_back_history_184` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_185`
--

CREATE TABLE `play_back_history_185` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_186`
--

CREATE TABLE `play_back_history_186` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_189`
--

CREATE TABLE `play_back_history_189` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_198`
--

CREATE TABLE `play_back_history_198` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_200`
--

CREATE TABLE `play_back_history_200` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_201`
--

CREATE TABLE `play_back_history_201` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_202`
--

CREATE TABLE `play_back_history_202` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_203`
--

CREATE TABLE `play_back_history_203` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_204`
--

CREATE TABLE `play_back_history_204` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_205`
--

CREATE TABLE `play_back_history_205` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_206`
--

CREATE TABLE `play_back_history_206` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_207`
--

CREATE TABLE `play_back_history_207` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_208`
--

CREATE TABLE `play_back_history_208` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_209`
--

CREATE TABLE `play_back_history_209` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_210`
--

CREATE TABLE `play_back_history_210` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_211`
--

CREATE TABLE `play_back_history_211` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_212`
--

CREATE TABLE `play_back_history_212` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_213`
--

CREATE TABLE `play_back_history_213` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_214`
--

CREATE TABLE `play_back_history_214` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_215`
--

CREATE TABLE `play_back_history_215` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_216`
--

CREATE TABLE `play_back_history_216` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_217`
--

CREATE TABLE `play_back_history_217` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_218`
--

CREATE TABLE `play_back_history_218` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_219`
--

CREATE TABLE `play_back_history_219` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_220`
--

CREATE TABLE `play_back_history_220` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_221`
--

CREATE TABLE `play_back_history_221` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_222`
--

CREATE TABLE `play_back_history_222` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_223`
--

CREATE TABLE `play_back_history_223` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_224`
--

CREATE TABLE `play_back_history_224` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_227`
--

CREATE TABLE `play_back_history_227` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_228`
--

CREATE TABLE `play_back_history_228` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_229`
--

CREATE TABLE `play_back_history_229` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_230`
--

CREATE TABLE `play_back_history_230` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_231`
--

CREATE TABLE `play_back_history_231` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_232`
--

CREATE TABLE `play_back_history_232` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_237`
--

CREATE TABLE `play_back_history_237` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_242`
--

CREATE TABLE `play_back_history_242` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_245`
--

CREATE TABLE `play_back_history_245` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_247`
--

CREATE TABLE `play_back_history_247` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_248`
--

CREATE TABLE `play_back_history_248` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_250`
--

CREATE TABLE `play_back_history_250` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_251`
--

CREATE TABLE `play_back_history_251` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_253`
--

CREATE TABLE `play_back_history_253` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_260`
--

CREATE TABLE `play_back_history_260` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_261`
--

CREATE TABLE `play_back_history_261` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_262`
--

CREATE TABLE `play_back_history_262` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_265`
--

CREATE TABLE `play_back_history_265` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_276`
--

CREATE TABLE `play_back_history_276` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_277`
--

CREATE TABLE `play_back_history_277` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_279`
--

CREATE TABLE `play_back_history_279` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_280`
--

CREATE TABLE `play_back_history_280` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_281`
--

CREATE TABLE `play_back_history_281` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_283`
--

CREATE TABLE `play_back_history_283` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_284`
--

CREATE TABLE `play_back_history_284` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_285`
--

CREATE TABLE `play_back_history_285` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_286`
--

CREATE TABLE `play_back_history_286` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_287`
--

CREATE TABLE `play_back_history_287` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_288`
--

CREATE TABLE `play_back_history_288` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_289`
--

CREATE TABLE `play_back_history_289` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_290`
--

CREATE TABLE `play_back_history_290` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_291`
--

CREATE TABLE `play_back_history_291` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_292`
--

CREATE TABLE `play_back_history_292` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_293`
--

CREATE TABLE `play_back_history_293` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_294`
--

CREATE TABLE `play_back_history_294` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_295`
--

CREATE TABLE `play_back_history_295` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_296`
--

CREATE TABLE `play_back_history_296` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_298`
--

CREATE TABLE `play_back_history_298` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_306`
--

CREATE TABLE `play_back_history_306` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_307`
--

CREATE TABLE `play_back_history_307` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_308`
--

CREATE TABLE `play_back_history_308` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_309`
--

CREATE TABLE `play_back_history_309` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_310`
--

CREATE TABLE `play_back_history_310` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_311`
--

CREATE TABLE `play_back_history_311` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_312`
--

CREATE TABLE `play_back_history_312` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_316`
--

CREATE TABLE `play_back_history_316` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_317`
--

CREATE TABLE `play_back_history_317` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_318`
--

CREATE TABLE `play_back_history_318` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_321`
--

CREATE TABLE `play_back_history_321` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_322`
--

CREATE TABLE `play_back_history_322` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_323`
--

CREATE TABLE `play_back_history_323` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_324`
--

CREATE TABLE `play_back_history_324` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_325`
--

CREATE TABLE `play_back_history_325` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_328`
--

CREATE TABLE `play_back_history_328` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_329`
--

CREATE TABLE `play_back_history_329` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_330`
--

CREATE TABLE `play_back_history_330` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_331`
--

CREATE TABLE `play_back_history_331` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_332`
--

CREATE TABLE `play_back_history_332` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_333`
--

CREATE TABLE `play_back_history_333` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_336`
--

CREATE TABLE `play_back_history_336` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_337`
--

CREATE TABLE `play_back_history_337` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_338`
--

CREATE TABLE `play_back_history_338` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_339`
--

CREATE TABLE `play_back_history_339` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_340`
--

CREATE TABLE `play_back_history_340` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_341`
--

CREATE TABLE `play_back_history_341` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_342`
--

CREATE TABLE `play_back_history_342` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_343`
--

CREATE TABLE `play_back_history_343` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_344`
--

CREATE TABLE `play_back_history_344` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_345`
--

CREATE TABLE `play_back_history_345` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_346`
--

CREATE TABLE `play_back_history_346` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_347`
--

CREATE TABLE `play_back_history_347` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_348`
--

CREATE TABLE `play_back_history_348` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_349`
--

CREATE TABLE `play_back_history_349` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_351`
--

CREATE TABLE `play_back_history_351` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_352`
--

CREATE TABLE `play_back_history_352` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_353`
--

CREATE TABLE `play_back_history_353` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_354`
--

CREATE TABLE `play_back_history_354` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_355`
--

CREATE TABLE `play_back_history_355` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_356`
--

CREATE TABLE `play_back_history_356` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_357`
--

CREATE TABLE `play_back_history_357` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_358`
--

CREATE TABLE `play_back_history_358` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_359`
--

CREATE TABLE `play_back_history_359` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_360`
--

CREATE TABLE `play_back_history_360` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_362`
--

CREATE TABLE `play_back_history_362` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_363`
--

CREATE TABLE `play_back_history_363` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_364`
--

CREATE TABLE `play_back_history_364` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history_365`
--

CREATE TABLE `play_back_history_365` (
  `id` int(11) NOT NULL,
  `running_no` bigint(20) DEFAULT NULL,
  `lat_message` double DEFAULT NULL,
  `lon_message` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polygon_list`
--

CREATE TABLE `polygon_list` (
  `polygon_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `polygon_name` varchar(100) DEFAULT NULL,
  `polygon_points` text,
  `polygon_color` varchar(50) DEFAULT 'blue',
  `polygon_fillcolor` varchar(30) DEFAULT '#81a4db',
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `createdby` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polygon_report`
--

CREATE TABLE `polygon_report` (
  `id` bigint(20) NOT NULL,
  `vehicle_imei` varchar(50) DEFAULT NULL,
  `vehicle_name` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `lat` varchar(10) DEFAULT NULL,
  `lng` varchar(10) DEFAULT NULL,
  `polygon_id` int(11) DEFAULT NULL,
  `polygon_area_name` varchar(100) NOT NULL,
  `in_datetime` datetime DEFAULT NULL,
  `out_datetime` datetime DEFAULT NULL,
  `location_status` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polygon_report1`
--

CREATE TABLE `polygon_report1` (
  `id` bigint(20) NOT NULL,
  `vehicle_imei` varchar(50) DEFAULT NULL,
  `vehicle_name` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `s_lat` varchar(20) DEFAULT NULL,
  `s_lng` varchar(20) DEFAULT NULL,
  `e_lat` varchar(20) DEFAULT NULL,
  `e_lng` varchar(20) DEFAULT NULL,
  `polygon_id` int(11) DEFAULT NULL,
  `polygon_area_name` varchar(100) NOT NULL,
  `in_datetime` datetime DEFAULT NULL,
  `out_datetime` datetime DEFAULT NULL,
  `location_status` int(11) DEFAULT NULL,
  `create_datetime` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polygon_routelist`
--

CREATE TABLE `polygon_routelist` (
  `route_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `route_type` int(11) DEFAULT NULL,
  `route_name` varchar(45) NOT NULL,
  `route_createdby` varchar(11) NOT NULL,
  `route_createddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `route_updatedby` varchar(11) NOT NULL,
  `route_updateddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `route_status` int(11) NOT NULL DEFAULT '1',
  `route_geo_start_id` int(11) NOT NULL,
  `route_geo_end_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polygon_routes`
--

CREATE TABLE `polygon_routes` (
  `route_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `route_name` varchar(45) NOT NULL,
  `route_createdby` varchar(11) NOT NULL,
  `route_createddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `route_updatedby` varchar(11) NOT NULL,
  `route_updateddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `route_status` int(11) NOT NULL,
  `polygon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polygon_routestops`
--

CREATE TABLE `polygon_routestops` (
  `stop_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_name` varchar(255) NOT NULL,
  `created_id` int(11) NOT NULL,
  `created_datetime` varchar(25) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `updated_datetime` varchar(25) NOT NULL,
  `stop_geo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poly_route_list`
--

CREATE TABLE `poly_route_list` (
  `live_routeid` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `route_type` int(11) DEFAULT NULL,
  `vehicle_name` varchar(30) DEFAULT NULL,
  `route_id` int(11) DEFAULT '0',
  `routename` varchar(30) DEFAULT NULL,
  `route_startid` int(11) DEFAULT NULL,
  `route_endid` int(11) DEFAULT NULL,
  `start_route_intime` datetime DEFAULT NULL,
  `start_route_outtime` datetime DEFAULT NULL,
  `end_route_intime` datetime DEFAULT NULL,
  `end_route_outtime` datetime DEFAULT NULL,
  `travel_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `start_polygon_name` varchar(100) DEFAULT NULL,
  `end_polygon_name` varchar(100) DEFAULT NULL,
  `route_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poly_stop_list`
--

CREATE TABLE `poly_stop_list` (
  `live_stopid` int(11) NOT NULL,
  `live_routeid` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `stop_geo_id` int(11) DEFAULT NULL,
  `stopentry_time` datetime DEFAULT NULL,
  `stopexit_time` datetime DEFAULT NULL,
  `stop_polygon_name` varchar(100) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `stop_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privillagestbl`
--

CREATE TABLE `privillagestbl` (
  `privillagesid` int(6) NOT NULL,
  `privillagesname` varchar(25) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_paymentmode`
--

CREATE TABLE `ref_paymentmode` (
  `id` int(11) NOT NULL,
  `payment_option` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `renewaltbl`
--

CREATE TABLE `renewaltbl` (
  `renewalid` int(6) NOT NULL,
  `clientid` int(6) DEFAULT NULL,
  `deviceid` int(6) DEFAULT NULL,
  `installationdate` date DEFAULT NULL,
  `renewaldate` date DEFAULT NULL,
  `renewalgraceperiod` date DEFAULT NULL,
  `gracecount` int(6) DEFAULT NULL,
  `latefee` int(6) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roletbl`
--

CREATE TABLE `roletbl` (
  `roleid` int(6) NOT NULL,
  `rolename` varchar(15) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `routeassigntbl`
--

CREATE TABLE `routeassigntbl` (
  `id` int(11) NOT NULL,
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
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `routestbl`
--

CREATE TABLE `routestbl` (
  `route_id` int(11) NOT NULL,
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
  `status` smallint(6) DEFAULT '1',
  `ipaddress` varchar(30) DEFAULT NULL,
  `route_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `routestoptbl`
--

CREATE TABLE `routestoptbl` (
  `stop_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_name` varchar(255) NOT NULL,
  `stop_location` varchar(50) NOT NULL,
  `stop_lat` varchar(25) NOT NULL,
  `stop_long` varchar(25) NOT NULL,
  `stop_arrival_time` varchar(15) NOT NULL,
  `stop_start_time` varchar(15) NOT NULL,
  `stop_geo_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `route_penalty_details`
--

CREATE TABLE `route_penalty_details` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `penalty_type` smallint(6) NOT NULL,
  `basic_duration` int(11) DEFAULT NULL,
  `basic_amount` double NOT NULL,
  `additional_duration` int(11) DEFAULT NULL,
  `additional_charge` float DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_stop_report`
--

CREATE TABLE `route_stop_report` (
  `id` int(11) NOT NULL,
  `routetrip_id` int(11) DEFAULT NULL,
  `vehicle_id` varchar(50) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `stop_id` int(11) DEFAULT NULL,
  `stop_name` varchar(50) DEFAULT NULL,
  `stop_geoid` int(11) DEFAULT NULL,
  `stop_planed_arrival` datetime DEFAULT NULL,
  `stop_actual_arrival` datetime DEFAULT NULL,
  `stop_planed_dispatch` datetime DEFAULT NULL,
  `stop_actual_dispatch` datetime DEFAULT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_trip`
--

CREATE TABLE `route_trip` (
  `trip_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `route_startloc_name` varchar(100) DEFAULT NULL,
  `route_planed_start_date` datetime DEFAULT NULL,
  `route_planed_end_date` datetime DEFAULT NULL,
  `route_endloc_name` varchar(100) DEFAULT NULL,
  `actual_start_time` datetime DEFAULT NULL,
  `actual_end_time` datetime DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `route_geo_start_id` int(11) DEFAULT NULL,
  `route_geo_end_id` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scl_class`
--

CREATE TABLE `scl_class` (
  `class_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `class_name` varchar(40) NOT NULL,
  `class_createdby` int(11) NOT NULL,
  `class_createddate` datetime NOT NULL,
  `class_updatedby` int(11) NOT NULL,
  `class_updateddate` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scl_section`
--

CREATE TABLE `scl_section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(45) NOT NULL,
  `section_createdby` int(11) NOT NULL,
  `section_createddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `section_updatedby` int(11) NOT NULL,
  `section_updateddate` datetime NOT NULL,
  `class_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) NOT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  `primary_mobile` varchar(20) DEFAULT NULL,
  `secondary_mobile` varchar(20) DEFAULT NULL,
  `company_address` longtext,
  `UpdatedBy` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `simtbl`
--

CREATE TABLE `simtbl` (
  `simid` int(6) NOT NULL,
  `networkprovider` varchar(30) DEFAULT NULL,
  `imeinumber` bigint(20) DEFAULT NULL,
  `simnumber` bigint(20) DEFAULT NULL,
  `validfrom` date DEFAULT NULL,
  `validto` date DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT '1',
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smswebnotification`
--

CREATE TABLE `smswebnotification` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sms_alert`
--

CREATE TABLE `sms_alert` (
  `sms_alert_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_number` varchar(30) DEFAULT NULL,
  `type_id` smallint(11) DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `phoneno` varchar(20) DEFAULT NULL,
  `deviation` varchar(45) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` smallint(11) DEFAULT NULL,
  `all_status` smallint(11) DEFAULT NULL,
  `show_status` smallint(11) DEFAULT '1',
  `sms_status` smallint(11) DEFAULT '1',
  `play_status` smallint(11) DEFAULT '1',
  `email_status` smallint(11) NOT NULL DEFAULT '0',
  `send_sms_status` smallint(11) NOT NULL DEFAULT '0',
  `geo_location_name` varchar(45) DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alert_location` text,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `sms_alert`
--
DELIMITER $$
CREATE TRIGGER `trigger_notification_popup` AFTER INSERT ON `sms_alert` FOR EACH ROW INSERT
INTO
  notification_alert
SELECT DISTINCT
  `sl`.`sms_alert_id` AS `id`,
  `v`.`vehicleid` AS `vehicle_id`,
  `sl`.`lat` AS `lat`,
  `sl`.`lng` AS `lng`,
  `sl`.`geo_location_name` AS `geo_location_name`,
  `sl`.`createdon` AS `date_time`,
  `sl`.`createddate` AS `createddate`,
  `v`.`vehiclename` AS `vehicle_name`,
  `v`.`vehiclename` AS `vehiclename`,
  `v`.`client_id` AS `client_id`,
  `sl`.`all_status` AS `all_status`,
  `sl`.`show_status` AS `show_status`,
  `att`.`alert_type` AS `alert_type`,
   `sl`.`dealer_id` AS `dealer_id`,
  `sl`.`subdealer_id` AS `subdealer_id`
FROM
  (
    (
      (
        `twings`.`alter_contacts` `al`
      JOIN
        `twings`.`sms_alert` `sl` ON(
          (
            (`al`.`client_id` = `sl`.`client_id`) 
      AND(
              (`sl`.`all_status` = `al`.`ac_on`) OR (`sl`.`all_status` = `al`.`ac_off`) OR(`sl`.`all_status` = `al`.`ignition_on`) 
        OR(`sl`.`all_status` = `al`.`sos_alert`) OR(
                `sl`.`all_status` = `al`.`ignition_off`
              ) OR(`sl`.`all_status` = `al`.`speed_alert`) OR(
                `sl`.`all_status` = `al`.`geo_fence_in_circle`
              ) OR(
                `sl`.`all_status` = `al`.`geo_fence_out_circle`
              ) OR(
                `sl`.`all_status` = `al`.`harsh_acceleration`
              ) OR(`sl`.`all_status` = `al`.`idle`) OR(
                `sl`.`all_status` = `al`.`harsh_braking`
              ) OR(
                `sl`.`all_status` = `al`.`harsh_cornering`
              )  OR(
                `sl`.`all_status` = `al`.`fuel_fill`
              )  OR(
                `sl`.`all_status` = `al`.`fuel_dip`
              ) OR(
                `sl`.`all_status` = `al`.`speed_breaker_bump`
              ) OR(`sl`.`all_status` = `al`.`accident`) OR(`sl`.`all_status` = `al`.`fuel_dip`) OR(`sl`.`all_status` = `al`.`fuel_fill`) OR(`sl`.`all_status` = `al`.`power_off`) OR (`sl`.`all_status` = `al`.`route_deviation`)
            )
          )
        )
      )
    JOIN
      `twings`.`vehicletbl` `v` ON((`v`.`vehicleid` = `sl`.`vehicle_id`))
    )
  JOIN
    `twings`.`alert_type` `att` ON(
      (
        `att`.`alert_type_id` = `sl`.`all_status`
      )
    )
  )
WHERE
  sms_alert_id =NEW.sms_alert_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `statustbl`
--

CREATE TABLE `statustbl` (
  `statusid` int(11) NOT NULL,
  `statusname` varchar(30) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subdealertbl`
--

CREATE TABLE `subdealertbl` (
  `subdealer_id` int(11) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_company` varchar(255) DEFAULT NULL,
  `subdealer_name` varchar(255) DEFAULT NULL,
  `subdealer_email` varchar(255) DEFAULT NULL,
  `subdealer_mobile` varchar(20) DEFAULT NULL,
  `subdealer_address` longtext,
  `subdealer_logo` text,
  `subdealer_limit` int(11) DEFAULT NULL,
  `subdealer_color` varchar(50) DEFAULT NULL,
  `subdealer_subdomain` varchar(255) DEFAULT NULL,
  `subdealer_city` varchar(30) DEFAULT NULL,
  `subdealer_state` varchar(30) DEFAULT NULL,
  `subdealer_country` varchar(30) DEFAULT NULL,
  `subdealer_pincode` int(10) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supportdevicetbl`
--

CREATE TABLE `supportdevicetbl` (
  `sdid` int(11) NOT NULL,
  `deviceid` int(6) DEFAULT NULL,
  `devicetype` varchar(20) DEFAULT NULL,
  `features` text,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temperature_status`
--

CREATE TABLE `temperature_status` (
  `id` int(11) NOT NULL,
  `imei` varchar(255) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longtitude` varchar(20) DEFAULT NULL,
  `angle` float DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `ign_status` int(11) DEFAULT NULL,
  `odometer` double DEFAULT NULL,
  `temp_status1` float DEFAULT NULL,
  `humidity1` float DEFAULT NULL,
  `temp_status2` float DEFAULT NULL,
  `humidity2` float DEFAULT NULL,
  `temp_status3` float DEFAULT NULL,
  `humidity3` float DEFAULT NULL,
  `temp_status4` float DEFAULT NULL,
  `humidity4` float DEFAULT NULL,
  `temp_status5` float DEFAULT NULL,
  `humidity5` float DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `towing_play_back`
--

CREATE TABLE `towing_play_back` (
  `id` int(11) NOT NULL,
  `running_no` varchar(45) DEFAULT NULL,
  `lat_message` varchar(60) DEFAULT NULL,
  `lon_message` varchar(60) DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `acc_status` int(11) DEFAULT NULL,
  `door_status` int(11) DEFAULT NULL,
  `packettype` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `location_address` text,
  `angle` double DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `towing_report`
--

CREATE TABLE `towing_report` (
  `report_id` int(11) NOT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `s_lat` double DEFAULT NULL,
  `s_lng` double DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `total_km` double DEFAULT '0',
  `e_lat` double DEFAULT NULL,
  `e_lng` double DEFAULT NULL,
  `type_id` tinyint(4) DEFAULT NULL,
  `fuel_usage` varchar(45) DEFAULT NULL,
  `fuel_filled` varchar(45) DEFAULT NULL,
  `initial_ltr` varchar(45) DEFAULT NULL,
  `end_ltr` varchar(45) DEFAULT NULL,
  `car_battery` blob,
  `device_battery` blob,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double DEFAULT NULL,
  `start_location` text,
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip_report`
--

CREATE TABLE `trip_report` (
  `report_id` int(11) NOT NULL,
  `flag` smallint(6) DEFAULT NULL,
  `s_lat` double DEFAULT NULL,
  `s_lng` double DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` bigint(20) DEFAULT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `total_km` double DEFAULT '0',
  `e_lat` double DEFAULT NULL,
  `e_lng` double DEFAULT NULL,
  `type_id` smallint(11) DEFAULT NULL,
  `fuel_usage` varchar(45) DEFAULT NULL,
  `fuel_filled` varchar(45) DEFAULT NULL,
  `initial_ltr` varchar(45) DEFAULT NULL,
  `end_ltr` varchar(45) DEFAULT NULL,
  `car_battery` blob,
  `device_battery` blob,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double DEFAULT NULL,
  `real_start_odo` double DEFAULT NULL,
  `real_end_odo` double DEFAULT NULL,
  `start_location` text,
  `end_location` text,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `userid` int(5) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `secondarypassword` varchar(40) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `companyname` varchar(50) DEFAULT NULL,
  `companylogo` varchar(50) DEFAULT NULL,
  `clienttype` varchar(20) DEFAULT NULL,
  `client_id` int(4) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `roleid` int(4) DEFAULT NULL,
  `hub_id` int(11) DEFAULT NULL,
  `priviledges` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobilenumber` varchar(15) DEFAULT NULL,
  `alter_mobile` bigint(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `profilepic` varchar(50) DEFAULT NULL,
  `postaladdres` text,
  `city` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `verifiedstatus` smallint(6) DEFAULT NULL,
  `verificationcode` longtext,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `ipaddress` varchar(50) DEFAULT NULL,
  `log_in_datetime` datetime DEFAULT NULL,
  `log_out_datetime` datetime DEFAULT NULL,
  `logged_in` int(11) NOT NULL,
  `non_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `usertbl`
--
DELIMITER $$
CREATE TRIGGER `accesspriviledge_altercontact_update` AFTER INSERT ON `usertbl` FOR EACH ROW BEGIN
INSERT INTO accesspriviledge(userid,client_id,status)VALUES(NEW.userid,NEW.client_id,NEW.status);
INSERT INTO alter_contacts(activecode,createdby,createdon,ac_on,ac_off,ignition_on,ignition_off,client_id)VALUES(1,1,CURRENT_TIMESTAMP,1,2,3,4,NEW.client_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicleliveupdationtbl`
--

CREATE TABLE `vehicleliveupdationtbl` (
  `livedataid` int(11) NOT NULL,
  `deviceimei` varchar(20) DEFAULT NULL,
  `devicedatetime` datetime DEFAULT NULL,
  `createddatetime` datetime DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `locationaddress` varchar(100) DEFAULT NULL,
  `angle` varchar(20) DEFAULT NULL,
  `speed` varchar(10) DEFAULT NULL,
  `odometertype` varchar(20) DEFAULT NULL,
  `odometervalue` varchar(20) DEFAULT NULL,
  `packettype` smallint(6) DEFAULT NULL,
  `iostate` int(6) DEFAULT NULL,
  `ignitionstatus` smallint(6) DEFAULT NULL,
  `acstatus` smallint(6) DEFAULT NULL,
  `doorstatus` int(6) DEFAULT NULL,
  `rawdata` varchar(100) DEFAULT NULL,
  `vehiclesleep` smallint(6) DEFAULT NULL,
  `digitaloutput` smallint(6) DEFAULT NULL,
  `towerid` int(6) DEFAULT NULL,
  `fuelliter` varchar(20) DEFAULT NULL,
  `fuelfill` int(6) DEFAULT NULL,
  `fueldip` int(6) DEFAULT NULL,
  `anglesensorstatus` smallint(6) DEFAULT NULL,
  `anglesensorbattery` int(6) DEFAULT NULL,
  `anglesensorvalue` int(6) DEFAULT NULL,
  `temperaturevalue` int(6) DEFAULT NULL,
  `humidity` int(6) DEFAULT NULL,
  `ibuttonimei` varchar(20) DEFAULT NULL,
  `ibuttonjobstatus` smallint(6) DEFAULT NULL,
  `switchstatus` smallint(6) DEFAULT NULL,
  `vehiclebattery` varchar(20) DEFAULT NULL,
  `devicebattery` varchar(20) DEFAULT NULL,
  `obdenginespeed` varchar(20) DEFAULT NULL,
  `obdspeed` int(6) DEFAULT NULL,
  `coolantlevel` int(6) DEFAULT NULL,
  `averagefueleconomy` varchar(20) DEFAULT NULL,
  `obdodometer` int(6) DEFAULT NULL,
  `fuellevel` int(6) DEFAULT NULL,
  `engineload` int(6) DEFAULT NULL,
  `coolanttemperature` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicletbl`
--

CREATE TABLE `vehicletbl` (
  `vehicleid` int(11) NOT NULL,
  `vehiclename` varchar(30) DEFAULT NULL,
  `vehicletype` smallint(6) DEFAULT NULL,
  `vehiclemodel` varchar(30) DEFAULT NULL,
  `vehiclegroup` varchar(30) DEFAULT NULL,
  `client_id` int(6) DEFAULT NULL,
  `deviceimei` bigint(20) DEFAULT NULL,
  `simnumber` varchar(20) DEFAULT NULL,
  `alerts` int(6) DEFAULT NULL,
  `insurancecompany` varchar(25) DEFAULT NULL,
  `insurancenumber` varchar(30) DEFAULT NULL,
  `insurancedate` date DEFAULT NULL,
  `taxdate` date DEFAULT NULL,
  `registrationnumber` varchar(30) DEFAULT NULL,
  `chassisnumber` varchar(25) DEFAULT NULL,
  `modelnumber` varchar(20) DEFAULT NULL,
  `enginenumber` varchar(25) DEFAULT NULL,
  `ownershiptype` varchar(20) DEFAULT NULL,
  `manufacturedby` int(6) DEFAULT NULL,
  `fcdate` date DEFAULT NULL,
  `documents` varchar(50) DEFAULT NULL,
  `vehicleimages` varchar(50) DEFAULT NULL,
  `installationdate` date DEFAULT NULL,
  `expiredate` date DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL,
  `acc_on` tinyint(4) DEFAULT NULL,
  `fuel_average` varchar(10) NOT NULL DEFAULT '1',
  `mobile` varchar(30) DEFAULT NULL,
  `acc_date_time` datetime DEFAULT NULL,
  `temperature` varchar(30) DEFAULT NULL,
  `temperature_date_time` datetime DEFAULT NULL,
  `temp_status` int(11) NOT NULL DEFAULT '0',
  `hub_ETA` varchar(30) DEFAULT NULL,
  `acc_flag` tinyint(4) DEFAULT '1',
  `help_me_alert_date` datetime DEFAULT NULL,
  `lat` double DEFAULT '11.019458',
  `lng` double DEFAULT '76.965041',
  `latlon_address` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `low_battery_date` datetime DEFAULT NULL,
  `low_battery_flag` tinyint(4) DEFAULT NULL,
  `v_rfid` varchar(30) DEFAULT NULL,
  `keyword` varchar(30) DEFAULT NULL,
  `help_me_alert` varchar(30) DEFAULT NULL,
  `last_ign_on` datetime DEFAULT NULL,
  `last_ign_off` datetime DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `meter` double DEFAULT NULL,
  `fueltank` varchar(30) DEFAULT NULL,
  `ac_flag` tinyint(4) NOT NULL DEFAULT '0',
  `ac_date` datetime DEFAULT NULL,
  `ac_km` double DEFAULT NULL,
  `route_deviation` tinyint(11) DEFAULT NULL,
  `speed_limit` int(11) DEFAULT NULL,
  `v_distance_travelled` double DEFAULT NULL,
  `v_door_status` tinyint(4) DEFAULT NULL,
  `today_km` double DEFAULT NULL,
  `today_date` datetime DEFAULT NULL,
  `today_fuel_usage` int(11) DEFAULT NULL,
  `fuel_ltr` double DEFAULT NULL,
  `mileage` double NOT NULL DEFAULT '0',
  `fuel_tank_capacity` int(11) DEFAULT NULL,
  `fuel_is_set` int(11) NOT NULL DEFAULT '0',
  `power_off_date` datetime DEFAULT NULL,
  `power_off_flag` tinyint(4) DEFAULT NULL,
  `car_battery` double DEFAULT '0',
  `device_battery` double DEFAULT NULL,
  `device_charge_status` tinyint(4) DEFAULT NULL,
  `unique_id` varchar(30) DEFAULT NULL,
  `device_assign_datetiem` datetime DEFAULT NULL,
  `device_assign_by` int(11) DEFAULT NULL,
  `last` varchar(30) DEFAULT '0',
  `fuel_odo` int(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `angle` double DEFAULT '0',
  `acc_status` tinyint(4) DEFAULT NULL,
  `traveled_distance` double NOT NULL DEFAULT '0',
  `litres` double NOT NULL DEFAULT '0',
  `fuel_model` tinyint(4) DEFAULT NULL,
  `fuel_tank_type` tinyint(4) DEFAULT NULL,
  `tank_length` int(11) DEFAULT NULL,
  `tank_width` int(11) DEFAULT NULL,
  `tank_height` int(11) DEFAULT NULL,
  `devicetime` datetime DEFAULT NULL,
  `devicetime_updated` datetime DEFAULT NULL,
  `parked_status` tinyint(4) DEFAULT NULL,
  `parked_date` varchar(25) DEFAULT NULL,
  `parking_alerttime` int(11) DEFAULT NULL,
  `idle_alerttime` int(11) NOT NULL DEFAULT '0',
  `r_acc_date_time` datetime DEFAULT NULL,
  `r_acc_flag` tinyint(4) DEFAULT NULL,
  `r_acc_km` double DEFAULT NULL,
  `r_ac_date_time` datetime DEFAULT NULL,
  `r_ac_flag` tinyint(4) DEFAULT NULL,
  `r_ac_km` double DEFAULT NULL,
  `odometer` double DEFAULT '0',
  `his_acc_status` tinyint(4) DEFAULT NULL,
  `his_acc_date` datetime DEFAULT NULL,
  `his_acc_km` double DEFAULT NULL,
  `his_ac_status` tinyint(4) DEFAULT NULL,
  `his_ac_date` datetime DEFAULT NULL,
  `his_ac_km` double DEFAULT NULL,
  `his_date_time` datetime DEFAULT NULL,
  `his_lat` double DEFAULT NULL,
  `his_lng` double DEFAULT NULL,
  `tank_diameter` int(10) DEFAULT NULL,
  `fuel_limit` double DEFAULT NULL,
  `bunk_status` tinyint(4) DEFAULT NULL,
  `device_type` tinyint(4) DEFAULT NULL,
  `fuel_type` tinyint(4) DEFAULT NULL,
  `fuel_a` double DEFAULT NULL,
  `fuel_b` double DEFAULT NULL,
  `fuel_c` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `remarks` longtext,
  `ibutton_receiver` varchar(50) DEFAULT NULL,
  `driver_ibutton` varchar(30) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `device_config_type` tinyint(4) DEFAULT NULL,
  `vehicle_sleep` tinyint(4) NOT NULL,
  `fuel_dip_ltr` float NOT NULL DEFAULT '0',
  `route_deviated` tinyint(4) DEFAULT NULL,
  `route_deviate_sms` tinyint(4) DEFAULT NULL,
  `internal_battery_voltage` double DEFAULT NULL,
  `digital_output` tinyint(4) DEFAULT NULL,
  `mdvr_status` tinyint(4) DEFAULT NULL,
  `mdvr_terminal_no` bigint(20) DEFAULT NULL,
  `alter_tank_width` int(11) DEFAULT NULL,
  `alter_tank_height` int(11) DEFAULT NULL,
  `alter_tank_length` int(11) DEFAULT NULL,
  `temp_low` float DEFAULT NULL,
  `temp_high` float DEFAULT NULL,
  `altitude` int(11) DEFAULT NULL,
  `gsmsignal` int(11) DEFAULT NULL,
  `gpssignal` int(11) DEFAULT NULL,
  `visible_status` int(11) NOT NULL DEFAULT '1',
  `idle_rpm` int(11) DEFAULT NULL,
  `max_rpm` int(11) DEFAULT NULL,
  `rpm_status` int(11) DEFAULT NULL,
  `expected_milege` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicletbl_2`
--

CREATE TABLE `vehicletbl_2` (
  `vehicleid` int(11) NOT NULL,
  `vehiclename` varchar(30) DEFAULT NULL,
  `vehicletype` smallint(6) DEFAULT NULL,
  `vehiclemodel` varchar(30) DEFAULT NULL,
  `vehiclegroup` varchar(30) DEFAULT NULL,
  `client_id` int(6) DEFAULT NULL,
  `deviceimei` bigint(20) DEFAULT NULL,
  `simnumber` varchar(20) DEFAULT NULL,
  `alerts` int(6) DEFAULT NULL,
  `insurancecompany` varchar(25) DEFAULT NULL,
  `insurancenumber` varchar(30) DEFAULT NULL,
  `insurancedate` date DEFAULT NULL,
  `taxdate` date DEFAULT NULL,
  `registrationnumber` varchar(30) DEFAULT NULL,
  `chassisnumber` varchar(25) DEFAULT NULL,
  `modelnumber` varchar(20) DEFAULT NULL,
  `enginenumber` varchar(25) DEFAULT NULL,
  `ownershiptype` varchar(20) DEFAULT NULL,
  `manufacturedby` int(6) DEFAULT NULL,
  `fcdate` date DEFAULT NULL,
  `documents` varchar(50) DEFAULT NULL,
  `vehicleimages` varchar(50) DEFAULT NULL,
  `installationdate` date DEFAULT NULL,
  `expiredate` date DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `ipaddress` varchar(30) DEFAULT NULL,
  `acc_on` tinyint(4) DEFAULT NULL,
  `fuel_average` varchar(10) NOT NULL DEFAULT '1',
  `mobile` varchar(30) DEFAULT NULL,
  `acc_date_time` datetime DEFAULT NULL,
  `temperature` varchar(30) DEFAULT NULL,
  `temperature_date_time` datetime DEFAULT NULL,
  `temp_status` int(11) NOT NULL DEFAULT '0',
  `hub_ETA` varchar(30) DEFAULT NULL,
  `acc_flag` tinyint(4) DEFAULT '1',
  `help_me_alert_date` datetime DEFAULT NULL,
  `lat` double DEFAULT '11.019458',
  `lng` double DEFAULT '76.965041',
  `latlon_address` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `low_battery_date` datetime DEFAULT NULL,
  `low_battery_flag` tinyint(4) DEFAULT NULL,
  `v_rfid` varchar(30) DEFAULT NULL,
  `keyword` varchar(30) DEFAULT NULL,
  `help_me_alert` varchar(30) DEFAULT NULL,
  `last_ign_on` datetime DEFAULT NULL,
  `last_ign_off` datetime DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `meter` double DEFAULT NULL,
  `fueltank` varchar(30) DEFAULT NULL,
  `ac_flag` tinyint(4) NOT NULL DEFAULT '0',
  `ac_date` datetime DEFAULT NULL,
  `ac_km` double DEFAULT NULL,
  `route_deviation` tinyint(11) DEFAULT NULL,
  `speed_limit` int(11) DEFAULT NULL,
  `v_distance_travelled` double DEFAULT NULL,
  `v_door_status` tinyint(4) DEFAULT NULL,
  `today_km` double DEFAULT NULL,
  `today_date` datetime DEFAULT NULL,
  `today_fuel_usage` int(11) DEFAULT NULL,
  `fuel_ltr` double DEFAULT NULL,
  `mileage` double NOT NULL DEFAULT '0',
  `fuel_tank_capacity` int(11) DEFAULT NULL,
  `fuel_is_set` int(11) NOT NULL DEFAULT '0',
  `power_off_date` datetime DEFAULT NULL,
  `power_off_flag` tinyint(4) DEFAULT NULL,
  `car_battery` double DEFAULT '0',
  `device_battery` double DEFAULT NULL,
  `device_charge_status` tinyint(4) DEFAULT NULL,
  `unique_id` varchar(30) DEFAULT NULL,
  `device_assign_datetiem` datetime DEFAULT NULL,
  `device_assign_by` int(11) DEFAULT NULL,
  `last` varchar(30) DEFAULT '0',
  `fuel_odo` int(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `angle` double DEFAULT '0',
  `acc_status` tinyint(4) DEFAULT NULL,
  `traveled_distance` double NOT NULL DEFAULT '0',
  `litres` double NOT NULL DEFAULT '0',
  `fuel_model` tinyint(4) DEFAULT NULL,
  `fuel_tank_type` tinyint(4) DEFAULT NULL,
  `tank_length` int(11) DEFAULT NULL,
  `tank_width` int(11) DEFAULT NULL,
  `tank_height` int(11) DEFAULT NULL,
  `devicetime` datetime DEFAULT NULL,
  `devicetime_updated` datetime DEFAULT NULL,
  `parked_status` tinyint(4) DEFAULT NULL,
  `parked_date` varchar(25) DEFAULT NULL,
  `parking_alerttime` int(11) DEFAULT NULL,
  `idle_alerttime` int(11) NOT NULL DEFAULT '0',
  `r_acc_date_time` datetime DEFAULT NULL,
  `r_acc_flag` tinyint(4) DEFAULT NULL,
  `r_acc_km` double DEFAULT NULL,
  `r_ac_date_time` datetime DEFAULT NULL,
  `r_ac_flag` tinyint(4) DEFAULT NULL,
  `r_ac_km` double DEFAULT NULL,
  `odometer` double DEFAULT '0',
  `his_acc_status` tinyint(4) DEFAULT NULL,
  `his_acc_date` datetime DEFAULT NULL,
  `his_acc_km` double DEFAULT NULL,
  `his_ac_status` tinyint(4) DEFAULT NULL,
  `his_ac_date` datetime DEFAULT NULL,
  `his_ac_km` double DEFAULT NULL,
  `his_date_time` datetime DEFAULT NULL,
  `his_lat` double DEFAULT NULL,
  `his_lng` double DEFAULT NULL,
  `tank_diameter` int(10) DEFAULT NULL,
  `fuel_limit` double DEFAULT NULL,
  `bunk_status` tinyint(4) DEFAULT NULL,
  `device_type` tinyint(4) DEFAULT NULL,
  `fuel_type` tinyint(4) DEFAULT NULL,
  `fuel_a` double DEFAULT NULL,
  `fuel_b` double DEFAULT NULL,
  `fuel_c` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `remarks` longtext,
  `ibutton_receiver` varchar(50) DEFAULT NULL,
  `driver_ibutton` varchar(30) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `device_config_type` tinyint(4) DEFAULT NULL,
  `vehicle_sleep` tinyint(4) NOT NULL,
  `fuel_dip_ltr` float NOT NULL DEFAULT '0',
  `route_deviated` tinyint(4) DEFAULT NULL,
  `route_deviate_sms` tinyint(4) DEFAULT NULL,
  `internal_battery_voltage` double DEFAULT NULL,
  `digital_output` tinyint(4) DEFAULT NULL,
  `mdvr_status` tinyint(4) DEFAULT NULL,
  `mdvr_terminal_no` bigint(20) DEFAULT NULL,
  `alter_tank_width` int(11) DEFAULT NULL,
  `alter_tank_height` int(11) DEFAULT NULL,
  `alter_tank_length` int(11) DEFAULT NULL,
  `temp_low` float DEFAULT NULL,
  `temp_high` float DEFAULT NULL,
  `altitude` int(11) DEFAULT NULL,
  `gsmsignal` int(11) DEFAULT NULL,
  `gpssignal` int(11) DEFAULT NULL,
  `visible_status` int(11) NOT NULL DEFAULT '1',
  `idle_rpm` int(11) DEFAULT NULL,
  `max_rpm` int(11) DEFAULT NULL,
  `rpm_status` int(11) DEFAULT NULL,
  `expected_milege` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicletypetbl`
--

CREATE TABLE `vehicletypetbl` (
  `vtype_id` int(6) NOT NULL,
  `vehicletype` varchar(50) DEFAULT NULL,
  `vehicle_shortname` varchar(60) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `createdby` int(6) DEFAULT NULL,
  `updatedby` int(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT '1',
  `ipaddress` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_expirelist`
--

CREATE TABLE `vehicle_expirelist` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `deviceimei` bigint(20) DEFAULT NULL,
  `vehiclename` varchar(70) DEFAULT NULL,
  `vehicle_model` varchar(60) DEFAULT NULL,
  `work_startdate` datetime DEFAULT NULL,
  `work_enddate` datetime DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_service`
--

CREATE TABLE `vehicle_service` (
  `service_id` int(11) NOT NULL,
  `vehicle_id` varchar(45) DEFAULT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `service_type` varchar(45) DEFAULT NULL,
  `purchase_amount` varchar(45) DEFAULT NULL,
  `payment_mode` varchar(45) DEFAULT NULL,
  `mode_details` text NOT NULL,
  `purchase_date` varchar(45) DEFAULT NULL,
  `purchase_product` varchar(45) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `general_type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tyre_details`
--

CREATE TABLE `vehicle_tyre_details` (
  `tyre_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `LR_side` varchar(10) DEFAULT NULL,
  `FB_side` varchar(10) DEFAULT NULL,
  `starting_odometer` varchar(45) DEFAULT NULL,
  `odometer_limit` varchar(45) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `alert_date` date DEFAULT NULL,
  `alert_status` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `subdealer_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_admin_alerts`
-- (See below for the actual view)
--
CREATE TABLE `view_admin_alerts` (
`id` int(11)
,`vehicle_id` bigint(20)
,`lat` double
,`lng` double
,`geo_location_name` varchar(45)
,`date_time` datetime
,`createddate` timestamp
,`vehiclename` varchar(30)
,`vehicle_register_number` varchar(30)
,`client_id` int(6)
,`all_status` smallint(11)
,`show_status` smallint(11)
,`alert_type` varchar(450)
,`alert_location` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_owner_alerts`
-- (See below for the actual view)
--
CREATE TABLE `view_owner_alerts` (
`id` int(11)
,`vehicle_id` bigint(20)
,`lat` double
,`lng` double
,`geo_location_name` varchar(45)
,`date_time` datetime
,`createddate` timestamp
,`vehicle_name` varchar(30)
,`vehiclemodel` varchar(30)
,`client_id` int(6)
,`all_status` smallint(11)
,`show_status` smallint(11)
,`alert_type` varchar(450)
,`alert_location` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_owner_name`
-- (See below for the actual view)
--
CREATE TABLE `view_owner_name` (
`owner_id` int(5)
,`owner_name` varchar(50)
,`client_id` int(4)
,`status` smallint(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_vehicles`
-- (See below for the actual view)
--
CREATE TABLE `view_vehicles` (
`vehicle_sleep` tinyint(4)
,`vehicle_id` bigint(20)
,`vehicle_register_number` varchar(30)
,`vehicle_model` varchar(30)
,`vehicletype` smallint(6)
,`vehicle_name` varchar(30)
,`activecode` tinyint(4)
,`client_id` int(6)
,`createdon` datetime
,`createdby` int(6)
,`acc_on` tinyint(4)
,`acc_date_time` datetime
,`temperature` varchar(30)
,`temperature_date_time` datetime
,`acc_flag` tinyint(4)
,`help_me_alert_date` datetime
,`lat` double
,`angle` double
,`lng` double
,`low_battery_date` datetime
,`low_battery_flag` tinyint(4)
,`v_running_no` bigint(20)
,`keyword` varchar(30)
,`help_me_alert` varchar(30)
,`updatedon` datetime
,`last_ign_off` datetime
,`last_ign_on` datetime
,`vehicle_type` smallint(6)
,`speed` double
,`lastkm` varchar(30)
,`fueltank` varchar(30)
,`meter` double
,`ac_flag` tinyint(4)
,`ac_date` datetime
,`today_km` double
,`fuel_ltr` double
,`litres` double
,`car_battery` double
,`mileage` double
,`fuel_tank_capacity` int(11)
,`today_fuel_usage` int(11)
,`driver_name` varchar(100)
,`hour` varchar(10)
,`ofline_time` bigint(21)
,`odometer` double
,`hub_ETA` varchar(30)
,`mdvr_trml_with_servr` tinyint(4)
,`mdvr_terminal_no` bigint(20)
,`device_type` tinyint(4)
,`latlon_address` varchar(2000)
,`idle_alerttime` tinyint(4)
,`parking_alerttime` int(11)
,`fuel_fill_limit` double
,`fuel_dip_limit` float
,`overspeed_limit` int(11)
,`sim_number` varchar(20)
,`internal_battery_voltage` double
,`alarm_set` varchar(30)
,`last_engine_duration` longtext
,`today_engine_duration` varchar(50)
,`temp_min` float
,`temp_max` float
);

-- --------------------------------------------------------

--
-- Table structure for table `zigma_plantrip`
--

CREATE TABLE `zigma_plantrip` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicleid` int(11) DEFAULT NULL,
  `start_location` int(11) DEFAULT NULL,
  `end_location` int(11) DEFAULT NULL,
  `poc_number` varchar(30) NOT NULL,
  `pl_start_date` datetime DEFAULT NULL,
  `pl_end_date` datetime DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zigma_plantrip_report`
--

CREATE TABLE `zigma_plantrip_report` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vehicle_name` varchar(40) NOT NULL,
  `start_geo_id` int(11) NOT NULL,
  `end_geo_id` int(11) DEFAULT NULL,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double DEFAULT NULL,
  `s_lat` double NOT NULL,
  `s_lng` double NOT NULL,
  `start_location` longtext NOT NULL,
  `e_lat` double NOT NULL,
  `e_lng` double NOT NULL,
  `end_location` longtext NOT NULL,
  `flag` smallint(6) NOT NULL DEFAULT '1',
  `create_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zigma_plantrip_report1`
--

CREATE TABLE `zigma_plantrip_report1` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vehicle_name` varchar(40) NOT NULL,
  `start_geo_id` int(11) NOT NULL,
  `end_geo_id` int(11) DEFAULT NULL,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double DEFAULT NULL,
  `s_lat` double NOT NULL,
  `s_lng` double NOT NULL,
  `start_location` longtext NOT NULL,
  `e_lat` double NOT NULL,
  `e_lng` double NOT NULL,
  `end_location` longtext NOT NULL,
  `flag` smallint(6) NOT NULL DEFAULT '1',
  `create_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zigma_weighbride_data`
--

CREATE TABLE `zigma_weighbride_data` (
  `id` int(11) NOT NULL,
  `ticket_no` varchar(50) DEFAULT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `emptydatetime` datetime DEFAULT NULL,
  `loaddatetime` datetime DEFAULT NULL,
  `vehicletype` varchar(30) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `material_name` varchar(100) DEFAULT NULL,
  `transporter_name` varchar(100) DEFAULT NULL,
  `length` varchar(30) DEFAULT NULL,
  `breadth` varchar(30) DEFAULT NULL,
  `height` varchar(30) DEFAULT NULL,
  `emptywt` double DEFAULT NULL,
  `loadwt` double DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `density` int(11) DEFAULT NULL,
  `el_image_front` varchar(100) DEFAULT NULL,
  `el_image_back` varchar(300) DEFAULT NULL,
  `wl_image_front` varchar(300) DEFAULT NULL,
  `wl_image_back` varchar(300) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdon` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(11) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `view_admin_alerts`
--
DROP TABLE IF EXISTS `view_admin_alerts`;

CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_admin_alerts`  AS  select `sl`.`sms_alert_id` AS `id`,`v`.`deviceimei` AS `vehicle_id`,`sl`.`lat` AS `lat`,`sl`.`lng` AS `lng`,`sl`.`geo_location_name` AS `geo_location_name`,`sl`.`createdon` AS `date_time`,`sl`.`createddate` AS `createddate`,`v`.`vehiclename` AS `vehiclename`,`v`.`vehiclemodel` AS `vehicle_register_number`,`v`.`client_id` AS `client_id`,`sl`.`all_status` AS `all_status`,`sl`.`show_status` AS `show_status`,`att`.`alert_type` AS `alert_type`,`sl`.`alert_location` AS `alert_location` from (((`sms_alert` `sl` join `alter_contacts` `al` on(((`al`.`client_id` = `sl`.`client_id`) and ((`sl`.`all_status` = `al`.`ac_on`) or (`sl`.`all_status` = `al`.`ac_off`) or (`sl`.`all_status` = `al`.`ignition_on`) or (`sl`.`all_status` = `al`.`sos_alert`) or (`sl`.`all_status` = `al`.`ignition_off`) or (`sl`.`all_status` = `al`.`speed_alert`) or (`sl`.`all_status` = `al`.`geo_fence_in_circle`) or (`sl`.`all_status` = `al`.`geo_fence_out_circle`) or (`sl`.`all_status` = `al`.`harsh_acceleration`) or (`sl`.`all_status` = `al`.`idle`) or (`sl`.`all_status` = `al`.`harsh_braking`) or (`sl`.`all_status` = `al`.`harsh_cornering`) or (`sl`.`all_status` = `al`.`speed_breaker_bump`) or (`sl`.`all_status` = `al`.`accident`) or (`sl`.`all_status` = `al`.`fuel_dip`) or (`sl`.`all_status` = `al`.`fuel_fill`))))) join `vehicletbl` `v` on((`v`.`vehicleid` = `sl`.`vehicle_id`))) join `alert_type` `att` on((`att`.`alert_type_id` = `sl`.`all_status`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_owner_alerts`
--
DROP TABLE IF EXISTS `view_owner_alerts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_owner_alerts`  AS  select `sl`.`sms_alert_id` AS `id`,`v`.`deviceimei` AS `vehicle_id`,`sl`.`lat` AS `lat`,`sl`.`lng` AS `lng`,`sl`.`geo_location_name` AS `geo_location_name`,`sl`.`createdon` AS `date_time`,`sl`.`createddate` AS `createddate`,`v`.`vehiclename` AS `vehicle_name`,`v`.`vehiclemodel` AS `vehiclemodel`,`v`.`client_id` AS `client_id`,`sl`.`all_status` AS `all_status`,`sl`.`show_status` AS `show_status`,`att`.`alert_type` AS `alert_type`,`sl`.`alert_location` AS `alert_location` from (((`alter_contacts` `al` join `sms_alert` `sl` on(((`al`.`client_id` = `sl`.`client_id`) and ((`sl`.`all_status` = `al`.`ac_on`) or (`sl`.`all_status` = `al`.`ac_off`) or (`sl`.`all_status` = `al`.`ignition_on`) or (`sl`.`all_status` = `al`.`sos_alert`) or (`sl`.`all_status` = `al`.`ignition_off`) or (`sl`.`all_status` = `al`.`speed_alert`) or (`sl`.`all_status` = `al`.`geo_fence_in_circle`) or (`sl`.`all_status` = `al`.`geo_fence_out_circle`) or (`sl`.`all_status` = `al`.`harsh_acceleration`) or (`sl`.`all_status` = `al`.`idle`) or (`sl`.`all_status` = `al`.`harsh_braking`) or (`sl`.`all_status` = `al`.`harsh_cornering`) or (`sl`.`all_status` = `al`.`speed_breaker_bump`) or (`sl`.`all_status` = `al`.`accident`) or (`sl`.`all_status` = `al`.`fuel_dip`) or (`sl`.`all_status` = `al`.`fuel_fill`))))) join `vehicletbl` `v` on((`v`.`vehicleid` = `sl`.`vehicle_id`))) join `alert_type` `att` on((`att`.`alert_type_id` = `sl`.`all_status`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_owner_name`
--
DROP TABLE IF EXISTS `view_owner_name`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_owner_name`  AS  select `usertbl`.`userid` AS `owner_id`,`usertbl`.`firstname` AS `owner_name`,`usertbl`.`client_id` AS `client_id`,`usertbl`.`status` AS `status` from `usertbl` where (`usertbl`.`roleid` = '6') ;

-- --------------------------------------------------------

--
-- Structure for view `view_vehicles`
--
DROP TABLE IF EXISTS `view_vehicles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_vehicles`  AS  select `vehicletbl`.`vehicle_sleep` AS `vehicle_sleep`,`vehicletbl`.`deviceimei` AS `vehicle_id`,`vehicletbl`.`vehiclename` AS `vehicle_register_number`,`vehicletbl`.`vehiclemodel` AS `vehicle_model`,`vehicletbl`.`vehicletype` AS `vehicletype`,`vehicletbl`.`vehiclename` AS `vehicle_name`,`vehicletbl`.`status` AS `activecode`,`vehicletbl`.`client_id` AS `client_id`,`vehicletbl`.`createdon` AS `createdon`,`vehicletbl`.`createdby` AS `createdby`,`vehicletbl`.`acc_on` AS `acc_on`,`vehicletbl`.`acc_date_time` AS `acc_date_time`,`vehicletbl`.`temperature` AS `temperature`,`vehicletbl`.`temperature_date_time` AS `temperature_date_time`,`vehicletbl`.`acc_flag` AS `acc_flag`,`vehicletbl`.`help_me_alert_date` AS `help_me_alert_date`,`vehicletbl`.`lat` AS `lat`,`vehicletbl`.`angle` AS `angle`,`vehicletbl`.`lng` AS `lng`,`vehicletbl`.`low_battery_date` AS `low_battery_date`,`vehicletbl`.`low_battery_flag` AS `low_battery_flag`,`vehicletbl`.`deviceimei` AS `v_running_no`,`vehicletbl`.`keyword` AS `keyword`,`vehicletbl`.`help_me_alert` AS `help_me_alert`,`vehicletbl`.`updatedon` AS `updatedon`,`vehicletbl`.`last_ign_off` AS `last_ign_off`,`vehicletbl`.`last_ign_on` AS `last_ign_on`,`vehicletbl`.`vehicletype` AS `vehicle_type`,`vehicletbl`.`speed` AS `speed`,`vehicletbl`.`last` AS `lastkm`,`vehicletbl`.`fueltank` AS `fueltank`,`vehicletbl`.`meter` AS `meter`,`vehicletbl`.`ac_flag` AS `ac_flag`,`vehicletbl`.`ac_date` AS `ac_date`,`vehicletbl`.`today_km` AS `today_km`,`vehicletbl`.`litres` AS `fuel_ltr`,`vehicletbl`.`litres` AS `litres`,`vehicletbl`.`car_battery` AS `car_battery`,`vehicletbl`.`mileage` AS `mileage`,`vehicletbl`.`fuel_tank_capacity` AS `fuel_tank_capacity`,`vehicletbl`.`today_fuel_usage` AS `today_fuel_usage`,`vehicletbl`.`driver_name` AS `driver_name`,concat('',sec_to_time(`vehicletbl`.`updatedon`)) AS `hour`,timestampdiff(SECOND,`vehicletbl`.`updatedon`,now()) AS `ofline_time`,`vehicletbl`.`odometer` AS `odometer`,`vehicletbl`.`hub_ETA` AS `hub_ETA`,`vehicletbl`.`mdvr_status` AS `mdvr_trml_with_servr`,`vehicletbl`.`mdvr_terminal_no` AS `mdvr_terminal_no`,`vehicletbl`.`device_type` AS `device_type`,`vehicletbl`.`latlon_address` AS `latlon_address`,`vehicletbl`.`bunk_status` AS `idle_alerttime`,`vehicletbl`.`parking_alerttime` AS `parking_alerttime`,`vehicletbl`.`fuel_limit` AS `fuel_fill_limit`,`vehicletbl`.`fuel_dip_ltr` AS `fuel_dip_limit`,`vehicletbl`.`speed_limit` AS `overspeed_limit`,`vehicletbl`.`simnumber` AS `sim_number`,`vehicletbl`.`internal_battery_voltage` AS `internal_battery_voltage`,`vehicletbl`.`unique_id` AS `alarm_set`,`vehicletbl`.`remarks` AS `last_engine_duration`,`vehicletbl`.`ibutton_receiver` AS `today_engine_duration`,`vehicletbl`.`temp_low` AS `temp_min`,`vehicletbl`.`temp_high` AS `temp_max` from `vehicletbl` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesspriviledge`
--
ALTER TABLE `accesspriviledge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_report`
--
ALTER TABLE `ac_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `start_day` (`start_day`);

--
-- Indexes for table `add_liveroute_list`
--
ALTER TABLE `add_liveroute_list`
  ADD PRIMARY KEY (`live_routeid`);

--
-- Indexes for table `add_livestop_list`
--
ALTER TABLE `add_livestop_list`
  ADD PRIMARY KEY (`live_stopid`);

--
-- Indexes for table `alert_AIS`
--
ALTER TABLE `alert_AIS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IMEI` (`IMEI`);

--
-- Indexes for table `alert_rp01`
--
ALTER TABLE `alert_rp01`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `alert_stx`
--
ALTER TABLE `alert_stx`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `alert_type`
--
ALTER TABLE `alert_type`
  ADD PRIMARY KEY (`alert_type_id`);

--
-- Indexes for table `alter_contacts`
--
ALTER TABLE `alter_contacts`
  ADD PRIMARY KEY (`alter_contacts_id`),
  ADD KEY `school_id_idx` (`client_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `alter_contacts_id` (`alter_contacts_id`);

--
-- Indexes for table `apikey`
--
ALTER TABLE `apikey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_geo_fenceing`
--
ALTER TABLE `assign_geo_fenceing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `vehicle_id` (`vehicle_id`,`geo_location_id`);

--
-- Indexes for table `assign_hubpoint`
--
ALTER TABLE `assign_hubpoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_ibuttontbl`
--
ALTER TABLE `assign_ibuttontbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_owner`
--
ALTER TABLE `assign_owner`
  ADD PRIMARY KEY (`assign_owner_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `owner_id_2` (`owner_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `assign_polygon`
--
ALTER TABLE `assign_polygon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `battery_report`
--
ALTER TABLE `battery_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_on` (`created_on`);

--
-- Indexes for table `bookinglocation_list`
--
ALTER TABLE `bookinglocation_list`
  ADD PRIMARY KEY (`Location_Id`);

--
-- Indexes for table `bookingtrip`
--
ALTER TABLE `bookingtrip`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `bookingtrip_livedetails`
--
ALTER TABLE `bookingtrip_livedetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_imei` (`vehicle_imei`);

--
-- Indexes for table `bookingtrip_report`
--
ALTER TABLE `bookingtrip_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `booking_supplier`
--
ALTER TABLE `booking_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_polygonlist`
--
ALTER TABLE `check_polygonlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clienttbl`
--
ALTER TABLE `clienttbl`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `consolidate_ac_report`
--
ALTER TABLE `consolidate_ac_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_distance_report`
--
ALTER TABLE `consolidate_distance_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_fuelcosumed_report`
--
ALTER TABLE `consolidate_fuelcosumed_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_fueldip_report`
--
ALTER TABLE `consolidate_fueldip_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_fuelfill_report`
--
ALTER TABLE `consolidate_fuelfill_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_idle_report`
--
ALTER TABLE `consolidate_idle_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_ign_report`
--
ALTER TABLE `consolidate_ign_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_loadrpm_report`
--
ALTER TABLE `consolidate_loadrpm_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_normalrpm_report`
--
ALTER TABLE `consolidate_normalrpm_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_overloadrpm_report`
--
ALTER TABLE `consolidate_overloadrpm_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_park_report`
--
ALTER TABLE `consolidate_park_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `consolidate_rpm_report`
--
ALTER TABLE `consolidate_rpm_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_complaint`
--
ALTER TABLE `customer_complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_stx`
--
ALTER TABLE `db_stx`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `dealertbl`
--
ALTER TABLE `dealertbl`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `dealer_price_list`
--
ALTER TABLE `dealer_price_list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `dealer_tokens`
--
ALTER TABLE `dealer_tokens`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `devicemodeltbl`
--
ALTER TABLE `devicemodeltbl`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `devicetbl`
--
ALTER TABLE `devicetbl`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `device_model`
--
ALTER TABLE `device_model`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `discounttbl`
--
ALTER TABLE `discounttbl`
  ADD PRIMARY KEY (`discountid`);

--
-- Indexes for table `drivertbl`
--
ALTER TABLE `drivertbl`
  ADD PRIMARY KEY (`driverid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enginerpm_status`
--
ALTER TABLE `enginerpm_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `engine_rpms`
--
ALTER TABLE `engine_rpms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index 2` (`deviceimei`);

--
-- Indexes for table `executive_report_chk`
--
ALTER TABLE `executive_report_chk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fueldata_smooth`
--
ALTER TABLE `fueldata_smooth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`),
  ADD KEY `flag` (`flag`),
  ADD KEY `running_no_2` (`running_no`,`modified_date`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no_3` (`running_no`,`flag`);

--
-- Indexes for table `fueltanktbl`
--
ALTER TABLE `fueltanktbl`
  ADD PRIMARY KEY (`fueltankid`);

--
-- Indexes for table `fuel_analog`
--
ALTER TABLE `fuel_analog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`),
  ADD KEY `flag` (`flag`),
  ADD KEY `modified_date` (`modified_date`);

--
-- Indexes for table `fuel_escort_ble`
--
ALTER TABLE `fuel_escort_ble`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `fuel_fill_dip_report`
--
ALTER TABLE `fuel_fill_dip_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_on` (`created_on`);

--
-- Indexes for table `fuel_fill_dip_report_bk`
--
ALTER TABLE `fuel_fill_dip_report_bk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_on` (`created_on`);

--
-- Indexes for table `fuel_italon`
--
ALTER TABLE `fuel_italon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`),
  ADD KEY `flag` (`flag`),
  ADD KEY `modified_date` (`modified_date`);

--
-- Indexes for table `fuel_management`
--
ALTER TABLE `fuel_management`
  ADD PRIMARY KEY (`fuel_management_id`);

--
-- Indexes for table `fuel_status`
--
ALTER TABLE `fuel_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`),
  ADD KEY `flag` (`flag`),
  ADD KEY `running_no_2` (`running_no`,`flag`),
  ADD KEY `running_no_3` (`running_no`,`modified_date`),
  ADD KEY `running_no_4` (`running_no`,`flag`,`modified_date`),
  ADD KEY `modified_date` (`modified_date`);

--
-- Indexes for table `fuel_status_011922`
--
ALTER TABLE `fuel_status_011922`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no_2` (`running_no`,`modified_date`),
  ADD KEY `running_no_3` (`running_no`,`flag`),
  ADD KEY `running_no` (`running_no`),
  ADD KEY `flag` (`flag`),
  ADD KEY `running_no_4` (`running_no`,`flag`,`modified_date`),
  ADD KEY `modified_date` (`modified_date`);

--
-- Indexes for table `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`fuel_type_id`);

--
-- Indexes for table `geofence_report`
--
ALTER TABLE `geofence_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grouptbl`
--
ALTER TABLE `grouptbl`
  ADD PRIMARY KEY (`groupid`);

--
-- Indexes for table `health_status`
--
ALTER TABLE `health_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `historytbl`
--
ALTER TABLE `historytbl`
  ADD PRIMARY KEY (`historyid`);

--
-- Indexes for table `hubpoint_location`
--
ALTER TABLE `hubpoint_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hub_report`
--
ALTER TABLE `hub_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ibuttontbl`
--
ALTER TABLE `ibuttontbl`
  ADD PRIMARY KEY (`ibuttonid`);

--
-- Indexes for table `idle_report`
--
ALTER TABLE `idle_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `Idevice_no_flag` (`device_no`,`flag`);

--
-- Indexes for table `immoblizer_data`
--
ALTER TABLE `immoblizer_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance_reminder`
--
ALTER TABLE `insurance_reminder`
  ADD PRIMARY KEY (`insurance_reminder_id`);

--
-- Indexes for table `i_button_details`
--
ALTER TABLE `i_button_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `i_button_livedata`
--
ALTER TABLE `i_button_livedata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `current_datetime` (`current_datetime`),
  ADD KEY `ibutton_id` (`ibutton_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `logged_datetime` (`logged_datetime`);

--
-- Indexes for table `i_button_report`
--
ALTER TABLE `i_button_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `load_rpm_report`
--
ALTER TABLE `load_rpm_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `start_day` (`start_day`);

--
-- Indexes for table `location_list`
--
ALTER TABLE `location_list`
  ADD PRIMARY KEY (`Location_Id`);

--
-- Indexes for table `new_location_history`
--
ALTER TABLE `new_location_history`
  ADD KEY `running_no_3` (`running_no`,`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `nodata_vehicle`
--
ALTER TABLE `nodata_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `normal_rpm_report`
--
ALTER TABLE `normal_rpm_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `start_day` (`start_day`);

--
-- Indexes for table `notification_alert`
--
ALTER TABLE `notification_alert`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `omni_distance_data`
--
ALTER TABLE `omni_distance_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overload_rpm_report`
--
ALTER TABLE `overload_rpm_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `start_day` (`start_day`);

--
-- Indexes for table `parking_report`
--
ALTER TABLE `parking_report`
  ADD PRIMARY KEY (`report_id`,`client_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `flags` (`flag`,`s_lat`,`s_lng`,`start_day`,`end_day`),
  ADD KEY `type_id` (`type_id`,`total_km`,`e_lat`,`e_lng`,`ignition`,`update_status`,`start_location`,`end_location`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `flag` (`flag`,`device_no`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `paymenttbl`
--
ALTER TABLE `paymenttbl`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `play_back_history`
--
ALTER TABLE `play_back_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`),
  ADD KEY `index_id` (`id`) USING BTREE,
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `play_back_history_0`
--
ALTER TABLE `play_back_history_0`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_1`
--
ALTER TABLE `play_back_history_1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_2`
--
ALTER TABLE `play_back_history_2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_3`
--
ALTER TABLE `play_back_history_3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_5`
--
ALTER TABLE `play_back_history_5`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_7`
--
ALTER TABLE `play_back_history_7`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_9`
--
ALTER TABLE `play_back_history_9`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_17`
--
ALTER TABLE `play_back_history_17`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_18`
--
ALTER TABLE `play_back_history_18`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_19`
--
ALTER TABLE `play_back_history_19`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_20`
--
ALTER TABLE `play_back_history_20`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_21`
--
ALTER TABLE `play_back_history_21`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_25`
--
ALTER TABLE `play_back_history_25`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_26`
--
ALTER TABLE `play_back_history_26`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_27`
--
ALTER TABLE `play_back_history_27`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_28`
--
ALTER TABLE `play_back_history_28`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_30`
--
ALTER TABLE `play_back_history_30`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_32`
--
ALTER TABLE `play_back_history_32`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_35`
--
ALTER TABLE `play_back_history_35`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_36`
--
ALTER TABLE `play_back_history_36`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_37`
--
ALTER TABLE `play_back_history_37`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_49`
--
ALTER TABLE `play_back_history_49`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_50`
--
ALTER TABLE `play_back_history_50`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_51`
--
ALTER TABLE `play_back_history_51`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_53`
--
ALTER TABLE `play_back_history_53`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_60`
--
ALTER TABLE `play_back_history_60`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_65`
--
ALTER TABLE `play_back_history_65`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_67`
--
ALTER TABLE `play_back_history_67`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_69`
--
ALTER TABLE `play_back_history_69`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_71`
--
ALTER TABLE `play_back_history_71`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_73`
--
ALTER TABLE `play_back_history_73`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_77`
--
ALTER TABLE `play_back_history_77`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_78`
--
ALTER TABLE `play_back_history_78`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_87`
--
ALTER TABLE `play_back_history_87`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_89`
--
ALTER TABLE `play_back_history_89`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_91`
--
ALTER TABLE `play_back_history_91`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_92`
--
ALTER TABLE `play_back_history_92`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_94`
--
ALTER TABLE `play_back_history_94`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_102`
--
ALTER TABLE `play_back_history_102`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_103`
--
ALTER TABLE `play_back_history_103`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_114`
--
ALTER TABLE `play_back_history_114`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_117`
--
ALTER TABLE `play_back_history_117`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_119`
--
ALTER TABLE `play_back_history_119`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_120`
--
ALTER TABLE `play_back_history_120`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_121`
--
ALTER TABLE `play_back_history_121`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_122`
--
ALTER TABLE `play_back_history_122`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_124`
--
ALTER TABLE `play_back_history_124`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_126`
--
ALTER TABLE `play_back_history_126`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_127`
--
ALTER TABLE `play_back_history_127`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_128`
--
ALTER TABLE `play_back_history_128`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_130`
--
ALTER TABLE `play_back_history_130`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_132`
--
ALTER TABLE `play_back_history_132`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_134`
--
ALTER TABLE `play_back_history_134`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_137`
--
ALTER TABLE `play_back_history_137`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_138`
--
ALTER TABLE `play_back_history_138`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_140`
--
ALTER TABLE `play_back_history_140`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_141`
--
ALTER TABLE `play_back_history_141`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_143`
--
ALTER TABLE `play_back_history_143`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_144`
--
ALTER TABLE `play_back_history_144`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_147`
--
ALTER TABLE `play_back_history_147`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_150`
--
ALTER TABLE `play_back_history_150`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_154`
--
ALTER TABLE `play_back_history_154`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_156`
--
ALTER TABLE `play_back_history_156`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_157`
--
ALTER TABLE `play_back_history_157`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_159`
--
ALTER TABLE `play_back_history_159`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_160`
--
ALTER TABLE `play_back_history_160`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_161`
--
ALTER TABLE `play_back_history_161`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_162`
--
ALTER TABLE `play_back_history_162`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_163`
--
ALTER TABLE `play_back_history_163`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_164`
--
ALTER TABLE `play_back_history_164`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_166`
--
ALTER TABLE `play_back_history_166`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_167`
--
ALTER TABLE `play_back_history_167`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_168`
--
ALTER TABLE `play_back_history_168`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_169`
--
ALTER TABLE `play_back_history_169`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_170`
--
ALTER TABLE `play_back_history_170`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_171`
--
ALTER TABLE `play_back_history_171`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_172`
--
ALTER TABLE `play_back_history_172`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_173`
--
ALTER TABLE `play_back_history_173`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_174`
--
ALTER TABLE `play_back_history_174`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_175`
--
ALTER TABLE `play_back_history_175`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_177`
--
ALTER TABLE `play_back_history_177`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_178`
--
ALTER TABLE `play_back_history_178`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_180`
--
ALTER TABLE `play_back_history_180`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_182`
--
ALTER TABLE `play_back_history_182`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_183`
--
ALTER TABLE `play_back_history_183`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_184`
--
ALTER TABLE `play_back_history_184`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_185`
--
ALTER TABLE `play_back_history_185`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_186`
--
ALTER TABLE `play_back_history_186`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_189`
--
ALTER TABLE `play_back_history_189`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_198`
--
ALTER TABLE `play_back_history_198`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_200`
--
ALTER TABLE `play_back_history_200`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_201`
--
ALTER TABLE `play_back_history_201`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_202`
--
ALTER TABLE `play_back_history_202`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_203`
--
ALTER TABLE `play_back_history_203`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_204`
--
ALTER TABLE `play_back_history_204`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_205`
--
ALTER TABLE `play_back_history_205`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_206`
--
ALTER TABLE `play_back_history_206`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_207`
--
ALTER TABLE `play_back_history_207`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_208`
--
ALTER TABLE `play_back_history_208`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_209`
--
ALTER TABLE `play_back_history_209`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_210`
--
ALTER TABLE `play_back_history_210`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_211`
--
ALTER TABLE `play_back_history_211`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_212`
--
ALTER TABLE `play_back_history_212`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_213`
--
ALTER TABLE `play_back_history_213`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_214`
--
ALTER TABLE `play_back_history_214`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_215`
--
ALTER TABLE `play_back_history_215`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_216`
--
ALTER TABLE `play_back_history_216`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_217`
--
ALTER TABLE `play_back_history_217`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_218`
--
ALTER TABLE `play_back_history_218`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_219`
--
ALTER TABLE `play_back_history_219`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_220`
--
ALTER TABLE `play_back_history_220`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_221`
--
ALTER TABLE `play_back_history_221`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_222`
--
ALTER TABLE `play_back_history_222`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_223`
--
ALTER TABLE `play_back_history_223`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_224`
--
ALTER TABLE `play_back_history_224`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_227`
--
ALTER TABLE `play_back_history_227`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_228`
--
ALTER TABLE `play_back_history_228`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_229`
--
ALTER TABLE `play_back_history_229`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_230`
--
ALTER TABLE `play_back_history_230`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_231`
--
ALTER TABLE `play_back_history_231`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_232`
--
ALTER TABLE `play_back_history_232`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_237`
--
ALTER TABLE `play_back_history_237`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_242`
--
ALTER TABLE `play_back_history_242`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_245`
--
ALTER TABLE `play_back_history_245`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_247`
--
ALTER TABLE `play_back_history_247`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_248`
--
ALTER TABLE `play_back_history_248`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_250`
--
ALTER TABLE `play_back_history_250`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_251`
--
ALTER TABLE `play_back_history_251`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_253`
--
ALTER TABLE `play_back_history_253`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_260`
--
ALTER TABLE `play_back_history_260`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_261`
--
ALTER TABLE `play_back_history_261`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_262`
--
ALTER TABLE `play_back_history_262`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_265`
--
ALTER TABLE `play_back_history_265`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_276`
--
ALTER TABLE `play_back_history_276`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_277`
--
ALTER TABLE `play_back_history_277`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_279`
--
ALTER TABLE `play_back_history_279`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_280`
--
ALTER TABLE `play_back_history_280`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_281`
--
ALTER TABLE `play_back_history_281`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_283`
--
ALTER TABLE `play_back_history_283`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_284`
--
ALTER TABLE `play_back_history_284`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_285`
--
ALTER TABLE `play_back_history_285`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_286`
--
ALTER TABLE `play_back_history_286`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_287`
--
ALTER TABLE `play_back_history_287`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_288`
--
ALTER TABLE `play_back_history_288`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_289`
--
ALTER TABLE `play_back_history_289`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_290`
--
ALTER TABLE `play_back_history_290`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_291`
--
ALTER TABLE `play_back_history_291`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_292`
--
ALTER TABLE `play_back_history_292`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_293`
--
ALTER TABLE `play_back_history_293`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_294`
--
ALTER TABLE `play_back_history_294`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_295`
--
ALTER TABLE `play_back_history_295`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_296`
--
ALTER TABLE `play_back_history_296`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_298`
--
ALTER TABLE `play_back_history_298`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_306`
--
ALTER TABLE `play_back_history_306`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_307`
--
ALTER TABLE `play_back_history_307`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_308`
--
ALTER TABLE `play_back_history_308`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_309`
--
ALTER TABLE `play_back_history_309`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_310`
--
ALTER TABLE `play_back_history_310`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_311`
--
ALTER TABLE `play_back_history_311`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_312`
--
ALTER TABLE `play_back_history_312`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_316`
--
ALTER TABLE `play_back_history_316`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_317`
--
ALTER TABLE `play_back_history_317`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_318`
--
ALTER TABLE `play_back_history_318`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_321`
--
ALTER TABLE `play_back_history_321`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_322`
--
ALTER TABLE `play_back_history_322`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_323`
--
ALTER TABLE `play_back_history_323`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_324`
--
ALTER TABLE `play_back_history_324`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_325`
--
ALTER TABLE `play_back_history_325`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_328`
--
ALTER TABLE `play_back_history_328`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_329`
--
ALTER TABLE `play_back_history_329`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_330`
--
ALTER TABLE `play_back_history_330`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_331`
--
ALTER TABLE `play_back_history_331`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_332`
--
ALTER TABLE `play_back_history_332`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_333`
--
ALTER TABLE `play_back_history_333`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_336`
--
ALTER TABLE `play_back_history_336`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_337`
--
ALTER TABLE `play_back_history_337`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_338`
--
ALTER TABLE `play_back_history_338`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_339`
--
ALTER TABLE `play_back_history_339`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_340`
--
ALTER TABLE `play_back_history_340`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_341`
--
ALTER TABLE `play_back_history_341`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_342`
--
ALTER TABLE `play_back_history_342`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_343`
--
ALTER TABLE `play_back_history_343`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_344`
--
ALTER TABLE `play_back_history_344`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_345`
--
ALTER TABLE `play_back_history_345`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_346`
--
ALTER TABLE `play_back_history_346`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_347`
--
ALTER TABLE `play_back_history_347`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_348`
--
ALTER TABLE `play_back_history_348`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_349`
--
ALTER TABLE `play_back_history_349`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_351`
--
ALTER TABLE `play_back_history_351`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_352`
--
ALTER TABLE `play_back_history_352`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_353`
--
ALTER TABLE `play_back_history_353`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_354`
--
ALTER TABLE `play_back_history_354`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_355`
--
ALTER TABLE `play_back_history_355`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_356`
--
ALTER TABLE `play_back_history_356`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_357`
--
ALTER TABLE `play_back_history_357`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_358`
--
ALTER TABLE `play_back_history_358`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_359`
--
ALTER TABLE `play_back_history_359`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_360`
--
ALTER TABLE `play_back_history_360`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_362`
--
ALTER TABLE `play_back_history_362`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_363`
--
ALTER TABLE `play_back_history_363`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_364`
--
ALTER TABLE `play_back_history_364`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `play_back_history_365`
--
ALTER TABLE `play_back_history_365`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `polygon_list`
--
ALTER TABLE `polygon_list`
  ADD PRIMARY KEY (`polygon_id`);

--
-- Indexes for table `polygon_report`
--
ALTER TABLE `polygon_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polygon_report1`
--
ALTER TABLE `polygon_report1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polygon_routelist`
--
ALTER TABLE `polygon_routelist`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `polygon_routes`
--
ALTER TABLE `polygon_routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `polygon_routestops`
--
ALTER TABLE `polygon_routestops`
  ADD PRIMARY KEY (`stop_id`);

--
-- Indexes for table `poly_route_list`
--
ALTER TABLE `poly_route_list`
  ADD PRIMARY KEY (`live_routeid`);

--
-- Indexes for table `poly_stop_list`
--
ALTER TABLE `poly_stop_list`
  ADD PRIMARY KEY (`live_stopid`);

--
-- Indexes for table `privillagestbl`
--
ALTER TABLE `privillagestbl`
  ADD PRIMARY KEY (`privillagesid`);

--
-- Indexes for table `ref_paymentmode`
--
ALTER TABLE `ref_paymentmode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renewaltbl`
--
ALTER TABLE `renewaltbl`
  ADD PRIMARY KEY (`renewalid`);

--
-- Indexes for table `roletbl`
--
ALTER TABLE `roletbl`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `routeassigntbl`
--
ALTER TABLE `routeassigntbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routestbl`
--
ALTER TABLE `routestbl`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `routestoptbl`
--
ALTER TABLE `routestoptbl`
  ADD PRIMARY KEY (`stop_id`);

--
-- Indexes for table `route_penalty_details`
--
ALTER TABLE `route_penalty_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_stop_report`
--
ALTER TABLE `route_stop_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_trip`
--
ALTER TABLE `route_trip`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `scl_class`
--
ALTER TABLE `scl_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `scl_section`
--
ALTER TABLE `scl_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simtbl`
--
ALTER TABLE `simtbl`
  ADD PRIMARY KEY (`simid`),
  ADD KEY `simnumber` (`simnumber`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `subdealer_id` (`subdealer_id`);

--
-- Indexes for table `smswebnotification`
--
ALTER TABLE `smswebnotification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_alert`
--
ALTER TABLE `sms_alert`
  ADD PRIMARY KEY (`sms_alert_id`),
  ADD KEY `createdon` (`createdon`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `dealer_id` (`dealer_id`,`subdealer_id`);

--
-- Indexes for table `statustbl`
--
ALTER TABLE `statustbl`
  ADD PRIMARY KEY (`statusid`);

--
-- Indexes for table `subdealertbl`
--
ALTER TABLE `subdealertbl`
  ADD PRIMARY KEY (`subdealer_id`);

--
-- Indexes for table `supportdevicetbl`
--
ALTER TABLE `supportdevicetbl`
  ADD PRIMARY KEY (`sdid`);

--
-- Indexes for table `temperature_status`
--
ALTER TABLE `temperature_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `modified_date` (`modified_date`);

--
-- Indexes for table `towing_play_back`
--
ALTER TABLE `towing_play_back`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `towing_report`
--
ALTER TABLE `towing_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `start_day_2` (`start_day`);

--
-- Indexes for table `trip_report`
--
ALTER TABLE `trip_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `flag` (`flag`,`device_no`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `device_no` (`device_no`);

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `vehicleliveupdationtbl`
--
ALTER TABLE `vehicleliveupdationtbl`
  ADD PRIMARY KEY (`livedataid`);

--
-- Indexes for table `vehicletbl`
--
ALTER TABLE `vehicletbl`
  ADD PRIMARY KEY (`vehicleid`),
  ADD KEY `deviceimei` (`deviceimei`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `vehicletbl_2`
--
ALTER TABLE `vehicletbl_2`
  ADD PRIMARY KEY (`vehicleid`),
  ADD KEY `deviceimei` (`deviceimei`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `vehicletypetbl`
--
ALTER TABLE `vehicletypetbl`
  ADD PRIMARY KEY (`vtype_id`);

--
-- Indexes for table `vehicle_expirelist`
--
ALTER TABLE `vehicle_expirelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_service`
--
ALTER TABLE `vehicle_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `vehicle_tyre_details`
--
ALTER TABLE `vehicle_tyre_details`
  ADD PRIMARY KEY (`tyre_id`);

--
-- Indexes for table `zigma_plantrip`
--
ALTER TABLE `zigma_plantrip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zigma_plantrip_report`
--
ALTER TABLE `zigma_plantrip_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zigma_plantrip_report1`
--
ALTER TABLE `zigma_plantrip_report1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zigma_weighbride_data`
--
ALTER TABLE `zigma_weighbride_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesspriviledge`
--
ALTER TABLE `accesspriviledge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ac_report`
--
ALTER TABLE `ac_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `add_liveroute_list`
--
ALTER TABLE `add_liveroute_list`
  MODIFY `live_routeid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `add_livestop_list`
--
ALTER TABLE `add_livestop_list`
  MODIFY `live_stopid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alert_AIS`
--
ALTER TABLE `alert_AIS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alert_rp01`
--
ALTER TABLE `alert_rp01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alert_stx`
--
ALTER TABLE `alert_stx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alert_type`
--
ALTER TABLE `alert_type`
  MODIFY `alert_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alter_contacts`
--
ALTER TABLE `alter_contacts`
  MODIFY `alter_contacts_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apikey`
--
ALTER TABLE `apikey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_geo_fenceing`
--
ALTER TABLE `assign_geo_fenceing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_hubpoint`
--
ALTER TABLE `assign_hubpoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_ibuttontbl`
--
ALTER TABLE `assign_ibuttontbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_owner`
--
ALTER TABLE `assign_owner`
  MODIFY `assign_owner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_polygon`
--
ALTER TABLE `assign_polygon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `battery_report`
--
ALTER TABLE `battery_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookinglocation_list`
--
ALTER TABLE `bookinglocation_list`
  MODIFY `Location_Id` int(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookingtrip`
--
ALTER TABLE `bookingtrip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookingtrip_livedetails`
--
ALTER TABLE `bookingtrip_livedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookingtrip_report`
--
ALTER TABLE `bookingtrip_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_supplier`
--
ALTER TABLE `booking_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_polygonlist`
--
ALTER TABLE `check_polygonlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clienttbl`
--
ALTER TABLE `clienttbl`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_ac_report`
--
ALTER TABLE `consolidate_ac_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_distance_report`
--
ALTER TABLE `consolidate_distance_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_fuelcosumed_report`
--
ALTER TABLE `consolidate_fuelcosumed_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_fueldip_report`
--
ALTER TABLE `consolidate_fueldip_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_fuelfill_report`
--
ALTER TABLE `consolidate_fuelfill_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_idle_report`
--
ALTER TABLE `consolidate_idle_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_ign_report`
--
ALTER TABLE `consolidate_ign_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_loadrpm_report`
--
ALTER TABLE `consolidate_loadrpm_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_normalrpm_report`
--
ALTER TABLE `consolidate_normalrpm_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_overloadrpm_report`
--
ALTER TABLE `consolidate_overloadrpm_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_park_report`
--
ALTER TABLE `consolidate_park_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consolidate_rpm_report`
--
ALTER TABLE `consolidate_rpm_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_complaint`
--
ALTER TABLE `customer_complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_stx`
--
ALTER TABLE `db_stx`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealertbl`
--
ALTER TABLE `dealertbl`
  MODIFY `dealer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_price_list`
--
ALTER TABLE `dealer_price_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_tokens`
--
ALTER TABLE `dealer_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devicemodeltbl`
--
ALTER TABLE `devicemodeltbl`
  MODIFY `model_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devicetbl`
--
ALTER TABLE `devicetbl`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_model`
--
ALTER TABLE `device_model`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounttbl`
--
ALTER TABLE `discounttbl`
  MODIFY `discountid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drivertbl`
--
ALTER TABLE `drivertbl`
  MODIFY `driverid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enginerpm_status`
--
ALTER TABLE `enginerpm_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `engine_rpms`
--
ALTER TABLE `engine_rpms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `executive_report_chk`
--
ALTER TABLE `executive_report_chk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fueldata_smooth`
--
ALTER TABLE `fueldata_smooth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fueltanktbl`
--
ALTER TABLE `fueltanktbl`
  MODIFY `fueltankid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_analog`
--
ALTER TABLE `fuel_analog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_escort_ble`
--
ALTER TABLE `fuel_escort_ble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_fill_dip_report`
--
ALTER TABLE `fuel_fill_dip_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_fill_dip_report_bk`
--
ALTER TABLE `fuel_fill_dip_report_bk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_italon`
--
ALTER TABLE `fuel_italon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_management`
--
ALTER TABLE `fuel_management`
  MODIFY `fuel_management_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_status`
--
ALTER TABLE `fuel_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_status_011922`
--
ALTER TABLE `fuel_status_011922`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `fuel_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `geofence_report`
--
ALTER TABLE `geofence_report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grouptbl`
--
ALTER TABLE `grouptbl`
  MODIFY `groupid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_status`
--
ALTER TABLE `health_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historytbl`
--
ALTER TABLE `historytbl`
  MODIFY `historyid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hubpoint_location`
--
ALTER TABLE `hubpoint_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hub_report`
--
ALTER TABLE `hub_report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ibuttontbl`
--
ALTER TABLE `ibuttontbl`
  MODIFY `ibuttonid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `idle_report`
--
ALTER TABLE `idle_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immoblizer_data`
--
ALTER TABLE `immoblizer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_reminder`
--
ALTER TABLE `insurance_reminder`
  MODIFY `insurance_reminder_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `i_button_details`
--
ALTER TABLE `i_button_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `i_button_livedata`
--
ALTER TABLE `i_button_livedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `i_button_report`
--
ALTER TABLE `i_button_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `load_rpm_report`
--
ALTER TABLE `load_rpm_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_list`
--
ALTER TABLE `location_list`
  MODIFY `Location_Id` int(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nodata_vehicle`
--
ALTER TABLE `nodata_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `normal_rpm_report`
--
ALTER TABLE `normal_rpm_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_alert`
--
ALTER TABLE `notification_alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `omni_distance_data`
--
ALTER TABLE `omni_distance_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `overload_rpm_report`
--
ALTER TABLE `overload_rpm_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_report`
--
ALTER TABLE `parking_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymenttbl`
--
ALTER TABLE `paymenttbl`
  MODIFY `paymentid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history`
--
ALTER TABLE `play_back_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_0`
--
ALTER TABLE `play_back_history_0`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_1`
--
ALTER TABLE `play_back_history_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_2`
--
ALTER TABLE `play_back_history_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_3`
--
ALTER TABLE `play_back_history_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_5`
--
ALTER TABLE `play_back_history_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_7`
--
ALTER TABLE `play_back_history_7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_9`
--
ALTER TABLE `play_back_history_9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_17`
--
ALTER TABLE `play_back_history_17`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_18`
--
ALTER TABLE `play_back_history_18`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_19`
--
ALTER TABLE `play_back_history_19`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_20`
--
ALTER TABLE `play_back_history_20`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_21`
--
ALTER TABLE `play_back_history_21`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_25`
--
ALTER TABLE `play_back_history_25`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_26`
--
ALTER TABLE `play_back_history_26`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_27`
--
ALTER TABLE `play_back_history_27`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_28`
--
ALTER TABLE `play_back_history_28`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_30`
--
ALTER TABLE `play_back_history_30`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_32`
--
ALTER TABLE `play_back_history_32`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_35`
--
ALTER TABLE `play_back_history_35`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_36`
--
ALTER TABLE `play_back_history_36`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_37`
--
ALTER TABLE `play_back_history_37`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_49`
--
ALTER TABLE `play_back_history_49`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_50`
--
ALTER TABLE `play_back_history_50`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_51`
--
ALTER TABLE `play_back_history_51`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_53`
--
ALTER TABLE `play_back_history_53`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_60`
--
ALTER TABLE `play_back_history_60`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_65`
--
ALTER TABLE `play_back_history_65`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_67`
--
ALTER TABLE `play_back_history_67`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_69`
--
ALTER TABLE `play_back_history_69`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_71`
--
ALTER TABLE `play_back_history_71`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_73`
--
ALTER TABLE `play_back_history_73`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_77`
--
ALTER TABLE `play_back_history_77`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_78`
--
ALTER TABLE `play_back_history_78`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_87`
--
ALTER TABLE `play_back_history_87`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_89`
--
ALTER TABLE `play_back_history_89`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_91`
--
ALTER TABLE `play_back_history_91`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_92`
--
ALTER TABLE `play_back_history_92`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_94`
--
ALTER TABLE `play_back_history_94`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_102`
--
ALTER TABLE `play_back_history_102`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_103`
--
ALTER TABLE `play_back_history_103`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_114`
--
ALTER TABLE `play_back_history_114`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_117`
--
ALTER TABLE `play_back_history_117`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_119`
--
ALTER TABLE `play_back_history_119`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_120`
--
ALTER TABLE `play_back_history_120`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_121`
--
ALTER TABLE `play_back_history_121`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_122`
--
ALTER TABLE `play_back_history_122`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_124`
--
ALTER TABLE `play_back_history_124`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_126`
--
ALTER TABLE `play_back_history_126`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_127`
--
ALTER TABLE `play_back_history_127`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_128`
--
ALTER TABLE `play_back_history_128`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_130`
--
ALTER TABLE `play_back_history_130`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_132`
--
ALTER TABLE `play_back_history_132`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_134`
--
ALTER TABLE `play_back_history_134`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_137`
--
ALTER TABLE `play_back_history_137`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_138`
--
ALTER TABLE `play_back_history_138`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_140`
--
ALTER TABLE `play_back_history_140`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_141`
--
ALTER TABLE `play_back_history_141`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_143`
--
ALTER TABLE `play_back_history_143`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_144`
--
ALTER TABLE `play_back_history_144`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_147`
--
ALTER TABLE `play_back_history_147`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_150`
--
ALTER TABLE `play_back_history_150`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_154`
--
ALTER TABLE `play_back_history_154`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_156`
--
ALTER TABLE `play_back_history_156`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_157`
--
ALTER TABLE `play_back_history_157`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_159`
--
ALTER TABLE `play_back_history_159`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_160`
--
ALTER TABLE `play_back_history_160`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_161`
--
ALTER TABLE `play_back_history_161`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_162`
--
ALTER TABLE `play_back_history_162`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_163`
--
ALTER TABLE `play_back_history_163`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_164`
--
ALTER TABLE `play_back_history_164`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_166`
--
ALTER TABLE `play_back_history_166`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_167`
--
ALTER TABLE `play_back_history_167`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_168`
--
ALTER TABLE `play_back_history_168`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_169`
--
ALTER TABLE `play_back_history_169`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_170`
--
ALTER TABLE `play_back_history_170`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_171`
--
ALTER TABLE `play_back_history_171`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_172`
--
ALTER TABLE `play_back_history_172`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_173`
--
ALTER TABLE `play_back_history_173`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_174`
--
ALTER TABLE `play_back_history_174`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_175`
--
ALTER TABLE `play_back_history_175`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_177`
--
ALTER TABLE `play_back_history_177`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_178`
--
ALTER TABLE `play_back_history_178`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_180`
--
ALTER TABLE `play_back_history_180`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_182`
--
ALTER TABLE `play_back_history_182`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_183`
--
ALTER TABLE `play_back_history_183`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_184`
--
ALTER TABLE `play_back_history_184`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_185`
--
ALTER TABLE `play_back_history_185`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_186`
--
ALTER TABLE `play_back_history_186`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_189`
--
ALTER TABLE `play_back_history_189`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_198`
--
ALTER TABLE `play_back_history_198`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_200`
--
ALTER TABLE `play_back_history_200`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_201`
--
ALTER TABLE `play_back_history_201`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_202`
--
ALTER TABLE `play_back_history_202`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_203`
--
ALTER TABLE `play_back_history_203`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_204`
--
ALTER TABLE `play_back_history_204`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_205`
--
ALTER TABLE `play_back_history_205`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_206`
--
ALTER TABLE `play_back_history_206`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_207`
--
ALTER TABLE `play_back_history_207`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_208`
--
ALTER TABLE `play_back_history_208`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_209`
--
ALTER TABLE `play_back_history_209`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_210`
--
ALTER TABLE `play_back_history_210`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_211`
--
ALTER TABLE `play_back_history_211`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_212`
--
ALTER TABLE `play_back_history_212`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_213`
--
ALTER TABLE `play_back_history_213`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_214`
--
ALTER TABLE `play_back_history_214`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_215`
--
ALTER TABLE `play_back_history_215`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_216`
--
ALTER TABLE `play_back_history_216`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_217`
--
ALTER TABLE `play_back_history_217`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_218`
--
ALTER TABLE `play_back_history_218`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_219`
--
ALTER TABLE `play_back_history_219`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_220`
--
ALTER TABLE `play_back_history_220`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_221`
--
ALTER TABLE `play_back_history_221`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_222`
--
ALTER TABLE `play_back_history_222`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_223`
--
ALTER TABLE `play_back_history_223`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_224`
--
ALTER TABLE `play_back_history_224`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_227`
--
ALTER TABLE `play_back_history_227`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_228`
--
ALTER TABLE `play_back_history_228`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_229`
--
ALTER TABLE `play_back_history_229`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_230`
--
ALTER TABLE `play_back_history_230`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_231`
--
ALTER TABLE `play_back_history_231`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_232`
--
ALTER TABLE `play_back_history_232`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_237`
--
ALTER TABLE `play_back_history_237`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_242`
--
ALTER TABLE `play_back_history_242`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_245`
--
ALTER TABLE `play_back_history_245`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_247`
--
ALTER TABLE `play_back_history_247`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_248`
--
ALTER TABLE `play_back_history_248`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_250`
--
ALTER TABLE `play_back_history_250`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_251`
--
ALTER TABLE `play_back_history_251`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_253`
--
ALTER TABLE `play_back_history_253`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_260`
--
ALTER TABLE `play_back_history_260`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_261`
--
ALTER TABLE `play_back_history_261`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_262`
--
ALTER TABLE `play_back_history_262`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_265`
--
ALTER TABLE `play_back_history_265`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_276`
--
ALTER TABLE `play_back_history_276`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_277`
--
ALTER TABLE `play_back_history_277`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_279`
--
ALTER TABLE `play_back_history_279`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_280`
--
ALTER TABLE `play_back_history_280`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_281`
--
ALTER TABLE `play_back_history_281`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_283`
--
ALTER TABLE `play_back_history_283`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_284`
--
ALTER TABLE `play_back_history_284`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_285`
--
ALTER TABLE `play_back_history_285`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_286`
--
ALTER TABLE `play_back_history_286`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_287`
--
ALTER TABLE `play_back_history_287`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_288`
--
ALTER TABLE `play_back_history_288`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_289`
--
ALTER TABLE `play_back_history_289`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_290`
--
ALTER TABLE `play_back_history_290`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_291`
--
ALTER TABLE `play_back_history_291`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_292`
--
ALTER TABLE `play_back_history_292`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_293`
--
ALTER TABLE `play_back_history_293`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_294`
--
ALTER TABLE `play_back_history_294`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_295`
--
ALTER TABLE `play_back_history_295`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_296`
--
ALTER TABLE `play_back_history_296`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_298`
--
ALTER TABLE `play_back_history_298`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_306`
--
ALTER TABLE `play_back_history_306`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_307`
--
ALTER TABLE `play_back_history_307`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_308`
--
ALTER TABLE `play_back_history_308`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_309`
--
ALTER TABLE `play_back_history_309`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_310`
--
ALTER TABLE `play_back_history_310`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_311`
--
ALTER TABLE `play_back_history_311`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_312`
--
ALTER TABLE `play_back_history_312`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_316`
--
ALTER TABLE `play_back_history_316`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_317`
--
ALTER TABLE `play_back_history_317`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_318`
--
ALTER TABLE `play_back_history_318`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_321`
--
ALTER TABLE `play_back_history_321`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_322`
--
ALTER TABLE `play_back_history_322`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_323`
--
ALTER TABLE `play_back_history_323`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_324`
--
ALTER TABLE `play_back_history_324`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_325`
--
ALTER TABLE `play_back_history_325`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_328`
--
ALTER TABLE `play_back_history_328`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_329`
--
ALTER TABLE `play_back_history_329`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_330`
--
ALTER TABLE `play_back_history_330`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_331`
--
ALTER TABLE `play_back_history_331`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_332`
--
ALTER TABLE `play_back_history_332`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_333`
--
ALTER TABLE `play_back_history_333`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_336`
--
ALTER TABLE `play_back_history_336`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_337`
--
ALTER TABLE `play_back_history_337`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_338`
--
ALTER TABLE `play_back_history_338`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_339`
--
ALTER TABLE `play_back_history_339`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_340`
--
ALTER TABLE `play_back_history_340`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_341`
--
ALTER TABLE `play_back_history_341`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_342`
--
ALTER TABLE `play_back_history_342`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_343`
--
ALTER TABLE `play_back_history_343`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_344`
--
ALTER TABLE `play_back_history_344`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_345`
--
ALTER TABLE `play_back_history_345`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_346`
--
ALTER TABLE `play_back_history_346`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_347`
--
ALTER TABLE `play_back_history_347`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_348`
--
ALTER TABLE `play_back_history_348`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_349`
--
ALTER TABLE `play_back_history_349`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_351`
--
ALTER TABLE `play_back_history_351`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_352`
--
ALTER TABLE `play_back_history_352`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_353`
--
ALTER TABLE `play_back_history_353`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_354`
--
ALTER TABLE `play_back_history_354`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_355`
--
ALTER TABLE `play_back_history_355`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_356`
--
ALTER TABLE `play_back_history_356`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_357`
--
ALTER TABLE `play_back_history_357`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_358`
--
ALTER TABLE `play_back_history_358`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_359`
--
ALTER TABLE `play_back_history_359`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_360`
--
ALTER TABLE `play_back_history_360`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_362`
--
ALTER TABLE `play_back_history_362`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_363`
--
ALTER TABLE `play_back_history_363`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_364`
--
ALTER TABLE `play_back_history_364`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `play_back_history_365`
--
ALTER TABLE `play_back_history_365`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polygon_list`
--
ALTER TABLE `polygon_list`
  MODIFY `polygon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polygon_report`
--
ALTER TABLE `polygon_report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polygon_report1`
--
ALTER TABLE `polygon_report1`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polygon_routelist`
--
ALTER TABLE `polygon_routelist`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polygon_routes`
--
ALTER TABLE `polygon_routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polygon_routestops`
--
ALTER TABLE `polygon_routestops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poly_route_list`
--
ALTER TABLE `poly_route_list`
  MODIFY `live_routeid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poly_stop_list`
--
ALTER TABLE `poly_stop_list`
  MODIFY `live_stopid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privillagestbl`
--
ALTER TABLE `privillagestbl`
  MODIFY `privillagesid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_paymentmode`
--
ALTER TABLE `ref_paymentmode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renewaltbl`
--
ALTER TABLE `renewaltbl`
  MODIFY `renewalid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roletbl`
--
ALTER TABLE `roletbl`
  MODIFY `roleid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routeassigntbl`
--
ALTER TABLE `routeassigntbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routestbl`
--
ALTER TABLE `routestbl`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routestoptbl`
--
ALTER TABLE `routestoptbl`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_penalty_details`
--
ALTER TABLE `route_penalty_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_stop_report`
--
ALTER TABLE `route_stop_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_trip`
--
ALTER TABLE `route_trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scl_class`
--
ALTER TABLE `scl_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scl_section`
--
ALTER TABLE `scl_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simtbl`
--
ALTER TABLE `simtbl`
  MODIFY `simid` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smswebnotification`
--
ALTER TABLE `smswebnotification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_alert`
--
ALTER TABLE `sms_alert`
  MODIFY `sms_alert_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statustbl`
--
ALTER TABLE `statustbl`
  MODIFY `statusid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subdealertbl`
--
ALTER TABLE `subdealertbl`
  MODIFY `subdealer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supportdevicetbl`
--
ALTER TABLE `supportdevicetbl`
  MODIFY `sdid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temperature_status`
--
ALTER TABLE `temperature_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `towing_play_back`
--
ALTER TABLE `towing_play_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `towing_report`
--
ALTER TABLE `towing_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_report`
--
ALTER TABLE `trip_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicleliveupdationtbl`
--
ALTER TABLE `vehicleliveupdationtbl`
  MODIFY `livedataid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicletbl`
--
ALTER TABLE `vehicletbl`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicletbl_2`
--
ALTER TABLE `vehicletbl_2`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicletypetbl`
--
ALTER TABLE `vehicletypetbl`
  MODIFY `vtype_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_expirelist`
--
ALTER TABLE `vehicle_expirelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_service`
--
ALTER TABLE `vehicle_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_tyre_details`
--
ALTER TABLE `vehicle_tyre_details`
  MODIFY `tyre_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zigma_plantrip`
--
ALTER TABLE `zigma_plantrip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zigma_plantrip_report`
--
ALTER TABLE `zigma_plantrip_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zigma_plantrip_report1`
--
ALTER TABLE `zigma_plantrip_report1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zigma_weighbride_data`
--
ALTER TABLE `zigma_weighbride_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
