<!--<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/osm/leaflet.css"/>-->
<style>
     .databottom td{
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        padding-left: 0 !important;
      }
      body.vertical-layout.vertical-menu-modern.menu-collapsed .navbar .navbar-header.expanded{
          width: 105px !important;
    z-index: 1000;
      }
      .dataTables_info{
          display: none;
      }
      .dataTables_length{
          display: none;
      }
      .dataTables_filter{
          margin: -2px 45px;
      }
      .form-control form-control-sm{
          width: 200px !important;
      }
      .wrapper{
  background: #456173;
  display: flex;
  width: 105%;
}
.datacards {
    /*padding-top: 15px;*/
    padding-top: 0px;
  background: #fff;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  display: grid;
  grid-gap: 1rem;
  grid-auto-flow: column;
  grid-auto-columns: calc(25% - 2rem);
  /* min-height: 40vh; */
  width: 100%;
}
.datacards-content {
  /*align-items: center;*/
  background: #fff;
  border-radius: 1rem;
  color: #111;
  display: flex;
  /*font-weight: 900;*/
  /*justify-content: center;*/
  /*font-size: 5rem;*/
  /*text-transform: uppercase;*/
}
.datacards-content:last-child {
  margin-right: 1rem;
}

</style>
<!-- Column selectors table -->
<section id="column-selectors" style="margin: 0px -14px">
  <div class="row1">
    <div class="col-121">
      <div class="card" style="margin: 0px !important">
        <div class="card-content collapse show">
          <div class="card-body1 card-dashboard">
               <div id="single_map" style="width:100%;height: 55vh !important;">
                 
               </div>
                 <div class="content-wrapper1 single_vehicle_status">
                    <div class="content-body1"><!-- Search form-->
                        <section id="search-website" class="card1 overflow-hidden">
                            <div class="card-header1">
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <div class="card1">
                                        <div class="card-content" style="margin-left: -15px;">
                                            <div class="col-md-121">
                                                <ul class="nav nav-tabs nav-topline" role="tablist">
                                                <!--<ul class="nav nav-tabs nav-linetriangle" role="tablist" style="width: 50%">-->
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="baseIcon-tab31" data-toggle="tab" aria-controls="tabIcon31" href="#tabIcon31" role="tab" aria-selected="true"><i class="fa fa-play"></i>Full Data</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="baseIcon-tab32" data-toggle="tab" aria-controls="tabIcon32" href="#tabIcon32" role="tab" aria-selected="false"><i class="fa fa-flag"></i>Alerts</a>
                                                    </li>
                                                     <li class="nav-item">
                                                        <a class="nav-link" id="baseIcon-tab33" data-toggle="tab" aria-controls="tabIcon33" href="#tabIcon33" role="tab" aria-selected="false"><i class="fa fa-cog"></i>Packets</a>
                                                    </li> 

                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tabIcon31" role="tabpanel" aria-labelledby="baseIcon-tab31">
                                                        <div class="wrapper">
                               <section class="datacards" style="height: 125px;"> <!-- height175 to 125 change-->
                                       <div class="datacards-content">
                                           <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                        <tbody>
                            <tr class="databottom">
                                 <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>On Duration:</div>
                                    <div style='float: right; text-align: right'><span id="onduration"></span></div>
                                </td>
                            </tr>
                                 <tr class="databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Vehicle Number</div>
                                    <div style='float: right; text-align: right'><span id="vehicleNo"></span></div>
                                </td>
                            </tr>
                            <tr class="databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>AC Status</div>
                                    <div style='float: right; text-align: right'><span id="ac_status"></span></div>
                                </td>
                            </tr>
                            <tr class="databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\3.svg" width="25" alt=""></span>Vehicle Status</div>
                                    <div style='float: right; text-align: right'><span id="vehicle_status"></span></div>
                                </td>
                            </tr>
                            <tr class="databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\4.svg" width="25" alt=""></span>Odometer</div>
                                    <div style='float: right; text-align: right'><span id="odometer"></span></div>
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>
                </div>
             </div>


        <div class="datacards-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                    <tbody>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Fuel:</div>
                                <div style='float: right; text-align: right'><span id="fuel_ltr"></span></div>
                            </td>
                        </tr>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Today KM:</div>
                                <div style='float: right; text-align: right'><span id="today_km"></span></div>
                            </td>
                        </tr>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>Driver Name</div>
                                <div style='float: right; text-align: right'><span id="ac_status"></span></div>
                            </td>
                        </tr>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\3.svg" width="25" alt=""></span>Altitute :</div>
                                <div style='float: right; text-align: right'><span id="altitute"></span></div>
                            </td>
                        </tr>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\4.svg" width="25" alt=""></span>GPS Signal :</div>
                                <div style='float: right; text-align: right'><span id="gpssignal"></span></div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
              
<div class="datacards-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                    <tbody>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Main Battery:</div>
                                <div style='float: right; text-align: right'><span id="devicebattery"></span></div>
                            </td>
                        </tr>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Internal Battery :</div>
                                <div style='float: right; text-align: right'><span id="car_battery"></span></div>
                            </td>
                        </tr>
                        <tr class="databottom">
                            <td>
                                <div style='float: left; text-align: left'>
                                    <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>Internal Battery Voltage :</div>
                                <div style='float: right; text-align: right'><span id="internal_battery_voltage"></span></div>
                            </td>
                        </tr>
                        
                        

                    </tbody>
                </table>
            </div>
        </div>
