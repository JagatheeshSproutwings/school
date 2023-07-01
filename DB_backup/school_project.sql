-- Database: `school_project`
--
CREATE DATABASE IF NOT EXISTS `school_project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `school_project`;

-- --------------------------------------------------------

--
-- Table structure for table `EP_alert_AIS`
--

CREATE TABLE `EP_alert_AIS` (
  `id` int(11) NOT NULL,
  `header` varchar(255) DEFAULT NULL,
  `packet_type` varchar(10) DEFAULT NULL,
  `IMEI` varchar(255) DEFAULT NULL,
  `packet_status` varchar(10) DEFAULT NULL,
  `packet_date` datetime DEFAULT NULL,
  `GPS_fix` varchar(11) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `latitude_direction` varchar(10) DEFAULT NULL,
  `longtitude` varchar(20) DEFAULT NULL,
  `longtitude_direction` varchar(10) DEFAULT NULL,
  `altitude` float DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `provider` varchar(10) DEFAULT NULL,
  `vehicle_reg_no` varchar(50) DEFAULT NULL,
  `reply_number` varchar(20) DEFAULT NULL,
  `MCC` int(11) DEFAULT NULL,
  `MNC` int(11) DEFAULT NULL,
  `LAC` varchar(50) DEFAULT NULL,
  `cell_ID` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `View_Client_Geofence_api`
--
CREATE TABLE `View_Client_Geofence_api` (
`sms_alert_id` int(1)
,`client_id` int(1)
,`vehicle_id` int(1)
,`vehicle_name` int(1)
,`vehicle_number` int(1)
,`vehicle_register_number` int(1)
,`vehicle_model` int(1)
,`alert_type` int(1)
,`createdon` int(1)
,`lat` int(1)
,`lng` int(1)
,`geo_location_name` int(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `ac_report`
--

CREATE TABLE `ac_report` (
  `report_id` int(11) NOT NULL,
  `flag` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `vehicle_id` varchar(45) DEFAULT NULL,
  `total_km` varchar(45) DEFAULT NULL,
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
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
-- Table structure for table `access_privileges`
--

CREATE TABLE `access_privileges` (
  `access_privilege_id` int(45) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `activecode` int(11) NOT NULL,
  `generic` int(11) DEFAULT '1',
  `fuel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `access_privileges`
--

INSERT INTO `access_privileges` (`access_privilege_id`, `client_id`, `activecode`, `generic`, `fuel`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 1, 1, 1),
(3, 3, 1, 1, 1),
(4, 1, 1, 1, 0),
(5, 2, 1, 1, 0),
(6, 3, 1, 1, 0),
(7, 3, 1, 1, 0),
(8, 4, 1, 1, 0),
(9, 5, 1, 1, 0);

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

    SELECT vehicle_id,client_id,vehicle_name INTO @v_id,@c_id,@v_name FROM vehicle WHERE v_running_no = NEW.IMEI LIMIT 1;
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
					 
			ELSE BEGIN END;

END CASE;

END IF;
END IF; 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alert_av2_g19`
--

CREATE TABLE `alert_av2_g19` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) NOT NULL,
  `alert_type` varchar(20) NOT NULL,
  `speed` varchar(20) NOT NULL,
  `lat_message` varchar(150) NOT NULL,
  `lon_message` varchar(150) NOT NULL,
  `modified_date` varchar(150) NOT NULL,
  `created_date` varchar(150) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `packettype` varchar(20) DEFAULT NULL,
  `zap` longtext,
  `location_name` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alert_stx`
--

CREATE TABLE `alert_stx` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) NOT NULL,
  `alert_type` varchar(20) NOT NULL,
  `speed` varchar(20) NOT NULL,
  `lat_message` varchar(150) NOT NULL,
  `lon_message` varchar(150) NOT NULL,
  `modified_date` varchar(150) NOT NULL,
  `created_date` varchar(150) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `packettype` varchar(20) DEFAULT NULL,
  `zap` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `alert_stx`
--
DELIMITER $$
CREATE TRIGGER `add_sos_alert` AFTER INSERT ON `alert_stx` FOR EACH ROW BEGIN

    SELECT vehicle_id,client_id,vehicle_name INTO @v_id,@c_id,@v_name FROM vehicle WHERE v_running_no = NEW.running_no LIMIT 1;
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
  `alert_type` varchar(450) DEFAULT NULL
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
  `power_off` varchar(10) NOT NULL,
  `ac_on_sms` varchar(45) DEFAULT NULL,
  `ac_off_sms` varchar(45) DEFAULT NULL,
  `ignition_on_sms` varchar(45) DEFAULT NULL,
  `ignition_off_sms` varchar(45) DEFAULT NULL,
  `speed_alert_sms` varchar(45) DEFAULT NULL,
  `route_deviation_sms` varchar(45) DEFAULT NULL,
  `temperature_alert_sms` varchar(45) DEFAULT NULL,
  `sos_alert_sms` varchar(45) DEFAULT NULL,
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
  `client_id` varchar(45) DEFAULT NULL,
  `owner_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alter_contacts`
--

