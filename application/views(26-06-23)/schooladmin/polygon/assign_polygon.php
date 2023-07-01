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
                    <h3 class="content-header-title mb-0">ASSIGN POLYGON</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> ASSIGN POLYGON</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Assign  polygon </button>
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
                                    <h4 class="card-title">Assign polygon </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close" onclick="location.reload();"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="assignpolygonform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Assign polygon Details</h4>
                                              </div>

                                               <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="latitute" class="required requiredimei">polygon name<span class="error">&nbsp;*</span></label>
                                        <select class="select2 form-control" id="polygon_id" name="polygon_id">
                                                <option value="">Select location Name</option>
                                             <?php if ($location_list) {
                                                foreach ($location_list as $list) { ?>
                                                     <option value="<?php echo $list->polygon_id;?>"><?php echo $list->polygon_name;?></option>
                                                    <?php   }  }?>
                                              
                                            </select>
                                        <div class="div2" id="div2"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="vehicle_id" class="required requirednet">Vehicle name<span class="error">&nbsp;*</span></label>
                                         <select class="select2 form-control" id="vehicle_id" name="vehicle_id[]" multiple="multiple">
                                               <option value="1">All vehicles</option>
                                             <?php if ($vehicle_list) {
                                                foreach ($vehicle_list as $vlist) { ?>
                                                     <option value="<?php echo $vlist->vehicleid;?>"><?php echo $vlist->vehiclename;?></option>
                                                    <?php   }  }?>
                                              
                                            </select>

                                       <div class="div1" id="div1"></div>
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

                                    <input type="hidden" name="id" id="id" value="">

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
                            <div class="card-body card-dashboard">
                             
                                <div class="table-responsive">

                                <table  id="vehiclelist" class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>                                                                                     
                                            <th>Vehicle Name </th>
                                            <th>Polygon Name </th>                                            
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         $count_sno = 1;

                                         foreach ($assign_geofence as $list) {
                                               ?>
                                        <tr>
                                            <th scope="row"> <?=$count_sno++;?>
                                            <td><?=$list->vehiclename;?> </td>
                                            <td><?=$list->polygon_name;?></td>                                        
                                                                                        
                                            <td><!--  <a href="#" class="edit"  id="<?php echo $list->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> --> &nbsp;&nbsp; <a href="javascript:delete_data('<?php echo $list->id;?>')"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                        <!--     <a href="#" id="" class="deleteuser"></a> -->
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
 $('#vehicle_id').change(function(){
      var data = $(this).children("option:selected").val();
      if(data==1){
        $('#vehicle_id option:not(:first)').prop('selected',false);
      }
  });      
  $("#assignpolygonform").submit(function(e) {
          
              var id= $('#id').val();   
              e.preventDefault(); 
              var form = $(this);
                
                console.log(form.serialize());
                  var url = '<?php echo site_url('polygon/save_assign_polygon');?>';
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
            url:"<?php echo site_url('assign_geofence/edit_assign_geofence/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                console.log(response);
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);

                $("#geo_location_id").val(obj.geo_location_id);                   
                $('#vehicle_id').val(obj.vehicle_id); 
                $('#id').val(obj.id);             

          },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    });

});



function delete_data(thisid) 
{
   
       
        //alert(thisid);
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('Polygon/delete_assign_polygon/');?>",
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



     $("#showuser").click(function(){

     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });
        
        



</script>