<!-- BEGIN: Body-->
<?php error_reporting(0);  
	$role =$this->session->userdata['roleid'];
	$clientid=$this->session->userdata['client_id'];

?>
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Schools</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active">School</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showclient" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  School </button>
                        </div>
                    </div>
                </div>
                <span id="waitmsg"></span>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 addclient"  style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">ADD School </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close" onclick="location.reload();"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                <form class="form-horizontal form-simple" id="clientform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">School Details</h4>
                                              </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="company_name" class="required">School Name <span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter the Company Name" required><div class="div1" id="div1"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="client_name" class="required">Client Name <span class="error">&nbsp;*</span></label>
                             			<input type="text" class="form-control allow-numeric" name="client_name" id="client_name" placeholder="Enter the Client Name" required>
                                        <div class="div2" id="div2"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="email" class="required">Email <span class="error">&nbsp;*</span><span id='exist' class="error"> </span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter the Email" required ><div class="div3" id="div3"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="mobile" class="required">Contact Number <span class="error">&nbsp;*</span>
                                            </label>
                                        <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter the Contact Number"><div class="div4" id="div4"></div>
                                    </fieldset>
                                </div>

                                   <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="alter_mobile" class="required">Alter Mobile Number <span class="error">&nbsp;*</span>
                                            </label>
                                        <input type="number" class="form-control" id="alter_mobile" name="alter_mobile" placeholder="Enter the Alter Number"><div class="div4" id="div4"></div>
                                    </fieldset>
                                </div>

                               
                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="client_limit" class="required">Licence<span class="error">&nbsp;*</span>
                                            </label>
                                        <input type="number" class="form-control" id="client_limit" name="client_limit" placeholder="Enter the Licence"><div class="div4" id="div4"></div>
                                    </fieldset>
                                </div>       

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="pincode">Pincode</label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter the Pincode ">
                                            <div class="div11" id="div11"></div>
                                        </fieldset>
                                    </div>

                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="address">Address</label>
                                          <textarea class="form-control" name="address" id="address" placeholder="Enter Address"></textarea>
                                            <div class="div11" id="div11"></div>
                                        </fieldset>
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

                                            </label>
                                     <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Login Details</h4>
                                                </div>
                                           
<!--                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="logo_path">School Logo</label>
                                            <input type="file" class="form-control" id="logo_path" name="logo_path">
                                        </fieldset>
                                        <input type="text" id="logo_paths" name="logo_paths">
                                        <div id="schoolimage"></div>
                                    </div>-->
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="username">User Name</label> <small class="text-muted danger">eg.<i>someone@example.com</i></small>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" value="123456">
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="password">Time Zone</label>
                                            <select class="select2 form-control" id="timezone_id" name="timezone_id">
                                                <option value="">Select Timezone</option>
                                             <?php if ($timezonelist) {
                                                foreach ($timezonelist as $cname) { ?>
                                                     <option value="<?php echo $cname->timezone_id;?>"><?php echo $cname->timezone_name;?></option>
                                                    <?php   }  }?>
                                              
                                            </select>
                                        </fieldset>
                                    </div>


                                    <input type="hidden" name="client_id" id="client_id">
<br>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                      <input type="submit" class="btn btn-primary btn-min-width mr-1 btn-next btn-next1 block-page" value="Submit" id='submit'>
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
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                        <table id="clientlist" class="table table-striped table-bordered">
                                        <thead class="bg-primary">
                                            <tr>
                                            <th>S.No</th>    
                                             <th>Username</th>                                      
                                            <th>School Name</th>
                                            <th>Client Name</th>
                                            <th>Contact Number</th>
                                            <!-- <th>Alter Mobile Number</th> -->
                                            <th>Email</th>                                           
                                             <th>Action</th> 
                                            <th>Customer License</th>
                                           <th>address</th>
                                            
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


    <script type="text/javascript">
// alert("<?php echo site_url();?>Client/get_clientlist");

divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {
    
        $.fn.dataTableExt.sErrMode = 'throw';
        var table = $('#clientlist').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/Client/get_clientlist",
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'S No' } ,
                                    { mData: 'username' },
                                    { mData: 'company_name' },
                                    { mData: 'client_name' } ,
                                    { mData: 'mobile' },
                                    // { mData: 'alter_mobile' },
                                    { mData: 'email' } ,
                                    { mData: 'Action' },
                                    { mData: 'client_limit' },
                                    { mData: 'address' },
                            ]
                    });   
            

    }); 
}


           $(document).ready(function () {


            //  $('.addclient').hide(); 

                var country = "<?php echo base_url();?>app-assets/JSON/countries.json";
            $('#country').html('<option>Select Country</option>');
            $('#states').html('<option>Select State</option>');
            $('#cities').html('<option>Select City</option>');
            $.getJSON(country, function (data) {
                $.each(data.countries, function (index, value) {
                    $('#country').append('<option value="' + value.id + '">' + value.name + '</option>');
              });

        });



            $(document).on('change', '#country', function(){
            var getcountry_id = $(this).val();
            var states = "<?php echo base_url();?>app-assets/JSON/states.json";
            $('#states').empty();
            $('#states').html('<option>Select State</option>');
            $.getJSON(states, function (data) {
              $.each(data.states, function (index, value) {
                if(getcountry_id == '')
                {
                    $('#cities').html('<option value="">Select city</option>');
                }
                if(value.country_id == getcountry_id)
                {
                    $('#states').append('<option value="' + value.id + '">' + value.name + '</option>')
                    ;
                }
              });
            });
        });

        $(document).on('change', '#states', function(){
            var getstates_id = $(this).val();
          //  alert(getstates_id);
            var cities = "<?php echo base_url();?>app-assets/JSON/cities.json";
            $('#cities').empty();
            $('#cities').html('<option>Select City</option>');
            $.getJSON(cities, function (data) {
              $.each(data.cities, function (index, value) {
                if(getstates_id == '')
                {
                    $('#cities').html('<option value="">Select city</option>');
                }
                if(value.state_id == getstates_id)
                {
                    $('#cities').append('<option value="' + value.id + '">' + value.name + '</option>')
                    ;
                }
              });
            });
        });
           
    
             
       $("#clientform").submit(function(e) {
          
              var client_id= $('#client_id').val();   
            // alert(client_id);
              e.preventDefault(); 
              var form = $(this);
            
                  var url = '<?php echo site_url('client/saveclient');?>';
                  $.ajax({
                       type: "POST",
                       url: url,
                       data: form.serialize(), // serializes the form's elements.
                        beforeSend: function() {

                     //  $("#waitmsg").empty().append('<span id="waitmsg">Please Wait....</span>');
                        },
                       success: function(data)
                       {
                       
                        $.unblockUI();

                       if(data==1)
                       {
                        toastr.success("Data Updated Successfully!","UPDATE",{progressBar:!0});
                       }
                       else
                       {
                        toastr.success("Data Insert Successfully!","INSERT",{progressBar:!0});
                       }
                       
                             $("#waitmsg").empty();
                            
                              $('.addclient').hide();  //Add userpage hide
                              $('#configuration').show();
                              
                              divlightbox();

                       }
                     }); 
   
                          
 });


     $("#showclient").click(function(){
        $('#clientform')[0].reset();
        $('#client_id').val("");

     $('.addclient').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });

          
        
         });

            
    function edit(thisid) {
//      alert(thisid);
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('client/editclient/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                console.log(response);
             $('.addclient').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);

                $("#company_name").val(obj.company_name);
                $("#client_name").val(obj.client_name);
                $('#email').val(obj.email);
                $("#mobile").val(obj.mobile);
                $("#alter_mobile").val(obj.alter_mobile);    
                 $("#address").val(obj.address);
                $("#client_limit").val(obj.client_limit);
//                
                $("#pincode").val(obj.pincode);
                $("#username").val(obj.username);   
                 $("#status").val(obj.status);               
                $("#client_id").val(obj.client_id);    
//                $("#logo_paths").val(obj.logo_path);
                
//                var schoolimage = obj.logo_path;
//                if (obj.logo_path!='') {$("#schoolimage").html("<a href='"+schoolimage+"' target='_blank' style='color:red'>School Image<a>");}
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
            url:"<?php echo site_url('client/deleteclient/');?>",
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




    </script>