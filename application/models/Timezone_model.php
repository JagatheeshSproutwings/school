<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Timezone_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

    public function timezone_data()
    {
        $query = $this->db->query("SELECT * FROM time_zone");

        if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			false;
		}
    }

    public function add_timezone($timezone_data,$id=null)
    {
        if($id==NULL){
        $query = $this->db->insert('time_zone',$timezone_data);
         
         return 1;
        }else{
        $this->db->where('timezone_id', $id);        
        $query = $this->db->update('time_zone',$timezone_data);	
        return 2;
        }
    }





    public function edit_timezone($id)
    {
        $query = $this->db->query("SELECT * FROM time_zone WHERE timezone_id =  $id");

        if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			false;
		}
        
    }

    public function client_timezone_details()
    {
        $query = $this->db->query("SELECT timezone_id,timezone_name FROM time_zone");

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
?>