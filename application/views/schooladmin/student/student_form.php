
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
        <div class="col-lg-1 col-md-12 col-sm-12" style='padding-top: 10px;'></div>
        <div class="col-lg-10 col-md-12 col-sm-12" style='padding-top: 10px;'>
          <header class="panel-heading">
               <?php echo $form_title;?> Student &nbsp;<i class="fa fa-plus"></i>
            </header>
            <div class="notify-w3ls  stats-info stats-last widget-shadow" style=" border: none;"> 
                <div class="box-body">          
                         
              <!-- form start -->

            <form class="Studentform" action ='<?php echo site_url('/student/save_student/');if(!empty($student_details->student_id)){ echo $student_details->student_id; } ?>' method='POST' role='form' > 

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for='school_name'>School Name <span class="error">*</span></label>
                <select id='school_name' name="school_name" class="form-control col-md-6" required>
                  <option value="">--Select School--</option>
                  <?php if(!empty($school_list))
                  {
                    foreach ($school_list as $list) {
                  ?>
                  <option value="<?=$list->client_id;?>"<?php if (!empty($student_details->client_id) && $list->client_id == $student_details->client_id){echo "selected";}?>><?php echo $list->client_name;?></option>
                  <?php }}?>
              </select>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="student_name">Student Name<span class="error">*</span></label>
                <input type="text" class="form-control col-md-6 " id="student_name" name="student_name" placeholder="Enter Student Name..." value="<?php if (!empty($student_details->student_name)){echo $student_details->student_name;}?>" required>
                <span id="error-dno" class="error-msg"></span>
              </div>
              
              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="student_rfid_no">Student RFID Number<span class="error">*</span></label>
                <input type="student_rfid_no" class="form-control col-md-6 " id="student_rfid_no" name="student_rfid_no"  placeholder="Enter RFID Number..." value="<?php if (!empty($student_details->student_rfid_no)){echo $student_details->student_rfid_no;}?>" required>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="student_rollno">Student Roll Number<span class="error">*</span></label>
                <input type="student_rollno" class="form-control col-md-6 " id="student_rollno" name="student_rollno"  placeholder="Enter Roll Number..." value="<?php if (!empty($student_details->student_rollno)){echo $student_details->student_rollno;}?>" required>
              </div>
                  
              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                  <label for="student_dob">Student DOB<span class="error">*</span></label>
                  <input type="student_dob" class="form-control col-md-6 " id="student_dob" name="student_dob"  placeholder="Enter Student DOB..." value="<?php if (!empty($student_details->student_dob)){echo $student_details->student_dob;}?>" required>
                  <input type="hidden" class="form-control col-md-6 " id="role" name="role"  value="2" >
              </div>

              

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for='parent_name'>Parent Name <span class="error">*</span></label>
                <select id='parent_name' name="parent_name" class="form-control col-md-6" required>
                <option value="">--Select Parent--</option>
                <?php if(!empty($parent_list))
                {
                  foreach ($parent_list as $list) {

                    
                ?>
                <option value="<?=$list->parent_id;?>"<?php if (!empty($student_details->parent_id) && $list->parent_id == $student_details->parent_id){echo "selected";}?>><?php echo $list->parent_name;?></option>
                <?php }}?>
              </select>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for='class_name'>Class Name <span class="error">*</span></label>
                <select id='class_name' name="class_name" class="form-control col-md-6" required>
                  <option value="">--Select Class--</option>
                  <?php if(!empty($class_list))
                  {
                    foreach ($class_list as $list) {
                  ?>
                  <option value="<?=$list->class_id;?>"<?php if (!empty($student_details->class_id) && $list->class_id==$student_details->class_id){echo "selected";}?>><?php echo $list->class_name;?></option>
                  <?php }}?>
                </select>
              </div>

                <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for='section_name'>Section Name <span class="error">*</span></label>
                 
                 <div id="sectiondetails"></div><input type="hidden" class="form-control" placeholder="Enter Section" name=""  id="sectionid" value="<?=$student_details->section_id;?>">
                 
               
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for='route_name'>Route Name <span class="error">*</span></label>
                <select id='route_name' name="route_name" class="form-control col-md-6" required>
                  <option value="">--Select Route--</option>
                  <?php if(!empty($route_list))
                  {
                    foreach ($route_list as $list) {
                  ?>
                  <option value="<?=$list->route_id;?>"<?php if (!empty($student_details->route_id) && $list->route_id==$student_details->route_id){echo "selected";}?>><?php echo $list->route_name;?></option>
                  <?php }}?>
                </select>
              </div>


                  <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for='route_name'>Stop Name <span class="error">*</span></label>

                <select id='stop_id' name="stop_id" class="form-control col-md-6" required>
                  <option value="">--Select Class--</option>
                
                </select>


              <!-- <input type="hidden" class="form-control" placeholder="Enter Section" name=""  id="stopid" value="<?=$student_details->stop_id;?>">
                -->
              </div>


              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="status">Status</label>
                <select id="status" name="status"
                  class="form-control col-md-6">
                  <option value="1" <?=(!empty($student_details->status) && $student_details->status == 1) ? 'selected' : ''; ?>>Active</option>
                  <option value="0" <?=(!empty($student_details->status) && $student_details->status == 0) ? 'selected' : ''; ?>>Deactive</option>
                </select>
              </div>

              <div class="modal-footer form-group col-lg-12 col-md-12 col-sm-12">
                <button type="submit" class="btn btn-info submit"><?php if (!empty($form_title)){echo $form_title;}?></button>
                 <a href="<?php echo site_url();?>/Student" class="btn btn-info">Cancel</a>
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

