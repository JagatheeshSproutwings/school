<?php
 $first_vid = $vehicle_details['0']->vehicleid; // onload first vehicle id  
 $first_vehicle = $vehicle_details['0']->vehiclename;  // onload first vehicle Name  
?>
<style>
tr.highlighted td {
    background: #fec213;
}
.status_running
{
width:20%;
}
    </style>
<div class="sidebar-left" style="margin-top: 20px;">
    <div class="sidebar">
        <div class="sidebar-content email-app-sidebar d-flex1" style="width: 350px !important">
            <!-- <span class="sidebar-close-icon">
                <i class="feather icon-x"></i>
            </span> -->
            <!-- sidebar close icon -->
            <div class="email-app-menu">
               
                
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card land-leftbtm">
                        <div class="card-content">
                            <div class="card-body1">
                                <ul class="nav nav-tabs nav-topline" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active all_vehicles" id="base-tab21" data-toggle="tab" aria-controls="tab21" href="#" role="tab" aria-selected="true">All Vehicle</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link move_veh_list" id="base-tab22" data-toggle="tab" aria-controls="tab22" href="#" role="tab" aria-selected="false">Moving</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link idle_veh_list" id="base-tab23" data-toggle="tab" aria-controls="tab23" href="#" role="tab" aria-selected="false">Idle</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link park_veh_list" id="base-tab24" data-toggle="tab" aria-controls="tab24" href="#" role="tab" aria-selected="false">Parking</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ooc_veh_list" id="base-tab25" data-toggle="tab" aria-controls="tab25" href="#" role="tab" aria-selected="false" title="Out of Coverage">OOC</a>
                                    </li>
                                </ul>
                                <div class="tab-content border-grey border-lighten-2 border-0-top">
                                    <div class="tab-pane active" id="tab21" role="tabpanel" aria-labelledby="base-tab21">
                                        <div class="">
                                            <div class="card">
                                                <div class="card-content">
                                                           
                                                    <div id="daily-activity" class="table-responsive" style="height: 485px;">
                                                    <table id="innervehicles" class="table table-striped">
                                                    <thead>
                                                    <th class='tdth'>
                                                            <input type="hidden" id="icheck-input-all " class="allcheckbox" value="all">
                                                            <input type="hidden" id="pre_lat" value=""/>
                                                            <input type="hidden" id="pre_lng" value=""/>
                                                            <input type="hidden" id="pre_angle" value=""/>
                                                            <input type="hidden" id="selected_vid" value=""/>
                                                          <input type="hidden" id="selected_vname" value=""/>
                                                          <input type="hidden" id="table_status" value=""/>
                                                        </th>
                                                       
                                                  <th class='tdth'></th>
                                                    <th class='tdth'><?php echo $this->lang->line('vehiclename'); ?> 
                                                    </th>
                                                  
                                                            </thead>
                                                            <tbody>
                                                          
                                                        
                                                        </tbody>
                                                        </table>		

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Vendor JS-->
        </div>
    </div>
</div>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfaRwnf4zskzf4PcqqnG68qOZLYHyxsos&callback=initMap&v=weekly"
      defer
    ></script>
    
<script type="text/javascript">

let map;
var marker;
var markers=[];
function initMap() {
  map = new google.maps.Map(document.getElementById("single_map"), {
    center: { lat: 11.066378, lng: 77.091834 },
    zoom: 8,
  });
}

window.initMap = initMap;

divlightbox(id=null);

function divlightbox(id) {
  // alert(id);
    // define the $ as jQuery for multiple uses
    jQuery(function($) {    

        var table = $('#innervehicles').dataTable({
                            "bProcessing": false,
                            "sAjaxSource": "<?php echo site_url();?>/Dashboard/get_allvehicles/"+id,
                            "bPaginate":false,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'image' } ,
                                    { mData: 'vehiclename' },
                                    { mData: 'action' }
                            ],
                            "language": 
                                {      
                                "zeroRecords": "No Data Found"
                                },
                            createdRow: function (row, data, dataIndex) {
                              
                                if(dataIndex==0)
                                {
                                    $(row).addClass('highlighted');
                                   
                                    var id = $(row).attr('id');
                                    var name = $(row).attr('class').split(' ')[0];
                                    // console.log(row);
                                    // console.log(id);
                                    // console.log(name);
                              
                                  $('#selected_vid').val(id);               // value append to  input tag
                                  $('#selected_vname').val(name);             // value append to  input tag
                                $('#vehiclename').empty().append('<h2>'+name+'</h2>');  // Chart tab heading vehicle name is append
                                
                                update_all_data();     // call pageload 
                                update_graph();

                                }
                            }
                          
                    });  
  
    }); 
    // update_graph();
}

