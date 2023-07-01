<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
class Cron_model extends CI_Model
{	
	function __construct()
	{

		parent::__construct();

	}
	public function allliveroutelist($shift_type)
	{
	$query = $this->db->query("SELECT ra.*,sr.route_name,sr.route_geo_start_id,sr.route_geo_end_id,sr.route_starttime,sr.route_endtime,v.vehiclename FROM `sch_routeassigntbl` ra INNER JOIN sch_routestbl sr ON sr.route_id = ra.route_id INNER JOIN vehicletbl_2 v ON v.vehicleid=ra.vehicle_id WHERE `shift_type`=1");
	//echo " SELECT * FROM routes ";
	
	if($query->num_rows()>0)
	{
	return $query->result();
	}
	else
	{
	false;
	}
	}
	



	public function routestartgeo($route_startid,$vehicle_id,$shift_type) 
	{		
		   $client_id = $this->session->userdata['client_id'];

		    if($shift_type==1)
			{
				$first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
				$first_end_time = date('Y-m-d H:i:s',strtotime('14:00:00'));
			}
			else
			{
				$first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
				$first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
			}
			
		
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


		public function routeendgeo($route_endid,$vehicle_id,$shift_type) 
	{		
		$client_id = $this->session->userdata['client_id'];


			 if($shift_type==1)
			 {
				 $first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
				 $first_end_time = date('Y-m-d H:i:s',strtotime('14:00:00'));
			 }
			 else
			 {
				 $first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
				 $first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
			 }


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

	public function routelatlng($route_endid,$client_id) 
	{		
		$query = $this->db->query("SELECT Lat,Lng FROM sch_location_list WHERE Location_Id ='$route_endid' AND client_id = '$client_id'");

	
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
		public function vehiclelatlng($vehicle_id,$client_id) 
	{		
		$query = $this->db->query("SELECT lat,lng,speed FROM vehicletbl WHERE vehicleid ='".$vehicle_id."' AND client_id = '".$client_id."'");

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
	$query = $this->db->query("SELECT * FROM sch_routestoptbl WHERE route_id ='$route_id'");
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


public function stop_geointime($stop_geoid,$vehicle_id,$shift_type) 
{			
	 if($shift_type==1)
	{
		$first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
		$first_end_time = date('Y-m-d H:i:s',strtotime('14:00:00'));
	}
	else
	{
		$first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
		$first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
	}

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

public function stop_geoouttime($stop_geoid,$vehicle_id,$shift_type) 
{		
		
	if($shift_type==1)
	{
		$first_start_time = date('Y-m-d H:i:s',strtotime('05:00:00'));
		$first_end_time = date('Y-m-d H:i:s',strtotime('14:00:00'));
	}
	else
	{
		$first_start_time = date('Y-m-d H:i:s',strtotime('15:00:00'));
		$first_end_time = date('Y-m-d H:i:s',strtotime('19:00:00'));
	}


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

		public function stoplatlng($stop_geoid,$client_id) 
	{		
		$query = $this->db->query("SELECT Lat,Lng FROM sch_location_list WHERE Location_Id ='$stop_geoid' AND client_id = '$client_id'");

	
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


public function geo_vehicle_location()
{
	
	$query = $this->db->query("SELECT ll.Location_Id,ll.radius,v.vehicleid,v.vehiclename,v.vehiclemodel,ll.Location_short_name,ll.Lat as g_lat,ll.Lng as g_lng,ll.circle_size,v.mobile,v.lat as v_lat,v.lng as v_lng,v.client_id,v.speed,v.acc_on,v.vehicleid,v.odometer as kilometer,v.traveled_distance FROM sch_assign_geo_fenceing af INNER JOIN sch_location_list ll ON ll.Location_Id = af.geo_location_id INNER JOIN vehicletbl v ON v.vehicleid = af.vehicle_id");
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return FALSE;
	}
}

public function last_georeport_data($g_id,$vid)
{

$query = $this->db->query("SELECT * FROM sch_geofence_report WHERE geo_location_id = '".$g_id."' AND vehicle_id ='".$vid."' ORDER BY id DESC LIMIT 1");

if($query->num_rows() > 0)
{
	return $query->result_array();
}
else
{
	return 0;
}
}


}
