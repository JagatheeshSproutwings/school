<?php 
error_reporting(0);
       $firstname = $this->session->userdata('firstname');
       $userid = $this->session->userdata('userid');
       $role = $this->session->userdata('roleid');
       $dealer_id = $this->session->userdata('dealer_id');
       $dealer_logo = $this->session->userdata('dealer_logo');
       $dealer_color = $this->session->userdata('dealer_color');
        $dealer_company = $this->session->userdata('dealer_company');
?>
     <style type="text/css">
         .navbar-header {
    background: #ffffff !important;
    color: red;
}

     </style>
     <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-border navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header expanded" style="width:240px !important;">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
            <?php if($role=='14' || $role=='15' && $dealer_id==''){ ?>
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url('Dashboard');?>">
                <img class="brand-logo" alt="stack admin logo" src="<?php echo base_url();?>assets/dist/img/logo_s_twings.png" style="height: 100%; width: 78%;margin-top:-20px;" alt="avatar">
            </a></li>
            <?php }elseif($role=='17' || $role=='15' && $dealer_id!=''){ ?>
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url('Dashboard');?>">
                <img class="brand-logo" alt="stack admin logo" src="<?php echo base_url();?>assets/dist/img/logo_yumin.png" style="height: 100%; width: 78%;margin-top:-20px;" alt="school">
            </a></li>
            <?php } ?>
            
            <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon feather icon-toggle-right font-medium-3 hidden" data-ticon="feather.icon-toggle-right"></i></a></li>
            <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left left_ul <?php if($role==15){?>container<?php } ?>">
              <?php 
              if($role=='15'){ ?>
                
                    <li class="nav-item  d-md-block nav_hover" >
                     <a href="<?php echo site_url();?>dashboard/home">                   
                        <img src="<?php echo base_url();?>app-assets\images\menuicon\home.svg" alt="" title="Home" class="menutop-icon" style='margin: 6px 6px;width:30%'>   
                        <b><span class="mb_span">HOME</span> </b>    
                        </a>
                    </li>
<!--                   -->
                <li class="nav-item d-md-block nav_hover" >
                            <a href="<?php echo site_url();?>Dashboard/mapview">
                            
                          <img src="<?php echo base_url();?>app-assets\images\menuicon\1.svg" title="Home" alt="" class="menutop-icon" style="width:30%">  
                          <b><span class="mb_span">DASHBOARD</span> </b>
                        </a>
                    </li>
                        <li class="nav-item d-md-block nav_hover" >
                           <a href="<?php echo site_url();?>Dashboard/reports">
                          <img src="<?php echo base_url();?>app-assets\images\menuicon\20.svg" alt=""title="TABLE VEW" class="menutop-icon" style="width:30%;margin: 2px 2px;">  
                          <b><span class="mb_span">REPORTS</span> </b>
                        </a>
                    </li>
                        <li class="nav-item d-md-block nav_hover">
                           <a href="<?php echo site_url();?>Dashboard/graph_analysis">
                          <img src="<?php echo base_url();?>app-assets\images\menuicon\41.svg" alt="" title="REPORTS" class="menutop-icon" style="width:30%;margin: 2px 2px;">  
                        <b>  <span class="mb_span">GRAPH</span></b>
                        </a>
                    </li>
                       <li class="nav-item  d-md-block nav_hover hidden" >
                           <a href="<?= base_url(); ?>Dashboard/graph_map_analysis" aria-controls="tab5" role="tab" aria-selected="false" title="Fuel Graph">
                          <img src="<?php echo base_url();?>app-assets\images\menuicon\2.svg" alt="" class="menutop-icon" style="width:22%;margin: 2px 2px;">  
                          <b><span class="mb_span">ANALYSIS</span></b>
                        </a>
                    </li>
                   <?php } ?>
                 
                   
          
            </ul>
            <ul class="nav navbar-nav float-right">
                 <?php if ($role=='14') { ?>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                      <i class="ficon feather icon-mail"></i><span class="badge badge-pill badge-warning badge-up"><?php echo $customercomplaint == NULL ? '0' : count($customercomplaint); ?></span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span><span class="notification-tag badge badge-warning float-right m-0"><?php echo $customercomplaint == NULL ? '0' : count($customercomplaint); ?> </span></h6>
                  </li>
                 
                  <li class="scrollable-container media-list">
                       <?php
                  foreach ($customercomplaint as $value) { ?>
                      <a href="<?= site_url(); ?>customercomplaint/complaint_fulldetails/<?php echo $value->id; ?>">
                      <div class="media">
                        <div class="media-left">
                          <div class="avatar avatar-online avatar-sm rounded-circle">
                              <img src="app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i>
                          </div>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading"><?= $value->vehicleid; ?></h6>
                          <p class="notification-text font-small-3 text-muted"><?= $value->subjects; ?></p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?= $value->createdon; ?></time></small>
                        </div>
                      </div>
                      </a>
                 <?php } ?>
                    </li>
                    <!-- <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="<?= site_url() ?>customercomplaint/complaint_list">View all messages</a></li> -->
                </ul>
              </li>
             <?php } ?>
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link login_click" href="#" data-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <?php if ($role=='14' || $role=='15' && $dealer_id=='') { ?>
                     <img src="<?php echo base_url();?>assets/dist/img/logo_s_twings.png" height="20" width="20" alt="avatar">
                   <?php } ?>
                   <?php if ($role=='17' || $role=='15' && $dealer_id!='') { ?>
                    <img src="<?php echo base_url('uploads/company_logo/'.$dealer_logo);?>" height="20" width="20" alt="avatar">
                   <?php } ?>

                 
                    </div>
                    <span class="user-name"><b><?php echo $firstname;?></b></span></a>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="<?php echo site_url(); ?>customercomplaint"><i class="feather icon-user"></i>Complaint</a>
                    <!-- <a class="dropdown-item" href="changepassword.php"><i class="feather icon-lock"></i> Change Password</a> -->
                   <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo site_url('/Login/logout/'.$userid);?>"><i class="feather icon-power"></i> Logout</a>

                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
