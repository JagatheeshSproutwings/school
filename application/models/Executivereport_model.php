<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Executivereport_model extends CI_Model {

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


    public function consolidate_distanceday($imei,$date,$device_type) 
    { 

        $client_id = $this->session->userdata['client_id'];
      
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



    public function consolidate_acday($imei,$date) 
    {   

             $client_id = $this->session->userdata['client_id'];

             $query = $this->db->query("SELECT DISTINCT date,running_duration as moving_duration FROM consolidate_ac_report WHERE (imei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");
       
       
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

 public function consolidate_allrpmday($imei,$date) 
    {   

        $client_id = $this->session->userdata['client_id'];
     
        
             $query = $this->db->query("SELECT DISTINCT date,normal_rpm,idle_rpm,milege,under_load FROM consolidate_rpm_report WHERE (deviceimei = '".$imei."' AND date = '".$date."') AND client_id ='".$client_id."'");

         
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

    public function consolidate_fuelfill($imei,$date) 
    {   
         $client_id = $this->session->userdata['client_id'];
      

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

    public function consolidate_fueldip($imei,$date) 
    {   
        $client_id = $this->session->userdata['client_id'];

   

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

    public function consolidate_fuelconsumed($imei,$date) 
    {   
        $client_id = $this->session->userdata['client_id'];

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