INSERT INTO `alter_contacts` (`alter_contacts_id`, `activecode`, `createdby`, `createdon`, `ac_on`, `ac_off`, `ignition_on`, `ignition_off`, `speed_alert`, `route_deviation`, `temperature_alert`, `sos_alert`, `geo_fence_in_circle`, `geo_fence_out_circle`, `harsh_acceleration`, `harsh_braking`, `harsh_cornering`, `speed_breaker_bump`, `accident`, `fuel_dip`, `fuel_fill`, `idle`, `power_off`, `ac_on_sms`, `ac_off_sms`, `ignition_on_sms`, `ignition_off_sms`, `speed_alert_sms`, `route_deviation_sms`, `temperature_alert_sms`, `sos_alert_sms`, `geo_fence_in_circle_sms`, `geo_fence_out_circle_sms`, `low_battery`, `low_battery_sms`, `harsh_acceleration_sms`, `harsh_braking_sms`, `harsh_cornering_sms`, `speed_breaker_bump_sms`, `accident_sms`, `box_open_sms`, `updatedby`, `updatedon`, `client_id`, `owner_id`) VALUES
(198, '1', '1', '2020-06-05 13:17:36', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '193', NULL),
(199, '1', '1', '2020-06-05 13:18:06', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '194', NULL),
(200, '1', '1', '2020-06-05 13:21:31', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '195', NULL),
(201, '1', '1', '2020-06-06 16:27:28', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL),
(202, '1', '1', '2020-06-08 13:01:01', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL),
(203, '1', '1', '2020-06-08 13:03:34', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL),
(204, '1', '1', '2020-06-22 16:15:34', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL),
(205, '1', '1', '2020-06-22 17:05:04', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL),
(206, '1', '1', '2020-07-01 13:09:52', '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apikey`
--

CREATE TABLE `apikey` (
  `id` int(11) NOT NULL,
  `apikey` varchar(250) NOT NULL,
  `status` int(10) NOT NULL,
  `version` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assign_deiver`
--

CREATE TABLE `assign_deiver` (
  `assign_driver_id` int(11) NOT NULL,
  `activecode` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `driver_id` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_device`
--

CREATE TABLE `assign_device` (
  `assign_device_id` int(11) NOT NULL,
  `device_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(45) DEFAULT NULL,
  `activecode` int(11) DEFAULT '1'
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
  `activecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assign_ibutton_client`
--

CREATE TABLE `assign_ibutton_client` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `ibutton_no` varchar(20) NOT NULL,
  `createddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `createdon` varchar(45) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `updatedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_trip_solution`
--

CREATE TABLE `assign_trip_solution` (
  `id` int(11) NOT NULL,
  `trip_location_id` varchar(10) NOT NULL,
  `vehicle_id` varchar(10) NOT NULL,
  `created_on` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `battery_report`
--

CREATE TABLE `battery_report` (
  `id` int(11) NOT NULL,
  `running_no` varchar(50) NOT NULL,
  `car_battery` double NOT NULL,
  `device_battery` double NOT NULL,
  `created_on` date NOT NULL,
  `createdon_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `class_name` varchar(40) NOT NULL,
  `class_createdby` int(11) NOT NULL,
  `class_createddate` datetime NOT NULL,
  `class_updatedby` int(11) NOT NULL,
  `class_updateddate` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `client_id`, `class_name`, `class_createdby`, `class_createddate`, `class_updatedby`, `class_updateddate`, `status`) VALUES
(1, 2, '10', 1, '2020-06-09 00:00:00', 6, '2020-06-09 09:37:43', 1),
(2, 1, '11', 6, '2020-06-09 09:18:20', 6, '2020-06-10 15:47:59', 1),
(3, 1, '12', 6, '2020-06-11 07:48:41', 0, '0000-00-00 00:00:00', 1),
(4, 1, '9', 6, '2020-06-12 17:40:21', 0, '0000-00-00 00:00:00', 1),
(5, 2, '11', 19, '2020-06-29 08:50:27', 19, '2020-06-29 08:50:36', 1),
(6, 5, '10', 21, '2020-07-01 09:42:36', 0, '0000-00-00 00:00:00', 1),
(7, 1, '10', 6, '2020-11-23 07:13:50', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(450) DEFAULT NULL,
  `website` varchar(450) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `logo_path` varchar(450) DEFAULT NULL,
  `license` int(11) DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `activecode` int(10) DEFAULT '1',
  `role_id` int(10) DEFAULT NULL,
  `dealer_status` int(11) DEFAULT '0',
  `dealer_id` int(11) DEFAULT NULL,
  `dealer_name` varchar(255) DEFAULT NULL,
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
  `personal_track` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `website`, `email`, `phone`, `mobile`, `logo_path`, `license`, `createdby`, `createdon`, `activecode`, `role_id`, `dealer_status`, `dealer_id`, `dealer_name`, `sms_title`, `sms_url`, `sms_username`, `sms_password`, `address`, `vehicle_access`, `sms_access`, `api_key`, `updatedby`, `updatedon`, `fuel_email`, `route_deviation`, `personal_track`) VALUES
(1, 'Norbert School', NULL, 'prakash12@gmail.com', '9688524520', '6374241048', NULL, 10, '1', '2020-06-06 12:57:28', 1, 3, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'karaikudi', 0, 0, NULL, 1, '2020-06-22 15:27:41', 0, 0, NULL),
(2, 'scm school', NULL, 'dsfdsg@gmail.co', '6374241048', '6374241048', NULL, 10, '6', '2020-06-08 09:31:01', 1, 3, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'cbe', 0, 0, NULL, 1, '2020-06-29 08:06:19', 0, 0, NULL),
(5, 'Francis School', NULL, 'dsfdsg@gmail.co', '6374241048', '6374241048', NULL, 10, '1', '2020-07-01 09:39:52', 1, 3, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'c.k.Mangalam.', 0, 0, NULL, 0, NULL, 0, 0, NULL);

--
-- Triggers `clients`
--
DELIMITER $$
CREATE TRIGGER `clients_AFTER_INSERT` AFTER INSERT ON `clients` FOR EACH ROW BEGIN
INSERT INTO access_privileges(client_id,activecode)VALUES(NEW.client_id,NEW.activecode);
INSERT INTO alter_contacts(activecode,createdby,createdon,ac_on,ac_off,ignition_on,ignition_off,client_id)VALUES(1,1,CURRENT_TIMESTAMP,1,2,3,4,NEW.client_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(45) NOT NULL,
  `vehicle_id` varchar(20) NOT NULL,
  `start_day` varchar(45) NOT NULL,
  `start_lat` varchar(45) NOT NULL,
  `start_lng` varchar(45) NOT NULL,
  `start_loc` varchar(450) NOT NULL,
  `end_day` varchar(45) NOT NULL,
  `end_lat` varchar(45) NOT NULL,
  `end_lng` varchar(45) NOT NULL,
  `end_loc` varchar(450) NOT NULL,
  `time_duration` varchar(45) NOT NULL,
  `distance` varchar(45) NOT NULL,
  `session_id` varchar(45) NOT NULL,
  `current_location` text NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_alertcount_report`
--

CREATE TABLE `consolidate_alertcount_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `distance_km` double DEFAULT NULL,
  `moving_duration` varchar(50) DEFAULT NULL,
  `parking_duration` varchar(50) DEFAULT NULL,
  `idel_duration` varchar(50) DEFAULT NULL,
  `fuel_fill_litre` double DEFAULT NULL,
  `fuel_dip_litre` double DEFAULT NULL,
  `fuel_consumed_litre` double DEFAULT NULL,
  `fuel_millege` double DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_distance_report`
--

CREATE TABLE `consolidate_distance_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
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
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fuel_fill_litre` double DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_idle_report`
--

CREATE TABLE `consolidate_idle_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
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
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `distance_km` double DEFAULT NULL,
  `moving_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consolidate_park_report`
--

CREATE TABLE `consolidate_park_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `vehicle_register_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `parking_duration` varchar(50) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_followups`
--

CREATE TABLE `customer_followups` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(45) NOT NULL,
  `cus_mobile` varchar(45) NOT NULL,
  `cus_phone` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `call_date` varchar(45) NOT NULL,
  `next_call_date` varchar(45) NOT NULL,
  `company_name` varchar(45) NOT NULL,
  `address` varchar(200) NOT NULL,
  `call_status` varchar(45) NOT NULL,
  `contact_source` varchar(45) NOT NULL,
  `required_davice` varchar(20) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `created_date` varchar(45) NOT NULL,
  `updatedon` varchar(45) NOT NULL,
  `command` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `db_stx`
--

CREATE TABLE `db_stx` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) NOT NULL,
  `Acceleration_Event` varchar(250) NOT NULL,
  `Threshold_Value` varchar(250) NOT NULL,
  `Peak_Value` varchar(250) NOT NULL,
  `Duration_Over_Threshold` varchar(250) NOT NULL,
  `ignition` varchar(250) NOT NULL,
  `vms` varchar(150) NOT NULL,
  `speed` int(20) NOT NULL,
  `lat_message` varchar(250) NOT NULL,
  `lon_message` varchar(250) NOT NULL,
  `modified_date` varchar(250) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keyword` varchar(50) NOT NULL,
  `packettype` varchar(20) NOT NULL,
  `zap` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `db_stx`
--
DELIMITER $$
CREATE TRIGGER `device_alerts` AFTER INSERT ON `db_stx` FOR EACH ROW BEGIN

	SELECT vehicle_id,client_id INTO @v_id,@c_id FROM vehicle WHERE v_running_no = NEW.running_no LIMIT 1;
    IF @v_id is not null THEN
	IF (@v_id !='')
    THEN
    CASE    
		WHEN NEW.Acceleration_Event = 1 THEN
			INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat_message,NEW.lon_message,NEW.modified_date,@v_id,@c_id,12,1,1);

		WHEN NEW.Acceleration_Event = 2 THEN
				INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat_message,NEW.lon_message,NEW.modified_date,@v_id,@c_id,13,1,1);

		WHEN NEW.Acceleration_Event = 3 THEN
				INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat_message,NEW.lon_message,NEW.modified_date,@v_id,@c_id,14,1,1);

		WHEN NEW.Acceleration_Event = 4 THEN
				INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat_message,NEW.lon_message,NEW.modified_date,@v_id,@c_id,15,1,1);
		     
		ELSE BEGIN END;  

		END CASE;

		END IF;
		END IF; 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_details`
--

CREATE TABLE `dealer_details` (
  `dealer_id` int(11) NOT NULL,
  `dealer_company` varchar(255) DEFAULT NULL,
  `dealer_name` varchar(255) DEFAULT NULL,
  `dealer_email` varchar(255) DEFAULT NULL,
  `dealer_mobile` varchar(20) DEFAULT NULL,
  `dealer_address` longtext,
  `dealer_createddate` datetime DEFAULT NULL,
  `dealer_createdID` int(11) DEFAULT NULL,
  `dealer_updatedate` datetime DEFAULT NULL,
  `dealer_updatedID` int(11) DEFAULT NULL
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
-- Table structure for table `dlio_stx`
--

CREATE TABLE `dlio_stx` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) NOT NULL,
  `alert_type` varchar(20) NOT NULL,
  `rfid` varchar(20) NOT NULL,
  `lat_message` varchar(150) NOT NULL,
  `lon_message` varchar(150) NOT NULL,
  `modified_date` varchar(150) NOT NULL,
  `created_date` varchar(150) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `packettype` varchar(20) NOT NULL,
  `zap` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `dob` varchar(45) DEFAULT NULL,
  `join_date` varchar(45) DEFAULT NULL,
  `licence_no` varchar(45) DEFAULT NULL,
  `insurence_type` varchar(45) DEFAULT NULL,
  `insurence_exp_date` varchar(45) DEFAULT NULL,
  `de_active_date` varchar(45) DEFAULT NULL,
  `de_active_desc` varchar(450) DEFAULT NULL,
  `expiry_date` varchar(45) DEFAULT NULL,
  `address` varchar(4500) DEFAULT NULL,
  `mobile_no` varchar(45) DEFAULT NULL,
  `description` varchar(4500) DEFAULT NULL,
  `activecode` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `created_on` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updatedon` varchar(45) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `licence_type` int(11) DEFAULT NULL,
  `licence_type_expiry` varchar(45) DEFAULT NULL,
  `secondry_mobile` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `driver_rating`
--

CREATE TABLE `driver_rating` (
  `rating_id` int(11) NOT NULL,
  `i_button_no` varchar(50) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `tot_alert_count` int(11) DEFAULT NULL,
  `distance` double NOT NULL,
  `datetime` date NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fmb_can_kline`
--

CREATE TABLE `fmb_can_kline` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `brake_switch_79` int(11) DEFAULT NULL,
  `wheel_based_speed_80` double DEFAULT NULL,
  `cruise_control_active_81` int(11) DEFAULT NULL,
  `slutch_switch_82` int(11) DEFAULT NULL,
  `PTO_state_83` int(11) DEFAULT NULL,
  `accelerator_pedal_position_1_84` int(11) DEFAULT NULL,
  `Engine_Percent_Load_85` int(11) DEFAULT NULL,
  `Engine_total_fuel_used_86` double DEFAULT NULL,
  `Fuel_level_1_X_87` int(11) DEFAULT NULL,
  `Engine_speed_X_88` double DEFAULT NULL,
  `Axle_weight_89_103` double DEFAULT NULL,
  `Engine_total_hours_104` double DEFAULT NULL,
  `vehicle_identification_number_X_105_108` varchar(100) DEFAULT NULL,
  `SW_version_supported_X_109` varchar(100) DEFAULT NULL,
  `Diagnostics_supported_X_110` int(11) DEFAULT NULL,
  `Requests_supported_X_111` int(11) DEFAULT NULL,
  `High_resolution_total_vehicle_distance_X_112` double DEFAULT NULL,
  `Service_distance_113` double DEFAULT NULL,
  `Vehicle_motion_X_114` int(11) DEFAULT NULL,
  `driver_2_working_state_X_115` int(11) DEFAULT NULL,
  `driver_1_working_state_X_116` int(11) DEFAULT NULL,
  `Vehicle_overspeed_117` int(11) DEFAULT NULL,
  `Driver_1_time_rel_states_118` int(11) DEFAULT NULL,
  `Driver_2_time_rel_states_119` int(11) DEFAULT NULL,
  `Driver_1_card_X_120` int(11) DEFAULT NULL,
  `Driver_2_card_X_121` int(11) DEFAULT NULL,
  `Direction_indicator_122` int(11) DEFAULT NULL,
  `Tachograph_performance_X_123` int(11) DEFAULT NULL,
  `Tachograpgh_handling_information_124` int(11) DEFAULT NULL,
  `System_event_X_125` int(11) DEFAULT NULL,
  `Tachograph_vehicle_speed_X_126` double DEFAULT NULL,
  `Engine_coolant_temperature_X_127` int(11) DEFAULT NULL,
  `Ambient_Air_Temperature_X_128` varchar(255) DEFAULT NULL,
  `Driver_1_Identification_129_131` varchar(255) DEFAULT NULL,
  `Driver_2_Identification_132_134` varchar(100) DEFAULT NULL,
  `Fuel_rate_X_135` double DEFAULT NULL,
  `Instantaneous_Fuel_Economy_X_136` double DEFAULT NULL,
  `PTO_engaged_137` int(11) DEFAULT NULL,
  `High_resolution_engine_total_fuel_used_138` double DEFAULT NULL,
  `Gross_Combination_Vehicle_Weight_139` double DEFAULT NULL,
  `Jamming_detection_249` int(11) DEFAULT NULL,
  `Trip_250` int(11) DEFAULT NULL,
  `Immobilizer_251` int(11) DEFAULT NULL,
  `Authorized_driving_252` int(11) DEFAULT NULL,
  `ECO_driving_type_253` int(11) DEFAULT NULL,
  `ECO_driving_value_254` double DEFAULT NULL,
  `Over_Speeding_255` double DEFAULT NULL,
  `Data_limit_reached_242` double DEFAULT NULL,
  `Excessive_Idling_243` int(11) DEFAULT NULL,
  `Camera_Event_244` varchar(100) DEFAULT NULL,
  `Towing_detection_246` int(11) DEFAULT NULL,
  `Crash_detection_247` int(11) DEFAULT NULL,
  `LVCAN_Speed_30` double DEFAULT NULL,
  `LVCAN_Acc_Pedal_31` double DEFAULT NULL,
  `LVCAN_Fuel_Consumed_33` double DEFAULT NULL,
  `LVCAN_Fuel_Level_34` double DEFAULT NULL,
  `LVCAN_Engine_RPM_35` double DEFAULT NULL,
  `LVCAN_Total_Mileage_36` double DEFAULT NULL,
  `LVCAN_Fuel_Level_37` int(11) DEFAULT NULL,
  `LVCAN_Program_Number_12` varchar(100) DEFAULT NULL,
  `Drive_recognize_183` int(11) DEFAULT NULL,
  `Driver_1_working_state_184` int(11) DEFAULT NULL,
  `Driver_2_working_state_185` int(11) DEFAULT NULL,
  `Overspeed_186` int(11) DEFAULT NULL,
  `Driver_1_card_187` int(11) DEFAULT NULL,
  `Driver_2_card_188` int(11) DEFAULT NULL,
  `Driver_1_time_rel_state_189` int(11) DEFAULT NULL,
  `Driver_2_time_rel_state_190` int(11) DEFAULT NULL,
  `Speed_191` double DEFAULT NULL,
  `Odometer_192` double DEFAULT NULL,
  `Distance_current_journey_193` double DEFAULT NULL,
  `Timestamp_194` varchar(50) DEFAULT NULL,
  `Vehicle_registration_number_231_232` varchar(100) DEFAULT NULL,
  `VIN_number_233_235` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_analog`
--

CREATE TABLE `fuel_analog` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) DEFAULT NULL,
  `lat` varchar(250) DEFAULT NULL,
  `lng` varchar(250) DEFAULT NULL,
  `speed` int(50) DEFAULT NULL,
  `flag` varchar(250) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_date` varchar(250) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `raw_value` varchar(150) NOT NULL DEFAULT '0',
  `odometer` varchar(250) NOT NULL DEFAULT '0',
  `i1` varchar(250) NOT NULL DEFAULT '0',
  `i2` varchar(250) NOT NULL DEFAULT '0',
  `keyword` varchar(150) DEFAULT NULL,
  `litres` varchar(100) DEFAULT NULL,
  `packettype` int(45) DEFAULT NULL,
  `zap` longtext,
  `packet` varchar(250) DEFAULT NULL,
  `ignition` varchar(250) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `fuel_analog`
--
DELIMITER $$
CREATE TRIGGER `fuel_analog_convert` AFTER INSERT ON `fuel_analog` FOR EACH ROW BEGIN

DECLARE fuel_ltr varchar(50);

IF(NEW.flag = '0' AND NEW.raw_value!='' AND NEW.raw_value!='0') THEN

	SELECT fuel_a,fuel_b,fuel_c INTO @fuel_a, @fuel_b,@fuel_c FROM vehicle WHERE v_running_no = NEW.running_no ORDER BY vehicle_id DESC LIMIT 1;

	SET fuel_ltr = (@fuel_a*NEW.raw_value*NEW.raw_value)+(@fuel_b*NEW.raw_value)-@fuel_c;

	INSERT INTO fuel_status(running_no, lat, lng, speed, flag, modified_date, created_date, percent, raw_value, odometer, i1, i2, keyword, litres, packettype, zap, packet, ignition) VALUES (NEW.running_no, NEW.lat, NEW.lng, NEW.speed, NEW.flag, NEW.modified_date, NEW.created_date, NEW.percent, NEW.raw_value, NEW.odometer, NEW.i1, NEW.i2, NEW.keyword, fuel_ltr, NEW.packettype, NEW.zap, NEW.packet, NEW.ignition);

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
-- Table structure for table `fuel_management`
--

CREATE TABLE `fuel_management` (
  `fuel_management_id` int(11) NOT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `fuel_amount` varchar(255) DEFAULT NULL,
  `fuel_date` varchar(255) DEFAULT NULL,
  `fuel_liters` varchar(255) DEFAULT NULL,
  `fuel_type_id` varchar(255) DEFAULT NULL,
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
  `v_imei` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_status`
--

CREATE TABLE `fuel_status` (
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
  `i1` varchar(250) NOT NULL DEFAULT '0',
  `i2` varchar(250) NOT NULL DEFAULT '0',
  `keyword` varchar(150) NOT NULL,
  `litres` varchar(100) NOT NULL,
  `packettype` int(45) NOT NULL,
  `zap` longtext NOT NULL,
  `packet` varchar(250) NOT NULL,
  `ignition` varchar(250) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `fuel_status`
--
DELIMITER $$
CREATE TRIGGER `fuel_dip_fill triger` BEFORE INSERT ON `fuel_status` FOR EACH ROW BEGIN 
  
    DECLARE diff_odometer varchar(50);
    
    SELECT litres,odometer INTO @litres_val, @odometer_val FROM fuel_status WHERE running_no = NEW.running_no and flag ='0' ORDER BY modified_date DESC LIMIT 1;
   
   SELECT vehicle_id,client_id,fuel_dip_ltr,fuel_ltr INTO @v_id, @c_id,@fuel_dip_ltr,@fuel_fill_ltr FROM vehicle WHERE v_running_no = NEW.running_no ORDER BY vehicle_id DESC LIMIT 1;

   
    IF NEW.packettype !='1' AND NEW.flag ='0' THEN

        UPDATE vehicle SET litres = NEW.litres WHERE vehicle_id = @v_id;
    
    END IF;
    
    
    SET diff_odometer = NEW.odometer-@odometer_val;
    
    
    IF (NEW.packettype !='1') AND NEW.flag ='0' THEN 
  
         IF @fuel_fill_ltr > '0' AND @fuel_fill_ltr IS NOT NULL THEN
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

      IF @fuel_dip_ltr > '0'  AND @fuel_dip_ltr IS NOT NULL THEN

          IF (NEW.litres-@litres_val) <= (0-@fuel_dip_ltr) AND NEW.speed < '5' THEN 
       
              INSERT INTO fuel_fill_dip_report(running_no,lat,lng,start_fuel,end_fuel,type_id,difference_fuel,start_date,end_date)VALUES(NEW.running_no,NEW.lat,NEW.lng,@litres_val,NEW.litres,1,(NEW.litres-@litres_val),NOW(),NOW()); 
              INSERT INTO sms_alert(lat,lng,createdon,vehicle_id,client_id,all_status,show_status,sms_status)VALUES(NEW.lat,NEW.lng,NEW.modified_date,@v_id,@c_id,18,1,1);
          END IF;

      ELSE
       
         IF ROUND(NEW.litres-@litres_val) < '-8.5' AND NEW.speed < '5' THEN
       
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
-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `fuel_type_id` int(11) NOT NULL,
  `fuel_type` varchar(450) DEFAULT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fueltemp_table`
--

CREATE TABLE `fueltemp_table` (
  `id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdon` timestamp NULL DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `start_fuel` float DEFAULT NULL,
  `end_fuel` float DEFAULT NULL,
  `fuel_difference` float DEFAULT NULL,
  `lat` varchar(45) NOT NULL,
  `lng` varchar(45) NOT NULL,
  `location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_report`
--

CREATE TABLE `geofence_report` (
  `id` bigint(20) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `v_lat` varchar(15) DEFAULT NULL,
  `v_lng` varchar(15) DEFAULT NULL,
  `geo_location_id` int(11) NOT NULL,
  `g_lat` varchar(25) NOT NULL,
  `g_lng` varchar(25) NOT NULL,
  `location_status` int(11) DEFAULT NULL,
  `out_datetime` datetime DEFAULT NULL,
  `in_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gnx_aj1939`
--

CREATE TABLE `gnx_aj1939` (
  `id` bigint(20) NOT NULL,
  `vehicle_imei` varchar(50) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `current_datetime` datetime DEFAULT NULL,
  `logged_datetime` datetime DEFAULT NULL,
  `packet_type` int(11) DEFAULT NULL,
  `packet_no` int(11) DEFAULT NULL,
  `electronic_engine_speed_190` double DEFAULT NULL,
  `vehicle_speed_84` double DEFAULT NULL,
  `coolant_level_111` double DEFAULT NULL,
  `average_fuel_economy_185` double DEFAULT NULL,
  `high_resolution_vehicle_distance_917` double DEFAULT NULL,
  `fuel_level_96` double DEFAULT NULL,
  `percentage_of_engine_load_92` double DEFAULT NULL,
  `coolant_temperature_110` double DEFAULT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `gnx_aj1939_raw` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `gnx_aj1939`
--
DELIMITER $$
CREATE TRIGGER `real_odometer_spn` AFTER INSERT ON `gnx_aj1939` FOR EACH ROW BEGIN

 	SELECT device_config_type INTO @device_config_type FROM vehicle WHERE v_running_no = NEW.vehicle_imei AND device_config_type='2' ORDER BY vehicle_id DESC LIMIT 1;


	IF @device_config_type = '2'  THEN


		SELECT
		  high_resolution_vehicle_distance_917
		INTO
		  @real_startodo
		FROM
		  gnx_aj1939
		WHERE
		  vehicle_imei = NEW.vehicle_imei AND high_resolution_vehicle_distance_917!=0 AND high_resolution_vehicle_distance_917 NOT LIKE '21%'
		ORDER BY
		  logged_datetime 
		DESC LIMIT 1;

		UPDATE
		    vehicle
		SET
		    odometer = @real_startodo
		WHERE
		    v_running_no = NEW.vehicle_imei; 


	END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gnx_ann`
--

CREATE TABLE `gnx_ann` (
  `id` int(11) NOT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `latitude_direction` varchar(5) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `longitude_direction` varchar(5) DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `angle` double DEFAULT NULL,
  `analog_value` double DEFAULT NULL,
  `current_datetime` datetime DEFAULT NULL,
  `logged_datetime` datetime DEFAULT NULL,
  `packet_type` int(11) DEFAULT NULL,
  `packet_id` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gnx_obddetails`
--

CREATE TABLE `gnx_obddetails` (
  `id` bigint(20) NOT NULL,
  `vehicle_imei` varchar(50) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `current_datetime` datetime DEFAULT NULL,
  `logged_datetime` datetime DEFAULT NULL,
  `packet_type` int(11) DEFAULT NULL,
  `packet_no` int(11) DEFAULT NULL,
  `electronic_engine_speed_190` double DEFAULT NULL,
  `vehicle_speed_84` double DEFAULT NULL,
  `coolant_level_111` double DEFAULT NULL,
  `average_fuel_economy_185` double DEFAULT NULL,
  `high_resolution_vehicle_distance_917` double DEFAULT NULL,
  `fuel_level_96` double DEFAULT NULL,
  `percentage_of_engine_load_92` double DEFAULT NULL,
  `coolant_temperature_110` double DEFAULT NULL,
  `ambient_air_pressure` double DEFAULT NULL,
  `crankcase_blow_pressure` double DEFAULT NULL,
  `intake_manifold_pressure` double DEFAULT NULL,
  `intake_manifold_temperature` double DEFAULT NULL,
  `engine_hmr` double DEFAULT NULL,
  `rail_pressure_fuelrate` double DEFAULT NULL,
  `transmission_oil_pressure` double DEFAULT NULL,
  `transmission_oil_temperature` double DEFAULT NULL,
  `hydraulic_retarder_oil_temperature` double DEFAULT NULL,
  `airpressure_engine_airinlet_pressure` double DEFAULT NULL,
  `steering_axle_temperature` double DEFAULT NULL,
  `transmission_requested_range` double DEFAULT NULL,
  `transmission_current_range` double DEFAULT NULL,
  `output_shaft_speed` double DEFAULT NULL,
  `engine_demand_percent_torque` double DEFAULT NULL,
  `tacho_vehicle_speed` double DEFAULT NULL,
  `engine_instantaneous_fueleconomy` double DEFAULT NULL,
  `engine_throttle_position` double DEFAULT NULL,
  `engine_throttle_position2` double DEFAULT NULL,
  `high_resolution_engine_totalfuel_consumed` double DEFAULT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health`
--

CREATE TABLE `health` (
  `batterythres` varchar(25) DEFAULT NULL,
  `battery` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_status`
--

CREATE TABLE `health_status` (
  `id` int(11) NOT NULL,
  `running_no` varchar(250) NOT NULL,
  `gpsv` varchar(250) DEFAULT NULL,
  `panic` varchar(250) DEFAULT NULL,
  `bcharges` varchar(250) DEFAULT NULL,
  `bchargel` varchar(255) DEFAULT NULL,
  `internal_battery_voltage` varchar(50) DEFAULT NULL,
  `modified_date` varchar(250) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mainbl` varchar(250) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `pending` varchar(250) DEFAULT NULL,
  `packettype` varchar(250) DEFAULT NULL,
  `vms` varchar(250) DEFAULT NULL,
  `zap` longtext,
  `packet` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `health_status`
--
DELIMITER $$
CREATE TRIGGER `status_update_vehicle_table` AFTER INSERT ON `health_status` FOR EACH ROW BEGIN
SELECT
  vehicle_id
INTO
  @v_id
FROM
  vehicle
WHERE
  v_running_no = NEW.running_no;


IF @v_id is not null THEN

  IF(@v_id != '') THEN
UPDATE
  vehicle
SET
  car_battery = NEW.mainbl,
  device_battery = NEW.bchargel,
  device_charge_status = NEW.bcharges,
  internal_battery_voltage=NEW.internal_battery_voltage
WHERE
  vehicle_id = @v_id;
END IF; 

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
END IF; 
  END
$$
DELIMITER ;

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

--
-- Triggers `i_button_livedata`
--
DELIMITER $$
CREATE TRIGGER `ibutton_trigger` AFTER INSERT ON `i_button_livedata` FOR EACH ROW BEGIN

 SELECT vehicle_id INTO @v_id FROM vehicle WHERE v_running_no = NEW.imei ORDER BY vehicle_id DESC LIMIT 1;

IF NEW.packet_type != '1' THEN
 
	IF NEW.job_status = '1' THEN

		
		INSERT
			INTO
			  i_button_report(
			    flag,
			    s_lat,
			    s_lng,
			    start_day,
			    device_no,
			    vehicle_id,
			    ibutton_no,
			    type_id,
			    start_odometer
			  )
			VALUES(
			  '1',
			  NEW.latitude,
			  NEW.longitude,
			  NEW.logged_datetime,
			  NEW.imei,
			  @v_id,
			  NEW.ibutton_id,
			  '1',
			  NEW.odometer
			);

			SELECT driver_name INTO @driver_name FROM i_button_details WHERE i_button_no = NEW.ibutton_id;

			UPDATE
	    		vehicle
	  		SET
	    		driver_ibutton = NEW.ibutton_id,
	    		driver_name = @driver_name
	  		WHERE
    			vehicle_id = @v_id; 


	END IF;

	IF NEW.job_status = '0' THEN

		UPDATE
		  i_button_report
		SET
		  flag = '2',
		  end_day = NEW.logged_datetime,
		  e_lat = NEW.latitude,
		  e_lng = NEW.longitude,
		  end_odometer=NEW.odometer
		WHERE
		  device_no = NEW.imei AND flag = '1';

	END IF;

END IF;

IF NEW.packet_type = '1' THEN
 
	IF NEW.job_status = '1' THEN

		INSERT
			INTO
			  i_button_report(
			    flag,
			    s_lat,
			    s_lng,
			    start_day,
			    device_no,
			    vehicle_id,
			    ibutton_no,
			    type_id,
			    start_odometer
			  )
			VALUES(
			  '3',
			  NEW.latitude,
			  NEW.longitude,
			  NEW.logged_datetime,
			  NEW.imei,
			  @v_id,
			  NEW.ibutton_id,
			  '3',
			 NEW.odometer
			);

	END IF;

	IF NEW.job_status = '0' THEN

		UPDATE
		  i_button_report
		SET
		  flag = '4',
		  end_day = NEW.logged_datetime,
		  e_lat = NEW.latitude,
		  e_lng = NEW.longitude,
		  end_odometer=NEW.odometer
		WHERE
		  device_no = NEW.imei AND flag = '3';

	END IF;

	

END IF;


END
$$
DELIMITER ;

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

--
-- Triggers `i_button_report`
--
DELIMITER $$
CREATE TRIGGER `real_odometer_ibutton` AFTER UPDATE ON `i_button_report` FOR EACH ROW BEGIN

SELECT 
  device_config_type 
INTO 
 @device_config_type
FROM
  vehicle
WHERE
  v_running_no = NEW.device_no
ORDER BY
  vehicle_id DESC
LIMIT 1; 

IF @device_config_type = 2  THEN


SELECT
  high_resolution_vehicle_distance_917
INTO
  @real_startodo
FROM
  gnx_aj1939
WHERE
  vehicle_imei = NEW.device_no AND logged_datetime<=NEW.start_day AND high_resolution_vehicle_distance_917!=0 AND high_resolution_vehicle_distance_917 NOT LIKE '21%'
ORDER BY
  logged_datetime 
DESC LIMIT 1;

SELECT
  high_resolution_vehicle_distance_917
INTO
 @real_endodo
FROM
  gnx_aj1939
WHERE
  vehicle_imei = NEW.device_no AND logged_datetime<=NEW.end_day AND high_resolution_vehicle_distance_917!=0 AND high_resolution_vehicle_distance_917 NOT LIKE '21%'
ORDER BY
  logged_datetime 
DESC LIMIT 1;

IF NEW.update_status = 0 THEN

     INSERT
        INTO
          i_button_report1(
             flag,
              s_lat,
              s_lng,
              start_day,
              end_day,
              ibutton_no,
              device_no,
              vehicle_id,
              e_lat,
              e_lng,
              type_id,
              start_odometer,
              end_odometer
          )
        VALUES(
              NEW.flag,
              NEW.s_lat,
              NEW.s_lng,
              NEW.start_day,
              NEW.end_day,
              NEW.ibutton_no,
              NEW.device_no,
              NEW.vehicle_id,
              NEW.e_lat,
              NEW.e_lng,
              NEW.type_id,
             @real_startodo,
             @real_endodo
        );

END IF;

END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `i_button_report1`
--

CREATE TABLE `i_button_report1` (
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
  `end_odometer` double NOT NULL DEFAULT '0',
  `update_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `idle_report`
--

CREATE TABLE `idle_report` (
  `report_id` int(11) NOT NULL,
  `flag` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `vehicle_id` varchar(45) DEFAULT NULL,
  `total_km` varchar(45) DEFAULT NULL,
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `fuel_usage` varchar(45) DEFAULT NULL,
  `fuel_filled` varchar(45) DEFAULT NULL,
  `initial_ltr` varchar(45) DEFAULT NULL,
  `end_ltr` varchar(45) DEFAULT NULL,
  `ignition` int(11) NOT NULL DEFAULT '1',
  `start_location` text,
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `idle_report_old`
--

CREATE TABLE `idle_report_old` (
  `report_id` int(11) NOT NULL,
  `flag` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `vehicle_id` varchar(45) DEFAULT NULL,
  `total_km` varchar(45) DEFAULT NULL,
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `fuel_usage` varchar(45) DEFAULT NULL,
  `fuel_filled` varchar(45) DEFAULT NULL,
  `initial_ltr` varchar(45) DEFAULT NULL,
  `end_ltr` varchar(45) DEFAULT NULL,
  `ignition` int(11) NOT NULL DEFAULT '1',
  `start_location` text,
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `idlearea_report`
--

CREATE TABLE `idlearea_report` (
  `report_id` int(11) NOT NULL,
  `flag` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `vehicle_id` varchar(45) DEFAULT NULL,
  `total_km` varchar(45) DEFAULT '0',
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `fuel_usage` varchar(45) DEFAULT NULL,
  `fuel_filled` varchar(45) DEFAULT NULL,
  `initial_ltr` varchar(45) DEFAULT NULL,
  `end_ltr` varchar(45) DEFAULT NULL,
  `start_location` text,
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `idlearea_report1`
--

CREATE TABLE `idlearea_report1` (
  `report_id` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `s_lat` varchar(45) NOT NULL,
  `s_lng` varchar(45) NOT NULL,
  `start_day` datetime NOT NULL,
  `end_day` datetime NOT NULL,
  `device_no` varchar(45) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `total_km` varchar(45) NOT NULL,
  `e_lat` varchar(45) NOT NULL,
  `e_lng` varchar(45) NOT NULL,
  `type_id` int(11) NOT NULL,
  `fuel_usage` varchar(45) NOT NULL,
  `fuel_filled` varchar(45) NOT NULL,
  `initial_ltr` varchar(45) NOT NULL,
  `end_ltr` varchar(45) NOT NULL,
  `start_location` text,
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ignition_report`
--

CREATE TABLE `ignition_report` (
  `report_id` int(11) NOT NULL,
  `flag` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `vehicle_id` varchar(45) DEFAULT NULL,
  `total_km` varchar(45) DEFAULT '0',
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
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
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `ignition_report`
--
DELIMITER $$
CREATE TRIGGER `real_odometer` AFTER UPDATE ON `ignition_report` FOR EACH ROW BEGIN

SELECT 
  device_config_type 
INTO 
 @device_config_type
FROM
  vehicle
WHERE
  v_running_no = NEW.device_no
ORDER BY
  vehicle_id DESC
LIMIT 1; 

IF @device_config_type = 2  THEN


SELECT
  high_resolution_vehicle_distance_917
INTO
  @real_startodo
FROM
  gnx_aj1939
WHERE
  vehicle_imei = NEW.device_no AND logged_datetime<=NEW.start_day AND high_resolution_vehicle_distance_917!=0 AND high_resolution_vehicle_distance_917 NOT LIKE '21%'
ORDER BY
  logged_datetime 
DESC LIMIT 1;

SELECT
  high_resolution_vehicle_distance_917
INTO
 @real_endodo
FROM
  gnx_aj1939
WHERE
  vehicle_imei = NEW.device_no AND logged_datetime<=NEW.end_day AND high_resolution_vehicle_distance_917!=0 AND high_resolution_vehicle_distance_917 NOT LIKE '21%'
ORDER BY
  logged_datetime 
DESC LIMIT 1;

     INSERT
        INTO
          ignition_report1(
             flag,
              s_lat,
              s_lng,
              start_day,
              end_day,
              device_no,
              vehicle_id,
              total_km,
              e_lat,
              e_lng,
              type_id,
              fuel_usage,
              fuel_filled,
              initial_ltr,
              end_ltr,
              start_odometer,
              end_odometer
          )
        VALUES(
              NEW.flag,
              NEW.s_lat,
              NEW.s_lng,
              NEW.start_day,
              NEW.end_day,
              NEW.device_no,
              NEW.vehicle_id,
              NEW.total_km,
              NEW.e_lat,
              NEW.e_lng,
              NEW.type_id,
              NEW.fuel_usage,
              NEW.fuel_filled,
              NEW.initial_ltr,
              NEW.end_ltr,
             @real_startodo,
             @real_endodo
        );

END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ignition_report1`
--

CREATE TABLE `ignition_report1` (
  `report_id` int(11) NOT NULL,
  `flag` varchar(45) DEFAULT NULL,
  `s_lat` varchar(45) DEFAULT NULL,
  `s_lng` varchar(45) DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `device_no` varchar(45) DEFAULT NULL,
  `vehicle_id` varchar(45) DEFAULT NULL,
  `total_km` varchar(45) DEFAULT '0',
  `e_lat` varchar(45) DEFAULT NULL,
  `e_lng` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `fuel_usage` varchar(45) DEFAULT NULL,
  `fuel_filled` varchar(45) DEFAULT NULL,
  `initial_ltr` varchar(45) DEFAULT NULL,
  `end_ltr` varchar(45) DEFAULT NULL,
  `start_odometer` double DEFAULT NULL,
  `end_odometer` double DEFAULT NULL,
  `start_location` text,
  `end_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_reminder`
--

CREATE TABLE `insurance_reminder` (
  `insurance_reminder_id` int(11) NOT NULL,
  `activecode` int(11) DEFAULT NULL,
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
  `alert_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `location_list`
--

CREATE TABLE `location_list` (
  `Location_Id` int(45) NOT NULL,
  `Location_short_name` varchar(255) NOT NULL,
  `Lat` varchar(100) NOT NULL,
  `Lng` varchar(100) NOT NULL,
  `circle_size` int(11) NOT NULL,
  `client_id` int(45) NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(100) NOT NULL,
  `UpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activecode` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_list`
--

INSERT INTO `location_list` (`Location_Id`, `Location_short_name`, `Lat`, `Lng`, `circle_size`, `client_id`, `CreatedBy`, `CreatedOn`, `UpdatedBy`, `UpdatedOn`, `activecode`) VALUES
(1, 'Thondi', '1235', '1111102', 5, 1, '1', '2020-06-11 16:28:26', '', '2020-06-11 05:28:26', 1),
(2, 'Thiruvadanai', '345', '45367', 5, 1, '1', '2020-06-12 11:11:15', '', '2020-06-12 00:42:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `login_datetime` datetime NOT NULL,
  `logout_datetime` datetime NOT NULL,
  `login_details` text NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `client_id`, `user_id`, `user_name`, `login_datetime`, `logout_datetime`, `login_details`, `ip_address`) VALUES
(11355, 0, 1, 'superadmin', '2020-06-05 12:03:12', '2020-11-23 11:34:51', '', '::1'),
(11356, 0, 1, 'superadmin', '2020-06-05 12:05:50', '2020-11-23 11:34:51', '', '::1'),
(11357, 0, 1, 'superadmin', '2020-06-05 12:34:52', '2020-11-23 11:34:51', '', '::1'),
(11358, 0, 1, 'superadmin', '2020-06-06 10:36:44', '2020-11-23 11:34:51', '', '::1'),
(11359, 0, 1, 'superadmin', '2020-06-06 16:18:40', '2020-11-23 11:34:51', '', '::1'),
(11360, 1, 6, 'admin', '2020-06-06 16:27:59', '2020-07-04 12:13:47', '', '::1'),
(11361, 0, 1, 'superadmin', '2020-06-06 16:42:20', '2020-11-23 11:34:51', '', '::1'),
(11362, 1, 6, 'admin', '2020-06-06 16:43:51', '2020-07-04 12:13:47', '', '::1'),
(11363, 0, 1, 'superadmin', '2020-06-06 16:59:27', '2020-11-23 11:34:51', '', '::1'),
(11364, 0, 1, 'superadmin', '2020-06-06 16:59:51', '2020-11-23 11:34:51', '', '::1'),
(11365, 1, 6, 'admin', '2020-06-06 17:00:09', '2020-07-04 12:13:47', '', '::1'),
(11366, 1, 6, 'admin', '2020-06-06 18:27:30', '2020-07-04 12:13:47', '', '::1'),
(11367, 1, 6, 'admin', '2020-06-06 18:57:21', '2020-07-04 12:13:47', '', '::1'),
(11368, 1, 6, 'admin', '2020-06-08 10:47:28', '2020-07-04 12:13:47', '', '::1'),
(11369, 0, 1, 'superadmin', '2020-06-08 15:28:33', '2020-11-23 11:34:51', '', '::1'),
(11370, 1, 6, 'admin', '2020-06-08 15:54:20', '2020-07-04 12:13:47', '', '::1'),
(11371, 0, 1, 'superadmin', '2020-06-08 16:55:19', '2020-11-23 11:34:51', '', '::1'),
(11372, 0, 1, 'superadmin', '2020-06-09 10:47:19', '2020-11-23 11:34:51', '', '::1'),
(11373, 1, 6, 'admin', '2020-06-09 10:53:09', '2020-07-04 12:13:47', '', '::1'),
(11374, 1, 6, 'admin', '2020-06-09 10:58:05', '2020-07-04 12:13:47', '', '::1'),
(11375, 1, 6, 'admin', '2020-06-09 18:12:34', '2020-07-04 12:13:47', '', '::1'),
(11376, 1, 6, 'admin', '2020-06-10 10:40:00', '2020-07-04 12:13:47', '', '::1'),
(11377, 1, 6, 'admin', '2020-06-11 10:42:35', '2020-07-04 12:13:47', '', '::1'),
(11378, 1, 6, 'admin', '2020-06-11 15:16:17', '2020-07-04 12:13:47', '', '::1'),
(11379, 1, 6, 'admin', '2020-06-12 11:01:43', '2020-07-04 12:13:47', '', '::1'),
(11380, 1, 6, 'admin', '2020-06-12 18:13:31', '2020-07-04 12:13:47', '', '::1'),
(11381, 1, 6, 'admin', '2020-06-13 10:52:45', '2020-07-04 12:13:47', '', '::1'),
(11382, 0, 1, 'superadmin', '2020-06-13 12:05:46', '2020-11-23 11:34:51', '', '::1'),
(11383, 1, 6, 'admin', '2020-06-13 12:21:20', '2020-07-04 12:13:47', '', '::1'),
(11384, 1, 6, 'admin', '2020-06-13 15:56:27', '2020-07-04 12:13:47', '', '::1'),
(11385, 1, 6, 'admin', '2020-06-13 19:22:49', '2020-07-04 12:13:47', '', '::1'),
(11386, 1, 6, 'admin', '2020-06-15 10:51:30', '2020-07-04 12:13:47', '', '::1'),
(11387, 0, 1, 'superadmin', '2020-06-15 13:29:42', '2020-11-23 11:34:51', '', '::1'),
(11388, 1, 6, 'admin', '2020-06-15 15:14:40', '2020-07-04 12:13:47', '', '::1'),
(11389, 0, 1, 'superadmin', '2020-06-15 15:16:58', '2020-11-23 11:34:51', '', '::1'),
(11390, 1, 9, 'raman', '2020-06-15 15:36:45', '2020-06-15 15:43:24', '', '::1'),
(11391, 1, 6, 'admin', '2020-06-15 15:43:37', '2020-07-04 12:13:47', '', '::1'),
(11392, 0, 1, 'superadmin', '2020-06-15 18:05:06', '2020-11-23 11:34:51', '', '::1'),
(11393, 1, 6, 'admin', '2020-06-15 18:16:00', '2020-07-04 12:13:47', '', '::1'),
(11394, 1, 6, 'admin', '2020-06-16 11:07:55', '2020-07-04 12:13:47', '', '::1'),
(11395, 1, 6, 'admin', '2020-06-16 20:26:57', '2020-07-04 12:13:47', '', '::1'),
(11396, 0, 1, 'superadmin', '2020-06-16 20:27:27', '2020-11-23 11:34:51', '', '::1'),
(11397, 1, 6, 'admin', '2020-06-16 20:28:18', '2020-07-04 12:13:47', '', '::1'),
(11398, 1, 6, 'admin', '2020-06-17 10:27:55', '2020-07-04 12:13:47', '', '::1'),
(11399, 1, 6, 'admin', '2020-06-17 18:54:01', '2020-07-04 12:13:47', '', '::1'),
(11400, 1, 6, 'admin', '2020-06-18 10:19:48', '2020-07-04 12:13:47', '', '::1'),
(11401, 1, 6, 'admin', '2020-06-18 15:31:04', '2020-07-04 12:13:47', '', '::1'),
(11402, 1, 6, 'admin', '2020-06-19 11:01:47', '2020-07-04 12:13:47', '', '::1'),
(11403, 1, 6, 'admin', '2020-06-20 10:25:01', '2020-07-04 12:13:47', '', '::1'),
(11404, 0, 1, 'superadmin', '2020-06-20 19:40:11', '2020-11-23 11:34:51', '', '::1'),
(11405, 1, 6, 'admin', '2020-06-20 19:45:53', '2020-07-04 12:13:47', '', '::1'),
(11406, 1, 6, 'admin', '2020-06-22 10:35:55', '2020-07-04 12:13:47', '', '::1'),
(11407, 1, 6, 'admin', '2020-06-22 10:55:13', '2020-07-04 12:13:47', '', '::1'),
(11408, 0, 1, 'superadmin', '2020-06-22 11:37:38', '2020-11-23 11:34:51', '', '::1'),
(11409, 1, 10, 'parent', '2020-06-22 11:40:02', '2020-06-22 15:03:13', '', '::1'),
(11410, 1, 10, 'parent', '2020-06-22 12:32:13', '2020-06-22 15:03:13', '', '::1'),
(11411, 0, 1, 'superadmin', '2020-06-22 12:43:53', '2020-11-23 11:34:51', '', '::1'),
(11412, 1, 10, 'parent', '2020-06-22 12:46:23', '2020-06-22 15:03:13', '', '::1'),
(11413, 1, 6, 'admin', '2020-06-22 15:03:23', '2020-07-04 12:13:47', '', '::1'),
(11414, 0, 1, 'superadmin', '2020-06-22 15:07:40', '2020-11-23 11:34:51', '', '::1'),
(11415, 0, 1, 'superadmin', '2020-06-22 15:19:05', '2020-11-23 11:34:51', '', '::1'),
(11416, 1, 6, 'admin', '2020-06-22 15:19:35', '2020-07-04 12:13:47', '', '::1'),
(11417, 0, 1, 'superadmin', '2020-06-22 15:23:00', '2020-11-23 11:34:51', '', '::1'),
(11418, 1, 6, 'admin', '2020-06-22 15:28:29', '2020-07-04 12:13:47', '', '::1'),
(11419, 0, 1, 'superadmin', '2020-06-22 16:13:26', '2020-11-23 11:34:51', '', '::1'),
(11420, 1, 6, 'admin', '2020-06-22 16:17:14', '2020-07-04 12:13:47', '', '::1'),
(11421, 0, 1, 'superadmin', '2020-06-22 16:21:29', '2020-11-23 11:34:51', '', '::1'),
(11422, 3, 6, 'admin', '2020-06-22 17:09:21', '2020-07-04 12:13:47', '', '::1'),
(11423, 2, 6, 'admin', '2020-06-22 18:47:52', '2020-07-04 12:13:47', '', '::1'),
(11424, 1, 1, 'superadmin', '2020-06-22 18:57:04', '2020-11-23 11:34:51', '', '::1'),
(11425, 1, 1, 'superadmin', '2020-06-22 19:17:01', '2020-11-23 11:34:51', '', '::1'),
(11426, 1, 1, 'superadmin', '2020-06-22 19:21:43', '2020-11-23 11:34:51', '', '::1'),
(11427, 2, 6, 'admin', '2020-06-22 19:22:07', '2020-07-04 12:13:47', '', '::1'),
(11428, 1, 6, 'admin', '2020-06-23 10:14:30', '2020-07-04 12:13:47', '', '::1'),
(11429, 4, 18, 'nagaraj', '2020-06-23 10:34:51', '2020-06-23 15:03:55', '', '::1'),
(11430, 4, 18, 'nagaraj', '2020-06-23 10:50:06', '2020-06-23 15:03:55', '', '::1'),
(11431, 1, 18, 'nagaraj', '2020-06-23 10:57:51', '2020-06-23 15:03:55', '', '::1'),
(11432, 1, 6, 'admin', '2020-06-23 15:04:04', '2020-07-04 12:13:47', '', '::1'),
(11433, 1, 17, 'raman', '2020-06-23 15:19:32', '2020-06-29 16:37:30', '', '::1'),
(11434, 1, 6, 'admin', '2020-06-23 16:28:26', '2020-07-04 12:13:47', '', '::1'),
(11435, 1, 1, 'superadmin', '2020-06-23 16:36:25', '2020-11-23 11:34:51', '', '::1'),
(11436, 1, 17, 'raman', '2020-06-23 16:38:54', '2020-06-29 16:37:30', '', '::1'),
(11437, 1, 17, 'raman', '2020-06-23 16:39:49', '2020-06-29 16:37:30', '', '::1'),
(11438, 1, 17, 'raman', '2020-06-23 16:51:31', '2020-06-29 16:37:30', '', '::1'),
(11439, 1, 17, 'raman', '2020-06-23 16:52:38', '2020-06-29 16:37:30', '', '::1'),
(11440, 1, 6, 'admin', '2020-06-23 16:54:36', '2020-07-04 12:13:47', '', '::1'),
(11441, 1, 6, 'admin', '2020-06-24 10:17:49', '2020-07-04 12:13:47', '', '::1'),
(11442, 1, 6, 'admin', '2020-06-25 10:24:32', '2020-07-04 12:13:47', '', '::1'),
(11443, 1, 6, 'admin', '2020-06-26 11:42:50', '2020-07-04 12:13:47', '', '::1'),
(11444, 1, 6, 'admin', '2020-06-26 18:16:55', '2020-07-04 12:13:47', '', '::1'),
(11445, 1, 6, 'admin', '2020-06-26 18:16:56', '2020-07-04 12:13:47', '', '::1'),
(11446, 1, 6, 'admin', '2020-06-27 10:35:05', '2020-07-04 12:13:47', '', '::1'),
(11447, 1, 6, 'admin', '2020-06-29 10:39:53', '2020-07-04 12:13:47', '', '::1'),
(11448, 1, 6, 'admin', '2020-06-29 10:47:22', '2020-07-04 12:13:47', '', '::1'),
(11449, 1, 1, 'superadmin', '2020-06-29 11:35:38', '2020-11-23 11:34:51', '', '::1'),
(11450, 2, 19, 'scmschool', '2020-06-29 11:48:06', '2020-07-01 13:07:59', '', '::1'),
(11451, 1, 1, 'superadmin', '2020-06-29 13:00:47', '2020-11-23 11:34:51', '', '::1'),
(11452, 2, 19, 'scmschool', '2020-06-29 13:01:59', '2020-07-01 13:07:59', '', '::1'),
(11453, 1, 17, 'raman', '2020-06-29 13:55:22', '2020-06-29 16:37:30', '', '::1'),
(11454, 1, 6, 'admin', '2020-06-29 13:56:00', '2020-07-04 12:13:47', '', '::1'),
(11455, 1, 6, 'admin', '2020-06-29 14:59:26', '2020-07-04 12:13:47', '', '::1'),
(11456, 1, 1, 'superadmin', '2020-06-29 16:21:44', '2020-11-23 11:34:51', '', '::1'),
(11457, 1, 6, 'admin', '2020-06-29 16:24:00', '2020-07-04 12:13:47', '', '::1'),
(11458, 1, 17, 'raman', '2020-06-29 16:32:38', '2020-06-29 16:37:30', '', '::1'),
(11459, 1, 1, 'superadmin', '2020-06-29 16:37:37', '2020-11-23 11:34:51', '', '::1'),
(11460, 1, 1, 'superadmin', '2020-06-29 16:40:24', '2020-11-23 11:34:51', '', '::1'),
(11461, 2, 20, 'mmm', '2020-06-29 16:57:19', '2020-06-29 16:57:37', '', '::1'),
(11462, 2, 19, 'scmschool', '2020-06-29 16:57:54', '2020-07-01 13:07:59', '', '::1'),
(11463, 1, 6, 'admin', '2020-06-29 16:59:15', '2020-07-04 12:13:47', '', '::1'),
(11464, 1, 6, 'admin', '2020-06-29 17:45:10', '2020-07-04 12:13:47', '', '::1'),
(11465, 1, 6, 'admin', '2020-06-29 17:45:55', '2020-07-04 12:13:47', '', '::1'),
(11466, 1, 1, 'superadmin', '2020-06-29 18:45:57', '2020-11-23 11:34:51', '', '::1'),
(11467, 1, 6, 'admin', '2020-06-29 19:06:51', '2020-07-04 12:13:47', '', '::1'),
(11468, 1, 6, 'admin', '2020-06-30 10:41:08', '2020-07-04 12:13:47', '', '::1'),
(11469, 1, 6, 'admin', '2020-06-30 11:18:44', '2020-07-04 12:13:47', '', '::1'),
(11470, 1, 6, 'admin', '2020-06-30 11:37:25', '2020-07-04 12:13:47', '', '::1'),
(11471, 1, 6, 'admin', '2020-06-30 15:09:11', '2020-07-04 12:13:47', '', '::1'),
(11472, 1, 6, 'admin', '2020-07-01 10:37:10', '2020-07-04 12:13:47', '', '::1'),
(11473, 1, 6, 'admin', '2020-07-01 10:43:16', '2020-07-04 12:13:47', '', '::1'),
(11474, 2, 19, 'scmschool', '2020-07-01 12:29:22', '2020-07-01 13:07:59', '', '::1'),
(11475, 1, 6, 'admin', '2020-07-01 12:42:50', '2020-07-04 12:13:47', '', '::1'),
(11476, 2, 19, 'scmschool', '2020-07-01 12:43:58', '2020-07-01 13:07:59', '', '::1'),
(11477, 1, 1, 'superadmin', '2020-07-01 13:08:10', '2020-11-23 11:34:51', '', '::1'),
(11478, 5, 21, 'fransicschool', '2020-07-01 13:10:25', '2020-07-01 13:48:48', '', '::1'),
(11479, 5, 22, 'palani', '2020-07-01 13:16:15', '2020-07-01 15:57:29', '', '::1'),
(11480, 5, 22, 'palani', '2020-07-01 13:36:20', '2020-07-01 15:57:29', '', '::1'),
(11481, 5, 21, 'fransicschool', '2020-07-01 13:40:46', '2020-07-01 13:48:48', '', '::1'),
(11482, 1, 1, 'superadmin', '2020-07-01 13:44:25', '2020-11-23 11:34:51', '', '::1'),
(11483, 5, 21, 'fransicschool', '2020-07-01 13:48:19', '2020-07-01 13:48:48', '', '::1'),
(11484, 5, 22, 'palani', '2020-07-01 13:48:52', '2020-07-01 15:57:29', '', '::1'),
(11485, 5, 21, 'fransicschool', '2020-07-01 15:57:41', '0000-00-00 00:00:00', '', '::1'),
(11486, 5, 22, 'palani', '2020-07-01 18:42:00', '0000-00-00 00:00:00', '', '::1'),
(11487, 1, 6, 'admin', '2020-07-02 12:47:25', '2020-07-04 12:13:47', '', '::1'),
(11488, 1, 6, 'admin', '2020-07-04 12:13:36', '2020-07-04 12:13:47', '', '::1'),
(11489, 1, 1, 'superadmin', '2020-07-04 12:14:15', '2020-11-23 11:34:51', '', '::1'),
(11490, 1, 6, 'admin', '2020-10-14 13:30:45', '0000-00-00 00:00:00', '', '::1'),
(11491, 1, 6, 'admin', '2020-11-23 11:35:01', '0000-00-00 00:00:00', '', '::1'),
(11492, 1, 6, 'admin', '2020-12-03 10:52:29', '0000-00-00 00:00:00', '', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `mileage_report`
--

CREATE TABLE `mileage_report` (
  `id` int(11) NOT NULL,
  `vehicle_no` varchar(45) NOT NULL,
  `filled_date` varchar(45) NOT NULL,
  `filled_fuel` float NOT NULL,
  `pre_fuel_level` float NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_location_history`
--

CREATE TABLE `new_location_history` (
  `running_no` varchar(45) DEFAULT NULL,
  `updated_date` varchar(135) DEFAULT NULL,
  `availablity_status` varchar(3) DEFAULT NULL,
  `lat_message` varchar(60) DEFAULT NULL,
  `pre_lat_message` varchar(100) DEFAULT NULL,
  `lat_indicator` varchar(3) DEFAULT NULL,
  `lon_message` varchar(60) DEFAULT NULL,
  `pre_lon_message` varchar(100) DEFAULT NULL,
  `lon_indicator` varchar(3) DEFAULT NULL,
  `speed` varchar(15) DEFAULT '0',
  `pre_speed` double DEFAULT NULL,
  `time` varchar(135) DEFAULT NULL,
  `orientation` varchar(18) DEFAULT NULL,
  `io_state` varchar(24) DEFAULT NULL,
  `prev_io` int(11) DEFAULT NULL,
  `milepost` varchar(3) DEFAULT NULL,
  `miledata` varchar(24) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `pre_created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `deleted_date` varchar(135) DEFAULT NULL,
  `latlon_address` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `distance_travelled` double DEFAULT '0',
  `fuel_consume` double DEFAULT NULL,
  `email_count` double DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `fuel` varchar(100) DEFAULT NULL,
  `ad_val` varchar(100) DEFAULT NULL,
  `adc_val` varchar(100) DEFAULT NULL,
  `hire_status` int(11) DEFAULT NULL,
  `keyword` varchar(11) DEFAULT NULL,
  `trackersim` varchar(135) DEFAULT NULL,
  `gpssignal` varchar(135) DEFAULT NULL,
  `direction` varchar(24) DEFAULT NULL,
  `altitude` varchar(24) DEFAULT NULL,
  `acc_status` varchar(11) DEFAULT '0',
  `door_status` varchar(22) DEFAULT '0',
  `gpsv` varchar(45) NOT NULL DEFAULT '0',
  `fueltank1` varchar(255) DEFAULT NULL,
  `fueltank2` varchar(255) DEFAULT NULL,
  `temperature_sensor` varchar(255) DEFAULT NULL,
  `power_tamper_status` varchar(255) DEFAULT NULL,
  `device_model` varchar(255) DEFAULT NULL,
  `angle` varchar(45) DEFAULT '0',
  `mainpower` varchar(40) DEFAULT NULL,
  `maininput` varchar(40) DEFAULT NULL,
  `tamper` varchar(40) DEFAULT NULL,
  `packettype1` varchar(40) DEFAULT NULL,
  `packettype` int(10) NOT NULL DEFAULT '0',
  `zap` longtext,
  `traveled_distance` varchar(250) NOT NULL DEFAULT '0',
  `vehicle_sleep` int(11) DEFAULT NULL,
  `digital_output` int(11) DEFAULT NULL,
  `cell_id` varchar(35) DEFAULT NULL,
  `current_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `new_location_history`
--
DELIMITER $$
CREATE TRIGGER `vehicle_update` AFTER INSERT ON `new_location_history` FOR EACH ROW BEGIN

DECLARE new_odometer varchar(50);

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
  vehicle_id,
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
  activecode
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
  @vehicle_id,
  @client_id,
  @his_lat,
  @his_lng,
  @parked_status,
  @parked_date,
  @diff,
  @parking_alerttime,
  @speed_limit,
  @device_config_type,
  @activecode
FROM
  vehicle
WHERE
  v_running_no = NEW.running_no
ORDER BY
  vehicle_id DESC
LIMIT 1; 

IF @vehicle_id is not NULL AND @activecode = 1  AND NEW.packettype != '1' THEN

  UPDATE
    vehicle
  SET  
    updatedon = NEW.modified_date
  WHERE
    v_running_no = NEW.running_no;
END IF; 
  
SELECT start_odometer INTO @start_odometer FROM ignition_report WHERE device_no = NEW.running_no AND flag='1' ORDER BY report_id DESC LIMIT 1; 

IF NEW.traveled_distance != '0' AND NEW.traveled_distance != '0.0' AND NEW.traveled_distance != '0' THEN
 
  SET new_odometer = NEW.traveled_distance;
  
    
  ELSEIF NEW.lat_message!= '0.0' AND NEW.lon_message!= '0.0' AND NEW.distance_travelled != '0' AND NEW.distance_travelled != '0.0' AND NEW.distance_travelled != '0' THEN
  
    SET new_odometer = @odometer+NEW.distance_travelled;
    
END IF;

IF @vehicle_id is not NULL AND @activecode = 1 THEN

IF NEW.packettype != '1' THEN
  

  
 IF NEW.traveled_distance != '0' AND NEW.traveled_distance != '0.0' AND NEW.traveled_distance != 0  AND @device_config_type !='2' THEN
  UPDATE
    vehicle
  SET
    odometer = NEW.traveled_distance
  WHERE
    vehicle_id = @vehicle_id; 
    
  ELSEIF (NEW.distance_travelled != '0' AND NEW.distance_travelled != '0.0' AND NEW.distance_travelled != 0)  AND @device_config_type !='2' THEN
  
    UPDATE
    vehicle
  SET
    odometer = @odometer+NEW.distance_travelled
  WHERE
    vehicle_id = @vehicle_id;
    
END IF;



UPDATE
  vehicle
SET
  acc_on = NEW.acc_status,
  updatedon = NEW.modified_date,
  lat = NEW.lat_message,
  lng = NEW.lon_message,
  angle = NEW.angle,
  speed = NEW.speed,
  vehicle_sleep=NEW.vehicle_sleep,
  latlon_address=NEW.latlon_address,
  today_km=(new_odometer-@start_odometer)
WHERE
  vehicle_id = @vehicle_id; 




  IF(
    (
      @acc_flag = 1 OR @acc_flag = 0 OR @acc_flag IS NULL
    ) AND(NEW.acc_status = 1)
  ) THEN
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
    alert_location
  ) VALUE(
    5,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicle_id,
    @client_id,
    1,
    3,
    NEW.latlon_address
  );
UPDATE
  vehicle
SET
  r_acc_flag = 2,
  last_ign_on = NEW.modified_date,
  last_ign_off = NEW.modified_date,
  acc_date_time = NEW.modified_date
WHERE
  v_running_no = NEW.running_no;
INSERT
INTO
  ignition_report(
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
  @vehicle_id,
  '1',
  new_odometer,
  NEW.latlon_address
);
UPDATE
  idle_report
SET
  flag = '2',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = '1';
END IF; IF(
  NEW.speed = 0 AND @acc_flag = 2 AND NEW.acc_status = 1
) THEN
UPDATE
  vehicle
SET
  r_acc_flag = 3,
  last_ign_on = NEW.modified_date,
  last_ign_off = NEW.modified_date,
  acc_date_time = NEW.modified_date
WHERE
  v_running_no = NEW.running_no;
INSERT
INTO
  idlearea_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    start_location
  )
VALUES(
  '1',
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicle_id,
  NEW.latlon_address
);
END IF; IF(
  @acc_flag = 3 AND NEW.speed > 0 AND NEW.acc_status = 1
) THEN
UPDATE
  vehicle
SET
  r_acc_flag = 2,
  last_ign_on = NEW.modified_date,
  last_ign_off = NEW.modified_date,
  acc_date_time = NEW.modified_date
WHERE
  v_running_no = NEW.running_no;
UPDATE
  idlearea_report
SET
  flag = '2',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = '1';
END IF; IF(@acc_flag = 2 OR @acc_flag = 3) AND NEW.acc_status = 0 THEN
UPDATE
  vehicle
SET
  r_acc_flag = 0,
  r_acc_km = 0,
  last_ign_off = NEW.modified_date,
  last_ign_on = NEW.modified_date
WHERE
  v_running_no = NEW.running_no;
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
    alert_location
  ) VALUE(
    5,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicle_id,
    @client_id,
    0,
    4,
    NEW.latlon_address
  );
UPDATE
  ignition_report
SET
  flag = '2',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer=new_odometer,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = '1';
INSERT
INTO
  idle_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    start_location
  )
VALUES(
  '1',
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicle_id,
  NEW.latlon_address
);
UPDATE
  idlearea_report
SET
  flag = '2',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = '1';
END IF; 
    




  IF(
  (
    @ac_flag = 0 OR @ac_flag IS NULL
  ) AND(NEW.door_status = 1)
) THEN
UPDATE
  vehicle
SET
  ac_flag = 1,
  r_ac_flag=2
WHERE
  v_running_no = NEW.running_no;
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
  '1',
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicle_id,
  '1',
  new_odometer
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
    alert_location
  ) VALUE(
    7,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicle_id,
    @client_id,
    1,
    1,
    NEW.latlon_address
  );
END IF; 
IF @ac_flag = 2 AND NEW.door_status = 1 THEN
UPDATE
  vehicle
SET
  r_ac_km = @ac_km + find_distance(
    @lat,
    @lng,
    NEW.lat_message,
    NEW.lon_message
  )
WHERE
  v_running_no = NEW.running_no;
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
    alert_location
  ) VALUE(
    7,
    NEW.modified_date,
    NEW.lat_message,
    NEW.lon_message,
    @vehicle_id,
    @client_id,
    0,
    2,
    NEW.latlon_address
  );
UPDATE
  vehicle
SET
  ac_flag = 0,
  ac_km = 0,
  r_ac_flag=0
WHERE
  v_running_no = NEW.running_no;
UPDATE
  ac_report
SET
  flag = '2',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer=new_odometer
WHERE
  device_no = NEW.running_no AND flag = '1';
END IF; 
  





IF NEW.keyword = 'help me' THEN



UPDATE
  vehicle
SET
  help_me_alert = NEW.modified_date
WHERE
  vehicle_id = @vehicle_id;
END IF; 





IF NEW.keyword = 'low battery' THEN



UPDATE
  vehicle
SET
  low_battery_date = NEW.modified_date,
  low_battery_flag = 2
WHERE
  vehicle_id = @vehicle_id;
END IF; 





IF NEW.acc_status = '1' AND NEW.lat_message!='0.0' AND NEW.lon_message!='0.0' AND NEW.lat_message!="000000000" AND NEW.lon_message!='000000000' AND NEW.speed>4 THEN
INSERT
INTO
  play_back_history(
    running_no,
    lat_message,
    lon_message,
    speed,
    door_status,
    acc_status,
    modified_date,
    odometer,
    zap
  )
VALUES(
  NEW.running_no,
  NEW.lat_message,
  NEW.lon_message,
  NEW.speed,
  NEW.door_status,
  NEW.acc_status,
  NEW.modified_date,
  new_odometer,
  NEW.latlon_address
);
END IF;





IF NEW.speed != '0' THEN
UPDATE
  vehicle
SET
  parked_status = '0',
  parked_date = '0'
WHERE
  v_running_no = NEW.running_no;
END IF; IF NEW.speed = '0' AND @parked_status != '1' AND @parked_date != '1' THEN
UPDATE
  vehicle
SET
  parked_status = '1',
  parked_date = NEW.modified_date
WHERE
  v_running_no = NEW.running_no;
END IF; IF @diff > @parking_alerttime AND @parked_status = '1' THEN
UPDATE
  vehicle
SET
  parked_status = '0',
  parked_date = '1'
WHERE
  v_running_no = NEW.running_no;
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
    alert_location
  )
VALUES(
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  @vehicle_id,
  @client_id,
  32,
  1,
  1,
    NEW.latlon_address
);
END IF; 





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
    alert_location
  )
