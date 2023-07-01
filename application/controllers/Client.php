<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Client extends MY_Controller
{
	public function __construct()
	{
	parent::__construct ();	
		if($this->session->userdata['userid'] == '')
		{
			$this->index1();
		}
		$this->load->model('client_model');
		$this->load->model('Dashboardmodel');		
    $this->load->model('Smssend_model');
    $this->load->model ('Timezone_model');
		
	}

	public function index1()
	{
		redirect('login/');
	}

	public function index()
	{
		$this->clientdetails();		
	}

	public function clientdetails()
	{	
		$data['title']="Dealer";
		$data['menu']="Management";
		$data['menuItem']='dealer';
		$clientdetails = $this->client_model->all_client_data();
    $timezone_c = $this->Timezone_model->client_timezone_details();
    $data['timezonelist']=$timezone_c;
    $data['clientlist']=$clientdetails;
    $customercomplaint= $this->Dashboardmodel->customer_complaint();
    $data['customercomplaint'] = $customercomplaint;
    $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
    $headerdata['customercomplaint'] = $customercomplaint;
		if($clientdetails)
		{

      $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('client/client',$data);
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}else
		{	
			$this->session->set_flashdata('msg-sim','<span class="alert-msg msg-danger">No Data..!</span>');
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
      $this->load->view('client/client',$data);
      $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
	}

   public function saveclient()
   {  
        $client_id = $this->input->post('client_id');
        $dealer_id =$this->session->userdata('dealer_id');
        $ip = $this->input->ip_address();
        if ($client_id =='') {                 // ADD Client Details
                   $client_data = array('company_name' =>$this->input->post('company_name'),
                   'client_name' =>$this->input->post('client_name'),
                   'email' =>$this->input->post('email'),
                   'mobile' =>$this->input->post('mobile'),
                   'alter_mobile' =>$this->input->post('alter_mobile'),
                   'address' =>$this->input->post('address'),
                   'client_limit' =>50,
                   'role_id' =>'15',
                   'dealer_id' =>$dealer_id,
                   'user_id' =>$this->session->userdata('userid'),
                   'city' =>$this->input->post('city'),
                   'state' =>$this->input->post('state'),
                   'country' =>$this->input->post('country'),
                    'pincode' =>$this->input->post('pincode'),
                   'createdon' =>date('Y-m-d H:i:s'),
                   'createdby' =>$this->session->userdata('userid'),
                   'status' =>$this->input->post('status'),
                   'ipaddress' =>$ip,
                   'time_zone' =>$this->input->post('timezone_id')
                     );


        $insert_id = $this->client_model->saveclient($client_data);
// ADD User Details
        $secondarypassword = md5("twings@zxc");
          $user_data = array('username' =>$this->input->post('username'),
                   'password' =>md5($this->input->post('password')),
                   'secondarypassword' =>$secondarypassword,
                   'firstname' =>$this->input->post('client_name'),
                   'companyname' =>$this->input->post('company_name'),
                   'clienttype' =>'School',
                   'client_id' =>$insert_id,
                   'roleid' =>'15',
                   'dealer_id' =>$dealer_id,
                   'email' =>$this->input->post('email'),
                    'mobilenumber' =>$this->input->post('mobile'),
                   'postaladdres' =>$this->input->post('address'),
                   'city' =>$this->input->post('city'),
                   'state' =>$this->input->post('state'),
                   'country' =>$this->input->post('country'),
                   'pincode' =>$this->input->post('pincode'),
                   'createdon' =>date('Y-m-d H:i:s'),
                   'createdby' =>$this->session->userdata('userid'),
                   'status' =>$this->input->post('status'),
                   'ipaddress' =>$ip,
                   'time_zone' =>$this->input->post('timezone_id')
                     );
                     

      $insert_userdata = $this->client_model->insert_userdata($user_data);

      $last_user_data = $this->db->query("SELECT userid,client_id FROM usertbl WHERE userid = '".$insert_userdata."'");
      $last_data = $last_user_data->row();
    
    $exe_data = array('user_id' =>$last_data->userid,
                     'client_id' =>$last_data->client_id );

        $this->db->insert('executive_report_chk',$exe_data);

      echo json_encode($insert_userdata);
          
        }
        else
        {
					$client_id = $this->input->post('client_id');
            $client_data = array(
                    'company_name' =>$this->input->post('company_name'),
                    'client_name' =>$this->input->post('client_name'),
                   'email' =>$this->input->post('email'),
                   'mobile' =>$this->input->post('mobile'),
                   'alter_mobile' =>$this->input->post('alter_mobile'),
                   'address' =>$this->input->post('address'),
                   'client_limit' =>50,
                   'user_id' =>$this->session->userdata('userid'),
                   'dealer_id' =>$dealer_id,
                    'role_id' =>'15',
                   'city' =>$this->input->post('city'),
                   'state' =>$this->input->post('state'),
                   'country' =>$this->input->post('country'),
                    'pincode' =>$this->input->post('pincode'),
                   'updatedon' =>date('Y-m-d H:i:s'),
                   'updatedby' =>$this->session->userdata('userid'),
                   'ipaddress' =>$ip,
                   'status' =>$this->input->post('status'),
                   'time_zone' =>$this->input->post('timezone_id')
                     );
 
         $update_client= $this->client_model->saveclient($client_data,$client_id);                                         
         

          $user_data = array('username' =>$this->input->post('username'),
                   'password' =>md5($this->input->post('password')),
                   'firstname' =>$this->input->post('client_name'),
                   'companyname' =>$this->input->post('company_name'),
                   'email' =>$this->input->post('email'),
                    'mobilenumber' =>$this->input->post('mobile'),
                   'postaladdres' =>$this->input->post('address'),
                   'city' =>$this->input->post('city'),
                   'state' =>$this->input->post('state'),
                   'country' =>$this->input->post('country'),
                   'pincode' =>$this->input->post('pincode'),
                   'updatedon' =>date('Y-m-d H:i:s'),
                   'updatedby' =>$this->session->userdata('userid'),
                    'ipaddress' =>$ip,
                    'status' =>$this->input->post('status'),
                    // 'timezone' =>$this->input->post('timezone_id')
                     );

      $update_userdata = $this->client_model->update_userdata($user_data,$client_id);

      echo json_encode($update_userdata);
 
        }
   		

     
   }

   public function editclient()
   {
        $id=$this->input->post('thisid');
        $editdata= $this->client_model->editclient($id);
        echo json_encode($editdata);
   }

    

	public function deleteclient()
    {       
         $id=$this->input->post('thisid');    
         $this->db->where('client_id',$id);
       //  $this->db->where('roleid',$id);
        $query = $this->db->delete(array('clienttbl','usertbl'));
       
        if($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }


    
   public function get_clientlist()
   {

    $clientdetails = $this->client_model->all_client_data();

      $count = 1;
      foreach ($clientdetails as $list) {
           
          // $edit = echo "ggfhfghgf";
        $edit = '<a href="javascript:edit('.$list->client_id.')" class="edit"  id="'.$list->client_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
        // echo $edit;exit;
        $delete = '<a href="javascript:deletedata('.$list->client_id.')" id="'.$list->client_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';

        $data[] = array('S No' =>$count++ ,

                      'company_name' =>$list->company_name ,
                      'username' =>$list->username ,
                      'client_name' =>$list->client_name,
                      'mobile' =>$list->mobile,
                      // 'alter_mobile' =>$list->alter_mobile,
                      'email' =>$list->email ,
                      'client_limit' =>$list->client_limit ,
                      'address' =>$list->address ,
                      'Action' =>$edit.' '.$delete);
      }
            
      $results = array(
        "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
      
      echo json_encode($results);
  
           
   }

    


	
}
