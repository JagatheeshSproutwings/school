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
                 map = L.map('world-map-markers').setView([11.0467,76.9254],8);
    L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:16}).addTo(map);

        var fg = L.featureGroup().addTo(map);
        var assetLayerGroup = new L.LayerGroup();

        $( document ).ready(function() {
    
       update_all_data1();

     });   


//draw polygon

if(client_id==7)
{
  var polyLayers = [];

    var polygonA = L.polygon([
       [10.93590377, 78.15227509],
        [10.93570363, 78.15584779],
        [10.93774722,78.15588534],
        [10.93775775,78.15552592],
        [10.93757867, 78.15383077],
        [10.93694664, 78.15362692],
        [10.93704144, 78.15229654],
        [10.93629353, 78.15228581]
        
    ]);
    polyLayers.push(polygonA)

    var polygonB = L.polygon([
         [10.93771561,78.15180302],
        [10.93813697, 78.15354109],
        [10.93862153, 78.15467834],
       
        [10.93893755, 78.15303683],
          [10.93894282,78.15158308],
        [10.93875847,78.15036535],
        [10.93817911,78.14875603],
       
        [10.93889541,78.14680338],
        [10.93790523, 78.14691067],
        [10.93725212, 78.14791918],
        [10.93720999, 78.14914227],
        [10.93754707, 78.15070868],
    ]);
    polyLayers.push(polygonB)


    var polygonC = L.polygon([
        [10.93537707, 78.15037608],
        [10.93569309, 78.15095544],
        [10.93595644, 78.15196395],
        [10.93699931, 78.15130949],
        [10.93741013, 78.15063357],
        [10.93708358, 78.14946413],
        [10.93682023, 78.14850926],
        [10.93636727, 78.14927101],
        [10.93580897, 78.15004349]
        
    ]);
    polyLayers.push(polygonC)


    var polygonD = L.polygon([
      [10.93498731,78.15008168],
        [10.93445008,78.14756513],
        [10.93591431,78.14695358],
        [10.93753654,78.14668536],
        [10.93643047,78.14846635],
        [10.93554562,78.14979672]
        
    ]);
    polyLayers.push(polygonD)

  
    // Add the layers to the fg feature group 
    for(layer of polyLayers) {
      fg.addLayer(layer); 
    }

}

