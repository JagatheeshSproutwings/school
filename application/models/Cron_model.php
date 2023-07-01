<?php
defined('BASEPATH') or exit('No direct script access allowed');
//error_reporting(0);
class Cron_model extends CI_Model
{
	function __construct()
	{

		parent::__construct();
	}


	public function consolidate_distance_report($from, $to, $client_id, $vehicleid = NULL, $timezone_hours)
	{
		if (!empty($vehicleid)) {
			$playtable = "play_back_history_" . $client_id;
			$qry = $this->db->query("SHOW TABLES LIKE '" . $playtable . "'");

			if ($qry->num_rows() > 0) {


				$query1 = $this->db->query("SELECT t.odometer,(t.modified_date + INTERVAL $timezone_hours MINUTE) as datetime FROM " . $playtable . " AS t WHERE t.running_no =$vehicleid AND t.lat_message!='000000000' AND 
				t.lon_message!='000000000' AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' AND (t.modified_date + INTERVAL $timezone_hours MINUTE)
				BETWEEN '" . $from . "' AND '" . $to . "' UNION SELECT tt.odometer,(tt.modified_date + INTERVAL $timezone_hours MINUTE) as datetime FROM play_back_history AS tt WHERE 
				tt.running_no =$vehicleid AND tt.lat_message!='000000000' AND tt.lon_message!='000000000' AND tt.lat_message!='0' AND tt.lon_message!='0' 
				AND tt.lat_message!='0.0' AND tt.lon_message!='0.0' AND (tt.modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY datetime DESC");


				if ($query1) {


					if ($query1->num_rows() > 0) {
						$result = $query1->result();

						$n = count($result) - 1;

						$dist_km = round(($result[0]->odometer - $result[$n]->odometer), 3);

						$Arr = array(
							'start_odometer' => round($result[$n]->odometer, 3),
							'end_odometer' => round($result[0]->odometer, 3),
							'distance_km' => $dist_km
						);
						return  $Obj = (object)$Arr;
					} else {
						return 0;
					}
				} else {
					return 0;
				}
			} else {
				return 0;
			}
		}
	}


	public function consolidate_Ignition_report($from, $to, $vehicleid = NULL, $timezone_hours)
	{

		if (!empty($vehicleid)) {

			$query1 = $this->db->query("SELECT TIMESTAMPDIFF(MINUTE,(ip.start_day + INTERVAL $timezone_hours MINUTE),(ip.end_day +  INTERVAL $timezone_hours MINUTE)) as t_min FROM trip_report ip 
			WHERE ip.device_no=$vehicleid AND ip.end_day !='' AND ip.flag=2 AND TIMESTAMPDIFF(MINUTE,(ip.start_day + INTERVAL $timezone_hours MINUTE),(ip.end_day +  INTERVAL $timezone_hours MINUTE))>0 
			AND  (ip.start_day + INTERVAL $timezone_hours MINUTE ) >= '" . $from . "' AND (ip.start_day + INTERVAL $timezone_hours MINUTE )<= '" . $to . "' AND 
			type_id=1 GROUP BY ip.end_day ORDER BY ip.start_day DESC");


			if ($query1->num_rows() > 0) {
				//$result=$query->result_array();

				return $query1->result();
			} else {
				return FALSE;
			}
		}
	}

	public function consolidate_Ac_report($from, $to, $vehicleid = NULL)
	{
		if (!empty($vehicleid)) {

			$query1 = $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)) as t_min FROM ac_report ip WHERE ip.device_no='" . $vehicleid . "' AND ip.end_day !='' AND ip.flag='2' AND type_id=1 AND TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day)>0 AND  ip.start_day >= '" . $from . "' AND ip.start_day <= '" . $to . "'");

			if ($query1->num_rows() > 0) {
				//$result=$query->result_array();

				$duration =  $query1->row();
				return $duration->t_min;
			} else {
				return FALSE;
			}
		}
	}

