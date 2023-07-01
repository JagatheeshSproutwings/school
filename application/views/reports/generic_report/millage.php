<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left: 0px;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Fuel Mileage Report </h3>
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
                    <div class="row">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
    <div class="card info-time-tracking">
      <div class="card-content">
        <div class="row">
          <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
            <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
              <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Millage Report</h4>
              <span class="pr-2">
                <i class="icon icon-settings"></i>
              </span>
            </div>
          </div>
          <div class="col-12">
            <table id="parking" class="table table-striped table-bordered zero-configuration">
                             <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Vehicle</th>
                                    <th>Date</th>
                                    <th>Filled <br>Fuel ltr</th>
                                    <th>Consumed <br>Fuel ltr</th>
                                    <th>Start <br>Odometer</th>
                                    <th>End<br>Odometer</th>
                                     <!-- <th>Running <br>Duration</th> -->
                                     <th>Distance (KM)</th>
                                     <th>Mileage<br> per ltr</th>
                                     <!-- <th>Mileage<br> ltr per hours</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count_sno = 1;
                              //  foreach ($vehicle_details as $value) { ?>
                                <tr>
                                    <td><?=$count_sno++;?></td>
                                    <td><?=$vehicle; ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($from_date)); ?></td>
                                    <td><?php echo $fill_fuel; ?></td>
                                    <td><?php echo $fuel; ?></td>
                                    <td><?php echo $start_odo; ?></td>
                                    <td><?php echo $end_odo; ?></td>
                                    <td><?php echo $distance; ?></td>
                                    <td><?php echo $mileage; ?></td>
                                    <!-- <td><?php // echo $value['start_location']; ?></td> -->
                                    <!-- <td><?php // echo $value['start_location']; ?></td> -->
                                        </tr>
                                 <?php// }  ?>
                            </tbody>
                        </table>
    
          </div>
        </div>
      </div>
    </div>
  </div>                        
                         
            </div>

        </div>
      </div>
    </div>


<script type="text/javascript">
    $( document ).ready(function() {
        $('#parking').DataTable();
     });
</script>