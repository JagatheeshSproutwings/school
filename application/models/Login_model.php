<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{	
	function validate()
	{			
		$user_name = $this->input->post('username');
		$password = $this->input->post('password');
		$sql = "select * from usertbl where username = '".$user_name."' and (password = '" .md5($password). "' or secondarypassword='" .md5($password). "') and roleid !='16' AND status = '1'";
		
        $query = $this->db->query($sql);
		if($query->num_rows() == 1) //if user credentials are validated...
		{	
			return true;
		}		
	}
	
	// Read data from database to show data in admin page
    
	public function check_user($username,$password) 
	{
		

		 $query = $this->db->query("select ur.* from usertbl ur  where ur.username = '".$username."' and (ur.password = '" .md5($password). "' or ur.secondarypassword='" .md5($password). "') and ur.status = '1'");
		
		if ($query->num_rows() == 1) 
		{
			return $query->result();
		}
		else 
		{
			return false;
		}
	}
	public function gettimezone_data($client_id) 
	{
		 $query = $this->db->query("SELECT t.timezone_id as time_zone,t.timezone_name,t.timezone_mins FROM clienttbl c INNER JOIN time_zone t ON t.timezone_id =c.time_zone WHERE c.client_id=$client_id");	
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
	

	public function logout_user($data) ////when repon the trip crm that time call on this function with delete row for assign_table
	{
		$user_id = $this->session->userdata['user_id'];

		$this->db->where('user_id',$user_id);

		$result = $this->db->update('user', $data);

		if($result)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}

	public function all_data() ////when repon the trip crm that time call on this function with delete row for assign_table
	{
		
		$query = $this->db->query("SELECT * FROM zigma_plantrip_report ");
		
		if($query)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
		
	}

	public function loc_duration($location) ////when repon the trip crm that time call on this function with delete row for assign_table
	{
		
		$query = $this->db->query("SELECT time_duration FROM location_duration WHERE geolocation='".$location."' ");
		
		if($query)
		{
			$data =  $query->row();
			return $data->time_duration;
		}
		else
		{
			return FALSE;
		}
		
	}

	public function dealer_details($dealer_id)
    {
    	   $query = "SELECT * FROM dealertbl d WHERE dealer_id = '".$dealer_id."'";
            $result = $this->db
                ->query($query);

            if ($result->num_rows() > 0)
            {

                return $result->row();
            }
            else
            {
                return 0;
            }
    }

	public function dealer_logo_details($subdomain)
	{
		   $query = "SELECT * FROM dealertbl  WHERE dealer_subdomain  = '".$subdomain."'";
			$result = $this->db
				->query($query);
	
			if ($result->num_rows() > 0)
			{
	
				return $result->row();
			}
			else
			{
				return 0;
			}
	}

	
}
