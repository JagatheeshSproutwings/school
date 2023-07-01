<!-- BEGIN: Body-->
<?php   
	$role =$this->session->userdata['role'];
	$clientid=$this->session->userdata['clientid'];
    // print_r($role);die;
?>
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0"> DEALER</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> DEALER</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  Dealer </button>
                        </div>
                    </div>
                </div>
                <span id="waitmsg"></span>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adduser" style="display:none;">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">ADD DEALER </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                <form class="form-horizontal form-simple" id="dealerform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">DEALER Details</h4>
                                              </div>


                                <!--   <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Dealer Type</label>
                                            <select class="form-control" id="dealer_type" name="dealer_type">

                                                 <option value="">Select Dealertype</option>
                                                <option value="1">Whitelabel</option>
                                                <option value="0">Non Whitelabel</option>
                                            </select>
                                        </fieldset>
                                    </div> -->



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_company" class="required">Company Name <span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" id="dealer_company" name="dealer_company" placeholder="Enter the Company Name" required><div class="div1" id="div1"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_name" class="required">Dealer Name <span class="error">&nbsp;*</span></label>
                             			<input type="text" class="form-control allow-numeric" name="dealer_name" id="dealer_name" placeholder="Enter the Dealer Name" required>
                                        <div class="div2" id="div2"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_email" class="required">Email <span class="error">&nbsp;*</span><span id='exist' class="error"> </span></label>
                                        <input type="email" class="form-control" id="dealer_email" name="dealer_email" placeholder="Enter the Email" required ><div class="div3" id="div3"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_mobile" class="required">Contact Number <span class="error">&nbsp;*</span>
                                            </label>
                                        <input type="number" class="form-control" id="dealer_mobile" name="dealer_mobile" placeholder="Enter the Contact Number"><div class="div4" id="div4"></div>
                                    </fieldset>
                                </div>

                                 
                               
                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_limit" class="required">Dealer Limit<span class="error">&nbsp;*</span>
                                            </label>
                                        <input type="number" class="form-control" id="dealer_limit" name="dealer_limit" placeholder="Enter the Dealer Limit"><div class="div4" id="div4"></div>
                                    </fieldset>
                                </div>   



                                  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_subdomain" class="required">Dealer Subdomain<span class="error">&nbsp;*</span>
                                            </label>
                                        <input type="text" class="form-control" id="dealer_subdomain" name="dealer_subdomain" placeholder="Enter Subdomain Name"><div class="div4" id="div4"></div>
                                    </fieldset>
                                </div>       

                                

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="pincode">Pincode</label>
                                            <input type="text" class="form-control" id="dealer_pincode" name="dealer_pincode" placeholder="Enter the Pincode ">
                                            <div class="div11" id="div11"></div>
                                        </fieldset>
                                    </div>

                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="dealer_address">Address</label>
                                          <textarea class="form-control" name="dealer_address" id="dealer_address" placeholder="Enter Address"></textarea>
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

                                     <!--  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_color" class="required">Dealer Color<span class="error">&nbsp;*</span>
                                            </label>
                                        <input type="color" class="form-control" id="dealer_color" name="dealer_color" placeholder="Enter Dealer Color"><div class="div4" id="div4"></div>
                                    </fieldset>
                                </div>      -->  


                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="dealer_logo" class="required">Dealer Logo<span class="error">&nbsp;*</span>
                                        <input type="file" class="form-control" id="dealer_logo" name="dealer_logo"><div class="div4" id="div4"></div>
                                        <input type="hidden" class="form-control" id="dealer_logo1" name="dealer_logo1">
                                    </fieldset>
                                </div>

                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <div id="logopath">
                                        

                                    </div>
                                 
                                </div>

                                            </label>
                                     <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Login Details</h4>
                                                </div>

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



                                    <input type="hidden" name="dealer_id" id="dealer_id" value="">

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

                                <table  id="dealerlist" class="table table-striped table-bordered">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>                                          
                                            <th>Company Name</th>
                                            <th>Dealer Name</th>
                                            <th>Email</th>                                           
                                            <th>Contact Number</th>
                                            <th>Dealer Limit</th>
                                              <th>Action</th> 
                                           <th>address</th>
                                            <th>pincode</th>
                                          
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
            divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {
    
        
        var table = $('#dealerlist').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/Dealer/get_dealerlist",
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'S No' } ,
                                    { mData: 'dealer_company' },
                                    { mData: 'dealer_name' },
                                    { mData: 'dealer_email' } ,
                                    { mData: 'dealer_mobile' },
                                    // { mData: 'alter_mobile' },
                                    { mData: 'dealer_limit' } ,
                                    { mData: 'Action' },
                                    { mData: 'dealer_address' },
                                    { mData: 'dealer_pincode' },
                            ]
                    });   
            

    }); 
}
function editdata(thisid) {
        //  alert(thisid);
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('dealer/editdealer/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                //alert(response);
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);

                $("#dealer_company").val(obj.dealer_company);
                $("#dealer_name").val(obj.dealer_name);
                $('#dealer_email').val(obj.dealer_email);
                $("#dealer_mobile").val(obj.dealer_mobile);
                $("#dealer_address").val(obj.dealer_address);    
                 $("#dealer_logo1").val(obj.dealer_logo);
                $("#dealer_limit").val(obj.dealer_limit);
                $('#dealer_subdomain').val(obj.dealer_subdomain);
                 $('#dealer_color').val(obj.dealer_color);
                $("#dealer_city").val(obj.dealer_city);
                $("#dealer_state").val(obj.dealer_state);   
                $('#country').val(obj.dealer_country);
                $("#dealer_pincode").val(obj.dealer_pincode);
                $("#username").val(obj.username);   
                $("#status").val(obj.status);               
                $("#dealer_id").val(obj.dealer_id);   
                // $("#dealer_type").val(obj.dealer_type); 
               // alert(obj.dealer_color);
                var url = '<?php echo base_url();?>';
                var source = url+"uploads/company_logo/"+obj.dealer_logo;
              if (obj.dealer_logo!='') {

                $("#logopath").append("<img src='"+source+"' height='80px' width='100px'>");    

              }
                 

                      $.getJSON(country, function (data) {
                $.each(data.countries, function (index, value) {

                    if (value.id == obj.dealer_country) {
                       // console.log('hi');

                        $('#country').append('<option value="' + value.id + '">' + value.name + '</option>');
                    }
                    
              });
                 });

                 var states = "<?php echo base_url();?>app-assets/JSON/states.json";
            
             $.getJSON(states, function (data) {
              $.each(data.states, function (index, value) {
                if(value.id == obj.dealer_state)
                {
                    //alert(obj.state);
                     $('#states').empty();

                    $('#states').append('<option value="' + value.id + '">' + value.name + '</option>')
                    ;
                }
               
              });
            });

              var cities = "<?php echo base_url();?>app-assets/JSON/cities.json";
            $('#cities').empty();
            $.getJSON(cities, function (data) {
              $.each(data.cities, function (index, value) {
               
                if(value.id == obj.dealer_city)
                {
                    $('#cities').append('<option value="' + value.id + '">' + value.name + '</option>')
                    ;
                }
              });
            });
 
          },
            error: function(){
            console.log('Error While Request Dealer Edit List..');
            }

        });
    } 

           $(document).ready(function () {


            //  $('.adduser').hide(); 

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
           
             


              $( "#dealer_logo" ).change(function() {
            
            var form_data1 = new FormData();
            var files = $('#dealer_logo')[0].files;
          
           
                    var name = document.getElementById("dealer_logo").files[0].name;
                  
                    var ext = name.split('.').pop().toLowerCase();
                    if(jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                        
                        alert('only jpeg,png,jpeg support');
                        return false;
                    }
                    var oFReader1 = new FileReader();
                    oFReader1.readAsDataURL(document.getElementById("dealer_logo").files[0]);
                    var f1 = document.getElementById("dealer_logo").files[0];
                    //console.log(f);
                    var fsize = f1.size || f1.fileSize;
                    if(fsize > 2000000) {
                       alert('File size is big');
                    } else {
                        form_data1.append("file[]", document.getElementById('dealer_logo').files[0]);
                    }
                
           
            $.ajax({
                url: "<?php echo site_url();?>Dealer/dealer_logo",
                method: "POST",
                data: form_data1,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                   // alert("processData");
                },
                success: function(data) {
                  // alert(data);
                     $('#dealer_logo1').val(data);
                   
                }
            }); 

            });


             
       $("#dealerform").submit(function(e) {
          
              var dealer_id= $('#dealer_id').val();   
           //   alert(dealer_id);
              e.preventDefault(); 
              var form = $(this);
            
                  var url = '<?php echo site_url('dealer/savedealer');?>';
                  $.ajax({
                       type: "POST",
                       url: url,
                       data: form.serialize(), // serializes the form's elements.
                        beforeSend: function() {
                       $("#waitmsg").empty().append('<span id="waitmsg">Please Wait....</span>');
                        },
                       success: function(data)
                       {
                        $.unblockUI();

                           if(data==1)
                            {
                                toastr.success("Data Insert Successfully!","INSERT",{progressBar:!0});
                            }
                            else
                            {
                                toastr.success("Data Updated Successfully!","UPDATE",{progressBar:!0});
                             }
                           console.log(data);
                             $("#waitmsg").empty();
                            //alert(data);
                              $('.adduser').hide();  //Add userpage hide
                              $('#configuration').show();
                            //    location.reload(true);
                            divlightbox();
                       }
                     }); 
 
                          
 });

     


     $("#showuser").click(function(){
        //  alert('hii');
        $('#dealerform')[0].reset();
        $('#dealer_id').val("");

        // $('#dealerform').find(':input').empty();
     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });

          
        
         });

         function deletedata(thisid) {
        // var thisid = $(this).attr('id');
       //  alert(thisid);
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('dealer/deletedealer/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                //alert(response);
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