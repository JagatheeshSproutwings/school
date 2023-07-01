<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Genericreport extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('genericreport_model');
		$this->load->model('Dashboardmodel');
		$this->load->model('Smssend_model');
	}

	public function index()
	{

		$role = $this->session->userdata('roleid');

		if ($this->session->userdata('userid') == '') {
			redirect('Login');
		} else {

			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			//		$this->load->view('components/mainmenu');
			$this->load->view('reports/generic_report');
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
	}

	public function parking_report()
	{
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$time = $this->input->post('time');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);
		for ($i = 0; $i < count($vehicle); $i++) {
			$park_list = $this->genericreport_model->parking_report_list($from_date, $to_date, $vehicle[$i], $time);
			foreach ($park_list as $list) {
				$resultArray[] = array(
					'report_id' => $list->report_id,
					'vehicle' => $list->vehiclename,
					'start_date' => $list->start_day,
					'end_date' => $list->end_day,
					'time_dur' => $list->time_duration,
					's_lat' => $list->s_lat,
					's_lng' => $list->s_lng,
					'start_location' => $list->start_location,
					'imei_no' => $list->device_no
				);
			}
		}
		//		print_r($resultArray);exit;
		$data['vehicle_details'] = $resultArray;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//		$this->load->view('components/mainmenu');
		$this->load->view('reports/generic_report/parking', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

	public function idle_report()
	{
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$time = $this->input->post('time');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);
		for ($i = 0; $i < count($vehicle); $i++) {
			$idle_list = $this->genericreport_model->idle_report_list($from_date, $to_date, $vehicle[$i], $time);
			foreach ($idle_list as $list) {
				$resultArray[] = array(
					'report_id' => $list->report_id,
					'vehicle' => $list->vehiclename,
					'start_date' => $list->start_day,
					'end_date' => $list->end_day,
					'time_dur' => $list->time_duration,
					's_lat' => $list->s_lat,
					's_lng' => $list->s_lng,
					'start_location' => $list->start_location,
					'end_location' => $list->end_location,
					'imei_no' => $list->device_no
				);
			}
		}
		//		print_r($resultArray);exit;
		$data['vehicle_details'] = $resultArray;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//		$this->load->view('components/mainmenu');
		$this->load->view('reports/generic_report/idle', $data);
		$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');

	}


	public function ac_report()
	{
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$time = $this->input->post('time');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);
		for ($i = 0; $i < count($vehicle); $i++) {
			$idle_list = $this->genericreport_model->ac_report_list($from_date, $to_date, $vehicle[$i], $time);
			foreach ($idle_list as $list) {
				$resultArray[] = array(
					'report_id' => $list->report_id,
					'vehicle' => $list->vehiclename,
					'start_date' => $list->start_day,
					'end_date' => $list->end_day,
					'time_dur' => $list->time_duration,
					's_lat' => $list->s_lat,
					's_lng' => $list->s_lng,
					'start_location' => $list->start_location,
					'end_location' => $list->end_location,
					'imei_no' => $list->device_no
				);
			}
		}
		//		print_r($resultArray);exit;
		$data['vehicle_details'] = $resultArray;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//		$this->load->view('components/mainmenu');
		$this->load->view('reports/generic_report/ac', $data);
		$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');

	}




	public function trip_report()
	{

		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$time = $this->input->post('time');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);


		$client_id = $this->session->userdata['client_id'];

		foreach ($vehicle as $vehicle_id) {

			$trip_report = $this->genericreport_model->trip_report_list($from_date, $to_date, $vehicle_id, $time);
			$tot_distance = 0;

			$tot_duration = 0;
			$resultArray = array();
			foreach ($trip_report as $list) {

				$distance = 0;
				$start_odo = 0;
				$end_odo = 0;

				$start_odo = $list->start_odometer;
				$end_odo = $list->end_odometer;
				$distance = $list->distance;

				$tot_distance = $tot_distance + $list->distance;

				$tot_duration = $tot_duration + $list->t_min;

				$resultArray[] = array(
					'report_id' => $list->report_id,
					'vehicle' => $list->vehiclename,
					'start_date' => $list->start_day,
					'end_date' => $list->end_day,
					'time_dur' => $list->time_duration,
					'start_odo' => $start_odo,
					'end_odo' => $end_odo,
					'distance' => $distance,
					's_lat' => $list->s_lat,
					's_lng' => $list->s_lng,
					'e_lat' => $list->e_lat,
					'e_lng' => $list->e_lng,
					'start_location' => $list->start_location,
					'end_location' => $list->end_location,
					'imei_no' => $list->device_no
				);
			}

			//		print_r($tot_duration);exit;

			$hours = floor($tot_duration / 60);
			$min = $tot_duration - ($hours * 60);
			$tot_duration = $hours . "." . $min;

			$vehicle_detail = $this->db->query("SELECT vehiclename FROM vehicletbl WHERE deviceimei='" . $vehicle_id . "'");
			$vehicle_info = $vehicle_detail->row();
			$vehiclename = $vehicle_info->vehiclename;

			$tot_resultArray[] = array(
				'vehicle' => $vehiclename,
				'tot_duration' => $tot_duration,
				'tot_distance' => $tot_distance,
				'resultArray' => $resultArray
			);
		}

		// print_r($tot_resultArray);
		//  exit;
		if (!empty($tot_resultArray)) {
			$data['vehicle_details'] = $tot_resultArray;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('reports/generic_report/trip', $data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		} else {

			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('reports/generic_report/trip');
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
	}

	public function alert_report()
	{
		$vehicle = $this->input->post('vehicles');
		$alert_id = $this->input->post('alert_type');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$time = $this->input->post('time');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);

		$alert_list = $this->genericreport_model->alert_report_list($from_date, $to_date, $alert_id, $vehicle);
		$data['alert_list'] = $alert_list;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//		$this->load->view('components/mainmenu');
		$this->load->view('reports/generic_report/alert', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}



	public function playback()
	{

		$data['vehicle_details'] = $this->Dashboardmodel->vehicle_details();
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//	$this->load->view('components/mainmenu');
		$this->load->view('reports/generic_report/playback', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

	public function get_all_history()
	{

		$vid = $this->input->post('vehicle');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$fromtime = strtotime($from_date);
		$totime = strtotime($to_date);
		$from = date('Y-m-d H:i:s', $fromtime);
		$todate = date('Y-m-d H:i:s', $totime);


		$history_result = $this->genericreport_model->get_all_history_data($vid, $from, $todate);


		echo json_encode($history_result);
	}


	public function get_park_history()
	{

		$vid = $this->input->post('vehicle');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$fromtime = strtotime($from_date);
		$totime = strtotime($to_date);
		$from = date('Y-m-d H:i:s', $fromtime);
		$todate = date('Y-m-d H:i:s', $totime);


		$history_result = $this->genericreport_model->get_park_history_data($vid, $from, $todate);

		echo json_encode($history_result);
	}

	public function distance_report()
	{

		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$time = $this->input->post('time');

		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d', $fromtime);
		$to_date = date('Y-m-d', $totime);

		$date1 = new DateTime($from_date);
		$date2 = new DateTime($to_date);
		$interval = $date1->diff($date2);

		$diff_day =  $interval->days;

		//$array_vehicle = explode(",",$vehicle);

		$distance_array = [];
		foreach ($vehicle as $vehicle_id) {
			$fd = '';
			$distance_datearray = array();

			$vehicle_number = $this->db->query("SELECT vehiclename,device_type  from vehicletbl where deviceimei='" . $vehicle_id . "' ");
			$vehicle_name = $vehicle_number->row();
			$vehicle_reg_no = $vehicle_name->vehiclename;

			$device_config_type = $vehicle_name->device_type;

			for ($i = 0; $i <= $diff_day; $i++) {
				if ($i == 0) {
					$fd = date('Y-m-d', $fromtime);
					$td = date('Y-m-d', $totime);
					$from_date1 = $fd;
					$to_date1 = $fd;
				} else {
					$fd = date('Y-m-d', strtotime('+1 days', strtotime($fd)));
					//$td = date('Y-m-d',strtotime('+1 days', strtotime($fd)));
					$from_date1 = $fd;
					$to_date1 = $fd;
				}


				$Distance_list = $this->genericreport_model->Distance_report_list($from_date1, $to_date1, $vehicle_id, $device_config_type);
				//		print_r($Distance_list);exit;

				// if($Distance_list!='')
				// {
				$distance_datearray[] = ['date' => date('d-m-Y', strtotime($fd)), 'distance' => $Distance_list];
				//}



			}


			$distance_array[$vehicle_reg_no] = $distance_datearray;
		}
		//	print_r($distance_array);exit;
		if (!empty($distance_array)) {
			$data['vehicle_details'] = $distance_array;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('reports/generic_report/distance', $data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		} else {

			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('reports/generic_report/distance');
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
		//echo json_encode($ignition_list); exit();

	}


	public function rpm_report()
	{

		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$time = $this->input->post('time');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);
		for ($i = 0; $i < count($vehicle); $i++) {

			$vehicle_number = $this->db->query("SELECT vehiclename,device_config_type  from vehicletbl where deviceimei='" . $vehicle[$i] . "' ");
			$vehicle_name = $vehicle_number->row();
			$vehicle_reg_no = $vehicle_name->vehiclename;


			$normal_data = $this->genericreport_model->normal_rpm($from_date, $to_date, $vehicle[$i], $time);
			$load_data = $this->genericreport_model->load_rpm($from_date, $to_date, $vehicle[$i], $time);
			$overload_data = $this->genericreport_model->overload_rpm($from_date, $to_date, $vehicle[$i], $time);

			$merge_array = array_merge($normal_data, $load_data, $overload_data);
			usort($merge_array, function ($a, $b) {
				return strtotime(($a->start_day)) - strtotime(($b->start_day));
			});

			// usort($merge_array, $this->cb());
			//	$total_duration = $this->genericreport_model->total_duration($from_date,$to_date,$vehicle[$i],$time);

			$rpm_data[] = array(
				'vehicle_name' => $vehicle_reg_no,
				'rpm_data' => $merge_array
			);

			//print_r($rpm_data);
			$merge_array = '';
		}



		$data['vehicle_details'] = $rpm_data;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		//		$this->load->view('components/mainmenu');
		$this->load->view('reports/generic_report/rpm', $data);
		$this->load->view('components/footer/footerscript');
		//		$this->load->view('components/footer/footer');



	}

	// function cb($a, $b) {

	// }



	public function fuelfilldip_report()
	{
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$type_id = $this->input->post('typename');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i', $fromtime);
		$to_date = date('Y-m-d H:i', $totime);

		for ($i = 0; $i < count($vehicle); $i++) {

			$vehicle_number = $this->db->query("SELECT vehiclename,device_config_type  from vehicletbl where deviceimei='" . $vehicle[$i] . "' ");
			$vehicle_name = $vehicle_number->row();
			$vehicle_reg_no = $vehicle_name->vehiclename;

			$fuelfilldip = $this->genericreport_model->get_fuel_data($vehicle[$i], $from_date, $to_date, $type_id);

			$all_fueldata[$vehicle_reg_no] = array(
				'vehicle' => $vehicle_reg_no,
				'fuel_data' => $fuelfilldip
			);
		}

		//   print_r($all_fueldata);exit;

		$data['vehicle_details'] = $all_fueldata;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		$this->load->view('reports/generic_report/fuelfilldip', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}
	public function millage_report()
	{

		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i', $fromtime);
		$to_date = date('Y-m-d H:i', $totime);
		$type_id = 3;

		if (isset($from)) {

			$fromtime = strtotime($from);
			$from_date = date('Y-m-d H:i:s', $fromtime);

			$totime = strtotime($to);
			$to_date = date('Y-m-d H:i:s', $totime);


			$fuel_data = $this->genericreport_model->fuel_data_distance($from_date, $to_date, $vehicle);

			//	print_r($fuel_data);exit;
			$query_filldip = $this->db->query("SELECT * FROM (SELECT SUM(difference_fuel) as filldiff FROM fuel_fill_dip_report WHERE running_no = '" . $vehicle . "'  AND difference_fuel>0 AND (created_on >= '" . $from_date . "' AND created_on <= '" . $to_date . "') AND type_id ='2') A,(SELECT SUM(difference_fuel) as dipdiff FROM fuel_fill_dip_report WHERE running_no = '" . $vehicle . "' AND difference_fuel<0 AND (created_on >= '" . $from_date . "' AND created_on <= '" . $to_date . "') AND type_id ='1') B");
			//  echo "SELECT * FROM (SELECT SUM(difference_fuel) as filldiff FROM fuel_fill_dip_report WHERE running_no = '".$vehicle."'  AND difference_fuel>0 AND (created_on >= '".$from_date."' AND created_on <= '".$to_date."') AND type_id ='2') A,(SELECT SUM(difference_fuel) as dipdiff FROM fuel_fill_dip_report WHERE running_no = '".$vehicle."' AND difference_fuel<0 AND (created_on >= '".$from_date."' AND created_on <= '".$to_date."') AND type_id ='1') B";exit;
			$filldip = $query_filldip->row();

			$fill_ltr = $filldip->filldiff;

			$dip_ltr = $filldip->dipdiff;

			$fuel_ltr = $fill_ltr + $dip_ltr;


			$query1 = $this->db->query("SELECT deviceimei as v_running_no,vehiclename,device_config_type from vehicletbl where deviceimei = '" . $vehicle . "'");
			$vehicle_number = $query1->row();
			$vehicle_register_number = $vehicle_number->vehiclename;

			$data['fuel'] = null;
			$data['distance'] = null;
			$data['from_date'] = null;

			if ($fuel_data) {

				$call_distance = null;
				$set_dis = 0;

				$call_fuel = null;
				$set_fuel = 0;
				$i = 0;

				$f_length = count($fuel_data) - 1;

				$n = count($fuel_data);

				if ($vehicle_number->device_config_type == 2) {
					$sd_query = $this->db->query("SELECT high_resolution_vehicle_distance_917 FROM gnx_aj1939 WHERE high_resolution_vehicle_distance_917!=0 AND packet_type=0 AND vehicle_imei='" . $vehicle_number->v_running_no . "' AND `logged_datetime`<='" . $fuel_data[0]->modified_date . "'  AND high_resolution_vehicle_distance_917 NOT LIKE '21%' ORDER BY current_datetime DESC LIMIT 1");

					$sd_odo = $sd_query->row();

					if ($sd_odo->high_resolution_vehicle_distance_917 != '') {
						$sd_odo = $sd_query->row();

						$end_meter = $sd_odo->high_resolution_vehicle_distance_917;

						$ed_query = $this->db->query("SELECT high_resolution_vehicle_distance_917 FROM gnx_aj1939 WHERE high_resolution_vehicle_distance_917!=0 AND packet_type=0 AND vehicle_imei='" . $vehicle_number->v_running_no . "' AND `logged_datetime`<='" . $fuel_data[$n - 1]->modified_date . "'  AND high_resolution_vehicle_distance_917 NOT LIKE '21%' ORDER BY current_datetime DESC LIMIT 1");

						$ed_odo = $ed_query->row();

						$start_meter = $ed_odo->high_resolution_vehicle_distance_917;

						$distance = $end_meter - $start_meter;
					} else {
						$end_meter = $fuel_data[0]->odometer;
						$start_meter = $fuel_data[$n - 1]->odometer;

						$distance = $end_meter - $start_meter;
					}
				} else {
					$end_meter = $fuel_data[0]->odometer;
					$start_meter = $fuel_data[$n - 1]->odometer;

					$distance = $end_meter - $start_meter;
				}


				//$end_meter = $fuel_data[0]->odometer;
				//$start_meter = $fuel_data[$n-1]->odometer;

				//$distance = $end_meter - $start_meter;


				$end_fuel = $fuel_data[0]->litres;
				$start_fuel = $fuel_data[$n - 1]->litres;

				//$distance = $end_meter - $start_meter;


				if ($fuel_ltr < 0) {
					$fl = 0;
				} else {
					$fl = $fuel_ltr;
				}

				//echo $start_fuel." +". $fl."-".$end_fuel; exit();
				$cf = $start_fuel + $fl - $end_fuel;

				if ($cf < 0) {
					$cunsumed_fl = -1 * $cf;
				} else {
					$cunsumed_fl = $cf;
				}

				if ($cunsumed_fl != 0) {
					$mileage = $distance / $cunsumed_fl;
				} else {
					$mileage = 0;
				}

				$data['from_date'] = $from_date;
				$data['fill_fuel'] = round($fill_ltr, 2);
				$data['fuel'] = $cunsumed_fl;
				$data['start_odo'] = $start_meter;
				$data['end_odo'] = $end_meter;
				$data['distance'] = round($distance, 2);
				$data['mileage'] = round($mileage, 2);
				$data['vehicle'] = $vehicle_register_number;

				//	print_r($data);exit;
				$this->session->set_flashdata('vid', $vehicle);
				$this->session->set_flashdata('form_date', $from);
				$this->session->set_flashdata('to_date', $to);
				$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
				$this->load->view('reports/generic_report/millage', $data);
				$this->load->view('components/footer/footerscript');
				$this->load->view('components/footer/footer');
			} else {
				$this->session->set_flashdata('vid', $vehicle);
				$this->session->set_flashdata('form_date', $from);
				$this->session->set_flashdata('to_date', $to);
				$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
				$this->load->view('reports/generic_report/millage', $data);
				$this->load->view('components/footer/footerscript');
				$this->load->view('components/footer/footer');
			}
		} else {
			$this->session->set_flashdata('vid', $vehicle);
			$this->session->set_flashdata('form_date', $from);
			$this->session->set_flashdata('to_date', $to);
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('reports/generic_report/millage', $data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
	}

	public function fuel_compare_report()
	{
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i', $fromtime);
		$to_date = date('Y-m-d H:i', $totime);
		//                    for ($i=0; $i <count($vehicle) ; $i++) { 
		//			$park_list = $this->report_model->get_fuel_data($from_date,$to_date,$vehicle[$i]);
		//			foreach ($park_list as $list) {
		//				 $resultArray[] = array(
		//			            'vehicle' => $list->vehiclename,
		//			            'start_date' => $list->start_day,
		//			            'end_date' => $list->end_day,
		//			            'time_dur' => $list->time_duration,
		//			            's_lat'=>$list->s_lat,
		//			            's_lng'=>$list->s_lng,
		//			            'start_location'=>$list->start_location,
		//			            'end_location'=>$list->end_location,
		//			            'imei_no'=>$list->device_no
		//			        );
		//                        }
		//                    }
		//		print_r($resultArray);exit;
		$data['vehicle_details'] = $resultArray;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		$this->load->view('reports/generic_report/fuel_compare', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}

	public function idledata_location($gid)
	{

		$idledata_location = $this->genericreport_model->idledata_location($gid);

		echo json_encode($idledata_location);
	}

	public function parkdata_location($gid)
	{

		$parkdata_location = $this->genericreport_model->parkdata_location($gid);

		echo json_encode($parkdata_location);
	}

	public function tripdata_location($gid)
	{

		$tripdata_location = $this->genericreport_model->tripdata_location($gid);

		echo json_encode($tripdata_location);
	}

	public function alert_location($gid)
	{

		$alert_location = $this->genericreport_model->alert_location($gid);

		echo json_encode($alert_location);
	}



	public function get_trip_route()
	{

		$d_id = $this->input->post('d_no');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');


		$fromtime = strtotime($from_date);
		$totime = strtotime($to_date);
		$from = date('Y-m-d H:i', $fromtime);
		$to = date('Y-m-d H:i', $totime);

		$history_result = $this->genericreport_model->get_trip_route_data($d_id, $from, $to);


		echo json_encode($history_result);
	}

	public function hubpoint_report()
	{
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		//   echo json_encode($this->input->post());
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i', $fromtime);
		$to_date = date('Y-m-d H:i', $totime);
		for ($i = 0; $i < count($vehicle); $i++) {
			$park_list = $this->genericreport_model->hubpoint_report_list($from_date, $to_date, $vehicle[$i]);
			foreach ($park_list as $list) {
				$resultArray[] = array(
					'start_odometer' => $list->start_odometer,
					'end_odometer' => $list->end_odometer,
					'start_day' => $list->start_day,
					'end_day' => $list->end_day,
					'distance' => $list->distance,
					'total_dur' => $list->total_dur,
					'trip_id' => $list->trip_id,
					'vehiclename' => $list->vehiclename,
					'deviceimei' => $list->deviceimei,
					'trip_mins' => $list->trip_mins,
					'trip_hours' => $list->trip_hours,
					'location_name' => $list->location_name,
				);
			}
		}
		//		print_r($resultArray);exit;
		$data['vehicle_details'] = $resultArray;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		$this->load->view('reports/generic_report/hubpoint', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}
	public function geofence_report()
	{
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');
		$geolocation = $this->input->post('geolocation');
		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);
		for ($i = 0; $i < count($vehicle); $i++) {
			$geo_list = $this->genericreport_model->geo_report_data($from_date, $to_date, $vehicle[$i], $geolocation);

			//print_r($geo_list);exit;
			foreach ($geo_list as $list) {
				//	print_r($list['time_duration']);exit;
				$resultArray[] = array(
					'time_duration' => $list->time_duration,
					'out_datetime' => $list->out_datetime,
					'in_datetime' => $list->in_datetime,
					'geo_location_id' => $list->geo_location_id,
					'vehiclename' => $list->vehiclename,
					'location_name' => $list->Location_short_name,
					'client_id' => $list->client_id,
				);
			}
		}

		$data['vehicle_details'] = $resultArray;
		$this->load->view('components/header/headerscript');
		$this->load->view('components/header/headernavbar');
		$this->load->view('reports/generic_report/geofence', $data);
		$this->load->view('components/footer/footerscript');
		$this->load->view('components/footer/footer');
	}


	public function polygon_report()
	{
		$polygon_area = $this->input->post('polygon_area');
		$vehicle = $this->input->post('vehicles');
		$from = $this->input->post('fromdate');
		$to = $this->input->post('todate');

		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i', $fromtime);
		$to_date = date('Y-m-d H:i', $totime);


		$polygon_area = $this->genericreport_model->polygon_report($from_date, $to_date, $vehicle, $polygon_area);


		for ($i = 0; $i < count($polygon_area); $i++) {


			$polygon_area_name = $polygon_area[$i]->polygon_area_name;
			$vehicle_imei =  $polygon_area[$i]->vehicle_imei;
			$vehicle_name =  $polygon_area[$i]->vehicle_name;
			$polygon_id =  $polygon_area[$i]->polygon_id;
			$trip_start_date =  $polygon_area[$i]->in_datetime;
			$trip_end_date =  $polygon_area[$i]->out_datetime;
			$polygon_duration = $polygon_area[$i]->time_duration;
			$s_lat = $polygon_area[$i]->s_lat;
			$s_lng = $polygon_area[$i]->s_lng;
			$e_lat = $polygon_area[$i]->e_lat;
			$e_lng = $polygon_area[$i]->e_lng;


			$polygon_area_details[] = array(
				'polygon_area_name' => $polygon_area_name,
				'vehicle_name' => $vehicle_name,
				'in_datetime' => $trip_start_date,
				'out_datetime' => $trip_end_date,
				'time_duration' => $polygon_duration,
				'trip_kilometer' => $trip_kilometer,
				'parking_duration' => $parking_duration,
				'engine_duration' => $engine_duration,
				'total_duration' => $total_duration,
				's_lat' => $s_lat,
				's_lng' => $s_lng,
				'e_lat' => $e_lat,
				'e_lng' => $e_lng,
			);
		}
		if ($polygon_area) {

			$data['polygon_area_details'] = $polygon_area_details;
			//	print_r($polygon_area_details);exit;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('reports/generic_report/polygon', $data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		} else {
			$data['polygon_area_details'] = $polygon_area_details;
			$this->load->view('components/header/headerscript');
			$this->load->view('components/header/headernavbar');
			$this->load->view('reports/generic_report/polygon', $data);
			$this->load->view('components/footer/footerscript');
			$this->load->view('components/footer/footer');
		}
	}

	public function playback_excel()
	{
		$vehicle = $_REQUEST['vehicle'];
		$from = $_REQUEST['from'];
		$to = $_REQUEST['to'];

		$fromtime = strtotime($from);
		$totime = strtotime($to);
		$from_date = date('Y-m-d H:i:s', $fromtime);
		$to_date = date('Y-m-d H:i:s', $totime);

		$speed_report_list = $this->genericreport_model->get_all_history_data($vehicle, $from_date, $to_date);

		$vehicle1 = $this->db->query("SELECT vehiclename as vehicle_register_number from vehicletbl where deviceimei = '" . $vehicle . "' ");
		$vehicles = $vehicle1->row();
		$vehicle = $vehicles->vehicle_register_number;


		require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

		// Create new Spreadsheet object
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

		$spreadsheet->getActiveSheet()->setCellValue('A1', 'Playback Report');
		$spreadsheet->getActiveSheet()->setCellValue('A2', 'From Date');
		$spreadsheet->getActiveSheet()->setCellValue('B2', $from_date);
		$spreadsheet->getActiveSheet()->setCellValue('C2', 'To Date');
		$spreadsheet->getActiveSheet()->setCellValue('D2', $to_date);
		$spreadsheet->getActiveSheet()->setCellValue('E2', 'Vehicle');
		$spreadsheet->getActiveSheet()->setCellValue('F2', $vehicle);
		//Merge cell A1 to Z1	
		$spreadsheet->getActiveSheet()->mergeCells('A1:F1');
		//Style for title
		$TitleStyle = array(
			'font' => array('bold' => true,),
			'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			),
		);
		// add style to the header
		$HeaderStyle = array(
			'font' => array('bold' => true, 'color' => array('rgb' => 'e0c811')),
			'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'top' => array('style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,),
			),
		);
		$openmap = array(
			'font' => array('bold' => true, 'underline' => true, 'color' => array('rgb' => '42b3f4')),
		);
		$ContentStyle = array(
			'font' => array('bold' => true,),
			'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'top' => array('style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,),
			),
		);

		//Append Title style to A1 Column		
		$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($TitleStyle);

		//Append header Style to header columns A1 to F1
		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($HeaderStyle);
		//Append header Style to content columns A3 to F3
		$spreadsheet->getActiveSheet()->getStyle('A3:F3')->applyFromArray($ContentStyle);

		// auto fit column to content
		foreach (range('A', 'F') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
			$spreadsheet->getActiveSheet()->getStyle('A:F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		}
		// set the names of header cells
		$spreadsheet->setActiveSheetIndex(0)

			->setCellValue("A3", 'S.No')
			->setCellValue("B3", 'Datetime')
			->setCellValue("C3", 'Speed (Km/hr)')
			->setCellValue("D3", 'Odometer')
			->setCellValue("E3", 'Location')
			->setCellValue("F3", 'Lat,Lng')
			->setCellValue("G3", 'Map View');

		// Add some data
		$x = 4;
		$sno = 1;
		$i = 0;
		foreach ($speed_report_list as $sub) {

			$spreadsheet->getActiveSheet()->getStyle("G$x")->applyFromArray($openmap);

			$url = 'http://map.google.com/maps?q=' . $sub->lat_message . ',' . $sub->lon_message;
			$address = '"' . $url . '"';
			$url_address = '=Hyperlink(' . $address . ',"View")';
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue("A$x", $sno)
				->setCellValue("B$x", $sub->datetime)
				->setCellValue("C$x", $sub->speed)
				->setCellValue("D$x", $sub->odometer)
				->setCellValue("E$x", $sub->zap)
				->setCellValue("F$x", $sub->lat_message . ',' . $sub->lon_message)
				->setCellValue("G$x", $url_address);
			$x++;
			$i++;
			$sno++;
		}



		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Playback Report');

		// set right to left direction
		// $spreadsheet->getActiveSheet()->setRightToLeft(true);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client's web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Playback.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
		$writer->save('php://output');
		exit;

		//  create new file and remove Compatibility mode from word title


	}


	public function get_address()
	{
		$Lattitute = $this->input->get('Lattitute');
		$Longitute = $this->input->get('Longitute');
		$format = 'json'; // set the desired format of the response

		$url = "http://69.197.153.82/nominatim/reverse.php?lat=$Lattitute&lon=$Longitute&format=$format";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept-Language: en-US,en;q=0.9'));
		$response = curl_exec($curl);
		curl_close($curl);

		$data = json_decode($response, true); // decode the JSON response into a PHP associative array

		$address = $data['address'];
		$details = $address['road'] . ", " . $address['city'] . ", " . $address['state'] . ", " . $address['country'];
		//$array  = array('status' => 'ok', 'address' =>$details);
		$array = array('status' => 'ok', 'address' => $data["display_name"]);
		
		echo json_encode($array);

	}
}
