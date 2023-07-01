<!-- Content Wrapper. Contains page content -->

<?php $role = ($this->session->userdata['role']); ?>

<style>
.col-lg-6 col-lg-6 col-md-6 col-sm-6 col-sm-6
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
        <div class="col-lg-3 col-md-12 col-sm-12" style='padding-top: 10px;'>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12" style='padding-top: 10px;'>
          <header class="panel-heading">
               <?php echo $form_title;?> Parent &nbsp;<i class="fa fa-plus"></i> <i class="fa fa-user"></i> 
            </header>
            <div class="notify-w3ls"> 
                <div class="box-body">          
            
             <?php                      
              if(!empty($parent_details) && $parent_details!=NULL){ }
             ?>
             
      <!-- form start -->
    <form id="clientForm" class="clientForm" role="form" action="<?php echo site_url('/Parents/save_parent/'); if(!empty($parent_details->userid)){ echo $parent_details->userid;} ?>" method="post">

    <div class="box-body">
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="name">Parent Father Name</label>
            <input type="text" class="form-control col-lg-6 col-md-6 col-sm-6" id="name" name="firstname" placeholder="Enter Father Name" 
            value="<?php if (!empty($parent_details->firstname)){echo $parent_details->firstname;}?>" required>
      <span id="error-dno" class="error-msg"></span>
          </div>
          
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="license">Parent Mother Name</label>
            <input type="text" class="form-control col-lg-6 col-md-6 col-sm-6" id="lastname" name="lastname"   placeholder="Enter Mother Name" value="<?php if (!empty($parent_details->lastname)){echo $parent_details->lastname;}?>" required>
          </div>
      
      <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="email">Email</label>
            <input type="email" class="form-control col-lg-6 col-md-6 col-sm-6" id="email" name="email"  placeholder="Enter Email" value="<?php if (!empty($parent_details->email)){echo $parent_details->email;}?>" required>
          </div>
         
      <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="phone">Primary Mobile  Number</label>
            <input type="text" class="form-control col-lg-6 col-md-6 col-sm-6" id="mobilenumber" name="mobilenumber"   placeholder="Enter Primary No" value="<?php if (!empty($parent_details->mobilenumber)){echo $parent_details->mobilenumber;}?>" required>
          </div>
      
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="mobile"> Secondary Mobile Number</label>
            <input type="text" class="form-control col-lg-6 col-md-6 col-sm-6" id="alter_mobile" name="alter_mobile"   placeholder="Enter Secondary No" value="<?php if (!empty($parent_details->alter_mobile)){echo $parent_details->alter_mobile;}?>">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="website">Address</label>
            <textarea class="form-control col-lg-6 col-md-6 col-sm-6" id="postaladdres" name="postaladdres"  placeholder="Enter Address"><?php if (!empty($parent_details->address)){echo $parent_details->postaladdres;}?></textarea>
          </div>
         

  	    
	    <h4 style='text-align:center;'>
                <b>Create User Login</b>
            </h4>
<!--CREATE USER LOGIN START-->
          
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                      <label for="userName">User Name</label>
                      <input type="text" class="form-control col-lg-6 col-md-6 col-sm-6" id="username" name="username"  placeholder="Enter User Name"
                      value="<?php if (!empty($parent_details->username)){echo $parent_details->username;}?>" required>
                       <span id="error-dno" class="error-msg"></span>
                    </div> 
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                      <label for="secondaryMobile">Password</label>
                      <input type="password" class="form-control col-lg-6 col-md-6 col-sm-6" id="password" name="password"  placeholder="Enter Password" value="123456" required>
                    </div>   
                            
             
      
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
      <label for="status">Status</label> <select id="status" name="status"
        class="form-control" required>
        <option value="1"
          <?=(!empty($parent_details->status) && $parent_details->status == 1) ? 'selected' : ''; ?>>Active</option>
        <option value="0"
          <?=(!empty($parent_details->status) && $parent_details->status == 0) ? 'selected' : ''; ?>>Deactive</option>
      </select>
    </div>
  
        </div>
<!--CREATE USER LOGIN END-->
     
        </div>
    <!-- /.box-body -->
    <div class="modal-footer form-group col-lg-6 col-md-6 col-sm-6">
      <button type="submit" class="btn btn-success submit"><?php if (!empty($form_title)){echo $form_title;}?></button>
      <a href="<?php echo site_url('/Parents/');?>" class="btn btn-success">Cancel</a>
    </div>
  </form>
  <!-- FORM END -->
            </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-3 col-md-12 col-sm-12" style='padding-top: 10px;'>
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

  <script src="<?php echo base_url();?>/assets/plugins/moment.js"> </script>
  <script src="<?php echo base_url();?>/assets/plugins/timepicker.js"> </script>
  <link rel="stylesheet" ahref="<?php echo base_url();?>/assets/plugins/timepicker.css" type='text/css'>
    
    <script type="text/javascript">
      $(function () {
         $( "#datetimepicker1" ).datetimepicker({ maxDate: new Date() });
         $( "#datetimepicker2" ).datetimepicker({  maxDate: new Date() });
      });
  </script>
<!-- DATE PICKER PLUGINS END -->

<script src="<?php echo base_url();?>assets/plugins/validator/js/jquery.validate.js"></script> 
<script src="<?php echo base_url();?>assets/plugins/validator/js/additional-methods.js"></script> 

<script>


    $(".vehicleForm").validate({
      rules: {
        vehicleName: {
          required: true,
          minlength: 2,
          maxlength: 25
        },
        vehicleRegisterNumber: {
          required: true,
          minlength: 2,
          maxlength: 25
        },              
        vehicleModel: {
          required: true,
          minlength:2,      
        },
        status: {
          required: true,       
        },
        vehicle_type: {
          required: true,       
        },
        client: {
          required: true,       
        },
        
      },
      messages: {}
    });     
    

   
</script>
