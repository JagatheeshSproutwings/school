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
           Add Trip &nbsp;<i class="fa fa-plus"></i>
            </header>
             <form id="assignFrom" role="form" action="<?php echo site_url('/Location/save_zigmatrip/');if (! empty ( $route_details->id )) {echo $route_details->id;}?>" method="post">     


              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="trip_id">Trip Id:<span class="error">*</span></label>
                <input type="text" class="form-control col-md-6 " id="trip_id" name="trip_id" placeholder="Enter Trip Id" value="<?php if (!empty($route_details->trip_id)){echo $route_details->trip_id;}else{echo $last_id;}?>" readonly required>
                <span id="error-dno" class="error-msg"></span>
              </div>

                <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="poc_number">Poc Number:<span class="error">*</span></label>
                <input type="text" class="form-control col-md-6 " id="poc_number" name="poc_number" placeholder="Enter poc_number " value="<?php if (!empty($route_details->poc_number)){echo $route_details->poc_number;}?>" required>
                <span id="error-dno" class="error-msg"></span>
              </div>


              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="vehicle_name">Vehicle Name:<span class="error">*</span></label>
                <input type="text" class="form-control col-md-6 " id="vehicle_name" name="vehicle_name" placeholder="Enter Vehicle Name" value="<?php if (!empty($route_details->vehicle_name)){echo $route_details->vehicle_name;}?>" required>
                <span id="error-dno" class="error-msg"></span>
              </div>


             <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="disposal_site">Dispose Site Name:<span class="error">*</span></label>
                <input type="text" class="form-control col-md-6 " id="disposal_site" name="disposal_site" placeholder="Enter Dispose Site Name" value="<?php if (!empty($route_details->disposal_site)){echo $route_details->disposal_site;}?>" required>
                <span id="error-dno" class="error-msg"></span>
              </div>

            <div class="form-group col-md-3">
                <label>Dispose Geo Location</label>
                <select class="form-control select2" id="disposal_geo_id" name="disposal_geo_id" style="width: 100%;" required>
                     <  <option value="">select</option> 
                  <?php foreach ($location_details as $llist) { ?>
                   
                        <option value="<?php echo $llist->Location_Id;?>" <?php if($route_details->disposal_geo_id == $llist->Location_Id){echo "selected";} ?>><?php echo $llist->Location_short_name;?></option> 
                 <?php  } ?>
              
               

                </select>
              </div>
      
           <div class="form-group col-md-12"><br/>
              <button type="submit" class="btn btn-success pull-right" style="margin-bottom: 15px;"  onclick="fun()">Save</button>
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
    

    $(function () {
      // $("#vehicle").select2();
        $("#disposal_geo_id").select2();
    });


  </script>