VALUES(
  NEW.speed,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  @vehicle_id,
  @client_id,
  5,
  1,
  1,
  1,
    NEW.latlon_address
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
    alert_location
  )
VALUES(
  NEW.speed,
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  @vehicle_id,
  @client_id,
  5,
  1,
  1,
  1,
    NEW.latlon_address
);
END IF;
END IF;








END IF;  


IF NEW.packettype = '1' THEN   



  IF @his_acc_status IS NULL THEN
UPDATE
  vehicle
SET
  his_acc_status = NEW.acc_status,
  his_acc_date = NEW.modified_date,
  his_acc_km = 0,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  v_running_no = NEW.running_no;
END IF; IF(
  (
    @his_acc_status = 1 OR @his_acc_status = 0
  ) AND(NEW.acc_status = 1) AND(@his_acc_status IS NOT NULL)
) THEN
UPDATE
  vehicle
SET
  his_acc_status = 2,
  his_acc_date = NEW.modified_date,
  his_acc_km = 0,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  v_running_no = NEW.running_no;
INSERT
INTO
  ignition_report(
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
  '3',
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicle_id,
  '3',
  new_odometer,
  NEW.latlon_address
);
UPDATE
  idle_report
SET
  flag = '4',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = '3';
END IF; IF @his_acc_status = 2 AND NEW.acc_status = 1 THEN
UPDATE
  vehicle
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
  v_running_no = NEW.running_no;