$('a.all_vehicles').on('click',function(){      // All vehicles List 
  divlightbox(id=null);                   
  $('#table_status').val('');          
   });
$('a.park_veh_list').on('click',function(){     // Parking vehicles List
  divlightbox(id=3);      
  $('#table_status').val(3);                       
   });
  $('a.idle_veh_list').on('click',function(){      // Idle vehicles List
  divlightbox(id=2);
  $('#table_status').val(2);
  });
  $('a.move_veh_list').on('click',function(){          // Moving vehicles List
  divlightbox(id=1);
  $('#table_status').val(1);
   });                  
   $('a.ooc_veh_list').on('click',function(){             // OOC vehicles List
  divlightbox(id=4);
  $('#table_status').val(4);
          });


    

      // update_all_data();     // c/all pageload 
      setInterval(smooth_move, 10000);  // after 10 second continuously call
     
      $(document).ready(function() {

                    $('#innervehicles tbody').on('click', 'tr', function () {
                        var id = $(this).attr('id');
                        //  alert(id);
                    //    var class = $(this).attr('class');
                    var name = $(this).attr('class').split(' ')[0];

                 $('#innervehicles tr').removeClass('highlighted');
                $(this).addClass('highlighted');

                    $('#selected_vid').val(id);
                    $('#selected_vname').val(name);
                 
             update_graph();
                update_all_data();
               
                 
} );


      } );
     function update_all_data() {

     var id = $('#selected_vid').val();
    //  alert(id);
             $.ajax({
        url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
            $('#vehiclename').empty().append('<h2>'+data.vehiclename+'</h2>');
          //alert(data.vehiclename);
          set_vehicle(data);
          var e_lat = data.lat;
          var e_lng = data.lng;

        },error:function(){
          console.log('error');
        }
      });


         $.ajax({
        url: '<?php echo site_url('/Dashboard/alert_data/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {

       //   alert(data);
          alert_vehicle(data);

        },error:function(){
          console.log('error');
        }
      });


      $.ajax({
        url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {

          //alert(data);
          //console.log(data);
          single_vehicle_route(data);
          var e_lat = data.lat;
          var e_lng = data.lng;

        },error:function(){
          console.log('error');
        }
      });
   
     // $('.single_vehicle_status').show();          //Show Single vehicle status
      function single_vehicle_route(data)
    {
     
         $("#pre_lat").empty();
         $("#pre_lng").empty();
          $("#pre_angle").empty();

   
          var location_lat = parseFloat(data.lat);
          var location_lng = parseFloat(data.lng);

        var map_center,path_bounds;
        var angle=data.angle;

        var v_u_time = parseInt(data.update_time);
        var v_acc_on = parseInt(data.acc_on);
        var v_speed = parseInt(data.speed);
        if(data.asset_type==1)
        {
          var battery =parseInt(data.car_battery)+' %';
        }
        else
        {
          var battery =parseFloat(data.car_battery).toFixed(2)+' volt';
        }

        
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

                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Speed:</b> '+Math.round(data.speed)+' km/hr <br><b>Battery:  </b> '+battery+'  <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'<br></div>';


                        }else{
                          var status_cont = 'IDLE';
                          color='#fabf2c';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                        }
                      }else
                      {
                          var status_cont = 'PARKING';
                          color='#337ab7';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                      }
                    }else
                    {
                       var status_cont = 'GSM Lost';
                       color='#a89e9e';
                       var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                    }
                }else
                {
                    var status_cont = 'GSM Lost';
                       color='#a89e9e';
                        var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                }
                var vehicle_type = parseInt(data.vehicle_type);
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
                        
                
  
           $('#pre_lat').val(location_lat);     // append current lattitute
          $('#pre_lng').val(location_lng);      // append current longitute
           $('#pre_angle').val(angle);         // // append current angle
        var path_coords = new Array();
        path_coords.push('{ lat :' +location_lat+ ',lng : '+location_lng+ ' }'); //push all lat lng to path coords array

        var path_coords = eval("[" + path_coords + "]");
     
        var image = {
        url: image_path, // image is 512 x 512
        scaledSize : new google.maps.Size(35, 35)
    };

          deleteMarker();
          marker = new google.maps.Marker({
            position : new google.maps.LatLng(location_lat, location_lng),
            map : map,
            color : "#00bb00",          
            icon : image,
          });
           markers.push(marker);
           var bounds = new google.maps.LatLngBounds();
           bounds.extend(new google.maps.LatLng(location_lat, location_lng));
           map.fitBounds(bounds);
          map.setZoom(16);//line added
  function deleteMarker() {
  if (marker) {
    //console.log(markers); 
   // alert('hghgj');
    marker.setMap(null);
    marker = null;
  }
}


          var infowindow = new google.maps.InfoWindow({
  content:marker_content
  });
