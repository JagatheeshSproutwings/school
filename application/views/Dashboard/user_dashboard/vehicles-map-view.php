<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/osm/leaflet.css"/>-->
<style>
  .databottom td {
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    padding-left: 0 !important;
  }

  body.vertical-layout.vertical-menu-modern.menu-collapsed .navbar .navbar-header.expanded {
    width: 105px !important;
    z-index: 1000;
  }

  .dataTables_info {
    display: none;
  }

  .dataTables_length {
    display: none;
  }

  .dataTables_filter {
    margin: -2px 45px;
  }

  .form-control form-control-sm {
    width: 200px !important;
  }

  .wrapper {
    background: #456173;
    display: flex;
    width: 105%;
  }

  .datacards {
    /*padding-top: 15px;*/
    padding-top: 0px;
    background: #fff;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    display: grid;
    grid-gap: 1rem;
    grid-auto-flow: column;
    grid-auto-columns: calc(25% - 2rem);
    /* min-height: 40vh; */
    width: 100%;
  }

  .datacards-content {
    /*align-items: center;*/
    background: #fff;
    border-radius: 1rem;
    color: #111;
    display: flex;
    /*font-weight: 900;*/
    /*justify-content: center;*/
    /*font-size: 5rem;*/
    /*text-transform: uppercase;*/
  }

  .datacards-content:last-child {
    margin-right: 1rem;
  }
