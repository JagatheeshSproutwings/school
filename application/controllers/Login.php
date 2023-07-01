<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Login extends MY_Controller {
	public function __construct()
	{
    parent :: __construct();
    $this->load->model('login_model');
    $this->load->model('Parent_model');
	date_default_timezone_set('Asia/Kolkata');
	}
	
	public function index()
	{
	
		$subdomain= $_SERVER['HTTP_HOST'];
		$result = $this->login_model->dealer_logo_details($subdomain);
		$user_data['dealer_details_l'] = $result;
		
		$data['title'] = "Login";
		  $this->load->view('login',$user_data);
	}
	
	/*User login function*/
	
	public function login()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username','User_name','trim|required|min_length[2]|max_length[255]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[2]|max_length[255]');
		
		if($this->form_validation->run() == TRUE)
		{		
		
			$subdomain= $_SERVER['HTTP_HOST'];
			$result = $this->login_model->dealer_logo_details($subdomain);
		    $data['dealer_details_l'] = $result;
			$query = $this->login_model->validate();
				
				if($query) //if user's credentials validated...
				{	
					 $username = $this->input->post('username');					
					 $password = $this->input->post('password');				
					 $result = $this->login_model->check_user($username,$password);
					//   print_r($result);die;
					 $dealer_id = $result[0]->dealer_id;
					 $subdealer_id = $result[0]->subdealer_id;
					 $dealer_details = $this->login_model->dealer_details($dealer_id);
					 $client_id = $result[0]->client_id;
					 if($result[0]->roleid ==15 )
					 $gettimezone_data = $this->login_model->gettimezone_data($client_id);
					//  print_r($gettimezone_data);die;		
					 if ($result != false) {						
						$data =array(
								'username' => $this->input->post('username'),
								'userid' => $result[0]->userid,
								'email' => $result[0]->email,
								'firstname' => $result[0]->firstname,
								'client_id' => $result[0]->client_id,
								'roleid' => $result[0]->roleid,
								'dealer_id'=>$result[0]->dealer_id,
								'dealer_company' =>$dealer_details->dealer_company,
                                'dealer_logo' =>$dealer_details->dealer_logo,
                                'dealer_color' =>$dealer_details->dealer_color,
                                'dealer_subdomain' =>$dealer_details->dealer_subdomain,
								'time_zone' =>$result[0]->time_zone,
								'timezone_hours' => $gettimezone_data->timezone_mins
						);
						$this->session->set_userdata($data);	
						if($result[0]->roleid==15)
						{	
							redirect('dashboard/');
						}
						
						else if($result[0]->roleid == 14)
						{
							redirect('dashboard/');
						}

						else if($result[0]->roleid == 17)
						{
						//   echo"Hii";die;
							redirect('dashboard/');
						}
						
						else
						{
							$this->session->set_flashdata('msg','<span id="successMessage">No user data..!</span>');
							$this->load->view('login',$data);
						}
					}
				}
				else
				{	
		 			$this->session->set_flashdata('msg','<span id="successMessage">Invalid user data..!</span>');
					$this->load->view('login',$data);
				}		
		 }
		 else
		 {		
		 	 $this->session->set_flashdata('msg','<span id="successMessage">Invalid user info..!</span>');
			 redirect('login', 'refresh',$data);
		 }
		
	}
	
	
	// Logout from admin page
	public function logout() 
	{		
		// Removing session data
		$session_array = array(
		'user_id' => '',
		'username' => '',
		'name' => '',
		'email' => '',
		'client_id' => '',
		'role' => '',
		'time_zone' => ''
		);
         	$this->load->library('session');
			$this->session->unset_userdata($session_array);
			$this->session->sess_destroy($session_array);
			redirect('login/');
		
	}
	
}