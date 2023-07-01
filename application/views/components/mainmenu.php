<?php $role = $this->session->userdata('roleid');
 $dealer_color = $this->session->userdata('dealer_color');
 $client_id = $this->session->userdata('client_id');

// echo $role;exit;

if($role == '14') { ?>
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
           
           <li class=" nav-item"><a href="#"><i class="fa fa-bars" aria-hidden="true"></i><span class="menu-title" data-i18n="Clients">Dashboard</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>Dashboard" data-i18n="Dealers"><i class="fa fa-circle-o"></i> Dashboard</a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>Livetrack" data-i18n="Livetrack"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            </ul>
         </li>

            

         <li class=" nav-item"><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="menu-title" data-i18n="Clients">Customers</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>client" data-i18n="Clients"><i class="fa fa-circle-o"></i>School</a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>Dealer/dealerdetails" data-i18n="dealer"><i class="fa fa-circle-o"></i>Dealers</a></li>
            </ul>
         </li>

              <li class=" nav-item"><a href="#"><i class="fa fa-clock"></i><span class="menu-title" data-i18n="Status Check">Time Zone </span>
       </a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>Timezone/timezone_details" data-i18n="Location Status"><i class="fa fa-circle-o"></i> Time Zone</a></li>
            </ul>
    </li>

      <li class=" nav-item"><a href="#"><i class="fa fa-eye"></i><span class="menu-title" data-i18n="Access priviledge">Access Priviledge</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>accesspriviledge" data-i18n="Access priviledge"><i class="fa fa-circle-o"></i> School Priviledge</a></li>
            </ul>
      </li>


      <li class=" nav-item"><a href="#"><i class="fa fa-database"></i><span class="menu-title" data-i18n="Stocks">Stocks </span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>sim" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Stock SIM Details </a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>device" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Stock Device Details</a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>sim/simassign" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Sim Assign</a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>device/deviceassign" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Device Assign</a></li>
            </ul>
      </li>


      <li class=" nav-item"><a href="#"><i class="fa fa-bus"></i><span class="menu-title" data-i18n="Vehicle Management">Vehicle Management </span>
       </a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>vehicle" data-i18n="Vehicle"><i class="fa fa-circle-o"></i> Vehicle</a></li>
            </ul>
      </li>

    <li class=" nav-item"><a href="#"><i class="fa fa-check"></i><span class="menu-title" data-i18n="Status Check">Status Check </span>
       </a>
            <ul class="menu-content">
          
            <li><a class="menu-item" href="<?php echo site_url();?>Statuscheck/" data-i18n="Location Status"><i class="fa fa-circle-o"></i> Location Status</a></li>
            
            <!-- <li><a class="menu-item" href="<?php echo site_url();?>Statuscheck/fuel_status" data-i18n="Fuel Status"><i class="fa fa-circle-o"></i> Fuel Status</a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>Statuscheck/location_status_view" data-i18n="Location Status"><i class="fa fa-circle-o"></i> Location Status</a></li> -->
           
            </ul>
    </li>

        </ul>

      
      </div>
    </div>

    <?php }  ?>




    <?php 

if($role == '15') {  ?>
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" style=" z-index:99999">
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
           
        <li class=" nav-item"><a href="#"><i class="fa fa-bars" aria-hidden="true"></i><span class="menu-title" data-i18n="Clients">Dashboard</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>Dashboard" data-i18n="Dealers"><i class="fa fa-circle-o"></i> Dashboard</a></li>
             
              <?php 
              if($this->session->userdata('timezone_hours')=='330')
              $country='india';
              elseif($this->session->userdata('timezone_hours')=='180')
              $country='qatar';
              ?>
              <li><a class="menu-item" href="<?php echo site_url('Livetrack/livetrack_vehicles/'.$country);?>" data-i18n="Livetrack"><i class="fa fa-circle-o"></i>Livetrack Dashboard</a></li>
             
            </ul>
         </li>
      <li class=" nav-item"><a href="#"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Geofence">Geofence</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>geofence" data-i18n="Geofence"><i class="fa fa-circle-o"></i> Geofence</a></li>
               <!-- <li><a class="menu-item" href="<?php echo site_url();?>geofence/assign_geofence" data-i18n="Assign Geofence"><i class="fa fa-circle-o"></i>Assign Geofence</a></li> -->
            </ul>
      </li>
     <li class=" nav-item"><a href="#"><i class="fas fa-route"></i><span class="menu-title" data-i18n="Route Report">Route Report</span>
       </a>
            <ul class="menu-content">
        <li><a class="menu-item" href="<?php echo site_url();?>route" data-i18n="Routes"><i class="fa fa-circle-o"></i>Routes</a></li>
        <li><a class="menu-item" href="<?php echo site_url();?>route/route_assign" data-i18n="Routes Assign"><i class="fa fa-circle-o"></i>Routes Assign</a></li>
            </ul>
      </li>
     <li class=" nav-item"><a href="#"><i class="fas fa-route"></i><span class="menu-title" data-i18n="School Details">School Details</span>
       </a>
            <ul class="menu-content">
        <li><a class="menu-item" href="<?php echo site_url();?>parents" data-i18n="Routes"><i class="fa fa-circle-o"></i>Parent Details</a></li>
        <li><a class="menu-item" href="<?php echo site_url();?>school_class" data-i18n="Class"><i class="fa fa-circle-o"></i>Class</a></li>
        <li><a class="menu-item" href="<?php echo site_url();?>Section" data-i18n="Section"><i class="fa fa-circle-o"></i>Section</a></li>
        <li><a class="menu-item" href="<?php echo site_url();?>Student" data-i18n="Student"><i class="fa fa-circle-o"></i>Student</a></li>
            </ul>
      </li>
      
      <li class=" nav-item"><a href="#"><i class="fa fa-bus"></i><span class="menu-title" data-i18n="Vehicle Management">Vehicle Management </span>
       </a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>vehicle" data-i18n="Vehicle"><i class="fa fa-circle-o"></i> Vehicle</a></li>
            </ul>
      </li>

        </ul>
      </div>
    </div>
    <?php } ?>


    <?php 

