<?php 
    $role =$this->session->userdata['roleid']; ?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">routes assign</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Home</a> </li>
                                <li class="breadcrumb-item active">routes assign</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showrouteassign" type="button"> <i class="feather icon-user-plus icon-left"></i> Assign route </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 addrouteassign" style="display:none;">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add routeassign</h4> <a class="heading-elements-toggle "><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close" class='closerouteassign'><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="routeassignform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">routeassign Details</h4>
                                  </div>
                                
                                   <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="start_location">Vehicle Name</label>
                                   
                                           <select class="form-control" id="vehicle_id" name="vehicle_id">
                                               <option>Select Vehicle Name</option>
                                               <?php if ($vehicle_list) {

                                                foreach ($vehicle_list as $dlist) { ?>
                                                   
                                                     <option value="<?php echo $dlist->vehicleid;?>"><?php echo $dlist->vehiclename;?></option>

                                            <?php  }
                                                   

                                               } ?>
                                              
                                          </select>

                                        </fieldset>
                                    </div>

                                      <div class="col-xl-2 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="start_location">Route Name</label>
                                   
                                           <select class="form-control" id="route_id" name="route_id">
                                               <option>Select Route Name</option>
                                               <?php if ($route_list) {

                                                foreach ($route_list as $dlist) { ?>
                                                   
                                                     <option value="<?php echo $dlist->route_id;?>"><?php echo $dlist->route_name;?></option>

                                            <?php  }
                                                   

                                               } ?>
                                              
                                          </select>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-2 col-lg-6 col-md-12">
                                    <fieldset>
                                   
                                          <label for="shift_type">Shift Type</label> 

                                               <select class="form-control" id="shift_type" name="shift_type">
                                               <option  value=1>Morning Shift</option>
                                               <option value=2>Evening Shift</option>
                                               </select>
                                        </fieldset>
                                   </div>


                                    <div class="col-xl-2 col-lg-6 col-md-12">
                                    <fieldset>
                                    <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="saturday_status" id="saturday_status" value="1">
                        <label class="custom-control-label" for="saturday_status">Saturday Route</label> 
                      
                                    </div>
                                        </fieldset>
                                   </div>

                                   <div class="col-xl-2 col-lg-6 col-md-12">
                                    <fieldset>
                                    <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="late_status" id="late_status" value="1">
                        <label class="custom-control-label" for="late_status">Vehicle Late Came</label> 
                      
                                    </div>
                                        </fieldset>
                                   </div>

                                    <input type="hidden" id="id" name="id" value="">
                                   

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                         <button type="submit" class="btn btn-primary btn-min-width mr-1"></i> Create</button>
                                      <button type="button" class="btn btn-primary btn-min-width mr-1" id="closeform">Reset</button>
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
                                    <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>-->
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Vehicle</th>
                                            <th>Route Name</th>
                                            <th>Shift Type</th>
                                            <th>Travel Start Date</th>
                                            <th>Travel End Date</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                       <?php
                                        $count_sno = 1;
                                      if(isset($routeassignlist)){
                                            foreach ( $routeassignlist as $list ) {
                                                ?>
                                      
                                        <tr>
                                             <th scope="row"> <?=$count_sno++;?>
                                        </th>
                                                <td><?=$list->vehiclename;?></td>
                                                <td><?=$list->route_name;?></td>
                                                <td><?php if($list->shift_type==1){echo "Morning Shift";}else {echo "Evening Shift"; } ?></td>
                                                <td><?=$list->travel_startdate;?></td>
                                                <td><?=$list->travel_enddate;?></td>
                                            <td>

                                                <a href="javascript:editdata(<?php echo $list->id;?>);" class="editrouteassign"  id="<?php echo $list->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                 &nbsp;&nbsp; <a href="javascript:deletedata(<?php echo $list->id;?>);" id="<?php echo $list->id;?>" class="deleterouteassign"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                            </td>
                                            
                                        </tr>
                                       
                                    <?php  } } ?>
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
    
    <script>

         $(function() {
        $("#datetimepicker03").datetimepicker({format:"LT"});
      });
      $(function() {
        $('#datetimepicker04').datetimepicker({format:"LT"});
      });
    

        //   $(document).ready(function () {

        //    $('.addrouteassign').hide(); 

           
        //    });
             

    $("#routeassignform").submit(function(e) {
          
              var id = $('#id').val();
              e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    //  console.log(form.serialize());
    // alert('fff');

    var url = '<?php echo site_url('route/saverouteassign');?>';

      $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
             // console.log(data);
             // alert(data);
                 $('.addrouteassign').hide();  //Add userpage hide
                  $('#configuration').show();
                   location.reload(true);
           }
         }); 
          

    
 });

 function deletedata(thisid)
 {

          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route/deleterouteassign/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
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


     $("#showrouteassign").click(function(){

     $('.addrouteassign').show(1000);  //Add userpage hide
       $('#configuration').hide();// hide view page
        $('#showrouteassign').hide();// hide view page

     });



     $(".closerouteassign").click(function(){

     $('.addrouteassign').hide(1000);  //Add userpage hide
       $('#configuration').show();// hide view page
        $('#showrouteassign').show();
     });

       $("#closeform").click(function(){

      location.reload(); 
     });



     function editdata(thisid) {
       
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route/editrouteassigndata/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.addrouteassign').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
             
                $('#vehicle_id').append("<option value='"+ obj.vehicleid +"'>" +obj.vehiclename+"</option>");     
                (obj.saturday_status==='1') ?  $('#saturday_status').prop('checked', true):  $('#saturday_status').prop('checked', false);
                (obj.late_status==='1') ?  $('#late_status').prop('checked', true):  $('#late_status').prop('checked', false);

                $("#vehicle_id").val(obj.vehicle_id);
                $("#shift_type").val(obj.shift_type);
                $("#route_id").val(obj.route_id);
                 $('#id').val(obj.id);

       
               
            },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    }
    </script>