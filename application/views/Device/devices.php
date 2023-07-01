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
                    <h3 class="content-header-title mb-0">Devices</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Home</a> </li>
                                <li class="breadcrumb-item active">Devices</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group <?php if($role=='4'){echo "hidden";}?>" role="group">
                            <button class="btn btn-outline-primary" id="showdevice" type="button"> <i class="feather icon-user-plus icon-left"></i> Add Device </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adddevice" style="display:none;">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Device</h4> <a class="heading-elements-toggle "><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close" class='closedevice'><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="deviceform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Device Details</h4>
                                  </div>

                                   <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="devicetype">Device Model</label>
                                   
                                           <select class="form-control" id="device_model" name="device_model">
                                               <option>Select Devicemodel</option>
                                               <?php if ($devicemodels) {

                                                foreach ($devicemodels as $dlist) { ?>
                                                   
                                                     <option value="<?php echo $dlist->device_name;?>"><?php echo $dlist->device_name;?></option>

                                            <?php  }
                                                   

                                               } ?>
                                              
                                          </select>

                                        </fieldset>
                                    </div>


                                     <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Device Catagory</label>
                                            <select class="form-control" id="device_categary" name="device_categary">
                                                
                                                <option value="1">Normal GPS</option>
                                                <option value="2">Fuel</option>
                                                <option value="3">IButton</option>
                                                <option value="4">AS140</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="dnumber">Device IMEI</label>
                                            <input type="text" class="form-control" id="deviceimei" name="deviceimei" pattern=^[a-zA-Z0-9]*$ minlength="6" maxlength="20" placeholder="Enter Device IMEI">
                                            <span class="error_msg text-danger"></span>
                                        </fieldset>
                                    </div>
                                    
                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1 sensor_name">
                                        <fieldset class="form-group">
                                            <label for="dnumber">Sensor Name</label>
                                            <input type="text" class="form-control" id="sensor_name" name="sensor_name" placeholder="Enter Sensor Name">
                                        </fieldset>
                                    </div> <!-- <div class="row" id="as140"> -->
                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1" id="ccid" style="display:none">
                                        <fieldset class="form-group">
                                            <label for="ccid">CCID</label>
                                            <input type="text" class="form-control ccid" name="ccid" pattern=^[a-zA-Z0-9]*$ minlength="6" maxlength="20" placeholder="Enter CCID ">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1" id="start_date" style="display:none">
                                        <fieldset class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control start_date"  name="start_date" placeholder="Enter Start Date">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1" id="end_date" style="display:none">
                                        <fieldset class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" class="form-control end_date"  name="end_date" placeholder="Enter End Date">
                                        </fieldset>
                                    </div>
                                     <!-- </div> -->
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Working</option>
                                                <option value="0">Not Working</option>
                                               
                                            </select>
                                        </fieldset>
                                    </div>
                                   
                                    <input type="hidden" id="device_id" name="device_id" value="">
                                   

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                         <button type="submit" id="submit_btn" class="btn btn-primary btn-min-width mr-1 block-page"></i> Create</button>
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
                                    <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="device_data">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Device Model</th>
                                            <th>Device IMEI</th>
                                            <th>Device Category</th>
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                   
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
    // Server side datatable 
    divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {
    
        $.fn.dataTableExt.sErrMode = 'throw';
        var table = $('#device_data').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/Device/get_devicelist",
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'S No' } ,
                                    { mData: 'device_name' },
                                    { mData: 'deviceimei' },
                                    { mData: 'device_categary' } ,
                                    { mData: 'Action' },
                        
                            ]
                    });   
            

    }); 
}
        // imei number validation start
 $('#deviceimei').keyup(function(){
          var imei = $('#deviceimei').val();
          $.ajax({
              type:"post",
              url:"<?php echo site_url(); ?>Device/imei_validate",
              data:{
                  imei:imei
              },
              success:function(response){
                  var data = JSON.parse(response);
                  console.log(data);
                  if(imei == data.deviceimei){
                      $('.error_msg').empty();
                      $('.error_msg').text("IMEI number already exist");
                      $('#deviceimei').attr('style','border-color:red;color:red;'); 
                      $('#submit_btn').prop('disabled',true);

                  }
                  else{
                    $('#submit_btn').prop('disabled',false);
                    $('#deviceimei').attr('style','border-color:;color:;');
                    $('.error_msg').html("");
                  }
              },
              error:function(){
                  console.log('error');
              }
          });
    });
    // validation end

          $(document).ready(function () {

        //    $('.adddevice').hide(); 
           $('#ccid').hide();
           $('#start_date').hide();
           $('#end_date').hide();

             var categary = $('#device_categary').val();
            if (categary=='2') {

               // alert('hi');
                
                  $('.sensor_name').show(); 

               }
               else
               {
                 $('.sensor_name').hide(); 

               }
                

           $('#device_categary').change(function(){

                var categary = $('#device_categary').val();

               if (categary=='2') {

               // alert('hi');
                
                  $('.sensor_name').show(); 

               }
                else
               {
                 $('.sensor_name').hide(); 

               }


           });
             $('#device_categary').change(function(){

                var categary = $('#device_categary').val();

               if (categary=='4') {

               // alert('hi');
                
               $('#ccid').show();
               $('#start_date').show();
               $('#end_date').show();
               }
                else
               {
                $('#ccid').hide();
                $('#start_date').hide();
                $('#end_date').hide();
               }


           });
            });
             

    $("#deviceform").submit(function(e) {
          
              var device_id = $('#device_id').val();
              e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
   

    var url = '<?php echo site_url('Device/savedevice');?>';
// console.log(form.serialize());
      $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            $.unblockUI();

            if(data==2) 
             {
             toastr.success("Data Updated Successfully!","UPDATE",{progressBar:!0});
             }
            else
            {
             toastr.success("Data Insert Successfully!","INSERT",{progressBar:!0});
             }
               console.log(data);
                 $('.adddevice').hide();  //Add userpage hide
                  $('#configuration').show();
                //    location.reload(true);
                divlightbox();

           }
         }); 
          

    
 });

