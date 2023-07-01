   
<?php 
      $data['vehicle_details']=$vehicle_details;
      $data['moving_vehicle']=$moving_vehicle;
      $data['idle_vehicle']=$idle_vehicle;
      $data['parking_vehicle']=$parking_vehicle;
      $data['ooc_vehicle']=$ooc_vehicle;
?>
   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/osm/leaflet.css"/>
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
/*.datacards-content:first-child {
  margin-left: 1rem;
}*/
.datacards-content:last-child {
  margin-right: 1rem;
}
.menutop-icon{
    width: unset !important;
    max-width: unset !important;
    height: auto;
    border: 0;
    border-radius: 50%;
}
                                                    
  </style>

    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

        <div class="app-content content" style="margin: 0px;margin-left:-15px">
        
             <?php 
             
              $this->load->view('Dashboard/user_dashboard/innermenu-vehicle',$data);?>
            
<div class="content-right" style="width: calc(100% - 350px) !important;">
            <div class="content-overlay"></div>
            <div class="content-wrapper" style="padding: 5px 0px 0px 18px;">
            <div class="email-app-area">
            <div class="tab-content">
              <div class="tab-pane " id="tab2" role="tabpanel" aria-labelledby="base-tab1">
                <div class="iframe-container">
                   <?php  $this->load->view('Dashboard/user_dashboard/vehicles-table-view');?>
                </div>
              </div>
              <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                <?php $this->load->view('Dashboard/user_dashboard/vehicles-map-view',$data);?>
              </div>
              
               <div class="tab-pane " id="tab3" role="tabpanel" aria-labelledby="base-tab1">
                <div class="iframe-container">
                   <div class="content-body">
                    <!-- email app overlay -->
                    <div class="app-content-overlay"></div>
                    <div class="row match-height">
                        <div class="col-xl-4 col-lg-12" style="padding: 23px;">
                            <div class="card" style="height: 270px;">                              
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/32.png" alt="Card image cap" style="padding-left: 35px">
                                     <div class="card-body" style="background: #faa71a;">
                                        <a href="<?php echo site_url() ?>report/genericreport" class="card-link" style="color:white !important">Generic Reports</a>
                                        <!--<a href="#" class="card-link">Another link</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12" style="padding: 20px;">
                            <div class="card" style="height: 270px;">                                 
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/31.png" alt="Card image cap" style="padding-left: 35px">
                                    <div class="card-body" style="background: #ed1e24;">
                                        <a href="" onClick="executivereport();" data-backdrop="false" data-toggle="modal" class="card-link" style="color:white !important">Executive Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12" style="padding: 20px;">
                            <div class="card" style="height: 270px;">                                
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/30.png" alt="Card image cap" style="padding-left: 35px">
                                    <div class="card-body" style="background: #0064a0;">
                                        <a href="" onClick="smartreport();" data-backdrop="false" data-toggle="modal" class="card-link" style="color:white !important">Smart Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
              </div>
               <div class="tab-pane " id="tab4" role="tabpanel" aria-labelledby="base-tab4">
                <div class="iframe-container">
                   <div class="content-body">
                    <div class="col-md-5 m-auto">
                        <!-- Mixed Line Column Area Start -->
                        <div class="bg-gradient-x-success box-bordershado card">
                            <div class="card-body">                                
                                <div id="vehiclename" style="color:white"></div>
                             
                            </div>
                        </div>
                        <!-- mixed Line Column Area end -->
                        
                    </div>
                       <div id="mixed-line-column-area-chart">
                           
                       </div>

                       <section class="charts-apexcharts">
    <div class="row">
        <div class="col-12 col-md-6">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Parking Chart</div>
                    <div id="parking-basic-chart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
        <div class="col-12 col-md-6">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Distance Chart</div>
                    <div id="distance-basic-chart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
        <div class="col-12 col-md-6">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Idle Chart</div>
                    <div id="idle-basic-chart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
        <div class="col-12 col-md-6">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Trip Chart</div>
                    <div id="trip-basic-chart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
        <div class="col-12 col-md-6">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Fuel Consumed</div>
                    <div id="fuelconsume-basic-chart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
        <div class="col-12 col-md-6">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Fuel Refill</div>
                    <div id="fuelrefill-basic-chart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
        <div class="col-12 col-md-6">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Fuel Drain</div>
                    <div id="fueldrain-basic-chart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
        <div class="col-12">
            <!-- Column Basic Chart Start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">RPM</div>
                    <div id="rpmchart"></div>
                </div>
            </div>
            <!-- column basic chart end -->
        </div>
    </div>
                           
