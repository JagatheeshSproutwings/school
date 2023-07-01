<?php
    defined('BASEPATH') or exit('No direct script access allowed'); 
    $dealer_logo = $this->session->userdata('dealer_logo'); 
     $role = $this->session->userdata('roleid');
     $dealer_company = $this->session->userdata('dealer_company');
     $dealer_id = $this->session->userdata('dealer_id');
     $subdealer_id = $this->session->userdata('subdealer_id');
     $subdealer_company = $this->session->userdata('subdealer_company');
     $subdealer_logo = $this->session->userdata('subdealer_logo');
     ?>

<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="sproutwings is real time gps tracking system in all over india .our products are personal tracker,asset tracker,vechicle tracker,personal tracker,fleet tracker etc..,">
<meta name="keywords" content="">
<meta name="author" content="Trackingwings">
<?php if ($role=='1' || $role=='2') { ?>
  <title>Vehicle Tracking</title>

  <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/dist/img/fav_icon.png">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/dist/img/fav_icon.png">
  <?php

} elseif ($role=='3') { ?>
 
  <title><?php echo $dealer_company;?></title>
   <link rel="apple-touch-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">
<?php 

}
elseif ($role=='4') { ?>
 
  <title><?php echo $subdealer_company;?></title>
  <?php if($subdealer_logo==''){ ?>

     <link rel="apple-touch-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">
<?php  } else {?>
   <link rel="apple-touch-icon" href="<?php echo base_url('uploads/subdealer_logo/'.$subdealer_logo);?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('uploads/subdealer_logo/'.$subdealer_logo);?>">
<?php 
}
}
elseif($role=='5' || $role=='6' || $role>='7'){ 

   if ($dealer_id!='' && $subdealer_id!='' && $subdealer_id!=0) { 
      if ($subdealer_logo!='') { ?>
        
                        <title><?php echo $subdealer_company;?></title>
                       <link rel="apple-touch-icon" href="<?php echo base_url('uploads/subdealer_logo/'.$subdealer_logo);?>">
                      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('uploads/subdealer_logo/'.$subdealer_logo);?>">

  <?php   }  else { ?>
     

                      <title><?php echo $subdealer_company;?></title>
                       <link rel="apple-touch-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">
                      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">

     <?php }?>
                     
                    
                   <?php    } elseif ($dealer_id!='' && ($subdealer_id=='' || $subdealer_id==0)) { ?>

                      <title><?php echo $dealer_company;?></title>
                       <link rel="apple-touch-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">
                      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>">

                 <?php   }


                   else{ ?>
                     <title>Vehicle Tracking</title>
                    <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/dist/img/fav_icon.png">
                  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/dist/img/fav_icon.png">

                 <?php  }  } ?>
   

 


<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

 <!-- BEGIN: FONT AWESOME Custom CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/fonts/font-awesome/css/font-awesome.min.css">
 <!-- END: Custom CSS-->

 
<!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/vendors.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/forms/quill/quill.snow.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
    
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/forms/icheck/icheck.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/forms/icheck/custom.css">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/forms/selects/select2.min.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/colors/palette-gradient.min.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/pages/app-email.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/plugins/pickers/daterange/daterange.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/colors/palette-tooltip.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/plugins/forms/checkboxes-radios.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/twings.css">
    <!-- END: Custom CSS-->

 
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/colors/palette-gradient.min.css">
 
<!--BEGIN Validation CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/pages/login-register.min.css">
<!--END Validation CSS -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <!-- END: Vendor CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/plugins/forms/switch.min.css">

     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
      <script src="<?php echo base_url();?>app-assets/vendors/js/vendors.min.js"></script>

      
      
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/weather-icons/climacons.min.css">
  <!--   <link rel="stylesheet" type="text/css" href="<?php// echo base_url();?>app-assets/vendors/css/charts/leaflet.css"> -->
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/colors/palette-climacon.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/fonts/simple-line-icons/style.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/fonts/meteocons/style.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/pages/users.min.css">

<!-- Leaflet Map css file -->
     <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/osm/leaflet.css"/> 
     
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/extensions/toastr.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/plugins/extensions/toastr.min.css">
     
<style>
 .overlay{
        display: none;
        position: fixed;
		opacity: 0.5;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("../app-assets/images/icons/carload.gif") center no-repeat;
    }
   
    .loadings{
        overflow: hidden;   
    }
   
    .loadings .overlay{
        display: block;
    }
	</style>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  </head>
  <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar  menu-collapsed pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-new-gr-c-s-check-loaded="14.1040.0" data-gr-ext-installed="">