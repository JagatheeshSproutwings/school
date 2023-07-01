<!-- Content Wrapper. Contains page content -->

<?php $role = ($this->session->userdata['role']); ?>
<?php $client_id = ($this->session->userdata['client_id']); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
<section id="container">
  
  <!--header start-->
  <header class="header fixed-top clearfix">
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" >
  </header>
  <!--header end-->
  
  <!--main content start-->
  <section id="main-content">
      <section class="wrapper">
          <div class="w3-agile-google_map">

            <div class="col-lg-12 col-md-12 col-sm-12" style='margin-bottom: 15px !important;'>

          <h2>MAA Assign Vehicles &nbsp;<i class="fa fa-road"></i></h2> 
          
            <div class="col-lg-12 col-md-12 col-sm-12  stats-info stats-last widget-shadow"  style=' margin-top: 10px; height:80vh !important; background-color:#ddd !important; '>             
            
            <form  action="<?php echo site_url();?>/Livetrack/add_vehicles" method="post"> 
            <div class="col-sm-12 col-md-12 col-lg-12">

              <div class="col-lg-12 col-md-12 col-sm-12" style=' margin-top: 10px; overflow-y:auto; height:50vh !important;margin-bottom: 10px'>
                <header class="panel-heading" style="margin-top: 0px !important;">Please Select Vehicle</header>
                <span id='vehicle-error' class="error" id=''></span>
                <?php  

                if(isset($vehiclelist))
                {

                ?>
              
                <?php
                  foreach($vehiclelist as $list)
                  { 
                ?>
                <div class="col-sm-6 col-md-6 col-lg-6 vm">
                  <input type="checkbox" name="visible_status[]" id="v_<?php echo $list->vehicle_id;?>" value="1" <?php if($list->visible_status == 1) { echo "checked='checked'"; } ?>><label for="v_<?php echo $list->vehicle_id;?>"><?=$list->vehicle_name;?></label>
                  <input type="hidden" name="vehicle_id[]" value="<?php echo $list->vehicle_id;?>">
                </div>
                  <?php }}?>
              </div>

          
            </div>
        
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="col-lg-6 col-md-6 col-sm-6">
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3">
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="form-group">
                        <div class='input-group date '>
                          <button type="submit" class="btn bg-navy pull-left search-button">Assign</button>
                    <input type="hidden" id="current_date" value="<?php echo date("m/d/Y"); ?>">
                        </div>
                    </div>
              </div>
            </div>

            
            </form>

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

     <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.css">
  <script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.js"></script>

   
