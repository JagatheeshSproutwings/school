<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Route_stop extends MY_Controller 
{
	public function __construct() 
	{
		parent::__construct ();	
		if($this->session->userdata['client_id'] == '')
		{
			$this->index1();
		}
		$this->load->model ('Routestop_model');
		$this->load->model ('route_model');
        $this->load->model('Dashboardmodel');		
        $this->load->model('Smssend_model');
	}
		
	public function index1()
	{	
		redirect('login/');
	}

	public function index() 
	{
		$this->stop_details();

	}

	public function stop_details($route_id) 
	{
		
		$stop_details = $this->Routestop_model->stop_details($route_id);
		$this->session->set_flashdata('route_id',$route_id);
		$data['route_id'] = $route_id;
		$geo_location = $this->Routestop_model->all_location_data($route_id);
		$data['geo_location'] = $geo_location;
                $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		if($stop_details)
		{
			$data['stop_list'] = $stop_details;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/routestops/routestops',$data); 
		    $this->load->view('components/footer/footerscript');
		   $this->load->view('components/footer/footer');
		}
		
		else
		{
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('components/mainmenu',$accessmenu);
		    $this->load->view('schooladmin/routestops/routestops',$data); 
		   	$this->load->view('components/footer/footerscript');
		    $this->load->view('components/footer/footer');
		}
	}

		public function saveroutestops() 
	{
		$stop_id = $this->input->post('stop_id');
   

           if ($stop_id=='') 
		   {
					 $data=$this->input->post();
					  $data['client_id'] = $this->session->userdata('client_id');
				     $data['dealer_id'] = $this->session->userdata('dealer_id');
				     $data['subdealer_id'] = $this->session->userdata('subdealer_id');
				     $data['userid']=$this->session->userdata('userid');
				     $data['createdon']=date('Y-m-d H:i:s');            
				     $data['createdby']=$this->session->userdata('userid');
				     $data['ipaddress'] = $this->input->ip_address();
				     $lastid = $this->Routestop_model->saveroutestops($data,$stop_id=NULL);
					 echo json_encode($lastid);

		   }
		   else
		   {
		   		         $data=$this->input->post();
                         $data['updatedon']=date('Y-m-d H:i:s');
                         $data['updatedby']=$this->session->userdata('userid'); 
                         $data['ipaddress'] = $this->input->ip_address();  
                         $update= $this->Routestop_model->saveroutestops($data,$stop_id);                                         
                         echo json_encode($update);

		   }
	}



	// route ADD/EDIT PAGE
	public function editroutestopdata() 
	{
		 $id=$this->input->post('thisid');
        $editroutestopdata= $this->Routestop_model->editroutestopdata($id);
        echo json_encode($editroutestopdata);
	}


	 public function deleteroutestop()
    {       
        $id=$this->input->post('thisid');    
        $this->db->where('stop_id',$id);
        $query = $this->db->delete('sch_routestoptbl');
        
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