var i = 0;
  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                    //  infowindow.setContent(new google.maps.LatLng(location_lat, location_lng));
                        infowindow.open(map, marker);
                    }
                })(marker, i));


  }




function alert_vehicle(data) {

     $('#alertreport').empty();
     for (var i = 0; i < data.length; i++) {
       //  console.log(data[i].alert_type);
          $('#alertreport').append("<a style='padding: 1px 4px'>"+data[i].alert_type+"<span class='float-right'>"+data[i].createdon+"</span> </a><br>");
     }
   
    }
    update_status_table();
  }
 
      function set_vehicle(data)
     {
    //   $(".altloader").addClass('hide');
    //   $('.currentstatus').removeClass('hide');
      var v_ac = data.ac_flag;          //    Ac ON/OFF
      var v_ft = data.litres;           //  FUEL TANK LEVEL
      //alert(v_ft);
      var v_fuel = parseInt(data.fuel_tank_capacity);       //  FUEL LEVEL
      var v_speed = data.speed;         //  SPEED
      var v_no = data.vehiclename;      //  VEHICLE NO
      var v_status = data.acc_on;         //  VEHICLE STATUS ON/OFF
      var v_km = data.kilometer;          //  KILOMETER
      var v_odometer = data.odometer;           //  ODOMETER
      var v_temp = data.temperature;          //  TEMPERATURE
      var v_battery = data.car_battery;           //  CAR BATTERY
      var v_dv_battery = data.device_battery;       //  DEVICE BATTERY
      var v_charge_status = data.device_charge_status;
      var driver_name=data.driver_name;

      var hourmeter = data.hourmeter;
      var today_hourmeter = data.today_hourmeter;
      
      $("#auto_speed").empty().append(Math.round(v_speed)+' KM');
       $("#progress_speed").empty().append("<div class='progress-bar bg-success' role='progressbar' style='width: "+Math.round(v_speed)+"%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>");

      if(hourmeter != '' && hourmeter != null)
      {
          var hourmeter = parseFloat(hourmeter);
          $("#hourmeter").empty().append(hourmeter.toFixed(1));
      }else{
        $("#hourmeter").empty().append('0');
      }

      if(v_ft != '' && v_ft != null && v_ft > 0)
      {
          var hourmeter = parseFloat(v_ft);
          $("#fuel_ltr").empty().append(v_ft.toFixed(1)+'/'+v_fuel+' ltrs');
      }else{
        $("#fuel_ltr").empty().append('0');
      }


      if(today_hourmeter != '' && today_hourmeter != null)
      {
          var today_hourmeter = parseFloat(today_hourmeter);
          $("#today_hm").empty().append(today_hourmeter.toFixed(1));
      }else{
        $("#today_hm").empty().append('0');
      }

      var internal_battery_voltage = data.internal_battery_voltage;
      var real_odo=data.real_odo+" KM";
       var today_km = data.today_km;   
      
     if(today_km != '' && today_km != null && today_km > 0){
          var today_km = parseFloat(today_km);
        $("#today_km").empty().append(today_km.toFixed(2)+' KM');
      }else{
        $("#today_km").empty().append('0');
      }
      
      if(v_ac == '1'){            //AC ON - CHANGE TO GREEN
        $("#ac_status").empty().append('<b>ON</>');
      }else if(v_ac == '0' || v_ac == ''){        //AC - OFF CHANGE TO RED
        $("#ac_status").empty().append('<b>OFF</b>');
      }
      if(data.mdvr_terminal_no!=0 && data.mdvr_terminal_no!=null)
      {
         $('.mdvr_terminal_no').removeClass('hidden');
      
         var mdvr_url="http://52.27.39.152/808gps/open/player/video.html?account=nexvision&password=000000&vehiIdno="+data.mdvr_terminal_no+"&lang=en";
         $("#mdvr_terminal_no").empty().append('<a target="_blank" href="'+mdvr_url+'">Click Here</a>');
      }

     

      $("#vehicleNo").empty().append(data.vehiclename);
      $("#eta").empty().append(data.hub_ETA);
      $("#dte").empty().append(data.DTE+" KM");
       $("#driver_name").empty().append(data.driver_name);
           if(data.device_config_type==2)
            {
              $("#real_odo").empty().append(real_odo);
              $("#engine_speed").empty().append(data.engine_speed);
              $("#coolant_level").empty().append(data.coolant_level);

              $("#engine_load").empty().append(data.engine_load);

              $("#coolant_temperature").empty().append(data.coolant_temperature);

              $("#lut").empty().append(data.lut);
               $(".odo_data").hide();
                $(".real_odo").show();
            }
            else
            {
              $(".real_odo").hide();
            }

      if(v_status == 1 && v_speed >0){
        $("#vehicle_status").empty().append('<b>MOVING</>');
      }else if(v_status == '1' && v_speed <= 0){
        $("#vehicle_status").empty().append('<b>ON</>');
      }
      else if(v_status == '0' || v_status == ''){
        $("#vehicle_status").empty().append('<b>OFF</b>');
      }

      if(v_km != ''){
          var val_km = parseFloat(v_km);
        $("#kilometer").empty().append(val_km.toFixed(2));
      }else{
        $("#kilometer").empty().append('0');
      }

      
      if(v_odometer != ''){
          var v_odometer = parseFloat(v_odometer);
          //alert(v_odometer);
        $("#odometer").empty().append(v_odometer.toFixed(2));
      }else{
        $("#odometer").empty().append('0');
      }
       
      if(v_ft == ''){
        v_ft = '250';//IF FUEL TANK CAPACITY IS NOT GIVEN DEFAULT  250 LTR
      }

      
      if(data.asset_type==1)
        {


          var battery =parseInt(data.car_battery)+' %';

          $("#devicebattery").empty().append(battery);
          $("#car_battery").empty().append("N/A");
          $("#internal_battery_voltage").empty().append("N/A");
        }
        else
        {

          
      if(v_battery || v_dv_battery || v_charge_status)
      {
        
        if(v_dv_battery !='0' || v_charge_status !='0' || v_dv_battery !='' || v_charge_status !='')
        {
          $("#devicebattery").empty().append(parseFloat(v_dv_battery).toFixed(2)+" %");
          $("#car_battery").empty().append(parseFloat(v_battery).toFixed(2)+" Volt");
        }
        else
        {
          $("#db_img").hide();$("#db_img_v").hide();$("#cb_img").show();$("#cb_img_v").show();
          $("#car_battery").empty().append(parseFloat(v_battery).toFixed(2)+" Volt");
        }
      }
      else
      {
        $("#car_battery").empty().append("N/A");$("#db_img").show();$("#db_img_v").show(); $("#cb_img").show();$("#cb_img_v").show();
        $("#devicebattery").empty().append("N/A");

     

      }
      if(internal_battery_voltage!=null && internal_battery_voltage!='0' && internal_battery_voltage!='')
      {
        $("#internal_battery_voltage").empty().append(parseFloat(internal_battery_voltage).toFixed(2)+" Volt");
      }
      else
      {
            $("#internal_battery_voltage").empty().append("N/A");
      }

        }



          $("#max-fuel").empty().append(v_ft+"/"+v_fuel);
            if(data.update_time <= 10)
            {
               

            if(data.last_dur){

              var last_off = data.last_dur;

              var tims_len = last_off.length;

           
              var last_off_new;
            

              if(tims_len < 9){

                  var hrs = last_off.substring(0,2);

                  var mins = last_off.substring(3,5);

                  var secs = last_off.substring(6,8);
                
                  if(parseInt(hrs) == 0){

                    last_off_new = mins+' <b>mins</b> '+secs+' <b>sec</b>';

                  }else{

                    if(parseInt(hrs) > 24){

                        hrs = parseInt(hrs);

                        hrs = hrs / 24;

                        var day = parseInt(hrs);

                        last_off_new = day+' <b>Day</b> ';

                    }else{

                        last_off_new = parseInt(hrs)+' <b>hrs</b> '+mins+' <b>mins</b> '+secs+' <b>sec</b>';
                    }
                  
                  
                  }
                //  console.log(last_off_new);

              }else{

                  var hrs = last_off.substring(0,3);

                  hrs = parseInt(hrs);

                  hrs = hrs / 24;

                  var day = parseInt(hrs);

                  last_off_new = day+' <b>Day</b> ';
              }
              
            }else
            { 

              var last_off ='__:__:__';  
  
              var last_off_new = '---';

            }

        }
            else
            {
             // alert(data.no_last_dur);
              if(data.no_last_dur){

              var last_off = data.no_last_dur;

              var tims_len = last_off.length;

            
              var last_off_new;
            

                      if(tims_len < 9){

                          var hrs = last_off.substring(0,2);

                          var mins = last_off.substring(3,5);

                          var secs = last_off.substring(6,8);
                        
                          if(parseInt(hrs) == 0){

                            last_off_new = mins+' <b>mins</b> '+secs+' <b>sec</b>';

                          }else{

                            if(parseInt(hrs) > 24){

                                hrs = parseInt(hrs);

                                hrs = hrs / 24;

                                var day = parseInt(hrs);

                                last_off_new = day+' <b>Day</b> ';

                            }else{

                                last_off_new = parseInt(hrs)+' <b>hrs</b> '+mins+' <b>mins</b> '+secs+' <b>sec</b>';
                            }
                          
                          
                          }
                        

                      }
                  else{

                      var hrs = last_off.substring(0,3);

                      hrs = parseInt(hrs);

                      hrs = hrs / 24;

                      var day = parseInt(hrs);

                      last_off_new = day+' <b>Day</b> ';
                  }
                  
            }
            else
            { 

              var last_off ='__:__:__';  
  
              var last_off_new = '---';

            }
            }
              // console.log(data.latlon_address);
             $("#onduration").empty().append(last_off_new);
              $("#address").empty().append(data.latlon_address);
                $("#altitute").empty().append(data.altitude);
               $("#gpssignal").empty().append(data.gpssignal);
                 $("#gsmsignal").empty().append(data.gsmsignal);
              

    }


          function smooth_move(){
update_status_table();

// alert('hii');
var id = $('#selected_vid').val();

$.ajax({
url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
type: 'GET',
dataType : "json",
success: function(data) {

//alert(data);
single_vehicle_route1(map,data);
var e_lat = data.lat;
var e_lng = data.lng;

},error:function(){
console.log('error');
}
});



$.ajax({
url: '<?php echo site_url('/Dashboard/single_vehicle_loc/');?>'+id,//get current ignition route from db
type: 'GET',
dataType : "json",
success: function(data) {

// alert(data);
set_vehicle(data);
var e_lat = data.lat;
var e_lng = data.lng;

},error:function(){
console.log('error');
}
});



}


