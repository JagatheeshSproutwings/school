<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Api_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	public function checkuser($username,$password)
	{		

		 $query=$this->db->query("SELECT userid,firstname,username,companyname,mobilenumber,email,roleid,client_id,dealer_id,subdealer_id,push_code,time_zone FROM usertbl WHERE status=1 AND clienttype='School_parent' AND username='$username' AND (password='$password' OR secondarypassword='$password')" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}


	public function checkuser1($userid)
	{		
		 $query=$this->db->query("SELECT userid,firstname,username,companyname,mobilenumber,email,roleid,client_id,dealer_id,subdealer_id,push_code,time_zone FROM usertbl WHERE status=1 AND clienttype='School_parent' AND userid=$userid" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}


    public function livetrackvehiclelist($userid)
	{		
    
		 $query=$this->db->query("SELECT ss.student_id,ss.student_name,ss.student_rollno,ss.parent_id,ss.stop_id,ss.route_id,ss.class_id,ss.section_id,srt.route_name,v.vehicleid as vehicle_id,srt.route_geo_start_id,
         l.Location_short_name as start_loc_name,l.Lat as routestartlat,l.Lng as routestartlng,l1.Location_short_name as end_loc_name,l1.Lat as routeendlat,l1.Lng as routeendlng,
         srt.route_geo_end_id,srt.route_starttime,srt.route_endtime,v.vehiclename,v.deviceimei,v.client_id
          FROM sch_student ss INNER JOIN sch_routeassigntbl sr ON sr.route_id = ss.route_id INNER JOIN sch_routestbl srt ON srt.route_id = ss.route_id 
          INNER JOIN vehicletbl_2 v ON sr.vehicle_id = v.vehicleid INNER JOIN sch_location_list l ON l.Location_Id=srt.route_geo_start_id 
          INNER JOIN sch_location_list l1 ON l1.Location_Id=srt.route_geo_end_id WHERE ss.parent_id =$userid GROUP BY ss.student_id" );

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}



	public function routestartgeo($route_startid,$vehicle_id,$route_starttime) 
	{		
		   $client_id = $this->session->userdata['client_id'];

				$first_start_time = date('Y-m-d H:i:s',strtotime('- 40 minutes',strtotime($route_starttime)));
				$first_end_time =  date('Y-m-d H:i:s',strtotime('+ 70 minutes',strtotime($route_starttime)));
	
	    	$query = $this->db->query("select g_lat,g_lng,out_datetime from sch_geofence_report where geo_location_id ='$route_startid' and vehicle_id = '$vehicle_id' and out_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");
			if ($query->num_rows() > 0) 
			{
				return $query->row();
			}
			else 
			{
				return false;
			}
	}


		public function routeendgeo($route_endid,$vehicle_id,$route_endtime) 
	{		
		$client_id = $this->session->userdata['client_id'];

	
			$first_start_time = date('Y-m-d H:i:s',strtotime('- 40 minutes',strtotime($route_endtime)));
			$first_end_time =  date('Y-m-d H:i:s',strtotime('+ 40 minutes',strtotime($route_endtime)));

			$query = $this->db->query("select g_lat,g_lng,in_datetime from sch_geofence_report where geo_location_id ='$route_endid' and vehicle_id = '$vehicle_id' and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");
	
	

		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}

	


	// public function routestartgeo($route_startid,$vehicle_id,$shift_type) 
	// {		
	// 	   $client_id = $this->session->userdata['client_id'];

	// 	    if($shift_type==1)
	// 		{
	// 			$first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
	// 			$first_end_time = date('Y-m-d H:i:s',strtotime('11:00:00'));
	// 		}
	// 		else
	// 		{
	// 			$first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
	// 			$first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
	// 		}
	// 			// $first_start_time = '2022-06-08 00:00:00';
	// 			// $first_end_time ='2022-06-08 23:59:00';
	//     	$query = $this->db->query("select g_lat,g_lng,out_datetime from sch_geofence_report where geo_location_id ='$route_startid' and vehicle_id = '$vehicle_id' and out_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");
	// 		if ($query->num_rows() > 0) 
	// 		{
	// 			return $query->row();
	// 		}
	// 		else 
	// 		{
	// 			return false;
	// 		}
	// }


	// 	public function routeendgeo($route_endid,$vehicle_id,$shift_type) 
	// {		
	// 	$client_id = $this->session->userdata['client_id'];


	// 		 if($shift_type==1)
	// 		 {
	// 			 $first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
	// 			 $first_end_time = date('Y-m-d H:i:s',strtotime('11:00:00'));
	// 		 }
	// 		 else
	// 		 {
	// 			 $first_start_time = date('Y-m-d H:i:s',strtotime('17:00:00'));
	// 			 $first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
	// 		 }

    //         // $first_start_time = '2022-06-08 00:00:00';
    //         // $first_end_time ='2022-06-08 23:59:00';
	// 		$query = $this->db->query("select g_lat,g_lng,in_datetime from sch_geofence_report where geo_location_id ='$route_endid' and vehicle_id = '$vehicle_id' and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");
	
	

	// 	if ($query->num_rows() > 0) 
	// 	{
	// 		return $query->row();
	// 	}
	// 	else 
	// 	{
	// 		return false;
	// 	}
	// }

	public function routelatlng($route_endid,$client_id) 
	{		
	//	$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT Lat,Lng,Location_short_name FROM sch_location_list WHERE Location_Id ='$route_endid'");

	
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
		public function vehiclelatlng($vehicle_id) 
	{		
		// $client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT lat,lng,speed,latlon_address FROM vehicletbl WHERE vehicleid ='".$vehicle_id."'");

	//echo "SELECT lat,lng FROM vehicle WHERE vehicle_id ='$vehicle_id' AND client_id = '$client_id'";exit;
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}

public function livestop_details($route_id,$stop_id) 
{		
	$client_id = $this->session->userdata['client_id'];
	$query = $this->db->query("SELECT sr.*,l.Location_short_name as stop_name,l.Lat as stoplat,l.Lng as stoplng FROM sch_routestoptbl sr INNER JOIN sch_location_list l ON l.Location_Id=sr.stop_geo_id WHERE sr.route_id=$route_id AND sr.stop_id ='$stop_id'");
	//echo "SELECT * FROM route_stops WHERE route_id ='$route_id' AND client_id = '$client_id'";exit;
	
	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}


public function stop_geointime($stop_geoid,$vehicle_id,$stop_arrival_time) 
{			
	$first_start_time = date('Y-m-d H:i:s',strtotime('- 40 minutes',strtotime($stop_arrival_time)));
	$first_end_time =  date('Y-m-d H:i:s',strtotime('+ 40 minutes',strtotime($stop_arrival_time)));

		 $query = $this->db->query("select g_lat,g_lng,in_datetime from sch_geofence_report where geo_location_id ='$stop_geoid' and vehicle_id = '$vehicle_id' and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");

	if ($query->num_rows() > 0) 
	{
		return $query->row();
	}
	else 
	{
		return false;
	}
}

public function stop_geoouttime($stop_geoid,$vehicle_id,$stop_start_time) 
{		
	$first_start_time = date('Y-m-d H:i:s',strtotime('- 40 minutes',strtotime($stop_start_time)));
	$first_end_time =  date('Y-m-d H:i:s',strtotime('+ 40 minutes',strtotime($stop_start_time)));


	 $query = $this->db->query("select g_lat,g_lng,out_datetime from sch_geofence_report where geo_location_id ='$stop_geoid' and vehicle_id = '$vehicle_id' and out_datetime BETWEEN ' $first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");
	 

	if ($query->num_rows() > 0) 
	{
		return $query->row();
	}
	else 
	{
		return false;
	}
}


// public function stop_geointime($stop_geoid,$vehicle_id,$shift_type) 
// {			
// 	 if($shift_type==1)
// 	{
// 		$first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
// 		$first_end_time = date('Y-m-d H:i:s',strtotime('11:00:00'));
// 	}
// 	else
// 	{
// 		$first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
// 		$first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
// 	}

//     // $first_start_time = '2022-06-08 00:00:00';
//     // $first_end_time ='2022-06-08 23:59:00';

// 		 $query = $this->db->query("select g_lat,g_lng,in_datetime from sch_geofence_report where geo_location_id =$stop_geoid and vehicle_id = $vehicle_id and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");
      
// 	if ($query->num_rows() > 0) 
// 	{
// 		return $query->row();
// 	}
// 	else 
// 	{
// 		return false;
// 	}
// }

// public function stop_geoouttime($stop_geoid,$vehicle_id,$shift_type) 
// {		
		
// 	if($shift_type==1)
// 	{
// 		$first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
// 		$first_end_time = date('Y-m-d H:i:s',strtotime('11:00:00'));
// 	}
// 	else
// 	{
// 		$first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
// 		$first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
// 	}

// 	        //    $first_start_time = '2022-06-08 00:00:00';
// 			// 	$first_end_time ='2022-06-08 23:59:00';
// 	 $query = $this->db->query("select g_lat,g_lng,out_datetime from sch_geofence_report where geo_location_id ='$stop_geoid' and vehicle_id = '$vehicle_id' and out_datetime BETWEEN ' $first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");
	 

// 	if ($query->num_rows() > 0) 
// 	{
// 		return $query->row();
// 	}
// 	else 
// 	{
// 		return false;
// 	}
// }

		public function stoplatlng($stop_geoid) 
	{		
		//$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT Lat,Lng,Location_short_name FROM sch_location_list WHERE Location_Id ='$stop_geoid'");

	
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}

	public function playback_data($d_id, $from, $to,$client_id,$timezone_hours) {

		
		$play_table = "play_back_history_" . $client_id;
		$qry = $this->db->query("SHOW TABLES LIKE '" . $play_table . "'");
		if ($qry->num_rows() > 0) {
			$query = $this->db->query ("SELECT p.odometer,p.lat_message,p.lon_message,p.speed,p.acc_status,(p.modified_date + INTERVAL $timezone_hours MINUTE) as modified_date,p.angle,p.zap as address FROM play_back_history p INNER JOIN vehicletbl v ON v.deviceimei = p.running_no
			WHERE p.running_no =$d_id AND p.lat_message!='000000000' AND p.lon_message!='000000000' AND p.lat_message!='0' AND
			p.lon_message!='0' AND p.lat_message!='0.0' AND p.lon_message!='0.0' AND (p.modified_date + INTERVAL $timezone_hours MINUTE)
			BETWEEN '".$from."' AND '".$to."' UNION SELECT
			ps.odometer,ps.lat_message,ps.lon_message,ps.speed,ps.acc_status,(ps.modified_date + INTERVAL $timezone_hours MINUTE),ps.angle,ps.zap as address FROM ".$play_table." ps INNER JOIN vehicletbl v ON v.deviceimei = ps.running_no WHERE
			ps.running_no =$d_id AND
			ps.lat_message!='000000000' AND ps.lon_message!='000000000' AND ps.lat_message!='0' AND ps.lon_message!='0' AND ps.lat_message!='0.0'
			AND
			ps.lon_message!='0.0' AND (ps.modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '".$from."' AND '".$to."' 
			ORDER BY modified_date ASC");
            
		} else {
			$query = $this->db->query("SELECT p.odometer,p.lat_message,p.lon_message,p.speed,p.acc_status,(p.modified_date + INTERVAL $timezone_hours MINUTE) as modified_date,p.angle,p.zap as address FROM play_back_history p INNER JOIN 
			vehicletbl v ON v.deviceimei = p.running_no WHERE p.running_no =$d_id AND p.lat_message!='000000000' AND 
			p.lon_message!='000000000' AND p.lat_message!='0' AND p.lon_message!='0' AND p.lat_message!='0.0' AND p.lon_message!='0.0' 
			AND (p.modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '".$from."' AND '".$to."'  ORDER BY p.modified_date ASC");
		}
	
	
	
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
    public function vehicletype_data($deviceimei)
{		
     $query=$this->db->query("SELECT vehicletype FROM vehicletbl_2 WHERE status=1 AND deviceimei=$deviceimei" );

    if($query->num_rows() > 0)
    {
        $data = $query->row();
        return $data->vehicletype;
    }
    else
    {
        return false;
    }
}

public function class_section_name($class_id,$section_id) 
{		
    $client_id = $this->session->userdata['client_id'];
    $query = $this->db->query("SELECT s.section_name,c.class_name FROM sch_section s INNER JOIN sch_class c ON c.class_id = s.class_id WHERE s.section_id=$section_id AND s.class_id = $class_id ");


    if ($query->num_rows() > 0) 
    {
        return $query->row();
    }
    else 
    {
        return false;
    }
}

public function userlist($userid,$client_id)
{		

     $query=$this->db->query("SELECT c.client_name as schoolname,u.firstname as fathername,u.lastname as mothername,u.mobilenumber,u.email,u.postaladdres as address,u.pincode FROM usertbl u INNER JOIN clienttbl c ON c.client_id = u.client_id WHERE u.status=1 AND u.userid=$userid" );

    if($query->num_rows() > 0)
    {
        return $query->row();
    }
    else
    {
        return false;
    }
}
public function student_list($userid)
{		

     $query=$this->db->query("SELECT stu.student_name,stu.student_rollno,c.class_name,sec.section_name FROM sch_student stu inner join sch_class c on c.class_id = stu.class_id 
     inner join sch_section sec on sec.section_id = stu.section_id WHERE stu.parent_id=$userid" );

    if($query->num_rows() > 0)
    {
        return $query->result();
    }
    else
    {
        return false;
    }
}

public function notification_alert($userid)
{		

	 $query=$this->db->query("SELECT alert_type,stop_name,vehicle_number as vehiclename,createdon as alertdatetime,lat as lattitute,lng as longitute,alert_location FROM sch_sms_alert WHERE status=1 AND parent_id=$userid ORDER BY sms_alert_id DESC LIMIT 15" );

	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return false;
	}
}


public function vehicle_details($deviceimei)
{		
	 $query=$this->db->query("SELECT vehicle_type,client_id,alarm_set,updatedon,TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,ROUND(odometer,3) as odometer,vehicle_sleep,COALESCE(driver_name,'N/A') as driver_name,vehicle_id,angle,vehicle_register_number,ROUND(car_battery,2) as car_battery,last_ign_off,last_ign_on,ROUND(fuel_ltr-1.8,2) as fuel_ltr,mileage,speed,COALESCE(meter,'0') as meter,acc_on,lat,lng,ac_flag,v_running_no,today_km, COALESCE(ROUND(today_km,3),'0') as kilometer,COALESCE(keyword,'0') as fuel_mlge,COALESCE(ROUND((litres*keyword),1),'N/A') as DTE,COALESCE(hub_ETA,'N/A') as hub_ETA,COALESCE(mdvr_trml_with_servr,'0') as mdvr_trml_with_servr,COALESCE(mdvr_terminal_no,'0') as mdvr_terminal_no,COALESCE(latlon_address,'') as latlon_address,idle_alerttime,parking_alerttime, fuel_fill_limit, fuel_dip_limit,overspeed_limit,sim_number,COALESCE(last_engine_duration,'') as last_engine_duration,COALESCE(today_engine_duration,'') as today_engine_duration,temp_min,temp_max,'raju' as drivername,'96854545454' as drivermobilenumber FROM view_vehicles where v_running_no=$deviceimei" );

	if($query->num_rows() > 0)
	{
		return $query->row();
	}
	else
	{
		return false;
	}
}



public function history_alldata($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{

   // print_r($client_id);die;
  if($vehicle==0)
  {  
// echo"hii";die;
	if($role==6)
	{
		$query =  $this->db->query("SELECT 
		(SELECT SUM(DISTINCT d.`distance_km`) FROM consolidate_distance_report d INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as distance,
		(SELECT SUM(DISTINCT d.`moving_duration`) FROM consolidate_ign_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as moving_duration,
		(SELECT SUM(DISTINCT d.`idel_duration`) FROM consolidate_idle_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid ) as idle_duration,
		(SELECT SUM(DISTINCT d.`parking_duration`) FROM consolidate_park_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as parking_duration,
		(SELECT SUM(DISTINCT d.`running_duration`) FROM consolidate_ac_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as ac_duration,
		(SELECT SUM(DISTINCT d.`fuel_consumed_litre`) FROM consolidate_fuelcosumed_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_consumed_litre,
		(SELECT SUM(DISTINCT d.`fuel_millege`) FROM consolidate_fuelcosumed_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_milege,
		(SELECT SUM(DISTINCT d.`fuel_fill_litre`) FROM consolidate_fuelfill_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_fill_litre,
		(SELECT SUM(DISTINCT d.`fuel_dip_litre`) FROM consolidate_fueldip_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_dip_litre,
		(SELECT SUM(DISTINCT d.normal_rpm+ d.under_load+ d.idle_rpm) FROM consolidate_rpm_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicle_id 
		WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' AND d.client_id=$client_id AND a.owner_id=$userid) as totalrpm
		");
	}
	else
	{
		//echo"hii";die;
		$query =  $this->db->query("SELECT (SELECT SUM(distance_km) FROM consolidate_distance_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as distance,
		(SELECT SUM(moving_duration) FROM consolidate_ign_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as moving_duration,
		(SELECT SUM(idel_duration) FROM consolidate_idle_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as idle_duration,
		(SELECT SUM(parking_duration) FROM consolidate_park_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as parking_duration,
		(SELECT SUM(running_duration) FROM consolidate_ac_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as ac_duration,
		(SELECT SUM(fuel_consumed_litre) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as fuel_consumed_litre,
		(SELECT SUM(fuel_millege) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as fuel_milege,
		(SELECT SUM(fuel_fill_litre) FROM consolidate_fuelfill_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as fuel_fill_litre,
		(SELECT SUM(fuel_dip_litre) FROM consolidate_fueldip_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as fuel_dip_litre,
		(SELECT SUM(normal_rpm+under_load+idle_rpm) FROM consolidate_rpm_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  ) as totalrpm
		");

	}

  }
  else
  {
	//print_r($from_date);die;
	//echo"hii";die;
	$query =  $this->db->query("SELECT (SELECT SUM(distance_km) FROM consolidate_distance_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  AND imei=$vehicle) as distance,
	(SELECT SUM(moving_duration) FROM consolidate_ign_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as moving_duration,
	(SELECT SUM(idel_duration) FROM consolidate_idle_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as idle_duration,
	(SELECT SUM(parking_duration) FROM consolidate_park_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as parking_duration,
	(SELECT SUM(running_duration) FROM consolidate_ac_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as ac_duration,
	(SELECT SUM(fuel_consumed_litre) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_consumed_litre,
	(SELECT SUM(fuel_millege) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_milege,
	(SELECT SUM(fuel_fill_litre) FROM consolidate_fuelfill_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_fill_litre,
	(SELECT SUM(fuel_dip_litre) FROM consolidate_fueldip_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_dip_litre,
	(SELECT SUM(normal_rpm+under_load+idle_rpm) FROM consolidate_rpm_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND deviceimei=$vehicle ) as totalrpm,
	(SELECT AVG(speed) FROM play_back_history WHERE created_date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND running_no=$vehicle ) as average_speed,
	(SELECT MAX(speed) FROM play_back_history WHERE created_date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND running_no=$vehicle ) as maximum_speed
	");
	//print_r($query);die;
  }

	if($query){
	  if ($query->num_rows() > 0)
			{
				//echo"hi";die;
				return $query->row();
			}              
	}else{
		 return array(); }
	   
}
	
}