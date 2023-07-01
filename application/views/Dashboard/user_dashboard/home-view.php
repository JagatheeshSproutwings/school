<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        .apexcharts-legend
        {
            display: none !important;
        }
        .navbar-semi-dark .navbar-header {
    background: #ffffff !important;
    color: red;
}
.chartWrapper {
    position: relative;
	height:400px;
	overflow: scroll;
}

.chartWrapper > canvas {
    position: absolute;
    left: 0;
    top: 0;
    pointer-events:none;
}

.chartAreaWrapper {
    height: 2500px;
    overflow: scroll;
}
.maxhegi{
	 height: 400px;
    min-width: 320px;
    max-width: 600px;
    margin: 0 auto;
}
    </style>

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content box-bordershado">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-purple bg-darken-2">
                        <i class="fa fa-car font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-purple white media-body">
                        <h5>All Vehicles</h5>
                        <h5 class="text-bold-400 mb-0"><span id="allvehicles"></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content box-bordershado">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                        <i class="fa fa-car font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-success white media-body">
                        <h5>Moving</h5>
                        <h5 class="text-bold-400 mb-0"><span id="moving"></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content box-bordershado">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-warning bg-darken-2">
                        <i class="fa fa-car font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-warning white media-body">
                        <h5>Idle</h5>
                        <h5 class="text-bold-400 mb-0"> <span id="idle"></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>        
    <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content box-bordershado">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                        <i class="fa fa-car font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-primary white media-body">
                        <h5>Parking</h5>
                        <h5 class="text-bold-400 mb-0"><span id="parking"></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content box-bordershado">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-gradient-directional-grey-blue bg-darken-2">
                        <i class="fa fa-car font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-grey-blue white media-body">
                        <h5>Out of Coverage</h5>
                        <h5 class="text-bold-400 mb-0"><span id="nonetwork"></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<!--=========================================top1============================-->

<!-- Analytics map based session -->
<div class="row">
    <div class="col-12">
        <div class="card box-shadow-0">
            <div class="card-content">
                <div class="row">
                    <div class="col-xl-9 col-lg-12">
                        <div id="world-map-markers" class="height-450"></div>
                    </div>
                    <div class="col-xl-3 col-lg-12">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Total vehicle</h4>
                            <div class="row">
                                <div class="col-xl-12 col-lg-6 col-sm-12">
                                    <!--<p class="pb-1">Pie Chart</p>-->
                                    <!--<div id="sessions-browser-donut-chart" class="height-200"></div>-->
                                    <div id="radial-bar-multiple-chart" class="height-200"></div>
                                </div>
                                <div class="col-xl-12 col-lg-6 col-sm-12">
                                    <div class="sales pr-2 pt-2">
                                       <!--  <div class="sales-today mb-2">
                                            <p class="m-0">Today's <span class="primary float-right"><i class="feather icon-arrow-up primary"></i> 6.89%</span></p>
                                            <div class="progress progress-sm mt-1 mb-0">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div> -->
                                        <div class="sales-yesterday" id="yeskm">
                                            <p class="m-0">Yesterday's KM<span class="success float-right"><span id="yesterday_km"></span></span></p>
                                            <div class="progress progress-sm mt-1 mb-0">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Analytics map based session -->
<!--=========================================top2============================-->

<!--=========================================top 2============================-->

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vehicle Charts</h4>
                    <!--<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>-->
<!--                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                            <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                        </ul>
                    </div>-->
                </div>
               <div class="card-content collapse show">
                    <div class="card-body">
                       <div class="chartWrapper">
    <div class="chartAreaWrapper">
<canvas id="column-stacked" style="height:2500px"></canvas>
 </div>
