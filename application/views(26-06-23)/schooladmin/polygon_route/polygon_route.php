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
                    <h3 class="content-header-title mb-0">routes plan</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Home</a> </li>
                                <li class="breadcrumb-item active">routes plan</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showrouteassign" type="button"> <i class="feather icon-user-plus icon-left"></i> Route Plan </button>
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
                                    <h4 class="card-title">Add route plan</h4> <a class="heading-elements-toggle "><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close"  onclick="location.reload();" class='closerouteassign'><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="polyroutes" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">

                                       <div class="col-xl-4 col-lg-6 col-md-12">
                                       <div class="form-group">
                                               
                                                <fieldset class="form-group">
                                                       <label for="start_location">Route Name</label>
                                                    <input type="text" class="form-control form-control" id="route_name" name='route_name' placeholder="Enter Route Name">
                                                </fieldset>
                                            </div>

                                         </div>

                                           <div class="col-xl-4 col-lg-6 col-md-12">
                                       <div class="form-group">
                                               
                                                <fieldset class="form-group">
                                                       <label>Ward Type</label>

                                                        <select class="form-control"  id="route_type" name="route_type" style="width: 100%;" required>
                                                              <option value="">select</option>
                                                           <option value="1" <?php if($route_details->route_type=='1'){echo "selected";}?>>INWARD</option>
                                                            <option value="2" <?php if($route_details->route_type=='2'){echo "selected";}?>>OUTWARD</option>
                                                                
                                                        </select>
                                                </fieldset>
                                            </div>

                                         </div>


                                      <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                           <label for="start_location">Start Point</label>
                                   
                                        <select class="form-control"  id="route_geo_start_id"  name="route_geo_start_id" required>

                                      <option value="">select</option>  
                                        <?php if ($polygon_list) {

                                            foreach ($polygon_list as $dlist) { ?>
                                            
                                                <option value="<?php echo $dlist->polygon_id;?>"><?php echo $dlist->polygon_name;?></option>

                                            <?php  }

                                            } ?>
                                         </select>

                                        </fieldset>
                                    </div>


                                      <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                           <label for="start_location">End Point</label>   
                                      <select class="form-control"  id="route_geo_end_id" name="route_geo_end_id" style="width: 100%;" required>
                                      <option value="">select</option>  
                                      <?php if ($polygon_list) {

                                        foreach ($polygon_list as $dlist) { ?>

                                            <option value="<?php echo $dlist->polygon_id;?>"><?php echo $dlist->polygon_name;?></option>

                                        <?php  }

                                        } ?>
                                       </select>

                                        </fieldset>
                                    </div>
                                    <input type="hidden" id="route_id" name="route_id" value="">
                                   

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
                                            <th>Route Name</th>
                                            <th>Ward Type</th>
                                            <th>Start Point</th>
                                            <th>End Point</th>
                                            <th>Stops</th>
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
                                                <td><?php if($list->route_type=='1'){ echo "INWARD";}if($list->route_type=='2'){echo "OUTWARD";} ?></td>
                                                <?php 
                                                    $start_loc = $this->db->query("SELECT polygon_name FROM polygon_list WHERE polygon_id = '".$list->route_geo_start_id."'");
                                                    $start_data = $start_loc->row();
                                                ?>
                                                <td><?php echo $start_data->polygon_name;?></td>  

                                                <?php 
                                                    $start_loc = $this->db->query("SELECT polygon_name FROM polygon_list WHERE polygon_id = '".$list->route_geo_end_id."'");
                                                    $start_data = $start_loc->row();
                                                ?>
                                                <td><?php echo $start_data->polygon_name;?></td>     

                                                <td><a href="<?php echo site_url('/route/polygonstop/').$list->route_id; ?>" class="badge bg-blue">Stops</a></td> 
                                            <td>

                                                <a  href="javascript:edit(<?php echo $list->route_id; ?>)" class="editrouteassign"  id="<?php echo $list->route_id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp; <a href="javascript:deletedata(<?php echo $list->route_id; ?>)" id="<?php echo $list->route_id;?>" class="deleterouteassign"><i class="fa fa-trash " aria-hidden="true"></i></a>
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
             

    $("#polyroutes").submit(function(e) {
          
              var route_id = $('#route_id').val();
              e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = '<?php echo site_url('route/add_polygonroutes');?>';

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

    function deletedata(id)
     {
        
        var thisid = id;
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route/deletepolygonroute/');?>",
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


function edit(id) {
          

          var thisid = id;

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('route/edit_polygonroute/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.addrouteassign').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
              //console.log(response); 
            //  alert(response);
    
                $("#route_type").val(obj.route_type);
                $('#route_geo_start_id').val(obj.route_geo_start_id); 
                $('#route_geo_end_id').val(obj.route_geo_end_id); 

                $('#route_name').val(obj.route_name); 
                $("#route_id").val(obj.route_id);
             

       
               
            },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });

          }  
   
    </script>