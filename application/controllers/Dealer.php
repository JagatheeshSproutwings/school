<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dealer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata['userid'] == '')
		{
			$this->index1();
		}
		$this->load->model('dealer_model');
    $this->load->model('Dashboardmodel');		
    $this->load->model('Smssend_model');
		// $this->load->model('common_model');
	}

	public function index1()
	{
		redirect('login/');
	}

	public function index()
	{
		$this->dealerdetails();		
	}

	public function dealerdetails()
	{	
		$data['title']="Dealer";
		$data['menu']="Management";
		$data['menuItem']='dealer';
		$dealerdetails = $this->dealer_model->all_dealer_data();
    // print_r($dealerdetails);die;
    $customercomplaint= $this->Dashboardmodel->customer_complaint();
    $data['customercomplaint'] = $customercomplaint;
    $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		if($dealerdetails)
		{
			$data['dealerlist']=$dealerdetails;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('dealer/dealer',$data);
			$this->load->view('components/footer/footerscript');
		   $this->load->view('components/footer/footer');

		}else
		{	
			$this->session->set_flashdata('msg-sim','<span class="alert-msg msg-danger">No Data..!</span>');
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('registration/dealer/dealer');
			$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
		}
	}
    public function get_dealerlist(){
		$dealerdetails = $this->dealer_model->all_dealer_data();

      $count = 1;
      foreach ($dealerdetails as $list) {
           
          // $edit = echo "ggfhfghgf";
        $edit = '<a href="javascript:editdata('.$list->dealer_id.')" class="edit"  id="'.$list->dealer_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
        // echo $edit;exit;
        $delete = '<a href="javascript:deletedata('.$list->dealer_id.')" id="'.$list->dealer_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';

        $data[] = array('S No' =>$count++ ,

                      'dealer_company' =>$list->dealer_company ,
                      'dealer_name' =>$list->dealer_name ,
                      'dealer_email' =>$list->dealer_email,
                      'dealer_mobile' =>$list->dealer_mobile,
                      // 'alter_mobile' =>$list->alter_mobile,
                      'dealer_limit' =>$list->dealer_limit ,
                      'dealer_address' =>$list->dealer_address ,
                      'dealer_pincode' =>$list->dealer_pincode ,
                      'Action' =>$edit.' '.$delete);
      }
            
      $results = array(
        "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
      
      echo json_encode($results);
    }
   public function savedealer()
   {  

   		$ip = $this->input->ip_address();
        $dealer_id = $this->input->post('dealer_id');
        if ($dealer_id=='') 
        {
                     $dealer_data = array(
                           'dealer_company' =>$this->input->post('dealer_company'),
                           'dealer_name' =>$this->input->post('dealer_name'),
                           'dealer_email' =>$this->input->post('dealer_email'),
                           'dealer_mobile' =>$this->input->post('dealer_mobile'),
                           'dealer_address' =>$this->input->post('dealer_address'),
                           'dealer_logo' =>$this->input->post('dealer_logo1'),
                           'dealer_limit' =>$this->input->post('dealer_limit'),
                           'dealer_subdomain' =>$this->input->post('dealer_subdomain'),
                           'dealer_color' =>$this->input->post('dealer_color'),
                           'dealer_city' =>$this->input->post('dealer_city'),
                           'dealer_state' =>$this->input->post('dealer_state'),
                           'dealer_country' =>$this->input->post('dealer_country'),
                           'dealer_pincode' =>$this->input->post('dealer_pincode'),
                           'createdon' =>date('Y-m-d H:i:s'),
                           'createdby' =>$this->session->userdata('userid'),
                           'status' =>$this->input->post('status'),
                           'ipaddress' =>$ip
                             );


                $insert_id = $this->dealer_model->savedealer($dealer_data);

                $secondarypassword = md5("twings@zxc");
                  $user_data = array('username' =>$this->input->post('username'),
                           'password' =>md5($this->input->post('password')),
                           'secondarypassword' =>$secondarypassword,
                           'firstname' =>$this->input->post('dealer_name'),
                           'companyname' =>$this->input->post('dealer_company'),
                           'clienttype' =>'Dealer',
                           'dealer_id' =>$insert_id,
                           'roleid' =>'17',
                           'email' =>$this->input->post('dealer_email'),
                           'mobilenumber' =>$this->input->post('dealer_mobile'),
                           'profilepic' =>$this->input->post('dealer_logo1'),
                           'postaladdres' =>$this->input->post('dealer_address'),
                           'city' =>$this->input->post('dealer_city'),
                           'state' =>$this->input->post('dealer_state'),
                           'country' =>$this->input->post('dealer_country'),
                           'pincode' =>$this->input->post('dealer_pincode'),
                           'createdon' =>date('Y-m-d H:i:s'),
                           'createdby' =>$this->session->userdata('userid'),
                           'status' =>$this->input->post('status'),
                           'ipaddress' =>$ip
                             );

              $insert_userdata = $this->dealer_model->insert_userdata($user_data);

              echo json_encode(1);
        }
        else
        {

                         $dealer_data = array(
                            'dealer_company' =>$this->input->post('dealer_company'),
                           'dealer_name' =>$this->input->post('dealer_name'),
                           'dealer_email' =>$this->input->post('dealer_email'),
                           'dealer_mobile' =>$this->input->post('dealer_mobile'),
                           'dealer_address' =>$this->input->post('dealer_address'),
                           'dealer_logo' =>$this->input->post('dealer_logo1'),
                           'dealer_limit' =>$this->input->post('dealer_limit'),
                           'dealer_color' =>$this->input->post('dealer_color'),
                           'dealer_subdomain' =>$this->input->post('dealer_subdomain'),
                           'dealer_city' =>$this->input->post('dealer_city'),
                           'dealer_state' =>$this->input->post('dealer_state'),
                           'dealer_country' =>$this->input->post('dealer_country'),
                           'dealer_pincode' =>$this->input->post('dealer_pincode'),
                           'updatedon' =>date('Y-m-d H:i:s'),
                           'updatedby' =>$this->session->userdata('userid'),
                           'ipaddress' =>$ip,
                           'status' =>$this->input->post('status'),
                             );
         
                 $update_dealer= $this->dealer_model->savedealer($dealer_data,$dealer_id);                                         
                 

              //  $insert_id = $this->dealer_model->adddealer($dealer_data);

                  $user_data = array('username' =>$this->input->post('username'),
                           'password' =>md5($this->input->post('password')),
                           'firstname' =>$this->input->post('dealer_name'),
                           'companyname' =>$this->input->post('dealer_company'),
                           'email' =>$this->input->post('dealer_email'),
                            'mobilenumber' =>$this->input->post('dealer_mobile'),
                           'profilepic' =>$this->input->post('dealer_logo1'),
                           'postaladdres' =>$this->input->post('dealer_address'),
                           'city' =>$this->input->post('dealer_city'),
                           'state' =>$this->input->post('dealer_state'),
                           'country' =>$this->input->post('dealer_country'),
                           'pincode' =>$this->input->post('dealer_pincode'),
                           'updatedon' =>date('Y-m-d H:i:s'),
                           'updatedby' =>$this->session->userdata('userid'),
                            'ipaddress' =>$ip,
                            'status' =>$this->input->post('status'),
                             );

              $update_userdata = $this->dealer_model->update_userdata($user_data,$dealer_id);

              echo json_encode(2);
        }

      
   }

   public function editdealer()
   {
        $id=$this->input->post('thisid');
        $editdata= $this->dealer_model->editdealer($id);
        echo json_encode($editdata);
   }

	public function deletedealer()
    {       
         $id=$this->input->post('thisid');    
        $this->db->where('dealer_id',$id);
       $query = $this->db->delete('dealertbl');
       
        if($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }


    public function dealer_logo()
    {

        if (count($_FILES["file"]["name"]) > 0)
        {
            //$output = '';
            //sleep(3);
            for ($count = 0;$count < count($_FILES["file"]["name"]);$count++)
            {
                $file_name = $_FILES["file"]["name"][$count];
                $tmp_name = $_FILES["file"]['tmp_name'][$count];

                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_file_name = round(microtime(true) * 1000).'.' . $ext;
                $file_array = explode(".", $file_name);
                $file_extension = end($file_array);

                $location = 'uploads/company_logo/' . $new_file_name;
                if (move_uploaded_file($tmp_name, $location))
                {
                    echo $new_file_name;
                }
            }
        }

    }

	
}