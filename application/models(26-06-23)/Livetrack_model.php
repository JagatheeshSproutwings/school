<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livetrack_model extends CI_Model
{	
	function __construct()
	{

		parent::__construct();

	}
	
		public function livetrackvehicles($timezone_minute) 
	{	
		$client_id = $this->session->userdata['client_id'];
		if($client_id=='')
		{
			$query = $this->db->query("SELECT v.deviceimei,ra.*,sr.route_name,sr.route_geo_start_id,sr.route_starttime,sr.route_endtime,l1.Lat as routestart_lat,l1.Lng as routestart_lng,l1.radius as routestart_radius,l2.radius as routeend_radius,sr.route_geo_end_id,l2.Lat as routeend_lat,l2.Lng as routeend_lng,sr.route_starttime,sr.route_endtime,v.vehiclename,v.vehicleid,v.lat,v.lng,v.speed,v.acc_on FROM `sch_routeassigntbl` ra INNER JOIN sch_routestbl sr ON sr.route_id = ra.route_id INNER JOIN vehicletbl v ON v.vehicleid=ra.vehicle_id INNER JOIN sch_location_list l1 ON l1.Location_Id=sr.route_geo_start_id INNER JOIN sch_location_list l2 ON l2.Location_Id=sr.route_geo_end_id WHERE v.timezone_minutes=$timezone_minute");
		

		}
		else
		{
			$query = $this->db->query("SELECT ra.*,sr.route_name,sr.route_geo_start_id,sr.route_starttime,sr.route_endtime,l1.Lat as routestart_lat,l1.Lng as routestart_lng,l1.radius as routestart_radius,l2.radius as routeend_radius,sr.route_geo_end_id,l2.Lat as routeend_lat,l2.Lng as routeend_lng,sr.route_starttime,sr.route_endtime,v.vehiclename,v.vehicleid,v.lat,v.lng,v.speed,v.acc_on FROM `sch_routeassigntbl` ra INNER JOIN sch_routestbl sr ON sr.route_id = ra.route_id INNER JOIN vehicletbl v ON v.vehicleid=ra.vehicle_id INNER JOIN sch_location_list l1 ON l1.Location_Id=sr.route_geo_start_id INNER JOIN sch_location_list l2 ON l2.Location_Id=sr.route_geo_end_id WHERE sr.client_id=$client_id AND v.timezone_minutes=$timezone_minute");
		

		}
		if ($query->num_rows() > 0) 
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
				$first_end_time =  date('Y-m-d H:i:s',strtotime('+ 40 minutes',strtotime($route_starttime)));
	
			$query = $this->db->query("select g_lat,g_lng,out_datetime from sch_geofence_report where geo_location_id =$route_startid
			and vehicle_id = $vehicle_id and
				out_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");
			if ($query->num_rows() > 0) 
			{
				return $query->row();
			}
			else 
			{

				return 1;
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
			return 1;
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
	// 			 $first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
	// 			 $first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
	// 		 }


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
		$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT Lat,Lng,Location_short_name FROM sch_location_list WHERE Location_Id ='$route_endid' AND client_id = '$client_id'");

	
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
		$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT lat,lng,speed,latlon_address FROM vehicletbl WHERE vehicleid =$vehicle_id AND client_id = $client_id");
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}

	public function add_livedata($livedata) {
		
		
		$query1 = $this->db->insert('sch_add_liveroute_list',$livedata);
		 $insert_id = $this->db->insert_id();
  
	if ($query1) 
	{
		return $insert_id;
	}
	else if($query2) 
	{
		return '0';
	}
}

public function livestop_details($route_id) 
{		
	$client_id = $this->session->userdata['client_id'];
	$query = $this->db->query("SELECT sr.*,sl.Location_short_name as location_name,
	sl.Lat as stop_lattitute,sl.Lng as stop_longitute,sl.radius as stop_radius FROM `sch_routestoptbl` sr INNER JOIN 
	sch_location_list sl ON sl.Location_Id = sr.stop_geo_id WHERE  sr.route_id =$route_id");
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

		 $query = $this->db->query("select g_lat,g_lng,in_datetime,out_datetime,id,location_status,geo_location_id from sch_geofence_report where geo_location_id =$stop_geoid and vehicle_id = $vehicle_id and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");
	if ($query->num_rows() > 0) 
	{
		return $query->row();
	}
	else 
	{
		return 1;
	}
}

public function stop_geoouttime($stop_geoid,$vehicle_id,$stop_start_time) 
{		
	$first_start_time = date('Y-m-d H:i:s',strtotime('- 40 minutes',strtotime($stop_start_time)));
	$first_end_time =  date('Y-m-d H:i:s',strtotime('+ 40 minutes',strtotime($stop_start_time)));


	 $query = $this->db->query("select g_lat,g_lng,out_datetime,id,location_status,geo_location_id from sch_geofence_report where geo_location_id ='$stop_geoid' and vehicle_id = '$vehicle_id' and out_datetime BETWEEN ' $first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");

	if ($query->num_rows() > 0) 
	{
		return $query->row();
	}
	else 
	{
		return 1;
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

// 		 $query = $this->db->query("select g_lat,g_lng,in_datetime from sch_geofence_report where geo_location_id ='$stop_geoid' and vehicle_id = '$vehicle_id' and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");

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
		$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT Lat,Lng,Location_short_name FROM sch_location_list WHERE Location_Id ='$stop_geoid' AND client_id = '$client_id'");

	
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
	
	public function add_livestop($livestop_data) {
		
		$query1 = $this->db->insert('sch_add_livestop_list',$livestop_data);
	
	if ($query1) 
	{
		return '1';
	}
	else if($query2) 
	{
		return '0';
	}
}

public function tripstart_alert($route_id,$checkid) 
{		
	
	if($checkid==1)
	{
		$query = $this->db->query("SELECT ss.*,r.route_name FROM sch_student ss INNER JOIN sch_routestbl r ON r.route_id=ss.route_id INNER JOIN usertbl u ON u.userid=ss.parent_id
		WHERE ss.route_id=$route_id AND ss.status=1");
	
	}

	if($checkid==2)
	{
		$query = $this->db->query("SELECT ss.*,r.route_name FROM sch_student ss INNER JOIN sch_routestbl r ON r.route_id=ss.route_id INNER JOIN usertbl u ON u.userid=ss.parent_id
	WHERE ss.route_id=$route_id AND (ss.status=2 OR ss.status=3 OR ss.status=5)");
		
	}

	if($checkid==3)
	{
		$query = $this->db->query("SELECT ss.*,r.route_name FROM sch_student ss INNER JOIN sch_routestbl r ON r.route_id=ss.route_id INNER JOIN usertbl u ON u.userid=ss.parent_id
	WHERE ss.route_id=$route_id AND ss.status=2");
	}

	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}


public function stopstart_alert($route_id,$stop_id,$checkid) 
{		
	
	if($checkid==2)
	{
		$query = $this->db->query("SELECT ss.*,r.route_name FROM sch_student ss INNER JOIN sch_routestbl r ON r.route_id=ss.route_id INNER JOIN usertbl u ON u.userid=ss.parent_id
		WHERE ss.route_id=$route_id AND ss.stop_id=$stop_id AND ss.status=2");

	}
	else if($checkid==3)
	{
		$query = $this->db->query("SELECT ss.*,r.route_name FROM sch_student ss INNER JOIN sch_routestbl r ON r.route_id=ss.route_id INNER JOIN usertbl u ON u.userid=ss.parent_id
		WHERE ss.route_id=$route_id AND ss.stop_id=$stop_id AND (ss.status=2 OR ss.status=3)");
	}

	
	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}


public function get_all_history_data($vehicle = NULL,$form_date,$to_date) 
{
	$client_id = $this->session->userdata['client_id'];

		$play_table = "play_back_history_".$client_id;
		$qry = $this->db->query("SHOW TABLES LIKE '".$play_table."'");

		$fromdate = date('Ymd',strtotime($form_date));
		$todate = date('Ymd',strtotime($to_date));
		$current_date = date('Ymd');
		//$qfetch = $qry->row();
		if($qry->num_rows () > 0)
		{
			
			 $query = $this->db->query ("SELECT t.zap,t.odometer,t.running_no,t.lat_message,t.lon_message,t.angle,t.speed,t.acc_status,t.door_status,t.modified_date as datetime,v.vehicleid as vehicle_id,v.vehiclename,v.vehicletype,v.fuel_odo FROM vehicletbl v
			  INNER JOIN ".$play_table." t ON t.running_no = v.deviceimei WHERE v.vehicleid ='".$vehicle."' AND t.lat_message!='000000000' AND t.lon_message!='000000000' 
			  AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' AND t.modified_date BETWEEN '".$form_date."' AND '".$to_date."'
			   UNION SELECT tt.zap,tt.odometer,tt.running_no,tt.lat_message,tt.lon_message,tt.angle,tt.speed,tt.acc_status,tt.door_status,tt.modified_date as datetime,vt.vehicleid as vehicle_id,vt.vehiclename as vehicle_name,vt.vehicletype,vt.fuel_odo FROM vehicletbl vt 
			   INNER JOIN play_back_history tt ON tt.running_no = vt.deviceimei WHERE vt.vehicleid ='".$vehicle."' AND tt.lat_message!='000000000' AND tt.lon_message!='000000000' AND tt.lat_message!='0' AND tt.lon_message!='0' AND tt.lat_message!='0.0' AND tt.lon_message!='0.0' 
			   AND tt.modified_date BETWEEN '".$form_date."' AND '".$to_date."'  ORDER BY datetime ASC");
			
			
		}
		else
		{
			$query = $this->db->query ("SELECT t.zap,t.odometer,t.running_no,t.lat_message,t.lon_message,t.angle,t.speed,t.acc_status,t.door_status,t.modified_date as datetime,v.vehicleid,v.vehiclename,v.vehicletype FROM vehicletbl v INNER JOIN play_back_history t ON t.running_no = v.deviceimei WHERE v.vehicleid ='".$vehicle."' AND t.lat_message!='000000000' AND t.lon_message!='000000000' AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' AND DATE_FORMAT(t.modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$form_date."' AND '".$to_date."'  ORDER BY t.modified_date ASC");
		}

		
	if($query->num_rows() > 0) 
	{
		return $query->result();
	} 
	else
	{
		return FALSE;
	}

}



public function route_latlng($route_id) 
{		
	$query = $this->db->query("SELECT l.Location_short_name as startroute_name,l.Lat as routestartlat,l.Lng as routestartlng,
	DATE_FORMAT(r.route_exitime, '%H:%i %p') as routestarttime,DATE_FORMAT(r.route_planstart_time, '%H:%i %p') as route_planstart_time,l.radius as sradius,
	DATE_FORMAT(r.route_entry_time, '%H:%i %p') as routesendtime,DATE_FORMAT(r.route_planend_time, '%H:%i %p') as route_planend_time,l2.radius as eradius,
	r.route_id,
	l2.Location_short_name as endroute_name,l2.Lat as routeendtlat,l2.Lng as routeendtlng FROM sch_add_liveroute_list r INNER JOIN sch_location_list l ON l.Location_Id = r.route_startid 
	INNER JOIN sch_location_list l2 ON l2.Location_Id = r.route_endid WHERE r.live_routeid=$route_id");
	
	if ($query->num_rows() > 0) 
	{
		return $query->row();
	}
	else 
	{
		return false;
	}
}

public function stop_latlng($route_id) 
{		
	$query = $this->db->query("SELECT l.Location_short_name as stop_name,l.Lat as stoplat,l.Lng as stoplng,l.radius as stopradius,
	DATE_FORMAT(ss.stopplaned_entry, '%H:%i %p') as stopplaned_entry,DATE_FORMAT(ss.stopplaned_exit, '%H:%i %p') as stopplaned_exit,
	DATE_FORMAT(ss.stopentry_time, '%H:%i %p') as stopentry_time,DATE_FORMAT(ss.stopentry_time, '%H:%i %p') as stopentry_time,ss.stop_geo_id
	 FROM sch_add_livestop_list ss INNER JOIN sch_location_list l ON l.Location_Id = ss.stop_geo_id 
	 WHERE ss.live_routeid=$route_id");
	
	if ($query->num_rows() > 0) 
	{
		return $query->result();
	}
	else 
	{
		return false;
	}
}

public function student_stop_count($route_id,$stop_id) 
{	
	
	$query = $this->db->query("SELECT count(*) as student_count FROM sch_student WHERE route_id=$route_id AND stop_id = $stop_id");
	if ($query->num_rows() > 0) 
	{
		$data =  $query->row();
		return $data->student_count;
	}
	else 
	{
		return false;
	}
}

	
public function stopid_list($route_id,$stop_geoid) 
{		
	
	$query = $this->db->query("SELECT stop_id FROM  sch_routestoptbl r WHERE r.route_id=$route_id AND r.stop_geo_id=$stop_geoid");
	
	if ($query->num_rows() > 0) 
	{
		 $data = $query->row();
		 return $data->stop_id;

	}
	else 
	{
		return false;
	}
}

public function last_georeport_data($g_id,$vid)
		{
			$query = $this->db->query("SELECT location_status,id,geo_location_id,in_datetime,out_datetime FROM sch_geofence_report 
			WHERE geo_location_id = $g_id AND vehicle_id =$vid ORDER BY id DESC LIMIT 1");

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return 0;
		}
			

	}

	public function get_rfid_data($stop_id)
	{
	    $query = $this->db->query("SELECT ss.student_name,ss.student_id,(CASE WHEN srf.rfid_number = ss.student_rfid_no THEN '1' ELSE '0' END)AS attentance FROM sch_student ss 
		INNER JOIN sch_routestoptbl sr ON ss.stop_id = sr.stop_id 
		LEFT JOIN student_rfid_report srf ON ss.student_rfid_no = srf.rfid_number 
		WHERE sr.stop_geo_id=$stop_id ");
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}

	}


}