function update_status_table(){
            
          //  alert('hiii');
                 var v_status = $('#table_status').val();
                //  alert(v_status);
                  $.ajax({
                    url: '<?php echo site_url('/Dashboard/all_vehicle_loc/');?>'+v_status,//get current loc of all vehicle from db
                    type: 'GET',
                    dataType : "json",
                    success: function(data) {
                      
                    // $('#body-data').empty();
                    // $('#selected_vid').val(data[0].vehicleid);
                      
                      for (var j = 0; j < data.length; j++) { 
                        var v_u_time = parseInt(data[j].update_time);
                        // console.log(data[j].update_time);
                            var v_acc_on = parseInt(data[j].acc_on);
                            var v_speed = parseInt(data[j].speed);
            
                             switch(data[j].vehicle_type) {//get vehicle type
            
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
            
                          var vehicle_sleep =parseInt(data[j].vehicle_sleep);
            
                            if(v_u_time <= 10)
                            {
                              if(vehicle_sleep==3)
                              {
                                  var image = '<span style="color:#147fc7">'+image_path+'</span>&nbsp;';
                                      var status_cont = 'PARKING';
                              }
                              else if(v_acc_on == 1)
                              {
                                if(v_speed >0)
                                {
                                     if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                                    {
                                       var image = '<span style="color:green">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                       var status_cont = 'MOVING';
                                    }
                                    else
                                    {
                                      var image = '<span style="color:green">'+image_path+'</span>&nbsp;';
                                      var status_cont = 'MOVING';
                                    }
                                }else{
            
                                     if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                                    {
                                       var image = '<span style="color:#fabf2c">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                       var status_cont = 'MOVING';
                                    }
                                    else
                                    {
                                       var image ='<span style="color:#fabf2c">'+image_path+'</span>&nbsp;'; 
                                      var status_cont = 'IDLE';
                                    }
                                  
                                }
                              }else
                              {
                                if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                                {
                                   var image = '<span style="color:blue">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                  var status_cont = 'PARKING';
                                }
                                else
                                {
                                  var image = '<span style="color:blue">'+image_path+'</span>&nbsp;'; 
                                  var status_cont = 'PARKING';
                                }
                                 
                              }
                              //alert('hi');
                            }else
                            {
                                 if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                                    {
                                       var image = '<span style="color:#a89e9e">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                       var status_cont = 'MOVING';
                                    }
                                    else
                                    {
                                         var image = '<span style="color:#a89e9e">'+image_path+'</span>&nbsp;';
                                        var status_cont = 'GSM Lost';
                                    }
                             
                            }
                        var img_cont = image; 
            
                      
            
                        var vehic_upt = 'vehic_upt'+data[j].vehicleid;
                        if(data[j].updatedon){var update_valu = data[j].updatedon;}else{var update_valu ='____:__:__ __:__:__';}
                        $('#updatedtime_'+data[j].vehicleid).empty().html(update_valu);
                        var vehic_status = 'vehic_status'+data[j].vehicleid;
                        $('#vehicle_icon_'+data[j].vehicleid).empty().html(img_cont);
                     //   alert(img_cont);
            
            
                        // var tr_row = '<tr class="tr-a vid_val" id="vid_'+data[j].vehicleid+'" onclick="selectone( '+data[j].vehicleid+');"><td class="tdth text-center status_running" id="vehic_status_'+data[j].vehicleid+'">'+img_cont+'</td><td style="text-align: left !important;font-size: 12px;" class="tdth text-center"> <p id="vehic_reg_'+data[j].vehicleid+'" style="margin-bottom:0px">'+data[j].vehiclename+'</p><small id="vehic_upt<'+data[j].vehicleid+'">'+update_valu+'</small> <td><div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown"><div class="btn-group" role="group"> <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="font-size: 10px;"><a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style="padding-left: 10px;"><i class="fa fa-play"></i>&nbsp;Playback</a><a class="dropdown-item" href="component-buttons-extended.html" style="padding-left: 10px;"><i class="fa fa-share-alt"></i>&nbsp; Share position</a></div></div></div></td></tr>';
            
                        // console.log(tr_row);
            
                        //   $('#body-data').append(tr_row);
            
                        var last_off_upt = 'parker_status'+data[j].vehicleid;
            
                        var vehic_reg = 'vehic_reg'+data[j].vehicleid;
            
                        $('#single_vehiclename_'+data[j].vehicleid).empty().append(data[j].vehiclename);
              
                      }
               
                    // $('#vid_'+data[0].vehicleid).addClass('highlighted');
                    // $("#selected_vid").val(data[0].vehicleid);
            
            
            
                    },error:function(){
                      console.log('error');
                    }
                  });
             
                }
      

         function single_vehicle_route1(map,data)
    {
        
// alert('inn');
      var location_lat = parseFloat(data.lat);
          var location_lng = parseFloat(data.lng);

        var map_center,path_bounds;
        var angle=data.angle;

        var v_u_time = parseInt(data.update_time);
        var v_acc_on = parseInt(data.acc_on);
        var v_speed = parseInt(data.speed);
        if(data.asset_type==1)
        {
          var battery =parseInt(data.car_battery)+' %';
        }
        else
        {
          var battery =parseFloat(data.car_battery).toFixed(2)+' volt';
        }

        
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

                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Speed:</b> '+Math.round(data.speed)+' km/hr <br><b>Battery:  </b> '+battery+'  <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'<br></div>';


                        }else{
                          var status_cont = 'IDLE';
                          color='#fabf2c';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                        }
                      }else
                      {
                          var status_cont = 'PARKING';
                          color='#337ab7';
                          var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery:  </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                      }
                    }else
                    {
                       var status_cont = 'GSM Lost';
                       color='#a89e9e';
                       var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                    }
                }else
                {
                    var status_cont = 'GSM Lost';
                       color='#a89e9e';
                        var marker_content = '<div style="width: 250px;"><b>Vehicle No:</b> '+data.vehiclename+'<br><b>Status:</b> <span style="color:'+color+'"><b>'+status_cont+'</b></span><br><b>Battery: </b> '+battery+' <br><b>Last Updated on:</b> '+data.updatedon+'<br><b>Lat/Long:</b> '+ parseFloat(data.lat).toFixed(4)+','+parseFloat(data.lng).toFixed(4)+'</br></div>';

                }
                var vehicle_type = parseInt(data.vehicle_type);
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
                        
                
      var  pre_lat= $('#pre_lat').val();
      var pre_lng = $('#pre_lng').val();
      var pre_angle = $('#pre_angle').val();
        var path_coords = new Array();
        path_coords.push('{ lat :' +location_lat+ ',lng : '+location_lng+ ' }'); //push all lat lng to path coords array

        var path_coords = eval("[" + path_coords + "]");
     
        var image = {
        url: image_path, // image is 512 x 512
        scaledSize : new google.maps.Size(35, 35)
    };

