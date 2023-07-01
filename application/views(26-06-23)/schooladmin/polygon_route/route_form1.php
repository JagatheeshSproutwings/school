<!-- Content Wrapper. Contains page content -->

<?php $role = ($this->session->userdata['role']); ?>

<style>
.col-lg-6 col-md-6 col-sm-6
{
  margin: 10px !important;
}
.w3-agile-google_map
{
  line-height: 30px;
}
</style>
<head>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" >
<!--logo start-->
</header>
<!--header end-->
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    
    <section class="wrapper">
        <div class="w3-agile-google_map" >
         <div class="col-lg-12 col-md-12 col-sm-12"  style="margin-top: 15px;" >
        <div class="col-lg-3 col-md-12 col-sm-12">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12  stats-info-agileits" >
            <header class="panel-heading">
            Assign Location &nbsp;<i class="fa fa-plus"></i>
            </header>
             <form id="assignFrom" role="form" action="<?php echo site_url('/route/save_polygonroute1/');if (! empty ( $route_details->route_id )) {echo $route_details->route_id;}?>" method="post">     


          
           <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="route_name">Route Name :<span class="error">*</span></label>
                <input type="text" class="form-control col-md-6 " id="route_name" name="route_name" placeholder="Enter Route Name..." value="<?php if (!empty($route_details->route_name)){echo $route_details->route_name;}?>" required>
                <span id="error-dno" class="error-msg"></span>
              </div>

          <div class="form-group col-md-4">
                <label>Ward Type</label>

                <select class="form-control"  id="route_type" name="route_type" style="width: 100%;" required>
                      <option value="">select</option>
                   <option value="1" <?php if($route_details->route_type=='1'){echo "selected";}?>>INWARD</option>
                    <option value="2" <?php if($route_details->route_type=='2'){echo "selected";}?>>OUTWARD</option>
                        
                </select>
              </div>


          <div class="form-group col-md-4">
                <label>Start Point</label>
                <select class="form-control"  id="route_geo_start_id" name="route_geo_start_id" style="width: 100%;" required>
                   <option value="">select</option>
                           <option value="10" <?php if($route_details->route_geo_start_id=='10'){echo "selected";}?>>P5 Weigh Bridge</option>
                           <option value="11" <?php if($route_details->route_geo_start_id=='11'){echo "selected";}?>>P5 Hopper Point</option>
                           <option value="12" <?php if($route_details->route_geo_start_id=='12'){echo "selected";}?>>P5 Dump Yard</option>
                           <option value="13" <?php if($route_details->route_geo_start_id=='13'){echo "selected";}?>>P5 RDF OutArea</option>
                           <option value="14" <?php if($route_details->route_geo_start_id=='14'){echo "selected";}?>>P5 C & D Outarea</option>
                           <option value="15" <?php if($route_details->route_geo_start_id=='15'){echo "selected";}?>>P5 Soil Outarea</option>
                           <option value="16" <?php if($route_details->route_geo_start_id=='16'){echo "selected";}?>> Disposal Point</option>
                           <option value="17" <?php if($route_details->route_geo_start_id=='17'){echo "selected";}?>>P3 PLANT AREA</option>
                           <option value="18" <?php if($route_details->route_geo_start_id=='18'){echo "selected";}?>>P4 PLANT AREA</option>

                           <option value="20" <?php if($route_details->route_geo_start_id=='20'){echo "selected";}?>>P3 Weigh Bridge</option>
                           <option value="21" <?php if($route_details->route_geo_start_id=='21'){echo "selected";}?>>P3 Hopper Point</option>
                           <option value="19" <?php if($route_details->route_geo_start_id=='19'){echo "selected";}?>>P3 Dump Yard</option>
                           <option value="22" <?php if($route_details->route_geo_start_id=='22'){echo "selected";}?>>P3 RDF OutArea</option>
                           <option value="24" <?php if($route_details->route_geo_start_id=='24'){echo "selected";}?>>P3 C & D Outarea</option>
                           <option value="23" <?php if($route_details->route_geo_start_id=='23'){echo "selected";}?>>P3 Soil Outarea</option>
                          <option value="25" <?php if($route_details->route_geo_start_id=='25'){echo "selected";}?>>P3_PLANT_2_AREA</option>
                            <option value="26" <?php if($route_details->route_geo_start_id=='26'){echo "selected";}?>>P5_PLANT_2_AREA</option>

                           <option value="28" <?php if($route_details->route_geo_start_id=='28'){echo "selected";}?>>P4 Weigh Bridge</option>
                           <option value="29" <?php if($route_details->route_geo_start_id=='29'){echo "selected";}?>>P4 Hopper Point</option>
                           <option value="27" <?php if($route_details->route_geo_start_id=='27'){echo "selected";}?>>P4 Dump Yard</option>
                           <option value="30" <?php if($route_details->route_geo_start_id=='30'){echo "selected";}?>>P4 RDF OutArea</option>
                           <option value="32" <?php if($route_details->route_geo_start_id=='32'){echo "selected";}?>>P4 C & D Outarea</option>
                           <option value="31" <?php if($route_details->route_geo_start_id=='31'){echo "selected";}?>>P4 Soil Outarea</option>



                </select>
              </div>

                <div class="form-group col-md-4">
                <label>End Point</label>
                <select class="form-control"  id="route_geo_end_id" name="route_geo_end_id" style="width: 100%;" required>
                   <option value="">select</option>
                           <option value="10" <?php if($route_details->route_geo_end_id=='10'){echo "selected";}?>>P5 Weigh Bridge</option>
                           <option value="11" <?php if($route_details->route_geo_end_id=='11'){echo "selected";}?>>P5 Hopper Point</option>
                           <option value="12" <?php if($route_details->route_geo_end_id=='12'){echo "selected";}?>>P5 Dump Yard</option>
                           <option value="13" <?php if($route_details->route_geo_end_id=='13'){echo "selected";}?>>P5 RDF OutArea</option>
                           <option value="14" <?php if($route_details->route_geo_end_id=='14'){echo "selected";}?>>P5 C & D Outarea</option>
                           <option value="15" <?php if($route_details->route_geo_end_id=='15'){echo "selected";}?>>P5 Soil Outarea</option>
                           <option value="16" <?php if($route_details->route_geo_end_id=='16'){echo "selected";}?>> Disposal Point</option>
                           <option value="17" <?php if($route_details->route_geo_end_id=='17'){echo "selected";}?>>P3 PLANT AREA</option>
                           <option value="18" <?php if($route_details->route_geo_end_id=='18'){echo "selected";}?>>P4 PLANT AREA</option>

                           <option value="20" <?php if($route_details->route_geo_end_id=='20'){echo "selected";}?>>P3 Weigh Bridge</option>
                           <option value="21" <?php if($route_details->route_geo_end_id=='21'){echo "selected";}?>>P3 Hopper Point</option>
                           <option value="19" <?php if($route_details->route_geo_end_id=='19'){echo "selected";}?>>P3 Dump Yard</option>
                           <option value="22" <?php if($route_details->route_geo_end_id=='22'){echo "selected";}?>>P3 RDF OutArea</option>
                           <option value="24" <?php if($route_details->route_geo_end_id=='24'){echo "selected";}?>>P3 C & D Outarea</option>
                           <option value="23" <?php if($route_details->route_geo_end_id=='23'){echo "selected";}?>>P3 Soil Outarea</option>
                             <option value="25" <?php if($route_details->route_geo_end_id=='25'){echo "selected";}?>>P3_PLANT_2_AREA</option>
                          <option value="26" <?php if($route_details->route_geo_end_id=='26'){echo "selected";}?>>P5_PLANT_2_AREA</option>


                            <option value="28" <?php if($route_details->route_geo_end_id=='28'){echo "selected";}?>>P4 Weigh Bridge</option>
                           <option value="29" <?php if($route_details->route_geo_end_id=='29'){echo "selected";}?>>P4 Hopper Point</option>
                           <option value="27" <?php if($route_details->route_geo_end_id=='27'){echo "selected";}?>>P4 Dump Yard</option>
                           <option value="30" <?php if($route_details->route_geo_end_id=='30'){echo "selected";}?>>P4 RDF OutArea</option>
                           <option value="32" <?php if($route_details->route_geo_end_id=='32'){echo "selected";}?>>P4 C & D Outarea</option>
                           <option value="31" <?php if($route_details->route_geo_end_id=='31'){echo "selected";}?>>P4 Soil Outarea</option>



                </select>
              </div>

      
           <div class="form-group col-md-12"><br/>
              <button type="submit" class="btn btn-success pull-right" style="margin-bottom: 15px;"  onclick="fun()">Add Route</button>
          </div>
      </form>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="col-lg-3 col-md-12 col-sm-12">
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

  <script src="<?php echo base_url();?>/assets/plugins/select2/jquery.min.js"></script>
  <script src="<?php echo base_url();?>/assets/plugins/select2/select2.full.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/select2/select2.min.css" >
  <script type="text/javascript">
    

    // $(function () {
    //   // $("#vehicle").select2();
    //     $("#vehicle1").select2();
    // });


  </script>
