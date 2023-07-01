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

public function checkuser_admin($username,$password)
	{		

		 $query=$this->db->query("SELECT u.userid,u.firstname,u.username,u.companyname,u.mobilenumber,u.email,u.roleid,u.client_id,u.dealer_id,u.subdealer_id,u.push_code,u.time_zone 
         FROM usertbl u
         WHERE u.status=1 AND u.roleid='15' AND u.username='$username' AND (u.password='$password' OR u.secondarypassword='$password')" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

    public function checkuser_apikey($dealer_id,$apikey)
    {
        if($dealer_id == NULL)
        {

            $query = $this->db->query("SELECT * FROM apikey WHERE dealer_id IS NULL AND apikey = '$apikey' ");

        }else{

            $query = $this->db->query("SELECT * FROM apikey WHERE dealer_id ='$dealer_id' AND apikey ='$apikey'  ");

        }
    
        if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}

    }

	public function checkuser_admin_data($userid)
	{		
		 $query=$this->db->query("SELECT u.userid,u.firstname,u.username,u.companyname,u.mobilenumber,u.email,u.roleid,u.client_id,u.dealer_id,u.subdealer_id,u.push_code,u.time_zone,tz.timezone_mins
          FROM usertbl u INNER JOIN time_zone tz ON tz.timezone_id=u.time_zone  WHERE status=1 AND roleid='15' AND userid=$userid" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function total_count($userid,$client_id,$roleid)
	{	
	    $query=$this->db->query("SELECT (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE 
			v.status=1 AND TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0 AND v.client_id=$client_id) as park_count,
			(SELECT count(v.vehicleid) FROM vehicletbl v WHERE v.status=1 AND 
			TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) = 0 and v.client_id=$client_id) as idle_count,
			(SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND 
			TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1 and v.client_id=$client_id) as move_count,
			(SELECT count(v.vehicleid) FROM vehicletbl v  WHERE (TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) > '10'
			 or v.updatedon IS NULL or v.acc_on IS NULL) and v.status=1 AND v.client_id=$client_id) as outofcoverage_count");

			if($query->num_rows() > 0)
			{
				return $query->row();
			}
			else
			{
				return false;
			}

    }

	public function vehicledetails($deviceimei)
	{		
        
		 $query=$this->db->query("SELECT client_id,vehicleid as vehicle_id,updatedon,TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,
			ROUND(odometer,3) as odometer,round(speed) as speed,acc_on,ac_flag,lat,lng,angle,COALESCE(latlon_address,'') as latlon_address,
			today_km,COALESCE(ROUND(today_km,3),'0') as trip_kilometer,ROUND(car_battery,2) as batteryvolt,ROUND(litres,2) as fuel_ltr,
            COALESCE(driver_name,'N/A') as driver_name,last_ign_off,last_ign_on,mileage,IF(altitude >2, altitude, 'N/A') as altitude,
            IF(gsmsignal >0, gsmsignal, 'N/A') as gsm, IF(gpssignal >0, gpssignal, 'N/A') as gsm,
            COALESCE(ROUND((litres*keyword),1),'N/A') as distancetoEmpty,
            'N/A'  AS  secondary_engine,'75%'  AS  battery_precentage,'h:min' AS hourmeter,rpm_data,
			 round(temperature/100,2) as temperature,'NULL' AS humidity,'N/A' AS drum,'N/A' AS bucket,device_type,safe_parking
			 FROM vehicletbl where deviceimei=$deviceimei" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	} 
		
	public function calculate_distance($imei,$start_date,$end_date,$client_id) 
    { 

         
                       $playtable= "play_back_history_".$client_id;

                       $qry = $this->db->query("SHOW TABLES LIKE '" . $playtable . "'");

                       if ($qry->num_rows() > 0) 
                       {

                    $query1 = $this->db->query ("SELECT odometer,modified_date FROM play_back_history
                     WHERE running_no =$imei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND 
                     lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND modified_date
                     BETWEEN '".$start_date."' AND '".$end_date."'  UNION SELECT odometer,modified_date FROM ".$playtable." WHERE running_no =$imei AND
                      lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND 
                      lon_message!='0.0' AND modified_date BETWEEN '".$start_date."' AND '".$end_date."'  
                      ORDER BY modified_date DESC");

                    } 
                    else
                    {
                        $query1 = $this->db->query("SELECT odometer,modified_date FROM play_back_history WHERE running_no =$imei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND modified_date BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY modified_date DESC");
                    }           

                    if($query1)
                    {
                        if ($query1->num_rows() > 0 ) 
                    {   
                         $result=$query1->result();

                         $n = count($result)-1;

                        
                         $dist_km = round(($result[0]->odometer-$result[$n]->odometer),3);


                          $Arr = array(
                             'distance_km' =>$dist_km
                            );
                          return  $Obj = (object)$Arr;
                       
                    }

                    }
             
                    else
                    {
                        return false;
                    }
                    
              
          
  

       
    }
		
	public function percentage_detail($client_id,$deviceimei)
	{		
        
		 $query=$this->db->query("SELECT CONCAT(v.car_battery, ' ', '%') AS  percent FROM vehicletbl v 
         INNER JOIN devicetbl d ON d.deviceimei=v.deviceimei  WHERE d.device_model = 'Assert_Tracker' AND v.deviceimei=$deviceimei AND v.client_id=$client_id
         GROUP BY v.vehicleid");

		if($query->num_rows() > 0)
		{
			$data =  $query->row();
            return $data->percent;
		}
		else
		{
			return 0;
		}
	} 

	public function vehiclelist($client_id,$status)
	{	
		if($status==1)
		{
			$query=$this->db->query("SELECT IF(
				TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1,
				'Moving',
				IF(
				 TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) = 0 ,
				'Idle',
				IF(
				TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0,         
					'Parking',          
					'OutOfCoverage'
				  )
				  )
				) as vehicle_status 
		  ,vehiclename,TIME_FORMAT(TIMEDIFF(CURRENT_TIMESTAMP,updatedon), '%H Hours:%i Minutes') as last_update,
					  COALESCE(driver_name,'N/A') as driver_name, ROUND(speed) as speed,ROUND(odometer,3) as odometer,
					  COALESCE(latlon_address,'') as address,ROUND(litres,2) as fuel,
					  ROUND(car_battery,2) as battery_voltage, acc_on as acc_status, ac_flag as ac_status,IF(car_battery<7, 0, 1) as battery_status,digital_output as immoblizer_status,gpssignal as gps_status,gsmsignal as gsmlevel,lat,lng,deviceimei as vehicle_imei, 
					  TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,angle,vehicletype,updatedon,safe_parking 
			FROM vehicletbl v  WHERE v.status=1 AND v.client_id=$client_id" );
		}
		elseif($status==2)			
		{
			$query=$this->db->query("SELECT 'Moving' as vehicle_status,vehicleid,vehiclename,TIME_FORMAT(TIMEDIFF(CURRENT_TIMESTAMP,updatedon), '%H Hours:%i Minutes') as last_update,COALESCE(driver_name,'N/A') as driver_name,
			ROUND(speed) as speed,ROUND(odometer,3) as odometer,COALESCE(latlon_address,'') as address,ROUND(litres,2) as fuel,ROUND(car_battery,2) as battery_voltage,
			acc_on as acc_status,ac_flag as ac_status,IF(car_battery<7, 0, 1) as battery_status,digital_output as immoblizer_status,gpssignal as gps_status,gsmsignal as gsmlevel,lat,lng,deviceimei as vehicle_imei, 
			TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,angle,vehicletype,updatedon,safe_parking
			FROM vehicletbl v  WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1 and v.client_id=$client_id" );
		}	
		elseif($status==3)
		{
			$query=$this->db->query("SELECT 'Idle' as vehicle_status,vehicleid,vehiclename,TIME_FORMAT(TIMEDIFF(CURRENT_TIMESTAMP,updatedon), '%H Hours:%i Minutes') as last_update,COALESCE(driver_name,'N/A') as driver_name,
			ROUND(speed) as speed,ROUND(odometer,3) as odometer,COALESCE(latlon_address,'') as address,ROUND(litres,2) as fuel,ROUND(car_battery,2) as battery_voltage,
			acc_on as acc_status,ac_flag as ac_status,IF(car_battery<7, 0, 1) as battery_status,digital_output as immoblizer_status,gpssignal as gps_status,gsmsignal as gsmlevel,lat,lng,deviceimei as vehicle_imei, 
			TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,angle,vehicletype,updatedon,safe_parking
			FROM vehicletbl v  WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) = 0 
			and	v.client_id=$client_id" );
		}	
		elseif($status==4)
		{
			$query=$this->db->query("SELECT 'Parking' as vehicle_status,vehicleid,vehiclename,TIME_FORMAT(TIMEDIFF(CURRENT_TIMESTAMP,updatedon), '%H Hours:%i Minutes') as last_update,COALESCE(driver_name,'N/A') as driver_name,
			ROUND(speed) as speed,ROUND(odometer,3) as odometer,COALESCE(latlon_address,'') as address,ROUND(litres,2) as fuel,ROUND(car_battery,2) as battery_voltage,
			acc_on as acc_status,ac_flag as ac_status,IF(car_battery<7, 0, 1) as battery_status,digital_output as immoblizer_status,gpssignal as gps_status,gsmsignal as gsmlevel,lat,lng,deviceimei as vehicle_imei, 
			TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,angle,vehicletype,updatedon,safe_parking
			FROM vehicletbl v  WHERE v.status=1  AND TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0 
			AND v.client_id=$client_id" );
		}	
		elseif($status==5)
		{
			$query=$this->db->query("SELECT 'OutOfCoverage' as vehicle_status,vehicleid,vehiclename,TIME_FORMAT(TIMEDIFF(CURRENT_TIMESTAMP,updatedon), '%H Hours:%i Minutes') as last_update,
			COALESCE(driver_name,'N/A') as driver_name, ROUND(speed) as speed,ROUND(odometer,3) as odometer,
			COALESCE(latlon_address,'') as address,ROUND(litres,2) as fuel,ROUND(car_battery,2) as battery_voltage, 
			acc_on as acc_status,ac_flag as ac_status,IF(car_battery<7, 0, 1) as battery_status,digital_output as immoblizer_status,gpssignal as gps_status,gsmsignal as gsmlevel,lat,lng,deviceimei as vehicle_imei, TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,
			angle,vehicletype,updatedon,safe_parking 
			FROM vehicletbl v WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) > '10' OR updatedon IS NULL or acc_on IS NULL or speed IS NULL)
			AND v.client_id=$client_id" );
		}
		else{
			$query=$this->db->query("SELECT IF(
				TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1,
				'Moving',
				IF(
				 TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) = 0 ,
				'Idle',
				IF(
				TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0,         
					'Parking',          
					'OutOfCoverage'
				  )
				  )
				) as vehicle_status 
		  ,vehiclename,TIME_FORMAT(TIMEDIFF(CURRENT_TIMESTAMP,updatedon), '%H Hours:%i Minutes') as last_update,
					  COALESCE(driver_name,'N/A') as driver_name, ROUND(speed) as speed,ROUND(odometer,3) as odometer,
					  COALESCE(latlon_address,'') as address,ROUND(litres,2) as fuel,
					  ROUND(car_battery,2) as battery_voltage, acc_on as acc_status, ac_flag as ac_status,IF(car_battery<7, 0, 1) as battery_status,digital_output as immoblizer_status,gpssignal as gps_status,gsmsignal as gsmlevel,lat,lng,deviceimei as vehicle_imei, 
					  TIMESTAMPDIFF(MINUTE,updatedon,CURRENT_TIMESTAMP) AS update_time,angle,vehicletype,updatedon,safe_parking 
			FROM vehicletbl v  WHERE v.status=1 AND v.client_id=$client_id" );
		}	

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function fuelvehicle_get()
	{  
		$headers = $this->input->request_headers(); 
			$valid_status =1;
			if($headers=='')
		{
			$valid_status = 0;
			$data['status'] = 0;
			$data['message'] ='headers is Empty';
			$this->response($data, REST_Controller::HTTP_OK);

		}
		
		if($valid_status)
		{
	
		$result = $this->authorization_token->validateToken($headers['Authorization']);

		if($result['status']==1)
		{
				$data['status'] = 1;
				$client_id= $result['data']->client_id;
				$userid= $result['data']->userid;
				$roleid= $result['data']->roleid;
				$data['Fuelvehicles'] = $this->api_model->fuel_vehicle($client_id,$userid,$roleid);

				$this->response($data); 
		
		}
		else
		{
			$this->response($result); 
		}

		}
		
	}

	public function fuel_vehicle($client_id,$userid,$roleid)
    {
        
       
        $query = $this->db->query("SELECT vehicleid,vehiclename,deviceimei FROM vehicletbl WHERE client_id='".$client_id."' AND (device_type=2 OR device_type=4 OR device_type=6 OR device_type=7 OR device_type=12 OR device_type=13 OR device_type=14)");
    
       
            if ($query->num_rows() > 0)
            {

                return $query->result();
            }
            else
            {
                return false;
            }
    }

	public function gettimezone_data($client_id) 
	{
		 $query = $this->db->query("SELECT t.timezone_id as time_zone,t.timezone_name,t.timezone_mins FROM clienttbl c INNER JOIN time_zone t ON t.timezone_id =c.time_zone WHERE c.client_id=$client_id");	
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}

	public function parking_report_list($from, $to, $vehicleid = NULL, $time,$timezone_hours)
    {

        //$timezone_hours = $this->session->userdata('timezone_hours');
        if (!empty($vehicleid)) {
            $query1 = $this->db->query("SELECT ir.report_id,ir.device_no,ir.vehicle_id,
                TIME_FORMAT(TIMEDIFF((ir.end_day + INTERVAL $timezone_hours MINUTE),(ir.start_day + INTERVAL $timezone_hours MINUTE)), '%H:%i:%s') as time_duration,ir.s_lat,ir.s_lng,
                (ir.start_day + INTERVAL $timezone_hours MINUTE) as start_day,(ir.end_day + INTERVAL $timezone_hours MINUTE) as end_day,
                v.vehiclename,ir.start_location,ir.end_location FROM parking_report ir 
                LEFT JOIN vehicletbl v ON v.deviceimei = ir.device_no
                 WHERE ir.device_no =$vehicleid AND ir.end_day !='' AND ir.flag='2' AND 
                 TIMESTAMPDIFF(MINUTE,(ir.start_day + INTERVAL $timezone_hours MINUTE),(ir.end_day + INTERVAL $timezone_hours MINUTE))>'" . $time . "' AND (ir.start_day + INTERVAL $timezone_hours MINUTE )>= '" . $from . "' 
                 AND (ir.start_day + INTERVAL $timezone_hours MINUTE) <= '" . $to . "' ORDER BY start_day DESC");

            if ($query1->num_rows() > 0) {
                //$result=$query->result_array();
                return $query1->result();
            } else {
                return FALSE;
            }
        } else if ($vehicleid == NULL) {

            return FALSE;
        }
    }

	public function idle_report_list($from, $to, $vehicleid = NULL, $time,$timezone_hours)
    {

       
        if (!empty($vehicleid)) {
            $query = $this->db->query("SELECT ir.report_id,ir.device_no,
            TIME_FORMAT(TIMEDIFF((ir.end_day + INTERVAL $timezone_hours MINUTE),(ir.start_day + INTERVAL $timezone_hours MINUTE)), '%H:%i:%s') as time_duration,
                        ir.s_lat,ir.s_lng,(ir.start_day + INTERVAL $timezone_hours MINUTE ) as start_day,(ir.end_day + INTERVAL $timezone_hours MINUTE) as end_day,
                        v.vehiclename,ir.start_location,ir.end_location,v.vehiclename 
                        FROM idle_report ir 
                        LEFT JOIN vehicletbl v ON ir.vehicle_id = v.vehicleid  
                        WHERE ir.device_no =$vehicleid
                        AND ir.flag=2
                        AND ir.end_day !='' 
                        AND TIMESTAMPDIFF(MINUTE,(ir.start_day + INTERVAL $timezone_hours MINUTE),(ir.end_day + INTERVAL $timezone_hours MINUTE))>'" . $time . "' 
                        AND (ir.start_day + INTERVAL $timezone_hours MINUTE) >= '" . $from . "' 
                        AND (ir.start_day + INTERVAL $timezone_hours MINUTE) <= '" . $to . "' 
                        ORDER BY start_day DESC");

            if ($query->num_rows() > 0) {
                //$result=$query->result_array();
                return $query->result();
            } else {
                return FALSE;
            }
        } else if ($vehicleid == NULL) {
            return FALSE;
        }
    }

	public function trip_report_list($from, $to, $vehicleid = NULL, $time, $timezone_hours)
    {

        if (!empty($vehicleid)) {

            $query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF((ip.end_day + INTERVAL $timezone_hours MINUTE),(ip.start_day + INTERVAL $timezone_hours MINUTE)), '%H:%i:%s') as time_duration,
                        TIMESTAMPDIFF(MINUTE,(ip.start_day + INTERVAL $timezone_hours MINUTE) ,(ip.end_day + INTERVAL $timezone_hours MINUTE)) as t_min,
                        (ip.start_day + INTERVAL $timezone_hours MINUTE) as start_day,(ip.end_day + INTERVAL $timezone_hours MINUTE) as end_day,(ip.end_odometer - ip.start_odometer) as distance,
                        ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,v.vehiclename,v.device_config_type,v.deviceimei,ip.end_odometer,ip.start_odometer,
                        ip.start_location,ip.end_location,ip.report_id 
                        FROM trip_report ip 
                        LEFT JOIN vehicletbl v ON ip.vehicle_id = v.vehicleid
                        WHERE ip.device_no=$vehicleid
                        AND ip.end_day !='' 
                        AND ip.flag=2
                        AND TIMESTAMPDIFF(MINUTE,(ip.start_day + INTERVAL $timezone_hours MINUTE),(ip.end_day + INTERVAL $timezone_hours MINUTE))>'" . $time . "' 
                        AND  (ip.start_day + INTERVAL $timezone_hours MINUTE) >= '" . $from . "' 
                        AND (ip.start_day + INTERVAL $timezone_hours MINUTE ) <= '" . $to . "' 
                        GROUP BY ip.end_day 
                        ORDER BY ip.start_day DESC");

            if ($query1->num_rows() > 0) {
                //$result=$query->result_array();

                return $query1->result();
            } else {
                return FALSE;
            }
        } else if ($vehicleid == NULL) {

            return FALSE;
        }
    }

	public function vehicletype_data_admin($deviceimei)
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

public function playback_data_admin($d_id, $from, $to,$client_id) {

    $play_table = "play_back_history_" . $client_id;
    $qry = $this->db->query("SHOW TABLES LIKE '" . $play_table . "'");

    if ($qry->num_rows() > 0) {

        $query = $this->db->query ("SELECT p.odometer,p.lat_message,p.lon_message,p.speed,p.acc_status,p.modified_date,p.angle,p.zap as address FROM play_back_history p INNER JOIN vehicletbl v ON v.deviceimei = p.running_no
        WHERE p.running_no =$d_id AND p.lat_message!='000000000' AND p.lon_message!='000000000' AND p.lat_message!='0' AND
        p.lon_message!='0' AND p.lat_message!='0.0' AND p.lon_message!='0.0' AND p.modified_date
        BETWEEN '".$from."' AND '".$to."' UNION SELECT
        ps.odometer,ps.lat_message,ps.lon_message,ps.speed,ps.acc_status,ps.modified_date,ps.angle,ps.zap as address FROM $play_table ps INNER JOIN vehicletbl v ON v.deviceimei = ps.running_no WHERE
        ps.running_no =$d_id AND
        ps.lat_message!='000000000' AND ps.lon_message!='000000000' AND ps.lat_message!='0' AND ps.lon_message!='0' AND ps.lat_message!='0.0'
        AND
        ps.lon_message!='0.0' AND ps.modified_date BETWEEN '".$from."' AND '".$to."' 
        ORDER BY modified_date ASC");
    } else {
        $query = $this->db->query("SELECT p.odometer,p.lat_message,p.lon_message,p.speed,p.acc_status,p.modified_date,p.angle,p.zap as address FROM play_back_history p INNER JOIN vehicletbl v ON v.deviceimei = p.running_no WHERE p.running_no =$d_id AND p.lat_message!='000000000' AND p.lon_message!='000000000' AND p.lat_message!='0' AND p.lon_message!='0' AND p.lat_message!='0.0' AND p.lon_message!='0.0' AND p.modified_date BETWEEN '".$from."' AND '".$to."'  ORDER BY p.modified_date ASC");
    }



    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
         return array();
    }
}   

public function smart_distanceday_API($imei,$start_date,$end_date,$device_type,$client_id,$timezone_hours) 
{ 

	//  print_r($timezone_hours);die;
	if (!empty($imei)) {
			//$client_id = $this->session->userdata['client_id'];       
			$playtable= "play_back_history_".$client_id;
			$qry = $this->db->query("SHOW TABLES LIKE '" . $playtable . "'");
			if ($qry->num_rows() > 0) 
			{
	
				$query1 = $this->db->query ("SELECT odometer,(modified_date  + INTERVAL $timezone_hours MINUTE) as modified_date FROM play_back_history
				 WHERE running_no =$imei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND 
				 lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date  + INTERVAL $timezone_hours MINUTE)
				 BETWEEN '".$start_date."' AND '".$end_date."'  UNION SELECT odometer,(modified_date  + INTERVAL $timezone_hours MINUTE) as modified_date FROM ".$playtable." WHERE running_no =$imei AND
				  lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND 
				  lon_message!='0.0' AND (modified_date  + INTERVAL $timezone_hours MINUTE) BETWEEN '".$start_date."' AND '".$end_date."'  
				  ORDER BY modified_date DESC");

				} 
				else
				{
					$query1 = $this->db->query("SELECT odometer,(modified_date  + INTERVAL $timezone_hours MINUTE) as modified_date FROM play_back_history WHERE running_no =$imei 
					AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date  + INTERVAL $timezone_hours MINUTE) BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY modified_date DESC");
				}   
				if($query1)
				{
					if ($query1->num_rows() > 0 ) 
				{   
					 $result=$query1->result();
					 $n = count($result)-1;
					 $dist_km = round(($result[0]->odometer-$result[$n]->odometer),3);
					  $Arr = array(
						 'distance_km' =>$dist_km
						);
					  return  $Obj = (object)$Arr;
				   
				}
				}
		 
				else
				{
					return false;
				}
				
	}
   
}

public function smart_parkday_API($imei,$start_date,$end_date,$device_type,$client_id,$timezone_hours) 
    {   
        // $client_id = $this->session->userdata['client_id'];
        // $timezone_hours = $this->session->userdata('timezone_hours'); 
		 
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE))) as parking_duration FROM parking_report
             WHERE device_no =$imei AND TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE)) > 0 AND end_day !='' AND flag=2 AND 
             (start_day + INTERVAL $timezone_hours MINUTE) BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY start_day DESC");
                   

       
        if ($query->num_rows() > 0) 
        {
            
            return $query->row();
        }
        else 
        {
            return '-';
        }
    }

	public function smart_ignday_API($imei,$start_date,$end_date,$device_type,$client_id,$timezone_hours) 
    {   

        // $client_id = $this->session->userdata['client_id'];
        // $timezone_hours = $this->session->userdata('timezone_hours');   
        $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE))) as moving_duration
         FROM trip_report WHERE device_no =$imei AND end_day !='' AND TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE)) > 0 
         AND flag=2 AND (start_day + INTERVAL $timezone_hours MINUTE) BETWEEN '".$start_date."' AND '".$end_date."'");
        if ($query->num_rows() > 0) 
        {
           
            return $query->row();
        }
        else 
        {
            return '-';
        } 
    }

    // public function smart_acday($imei,$start_date,$end_date) 
    // {   
    //     $client_id = $this->session->userdata['client_id'];
    //     $timezone_hours = $this->session->userdata('timezone_hours');  
    //         $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE))) as moving_duration FROM ac_report
    //          WHERE device_no =$imei AND end_day !='' AND flag=2 AND  type_id=1 AND 
    //          TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE)) > 0 AND (start_day + INTERVAL $timezone_hours MINUTE) BETWEEN '".$start_date."' AND '".$end_date."'");


       
    //     if ($query->num_rows() > 0) 
    //     {
           
    //         return $query->row();
    //     }
    //     else 
    //     {
    //         return '-';
    //     }

      
       
           
    // }

	public function smart_idleday_API($imei,$start_date,$end_date,$device_type,$client_id,$timezone_hours) 
    {   

        // $client_id = $this->session->userdata['client_id'];
        // $timezone_hours = $this->session->userdata('timezone_hours');  
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE))) as idel_duration FROM idle_report WHERE 
            device_no =$imei AND end_day !='' AND flag=2 AND TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE)) > 0 AND start_day 
            BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY start_day DESC");
       
        if ($query->num_rows() > 0) 
        {
           
            return $query->row();
        }
        else 
        {
            return '-';
        }
    }

	public function smart_fuelfill_API($imei,$start_date,$end_date,$device_type,$client_id,$timezone_hours) 
    {   
      //  $client_id = $this->session->userdata['client_id'];
        
            $query = $this->db->query("SELECT SUM(ROUND(fl.difference_fuel,2)) as fuel_fill_litre FROM  fuel_fill_dip_report fl  WHERE fl.running_no ='".$imei."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$start_date."' AND '".$end_date."' AND fl.type_id ='2' ORDER BY fl.end_date DESC");
                   
            if ($query->num_rows() > 0 ) 
            {   

            return  $query->row();

            }
      
            else 
            {
                return '0';
            }
      
    }

    public function smart_fueldip_API($imei,$start_date,$end_date,$device_type,$client_id,$timezone_hours) 
    {   
        //$client_id = $this->session->userdata['client_id'];

            $query = $this->db->query("SELECT SUM(ROUND(fl.difference_fuel,2)) as fuel_dip_litre FROM  fuel_fill_dip_report fl  WHERE fl.running_no ='".$imei."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$start_date."' AND '".$end_date."' AND fl.type_id ='1' ORDER BY fl.end_date DESC");
                   
               if ($query->num_rows() > 0 ) 
            {   

            return  $query->row();

            }
      
            else 
            {
                return '0';
            }
    }

    public function smart_fuelconsumed_API($imei,$start_date,$end_date,$device_type,$client_id,$timezone_hours) 
    {   
        
            $query = $this->db->query("SELECT SUM(ROUND(fl.difference_fuel,2)) as fuel_fill_litre FROM  fuel_fill_dip_report fl  WHERE fl.running_no ='".$imei."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$start_date."' AND '".$end_date."' AND fl.type_id ='2' ORDER BY fl.end_date DESC");
           
                         $result=$query->row();

                            $query1 = $this->db->query("SELECT odometer,litres,modified_date,speed,ignition from fuel_status  FORCE INDEX (running_no_4) WHERE running_no ='".$imei."' AND flag=0 AND modified_date >= '".$start_date."' AND modified_date <= '".$end_date."' ORDER BY modified_date DESC");

                                  
                       if ($query1->num_rows() > 0 ) 
                         { 
                            $result1 =  $query1->result();
                            $n = count($result1)-1;

                            $fuel_consume = $result1[0]->litres +$result->fuel_fill_litre - $result1[$n]->litres;
                            $distance = $result1[$n]->odometer -  $result1[0]->odometer ;
                            $fuel_milege = $fuel_consume/$distance;
                           $Arr = array(
                            'fuel_milege' =>round($fuel_milege,1),
                            'fuel_consumed_litre' =>round($fuel_consume,1)
                            );
                          return  $Obj = (object)$Arr;

    }else{
        return 0;
    }
}

public function consolidate_distanceday($deviceimei,$start_date,$end_date,$client_id) 
{ 

	// $client_id = $this->session->userdata['client_id'];

		 $query = $this->db->query("SELECT DISTINCT SUM(distance_km) as distance_km, AVG(distance_km) as avg_km,count(id) as totalcount FROM consolidate_distance_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");
		 

	if ($query->num_rows() > 0) 
	{
	   
		return  $query->row();
	}
	else 
	{
		return 0;
	}

   
}




public function consolidate_ignday($deviceimei,$start_date,$end_date,$client_id) 
{   

	// $client_id = $this->session->userdata['client_id'];
	   
	
		 $query = $this->db->query("SELECT DISTINCT SUM(moving_duration) as moving_duration,AVG(moving_duration) as avg_moving_duration,count(id) as totalcount FROM consolidate_ign_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");
   

	if ($query->num_rows() > 0) 
	{
	   
		return $query->row();
	}
	else 
	{
		return '-';
	}

	   
}

public function consolidate_idleday($deviceimei,$start_date,$end_date,$client_id) 
{   

	// $client_id = $this->session->userdata['client_id'];
   
		 $query = $this->db->query("SELECT DISTINCT SUM(idel_duration) as idel_duration,AVG(idel_duration) as avg_idel_duration, count(id) as totalcount FROM consolidate_idle_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

	  
	if ($query->num_rows() > 0) 
	{
	  
		return $query->row();;
	}
	else 
	{
		return '-';
	}
}

public function consolidate_acday($deviceimei,$start_date,$end_date,$client_id) 
{   

	// $client_id = $this->session->userdata['client_id'];
   
   
	$query = $this->db->query("SELECT DISTINCT SUM(running_duration) as moving_duration,AVG(running_duration) as avg_running_duration, count(id) as totalcount FROM consolidate_ac_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

	  
	if ($query->num_rows() > 0) 
	{
	  
		return $query->row();;
	}
	else 
	{
		return '-';
	}
}



public function consolidate_parkday($deviceimei,$start_date,$end_date,$client_id) 
{   
	// $client_id = $this->session->userdata['client_id'];
	
	
			$query = $this->db->query("SELECT DISTINCT SUM(parking_duration) as parking_duration,AVG(parking_duration) as avg_parking_duration,COUNT(id) as totalcount FROM consolidate_park_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

   
	if ($query->num_rows() > 0) 
	{
		
		return  $query->row();
	}
	else 
	{
		return '-';
	}
}


public function consolidate_fuelfill($deviceimei,$start_date,$end_date,$client_id) 
{   
	// $client_id = $this->session->userdata['client_id'];
	

	$query = $this->db->query("SELECT DISTINCT SUM(fuel_fill_litre) as fuel_fill_litre,AVG(fuel_fill_litre) as avg_fuel_fill_litre FROM consolidate_fuelfill_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

	if ($query->num_rows() > 0) 
	{
	  
		return $query->row();
	}
	else 
	{
		return '0';
	}
 
}

public function consolidate_fueldip($deviceimei,$start_date,$end_date,$client_id) 
{   
	// $client_id = $this->session->userdata['client_id'];

	
	$query = $this->db->query("SELECT DISTINCT SUM(fuel_dip_litre) as fuel_dip_litre,AVG(fuel_dip_litre) as avg_fuel_dip_litre FROM consolidate_fueldip_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

	if ($query->num_rows() > 0) 
	{
		return  $query->row();
	}
	else 
	{
		return 0;
	}

}

public function consolidate_fuelconsumed($deviceimei,$start_date,$end_date,$client_id) 
{   
	// $client_id = $this->session->userdata['client_id'];
   
	$query = $this->db->query("SELECT DISTINCT SUM(fuel_consumed_litre) as fuel_consumed_litre,AVG(fuel_consumed_litre) as avg_consume_litre,count(id) as totalcount,SUM(fuel_millege) as fuel_milege FROM consolidate_fuelcosumed_report WHERE imei = '".$deviceimei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");


	if ($query->num_rows() > 0) 
	{
		return  $query->row();
	}
	else 
	{
		return 0;
	}

}
//=============================Executive Report Details =====================================================

public function exe_consolidate_distanceday($imei,$date,$device_type,$client_id) 
    { 

        $ct = date('Y-m-d');

      //  echo $device_type;exit;
        
        if ($date==$ct) {

                     if($device_type=='17')
                       {
                        
                    $from_date1 = $date . " 00:00:00";
                    $to_date1 = $date . " 23:59:59";

                 

                    $query1 = $this->db->query("SELECT odometer FROM omni_distance_data WHERE  deviceimei = '".$imei."' AND modified_date BETWEEN '".$from_date1."' AND '".$to_date1."'   ORDER BY modified_date DESC LIMIT 1");

                    //echo "SELECT odometer FROM omni_distance_data WHERE  deviceimei = '".$imei."' AND modified_date BETWEEN '".$from_date1."' AND '".$to_date1."'   ORDER BY modified_date DESC LIMIT 1";exit;

                    if ($query1->num_rows() > 0 ) 
                    {   
                         $result=$query1->result();

                         $n = count($result)-1;

                        // $dist_km = round(($result[0]->odometer-$result[$n]->odometer),3);


                          $Arr = array(
                            'end_odometer' =>0,
                            'start_odometer' => 0,
                             'distance_km' =>$result[0]->odometer
                            );
                          return  $Obj = (object)$Arr;
                       
                    } 
                    
                       }
                       else
                       {

                    $playtable= "play_back_history_".$client_id;

                    $from_date1 = $date." 00:00:00";
                    $to_date1 = $date." 23:59:59";

					$query1 = $this->db->query ("SELECT odometer,modified_date FROM play_back_history WHERE running_no =$imei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date1."' AND '".$to_date1."'  UNION SELECT odometer,modified_date FROM ".$playtable." WHERE running_no =$imei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date1."' AND '".$to_date1."'  ORDER BY modified_date DESC");


                    if ($query1->num_rows() > 0 ) 
                    {   
                         $result=$query1->result();

                         $n = count($result)-1;

                         $dist_km = round(($result[0]->odometer-$result[$n]->odometer),3);
                        if($dist_km <2)
                        {
                            $dist_km=0;
                        }

                          $Arr = array(
                            'end_odometer' =>$result[0]->odometer,
                            'start_odometer' => $result[$n]->odometer,
                             'distance_km' =>$dist_km
                            );
                          return  $Obj = (object)$Arr;

                       
                    }

                }
                
          
        }
        else
        {
             $query = $this->db->query("SELECT DISTINCT date,distance_km,start_odometer,end_odometer FROM consolidate_distance_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."' AND distance_km>1");

        if ($query->num_rows() > 0) 
        {
           
            return  $query->row();
        }
        else 
        {
            return 0;
        }
        }



       
    }

	public function exe_consolidate_acday($imei,$date,$client_id) 
    {   

       
        $ct = date('Y-m-d');
        
        $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
            $ct_from = $ct. ' 00:00:00';
            $ct_to = $ct. ' 23:59:59';
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,start_day,end_day)) as moving_duration FROM ac_report WHERE device_no ='".$imei."' AND end_day!='' AND TIMESTAMPDIFF(MINUTE,start_day,end_day)>0 AND flag='2' AND type_id=1 AND start_day BETWEEN '".$ct_from."' AND '".$ct_to."'");    
              
        }
        else
        {
             $query = $this->db->query("SELECT DISTINCT date,running_duration as moving_duration FROM consolidate_ac_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
        }
       
        if ($query->num_rows() > 0) 
        {
            $res =  $query->row();
            return $res->moving_duration;
        }
        else 
        {
            return 0;
        }

      
       
           
    }

    public function exe_consolidate_ignday($imei,$date,$client_id) 
    {   

            $ct = date('Y-m-d');
        
         $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
            $ct_from = $ct. ' 00:00:00';
            $ct_to = $ct. ' 23:59:59';
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,start_day,end_day)) as moving_duration FROM trip_report WHERE device_no ='".$imei."' AND end_day!='' AND flag='2' AND start_day BETWEEN '".$ct_from."' AND '".$ct_to."'");    
              
        }
        else
        {
             $query = $this->db->query("SELECT DISTINCT date,moving_duration FROM consolidate_ign_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
         }
       
        if ($query->num_rows() > 0) 
        {
            $res =  $query->row();
            return $res->moving_duration;
        }
        else 
        {
            return 0;
        }

      
       
           
    }

    public function exe_consolidate_idleday($imei,$date,$client_id) 
    {   
         $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
             $ct_from = $ct. ' 00:00:00';
            $ct_to = $ct. ' 23:59:59';

            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,start_day,end_day)) as idel_duration FROM idle_report WHERE device_no ='".$imei."' AND end_day !='' AND end_day!='' AND flag='2' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$ct_from."' AND '".$ct_to."' ORDER BY start_day DESC");
                   

        }
        else
        {
             $query = $this->db->query("SELECT DISTINCT date,idel_duration FROM consolidate_idle_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
        }

               
      

        if ($query->num_rows() > 0) 
        {
            $res =  $query->row();
            return $res->idel_duration;
        }
        else 
        {
            return 0;
        }
    }

    public function exe_consolidate_parkday($imei,$date,$client_id) 
    {   
      
         $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
             $ct_from = $ct. ' 00:00:00';
            $ct_to = $ct. ' 23:59:59';
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,start_day,end_day)) as parking_duration FROM parking_report WHERE device_no ='".$imei."' AND end_day !='' AND flag='2' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$ct_from."' AND '".$ct_to."' ORDER BY start_day DESC");
                   

        }
        else
        {

                $query = $this->db->query("SELECT DISTINCT date,parking_duration FROM consolidate_park_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
        }

       
        if ($query->num_rows() > 0) 
        {
            $res =  $query->row();
            return $res->parking_duration;
        }
        else 
        {
            return 0;
        }
    }

 public function exe_consolidate_allrpmday($imei,$date,$client_id) 
    {   

       
            $ct = date('Y-m-d');
        
         $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
            $ct_from = $ct. ' 00:00:00';
            $ct_to = $ct. ' 23:59:59';
           $query = $this->db->query("SELECT DISTINCT date,normal_rpm,idle_rpm,milege,under_load FROM consolidate_rpm_report WHERE (deviceimei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");                  
        }
        else
        {
             $query = $this->db->query("SELECT DISTINCT date,normal_rpm,idle_rpm,milege,under_load FROM consolidate_rpm_report WHERE (deviceimei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");

              //  echo "SELECT DISTINCT date,normal_rpm,idle_rpm,milege FROM consolidate_rpm_report WHERE (deviceimei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'";exit;
         }
       
        if ($query->num_rows() > 0) 
        {
            $res =  $query->row();
            return $res;
        }
        else 
        {
            return 0;
        }

    }



    public function exe_consolidate_fuelfill($imei,$date,$client_id) 
    {   
        
          $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
              $ct_from = $ct. ' 00:00:00';
              $ct_to = $ct. ' 23:59:59';

            $query = $this->db->query("SELECT SUM(ROUND(fl.difference_fuel,2)) as fuel_fill_litre FROM  fuel_fill_dip_report fl  WHERE fl.running_no ='".$imei."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$ct_from."' AND '".$ct_to."' AND fl.type_id ='2' ORDER BY fl.end_date DESC");
                   
              if ($query->num_rows() > 0 ) 
                    {   
                         $result=$query->row();

                            $query1 = $this->db->query("SELECT odometer,litres,modified_date,speed,ignition from fuel_status  FORCE INDEX (running_no_4) WHERE running_no ='".$imei."' AND flag=0 AND modified_date >= '".$ct_from."' AND modified_date <= '".$ct_to."' ORDER BY modified_date ASC");

                        
                            $result1 =  $query1->result();
                            $n = count($result1)-1;

                           $Arr = array(
                            'start_fuel' =>round($result1[0]->litres,1),
                            'end_fuel' => round($result1[$n]->litres,1),
                            'fuel_fill_litre' => $result->fuel_fill_litre
                            );
                          return  $Obj = (object)$Arr;


                    }
        }
        else
        {

        $query = $this->db->query("SELECT DISTINCT date,fuel_fill_litre,start_fuel,end_fuel FROM consolidate_fuelfill_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
            // echo "SELECT DISTINCT date,fuel_fill_litre,start_fuel,end_fuel FROM consolidate_fuelfill_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'";exit;
        if ($query->num_rows() > 0) 
        {
          
            return $query->row();
        }
        else 
        {
            return '0';
        }
       }
        
    }

    public function exe_consolidate_fueldip($imei,$date,$client_id) 
    {   
        
         $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
              $ct_from = $ct. ' 00:00:00';
              $ct_to = $ct. ' 23:59:59';

            $query = $this->db->query("SELECT ROUND(fl.difference_fuel,2) as difference_fuel,fl.start_fuel,fl.end_fuel FROM  fuel_fill_dip_report fl  WHERE fl.running_no ='".$imei."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$ct_from."' AND '".$ct_to."' AND fl.type_id ='1' ORDER BY fl.end_date DESC");
                   
              if ($query->num_rows() > 0 ) 
                    {   
                         $result=$query->result();

                         $n = count($result)-1;

                         $fuel_fill = 0;
                         foreach ($result as $list) {
                            
                            $fuel_fill+=$list->difference_fuel;
                         }

                       
                           $Arr = array(
                            'start_fuel' =>$result[0]->start_fuel,
                            'end_fuel' => $result[$n]->end_fuel,
                            'fuel_dip_litre' => $fuel_fill
                            );
                          return  $Obj = (object)$Arr;


                    }
        }
        else
        {

        $query = $this->db->query("SELECT DISTINCT date,fuel_dip_litre FROM consolidate_fueldip_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
        if ($query->num_rows() > 0) 
        {
            $res =  $query->row();
            return $res->fuel_dip_litre;
        }
        else 
        {
            return 0;
        }
    }
    }

    public function exe_consolidate_fuelconsumed($imei,$date,$client_id) 
    {   
     
        $ct = date('Y-m-d');
        
        if ($date==$ct)
        {
              $ct_from = $ct. ' 00:00:00';
              $ct_to = $ct. ' 23:59:59';

             $query = $this->db->query("SELECT
                                        sum(difference_fuel) as fuel_dip_litre
                                         FROM fuel_fill_dip_report  WHERE type_id = '1' AND running_no='".$imei."' AND  
                                         DATE_FORMAT(end_date, '%Y-%m-%d %H:%i:%s') between '".$ct_from."' AND '".$ct_to."'
                                         UNION SELECT sum(difference_fuel) as fuel_fill_litre
                                         FROM fuel_fill_dip_report WHERE type_id = '2' AND running_no='".$imei."' AND 
                                        DATE_FORMAT(end_date, '%Y-%m-%d %H:%i:%s') between '".$ct_from."' AND '".$ct_to."'");

             // echo "(SELECT
             //                            sum(difference_fuel) as fuel_dip_litre
             //                             FROM fuel_fill_dip_report  WHERE type_id = '1' AND running_no='".$imei."' AND  
             //                             DATE_FORMAT(end_date, '%Y-%m-%d %H:%i:%s') between '".$ct_from."' AND '".$ct_to."')
             //                             UNION
             //                           (SELECT
             //                            sum(difference_fuel) as fuel_fill_litre
             //                            FROM fuel_fill_dip_report WHERE type_id = '2' AND running_no='".$imei."' AND 
             //                            DATE_FORMAT(end_date, '%Y-%m-%d %H:%i:%s') between '".$ct_from."' AND '".$ct_to."')";exit;
                   
             
                         if ($query->num_rows() > 0 ) 
                    {   
                           $result=$query->result();

                            $query1 = $this->db->query("SELECT odometer,litres,modified_date,speed,ignition from fuel_status  FORCE INDEX (running_no_4) WHERE running_no ='".$imei."' AND flag='0' AND modified_date >= '".$ct_from."' AND modified_date <= '".$ct_to."' ORDER BY modified_date DESC");
                            // echo "SELECT odometer,litres,modified_date,speed,ignition from fuel_status  FORCE INDEX (running_no_4) WHERE running_no ='".$imei."' AND flag='0' AND modified_date >= '".$ct_from."' AND modified_date <= '".$ct_to."' ORDER BY modified_date DESC";exit;
                            $fuel_fill = $result[1]->fuel_dip_litre + ($result->fuel_dip_litre);
                            $result1 =  $query1->result();
                            $n = count($result1)-1;

                            $distance  = round($result1[0]->odometer,3) - round($result1[$n]->odometer,3);

                            $fuel_consumed = round($result1[$n]->litres,1) + $fuel_fill - round($result1[0]->litres,1);

                            $milege = $distance/$fuel_consumed;

                           $Arr = array(
                            'fuel_consumed_litre' =>$fuel_consumed,
                            'fuel_millege' => $milege
                            );
                      //    print_r($Arr);exit;
                          return  $Obj = (object)$Arr;


                    }


           
        }
        else
        {

        $query = $this->db->query("SELECT DISTINCT date,fuel_consumed_litre,fuel_millege FROM consolidate_fuelcosumed_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
        if ($query->num_rows() > 0) 
        {
            return  $query->row();
        }
        else 
        {
            return 0;
        }

    }
    }

	public function exereportchk_details($userid)
	{		

		 $query=$this->db->query("SELECT * FROM executive_report_chk WHERE status=1 AND user_id=$userid" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}


	

    public function smartreportchk_details($userid)
	{		

		 $query=$this->db->query("SELECT * FROM smart_report_chk WHERE status=1 AND user_id=$userid" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function user_details($userid,$password)
	{		

		 $query=$this->db->query("SELECT userid FROM usertbl WHERE status=1 AND userid='$userid' AND (password='$password' OR secondarypassword='$password')" );

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			 return array();
		}
	}

	public function alerttypes()
{		

     $query=$this->db->query("SELECT alert_type_id as alert_id,alert_type FROM alert_type WHERE status=1" );

    if($query->num_rows() > 0)
    {
        
        return  $query->result();
    }
    else
    {
        return false;
    }
}


public function alert_report($from, $to, $deviceimei = NULL, $alert_id) {
  
	if($alert_id ==0)
	{

		$query = $this->db->query("SELECT v.vehiclename,a.alert_type as alert_name,s.createdon as datetime,s.alert_location as location
		FROM sms_alert s
		LEFT JOIN vehicletbl v ON s.vehicle_id = v.vehicleid INNER JOIN alert_type a ON a.alert_type_id = s.all_status
		WHERE v.deviceimei =$deviceimei AND s.createdon BETWEEN '".$from."' AND '".$to."'
		ORDER BY s.createdon DESC");
	}
	else
	{
		$query = $this->db->query("SELECT v.vehiclename,a.alert_type as alert_name,s.createdon as datetime,s.alert_location as location
		FROM sms_alert s
		LEFT JOIN vehicletbl v ON s.vehicle_id = v.vehicleid INNER JOIN alert_type a ON a.alert_type_id = s.all_status
		WHERE v.deviceimei =$deviceimei AND s.createdon BETWEEN '".$from."' AND '".$to."' AND a.alert_type_id= $alert_id
		ORDER BY s.createdon DESC");


	}
   
	if ($query->num_rows() > 0) {
		//$result=$query->result_array();
		return $query->result();
	} else {
		return FALSE;
	}

}

public function alert_settings($client_id)
{		

     $query=$this->db->query("SELECT `ac_on`,`ac_off`,`ignition_on`,`ignition_off`,`speed_alert`,`route_deviation`,`temperature_alert`,`sos_alert`,
     `geo_fence_in_circle`,`geo_fence_out_circle`,`harsh_acceleration`,`harsh_braking`,`harsh_cornering`,`speed_breaker_bump`,`accident`,`fuel_dip`,
     `fuel_fill`,`power_off`,`hub_in_circle`,`hub_out_circle`,`low_battery` FROM `alter_contacts` WHERE client_id = $client_id LIMIT 1" );

    if($query->num_rows() > 0)
    {
        
        return  $query->result();
    }
    else
    {
        return false;
    }
}

public function update_settings($update_data,$client_id)
{
  
    $this->db->where('client_id',$client_id);
    $query = $this->db->update("alter_contacts",$update_data);
    if($query)
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function vehicle_settings($deviceimei)
{		

     $query=$this->db->query("SELECT vehiclename,parking_alerttime,idle_alerttime,speed_limit,expected_milege,idle_rpm,max_rpm,temp_low,temp_high  FROM vehicletbl_2 WHERE deviceimei=$deviceimei" );

    if($query->num_rows() > 0)
    {
        
        return  $query->row();
    }
    else
    {
        return false;
    }
}

public function update_vehiclesettings($update_data,$deviceimei)
{
  
    $this->db->where('deviceimei',$deviceimei);
    $this->db->update('vehicletbl_2',$update_data);


    $this->db->where('deviceimei',$deviceimei);
    $query = $this->db->update("vehicletbl",$update_data);
    if($query)
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function consolidatedata_json($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  

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
    $query =  $this->db->query("SELECT (SELECT SUM(distance_km) FROM consolidate_distance_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id  AND imei=$vehicle) as distance,
    (SELECT SUM(moving_duration) FROM consolidate_ign_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as moving_duration,
    (SELECT SUM(idel_duration) FROM consolidate_idle_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as idle_duration,
    (SELECT SUM(parking_duration) FROM consolidate_park_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as parking_duration,
    (SELECT SUM(running_duration) FROM consolidate_ac_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as ac_duration,
    (SELECT SUM(fuel_consumed_litre) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_consumed_litre,
    (SELECT SUM(fuel_millege) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_milege,
    (SELECT SUM(fuel_fill_litre) FROM consolidate_fuelfill_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_fill_litre,
    (SELECT SUM(fuel_dip_litre) FROM consolidate_fueldip_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND imei=$vehicle ) as fuel_dip_litre,
    (SELECT SUM(normal_rpm+under_load+idle_rpm) FROM consolidate_rpm_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id AND deviceimei=$vehicle ) as totalrpm
    ");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->row();
            }              
    }else{
         return array(); }
       
}

public function consolidate_distance_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
   
    if($role==6)
    {
    
        $query =  $this->db->query(" SELECT DISTINCT d.date, round(SUM(d.distance_km)) as distance FROM consolidate_distance_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.distance_km)) as distance FROM consolidate_distance_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.distance_km)) as distance FROM consolidate_distance_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return array(); }
       
}


public function consolidate_moving_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
    
    if($role==6)
    {
      

        $query =  $this->db->query(" SELECT d.date,SUM(d.moving_duration * 60) as  moving_duration FROM consolidate_ign_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query(" SELECT d.date,SUM(d.moving_duration * 60) as  moving_duration FROM consolidate_ign_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query(" SELECT d.date,SUM(d.moving_duration * 60) as  moving_duration FROM consolidate_ign_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return array(); }
       
}


public function consolidate_idle_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
    
    if($role==6)
    {
      

        $query =  $this->db->query(" SELECT d.date,SUM(d.idel_duration * 60) as  idle_duration FROM consolidate_idle_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query(" SELECT d.date,SUM(d.idel_duration * 60) as  idle_duration FROM consolidate_idle_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query(" SELECT d.date,SUM(d.idel_duration * 60) as  idle_duration FROM consolidate_idle_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return array(); }
       
}


public function consolidate_park_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
    
    if($role==6)
    {
      

        $query =  $this->db->query(" SELECT d.date,SUM(d.parking_duration * 60) as  parking_duration FROM consolidate_park_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query(" SELECT d.date,SUM(d.parking_duration * 60) as  parking_duration FROM consolidate_park_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query(" SELECT d.date,SUM(d.parking_duration * 60) as  parking_duration FROM consolidate_park_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return array(); }
       
}



public function consolidate_ac_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
    
    if($role==6)
    {
      
        $query =  $this->db->query(" SELECT d.date,SUM(d.running_duration * 60) as  ac_duration FROM consolidate_ac_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query(" SELECT d.date,SUM(d.running_duration * 60) as  ac_duration FROM consolidate_ac_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query(" SELECT d.date,SUM(d.running_duration * 60) as  ac_duration FROM consolidate_ac_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return array(); }
       
}




public function consolidate_fuelfill_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
   
    if($role==6)
    {
        $query =  $this->db->query(" SELECT DISTINCT d.date, round(SUM(d.fuel_fill_litre)) as fuel_fill_litre FROM consolidate_fuelfill_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_fill_litre)) as fuel_fill_litre FROM consolidate_fuelfill_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_fill_litre)) as fuel_fill_litre FROM consolidate_fuelfill_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
        return array(); }
       
}





public function consolidate_fueldip_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
   
    if($role==6)
    {
        $query =  $this->db->query(" SELECT DISTINCT d.date, round(SUM(d.fuel_dip_litre)) as fuel_dip_litre FROM consolidate_fueldip_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_dip_litre)) as fuel_dip_litre FROM consolidate_fueldip_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_dip_litre)) as fuel_dip_litre FROM consolidate_fueldip_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
        return array();}
       
}




public function consolidate_fuelconsume_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
   
    if($role==6)
    {
        $query =  $this->db->query(" SELECT DISTINCT d.date, round(SUM(d.fuel_consumed_litre)) as fuel_consumed_litre, FROM consolidate_fuelcosumed_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_consumed_litre)) as fuel_consumed_litre FROM consolidate_fuelcosumed_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_consumed_litre)) as fuel_consumed_litre FROM consolidate_fuelcosumed_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return array(); }
       
}



public function consolidate_fuelmilege_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
   
    if($role==6)
    {
        $query =  $this->db->query(" SELECT DISTINCT d.date, round(SUM(d.fuel_millege)) as fuel_millege, FROM consolidate_fuelcosumed_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicleid WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_millege)) as fuel_millege FROM consolidate_fuelcosumed_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query("SELECT DISTINCT d.date, round(SUM(d.fuel_millege)) as fuel_millege FROM consolidate_fuelcosumed_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.imei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return array(); }
       
}


public function consolidate_rpm_chart($vehicle,$from_date,$to_date,$client_id,$userid,$role)
{
  if($vehicle==0)
  {  
    
    if($role==6)
    {
      

        $query =  $this->db->query(" SELECT d.date,SUM(d.normal_rpm+d.under_load+d.idle_rpm) as  rpm_duration FROM consolidate_rpm_report d INNER JOIN assign_owner a 
        ON a.vehicle_id = d.vehicle_id WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id AND a.owner_id=$userid GROUP BY d.date");
       
    }
    else
    {
        $query =  $this->db->query(" SELECT d.date,SUM(d.normal_rpm+d.under_load+d.idle_rpm) as  rpm_duration FROM consolidate_rpm_report d 
        WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
        AND d.client_id=$client_id GROUP BY d.date");

    }

  }
  else
  {
    $query =  $this->db->query(" SELECT d.date,SUM(d.normal_rpm+d.under_load+d.idle_rpm) as  rpm_duration FROM consolidate_rpm_report d 
    WHERE d.date BETWEEN '".$from_date."' AND '".$to_date."' 
    AND d.client_id=$client_id AND d.deviceimei=$vehicle GROUP BY d.date");
  }

    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
    
         return array(); }
       
}

public function speed_distance_data($start_date,$end_date,$deviceimei,$client_id) 
    { 
    
                       $playtable= "play_back_history_".$client_id;

                       $qry = $this->db->query("SHOW TABLES LIKE '" . $playtable . "'");

                       if ($qry->num_rows() > 0) 
                       {

                    $query1 = $this->db->query ("SELECT speed,odometer,modified_date FROM play_back_history
                     WHERE running_no =$deviceimei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND 
                     lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND modified_date
                     BETWEEN '".$start_date."' AND '".$end_date."'  UNION SELECT speed,odometer,modified_date FROM $playtable WHERE running_no =$deviceimei AND
                      lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND 
                      lon_message!='0.0' AND modified_date BETWEEN '".$start_date."' AND '".$end_date."'  
                      ORDER BY modified_date ASC");

                    } 
                    else
                    {
                        $query1 = $this->db->query("SELECT speed,odometer,modified_date FROM play_back_history WHERE running_no =$deviceimei AND 
                        lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND
                         lon_message!='0.0' AND modified_date BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY modified_date ASC");
                    }           

                    if($query1)
                    {
                        if ($query1->num_rows() > 0 ) 
                    {   
                        return $query1->result();

                        
                          
                       
                    }

                    }
             
                    else
                    {
                        return array();
                    }
                    
       
    }

	public function Fuel_report_list($from,$to,$vehicleid)
	{
		   
		if(!empty($vehicleid))
		{
				   
			$query1 = $this->db->query("SELECT fs.litres,fs.modified_date as modified_date  FROM fuel_status fs WHERE fs.running_no = $vehicleid AND fs.flag='0' AND fs.lat!='000000000' AND fs.lng!='000000000' AND (fs.modified_date >= '".$from."' AND fs.modified_date <= '".$to."') ORDER BY modified_date ASC");

		if ($query1->num_rows() > 0 ) 
		{	

			return $query1->result();
		   
		}
		else 
		{
			return array();
		}
			}
		else if($vehicleid == NULL)
		{
				
			return array();
		
		}	
	}

	public function notification_alert_admin($client_id)
{
    $query = $this->db->query("SELECT v.vehiclename,a.alert_type as alert_name,s.createdon as datetime,s.alert_location as location,s.lat,s.lng
    FROM sms_alert s
    LEFT JOIN vehicletbl v ON s.vehicle_id = v.vehicleid INNER JOIN alert_type a ON a.alert_type_id = s.all_status
    WHERE s.client_id =$client_id ORDER BY s.sms_alert_id DESC LIMIT 15");

	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return false;
	}
}



public function vehicleServiceType() {
	$query = $this->db->query("select * from expense_type where status = 1");
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return array();
	}
}

public function paymentType() {
	$query = $this->db->query("SELECT * FROM ref_paymentmode WHERE status = 1");
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return array();
	}
}

public function vehicle_service_list($client_id) {
	$query = $this->db->query("SELECT * FROM vehicle_service WHERE client_id = $client_id");
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return array();
	}
}
public function vehicle_service_edit($service_id) {
	$query = $this->db->query("SELECT * FROM vehicle_service WHERE service_id = $service_id");
	if ($query->num_rows() > 0) {
		return $query->row();
	} else {
		return array();
	}
}

//    ================================
  public function vehicle_document_list($client_id) {
	$query = $this->db->query("SELECT * FROM insurance_reminder WHERE client_id = $client_id");
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return array();
	}
}
 public function vehicle_document_edit($insurance_reminder_id) {
	$query = $this->db->query("SELECT * FROM insurance_reminder WHERE insurance_reminder_id = $insurance_reminder_id");
	if ($query->num_rows() > 0) {
		return $query->row();
	} else {
		return array();
	}
}

// ============================================================

	public function vehicle_fuel_list($client_id) {
	$query = $this->db->query("SELECT * FROM fuel_management WHERE client_id = $client_id");
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return array();
	}
}

public function vehicle_fuel_edit($fuel_management_id) {
	$query = $this->db->query("SELECT * FROM fuel_management WHERE fuel_management_id = $fuel_management_id");
	if ($query->num_rows() > 0) {
		return $query->row();
	} else {
		return array();
	}
}

public function vehicle_total_list($client_id) {
    $query = $this->db->query("SELECT vehiclename,deviceimei,simnumber,vehiclemodel,installationdate,expiredate,due_amount,IF(expiredate > CURDATE(),1,0) AS expired_status FROM vehicletbl WHERE status=1 AND client_id = $client_id");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }
}
public function vehicle_expired_list($client_id) {
    $query = $this->db->query("SELECT vehiclename,deviceimei,simnumber,vehiclemodel,installationdate,expiredate,due_amount,CURDATE() AS currentdate FROM vehicletbl WHERE status=1 AND client_id = $client_id AND expiredate < CURDATE()");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }
}

public function allvehicle_expense($client_id) {       
        $query = $this->db->query("select vs.service_id,vs.client_id,vs.vehicle_id,vs.service_type,vs.purchase_amount,vs.purchase_date,vs.purchase_product,
    vt.vehiclename,vt.vehiclemodel,vt.deviceimei,et.expense_name
    FROM vehicle_service vs
    inner join vehicletbl vt ON vt.vehicleid = vs.vehicle_id
    inner join expense_type et ON et.id = vs.service_type
    where vs.client_id=$client_id AND 
    vs.purchase_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()
   order by  vs.purchase_date desc");              
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }
}

public function vehicleWise_expense($client_id,$vehicle_id,$fromDate,$endDate) {
    $query = $this->db->query("select vs.service_id,vs.client_id,vs.vehicle_id,vs.service_type,vs.purchase_amount,vs.purchase_date,vs.purchase_product,
    vt.vehiclename,vt.vehiclemodel,vt.deviceimei,et.expense_name
    FROM vehicle_service vs
    inner join vehicletbl vt ON vt.vehicleid = vs.vehicle_id
    inner join expense_type et ON et.id = vs.service_type
    where vs.client_id=$client_id AND 
    vs.vehicle_id = $vehicle_id AND
     vs.purchase_date BETWEEN '".$fromDate."' AND '".$endDate."'
   order by  vs.purchase_date desc");              
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }   
}
public function vehicle_service_overdue($client_id) {
    $query = $this->db->query("select vs.service_id,vs.client_id,vs.vehicle_id,vs.service_type,vs.purchase_amount,
    vs.purchase_date,vs.purchase_product,vs.reminder_km,vs.reminder_date,
    vt.vehiclename,vt.vehiclemodel,vt.deviceimei,et.expense_name
    FROM vehicle_service vs
    inner join vehicletbl vt ON vt.vehicleid = vs.vehicle_id
    inner join expense_type et ON et.id = vs.service_type
    where vs.client_id=$client_id 
    AND vs.reminder_date < CURDATE()
    order by vs.purchase_date desc");              
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }   
}
public function history_alldata_admin($vehicle, $from_date, $to_date, $client_id, $userid, $role)
{

    if ($vehicle == 0) {
        if ($role == 6) {
            $query =  $this->db->query("SELECT 
        (SELECT SUM(DISTINCT d.`distance_km`) FROM consolidate_distance_report d INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as distance,
        (SELECT SUM(DISTINCT d.`moving_duration`) FROM consolidate_ign_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as moving_duration,
        (SELECT SUM(DISTINCT d.`idel_duration`) FROM consolidate_idle_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid ) as idle_duration,
        (SELECT SUM(DISTINCT d.`parking_duration`) FROM consolidate_park_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as parking_duration,
        (SELECT SUM(DISTINCT d.`running_duration`) FROM consolidate_ac_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as ac_duration,
        (SELECT SUM(DISTINCT d.`fuel_consumed_litre`) FROM consolidate_fuelcosumed_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_consumed_litre,
        (SELECT SUM(DISTINCT d.`fuel_millege`) FROM consolidate_fuelcosumed_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_milege,
        (SELECT SUM(DISTINCT d.`fuel_fill_litre`) FROM consolidate_fuelfill_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_fill_litre,
        (SELECT SUM(DISTINCT d.`fuel_dip_litre`) FROM consolidate_fueldip_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicleid 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as fuel_dip_litre,
        (SELECT SUM(DISTINCT d.normal_rpm+ d.under_load+ d.idle_rpm) FROM consolidate_rpm_report d  INNER JOIN assign_owner a ON a.vehicle_id = d.vehicle_id 
        WHERE d.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND d.client_id=$client_id AND a.owner_id=$userid) as totalrpm
        ");
        } else {
            //echo"hii";die;
            $query =  $this->db->query("SELECT (SELECT SUM(distance_km) FROM consolidate_distance_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as distance,
        (SELECT SUM(moving_duration) FROM consolidate_ign_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as moving_duration,
        (SELECT SUM(idel_duration) FROM consolidate_idle_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as idle_duration,
        (SELECT SUM(parking_duration) FROM consolidate_park_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as parking_duration,
        (SELECT SUM(running_duration) FROM consolidate_ac_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as ac_duration,
        (SELECT SUM(fuel_consumed_litre) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as fuel_consumed_litre,
        (SELECT SUM(fuel_millege) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as fuel_milege,
        (SELECT SUM(fuel_fill_litre) FROM consolidate_fuelfill_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as fuel_fill_litre,
        (SELECT SUM(fuel_dip_litre) FROM consolidate_fueldip_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as fuel_dip_litre,
        (SELECT SUM(normal_rpm+under_load+idle_rpm) FROM consolidate_rpm_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  ) as totalrpm
        ");
        }
    } else {

        $query =  $this->db->query("SELECT (SELECT SUM(distance_km) FROM consolidate_distance_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id  AND imei=$vehicle) as distance,
    (SELECT SUM(moving_duration) FROM consolidate_ign_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as moving_duration,
    (SELECT SUM(idel_duration) FROM consolidate_idle_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as idle_duration,
    (SELECT SUM(parking_duration) FROM consolidate_park_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as parking_duration,
    (SELECT SUM(running_duration) FROM consolidate_ac_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as ac_duration,
    (SELECT SUM(fuel_consumed_litre) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as fuel_consumed_litre,
    (SELECT SUM(fuel_millege) FROM consolidate_fuelcosumed_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as fuel_milege,
    (SELECT SUM(fuel_fill_litre) FROM consolidate_fuelfill_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as fuel_fill_litre,
    (SELECT SUM(fuel_dip_litre) FROM consolidate_fueldip_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND imei=$vehicle ) as fuel_dip_litre,
    (SELECT SUM(normal_rpm+under_load+idle_rpm) FROM consolidate_rpm_report WHERE date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND deviceimei=$vehicle ) as totalrpm,
    (SELECT AVG(speed) FROM play_back_history WHERE created_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND running_no=$vehicle ) as average_speed,
    (SELECT MAX(speed) FROM play_back_history WHERE created_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND client_id=$client_id AND running_no=$vehicle ) as maximum_speed
    ");
        //print_r($query);die;
    }

    if ($query) {
        if ($query->num_rows() > 0) {
            //echo"hi";die;
            return $query->row();
        }
    } else {
        return array();
    }
}

public function consolidate_playback_avg_max($imei, $start_date, $end_date, $client_id)
{

    $playtable = "play_back_history_" . $client_id;

    $qry = $this->db->query("SHOW TABLES LIKE '" . $playtable . "'");

    if ($qry->num_rows() > 0) {

        $query1 = $this->db->query("SELECT MAX(speed) as max_speed,ROUND(AVG(speed)) as avg_speed FROM $playtable WHERE running_no =$imei AND
                  lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND 
                  lon_message!='0.0' AND modified_date BETWEEN '" . $start_date . "' AND '" . $end_date . "'  ");
    } else {
        $query1 = $this->db->query("SELECT MAX(speed) as max_speed,ROUND(AVG(speed)) as avg_speed FROM play_back_history WHERE running_no =$imei AND 
        lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' 
        AND modified_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' ORDER BY modified_date DESC");
    }

    if ($query1) {
        if ($query1->num_rows() > 0) {
           return $query1->row();
        }
    } else {
        return false;
    }
}


}