//         var numDeltas = 100;
//         var delay = 10; //milliseconds
//         var i = 0;
//         var deltaLat;
//         var deltaLng;


//         deltaLat = (location_lat - pre_lat)/numDeltas;
//        deltaLng = (location_lng -pre_lng)/numDeltas;
//        moveMarker();
//     function moveMarker(){
//       pre_lat += deltaLat;
//       pre_lng += deltaLng;
//     var latlng = new google.maps.LatLng(pre_lat, pre_lng);
//     marker.setTitle("Latitude:"+pre_lat+" | Longitude:"+pre_lng);
//     marker.setPosition(latlng);
    
//         setTimeout(moveMarker, delay);
    
// }

   


          deleteMarker();
          marker = new google.maps.Marker({
            position : new google.maps.LatLng(location_lat, location_lng),
            map : map,
            color : "#00bb00",          
            icon : image,
          });
           markers.push(marker);
           var bounds = new google.maps.LatLngBounds();
           bounds.extend(new google.maps.LatLng(location_lat, location_lng));
           map.fitBounds(bounds);
          map.setZoom(16);//line added
  function deleteMarker() {
  if (marker) {
    //console.log(markers); 
   // alert('hghgj');
    marker.setMap(null);
    marker = null;
  }
}



         $('#pre_lat').empty().val(location_lat);
        $('#pre_lng').empty().val(location_lng);
         $('#pre_angle').empty().val(angle);


          var infowindow = new google.maps.InfoWindow({
  content:marker_content
  });
