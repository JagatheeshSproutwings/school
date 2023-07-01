<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smartreport_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }



 public function executiveaccess_details() {
         $client_id = $this->session->userdata('client_id');
        $user_id = $this->session->userdata('userid');
        $query = $this->db->query("SELECT * FROM executive_report_chk WHERE user_id='".$user_id."' AND client_id='".$client_id."' AND status=1");
            if ($query->num_rows() > 0)
            {
                return $query->row();
            }
            else
            {
                return false;
            }
    }

      public function get_all_vehicle() {
         $client_id = $this->session->userdata('client_id');
        $query = $this->db->query("SELECT vehicleid,vehiclename,deviceimei FROM vehicletbl WHERE client_id='".$client_id."'");
            if ($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
    }


    public function consolidate_distanceday($imei,$start_date,$end_date) 
    { 

        $client_id = $this->session->userdata['client_id'];

             $query = $this->db->query("SELECT DISTINCT SUM(distance_km) as distance_km, AVG(distance_km) as avg_km,count(id) as totalcount FROM consolidate_distance_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");
             

        if ($query->num_rows() > 0) 
        {
           
            return  $query->row();
        }
        else 
        {
            return 0;
        }

       
    }




    public function consolidate_ignday($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
           
        
             $query = $this->db->query("SELECT DISTINCT SUM(moving_duration) as moving_duration,AVG(moving_duration) as avg_moving_duration,count(id) as totalcount FROM consolidate_ign_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");
       

        if ($query->num_rows() > 0) 
        {
           
            return $query->row();
        }
        else 
        {
            return '-';
        }

           
    }

    public function consolidate_idleday($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
       
             $query = $this->db->query("SELECT DISTINCT SUM(idel_duration) as idel_duration,AVG(idel_duration) as avg_idel_duration, count(id) as totalcount FROM consolidate_idle_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

          
        if ($query->num_rows() > 0) 
        {
          
            return $query->row();;
        }
        else 
        {
            return '-';
        }
    }

    public function consolidate_acday($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
       
       
        $query = $this->db->query("SELECT DISTINCT SUM(running_duration) as moving_duration,AVG(running_duration) as avg_running_duration, count(id) as totalcount FROM consolidate_ac_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

          
        if ($query->num_rows() > 0) 
        {
          
            return $query->row();;
        }
        else 
        {
            return '-';
        }
    }



    public function consolidate_parkday($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];
        
        
                $query = $this->db->query("SELECT DISTINCT SUM(parking_duration) as parking_duration,AVG(parking_duration) as avg_parking_duration,COUNT(id) as totalcount FROM consolidate_park_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

       
        if ($query->num_rows() > 0) 
        {
            
            return  $query->row();
        }
        else 
        {
            return '-';
        }
    }


    public function consolidate_fuelfill($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];
        

        $query = $this->db->query("SELECT DISTINCT SUM(fuel_fill_litre) as fuel_fill_litre,AVG(fuel_fill_litre) as avg_fuel_fill_litre FROM consolidate_fuelfill_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

        if ($query->num_rows() > 0) 
        {
          
            return $query->row();
        }
        else 
        {
            return '0';
        }
     
    }

    public function consolidate_fueldip($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];

        
        $query = $this->db->query("SELECT DISTINCT SUM(fuel_dip_litre) as fuel_dip_litre,AVG(fuel_dip_litre) as avg_fuel_dip_litre FROM consolidate_fueldip_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");

        if ($query->num_rows() > 0) 
        {
            return  $query->row();
        }
        else 
        {
            return 0;
        }

    }

    public function consolidate_fuelconsumed($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];
       
        $query = $this->db->query("SELECT DISTINCT SUM(fuel_consumed_litre) as fuel_consumed_litre,AVG(fuel_consumed_litre) as avg_consume_litre,count(id) as totalcount,SUM(fuel_millege) as fuel_milege FROM consolidate_fuelcosumed_report WHERE imei = '".$imei."' AND date BETWEEN '".$start_date."' AND '".$end_date."' AND client_id ='".$client_id."'");


        if ($query->num_rows() > 0) 
        {
            return  $query->row();
        }
        else 
        {
            return 0;
        }

    }

      public function smart_distanceday($imei,$start_date,$end_date,$device_type) 
    { 

        $timezone_hours = $this->session->userdata('timezone_hours');
        if (!empty($imei)) {
                $client_id = $this->session->userdata['client_id'];       
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

     public function smart_ignday($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');   
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

    public function smart_acday($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');  
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE))) as moving_duration FROM ac_report
             WHERE device_no =$imei AND end_day !='' AND flag=2 AND  type_id=1 AND 
             TIMESTAMPDIFF(MINUTE,(start_day + INTERVAL $timezone_hours MINUTE),(end_day + INTERVAL $timezone_hours MINUTE)) > 0 AND (start_day + INTERVAL $timezone_hours MINUTE) BETWEEN '".$start_date."' AND '".$end_date."'");


       
        if ($query->num_rows() > 0) 
        {
           
            return $query->row();
        }
        else 
        {
            return '-';
        }

      
       
           
    }


    public function smart_idleday($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');  
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

    public function smart_parkday($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];
        $timezone_hours = $this->session->userdata('timezone_hours');  
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

    public function smart_normalrpm($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,start_day,end_day)) as rpm_duration FROM normal_rpm_report WHERE device_no ='".$imei."' AND end_day !='' AND flag='2' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$start_date."' AND '".$client_id."' ORDER BY start_day DESC");
                   

       
        if ($query->num_rows() > 0) 
        {
           
            return $query->row();
        }
        else 
        {
            return '-';
        }
    }

        public function smart_loadrpm($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
         
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,start_day,end_day)) as rpm_duration FROM load_rpm_report WHERE device_no ='".$imei."' AND end_day !='' AND flag='2' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$start_date."' AND '".$client_id."' ORDER BY start_day DESC");
                   

       
        if ($query->num_rows() > 0) 
        {
           
            return $query->row();
        }
        else 
        {
            return '-';
        }
    }


    public function smart_overloadrpm($imei,$start_date,$end_date) 
    {   

        $client_id = $this->session->userdata['client_id'];
         
            $query= $this->db->query("SELECT SUM(TIMESTAMPDIFF(MINUTE,start_day,end_day)) as rpm_duration FROM overload_rpm_report WHERE device_no ='".$imei."' AND end_day !='' AND flag='2' AND DATE_FORMAT(start_day, '%Y-%m-%d %H:%i') BETWEEN '".$start_date."' AND '".$client_id."' ORDER BY start_day DESC");
                   

       
        if ($query->num_rows() > 0) 
        {
           
            return $query->row();
        }
        else 
        {
            return '-';
        }
    }



    public function smart_fuelfill($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];
        
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

    public function smart_fueldip($imei,$start_date,$end_date) 
    {   
        $client_id = $this->session->userdata['client_id'];

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

    public function smart_fuelconsumed($imei,$start_date,$end_date) 
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
             public function smartAccessDetails(){
                $client_id = $this->session->userdata('client_id');
                $user_id = $this->session->userdata('userid');
                $query = $this->db->query("SELECT * FROM smart_report_chk WHERE user_id='".$user_id."' AND status=1");
                    if ($query->num_rows() > 0)
                    {
                        return $query->row();
                    }
                    else
                    {
                        return false;
                    }
             }

}
