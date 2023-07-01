<!-- BEGIN: Body-->
<?php error_reporting(0);  

	$role =$this->session->userdata['role'];
	$clientid=$this->session->userdata['clientid'];

?>
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0"> ADD POLYGONS</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> POLYGONS</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  polygons </button>
                        </div>
                    </div>
                </div>
                <span id="waitmsg"></span>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adduser" style="display: none;">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">ADD POLYGON </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close" onclick="location.reload();"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                <form class="form-horizontal form-simple" id="polygonform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600"> POLYGON Details</h4>
                                    
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="polygon_name" class="required">Area Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" id="polygon_name" name="polygon_name" placeholder="Enter The Area Name" required><div class="div1" id="div1"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1" id='TextBoxesGroup'>
                                    <fieldset class="form-group">
                                        <div id="TextBoxDiv1">
                                        <label for="polygonlatlng" class="required">Area Points<span class="error">&nbsp;*</span><code>lattitute,longitute</code></label>
                                        <input type="text" class="form-control" id='textbox1' name="polygonlatlng[]" placeholder="Enter Lattitute, Longitute" required><div class="div1" id="div1"></div>
                                      </div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                <!-- <input class="btn btn-primary btn-min-width mr-1 btn-next" value="Add More" id='addButton'> -->
                                <button type="button" class="btn btn-success btn-min-width" id="addButton">Add More</button>
                                <button type="button" class="btn btn-success btn-min-width" id="addButton1"> Add More</button>
                                <button type="button" class="btn btn-danger btn-min-width" id="removeButton">Remove</button>
                                <button type="button" class="btn btn-warning btn-min-width" id="removeButton1"> Remove</button>
                                <input type="submit" class="btn btn-info btn-min-width mr-1 btn-next btn-next1" value="Submit" id='submit' style="margin-top: 23px;">
                                 <button type="button" class="btn btn-primary btn-min-width" id="closeform" style="margin-top: 23px;">Reset</button>  
                            </div>
                                    <input type="hidden" name="polygon_id" id="polygon_id" value="">
                                    <input type="hidden" name="counter_length" id="counter_length" value="">

                                <div class="col-xl-12 col-lg-12 col-md-12">
                                   
                                </div>


                                </form>

                                </div>
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
                        <div class="card-header">
                            <h4 class="card-title">Configuration option</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload"><istates class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                        <div class="row" >
                         <div class="col-8">
                            <div class="card-body card-dashboard">
                             
                                <div class="table-responsive">

                                <table  id="dealerlist" class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-primary">
                                    <tr>
                                    <th>S.No</th>
                                    <th>Area Name</th>
                                    <th>Latlng Points</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                   
                                    $i=1;
                            foreach($polygon_list as $value){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->polygon_name;?></td>
                                    <td><?php echo $value->polygon_points;?></td>
                                     <td> <a href="javascript:edit('<?php echo $value->polygon_id;?>')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp; 
                                            <a href="javascript:deletedata('<?php echo $value->polygon_id;?>')"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                           &nbsp; <a href="javascript:polymap('<?php echo $value->polygon_id;?>')"><i class="fa fa-eye " aria-hidden="true"></i></a>
                                           
                                        </td>    
                                 
                                </tr>

                            <?php $i++;} 

                            ?>
                                                                    
                                    </tbody>
                                </table>  
                              </div>                
                            </div>
                            </div>
                            <div class="col-4">
                            <div class="card-body card-dashboard">
                                <h2>POLYGON MAP</h2>
                            </div>
                            <div id="polygon_map" style="height:700px;width:100%;">
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

    <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.js"></script> 
  <script>
       //var StartMarker = {};
var polygon;
                 map = L.map('polygon_map').setView([11.0467,76.9254],6);
    L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:18}).addTo(map);
    var fg = L.featureGroup().addTo(map);
    var assetLayerGroup = new L.LayerGroup();
  </script>

    <script type="text/javascript">


