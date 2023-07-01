<!-- <div class="app-content content"> -->
<!--======graph view styles=======================-->
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
/* .menutop-icon{
    width: unset !important;
    max-width: unset !important;
    height: auto;
    border: 0;
    border-radius: 50%;
}
                                                     */
  </style>
<!--======graph view styles=======================-->
 <?php $this->load->view('Dashboard/user_dashboard/innermenu-vehicle',$data);?>                      
<div class="content-right" style="width: calc(100% - 350px) !important;">
            <div class="email-app-area">
            <div class="tab-content">
              <div class="tab-pane active" id="tab112" role="tabpanel" aria-labelledby="base-tab112">
                  <div class="col-12" style="padding-left: 0px;padding-right: 3px;">
			<div class="card">
                            <ul class="nav nav-tabs nav-topline" role="tablist">
                                    <li class="nav-item">
                                            <a class="nav-link active" id="base-tab21m" data-toggle="tab" aria-controls="tab21m" href="#tab21m" role="tab" aria-selected="true">Map View</a>
                                    </li>
                                    <li class="nav-item">
                                            <a class="nav-link" id="base-tab22" data-toggle="tab" aria-controls="tab22g" href="#tab22g" role="tab" aria-selected="false">Chart</a>
                                    </li>
                                    <li class="nav-item">
                                            <a class="nav-link" id="base-tableview" data-toggle="tab" aria-controls="tableview" href="#tableview" role="tab" aria-selected="false">Table View</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab23analysis" id="base-tab23analysis" data-toggle="tab" aria-controls="tab23analysis" href="#tab23analysis" role="tab" aria-selected="false" hidden>Analysis</a>
                                    </li>
                                    <li class="nav-item" hidden>
                                            <a class="nav-link">Disabled</a>
                                    </li>
                            </ul>
                            <div class="tab-content px-1 pt-1111 border-grey border-lighten-2 border-0-top">
                                <div class="tab-pane active" id="tab21m" role="tabpanel" aria-labelledby="base-tab21m">
                                    <?php $this->load->view('Dashboard/user_dashboard/vehicles-map-view', $data); ?>
                                </div>
                                <div class="tab-pane" id="tab22g" role="tabpanel" aria-labelledby="base-tab22g">
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
                                <div class="tab-pane" id="tab23analysis" role="tabpanel" aria-labelledby="base-tab23analysis">
                                   <?php $this->load->view('Dashboard/user_dashboard/vehicle_analysis'); ?>
                                </div>
                                <div class="tab-pane" id="tableview" role="tabpanel" aria-labelledby="base-tableview">
                                     <?php  $this->load->view('Dashboard/user_dashboard/vehicles-table-view');?>
                                </div>
                            </div>
					
			</div>
		</div>
                
              </div>
            </div>

          </div>
          <script type="text/javascript">
                     $(document).ready(function(){
                          $('#hideleftside').show();
                      $('.tab23analysis').click(function(){
                          $('#hideleftside').hide();
                      });
//----------------------------------------------------------------------
        $(function() { 
    $(".tab23analysis").on('click', function(){
        alert('hai');
   if (!$(this).hasClass("expanded")){
      $(".animate").animate({height: '50px',},"slow");
      $(this).addClass("expanded");
   }
   else {
      $(".animate").animate({height: '100px',},"slow");
      $(this).removeClass("expanded");
   }

});
});

//----------------------------------------------------------------------         

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
//===========================================================================    
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
    //  alert(firstid);
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
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
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
<script type="text/javascript">

                  var marker;
                   var markers = [];
                 map = L.map('single_map').setView([11.0467,76.9254],8);
    L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:16}).addTo(map);

        var fg = L.featureGroup().addTo(map);
        var assetLayerGroup = new L.LayerGroup();
        
     $( document ).ready(function() {
    
    update_all_data();
     setInterval(smooth_move, 10000);

     });   
     function update_all_data() {
      
     var id = $('#selected_vid').val();
    // alert(id);
             $.ajax({
        url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
            $('#vehiclename').empty().append('<h2>'+data.vehiclename+'</h2>');
         // alert(data);
          set_vehicle(data);
          var e_lat = data.lat;
          var e_lng = data.lng;

        },error:function(){
          console.log('error');
        }
      });


         $.ajax({
        url: '<?php echo site_url('/Dashboard/alert_data/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {

       //   alert(data);
          alert_vehicle(data);

        },error:function(){
          console.log('error');
        }
      });


      $.ajax({
        url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {

          //alert(data);
          //console.log(data);
          single_vehicle_route(map,data);
          var e_lat = data.lat;
          var e_lng = data.lng;

        },error:function(){
          console.log('error');
        }
      });
   
     // $('.single_vehicle_status').show();          //Show Single vehicle status
      function single_vehicle_route(map,data)
    {
         $("#pre_lat").empty();
         $("#pre_lng").empty();
          $("#pre_angle").empty();

      if (marker != undefined) {
              map.removeLayer(marker);
            };

        var location_lat = parseFloat(data.lat);
        var location_lng = parseFloat(data.lng);

        var angle=data.angle;

        var v_u_time = parseInt(data.update_time);
        var v_acc_on = parseInt(data.acc_on);
        var v_speed = parseInt(data.speed);

        var vehicle_sleep =parseInt(data.vehicle_sleep);

            if(data.updatedon!=null && data.updatedon!='')
                {
                    if(v_u_time <= 10 && v_u_time!=null)
                    {
                      if(vehicle_sleep==3)
                      {
                        var status_cont = 'PARKING';
                          color='#147fc7';

                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Speed:</b> '+Math.round(data.speed)+' km/hr <br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt  <br/><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'<br></div>';
                      }
                      else if(v_acc_on ==  1)
                      {
                        if(v_speed > 0)
                        {
                          var status_cont = 'MOVING';
                          color='#00a65a';

                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Speed:</b> '+Math.round(data.speed)+' km/hr <br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt  <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'<br></div>';


                        }else{
                          var status_cont = 'IDLE';
                          color='#fabf2c';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                        }
                      }else
                      {
                          var status_cont = 'PARKING';
                          color='#337ab7';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                      }
                    }else
                    {
                       var status_cont = 'GSM Lost';
                       color='#a89e9e';
                       var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                    }
                }else
                {
                    var status_cont = 'GSM Lost';
                       color='#a89e9e';
                        var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                }
             var vehicle_type = parseInt(data.vehicle_type);

                var image_path;
           if(v_u_time <= 10)
                {
                    if(v_acc_on == 1)
                    {
                      if(v_speed >0)
                      {

                         switch(vehicle_type) {//running

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
                       switch(vehicle_type) {//idle

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
                       console.log("vehicle_type parking"+vehicle_type);

                       switch(vehicle_type) {//parking

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
                  console.log("vehicle_type no;"+vehicle_type);

                   switch(vehicle_type) {//no ntwork

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
         
                
var startCoords= [location_lat,location_lng];
//alert(startCoords);
        
          $('#pre_lat').val(location_lat);
          $('#pre_lng').val(location_lng);
           $('#pre_angle').val(angle);

     

     var redIcon = new L.Icon({
          iconUrl: image_path,
          iconSize:  [35, 35],
        });

        


 marker = L.marker(startCoords,{icon: redIcon,rotationAngle: angle}).addTo(map);


        map.addLayer(marker);

        var group =new Array();
       group = new L.featureGroup([marker]);

      map.fitBounds(group.getBounds());

    marker.bindPopup(marker_content).openPopup();

  markers.push(marker); 
   assetLayerGroup.addLayer(markers);

               // get_current_address(location_lat,location_lng);

    }

      


function alert_vehicle(data) {

   // alert(data);
     $('#alertreport').empty();
     for (var i = 0; i < data.length; i++) {
         console.log(data[i].alert_type);
          $('#alertreport').append("<a style='padding: 1px 4px'>"+data[i].alert_type+"<span class='float-right'>"+data[i].createdon+"</span> </a><br>");
     }
    
      
    }
    
     update_status_table();


  }



   function update_status_table(){
            
         

      $.ajax({
        url: '<?php echo site_url('/Dashboard/all_vehicle_loc/');?>',//get current loc of all vehicle from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
          
        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
          
          for (var j = 0; j < data.length; j++) { 
            var v_u_time = parseInt(data[j].update_time);
            console.log(data[j].update_time);
                var v_acc_on = parseInt(data[j].acc_on);
                var v_speed = parseInt(data[j].speed);

                 switch(data[j].vehicle_type) {//get vehicle type

                case '1':
                  var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
                  break;
                case '2':             
                  var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
                  break;
                case '3':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                case '4':
                  var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
                  break;
                case '5':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                default:
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

              }

              var vehicle_sleep =parseInt(data[j].vehicle_sleep);

                if(v_u_time <= 10)
                {
                  if(vehicle_sleep==3)
                  {
                      var image = '<span style="color:#147fc7">'+image_path+'</span>&nbsp;';
                          var status_cont = 'PARKING';
                  }
                  else if(v_acc_on == 1)
                  {
                    if(v_speed >0)
                    {
                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                        {
                           var image = '<span style="color:green">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                          var image = '<span style="color:green">'+image_path+'</span>&nbsp;';
                          var status_cont = 'MOVING';
                        }
                    }else{

                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                        {
                           var image = '<span style="color:#fabf2c">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                           var image ='<span style="color:#fabf2c">'+image_path+'</span>&nbsp;'; 
                          var status_cont = 'IDLE';
                        }
                      
                    }
                  }else
                  {
                    if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                    {
                       var image = '<span style="color:blue">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                    else
                    {
                      var image = '<span style="color:blue">'+image_path+'</span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                     
                  }
                  //alert('hi');
                }else
                {
                     if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                        {
                           var image = '<span style="color:#a89e9e">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                             var image = '<span style="color:#a89e9e">'+image_path+'</span>&nbsp;';
                            var status_cont = 'GSM Lost';
                        }
                 
                }
            var img_cont = image; 

          

            var vehic_upt = 'vehic_upt'+data[j].vehicleid;
            if(data[j].updatedon){var update_valu = data[j].updatedon;}else{var update_valu ='____:__:__ __:__:__';}
            $('#'+vehic_upt).empty().html(update_valu);
            var vehic_status = 'vehic_status'+data[j].vehicleid;
            $('#'+vehic_status).empty().html(img_cont);


            // var tr_row = '<tr class="tr-a vid_val" id="vid_'+data[j].vehicleid+'" onclick="selectone( '+data[j].vehicleid+');"><td class="tdth text-center status_running" id="vehic_status_'+data[j].vehicleid+'">'+img_cont+'</td><td style="text-align: left !important;font-size: 12px;" class="tdth text-center"> <p id="vehic_reg_'+data[j].vehicleid+'" style="margin-bottom:0px">'+data[j].vehiclename+'</p><small id="vehic_upt<'+data[j].vehicleid+'">'+update_valu+'</small> <td><div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown"><div class="btn-group" role="group"> <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="font-size: 10px;"><a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style="padding-left: 10px;"><i class="fa fa-play"></i>&nbsp;Playback</a><a class="dropdown-item" href="component-buttons-extended.html" style="padding-left: 10px;"><i class="fa fa-share-alt"></i>&nbsp; Share position</a></div></div></div></td></tr>';

            // console.log(tr_row);

            //   $('#body-data').append(tr_row);

            var last_off_upt = 'parker_status'+data[j].vehicleid;

            var vehic_reg = 'vehic_reg'+data[j].vehicleid;

            $('#'+vehic_reg).empty().append(data[j].vehiclename);
  
          }
   
        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



        },error:function(){
          console.log('error');
        }
      });
update_status_table3();
 
    }

    function update_status_table3(){
            
         

      $.ajax({
        url: '<?php echo site_url('/Dashboard/all_vehicle_loc/3');?>',//get current loc of all vehicle from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
          
        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
        //  alert(data);
          for (var j = 0; j < data.length; j++) { 
            var v_u_time = parseInt(data[j].update_time);
            console.log(data[j].update_time);
                var v_acc_on = parseInt(data[j].acc_on);
                var v_speed = parseInt(data[j].speed);

                 switch(data[j].vehicle_type) {//get vehicle type

                case '1':
                  var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
                  break;
                case '2':             
                  var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
                  break;
                case '3':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                case '4':
                  var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
                  break;
                case '5':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                default:
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

              }

              var vehicle_sleep =parseInt(data[j].vehicle_sleep);

                if(v_u_time <= 10)
                {
                  if(vehicle_sleep==3)
                  {
                      var image = '<span style="color:#147fc7">'+image_path+'</span>&nbsp;';
                          var status_cont = 'PARKING';
                  }
                  else if(v_acc_on == 1)
                  {
                    if(v_speed >0)
                    {
                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:green">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                          var image = '<span style="color:green">'+image_path+'</span>&nbsp;';
                          var status_cont = 'MOVING';
                        }
                    }else{

                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#fabf2c">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                           var image ='<span style="color:#fabf2c">'+image_path+'</span>&nbsp;'; 
                          var status_cont = 'IDLE';
                        }
                      
                    }
                  }else
                  {
                    if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                    {
                       var image = '<span style="color:blue">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                    else
                    {
                      var image = '<span style="color:blue">'+image_path+'</span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                     
                  }
                  //alert('hi');
                }else
                {
                     if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#a89e9e">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                             var image = '<span style="color:#a89e9e">'+image_path+'</span>&nbsp;';
                            var status_cont = 'GSM Lost';
                        }
                 
                }
            var img_cont = image; 

          

            var vehic_upt = 'vehic_upt3'+data[j].vehicleid;
            if(data[j].updatedon){var update_valu = data[j].updatedon;}else{var update_valu ='____:__:__ __:__:__';}
            $('#'+vehic_upt).empty().html(update_valu);
            var vehic_status = 'vehic_status3'+data[j].vehicleid;
            console.log(vehic_status);
            $('#'+vehic_status).empty().html(img_cont);


            var last_off_upt = 'parker_status3'+data[j].vehicleid;

            var vehic_reg = 'vehic_reg3'+data[j].vehicleid;

            $('#'+vehic_reg).empty().append(data[j].vehiclename);
  
          }
   
        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



        },error:function(){
          console.log('error');
        }
      });

   update_status_table4();
    }
    

    function update_status_table4(){
            
         

      $.ajax({
        url: '<?php echo site_url('/Dashboard/all_vehicle_loc/4');?>',//get current loc of all vehicle from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
          
        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
        //  alert(data);
          for (var j = 0; j < data.length; j++) { 
            var v_u_time = parseInt(data[j].update_time);
            console.log(data[j].update_time);
                var v_acc_on = parseInt(data[j].acc_on);
                var v_speed = parseInt(data[j].speed);

                 switch(data[j].vehicle_type) {//get vehicle type

                case '1':
                  var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
                  break;
                case '2':             
                  var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
                  break;
                case '3':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                case '4':
                  var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
                  break;
                case '5':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                default:
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

              }

              var vehicle_sleep =parseInt(data[j].vehicle_sleep);

                if(v_u_time <= 10)
                {
                  if(vehicle_sleep==3)
                  {
                      var image = '<span style="color:#147fc7">'+image_path+'</span>&nbsp;';
                          var status_cont = 'PARKING';
                  }
                  else if(v_acc_on == 1)
                  {
                    if(v_speed >0)
                    {
                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:green">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                          var image = '<span style="color:green">'+image_path+'</span>&nbsp;';
                          var status_cont = 'MOVING';
                        }
                    }else{

                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#fabf2c">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                           var image ='<span style="color:#fabf2c">'+image_path+'</span>&nbsp;'; 
                          var status_cont = 'IDLE';
                        }
                      
                    }
                  }else
                  {
                    if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                    {
                       var image = '<span style="color:blue">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                    else
                    {
                      var image = '<span style="color:blue">'+image_path+'</span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                     
                  }
                  //alert('hi');
                }else
                {
                     if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#a89e9e">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                             var image = '<span style="color:#a89e9e">'+image_path+'</span>&nbsp;';
                            var status_cont = 'GSM Lost';
                        }
                 
                }
            var img_cont = image; 

          

            var vehic_upt = 'vehic_upt4'+data[j].vehicleid;
            if(data[j].updatedon){var update_valu = data[j].updatedon;}else{var update_valu ='____:__:__ __:__:__';}
            $('#'+vehic_upt).empty().html(update_valu);
            var vehic_status = 'vehic_status4'+data[j].vehicleid;
            console.log(vehic_status);
            $('#'+vehic_status).empty().html(img_cont);


            var last_off_upt = 'parker_status4'+data[j].vehicleid;

            var vehic_reg = 'vehic_reg4'+data[j].vehicleid;

            $('#'+vehic_reg).empty().append(data[j].vehiclename);
  
          }
   
        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



        },error:function(){
          console.log('error');
        }
      });
update_status_table2();
 
    }


    function update_status_table2(){
            
         

      $.ajax({
        url: '<?php echo site_url('/Dashboard/all_vehicle_loc/2');?>',//get current loc of all vehicle from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
          
        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
        //  alert(data);
          for (var j = 0; j < data.length; j++) { 
            var v_u_time = parseInt(data[j].update_time);
            console.log(data[j].update_time);
                var v_acc_on = parseInt(data[j].acc_on);
                var v_speed = parseInt(data[j].speed);

                 switch(data[j].vehicle_type) {//get vehicle type

                case '1':
                  var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
                  break;
                case '2':             
                  var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
                  break;
                case '3':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                case '4':
                  var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
                  break;
                case '5':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                default:
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

              }

              var vehicle_sleep =parseInt(data[j].vehicle_sleep);

                if(v_u_time <= 10)
                {
                  if(vehicle_sleep==3)
                  {
                      var image = '<span style="color:#147fc7">'+image_path+'</span>&nbsp;';
                          var status_cont = 'PARKING';
                  }
                  else if(v_acc_on == 1)
                  {
                    if(v_speed >0)
                    {
                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:green">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                          var image = '<span style="color:green">'+image_path+'</span>&nbsp;';
                          var status_cont = 'MOVING';
                        }
                    }else{

                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#fabf2c">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                           var image ='<span style="color:#fabf2c">'+image_path+'</span>&nbsp;'; 
                          var status_cont = 'IDLE';
                        }
                      
                    }
                  }else
                  {
                    if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                    {
                       var image = '<span style="color:blue">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                    else
                    {
                      var image = '<span style="color:blue">'+image_path+'</span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                     
                  }
                  //alert('hi');
                }else
                {
                     if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#a89e9e">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                             var image = '<span style="color:#a89e9e">'+image_path+'</span>&nbsp;';
                            var status_cont = 'GSM Lost';
                        }
                 
                }
            var img_cont = image; 

          

            var vehic_upt = 'vehic_upt2'+data[j].vehicleid;
            if(data[j].updatedon){var update_valu = data[j].updatedon;}else{var update_valu ='____:__:__ __:__:__';}
            $('#'+vehic_upt).empty().html(update_valu);
            var vehic_status = 'vehic_status2'+data[j].vehicleid;
            console.log(vehic_status);
            $('#'+vehic_status).empty().html(img_cont);


            var last_off_upt = 'parker_status2'+data[j].vehicleid;

            var vehic_reg = 'vehic_reg2'+data[j].vehicleid;

            $('#'+vehic_reg).empty().append(data[j].vehiclename);
  
          }
   
        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



        },error:function(){
          console.log('error');
        }
      });
    

    update_status_table1();
 
    }
     function update_status_table1(){
            
         

      $.ajax({
        url: '<?php echo site_url('/Dashboard/all_vehicle_loc/1');?>',//get current loc of all vehicle from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
          
        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
         // alert(data);
          for (var j = 0; j < data.length; j++) { 
            var v_u_time = parseInt(data[j].update_time);
            console.log(data[j].update_time);
                var v_acc_on = parseInt(data[j].acc_on);
                var v_speed = parseInt(data[j].speed);

                 switch(data[j].vehicle_type) {//get vehicle type

                case '1':
                  var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
                  break;
                case '2':             
                  var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
                  break;
                case '3':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                case '4':
                  var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
                  break;
                case '5':
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                  break;
                default:
                  var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

              }

              var vehicle_sleep =parseInt(data[j].vehicle_sleep);

                if(v_u_time <= 10)
                {
                  if(vehicle_sleep==3)
                  {
                      var image = '<span style="color:#147fc7">'+image_path+'</span>&nbsp;';
                          var status_cont = 'PARKING';
                  }
                  else if(v_acc_on == 1)
                  {
                    if(v_speed >0)
                    {
                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:green">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                          var image = '<span style="color:green">'+image_path+'</span>&nbsp;';
                          var status_cont = 'MOVING';
                        }
                    }else{

                         if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#fabf2c">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                           var image ='<span style="color:#fabf2c">'+image_path+'</span>&nbsp;'; 
                          var status_cont = 'IDLE';
                        }
                      
                    }
                  }else
                  {
                    if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                    {
                       var image = '<span style="color:blue">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                    else
                    {
                      var image = '<span style="color:blue">'+image_path+'</span>&nbsp;'; 
                      var status_cont = 'PARKING';
                    }
                     
                  }
                  //alert('hi');
                }else
                {
                     if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16 )
                        {
                           var image = '<span style="color:#a89e9e">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                           var status_cont = 'MOVING';
                        }
                        else
                        {
                             var image = '<span style="color:#a89e9e">'+image_path+'</span>&nbsp;';
                            var status_cont = 'GSM Lost';
                        }
                 
                }
            var img_cont = image; 

          

            var vehic_upt = 'vehic_upt1'+data[j].vehicleid;
            if(data[j].updatedon){var update_valu = data[j].updatedon;}else{var update_valu ='____:__:__ __:__:__';}
            $('#'+vehic_upt).empty().html(update_valu);
            var vehic_status = 'vehic_status1'+data[j].vehicleid;
            console.log(vehic_status);
            $('#'+vehic_status).empty().html(img_cont);


            var last_off_upt = 'parker_status1'+data[j].vehicleid;

            var vehic_reg = 'vehic_reg1'+data[j].vehicleid;

            $('#'+vehic_reg).empty().append(data[j].vehiclename);
  
          }
   
        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



        },error:function(){
          console.log('error');
        }
      });
    
 
    }

    
 
      function set_vehicle(data)
     {
    //   $(".altloader").addClass('hide');
    //   $('.currentstatus').removeClass('hide');
      var v_ac = data.ac_flag;          //    Ac ON/OFF
      var v_ft = data.litres;           //  FUEL TANK LEVEL
      //alert(v_ft);
      var v_fuel = parseInt(data.fuel_tank_capacity);       //  FUEL LEVEL
      var v_speed = data.speed;         //  SPEED
      var v_no = data.vehiclename;      //  VEHICLE NO
      var v_status = data.acc_on;         //  VEHICLE STATUS ON/OFF
      var v_km = data.kilometer;          //  KILOMETER
      var v_odometer = data.odometer;           //  ODOMETER
      var v_temp = data.temperature;          //  TEMPERATURE
      var v_battery = data.car_battery;           //  CAR BATTERY
      var v_dv_battery = data.device_battery;       //  DEVICE BATTERY
      var v_charge_status = data.device_charge_status;
      var driver_name=data.driver_name;

      var hourmeter = data.hourmeter;
      var today_hourmeter = data.today_hourmeter;
      
      $("#auto_speed").empty().append(Math.round(v_speed)+' KM');
       $("#progress_speed").empty().append("<div class='progress-bar bg-success' role='progressbar' style='width: "+Math.round(v_speed)+"%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>");

      if(hourmeter != '' && hourmeter != null)
      {
          var hourmeter = parseFloat(hourmeter);
          $("#hourmeter").empty().append(hourmeter.toFixed(1));
      }else{
        $("#hourmeter").empty().append('0');
      }

      if(v_ft != '' && v_ft != null && v_ft > 0)
      {
          var hourmeter = parseFloat(v_ft);
          $("#fuel_ltr").empty().append(v_ft.toFixed(1)+'/'+v_fuel+' ltrs');
      }else{
        $("#fuel_ltr").empty().append('0');
      }

      



      if(today_hourmeter != '' && today_hourmeter != null)
      {
          var today_hourmeter = parseFloat(today_hourmeter);
          $("#today_hm").empty().append(today_hourmeter.toFixed(1));
      }else{
        $("#today_hm").empty().append('0');
      }

      var internal_battery_voltage = data.internal_battery_voltage;

      var real_odo=data.real_odo+" KM";

       var today_km = data.today_km;   
      
     if(today_km != '' && today_km != null && today_km > 0){
          var today_km = parseFloat(today_km);
        $("#today_km").empty().append(today_km.toFixed(2)+' KM');
      }else{
        $("#today_km").empty().append('0');
      }
      
      if(v_ac == '1'){            //AC ON - CHANGE TO GREEN
        $("#ac_status").empty().append('<b>ON</>');
      }else if(v_ac == '0' || v_ac == ''){        //AC - OFF CHANGE TO RED
        $("#ac_status").empty().append('<b>OFF</b>');
      }
//console.log(data.mdvr_terminal_no);
//alert(data.mdvr_terminal_no);
      if(data.mdvr_terminal_no!=0 && data.mdvr_terminal_no!=null)
      {
         $('.mdvr_terminal_no').removeClass('hidden');
      
         var mdvr_url="http://52.27.39.152/808gps/open/player/video.html?account=nexvision&password=000000&vehiIdno="+data.mdvr_terminal_no+"&lang=en";
         $("#mdvr_terminal_no").empty().append('<a target="_blank" href="'+mdvr_url+'">Click Here</a>');
      }

     

      $("#vehicleNo").empty().append(data.vehiclename);

      $("#eta").empty().append(data.hub_ETA);

      $("#dte").empty().append(data.DTE+" KM");

       $("#driver_name").empty().append(data.driver_name);

      
           if(data.device_config_type==2)
            {
              $("#real_odo").empty().append(real_odo);
              $("#engine_speed").empty().append(data.engine_speed);
              $("#coolant_level").empty().append(data.coolant_level);

              $("#engine_load").empty().append(data.engine_load);

              $("#coolant_temperature").empty().append(data.coolant_temperature);

              $("#lut").empty().append(data.lut);
               $(".odo_data").hide();
                $(".real_odo").show();
            }
            else
            {
              $(".real_odo").hide();
            }

      if(v_status == 1 && v_speed >0){
        $("#vehicle_status").empty().append('<b>MOVING</>');
      }else if(v_status == '1' && v_speed <= 0){
        $("#vehicle_status").empty().append('<b>ON</>');
      }
      else if(v_status == '0' || v_status == ''){
        $("#vehicle_status").empty().append('<b>OFF</b>');
      }

      if(v_km != ''){
          var val_km = parseFloat(v_km);
        $("#kilometer").empty().append(val_km.toFixed(2));
      }else{
        $("#kilometer").empty().append('0');
      }

      
      if(v_odometer != ''){
          var v_odometer = parseFloat(v_odometer);
          //alert(v_odometer);
        $("#odometer").empty().append(v_odometer.toFixed(2));
      }else{
        $("#odometer").empty().append('0');
      }
      
      
      if(v_ft == ''){
        v_ft = '250';//IF FUEL TANK CAPACITY IS NOT GIVEN DEFAULT  250 LTR
      }
      if(v_battery || v_dv_battery || v_charge_status)
      {
        

        if(v_dv_battery !='0' || v_charge_status !='0' || v_dv_battery !='' || v_charge_status !='')
        {


          $("#devicebattery").empty().append(parseFloat(v_dv_battery).toFixed(2)+" %");

          $("#car_battery").empty().append(parseFloat(v_battery).toFixed(2)+" Volt");

        }
        else
        {

          $("#db_img").hide();$("#db_img_v").hide();$("#cb_img").show();$("#cb_img_v").show();

          $("#car_battery").empty().append(parseFloat(v_battery).toFixed(2)+" Volt");
        }
      }
      else
      {

        $("#car_battery").empty().append("N/A");$("#db_img").show();$("#db_img_v").show(); $("#cb_img").show();$("#cb_img_v").show();

        $("#devicebattery").empty().append("N/A");

     

      }


      if(internal_battery_voltage!=null && internal_battery_voltage!='0' && internal_battery_voltage!='')
      {
        $("#internal_battery_voltage").empty().append(parseFloat(internal_battery_voltage).toFixed(2)+" Volt");
      }
      else
      {
            $("#internal_battery_voltage").empty().append("N/A");
      }

          $("#max-fuel").empty().append(v_ft+"/"+v_fuel);
            if(data.update_time <= 10)
            {
               

            if(data.last_dur){

              var last_off = data.last_dur;

              var tims_len = last_off.length;

           
              var last_off_new;
            

              if(tims_len < 9){

                  var hrs = last_off.substring(0,2);

                  var mins = last_off.substring(3,5);

                  var secs = last_off.substring(6,8);
                
                  if(parseInt(hrs) == 0){

                    last_off_new = mins+' <b>mins</b> '+secs+' <b>sec</b>';

                  }else{

                    if(parseInt(hrs) > 24){

                        hrs = parseInt(hrs);

                        hrs = hrs / 24;

                        var day = parseInt(hrs);

                        last_off_new = day+' <b>Day</b> ';

                    }else{

                        last_off_new = parseInt(hrs)+' <b>hrs</b> '+mins+' <b>mins</b> '+secs+' <b>sec</b>';
                    }
                  
                  
                  }
                 console.log(last_off_new);

              }else{

                  var hrs = last_off.substring(0,3);

                  hrs = parseInt(hrs);

                  hrs = hrs / 24;

                  var day = parseInt(hrs);

                  last_off_new = day+' <b>Day</b> ';
              }
              
            }else
            { 

              var last_off ='__:__:__';  
  
              var last_off_new = '---';

            }

        }
            else
            {
             // alert(data.no_last_dur);
              if(data.no_last_dur){

              var last_off = data.no_last_dur;

              var tims_len = last_off.length;

            
              var last_off_new;
            

                      if(tims_len < 9){

                          var hrs = last_off.substring(0,2);

                          var mins = last_off.substring(3,5);

                          var secs = last_off.substring(6,8);
                        
                          if(parseInt(hrs) == 0){

                            last_off_new = mins+' <b>mins</b> '+secs+' <b>sec</b>';

                          }else{

                            if(parseInt(hrs) > 24){

                                hrs = parseInt(hrs);

                                hrs = hrs / 24;

                                var day = parseInt(hrs);

                                last_off_new = day+' <b>Day</b> ';

                            }else{

                                last_off_new = parseInt(hrs)+' <b>hrs</b> '+mins+' <b>mins</b> '+secs+' <b>sec</b>';
                            }
                          
                          
                          }
                        

                      }
                  else{

                      var hrs = last_off.substring(0,3);

                      hrs = parseInt(hrs);

                      hrs = hrs / 24;

                      var day = parseInt(hrs);

                      last_off_new = day+' <b>Day</b> ';
                  }
                  
            }
            else
            { 

              var last_off ='__:__:__';  
  
              var last_off_new = '---';

            }
            }
              console.log(data.latlon_address);
             $("#onduration").empty().append(last_off_new);
              $("#address").empty().append(data.latlon_address);
                $("#altitute").empty().append(data.altitude);
               $("#gpssignal").empty().append(data.gpssignal);
                 $("#gsmsignal").empty().append(data.gsmsignal);
              

    }


       //Moving The vehicle 


             function smooth_move(){

               
    
                  update_status_table();

          
       var id = $('#selected_vid').val();

  $.ajax({
        url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {

          //alert(data);
          single_vehicle_route1(map,data);
          var e_lat = data.lat;
          var e_lng = data.lng;

        },error:function(){
          console.log('error');
        }
      });



         $.ajax({
        url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {

         // alert(data);
          set_vehicle(data);
          var e_lat = data.lat;
          var e_lng = data.lng;

        },error:function(){
          console.log('error');
        }
      });

       
         
    }



         function single_vehicle_route1(map,data)
    {
        

      if (marker != undefined) {
              map.removeLayer(marker);
            };

        var location_lat = parseFloat(data.lat);
        var location_lng = parseFloat(data.lng);

        var angle=data.angle;

        var v_u_time = parseInt(data.update_time);
        var v_acc_on = parseInt(data.acc_on);
        var v_speed = parseInt(data.speed);

        var vehicle_sleep =parseInt(data.vehicle_sleep);

            if(data.updatedon!=null && data.updatedon!='')
                {
                    if(v_u_time <= 10 && v_u_time!=null)
                    {
                      if(vehicle_sleep==3)
                      {
                        var status_cont = 'PARKING';
                          color='#147fc7';

                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Speed:</b> '+Math.round(data.speed)+' km/hr <br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt  <br/><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'<br></div>';
                      }
                      else if(v_acc_on ==  1)
                      {
                        if(v_speed > 0)
                        {
                          var status_cont = 'MOVING';
                          color='#00a65a';

                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Speed:</b> '+Math.round(data.speed)+' km/hr <br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt  <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'<br></div>';


                        }else{
                          var status_cont = 'IDLE';
                          color='#fabf2c';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                        }
                      }else
                      {
                          var status_cont = 'PARKING';
                          color='#337ab7';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                      }
                    }else
                    {
                       var status_cont = 'GSM Lost';
                       color='#a89e9e';
                       var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                    }
                }else
                {
                    var status_cont = 'GSM Lost';
                       color='#a89e9e';
                        var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+parseFloat(data.car_battery).toFixed(2)+' volt <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                }
 var vehicle_type = parseInt(data.vehicle_type);

                var image_path;
           if(v_u_time <= 10)
                {
                    if(v_acc_on == 1)
                    {
                      if(v_speed >0)
                      {

                         switch(vehicle_type) {//running

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
                       switch(vehicle_type) {//idle

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
                       console.log("vehicle_type parking"+vehicle_type);

                       switch(vehicle_type) {//parking

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
                  console.log("vehicle_type no;"+vehicle_type);

                   switch(vehicle_type) {//no ntwork

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
         
                
var startCoords= [location_lat,location_lng];


      var  pre_lat= $('#pre_lat').val();
      var pre_lng = $('#pre_lng').val();
      var pre_angle = $('#pre_angle').val();

      var pre_latlng1 = [parseFloat(pre_lat),parseFloat(pre_lng)];
       console.log(pre_latlng1);


var redIcon = new L.Icon({
          iconUrl: image_path,
          iconSize:  [35, 35],
        });

          


            marker = L.marker(pre_latlng1,{icon: redIcon,rotationAngle: angle}).addTo(map);


        map.addLayer(marker);

        var group =new Array();
       group = new L.featureGroup([marker]);

      map.fitBounds(group.getBounds());

    marker.bindPopup(marker_content).openPopup();

        $('#pre_lat').empty().val(location_lat);
        $('#pre_lng').empty().val(location_lng);
         $('#pre_angle').empty().val(angle);


   markers.push(marker); 
   assetLayerGroup.addLayer(markers);


    if(v_acc_on == 1)
                    {
                      if(v_speed >0)
                      {

        marker.slideTo(startCoords,{rotationAngle:angle,duration:20000, keepAtCenter: true});

      }
    }


               // get_current_address(location_lat,location_lng);

    }
        

  


      
</script>
    <script type="text/javascript">
              $( document ).ready(function() {
                $('#example').DataTable();
                });
   
//=====================================================================================================       
       
            </script>   