</section>
                </div>
                </div>
              </div>
                
          <div class="tab-pane " id="tab5" role="tabpanel" aria-labelledby="base-tab5">
                <div class="iframe-container">
                   <div class="content-body">
                    <!-- email app overlay -->
                    <form method="post" target="_blank" action="<?= base_url(); ?>dashboard/workspace_details" id="workspaceform" class="form-horizontal form-simple" novalidate enctype="multipart/form-data">
                    <div class="app-content-overlay">
                        
                         <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="basicInput">&emsp;&emsp;Start Date</label>
                                        <input type="date" class="form-control lastsevenDate inmnu_date" id="basicInput" name="from_Date">
                                    </fieldset>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12" style="margin-left: -20px;">
                                    <fieldset class="form-group">
                                        <label for="helpInputTop">End Date</label>
                                        <input type="date" class="form-control endsevenDate inmnu_date" id="helpInputTop" name="to_Date">
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-xl-6 col-md-6 col-lg-12" style="padding: 23px;">
                            <div class="card1" style="height: 270px;">                              
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/06.jpg" width="361px" alt="Card image cap">
                                    <div class="card-body" style="padding: 7px 10px !important;">
                                        <a href="<?php echo base_url() ?>report/genericreport" class="graphanalysis">Track</a>
                                        <!--<a href="#" class="card-link">Another link</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-md-6 col-lg-12" style="padding: 23px;">
                            
                            <div class="card" style="height: 270px;">                              
                                <div class="card-content">
                                    <span style="position: absolute;margin: 120px -95px;"> <i class="fa fa-plus fa-2x"></i></span>
                                    <div class="card-body" style="padding-top: 50px">
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="location" checked> Location                                            
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                            <input type="radio" name="workspace" value="fuelrefueling"> Refueling and Draining                                            
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                            <input type="radio" name="workspace" value="fuelvolume"> Fuel Volume                                           
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                            <input type="radio" name="workspace" value="speed"> Speed                                           
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="movement"> Movement                                           
                                            </label>
                                        </fieldset>
                                        <div>
                                            <input type="submit" class="btn btn-primary btn-xs" value="Submit">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
              </div>
          
                
            </div>

          </div>



                   
            </div>
        </div>            
            
        </div>
    <?php   $this->load->view('reports/popup_report/executive_report',$data); ?>
    <?php   $this->load->view('reports/popup_report/smart_report'); ?>
<script src="<?php echo base_url(); ?>app-assets/vendors/js/charts/apexcharts/apexcharts.min.js"></script>
<!--<script src="<?= base_url(); ?>app-assets/js/scripts/charts/apexcharts/charts-apexcharts.min.js"></script>-->
    
               <script type="text/javascript">
                     $(document).ready(function(){
                      

                $("input[type='button']").click(function(){
        	var radioValue = $("input[name='workspace']:checked").val();
                    if(radioValue){
                        $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/trackplusworkspace'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : 3,
                                'radioValue' : radioValue,
                            },
                        success: function(data){
                            var obj = JSON.parse(data);
                            window.location.href = 'drilldown.html';
                            }
                });
                    }else{
                    alert('please select any one');
                    }
        });
    });
// =================================================================================
                    function executivereport()
                    {
                        jQuery('#executive_reports').modal('show');
                    }
                    function smartreport()
                    {
                        jQuery('#smart_report').modal('show');
                    }
              $( document ).ready(function() {
                $('#example').DataTable();
                });
    var $primary="#00b5b8",$secondary="#2c3648",$success="#0f8e67",$info="#179bad",$warning="#ffb997",$danger="#ff8f9e",
        $themeColor=[$primary,$success,$warning,$info,$danger,$secondary];
//=====================================================================================================       
       
            </script>     
<script>
     $(document).ready(function() {
        update_graph();
         
         });
//=============================================================================      
         
        
        function update_graph() {
           
      var firstid =  $('#selected_vid').val();
      //alert(firstid);
//======================================================================        
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_distance_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' :firstid},
                        success: function(data){
                          //  alert(data);
                            var obj = JSON.parse(data);
                             $("#distance-basic-chart").empty();
                            graph_distance(obj);
                           
                            }
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_parking_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                            var obj = JSON.parse(data);
                             $("#parking-basic-chart").empty();
                            graph_parking(obj);
                            
                            }
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_idle_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                            var obj = JSON.parse(data);
                       $("#idle-basic-chart").empty();
                            graph_idle(obj);
                            }
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_trip_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                            var obj = JSON.parse(data);
                             $("#trip-basic-chart").empty();
                            graph_trip(obj);
                            }
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_mixed_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                            var obj = JSON.parse(data);
                           // alert(data);
                            graph_mixed(obj);
                            }
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/engine_rpm_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                           // alert(data);
                            var obj = JSON.parse(data);
                            $('#rpmchart').empty();
                            graph_enginerpm(obj);
                            }
                });

            }
        