</style>
<!-- Column selectors table -->
<section id="column-selectors" style="margin: 0px -14px">
  <div class="row1">
    <div class="col-121">
      <div class="card" style="margin: 0px !important">
        <div class="card-content collapse show">
          <div class="card-body1 card-dashboard">
            <div id="single_map" style="width:100%;height: 55vh !important;">

            </div>
            <div class="content-wrapper1 single_vehicle_status">
              <div class="content-body1"><!-- Search form-->
                <section id="search-website" class="card1 overflow-hidden">
                  <div class="card-header1">
                    <div class="col-xl-12 col-lg-12 col-12">
                      <div class="card1">
                        <div class="card-content" style="margin-left: -15px;">
                          <div class="col-md-121">
                            <ul class="nav nav-tabs nav-topline" role="tablist">
                              <!--<ul class="nav nav-tabs nav-linetriangle" role="tablist" style="width: 50%">-->
                              <li class="nav-item">
                                <a class="nav-link active" id="baseIcon-tab31" data-toggle="tab" aria-controls="tabIcon31" href="#tabIcon31" role="tab" aria-selected="true"><i class="fa fa-play"></i>Full Data</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="baseIcon-tab32" data-toggle="tab" aria-controls="tabIcon32" href="#tabIcon32" role="tab" aria-selected="false"><i class="fa fa-flag"></i>Alerts</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="baseIcon-tab33" data-toggle="tab" aria-controls="tabIcon33" href="#tabIcon33" role="tab" aria-selected="false"><i class="fa fa-cog"></i>Packets</a>
                              </li>

                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tabIcon31" role="tabpanel" aria-labelledby="baseIcon-tab31">
                                <div class="wrapper">
                                  <section class="datacards" style="height: 125px;"> <!-- height175 to 125 change-->
                                    <div class="datacards-content">
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                                          <tbody>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>On Duration:
                                                </div>
                                                <div style='float: right; text-align: right'><span id="onduration"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Vehicle Number
                                                </div>
                                                <div style='float: right; text-align: right'><span id="vehicleNo"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>AC Status
                                                </div>
                                                <div style='float: right; text-align: right'><span id="ac_status"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\3.svg" width="25" alt=""></span>Vehicle Status
                                                </div>
                                                <div style='float: right; text-align: right'><span id="vehicle_status"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\4.svg" width="25" alt=""></span>Odometer
                                                </div>
                                                <div style='float: right; text-align: right'><span id="odometer"></span></div>
                                              </td>
                                            </tr>

                                          </tbody>
                                        </table>
                                      </div>
                                    </div>


                                    <div class="datacards-content">
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                                          <tbody>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Fuel:
                                                </div>
                                                <div style='float: right; text-align: right'><span id="fuel_ltr"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Today KM:
                                                </div>
                                                <div style='float: right; text-align: right'><span id="today_km"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>Driver Name
                                                </div>
                                                <div style='float: right; text-align: right'><span id="ac_status"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\3.svg" width="25" alt=""></span>Altitute :
                                                </div>
                                                <div style='float: right; text-align: right'><span id="altitute"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\4.svg" width="25" alt=""></span>GPS Signal :
                                                </div>
                                                <div style='float: right; text-align: right'><span id="gpssignal"></span></div>
                                              </td>
                                            </tr>

                                          </tbody>
                                        </table>
                                      </div>
                                    </div>

                                    <div class="datacards-content">
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                                          <tbody>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Main Battery:
                                                </div>
                                                <div style='float: right; text-align: right'><span id="devicebattery"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Internal Battery :
                                                </div>
                                                <div style='float: right; text-align: right'><span id="car_battery"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>Internal Battery Voltage :
                                                </div>
                                                <div style='float: right; text-align: right'><span id="internal_battery_voltage"></span></div>
                                              </td>
                                            </tr>



                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                    <div class="datacards-content">
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                                          <tbody>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>GSM Signal:
                                                </div>
                                                <div style='float: right; text-align: right'><span id="gsmsignal"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="<?php if ($access_menu->hour_meter == '0') {
                                                          echo "hidden";
                                                        } ?> databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\1.svg" width="25" alt=""></span>Hour Meter:
                                                </div>
                                                <div style='float: right; text-align: right'><span id="vehicleNo"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom <?php if ($access_menu->hour_meter == '0') {
                                                                    echo "hidden";
                                                                  } ?>">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\2.svg" width="25" alt=""></span>Today Running Duration
                                                </div>
                                                <div style='float: right; text-align: right'><span id="ac_status"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom mdvr_terminal_no hidden">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\3.svg" width="25" alt=""></span>MDVR
                                                </div>
                                                <div style='float: right; text-align: right'><span id="vehicle_status"></span></div>
                                              </td>
                                            </tr>
                                            <tr class="databottom">
                                              <td>
                                                <div style='float: left; text-align: left'>
                                                  <span><img src="<?php echo base_url(); ?>app-assets\images\menuicon\4.svg" width="25" alt=""></span>Address:
                                                </div>
                                                <div style='float: right; text-align: right'><span id="address"></span></div>
                                              </td>
                                            </tr>


                                          </tbody>
                                        </table>
                                      </div>
                                    </div>



                                    <div class="<?php if ($access_menu->obd_report == '0') {
                                                  echo "hidden";
                                                } ?>">
                                      <div class="datacards-content">
                                        <div class="table-responsive">
                                          <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                                            <tbody>
                                              <tr>
                                                <td>
                                                  <div style='float: left; text-align: left'>Dash Odometer</div>
                                                  <div style='float: right; text-align: right'><span id="dash"></span></div>
                                                </td>
                                              </tr>

                                              <tr>
                                                <td>
                                                  <div style='float: left; text-align: left'>Engine Speed</div>
                                                  <div style='float: right; text-align: right'><span id="devicebattery"></span></div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  <div style='float: left; text-align: left'>Coolant Level</div>
                                                  <div style='float: right; text-align: right'><span id="car_battery"></span></div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  <div style='float: left; text-align: left'>Engine Load :</div>
                                                  <div style='float: right; text-align: right'><span id="internal_battery_voltage"></span></div>
                                                </td>
                                              </tr>

                                              <tr class="databottom">
                                                <td>
                                                  <div style='float: left; text-align: left'>
                                                    <span>Coolant Temperature:</span>
                                                  </div>
                                                  <div style='float: right; text-align: right'><span id="vehicle_stat1us"></span></div>
                                                </td>
                                              </tr>
                                              <tr class="databottom">
                                                <td>
                                                  <div style='float: left; text-align: left'>
                                                    <span>Last Updated Time:</span>
                                                  </div>
                                                  <div style='float: right; text-align: right'><span id="odomete1r"></span></div>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>


                                    <div class="<?php if ($access_menu->temperature_report == '0') {
                                                  echo "hidden";
                                                } ?>">
                                      <div class="datacards-content">
                                        <div class="table-responsive">
                                          <table class="table table-bordered table-striped" style="margin: 0;font-size: 10px">
                                            <tbody>
                                              <tr>
                                                <td>
                                                  <div style='float: left; text-align: left'>Temperature &emsp;</div>
                                                  <div style='float: left; text-align: left'><span id="temp_value"></span></div>
                                                </td>
                                              </tr>

                                              <!-- <tr>
                                <td>
                                    <div style='float: left; text-align: left'>Temp Datetime</div>
                                    <div style='float: right; text-align: right'><span id="temp_datetime"></span></div>
                                </td>
                            </tr> -->

                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>





                                  </section>
                                </div>
                              </div>
                              <div class="tab-pane" id="tabIcon32" role="tabpanel" aria-labelledby="baseIcon-tab32">

                                <div class="datacards-content">
                                  <div class='table-responsive'>
                                    <article class="card-group-item">
                                      <!--   <header class="card-header1">
                                                                                <h6 class="title" style='background-color: #f2efe9;color: black;padding: 5px 3px;'>Alerts</h6>
                                                                            </header> -->
                                      <div class="filter-content" style="height: 170px;">
                                        <div class="list-group list-group-flush">
                                          <div id="alertreport" style="width:25%">

                                          </div> <!-- list-group .// -->
                                        </div>
                                      </div>
                                    </article>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane" id="tabIcon33" role="tabpanel" aria-labelledby="baseIcon-tab33">
                                <div class="datacards-content">
                                  <div class='table-responsive'>
                                    <article class="card-group-item">
                                      <!--   <header class="card-header1">
                                                                                <h6 class="title" style='background-color: #f2efe9;color: black;padding: 5px 3px;'>Alerts</h6>
                                                                            </header> -->
                                      <div class="filter-content" style="height: 170px;">
                                        <div class="list-group list-group-flush">
                                          <div id="alertreport" style="width:25%">
                                            Coming Soon
                                          </div> <!-- list-group .// -->
                                        </div>
                                      </div>
                                    </article>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--/ Search form -->

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo base_url(); ?>assets/plugins/osm/leaflet.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/osm/leaflet.rotatedMarker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/osm/Leaflet.Marker.SlideTo.js"></script>


