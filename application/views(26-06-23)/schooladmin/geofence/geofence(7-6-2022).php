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
                                            <li><a data-action="close" onclick="location.reload();"><i class="feather icon-x"></i></a></li>
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
                                        <label for="Location_short_name" class="required requirednet">Location Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" id="Location_short_name" name="Location_short_name" placeholder="Enter the Location Name"><div class="div1" id="div1"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="Lat" class="required requiredimei">Latitute<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control allow-numeric" name="Lat" id="Lat" placeholder="Enter the Lat" maxlength="13">
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

                                     <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Status</label>
                                            <select class="form-control" id="activecode" name="activecode">
                                               
                                                <option value="1">Active</option>
                                                <option value="2">Deactive</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <input type="hidden" name="Location_Id" id="Location_Id" value="">

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                       <input type="submit" class="btn btn-primary btn-min-width mr-1 btn-next btn-next1" value="Submit" id='submit'>
                                      <button type="button" class="btn btn-primary btn-min-width" id="closeform">Reset</button>
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
<!--                        <div class="card-header">
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
                        </div>-->
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

        $(document).ready(function () {

         $('.adduser').hide(); 

    });

    </script>

  <script>           
  $("#geofenceform").submit(function(e) {
          
              var Location_Id= $('#Location_Id').val();   
              e.preventDefault(); 
              var form = $(this);
          
                  var url = '<?php echo site_url('geofence/savegeofence');?>';
                  $.ajax({
                       type: "POST",
                       url: url,
                       data: form.serialize(), // serializes the form's elements.
                       success: function(data)
                       {
                           // alert(data);
                              $('.adduser').hide();  //Add userpage hide
                              $('#configuration').show();
                               location.reload(true);
                       }
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
                $("#Lat").val(obj.Lat);
                $('#Lng').val(obj.Lng);     
                $('#radius').val(obj.radius);                               
                $("#activecode").val(obj.activecode);   
                $('#Location_Id').val(obj.Location_Id);             

          },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    });

});


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