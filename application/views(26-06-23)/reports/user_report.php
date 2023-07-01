  <style>
      .table td, .table th{
          padding: 10px !important;
      }
      .databottom td{
        padding-top: 3px !important;
        padding-bottom: 3px !important;
      }
      body.vertical-layout.vertical-menu-modern.menu-collapsed .navbar .navbar-header.expanded{
          width: 105px !important;
    z-index: 1000;
      }
      .dataTables_info{
          display: none;
      }
      .dataTables_length{
          display: none;
      }
      .dataTables_filter{
          margin: -2px 45px;
      }
      .form-control form-control-sm{
          width: 200px !important;
      }
      
.wrapper{
  background: #456173;
  display: flex;
  width: 105%;
}
.datacards {
    padding-top: 15px;
  background: #fff;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  display: grid;
  grid-gap: 1rem;
  grid-auto-flow: column;
  grid-auto-columns: calc(35% - 2rem);
  min-height: 50vh;
  width: 100%;
}
.datacards-content {
  /*align-items: center;*/
  background: #fff;
  border-radius: 1rem;
  color: #111;
  display: flex;
  /*font-weight: 900;*/
  /*justify-content: center;*/
  /*font-size: 5rem;*/
  /*text-transform: uppercase;*/
}
.datacards-content:first-child {
  margin-left: 1rem;
}
.datacards-content:last-child {
  margin-right: 1rem;
}
.menutop-icon{
    width: unset !important;
    max-width: unset !important;
    height: auto;
    border: 0;
    border-radius: 50%;
}
                                                    
  </style>
    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

        <div class="app-content content" style="margin: 0px;margin-left:-15px">
<div class="sidebar-left" style="width: 350px !important">
    <div class="sidebar">
        <div class="sidebar-content email-app-sidebar d-flex" style="width: 350px !important">
            <span class="sidebar-close-icon">
                <i class="feather icon-x"></i>
            </span>
            <!-- sidebar close icon -->
            <div class="email-app-menu">
                <div class="col-xl-12 col-md-12 col-lg-12" style="padding: 5px">
                    <div class="card">
<!--======Don't use and delete=== Its hidden calendar support line======-->
<div class="hidden" hidden><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">
<span class="fa fa-calendar-o"></span></span></div><input id="picker_from" class="form-control datepicker" type="date"></div>
<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><span class="fa fa-calendar-o">
</span></span></div></div></div>
<!--======Don't use and delete=========-->
<div class="form-group">
    <input id="picker_to" class="form-control datepicker" hidden type="hidden">
    <!--<label>24 hour Time Picker with Seconds I need</label>-->
    <div class='input-group'>
        <input type='text' class="form-control timeseconds" />
        <div class="input-group-append">
            <span class="input-group-text">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
    </div>
</div>

				<div class="card-content1">
					<div class="card-body1">
						<ul class="nav nav-tabs nav-only-icon nav-top-border no-hover-bg" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" id="homeOnlyIcon-tab1" data-toggle="tab" href="#homeOnlyIcon1" aria-controls="homeOnlyIcon1" role="tab" aria-selected="false"><i class="fa fa-align-justify"></i></a>
							</li>
							<li class="nav-item">
							<a class="nav-link" id="profileOnlyIcon-tab1" data-toggle="tab" href="#profileOnlyIcon1" aria-controls="profileOnlyIcon1" role="tab" aria-selected="true"><i class="fa fa-header"></i></a>
							</li>
						</ul>
						<div class="tab-content px-1 pt-1">
							<div class="tab-pane active in" id="homeOnlyIcon1" aria-labelledby="homeOnlyIcon-tab1" role="tabpanel">
								<table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="icheck-input-all" class="icheck-activity">
                                </th>
                                <th>Activity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-truncate">
                                    <input type="checkbox" id="icheck-input-1" class="icheck-activity" checked>
                                </td>
                                <td class="text-truncate">Bricks Walking</td>
                                <td class="text-truncate"><span class="badge badge-success">Done</span></td>
                            </tr>
                            <tr>
                                <td class="text-truncate">
                                    <input type="checkbox" id="icheck-input-2" class="icheck-activity" checked>
                                </td>
                                <td class="text-truncate">Morning Exercise</td>
                                <td class="text-truncate"><span class="badge badge-success">Done</span></td>
                            </tr>
                            <tr>
                                <td class="text-truncate">
                                    <input type="checkbox" id="icheck-input-3" class="icheck-activity">
                                </td>
                                <td class="text-truncate">Yoga</td>
                                <td class="text-truncate"><span class="badge badge-danger">Missed</span></td>
                            </tr>
                            <tr>
                                <td class="text-truncate">
                                    <input type="checkbox" id="icheck-input-4" class="icheck-activity" checked>
                                </td>
                                <td class="text-truncate">Gym</td>
                                <td class="text-truncate"><span class="badge badge-success">Done</span></td>
                            </tr>
                        </tbody>
                    </table>
							</div>
							<div class="tab-pane" id="profileOnlyIcon1" aria-labelledby="profileOnlyIcon-tab1" role="tabpanel">
								<p>Pudding candy canes sugar plum cookie chocolate cake powder croissant. Carrot cake tiramisu danish candy cake muffin croissant tart dessert. Tiramisu caramels candy canes chocolate cake sweet roll liquorice icing cupcake.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
                </div>
            </div>
            <!-- BEGIN: Vendor JS-->
        </div>
    </div>
