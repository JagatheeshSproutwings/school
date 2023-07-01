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
                                    <th colspan="2" class="smtthclr">Vehicle Basics</th>
                                </tr>
                                <tr>
                                    <td>Total Kilometer:</td>
                                    <td><?php echo $consolidate_data[0]['total_kilometer'].' KM';?></td>
                                </tr>
                                <tr>
                                    <td>Average Daily Kilometer, km</td> <td><?php echo $consolidate_data[0]['avg_kilometer'].' KM';?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Total Kilometer at overspeed, km</td> <td>-</td>
                                </tr> -->
                                <tr>
                                    <td>Running time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_move'];?></td>
                                </tr>
                                <tr>
                                    <td>Running  time, (% of the report period)</td> <td><?php echo $consolidate_data[0]['running_period'].'%';?></td>
                                </tr>
                                <tr>
                                    <td>Average Daily Running Time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['avg_tot_move'];?></td>
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
                                <tr>
                                    <td> Vehicle operation idle time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['total_idle'];?></td>
                                </tr>
                                <tr>
                                    <td>Vehicle operation idle time, (% of engine operation time)</td> <td><?php echo $consolidate_data[0]['idle_period'].'%';?></td>
                                </tr>
                                <tr>
                                    <td>Vehicle  Off(Parking) time, hour:min:sec</td> <td><?php echo $consolidate_data[0]['total_parking'];?></td>
                                </tr>
                                <tr>
                                    <td>Vehicle Off(Parking) time, (% of the report period)</td> 
                                    <td><?php echo $consolidate_data[0]['park_period'].'%';?></td>
                                </tr>

                                <tr>
                                    <th colspan="2" class="smtthclr">Engine RPM</th>
                                </tr>
                                <tr>
                                    <td>Total Engine RPM, hour:min:sec</td>
                                    <td><?php echo $consolidate_data[0]['tot_rpm'];?></td>
                                </tr>
                                <tr>
                                    <td>Engine operation time at normal RPM, hour:min:sec</td>
                                    <td><?php echo $consolidate_data[0]['tot_normalrpm'];?></td>
                                </tr>
                                <tr>
                                    <td>Engine operation time at normal RPM, (% of engine operation time)</td> 
                                         <td><?php echo $consolidate_data[0]['normalrpm_period'].'%';?></td>
                                   
                                </tr>
                                <tr>
                                    <td>Engine operation time at maximum RPM, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_overloadrpm'];?></td>
                                </tr>
                                <tr>
                                    <td>Engine operation time at maximum RPM, (% of engine operation time)</td> 
                                     <td><?php echo $consolidate_data[0]['overloadrpm_period'].'%';?></td>
                                </tr>
                                <tr>
                                    <td>Engine operation time under load, hour:min:sec</td> <td><?php echo $consolidate_data[0]['tot_loadrpm'];?></td>
                                </tr>
                                <tr>
                                    <td>Engine operation time under load, (% of engine operation time)	</td>
                                    <td><?php echo $consolidate_data[0]['loadrpm_period'].'%';?></td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="smtthclr">Fuel</th>                                   
                                </tr>
                                <tr>
                                    <td> Total actual fuel consumption, l</td> 
                                    <td><?php echo $consolidate_data[0]['total_fuel_consume'];?></td>
                                </tr>
                                <tr>
                                    <td>Average Daily  fuel consumption, l</td> <td><?php echo $consolidate_data[0]['avg_fuel_consume'];?></td>
                                </tr>
                                <tr>
                                    <td>Refueling volume, l</td> <td><?php echo $consolidate_data[0]['total_fuel_fill'];?></td>
                                </tr>
                                <tr>
                                    <td>Draining volume, l</td> <td><?php echo $consolidate_data[0]['total_fuel_dip'];?></td>
                                </tr>
                                <tr>
                                    <td>Average actual mileage per 1 l, km</td> <td><?php echo $consolidate_data[0]['totalmilege'];?></td>
                                </tr>
                                <tr>
                                    <td>Average actual mileage per 1 l  when Vehicle in Moving</td> <td><?php echo $consolidate_data[0]['moving_fl_cunsume'];?></td>
                                </tr>
                                <tr>
                                    <td>Total actual fuel consumption when Vehicle in Moving, l</td> <td><?php echo $consolidate_data[0]['avg_moving_fl_cunsume'];?></td>
                                </tr>
                                <tr>
                                    <td>Total actual fuel consumption when Vehicle in not Moving, l</td> <td><?php echo $consolidate_data[0]['not_moving_fl_cunsume'];?></td>
                                </tr>
                                <tr>
                                    <td>Total actual fuel consumption during the time of engine operation, l</td> <td>-</td>
                                </tr>
                                <tr>
                                    <td>Actual average fuel consumption per engine hour, l</td> <td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Daily actual fuel consumption per hour of engine operation, l</td> <td>-</td>                                       
                                </tr>
                                <tr>
                                    <th  colspan="2" class="smtthclr">Fuel (RPM)</th>                                    
                                </tr>
                                <tr>
                                    <td>The total actual consumption during the time of engine operation in motion, L</td>
                                    <td>-</td>                                       
                                </tr>
                                <tr>
                                    <td>The total actual consumption during the time Engine operation time at normal RPM, L</td>
                                    <td>-</td>                                       
                                </tr>
                                <tr>
                                    <td>The total actual consumption during the timeEngine operation time at maximum RPM, L</td><td>-</td>                                       
                                </tr>
                                <tr>
                                    <td>The total actual consumption during the time Engine operation time under load,  L</td><td>-</td>                                       
                                </tr>

                                <tr>
                                    <th colspan="2" class="smtthclr">Bucket Movements</th>
                                </tr>
                                <tr>
                                    <td>Bucket  movement  time, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Bucket movement   time, (% of the report period)</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Bucket  Average Daily movement Time, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Bucket movement idle time, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Bucket movement idle time, (% of engine operation time)</td>
                                    <td>-</td>
                                </tr>                                       
                                <tr>
                                    <th colspan="2" class="smtthclr">Drum Movements</th>
                                </tr>
                                <tr>
                                    <td>Drum Movements  time with Load, hour:min:sec</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Drum Movements  time with Load, (% of the report period)</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Daily Drum Movements  time with Load, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Drum Movements  time without Load, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Drum Movements  time without Load, (% of the report period)</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Daily Drum Movements  time without  Load, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Drum non Movements  time, hour:min:sec</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Drum non Movements  time, (% of the report period)</td><td>-</td>
                                </tr>

                                <tr>
                                    <th colspan="2" class="smtthclr">Temperature (1)</th>
                                </tr>
                                <tr>
                                    <td>Average Temeprature </td><td>-</td>
                                </tr>
                                <tr>
                                    <td> Highest Temperature</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Temperture when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Highest Tempearture When Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Temperture when Vehicle Running</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Highest Tempearture When Vehicle Running </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature when Vehicle Running </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Highest Tempearture When Vehicle Off</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature when Vehicle Off</td><td>-</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="smtthclr">Temperature (2)</th>
                                </tr>
                                <tr>
                                    <td>Average Temeprature </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Highest Temperature</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Temperture when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Highest Tempearture When Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature when Vehicle Idle </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Temperture when Vehicle Running</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Highest Tempearture When Vehicle Running </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature when Vehicle Running </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Highest Tempearture When Vehicle Off</td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Lowest Temeprature when Vehicle Off</td><td>-</td>
                                </tr>                                       
                                <tr>
                                    <th colspan="2" class="smtthclr">OBD</th>
                                </tr>
                                <tr>
                                    <td>Total  ODOMETER </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Engine Hours </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Fuel Consumption </td><td>-</td>
                                </tr>
                                <tr>
                                    <td>Average Engine Load </td><td>-</td>
                                </tr>
                                <tr>
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