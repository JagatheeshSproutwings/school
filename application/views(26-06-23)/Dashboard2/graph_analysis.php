
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
            <section class="inline-radio">
  <div class="row match-height">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-content collapse show">
          <div class="card-body">
            <div class="d-inline-block custom-control custom-radio mr-1">
              <input type="radio" class="custom-control-input" name="colorRadio" id="radio1">
              <label class="custom-control-label" for="radio1">Fuel Analysis</label>
            </div>
            <div class="d-inline-block custom-control custom-radio mr-1">
              <input type="radio" class="custom-control-input" name="colorRadio" id="radio2">
              <label class="custom-control-label" for="radio2">Temperature Analysis</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--=======================================================================================-->            
            <section class="basic-elements" id="fuelanalysis">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Fuel Analysis</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                        <div class="text-bold-600 font-medium-2">
                            Select Vechile Number
                        </div>
                        <select name="vehicles" id="vehicles" class="select2 form-control">
                            <?php foreach ($vehicle_details as $list) { ?>
                           <option value="<?php echo $list->vehicleid;?>"><?php echo $list->vehiclename;?></option>
                       <?php   } ?>
                        </select>
                    </div>
                            </div>
                            <div class="col-3">
                                 <fieldset class="form-group">
                                <label for="basicInput">Start Date</label>
                                <input type="datetime-local" class="form-control startLocalDate" id="startLocalDate" name="fromdate">
                            </fieldset>
                            </div>
                            <div class="col-3">
                                <fieldset class="form-group">
                                <label for="helpInputTop">End Date</label>
                                <input type="datetime-local" class="form-control endLocalDate" id="endLocalDate" name="todate">
                               
                            </fieldset>
                            </div>
                            <div class="col-3">
                                <fieldset class="form-group">
                                    <label for="helpInputTop">&nbsp;</label>
                                <button type="submit" id="sumbit_data" class="form-control btn btn-outline-warning">Submit</button>
                            </fieldset>
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Fuel Charts</h4>
                </div>
               <div class="card-content collapse show">
                    <div class="card-body">
                       <div class="bg-gradient-x-success box-bordershado card">
                            <div class="card-body">                                
                                <div id="vehiclename" style="color:white"></div>
                             
                            </div>
                        </div>
                        <div id="mixed-line-column-area-chart"></div>

                        
               <!--    <div class="chart-container" style="height:2500px">
                            <canvas id="column-stacked"></canvas>
                        </div> -->
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================Temperature graph======================-->
<section class="basic-elements" id="temperatureanalysis">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Temperature</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                        <div class="text-bold-600 font-medium-2">
                            Select Vechile Number
                        </div>
                        <select name="vehicles" id="vehicles" class="select2 form-control">
                            <?php foreach ($vehicle_temperature as $list) { ?>
                           <option value="<?php echo $list->vehicleid;?>"><?php echo $list->vehiclename;?></option>
                       <?php   } ?>
                        </select>
                    </div>
                            </div>
                            <div class="col-3">
                                 <fieldset class="form-group">
                                <label for="basicInput">Start Date</label>
                                <input type="datetime-local" class="form-control startLocalDate" id="startLocalDate" name="fromdate">
                            </fieldset>
                            </div>
                           <div class="col-3">
                                <fieldset class="form-group">
                                <label for="helpInputTop">End Date</label>
                                <input type="datetime-local" class="form-control endLocalDate" id="endLocalDate" name="todate">
                               
                            </fieldset>
                            </div>
                            <div class="col-3">
                                <fieldset class="form-group">
                                    <label for="helpInputTop">&nbsp;</label>
                                <button type="submit" id="sumbit_tempdata" class="form-control btn btn-outline-warning">Submit</button>
                            </fieldset>
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Temperature Charts</h4>
                </div>
               <div class="card-content collapse show">
                    <div class="card-body">
                       <div class="bg-gradient-x-success box-bordershado card">
                            <div class="card-body">                                
                                <div id="vehiclename" style="color:white"></div>
                             
                            </div>
                        </div>
                        <div id="mixed-line-column-area-chart-temp"></div>

                        
               <!--    <div class="chart-container" style="height:2500px">
                            <canvas id="column-stacked"></canvas>
                        </div> -->
						
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
<!--========================================================-->
        
		</div>
      </div>
    </div>
    <!-- END: Content-->


    <script>
         $(document).ready(function() {    
             $('#fuelanalysis').hide();
             $('#temperatureanalysis').hide();
$("input:radio").on('click', function() {
    if ($('#radio1').is(":checked")){ $('#fuelanalysis').show();}
    else{$('#fuelanalysis').hide();}
    
    if ($('#radio2').is(":checked")){$('#temperatureanalysis').show();}
    else{ $('#temperatureanalysis').hide();}
    
});
            $("#sumbit_data").click(function(){
              
              $("#mixed-line-column-area-chart").empty().append(' <div id="mixed-line-column-area-chart"></div>');
              var vehicles =  $('#vehicles').val();
             // alert(vehicles);
             var startLocalDate =  $('#startLocalDate').val();
             var endLocalDate =  $('#endLocalDate').val();
        
              startLocalDate =  generateDatabaseDateTime(startLocalDate); // "2021-12-24T18:16:31.000"
              endLocalDate =  generateDatabaseDateTime(endLocalDate); // "2021-12-24T18:16:31.000"

            function generateDatabaseDateTime(date) {

                  var today = new Date(date);
                 today.toISOString();
                 //console.log(today)
             var indatetime = today.setMinutes(today.getMinutes() + 330 ); // GMT UNIX TIMESTAMP
           
            
              return new Date(indatetime).toISOString().slice(0, 19).replace('T', ' ');
             }
              console.log(startLocalDate);
              console.log(endLocalDate);
              console.log(vehicles);
               // alert(startLocalDate);

                  $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/fuel_graph_data'); ?>',
                        data: {'from_Date' : startLocalDate, 
                                'to_Date' : endLocalDate,
                                'vehicle' : vehicles},
                        success: function(data){
                            var obj = JSON.parse(data);
                         
                            if(data!='' && data!='null')
                            {
                           //   alert(data);
                            console.log(obj);
                              graph_mixed(obj);

                            }
                            else
                            {
                               alert("No data Found");
                            }
                           
                          
                            }
                });

           });



           function graph_mixed(obj){
          
            var fuel_usage = [];
						var distance = [];
						var cal_distance =null;
						var trl_distance;
						var speed = [];
						var set_dis = 0;
						var smooth_ltr=[];
						var modified_data =obj.modified_date;
						var speed_data =obj.speed;
						var normal_fuel =obj.litres;
						var smooth_data =obj.smooth_litres;
						var smooth_date = obj.smooth_date;
					
						var distance_data =obj.distance;

                        speed_data.forEach((speed1, index) => {
						  const date1 = modified_data[index];
						  speed.push({ x: new Date(date1), y:parseInt(speed1)});
						  });
						    normal_fuel.forEach((normalf1, index) => {
						  const date2 = modified_data[index];
						  fuel_usage.push({ x: new Date(date2), y:parseInt(normalf1)});
						  });
						    if(smooth_data!='null')
						    {
						      smooth_data.forEach((smoothf, index) => {
						    
						  const date3 = smooth_date[index];
						  smooth_ltr.push({ x: new Date(date3), y:parseInt(smoothf)});
						  });
						      }

						        distance_data.forEach((dist1, index) => {
						  const date4 = modified_data[index];
						  if(cal_distance){
						  if(dist1 !='0')
						  {
						  	trl_distance = parseInt(dist1) - cal_distance;
							
								set_dis = parseInt(set_dis) + parseInt(trl_distance);
						  }
						}
						  cal_distance = parseInt(dist1);
						  distance.push({ x: new Date(date4), y:parseInt(set_dis)});
						  });

                     console.log(speed);
                     console.log(smooth_ltr);

                    // if(smooth_data)
                    // {
                        var $primary="#48b04f",$secondary="#0745a3",$success="#1f1a1a",$info="#ed2f2f",$warning="#e0310d",$danger="#ff8f9e",
                        $themeColor=[$primary,$secondary,$info,$success,$warning,$danger],
                        mixedLineColumnAreaChart={
                            chart:{height:350,type:"line",stacked:!1},
                    stroke:{width:[2,5,4,3],curve:"smooth"},
                    plotOptions:{bar:{columnWidth:"50%"}},
                    colors:$themeColor,
                    series: [
                                {name:"Speed",type:"area",data: speed},               
                                {name:"Distance",data: distance},   
                                // {name:"Smooth",data: smooth_ltr},    
                                {name:"Fuel",data: fuel_usage},    
                                
                                    
                                        ],
                    fill:{
                        // opacity:[.85,.1,1],
                        gradient:{inverseColors:!1,shade:"light",type:"vertical",opacityFrom:.85,opacityTo:.55,stops:[0,100,100,100]}
                        },
                        title: {
                            text: "Fuel Report",
                            align: "left"
                        },
                    markers:{size:0},
                    xaxis: {
                  type: 'datetime',
                  labels: {
                    format: 'dd-MM HH:mm:ss',
                  }
                },
                animations: {
                      initialAnimation: {
                        enabled: false
                      }
                    },
    // annotations: {
    //         xaxis: [
    //       {
    //         x: new Date('2021-10-14 07:00:00').getTime(),
    //         x2: new Date('2021-10-14 08:00:00').getTime(),
    //         fillColor: '#B3F7CA',
    //         label: {
    //           text: 'ON / OFF'
    //         }
    //       }
    //     ]
    // },
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
                    return e + " Km"
                 
                }
              }
            },
            {
              title: {
                formatter: function (e) {
//                  return e;
                 return e + " ltr"
                }
              }
            },
            {
              title: {
                formatter: function (e) {
//                  return e;
              return e + " ltr"
                }
              }
            }
          ]
        },
        tooltip: {
            x: {
                format: "dd-MM HH:mm:ss"
            }
        },

        legend:{labels:{useSeriesColors:!0},
        markers:{customHTML:[function(){return""},function(){return""},function(){return""},function(){return""}]}}},
