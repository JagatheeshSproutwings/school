<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left: 0px;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Polygon Report </h3>
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
              <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Polygon Report</h4>
              <span class="pr-2">
                <i class="icon icon-settings"></i>
              </span>
            </div>
          </div>
          <div class="col-12 box-bordershado">
            <table id="polygon" class="table table-striped table-bordered zero-configuration">
                          <thead>
                            <tr>
                                <th style='width: 3%'>S No</th>
                                <th style='width: 7%'>Polygon Area & Vehicle</th>
                                <th style='width: 5%'>IN DateTime</th>
                                <th style='width: 5%'>IN Latlng</th>
                                <th style='width: 5%'>OUT DateTime</th>
                                <th style='width: 5%'>OUT Latlng</th>
                                <th style='width: 4%'>Time Duration</th>
                            </tr> <tbody class='tbody' id='tbody'>
                              
                             <?php
                                $count_sno = 1;
                                foreach ($polygon_area_details as $value) { ?>
                                <tr>
                                    <td><?=$count_sno++;?></td>
                                    <td><?php echo $value['polygon_area_name']; ?> - <?=$value['vehicle_name']; ?></td>
                                     <td><?php echo $value['in_datetime']; ?></td>
                                       <td><?php echo $value['s_lat'].','.$value['s_lng']; ?></td>
                                    <td><?php echo $value['out_datetime']; ?></td>
                                     <td><?php echo $value['e_lat'].','.$value['e_lng']; ?></td>
                                     <td><?php echo $value['time_duration']; ?></td>
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
      </div>
    </div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#polygon').DataTable({
             pageLength: 0,
    lengthMenu: [10, 20, 50, 100],
        });
     });
</script>