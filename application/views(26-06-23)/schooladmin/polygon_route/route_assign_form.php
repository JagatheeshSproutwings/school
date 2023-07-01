
<?php $role = ($this->session->userdata['role']); ?>

<style>
.col-lg-6
{
  margin: 10px !important;
}
.w3-agile-google_map
{
  line-height: 55px;
}
.ui-timepicker-list li {
    padding: 3px 0 3px 5px !important;
    cursor: pointer !important;
    white-space: nowrap !important;
    color: #000 !important;
    list-style: none !important;
    margin: 0 !important;
}
li.ui-timepicker-selected, .ui-timepicker-list li:hover, .ui-timepicker-list .ui-timepicker-selected:hover {
    background: #1980EC !important;
    color: #fff !important;
}
.ui-timepicker-list {
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
}
.ui-timepicker-wrapper {
    overflow-y: auto !important;
    max-height: 150px !important;
    width: 6.5em !important;
    background: #fff !important;
    border: 1px solid #ddd !important;
    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2) !important;
    -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2) !important;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2) !important;
    outline: none !important;
    z-index: 10052 !important;
    margin: 0 !important;
}
</style>
<head>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" >
<!--logo start-->
</header>
<!--header end-->
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    
    <section class="wrapper">
        <div class="w3-agile-google_map">
        <div class="col-lg-1 col-md-12 col-sm-12" style='padding-top: 10px;'>
        </div>
        <div class="col-lg-10 col-md-12 col-sm-12" style='padding-top: 10px;'>
          <header class="panel-heading">
               <?php echo $form_title;?> Route &nbsp;<i class="fa fa-plus"></i>
            </header>
            <div class="notify-w3ls  stats-info stats-last widget-shadow" style=" border: none;"> 
                <div class="box-body col-lg-12 col-md-12 col-sm-12">      

              <!-- form start -->
            <form name="Routeform" id="assignedroute" role='form' action="<?php echo site_url('/route/save_routeassign/');if (! empty ( $route_assigndetails->id )) {echo $route_assigndetails->id;}?>" method="post" >
              <input type="hidden" id="editroute_id" value="<?php if (! empty ( $route_assigndetails->id )) {echo $route_assigndetails->id;}?>">
            <div class="box-body">


               <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="vehicle_id">Vehicle :<span class="error">*</span></label>
                  <select id="vehicle_id" name="vehicle_id" class="form-control" required>
              <option value="">Select</option>
              <?php  
          
          if(isset($vehicle_details)){    
            echo $vehicle_details;
          foreach($vehicle_details as $vlist){  
          ?>   <option value="<?=$vlist->vehicle_id;?>" <?php if(!empty($route_assigndetails->vehicle_id)) { echo($route_assigndetails->vehicle_id == $vlist->vehicle_id) ? 'selected' : ''; }?>><?=$vlist->vehicle_register_number;?></option>
           
              <?php }}?>
            </select>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="route_id">Route :<span class="error">*</span></label>
                <select id="route_id" name="route_id" class="form-control col-md-6" required>
                            <option value="">--Select--</option>
                            <?php  
                        
                            if(isset($route_details)){                         
                            foreach($route_details as $list){  
                            ?>  <option value="<?=$list->route_id;?>" <?php if(!empty($route_assigndetails->route_id)) { echo($route_assigndetails->route_id == $list->route_id) ? 'selected' : ''; }?>><?=$list->route_name;?></option>
                                <?php }}?>
                                
                              </select>
                
              </div>


               <div class="form-group col-lg-3 col-md-6 col-sm-12">
                 <label for="fuelCapacity">Travel Start Date <span class="error">*</span>  </label>
         
              <div class='input-group date'>
                 
                <input type="text" class="form-control pull-left datepicker" name="travel_startdate" id="travel_startdate" autocomplete="off" value="<?php if(!empty($route_assigndetails->travel_startdate)){ echo date("m/d/Y",strtotime($route_assigndetails->travel_startdate));}?>">
              </div>
                  
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                 <label for="fuelCapacity">Travel End Date <span class="error">*</span>  </label>
         
              <div class='input-group date'>
                 
                <input type="text" class="form-control pull-left datepicker" name="travel_enddate" id="travel_enddate" autocomplete="off" value="<?php if(!empty($route_assigndetails->travel_enddate)){ echo date("m/d/Y",strtotime($route_assigndetails->travel_enddate));}?>">
              </div>
                  
              </div>

               <div class="form-group col-lg-3 col-md-6 col-sm-12">
                 <label for="fuelCapacity"> </label>
         
               <button type="submit"  class="btn btn-info submit" style="display: block !important;"><?php if (!empty($form_title)){echo $form_title;}?></button>
             
                  
              </div>

          </div>
             
        </div>

      </form>
      <!-- FORM END -->
            </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-1 col-md-12 col-sm-12" style='padding-top: 10px;'>
    </div>
  </section>
 <!-- footer -->
    <div class="footer clearfix">
        <div class="wthree-copyright">
      <?php $this->load->view('components/tfooter'); ?>
        </div>
    </div>
  <!-- / footer -->
</section>

<!-- main content end -->
</section>
</body>


     <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.css">
  <script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.js"></script>
    
<script src="<?php echo base_url();?>assets/plugins/validator/js/jquery.validate.js"></script> 
<script src="<?php echo base_url();?>assets/plugins/validator/js/additional-methods.js"></script> 

    <script type="text/javascript">
      $( function() {
       $( "#travel_startdate" ).datepicker({  minDate: new Date() });
      $( "#travel_enddate" ).datepicker({  minDate: new Date() });
    } );

       $("#travel_date").change(function (){

          var travel_date = $(this).val();
          var route_id = $('#route_id').val();
          var vehicle_id = $('#vehicle_id').val();
          var editroute_id = $('#editroute_id').val();
          $.ajax({ 
              type: 'POST',
              datatype: "json",
              url: '<?php echo site_url('/route/existing_routeassign/');?>',
              data: {'route_id':route_id,'travel_startdate' : travel_startdate, 'vehicle_id':vehicle_id,'editroute_id':editroute_id },
              success: function(data)
              {

                var obj = JSON.parse(data);
               // alert(obj.length);
               
                  if(obj.length>0)
                  {
                   alert("Vehicle and route Already assigned on choosen date");
                  }

                  else
                  {
                    
                  }
             
              },
            error: function(){
            console.log('Error While Request Location List..');
            }
          });

    });

    //     $('#assignedroute').validate({ 
    //     submitHandler: function(form) {

    //       var travel_date = $('#travel_date').val();
    //       var route_id = $('#route_id').val();
    //       var vehicle_id = $('#vehicle_id').val();
    //       var editroute_id = $('#editroute_id').val();
    //       var passedValidation = false;
    //       $.ajax({ 
    //           type: 'POST',
    //           datatype: "json",
    //           url: '<?php echo site_url('/route/existing_routeassign/');?>',
    //           data: {'route_id':route_id,'travel_date' : travel_date, 'vehicle_id':vehicle_id,'editroute_id':editroute_id },
    //           success: function(data)
    //           {

    //             var obj = JSON.parse(data);
    //            // alert(obj.length);
               
    //               if(obj.length>0)
    //               {
    //                alert("Vehicle and route Already assigned on choosen date");
    //                return false;
    //               }

    //               else
    //               {
    //                 passedValidation = true;
    //               }
             
    //           },
    //         error: function(){
    //         console.log('Error While Request Location List..');
    //         return false;
    //         }
    //       });

    //       return passedValidation;
    //   }
    // });
  </script>