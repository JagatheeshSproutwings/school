<?php
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->set_timezone();
    }

    public function set_timezone() {

     //   echo '<pre>'; print_r($this->session->userdata('time_zone'));exit;
        if ($this->session->userdata('userid')) {

           if($this->session->userdata('time_zone')==1){
            date_default_timezone_set('Asia/Kolkata');
            $this->db->query("SET time_zone='+5:30'");
           }else{
            date_default_timezone_set("Asia/qatar");
            $this->db->query("SET time_zone='+3:00'");
           }
    
        }
    }
}