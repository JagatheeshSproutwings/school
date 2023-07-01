<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dealer_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	public function all_dealer_data()
	{	
		$userid = $this->session->userdata['userid'];
		$role = $this->session->userdata['roleid'];
		// $dealer_id = $this->session->userdata['dealer_id'];
		if ($role=='14' || $role=='2') {

		 $query=$this->db->query('SELECT * FROM dealertbl');
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

	public function savedealer($dealer_data,$dealer_id=null)
	{
		if ($dealer_id==null) 
		{
				$query = $this->db->insert("dealertbl",$dealer_data);

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
			    $this->db->where('dealer_id', $dealer_id);       
		        $query = $this->db->update('dealertbl', $dealer_data);
		                  
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

	public function editdealer($id)
    { 
      
        $query = $this->db->query("SELECT d.dealer_color,d.dealer_id,d.dealer_name,d.dealer_company,d.dealer_email,d.dealer_mobile,d.dealer_address,d.dealer_logo,d.dealer_limit,d.dealer_subdomain,d.dealer_city,d.dealer_state,d.dealer_country,d.dealer_pincode,d.status,u.username FROM dealertbl d INNER JOIN usertbl u ON d.dealer_id = u.dealer_id WHERE d.dealer_id='".$id."'");
        
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }       
    }

    
        public function update_userdata($user_data,$dealer_id)
    {          
        $this->db->where('dealer_id', $dealer_id);  
         $this->db->where('roleid', '3');            
        $query = $this->db->update('usertbl', $user_data);
                  
        if($query) 
        {
            return 1;
        }
        else
        {
            return 0;
        }       
    }

	public function insert_userdata($user_data)
	{
		$query = $this->db->insert("usertbl",$user_data);
		
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
