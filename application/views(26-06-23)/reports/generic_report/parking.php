<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left: 0px;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Parking Report</h3>
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
              <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Parking Report</h4>
              <span class="pr-2">
                <i class="icon icon-settings"></i>
              </span>
            </div>
          </div>
          <div class="col-8 box-bordershado">
            <table id="parking" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Vehicle</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Total Time<br>
                                        <small>HH:MM:SS</small>
                                    </th>
                                     <th>Location</th>
                                     <th>Map <br>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count_sno = 1;
                                foreach ($vehicle_details as $value) { ?>
                                <tr>
                                    <td><?=$count_sno++;?></td>
                                    <td><?=$value['vehicle']; ?></td>
                                    <td><?php echo $value['start_date']; ?></td>
                                    <td><?php echo $value['end_date']; ?></td>
                                    <td><?php echo $value['time_dur']; ?></td>
                                    <td><?php echo $value['start_location']; ?></td>
                                    <td>
                                        <a href="#" onClick="parkingmap('<?php echo $value['report_id']?>');" >
                                        <img class="media-object" src="<?= base_url(); ?>app-assets\images\menuicon\29.svg" alt="image">
                                        </a>
                                        </td>
                                        </tr>
                                 <?php }  ?>
                            </tbody>
                        </table>
    
          </div>
            <div class="col-4">
                <div id="park_map" style="height:360px;width:100%;"> </div>
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
    <div class="modal fade text-left" style="background:radial-gradient(black, transparent)" id="parking_maps" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-tree"></i>Parking Map</h4>
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
                            <tr id="allcolumns">
                                    <td id="vehiclename"></td>
                                    <td id="start_day"></td>
                                    <td id="end_day"></td>
                                    <td id="time_duration"></td>
                                    <td id="start_location"></td>
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

<!--                <div id="park_map" style="height:300px;width:100%;"> </div>-->
            </div>
            
        </div>
    </div>
   
</div>
                </div>
                
            </div>
        </div>
      
    </div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#parking').DataTable({
            pageLength: 0,
            lengthMenu: [3, 5, 10, 20, 50, 100],
            dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
        ]
        });
     });
     
</script>
<script src="<?php echo base_url();?>assets/plugins/osm/leaflet.js"></script> 

<script type="text/javascript">

    var StartMarker1 = {};

                 map = L.map('park_map').setView([11.0467,76.9254],6);
    // L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:18}).addTo(map);
    layer = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            });
            map.addLayer(layer);
     $( document ).ready(function() {

   
   
        $('#idlereport').DataTable();
     });
      function parkingmap(gid)
        {

            $('#vehiclename').empty();
           $('#start_day').empty();
           $('#end_day').empty();
           $('#time_duration').empty();
           $('#start_location').empty(); 

      $.ajax({
        url: '<?php echo site_url('/Genericreport/parkdata_location/');?>'+gid,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
        //alert(data);
        console.log(data);

          $('#vehiclename').append(data.vehiclename);
           $('#start_day').append(data.start_day);
           $('#end_day').append(data.end_day);
           $('#time_duration').append(data.time_duration);
           $('#start_location').append(data.start_location);
           
           if (StartMarker1 != undefined) {
              map.removeLayer(StartMarker1);
            };

    
    
   var startCoords= [data.s_lat,data.s_lng];
   console.log(startCoords);


var url = 'http://198.204.245.190/nominatim/reverse?format=jsonv2&lat='+data.s_lat+'&lon='+data.s_lng;

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

                            StartMarker1 = L.marker(startCoords,{icon: redIcon}).addTo(map);


                        map.addLayer(StartMarker1);

                      var group = new L.featureGroup([StartMarker1]);

                      map.fitBounds(group.getBounds());

                     StartMarker1.bindPopup(marker_content).openPopup();
                        
                        
                    },
                    error:function(){
                    console.log('show status query not executed');
                    }
                }); 


        },error:function(){
          console.log('error');
        }
      });

         jQuery('#parking_maps').modal('hide', {
                    backdrop: 'static',
                    keyboard: false
            });
                $('.modal-body #genid').val(gid);
        }
</script>