</div>
                        
               <!--    <div class="chart-container" style="height:2500px">
                            <canvas id="column-stacked"></canvas>
                        </div> -->
						
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--=================================================================-->
<div class="row match-height" hidden>
    <div class="col-xl-4 col-lg-12">

              <div class="card bg-gradient-x-info white">
            <div class="card-content">
                <div class="card-body text-center">
                    <div class="mb-2">
                      
                       <a href="<?php echo site_url('report/genericreport');?>" title="Generic Report" style="color: white;"> <i class="fa fa-file font-large-2"></i></a>

                    </div>
                    <div class="tweet-slider">
                      <a href="<?php echo site_url('report/genericreport');?>" style="color: white;">  <ul>
                            <!-- <li>Parking Report<span class="yellow">#</span> football pool!
                                <p class="text-italic pt-1">- John Doe</p>
                            </li> -->
                            <li>Parking Report <br>
                                Idle Report <br>
                                 Trip Report <br>
                                  <p class="text-italic pt-1">- Sproutwings Telematics</p>
                            </li>
                            <li>
                                Geo Fence Report <br>
                                Hub Point Report <br>
                                Engine RPM Report <br>
                                 <p class="text-italic pt-1">- Sproutwings Telematics</p>
                            </li>
                           <li>
                                Playback Report <br>
                                Distance Report <br>
                                 <p class="text-italic pt-1">- Sproutwings Telematics</p>
                             
                            </li>
                           <!--  <li>Are there <span class="yellow">#common-sense</span> facts related to your business? Combine them with a great photo.
                                <p class="text-italic pt-1">- John Doe</p>
                            </li> -->
                        </ul>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card bg-gradient-x-danger">
            <div class="card-content">
                <div class="card-body">
                    <div class="animated-weather-icons text-center float-left">
                        <svg version="1.1" id="cloudHailAlt2" class="climacon climacon_cloudHailAlt climacon-blue-grey climacon-darken-2 height-100" viewBox="15 15 70 70">
                            <g class="climacon_iconWrap climacon_iconWrap-cloudHailAlt">
                                <g class="climacon_wrapperComponent climacon_wrapperComponent-hailAlt">
                                    <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left">
                                        <circle cx="42" cy="65.498" r="2"></circle>
                                    </g>
                                    <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle">
                                        <circle cx="49.999" cy="65.498" r="2"></circle>
                                    </g>
                                    <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right">
                                        <circle cx="57.998" cy="65.498" r="2"></circle>
                                    </g>
                                    <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left">
                                        <circle cx="42" cy="65.498" r="2"></circle>
                                    </g>
                                    <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle">
                                        <circle cx="49.999" cy="65.498" r="2"></circle>
                                    </g>
                                    <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right">
                                        <circle cx="57.998" cy="65.498" r="2"></circle>
                                    </g>
                                </g>
                                <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                                    <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M63.999,64.941v-4.381c2.39-1.384,3.999-3.961,3.999-6.92c0-4.417-3.581-8-7.998-8c-1.602,0-3.084,0.48-4.334,1.291c-1.23-5.317-5.974-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,11.998c0,3.549,1.55,6.728,3.999,8.924v4.916c-4.776-2.768-7.998-7.922-7.998-13.84c0-8.835,7.162-15.997,15.997-15.997c6.004,0,11.229,3.311,13.966,8.203c0.663-0.113,1.336-0.205,2.033-0.205c6.626,0,11.998,5.372,11.998,12C71.998,58.863,68.656,63.293,63.999,64.941z"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="weather-details text-center">
                        <span class="block white darken-1">Snow</span>
                        <span class="font-large-2 block white darken-4">-5&deg;</span>
                        <span class="font-medium-4 text-bold-500 white darken-1">London, UK</span>
                    </div>
                </div>
                <div class="card-footer bg-gradient-x-danger border-0">
                    <div class="row">
                        <div class="col-4 text-center display-table-cell white">
                            <i class="me-wind font-large-1 lighten-3 align-middle"></i> <span class="align-middle">2MPH</span>
                        </div>
                        <div class="col-4 text-center display-table-cell white">
                            <i class="me-sun2 font-large-1 lighten-3 align-middle"></i> <span class="align-middle">2%</span>
                        </div>
                        <div class="col-4 text-center display-table-cell white">
                            <i class="me-thermometer font-large-1 lighten-3 align-middle"></i> <span class="align-middle">13.0&deg;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card bg-gradient-x-danger white">
            <div class="card-content">
                <div class="card-body text-center">
                    <div class="mb-2">
                      
                         <a href="#" onClick="executivereport();" title="Executive Report" style="color: white;"><i class="fa fa-file font-large-2"></i></a>

                    </div>
                    <div class="tweet-slider">
                        <a href="#" onClick="executivereport();"  style="color: white;"> 
                            <ul>
                            <li>Executive  Report
                            </li>
                            <li><span class="yellow">Day By Day Report </span>
                                <p class="text-italic pt-1">- Sproutwings Telematics</p>
                            </li>
                            
                        </ul>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card bg-gradient-x-primary white">
            <div class="card-content">
                <div class="card-body text-center">
                    <div class="mb-2">
                       <a href="#" onClick="smartreport();" title="Smart Report" style="color: white;">  <i class="fa fa-file font-large-2"></i></a>
                    </div>
                    <div class="fb-post-slider">
                        <a href="#" onClick="smartreport();" style="color: white;"> <ul>
                            <li>Summary  Report
                            </li>
                            <li><span class="yellow">Date Based Combined Report </span>
                                <p class="text-italic pt-1">- Sproutwings Telematics</p>
                            </li>
                            
                        </ul>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
							<div class="col-xl-4 col-lg-12 mb-1">
                                                            <div class="form-group box-bordershado">
									<!-- Social Buttons block sizes -->
                                                                        <a href="<?= base_url(); ?>report/genericreport" class="btn btn-social mb-1 btn-block btn-lg btn-soundcloud"><span class="fa fa-file"></span>Generic Report</a>
									</div>
								
							</div>
							<div class="col-xl-4 col-lg-12 mb-1">
								<div class="form-group text-center">
									<!-- Social Buttons sizes -->
                                                                        <div class="form-group box-bordershado">
									<!-- Social Buttons block sizes -->
									<a href="#" onClick="executivereport();" class="btn btn-social mb-1 btn-block btn-lg btn-flickr"><span class="fa fa-file-archive-o"></span> Executive Report</a>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-12 mb-1 social-buttons">
								<div class="form-group box-bordershado">
									<!-- Social Buttons block sizes -->
									 <a href="#" onClick="smartreport();"  class="btn btn-social mb-1 btn-block btn-lg btn-pinterest"><span class="fa fa-file-o"></span> Smart Report</a>
									</div>
							</div>
						</div>
        
		</div>
      </div>
    </div>
    <!-- END: Content-->
    
     
      <?php   $this->load->view('reports/popup_report/executive_report'); ?>
        <?php   $this->load->view('reports/popup_report/smart_report'); ?>
    
    <script src="<?php echo base_url(); ?>app-assets/vendors/js/charts/chart.min.js"></script>
        <script src="<?php echo base_url(); ?>app-assets/js/scripts/charts/chartjs/bar/bar.min.js"></script>
    <script src="<?php echo base_url(); ?>app-assets/js/scripts/charts/chartjs/bar/bar-stacked.min.js"></script>
    <script src="<?php echo base_url(); ?>app-assets/js/scripts/charts/chartjs/bar/bar-multi-axis.min.js"></script>
    <script src="<?php echo base_url(); ?>app-assets/js/scripts/charts/chartjs/bar/column.js"></script>
    <!--<script src="<?php echo base_url(); ?>app-assets/js/scripts/charts/chartjs/bar/column-stacked.min.js"></script>-->
    <script src="<?php echo base_url(); ?>app-assets/js/scripts/charts/chartjs/bar/column-multi-axis.min.js"></script>
    
    <script src="<?php echo base_url(); ?>app-assets/vendors/js/charts/apexcharts/apexcharts.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/osm/leaflet.css"/>
    <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.js"></script> 
    <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.rotatedMarker.js"></script>

    <script>

      function executivereport()
                    {
                        jQuery('#executive_reports').modal('show');
                    }
                       function smartreport()
                    {
                        jQuery('#smart_report').modal('show');
                    }
                  var marker;
                   var markers = [];
                   var client_id = <?php echo $this->session->userdata['client_id']; ?>;
                 map = L.map('world-map-markers').setView([11.0467,76.9254],6);
    L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:20}).addTo(map);

        var fg = L.featureGroup().addTo(map);
        var assetLayerGroup = new L.LayerGroup();

        $( document ).ready(function() {
    
       update_all_data1();

     });   

     $.ajax({
        url: '<?php echo site_url('/Dashboard/polygon_list/');?>',//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {

              var polyLayers = [];
            for (var i = 0; i < data.length; i++) {
                     output=[];
                     console.log(i);
                   
                   output = $.each(data[i].polypoints, function(index, value){
                       
                       return   [+value.lat, +value.lng];
                      //console.log(poly_data);
                    });

                   var polygon = L.polygon([output]);
                    console.log(output);
                    output=[]
                   // console.log(P5_bridge);
                      polygon.bindPopup(data[i].polygon_name);
                       polygon.setStyle({color: data[i].color,fillColor: data[i].fillcolor});

                      polyLayers.push(polygon);

                 for(layer of polyLayers) {

                       fg.addLayer(layer); 

                     
                    }
                  
              }

            


        },error:function(){
          console.log('error');
        }
      });

         function update_all_data1() {
      
     if (marker != undefined) {
               map.removeLayer(marker);
            };

         $.ajax({
           url: '<?php echo site_url('/Dashboard/all_vehicle_loc/');?>',
           type: 'GET',
           dataType : "json",
           success: function(data)
           {
         
                
               for (i = 0; i < data.length; i++) 
               {  

                var vehicle_sleep =parseInt(data[i].vehicle_sleep);
                var v_acc_on = parseInt(data[i].acc_on);
                var v_speed = parseInt(data[i].speed);
                var angle = parseInt(data[i].angle);
                var vehicletype = parseInt(data[i].vehicle_type);
                var v_u_time = parseInt(data[i].update_time);

             if(v_u_time <= 10)
                {
                    if(v_acc_on == 1)
                    {
                      if(v_speed >0)
                      {

                         switch(vehicletype) {//running

                            case 1:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bike.png';
                              break;
                           case 2:             
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/car.png';
                              break;
                           case 3:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bus.png';
                              break;
                           case 4:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bus.png';
                              break;
                           case 5:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/truck.png';
                              break;
                            case 6:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/container.png';
                              break;
                            case 7:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/open_truck.png';
                              break;
                            case 8:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/rmc_truck.png';
                              break;
                            case 9:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/cylinder_truck.png';
                              break;
                            case 10:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/container.png';
                              break;
                            case 11:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/jcb.png';
                              break;
                            case 12:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/loader.png';
                              break;
                            case 13:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/ace.png';
                              break;
                            case 14:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/tipper.png';
                              break;
                            case 15:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/tractor.png';
                              break;
                            default:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/truck.png';

                          }
                      }
                      else
                      {
                       switch(vehicletype) {//idle

                            case 1:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/bike.png';
                              break;
                           case 2:             
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/car.png';
                              break;
                           case 3:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/bus.png';
                              break;
                           case 4:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/bus.png';
                              break;
                           case 5:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/truck.png';
                              break;
                            case 6:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/container.png';
                              break;
                            case 7:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/open_truck.png';
                              break;
                            case 8:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/rmc_truck.png';
                              break;
                            case 9:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/cylinder_truck.png';
                              break;
                            case 10:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/container.png';
                              break;
                            case 11:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/jcb.png';
                              break;
                            case 12:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/loader.png';
                              break;
                            case 13:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/ace.png';
                              break;
                            case 14:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/tipper.png';
                              break;
                            case 15:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/tractor.png';
                              break;
                            default:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/truck.png';

                          }
                      }

                    }
                    else
                    {
                       console.log("vehicletype parking"+vehicletype);

                       switch(vehicletype) {//parking

                            case 1:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/bike.png';
                              break;
                           case 2:             
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/car.png';
                              break;
                           case 3:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/bus.png';
                              break;
                           case 4:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/bus.png';
                              break;
                           case 5:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/truck.png';
                              break;
                            case 6:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/container.png';
                              break;
                            case 7:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/open_truck.png';
                              break;
                            case 8:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/rmc_truck.png';
                              break;
                            case 9:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/cylinder_truck.png';
                              break;
                            case 10:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/container.png';
                              break;
                            case 11:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/jcb.png';
                              break;
                            case 12:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/loader.png';
                              break;
                            case 13:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/ace.png';
                              break;
                            case 14:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/tipper.png';
                              break;
                            case 15:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/tractor.png';
                              break;
                            default:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/truck.png';

                          }
                    }
                  
                }
                else
                {
                  console.log("vehicletype no;"+vehicletype);

                   switch(vehicletype) {//no ntwork

                            case 1:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/bike.png';
                              break;
                           case 2:             
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/car.png';
                              break;
                           case 3:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/bus.png';
                              break;
                           case 4:
                              var image_path ='<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/bus.png';
                              break;
                           case 5:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/truck.png';
                              break;
                            case 6:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/container.png';
                              break;
                            case 7:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/open_truck.png';
                              break;
                            case 8:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/rmc_truck.png';
                              break;
                            case 9:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/cylinder_truck.png';
                              break;
                            case 10:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/container.png';
                              break;
                            case 11:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/jcb.png';
                              break;
                            case 12:             
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/loader.png';
                              break;
                            case 13:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/ace.png';
                              break;
                            case 14:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/tipper.png';
                              break;
                            case 15:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/tractor.png';
                              break;
                            default:
                              var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/truck.png';

                          }
                }
                             
  
                 var redIcon = new L.Icon({
                iconUrl: image_path,
                iconSize:  [40, 40],
              });

                 //alert(data[i].angle);
              
                 marker = new L.marker([data[i].lat, data[i].lng],{icon: redIcon,rotationAngle: data[i].angle})
                  .bindPopup(" Vehicle  : "+ data[i].vehiclename)
                  .addTo(fg);

                  console.log(marker);
                   map.addLayer(marker);

                   markers.push(marker); 

                }
                   assetLayerGroup.addLayer(markers);
                    map.fitBounds(fg.getBounds());

                    console.log(markers);
              
                 
           }

          
     });

  }



    $( document ).ready(function() {
    
           $.ajax({
        url: '<?php echo site_url('/Dashboard/allvehicle_count/');?>',//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
        
        radial_bar(data);
        var total_val = parseInt(data.move_count) + parseInt(data.idle_count) + parseInt(data.park_count) + parseInt(data.nonetwork_count);
//        var total_val = data.move_count + data.park_count + data.idle_count + data.nonetwork_count;
         $("#allvehicles").append(total_val);
         $("#moving").append(data.move_count);
         $("#parking").append(data.park_count);
         $("#idle").append(data.idle_count);
         $("#nonetwork").append(data.nonetwork_count);
        },error:function(){
          console.log('error');
        }
      });

           $.ajax({
        url: '<?php echo site_url('/Dashboard/current_distance_data/');?>',//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
        
        console.log(data.distance_km);
        if (data.distance_km) 
        {
             $("#yesterday_km").append(Math.round(data.distance_km)+' KM');
        }
        else
        {
            $("#yeskm").hide();
        }
        

        },error:function(){
          console.log('error');
        }
      });

            $.ajax({
                    url: '<?php echo site_url('/Dashboard/all_reports_data/');?>',//get current ignition route from db
                    type: 'GET',
                    dataType : "json",
                    success: function(data) {
                    
                     console.log(data);
                     all_reports(data);

                    
                    },error:function(){
                      console.log('error');
                    }
                  });



     });   
            function radial_bar(data) {
               
         var total_val = parseInt(data.move_count) + parseInt(data.idle_count) + parseInt(data.park_count) + parseInt(data.nonetwork_count);
         var move = parseInt(data.move_count);
         var park = parseInt(data.park_count);
         var idle = parseInt(data.idle_count);
         var nonetwork = parseInt(data.nonetwork_count);
         console.log([total_val, move, park, idle, nonetwork]);

           var options = {
          series: [move, park, idle, nonetwork],
          labels: ['Moving', 'Parking', 'Idle' , 'Nonetwork'],
          chart: {
          width: 280,
          type: 'donut',
        },

     plotOptions: {
    pie: {
      donut: {
        labels: {
          show: true,
          total: {
            show: true,
            label: 'Total',
            formatter: () => total_val
          }
        }
      }
    }
  },
        dataLabels: {
          enabled: false
        },
      fill: {
     colors: ['#098522', '#092085', '#ebd409','#9e9d99']
    },
       
        title: {
          text: 'Vehicle Chart'
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#radial-bar-multiple-chart"), options);
        chart.render();

   }
        
                   

      function all_reports(data) 

      {
       // alert('hi');
             // var a=$("#column-stacked");
             //    new Chart(a,{
             //        type:"bar",
             //        options:{title:{display:!1,text:"Chart.js Column Chart - Stacked"},
             //            tooltips:{mode:"label"},responsive:!0,maintainAspectRatio:!1,responsiveAnimationDuration:500,
             //            scales:{xAxes:[{stacked:!0,display:!0,
             //                        gridLines:{color:"#f3f3f3",drawTicks:!1},
             //                        scaleLabel:{display:!0}}],
             //                yAxes:[{stacked:!0,display:!0,
             //                        gridLines:{color:"#f3f3f3",drawTicks:!1},
             //                        scaleLabel:{display:!0}}]}},
             //        data:{
             //            labels:data.vehicle_data,
             //            datasets:[{label:"My First dataset",
             //                    data:data.park_data,
             //                    backgroundColor:"#5175E0",hoverBackgroundColor:"rgba(81,117,224,.8)",borderColor:"transparent"},
             //                {label:"My Second dataset",
             //                    data:data.idle_data,
             //                    backgroundColor:"#16D39A",hoverBackgroundColor:"rgba(22,211,154,.8)",borderColor:"transparent"},
             //                {label:"My Third dataset",
             //                    data:data.ign_data,
             //                    backgroundColor:"#F98E76",hoverBackgroundColor:"rgba(249,142,118,.8)",borderColor:"transparent"}
             //            ]
             //        }
             //    })

            var a=$("#column-stacked");
            new Chart(a,{type:"horizontalBar",
                options:{title:
                    {display:!1,text:"Chart.js Bar Chart - Stacked"},
                   tooltips:{mode:"label"},responsive:!0,maintainAspectRatio:!1,responsiveAnimationDuration:500,
				   
				   responsive: true,
    maintainAspectRatio: false,
	aspectRatio:4,
                   scales:{xAxes:[{stacked:!0,display:!0,
                   gridLines:{color:"#f3f3f3",drawTicks:!1},
                   scaleLabel:{display:!0}}],

                   yAxes:[{stacked:!0,display:!0,gridLines:{color:"#f3f3f3",drawTicks:!1},scaleLabel:{display:!0}}]
               }
           },
           data:{labels:data.vehicle_data,
           datasets:[{label:"Parking",data:data.park_data,
           backgroundColor:"#5175E0",hoverBackgroundColor:"rgba(81,117,224,.8)",borderColor:"transparent"},

           {label:"Idle",data:data.idle_data,
           backgroundColor:"#F98E76",hoverBackgroundColor:"rgba(22,211,154,.8)",borderColor:"transparent"},

           {label:"Moving",data:data.ign_data,
           backgroundColor:"#16D39A",hoverBackgroundColor:"rgba(249,142,118,.8)",borderColor:"transparent"}
           ]
       }
   });

      }

           
            </script>

            <script>
                $(window).on("load",(function(){           
        var r=!1;"rtl"==$("html").data("textdirection")&&(r=!0),!0===r&&$(".tweet-slider").attr("dir","rtl"),!0===r&&$(".fb-post-slider").attr("dir","rtl"),
        $(".tweet-slider").unslider({autoplay:!0,delay:3500,arrows:!1,nav:!1,infinite:!0}),
        $(".fb-post-slider").unslider({autoplay:!0,delay:4500,arrows:!1,nav:!1,infinite:!0})}));
                </script>
