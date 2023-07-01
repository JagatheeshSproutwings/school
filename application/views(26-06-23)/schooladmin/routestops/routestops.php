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
                    <h3 class="content-header-title mb-0">  <?php

              if($route_id!=''){ $ign_q = $this->db->query("SELECT route_name FROM sch_routestbl WHERE route_id='".$route_id."'");
                  $ign_f = $ign_q->row();
                  echo $ign_f->route_name; }?> routestop Details</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Home</a> </li>
                                <li class="breadcrumb-item active"><?php if($route_id!=''){ $ign_q = $this->db->query("SELECT route_name FROM sch_routestbl WHERE route_id='".$route_id."'");
                  $ign_f = $ign_q->row();
                  echo $ign_f->route_name; }?> routestop</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                              <button class="btn btn-outline-success" type="button"> <a href="<?php echo base_url('Route/');?>"><i class="feather icon-user-plus icon-left"></i> Back To Route</a></button>

                            <button class="btn btn-outline-primary" id="showroute" type="button"> <i class="feather icon-user-plus icon-left"></i> Add routestop</button>
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
                                    <h4 class="card-title">Add <?php

              if($route_id!=''){ $ign_q = $this->db->query("SELECT route_name FROM sch_routestbl WHERE route_id='".$route_id."'");
                  $ign_f = $ign_q->row();
                  echo $ign_f->route_name; }?>  routestop</h4> <a class="heading-elements-toggle "><i class="fa fa-ellipsis-v font-medium-3"></i></a>
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
                                                    <h5 class="text-bold-600">routestop Details</h4>
                                  </div>

                                  <!--   <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="stop_name">Stop Name</label>
                                            <input type="text" class="form-control" id="stop_name" name="stop_name" placeholder="Enter Stop Name">
                                        </fieldset>
                                    </div>

 -->


                                   <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="start_location">Start Location</label>
                                   
                                           <select class="form-control" id="stop_geo_id" name="stop_geo_id">
                                               <option>Select Location</option>
                                               <?php if ($geo_location) {

                                                foreach ($geo_location as $dlist) { ?>
                                                   
                                                     <option value="<?php echo $dlist->Location_Id;?>"><?php echo $dlist->Location_short_name;?></option>

                                            <?php  }
                                                   

                                               } ?>
                                              
                                          </select>

                                        </fieldset>
                                    </div>

                                   
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                               <div class="form-group">
                                <label> Arrival Time</label>
                                <div class='input-group date' id='datetimepicker03'>
                                    <input type='text' class="form-control" name="stop_arrival_time" id="stop_arrival_time">
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
                                <label>Starttime</label>
                                <div class='input-group date' id='datetimepicker04'>
                                    <input type='text' class="form-control" name="stop_start_time" id="stop_start_time">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="feather icon-clock"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                                    </div>

                                      <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Status</label>
                                            <select class="form-control" id="status" name="status">
                                               
                                                <option value="1">Active</option>
                                                <option value="2">Deactive</option>
                                            </select>
                                        </fieldset>
                                    </div>           
                                     
                                    <input type="hidden" id="route_id" name="route_id" value="<?php echo $route_id;?>">
                                     <input type="hidden" id="stop_id" name="stop_id" value="">
                                   

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
                        <div class="card-header">
                            <h4 class="card-title">Configuration option</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <!-- <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li> -->
                                    <!-- <li><a data-action="close"><i class="feather icon-x"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Stop Location</th>
                                            <th>Stop Arrival Time</th>
                                            <th>Stop Start Time</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                       <?php
                                        $count_sno = 1;
                                            if(isset($stop_list)){       
                                            foreach ( $stop_list as $list ) {
                                                ?>
                                        <tr>
                                             <th scope="row"> <?=$count_sno++;?>
                                        </th>
                                             
                                                <td><?php $ign_q = $this->db->query("SELECT Location_short_name as location_name FROM sch_location_list WHERE Location_Id='".$list->stop_geo_id."'");
                                                  $ign_f = $ign_q->row();
                                                  echo $ign_f->location_name;
                                                   ?></td>   
                                                  <td><?=$list->stop_arrival_time;?></td>
                                                     <td><?=$list->stop_start_time;?></td>
                                                     <td>
                                                <a href="javascript:editdata('<?php echo $list->stop_id?>');" class="editroute"  id="<?php echo $list->stop_id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                                 <a href="javascript:deletedata('<?php echo $list->stop_id?>')" id="<?php echo $list->stop_id;?>" class="deleteroute"><i class="fa fa-trash " aria-hidden="true"></i></a>
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
            $("#stop_geo_id").select2();
           $('.addroute').hide(); 

           
            });
             

    $("#routeform").submit(function(e) {
          
              var route_id = $('#route_id').val();
              e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
   

    var url = '<?php echo site_url('route_stop/saveroutestops');?>';

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


 function deletedata(thisid) {

      
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route_stop/deleteroutestop/');?>",
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


function editdata(thisid) {

   // alert(thisid);
    
      // var thisid = $(this).attr('id');

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route_stop/editroutestopdata/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.addroute').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
              console.log(response); 
          //    alert(response);
              
                
                $("#stop_arrival_time").val(obj.stop_arrival_time);
                $("#stop_start_time").val(obj.stop_start_time);
                $("#route_starttime").val(obj.route_starttime);
                $("#stop_id").val(obj.stop_id);

                $('#stop_geo_id').append("<option value='"+ obj.stop_geo_id +"'>" +obj.location_name+"</option>");     
               $("#stop_geo_id").val(obj.stop_geo_id);   
              
       
               
            },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    }

    </script>