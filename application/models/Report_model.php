<?php
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{	
	function __construct()
	{

		parent::__construct();

	}
		public function fuel_vehicle(){  		
		
		$client_id = $this->session->userdata['client_id'];		
		
		$role_id = $this->session->userdata['roleid'];		
		$user_id = $this->session->userdata['userid'];		
		if($role_id != 6)
		{
			$query =  $this->db->query("SELECT vehicleid,deviceimei,vehiclename,vehicletype FROM vehicletbl WHERE status ='1' AND (device_type=2 OR device_type=4 OR device_type=6 OR device_type=7 OR device_type > 10 OR device_type=11 OR device_type > 12 OR device_type=13 OR device_type > 15 OR device_type=16) AND client_id =".$client_id);
			if ($query->num_rows() > 0) 
			{
				return $query->result();
			}
			else 
			{
				return FALSE;
			}
		}
		else{
			$user_id = $this->session->userdata['user_id'];

			$query =  $this->db->query("SELECT vehicleid,deviceimei,vehiclename,vehicletype FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid  WHERE v.vehicleid!='NULL' AND ao.owner_id ='$user_id' AND v.status ='1' AND (v.device_type=2 OR v.device_type=4 OR v.device_type=6 OR v.device_type=7 OR v.device_type > 10 OR v.device_type=11 OR v.device_type > 12 OR v.device_type=13 OR v.device_type > 15 OR v.device_type=16) AND v.client_id =".$client_id);

			if ($query->num_rows() > 0) 
			{
				return $query->result();
			}
			else 
			{
				return FALSE;
			}
		
		}
	}



	public function battery_vehicle(){  		
		
		$client_id = $this->session->userdata['client_id'];		
		
		$role_id = $this->session->userdata['roleid'];	

		if($role_id != 4)
		{
	      
			$query =  $this->db->query("SELECT vehicleid,deviceimei,vehiclename,vehicletype FROM vehicletbl WHERE status ='1' AND client_id =".$client_id);
		
			if ($query->num_rows() > 0) 
			{
				return $query->result();
			}
			else 
			{
				return FALSE;
			}
		}
	
	}

	public function battery_report_list($from,$to,$vehicleid)
	{

		if(!empty($vehicleid))
		{
		
		$query1 = $this->db->query("SELECT mainbl as battery, modified_date as created_date FROM health_status WHERE running_no = '".$vehicleid."'  AND (modified_date >= '".$from."' AND modified_date <= '".$to."') ORDER BY modified_date ASC");
		
		if ($query1->num_rows() > 0 ) 
		{	

			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
			}
		else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}	
	}
	
	public function get_vehicle($vehicle)
	{
		$query =  $this->db->query("SELECT v_running_no,vehicle_id,vehicle_name,vehicle_register_number,vehicle_model from vehicle where v_running_no='".$vehicle."'");

		if($query)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function i_button_details_rating()
	{

		$client_id = $this->session->userdata['client_id'];

		$query = $this->db->query("select * from i_button_details");
		
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

		//Fetching I Button data 
	public function i_buttonactivity_details($driver,$vehicle,$from,$to)
	{

		$client_id = $this->session->userdata['client_id'];

		if($vehicle=='all' || $driver=='all')
		{

			$query = $this->db->query("select ibl.*,v.v_running_no,v.vehicle_name,v.device_config_type,ibd.i_button_no,ibd.driver_name from i_button_livedata ibl LEFT JOIN i_button_details ibd ON ibd.i_button_no = ibl.ibutton_id LEFT JOIN vehicle v ON v.v_running_no = ibl.imei where ibl.imei!='0123456789' AND ibd.client_id ='".$client_id."' AND DATE_FORMAT(ibl.logged_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from."' AND '".$to."' GROUP BY ibl.logged_datetime ORDER BY ibl.logged_datetime ASC");
		}
		else if($vehicle=='' && $driver!='all' && $driver!='')
		{
			$query = $this->db->query("select ibl.*,v.v_running_no,v.vehicle_name,v.device_config_type,ibd.i_button_no,ibd.driver_name from i_button_livedata ibl LEFT JOIN i_button_details ibd ON ibd.i_button_no = ibl.ibutton_id LEFT JOIN vehicle v ON v.v_running_no = ibl.imei where ibl.imei!='0123456789' AND ibd.client_id ='".$client_id."' AND ibl.ibutton_id='".$driver."' AND DATE_FORMAT(ibl.logged_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from."' AND '".$to."' GROUP BY ibl.logged_datetime ORDER BY ibl.logged_datetime ASC");
		}
		else if($driver=='' && $vehicle!='all' && $vehicle!='')
		{
			$query = $this->db->query("select ibl.*,v.v_running_no,v.vehicle_name,v.device_config_type,ibd.i_button_no,ibd.driver_name from i_button_livedata ibl LEFT JOIN i_button_details ibd ON ibd.i_button_no = ibl.ibutton_id LEFT JOIN vehicle v ON v.v_running_no = ibl.imei where ibl.imei!='0123456789' AND ibd.client_id ='".$client_id."' AND ibl.imei='".$vehicle."' AND DATE_FORMAT(ibl.logged_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from."' AND '".$to."' GROUP BY ibl.logged_datetime ORDER BY ibl.logged_datetime ASC");
		}
		else if($driver!='' && $vehicle=='all' && $vehicle=='')
		{
			$query = $this->db->query("select ibl.*,v.v_running_no,v.vehicle_name,v.device_config_type,ibd.i_button_no,ibd.driver_name from i_button_livedata ibl LEFT JOIN i_button_details ibd ON ibd.i_button_no = ibl.ibutton_id LEFT JOIN vehicle v ON v.v_running_no = ibl.imei where ibl.imei!='0123456789' AND ibd.client_id ='".$client_id."' AND ibl.ibutton_id='".$driver."' AND DATE_FORMAT(ibl.logged_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from."' AND '".$to."' GROUP BY ibl.logged_datetime ORDER BY ibl.logged_datetime ASC");
		}
		else if($vehicle!='' && $vehicle!='all' && $driver!='all' && $driver!='')
		{
			$query = $this->db->query("select ibl.*,v.v_running_no,v.vehicle_name,v.device_config_type,ibd.i_button_no,ibd.driver_name from i_button_livedata ibl LEFT JOIN i_button_details ibd ON ibd.i_button_no = ibl.ibutton_id LEFT JOIN vehicle v ON v.v_running_no = ibl.imei where ibl.imei!='0123456789' AND ibd.client_id ='".$client_id."' AND ibl.ibutton_id='".$driver."' AND ibl.imei='".$vehicle."' AND DATE_FORMAT(ibl.logged_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from."' AND '".$to."' GROUP BY ibl.logged_datetime ORDER BY ibl.logged_datetime ASC");
		}
		
		
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function i_button_details()
	{

		$client_id = $this->session->userdata['client_id'];

		$query = $this->db->query("select * from i_button_details where client_id ='".$client_id."'");
		
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	

	public function insert_data($id, $data)
	{
			$this->db->where('User_details_Id',$id);
   			$q = $this->db->get('user_details');

   			if ( $q->num_rows() > 0 ) 
   			{
			   $this->db->where('User_details_Id',$id);
			   $query1 = $this->db->update('user_details',$data);
			   
		   	} else {
				
			   $query2 = $this->db->insert('user_details',$data);
		   	}	
				
			if($query1){
				
				return 'Updated';
				
			}elseif($query2){
				
				return 'Inserted';
				
			}
		
	}

public function trip_solution_list($from,$to,$vehicleid = NULL)
	{
		
		if(!empty($vehicleid))
		{

			$client_id = $this->session->userdata['client_id'];

		//	echo "SELECT ts.start_odometer,ts.end_odometer,ts.out_datetime as start_day,ts.in_datetime as end_day,TIME_FORMAT(TIMEDIFF(ts.in_datetime,ts.out_datetime), '%H:%i:%s') as distance,ts.trip_id,ts.vehicle_id,v.v_running_no,TIMESTAMPDIFF(MINUTE,ts.out_datetime,ts.in_datetime) as trip_mins ,TIMESTAMPDIFF(HOUR,ts.out_datetime,ts.in_datetime) as trip_hours,tsl.location_name FROM trip_solution_data ts LEFT JOIN vehicle v ON v.vehicle_id = ts.vehicle_id LEFT JOIN trip_solution_location tsl ON tsl.id = ts.g_id WHERE ts.vehicle_id ='".$vehicleid."' AND ts.client_id = '".$client_id."' AND ts.location_status ='2' AND (ts.end_odometer - ts.start_odometer) >0  AND DATE_FORMAT(ts.out_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' GROUP BY ts.trip_id ORDER BY ts.trip_id DESC"; exit();
			
		$query1 = $this->db->query("SELECT ts.start_odometer,ts.end_odometer,ts.out_datetime as start_day,ts.in_datetime as end_day,TIME_FORMAT(TIMEDIFF(ts.in_datetime,ts.out_datetime), '%H:%i:%s') as distance,ts.trip_id,ts.vehicle_id,v.v_running_no,TIMESTAMPDIFF(MINUTE,ts.out_datetime,ts.in_datetime) as trip_mins ,TIMESTAMPDIFF(HOUR,ts.out_datetime,ts.in_datetime) as trip_hours,tsl.location_name FROM trip_solution_data ts LEFT JOIN vehicle v ON v.vehicle_id = ts.vehicle_id LEFT JOIN trip_solution_location tsl ON tsl.id = ts.g_id WHERE ts.vehicle_id ='".$vehicleid."' AND ts.client_id = '".$client_id."' AND ts.location_status ='2' AND (ts.end_odometer - ts.start_odometer) >0  AND DATE_FORMAT(ts.out_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ORDER BY ts.id DESC");
			   
		
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
	}
	else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}		
	}

	
	public function immobilzar_report_list($from_date,$to_date,$vehicle,$status)
	{
		if($status!='')
		{
			$query = $this->db->query("select im.*,v.vehicle_name,v.vehicle_register_number from immobilzar im LEFT JOIN vehicle v on v.vehicle_id = im.vehicle_id where im.vehicle_id ='".$vehicle."' AND on_off_status='".$status."' AND DATE_FORMAT(im.created_on, '%Y-%m-%d %H:%i') BETWEEN '".$from_date."' AND '".$to_date."' ");
		}
		else
		{
			$query = $this->db->query("select im.*,v.vehicle_name,v.vehicle_register_number from immobilzar im LEFT JOIN vehicle v on v.vehicle_id = im.vehicle_id where im.vehicle_id ='".$vehicle."' AND DATE_FORMAT(im.created_on, '%Y-%m-%d %H:%i') BETWEEN '".$from_date."' AND '".$to_date."' ");
		}
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}



public function get_all_trip_data($from,$to,$vehicle)
	{
		
			
		$query1 = $this->db->query("SELECT ph.lat_message as lat,ph.lon_message as lng,ROUND(ph.speed) as speed,ph.modified_date as created_on,ph.distance_travelled as distance , ph.acc_status as ignition_status,ph.door_status as ac_status FROM report_backup_data ph LEFT JOIN vehicle v ON v.v_running_no = ph.running_no WHERE DATE_FORMAT(ph.modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' AND v.vehicle_id ='".$vehicle."' AND ROUND(ph.speed) !='0' AND ph.acc_status ='1' ORDER BY ph.modified_date ASC");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
			
	}
	
	public function speed_report_list($form_date,$to_date,$vehicle = NULL,$Speed)
	{
		   
		$client_id = $this->session->userdata['client_id'];

			$play_table = "play_back_history_".$client_id;
			$qry = $this->db->query("SHOW TABLES LIKE '".$play_table."'");

			if($qry->num_rows () > 0)
			{
				//echo "rigth";	exit();
				 $query = $this->db->query ("SELECT t.odometer,t.running_no,t.lat_message,t.lon_message,t.speed,t.acc_status,t.door_status,t.modified_date as datetime,t.zap as location_address FROM ".$play_table." t WHERE t.speed >='".$Speed."' AND t.running_no ='".$vehicle."' AND t.lat_message!='000000000' AND t.lon_message!='000000000' AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' AND DATE_FORMAT(t.modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$form_date."' AND '".$to_date."' UNION SELECT tt.odometer,tt.running_no,tt.lat_message,tt.lon_message,tt.speed,tt.acc_status,tt.door_status,tt.modified_date as datetime,tt.zap as location_address FROM play_back_history tt WHERE tt.speed >='".$Speed."' AND tt.running_no ='".$vehicle."' AND tt.lat_message!='000000000' AND tt.lon_message!='000000000' AND tt.lat_message!='0' AND tt.lon_message!='0' AND tt.lat_message!='0.0' AND tt.lon_message!='0.0' AND DATE_FORMAT(tt.modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$form_date."' AND '".$to_date."'  ORDER BY datetime ASC");
				
		 		
			}
			else
			{
				$query = $this->db->query ("SELECT t.odometer,t.running_no,t.lat_message,t.lon_message,t.speed,t.acc_status,t.door_status,t.modified_date as datetime,t.zap as location_address FROM play_back_history t WHERE t.speed >='".$Speed."' AND  t.running_no ='".$vehicle."' AND t.lat_message!='000000000' AND t.lon_message!='000000000' AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' AND DATE_FORMAT(t.modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$form_date."' AND '".$to_date."'  ORDER BY t.modified_date ASC");
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

	
	public function fuel_data_distance($from,$to,$vehicleid)
	{
		 
	//echo "SELECT min(litres) as start_fuel, max(litres) as end_fuel,  min(odometer) as start_odo, max(odometer) as end_odo  FROM fuel_status  FORCE INDEX (running_no_4) WHERE running_no ='".$vehicleid."' AND flag='0' AND litres!='0' AND odometer!='0' AND (modified_date >= '".$from."' AND modified_date <= '".$to."') "; exit();
		$query = $this->db->query("SELECT modified_date,litres, odometer FROM fuel_status  FORCE INDEX (running_no_4) WHERE running_no ='".$vehicleid."' AND flag=0 AND litres!='0' AND odometer!='0' AND (modified_date >= '".$from."' AND modified_date <= '".$to."') ORDER BY modified_date DESC");//DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from."' AND '".$to."'

				if ($query->num_rows() > 0 ) 
				{	
					 //$result=$query->result_array();

					return $query->result();
				   
				}
				else 
				{
					return FALSE;
				}
	
	}

	public function get_fuel_data($d_id,$from,$to,$type_id) 
	{		

		if($type_id==2)
		{
			//$query = $this->db->query("SELECT * from fuel_fill_dip_report WHERE running_no ='".$d_id."' AND type_id='2' AND DATE_FORMAT(end_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ");
//			$query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.end_date as created_on,fl.end_date,fl.type_id, fl.location_name FROM vehicle v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.v_running_no WHERE v.v_running_no ='".$d_id."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$from."' AND '".$to."' AND fl.type_id ='2' ORDER BY fl.end_date DESC");
			$query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,
                        fl.end_date as created_on,fl.end_date,fl.type_id, fl.location_name 
                        FROM vehicletbl v 
                        LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei 
                        WHERE v.vehicleid =2 
                        AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '2021-09-18 09:48:29' 
                        AND '2021-09-19 09:48:29'
                        AND fl.type_id ='2' ");
		}
		else if($type_id==3)
		{
			//$query = $this->db->query("SELECT * from fuel_fill_dip_report WHERE running_no ='".$d_id."' AND type_id='1' AND DATE_FORMAT(created_on, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ");
			$query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.start_date,fl.end_date,fl.end_date as created_on,fl.type_id, fl.location_name FROM vehicle v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.v_running_no WHERE v.v_running_no ='".$d_id."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$from."' AND '".$to."' AND fl.type_id ='1' ORDER BY fl.end_date DESC");
		}
		else if($type_id==1)
		{
			//$query = $this->db->query("SELECT * from fuel_fill_dip_report WHERE running_no ='".$d_id."' AND DATE_FORMAT(created_on, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ");
			$query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.start_date,fl.end_date,fl.end_date as created_on,fl.type_id, fl.location_name FROM vehicle v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.v_running_no WHERE v.v_running_no ='".$d_id."' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i:%s') between '".$from."' AND '".$to."' ORDER BY fl.end_date DESC");
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

	public function fuel_mileage_list($from,$to,$vehicleid = NULL)
	{
		   
		if(!empty($vehicleid))
		{
		
						   
				$query = $this->db->query("SELECT SUM(distance) as distance_trl,SUM(fuel_redue) as fuel_trl,SUM(distance) / SUM(fuel_redue) as fuel_mileage,start_date FROM fuel_mileage_report WHERE vehicle_id ='".$vehicleid."' AND DATE(start_date) BETWEEN '".$from."' AND '".$to."' AND ROUND(fuel_redue) > '0' GROUP BY DATE(start_date)");

				if ($query->num_rows() > 0 ) 
				{	
					 //$result=$query->result_array();

					return $query->result();
				   
				}
				else 
				{
					return FALSE;
				}
		}
	
	}
	public function ac_duration($from,$to,$vehicleid = NULL)
	{


		if(!empty($vehicleid))
			{

				
				$query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIME_FORMAT(TIMEDIFF(end_day,start_day), '%H:%i:%s')))) as total_time_duration,ROUND(SUM(total_km)) as sum_total_km FROM ac_report where type_id=4 and vehicle_id='".$vehicleid."' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') between '".$from."' AND '".$to."' ORDER BY report_id DESC");  //distance,day,DESC


				if($query->num_rows() > 0)
				{
					return $query->result_array();
				}
				else
				{
					return FALSE;
				}		
			}
			else if($vehicleid == NULL)
			{
				
				return FALSE;
		
			}

	}
	public function fuel_data($vehicleid = NULL)
	{


		if(!empty($vehicleid))
			{

				
				$query = $this->db->query("SELECT fuel_ltr,fuel_tank_capacity,ROUND(litres) as litres FROM vehicle WHERE v_running_no ='".$vehicleid."'");  //distance,day,DESC


				if($query->num_rows() > 0)
				{
					return $query->result_array();
				}
				else
				{
					return FALSE;
				}		
			}
			else if($vehicleid == NULL)
			{
				
				return FALSE;
		
			}

	}
	public function fuel_dipfill_list()
	{

		$client_id = $this->session->userdata['client_id'];		

		$query = $this->db->query("SELECT * from fueltemp_table where client_id='".$client_id."' ");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return FALSE;
		}

	}
	
	public function fuel_fill_dip_data($from_date,$to_date,$vehicle,$type_id)
	{
		switch ($type_id) {
				    case 1:
//					$query =  $this->db->query("SELECT SUM(fl.difference_fuel) as fuel_dip FROM vehicle v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.v_running_no WHERE v.vehicle_id ='".$vehicle."' AND fl.type_id ='1' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i') between '".$from_date."' AND '".$to_date."'");
                                                    $query =  $this->db->query("SELECT SUM(fl.difference_fuel) as fuel_dip 
                                                    FROM vehicletbl v 
                                                    LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei 
                                                    WHERE v.vehicleid ='2' 
                                                    AND fl.type_id ='1' 
                                                    AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i') between '2021-09-18 09:48:29' 
                                                    AND '2021-09-19 09:48:29'");
					break;
				    case 2:
					$query =  $this->db->query("SELECT SUM(fl.difference_fuel) as fuel_fill FROM vehicle v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.v_running_no WHERE v.vehicle_id ='".$vehicle."' AND fl.type_id ='2' AND DATE_FORMAT(fl.end_date, '%Y-%m-%d %H:%i') between '".$from_date."' AND '".$to_date."'");
					break;
		}
		if ($query->num_rows() > 0) 
		{
			return $query->result_array();
		}
		else 
		{
			return FALSE;
		}

	}


	public function Ac_report_list($from,$to,$vehicleid = NULL,$time)
	{
		  
		if(!empty($vehicleid))
		{
				$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,ip.start_location,ip.end_location,v.vehicle_name FROM ac_report ip LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.device_no='".$vehicleid."' AND ip.end_day !='' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'".$time."' AND  DATE_FORMAT(ip.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ORDER BY start_day DESC");
			
			if ($query1->num_rows() > 0 ) 
			{	
				 //$result=$query->result_array();

				return $query1->result();
			   
			}
			else 
			{
				return FALSE;
			}
		}
	}

	public function get_ac_route_data($d_id,$from,$to) 
	{		
		$query = $this->db->query("SELECT lat_message,lon_message,ROUND(speed) as speed FROM play_back_history WHERE DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' AND running_no ='".$d_id."' AND  acc_status ='1' ORDER BY modified_date ASC");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function Fuel_report_list($from,$to,$vehicleid)
	{
		   
		if(!empty($vehicleid))
		{
			//echo "SELECT lat,lng,speed,created_date,litres,ROUND(odometer) as distance,ignition FROM fuel_status WHERE running_no = '".$vehicleid."' AND flag='0' AND lat!='000000000' AND lng!='000000000' AND (modified_date >= '".$from."' AND modified_date <= '".$to."') ORDER BY modified_date ASC"; exit();
		$query1 = $this->db->query("SELECT lat,lng,speed,created_date,litres,ROUND(odometer) as distance,ignition FROM fuel_status  FORCE INDEX (running_no_4) WHERE running_no = '".$vehicleid."' AND flag=0 AND lat!='000000000' AND lng!='000000000' AND (modified_date >= '".$from."' AND modified_date <= '".$to."') ORDER BY modified_date ASC");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	

			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
			}
		else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}	
	}

	public function Temperature_report_list($from,$to,$vehicleid)
	{
		   
		if(!empty($vehicleid))
		{
			$query1 = $this->db->query("SELECT lat,lng,speed,created_date,ROUND(litres) as temp,ROUND(odometer) as distance,ignition FROM fuel_status  FORCE INDEX (running_no_4) WHERE running_no = '".$vehicleid."' AND flag=0 AND lat!='000000000' AND lng!='000000000' AND (modified_date >= '".$from."' AND modified_date <= '".$to."') ORDER BY modified_date ASC");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	

			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
			}
		else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}	
	}

	// public function Temperature_report_list($from,$to,$vehicleid)
	// {
		   
	// 	if(!empty($vehicleid))
	// 	{
			
	// 	$query1 = $this->db->query("SELECT fs.lat,fs.lng,fs.celsius,fs.created_date,fs.fahrenheit,fs.humidity FROM vehicle v LEFT JOIN temperature_status fs ON fs.running_no = v.v_running_no WHERE v.v_running_no = '".$vehicleid."' AND DATE_FORMAT(fs.created_date, '%Y-%m-%d %H:%i') between '".$from."' AND '".$to."'");
				   
		
	// 	if ($query1->num_rows() > 0 ) 
	// 	{	

	// 		return $query1->result();
		   
	// 	}
	// 	else 
	// 	{
	// 		return FALSE;
	// 	}
	// 		}
	// 	else if($vehicleid == NULL)
	// 	{
				
	// 		return FALSE;
		
	// 	}	
	// }
	public function all_fuel_consupation_data($from,$to,$vehicleid)
	{
		   
		if(!empty($vehicleid))
		{
			
		$query1 = $this->db->query("SELECT fs.lat,fs.lng,fs.speed,fs.created_date,fs.litres FROM vehicle v LEFT JOIN fuel_status fs ON fs.running_no = v.v_running_no WHERE v.v_running_no = '".$vehicleid."'  AND fs.flag='0' AND DATE_FORMAT(fs.created_date, '%Y-%m-%d %H:%i') between '".$from."' AND '".$to."'");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	

			return $query1->result_array();
		   
		}
		else 
		{
			return FALSE;
		}
			}
		else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}	
	}

	public function ignition_duration($from,$to,$vehicleid = NULL)
	{

		
		if(!empty($vehicleid))
			{

				
				$query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIME_FORMAT(TIMEDIFF(end_day,start_day), '%H:%i:%s')))) as total_time_duration,ROUND(SUM(total_km)) as sum_total_km FROM ignition_report WHERE device_no='".$vehicleid."' AND flag ='2' AND end_day !='' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'  GROUP BY end_day ORDER BY start_day DESC");  //distance,day,DESC


				if($query->num_rows() > 0)
				{
					return $query->result_array();
				}
				else
				{
					return FALSE;
				}		
			}
			else if($vehicleid == NULL)
			{
				
				return FALSE;
		
			}

	}

	

	public function Distance_report_list($from,$to,$vehicleid = NULL,$device_config_type)
	{
		
		if(!empty($vehicleid))
		{

			if($device_config_type==2)
			{
				
				$query1 = $this->db->query("SELECT ROUND(SUM(end_odometer-start_odometer),2) as distance FROM ignition_report1 WHERE device_no='".$vehicleid."' AND flag ='2' AND end_day !='' AND (start_day >= '".$from."' AND start_day <= '".$to."')  GROUP BY end_day");

				if ($query1->num_rows() > 0 ) 
				{	
					 $result=$query1->result();

					 $n = count($result)-1;

					 $dist_km = round(($result[0]->odometer-$result[$n]->odometer),3);

					 return $dist_km;
				   
				}
			}
			else
			{
				$cur_date=date("Y-m-d");
				if($from==$cur_date && $cur_date==$to)
				{
					$client_id = $this->session->userdata['client_id'];

					$playtable= "play_back_history_".$client_id;

					$from_date1 = $from." 00:00:00";
					$to_date1 = $to." 23:59:59";

					$query1 = $this->db->query ("SELECT odometer,modified_date FROM play_back_history WHERE running_no ='".$vehicleid."' AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date1."' AND '".$to_date1."'  UNION SELECT odometer,modified_date FROM ".$playtable." WHERE running_no ='".$vehicleid."' AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date1."' AND '".$to_date1."'  ORDER BY modified_date DESC");

					if ($query1->num_rows() > 0 ) 
					{	
						 $result=$query1->result();

						 $n = count($result)-1;

						 $dist_km = round(($result[0]->odometer-$result[$n]->odometer),3);

						 return $dist_km;
					   
					}
				}
				else
				{
					$client_id = $this->session->userdata['client_id'];
					$query = $this->db->query("SELECT DISTINCT date, imei,distance_km FROM consolidate_distance_report WHERE imei='".$vehicleid."' AND (date = '".$from."' AND date = '".$to."') AND client_id ='".$client_id."'");
					if ($query->num_rows() > 0 ) 
					{	
						 $result=$query->row();

						 return $result->distance_km;
					   
					}
				}
				
			}
			

		}
		else
			{
				return false;
			}
	}

	public function ibutton_name($i_button_no)
	{
		$query = $this->db->query("select i_button_no,driver_name from i_button_details where i_button_no='".$i_button_no."'");
		if($query)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function Driverrating_details($from,$to,$ibutton_no = NULL)
	{
		
		if(!empty($ibutton_no))
		{
			$client_id = $this->session->userdata['client_id'];	

			$query1 = $this->db->query(" SELECT i_button_no,driver_name,SUM(distance) as distance,SUM(tot_alert_count) as alert_count FROM driver_rating WHERE client_id='".$client_id."' AND i_button_no='".$ibutton_no."' AND (datetime >= '".$from."' AND datetime <= '".$to."') ");

			if ($query1->num_rows() > 0 ) 
			{	
				 //$query->result();

				return $query1->row();
			   
			}
			else 
			{
				return FALSE;
			}
		}
	}

	public function Driverrating_list($from,$to,$ibutton_no = NULL)
	{
		
		if(!empty($ibutton_no))
		{

			$query1 = $this->db->query(" SELECT vehicle_id FROM i_button_report WHERE ibutton_no='".$ibutton_no."' AND (end_odometer - start_odometer) >0 AND end_day !=''  AND start_day >= '".$from."' AND start_day <= '".$to."' GROUP BY 'vehicle_id' ");

			if ($query1->num_rows() > 0 ) 
			{	
				 //$query->result();

				return $query1->result();
			   
			}
			else 
			{
				return FALSE;
			}
		}
	}

	public function Get_alertcount($from,$to,$vehicleid)
	{
		if(!empty($vehicleid))
		{

			$query1 = $this->db->query("SELECT count(all_status) as alt_ct FROM sms_alert WHERE vehicle_id ='".$vehicleid."' AND (all_status='12' OR all_status='13' OR all_status='14' OR all_status='15' OR all_status='16' ) AND (createdon >= '".$from."' AND createdon <= '".$to."')");

			if ($query1->num_rows() > 0 ) 
			{	
				 //$query->result();

				return $query1->row();
			   
			}
			else 
			{
				return FALSE;
			}
		}
		else 
		{
			return FALSE;
		}

	}

	public function Get_alertkm1($from,$to,$ibutton_no)
	{
		$updatequery1 = $this->db->query("SELECT * FROM i_button_report1 WHERE ibutton_no='".$ibutton_no."' AND update_status='0' AND start_day !='' AND end_day !='' AND (start_day >= '".$from."' AND start_day <= '".$to."') ORDER BY start_day ASC");

		$update_fetch1 = $updatequery1->result();

		if(!empty($update_fetch1))
		{
			foreach ($update_fetch1 as $key1) 
			{
				$up_query1 = $this->db->query("SELECT latitude,longitude,logged_datetime,odometer FROM i_button_livedata WHERE ibutton_id='".$key1->ibutton_no."' AND imei='".$key1->device_no."' AND job_status='0' AND (logged_datetime > '".$key1->start_day."') ORDER BY logged_datetime ASC LIMIT 1");

				$up_fetch1 = $up_query1->row();

				$sd_query = $this->db->query("SELECT high_resolution_vehicle_distance_917 FROM gnx_aj1939 WHERE high_resolution_vehicle_distance_917!=0 AND packet_type=0 AND vehicle_imei='".$key1->device_no."' AND `logged_datetime`<='".$key1->start_day."'  AND high_resolution_vehicle_distance_917 NOT LIKE '21%' ORDER BY logged_datetime DESC LIMIT 1");

				$sd_odo = $sd_query->row();

				if($sd_odo->high_resolution_vehicle_distance_917!='')
				{
					$sd_odo = $sd_query->row();

					$start_odo = $sd_odo->high_resolution_vehicle_distance_917;

					$ed_query = $this->db->query("SELECT high_resolution_vehicle_distance_917 FROM gnx_aj1939 WHERE high_resolution_vehicle_distance_917!=0 AND packet_type=0 AND vehicle_imei='".$key1->device_no."' AND `logged_datetime`<='".$key1->end_day."'  AND high_resolution_vehicle_distance_917 NOT LIKE '21%' ORDER BY logged_datetime DESC LIMIT 1");

					$ed_odo = $ed_query->row();

					$end_odo = $ed_odo->high_resolution_vehicle_distance_917;
				}

				$this->db->query("UPDATE i_button_report1 SET update_status='1', start_odometer='".$start_odo."', end_odometer='".$end_odo."', end_day='".$up_fetch1->logged_datetime."',e_lat='".$up_fetch1->latitude."',e_lng='".$up_fetch1->longitude."' WHERE report_id='".$key1->report_id."'");
				
			}
		}

		if(!empty($ibutton_no))
		{

			$query1 = $this->db->query(" SELECT ROUND(SUM((end_odometer - start_odometer)),2) as distance FROM i_button_report1  WHERE ibutton_no='".$ibutton_no."' AND (end_odometer - start_odometer) >0 AND end_day !='' AND start_day >= '".$from."' AND start_day <= '".$to."'");

			if ($query1->num_rows() > 0 ) 
			{	
				 //$query->result();

				return $query1->row();
			   
			}
			else 
			{
				return FALSE;
			}
		}
		else 
		{
			return FALSE;
		}

	}

	public function Get_alertkm($from,$to,$ibutton_no)
	{

		// $updatequery = $this->db->query("SELECT report_id,ibutton_no,device_no,start_day FROM i_button_report WHERE ibutton_no='".$ibutton_no."' AND update_status='0' AND start_day !='' AND end_day !='' AND (start_day >= '".$from."' AND start_day <= '".$to."') ORDER BY start_day ASC");

		// $update_fetch = $updatequery->result();

		// if(!empty($update_fetch))
		// {
		// 	foreach ($update_fetch as $key) 
		// 	{
		// 		$up_query = $this->db->query("SELECT latitude,longitude,logged_datetime,odometer FROM i_button_livedata WHERE ibutton_id='".$key->ibutton_no."' AND imei='".$key->device_no."' AND job_status='0' AND (logged_datetime > '".$key->start_day."') ORDER BY logged_datetime ASC LIMIT 1");

		// 		$up_fetch = $up_query->row();

		// 		$this->db->query("UPDATE i_button_report SET flag='2',update_status='1', end_odometer='".$up_fetch->odometer."',end_day='".$up_fetch->logged_datetime."',e_lat='".$up_fetch->latitude."',e_lng='".$up_fetch->longitude."' WHERE report_id='".$key->report_id."'");
				
		// 	}
		// }


		// if(!empty($ibutton_no))
		// {

		// 	$query1 = $this->db->query(" SELECT ROUND(SUM((end_odometer - start_odometer)),2) as distance FROM i_button_report  WHERE ibutton_no='".$ibutton_no."' AND (end_odometer - start_odometer) >0 AND end_day !='' AND start_day >= '".$from."' AND start_day <= '".$to."'");

		// 	if ($query1->num_rows() > 0 ) 
		// 	{	
		// 		 //$query->result();

		// 		return $query1->row();
			   
		// 	}
		// 	else 
		// 	{
		// 		return FALSE;
		// 	}
		// }
		// else 
		// {
		// 	return FALSE;
		// }

	}


	public function Ibutton_report_list($from,$to,$vehicleid = NULL,$ibutton)
	{
		$updatequery = $this->db->query("SELECT report_id,ibutton_no,device_no,start_day FROM i_button_report WHERE (ibutton_no='".$ibutton."' OR device_no='".$vehicleid."') AND (update_status='0' || update_status is NULL || end_odometer='0') AND start_day !='' AND (start_day >= '".$from."' AND start_day <= '".$to."') GROUP BY start_day ORDER BY start_day ASC");

		$update_fetch = $updatequery->result();

		if(!empty($update_fetch))
		{
			foreach ($update_fetch as $key) 
			{
				$up_query = $this->db->query("SELECT latitude,longitude,logged_datetime,odometer FROM i_button_livedata WHERE ibutton_id='".$key->ibutton_no."' AND imei='".$key->device_no."' AND job_status='0' AND (logged_datetime > '".$key->start_day."') ORDER BY logged_datetime ASC LIMIT 1");

				$up_fetch = $up_query->row();

				$this->db->query("UPDATE i_button_report SET flag='2',update_status='1', end_odometer='".$up_fetch->odometer."',end_day='".$up_fetch->logged_datetime."',e_lat='".$up_fetch->latitude."',e_lng='".$up_fetch->longitude."' WHERE report_id='".$key->report_id."'");
				
			}//echo "in";exit;
		}
//echo "out"; exit;
		$updatequery1 = $this->db->query("SELECT * FROM i_button_report1 WHERE (ibutton_no='".$ibutton."' OR device_no='".$vehicleid."') AND update_status='0' AND start_day !='' AND (start_day >= '".$from."' AND start_day <= '".$to."') GROUP BY start_day ORDER BY start_day ASC");

		$update_fetch1 = $updatequery1->result();

		if(!empty($update_fetch1))
		{
			foreach ($update_fetch1 as $key1) 
			{
				$up_query1 = $this->db->query("SELECT latitude,longitude,logged_datetime,odometer FROM i_button_livedata WHERE ibutton_id='".$key1->ibutton_no."' AND imei='".$key1->device_no."' AND job_status='0' AND (logged_datetime > '".$key1->start_day."') ORDER BY logged_datetime ASC LIMIT 1");

				$up_fetch1 = $up_query1->row();

				$this->db->query("UPDATE i_button_report1 SET end_odometer='".$up_fetch1->odometer."',end_day='".$up_fetch1->logged_datetime."',e_lat='".$up_fetch1->latitude."',e_lng='".$up_fetch1->longitude."' WHERE report_id='".$key1->report_id."'");

				$sd_query = $this->db->query("SELECT high_resolution_vehicle_distance_917 FROM gnx_aj1939 WHERE high_resolution_vehicle_distance_917!=0 AND vehicle_imei='".$key1->device_no."' AND `logged_datetime`<='".$key1->start_day."'  AND high_resolution_vehicle_distance_917 NOT LIKE '21%' ORDER BY logged_datetime DESC LIMIT 1");

				$sd_odo = $sd_query->row();

				if($sd_odo->high_resolution_vehicle_distance_917!='')
				{
					$sd_odo = $sd_query->row();

					$start_odo = $sd_odo->high_resolution_vehicle_distance_917;

					$ed_query = $this->db->query("SELECT high_resolution_vehicle_distance_917 FROM gnx_aj1939 WHERE high_resolution_vehicle_distance_917!=0 AND vehicle_imei='".$key1->device_no."' AND `logged_datetime`<='".$up_fetch1->logged_datetime."'  AND high_resolution_vehicle_distance_917 NOT LIKE '21%' ORDER BY logged_datetime DESC LIMIT 1");

					$ed_odo = $ed_query->row();

					$end_odo = $ed_odo->high_resolution_vehicle_distance_917;
				}

				$this->db->query("UPDATE i_button_report1 SET flag='2',update_status='1', start_odometer='".$start_odo."', end_odometer='".$end_odo."' WHERE report_id='".$key1->report_id."'");
				
			}
		}
//exit;
		if($vehicleid!='' && $ibutton!='')
		{

			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,ip.end_odometer,ip.start_odometer,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,ip.ibutton_no,v.vehicle_name,ibd.i_button_no,ibd.driver_name,v.device_config_type,v.vehicle_id,v.v_running_no FROM i_button_report ip LEFT JOIN i_button_details ibd ON ibd.i_button_no = ip.ibutton_no  LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.ibutton_no='".$ibutton."' AND  ip.device_no='".$vehicleid."' AND ip.start_day !='' AND ip.end_day !='' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'1' AND DATE_FORMAT(ip.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' GROUP BY ip.start_day ORDER BY ip.start_day ASC");
		}
		else if($vehicleid!='')
		{

			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,ip.end_odometer,ip.start_odometer,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,ip.ibutton_no,v.vehicle_name,ibd.i_button_no,ibd.driver_name,v.device_config_type,v.vehicle_id,v.v_running_no FROM i_button_report ip LEFT JOIN i_button_details ibd ON ibd.i_button_no = ip.ibutton_no  LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.device_no='".$vehicleid."' AND  ip.start_day !='' AND ip.end_day !='' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'1' AND DATE_FORMAT(ip.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' GROUP BY ip.start_day ORDER BY ip.start_day ASC");

		}
		else if($ibutton!='')
		{

			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,ip.end_odometer,ip.start_odometer,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,ip.ibutton_no,v.vehicle_name,ibd.i_button_no,ibd.driver_name,v.device_config_type,v.vehicle_id,v.v_running_no FROM i_button_report ip LEFT JOIN i_button_details ibd ON ibd.i_button_no = ip.ibutton_no  LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.ibutton_no='".$ibutton."' AND ip.start_day !='' AND ip.end_day !='' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'1' AND DATE_FORMAT(ip.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' GROUP BY ip.start_day ORDER BY ip.start_day ASC");
		}
		
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();

			return $query1->result();
		   
		}
		else 
		{//exit();
			return FALSE;
		}
		
	}

	public function Ibutton_listdetails($from,$to,$vehicleid = NULL,$ibutton)
	{
		$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,ip.ibutton_no,v.vehicle_name,ibd.i_button_no,ibd.driver_name,v.vehicle_id FROM i_button_report ip LEFT JOIN i_button_details ibd ON ibd.i_button_no = ip.ibutton_no  LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.ibutton_no='".$ibutton."' AND v.v_running_no='".$vehicleid."' AND ip.end_day !='' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'1' AND  (ip.end_odometer - ip.start_odometer) >0 AND DATE_FORMAT(ip.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' GROUP BY ip.start_day ORDER BY ip.start_day DESC");
		
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();

			return $query1->result();
		   
		}
		else 
		{//exit();
			return FALSE;
		}
	}

	public function trip_report_list($from,$to,$vehicleid = NULL,$time)
	{
		   
		if(!empty($vehicleid))
		{
			
			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,
                        TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,(ip.end_odometer - ip.start_odometer) as distance,
                        ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,v.vehiclename,v.device_config_type,v.deviceimei,ip.end_odometer,ip.start_odometer,
                        ip.start_location,ip.end_location 
                        FROM trip_report ip 
                        LEFT JOIN vehicletbl v ON ip.vehicle_id = v.vehicleid
                        WHERE ip.device_no='359633103827510' 
                        AND ip.end_day !='' 
                        AND ip.flag='2' 
                        AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'1' 
                        AND  ip.start_day >= '2021-09-26 06:45:55' 
                        AND ip.start_day <= '2021-09-27 06:45:55' 
                        GROUP BY ip.end_day 
                        ORDER BY ip.start_day DESC");
//			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,v.vehicle_name,v.device_config_type,v.v_running_no,ip.end_odometer,ip.start_odometer,ip.start_location,ip.end_location FROM ignition_report ip LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.device_no='".$vehicleid."' AND ip.end_day !='' AND ip.flag='2' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'".$time."' AND  ip.start_day >= '".$from."' AND ip.start_day <= '".$to."' GROUP BY ip.end_day ORDER BY ip.start_day DESC");
				
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();

			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
	}
	else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}		
	}

	public function angle_running_report($from,$to,$vehicleid = NULL,$time)
	{
		   
		if(!empty($vehicleid))
		{
			
			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,v.vehicle_name,v.device_config_type,v.v_running_no,ip.end_odometer,ip.start_odometer,ip.start_location,ip.end_location FROM angle_running_report ip LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.device_no='".$vehicleid."' AND ip.end_day !='' AND ip.flag='2' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'".$time."' AND  ip.start_day >= '".$from."' AND ip.start_day <= '".$to."' GROUP BY ip.end_day ORDER BY ip.start_day DESC");
				
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();

			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
	}
	else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}		
	}


	public function Ignition1_report_list($from,$to,$vehicleid = NULL,$time) //for SPN odometer
	{
		   
		if(!empty($vehicleid))
		{

			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,(ip.end_odometer - ip.start_odometer) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,v.vehicle_name,v.device_config_type,v.v_running_no,ip.end_odometer,ip.start_odometer,ip.start_location,ip.end_location FROM ignition_report1 ip LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.device_no='".$vehicleid."' AND ip.end_day !='' AND ip.flag='2' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'".$time."' AND  ip.start_day >= '".$from."' AND ip.start_day <= '".$to."' GROUP BY ip.end_day ORDER BY ip.start_day DESC");
				//(ip.end_odometer - ip.start_odometer) >0 AND 
		//DATE_FORMAT(ip.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();

			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
	}
	else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}		
	}

	public function idle_duration($from,$to,$vehicleid = NULL)
	{

		
		if(!empty($vehicleid))
			{

				
				$query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIME_FORMAT(TIMEDIFF(end_day,start_day), '%H:%i:%s')))) as total_time_duration FROM idle_report WHERE vehicle_id='".$vehicleid."' AND  flag='2' AND end_day !='' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ORDER BY start_day DESC");  //distance,day,DESC


				if($query->num_rows() > 0)
				{
					return $query->result_array();
				}
				else
				{
					return FALSE;
				}		
			}
			else if($vehicleid == NULL)
			{
				
				return FALSE;
		
			}

	}


	public function consolidate_idle_report($from,$to,$vehicleid = NULL,$time)
	{
		   
		if(!empty($vehicleid))
		{
			
		$query1 = $this->db->query("SELECT ir.device_no,TIME_FORMAT(TIMEDIFF(ir.end_day,ir.start_day), '%H:%i:%s') as time_duration,ir.s_lat,ir.s_lng,ir.start_day,ir.end_day,v.vehicle_name FROM idle_report ir LEFT JOIN vehicle v ON ir.vehicle_id = v.vehicle_id  WHERE ir.device_no ='".$vehicleid."' AND ir.end_day !=''  AND ir.flag='2' AND TIMESTAMPDIFF(MINUTE,ir.start_day,ir.end_day)>'".$time."' AND DATE_FORMAT(ir.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ORDER BY ir.start_day DESC");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
	}
	else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}		
	}

	public function consolidate_idle_area_report($from,$to,$vehicleid = NULL,$time)
	{
		
		if(!empty($vehicleid))
		{
			
			$query = $this->db->query("SELECT ir.device_no,TIME_FORMAT(TIMEDIFF(ir.end_day,ir.start_day), '%H:%i:%s') as time_duration,ir.s_lat,ir.s_lng,ir.start_day,ir.end_day,v.vehicle_name FROM idlearea_report ir LEFT JOIN vehicle v ON ir.device_no = v.vehicle_id  WHERE ir.vehicle_id ='".$vehicleid."' AND  ir.flag='2' AND ir.end_day !='' AND TIMESTAMPDIFF(MINUTE,ir.start_day,ir.end_day)>'".$time."' AND DATE_FORMAT(ir.start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' ORDER BY ir.start_day DESC");
				   
			
			if ($query->num_rows() > 0 ) 
			{	
				 //$result=$query->result_array();

				return $query->result();
			   
			}
			else 
			{
				return FALSE;
			}
		}
		else if($vehicleid == NULL)
		{
				
			return FALSE;
		
		}		
	}

	public function consolidate_Ignition_report($from,$to,$vehicleid = NULL,$time)
	{
		   
		if(!empty($vehicleid))
		{
			$query1 = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,ROUND((ip.end_odometer - ip.start_odometer),3) as distance,ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,v.vehicle_register_number FROM ignition_report ip LEFT JOIN vehicle v ON ip.vehicle_id = v.vehicle_id WHERE ip.device_no='".$vehicleid."' AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>'".$time."' AND ip.end_day !='' AND ip.flag=2 AND  (ip.end_odometer - ip.start_odometer) >0 AND DATE_FORMAT(ip.start_day, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from."' AND '".$to."' GROUP BY ip.end_day ORDER BY ip.start_day DESC");
		
			if ($query1->num_rows() > 0 ) 
			{	
				 //$result=$query->result_array();

				return $query1->result();
			   
			}
			else 
			{
				return FALSE;
			}
		}

	}


	public function all_location_data($vehicle) 
	{		
		
		$client_id = $this->session->userdata['client_id'];	
		$query = $this->db->query("SELECT ll.Location_short_name,ll.Lat,ll.Lng FROM assign_geo_fenceing geo LEFT JOIN location_list ll ON  ll.Location_Id = geo.geo_location_id WHERE geo.vehicle_id='".$vehicle."' AND geo.client_id = '".$client_id."'");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function consolidate_overall_report($travel_date,$route_id)
	{
		if(!empty($route_id))
		{
			$client_id = $this->session->userdata ['client_id'];

			$query1 = $this->db->query("select ra.*,r.*,v.vehicle_id,v.vehicle_register_number from route_assign ra LEFT JOIN routes r on r.route_id=ra.route_id LEFT JOIN vehicle v on v.vehicle_id=ra.vehicle_id where ra.client_id=".$client_id." AND ra.travel_startdate='".$travel_date."' AND ra.route_id='".$route_id."'");
		
			if ($query1->num_rows() > 0 ) 
			{	
				 //$result=$query->result_array();

				return $query1->result();
			   
			}
			else 
			{
				return FALSE;
			}
		}
	}

	public function Route_report_all($travel_date,$route_id)
	{
	 

		$query = $this->db->query("SELECT rt.*,TIME_FORMAT(TIMEDIFF(rt.actual_start_time,rt.route_planed_start_date), '%H:%i:%s') as start_diff,TIMESTAMPDIFF(MINUTE,rt.route_planed_start_date,rt.actual_start_time) as start_min,TIMESTAMPDIFF(MINUTE,rt.route_planed_end_date,rt.actual_end_time) as end_min,v.vehicle_name FROM route_trip rt LEFT JOIN vehicle v ON v.vehicle_id= rt.vehicle_id WHERE rt.route_id ='".$route_id."' AND DATE_FORMAT(rt.route_planed_start_date, '%Y-%m-%d') BETWEEN '".$travel_date."' AND '".$travel_date."' ");
		
		// $query = $this->db->query("SELECT rt.*,TIME_FORMAT(TIMEDIFF(rt.actual_start_time,rt.route_planed_start_date), '%H:%i:%s') as start_diff,TIMESTAMPDIFF(MINUTE,rt.route_planed_start_date,rt.actual_start_time) as start_min,TIMESTAMPDIFF(MINUTE,rt.route_planed_end_date,rt.actual_end_time) as end_min,v.vehicle_name FROM route_trip rt LEFT JOIN vehicle v ON v.vehicle_id= rt.vehicle_id WHERE rt.route_id ='".$route_id."' AND DATE_FORMAT(rt.route_planed_start_date, '%Y-%m-%d') BETWEEN '".$travel_date."' AND '".$travel_date."' AND update_status ='1'");
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function Route_report_penalty($travel_date)
	{
	 
		$query = $this->db->query("SELECT rt.*,TIME_FORMAT(TIMEDIFF(rt.actual_start_time,rt.route_planed_start_date), '%H:%i:%s') as start_diff,TIMESTAMPDIFF(MINUTE,rt.route_planed_start_date,rt.actual_start_time) as start_min,TIMESTAMPDIFF(MINUTE,rt.route_planed_end_date,rt.actual_end_time) as end_min,v.vehiclename FROM route_trip rt LEFT JOIN vehicletbl v ON v.vehicleid= rt.vehicle_id WHERE DATE_FORMAT(rt.route_planed_start_date, '%Y-%m-%d') BETWEEN '".$travel_date."' AND '".$travel_date."' AND update_status ='1'");
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function route_stop($route_id)
	{
	
		$query = $this->db->query("SELECT rs.*, l.Location_short_name as LocationName,l.lat,l.lng  FROM route_stops rs LEFT JOIN location_list l ON l.Location_Id=rs.stop_geo_id WHERE route_id ='".$route_id."' ");
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

		public function route_stop_values($route_id,$vehicle_id)
	{
	
		$query = $this->db->query("SELECT v.v_running_no,rs.*, l.Location_short_name as LocationName,l.lat,l.lng  FROM route_stops rs LEFT JOIN location_list l ON l.Location_Id=rs.stop_geo_id INNER JOIN vehicle v on v.client_id = rs.client_id WHERE route_id ='".$route_id."' AND v.vehicle_id = '".$vehicle_id."' ");

		
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function route_trip_details()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select * from route_trip where client_id=".$client_id."");

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function playback_latlng($start_date,$end_date,$v_running_no)
	{

		  $start_date = date('Y-m-d H:i:s', strtotime('-12 days -30 minutes', strtotime($start_date)));
		  $end_date = date('Y-m-d H:i:s', strtotime(' -12 days +30 minutes', strtotime($end_date)));
	
		$query = $this->db->query("SELECT lat_message,lon_message,modified_date FROM play_back_history_261 WHERE modified_date BETWEEN '".$start_date."' AND '".$end_date."' AND running_no = '".$v_running_no."'");
		
	
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function route_stopreport($trip_id,$geo_id)
	{
	
		$query = $this->db->query("SELECT stop_name, stop_planed_arrival, stop_actual_arrival, stop_planed_dispatch, stop_actual_dispatch,TIMESTAMPDIFF(MINUTE,stop_planed_arrival,stop_planed_dispatch) as s_min,TIMESTAMPDIFF(MINUTE,stop_actual_arrival,stop_actual_dispatch) as a_min FROM route_stop_report WHERE routetrip_id ='".$trip_id."' AND stop_geoid='".$geo_id."'");
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}

	public function consolidate_report_overall_details($travel_date,$route_id,$vehicleid = NULL,$time)
	{
		if(!empty($vehicleid))
		{
			$client_id = $this->session->userdata ['client_id'];

		$from=''; $to='';

			$query = $this->db->query("select ra.*,r.* from route_assign ra LEFT JOIN routes r on r.route_id=ra.route_id where ra.client_id=".$client_id." AND ra.travel_startdate='".$travel_date."' AND ra.vehicle_id='".$vehicleid."' AND ra.route_id='".$route_id."'");

			$key=$query->row();

			$fromtime = $key->travel_startdate." ".$key->route_starttime;
				        		$totime =  $key->travel_enddate." ".$key->route_endtime;
				        		$fd = date('Y-m-d H:i:s',strtotime($fromtime)); 
								$from_date = date("Y-m-d H:i:s", strtotime('-1 hours', strtotime($fd)));
				        		
							 	$td = date('Y-m-d H:i:s',strtotime($totime));

							 	$to_date = date("Y-m-d H:i:s", strtotime('+3 hours', strtotime($td)));

			if($key->route_geo_start_id!='')
			{
				
					$start_geo_report_q = $this->db->query("SELECT in_datetime,out_datetime FROM trip_geo_solution_data WHERE vehicle_id='".$key->vehicle_id."' AND geo_location_id='".$key->route_geo_start_id."' AND DATE_FORMAT(out_datetime,'%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to_date."'");
					$start_geo_report_f = $start_geo_report_q->row(); 
					if(!empty($start_geo_report_f)){ 

					 $from = $start_geo_report_f->out_datetime;
					        			 	
					}

			}
			if($key->route_geo_end_id!='')
			{
				
					$end_geo_report_q = $this->db->query("SELECT in_datetime,out_datetime FROM trip_geo_solution_data WHERE vehicle_id='".$key->vehicle_id."' AND geo_location_id='".$key->route_geo_end_id."' AND DATE_FORMAT(in_datetime,'%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to_date."'");
					$end_geo_report_f = $end_geo_report_q->row(); 
					if(!empty($end_geo_report_f))
					{ 
						$to = $end_geo_report_f->in_datetime;
					        			 	
					}
        		
			}
			//echo "SELECT report_id,start_day,end_day FROM idle_report WHERE vehicle_id ='".$vehicleid."' AND end_day !='' AND TIMESTAMPDIFF(MINUTE,start_day,end_day)>'1' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to."' UNION SELECT report_id, start_day,end_day FROM ignition_report WHERE vehicle_id='".$vehicleid."' AND TIMESTAMPDIFF(MINUTE,start_day,end_day)>'1' AND end_day !='' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to."' ORDER BY start_day ASC"; exit; 
			$query1 = $this->db->query("SELECT report_id,start_day,end_day FROM idle_report WHERE vehicle_id ='".$vehicleid."' AND end_day !='' AND TIMESTAMPDIFF(MINUTE,start_day,end_day)>'1' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to."' UNION SELECT report_id, start_day,end_day FROM ignition_report WHERE vehicle_id='".$vehicleid."' AND TIMESTAMPDIFF(MINUTE,start_day,end_day)>'1' AND flag='2' AND  end_day !='' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to."' GROUP BY end_day ORDER BY start_day ASC");
		
			if ($query1->num_rows() > 0 ) 
			{	
				 //$result=$query->result_array();

				return $query1->result();
			   
			}
			else 
			{
				return FALSE;
			}
		}
	}
	
	public function vehicle_id(){  		
		
		$client_id = $this->session->userdata['client_id'];		
		
		$role_id = $this->session->userdata['role'];		
		if($role_id != 4)
		{
			$query =  $this->db->query("SELECT vehicle_id,v_running_no,vehicle_name,vehicle_model,vehicle_number,vehicle_register_number FROM vehicle WHERE activecode ='1' AND client_id =".$client_id." ORDER BY vehicle_type");
			if ($query->num_rows() > 0) 
			{
				return $query->result();
			}
			else 
			{
				return FALSE;
			}
		}
		else{
			$user_id = $this->session->userdata['user_id'];
			$query =  $this->db->query("SELECT v.vehicle_id,v.vehicle_number,v.vehicle_register_number,v.vehicle_name,v.v_running_no,v.vehicle_model,v.speed,v.updatedon,TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.acc_on,v.acc_flag,v.ac_flag,v.ac_date,v.ac_km,v.fuel_ltr,v.fuel_tank_capacity,v.fueltank,v.temperature FROM assign_owner ao LEFT JOIN vehicle v ON ao.vehicle_id = v.vehicle_id WHERE ao.owner_id =".$user_id);
			if ($query->num_rows() > 0) 
			{
				return $query->result();
			}
			else 
			{
				return FALSE;
			}
		
		}
	}
	
	//

	
	public function insert_tariff_data($data)
	{
			
		$query = $this->db->insert('tariff_details',$data);
		  	
				
		if ($query) 
		{
			return TRUE;
		}
		else 
		{
			return false;
		}
		
	}
	
	
	// Read data from database to show data in admin page
    public function all_bookings_data($id = NULL) 
	{	
			
		if($id == NULL){
		
		$query = $this->db->query("SELECT t1.Trip_Id,t1.PNR_No,t1.StartDate,t1.IsNightTrip,t1.WaitingTime,t1.StartTime,t1.EndDate,t1.CustomerName,t1.PassengerCount,t1.EndTime, t1.StartKm,t1.EndKm,t1.Trip_Is,t1.PickupLoc,t1.DropLoc,t1.PickupDate,t1.PickupTime,t1.NightKm,t1.NightWatingTime,t1.ExcessTime, t1.Mobile,vm.Model,v.VehicleNo,vm.Make,vm.Ac,d.FirstName,d.LastName,vm.Vehicle_Model_Id, TIMEDIFF(STR_TO_DATE(t1.EndTime,'%h:%i %p'), STR_TO_DATE(t1.StartTime, '%h:%i %p')) as trip_duration,t1.IsPackage,t1.Amount FROM trip t1 LEFT JOIN assign a on t1.Trip_Id = a.Trip_Id LEFT JOIN vehicle v on v.Vehicle_Id = a.Vehicle_Id LEFT JOIN vehicle_model vm on vm.Vehicle_Model_Id = v.VehicleModel LEFT JOIN driver d ON a.Driver_Id = d.Driver_Id WHERE v.Running = 0 AND t1.EndKm != '' ORDER BY t1.CustomerName ASC");
		
		
		}else{
		
		$query = $this->db->query("SELECT t1.Trip_Id,t1.PNR_No,t1.StartDate,t1.IsNightTrip,t1.WaitingTime,t1.StartTime,t1.EndDate,t1.CustomerName,t1.PassengerCount,t1.EndTime, t1.StartKm,t1.EndKm,t1.PickupLoc,t1.Trip_Is,t1.DropLoc,t1.PickupDate,t1.PickupTime,t1.NightKm,t1.NightWatingTime,t1.ExcessTime, t1.Mobile,vm.Model,v.VehicleNo,vm.Make,vm.Ac,d.FirstName,d.LastName,vm.Vehicle_Model_Id, TIMEDIFF(STR_TO_DATE(t1.EndTime,'%h:%i %p'), STR_TO_DATE(t1.StartTime, '%h:%i %p')) as trip_duration,t1.IsPackage,t1.Amount FROM trip t1 LEFT JOIN assign a on t1.Trip_Id = a.Trip_Id LEFT JOIN vehicle v on v.Vehicle_Id = a.Vehicle_Id LEFT JOIN vehicle_model vm on vm.Vehicle_Model_Id = v.VehicleModel LEFT JOIN driver d ON a.Driver_Id = d.Driver_Id WHERE t1.Trip_Id = '".$id."' v.Running = 0 AND t1.EndKm != '' ORDER BY t1.CustomerName ASC");
		
		}
		
		
		if ($query->num_rows() > 0) 
		{
			return $query->result_array();
		}
		else 
		{
			return false;
		}
	}
	
	public function update_user($id, $insert_data){
		
		$this->db->where('User_details_Id', $id);
		$result = $this->db->update('user_details', $insert_data);
		
		if($result){
			
			return TRUE;
			
		}else{
		
			return FALSE;
			
		}
		
	}
	
	public function all_tariff_data() 
	{		
			$query = $this->db->query('SELECT * FROM tariff_details');
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	public function get_ignition_route_data($d_id,$from,$to) 
	{		
		//$query = $this->db->query("SELECT lat_message,lon_message,ROUND(speed) as speed FROM play_back_history WHERE (modified_date >= '".$from."' AND modified_date <= '".$to."') AND running_no ='".$d_id."' ORDER BY modified_date ASC");

		$client_id = $this->session->userdata['client_id'];

		$play_table = "play_back_history_".$client_id;
		$qry = $this->db->query("SHOW TABLES LIKE '".$play_table."'");

		if($qry->num_rows () > 0)
		{
			 $query = $this->db->query ("SELECT t.odometer,t.running_no,t.lat_message,t.lon_message,t.speed,t.acc_status,t.door_status,t.modified_date as datetime,v.vehicle_id,v.vehicle_name,v.vehicle_type,v.fuel_odo FROM vehicle v INNER JOIN ".$play_table." t ON t.running_no = v.v_running_no WHERE v.v_running_no ='".$d_id."' AND t.lat_message!='000000000' AND t.lon_message!='000000000' AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' AND DATE_FORMAT(t.modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' UNION SELECT tt.odometer,tt.running_no,tt.lat_message,tt.lon_message,tt.speed,tt.acc_status,tt.door_status,tt.modified_date as datetime,vt.vehicle_id,vt.vehicle_name,vt.vehicle_type,vt.fuel_odo FROM vehicle vt INNER JOIN play_back_history tt ON tt.running_no = vt.v_running_no WHERE vt.v_running_no ='".$d_id."' AND tt.lat_message!='000000000' AND tt.lon_message!='000000000' AND tt.lat_message!='0' AND tt.lon_message!='0' AND tt.lat_message!='0.0' AND tt.lon_message!='0.0' AND DATE_FORMAT(tt.modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'  ORDER BY datetime ASC");
		}
		else
		{
			$query = $this->db->query ("SELECT odometer,running_no,lat_message,lon_message,speed,acc_status,door_status,modified_date as datetime FROM play_back_history WHERE running_no ='".$d_id."' AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'  ORDER BY datetime ASC");
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
	public function get_ignition_fuel_data($d_id,$from,$to) 
	{		
		$query = $this->db->query("SELECT MAX(litres) - MIN(litres) as alert_type,'0' as alert_type_id from fuel_data WHERE ignition ='1' AND running_no ='".$d_id."' AND DATE_FORMAT(created_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	public function get_ignition_route_alert($v_id,$from,$to) 
	{		
		$query = $this->db->query("SELECT COUNT(s.sms_alert_id) as a_count, a.alert_type,a.alert_type_id FROM sms_alert s LEFT JOIN alert_type a ON s.all_status = a.alert_type_id WHERE s.vehicle_id ='".$v_id."' AND DATE_FORMAT(s.createdon, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' GROUP BY s.all_status");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	public function tariff_data($id) 
	{		
			$query = $this->db->query('SELECT * FROM tariff_details WHERE Tariff_details_Id ='.$id);
		
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
	
	
	
	public function all_tariff_category() 
	{		
			$query = $this->db->query('SELECT * FROM tariff_category');
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	
	
	public function tariff_category_data($modelId) 
	{		
		$query = $this->db->query('SELECT tc.CategoryName FROM vehicle_category vc LEFT JOIN tariff_category tc ON tc.Tariff_Category_Id = vc.Tariff_Category_Id WHERE vc.Vehicle_Model_Id='.$modelId);
		
		if ($query->num_rows() > 0) 
		{
			$vehicle_tariff_category = $query->result_array();
			//return $query->result_array();
			
			foreach($vehicle_tariff_category as $data){
				
				$CategoryName = $data['CategoryName'];
				
				$query = $this->db->query('SELECT * FROM tariff_details WHERE Category= "'.$CategoryName.'" ORDER BY Min_Km DESC');
				
				if ($query->num_rows() > 0) 
				{
					return $query->result_array();
					
				}else{
					
					return false;	
				}
		    }
			
		}
		else 
		{
			return false;
		}
	}
	
	public function get_pack_min_km_data($category,$TotalKM,$Ac,$local) 
	{		
		$query = $this->db->query('SELECT * FROM tariff_details WHERE Category ="'.$category.'" && Min_Km <= '.$TotalKM.' && Is_AC = '.$Ac.' ORDER BY Min_Km DESC LIMIT 1');
		
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
	public function get_min_km_data($category,$TotalKM,$Ac,$local) 
	{		
		
		$query = $this->db->query('SELECT * FROM tariff_details WHERE Category ="'.$category.'" && Min_Km <= '.$TotalKM.' && Is_AC = '.$Ac.' && Is_Local = '.$local.' ORDER BY Min_Km DESC LIMIT 1');
		
		if ($query->num_rows() > 0) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
	
	
	
	
	public function bookings_data_filter($from,$to)
	{	
			
		$query = $this->db->query("SELECT t1.Trip_Id,t1.PNR_No,t1.StartDate,t1.StartTime,t1.EndDate,t1.CustomerName,t1.PassengerCount,t1.EndTime,t1.StartKm,t1.EndKm,t1.PickupLoc,t1.DropLoc,
t1.PickupDate,t1.PickupTime, t1.Mobile,vm.Model,v.VehicleNo,vm.Make,vm.Ac,d.FirstName,d.LastName FROM trip t1 LEFT JOIN assign a on t1.Trip_Id = a.Trip_Id LEFT JOIN vehicle v on v.Vehicle_Id = a.Vehicle_Id LEFT JOIN vehicle_model vm on vm.Vehicle_Model_Id = v.VehicleModel LEFT JOIN driver d ON a.Driver_Id = d.Driver_Id WHERE v.Running = 0 AND t1.EndKm != '' AND( t1.StartDate >='$from' AND t1.StartDate <='$to')  ORDER BY t1.CustomerName ASC");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result_array();
		}
		else 
		{
			return false;
		}
	}
	
	
	public function cancel_filter($from,$to) 
	{	
		$from_date = 	
		$query = $this->db->query("SELECT t1.Trip_Id,t1.PNR_No,t1.PickupLoc,t1.CustomerName, t1.DropLoc,t1.PickupDate,t1.PickupTime,t1.Mobile,v.VehicleNo ,vm.Model,vm.Ac , d.FirstName,d.LastName,c.Reason,c.Description,c.Cancellation_Id,c.Status,c.FollowupDesc,c.CreatedOn FROM trip t1 LEFT JOIN assign a on t1.Trip_Id = a.Trip_Id LEFT JOIN vehicle v on v.Vehicle_Id = a.Vehicle_Id LEFT JOIN vehicle_model vm on vm.Vehicle_Model_Id = v.VehicleModel LEFT JOIN driver d LEFT JOIN cancellation c on c.Trip_Id = t1.Trip_Id WHERE d.Driver_Id = a.Driver_Id and(c.CreatedOn <= '$to' and c.CreatedOn >= '$from')");

		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	
	
	
	 public function all_cancel_data() 
	{	
			
		$query = $this->db->query("SELECT t1.Trip_Id,t1.PNR_No,t1.PickupLoc,t1.CustomerName, t1.DropLoc,t1.PickupDate,t1.PickupTime,t1.Mobile,v.VehicleNo ,vm.Model,vm.Ac , d.FirstName,d.LastName,c.Reason,c.Description,c.Cancellation_Id,c.Status,c.FollowupDesc,c.CreatedOn FROM trip t1 LEFT JOIN assign a on t1.Trip_Id = a.Trip_Id LEFT JOIN vehicle v on v.Vehicle_Id = a.Vehicle_Id LEFT JOIN vehicle_model vm on vm.Vehicle_Model_Id = v.VehicleModel LEFT JOIN driver d LEFT JOIN cancellation c on c.Trip_Id = t1.Trip_Id WHERE d.Driver_Id = a.Driver_Id");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	
	public function view_reports($id)
	{
		$query = $this->db->query('SELECT t.Trip_Id,t.PNR_No,t.CustomerName, t.Mobile , t.PickupLoc , t.DropLoc ,t.PassengerCount  ,t.NightWatingTime,t.NightKm,t.WaitingTime,t.StartTime, t.EndTime , t.EndDate ,t.StartKm ,t.EndKm ,t.Amount , v.VehicleNo, d.FirstName,d.LastName , TIME_FORMAT(TIMEDIFF(t.StartTime,t.EndTime),"%H-%i-%s") as Duration  FROM trip t LEFT JOIN assign a on a.Trip_Id = t.Trip_Id LEFT JOIN vehicle v ON v.Vehicle_Id = a.Vehicle_Id LEFT JOIN driver d ON d.Driver_Id =a.Driver_Id WHERE t.Trip_Id = '.$id);
		{
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return FALSE;
			}
		}
	}
	
	public function all_vehicle_list_data() 
	{		
		
		$query = $this->db->query("SELECT id,vehicle_no,device_no FROM vehicle WHERE status != 0");
		
		if ($query->num_rows() > 0  ) 
		{	
				
			return $query->result();
			
		}
		else 
		{
			return false;
		}
		
	}
	
	//start vehicle report 
	

	public function all_vehicle_data($from,$to,$vehicleid = NULL)
	{
		   
		if(!empty($vehicleid))
		{
			
		  $query1 = $this->db->query("SELECT COUNT(mt.id) as trips,SUM(mt.trip_amount) as amount,SUM(mt.trip_km) as distance,v.vehicle_no,v.vehicle_reg_no FROM master_trip mt LEFT JOIN vehicle v ON v.id = mt.vehicle_id WHERE mt.vehicle_id = '".$vehicleid."' AND (DATE(mt.trip_start_time) >='".$from."' AND DATE(mt.trip_start_time) <='".$to."')");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	
			
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
	}
	else if($vehicleid == NULL)
		{
			
			$query1 = $this->db->query("SELECT COUNT(mt.id) as trips,SUM(mt.trip_amount) as amount,SUM(mt.trip_km) as distance,v.vehicle_no,v.vehicle_reg_no FROM master_trip mt LEFT JOIN vehicle v ON v.id = mt.vehicle_id WHERE (DATE(mt.trip_start_time) >='".$from."' AND DATE(mt.trip_start_time) <='".$to."') GROUP BY v.id");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	
			
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}

		}		
	}

 
	//end vehicle report
	
	
	
	
	
	public function user_id($username) 
	{
		$condition = "UserName =" . "'" . $username . "'";
		$this->db->select('User_details_Id');
		$this->db->from('user_details');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	
	public function all_user_roles() 
	{
		$query = $this->db->query('SELECT RoleCode,Role FROM roles');
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function user_role($role) 
	{
		
		$condition = "RoleCode =" . "'" . $role . "'";
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	public function alert_history_list($from,$to,$alert = NULL)
	{
		 $client_id = $this->session->userdata['client_id'];  
		if(!empty($alert))
		{
			
		  $query1 = $this->db->query("SELECT ta.*,att.alert_type, v.vehicle_register_no FROM tbl_alert ta LEFT JOIN alert_type att ON ta.type_id = att.alert_type_id LEFT JOIN vehicle v ON v.id = ta.vehicle_id WHERE ta.type_id ='".$alert."' AND ta.client_id = '".$client_id."' AND (DATE_FORMAT(ta.created_datetime, '%Y-%m-%d %H:%i') >='".$from."' AND DATE_FORMAT(ta.created_datetime, '%Y-%m-%d %H:%i') <='".$to."') ORDER BY ta.id DESC");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	
			
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
	}
	else if($alert == NULL)
		{
			
			$query1 = $this->db->query("SELECT ta.*,att.alert_type, v.vehicle_register_no FROM tbl_alert ta LEFT JOIN alert_type att ON ta.type_id = att.alert_type_id LEFT JOIN vehicle v ON v.id = ta.vehicle_id WHERE ta.client_id = '".$client_id."' AND (DATE_FORMAT(ta.created_datetime, '%Y-%m-%d %H:%i') >='".$from."' AND DATE_FORMAT(ta.created_datetime, '%Y-%m-%d %H:%i') <='".$to."') ORDER BY ta.id DESC");
				   
		
		if ($query1->num_rows() > 0 ) 
		{	
			
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}

		}		
	}
	public function esported_data() 
	{		
		$query = $this->db->query('SELECT * FROM complaints');
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}


	
	public function geo_location_list()
	{
		$client_id = $this->session->userdata['client_id'];		
		
		$query = $this->db->query("SELECT * from location_list where client_id ='".$client_id."' ");
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	//

	public function geo_report_data($from,$to,$vehicle,$location)
	{
		  //echo $from;echo $to;echo $location;echo $vehicle; exit;
		$client_id = $this->session->userdata['client_id'];
		if($vehicle =='all' && $location =='' )
		{
			//echo "SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.in_datetime!='' and tg.client_id='".$client_id."' and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC"; exit;
			$query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.in_datetime!='' and tg.client_id='".$client_id."' and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC");
			//echo '1'; exit;
			
			if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		else if($vehicle =='all' && $location !='' )
		{
			$query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '".$location."' and tg.in_datetime!='' and tg.client_id='".$client_id."' and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC");
			//echo '1'; exit;
			
			if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		else if($vehicle !='' && $location !='' )
		{
			$query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '".$location."' and v.vehicle_id = '".$vehicle."' and tg.in_datetime!='' and tg.client_id='".$client_id."' and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC");
			//echo '1'; exit;
			
			if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		else if($vehicle !='' && $location =='' )
		{
			$query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where v.vehicle_id = '".$vehicle."' and tg.in_datetime!='' and tg.client_id='".$client_id."' and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC");
			//echo '1'; exit;
			
			if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		else if($location !='' && $vehicle == '')
		{

			$query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '".$location."' and tg.in_datetime!='' and tg.client_id='".$client_id."'  and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC");
			//echo '2'; exit;
			
			if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}
		}
		else
		{
			$query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where  tg.in_datetime!='' and  tg.client_id='".$client_id."' and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC");
			//echo "SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehicle_register_number,ll.Location_short_name from trip_geo_solution_data tg LEFT JOIN vehicle v ON v.vehicle_id = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where  tg.in_datetime!='' and  tg.client_id='".$client_id."' and DATE_FORMAT(tg.in_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' order by tg.in_datetime DESC";exit;
			
			if($query)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			}

		}
	}

	public function distance_data()
	{
		$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT * from complaints where session_id='".$client_id."'");

		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function ignition_data($vehicle)
	{
		$client_id = $this->session->userdata['client_id'];
		//$query = $this->db->query("SELECT * from ignition_trip_report where client_id='".$client_id."' and random_no = '".$random_no."' ");
		$query = $this->db->query("SELECT report_id,device_no,TIME_FORMAT(TIMEDIFF(end_day,start_day), '%H:%i:%s') as time_duration,TIMESTAMPDIFF(MINUTE,start_day,end_day) as t_min,s_lat,s_lng,e_lat,e_lng,start_day,end_day,total_km,vehicle_id FROM ignition_report WHERE device_no='".$vehicle."' AND flag ='2' AND end_day !='' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' GROUP BY end_day ORDER BY start_day DESC");
		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function user_name() 
	{	
		$client_id = $this->session->userdata['client_id'];  	
		$query = $this->db->query("SELECT * FROM user where client_id='".$client_id."' and role_id >3 ");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function login_data($from,$to,$user_id) 
	{	
		$client_id = $this->session->userdata['client_id'];  	

		$query = $this->db->query("SELECT * FROM login_details where client_id='".$client_id."' and DATE_FORMAT(login_datetime, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."' and user_id='".$user_id."'");
		
		if ($query->num_rows() > 0) 
		{
			return $query->result_array();
		}
		else 
		{
			return false;
		}
	}

	public function smart_report()
	{
		$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT * from complaints where session_id='".$client_id."' and start_lat='1'");

		if($query)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}


	public function ac_report_excel()
	{
		
		$client_id = $this->session->userdata['client_id'];	   

		$query = $this->db->query("SELECT * from table_new where r_status = '".$client_id."'");

		if($query)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	//IDLE REPORT LIST



	public function idle_report_list($from,$to,$vehicleid = NULL,$time)
	{
		if(!empty($vehicleid))
		{
			$query = $this->db->query("SELECT ir.report_id,ir.device_no,TIME_FORMAT(TIMEDIFF(ir.end_day,ir.start_day), '%H:%i:%s') as time_duration,
                        ir.s_lat,ir.s_lng,ir.start_day,ir.end_day,v.vehiclename,ir.start_location,ir.end_location 
                        FROM idle_report ir 
                        LEFT JOIN vehicletbl v ON ir.vehicle_id = v.vehicleid  
                        WHERE ir.device_no ='864502030450027' 
                        AND ir.flag='2' 
                        AND ir.end_day !='' 
                        AND TIMESTAMPDIFF(MINUTE,ir.start_day,ir.end_day)>'1' 
                        AND ir.start_day >= '2021-03-07 10:30:25' 
                        AND ir.start_day <= '2021-03-08 10:30:25' 
                        ORDER BY start_day DESC");
//			$query = $this->db->query("SELECT ir.device_no,TIME_FORMAT(TIMEDIFF(ir.end_day,ir.start_day), '%H:%i:%s') as time_duration,
//                        ir.s_lat,ir.s_lng,ir.start_day,ir.end_day,v.vehiclename,ir.start_location,ir.end_location 
//                        FROM idle_report ir 
//                        LEFT JOIN vehicletbl v ON ir.vehicle_id = v.vehicleid  
//                        WHERE ir.device_no ='".$vehicleid."' 
//                        AND ir.flag='2' 
//                        AND ir.end_day !='' 
//                        AND TIMESTAMPDIFF(MINUTE,ir.start_day,ir.end_day)>'".$time."' 
//                        AND ir.start_day >= '".$from."' 
//                        AND ir.start_day <= '".$to."' 
//                        ORDER BY start_day DESC");
			if ($query->num_rows() > 0 ) 
			{	
				 //$result=$query->result_array();
				return $query->result();
			}
			else 
			{
				return FALSE;
			}
		}
		else if($vehicleid == NULL)
		{
			return FALSE;
		}		
	}

	
//END OF IDLE REPORT


	public function route_deviated_report($from_date,$to_date,$vehicle_id,$route_id)
	{
		if(($vehicle_id=='all') && ($route_id==''))
		{
			
			$query = $this->db->query("SELECT ir.*,TIME_FORMAT(TIMEDIFF(ir.route_deviate_intime,ir.route_deviate_outtime), '%H:%i:%s') as time_duration,v.vehicle_name,rd.route_start_locationname,rd.route_end_locationname FROM route_deviate_report ir LEFT JOIN route_deviation rd ON rd.route_id = ir.route_id LEFT JOIN vehicle v ON ir.vehicle_imei = v.v_running_no  WHERE ir.route_deviate_intime !='' AND ir.route_deviate_outtime >= '".$from_date."' AND ir.route_deviate_outtime <= '".$to_date."' ORDER BY ir.route_deviate_outtime DESC");
		}
		if(($vehicle_id=='all') && ($route_id!=''))
		{
			
			$query = $this->db->query("SELECT ir.*,TIME_FORMAT(TIMEDIFF(ir.route_deviate_intime,ir.route_deviate_outtime), '%H:%i:%s') as time_duration,v.vehicle_name,rd.route_start_locationname,rd.route_end_locationname FROM route_deviate_report ir LEFT JOIN route_deviation rd ON rd.route_id = ir.route_id LEFT JOIN vehicle v ON ir.vehicle_imei = v.v_running_no  WHERE ir.route_id ='".$route_id."' AND ir.route_deviate_intime !='' AND ir.route_deviate_outtime >= '".$from_date."' AND ir.route_deviate_outtime <= '".$to_date."' ORDER BY ir.route_deviate_outtime DESC");
		}
		if(($vehicle_id!='') && ($route_id!=''))
		{
			
			$query = $this->db->query("SELECT ir.*,TIME_FORMAT(TIMEDIFF(ir.route_deviate_intime,ir.route_deviate_outtime), '%H:%i:%s') as time_duration,v.vehicle_name,rd.route_start_locationname,rd.route_end_locationname FROM route_deviate_report ir LEFT JOIN route_deviation rd ON rd.route_id = ir.route_id LEFT JOIN vehicle v ON ir.vehicle_imei = v.v_running_no  WHERE ir.vehicle_imei ='".$vehicle_id."' AND ir.route_id ='".$route_id."' AND ir.route_deviate_intime !='' AND ir.route_deviate_outtime >= '".$from_date."' AND ir.route_deviate_outtime <= '".$to_date."' ORDER BY ir.route_deviate_outtime DESC");
		}
		else if(($vehicle_id=='') && ($route_id!=''))
		{
			$query = $this->db->query("SELECT ir.*,TIME_FORMAT(TIMEDIFF(ir.route_deviate_intime,ir.route_deviate_outtime), '%H:%i:%s') as time_duration,v.vehicle_name,rd.route_start_locationname,rd.route_end_locationname FROM route_deviate_report ir LEFT JOIN route_deviation rd ON rd.route_id = ir.route_id LEFT JOIN vehicle v ON ir.vehicle_imei = v.v_running_no  WHERE ir.vehicle_imei ='".$vehicle_id."' AND ir.route_deviate_intime !='' AND ir.route_deviate_outtime >= '".$from_date."' AND ir.route_deviate_outtime <= '".$to_date."' ORDER BY ir.route_deviate_outtime DESC");
		}		   
		else if(($vehicle_id!='') && ($route_id==''))
		{
			$query = $this->db->query("SELECT ir.*,TIME_FORMAT(TIMEDIFF(ir.route_deviate_intime,ir.route_deviate_outtime), '%H:%i:%s') as time_duration,v.vehicle_name,rd.route_start_locationname,rd.route_end_locationname FROM route_deviate_report ir LEFT JOIN route_deviation rd ON rd.route_id = ir.route_id LEFT JOIN vehicle v ON ir.vehicle_imei = v.v_running_no  WHERE ir.route_id ='".$route_id."' AND ir.route_deviate_intime !='' AND ir.route_deviate_outtime >= '".$from_date."' AND ir.route_deviate_outtime <= '".$to_date."' ORDER BY ir.route_deviate_outtime DESC");
		}
			
		if ($query->num_rows() > 0 ) 
		{	

			return $query->result();
			   
		}
		else 
		{
			return FALSE;
		}
		
	}


	public function modelshift_assigndetails($model_id,$vehicle_id)
	{
		$client_id = $this->session->userdata ['client_id'];

		if($model_id!='' && $vehicle_id!='')
		{
			$query = $this->db->query("select vma.*,vms.*,v.vehicle_name,v.device_config_type,v.v_running_no from vehicle_model_assign vma LEFT JOIN vehicle_model_shift vms on vms.vms_id=vma.modelshift_id LEFT JOIN vehicle v on v.vehicle_id=vma.vehicle_id where vma.modelshift_id='".$model_id."' AND vma.vehicle_id='".$vehicle_id."' AND vma.client_id=".$client_id."");

		}
		else if($model_id!='')
		{
			$query = $this->db->query("select vma.*,vms.*,v.vehicle_name,v.device_config_type,v.v_running_no from vehicle_model_assign vma LEFT JOIN vehicle_model_shift vms on vms.vms_id=vma.modelshift_id LEFT JOIN vehicle v on v.vehicle_id=vma.vehicle_id where vma.modelshift_id='".$model_id."' AND vma.client_id=".$client_id."");
		}
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}

	public function model_details()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select * from vehicle_model_shift where status='1' AND client_id=".$client_id."");

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function get_playback_data($d_id,$from,$to) 
	{	
//echo "SELECT * FROM play_back_history WHERE (modified_date >= '".$from."' AND modified_date <= '".$to."') AND running_no ='".$d_id."' limit 2"; exit;
		$query = $this->db->query("SELECT * FROM play_back_history WHERE (modified_date >= '".$from."' AND modified_date <= '".$to."') AND running_no ='".$d_id."'");
		//DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}

	public function vehicle_list() 
	{		
		
		$query = $this->db->query("SELECT vehicle_id,client_id FROM vehicle WHERE client_id='261' ");
		
		if ($query->num_rows() > 0  ) 
		{	
				
			return $query->result();
			
		}
		else 
		{
			return false;
		}
		
	}


	public function all_route_details()
	{
		$query = $this->db->query("select route_id,route_geo_start_id,route_geo_end_id,route_starttime,route_endtime from routes");


		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}


		public function geo_start_list($route_start_id,$vehicle_id,$first_start_time,$first_end_time)
	{

		
		
		$query = $this->db->query("select geo_location_id,vehicle_id,out_datetime from trip_geo_solution_data where geo_location_id ='".$route_start_id."' and vehicle_id = '".$vehicle_id."' and DATE_FORMAT(out_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$first_start_time."' AND '".$first_end_time."' ");

	//echo "select geo_location_id,vehicle_id,out_datetime from trip_geo_solution_data where geo_location_id ='264' and vehicle_id = '51' and DATE_FORMAT(out_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$first_start_time."' AND '".$first_end_time."'  ";exit;
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}
	


		public function geo_end_list($route_end_id,$vehicle_id,$end_start_time,$end_end_time)
	{


			$query = $this->db->query("select geo_location_id,vehicle_id,in_datetime from trip_geo_solution_data where geo_location_id ='".$route_end_id."' and vehicle_id = '".$vehicle_id."' and DATE_FORMAT(in_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$end_start_time."' AND '".$end_end_time."'");

			
			//print_r($query);exit;
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
		
			return false;
		}
	}
	
	public function stop_geo_list($route_id)
	{
		$query = $this->db->query("select *  from route_stops where route_id ='".$route_id."'");

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

		public function stop_start_geo_location($vehicle_id,$stop_geo_id,$first_start_time,$end_end_time)
	{
		$query = $this->db->query("select geo_location_id,vehicle_id,in_datetime from trip_geo_solution_data where geo_location_id ='".$stop_geo_id."' and vehicle_id = '".$vehicle_id."' and DATE_FORMAT(in_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$first_start_time."' AND '".$end_end_time."'");
// echo "select geo_location_id,vehicle_id,in_datetime from trip_geo_solution_data where geo_location_id ='".$stop_geo_id."' and vehicle_id = '".$vehicle_id."' and DATE_FORMAT(in_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$first_start_time."' AND '".$end_end_time."'";exit;
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}

		public function stop_end_geo_location($vehicle_id,$stop_geo_id,$first_start_time,$end_end_time)
	{
		$query = $this->db->query("select geo_location_id,vehicle_id,out_datetime from trip_geo_solution_data where geo_location_id ='".$stop_geo_id."' and vehicle_id = '".$vehicle_id."' and DATE_FORMAT(out_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$first_start_time."' AND '".$end_end_time."'");
// echo "select geo_location_id,vehicle_id,in_datetime from trip_geo_solution_data where geo_location_id ='".$stop_geo_id."' and vehicle_id = '".$vehicle_id."' and DATE_FORMAT(in_datetime, '%Y-%m-%d %H:%i:%s') BETWEEN '".$first_start_time."' AND '".$end_end_time."'";exit;
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}



	public function liveroute_list($travel_date,$shift_type)
	{
		    $client_id = $this->session->userdata['client_id'];
			if($shift_type==0)
			{
				$query1 = $this->db->query("SELECT al.*,TIMESTAMPDIFF(MINUTE,al.route_planstart_time,al.route_exitime) as start_min,TIMESTAMPDIFF(MINUTE,al.route_planend_time,al.route_entry_time) as end_min FROM sch_add_liveroute_list al 
				INNER JOIN sch_routeassigntbl sr ON sr.route_id=al.route_id 
				WHERE al.travel_date='$travel_date' AND al.client_id=$client_id");
			}
			else
			{
				$query1 = $this->db->query("SELECT al.*,TIMESTAMPDIFF(MINUTE,al.route_planstart_time,al.route_exitime) as start_min,TIMESTAMPDIFF(MINUTE,al.route_planend_time,al.route_entry_time) as end_min FROM sch_add_liveroute_list al 
				INNER JOIN sch_routeassigntbl sr ON sr.route_id=al.route_id 
				WHERE al.travel_date='$travel_date' AND al.client_id=$client_id AND sr.shift_type=$shift_type");
			}
			
		
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
			
	}


public function livestop_list($live_routeid)
	{
		
			
		$client_id = $this->session->userdata['client_id'];

		$query1 = $this->db->query("SELECT stop_geo_id, stopplaned_entry, stopentry_time, stopplaned_exit, stopexit_time,TIMESTAMPDIFF(MINUTE,stopplaned_entry,stopplaned_exit) as s_min,TIMESTAMPDIFF(MINUTE,stopentry_time,stopexit_time) as a_min FROM sch_add_livestop_list WHERE live_routeid ='".$live_routeid."'");
				   
		//echo "SELECT * FROM add_livestop_list WHERE live_routeid='$live_routeid'";exit;
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
			
	}

	public function nodata_vehicles($travel_date)
	{
			$role_id = $this->session->userdata['roleid'];
		   $user_id = $this->session->userdata['userid'];
		
		if ($role_id=='4') 
		{
			$query1 = $this->db->query("SELECT * FROM nodata_vehicle al INNER JOIN vehicletbl v ON al.vehicle_id = v.vehicleid INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid WHERE al.modified_date='$travel_date' AND ao.owner_id ='$user_id' AND al.user_id='52'");

			//echo "SELECT * FROM nodata_vehicle al INNER JOIN vehicle v ON al.vehicle_id = v.vehicle_id INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicle_id WHERE al.modified_date='$travel_date' AND ao.owner_id ='$user_id'";exit;
		}
		else
		{
			$query1 = $this->db->query("SELECT * FROM nodata_vehicle WHERE modified_date='$travel_date' AND user_id IS NULL");
		}
		
				   
		//echo "SELECT * FROM add_livestop_list WHERE live_routeid='$live_routeid'";exit;
		if ($query1->num_rows() > 0 ) 
		{	
			 //$result=$query->result_array();
			return $query1->result();
		   
		}
		else 
		{
			return FALSE;
		}
			
	}


			public function polyroute_report_all($travel_date,$route_id,$vehicle_id)
	{
			$client_id = $this->session->userdata['client_id'];

			$role_id = $this->session->userdata['roleid'];

			$start_date =$travel_date.' 00:00:00';
			$end_date =$travel_date.' 23:59:59';

					//echo "SELECT p.route_type,p.live_routeid,p.vehicle_id,p.vehicle_name,p.route_id,p.routename,p.route_startid,p.route_endid,p.start_route_intime,p.start_route_outtime,p.end_route_intime,p.end_route_outtime,p.travel_date,p.start_polygon_name,p.end_polygon_name,TIMESTAMPDIFF(SECOND,p.`start_route_intime`,p.`start_route_outtime`) as start_dur,TIMESTAMPDIFF(SECOND,p.`end_route_intime`,`end_route_outtime`) as end_dur,v.deviceimei  FROM poly_route_list p INNER JOIN vehicletbl_2 ON v.vehicleid=p.vehicle_id WHERE p.start_route_intime BETWEEN '".$start_date."' AND '".$end_date."' AND p.route_id = '".$route_id."' AND p.vehicle_id = '".$vehicle_id."'";
					//exit;
					$query = $this->db->query("SELECT p.route_type,p.live_routeid,p.vehicle_id,p.vehicle_name,p.route_id,p.routename,p.route_startid,p.route_endid,p.start_route_intime,p.start_route_outtime,p.end_route_intime,p.end_route_outtime,p.travel_date,p.start_polygon_name,p.end_polygon_name,TIMESTAMPDIFF(SECOND,p.`start_route_intime`,p.`start_route_outtime`) as start_dur,TIMESTAMPDIFF(SECOND,p.`end_route_intime`,`end_route_outtime`) as end_dur,v.deviceimei  FROM poly_route_list p INNER JOIN vehicletbl_2 v ON v.vehicleid=p.vehicle_id WHERE p.start_route_intime BETWEEN '".$start_date."' AND '".$end_date."' AND p.route_id = '".$route_id."' AND p.vehicle_id = '".$vehicle_id."'");

		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}


	public function polyroute_stop($route_id)
	{
	
		$query = $this->db->query("SELECT * FROM polygon_routestops WHERE route_id ='".$route_id."' ");
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

public function polyroute_stopreport($live_route_id,$geo_id)
	{
	
		$query = $this->db->query("SELECT `live_stopid`,`live_routeid`,`route_id`,`stop_geo_id`,`stopentry_time`,`stopexit_time`,`stop_polygon_name`,`stop_status`,TIMESTAMPDIFF(SECOND,`stopentry_time`,`stopexit_time`) as total_dur FROM `poly_stop_list`  WHERE live_routeid = '".$live_route_id."' AND stop_geo_id = '".$geo_id."'");

		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return 0;
		}
	}

	public function distance_reportdata($imei,$from_date,$to_date)
	{
	
    $client_id = $this->session->userdata['client_id'];
	$playtable= "play_back_history_".$client_id;

	$query1 = $this->db->query ("SELECT odometer,modified_date FROM play_back_history WHERE running_no =$imei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to_date."'  UNION SELECT odometer,modified_date FROM $playtable WHERE running_no =$imei AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i:%s') BETWEEN '".$from_date."' AND '".$to_date."'  ORDER BY modified_date DESC");

	if ($query1->num_rows() > 0 ) 
	{   
		 $result=$query1->result();

		 $n = count($result)-1;

		 $dist_km = round(($result[0]->odometer-$result[$n]->odometer),3);
		  $Arr = array(
			'end_odometer' =>$result[0]->odometer,
			'start_odometer' => $result[$n]->odometer,
			 'distance_km' =>$dist_km
			);
		  return  $Obj = (object)$Arr;

		}

	}
	public function idle_reportdata($imei,$from,$to) {

           $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(SECOND,start_day,end_day)) as idel_duration FROM idle_report WHERE device_no ='".$imei."' AND end_day !='' AND TIMESTAMPDIFF(MINUTE,start_day,end_day) > 1  AND end_day!='' AND flag='2' AND start_day BETWEEN '".$from."' AND '".$to."' ORDER BY start_day DESC");    
       
		 if ($query->num_rows() > 0) {
				
				$res =  $query->row();
				return $res->idel_duration;
            } else {
                return FALSE;
            }
      
    }


}
