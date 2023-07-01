<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Sim_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	public function all_sim_data()
	{
		
		$role = $this->session->userdata['roleid'];
		$dealer_id = $this->session->userdata['dealer_id'];
		$userid = $this->session->userdata['userid'];
		if ($role=='14') {

			$query=$this->db->query("SELECT * FROM simtbl WHERE  status=1 AND createdby=$userid");
		}
	
		elseif ($role=='17') {
			
			$query=$this->db->query("SELECT * FROM simtbl WHERE dealer_id ='".$dealer_id."' AND status=1");
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

	public function savesim($data,$simid=null)
	{
		if ($simid==null)
		 {

				$query = $this->db->insert('simtbl',$data);
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
		else
		{

			$this->db->where('simid', $simid);        
		        $query = $this->db->update('simtbl', $data);
		                  
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

	public function editsimdata($id)
    { 
      
        $query = $this->db->query("SELECT * FROM simtbl WHERE simid='".$id."' ");
        
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }       
    }
    
     public function dealerlist_dd(){

     	$dealer_id = $this->session->userdata['dealer_id'];
		// $subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];
		if ($role=='14') {
			
			$query = $this->db->query("select * from dealertbl where status=1");

	    }
		if ($role=='17') {
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
     public function simlist_dd(){

     	$dealer_id = $this->session->userdata['dealer_id'];
		$subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];
		if ($role=='14') {

			 $query = $this->db->query("select * from simtbl where status=1 AND (dealer_id IS NULL OR dealer_id='0') AND (subdealer_id IS NULL OR subdealer_id='0')");
		}
		if ($role=='17') {
			 $query = $this->db->query("select s.* from simtbl s where s.status=1 AND s.simnumber not in (select v.simnumber from vehicletbl_2 v) AND  s.dealer_id ='".$dealer_id."' AND (s.subdealer_id IS NULL OR s.subdealer_id='0')");

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
    public function savedealersim($data,$simid)
	{
			$this->db->where('simid', $simid);        
		        $query = $this->db->update('simtbl', $data);
		        if($query) 
		        {
		            return 1;
		        }
		        else
		        {
		            return 0;
		        }
	
	}
  
        public function dealer_sim_data()
	{
		$dealer_id = $this->session->userdata['dealer_id'];
		$subdealer_id = $this->session->userdata['subdealer_id'];
		$role = $this->session->userdata['roleid'];

		if ($role=='14') {
			
			$query=$this->db->query("select sm.*,de.dealer_company,de.dealer_name
                    from simtbl sm
                    inner join dealertbl de on de.dealer_id= sm.dealer_id WHERE sm.status='1'");
		}
		
		if ($role=='17') {

			$query=$this->db->query("select sm.*,de.subdealer_company as dealer_company,de.subdealer_name as dealer_name
                    from simtbl sm
                    inner join subdealertbl de on de.subdealer_id= sm.subdealer_id WHERE sm.dealer_id = '".$dealer_id."' AND (sm.subdealer_id IS NOT NULL OR sm.subdealer_id!='0') AND sm.status='1'");
			
			
			
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

	public function editassignsim($id)
    { 
      
        $query = $this->db->query("SELECT s.*,d.dealer_name,d.dealer_company FROM simtbl s INNER JOIN dealertbl d ON d.dealer_id = s.dealer_id WHERE s.simid='".$id."' ");
        
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }       
    }
	public function get_imei_number($imei){
		$query = $this->db->query("SELECT imeinumber FROM simtbl WHERE imeinumber = '".$imei."' ");
		$result = $query->row();
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	public function get_sim_number($sim){
		$query = $this->db->query("SELECT simnumber FROM simtbl WHERE simnumber = '".$sim."' ");
		$result = $query->row();
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
}
