<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
class Smartreport extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Smartreport_model');
		$this->load->model('Executivereport_model');
		$this->load->model('Dashboardmodel');
		$this->load->model('Smssend_model');
	}

	public function index()
	{
		$role = $this->session->userdata('roleid');
		$client_id = $this->session->userdata('client_id');
		$user_id = $this->session->userdata('userid');
		if ($this->session->userdata('userid') == '') {

			redirect('Login');
		} else {
			$from = $this->input->post("fromdate");
			$to = $this->input->post("todate");
			$from_da = $this->session->userdata('fromd');
			$to_da = $this->session->userdata('tod');
			$all_day = [];
			$from = $from == '' ? $from = $from_da : $from = $from;
			$to = $to == '' ? $to = $to_da : $to = $to;

			if ($from != '' && $to != '') {
				//  echo "hhii";


				$fromtime = strtotime($from);
				$totime = strtotime($to);
				$from_date = date('Y-m-d', $fromtime);
				$to_date = date('Y-m-d', $totime);
				$fromd = $from_date;
				$tod = $to_date;
				$date1 = new DateTime($fromd);
				$date2 = new DateTime($tod);
				$interval = $date1->diff($date2);
				$diff_day =  $interval->days;
				$last_day = $diff_day;


				$vehicle_data = $this->input->post('vehicles');
				$sess_vehicle = $this->session->userdata('vehicles');
				$vehicle_data = $vehicle_data == '' ? $vehicle_data = $sess_vehicle : $vehicle_data = $vehicle_data;
				//	print_r($vehicle_data);exit;
				foreach ($vehicle_data as $list) {

					$vehicle_detail = $this->db->query("SELECT vehiclename,device_type FROM vehicletbl WHERE deviceimei='" . $list . "'");
					$vehicle_info = $vehicle_detail->row();
					$vehiclename = $vehicle_info->vehiclename;
					$device_type = $vehicle_info->device_type;
					$device_imei = $list;
					// print_r($device_type);die;
					$dt = $from_date;
					$day_data = array();

					$gfrom_date = date('Y-m-d H:i:s', $fromtime);
					$gfrom_date1 = $from_date . ' 00:00:00';
					for ($i = 0; $i < ($diff_day + 1); $i++) {
						if ($i == 0 && $last_day == $i) {

							$gfrom_date = date('Y-m-d H:i:s', $fromtime);
							$gto_date = date('Y-m-d H:i:s', $totime);

							$yesterday_distance[] = $this->Smartreport_model->smart_distanceday($list, $gfrom_date, $gto_date, $device_type);
							$yesterday_park[] = $this->Smartreport_model->smart_parkday($list, $gfrom_date, $gto_date);
							$yesterday_idle[] = $this->Smartreport_model->smart_idleday($list, $gfrom_date, $gto_date);
							$yesterday_ign[] = $this->Smartreport_model->smart_ignday($list, $gfrom_date, $gto_date);
							$yesterday_ac[] = $this->Smartreport_model->smart_acday($list, $gfrom_date, $gto_date);
							$yesterday_fill[] = $this->Smartreport_model->smart_fuelfill($list, $gfrom_date, $gto_date);
							$yesterday_dip[] = $this->Smartreport_model->smart_fueldip($list, $gfrom_date, $gto_date);
							$yesterday_consumed[] = $this->Smartreport_model->smart_fuelconsumed($list, $gfrom_date, $gto_date);

							$dd = $dt;
						} elseif ($i == 0 || $last_day == $i) {

							if ($i == 0) {

								$gfrom_date = date('Y-m-d H:i:s', $fromtime);
								$gfrom_date1 = strtotime($gfrom_date);
								$gfrom_date1 = date('Y-m-d', $gfrom_date1);
								$gto_date = $gfrom_date1 . ' 23:59:59';

								$yesterday_distance[] = $this->Smartreport_model->smart_distanceday($list, $gfrom_date, $gto_date, $device_type);
								$yesterday_park[] = $this->Smartreport_model->smart_parkday($list, $gfrom_date, $gto_date);
								$yesterday_idle[] = $this->Smartreport_model->smart_idleday($list, $gfrom_date, $gto_date);
								$yesterday_ign[] = $this->Smartreport_model->smart_ignday($list, $gfrom_date, $gto_date);
								$yesterday_ac[] = $this->Smartreport_model->smart_acday($list, $gfrom_date, $gto_date);
								$yesterday_fill[] = $this->Smartreport_model->smart_fuelfill($list, $gfrom_date, $gto_date);
								$yesterday_dip[] = $this->Smartreport_model->smart_fueldip($list, $gfrom_date, $gto_date);
								$yesterday_consumed[] = $this->Smartreport_model->smart_fuelconsumed($list, $gfrom_date, $gto_date);
								$dd = $dt;
							} elseif ($i == $last_day) {

								$gto_date = date('Y-m-d H:i:s', $totime);
								$gfrom_date = date('Y-m-d', $totime);
								$gfrom_date = $gfrom_date . ' 00:00:00';


								$yesterday_distance[] = $this->Smartreport_model->smart_distanceday($list, $gfrom_date, $gto_date, $device_type);

								$yesterday_park[] = $this->Smartreport_model->smart_parkday($list, $gfrom_date, $gto_date);
								$yesterday_idle[] = $this->Smartreport_model->smart_idleday($list, $gfrom_date, $gto_date);
								$yesterday_ign[] = $this->Smartreport_model->smart_ignday($list, $gfrom_date, $gto_date);
								$yesterday_ac[] = $this->Smartreport_model->smart_acday($list, $gfrom_date, $gto_date);
								$yesterday_fill[] = $this->Smartreport_model->smart_fuelfill($list, $gfrom_date, $gto_date);
								$yesterday_dip[] = $this->Smartreport_model->smart_fueldip($list, $gfrom_date, $gto_date);
								$yesterday_consumed[] = $this->Smartreport_model->smart_fuelconsumed($list, $gfrom_date, $gto_date);
							}
						} else {
							$dd = date('Y-m-d', strtotime("+1 days", strtotime($dt)));
							$all_day[] = $dd;
							$dt = $dd;
						}
					}

					// print_r($all_day);exit;
					if ($all_day) {
						$all_count = count($all_day);
						$start_date = $all_day[0];
						$end_date = $all_day[$all_count - 1];
						$yesterday_distance[] = $this->Smartreport_model->consolidate_distanceday($list, $start_date, $end_date);
						$yesterday_park[] = $this->Smartreport_model->consolidate_parkday($list, $start_date, $end_date);
						$yesterday_idle[] = $this->Smartreport_model->consolidate_idleday($list, $start_date, $end_date);
						$yesterday_ign[] = $this->Smartreport_model->consolidate_ignday($list, $start_date, $end_date);
						$yesterday_ac[] = $this->Smartreport_model->consolidate_acday($list, $start_date, $end_date);
						$yesterday_fill[] = $this->Smartreport_model->consolidate_fuelfill($list, $start_date, $end_date);
						$yesterday_dip[] = $this->Smartreport_model->consolidate_fueldip($list, $start_date, $end_date);
						$yesterday_consumed[] = $this->Smartreport_model->consolidate_fuelconsumed($list, $start_date, $end_date);
					}
				}


				$total_parking = 0;
				// $park_count = count($yesterday_park)-1;
				$park_count = 1;
				$park_count = $park_count == 0 ? $park_count = 1 : $park_count = $park_count;


				foreach ($yesterday_park as $plist) {

					$total_parking += $plist->parking_duration;
					$park_count += $plist->totalcount;
				}
				$idle_count = count($yesterday_idle) - 1;
				$idle_count = $idle_count == 0 ? $idle_count = 1 : $idle_count = $idle_count;

				foreach ($yesterday_idle as $idlist) {

					$total_idle += $idlist->idel_duration;
					$idle_count += $idlist->totalcount;
				}
				$running_count = count($yesterday_ign) - 1;
				$running_count = $running_count == 0 ? $running_count = 1 : $running_count = $running_count;
				foreach ($yesterday_ign as $iglist) {

					$total_running += $iglist->moving_duration;
					$running_count += $iglist->totalcount;
				}

				$ac_count = count($yesterday_ac) - 1;
				$ac_count = $ac_count == 0 ? $ac_count = 1 : $ac_count = $ac_count;
				//	print_r($yesterday_ac);exit;
				foreach ($yesterday_ac as $iglist) {

					$total_ac += $iglist->moving_duration;
					$ac_count += $iglist->totalcount;
				}


				$consume_count = count($yesterday_consumed) - 1;
				$consume_count = $consume_count == 0 ? $consume_count = 1 : $consume_count = $consume_count;
				foreach ($yesterday_consumed as $fclist) {

					$total_fuel_consume += $fclist->fuel_consumed_litre;

					$totalmilege += $fclist->fuel_milege;
					$consume_count += $fclist->totalcount;
				}
				$avg_fuel_consume = $total_fuel_consume / $consume_count;


				foreach ($yesterday_fill as $fllist) {

					$total_fuel_fill += $fllist->fuel_fill_litre;
				}

				foreach ($yesterday_dip as $fdlist) {

					$total_fuel_dip += $fdlist->fuel_dip_litre;
				}

				if ($device_type == 17) {
					$total_kilometer = $milege;
					$avg_kilometer = $total_kilometer / ($diff_day + 1);
				} else {
					$total_kilometer = 0;
					$dis_count = count($yesterday_distance) - 1;
					$dis_count = $dis_count == 0 ? $dis_count = 1 : $dis_count = $dis_count;
					foreach ($yesterday_distance as $dlist) {
						$total_kilometer += $dlist->distance_km;
						$dis_count += $dlist->totalcount;
					}
					$avg_kilometer = $total_kilometer / $dis_count;
				}


				$park_duration = $total_parking; //Parking Duration
				$hours = floor($park_duration / 60);
				$min = $park_duration - ($hours * 60);
				$min = floor((($min -   floor($min / 60) * 60)) / 6);
				$second = $park_duration % 60;
				$tot_park = $hours . ":" . $min . ":" . $second;
				$parts = explode(':', $tot_park);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
				$park_period = $secs / ($park_count * 864) . '%';


				$idle_duration = $total_idle;       // Idle Duration
				$hours = floor($idle_duration / 60);
				$min = $idle_duration - ($hours * 60);
				$min = floor((($min -   floor($min / 60) * 60)) / 6);
				$second = $idle_duration % 60;
				$tot_idle = $hours . ":" . $min . ":" . $second;
				$tot_idle1 = $hours . "." . $min;
				$parts = explode(':', $tot_idle);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
				$idle_period = $secs / ($idle_count * 864) . '%';


				$trip_duration = $total_running; //Trip Duration
				$hours = floor($trip_duration / 60);
				$min = $trip_duration - ($hours * 60);
				$min = floor((($min -   floor($min / 60) * 60)) / 6);
				$second = $trip_duration % 60;
				$tot_trip = $hours . ":" . $min . ":" . $second;
				$tot_trip1 = $hours . "." . $min;
				$parts = explode(':', $tot_trip);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
				$trip_period = $secs / ($running_count * 864) . '%';



				$running_duration = $total_running - $total_idle; //Running Duration
				$hours = floor($running_duration / 60);
				$min = $running_duration - ($hours * 60);
				$min = floor((($min -   floor($min / 60) * 60)) / 6);
				$second = $running_duration % 60;
				$tot_move = $hours . ":" . $min . ":" . $second;
				$tot_move1 = $hours . "." . $min;
				$parts = explode(':', $tot_move);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
				$running_period = $secs / ($running_count * 864) . '%';

				$ac_duration = $total_ac; //AC Duration
				$hours = floor($ac_duration / 60);
				$min = $ac_duration - ($hours * 60);
				$min = floor((($min -   floor($min / 60) * 60)) / 6);
				$second = $ac_duration % 60;
				$tot_ac = $hours . ":" . $min . ":" . $second;
				$tot_ac1 = $hours . "." . $min;
				$parts = explode(':', $tot_ac);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
				$ac_period = $secs / ($ac_count * 864) . '%';


				$normal_duration = $normal_rpm; //Normal RPM Duration
				$hours = floor($normal_duration / 3600);
				$min = ($normal_duration / 60) % 60;
				$second = $normal_duration % 60;
				$tot_normalrpm = $hours . ":" . $min . ":" . $second;
				$tot_normalrpm1 = $hours . "." . $min;
				$parts = explode(':', $tot_normalrpm);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
				//   $normalrpm_period = $secs / ($normalrpm_count*864) . '%'; 

				$load_duration = $under_load; //Load RPM Duration
				$hours = floor($load_duration / 3600);
				$min = ($load_duration / 60) % 60;
				$second = $load_duration % 60;
				$tot_loadrpm = $hours . ":" . $min . ":" . $second;
				$tot_loadrpm1 = $hours . "." . $min;
				$parts = explode(':', $tot_loadrpm);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];

				$idle_duration = $idle_rpm; //Load RPM Duration
				$hours = floor($idle_duration / 3600);
				$min = ($idle_duration / 60) % 60;
				$second = $idle_duration % 60;
				$tot_idlerpm = $hours . ":" . $min . ":" . $second;
				$tot_idlerpm1 = $hours . "." . $min;
				$parts = explode(':', $tot_idlerpm);
				$secs = $parts[0] * 3600 + $parts[1] * 60 + $parts[2];

				$totalrpm_duration = $normal_duration + $load_duration + $idle_duration; //Total RPM Duration
				$hours = floor($totalrpm_duration / 3600);
				$min = ($totalrpm_duration / 60) % 60;
				$min1 = round($min / 60, 1) * 10;
				$second = $totalrpm_duration % 60;
				$tot_rpm = $hours . ":" . $min . ":" . $second;
				$tot_hrpm =  $hours + round($min / 60, 1);


				$avg_running_duration = ($total_running / $running_count); //Average Running Duration
				$hours = floor($avg_running_duration / 60);
				$min = $avg_running_duration - ($hours * 60);
				$min = floor((($min -   floor($min / 60) * 60)) / 6);
				$second = $avg_running_duration % 60;
				$tot_move_avg = $hours . ":" . $min . ":" . $second;

				$milege_per_hour = ($total_fuel_consume / $tot_trip1);
				$avg_moving_fl_cunsume = ($total_fuel_consume / $tot_move1) / $consume_count;
				$moving_fl_cunsume = ($total_fuel_consume / $tot_move1);
				$not_moving_fl_cunsume = ($total_fuel_consume / $tot_idle1);


				$consolidate_data[] = array(
					'vehiclename' => $vehiclename,
					'total_kilometer' => round((int)$total_kilometer, 1),
					'avg_kilometer' => round((int)$avg_kilometer, 1),
					'total_parking' => $tot_park,
					'park_period' => round((int)$park_period, 1),
					'total_idle' => $tot_idle,
					'idle_period' => round((int)$idle_period, 1),
					'tot_trip' => $tot_trip,
					'tot_move' => $tot_move,
					'trip_period' => round((int)$trip_period, 1),
					'running_period' => round((int)$running_period, 1),
					'tot_ac' => $tot_ac,
					'imei' => $device_imei,
					'ac_period' => round((int)$ac_period, 1),
					'avg_tot_move' => $tot_move_avg,
					'avg_fuel_consume' => round((int)$avg_fuel_consume, 1),
					'total_fuel_consume' => $total_fuel_consume,
					'total_fuel_fill' => $total_fuel_fill,
					'total_fuel_dip' => $total_fuel_dip,
					'totalmilege' => $totalmilege,
					'moving_fl_cunsume' => round((int)$moving_fl_cunsume, 1),
					'avg_moving_fl_cunsume' => round((int)$avg_moving_fl_cunsume, 1),
					'not_moving_fl_cunsume' => round((int)$not_moving_fl_cunsume, 1),
					'tot_rpm' => $tot_rpm,
					'tot_hrpm' => $tot_hrpm,
					'tot_normalrpm' => $tot_normalrpm,
					'tot_loadrpm' => $tot_loadrpm,
					'tot_idlerpm' => $tot_idlerpm,
					'normalrpm_period' => round((int)$normalrpm_period, 1),
					'loadrpm_period' => round((int)$loadrpm_period, 1),
					'overloadrpm_period' => round((int)$overloadrpm_period, 1),
				);

				$data['smart_data'] = $this->Smartreport_model->smartAccessDetails();
				// print_r($smart_data);die;
				$data['from_date'] = $from;
				$data['to_date'] = $to;
				$data['consolidate_data'] = $consolidate_data;

				// print_r($data);die;
				$this->load->view('components/header/headerscript');
				$this->load->view('components/header/headernavbar');
				//		$this->load->view('components/mainmenu');
				$this->load->view('reports/smartreport', $data);
				$this->load->view('components/footer/footerscript');
				$this->load->view('components/footer/footer');
			} else {
				echo "123";
			}
		}
	}

	public function reportaccess()
	{

		$smart_data = $this->Smartreport_model->smartAccessDetails();

		$smartid = $smart_data->id;
		$user_id = $smart_data->user_id;
		$client_id = $smart_data->client_id;
		// print_r($smart_data);die;
		// if($smartid && $user_id && $client_id){
		if ($this->input->post('totalKilometer') == 1) {
			$totalKilometer = 1;
		} else {
			$totalKilometer = 0;
		}
		if ($this->input->post('avgDailykm') == 1) {
			$avgDailykm = 1;
		} else {
			$avgDailykm = 0;
		}
		if ($this->input->post('tripTimeHMS') == 1) {
			$tripTimeHMS = 1;
		} else {
			$tripTimeHMS = 0;
		}
		if ($this->input->post('tripTime') == 1) {
			$tripTime = 1;
		} else {
			$tripTime = 0;
		}
		if ($this->input->post('runningTimeHMS') == 1) {
			$runningTimeHMS = 1;
		} else {
			$runningTimeHMS = 0;
		}
		if ($this->input->post('runningTime') == 1) {
			$runningTime = 1;
		} else {
			$runningTime = 0;
		}
		if ($this->input->post('avgDailyRunning') == 1) {
			$avgDailyRunning = 1;
		} else {
			$avgDailyRunning = 0;
		}
		if ($this->input->post('actime') == 1) {
			$actime = 1;
		} else {
			$actime = 0;
		}
		if ($this->input->post('acTimeReport') == 1) {
			$acTimeReport = 1;
		} else {
			$acTimeReport = 0;
		}
		if ($this->input->post('vehicleOprIdle') == 1) {
			$vehicleOprIdle = 1;
		} else {
			$vehicleOprIdle = 0;
		}
		if ($this->input->post('vehicleOprIdleEngineOpr') == 1) {
			$vehicleOprIdleEngineOpr = 1;
		} else {
			$vehicleOprIdleEngineOpr = 0;
		}
		if ($this->input->post('vehicleOff') == 1) {
			$vehicleOff = 1;
		} else {
			$vehicleOff = 0;
		}
		if ($this->input->post('vehicleOffReport') == 1) {
			$vehicleOffReport = 1;
		} else {
			$vehicleOffReport = 0;
		}
		if ($this->input->post('totalEnginerpm') == 1) {
			$totalEnginerpm = 1;
		} else {
			$totalEnginerpm = 0;
		}
		if ($this->input->post('engOprNormalRpm') == 1) {
			$engOprNormalRpm = 1;
		} else {
			$engOprNormalRpm = 0;
		}
		if ($this->input->post('engOprMaximumRpm') == 1) {
			$engOprMaximumRpm = 1;
		} else {
			$engOprMaximumRpm = 0;
		}
		if ($this->input->post('engOprIdle') == 1) {
			$engOprIdle = 1;
		} else {
			$engOprIdle = 0;
		}
		if ($this->input->post('totalActualFuelCon') == 1) {
			$totalActualFuelCon = 1;
		} else {
			$totalActualFuelCon = 0;
		}
		if ($this->input->post('avgDailyFuelCon') == 1) {
			$avgDailyFuelCon = 1;
		} else {
			$avgDailyFuelCon = 0;
		}
		if ($this->input->post('refuelingVol') == 1) {
			$refuelingVol = 1;
		} else {
			$refuelingVol = 0;
		}
		if ($this->input->post('drainingVolume') == 1) {
			$drainingVolume = 1;
		} else {
			$drainingVolume = 0;
		}
		if ($this->input->post('avgActualMil') == 1) {
			$avgActualMil = 1;
		} else {
			$avgActualMil = 0;
		}
		if ($this->input->post('avgActualMilWhenVehicleMoving') == 1) {
			$avgActualMilWhenVehicleMoving = 1;
		} else {
			$avgActualMilWhenVehicleMoving = 0;
		}
		if ($this->input->post('totalActualFuelConwhenVehicleMoving') == 1) {
			$totalActualFuelConwhenVehicleMoving = 1;
		} else {
			$totalActualFuelConwhenVehicleMoving = 0;
		}
		if ($this->input->post('totalActualFuelConWhenVehicleNotMov') == 1) {
			$totalActualFuelConWhenVehicleNotMov = 1;
		} else {
			$totalActualFuelConWhenVehicleNotMov = 0;
		}
		if ($this->input->post('totActualFuelConTimeEngOpr') == 1) {
			$totActualFuelConTimeEngOpr = 1;
		} else {
			$totActualFuelConTimeEngOpr = 0;
		}
		if ($this->input->post('ActualAvgFuelConperHour') == 1) {
			$ActualAvgFuelConperHour = 1;
		} else {
			$ActualAvgFuelConperHour = 0;
		}
		if ($this->input->post('avgDailyActualFuelConperHour') == 1) {
			$avgDailyActualFuelConperHour = 1;
		} else {
			$avgDailyActualFuelConperHour = 0;
		}
		if ($this->input->post('totActualConTimeEngOperInMotion') == 1) {
			$totActualConTimeEngOperInMotion = 1;
		} else {
			$totActualConTimeEngOperInMotion = 0;
		}
		if ($this->input->post('totActualConTimeEngOperInNormalRPM') == 1) {
			$totActualConTimeEngOperInNormalRPM = 1;
		} else {
			$totActualConTimeEngOperInNormalRPM = 0;
		}
		if ($this->input->post('totActualConTimeEngOperInMaxRPM') == 1) {
			$totActualConTimeEngOperInMaxRPM = 1;
		} else {
			$totActualConTimeEngOperInMaxRPM = 0;
		}
		if ($this->input->post('totActualConTimeEngOperunderLoad') == 1) {
			$totActualConTimeEngOperunderLoad = 1;
		} else {
			$totActualConTimeEngOperunderLoad = 0;
		}
		if ($this->input->post('bucketMovTime') == 1) {
			$bucketMovTime = 1;
		} else {
			$bucketMovTime = 0;
		}
		if ($this->input->post('bucketMovTimereportPeriod') == 1) {
			$bucketMovTimereportPeriod = 1;
		} else {
			$bucketMovTimereportPeriod = 0;
		}
		if ($this->input->post('bucketAvgDailyMov') == 1) {
			$bucketAvgDailyMov = 1;
		} else {
			$bucketAvgDailyMov = 0;
		}
		if ($this->input->post('bucketMovIdle') == 1) {
			$bucketMovIdle = 1;
		} else {
			$bucketMovIdle = 0;
		}
		if ($this->input->post('bucketMovIdleEngOpr') == 1) {
			$bucketMovIdleEngOpr = 1;
		} else {
			$bucketMovIdleEngOpr = 0;
		}
		if ($this->input->post('drumMovTimeload') == 1) {
			$drumMovTimeload = 1;
		} else {
			$drumMovTimeload = 0;
		}
		if ($this->input->post('drumMovTimeReportPeriod') == 1) {
			$drumMovTimeReportPeriod = 1;
		} else {
			$drumMovTimeReportPeriod = 0;
		}
		if ($this->input->post('AvgDailyDrumMov') == 1) {
			$AvgDailyDrumMov = 1;
		} else {
			$AvgDailyDrumMov = 0;
		}
		if ($this->input->post('DrumMovtimewithoutLoad') == 1) {
			$DrumMovtimewithoutLoad = 1;
		} else {
			$DrumMovtimewithoutLoad = 0;
		}
		if ($this->input->post('DrumMovmenttimereportPeriod') == 1) {
			$DrumMovmenttimereportPeriod = 1;
		} else {
			$DrumMovmenttimereportPeriod = 0;
		}
		if ($this->input->post('AvgDailymovwithoutLoad') == 1) {
			$AvgDailymovwithoutLoad = 1;
		} else {
			$AvgDailymovwithoutLoad = 0;
		}
		if ($this->input->post('DrumnonMovTime') == 1) {
			$DrumnonMovTime = 1;
		} else {
			$DrumnonMovTime = 0;
		}
		if ($this->input->post('DrumnonMovReport') == 1) {
			$DrumnonMovReport = 1;
		} else {
			$DrumnonMovReport = 0;
		}
		if ($this->input->post('avgTemparature') == 1) {
			$avgTemparature = 1;
		} else {
			$avgTemparature = 0;
		}
		if ($this->input->post('highTemparature') == 1) {
			$highTemparature = 1;
		} else {
			$highTemparature = 0;
		}
		if ($this->input->post('lowTemparature') == 1) {
			$lowTemparature = 1;
		} else {
			$lowTemparature = 0;
		}
		if ($this->input->post('AvgTemVehicleIdle') == 1) {
			$AvgTemVehicleIdle = 1;
		} else {
			$AvgTemVehicleIdle = 0;
		}
		if ($this->input->post('HighTemVehicleIdle') == 1) {
			$HighTemVehicleIdle = 1;
		} else {
			$HighTemVehicleIdle = 0;
		}
		if ($this->input->post('LowTemVehicleIdle') == 1) {
			$LowTemVehicleIdle = 1;
		} else {
			$LowTemVehicleIdle = 0;
		}
		if ($this->input->post('AvgTemVehicleRunning') == 1) {
			$AvgTemVehicleRunning = 1;
		} else {
			$AvgTemVehicleRunning = 0;
		}
		if ($this->input->post('highTemparatureVehicleRunning') == 1) {
			$highTemparatureVehicleRunning = 1;
		} else {
			$highTemparatureVehicleRunning = 0;
		}
		if ($this->input->post('lowTemVehicleRunning') == 1) {
			$lowTemVehicleRunning = 1;
		} else {
			$lowTemVehicleRunning = 0;
		}
		if ($this->input->post('highTemVehicleoff') == 1) {
			$highTemVehicleoff = 1;
		} else {
			$highTemVehicleoff = 0;
		}
		if ($this->input->post('lowTemVehicleoff') == 1) {
			$lowTemVehicleoff = 1;
		} else {
			$lowTemVehicleoff = 0;
		}
		if ($this->input->post('avgTemparature2') == 1) {
			$avgTemparature2 = 1;
		} else {
			$avgTemparature2 = 0;
		}
		if ($this->input->post('highTemparature2') == 1) {
			$highTemparature2 = 1;
		} else {
			$highTemparature2 = 0;
		}
		if ($this->input->post('lowTemparature2') == 1) {
			$lowTemparature2 = 1;
		} else {
			$lowTemparature2 = 0;
		}
		if ($this->input->post('AvgTemVehicleIdle2') == 1) {
			$AvgTemVehicleIdle2 = 1;
		} else {
			$AvgTemVehicleIdle2 = 0;
		}
		if ($this->input->post('HighTemVehicleIdle2') == 1) {
			$HighTemVehicleIdle2 = 1;
		} else {
			$HighTemVehicleIdle2 = 0;
		}
		if ($this->input->post('LowTemVehicleIdle2') == 1) {
			$LowTemVehicleIdle2 = 1;
		} else {
			$LowTemVehicleIdle2 = 0;
		}
		if ($this->input->post('AvgTemVehicleRunning2') == 1) {
			$AvgTemVehicleRunning2 = 1;
		} else {
			$AvgTemVehicleRunning2 = 0;
		}
		if ($this->input->post('highTemVehicleRunning2') == 1) {
			$highTemVehicleRunning2 = 1;
		} else {
			$highTemVehicleRunning2 = 0;
		}
		if ($this->input->post('lowTemVehicleRunning2') == 1) {
			$lowTemVehicleRunning2 = 1;
		} else {
			$lowTemVehicleRunning2 = 0;
		}
		if ($this->input->post('highTemVehicleoff2') == 1) {
			$highTemVehicleoff2 = 1;
		} else {
			$highTemVehicleoff2 = 0;
		}
		if ($this->input->post('lowTemVehicleoff2') == 1) {
			$lowTemVehicleoff2 = 1;
		} else {
			$lowTemVehicleoff2 = 0;
		}
		if ($this->input->post('totalOdometer') == 1) {
			$totalOdometer = 1;
		} else {
			$totalOdometer = 0;
		}
		if ($this->input->post('engineHours') == 1) {
			$engineHours = 1;
		} else {
			$engineHours = 0;
		}
		if ($this->input->post('FuelCon') == 1) {
			$FuelCon = 1;
		} else {
			$FuelCon = 0;
		}
		if ($this->input->post('avgEngineLoad') == 1) {
			$avgEngineLoad = 1;
		} else {
			$avgEngineLoad = 0;
		}
		if ($this->input->post('avgCoolTemp') == 1) {
			$avgCoolTemp = 1;
		} else {
			$avgCoolTemp = 0;
		}

		$user_id = $this->session->userdata('userid');

		$data = array(
			'user_id' => $user_id,
			'totalKilometer' => $totalKilometer,
			'avgDailykm' => $avgDailykm,
			'tripTimeHMS' => $tripTimeHMS,
			'tripTime' => $tripTime,
			'runningTimeHMS' => $runningTimeHMS,
			'runningTime' => $runningTime,
			'avgDailyRunning' => $avgDailyRunning,
			'actime' => $actime,
			'acTimeReport' => $acTimeReport,
			'vehicleOprIdle' => $vehicleOprIdle,
			'vehicleOprIdleEngineOpr' => $vehicleOprIdleEngineOpr,
			'vehicleOff' => $vehicleOff,
			'vehicleOffReport' => $vehicleOffReport,
			'totalEnginerpm' => $totalEnginerpm,
			'engOprNormalRpm' => $engOprNormalRpm,
			'engOprMaximumRpm' => $engOprMaximumRpm,
			'engOprIdle' => $engOprIdle,
			'totalActualFuelCon' => $totalActualFuelCon,
			'avgDailyFuelCon' => $avgDailyFuelCon,
			'refuelingVol' => $refuelingVol,
			'drainingVolume' => $drainingVolume,
			'avgActualMil' => $avgActualMil,
			'avgActualMilWhenVehicleMoving' => $avgActualMilWhenVehicleMoving,
			'totalActualFuelConwhenVehicleMoving' => $totalActualFuelConwhenVehicleMoving,
			'totalActualFuelConWhenVehicleNotMov' => $totalActualFuelConWhenVehicleNotMov,
			'totActualFuelConTimeEngOpr' => $totActualFuelConTimeEngOpr,
			'ActualAvgFuelConperHour' => $ActualAvgFuelConperHour,
			'avgDailyActualFuelConperHour' => $avgDailyActualFuelConperHour,
			'totActualConTimeEngOperInMotion' => $totActualConTimeEngOperInMotion,
			'totActualConTimeEngOperInNormalRPM' => $totActualConTimeEngOperInNormalRPM,
			'totActualConTimeEngOperInMaxRPM' => $totActualConTimeEngOperInMaxRPM,
			'totActualConTimeEngOperunderLoad' => $totActualConTimeEngOperunderLoad,
			'bucketMovTime' => $bucketMovTime,
			'bucketMovTimereportPeriod' => $bucketMovTimereportPeriod,
			'bucketAvgDailyMov' => $bucketAvgDailyMov,
			'bucketMovIdle' => $bucketMovIdle,
			'bucketMovIdleEngOpr' => $bucketMovIdleEngOpr,
			'drumMovTimeload' => $drumMovTimeload,
			'drumMovTimeReportPeriod' => $drumMovTimeReportPeriod,
			'AvgDailyDrumMov' => $AvgDailyDrumMov,
			'DrumMovtimewithoutLoad' => $DrumMovtimewithoutLoad,
			'DrumMovmenttimereportPeriod' => $DrumMovmenttimereportPeriod,
			'AvgDailymovwithoutLoad' => $AvgDailymovwithoutLoad,
			'DrumnonMovTime' => $DrumnonMovTime,
			'DrumnonMovReport' => $DrumnonMovReport,
			'avgTemparature' => $avgTemparature,
			'highTemparature' => $highTemparature,
			'lowTemparature' => $lowTemparature,
			'AvgTemVehicleIdle' => $AvgTemVehicleIdle,
			'HighTemVehicleIdle' => $HighTemVehicleIdle,
			'LowTemVehicleIdle' => $LowTemVehicleIdle,
			'AvgTemVehicleRunning' => $AvgTemVehicleRunning,
			'highTemparatureVehicleRunning' => $highTemparatureVehicleRunning,
			'lowTemVehicleRunning' => $lowTemVehicleRunning,
			'highTemVehicleoff' => $highTemVehicleoff,
			'lowTemVehicleoff' => $lowTemVehicleoff,
			'avgTemparature2' => $avgTemparature2,
			'highTemparature2' => $highTemparature2,
			'lowTemparature2' => $lowTemparature2,
			'AvgTemVehicleIdle2' => $AvgTemVehicleIdle2,
			'HighTemVehicleIdle2' => $HighTemVehicleIdle2,
			'LowTemVehicleIdle2' => $LowTemVehicleIdle2,
			'AvgTemVehicleRunning2' => $AvgTemVehicleRunning2,
			'highTemVehicleRunning2' => $highTemVehicleRunning2,
			'lowTemVehicleRunning2' => $lowTemVehicleRunning2,
			'highTemVehicleoff2' => $highTemVehicleoff2,
			'lowTemVehicleoff2' => $lowTemVehicleoff2,
			'totalOdometer' => $totalOdometer,
			'engineHours' => $engineHours,
			'FuelCon' => $FuelCon,
			'avgEngineLoad' => $avgEngineLoad,
			'avgCoolTemp' => $avgCoolTemp
		);
		$from_date = $this->input->post('fromdate');
		$to_date = $this->input->post('todate');
		$vehicles = $this->input->post("vehicles");
		// print_r($vehicles);exit;

		if ($from_date != '') {
			$user_data = array(
				'fromd' => $from_date,
				'tod' => $to_date,
				'vehicles' => $vehicles
			);

			// print_r($user_data);exit;
			$this->session->set_userdata($user_data);
		}

		//    $this->session->set_userdata($user_data);



		//           echo json_encode($finedata); die;
		if ($smartid == '') {

			$this->db->insert('smart_report_chk', $data);
			redirect(site_url('Smartreport'));
		} else {

			$this->db->where('id', $smartid);
			$this->db->where('user_id', $user_id);
			$this->db->where('client_id', $client_id);
			$this->db->update('smart_report_chk', $data);
			redirect(site_url('Smartreport'));
		}
	}
}
