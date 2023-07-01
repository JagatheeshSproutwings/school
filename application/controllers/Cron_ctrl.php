<?php
// error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_ctrl extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cron_model');
		// $this->load->model('livetrack_model');
		date_default_timezone_set('Asia/Kolkata');
	}
	public function cron_playback()
	{

		$query =  $this->db->query("SELECT client_id,deviceimei as v_running_no FROM `vehicletbl_2` WHERE status=1");
		//$query =  $this->db->query("SELECT count(pb.`running_no`) reccount, pb.running_no as v_running_no,v.client_id as client_id FROM `play_back_history` pb inner join vehicletbl v on pb.running_no = v.deviceimei GROUP BY pb.`running_no` order by reccount desc");
		$vehicle =  $query->result();
		foreach ($vehicle as $v_list) {

			$client_id = $v_list->client_id;
			$play_table = "play_back_history_" . $client_id;

			$dstart = date('Y-m-d', strtotime("-10 days"));
			$dend = date('Y-m-d', strtotime("-1 days"));


			$from_date = $dstart . " 00:00:00";
			$to_date = $dend . " 23:59:59";

			$qry = $this->db->query("SHOW TABLES LIKE '" . $play_table . "'");

			if ($qry->num_rows() <= 0) {

				$this->db->query("CREATE TABLE IF NOT EXISTS " . $play_table . " (
									  `id` int(11) NOT NULL AUTO_INCREMENT,
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
									  PRIMARY KEY (`id`),
									  KEY `modified_date` (`modified_date`),
									  KEY `running_no` (`running_no`)
									) ENGINE=InnoDB");
			}
			if ($qry->num_rows() > 0) {

				$playback_id_query = $this->db->query("SELECT id FROM play_back_history WHERE running_no ='" . $v_list->v_running_no . "'");
				$playback_data = $playback_id_query->result();
				//$playback_data = $this->cron_model->get_playback_data($v_list->v_running_no,$from_date,$to_date); 
				//$playback_data = $this->cron_model->get_all_playback_data_for_imei($v_list->v_running_no);

				try {
					//	echo "ji".count($playback_data); exit();
					if (count($playback_data) > 0 && $playback_data != 0) {

						$InsertUpdateQueryHead = "INSERT INTO `" . $play_table . "` (`running_no`, `lat_message`, `lon_message`, `speed`, `angle`, `created_date`, `modified_date`, `acc_status`, `door_status`, `packettype`, `zap`, `packet`, `odometer`)  ";
						//VALUES
						$InsertUpdateQueryFooter = " ON DUPLICATE KEY UPDATE 
							running_no= VALUES (running_no),
							lat_message= VALUES (lat_message),
							speed= VALUES (speed),
							angle= VALUES (angle),
							created_date= VALUES (created_date),
							modified_date= VALUES (modified_date),
							packettype= VALUES (packettype),						
							zap= VALUES (zap),
							packet= VALUES (packet),
							odometer= VALUES (odometer) ";
						//$InsertUpdateQueryContent="";

						$SelectQueryForUpdate = " SELECT `running_no`, `lat_message`, `lon_message`, `speed`, `angle`,`created_date`, `modified_date`, `acc_status`, `door_status`, `packettype`, `zap`, `packet`, `odometer` FROM play_back_history FORCE INDEX(index_id) WHERE ID IN ";

						$IDList = "";

						$counter = 0;
						foreach ($playback_data as $p_list) {
							$counter = $counter + 1;
							//$result1 = $this->db->get_where($play_table, array('running_no ' => $p_list->running_no,'modified_date ' => $p_list->modified_date));
							// $inDatabase1 = $result1->num_rows();
							//if($InsertUpdateQueryContent!=""){
							//	$InsertUpdateQueryContent=$InsertUpdateQueryContent.",";
							//}
							//if($inDatabase1==0)
							//{
							//$InsertUpdateQueryContent=$InsertUpdateQueryContent." ('".$p_list->running_no."', '".$p_list->lat_message."', '".$p_list->lon_message."', '".$p_list->speed."', '".$p_list->created_date."', '".$p_list->modified_date."', '".$p_list->acc_status."', '".$p_list->door_status."', '".$p_list->packettype."',  '".$p_list->zap."', '".$p_list->packet."', '".$p_list->odometer."') ";
							//$InsertUpdateQueryContent=$InsertUpdateQueryContent.$p_list->id;

							if ($IDList != "") {
								$IDList = $IDList . ",";
							}
							$IDList = $IDList . $p_list->id;

							if ($counter >= 10000) {
								//On every 1000 rows, insert contents and reset counter and intermediate variables
								//$this->db->query($InsertUpdateQueryHead.$InsertUpdateQueryContent);
								$this->db->query($InsertUpdateQueryHead . $SelectQueryForUpdate . " (" . $IDList . ")");
								$this->db->query("DELETE FROM play_back_history WHERE id in (" . $IDList . ")");

								$IDList = "";
								//$InsertUpdateQueryContent="";
								$counter = 0;
							}
						}
						if ($IDList != "") {
							//insert remaining rows
							$this->db->query($InsertUpdateQueryHead . $SelectQueryForUpdate . " (" . $IDList . ")");
							$this->db->query("DELETE FROM play_back_history WHERE id in (" . $IDList . ")");
							//$this->db->query($InsertUpdateQueryHead.$InsertUpdateQueryContent);
							//$this->db->query("DELETE FROM play_back_history WHERE id in (".$IDList.")");
							//$IDList="";
							//$InsertUpdateQueryContent="";
							//$counter=0;
						}
					}
				} catch (\Exception $e) {
					//echo "ji".count($playback_data); exit();
					die($e->getMessage());
				}
			}
		}
	}

	public function cron_distance()
	{
		echo "CRON DISTANCE EXECUTION START";
		$timezone = $this->input->get('timezone');
		$timezone_name = ($timezone !='qatar' ) ? date_default_timezone_set("Asia/Calcutta") : date_default_timezone_set("Asia/qatar");
		$timezone = ($timezone =='india' ) ? 1 : 2;
		$timezone_hours = ($timezone == 2) ? 180 : 330;
		$query =  $this->db->query("SELECT v.vehicleid,v.vehiclename,v.deviceimei,v.client_id,v.device_type FROM vehicletbl_2 v INNER JOIN clienttbl c ON c.client_id = v.client_id WHERE v.status=1 AND c.time_zone =$timezone");
	
		$vehicle =  $query->result();
		echo "PRINT VEHICLE LIST .....";

		print_r($vehicle);
		$dd = date('Y-m-d', strtotime("-1 days"));
		$fromd = $dd . " 00:00:00";
		$tod = $dd . " 23:59:59";
		$i = 1;
		foreach ($vehicle as $v_list) {
			echo "Vehicle details came for vehicle_count ".$i;
			
			$vehicle = $v_list->deviceimei;

			$distance_report = $this->cron_model->consolidate_distance_report($fromd, $tod, $v_list->client_id, $vehicle,$timezone_hours);

			$result1 =  $this->db->query("SELECT * FROM consolidate_distance_report WHERE imei=$vehicle AND date='" . $dd . "'");

			$inDatabase1 = $result1->num_rows();
			$dist_data = array();
			if ($distance_report != '' && $distance_report != 0) {
				if (($inDatabase1 == 0)) {
					echo "Vehicle Distance data record INSERT";

					$dist_data = array(
						"client_id" => $v_list->client_id,
						"vehicleid" => $v_list->vehicleid,
						"imei" => $vehicle,
						"vehicle_register_number" => $v_list->vehiclename,
						'start_odometer' => $distance_report->start_odometer,
						'end_odometer' => $distance_report->end_odometer,
						"date" => $dd,
						"distance_km" => $distance_report->distance_km,
						"created_datetime" => date('Y-m-d H:i:s')
					);

					$this->db->insert('consolidate_distance_report', $dist_data);
					echo "INSERTED QUERY";
					echo $this->db->last_query();
				}
			}
			echo "END OF FOR LOOP";


			$i++;
		}
		echo "END THE FUNCTION";
	}


	public function cron_ign()
	{
		$timezone = $this->input->get('timezone');
		$timezone_name = ($timezone !='qatar' ) ? date_default_timezone_set("Asia/Calcutta") : date_default_timezone_set("Asia/qatar");
		$timezone = ($timezone =='india' ) ? 1 : 2;
		$timezone_hours = ($timezone == 2) ? 180 : 330;
		$query =  $this->db->query("SELECT v.vehicleid,v.vehiclename,v.deviceimei,v.client_id,v.device_type FROM vehicletbl_2 v INNER JOIN clienttbl c ON c.client_id = v.client_id WHERE v.status=1 AND c.time_zone =$timezone");
	
		$vehicle =  $query->result();
		$dd = date('Y-m-d', strtotime("-1 days"));
		//$dd="2020-10-07";
		$fromd = $dd . " 00:00:00";
		$tod = $dd . " 23:59:59";

		$distance = 0;
		$i = 1;
		foreach ($vehicle as $v_list) {
			$vehicle = $v_list->deviceimei;
			//$first_ignition_report = $this->cron_model->consolidate_firstign_report($fromd,$tod,$vehicle);
			$ignition_report = $this->cron_model->consolidate_Ignition_report($fromd, $tod, $vehicle,$timezone_hours);
			//$last_ignition_report = $this->cron_model->consolidate_lastign_report($fromd,$tod,$vehicle);
			$tot_ign = 0;
			foreach ($ignition_report as $i_list) {
				$i_list->t_min;
				$tot_ign = $tot_ign + $i_list->t_min;
			}

			$igntime = $tot_ign; //$ignition_report->t_min;//$ignition_report;// $diff->format('%h Hours, %i Minutes');

			$result4 =  $this->db->query("SELECT * FROM consolidate_ign_report WHERE imei=$vehicle AND date='" . $dd . "'");

			$inDatabase4 = $result4->num_rows();
			$ign_data = array();

			if ($igntime != '' && $igntime != 0) {
				if (($inDatabase4 == 0)) {

					$ign_data = array(
						"client_id" => $v_list->client_id,
						"vehicleid" => $v_list->vehicleid,
						"imei" => $vehicle,
						"date" => $dd,
						"vehicle_register_number" => $v_list->vehiclename,
						"distance_km" => '0',
						"moving_duration" => $igntime,
						"created_datetime" => date('Y-m-d H:i:s')
					);

					$this->db->insert('consolidate_ign_report', $ign_data);
				}
			}
		}
	}





	public function cron_idle()
	{
		$timezone = $this->input->get('timezone');
		$timezone_name = ($timezone !='qatar' ) ? date_default_timezone_set("Asia/Calcutta") : date_default_timezone_set("Asia/qatar");
		$timezone = ($timezone =='india' ) ? 1 : 2;
		$timezone_hours = ($timezone == 2) ? 180 : 330;
		$query =  $this->db->query("SELECT v.vehicleid,v.vehiclename,v.deviceimei,v.client_id,v.device_type FROM vehicletbl_2 v INNER JOIN clienttbl c ON c.client_id = v.client_id WHERE v.status=1 AND c.time_zone =$timezone");
		$vehicle =  $query->result();
		$dd = date('Y-m-d', strtotime("-1 days"));
		$fromd = $dd . " 00:00:00";
		$tod = $dd . " 23:59:59";

		$distance = 0;


		$i = 1;

		foreach ($vehicle as $v_list) {
			$distance = 0;

			$vehicle = $v_list->deviceimei;

			$idlearea_list = $this->cron_model->consolidate_idle_report($fromd, $tod, $vehicle,$timezone_hours);
			$idletime = $idlearea_list->t_min; //$diff->format('%h Hours, %i Minutes');
			$result3 = $this->db->get_where('consolidate_idle_report', array('imei ' => $vehicle, 'date ' => $dd));
			$inDatabase3 = $result3->num_rows();
			if ($idletime != '' && $idletime != 0) {
				if (($inDatabase3 == 0)) {

					$idle_data = array(
						"client_id" => $v_list->client_id,
						"vehicleid" => $v_list->vehicleid,
						"imei" => $vehicle,
						"vehicle_register_number" => $v_list->vehiclename,
						"date" => $dd,
						"idel_duration" => $idletime,
						"created_datetime" => date('Y-m-d H:i:s')
					);

					$this->db->insert('consolidate_idle_report', $idle_data);
				}
			}
		}
	}

	public function cron_parking()
	{
		$timezone = $this->input->get('timezone');
		$timezone_name = ($timezone !='qatar' ) ? date_default_timezone_set("Asia/Calcutta") : date_default_timezone_set("Asia/qatar");
		$timezone = ($timezone =='india' ) ? 1 : 2;
		$timezone_hours = ($timezone == 2) ? 180 : 330;
		$query =  $this->db->query("SELECT v.vehicleid,v.vehiclename,v.deviceimei,v.client_id,v.device_type FROM vehicletbl_2 v INNER JOIN clienttbl c ON c.client_id = v.client_id WHERE v.status=1 AND c.time_zone =$timezone");
		$vehicle =  $query->result();
		$dd = date('Y-m-d', strtotime("-1 days"));
		$fromd = $dd . " 00:00:00";
		$tod = $dd . " 23:59:59";

		foreach ($vehicle as $v_list) {
			$vehicle = $v_list->deviceimei;
			$first_park_report = $this->cron_model->consolidate_firstpark_report($fromd, $tod, $vehicle,$timezone_hours);

			$parking_report = $this->cron_model->consolidate_park_report($fromd, $tod, $vehicle,$timezone_hours);

			$last_park_report = $this->cron_model->consolidate_lastpark_report($fromd, $tod, $vehicle,$timezone_hours);

			$pminutes = $first_park_report + $parking_report->t_min + $last_park_report;
			$result2 = $this->db->get_where('consolidate_park_report', array('imei ' => $vehicle, 'date ' => $dd));
			$inDatabase2 = $result2->num_rows();

			if ($pminutes != '' && $pminutes != 0) {
				if (($inDatabase2 == 0)) {
					$park_data = array(
						"client_id" => $v_list->client_id,
						"vehicleid" => $v_list->vehicleid,
						"imei" => $vehicle,
						"vehicle_register_number" => $v_list->vehiclename,
						"date" => $dd,
						"parking_duration" => $pminutes,
						"created_datetime" => date('Y-m-d H:i:s')
					);
					$this->db->insert('consolidate_park_report', $park_data);
				}
			}
		}
	}


	public function get_geofence(){
		// 2 GEO IN LOCATION
		// 1 GEO OUT LOCATION
$data_list = $this->cron_model->geo_vehicle_location();
foreach($data_list as $list){

		    	$latitude1 =$list->g_lat;
				 $longitude1 =$list->g_lng;
				 $latitude2 =$list->v_lat;
				 $longitude2 =$list->v_lng;

			$v_dis =$this->geo_distance($latitude1,$longitude1,$latitude2,$longitude2);
			$v_dis = round($v_dis);
			echo $v_dis.' <b>'.$list->vehicleid.'</b></br>';
			$geo_dis = $list->radius;   // 100 meters distance for geofence size its default
			$result = $this->cron_model->last_georeport_data($list->Location_Id,$list->vehicleid);

			$all_status =$result[0]['location_status'];
			$id =$result[0]['id'];
			$g_id =$result[0]['geo_location_id'];
			$in_check =$result[0]['in_datetime'];
			$in_check_from = strtotime($in_check);
			$in_check_date = date('Y-m-d H:i',$in_check_from);
			$date = date('mdHis');
			$trip_id = $date.''.$list->vehicleid;
			if($result){
				if($geo_dis >= $v_dis){   // in from geofence
					if($all_status == 2){  // add trip
						 $data = array(

													"vehicle_id" => $list->vehicleid,
													"client_id" => $list->client_id,
													"trip_id" => $trip_id,
													"lat" => $list->v_lat,
													"lng" => $list->v_lng,
													"in_datetime" => date('Y-m-d H:i:s'),
													"speed" => $list->speed,
													"geo_location_id" => $list->Location_Id,
													"g_lat" => $list->g_lat,
													"g_lng" => $list->g_lng,
													// "distance" => $list->traveled_distance,
													"ignition_status" => $list->acc_on,
													"location_status" => 1,
													);
												$this->db->insert('sch_geofence_report',$data);

					}

				}else{	//vehicle out

					if($all_status == 1 && $list->Location_Id == $g_id && $in_check!=''){  // last trip end
									$data = array(

													"out_datetime" => date('Y-m-d H:i:s'),
													"location_status" => 2,
													// "distance" => $distance_con
													);

									$this->db->where('id',$id);
									$result = $this->db->update('sch_geofence_report', $data);
					}	
				}

			}else{  // new entry
				if($geo_dis >= $v_dis){   // in from geofence
						$data = array(

										"vehicle_id" => $list->vehicleid,
										"client_id" => $list->client_id,
										"trip_id" => $trip_id,
										"lat" => $list->v_lat,
										"lng" => $list->v_lng,
										"in_datetime" => date('Y-m-d H:i:s'),
										"speed" => $list->speed,
										"geo_location_id" => $list->Location_Id,
										"g_lat" => $list->g_lat,
										"g_lng" => $list->g_lng,
										// "distance" => $list->traveled_distance,
										"ignition_status" => $list->acc_on,
										"location_status" => 1
										);
						          	$this->db->insert('sch_geofence_report',$data);
				}

			}

	}

}