function deletedata(thisid) {
  

          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('Device/deletedevice/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                toastr.warning("Data Deleted Successfully","Progress Bar",{progressBar:!0});
                divlightbox();
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


     $("#showdevice").click(function(){
        $('#deviceform')[0].reset();
        $('#device_id').val("");
     $('.adddevice').show(1000);  //Add userpage hide
       $('#configuration').hide();// hide view page
        $('#showdevice').hide();// hide view page

     });



     $(".closedevice").click(function(){

     $('.adddevice').hide(1000);  //Add userpage hide
       $('#configuration').show();// hide view page
        $('#showdevice').show();
     });

       $("#closeform").click(function(){

      location.reload(); 
     });

   
    
         function editdata(thisid)
    {
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('Device/editdevicedata/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.adddevice').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
              //console.log(response); 
             // alert(response);
              console.log(obj);
                $("#deviceimei").val(obj.deviceimei);
                $("#device_model").val(obj.device_model);
                $("#device_categary").val(obj.device_categary);
                $("#sensor_name").val(obj.sensor_name);
                $("#status").val(obj.status);
                 $('#device_id').val(obj.device_id);
                 $('.ccid').val(obj.ccid);
                 $('.start_date').val(obj.start_date);
                 $('.end_date').val(obj.end_date);

         // var categary = $('#device_categary').val();

            if (obj.device_categary=='2') {
               // alert('hi');
                  $('.sensor_name').show(); 

               }
               else if(obj.device_categary=='4'){
                   $('#ccid').show();
                   $('#start_date').show();
                   $('#end_date').show();
               }
               else
               {
                 $('.sensor_name').hide(); 
                 $('#ccid').hide();
                 $('#start_date').hide();
                 $('#end_date').hide();

               }
                
               
            },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
   }
    </script>