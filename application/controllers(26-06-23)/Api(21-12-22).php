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

			    $ct =  date('H:i:A');
				$liveroute_details = $this->api_model->livetrackvehiclelist($userid);
				foreach ($liveroute_details as $list) {

					$route_pl_starttime = date('H:i:A', (strtotime($list->route_starttime)));   // First Start date
					$route_pl_endtime = date('H:i:A', strtotime('+ 15 Minutes', strtotime($list->route_endtime)));      // First End date
					if (($ct >= $route_pl_starttime && $ct <= $route_pl_endtime))       // True If condition  Between currentdate and therir dates
					{
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
}
