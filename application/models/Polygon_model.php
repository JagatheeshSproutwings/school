<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Polygon_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	public function polygon_list()
	{
		$client_id = $this->session->userdata ['client_id'];
		$role_id = $this->session->userdata ['roleid'];
		$userid = $this->session->userdata ['userid'];
       
		if($role_id==8)
		{
			$query = $this->db->query("SELECT * FROM polygon_list  WHERE client_id=$client_id AND createdby=$userid");
		}
		else
		{
			$query = $this->db->query("SELECT * FROM polygon_list  WHERE client_id='".$client_id."'");
		}
		

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}

	public function editpolygon($id)
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT * FROM polygon_list  WHERE client_id='".$client_id."' AND polygon_id='".$id."'");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}

	public function polygon_data($id)
	{
		//$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT * FROM polygon_list  WHERE polygon_id='".$id."'");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
	}



	public function save_polygons($data,$polygon_id=null)
	{
		if($polygon_id ==null)
		{
			$query = $this->db->insert('polygon_list',$data);
			return true;
		}
		else
		{
			$this->db->where('polygon_id',$polygon_id);
			$query = $this->db->update('polygon_list',$data);
		}
	}


	  	public function insert_assign_polygon($polygon_id,$vehicle)
	{
		
		$temp = count($this->input->post('vehicle_id'));// count total description
		
		$vehicle =	$this->input->post('vehicle_id');			

		$client_id = $this->session->userdata['client_id'];	
		
		
		
		for($i=0; $i<$temp;$i++){
			
   			$data = array(
           		'polygon_id' => $polygon_id,
            	'vehicle_id' => $vehicle[$i],
				'createdby' => $this->session->userdata['userid'],
				'createdon' => date('Y-m-d H:i:s'),
				'client_id' => $client_id,
				'status' => 1
            );
			
        	$query = $this->db->insert('assign_polygon',$data);
  		}
		
		if($query){
			
			return TRUE;
			
		}else{
		
			return FALSE;
			
		}
	}

	
	public function assign_polygon()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT v.vehiclename,ap.status,p.polygon_name,ap.id FROM assign_polygon ap INNER JOIN vehicletbl_2 v ON v.vehicleid=ap.vehicle_id INNER JOIN polygon_list p ON ap.polygon_id =p.polygon_id  WHERE ap.client_id='".$client_id."'");

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}



	public function check_polygon()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("SELECT v.vehiclename,ap.status,p.polygon_name,ap.id,ap.in_datetime,ap.out_datetime FROM check_polygonlist ap INNER JOIN vehicletbl_2 v ON v.vehicleid=ap.vehicle_id INNER JOIN polygon_list p ON ap.polygon_id =p.polygon_id  WHERE ap.client_id='".$client_id."'");

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
	}




  
}
