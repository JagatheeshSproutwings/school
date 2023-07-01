<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Geofence extends MY_Controller
{
  public function __construct()

  {
    parent::__construct();
    if($this->session->userdata['userid'] == '')
    {
      $this->index1();
    }
    $this->load->model('Geofence_model');
    $this->load->model('Smssend_model');
    $this->load->model('Dashboardmodel');
   
  }

  public function index1()
  {
    redirect('login/');
  }

  public function index()
  {
    $this->geofencedetails();   
    
  }

  public function geofencedetails()
  { 
      $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
			$data['user_id']=$this->session->userdata['user_id'];  	     
			$data['client_id']=$this->session->userdata['client_id'];  	     
			$data['dealer_id']=$this->session->userdata['dealer_id'];
			$data['subdealer_id']=$this->session->userdata['subdealer_id'];
	$customercomplaint= $this->Dashboardmodel->customer_complaint();
   $data['customercomplaint'] = $customercomplaint;
    $geofencemodeldetails = $this->Geofence_model->all_geofence_data();
    if($geofencemodeldetails)
    {
      $data['geofencelist']=$geofencemodeldetails;
       $data['webnotification'] = $this->Smssend_model->webnotification();
      $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/geofence/geofence',$data); 
		$this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
        
    }
    else
    { 
      $this->session->set_flashdata('msg-geofencemodel','<span class="alert-msg msg-danger">No Data..!</span>');
      $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/geofence/geofence',$data); 
	$this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
    }
  }

   public function savegeofence()
   {   
   	$Location_Id = $this->input->post('Location_Id');

   	if ($Location_Id=='') 
   	{

	     $data=$this->input->post();
       $data['client_id']=$this->session->userdata['client_id'];  	     
       $data['dealer_id']=$this->session->userdata['dealer_id'];
       $data['subdealer_id']=$this->session->userdata['subdealer_id'];
	     $data['CreatedOn']=date('Y-m-d H:i:s');             
	     $data['CreatedBy']=$this->session->userdata('userid');
	     $insert_data = $this->Geofence_model->savegeofence($data);
       echo json_encode($insert_data);
   	}
   	else
   	{
        $data=$this->input->post();
        $data['UpdatedOn  ']=date('Y-m-d H:i:s');             
        $data['UpdatedBy']=$this->session->userdata('userid');
        $update= $this->Geofence_model->savegeofence($data,$Location_Id);                                         
        echo json_encode($update);
   	}
    
   }

   public function editgeofence()
   {
        $id=$this->input->post('thisid');
        $editdata= $this->Geofence_model->editgeofencedata($id);
        echo json_encode($editdata);
   }


  public function deletegeofence()
    {       
        $id=$this->input->post('thisid');    
        $this->db->where('Location_Id',$id);
        $query = $this->db->delete('sch_location_list');
        
        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }


  public function assign_geofence()
  { 
    
    $assign_geofence = $this->Geofence_model->assign_geofence();
    $location_list = $this->Geofence_model->all_geofence_data();
    $vehicle_list = $this->Geofence_model->vehicle_list();
    $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
    
    if($assign_geofence)
    {
      $data['assign_geofence']=$assign_geofence;
      $data['location_list']=$location_list;
      $data['vehicle_list']=$vehicle_list;
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar');
      $this->load->view('components/mainmenu',$accessmenu);
     $this->load->view('schooladmin/geofence/assign_geofence',$data); 
    $this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
        
    }
    else
    { 
       $data['location_list']=$location_list;
      $data['vehicle_list']=$vehicle_list;
      $this->session->set_flashdata('msg-assigngeofencemodel','<span class="alert-msg msg-danger">No Data..!</span>');
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar');
      $this->load->view('components/mainmenu',$accessmenu);
      $this->load->view('schooladmin/geofence/assign_geofence',$data); 
     $this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
    }
  }

   public function save_assign_geofence()
   {   
   
     $client_id = $this->session->userdata['client_id']; 
     $geo_location = $this->input->post('geo_location_id');
     $vehicle = $this->input->post('vehicle_id');

        if ($vehicle[0]=='1') 
        {
     
                  $all_vehicle=$this->Geofence_model->vehicle_list();

                foreach ($all_vehicle as $list) {
                $data = array(
                  'geo_location_id' => $geo_location,
                  'vehicle_id' => $list->vehicleid,
                  'created_by' => $this->session->userdata['userid'],
                  'created_datetime' => date('Y-m-d H:i:s'),
                  'client_id' => $client_id,
                  'activecode' => 1
                );
      
                    $query = $this->db->insert('sch_assign_geo_fenceing',$data);
                      }

                     echo json_encode(1);
                      
                          
        }

      
      else
      {

          $result = $this->Geofence_model->insert_assign_category($geo_location,$vehicle);  

           echo json_encode($result);
      }
    
   }
   public function edit_assign_geofence(){
     $id = $this->input->post('thisid');
     $result = $this->Geofence_model->edit_assign_geofence($id);
     echo json_encode($result);
   }
   public function delete_assign_geofence()
    {       
        $id=$this->input->post('thisid');    
        $this->db->where('id',$id);
        $query = $this->db->delete('sch_assign_geo_fenceing');
        
        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }

		public function import_geofence()
		{
			$file_name = "";  
			$config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'xlsx';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
				print_r($config);
		}

}
