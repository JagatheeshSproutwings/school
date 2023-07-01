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
        <div class="card box-shadow-0 border-primary">
             <!-- <a data-action="collapse"> -->
				<div class="card-header card-head-inverse bg-primary">
					<h4 class="card-title">ADMIN DASHBOARD</h4>
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
						
                          <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body text-left w-100">
                                                            <h3 class="secondary"><?php echo $total_device_count->total_count;?></h3>
                                                            <span>Total Vehicle</span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus secondary font-large-2 float-right"></i>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary mt-1"> <a href="<?php echo site_url("Dashboard/totaldevice/1");?>" class="dashview">View</a></button>
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
                                                                <h3 class="primary"><?php echo $vehicle_status_count->total_customer_count;?></h3>
                                                            <span>Total Customer</span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus primary font-large-2 float-right"></i>
                                                        </div>                        
                                                    </div>
                                                    <button type="button" class="btn btn-info mt-1"> <a href="<?php echo site_url("Dashboard/totalcustomers/");?>" class="dashview">View</a></button>
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
                                                            <h3 class="success"><?php echo $vehicle_status_count->active_vehicle_count;?></h3>
                                                            <span>Active Device</span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus success font-large-2 float-right"></i>
                                                        </div>                        
                                                    </div>
                                                    <button type="button" class="btn btn-primary mt-1"> <a href="<?php echo site_url("Dashboard/vehicle_status/1");?>" class="dashview">View</a></button>
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
                                                            <h3 class="success"><?php echo $total_device_count->move_count;?></h3>
                                                            <span>Moving Vehicle</span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus success font-large-2 float-right"></i>
                                                        </div>                        
                                                    </div>
                                                        <button type="button" class="btn btn-primary mt-1"><a href="<?php echo site_url("Dashboard/totaldevice/3");?>" class="dashview">View</a></button>
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
                                                                <h3 class="primary"><?php echo $total_device_count->idle_count;?></h3>
                                                            <span>Idle Vehicle</span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus primary font-large-2 float-right"></i>
                                                        </div>                        
                                                    </div>
                                                    <button type="button" class="btn btn-primary mt-1"> <a href="<?php echo site_url("Dashboard/totaldevice/4");?>" class="dashview">View</a></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>  


                            <div class="row">
                                        <div class="col">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body text-left w-100">
                                                            <h3 class="secondary"><?php echo $total_device_count->park_count;?></h3>
                                                            <span>Parking Vehicle </span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus secondary font-large-2 float-right"></i>
                                                        </div>                        
                                                    </div>

                                                    <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url("Dashboard/totaldevice/5");?>" class="dashview">View</a></button>
                        
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
                                                            <h3 class="warning"><?php echo $total_device_count->nonetwork_count;?></h3>
                                                            <span>OOC Vehicles</span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus warning font-large-2 float-right"></i>
                                                        </div>                        
                                                    </div>

                                                    <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url("Dashboard/totaldevice/6");?>" class="dashview">View</a></button>
                        
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
                                                            <h3 class="primary"><?php echo $vehicle_status_count->deactive_vehicle_count;?></h3>
                                                            <span>Deactive Vehicles</span>
                                                        </div>
                                                        <div class="media-right media-middle">
                                                            <i class="fa fa-bus primary font-large-2 float-right"></i>
                                                        </div>                        
                                                    </div>

                                                    <button type="button" class="btn btn-primary mt-1"> <a href="<?php echo site_url("Dashboard/vehicle_status/2");?>" class="dashview">View</a></button>
                        
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
                                    <h3 class="warning"><?php echo $vehicle_status_count->about_due;?></h3>
                                    <span>About Due </span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus warning font-large-2 float-right"></i>
                                </div>                        
                            </div>

                           <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url("Dashboard/totaldevice/8");?>" class="dashview">View</a></button>
 
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
                                    <h3 class="success"><?php echo $vehicle_status_count->subcribe_yr_count;?></h3>
                                    <span>Next Due</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus success font-large-2 float-right"></i>
                                </div>                        
                            </div>

                           <button type="button" class="btn btn-success mt-1"> <a href="<?php echo site_url("Dashboard/totaldevice/9");?>" class="dashview">View</a></button>
 
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

     <!-- START SPROUTWINGS  -->

