
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
                <div class="card-content1 collapse show text-white box-shadow-0">
                    <div class="card-body1 card-dashboard1">
                        <div class="row">
                            <div class="col-6">
                              <div id="playback_map" style="height:445px;width:100%;"></div>
                        <div class="ctrl-box map-box hidden"  style="width:100%;min-height:4vh;">
                            <div id="tools col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <table>
                                                <tr>
                                                    <td>Start Date </td>
                                                    <td> : </td>
                                                    <th id="form_date"></th>
                                                </tr>

                                                <tr>
                                                    <td>End Date</td>
                                                    <td> : </td>
                                                    <th id="to_date"></th>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="background: #f2efe9;text-align: center;color: black;">
                                        <div class="form-group">
                                            <button class="btn btn-success btn-play" id="start" type="button" value="Start" data-toggle="tooltip" title="Start"> <i class="fa fa-play" ></i></button>
                                            <button onclick="" class="btn btn-warning btn-pause hidden" data-toggle="tooltip" title="Stop"> <i class="fa fa-pause" ></i></button>
                                            <button onclick="close_map()" class="btn btn-danger btn-close" data-toggle="tooltip" title="Close"> <i class="fa fa-times" ></i></button>
                                            <select id="speed_limit" name="speed_limit" class="form-control" style="display: inline-block;width: 100px;" id="sel1">
                                                <!--  <option value="-1">Park View</option>  -->
                                                <option value="350">Medium</option>
                                                <option value="700">Slow</option>
                                                <option value="100">Fast</option>

                                            </select>
                                            <input type="checkbox" id="parkview">Park View
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <table>
                                                <tr>
                                                    <td>Start Odometer </td>
                                                    <td> : </td>
                                                    <th id="start_odo"></th>
                                                </tr>

                                                <tr>
                                                    <td>End Odometer</td>
                                                    <td> : </td>
                                                    <th id="end_odo"></th>
                                                </tr>
                                                <tr>
                                                    <td>Total Travel KMs:</td>
                                                    <th id="total_distance"></th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button type="button" id='playback' style="background-color:#95418d; margin-top: 10px;" class="badge bg-blue pull-right"  onclick="export_excel()"> <span class='fa fa-download' ></span> &nbsp;&nbsp;Export Excel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
               <div class="card-content collapse show">
                    <div class="card-body chartjs">
                        <div class="height-500">
                            <!--<canvas id="chartline"></canvas>-->
                            <div id="chartline">
</div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                        </div> 
                        
                        <!--<div class="table-responsive">-->
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
  
</section>
        
		</div>
      </div>
   
       
    <!-- END: Content-->
<input type="text" id="vehicle_imei" value="<?= $vehiclesimei; ?>">
<input type="text" id="vehicle_id" value="<?= $vehicleID; ?>">
<input type="text" id="from_Date" value="<?= $from_Date; ?>">
<input type="text" id="to_Date" value="<?= $to_Date; ?>">
    <script src="<?php echo base_url();?>app-assets/vendors/js/charts/chart.min.js"></script>
    <!--<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>-->
    <!--<script src="<?php echo base_url();?>app-assets/js/scripts/charts/chartjs/line/line-skip-points.min.js"></script>-->
   <script>
         $(document).ready(function() {  
             view_map();
             export_excel();
             
             
           var vehicle_id= $('#vehicle_id').val();
           var from_Date = $('#from_Date').val();
           var to_Date= $('#to_Date').val();
//           alert(vehicle_id);
$.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/ignitiononoff_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' :vehicle_id},
                        success: function(data){
                            var obj = JSON.parse(data);
//                             $("#chart").empty();
                           
                            }
                });
         
         });
