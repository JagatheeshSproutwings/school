<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Route extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct ();	
		if($this->session->userdata['client_id'] == '')
		{
			$this->index1();
		}
		$this->load->model ('Route_model');
		$this->load->model ('vehicle_model');
		$this->load->model ('Smssend_model');
		$this->load->model ('Polygon_model');
		$this->load->model ('Dashboardmodel');
		$this->load->model ('genericreport_model');
                
	}
		
	public function index1()
	{	
		redirect('login/');
	}

	public function index() 
	{

		$this->route_details();
	}

	public function route_details() 
	{

       $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$route_list = $this->Route_model->route_details();
		$geo_location = $this->Route_model->all_location_data();
		$data['geo_location'] = $geo_location;
		$data['webnotification'] = $this->Smssend_model->webnotification();
		if($route_list)
		{
			$data['route_list'] = $route_list;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/route/routes',$data); 
			 $this->load->view('components/footer/footerscript');
		   $this->load->view('components/footer/footer');
			
		}
		
		else
		{   $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/route/routes',$data); 
			 $this->load->view('components/footer/footerscript');
		   $this->load->view('components/footer/footer');
			
		}
	}


	public function saveroute() 
	{
		$route_id = $this->input->post('route_id');
   

   if ($route_id=='') 
		   {
					 $data=$this->input->post();
                                    $data['client_id'] = $this->session->userdata('client_id');
				     $data['dealer_id'] = $this->session->userdata('dealer_id');
				     $data['subdealer_id'] = $this->session->userdata('subdealer_id');
				     $data['userid']=$this->session->userdata('userid');
				     $data['createdon']=date('Y-m-d H:i:s');            
				     $data['createdby']=$this->session->userdata('userid');
				     $data['ipaddress'] = $this->input->ip_address();
				     $lastid = $this->db->insert('sch_routestbl',$data);;
				     echo json_encode($lastid);

		   }
		   else
		   {
		   		         $data=$this->input->post();
                         $data['updatedon']=date('Y-m-d H:i:s');
                         $data['updatedby']=$this->session->userdata('userid'); 
                         $data['ipaddress'] = $this->input->ip_address();  
                         $update= $this->Route_model->saveroute($data,$route_id);                                         
                         echo json_encode($update);

		   }
	}

	  public function editroutedata()
   {
        $id=$this->input->post('thisid');
        $editroutedata= $this->Route_model->editroutedata($id);
        echo json_encode($editroutedata);
   }



	 public function deleteroute()
    {       
        $id=$this->input->post('thisid');    
        $this->db->where('route_id',$id);
        $query =  $this->db->delete(array('sch_routestbl','routestoptbl'));
        
        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }


	public function route_assign() 
	{
		$data['webnotification'] = $this->Smssend_model->webnotification();
        $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();

		$routeassignlist = $this->Route_model->polyroute_assigndetails();
		$vehicle_list = $this->Route_model->vehicle_list();
		$route_list = $this->Route_model->route_list();
		$data['vehicle_list'] = $vehicle_list;
		$data['route_list'] = $route_list;
       // $data['webnotification'] = $this->Smssend_model->webnotification();
		if($route_list)
		{
			$data['routeassignlist'] = $routeassignlist;

			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/route/route_assign',$data); 
			 $this->load->view('components/footer/footerscript');
		   $this->load->view('components/footer/footer');
		}
		
		else
		{
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/route/route_assign',$data); 
			$this->load->view('components/footer/footerscript');
		   $this->load->view('components/footer/footer');
		}
	}

	

	public function saverouteassign() 
	{
		
		$id = $this->input->post('id');
   

   if ($id=='') 
		   {
				   	 $data=$this->input->post();
					  $data['travel_startdate']=date('Y-m-d');    
					  $data['travel_enddate']=date('Y-m-d',strtotime('+1 day'));    
					 $data['client_id'] = $this->session->userdata('client_id');
				     $data['dealer_id'] = $this->session->userdata('dealer_id');
				     $data['subdealer_id'] = $this->session->userdata('subdealer_id');
				     $data['userid']=$this->session->userdata('userid');
				     $data['createdon']=date('Y-m-d H:i:s');            
				     $data['createdby']=$this->session->userdata('userid');
				     $data['ipaddress'] = $this->input->ip_address();
                                     
				     $lastid = $this->db->insert('sch_routeassigntbl',$data);
				     echo json_encode($lastid);

		   }
		   else
		   {
		   		         $data=$this->input->post();
						 unset($data['saturday_status']);
						 $saturday_status = $this->input->post('saturday_status');
						 $saturday_status = ($saturday_status >= 1 ) ? 1 :0;
						 $data['saturday_status']=$saturday_status;
		   		         $data['travel_startdate']=date('Y-m-d');    
					     $data['travel_enddate']=date('Y-m-d',strtotime('-1 day'));    
                         $data['updatedon']=date('Y-m-d H:i:s');
                         $data['updatedby']=$this->session->userdata('userid'); 
                         $data['ipaddress'] = $this->input->ip_address();  
                         $update= $this->Route_model->saverouteassign($data,$id);                                         
                         echo json_encode($update);

		   }

	} 

	  public function editrouteassigndata()
   {
        $id=$this->input->post('thisid');
        $editrouteassigndata= $this->Route_model->editrouteassigndata($id);
        echo json_encode($editrouteassigndata);
   }



	public function deleterouteassign($id)
	{
		
        $id=$this->input->post('thisid');    
        $this->db->where('id',$id);
        $query =  $this->db->delete('sch_routeassigntbl');
        
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
