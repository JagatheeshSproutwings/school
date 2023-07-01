<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left: 0px;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Distance Report</h3>
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
          <div class="col-12 box-bordershado">
            <?php 
                    foreach ($vehicle_details as $vkey => $v_value) {  ?>
              <div class='panelcolor'>
                  <h6>Vehicle Name:  <?php echo $vkey;?> </h6> 
                            
              </div>
            <table id="distancereport" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Date</th>
                                    <th>Distance</th>
                                </tr>
                            </thead>
                           <tbody class='tbody' id='tbody'>

                                        <?php $i=1; $total_dis = 0; // echo count($v_value); 
                                        foreach ($v_value as $key1 => $value1) { 

                                        if($value1['distance']!='')
                                            {?>

                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $value1['date'];?></td>
                                            <td><?php echo $value1['distance'];?></td>
                                        </tr>
                                            
                                        <?php $total_dis = $total_dis + $value1['distance'];  $i++; } }
                                        ?>

                                        <tr>
                                            <td></td>
                                            <td style=" text-align: right; font-weight: bold;">Total Distance</td>
                                            <td style=" font-weight: bold;"><?= $total_dis; ?></td>
                                        </tr>

                                      </tbody>
           </table>
         <?php } ?>
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
        $('#distancereport').DataTable({
            "ordering": false,
    dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
        ]

        });
     });
     </script>