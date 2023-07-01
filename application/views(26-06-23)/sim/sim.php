<!-- BEGIN: Body-->
<?php error_reporting(0);  

	$role =$this->session->userdata['roleid'];
	$clientid=$this->session->userdata['clientid'];
	// print_r($simlist);exit;
?>
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">SIM</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> SIM</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group <?php if($role=='4'){echo "hidden";}?>" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  Sim </button>
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
                                    <h4 class="card-title">Add SIM </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="simform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">SIM Details</h4>
                                              </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="networkprovider" class="required requirednet">Network Provider<span class="error">&nbsp;*</span></label>
                                            <select class="form-control" id="networkprovider" name="networkprovider">
                                                 <option value="" selected disabled>Select Network</option>
                                                <option value="Airtel">Airtel</option>
                                                <option value="Vodafone">Vodafone</option>
                                                <option value="BSNL">BSNL</option>
                                                <option value="AIS140">AIS140</option>
                                                <option value="Dummy">Dummy</option>
                                            </select>
                                       
                                     
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="imeinumber" class="required requiredimei">Sim Number<span class="error">&nbsp;*</span></label>
                             			<input type="number" class="form-control allow-numeric" name="imeinumber"pattern=^[a-zA-Z0-9]*$ minlength="6" maxlength="20" id="imeinumber" placeholder="Enter the IMEI Number">
                                        <div class="div2" id="div2"></div>
                                        <span class="error_msg text-danger"></span>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="simnumber" class="required requiredsim">Mobile Number<span class="error">&nbsp;*</span><span id='exist' class="error"> </span></label>
                                        <input type="number" class="form-control" id="simnumber" name="simnumber" pattern=[0-9]{10,20} placeholder="Enter the SIM Number "><div class="div3" id="div3"></div>
                                        <span class="sim_error text-danger"></span>
                                    </fieldset>
                                </div>

                               <!--  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="validfrom" class="required requiredfrom">Valid From </label>
                                            <input type="date" class="form-control" id="validfrom" name="validfrom" placeholder="Enter the Valid From Number"><div class="div4" id="div4"></div>
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="validto" class="required requiredto">Valid To </label>
                                            <input type="date" class="form-control" id="validto" name="validto" placeholder="Enter the Valid To "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>  -->
                                     <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Status</label>
                                            <select class="form-control" id="status" name="status">
                                               
                                                <option value="1">Active</option>
                                                <option value="2">Deactive</option>
                                            </select>
                                        </fieldset>
                                    </div>            

                                    <input type="hidden" name="simid" id="simid" value="">

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

                                <table  id="simlist" class="table table-striped table-bordered">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>                                          
                                            <th>Network Provider</th>
                                            <th>IMEI Number</th>
                                            <th>SIM Number</th>                                           
                                           <!--  <th>Valid From </th>
                                            <th>Valid To</th> -->
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
divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {
    
        $.fn.dataTableExt.sErrMode = 'throw';
        var table = $('#simlist').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/Sim/get_simlist",
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'S No' } ,
                                    { mData: 'networkprovider' },
                                    { mData: 'imeinumber' },
                                    { mData: 'simnumber' } ,
                                    { mData: 'Action' },
                            ]
                    });   
            

    }); 
}

        $(document).ready(function () {

        //  $('.adduser').hide(); 

   	});
    $('#imeinumber').keyup(function(){
          var imei = $('#imeinumber').val();
          $.ajax({
              type:"post",
              url:"<?php echo site_url(); ?>Sim/imei_validate",
              data:{
                  imei:imei
              },
              success:function(response){
                  var data = JSON.parse(response);
                  if(imei == data.imeinumber){
                      $('.error_msg').empty();
                      $('.error_msg').text("IMEI number already exist");
                      $('#imeinumber').attr('style','border-color:red;color:red;'); 
                      $('#submit').prop('disabled',true);

                  }
                  else{
                    $('#submit').prop('disabled',false);
                    $('#imeinumber').attr('style','border-color:;color:;');
                    $('.error_msg').html("");
                  }
                console.log(data);
              },
              error:function(){
                  alert("error");
              }
          });
    });
    $('#simnumber').keyup(function(){
          var sim = $('#simnumber').val();
          $.ajax({
              type:"post",
              url:"<?php echo site_url(); ?>Sim/sim_validate",
              data:{
                sim:sim
              },
              success:function(response){
                  var data = JSON.parse(response);
                  if(sim == data.simnumber){
                      $('.sim_error').empty();
                      $('.sim_error').text("sim number already exist");
                      $('#simnumber').attr('style','border-color:red;color:red;'); 
                      $('#submit').prop('disabled',true);
                    
                  }
                  else{
                    $('#submit').prop('disabled',false);
                    $('#simnumber').attr('style','border-color:;color:;');
                    $('.sim_error').html("");
                  }
                console.log(data);
              },
              error:function(){
                  alert("error");
              }
          });
    });
    </script>


    <script type="text/javascript">
           $(document).ready(function () {
             
  $("#simform").submit(function(e) {
          
              var simid= $('#simid').val();   
              e.preventDefault(); 
              var form = $(this);
            
              
                  var url = '<?php echo site_url('sim/savesim');?>';
                  $.ajax({
                       type: "POST",
                       url: url,
                       data: form.serialize(), // serializes the form's elements.
                       success: function(data)
                       {
                           console.log(data);
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
            url:"<?php echo site_url('sim/editsim/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
                $("#networkprovider").val(obj.networkprovider);
                $("#imeinumber").val(obj.imeinumber);
                $('#simnumber').val(obj.simnumber);
                $("#validfrom").val(obj.validfrom);
                $("#validto").val(obj.validto);  
                 $("#status").val(obj.status);            
                $("#simid").val(obj.simid);             
 
          },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

      });
    }

function deletedata(thisid) {
  
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('sim/deletesim/');?>",
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

     $("#showuser").click(function(){
        $('#simform')[0].reset();
        $('#simid').val("");

     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });
        

    </script>