<!-- BEGIN Vendor JS-->
<script type="text/javascript">
  var marker;
  var markers = [];
  map = L.map('single_map').setView([11.0467, 76.9254], 8);
  // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  //   maxZoom: 16
  // }).addTo(map);
  layer = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
      maxZoom: 15,
      subdomains:['mt0','mt1','mt2','mt3']
  });
  map.addLayer(layer);

  $(document).ready(function() {
    $.ajax({
      url: '<?php echo site_url('/Dashboard/get_geofence/'); ?>',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        var marker =  L.marker()
        $.each(data, function(i, item) {
          console.log(item);
         var fence = L.circle([item.Lat, item.Lng], parseInt(item.radius)).addTo(map);
         fence.bindPopup(item.Location_short_name);
        });

      }
    });
  });


  var fg = L.featureGroup().addTo(map);
  var assetLayerGroup = new L.LayerGroup();

  $(document).ready(function() {

    update_all_data();
    setInterval(smooth_move, 10000);

  });

  function update_all_data() {

    var id = $('#selected_vid').val();
    // alert(id);
    $.ajax({
      url: '<?php echo site_url('/Dashboard/single_vehicle_loc/'); ?>' + id, //get current ignition route from db
      type: 'GET',
      dataType: "json",
      success: function(data) {


        // alert(data);
        set_vehicle(data);
        var e_lat = data.lat;
        var e_lng = data.lng;

      },
      error: function() {
        console.log('error');
      }
    });


    $.ajax({
      url: '<?php echo site_url('/Dashboard/alert_data/'); ?>' + id, //get current ignition route from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        //   alert(data);
        alert_vehicle(data);

      },
      error: function() {
        console.log('error');
      }
    });


    $.ajax({
      url: '<?php echo site_url('/Dashboard/single_vehicle_loc/'); ?>' + id, //get current ignition route from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        //alert(data);
        //console.log(data);
        single_vehicle_route(map, data);
        var e_lat = data.lat;
        var e_lng = data.lng;

      },
      error: function() {
        console.log('error');
      }
    });

    // $('.single_vehicle_status').show();          //Show Single vehicle status
    function single_vehicle_route(map, data) {
      $("#pre_lat").empty();
      $("#pre_lng").empty();
      $("#pre_angle").empty();

      if (marker != undefined) {
        map.removeLayer(marker);
      };

      var location_lat = parseFloat(data.lat);
      var location_lng = parseFloat(data.lng);

      var angle = data.angle;

      var v_u_time = parseInt(data.update_time);
      var v_acc_on = parseInt(data.acc_on);
      var v_speed = parseInt(data.speed);

      var vehicle_sleep = parseInt(data.vehicle_sleep);

      if (data.updatedon != null && data.updatedon != '') {
        if (v_u_time <= 10 && v_u_time != null) {
          if (vehicle_sleep == 3) {
            var status_cont = 'PARKING';
            color = '#147fc7';

            var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Speed:</b> ' + Math.round(data.speed) + ' km/hr <br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt  <br/><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '<br></div>';
          } else if (v_acc_on == 1) {
            if (v_speed > 0) {
              var status_cont = 'MOVING';
              color = '#00a65a';

              var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Speed:</b> ' + Math.round(data.speed) + ' km/hr <br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt  <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '<br></div>';


            } else {
              var status_cont = 'IDLE';
              color = '#fabf2c';
              var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

            }
          } else {
            var status_cont = 'PARKING';
            color = '#337ab7';
            var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

          }
        } else {
          var status_cont = 'GSM Lost';
          color = '#a89e9e';
          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery: </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

        }
      } else {
        var status_cont = 'GSM Lost';
        color = '#a89e9e';
        var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery: </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

      }
      var vehicle_type = parseInt(data.vehicle_type);
      var vehicle_shortname = data.vehicle_shortname;

      var image_path;
      if (v_u_time <= 10) {
        if (v_acc_on == 1) {
          if (v_speed > 0) {

            var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/' + vehicle_shortname + '.png';
          } else {
            var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/' + vehicle_shortname + '.png';

          }

        } else {
          var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/' + vehicle_shortname + '.png';


        }

      } else {
        var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/' + vehicle_shortname + '.png';

      }


      var startCoords = [location_lat, location_lng];
      //alert(startCoords);

      $('#pre_lat').val(location_lat);
      $('#pre_lng').val(location_lng);
      $('#pre_angle').val(angle);



      var redIcon = new L.Icon({
        iconUrl: image_path,
        iconSize: [35, 35],
      });




      marker = L.marker(startCoords, {
        icon: redIcon,
        rotationAngle: angle
      }).addTo(map);


      map.addLayer(marker);

      var group = new Array();
      group = new L.featureGroup([marker]);

      map.fitBounds(group.getBounds());

      marker.bindPopup(marker_content).openPopup();

      markers.push(marker);
      assetLayerGroup.addLayer(markers);

      // get_current_address(location_lat,location_lng);

    }




    function alert_vehicle(data) {

      // alert(data);
      $('#alertreport').empty();
      for (var i = 0; i < data.length; i++) {
        $('#alertreport').append("<a style='padding: 1px 4px'>" + data[i].alert_type + "<span class='float-right'>" + data[i].createdon + "</span> </a><br>");
      }


    }

    update_status_table3();


  }



  function update_status_table() {



    $.ajax({
      url: '<?php echo site_url('/Dashboard/all_vehicle_loc/'); ?>', //get current loc of all vehicle from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);

        for (var j = 0; j < data.length; j++) {
          var v_u_time = parseInt(data[j].update_time);
          var v_acc_on = parseInt(data[j].acc_on);
          var v_speed = parseInt(data[j].speed);

          switch (data[j].vehicle_type) { //get vehicle type

            case '1':
              var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
              break;
            case '2':
              var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
              break;
            case '3':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            case '4':
              var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
              break;
            case '5':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            default:
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

          }

          var vehicle_sleep = parseInt(data[j].vehicle_sleep);

          if (v_u_time <= 10) {
            if (vehicle_sleep == 3) {
              var image = '<span style="color:#147fc7">' + image_path + '</span>&nbsp;';
              var status_cont = 'PARKING';
            } else if (v_acc_on == 1) {
              if (v_speed > 0) {
                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15) {
                  var image = '<span style="color:green">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:green">' + image_path + '</span>&nbsp;';
                  var status_cont = 'MOVING';
                }
              } else {

                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15) {
                  var image = '<span style="color:#fabf2c">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:#fabf2c">' + image_path + '</span>&nbsp;';
                  var status_cont = 'IDLE';
                }

              }
            } else {
              if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15) {
                var image = '<span style="color:blue">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                var status_cont = 'PARKING';
              } else {
                var image = '<span style="color:blue">' + image_path + '</span>&nbsp;';
                var status_cont = 'PARKING';
              }

            }
            //alert('hi');
          } else {
            if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15) {
              var image = '<span style="color:#a89e9e">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
              var status_cont = 'MOVING';
            } else {
              var image = '<span style="color:#a89e9e">' + image_path + '</span>&nbsp;';
              var status_cont = 'GSM Lost';
            }

          }
          var img_cont = image;



          var vehic_upt = 'vehic_upt' + data[j].vehicleid;
          if (data[j].updatedon) {
            var update_valu = data[j].updatedon;
          } else {
            var update_valu = '____:__:__ __:__:__';
          }
          $('#' + vehic_upt).empty().html(update_valu);
          var vehic_status = 'vehic_status' + data[j].vehicleid;
          $('#' + vehic_status).empty().html(img_cont);


          // var tr_row = '<tr class="tr-a vid_val" id="vid_'+data[j].vehicleid+'" onclick="selectone( '+data[j].vehicleid+');"><td class="tdth text-center status_running" id="vehic_status_'+data[j].vehicleid+'">'+img_cont+'</td><td style="text-align: left !important;font-size: 12px;" class="tdth text-center"> <p id="vehic_reg_'+data[j].vehicleid+'" style="margin-bottom:0px">'+data[j].vehiclename+'</p><small id="vehic_upt<'+data[j].vehicleid+'">'+update_valu+'</small> <td><div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown"><div class="btn-group" role="group"> <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="font-size: 10px;"><a class="dropdown-item" href="<?php echo site_url('Genericreport/playback'); ?>" style="padding-left: 10px;"><i class="fa fa-play"></i>&nbsp;Playback</a><a class="dropdown-item" href="component-buttons-extended.html" style="padding-left: 10px;"><i class="fa fa-share-alt"></i>&nbsp; Share position</a></div></div></div></td></tr>';

          // console.log(tr_row);

          //   $('#body-data').append(tr_row);

          var last_off_upt = 'parker_status' + data[j].vehicleid;

          var vehic_reg = 'vehic_reg' + data[j].vehicleid;

          $('#' + vehic_reg).empty().append(data[j].vehiclename);

        }

        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



      },
      error: function() {
        console.log('error');
      }
    });
    // update_status_table3();

  }

  function update_status_table3() {



    $.ajax({
      url: '<?php echo site_url('/Dashboard/all_vehicle_loc/3'); ?>', //get current loc of all vehicle from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
        //  alert(data);
        for (var j = 0; j < data.length; j++) {
          var v_u_time = parseInt(data[j].update_time);
          var v_acc_on = parseInt(data[j].acc_on);
          var v_speed = parseInt(data[j].speed);

          switch (data[j].vehicle_type) { //get vehicle type

            case '1':
              var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
              break;
            case '2':
              var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
              break;
            case '3':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            case '4':
              var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
              break;
            case '5':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            default:
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

          }

          var vehicle_sleep = parseInt(data[j].vehicle_sleep);

          if (v_u_time <= 10) {
            if (vehicle_sleep == 3) {
              var image = '<span style="color:#147fc7">' + image_path + '</span>&nbsp;';
              var status_cont = 'PARKING';
            } else if (v_acc_on == 1) {
              if (v_speed > 0) {
                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:green">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:green">' + image_path + '</span>&nbsp;';
                  var status_cont = 'MOVING';
                }
              } else {

                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:#fabf2c">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:#fabf2c">' + image_path + '</span>&nbsp;';
                  var status_cont = 'IDLE';
                }

              }
            } else {
              if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                var image = '<span style="color:blue">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                var status_cont = 'PARKING';
              } else {
                var image = '<span style="color:blue">' + image_path + '</span>&nbsp;';
                var status_cont = 'PARKING';
              }

            }
            //alert('hi');
          } else {
            if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
              var image = '<span style="color:#a89e9e">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
              var status_cont = 'MOVING';
            } else {
              var image = '<span style="color:#a89e9e">' + image_path + '</span>&nbsp;';
              var status_cont = 'GSM Lost';
            }

          }
          var img_cont = image;



          var vehic_upt = 'vehic_upt3' + data[j].vehicleid;
          if (data[j].updatedon) {
            var update_valu = data[j].updatedon;
          } else {
            var update_valu = '____:__:__ __:__:__';
          }
          $('#' + vehic_upt).empty().html(update_valu);
          var vehic_status = 'vehic_status3' + data[j].vehicleid;
          $('#' + vehic_status).empty().html(img_cont);


          var last_off_upt = 'parker_status3' + data[j].vehicleid;

          var vehic_reg = 'vehic_reg3' + data[j].vehicleid;

          $('#' + vehic_reg).empty().append(data[j].vehiclename);

        }

        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



      },
      error: function() {
        console.log('error');
      }
    });

    update_status_table4();
  }


  function update_status_table4() {



    $.ajax({
      url: '<?php echo site_url('/Dashboard/all_vehicle_loc/4'); ?>', //get current loc of all vehicle from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
        //  alert(data);
        for (var j = 0; j < data.length; j++) {
          var v_u_time = parseInt(data[j].update_time);
          var v_acc_on = parseInt(data[j].acc_on);
          var v_speed = parseInt(data[j].speed);

          switch (data[j].vehicle_type) { //get vehicle type

            case '1':
              var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
              break;
            case '2':
              var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
              break;
            case '3':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            case '4':
              var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
              break;
            case '5':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            default:
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

          }

          var vehicle_sleep = parseInt(data[j].vehicle_sleep);

          if (v_u_time <= 10) {
            if (vehicle_sleep == 3) {
              var image = '<span style="color:#147fc7">' + image_path + '</span>&nbsp;';
              var status_cont = 'PARKING';
            } else if (v_acc_on == 1) {
              if (v_speed > 0) {
                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:green">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:green">' + image_path + '</span>&nbsp;';
                  var status_cont = 'MOVING';
                  vehiclename
                }
              } else {

                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:#fabf2c">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:#fabf2c">' + image_path + '</span>&nbsp;';
                  var status_cont = 'IDLE';
                }

              }
            } else {
              if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                var image = '<span style="color:blue">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                var status_cont = 'PARKING';
              } else {
                var image = '<span style="color:blue">' + image_path + '</span>&nbsp;';
                var status_cont = 'PARKING';
              }

            }
            //alert('hi');
          } else {
            if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
              var image = '<span style="color:#a89e9e">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
              var status_cont = 'MOVING';
            } else {
              var image = '<span style="color:#a89e9e">' + image_path + '</span>&nbsp;';
              var status_cont = 'GSM Lost';
            }

          }
          var img_cont = image;



          var vehic_upt = 'vehic_upt4' + data[j].vehicleid;
          if (data[j].updatedon) {
            var update_valu = data[j].updatedon;
          } else {
            var update_valu = '____:__:__ __:__:__';
          }
          $('#' + vehic_upt).empty().html(update_valu);
          var vehic_status = 'vehic_status4' + data[j].vehicleid;
          $('#' + vehic_status).empty().html(img_cont);


          var last_off_upt = 'parker_status4' + data[j].vehicleid;

          var vehic_reg = 'vehic_reg4' + data[j].vehicleid;

          $('#' + vehic_reg).empty().append(data[j].vehiclename);

        }

        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



      },
      error: function() {
        console.log('error');
      }
    });
    update_status_table2();

  }


  function update_status_table2() {



    $.ajax({
      url: '<?php echo site_url('/Dashboard/all_vehicle_loc/2'); ?>', //get current loc of all vehicle from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
        //  alert(data);
        for (var j = 0; j < data.length; j++) {
          var v_u_time = parseInt(data[j].update_time);
          var v_acc_on = parseInt(data[j].acc_on);
          var v_speed = parseInt(data[j].speed);

          switch (data[j].vehicle_type) { //get vehicle type

            case '1':
              var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
              break;
            case '2':
              var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
              break;
            case '3':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            case '4':
              var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
              break;
            case '5':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            default:
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

          }

          var vehicle_sleep = parseInt(data[j].vehicle_sleep);

          if (v_u_time <= 10) {
            if (vehicle_sleep == 3) {
              var image = '<span style="color:#147fc7">' + image_path + '</span>&nbsp;';
              var status_cont = 'PARKING';
            } else if (v_acc_on == 1) {
              if (v_speed > 0) {
                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:green">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:green">' + image_path + '</span>&nbsp;';
                  var status_cont = 'MOVING';
                }
              } else {

                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:#fabf2c">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:#fabf2c">' + image_path + '</span>&nbsp;';
                  var status_cont = 'IDLE';
                }

              }
            } else {
              if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                var image = '<span style="color:blue">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                var status_cont = 'PARKING';
              } else {
                var image = '<span style="color:blue">' + image_path + '</span>&nbsp;';
                var status_cont = 'PARKING';
              }

            }
            //alert('hi');
          } else {
            if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
              var image = '<span style="color:#a89e9e">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
              var status_cont = 'MOVING';
            } else {
              var image = '<span style="color:#a89e9e">' + image_path + '</span>&nbsp;';
              var status_cont = 'GSM Lost';
            }

          }
          var img_cont = image;



          var vehic_upt = 'vehic_upt2' + data[j].vehicleid;
          if (data[j].updatedon) {
            var update_valu = data[j].updatedon;
          } else {
            var update_valu = '____:__:__ __:__:__';
          }
          $('#' + vehic_upt).empty().html(update_valu);
          var vehic_status = 'vehic_status2' + data[j].vehicleid;
          $('#' + vehic_status).empty().html(img_cont);


          var last_off_upt = 'parker_status2' + data[j].vehicleid;

          var vehic_reg = 'vehic_reg2' + data[j].vehicleid;

          $('#' + vehic_reg).empty().append(data[j].vehiclename);

        }

        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



      },
      error: function() {
        console.log('error');
      }
    });


    update_status_table1();

  }

  function update_status_table1() {



    $.ajax({
      url: '<?php echo site_url('/Dashboard/all_vehicle_loc/1'); ?>', //get current loc of all vehicle from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        // $('#body-data').empty();
        // $('#selected_vid').val(data[0].vehicleid);
        // alert(data);
        for (var j = 0; j < data.length; j++) {
          var v_u_time = parseInt(data[j].update_time);
          var v_acc_on = parseInt(data[j].acc_on);
          var v_speed = parseInt(data[j].speed);

          switch (data[j].vehicle_type) { //get vehicle type

            case '1':
              var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
              break;
            case '2':
              var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
              break;
            case '3':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            case '4':
              var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
              break;
            case '5':
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
              break;
            default:
              var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';

          }

          var vehicle_sleep = parseInt(data[j].vehicle_sleep);

          if (v_u_time <= 10) {
            if (vehicle_sleep == 3) {
              var image = '<span style="color:#147fc7">' + image_path + '</span>&nbsp;';
              var status_cont = 'PARKING';
            } else if (v_acc_on == 1) {
              if (v_speed > 0) {
                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:green">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:green">' + image_path + '</span>&nbsp;';
                  var status_cont = 'MOVING';
                }
              } else {

                if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                  var image = '<span style="color:#fabf2c">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                  var status_cont = 'MOVING';
                } else {
                  var image = '<span style="color:#fabf2c">' + image_path + '</span>&nbsp;';
                  var status_cont = 'IDLE';
                }

              }
            } else {
              if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
                var image = '<span style="color:blue">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
                var status_cont = 'PARKING';
              } else {
                var image = '<span style="color:blue">' + image_path + '</span>&nbsp;';
                var status_cont = 'PARKING';
              }

            }
            //alert('hi');
          } else {
            if (data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 15 || data[j].device_type == 16) {
              var image = '<span style="color:#a89e9e">' + image_path + '<i class="fa fa-tint"></i></span>&nbsp;';
              var status_cont = 'MOVING';
            } else {
              var image = '<span style="color:#a89e9e">' + image_path + '</span>&nbsp;';
              var status_cont = 'GSM Lost';
            }

          }
          var img_cont = image;



          var vehic_upt = 'vehic_upt1' + data[j].vehicleid;
          if (data[j].updatedon) {
            var update_valu = data[j].updatedon;
          } else {
            var update_valu = '____:__:__ __:__:__';
          }
          $('#' + vehic_upt).empty().html(update_valu);
          var vehic_status = 'vehic_status1' + data[j].vehicleid;
          $('#' + vehic_status).empty().html(img_cont);


          var last_off_upt = 'parker_status1' + data[j].vehicleid;
          // vehiclename

          var vehic_reg = 'vehic_reg1' + data[j].vehicleid;

          $('#' + vehic_reg).empty().append(data[j].vehiclename);

        }

        // $('#vid_'+data[0].vehicleid).addClass('highlighted');
        // $("#selected_vid").val(data[0].vehicleid);



      },
      error: function() {
        console.log('error');
      }
    });


  }



  function set_vehicle(data) {
    //   $(".altloader").addClass('hide');
    //   $('.currentstatus').removeClass('hide');
    var v_ac = data.ac_flag; //    Ac ON/OFF
    var v_ft = data.litres; //  FUEL TANK LEVEL
    //alert(v_ft);
    var v_fuel = parseInt(data.fuel_tank_capacity); //  FUEL LEVEL
    var v_speed = data.speed; //  SPEED
    var v_no = data.vehiclename; //  VEHICLE NO
    var v_status = data.acc_on; //  VEHICLE STATUS ON/OFF
    var v_km = data.kilometer; //  KILOMETER
    var v_odometer = data.odometer; //  ODOMETER
    var v_temp = data.temperature; //  TEMPERATURE
    var v_battery = data.car_battery; //  CAR BATTERY
    var v_dv_battery = data.device_battery; //  DEVICE BATTERY
    var v_charge_status = data.device_charge_status;
    var driver_name = data.driver_name;

    var hourmeter = data.hourmeter;
    var today_hourmeter = data.today_hourmeter;

    $("#auto_speed").empty().append(Math.round(v_speed) + ' KM');
    $("#progress_speed").empty().append("<div class='progress-bar bg-success' role='progressbar' style='width: " + Math.round(v_speed) + "%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>");

    if (hourmeter != '' && hourmeter != null) {
      var hourmeter = parseFloat(hourmeter);
      $("#hourmeter").empty().append(hourmeter.toFixed(1));
    } else {
      $("#hourmeter").empty().append('0');
    }

    if (v_ft != '' && v_ft != null && v_ft > 0) {
      var hourmeter = parseFloat(v_ft);
      $("#fuel_ltr").empty().append(v_ft.toFixed(1) + '/' + v_fuel + ' ltrs');
    } else {
      $("#fuel_ltr").empty().append('0');
    }





    if (today_hourmeter != '' && today_hourmeter != null) {
      var today_hourmeter = parseFloat(today_hourmeter);
      $("#today_hm").empty().append(today_hourmeter.toFixed(1));
    } else {
      $("#today_hm").empty().append('0');
    }

    var internal_battery_voltage = data.internal_battery_voltage;

    var real_odo = data.real_odo + " KM";

    var today_km = data.today_km;

    if (today_km != '' && today_km != null && today_km > 0) {
      var today_km = parseFloat(today_km);
      $("#today_km").empty().append(today_km.toFixed(2) + ' KM');
    } else {
      $("#today_km").empty().append('0');
    }

    if (v_ac == '1') { //AC ON - CHANGE TO GREEN
      $("#ac_status").empty().append('<b>ON</>');
    } else if (v_ac == '0' || v_ac == '') { //AC - OFF CHANGE TO RED
      $("#ac_status").empty().append('<b>OFF</b>');
    }
    //console.log(data.mdvr_terminal_no);
    //alert(data.mdvr_terminal_no);
    if (data.mdvr_terminal_no != 0 && data.mdvr_terminal_no != null) {
      $('.mdvr_terminal_no').removeClass('hidden');

      var mdvr_url = "http://52.27.39.152/808gps/open/player/video.html?account=nexvision&password=000000&vehiIdno=" + data.mdvr_terminal_no + "&lang=en";
      $("#mdvr_terminal_no").empty().append('<a target="_blank" href="' + mdvr_url + '">Click Here</a>');
    }



    $("#vehicleNo").empty().append(data.vehiclename);

    $("#temp_value").empty().append(v_temp + ' °C');

    $("#eta").empty().append(data.hub_ETA);

    $("#dte").empty().append(data.DTE + " KM");

    $("#driver_name").empty().append(data.driver_name);


    if (data.device_config_type == 2) {
      $("#real_odo").empty().append(real_odo);
      $("#engine_speed").empty().append(data.engine_speed);
      $("#coolant_level").empty().append(data.coolant_level);

      $("#engine_load").empty().append(data.engine_load);

      $("#coolant_temperature").empty().append(data.coolant_temperature);

      $("#lut").empty().append(data.lut);
      $(".odo_data").hide();
      $(".real_odo").show();
    } else {
      $(".real_odo").hide();
    }

    if (v_status == 1 && v_speed > 0) {
      $("#vehicle_status").empty().append('<b>MOVING</>');
    } else if (v_status == '1' && v_speed <= 0) {
      $("#vehicle_status").empty().append('<b>ON</>');
    } else if (v_status == '0' || v_status == '') {
      $("#vehicle_status").empty().append('<b>OFF</b>');
    }

    if (v_km != '') {
      var val_km = parseFloat(v_km);
      $("#kilometer").empty().append(val_km.toFixed(2));
    } else {
      $("#kilometer").empty().append('0');
    }


    if (v_odometer != '') {
      var v_odometer = parseFloat(v_odometer);
      //alert(v_odometer);
      $("#odometer").empty().append(v_odometer.toFixed(2));
    } else {
      $("#odometer").empty().append('0');
    }


    if (v_ft == '') {
      v_ft = '250'; //IF FUEL TANK CAPACITY IS NOT GIVEN DEFAULT  250 LTR
    }
    if (v_battery || v_dv_battery || v_charge_status) {


      if (v_dv_battery != '0' || v_charge_status != '0' || v_dv_battery != '' || v_charge_status != '') {


        $("#devicebattery").empty().append(parseFloat(v_dv_battery).toFixed(2) + " %");

        $("#car_battery").empty().append(parseFloat(v_battery).toFixed(2) + " Volt");

      } else {

        $("#db_img").hide();
        $("#db_img_v").hide();
        $("#cb_img").show();
        $("#cb_img_v").show();

        $("#car_battery").empty().append(parseFloat(v_battery).toFixed(2) + " Volt");
      }
    } else {

      $("#car_battery").empty().append("N/A");
      $("#db_img").show();
      $("#db_img_v").show();
      $("#cb_img").show();
      $("#cb_img_v").show();

      $("#devicebattery").empty().append("N/A");



    }


    if (internal_battery_voltage != null && internal_battery_voltage != '0' && internal_battery_voltage != '') {
      $("#internal_battery_voltage").empty().append(parseFloat(internal_battery_voltage).toFixed(2) + " Volt");
    } else {
      $("#internal_battery_voltage").empty().append("N/A");
    }

    $("#max-fuel").empty().append(v_ft + "/" + v_fuel);
    if (data.update_time <= 10) {


      if (data.last_dur) {

        var last_off = data.last_dur;

        var tims_len = last_off.length;


        var last_off_new;


        if (tims_len < 9) {

          var hrs = last_off.substring(0, 2);

          var mins = last_off.substring(3, 5);

          var secs = last_off.substring(6, 8);

          if (parseInt(hrs) == 0) {

            last_off_new = mins + ' <b>mins</b> ' + secs + ' <b>sec</b>';

          } else {

            if (parseInt(hrs) > 24) {

              hrs = parseInt(hrs);

              hrs = hrs / 24;

              var day = parseInt(hrs);

              last_off_new = day + ' <b>Day</b> ';

            } else {

              last_off_new = parseInt(hrs) + ' <b>hrs</b> ' + mins + ' <b>mins</b> ' + secs + ' <b>sec</b>';
            }


          }

        } else {

          var hrs = last_off.substring(0, 3);

          hrs = parseInt(hrs);

          hrs = hrs / 24;

          var day = parseInt(hrs);

          last_off_new = day + ' <b>Day</b> ';
        }

      } else {

        var last_off = '__:__:__';

        var last_off_new = '---';

      }

    } else {
      // alert(data.no_last_dur);
      if (data.no_last_dur) {

        var last_off = data.no_last_dur;

        var tims_len = last_off.length;


        var last_off_new;


        if (tims_len < 9) {

          var hrs = last_off.substring(0, 2);

          var mins = last_off.substring(3, 5);

          var secs = last_off.substring(6, 8);

          if (parseInt(hrs) == 0) {

            last_off_new = mins + ' <b>mins</b> ' + secs + ' <b>sec</b>';

          } else {

            if (parseInt(hrs) > 24) {

              hrs = parseInt(hrs);

              hrs = hrs / 24;

              var day = parseInt(hrs);

              last_off_new = day + ' <b>Day</b> ';

            } else {

              last_off_new = parseInt(hrs) + ' <b>hrs</b> ' + mins + ' <b>mins</b> ' + secs + ' <b>sec</b>';
            }


          }


        } else {

          var hrs = last_off.substring(0, 3);

          hrs = parseInt(hrs);

          hrs = hrs / 24;

          var day = parseInt(hrs);

          last_off_new = day + ' <b>Day</b> ';
        }

      } else {

        var last_off = '__:__:__';

        var last_off_new = '---';

      }
    }
    $("#onduration").empty().append(last_off_new);
    $("#address").empty().append(data.latlon_address);
    $("#altitute").empty().append(data.altitude);
    $("#gpssignal").empty().append(data.gpssignal);
    $("#gsmsignal").empty().append(data.gsmsignal);


  }


  //Moving The vehicle 


  function smooth_move() {



    update_status_table();


    var id = $('#selected_vid').val();

    $.ajax({
      url: '<?php echo site_url('/Dashboard/single_vehicle_loc/'); ?>' + id, //get current ignition route from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        //alert(data);
        single_vehicle_route1(map, data);
        var e_lat = data.lat;
        var e_lng = data.lng;

      },
      error: function() {
        console.log('error');
      }
    });



    $.ajax({
      url: '<?php echo site_url('/Dashboard/single_vehicle_loc/'); ?>' + id, //get current ignition route from db
      type: 'GET',
      dataType: "json",
      success: function(data) {

        // alert(data);
        set_vehicle(data);
        var e_lat = data.lat;
        var e_lng = data.lng;

      },
      error: function() {
        console.log('error');
      }
    });



  }



  function single_vehicle_route1(map, data) {


    if (marker != undefined) {
      map.removeLayer(marker);
    };

    var location_lat = parseFloat(data.lat);
    var location_lng = parseFloat(data.lng);

    var angle = data.angle;

    var v_u_time = parseInt(data.update_time);
    var v_acc_on = parseInt(data.acc_on);
    var v_speed = parseInt(data.speed);

    var vehicle_sleep = parseInt(data.vehicle_sleep);

    if (data.updatedon != null && data.updatedon != '') {
      if (v_u_time <= 10 && v_u_time != null) {
        if (vehicle_sleep == 3) {
          var status_cont = 'PARKING';
          color = '#147fc7';

          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Speed:</b> ' + Math.round(data.speed) + ' km/hr <br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt  <br/><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '<br></div>';
        } else if (v_acc_on == 1) {
          if (v_speed > 0) {
            var status_cont = 'MOVING';
            color = '#00a65a';

            var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Speed:</b> ' + Math.round(data.speed) + ' km/hr <br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt  <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '<br></div>';


          } else {
            var status_cont = 'IDLE';
            color = '#fabf2c';
            var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

          }
        } else {
          var status_cont = 'PARKING';
          color = '#337ab7';
          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery:  </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

        }
      } else {
        var status_cont = 'GSM Lost';
        color = '#a89e9e';
        var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery: </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

      }
    } else {
      var status_cont = 'GSM Lost';
      color = '#a89e9e';
      var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> ' + data.vehiclename + '<br><b>Status:</b> <span style="color:' + color + '"><b>' + status_cont + '</b></span><br><b>Battery: </b> ' + parseFloat(data.car_battery).toFixed(2) + ' volt <br><b>Last Updated on:</b> ' + data.updatedon + '<br><b>Lat/Long:</b> ' + parseFloat(data.lat).toFixed(4) + ',' + parseFloat(data.lng).toFixed(4) + '</br></div>';

    }
    var vehicle_type = parseInt(data.vehicle_type);
    var vehicle_shortname = data.vehicle_shortname;
    var image_path;
    if (v_u_time <= 10) {
      if (v_acc_on == 1) {
        if (v_speed > 0) {
          var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GREEN/' + vehicle_shortname + '.png';

        } else {

          var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/YELLOW/' + vehicle_shortname + '.png';

        }

      } else {

        var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/BLUE/' + vehicle_shortname + '.png';
      }

    } else {

      var image_path = '<?php echo base_url(); ?>assets/dist/img/ICONS/GRAY/' + vehicle_shortname + '.png';

    }


    var startCoords = [location_lat, location_lng];


    var pre_lat = $('#pre_lat').val();
    var pre_lng = $('#pre_lng').val();
    var pre_angle = $('#pre_angle').val();

    var pre_latlng1 = [parseFloat(pre_lat), parseFloat(pre_lng)];

    var redIcon = new L.Icon({
      iconUrl: image_path,
      iconSize: [35, 35],
    });




    marker = L.marker(pre_latlng1, {
      icon: redIcon,
      rotationAngle: angle
    }).addTo(map);


    map.addLayer(marker);

    var group = new Array();
    group = new L.featureGroup([marker]);

    map.fitBounds(group.getBounds());

    marker.bindPopup(marker_content).openPopup();

    $('#pre_lat').empty().val(location_lat);
    $('#pre_lng').empty().val(location_lng);
    $('#pre_angle').empty().val(angle);


    markers.push(marker);
    assetLayerGroup.addLayer(markers);


    if (v_acc_on == 1) {
      if (v_speed > 0) {

        marker.slideTo(startCoords, {
          rotationAngle: angle,
          duration: 20000,
          keepAtCenter: true
        });

      }
    }


    // get_current_address(location_lat,location_lng);

  }
</script>