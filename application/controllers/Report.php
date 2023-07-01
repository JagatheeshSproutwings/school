<?php

error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

public function __construct()
{
	parent:: __construct();
    $this->load->model('report_model');
    $this->load->model('route_model');
    $this->load->model('Dashboardmodel');		
    $this->load->model('Smssend_model');
	$this->load->model('Polygon_model');		
}
 
public function index()
  {

 	$role = $this->session->userdata('roleid');

	if($this->session->userdata('userid')=='')
	{
		redirect('Login');
	}
	else
	{
		
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
//		$this->load->view('components/mainmenu');
		$this->load->view('reports/user_report');
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}
		
	}

	
	public function genericreport()
	{	
            $data['access_menu'] = $this->Dashboardmodel->access_menu();
            $data['vehicle_details']= $this->Dashboardmodel->vehicle_details();
             $data['fuel_vehicle']= $this->Dashboardmodel->fuel_vehicle();
            $data['geolocation_details'] = $this->Dashboardmodel->geolocation_details();
             $data['hublocation'] = $this->Dashboardmodel->hublocation_details();
			 $data['polygon_list'] = $this->Polygon_model->polygon_list();
            $data['alerttypes']= $this->Dashboardmodel->alert_type();
//===================Admin access====================== =========================           
            $executive_access=$this->Dashboardmodel->executiveaccess_previledge();
             $data['executive_access']=$executive_access;
             
           $data['vehicle_basic_report'] = $executive_access->trip_report + $executive_access->idle_report + $executive_access->parking_report + $executive_access->distance_report + $executive_access->over_spead_report + $executive_access->ac_report + $executive_access->alert_report;
           $data['vehicle_geo_report'] = $executive_access->geo_report + $executive_access->hub_report;
           $data['vehicle_engine_RPM_report'] = $executive_access->engine_rpm_report ;
           $data['vehicle_fuel_report'] = $executive_access->fuel_refill_drain_report+$executive_access->millage_report+$executive_access->fuel_comparision_report+$executive_access->fuel_consumption_eng_rpm;
           $data['auxilary_report'] = $executive_access->bucket_report+$executive_access->drum_rotational_report;
           $data['temperature_report'] = $executive_access->temperature_report;
           $data['vehicle_obd'] = $executive_access->obd_report;
            $data['ST_courier_route_report'] = $executive_access->ST_courier_route_report;

              if($executive_access->ST_courier_route_report)
           {
           	  $data['ST_courier_route_report'] = $executive_access->ST_courier_route_report;
           }
           else
           {
           	  $data['ST_courier_route_report'] = 0;
           }
        //    print_r($data);exit;
            if($executive_access->engine_rpm_report)
           {
           	  $data['vehicle_engine_RPM_report'] = $executive_access->engine_rpm_report;
           }
           else
           {
           	  $data['vehicle_engine_RPM_report'] = 0;
           }
            if($executive_access->vehicle_obd)
           {
           	  $data['vehicle_obd'] = $executive_access->vehicle_obd;
           }
           else
           {
           	  $data['vehicle_obd'] = 0;
           }


           if($executive_access->temperature_report)
           {
           	  $data['temperature_report'] = $executive_access->temperature_report;
           }
           else
           {
           	  $data['temperature_report'] = 0;
           }


            if($executive_access->auxilary_report)
           {
           	  $data['auxilary_report'] = $executive_access->auxilary_report;
           }
           else
           {
           	  $data['auxilary_report'] = 0;
           }


           if($executive_access->polygon_report)
           {
           	  $data['polygonreport'] = $executive_access->polygon_report;
           }
           else
           {
           	  $data['polygonreport'] = 0;
           }
         
          //  print_r($data);exit;
//===================Admin access=================================================
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
	//	$this->load->view('components/mainmenu',$accessmenu);
		$this->load->view('reports/generic_report',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

		public function livetrackreport()
	{
		if($this->session->userdata['client_id'] == '')
		{
			redirect('login/');
		}
		$data['title'] = "Report";
		$data['menu'] = 'Report';
		$data['menuItem'] = 'consolidate_report';

  $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();

		$travel_date = $this->input->post('travel_date'); 
		$shift_type =$this->input->post('shift_type'); 
		if ($travel_date=='') {

			 $travel_date = date('Y-m-d');
			 $shift_type =0; 
			
		}
		
		 $travel_time = strtotime($travel_date);
		 $travel_date = date('Y-m-d',$travel_time);
		$data['routetrip_report'] = '';

		$client_id = $this->session->userdata ['client_id'];
		
		if($travel_date!='')
		{
			
			$liveroute_list = $this->report_model->liveroute_list($travel_date,$shift_type);
			foreach ($liveroute_list as $list) 
			{

				$livestop_list = $this->report_model->livestop_list($list->live_routeid);
				$livestop_array = [];
				foreach ($livestop_list as $rvalue) 
				{

						$livestop_array[] = array(
								'stop_geo_id' => $rvalue->stop_geo_id,
								'stopplaned_entry' => $rvalue->stopplaned_entry,
								'stopplaned_exit' => $rvalue->stopplaned_exit,
								'stopentry_time' => $rvalue->stopentry_time,
								'stopexit_time' => $rvalue->stopexit_time,
								's_min' => $rvalue->s_min,
								'a_min' => $rvalue->a_min
					        );
					

					
				}

					$resultArray[] = array(
								'vehicle_name' => $list->vehicle_name,
								'vehicle_id' => $list->vehicle_id,
								'route_id' => $list->route_id,
								'live_routeid' => $list->live_routeid,
								'routename' => $list->routename,
								'route_startid' => $list->route_startid,
								'route_endid' => $list->route_endid,
								'route_planstart_time' => $list->route_planstart_time,
								'route_planend_time' => $list->route_planend_time,
								'route_exitime' => $list->route_exitime,
								'route_entry_time' => $list->route_entry_time,
								'livestop_array' =>$livestop_array
					        );
				
			}

			$nodata = $this->report_model->nodata_vehicles($travel_date);
			if(!empty($resultArray))
	    	{
				$data['livetrack_report'] = $resultArray;
				$data['nodata'] = $nodata;
				$this->session->set_flashdata('travel_date',$travel_date);
				$this->session->set_flashdata('shift_type',$shift_type);

				$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
				//$this->load->view('components/mainmenu',$accessmenu);
		    $this->load->view('reports/specific_report/livetrack_report',$data);
				$this->load->view('components/footer/footerscript');
			//	$this->load->view('components/footer/footer');
	    	}
	    	else
	    	{//exit();
	    		
	    		$this->session->set_flashdata('travel_date',$travel_date);
				$this->session->set_flashdata('shift_type',$shift_type);
	  		$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/livetrack_report',$data);
				$this->load->view('components/footer/footerscript');
			//	$this->load->view('components/footer/footer');
	    	}
    	}
    	else
	    {
	    	$this->session->set_flashdata('travel_date','');

			 	$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/livetrack_report',$data);
				$this->load->view('components/footer/footerscript');
			//	$this->load->view('components/footer/footer');
	    }

	}



public function consolidate_route_report()
	{
		if($this->session->userdata['client_id'] == '')
		{
			redirect('login/');
		}
		 $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();

		$travel_date = $this->input->post('travel_date'); 
		if ($travel_date=='') {

			 $travel_date = date('Y-m-d');
		}
		
		 $travel_time = strtotime($travel_date);
		 $travel_date = date('Y-m-d',$travel_time);


		$route_list = $this->route_model->route_details();
		$data['route_details'] = $route_list;
			
		$data['routetrip_report'] = '';

		$client_id = $this->session->userdata ['client_id'];
		
		if($travel_date!='')
		{
			
			$liveroute_list = $this->report_model->liveroute_list($travel_date);
			foreach ($liveroute_list as $list) 
			{

				$livestop_list = $this->report_model->livestop_list($list->live_routeid);
				$livestop_array = [];
				foreach ($livestop_list as $rvalue) 
				{

						$livestop_array[] = array(
								'stop_geo_id' => $rvalue->stop_geo_id,
								'stopplaned_entry' => $rvalue->stopplaned_entry,
								'stopplaned_exit' => $rvalue->stopplaned_exit,
								'stopentry_time' => $rvalue->stopentry_time,
								'stopexit_time' => $rvalue->stopexit_time,
								's_min' => $rvalue->s_min,
								'a_min' => $rvalue->a_min
					        );
					

					
				}

					$resultArray[] = array(
								'vehicle_name' => $list->vehicle_name,
								'routename' => $list->routename,
								'route_startid' => $list->route_startid,
								'route_endid' => $list->route_endid,
								'route_planstart_time' => $list->route_planstart_time,
								'route_planend_time' => $list->route_planend_time,
								'route_exitime' => $list->route_exitime,
								'route_entry_time' => $list->route_entry_time,
								'start_min' => $list->start_min,
								'end_min' =>$list->end_min,
								'livestop_array' =>$livestop_array
					        );
				
			}

		//	$nodata = $this->report_model->nodata_vehicles($travel_date);



//print_r($resultArray);exit;
			if(!empty($resultArray))
	    	{
				$data['routetrip_report'] = $resultArray;
					$data['nodata'] = $nodata;
				$this->session->set_flashdata('travel_date',$travel_date);
				$this->session->set_flashdata('route_id',$route_id);
				$this->session->set_flashdata('report_option',$report_option);
				$this->session->set_flashdata('route_name',$routefetch_data->route_name);
			  	$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/consolidate_route_report',$data);
				$this->load->view('components/footer/footerscript');
			//	$this->load->view('components/footer/footer');
	    	}
	    	else
	    	{//exit();
	    		$data['vehicle_id'] = $vehicle_id;
	    		$this->session->set_flashdata('travel_date',$travel_date);
				$this->session->set_flashdata('route_id',$route_id);
				$this->session->set_flashdata('report_option',$report_option);
				$this->session->set_flashdata('route_name','');
				$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/consolidate_route_report',$data);
				$this->load->view('components/footer/footerscript');
			//	$this->load->view('components/footer/footer');
	    	}
    	}
    	else
	    {
	    		$data['vehicle_id'] = $vehicle_id;
	    		$this->session->set_flashdata('travel_date','');
				$this->session->set_flashdata('route_id','');
				$this->session->set_flashdata('report_option','');
			 	$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/consolidate_route_report',$data);
				$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');
	    }

	}


	public function route_penalty_report()
	{
		if($this->session->userdata['client_id'] == '')
		{
			redirect('login/');
		}


		 $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();

		$travel_date = $this->input->post('travel_date'); 
		if ($travel_date=='') {

			 $travel_date = date('Y-m-d');
		}
		
		 $travel_time = strtotime($travel_date);
		 $travel_date = date('Y-m-d',$travel_time);


		$route_list = $this->route_model->route_details();
		$data['route_details'] = $route_list;
			
		$data['routetrip_report'] = '';

		$client_id = $this->session->userdata ['client_id'];
		
		if($travel_date!='')
		{
			
			$liveroute_list = $this->report_model->liveroute_list($travel_date);
			foreach ($liveroute_list as $list) 
			{

				$livestop_list = $this->report_model->livestop_list($list->live_routeid);
				$livestop_array = [];
				foreach ($livestop_list as $rvalue) 
				{

						$livestop_array[] = array(
								'stop_geo_id' => $rvalue->stop_geo_id,
								'stopplaned_entry' => $rvalue->stopplaned_entry,
								'stopplaned_exit' => $rvalue->stopplaned_exit,
								'stopentry_time' => $rvalue->stopentry_time,
								'stopexit_time' => $rvalue->stopexit_time,
								's_min' => $rvalue->s_min,
								'a_min' => $rvalue->a_min
					        );
					

					
				}

					$resultArray[] = array(
								'vehicle_name' => $list->vehicle_name,
								'routename' => $list->routename,
								'route_startid' => $list->route_startid,
								'route_endid' => $list->route_endid,
								'route_planstart_time' => $list->route_planstart_time,
								'route_planend_time' => $list->route_planend_time,
								'route_exitime' => $list->route_exitime,
								'route_entry_time' => $list->route_entry_time,
								'start_min' => $list->start_min,
								'end_min' =>$list->end_min,
								'livestop_array' =>$livestop_array
					        );
				
			}

		}

			if(!empty($resultArray))
	    	{
				$data['routetrip_report'] = $resultArray;
				$this->session->set_flashdata('travel_date',$travel_date);
				$this->session->set_flashdata('route_id',$route_id);
				$this->session->set_flashdata('report_option',$report_option);
				$this->session->set_flashdata('route_name',$routefetch_data->route_name);
			 	$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/route_penalty_report',$data);
				$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');
	    	}
	    	else
	    	{
	    		$data['vehicle_id'] = $vehicle_id;
	    		$this->session->set_flashdata('travel_date','');
				$this->session->set_flashdata('route_id','');
				$this->session->set_flashdata('report_option',$report_option);
				$this->session->set_flashdata('route_name','');
			 	$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/route_penalty_report',$data);
				$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');
	    	}
    	
    

	}


public function polygon_route_report()
	{

		$travel_date = $this->input->post('travel_date'); 
		 $route_id = $this->input->post('route_id');
		 $vehicle_id = $this->input->post('vehicle_id');
	  //	$report_option = $this->input->post('report_option');

		$travel_time = strtotime($travel_date);
		$travel_date = date('Y-m-d',$travel_time);
		$route_list = $this->route_model->route_details();
		$vehicle_list = $this->report_model->battery_vehicle();
		$data['route_details'] = $route_list;
		$data['vehicle_list'] = $vehicle_list;

		//print_r($route_list);exit;
		//$data['routetrip_report'] = '';

		$client_id = $this->session->userdata ['client_id'];
		
		if($route_id!='')
		{
		
			$routetrip_report = $this->report_model->polyroute_report_all($travel_date,$route_id,$vehicle_id);
		
			$trip_count = count($routetrip_report);
			$i= 1;
			foreach ($routetrip_report as $list) 
			{
			
				 $route_starttime =$list->start_route_intime; 
				 $route_endtime =$list->end_route_outtime;

				//$distance_data =  $this->report_model->distance_reportdata($list->deviceimei,$route_starttime,$route_endtime);
			//	$idle_report =  $this->report_model->idle_reportdata($list->deviceimei,$route_starttime,$route_endtime);
			//	$idle_duration =  gmdate("H:i:s", $idle_report);
				//print_r($idle_report);
			
				$route_stop = $this->report_model->polyroute_stop($list->route_id);
				
				$stopdata=array();
				foreach ($route_stop as $rvalue) 
				{

					$route_stop = $this->report_model->polyroute_stopreport($list->live_routeid,$rvalue->stop_geo_id);
					//print_r($route_stop);
					
					
					if($route_stop)
					{
							$stopdata[]=array('geo_name'=>$route_stop->stop_polygon_name,'total_dur' => $route_stop->total_dur,'stopexit_time'=>$route_stop->stopexit_time,'stopentry_time'=>$route_stop->stopentry_time,'stop_status'=>$route_stop->stop_status,'stop_geo_id'=>$rvalue->stop_geo_id);

						//print_r($stopdata);exit;
						
					}
					else
					{


						$stopdata[]=array('stopexit_time'=>'','total_dur' =>'','stopentry_time'=>'','stop_status'=>'0','stop_geo_id'=>$rvalue->stop_geo_id);
						
					}
				
					
				}
					
						
				$resultArray[] = array(
					            'start_odometer'=>$distance_data->start_odometer,
								'end_odometer'=>$distance_data->end_odometer,
								'distance'=>$distance_data->distance_km,
								'idle_duration'=>$idle_duration,
								'routetrip_data' => $list,
								'total_tripcount'=>$trip_count,
							 	'routestop_data' => $stopdata
					        );
							//print_r($resultArray);exit;

				$i++;
			}
			


			if(!empty($resultArray))
	    	{
				$data['routetrip_report'] = $resultArray;
				$this->session->set_flashdata('travel_date',$travel_date);
				$this->session->set_flashdata('route_id',$route_id);
				$this->session->set_flashdata('vehicle_id',$vehicle_id);
			//	$this->session->set_flashdata('report_option',$report_option);
			//	$this->session->set_flashdata('route_name',$routefetch_data->route_name);
			  	$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/polygon_route_report',$data);
				$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');
	    	}
	    	else
	    	{//exit();
	    		
	    		$this->session->set_flashdata('travel_date',$travel_date);
				$this->session->set_flashdata('route_id',$route_id);
				$this->session->set_flashdata('vehicle_id',$vehicle_id);
			//	$this->session->set_flashdata('report_option',$report_option);
				$this->session->set_flashdata('route_name','');
			  $this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/polygon_route_report',$data);
				$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');
	    	}
    	}
    	else
	    {
	    		
	    	$this->session->set_flashdata('travel_date','');
				$this->session->set_flashdata('route_id','');
				$this->session->set_flashdata('report_option','');
				$this->session->set_flashdata('vehicle_id','');
			  $this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
			//	$this->load->view('components/mainmenu',$accessmenu);
				$this->load->view('reports/specific_report/polygon_route_report',$data);
				$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');
	    }

	}



	
}
