<?php 
    $role =$this->session->userdata['roleid']; 
      $client_id =$this->session->userdata['client_id']; ?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">route stops</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Home</a> </li>
                                <li class="breadcrumb-item active">route stops</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <?php

                    $ign_q = $this->db->query("SELECT route_geo_start_id,route_geo_end_id FROM polygon_routelist WHERE route_id='".$route_id."'");
                  $ign_f = $ign_q->row();
                  $start_polygon = $ign_f->route_geo_start_id;
                  $end_polygon =   $ign_f->route_geo_end_id;                 
              ?>
                             <button class="btn btn-outline-success" type="button"> <a href="<?php echo base_url('Route/poly_routes');?>"><i class="feather icon-user-plus icon-left"></i> Back To Route</a></button>
                            <button class="btn btn-outline-primary" id="showrouteassign" type="button"> <i class="feather icon-user-plus icon-left"></i> Route Stop </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 addrouteassign">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add route Stops</h4> <a class="heading-elements-toggle "><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close" onclick="location.reload();" class='closerouteassign'><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="polyroutestops" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">

                                      <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                           <label for="start_location">Start Location</label>
                                   
                                             
                                                    <select class="form-control" id="stop_geo_id" name="stop_geo_id[]" required>
                                                    <option value="">Select</option>
                                            
                                                <?php foreach ($polygon_list as $dlist) { ?>
                                                    <?php if(($start_polygon!= $dlist->polygon_id) || ($end_polygon!= $dlist->polygon_id)){?>
                                                      <option value="<?php echo $dlist->polygon_id;?>"><?php echo $dlist->polygon_name;?></option>

                                                  <?php  }  } ?>

                                              </select>
            
                                        </fieldset>
                                    </div>

                                    <input type="hidden" id="stop_id" name="stop_id" value="">
                                      <input type="hidden" id="route_id" name="route_id" value="<?php echo $route_id;?>">
                                   

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                         <button type="submit" class="btn btn-primary btn-min-width mr-1"></i> Create</button>
                                      <button type="button" class="btn btn-primary btn-min-width mr-1" id="closeform">Reset</button>
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
                                <table class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Location Name</th>
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
                                             
                                        <?php 
                                                    $start_loc = $this->db->query("SELECT polygon_name FROM polygon_list WHERE polygon_id = '".$list->stop_geo_id."'");
                                                    $start_data = $start_loc->row();
                                                ?>
                                                <td><?php echo $start_data->polygon_name;?></td> 
                                            <td>

                                                <a href="#" class="editrouteassign"  id="<?php echo $list->stop_id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp; <a href="#" id="<?php echo $list->stop_id;?>" class="deleterouteassign"><i class="fa fa-trash " aria-hidden="true"></i></a>
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


          $(document).ready(function () {

           $('.addrouteassign').hide(); 

           
            });
             

    $("#polyroutestops").submit(function(e) {
          
              var stop_id = $('#stop_id').val();
              e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = '<?php echo site_url('route/add_polygonroutestops');?>';

      $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
                 $('.addrouteassign').hide();  //Add userpage hide
                  $('#configuration').show();
                   location.reload(true);
           }
         }); 
          

    
 });


    $(document).ready(function(){  
   $('.deleterouteassign').click(function(){
        var thisid = $(this).attr('id');
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route/delete_polygonroutestops/');?>",
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
    });

});



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


 $(document).ready(function(){   
    $('.editrouteassign').click(function(){
       var thisid = $(this).attr('id');
     //  alert(thisid);
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route/edit_polygonroutestops/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.addrouteassign').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
              //console.log(response); 
             // alert(response);
                $('#stop_geo_id').val(obj.stop_geo_id); 
                $('#stop_id').val(obj.stop_id); 
                $("#route_id").val(obj.route_id);
             

       
               
            },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    });

});
    </script>