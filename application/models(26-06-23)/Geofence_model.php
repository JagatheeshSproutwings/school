<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Geofence_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	public function all_geofence_data()
	{	
		   $client_id = $this->session->userdata('client_id');
		   $user_id = $this->session->userdata('userid');
		$query=$this->db->query("SELECT * FROM sch_location_list WHERE CreatedBy ='".$user_id."' ");
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
   public function edit_assign_geofence($id){
	   $this->db->select('*');
	   $this->db->from('sch_assign_geo_fenceing');
	   $this->db->where('id',$id);
	   $query = $this->db->get();
	   $result = $query->row();
	   if($result){
		   return $result;
	   }
	   else{
		   return false;
	   }
   }
	public function vehicle_list()
    { 
      	 $client_id = $this->session->userdata('client_id');
      	  $user_id = $this->session->userdata('userid');
      	 $role = $this->session->userdata('roleid');
      	 if($role==6)
      	 {
      	 	  $query = $this->db->query("SELECT vehicleid,vehiclename FROM  assign_owner ao INNER JOIN vehicletbl v ON v.vehicleid = ao.vehicle_id WHERE ao.owner_id='".$user_id."' AND v.client_id='".$client_id."' ");
      	 	//  echo "SELECT vehicleid,vehiclename FROM  assign_owner ao INNER JOIN vehicletbl v ON v.vehicleid = ao.vehicle_id WHERE ao.owner_id='".$user_id."' AND v.client_id='".$client_id."'";exit;
      	 	
      	 }
      	 else
      	 {
      	 	  $query = $this->db->query("SELECT vehicleid,vehiclename FROM vehicletbl WHERE client_id='".$client_id."' ");
        
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

	public function savegeofence($data,$Location_Id=null)
	{
		if ($Location_Id==null) {
			
					$query = $this->db->insert('sch_location_list',$data);

					if($query)
					{
						return 1;
					}
					else
					{
						return 0;
					}
		}
		else
		{
				    $this->db->where('Location_Id', $Location_Id);        
			        $query = $this->db->update('sch_location_list', $data);
			                  
			        if($query) 
			        {
			            return 1;
			        }
			        else
			        {
			            return 0;
			        }   

					}
				
	}

	public function editgeofencedata($location_id)
    { 
      	
        $query = $this->db->query("SELECT * FROM sch_location_list WHERE Location_Id='".$location_id."' ");
        
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }       
    }


	public function assign_geofence()
    { 
      	 $client_id = $this->session->userdata('client_id');
      	  $user_id = $this->session->userdata('userid');
      	 $role = $this->session->userdata('roleid');
      
			$query = $this->db->query("SELECT af.id,ll.Location_short_name,v.vehiclename FROM sch_assign_geo_fenceing af INNER JOIN sch_location_list ll ON ll.Location_Id = af.geo_location_id INNER JOIN vehicletbl v ON v.vehicleid = af.vehicle_id WHERE af.client_id='".$client_id."' ");
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }       
    }




    	public function insert_assign_category($geo_location,$vehicle)
	{
		
		$temp = count($this->input->post('vehicle_id'));// count total description
		
		$vehicle =	$this->input->post('vehicle_id');			

		$client_id = $this->session->userdata['client_id'];	
		
		
		
		for($i=0; $i<$temp;$i++){
			
   			$data = array(
           		'geo_location_id' => $geo_location,
            	'vehicle_id' => $vehicle[$i],
				'created_by' => $this->session->userdata['userid'],
				'created_datetime' => date('Y-m-d H:i:s'),
				'client_id' => $client_id,
				'activecode' => 1
            );
			
        	$query = $this->db->insert('sch_assign_geo_fenceing',$data);
  		}
		
		if($query){
			
			return TRUE;
			
		}else{
		
			return FALSE;
			
		}
	}


  
}
