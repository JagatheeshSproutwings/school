
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
            <section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Elements</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
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
                            <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                 <fieldset class="form-group">
                                <label for="basicInput">Start Date</label>
                                <input type="datetime-local" class="form-control startLocalDate" id="startLocalDate" name="fromdate">
                            </fieldset>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                <fieldset class="form-group">
                                <label for="helpInputTop">End Date</label>
                                <input type="datetime-local" class="form-control endLocalDate" id="endLocalDate" name="todate">
                               
                            </fieldset>
                            </div>
                            <div class="col-xl-1 col-lg-2 col-md-12 mb-1">
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
</section>
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

        
		</div>
      </div>
    </div>
    <!-- END: Content-->


    <script>
         $(document).ready(function() {

             // alert('hi');

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
                              graph_mixed(obj);

                            }
                            else
                            {
                               alert("No data Found");
                            }
                           
                          
                            }
                });

           });
         
         });
         
                
                
                
        function graph_mixed(obj){
    var total = obj.length;
    var speedsData = [];
    var fuelssData = [];
    var distancesData = [];
    var cal_distance=null;
    var set_dis=0;
    var trl_distance;
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

</script>