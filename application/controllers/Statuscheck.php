<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Statuscheck extends CI_Controller{

public function __construct()
{
    parent :: __construct();
    $this->load->model('statuscheck_model');
    
}

public function index()
{
$this->checkot();
}

public function checkot()
{
    $imei = $this->input->post('imei');
    $result['data'] = $this->statuscheck_model->status_checking($imei);
    $result['imei'] = $imei;
    // echo"<pre>";
    // print_r($result);die;
   
    $this->load->view('components/header/headerscript');
	$this->load->view('components/header/headernavbar',$result);
	$this->load->view('components/mainmenu',$result);
    $this->load->view('Dashboard/locationstatus',$result);
	$this->load->view('components/footer/footerscript');
	$this->load->view('components/footer/footer');
    
}







}
 




?>