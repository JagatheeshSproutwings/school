<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Executivereport extends CI_Controller {
public function __construct()
{
    parent:: __construct();
    $this->load->model('Executivereport_model');	
    $this->load->model('Dashboardmodel');		
    $this->load->model('Smssend_model');
}
 
public function index()
  {
   
 	$role = $this->session->userdata('roleid');
        $client_id = $this->session->userdata('client_id');
        $user_id = $this->session->userdata('userid');
	if($this->session->userdata('userid')=='')
	{
		redirect('Login');
	}
	else
	{
       //  echo "Hii";exit;
             $executive_data= $this->Executivereport_model->executiveaccess_details();
            $data['executive_access']=$executive_data;
                    
           $data['general'] = $executive_data->mileagekm + $executive_data->startodometer + $executive_data->endodometer + $executive_data->startenginehrmeter + $executive_data->endenginehrmeter;
           $data['vehicle_movement'] = $executive_data->overspeedmileagekm + $executive_data->avgspeedrunning + $executive_data->maxspeedkm;
           $data['vehicle_utilization'] = $executive_data->triptime + $executive_data->triptime_percentagerpt + $executive_data->runningtime + $executive_data->runningtime_percentagerpt + $executive_data->idletime_hhmmss+$executive_data->idletime_percentagerpt+$executive_data->parkingtime_hhmmss+$executive_data->parkingtime_percentage;
           $data['vehicle_rpm'] = $executive_data->rpm_opr_time_hhmmss+$executive_data->rpm_opr_time_percentage+$executive_data->rpm_opt_normal_hhmmss+$executive_data->rpm_opt_normal_percentage+$executive_data->rpm_opt_max_hhmmss+$executive_data->rpm_opt_max_percentage+$executive_data->rpm_opr_hhmmss+$executive_data->rpm_engine_opr_percentage;
           $data['vehicle_fuel'] = $executive_data->fuel_start_vol+$executive_data->fuel_final_vol+$executive_data->fuel_actual_fuel_cons+$executive_data->fuel_refueling_vol+$executive_data->fuel_draining_vol+$executive_data->fuel_mileage_km+$executive_data->fuel_mileage_vehicle_running_km+$executive_data->fuel_fuelconsumption_vehicle_running+$executive_data->fuel_fuelconsumption_vehicle_idle;
           $data['vehicle_engine'] = $executive_data->fuelconsumption_engine_hour;
           $data['vehicle_bucket'] = $executive_data->bucket_move_time_hhmmss+$executive_data->bucket_move_time_percentage+$executive_data->bucket_idle_time_hhmmss+$executive_data->bucket_idle_time_percentage;
           $data['vehicle_drum'] = $executive_data->drumnonmvt_time_with_hhmmss+$executive_data->drumnonmvt_time_with_percentage+$executive_data->drumnonmvt_time_withoutload_hhmmss+$executive_data->drumnonmvt_time_withoutload_per+$executive_data->drumnonmvt_time_hhmmss+$executive_data->drumnonmvt_time_percentage;
           $data['vehicle_obd'] = $executive_data->reading_can_odomtr_start+$executive_data->reading_can_odomtr_end+$executive_data->fuelconsumptionmeter+$executive_data->nbsp_sec+$executive_data->enginehours_hhmmss+$executive_data->fuelconsumption1;
           
               $from = $this->input->post("fromdate");
		       $to = $this->input->post("todate");
               $vehicles = $this->input->post("vehicles");

		      	if ($from!='') {
		      	$user_data = array(
                'fromd' => $from,
                'tod' =>$to,
                'vehicles' =>$vehicles
            );

           
          $this->session->set_userdata($user_data);
		      	}
             
        

           	$this->get_allreport();
	}
		
    }

    public function reportaccess(){

        $executive_data= $this->Executivereport_model->executiveaccess_details();
        $exeid = $executive_data->id;
        $user_id = $executive_data->user_id;
        $client_id = $executive_data->client_id;
        
        
        if($this->input->post('mileagekm') == 1){ $mileagekm = 1; }else{ $mileagekm = 0;}
        if($this->input->post('startodometer') == 1){ $startodometer = 1; }else{ $startodometer = 0;}
        if($this->input->post('endodometer') == 1){ $endodometer = 1; }else{ $endodometer = 0;}
        if($this->input->post('startenginehrmeter') == 1){ $startenginehrmeter = 1; }else{ $startenginehrmeter = 0;}
        if($this->input->post('endenginehrmeter') == 1){ $endenginehrmeter = 1; }else{ $endenginehrmeter = 0;}
        if($this->input->post('overspeedmileagekm') == 1){ $overspeedmileagekm = 1; }else{ $overspeedmileagekm = 0;}
        if($this->input->post('avgspeedrunning') == 1){ $avgspeedrunning = 1; }else{ $avgspeedrunning = 0;}
        if($this->input->post('maxspeedkm') == 1){ $maxspeedkm = 1; }else{ $maxspeedkm = 0;}
        if($this->input->post('triptime') == 1){ $triptime = 1; }else{ $triptime = 0;}
        if($this->input->post('triptime_percentagerpt') == 1){ $triptime_percentagerpt = 1; }else{ $triptime_percentagerpt = 0;}
        if($this->input->post('runningtime') == 1){ $runningtime = 1; }else{ $runningtime = 0;}
        if($this->input->post('runningtime_percentagerpt') == 1){ $runningtime_percentagerpt = 1; }else{ $runningtime_percentagerpt = 0;}
        if($this->input->post('idletime_hhmmss') == 1){ $idletime_hhmmss = 1; }else{ $idletime_hhmmss = 0;}
        if($this->input->post('idletime_percentagerpt') == 1){ $idletime_percentagerpt = 1; }else{ $idletime_percentagerpt = 0;}
        if($this->input->post('parkingtime_hhmmss') == 1){ $parkingtime_hhmmss = 1; }else{ $parkingtime_hhmmss = 0;}
        if($this->input->post('parkingtime_percentage') == 1){ $parkingtime_percentage = 1; }else{ $parkingtime_percentage = 0;}
        if($this->input->post('actime_hhmmss') == 1){ $actime_hhmmss = 1; }else{ $actime_hhmmss = 0;}
        if($this->input->post('actime_percentage') == 1){ $actime_percentage = 1; }else{ $actime_percentage = 0;}
        if($this->input->post('rpm_opr_time_hhmmss') == 1){ $rpm_opr_time_hhmmss = 1; }else{ $rpm_opr_time_hhmmss = 0;}
        if($this->input->post('rpm_opr_time_percentage') == 1){ $rpm_opr_time_percentage = 1; }else{ $rpm_opr_time_percentage = 0;}
        if($this->input->post('rpm_opt_normal_hhmmss') == 1){ $rpm_opt_normal_hhmmss = 1; }else{ $rpm_opt_normal_hhmmss = 0;}
        if($this->input->post('rpm_opt_normal_percentage') == 1){ $rpm_opt_normal_percentage = 1; }else{ $rpm_opt_normal_percentage = 0;}
        if($this->input->post('rpm_opt_max_hhmmss') == 1){ $rpm_opt_max_hhmmss = 1; }else{ $rpm_opt_max_hhmmss = 0;}
        if($this->input->post('rpm_opt_max_percentage') == 1){ $rpm_opt_max_percentage = 1; }else{ $rpm_opt_max_percentage = 0;}
        if($this->input->post('rpm_opr_hhmmss') == 1){ $rpm_opr_hhmmss = 1; }else{ $rpm_opr_hhmmss = 0;}
        if($this->input->post('rpm_engine_opr_percentage') == 1){ $rpm_engine_opr_percentage = 1; }else{ $rpm_engine_opr_percentage = 0;}
        if($this->input->post('fuel_start_vol') == 1){ $fuel_start_vol = 1; }else{ $fuel_start_vol = 0;}
        if($this->input->post('fuel_final_vol') == 1){ $fuel_final_vol = 1; }else{ $fuel_final_vol = 0;}
        if($this->input->post('fuel_actual_fuel_cons') == 1){ $fuel_actual_fuel_cons = 1; }else{ $fuel_actual_fuel_cons = 0;}
        if($this->input->post('fuel_refueling_vol') == 1){ $fuel_refueling_vol = 1; }else{ $fuel_refueling_vol = 0;}
        if($this->input->post('fuel_draining_vol') == 1){ $fuel_draining_vol = 1; }else{ $fuel_draining_vol = 0;}
        if($this->input->post('fuel_mileage_km') == 1){ $fuel_mileage_km = 1; }else{ $fuel_mileage_km = 0;}
        if($this->input->post('fuel_mileage_vehicle_running_km') == 1){ $fuel_mileage_vehicle_running_km = 1; }else{ $fuel_mileage_vehicle_running_km = 0;}
        if($this->input->post('fuel_fuelconsumption_vehicle_running') == 1){ $fuel_fuelconsumption_vehicle_running = 1; }else{ $fuel_fuelconsumption_vehicle_running = 0;}
        if($this->input->post('fuel_fuelconsumption_vehicle_idle') == 1){ $fuel_fuelconsumption_vehicle_idle = 1; }else{ $fuel_fuelconsumption_vehicle_idle = 0;}
        if($this->input->post('fuelconsumption_engine_hour') == 1){ $fuelconsumption_engine_hour = 1; }else{ $fuelconsumption_engine_hour = 0;}
        if($this->input->post('bucket_move_time_hhmmss') == 1){ $bucket_move_time_hhmmss = 1; }else{ $bucket_move_time_hhmmss = 0;}
        if($this->input->post('bucket_move_time_percentage') == 1){ $bucket_move_time_percentage = 1; }else{ $bucket_move_time_percentage = 0;}
        if($this->input->post('bucket_idle_time_hhmmss') == 1){ $bucket_idle_time_hhmmss = 1; }else{ $bucket_idle_time_hhmmss = 0;}
        if($this->input->post('bucket_idle_time_percentage') == 1){ $bucket_idle_time_percentage = 1; }else{ $bucket_idle_time_percentage = 0;}
        if($this->input->post('drumnonmvt_time_with_hhmmss') == 1){ $drumnonmvt_time_with_hhmmss = 1; }else{ $drumnonmvt_time_with_hhmmss = 0;}
        if($this->input->post('drumnonmvt_time_with_percentage') == 1){ $drumnonmvt_time_with_percentage = 1; }else{ $drumnonmvt_time_with_percentage = 0;}
        if($this->input->post('drumnonmvt_time_withoutload_hhmmss') == 1){ $drumnonmvt_time_withoutload_hhmmss = 1; }else{ $drumnonmvt_time_withoutload_hhmmss = 0;}
        if($this->input->post('drumnonmvt_time_withoutload_per') == 1){ $drumnonmvt_time_withoutload_per = 1; }else{ $drumnonmvt_time_withoutload_per = 0;}
        if($this->input->post('drumnonmvt_time_hhmmss') == 1){ $drumnonmvt_time_hhmmss = 1; }else{ $drumnonmvt_time_hhmmss = 0;}
        if($this->input->post('drumnonmvt_time_percentage') == 1){ $drumnonmvt_time_percentage = 1; }else{ $drumnonmvt_time_percentage = 0;}
        if($this->input->post('reading_can_odomtr_start') == 1){ $reading_can_odomtr_start = 1; }else{ $reading_can_odomtr_start = 0;}
        if($this->input->post('reading_can_odomtr_end') == 1){ $reading_can_odomtr_end = 1; }else{ $reading_can_odomtr_end = 0;}
        if($this->input->post('fuelconsumptionmeter') == 1){ $fuelconsumptionmeter = 1; }else{ $fuelconsumptionmeter = 0;}
        if($this->input->post('nbsp_sec') == 1){ $nbsp_sec = 1; }else{ $nbsp_sec = 0;}
        if($this->input->post('enginehours_hhmmss') == 1){ $enginehours_hhmmss = 1; }else{ $enginehours_hhmmss = 0;}
        if($this->input->post('fuelconsumption1') == 1){ $fuelconsumption1 = 1; }else{ $fuelconsumption1 = 0;}

        if($exeid && $user_id && $client_id){
            $finedata = array(
                'mileagekm' => $mileagekm,
                'startodometer'=> $startodometer,
                'endodometer'=> $endodometer,
                'startenginehrmeter'=> $startenginehrmeter,
                'endenginehrmeter'=> $endenginehrmeter,
                'overspeedmileagekm'=> $overspeedmileagekm,
                'avgspeedrunning'=> $avgspeedrunning,
                'maxspeedkm'=> $maxspeedkm,
                'triptime'=> $triptime,
                'triptime_percentagerpt'=> $triptime_percentagerpt,
                'runningtime'=> $runningtime,
                'runningtime_percentagerpt'=> $runningtime_percentagerpt,
                'idletime_hhmmss'=> $idletime_hhmmss,
                'idletime_percentagerpt'=> $idletime_percentagerpt,
                'parkingtime_hhmmss'=> $parkingtime_hhmmss,
                'parkingtime_percentage'=> $parkingtime_percentage,
                'actime_hhmmss'=> $actime_hhmmss,
                'actime_percentage'=> $actime_percentage,
                'rpm_opr_time_hhmmss'=> $rpm_opr_time_hhmmss,
                'rpm_opr_time_percentage'=> $rpm_opr_time_percentage,
                'rpm_opt_normal_hhmmss'=> $rpm_opt_normal_hhmmss,
                'rpm_opt_normal_percentage'=> $rpm_opt_normal_percentage,
                'rpm_opt_max_hhmmss'=> $rpm_opt_max_hhmmss,
                'rpm_opt_max_percentage'=> $rpm_opt_max_percentage,
                'rpm_opr_hhmmss'=> $rpm_opr_hhmmss,
                'rpm_engine_opr_percentage'=> $rpm_engine_opr_percentage,
                'fuel_start_vol'=> $fuel_start_vol,
                'fuel_final_vol'=> $fuel_final_vol,
                'fuel_actual_fuel_cons'=> $fuel_actual_fuel_cons,
                'fuel_refueling_vol'=> $fuel_refueling_vol,
                'fuel_draining_vol'=> $fuel_draining_vol,
                'fuel_mileage_km'=> $fuel_mileage_km,
                'fuel_mileage_vehicle_running_km'=> $fuel_mileage_vehicle_running_km,
                'fuel_fuelconsumption_vehicle_running'=> $fuel_fuelconsumption_vehicle_running,
                'fuel_fuelconsumption_vehicle_idle'=> $fuel_fuelconsumption_vehicle_idle,
                'fuelconsumption_engine_hour'=> $fuelconsumption_engine_hour,
                'bucket_move_time_hhmmss'=> $bucket_move_time_hhmmss,
                'bucket_move_time_percentage'=> $bucket_move_time_percentage,
                'bucket_idle_time_hhmmss'=> $bucket_idle_time_hhmmss,
                'bucket_idle_time_percentage'=> $bucket_idle_time_percentage,
                'drumnonmvt_time_with_hhmmss'=> $drumnonmvt_time_with_hhmmss,
                'drumnonmvt_time_with_percentage'=> $drumnonmvt_time_with_percentage,
                'drumnonmvt_time_withoutload_hhmmss'=> $drumnonmvt_time_withoutload_hhmmss,
                'drumnonmvt_time_withoutload_per'=> $drumnonmvt_time_withoutload_per,
                'drumnonmvt_time_hhmmss'=> $drumnonmvt_time_hhmmss,
                'drumnonmvt_time_percentage'=> $drumnonmvt_time_percentage,
                'reading_can_odomtr_start'=> $reading_can_odomtr_start,
                'reading_can_odomtr_end'=> $reading_can_odomtr_end,
                'fuelconsumptionmeter'=> $fuelconsumptionmeter,
                'nbsp_sec'=> $nbsp_sec,
                'enginehours_hhmmss'=> $enginehours_hhmmss,
                'fuelconsumption1'=>$fuelconsumption1,
				);
            

               $from = $this->input->post("fromdate");
               $to = $this->input->post("todate");
               $vehicles = $this->input->post("vehicles");
              // print_r($vehicles);exit;

                if ($from!='') {
                $user_data = array(
                'fromd' => $from,
                'tod' =>$to,
                'vehicles' =>$vehicles
            );

           
          $this->session->set_userdata($user_data);
                }
           
          $this->session->set_userdata($user_data);


//           echo json_encode($finedata); die;
        $this->db->where('id', $exeid);
        $this->db->where('user_id', $user_id);
        $this->db->where('client_id', $client_id);
        $this->db->update('executive_report_chk', $finedata);
        redirect(site_url('Executivereport'));
        
        }else{
             redirect(site_url('Executivereport'));
        }
    }
    
    public function get_allreport()
    {


    	      $executive_data= $this->Executivereport_model->executiveaccess_details();
            $data['executive_access']=$executive_data;
                    
           $data['general'] = $executive_data->mileagekm + $executive_data->startodometer + $executive_data->endodometer + $executive_data->startenginehrmeter + $executive_data->endenginehrmeter;
           $data['vehicle_movement'] = $executive_data->overspeedmileagekm + $executive_data->avgspeedrunning + $executive_data->maxspeedkm;
           $data['vehicle_utilization'] =$executive_data->triptime + $executive_data->triptime_percentagerpt + $executive_data->runningtime + $executive_data->runningtime_percentagerpt + $executive_data->idletime_hhmmss+$executive_data->idletime_percentagerpt+$executive_data->parkingtime_hhmmss+$executive_data->parkingtime_percentage+$executive_data->actime_hhmmss+$executive_data->actime_percentage;
           $data['vehicle_rpm'] = $executive_data->rpm_opr_time_hhmmss+$executive_data->rpm_opr_time_percentage+$executive_data->rpm_opt_normal_hhmmss+$executive_data->rpm_opt_normal_percentage+$executive_data->rpm_opt_max_hhmmss+$executive_data->rpm_opt_max_percentage+$executive_data->rpm_opr_hhmmss+$executive_data->rpm_engine_opr_percentage;
           $data['vehicle_fuel'] = $executive_data->fuel_start_vol+$executive_data->fuel_final_vol+$executive_data->fuel_actual_fuel_cons+$executive_data->fuel_refueling_vol+$executive_data->fuel_draining_vol+$executive_data->fuel_mileage_km+$executive_data->fuel_mileage_vehicle_running_km+$executive_data->fuel_fuelconsumption_vehicle_running+$executive_data->fuel_fuelconsumption_vehicle_idle;
           $data['vehicle_engine'] = $executive_data->fuelconsumption_engine_hour;
           $data['vehicle_bucket'] = $executive_data->bucket_move_time_hhmmss+$executive_data->bucket_move_time_percentage+$executive_data->bucket_idle_time_hhmmss+$executive_data->bucket_idle_time_percentage;
           $data['vehicle_drum'] = $executive_data->drumnonmvt_time_with_hhmmss+$executive_data->drumnonmvt_time_with_percentage+$executive_data->drumnonmvt_time_withoutload_hhmmss+$executive_data->drumnonmvt_time_withoutload_per+$executive_data->drumnonmvt_time_hhmmss+$executive_data->drumnonmvt_time_percentage;
           $data['vehicle_obd'] = $executive_data->reading_can_odomtr_start+$executive_data->reading_can_odomtr_end+$executive_data->fuelconsumptionmeter+$executive_data->nbsp_sec+$executive_data->enginehours_hhmmss+$executive_data->fuelconsumption1;
           
           if($this->session->userdata('roleid') == 1){
               $customercomplaint= $this->Dashboardmodel->customer_complaint();
          $data['customercomplaint'] = $customercomplaint;
           }else{
               $data['customercomplaint'] = 0;
           }
          


             $from = $this->input->post("fromdate");
			 $to = $this->input->post("todate");
             $vehicle_data = $this->input->post('vehicles');

			if($from=='' && $to=='')
			{

			$from = $this->session->userdata('fromd');
			$to =  $this->session->userdata('tod');
            $vehicle_data = $this->session->userdata('vehicles');
			}
			$data['yesterday_data'] ='';
			$data['consolidate_data'] ='';

		
           // print_r($vehicle_data);exit;

			$consolidate_data=array();

			if($from!='' && $to!='')
			{
				
				$fromtime = strtotime($from);
				$totime = strtotime($to);
				$from_date = date('Y-m-d',$fromtime);
				$to_date = date('Y-m-d',$totime);
				$fromd = $from_date;
				$tod = $to_date;
				$date1 = new DateTime($fromd);
				$date2 = new DateTime($tod);
				$interval = $date1->diff($date2);

			    $diff_day =  $interval->days;
             
				foreach ($vehicle_data as $list) 
				{	
                   // print_r($list);exit;
                    $vehicle_detail = $this->db->query("SELECT vehiclename,device_type FROM vehicletbl WHERE deviceimei='".$list."'");
                    $vehicle_info = $vehicle_detail->row();
                    $vehiclename = $vehicle_info->vehiclename;
                    $device_type = $vehicle_info->device_type;

					$dt = $from_date;

					$day_data=array();

					for ($i=0; $i < ($diff_day+1); $i++) 
					{
						if($i==0){ $dd=$dt;}else{$dd = date('Y-m-d',strtotime("+1 days",strtotime($dt)));}


					$yesterday_distance = $this->Executivereport_model->consolidate_distanceday($list,$dd,$device_type);
					$yesterday_park = $this->Executivereport_model->consolidate_parkday($list,$dd);
					$yesterday_idle = $this->Executivereport_model->consolidate_idleday($list,$dd);
					$yesterday_ign = $this->Executivereport_model->consolidate_ignday($list,$dd);
                    $yesterday_ac = $this->Executivereport_model->consolidate_acday($list,$dd);
					$yesterday_fill = $this->Executivereport_model->consolidate_fuelfill($list,$dd);
					$yesterday_dip = $this->Executivereport_model->consolidate_fueldip($list,$dd);
					$yesterday_consumed = $this->Executivereport_model->consolidate_fuelconsumed($list,$dd);

                    $all_rpm = $this->Executivereport_model->consolidate_allrpmday($list,$dd);
                
					     $park_duration=$yesterday_park;//Parking Duration
						 $hours = floor($park_duration / 60);
						 $min = $park_duration - ($hours * 60); 
						 $second = $park_duration % 60;
    			    	 $tot_park=$hours.":".$min.":".$second;
    				     $parts = explode(':', $tot_park);
						 $secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
				    	 $park_period = $secs / 864 . '%'; 


                         $trip_duration=$yesterday_ign;//Trip Duration
                         $hours = floor($trip_duration / 60);
                         $min = $trip_duration - ($hours * 60); 
                         $second = $trip_duration % 60;
                         $tot_trip=$hours.":".$min.":".$second;
                          $tot_trip1=$hours.".".$min;
                         $parts = explode(':', $tot_trip);
                         $secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
                         $trip_period = $secs / 864 . '%'; 

                         

					    $running_duration=$yesterday_ign - $yesterday_idle;//Running Duration
						$hours = floor($running_duration / 60);
					    $min = $running_duration - ($hours * 60); 
					    $second = $running_duration % 60;
    				    $tot_move=$hours.":".$min.":".$second;
                         $tot_move1=$hours.".".$min;
    			    	$parts = explode(':', $tot_move);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$running_period = $secs / 864 . '%'; 



    					$idle_duration=$yesterday_idle;       // Idle Duration
					    $hours = floor($idle_duration / 60);
					    $min = $idle_duration - ($hours * 60); 
					    $second = $idle_duration % 60;
    				    $tot_idle=$hours.":".$min.":".$second;
    				    $parts = explode(':', $tot_idle);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
						$idle_period = $secs / 864 . '%'; 

                        $ac_duration=$yesterday_ac;       // Ac Duration
					    $hours = floor($ac_duration / 60);
					    $min = $ac_duration - ($hours * 60); 
					    $second = $ac_duration % 60;
    				    $tot_ac=$hours.":".$min.":".$second;
    				    $parts = explode(':', $tot_ac);
						$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
                        $ac_period = $secs / 864 . '%'; 

                         $normal_rpm_duration=$all_rpm->normal_rpm;//Normal RPM Duration
                         $hours = floor($normal_rpm_duration / 3600);
                         $min = ($normal_rpm_duration / 60) % 60;
                         $second = $normal_rpm_duration % 60;
                         $tot_normalrpm=$hours.":".$min.":".$second; 
                         $parts = explode(':', $tot_normalrpm);
                         $secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
                         $normalrpm_period = $secs / 864 . '%'; 

                    
                        $load_rpm_duration=$all_rpm->under_load;//Load RPM Duration
                        $hours = floor($load_rpm_duration / 3600);
                         $min = ($load_rpm_duration / 60) % 60;
                         $second = $load_rpm_duration % 60;
                         $tot_loadrpm=$hours.":".$min.":".$second;
                         $parts = explode(':', $tot_loadrpm);
                         $secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
                         $loadrpm_period = $secs / 864 . '%'; 


                         $idlerpm_duration=$all_rpm->idle_rpm;//IDLE RPM Duration
                         $hours = floor($idlerpm_duration / 3600);
                         $min = ($idlerpm_duration / 60) % 60;
                         $second = $idlerpm_duration % 60;
                         $tot_idlerpm=$hours.":".$min.":".$second;
                         $parts = explode(':', $tot_idlerpm);
                         $secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
                         $idlerpm_period = $secs / 864 . '%'; 


                         $total_rpm_duration = $normal_rpm_duration + $load_rpm_duration+ $idlerpm_duration; //Total RPM Duration
                       
                          $hours = floor($total_rpm_duration / 3600);
                         $min = ($total_rpm_duration / 60) % 60;
                         $hmin = $min/10;
                          $mins = '0.'.$min;
                         $hoursdata = round($hmin *100/60);
                          $min1 = ($hmin) *(100/60);
                        //  $tot_hrpm =  $hours + round($min / 60, 1);
                         $second = $total_rpm_duration % 60;
                         $tot_rpm1=$hours.".".$min;
                         $tot_hrpm =  $hours .'.'. $hoursdata;
                         $tot_rpm=$hours.":".$min.":".$second;
                         $parts = explode(':', $tot_rpm);
                         $tot_rpm=$hours."hh:".$min."mm:".$second."ss";
                         $secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
                         $tot_rpm_period = $secs / 864 . '%'; 

    				    $fuel_millege=round(($yesterday_consumed->fuel_millege),2);

                        $ct = date('Y-m-d');
                        if ($dd==$ct) {


                             $fuel_consume =$yesterday_fill->start_fuel+$yesterday_fill->fuel_fill_litre-$yesterday_fill->end_fuel;
                           
                        }
                        else
                        {
                             $fuel_consume =$yesterday_consumed->fuel_consumed_litre;
                        }
                       

    			
						$day_data[$dd]=array(
                                                    'distance'=>round((int)$yesterday_distance->distance_km,1),
                                                    'start_odometer'=>$yesterday_distance->start_odometer,
                                                    'end_odometer'=>$yesterday_distance->end_odometer,
                                                    'park'=>$tot_park,
                                                    'trip'=>$tot_trip,
                                                    'idle'=>$tot_idle,
                                                    'ign'=>$tot_move,
                                                    'ac'=>$tot_ac,
                                                    'park_period'=>  round((int)$park_period, 1),
                                                    'trip_period'=>round((int)$trip_period,1),
                                                    'running_period'=>round((int)$running_period,1),
                                                    'idle_period'=>round((int)$idle_period,1),
                                                    'ac_period'=>round((int)$ac_period,1),
                                                     'tot_rpm'=>$tot_rpm,
                                                     'tot_hrpm'=>$tot_hrpm,
                                                    'tot_normalrpm'=>$tot_normalrpm,
                                                    'tot_loadrpm'=>$tot_loadrpm,
                                                    'tot_idlerpm'=>$tot_idlerpm,
                                                     'tot_rpm_period'=>round((int)$tot_rpm_period,1),
                                                     'normalrpm_period'=>round((int)$normalrpm_period,1),
                                                    'loadrpm_period'=>round((int)$loadrpm_period,1),
                                                    'idlerpm_period'=>round((int)$idlerpm_period,1),
                                                    'start_fuel'=>$yesterday_fill->start_fuel,
                                                    'end_fuel'=>$yesterday_fill->end_fuel,
                                                    'fill'=>$yesterday_fill->fuel_fill_litre,
                                                    'dip'=>$yesterday_dip->fuel_dip_litre,
                                                    'consumed'=>$fuel_consume,
                                                    'fuel_millege'=>$fuel_millege
                                                        );					
						$dt=$dd;
                        
                       // print_r($day_data);exit;
					}
					
					$consolidate_data[] = array('deviceimei'=>$list,
                                               'vehicle'=>$vehiclename,
                                               'day_data'=>$day_data);
					
				}//exit;
                //print_r($consolidate_data);exit;
				
				$data['from_date'] = $from_date;
				$data['to_date'] = $to_date;
					$data['consolidate_data'] = $consolidate_data;
				  //  echo json_encode($data); die;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
    //		$this->load->view('components/mainmenu');
		$this->load->view('reports/executivereport', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
			}
			else
			{
				$data['from_date'] = $from_date;
				$data['to_date'] = $to_date;
			  //  echo json_encode($data); die;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar',$data);
    //		$this->load->view('components/mainmenu');
		$this->load->view('reports/executivereport', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
			}

    }
  
}