//        $(window).on("load",(function(){
//    
//        })); 
        $(window).on("load",(function(){

      
        var options = {
          series: [{
          data: series.monthDataSeries1.prices
        }],
          chart: {
          height: 350,
          type: 'line',
          id: 'areachart-2'
        },
        annotations: {
          xaxis: [{
            x: new Date('26 Nov 2017').getTime(),
            x2: new Date('28 Nov 2017').getTime(),
            fillColor: '#B3F7CA',
            opacity: 0.4,
            label: {
              borderColor: '#B3F7CA',
              style: {
                fontSize: '10px',
                color: '#fff',
                background: '#00E396',
              },
              offsetY: -10,
              text: 'ignition ON',
            }
          }]
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        grid: {
          padding: {
            right: 30,
            left: 20
          }
        },
        title: {
          text: 'Line with Annotations',
          align: 'left'
        },
        labels: series.monthDataSeries1.dates,
        xaxis: {
          type: 'datetime',
        },
        };

        var chart = new ApexCharts(document.querySelector("#chartline"), options);
        chart.render();


        })); 


    

</script>
<!--================================playback map------------------------->

  <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.js"></script> 
  <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.rotatedMarker.js"></script>
     <script src="<?php echo base_url();?>assets/plugins/osm/leaflet-arrowheads.js"></script>
   <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.polylineDecorator.js"></script>

   <script type="text/javascript">

          $(document).on({
       ajaxStart: function(){
           $("body").addClass("loadings"); 
       },
       ajaxStop: function(){ 
           $("body").removeClass("loadings"); 
       }    
   });

   // initialize the map on the "map" div with a given center and zoom
    var StartMarker = {};
    var parkmarkerss = [];
    var speedmarkerss=[];
     var polylinemarkers=[];
    var parkmarker;
    var speedmarker;
       var assetLayerGroup = new L.LayerGroup();
    //var parkmarkerss = new L.LayerGroup(); 
 
   var map = new L.Map('playback_map', {
     center: new L.LatLng(11.0467,76.9254),
     zoom: 10,
     minZoom: 1,
   });

   // create a new tile layer
   var tileUrl = 'http://198.204.245.190/osm/{z}/{x}/{y}.png',
   layer = new L.TileLayer(tileUrl);

   // add the layer to the map
   map.addLayer(layer);
           var assetLayerGroup = new L.LayerGroup();

   function close_map(){
       $('.filter-box').removeClass('hide');
       $('.map-box').addClass('hide');
       $('.search-button').removeClass('hide');
       window.location.reload();
   }

   function export_excel()
   {
     //  alert('hi');
       var vehicle = $('#vehicle_imei').val();
       var from_date,to_date;
       from_date = $('#from_Date').val();
       to_date = $('#to_Date').val();
      var url='<?php echo site_url('/Genericreport/playback_excel/'); ?>?vehicle='+vehicle+'&from='+from_date+'&to='+to_date;
               window.open(url);

    }  


   function view_map()
   {
        var pathCoords ='';
       var vehicle = $('#vehicle_imei').val();

        var from_date,to_date;
       $(".map-box").addClass('hide');
       $(".loading").removeClass('hide');
       from_date = $('#from_Date').val();
     //  alert(from_date);
       to_date = $('#to_Date').val();
     //  alert(to_date);
         var fda = from_date.split(" ");
         var fda1 = fda[0].split("/");
        var fd = fda1[1] + '/' + fda1[0] + '/' + fda1[2]+ ' '+fda[1]+' '+fda[2];
        var eda = to_date.split(" ");
         var eda1 = eda[0].split("/");
        var ed = eda1[1] + '/' + eda1[0] + '/' + eda1[2]+ ' '+eda[1]+' '+eda[2];
           $.ajax({
                   url:'<?php echo site_url('/Genericreport/get_all_history/'); ?>',     
                   cache: false,
                   type: 'POST',
                   data: { 
                           'vehicle': vehicle,
                           'from_date': from_date,
                           'to_date': to_date,
                   },
                   success: function(data)
                   { 
                      console.log(data);
                       polylinemarkers.forEach(function (item) {
                           map.removeLayer(item)
                       });
                         map.removeLayer(StartMarker);


                         for(var i = 0; i <parkmarkerss.length; i++) {

                       map.removeLayer(parkmarkerss[i]);
                   }
                   for (var i = 0; i < speedmarkerss.length; i++) {

                       map.removeLayer(speedmarkerss[i]);
                   }

                   // console.log(data);

                   $('#form_date').empty().append(fd);
                   $('#to_date').empty().append(ed);

                   $('.filter-box').addClass('hide');
                   $('.search-button').addClass('hide');
                   var counter = 0;

                   var route_play;
                   var speed = $('#speed_limit').val();
                   pathCoords = new Array();
                   var details = new Array();
                   var path_coords;
                   var obj = JSON.parse(data);


                   if (obj != false)
                   {

                       var vehicle_name = obj[0].vehiclename;
                       var total = obj.length;

                       var start_odo = obj[0].odometer;


                       var end_odo = obj[total - 1].odometer;
                       // console.log(start_odo);
                       // console.log(end_odo);
                       // console.log(end_totalodo);

                       var total_odo = (parseFloat(end_odo) - parseFloat(start_odo)).toFixed(3);

                       $('#start_odo').empty().append(start_odo);
                       $('#end_odo').empty().append(end_odo);
                       $('#total_distance').empty().append(total_odo + ' Kms');
                       $('#form_date').empty().append(from_date);
                       $('#to_date').empty().append(to_date);


                       $('.map-box').removeClass('hidden');
                       $(".loading").addClass('hide');

                       var vehicle_type = obj[0].vehicletype;

                       switch (vehicle_type) {//running

                           case 1:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bike.png';
                               break;
                           case 2:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/car.png';
                               break;
                           case 3:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bus.png';
                               break;
                           case 4:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bus.png';
                               break;
                           case 5:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/truck.png';
                               break;
                           case 6:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/container.png';
                               break;
                           case 7:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/open_truck.png';
                               break;
                           case 8:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/rmc_truck.png';
                               break;
                           case 9:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/cylinder_truck.png';
                               break;
                           case 10:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/container.png';
                               break;
                           case 11:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/jcb.png';
                               break;
                           case 12:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/loader.png';
                               break;
                           case 13:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/ace.png';
                               break;
                           case 14:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/tipper.png';
                               break;
                           case 15:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/tractor.png';
                               break;
                           default:
                               var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/truck.png';

                       }



                       var latlngs = [];

                       for (i = 0; i < obj.length; i++) {
                           //console.log(obj[i].lat_message);
                           latlngs.push([obj[i].lat_message, obj[i].lon_message]);
                           var datetime = "'" + obj[i].datetime + "'";
                           pathCoords.push('{ lat :' + parseFloat(obj[i].lat_message).toFixed(4) + ',lng : ' + parseFloat(obj[i].lon_message).toFixed(4) + ',ign :' + obj[i].acc_status + ',odometer :' + parseFloat(obj[i].odometer).toFixed(3) + ',speed : ' + parseFloat(obj[i].speed) + ',angle : ' + parseFloat(obj[i].angle) + ',modified_date : ' + datetime + '}');
                           vehiclename = obj[i].vehiclename;

                       }
                       // console.log(pathCoords);

                       var polyline = L.polyline(latlngs, {strokeColor: 'rgba(0, 128, 255, 0.7'}).addTo(map);
                       var image_path = '<?php echo base_url(); ?>assets/dist/img/starts.png';
                       var image_path1 = '<?php echo base_url(); ?>assets/dist/img/finish.png';

                       var startm = [obj[0].lat_message, obj[0].lon_message];

                       var redIcon = new L.Icon({
                           iconUrl: image_path,
                           iconSize: [65, 65],
                           className: 'starticons',
                       });

                       var redIcon1 = new L.Icon({
                           iconUrl: image_path1,
                           iconSize: [65, 65],
                       });
                       // marker = L.marker(startCoords,{icon: redIcon,rotationAngle: angle}).addTo(map);

                       var startmarker = L.marker(startm, {icon: redIcon}).addTo(map);
                       startmarker.bindPopup('Start Location');

                       var endm = [obj[obj.length - 1].lat_message, obj[obj.length - 1].lon_message];
                       var endmarker = L.marker(endm, {icon: redIcon1}).addTo(map);
                       endmarker.bindPopup('End Location');


                       var arrowHead = L.polylineDecorator(polyline, {
                           patterns: [
                               {offset: 25, repeat: 50, symbol: L.Symbol.arrowHead({pixelSize: 10, pathOptions: {color: '#23ba71', fillOpacity: 1, weight: 0}})}
                           ]
                       }).addTo(map);
                       console.log(arrowHead);
                       map.fitBounds(polyline.getBounds());
                       polylinemarkers.push(polyline);
                       polylinemarkers.push(arrowHead);
                       polylinemarkers.push(startmarker);
                       polylinemarkers.push(endmarker);

                       assetLayerGroup.addLayer(polylinemarkers);
                       path_coords = eval("[" + pathCoords + "]");
                       //  console.log(polylinemarkers);

                   } else
                   {
                       //   alert(obj);
                       console.log('obj');
                       alert('No data Found');

                       for (var i = 0; i < parkmarkerss.length; i++) {

                           map.removeLayer(parkmarkerss[i]);
                       }
                       for (var i = 0; i < speedmarkerss.length; i++) {

                           map.removeLayer(speedmarkerss[i]);
                       }

                       $('.map-box').addClass('hidden');
                       $(".loading").addClass('hidden');
                       $('.filter-box').removeClass('hidden');
                       $('.search-button').removeClass('hidden');
                   }


                   function stop_paly() {
                       clearTimeout(route_play);
                   }

                   //START HIDE AND SHOW PLAY PAUSE BUTTON
                   $('.btn-play').click(function () {


                       $('.btn-pause').removeClass('hidden');
                       $('.btn-play').addClass('hidden');
                       start_history();
                   });
                   $('.btn-pause').click(function () {
                       $('.btn-pause').addClass('hidden');
                       $('.btn-play').removeClass('hidden');
                       stop_paly();
                   });
                   //END HIDE AND SHOW PLAY PAUSE BUTTON

                   $('#parkview').click(function () {

                       if ($("input[type=checkbox]").is(":checked"))
                       {
                           park_marker(vehicle_name);

                       } else {

                           for (var i = 0; i < parkmarkerss.length; i++) {

                               map.removeLayer(parkmarkerss[i]);
                           }
                           for (var i = 0; i < speedmarkerss.length; i++) {

                               map.removeLayer(speedmarkerss[i]);
                           }
                       }



                   });
                   function start_history()
                   {
                       if ($('#speed_limit').val() == -1)
                       {
                           park_marker(vehicle_name);
                       } else
                       {
                           for (var i = 0; i < parkmarkerss.length; i++) {
                               map.removeLayer(parkmarkerss[i]);
                           }
                           for (var i = 0; i < speedmarkerss.length; i++) {
                               map.removeLayer(speedmarkerss[i]);
                           }
                           var lat = path_coords[counter].lat;
                           var lng = path_coords[counter].lng;
                           console.log(lat);
                           console.log(lng);
                           var ign = path_coords[counter].ign;
                           var odometer = path_coords[counter].odometer;
                           var speed = path_coords[counter].speed;
                           var modified_date = path_coords[counter].modified_date;
                           var angle = path_coords[counter].angle;

                           moveMarker(lat, lng, counter, ign, odometer, speed, modified_date, angle);

                           counter++;

                           if (counter <= total - 1)
                           {
                               route_play = setTimeout(function () {
                                   start_history()
                               }, $('#speed_limit').val());



                           } else
                           {
                               clearInterval(route_play);
                           }

                       }

                   }


                   function park_marker(vehicle_name)
                   {
                       $.ajax({
                           url: '<?php echo site_url('/Genericreport/get_park_history/'); ?>',
                           cache: false,
                           type: 'POST',
                           data: {
                               'vehicle': vehicle,
                               'from_date': from_date,
                               'to_date': to_date,
                           },
                           success: function (data) {


                               var parkdata = JSON.parse(data);

                               for (var i = 0; i < parkdata.length; i++) {
                                   //console.log(parkdata[i].s_lat);
                                   var smallIcon = new L.Icon({
                                       iconSize: [20, 20],
                                       iconAnchor: [13, 27],
                                       popupAnchor: [1, -24],
                                       iconUrl: '<?php echo base_url(); ?>assets/dist/img/park-icon.png'
                                   });
                                   var park_duration = parkdata[i].time_duration;
                                   const popupContent =
                                           '<div class="marker">' + "<p>Vehicle No: <b>" + vehicle_name + "</b></p>" + "<p>Duration(H:M:S): <b>" + park_duration + "</b></p>"
                                   "</div>";

                                   parkmarker = L.marker([parkdata[i].s_lat, parkdata[i].s_lng], {icon: smallIcon}).addTo(map);


                                   map.addLayer(parkmarker);


                                   //   var group = new L.featureGroup([parkmarker]);



                                   parkmarker.bindPopup(popupContent);

                                   parkmarkerss.push(parkmarker);





                               }
                               assetLayerGroup.addLayer(parkmarkerss);




                           }
                       });

                   }




                   function moveMarker(lat, lng, counter, ign, odometer, speed, modified_date, angle)
                   {



                       var MarkerContent = "<div class='marker'>" +
                               "Vehicle No: <b>" + vehiclename + "</b>" +
                               "<br>Speed : <b>" + Math.round(speed) + "</b> Km/Hr" +
                               "<br>Odometer : <b>" + odometer + "</b>" +
                               "<br>Date Time : <b>" + modified_date + "</b>" +
                               "</div>";

                       var redIcon = new L.Icon({
                           iconUrl: vehicle_path,
                           iconSize: [35, 35],
                       });


                       map.removeLayer(StartMarker);


                       // StartMarker = L.marker([lat, lng],{icon: redIcon,rotationAngle: angle}).addTo(map);
                       StartMarker = L.marker([lat, lng]).addTo(map);
                       // StartMarker = L.marker([lat, lng]).addTo(map);
                       map.addLayer(StartMarker);

                       var group = new L.featureGroup([StartMarker]);


                       StartMarker.bindPopup(MarkerContent).openPopup();


                   }


                   function over_speed(vehicle_name)
                   {
                       $.ajax({
                           url: '<?php echo site_url('/playback/get_all_history/'); ?>',
                           cache: false,
                           type: 'POST',
                           data: {
                               'vehicle': vehicle,
                               'from_date': from_date,
                               'to_date': to_date,
                           },
                           success: function (data) {



                               var speeddata = JSON.parse(data);




                               for (var i = 0; i < speeddata.length; i++) {
                                   //console.log(parkdata[i].s_lat);
                                   var smallIcon = new L.Icon({
                                       iconSize: [25, 25],
                                       iconAnchor: [13, 27],
                                       popupAnchor: [1, -24],
                                       iconUrl: '<?php echo base_url(); ?>assets/dist/img/marker/nonet-in-48.png'
                                   });
                                   var speed = speeddata[i].speed;
                                   var update_time = speeddata[i].datetime;
                                   if (speed >= 80)
                                   {
                                       const popupContent =
                                               '<div class="marker">' + "<p>Vehicle No: <b>" + vehicle_name + "</b></p>" + "<p>Updated Time: <b>" + update_time + "</b></p>" + "<p>Speed: <b>" + speed + "</b></p>"
                                       "</div>";

                                       speedmarker = L.marker([speeddata[i].lat_message, speeddata[i].lon_message]).addTo(map);
                                       //  speedmarker = L.marker([speeddata[i].lat_message,speeddata[i].lon_message],{icon: smallIcon}).addTo(map);

                                       speedmarker.bindPopup(popupContent);

                                       speedmarkerss.push(speedmarker);


                                       console.log(speed);
                                   }
                                   assetLayerGroup.addLayer(speedmarkerss);

                               }


                           }
                       });
                   }

               }

           });

       }
   </script>