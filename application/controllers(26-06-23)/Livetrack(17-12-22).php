<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Livetrack extends MY_Controller 
{
	public function __construct() 
	{
		parent::__construct ();	
		$this->load->model ('livetrack_model');
		$this->load->model ('Dashboardmodel');
		$this->load->model ('route_model');
		$this->load->model ('genericreport_model');
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

	}
	public function index1()
	{	
		redirect('login/');
	}

	public function index() 
	{
		$this->livetrack_vehicles();
	}
	public function livetrack_vehicles() 
	{
		$timezone = $this->input->get('timezone');
	    $timezone_minute = ($timezone !='qatar' ) ? 0 : 150;
		$timezone = ($timezone !='qatar' ) ? date_default_timezone_set("Asia/Calcutta") : date_default_timezone_set("Asia/qatar");
		$customercomplaint= $this->Dashboardmodel->customer_complaint();
		$data['customercomplaint'] = $customercomplaint;
		$accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$startdate = date('H:i:A',strtotime('05:00:00'));   // First Start date
		$enddate = date('H:i:A',strtotime('13:00:00'));      // First End date
		$endshiftdate = date('H:i:A',strtotime('13:15:00'));      // First End date
		$startdate1 = date('H:i:A',strtotime('14:00:00'));   // Second Start date
		$enddate1 = date('H:i:A',strtotime('23:30:00'));   // Second End date

		$endshiftdate1 = date('H:i:A',strtotime('19:15:00'));      // First End date
	//	echo date("Y-m-d H:i:s");exit;
	   $ct =  date('H:i:A');  

	   if(!(in_array(date('D'),['Sun'])))                 /* Current date is not sunday if condition is false So functions are workings */
	    {

			if (($ct >= $startdate && $ct <= $enddate) || ($ct >= $startdate1 && $ct <= $enddate1))       // True If condition  Between currentdate and therir dates
			 {
				$shift_type = ($ct >= $startdate && $ct <= $enddate) ? 1 :2;
			//	$shift_type = 2;
			   $liveroute_details = $this->livetrack_model->livetrackvehicles($shift_type,$timezone_minute);      // Get Assign Route Lists
			
						foreach ($liveroute_details as $list) {
							if(!(in_array(date('D'),['Sat']) && $list->saturday_status!=1)) 
							{
								   // day is saturday and saturday_status is  equal to 1 is means this function saturday working

								   $client_id = $list->client_id;
								   $route_id = $list->route_id;
								   $vehicle_id = $list->vehicle_id;
								   $route_startid = $list->route_geo_start_id;
								   $route_endid = $list->route_geo_end_id;
								   $shift_type = $list->shift_type;
								   $latitude1 =$list->lat;
								   $longitude1 =$list->lng;
								   $latitude2 =$list->routestart_lat;
								   $longitude2 =$list->routestart_lng;
   
								   $latitude3 =$list->routeend_lat;
								   $longitude3 =$list->routeend_lng;
								   $routestart_radius = $list->routestart_radius;
								   $routeend_radius = $list->routeend_radius;
								   
									$route_starttime = date('Y-m-d H:i:s',strtotime($list->route_starttime));
								    $routestartgeo = $this->livetrack_model->routestartgeo($route_startid, $vehicle_id,$route_starttime);
									$route_exit_time = $routestartgeo->out_datetime;  //Startroute Exit time
								   if(($routestartgeo==1))
								   {
									    $distance =$this->geo_distance($latitude1,$longitude1,$latitude2,$longitude2);
									   if($distance > $routestart_radius)
									   {
										   $date = date('mdHis');
										   $trip_id = $date.''.$vehicle_id;
										   $data = array(
											   "vehicle_id" => $vehicle_id,
											   "client_id" => $client_id,
											   "trip_id" => $trip_id,
											   "lat" => $latitude1,
											   "lng" => $longitude1,
											   "out_datetime" => date('Y-m-d H:i:s'),
											   "speed" => $list->speed,
											   "geo_location_id" => $route_startid,
											   "g_lat" => $latitude2,
											   "g_lng" => $longitude2,
											   // "distance" => $list->traveled_distance,
											   "ignition_status" => $list->acc_on,
											   "location_status" => 2
											   );
		   
										   $this->db->insert('sch_geofence_report',$data);	
   
									   }
								   }
									   $routeplanstart = date('Y-m-d H:i:s',strtotime($list->route_starttime));
									   $d1 = new DateTime($route_exit_time);
									   $d2 = new DateTime($routeplanstart);
									   $interval = $d1->diff($d2);
									   $diffInMinutes = $interval->i; 
									   $add_time = ($list->late_status==1) ? $diffInMinutes :0;
									   $add_time = '+ '.$add_time.' minutes'; 
									   $route_endtime = date('Y-m-d H:i:s',strtotime($add_time,strtotime($list->route_endtime)));
									   $routeendgeo = $this->livetrack_model->routeendgeo($route_endid, $vehicle_id,$route_endtime);
										$route_entry_time = $routeendgeo->in_datetime;     // Startroute Entry time
   
										if($route_exit_time)
										{
									   $route_planstart_time =  date('H:i A',strtotime($add_time,strtotime($list->route_starttime)));
									   $route_planend_time =  date('H:i A',strtotime($add_time,strtotime($list->route_endtime)));
									   
									   $vehiclelatlng = $this->livetrack_model->vehiclelatlng($vehicle_id);
									   $routelatlng = $this->livetrack_model->routelatlng($route_endid);
									   $routelatlng1 = $this->livetrack_model->routelatlng($route_startid);
									   $route_endlat = $routelatlng->Lat;
									   $route_endlng = $routelatlng->Lng;
									   
									   $vehicle_lat = $vehiclelatlng->lat;									//vehicle lat
									   $vehicle_lng = $vehiclelatlng->lng;									//vehicle lng
									   $vehicle_speed = $vehiclelatlng->speed;                             //vehicle current speed
									   $distance = $this->geo_distance($latitude1,$longitude1,$latitude3,$longitude3);
									   $expecttime = ($distance/1000)/40;
									   $routeend_ept_time =floor($expecttime * 60);     //Hours to minutes Convert
									   $add_eta = '+ '.$routeend_ept_time.' Minutes';
									   $routeend_ept_time =date('Y-m-d H:i:s',strtotime($add_eta));   // add minus to current datetime
									   $vehicle_name = $list->vehiclename;    //Vehicle name
									   $routename = $list->route_name;      // Route Name
									   
									   $tripstart_alert = $this->livetrack_model->tripstart_alert($route_id,$checkid=1);      //Send Alert to all parents Trip Start 
									   
									   if($tripstart_alert)
									   {
										   foreach ($tripstart_alert as $tlist) {
					   
											   $smsdata = array('route_name' =>$tlist->route_name,
											   'route_id' =>$tlist->route_id,
											   'stop_name' =>$routelatlng1->Location_short_name,
											   'stop_id' =>$route_startid,
											   'distance' =>$distance,
											   'expected_time' =>$expecttime,
											   'vehicle_number' =>$vehicle_name,
											   'speed' =>$vehicle_speed,
											   'lat'=>$vehicle_lat,
											   'lng' =>$vehicle_lng,
											   'createdon' =>date('Y-m-d H:i:s'),
											   'vehicle_id' =>$vehicle_id,
											   'client_id' =>$client_id,
											   'parent_id' =>$tlist->parent_id,
											   'all_status' =>1,
											   'alert_type' =>'Trip Start',
											   'alert_location'=>$vehiclelatlng->latlon_address
											   );
											   $this->db->insert('sch_sms_alert',$smsdata);
											   $update_status = array('status' => 2);
												$this->db->where('route_id',$tlist->route_id);
												$this->db->update('sch_student',$update_status);
																									    
											   }
										   }
										   if($route_entry_time)
											{
											   $tripstart_alert = $this->livetrack_model->tripstart_alert($route_id,$checkid=2);      //Send Alert to all parents Trip End 
											   if($tripstart_alert)
											   {
													   foreach ($tripstart_alert as $tlist) {
														   $smsdata = array('route_name' =>$tlist->route_name,
														   'route_id' =>$tlist->route_id,
														   'stop_name' =>$routelatlng->Location_short_name,
														   'stop_id' =>$route_endid,
														   'distance' =>$distance,
														   'expected_time' =>$expecttime,
														   'vehicle_number' =>$vehicle_name,
														   'speed' =>$vehicle_speed,
														   'lat'=>$vehicle_lat,
														   'lng' =>$vehicle_lng,
														   'createdon' =>date('Y-m-d H:i:s'),
														   'vehicle_id' =>$vehicle_id,
														   'client_id' =>$client_id,
														   'parent_id' =>$tlist->parent_id,
														   'all_status' =>2,
														   'alert_type' =>'Trip End',
														   'alert_location'=>$vehiclelatlng->latlon_address
														   );
								   
														   $this->db->insert('sch_sms_alert',$smsdata);
																													   
														   $update_status = array('status' => 4);
														   $this->db->where('student_id',$tlist->student_id);
														   $this->db->update('sch_student',$update_status);
														   
													   }
											   }
					   
										   }
										   $livedata = array('vehicle_name' =>$vehicle_name ,
														   'vehicle_id' =>$list->vehicleid ,
														   'client_id' =>$client_id ,
														   'routename' =>$routename,
														   'route_id' =>$route_id	,
														   'route_startid' =>$route_startid,
														   'route_endid' =>$route_endid,
														   'route_planstart_time' =>$route_planstart_time,
														   'route_planend_time' =>$route_planend_time,
														   'route_exitime' =>$route_exit_time,
														   'routeend_exptime' =>$routeend_ept_time,
														   'route_entry_time'=>$route_entry_time,
														   'travel_date'=>date('Y-m-d')
														   );
										   $livestop_details= $this->livetrack_model->livestop_details($route_id);
										   $livestop_data='';
										   foreach ($livestop_details as $key=>$stoplist) {
												   $stop_geoid =$stoplist->stop_geo_id;
												   $stop_arrival_time = date('Y-m-d H:i:s',strtotime($add_time,strtotime($stoplist->stop_arrival_time)));
												   $stop_start_time = date('Y-m-d H:i:s', strtotime($add_time,strtotime($stoplist->stop_start_time)));
												   $stopentry_geotime = $this->livetrack_model->stop_geointime($stop_geoid, $vehicle_id,$stop_arrival_time);
												   $stopexit_geotime = $this->livetrack_model->stop_geoouttime($stop_geoid, $vehicle_id,$stop_start_time);
												   $stopplaned_entry =  date('H:i A',strtotime($add_time,strtotime($stoplist->stop_arrival_time)));
												   $stopplaned_exit =  date('H:i A',strtotime($add_time,strtotime($stoplist->stop_start_time)));
   
												   $stopentry_time = $stopentry_geotime->in_datetime;    // Stop Entry Time
												   $stopexit_time = $stopentry_geotime->out_datetime;     // Stop Exit Time
												   $stoplatlng = $this->livetrack_model->stoplatlng($stop_geoid);
								   
												   $stop_lat = $stoplatlng->Lat;     // Stop Lat
												   $stoplng = $stoplatlng->Lng;      // Stop Lng
												   $stop_radius = $stoplist->stop_radius;
												   $distance = $this->geo_distance($stop_lat,$stoplng,$vehicle_lat,$vehicle_lng);
												   if(empty($stopentry_time))
												   { 
													   if($distance < $stop_radius)
													   {
														   $date = date('mdHis');
														   $trip_id = $date.''.$vehicle_id;
														   $data = array(
															   "vehicle_id" => $vehicle_id,
															   "client_id" => $client_id,
															   "trip_id" => $trip_id,
															   "lat" => $vehicle_lat,
															   "lng" => $vehicle_lng,
															   "in_datetime" => date('Y-m-d H:i:s'),
															   "speed" => $list->speed,
															   "geo_location_id" => $stop_geoid,
															   "g_lat" => $stop_lat,
															   "g_lng" => $stoplng,
															   // "distance" => $list->traveled_distance,
															   "ignition_status" => $list->acc_on,
															   "location_status" => 1
															   );
														   $this->db->insert('sch_geofence_report',$data);	
														   $insert_id = $this->db->insert_id();
													   }
												   }
												   if(!empty($stopentry_time))
												   {
													   
													   if($stopentry_geotime->location_status == 1 && $stopentry_geotime->geo_location_id == $stop_geoid ){  // last trip end			
														if($distance > $stop_radius)
															   {
																   $data = array(
																	   "out_datetime" =>date('Y-m-d H:i:s'),
																	   "location_status" => 2,
																	   "distance" => ''
																	   );
																   $this->db->where('id',$stopentry_geotime->id);
																   $this->db->update('sch_geofence_report', $data);
   
															   }
   
													   }
												   }
												   $distance = $this->geo_distance($stop_lat,$stoplng,$vehicle_lat,$vehicle_lng);
												   $expecttime = ($distance/1000)/40;
												   $stop_ept_time =floor($expecttime * 60);    // Hours to minutes Conversion
												   $eta_mins =floor($expecttime * 60);
												   $add_eta = '+ '.$stop_ept_time.' Minutes';
											   //	$stop_ept_time =  gmdate('H:i:s', floor($expecttime * 3600)); 
												   $stop_ept_time =date('Y-m-d H:i:s', strtotime($add_eta));
												   if($eta_mins!=0 && $eta_mins < 7)
												   {
													   $tripstart_alert = $this->livetrack_model->stopstart_alert($route_id,$stoplist->stop_id);      //Send Alert to all parents Reach Within 5 mins 
													   if($tripstart_alert)
													   {
														   foreach ($tripstart_alert as $tlist) {
															   $smsdata = array('route_name' =>$tlist->route_name,
															   'route_id' =>$tlist->route_id,
															   'stop_name' =>$stoplatlng->Location_short_name,
															   'stop_id' =>$stop_geoid,
															   'distance' =>$distance,
															   'expected_time' =>$expecttime,
															   'vehicle_number' =>$vehicle_name,
															   'speed' =>$vehicle_speed,
															   'lat'=>$vehicle_lat,
															   'lng' =>$vehicle_lng,
															   'createdon' =>date('Y-m-d H:i:s'),
															   'vehicle_id' =>$vehicle_id,
															   'client_id' =>$client_id,
															   'parent_id' =>$tlist->parent_id,
															   'all_status' =>3,
															   'alert_type' =>'Reach In stop With In 5 Mins',
															   'alert_location'=>$vehiclelatlng->latlon_address
															   );
									   
															   $this->db->insert('sch_sms_alert',$smsdata);
															   $update_status = array('status' => 3);
															   $this->db->where('student_id',$tlist->student_id);
															   $this->db->update('sch_student',$update_status);
															   }
														   }
												   }
							   
											   $livestop_data[] = array('stop_geo_id' =>$stop_geoid,
																		   'client_id' =>$client_id,
																		   'stopplaned_entry' =>$stopplaned_entry,
																		   'stopplaned_exit' =>$stopplaned_exit,
																		   'stopentry_time' =>$stopentry_time,
																		   'stopexit_time' =>$stopexit_time,
																		   'stop_ept_time' =>$stop_ept_time );
											}

											if(empty($route_entry_time))
											{
												
											   $distance =$this->geo_distance($latitude1,$longitude1,$latitude3,$longitude3);
												if($distance < $routeend_radius)
												{
													$date = date('mdHis');
													$trip_id = $date.''.$vehicle_id;
													$data = array(
														"vehicle_id" => $vehicle_id,
														"client_id" => $client_id,
														"trip_id" => $trip_id,
														"lat" => $latitude1,
														"lng" => $longitude1,
														"in_datetime" => date('Y-m-d H:i:s'),
														"speed" => $list->speed,
														"geo_location_id" => $route_endid,
														"g_lat" => $latitude3,
														"g_lng" => $longitude3,
														// "distance" => $list->traveled_distance,
														"ignition_status" => $list->acc_on,
														"location_status" => 1
														);
														$this->db->insert('sch_geofence_report',$data);	
														$update_status = array('status' => 2);
														$this->db->where('route_id',$route_id);
														$this->db->update('sch_routeassigntbl',$update_status);
			
												}
			
											}

										   if($list->status==2 && $route_entry_time!='')
										   {
											   $insert_report = $this->insert_routereport($livedata,$livestop_data);
										   }
									   $livedetails[]= array('liveroute_details' =>$livedata,
									    'livestop_details' =>$livestop_data );				
					   
							   }
						} 
							
				
				}
			}
			elseif ($ct >= $enddate && $ct <= $endshiftdate) {
				
				$update_status = array('status' => 1);
				$this->db->update('sch_routeassigntbl',$update_status);
				$this->db->update('sch_student',$update_status);
			}
			elseif ($ct >= $enddate1 && $ct <= $endshiftdate1) {
				
				$update_status = array('status' => 1);
				$this->db->update('sch_routeassigntbl',$update_status);
				$this->db->update('sch_student',$update_status);
			}

	    } 
		if($livedetails)
		{
			$data['livedetails'] = $livedetails;
			$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
		   //$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'Dashboard/livetrack_dashboard',$data);
			$this->load->view('components/footer/footerscript');
			// $this->load->view('components/footer/footer');
		}
		
		else
		{
			$data['livedetails'] = $livedetails;
			$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
		   //$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'Dashboard/livetrack_dashboard',$data);
			$this->load->view('components/footer/footerscript');
		}
	   }

	public function livetrack_vehicles_test111() 
	{
		
		$customercomplaint= $this->Dashboardmodel->customer_complaint();
		$data['customercomplaint'] = $customercomplaint;
		$accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
 
						$shift_type = 2;
					  	$liveroute_details = $this->livetrack_model->livetrackvehicles($shift_type);      // Get Assign Route Lists
									foreach ($liveroute_details as $list) {

									
											$client_id = $list->client_id;
											$route_id = $list->route_id;
											$vehicle_id = $list->vehicle_id;
											$route_startid = $list->route_geo_start_id;
											$route_endid = $list->route_geo_end_id;
											$shift_type = $list->shift_type;
											$latitude1 =$list->lat;
											$longitude1 =$list->lng;
											$latitude2 =$list->routestart_lat;
											$longitude2 =$list->routestart_lng;

											$latitude3 =$list->routeend_lat;
											$longitude3 =$list->routeend_lng;
											$routestart_radius = $list->routestart_radius;
											$routeend_radius = $list->routeend_radius;
											
											 $route_starttime = date('Y-m-d H:i:s',strtotime($list->route_starttime));
											
								
											$routestartgeo = $this->livetrack_model->routestartgeo($route_startid, $vehicle_id,$route_starttime);
											
											if($routestartgeo==1)
											{
												$distance =$this->geo_distance($latitude1,$longitude1,$latitude2,$longitude2);
											if($distance > $routestart_radius)
											{
												$date = date('mdHis');
					                        	$trip_id = $date.''.$vehicleid;
												$data = array(
													"vehicle_id" => $vehicleid,
													"client_id" => $client_id,
													"trip_id" => $trip_id,
													"lat" => $latitude1,
													"lng" => $longitude1,
													"out_datetime" => date('Y-m-d H:i:s'),
													"speed" => $list->speed,
													"geo_location_id" => $route_startid,
													"g_lat" => $latitude2,
													"g_lng" => $longitude2,
													// "distance" => $list->traveled_distance,
													"ignition_status" => $list->acc_on,
													"location_status" => 2
													);
				
                                                  $this->db->insert('geofence_report',$data);	

											}

											}
												else
											$route_exit_time = $routestartgeo->out_datetime;  //Startroute Exit time
											 $routeplanstart = date('Y-m-d H:i:s',strtotime($list->route_starttime));

											$d1 = new DateTime($route_exit_time);
                                            $d2 = new DateTime($routeplanstart);
											$interval = $d1->diff($d2);
                                            $diffInMinutes = $interval->i; 
											$add_time = ($list->late_status==1) ? $diffInMinutes :0;
										     $add_time = '+ '.$add_time.' minutes'; 
											 $route_endtime = date('Y-m-d H:i:s',strtotime($add_time,strtotime($list->route_endtime)));
											 $routeendgeo = $this->livetrack_model->routeendgeo($route_endid, $vehicle_id,$route_endtime);
											 $route_entry_time = $routeendgeo->in_datetime;     // Startroute Entry time


											if($routeendgeo==1)
											{

											$distance =$this->geo_distance($latitude1,$longitude1,$latitude3,$longitude3);
											if($distance < $routeend_radius)
											{
												$date = date('mdHis');
					                        	$trip_id = $date.''.$vehicleid;
												$data = array(
													"vehicle_id" => $vehicleid,
													"client_id" => $client_id,
													"trip_id" => $trip_id,
													"lat" => $latitude1,
													"lng" => $longitude1,
													"in_datetime" => date('Y-m-d H:i:s'),
													"speed" => $list->speed,
													"geo_location_id" => $route_startid,
													"g_lat" => $latitude3,
													"g_lng" => $longitude3,
													// "distance" => $list->traveled_distance,
													"ignition_status" => $list->acc_on,
													"location_status" => 1
													);
				
                                                  $this->db->insert('geofence_report',$data);	

											}

											}

												if($route_exit_time)
												{

												$route_planstart_time =  date('H:i A',strtotime($add_time,strtotime($list->route_starttime)));
												$route_planend_time =  date('H:i A',strtotime($add_time,strtotime($list->route_endtime)));
												
												$vehiclelatlng = $this->livetrack_model->vehiclelatlng($vehicle_id);
												$routelatlng = $this->livetrack_model->routelatlng($route_endid);
												$routelatlng1 = $this->livetrack_model->routelatlng($route_startid);
												$route_endlat = $routelatlng->Lat;
												$route_endlng = $routelatlng->Lng;
												
												$vehicle_lat = $vehiclelatlng->lat;									//vehicle lat
												$vehicle_lng = $vehiclelatlng->lng;									//vehicle lng
												$vehicle_speed = $vehiclelatlng->speed;                             //vehicle current speed
												$distance = $this->geo_distance($route_endlat,$route_endlng,$vehicle_lat,$vehicle_lng);
												$expecttime = $distance/40;
												$routeend_ept_time =floor($expecttime * 60);     //Hours to minutes Convert
												$add_eta = '+ '.$routeend_ept_time.' Minutes';
												$routeend_ept_time =date('Y-m-d H:i:s',strtotime($add_eta));   // add minus to current datetime
												$vehicle_name = $list->vehiclename;    //Vehicle name
												$routename = $list->route_name;      // Route Name
												
												$tripstart_alert = $this->livetrack_model->tripstart_alert($route_id,$checkid=1);      //Send Alert to all parents Trip Start 
												
												if($tripstart_alert)
												{
													foreach ($tripstart_alert as $tlist) {
								
														$smsdata = array('route_name' =>$tlist->route_name,
														'route_id' =>$tlist->route_id,
														'stop_name' =>$routelatlng1->Location_short_name,
														'stop_id' =>$route_startid,
														'distance' =>$distance,
														'expected_time' =>$expecttime,
														'vehicle_number' =>$vehicle_name,
														'speed' =>$vehicle_speed,
														'lat'=>$vehicle_lat,
														'lng' =>$vehicle_lng,
														'createdon' =>date('Y-m-d H:i:s'),
														'vehicle_id' =>$vehicle_id,
														'client_id' =>$client_id,
														'parent_id' =>$tlist->parent_id,
														'all_status' =>1,
														'alert_type' =>'Trip Start',
														'alert_location'=>$vehiclelatlng->latlon_address
														);
														$this->db->insert('sch_sms_alert',$smsdata);
														$update_status = array('status' => 2);
														$this->db->where('route_id',$tlist->route_id);
														$this->db->update('sch_student',$update_status);
														}
													}
								
													if($route_entry_time)
												{
								
													$tripstart_alert = $this->livetrack_model->tripstart_alert($route_id,$checkid=2);      //Send Alert to all parents Trip End 
													if($tripstart_alert)
													{
														foreach ($tripstart_alert as $tlist) {
															$smsdata = array('route_name' =>$tlist->route_name,
															'route_id' =>$tlist->route_id,
															'stop_name' =>$routelatlng->Location_short_name,
															'stop_id' =>$route_endid,
															'distance' =>$distance,
															'expected_time' =>$expecttime,
															'vehicle_number' =>$vehicle_name,
															'speed' =>$vehicle_speed,
															'lat'=>$vehicle_lat,
															'lng' =>$vehicle_lng,
															'createdon' =>date('Y-m-d H:i:s'),
															'vehicle_id' =>$vehicle_id,
															'client_id' =>$client_id,
															'parent_id' =>$tlist->parent_id,
															'all_status' =>2,
															'alert_type' =>'Trip End',
															'alert_location'=>$vehiclelatlng->latlon_address
															);
									
															$this->db->insert('sch_sms_alert',$smsdata);
															$update_status = array('status' => 4);
															$this->db->where('student_id',$tlist->student_id);
															$this->db->update('sch_student',$update_status);
															}
														}
								
								
												}
								
											
														$livedata = array('vehicle_name' =>$vehicle_name ,
																		'vehicle_id' =>$list->vehicleid ,
																		'client_id' =>$client_id ,
																		'routename' =>$routename,
																		'route_id' =>$route_id	,
																		'route_startid' =>$route_startid,
																		'route_endid' =>$route_endid,
																		'route_planstart_time' =>$route_planstart_time,
																		'route_planend_time' =>$route_planend_time,
																		'route_exitime' =>$route_exit_time,
																		'routeend_exptime' =>$routeend_ept_time,
																		'route_entry_time'=>$route_entry_time,
																		'travel_date'=>date('Y-m-d')
																		);
											$livestop_details= $this->livetrack_model->livestop_details($route_id);
											$livestop_data='';
										

										
											foreach ($livestop_details as $stoplist) {
											
												$stop_geoid =$stoplist->stop_geo_id;
								
												    $stop_arrival_time = date('Y-m-d H:i:s',strtotime($add_time,strtotime($stoplist->stop_arrival_time)));
													$stop_start_time = date('Y-m-d H:i:s', strtotime($add_time,strtotime($stoplist->stop_start_time)));
								
													$stopentry_geotime = $this->livetrack_model->stop_geointime($stop_geoid, $vehicle_id,$stop_arrival_time);
													$stopexit_geotime = $this->livetrack_model->stop_geoouttime($stop_geoid, $vehicle_id,$stop_start_time);
								
													$stopplaned_entry =  date('H:i A',strtotime($add_time,strtotime($stoplist->stop_arrival_time)));
													$stopplaned_exit =  date('H:i A',strtotime($add_time,strtotime($stoplist->stop_start_time)));

													$stopentry_time = $stopentry_geotime->in_datetime;    // Stop Entry Time
													$stopexit_time = $stopexit_geotime->out_datetime;     // Stop Exit Time

													$stoplatlng = $this->livetrack_model->stoplatlng($stop_geoid);
									
													$stop_lat = $stoplatlng->Lat;     // Stop Lat
													$stoplng = $stoplatlng->Lng;      // Stop Lng
													$stop_radius = $stoplatlng->stop_radius;
													if($stopentry_geotime==1)
													{
														$distance = $this->geo_distance($stop_lat,$stoplng,$vehicle_lat,$vehicle_lng);	
														if($distance < $stop_radius)
														{
															$date = date('mdHis');
															$trip_id = $date.''.$vehicleid;
															$data = array(
																"vehicle_id" => $vehicleid,
																"client_id" => $client_id,
																"trip_id" => $trip_id,
																"lat" => $vehicle_lat,
																"lng" => $vehicle_lng,
																"in_datetime" => date('Y-m-d H:i:s'),
																"speed" => $list->speed,
																"geo_location_id" => $stop_geoid,
																"g_lat" => $stop_lat,
																"g_lng" => $stoplng,
																// "distance" => $list->traveled_distance,
																"ignition_status" => $list->acc_on,
																"location_status" => 1
																);
							
															$this->db->insert('geofence_report',$data);	

														}
													}

													if(!empty($stopentry_time) && $stopexit_geotime==1)
													{
														if($stopentry_geotime->location_status == 1 && $stopentry_geotime->geo_location_id == $stop_geoid ){  // last trip end
																if($distance > $stop_radius)
																{

																	$data = array(

																		"out_datetime" =>date('Y-m-d H:i:s'),
																		"location_status" => 2,
																		"distance" => ''
																		);
					 
														$this->db->where('id',$stopentry_geotime->id);
													    $this->db->update('sch_geofence_report_test', $data);

																}
														
			 

														}
													}
													$distance = $this->geo_distance($stop_lat,$stoplng,$vehicle_lat,$vehicle_lng);
													
												
													$expecttime = $distance/40;
													$stop_ept_time =floor($expecttime * 60);    // Hours to minutes Conversion
													$eta_mins =floor($expecttime * 60);
													$add_eta = '+ '.$stop_ept_time.' Minutes';
												//	$stop_ept_time =  gmdate('H:i:s', floor($expecttime * 3600)); 
													$stop_ept_time =date('Y-m-d H:i:s', strtotime($add_eta));
										
												if($eta_mins!=0 && $eta_mins < 7)
												{
								
													$tripstart_alert = $this->livetrack_model->stopstart_alert($route_id,$stoplist->stop_id);      //Send Alert to all parents Reach Within 5 mins 
													if($tripstart_alert)
													{
														foreach ($tripstart_alert as $tlist) {
															$smsdata = array('route_name' =>$tlist->route_name,
															'route_id' =>$tlist->route_id,
															'stop_name' =>$stoplatlng->Location_short_name,
															'stop_id' =>$stop_geoid,
															'distance' =>$distance,
															'expected_time' =>$expecttime,
															'vehicle_number' =>$vehicle_name,
															'speed' =>$vehicle_speed,
															'lat'=>$vehicle_lat,
															'lng' =>$vehicle_lng,
															'createdon' =>date('Y-m-d H:i:s'),
															'vehicle_id' =>$vehicle_id,
															'client_id' =>$client_id,
															'parent_id' =>$tlist->parent_id,
															'all_status' =>3,
															'alert_type' =>'Reach In stop With In 5 Mins',
															'alert_location'=>$vehiclelatlng->latlon_address
															);
									
															$this->db->insert('sch_sms_alert',$smsdata);
															$update_status = array('status' => 3);
															$this->db->where('student_id',$tlist->student_id);
															$this->db->update('sch_student',$update_status);
															}
														}
								
												}
								
												$livestop_data[] = array('stop_geo_id' =>$stop_geoid,
																		'client_id' =>$client_id,
																		'stopplaned_entry' =>$stopplaned_entry,
																		'stopplaned_exit' =>$stopplaned_exit,
																		'stopentry_time' =>$stopentry_time,
																		'stopexit_time' =>$stopexit_time,
																	'stop_ept_time' =>$stop_ept_time );
											}
											if($list->status==1 && $route_entry_time!='')
											{
												$insert_report = $this->insert_routereport($livedata,$livestop_data);
											}
											$livedetails[]= array('liveroute_details' =>$livedata,
																'livestop_details' =>$livestop_data );
								
															
								
										}
									
									
						
						}
				
			
		if($livedetails)
		{
			$data['livedetails'] = $livedetails;
			$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
		   //$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'Dashboard/livetrack_dashboard',$data);
			$this->load->view('components/footer/footerscript');
			// $this->load->view('components/footer/footer');
		}
		
		else
		{
			$data['livedetails'] = $livedetails;
			$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
		   //$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'Dashboard/livetrack_dashboard',$data);
			$this->load->view('components/footer/footerscript');
		}
	}

	public function livetrack_vehicles_test() 
	{
		
		$customercomplaint= $this->Dashboardmodel->customer_complaint();
		$data['customercomplaint'] = $customercomplaint;
		$accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();

		$startdate = date('H:i:A',strtotime('05:00:00'));   // First Start date
		$enddate = date('H:i:A',strtotime('10:00:00'));      // First End date
		$endshiftdate = date('H:i:A',strtotime('10:15:00'));      // First End date

		$startdate1 = date('H:i:A',strtotime('00:00:00'));   // Second Start date
		$enddate1 = date('H:i:A',strtotime('19:00:00'));   // Second End date

		$endshiftdate1 = date('H:i:A',strtotime('19:15:00'));      // First End date

	   $ct =  date('H:i:A');  

	   if(in_array(date('D'),['Sun']))                  // Current date is sunday if condition is true So functions are not workings
	    {


	    } 
		else
		{    /* Current date is not sunday if condition is false So functions are workings */
			

				if (($ct >= $startdate && $ct <= $enddate) || ($ct >= $startdate1 && $ct <= $enddate1))       // True If condition  Between currentdate and therir dates
						{
						$shift_type = ($ct >= $startdate && $ct <= $enddate) ? 1 :2;
					  	$liveroute_details = $this->livetrack_model->livetrackvehicles($shift_type);      // Get Assign Route Lists
					  //   print_r($liveroute_details);exit;
									foreach ($liveroute_details as $list) {

										if(in_array(date('D'),['Sat']) && $list->saturday_status!=1)     // day is saturday and saturday_status is not equal to 1 is means this function saturday not working
										{
								
										} 
										else
										{      // day is saturday and saturday_status is  equal to 1 is means this function saturday working

											$client_id = $list->client_id;
											$route_id = $list->route_id;
											$vehicle_id = $list->vehicle_id;
											$route_startid = $list->route_geo_start_id;
											$route_endid = $list->route_geo_end_id;
											$shift_type = $list->shift_type;
								
											//  $route_starttime = date('Y-m-d H:i:s',strtotime($list->route_starttime));
											$route_starttime = date('Y-m-d H:i:s',strtotime('-4 days',strtotime($list->route_starttime)));
											
								
											$routestartgeo = $this->livetrack_model->routestartgeo($route_startid, $vehicle_id,$route_starttime);
											$route_exit_time = $routestartgeo->out_datetime;  //Startroute Exit time
											 $routeplanstart = date('Y-m-d H:i:s',strtotime($list->route_starttime));

											$d1 = new DateTime($route_exit_time);
                                            $d2 = new DateTime($routeplanstart);
											$interval = $d1->diff($d2);
                                            $diffInMinutes = $interval->i; 
											$add_time = ($list->late_status==1) ? $diffInMinutes :0;
										     $add_time = '+ '.$add_time.' minutes'; 
											 $route_endtime = date('Y-m-d H:i:s',strtotime('-4 days',strtotime($list->route_endtime)));
											
								
											//  $route_endtime = date('Y-m-d H:i:s',strtotime($add_time,strtotime($list->route_endtime)));
											 $routeendgeo = $this->livetrack_model->routeendgeo($route_endid, $vehicle_id,$route_endtime);
												$route_entry_time = $routeendgeo->in_datetime;     //Startroute Entry time
												if($route_exit_time)
												{
													 $route_planstart_time =  date('H:i A',strtotime($add_time,strtotime($list->route_starttime)));
													 $route_planend_time =  date('H:i A',strtotime($add_time,strtotime($list->route_endtime)));
												
												$vehiclelatlng = $this->livetrack_model->vehiclelatlng($vehicle_id);
												$routelatlng = $this->livetrack_model->routelatlng($route_endid);
												$routelatlng1 = $this->livetrack_model->routelatlng($route_startid);
												$route_endlat = $routelatlng->Lat;
												$route_endlng = $routelatlng->Lng;
												
												$vehicle_lat = $vehiclelatlng->lat;									//vehicle lat
												$vehicle_lng = $vehiclelatlng->lng;									//vehicle lng
												$vehicle_speed = $vehiclelatlng->speed;                             //vehicle current speed
												$distance = $this->geo_distance($route_endlat,$route_endlng,$vehicle_lat,$vehicle_lng);
												$expecttime = $distance/40;
												$routeend_ept_time =floor($expecttime * 60);     //Hours to minutes Convert
												$add_eta = '+ '.$routeend_ept_time.' Minutes';
												$routeend_ept_time =date('Y-m-d H:i:s',strtotime($add_eta));   // add minus to current datetime
												$vehicle_name = $list->vehiclename;    //Vehicle name
												$routename = $list->route_name;      // Route Name
												
												$tripstart_alert = $this->livetrack_model->tripstart_alert($route_id,$checkid=1);      //Send Alert to all parents Trip Start 
												
												if($tripstart_alert)
												{
													foreach ($tripstart_alert as $tlist) {
								
														$smsdata = array('route_name' =>$tlist->route_name,
														'route_id' =>$tlist->route_id,
														'stop_name' =>$routelatlng1->Location_short_name,
														'stop_id' =>$route_startid,
														'distance' =>$distance,
														'expected_time' =>$expecttime,
														'vehicle_number' =>$vehicle_name,
														'speed' =>$vehicle_speed,
														'lat'=>$vehicle_lat,
														'lng' =>$vehicle_lng,
														'createdon' =>date('Y-m-d H:i:s'),
														'vehicle_id' =>$vehicle_id,
														'client_id' =>$client_id,
														'parent_id' =>$tlist->parent_id,
														'all_status' =>1,
														'alert_type' =>'Trip Start',
														'alert_location'=>$vehiclelatlng->latlon_address
														);
														// $this->db->insert('sch_sms_alert',$smsdata);
														// $update_status = array('status' => 2);
														// $this->db->where('route_id',$tlist->route_id);
														// $this->db->update('sch_student',$update_status);
														}
													}
								
													if($route_entry_time)
												{
								
													$tripstart_alert = $this->livetrack_model->tripstart_alert($route_id,$checkid=2);      //Send Alert to all parents Trip End 
													if($tripstart_alert)
													{
														foreach ($tripstart_alert as $tlist) {
															$smsdata = array('route_name' =>$tlist->route_name,
															'route_id' =>$tlist->route_id,
															'stop_name' =>$routelatlng->Location_short_name,
															'stop_id' =>$route_endid,
															'distance' =>$distance,
															'expected_time' =>$expecttime,
															'vehicle_number' =>$vehicle_name,
															'speed' =>$vehicle_speed,
															'lat'=>$vehicle_lat,
															'lng' =>$vehicle_lng,
															'createdon' =>date('Y-m-d H:i:s'),
															'vehicle_id' =>$vehicle_id,
															'client_id' =>$client_id,
															'parent_id' =>$tlist->parent_id,
															'all_status' =>2,
															'alert_type' =>'Trip End',
															'alert_location'=>$vehiclelatlng->latlon_address
															);
									
															// $this->db->insert('sch_sms_alert',$smsdata);
															// $update_status = array('status' => 4);
															// $this->db->where('student_id',$tlist->student_id);
															// $this->db->update('sch_student',$update_status);
															}
														}
								
								
												}
								
											
														$livedata = array('vehicle_name' =>$vehicle_name ,
																		'vehicle_id' =>$list->vehicleid ,
																		'client_id' =>$client_id ,
																		'routename' =>$routename,
																		'route_id' =>$route_id	,
																		'route_startid' =>$route_startid,
																		'route_endid' =>$route_endid,
																		'route_planstart_time' =>$route_planstart_time,
																		'route_planend_time' =>$route_planend_time,
																		'route_exitime' =>$route_exit_time,
																		'routeend_exptime' =>$routeend_ept_time,
																		'route_entry_time'=>$route_entry_time,
																		'travel_date'=>date('Y-m-d')
																		);
											$livestop_details= $this->livetrack_model->livestop_details($route_id);
											$livestop_data='';
										

										
											foreach ($livestop_details as $stoplist) {
											
												$stop_geoid =$stoplist->stop_geo_id;
								
											    	$stop_arrival_time = date('Y-m-d H:i:s',strtotime('-4 days',strtotime($add_time,strtotime($stoplist->stop_arrival_time))));
											        $stop_start_time = date('Y-m-d H:i:s',strtotime('-4 days',strtotime($add_time,strtotime($stoplist->stop_start_time))));
											

												    // $stop_arrival_time = date('Y-m-d H:i:s',strtotime($add_time,strtotime($stoplist->stop_arrival_time)));
													// $stop_start_time = date('Y-m-d H:i:s', strtotime($add_time,strtotime($stoplist->stop_start_time)));
								
													$stopentry_geotime = $this->livetrack_model->stop_geointime($stop_geoid, $vehicle_id,$stop_arrival_time);
													$stopexit_geotime = $this->livetrack_model->stop_geoouttime($stop_geoid, $vehicle_id,$stop_start_time);
								
													$stopplaned_entry =  date('H:i A',strtotime($add_time,strtotime($stoplist->stop_arrival_time)));
													$stopplaned_exit =  date('H:i A',strtotime($add_time,strtotime($stoplist->stop_start_time)));

												$stopentry_time = $stopentry_geotime->in_datetime;    // Stop Entry Time
												$stopexit_time = $stopexit_geotime->out_datetime;     // Stop Exit Time
								
												$stoplatlng = $this->livetrack_model->stoplatlng($stop_geoid);
								
												$stop_lat = $stoplatlng->Lat;     // Stop Lat
												$stoplng = $stoplatlng->Lng;      // Stop Lng
												$distance = $this->geo_distance($stop_lat,$stoplng,$vehicle_lat,$vehicle_lng);
												
															$expecttime = $distance/40;
															$stop_ept_time =floor($expecttime * 60);    // Hours to minutes Conversion
															$eta_mins =floor($expecttime * 60);
															$add_eta = '+ '.$stop_ept_time.' Minutes';
														//	$stop_ept_time =  gmdate('H:i:s', floor($expecttime * 3600)); 
															$stop_ept_time =date('Y-m-d H:i:s', strtotime($add_eta));
												
												if($eta_mins!=0 && $eta_mins < 7)
												{
								
													$tripstart_alert = $this->livetrack_model->stopstart_alert($route_id,$stoplist->stop_id);      //Send Alert to all parents Reach Within 5 mins 
													if($tripstart_alert)
													{
														foreach ($tripstart_alert as $tlist) {
															$smsdata = array('route_name' =>$tlist->route_name,
															'route_id' =>$tlist->route_id,
															'stop_name' =>$stoplatlng->Location_short_name,
															'stop_id' =>$stop_geoid,
															'distance' =>$distance,
															'expected_time' =>$expecttime,
															'vehicle_number' =>$vehicle_name,
															'speed' =>$vehicle_speed,
															'lat'=>$vehicle_lat,
															'lng' =>$vehicle_lng,
															'createdon' =>date('Y-m-d H:i:s'),
															'vehicle_id' =>$vehicle_id,
															'client_id' =>$client_id,
															'parent_id' =>$tlist->parent_id,
															'all_status' =>3,
															'alert_type' =>'Reach In stop With In 5 Mins',
															'alert_location'=>$vehiclelatlng->latlon_address
															);
									
															//$this->db->insert('sch_sms_alert',$smsdata);
															$update_status = array('status' => 3);
														//	$this->db->where('student_id',$tlist->student_id);
														//	$this->db->update('sch_student',$update_status);
															}
														}
								
												}
								
												$livestop_data[] = array('stop_geo_id' =>$stop_geoid,
																		'client_id' =>$client_id,
																		'stopplaned_entry' =>$stopplaned_entry,
																		'stopplaned_exit' =>$stopplaned_exit,
																		'stopentry_time' =>$stopentry_time,
																		'stopexit_time' =>$stopexit_time,
																	'stop_ept_time' =>$stop_ept_time );
											}
											if($list->status==1 && $route_entry_time!='')
											{
												//$insert_report = $this->insert_routereport($livedata,$livestop_data);
											}
											$livedetails[]= array('liveroute_details' =>$livedata,
																'livestop_details' =>$livestop_data );
								
															
								
										}
									
										}
										
						
						}
				
				}
				elseif ($ct >= $enddate && $ct <= $endshiftdate) {
					
					$update_status = array('status' => 1);
					$this->db->update('sch_routeassigntbl',$update_status);
					$this->db->update('sch_student',$update_status);
				}
				elseif ($ct >= $enddate1 && $ct <= $endshiftdate1) {
					
					$update_status = array('status' => 1);
					$this->db->update('sch_routeassigntbl',$update_status);
					$this->db->update('sch_student',$update_status);
				}

		}
		
		if($livedetails)
		{
			$data['livedetails'] = $livedetails;
			$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
		   //$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'Dashboard/livetrack_dashboard',$data);
			$this->load->view('components/footer/footerscript');
			// $this->load->view('components/footer/footer');
		}
		
		else
		{
			$data['livedetails'] = $livedetails;
			$data['nodata'] = $nodata;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
		   //$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'Dashboard/livetrack_dashboard',$data);
			$this->load->view('components/footer/footerscript');
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

		 return  $v_dis = $v_dis;
	}
	public function insert_routereport($routelist,$stoplist)
	{
		$route_startplantime = substr($routelist['route_planstart_time'], 0, -2);
		$route_endplantime =  substr($routelist['route_planend_time'], 0, -2);
		unset($routelist['route_planstart_time']);
		unset($routelist['route_planend_time']);
        
		$routelist['route_planstart_time']  =date('Y-m-d H:i:s',strtotime($route_startplantime));
		$routelist['route_planend_time']  =date('Y-m-d H:i:s',strtotime($route_endplantime));

		$this->db->insert('sch_add_liveroute_list',$routelist);
		$lastid = $this->db->insert_id();

		foreach ($stoplist as $slist) {

				$stop_planentry = date('Y-m-d H:i:s',strtotime(substr($slist['stopplaned_entry'], 0, -2)));
				$stop_planexit = date('Y-m-d H:i:s',strtotime(substr($slist['stopplaned_exit'], 0, -2)));

			$livestop_data = array(
			'live_routeid' =>$lastid,
			'client_id' =>$slist['client_id'],		
			'stop_geo_id' =>$slist['stop_geo_id'],
			'stopplaned_entry' =>$stop_planentry,
			'stopplaned_exit' =>$stop_planexit,
			 'stopentry_time' =>$slist['stopentry_time'],
			 'stopexit_time' =>$slist['stopexit_time'],
		   'stop_ept_time' =>$slist['stop_ept_time'],
		   'travel_date'=>date('Y-m-d') );
			$this->db->insert('sch_add_livestop_list',$livestop_data);
   
		}
		$update_status = array('status' => 3);
		$this->db->where('route_id',$routelist['route_id']);
		$this->db->update('sch_routeassigntbl',$update_status);
		//$stoplist['live_routeid'] = $this->db->insert_id();
	
	}
	public function playback_details()
	{
		$Text = urldecode($_REQUEST['data']);
		$data['livetrack_playback'] = json_decode($Text);

			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
		//	$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'Dashboard/livetrack_playback',$data);
			$this->load->view('components/footer/footerscript');

		
	}

	public function get_all_history()
	{
		$vid = $this->input->post('vehicle');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$to_date = ($to_date=='') ? date('Y-m-d H:i:s') :$to_date;

		$fromtime = strtotime($from_date);
		$totime = strtotime($to_date);
		$from = date('Y-m-d H:i:s',$fromtime);
		$todate = date('Y-m-d H:i:s',$totime);
		

		$history_result = $this->livetrack_model->get_all_history_data($vid,$from,$todate);	

				 
		echo json_encode($history_result);					

	}

	
    function single_vehicledata($id){
		
		$result = $this->Dashboardmodel->single_vehicle_data($id);// get vehicle data from vehicle table 
        
        if($result->odometer==''){ $odo = 0;}else{$odo = $result->odometer;}
 
        $device_type = $result->device_type;
             $vehicle_shortname = $this->Dashboardmodel->vehicle_shortname($result->vehicletype);


        $data = array('lat'=>round($result->lat,5),'lng'=>round($result->lng,5),
                     'angle'=>$result->angle,'vehicleid'=>$result->vehicleid,'vehiclename'=>$result->vehiclename,
                     'speed'=>$result->speed,'updatedon'=>$result->updatedon,'update_time'=>$result->update_time,
                      'acc_on'=>$result->acc_on,'odometer'=>$odo,
                      'car_battery'=>$result->car_battery,'device_battery'=>$result->device_battery,
					  'vehicle_shortname'=>$vehicle_shortname,'latlon_address'=>trim($result->latlon_address));    

        if($data){
            
            echo json_encode($data);//convert to json format for ajax call
        }else{
            echo 'false';
        }
   }

   public function routelatlngs()
   {
	 $route_id = $this->input->post('route_id');

	   $route_latlng = $this->livetrack_model->route_latlng($route_id);	
	   $stop_latlng = $this->livetrack_model->stop_latlng($route_id);
	   foreach ($stop_latlng as $slist) {

		$stop_id = $this->livetrack_model->stopid_list($route_latlng->route_id,$slist->stop_geo_id);
		$student_count = $this->livetrack_model->student_stop_count($route_latlng->route_id,$stop_id);
		$stop_list[] = array('stop_latlng' => $slist,
		                     'student_count' =>$student_count) ;
		//$stop_list['student_count'] = $student_count;
		
	   }	
	  // print_r($stop_list);exit;				
	   $latlngs = array('route_latlng' =>$route_latlng,
	                    'stop_latlng' =>$stop_list);
						
	   echo json_encode($latlngs);					

   }



	public function reportplayback_details()
	{
		$Text = urldecode($_REQUEST['data']);
		$data['livetrack_playback'] = json_decode($Text);

			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
		//	$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'reports/specific_report/livetrack_playbackreport',$data);
			$this->load->view('components/footer/footerscript');

		
	}

	public function get_park_history()
	{

		$vid = $this->input->post('vehicle');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$fromtime = strtotime($from_date);
		$totime = strtotime($to_date);
		$from = date('Y-m-d H:i:s',$fromtime);
		$todate = date('Y-m-d H:i:s',$totime);
		

		$history_result = $this->genericreport_model->get_park_history_data($vid,$from,$todate);	
		
		echo json_encode($history_result);					

	}

}
