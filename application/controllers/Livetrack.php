<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
class Livetrack extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('livetrack_model');
		$this->load->model('Dashboardmodel');
		$this->load->model('route_model');
		$this->load->model('genericreport_model');
		//date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

	}
	public function index1()
	{
		redirect('login/');
	}

	public function index($country)
	{
		$this->livetrack_vehicles($country);
	}
	public function livetrack_vehicles($country)
	{
		
		$timezone = $country;
		$timezone_minute = ($timezone != 'qatar') ? 330 : 180;
		$timezone = ($timezone != 'qatar') ? date_default_timezone_set("Asia/Calcutta") : date_default_timezone_set("Asia/qatar");
		$customercomplaint = $this->Dashboardmodel->customer_complaint();
		$data['customercomplaint'] = $customercomplaint;
		$accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$ct =  date('H:i:A');
		print_r($ct);
		$total_duration = 0;
		if (!(in_array(date('D'), ['Sun'])))                 /* Current date is not sunday if condition is false So functions are workings */ {
			$liveroute_details = $this->livetrack_model->livetrackvehicles($timezone_minute);      // Get Assign Route Lists
			echo"<pre>";
			print_r($liveroute_details);
			foreach ($liveroute_details as $list) {
				if (!(in_array(date('D'), ['Sat']) && $list->saturday_status != 1)) {
					// day is saturday and saturday_status is  equal to 1 is means this function saturday working
					 $route_pl_starttime = date('H:i:A', (strtotime($list->route_starttime)));   // First Start date
					 $route_pl_endtime = date('H:i:A', strtotime('+ 15 Minutes', strtotime($list->route_endtime)));      // First End date
					 $route_id = $list->route_id;
					 echo"<pre>";
					 print_r($route_pl_starttime);	 	  
					
					if (($ct >= $route_pl_starttime && $ct <= $route_pl_endtime))       // True If condition  Between currentdate and therir dates
					{
						$client_id = $list->client_id;
						$vehicle_id = $list->vehicle_id;
						$route_startid = $list->route_geo_start_id;
						$route_endid = $list->route_geo_end_id;
						$shift_type = $list->shift_type;
						$latitude1 = $list->lat;
						$longitude1 = $list->lng;
						$latitude2 = $list->routestart_lat;
						$longitude2 = $list->routestart_lng;
						$latitude3 = $list->routeend_lat;
						$longitude3 = $list->routeend_lng;
						$routestart_radius = $list->routestart_radius;
						$routeend_radius = $list->routeend_radius;

						$route_starttime = date('Y-m-d H:i:s', strtotime($list->route_starttime));
						// $routestartgeo = $this->livetrack_model->routestartgeo($route_startid, $vehicle_id, $route_starttime);
						$routestartgeo = $this->livetrack_model->routestartgeo($route_startid, $vehicle_id, $route_starttime);
						echo"<pre>";
						print_r($this->db->last_query());
						// echo $last_record_geofence = $this->livetrack_model->last_georeport_data($route_startid, $vehicle_id);
						echo $last_record_geofence = $this->livetrack_model->last_georeport_data($route_startid, $vehicle_id);
						echo"<pre>";
						
						$route_exit_time = $routestartgeo->out_datetime;  //Startroute Exit time
						$this->insert_geofence($list, $route_startid, $routestart_radius, $last_record_geofence, $latitude1, $longitude1, $latitude2, $longitude2);

						$routeplanstart = date('Y-m-d H:i:s', strtotime($list->route_starttime));
						$d1 = new DateTime($route_exit_time);
						$d2 = new DateTime($routeplanstart);
						$interval = $d1->diff($d2);
						$diffInMinutes = $interval->i;
						$add_time = ($list->late_status == 1) ? $diffInMinutes : 0;
						$add_time = '+ ' . $add_time . ' minutes';
						$route_endtime = date('Y-m-d H:i:s', strtotime($add_time, strtotime($list->route_endtime)));
						$routeendgeo = $this->livetrack_model->routeendgeo($route_endid, $vehicle_id, $route_endtime);
						$last_record_geofence = $this->livetrack_model->last_georeport_data($route_endid, $vehicle_id);
						$this->insert_geofence($list, $route_endid, $routeend_radius, $last_record_geofence, $latitude1, $longitude1, $latitude3, $longitude3);
						$route_entry_time = $routeendgeo->in_datetime;     // Startroute Entry time
						if ($route_exit_time) {
							$route_planstart_time =  date('H:i A', strtotime($add_time, strtotime($list->route_starttime)));
							$route_planend_time =  date('H:i A', strtotime($add_time, strtotime($list->route_endtime)));

							$vehiclelatlng = $this->livetrack_model->vehiclelatlng($vehicle_id);
							$routelatlng = $this->livetrack_model->routelatlng($route_endid,$client_id);
							$routelatlng1 = $this->livetrack_model->routelatlng($route_startid,$client_id);
						
							$vehicle_lat = $vehiclelatlng->lat;									//vehicle lat
							$vehicle_lng = $vehiclelatlng->lng;									//vehicle lng
							$vehicle_speed = $vehiclelatlng->speed;                             //vehicle current speed
							$distance = $this->geo_distance($latitude1, $longitude1, $latitude3, $longitude3);
							// $duration = $this->GetDuration($latitude1, $longitude1, $latitude3, $longitude3);
							$duration = $this->GetDuration($longitude1, $latitude1, $longitude3, $latitude3);
							$add_eta = '+ ' . $duration . ' Minutes';
							$routeend_ept_time = date('Y-m-d H:i:s', strtotime($add_eta));   // add minus to current datetime
							$vehicle_name = $list->vehiclename;    //Vehicle name
							$routename = $list->route_name;      // Route Name
							$tripstart_alert = $this->livetrack_model->tripstart_alert($route_id, $checkid = 1,$shift_type);      //Send Alert to all parents Trip Start 
							// print_r($this->db->last_query());
							if ($tripstart_alert) {
								foreach ($tripstart_alert as $tlist) {
									$smsdata = array(
										'route_name' => $tlist->route_name,
										'route_id' => $tlist->route_id,
										'stop_name' => $routelatlng1->Location_short_name,
										'stop_id' => $route_startid,
										'distance' => $distance,
										'expected_time' => $duration,
										'vehicle_number' => $vehicle_name,
										'speed' => $vehicle_speed,
										'lat' => $vehicle_lat,
										'lng' => $vehicle_lng,
										'createdon' => date('Y-m-d H:i:s'),
										'vehicle_id' => $vehicle_id,
										'client_id' => $client_id,
										'parent_id' => $tlist->parent_id,
										'all_status' => 1,
										'alert_type' => 'Trip Start',
										'alert_location' => $vehiclelatlng->latlon_address
									);
									$this->db->insert('sch_sms_alert', $smsdata);
									$update_status = array('status' => 2);
									$this->db->where('route_id', $tlist->route_id);
									$this->db->update('sch_student', $update_status);

									$this->trip_alerts_whatsapp($tlist->mobilenumber,$vehicle_name,$duration);
								}
							}
							if ($route_entry_time) {
								$tripstart_alert = $this->livetrack_model->tripstart_alert($route_id, $checkid = 2,$shift_type);      //Send Alert to all parents Trip End 
								if ($tripstart_alert ) {
									foreach ($tripstart_alert as $tlist) {
										$smsdata = array(
											'route_name' => $tlist->route_name,
											'route_id' => $tlist->route_id,
											'stop_name' => $routelatlng->Location_short_name,
											'stop_id' => $route_endid,
											'distance' => $distance,
											'expected_time' => $duration,
											'vehicle_number' => $vehicle_name,
											'speed' => $vehicle_speed,
											'lat' => $vehicle_lat,
											'lng' => $vehicle_lng,
											'createdon' => date('Y-m-d H:i:s'),
											'vehicle_id' => $vehicle_id,
											'client_id' => $client_id,
											'parent_id' => $tlist->parent_id,
											'all_status' => 2,
											'alert_type' => 'Trip End',
											'alert_location' => $vehiclelatlng->latlon_address
										);

										$this->db->insert('sch_sms_alert', $smsdata);

										$update_status = array('status' => 4);
										$this->db->where('student_id', $tlist->student_id);
										$this->db->update('sch_student', $update_status);
									}
								}
							}
							$livedata = array(
								'vehicle_name' => $vehicle_name,
								'vehicle_id' => $list->vehicleid,
								'client_id' => $client_id,
								'routename' => $routename,
								'route_id' => $route_id,
								'route_startid' => $route_startid,
								'route_endid' => $route_endid,
								'route_planstart_time' => $route_planstart_time,
								'route_planend_time' => $route_planend_time,
								'route_exitime' => $route_exit_time,
								'routeend_exptime' => $routeend_ept_time,
								'route_entry_time' => $route_entry_time,
								'travel_date' => date('Y-m-d')
							);
							$livestop_details = $this->livetrack_model->livestop_details($route_id);
							// print_r($livestop_details);
							$livestop_data = array();
							$prev_stop_arr = null;
							foreach ($livestop_details as $key => $stoplist) {
								$stop_geoid = $stoplist->stop_geo_id;
								$stop_arrival_time = date('Y-m-d H:i:s', strtotime($add_time, strtotime($stoplist->stop_arrival_time)));
								$stop_start_time = date('Y-m-d H:i:s', strtotime($add_time, strtotime($stoplist->stop_start_time)));
								$stopentry_geotime = $this->livetrack_model->stop_geointime($stop_geoid, $vehicle_id, $stop_arrival_time);
								$stopexit_geotime = $this->livetrack_model->stop_geoouttime($stop_geoid, $vehicle_id, $stop_start_time);
								$stopplaned_entry =  date('H:i A', strtotime($add_time, strtotime($stoplist->stop_arrival_time)));
								$stopplaned_exit =  date('H:i A', strtotime($add_time, strtotime($stoplist->stop_start_time)));

								$stopentry_time = $stopentry_geotime->in_datetime;    // Stop Entry Time
								$stopexit_time = $stopentry_geotime->out_datetime;     // Stop Exit Time
								$stoplatlng = $this->livetrack_model->stoplatlng($stop_geoid);
                                // print_r($stoplatlng);
								$stop_lat = $stoplatlng->Lat;     // Stop Lat
								$stoplng = $stoplatlng->Lng;      // Stop Lng
								$stop_radius = $stoplist->stop_radius;
								$last_record_geofence = $this->livetrack_model->last_georeport_data($stop_geoid, $vehicle_id);
								$this->insert_geofence($list, $stop_geoid, $stop_radius, $last_record_geofence, $vehicle_lat, $vehicle_lng, $stop_lat, $stoplng);
								$distance = $this->geo_distance($stop_lat, $stoplng, $vehicle_lat, $vehicle_lng);
								// print_r($distance);
								//  if($key == 0){
								// 	//$duration = $this->GetDuration($latitude2, $longitude2,$stop_lat, $stoplng);
								// 	$duration = $this->GetDuration($longitude2, $latitude2,$stoplng, $stop_lat);
								// 	$total_duration += $duration; 
								//  }
								//  else{
								// 	$prev_stop_lat = $prev_stop_arr->Lat;
								// 	$prev_stop_lng = $prev_stop_arr->Lng;
								// 	//$duration = $this->GetDuration($stop_lat, $stoplng,$stop_lat, $stoplng);
								// 	$duration = $this->GetDuration($longitude2, $latitude2,$stoplng, $stop_lat);
								//  }
								 if($key != 0){
									//$duration = $this->GetDuration($latitude2, $longitude2,$stop_lat, $stoplng);
									$duration = $this->GetDuration($longitude2, $latitude2,$stoplng, $stop_lat);
									$total_duration += $duration; 
								 }
								 else{
									$prev_stop_lat = $prev_stop_arr->Lat;
									$prev_stop_lng = $prev_stop_arr->Lng;
									// $duration = $this->GetDuration($latitude2, $longitude2,$stop_lat, $stoplng);
									$duration = $this->GetDuration($longitude2, $latitude2,$stoplng, $stop_lat);
									print_r($latitude2);
									print_r($longitude2);
									echo"<pre>";
									print_r($stop_lat);
									print_r($stoplng);

									// echo"eta";
									// print_r($duration);die;
								 }
							
								$eta_mins = $duration;
								print_r($eta_mins);
								$add_eta = '+ ' . $duration . ' Minutes';
								$stop_ept_time = date('Y-m-d H:i:s', strtotime($add_eta));
								if ($eta_mins != 0 && $eta_mins < 5) {

									$tripstart_alert = $this->livetrack_model->stopstart_alert($route_id, $stoplist->stop_id, $checkid = 2,$shift_type);      //Send Alert to all parents Reach Within 5 mins 
									if ($tripstart_alert) {
										foreach ($tripstart_alert as $tlist) {
											$smsdata = array(
												'route_name' => $tlist->route_name,
												'route_id' => $tlist->route_id,
												'stop_name' => $stoplatlng->Location_short_name,
												'stop_id' => $stop_geoid,
												'distance' => $distance,
												'expected_time' => $duration,
												'vehicle_number' => $vehicle_name,
												'speed' => $vehicle_speed,
												'lat' => $vehicle_lat,
												'lng' => $vehicle_lng,
												'createdon' => date('Y-m-d H:i:s'),
												'vehicle_id' => $vehicle_id,
												'client_id' => $client_id,
												'parent_id' => $tlist->parent_id,
												'all_status' => 3,
												'alert_type' => 'Reach In stop With In 5 Mins',
												'alert_location' => $vehiclelatlng->latlon_address
											);

											$this->db->insert('sch_sms_alert', $smsdata);
											$update_status = array('status' => 3);
											$this->db->where('student_id', $tlist->student_id);
											$this->db->update('sch_student', $update_status);

											$this->trip_alerts_whatsapp($tlist->mobilenumber,$vehicle_name,$duration);
										}
									}
								}
								if ($stopentry_time) {
									$tripstart_alert = $this->livetrack_model->stopstart_alert($route_id, $stoplist->stop_id, $checkid = 3,$shift_type);      //Send Alert to all parents Reach Within 5 mins 
									if ($tripstart_alert) {
										foreach ($tripstart_alert as $tlist) {
											$smsdata = array(
												'route_name' => $tlist->route_name,
												'route_id' => $tlist->route_id,
												'stop_name' => $stoplatlng->Location_short_name,
												'stop_id' => $stop_geoid,
												'distance' => $distance,
												'expected_time' => $duration,
												'vehicle_number' => $vehicle_name,
												'speed' => $vehicle_speed,
												'lat' => $vehicle_lat,
												'lng' => $vehicle_lng,
												'createdon' => date('Y-m-d H:i:s'),
												'vehicle_id' => $vehicle_id,
												'client_id' => $client_id,
												'parent_id' => $tlist->parent_id,
												'all_status' => 3,
												'alert_type' => 'Stop Reached',
												'alert_location' => $vehiclelatlng->latlon_address
											);

											$this->db->insert('sch_sms_alert', $smsdata);
											$update_status = array('status' => 5);
											$this->db->where('student_id', $tlist->student_id);
											$this->db->update('sch_student', $update_status);

										}
									}
								}
								$livestop_data[] = array(
									'stop_geo_id' => $stop_geoid,
									'client_id' => $client_id,
									'stopplaned_entry' => $stopplaned_entry,
									'stopplaned_exit' => $stopplaned_exit,
									'stopentry_time' => $stopentry_time,
									'stopexit_time' => $stopexit_time,
									'stop_ept_time' => $stop_ept_time
								);
								$prev_stop_arr = $stoplist;
							}
							if ($list->report_flag == 1 && $route_entry_time != '') {
								$insert_report = $this->insert_routereport($livedata, $livestop_data);
							}
							$livedetails[] = array(
								'liveroute_details' => $livedata,
								'livestop_details' => $livestop_data
							);
						}
					}
					else if($list->report_flag == 2)
					{
						$update_status = array('report_flag' => 1);
						$this->db->where('route_id', $route_id);
						$this->db->update('sch_routeassigntbl', $update_status);
						$this->db->where('route_id',  $route_id);
						$this->db->update('sch_student', array('status' => 1));

					}
				}
			}
			die;
		}
		if ($livedetails) {
			$data['livedetails'] = $livedetails;
			//	$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar', $data);
			//$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('Dashboard/livetrack_dashboard', $data);
			$this->load->view('components/footer/footerscript');
			// $this->load->view('components/footer/footer');
		} else {
			$data['livedetails'] = $livedetails;
			//$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar', $data);
			//$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('Dashboard/livetrack_dashboard', $data);
			$this->load->view('components/footer/footerscript');
		}
	}


	public function geo_distance($latitude1, $longitude1, $latitude2, $longitude2)
	{

		$dis_query = $this->db->query("SELECT get_distance_in_miles_between_geo_locations('{$latitude1}', '{$longitude1}', '{$latitude2}','{$longitude2}') as distance;");
		$result = $dis_query->result();
		$wp_dis = $result[0]->distance;
		$v_dis = $wp_dis * 1000;
		return  $v_dis = round($v_dis);
	}
	public function insert_geofence($list, $geolocation_id, $radius, $last_geodata, $lat1, $lng1, $lat2, $lng2)
	{

	    $all_status = $last_geodata[0]['location_status'];
		$id = $last_geodata[0]['id'];
		$g_id = $last_geodata[0]['geo_location_id'];
		$in_check = $last_geodata[0]['in_datetime'];
		$in_check_from = strtotime($in_check);
		$in_check_date = date('Y-m-d H:i', $in_check_from);
		$date = date('mdHis');
		$trip_id = $date . '' . $list->vehicle_id;
		$distance = $this->geo_distance($lat1, $lng1, $lat2, $lng2);
		if ($last_geodata) {
			if ($radius >= $distance) {   // in from geofence
				if ($all_status == 2) {  // add trip
					$data = array(
						"vehicle_id" => $list->vehicle_id,
						"client_id" => $list->client_id,
						"trip_id" => $trip_id,
						"lat" => $lat1,
						"lng" => $lat2,
						"in_datetime" => date('Y-m-d H:i:s'),
						"speed" => $list->speed,
						"geo_location_id" => $geolocation_id,
						"g_lat" => $lat2,
						"g_lng" => $lng2,
						// "distance" => $list->traveled_distance,
						"ignition_status" => $list->acc_on,
						"location_status" => 1
					);
					$this->db->insert('sch_geofence_report', $data);
				}
			} else {	//vehicle out

				if ($all_status == 1 && $geolocation_id == $g_id && $in_check != '') {  // last trip end
					$data = array(
						"out_datetime" => date('Y-m-d H:i:s'),
						"location_status" => 2,
						// "distance" => $distance_con
					);

					$this->db->where('id', $id);
					$this->db->update('sch_geofence_report', $data);
				}
			}
		} else {
			if ($distance < $radius) {
				$data = array(
					"vehicle_id" => $list->vehicle_id,
					"client_id" => $list->client_id,
					"trip_id" => $trip_id,
					"lat" => $lat1,
					"lng" => $lat2,
					"in_datetime" => date('Y-m-d H:i:s'),
					"speed" => $list->speed,
					"geo_location_id" => $geolocation_id,
					"g_lat" => $lat2,
					"g_lng" => $lng2,
					// "distance" => $list->traveled_distance,
					"ignition_status" => $list->acc_on,
					"location_status" => 1
				);
				$this->db->insert('sch_geofence_report', $data);
			}
		}
	}
	public function insert_routereport($routelist, $stoplist)
	{
		$route_startplantime = substr($routelist['route_planstart_time'], 0, -2);
		$route_endplantime =  substr($routelist['route_planend_time'], 0, -2);
		unset($routelist['route_planstart_time']);
		unset($routelist['route_planend_time']);

		$routelist['route_planstart_time']  = date('Y-m-d H:i:s', strtotime($route_startplantime));
		$routelist['route_planend_time']  = date('Y-m-d H:i:s', strtotime($route_endplantime));

		$this->db->insert('sch_add_liveroute_list', $routelist);
		$lastid = $this->db->insert_id();

		foreach ($stoplist as $slist) {

			$stop_planentry = date('Y-m-d H:i:s', strtotime(substr($slist['stopplaned_entry'], 0, -2)));
			$stop_planexit = date('Y-m-d H:i:s', strtotime(substr($slist['stopplaned_exit'], 0, -2)));

			$livestop_data = array(
				'live_routeid' => $lastid,
				'client_id' => $slist['client_id'],
				'stop_geo_id' => $slist['stop_geo_id'],
				'stopplaned_entry' => $stop_planentry,
				'stopplaned_exit' => $stop_planexit,
				'stopentry_time' => $slist['stopentry_time'],
				'stopexit_time' => $slist['stopexit_time'],
				'stop_ept_time' => $slist['stop_ept_time'],
				'travel_date' => date('Y-m-d')
			);
			$this->db->insert('sch_add_livestop_list', $livestop_data);
		}
		$update_status = array('report_flag' => 2);
		$this->db->where('route_id', $routelist['route_id']);
		$this->db->update('sch_routeassigntbl', $update_status);


	}
	public function playback_details()
	{
		$Text = urldecode($_REQUEST['data']);
		$data['livetrack_playback'] = json_decode($Text);

		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//	$this->load->view('components/mainmenu',$accessmenu);
		$this->load->view('Dashboard/livetrack_playback', $data);
		$this->load->view('components/footer/footerscript');
	}

	public function get_all_history()
	{
		$vid = $this->input->post('vehicle');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$to_date = ($to_date == '') ? date('Y-m-d H:i:s') : $to_date;

		$fromtime = strtotime($from_date);
		$totime = strtotime($to_date);
		$from = date('Y-m-d H:i:s', $fromtime);
		$todate = date('Y-m-d H:i:s', $totime);


		$history_result = $this->livetrack_model->get_all_history_data($vid, $from, $todate);


		echo json_encode($history_result);
	}


	function single_vehicledata($id)
	{

		$result = $this->Dashboardmodel->single_vehicle_data($id); // get vehicle data from vehicle table 

		if ($result->odometer == '') {
			$odo = 0;
		} else {
			$odo = $result->odometer;
		}

		$device_type = $result->device_type;
		$vehicle_shortname = $this->Dashboardmodel->vehicle_shortname($result->vehicletype);


		$data = array(
			'lat' => round($result->lat, 5), 'lng' => round($result->lng, 5),
			'angle' => $result->angle, 'vehicleid' => $result->vehicleid, 'vehiclename' => $result->vehiclename,
			'speed' => $result->speed, 'updatedon' => $result->updatedon, 'update_time' => $result->update_time,
			'acc_on' => $result->acc_on, 'odometer' => $odo,
			'car_battery' => $result->car_battery, 'device_battery' => $result->device_battery,
			'vehicle_shortname' => $vehicle_shortname, 'latlon_address' => trim($result->latlon_address)
		);

		if ($data) {

			echo json_encode($data); //convert to json format for ajax call
		} else {
			echo 'false';
		}
	}

	public function routelatlngs()
	{
		$route_id = $this->input->post('route_id');

		$route_latlng = $this->livetrack_model->route_latlng($route_id);
		$stop_latlng = $this->livetrack_model->stop_latlng($route_id);
		foreach ($stop_latlng as $slist) {

			$stop_id = $this->livetrack_model->stopid_list($route_latlng->route_id, $slist->stop_geo_id);
			$student_count = $this->livetrack_model->student_stop_count($route_latlng->route_id, $stop_id);
			$stop_list[] = array(
				'stop_latlng' => $slist,
				'student_count' => $student_count
			);
			//$stop_list['student_count'] = $student_count;

		}
		// print_r($stop_list);exit;				
		$latlngs = array(
			'route_latlng' => $route_latlng,
			'stop_latlng' => $stop_list
		);

		echo json_encode($latlngs);
	}



	public function reportplayback_details()
	{
		$Text = urldecode($_REQUEST['data']);
		$data['livetrack_playback'] = json_decode($Text);

		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//	$this->load->view('components/mainmenu',$accessmenu);
		$this->load->view('reports/specific_report/livetrack_playbackreport', $data);
		$this->load->view('components/footer/footerscript');
	}

	public function get_park_history()
	{

		$vid = $this->input->post('vehicle');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$fromtime = strtotime($from_date);
		$totime = strtotime($to_date);
		$from = date('Y-m-d H:i:s', $fromtime);
		$todate = date('Y-m-d H:i:s', $totime);


		$history_result = $this->genericreport_model->get_park_history_data($vid, $from, $todate);

		echo json_encode($history_result);
	}
	
    public function get_rfid_data()
    {
        $stopid = $this->input->post('stop_geo_id');
        $query = $this->livetrack_model->get_rfid_data($stopid);
        echo json_encode($query);
    }
	public function GetDuration($latitude1 = '76.9565931',$longitude1 = '10.9664454',$latitude2 = '77.09287326185753',$longitude2 = '11.0678593')
	{
		//
		// Set up the API endpoint and parameters
		$apiEndpoint = 'http://69.30.202.202:5000/route/v1/driving/';
		$origin = $latitude1.','.$longitude1;  // e.g. "lat,lon"
		$destination =$latitude2.','.$longitude2;    // e.g. "lat,lon"
		$params = [
			'overview' => 'false',
			'alternatives' => 'true',
			'steps' => 'true',
			'hints' => ';'
		];
		$url = $apiEndpoint . $origin . ';' . $destination . '?' . http_build_query($params);
	//	echo $url;exit;
		// Send a GET request to the API endpoint and parse the response JSON
		$response = file_get_contents($url);
		$data = json_decode($response);
		// Extract the relevant details from the response
		$routes = $data->routes;  // array of routes (if alternatives=true)
		$route = $routes[0];  // choose the first route (if alternatives=true)
		$duration = round(($route->duration/ 60));  // total duration in seconds
		// print_r($duration);die;
		return $duration;
	   
	}
	
	public function GetDuration1($latitude1 = '76.9565931',$longitude1 = '10.9664454',$latitude2 = '77.09287326185753',$longitude2 = '11.0678593')
	{
		//
		// Set up the API endpoint and parameters
		$apiEndpoint = 'http://69.30.202.202:5000/route/v1/driving/';
		$origin = $latitude1.','.$longitude1;  // e.g. "lat,lon"
		$destination =$latitude2.','.$longitude2;    // e.g. "lat,lon"
		$params = [
			'overview' => 'false',
			'alternatives' => 'true',
			'steps' => 'true',
			'hints' => ';'
		];
		$url = $apiEndpoint . $origin . ';' . $destination . '?' . http_build_query($params);
	//	echo $url;exit;
		// Send a GET request to the API endpoint and parse the response JSON
		$response = file_get_contents($url);
		$data = json_decode($response);
		// Extract the relevant details from the response
		$routes = $data->routes;  // array of routes (if alternatives=true)
		$route = $routes[0];  // choose the first route (if alternatives=true)
		$duration = round(($route->duration/ 60));  // total duration in seconds
		return $duration;
	   
	}

	public function trip_alerts_whatsapp($mobilenumber='6383883745',$vehicle_name,$duration='10 Mins'){
            
		    $data = urlencode("Greetings!
			The college bus is expected to arrive at  in approximately *".$duration."*, Please be ready at the designated pick-up point.
We will notify you promptly if there are any unexpected delays or changes in the schedule.
		    	Thanks for your cooperation.");
			$whatsapp_no = "91".$mobilenumber;
			$url = "https://app.pinger.co.in/api/send.php?number=" . $whatsapp_no . "&type=text&message=" . $data . "&instance_id=647ADE3A091AA&access_token=a33f8a32f297eee64ad14e8455f4ec7b";
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HEADER => true
			));

			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$response = curl_exec($curl);

			curl_close($curl);
	}
}