public function geo_distance($latitude1,$longitude1,$latitude2,$longitude2)
{
	$unit = 'Km';
			$theta = $longitude1 - $longitude2;
			$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
			$distance = acos($distance);
			$distance = rad2deg($distance);
			$distance = $distance * 60 * 1.1515; switch($unit) {
		 case 'Mi': break; case 'Km' : $distance = $distance * 1.609344;

			}
	   if(number_format($distance) =='nan')
				   {
					   $v_dis = 0;
				   }else{
						   $v_dis = $distance;
				   }
			 $v_dis.'<br>';
			$v_dis = $v_dis * 1000;

	 return  $v_dis = round($v_dis);

	 
}

public function school_notification_old()
{

	$notification_alerts = $this->cron_model->notification_alerts();
	foreach($notification_alerts as $list){
		$notifications =array(
			"body" => $list->vehicle_name,
			"title"=> $list->alert_type
		);
		$datamsg = array(
			'to' => $list->push_code,
			'notification' => $notifications
		);
				$curl = curl_init();

				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode ($datamsg),
				CURLOPT_HTTPHEADER => array(
					'Authorization: key=AAAAqHApuq4:APA91bHKo8o3DtE8BaxsEiFXflqLXUXC57hPZS9qFX5CUhYFkUmXamAyfPjh16vvIYIYkSejLl98FYQoGgVkIrz9m2ffj3yOipsj62iiGH7qG8cypKVvR2FMor-aGjT3pTzIKRH6cvLO',
					'Content-Type: application/json'
				),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				echo $response;

				$deletemsg = $this->db->query("DELETE from sch_notification_alert where id=$list->id");
	} 

}

	function school_notification()
{
	$notification_alerts = $this->cron_model->notification_alerts_all();
	foreach ($notification_alerts as $nlist) {
		
	$token_data = $this->db->query("SELECT push_code FROM sch_user_pushcode WHERE userid=$nlist->parent_id");
	$tokens = $token_data->result();
	$token[]='';
foreach ($tokens as $list) {
	
	$token[]= $list->push_code;
}
	$headers = array
	(
		'Authorization: key=AAAAqHApuq4:APA91bHKo8o3DtE8BaxsEiFXflqLXUXC57hPZS9qFX5CUhYFkUmXamAyfPjh16vvIYIYkSejLl98FYQoGgVkIrz9m2ffj3yOipsj62iiGH7qG8cypKVvR2FMor-aGjT3pTzIKRH6cvLO',
		'Content-Type: application/json'
	);
	$notifications =array(
		"body" => $nlist->vehicle_name.' Started at '.$nlist->stop_name.' on '.date('d-m-Y H:i:s',strtotime($nlist->date_time)),
		"title"=> $nlist->alert_type
	);

	$fields = array (
		'registration_ids' =>$token,
		'notification' =>$notifications
	);
	   $ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL,
		'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result;

			$deletemsg = $this->db->query("DELETE from sch_notification_alert where id=$nlist->id");
}

}



