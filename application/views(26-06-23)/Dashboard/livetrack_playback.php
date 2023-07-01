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
setInterval(smooth_move, 10000);  // after 10 second continuously call

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
        url:'<?php echo site_url('/Livetrack/single_vehicledata/');?>'+vehicle,     
                cache: false,
                type: 'POST',
                data: { 
                        vehicle: vehicle
                },
                success: function(data)
                { 
                    var obj = JSON.parse(data);
                    single_vehicle_route(map,obj);
                }
            });
              

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


                
     // $('.single_vehicle_status').show();          //Show Single vehicle status
      function single_vehicle_route(map,data)
    {
     
         $("#pre_lat").empty();
         $("#pre_lng").empty();
          $("#pre_angle").empty();

      if (StartMarker != undefined) {
              map.removeLayer(StartMarker);
            };

        var location_lat = parseFloat(data.lat);
        var location_lng = parseFloat(data.lng);

        var angle=data.angle;

        var v_u_time = parseInt(data.update_time);
        var v_acc_on = parseInt(data.acc_on);
        var v_speed = parseInt(data.speed);
            if(data.updatedon!=null && data.updatedon!='')
                {
                    if(v_u_time <= 10 && v_u_time!=null)
                    {
                     if(v_acc_on ==  1)
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
             var vehicle_shortname = data.vehicle_shortname+'.png';
           
           if(v_u_time <= 10)
                {
                    if(v_acc_on == 1)
                    {
                      if(v_speed >0)
                      {
                             // Vehicle Running Icon
                        var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/'+vehicle_shortname;
                            
                      }
                      else
                      {
                              // Vehicle Idle Icon
                        var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/'+vehicle_shortname;
                      }

                    }
                    else
                    {

                       // Vehicle Parking Icon
                       var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/'+vehicle_shortname;
                     
                    }
                  
                }
                else
                {
                
                   // Vehicle No Network Icon
                   var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/'+vehicle_shortname;

                  
                }
                        
var startCoords= [location_lat,location_lng];    // lattitute and Longitute stored as a array
//alert(startCoords);
        
          $('#pre_lat').val(location_lat);     // append current lattitute
          $('#pre_lng').val(location_lng);      // append current longitute
           $('#pre_angle').val(angle);         // // append current angle
     var redIcon = new L.Icon({
          iconUrl: image_path,
          iconSize:  [35, 35],
        });                       // Map custom icon set

  
 var marker = L.marker(startCoords,{icon: redIcon,rotationAngle: angle}).addTo(map);         // marker add to map 

        map.addLayer(marker);                // marker append to the map
// console.log(marker);
        var group =new Array();
       group = new L.featureGroup([marker]);          

      map.fitBounds(group.getBounds());                // fixed all layers in zooming

    marker.bindPopup(marker_content);       // open popup box in map with marker contect

    speedmarkerss.push(marker);                       // marker data stored in array
   assetLayerGroup.addLayer(speedmarkerss);

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
                         //   console.log(obj[i].vehicle_no);
                           latlngs.push([obj[i].lat_message, obj[i].lon_message]);
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
                        
                        var arrowHead = L.polylineDecorator(polyline, {
                        patterns: [
                            {offset: 25, repeat: 50, symbol: L.Symbol.arrowHead({pixelSize: 10, pathOptions: {color: '#23ba71',fillOpacity: 1, weight: 0}})}
                        ]
                    }).addTo(map);

                        map.fitBounds(polyline.getBounds());
                           polylinemarkers.push(polyline); 
                            polylinemarkers.push(arrowHead); 
                          assetLayerGroup.addLayer(polylinemarkers);
                                               

                }
                }

 function smooth_move(){

// var id = $('#vehicleid').val();
var vehicle = $('#vehicleid').val();

$.ajax({
        url:'<?php echo site_url('/Livetrack/single_vehicledata/');?>'+vehicle,     
                cache: false,
                type: 'POST',
                data: { 
                        vehicle: vehicle
                },
                success: function(data)
                { 
                   // alert(data);
                    var obj = JSON.parse(data);
                
                    single_vehicle_route1(map,obj);
                }
            });
              

}



function single_vehicle_route1(map,data)
    {
        speedmarkerss.forEach(function (item) {
                        map.removeLayer(item)
                    });
    //   if (speedmarkerss != undefined) {
    //           map.removeLayer(speedmarkerss);
    //         };

        var location_lat = parseFloat(data.lat);
        var location_lng = parseFloat(data.lng);

        var angle=data.angle;

        var v_u_time = parseInt(data.update_time);
        var v_acc_on = parseInt(data.acc_on);
        var v_speed = parseInt(data.speed);
            if(data.updatedon!=null && data.updatedon!='')
                {
                    if(v_u_time <= 10 && v_u_time!=null)
                    {
                     if(v_acc_on ==  1)
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
             var vehicle_shortname = data.vehicle_shortname+'.png';
           
           if(v_u_time <= 10)
                {
                    if(v_acc_on == 1)
                    {
                      if(v_speed >0)
                      {
                             // Vehicle Running Icon
                        var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/'+vehicle_shortname;
                            
                      }
                      else
                      {
                              // Vehicle Idle Icon
                        var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/'+vehicle_shortname;
                      }

                    }
                    else
                    {

                       // Vehicle Parking Icon
                       var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/'+vehicle_shortname;
                     
                    }
                  
                }
                else
                {
                
                   // Vehicle No Network Icon
                   var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/'+vehicle_shortname;

                  
                }
                        
          
var startCoords= [location_lat,location_lng];



      var  pre_lat= $('#pre_lat').val();
      var pre_lng = $('#pre_lng').val();
      var pre_angle = $('#pre_angle').val();

      var pre_latlng1 = [parseFloat(pre_lat),parseFloat(pre_lng)];
      //  console.log(pre_latlng1);
      markerlatlng.push(pre_latlng1);

var redIcon = new L.Icon({
          iconUrl: image_path,
          iconSize:  [35, 35],
        });

            marker = L.marker(pre_latlng1,{icon: redIcon,rotationAngle: angle}).addTo(map);

        map.addLayer(marker);

        var group =new Array();
       group = new L.featureGroup([marker]);

      map.fitBounds(group.getBounds());

    marker.bindPopup(marker_content);

        $('#pre_lat').empty().val(location_lat);
        $('#pre_lng').empty().val(location_lng);
         $('#pre_angle').empty().val(angle);


         speedmarkerss.push(marker); 
   assetLayerGroup.addLayer(speedmarkerss);


    if(v_acc_on == 1)
                    {
                      if(v_speed >0)
                      {

        marker.slideTo(startCoords,{rotationAngle:angle,duration:20000, keepAtCenter: true});
        var polyline = L.polyline(markerlatlng, {strokeColor: 'rgba(0, 128, 255, 0.7'}).addTo(map);
      //  console.log(markerlatlng);
        var arrowHead = L.polylineDecorator(polyline, {
                        patterns: [
                            {offset: 25, repeat: 50, symbol: L.Symbol.arrowHead({pixelSize: 10, pathOptions: {color: '#23ba71',fillOpacity: 1, weight: 0}})}
                        ]
                    }).addTo(map);
     
          map.fitBounds(polyline.getBounds());

         polylinemarkers.push(polyline); 
         polylinemarkers.push(arrowHead); 


      }
    }

    }

      

              
     // $('.single_vehicle_status').show();          //Show Single vehicle status
     function routelatlngs(map,data)
    {
     
            var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bike.png';
   
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
                         startmarker.bindPopup(routelist.startroute_name);
                        var endmarker =  L.marker(endm,{icon: redIcon1}).addTo(map);
                         endmarker.bindPopup(routelist.endroute_name);

                         for (let i = 0; i < stop_latlng.length; i++) {
                           var stopmarker =  L.marker([stop_latlng[i].stoplat,stop_latlng[i].stoplng],{icon: redIcon2}).addTo(map);
                           stopmarker.bindPopup(stop_latlng[i].stop_name);

                           parkmarkerss.push(stopmarker);  
                         }

                     map.addLayer(startmarker);
                    var group =new Array();
                    group = new L.featureGroup([startmarker]);
                    map.fitBounds(group.getBounds());
                         parkmarkerss.push(startmarker);                       // marker data stored in array
                        parkmarkerss.push(endmarker);  
                   
//    assetLayerGroup.addLayer(speedmarkerss);

    }

    
</script>