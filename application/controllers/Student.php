<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Student extends MY_Controller 
{
    	public function __construct() 
	{
		parent::__construct ();	
		if($this->session->userdata['client_id'] == '')
		{
			$this->index1();
		}
		$this->load->model ('Student_model');
		$this->load->model ('parent_model');
		$this->load->model ('Route_model');
		$this->load->model ('Dashboardmodel' );
	}

        public function index1()
	{	
		redirect('login/');
	}

	public function index() {
		$this->student_details();
	}

	public function student_details() 
	{
		$data ['title'] = "student";
		$data ['menu'] = 'School';
		$data ['menuItem'] = 'student';
		$client_id = $this->session->userdata ['client_id'];
		$student_list = $this->Student_model->student_details();
		$data['student_list'] = NULL;
                 $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
                 $customercomplaint= $this->Dashboardmodel->customer_complaint();
                $headerdata['customercomplaint'] = $customercomplaint;
                
        $school_list = $this->Student_model->school_list();
		$parent_list = $this->Student_model->parent_list();
		$class_list = $this->Student_model->class_list();
		$route_list = $this->Student_model->route_list();

		$data['school_list'] = $school_list;
		$data['parent_list'] = $parent_list;
		$data['class_list'] = $class_list;
		$data['route_list'] = $route_list;
                
		if($student_list)
		{
			$data['student_list'] = $student_list;
                        $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/student/student_details',$data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
		
		else
		{
			$this->session->set_flashdata('msg-sim','<span class="alert-msg msg-danger">No Data..!</span>');
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/student/student_details',$data);
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
                        
		}
		
	}

	public function get_studentlist(){
		$standard_list = $this->Student_model->student_details();
		$count = 1;
		foreach ($standard_list as $list) {
			 
			// $edit = echo "ggfhfghgf";
		  $edit = '<a href="javascript:editdata('.$list->student_id.')" class="edit"  id="'.$list->student_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
		  // echo $edit;exit;
		  $delete = '<a href="javascript:deletedata('.$list->student_id.')" id="'.$list->student_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
  
		  $data[] = array('S No' =>$count++ ,
								'student_name' =>$list->student_name,
								'student_rollno' =>$list->student_rollno,
                                'student_dob' =>$list->student_dob,
                                'parent_name' =>$list->parent_name,
								'class_name' =>$list->class_name,
								'section_name' =>$list->section_name,
                                'route_name' =>$list->route_name,
                                'stop_name' =>$list->stop_name,
                                'Action' =>$edit.' '.$delete);
		}
			  
		$results = array(
		  "sEcho" => 1,
		"iTotalRecords" => count($data),
		"iTotalDisplayRecords" => count($data),
		  "aaData"=>$data);
		
		echo json_encode($results);
	}
        
	// SAVE student DETAILS

	public function save_student($id = NULL) 
	{
		/* Session Data */
		$current_timestamp = date("Y:m:d H:i:s");
		if($id == null)
		{

			$student_data = array(
				'student_name' => $this->input->post('student_name'),
				'student_rfid_no' => $this->input->post('student_rfid_no'),
				'client_id' => $this->session->userdata['client_id'],				
				'section_id' => $this->input->post('section_id'),				
				'student_rollno' => $this->input->post('student_rollno'),
				'student_dob' => $this->input->post('student_dob'),
				'parent_id' => $this->input->post('parent_id'),
				'class_id' => $this->input->post('class_id'),
				'route_id' => $this->input->post('route_id'),
				'stop_id' => $this->input->post('stop_id'),
				'evening_route_id' => $this->input->post('evening_route_id'),
				'evening_stop_id' => $this->input->post('evening_stop_id'),
				'student_createdby' => $this->session->userdata['userid'],
				'student_createddate' => $current_timestamp,
				'status' => $this->input->post('status')
			);
		
			$result = $this->Student_model->save_student_data($student_data,$id=null);
		}
		else
		{
			$student_data = array(
				'student_name' => $this->input->post('student_name'),
				'student_rfid_no' => $this->input->post('student_rfid_no'),
				'client_id' => $this->session->userdata['client_id'],				
				'section_id' => $this->input->post('section_id'),				
				'student_rollno' => $this->input->post('student_rollno'),
				'student_dob' => $this->input->post('student_dob'),
				'parent_id' => $this->input->post('parent_id'),
				'class_id' => $this->input->post('class_id'),
				'route_id' => $this->input->post('route_id'),
				'stop_id' => $this->input->post('stop_id'),
				'evening_route_id' => $this->input->post('evening_route_id'),
				'evening_stop_id' => $this->input->post('evening_stop_id'),
				'student_updatedby' => $this->session->userdata['userid'],
				'student_updateddate' => $current_timestamp,
				'status' => $this->input->post('status')
			);
		
			$result = $this->Student_model->save_student_data($student_data,$id);
		}
		echo json_encode($result);

	}
	
	public function edit_student()
	{	
		$student_id = $this->input->post('thisid');
		$edit_data = $this->Student_model->edit_student_data($student_id);
		echo json_encode($edit_data);
		
		
	}
	
	// DELETE ROLE DATA BY ID
	public function delete_student() 
	{
		$student_id = $this->input->post('thisid');
		$delete_student = $this->Student_model->delete_studente_data($student_id);
		echo json_encode($result);

	}
	public function section_list()
	{
	 $class_id=$this->input->post('class_id');
   $section_name=$this->Student_model->section_name($class_id);
   if(($section_name>0))
  {
    echo json_encode($section_name);
  }
  else
  {
    echo false;
  }
	}


	public function stop_list()
	{
		$route_id=$this->input->post('route_id');
        $stop_name=$this->Student_model->stop_name($route_id);
		   if(($stop_name>0))
		  {
		    echo json_encode($stop_name);
		  }
		  else
		  {
		    echo false;
		  }
	}

	public function Stop_student_details($stop_id)
	{


		$student_list=$this->Student_model->stop_student($stop_id);
		if($student_list)
		{
			$data['student_list'] = $student_list;
			$this->load->view ( 'components/theader',$data);
			$this->load->view ( 'components/navigation',$data);
			$this->load->view ( 'schooladmin/student/student_details',$data);
		}
		
		else
		{
			$this->load->view ( 'components/theader');
			$this->load->view ( 'components/navigation');
			$this->load->view ( 'schooladmin/student/student_details');
		}

	}



}
