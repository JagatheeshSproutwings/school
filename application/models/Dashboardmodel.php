<?php
defined('BASEPATH') or exit('no direct script access allowed');
class Dashboardmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  public function vehicle_details()
    {
        $client_id = $this->session->userdata('client_id');
        $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');

       
       $query = $this->db->query("SELECT * FROM vehicletbl WHERE client_id='".$client_id."' AND status=1");
     
            if ($query->num_rows() > 0)
            {

                return $query->result();
            }
            else
            {
                return false;
            }
    }
     public function all_vehicle_loc($v_status=null)
    {
        $client_id = $this->session->userdata('client_id');
        $timezone_hours = $this->session->userdata('timezone_hours');
        $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');

        if($v_status=='1')
        {
                
        $query = $this->db->query("SELECT simnumber,installationdate,expiredate,mdvr_terminal_no,today_km,internal_battery_voltage,vehicle_sleep,deviceimei,angle,
        vehicletype as vehicle_type,angle,vehicleid,vehiclename,lat,lng,speed,updatedon,TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,lat,lng,
        acc_on,acc_flag,acc_date_time,ac_flag,ac_date,ac_km,odometer as kilometer,fuel_ltr,fuel_tank_capacity,temperature,TIME_FORMAT(TIMEDIFF(NOW(),last_ign_off), '%H:%i:%s') as last_dur,
         TIME_FORMAT(TIMEDIFF(NOW(),updatedon), '%H:%i:%s') as no_last_dur,device_config_type,device_type,hub_ETA,round(litres*keyword) as DTE FROM vehicletbl WHERE status=1
          AND TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND acc_on ='1' and round(speed) >= '1' AND client_id='".$client_id."'");


        }
        elseif ($v_status=='2') 
        {

           
           $query = $this->db->query("SELECT simnumber,installationdate,expiredate,mdvr_terminal_no,today_km,internal_battery_voltage,vehicle_sleep,deviceimei,angle,
           vehicletype as vehicle_type,angle,vehicleid,vehiclename,lat,lng,speed,updatedon,TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,lat,lng,acc_on,
           acc_flag,acc_date_time,ac_flag,ac_date,ac_km,odometer as kilometer,fuel_ltr,fuel_tank_capacity,temperature,TIME_FORMAT(TIMEDIFF(NOW(),last_ign_off), '%H:%i:%s') as last_dur,
            TIME_FORMAT(TIMEDIFF(NOW(),updatedon), '%H:%i:%s') as no_last_dur,device_config_type,device_type,hub_ETA,round(litres*keyword) as DTE FROM vehicletbl WHERE status=1 AND
             TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND acc_on ='1' and round(speed) = '0' AND  client_id='".$client_id."'");

        }
        elseif ($v_status=='3') 
        {

          
            
        $query = $this->db->query("SELECT simnumber,installationdate,expiredate,mdvr_terminal_no,today_km,internal_battery_voltage,vehicle_sleep,deviceimei,angle,
        vehicletype as vehicle_type,angle,vehicleid,vehiclename,lat,lng,speed,updatedon,TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,lat,lng,acc_on,acc_flag,
        acc_date_time,ac_flag,ac_date,ac_km,odometer as kilometer,fuel_ltr,fuel_tank_capacity,temperature,TIME_FORMAT(TIMEDIFF(NOW(),last_ign_off), '%H:%i:%s') as last_dur, 
        TIME_FORMAT(TIMEDIFF(NOW(),updatedon), '%H:%i:%s') as no_last_dur,device_config_type,device_type,hub_ETA,round(litres*keyword) as DTE FROM vehicletbl WHERE status=1
         AND TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND acc_on ='0'  and client_id='".$client_id."' ORDER BY vehiclename");
            
        }
        elseif ($v_status=='4') 
        {

         $query = $this->db->query("SELECT simnumber,installationdate,expiredate,mdvr_terminal_no,today_km,internal_battery_voltage,vehicle_sleep,deviceimei,angle,
         vehicletype as vehicle_type,angle,vehicleid,vehiclename,lat,lng,speed,updatedon,TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,lat,lng,acc_on,acc_flag,
         acc_date_time,ac_flag,ac_date,ac_km,odometer as kilometer,fuel_ltr,fuel_tank_capacity,temperature,TIME_FORMAT(TIMEDIFF(NOW(),last_ign_off), '%H:%i:%s') as last_dur,
          TIME_FORMAT(TIMEDIFF(NOW(),updatedon), '%H:%i:%s') as no_last_dur,device_config_type,device_type,hub_ETA,round(litres*keyword) as DTE FROM vehicletbl WHERE status=1
           AND (TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' OR updatedon IS NULL) AND client_id='".$client_id."'");
        }
        else
        {
        $query = $this->db->query("SELECT simnumber,installationdate,expiredate,mdvr_terminal_no,today_km,internal_battery_voltage,vehicle_sleep,deviceimei,angle,
        vehicletype as vehicle_type,angle,vehicleid,vehiclename,lat,lng,speed,updatedon,TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,lat,lng,acc_on,
        acc_flag,acc_date_time,ac_flag,ac_date,ac_km,odometer as kilometer,fuel_ltr,fuel_tank_capacity,temperature,TIME_FORMAT(TIMEDIFF(NOW(),last_ign_off), '%H:%i:%s') as last_dur,
         TIME_FORMAT(TIMEDIFF(NOW(),updatedon), '%H:%i:%s') as no_last_dur,device_config_type,device_type,hub_ETA,round(litres*keyword) as DTE FROM vehicletbl WHERE status=1 
         AND client_id='".$client_id."'");


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

       public function all_vehicles()
    {
        $client_id = $this->session->userdata('client_id');
         $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');

        if ($roleid==6) 
        {

        $query = $this->db->query("SELECT vehiclename,deviceimei FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid WHERE ao.owner_id='".$userid."' AND  v.status='1' AND v.client_id='".$client_id."'");
  
        }
        else
        {

        $query = $this->db->query("SELECT vehiclename,deviceimei FROM vehicletbl WHERE status='1' AND client_id='".$client_id."'");

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


    public function allvehicle_count()
    {
        $client_id = $this->session->userdata('client_id');
        $timezone_hours = $this->session->userdata('timezone_hours');
        $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');

         if ($roleid==6) 
        {
              $query =  $this->db->query("SELECT (SELECT count(v.vehicleid) FROM vehicletbl v  INNER JOIN assign_owner ao ON ao.vehicle_id=v.vehicleid  
              WHERE ao.owner_id = '".$userid."' AND v.status='1' AND v.visible_status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='0' AND v.client_id ='".$client_id."') as park_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id=v.vehicleid  WHERE ao.owner_id = '".$userid."' AND v.status='1' AND v.visible_status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(speed) = '0' and v.client_id ='".$client_id."') as idle_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id=v.vehicleid  WHERE ao.owner_id = '".$userid."' AND v.status='1' AND v.visible_status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(v.speed) >= '1' and v.client_id ='".$client_id."') as move_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v  INNER JOIN assign_owner ao ON ao.vehicle_id=v.vehicleid  WHERE ao.owner_id = '".$userid."' AND v.visible_status=1 AND (TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' OR v.updatedon IS NULL) and v.client_id ='".$client_id."') as nonetwork_count" );

        }
        else
        {
              $query =  $this->db->query("SELECT (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status='1' AND v.visible_status=1 
              AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='0' AND v.client_id ='".$client_id."') as park_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status='1'  AND v.visible_status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(speed) = '0' and v.client_id ='".$client_id."') as idle_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v WHERE v.status='1' AND v.visible_status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(v.speed) >= '1' and v.client_id ='".$client_id."') as move_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE (TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' AND v.status=1 OR v.updatedon IS NULL) AND v.visible_status=1 AND v.client_id ='".$client_id."') as nonetwork_count" );
        }
    


            if ($query->num_rows() > 0)
            {

                return $query->row();
            }
            else
            {
                return false;
            }
    }

      public function moving_vehicle()
    {
        $client_id = $this->session->userdata('client_id');
         $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');
        $timezone_hours = $this->session->userdata('timezone_hours');
        if ($roleid==6) 
        {
              $query =  $this->db->query("SELECT * FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid WHERE ao.owner_id = '".$userid."' AND v.status='1' AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(v.speed) >= '1' and v.client_id ='".$client_id."'" );

            
        }
        else
        {
              $query =  $this->db->query("SELECT * FROM vehicletbl v WHERE v.status='1' AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(v.speed) >= '1' and v.client_id ='".$client_id."'" );

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
     public function idle_vehicle()
    {
        $client_id = $this->session->userdata('client_id');
        $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');
        $timezone_hours = $this->session->userdata('timezone_hours');

        if ($roleid==6) 
        {
             $query =  $this->db->query("SELECT * FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid WHERE ao.owner_id = '".$userid."' AND v.status='1' AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(v.speed) = '0' and v.client_id ='".$client_id."'" );

        }
        else
        {
              $query =  $this->db->query("SELECT * FROM vehicletbl v WHERE  v.status='1' AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='1' and round(v.speed) = '0' and v.client_id ='".$client_id."'" );

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
     public function parking_vehicle()
    {
        $client_id = $this->session->userdata('client_id');
          $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');
        $timezone_hours = $this->session->userdata('timezone_hours');

        if ($roleid==6) 
        {
             $query =  $this->db->query("SELECT * FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid WHERE ao.owner_id = '".$userid."' AND v.status='1' AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='0'  and v.client_id ='".$client_id."'" );

        }
        else
        {
             $query =  $this->db->query("SELECT * FROM vehicletbl v WHERE v.status='1' AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on ='0'  and v.client_id ='".$client_id."'" );


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
     public function ooc_vehicle()
    {
        $client_id = $this->session->userdata('client_id');
          $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');
        $timezone_hours = $this->session->userdata('timezone_hours');

        if ($roleid==6) 
        {
            $query =  $this->db->query("SELECT * FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid WHERE ao.owner_id = '".$userid."' AND v.status='1' AND (TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' OR v.updatedon IS NULL) and v.client_id ='".$client_id."'" );
        }
        else
        {
             $query =  $this->db->query("SELECT * FROM vehicletbl v WHERE v.status='1' AND (TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' OR v.updatedon IS NULL) and v.client_id ='".$client_id."'" );
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


    public function single_vehicle_data($id)
    {
        $client_id = $this->session->userdata('client_id');
        $timezone_hours = $this->session->userdata('timezone_hours');

        $query = $this->db->query("SELECT client_id,driver_name,altitude,gpssignal,gsmsignal,mdvr_terminal_no,today_km,internal_battery_voltage,vehicle_sleep,deviceimei,angle,vehicletype,angle,vehicleid,vehiclename,lat,lng,speed,(updatedon + INTERVAL $timezone_hours MINUTE) as updatedon,TIMESTAMPDIFF(MINUTE,(updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,lat,lng,acc_on,acc_flag,acc_date_time,ac_flag,ac_date,ac_km,odometer as kilometer,odometer,litres,fuel_ltr,fuel_tank_capacity,temperature,TIME_FORMAT(TIMEDIFF(NOW(),(last_ign_off + INTERVAL $timezone_hours MINUTE)), '%H:%i:%s') as last_dur, TIME_FORMAT(TIMEDIFF(NOW(),(updatedon + INTERVAL $timezone_hours MINUTE)), '%H:%i:%s') as no_last_dur,device_config_type,device_battery,car_battery,device_type,hub_ETA,round(litres*keyword) as DTE,latlon_address,device_charge_status,remarks as hourmeter,ibutton_receiver as today_hourmeter FROM vehicletbl WHERE status='1' AND vehicleid='".$id."'");
            if ($query->num_rows() > 0)
            {

                return $query->row();
            }
            else
            {
                return false;
            }
    }
    public function geolocation_details()
    {
        $userid = $this->session->userdata('userid');
        $roleid = $this->session->userdata('roleid');
        $client_id = $this->session->userdata('client_id');
        if($roleid==8 || $userid=449)
        {
            $query = $this->db->query("SELECT * FROM location_list WHERE client_id='".$client_id."'");
        }
        else
        {
            $query = $this->db->query("SELECT * FROM location_list WHERE CreatedBy='".$userid."'");

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
    
       public function hublocation_details()
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("SELECT id,location_name FROM hubpoint_location WHERE client_id='".$client_id."'");
            if ($query->num_rows() > 0)
            {

                return $query->result();
            }
            else
            {
                return false;
            }
    }

     public function alert_type()
    {
      
        $query = $this->db->query("SELECT * FROM alert_type ");
            if ($query->num_rows() > 0)
            {

                return $query->result();
            }
            else
            {
                return false;
            }
    }
    
       public function alert_data($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $timezone_hours = $this->session->userdata('timezone_hours');
        

        $query =  $this->db->query("SELECT (ta.createdon + INTERVAL $timezone_hours MINUTE) as createdon,att.alert_type FROM sms_alert ta LEFT JOIN alert_type att ON ta.all_status = att.alert_type_id INNER JOIN vehicletbl v ON v.vehicleid = ta.vehicle_id WHERE ta.client_id = '".$client_id."' AND v.deviceimei='".$deviceimei."' ORDER BY ta.sms_alert_id DESC LIMIT 10");

            if ($query->num_rows() > 0)
            {

                return $query->result();
            }
            else
            {
                return false;
            }
    }

         public function yesterday_distanceday()
    {
        $client_id = $this->session->userdata('client_id');
        $date = date('Y-m-d',strtotime('-1 day'));

            $query = $this->db->query("SELECT DISTINCT date, SUM(distance_km) as distance_km  FROM consolidate_distance_report WHERE (date = '".$date."') AND client_id ='".$client_id."'");
               
        if ($query->num_rows() > 0) 
        {
           
            return  $query->row();
        }
        else 
        {
            return 0;
        }
    }



    public function areasplinechart($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select odometer,modified_date,speed,litres
                FROM fuel_status WHERE running_no = '".$deviceimei."' DESC LIMIT 200");
        if($query){
          if ($query->num_rows() > 0)
                {return $query->result();}              
        }else{
             return false; }
            
           
    }
    public function distancechart($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select distinct(dis.date),dis.distance_km
                FROM consolidate_distance_report as dis
                inner join vehicletbl vt on vt.deviceimei = dis.imei
                where dis.client_id ='".$client_id."' AND vt.deviceimei = '".$deviceimei."' AND dis.distance_km >0.5
                order by date desc limit 7");
            if ($query->num_rows() > 0)
                {return $query->result();}
            else{return false;}
    }
    public function parkingchart($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select distinct(pk.date),pk.parking_duration,
                CONCAT(FLOOR(parking_duration/60),'.',MOD(parking_duration,60)) As park_minitues
                FROM consolidate_park_report as pk
                inner join vehicletbl vt on vt.deviceimei = pk.imei
                where pk.client_id ='".$client_id."' AND vt.deviceimei = '".$deviceimei."'
                order by date desc limit 7");
            if ($query->num_rows() > 0)
                {return $query->result();}
            else{return false;}
    }
    public function idlechart($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select distinct(idl.date),idl.idel_duration,
            CONCAT(FLOOR(idel_duration/60),'.',MOD(idel_duration,60)) As idle_minitues
                FROM consolidate_idle_report as idl
                inner join vehicletbl vt on vt.deviceimei = idl.imei
                where idl.client_id ='".$client_id."' AND vt.deviceimei = '".$deviceimei."'
                order by date desc limit 7");
            if ($query->num_rows() > 0)
                {return $query->result();}
            else{return false;}
    }
    public function tripchart($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select distinct(trp.date),trp.moving_duration,
                CONCAT(FLOOR(moving_duration/60),'.',MOD(moving_duration,60)) As minis
                FROM consolidate_ign_report as trp
                inner join vehicletbl vt on vt.deviceimei = trp.imei
                where trp.client_id ='".$client_id."' AND vt.deviceimei = '".$deviceimei."'
                order by date desc limit 7");
            if ($query->num_rows() > 0)
                {return $query->result();}
            else{return false;}
    }
    public function track_workspace($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select distinct(trp.date),trp.moving_duration,
                CONCAT(FLOOR(moving_duration/60),'.',MOD(moving_duration,60)) As minis
                FROM consolidate_ign_report as trp
                inner join vehicletbl vt on vt.deviceimei = trp.imei
                where trp.client_id ='".$client_id."' AND vt.deviceimei = '".$deviceimei."'
                order by date desc limit 7");
            if ($query->num_rows() > 0)
                {return $query->result();}
            else{return false;}
    }
   public function executiveaccess_previledge() {
        $client_id = $this->session->userdata('client_id');
        $user_id = $this->session->userdata('userid');
        $query = $this->db->query("SELECT * FROM accesspriviledge WHERE userid='".$user_id."' AND status=1");
            if ($query->num_rows() > 0)
            {
                return $query->row();
            }
            else
            {
                return false;
            }
    }
    public function customer_complaint()
    {
         $q = $this->db->query("select cc.*,ust.firstname,sts.statusname
                FROM customer_complaint cc
                inner join usertbl ust on ust.userid = cc.userid
                inner join statustbl sts on sts.statusid = cc.status
                where cc.status=1 AND cc.msgread = 1");
           if ($q->num_rows() > 0) {
                $data1 = $q->result();
        } else {
            $data1 = null;
        }
        return $data1;
             }
           public function enginerpm_data($deviceimei)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("SELECT modified_date, value AS firstval FROM engine_rpms WHERE deviceimei='".$deviceimei."' ORDER BY id DESC LIMIT 300");
            if ($query->num_rows() > 0)
                {return $query->result();}
            else{return false;}
    }

     public function access_menu()
    {
        $client_id = $this->session->userdata('client_id');
        $user_id = $this->session->userdata('userid');

        $query = $this->db->query("SELECT * FROM accesspriviledge WHERE status='1' AND userid='".$user_id."'");
            if ($query->num_rows() > 0)
            {
                return $query->row();
            }
            else
            {
                return false;
            }
    }
    


    public function consolidate_ignday($imei,$date) 
    {   

        $client_id = $this->session->userdata['client_id'];
           
             $query = $this->db->query("SELECT DISTINCT date,moving_duration FROM consolidate_ign_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
        
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

    public function consolidate_idleday($imei,$date) 
    {   

        $client_id = $this->session->userdata['client_id'];
         
           $query = $this->db->query("SELECT DISTINCT date,idel_duration FROM consolidate_idle_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
       
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

    public function consolidate_parkday($imei,$date) 
    {   
        $client_id = $this->session->userdata['client_id'];
        
     

                $query = $this->db->query("SELECT DISTINCT date,parking_duration FROM consolidate_park_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");

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


    public function vehicle_status_count(){
    
        $role_id = $this->session->userdata['roleid'];
        $dealer_id = $this->session->userdata['dealer_id'];
        $subdealer_id = $this->session->userdata['subdealer_id'];

        if($role_id==1)
        {
            $query =  $this->db->query("SELECT (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=2 AND deviceimei !='') as deactive_vehicle_count,
            (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=1 AND deviceimei !='') as active_vehicle_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND expiredate<NOW()) as subcribe_yr_count,
            (SELECT COUNT(client_id) FROM clienttbl WHERE status=1) as total_customer_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
                AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')) as about_due");
            //expiredate < DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01')


        }
        elseif ($role_id==3) {

            $query =  $this->db->query("SELECT (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=2 AND deviceimei !='' AND dealer_id='".$dealer_id."') as deactive_vehicle_count,
            (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=1 AND deviceimei !='' AND dealer_id='".$dealer_id."') as active_vehicle_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND expiredate<NOW() AND dealer_id='".$dealer_id."') as subcribe_yr_count,
            (SELECT COUNT(client_id) FROM clienttbl WHERE status=1  AND dealer_id='".$dealer_id."') as total_customer_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND  expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
            AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59') AND dealer_id='".$dealer_id."') as about_due");
          
               // echo "hii";exit;
           
        }
        elseif ($role_id==4) {

            $query =  $this->db->query("SELECT (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=2 AND deviceimei !='' AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as deactive_vehicle_count,
            (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=1 AND deviceimei !='' AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as active_vehicle_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND expiredate<NOW() AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as subcribe_yr_count,
            (SELECT COUNT(client_id) FROM clienttbl WHERE status=1  AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as total_customer_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND  expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
            AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59') AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as about_due");
          
               // echo "hii";exit;
           
        }
       
        
        if ($query->num_rows() > 0) 
        {
            return $query->row();
        }
        else 
        {
            return FALSE;
        }
    }

    //total device count
    public function total_device_count(){

        $role_id = $this->session->userdata['roleid'];
        $dealer_id = $this->session->userdata['dealer_id'];
        $subdealer_id = $this->session->userdata['subdealer_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');

        if($role_id==1)
        {
            $query =  $this->db->query("SELECT (SELECT count(v.vehicleid) FROM vehicletbl v 
            WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0) as park_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v) as total_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(speed) = 0) as idle_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1) as move_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' OR v.updatedon IS NULL)) as nonetwork_count");
           
        }
        elseif ($role_id==3)
        {
            $query =  $this->db->query("SELECT (SELECT count(v.vehicleid) FROM vehicletbl v 
            WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0  AND dealer_id='".$dealer_id."') as park_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v WHERE dealer_id='".$dealer_id."') as total_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(speed) = 0  AND dealer_id='".$dealer_id."') as idle_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1  AND dealer_id='".$dealer_id."' ) as move_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' OR v.updatedon IS NULL)  AND dealer_id='".$dealer_id."') as nonetwork_count");

           
        }   

        elseif ($role_id==4)
        {
            $query =  $this->db->query("SELECT (SELECT count(v.vehicleid) FROM vehicletbl v 
            WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0  AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as park_count,
              (SELECT count(v.vehicleid) FROM vehicletbl v WHERE dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as total_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(speed) = 0  AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as idle_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1  AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as move_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) > '10' OR v.updatedon IS NULL)  AND dealer_id='".$dealer_id."' AND subdealer_id = '".$subdealer_id."') as nonetwork_count");
               
           
        }   
    
        if ($query->num_rows() > 0) 
        {
            return $query->row();
        }
        else 
        {
            return FALSE;
        }
    }
    
    public function tw_total_device_count(){

       
            $query =  $this->db->query("SELECT (SELECT count(v.vehicleid) FROM vehicletbl v 
            WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =0 AND v.dealer_id IS NULL ) as park_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(speed) = 0 AND v.dealer_id IS NULL) as idle_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.dealer_id IS NULL) as total_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v WHERE v.status=1 AND TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) <= '10' AND v.acc_on =1 and round(v.speed) >= 1 AND v.dealer_id IS NULL) as move_count,
            (SELECT count(v.vehicleid) FROM vehicletbl v  WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE,v.updatedon,CURRENT_TIMESTAMP) > '10' OR v.updatedon IS NULL) AND v.dealer_id IS NULL) as nonetwork_count");
           
        if ($query->num_rows() > 0) 
        {
            return $query->row();
        }
        else 
        {
            return FALSE;
        }
    }

    public function tw_vehicle_status_count(){
    
     
            $query =  $this->db->query("SELECT (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=2 AND deviceimei !='' AND dealer_id IS NULL) as deactive_vehicle_count,
            (SELECT COUNT(vehicleid) FROM `vehicletbl` WHERE status=1 AND deviceimei !='' AND dealer_id IS NULL) as active_vehicle_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND expiredate<NOW() AND dealer_id IS NULL) as subcribe_yr_count,
            (SELECT COUNT(client_id) FROM clienttbl WHERE status=1 AND dealer_id IS NULL) as total_customer_count,
            (SELECT COUNT(vehicleid) FROM vehicletbl WHERE status=1 AND expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
                AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59') AND dealer_id IS NULL) as about_due");
          
        if ($query->num_rows() > 0) 
        {
            return $query->row();
        }
        else 
        {
            return FALSE;
        }
    }

    public function vehicle_status($id){
        $dealer_id = $this->session->userdata['dealer_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');
        if($id==1){
            if($dealer_id)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehicleid,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.deviceimei !='' AND v.dealer_id = '".$dealer_id."'");
                return $query->result();        
            }
            else
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehicleid,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.deviceimei !=''");
                return $query->result();        
            }
                
        
        }
        elseif($id==2){     
            if($dealer_id)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehicleid,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=2 AND v.dealer_id = '".$dealer_id."'");
                return $query->result();
            }  
            else
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehicleid,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=2");
                return $query->result();
            }
         
      
   }
   }

    public function totaldevice($id){
        $role_id = $this->session->userdata['roleid'];
        $dealer_id = $this->session->userdata['dealer_id'];
        $subdealer_id = $this->session->userdata['subdealer_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');
        if($id==1){
          
            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v LEFT JOIN clienttbl c ON c.client_id=v.client_id");
                return $query->result();
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id AND v.dealer_id='".$dealer_id."'");
                return $query->result();
               
            }
            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                return $query->result();
               
            }
       
        }
        elseif($id==2){

            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.deviceimei !=''");
            return $query->result();   
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.deviceimei !='' AND v.dealer_id='".$dealer_id."'");
                 return $query->result();   
               
            }

            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.deviceimei !='' AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                 return $query->result();   
               
            }


                 
        }
        elseif($id==3){

            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed>=1 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10");
                return $query->result(); 
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed>=1 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id='".$dealer_id."'");
                return $query->result(); 
               
            }
            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed>=1 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                return $query->result(); 
               
            }
        }
        elseif($id==4){
            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10");
                return $query->result();
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id='".$dealer_id."'");
                return $query->result();
               
            }
            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                return $query->result();
               
            }

           
        }
        elseif($id==5){

            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10");
                return $query->result(); 
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id='".$dealer_id."'");
                return $query->result();
               
            }

            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                return $query->result();
               
            }


          
        }
        elseif($id==6){

            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)> 10 OR v.updatedon IS NULL)");
                return $query->result();
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)> 10 OR v.updatedon IS NULL) AND v.dealer_id='".$dealer_id."'");
                return $query->result();
               
            }

            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)> 10 OR v.updatedon IS NULL) AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                return $query->result();
               
            }


          
        }
        elseif($id==7){

            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=2");
                return $query->result(); 
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=2 AND v.dealer_id='".$dealer_id."'");
                return $query->result();
               
            }

            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=2 AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                return $query->result();
               
            }


           
        }
        elseif($id==8){

            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
                AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')");
                return $query->result();   
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
                AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59') AND v.dealer_id='".$dealer_id."'");
            return $query->result();   
               
            }
            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
                AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59') AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
            return $query->result();   
               
            }


           
        }
        elseif($id==9){

            if($role_id==1)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate < NOW()");
                return $query->result();   
            }
            elseif ($role_id==3)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate < NOW() AND v.dealer_id='".$dealer_id."'");
                return $query->result();   
               
            }
            elseif ($role_id==4)
            {
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate < NOW() AND v.dealer_id='".$dealer_id."' AND v.subdealer_id = '".$subdealer_id."'");
                return $query->result();   
               
            }


        }



      }

      public function tw_totaldevice($id){
       
        if($id==1){
          
          
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id AND v.dealer_id IS NULL");
                return $query->result();
           
       
        }
        elseif($id==2){

                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.deviceimei !='' AND v.dealer_id IS NULL");
                 return $query->result();   
                    
                  }
        elseif($id==3){

          
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed>=1 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id IS NULL");
                return $query->result(); 
               
        }
        elseif($id==4){
           
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=1 AND v.speed=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id IS NULL");
                return $query->result();
    
        }
        elseif($id==5){

                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.acc_on=0 AND TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)<=10 AND v.dealer_id IS NULL");
                return $query->result();
       
          
        }
        elseif($id==6){

          
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND (TIMESTAMPDIFF(MINUTE, v.updatedon,CURRENT_TIMESTAMP)> 10 OR v.updatedon IS NULL) AND v.dealer_id IS NULL");
                return $query->result();
         
          
        }
        elseif($id==7){

          
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=2 AND v.dealer_id IS NULL");
                return $query->result();
     
           
        }
        elseif($id==8){

          
                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate BETWEEN DATE_FORMAT(NOW(), '%Y-%m-%d 00:00:00')
                AND DATE_FORMAT(LAST_DAY(NOW() + INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59') AND v.dealer_id IS NULL");
            return $query->result();   
        }

        elseif($id==9){


                $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng,v.dealer_id FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE 
                v.status=1 AND  expiredate < NOW() AND v.dealer_id IS NULL");
                return $query->result();   

        }


      }

  public function fuel_graph_data($deviceimei,$fromdate,$todate)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select odometer,modified_date,speed,litres FROM fueldata_smooth WHERE running_no = '".$deviceimei."' AND modified_date BETWEEN '".$fromdate."' AND '".$todate."'");
        if($query){
          if ($query->num_rows() > 0)
                {return $query->result();}              
        }else{
             return false; }
            
           
    }

    public function Fuel_report_list($from,$to,$vehicleid)
	{
		   
		if(!empty($vehicleid))
		{
			//echo "SELECT fs.lat,fs.lng,fs.speed,fs.modified_date as datetime ,fs.litres,fs.odometer,fs.ignition FROM fuel_status fs WHERE fs.running_no = '".$vehicleid."' AND fs.flag='0' AND fs.lat!='000000000' AND fs.lng!='000000000' AND (fs.modified_date >= '".$from."' AND fs.modified_date <= '".$to."') UNION SELECT fsb.lat,fsb.lng,fsb.speed,fsb.modified_date as datetime,fsb.litres,fsb.odometer) as distance,fsb.ignition FROM fuel_status_bk fsb  WHERE fsb.running_no = '".$vehicleid."' AND fsb.flag='0' AND fsb.lat!='000000000' AND fsb.lng!='000000000' AND (fsb.modified_date >= '".$from."' AND fsb.modified_date <= '".$to."') ORDER BY datetime ASC"; exit();

		//$query1 = $this->db->query("SELECT fs.lat,fs.lng,fs.speed,fs.modified_date as modified_date ,fs.litres,round(fs.odometer) as distance,fs.ignition FROM fuel_status fs WHERE fs.running_no = '".$vehicleid."' AND fs.flag='0' AND fs.lat!='000000000' AND fs.lng!='000000000' AND (fs.modified_date >= '".$from."' AND fs.modified_date <= '".$to."') UNION SELECT fsb.lat,fsb.lng,fsb.speed,fsb.modified_date as modified_date,fsb.litres,round(fsb.odometer) as distance,fsb.ignition FROM fuel_status_bk fsb  WHERE fsb.running_no = '".$vehicleid."' AND fsb.flag='0' AND fsb.lat!='000000000' AND fsb.lng!='000000000' AND (fsb.modified_date >= '".$from."' AND fsb.modified_date <= '".$to."') ORDER BY modified_date ASC");
		
				   
			$query1 = $this->db->query("SELECT fs.lat,fs.lng,fs.speed,fs.modified_date as modified_date ,fs.litres,round(fs.odometer) as distance,fs.ignition FROM fuel_status fs WHERE fs.running_no = '".$vehicleid."' AND fs.flag='0' AND fs.lat!='000000000' AND fs.lng!='000000000' AND (fs.modified_date >= '".$from."' AND fs.modified_date <= '".$to."') ORDER BY modified_date ASC");

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
    public function Fuel_smooth_data($from,$to,$vehicleid)
	{
		   
		if(!empty($vehicleid))
		{
			//echo "SELECT lat,lng,speed,created_date,litres,ROUND(odometer) as distance,ignition FROM fuel_status WHERE running_no = '".$vehicleid."' AND flag='0' AND lat!='000000000' AND lng!='000000000' AND (modified_date >= '".$from."' AND modified_date <= '".$to."') ORDER BY modified_date ASC"; exit();
		$query1 = $this->db->query("SELECT litres,modified_date FROM fueldata_smooth WHERE running_no = '".$vehicleid."' AND flag='0' AND lat!='000000000' AND lng!='000000000' AND (modified_date >= '".$from."' AND modified_date <= '".$to."') ORDER BY modified_date ASC");
				   
		
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


    public function fuel_vehicle()
    {
        $client_id = $this->session->userdata('client_id');
        $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');

        if ($roleid==6) 
        {
             $query = $this->db->query("SELECT * FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid  WHERE ao.owner_id = '".$userid."' AND v.client_id='".$client_id."' AND (v.device_type=1 OR v.device_type=3 OR v.device_type=5 OR v.device_type=6 OR v.device_type=10 OR v.device_type=11 OR v.device_type=14)");
         
        }
        else
        {
           $query = $this->db->query("SELECT * FROM vehicletbl v WHERE v.client_id='".$client_id."' AND (v.device_type=1 OR v.device_type=3 OR v.device_type=5 OR v.device_type=6 OR v.device_type=10 OR v.device_type=11 OR v.device_type=14)");
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


    public function fuel_vehicles()
    {
        $client_id = $this->session->userdata('client_id');
        $roleid = $this->session->userdata('roleid');
        $userid = $this->session->userdata('userid');

        if ($roleid==6) 
        {
             $query = $this->db->query("SELECT * FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid  WHERE ao.owner_id = '".$userid."' AND v.client_id='".$client_id."' AND (v.device_type=2 OR v.device_type=4 OR v.device_type=6 OR v.device_type=7 OR v.device_type=12 OR v.device_type=13 OR v.device_type=14)");
         
        }
        else
        {
               $query = $this->db->query("SELECT * FROM vehicletbl WHERE client_id='".$client_id."' AND (device_type=2 OR device_type=4 OR device_type=6 OR device_type=7 OR device_type=12 OR device_type=13 OR device_type=14)");
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


    public function customer_details($id,$dealer_id){
        $roleid = $this->session->userdata('roleid');
        $dealerid = $this->session->userdata('dealer_id');
        $subdealer_id = $this->session->userdata('subdealer_id');
        if($id==null && $dealer_id==null)
        {
            if($roleid=='1')
            {
                $query = $this->db->query("SELECT c.*,d.dealer_name FROM clienttbl c LEFT JOIN dealertbl d ON d.dealer_id = c.dealer_id WHERE c.status=1");
                return $query->result();
            }
            elseif ($roleid=='3') {
              
                 
                $query = $this->db->query("SELECT c.*,d.dealer_name FROM clienttbl c LEFT JOIN dealertbl d ON d.dealer_id = c.dealer_id WHERE c.status=1 AND c.dealer_id = '".$dealerid."'");
                return $query->result();
            }

            elseif ($roleid=='4') {
              
                 
                $query = $this->db->query("SELECT c.*,d.subdealer_name FROM clienttbl c LEFT JOIN subdealertbl d ON d.subdealer_id = c.subdealer_id WHERE c.status=1 AND c.subdealer_id = '".$subdealer_id."'");
                return $query->result();
            }
          
        }
        elseif ($id==2) 
        {
            $query = $this->db->query("SELECT c.*,d.dealer_name FROM clienttbl c LEFT JOIN dealertbl d ON d.dealer_id = c.dealer_id WHERE c.status=1 AND c.dealer_id IS NULL");
            return $query->result();
        }
        else
        {
            $query = $this->db->query("SELECT c.*,d.subdealer_name as dealer_name FROM clienttbl c LEFT JOIN subdealertbl d ON d.subdealer_id = c.subdealer_id WHERE c.status=1 AND c.dealer_id=$dealer_id");
           return $query->result();
        }
       
    }
   public function dealer_count(){
       $query = $this->db->query("SELECT COUNT(*) as dealer_count FROM dealertbl");
       return $query->row();
   }
   public function dealername(){
       $query = $this->db->query("SELECT * FROM dealertbl");
       return $query->result();
   }

   public function single_dealername($dealer_id){
    $query = $this->db->query("SELECT * FROM dealertbl WHERE dealer_id=$dealer_id");
    return $query->row();
}

   public function dealervehicle_count($dealer_id){
       $query = $this->db->query("SELECT(SELECT COUNT(*) FROM clienttbl WHERE dealer_id=$dealer_id)as customercount,
       (SELECT COUNT(*) FROM vehicletbl WHERE dealer_id=$dealer_id)as vehiclecount,
       (SELECT COUNT(*) FROM vehicletbl WHERE status=1 AND dealer_id=$dealer_id)as active,
       (SELECT COUNT(*) FROM vehicletbl WHERE status=2 AND dealer_id=$dealer_id)as deactive,
       (SELECT COUNT(*) FROM vehicletbl WHERE dealer_id=$dealer_id AND TIMESTAMPDIFF(MONTH, installationdate,expiredate)<12) as nextdue");
    //    print_r($query);die;
        return $query->row();
   }
   public function dealervehicles($id,$dealer_id){
   
   if($id==2){
        $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.dealer_id=$dealer_id");
        return $query->result();
    }
   elseif($id==3){
    $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=1 AND v.dealer_id=$dealer_id");
    return $query->result();
   }
   elseif($id==4){
       $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE v.status=2 AND v.dealer_id=$dealer_id");
       return $query->result();
   }
   elseif($id==5){
       $query = $this->db->query("SELECT v.simnumber,v.vehiclename,v.deviceimei,v.installationdate,v.expiredate,v.updatedon,c.client_name,c.mobile,v.acc_on,v.speed,TIMESTAMPDIFF(MINUTE,(v.updatedon + INTERVAL $timezone_hours MINUTE),CURRENT_TIMESTAMP) AS update_time,v.lat,v.lng FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id=v.client_id WHERE TIMESTAMPDIFF(MONTH, v.installationdate,v.expiredate)<12 AND v.dealer_id=$dealer_id");
       return $query->result();
   }
   }
//    public function dealer_cus_details($id,$dealer_id){
//        if($id==1){
//        $query = $this->db->query("SELECT * FROM clienttbl WHERE status=1 AND dealer_id=$dealer_id");
//        return $query->result();
//        }
//    }
   

public function polygon_list($client_id)
{
    $roleid = $this->session->userdata('roleid');
    $userid = $this->session->userdata('userid');
    if($roleid==8)
    {
        $query = $this->db->query("SELECT polygon_points,polygon_name,polygon_color,polygon_fillcolor FROM polygon_list WHERE client_id=$client_id AND createdby=$userid");
    }
    else
    {
        $query = $this->db->query("SELECT polygon_points,polygon_name,polygon_color,polygon_fillcolor FROM polygon_list WHERE client_id='".$client_id."'");
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

public function activate($ids){
    $query = $this->db->query("UPDATE vehicletbl SET status = 1 WHERE vehicleid IN ($ids) ");
    $query2 = $this->db->query("UPDATE vehicletbl_2 SET status = 1 WHERE vehicleid IN ($ids) ");

    if($query){
        return 1;
    }
    else{
        return 0;
    }
}
public function deactivate($ids){
  $query = $this->db->query("UPDATE vehicletbl SET status = 2 WHERE vehicleid IN ($ids)");
   $query2 = $this->db->query("UPDATE vehicletbl_2 SET status = 2 WHERE vehicleid IN ($ids)");

  if($query){
      return 1;
  }
  else{
      return 0;
  }
}

public function temp_vehicles()
{
    $client_id = $this->session->userdata('client_id');
    $roleid = $this->session->userdata('roleid');
    $userid = $this->session->userdata('userid');

    if ($roleid==6) 
    {
         $query = $this->db->query("SELECT * FROM vehicletbl v INNER JOIN assign_owner ao ON ao.vehicle_id = v.vehicleid  WHERE ao.owner_id = '".$userid."' AND v.client_id='".$client_id."' AND v.device_type=9");
     
    }
    else
    {
           $query = $this->db->query("SELECT * FROM vehicletbl WHERE client_id='".$client_id."' AND device_type=8");
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



public function temp_graph_data($fromdate,$todate,$deviceimei)
{
   // $client_id = $this->session->userdata('client_id');
  //  $query = $this->db->query("select odometer,modified_date,temp_status1,humidity1 FROM temperature_status WHERE imei = '".$deviceimei."' AND modified_date BETWEEN '".$fromdate."' AND '".$todate."'");
    $query = $this->db->query("select odometer,modified_date,(temp_status1/10) as temp_status1,humidity1 FROM temperature_status WHERE imei = $deviceimei");
   
    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return false; }
        
       
}


public function consolidatedata()
{
    $client_id = $this->session->userdata('client_id');
    $userid = $this->session->userdata('userid');
    $role = $this->session->userdata('roleid');
    $from_date = date('Y-m-d',strtotime('-7 Day'));
    $to_date = date('Y-m-d');

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
    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->row();
            }              
    }else{
         return false; }
        
       
}

public function consolidatedata_json($vehicle,$from_date,$to_date)
{
    $client_id = $this->session->userdata('client_id');
    $userid = $this->session->userdata('userid');
    $role = $this->session->userdata('roleid');
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
         return false; }
       
}


public function running_high_graph($from_date,$to_date)
{
    $client_id = $this->session->userdata('client_id');
 
    $query = $this->db->query("SELECT SUM(moving_duration) as total_move,vehicle_register_number FROM consolidate_ign_report WHERE date BETWEEN '".$from_date."' AND '".$to_date."' AND client_id=$client_id GROUP BY imei ORDER BY SUM(moving_duration)");
   
    if($query){
      if ($query->num_rows() > 0)
            {
                return $query->result();
            }              
    }else{
         return false; }
        
       
}

public function vehicle_shortname($vtype_id)
{	
    
    $query=$this->db->query("SELECT vehicle_shortname FROM vehicletypetbl WHERE vtype_id=$vtype_id");
    
    if($query->num_rows() > 0)
    {
        $data =  $query->row();
         return $data->vehicle_shortname;
    }
    else
    {
        return false;
    }
}

      public function smart_distanceday($imei,$start_date,$end_date,$device_type) 
    { 

                 if($device_type=='17')
                       {
  
                    $query1 = $this->db->query("SELECT odometer FROM omni_distance_data WHERE  deviceimei = '".$imei."' AND modified_date BETWEEN '".$start_date."' AND '".$end_date."'   ORDER BY modified_date DESC LIMIT 1");

                    if ($query1->num_rows() > 0 ) 
                    {   
                          $result=$query1->result();
                          $Arr = array(
                        
                             'distance_km' =>$result[0]->odometer
                            );
                          return  $Obj = (object)$Arr;
                       
                    } 
                    else
                    {
                          $client_id = $this->session->userdata['client_id'];
                      $query1 = $this->db->query("SELECT DISTINCT SUM(distance_km) as distance_km FROM consolidate_distance_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");



                    if ($query1->num_rows() > 0 ) 
                    {   
                          $result=$query1->result();
                          $Arr = array(
                        
                             'distance_km' =>$result[0]->distance_km
                            );
                          return  $Obj = (object)$Arr;
                       
                    } 

             
                    }
                    
                       }
                       else
                       {

                        $client_id = $this->session->userdata['client_id'];
                                  
                       $playtable= "play_back_history_".$client_id;

                       $qry = $this->db->query("SHOW TABLES LIKE '" . $playtable . "'");

                       if ($qry->num_rows() > 0) 
                       {

                    $query1 = $this->db->query ("SELECT odometer,modified_date FROM play_back_history
                     WHERE running_no ='".$imei."' AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND 
                     lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND modified_date
                     BETWEEN '".$start_date."' AND '".$end_date."'  UNION SELECT odometer,modified_date FROM ".$playtable." WHERE running_no ='".$imei."' AND
                      lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND 
                      lon_message!='0.0' AND modified_date BETWEEN '".$start_date."' AND '".$end_date."'  
                      ORDER BY modified_date DESC");

                    } 
                    else
                    {
                        $query1 = $this->db->query("SELECT odometer,modified_date FROM play_back_history WHERE running_no ='".$imei."' AND lat_message!='000000000' AND lon_message!='000000000' AND lat_message!='0' AND lon_message!='0' AND lat_message!='0.0' AND lon_message!='0.0' AND modified_date BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY modified_date DESC");
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
 public function ignitiononoff($deviceimei,$fromdate,$todate)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("select dis.start_day,dis.end_day
            FROM trip_report as dis
            inner join vehicletbl vt on vt.deviceimei = dis.device_no
            where dis.client_id ='".$client_id."' AND vt.deviceimei = '".$deviceimei."'
            AND start_day BETWEEN '".$fromdate."' AND '".$todate."'");
            if ($query->num_rows() > 0)
                {return $query->result();}
            else{return false;}
    }
 public function speedchartdata($deviceimei,$fromdate,$todate)
    {
        $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("SELECT speed,modified_date FROM `play_back_history_$client_id` where running_no='".$deviceimei."' AND modified_date BETWEEN '".$fromdate."' AND '".$todate."'");
            if ($query->num_rows() > 0)
                {return $query->result_array();}
            else{return false;}
    }
}

