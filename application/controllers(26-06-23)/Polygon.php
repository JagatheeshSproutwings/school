<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Polygon extends CI_Controller
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
    $this->load->model('Polygon_model');
   
  }

  public function index1()
  {
    redirect('login/');
  }

  public function add_polygon() 
	{


		$headerdata['webnotification'] = $this->Smssend_model->webnotification();
		$accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$polygon_list = $this->Polygon_model->polygon_list();
		if($polygon_list)
		{
			$data['polygon_list'] = $polygon_list;
			  
            $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/polygon/add_polygon',$data);
			$this->load->view('components/footer/footerscript');
            $this->load->view('components/footer/footer');
			
		}
		
		else
		{

            $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$headerdata);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view ( 'schooladmin/polygon/add_polygon');
			$this->load->view('components/footer/footerscript');
            $this->load->view('components/footer/footer');
		
		}
	}

  public function save_polygon() 
	{
		
		$polygon_latlng = $this->input->post('polygonlatlng');
		$polygon_name = $this->input->post('polygon_name');
		$implode_data =  implode(" ",$polygon_latlng);
    $polygon_id = $this->input->post('polygon_id');

				$data = array(
				'client_id' => $this->session->userdata['client_id'],
				'polygon_name' =>$polygon_name,
				'polygon_points' =>$implode_data,				
				'createdby' => $this->session->userdata['userid'],
			);
         
		 	   $save_polygons = $this->Polygon_model->save_polygons($data,$polygon_id);
			   echo json_encode($save_polygons);

	} 

  public function editpolygon()
  {
       $id=$this->input->post('thisid');
       $editdata= $this->Polygon_model->editpolygon($id);
       $implode_data =  explode(" ",$editdata->polygon_points);

      foreach ($implode_data as $key ) {

         $polypoint =  explode(",",$key);
          $polypoints[] = array('lat' => $polypoint[0],
                               'lng' => $polypoint[1]);
      } 

       $polygon_data = array('polygon_name' =>$editdata->polygon_name,
                             'polypoints' =>$polypoints,
                              'polygon_id' =>$editdata->polygon_id
                             );


       echo json_encode($polygon_data);
  }



	public function assign_polygon()
  { 
    
     $polygon_list = $this->Polygon_model->polygon_list();
    $assign_polygon = $this->Polygon_model->assign_polygon();
     $vehicle_list = $this->Geofence_model->vehicle_list();
    $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
    
    if($assign_polygon)
    {
      $data['assign_geofence']=$assign_polygon;
      $data['location_list']=$polygon_list;
      $data['vehicle_list']=$vehicle_list;
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar');
      $this->load->view('components/mainmenu',$accessmenu);
     $this->load->view('schooladmin/polygon/assign_polygon',$data); 
    $this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
        
    }
    else
    { 
       $data['location_list']=$polygon_list;
      $data['vehicle_list']=$vehicle_list;
      $this->session->set_flashdata('msg-assigngeofencemodel','<span class="alert-msg msg-danger">No Data..!</span>');
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar');
      $this->load->view('components/mainmenu',$accessmenu);
      $this->load->view('schooladmin/polygon/assign_polygon',$data); 
     $this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
    }
  }


  public function check_polygonlist()
  { 
    
     $polygon_list = $this->Polygon_model->polygon_list();
    $check_polygon = $this->Polygon_model->check_polygon();
     $vehicle_list = $this->Geofence_model->vehicle_list();
    $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
    
    if($check_polygon)
    {
      $data['assign_geofence']=$check_polygon;
      $data['location_list']=$polygon_list;
      $data['vehicle_list']=$vehicle_list;
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar');
      $this->load->view('components/mainmenu',$accessmenu);
     $this->load->view('schooladmin/polygon/check_polygon',$data); 
    $this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
        
    }
    else
    { 
       $data['location_list']=$polygon_list;
      $data['vehicle_list']=$vehicle_list;
      $this->session->set_flashdata('msg-assigngeofencemodel','<span class="alert-msg msg-danger">No Data..!</span>');
      $this->load->view('components/header/headerscript');
      $this->load->view('components/header/headernavbar');
      $this->load->view('components/mainmenu',$accessmenu);
      $this->load->view('schooladmin/polygon/check_polygon',$data); 
     $this->load->view('components/footer/footerscript');
           $this->load->view('components/footer/footer');
    }
  }


  public function deletepolygon()
	{
        $id=$this->input->post('thisid');    
        $this->db->where('polygon_id',$id);
        $query =  $this->db->delete('polygon_list');
        if ($query) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
	}

  public function  polygon_data($id)
  {
      $client_id = $this->session->userdata('client_id');
    
       $polygon_data= $this->Polygon_model->polygon_data($id);
     
         $implode_data =  explode(" ",$polygon_data->polygon_points);
          $polypoints=[];
         foreach ($implode_data as $key ) {

            $polypoint =  explode(",",$key);
             $polypoints[] = array('lat' => $polypoint[0],
                                  'lng' => $polypoint[1]);
         } 

          $polygon = array('polygon_name' =>$polygon_data->polygon_name,
                                'polypoints' =>$polypoints,
                                 'color' =>$polygon_data->polygon_color,
                                  'fillcolor' =>$polygon_data->polygon_fillcolor );
      
       echo json_encode($polygon);
  }
  


  public function save_check_polygon()
   {   
   
     $client_id = $this->session->userdata['client_id']; 
     $polygon_id = $this->input->post('polygon_id');
     $vehicle = $this->input->post('vehicle_id');

       
                 
                $data = array(
                  'polygon_id' => $polygon_id,
                  'vehicle_id' => $vehicle,
                  'createdby' => $this->session->userdata['userid'],
                  'client_id' => $client_id,
                  'status' => 1
                );
      
                    $query = $this->db->insert('check_polygonlist',$data);
                    
                     echo json_encode(1);
                                      
       

      }
public function save_assign_polygon()
   {   
   
     $client_id = $this->session->userdata['client_id']; 
     $polygon_id = $this->input->post('polygon_id');
     $vehicle = $this->input->post('vehicle_id');

        if ($vehicle[0]=='1') 
        {
     
                  $all_vehicle=$this->Geofence_model->vehicle_list();

                foreach ($all_vehicle as $list) {
                $data = array(
                  'polygon_id' => $polygon_id,
                  'vehicle_id' => $list->vehicleid,
                  'createdby' => $this->session->userdata['userid'],
                  'createdon' => date('Y-m-d H:i:s'),
                  'client_id' => $client_id,
                  'status' => 1
                );
      
                    $query = $this->db->insert('assign_polygon',$data);
                      }

                     echo json_encode(1);
                                      
        }

      
      else
      {

          $result = $this->Polygon_model->insert_assign_polygon($polygon_id,$vehicle);
          echo json_encode($result);
      }
    
   }

   public function delete_assign_polygon()
	{
		
        $id=$this->input->post('thisid');    
        $this->db->where('id',$id);
        $query =  $this->db->delete('assign_polygon');
        
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