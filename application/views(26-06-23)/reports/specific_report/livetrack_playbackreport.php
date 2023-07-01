<?php 
    $role =$this->session->userdata['roleid']; ?>
<!-- BEGIN: Body-->


    <!-- BEGIN: Content-->
	<style>
	.starticons{
    margin-left: -30.5px;
    margin-top: -62.5px;
	}


	</style>
    <div class="app-content content">
        <input type="hidden" id="vehicleid" value="<?php echo $livetrack_playback->vehicleid;?>">
        <input type="hidden"id="from_date" value="<?php echo $livetrack_playback->from_date;?>">
        <input type="hidden" id="to_date" value="<?php echo $livetrack_playback->to_date;?>">
        <input type="hidden" id="route_id" value="<?php echo $livetrack_playback->route_id;?>">
        <input type="hidden" id="path_coords"> 

        <input type="hidden" id="pre_lat" value="">
        <input type="hidden"id="pre_lng" value="">
        <input type="hidden" id="pre_angle" value="">

        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding-bottom: 0px;padding-top: 3px;">

            <div class="clearfix"><br></div>
        <div class="content-body">
            <section id="configuration">
            <div class="row" >
                <div class="col-12">
                    <div class="card" style="margin-bottom: 0px;">

                        <div class="card-content1 collapse show text-white bg-gradient-y-blue box-shadow-0">
                            <div class="card-body1 card-dashboard1">
                            <!--<div class="table-responsive">-->
                                    <div id="playback_map" style="height:445px;width:100%;"></div>
                                    <button type="button" id='back' class="badge bg-blue pull-right hidden">
                                    
                                    <a href="<?php echo base_url('Route/trip_plan');?>" ><h3 style="color:white;">Back</h3></a>
                                </button>
                                     <div class="ctrl-box map-box hidden"  style="width:100%;min-height:4vh;">
                                    
                                    <div id="tools col-lg-12 col-md-12 col-sm-12 ">
									                  <div class="row">
        	                        <div class="col-md-4">
                                     <div class="form-group">
                                    <table>
                                    <tr>
                                  
                                        <td>Start Date </td>
                                        <td> : <?php echo $trip_data->create_datetime;?></td>
                                        <th id="pform_date"></th>
                                    </tr>
                                    <tr>
                                        <td>End Date</td>
                                        <td> : <?php echo $trip_data->updated_datetime;?></td>
                                        <th id="pto_date"></th>
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
									
								</div>
								
                                    </div>
                            </div>

                           <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-----Model ----->


          </section>
        </div>




      </div>
    </div>

  <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.js"></script> 
  <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.rotatedMarker.js"></script>
     <script src="<?php echo base_url();?>assets/plugins/osm/leaflet-arrowheads.js"></script>
   <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.polylineDecorator.js"></script>

  <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.rotatedMarker.js"></script>
 <script src="<?php echo base_url();?>assets/plugins/osm/Leaflet.Marker.SlideTo.js"></script> 


<script type="text/javascript">