// ===========================================================================   
function graph_enginerpm(obj){
    var total = obj.length;
    var enginerpmData = [];
    for(var i=0;i<total;i++){
        enginerpmData[i] = [obj[i].modified_date,obj[i].firstval];
    }   
    console.log(enginerpmData);
    
      var options = {
          series: [
              {
          name: 'Line',
          type: 'line',
          data:enginerpmData
        }],
          chart: {
          height: 350,
          type: 'line',
        },
        fill: {
          type:'solid',
        },
        markers: {
          size: [6, 0]
        },
        tooltip: {
          shared: false,
          intersect: true,
        },
        legend: {
          show: false
        },
        xaxis: {
          type: 'datetime',
//          min: 0,
//          max: 12,
//          tickAmount: 12
        }
        };

        var chart = new ApexCharts(document.querySelector("#rpmchart"), options);
        chart.render();
        
        
// areaSplineChart={
//            chart:{height:350,type:"area"},
//            dataLabels:{enabled:!1},
//            stroke:{curve:"smooth",colors:$themeColor},
//            series:[
////                {name:"series1",data:[31,40,28,51,42,109,100]},
//                {name:"series2",data:[11,32,45,32,34,52,41]}
//            ],
////            series:[
////                {name:"series1",data:[31,40,28,51,42,109,100]},
//                {name:"series2",data:enginerpmData}
////            ],
//            xaxis:{type:"datetime",
//            categories:["2018-09-19T00:00:00",
//                "2018-09-19T01:30:00",
//                "2018-09-19T02:30:00",
//                "2018-09-19T03:30:00",
//                "2018-09-19T04:30:00",
//                "2018-09-19T05:30:00",
//                "2018-09-19T06:30:00"]
//        },
//            tooltip:{x:{format:"dd/MM/yy HH:mm"}}
//        },
//
//    area_spline_chart=new ApexCharts(document.querySelector("#rpmchart"),areaSplineChart);
//        area_spline_chart.render();
//        ==================================================
//        lineBasicChart={
//            chart:{height:350,type:"line",zoom:{enabled:!1}},
//            series:[
//                {name:"Desktops",data:enginerpmData}
////        {name:"Distance",type:"line",data: enginerpmData}    
//        ],
//            dataLabels:{enabled:1},
//            stroke:{curve:"straight",colors:$themeColor},
//            title:{text:"Product Trends by Month",align:"left"},
//            grid:{row:{colors:["#f3f3f3","transparent"],opacity:.5}},
//             xaxis: {
//                type: 'datetime'
//                },
//        },        
//                
//line_basic_chart=new ApexCharts(document.querySelector("#rpmchart"),lineBasicChart);
//line_basic_chart.render();
}
// ===========================================================================   
function graph_mixed(obj){

    $('#mixed-line-column-area-chart').empty();
    var total = obj.length;
    var speedsData = [];
    var fuelssData = [];
    var distancesData = [];
    var cal_distance=null;
    var set_dis=0;
    var trl_distance;
    var mixed_line_column_area_chart = null;
    if(mixed_line_column_area_chart!=null)
    {
        alert('hi');
        mixed_line_column_area_chart.destroy();
    }

    for(var i=0;i<total;i++){
        speedsData[i] = [obj[i].modified_date,obj[i].speed];
        fuelssData[i] = [obj[i].modified_date,obj[i].litres];
        if(cal_distance){
            if(obj[i].odometer !='0')
            {
                  trl_distance = parseInt(obj[i].odometer) - cal_distance;
                          set_dis = parseInt(set_dis) + parseInt(trl_distance);
            }
          }
            cal_distance = parseInt(obj[i].odometer);
           distancesData[i] = [obj[i].modified_date,set_dis];
    }   
//    console.log(obj);
      var $primary="#48b04f",$secondary="#e62c0b",$success="#f50a0a",$info="#179bad",$warning="#3524f0",$danger="#ff8f9e",
        $themeColor=[$primary,$success,$warning,$info,$danger,$secondary],
         mixedLineColumnAreaChart={
            chart:{height:350,type:"line",stacked:!1},
    stroke:{width:[2,5,6],curve:"smooth"},
    plotOptions:{bar:{columnWidth:"50%"}},
    colors:$themeColor,
    series: [
                 {name:"Speed",type:"area",data: speedsData},        
                 {name:"Fuel",type:"line",data: fuelssData},        
                 {name:"Distance",type:"line",data: distancesData},        
        ],
    fill:{
        // opacity:[.85,.1,1],
        gradient:{inverseColors:!1,shade:"light",type:"vertical",opacityFrom:.85,opacityTo:.55,stops:[0,100,100,100]}
        },
    markers:{size:0},
    xaxis:{type:"datetime"},
    annotations: {
            xaxis: [
          {
            x: new Date('2021-10-14 07:00:00').getTime(),
            x2: new Date('2021-10-14 08:00:00').getTime(),
            fillColor: '#B3F7CA',
            label: {
              text: 'ON / OFF'
            }
          }
        ]
    },
    yaxis:{min:0}, 
    tooltip: {
        shared:!0,intersect:!1,
          y: [
            {
              title: {
                formatter: function (e) {
                  return e + " (Km/h"
                }
              }
            },
            {
              title: {
                formatter: function (e) {
                  return e + " ltr"
                }
              }
            },
            {
              title: {
                formatter: function (e) {
//                  return e;
                return e + " Km"
                }
              }
            }
          ]
        },
        
//    tooltip:{shared:!0,intersect:!1,y:{formatter:function(e){return void 0!==e?e.toFixed(0)+" ":e}}},
    legend:{labels:{useSeriesColors:!0},
        markers:{customHTML:[function(){return""},function(){return""},function(){return""}]}}},
mixed_line_column_area_chart=new ApexCharts(document.querySelector("#mixed-line-column-area-chart"),mixedLineColumnAreaChart);
mixed_line_column_area_chart.render();
   
}
// ===========================================================================   
function graph_trip(obj){
    var total = obj.length;
    var tripData = [];
    for(var i=0;i<total;i++){
        tripData[i] = [obj[i].date,obj[i].minis];
    }   
    console.log(tripData);
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Trip",
                data: tripData
            },        
        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Time "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Hours"}}},
            fill: {
                colors: ['#24ba11']
                },
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#trip-basic-chart"),columnBasicChart);
column_basic_chart.render();
}
// ===========================================================================   
function graph_idle(obj){
    var total = obj.length;
    var idleData = [];
    for(var i=0;i<total;i++){
   idleData[i] = [obj[i].date,obj[i].idle_minitues];
    }   
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Idle",
                data: idleData
            },        
        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Time "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Hours"}}},
            fill: {
                colors: ['#d6ce09']
                },
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#idle-basic-chart"),columnBasicChart);
column_basic_chart.render();
}
// ===========================================================================   
  function graph_parking(obj){
    var total = obj.length;
    var parkingData = [];
    for(var i=0;i<total;i++){
        parkingData[i] = [obj[i].date,obj[i].park_minitues];
    }   
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"35%"}},
//            dataLabels:{enabled:!0},
            dataLabels:{position: 'bottom'},
            
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Parking",
                data: parkingData
            },        
        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Time "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Hours"}}},
            fill: {colors: ['#0c36aa']},
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#parking-basic-chart"),columnBasicChart);
column_basic_chart.render();
}
//============================================================
</script>

<script>
     function graph_distance(obj){
    var total = obj.length;
    var distanceData = [];
    for(var i=0;i<total;i++){
   distanceData[i] = [obj[i].date,obj[i].distance_km];
    }
//    console.log(distanceData);    
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%",endingShape:"rounded"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Distance",
                data: distanceData
            },
//                 {
//                name: "Nelson",
//                data: distanceData
//            }
        
        ],
                xaxis: {
                type: 'datetime'
                },
//            series:[
//                {name:"Running",data:[44,55,57,56,61,58,63,60,66]},
//                {name:"Idle",data:[76,85,101,98,87,105,91,114,94]},
//                {name:"Parking",data:[35,41,36,26,45,48,52,53,41]}
//        ],
//            xaxis:{categories:["Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct"]},
            yaxis:{title:{text:"Kilometer "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Kilometer"}}},
             fill: {colors: ['#11a3c2']},
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#distance-basic-chart"),columnBasicChart);
column_basic_chart.render();

}
</script>