END IF; IF @his_acc_status = 2 AND NEW.acc_status = 0 THEN
UPDATE
  vehicle
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
  v_running_no = NEW.running_no;
UPDATE
  ignition_report
SET
  flag = '4',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer=new_odometer,
  end_location=NEW.latlon_address
WHERE
  device_no = NEW.running_no AND flag = '3';
INSERT
INTO
  idle_report(
    flag,
    s_lat,
    s_lng,
    start_day,
    device_no,
    vehicle_id,
    start_location
  )
VALUES(
  '3',
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicle_id,
  NEW.latlon_address
);
END IF; 
    




  IF @his_ac_status IS NULL THEN
UPDATE
  vehicle
SET
  his_ac_status = 0,
  his_ac_km = 0,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  v_running_no = NEW.running_no;
END IF; IF(
  (
   @his_ac_status = 0
  ) AND(NEW.door_status = 1) AND(@his_ac_status IS NOT NULL)
) THEN
UPDATE
  vehicle
SET
  his_ac_status = 2,
  his_lat = NEW.lat_message,
  his_lng = NEW.lon_message
WHERE
  v_running_no = NEW.running_no;
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
  '3',
  NEW.lat_message,
  NEW.lon_message,
  NEW.modified_date,
  NEW.running_no,
  @vehicle_id,
  '3',
  new_odometer
);
END IF; IF @his_ac_status = 2 AND NEW.door_status = 1 THEN
UPDATE
  vehicle
