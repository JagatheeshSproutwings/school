<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Customizer-->
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block">
        <a class="customizer-close" href="#">
            <i class="feather icon-x font-medium-3"></i></a>
            <a class="customizer-toggle bg-danger" href="#">
                <i class="feather icon-settings font-medium-3 fa-spin fa fa-spin fa-fw white"></i>
            </a>
        <div class="customizer-content p-2">
    <h4 class="text-uppercase mb-0">EXECUTIVE REPORT</h4>
    <hr>
        <form action="<?php echo site_url(); ?>Executivereport/reportaccess" method="POST">

            <input type="hidden" name="fromdate" value="<?php echo $this->session->userdata('fromd');?>">
            <input type="hidden" name="todate" value="<?php echo $this->session->userdata('tod');?>">
              <?php 
               foreach($consolidate_data as $list)
                                    { ?>
                                      
                                            <input type="hidden" name="vehicles[]" value="<?=$list['deviceimei'];?>">
                                             
                                         <?php } ?>
    <h5 class="mt-1 text-bold-500">General</h5>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->mileagekm == '1' ? 'checked' : '' ?> class="custom-control-input" name="mileagekm" id="mileagekm">
                <label class="custom-control-label" for="mileagekm">Mileage, km</label>
        </div>

        <div class="custom-control custom-checkbox exebtm">
                <input type="checkbox" value="1" <?php echo $executive_access->startodometer == '1' ? 'checked' : '' ?> class="custom-control-input" name="startodometer" id="startodometer">
                <label class="custom-control-label" for="startodometer">Start Odometer</label>
        </div>

        <div class="custom-control custom-checkbox exebtm">
                <input type="checkbox" value="1" <?php echo $executive_access->endodometer == '1' ? 'checked' : '' ?> class="custom-control-input" name="endodometer" id="endodometer">
                <label class="custom-control-label" for="endodometer">End Odometer</label>
        </div>

        <div class="custom-control custom-checkbox exebtm">
                <input type="checkbox"  value="1" <?php echo $executive_access->startenginehrmeter == '1' ? 'checked' : '' ?> class="custom-control-input" name="startenginehrmeter" id="startenginehrmeter">
                <label class="custom-control-label" for="startenginehrmeter">START Engine hours meter reading</label>
        </div>

        <div class="custom-control custom-checkbox exebtm">
                <input type="checkbox" value="1" <?php echo $executive_access->endenginehrmeter == '1' ? 'checked' : '' ?> class="custom-control-input" name="endenginehrmeter" id="endenginehrmeter">
                <label class="custom-control-label" for="endenginehrmeter">END Engine hours meter reading</label>
        </div>
                <hr>
    <h5 class="mt-1 text-bold-500">Vehicle Movement</h5>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->overspeedmileagekm == '1' ? 'checked' : '' ?> class="custom-control-input" name="overspeedmileagekm" id="overspeedmileagekm">
            <label class="custom-control-label" for="overspeedmileagekm">Overspeed mileage, km</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->avgspeedrunning == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgspeedrunning" id="avgspeedrunning">
            <label class="custom-control-label" for="avgspeedrunning">Average speed in Running, km/h</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->maxspeedkm == '1' ? 'checked' : '' ?> class="custom-control-input" name="maxspeedkm" id="maxspeedkm">
            <label class="custom-control-label" for="maxspeedkm">Maximum speed, km/h</label>
        </div>
        <hr>
    <h5 class="mt-1 text-bold-500">Vehicle Utilization</h5>
          <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->runningtime == '1' ? 'checked' : '' ?> class="custom-control-input" name="runningtime" id="runningtime">
            <label class="custom-control-label" for="runningtime">Running time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->runningtime_percentagerpt == '1' ? 'checked' : '' ?> class="custom-control-input" name="runningtime_percentagerpt" id="runningtime_percentagerpt">
            <label class="custom-control-label" for="runningtime_percentagerpt">Running time, % of the report period</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->idletime_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="idletime_hhmmss" id="idletime_hhmmss">
            <label class="custom-control-label" for="idletime_hhmmss">Idle time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->idletime_percentagerpt == '1' ? 'checked' : '' ?> class="custom-control-input" name="idletime_percentagerpt" id="idletime_percentagerpt">
            <label class="custom-control-label" for="idletime_percentagerpt">Idle time, % of the report period</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->parkingtime_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="parkingtime_hhmmss" id="parkingtime_hhmmss">
            <label class="custom-control-label" for="parkingtime_hhmmss">Parking time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->parkingtime_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="parkingtime_percentage" id="parkingtime_percentage">
            <label class="custom-control-label" for="parkingtime_percentage">Parking time, % of the report period</label>
        </div>
            <hr>
                <h5 class="mt-1 text-bold-500">RPM</h5>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_opr_time_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_opr_time_hhmmss" id="rpm_opr_time_hhmmss">
            <label class="custom-control-label" for="rpm_opr_time_hhmmss">Actual Engine operation time RPM hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_opr_time_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_opr_time_percentage" id="rpm_opr_time_percentage">
            <label class="custom-control-label" for="rpm_opr_time_percentage">Actual Engine operation time RPM, % of the report period</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_opt_normal_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_opt_normal_hhmmss" id="rpm_opt_normal_hhmmss">
            <label class="custom-control-label" for="rpm_opt_normal_hhmmss">Engine operation time at normal RPM, hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_opt_normal_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_opt_normal_percentage" id="rpm_opt_normal_percentage">
            <label class="custom-control-label" for="rpm_opt_normal_percentage">Engine operation time at normal RPM, % of the report period</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_opt_max_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_opt_max_hhmmss" id="rpm_opt_max_hhmmss">
            <label class="custom-control-label" for="rpm_opt_max_hhmmss">Engine operation time at maximum RPM, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_opt_max_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_opt_max_percentage" id="rpm_opt_max_percentage">
            <label class="custom-control-label" for="rpm_opt_max_percentage">Engine operation time at maximum RPM, % of the report period</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_opr_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_opr_hhmmss" id="rpm_opr_hhmmss">
            <label class="custom-control-label" for="rpm_opr_hhmmss">Engine operation time under load, hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->rpm_engine_opr_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="rpm_engine_opr_percentage" id="rpm_engine_opr_percentage">
            <label class="custom-control-label" for="rpm_engine_opr_percentage">Engine operation time under load, % of engine operation time</label>
        </div>
                <hr>
             <h5 class="mt-1 text-bold-500">Fuel</h5>   
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_start_vol == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_start_vol" id="fuel_start_vol">
            <label class="custom-control-label" for="fuel_start_vol">Start volume, l</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_final_vol == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_final_vol" id="fuel_final_vol">
            <label class="custom-control-label" for="fuel_final_vol">Final volume, l</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_actual_fuel_cons == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_actual_fuel_cons" id="fuel_actual_fuel_cons">
            <label class="custom-control-label" for="fuel_actual_fuel_cons">Actual fuel consumption, l</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_refueling_vol == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_refueling_vol" id="fuel_refueling_vol">
            <label class="custom-control-label" for="fuel_refueling_vol">Refueling volume, l</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_draining_vol == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_draining_vol" id="fuel_draining_vol">
            <label class="custom-control-label" for="fuel_draining_vol">Draining volume, l</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_mileage_km == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_mileage_km" id="fuel_mileage_km">
            <label class="custom-control-label" for="fuel_mileage_km">Actual mileage per 1 l, km</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_mileage_vehicle_running_km == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_mileage_vehicle_running_km" id="fuel_mileage_vehicle_running_km">
            <label class="custom-control-label" for="fuel_mileage_vehicle_running_km">Actual mileage per 1 l when Vehicle Running km</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_fuelconsumption_vehicle_running == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_fuelconsumption_vehicle_running" id="fuel_fuelconsumption_vehicle_running">
            <label class="custom-control-label" for="fuel_fuelconsumption_vehicle_running">Actual fuel consumption when Vehicle Running, l</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuel_fuelconsumption_vehicle_idle == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuel_fuelconsumption_vehicle_idle" id="fuel_fuelconsumption_vehicle_idle">
            <label class="custom-control-label" for="fuel_fuelconsumption_vehicle_idle">Actual fuel consumption when Vehicle Idle, l</label>
        </div>
             <hr>
             <h5 class="mt-1 text-bold-500">Engine</h5> 
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuelconsumption_engine_hour == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuelconsumption_engine_hour" id="fuelconsumption_engine_hour">
            <label class="custom-control-label" for="fuelconsumption_engine_hour">Fuel consumption per engine hour, l</label>
        </div>
             <hr>
             <h5 class="mt-1 text-bold-500">Bucket</h5> 
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->bucket_move_time_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucket_move_time_hhmmss" id="bucket_move_time_hhmmss">
            <label class="custom-control-label" for="bucket_move_time_hhmmss">Bucket movement time, hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->bucket_move_time_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucket_move_time_percentage" id="bucket_move_time_percentage">
            <label class="custom-control-label" for="bucket_move_time_percentage">Bucket movement time, (% of the report period)</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->bucket_idle_time_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucket_idle_time_hhmmss" id="bucket_idle_time_hhmmss">
            <label class="custom-control-label" for="bucket_idle_time_hhmmss">Bucket movement idle time, hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->bucket_idle_time_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucket_idle_time_percentage" id="bucket_idle_time_percentage">
            <label class="custom-control-label" for="bucket_idle_time_percentage">Bucket movement idle time, (% of engine operation time)</label>
        </div>
             <hr>
             <h5 class="mt-1 text-bold-500">DRUM</h5>   
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->drumnonmvt_time_with_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumnonmvt_time_with_hhmmss" id="drumnonmvt_time_with_hhmmss">
            <label class="custom-control-label" for="drumnonmvt_time_with_hhmmss">Drum Movements time with Load, hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->drumnonmvt_time_with_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumnonmvt_time_with_percentage" id="drumnonmvt_time_with_percentage">
            <label class="custom-control-label" for="drumnonmvt_time_with_percentage">Drum Movements time with Load, (% of the report period)</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->drumnonmvt_time_withoutload_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumnonmvt_time_withoutload_hhmmss" id="drumnonmvt_time_withoutload_hhmmss">
            <label class="custom-control-label" for="drumnonmvt_time_withoutload_hhmmss">Drum Movements time without Load, hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->drumnonmvt_time_withoutload_per == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumnonmvt_time_withoutload_per" id="drumnonmvt_time_withoutload_per">
            <label class="custom-control-label" for="drumnonmvt_time_withoutload_per">Drum Movements time without Load, (% of the report period)</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->drumnonmvt_time_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumnonmvt_time_hhmmss" id="drumnonmvt_time_hhmmss">
            <label class="custom-control-label" for="drumnonmvt_time_hhmmss">Drum non Movements time, hour:min:sec</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->drumnonmvt_time_percentage == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumnonmvt_time_percentage" id="drumnonmvt_time_percentage">
            <label class="custom-control-label" for="drumnonmvt_time_percentage">Drum non Movements time, (% of the report period)</label>
        </div>
                <hr>
                <h5 class="mt-1 text-bold-500">OBD</h5>   
                
                <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->reading_can_odomtr_start == '1' ? 'checked' : '' ?> class="custom-control-input" name="reading_can_odomtr_start" id="reading_can_odomtr_start">
            <label class="custom-control-label" for="reading_can_odomtr_start">Reading of CAN odometer at the beginning of the period, km</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->reading_can_odomtr_end == '1' ? 'checked' : '' ?> class="custom-control-input" name="reading_can_odomtr_end" id="reading_can_odomtr_end">
            <label class="custom-control-label" for="reading_can_odomtr_end">Reading of CAN odometer at the end of the period, km</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuelconsumptionmeter == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuelconsumptionmeter" id="fuelconsumptionmeter">
            <label class="custom-control-label" for="fuelconsumptionmeter">Fuel consumption meter reading, l</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->nbsp_sec == '1' ? 'checked' : '' ?> class="custom-control-input" name="nbsp_sec" id="nbsp_sec">
            <label class="custom-control-label" for="nbsp_sec">&nbsp;</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->enginehours_hhmmss == '1' ? 'checked' : '' ?> class="custom-control-input" name="enginehours_hhmmss" id="enginehours_hhmmss">
            <label class="custom-control-label" for="enginehours_hhmmss">Engine hours, hh:mm</label>
        </div>
 <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $executive_access->fuelconsumption1 == '1' ? 'checked' : '' ?> class="custom-control-input" name="fuelconsumption1" id="fuelconsumption1">
             <label class="custom-control-label" for="fuelconsumption1">Fuel consumption, l</label>
        </div>           
                
                <br>
    <div class="form-group">
        <!-- Outline Button group -->
        <div class="btn-group customizer-sidebar-options" role="group" aria-label="Basic example">
            <button type="submit" class="btn btn btn-warning mt-1" name="submit">Save</button>
        </div>
    </div>
                </form>