	public function consolidate_idle_report($from, $to, $vehicleid = NULL, $timezone_hours)
	{

		if (!empty($vehicleid)) {

			$query1 = $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE))) as t_min FROM idle_report WHERE device_no = $vehicleid AND end_day !='' AND (end_day + INTERVAL $timezone_hours MINUTE ) <'" . $to . "'  AND flag=2 AND 
			(start_day + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY start_day DESC");

			if ($query1->num_rows() > 0) {
				return $query1->row();
			} else {
				return FALSE;
			}
		} else if ($vehicleid == NULL) {

			return FALSE;
		}
	}

	public function consolidate_firstpark_report($from, $to, $vehicleid = NULL, $timezone_hours)
	{
		$d = date("Y-m-d", strtotime($from));
		$dd = date('Y-m-d', strtotime("-1 days", strtotime($d)));
		$fromd = $dd . " 00:00:00";
		$tod = $dd . " 23:59:59";

		$first_query = $this->db->query("SELECT (end_day + INTERVAL $timezone_hours MINUTE) as end_day FROM parking_report WHERE device_no=$vehicleid  AND flag =2 
		AND (end_day + INTERVAL $timezone_hours MINUTE ) >'" . $tod . "' AND (start_day + INTERVAL $timezone_hours MINUTE ) BETWEEN '" . $fromd . "' AND '" . $tod . "' ORDER BY start_day DESC limit 1");
		$exe_query = $first_query->row();

		if ($exe_query->end_day != '') {
			$estart = strtotime($exe_query->end_day);
			$frm =  strtotime($from);
			return round(abs($estart - $frm) / 60);
		} else {
			return 0;
		}
	}

	public function consolidate_park_report($from, $to, $vehicleid = NULL, $timezone_hours)
	{

		if (!empty($vehicleid)) {

			$query1 = $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE ))) as t_min FROM parking_report WHERE device_no =$vehicleid AND end_day !='' AND 
			(end_day + INTERVAL $timezone_hours MINUTE )<'" . $to . "' AND flag=2 AND (start_day + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY start_day DESC");


			if ($query1->num_rows() > 0) {
				//$result=$query->result_array();
				return $query1->row();
			} else {
				return FALSE;
			}
		} else if ($vehicleid == NULL) {

			return FALSE;
		}
	}





	public function consolidate_lastpark_report($from, $to, $vehicleid = NULL, $timezone_hours)
	{

		$last_query = $this->db->query("SELECT (start_day + INTERVAL $timezone_hours MINUTE) as start_day,(end_day + INTERVAL $timezone_hours MINUTE) as end_day FROM parking_report
		 WHERE device_no=$vehicleid AND (end_day ='' OR (end_day + INTERVAL $timezone_hours MINUTE)>'" . $to . "') AND (start_day + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "' 
		 ORDER BY start_day DESC limit 1");

		$exe_query = $last_query->row();

		if ($exe_query->start_day != '') {
			$start = strtotime($exe_query->start_day);
			$end =  strtotime($to);
			return round(abs($end - $start) / 60);
			//exit();

		} else {
			return 0;
		}
	}


	public function consolidate_lastign_report($from, $to, $vehicleid = NULL)
	{

		$last_query = $this->db->query("SELECT start_day,ROUND(start_odometer,3),end_day FROM ignition_report WHERE device_no='" . $vehicleid . "' AND (end_day ='' OR end_day>'" . $to . "') AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i:%s') BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY start_day DESC limit 1");

		$exe_query = $last_query->row();

		if ($exe_query->start_day != '') {
			$start = strtotime($exe_query->start_day);
			$end =  strtotime($to);
			return round(abs($end - $start) / 60);
			//exit();

		} else {
			return 0;
		}
	}


	public function consolidate_firstign_report($from, $to, $vehicleid = NULL)
	{
		$d = date("Y-m-d", strtotime($from));
		$dd = date('Y-m-d', strtotime("-1 days", strtotime($d)));
		$fromd = $dd . " 00:00:00";
		$tod = $dd . " 23:59:59";

		$first_query = $this->db->query("SELECT end_day FROM ignition_report WHERE device_no='" . $vehicleid . "' AND flag ='2' AND end_day>'" . $tod . "' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i:%s') BETWEEN '" . $fromd . "' AND '" . $tod . "' ORDER BY start_day DESC limit 1");

		$exe_query = $first_query->row();

		if ($exe_query->end_day != '') {
			$estart = strtotime($exe_query->end_day);
			$frm =  strtotime($from);
			return round(abs($estart - $frm) / 60);
		} else {
			return 0;
		}
	}

	public function get_playback_data($d_id, $from, $to)
	{
		//echo "SELECT * FROM play_back_history WHERE (modified_date >= '".$from."' AND modified_date <= '".$to."') AND running_no ='".$d_id."'";
		//exit;
		$query = $this->db->query("SELECT * FROM play_back_history WHERE (modified_date >= '" . $from . "' AND modified_date <= '" . $to . "') AND running_no ='" . $d_id . "'");
		//DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_all_playback_data_for_imei($d_id)
	{
		$query = $this->db->query("SELECT * FROM play_back_history WHERE running_no ='" . $d_id . "'  AND (modified_date <= CURDATE() - INTERVAL 2 DAY)");
		//(modified_date >= '".$from."' AND modified_date <= '".$to."') AND
		//DATE_FORMAT(modified_date, '%Y-%m-%d %H:%i') BETWEEN '".$from."' AND '".$to."'
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function allliveroutelist($shift_type)
	{
		$query = $this->db->query("SELECT ra.*,sr.route_name,sr.route_geo_start_id,sr.route_geo_end_id,sr.route_starttime,sr.route_endtime,v.vehiclename FROM `sch_routeassigntbl` ra INNER JOIN sch_routestbl sr ON sr.route_id = ra.route_id INNER JOIN vehicletbl_2 v ON v.vehicleid=ra.vehicle_id WHERE `shift_type`=1");
		//echo " SELECT * FROM routes ";

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			false;
		}
	}




	public function routestartgeo($route_startid, $vehicle_id, $route_starttime)
	{
		$client_id = $this->session->userdata['client_id'];

		$first_start_time = date('Y-m-d H:i:s', strtotime('- 40 minutes', strtotime($route_starttime)));
		$first_end_time =  date('Y-m-d H:i:s', strtotime('+ 40 minutes', strtotime($route_starttime)));

		$query = $this->db->query("select g_lat,g_lng,out_datetime from sch_geofence_report where geo_location_id ='$route_startid' and vehicle_id = '$vehicle_id' and out_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}


	public function routeendgeo($route_endid, $vehicle_id, $route_endtime)
	{
		$client_id = $this->session->userdata['client_id'];


		$first_start_time = date('Y-m-d H:i:s', strtotime('- 40 minutes', strtotime($route_endtime)));
		$first_end_time =  date('Y-m-d H:i:s', strtotime('+ 40 minutes', strtotime($route_endtime)));

		$query = $this->db->query("select g_lat,g_lng,in_datetime from sch_geofence_report where geo_location_id ='$route_endid' and vehicle_id = '$vehicle_id' and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");



		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function routelatlng($route_endid, $client_id)
	{
		$query = $this->db->query("SELECT Lat,Lng FROM sch_location_list WHERE Location_Id ='$route_endid' AND client_id = '$client_id'");


		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function vehiclelatlng($vehicle_id, $client_id)
	{
		$query = $this->db->query("SELECT lat,lng,speed FROM vehicletbl WHERE vehicleid ='" . $vehicle_id . "' AND client_id = '" . $client_id . "'");

		//echo "SELECT lat,lng FROM vehicle WHERE vehicle_id ='$vehicle_id' AND client_id = '$client_id'";exit;
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function add_livedata($livedata)
	{


		$query1 = $this->db->insert('sch_add_liveroute_list', $livedata);
		$insert_id = $this->db->insert_id();

		if ($query1) {
			return $insert_id;
		} else if ($query2) {
			return '0';
		}
	}

	public function livestop_details($route_id)
	{
		$client_id = $this->session->userdata['client_id'];
		$query = $this->db->query("SELECT * FROM sch_routestoptbl WHERE route_id ='$route_id'");
		//echo "SELECT * FROM route_stops WHERE route_id ='$route_id' AND client_id = '$client_id'";exit;

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}


	public function stop_geointime($stop_geoid, $vehicle_id, $stop_arrival_time)
	{
		$first_start_time = date('Y-m-d H:i:s', strtotime('- 40 minutes', strtotime($stop_arrival_time)));
		$first_end_time =  date('Y-m-d H:i:s', strtotime('+ 40 minutes', strtotime($stop_arrival_time)));

		$query = $this->db->query("select g_lat,g_lng,in_datetime from sch_geofence_report where geo_location_id ='$stop_geoid' and vehicle_id = '$vehicle_id' and in_datetime BETWEEN '$first_start_time' AND '$first_end_time' ORDER BY in_datetime ASC LIMIT 1");

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function stop_geoouttime($stop_geoid, $vehicle_id, $stop_start_time)
	{
		$first_start_time = date('Y-m-d H:i:s', strtotime('- 40 minutes', strtotime($stop_start_time)));
		$first_end_time =  date('Y-m-d H:i:s', strtotime('+ 40 minutes', strtotime($stop_start_time)));


		$query = $this->db->query("select g_lat,g_lng,out_datetime from sch_geofence_report where geo_location_id ='$stop_geoid' and vehicle_id = '$vehicle_id' and out_datetime BETWEEN ' $first_start_time' AND '$first_end_time' ORDER BY out_datetime ASC LIMIT 1");


		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function stoplatlng($stop_geoid, $client_id)
	{
		$query = $this->db->query("SELECT Lat,Lng FROM sch_location_list WHERE Location_Id ='$stop_geoid' AND client_id = '$client_id'");


		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function add_livestop($livestop_data)
	{

		$query1 = $this->db->insert('sch_add_livestop_list', $livestop_data);

		if ($query1) {
			return '1';
		} else if ($query2) {
			return '0';
		}
	}


	public function geo_vehicle_location()
	{

		$query = $this->db->query("SELECT ll.Location_Id,ll.radius,ll.Location_short_name,ll.Lat as g_lat,ll.Lng as g_lng,v.lat as v_lat,v.lng as v_lng,v.client_id,v.speed,v.acc_on,v.vehicleid FROM sch_assign_geo_fenceing af INNER JOIN sch_location_list ll ON ll.Location_Id = af.geo_location_id INNER JOIN vehicletbl_2 v ON v.vehicleid = af.vehicle_id");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function last_georeport_data($g_id, $vid)
	{

		$query = $this->db->query("SELECT location_status,id,geo_location_id,in_datetime FROM sch_geofence_report WHERE geo_location_id = $g_id AND vehicle_id =$vid ORDER BY id DESC LIMIT 1");

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return 0;
		}
	}

	public function last_georeport_data1($g_id, $vid)
	{

		$query = $this->db->query("SELECT * FROM sch_geofence_report_test WHERE geo_location_id = $g_id AND vehicle_id =$vid ORDER BY id DESC LIMIT 1");

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return 0;
		}
	}

	public function notification_alerts()
	{
		$query = $this->db->query("SELECT n.*,u.push_code FROM `sch_notification_alert` n INNER JOIN usertbl u ON u.userid=n.parent_id");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

	public function notification_alerts_all()
	{
		$query = $this->db->query("SELECT * FROM `sch_notification_alert`");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}
}