$(document).ready(function(){

var counter = 2;
$('#removeButton1').hide();
$('#addButton1').hide();
$("#addButton").click(function () {
            
if(counter>17){
        alert("Only 17 textboxes allow");
        return false;
}   
    
var newTextBoxDiv = $(document.createElement('div'))
     .attr("id", 'TextBoxDiv' + counter);
             
newTextBoxDiv.after().html('<label  for="dealer_company" class="required">Area Points<span class="error">&nbsp;*</span><code>lattitute,longitute</code>'+ counter + ' : </label>' +
      '<input type="text" class="form-control" placeholder="Enter Lattitute Longitute" required name="polygonlatlng[]"  id="textbox' + counter + '" value="" >');
        
newTextBoxDiv.appendTo("#TextBoxesGroup");     
counter++;
 });

 $("#addButton1").click(function () {
    var counter = $('#counter_length').val();


            if(counter>17){
                    alert("Only 17 textboxes allow");
                    return false;
            }   
                
            var newTextBoxDiv = $(document.createElement('div'))
                 .attr("id", 'TextBoxDiv' + counter);
                         
            newTextBoxDiv.after().html('<label  for="dealer_company" class="required">Area Points<span class="error">&nbsp;*</span><code>lattitute,longitute</code>'+ counter + ' : </label>' +
                  '<input type="text" class="form-control" placeholder="Enter Lattitute Longitute" required name="polygonlatlng[]"  id="textbox' + counter + '" value="" >');
                    
            newTextBoxDiv.appendTo("#TextBoxesGroup");     
            counter++;
            $('#counter_length').val(counter);
             });


 $("#removeButton").click(function () {

 // alert(counter);
if(counter==2){
      alert("No more textbox to remove");
      return false;
   }   

counter--;
  //  console.log(counter);
    $("#TextBoxDiv" + counter).remove();
        
 });


 $("#removeButton1").click(function () {

var counter = $('#counter_length').val();
//alert(counter);
// var counter = 
if(counter==2){
 alert("No more textbox to remove");
 return false;
}   

counter--;
$('#counter_length').val(counter);
//  console.log(counter);
$("#TextBoxDiv" + counter).remove();
   
});


    
//  $("#getButtonValue").click(function () {
    
// var msg = '';
// for(i=1; i<counter; i++){
//      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
// }
//       alert(msg);
//  });
});

           $(document).ready(function () {

             $('.adduser').hide(); 

             
       $("#polygonform").submit(function(e) {
          
              var polygon_id= $('#polygon_id').val();   
              e.preventDefault(); 
              var form = $(this);
             //console.log(JSON.stringify(form.serialize()));
                  var url = '<?php echo site_url('Polygon/save_polygon');?>';
                  $.ajax({
                       type: "POST",
                       url: url,
                       data:form.serialize(),
                        beforeSend: function() {
                       $("#waitmsg").empty().append('<span id="waitmsg">Please Wait....</span>');
                        },
                       success: function(data)
                       {
                             $("#waitmsg").empty();
                             console.log(data);
                           // alert(data);
                              $('.adduser').hide();  //Add userpage hide
                              $('#configuration').show();
                               location.reload(true);
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

          
        
         });

            function edit(thisid) {
            //alert(thisid);
                $('#removeButton1').show();
                $('#removeButton').hide();
                $('#addButton').hide();
                $('#addButton1').show();
                
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('Polygon/editpolygon/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
               // console.log(response);
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);

                $("#polygon_name").val(obj.polygon_name);
                $("#textbox1").val(obj.polypoints[0].lat+','+obj.polypoints[0].lng);            
                $("#polygon_id").val(obj.polygon_id);  
                $("#counter_length").val(obj.polypoints.length+1);  
               //  console.log();
                for (let i = 1; i < obj.polypoints.length; i++) {
                    var j=i;
                    var k=i+1;
                    console.log(k);
                    var newTextBoxDiv = $(document.createElement('div'))
                        .attr("id", 'TextBoxDiv' + k);
                                
                    newTextBoxDiv.after().html('<label  for="dealer_company" class="required">Area Points<span class="error">&nbsp;*</span><code>lattitute,longitute</code>'+ k + ' : </label>' +
                        '<input type="text" class="form-control" placeholder="Enter Lattitute Longitute" required name="polygonlatlng[]"  id="textbox' + k + '" value="'+obj.polypoints[j].lat+','+obj.polypoints[j].lng+'" >');
                            
                    newTextBoxDiv.appendTo("#TextBoxesGroup");     
                    j++;
                    k++;
                 //   const element = array[i];
                    
                }
 
          },
            error: function(){
            console.log('Error While Request Dealer Edit List..');
            }

        });
           }


           function deletedata(thisid) {
         

         if(confirm("Are you sure you want to delete this?")){

                   $.ajax({
                       type:"POST",
                       datatype:"json",
                       url:"<?php echo site_url('Polygon/deletepolygon/');?>",
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

     }

function polymap(id) {

    $.ajax({
        url: '<?php echo site_url('/polygon/polygon_data/');?>'+id,//get current ignition route from db
        type: 'GET',
        dataType : "json",
        success: function(data) {
            console.log(data);
              var polyLayers = [];
                     output=[];
            console.log(polyLayers);
             if (polygon != undefined) {
               map.removeLayer(polygon);
            };
                   output = $.each(data.polypoints, function(index, value){
                       
                       return   [+value.lat, +value.lng];
                      //console.log(poly_data);
                    });
                   
                    polygon = L.polygon([output]);
                    console.log(output);
                  
                      polygon.bindPopup(data.polygon_name);
                       polygon.setStyle({color: data.color,fillColor: data.fillcolor});

                      polyLayers.push(polygon);

                 for(layer of polyLayers) {

                    fg.addLayer(layer); 

                     
                    }
                    assetLayerGroup.addLayer(polyLayers);
                    var group = new L.featureGroup(polyLayers);
                    map.fitBounds(group.getBounds());
                  
          

        },error:function(){
          console.log('error');
        }
      });
    
}

   


    </script>