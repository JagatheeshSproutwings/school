<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Client_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	public function all_client_data() { 
        $user_id = $this->session->userdata ['userid'];
		$client_id = $this->session->userdata ['client_id'];
		$dealer_id = $this->session->userdata['dealer_id'];
		$role = $this->session->userdata['roleid'];
		if ($role=='14') {
		$query = $this->db->query ("SELECT c.*,u.username 
                                    FROM clienttbl c 
                                    INNER JOIN usertbl u ON u.client_id = c.client_id 
                                    WHERE c.dealer_id IS NULL AND c.subdealer_id IS NULL AND u.roleid=15");
       }elseif($role=='17') {
        $query=$this->db->query("SELECT c.*,u.username FROM clienttbl c INNER JOIN usertbl u ON u.client_id=c.client_id WHERE c.dealer_id ='".$dealer_id."' AND (c.subdealer_id =0 OR c.subdealer_id IS NULL) AND c.status=1");
       }
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return false;
		}
	}
	public function saveclient($client_data,$client_id=null)
	{
		if ($client_id==null) 
		{
			
			$query = $this->db->insert("clienttbl",$client_data);

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
       
	        $this->db->where('client_id', $client_id);        
	        $query = $this->db->update('clienttbl', $client_data);
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
		
	
	

	public function editclient($id)
    { 
      
        $query = $this->db->query("SELECT c.logo_path,c.company_name,c.client_name,c.email,c.mobile,c.alter_mobile,c.address,c.client_limit,c.city,c.state,c.country,c.pincode,c.client_id,c.status,u.username 
                FROM clienttbl c 
                INNER JOIN usertbl u ON u.client_id = c.client_id  
                WHERE  u.roleid='15' AND c.client_id='".$id."'");
        
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }       
    }


    public function update_userdata($user_data,$client_id)
    {          
        $this->db->where('client_id', $client_id);   
		$this->db->where('roleid',15);        
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


}