</div>
    </div>
    <!-- End: Customizer-->

    
    
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Executive Report</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Home</a> </li>
                                <li class="breadcrumb-item active">Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                            <div class="card info-time-tracking">
                                <div class="card-content" style="overflow: scroll">
                                    <div class="row">
                                        <div class="col-12">
                                    <table id="executivereport" class="table table-striped table-bordered zero-configuration">
                                        <tr>
                                            <th colspan="3" class="excth"></th>
                                            <th colspan="<?= $general ?>" class="excth <?= $general == '0' ? 'displaynone' : '' ?>">General</th>
                                            <th colspan="<?= $vehicle_movement ?>" class="excth <?= $vehicle_movement == '0' ? 'displaynone' : '' ?>">Vehicle Movement</th>
                                            <th colspan="<?= $vehicle_utilization ?>" class="excth <?= $vehicle_utilization == '0' ? 'displaynone' : '' ?>"> Vehicle Utilization</th>
                                            <th colspan="<?= $vehicle_rpm ?>" class="excth <?= $vehicle_rpm == '0' ? 'displaynone' : '' ?>">RPM</th>
                                            <th colspan="<?= $vehicle_fuel ?>" class="excth <?= $vehicle_fuel == '0' ? 'displaynone' : '' ?>">Fuel</th>
                                            <th colspan="<?= $vehicle_engine ?>" class="excth <?= $vehicle_engine == '0' ? 'displaynone' : '' ?>">Engine</th>
                                            <th colspan="<?= $vehicle_bucket ?>" class="excth <?= $vehicle_bucket == '0' ? 'displaynone' : '' ?>">Bucket</th>
                                            <th colspan="<?= $vehicle_drum ?>" class="excth <?= $vehicle_drum == '0' ? 'displaynone' : '' ?>">DRUM</th>
                                            <th colspan="<?= $vehicle_obd ?>" class="excth <?= $vehicle_obd == '0' ? 'displaynone' : '' ?>">OBD</th>

                                        </tr>
                                        <tr>
                                            <td class="graycolor">Vehicle name</td>
                                            <td class="graycolor">Group of vehicles</td>
                                            <td class="graycolor">Date</td>
                                            <td class="yellowclr <?php echo $executive_access->mileagekm == '0' ? 'displaynone' : '' ?>">Distance (km)</td>
                                            <td class="yellowclr <?php echo $executive_access->startodometer == '0' ? 'displaynone' : '' ?>">Start Odometer</td>
                                            <td class="yellowclr <?php echo $executive_access->endodometer == '0' ? 'displaynone' : '' ?>">End Odometer</td>
                                            <td class="yellowclr <?php echo $executive_access->startenginehrmeter == '0' ? 'displaynone' : '' ?>">START Engine hours meter reading</td>
                                            <td class="yellowclr <?php echo $executive_access->endenginehrmeter == '0' ? 'displaynone' : '' ?>">END Engine hours meter reading</td>
                                            <td class="orngeclr <?php echo $executive_access->overspeedmileagekm == '0' ? 'displaynone' : '' ?>">Overspeed mileage, km</td>
                                            <td class="orngeclr <?php echo $executive_access->avgspeedrunning == '0' ? 'displaynone' : '' ?>">Average speed in Running, km/h</td>
                                            <td class="orngeclr <?php echo $executive_access->maxspeedkm == '0' ? 'displaynone' : '' ?>">Maximum speed, km/h</td>
                                            <td class="greenclr <?php echo $executive_access->runningtime == '0' ? 'displaynone' : '' ?>">Running time, hh:mm:ss</td>
                                            <td class="greenclr <?php echo $executive_access->runningtime_percentagerpt == '0' ? 'displaynone' : '' ?>">Running time, % of the report period</td>
                                            <td class="greenclr <?php echo $executive_access->idletime_hhmmss == '0' ? 'displaynone' : '' ?>">Idle time, hh:mm:ss</td>
                                            <td class="greenclr <?php echo $executive_access->idletime_percentagerpt == '0' ? 'displaynone' : '' ?>">Idle  time, % of the report period</td>
                                            <td class="greenclr <?php echo $executive_access->parkingtime_hhmmss == '0' ? 'displaynone' : '' ?>">Parking time, hh:mm:ss</td>
                                            <td class="greenclr <?php echo $executive_access->parkingtime_percentage == '0' ? 'displaynone' : '' ?>">Parking  time, % of the report period</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_opr_time_hhmmss == '0' ? 'displaynone' : '' ?>">Actual Engine operation time RPM hour:min:sec</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_opr_time_percentage == '0' ? 'displaynone' : '' ?>">Actual Engine operation time RPM, % of the report period</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_opt_normal_hhmmss == '0' ? 'displaynone' : '' ?>">Engine operation time at normal RPM, hour:min:sec</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_opt_normal_percentage == '0' ? 'displaynone' : '' ?>">Engine operation time at normal RPM, % of the report period</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_opt_max_hhmmss == '0' ? 'displaynone' : '' ?>">Engine operation time at maximum RPM, hh:mm:ss</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_opt_max_percentage == '0' ? 'displaynone' : '' ?>">Engine operation time at maximum RPM, % of the report period</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_opr_hhmmss == '0' ? 'displaynone' : '' ?>">Engine operation Idle Time, hour:min:sec</td>
                                            <td class="blueclr <?php echo $executive_access->rpm_engine_opr_percentage == '0' ? 'displaynone' : '' ?>">Engine operation Idle time, % of engine operation time</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_start_vol == '0' ? 'displaynone' : '' ?>">Start volume, l</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_final_vol == '0' ? 'displaynone' : '' ?>">Final volume, l</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_actual_fuel_cons == '0' ? 'displaynone' : '' ?>">Actual fuel consumption, l</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_refueling_vol == '0' ? 'displaynone' : '' ?>">Refueling volume, l</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_draining_vol == '0' ? 'displaynone' : '' ?>">Draining volume, l</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_mileage_km == '0' ? 'displaynone' : '' ?>">Actual mileage per 1 l, km</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_mileage_vehicle_running_km == '0' ? 'displaynone' : '' ?>">Actual mileage per 1 l  when Vehicle Running km</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_fuelconsumption_vehicle_running == '0' ? 'displaynone' : '' ?>">Actual fuel consumption when Vehicle Running, l</td>
                                            <td class="lightgreenclr <?php echo $executive_access->fuel_fuelconsumption_vehicle_idle == '0' ? 'displaynone' : '' ?>">Actual fuel consumption when Vehicle Idle, l</td>
                                            <td class="burppleclr <?php echo $executive_access->fuelconsumption_engine_hour == '0' ? 'displaynone' : '' ?>">Fuel consumption per engine hour, l</td>
                                            <td class="brownclr <?php echo $executive_access->bucket_move_time_hhmmss == '0' ? 'displaynone' : '' ?>">Bucket  movement  time, hour:min:sec</td>
                                            <td class="brownclr <?php echo $executive_access->bucket_move_time_percentage == '0' ? 'displaynone' : '' ?>">Bucket movement   time, (% of the report period)</td>
                                            <td class="brownclr <?php echo $executive_access->bucket_idle_time_hhmmss == '0' ? 'displaynone' : '' ?>">Bucket movement idle time, hour:min:sec</td>
                                            <td class="brownclr <?php echo $executive_access->bucket_idle_time_percentage == '0' ? 'displaynone' : '' ?>">Bucket movement idle time, (% of engine operation time)</td>
                                            <td class="lgtblueclr <?php echo $executive_access->drumnonmvt_time_with_hhmmss == '0' ? 'displaynone' : '' ?>">Drum Movements  time with Load, hour:min:sec</td>
                                            <td class="lgtblueclr <?php echo $executive_access->drumnonmvt_time_with_percentage == '0' ? 'displaynone' : '' ?>">Drum Movements  time with Load, (% of the report period)</td>
                                            <td class="lgtblueclr <?php echo $executive_access->drumnonmvt_time_withoutload_hhmmss == '0' ? 'displaynone' : '' ?>">Drum Movements  time without Load, hour:min:sec</td>
                                            <td class="lgtblueclr <?php echo $executive_access->drumnonmvt_time_withoutload_per == '0' ? 'displaynone' : '' ?>">Drum Movements  time without Load, (% of the report period)</td>
                                            <td class="lgtblueclr <?php echo $executive_access->drumnonmvt_time_hhmmss == '0' ? 'displaynone' : '' ?>">Drum non Movements  time, hour:min:sec</td>
                                            <td class="lgtblueclr <?php echo $executive_access->drumnonmvt_time_percentage == '0' ? 'displaynone' : '' ?>">Drum non Movements  time, (% of the report period)</td>
                                            <td class="lgtorangeclr <?php echo $executive_access->reading_can_odomtr_start == '0' ? 'displaynone' : '' ?>">Reading of CAN odometer at the beginning of the period, km</td>
                                            <td class="lgtorangeclr <?php echo $executive_access->reading_can_odomtr_end == '0' ? 'displaynone' : '' ?>">Reading of CAN odometer at the end of the period, km</td>
                                            <td class="lgtorangeclr <?php echo $executive_access->fuelconsumptionmeter == '0' ? 'displaynone' : '' ?>">Fuel consumption meter reading, l</td>
                                            <td class="lgtorangeclr <?php echo $executive_access->nbsp_sec == '0' ? 'displaynone' : '' ?>">&nbsp;&nbsp;&nbsp;</td>
                                            <td class="lgtorangeclr <?php echo $executive_access->enginehours_hhmmss == '0' ? 'displaynone' : '' ?>">Engine hours, hh:mm</td>
                                            <td class="lgtorangeclr <?php echo $executive_access->fuelconsumption1 == '0' ? 'displaynone' : '' ?>">Fuel consumption, l</td>

                                        </tr>
                                        <?php 
                                 //   print_r($consolidate_data);
                                    $i=0;
                                    foreach($consolidate_data as $list)
                                    {?>
                                
                                            <?php foreach($list['day_data'] as $dlist=>$value){?>
                                        <tr>
                                           
                                             <td><b><?=$list['vehicle'];?></b></td>
                                             <td></td>
                                             <td><?=date("d-m-Y",strtotime($dlist));?></td>
                                            <td class="<?= $executive_access->mileagekm == '0' ? 'displaynone' : '' ?>"><?=$value['distance'];?></td>
                                            <td class="<?= $executive_access->startodometer == '0' ? 'displaynone' : '' ?>"><?=$value['start_odometer'];?></td>
                                            <td class="<?= $executive_access->endodometer == '0' ? 'displaynone' : '' ?>"><?=$value['end_odometer'];?></td>
                                            <td class="<?= $executive_access->startenginehrmeter == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->endenginehrmeter == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->overspeedmileagekm == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->avgspeedrunning == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->maxspeedkm == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->runningtime == '0' ? 'displaynone' : '' ?>"><?=$value['ign'];?></td>
                                            <td class="<?= $executive_access->runningtime_percentagerpt == '0' ? 'displaynone' : '' ?>"><?=$value['running_period'].'%';?></td>
                                            <td class="<?= $executive_access->idletime_hhmmss == '0' ? 'displaynone' : '' ?>"><?=$value['idle'];?></td>
                                            <td class="<?= $executive_access->idletime_percentagerpt == '0' ? 'displaynone' : '' ?>"><?=$value['idle_period'].'%';?></td>
                                            <td class="<?= $executive_access->parkingtime_hhmmss == '0' ? 'displaynone' : '' ?>"><?=$value['park'];?></td>
                                            <td class="<?= $executive_access->parkingtime_percentage == '0' ? 'displaynone' : '' ?>"><?=$value['park_period'].'%';?></td>
                                            <td class="<?= $executive_access->rpm_opr_time_hhmmss == '0' ? 'displaynone' : '' ?>"><?=$value['tot_rpm'];?></td>
                                            <td class="<?= $executive_access->rpm_opr_time_percentage == '0' ? 'displaynone' : '' ?>"><?=$value['tot_rpm_period'].'%';?></td>
                                            <td class="<?= $executive_access->rpm_opt_normal_hhmmss == '0' ? 'displaynone' : '' ?>"><?=$value['tot_normalrpm'];?></td>
                                            <td class="<?= $executive_access->rpm_opt_normal_percentage == '0' ? 'displaynone' : '' ?>"><?=$value['normalrpm_period'].'%';?></td>
                                            <td class="<?= $executive_access->rpm_opt_max_hhmmss == '0' ? 'displaynone' : '' ?>"><?=$value['tot_loadrpm'];?></td>
                                            <td class="<?= $executive_access->rpm_opt_max_percentage == '0' ? 'displaynone' : '' ?>"><?=$value['loadrpm_period'].'%';?></td>
                                            <td class="<?= $executive_access->rpm_opr_hhmmss == '0' ? 'displaynone' : '' ?>"><?=$value['tot_idlerpm'];?></td>
                                            <td class="<?= $executive_access->rpm_engine_opr_percentage == '0' ? 'displaynone' : '' ?>"><?=$value['idlerpm_period'].'%';?></td>
                                            <td class="<?= $executive_access->fuel_start_vol == '0' ? 'displaynone' : '' ?>"><?=$value['start_fuel'];?></td>
                                            <td class="<?= $executive_access->fuel_final_vol == '0' ? 'displaynone' : '' ?>"><?=$value['end_fuel'];?></td>
                                            <td class="<?= $executive_access->fuel_actual_fuel_cons == '0' ? 'displaynone' : '' ?>"><?=$value['consumed'];?></td>
                                            <td class="<?= $executive_access->fuel_refueling_vol == '0' ? 'displaynone' : '' ?>"><?=$value['fill'];?></td>
                                            <td class="<?= $executive_access->fuel_draining_vol == '0' ? 'displaynone' : '' ?>"><?=$value['dip'];?></td>
                                            <td class="<?= $executive_access->fuel_mileage_km == '0' ? 'displaynone' : '' ?>"><?=$value['fuel_millege'];?></td>
                                            <td class="<?= $executive_access->fuel_mileage_vehicle_running_km == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->fuel_fuelconsumption_vehicle_running == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->fuel_fuelconsumption_vehicle_idle == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->fuelconsumption_engine_hour == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->bucket_move_time_hhmmss == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->bucket_move_time_percentage == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->bucket_idle_time_hhmmss == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->bucket_idle_time_percentage == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->drumnonmvt_time_with_hhmmss == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->drumnonmvt_time_with_percentage == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->drumnonmvt_time_withoutload_hhmmss == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->drumnonmvt_time_withoutload_per == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->drumnonmvt_time_hhmmss == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->drumnonmvt_time_percentage == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->reading_can_odomtr_start == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->reading_can_odomtr_end == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->fuelconsumptionmeter == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->nbsp_sec == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->enginehours_hhmmss == '0' ? 'displaynone' : '' ?>"></td>
                                            <td class="<?= $executive_access->fuelconsumption1 == '0' ? 'displaynone' : '' ?>"></td>
                                           
                                        </tr>
                                    <?php } } ?>
                                    </table>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        
             $( document ).ready(function() {
        $('#executivereport').DataTable({
             pageLength: 0,
    lengthMenu: [3, 5, 10, 20, 50, 100],
      dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
     });
        </script>