</div>
            
<div class="content-right" style="width: calc(100% - 350px) !important;">
            <div class="content-overlay"></div>
            <div class="content-wrapper" style="padding: 0px">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- email app overlay -->
                    <div class="app-content-overlay"></div>
                    <div class="row match-height">
                        <div class="col-xl-4 col-lg-12" style="padding: 23px;">
                            <div class="card" style="height: 270px;">                              
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/06.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12" style="padding: 20px;">
                            <div class="card" style="height: 270px;">                                 
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/06.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12" style="padding: 20px;">
                            <div class="card" style="height: 270px;">                                
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/06.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12" style="padding-top: 0px;padding-left: 20px;
                                                        margin-top: -26px;margin-bottom: 0px">
                           <div class="card" style="height: 270px;">                                
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/06.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12" style="padding-top: 0px;padding-left: 20px;
                                                        margin-top: -26px;margin-bottom: 0px">
                           <div class="card" style="height: 270px;">                                 
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/06.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12" style="padding-top: 0px;padding-left: 20px;
                                                        margin-top: -26px;margin-bottom: 0px">
                           <div class="card" style="height: 270px;">                                
                                <div class="card-content">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>app-assets/images/carousel/06.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                
                   
            </div>
        </div>            
            
        </div>
   <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block">
         <a class="customizer-close" href="#"><i class="feather icon-x font-medium-3"></i>
         </a><a class="customizer-toggle bg-danger" href="#"><i class="feather icon-settings font-medium-3 fa-spin fa fa-spin fa-fw white"></i></a><div class="customizer-content p-2">
	<h4 class="text-uppercase mb-0">Reports</h4>
	<hr>
	<p>Real Time Reports</p>
	
	<h5 class="mt-1 text-bold-500">Layout Options</h5>
	<ul class="nav nav-tabs nav-underline nav-justified layout-options">
		<li class="nav-item">
			<a class="nav-link layouts active" id="baseIcon-tab21-base" data-toggle="tab" aria-controls="tabIcon21-base" href="#tabIcon21-base" aria-expanded="true">Layouts</a>
		</li>
		<li class="nav-item">
			<a class="nav-link navigation" id="baseIcon-tab22-base" data-toggle="tab" aria-controls="tabIcon22-base" href="#tabIcon22-base" aria-expanded="false">Navigation</a>
		</li>
		<li class="nav-item">
			<a class="nav-link navbar" id="baseIcon-tab23-base" data-toggle="tab" aria-controls="tabIcon23-base" href="#tabIcon23-base" aria-expanded="false">Navbar</a>
		</li>
	</ul>
	<div class="tab-content px-1 pt-1">
		<div role="tabpanel" class="tab-pane active" id="tabIcon21-base" aria-expanded="true" aria-labelledby="baseIcon-tab21-base">
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="collapsed-sidebar" id="collapsed-sidebar">
					<label class="custom-control-label" for="collapsed-sidebar">Collapsed Menu</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="fixed-layout" id="fixed-layout">
					<label class="custom-control-label" for="fixed-layout">Fixed Layout</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
					<label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
				</div>

				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="static-layout" id="static-layout">
					<label class="custom-control-label" for="static-layout">Static Layout</label>
				</div>
			
		</div>
		<div class="tab-pane" id="tabIcon22-base" aria-labelledby="baseIcon-tab22-base">
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="native-scroll" id="native-scroll">
					<label class="custom-control-label" for="native-scroll">Native Scroll</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="right-side-icons" id="right-side-icons">
					<label class="custom-control-label" for="right-side-icons">Right Side Icons</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="bordered-navigation" id="bordered-navigation">
					<label class="custom-control-label" for="bordered-navigation">Bordered Navigation</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="flipped-navigation" id="flipped-navigation">
					<label class="custom-control-label" for="flipped-navigation">Flipped Navigation</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="collapsible-navigation" id="collapsible-navigation">
					<label class="custom-control-label" for="collapsible-navigation">Collapsible Navigation</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="static-navigation" id="static-navigation">
					<label class="custom-control-label" for="static-navigation">Static Navigation</label>
				</div>
			
		</div>
		<div class="tab-pane" id="tabIcon23-base" aria-labelledby="baseIcon-tab23-base">
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="brand-center" id="brand-center">
					<label class="custom-control-label" for="brand-center">Brand Center</label>
				</div>
			
				<div class="custom-control custom-checkbox mb-1">
					<input type="checkbox" class="custom-control-input" name="navbar-static-top" id="navbar-static-top">
					<label class="custom-control-label" for="navbar-static-top">Static Top</label>
				</div>
			
		</div>
	</div>

	<hr>

	<h5 class="mt-1 text-bold-500">Navigation Color Options</h5>
	<ul class="nav nav-tabs nav-underline nav-justified color-options">
		<li class="nav-item">
			<a class="nav-link nav-semi-light active" id="color-opt-1" data-toggle="tab" aria-controls="clrOpt1" href="#clrOpt1" aria-expanded="false">Semi Light</a>
		</li>
		<li class="nav-item">
			<a class="nav-link nav-semi-dark" id="color-opt-2" data-toggle="tab" aria-controls="clrOpt2" href="#clrOpt2" aria-expanded="false">Semi Dark</a>
		</li>
		<li class="nav-item">
			<a class="nav-link nav-dark" id="color-opt-3" data-toggle="tab" aria-controls="clrOpt3" href="#clrOpt3" aria-expanded="false">Dark</a>
		</li>
		<li class="nav-item">
			<a class="nav-link nav-light" id="color-opt-4" data-toggle="tab" aria-controls="clrOpt4" href="#clrOpt4" aria-expanded="true">Light</a>
		</li>
	</ul>
	<div class="tab-content px-1 pt-1">
		<div role="tabpanel" class="tab-pane active" id="clrOpt1" aria-expanded="true" aria-labelledby="color-opt-1">
			<div class="row">
				<div class="col-6">
					<h6>Solid</h6>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey" id="default-solid">
							<label class="custom-control-label" for="default-solid">Default</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="primary-solid">
							<label class="custom-control-label" for="primary-solid">Primary</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="danger-solid">
							<label class="custom-control-label" for="danger-solid">Danger</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-success" data-bg="bg-success" id="success-solid">
							<label class="custom-control-label" for="success-solid">Success</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="blue">
							<label class="custom-control-label" for="blue">Blue</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="cyan">
							<label class="custom-control-label" for="cyan">Cyan</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="pink">
							<label class="custom-control-label" for="pink">Pink</label>
						</div>
					
				</div>
				<div class="col-6">
					<h6>Gradient</h6>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" checked class="custom-control-input bg-blue-grey" data-bg="bg-gradient-x-grey-blue" id="bg-gradient-x-grey-blue">
							<label class="custom-control-label" for="bg-gradient-x-grey-blue">Default</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-primary" data-bg="bg-gradient-x-primary" id="bg-gradient-x-primary">
							<label class="custom-control-label" for="bg-gradient-x-primary">Primary</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-danger" data-bg="bg-gradient-x-danger" id="bg-gradient-x-danger">
							<label class="custom-control-label" for="bg-gradient-x-danger">Danger</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-success" data-bg="bg-gradient-x-success" id="bg-gradient-x-success">
							<label class="custom-control-label" for="bg-gradient-x-success">Success</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue" data-bg="bg-gradient-x-blue" id="bg-gradient-x-blue">
							<label class="custom-control-label" for="bg-gradient-x-blue">Blue</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-cyan" data-bg="bg-gradient-x-cyan" id="bg-gradient-x-cyan">
							<label class="custom-control-label" for="bg-gradient-x-cyan">Cyan</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-slight-clr" class="custom-control-input bg-pink" data-bg="bg-gradient-x-pink" id="bg-gradient-x-pink">
							<label class="custom-control-label" for="bg-gradient-x-pink">Pink</label>
						</div>
					
				</div>
			</div>
		</div>
		<div class="tab-pane" id="clrOpt2" aria-labelledby="color-opt-2">
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-sdark-clr" checked class="custom-control-input bg-default" data-bg="bg-default" id="opt-default">
					<label class="custom-control-label" for="opt-default">Default</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="opt-primary">
					<label class="custom-control-label" for="opt-primary">Primary</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="opt-danger">
					<label class="custom-control-label" for="opt-danger">Danger</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-success" data-bg="bg-success" id="opt-success">
					<label class="custom-control-label" for="opt-success">Success</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="opt-blue">
					<label class="custom-control-label" for="opt-blue">Blue</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="opt-cyan">
					<label class="custom-control-label" for="opt-cyan">Cyan</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="opt-pink">
					<label class="custom-control-label" for="opt-pink">Pink</label>
				</div>
			
		</div>
		<div class="tab-pane" id="clrOpt3" aria-labelledby="color-opt-3">
			<div class="row">
				<div class="col-6">
					<h3>Solid</h3>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey" id="solid-blue-grey">
							<label class="custom-control-label" for="solid-blue-grey">Default</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="solid-primary">
							<label class="custom-control-label" for="solid-primary">Primary</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="solid-danger">
							<label class="custom-control-label" for="solid-danger">Danger</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-success" data-bg="bg-success" id="solid-success">
							<label class="custom-control-label" for="solid-success">Success</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="solid-blue">
							<label class="custom-control-label" for="solid-blue">Blue</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="solid-cyan">
							<label class="custom-control-label" for="solid-cyan">Cyan</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="solid-pink">
							<label class="custom-control-label" for="solid-pink">Pink</label>
						</div>
					
				</div>

				<div class="col-6">
					<h3>Gradient</h3>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue-grey" data-bg="bg-gradient-x-grey-blue" id="bg-gradient-x-grey-blue1">
							<label class="custom-control-label" for="bg-gradient-x-grey-blue1">Default</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-primary" data-bg="bg-gradient-x-primary" id="bg-gradient-x-primary1">
							<label class="custom-control-label" for="bg-gradient-x-primary1">Primary</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-danger" data-bg="bg-gradient-x-danger" id="bg-gradient-x-danger1">
							<label class="custom-control-label" for="bg-gradient-x-danger1">Danger</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-success" data-bg="bg-gradient-x-success" id="bg-gradient-x-success1">
							<label class="custom-control-label" for="bg-gradient-x-success1">Success</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-blue" data-bg="bg-gradient-x-blue" id="bg-gradient-x-blue1">
							<label class="custom-control-label" for="bg-gradient-x-blue1">Blue</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-cyan" data-bg="bg-gradient-x-cyan" id="bg-gradient-x-cyan1">
							<label class="custom-control-label" for="bg-gradient-x-cyan1">Cyan</label>
						</div>
					
						<div class="custom-control custom-radio mb-1">
							<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-pink" data-bg="bg-gradient-x-pink" id="bg-gradient-x-pink1">
							<label class="custom-control-label" for="bg-gradient-x-pink1">Pink</label>
						</div>
					
				</div>
			</div>
		</div>
		<div class="tab-pane" id="clrOpt4" aria-labelledby="color-opt-4">
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-light-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey bg-lighten-4" id="light-blue-grey">
					<label class="custom-control-label" for="light-blue-grey">Default</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-light-clr" class="custom-control-input bg-primary" data-bg="bg-primary bg-lighten-4" id="light-primary">
					<label class="custom-control-label" for="light-primary">Primary</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-light-clr" class="custom-control-input bg-danger" data-bg="bg-danger bg-lighten-4" id="light-danger">
					<label class="custom-control-label" for="light-danger">Danger</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-light-clr" class="custom-control-input bg-success" data-bg="bg-success bg-lighten-4" id="light-success">
					<label class="custom-control-label" for="light-success">Success</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-light-clr" class="custom-control-input bg-blue" data-bg="bg-blue bg-lighten-4" id="light-blue">
					<label class="custom-control-label" for="light-blue">Blue</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-light-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan bg-lighten-4" id="light-cyan">
					<label class="custom-control-label" for="light-cyan">Cyan</label>
				</div>
			
				<div class="custom-control custom-radio mb-1">
					<input type="radio" name="nav-light-clr" class="custom-control-input bg-pink" data-bg="bg-pink bg-lighten-4" id="light-pink">
					<label class="custom-control-label" for="light-pink">Pink</label>
				</div>
			
		</div>
	</div>

	<hr>

	<h5 class="mt-1 mb-1 text-bold-500">Menu Color Options</h5>
	<div class="form-group">
		<!-- Outline Button group -->
		<div class="btn-group customizer-sidebar-options" role="group" aria-label="Basic example">
			<button type="button" class="btn btn-outline-info" data-sidebar="menu-light">Light Menu</button>
			<button type="button" class="btn btn-outline-info" data-sidebar="menu-dark">Dark Menu</button>
		</div>
	</div>
</div>
    </div>
        
    <!-- BEGIN Vendor JS-->
     <script type="text/javascript">
              $( document ).ready(function() {
                $('#example').DataTable();                
            </script>        
            
            