$( document ).ready(function() {
    view_map();
});
// initialize the map on the "map" div with a given center and zoom
var startmarker1 = [];
 var StartMarker = {};
 var parkmarkerss = [];
 var speedmarkerss=[];
  var polylinemarkers=[];
 var parkmarker;
 var speedmarker
 var markerlatlng = [];  ;
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

 function view_map()
{
   
     var pathCoords ='';
     var vehicle = $('#vehicleid').val();
     var route_id = $('#route_id').val();
var from_date,to_date;
from_date = $('#from_date').val();
//  alert(from_date);
to_date = $('#to_date').val();
        

    $.ajax({
        url:'<?php echo site_url('/Livetrack/get_all_history/');?>',     
                cache: false,
                type: 'POST',
                data: { 
                        vehicle: vehicle,
                        from_date: from_date,
                        to_date: to_date,
                },
                success: function(data)
                { 
                    var obj = JSON.parse(data);
                
                    playback_data(obj);
                }
            });


$.ajax({
        url:'<?php echo site_url('/Livetrack/routelatlngs/');?>',     
                cache: false,
                type: 'POST',
                data: { 
                    route_id: route_id
                },
                success: function(data)
                { 
                  
                    var obj = JSON.parse(data);
                
                    routelatlngs(map,obj);
                }
            });


   
                }


                function playback_data(obj)
                {

                    polylinemarkers.forEach(function (item) {
                        map.removeLayer(item)
                    });
                      map.removeLayer(StartMarker);

                
                    if(obj!=false)
                    {
                       // console.log(obj);
                    var vehicle_name = obj[0].vehiclename;
                    var total = obj.length;
                    var counter = 0;
                   
                   var route_play;
                   var speed= $('#speed_limit').val();
                    var start_odo=obj[0].odometer;
                 

                    var end_odo=obj[total-1].odometer;
                    // console.log(start_odo);
                    // console.log(end_odo);
                    // console.log(end_totalodo);

                    var total_odo= (parseFloat(end_odo)-parseFloat(start_odo)).toFixed(3);

                        $('#start_odo').empty().append(start_odo);
                        $('#end_odo').empty().append(end_odo);
                        $('#total_distance').empty().append(total_odo+' Kms');
                            $('#pform_date').empty().append(obj[0].datetime);
                            $('#pto_date').empty().append(obj[total-1].datetime);

                           $('.map-box').removeClass('hidden');

                        var vehicle_type = obj[0].vehicletype;

                       
                        var latlngs = [];
                        var pathCoords=[];
                        for (i = 0; i < obj.length; i++) {
                          var datetime = "'"+obj[i].datetime+"'";
                           latlngs.push([obj[i].lat_message, obj[i].lon_message,datetime]);

                           pathCoords.push('{ lat :' + parseFloat(obj[i].lat_message).toFixed(4) + ',lng : '+ parseFloat(obj[i].lon_message).toFixed(4)  +',ign :'+obj[i].acc_status+',odometer :' + parseFloat(obj[i].odometer).toFixed(3) + ',speed : '+ parseFloat(obj[i].speed)+ ',angle : '+ parseFloat(obj[i].angle)+ ',modified_date : '+datetime+'}'); 
                           vehiclename = obj[i].vehiclename;

                        }
                        
                        var polyline = L.polyline(latlngs, {strokeColor: 'rgba(0, 128, 255, 0.7'}).addTo(map);
                          var image_path = '<?php echo base_url(); ?>assets/dist/img/starts.png';
                            var image_path1 = '<?php echo base_url(); ?>assets/dist/img/finish.png';

                        var startm =[obj[0].lat_message, obj[0].lon_message];
                        
                        var redIcon = new L.Icon({
                                          iconUrl: image_path,
                                          iconSize:  [65, 65],
					className: 'starticons',
                                        });

                         var redIcon1 = new L.Icon({
                                          iconUrl: image_path1,
                                          iconSize:  [65, 65],
                                        });
                         // marker = L.marker(startCoords,{icon: redIcon,rotationAngle: angle}).addTo(map)
                         polyline.on('click',(e)=>{
                                        console.log(e)
                                    var point = findClosestPoint(e.latlng);
                                    var text = point[2];
                                    console.log(text)
                                    polyline.bindPopup(text);
                                  //  document.getElementById('testspan').innerHTML = text;
                                    })

                                    function findClosestPoint(latlng){
                                    var closestPoint = null;
                                var distance = 0;
                                latlngs.forEach((point)=>{
                                    if(closestPoint == null || distance > L.latLng([point[0],point[1]]).distanceTo(latlng)){
                                        distance = L.latLng([point[0],point[1]]).distanceTo(latlng);
                                    closestPoint = point;
                                    }
                                });
                                return closestPoint;
                                }
                                
                                $('#path_coords').val(pathCoords);
                        var arrowHead = L.polylineDecorator(polyline, {
                        patterns: [
                            {offset: 25, repeat: 50, symbol: L.Symbol.arrowHead({pixelSize: 10, pathOptions: {color: '#23ba71',fillOpacity: 1, weight: 0}})}
                        ]
                    }).addTo(map);

                        map.fitBounds(polyline.getBounds());
                           polylinemarkers.push(polyline); 
                            polylinemarkers.push(arrowHead); 
                          assetLayerGroup.addLayer(polylinemarkers);
                             
                          






                          function stop_paly() {
                         //   console.log(route_play);
                            clearTimeout(route_play);
                        }

                        //START HIDE AND SHOW PLAY PAUSE BUTTON
                        $('.btn-play').click(function(){


                            $('.btn-pause').removeClass('hidden');
                            $('.btn-play').addClass('hidden');
                            start_history();    
                        });
                        $('.btn-pause').click(function(){
                            $('.btn-pause').addClass('hidden');
                            $('.btn-play').removeClass('hidden');
                            stop_paly();
                        });
                        //END HIDE AND SHOW PLAY PAUSE BUTTON

                         $('#parkview').click(function(){
                           
                          if ($("input[type=checkbox]").is(":checked")) 
                          {
                            park_marker(vehicle_name);

                        } else {
                            
                          for(var i = 0; i <parkmarkerss.length; i++){
                                    
                                    map.removeLayer(parkmarkerss[i]);
                                }
                                for(var i = 0; i <speedmarkerss.length; i++){
                                    
                                    map.removeLayer(speedmarkerss[i]);
                                }
                        }
         
                         });
                       
                        function start_history()
                        {
                          
                          var path_coordval = $('#path_coords').val();
                          path_coords = eval("[" + path_coordval + "]");
                          console.log(path_coords);
                                                                    
                            if($('#speed_limit').val() == -1)
                            {
                                 
                                 
                                 
                                park_marker(vehicle_name);
                                    
                            }
                            else
                            {

                                for(var i = 0; i <parkmarkerss.length; i++){
                                    
                                    map.removeLayer(parkmarkerss[i]);
                                }
                                for(var i = 0; i <speedmarkerss.length; i++){
                                    
                                    map.removeLayer(speedmarkerss[i]);
                                }

                                var lat = path_coords[counter].lat;
                                var lng = path_coords[counter].lng;
                                //console.log(lat);
                                console.log(lng);
                                var ign = path_coords[counter].ign;
                                var odometer = path_coords[counter].odometer;
                                var speed = path_coords[counter].speed;
                                var modified_date = path_coords[counter].modified_date;
                                var angle = path_coords[counter].angle;
                                
                                moveMarker(lat, lng, counter,ign,odometer,speed,modified_date,angle);

                                counter++; 
                                      
                                if (counter <= total -1) 
                                {
                                    route_play=setTimeout(function () { start_history() }, $('#speed_limit').val());


                                    
                                }
                                else
                                {
                                    clearInterval(route_play);
                                }

                            }

                        }


                        function park_marker(vehicle_name)
                        {
                          var vehicle = $('#vehicleid').val();
                          var from_date,to_date;
                          from_date = $('#from_date').val();
                            // alert(from_date);
                          to_date = $('#to_date').val();

                                $.ajax({
                                    url:'<?php echo site_url('/Livetrack/get_park_history/');?>',     
                                    cache: false,
                                    type: 'POST',
                                    data: { 
                                            'vehicle': vehicle,
                                            'from_date': from_date,
                                            'to_date': to_date,
                                    },
                                    success: function(data){ 
                                        
                                     // alert(data);
                                        var parkdata = JSON.parse(data);

                                            for (var i = 0; i < parkdata.length; i++) {
                                                //console.log(parkdata[i].s_lat);
                                                var smallIcon = new L.Icon({
                                                            iconSize: [20, 20],
                                                            iconAnchor: [13, 27],
                                                            popupAnchor: [1, -24],
                                                            iconUrl: '<?php echo base_url(); ?>assets/dist/img/park-icon.png'
                                                              });
                                                var park_duration =parkdata[i].time_duration;
                                         const popupContent = 
                                                    '<div class="marker">' +  "<p>Vehicle No: <b>"+ vehicle_name +"</b></p>"+"<p>Duration(H:M:S): <b>"+ park_duration +"</b></p>"
                                                    "</div>";
                                                
                                                      parkmarker = L.marker([parkdata[i].s_lat,parkdata[i].s_lng],{icon: smallIcon}).addTo(map);


                                                       map.addLayer(parkmarker);


                                                 //   var group = new L.featureGroup([parkmarker]);

                                                     

                                                    parkmarker.bindPopup(popupContent);

                                                    parkmarkerss.push(parkmarker); 
                                                    


                                
                                                    
                                            }
                                            assetLayerGroup.addLayer(parkmarkerss);
                                        
                                        
                                   

                                    }
                                });

                        }




                        function moveMarker(lat, lng, counter,ign,odometer,speed,modified_date,angle)
                        {

                            
                                  //  console.log(lat+','+lng);
                                    var MarkerContent ="<div class='marker'>" +
                                    "Vehicle No: <b>"+ vehiclename +"</b>" +
                                    "<br>Speed : <b>"+ Math.round(speed) +"</b> Km/Hr"+
                                    
                                    "<br>Odometer : <b>"+ odometer +"</b>" +
                                    "<br>Date Time : <b>"+ modified_date +"</b>" +
                                   "</div>";
                                   var vehicle_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/green_arrow.png';
                                   var redIcon = new L.Icon({
                                    iconUrl: vehicle_path,
                                    iconSize:  [35, 35],
                                    });                            
                                     map.removeLayer(StartMarker);
                            
                                   
                                    // StartMarker = L.marker([lat, lng],{icon: redIcon,rotationAngle: angle}).addTo(map);
                                    StartMarker = L.marker([lat, lng]).addTo(map);
                                   // StartMarker = L.marker([lat, lng]).addTo(map);
                                     map.addLayer(StartMarker);

                                      var group = new L.featureGroup([StartMarker]);

                                     
                                  StartMarker.bindPopup(MarkerContent).openPopup();

                                    }
                }
                }

              
     // $('.single_vehicle_status').show();          //Show Single vehicle status
     function routelatlngs(map,data)
    {
     
            // var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bike.png';
   
        var routelist = data.route_latlng;
        var stop_latlng = data.stop_latlng;
     var redIcon = new L.Icon({
          iconUrl: image_path,
          iconSize:  [35, 35],
        });                       // Map custom icon set

  
                            var image_path = '<?php echo base_url(); ?>assets/dist/img/starts.png';
                            var image_path1 = '<?php echo base_url(); ?>assets/dist/img/finish.png';
                            var image_path2 = '<?php echo base_url(); ?>assets/dist/img/bus-icon.png';

                        var startm =[routelist.routestartlat,routelist.routestartlng];
                        var endm =[routelist.routeendtlat,routelist.routeendtlng];
                        
                        var redIcon = new L.Icon({
                                          iconUrl: image_path,
                                          iconSize:  [65, 65],
										  className: 'starticons',
                                        });

                         var redIcon1 = new L.Icon({
                                          iconUrl: image_path1,
                                          iconSize:  [65, 65],
                                        });

                                        var redIcon2 = new L.Icon({
                                          iconUrl: image_path2,
                                          iconSize:  [65, 65],
                                        });
                         // marker = L.marker(startCoords,{icon: redIcon,rotationAngle: angle}).addTo(map);

                        var startmarker =  L.marker(startm,{icon: redIcon}).addTo(map);
                        var start_routepopup = '<div style="width: 200px;"><b>Plan Time:</b> '+routelist.route_planstart_time+'<br><b>Actual Time:</b> <span style="color:red"><b>'+routelist.routestarttime+'</b></span><br><b>Start Point:</b> '+routelist.startroute_name+'<br></div>';
                         startmarker.bindPopup(start_routepopup);
                         L.circle(startm, {radius: routelist.sradius,color: 'green'}).addTo(map);
                    
                        var endmarker =  L.marker(endm,{icon: redIcon1}).addTo(map);
                        var end_routepopup = '<div style="width: 200px;"><b>Plan Time:</b> '+routelist.route_planend_time+'<br><b>Actual Time:</b> <span style="color:red"><b>'+routelist.routesendtime+'</b></span><br><b>Start Point:</b> '+routelist.endroute_name+'<br></div>';

                         endmarker.bindPopup(end_routepopup);
                         L.circle(endm, {radius: routelist.eradius,color: 'red'}).addTo(map);

                         console.log(stop_latlng.length);

                       

                         for (let i = 0; i < stop_latlng.length; i++) {

                            console.log(stop_latlng[i].stop_latlng.stoplat);
                           var stopmarker =  L.marker([stop_latlng[i].stop_latlng.stoplat,stop_latlng[i].stop_latlng.stoplng],{icon: redIcon2}).addTo(map);
                           stopmarker.bindPopup(stop_latlng[i].stop_latlng.stop_name);
                       

                           var stoppopup = '<div style="width: 200px;"><b style="color:green">No of Students: '+stop_latlng[i].student_count+'</b> &emsp;<a href="#" data-toggle="modal" data-target="#exampleModal" style="color:red">Show</a><br><b>Plan Time:</b> '+stop_latlng[i].stop_latlng.stopplaned_entry+'<br><b>Actual Time:</b> <span style="color:red"><b>'+stop_latlng[i].stop_latlng.stopentry_time+'</b></span><br><b>Start Point:</b> '+stop_latlng[i].stop_latlng.stop_name+'<br></div>';
                           stopmarker.bindPopup(stoppopup);

                           L.circle([stop_latlng[i].stop_latlng.stoplat,stop_latlng[i].stop_latlng.stoplng], {radius: stop_latlng[i].stop_latlng.stopradius,color: '#3a20ab'}).addTo(map);
                           startmarker1.push(stopmarker);  
                         }

                     map.addLayer(startmarker);
                    var group =new Array();
                    group = new L.featureGroup([startmarker,endmarker]);
                    map.fitBounds(group.getBounds());
                    startmarker1.push(startmarker);                       // marker data stored in array
                    startmarker1.push(endmarker);  
                   
//    assetLayerGroup.addLayer(speedmarkerss);

    }

    
</script>