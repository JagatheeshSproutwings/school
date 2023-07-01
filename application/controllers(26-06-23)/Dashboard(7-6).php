<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function __construct()
{
	parent:: __construct();
	if($this->session->userdata('userid')=='')
	{
		redirect('Login');
	}
    $this->load->model('Dashboardmodel');		      		
}
 


	public function index()
	{
		$vehicle_details= $this->Dashboardmodel->vehicle_details();
		$all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();

		$data['vehicle_details'] = $vehicle_details;
		$data['all_vehicle_loc'] = $all_vehicle_loc;
		$data['access_menu'] = $this->Dashboardmodel->access_menu();
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		$this->load->view('components/mainmenu');
		$this->load->view('dashboard/home',$data);
		$this->load->view('components/footer/footerscript');
	}
	public function superadmin()
	{
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		$this->load->view('components/mainmenu');
		$this->load->view('dashboard/dashboard');
		$this->load->view('components/footer/footerscript');
	}

	public function  all_vehicle_loc($v_status =null)
    {
      
         $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc($v_status);


        echo json_encode($all_vehicle_loc);
    }

	public function  allvehicle_count()
    {
      
         $allvehicle_count= $this->Dashboardmodel->allvehicle_count();


        echo json_encode($allvehicle_count);
    }
	public function current_distance_data() {

		$yesterday_distance = $this->Dashboardmodel->yesterday_distanceday();
		 
   
		   echo json_encode($yesterday_distance);
}


}
