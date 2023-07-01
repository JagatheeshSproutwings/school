<?php
defined('BASEPATH') or exit('no direct script access allowed');
class Device_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function devicelist()
    {
        
		$userid = $this->session->userdata['userid'];
		$role = $this->session->userdata['roleid'];
		$dealer_id = $this->session->userdata['dealer_id'];

		if ($role=='14') {

			$query=$this->db->query("SELECT d.deviceimei,d.device_categary,d.sensor_name,d.status,d.device_id,dt.device_name FROM devicetbl d INNER JOIN device_model dt ON d.device_model =dt.device_name WHERE  d.status =1 AND d.userid=$userid");
		}
	
		elseif ($role=='17') {
	
			$query = $this->db->query("SELECT d.deviceimei,d.device_categary,d.sensor_name,d.status,d.device_id,dt.device_name FROM devicetbl d INNER JOIN device_model dt ON d.device_model =dt.device_name WHERE d.dealer_id ='".$dealer_id."' AND d.status =1");
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

    public function savedevice($data,$device_id=null)
    {
    	if ($device_id==null) 
    	{
		    	$query = $this->db->insert('devicetbl',$data);
		    	if ($query) {

		    		return 1;
		    	}
		    	else
		    	{
		    		return 0;
		    	}
    	}
    	else
    	{
		    		   $this->db->where('device_id', $device_id);		   
					   $query = $this->db->update('devicetbl', $data);
					
		       
		        if($query) 
				{
					return '1';
				}
				else
				{
					return '0';
				}

    	}
     	


 
    }

   

 

    public function editdevicedata($id)
    {

        $query = $this->db->query("SELECT * FROM devicetbl WHERE device_id='".$id."'");

        if ($query->num_rows() > 0)
            {

                return $query->row();
            }
            else
            {
                return false;
            }
            
        
    }

public function deletedevice($id)
	{		
		//echo "$thisid";exit;
		$this -> db -> where('did',$id);
  		$query = $this -> db -> delete('devicetbl');
		
		if ($query) 
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}

	 public function devicemodels()
    {
        
    	$query = $this->db->query('SELECT device_name FROM device_model');
            if ($query->num_rows() > 0)
            {

                return $query->result();
            }
            else
            {
                return false;
            }
      

    }

 public function dealer_device_data()
	{

		$dealer_id = $this->session->userdata['dealer_id'];
		// $subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];

		if ($role=='14') {
			
			$query=$this->db->query("select sm.*,de.dealer_company,de.dealer_name,dm.device_name
                    from devicetbl sm
                    inner join dealertbl de on de.dealer_id= sm.dealer_id inner join device_model dm ON dm.device_name = sm.device_model WHERE sm.status='1'");
		}
		
		elseif ($role=='17') {

			$query=$this->db->query("select sm.*,de.subdealer_company as dealer_company,de.subdealer_name as dealer_name,dm.device_name
                    from devicetbl sm 
                    inner join subdealertbl de on de.subdealer_id= sm.subdealer_id 
                    inner join device_model dm ON dm.device_name = sm.device_model 
                    WHERE  sm.dealer_id = '".$dealer_id."' AND (sm.subdealer_id IS NOT NULL OR sm.subdealer_id!='0') AND sm.status='1'");
			
			
			
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

     public function dealerlist(){

        $dealer_id = $this->session->userdata['dealer_id'];
		// $subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];
		if ($role=='14') {
			
			  $query = $this->db->query("select * from dealertbl where status=1");

		}
		elseif ($role=='17') {
			$query = $this->db->query("select * from subdealertbl where status=1");
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


 public function assigndevicelist(){

     	$dealer_id = $this->session->userdata['dealer_id'];
		// $subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];
		if ($role=='14') {

			 $query = $this->db->query("select sm.*,dm.device_name from devicetbl sm inner join device_model dm ON dm.device_name = sm.device_model where sm.status=1 AND (sm.dealer_id IS NULL OR sm.dealer_id='0')AND (sm.subdealer_id IS NULL OR sm.subdealer_id='0') AND sm.device_categary!='3'");
		}
		elseif ($role=='17') {

			 $query = $this->db->query("select sm.*,dm.device_name from devicetbl sm inner join device_model dm ON dm.device_name = sm.device_model where sm.status=1 AND sm.deviceimei NOT in(select v.deviceimei from vehicletbl v WHERE v.deviceimei=sm.deviceimei) AND (sm.subdealer_id IS NULL OR sm.subdealer_id='0') AND sm.device_categary!='3' AND sm.dealer_id='".$dealer_id."'");
		
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

    public function get_imei_number($imei){
		$query = $this->db->query("SELECT deviceimei FROM devicetbl WHERE deviceimei = '".$imei."' ");
		$result = $query->row();
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
}

