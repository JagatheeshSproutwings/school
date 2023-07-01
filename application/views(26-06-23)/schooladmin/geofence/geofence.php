<!-- BEGIN: Body-->
<?php error_reporting(0);  

    $role =$this->session->userdata['role'];
    $clientid=$this->session->userdata['clientid'];

?>

<style>
        /**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
/* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
/* #map {
  height: 100%;
  
}
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
} */


    </style>
    
   <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHY8kty72FBVNEbwwQEc2jYujjNzN6hHQ&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">ADD GEOFENCE</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> ADD GEOFENCE</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  Geofence </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adduser">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Geofence </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="c <div classlose" onclick="location.reload();"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="geofenceform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Geofence Details</h4>
                                              </div>

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="geofence_type" class="required requirednet">Geofence Type<span class="error">&nbsp;*</span></label>
                                      
                                    <select class="form-control" name="geofence_type" id="geofence_type" required>
                                    <option class="form-control" value="">Select Type</option>
                                    <option class="form-control" value="1">Manual Entry</option>
                                    <option class="form-control" value="2">Auto </option>
                                 </select>  
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1 Location_name">
                                    <fieldset class="form-group">
                                        <label for="Location_name">Location Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" id="Location_name" name="Location_name" placeholder="Enter the Location Name"><div class="div1" id="div1"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="Location_short_name" class="required requirednet">Location Short Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" id="Location_short_name" name="Location_short_name" placeholder="Enter the Short Location Name"><div class="div1" id="div1"></div>
                                   
                                        <!-- <input type="hidden"  name="Lat" id="Lat" placeholder="Enter the Lat" maxlength="13">
                                <input type="hidden"  id="Lng" name="Lng" placeholder="Enter the longitute"> -->
                                    </fieldset>
                                </div>
                              
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="Lat" class="required requiredimei">Latitute<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control allow-numeric" name="Lat" id="Lat" placeholder="Enter the Lat">
                                        <div class="div2" id="div2"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="Lng" class="required requiredsim">Longitute<span class="error">&nbsp;*</span><span id='exist' class="error"> </span></label>
                                        <input type="text" class="form-control" id="Lng" name="Lng" placeholder="Enter the longitute"><div class="div3" id="div3"></div>
                                    </fieldset>
                                </div>
 

                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="radius" class="required requiredsim">radius<small>(mtrs)</small><span class="error">&nbsp;*</span><span id='exist' class="error"> </span></label>
                                        <input type="number" class="form-control" id="radius" name="radius" placeholder="Enter the Radius"><div class="div3" id="div3"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="area" class="required requiredsim">Area Name<span class="error">&nbsp;*</span><span id='exist' class="error"> </span></label>
                                        <input type="text" class="form-control" id="area" name="area" placeholder="Enter the Area Name"><div class="div3" id="div3"></div>
                                    </fieldset>
                                </div>

                                <input type="hidden" name="Location_Id" id="Location_Id" value="">

                                <div class="col-xl-12 col-lg-12 col-md-12">
                                <input type="submit" class="btn btn-primary btn-min-width mr-1 btn-next btn-next1" value="Submit" id='submit'>
                                <button type="button" class="btn btn-primary btn-min-width" id="closeform">Reset</button>
                                </div>

                                </div>
                               
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                <div class="card-content map_container hidden">
                                                   <div class="card-body">
                                               <div id="map" style="height:500px;"></div>
                                              </div>
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


        <div class="content-body">
            <section id="configuration">
            <div class="row" >
                <div class="col-12">
                    <div class="card">

                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                             
                                <div class="table-responsive">

                                <table  id="vehiclelist" class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>                                          
                                            <th>Location Name </th>
                                            <th>Latitute </th>
                                            <th>Longitute </th> 
                                            <th>Area Name </th> 
                                            <th>Status</th>                                          
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         $count_sno = 1;

                                         foreach ($geofencelist as $list) {
                                               ?>
                                        <tr>
                                            <th scope="row"> <?=$count_sno++;?>
                                            <td><?=$list->Location_short_name;?> </td>
                                            <td><?=$list->Lat;?></td>
                                            <td><?=$list->Lng;?></td>
                                            <td><?=$list->area;?></td>
                                            <td><?php if($list->activecode=='1'){echo "Active";}else{echo "Deactive";}?></td>
                                            
                                            <td> <a href="#" class="edit"  id="<?php echo $list->Location_Id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp; 
                                            <a href="#" id="<?php echo $list->Location_Id;?>" class="deleteuser"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                            </td>                                      
                                        </tr>

                                      <?php  } ?>
                                        
                                    </tbody>
                                </table>  
                              </div>                
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
    