if(client_id==198)
{
  
var polyLayers = [];


    var P5_bridge = L.polygon([
        [12.955539, 80.220974],
        [12.955633, 80.221013],
        [12.955695, 80.220807],
        [12.955620, 80.220760]
       
    ]);

    
      P5_bridge.bindPopup("P5 weigh Bridge");


   
 polyLayers.push(P5_bridge);


            
        var P5_dumpyard_new = L.polygon([
        [12.958717, 80.221722],
        [12.956544, 80.222053],
        [12.956622, 80.221228],
        [12.956433, 80.221008],
        [12.956281, 80.220933],
        [12.956486, 80.220236],
        [12.956353, 80.219414],
        [12.956561, 80.219475],  
        [12.957100, 80.220367],
        [12.957292, 80.220611],
        [12.957353, 80.220914],
        [12.957819, 80.221092],
        [12.958125, 80.221464]
    ]);

    12.958717,80.221722 12.956544,80.222053 12.956622,80.221228 12.956433,80.221008 12.956281,80.220933 
    12.956486,80.220236 12.956353,80.219414 12.956561,80.219475 12.957100,80.220367 12.957292,80.220611 
    12.957353,80.220914 12.957819,80.221092 12.958125,80.221464

   P5_dumpyard_new.bindPopup("P5 Dump Yard");

  polyLayers.push(P5_dumpyard_new);

    var P5_hopperpoint = L.polygon([
        [12.956000, 80.220378],
        [12.955911, 80.220750],
        [12.955606, 80.220656],
        [12.955708, 80.220322]
        
    ]);
      
  P5_hopperpoint.bindPopup("P5 Hopper");
 
    polyLayers.push(P5_hopperpoint);


    var P5_PL2_HOPPER = L.polygon([
        [12.956400, 80.221053],
        [12.956311, 80.221297],
        [12.956161, 80.221281],
        [12.956036, 80.221233],
        [12.956125, 80.220986],
        [12.956258, 80.221011]
        
    ]);
      
    P5_PL2_HOPPER.bindPopup("P5_PL2_HOPPER");
 
    polyLayers.push(P5_PL2_HOPPER);


      var P5_RDF_outarea = L.polygon([
        [12.955786, 80.219850],
        [12.955725, 80.220079],
        [12.955632, 80.220126],
        [12.955504, 80.220043],
        [12.955552, 80.219824],
        [12.955677, 80.219779]
        
    ]);
      

   P5_RDF_outarea.bindPopup("P5 RDF Out Area");

    polyLayers.push(P5_RDF_outarea);


    var P5_PL2_RDF_OUT_AREA = L.polygon([
        [12.956500, 80.221472],
        [12.956456, 80.221803],
        [12.956256, 80.221767],
        [12.956281, 80.221444]
    ]);
      
    P5_PL2_RDF_OUT_AREA.bindPopup("P5_PL2_RDF_OUT_AREA");

    polyLayers.push(P5_PL2_RDF_OUT_AREA);

     var P5_CD_outarea = L.polygon([
        [12.956403, 80.219769],
        [12.956241, 80.219752],
        [12.956147, 80.220054],
        [12.956318, 80.220113]
        
    ]);
      
 P5_CD_outarea.bindPopup("P5 C & D Out Area");
 
    polyLayers.push(P5_CD_outarea);


    var P5_PL2_CD_OUT_AREA = L.polygon([
        [12.956256, 80.221767],
        [12.956200, 80.221931],
        [12.955925, 80.221947],
        [12.956017, 80.221672]
        
    ]);
      
    P5_PL2_CD_OUT_AREA.bindPopup("P5_PL2_CD_OUT_AREA");
 
    polyLayers.push(P5_PL2_CD_OUT_AREA);



     var P5_soil_outarea = L.polygon([
        [12.956331, 80.220239],
        [12.956407, 80.220334],
        [12.956261, 80.220742],
        [12.955986, 80.220632],
        [12.956119, 80.220195]
        
    ]);
      
    P5_soil_outarea.bindPopup("P5 Soil Out Area");
 
    polyLayers.push(P5_soil_outarea);

    var P5_PL2_SOIL_OUT_AREA = L.polygon([
        [12.956017, 80.221672],
        [12.955925, 80.221947],
        [12.955631, 80.221942],
        [12.955767, 80.221592]
    ]);
      
    P5_PL2_SOIL_OUT_AREA.bindPopup("P5_PL2_SOIL_OUT_AREA");
 
    polyLayers.push(P5_PL2_SOIL_OUT_AREA);



            var P5_tambaram_disposal_point = L.polygon([
                  [12.940656, 80.084328],
                  [12.942261, 80.084864],
                  [12.940919, 80.088136],
                  [12.939297, 80.087478]
                  
              ]);
                
          P5_tambaram_disposal_point.bindPopup("P5_tambaram_disposal_point");
 
           
              polyLayers.push(P5_tambaram_disposal_point);


                var P5_disposal_point1 = L.polygon([
                  [12.941683, 80.093294],
                  [12.940672, 80.096019],
                  [12.940211, 80.095803],
                  [12.941158, 80.093008]
                  
              ]);
                
   P5_disposal_point1.bindPopup("P5_tambaram_disposal_point1"); 
           
              polyLayers.push(P5_disposal_point1);


             //         var P4_PLANT_AREA = L.polygon([
             //      [12.956594, 80.222047],
             //      [12.956497, 80.223781],
             //      [12.955058, 80.223417],
             //      [12.955283, 80.222247]
                  
             //  ]);
                

             // P4_PLANT_AREA.bindPopup("P4_PLANT_AREA"); 
             //  polyLayers.push(P4_PLANT_AREA);


              //  var P3_PLANT_AREA = L.polygon([
              //     [12.956381, 80.224769],
              //     [12.956356, 80.226300],
              //     [12.954475, 80.226336],
              //     [12.954783, 80.225008]
                  
              // ]);
                

           
              // polyLayers.push(P3_PLANT_AREA);





// ===========================P3 PLANT DETAILS =================================================


 var P3_bridge = L.polygon([
        [12.955878, 80.225075],
        [12.955883, 80.225119],
        [12.955689, 80.225142],
        [12.955686, 80.225081]
       
    ]);



 P3_bridge.setStyle({color: 'red',fillColor: '#c40619'});

   
 polyLayers.push(P3_bridge);

     P3_bridge.bindPopup("P3 Weigh Bridge"); 
            
        var P3_dumpyard = L.polygon([
        [12.958858, 80.223981],
        [12.957986, 80.227086],
        [12.954314, 80.226969],
        [12.954472, 80.226319],
        [12.955917, 80.226306],
        [12.956097, 80.224997],
        [12.954806, 80.225100],
        [12.954958, 80.223978]  
       
    ]);
  P3_dumpyard.bindPopup("P3 Dump Yard"); 

  P3_dumpyard.setStyle({color: 'red',fillColor: '#c40619'});

  polyLayers.push(P3_dumpyard);



      var P3_hopperpoint = L.polygon([
        [12.955517, 80.225200],
        [12.955522, 80.225483],
        [12.955317, 80.225514],
        [12.955319, 80.225203]
        
    ]);
      
    P3_hopperpoint.bindPopup("P3 Hopper"); 

  P3_hopperpoint.setStyle({color: 'red',fillColor: '#c40619'});

    polyLayers.push(P3_hopperpoint);


      var P3_RDF_outarea = L.polygon([
        [12.955811, 80.225772],
        [12.955800, 80.226044],
        [12.955575, 80.226028],
        [12.955611, 80.225767]
        
    ]);
      
    P3_RDF_outarea.bindPopup("P3_RDF_outarea"); 

     P3_RDF_outarea.setStyle({color: 'red',fillColor: '#c40619'});
 
    polyLayers.push(P3_RDF_outarea);


     var P3_CD_outarea = L.polygon([
        [12.955239, 80.225806],
        [12.955228, 80.226072],
        [12.955019, 80.226072],
        [12.955025, 80.225822]
        
    ]);
      
   P3_CD_outarea.bindPopup("P3_CD_outarea"); 

    P3_CD_outarea.setStyle({color: 'red',fillColor: '#c40619'});
 
    polyLayers.push(P3_CD_outarea);


     var P3_soil_outarea = L.polygon([
        [12.955308, 80.225519],
        [12.955297, 80.225222],
        [12.954894, 80.225283],
        [12.954886, 80.225497],
        [12.954883, 80.225744],
        [12.955292, 80.225792]
    ]);
      

    P3_soil_outarea.bindPopup("P3_soil_outarea"); 

     P3_soil_outarea.setStyle({color: 'red',fillColor: '#c40619'});

    polyLayers.push(P3_soil_outarea);


// ===========================P4 PLANT DETAILS =================================================


 var P4_bridge = L.polygon([
        [12.956381, 80.222033],
        [12.956378, 80.222097],
        [12.956111, 80.222100],
        [12.956075, 80.222058]
       
    ]);

 P4_bridge.setStyle({color: 'green',fillColor: '#b2d69a'});

   
 polyLayers.push(P4_bridge);

     P4_bridge.bindPopup("P4 Weigh Bridge"); 
            
        var P4_dumpyard = L.polygon([
        [12.959019, 80.221739],
        [12.959108, 80.222842],
        [12.958728, 80.223981],
        [12.954958, 80.223975],
        [12.955119, 80.223297],
        [12.956456, 80.223517],
        [12.956525, 80.222100]
       
    ]);
  P4_dumpyard.bindPopup("P4 Dump Yard"); 

  P4_dumpyard.setStyle({color: 'green',fillColor: '#b2d69a'});

  polyLayers.push(P4_dumpyard);



      var P4_hopperpoint = L.polygon([
        [12.956061, 80.222164],
        [12.956028, 80.222567],
        [12.955831, 80.222581],
        [12.955764, 80.222211]
        
    ]);
      
    P4_hopperpoint.bindPopup("P4 Hopper"); 

  P4_hopperpoint.setStyle({color: 'green',fillColor: '#b2d69a'});

    polyLayers.push(P4_hopperpoint);


      var P4_RDF_outarea = L.polygon([
        [12.956425, 80.222692],
        [12.956431, 80.223117],
        [12.956161, 80.223144],
        [12.956183, 80.222719]
        
    ]);
      
    P4_RDF_outarea.bindPopup("P4_RDF_outarea"); 

     P4_RDF_outarea.setStyle({color: 'green',fillColor: '#b2d69a'});
 
    polyLayers.push(P4_RDF_outarea);


     var P4_CD_outarea = L.polygon([
        [12.955714, 80.222819],
        [12.955706, 80.223181],
        [12.955467, 80.223208],
        [12.955481, 80.222819]
        
    ]);
      
   P4_CD_outarea.bindPopup("P4_CD_outarea"); 

    P4_CD_outarea.setStyle({color: 'green',fillColor: '#b2d69a'});
 
    polyLayers.push(P4_CD_outarea);


     var P4_soil_outarea = L.polygon([
        [12.955739, 80.222417],
        [12.955719, 80.222781],
        [12.955483, 80.222789],
        [12.955503, 80.222403]
        
    ]);
      

    P4_soil_outarea.bindPopup("P4_soil_outarea"); 

     P4_soil_outarea.setStyle({color: 'green',fillColor: '#b2d69a'});

    polyLayers.push(P4_soil_outarea);



                     var P4_PLANT_AREA = L.polygon([
                  [12.955872, 80.223214],
                  [12.955819, 80.223783],
                  [12.955025, 80.223625],
                  [12.955183, 80.222797]
                  
              ]);
                

             P4_PLANT_AREA.bindPopup("P4_PLANT_AREA"); 
             P4_PLANT_AREA.setStyle({color: 'green',fillColor: '#b2d69a'});

              polyLayers.push(P4_PLANT_AREA);

              
    var KOYAMBEDU_BIO_CNG_SITE = L.polygon([
                  [13.067669, 80.203558],
                  [13.067581, 80.204344],
                  [13.066942, 80.204458],
                  [13.066997, 80.203600]
                  
              ]);
                

             KOYAMBEDU_BIO_CNG_SITE.bindPopup("KOYAMBEDU BIO CNG SITE"); 
             KOYAMBEDU_BIO_CNG_SITE.setStyle({color: 'red',fillColor: '#b2d69a'});

              polyLayers.push(KOYAMBEDU_BIO_CNG_SITE);

  
    // Add the layers to the fg feature group 
    for(layer of polyLayers) {

       fg.addLayer(layer); 

     
    }

}



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
