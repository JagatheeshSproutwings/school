<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left: 0px;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Fuel refill/drain Report </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Home</a> </li>
                                <li class="breadcrumb-item active">Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                    <div class="row">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
    <div class="card info-time-tracking">
      <div class="card-content">
        <div class="row">
          <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
            <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
              <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Fuel refill/drain Report</h4>
              <span class="pr-2">
                <i class="icon icon-settings"></i>
              </span>
            </div>
          </div>
         <div class="col-8 box-bordershado">
            <?php 
                    foreach ($vehicle_details as $vkey => $v_value) {?>
              <div class='panelcolor'>
                  <h6>Vehicle Name:  <?php echo $vkey;?> </h6> 
                            
              </div>
            <table id="distancereport" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Start Fuel</th>
                                    <th>End Fuel</th>
                                     <th>Fuel Diff</th>
                                    <th>Type</th>
                                     <th>Time</th>
                                       <th>Location</th>
                                     <th>Map View</th>
                                </tr>
                            </thead>
                           <tbody class='tbody' id='tbody'>

                                        <?php $sno=1; 
                                           if($v_value['fuel_data']){
                                            for ($i=0; $i <count($v_value['fuel_data']) ; $i++) { 
                                        
                                            $lat = $v_value['fuel_data'][$i]->lat;
                                             $lng = $v_value['fuel_data'][$i]->lng;
                                             $link = "'$lat',"."'$lng'";
                                        //     
                                         ?>
                                            
                                      
                                        <tr>
                                            <td><?php echo $sno;?></td>
                                            <td><?php echo $v_value['fuel_data'][$i]->start_fuel;?></td>
                                            <td><?php echo $v_value['fuel_data'][$i]->end_fuel;?></td>
                                            <td><?php echo $v_value['fuel_data'][$i]->difference_fuel;?></td>
                                            <td><?php if($v_value['fuel_data'][$i]->type_id=='2'){echo "Fill";} if($v_value['fuel_data'][$i]->type_id=='1'){echo "Dip";}?></td>
                                            <td><?php echo $v_value['fuel_data'][$i]->created_on;?></td>
                                            <td><?php echo $v_value['fuel_data'][$i]->location_name;?></td>
                                            <td>
                                        <a href="#" onClick="onMapClick(<?php echo $lat;?>,<?php echo $lng;?>);">
                                        <img class="media-object" src="<?= base_url(); ?>app-assets\images\menuicon\29.svg" alt="image">
                                        </a>
                                        </td>
                                        </tr>
                                            
                                     <?php $sno++;} }
                                        ?> 

                                     <!--    <tr>
                                            <td></td>
                                            <td style=" text-align: right; font-weight: bold;">Total Distance</td>
                                            <td style=" font-weight: bold;"><?= $total_dis; ?></td>
                                        </tr> -->

                                      </tbody>
                        </table>
         <?php }  ?>
          </div>
          <div class="col-4">
                 <div id="fuelfilldip" style="height:450px;width:100%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>                        
                         
            </div>

        </div>
      </div>
    </div>
        <!-- BEGIN Vendor JS-->
    <div class="modal fade text-left" style="background:radial-gradient(black, transparent)" id="fueldip_maps" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-tree"></i>Fuel ReFill & Drain Map</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="row match-height">
                        <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-content">
                <div id="goal-list-scroll" class="table-responsive position-relative">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                    <th class="parkingth">Vehicle</th>
                                    <th class="parkingth">Start date</th>
                                    <th class="parkingth">End date</th>
                                    <th class="parkingth">Total Time<br>
                                        <small>HH:MM:SS</small>
                                    </th>
                                     <th class="parkingth">Location</th>
                                </tr>
                        </thead>
                        <tbody>
                            <tr>
                                    <td>TN 37 AZ 4590</td>
                                    <td>2021-01-04 12:49:31</td>
                                    <td>2021-01-04 12:49:31</td>
                                    <td>00:21:00</td>
                                    <td>NH44, Kareli Tahsil, Narsimhapur, Madhya Prad</td>
                                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                Map view show
            </div>
            
        </div>
    </div>
   
</div>
                </div>
                
            </div>
        </div>
      
    </div>
  <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.js"></script> 
  <script>
       var StartMarker = {};

                 map = L.map('fuelfilldip').setView([11.0467,76.9254],6);
    L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:18}).addTo(map);
  </script>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#parking').DataTable();
     });
     
      function onMapClick(s_lat,s_lng) 
{
// alert($lat);
// alert($lng);
     if (StartMarker != undefined) {
              map.removeLayer(StartMarker);
            };
    
   var startCoords= [s_lat,s_lng];


var url = 'http://198.204.245.190/nominatim/reverse?format=jsonv2&lat='+s_lat+'&lon='+s_lng;

 $.ajax({
                    url: url,
                    type: 'GET',     
                    cache: false,
                    success: function(data){ 
                        
                        map.setZoom(10);

                        var array = $.map(data, function(value, index) {
                            return [value];
                        });

                        var mark_img = '<?php echo base_url(); ?>assets/dist/img/icon/marker_loc.png';

                        var marker_content = array[12];

                        var redIcon = new L.Icon({
                          iconUrl: mark_img
                        });

                            StartMarker = L.marker(startCoords,{icon: redIcon}).addTo(map);


                        map.addLayer(StartMarker);

                      var group = new L.featureGroup([StartMarker]);

                      map.fitBounds(group.getBounds());

                     StartMarker.bindPopup(marker_content).openPopup();
                        
                        
                    },
                    error:function(){
                    console.log('show status query not executed');
                    }
                }); 

}

   
</script>