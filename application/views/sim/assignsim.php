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
                    <h3 class="content-header-title mb-0">Dealer SIM</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active">Dealer SIM</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Assign  Sim </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adduser" style="display:none;">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">SIM ASSIGN TO DEALER </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>                               
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="dealerassignsimform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                <?php if ($role=='1' || $role=='2') { ?>
                                  
                             
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="networkprovider" class="required requirednet">Dealer Name<span class="error">&nbsp;*</span></label>
                                            <select class="form-control" id="dealer_id" name="dealer_id">
                                                <option value="" selected hidden>Select Dealer Name</option>
                                                <?php
                                                if($dealerlist) {
                                                 
                                                    foreach ($dealerlist as $dlist) { ?>
                                                        <option value="<?php echo $dlist->dealer_id;?>"><?php echo $dlist->dealer_company.' - '.$dlist->dealer_name;?></option>
                                                      
                                                 <?php   }
                                                }
                                                ?>
                                            </select>
                                       
                                     
                                    </fieldset>
                                </div>
                            <?php    } ?>
                               <?php if ($role=='3') { ?>
                                  
                             
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="networkprovider" class="required requirednet">Dealer Name<span class="error">&nbsp;*</span></label>
                                            <select class="form-control" id="dealer_id" name="dealer_id">
                                                <option value="" selected hidden>Select Dealer Name</option>
                                                <?php
                                                if($dealerlist) {
                                                 
                                                    foreach ($dealerlist as $dlist) { ?>
                                                        <option value="<?php echo $dlist->subdealer_id;?>"><?php echo $dlist->subdealer_company.' - '.$dlist->subdealer_name;?></option>
                                                      
                                                 <?php   }
                                                }
                                                ?>
                                            </select>
                                       
                                     
                                    </fieldset>
                                </div>
                            <?php    } ?>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="networkprovider" class="required requirednet">SIM Number<span class="error">&nbsp;*</span></label>
                                            <select class="form-control" id="simid" name="simid">
                                                <option value="" selected hidden>Select SIM Number</option>
                                                <?php
                                                if ($simlist) {
                                                  
                                                    foreach ($simlist as $slist) { ?>
                                                        <option value="<?php echo $slist->simid;?>"><?php echo $slist->imeinumber.' - '.$slist->simnumber;?></option>

                                                     
                                                    <?php }
                                                }
                                                ?>
                                            </select>
                                       
                                     
                                    </fieldset>
                                </div>
                                    <input type="hidden" name="simassignid" id="simassignid" value="">
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                       <input type="submit" class="btn btn-primary btn-min-width mr-1 btn-next btn-next1" value="Submit" id='submit'>
                                      <button type="button" class="btn btn-primary btn-min-width" id="closeform">Reset</button>
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

                                <table  id="simdata" class="table table-striped table-bordered">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>                                          
                                            <th>Dealer Name</th>
                                            <th>Network Provider</th>
                                            <th>IMEI Number</th>
                                            <th>SIM Number</th>                                           
                                            <th>Valid From </th>
                                            <th>Valid To</th>
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

    <script type="text/javascript">

divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {
    
        
        var table = $('#simdata').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/Sim/get_simdata",
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'S No' } ,
                                    { mData: 'dealer_name' },
                                    { mData: 'networkprovider' },
                                    { mData: 'imeinumber' } ,
                                    { mData: 'simnumber' },
                                    { mData: 'validfrom' } ,
                                    { mData: 'validto' },
                                    { mData: 'Action' },
                            ]
                    });   
            

    }); 
}

function deletedata(thisid){
        // alert(thisid);
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('sim/deleteassignsim/');?>",
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

           $(document).ready(function () {
             
  $("#dealerassignsimform").submit(function(e) {
          
              var simassignid= $('#simassignid').val();   
              var dealer_id= $('#dealer_id').val();   
              var simid= $('#simid').val();   
              e.preventDefault(); 
              var form = $(this);
              var url = '<?php echo site_url('sim/save_assignsim');?>';
                  $.ajax({
                       method: "POST",
                       url: url,
                       data: {
                        'dealer_id': dealer_id,
                        'simid': simid,
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
                           toastr.success("Data Insert Successfully!","INSERT",{progressBar:!0});
                           }
                           // alert(data);
                              $('.adduser').hide();  //Add userpage hide
                              $('#configuration').show();
                              divlightbox();

                       }
                     }); 
     
                          
 });



 $(document).ready(function(){   
    $('.edit').click(function(){
       var thisid = $(this).attr('id');
       //alert(thisid);
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('sim/editassignsim/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
               
                 $("#status").val(obj.status);    

                $('#simid').append("<option value='"+ obj.simid +"'>" +obj.imeinumber+' - '+obj.simnumber+"</option>");     
                 $("#simid").val(obj.simid);     
                   $("#dealer_id").val(obj.dealer_id);          
 
          },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
    });

});




     $("#showuser").click(function(){

     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });
        
         });



    </script>