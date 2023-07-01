<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Class_model extends CI_Model
{	
	
	function __construct()
	{
		parent::__construct();
	}
	
        public function all_class_data()
	{
		
		$userid = $this->session->userdata['userid'];
                $client_id = $this->session->userdata ['client_id'];
		$query=$this->db->query("SELECT * FROM sch_class WHERE  status=1 AND userid=$userid AND client_id=$client_id");
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
        	
        
        public function editclassdata($id)
            { 

                $query = $this->db->query("SELECT * FROM sch_class WHERE class_id='".$id."' ");

                if ($query->num_rows() > 0)
                {
                    return $query->row();
                }
                else
                {
                    return false;
                }       
            }

            public function saveclass($data,$class_id=null)
	{
		if ($class_id==null)
		 {
				$query = $this->db->insert('sch_class',$data);
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

			$this->db->where('class_id', $class_id);        
		        $query = $this->db->update('sch_class', $data);
		                  
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
     
}
