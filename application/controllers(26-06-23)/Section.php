<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Section extends CI_Controller 
{
        public function __construct() 
	{
		parent::__construct ();	
		if($this->session->userdata['client_id'] == '')
		{
			$this->index1();
		}
		$this->load->model ('Section_model');
		$this->load->model ('Dashboardmodel' );
	}
		
	public function index1()
	{	
		redirect('login/');
	}

	public function index() {
		$this->section_details();
	}

	public function section_details() 
	{
		$data ['title'] = "Section";
		$data ['menu'] = 'School';
		$data ['menuItem'] = 'section';
		$client_id = $this->session->userdata ['client_id'];
                
                $class_names = $this->Section_model->class_names();
		$data['class_names'] = $class_names;

                
		$standard_list = $this->Section_model->section_details();
		$data['standard_list'] = NULL;
                $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
                $customercomplaint= $this->Dashboardmodel->customer_complaint();
                $headerdata['customercomplaint'] = $customercomplaint;

		if($standard_list)
		{
			$data['standard_list'] = $standard_list;
                        $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/section/section_details',$data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
                 
		}
		
		else
		{
                    $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/section/section_details',$data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
		
	}
        
             public function savesection()
                {   
                 $section_id = $this->input->post('section_id');
                 
                    if ($section_id=='') 
                            {
                            $data=$this->input->post();
                            $data['client_id']=  $this->session->userdata('client_id');
                            $data['section_createddate']=date('Y-m-d H:i:s');            
                            $data['section_createdby']=$this->session->userdata('userid');
                            $query = $this->db->insert('sch_section',$data);
                               $lastid = $this->db->insert_id();
                            echo json_encode($lastid);
                            }
                            else
                            {
                                  $data=$this->input->post();
                                  $data['section_updateddate']=date('Y-m-d H:i:s');
                                  $data['section_updatedby']=$this->session->userdata('userid'); 
                                  $update= $this->Section_model->savesection($data,$section_id);                                         
                                  echo json_encode(2);

                            }

            }
        
          public function get_sectionlist(){
		$standard_list = $this->Section_model->section_details();
		$count = 1;
		foreach ($standard_list as $list) {
			 
			// $edit = echo "ggfhfghgf";
		  $edit = '<a href="javascript:editdata('.$list->section_id.')" class="edit"  id="'.$list->section_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
		  // echo $edit;exit;
		  $delete = '<a href="javascript:deletedata('.$list->section_id.')" id="'.$list->section_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
  
		  $data[] = array('S No' =>$count++ ,
                                'class_name' =>$list->class_name,
                                'section_name' =>$list->section_name,
                                'Action' =>$edit.' '.$delete);
		}
			  
		$results = array(
		  "sEcho" => 1,
		"iTotalRecords" => count($data),
		"iTotalDisplayRecords" => count($data),
		  "aaData"=>$data);
		
		echo json_encode($results);
	}
        
           public function editsection()
             {
                  $id=$this->input->post('thisid');
                  $editdata= $this->Section_model->editsectiondata($id);
                  echo json_encode($editdata);
             }  
        
             
               public function deletesection()
    {               
         $id=$this->input->post('thisid');    
         $this->db->where('section_id',$id);
        $query = $this->db->delete('sch_section');
        if ($query) 
        { return TRUE; }
        else 
        { return FALSE; }
    }
        

	
}