<?php if($role=='1'){?>     
			<div class="card box-shadow-0 border-primary">
            <!-- <a data-action="collapse"> -->
				<div class="card-header card-head-inverse bg-success">
					<h4 class="card-title">Sproutwings Dashbord</h4>
					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        			<div class="heading-elements">
						<ul class="list-inline mb-0">
	                        <!-- <li> -->
                                <!-- <a data-action="collapse"> -->
                                <!-- <i class="feather icon-minus"></i> -->
                        <!-- </a></li> -->
	                        <!-- <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
	                        <li><a data-action="close"><i class="feather icon-x"></i></a></li> -->
	                    </ul>
					</div>
				</div>
				<div class="card-content">
					<div class="card-body"  id="dashboard_toggle1">
                                <div class="row">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <div class="media">
                                                                <div class="media-body text-left w-100">
                                                                <h3 class="secondary"><?php echo $tw_total_device_count->total_count;?></h3>
                                                                    <span>Total Vehicle</span>
                                                                </div>
                                                                <div class="media-right media-middle">
                                                                    <i class="fa fa-bus secondary font-large-2 float-right"></i>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-secondary mt-1"> <a href="<?php echo site_url("Dashboard/tw_totaldevice/1");?>" class="dashview">View</a></button>
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
                                                                    <h3 class="primary"><?php echo $tw_vehicle_status_count->total_customer_count;?></h3>
                                                                    <span>Total Customer</span>
                                                                </div>
                                                                <div class="media-right media-middle">
                                                                    <i class="fa fa-bus primary font-large-2 float-right"></i>
                                                                </div>                        
                                                            </div>
                                                            <button type="button" class="btn btn-info mt-1"> <a href="<?php echo site_url("Dashboard/totalcustomers/2");?>" class="dashview">View</a></button>
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
                                                                    <h3 class="success"><?php echo $tw_vehicle_status_count->active_vehicle_count;?></h3>
                                                                    <span>Active Device</span>
                                                                </div>
                                                                <div class="media-right media-middle">
                                                                    <i class="fa fa-bus success font-large-2 float-right"></i>
                                                                </div>                        
                                                            </div>
                                                            <button type="button" class="btn btn-success mt-1"><a href="<?php echo site_url("Dashboard/tw_totaldevice/2");?>" class="dashview">View</a></button>
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
                                                                    <h3 class="success"><?php echo $tw_total_device_count->move_count;?></h3>
                                                                    <span>Moving Vehicle</span>
                                                                </div>
                                                                <div class="media-right media-middle">
                                                                    <i class="fa fa-bus success font-large-2 float-right"></i>
                                                                </div>                        
                                                            </div>
                                                            <button type="button" class="btn btn-primary mt-1"><a href="<?php echo site_url("Dashboard/tw_totaldevice/3");?>" class="dashview">View</a></button>
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
                                                                    <h3 class="primary"><?php echo $tw_total_device_count->idle_count;?></h3>
                                                                    <span>Idle Vehicle</span>
                                                                </div>
                                                                <div class="media-right media-middle">
                                                                    <i class="fa fa-bus primary font-large-2 float-right"></i>
                                                                </div>                        
                                                            </div>
                                                            <button type="button" class="btn btn-primary mt-1"> <a href="<?php echo site_url("Dashboard/tw_totaldevice/4");?>" class="dashview">View</a></button>
                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div> 
                                    


                                    <div class="row">
              <div class="col">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-left w-100">
                                    <h3 class="secondary"><?php echo $tw_total_device_count->park_count;?></h3>
                                    <span>Parking Vehicle </span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus secondary font-large-2 float-right"></i>
                                </div>                        
                            </div>

                            <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url("Dashboard/tw_totaldevice/5");?>" class="dashview">View</a></button>
 
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
                                    <h3 class="warning"><?php echo $tw_total_device_count->nonetwork_count;?></h3>
                                    <span>OOC Vehicles</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus warning font-large-2 float-right"></i>
                                </div>                        
                            </div>

                            <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url("Dashboard/tw_totaldevice/6");?>" class="dashview">View</a></button>
 
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
                                    <h3 class="primary"><?php echo $tw_vehicle_status_count->deactive_vehicle_count;?></h3>
                                    <span>Deactive Vehicles</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus primary font-large-2 float-right"></i>
                                </div>                        
                            </div>

                            <button type="button" class="btn btn-primary mt-1"> <a href="<?php echo site_url("Dashboard/vehicle_status/2");?>" class="dashview">View</a></button>
                        
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
                                    <h3 class="warning"><?php echo $tw_vehicle_status_count->about_due;?></h3>
                                    <span>About Due </span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus warning font-large-2 float-right"></i>
                                </div>                        
                            </div>

                           <button type="button" class="btn btn-warning mt-1"> <a href="<?php echo site_url("Dashboard/tw_totaldevice/8");?>" class="dashview">View</a></button>
 
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
                                    <h3 class="success"><?php echo $tw_vehicle_status_count->subcribe_yr_count;?></h3>
                                    <span>Next Due</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="fa fa-bus success font-large-2 float-right"></i>
                                </div>                        
                            </div>

                           <button type="button" class="btn btn-success mt-1"> <a href="<?php echo site_url("Dashboard/tw_totaldevice/9");?>" class="dashview">View</a></button>
 
                        </div>
                    </div>
                </div>
            </div>
         </div>  


                        </div>
                        </div>
                </div>
                                    

       
  <?php } ?>
     
     <!-- END SPROUTWINGS  -->

            <!-- dealers start -->
          
            <div class="card box-shadow-0 border-danger">
       <a data-action="collapse">
				<div class="card-header card-head-inverse bg-danger" style="background:<?php echo $result['dealer_color'];?> !important;">
					<h4 class="card-title">Dealer Dashboard</h4>
					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        			<div class="heading-elements">
						<ul class="list-inline mb-0">
	                        <li>
                                <!-- <a data-action="collapse"><i class="feather icon-minus"></i> -->
                            </a></li>
	                        <!-- <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
	                        <li><a data-action="close"><i class="feather icon-x"></i></a></li> -->
	                    </ul>
					</div>
				</div>
			     

                <div class="card-content collapse">
                            <div class="card-body card-dashboard">
                             
                                <div class="table-responsive">

                                <table  id="dealerlist" class="table table-striped table-bordered dataex-res-configuration">
                                    <thead class="bg-danger">
                                        <tr>
                                            <th>S.No</th>                                          
                                            <th>Company Name</th>
                                            <th>Dealer Name</th>
                                            <th>Email</th>                                           
                                            <th>Contact Number</th>
                                            <th>Dealer Limit</th>
                                           <th>address</th>
                                            <th>pincode</th>
                                            <th>Dashboard List</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         $count_sno = 1;

                                         foreach ($dealerlist as $list) {
                                               ?>

                                        
                                        <tr>
                                              
                                            <th scope="row"> <?=$count_sno++;?>
                                            <td><?=$list->dealer_company;?> </td>
                                            <td><?=$list->dealer_name;?></td>
                                            <td><?=$list->dealer_email;?></td>
                                            <td><?=$list->dealer_mobile;?></td>
                                            <td><?=$list->dealer_limit;?></td>
                                           <td><?=$list->dealer_address;?></td>
                                            <td><?=$list->dealer_pincode;?></td>
                                            <th><a href="<?php echo site_url();?>Dashboard/dealer_data/<?php echo $list->dealer_id?>">SHOW DETAILS</a></th>
                                        
                                        </tr>
                                     

                                      <?php  } ?>
                                        
                                    </tbody>
                                </table>  
                              </div>                
                            </div>
                        </div>



			  </div>
            </a>

        <!-- dealers end -->
         
 
       

        </div>
      </div>
    </div>
    <!-- END: Content-->