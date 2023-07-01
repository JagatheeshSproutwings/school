<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
   
  </head>
  <!-- END: Head-->

 
    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">


        <!--stats-->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="secondary"><?php echo $totalloan_count->totalloan_vehicle;?>90</h3>
                                    <span>Total Device</span>
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
                                    <h3 class="success"><?php echo $pendingapl_count->pendingapl;?>50</h3>
                                    <span>Active Device</span>
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
                                    <h3 class="primary">75</h3>
                                    <span>Moving</span>
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
                                    <h3 class="warning">50450</h3>
                                    <span>Parking</span>
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


            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="primary">90</h3>
                                    <span>Idle</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus primary font-large-2 float-right"></i>
                                </div>                        
                            </div>

                           <button type="button" class="btn btn-primary mt-1"> <a href="<?php echo site_url();?>/Financier/totalloanvehicle" class="dashview">View</a></button>
 
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
                                    <h3 class="warning">50</h3>
                                    <span>No Network</span>
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

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="success">50</h3>
                                    <span>Next Due</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus success font-large-2 float-right"></i>
                                </div>                        
                            </div>

                           <button type="button" class="btn btn-success mt-1"> <a href="<?php echo site_url();?>/Financier/totalloanvehicle" class="dashview">View</a></button>
 
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
                                    <h3 class="secondary">50450</h3>
                                    <span>Deactive Vehicle </span>
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



        </div>
        <!--/stats-->

        </div>
      </div>
    </div>
    <!-- END: Content-->


  </body>
  <!-- END: Body-->
</html>