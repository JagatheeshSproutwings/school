    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="basic-elements">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Graph Analysis</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                         <form method="post" action="<?= base_url(); ?>dashboard/workspace_details" id="workspaceform" class="form-horizontal form-simple" novalidate enctype="multipart/form-data">
                    <div class="app-content-overlay">
                        
                         <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <div class="form-group">
                        <div class="text-bold-600 font-medium-2">
                            Select Vechile Number
                        </div>
                        <select name="vehiclesimei" class="select2 form-control">
                            <?php foreach ($vehicle_details as $list) { ?>
                           <option value="<?php echo $list->vehicleid;?>"><?php echo $list->vehiclename;?></option>
                       <?php   } ?>
                        </select>
                    </div>
                                </div>
                                <div class="col-3">
                                    <fieldset class="form-group">
                                        <label for="basicInput">&emsp;&emsp;Start Date</label>
                                        <input type="date" class="form-control lastsevenDate inmnu_date" id="from_Date" name="from_Date">
                                    </fieldset>
                                </div>
                                <div class="col-3">
                                    <fieldset class="form-group">
                                        <label for="helpInputTop">End Date</label>
                                        <input type="date" class="form-control endsevenDate inmnu_date" id="to_Date" name="to_Date">
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-6" style="padding: 23px;">
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
                        
                        <div class="col-5" style="padding: 23px;">
                            
                            <div class="card" style="height: 270px;">                              
                                <div class="card-content">
                                    <span style="position: absolute;margin: 120px -95px;"> <i class="fa fa-plus fa-2x"></i></span>
                                    <div class="card-body" style="padding-top: 50px">
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="ignnitionon" checked> Ignnition On / Off                                            
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                            <input type="radio" name="workspace" value="fuelrefueling"> Refueling and Draining                                            
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                            <input type="radio" name="workspace" value="fuelvolume"> Temperature                                         
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                            <input type="radio" name="workspace" value="speed"> Speed                                           
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="movement"> Battery                                           
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="movement"> RPM                                           
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="movement"> Ac On/Off                                           
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="movement"> Bucket                                          
                                            </label>
                                        </fieldset>
                                        <fieldset class="radio">
                                            <label>
                                                <input type="radio" name="workspace" value="movement"> Drum                                          
                                            </label>
                                        </fieldset>
                                       
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                                <input type="submit" class="horver_center btn btn-primary btn-xs" value="Submit">
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</section>
        
		</div>
      </div>
    </div>
    <!-- END: Content-->


    <script>
         $(document).ready(function() {    
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
                        //   console.log(obj);
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

                //    }
                  //  else
//                     {

//                         var $primary="#48b04f",$secondary="#e62c0b",$success="#f50a0a",$info="#050708",$warning="#3524f0",$danger="#ff8f9e",
//         $themeColor=[$primary,$success,$warning,$info,$danger,$secondary],
//          mixedLineColumnAreaChart={
//             chart:{height:350,type:"line",stacked:!1},
//     stroke:{width:[2,5,6],curve:"smooth"},
//     plotOptions:{bar:{columnWidth:"50%"}},
//     colors:$themeColor,
//     series: [
//                  {name:"Speed",type:"area",xValueFormatString: "DD MMM hh:mm:ss",data: speed},               
//                  {name:"Distance",xValueFormatString: "DD MMM hh:mm:ss",data: distance},    
//                  {name:"Fuel",xValueFormatString: "DD MMM hh:mm:ss",data: fuel_usage},     
                     
//         ],
//     fill:{
//         // opacity:[.85,.1,1],
//         gradient:{inverseColors:!1,shade:"light",type:"vertical",opacityFrom:.85,opacityTo:.55,stops:[0,100,100,100]}
//         },
//     markers:{size:0},
//     xaxis:{type:"datetime"},
//     // annotations: {
//     //         xaxis: [
//     //       {
//     //         x: new Date('2021-10-14 07:00:00').getTime(),
//     //         x2: new Date('2021-10-14 08:00:00').getTime(),
//     //         fillColor: '#B3F7CA',
//     //         label: {
//     //           text: 'ON / OFF'
//     //         }
//     //       }
//     //     ]
//     // },
//     yaxis:{min:0}, 
//     tooltip: {
//         shared:!0,intersect:!1,
//           y: [
//             {
//               title: {
//                 formatter: function (e) {
//                   return e + " (Km/h"
//                 }
//               }
//             },
//             {
//               title: {
//                 formatter: function (e) {
// //                  return e;
//                 return e + " Km"
//                 }
//               }
//             },
//             {
//               title: {
//                 formatter: function (e) {
//                   return e + " ltr"
//                 }
//               }
//             },

//           ]
//         },
        
// //    tooltip:{shared:!0,intersect:!1,y:{formatter:function(e){return void 0!==e?e.toFixed(0)+" ":e}}},
//     // legend:{labels:{useSeriesColors:!0},
//     //     markers:{customHTML:[function(){return""},function(){return""},function(){return""}]}}
//     },
// mixed_line_column_area_chart=new ApexCharts(document.querySelector("#mixed-line-column-area-chart"),mixedLineColumnAreaChart);
// mixed_line_column_area_chart.render();

                //    }
      
   
}

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