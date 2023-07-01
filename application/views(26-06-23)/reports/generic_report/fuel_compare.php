<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left: 0px;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Fuel Comparision Report </h3>
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
      <div class="card-content box-bordershado">
            <table id="parking" class="table table-striped table-bordered zero-configuration" style='width: 99%'>
                             <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Vehicle Name & No</th>
                                    <th>Fuel Entry Litre</th>
                                    <th>Fuel Sensor Litre</th>
                                    <th>Fuel Difference Litre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count_sno = 1;
                                foreach ($vehicle_details as $value) { ?>
                                <tr>
                                    <td><?=$count_sno++;?></td>
                                    <td><?=$value['vehicle']; ?></td>
                                    <td><?php echo $value['start_date']; ?></td>
                                    <td><?php echo $value['end_date']; ?></td>
                                    <td><?php echo $value['time_dur']; ?></td>
                                        </tr>
                                 <?php }  ?>
                            </tbody>
                        </table>
    
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