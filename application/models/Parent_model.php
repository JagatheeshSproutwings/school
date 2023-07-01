<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_model extends CI_Model
{	
	
	function __construct()
	{
		parent::__construct();
	}
	
         public function all_parent_data()
	{
		
		$userid = $this->session->userdata['userid'];
                $client_id = $this->session->userdata ['client_id'];
		$query=$this->db->query("select * from usertbl p where p.client_id=$client_id AND p.roleid=16");
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
         public function saveparent($data,$parent_id=null)
	{
		if ($parent_id==null)
		 {
				$query = $this->db->insert('usertbl',$data);
				$insert_id = $this->db->insert_id();
				if($query)
                                    { return $insert_id; }
				else
                                    { return 0; }
		}
		else
		{
			$this->db->where('userid', $parent_id);        
		        $query = $this->db->update('usertbl', $data);		                  
		        if($query) 
                            {return 1; }
		        else
                            {return 0; }
		}
	
	}
        
         public function editparentdata($id)
            { 
                $query = $this->db->query("SELECT * FROM usertbl WHERE userid='".$id."' ");
                if ($query->num_rows() > 0)
                    {return $query->row();}
                else 
                    {return false;}       
            }
        
        
        
        
        
        
	// SCHOOL DETAILS
	public function save_parent($data,$id)
	{

		if($id==null)
		{
	     $data['createdby'] = $this->session->userdata ['user_id'];
	     $data['createdon'] = date('Y-m-d H:i:s');
	     $secondary_password ="twings@zxc";
	     $data['secondarypassword'] =md5($secondary_password);
	     $data['clienttype'] ='school';
		 $data['roleid'] =16;
			
			$query1 = $this->db->insert('usertbl',$data);
			

		}
		else
		{
		
			$id=$this->db->where('userid',$id);
			$query2 = $this->db->update('usertbl',$data);
			
		}
		    if ($query1) 
		{
			return '1';
		}
		else if($query2) 
		{
			return '2';
		}
  
	}
	 public function edit_parent_data($id)
	 {
	 	$client_id = $this->session->userdata ['client_id'];
	 	$query = $this->db->query("select * from usertbl where userid='$id'");
	 	

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}

	 }

	 public function user_data($id) 
	{	
			
		$query = $this->db->query("SELECT u.*,r.role,r.roles FROM user u INNER JOIN roles r ON r.role_id = u.role_id WHERE u.activecode = 1 AND parent_id=".$id);
		
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		}
		else 
		{
			return false;
		}
	}
}