public function get_geofence1(){

	// 2 GEO IN LOCATION
	// 1 GEO OUT LOCATION

$query = $this->db->query("SELECT ll.Location_Id,ll.radius,v.vehicleid,ll.Location_short_name,
ll.Lat as g_lat,ll.Lng as g_lng,ll.circle_size,v.vehicleid,v.deviceimei,v.client_id FROM sch_assign_geo_fenceing af 
INNER JOIN sch_location_list ll ON ll.Location_Id = af.geo_location_id INNER JOIN vehicletbl_2 v ON v.vehicleid = af.vehicle_id
 WHERE v.vehicleid=935");
$data_list = $query->result();


foreach($data_list as $list){

			 $latitude1 =$list->g_lat;
			 $longitude1 =$list->g_lng;

			 $from_date = date('Y-m-d H:i:s',strtotime('-4 days',strtotime('15:00:00')));
			 $to_date = date('Y-m-d H:i:s',strtotime('-4 days',strtotime('19:00:00')));
			// $from_date = date('Y-m-d H:i:s',strtotime('15:50:00'));
			// $to_date = date('Y-m-d H:i:s',strtotime('19:00:00'));
			
			 $playback_data =  $this->db->query("SELECT lat_message as v_lat,lon_message as v_lng,speed,modified_date,acc_status 
			 FROM  play_back_history_372 WHERE modified_date BETWEEN '".$from_date."' AND '".$to_date."' AND 
			 running_no=$list->deviceimei ORDER BY modified_date ASC");
		//	echo "SELECT lat_message as v_lat,lon_message as v_lng,speed,modified_date,acc_status FROM  play_back_history_372 WHERE modified_date BETWEEN '".$from_date."' AND '".$to_date."' AND running_no=$list->deviceimei";exit;
			 $playback_list = $playback_data->result();
		//	 print_r($playback_data);exit;

			foreach($playback_list as $v_list)
			{

			//	print_r($playback_list);exit;
				$latitude2 =$v_list->v_lat;

				$longitude2 =$v_list->v_lng;

				$unit = 'Km';

				$theta = $longitude1 - $longitude2;

				$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));

				$distance = acos($distance);

				$distance = rad2deg($distance);

				$distance = $distance * 60 * 1.1515; switch($unit) {

			 case 'Mi': break; case 'Km' : $distance = $distance * 1.609344;

				}

		   if(number_format($distance) =='nan')
					   {
						   $v_dis = 0;
					   }else{
							   $v_dis = $distance;
					   }
				

		  
		   
		   $v_dis = $v_dis * 1000;

		   $v_dis = round($v_dis);

		   $data1 =  $v_dis.' <b>'.$v_list->modified_date.' v_lat: '.$v_list->v_lat.' v_lng: '.$v_list->v_lng.'</b><br>';


		   echo  ' <b>'.$v_dis.'</b><br>';

		   $geo_dis = $list->radius;   // 100 meters distance for geofence size its default


		   $result = $this->cron_model->last_georeport_data1($list->Location_Id,$list->vehicleid);

		   $all_status =$result[0]['location_status'];
		   $id =$result[0]['id'];
		   $g_id =$result[0]['geo_location_id'];
		   $in_check =$result[0]['in_datetime'];
		   $in_check_from = strtotime($in_check);
		   $in_check_date = date('Y-m-d H:i',$in_check_from);

		   $date = date('mdHis');

		   $trip_id = $date.''.$list->vehicleid;

		   if($result){

			   if($geo_dis >= $v_dis){   // in from geofence

				   if($all_status == 2){  // add trip

						$data = array(

												   "vehicle_id" => $list->vehicleid,
												   "client_id" => $list->client_id,
												   "trip_id" => $trip_id,
												   "lat" => $v_list->v_lat,
												   "lng" => $v_list->v_lng,
												   "in_datetime" => $v_list->modified_date,
												   "speed" => $v_list->speed,
												   "geo_location_id" => $list->Location_Id,
												   "g_lat" => $list->g_lat,
												   "g_lng" => $list->g_lng,
												   "distance" =>'',
												   "ignition_status" => $v_list->acc_status,
												   "location_status" => 1,
												   );
											   $this->db->insert('sch_geofence_report_test',$data);
										// print_r($data);

						   

				   }

							   
			   
			   }else{	//vehicle out

				   if($all_status == 1 && $list->Location_Id == $g_id && $in_check!=''){  // last trip end

					   //$out_check_date = date('Y-m-d H:i');
					   //	$deive_no = $list->deviceimei;

						   //$distance_con = $this->find_trip_distance($out_check_date,$in_check_date,$deive_no);

						   $distance_con ='';

								   $data = array(

												   "out_datetime" => $v_list->modified_date,
												   "location_status" => 2,
												   "distance" => ''
												   );

								   $this->db->where('id',$id);

								  $result = $this->db->update('sch_geofence_report_test', $data);

			   
				   }	
			   
			   }



		   }else{  // new entry



			   if($geo_dis >= $v_dis){   // in from geofence


					   $data = array(

												   "vehicle_id" => $list->vehicleid,
												   "client_id" => $list->client_id,
												   "trip_id" => $trip_id,
												   "lat" => $v_list->v_lat,
												   "lng" => $v_list->v_lng,
												   "in_datetime" => $v_list->modified_date,
												   "speed" => $v_list->speed,
												   "geo_location_id" => $list->Location_Id,
												   "g_lat" => $list->g_lat,
												   "g_lng" => $list->g_lng,
												   "distance" => '',
												   "ignition_status" => $v_list->acc_status,
												   "location_status" => 1
												   );
						  $this->db->insert('sch_geofence_report_test',$data);


					   


			   }
			   

		   }
		   

			}
		



}
}		



}