mixed_line_column_area_chart=new ApexCharts(document.querySelector("#mixed-line-column-area-chart"),mixedLineColumnAreaChart);
mixed_line_column_area_chart.render();

     
      
   
}

         
         });
             
                
     
</script>

<!-----------------Temperature graph script------------------------------------------------------------>
<script>
         $(document).ready(function() {

             // alert('hi');

            $("#sumbit_tempdata").click(function(){
              
              $("#mixed-line-column-area-chart-temp").empty().append(' <div id="mixed-line-column-area-chart-temp"></div>');
              var vehicles =  $('#vehicles').val();
            //  alert(vehicles);
             var startLocalDate =  $('#startLocalDate').val();
             var endLocalDate =  $('#endLocalDate').val();
        
              startLocalDate =  generateDatabaseDateTime(startLocalDate); // "2021-12-24T18:16:31.000"
              endLocalDate =  generateDatabaseDateTime(endLocalDate); // "2021-12-24T18:16:31.000"

            function generateDatabaseDateTime(date) {

                  var today = new Date(date);
                 today.toISOString();
                 //console.log(today)
             var indatetime = today.setMinutes(today.getMinutes() + 330 ); // GMT UNIX TIMESTAMP
           
            
              return new Date(indatetime).toISOString().slice(0, 19).replace('T', ' ');
             }
              console.log(startLocalDate);
              console.log(endLocalDate);
               // alert(startLocalDate);

                  $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/temp_graph_data'); ?>',
                        data: {'from_Date' : startLocalDate, 
                                'to_Date' : endLocalDate,
                                'vehicle' : vehicles},
                        success: function(data){
                         //   alert(data);
                            var obj = JSON.parse(data);
                           
                            if(data!='' && data!='null')
                            {
                            
                              graph_mixed(obj);

                            }
                            else
                            {
                               alert("No data Found");
                            }
                           
                          
                            },
                            error: function(response){
                                alert("Error: Message Not Sent");
                            }

           });
         
         });
         
        });        
                
                
        function graph_mixed(obj){
    var total = obj.length;
    var tempData = [];
    var modified_date = [];
    for(var i=0;i<total;i++){
        tempData[i] = [obj[i].modified_date,obj[i].temp_status1];
     
    }   
//    console.log(obj);
      var $primary="#48b04f",$secondary="#e62c0b",$success="#f50a0a",$info="#179bad",$warning="#3524f0",$danger="#ff8f9e",
        $themeColor=[$primary,$success,$warning,$info,$danger,$secondary],
   
areaSplineChart={chart:{height:350,type:"area"},dataLabels:{enabled:!1},
stroke:{curve:"smooth",colors:$themeColor},
series: [
                 {name:"TEMPERATURE",data: tempData},        
        ],
xaxis:{type:"datetime"},
// tooltip:{x:{format:"dd/MM/yy HH:mm"}},
tooltip:{x:{format:"dd-MM-yy HH:mm"},y:{formatter:function(e){return" "+e+" °C"}}},fill:{colors:$themeColor}
};
var area_spline_chart=new ApexCharts(document.querySelector("#mixed-line-column-area-chart-temp"),areaSplineChart);area_spline_chart.render();
// var column_basic_chart=new ApexCharts(document.querySelector("#column-basic-chart"),columnBasicChart);column_basic_chart.render();


// mixed_line_column_area_chart=new ApexCharts(document.querySelector("#mixed-line-column-area-chart-temp"),mixedLineColumnAreaChart);
// mixed_line_column_area_chart.render();
   
}

</script>