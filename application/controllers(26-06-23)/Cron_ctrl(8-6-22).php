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

	public function livetrackreport()
	{
		 $startdate = date('H:i:A',strtotime('05:00:00'));   // First Start date
		 $enddate = date('H:i:A',strtotime('10:00:00'));      // First End date

		 $startdate1 = date('H:i:A',strtotime('15:00:00'));   // Second Start date
		 $enddate1 = date('H:i:A',strtotime('19:00:00'));   // Second End date

		$ct =  date('H:i:A');  
		if (($ct >= $startdate && $ct <= $enddate) || ($ct >= $startdate1 && $ct <= $enddate1))       // True If condition  Between currentdate and therir dates
		{
			$shift_type = ($ct >= $startdate && $ct <= $enddate) ? 1 :2;
			$liveroute_details = $this->cron_model->allliveroutelist($shift_type);

		}
		foreach ($liveroute_details as $list) {

			$route_id = $list->route_id;
			$client_id = $list->client_id;
			$vehicle_id = $list->vehicle_id;
			$route_startid = $list->route_geo_start_id;
			$route_endid = $list->route_geo_end_id;

			$routestartgeo = $this->cron_model->routestartgeo($route_startid, $vehicle_id,$shift_type);
			$routeendgeo = $this->cron_model->routeendgeo($route_endid, $vehicle_id,$shift_type);


			$route_exit_time = $routestartgeo->out_datetime;
			$route_entry_time = $routeendgeo->in_datetime;                     //Startroute Exit time
			if ($route_exit_time) {

			
				$routeend_ept_time = '';
               $route_starttime = date('Y-m-d H:i:s',strtotime($list->route_starttime));
               $route_endtime = date('Y-m-d H:i:s', strtotime($list->route_endtime));
			
				$vehicle_name = $list->vehiclename;
				$vehicle_id = $list->vehicle_id;
				$routename = $list->route_name;
				$route_id = $list->route_id;

				$livedata = array(
					'vehicle_id' => $vehicle_id,
					'client_id' => $list->client_id,
					'vehicle_name' => $vehicle_name,
					'route_id' => $route_id,
					'routename' => $routename,
					'route_startid' => $route_startid,
					'route_endid' => $route_endid,
					'route_planstart_time' => $route_starttime,
					'route_planend_time' => $route_endtime,
					'route_exitime' => $route_exit_time,
					'routeend_exptime' => $routeend_ept_time,
					'route_entry_time' => $route_entry_time,
					'travel_date' => date('Y-m-d')
				);

				$last_id = $this->cron_model->add_livedata($livedata);
				$livestop_details = $this->cron_model->livestop_details($route_id);
				$livestop_data = '';
				foreach ($livestop_details as $stoplist) {

					$stop_geoid = $stoplist->stop_geo_id;
					$stopentry_geotime = $this->cron_model->stop_geointime($stop_geoid, $vehicle_id,$shift_type);
					$stopexit_geotime = $this->cron_model->stop_geoouttime($stop_geoid, $vehicle_id,$shift_type);
					$stopentry_time = $stopentry_geotime->in_datetime;
					$stopexit_time = $stopexit_geotime->out_datetime;

					$stop_ept_time = '';
					$stop_arrival_time = date('Y-m-d H:i:s', strtotime($stoplist->stop_arrival_time));
					$stop_start_time = date('Y-m-d H:i:s', strtotime($stoplist->stop_start_time));
		

					$livestop_data = array(
						'live_routeid' => $last_id,
						'client_id' => $client_id,
						'stop_geo_id' => $stop_geoid,
						'stopplaned_entry' => $stop_arrival_time,
						'stopplaned_exit' => $stop_start_time,
						'stopentry_time' => $stopentry_time,
						'stopexit_time' => $stopexit_time,
						'stop_ept_time' => $stop_ept_time,
						'travel_date' => date('Y-m-d')
					);
					$add_livestop = $this->cron_model->add_livestop($livestop_data);
				}
			}

			if ($route_exit_time == '') {

				$nodata = array(
					'vehicle_id' => $list->vehicle_id,
					'client_id' => $list->client_id,
					'vehicle_name' => $list->vehiclename,
					'modified_date' => date('Y-m-d'),
				);

				$this->db->insert('sch_nodata_vehicle', $nodata);
			}
		}
	}

	
	public function get_geofence(){

		// 2 GEO IN LOCATION
		// 1 GEO OUT LOCATION

$data_list = $this->cron_model->geo_vehicle_location();

if($data_list){

foreach($data_list as $list){

			$latitude1 =$list->g_lat;

				 $longitude1 =$list->g_lng;

				 $latitude2 =$list->v_lat;

				 $longitude2 =$list->v_lng;

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
				 

			$data1 =  $v_dis.' <b>'.$list->vehicleid.'</b> c_lat: '.$list->g_lat.' c_lng: '.$list->g_lng.' v_lat: '.$list->v_lat.' v_lng: '.$list->v_lng.'<br>';

			
			$v_dis = $v_dis * 1000;

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

					if($all_status == '2'){  // add trip

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
													"distance" => $list->traveled_distance,
													"ignition_status" => $list->acc_on,
													"location_status" => '1',
													);
												$this->db->insert('sch_geofence_report',$data);


					}

								
				
				}else{	//vehicle out

					if($all_status == '1' && $list->Location_Id == $g_id && $in_check!=''){  // last trip end

					

							$distance_con ='';

									$data = array(

													"out_datetime" => date('Y-m-d H:i:s'),
													"location_status" => '2',
													"distance" => $distance_con
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
										"distance" => $list->traveled_distance,
										"ignition_status" => $list->acc_on,
										"location_status" => '1'
										);
						          	$this->db->insert('sch_geofence_report',$data);



				}

				// else{	//vehicle out

				// 	$data = array(

				// 					"vehicle_id" => $list->vehicleid,
				// 					"client_id" => $list->client_id,
				// 					"trip_id" => $trip_id,
				// 					"lat" => $list->v_lat,
				// 					"lng" => $list->v_lng,
				// 					"out_datetime" => date('Y-m-d H:i:s'),
				// 					"speed" => $list->speed,
				// 					"geo_location_id" => $list->Location_Id,
				// 					"g_lat" => $list->g_lat,
				// 					"g_lng" => $list->g_lng,
				// 					"distance" => $list->traveled_distance,
				// 					"ignition_status" => $list->acc_on,
				// 					"location_status" => '2'
				// 					);
				// 			$this->db->insert('sch_geofence_report',$data);
				// }
				

			}



	}
}
}


}
