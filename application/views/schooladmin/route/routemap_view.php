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

        <input type="hidden" id="route_id" value="<?php echo $route_id;?>">
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
                                    <div id="playback_map" style="height:700px;width:100%;"></div>
                                    <button type="button" id='back' class="badge bg-blue pull-right">
                                    
                                    <a href="<?php echo base_url('Route/');?>" ><h3 style="color:white;">Back</h3></a>
                                </button>
                                   
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
        <h5 class="modal-title" id="exampleModalLabel">Student List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="stopstulist">
          <table id = "stustoplist" class="table table-striped table-bordered">
            <thead class='bg-primary'>
              <tr>
              <th>Studentname</th>
              <th>Roll No</th>
              <th>class</th>
              <th>Section</th>
              </tr>
            </thead>
            <tbody id = "stustoplist_body">
              
           </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  zoom: 16,
  minZoom: 1,
});

// create a new tile layer
//var tileUrl = 'http://198.204.245.190/osm/{z}/{x}/{y}.png',
var Google_layer = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            });
//layer = new L.TileLayer(tileUrl);

// add the layer to the map
map.addLayer(Google_layer);
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
          var route_id = $('#route_id').val();
          var from_date,to_date;
          from_date = $('#from_date').val();
      //  alert(from_date);
          to_date = $('#to_date').val();



      $.ajax({
              url:'<?php echo site_url('/Route/routelatlngs/');?>',     
                      cache: false,
                      type: 'POST',
                      data: { 
                          route_id: route_id
                      },
                      success: function(data)
                      { 
                        
                          var obj = JSON.parse(data);
                      
                          routelatlngs(map,obj);
                        //  alert(data);
                      }
                  });


   
}

              
     // $('.single_vehicle_status').show();          //Show Single vehicle status
     function routelatlngs(map,data)
    {
     
            // var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/bike.png';
   
        var routelist = data.route_latlng;
        var stop_latlng = data.stop_latlng;
        console.log(stop_latlng);
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

                        // var startmarker =  L.marker(startm,{icon: redIcon2}).addTo(map);
                        // var start_routepopup = '<div style="width: 200px;"><b>Start Point:</b> '+routelist.startroute_name+'<br></div>';
                        //  startmarker.bindPopup(start_routepopup);
                        //  L.circle(startm, {radius: routelist.sradius,color: 'green'}).addTo(map);
                    
                        // var endmarker =  L.marker(endm,{icon: redIcon2}).addTo(map);
                        // var end_routepopup = '<div style="width: 200px;"><b>End Point:</b> '+routelist.endroute_name+'<br></div>';

                        //  endmarker.bindPopup(end_routepopup);
                        //  L.circle(endm, {radius: routelist.eradius,color: 'red'}).addTo(map);

                        //  console.log(stop_latlng.length);

                       

                        for (let i = 0; i < stop_latlng.length; i++) {

                            //console.log(stop_latlng[i].stop_latlng.stoplat);
                           var stopmarker =  L.marker([stop_latlng[i].stop_latlng.stoplat,stop_latlng[i].stop_latlng.stoplng],{icon: redIcon2}).addTo(map);
                           stopmarker.bindPopup(stop_latlng[i].stop_latlng.stop_name);
                       
                           var stoppopup = '<div style="width: 200px;"><b style="color:brown">S:No:' + stop_latlng[i].route_no + '<br><b style="color:green">N.O.S: '+stop_latlng[i].student_count+'</b> &emsp;<a href="javascript:studentlist('+stop_latlng[i].stop_latlng.stop_id+')"  style="color:red">Show</a><br><b style="color:blue">Start Point:</b> '+stop_latlng[i].stop_latlng.stop_name+'<br></div>';
                          //  var stoppopup = '<div style="width: 200px;"><b style="color:brown">S:No:' + stop_latlng[i].route_no + '<br><b style="color:green">N.O.S: '+stop_latlng[i].student_count+'</b> &emsp;<a href="javascript:studentlist('+stop_latlng[i].stop_latlng.stop_id+')"  style="color:red">Show</a><br><b style="color:blue">Start Point:</b> '+stop_latlng[i].stop_latlng.stop_name+'<br></div>';
                        

                           stopmarker = new L.marker([stop_latlng[i].stop_latlng.stoplat,stop_latlng[i].stop_latlng.stoplng],{icon: redIcon2})
                            .bindPopup(stoppopup,{autoClose:false})
                            .addTo(map);
                            // .openPopup();
                            
                           
                          //  p = new L.Popup({ autoClose: false, closeOnClick: false })
                          //             .setContent(stoppopup)
                          //             .setLatLng([stop_latlng[i].stop_latlng.stoplat]);
                          // m.bindPopup(p);

                          

                          //  L.circle([stop_latlng[i].stop_latlng.stoplat,stop_latlng[i].stop_latlng.stoplng], {radius: stop_latlng[i].stop_latlng.stopradius,color: '#3a20ab'}).addTo(map);
                          //  startmarker1.push(stopmarker);  
                        }

                     map.addLayer(startmarker1);
                    var group =new Array();
                    // group = new L.featureGroup([startmarker,endmarker,stopmarker]);
                    group = new L.featureGroup([stopmarker]);
                    map.fitBounds(group.getBounds());
                    // startmarker1.push(startmarker);                       // marker data stored in array
                    // startmarker1.push(endmarker);  
                   
//    assetLayerGroup.addLayer(speedmarkerss);

    }

function studentlist(stopid)
{
 
  var route_id = <?php echo $route_id; ?>;
 

$.ajax({
        url:'<?php echo site_url('/Route/stop_students/');?>',     
                cache: false,
                type: 'POST',
                data: { 
                    route_id: route_id,
                    stopid: stopid
                },
                success: function(data)
                { 
                  
                
                    var obj = JSON.parse(data);
                  
                    $('#stustoplist_body').empty();

                    $.each(obj, function (y, z) {

                        console.log(y);
                          var row = "<tr>"
                          row += "<td>" + z.student_name + "</td> <td>" + z.student_rollno + "</td><td>" + z.class_name + "</td> <td>" + z.section_name + "</td>";
                          row += "</tr>";

                          $('#stustoplist').append($(row));

                          });

                }
            });


  

  $('#exampleModal').modal();

                
}

    
</script>