SET
  his_ac_km = @his_ac_km + find_distance(
    @his_lat,
    @his_lng,
    NEW.lat_message,
    NEW.lon_message
  )
WHERE
  v_running_no = NEW.running_no;
END IF; IF @his_ac_status = 2 AND NEW.door_status = 0 THEN
UPDATE
  vehicle
SET
  his_ac_status = 0,
  his_ac_km = 0
WHERE
  v_running_no = NEW.running_no;
UPDATE
  ac_report
SET
 
  flag = '2',
  end_day = NEW.modified_date,
  e_lat = NEW.lat_message,
  e_lng = NEW.lon_message,
  end_odometer=new_odometer
WHERE
  device_no = NEW.running_no AND flag = '3';
END IF; 





IF NEW.keyword = 'help me' THEN



UPDATE
  vehicle
SET
  help_me_alert = NEW.modified_date
WHERE
  vehicle_id = @vehicle_id;
END IF; 





IF NEW.keyword = 'low battery' THEN



UPDATE
  vehicle
SET
  low_battery_date = NEW.modified_date,
  low_battery_flag = 2
WHERE
  vehicle_id = @vehicle_id;
END IF; 





IF NEW.acc_status = '1' AND NEW.lat_message!='0.0' AND NEW.lon_message!='0.0' AND NEW.lat_message!="000000000" AND NEW.lon_message!='000000000' AND NEW.speed>4 THEN
INSERT
INTO
  play_back_history(
    running_no,
    lat_message,
    lon_message,
    speed,
    door_status,
    acc_status,
    modified_date,
    odometer,
    zap
  )
VALUES(
  NEW.running_no,
  NEW.lat_message,
  NEW.lon_message,
  NEW.speed,
  NEW.door_status,
  NEW.acc_status,
  NEW.modified_date,
  new_odometer,
  NEW.latlon_address
);
END IF;




END IF;
 
END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `created_on` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notificationAlert_IOS`
--

CREATE TABLE `notificationAlert_IOS` (
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
  `alert_type` varchar(450) CHARACTER SET utf8 DEFAULT NULL
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
  `alert_type` varchar(450) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obdii_data`
--

CREATE TABLE `obdii_data` (
  `obdii_data_id` int(11) NOT NULL,
  `vehicle_imei` varchar(50) NOT NULL,
  `number_of_dtc` decimal(8,4) NOT NULL,
  `engine_load` decimal(8,4) NOT NULL,
  `engine_coolant_temp` decimal(8,4) NOT NULL,
  `short_fuel_trim` decimal(8,4) NOT NULL,
  `fuel_pressure` decimal(8,4) NOT NULL,
  `intake_pressure` int(11) NOT NULL,
  `engine_rpm` int(11) NOT NULL,
  `vehicle_speed` decimal(10,4) NOT NULL,
  `timing_advance` int(11) NOT NULL,
  `air_pressure_intake` int(11) NOT NULL,
  `maf_airflow_rate` int(11) NOT NULL,
  `throttle_position` int(11) NOT NULL,
  `run_time` int(11) NOT NULL,
  `distance_traveled` decimal(8,4) NOT NULL,
  `fuel_rail_pressure_relative` decimal(8,4) NOT NULL,
  `fuel_rail_pressure_direct` decimal(8,4) NOT NULL,
  `commanded_egr` int(11) NOT NULL,
  `egr_error` int(11) NOT NULL,
  `fuel_level` decimal(8,4) NOT NULL,
  `distance_traveled_codeclean` decimal(8,4) NOT NULL,
  `barometric_pressure` decimal(8,4) NOT NULL,
  `control_module_volt` double NOT NULL,
  `load_value_absolute` decimal(8,4) NOT NULL,
  `ambient_air_temp` decimal(8,4) NOT NULL,
  `runtime_with_mil` int(11) NOT NULL,
  `trouble_code_cleared_time` int(11) NOT NULL,
  `fuel_rail_pressure_absolute` decimal(8,4) NOT NULL,
  `battery_remaining_life` int(11) NOT NULL,
  `engine_oil_temp` decimal(8,4) NOT NULL,
  `fuel_injection_timing` int(11) NOT NULL,
  `engine_fuel_rate` decimal(8,4) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `parent_father_name` varchar(255) DEFAULT NULL,
  `parent_mother_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `primary_mobile_number` varchar(255) DEFAULT NULL,
  `secondary_mobile_number` varchar(255) DEFAULT NULL,
  `parent_createdby` int(11) DEFAULT NULL,
  `parent_createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `parent_updateby` int(11) DEFAULT NULL,
  `parent_updatedate` datetime DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `parent_father_name`, `parent_mother_name`, `email`, `address`, `primary_mobile_number`, `secondary_mobile_number`, `parent_createdby`, `parent_createdate`, `parent_updateby`, `parent_updatedate`, `role_id`, `client_id`) VALUES
(26, 'raman', 'ranjani', 'dsfdsg@gmail.co', 'karaikudi', '9944145188', '963521478', 6, '2020-06-22 15:05:20', 6, '2020-06-23 06:57:24', 7, 1),
(27, 'nagaraj', 'vanitha', 'dsfdsg@gmail.co', 'karaikudi', '9944145188', '963521478', 6, '2020-06-23 07:01:10', NULL, '2020-06-23 10:31:10', 7, 1),
(28, 'mmmm', 'yyyy', 'dsfdsg@gmail.co', 'dff', '9944145188', '963521478', 19, '2020-06-29 08:36:56', NULL, '2020-06-29 12:06:56', 7, 2),
(29, 'Palani', 'Chitra', 'prakashpalani001@gmail.com', 'thondi', '9788212547', '9688187834', 21, '2020-07-01 09:41:37', NULL, '2020-07-01 13:11:37', 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `payment_mode_id` int(11) NOT NULL,
  `payment_mode` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `play_back_history`
--

CREATE TABLE `play_back_history` (
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
  `zap` longtext,
  `packet` varchar(255) DEFAULT NULL,
  `odometer` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(450) DEFAULT NULL,
  `roles` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `roles`) VALUES
(1, 'Super admin', 'ROLE_SUPERADMIN'),
(2, 'Dealer', 'ROLE_DELEAR'),
(3, 'Admin', 'ROLE_ADMIN'),
(4, 'Vehicle Owner', 'ROLE_OWNER'),
(5, 'User', 'ROLE_USER'),
(6, 'Staff', 'ROLE_STAFF'),
(7, 'Parent', 'ROLE PARENT');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `route_name` varchar(45) DEFAULT NULL,
  `route_start_locationname` varchar(255) DEFAULT NULL,
  `route_start_lat` double DEFAULT NULL,
  `route_start_lng` double DEFAULT NULL,
  `route_end_locationname` varchar(255) DEFAULT NULL,
  `route_end_lat` double DEFAULT NULL,
  `route_end_lng` double DEFAULT NULL,
  `route_createdby` varchar(11) DEFAULT NULL,
  `route_createddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `route_updatedby` varchar(11) DEFAULT NULL,
  `route_updateddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `route_status` int(11) DEFAULT NULL,
  `route_starttime` varchar(10) DEFAULT NULL,
  `route_endtime` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `client_id`, `route_name`, `route_start_locationname`, `route_start_lat`, `route_start_lng`, `route_end_locationname`, `route_end_lat`, `route_end_lng`, `route_createdby`, `route_createddate`, `route_updatedby`, `route_updateddate`, `route_status`, `route_starttime`, `route_endtime`) VALUES
(1, 1, 'Railway Station To Ukkatam', 'thinaiyathur', 10.063884, 76.9221473, 'Thanjavur', 11.106376, 76.9221473, '6', '2020-06-11 23:20:32', '6', '2020-06-20 04:54:09', 1, '05:41 PM', '05:47 PM'),
(2, 1, 'ganthipuram To Singanallur', 'Ramnad', 11.041355, 76.9222331, 'chennai', 54456, 45646, '6', '2020-06-11 03:18:05', '6', '2020-06-20 04:58:43', 1, '05:15 PM', '05:16 PM'),
(4, 1, 'kanuvai To Edaiyarpalayam', 'kanuvai', 11.0406811, 76.9187707, 'edayarpalayam', 455665, 564665, '6', '2020-06-11 03:16:32', '6', '2020-06-20 04:58:53', 1, '05:46 PM', '05:50 PM'),
(5, 1, 'tvs Nagar To Velandipalayam', 'kanuvai', 11.02144, 76.9306966, 'velandipalayam', 656654, 545, '6', '2020-06-11 23:19:49', '6', '2020-06-20 04:59:05', 1, '01:49 PM', '01:50 PM'),
(6, 2, 'saravanampatti to Ganapathi', 'saravanampatti', 11.047136, 76.9225282, 'ganapathi', 10.02144, 72.9306966, '6', '2020-06-12 06:43:26', '19', '2020-06-28 22:17:55', 1, '09:12 PM', '10:12 PM'),
(8, 2, 'townholl To Ukkatam', 'kulathur', 556, 66554, 'ganapathi', 666, 645, '19', '2020-06-28 22:45:27', NULL, '0000-00-00 00:00:00', NULL, '12:15 PM', '01:15 PM'),
(9, 5, 'Sungam To Singanallur', 'Sungam', 11.654564, 74.558255, 'Singanallur', 11.888787, 14.5445648, '21', '2020-06-30 22:44:51', NULL, '0000-00-00 00:00:00', NULL, '01:13 PM', '01:30 PM'),
(10, 8, 'thondi to Madurai', 'thondi', 22.4353, 23.42355, 'madurai', 11.4354356, 11.2432353, '15', '2020-10-13 03:16:31', NULL, '0000-00-00 00:00:00', NULL, '12:15 PM', '12:18 PM');

-- --------------------------------------------------------

--
-- Table structure for table `route_assign`
--

CREATE TABLE `route_assign` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `travel_startdate` varchar(10) NOT NULL,
  `travel_enddate` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_assign`
--

INSERT INTO `route_assign` (`id`, `client_id`, `vehicle_id`, `route_id`, `travel_startdate`, `travel_enddate`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(12, 1, 510, 4, '2020-06-16', '2020-06-17', 6, '2020-06-16 16:34:34', 6, '2020-06-16 16:44:01'),
(13, 1, 509, 1, '2020-06-16', '2020-06-24', 6, '2020-06-16 16:58:54', 0, ''),
(16, 2, 511, 8, '2020-07-22', '2020-07-27', 19, '2020-07-01 09:08:10', 19, '2020-07-01 09:36:58'),
(17, 5, 512, 9, '2020-07-01', '2020-07-22', 21, '2020-07-01 10:18:38', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `route_deviate_report`
--

CREATE TABLE `route_deviate_report` (
  `rd_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_imei` varchar(255) DEFAULT NULL,
  `route_deviate_outtime` datetime DEFAULT NULL,
  `route_deviate_intime` datetime DEFAULT NULL,
  `route_out_location` varchar(255) NOT NULL,
  `route_in_location` varchar(255) NOT NULL,
  `route_out_lat` float NOT NULL,
  `route_out_lng` float NOT NULL,
  `route_in_lat` float NOT NULL,
  `route_in_lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_deviation`
--

CREATE TABLE `route_deviation` (
  `route_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `route_name` varchar(45) NOT NULL,
  `route_start_locationname` varchar(255) NOT NULL,
  `route_start_lat` double NOT NULL,
  `route_start_lng` double NOT NULL,
  `route_end_locationname` varchar(255) NOT NULL,
  `route_end_lat` double NOT NULL,
  `route_end_lng` double NOT NULL,
  `route_createdby` varchar(11) NOT NULL,
  `route_createddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `route_updatedby` varchar(11) NOT NULL,
  `route_updateddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `route_status` int(11) NOT NULL,
  `route_starttime` varchar(10) NOT NULL,
  `route_endtime` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_deviation_assign`
--

CREATE TABLE `route_deviation_assign` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `travel_startdate` varchar(10) NOT NULL,
  `travel_enddate` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_deviation_latlng`
