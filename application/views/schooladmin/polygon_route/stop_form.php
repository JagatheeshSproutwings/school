
<?php $role = ($this->session->userdata['role']); ?>

<style>
.col-lg-6
{
  margin: 10px !important;
}
.w3-agile-google_map
{
  line-height: 55px;
}
</style>
<head>
  <!--header start-->
<header class="header fixed-top clearfix">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" >
<!--logo start-->
</header>
</head>
<body>
<section id="container">
<!--main content start-->
<section id="main-content">
    
    <section class="wrapper">
        <div class="w3-agile-google_map">
        <div class="col-lg-1 col-md-12 col-sm-12" style='padding-top: 10px;'>
        </div>
        <div class="col-lg-10 col-md-12 col-sm-12" style='padding-top: 10px;'>
          <header class="panel-heading">
              <?php

              if($route_id!=''){ $ign_q = $this->db->query("SELECT route_name FROM routes WHERE route_id='".$route_id."'");
                  $ign_f = $ign_q->row();
                  echo $ign_f->route_name." ".$form_title; }?> Route Stop &nbsp;<i class="fa fa-plus"></i>
            </header>
            <div class="notify-w3ls  stats-info stats-last widget-shadow" style=" border: none;"> 
                <div class="box-body">      

              <!-- form start -->
            <form name="Routeform" id="Routeform" role='form' action="<?php echo site_url('/route_stop/save_route/');if (! empty ( $route_details->stop_id )) {echo $route_details->stop_id;}?>" method="post" >
              <input type="hidden" name="route_id" value="<?php echo $route_id;?>">
            <div class="box-body">

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="stop_location">Stop Location :<span class="error">*</span></label>
                <select id="stop_geo_id" name="stop_geo_id" class="form-control col-md-6" required>
                            <option value="">--Select--</option>
                            <?php  
                        
                            if(isset($geo_location)){                         
                            foreach($geo_location as $list){  
                            $o_id = $list->Location_Id;
                            ?>  <option value="<?=$list->Location_Id;?>" <?php if(!empty($route_details->stop_geo_id)) { echo($route_details->stop_geo_id == $list->Location_Id) ? 'selected' : ''; }?>><?=$list->Location_short_name;?></option>
                                <?php }}?>
                                
                              </select>
              </div>

                <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="stop_arrival_time">Stop Arrival Time :<span class="error">*</span></label>
                    <input type='text' placeholder='Arrival Time...' autocomplete='off'  class="form-control" name="stop_arrival_time" id="stop_arrival_time" value="<?php if (!empty($route_details->stop_arrival_time )){echo $route_details->stop_arrival_time ;}?>" required/><span id='from_Date-error' class="error" id=''></span>
                  
              </div>

               <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="stop_start_time">Stop Start Time :<span class="error">*</span></label>
                  <input type='text' placeholder='Start Time...' autocomplete='off'  class="form-control" name="stop_start_time" id="stop_start_time" value="<?php if (!empty($route_details->stop_start_time )){echo $route_details->stop_start_time ;}?>" required/><span id='from_Date-error' class="error" id=''></span>
                 
              </div>

          </div>
             
        </div>
    <!-- /.box-body -->
        <div class="modal-footer form-group col-lg-12 col-md-12 col-sm-12">
          <button type="submit" class="btn btn-info submit"><?php echo $form_title;?></button>
        </div>
      </form>
      <!-- FORM END -->
            </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-1 col-md-12 col-sm-12" style='padding-top: 10px;'>
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


<link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/timepicker/jquery.timeselector.css" />
  <script src="<?php echo base_url();?>/assets/plugins/timepicker/jquery.timeselector.js"> </script>
    
    <script type="text/javascript">
      $(function() {
        $('#stop_arrival_time').timeselector();
      });
      $(function() {
        $('#stop_start_time').timeselector();
      });
  </script>