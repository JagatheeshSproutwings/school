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
                    <h3 class="content-header-title mb-0">routes</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a> </li>
                                <li class="breadcrumb-item active">routes</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showroute" type="button"> <i class="feather icon-user-plus icon-left"></i> Add route </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 addroute">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add route</h4> <a class="heading-elements-toggle "><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close" class='closeroute'><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="routeform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">route Details</h4>
                                  </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="route_name">Route Name</label>
                                            <input type="text" class="form-control" id="route_name" name="route_name" placeholder="Enter route Name">
                                        </fieldset>
                                    </div>




                                   <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="start_location">Start Location</label>
                                   
                                           <select class="form-control" id="route_geo_start_id" name="route_geo_start_id">
                                               <option value="">Select Location</option>
                                               <?php if ($geo_location) {

                                                foreach ($geo_location as $dlist) { ?>
                                                   
                                                     <option value=<?php echo $dlist->Location_Id;?>><?php echo $dlist->Location_short_name;?></option>

                                            <?php  }
                                                   

                                               } ?>
                                              
                                          </select>

                                        </fieldset>
                                    </div>

                                      <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="start_location">End Location</label>
                                   
                                           <select class="form-control" id="route_geo_end_id" name="route_geo_end_id">
                                               <option value="">Select Location</option>
                                               <?php if ($geo_location) {

                                                foreach ($geo_location as $dlist) { ?>
                                                   
                                                     <option value=<?php echo $dlist->Location_Id;?>><?php echo $dlist->Location_short_name;?></option>

                                            <?php  }
                                                   

                                               } ?>
                                              
                                          </select>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                               <div class="form-group">
                                <label>Route Starttime</label>
                                <div class='input-group date' id='datetimepicker03'>
                                    <input type='text' class="form-control" name="route_starttime" id="route_starttime">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="feather icon-clock"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                                    </div>

                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                         <div class="form-group">
                                <label>Route Endtime</label>
                                <div class='input-group date' id='datetimepicker04'>
                                    <input type='text' class="form-control" name="route_endtime" id="route_endtime">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="feather icon-clock"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                     
                                    <input type="hidden" id="route_id" name="route_id" value="">
                                   

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
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>route Name</th>
                                            <th>route Start Location</th>
                                            <th>route End Location</th>
                                            <th>route Start Time</th>
                                            <th>route End Time</th>
                                            <th>Number of stops</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                       <?php
                                        $count_sno = 1;
                                      if(isset($route_list)){
                                            foreach ( $route_list as $list ) {
                                                ?>
                                      
                                        <tr>
                                             <th scope="row"> <?=$count_sno++;?>
                                        </th>
                                                <td><?=$list->route_name;?></td>

                                                <td><?php $ign_q = $this->db->query("SELECT Location_short_name as location_name FROM sch_location_list WHERE Location_Id='".$list->route_geo_start_id."'");
                                                  $ign_f = $ign_q->row();
                                                  echo $ign_f->location_name;
                                                   ?></td>   
                                                <td><?php $ign_p = $this->db->query("SELECT Location_short_name as location_name FROM sch_location_list WHERE Location_Id='".$list->route_geo_end_id."'");
                                                  $ign_e = $ign_p->row();
                                                  echo $ign_e->location_name;
                                                   ?></td>  
                                                     <td><?=$list->route_starttime;?></td>
                                                     <td><?=$list->route_endtime;?></td>
                                          <td><button type="button" class="btn btn-icon btn-pure danger mr-1" title="stops" class="route_stop">&emsp;&emsp;&emsp;
                                         
                                          <a href="<?php echo base_url('route_stop/stop_details/'.$list->route_id);?>"><i class="fas fa-route fa-spin" style="font-size:30px;color:purple;"></i></a></button></td>
                                            <td>

                                                <a href="javascript:editdata(<?php echo $list->route_id;?>)" class="editroute"  id="<?php echo $list->route_id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                                &nbsp;&nbsp; <a href="javascript:deletedata(<?php echo $list->route_id;?>)" id="<?php echo $list->route_id;?>" class="deleteroute"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                                &nbsp;&nbsp; <a href="<?php echo base_url();?>Route/map_list/<?php echo $list->route_id; ?>" class="showroute"><i class="fa fa-eye " aria-hidden="true"></i></a>
                                                &nbsp;&nbsp; <a href="<?php echo base_url();?>Route/get_excel/<?php echo $list->route_id; ?>" class="showroute"><i class="fa fa-file " aria-hidden="true"></i></a>
                                           
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
    

          $(document).ready(function () {

            $("#route_geo_start_id").select2();
            $("#route_geo_end_id").select2();
           $('.addroute').hide(); 

           
            });
             

    $("#routeform").submit(function(e) {
          
              var route_id = $('#route_id').val();
              e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
   

    var url = '<?php echo site_url('route/saveroute');?>';

      $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
                 $('.addroute').hide();  //Add userpage hide
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
            url:"<?php echo site_url('route/deleteroute/');?>",
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



     $("#showroute").click(function(){

     $('.addroute').show(1000);  //Add userpage hide
       $('#configuration').hide();// hide view page
        $('#showroute').hide();// hide view page

     });



     $(".closeroute").click(function(){

     $('.addroute').hide(1000);  //Add userpage hide
       $('#configuration').show();// hide view page
        $('#showroute').show();
     });

       $("#closeform").click(function(){

      location.reload(); 
     });


   function editdata(thisid)
   {
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route/editroutedata/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.addroute').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
              //console.log(response); 
             // alert(response);
              
                $("#route_name").val(obj.route_name);

                $("#route_geo_start_id").val(obj.route_geo_start_id).trigger('change');
                $("#route_geo_end_id").val(obj.route_geo_end_id).trigger('change');
          
                // $("#route_geo_start_id").val(obj.route_geo_start_id);
                // $("#route_geo_end_id").val(obj.route_geo_end_id);
                $("#route_starttime").val(obj.route_starttime);
                $("#route_endtime").val(obj.route_endtime);
                 $('#route_id').val(obj.route_id);

       
               
            },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    }
    </script>