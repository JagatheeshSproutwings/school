
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
                    <h4 class="card-title">Temperature</h4>
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
                    <h4 class="card-title">Temperature Charts</h4>
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
var area_spline_chart=new ApexCharts(document.querySelector("#mixed-line-column-area-chart"),areaSplineChart);area_spline_chart.render();
// var column_basic_chart=new ApexCharts(document.querySelector("#column-basic-chart"),columnBasicChart);column_basic_chart.render();


// mixed_line_column_area_chart=new ApexCharts(document.querySelector("#mixed-line-column-area-chart"),mixedLineColumnAreaChart);
// mixed_line_column_area_chart.render();
   
}

</script>