var i = 0;
  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                    //  infowindow.setContent(new google.maps.LatLng(location_lat, location_lng));
                        infowindow.open(map, marker);
                    }
                })(marker, i));

    }
    var $primary="#00b5b8",$secondary="#2c3648",$success="#0f8e67",$info="#179bad",$warning="#ffb997",$danger="#ff8f9e",
        $themeColor=[$primary,$success,$warning,$info,$danger,$secondary];
//=====================================================================================================   
        
        function update_graph() {
           
      var firstid =  $('#selected_vid').val();
      // alert(firstid);
//======================================================================        
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_distance_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' :firstid},
                        success: function(data){
                          //  alert(data);
                            var obj = JSON.parse(data);
                            $("#distance-basic-chart").empty();
                            (obj == null) ? $("#distance-basic-chart").append('<div class="alert alert-danger mb-1" role="alert"><strong>No data Found!......</strong></div>') :  graph_distance(obj);
                           
                            }
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_parking_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                            var obj = JSON.parse(data);
                            $("#parking-basic-chart").empty();
                            (obj == null) ? $("#parking-basic-chart").append('<div class="alert alert-danger mb-1" role="alert"><strong>No data Found!......</strong></div>') :  graph_parking(obj);

                          }
                           
                          
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_idle_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                            var obj = JSON.parse(data);
                       $("#idle-basic-chart").empty();
                            (obj == null) ? $("#idle-basic-chart").append('<div class="alert alert-danger mb-1" role="alert"><strong>No data Found!......</strong></div>') :  graph_idle(obj);      
                            }
                });
                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_trip_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : firstid},
                        success: function(data){
                            var obj = JSON.parse(data);
                             $("#trip-basic-chart").empty();
                            
                            (obj == null) ? $("#trip-basic-chart").append('<div class="alert alert-danger mb-1" role="alert"><strong>No data Found!......</strong></div>') :  graph_trip(obj); 

                            }
                });

                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_fuelfill_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' :firstid},
                        success: function(data){
                          //  alert(data);
                            var obj = JSON.parse(data);
                            $("#fuelrefill-basic-chart").empty();
                            (obj == null) ? $("#fuelrefill-basic-chart").append('<div class="alert alert-danger mb-1" role="alert"><strong>No data Found!......</strong></div>') :  graph_fuelfill(obj);
                           
                            }
                });

                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_fuelconsume_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' :firstid},
                        success: function(data){
                          //  alert(data);
                            var obj = JSON.parse(data);
                            $("#fuelconsume-basic-chart").empty();
                            (obj == null) ? $("#fuelconsume-basic-chart").append('<div class="alert alert-danger mb-1" role="alert"><strong>No data Found!......</strong></div>') :  graph_fuelconsum(obj);
                           
                            }
                });

                $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/all_fueldip_data'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' :firstid},
                        success: function(data){
                          //  alert(data);
                            var obj = JSON.parse(data);
                            $("#fueldrain-basic-chart").empty();
                            (obj == null) ? $("#fueldrain-basic-chart").append('<div class="alert alert-danger mb-1" role="alert"><strong>No data Found!......</strong></div>') :  graph_fueldip(obj);
                           
                            }
                });


            }
     