</script>

    <script>

        $(document).ready(function () {

         $('.adduser').hide(); 

         $('#geofence_type').on('change', function() {
           
           var geofence_type =$("#geofence_type").val();
          // alert(geofence_type);
           if(geofence_type==1)
           {
            $(".Location_name, .map_container").addClass("hidden");
           }else if(geofence_type==2)
           {
            $(".Location_name, .map_container").removeClass("hidden");
           }
           else
           {
            $(".Location_name, .map_container").removeClass("hidden");
           }
         

            });
     
  $("#geofenceform").submit(function(e) {
          
              var Location_Id= $('#Location_Id').val();   
              console.log(e);
              e.preventDefault(); 
              var form = $(this);
          
                  var url = '<?php echo site_url('geofence/savegeofence');?>';
                  $.ajax({
                       type: "POST",
                       url: url,
                       data: form.serialize(), // serializes the form's elements.
                       success: function(data)
                       {
                        //    alert(data);
                              $('.adduser').hide();  //Add userpage hide
                              $('#configuration').show();
                               location.reload(true);
                       }
                     }); 
          
                          
 });

});



 $(document).ready(function(){   
    $('.edit').click(function(){
        
       var thisid = $(this).attr('id');
        // alert(thisid);
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('geofence/editgeofence/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                console.log(response);
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
             // alert(obj.radius);
                $("#Location_short_name").val(obj.Location_short_name);
                $("#Location_name").val(obj.Location_name);
                $("#Lat").val(obj.Lat);
                $('#Lng').val(obj.Lng);     
                $('#radius').val(obj.radius);           
                $('#area').val(obj.area);                  
                $("#activecode").val(obj.activecode);   
                $('#Location_Id').val(obj.Location_Id);    
                $('#geofence_type').val(obj.geofence_type);    

                if(obj.geofence_type==1)
           {
            $(".Location_name, .map_container").addClass("hidden");
           }else if(obj.geofence_type==2)
           {
            $(".Location_name, .map_container").removeClass("hidden");
           }

                editmap();         

          },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    });

});


function initMap() {
    var antennasCircle;
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 11.0116775, lng: 76.8271446 },
    zoom: 13,
    mapTypeControl: false,
  });

  const card = document.getElementById("card-body");
  const input = document.getElementById("Location_name");
  const options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    types: ["establishment"],
  };
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(
    document.getElementById("info")
  );

  const autocomplete = new google.maps.places.Autocomplete(input, options);

  autocomplete.bindTo("bounds", map);

  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");

  infowindow.setContent(infowindowContent);


  const marker = new google.maps.Marker({
    map,
    draggable: true,
    anchorPoint: new google.maps.Point(0, -29),
  });
//   console.log(autocomplete);
  autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);
console.log("yes came this");
    const place = autocomplete.getPlace();
    // console.log(place);
    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    // antennasCircle.setMap(null);
    // const path = marker.getPosition();
    //   // console.log(path.lat());
    //     // console.log(path.lng());
    //     $('#Lat').val(path.lat);
    //     $('#Lng').val(path.lng);
    //     var latlng = ({lat :path.lat(),lng:path.lng()});
    // antennasCircle = new google.maps.Circle({
    //   strokeColor: "#FF0000",
    //   strokeOpacity: 0.8,
    //   strokeWeight: 2,
    //   fillColor: "#FF0000",
    //   fillOpacity: 0.35,
    //   map: map,
    //   center: latlng,
    //   radius: 500
    // });
    // map.fitBounds(antennasCircle.getBounds());

 
    google.maps.event.addListener(marker, "position_changed", update);
    // update();
    function update() {
    //    alert('yrd0');
        const path = marker.getPosition();
       // marker.setPosition(place.geometry.location);
       // console.log(path);
        // console.log(path.lat());
        // console.log(path.lng());
        $('#Lat').val(path.lat);
        $('#Lng').val(path.lng);
        var latlng = ({lat :path.lat(),lng:path.lng()});
      

        if (antennasCircle && antennasCircle.setMap)
        {
            // console.log('done');
            antennasCircle.setMap(null);
           
        }
       var radius_value =   $('#radius').val(); 
       var radius_value = (radius_value >=10) ? parseInt(radius_value) : 10;

        console.log(radius_value);
        antennasCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center:latlng,
      radius: radius_value
    });
    // map.fitBounds(antennasCircle.getBounds());
    // antennasCircle.setMap(null);
    console.log(antennasCircle.radius);
    var radius_value =   $('#radius').val(antennasCircle.radius); 

}


  });

 

}


