<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Timezone</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a> </li>
                                <li class="breadcrumb-item active">Timezone</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  Timezone </button>
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
                                    <h4 class="card-title">Add Timezone </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="sectionform" method="post" novalidate enctype="multipart/form-data">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label for="timezone_name">Timezone Name<span class="error">*</span></label>
                                            <input type="text" class="form-control" id="timezone_name" name="timezone_name"  required>
                                            <span id="error-dno" class="error-msg"></span>
                                       </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <label for="timezone_mins">Timezone Mins<span class="error">*</span></label>
                                        <input type="timezone_mins" class="form-control " id="timezone_mins" name="timezone_mins" required>
                                    </div>
        
                                    <input type="hidden" name="timezone_id" id="timezone_id" value="">

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

        <div class="content-body">
          <section id="configuration">
            <div class="row" >
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                             
                                <div class="table-responsive">

                                <table id="studentlist" class="table table-striped table-bordered">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Timezone Name</th>
                                            <th>Timezone Mins</th>   
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php
                                            foreach ($timezone_data as $list){
                                            ?>
                                            <tr>
                                            
                                            <td><?php echo $list->timezone_id?></td>
                                            <td><?php echo $list->timezone_name?></td>
                                            <td><?php echo $list->timezone_mins?></td>
                                            <td>
                                                <a href="javascript:editdata(<?php echo $list->timezone_id;?>);" id="<?php echo $list->timezone_id;?>" class="editrouteassign"  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                 &nbsp;&nbsp; <a href="javascript:deletedata(<?php echo $list->timezone_id;?>);" id="<?php echo $list->timezone_id;?>" class="deleterouteassign"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                            </td>

                                            
                                        </tr>
                                        <?php } ?>
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
                                    </div>
                                </div>
                            </div>
                        </div>
</body>
<script>

     $("#showuser").click(function(){
        $('#sectionform')[0].reset();

     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();  // hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });


     function editdata(thisid) {
    
    $.ajax({
        type:"POST",
        datatype:"json",
        url:"<?php echo site_url('Timezone/edittimezone/');?>",
        data: {
            thisid: thisid
        },
        success: function (response) {
            // console.log(response);
         $('.adduser').show(1000);
         $('#configuration').hide();
          var obj = JSON.parse(response);
            $("#timezone_id").val(obj.timezone_id);
            $("#timezone_name").val(obj.timezone_name);
            $("#timezone_mins").val(obj.timezone_mins);           

      },
        error: function(){
        console.log('Error While Request User Edit List..');
        }

  });
}

$(document).ready(function () {
             
             $("#sectionform").submit(function(e) { 
                     
                         var timezone_id= $('#timezone_id').val();   
                         //alert('hi'+timezone_id);
                         e.preventDefault(); 
                         var form = $(this);
                       
                         
                             var url = '<?php echo site_url('Timezone/timezone_save');?>';
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
                                //   divlightbox();
                                       //alert(data);
                                         $('.adduser').hide();  //Add userpage hide
                                         $('#configuration').show();
                                          location.reload(true);
                                  }
                                });      
            });
           });
           
function deletedata(thisid) {
  
  if(confirm("Are you sure you want to delete this?")){

$.ajax({
    type:"POST",
    datatype:"json",
    url:"<?php echo site_url('timezone/deletetimezone/');?>",
    data: {
        thisid: thisid
    },
    success: function (response) {
        //alert(response);
        toastr.warning("Data Deleted Successfully","Progress Bar",{progressBar:!0});
        // divlightbox();
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