<!-- DATE PICKER PLUGINS BEGIN -->

<link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.css">
<script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-1.12.4.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.js"></script>

<script type="text/javascript">
  $(function() 
  {
  $( "#student_dob" ).datepicker({  maxDate: new Date() });
  });

</script>

<!-- DATE PICKER PLUGINS END -->

<!-- VALIDATION BEGINS -->

<script src="<?php echo base_url();?>assets/plugins/validator/js/jquery.validate.js"></script> 
<script src="<?php echo base_url();?>assets/plugins/validator/js/additional-methods.js"></script> 

<script>

    $(".Studentform").validate({
      rules: 
      {
        school_name: {
          required: true
        },
        student_name: {
          required: true,
          minlength:3,    
        },  
        student_dob: {
          required: true
        },
        student_rollno:{
          required: true,
          number: true
        },
       
        
        class_name:{
          required: true,
        },
        section_name:{
          required: true,
        }
      },
      messages: {},
    });


  $("#class_name").change(function (){

  var class_id=$("#class_name").val();
  
  //alert(class_id);


  if(class_id!='')
  {

    $.ajax({
      type:"POST",
      datatype:"json",
      url:"<?php echo site_url('Student/class_name/');?>",
      data:{'class_id':class_id},
      success: function(data)

      {
            
               
              var obj=JSON.parse(data);
              jQuery('#sectiondetails').html("");
             
              var row=$("<select id='sectiondetails' class='form-control' name='section_name' ><option value=''>Select Section</option>");
             
              $("#sectiondetails").append(row);
              for (var i =0; i<=obj.length; i++) {
                

                row.append("<option value='"+obj[i].section_id +"'>"+ obj[i].section_name +"</option>");
              
                   
               }

               row.append("</select>");
      },
      error: function(){

        console.log('Error While Request Location List..');
        }

    });
  }
  
  });



    var section_id='';
    $(document).ready(function(){
    
    var section_id=$('#sectionid').val();
    if(section_id!='')
  
  
      var class_id=$("#class_name").val();
      var section_id=$("#sectionid").val();
      //alert(price_id);
      $.ajax({
        type:'POST',
        datatype:'json',
        url:"<?php echo site_url('Student/class_name/');?>",
        data:{'class_id':class_id},
        success:function(data)
        {
               //alert(data);
               var obj=JSON.parse(data);
               jQuery('#sectiondetails').html();
              // alert(section_id);
               var row=$("<select id='sectiondetails' class='form-control' name='section_name'><option>Select Section</option>");

               $('#sectiondetails').append(row);
               for (var i =0;i<=obj.length; i++) 
               {

                if(section_id==obj[i].section_id)
                {
                    
               row.append("<option value='"+ obj[i].section_id +"' selected>" +obj[i].section_name+"</option>");
               }
               else
                   {
                   // alert(data);

                    row.append("<option value='"+ obj[i].section_id +"'>"+ obj[i].section_name +"</option>");
              
                   }

               
               
               }
               row.append("</select>");
        },

          error: function(){
        console.log('Error While Request Location List..');
         }
      });
    
  
  });



    $("#route_name").change(function (){

  var route_id=$("#route_name").val();
  
 // alert(route_id);


  if(route_id!='')
  {

    $.ajax({
      type:"POST",
      datatype:"json",
      url:"<?php echo site_url('Student/route_name/');?>",
      data:{'route_id':route_id},
      success: function(data)

      {
            
               
              var obj=JSON.parse(data);
           //   jQuery('#stopdetails').html("");
              console.log(obj);
              alert(obj);
              // var row=$("<select id='stopdetails' class='form-control' name='stop_name'><option value=''>Select Stop</option>");
             
              // $("#stopdetails").append(row);
              for (var i =0; i < obj.length; i++) {
                

                $('#stop_id').append("<option value='"+obj[i].stop_id +"'>"+ obj[i].stop_name +"</option>");
              
                   
               }

              // row.append("</select>");
      },
      error: function(){

        console.log('Error While Request Location List..');
        }

    });
  }
  
  });

  //   var stop_id='';
  //   $(document).ready(function(){
    
  //   var stop_id=$('#stopid').val();
  //   //alert(stop_id);
  //   if(stop_id!='')
  // {
     
  //     var route_id=$("#route_name").val();
  //     var stop_id=$("#stopid").val();
  //     //alert(price_id);
  //     $.ajax({
  //       type:'POST',
  //       datatype:'json',
  //       url:"<?php echo site_url('Student/route_name/');?>",
  //       data:{'route_id':route_id},
  //       success:function(data)
  //       {
  //              //alert(data);
  //              var obj=JSON.parse(data);
  //              jQuery('#stopdetails').html();
  //             // alert(section_id);
  //              var row=$("<select id='stopdetails' class='form-control' name='stop_name'><option>Select Stop</option>");

  //              $('#stopdetails').append(row);
  //              for (var i =0;i<=obj.length; i++) 
  //              {

  //               if(stop_id==obj[i].stop_id)
  //               {
                    
  //              row.append("<option value='"+ obj[i].stop_id +"' selected>" +obj[i].stop_name+"</option>");
  //              }
  //              else
  //                  {
  //                  // alert(data);

  //                   row.append("<option value='"+ obj[i].stop_id +"'>"+ obj[i].stop_name +"</option>");
              
  //                  }

               
               
  //              }
  //              row.append("</select>");
  //       },

  //         error: function(){
  //       console.log('Error While Request Location List..');
  //        }
  //     });
  //   }
  // });



</script>


<!-- VALIDATION END -->

 
