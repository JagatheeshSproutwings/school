<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Smssend_model extends CI_model
{
   function __construct()
	{
		parent::__construct();
	}

	 public function userlist_dd(){
           $q = $this->db->query("SELECT * from usertbl
                        WHERE status=1");
            if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                $data1[] = $row;
            }
            return $data1;
        }
        else {
                  return array();
              }
        
    }
	 public function webnotification(){
           $q = $this->db->query("select sms.*,usetb.firstname,usetb.companyname
                        from smswebnotification sms
                        inner join usertbl usetb on usetb.userid = sms.userid
                        where usetb.status = 1 AND sms.status=1");
           if ($q->num_rows() > 0) {
                $data1 = $q->result();
        } else {
            $data1 = null;
        }
        return $data1;
             }
    


}
