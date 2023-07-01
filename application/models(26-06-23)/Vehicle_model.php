<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Vehicle_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	public function all_vehicle_data()
	{	
		$user_id = $this->session->userdata['userid'];
		$dealer_id = $this->session->userdata['dealer_id'];
		// $subdealer_id = $this->session->userdata['subdealer_id'];
		$client_id = $this->session->userdata['client_id'];
		 $role = $this->session->userdata['roleid'];
		 if($role=='15')
		 {
			$query=$this->db->query("SELECT v.*,c.client_name,c.mobile,vt.vehicletype as vtype 
			FROM vehicletbl v 
			INNER JOIN clienttbl c ON c.client_id = v.client_id 
			INNER JOIN vehicletypetbl vt ON vt.vtype_id = v.vehicletype 
			WHERE v.status=1 AND v.client_id='$client_id'");
		 }
		 elseif($role=='14' ) {
			$query=$this->db->query("SELECT v.*,c.client_name,c.mobile,vt.vehicletype as vtype FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id = v.client_id INNER JOIN vehicletypetbl vt ON vt.vtype_id = v.vehicletype WHERE v.status='1'");
		
		}
		elseif ($role=='17') {
			$query=$this->db->query("SELECT v.*,c.client_name,c.mobile,vt.vehicletype as vtype FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id = v.client_id INNER JOIN vehicletypetbl vt ON vt.vtype_id = v.vehicletype WHERE v.dealer_id = '".$dealer_id."' AND v.status='1'");
		
		}
		 else
		 {
			$query=$this->db->query("SELECT v.*,c.client_name,c.mobile,vt.vehicletype as vtype 
			FROM vehicletbl v 
			INNER JOIN clienttbl c ON c.client_id = v.client_id 
			INNER JOIN vehicletypetbl vt ON vt.vtype_id = v.vehicletype 
			WHERE v.status=1 AND v.userid=$user_id");

		 }

		//  print_r($this->db->last_query());die;
	
			
		if($query->num_rows() > 0)
		{

		 return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function vehicletype()
	{	
		
		$query=$this->db->query("SELECT vtype_id,vehicletype FROM vehicletypetbl");
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function deviceimei()
	{	
		$userid = $this->session->userdata['userid'];
		$dealer_id = $this->session->userdata['dealer_id'];
		$role = $this->session->userdata['roleid'];
        $client_id = $this->session->userdata['client_id'];
		if ($role=='14' ) {
			$query=$this->db->query("SELECT d.device_id,d.deviceimei FROM devicetbl d  WHERE d.status='1' AND d.deviceimei NOT in(select v.deviceimei from vehicletbl v WHERE v.deviceimei=d.deviceimei) AND (d.dealer_id IS NULL OR d.dealer_id='0') AND (d.subdealer_id IS NULL OR d.subdealer_id='0') ORDER BY d.device_id DESC");
		}
		elseif ($role=='17') {
			$query=$this->db->query("SELECT d.device_id,d.deviceimei FROM devicetbl d  WHERE d.status='1' AND d.deviceimei NOT in(select v.deviceimei from vehicletbl v WHERE v.deviceimei=d.deviceimei) AND d.dealer_id='".$dealer_id."' ORDER BY d.device_id DESC");
		}

		elseif ($role=='15') {

			$query=$this->db->query("SELECT v.*,c.client_name,c.mobile,vt.vehicletype as vtype FROM vehicletbl v INNER JOIN clienttbl c ON c.client_id = v.client_id INNER JOIN vehicletypetbl vt ON vt.vtype_id = v.vehicletype WHERE v.client_id = '".$client_id."' AND v.status='1'");
			
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
	public function simnumber()
	{	
		
		$dealer_id = $this->session->userdata['dealer_id'];
		// $subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];
		$userid = $this->session->userdata['userid'];
		if ($role=='14' ) {
			$query=$this->db->query("SELECT s.simid,s.simnumber FROM simtbl s WHERE s.status='1' AND s.simnumber not in (select v.simnumber from vehicletbl v ) AND (s.dealer_id IS NULL OR s.dealer_id='0') AND (s.subdealer_id IS NULL OR s.subdealer_id='0')  ORDER BY s.simid DESC");
		}
		elseif ($role=='17') {
			// echo"hi";die;
				$query=$this->db->query("SELECT s.simid,s.simnumber FROM simtbl s WHERE s.status='1' AND s.simnumber not in (select v.simnumber from vehicletbl v WHERE s.simnumber = v.simnumber) AND s.dealer_id='".$dealer_id."' ORDER BY s.simid DESC");
		}
		else
		{
			$query=$this->db->query("SELECT s.simid,s.simnumber FROM simtbl s WHERE s.status='1' AND s.simnumber not in (select v.simnumber from vehicletbl v) AND s.userid=$userid  ORDER BY s.simid DESC");
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

	public function device_types()
	{	
		
		$query=$this->db->query("SELECT sdid,devicetype FROM supportdevicetbl");
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function client_name()
	{	
		$dealer_id = $this->session->userdata['dealer_id'];
		// $subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];
        $user_id = $this->session->userdata ['userid'];
		
		if ($role=='14' ) {
			$query=$this->db->query("SELECT client_id,client_name FROM clienttbl WHERE dealer_id IS NULL OR subdealer_id IS NULL AND role_id='15' AND status='1'");
	
	    }
		elseif ($role=='17') {
				$query=$this->db->query("SELECT client_id,client_name FROM clienttbl WHERE dealer_id='".$dealer_id."' AND status = '1'");

		}
		elseif ($role=='15') {

			$query=$this->db->query("SELECT client_id,client_name FROM clienttbl WHERE  status = '1'");
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

	public function addvehicle($data)
	{
		$query = $this->db->insert('vehicletbl',$data);
		$query = $this->db->insert('vehicletbl_2',$data);
		$insert_id = $this->db->insert_id();
		if($query)
		{
			return $insert_id;
		}
		else
		{
			return 0;
		}
	}

	public function editvehicledata($vehicleid)
    { 
      
        $query = $this->db->query("SELECT * FROM vehicletbl WHERE vehicleid='".$vehicleid."' ");
        
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }       
    }

   public function updatevehicle($data,$vehicleid)
    {     
		    //update vehicletbl
		$this->db->where(array('vehicleid' => $vehicleid));
		$query = $this->db->update('vehicletbl',$data);
		// update vehicletbl_2
		$this->db->where(array('vehicleid' => $vehicleid));
		$query = $this->db->update('vehicletbl_2',$data);

        // $this->db->where('vehicleid', $vehicleid);        
        // // $query = $this->db->update('vehicletbl', $data);
        if($query) 
        {
            return 1;
        }
        else
        {
            return 0;
        }       
    }

public function deviceimeidata($id)
    { 
      
        $query = $this->db->query("SELECT deviceimei FROM devicetbl WHERE device_id='".$id."' ");
        
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