function editmap() {
    // console.log('work');
    var antennasCircle;
    var marker;
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 11.0116775, lng: 76.8271446 },
    zoom: 13,
    mapTypeControl: false,
  });

  const card = document.getElementById("card-body");
  const input = document.getElementById("Location_name");
  var input_val = $("#Location_name").val();
  var lat = $("#Lat").val();
  var lng = $("#Lng").val();
  console.log(input_val);
  const options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    types: ["establishment"],
  };
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(
    document.getElementById("info")
  );
 
  const autocomplete = new google.maps.places.Autocomplete(input, options);

  autocomplete.bindTo("bounds", map);

  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");

  infowindow.setContent(infowindowContent);

       var radius_value =   $('#radius').val(); 
       var radius_value = (radius_value >=10) ? parseInt(radius_value) : 10;

   marker = new google.maps.Marker({
    map,
    draggable: true,
    position: { lat:parseFloat(lat), lng: parseFloat(lng) },
  });
  marker.setMap(map);

  // marker.addListener('click', function() {
    marker.addListener("dragend", e => {

        console.log('click map');


        const path = marker.getPosition();
       // marker.setPosition(place.geometry.location);
       // console.log(path);
        // console.log(path.lat());
        // console.log(path.lng());
        $('#Lat').val(path.lat);
        $('#Lng').val(path.lng);
        var latlng = ({lat :path.lat(),lng:path.lng()});
      

        if (antennasCircle && antennasCircle.setMap)
        {
            // console.log('done');
            antennasCircle.setMap(null);
           
        }
       var radius_value =   $('#radius').val(); 
        // radius_value = (radius_value >=50) ? parseInt(radius_value) : 300;
         radius_value = (radius_value >=10) ? parseInt(radius_value) : 10;

        console.log(radius_value);
        antennasCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center:latlng,
      radius: radius_value
    });
    // map.fitBounds(antennasCircle.getBounds());
    console.log(antennasCircle.radius);
    var radius_value =   $('#radius').val(antennasCircle.radius); 


        // if(prevMarker !== "") {
        //     prevMarker.setIcon({
        //         url: "your_image.png",
        //         scaledSize: new google.maps.Size(38, 40)
        //     });
        // }
        // prevMarker = this;
        // this.setIcon({
        //     url: "your_image.png",
        //     scaledSize: new google.maps.Size(48, 50)
        // });
        // map.panTo(this.getPosition());
    });

  // google.maps.event.addListener(marker, 'click', (function(marker, i) {
  //   return function() {

  //     console.log('came this');
  //     // infowindow.setContent(locations[i][0], locations[i][6]);
  //     // infowindow.open(map, marker);

  //     // // check to see if activeMarker is set
  //     // // if so, set the icon back to the default
  //     // activeMarker && activeMarker.setIcon(iconDefault);

  //     // // set the icon for the clicked marker
  //     // marker.setIcon(iconSelected);

  //     // // update the value of activeMarker
  //     // activeMarker = marker;
  //   }
  // })(marker, i));


  console.log(radius_value);
        antennasCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center: { lat:parseFloat(lat), lng: parseFloat(lng) },
      radius: radius_value
    });
    map.fitBounds(antennasCircle.getBounds());

    google.maps.event.trigger(autocomplete, 'place_changed');

    autocomplete.addListener("place_changed", () => {

    infowindow.close();
    marker.setVisible(false);
     console.log("yes");
    const place = autocomplete.getPlace();
    // console.log(place);
    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    const path = marker.getPosition();
      // console.log(path.lat());
        // console.log(path.lng());
        $('#Lat').val(path.lat);
        $('#Lng').val(path.lng);
        var latlng = ({lat :path.lat(),lng:path.lng()});
    // antennasCircle = new google.maps.Circle({
    //   strokeColor: "#FF0000",
    //   strokeOpacity: 0.8,
    //   strokeWeight: 2,
    //   fillColor: "#FF0000",
    //   fillOpacity: 0.35,
    //   map: map,
    //   center: latlng,
    //   radius: 500
    // });
    // map.fitBounds(antennasCircle.getBounds());

    // antennasCircle.setMap(null);
    google.maps.event.addListener(marker, "position_changed", update);
    // update();
    function update() {
    //    alert('yrd0');
        const path = marker.getPosition();
       // marker.setPosition(place.geometry.location);
       // console.log(path);
        // console.log(path.lat());
        // console.log(path.lng());
        $('#Lat').val(path.lat);
        $('#Lng').val(path.lng);
        var latlng = ({lat :path.lat(),lng:path.lng()});
      

        if (antennasCircle && antennasCircle.setMap)
        {
            // console.log('done');
            antennasCircle.setMap(null);
           
        }
       var radius_value =   $('#radius').val(); 
       var radius_value = (radius_value >=10) ? parseInt(radius_value) : 10;

        console.log(radius_value);
        antennasCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center:latlng,
      radius: radius_value
    });
    map.fitBounds(antennasCircle.getBounds());
    console.log(antennasCircle.radius);
    var radius_value =   $('#radius').val(antennasCircle.radius); 

}


  });
//   map.fitBounds(marker.getBounds());

//   console.log(autocomplete);


}


$(document).ready(function(){  
$('.deleteuser').click(function(){
        var thisid = $(this).attr('id');
        // alert(thisid);
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('geofence/deletegeofence/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                //alert(response);
             location.reload(true);
             $('#configuration').show();
            },
            error: function(){
            console.log('Error While Request User Delete List..');
            }

        });
    }
    else
    {
        return false;
    }
    });

});


     $("#showuser").click(function(){

     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });
        
        



    </script>