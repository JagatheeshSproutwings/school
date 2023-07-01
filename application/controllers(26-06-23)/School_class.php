<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class School_class extends MY_Controller 
{
	public function __construct() 
	{
		parent::__construct ();	
		if($this->session->userdata['client_id'] == '')
		{
			$this->index1();
		}
		$this->load->model ('Class_model' );
		$this->load->model ('client_model' );
		$this->load->model ('Dashboardmodel' );
	}
		
	public function index1()
	{	
		redirect('login/');
	}

	public function index() {
		$this->class_details();
	}

	public function class_details() 
	{
		$client_id = $this->session->userdata ['client_id'];
		$data ['title'] = "class";
		$data ['menu'] = 'School';
		$data ['menuItem'] = 'class';
         $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$dealersimdetails = $this->Class_model->all_class_data();
         $customercomplaint= $this->Dashboardmodel->customer_complaint();
          $headerdata['customercomplaint'] = $customercomplaint;
         
		if($dealersimdetails)
		{
			$data['class_list']=$dealersimdetails;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/class/class_details',$data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');

		}else
		{	
			$this->session->set_flashdata('msg-sim','<span class="alert-msg msg-danger">No Data..!</span>');
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/class/class_details',$data);
			 $this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
	}

         public function get_classlist(){
		$classdetails = $this->Class_model->all_class_data();
		$count = 1;
		foreach ($classdetails as $list) {
			 
			// $edit = echo "ggfhfghgf";
		  $edit = '<a href="javascript:editdata('.$list->class_id.')" class="edit"  id="'.$list->class_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
		  // echo $edit;exit;
		  $delete = '<a href="javascript:deletedata('.$list->class_id.')" id="'.$list->class_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
  
		  $data[] = array('S No' =>$count++ ,
//                                'client_id' =>$list->client_id ,
//                                'userid' =>$list->userid ,
                                'class_name' =>$list->class_name,
                                'Action' =>$edit.' '.$delete);
		}
			  
		$results = array(
		  "sEcho" => 1,
		"iTotalRecords" => count($data),
		"iTotalDisplayRecords" => count($data),
		  "aaData"=>$data);
		
		echo json_encode($results);
	}
        
        
        public function saveclass()
   {   
   	$class_id = $this->input->post('class_id');
           if ($class_id=='') 
		   {
					 $data=$this->input->post();
                                     $data['client_id']=  $this->session->userdata('client_id');
				     $data['userid']=$this->session->userdata('userid');
				     $data['class_createddate']=date('Y-m-d H:i:s');            
				     $data['class_createdby']=$this->session->userdata('userid');
                                     $query = $this->db->insert('sch_class',$data);
                                        $lastid = $this->db->insert_id();
				     echo json_encode($lastid);

		   }
		   else
		   {
		   		         $data=$this->input->post();
                         $data['class_updateddate']=date('Y-m-d H:i:s');
                         $data['class_updatedby']=$this->session->userdata('userid'); 
                         $update= $this->Class_model->saveclass($data,$class_id);                                         
                         echo json_encode(2);

		   }
   
   }
        
     public function editclass()
   {
        $id=$this->input->post('thisid');
        $editdata= $this->Class_model->editclassdata($id);
        echo json_encode($editdata);
   }     
        
    public function deleteclass()
    {               
         $id=$this->input->post('thisid');    
         $this->db->where('class_id',$id);
        $query = $this->db->delete('sch_class');
        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
        
        
    
}
