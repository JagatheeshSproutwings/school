<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
   
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern 2-columns email-application fixed-navbar pace-done menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

        <?php //echo "test data";exit; ?>

        <!--stats-->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="secondary"><?php echo $total_device_count->move_count+$total_device_count->idle_count+$total_device_count->park_count+$total_device_count->nonetwork_count ;?></h3>
                                    <span>Total Vehicle</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus secondary font-large-2 float-right"></i>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mt-1"> <a href="<?php echo site_url();?>/Financier/totalloanvehicle" class="dashview">View</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="success"><?php echo $total_device_count->move_count;?></h3>
                                    <span>Moving Vehicle</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus success font-large-2 float-right"></i>
                                </div>                        
                            </div>
                            <button type="button" class="btn btn-success mt-1"><a href="<?php echo site_url();?>/Financier/pendingapl" class="dashview">View</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="primary"><?php echo $total_device_count->idle_count;?></h3>
                                    <span>Idle Vehicle</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus primary font-large-2 float-right"></i>
                                </div>                        
                            </div>
                            <button type="button" class="btn btn-primary mt-1"><a href="<?php echo site_url();?>/Financier/overdue" class="dashview">View</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="warning"><?php echo $total_device_count->nonetwork_count;?></h3>
                                    <span>OOC Vehicles</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus warning font-large-2 float-right"></i>
                                </div>                        
                            </div>

                           <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url();?>/Financier/totalloanvehicle" class="dashview">View</a></button>
 
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/stats-->

        </div>
      </div>
    </div>
    <!-- END: Content-->


  </body>
  <!-- END: Body-->
</html>