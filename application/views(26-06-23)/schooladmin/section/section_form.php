
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
          <div class="col-lg-1 col-md-12 col-sm-12" style='padding-top: 10px;'>
          </div>
          <div class="col-lg-10 col-md-12 col-sm-12" style='padding-top: 10px;'>
            <header class="panel-heading">
                 <?php echo $form_title;?> Section &nbsp;<i class="fa fa-plus"></i>
              </header>
              <div class="notify-w3ls  stats-info stats-last widget-shadow" style=" border: none;"> 
              <div class="box-body">          
              
               <?php                      
                if(!empty($section_details) && $section_details!=NULL){ }
               ?>
               
                <!-- form start -->
                <form role='form' class="Sectionform" method="post" action='<?php echo site_url('/section/save_section/');if(!empty($section_details->section_id)) { echo $section_details->section_id; } ?>'>

                      <div class="box-body">

                        
                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                          <label for='class_name'>Class Name <span class="error">*</span></label>
                          <select id='class_name' name="class_name" class="form-control col-md-6">
                            <option value="">--Select Class--</option>
                            <?php if(!empty($class_names))
                            {
                              foreach ($class_names as $list) {
                            ?>
                            <option value="<?=$list->class_id;?>"<?=(!empty($section_details->class_id) && $section_details->class_id == $list->class_id) ? 'selected' : ''; ?>><?php echo $list->class_name;?></option>
                            <?php }}?>
                          </select>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                          <label for="section_name">Section Name <span class="error">*</span></label>
                          <input type="text" class="form-control col-md-6 " id="section_name" name="section_name" placeholder="Enter Section Name..." value="<?php if (!empty($section_details->section_name)){echo $section_details->section_name;}?>">
                          <span id="error-dno" class="error-msg"></span>
                        </div>


                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                          <label for="status">Status</label> 
                          <select id="status" name="status" class="form-control col-md-6">
                            <option value="1" <?=(!empty($section_details->status) && $section_details->status == 1) ? 'selected' : ''; ?>>Active</option>
                            <option value="0" <?=(!empty($section_details->status) && $section_details->status == 0) ? 'selected' : ''; ?>>Deactive</option>
                          </select>
                        </div>
                       
                      </div>
                    <!-- /.box-body -->
                  <div class="modal-footer form-group col-lg-12 col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-info submit"><?php if (!empty($form_title)){echo $form_title;}?></button>
                  <a href="<?php echo site_url();?>/Section" class="btn btn-info">Cancel</a>
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

<script src="<?php echo base_url();?>/assets/plugins/moment.js"> </script>
<script src="<?php echo base_url();?>/assets/plugins/timepicker.js"> </script>
<link rel="stylesheet" ahref="<?php echo base_url();?>/assets/plugins/timepicker.css" type='text/css'>
  
  <script type="text/javascript">
    $(function () {
       $( "#datetimepicker1" ).datetimepicker({ maxDate: new Date() });
       $( "#datetimepicker2" ).datetimepicker({  maxDate: new Date() });
    });

    $(document).ready(function()
    {
      var form_title = "<?php echo $form_title;?>";
      if(form_title == 'Update')
      {
        $("#hide").addClass('hide');
      }
    });

</script>
<!-- DATE PICKER PLUGINS END -->

<!-- VALIDATION BEGINS -->

<script src="<?php echo base_url();?>assets/plugins/validator/js/jquery.validate.js"></script> 
<script src="<?php echo base_url();?>assets/plugins/validator/js/additional-methods.js"></script> 

<script>

    $(".Sectionform").validate({
      rules: 
      {
        class_name: {
          required: true, 
        },
        school_name: {
          required: true, 
        },
        section_name: {
          required: true, 
        }
      },
      messages: {},
    });

</script>
