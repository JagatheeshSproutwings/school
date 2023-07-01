<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Genericreport_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
    }

    public function parking_report_list($from, $to, $vehicleid = NULL, $time)
    {

        $timezone_hours = $this->session->userdata('timezone_hours');
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

    //IDLE REPORT LIST



    public function idle_report_list($from, $to, $vehicleid = NULL, $time)
    {

        $timezone_hours = $this->session->userdata('timezone_hours');
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

    //END OF IDLE REPORT



    //AC REPORT LIST

    public function ac_report_list($from, $to, $vehicleid = NULL, $time)
    {
        if (!empty($vehicleid)) {
            $query = $this->db->query("SELECT ir.report_id,ir.device_no,TIME_FORMAT(TIMEDIFF(ir.end_day,ir.start_day), '%H:%i:%s') as time_duration,
                    ir.s_lat,ir.s_lng,ir.start_day,ir.end_day,v.vehiclename,ir.start_location,ir.end_location,v.vehiclename 
                    FROM ac_report ir 
                    LEFT JOIN vehicletbl v ON ir.vehicle_id = v.vehicleid  
                    WHERE ir.device_no ='" . $vehicleid . "' 
                    AND ir.flag='2' 
                    AND ir.end_day !='' 
                    AND TIMESTAMPDIFF(MINUTE,ir.start_day,ir.end_day)>'" . $time . "' 
                    AND ir.start_day >= '" . $from . "' 
                    AND ir.start_day <= '" . $to . "' 
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

    //AC OF IDLE REPORT

    public function trip_report_list($from, $to, $vehicleid = NULL, $time)
    {

        $timezone_hours = $this->session->userdata('timezone_hours');
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

    public function idledata_location($report_id)
    {

        $query = $this->db->query("SELECT ir.report_id,ir.device_no,TIME_FORMAT(TIMEDIFF(ir.end_day,ir.start_day), '%H:%i:%s') as time_duration,
                        ir.s_lat,ir.s_lng,ir.start_day,ir.end_day,v.vehiclename,ir.start_location,ir.end_location 
                        FROM idle_report ir 
                        LEFT JOIN vehicletbl v ON ir.vehicle_id = v.vehicleid  
                        WHERE ir.report_id='" . $report_id . "'");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            false;
        }
    }

    public function parkdata_location($report_id)
    {

        $query = $this->db->query("SELECT ir.report_id,ir.device_no,ir.vehicle_id,TIME_FORMAT(TIMEDIFF(ir.end_day,ir.start_day), '%H:%i:%s') as time_duration,ir.s_lat,ir.s_lng,ir.start_day,ir.end_day,v.vehiclename,ir.start_location,ir.end_location FROM parking_report ir LEFT JOIN vehicletbl v ON ir.vehicle_id = v.vehicleid  WHERE ir.report_id='" . $report_id . "'");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            false;
        }
    }

    public function alert_location($report_id)
    {

        $query = $this->db->query("SELECT * FROM sms_alert ir WHERE ir.sms_alert_id='" . $report_id . "'");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            false;
        }
    }

    public function tripdata_location($report_id)
    {

        $query = $this->db->query("SELECT TIME_FORMAT(TIMEDIFF(ip.end_day,ip.start_day), '%H:%i:%s') as time_duration,
                        TIMESTAMPDIFF(MINUTE,ip.start_day,ip.end_day) as t_min,ip.start_day,ip.end_day,(ip.end_odometer - ip.start_odometer) as distance,
                        ip.s_lng,ip.s_lat,ip.e_lng,ip.e_lat,ip.device_no,v.vehiclename,v.device_config_type,v.deviceimei,ip.end_odometer,ip.start_odometer,
                        ip.start_location,ip.end_location,ip.report_id 
                        FROM trip_report ip 
                        LEFT JOIN vehicletbl v ON ip.vehicle_id = v.vehicleid
                         WHERE ip.report_id='" . $report_id . "'");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            false;
        }
    }

    public function get_trip_route_data($d_id, $from, $to)
    {

        $client_id = $this->session->userdata['client_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');

        $play_table = "play_back_history_" . $client_id;
        $qry = $this->db->query("SHOW TABLES LIKE '" . $play_table . "'");

        if ($qry->num_rows() > 0) {
            $query = $this->db->query("SELECT odometer,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date,lat_message,lon_message FROM play_back_history
            WHERE running_no =$d_id AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND 
            lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "'  UNION 
            SELECT odometer,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date,lat_message,lon_message FROM " . $play_table . " WHERE running_no =$d_id AND
             lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND 
             lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "'  
             ORDER BY modified_date ASC");
        } else {
            $query = $this->db->query("SELECT odometer,running_no,lat_message,lon_message,speed,acc_status,door_status,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date,
            FROM play_back_history WHERE running_no =$d_id AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' 
            AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' 
            AND '" . $to . "'  ORDER BY modofied_date ASC");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function Distance_report_list($from, $to, $vehicleid = NULL, $device_config_type)
    {

        $timezone_hours = $this->session->userdata('timezone_hours');
        if (!empty($vehicleid)) {
            $cur_date = date("Y-m-d");
            if ($from == $cur_date && $cur_date == $to) {

                    $client_id = $this->session->userdata['client_id'];
                    $playtable = "play_back_history_" . $client_id;
                    $qry = $this->db->query("SHOW TABLES LIKE '" . $playtable . "'");
                    $from_date1 = $from . " 00:00:00";
                    $to_date1 = $to . " 23:59:59";
                    if ($qry->num_rows() > 0) {
                        $query1 = $this->db->query("SELECT odometer,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date FROM 
                        $playtable WHERE running_no =$vehicleid AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' 
                        AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE)
                         BETWEEN '" . $from_date1 . "' AND '" . $to_date1 . "'   ORDER BY modified_date DESC");

                        if ($query1->num_rows() > 0) {
                            $result = $query1->result();

                            $n = count($result) - 1;

                            $dist_km = round(($result[0]->odometer - $result[$n]->odometer), 3);

                            return $dist_km;
                        } else {
                            return false;
                        }
                    } else {

                        $query1 = $this->db->query("SELECT odometer,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date FROM play_back_history
                         WHERE running_no =$vehicleid AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' 
                         AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from_date1 . "' AND '" . $to_date1 . "' 
                           ORDER BY modified_date DESC");

                        if ($query1->num_rows() > 0) {
                            $result = $query1->result();

                            $n = count($result) - 1;

                            $dist_km = round(($result[0]->odometer - $result[$n]->odometer), 3);

                            return $dist_km;
                        } else {
                            return false;
                        }
                    }
                
            } else {

                $client_id = $this->session->userdata['client_id'];
                $query = $this->db->query("SELECT DISTINCT date, imei,distance_km FROM consolidate_distance_report WHERE imei=$vehicleid AND (date = '" . $from . "' AND date = '" . $to . "') AND client_id ='" . $client_id . "'");
                if ($query->num_rows() > 0) {
                    $result = $query->row();

                    return $result->distance_km;
                } else {
                    return 0;
                }
            }
        } else {
            return false;
        }
    }

    public function hubpoint_report($from, $to, $vehicleid = NULL)
    {

        if (!empty($vehicleid)) {

            $client_id = $this->session->userdata['client_id'];

            $query1 = $this->db->query("SELECT ts.start_odometer,ts.end_odometer,ts.out_datetime as start_day,ts.in_datetime as end_day,
                TIME_FORMAT(TIMEDIFF(ts.in_datetime,ts.out_datetime), '%H:%i:%s') as total_dur,(ts.end_odometer - ts.start_odometer) as distance,
                ts.trip_id,ts.vehicle_id,v.deviceimei,v.vehiclename,TIMESTAMPDIFF(MINUTE,ts.out_datetime,ts.in_datetime) as trip_mins ,
                TIMESTAMPDIFF(HOUR,ts.out_datetime,ts.in_datetime) as trip_hours,tsl.location_name 
                FROM hub_report ts 
                LEFT JOIN vehicletbl v ON v.vehicleid = ts.vehicle_id 
                LEFT JOIN hubpoint_location tsl ON tsl.id = ts.g_id 
                WHERE ts.vehicle_id ='" . $vehicleid . "' 
                AND ts.client_id = '" . $client_id . "' 
                AND ts.location_status ='2' 
                AND (ts.end_odometer - ts.start_odometer) >0 
                AND ts.out_datetime
                BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY ts.id DESC");



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

    public function geo_report_data($from, $to, $vehicle, $location)
    {
        //echo $from;echo $to;echo $location;echo $vehicle; exit;
        $client_id = $this->session->userdata['client_id'];
        $user_id = $this->session->userdata['userid'];
        $role = $this->session->userdata['roleid'];
        if ($vehicle == 'all' && $location == '') {

            $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,
                            tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby
                            from geofence_report tg 
                            LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id 
                            LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id 
                            where tg.in_datetime!='' 
                            AND tg.client_id='" . $client_id . "'
                            AND ll.createdby='" . $user_id . "'
                            AND tg.in_datetime 
                            BETWEEN '" . $from . "' AND '" . $to . "' 
                            order by tg.in_datetime DESC");
            //echo '1'; exit;

            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else if ($vehicle == 'all' && $location != '') {

            if ($role == 8 || $user_id == 449) {
                $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby from geofence_report tg LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '" . $location . "' and tg.in_datetime!='' and tg.client_id='" . $client_id . "'  and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' order by tg.in_datetime DESC");
            } else {
                $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby from geofence_report tg LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '" . $location . "' and tg.in_datetime!='' and tg.client_id='" . $client_id . "' AND ll.CreatedBy='" . $user_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' order by tg.in_datetime DESC");
            }

            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else if ($vehicle != '' && $location != '') {
            if ($role == 8 || $user_id == 449) {
                $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby from geofence_report tg LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '" . $location . "' and v.vehicleid = '" . $vehicle . "' and tg.in_datetime!='' and tg.client_id='" . $client_id . "' AND  tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' order by tg.in_datetime DESC");
                //echo '1'; exit;
            } else {
                $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby from geofence_report tg LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '" . $location . "' and v.vehicleid = '" . $vehicle . "' and tg.in_datetime!='' and tg.client_id='" . $client_id . "' AND ll.CreatedBy='" . $user_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' order by tg.in_datetime DESC");
                //echo '1'; exit;
            }



            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else if ($vehicle != '' && $location == '') {

            $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby from geofence_report tg LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where v.vehicleid = '" . $vehicle . "' and tg.in_datetime!='' and tg.client_id='" . $client_id . "' AND ll.CreatedBy='" . $user_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' order by tg.in_datetime DESC");



            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else if ($location != '' && $vehicle == '') {

            $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby from geofence_report tg LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where tg.geo_location_id = '" . $location . "' and tg.in_datetime!='' and tg.client_id='" . $client_id . "' AND ll.CreatedBy='" . $user_id . "'  and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' order by tg.in_datetime DESC");
            //echo '2'; exit;

            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else {
            $query = $this->db->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)) as time_duration,tg.out_datetime,tg.in_datetime,tg.geo_location_id,v.vehiclename,ll.Location_short_name,tg.client_id,ll.createdby from geofence_report tg LEFT JOIN vehicletbl v ON v.vehicleid = tg.vehicle_id LEFT JOIN location_list ll on ll.Location_Id = tg.geo_location_id where  tg.in_datetime!='' and  tg.client_id='" . $client_id . "' AND ll.CreatedBy='" . $user_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' order by tg.in_datetime DESC");


            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        }
    }

    public function get_fuel_data($d_id, $from, $to, $type_id)
    {

        if ($type_id == 2) {


            $query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.end_date as created_on,fl.end_date,fl.type_id, fl.location_name FROM vehicletbl v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei WHERE v.deviceimei ='" . $d_id . "' AND fl.end_date between '" . $from . "' AND '" . $to . "' AND fl.type_id ='2' ORDER BY fl.end_date DESC");

            // $query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.end_date as created_on,fl.end_date,fl.type_id, fl.location_name FROM vehicletbl v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei WHERE v.deviceimei ='".$d_id."' AND fl.end_date between '".$from."' AND '".$to."' AND fl.type_id ='2' ORDER BY fl.end_date DESC");
        } else if ($type_id == 3) {

            $query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.end_date as created_on,fl.end_date,fl.type_id, fl.location_name FROM vehicletbl v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei WHERE v.deviceimei ='" . $d_id . "' AND fl.end_date between '" . $from . "' AND '" . $to . "' ORDER BY fl.end_date DESC");
            // $query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.start_date,fl.end_date,fl.end_date as created_on,fl.type_id, fl.location_name FROM vehicle v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei WHERE v.deviceimei ='".$d_id."' AND fl.end_date between '".$from."' AND '".$to."' AND fl.type_id ='1' ORDER BY fl.end_date DESC");
        } else if ($type_id == 1) {

            $query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.end_date as created_on,fl.end_date,fl.type_id, fl.location_name FROM vehicletbl v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei WHERE v.deviceimei ='" . $d_id . "' AND fl.end_date between '" . $from . "' AND '" . $to . "' AND fl.type_id ='1' ORDER BY fl.end_date DESC");

            //$query = $this->db->query("SELECT fl.id,fl.running_no ,fl.lat,fl.lng,fl.start_fuel,fl.end_fuel,ROUND(fl.difference_fuel,2) as difference_fuel,fl.start_date,fl.end_date,fl.end_date as created_on,fl.type_id, fl.location_name FROM vehicletbl v LEFT JOIN fuel_fill_dip_report fl ON fl.running_no = v.deviceimei WHERE v.deviceimei ='".$d_id."' AND fl.end_date between '".$from."' AND '".$to."' ORDER BY fl.end_date DESC");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function fuel_data_distance($from, $to, $vehicleid)
    {

        $query = $this->db->query("SELECT modified_date,litres, odometer FROM fuel_status WHERE running_no ='" . $vehicleid . "' AND flag='0' AND litres!='0' AND (modified_date >= '" . $from . "' AND modified_date <= '" . $to . "') ORDER BY modified_date DESC");
        // echo "SELECT modified_date,litres, odometer FROM fuel_status WHERE running_no ='".$vehicleid."' AND flag='0' AND litres!='0' AND odometer!='0' AND modified_date BETWEEN '".$from."' AND  '".$to."' ORDER BY modified_date DESC";exit;

        if ($query->num_rows() > 0) {
            //$result=$query->result_array();

            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function polygon_report($from, $to, $vehicle, $polygon_area)
    {

        $client_id = $this->session->userdata['client_id'];

        if (($vehicle == 'all' || $vehicle == '') && ($polygon_area == '' || $polygon_area == 'all')) {
            $query = $this->db->query("SELECT COALESCE(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)),'-') as time_duration,COALESCE(tg.out_datetime,'-') as out_datetime,tg.in_datetime,tg.vehicle_name,tg.vehicle_imei,tg.polygon_area_name,tg.polygon_id,tg.s_lat,tg.s_lng,tg.e_lat,tg.e_lng from polygon_report1 tg where tg.in_datetime!='' and tg.client_id='" . $client_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY tg.in_datetime");
            //echo '1'; exit;

            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else if (($vehicle == 'all' || $vehicle == '') && $polygon_area != 'all') {
            $query = $this->db->query("SELECT COALESCE(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)),'-') as time_duration,COALESCE(tg.out_datetime,'-') as out_datetime,tg.in_datetime,tg.vehicle_name,tg.vehicle_imei,tg.polygon_area_name,tg.polygon_id,tg.s_lat,tg.s_lng,tg.e_lat,tg.e_lng from polygon_report1 tg where tg.in_datetime!='' and tg.client_id='" . $client_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' AND polygon_id='" . $polygon_area . "' ORDER BY tg.in_datetime");
            //echo '1'; exit;

            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else if ($vehicle != 'all' && $polygon_area != 'all') {
            $query = $this->db->query("SELECT COALESCE(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)),'-') as time_duration,COALESCE(tg.out_datetime,'-') as out_datetime,tg.in_datetime,tg.vehicle_name,tg.vehicle_imei,tg.polygon_area_name,tg.polygon_id,tg.s_lat,tg.s_lng,tg.e_lat,tg.e_lng from polygon_report1 tg where tg.in_datetime!='' and tg.client_id='" . $client_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' AND tg.vehicle_imei = '" . $vehicle . "' AND tg.polygon_id='" . $polygon_area . "' ORDER BY tg.in_datetime");
            //echo '1'; exit;

            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else if ($vehicle != 'all' && ($polygon_area == 'all' || $polygon_area == '')) {
            $query = $this->db->query("SELECT COALESCE(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,tg.in_datetime,tg.out_datetime)),'-') as time_duration,COALESCE(tg.out_datetime,'-') as out_datetime,tg.in_datetime,tg.vehicle_name,tg.vehicle_imei,tg.polygon_area_name,tg.polygon_id,tg.s_lat,tg.s_lng,tg.e_lat,tg.e_lng from polygon_report1 tg where tg.in_datetime!='' and tg.client_id='" . $client_id . "' and tg.in_datetime BETWEEN '" . $from . "' AND '" . $to . "' AND tg.vehicle_imei = '" . $vehicle . "' ORDER BY tg.in_datetime");
            //echo '1'; exit;

            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        }
    }

    public function get_all_history_data($vehicle = NULL, $form_date, $to_date)
    {
        $client_id = $this->session->userdata['client_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');
        $play_table = "play_back_history_" . $client_id;
        $qry = $this->db->query("SHOW TABLES LIKE '" . $play_table . "'");

        $fromdate = date('Ymd', strtotime($form_date));
        $todate = date('Ymd', strtotime($to_date));
        $current_date = date('Ymd');
        //$qfetch = $qry->row();
        if ($qry->num_rows() > 0) {
    
            $query = $this->db->query("SELECT t.zap,t.odometer,t.running_no,t.lat_message,t.lon_message,t.angle,t.speed,t.acc_status,t.door_status,
                 (t.modified_date + INTERVAL $timezone_hours MINUTE) as datetime,v.vehicleid as vehicle_id,v.vehiclename,v.vehicletype,v.fuel_odo FROM vehicletbl v
                  INNER JOIN " . $play_table . " t ON t.running_no = v.deviceimei WHERE v.deviceimei =$vehicle AND t.lat_message!='000000000' AND t.lon_message!='000000000' 
                  AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' AND (t.modified_date + INTERVAL $timezone_hours MINUTE)  BETWEEN '" . $form_date . "' AND '" . $to_date . "'
                   UNION SELECT tt.zap,tt.odometer,tt.running_no,tt.lat_message,tt.lon_message,tt.angle,tt.speed,tt.acc_status,tt.door_status,(tt.modified_date + INTERVAL $timezone_hours MINUTE) as datetime,vt.vehicleid as vehicle_id,vt.vehiclename as vehicle_name,vt.vehicletype,vt.fuel_odo FROM vehicletbl vt 
                   INNER JOIN play_back_history tt ON tt.running_no = vt.deviceimei WHERE vt.deviceimei =$vehicle AND tt.lat_message!='000000000' AND tt.lon_message!='000000000' AND tt.lat_message!='0' AND tt.lon_message!='0' AND tt.lat_message!='0.0' AND tt.lon_message!='0.0' 
                   AND (tt.modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $form_date . "' AND '" . $to_date . "'  ORDER BY datetime ASC");
        } else {
            $query = $this->db->query("SELECT t.zap,t.odometer,t.running_no,t.lat_message,t.lon_message,t.angle,t.speed,t.acc_status,
                t.door_status,(t.modified_date + INTERVAL $timezone_hours MINUTE) as datetime,v.vehicleid,v.vehiclename,v.vehicletype FROM vehicletbl v INNER JOIN play_back_history t ON t.running_no = v.deviceimei WHERE v.deviceimei =$vehicle
                 AND t.lat_message!='000000000' AND t.lon_message!='000000000' AND t.lat_message!='0' AND t.lon_message!='0' AND t.lat_message!='0.0' AND t.lon_message!='0.0' 
                 AND (t.modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $form_date . "' AND '" . $to_date . "'  ORDER BY t.modified_date ASC");
        }


        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else {
            return FALSE;
        }
    }


    public function get_park_history_data($vehicleid = NULL, $from, $to)
    {

        $timezone_hours = $this->session->userdata('timezone_hours');

        if (!empty($vehicleid)) {

            $query1 = $this->db->query("SELECT device_no,TIME_FORMAT(TIMEDIFF((end_day + INTERVAL $timezone_hours MINUTE),(start_day + INTERVAL $timezone_hours MINUTE)), '%H:%i:%s') as time_duration,
            s_lat,s_lng,start_day + INTERVAL $timezone_hours MINUTE,end_day + INTERVAL $timezone_hours MINUTE FROM parking_report 
            WHERE device_no =$vehicleid AND end_day !='' AND flag=2 AND (start_day + INTERVAL $timezone_hours MINUTE) >= '" . $from . "' AND (start_day + INTERVAL $timezone_hours MINUTE) <= '" . $to . "' ORDER BY start_day ASC");

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

    public function alert_report_list($from, $to, $alert_id, $vehicle = NULL)
    {
        $client_id = $this->session->userdata['client_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');
        if ($vehicle != '') {
            if ($alert_id != '') {
                if ($alert_id == '0') {
                    if ($vehicle == '0' || $vehicle == '') {
                        $query =  $this->db->query("SELECT sms_alert_id,vehicle_id,all_status,(createdon + INTERVAL $timezone_hours MINUTE) as createdon,alert_location FROM sms_alert WHERE client_id =$client_id AND (createdon + INTERVAL $timezone_hours MINUTE) between '" . $from . "' AND '" . $to . "' ORDER BY createdon DESC LIMIT 100");
                    } else { //echo $vehicle; exit();
                        $query =  $this->db->query("SELECT sms_alert_id,vehicle_id,all_status,(createdon + INTERVAL $timezone_hours MINUTE) as createdon,alert_location FROM sms_alert WHERE client_id =$client_id AND vehicle_id =$vehicle AND (createdon + INTERVAL $timezone_hours MINUTE) between '" . $from . "' AND '" . $to . "' ORDER BY createdon DESC  LIMIT 100");
                    }
                } else { //exit;
                    if ($vehicle == '0' || $vehicle == '') {
                        $query =  $this->db->query("SELECT sms_alert_id,vehicle_id,all_status,(createdon + INTERVAL $timezone_hours MINUTE) as createdon,alert_location FROM sms_alert WHERE client_id =$client_id AND all_status =$alert_id  AND (createdon + INTERVAL $timezone_hours MINUTE) between '" . $from . "' AND '" . $to . "' ORDER BY createdon DESC  LIMIT 100");
                    } else {

                        $query =  $this->db->query("SELECT sms_alert_id,vehicle_id,all_status,(createdon + INTERVAL $timezone_hours MINUTE) as createdon,alert_location FROM sms_alert WHERE client_id =$client_id AND vehicle_id =$vehicle AND all_status =$alert_id  AND (createdon + INTERVAL $timezone_hours MINUTE) between '" . $from . "' AND '" . $to . "' ORDER BY createdon DESC  LIMIT 100");
                    }
                }
            } else { //echo "ji";exit;
                $query =  $this->db->query("SELECT sms_alert_id,vehicle_id,all_status,(createdon + INTERVAL $timezone_hours MINUTE) as createdon,alert_location FROM sms_alert WHERE client_id =$client_id AND (createdon + INTERVAL $timezone_hours MINUTE) between '" . $from . "' AND '" . $to . "' ORDER BY createdon DESC LIMIT 100");
            }

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        }
    }

    public function playback_data($d_id, $from, $to, $client_id)
    {

        $timezone_hours = $this->session->userdata('timezone_hours');

        $play_table = "play_back_history_" . $client_id;
        $qry = $this->db->query("SHOW TABLES LIKE '" . $play_table . "'");

        if ($qry->num_rows() > 0) {
            $query = $this->db->query("SELECT odometer,lat_message,lon_message,speed,acc_status,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date FROM play_back_history
            WHERE running_no =$d_id AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND 
            lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "'  
            UNION
             SELECT odometer,lat_message,lon_message,speed,acc_status,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date FROM " . $play_table . " WHERE running_no =$d_id AND
             lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND 
             lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "'  
             ORDER BY modified_date ASC");
        } else {
            $query = $this->db->query("SELECT odometer,lat_message,lon_message,speed,acc_status,(modified_date + INTERVAL $timezone_hours MINUTE) as modified_date
             FROM play_back_history WHERE running_no =$d_id AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' 
             AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND (modified_date + INTERVAL $timezone_hours MINUTE) BETWEEN '" . $from . "' AND '" . $to . "'  
             ORDER BY modified_date ASC");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
