<!-- BEGIN: Body-->
<?php error_reporting(0);  

    $role =$this->session->userdata['roleid'];
    $clientid=$this->session->userdata['client_id'];
?>

<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">VEHICLE</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> VEHICLE</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <?php if($role!=5){ ?>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add  Vehicle </button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adduser" style="display:none;">
                            <div class="card">
                              
                                <div class="card-header">
                                    <h4 class="card-title">Add Vehicle </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                               
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="vehicleform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Vehicle Details</h4>
                                              </div>

                                              <?php if($role==14 || $role==15){?>
                                   <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="vehicletype">Client Name</label>
                                            <select class="select2 form-control" id="client_id" name="client_id">
                                                <option value="">Select Client</option>
                                             <?php if ($client_name) {
                                                foreach ($client_name as $cname) { ?>
                                                     <option value="<?php echo $cname->client_id;?>"><?php echo $cname->client_name;?></option>
                                                    <?php   }  }?>
                                              
                                            </select>
                                        </fieldset>
                                    </div>

                                <?php } ?>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="vehiclename" class="required requirednet">Vehicle Name<span class="error">&nbsp;*</span></label>
                                        <input type="text" class="form-control" id="vehiclename" name="vehiclename" placeholder="Enter the Vehicle Name"><div class="div1" id="div1"></div>
                                    </fieldset>
                                </div>
                                <input type="hidden" name="vehiclename1" id="vehiclename1" value="">         
                                <input type="hidden" name="createdon" id="createdon" value="">                   
                              
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="vehicletype">Vehicle Type</label>
                                            <select class="form-control" id="vehicletype" name="vehicletype">
                                                <option value="">Select Type</option>
                                             <?php if ($vehicletype) {
                                                foreach ($vehicletype as $vtype) {   ?>
                                                     <option value="<?php echo $vtype->vtype_id;?>"><?php echo $vtype->vehicletype;?></option>
                                                    <?php  } }?>
                                  
                                            </select>
                                        </fieldset>
                                    </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="vehiclemodel" class="required requiredsim">Vehicle Model<span class="error">&nbsp;*</span><span id='exist' class="error"> </span></label>
                                        <input type="text" class="form-control" id="vehiclemodel" name="vehiclemodel" placeholder="Enter the Vehicle Model"><div class="div3" id="div3"></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="modelnumber" class="required requiredfrom">Model Number<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="modelnumber" name="modelnumber" placeholder="Enter the Model Number"><div class="div4" id="div4"></div>
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="registrationnumber" class="required requiredto">Registration Number<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="registrationnumber" name="registrationnumber" placeholder="Enter the Registration Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>             

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="chassisnumber" class="required requiredto">Chassis Number<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="chassisnumber" name="chassisnumber" placeholder="Enter the Chassis Number"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>          

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="enginenumber" class="required requiredto">Engine Number<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="enginenumber" name="enginenumber" placeholder="Enter the Engine Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="insurancecompany" class="required requiredto">Insurance Company<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="insurancecompany" name="insurancecompany" placeholder="Enter the Insurance Company "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="insurancenumber" class="required requiredto">Insurance Number<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="insurancenumber" name="insurancenumber" placeholder="Enter the Insurance Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="insurancedate" class="required requiredto">Insurance Date<span class="error">&nbsp;*</span></label>
                                            <input type="date" class="form-control" id="insurancedate" name="insurancedate" placeholder="Enter the Insurance Date "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>   

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="taxdate" class="required requiredto">Tax Date<span class="error">&nbsp;*</span></label>
                                            <input type="date" class="form-control" id="taxdate" name="taxdate" placeholder="Enter the Tax Date "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>   

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="ownershiptype" class="required requiredto">Ownership Type <span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="ownershiptype" name="ownershiptype" placeholder="Enter the Ownership Type "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>
                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="fcdate" class="required requiredto">F.C Date <span class="error">&nbsp;*</span></label>
                                            <input type="date" class="form-control" id="fcdate" name="fcdate" placeholder="Enter the F.C Date "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>  
                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                          <h5 class="text-bold-600">TimeZone</h4>
                                     </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">TimeZone Minutes</label>
                                            <input type="number" class="form-control" id="timezone_minutes" name="timezone_minutes" placeholder="Enter timezone_minutes"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                          <h5 class="text-bold-600">Device Details</h4>
                                     </div>
                                     <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="vehicletype">Device IMEI</label>
                                            <select class="select2 form-control" id="deviceimei" name="deviceimei" >
                                                <option value="">Select Device IMEI</option>
                                             <?php if ($deviceimei) {
                                                foreach ($deviceimei as $dlist) {   ?>
                                                     <option value="<?php echo $dlist->deviceimei;?>"><?php echo $dlist->deviceimei;?></option>
                                                    <?php  } }?>
                                  
                                            </select>
                                        </fieldset>
                                    </div>
                                
                                    <?php if($role==14 || $role==15){?>

                                  <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="vehicletype">SIM Number</label>
                                            <select class="select2 form-control" id="simnumber" name="simnumber">
                                                <option value="">Select Simnumber</option>
                                             <?php if ($simnumber) {
                                                foreach ($simnumber as $slist) {   ?>
                                                     <option value="<?php echo $slist->simnumber;?>"><?php echo $slist->simnumber;?></option>
                                                    <?php  } }?>
                                  
                                            </select>
                                        </fieldset>
                                    </div>

                                

                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="speed_limit" class="required requiredto">Speed Limit <span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="speed_limit" name="speed_limit" placeholder="Enter Speed Limit"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>  

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="odometer">Odometer<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="odometer" name="odometer" placeholder="Enter Odometer"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>  

                                       <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Status</label>
                                            <select class="form-control" id="status" name="status">
                                               
                                                <option value="1">Active</option>
                                                <option value="2">Deactive</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1" id="instalationdate">
                                        <fieldset class="form-group">
                                            <label for="installationdate" class="required requiredto">Installed Date <span class="error">&nbsp;*</span></label>
                                            <input type="date" class="form-control" id="installationdate" name="installationdate" placeholder="Enter Installed Date "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>  

                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1" id="expire_date">
                                        <fieldset class="form-group">
                                            <label for="expiredate" class="required requiredto">Expired Date <span class="error">&nbsp;*</span></label>
                                            <input type="date" class="form-control" id="expiredate" name="expiredate" placeholder="Expired Date"><div class="div5" id="div5"></div>
                                        </fieldset>
                                </div> 

                                  <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Device Config Type</label>
                                            <select class="form-control" id="device_config_type" name="device_config_type">    
                                      <option value="0">Select Config Type</option>
                                      <option value="1">Normal GPS</option>
                                      <option value="2">CAN with SPN</option>
                                       <option value="3">CAN with GPS</option>
                                       <option value="4">OBD</option>
                                       <option value="5">OBD with GPS</option>

                                            </select>
                                        </fieldset>
                                    </div>

                                     <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Parking Alerttime</label>
                                    <select class="form-control" id="parking_alerttime" name="parking_alerttime">    
                                      <?php for($ti=1;$ti<=15;$ti++){?>
                                <option value="<?php echo $ti; ?>" <?php if($vehicle_details->parking_alerttime==$ti){  echo "selected";}elseif ($vehicle_details->parking_alerttime=='' && $ti==5) {
                                    echo "selected";
                                   }?>><?php echo $ti; ?> min</option>
                                  <?php }?>

                                            </select>
                                        </fieldset>
                                    </div>

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="expiredate" class="required requiredto">Due Amount (Rs) <span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="due_amount" name="due_amount" placeholder="Enter the Due Amount (Rs) "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                 <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="device_type">Device Type</label>
                                            <select class="form-control" id="device_type" name="device_type">
                                              
                                             <?php if ($device_types) {
                                                foreach ($device_types as $types) {   ?>
                                                     <option value="<?php echo $types->sdid;?>"><?php echo $types->devicetype;?></option>
                                                    <?php  } }?>
                                  
                                            </select>
                                        </fieldset>
                                    </div>
                                    

                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Idle Alerttime</label>
                                    <select class="form-control" id="idle_alerttime" name="idle_alerttime">    
                                      <?php for($ti=1;$ti<=15;$ti++){?>
                                <option value="<?php echo $ti; ?>" <?php if($vehicle_details->idle_alerttime==$ti){  echo "selected";}elseif ($vehicle_details->idle_alerttime=='' && $ti==5) {
                                    echo "selected";
                                   }?>><?php echo $ti; ?> min</option>
                                  <?php }?>

                                            </select>
                                        </fieldset>
                                    </div>


                                    
                                     <div class="col-xl-4 col-lg-6 col-md-12 fuel_types fuel_model ">
                                        <fieldset class="form-group">
                                            <label for="gender">Fuel Model</label>
                                        <select id="fuel_model" name="fuel_model" class="form-control" onchange ="fuel_type1()">
                                            <option value="1">Ultasonic</option>
                                            <option value="2">Jointech</option>
                                            <option value="3">Italon</option>
                                             <option value="4">Escort</option>
                                        </select>
                                        </fieldset>
                                    </div>

                                        <div class="col-xl-4 col-lg-6 col-md-12 fueltype_status">
                                        <fieldset class="form-group">
                                            <label for="gender">Fuel Type</label>
                                       <select id="fuel_type" name="fuel_type" class="form-control" required>
                                        <option value="0">Digitel</option>
                                        <option value="1">Analog</option>
                                      </select>
                                        </fieldset>
                                    </div>

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fueltype_analog">
                                        <fieldset class="form-group">
                                            <label for="fuel_a">Fuel A value<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="fuel_a" name="fuel_a" placeholder="Enter the Fuel A value"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fueltype_analog">
                                        <fieldset class="form-group">
                                            <label for="fuel_b">Fuel B value<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="fuel_b" name="fuel_b" placeholder="Enter the Fuel B value"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fueltype_analog">
                                        <fieldset class="form-group">
                                            <label for="fuel_c" >Fuel C value<span class="error">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="fuel_c" name="fuel_c" placeholder="Enter theFuel C value"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                       <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fuel_types">
                                        <fieldset class="form-group">
                                            <label for="fuel_tank_capacity" class="required requiredto">Fuel Tank Capacity<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="fuel_tank_capacity" name="fuel_tank_capacity" placeholder="Enter the Fuel Tank Capacity"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                     <div class="col-xl-4 col-lg-6 col-md-12 fuel_types fuel_tank_type">
                                        <fieldset class="form-group">
                                            <label for="gender">Fuel Tank Type</label>
                                       <select id="fuel_tank_type" name="fuel_tank_type" class="form-control" onchange ="fuel_type1()">
                                        <option value=''>- Select -</option>
                                        <option value="1">Rectangle</option>
                                        <option value="2">Cylinder</option>
                                        <option value="3">Un shape</option>
                                        <option value="4">Rectangle with curve</option>
                                      </select>
                                        </fieldset>
                                    </div>

                                  

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 tank_diameter">
                                        <fieldset class="form-group">
                                            <label for="tank_diameter" class="required">Diameter<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="tank_diameter" name="tank_diameter" placeholder="Enter the Diameter"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 


                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 tank_length">
                                        <fieldset class="form-group">
                                            <label for="tank_length" class="required">Rectangle Length<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="tank_length" name="tank_length" placeholder="Enter the Rectangle Length"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 tank_height">
                                        <fieldset class="form-group">
                                            <label for="tank_height" class="required">Rectangle Height<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="tank_height" name="tank_height" placeholder="Enter the Rectangle Height"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                    
                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1 alter_tank_width">
                                        <fieldset class="form-group">
                                            <label for="alter_tank_width" class="required">Alter Rectangle Breath<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="alter_tank_width" name="alter_tank_width" placeholder="Enter the Alter Rectangle Breath"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 
                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1 alter_tank_height">
                                        <fieldset class="form-group">
                                            <label for="alter_tank_height" class="required">Alter Rectangle Curve Height <span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="alter_tank_height" name="alter_tank_height" placeholder="Enter the Alter Rectangle Curve Height"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 
                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1 alter_tank_length">
                                        <fieldset class="form-group">
                                            <label for="tank_width" class="required">Alter Rectangle Normal Height<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="alter_tank_length" name="alter_tank_length" placeholder="Enter the Rectangle Normal Height"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                       <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fuel_types">
                                        <fieldset class="form-group">
                                            <label for="fuel_ltr" class="required requiredto">Fuel Fill min (Ltr)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="fuel_ltr" name="fuel_ltr" placeholder="Enter Fill Limit"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fuel_types">
                                        <fieldset class="form-group">
                                            <label for="fuel_dip_ltr" class="required requiredto">Fuel Dip min(Ltr)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="fuel_dip_ltr" name="fuel_dip_ltr" placeholder="Enter Dip Limit "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                      <div class="col-xl-4 col-lg-6 col-md-12 mb-1 mdvr_terminal_no">
                                        <fieldset class="form-group">
                                            <label for="mdvr_terminal_no" class="required">MDVR Terminal No<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="mdvr_terminal_no" name="mdvr_terminal_no" placeholder="Enter MDVR Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1 temperature">
                                        <fieldset class="form-group">
                                            <label for="temp_low" class="required">Temperature Low (Value)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="temp_low" name="temp_low" placeholder="Enter MDVR Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1 temperature">
                                        <fieldset class="form-group">
                                            <label for="temp_high" class="required">Temperature High (Value)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="temp_high" name="temp_high" placeholder="Enter MDVR Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                    <?php } else { ?>

                                        <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                                    <h5 class="text-bold-600">Vehicle Settings</h4>
                                              </div>

                                              <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Parking Alerttime</label>
                                    <select class="form-control" id="parking_alerttime" name="parking_alerttime">    
                                      <?php for($ti=1;$ti<=15;$ti++){?>
                                <option value="<?php echo $ti; ?>" <?php if($vehicle_details->parking_alerttime==$ti){  echo "selected";}elseif ($vehicle_details->parking_alerttime=='' && $ti==5) {
                                    echo "selected";
                                   }?>><?php echo $ti; ?> min</option>
                                  <?php }?>

                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Idle Alerttime</label>
                                    <select class="form-control" id="idle_alerttime" name="idle_alerttime">    
                                      <?php for($ti=1;$ti<=15;$ti++){?>
                                <option value="<?php echo $ti; ?>" <?php if($vehicle_details->idle_alerttime==$ti){  echo "selected";}elseif ($vehicle_details->idle_alerttime=='' && $ti==5) {
                                    echo "selected";
                                   }?>><?php echo $ti; ?> min</option>
                                  <?php }?>
                                            </select>
                                        </fieldset>
                                    </div>

                                              <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fuel_types">
                                        <fieldset class="form-group">
                                            <label for="fuel_ltr" class="required requiredto">Fuel Fill min (Ltr)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="fuel_ltr" name="fuel_ltr" placeholder="Enter Fill Limit"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                     <div class="col-xl-4 col-lg-6 col-md-12 mb-1 fuel_types">
                                        <fieldset class="form-group">
                                            <label for="fuel_dip_ltr" class="required requiredto">Fuel Dip min(Ltr)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="fuel_dip_ltr" name="fuel_dip_ltr" placeholder="Enter Dip Limit "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1 temperature">
                                        <fieldset class="form-group">
                                            <label for="temp_low" class="required">Temperature Low (Value)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="temp_low" name="temp_low" placeholder="Enter MDVR Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1 temperature">
                                        <fieldset class="form-group">
                                            <label for="temp_high" class="required">Temperature High (Value)<span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="temp_high" name="temp_high" placeholder="Enter MDVR Number "><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div> 

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="speed_limit" class="required requiredto">Speed Limit <span class="error">&nbsp;*</span></label>
                                            <input type="number" class="form-control" id="speed_limit" name="speed_limit" placeholder="Enter Speed Limit"><div class="div5" id="div5"></div>
                                        </fieldset>
                                    </div>  


                                        <?php } ?>
                                    <input type="hidden" name="vehicleid" id="vehicleid" value="">
                                  

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                       <input type="submit" class="btn btn-primary btn-min-width mr-1 btn-next btn-next1 block-page" value="Submit" id='submit'>
                                      <button type="button" class="btn btn-primary btn-min-width" id="closeform">Reset</button>
                                    </div>

                                </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        </div>


        <div class="content-body">
            <section id="configuration">
            <div class="row" >
                <div class="col-12">
                    <div class="card">
