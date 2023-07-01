<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content" style="margin-left: 0px;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Trip Report</h3>
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
                                    <div class="col-8 box-bordershado">
                                        <table id="tripreport" class="table table-striped table-bordered zero-configuration">
                                            <?php foreach ($vehicle_details as $vlist) { ?>
                                                <thead>
                                                    <tr class="trip_tr">
                                                        <th rowspan="2">S No</th>
                                                        <th colspan="3"><b>Vehicle:</b> <?= $vlist['vehicle']; ?></th>
                                                        <th colspan="3"><b>Total<br>Duration(Hr:Min): </b> <?= $vlist['tot_duration']; ?></th>
                                                        <th><b>Total<br>Distance<br>(KM): </b> <?= round($vlist['tot_distance'], 2); ?></th>
                                                    </tr>

                                                    <tr>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Total Time<br> (H:M:S)</th>
                                                        <th>Start Odo</th>
                                                        <th>End Odo</th>
                                                        <th>Distance<br>(KM)</th>
                                                        <!--                                          <th>Start Location</th>
                                            <th>End Location</th>-->
                                                        <th>Map View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $count_sno = 1;
                                                    foreach ($vlist['resultArray'] as $list) {

                                                        $dist = 0;

                                                        if ($list['distance'] > 0) {
                                                            $dist = round($list['distance'], 2);
                                                        } else {
                                                            $dist = 0;
                                                        }

                                                    ?>
                                                        <tr>
                                                            <td><?= $count_sno++; ?></td>
                                                            <td><?= $list['start_date']; ?></td>
                                                            <td><?= $list['end_date']; ?></td>
                                                            <td><?= $list['time_dur']; ?></td>
                                                            <td><?= $list['start_odo']; ?></td>
                                                            <td><?= $list['end_odo']; ?></td>
                                                            <td><?php if ($dist > 0) {
                                                                    echo round($dist, 2);
                                                                } else {
                                                                    echo "0";
                                                                } ?></td>
                                                            <?php
                                                            $location_par = $list['s_lat'] . ',' . $list['s_lng'] . ',' . $list['e_lat'] . ',' . $list['e_lng'];
                                                            $map_par = $list['start_date'] . ',' . $list['end_date'] . ',' . $list['imei_no'] . ',' . $list['vehicle'] . ',' . $dist;
                                                            ?>
                                                            <!--<td><?= $list['start_location']; ?></td>-->
                                                            <!--<td><?= $list['end_location']; ?></td>-->
                                                            <td>
                                                                <!--    <a href="#" onClick="tripmap('<? php // echo $list['report_id']
                                                                                                        ?>');" > -->

                                                                </a>
                                                                <a href="#" class="label label-info inbox-notification" onclick="onMapClick('<?php echo $map_par; ?>');location_name('<?php echo $location_par; ?>');"><img class="media-object" src="<?= base_url(); ?>app-assets\images\menuicon\29.svg" alt="image"></a>
                                                            </td>

                                                        </tr>
                                                <?php }
                                                } ?>
                                                </tbody>
                                        </table>

                                    </div>

                                    <div class="col-4">
                                        <div>
                                            <label id="start_location1"><b>Start Location:</b> </label>
                                            <hr>
                                            <label id="end_location1"><b>End Location:</b> </label>
                                        </div>
                                        <div id="trip_map" style="height:350px;width:100%;"> </div>
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
    <div class="modal fade text-left" style="background:radial-gradient(black, transparent)" id="trip_maps" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-tree"></i>Trip Map</h4>
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
                                        <table class="table mb-0" id="tripreport">
                                            <thead>
                                                <tr>
                                                    <th class="parkingth">Vehicle</th>
                                                    <th class="parkingth">Start date</th>
                                                    <th class="parkingth">End date</th>
                                                    <th class="parkingth">Total Time<br>
                                                        <small>HH:MM:SS</small>
                                                    </th>
                                                    <th class="parkingth">Total Distance<br>
                                                        <small>Km</small>
                                                    </th>
                                                    <th class="parkingth">Start Location</th>
                                                    <th class="parkingth">End Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="allcolumns">
                                                    <td id="vehiclename"></td>
                                                    <td id="start_day"></td>
                                                    <td id="end_day"></td>
                                                    <td id="time_duration"></td>
                                                    <td id="distance"></td>
                                                    <td id="start_location"></td>
                                                    <td id="end_location"></td>
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

                                    <!--                <div id="trip_map" style="height:300px;width:100%;"> </div>-->

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <script src="<?php echo base_url(); ?>assets/plugins/osm/leaflet.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/osm/leaflet.rotatedMarker.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tripreport').DataTable({
                    "ordering": false,
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                    ]

                });
            });
        </script>
        <script>
            //just for the demo
            var defaultCoords = [11.016844, 76.955832];
            var StartMarker = {};
            var EndMarker = {};
            var polyline = [];
            //set up our map
            var map = L.map('trip_map').setView(defaultCoords, 6);
            L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            function onMapClick(count) {



                // $("#heremap_data").empty().append(count);

                // document.getElementById("focus").focus();

                var map_params = count.split(',');

                var from_date = map_params[0];
                var to_date = map_params[1];
                var d_no = map_params[2];
                var v_name = map_params[3];
                var distance = map_params[4];

                $.ajax({
                    url: '<?php echo site_url('/Genericreport/get_trip_route/'); ?>',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        'd_no': d_no,
                        'from_date': from_date,
                        'to_date': to_date,
                    },
                    success: function(data) {
                        //console.log(data);
                        if (data) {
                            sendlatlng(data);

                        } else {
                            alert("No Route found..");
                        }



                    },
                    error: function() {
                        console.log('error');
                    }
                });

            }


            function sendlatlng(data) {

                //,startCoords,endCoords   
                $(".location_footer").show();
                var s_lat = data[0].lat_message;
                var s_lng = data[0].lon_message;
                var e_lat = data[data.length - 1].lat_message;
                var e_lng = data[data.length - 1].lon_message;
                var startCoords = [s_lat, s_lng];
                var endCoords = [e_lat, e_lng];

                if (polyline != undefined) {

                    map.removeLayer(polyline);

                };
                var latlngs = [];
                for (i = 0; i < data.length; i++) {
                    latlngs.push([data[i].lat_message, data[i].lon_message]);
                }
                polyline = L.polyline(latlngs, {
                    color: '#fc0c28',
                    weight: '3',
                    opacity: '12.0'
                }).addTo(map);
                if (StartMarker != undefined) {
                    map.removeLayer(StartMarker);
                };
                if (EndMarker != undefined) {
                    map.removeLayer(EndMarker);
                };
                var greenIcon = new L.Icon({
                    iconUrl: '<?php echo base_url('/assets/dist/img/marker/ignition_on.png'); ?>',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [30, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });
                var redIcon = new L.Icon({
                    iconUrl: '<?php echo base_url('/assets/dist/img/marker/ignition_off.png'); ?>',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [30, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });
                EndMarker = L.marker(endCoords, {
                    icon: redIcon
                }).addTo(map);
                StartMarker = L.marker(startCoords, {
                    icon: greenIcon
                }).addTo(map);
                map.addLayer(StartMarker);
                map.addLayer(EndMarker);
                var group = new L.featureGroup([StartMarker, EndMarker, polyline]);
                map.fitBounds(group.getBounds());

                function onEachFeature(feature, layer) {
                    var labello = layer.bindLabel(feature.properties.NAME_1);
                    labello.addTo(map);
                    layer.on({
                        mouseover: highlightFeature,
                        mouseout: resetHighlight,
                        click: zoomToFeature
                    });
                }
            }

            function location_name(location_par) {
                var map_params = location_par.split(',');
                var s_lat = map_params[0];
                var s_lng = map_params[1];
                var e_lat = map_params[2];
                var e_lng = map_params[3];

                var url1 = 'http://198.204.245.190/nominatim/reverse?format=jsonv2&lat=' + s_lat + '&lon=' + s_lng;


                $.ajax({
                    url: url1,
                    type: 'GET',
                    cache: false,
                    success: function(data) {

                        var array = $.map(data, function(value, index) {
                            return [value];
                        });

                        var bla = array[12];

                        $("#start_location1").empty().append("Start location: <b>" + bla + "</b>");
                    },
                    error: function() {
                        console.log('show status query not executed');
                    }
                });


                var url2 = 'http://198.204.245.190/nominatim/reverse?format=jsonv2&lat=' + e_lat + '&lon=' + e_lng;

                $.ajax({
                    url: url2,
                    type: 'GET',
                    cache: false,
                    success: function(data) {

                        var array = $.map(data, function(value, index) {
                            return [value];
                        });

                        var bla = array[12];

                        $("#end_location1").empty().append("End location: <b>" + bla + "</b>");
                    },
                    error: function() {
                        console.log('show status query not executed');
                    }
                });


            }
        </script>