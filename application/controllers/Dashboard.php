<?php

error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

public function __construct()
{
	parent:: __construct();
	if($this->session->userdata('userid')=='')
	{
		redirect('Login');
	}
    $this->load->model('Dashboardmodel');		
    $this->load->model('Smssend_model');
    $this->load->model('Executivereport_model');     
    $this->load->model('Smartreport_model');  
    $this->load->model('genericreport_model');       		
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
		$role = $this->session->userdata('roleid');
        $client_id = $this->session->userdata('client_id');


		if($role == '14')
		{
			$this ->dashboard();
    }
		if($role == '15')
		{
            
      $this ->home();

		}

    if($role == '17')
		{
			$this ->dealer_dashboard();

		}




	}
		
	}

	public function dashboard()
	{	
        // $customercomplaint= $this->Dashboardmodel->customer_complaint();
        // $data['total_device_count'] = $this->Dashboardmodel->total_device_count();
        // $data['vehicle_status_count'] = $this->Dashboardmodel->vehicle_status_count();


        // $data['customercomplaint'] = $customercomplaint;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('components/mainmenu');
		$this->load->view('Dashboard/dashboard');
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}
    public function dealer_dashboard()
	{	
      //    $customercomplaint= $this->Dashboardmodel->customer_complaint();
      //    $data['total_device_count'] = $this->Dashboardmodel->total_device_count();
      //    $data['vehicle_status_count'] = $this->Dashboardmodel->vehicle_status_count();
      //  // print_r($data);exit;
      //  $data['customercomplaint'] = $customercomplaint;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('components/mainmenu');
		$this->load->view('Dashboard/dashboard');
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

    public function dealer_data($dealer_id)
	{	
       
         $customercomplaint= $this->Dashboardmodel->customer_complaint();
         $details=  $this->Dashboardmodel->single_dealername($dealer_id);
      
            $vehicle_count = $this->Dashboardmodel->dealervehicle_count($dealer_id);
            $alldata =array('dealer_id' =>$details->dealer_id,
                                  'dealer_name' =>$details->dealer_name,
                                   'dealer_color' =>$details->dealer_color,
                                   'vehicle_count' =>$vehicle_count->vehiclecount,
                                   'customercount' =>$vehicle_count->customercount,
                                  'active' =>$vehicle_count->active,
                                  'nextdue' =>$vehicle_count->nextdue,
                              'deactive' =>$vehicle_count->deactive);
       
        $data['result'] = $alldata;
       
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('components/mainmenu');
		$this->load->view('Dashboard/dealer_dashboard',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

    public function subdealer_dashboard()
	{	
          $customercomplaint= $this->Dashboardmodel->customer_complaint();
          $data['total_device_count'] = $this->Dashboardmodel->total_device_count();
          $data['vehicle_status_count'] = $this->Dashboardmodel->vehicle_status_count();
        // $deactive_vehicle_count = $this->Dashboardmodel->deactive_vehicle_count();
        // $subcribe_yr_count = $this->Dashboardmodel->subcribe_yr_count();
        // $data['total_device_count'] = $this->Dashboardmodel->total_device_count();
        // $data['vehicle_status_count'] = $this->Dashboardmodel->vehicle_status_count();
        //print_r($data);exit;
        //$data['customercomplaint'] = $customercomplaint;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('components/mainmenu');
		$this->load->view('Dashboard/dashboard',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

	public function userdashboard()
	{	
//   $areasplinechart= $this->Dashboardmodel->areasplinechart();  
//            foreach ($areasplinechart as $value) {
//                $data2[] = $value;
//            }
//            $data['odomet'] = json_encode($data2);
     	$all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
        $vehicle_details= $this->Dashboardmodel->vehicle_details();
        $data['moving_vehicle']= $this->Dashboardmodel->moving_vehicle();
        $data['idle_vehicle']= $this->Dashboardmodel->idle_vehicle();
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
      //  print_r($data);exit;
        $data['parking_vehicle']= $this->Dashboardmodel->parking_vehicle();
        $data['ooc_vehicle']= $this->Dashboardmodel->ooc_vehicle();
        //$data['access_menu'] = $this->Dashboardmodel->access_menu();
        $data['vehicle_details'] = $vehicle_details;
        $data['all_vehicle_loc'] = $all_vehicle_loc;
        $data['webnotification'] = $this->Smssend_model->webnotification(); 
         //print_r($data);exit;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('Dashboard/user_dashboard/user_dashboard',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}


    public function home()
	{	
		 $vehicle_details= $this->Dashboardmodel->vehicle_details();
		 $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();

	     $data['vehicle_details'] = $vehicle_details;
	     $data['all_vehicle_loc'] = $all_vehicle_loc;
	     $data['webnotification'] = $this->Smssend_model->webnotification();
             
         $data['access_menu'] = $this->Dashboardmodel->access_menu();


         $consolidate_data = $this->Dashboardmodel->consolidatedata();

         $data['distance'] = round($consolidate_data->distance,1);
         $data['milege'] = ($consolidate_data->distance && $consolidate_data->fuel_consumed_litre) ? round($consolidate_data->distance/$consolidate_data->fuel_consumed_litre,1) : '';
        //  $data['milege'] = round($consolidate_data->distance/$consolidate_data->fuel_consumed_litre,1);
         $data['fuel_fill_litre'] = round($consolidate_data->fuel_fill_litre,1);
         $data['fuel_dip_litre'] = $consolidate_data->fuel_dip_litre;
         $data['fuel_consumed_litre'] = round($consolidate_data->fuel_consumed_litre,1);
         $data['moving_duration'] = $this->converthmi($consolidate_data->moving_duration);
         $data['idle_duration'] =$this->converthmi($consolidate_data->idle_duration);
         $data['parking_duration'] = $this->converthmi($consolidate_data->parking_duration);
         $data['ac_duration'] = $this->converthmi($consolidate_data->ac_duration);

         $data['totalrpm'] = $this->converthmi_rpm($consolidate_data->totalrpm);

       //  print_r($data);exit;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar', $data);
		$this->load->view('components/mainmenu',$data);
		$this->load->view('Dashboard/home',$data);
		$this->load->view('components/footer/footerscript');
		// $this->load->view('components/footer/footer');
	}

    
    public function consolidatedata()
	{	
		

         $vehicle = $this->input->post('vehicle');
         $from_date = $this->input->post('from_date');
         $to_date = $this->input->post('to_date');
         $consolidate_data = $this->Dashboardmodel->consolidatedata_json($vehicle,$from_date,$to_date);

         $data['distance'] = round($consolidate_data->distance,1);
         $data['milege'] = round($consolidate_data->distance/$consolidate_data->fuel_consumed_litre,1);
         $data['fuel_fill_litre'] = round($consolidate_data->fuel_fill_litre,1);
         $data['fuel_dip_litre'] = $consolidate_data->fuel_dip_litre;
         $data['fuel_consumed_litre'] = round($consolidate_data->fuel_consumed_litre,1);
         $data['moving_duration'] = $this->converthmi($consolidate_data->moving_duration);
         $data['idle_duration'] =$this->converthmi($consolidate_data->idle_duration);
         $data['parking_duration'] = $this->converthmi($consolidate_data->parking_duration);
         $data['ac_duration'] = $this->converthmi($consolidate_data->ac_duration);
         $data['totalrpm'] = $this->converthmi_rpm($consolidate_data->totalrpm);

         echo json_encode($data);
	}


    public function converthmi($value)
    {
       
        $duration=$value;//Parking Duration
        $hours = floor($duration / 60);
        $min = $duration - ($hours * 60); 
        $second = $duration % 60;
      return  $tot_value=$hours.":".$min.":".$second;

    }

    public function converthmi_rpm($value)
    {
       
        $load_rpm_duration=$value;//Load RPM Duration
        $hours = floor($load_rpm_duration / 3600);
         $min = ($load_rpm_duration / 60) % 60;
         $second = $load_rpm_duration % 60;
         return  $tot_loadrpm=$hours.":".$min.":".$second;
    }

    public function mapview()
	{	
//   $areasplinechart= $this->Dashboardmodel->areasplinechart();  
//            foreach ($areasplinechart as $value) {
//                $data2[] = $value;
//            }
//            $data['odomet'] = json_encode($data2);
     	  $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
        $vehicle_details= $this->Dashboardmodel->vehicle_details();
        $data['moving_vehicle']= $this->Dashboardmodel->moving_vehicle();
        $data['idle_vehicle']= $this->Dashboardmodel->idle_vehicle();
      //  print_r($data);exit;
        $data['parking_vehicle']= $this->Dashboardmodel->parking_vehicle();
        $data['ooc_vehicle']= $this->Dashboardmodel->ooc_vehicle();
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
        $data['vehicle_details'] = $vehicle_details;
        $data['all_vehicle_loc'] = $all_vehicle_loc;
        $data['webnotification'] = $this->Smssend_model->webnotification(); 
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
         //print_r($data);exit;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('Dashboard/user_dashboard/user_mapview',$data);
		$this->load->view('components/footer/footerscript');
//		$this->load->view('components/footer/footer');
	}

  public function google_mapview()
	{	
     	$all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
        $vehicle_details= $this->Dashboardmodel->vehicle_details();
        $data['moving_vehicle']= $this->Dashboardmodel->moving_vehicle();
        $data['idle_vehicle']= $this->Dashboardmodel->idle_vehicle();
        $data['parking_vehicle']= $this->Dashboardmodel->parking_vehicle();
        $data['ooc_vehicle']= $this->Dashboardmodel->ooc_vehicle();
        $data['vehicle_details'] = $vehicle_details;
        $data['all_vehicle_loc'] = $all_vehicle_loc;
        $data['webnotification'] = $this->Smssend_model->webnotification(); 
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('Dashboard/user_dashboard/googlemap/user_gmapview',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

  
	public function tableview()
	{	
//   $areasplinechart= $this->Dashboardmodel->areasplinechart();  
//            foreach ($areasplinechart as $value) {
//                $data2[] = $value;
//            }
//            $data['odomet'] = json_encode($data2);
     	$all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
        $vehicle_details= $this->Dashboardmodel->vehicle_details();
        $data['moving_vehicle']= $this->Dashboardmodel->moving_vehicle();
        $data['idle_vehicle']= $this->Dashboardmodel->idle_vehicle();
      //  print_r($data);exit;
        $data['parking_vehicle']= $this->Dashboardmodel->parking_vehicle();
        $data['ooc_vehicle']= $this->Dashboardmodel->ooc_vehicle();
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
        $data['vehicle_details'] = $vehicle_details;
        $data['all_vehicle_loc'] = $all_vehicle_loc;
        $data['webnotification'] = $this->Smssend_model->webnotification(); 
         //print_r($data);exit;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('Dashboard/user_dashboard/user_tableview',$data);
		$this->load->view('components/footer/footerscript');
//		$this->load->view('components/footer/footer');
	}
	public function reports()
	{	
//   $areasplinechart= $this->Dashboardmodel->areasplinechart();  
//            foreach ($areasplinechart as $value) {
//                $data2[] = $value;
//            }
//            $data['odomet'] = json_encode($data2);
     	$all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
        $vehicle_details= $this->Dashboardmodel->vehicle_details();
        $data['moving_vehicle']= $this->Dashboardmodel->moving_vehicle();
        $data['idle_vehicle']= $this->Dashboardmodel->idle_vehicle();
      //  print_r($data);exit;
        $data['parking_vehicle']= $this->Dashboardmodel->parking_vehicle();
        $data['ooc_vehicle']= $this->Dashboardmodel->ooc_vehicle();
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
        $data['vehicle_details'] = $vehicle_details;
        $data['all_vehicle_loc'] = $all_vehicle_loc;
        $data['webnotification'] = $this->Smssend_model->webnotification(); 
         //print_r($data);exit;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('Dashboard/user_dashboard/user_reports',$data);
		$this->load->view('components/footer/footerscript');
//		$this->load->view('components/footer/footer');
	}
	public function graph()
	{	
//   $areasplinechart= $this->Dashboardmodel->areasplinechart();  
//            foreach ($areasplinechart as $value) {
//                $data2[] = $value;
//            }
//            $data['odomet'] = json_encode($data2);
     	$all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
        $vehicle_details= $this->Dashboardmodel->vehicle_details();
        $data['moving_vehicle']= $this->Dashboardmodel->moving_vehicle();
        $data['idle_vehicle']= $this->Dashboardmodel->idle_vehicle();
      //  print_r($data);exit;
        $data['parking_vehicle']= $this->Dashboardmodel->parking_vehicle();
        $data['ooc_vehicle']= $this->Dashboardmodel->ooc_vehicle();
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
        $data['vehicle_details'] = $vehicle_details;
        $data['all_vehicle_loc'] = $all_vehicle_loc;
        $data['webnotification'] = $this->Smssend_model->webnotification(); 
         //print_r($data);exit;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
		$this->load->view('Dashboard/user_dashboard/user_graph',$data);
		$this->load->view('components/footer/footerscript');
//		$this->load->view('components/footer/footer');
	}

    public function totaldevice($id=null){
        // echo $id;die;
        $customercomplaint= $this->Dashboardmodel->customer_complaint();
        $data['customercomplaint'] = $customercomplaint;
       $result['data'] = $this->Dashboardmodel->totaldevice($id);
        $this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
        $this->load->view('components/mainmenu');
        $this->load->view('Dashboard/totaldevice',$result);
        $this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
    }

    public function vehicle_status($id=null)  {
        $customercomplaint= $this->Dashboardmodel->customer_complaint();
        $data['customercomplaint'] = $customercomplaint;
        $result['data'] = $this->Dashboardmodel->vehicle_status($id);
        $this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
        $this->load->view('components/mainmenu');
        $this->load->view('Dashboard/vehicle_status',$result);
        $this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
    }

    public function activate_vehicle(){
        $id = $this->input->post('id');
        $ids = implode(',', $id);
        $result = $this->Dashboardmodel->activate($ids);
        echo json_encode($result);
      }
      public function deactivate_vehicle(){
        $id = $this->input->post('id');
        $ids = implode(',', $id);
       $result = $this->Dashboardmodel->deactivate($ids);
        echo json_encode($result);

      }
      
    public function tw_totaldevice($id=null){
        $customercomplaint= $this->Dashboardmodel->customer_complaint();
        $data['customercomplaint'] = $customercomplaint;
       $result['data'] = $this->Dashboardmodel->tw_totaldevice($id);
        $this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
        $this->load->view('components/mainmenu');
        $this->load->view('Dashboard/totaldevice',$result);
        $this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
    }


    public function totalcustomers($id=null,$dealer_id=null){
       
        $customercomplaint= $this->Dashboardmodel->customer_complaint();
        $data['customercomplaint'] = $customercomplaint;
        $data['result'] = $this->Dashboardmodel->customer_details($id,$dealer_id);
        $this->load->view('components/header/headerscript');
        $this->load->view('components/header/headernavbar',$data);
        $this->load->view('components/mainmenu');
        $this->load->view('Dashboard/customer_details',$data);
        $this->load->view('components/footer/footerscript');
        $this->load->view('components/footer/footer');
    }
    public function dealertotalvehicles($id=null,$dealer_id=null){
        
          
        $customercomplaint= $this->Dashboardmodel->customer_complaint();
        $data['customercomplaint'] = $customercomplaint;
        $data['d_result'] = $this->Dashboardmodel->dealervehicles($id,$dealer_id);
       // print_r($data);exit;
        $this->load->view('components/header/headerscript');
        $this->load->view('components/header/headernavbar',$data);
        $this->load->view('Dashboard/dealerdevices',$data);
        $this->load->view('components/footer/footerscript');
        $this->load->view('components/footer/footer');
      

    }

     public function  allvehicle_count()
    {
      
         $allvehicle_count= $this->Dashboardmodel->allvehicle_count();


        echo json_encode($allvehicle_count);
    }

 public function  all_vehicle_loc($v_status =null)
    {
      
         $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc($v_status);


        echo json_encode($all_vehicle_loc);
    }

    function single_vehicle_loc($id){
		
		$result = $this->Dashboardmodel->single_vehicle_data($id);// get vehicle data from vehicle table 
        
        if($result->odometer==''){ $odo = 0;}else{$odo = $result->odometer;}
    
        //$trip_km = $this->Singledashboard_model->trip_km_data($id);
        $ct = date('Y-m-d');
        $start_date = $ct. ' 00:00:00';
        $end_date = $ct. ' 23:59:59';
        $device_type = $result->device_type;
       $today_km = $this->Dashboardmodel->smart_distanceday($result->deviceimei,$start_date,$end_date,$device_type);
       $todaykm =  $today_km->distance_km;
        //$todaykm = '';

        $vehicle_shortname = $this->Dashboardmodel->vehicle_shortname($result->vehicletype);
       
        $real_odo = 0; 

        $engine_speed='';

        $coolant_level='';

        $engine_load='';

        $coolant_temperature='';

        $lut='';

        if($result->device_config_type==2)
        {

        $r_query = $this->db->query("SELECT * FROM gnx_aj1939 WHERE vehicle_imei='".$result->deviceimei."' AND high_resolution_vehicle_distance_917!=0 AND high_resolution_vehicle_distance_917 NOT LIKE '21%' ORDER BY logged_datetime DESC LIMIT 1");

        $r_odo = $r_query->row();

        $real_odo = round($r_odo->high_resolution_vehicle_distance_917,2);

        $engine_speed=$r_odo->electronic_engine_speed_190." RPM";

        $coolant_level=$r_odo->coolant_level_111." %";

        $engine_load=$r_odo->percentage_of_engine_load_92." %";

        $coolant_temperature=$r_odo->coolant_temperature_110." DegC";

        $lut=$r_odo->current_datetime;


        }

     //   $today_km =0;

        $data = array('mdvr_terminal_no'=>$result->mdvr_terminal_no,'client_id'=>$result->client_id,
                     'internal_battery_voltage'=>$result->internal_battery_voltage,'vehicle_sleep'=>$result->vehicle_sleep,
                     'device_type'=>$result->device_type,'engine_speed'=>$engine_speed, 'coolant_level'=>$coolant_level,
                     'engine_load'=>$engine_load,'coolant_temperature'=>$coolant_temperature,'lut'=>$lut,
                     'real_odo'=>$real_odo,'lat'=>round($result->lat,5),'lng'=>round($result->lng,5),'driver_name'=>$result->driver_name,
                     'angle'=>$result->angle,'vehicleid'=>$result->vehicleid,'vehicle_number'=>$result->vehiclename,
                     'vehicle_register_number'=>$result->vehiclename,'vehiclename'=>$result->vehiclename,
                     'vehicle_model'=>$result->vehicletype,'speed'=>$result->speed,'updatedon'=>$result->updatedon,'update_time'=>$result->update_time,
                      'last_dur'=>$result->last_dur,'no_last_dur'=>$result->no_last_dur,'lat'=>$result->lat,'lng'=>$result->lng,
                      'acc_on'=>$result->acc_on,'acc_flag'=>$result->acc_flag,'acc_date_time'=>$result->acc_date_time,
                      'ac_flag'=>$result->ac_flag,'ac_date'=>$result->ac_date,'ac_km'=>$result->ac_km,'odometer'=>$odo,
                      'kilometer'=>round($result->today_km,3),'today_km'=>$todaykm,'litres'=>round($result->litres,2),
                      'fuel_tank_capacity'=>$result->fuel_tank_capacity,'temperature'=>$result->temperature,
                      'car_battery'=>$result->car_battery,'device_battery'=>$result->device_battery,'device_charge_status'=>$result->device_charge_status,
                      'vehicle_type'=>$result->vehicletype,'vehicle_shortname'=>$vehicle_shortname,'hub_ETA'=>$result->hub_ETA,'DTE'=>$result->DTE,'device_config_type'=>$result->device_config_type,
                      'hourmeter'=>$result->hourmeter,'today_hourmeter'=>$result->today_hourmeter,'altitude'=>$result->altitude,'gpssignal'=>$result->gpssignal,
                     'gsmsignal'=>$result->gsmsignal,'latlon_address'=>$result->latlon_address);    

        // Play Back data
if($result->deviceimei){
  $imei = $result->deviceimei;
  $path_start_date = date("Y-m-d H:i:s",strtotime('-10 minutes'));
  $path_end_date = date("Y-m-d H:i:s");
  $data['playback_data'] = $this->genericreport_model->get_all_history_data($imei,$path_start_date,$path_end_date);	
  }else{
    $data['playback_data'] = array();
  }
if ($data) {

  echo json_encode($data); //convert to json format for ajax call
} else {
  echo 'false';
}
   }

		
         public function alert_data($id) {

         	        $vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;

            $alertdata= $this->Dashboardmodel->alert_data($deviceimei);
            
            echo json_encode($alertdata);
        }



        public function all_fuel_data() {
            $areasplinechart= $this->Dashboardmodel->areasplinechart();
             foreach ($areasplinechart as $value) {
                $data2[] = $value;
            }
            echo json_encode($data2);
        }
        public function all_mixed_data() {

        		$id = $this->input->post('vehicle');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;


            $areasplinechart= $this->Dashboardmodel->areasplinechart($deviceimei);
             foreach ($areasplinechart as $value) {
                $data6[] = $value;
            }
            echo json_encode($data6);
        }
        public function all_distance_data() {

        	$id = $this->input->post('vehicle');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;

            $distancechart= $this->Dashboardmodel->distancechart($deviceimei);
             foreach ($distancechart as $value) {
                $data2[] = $value;
            }
            echo json_encode($data2);
        }
        public function all_parking_data() {

        		$id = $this->input->post('vehicle');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;


            $parkingchart= $this->Dashboardmodel->parkingchart($deviceimei);
             foreach ($parkingchart as $value) {
                $data3[] = $value;
            }
            echo json_encode($data3);
        }
        public function all_trip_data() {

        		$id = $this->input->post('vehicle');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;


            $tripchart= $this->Dashboardmodel->tripchart($deviceimei);
             foreach ($tripchart as $value) {
                $data4[] = $value;
            }
            echo json_encode($data4);
        }
        public function all_idle_data() {

        		$id = $this->input->post('vehicle');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;


            $idlechart= $this->Dashboardmodel->idlechart($deviceimei);
             foreach ($idlechart as $value) {
                $data5[] = $value;
            }
            echo json_encode($data5);
        }
        public function trackplusworkspace() {
            $from_Date = $this->input->post('from_Date');
            $to_Date = $this->input->post('to_Date');
            $vehicleid = $this->input->post('vehicle');
            $radioValue = $this->input->post('radioValue');
            $track_workspace= $this->Dashboardmodel->track_workspace();
             foreach ($track_workspace as $value) {
                $data6[] = $value;
            }
            echo json_encode($data6);
        }
        public function engine_rpm_data() {

           	$id = $this->input->post('vehicle');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;
           // $radioValue = $this->input->post('radioValue');
             
            $enginerpm_data= $this->Dashboardmodel->enginerpm_data($deviceimei);
             foreach ($enginerpm_data as $value) {
                $data7[] = $value;
            }
             echo json_encode($data7);
        }

            public function current_distance_data() {

                 $yesterday_distance = $this->Dashboardmodel->yesterday_distanceday();
                  
            
                    echo json_encode($yesterday_distance);
        }


        public function all_reports_data() {

                    $client_id = $this->session->userdata('client_id');
                    $all_vehicle_data = $this->Dashboardmodel->all_vehicles();
                    $date = date('Y-m-d',strtotime('-1 day'));
                    foreach ($all_vehicle_data as $list) {

                    $yesterday_park = $this->Dashboardmodel->consolidate_parkday($list->deviceimei,$date);
                    $yesterday_idle = $this->Dashboardmodel->consolidate_idleday($list->deviceimei,$date);
                    $yesterday_ign = $this->Dashboardmodel->consolidate_ignday($list->deviceimei,$date);

                        $park_duration=$yesterday_park;       // Idle Duration
                        $hours = floor($park_duration / 60);
                        $min = $park_duration - ($hours * 60); 
                        $second = $park_duration % 60;
                        $tot_park=$hours.".".$min;

                         $idle_duration=$yesterday_idle;       // Idle Duration
                        $hours = floor($idle_duration / 60);
                        $min = $idle_duration - ($hours * 60); 
                        $second = $idle_duration % 60;
                        $tot_idle=$hours.".".$min;

                         $ign_duration=$yesterday_ign;       // Idle Duration
                        $hours = floor($ign_duration / 60);
                        $min = $ign_duration - ($hours * 60); 
                        $second = $ign_duration % 60;
                        $tot_ign=$hours.".".$min;


                     $park_data[]=$tot_park;
                     $idle_data[]=$tot_idle;
                     $ign_data[]=$tot_ign;
                     $vehicle_data[] = $list->vehiclename;
                    }

                $data = array('park_data' =>$park_data ,
                              'idle_data' =>$idle_data ,
                              'ign_data' =>$ign_data ,
                              'vehicle_data' =>$vehicle_data);
            
         echo json_encode($data);
        }
 
       public function fuelgraph() {
            $vehicle_details= $this->Dashboardmodel->fuel_vehicles();
            $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
	    $data['vehicle_details'] = $vehicle_details;
	    $data['all_vehicle_loc'] = $all_vehicle_loc;
	    $data['webnotification'] = $this->Smssend_model->webnotification();
		$data['access_menu'] = $this->Dashboardmodel->access_menu();
		
         $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
       //  print_r($data);exit;
	   
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar', $data);
		// $this->load->view('components/mainmenu',$accessmenu);
		$this->load->view('Dashboard/fuelgraph',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
        }
		public function graph_analysis() {
            $vehicle_details= $this->Dashboardmodel->fuel_vehicles();
            $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
            
            $vehicle_tempdetails= $this->Dashboardmodel->temp_vehicles();
            $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
            
	    $data['vehicle_details'] = $vehicle_details;
	    $data['vehicle_temperature'] = $vehicle_tempdetails;
	    $data['all_vehicle_loc'] = $all_vehicle_loc;
	    $data['webnotification'] = $this->Smssend_model->webnotification();
		$data['access_menu'] = $this->Dashboardmodel->access_menu();
		
         $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();
       //  print_r($data);exit;
	   
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar', $data);
		// $this->load->view('components/mainmenu',$accessmenu);
		// $this->load->view('Dashboard/fuelgraph',$data);
		$this->load->view('Dashboard/graph_analysis',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
        }

         public function fuel_graph_data_old() {

            $id = $this->input->post('vehicle');
            $fromdate = $this->input->post('from_Date');
            $todate = $this->input->post('to_Date');
            $vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;


            $areasplinechart= $this->Dashboardmodel->fuel_graph_data($deviceimei,$fromdate,$todate);
             foreach ($areasplinechart as $value) {
                $data6[] = $value;
            }
            echo json_encode($data6);
        }

        function fuel_graph_data()
        {
    
            $id = $this->input->post('vehicle');
            $fromdate = $this->input->post('from_Date');
            $todate = $this->input->post('to_Date');
            $vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
            $vehicle_info = $vehicle_detail->row();
            $deviceimei = $vehicle_info->deviceimei;
    
              $fuel_value = $this->Dashboardmodel->Fuel_report_list($fromdate,$todate,$deviceimei);
          
          $fuel_value1 = $this->Dashboardmodel->Fuel_smooth_data($fromdate,$todate,$deviceimei);
    
            foreach ($fuel_value as $list) {
    
                $speed[]=$list->speed;
                $modified_date[] = $list->modified_date;
                $litres[]=$list->litres;
                $distance[]=$list->distance;
            }
            foreach ($fuel_value1 as $slist) {
    
                $smooth_ltr[]=$slist->litres;
                $smooth_date[]= $slist->modified_date;
            }
            
    
          $all_fuel_data = array('speed' =>$speed,
                                  'modified_date' =>$modified_date,
                                  'litres' =>$litres,
                                  'distance' =>$distance,
                                  'smooth_litres' =>$smooth_ltr,
                                  'smooth_date' =>$smooth_date
                                   );
        
            if($all_fuel_data)	
            {
                echo json_encode($all_fuel_data);
    
            }
          
        }
    
        public function tempgraph() {
            $vehicle_details= $this->Dashboardmodel->temp_vehicles();
            $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();
	    $data['vehicle_details'] = $vehicle_details;
	    $data['all_vehicle_loc'] = $all_vehicle_loc;
	    $data['webnotification'] = $this->Smssend_model->webnotification();
             
         $data['access_menu'] = $this->Dashboardmodel->access_menu();
       //  print_r($data);exit;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar', $data);
		$this->load->view('components/mainmenu',$data);
		$this->load->view('Dashboard/tempgraph',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
        }

          
        function temp_graph_data()
        {
    
            $id = $this->input->post('vehicle');
            $fromdate = $this->input->post('from_Date');
            $todate = $this->input->post('to_Date');
            $vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
            $vehicle_info = $vehicle_detail->row();
            $deviceimei = $vehicle_info->deviceimei;
    
              $temp_value = $this->Dashboardmodel->temp_graph_data($fromdate,$todate,$deviceimei);
            if($temp_value)	
            {
                echo json_encode($temp_value);
    
            }
            else
            {
                echo json_encode(false);
            }
          
        }

        public function  polygon_list()
        {
            $client_id = $this->session->userdata('client_id');
          
             $polygon_list= $this->Dashboardmodel->polygon_list($client_id);
           
          //  print_r($polygon_list);exit;
             foreach ($polygon_list as $list) 
             {
    
               $implode_data =  explode(" ",$list->polygon_points);
                $polypoints=[];
               foreach ($implode_data as $key ) {
    
                  $polypoint =  explode(",",$key);
                   $polypoints[] = array('lat' => $polypoint[0],
                                        'lng' => $polypoint[1]);
               } 
    
                $polygon_data[] = array('polygon_name' =>$list->polygon_name,
                                      'polypoints' =>$polypoints,
                                       'color' =>$list->polygon_color,
                                        'fillcolor' =>$list->polygon_fillcolor );
    
             }
                 //print_r($polygon_data);exit;  
               
           //  print_r($implode_data);
             echo json_encode($polygon_data);
        }

        
                  
        function running_high_graph()
        {
    
            $client_id = $this->session->userdata('client_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
          
           
               $running_high_graph = $this->Dashboardmodel->running_high_graph($from_date,$to_date);

                $n = count($running_high_graph);
                $low_vehicle_move= $this->converthmi($running_high_graph[0]->total_move);
                $high_vehicle_move= $this->converthmi($running_high_graph[$n-1]->total_move);


                                    $data['low_vehicle'] = array('tot_move' => $low_vehicle_move, 
                                   'vehicle_register_number' => $running_high_graph[0]->vehicle_register_number);

                                   $data['high_vehicle'] = array('tot_move' => $high_vehicle_move, 
                                   'vehicle_register_number' => $running_high_graph[$n-1]->vehicle_register_number);

              echo json_encode($data);
    
           
        }

        public function graph_map_analysis() {
            
             $data['vehicle_details']= $this->Dashboardmodel->vehicle_details();
            $data['webnotification'] = $this->Smssend_model->webnotification();
            $data['access_menu'] = $this->Dashboardmodel->access_menu();
            $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();

    $this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar', $data);
		$this->load->view('Dashboard/graph_map_analysis',$data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
                
        }
        
         public function  get_allvehicles()
        {
          
             $all_vehicle_loc= $this->Dashboardmodel->all_vehicle_loc();

             $count = 1;
             foreach ($all_vehicle_loc as $list) {

                        $v_u_time = $list->update_time;
                        $v_acc_on = $list->acc_on;
                        $v_speed = $list->speed;

                         switch($list->vehicle_type) {//get vehicle type
        
                        case '1':
                          $image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
                          break;
                        case '2':             
                          $image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
                          break;
                        case '3':
                          $image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                          break;
                        case '4':
                          $image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
                          break;
                        case '5':
                          $image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                          break;
                        default:
                          $image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
        
                      }
        
                      $vehicle_sleep =$list->vehicle_sleep;
        
                        if($v_u_time <= 10 && ($list->updatedon))
                        {
                          if($vehicle_sleep==3)
                          {
                              $image = '<span style="color:#147fc7" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'</span>&nbsp;';
                             
                          }
                          else if($v_acc_on == 1)
                          {
                            if($v_speed >0)
                            {
                                 if($list->device_type == 2 || $list->device_type == 4 || $list->device_type == 6 || $list->device_type == 7 || $list->device_type == 10 || $list->device_type == 11 || $list->device_type == 12 || $list->device_type == 13 || $list->device_type == 14 || $list->device_type == 15 )
                                {
                                  $image = '<span style="color:green" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                 
                                }
                                else
                                {
                                 $image = '<span style="color:green" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'</span>&nbsp;';
                              
                                }
                            }else{
        
                                 if($list->device_type == 2 || $list->device_type == 4 || $list->device_type == 6 || $list->device_type == 7 || $list->device_type == 10 || $list->device_type == 11 || $list->device_type == 12 || $list->device_type == 13 || $list->device_type == 14 || $list->device_type == 15 )
                                {
                                  $image = '<span style="color:#fabf2c" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                 
                                }
                                else
                                {
                                  $image ='<span style="color:#fabf2c" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'</span>&nbsp;'; 
                                
                                }
                              
                            }
                          }else
                          {
                            if($list->device_type == 2 || $list->device_type == 4 || $list->device_type == 6 || $list->device_type == 7 || $list->device_type == 10 || $list->device_type == 11 || $list->device_type == 12 || $list->device_type == 13 || $list->device_type == 14 || $list->device_type == 15 )
                            {
                              $image = '<span style="color:blue" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           
                            }
                            else
                            {
                             $image = '<span style="color:blue" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'</span>&nbsp;'; 
                            
                            }
                             
                          }
                          //alert('hi');
                        }else
                        {
                             if($list->device_type == 2 || $list->device_type == 4 || $list->device_type == 6 || $list->device_type == 7 || $list->device_type == 10 || $list->device_type == 11 || $list->device_type == 12 || $list->device_type == 13 || $list->device_type == 14 || $list->device_type == 15 )
                                {
                                  $image = '<span style="color:#a89e9e" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                 
                                }
                                else
                                {
                                    $image = '<span style="color:#a89e9e" id="vehicle_icon_'.$list->vehicleid.'">'.$image_path.'</span>&nbsp;';
                                  
                                }
                         
                        }
                       $img_cont = $image; 
                      if($list->updatedon){$update_valu = $list->updatedon;}else{$update_valu ='____:__:__ __:__:__';}

                    $vehiclename = "<p style='margin-bottom:0px' id='single_vehiclename_".$list->vehicleid."'>$list->vehiclename</p>
                      <small id='updatedtime_".$list->vehicleid."'>$update_valu</small>";

                      $action = '<div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                      <div class="btn-group" role="group">
                          <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="font-size: 10px;">
                              <a class="dropdown-item" href="Genericreport/playback" style="padding-left: 10px;"><i class="fa fa-play"></i>&nbsp;Playback</a>
                              <a class="dropdown-item" href="component-buttons-extended.html" style="padding-left: 10px;"><i class="fa fa-share-alt"></i>&nbsp; Share position</a>
                          </div>
                      </div>
                  </div>';
                
                  
            //    $data[] = array(
            //                  "DT_RowId"=> "row_7",
            //                    "DT_RowClass"=> "gradeA",
            //                  'image' =>$image ,
            //                  'vehiclename' =>$vehiclename,
            //                  'action' => $action);

            // "DT_RowId": "row_7",
            // "DT_RowClass": "gradeA",
            // "0": "Gecko",
            // "1": "Firefox 1.0",
            // "2": "Win 98+ / OSX.2+",
            // "3": "1.7",
            // "4": "A"
            
            //  }

                   $data[] = array(
                             "DT_RowId"=>$list->vehicleid,
                               "DT_RowClass"=>$list->vehiclename,
                             'image' =>$image ,
                             'vehiclename' =>$vehiclename,
                             'action' => $action);
            
             }
             $results = array(
               "sEcho" => 1,
             "iTotalRecords" => count($data),
             "iTotalDisplayRecords" => count($data),
               "aaData"=>$data);
             
             echo json_encode($results);
        }
	
        public function workspace_details() {
        $data['webnotification'] = $this->Smssend_model->webnotification();
        $data['access_menu'] = $this->Dashboardmodel->access_menu();
        $accessmenu['access_menu'] = $this->Dashboardmodel->access_menu();

        $vehiclesimei = $this->input->post('vehiclesimei');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$vehiclesimei."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;
       
        $from_Date = $this->input->post('from_Date');
        $to_Date = $this->input->post('to_Date');
        $workspace = $this->input->post('workspace');
        
        $data['vehicleID'] = $vehiclesimei;
       $data['vehiclesimei'] = $deviceimei;
       $data['from_Date'] = $from_Date;
       $data['to_Date'] = $to_Date;
        
        $this->load->view('components/header/headerscript');
        $this->load->view('components/header/headernavbar', $data);
        $this->load->view('Dashboard/workspace_details', $data);
        $this->load->view('components/footer/footerscript');
        $this->load->view('components/footer/footer');
    }

    public function ignitiononoff_data() {
        $id = $this->input->post('vehicle');
        	$vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
                    $vehicle_info = $vehicle_detail->row();
                    $deviceimei = $vehicle_info->deviceimei;
                    
//=====================date between==================
$begin = new DateTime( '2012-08-01' );
$end = new DateTime( '2012-08-31' );
$end = $end->modify( '+1 day' ); 

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
	$data2['dates'] = $date->format("d-m-Y");
}
    $ignitiononoff= $this->Dashboardmodel->ignitiononoff($deviceimei);
//            $speed_query= $this->Dashboardmodel->speedchartdata($deviceimei);
    
            foreach ($ignitiononoff as $value) {
                $data2['ignition'] = $value;
            }
            echo json_encode($data2);

 }

 public function speed_data() {

  $id = $this->input->post('vehicle');
  $fromdate = $this->input->post('from_Date');
  $todate = $this->input->post('to_Date');
  
    $vehicle_detail = $this->db->query("SELECT deviceimei FROM vehicletbl WHERE vehicleid='".$id."'");
              $vehicle_info = $vehicle_detail->row();
              $deviceimei = $vehicle_info->deviceimei;
              
//$ignitiononoff= $this->Dashboardmodel->analysic_speeddata($deviceimei);
            $speed_query= $this->Dashboardmodel->speedchartdata($deviceimei,$fromdate,$todate);
            $ignitiononoff= $this->Dashboardmodel->ignitiononoff($deviceimei,$fromdate,$todate);

            $data = array('speed_data' => $speed_query,
                          'ignition' =>$ignitiononoff);

     
      echo json_encode($data);

}

public function get_geofence()
{
  
  $data = $this->genericreport_model->get_geofence();
  
  echo json_encode($data);

}

}