<!--                        <div class="card-header">
                            <h4 class="card-title">Configuration option</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload"><istates class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>-->
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                             
                                <div class="table-responsive">

                                <table class="table table-striped table-bordered" id="vehicle_data">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>S.No</th>  
                                            <th>Client Name </th>     
                                            <th>Client Mobile </th>                                   
                                            <th>Vehicle Name </th>
                                            <th>Vehicle Type </th>
                                            <th>Device IMEI</th>
                                            <th>Device Model</th>
                                            <th>Sim Number</th>
                                            <th>Network</th>
                                            <th>Installed Date</th>
                                            <th>Expire Date</th> 
                                            <th>status</th>
                                            <th>Actions</th>
                                          
                                        </tr>
                                    </thead>
                                </table>  
                              </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>
        </div>

      </div>
    </div>
   
    <script src="<?php echo base_url();?>assets/js/vehicledevice_type.js"></script> 


    </script>

    <!-- <script>
$(document).ready(function(){
 
  $("#vehiclename").keyup(function(){
    $("#vehiclename").css("background-color", "pink");
  });
});
</script> -->


    <script type="text/javascript">

divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {
    
        
        var table = $('#vehicle_data').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/Vehicle/get_vehicle_data",
                            "bPaginate":true,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'S No' } ,
                                    { mData: 'client_name' },
                                    { mData: 'mobile' },
                                    { mData: 'vehiclename' } ,
                                    { mData: 'vtype' },
                                    { mData: 'deviceimei' },
                                    { mData: 'device_model' } ,
                                    { mData: 'simnumber' } ,
                                    { mData: 'networkprovider' } ,
                                    { mData: 'installationdate' } ,
                                    { mData: 'expiredate' } ,

                                    { mData: 'status' },
                                    { mData: 'Action' },
                            ]
                    });   
            

    }); 
}  


         function editdata(thisid)
    {
    // $('.edit').click(function(){
        
    //    var thisid = $(this).attr('id');
    // alert(thisid);
        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('vehicle/editvehicle/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                console.log(response);
             $('.adduser').show(1000);
             $('#configuration').hide();
              var obj = JSON.parse(response);
              
                $("#vehiclename").val(obj.vehiclename);
                $("#vehiclename1").val(obj.vehiclename);
                $("#createdon").val(obj.createdon);
                $("#vehicletype").val(obj.vehicletype);
                $('#vehiclemodel').val(obj.vehiclemodel);
                $("#modelnumber").val(obj.modelnumber);
                $("#registrationnumber").val(obj.registrationnumber);    
                $("#chassisnumber").val(obj.chassisnumber);
                $("#enginenumber").val(obj.enginenumber);
                $('#insurancecompany').val(obj.insurancecompany);
                $("#insurancenumber").val(obj.insurancenumber);
                $("#insurancedate").val(obj.insurancedate);             
                $("#taxdate").val(obj.taxdate);         
                $('#ownershiptype').val(obj.ownershiptype);
                $("#fcdate").val(obj.fcdate);
                $("#documents").val(obj.documents);             
                $("#vehicleid").val(obj.vehicleid); 
                 $("#status").val(obj.status); 
                 $("#odometer").val(obj.odometer); 
                 $("#speed_limit").val(obj.speed_limit); 
                 $("#installationdate").val(obj.installationdate); 
                 $("#expiredate").val(obj.expiredate); 
                 $("#device_config_type").val(obj.device_config_type); 

                 $("#parking_alerttime").val(obj.parking_alerttime); 
                 $("#idle_alerttime").val(obj.idle_alerttime); 
                 $("#due_amount").val(obj.due_amount); 
                 $("#device_type").val(obj.device_type);  
                $("#fuel_tank_capacity").val(obj.fuel_tank_capacity); 
                $("#fuel_ltr").val(obj.fuel_ltr); 
                $("#fuel_dip_ltr").val(obj.fuel_dip_ltr); 
                $("#fuel_a").val(obj.fuel_a); 
                $("#fuel_b").val(obj.fuel_b); 
                $("#fuel_c").val(obj.fuel_c);  
                 $("#fuel_model").val(obj.fuel_model);
                  $("#fuel_tank_type").val(obj.fuel_tank_type);
                  $("#tank_diameter").val(obj.tank_diameter);
                 $("#tank_length").val(obj.tank_length);
                 $("#tank_width").val(obj.tank_width);
                $("#tank_height").val(obj.tank_height);
                $("#alter_tank_width").val(obj.alter_tank_width);
                $("#alter_tank_height").val(obj.alter_tank_height);
                $("#alter_tank_length").val(obj.alter_tank_length);
                 $("#mdvr_terminal_no").val(obj.mdvr_terminal_no);
                 $("#temp_low").val(obj.temp_low);
                 $("#temp_high").val(obj.temp_high);
                 $("#timezone_minutes").val(obj.timezone_minutes);

                // alert(obj.client_id);
              //  $("#client_id").val(obj.client_id);
            //  $("#client_id").select2().select2('val',obj.client_id);
              $('#client_id').val(obj.client_id);
            $('#client_id').select2().trigger('change');


                // $("#simnumber").select2("val", obj.simnumber);
               // $("#vehicletype").select2("val", obj.vehicletype);

                $('#deviceimei').append("<option value='"+ obj.deviceimei +"'>" +obj.deviceimei+"</option>");
                $('#simnumber').append("<option value='"+ obj.simnumber +"'>" +obj.simnumber+"</option>");
                // $("#deviceimei").select2("val", obj.deviceimei);
                 $("#simnumber").val(obj.simnumber); 
                 $("#deviceimei").val(obj.deviceimei); 
                  

                var device_type=obj.device_type;
                var fuel_tank_type = obj.fuel_tank_type;
                  var fuel_model = obj.fuel_model;
              
                  if (device_type=='0' || device_type=='2' || device_type=='7' || device_type=='17' || device_type=='18') 
           {
                //  $(".fuel_types").hide();  
                //  $(".fueltype_analog").hide(); 
                //   $(".mdvr_terminal_no").hide();
                //   $(".temperature").hide();

                  $(".fuel_types").hide();
                   $(".fueltype_status").hide();  
                   $(".fueltype_analog").hide(); 
                   $(".mdvr_terminal_no").hide();


                  $('.tank_diameter').hide();
                  $('.tank_length').hide();
                  $('.tank_width').hide();
                  $('.tank_height').hide();
                  $(".alter_tank_width").hide();
                  $(".alter_tank_height").hide();
                  $(".alter_tank_length").hide();
                  $(".temperature").hide();
             }

             if (device_type=='1' || device_type=='3' ||device_type=='9'  ||  device_type=='10' || device_type=='11') 
           // alert(device_type);
             {
                 $(".fuel_types").show();  
                 $(".fueltype_analog").hide(); 
                 $(".mdvr_terminal_no").hide();
                 $(".fuel_types").hide();
                   $(".fueltype_status").hide();  
                   $(".fueltype_analog").hide(); 
                   $(".mdvr_terminal_no").hide();


                  $('.tank_diameter').hide();
                  $('.tank_length').hide();
                  $('.tank_width').hide();
                  $('.tank_height').hide();
                  $(".alter_tank_width").hide();
                  $(".alter_tank_height").hide();
                  $(".alter_tank_length").hide();
                 $(".temperature").hide();
                  
             }

             if (device_type=='14' || device_type=='15') 
             // alert(device_type);
               {
          $('.tank_diameter').hide();
         $('.tank_length').hide();
          $('.tank_width').hide();
          $('.tank_height').hide();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();
         $(".fuel_types").show();  
         $(".fueltype_analog").show(); 
          $(".fueltype_status").show();
          $(".temperature").hide();
             }
        

        

             if (device_type=='5') 

             {
                $(".fuel_types").hide();  
                $(".fueltype_analog").hide(); 
                 $(".mdvr_terminal_no").show();
                 $(".temperature").hide();

             }
             if (device_type=='6' || device_type=='7' || device_type=='13') 

             {
                 $(".fuel_types").show();  
                 $(".fueltype_analog").hide(); 
                 $(".mdvr_terminal_no").show();
                 $(".temperature").hide();

             }

             if (device_type=='8' || device_type=='16') 

             {
                fuel_model = '';
             
                   $(".fuel_types").hide();
                   $(".fueltype_status").hide();  
                   $(".fueltype_analog").hide(); 
                 
                $(".temperature").show();

             }



    
    // alert(fuel_model);
      
    if(fuel_model=='1')
    {
      if(fuel_tank_type ==''){
          $('.tank_diameter').hide();
          $('.tank_length').hide();
          $('.tank_width').hide();
          $('.tank_height').hide();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();


          


      }else if(fuel_tank_type =='1'){
          $('.tank_diameter').hide();
          $('.tank_length').show();
          $('.tank_width').show();
          $('.tank_height').show();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();

        

      }else if(fuel_tank_type =='2'){// alert();
          $('.tank_diameter').show();
          $('.tank_length').show();
          $('.tank_width').show();
          $('.tank_height').show();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();
      }else if(fuel_tank_type =='3'){
          $('.tank_diameter').hide();
          $('.tank_length').hide();
          $('.tank_width').hide();
          $('.tank_height').hide();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();
      }
       else if(fuel_tank_type =='4'){
          $('.tank_diameter').hide();
          $('.tank_length').show();
          $('.tank_width').show();
          $('.tank_height').show();
           $(".alter_tank_width").show();
          $(".alter_tank_height").show();
           $(".alter_tank_length").hide();
      }

         $(".fueltype_analog").hide(); 
          $(".fueltype_status").hide();



    }
    else if(fuel_model=='2')
    {
      $('.tank_diameter').hide();
       $('.tank_length').hide();
          $('.tank_width').hide();
          $('.tank_height').hide();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();

          $(".fueltype_analog").hide(); 
          $(".fueltype_status").hide();

            
    }

      else if(fuel_model=='3')
    {
       // alert('hi');
      $('.tank_diameter').hide();
       $('.tank_length').hide();
          $('.tank_width').hide();
          $('.tank_height').hide();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();
         $(".fueltype_analog").show(); 
          $(".fueltype_status").show();
    }
    else if(fuel_model=='4')
    {
         $('.tank_diameter').hide();
         $('.tank_length').hide();
          $('.tank_width').hide();
          $('.tank_height').hide();
          $(".alter_tank_width").hide();
         $(".alter_tank_height").hide();
         $(".alter_tank_length").hide();
         $(".fueltype_analog").show(); 
          $(".fueltype_status").show();
    }

    


 
          },
            error: function(){
            console.log('Error While Request User Edit List..');
            }

        });
}

    $(document).ready(function () {
             
  $("#vehicleform").submit(function(e) {
          
              var vehicleid= $('#vehicleid').val();   
              e.preventDefault(); 
              var form = $(this);
           //  console.log(form.serialize());
            if(vehicleid!='')
            {         
                  //alert(simnumber); 
                  var url = '<?php echo site_url('vehicle/updatevehicle');?>';
                  $.ajax({
                       type: "POST",
                       url: url,
                       data: form.serialize(), // serializes the form's elements.
                       success: function(data)
                       {
                        // console.log(data);    
                        $.unblockUI();

                         if(data==1)
                         {
                          toastr.success("Data Updated Successfully!","UPDATE",{progressBar:!0});
                           }
                    //    alert(data);
                              $('.adduser').hide();  //Add userpage hide
                              $('#configuration').show();
                              divlightbox();
                       }
                     }); 
            }
            else
            {     
                var url = '<?php echo site_url('vehicle/addvehicle');?>';
                // alert(url);
                $.ajax({
                       type: "POST",
                       url: url,
                       data: form.serialize(), // serializes the form's elements.
                       success: function(data)
                       {
                        //    alert(data);
                           $.unblockUI();

                         if(data==1)
                         {
                         toastr.success("Data Updated Successfully!","UPDATE",{progressBar:!0});
                          }
                           else
                        {
                         toastr.success("Data Insert Successfully!","INSERT",{progressBar:!0});
                          }

                          $('.adduser').hide();  //Add userpage hide
                          $('#configuration').show();
                          divlightbox();
                       }
                     }); 

               }
                          
 });



 // $(document).ready(function(){   

   
    // });



     $("#showuser").click(function(){
        $('#vehicleform')[0].reset();
        $('#vehicleid').val("");
        $('#instalationdate').hide();
        $('#expire_date').hide();
     $('.adduser').show(2000);  //Add userpage hide
       $('#configuration').hide();// hide view page
     });
        $("#closeform").click(function(){

      location.reload(); 
     });
        
         });


function deletedata(thisid)
{
        // alert(thisid);
          if(confirm("Are you sure you want to delete this?")){

        $.ajax({
            type:"POST",
            datatype:"json",
            url:"<?php echo site_url('vehicle/deletevehicle/');?>",
            data: {
                thisid: thisid
            },
            success: function (response) {
                //alert(response);
                toastr.warning("Data Deleted Successfully","Progress Bar",{progressBar:!0});
                divlightbox();
                 $('#configuration').show();
            },
            error: function(){
            alert('Error While Request User Delete List..');
            }

        });
    }
    else
    {
        return false;
    }
   }




    </script>