<!-- Content Wrapper. Contains page content -->

<?php $role = ($this->session->userdata['role']); 
error_reporting(0);
?>

<head>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!-- <link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" > -->
<!--logo start-->
</header>
<!--header end-->
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    
    <section class="wrapper">
        <div class="w3-agile-google_map">
        <h2>Route Details</h2>
        <div class="col-lg-12 col-md-12 col-sm-12" style='padding-top: 10px;'>
          <header class="panel-heading">
            Route Lists <a href="<?php echo site_url('/route/edit_polygonroute1/');?>" class="btn btn-success add pull-right" >Add</a>
          </header>
          <div class="notify-w3ls  stats-info stats-last widget-shadow"  style="margin-bottom: 10px !important;padding-right:30px !important;"> 
            <table id="example1" class="table table-bordered table-striped stats-info stats-last widget-shadow"  style="margin: 15px !important; " >
              <thead>
                <tr>
                  <th>S.No</th>
                    <th>Ward Type</th>
                  <th>Route Name</th>
                  <th>Start Point</th>
                  <th>End Point</th>
                   <th>Stops</th>
                  <th>Status</th>
                </tr>
              </thead>
              <?php    
    
              $count_sno = 1;                     
              if(isset($route_list)){                          
              foreach($route_list as $list){ 
              
                      ?>
                <tr>
                  <th scope="row"> <?=$count_sno++;?></th>
                    <td><?=$list->route_name; ?></td>
                     <td><?php if($list->route_type=='1'){ echo "INWARD";}if($list->route_type=='2'){echo "OUTWARD";} ?></td>
                   <td><?php if($list->route_geo_start_id=='10'){echo "P5 Weigh Bridge";}
                        if($list->route_geo_start_id=='11'){echo "P5 Hopper Point";}
                        if($list->route_geo_start_id=='12'){echo "P5 Dump Yard";}
                        if($list->route_geo_start_id=='13'){echo "P5 RDF Out Area";}
                        if($list->route_geo_start_id=='14'){echo "P5 C & D Out Area";}
                        if($list->route_geo_start_id=='15'){echo "P5 Soil Out Area";}
                        if($list->route_geo_start_id=='16'){echo "P5 Disposal Point";}
                         if($list->route_geo_start_id=='17'){echo "P3 PLANT Area";}
                       if($list->route_geo_start_id=='18'){echo "P4 PLANT Area";}

                        if($list->route_geo_start_id=='19'){echo "P3 Dump Yard";}
                        if($list->route_geo_start_id=='20'){echo "P3 Weigh Bridge";}
                       if($list->route_geo_start_id=='21'){echo "P3 Hopper Point";}
                       if($list->route_geo_start_id=='22'){echo "P3 RDF Out Area";}
                       if($list->route_geo_start_id=='23'){echo "P3 Soil Out Area";}
                       if($list->route_geo_start_id=='24'){echo "P3 C & D Out Area";}
                      if($list->route_geo_start_id=='25'){echo "P3_PLANT_2_AREA";}
                       if($list->route_geo_start_id=='26'){echo "P5_PLANT_2_AREA";}


                             if($list->route_geo_start_id=='27'){echo "P4 Dump Yard";}
                             if($list->route_geo_start_id=='28'){echo "P4 Weigh Bridge";}
                             if($list->route_geo_start_id=='29'){echo "P4 Hopper Point";}
                             if($list->route_geo_start_id=='30'){echo "P4 RDF Out Area";}
                             if($list->route_geo_start_id=='31'){echo "P4 Soil Out Area";}
                             if($list->route_geo_start_id=='32'){echo "P4 C & D Out Area";}


                     ?></td>  

                        <td><?php if($list->route_geo_end_id=='10'){echo "P5 Weigh Bridge";}
                        if($list->route_geo_end_id=='11'){echo "P5 Hopper Point";}
                        if($list->route_geo_end_id=='12'){echo "P5 Dump Yard";}
                        if($list->route_geo_end_id=='13'){echo "P5 RDF Out Area";}
                        if($list->route_geo_end_id=='14'){echo "P5 C & D Out Area";}
                        if($list->route_geo_end_id=='15'){echo "P5 Soil Out Area";}
                        if($list->route_geo_end_id=='16'){echo "P5 Disposal Point";}
                         if($list->route_geo_end_id=='17'){echo "P3 PLANT Area";}
                       if($list->route_geo_end_id=='18'){echo "P4 PLANT Area";}

                        if($list->route_geo_end_id=='19'){echo "P3 Dump Yard";}
                        if($list->route_geo_end_id=='20'){echo "P3 Weigh Bridge";}
                       if($list->route_geo_end_id=='21'){echo "P3 Hopper Point";}
                       if($list->route_geo_end_id=='22'){echo "P3 RDF Out Area";}
                       if($list->route_geo_end_id=='23'){echo "P3 Soil Out Area";}
                       if($list->route_geo_end_id=='24'){echo "P3 C & D Out Area";}
                       if($list->route_geo_end_id=='25'){echo "P3_PLANT_2_AREA";}
                       if($list->route_geo_end_id=='26'){echo "P5_PLANT_2_AREA";}


                             if($list->route_geo_end_id=='27'){echo "P4 Dump Yard";}
                             if($list->route_geo_end_id=='28'){echo "P4 Weigh Bridge";}
                             if($list->route_geo_end_id=='29'){echo "P4 Hopper Point";}
                             if($list->route_geo_end_id=='30'){echo "P4 RDF Out Area";}
                             if($list->route_geo_end_id=='31'){echo "P4 Soil Out Area";}
                             if($list->route_geo_end_id=='32'){echo "P4 C & D Out Area";}

                     ?></td>    


                   <td><a href="<?php echo site_url('/Route/polygon_stop_details/').$list->route_id; ?>" class="badge bg-blue">Stops</a></td> 
                  <td><!-- <a href="<?php //echo site_url('/route/view_route/').$list->route_id; ?>" class="badge bg-blue hide" data-toggle='modal' data-target='#viewUserModel'>View</a>&nbsp; -->
                    <?php if($role >= 3){
                      echo "<a href=".site_url('/route/edit_polygonroute1/').$list->route_id." class='badge bg-orange'>Edit</a>";
                     }
                  ?>
                  <?php if($role >= 3){
                      echo "<a href='#' onclick='deleteItem(".$list->route_id.")' class='badge bg-red'>Delete</a>";
                     }
                  ?></td> 
                </tr>
              <?php }}?>
            </table>
          </div>
        </div>
        <div class="clearfix"></div>
    </div>
  </section>
 <!-- footer -->
    <div class="footer clearfix">
        <div class="wthree-copyright">
      <?php $this->load->view('components/tfooter'); ?>
        </div>
    </div>
  <!-- / footer -->
</section>

<!-- main content end -->
</section>
</body>

<script type="text/javascript">

  /*delete client*/
  function deleteItem(id) {
    if (confirm("Are you sure?")) {
        
     window.location = "<?php echo site_url()?>/route/delete_polygonroute/"+id;
    
    }
    return false;
  }
  /*delete client*/

</script>