<div class="datacards-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                    <tbody>
                        <tr class="databottom">
                                 <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>GSM Signal:</div>
                                    <div style='float: right; text-align: right'><span id="gsmsignal"></span></div>
                                </td>
                            </tr>
                                 <tr class="<?php if($access_menu->hour_meter == '0'){echo "hidden";} ?> databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Hour Meter:</div>
                                    <div style='float: right; text-align: right'><span id="vehicleNo"></span></div>
                                </td>
                            </tr>
                            <tr class="databottom <?php if($access_menu->hour_meter == '0'){echo "hidden";} ?>">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>Today Running Duration</div>
                                    <div style='float: right; text-align: right'><span id="ac_status"></span></div>
                                </td>
                            </tr>
                            <tr class="databottom mdvr_terminal_no hidden">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\3.svg" width="25" alt=""></span>MDVR</div>
                                    <div style='float: right; text-align: right'><span id="vehicle_status"></span></div>
                                </td>
                            </tr>
                            <tr class="databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span><img src="<?php echo base_url();?>app-assets\images\menuicon\4.svg" width="25" alt=""></span>Address: </div>
                                    <div style='float: right; text-align: right'><span id="address"></span></div>
                                </td>
                            </tr>
                        

                    </tbody>
                </table>
            </div>
        </div>
                                                                
                                                                
         
              <div class="<?php if($access_menu->obd_report == '0'){echo "hidden";} ?>">
              <div class="datacards-content">
                    <div class="table-responsive">
                     <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                        <tbody>
                             <tr>
                                <td>
                                    <div style='float: left; text-align: left'>Dash Odometer</div>
                                    <div style='float: right; text-align: right'><span id="dash"></span></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style='float: left; text-align: left'>Engine Speed</div>
                                    <div style='float: right; text-align: right'><span id="devicebattery"></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style='float: left; text-align: left'>Coolant Level</div>
                                    <div style='float: right; text-align: right'><span id="car_battery"></span></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style='float: left; text-align: left'>Engine Load :</div>
                                    <div style='float: right; text-align: right'><span id="internal_battery_voltage"></span></div>
                                </td>
                            </tr>

                              <tr class="databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                     <span>Coolant Temperature:</span></div>
                                    <div style='float: right; text-align: right'><span id="vehicle_stat1us"></span></div>
                                </td>
                            </tr>
                            <tr class="databottom">
                                <td>
                                    <div style='float: left; text-align: left'>
                                    <span>Last Updated Time:</span></div>
                                    <div style='float: right; text-align: right'><span id="odomete1r"></span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               </div>
           </div>


           <div class="<?php if($access_menu->temperature_report == '0'){echo "hidden";} ?>">
              <div class="datacards-content">
                    <div class="table-responsive">
                     <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                        <tbody>
                             <tr>
                                <td>
                                    <div style='float: left; text-align: left'>Temperature &emsp;</div>
                                    <div style='float: left; text-align: left'><span id="temp_value"></span></div>
                                </td>
                            </tr>

                            <!-- <tr>
                                <td>
                                    <div style='float: left; text-align: left'>Temp Datetime</div>
                                    <div style='float: right; text-align: right'><span id="temp_datetime"></span></div>
                                </td>
                            </tr> -->
                           
                        </tbody>
                    </table>
                </div>
               </div>
           </div>


                                                          
       
          
        </section>
    </div>
</div>
                                                    <div class="tab-pane" id="tabIcon32" role="tabpanel" aria-labelledby="baseIcon-tab32">
                                                       
                                                         <div class="datacards-content">
                                                                    <div class='table-responsive'>
                                                                        <article class="card-group-item">
                                                                          <!--   <header class="card-header1">
                                                                                <h6 class="title" style='background-color: #f2efe9;color: black;padding: 5px 3px;'>Alerts</h6>
                                                                            </header> -->
                                                                            <div class="filter-content" style="height: 170px;">
                                                                                <div class="list-group list-group-flush">
                                                                                  <div id="alertreport" style="width:25%">
                                                                                
                                                                                </div>  <!-- list-group .// -->
                                                                            </div>
                                                                            </div>
                                                                        </article>
                                                                    </div>
                                                                </div>

                                                    </div>
                                                     <div class="tab-pane" id="tabIcon33" role="tabpanel" aria-labelledby="baseIcon-tab33">
                                                        <div class="datacards-content">
                                                                    <div class='table-responsive'>
                                                                        <article class="card-group-item">
                                                                          <!--   <header class="card-header1">
                                                                                <h6 class="title" style='background-color: #f2efe9;color: black;padding: 5px 3px;'>Alerts</h6>
                                                                            </header> -->
                                                                            <div class="filter-content" style="height: 170px;">
                                                                                <div class="list-group list-group-flush">
                                                                                  <div id="alertreport" style="width:25%">
                                                                                Coming Soon
                                                                                </div>  <!-- list-group .// -->
                                                                            </div>
                                                                            </div>
                                                                        </article>
                                                                    </div>
                                                                </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--/ Search form -->

                    </div>
                </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>




