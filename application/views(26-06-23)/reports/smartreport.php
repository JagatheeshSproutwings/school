<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Customizer-->
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block">
        <a class="customizer-close" href="#">
            <i class="feather icon-x font-medium-3"></i></a>
            <a class="customizer-toggle bg-danger" href="#">
                <i class="feather icon-settings font-medium-3 fa-spin fa fa-spin fa-fw white"></i>
            </a>
        <div class="customizer-content p-2">
    <h4 class="text-uppercase mb-0">SMART REPORT</h4>
    <hr>
        <form action="<?php echo site_url(); ?>Smartreport/reportaccess" method="POST">

            <input type="hidden" name="fromdate" value="<?php echo $from_date;?>">
            <input type="hidden" name="todate" value="<?php echo $to_date;?>">
              <?php 
               foreach($consolidate_data as $list)
                                    { ?>
                                      
                                            <input type="hidden" name="vehicles[]" value="<?=$list['imei'];?>">
                                             
                                         <?php } ?>
       <h5 class="mt-1 text-bold-500">Vehicle Movement</h5>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totalKilometer == '1' ? 'checked' : '' ?> class="custom-control-input" name="totalKilometer" id="totalKilometer">
            <label class="custom-control-label" for="totalKilometer">Total Kilometer</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgDailykm == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgDailykm" id="avgDailykm">
            <label class="custom-control-label" for="avgDailykm">Average Daily Kilometer</label>
        </div>

        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->tripTimeHMS == '1' ? 'checked' : '' ?> class="custom-control-input" name="tripTimeHMS" id="tripTimeHMS">
            <label class="custom-control-label" for="tripTimeHMS">Trip Time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->tripTime == '1' ? 'checked' : '' ?> class="custom-control-input" name="tripTime" id="tripTime">
            <label class="custom-control-label" for="tripTime">Trip Time, (% of the report period)</label>
        </div>

        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->runningTimeHMS == '1' ? 'checked' : '' ?> class="custom-control-input" name="runningTimeHMS" id="runningTimeHMS">
            <label class="custom-control-label" for="runningTimeHMS">Running Time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->runningTime == '1' ? 'checked' : '' ?> class="custom-control-input" name="runningTime" id="runningTime">
            <label class="custom-control-label" for="runningTime">Running Time, (% of the report period)</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgDailyRunning == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgDailyRunning" id="avgDailyRunning">
            <label class="custom-control-label" for="avgDailyRunning">Average Daily Running Time, hh:mm:ss</label>
        </div> 
         <!-- <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->actime == '1' ? 'checked' : '' ?> class="custom-control-input" name="actime" id="actime">
            <label class="custom-control-label" for="actime">AC Time, hh:mm:ss</label>
        </div>  
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->acTimeReport == '1' ? 'checked' : '' ?> class="custom-control-input" name="acTimeReport" id="acTimeReport">
            <label class="custom-control-label" for="acTimeReport">AC Time, (% of the report period)</label>
        </div>  -->
         <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->vehicleOprIdle == '1' ? 'checked' : '' ?> class="custom-control-input" name="vehicleOprIdle" id="vehicleOprIdle">
            <label class="custom-control-label" for="vehicleOprIdle">Vehicle Operation Idle Time, hh:mm:ss</label>
        </div> 
         <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->vehicleOprIdleEngineOpr == '1' ? 'checked' : '' ?> class="custom-control-input" name="vehicleOprIdleEngineOpr" id="vehicleOprIdleEngineOpr">
            <label class="custom-control-label" for="vehicleOprIdleEngineOpr">Vehicle Operation Idle Time, (% of engine operation time)</label>
        </div> 
         <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->vehicleOff == '1' ? 'checked' : '' ?> class="custom-control-input" name="vehicleOff" id="vehicleOff">
            <label class="custom-control-label" for="vehicleOff">Vehicle Off(Parking)time, hh:mm:ss</label>
        </div> 
         <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->vehicleOffReport == '1' ? 'checked' : '' ?> class="custom-control-input" name="vehicleOffReport" id="vehicleOffReport">
            <label class="custom-control-label" for="vehicleOffReport">Vehicle Off(Parking)time, (% of the report period)</label>
        </div>
        <hr>
    <!-- <h5 class="mt-1 text-bold-500">Engine RPM</h5>
          <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totalEnginerpm == '1' ? 'checked' : '' ?> class="custom-control-input" name="totalEnginerpm" id="totalEnginerpm">
            <label class="custom-control-label" for="totalEnginerpm">Total Engine RPM hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->engOprNormalRpm == '1' ? 'checked' : '' ?> class="custom-control-input" name="engOprNormalRpm" id="engOprNormalRpm">
            <label class="custom-control-label" for="engOprNormalRpm">Engine Operation time at normal RPM, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->engOprMaximumRpm == '1' ? 'checked' : '' ?> class="custom-control-input" name="engOprMaximumRpm" id="engOprMaximumRpm">
            <label class="custom-control-label" for="engOprMaximumRpm">Engine Operation time at Maximum RPM, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->engOprIdle == '1' ? 'checked' : '' ?> class="custom-control-input" name="engOprIdle" id="engOprIdle">
            <label class="custom-control-label" for="engOprIdle">Engine Operation time Idle, hh:mm:ss</label>
        </div>

            <hr> -->
                <!-- <h5 class="mt-1 text-bold-500">FUEL</h5>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totalActualFuelCon == '1' ? 'checked' : '' ?> class="custom-control-input" name="totalActualFuelCon" id="totalActualFuelCon">
            <label class="custom-control-label" for="totalActualFuelCon">Total Actual Fuel Consumption, I</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgDailyFuelCon == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgDailyFuelCon" id="avgDailyFuelCon">
            <label class="custom-control-label" for="avgDailyFuelCon">Average Daily Fuel Consumption, I</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->refuelingVol == '1' ? 'checked' : '' ?> class="custom-control-input" name="refuelingVol" id="refuelingVol">
            <label class="custom-control-label" for="refuelingVol">Refueling Volume, I</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->drainingVolume == '1' ? 'checked' : '' ?> class="custom-control-input" name="drainingVolume" id="drainingVolume">
            <label class="custom-control-label" for="drainingVolume">Draining Volume, I</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgActualMil == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgActualMil" id="avgActualMil">
            <label class="custom-control-label" for="avgActualMil">Average Actual Mileage per 1 I,km</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgActualMilWhenVehicleMoving == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgActualMilWhenVehicleMoving" id="avgActualMilWhenVehicleMoving">
            <label class="custom-control-label" for="avgActualMilWhenVehicleMoving">Average Actual Mileage per 1 I when Vehicle in Moving</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totalActualFuelConwhenVehicleMoving == '1' ? 'checked' : '' ?> class="custom-control-input" name="totalActualFuelConwhenVehicleMoving" id="totalActualFuelConwhenVehicleMoving">
            <label class="custom-control-label" for="totalActualFuelConwhenVehicleMoving">Total Actual Fuel Comsumption when Vehicle in Moving, I</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totalActualFuelConWhenVehicleNotMov == '1' ? 'checked' : '' ?> class="custom-control-input" name="totalActualFuelConWhenVehicleNotMov" id="totalActualFuelConWhenVehicleNotMov">
            <label class="custom-control-label" for="totalActualFuelConWhenVehicleNotMov">Total Actual Fuel Consumption when Vehicle in not Moving, I</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totActualFuelConTimeEngOpr == '1' ? 'checked' : '' ?> class="custom-control-input" name="totActualFuelConTimeEngOpr" id="totActualFuelConTimeEngOpr">
            <label class="custom-control-label" for="totActualFuelConTimeEngOpr">Total Actual Fuel Consumtion During the Time of Engine Operation, I</label>
        </div> <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->ActualAvgFuelConperHour == '1' ? 'checked' : '' ?> class="custom-control-input" name="ActualAvgFuelConperHour" id="ActualAvgFuelConperHour">
            <label class="custom-control-label" for="ActualAvgFuelConperHour">Actual average Fuel Consumption per Engine Hour, I</label>
        </div> <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgDailyActualFuelConperHour == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgDailyActualFuelConperHour" id="avgDailyActualFuelConperHour">
            <label class="custom-control-label" for="avgDailyActualFuelConperHour">Average Daily actual Fuel Consumption per hour of Engine Operation, I</label>
        </div>
                <hr> -->
             <!-- <h5 class="mt-1 text-bold-500">FUEL (RPM)</h5>   
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totActualConTimeEngOperInMotion == '1' ? 'checked' : '' ?> class="custom-control-input" name="totActualConTimeEngOperInMotion" id="totActualConTimeEngOperInMotion">
            <label class="custom-control-label" for="totActualConTimeEngOperInMotion">Total Actual Consumtion during the Time of Engine Operation in motion, L</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totActualConTimeEngOperInNormalRPM == '1' ? 'checked' : '' ?> class="custom-control-input" name="totActualConTimeEngOperInNormalRPM" id="totActualConTimeEngOperInNormalRPM">
            <label class="custom-control-label" for="totActualConTimeEngOperInNormalRPM">Total Actual Consumtion during the Time of Engine Operation time at Normal RPM, L</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totActualConTimeEngOperInMaxRPM == '1' ? 'checked' : '' ?> class="custom-control-input" name="totActualConTimeEngOperInMaxRPM" id="totActualConTimeEngOperInMaxRPM">
            <label class="custom-control-label" for="totActualConTimeEngOperInMaxRPM">Total Actual Consumtion during the Time of Engine Operation time at Maximum RPM, L</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totActualConTimeEngOperunderLoad == '1' ? 'checked' : '' ?> class="custom-control-input" name="totActualConTimeEngOperunderLoad" id="totActualConTimeEngOperunderLoad">
            <label class="custom-control-label" for="totActualConTimeEngOperunderLoad">Total Actual Consumtion during the Time of Engine Operation time under Load, L</label>
        </div>
        
                <hr>
                <h5 class="mt-1 text-bold-500">Bucket Movements</h5>   
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->bucketMovTime == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucketMovTime" id="bucketMovTime">
            <label class="custom-control-label" for="bucketMovTime">Bucket Movement time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->bucketMovTimereportPeriod == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucketMovTimereportPeriod" id="bucketMovTimereportPeriod">
            <label class="custom-control-label" for="bucketMovTimereportPeriod">Bucket Movement Time, (% of the report period)</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->bucketAvgDailyMov == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucketAvgDailyMov" id="bucketAvgDailyMov">
            <label class="custom-control-label" for="bucketAvgDailyMov">Bucket Average Daily Movement Time,hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->bucketMovIdle == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucketMovIdle" id="bucketMovIdle">
            <label class="custom-control-label" for="bucketMovIdle">Bucket Movement Idle time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->bucketMovIdleEngOpr == '1' ? 'checked' : '' ?> class="custom-control-input" name="bucketMovIdleEngOpr" id="bucketMovIdleEngOpr">
            <label class="custom-control-label" for="bucketMovIdleEngOpr">Bucket Movement Idle time, (% of engine operation time)</label>
        </div>
        
                <hr>
                <h5 class="mt-1 text-bold-500">Drum Movements</h5>   
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->drumMovTimeload == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumMovTimeload" id="drumMovTimeload">
            <label class="custom-control-label" for="drumMovTimeload">Drum Movements time with load, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->drumMovTimeReportPeriod == '1' ? 'checked' : '' ?> class="custom-control-input" name="drumMovTimeReportPeriod" id="drumMovTimeReportPeriod">
            <label class="custom-control-label" for="drumMovTimeReportPeriod">Drum Movements time with load, (% of the report period)</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->AvgDailyDrumMov == '1' ? 'checked' : '' ?> class="custom-control-input" name="AvgDailyDrumMov" id="AvgDailyDrumMov">
            <label class="custom-control-label" for="AvgDailyDrumMov">Average Daily Drum Movements time with load, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->DrumMovtimewithoutLoad == '1' ? 'checked' : '' ?> class="custom-control-input" name="DrumMovtimewithoutLoad" id="DrumMovtimewithoutLoad">
            <label class="custom-control-label" for="DrumMovtimewithoutLoad">Drum Movements time without load, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->DrumMovmenttimereportPeriod == '1' ? 'checked' : '' ?> class="custom-control-input" name="DrumMovmenttimereportPeriod" id="DrumMovmenttimereportPeriod">
            <label class="custom-control-label" for="DrumMovmenttimereportPeriod">Drum Movements time without load, (% of the report period)</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->AvgDailymovwithoutLoad == '1' ? 'checked' : '' ?> class="custom-control-input" name="AvgDailymovwithoutLoad" id="AvgDailymovwithoutLoad">
            <label class="custom-control-label" for="AvgDailymovwithoutLoad">Average Daily Drum Movements time without load,hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->DrumnonMovTime == '1' ? 'checked' : '' ?> class="custom-control-input" name="DrumnonMovTime" id="DrumnonMovTime">
            <label class="custom-control-label" for="DrumnonMovTime">Drum non Movements time, hh:mm:ss</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->DrumnonMovReport == '1' ? 'checked' : '' ?> class="custom-control-input" name="DrumnonMovReport" id="DrumnonMovReport">
            <label class="custom-control-label" for="DrumnonMovReport">Drum non Movements Time, (% of the report period)</label>
        </div>
                <hr>
                <h5 class="mt-1 text-bold-500">Temperature(1)</h5>   
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgTemparature == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgTemparature" id="avgTemparature">
            <label class="custom-control-label" for="avgTemparature">Average Temperature</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->highTemparature == '1' ? 'checked' : '' ?> class="custom-control-input" name="highTemparature" id="highTemparature">
            <label class="custom-control-label" for="highTemparature">Highest Temparature</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->lowTemparature == '1' ? 'checked' : '' ?> class="custom-control-input" name="lowTemparature" id="lowTemparature">
            <label class="custom-control-label" for="lowTemparature">Lowest Temparature</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->AvgTemVehicleIdle == '1' ? 'checked' : '' ?> class="custom-control-input" name="AvgTemVehicleIdle" id="AvgTemVehicleIdle">
            <label class="custom-control-label" for="AvgTemVehicleIdle">Average Temparature when Vehicle Idle</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->HighTemVehicleIdle == '1' ? 'checked' : '' ?> class="custom-control-input" name="HighTemVehicleIdle" id="HighTemVehicleIdle">
            <label class="custom-control-label" for="HighTemVehicleIdle">Highest Temparature when Vehicle Idle</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->LowTemVehicleIdle == '1' ? 'checked' : '' ?> class="custom-control-input" name="LowTemVehicleIdle" id="LowTemVehicleIdle">
            <label class="custom-control-label" for="LowTemVehicleIdle">Lowest Temparature when Vehicle Idle</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->AvgTemVehicleRunning == '1' ? 'checked' : '' ?> class="custom-control-input" name="AvgTemVehicleRunning" id="AvgTemVehicleRunning">
            <label class="custom-control-label" for="AvgTemVehicleRunning">Average Temparature when Vehicle Running</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->highTemparatureVehicleRunning == '1' ? 'checked' : '' ?> class="custom-control-input" name="highTemparatureVehicleRunning" id="highTemparatureVehicleRunning">
            <label class="custom-control-label" for="highTemparatureVehicleRunning">Highest Temparature when Vehicle Running</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->lowTemVehicleRunning == '1' ? 'checked' : '' ?> class="custom-control-input" name="lowTemVehicleRunning" id="lowTemVehicleRunning">
            <label class="custom-control-label" for="lowTemVehicleRunning">Lowest Temparature when Vehicle Running</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->highTemVehicleoff == '1' ? 'checked' : '' ?> class="custom-control-input" name="highTemVehicleoff" id="highTemVehicleoff">
            <label class="custom-control-label" for="highTemVehicleoff">Highest Temparature when Vehicle Off</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->lowTemVehicleoff == '1' ? 'checked' : '' ?> class="custom-control-input" name="lowTemVehicleoff" id="lowTemVehicleoff">
            <label class="custom-control-label" for="lowTemVehicleoff">Lowest Temparature when Vehicle Off</label>
        </div>
                <hr>
                <h5 class="mt-1 text-bold-500">Temperature(2)</h5>   
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgTemparature2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgTemparature2" id="avgTemparature2">
            <label class="custom-control-label" for="avgTemparature2">Average Temperature</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->highTemparature2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="highTemparature2" id="highTemparature2">
            <label class="custom-control-label" for="highTemparature2">Highest Temparature</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->lowTemparature2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="lowTemparature2" id="lowTemparature2">
            <label class="custom-control-label" for="lowTemparature2">Lowest Temparature</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->AvgTemVehicleIdle2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="AvgTemVehicleIdle2" id="AvgTemVehicleIdle2">
            <label class="custom-control-label" for="AvgTemVehicleIdle2">Average Temparature when Vehicle Idle</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->HighTemVehicleIdle2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="HighTemVehicleIdle2" id="HighTemVehicleIdle2">
            <label class="custom-control-label" for="HighTemVehicleIdle2">Highest Temparature when Vehicle Idle</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->LowTemVehicleIdle2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="LowTemVehicleIdle2" id="LowTemVehicleIdle2">
            <label class="custom-control-label" for="LowTemVehicleIdle2">Lowest Temparature when Vehicle Idle</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->AvgTemVehicleRunning2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="AvgTemVehicleRunning2" id="AvgTemVehicleRunning2">
            <label class="custom-control-label" for="AvgTemVehicleRunning2">Average Temparature when Vehicle Running</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->highTemVehicleRunning2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="highTemVehicleRunning2" id="highTemVehicleRunning2">
            <label class="custom-control-label" for="highTemVehicleRunning2">Highest Temparature when Vehicle Running</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->lowTemVehicleRunning2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="lowTemVehicleRunning2" id="lowTemVehicleRunning2">
            <label class="custom-control-label" for="lowTemVehicleRunning2">Lowest Temparature when Vehicle Running</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->highTemVehicleoff2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="highTemVehicleoff2" id="highTemVehicleoff2">
            <label class="custom-control-label" for="highTemVehicleoff2">Highest Temparature when Vehicle Off</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->lowTemVehicleoff2 == '1' ? 'checked' : '' ?> class="custom-control-input" name="lowTemVehicleoff2" id="lowTemVehicleoff2">
            <label class="custom-control-label" for="lowTemVehicleoff2">Lowest Temparature when Vehicle Off</label>
        </div>
                <hr> -->
                <!-- <h5 class="mt-1 text-bold-500">OBD</h5>   
                
                <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->totalOdometer == '1' ? 'checked' : '' ?> class="custom-control-input" name="totalOdometer" id="totalOdometer">
            <label class="custom-control-label" for="totalOdometer">Total Odometer</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->engineHours == '1' ? 'checked' : '' ?> class="custom-control-input" name="engineHours" id="engineHours">
            <label class="custom-control-label" for="engineHours">Engine Hours</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->FuelCon == '1' ? 'checked' : '' ?> class="custom-control-input" name="FuelCon" id="FuelCon">
            <label class="custom-control-label" for="FuelCon">Fuel Consumption</label>
        </div>
        <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgEngineLoad == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgEngineLoad" id="avgEngineLoad">
            <label class="custom-control-label" for="avgEngineLoad">Average Engine Load</label>
        </div>
 <div class="custom-control custom-checkbox exebtm">
            <input type="checkbox" value="1" <?php echo $smart_data->avgCoolTemp == '1' ? 'checked' : '' ?> class="custom-control-input" name="avgCoolTemp" id="avgCoolTemp">
             <label class="custom-control-label" for="avgCoolTemp">Average Coolant Temparature</label>
        </div>            -->
                
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
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Smart Report</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>Dashboard">Home</a> </li>
                                <li class="breadcrumb-item active">Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                            <div class="card1 info-time-tracking">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-12">
                            <table id="smartreport" style="width: 60%" class="box-bordershado table table-striped table-bordered zero-configuration">

                            <tr>
                                    <th colspan="2" class="smtthclr">Vehicle Name: <?php echo $consolidate_data[0]['vehiclename']?></th>
                                </tr>

                                <tr>
                                    <th colspan="2" class="smtthclr <?php echo $smart_data->totalKilometer == '0' && $smart_data->avgDailykm == '0' &&
                                   $smart_data->runningTimeHMS == '0' && $smart_data->runningTime=='0' && $smart_data->avgDailyRunning == '0' && 
                                   $smart_data->actime == '0' && $smart_data->acTimeReport ==  '0' && $smart_data->vehicleOprIdle == '0' && 
                                   $smart_data->vehicleOprIdleEngineOpr == '0' && $smart_data->vehicleOff == '0' && $smart_data->vehicleOffReport =='0'? 'displaynone':''?>">Vehicle Basics</th>
                                </tr>
                                <tr class="<?php echo $smart_data->totalKilometer == '0' ? 'displaynone':''?>">
                                    <td>Total Kilometer:</td>
                                    <td><?php echo $consolidate_data[0]['total_kilometer'].' KM';?></td>
                                </tr>
                                <tr class=" <?php echo $smart_data->avgDailykm == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Daily Kilometer, km</td> <td><?php echo $consolidate_data[0]['avg_kilometer'].' KM';?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Total Kilometer at overspeed, km</td> <td>-</td>
                                </tr> -->
                                <tr class="<?php echo $smart_data->tripTimeHMS == '0' ? 'displaynone' : '' ?> ">
                                    <td>Trip time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_trip'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->tripTime == '0' ? 'displaynone' : '' ?>">
                                    <td>Trip  time, (% of the report period)</td> <td><?php echo $consolidate_data[0]['trip_period'].'%';?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->runningTimeHMS == '0' ? 'displaynone' : '' ?> ">
                                    <td>Running time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_move'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->runningTime == '0' ? 'displaynone' : '' ?>">
                                    <td>Running  time, (% of the report period)</td> <td><?php echo $consolidate_data[0]['running_period'].'%';?></td>
                                </tr>
                                <tr class=" <?php echo $smart_data->avgDailyRunning == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Daily Running Time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['avg_tot_move'];?></td>
                                </tr>

                                 <tr class="<?php echo $smart_data->actime == '0' ? 'displaynone' : '' ?>">
                                    <td>AC time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_ac'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->acTimeReport == '0' ? 'displaynone' : '' ?>">
                                    <td>AC time, (% of the report period)</td> <td><?php echo $consolidate_data[0]['ac_period']. '%';?></td>
                                </tr>

                               <!--  <tr>
                                    <td>Vehicle  On time, hour:min:sec</td> <td>-</td>
                                </tr>
                                <tr>
                                    <td>Vehicle On time, (% of the report period)</td> <td>-</td>
                                </tr>
                                <tr>
                                    <td>Vehicle On time in Speed, hour:min:sec</td> <td>-</td>
                                </tr>
                                <tr>
                                    <td>Vehicle On time in Speed, (% of the report period)</td> <td>-</td>
                                </tr> -->
                                <tr class="<?php echo $smart_data->vehicleOprIdle == '0' ? 'displaynone' : '' ?> ">
                                    <td> Vehicle operation idle time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['total_idle'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->vehicleOprIdleEngineOpr == '0' ? 'displaynone' : '' ?>">
                                    <td>Vehicle operation idle time, (% of engine operation time)</td> <td><?php echo $consolidate_data[0]['idle_period'].'%';?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->vehicleOff == '0' ? 'displaynone' : '' ?>">
                                    <td>Vehicle  Off(Parking) time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['total_parking'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->vehicleOffReport == '0' ? 'displaynone' : '' ?>">
                                    <td>Vehicle Off(Parking) time, (% of the report period)</td> 
                                    <td><?php echo $consolidate_data[0]['park_period'].'%';?></td>
                                </tr>

                                <tr class="<?php echo $smart_data->totalEnginerpm == '0' && $smart_data->engOprNormalRpm == '0' && $smart_data->engOprMaximumRpm =='0' && 
                                $smart_data->engOprIdle == '0'? 'displaynone':'' ?>">
                                    <th colspan="2" class="smtthclr">Engine RPM</th>
                                </tr>
                                <tr class="<?php echo $smart_data->totalEnginerpm == '0' ? 'displaynone' : '' ?>">
                                    <td>Total Engine RPM, hour:min:sec</td>
                                    <td><?php echo $consolidate_data[0]['tot_rpm'].' ('.$consolidate_data[0]['tot_hrpm'].')';?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->engOprNormalRpm == '0' ? 'displaynone' : '' ?>">
                                    <td>Engine operation time at normal RPM, hour:min:sec</td>
                                    <td><?php echo $consolidate_data[0]['tot_normalrpm'];?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Engine operation time at normal RPM, (% of engine operation time)</td> 
                                         <td><?php echo $consolidate_data[0]['normalrpm_period'].'%';?></td>
                                   
                                </tr> -->
                                <tr class="<?php echo $smart_data->engOprMaximumRpm == '0' ? 'displaynone' : '' ?>">
                                    <td>Engine operation time at maximum RPM, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_loadrpm'];?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Engine operation time at maximum RPM, (% of engine operation time)</td> 
                                     <td><?php echo $consolidate_data[0]['tot_idlerpm'].'%';?></td>
                                </tr> -->
                                <tr class="<?php echo $smart_data->engOprIdle == '0' ? 'displaynone' : '' ?>">
                                    <td>Engine operation time Idle, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_idlerpm'];?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Engine operation time Idle, (% of engine operation time)	</td>
                                    <td><?php echo $consolidate_data[0]['loadrpm_period'].'%';?></td>
                                </tr> -->
                                <tr class="<?php echo $smart_data->totalActualFuelCon == '0' && $smart_data->avgDailyFuelCon == '0' &&
                                $smart_data->refuelingVol == '0' && $smart_data->drainingVolume == '0' && $smart_data->avgActualMil == '0' &&
                                 $smart_data->avgActualMilWhenVehicleMoving == '0' && $smart_data->totalActualFuelConwhenVehicleMoving =='0' && 
                                 $smart_data->totalActualFuelConWhenVehicleNotMov == '0' && $smart_data->totActualFuelConTimeEngOpr == '0' && 
                                  $smart_data->ActualAvgFuelConperHour == '0' && $smart_data->avgDailyActualFuelConperHour == '0' ? 'displaynone':'' ?>">
                                    <th colspan="2" class="smtthclr">Fuel</th>                                   
                                </tr>
                                <tr class=" <?php echo $smart_data->totalActualFuelCon == '0' ? 'displaynone' : '' ?>">
                                    <td> Total actual fuel consumption, l</td> 
                                    <td><?php echo $consolidate_data[0]['total_fuel_consume'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->avgDailyFuelCon == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Daily  fuel consumption, l</td> <td><?php echo $consolidate_data[0]['avg_fuel_consume'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->refuelingVol == '0' ? 'displaynone' : '' ?>">
                                    <td>Refueling volume, l</td> <td><?php echo $consolidate_data[0]['total_fuel_fill'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->drainingVolume == '0' ? 'displaynone' : '' ?>">
                                    <td>Draining volume, l</td> <td><?php echo $consolidate_data[0]['total_fuel_dip'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->avgActualMil == '0' ? 'displaynone' : '' ?>">
                                    <td>Average actual mileage per 1 l, km</td> <td><?php echo round($consolidate_data[0]['total_kilometer']/ $consolidate_data[0]['total_fuel_consume'],2);?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->avgActualMilWhenVehicleMoving == '0' ? 'displaynone' : '' ?>">
                                    <td>Average actual mileage per 1 l  when Vehicle in Moving</td> <td><?php echo $consolidate_data[0]['moving_fl_cunsume'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->totalActualFuelConwhenVehicleMoving == '0' ? 'displaynone' : '' ?>">
                                    <td>Total actual fuel consumption when Vehicle in Moving, l</td> <td><?php echo $consolidate_data[0]['avg_moving_fl_cunsume'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->totalActualFuelConWhenVehicleNotMov == '0' ? 'displaynone' : '' ?>">
                                    <td>Total actual fuel consumption when Vehicle in not Moving, l</td> <td><?php echo $consolidate_data[0]['not_moving_fl_cunsume'];?></td>
                                </tr>
                                <tr class="<?php echo $smart_data->totActualFuelConTimeEngOpr == '0' ? 'displaynone' : '' ?>">
                                    <td>Total actual fuel consumption during the time of engine operation, l</td> <td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->ActualAvgFuelConperHour == '0' ? 'displaynone' : '' ?>">
                                    <td>Actual average fuel consumption per engine hour, l</td> <td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->avgDailyActualFuelConperHour == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Daily actual fuel consumption per hour of engine operation, l</td> <td>-</td>                                       
                                </tr>
                                <tr class="<?php echo $smart_data->totActualConTimeEngOperInMotion == '0' && $smart_data->totActualConTimeEngOperInNormalRPM == '0' &&
                                 $smart_data->totActualConTimeEngOperInMaxRPM == '0' && $smart_data->totActualConTimeEngOperunderLoad == '0' ? 'displaynone':'' ?>">
                                    <th  colspan="2" class="smtthclr">Fuel (RPM)</th>                                    
                                </tr>
                                <tr class="<?php echo $smart_data->totActualConTimeEngOperInMotion == '0' ? 'displaynone' : '' ?>">
                                    <td>The total actual consumption during the time of engine operation in motion, L</td>
                                    <td>-</td>                                       
                                </tr>
                                <tr class="<?php echo $smart_data->totActualConTimeEngOperInNormalRPM == '0' ? 'displaynone' : '' ?>">
                                    <td>The total actual consumption during the time Engine operation time at normal RPM, L</td>
                                    <td>-</td>                                       
                                </tr>
                                <tr class="<?php echo $smart_data->totActualConTimeEngOperInMaxRPM == '0' ? 'displaynone' : '' ?>">
                                    <td>The total actual consumption during the timeEngine operation time at maximum RPM, L</td><td>-</td>                                       
                                </tr>
                                <tr class="<?php echo $smart_data->totActualConTimeEngOperunderLoad == '0' ? 'displaynone' : '' ?>">
                                    <td>The total actual consumption during the time Engine operation time under load,  L</td><td>-</td>                                       
                                </tr>

                                <tr class="<?php echo $smart_data->bucketMovTime == '0' && $smart_data->bucketMovTimereportPeriod == '0' && 
                                $smart_data->bucketAvgDailyMov == '0' && $smart_data->bucketMovIdle == '0' && $smart_data->bucketMovIdleEngOpr == '0'? 'displaynone':'' ?>">
                                    <th colspan="2" class="smtthclr">Bucket Movements</th>
                                </tr>
                                <tr class="<?php echo $smart_data->bucketMovTime == '0' ? 'displaynone' : '' ?>">
                                    <td>Bucket  movement  time, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->bucketMovTimereportPeriod == '0' ? 'displaynone' : '' ?>">
                                    <td>Bucket movement   time, (% of the report period)</td>
                                    <td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->bucketAvgDailyMov == '0' ? 'displaynone' : '' ?> ">
                                    <td>Bucket  Average Daily movement Time, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->bucketMovIdle == '0' ? 'displaynone' : '' ?>">
                                    <td>Bucket movement idle time, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->bucketMovIdleEngOpr == '0' ? 'displaynone' : '' ?>">
                                    <td>Bucket movement idle time, (% of engine operation time)</td>
                                    <td>-</td>
                                </tr>                                       
                                <tr class="<?php echo $smart_data->drumMovTimeload == '0' && $smart_data->drumMovTimeReportPeriod == '0' && $smart_data->AvgDailyDrumMov=='0' &&
                                 $smart_data->DrumMovtimewithoutLoad == '0' && $smart_data->DrumMovmenttimereportPeriod == '0' && $smart_data->AvgDailymovwithoutLoad == '0' &&
                                 $smart_data->DrumnonMovTime == '0' && $smart_data->DrumnonMovReport == '0'?'displaynone':'' ?>">
                                    <th colspan="2" class="smtthclr">Drum Movements</th>
                                </tr>
                                <tr class="<?php echo $smart_data->drumMovTimeload == '0' ? 'displaynone' : '' ?>">
                                    <td>Drum Movements  time with Load, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->drumMovTimeReportPeriod == '0' ? 'displaynone' : '' ?>">
                                    <td>Drum Movements  time with Load, (% of the report period)</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->AvgDailyDrumMov == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Daily Drum Movements  time with Load, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->DrumMovtimewithoutLoad == '0' ? 'displaynone' : '' ?>">
                                    <td>Drum Movements  time without Load, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->DrumMovmenttimereportPeriod == '0' ? 'displaynone' : '' ?>">
                                    <td>Drum Movements  time without Load, (% of the report period)</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->AvgDailymovwithoutLoad == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Daily Drum Movements  time without  Load, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->DrumnonMovTime == '0' ? 'displaynone' : '' ?>">
                                    <td>Drum non Movements  time, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->DrumnonMovReport == '0' ? 'displaynone' : '' ?>">
                                    <td>Drum non Movements  time, (% of the report period)</td><td>-</td>
                                </tr>

                                <tr class="<?php echo $smart_data->avgTemparature == '0' && $smart_data->highTemparature == '0' && $smart_data->lowTemparature == '0' && 
                                $smart_data->AvgTemVehicleIdle == '0' && $smart_data->HighTemVehicleIdle == '0' && $smart_data->LowTemVehicleIdle == '0' && $smart_data->AvgTemVehicleRunning == '0' &&
                                $smart_data->highTemparatureVehicleRunning == '0' && $smart_data->lowTemVehicleRunning == '0' && $smart_data->highTemVehicleoff == '0' &&
                                $smart_data->lowTemVehicleoff == '0'? 'displaynone':'' ?>">
                                    <th colspan="2" class="smtthclr">Temperature (1)</th>
                                </tr>
                                <tr class="<?php echo $smart_data->avgTemparature == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Temeprature </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->highTemparature == '0' ? 'displaynone' : '' ?>">
                                    <td> Highest Temperature</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->lowTemparature == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->AvgTemVehicleIdle == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Temperture when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->HighTemVehicleIdle == '0' ? 'displaynone' : '' ?>">
                                    <td>Highest Tempearture When Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->LowTemVehicleIdle == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->AvgTemVehicleRunning == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Temperture when Vehicle Running</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->highTemparatureVehicleRunning == '0' ? 'displaynone' : '' ?>">
                                    <td>Highest Tempearture When Vehicle Running </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->lowTemVehicleRunning == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature when Vehicle Running </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->highTemVehicleoff == '0' ? 'displaynone' : '' ?>">
                                    <td>Highest Tempearture When Vehicle Off</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->lowTemVehicleoff == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature when Vehicle Off</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->avgTemparature2 == '0' && $smart_data->highTemparature2 == '0'&&
                                $smart_data->lowTemparature2 == '0' && $smart_data->AvgTemVehicleIdle2 == '0' && $smart_data->HighTemVehicleIdle2 == '0' &&
                                $smart_data->LowTemVehicleIdle2 == '0' && $smart_data->AvgTemVehicleRunning2 == '0' && $smart_data->highTemVehicleRunning2 == '0' && 
                               $smart_data->lowTemVehicleRunning2 == '0' &&  $smart_data->highTemVehicleoff2 == '0' && $smart_data->lowTemVehicleoff2 == '0' ? 'displaynone':''?>">
                                    <th colspan="2" class="smtthclr">Temperature (2)</th>
                                </tr>
                                <tr class="<?php echo $smart_data->avgTemparature2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Temeprature </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->highTemparature2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Highest Temperature</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->lowTemparature2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->AvgTemVehicleIdle2 == '0' ? 'displaynone' : '' ?> ">
                                    <td>Average Temperture when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->HighTemVehicleIdle2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Highest Tempearture When Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->LowTemVehicleIdle2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->AvgTemVehicleRunning2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Temperture when Vehicle Running</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->highTemVehicleRunning2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Highest Tempearture When Vehicle Running </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->lowTemVehicleRunning2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature when Vehicle Running </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->highTemVehicleoff2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Highest Tempearture When Vehicle Off</td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->lowTemVehicleoff2 == '0' ? 'displaynone' : '' ?>">
                                    <td>Lowest Temeprature when Vehicle Off</td><td>-</td>
                                </tr>                                       
                                <tr class="<?php echo $smart_data->totalOdometer == '0' && $smart_data->engineHours == '0' && 
                                $smart_data->FuelCon == '0' && $smart_data->avgEngineLoad == '0' &&  $smart_data->avgCoolTemp == '0' ? 'displaynone':''?>">
                                    <th colspan="2" class="smtthclr">OBD</th>
                                </tr>
                                <tr class=" <?php echo $smart_data->totalOdometer == '0' ? 'displaynone' : '' ?>">
                                    <td>Total  ODOMETER </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->engineHours == '0' ? 'displaynone' : '' ?>">
                                    <td>Engine Hours </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->FuelCon == '0' ? 'displaynone' : '' ?>">
                                    <td>Fuel Consumption </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->avgEngineLoad == '0' ? 'displaynone' : '' ?>">
                                    <td>Average Engine Load </td><td>-</td>
                                </tr>
                                <tr class="<?php echo $smart_data->avgCoolTemp == '0' ? 'displaynone' : '' ?> ">
                                    <td>Average Coolant Temeprature </td><td>-</td>
                                </tr>

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
        $('#smartreport').DataTable({
             pageLength: 0,
    lengthMenu: [3, 5, 10, 20, 50, 100],
        });
     });
        </script>