if($role == '17') {  ?>
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" style=" z-index:99999">
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
           
           <li class=" nav-item"><a href="<?php echo site_url();?>Dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i>
              <span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
          </li>         

      <li class=" nav-item"><a href="#"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Clients">Customers</span></a>
            <ul class="menu-content">
              <!-- <li><a class="menu-item" href="<?php echo site_url();?>subdealer" data-i18n="Dealers"><i class="fa fa-circle-o"></i> Dealers</a></li> -->
               <li><a class="menu-item" href="<?php echo site_url();?>client" data-i18n="Client"><i class="fa fa-circle-o"></i>School</a></li>
            </ul>
      </li>

      <!-- <li class=" nav-item"><a href="#"><i class="fa fa-eye"></i><span class="menu-title" data-i18n="Access priviledge">Access Priviledge</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>accesspriviledge" data-i18n="Access priviledge"><i class="fa fa-circle-o"></i> Access Priviledge</a></li>
            </ul>
      </li>


      <li class=" nav-item"><a href="#"><i class="fa fa-bullhorn"></i><span class="menu-title" data-i18n="SMS Notification">SMS Notification </span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>sms_send" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i>SMS Notification</a></li>
            </ul>
      </li> -->


      <li class=" nav-item"><a href="#"><i class="fa fa-database"></i><span class="menu-title" data-i18n="Stocks">Stocks </span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>sim" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Stock SIM Details </a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>device" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Stock Device Details</a></li>
            
                <!-- <li><a class="menu-item" href="<?php echo site_url();?>sim/simassign" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Sim Assign</a></li>
             <li><a class="menu-item" href="<?php echo site_url();?>device/deviceassign" data-i18n="SMS Notification"><i class="fa fa-circle-o"></i> Device Assign</a></li> -->

            </ul>
      </li>


      <li class=" nav-item"><a href="#"><i class="fa fa-bus"></i><span class="menu-title" data-i18n="Vehicle Management">Vehicle Management </span>
       </a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?php echo site_url();?>vehicle" data-i18n="Vehicle"><i class="fa fa-circle-o"></i> Vehicle</a></li>
          
         
            </ul>
      </li>

    <li class=" nav-item"><a href="#"><i class="fa fa-check"></i><span class="menu-title" data-i18n="Status Check">Status Check </span>
       </a>
            <ul class="menu-content">
              <!-- <li><a class="menu-item" href="<?php echo site_url();?>sim" data-i18n="Fuel Status"><i class="fa fa-circle-o"></i> Fuel Status</a></li> -->
              <li><a class="menu-item" href="<?php echo site_url();?>device" data-i18n="Location Status"><i class="fa fa-circle-o"></i> Location Status</a></li>
              <!-- <li><a class="menu-item" href="<?php echo site_url();?>model" data-i18n="iButton Status"><i class="fa fa-circle-o"></i> iButton Status</a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>model" data-i18n="Switch Status"><i class="fa fa-circle-o"></i> Switch Status</a></li>
              <li><a class="menu-item" href="<?php echo site_url();?>model" data-i18n="Battery Status"><i class="fa fa-circle-o"></i> Battery Status</a></li> -->
            </ul>
    </li>

        </ul>

      
      
      </div>
    </div>
    <?php } ?>