// ===========================================================================   
function graph_trip(obj){
    var total = obj.length;
    var tripData = [];
    for(var i=0;i<total;i++){
        tripData[i] = [obj[i].date,obj[i].minis];
    }   
    // console.log(tripData);
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Trip",
                data: tripData
            },        
        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Time "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Hours"}}},
            fill: {
                colors: ['#24ba11']
                },
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#trip-basic-chart"),columnBasicChart);
column_basic_chart.render();
}
// ===========================================================================   
function graph_idle(obj){
    var total = obj.length;
    var idleData = [];
    for(var i=0;i<total;i++){
   idleData[i] = [obj[i].date,obj[i].idle_minitues];
    }   
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Idle",
                data: idleData
            },        
        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Time "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Hours"}}},
            fill: {
                colors: ['#d6ce09']
                },
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#idle-basic-chart"),columnBasicChart);
column_basic_chart.render();
}
// ===========================================================================   
  function graph_parking(obj){
    var total = obj.length;
    var parkingData = [];
    for(var i=0;i<total;i++){
        parkingData[i] = [obj[i].date,obj[i].park_minitues];
    }   
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"35%"}},
//            dataLabels:{enabled:!0},
            dataLabels:{position: 'bottom'},
            
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Parking",
                data: parkingData
            },        
        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Time "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Hours"}}},
            fill: {colors: ['#0c36aa']},
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#parking-basic-chart"),columnBasicChart);
column_basic_chart.render();
}

