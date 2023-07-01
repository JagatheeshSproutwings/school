<?php $role = $this->session->userdata['roleid'];?>
<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">ADMIN DASHBOARD</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>/twings/Dashboard">Home</a> </li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
            </div>
        </div>
        <div class="content-body">

      <!-- START ADMIN  -->
      <!-- START TOGGLE -->
        <div class="card box-shadow-0 border-danger">
             <!-- <a data-action="collapse"> -->
				<div class="card-header card-head-inverse bg-danger" style="background:<?php echo $result['dealer_color'];?> !important;">
					<h4 class="card-title"><?=$result['dealer_name'];?> DASHBOARD</h4>
					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        			<div class="heading-elements">
						<ul class="list-inline mb-0">
	                        <!-- <li><i class="feather icon-minus"></i></a></li> -->
	                        <!-- <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
	                        <li><a data-action="close"><i class="feather icon-x"></i></a></li> -->
	                    </ul>
					</div>
				</div>
				<div class="card-content">
					<div class="card-body" id="dashboard_toggle">
                    <div class="card-body" id="dealers_toggle">
						
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body text-left w-100">
                                                    <h3 class="warning"><?php echo $result['customercount'];?></h3>
                                                    <span>Total Customers</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="fa fa-bus warning font-large-2 float-right"></i>
                                                </div>                        
                                            </div>
                                        <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url("Dashboard/totalcustomers/1/".$result['dealer_id']."");?>" class="dashview">View</a></button>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body text-left w-100">
                                                    <h3 class="primary"><?php echo $result['vehicle_count'];?></h3>
                                                    <span>Total Vehicle</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="fa fa-bus primary font-large-2 float-right"></i>
                                                </div>                        
                                            </div>
                
                                        <button type="button" class="btn btn-primary mt-1"> <a href="<?php echo site_url("Dashboard/dealertotalvehicles/2/".$result['dealer_id']."");?>" class="dashview">View</a></button>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body text-left w-100">
                                                    <h3 class="info"><?php echo $result['active'];?></h3>
                                                    <span>Active Vehicle</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="fa fa-bus info font-large-2 float-right"></i>
                                                </div>                        
                                            </div>
                
                                        <button type="button" class="btn btn-info mt-1"> <a href="<?php echo site_url("Dashboard/dealertotalvehicles/3/".$result['dealer_id']."");?>" class="dashview">View</a></button>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body text-left w-100">
                                                    <h3 class="info"><?php echo $result['deactive'];?></h3>
                                                    <span>Deactive Vehicle</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="fa fa-bus info font-large-2 float-right"></i>
                                                </div>                        
                                            </div>
                
                                        <button type="button" class="btn btn-info mt-1"> <a href="<?php echo site_url("Dashboard/dealertotalvehicles/4/".$result['dealer_id']."");?>" class="dashview">View</a></button>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body text-left w-100">
                                                    <h3 class="success"><?php echo $result['nextdue'];?></h3>
                                                    <span>Next Due</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <i class="fa fa-bus success font-large-2 float-right"></i>
                                                </div>                        
                                            </div>
                
                                        <button type="button" class="btn btn-success mt-1"> <a href="<?php echo site_url("Dashboard/dealertotalvehicles/5/".$result['dealer_id']."");?>" class="dashview">View</a></button>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
         </div>
                           </div>    


                            


					</div>
				</div>
			</div>
                <!-- END TOGGLE -->
       
         <!-- <div class="row"> -->
           


     </div>
      <!-- END ADMIN  -->
       

        </div>
      </div>
    </div>
    <!-- END: Content-->