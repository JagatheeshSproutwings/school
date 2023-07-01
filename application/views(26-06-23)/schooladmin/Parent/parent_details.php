<!-- BEGIN: Body-->
<?php error_reporting(0);  

	$role =$this->session->userdata['roleid'];
	$clientid=$this->session->userdata['clientid'];
	// print_r($classlist);exit;
?>
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Parent</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/schooladmin">Home</a></li>
                                <li class="breadcrumb-item active"> Parent Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  Parent </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adduser" style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Parent </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="parentform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Parent Details</h4>
                                              </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="fathername" class="required requiredimei">Father Name<span class="error">&nbsp;*</span></label>
                             		<input type="text" class="form-control" name="firstname"  id="firstname" placeholder="Enter the Father Name">
                                        <div class="div2" id="div2"></div>
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="mothername" class="required requiredimei">Mother Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="lastname"  id="lastname" placeholder="Enter the Mother Name">
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="email" class="required requiredimei">Email Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="email"  id="email" placeholder="Enter the Email Id">
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="mobilenumber" class="required requiredimei">Primary Mobile  Number<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="mobilenumber"  id="mobilenumber" placeholder="Enter Primary No">
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="alter_mobile" >Secondary Mobile Number<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="alter_mobile"  id="alter_mobile" placeholder="Enter Secondary No">
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address" class="required">Address<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="postaladdres"  id="postaladdres" placeholder="Enter Address">
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="username" class="required">User Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="username"  id="username" placeholder="Enter User Password">
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="password" class="required requiredimei">User Password<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="password"  id="password" placeholder="Enter User Name">
                                        <span class="error_msg text-danger"></span>
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

                                    <input type="hidden" name="userid" id="userid" value=""> <!-- userId as parentID  -->
                                    <input type="hidden" name="client_id" id="client_id" value="">

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

                                <table id="classlist" class="table table-striped table-bordered">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>LoginID</th>
                                            <th>Father Name</th>
                                            <th>Mother Name</th>
                                            <th>Mobile Number</th>
                                            <th>Secondary Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {   
        var table = $('#classlist').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/parents/get_parentlist",
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'S No' } ,
                                    { mData: 'loginID' },
                                    { mData: 'fathername' },
                                    { mData: 'mothername' },
                                    { mData: 'mobilenumber' },
                                    { mData: 'alter_mobile' },
                                    { mData: 'Action' },
                            ]
                    });   
            

    }); 
}
    </script>


    <script type="text/javascript">
           $(document).ready(function () {
             
  $("#parentform").submit(function(e) { 
          
              var parent_id= $('#userid').val();   
              e.preventDefault(); 
              var form = $(this);
            
              
                  var url = '<?php echo site_url('parents/saveparent');?>';
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
                       divlightbox();
                            //alert(data);
                              $('.adduser').hide();  //Add userpage hide
                              $('#configuration').show();
                            //    location.reload(true);
                       }
                     });      
 });
});


  function editdata(thisid) {
    
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('parents/editparent/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                console.log(response);
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
                $("#username").val(obj.username);
                $("#firstname").val(obj.firstname); // Father name
                $("#lastname").val(obj.lastname); // Mother name
                $('#email').val(obj.email);
                $("#mobilenumber").val(obj.mobilenumber);            
                $("#alter_mobile").val(obj.alter_mobile);            
                $("#postaladdres").val(obj.postaladdres);            
                $("#username").val(obj.username);            
                $("#userid").val(obj.userid);            
                $("#client_id").val(obj.client_id);            
                $("#status").val(obj.status);            
 
          },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

      });
    }
//
function deletedata(thisid) {
  
//alert(thisid);
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('Parents/delete_parent/');?>"+thisid,
            data: {
                thisid: thisid
            },
            success: function (response) {
              //  alert(response);
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

     $("#showuser").click(function(){
        $('#parentform')[0].reset();
        $('#class_id').val("");

     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });
        

    </script>