//============================================================
     function graph_distance(obj){
    var total = obj.length;
    var distanceData = [];
    for(var i=0;i<total;i++){
   distanceData[i] = [obj[i].date,obj[i].distance_km];
    }
//    console.log(distanceData);    
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Distance",
                data: distanceData
            },
//                 {
//                name: "Nelson",
//                data: distanceData
//            }
        
        ],
                xaxis: {
                type: 'datetime'
                },
//            series:[
//                {name:"Running",data:[44,55,57,56,61,58,63,60,66]},
//                {name:"Idle",data:[76,85,101,98,87,105,91,114,94]},
//                {name:"Parking",data:[35,41,36,26,45,48,52,53,41]}
//        ],
//            xaxis:{categories:["Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct"]},
            yaxis:{title:{text:"Kilometer "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Kilometer"}}},
             fill: {colors: ['#11a3c2']},
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#distance-basic-chart"),columnBasicChart);
column_basic_chart.render();

}



//============================================================ Fuel FILL CHART
function graph_fuelfill(obj){
    var total = obj.length;
    var fuelfill = [];
    for(var i=0;i<total;i++){
      fuelfill[i] = [obj[i].date,obj[i].fuel_fill_litre];
    }
//    console.log(distanceData);    
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Fuel Fill",
                data: fuelfill
            },

        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Ltr "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Ltr"}}},
             fill: {colors: ['#e01912']},
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#fuelrefill-basic-chart"),columnBasicChart);
column_basic_chart.render();

}



//============================================================ Fuel FILL CHART
function graph_fuelconsum(obj){
    var total = obj.length;
    var fuelconsume = [];
    for(var i=0;i<total;i++){
      fuelconsume[i] = [obj[i].date,obj[i].fuel_consumed_litre];
    }
//    console.log(distanceData);    
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Fuel Consume",
                data: fuelconsume
            },

        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Ltr "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Ltr"}}},
             fill: {colors: ['#e62cc3']},
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#fuelconsume-basic-chart"),columnBasicChart);
column_basic_chart.render();

}



//============================================================ Fuel Dip CHART
function graph_fueldip(obj){
    var total = obj.length;
    var fuel_dip = [];
    for(var i=0;i<total;i++){
      fuel_dip[i] = [obj[i].date,obj[i].fuel_dip_litre];
    }
//    console.log(distanceData);    
         columnBasicChart={
            chart:{height:350,type:"bar"},
            plotOptions:{bar:{horizontal:!1,columnWidth:"30%"}},
            dataLabels:{enabled:!1},
            stroke:{show:!0,width:1,colors:["transparent"]},
             series: [
                 {
                name:"Fuel Dip",
                data: fuel_dip
            },

        ],
                xaxis: {
                type: 'datetime'
                },
            yaxis:{title:{text:"Ltr "}},
            fill:{opacity:1},
            tooltip:{y:{formatter:function(e){return" "+e+" Ltr"}}},
             fill: {colors: ['#506cd9']},
        },           
                
column_basic_chart=new ApexCharts(document.querySelector("#fueldrain-basic-chart"),columnBasicChart);
column_basic_chart.render();

}

</script>