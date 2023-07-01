<?php
error_reporting(0);
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Route extends MY_Controller 
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

	public function route_list_details() 
	{

		$route_list = $this->Route_model->route_details();

		$count = 1;
      foreach ($route_list as $list) {
           
		$routestop= '<button type="button" class="btn btn-icon btn-pure danger mr-1" title="stops" class="route_stop">&emsp;&emsp;&emsp;<a href="Route_stop/stop_details/'.$list->route_id.'"><i class="fas fa-route fa-spin" style="font-size:30px;color:purple;"></i></a></button>';
		
		$startname = $this->db->query("SELECT Location_short_name as location_name FROM sch_location_list WHERE Location_Id='".$list->route_geo_start_id."'")->row();
        
		$endname = $this->db->query("SELECT Location_short_name as location_name FROM sch_location_list WHERE Location_Id='".$list->route_geo_end_id."'")->row();

        $edit = '<a href="javascript:edit('.$list->route_id.')" class="editroute"  id="'.$list->route_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
        
        $delete = '<a href="javascript:deletedata('.$list->route_id.')" id="'.$list->route_id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
        
		$stop_view = '<a href="Route/map_list/'.$list->route_id.'" class="showroute"><i class="fa fa-eye " aria-hidden="true"></i></a>';
        
		$excel_view = '<a href="Route/get_excel/'.$list->route_id.'" class="showexcel"><i class="fa fa-file " aria-hidden="true"></i></a>';

        $data[] = array(
                      'S No' =>$count++ ,
                      'route Name' =>$list->route_name,
                      'route Start Location' =>$startname->location_name,
                      'route End Location' =>$endname->location_name,
                      'route Start Time' =>$list->route_starttime,
                      'route End Time' =>$list->route_starttime,
					  'Number of stops' =>$routestop,
					  'Action' =>$edit.' '.$delete.' '.$stop_view.' '.$excel_view
					);
      }
            
      $results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
      
      echo json_encode($results);
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

	public function route_assign_list()
	{
		$routeassignlist = $this->Route_model->polyroute_assigndetails();

		$count = 1;
      foreach ($routeassignlist as $list) {
           
		$edit = '<a href="javascript:editdata('.$list->id.')" class="edit"  id="'.$list->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
        
        $delete = '<a href="javascript:deletedata('.$list->id.')" id="'.$list->id.'" class="delete"><i class="fa fa-trash " aria-hidden="true"></i></a>';
        
		if($list->shift_type==1){
			$shift="Morning Shift";
		}else{
			$shift="Evening Shift";
		}
		$data[] = array(
                      'S No' =>$count++,
                      'Vehicle' =>$list->vehiclename,
                      'Route Name' =>$list->route_name,
                      'Shift Type' =>$shift,
                      'Travel Start Date' =>$list->travel_startdate,
                      'Travel End Date' =>$list->travel_enddate,
					  'Action' =>$edit.' '.$delete
					);
      }
            
      $results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
      
      echo json_encode($results);
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
						  unset($data['late_status']);
						 $late_status = $this->input->post('late_status');
						  $late_status = ($late_status >= 1 ) ? 1 :0;
						 $data['late_status']=$late_status;
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



	public function deleterouteassign()
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


	public function map_list($id) 
	{

        $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
		$data['route_id'] = $id;
		$data['webnotification'] = $this->Smssend_model->webnotification();
		if($id)
		{
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/route/routemap_view',$data); 
			$this->load->view('components/footer/footerscript');
		    $this->load->view('components/footer/footer');
			
		}
		
		else
		{   $this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar',$data);
			$this->load->view('components/mainmenu',$accessmenu);
			$this->load->view('schooladmin/route/routemap_view',$data); 
			$this->load->view('components/footer/footerscript');
		    $this->load->view('components/footer/footer');
			
		}
	}


	public function routelatlngs()
	{
	    $route_id = $this->input->post('route_id');
		$route_latlng = $this->Route_model->route_latlng($route_id);	
		$stop_latlng = $this->Route_model->stop_latlng($route_id);
		$count=1;
		foreach ($stop_latlng as $slist) {

		 $student_count = $this->Route_model->student_stop_count($route_id,$slist->stop_id);
		 $stop_list[] = array('route_no' =>$count++,
			                  'stop_latlng' => $slist,
							  'student_count' =>$student_count) ;
		
		}			
		$latlngs = array(
			             'route_latlng' =>$route_latlng,
						 'stop_latlng' =>$stop_list);
						 
		echo json_encode($latlngs);					
 
	}
 


	public function stop_students()
	{
	     $route_id = $this->input->post('route_id');
		 $stopid = $this->input->post('stopid');
	     $stop_studentlist = $this->Route_model->stop_students($route_id,$stopid);
		
		echo json_encode($stop_studentlist);					
 
	}

	// public function get_excel($id)
	// {
	// 	$accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
	// 	$data['route_id'] = $id;
	// 	$data['webnotification'] = $this->Smssend_model->webnotification();

	// 	$data['excel'] = $this->Route_model->stopdetails_excel($id);
	// 	// echo"<pre>";
	// 	// print_r($data['excel']);die;

	// 	$this->load->view('components/header/headerscript');
	// 	$this->load->view('components/header/headernavbar',$data);
	// 	$this->load->view('components/mainmenu',$accessmenu);
	// 	$this->load->view('schooladmin/route/route_excel',$data); 
	// 	$this->load->view('components/footer/footerscript');
	// 	$this->load->view('components/footer/footer');
        
	// }

	public function get_excel($id)
	{
		$route_id = $id;
				
		$route_latlng = $this->Route_model->route_latlng($route_id);	
	
		$stop_latlng = $this->Route_model->stop_latlng($route_id);
		
		$count=0;
		foreach ($stop_latlng as $slist) {
			$count++;

			$student_count = $this->Route_model->student_stop_count($route_id,$slist->stop_id);
			
			$students = $this->Route_model->student_stop_data($route_id,$slist->stop_id);
			
			// print_r($students);
			foreach($students as $student)
			{
				$students_list[] = array(
					'route_no' =>$count,
					'student_name' => $student->student_name,
					'parent_name' => $student->parent_name,
					'class_name' => $student->class_name,
					'route_name' => $student->route_name,	
					'Location_short_name' =>$student->Location_short_name,
					'mobilenumber' => $student->mobilenumber,
					'alter_mobile' => $student->alter_mobile,
					'stop_arrival_time' => $student->stop_arrival_time,
					'area'=> $student->area,
					'Lat'=>$student->Lat,
					'Lng'=>$student->Lng

				);
			}
		
		}			
	      $data['students_list']= $students_list;				


		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('components/mainmenu',$accessmenu);
		$this->load->view('schooladmin/route/route_excel',$data); 
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
        
	}
 
 


}
