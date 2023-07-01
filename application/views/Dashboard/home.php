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



		</div>
      </div>
    </div>
    <!-- END: Content-->
   
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

                  var marker;
                   var markers = [];
                   var client_id = <?php echo $this->session->userdata['client_id']; ?>;
                 map = L.map('world-map-markers').setView([11.0467,76.9254],6);

                //  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:16}).addTo(map);
    // L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:20}).addTo(map);
    layer = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
});

$(document).ready(function() {
    $.ajax({
      url: '<?php echo site_url('/Dashboard/get_geofence/'); ?>',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        var marker =  L.marker()
        $.each(data, function(i, item) {
          console.log(item);
         var fence = L.circle([item.Lat, item.Lng], parseInt(item.radius)).addTo(map);
         fence.bindPopup(item.Location_short_name);
        });

      }
    });
  });
  
      var layer = layer.addTo(map)
        var fg = L.featureGroup().addTo(map);
        var assetLayerGroup = new L.LayerGroup();

        $( document ).ready(function() {
    
       update_all_data1();

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

                // var vehicle_sleep =parseInt(data[i].vehicle_sleep);
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
