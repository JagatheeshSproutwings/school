<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Statuscheck_model extends CI_model
{

    function __construct()
	{
		parent::__construct();
	}

    public function status_checking($imei){
    
        $result = $this->db->query("SELECT * FROM new_location_history WHERE running_no='$imei' ORDER BY modified_date DESC LIMIT 50")->result();
       
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

}

?>