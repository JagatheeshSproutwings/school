<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Section_model extends CI_Model
{	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// SCHOOL DETAILS
	public function section_details()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select sec.*,s.client_name,c.class_name 
                            from sch_section sec 
                            inner join clienttbl s on s.client_id = sec.client_id 
                            inner join sch_class c on c.class_id = sec.class_id 
                            where sec.client_id='".$client_id."'");		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function client_names()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select client_id,client_name from clients where client_id='".$client_id."'");
		if($query)
                    { return $query->result(); }
		else
                    { return false; }
	}

	public function class_names()
	{
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select class_id,class_name from sch_class where client_id='".$client_id."'");

		if($query)
                    { return $query->result(); }
		else
                    { return false; }
	}
        
        
        public function savesection($data,$section_id=null)
	{
		if ($section_id==null)
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
			$this->db->where('section_id', $section_id);        
		        $query = $this->db->update('sch_section', $data);		                  
		        if($query) 
                            {return 1; }
		        else
                            {return 0; }
		}
	
	}
        
          public function editsectiondata($id)
            { 
                $query = $this->db->query("select sec.*,s.client_name,c.class_name 
                    from sch_section sec 
                    inner join clienttbl s on s.client_id = sec.client_id 
                    inner join sch_class c on c.class_id = sec.class_id 
                    WHERE sec.section_id='".$id."' ");
                if ($query->num_rows() > 0)
                    {return $query->row();}
                else 
                    {return false;}       
            }
        
        
        

	// EDIT DATA
	public function edit_section_data($section_id)
	{
		
		$client_id = $this->session->userdata ['client_id'];
		$query = $this->db->query("select * from sch_section where section_id = '".$section_id."' and client_id='".$client_id."' ");

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	// SAVE SCHOOL
	public function save_section_data($section_data,$section_id)
	{
		if($section_id == '')
		{
			$query = $this->db->insert('sch_section',$section_data);
		}
		else
		{
			$this->db->where('section_id',$section_id);
			$query = $this->db->update('sch_section',$section_data);
		}
	}

	public function delete_section_data($id)
	{
		$client_id = $this->session->userdata ['client_id'];
    	$query = $this->db->query("delete from sch_section where section_id = '".$id."' and client_id='".$client_id."' ");
		
    	if($query)
    	{
			return '1';
    	}
    	else
    	{
    		return false;
    	}
	}
}
