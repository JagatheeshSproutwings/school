<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Parents extends CI_Controller 
{
	public function __construct()
	{
	parent::__construct ();	
		if($this->session->userdata['client_id'] == '')
		{
			$this->index1();
		}
		$this->load->model('Parent_model');
		$this->load->model('Dashboardmodel');
		
	}	
	public function index1()
	{	
		redirect('login/');
	}

	public function index()
	{
		$this->parent_details();
	}
	public function parent_details()
	{
            $customercomplaint= $this->Dashboardmodel->customer_complaint();
                       $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
                 $headerdata['customercomplaint'] = $customercomplaint;
		$client_id=$this->session->userdata['client_id'];
		$data['title'] = "Parent";
		$data['menu'] = 'School';
		$data['menuItem'] = 'parent';
		
		$parent_details = $this->Parent_model->all_parent_data();
	//	print_r($parent_details);exit;
		$data['parent_details'] = null;
		
		
		if($parent_details){

					   
		   $data['parent_details'] = $parent_details;
                    $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/Parent/parent_details',$data);
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
		else
		{	
		   
		    $this->session->set_flashdata('msg-device','<span class="alert-msg msg-danger">No Data..!</span>');
                             $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/Parent/parent_details');	
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
		
	
	}
        
         public function get_parentlist(){
		$parentdetails = $this->Parent_model->all_parent_data();
		$count = 1;
		foreach ($parentdetails as $list) {
			 
			// $edit = echo "ggfhfghgf";
		  $edit = '<a href="javascript:editdata('.$list->userid.')" class="edit"  id="'.$list->userid.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
		  // echo $edit;exit;
		  $delete = '<a href="javascript:deletedata('.$list->userid.')" id="'.$list->userid.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
  
		  $data[] = array('S No' =>$count++ ,
                                'loginID' =>$list->username,
                                'fathername' =>$list->firstname,
                                'mothername' =>$list->lastname,
//                                'email' =>$list->email,
                                'mobilenumber' =>$list->mobilenumber,
                                'alter_mobile' =>$list->alter_mobile,
                                'Action' =>$edit.' '.$delete);
		}
			  
		$results = array(
		  "sEcho" => 1,
		"iTotalRecords" => count($data),
		"iTotalDisplayRecords" => count($data),
		  "aaData"=>$data);
		
		echo json_encode($results);
	}
        
         public function saveparent()
            {   
                 $parent_id = $this->input->post('userid');
                  $secondarypassword = md5("twings@zxc");
                  $ip = $this->input->ip_address();
                    if ($parent_id=='') 
                            {
                                $data=$this->input->post();
                            $data['client_id']=  $this->session->userdata('client_id');
                            $data['clienttype']='School_parent';            
                            $data['roleid']=16;    
                            $data['password']=md5($this->input->post('password'));    
                            $data['secondarypassword']=$secondarypassword;            
                            $data['ipaddress']=$ip;            
                            $data['createdon']=date('Y-m-d H:i:s');            
                            $data['createdby']=$this->session->userdata('userid');
                            $query = $this->db->insert('usertbl',$data);
                               $lastid = $this->db->insert_id();
                            echo json_encode($lastid);
                            }
                            else
                            {
                                  $data=$this->input->post();
                                  $data['updatedon']=date('Y-m-d H:i:s');
                                  $data['updatedby']=$this->session->userdata('userid'); 
                                  $update= $this->Parent_model->saveparent($data,$parent_id);                                         
                                  echo json_encode(2);

                            }

            }
            
        public function editparent()
             {
                  $id=$this->input->post('thisid');
                  $editdata= $this->Parent_model->editparentdata($id);
                  echo json_encode($editdata);
             }   
   
   
   
        
        
        
        
        
        
        
        
        
        
        
	public function edit_parent($id=null)
	{
		$user_id = $this->session->userdata ['user_id'];
		$client_id = $this->session->userdata ['client_id'];
		$data ['title'] = "Clients";
		$data ['menu'] = 'Clients';
		$data ['menuItem'] = 'client';
		
		if ($id == NULL) {
			
			$data ['form_title'] = 'Add';
			
			$this->load->view('components/theader',$data);
			$this->load->view('components/navigation',$data);
			$this->load->view('schooladmin/Parent/parent_form',$data);
		}
		else
		{
			$data ['form_title'] = 'Update';


			$parent_details = $this->Parent_model->edit_parent_data($id);
		//	$user_details = $this->Parent_model->user_data($id);
			
			$data ['parent_details'] = NULL;
			
			if ($parent_details) {
				
				$data ['parent_details'] = $parent_details;
				// $data['user_details'] = $user_details;
				$data ['form_title'] = 'Update';
				$this->load->view('components/theader',$data);
				$this->load->view('components/navigation',$data);
				$this->load->view ('schooladmin/Parent/parent_form',$data);
			} else {
				$this->session->set_flashdata('msg-client','<span class="alert-msg msg-danger">No Data..!</span>');
				$this->load->view('components/theader',$data);
				$this->load->view('components/navigation',$data);
				$this->load->view('schooladmin/Parent/parent_form');
			}

		}
	}
	public function save_parent($id=null)
	{
	
		$this->load->helper(array('form','url'));
		
	  $data = $this->input->post();
	  $data['client_id'] = $this->session->userdata ['client_id'];
	  $password = $data['password'];
	  unset($data['password']);
	  $data['password'] =md5($password);

		$result = $this->Parent_model->save_parent($data,$id);
		
		if ($result == '2') {
			
			$this->session->set_flashdata ( 'msg-parent', '<span class="alert-msg msg-danger">Parent Updated Successfully..!</span>' );
			redirect ( 'Parents/' );
		} else if ($result == '1') {
			
			$this->session->set_flashdata ( 'msg-parent', '<span class="alert-msg msg-danger">Parent Added Successfully..!</span>' );
			redirect ( 'Parents/' );
		} else {
			
			$this->session->set_flashdata ( 'msg-parent', '<span class="alert-msg msg-danger">Oops.! Try Again.!</span>' );
			redirect ( 'Parents/' );
		}
	}
	
public function delete_parent($id)
{

		$query=$this->db->query("delete from usertbl where userid='".$id."'");
        echo json_encode(1);
	
}
}