--

CREATE TABLE `route_deviation_latlng` (
  `latlng_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `route_lat_lng` varchar(255) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_deviation_new`
--

CREATE TABLE `route_deviation_new` (
  `rd_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `start_lat` varchar(255) DEFAULT NULL,
  `start_lng` varchar(255) DEFAULT NULL,
  `end_lat` varchar(255) DEFAULT NULL,
  `end_lng` varchar(255) DEFAULT NULL,
  `all_status` int(11) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_deviation_new`
--

INSERT INTO `route_deviation_new` (`rd_id`, `client_id`, `route_id`, `vehicle_id`, `start_lat`, `start_lng`, `end_lat`, `end_lng`, `all_status`, `createdon`, `updatedon`, `flag`) VALUES
(54, 1, 1, 509, '11.047059', '76.921074', NULL, NULL, 6, '2020-06-27 18:49:13', NULL, 1),
(55, 1, 1, 509, '11.047059', '76.921074', NULL, NULL, 6, '2020-06-29 13:59:24', NULL, 1),
(56, 1, 1, 509, '11.047059', '76.921074', NULL, NULL, 6, '2020-06-29 13:59:24', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `route_latlng`
--

CREATE TABLE `route_latlng` (
  `latlng_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `route_lat` varchar(255) DEFAULT NULL,
  `route_lng` varchar(255) DEFAULT NULL,
  `stop_point` varchar(11) DEFAULT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_latlng`
--

INSERT INTO `route_latlng` (`latlng_id`, `client_id`, `route_id`, `route_lat`, `route_lng`, `stop_point`, `created_datetime`, `updated_datetime`) VALUES
(1, 1, 1, '11.047092', '76.924327', 'tvs Nagar', '2020-06-25 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 1, '11.0411198', '76.9139716', NULL, NULL, '0000-00-00 00:00:00'),
(3, 1, 1, '11.045564', '76.922233', NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `route_report`
--

CREATE TABLE `route_report` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_imei` varchar(250) DEFAULT NULL,
  `start_location` varchar(250) DEFAULT NULL,
  `start_lat` varchar(11) DEFAULT NULL,
  `start_lng` varchar(11) DEFAULT NULL,
  `route_start_time` datetime NOT NULL,
  `start_to_route` int(11) DEFAULT NULL,
  `end_location` varchar(250) DEFAULT NULL,
  `end_lat` varchar(11) DEFAULT NULL,
  `end_lng` varchar(11) DEFAULT NULL,
  `route_end_time` datetime DEFAULT NULL,
  `end_to_route` int(11) DEFAULT NULL,
  `start_odo` varchar(100) DEFAULT NULL,
  `end_odo` varchar(100) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_report`
--

INSERT INTO `route_report` (`id`, `client_id`, `route_id`, `vehicle_imei`, `start_location`, `start_lat`, `start_lng`, `route_start_time`, `start_to_route`, `end_location`, `end_lat`, `end_lng`, `route_end_time`, `end_to_route`, `start_odo`, `end_odo`, `flag`, `create_date`) VALUES
(65, 1, 1, '985623147521', 'ramnad', '10.9971942', '76.9552646', '2020-06-26 16:24:48', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-06-26 16:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `route_stops`
--

CREATE TABLE `route_stops` (
  `stop_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `stop_name` varchar(255) DEFAULT NULL,
  `stop_lat` varchar(25) DEFAULT NULL,
  `stop_long` varchar(25) DEFAULT NULL,
  `stop_arrival_time` varchar(11) DEFAULT NULL,
  `stop_start_time` varchar(11) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_id` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `arriving_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_stops`
--

INSERT INTO `route_stops` (`stop_id`, `route_id`, `client_id`, `stop_name`, `stop_lat`, `stop_long`, `stop_arrival_time`, `stop_start_time`, `created_id`, `created_datetime`, `updated_id`, `updated_datetime`, `status`, `arriving_status`) VALUES
(1, 1, 1, 'Five Corner', '11.6553', '76.6696', '04:57 PM', '04:57 PM', NULL, NULL, 6, '2020-07-01 08:51:40', 1, NULL),
(2, 2, 1, 'sungam', '546', '7566', '04:58 PM', '04:58 PM', 6, '2020-06-26 13:28:59', NULL, NULL, 1, NULL),
(3, 2, 1, 'olambus', '24343', '43435', '04:59 PM', '05:00 PM', 6, '2020-06-26 13:29:24', NULL, NULL, 1, NULL),
(4, 4, 1, 'kanuvai', '2434', '5435', '05:59 PM', '06:59 PM', 6, '2020-06-26 13:29:45', NULL, NULL, 1, NULL),
(5, 4, 1, 'Tvs nagar', '3455', '65446', '04:59 PM', '06:59 PM', 6, '2020-06-26 13:30:01', NULL, NULL, 1, NULL),
(6, 5, 1, 'edayarpalayam', '4354', '5546', '05:00 PM', '05:02 PM', 6, '2020-06-26 13:30:28', NULL, NULL, 1, NULL),
(7, 5, 1, 'velandipalayam', '545', '54456', '05:00 PM', '05:03 PM', 6, '2020-06-26 13:30:50', NULL, NULL, 1, NULL),
(8, 6, 1, 'Gp', '435', '654', '05:01 PM', '05:00 PM', 6, '2020-06-26 13:31:11', NULL, NULL, 1, NULL),
(9, 6, 1, 'Ganapathi', '4354', '56456', '05:00 PM', '05:03 PM', 6, '2020-06-26 13:31:25', NULL, NULL, 1, NULL),
(10, 6, 2, 'saibaba Colony', '435554', '5466', '12:48 PM', '12:48 PM', 19, '2020-06-29 09:18:49', NULL, NULL, 1, NULL),
(11, 8, 2, 'tirupur', '44', '54656', '01:15 PM', '01:15 PM', 19, '2020-06-29 09:45:41', NULL, NULL, 1, NULL),
(16, 1, 1, 'tirupur', '12.9679', '34.5096', '07:12 PM', '08:15 PM', 6, '2020-06-29 15:42:31', 6, '2020-07-01 08:52:33', 1, NULL),
(21, 1, 43, 'edayarpalayam', '12', '34', '10:52 AM', '10:52 AM', 39, '2020-06-30 07:48:12', NULL, NULL, 1, NULL),
(34, 5, 2, 'sivaji Colony', '11.5655', '11.5456', '12:38 PM', '12:38 PM', 19, '2020-07-01 09:09:08', NULL, NULL, 1, NULL),
(35, 9, 5, 'olambus', '11.5465', '45.5465', '01:14 PM', '01:14 PM', 21, '2020-07-01 09:45:20', NULL, NULL, 1, NULL),
(36, 10, 8, 'Thinaiyathur', '11.5465', '11.4356', '12:23 PM', '12:26 PM', 15, '2020-10-13 08:53:39', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `route_temp_latlng`
--

CREATE TABLE `route_temp_latlng` (
  `latlng_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `random_number` varchar(50) DEFAULT NULL,
  `route_lat_lng` varchar(255) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ryot_registration`
--

CREATE TABLE `ryot_registration` (
  `id` int(11) NOT NULL,
  `ryot_number` varchar(45) DEFAULT NULL,
  `ryot_name` varchar(45) DEFAULT NULL,
  `plot_number` varchar(45) DEFAULT NULL,
  `distreg` varchar(45) DEFAULT NULL,
  `wmntsln` varchar(45) DEFAULT NULL,
  `arrival_date` varchar(75) DEFAULT NULL,
  `departure_date` varchar(75) DEFAULT NULL,
  `cwsin` varchar(45) DEFAULT NULL,
  `pvillage` varchar(45) DEFAULT NULL,
  `source_geozone` varchar(45) DEFAULT NULL,
  `division` varchar(45) DEFAULT NULL,
  `vehicle` varchar(45) DEFAULT NULL,
  `arrival_address` varchar(45) DEFAULT NULL,
  `departure_address` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_date` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
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

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`, `section_createdby`, `section_createddate`, `section_updatedby`, `section_updateddate`, `class_id`, `client_id`, `status`) VALUES
(2, 'A', 6, '2020-06-09 15:36:33', 6, '2020-06-29 14:20:08', 2, 1, 1),
(3, 'C', 3, '2020-06-10 00:00:00', 6, '2020-06-29 14:20:26', 4, 1, 1),
(5, 'B', 0, '0000-00-00 00:00:00', 6, '2020-06-10 15:45:04', 2, 1, 1),
(6, 'A', 6, '2020-06-11 07:45:54', 6, '2020-06-29 14:20:42', 4, 1, 1),
(7, 'C', 6, '2020-06-11 07:47:52', 6, '2020-06-11 07:48:15', 2, 1, 1),
(8, 'A', 6, '2020-06-11 07:49:02', 0, '0000-00-00 00:00:00', 3, 1, 1),
(9, 'B', 6, '2020-06-11 07:53:36', 0, '0000-00-00 00:00:00', 3, 1, 1),
(10, 'C', 6, '2020-06-11 07:53:44', 0, '0000-00-00 00:00:00', 3, 1, 1),
(12, 'B', 6, '2020-06-12 17:41:02', 0, '0000-00-00 00:00:00', 4, 1, 1),
(14, 'A', 19, '2020-06-29 09:03:48', 0, '0000-00-00 00:00:00', 5, 2, 1),
(15, 'A', 19, '2020-06-29 09:20:10', 0, '0000-00-00 00:00:00', 1, 2, 1),
(16, 'A', 21, '2020-07-01 09:42:50', 0, '0000-00-00 00:00:00', 6, 5, 1);

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

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `contact_person`, `company_email`, `primary_mobile`, `secondary_mobile`, `company_address`, `UpdatedBy`, `updated_datetime`) VALUES
(1, 'sproutwings', 'prakash', 'support@sproutwings.in', '9688022225', '9688022228', 'covai', 1, '2020-06-15 14:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `sms_alert`
--

CREATE TABLE `sms_alert` (
  `sms_alert_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_number` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `speed` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `lng` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `phoneno` varchar(45) DEFAULT NULL,
  `deviation` varchar(45) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `all_status` int(11) DEFAULT NULL,
  `show_status` int(11) DEFAULT '1',
  `sms_status` int(11) DEFAULT '1',
  `play_status` int(11) DEFAULT '1',
  `email_status` int(11) NOT NULL DEFAULT '0',
  `send_sms_status` int(11) NOT NULL DEFAULT '0',
  `geo_location_name` varchar(45) DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_device_list`
--

CREATE TABLE `stock_device_list` (
  `id` int(11) NOT NULL,
  `device_imei` varchar(100) NOT NULL,
  `device_model` varchar(150) NOT NULL,
  `device_categary` varchar(100) NOT NULL,
  `device_cost` int(100) NOT NULL,
  `device_number` int(100) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_by` varchar(200) NOT NULL,
  `modify_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(11) NOT NULL COMMENT '1=active, 0=deactive',
  `join_tech_no` varchar(40) DEFAULT NULL,
  `s_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_device_list`
--

INSERT INTO `stock_device_list` (`id`, `device_imei`, `device_model`, `device_categary`, `device_cost`, `device_number`, `created_by`, `created_datetime`, `modify_by`, `modify_datetime`, `status`, `join_tech_no`, `s_type`) VALUES
(694, '852145366852145', 'TWN1', '1', 0, 0, '1', '2020-06-05 02:52:29', '', '2020-06-05 02:52:29', 1, '', 1),
(695, '985623147521', 'TW100', '1', 0, 0, '1', '2020-06-05 06:58:06', '', '2020-06-05 06:58:06', 1, '', 1),
(696, '963214587452', 'TW100', '1', 0, 0, '1', '2020-06-05 06:58:27', '', '2020-06-05 06:58:27', 1, '', 1),
(697, '3598745621452', 'TWN2', '1', 0, 0, '1', '2020-07-01 02:45:09', '', '2020-07-01 02:45:09', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_sim_list`
--

CREATE TABLE `stock_sim_list` (
  `id` int(11) NOT NULL,
  `sim_number` varchar(100) NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `network` varchar(150) NOT NULL,
  `device_id` int(11) NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_by` varchar(150) NOT NULL,
  `modify_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(50) NOT NULL COMMENT '1=active, 0=deactive',
  `temp` varchar(45) DEFAULT NULL,
  `s_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_sim_list`
--

INSERT INTO `stock_sim_list` (`id`, `sim_number`, `mobile_number`, `network`, `device_id`, `created_by`, `created_datetime`, `modify_by`, `modify_datetime`, `status`, `temp`, `s_type`) VALUES
(524, '34567890786', '9685214757', 'Vodafone', 0, '1', '2020-06-04 23:22:13', '1', '2020-06-05 02:52:13', 1, NULL, 1),
(525, '965845235621', '9658478236', 'Airtel', 0, '1', '2020-06-05 03:27:18', '1', '2020-06-05 06:57:18', 1, NULL, 1),
(526, '8965214563214', '9632145870', 'Airtel', 0, '1', '2020-06-05 03:27:41', '1', '2020-06-05 06:57:41', 1, NULL, 1),
(527, '9688187834', '9688187834', 'Airtel', 0, '1', '2020-06-30 23:14:47', '1', '2020-07-01 02:44:47', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(45) NOT NULL,
  `student_dob` varchar(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `section_id` varchar(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL,
  `class_id` varchar(11) NOT NULL,
  `student_createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `student_createdby` varchar(11) NOT NULL,
  `student_updatedby` varchar(11) NOT NULL,
  `student_updateddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `student_rollno` int(50) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_dob`, `parent_id`, `client_id`, `section_id`, `route_id`, `stop_id`, `class_id`, `student_createddate`, `student_createdby`, `student_updatedby`, `student_updateddate`, `student_rollno`, `status`) VALUES
(5, 'arun', '06/09/2020', 27, 1, '9', 4, 4, '3', '2020-06-29 06:51:27', '6', '6', '2020-06-29 03:21:27', 1000, '1'),
(7, 'prakash', '06/09/2020', 26, 1, '8', 1, 1, '3', '2020-06-29 06:50:54', '6', '6', '2020-06-29 03:20:54', 1001, '1'),
(8, 'guna', '06/09/2020', 27, 1, '5', 5, 6, '2', '2020-06-26 06:06:27', '6', '10', '2020-06-21 22:04:07', 1002, '1'),
(9, 'vicky', '06/10/2020', 26, 1, '5', 2, 3, '2', '2020-06-30 01:14:48', '6', '6', '2020-06-29 21:44:48', 1004, '1'),
(10, 'munish', '06/22/2020', 28, 2, '14', 8, 11, '5', '2020-07-01 02:06:29', '19', '19', '2020-06-30 22:36:29', 1104, '1'),
(11, 'Prakash', '20/03/98', 29, 5, '16', 9, 35, '6', '2020-06-30 22:46:09', '21', '', '0000-00-00 00:00:00', 1212, '1');

-- --------------------------------------------------------

--
-- Table structure for table `today_admin_alert`
--

CREATE TABLE `today_admin_alert` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `lng` varchar(45) DEFAULT NULL,
  `geo_location_name` varchar(45) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `vehicle_name` varchar(450) DEFAULT NULL,
  `vehicle_register_number` varchar(450) DEFAULT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `all_status` int(11) DEFAULT NULL,
  `show_status` int(11) DEFAULT NULL,
  `alert_type` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `today_sms_alert`
--

CREATE TABLE `today_sms_alert` (
  `sms_alert_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_number` varchar(45) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `speed` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `lng` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `phoneno` varchar(45) DEFAULT NULL,
  `deviation` varchar(45) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `all_status` int(11) DEFAULT NULL,
  `show_status` int(11) DEFAULT '1',
  `sms_status` int(11) DEFAULT '1',
  `play_status` int(11) DEFAULT '1',
  `email_status` int(11) NOT NULL DEFAULT '0',
  `send_sms_status` int(11) NOT NULL DEFAULT '0',
  `geo_location_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_geo_solution_data`
--

CREATE TABLE `trip_geo_solution_data` (
  `id` bigint(20) NOT NULL,
  `lat` varchar(10) DEFAULT NULL,
  `lng` varchar(10) DEFAULT NULL,
  `geo_location_id` int(11) NOT NULL,
  `g_lat` varchar(25) NOT NULL,
  `g_lng` varchar(25) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `ignition_status` varchar(10) DEFAULT NULL,
  `ac_status` varchar(10) DEFAULT NULL,
  `distance` varchar(45) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `location_status` int(11) DEFAULT NULL,
  `out_datetime` datetime NOT NULL,
  `in_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_solution_data`
--

CREATE TABLE `trip_solution_data` (
  `id` bigint(20) NOT NULL,
  `lat` varchar(10) DEFAULT NULL,
  `lng` varchar(10) DEFAULT NULL,
  `g_id` bigint(20) NOT NULL,
  `g_lat` varchar(25) NOT NULL,
  `g_lng` varchar(25) NOT NULL,
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
-- Table structure for table `trip_solution_location`
--

CREATE TABLE `trip_solution_location` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(10) NOT NULL,
  `lat` varchar(45) NOT NULL,
  `lng` varchar(45) NOT NULL,
  `circle_size` varchar(10) NOT NULL,
  `location_name` varchar(450) NOT NULL,
  `created_on` varchar(45) NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_on` varchar(45) NOT NULL,
  `updated_by` varchar(45) NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `active_code` int(11) NOT NULL,
  `primary_hub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `secondary_password` varchar(255) NOT NULL,
  `enabled` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `createdon` datetime NOT NULL,
  `createdby` varchar(45) NOT NULL,
  `updatedon` datetime NOT NULL,
  `updatedby` varchar(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(45) NOT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(450) DEFAULT NULL,
  `pincode` varchar(45) DEFAULT NULL,
  `log_in_datetime` datetime DEFAULT NULL,
  `log_out_datetime` datetime DEFAULT NULL,
  `logged_in` int(11) DEFAULT NULL,
  `activecode` int(11) NOT NULL,
  `non_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `secondary_password`, `enabled`, `firstname`, `lastname`, `createdon`, `createdby`, `updatedon`, `updatedby`, `client_id`, `parent_id`, `role_id`, `email`, `phone`, `mobile`, `gender`, `address`, `pincode`, `log_in_datetime`, `log_out_datetime`, `logged_in`, `activecode`, `non_user`) VALUES
(1, 'superadmin', 'ae6bde22c36ae59daf97463b06d7f43b', '0a3b73900222ea0456be3295445dbb96', 1, 'Superadmin', '', '2020-06-22 15:27:41', '1', '0000-00-00 00:00:00', NULL, 1, NULL, 1, 'prakash12@gmail.com', '', '6374241048', '', 'karaikudi', NULL, '2020-07-04 12:14:10', '2020-11-23 11:34:51', 0, 1, 0),
(6, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '0a3b73900222ea0456be3295445dbb96', 0, 'Scm School', '', '2020-06-22 13:23:06', '1', '2020-11-23 07:05:21', '6', 1, NULL, 3, 'francisschool@email.com', '', '0456325892', 'M', 'c.k.mangalam', NULL, '2020-12-03 10:52:29', '2020-07-04 12:13:47', 1, 1, 0),
(17, 'raman', '3844301990a720cc8302475ce63af544', '0a3b73900222ea0456be3295445dbb96', 0, 'raman', '', '2020-06-23 06:57:24', '6', '0000-00-00 00:00:00', NULL, 1, 26, 7, 'dsfdsg@gmail.co', '', '9944145188', '', 'karaikudi', NULL, '2020-06-29 16:32:37', '2020-06-29 16:37:30', 0, 1, 0),
(18, 'nagaraj', '3844301990a720cc8302475ce63af544', '0a3b73900222ea0456be3295445dbb96', 0, 'nagaraj', '', '2020-06-23 07:01:11', '6', '0000-00-00 00:00:00', NULL, 1, 27, 7, 'dsfdsg@gmail.co', '', '9944145188', '', 'karaikudi', NULL, '2020-06-23 10:57:51', '2020-06-23 15:03:55', 0, 1, 0),
(19, 'scmschool', '3844301990a720cc8302475ce63af544', '0a3b73900222ea0456be3295445dbb96', 0, 'Scm ', '', '2020-06-29 08:17:02', '1', '2020-06-29 08:17:15', '1', 2, NULL, 3, 'dsfdsg@gmail.co', '6352147856', '9856321475', 'M', '', NULL, '2020-07-01 12:43:58', '2020-07-01 13:07:59', 0, 1, 0),
(20, 'mmm', '3844301990a720cc8302475ce63af544', '0a3b73900222ea0456be3295445dbb96', 0, 'mmmm', '', '2020-06-29 08:36:56', '19', '0000-00-00 00:00:00', NULL, 2, 28, 7, 'dsfdsg@gmail.co', '', '9944145188', '', 'dff', NULL, '2020-06-29 16:57:18', '2020-06-29 16:57:37', 0, 1, 0),
(21, 'fransicschool', '3844301990a720cc8302475ce63af544', '0a3b73900222ea0456be3295445dbb96', 0, 'Francis School', '', '2020-07-01 09:39:52', '1', '0000-00-00 00:00:00', NULL, 5, NULL, 3, 'dsfdsg@gmail.co', '', '6374241048', '', 'c.k.Mangalam.', NULL, '2020-07-01 15:57:36', '2020-07-01 13:48:48', 1, 1, 0),
(22, 'palani', '3844301990a720cc8302475ce63af544', '0a3b73900222ea0456be3295445dbb96', 0, 'Palani', '', '2020-07-01 09:41:37', '21', '0000-00-00 00:00:00', NULL, 5, 29, 7, 'prakashpalani001@gmail.com', '', '9788212547', '', 'thondi', NULL, '2020-07-01 18:42:00', '2020-07-01 15:57:29', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `vehicle_name` varchar(45) DEFAULT NULL,
  `vehicle_model` varchar(45) DEFAULT NULL,
  `vehicle_number` varchar(45) DEFAULT NULL,
  `vehicle_register_number` varchar(45) DEFAULT NULL,
  `v_running_no` varchar(45) DEFAULT NULL,
  `sim_number` varchar(20) NOT NULL,
  `acc_on` varchar(45) DEFAULT NULL,
  `activecode` int(11) DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(45) DEFAULT NULL,
  `sale_start_day` varchar(45) DEFAULT NULL,
  `sale_end_day` varchar(45) DEFAULT NULL,
  `device_id` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `acc_date_time` varchar(45) DEFAULT NULL,
  `temperature` varchar(45) DEFAULT NULL,
  `temperature_date_time` varchar(45) DEFAULT NULL,
  `hub_ETA` varchar(45) DEFAULT NULL,
  `acc_flag` varchar(11) DEFAULT '1',
  `help_me_alert_date` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT '11.021729',
  `lng` varchar(45) DEFAULT '76.940045',
  `latlon_address` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `low_battery_date` varchar(45) DEFAULT NULL,
  `low_battery_flag` varchar(45) DEFAULT NULL,
  `v_rfid` varchar(45) DEFAULT NULL,
  `keyword` varchar(45) DEFAULT NULL,
  `help_me_alert` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `last_ign_on` varchar(45) DEFAULT '0',
  `last_ign_off` varchar(45) DEFAULT '0',
  `speed` varchar(45) DEFAULT NULL,
  `meter` varchar(45) DEFAULT NULL,
  `fueltank` varchar(45) DEFAULT NULL,
  `ac_flag` varchar(45) NOT NULL DEFAULT '0',
  `ac_date` varchar(45) DEFAULT NULL,
  `ac_km` varchar(45) DEFAULT NULL,
  `route_deviation` int(11) DEFAULT NULL,
  `speed_limit` int(11) DEFAULT NULL,
  `v_distance_travelled` varchar(45) DEFAULT NULL,
  `v_door_status` int(11) DEFAULT NULL,
  `today_km` double DEFAULT NULL,
  `today_date` varchar(45) DEFAULT NULL,
  `today_fuel_usage` int(11) DEFAULT NULL,
  `fuel_ltr` double DEFAULT NULL,
  `mileage` varchar(10) NOT NULL DEFAULT '0',
  `fuel_tank_capacity` int(11) DEFAULT NULL,
  `fuel_is_set` int(11) NOT NULL DEFAULT '0',
  `power_off_date` varchar(45) DEFAULT NULL,
  `power_off_flag` int(11) DEFAULT NULL,
  `car_battery` varchar(45) DEFAULT '0',
  `device_battery` varchar(45) DEFAULT NULL,
  `device_charge_status` varchar(10) DEFAULT NULL,
  `unique_id` varchar(45) DEFAULT NULL,
  `vehicle_type` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `device_assign_datetiem` varchar(45) DEFAULT NULL,
  `device_assign_by` varchar(45) DEFAULT NULL,
  `last` varchar(45) DEFAULT '0',
  `fuel_odo` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `angle` double DEFAULT '0',
  `acc_status` varchar(45) DEFAULT NULL,
  `traveled_distance` varchar(45) NOT NULL DEFAULT '0',
  `litres` varchar(45) NOT NULL DEFAULT '0',
  `fuel_model` int(11) DEFAULT NULL,
  `fuel_tank_type` varchar(45) DEFAULT NULL,
  `tank_length` varchar(45) DEFAULT NULL,
  `tank_width` varchar(45) DEFAULT NULL,
  `tank_height` varchar(45) DEFAULT NULL,
  `devicetime` varchar(45) DEFAULT NULL,
  `devicetime_updated` varchar(45) DEFAULT NULL,
  `parked_status` int(11) DEFAULT NULL,
  `parked_date` varchar(45) DEFAULT NULL,
  `parking_alerttime` int(11) DEFAULT NULL,
  `r_acc_date_time` varchar(45) DEFAULT NULL,
  `r_acc_flag` varchar(11) DEFAULT NULL,
  `r_acc_km` varchar(11) DEFAULT NULL,
  `r_ac_date_time` varchar(45) DEFAULT NULL,
  `r_ac_flag` varchar(11) DEFAULT NULL,
  `r_ac_km` varchar(11) DEFAULT NULL,
  `odometer` varchar(45) DEFAULT '0',
  `his_acc_status` varchar(11) DEFAULT NULL,
  `his_acc_date` varchar(45) DEFAULT NULL,
  `his_acc_km` varchar(11) DEFAULT NULL,
  `his_ac_status` varchar(11) DEFAULT NULL,
  `his_ac_date` varchar(11) DEFAULT NULL,
  `his_ac_km` varchar(11) DEFAULT NULL,
  `his_date_time` varchar(45) DEFAULT NULL,
  `his_lat` varchar(45) DEFAULT NULL,
  `his_lng` varchar(45) DEFAULT NULL,
  `tank_diameter` int(10) DEFAULT NULL,
  `fuel_limit` double DEFAULT NULL,
  `idle_alerttime` int(11) DEFAULT NULL,
  `device_type` int(11) DEFAULT NULL,
  `fuel_type` int(11) DEFAULT NULL,
  `fuel_a` double DEFAULT NULL,
  `fuel_b` double DEFAULT NULL,
  `fuel_c` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `remarks` longtext,
  `ibutton_receiver` varchar(255) DEFAULT NULL,
  `driver_ibutton` varchar(100) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `device_config_type` int(11) DEFAULT NULL,
  `vehicle_sleep` int(11) NOT NULL,
  `fuel_dip_ltr` float NOT NULL DEFAULT '0',
  `route_deviated` int(11) DEFAULT NULL,
  `route_deviate_sms` int(11) DEFAULT NULL,
  `internal_battery_voltage` double DEFAULT NULL,
  `digital_output` int(11) DEFAULT NULL,
  `mdvr_status` int(11) DEFAULT NULL,
  `mdvr_terminal_no` varchar(50) DEFAULT NULL,
  `alter_tank_width` varchar(25) DEFAULT NULL,
  `alter_tank_height` varchar(25) DEFAULT NULL,
  `alter_tank_length` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `client_id`, `vehicle_name`, `vehicle_model`, `vehicle_number`, `vehicle_register_number`, `v_running_no`, `sim_number`, `acc_on`, `activecode`, `createdon`, `createdby`, `sale_start_day`, `sale_end_day`, `device_id`, `mobile`, `acc_date_time`, `temperature`, `temperature_date_time`, `hub_ETA`, `acc_flag`, `help_me_alert_date`, `lat`, `lng`, `latlon_address`, `low_battery_date`, `low_battery_flag`, `v_rfid`, `keyword`, `help_me_alert`, `updatedon`, `last_ign_on`, `last_ign_off`, `speed`, `meter`, `fueltank`, `ac_flag`, `ac_date`, `ac_km`, `route_deviation`, `speed_limit`, `v_distance_travelled`, `v_door_status`, `today_km`, `today_date`, `today_fuel_usage`, `fuel_ltr`, `mileage`, `fuel_tank_capacity`, `fuel_is_set`, `power_off_date`, `power_off_flag`, `car_battery`, `device_battery`, `device_charge_status`, `unique_id`, `vehicle_type`, `updatedby`, `device_assign_datetiem`, `device_assign_by`, `last`, `fuel_odo`, `email`, `angle`, `acc_status`, `traveled_distance`, `litres`, `fuel_model`, `fuel_tank_type`, `tank_length`, `tank_width`, `tank_height`, `devicetime`, `devicetime_updated`, `parked_status`, `parked_date`, `parking_alerttime`, `r_acc_date_time`, `r_acc_flag`, `r_acc_km`, `r_ac_date_time`, `r_ac_flag`, `r_ac_km`, `odometer`, `his_acc_status`, `his_acc_date`, `his_acc_km`, `his_ac_status`, `his_ac_date`, `his_ac_km`, `his_date_time`, `his_lat`, `his_lng`, `tank_diameter`, `fuel_limit`, `idle_alerttime`, `device_type`, `fuel_type`, `fuel_a`, `fuel_b`, `fuel_c`, `due_amount`, `remarks`, `ibutton_receiver`, `driver_ibutton`, `driver_name`, `device_config_type`, `vehicle_sleep`, `fuel_dip_ltr`, `route_deviated`, `route_deviate_sms`, `internal_battery_voltage`, `digital_output`, `mdvr_status`, `mdvr_terminal_no`, `alter_tank_width`, `alter_tank_height`, `alter_tank_length`) VALUES
(509, 1, '789564', '789564', NULL, '789564', '985623147521', '9658478236', '1', 1, '2020-06-05 17:59:19', '1', '2019-06-05', '2020-04-06', '0', NULL, NULL, NULL, NULL, NULL, '1', NULL, '11.047059', '76.921074', 'ramnad', NULL, NULL, NULL, NULL, NULL, '2020-06-13 12:06:03', '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, 0, '0', 0, 0, NULL, NULL, '0', NULL, NULL, NULL, '5', '1', NULL, NULL, '0', NULL, NULL, 0, NULL, '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '', '', NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(510, 1, '52635', '52635', NULL, '52635', '963214587452', '9632145870', '0', 1, '2020-06-05 18:04:40', '1', '2019-06-05', '2020-06-10', '0', NULL, NULL, NULL, NULL, NULL, '1', NULL, '11.0737', '76.9424', 'rameswaram', NULL, NULL, NULL, NULL, NULL, '2020-06-06 10:55:00', '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, 0, '0', 0, 0, NULL, NULL, '0', NULL, NULL, NULL, '1', '2', NULL, NULL, '0', NULL, NULL, 0, NULL, '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(511, 2, 'TN 41 A2559', 'TN 41 A2559', NULL, 'TN 41 A2559', '852145366852145', '9685214757', '0', 1, '2020-06-17 10:30:43', NULL, '2020-06-20', '2021-06-30', '0', NULL, NULL, NULL, NULL, NULL, '1', NULL, '11.047136', '76.9225282', 'thiruvadanai', NULL, NULL, NULL, NULL, NULL, '2020-06-29 12:55:07', '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, 0, '0', 0, 0, NULL, NULL, '0', NULL, NULL, NULL, '1', '19', NULL, NULL, '0', NULL, NULL, 0, NULL, '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(512, 5, 'TN 65 AB 0001', 'TN 65 AB 0001', NULL, 'TN 65 AB 0001', '3598745621452', '9688187834', NULL, 1, '2020-07-01 13:47:38', '1', '2020-07-01', '2021-07-01', '0', NULL, NULL, NULL, NULL, NULL, '1', NULL, '11.021729', '76.940045', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, 80, NULL, NULL, NULL, NULL, NULL, 0, '0', 0, 0, NULL, NULL, '0', NULL, NULL, NULL, '2', NULL, NULL, NULL, '0', NULL, NULL, 0, NULL, '0', '0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model_assign`
--

CREATE TABLE `vehicle_model_assign` (
  `vma_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `modelshift_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model_shift`
--

CREATE TABLE `vehicle_model_shift` (
  `vms_id` int(11) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `shift_type` int(11) NOT NULL,
  `shift_start_time` time DEFAULT NULL,
  `shift_end_time` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
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
  `purchase_date` varchar(45) DEFAULT NULL,
  `purchase_product` varchar(45) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
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
  `vehicle_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `starting_odometer` varchar(45) NOT NULL,
  `odometer_limit` varchar(45) NOT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `created_date` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `alert_date` varchar(45) DEFAULT NULL,
  `alert_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_owner_name`
--
CREATE TABLE `view_owner_name` (
`owner_id` bigint(20)
,`owner_name` varchar(255)
,`client_id` int(11)
,`activecode` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_vehicles`
--
CREATE TABLE `view_vehicles` (
`vehicle_sleep` int(11)
,`vehicle_id` varchar(45)
,`vehicle_register_number` varchar(45)
,`vehicle_model` varchar(45)
,`vehicle_number` varchar(45)
,`vehicle_name` varchar(45)
,`activecode` int(11)
,`client_id` bigint(20)
,`createdon` datetime
,`createdby` varchar(45)
,`acc_on` varchar(45)
,`acc_date_time` varchar(45)
,`temperature` varchar(45)
,`temperature_date_time` varchar(45)
,`acc_flag` varchar(11)
,`help_me_alert_date` varchar(45)
,`lat` varchar(45)
,`angle` double
,`lng` varchar(45)
,`low_battery_date` varchar(45)
,`low_battery_flag` varchar(45)
,`v_running_no` varchar(45)
,`keyword` varchar(45)
,`help_me_alert` varchar(45)
,`updatedon` datetime
,`last_ign_off` varchar(45)
,`last_ign_on` varchar(45)
,`vehicle_type` varchar(45)
,`speed` varchar(45)
,`lastkm` varchar(45)
,`fueltank` varchar(45)
,`meter` varchar(45)
,`ac_flag` varchar(45)
,`ac_date` varchar(45)
,`today_km` double
,`fuel_ltr` varchar(45)
,`litres` varchar(45)
,`car_battery` varchar(45)
,`mileage` varchar(10)
,`fuel_tank_capacity` int(11)
,`today_fuel_usage` int(11)
,`driver_name` varchar(100)
,`hour` varchar(10)
,`ofline_time` bigint(21)
,`odometer` varchar(45)
,`hub_ETA` varchar(45)
,`mdvr_trml_with_servr` int(11)
,`mdvr_terminal_no` varchar(50)
,`device_type` int(11)
,`latlon_address` varchar(2000)
,`idle_alerttime` int(11)
,`parking_alerttime` int(11)
,`fuel_fill_limit` double
,`fuel_dip_limit` float
,`overspeed_limit` int(11)
,`sim_number` varchar(20)
,`internal_battery_voltage` double
);

-- --------------------------------------------------------

--
-- Structure for view `View_Client_Geofence_api`
--
DROP TABLE IF EXISTS `View_Client_Geofence_api`;

CREATE VIEW `View_Client_Geofence_api`  AS  select 1 AS `sms_alert_id`,1 AS `client_id`,1 AS `vehicle_id`,1 AS `vehicle_name`,1 AS `vehicle_number`,1 AS `vehicle_register_number`,1 AS `vehicle_model`,1 AS `alert_type`,1 AS `createdon`,1 AS `lat`,1 AS `lng`,1 AS `geo_location_name` ;

-- --------------------------------------------------------

--
-- Structure for view `view_owner_name`
--
DROP TABLE IF EXISTS `view_owner_name`;

CREATE VIEW `view_owner_name`  AS  select `user`.`user_id` AS `owner_id`,`user`.`username` AS `owner_name`,`user`.`client_id` AS `client_id`,`user`.`activecode` AS `activecode` from `user` where (`user`.`role_id` = '4') ;

-- --------------------------------------------------------

--
-- Structure for view `view_vehicles`
--
DROP TABLE IF EXISTS `view_vehicles`;

CREATE VIEW `view_vehicles`  AS  select `vehicle`.`vehicle_sleep` AS `vehicle_sleep`,`vehicle`.`v_running_no` AS `vehicle_id`,`vehicle`.`vehicle_name` AS `vehicle_register_number`,`vehicle`.`vehicle_model` AS `vehicle_model`,`vehicle`.`vehicle_number` AS `vehicle_number`,`vehicle`.`vehicle_register_number` AS `vehicle_name`,`vehicle`.`activecode` AS `activecode`,`vehicle`.`client_id` AS `client_id`,`vehicle`.`createdon` AS `createdon`,`vehicle`.`createdby` AS `createdby`,`vehicle`.`acc_on` AS `acc_on`,`vehicle`.`acc_date_time` AS `acc_date_time`,`vehicle`.`temperature` AS `temperature`,`vehicle`.`temperature_date_time` AS `temperature_date_time`,`vehicle`.`acc_flag` AS `acc_flag`,`vehicle`.`help_me_alert_date` AS `help_me_alert_date`,`vehicle`.`lat` AS `lat`,`vehicle`.`angle` AS `angle`,`vehicle`.`lng` AS `lng`,`vehicle`.`low_battery_date` AS `low_battery_date`,`vehicle`.`low_battery_flag` AS `low_battery_flag`,`vehicle`.`v_running_no` AS `v_running_no`,`vehicle`.`keyword` AS `keyword`,`vehicle`.`help_me_alert` AS `help_me_alert`,`vehicle`.`updatedon` AS `updatedon`,`vehicle`.`last_ign_off` AS `last_ign_off`,`vehicle`.`last_ign_on` AS `last_ign_on`,`vehicle`.`vehicle_type` AS `vehicle_type`,`vehicle`.`speed` AS `speed`,`vehicle`.`last` AS `lastkm`,`vehicle`.`fueltank` AS `fueltank`,`vehicle`.`meter` AS `meter`,`vehicle`.`ac_flag` AS `ac_flag`,`vehicle`.`ac_date` AS `ac_date`,`vehicle`.`today_km` AS `today_km`,`vehicle`.`litres` AS `fuel_ltr`,`vehicle`.`litres` AS `litres`,`vehicle`.`car_battery` AS `car_battery`,`vehicle`.`mileage` AS `mileage`,`vehicle`.`fuel_tank_capacity` AS `fuel_tank_capacity`,`vehicle`.`today_fuel_usage` AS `today_fuel_usage`,`vehicle`.`driver_name` AS `driver_name`,concat('',sec_to_time(`vehicle`.`updatedon`)) AS `hour`,timestampdiff(SECOND,`vehicle`.`updatedon`,now()) AS `ofline_time`,`vehicle`.`odometer` AS `odometer`,`vehicle`.`hub_ETA` AS `hub_ETA`,`vehicle`.`mdvr_status` AS `mdvr_trml_with_servr`,`vehicle`.`mdvr_terminal_no` AS `mdvr_terminal_no`,`vehicle`.`device_type` AS `device_type`,`vehicle`.`latlon_address` AS `latlon_address`,`vehicle`.`idle_alerttime` AS `idle_alerttime`,`vehicle`.`parking_alerttime` AS `parking_alerttime`,`vehicle`.`fuel_limit` AS `fuel_fill_limit`,`vehicle`.`fuel_dip_ltr` AS `fuel_dip_limit`,`vehicle`.`speed_limit` AS `overspeed_limit`,`vehicle`.`sim_number` AS `sim_number`,`vehicle`.`internal_battery_voltage` AS `internal_battery_voltage` from `vehicle` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EP_alert_AIS`
--
ALTER TABLE `EP_alert_AIS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IMEI` (`IMEI`);

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
-- Indexes for table `access_privileges`
--
ALTER TABLE `access_privileges`
  ADD PRIMARY KEY (`access_privilege_id`);

--
-- Indexes for table `alert_AIS`
--
ALTER TABLE `alert_AIS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IMEI` (`IMEI`);

--
-- Indexes for table `alert_av2_g19`
--
ALTER TABLE `alert_av2_g19`
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
-- Indexes for table `assign_deiver`
--
ALTER TABLE `assign_deiver`
  ADD PRIMARY KEY (`assign_driver_id`),
  ADD KEY `vehicle_id_idx` (`vehicle_id`);

--
-- Indexes for table `assign_device`
--
ALTER TABLE `assign_device`
  ADD PRIMARY KEY (`assign_device_id`),
  ADD KEY `FK_388avgx9oagdrt1skcu7uuy8e` (`vehicle_id`),
  ADD KEY `FK_m5riws66smyhai55d2d2w9rnh` (`device_id`);

--
-- Indexes for table `assign_geo_fenceing`
--
ALTER TABLE `assign_geo_fenceing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `assign_ibutton_client`
--
ALTER TABLE `assign_ibutton_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_owner`
--
ALTER TABLE `assign_owner`
  ADD PRIMARY KEY (`assign_owner_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `assign_trip_solution`
--
ALTER TABLE `assign_trip_solution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `battery_report`
--
ALTER TABLE `battery_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consolidate_alertcount_report`
--
ALTER TABLE `consolidate_alertcount_report`
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
-- Indexes for table `consolidate_park_report`
--
ALTER TABLE `consolidate_park_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `imei` (`imei`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `customer_followups`
--
ALTER TABLE `customer_followups`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `db_stx`
--
ALTER TABLE `db_stx`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `dealer_details`
--
ALTER TABLE `dealer_details`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `device_model`
--
ALTER TABLE `device_model`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `dlio_stx`
--
ALTER TABLE `dlio_stx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `driver_rating`
--
ALTER TABLE `driver_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `datetime` (`datetime`),
  ADD KEY `i_button_no` (`i_button_no`);

--
-- Indexes for table `fmb_can_kline`
--
ALTER TABLE `fmb_can_kline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_analog`
--
ALTER TABLE `fuel_analog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`),
  ADD KEY `flag` (`flag`),
  ADD KEY `modified_date` (`modified_date`);

--
-- Indexes for table `fuel_fill_dip_report`
--
ALTER TABLE `fuel_fill_dip_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_on` (`created_on`);

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
  ADD KEY `running_no_2` (`running_no`,`modified_date`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no_3` (`running_no`,`flag`);

--
-- Indexes for table `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`fuel_type_id`);

--
-- Indexes for table `fueltemp_table`
--
ALTER TABLE `fueltemp_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_r4ilgbnvv8v8rp1gs5uo3k4vl` (`route_id`),
  ADD KEY `FK_qou1biuj1f17wh744i8fxyw5o` (`vehicle_id`);

--
-- Indexes for table `geofence_report`
--
ALTER TABLE `geofence_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gnx_aj1939`
--
ALTER TABLE `gnx_aj1939`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_imei` (`vehicle_imei`);

--
-- Indexes for table `gnx_ann`
--
ALTER TABLE `gnx_ann`
  ADD PRIMARY KEY (`id`),
  ADD KEY `current_datetime` (`current_datetime`),
  ADD KEY `imei` (`imei`);

--
-- Indexes for table `gnx_obddetails`
--
ALTER TABLE `gnx_obddetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_imei` (`vehicle_imei`);

--
-- Indexes for table `health_status`
--
ALTER TABLE `health_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `running_no` (`running_no`);

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
-- Indexes for table `i_button_report1`
--
ALTER TABLE `i_button_report1`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `idle_report`
--
ALTER TABLE `idle_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `flag` (`flag`,`device_no`);

--
-- Indexes for table `idle_report_old`
--
ALTER TABLE `idle_report_old`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `flag` (`flag`,`device_no`);

--
-- Indexes for table `idlearea_report`
--
ALTER TABLE `idlearea_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `device_no` (`device_no`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `start_day` (`start_day`);

--
-- Indexes for table `idlearea_report1`
--
ALTER TABLE `idlearea_report1`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `ignition_report`
--
ALTER TABLE `ignition_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `start_day_2` (`start_day`);

--
-- Indexes for table `ignition_report1`
--
ALTER TABLE `ignition_report1`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `falg` (`flag`),
  ADD KEY `start_day` (`start_day`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `start_day_2` (`start_day`);

--
-- Indexes for table `insurance_reminder`
--
ALTER TABLE `insurance_reminder`
  ADD PRIMARY KEY (`insurance_reminder_id`);

--
-- Indexes for table `location_list`
--
ALTER TABLE `location_list`
  ADD PRIMARY KEY (`Location_Id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mileage_report`
--
ALTER TABLE `mileage_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_location_history`
--
ALTER TABLE `new_location_history`
  ADD KEY `running_no_3` (`running_no`,`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `notificationAlert_IOS`
--
ALTER TABLE `notificationAlert_IOS`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_alert`
--
ALTER TABLE `notification_alert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obdii_data`
--
ALTER TABLE `obdii_data`
  ADD PRIMARY KEY (`obdii_data_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`payment_mode_id`);

--
-- Indexes for table `play_back_history`
--
ALTER TABLE `play_back_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `running_no` (`running_no`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `route_assign`
--
ALTER TABLE `route_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_deviate_report`
--
ALTER TABLE `route_deviate_report`
  ADD PRIMARY KEY (`rd_id`),
  ADD KEY `route_deviate_outtime` (`route_deviate_outtime`);

--
-- Indexes for table `route_deviation`
--
ALTER TABLE `route_deviation`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `route_deviation_assign`
--
ALTER TABLE `route_deviation_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_deviation_latlng`
--
ALTER TABLE `route_deviation_latlng`
  ADD PRIMARY KEY (`latlng_id`);

--
-- Indexes for table `route_deviation_new`
--
ALTER TABLE `route_deviation_new`
  ADD PRIMARY KEY (`rd_id`);

--
-- Indexes for table `route_latlng`
--
ALTER TABLE `route_latlng`
  ADD PRIMARY KEY (`latlng_id`);

--
-- Indexes for table `route_report`
--
ALTER TABLE `route_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_stops`
--
ALTER TABLE `route_stops`
  ADD PRIMARY KEY (`stop_id`);

--
-- Indexes for table `route_temp_latlng`
--
ALTER TABLE `route_temp_latlng`
  ADD PRIMARY KEY (`latlng_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_device_list`
--
ALTER TABLE `stock_device_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_sim_list`
--
ALTER TABLE `stock_sim_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_rollno` (`student_rollno`);

--
-- Indexes for table `today_admin_alert`
--
ALTER TABLE `today_admin_alert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_sms_alert`
--
ALTER TABLE `today_sms_alert`
  ADD PRIMARY KEY (`sms_alert_id`);

--
-- Indexes for table `trip_geo_solution_data`
--
ALTER TABLE `trip_geo_solution_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_solution_data`
--
ALTER TABLE `trip_solution_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_solution_location`
--
ALTER TABLE `trip_solution_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `v_running_no` (`v_running_no`);

--
-- Indexes for table `vehicle_model_assign`
--
ALTER TABLE `vehicle_model_assign`
  ADD PRIMARY KEY (`vma_id`);

--
-- Indexes for table `vehicle_model_shift`
--
ALTER TABLE `vehicle_model_shift`
  ADD PRIMARY KEY (`vms_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `EP_alert_AIS`
--
ALTER TABLE `EP_alert_AIS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ac_report`
--
ALTER TABLE `ac_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `access_privileges`
--
ALTER TABLE `access_privileges`
  MODIFY `access_privilege_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `alert_AIS`
--
ALTER TABLE `alert_AIS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alert_av2_g19`
--
ALTER TABLE `alert_av2_g19`
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
  MODIFY `alter_contacts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `apikey`
--
ALTER TABLE `apikey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_deiver`
--
ALTER TABLE `assign_deiver`
  MODIFY `assign_driver_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_device`
--
ALTER TABLE `assign_device`
  MODIFY `assign_device_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_geo_fenceing`
--
ALTER TABLE `assign_geo_fenceing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_ibutton_client`
--
ALTER TABLE `assign_ibutton_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_owner`
--
ALTER TABLE `assign_owner`
  MODIFY `assign_owner_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_trip_solution`
--
ALTER TABLE `assign_trip_solution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `battery_report`
--
ALTER TABLE `battery_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `consolidate_alertcount_report`
--
ALTER TABLE `consolidate_alertcount_report`
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
-- AUTO_INCREMENT for table `consolidate_park_report`
--
ALTER TABLE `consolidate_park_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_followups`
--
ALTER TABLE `customer_followups`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_stx`
--
ALTER TABLE `db_stx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dealer_details`
--
ALTER TABLE `dealer_details`
  MODIFY `dealer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `device_model`
--
ALTER TABLE `device_model`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dlio_stx`
--
ALTER TABLE `dlio_stx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `driver_rating`
--
ALTER TABLE `driver_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fmb_can_kline`
--
ALTER TABLE `fmb_can_kline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fuel_analog`
--
ALTER TABLE `fuel_analog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fuel_fill_dip_report`
--
ALTER TABLE `fuel_fill_dip_report`
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
-- AUTO_INCREMENT for table `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `fuel_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fueltemp_table`
--
ALTER TABLE `fueltemp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `geofence_report`
--
ALTER TABLE `geofence_report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gnx_aj1939`
--
ALTER TABLE `gnx_aj1939`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gnx_ann`
--
ALTER TABLE `gnx_ann`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gnx_obddetails`
--
ALTER TABLE `gnx_obddetails`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `health_status`
--
ALTER TABLE `health_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `i_button_report1`
--
ALTER TABLE `i_button_report1`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `idle_report`
--
ALTER TABLE `idle_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `idlearea_report`
--
ALTER TABLE `idlearea_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `idlearea_report1`
--
ALTER TABLE `idlearea_report1`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ignition_report`
--
ALTER TABLE `ignition_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ignition_report1`
--
ALTER TABLE `ignition_report1`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `insurance_reminder`
--
ALTER TABLE `insurance_reminder`
  MODIFY `insurance_reminder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location_list`
--
ALTER TABLE `location_list`
  MODIFY `Location_Id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11493;
--
-- AUTO_INCREMENT for table `mileage_report`
--
ALTER TABLE `mileage_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notificationAlert_IOS`
--
ALTER TABLE `notificationAlert_IOS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification_alert`
--
ALTER TABLE `notification_alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obdii_data`
--
ALTER TABLE `obdii_data`
  MODIFY `obdii_data_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `payment_mode_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `play_back_history`
--
ALTER TABLE `play_back_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `route_assign`
--
ALTER TABLE `route_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `route_deviate_report`
--
ALTER TABLE `route_deviate_report`
  MODIFY `rd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `route_deviation`
--
ALTER TABLE `route_deviation`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `route_deviation_assign`
--
ALTER TABLE `route_deviation_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `route_deviation_latlng`
--
ALTER TABLE `route_deviation_latlng`
  MODIFY `latlng_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `route_deviation_new`
--
ALTER TABLE `route_deviation_new`
  MODIFY `rd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `route_latlng`
--
ALTER TABLE `route_latlng`
  MODIFY `latlng_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `route_report`
--
ALTER TABLE `route_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `route_stops`
--
ALTER TABLE `route_stops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `route_temp_latlng`
--
ALTER TABLE `route_temp_latlng`
  MODIFY `latlng_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stock_device_list`
--
ALTER TABLE `stock_device_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=698;
--
-- AUTO_INCREMENT for table `stock_sim_list`
--
ALTER TABLE `stock_sim_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=528;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `today_admin_alert`
--
ALTER TABLE `today_admin_alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `today_sms_alert`
--
ALTER TABLE `today_sms_alert`
  MODIFY `sms_alert_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trip_geo_solution_data`
--
ALTER TABLE `trip_geo_solution_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trip_solution_data`
--
ALTER TABLE `trip_solution_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trip_solution_location`
--
ALTER TABLE `trip_solution_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;
--
-- AUTO_INCREMENT for table `vehicle_model_assign`
--
ALTER TABLE `vehicle_model_assign`
  MODIFY `vma_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_model_shift`
--
ALTER TABLE `vehicle_model_shift`
  MODIFY `vms_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_service`
--
ALTER TABLE `vehicle_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;--
-- Database: `test`