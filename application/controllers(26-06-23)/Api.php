<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->model('Dashboardmodel');
		$this->load->model('genericreport_model');
		$this->load->model('Smartreport_model');
		$this->load->library('Authorization_Token');

		date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
	}

	public function user_post()
	{
		$array  = array('status' => 'ok', 'data' => 1);
		$this->response($array);
	}

	public function login_post()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$push_code = $this->input->post('push_code');

		$checkuser = $this->api_model->checkuser($username, $password);
		$timezone_hours = ($checkuser->time_zone == 1) ? 180 : 330;

		if ($checkuser) {
			$token_data['userid'] = $checkuser->userid;
			$token_data['username'] = $checkuser->username;
			$token_data['client_id'] = $checkuser->client_id;
			$token_data['dealer_id'] = $checkuser->dealer_id;
			$token_data['roleid'] = $checkuser->roleid;
			$token_data['subdealer_id'] = $checkuser->subdealer_id;
			$token_data['time_zone'] = $checkuser->time_zone;
			$token_data['timezone_hours'] = $timezone_hours;

			$tokenData = $this->authorization_token->generateToken($token_data);

			$push_data = array(
				'userid' => $checkuser->userid,
				'push_code' => $push_code,
			);
			$user_count = $this->db->query("SELECT count(*) as user_count FROM sch_user_pushcode WHERE userid=$checkuser->userid");
			$count = $user_count->num_rows();
			if ($count > 5) {
				$this->db->query("DELETE FROM sch_user_pushcode ORDER BY push_id ASC LIMIT 1");
				$sql = $this->db->insert_string('sch_user_pushcode', $push_data) . ' ON DUPLICATE KEY UPDATE userid=LAST_INSERT_ID(userid)';
				$this->db->query($sql);
			} else {
				$sql = $this->db->insert_string('sch_user_pushcode', $push_data) . ' ON DUPLICATE KEY UPDATE userid=LAST_INSERT_ID(userid)';
				$this->db->query($sql);
			}


			$checkuser1 = $this->api_model->checkuser1($checkuser->userid);

			$array = array();
			$array['status'] = 1;
			$array['refresh_token'] = 'SWT ' . $tokenData;
			$array['data'] = $checkuser1;
		} else {
			$array  = array('status' => 0, 'message' => 'Username and Password Not Excist');
		}
		$this->response($array);
	}



	public function mapview_get()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);

		if ($result['status'] == 1) {
			$userid = $result['data']->userid;

			$liveroute_details = $this->api_model->livetrackvehiclelist($userid);
			foreach ($liveroute_details as $list) {

				$client_id = $this->session->userdata['client_id'];
				$route_id = $list->route_id;
				$vehicle_id = $list->vehicle_id;
				$deviceimei = $list->deviceimei;
				$route_startid = $list->route_geo_start_id;
				$route_endid = $list->route_geo_end_id;
				$shift_type = $list->shift_type;
				// $routestartgeo= $this->api_model->routestartgeo($route_startid,$vehicle_id,$shift_type);
				// $routeendgeo= $this->api_model->routeendgeo($route_endid,$vehicle_id,$shift_type);

				$route_starttime = date('Y-m-d H:i:s', strtotime($list->route_starttime));
				$routestartgeo = $this->api_model->routestartgeo($route_startid, $vehicle_id, $route_starttime);
				$routeplanstart = date('Y-m-d H:i:s', strtotime($list->route_starttime));
				$route_exit_time = $routestartgeo->out_datetime;

				$d1 = new DateTime($route_exit_time);
				$d2 = new DateTime($routeplanstart);
				$interval = $d1->diff($d2);
				$diffInMinutes = $interval->i;
				$add_time = ($list->late_status == 1) ? $diffInMinutes : 0;

				$add_time = '+ ' . $add_time . ' minutes';

				$route_endtime = date('Y-m-d H:i:s', strtotime($add_time, strtotime($list->route_endtime)));
				$routeendgeo = $this->api_model->routeendgeo($route_endid, $vehicle_id, $route_endtime);


				$route_exit =   date("h:i A", strtotime($routestartgeo->out_datetime));
				//exit;
				$route_entry_time = $routeendgeo->in_datetime;
				$route_entry = ($route_entry_time != '') ? $route_entry =   date("h:i A", strtotime($routeendgeo->in_datetime)) : '';

				if ($route_exit_time) {

					$vehiclelatlng = $this->api_model->vehiclelatlng($vehicle_id);
					$routelatlng = $this->api_model->routelatlng($route_endid);
					$routelatlng1 = $this->api_model->routelatlng($route_startid);

					$route_endlat = $routelatlng->Lat;
					$route_endlng = $routelatlng->Lng;

					$vehicle_lat = $vehiclelatlng->lat;									//vehicle lat
					$vehicle_lng = $vehiclelatlng->lng;									//vehicle lng
					$vehicle_speed = $vehiclelatlng->speed;                             //vehicle current speed
					$distance = $this->geo_distance($route_endlat, $route_endlng, $vehicle_lat, $vehicle_lng);

					$expecttime = $distance / 40;
					$routeend_ept_time = floor($expecttime * 60);
					$add_eta = '+ ' . $routeend_ept_time . ' Minutes';
					$add_eta1 = $routeend_ept_time . ' Mins';
					$routeend_ept_time = date('Y-m-d H:i:s', strtotime($add_eta));
					$vehicle_name = $list->vehiclename;
					$routename = $list->route_name;

					//	$class_name = $this->api_model->sch_class($list->class_id);
					$class_section_name = $this->api_model->class_section_name($list->class_id, $list->section_id);

					$livedata = array(
						'student_name' => $list->student_name,
						'rollno' => $list->student_rollno,
						'class' => $class_section_name->class_name,
						'section' => $class_section_name->section_name,
						'vehicle_name' => $vehicle_name,
						'vehicle_id' => $vehicle_id,
						'deviceimei' => $deviceimei,
						'routename' => $routename,
						'route_startlocation' => $list->start_loc_name,
						'routestart_lattitute' => $list->routestartlat,
						'routestart_longitute' => $list->routestartlng,
						'route_endlocation' => $list->end_loc_name,
						'routeend_lattitute' => $list->routeendlat,
						'routeend_longitute' => $list->routeendlng,
						'route_planstart_time' => $list->route_starttime,
						'route_planend_time' => $list->route_endtime,
						'route_actualstarttime' => $route_exit,
						'route_actualendtime' => $route_entry,
						'route_actualstartdatetime' => $route_exit_time,
						'route_actualenddatetime' => $route_entry_time,
						'routeend_ETA_time' => $routeend_ept_time,
						'routeend_ETA_minutes' => $add_eta1
					);


					$livestop_details = $this->api_model->livestop_details($route_id, $list->stop_id);
					//	print_r($livestop_details);exit;
					$livestop_data = '';
					foreach ($livestop_details as $stoplist) {

						$stop_geoid = $stoplist->stop_geo_id;

						$stop_arrival_time = date('Y-m-d H:i:s', strtotime($add_time, strtotime($stoplist->stop_arrival_time)));
						$stop_start_time = date('Y-m-d H:i:s', strtotime($add_time, strtotime($stoplist->stop_start_time)));

						$stopentry_geotime = $this->api_model->stop_geointime($stop_geoid, $vehicle_id, $stop_arrival_time);
						$stopexit_geotime = $this->api_model->stop_geoouttime($stop_geoid, $vehicle_id, $stop_start_time);

						// $stopentry_geotime = $this->api_model->stop_geointime($stop_geoid,$vehicle_id,$shift_type);
						// $stopexit_geotime = $this->api_model->stop_geoouttime($stop_geoid,$vehicle_id,$shift_type);

						$stopentry_time = $stopentry_geotime->in_datetime;
						$stopexit_time = $stopexit_geotime->out_datetime;

						$stop_exit = ($stopexit_time != '') ? date("h:i A", strtotime($stopexit_time)) : '';
						$stop_entry = ($stopentry_time != '') ? date("h:i A", strtotime($stopentry_time)) : '';

						// $stop_exit =   date("h:i A",strtotime($stopexit_geotime->out_datetime)); 
						// $stop_entry =   date("h:i A",strtotime($stopentry_geotime->in_datetime));   

						$stoplatlng = $this->api_model->stoplatlng($stop_geoid);

						$stop_lat = $stoplatlng->Lat;
						$stoplng = $stoplatlng->Lng;
						$distance = $this->geo_distance($stop_lat, $stoplng, $vehicle_lat, $vehicle_lng);
						$expecttime = $distance / 40;
						$stop_ept_time = floor($expecttime * 60);
						$add_eta = '+ ' . $stop_ept_time . ' Minutes';
						$add_eta1 = $stop_ept_time . ' Mins';
						//	$stop_ept_time =  gmdate('H:i:s', floor($expecttime * 3600)); 
						$stop_ept_time = date('Y-m-d H:i:s', strtotime($add_eta));
						$stop_status = ($stopentry_time == null && $stopexit_time == null) ?  "Not Reached" : 'Reached';

						$livestop_data[] = array(
							'stop_name' => $stoplist->stop_name,
							'stop_lattitute' => $stoplist->stoplat,
							'stop_longitute' => $stoplist->stoplng,
							'stopplaned_entrytime' => $stoplist->stop_arrival_time,
							'stopplaned_exittime' => $stoplist->stop_start_time,
							'stopactual_entrytime' => $stop_entry,
							'stopactual_exittime' => $stop_exit,
							'stopactual_entrydatetime' => $stopentry_time,
							'stopactual_exitdatetime' => $stopexit_time,
							'stop_ETA_time' => $stop_ept_time,
							'stopreach_ETA_minutes' => $add_eta1,
							'stop_status' => $stop_status
						);
					}


					$livedetails[] = array(
						'liveroute_details' => $livedata,
						'livestop_details' => $livestop_data
					);
				}
			}
			if ($livedetails) {
				$data['status'] = 1;
				$data['liveroutes'] = $livedetails;
				$this->response($data, REST_Controller::HTTP_OK);
			} else {
				$data['status'] = 0;
				$data['message'] = "No data Found";

				$this->response($data, REST_Controller::HTTP_OK);
			}
		} else {
			$this->response($result);
		}
	}

	public function geo_distance($latitude1, $longitude1, $latitude2, $longitude2)
	{
		$unit = 'Km';
		$theta = $longitude1 - $longitude2;
		$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
		$distance = acos($distance);
		$distance = rad2deg($distance);
		$distance = $distance * 60 * 1.1515;
		switch ($unit) {

			case 'Mi':
				break;
			case 'Km':
				$distance = $distance * 1.609344;
		}

		if (number_format($distance) == 'nan') {
			$v_dis = 0;
		} else {
			$v_dis = $distance;
		}
		$v_dis . '<br>';
		$v_dis = $v_dis;

		return  $v_dis = round($v_dis);
	}



	public function playback_data_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('route_actualstartdatetime');
		$to_date = $this->input->post('route_actualenddatetime');

		if ($to_date) {
			$to_date = $this->input->post('route_actualenddatetime');
		} else {
			$to_date = date('Y-m-d H:i:s');
		}
		$deviceimei = $this->input->post('deviceimei');
		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$timezone_hours =  $result['data']->timezone_hours;
				$data['vehicle_details'] = $this->api_model->vehicle_details($deviceimei);
				//	$data['vehicletype'] = $this->api_model->vehicletype_data($deviceimei);
				$data['playback_data'] = $this->api_model->playback_data($deviceimei, $from_date, $to_date, $client_id, $timezone_hours);
				if ($data['playback_data']) {
					$this->response($data);
				} else {
					$data1['status'] = 0;
					$data1['message'] = 'Data Not Found';
					$this->response($data1);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function profilelist_post()
	{
		$headers = $this->input->request_headers();

		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$userid = $result['data']->userid;
			$client_id = $result['data']->client_id;
			$data['parent_details'] =  $this->api_model->userlist($userid, $client_id);
			$data['student_details'] =  $this->api_model->student_list($userid);

			$this->response($data);
		} else {
			$this->response($result);
		}
	}


	public function notification_alert_GET()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		//print_r($result);exit;
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$userid = $result['data']->userid;
			$data['notification_alert'] = $this->api_model->notification_alert($userid);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}


	public function history_details_POST()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);

		//print_r($result); die;
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$vehicle = $this->input->post('imei');
			$from_date_post = $this->input->post('from_date');
			$to_date_post = $this->input->post('to_date');
			$client_id = 3;
			$userid = $result['data']->userid;
			$role = $result['data']->roleid;
			$reporttype = $this->input->post('reporttype');

			if ($reporttype == 1) {
				$from_date = date('Y-m-d');
				$to_date = date('Y-m-d');
			} elseif ($reporttype == 2) {
				$from_date = date('Y-m-d', strtotime('-1 Day'));
				$to_date = date('Y-m-d');
			} elseif ($reporttype == 3) {
				$from_date = date('Y-m-d', strtotime('-7 Day'));
				$to_date = date('Y-m-d');
			} elseif ($reporttype == 4) {
				$from_date = $from_date_post;
				$to_date = $to_date_post;
			} else {
				echo "fail";
			}



			$data = $this->api_model->history_alldata($vehicle, $from_date, $to_date, $client_id, $userid, $role);
			//--------------------------------Its Contain get Values And Store A Variable--------------------------------------------------
			$total_km = round($data->distance);
			$total_park = $data->parking_duration;
			$total_ac = $data->ac_duration;
			$total_idle = $data->idle_duration;
			$total_rpm = $data->totalrpm;
			$fuelconsum = round($data->fuel_consumed_litre);
			$fuelfill = round($data->fuel_fill_litre);
			$fueldip = round($data->fuel_dip_litre);
			$average_speed = round($data->average_speed);
			$maximum_speed = round($data->maximum_speed);
			$secondary_engine = "1:2:3";
			//---------------------- Above datas stored in a variable-> that variable use to send response ---------------------------------------------


			//------------------------------its change parking value to H:M:S------------------------------------------------------

			$park_duration = $total_park; //Parking Duration
			$hours = floor($park_duration / 60);
			$min = $park_duration - ($hours * 60);
			$min = floor((($min -   floor($min / 60) * 60)) / 6);
			$second = $park_duration % 60;

			$tot_park = $hours . ":" . $min . ":" . $second;



			//-------------------------------its change A/C value to H:M:S----------------------------------------------------			

			$ac_duration = $total_ac; //AC Duration
			$hours = floor($ac_duration / 60);
			$min = $ac_duration - ($hours * 60);
			$min = floor((($min -   floor($min / 60) * 60)) / 6);
			$second = $ac_duration % 60;

			$tot_ac = $hours . ":" . $min . ":" . $second;

			//--------------------------------Its change idle value to H:M:S--------------------------------------------------------------

			$idle_duration = $total_idle;
			$hours = floor($idle_duration / 60);
			$min = $idle_duration - ($hours * 60);
			$min = floor((($min -   floor($min / 60) * 60)) / 6);
			$second = $idle_duration % 60;

			$tot_idle = $hours . ":" . $min . ":" . $second;

			//--------------------------------Its change RPM value to H:M:S-----------------------------------------------------			

			$totalrpm_duration = $total_rpm; //Total RPM Duration
			$hours = floor($totalrpm_duration / 3600);
			$min = ($totalrpm_duration / 60) % 60;
			$min1 = round($min / 60, 1) * 10;
			$second = $totalrpm_duration % 60;

			$tot_rpm = $hours . ":" . $min . ":" . $second;
			//--------------------------------------------------------------------------------------------------------			
			//print_r($tot_rpm);die;

			$data = array(
				'distance' => $total_km,
				'parking_duration' => $tot_park,
				'ac_duration' => $tot_ac,
				'idle_duration' => $tot_idle,
				'totalrpm' => $tot_rpm,
				'fuel_consumed_litre' => $fuelconsum,
				'fuel_fill_litre' => $fuelfill,
				'fuel_dip_litre' => $fueldip,
				'average_speed' => $average_speed,
				'maximum_speed' => $maximum_speed,
				'secondary_engine' => $secondary_engine
			);

			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	// School Admin App API details

	public function login_admin_POST()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$apikey = $this->input->post('apikey');
		$push_code = $this->input->post('push_code');

		$checkuser = $this->api_model->checkuser_admin($username, $password);
		$dealer_id = $checkuser->dealer_id;
		$check_apikey = $this->api_model->checkuser_apikey($dealer_id, $apikey);

		if ($check_apikey) {
			$client_id = $checkuser->client_id;
			$gettimezone_data = $this->api_model->gettimezone_data($client_id);
			$userid = $checkuser->userid;

			if ($checkuser) {
				$token_data['userid'] = $checkuser->userid;
				$token_data['username'] = $checkuser->username;
				$token_data['client_id'] = $checkuser->client_id;
				$token_data['dealer_id'] = $checkuser->dealer_id;
				$token_data['roleid'] = $checkuser->roleid;
				$token_data['subdealer_id'] = $checkuser->subdealer_id;
				$token_data['time_zone'] = $checkuser->time_zone;
				$token_data['timezone_hours'] = $gettimezone_data->timezone_mins;

				$tokenData = $this->authorization_token->generateToken($token_data);

				$push_data = array(
					'userid' => $checkuser->userid,
					'push_code' => $push_code,
				);
				$user_count = $this->db->query("SELECT count(*) as user_count FROM sch_user_pushcode WHERE userid=$checkuser->userid");
				$count = $user_count->num_rows();
				if ($count > 5) {
					$this->db->query("DELETE FROM sch_user_pushcode ORDER BY push_id ASC LIMIT 1");
					$sql = $this->db->insert_string('sch_user_pushcode', $push_data) . ' ON DUPLICATE KEY UPDATE userid=LAST_INSERT_ID(userid)';
					$this->db->query($sql);
				} else {
					$sql = $this->db->insert_string('sch_user_pushcode', $push_data) . ' ON DUPLICATE KEY UPDATE userid=LAST_INSERT_ID(userid)';
					$this->db->query($sql);
				}


				$checkuser1 = $this->api_model->checkuser_admin_data($userid);


				$array = array();
				$array['status'] = 1;
				$array['refresh_token'] = 'SWT ' . $tokenData;
				$array['data'] = $checkuser1;
			} else {
				$array  = array('status' => 0, 'message' => 'Username and Password Not Excist');
			}
		} else {
			$array = array('status' => 0, 'message' => 'Your Not Authorized');
		}
		$this->response($array);
	}


	public function verify_post_admin()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);

		$this->response($decodedToken);
	}

	public function vehiclecount_get()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);

		if ($result['status'] == 1) {

			$roleid = $result['data']->roleid;
			$userid = $result['data']->userid;
			$client_id = $result['data']->client_id;
			if ($roleid == "15") {
				$data['status'] = 1;
				$data['allvehicle'] = $this->api_model->total_count($userid, $client_id, $roleid);
				$this->response($data, REST_Controller::HTTP_OK);
			} else {
				$data['status'] = 1;
				$data['allvehicle'] = array($this->api_model->total_count($userid, $client_id, $roleid));
				$this->response($data, REST_Controller::HTTP_OK);
			}
		} else {
			$this->response($result);
		}
	}

	public function vehicledetails_get()
	{
		$headers = $this->input->request_headers();
		$deviceimei = $this->input->get('imei');
		$valid_status = 1;
		if ($deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'deviceimei is Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$ct = date('Y-m-d');
				$start_date = $ct . ' 00:00:00';
				$end_date = $ct . ' 23:59:59';

				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				$device_type = $data['vehicle_details']->device_type;

				$ct_client_id = $data['vehicle_details']->client_id;
				$today_km_data = $this->api_model->calculate_distance($deviceimei, $start_date, $end_date, $client_id);
				$percentage = $this->api_model->percentage_detail($client_id, $deviceimei);
				$batteryvolt = ($percentage) ? 'No data' : $data['vehicle_details']->batteryvolt;

				$percentage = ($percentage) ? $percentage : 'No data';
				$today_km = ($today_km_data) ? $today_km_data->distance_km : 0;

				$today_km = ($today_km_data) ? $today_km_data->distance_km : 0;

				$data['vehicle_details'] = array(array(
					"client_id" => $data['vehicle_details']->client_id,
					"vehicle_id" => $data['vehicle_details']->vehicle_id,
					"alarm_set" => $data['vehicle_details']->alarm_set,
					"updatedon" => $data['vehicle_details']->updatedon,
					"update_time" => $data['vehicle_details']->update_time,
					"odometer" => $data['vehicle_details']->odometer,
					"speed" => $data['vehicle_details']->speed,
					"acc_on" => $data['vehicle_details']->acc_on,
					"ac_flag" => $data['vehicle_details']->ac_flag,
					"lat" => $data['vehicle_details']->lat,
					"lng" => $data['vehicle_details']->lng,
					"angle" => $data['vehicle_details']->angle,
					"latlon_address" => $data['vehicle_details']->latlon_address,
					"today_km" => $today_km,
					"trip_kilometer" => $data['vehicle_details']->today_km,
					"batteryvolt" => $batteryvolt,
					"fuel_ltr" => $data['vehicle_details']->fuel_ltr,
					"driver_name" => 'N/A',
					"last_ign_off" => $data['vehicle_details']->last_ign_off,
					"last_ign_on" => $data['vehicle_details']->last_ign_on,
					"mileage" => $data['vehicle_details']->mileage,
					"distancetoEmpty" => 'N/A',
					"secondary_engine" => 'N/A',
					"battery_precentage" => $percentage,
					"hourmeter" => 'h:min',
					"rpm" => round($data['vehicle_details']->rpm_data),
					//"rpm"=>$data['vehicle_details']->rpm_data,
					"temperature" => $data['vehicle_details']->temperature,
					"safe_parking" => $data['vehicle_details']->safe_parking,
					"humidity" => 'N/A',
					"drum" => 'N/A',
					"bucket" => 'N/A',
					"gps" => $data['vehicle_details']->gps,
					"gsm" => $data['vehicle_details']->gsm,
					"altitude" => $data['vehicle_details']->altitude,
					"sattlite" => 'N/A'

				));



				if ($client_id == $ct_client_id) {
					//$data = array_merge($data['vehicle_details'],$data['vehicle_details1']);
					$this->response($data, REST_Controller::HTTP_OK);
				} else {

					$data1['status'] = 0;
					$data1['message'] = 'Please send Current User Token';
					$this->response($data1, REST_Controller::HTTP_OK);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function vehiclelist_get()
	{
		$headers = $this->input->request_headers();
		$status = $this->input->get('status');
		$valid_status = 1;
		if ($status == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'status is Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}

		if ($valid_status) {
			$result = $this->authorization_token->validateToken($headers['Authorization']);

			$start_date = $ct . ' 00:00:00';
			$end_date = $ct . ' 23:59:59';

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$data['allvehicle'] = $this->api_model->vehiclelist($client_id, $status);

				$this->response($data);
			} else {
				$this->response($result);
			}
		}
	}

	public function fuelvehicle_get()
	{
		$headers = $this->input->request_headers();
		$valid_status = 1;
		if ($headers == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'headers is Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$userid = $result['data']->userid;
				$roleid = $result['data']->roleid;
				$data['Fuelvehicles'] = $this->api_model->fuel_vehicle($client_id, $userid, $roleid);

				$this->response($data);
			} else {
				$this->response($result);
			}
		}
	}

	public function genric_parking_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$deviceimei = $this->input->post('deviceimei');
		$time = $this->input->post('time');

		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$timezone_hours = $result['data']->timezone_hours;
				// print_r($timezone_hours);die;
				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);

				if ($client_id == $vehicle_data['vehicle_details']->client_id) {
					$data['parking_report'] = $this->api_model->parking_report_list($from_date, $to_date, $deviceimei, $time, $timezone_hours);

					$this->response($data);
				} else {

					$data1['status'] = 0;
					$data1['message'] = 'Please send Current User Token';
					$this->response($data1);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function genric_idle_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$deviceimei = $this->input->post('deviceimei');
		$time = $this->input->post('time');

		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$timezone_hours = $result['data']->timezone_hours;
				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				if ($client_id == $vehicle_data['vehicle_details']->client_id) {
					$data['idle_report'] = $this->api_model->idle_report_list($from_date, $to_date, $deviceimei, $time, $timezone_hours);

					$this->response($data);
				} else {

					$data1['status'] = 0;
					$data1['message'] = 'Please send Current User Token';
					$this->response($data1);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function genric_trip_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$deviceimei = $this->input->post('deviceimei');
		$time = $this->input->post('time');

		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				// $data['status'] = 1;
				$client_id = $result['data']->client_id;
				$timezone_hours = $result['data']->timezone_hours;
				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				if ($client_id == $vehicle_data['vehicle_details']->client_id) {
					$data['ign_reports'] = $this->api_model->trip_report_list($from_date, $to_date, $deviceimei, $time, $timezone_hours);

					$this->response($data);
				} else {

					$data1['status'] = 0;
					$data1['message'] = 'Please send Current User Token';
					$this->response($data1);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function playback_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$deviceimei = $this->input->post('deviceimei');

		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$timezone_hours = $result['data']->timezone_hours;
				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				if ($client_id == $vehicle_data['vehicle_details']->client_id) {
					$data['vehicletype'] = $this->api_model->vehicletype_data_admin($deviceimei);
					$data['playback_data'] = $this->api_model->playback_data_admin($deviceimei, $from_date, $to_date, $client_id);


					$this->response($data);
				} else {

					$data1['status'] = 0;
					$data1['message'] = 'Please send Current User Token';
					$this->response($data1);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function smartreport_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$deviceimei = $this->input->post('deviceimei');

		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$timezone_hours =  $result['data']->timezone_hours;
				// print_r($timezone_hours);die;
				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				if ($client_id == $vehicle_data['vehicle_details']->client_id) {

					$fromtime = strtotime($from_date);
					$totime = strtotime($to_date);
					$from_date = date('Y-m-d', $fromtime);
					$to_date = date('Y-m-d', $totime);
					$fromd = $from_date;
					$tod = $to_date;
					$date1 = new DateTime($fromd);
					$date2 = new DateTime($tod);
					$interval = $date1->diff($date2);
					$diff_day =  $interval->days;
					$last_day = $diff_day;


					$vehicle_detail = $this->db->query("SELECT vehiclename,device_type,client_id FROM vehicletbl WHERE deviceimei=$deviceimei");
					$vehicle_info = $vehicle_detail->row();
					$vehiclename = $vehicle_info->vehiclename;
					$device_type = $vehicle_info->device_type;
					$client_id = $vehicle_info->client_id;

					$dt = $from_date;
					$day_data = array();

					$gfrom_date = date('Y-m-d H:i:s', $fromtime);
					$gfrom_date1 = $from_date . ' 00:00:00';
					for ($i = 0; $i < ($diff_day + 1); $i++) {
						//echo $i.'<br>'.$last_day;exit;
						if ($i == 0 && $last_day == $i) {

							$gfrom_date = date('Y-m-d H:i:s', $fromtime);
							$gto_date = date('Y-m-d H:i:s', $totime);

							$yesterday_distance[] = $this->api_model->smart_distanceday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
							$yesterday_park[] = $this->api_model->smart_parkday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
							$yesterday_idle[] = $this->api_model->smart_idleday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
							$yesterday_ign[] = $this->api_model->smart_ignday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
							//$yesterday_ac[] = $this->api_model->smart_acday_API($deviceimei,$gfrom_date,$gto_date,$device_type,$client_id,$timezone_hours);
							$yesterday_fill[] = $this->api_model->smart_fuelfill_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
							$yesterday_dip[] = $this->api_model->smart_fueldip_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
							$yesterday_consumed[] = $this->api_model->smart_fuelconsumed_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);

							$dd = $dt;
						} elseif ($i == 0 || $last_day == $i) {

							if ($i == 0) {

								$gfrom_date = date('Y-m-d H:i:s', $fromtime);
								$gfrom_date1 = strtotime($gfrom_date);
								$gfrom_date1 = date('Y-m-d', $gfrom_date1);
								$gto_date = $gfrom_date1 . ' 23:59:59';

								$yesterday_distance[] = $this->api_model->smart_distanceday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_park[] = $this->api_model->smart_parkday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_idle[] = $this->api_model->smart_idleday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_ign[] = $this->api_model->smart_ignday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								// $yesterday_ac[] = $this->api_model->smart_acday_API($devicei3mei,$gfrom_date,$gto_date,$device_type,$client_id,$timezone_hours);
								$yesterday_fill[] = $this->api_model->smart_fuelfill_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_dip[] = $this->api_model->smart_fueldip_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_consumed[] = $this->api_model->smart_fuelconsumed_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);


								$dd = $dt;
							} elseif ($i == $last_day) {

								$gto_date = date('Y-m-d H:i:s', $totime);
								$gfrom_date = date('Y-m-d', $totime);
								$gfrom_date = $gfrom_date . ' 00:00:00';


								$yesterday_distance[] = $this->api_model->smart_distanceday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_park[] = $this->api_model->smart_parkday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_idle[] = $this->api_model->smart_idleday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_ign[] = $this->api_model->smart_ignday_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								//$yesterday_ac[] = $this->api_model->smart_acday_API($deviceimei,$gfrom_date,$gto_date,$device_type,$client_id,$timezone_hours);
								$yesterday_fill[] = $this->api_model->smart_fuelfill_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_dip[] = $this->api_model->smart_fueldip_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
								$yesterday_consumed[] = $this->api_model->smart_fuelconsumed_API($deviceimei, $gfrom_date, $gto_date, $device_type, $client_id, $timezone_hours);
							}
						} else {
							$dd = date('Y-m-d', strtotime("+1 days", strtotime($dt)));
							$all_day[] = $dd;
							$dt = $dd;
						}
					}

					//  print_r($all_day);exit;


					$all_count = count($all_day);
					$start_date = $all_day[0];
					$end_date = $all_day[$all_count - 1];
					$yesterday_distance[] = $this->api_model->consolidate_distanceday($deviceimei, $start_date, $end_date, $client_id);
					$yesterday_park[] = $this->api_model->consolidate_parkday($deviceimei, $start_date, $end_date, $client_id);
					// print_r($yesterday_park);die;
					$yesterday_idle[] = $this->api_model->consolidate_idleday($deviceimei, $start_date, $end_date, $client_id);
					$yesterday_ign[] = $this->api_model->consolidate_ignday($deviceimei, $start_date, $end_date, $client_id);
					$yesterday_ac[] = $this->api_model->consolidate_acday($deviceimei, $start_date, $end_date, $client_id);
					$yesterday_fill[] = $this->api_model->consolidate_fuelfill($deviceimei, $start_date, $end_date, $client_id);
					$yesterday_dip[] = $this->api_model->consolidate_fueldip($deviceimei, $start_date, $end_date, $client_id);
					$yesterday_consumed[] = $this->api_model->consolidate_fuelconsumed($deviceimei, $start_date, $end_date, $client_id);



					$total_parking = 0;
					$park_count = count($yesterday_park) - 1;
					// print_r($park_count);die;
					foreach ($yesterday_park as $plist) {

						$total_parking += $plist->parking_duration;
						$park_count += $plist->totalcount;
					}
					$idle_count = count($yesterday_idle) - 1;
					foreach ($yesterday_idle as $idlist) {

						$total_idle += $idlist->idel_duration;
						$idle_count += $idlist->totalcount;
					}
					$running_count = count($yesterday_ign) - 1;
					foreach ($yesterday_ign as $iglist) {

						$total_running += $iglist->moving_duration;
						$running_count += $iglist->totalcount;
					}

					$ac_count = count($yesterday_ac) - 1;
					//	print_r($yesterday_ac);exit;
					foreach ($yesterday_ac as $iglist) {

						$total_ac += $iglist->moving_duration;
						$ac_count += $iglist->totalcount;
					}


					$consume_count = count($yesterday_consumed) - 1;
					foreach ($yesterday_consumed as $fclist) {

						$total_fuel_consume += $fclist->fuel_consumed_litre;

						$totalmilege += $fclist->fuel_milege;
						$consume_count += $fclist->totalcount;
					}
					$avg_fuel_consume = $total_fuel_consume / $consume_count;


					foreach ($yesterday_fill as $fllist) {

						$total_fuel_fill += $fllist->fuel_fill_litre;
					}

					foreach ($yesterday_dip as $fdlist) {

						$total_fuel_dip += $fdlist->fuel_dip_litre;
					}
					if ($device_type == 17) {


						$curl = curl_init();
						curl_setopt_array($curl, array(
							CURLOPT_URL => 'https://sproutwings.asymbix.net/auth/login?jwt=1',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => '{"login":"sproutwings_wl","password":"7Qx4x6uIJT"}',
							CURLOPT_HTTPHEADER => array(
								'Content-Type: application/json'
							),
						));
						curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

						$jwt_token = curl_exec($curl);
						$jwt_token = json_decode($jwt_token);

						$jwt = 'JWT ' . $jwt_token->jwt;
						//echo $jwt_token->jwt;exit;
						curl_close($curl);

						$dd = $from_date;
						$startdate = $dd . " 00:00:00";
						$startdate = strtotime($startdate);
						'<br>';
						$enddate = $dd . " 23:59:59";
						$enddate = strtotime($enddate);
						// echo '<br>';
						$url = "https://sproutwings.asymbix.net/ls/api/v1/reports/statistics?versionNumber=1&vehicleID=$vehicle_data[0]&timeBegin=$fromtime&timeEnd=$totime&dataGroups=[mw,fuel]&vehicles=[$vehicle_data[0]]";
						//echo $url;exit;

						$curl = curl_init();
						//print_r($curl);
						curl_setopt_array($curl, array(
							CURLOPT_URL => $url,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
							CURLOPT_HTTPHEADER => array(
								'Authorization:' . $jwt
							),
						));
						//Disable CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER by
						//setting them to false.
						curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

						$response = curl_exec($curl);
						$response = json_decode($response);
						//		print_r($response->data->totalMw);

						$normal_rpm = $response->data->totalMw->totalWorkedOnNormalRPM;
						$idle_rpm = $response->data->totalMw->totalWorkedOnIdlingRPM;
						$under_load = $response->data->totalMw->totalWorkedOnExcessRPM;
						$milege = $response->data->totalMw->totalMileage;
					}

					if ($device_type == 17) {
						$total_kilometer = $milege;
						$avg_kilometer = $total_kilometer / ($diff_day + 1);
					} else {
						$total_kilometer = 0;
						$dis_count = count($yesterday_distance) - 1;
						foreach ($yesterday_distance as $dlist) {
							$total_kilometer += $dlist->distance_km;
							$dis_count += $dlist->totalcount;
						}
						$avg_kilometer = $total_kilometer / $dis_count;
					}


					$park_duration = $total_parking; //Parking Duration
					$hours = floor($park_duration / 60);
					$min = $park_duration - ($hours * 60);
					$min = floor((($min -   floor($min / 60) * 60)) / 6);
					$second = $park_duration % 60;
					$tot_park = $hours . ":" . $min . ":" . $second;
					$parts = explode(':', $tot_park);
					$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
					$park_period = $secs / ($park_count * 864) . '%';


					$idle_duration = $total_idle;       // Idle Duration
					$hours = floor($idle_duration / 60);
					$min = $idle_duration - ($hours * 60);
					$min = floor((($min -   floor($min / 60) * 60)) / 6);
					$second = $idle_duration % 60;
					$tot_idle = $hours . ":" . $min . ":" . $second;
					$tot_idle1 = $hours . "." . $min;
					$parts = explode(':', $tot_idle);
					$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
					$idle_period = $secs / ($idle_count * 864) . '%';

					$running_duration = $total_running; //Running Duration
					$hours = floor($running_duration / 60);
					$min = $running_duration - ($hours * 60);
					$min = floor((($min -   floor($min / 60) * 60)) / 6);
					$second = $running_duration % 60;
					$tot_move = $hours . ":" . $min . ":" . $second;
					$tot_move1 = $hours . "." . $min;
					$parts = explode(':', $tot_move);
					$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
					$running_period = $secs / ($running_count * 864) . '%';

					$ac_duration = $total_ac; //AC Duration
					$hours = floor($ac_duration / 60);
					$min = $ac_duration - ($hours * 60);
					$min = floor((($min -   floor($min / 60) * 60)) / 6);
					$second = $ac_duration % 60;
					$tot_ac = $hours . ":" . $min . ":" . $second;
					$tot_ac1 = $hours . "." . $min;
					$parts = explode(':', $tot_ac);
					$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
					$ac_period = $secs / ($ac_count * 864) . '%';


					$normal_duration = $normal_rpm; //Normal RPM Duration
					$hours = floor($normal_duration / 3600);
					$min = ($normal_duration / 60) % 60;
					$second = $normal_duration % 60;
					$tot_normalrpm = $hours . ":" . $min . ":" . $second;
					$tot_normalrpm1 = $hours . "." . $min;
					$parts = explode(':', $tot_normalrpm);
					$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
					$normalrpm_period = $secs / ($normalrpm_count * 864) . '%';

					$load_duration = $under_load; //Load RPM Duration
					$hours = floor($load_duration / 3600);
					$min = ($load_duration / 60) % 60;
					$second = $load_duration % 60;
					$tot_loadrpm = $hours . ":" . $min . ":" . $second;
					$tot_loadrpm1 = $hours . "." . $min;
					$parts = explode(':', $tot_loadrpm);
					$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
					$loadrpm_period = $secs / ($loadrpm_count * 864) . '%';

					$idle_duration = $idle_rpm; //Load RPM Duration
					$hours = floor($idle_duration / 3600);
					$min = ($idle_duration / 60) % 60;
					$second = $idle_duration % 60;
					$tot_idlerpm = $hours . ":" . $min . ":" . $second;
					$tot_idlerpm1 = $hours . "." . $min;
					$parts = explode(':', $tot_idlerpm);
					$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];

					$totalrpm_duration = $normal_duration + $load_duration + $idle_duration; //Total RPM Duration
					$hours = floor($totalrpm_duration / 3600);
					$min = ($totalrpm_duration / 60) % 60;
					$min1 = round($min / 60, 1) * 10;
					$second = $totalrpm_duration % 60;
					$tot_rpm = $hours . ":" . $min . ":" . $second;
					$tot_hrpm =  $hours + round($min / 60, 1);


					$avg_running_duration = ($total_running / $running_count); //Average Running Duration
					$hours = floor($avg_running_duration / 60);
					$min = $avg_running_duration - ($hours * 60);
					$min = floor((($min -   floor($min / 60) * 60)) / 6);
					$second = $avg_running_duration % 60;
					$tot_move_avg = $hours . ":" . $min . ":" . $second;

					$avg_moving_fl_cunsume = ($total_fuel_consume / $tot_move1) / $consume_count;
					$moving_fl_cunsume = ($total_fuel_consume / $tot_move1);
					$not_moving_fl_cunsume = ($total_fuel_consume / $tot_idle1);



					$data['smart_report'] = array(
						'totalKilometer' => round((int)$total_kilometer, 1),
						'avgDailykm' => round((int)$avg_kilometer, 1),
						'runningTimeHMS' => $tot_move,
						'runningTime' => round((int)$running_period, 1),
						'avgDailyRunning' => $tot_move_avg,
						// 'actime'=>$tot_ac,
						// 'acTimeReport'=>round((int)$ac_period,1),
						'vehicleOprIdle' => $tot_idle,
						'vehicleOprIdleEngineOpr' => round((int)$idle_period, 1),
						'vehicleOff' => $tot_park,
						'vehicleOffReport' => round((int)$park_period, 1),
						// 'totalEnginerpm'=>$tot_rpm,
						// 'engOprNormalRpm'=>$tot_normalrpm,
						// 'engOprMaximumRpm'=>$tot_loadrpm,
						// 'engOprIdle'=>$tot_idlerpm,
						'totalActualFuelCon' => $total_fuel_consume,
						'avgDailyFuelCon' => round((int)$avg_fuel_consume, 1),
						'refuelingVol' => $total_fuel_fill,
						'drainingVolume' => $total_fuel_dip,
						'avgActualMil' => $totalmilege,
						'avgActualMilWhenVehicleMoving' => round((int)$avg_moving_fl_cunsume, 1),
						'totalActualFuelConwhenVehicleMoving' => round((int)$moving_fl_cunsume, 1),
						'totalActualFuelConWhenVehicleNotMov' => round((int)$not_moving_fl_cunsume, 1)

						// 'totActualFuelConTimeEngOpr'=>0,
						// 'ActualAvgFuelConperHour'=>0,
						// 'avgDailyActualFuelConperHour'=>0,
						// 'totActualConTimeEngOperInMotion'=>0,
						// 'totActualConTimeEngOperInNormalRPM'=>0,
						// 'totActualConTimeEngOperInMaxRPM'=>0,
						// 'totActualConTimeEngOperunderLoad'=>0,
						// 'bucketMovTime'=>0,
						// 'bucketMovTimereportPeriod'=>0,
						// 'bucketAvgDailyMov'=>0,
						// 'bucketMovIdle'=>0,
						// 'bucketMovIdleEngOpr'=>0,
						// 'drumMovTimeload'=>0,
						// 'drumMovTimeReportPeriod'=>0,
						// 'AvgDailyDrumMov'=>0,
						// 'DrumMovtimewithoutLoad'=>0,
						// 'AvgDailymovwithoutLoad'=>0,
						// 'DrumnonMovTime'=>0,
						// 'DrumnonMovReport'=>0,
						// 'avgTemparature'=>0,

						// 'DrumMovmenttimereportPeriod'=>0,
						// 'highTemparature'=>0,
						// 'lowTemparature'=>0,
						// 'AvgTemVehicleIdle'=>0,
						// 'HighTemVehicleIdle'=>0,
						// 'LowTemVehicleIdle'=>0,
						// 'AvgTemVehicleRunning'=>0,
						// 'highTemparatureVehicleRunning'=>0,
						// 'lowTemVehicleRunning'=>0,
						// 'highTemVehicleoff'=>0,
						// 'lowTemVehicleoff'=>0,
						// 'avgTemparature2'=>0,
						// 'highTemparature2'=>0,
						// 'lowTemparature2'=>0,
						// 'AvgTemVehicleIdle2'=>0,
						// 'HighTemVehicleIdle2'=>0,
						// 'LowTemVehicleIdle2'=>0,
						// 'AvgTemVehicleRunning2'=>0,
						// 'highTemVehicleRunning2'=>0,
						// 'lowTemVehicleRunning2'=>0,

						// 'highTemVehicleoff2'=>0,
						// 'lowTemVehicleoff2'=>0,
						// 'totalOdometer'=>0,
						// 'engineHours'=>0,
						// 'FuelCon'=>0,
						// 'avgEngineLoad'=>0,
						// 'avgCoolTemp'=>0
					);


					$this->response($data);
				}
			} else {

				$data1['status'] = 0;
				$data1['message'] = 'Please send Current User Token';
				$this->response($data1);
			}
		} else {
			$this->response($result);
		}
	}

	public function smartreportchk_get()
	{
		$headers = $this->input->request_headers();
		$userid = $this->input->get('userid');
		$valid_status = 1;
		if ($userid == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'userid is Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$userid = $result['data']->userid;
				$data['checkbox_list'] = array($this->api_model->smartreportchk_details($userid));


				if ($userid == $data['checkbox_list'][0]->user_id) {

					$this->response($data, REST_Controller::HTTP_OK);
				} else {
					$data1['user_id'] = $userid;
					$this->db->insert('smart_report_chk', $data1);

					$data['checkbox_list'] = array($this->api_model->smartreportchk_details($userid));

					// $data1['status'] = 0;
					// $data1['message'] ='Please send Current User Token';
					$this->response($data, REST_Controller::HTTP_OK);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function smartreportchkupdate_post()
	{
		$headers = $this->input->request_headers();
		$userid = $this->input->get('userid');
		$valid_status = 1;
		if ($userid == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'userid is Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {

				$smart_data = $this->api_model->smartreportchk_details($userid);
				// print_r($smart_data);die;
				$smartid = $smart_data->id;
				$user_id = $smart_data->user_id;
				$client_id = $smart_data->client_id;


				$data = array(
					'totalKilometer' => $this->input->post('totalKilometer'),
					'avgDailykm' => $this->input->post('avgDailykm'),
					'runningTimeHMS' => $this->input->post('runningTimeHMS'),
					'runningTime' => $this->input->post('runningTime'),
					'avgDailyRunning' => $this->input->post('avgDailyRunning'),
					'actime' => $this->input->post('actime'),
					'acTimeReport' => $this->input->post('acTimeReport'),
					'vehicleOprIdle' => $this->input->post('vehicleOprIdle'),
					'vehicleOprIdleEngineOpr' => $this->input->post('vehicleOprIdleEngineOpr'),
					'vehicleOff' => $this->input->post('vehicleOff'),
					'vehicleOffReport' => $this->input->post('vehicleOffReport'),
					'totalEnginerpm' => $this->input->post('totalEnginerpm'),
					'engOprNormalRpm' => $this->input->post('engOprNormalRpm'),
					'engOprMaximumRpm' => $this->input->post('engOprMaximumRpm'),
					'engOprIdle' => $this->input->post('engOprIdle'),
					'totalActualFuelCon' => $this->input->post('totalActualFuelCon'),
					'avgDailyFuelCon' => $this->input->post('avgDailyFuelCon'),
					'refuelingVol' => $this->input->post('refuelingVol'),
					'drainingVolume' => $this->input->post('drainingVolume'),
					'avgActualMil' => $this->input->post('avgActualMil'),
					'avgActualMilWhenVehicleMoving' => $this->input->post('avgActualMilWhenVehicleMoving'),
					'totalActualFuelConwhenVehicleMoving' => $this->input->post('totalActualFuelConwhenVehicleMoving'),
					'totalActualFuelConWhenVehicleNotMov' => $this->input->post('totalActualFuelConWhenVehicleNotMov'),
					'totActualFuelConTimeEngOpr' => $this->input->post('totActualFuelConTimeEngOpr'),
					'ActualAvgFuelConperHour' => $this->input->post('ActualAvgFuelConperHour'),
					'avgDailyActualFuelConperHour' => $this->input->post('avgDailyActualFuelConperHour'),
					'totActualConTimeEngOperInMotion' => $this->input->post('totActualConTimeEngOperInMotion'),
					'totActualConTimeEngOperInNormalRPM' => $this->input->post('totActualConTimeEngOperInNormalRPM'),
					'totActualConTimeEngOperInMaxRPM' => $this->input->post('totActualConTimeEngOperInMaxRPM'),
					'totActualConTimeEngOperunderLoad' => $this->input->post('totActualConTimeEngOperunderLoad'),
					'bucketMovTime' => $this->input->post('bucketMovTime'),
					'bucketMovTimereportPeriod' => $this->input->post('bucketMovTimereportPeriod'),
					'bucketAvgDailyMov' => $this->input->post('bucketAvgDailyMov'),
					'bucketMovIdle' => $this->input->post('bucketMovIdle'),
					'bucketMovIdleEngOpr' => $this->input->post('bucketMovIdleEngOpr'),
					'drumMovTimeload' => $this->input->post('drumMovTimeload'),
					'drumMovTimeReportPeriod' => $this->input->post('drumMovTimeReportPeriod'),
					'AvgDailyDrumMov' => $this->input->post('AvgDailyDrumMov'),
					'DrumMovtimewithoutLoad' => $this->input->post('DrumMovtimewithoutLoad'),
					'DrumMovmenttimereportPeriod' => $this->input->post('DrumMovmenttimereportPeriod'),
					'AvgDailymovwithoutLoad' => $this->input->post('AvgDailymovwithoutLoad'),
					'DrumnonMovTime' => $this->input->post('DrumnonMovTime'),
					'DrumnonMovReport' => $this->input->post('DrumnonMovReport'),
					'avgTemparature' => $this->input->post('avgTemparature'),
					'highTemparature' => $this->input->post('highTemparature'),
					'lowTemparature' => $this->input->post('lowTemparature'),
					'AvgTemVehicleIdle' => $this->input->post('AvgTemVehicleIdle'),
					'HighTemVehicleIdle' => $this->input->post('HighTemVehicleIdle'),
					'LowTemVehicleIdle' => $this->input->post('LowTemVehicleIdle'),
					'AvgTemVehicleRunning' => $this->input->post('AvgTemVehicleRunning'),
					'highTemparatureVehicleRunning' => $this->input->post('highTemparatureVehicleRunning'),
					'lowTemVehicleRunning' => $this->input->post('lowTemVehicleRunning'),
					'highTemVehicleoff' => $this->input->post('highTemVehicleoff'),
					'lowTemVehicleoff' => $this->input->post('lowTemVehicleoff'),
					'avgTemparature2' => $this->input->post('avgTemparature2'),
					'highTemparature2' => $this->input->post('highTemparature2'),
					'lowTemparature2' => $this->input->post('lowTemparature2'),
					'AvgTemVehicleIdle2' => $this->input->post('AvgTemVehicleIdle2'),
					'HighTemVehicleIdle2' => $this->input->post('HighTemVehicleIdle2'),
					'LowTemVehicleIdle2' => $this->input->post('LowTemVehicleIdle2'),
					'AvgTemVehicleRunning2' => $this->input->post('AvgTemVehicleRunning2'),
					'highTemVehicleRunning2' => $this->input->post('highTemVehicleRunning2'),
					'lowTemVehicleRunning2' => $this->input->post('lowTemVehicleRunning2'),
					'highTemVehicleoff2' => $this->input->post('highTemVehicleoff2'),
					'lowTemVehicleoff2' => $this->input->post('lowTemVehicleoff2'),
					'totalOdometer' => $this->input->post('totalOdometer'),
					'engineHours' => $this->input->post('engineHours'),
					'FuelCon' => $this->input->post('FuelCon'),
					'avgEngineLoad' => $this->input->post('avgEngineLoad'),
					'avgCoolTemp' => $this->input->post('avgCoolTemp')
				);


				if ($smartid == '') {
					$data['user_id'] = $userid;
					$this->db->insert('smart_report_chk', $data);
					$data1['status'] = 1;
					$data1['message'] = 'Data Insert Successfully';
					$this->response($data1, REST_Controller::HTTP_OK);
				} else {

					$this->db->where('id', $smartid);
					$this->db->where('user_id', $userid);
					// $this->db->where('client_id', $client_id);
					$this->db->update('smart_report_chk', $data);

					$data1['status'] = 1;
					$data1['message'] = 'Data Update Successfully';
					$this->response($data1, REST_Controller::HTTP_OK);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function executivereport_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$deviceimei = $this->input->post('deviceimei');

		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);

			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				if ($client_id == $vehicle_data['vehicle_details']->client_id) {

					$fromtime = strtotime($from_date);
					$totime = strtotime($to_date);
					$from_date = date('Y-m-d', $fromtime);
					$to_date = date('Y-m-d', $totime);
					$fromd = $from_date;
					$tod = $to_date;
					$date1 = new DateTime($fromd);
					$date2 = new DateTime($tod);
					$interval = $date1->diff($date2);

					$diff_day =  $interval->days;

					$vehicle_detail = $this->db->query("SELECT vehiclename,device_type,client_id FROM vehicletbl WHERE deviceimei='" . $deviceimei . "'");
					$vehicle_info = $vehicle_detail->row();
					$vehiclename = $vehicle_info->vehiclename;
					$device_type = $vehicle_info->device_type;
					$client_id = $vehicle_info->client_id;


					$dt = $from_date;

					$day_data = array();

					for ($i = 0; $i < ($diff_day + 1); $i++) {
						if ($i == 0) {
							$dd = $dt;
						} else {
							$dd = date('Y-m-d', strtotime("+1 days", strtotime($dt)));
						}


						$yesterday_distance = $this->api_model->exe_consolidate_distanceday($deviceimei, $dd, $device_type, $client_id);
						$yesterday_park = $this->api_model->exe_consolidate_parkday($deviceimei, $dd, $client_id);
						//print_r($yesterday_park);die;
						$yesterday_idle = $this->api_model->exe_consolidate_idleday($deviceimei, $dd, $client_id);
						$yesterday_ign = $this->api_model->exe_consolidate_ignday($deviceimei, $dd, $client_id);
						$yesterday_ac = $this->api_model->exe_consolidate_acday($deviceimei, $dd, $client_id);
						$yesterday_fill = $this->api_model->exe_consolidate_fuelfill($deviceimei, $dd, $client_id);
						$yesterday_dip = $this->api_model->exe_consolidate_fueldip($deviceimei, $dd, $client_id);
						$yesterday_consumed = $this->api_model->exe_consolidate_fuelconsumed($deviceimei, $dd, $client_id);

						$all_rpm = $this->api_model->exe_consolidate_allrpmday($deviceimei, $dd, $client_id);

						$park_duration = $yesterday_park; //Parking Duration
						$hours = floor($park_duration / 60);
						$min = $park_duration - ($hours * 60);
						$second = $park_duration % 60;
						$tot_park = $hours . ":" . $min . ":" . $second;
						$parts = explode(':', $tot_park);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$park_period = $secs / 864 . '%';

						$running_duration = $yesterday_ign; //Running Duration
						$hours = floor($running_duration / 60);
						$min = $running_duration - ($hours * 60);
						$second = $running_duration % 60;
						$tot_move = $hours . ":" . $min . ":" . $second;
						$tot_move1 = $hours . "." . $min;
						$parts = explode(':', $tot_move);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$running_period = $secs / 864 . '%';



						$idle_duration = $yesterday_idle;       // Idle Duration
						$hours = floor($idle_duration / 60);
						$min = $idle_duration - ($hours * 60);
						$second = $idle_duration % 60;
						$tot_idle = $hours . ":" . $min . ":" . $second;
						$parts = explode(':', $tot_idle);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$idle_period = $secs / 864 . '%';

						$ac_duration = $yesterday_ac;       // Ac Duration
						$hours = floor($ac_duration / 60);
						$min = $ac_duration - ($hours * 60);
						$second = $ac_duration % 60;
						$tot_ac = $hours . ":" . $min . ":" . $second;
						$parts = explode(':', $tot_ac);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$ac_period = $secs / 864 . '%';

						$normal_rpm_duration = $all_rpm->normal_rpm; //Normal RPM Duration
						$hours = floor($normal_rpm_duration / 3600);
						$min = ($normal_rpm_duration / 60) % 60;
						$second = $normal_rpm_duration % 60;
						$tot_normalrpm = $hours . ":" . $min . ":" . $second;
						$parts = explode(':', $tot_normalrpm);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$normalrpm_period = $secs / 864 . '%';


						$load_rpm_duration = $all_rpm->under_load; //Load RPM Duration
						$hours = floor($load_rpm_duration / 3600);
						$min = ($load_rpm_duration / 60) % 60;
						$second = $load_rpm_duration % 60;
						$tot_loadrpm = $hours . ":" . $min . ":" . $second;
						$parts = explode(':', $tot_loadrpm);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$loadrpm_period = $secs / 864 . '%';


						$idlerpm_duration = $all_rpm->idle_rpm; //IDLE RPM Duration
						$hours = floor($idlerpm_duration / 3600);
						$min = ($idlerpm_duration / 60) % 60;
						$second = $idlerpm_duration % 60;
						$tot_idlerpm = $hours . ":" . $min . ":" . $second;
						$parts = explode(':', $tot_idlerpm);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$idlerpm_period = $secs / 864 . '%';


						$total_rpm_duration = $normal_rpm_duration + $load_rpm_duration + $idlerpm_duration; //Total RPM Duration

						$hours = floor($total_rpm_duration / 3600);
						$min = ($total_rpm_duration / 60) % 60;
						$hmin = $min / 10;
						$mins = '0.' . $min;
						$hoursdata = $mins * 100 / 60;
						$min1 = ($hmin) * (100 / 60);
						//  $tot_hrpm =  $hours + round($min / 60, 1);
						$second = $total_rpm_duration % 60;
						$tot_rpm1 = $hours . "." . $min;
						$tot_hrpm =  round($tot_rpm1 - $hoursdata, 1);
						$tot_rpm = $hours . ":" . $min . ":" . $second;
						$parts = explode(':', $tot_rpm);
						$tot_rpm = $hours . "hh:" . $min . "mm:" . $second . "ss";
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$tot_rpm_period = $secs / 864 . '%';

						$fuel_millege = round(($yesterday_consumed->fuel_millege), 2);

						$ct = date('Y-m-d');
						if ($dd == $ct) {


							$fuel_consume = $yesterday_fill->start_fuel + $yesterday_fill->fuel_fill_litre - $yesterday_fill->end_fuel;
						} else {
							$fuel_consume = $yesterday_consumed->fuel_consumed_litre;
						}



						$day_data[$dd] = array(
							'mileagekm' => round($yesterday_distance->distance_km, 1),
							'startodometer' => $yesterday_distance->start_odometer,
							'endodometer' => $yesterday_distance->end_odometer,
							'startenginehrmeter' => 0,
							'endenginehrmeter' => 0,
							'overspeedmileagekm' => 0,
							'avgspeedrunning' => 0,
							'maxspeedkm' => 0,
							'runningtime' => $tot_move,
							'runningtime_percentagerpt' => round($running_period, 1),
							'idletime_hhmmss' => $tot_idle,
							'idletime_percentagerpt' => round($idle_period, 1),
							'parkingtime_hhmmss' => $tot_park,
							'parkingtime_percentage' => round($park_period, 1),
							'actime_hhmmss' => $tot_ac,
							'actime_percentage' => round($ac_period, 1),
							'rpm_opr_time_hhmmss' => $tot_rpm,
							'rpm_opr_time_percentage' => round($tot_rpm_period, 1),
							'rpm_opt_normal_hhmmss' => $tot_normalrpm,
							'rpm_opt_normal_percentage' => round($normalrpm_period, 1),
							'rpm_opt_max_hhmmss' => $tot_loadrpm,
							'rpm_opt_max_percentage' => round($loadrpm_period, 1),
							'rpm_opr_hhmmss' => $tot_idlerpm,
							'rpm_engine_opr_percentage' => round($idlerpm_period, 1),
							'fuelconsumption_engine_hour' => 0,
							'fuel_start_vol' => $yesterday_fill->start_fuel,
							'fuel_final_vol' => $yesterday_fill->end_fuel,
							'fuel_refueling_vol' => $yesterday_fill->fuel_fill_litre,
							'fuel_draining_vol' => $yesterday_dip->fuel_dip_litre,
							'fuel_actual_fuel_cons' => $fuel_consume,
							'fuel_mileage_km' => $fuel_millege,

							'fuel_mileage_vehicle_running_km' => 0,
							'fuel_fuelconsumption_vehicle_running' => 0,
							'fuel_fuelconsumption_vehicle_idle' => 0,

							'bucket_move_time_hhmmss' => 0,
							'bucket_move_time_percentage' => 0,
							'bucket_idle_time_hhmmss' => 0,
							'bucket_idle_time_percentage' => 0,
							'drumnonmvt_time_with_hhmmss' => 0,
							'drumnonmvt_time_with_percentage' => 0,
							'drumnonmvt_time_withoutload_hhmmss' => 0,
							'drumnonmvt_time_withoutload_per' => 0,
							'drumnonmvt_time_hhmmss' => 0,
							'drumnonmvt_time_percentage' => 0,
							'reading_can_odomtr_start' => 0,
							'reading_can_odomtr_end' => 0,
							'fuelconsumptionmeter' => 0,
							'nbsp_sec' => 0,
							'enginehours_hhmmss' => 0,
							'fuelconsumption1' => 0
						);
						$dt = $dd;

						// print_r($day_data);exit;
					}

					$consolidate_data['status'] = 1;
					$consolidate_data['executive_report'] = $day_data;
					$this->response($consolidate_data);
				}
			} else {

				$data1['status'] = 0;
				$data1['message'] = 'Please send Current User Token';
				$this->response($data1);
			}
		} else {
			$this->response($result);
		}
	}

	public function exereportchk_get()
	{
		$headers = $this->input->request_headers();
		$userid = $this->input->get('userid');
		$valid_status = 1;
		if ($userid == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'userid is Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$userid = $result['data']->userid;
				$data['checkbox_list'] = array($this->api_model->exereportchk_details($userid));

				if ($userid == $data['checkbox_list'][0]->user_id) {

					$this->response($data, REST_Controller::HTTP_OK);
				} else {

					$data1['status'] = 0;
					$data1['message'] = 'Please send Current User Token';
					$this->response($data1, REST_Controller::HTTP_OK);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function exereportchkupdate_post()
	{
		$headers = $this->input->request_headers();
		$userid = $this->input->get('userid');
		$valid_status = 1;
		if ($userid == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'userid is Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}

		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {

				if ($this->input->post('mileagekm') == 1) {
					$mileagekm = 1;
				} else {
					$mileagekm = 0;
				}
				if ($this->input->post('startodometer') == 1) {
					$startodometer = 1;
				} else {
					$startodometer = 0;
				}
				if ($this->input->post('endodometer') == 1) {
					$endodometer = 1;
				} else {
					$endodometer = 0;
				}
				if ($this->input->post('startenginehrmeter') == 1) {
					$startenginehrmeter = 1;
				} else {
					$startenginehrmeter = 0;
				}
				if ($this->input->post('endenginehrmeter') == 1) {
					$endenginehrmeter = 1;
				} else {
					$endenginehrmeter = 0;
				}
				if ($this->input->post('overspeedmileagekm') == 1) {
					$overspeedmileagekm = 1;
				} else {
					$overspeedmileagekm = 0;
				}
				if ($this->input->post('avgspeedrunning') == 1) {
					$avgspeedrunning = 1;
				} else {
					$avgspeedrunning = 0;
				}
				if ($this->input->post('maxspeedkm') == 1) {
					$maxspeedkm = 1;
				} else {
					$maxspeedkm = 0;
				}
				if ($this->input->post('runningtime') == 1) {
					$runningtime = 1;
				} else {
					$runningtime = 0;
				}
				if ($this->input->post('runningtime_percentagerpt') == 1) {
					$runningtime_percentagerpt = 1;
				} else {
					$runningtime_percentagerpt = 0;
				}
				if ($this->input->post('idletime_hhmmss') == 1) {
					$idletime_hhmmss = 1;
				} else {
					$idletime_hhmmss = 0;
				}
				if ($this->input->post('idletime_percentagerpt') == 1) {
					$idletime_percentagerpt = 1;
				} else {
					$idletime_percentagerpt = 0;
				}
				if ($this->input->post('parkingtime_hhmmss') == 1) {
					$parkingtime_hhmmss = 1;
				} else {
					$parkingtime_hhmmss = 0;
				}
				if ($this->input->post('parkingtime_percentage') == 1) {
					$parkingtime_percentage = 1;
				} else {
					$parkingtime_percentage = 0;
				}
				if ($this->input->post('actime_hhmmss') == 1) {
					$actime_hhmmss = 1;
				} else {
					$actime_hhmmss = 0;
				}
				if ($this->input->post('actime_percentage') == 1) {
					$actime_percentage = 1;
				} else {
					$actime_percentage = 0;
				}
				if ($this->input->post('rpm_opr_time_hhmmss') == 1) {
					$rpm_opr_time_hhmmss = 1;
				} else {
					$rpm_opr_time_hhmmss = 0;
				}
				if ($this->input->post('rpm_opr_time_percentage') == 1) {
					$rpm_opr_time_percentage = 1;
				} else {
					$rpm_opr_time_percentage = 0;
				}
				if ($this->input->post('rpm_opt_normal_hhmmss') == 1) {
					$rpm_opt_normal_hhmmss = 1;
				} else {
					$rpm_opt_normal_hhmmss = 0;
				}
				if ($this->input->post('rpm_opt_normal_percentage') == 1) {
					$rpm_opt_normal_percentage = 1;
				} else {
					$rpm_opt_normal_percentage = 0;
				}
				if ($this->input->post('rpm_opt_max_hhmmss') == 1) {
					$rpm_opt_max_hhmmss = 1;
				} else {
					$rpm_opt_max_hhmmss = 0;
				}
				if ($this->input->post('rpm_opt_max_percentage') == 1) {
					$rpm_opt_max_percentage = 1;
				} else {
					$rpm_opt_max_percentage = 0;
				}
				if ($this->input->post('rpm_opr_hhmmss') == 1) {
					$rpm_opr_hhmmss = 1;
				} else {
					$rpm_opr_hhmmss = 0;
				}
				if ($this->input->post('rpm_engine_opr_percentage') == 1) {
					$rpm_engine_opr_percentage = 1;
				} else {
					$rpm_engine_opr_percentage = 0;
				}
				if ($this->input->post('fuel_start_vol') == 1) {
					$fuel_start_vol = 1;
				} else {
					$fuel_start_vol = 0;
				}
				if ($this->input->post('fuel_final_vol') == 1) {
					$fuel_final_vol = 1;
				} else {
					$fuel_final_vol = 0;
				}
				if ($this->input->post('fuel_actual_fuel_cons') == 1) {
					$fuel_actual_fuel_cons = 1;
				} else {
					$fuel_actual_fuel_cons = 0;
				}
				if ($this->input->post('fuel_refueling_vol') == 1) {
					$fuel_refueling_vol = 1;
				} else {
					$fuel_refueling_vol = 0;
				}
				if ($this->input->post('fuel_draining_vol') == 1) {
					$fuel_draining_vol = 1;
				} else {
					$fuel_draining_vol = 0;
				}
				if ($this->input->post('fuel_mileage_km') == 1) {
					$fuel_mileage_km = 1;
				} else {
					$fuel_mileage_km = 0;
				}
				if ($this->input->post('fuel_mileage_vehicle_running_km') == 1) {
					$fuel_mileage_vehicle_running_km = 1;
				} else {
					$fuel_mileage_vehicle_running_km = 0;
				}
				if ($this->input->post('fuel_fuelconsumption_vehicle_running') == 1) {
					$fuel_fuelconsumption_vehicle_running = 1;
				} else {
					$fuel_fuelconsumption_vehicle_running = 0;
				}
				if ($this->input->post('fuel_fuelconsumption_vehicle_idle') == 1) {
					$fuel_fuelconsumption_vehicle_idle = 1;
				} else {
					$fuel_fuelconsumption_vehicle_idle = 0;
				}
				if ($this->input->post('fuelconsumption_engine_hour') == 1) {
					$fuelconsumption_engine_hour = 1;
				} else {
					$fuelconsumption_engine_hour = 0;
				}
				if ($this->input->post('bucket_move_time_hhmmss') == 1) {
					$bucket_move_time_hhmmss = 1;
				} else {
					$bucket_move_time_hhmmss = 0;
				}
				if ($this->input->post('bucket_move_time_percentage') == 1) {
					$bucket_move_time_percentage = 1;
				} else {
					$bucket_move_time_percentage = 0;
				}
				if ($this->input->post('bucket_idle_time_hhmmss') == 1) {
					$bucket_idle_time_hhmmss = 1;
				} else {
					$bucket_idle_time_hhmmss = 0;
				}
				if ($this->input->post('bucket_idle_time_percentage') == 1) {
					$bucket_idle_time_percentage = 1;
				} else {
					$bucket_idle_time_percentage = 0;
				}
				if ($this->input->post('drumnonmvt_time_with_hhmmss') == 1) {
					$drumnonmvt_time_with_hhmmss = 1;
				} else {
					$drumnonmvt_time_with_hhmmss = 0;
				}
				if ($this->input->post('drumnonmvt_time_with_percentage') == 1) {
					$drumnonmvt_time_with_percentage = 1;
				} else {
					$drumnonmvt_time_with_percentage = 0;
				}
				if ($this->input->post('drumnonmvt_time_withoutload_hhmmss') == 1) {
					$drumnonmvt_time_withoutload_hhmmss = 1;
				} else {
					$drumnonmvt_time_withoutload_hhmmss = 0;
				}
				if ($this->input->post('drumnonmvt_time_withoutload_per') == 1) {
					$drumnonmvt_time_withoutload_per = 1;
				} else {
					$drumnonmvt_time_withoutload_per = 0;
				}
				if ($this->input->post('drumnonmvt_time_hhmmss') == 1) {
					$drumnonmvt_time_hhmmss = 1;
				} else {
					$drumnonmvt_time_hhmmss = 0;
				}
				if ($this->input->post('drumnonmvt_time_percentage') == 1) {
					$drumnonmvt_time_percentage = 1;
				} else {
					$drumnonmvt_time_percentage = 0;
				}
				if ($this->input->post('reading_can_odomtr_start') == 1) {
					$reading_can_odomtr_start = 1;
				} else {
					$reading_can_odomtr_start = 0;
				}
				if ($this->input->post('reading_can_odomtr_end') == 1) {
					$reading_can_odomtr_end = 1;
				} else {
					$reading_can_odomtr_end = 0;
				}
				if ($this->input->post('fuelconsumptionmeter') == 1) {
					$fuelconsumptionmeter = 1;
				} else {
					$fuelconsumptionmeter = 0;
				}
				if ($this->input->post('nbsp_sec') == 1) {
					$nbsp_sec = 1;
				} else {
					$nbsp_sec = 0;
				}
				if ($this->input->post('enginehours_hhmmss') == 1) {
					$enginehours_hhmmss = 1;
				} else {
					$enginehours_hhmmss = 0;
				}
				if ($this->input->post('fuelconsumption1') == 1) {
					$fuelconsumption1 = 1;
				} else {
					$fuelconsumption1 = 0;
				}

				if ($userid) {
					$finedata = array(
						'mileagekm' => $mileagekm,
						'startodometer' => $startodometer,
						'endodometer' => $endodometer,
						'startenginehrmeter' => $startenginehrmeter,
						'endenginehrmeter' => $endenginehrmeter,
						'overspeedmileagekm' => $overspeedmileagekm,
						'avgspeedrunning' => $avgspeedrunning,
						'maxspeedkm' => $maxspeedkm,
						'runningtime' => $runningtime,
						'runningtime_percentagerpt' => $runningtime_percentagerpt,
						'idletime_hhmmss' => $idletime_hhmmss,
						'idletime_percentagerpt' => $idletime_percentagerpt,
						'parkingtime_hhmmss' => $parkingtime_hhmmss,
						'parkingtime_percentage' => $parkingtime_percentage,
						'actime_hhmmss' => $actime_hhmmss,
						'actime_percentage' => $actime_percentage,
						'rpm_opr_time_hhmmss' => $rpm_opr_time_hhmmss,
						'rpm_opr_time_percentage' => $rpm_opr_time_percentage,
						'rpm_opt_normal_hhmmss' => $rpm_opt_normal_hhmmss,
						'rpm_opt_normal_percentage' => $rpm_opt_normal_percentage,
						'rpm_opt_max_hhmmss' => $rpm_opt_max_hhmmss,
						'rpm_opt_max_percentage' => $rpm_opt_max_percentage,
						'rpm_opr_hhmmss' => $rpm_opr_hhmmss,
						'rpm_engine_opr_percentage' => $rpm_engine_opr_percentage,
						'fuel_start_vol' => $fuel_start_vol,
						'fuel_final_vol' => $fuel_final_vol,
						'fuel_actual_fuel_cons' => $fuel_actual_fuel_cons,
						'fuel_refueling_vol' => $fuel_refueling_vol,
						'fuel_draining_vol' => $fuel_draining_vol,
						'fuel_mileage_km' => $fuel_mileage_km,
						'fuel_mileage_vehicle_running_km' => $fuel_mileage_vehicle_running_km,
						'fuel_fuelconsumption_vehicle_running' => $fuel_fuelconsumption_vehicle_running,
						'fuel_fuelconsumption_vehicle_idle' => $fuel_fuelconsumption_vehicle_idle,
						'fuelconsumption_engine_hour' => $fuelconsumption_engine_hour,
						'bucket_move_time_hhmmss' => $bucket_move_time_hhmmss,
						'bucket_move_time_percentage' => $bucket_move_time_percentage,
						'bucket_idle_time_hhmmss' => $bucket_idle_time_hhmmss,
						'bucket_idle_time_percentage' => $bucket_idle_time_percentage,
						'drumnonmvt_time_with_hhmmss' => $drumnonmvt_time_with_hhmmss,
						'drumnonmvt_time_with_percentage' => $drumnonmvt_time_with_percentage,
						'drumnonmvt_time_withoutload_hhmmss' => $drumnonmvt_time_withoutload_hhmmss,
						'drumnonmvt_time_withoutload_per' => $drumnonmvt_time_withoutload_per,
						'drumnonmvt_time_hhmmss' => $drumnonmvt_time_hhmmss,
						'drumnonmvt_time_percentage' => $drumnonmvt_time_percentage,
						'reading_can_odomtr_start' => $reading_can_odomtr_start,
						'reading_can_odomtr_end' => $reading_can_odomtr_end,
						'fuelconsumptionmeter' => $fuelconsumptionmeter,
						'nbsp_sec' => $nbsp_sec,
						'enginehours_hhmmss' => $enginehours_hhmmss,
						'fuelconsumption1' => $fuelconsumption1,
					);



					$this->db->where('user_id', $userid);
					$this->db->update('executive_report_chk', $finedata);

					$data['status'] = 1;
					$data['message'] = 'Data Update Successfully';
					$this->response($data, REST_Controller::HTTP_OK);
				} else {
					$this->response($result);
				}
			}
		}
	}

	public function immoblizer_post()
	{

		$headers = $this->input->request_headers();
		$password = $this->input->post('password');
		$newp = md5($password);
		$deviceimei = $this->input->post('deviceimei');
		$digit_output = $this->input->post('digit_output');
		$status = ($digit_output == 1) ? 1 : 2;
		$address = $this->input->post('address');

		$valid_status = 1;
		if ($deviceimei == '' || $password == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}
		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$user_id = $result['data']->userid;
				$dealer_id = $result['data']->dealer_id;
				// $subdealer_id= $result['data']->subdealer_id;
				$data['user_details'] = $this->api_model->user_details($user_id, $newp);
				// print_r($data['user_details']);die;
				if ($user_id == $data['user_details']->userid) {
					$data1 = array(
						'client_id' => $client_id,
						'user_id' => $user_id,
						'dealer_id' => $dealer_id,
						'vehicle_id' => $deviceimei,
						'address' => $address,
						'created_by' => $user_id,
						'status' => $status
					);

					$this->db->insert('immoblizer_data', $data1);

					$data2['status'] = 1;
					$data2['message'] = 'Insert Successfully';
					$this->response($data2);
				} else {
					$data1['status'] = 0;
					$data1['message'] = 'Password is mismatch';
					$this->response($data1);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function alerttypes_get()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$data['alerttypes'] = $this->api_model->alerttypes();

			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function alertreport_post()
	{

		$headers = $this->input->request_headers();
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$deviceimei = $this->input->post('deviceimei');
		$alert_id = $this->input->post('alert_id');
		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '' || $alert_id == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}
		if ($valid_status) {
			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				if ($client_id == $vehicle_data['vehicle_details']->client_id) {
					$data['alert_report'] = $this->api_model->alert_report($from_date, $to_date, $deviceimei, $alert_id);

					$this->response($data);
				} else {

					$data1['status'] = 0;
					$data1['message'] = 'Please send Current User Token';
					$this->response($data1);
				}
			} else {
				$this->response($result);
			}
		}
	}

	public function alert_settings_get()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		//print_r($result);exit;
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['alert_settings'] = $this->api_model->alert_settings($client_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function update_alertsettings_post()
	{

		$headers = $this->input->request_headers();
		$update_data = $this->input->post();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$update = $this->api_model->update_settings($update_data, $client_id);

			if ($update) {
				$data['message'] = 'Update Successfully';
				$this->response($data);
			} else {
				$data['message'] = 'Data Not Update......';
				$this->response($data);
			}
		} else {
			$this->response($result);
		}
	}

	public function vehicle_settings_get()
	{

		$headers = $this->input->request_headers();
		$deviceimei = $this->input->get('deviceimei');

		$result = $this->authorization_token->validateToken($headers['Authorization']);
		//print_r($result);exit;
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['vehicle_settings'] = $this->api_model->vehicle_settings($deviceimei);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function update_vehiclesettings_post()
	{

		$headers = $this->input->request_headers();
		$update_data = $this->input->post();
		// print_r($update_data);die;
		$deviceimei = $update_data['deviceimei'];
		unset($update_data['deviceimei']);
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$update = $this->api_model->update_vehiclesettings($update_data, $deviceimei);
			if ($update) {
				$data['message'] = 'Update Successfully';
				$this->response($data);
			} else {
				$data['message'] = 'Data Not Update......';
				$this->response($data);
			}
		} else {
			$this->response($result);
		}
	}

	public function vehicle_consolidate_post()
	{

		$headers = $this->input->request_headers();
		// $deviceimei =$this->input->post('deviceimei');
		$deviceimei = 0;
		$daytype = 1;
		$from_date = date('Y-m-d', strtotime('-7 Day'));
		$to_date = date('Y-m-d');

		$valid_status = 1;
		if ($valid_status) {
			$result = $this->authorization_token->validateToken($headers['Authorization']);
			//print_r($result['data']); die;
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$userid = $result['data']->userid;
				$role = $result['data']->roleid;

				$vehicle_data['vehicle_details'] = $this->api_model->vehicledetails($deviceimei);
				$consolidate_data = $this->api_model->consolidatedata_json($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				// print_r($consolidate_data);die;
				$distance_chart = $this->api_model->consolidate_distance_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$moving_chart = $this->api_model->consolidate_moving_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$idle_chart = $this->api_model->consolidate_idle_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$parking_chart = $this->api_model->consolidate_park_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$ac_chart = $this->api_model->consolidate_ac_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$fuelfill_chart = $this->api_model->consolidate_fuelfill_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$fueldip_chart = $this->api_model->consolidate_fueldip_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$fuelconsume_chart = $this->api_model->consolidate_fuelconsume_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$fuelmilege_chart = $this->api_model->consolidate_fuelmilege_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				$rpm_chart = $this->api_model->consolidate_rpm_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);

				$moving_chart = ($moving_chart == NULL) ? array() : $moving_chart;
				$idle_chart = ($idle_chart == NULL) ? array() : $idle_chart;
				$parking_chart = ($parking_chart == NULL) ? array() : $parking_chart;
				$ac_chart = ($ac_chart == NULL || $ac_chart == 0) ? array() : $ac_chart;
				$fuelfill_chart = ($fuelfill_chart == NULL) ? array() : $fuelfill_chart;
				$fuelconsume_chart = ($fuelconsume_chart == NULL) ? array() : $fuelconsume_chart;
				$fuelmilege_chart = ($fuelmilege_chart == NULL) ? array() : $fuelmilege_chart;
				$fueldip_chart = ($fueldip_chart == NULL) ? array() : $fueldip_chart;
				$rpm_chart = ($rpm_chart == NULL) ? array() : $rpm_chart;

				// $moving_dur = $this->converthmi($consolidate_data->moving_duration);
				// $idle_dur =$this->converthmi($consolidate_data->idle_duration);
				// $parking_dur = $this->converthmi($consolidate_data->parking_duration);
				// $ac_dur = $this->converthmi($consolidate_data->ac_duration);	
				// $rpm_dur = $this->converthmi_rpm($consolidate_data->totalrpm);

				$moving_dur = ($consolidate_data->moving_duration * 60);
				$idle_dur = ($consolidate_data->idle_duration * 60);
				$parking_dur = ($consolidate_data->parking_duration * 60);
				$ac_dur = ($consolidate_data->ac_duration * 60);
				$rpm_dur = ($consolidate_data->totalrpm * 60);

				$data['distance_data'] = array(
					'distance' => round($consolidate_data->distance),
					'distance_chart' => $distance_chart
				);

				$data['moving_data'] = array(
					'moving_duration' => $moving_dur,
					'moving_chart' => $moving_chart
				);

				$data['idle_data'] = array(
					'idle_duration' => $idle_dur,
					'idle_chart' => $idle_chart
				);

				$data['parking_data'] = array(
					'parking_duration' => $parking_dur,
					'parking_chart' => $parking_chart
				);

				$data['ac_data'] = array(
					'ac_duration' => $ac_dur,
					'ac_chart' => $ac_chart
				);


				$data['fuelfill_data'] = array(
					'fuelfill_litres' => round($consolidate_data->fuel_fill_litre),
					'fuellfill_chart' => $fuelfill_chart
				);

				$data['fueldip_data'] = array(
					'fueldip_litres' => round($consolidate_data->fuel_dip_litre),
					'fuelldip_chart' => $fueldip_chart
				);

				$data['fuelconsume_data'] = array(
					'fuelconsume_litres' => round($consolidate_data->fuel_consumed_litre),
					'fuelconsume_chart' => $fuelconsume_chart
				);

				// $data['fuelmilege_data'] = array('fuel_milege'=>round($consolidate_data->distance/$consolidate_data->fuel_consumed_litre),
				//                                   'fuelmilege_chart'=>$fuelmilege_chart);

				$data['totalrpm_data'] = array(
					'rpm_duration' => $rpm_dur,
					'rpm_chart' => $rpm_chart
				);



				$this->response($data);
			} else {
				$this->response($result);
			}
		}
	}

	public function consolidate_singlebox_post()
	{

		$headers = $this->input->request_headers();
		$deviceimei = $this->input->post('deviceimei');
		$daytype = $this->input->post('daytype');
		$reporttype = $this->input->post('reporttype');

		$reporttype =  explode(",", $reporttype);
		// print_r($reporttype);
		// exit;
		if ($daytype == 1) // weeks
		{
			$deviceimei = $this->input->post('deviceimei');
			$from_date = date('Y-m-d', strtotime('-7 Day'));
			$to_date = date('Y-m-d');
		} elseif ($daytype == 2) // Months
		{
			$deviceimei = $this->input->post('deviceimei');
			$from_date = date('Y-m-d', strtotime('-30 Day'));
			$to_date = date('Y-m-d');
		} else {
			$deviceimei = $this->input->post('deviceimei');
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
		}
		$valid_status = 1;
		if ($from_date == '' || $to_date == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Require Fields Are empty';
			$this->response($data);
		}

		if ($valid_status) {
			$result = $this->authorization_token->validateToken($headers['Authorization']);
			//print_r($result['data']); die;
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				// print_r($client_id);die;
				$userid = $result['data']->userid;
				$role = $result['data']->roleid;

				$consolidate_data = $this->api_model->consolidatedata_json($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
				//print_r($consolidate_data);die;
				if (in_array(1, $reporttype)) {
					$distance_chart = $this->api_model->consolidate_distance_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
					$data['distance_data'] = array(
						'distance' => round($consolidate_data->distance),
						'distance_chart' => $distance_chart
					);
				}
				if (in_array(2, $reporttype)) {
					$moving_chart = $this->api_model->consolidate_moving_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
					$moving_dur = $consolidate_data->moving_duration;

					$data['moving_data'] = array(
						'moving_duration' => $moving_dur,
						'moving_chart' => $moving_chart
					);
				}
				if (in_array(3, $reporttype)) {
					$idle_chart = $this->api_model->consolidate_idle_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
					$idle_dur = $consolidate_data->idle_duration;
					$data['idle_data'] = array(
						'idle_duration' => $idle_dur,
						'idle_chart' => $idle_chart
					);
				}
				if (in_array(4, $reporttype)) {
					$parking_chart = $this->api_model->consolidate_park_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
					$parking_dur = $consolidate_data->parking_duration;
					$data['parking_data'] = array(
						'parking_duration' => $parking_dur,
						'parking_chart' => $parking_chart
					);
				}
				if (in_array(5, $reporttype)) {
					$ac_chart = $this->api_model->consolidate_ac_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
					$ac_chart = ($ac_chart == NULL || $ac_chart == 0) ? array() : $ac_chart;

					$ac_dur = round($consolidate_data->ac_duration);
					$data['ac_data'] = array(
						'ac_duration' => $ac_dur,
						'ac_chart' => $ac_chart
					);
				}
				if (in_array(6, $reporttype)) {
					$fuelfill_chart = $this->api_model->consolidate_fuelfill_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);

					$fuelfill_chart = ($fuelfill_chart == NULL || $fuelfill_chart == 0) ? array() : $fuelfill_chart;
					$data['fuelfill_data'] = array(
						'fuelfill_litres' => round($consolidate_data->fuel_fill_litre),
						'fuellfill_chart' => $fuelfill_chart
					);
				}
				if (in_array(7, $reporttype)) {
					$fueldip_chart = $this->api_model->consolidate_fueldip_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);
					$fueldip_chart = ($fueldip_chart == NULL || $fueldip_chart == 0) ? array() : $fueldip_chart;

					$data['fueldip_data'] = array(
						'fueldip_litres' => round($consolidate_data->fuel_dip_litre),
						'fuelldip_chart' => $fueldip_chart
					);
				}
				if (in_array(8, $reporttype)) {

					$fuelconsume_chart = $this->api_model->consolidate_fuelconsume_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);

					$fuelconsume_chart = ($fuelconsume_chart == NULL || $fuelconsume_chart == 0) ? array() : $fuelconsume_chart;
					$data['fuelconsume_data'] = array(
						'fuelconsume_litres' => round($consolidate_data->fuel_consumed_litre),
						'fuelconsume_chart' => $fuelconsume_chart
					);
				}
				if (in_array(9, $reporttype)) {

					$fuelmilege_chart = $this->api_model->consolidate_fuelmilege_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);

					$fuelmilege_chart = ($fuelmilege_chart == NULL || $fuelmilege_chart == 0) ? array() : $fuelmilege_chart;
					$data['fuelmilege_data'] = array(
						'fuel_milege' => round($consolidate_data->distance / $consolidate_data->fuel_consumed_litre),
						'fuelmilege_chart' => $fuelmilege_chart
					);
				}
				if (in_array(10, $reporttype)) {

					$rpm_chart = $this->api_model->consolidate_rpm_chart($deviceimei, $from_date, $to_date, $client_id, $userid, $role);

					$rpm_chart = ($rpm_chart == NULL || $rpm_chart == 0) ? array() : $rpm_chart;
					$rpm_dur = round($consolidate_data->totalrpm);
					$data['totalrpm_data'] = array(
						'rpm_duration' => $rpm_dur,
						'rpm_chart' => $rpm_chart
					);
				}

				$this->response($data);
			} else {
				$this->response($result);
			}
		}
	}

	public function analysis_post()
	{

		$headers = $this->input->request_headers();
		$deviceimei = $this->input->post('deviceimei');
		$fromdate = $this->input->post('fromdate');
		$todate = $this->input->post('todate');
		$valid_status = 1;
		if ($fromdate == '' || $todate == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Required Fields are Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}
		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$data['speed_distance_data'] = $this->api_model->speed_distance_data($fromdate, $todate, $deviceimei, $client_id);
				// $raw_fuelvalue = $this->api_model->Fuel_report_list($fromdate,$todate,$deviceimei);
				// $smooth_fuelvalue = $this->api_model->Fuel_smooth_data($fromdate,$todate,$deviceimei);
				// $rpm_values = $this->api_model->engine_rpm_data($fromdate,$todate,$deviceimei);

				$this->response($data, REST_Controller::HTTP_OK);
			} else {
				$this->response($result);
			}
		}
	}

	public function rawfuelvalue_post()
	{

		$headers = $this->input->request_headers();
		$deviceimei = $this->input->post('deviceimei');
		$fromdate = $this->input->post('fromdate');
		$todate = $this->input->post('todate');
		$valid_status = 1;
		if ($fromdate == '' || $todate == '' || $deviceimei == '') {
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] = 'Required Fields are Empty';
			$this->response($data, REST_Controller::HTTP_OK);
		}
		if ($valid_status) {

			$result = $this->authorization_token->validateToken($headers['Authorization']);
			if ($result['status'] == 1) {
				$data['status'] = 1;
				$client_id = $result['data']->client_id;
				$data['raw_fuelvalue'] = $this->api_model->Fuel_report_list($fromdate, $todate, $deviceimei);
				// $smooth_fuelvalue = $this->api_model->Fuel_smooth_data($fromdate,$todate,$deviceimei);
				// $rpm_values = $this->api_model->engine_rpm_data($fromdate,$todate,$deviceimei);

				$this->response($data, REST_Controller::HTTP_OK);
			} else {
				$this->response($result);
			}
		}
	}

	public function liveshare_POST()
	{

		$headers = $this->input->request_headers();
		$expiretime = $this->input->post('expiretime');
		$deviceimei = $this->input->post('deviceimei');
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$vehicle1 = $this->db->query("SELECT vehicleid from vehicletbl where deviceimei =$deviceimei");
			$vehicles = $vehicle1->row();
			$vehicle_id = $vehicles->vehicleid;

			$data['status'] = 1;
			$unique_id = rand(10, 10000);
			$livesharelink = array(
				'client_id' => $result['data']->client_id,
				'unique_id' => $unique_id,
				'expiretime' => $expiretime,
				'vehicleid' => $vehicle_id,
				'createdby' => $result['data']->userid
			);
			$query = $this->db->insert('sharelink_data', $livesharelink);
			$insert_id = $this->db->insert_id();
			$finalid = urlencode(base64_encode($insert_id));

			if ($query) {
				$data['msg'] = "Livelink  created";
				$data['Live_link'] = 'http://vts.trackingwings.com/Gfyt65jlkj4/' . $finalid;
			} else {
				$data['status'] = 1;
				$data['msg'] = "Livelink  Error";
			}

			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function notification_alert_admin_GET()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);

		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['notification_alert'] = $this->api_model->notification_alert_admin($client_id);

			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	// Vehicle Management For School  Admin App

	public function vehicle_service_type_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['vehicleServiceType'] = $this->api_model->vehicleServiceType();
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function paymentType_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['paymentType'] = $this->api_model->paymentType();
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_service_list_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['service_list'] = $this->api_model->vehicle_service_list($client_id);
			// print_r($data['service_list']);die;
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_service_add_POST()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$client_id = $result['data']->client_id;
			$servicedata = array(
				'client_id' => $client_id,
				'vehicle_id' => $this->input->post('vehicle_id'),
				'service_type' => $this->input->post('service_type'),
				'purchase_product' => $this->input->post('purchase_product'),
				'purchase_amount' => $this->input->post('purchase_amount'),
				'payment_mode' => $this->input->post('payment_mode'),
				'mode_details' => $this->input->post('mode_details'),
				'purchase_date' => $this->input->post('purchase_date'),
				'description' => $this->input->post('description'),
			);
			$this->db->insert('vehicle_service', $servicedata);
			$data['status'] = 1;
			$data['message'] = 'Insert Data Successfully';
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_service_edit_GET()
	{
		$service_id = $this->input->get('service_id');
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['service_edit'] = $this->api_model->vehicle_service_edit($service_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_service_update_POST()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$client_id = $result['data']->client_id;
			$servicedata = array(
				'vehicle_id' => $this->input->post('vehicle_id'),
				'service_type' => $this->input->post('service_type'),
				'purchase_product' => $this->input->post('purchase_product'),
				'purchase_amount' => $this->input->post('purchase_amount'),
				'payment_mode' => $this->input->post('payment_mode'),
				'mode_details' => $this->input->post('mode_details'),
				'purchase_date' => $this->input->post('purchase_date'),
				'description' => $this->input->post('description'),
			);
			$service_id = $this->input->post('service_id');
			$this->db->where('service_id', $service_id);
			$this->db->where('client_id', $client_id);
			$this->db->update('vehicle_service', $servicedata);

			$data['status'] = 1;
			$data['message'] = 'Data Update Successfully';
			$this->response($data);
		} else {
			$this->response($result);
		}
	}


	public function vehicle_document_list_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['documnet_list'] = $this->api_model->vehicle_document_list($client_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_document_add_POST()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			//===================image upload===============================
			$file_name = $_FILES["insure_file"]["name"];
			$tmp_name = $_FILES["insure_file"]['tmp_name'];
			if ($file_name != "") {
				$insure_file = do_upload($file_name, $tmp_name);
			} else {
				$insure_file = '';
			}

			$rc_file = $_FILES["rc_file"]["name"];
			$rc_file_name = $_FILES["rc_file"]['tmp_name'];
			if ($rc_file != "") {
				$rcb_file = do_upload($rc_file, $rc_file_name);
			} else {
				$rcb_file = '';
			}

			$fc_file = $_FILES["fc_file"]["name"];
			$fc_file_name = $_FILES["fc_file"]['tmp_name'];
			if ($fc_file != "") {
				$fcb_file = do_upload($fc_file, $fc_file_name);
			} else {
				$fcb_file = '';
			}

			$tax_file = $_FILES["tax_file"]["name"];
			$tax_file_name = $_FILES["tax_file"]['tmp_name'];
			if ($tax_file != "") {
				$taxb_file = do_upload($tax_file, $tax_file_name);
			} else {
				$taxb_file = '';
			}

			$permit_file = $_FILES["permit_file"]["name"];
			$permit_file_name = $_FILES["permit_file"]['tmp_name'];
			if ($permit_file != "") {
				$permitb_file = do_upload($permit_file, $permit_file_name);
			} else {
				$permitb_file = '';
			}
			//============================================================                
			$client_id = $result['data']->client_id;
			$documentdata = array(
				'vehicle_id' => $this->input->post('vehicle_id'),
				'polocy_no' => $this->input->post('polocy_no'),
				'company_name' => $this->input->post('company_name'),
				'type' => $this->input->post('type'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'fc_expiry_date' => $this->input->post('fc_expiry_date'),
				'tax_expriy_date' => $this->input->post('tax_expriy_date'),
				'permit_expiry_date' => $this->input->post('permit_expiry_date'),
				'insure_file' => $insure_file,
				'rc_file' => $rcb_file,
				'fc_file' => $fcb_file,
				'tax_file' => $taxb_file,
				'permit_file' => $permitb_file,
				'client_id' => $client_id,
				//                    'dealer_id' => $this->session->userdata('dealer_id'),
				//                    'subdealer_id' => $this->session->userdata('subdealer_id'),
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $client_id,
			);

			$this->db->insert('insurance_reminder', $documentdata);
			$data['status'] = 1;
			$data['message'] = 'Insert Data Successfully';
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_document_edit_GET()
	{
		$insurance_reminder_id = $this->input->get('insurance_reminder_id');
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['document_edit'] = $this->api_model->vehicle_document_edit($insurance_reminder_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_document_update_POST()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$client_id = $result['data']->client_id;
			$file_name = $_FILES["insure_file"]["name"];
			$tmp_name = $_FILES["insure_file"]['tmp_name'];
			if ($file_name != "") {
				$insure_file = do_upload($file_name, $tmp_name);
			} else {
				$insure_file = $this->input->post('hiddeninsure_file');
			}

			$rc_file = $_FILES["rc_file"]["name"];
			$rc_file_name = $_FILES["rc_file"]['tmp_name'];
			if ($rc_file != "") {
				$rcb_file = do_upload($rc_file, $rc_file_name);
			} else {
				$rcb_file = $this->input->post('hiddenrc_file');
			}

			$fc_file = $_FILES["fc_file"]["name"];
			$fc_file_name = $_FILES["fc_file"]['tmp_name'];
			if ($fc_file != "") {
				$fcb_file = do_upload($fc_file, $fc_file_name);
			} else {
				$fcb_file = $this->input->post('hiddenfc_file');
			}

			$tax_file = $_FILES["tax_file"]["name"];
			$tax_file_name = $_FILES["tax_file"]['tmp_name'];
			if ($tax_file != "") {
				$taxb_file = do_upload($tax_file, $tax_file_name);
			} else {
				$taxb_file = $this->input->post('hiddentax_file');
			}

			$permit_file = $_FILES["permit_file"]["name"];
			$permit_file_name = $_FILES["permit_file"]['tmp_name'];
			if ($permit_file != "") {
				$permitb_file = do_upload($permit_file, $permit_file_name);
			} else {
				$permitb_file = $this->input->post('hiddenpermit_file');
			}

			$documentdata = array(
				'vehicle_id' => $this->input->post('vehicle_id'),
				'polocy_no' => $this->input->post('polocy_no'),
				'company_name' => $this->input->post('company_name'),
				'type' => $this->input->post('type'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'fc_expiry_date' => $this->input->post('fc_expiry_date'),
				'tax_expriy_date' => $this->input->post('tax_expriy_date'),
				'permit_expiry_date' => $this->input->post('permit_expiry_date'),
				'insure_file' => $insure_file,
				'rc_file' => $rcb_file,
				'fc_file' => $fcb_file,
				'tax_file' => $taxb_file,
				'permit_file' => $permitb_file,
				'client_id' => $client_id,
				//                    'dealer_id' => $this->session->userdata('dealer_id'),
				//                    'subdealer_id' => $this->session->userdata('subdealer_id'),
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $client_id,
			);
			$insurance_reminder_id = $this->input->post('insurance_reminder_id');
			$this->db->where('insurance_reminder_id', $insurance_reminder_id);
			$this->db->where('client_id', $client_id);
			$this->db->update('insurance_reminder', $documentdata);

			$data['status'] = 1;
			$data['message'] = 'Data Update Successfully';
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	//=====================================Vehicle Fuel Details Continue here======================================================

	public function vehicle_fuel_list_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['fuel_list'] = $this->api_model->vehicle_fuel_list($client_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_fuel_add_POST()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$client_id = $result['data']->client_id;
			$fueldata = array(
				'client_id' => $client_id,
				'vehicle_id' => $this->input->post('vehicle_id'),
				'kilo_meter' => $this->input->post('kilo_meter'),
				'fuel_liters' => $this->input->post('fuel_liters'),
				'fuel_amount' => $this->input->post('fuel_amount'),
				'fuel_date' => $this->input->post('fuel_date'),
				'bill_no' => $this->input->post('bill_no'),
				'payment_type_id' => $this->input->post('payment_type_id'),
				'createdby' => $client_id,
			);
			$this->db->insert('fuel_management', $fueldata);
			$data['status'] = 1;
			$data['message'] = 'Insert Data Successfully';
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_fuel_edit_GET()
	{
		$fuel_management_id = $this->input->get('fuel_management_id');
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['fuel_management_id'] = $this->api_model->vehicle_fuel_edit($fuel_management_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_fuel_update_POST()
	{

		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$client_id = $result['data']->client_id;
			$fueldata = array(
				'client_id' => $client_id,
				'vehicle_id' => $this->input->post('vehicle_id'),
				'kilo_meter' => $this->input->post('kilo_meter'),
				'fuel_liters' => $this->input->post('fuel_liters'),
				'fuel_amount' => $this->input->post('fuel_amount'),
				'fuel_date' => $this->input->post('fuel_date'),
				'bill_no' => $this->input->post('bill_no'),
				'payment_type_id' => $this->input->post('payment_type_id'),
				'createdby' => $client_id,
			);
			$fuel_management_id = $this->input->post('fuel_management_id');
			$this->db->where('fuel_management_id', $fuel_management_id);
			$this->db->where('client_id', $client_id);
			$this->db->update('fuel_management', $fueldata);

			$data['status'] = 1;
			$data['message'] = 'Data Update Successfully';
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function vehicle_total_list_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['vehicle_total_list'] = $this->api_model->vehicle_total_list($client_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}
	public function vehicle_expireddate_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['vehicle_expireddate'] = $this->api_model->vehicle_expired_list($client_id);
			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function total_expensedatewise_POST()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$vehicle_id = $this->input->post('vehicle_id');
			$fromDate = $this->input->post('fromDate');
			$endDate = $this->input->post('endDate');
			if ($vehicle_id == 0) {
				$data['total_expensedatewise'] = $this->api_model->allvehicle_expense($client_id);
			} else {
				$data['total_expensedatewise'] = $this->api_model->vehicleWise_expense($client_id, $vehicle_id, $fromDate, $endDate);
			}

			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function service_overdue_GET()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['service_overdue'] = $this->api_model->vehicle_service_overdue($client_id);

			$this->response($data);
		} else {
			$this->response($result);
		}
	}



	public function history_details_admin_POST()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);

		if ($result['status'] == 1) {
			$data['status'] = 1;
			$vehicle = $this->input->post('imei');
			$from_date_post = $this->input->post('from_date');
			$to_date_post = $this->input->post('to_date');
			$client_id = $result['data']->client_id;
			$userid = $result['data']->userid;
			$role = $result['data']->roleid;
			$timezone_hours =  $result['data']->timezone_hours;
			// print_r($timezone_hours);die;
			$reporttype = $this->input->post('reporttype');

			if ($reporttype == 1) {

				$ct = date('Y-m-d');
				$from_date = $ct . ' 00:00:00';
				$to_date = $ct . ' 23:59:59';
			} elseif ($reporttype == 2) {
				$from_date = date('Y-m-d', strtotime('-1 Day'));
				$to_date = date('Y-m-d');
			} elseif ($reporttype == 3) {
				$from_date = date('Y-m-d', strtotime('-7 Day'));
				$to_date = date('Y-m-d');
			} elseif ($reporttype == 4) {
				$from_date = $from_date_post;
				$to_date = $to_date_post;
			}

			if ($reporttype != 1) {

				$data = $this->api_model->history_alldata_admin($vehicle, $from_date, $to_date, $client_id, $userid, $role, $reporttype);
				// print_r($data);die;			
				//--------------------------------Its Contain get Values And Store A Variable--------------------------------------------------
				$total_km = round($data->distance);
				$total_park = $data->parking_duration;
				$total_ac = $data->ac_duration;
				$total_idle = $data->idle_duration;
				$total_rpm = $data->totalrpm;
				$fuelconsum = round($data->fuel_consumed_litre);
				$fuelfill = round($data->fuel_fill_litre);
				$fueldip = round($data->fuel_dip_litre);
				$average_speed = round($data->average_speed);
				$maximum_speed = round($data->maximum_speed);
				$secondary_engine = "1:2:3";
				//---------------------- Above datas stored in a variable-> that variable use to send response ---------------------------------------------

			} else {
				// print_r($from_date);die;
				$yesterday_distance = $this->api_model->smart_distanceday_API($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);
				$yesterday_park = $this->api_model->smart_parkday_API($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);
				$yesterday_idle = $this->api_model->smart_idleday_API($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);
				$yesterday_ign = $this->api_model->smart_ignday_API($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);
				// $yesterday_ac = $this->api_model->smart_acday_API($vehicle,$from_date,$to_date,$device_type=null,$client_id,$timezone_hours);
				$yesterday_fill = $this->api_model->smart_fuelfill_API($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);
				$yesterday_dip = $this->api_model->smart_fueldip_API($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);
				$yesterday_consumed = $this->api_model->smart_fuelconsumed_API($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);
				// $yesterday_rpm = $this->api_model->consolidate_allrpmday($vehicle,$from_date,$to_date,$device_type=null,$client_id,$timezone_hours);
				$yesterday_avg_max = $this->api_model->consolidate_playback_avg_max($vehicle, $from_date, $to_date, $device_type = null, $client_id, $timezone_hours);

				$yesterday_park = $yesterday_park;
				$total_km = round($yesterday_distance->distance_km);
				$total_park = $yesterday_park->parking_duration;
				// $total_ac =$yesterday_ac->ac_duration;
				$total_idle = $yesterday_idle->idel_duration;
				// $total_rpm =$yesterday_rpm->totalrpm;
				$fuelconsum = round($yesterday_consumed->fuel_consumed_litre);
				$fuelfill = round($yesterday_fill->fuel_fill_litre);
				$fueldip = round($yesterday_dip->fuel_dip_litre);
				$average_speed = round($yesterday_avg_max->avg_speed);
				$maximum_speed = round($yesterday_avg_max->max_speed);
				$secondary_engine = "1:2:3";
			}


			//------------------------------its change parking value to H:M:S------------------------------------------------------

			$park_duration = $total_park; //Parking Duration
			$hours = floor($park_duration / 60);
			$min = $park_duration - ($hours * 60);
			$min = floor((($min -   floor($min / 60) * 60)) / 6);
			$second = $park_duration % 60;

			$tot_park = $hours . ":" . $min . ":" . $second;



			//-------------------------------its change A/C value to H:M:S----------------------------------------------------			

			$ac_duration = $total_ac; //AC Duration
			$hours = floor($ac_duration / 60);
			$min = $ac_duration - ($hours * 60);
			$min = floor((($min -   floor($min / 60) * 60)) / 6);
			$second = $ac_duration % 60;

			$tot_ac = $hours . ":" . $min . ":" . $second;

			//--------------------------------Its change idle value to H:M:S--------------------------------------------------------------

			$idle_duration = $total_idle;
			$hours = floor($idle_duration / 60);
			$min = $idle_duration - ($hours * 60);
			$min = floor((($min -   floor($min / 60) * 60)) / 6);
			$second = $idle_duration % 60;

			$tot_idle = $hours . ":" . $min . ":" . $second;

			//--------------------------------Its change RPM value to H:M:S-----------------------------------------------------			

			$totalrpm_duration = $total_rpm; //Total RPM Duration
			$hours = floor($totalrpm_duration / 3600);
			$min = ($totalrpm_duration / 60) % 60;
			$min1 = round($min / 60, 1) * 10;
			$second = $totalrpm_duration % 60;

			$tot_rpm = $hours . ":" . $min . ":" . $second;
			//--------------------------------------------------------------------------------------------------------			
			//print_r($tot_rpm);die;

			$data = array(
				'distance' => $total_km,
				'parking_duration' => $tot_park,
				'ac_duration' => $tot_ac,
				'idle_duration' => $tot_idle,
				'totalrpm' => $tot_rpm,
				'fuel_consumed_litre' => $fuelconsum,
				'fuel_fill_litre' => $fuelfill,
				'fuel_dip_litre' => $fueldip,
				'average_speed' => $average_speed,
				'maximum_speed' => $maximum_speed,
				'secondary_engine' => $secondary_engine
			);

			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	public function payment_history_POST()
	{
		$headers = $this->input->request_headers();
		$result = $this->authorization_token->validateToken($headers['Authorization']);
		//    echo "<pre>";
		//    print_r($this->input->post());
		//    exit;
		if ($result['status'] == 1) {
			$data['status'] = 1;
			$client_id = $result['data']->client_id;
			$data['message'] = 'Data Inserted Successfully';
			// $this->api_model->vehicle_service_overdue($client_id);

			$this->response($data);
		} else {
			$this->response($result);
		}
	}

	// public function payment_history_POST() {
	// 	$headers = $this->input->request_headers();
	// 	   $result = $this->authorization_token->validateToken($headers['Authorization']);
	// 	//    echo "<pre>";
	// 	//    print_r($this->input->post());
	// 	//    exit;
	// 	   if ($result['status'] == 1) {
	// 		   $data['status'] = 1;
	// 		   $client_id = $result['data']->client_id;
	// 		   $data['message'] = 'Data Inserted Successfully';
	// 		   // $this->api_model->vehicle_service_overdue($client_id);

	// 		   $this->response($data);
	// 	   } else {
	// 		   $this->response($result);
	// 	   }
	// }


}
