<style>
/*    .defaultclr {
  background-color : #ffffff;
  cursor:pointer;
}

.background_selected {
  background-color : #fec213;
}*/
tr.highlighted td {
    background: #fec213;
}
    </style>
<div class="sidebar-left" style="margin-top: 20px;">
    <div class="sidebar">
        <div class="sidebar-content email-app-sidebar d-flex1" style="width: 350px !important">
            <!-- <span class="sidebar-close-icon">
                <i class="feather icon-x"></i>
            </span> -->
            <!-- sidebar close icon -->
            <div class="email-app-menu">
               
                
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card land-leftbtm">
                        <div class="card-content">
                            <div class="card-body1">
                                <ul class="nav nav-tabs nav-topline" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="base-tab21" data-toggle="tab" aria-controls="tab21" href="#tab21" role="tab" aria-selected="true">All Vehicle</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab22" data-toggle="tab" aria-controls="tab22" href="#tab22" role="tab" aria-selected="false">Moving</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab23" data-toggle="tab" aria-controls="tab23" href="#tab23" role="tab" aria-selected="false">Idle</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab24" data-toggle="tab" aria-controls="tab24" href="#tab24" role="tab" aria-selected="false">Parking</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab25" data-toggle="tab" aria-controls="tab25" href="#tab25" role="tab" aria-selected="false" title="Out of Coverage">OOC</a>
                                    </li>
                                </ul>
                                <div class="tab-content border-grey border-lighten-2 border-0-top">
                                    <div class="tab-pane active" id="tab21" role="tabpanel" aria-labelledby="base-tab21">
                                        <div class="">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div id="daily-activity" class="table-responsive" style="height: 485px;">
                                                           <table id="data" class="table table-hover mb-0" style="color: black"_id="table1">
                                                            <thead>
                                                                 <th class='tdth'>
                                                                        <input type="hidden" id="icheck-input-all " class="allcheckbox" value="all">
                                                                         <input type="hidden" id="pre_lat" value=""/>
                                                                         <input type="hidden" id="pre_lng" value=""/>
                                                                          <input type="hidden" id="pre_angle" value=""/>
                                                                    </th>
                                                              <th class='tdth'></th>
                                                                  <th class='tdth'><?php echo $this->lang->line('vehiclename'); ?> 
                                                                  </th>
                                                                  <!--<th>Last Updated</th>-->
                                                                  <!--<th>Duration (H:M:S)</th>-->
                                                            </thead>
                                                            <tbody>
                                                              

                                                          <?php
                                                            if(isset($vehicle_details)){


                                                              $first_vid = $vehicle_details['0']->vehicleid; // onload first vehicle id
                                                              $first_vehicle = $vehicle_details['0']->vehiclename; 
                                                            foreach($vehicle_details as $list){
                                                          ?>
                                        
                                                           
                                                                  <tr class="tr-a vid_val" id="vid_<?=$list->vehicleid;?>" onclick="selectone('<?php echo $list->vehicleid;?>', '<?php echo $list->vehiclename;?>');" >
                                                          
                                                          <input type="hidden" id="selected_vid" value=""/>
                                                          <input type="hidden" id="selected_vname" value=""/>
                                                            <!--values to access in jquery-->
                                                            <input type="hidden" class="vid" id="vid_<?=$list->vehicleid;?>" name="vid_<?=$list->vehicleid;?>" value="<?=$list->vehicleid;?>" />
                                                            <input type="hidden" id="vft_<?=$list->vehicleid;?>" name="vft_<?=$list->vehicleid;?>" value="<?=$list->fuel_ltr;?>" />
                                                            <input type="hidden" id="vf_<?=$list->vehicleid;?>" name="vf_<?=$list->vehicleid;?>" value="<?=$list->fuel_tank_capacity;?>" />
                                                            <input type="hidden" id="vsp_<?=$list->vehicleid;?>" name="vsp_<?=$list->vehicleid;?>" value="<?=$list->speed;?>" />
                                                            <input type="hidden" id="vac_<?=$list->vehicleid;?>" name="vac_<?=$list->vehicleid;?>" value="<?=$list->ac_flag;?>" />
                                                            <input type="hidden" id="vno_<?=$list->vehicleid;?>" name="vno_<?=$list->vehicleid;?>" value="<?=$list->vehiclename;?>" />
                                                            <input type="hidden" id="vs_<?=$list->vehicleid;?>" name="vs_<?=$list->vehicleid;?>" value="<?=$list->acc_on;?>" />
                                                            <input type="hidden" id="vkm_<?=$list->vehicleid;?>" name="vkm_<?=$list->vehicleid;?>" value="<?=$list->odometer;?>" />
                                                            <input type="hidden" id="vodo_<?=$list->vehicleid;?>" name="vodo_<?=$list->vehicleid;?>" value="<?=$list->ac_km;?>" />
                                                            <input type="hidden" id="vtemp_<?=$list->vehicleid;?>" name="vtemp_<?=$list->vehicleid;?>" value="<?=$list->temperature;?>" />
                                                            <td class="tdth text-truncate" >
                                                    <input type="hidden" id="single_<?php echo $list->vehicleid;?>" name="singlecheckbox" class="singlecheckbox" value="<?= $list->vehicleid;?>" disabled>
                                                                    </td>
                                                                <td class="tdth text-center status_running" id="vehic_status<?=$list->vehicleid;?>"> </td>
                                                          
                                                                <td style='text-align: left !important;font-size: 12px;' class="tdth text-center">
                                                                    <p id="vehic_reg<?=$list->vehicleid;?>" style='margin-bottom:0px'></p>
                                                                    <small id="vehic_upt<?=$list->vehicleid;?>"></small>
                                                                    <!--<p id="parker_status<?=$list->vehicleid;?>" style='margin-bottom:-5px'></p>-->
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                                                                                <div class="btn-group" role="group">
                                                                                    <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style='font-size: 10px;'>
                                                                                        <a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style='padding-left: 10px;'><i class='fa fa-play'></i>&nbsp;Playback</a>
                                                                                        <a class="dropdown-item" href="component-buttons-extended.html" style='padding-left: 10px;'><i class='fa fa-share-alt'></i>&nbsp; Share position</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </td>
                                                                <!-- <td><?=$list->vehicle_register_number;?></td> -->

                                                                <!--<td class="text-center" ></td>-->
                                                          
                                                                <!--<td class="text-center"></td>-->
                                                                  </tr>
                                                                  
                                                    
                                                                  <?php }}?>
                                                            </tbody>
                                                          </table>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab22" role="tabpanel" aria-labelledby="base-tab22">
                                        
                                           <div class="">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div id="daily-activity" class="table-responsive" style="height: 485px;">
                                                           <!-- <table id="data" class="table table-hover mb-0" style="color: black"_id="table1"> -->
                                                           <table id="data" class="table table-hover mb-0" style="color: black"_id="table1">
                                                            <thead>
                                                                 <th class='tdth'>
                                                                        <input type="hidden" id="icheck-input-all " class="allcheckbox" value="all">
                                                                         <input type="hidden" id="pre_lat" value=""/>
                                                                         <input type="hidden" id="pre_lng" value=""/>
                                                                          <input type="hidden" id="pre_angle" value=""/>
                                                                    </th>
                                                              <th class='tdth'></th>
                                                                  <th class='tdth'><?php echo $this->lang->line('vehiclename'); ?> 
                                                                  </th>
                                                                  <!--<th>Last Updated</th>-->
                                                                  <!--<th>Duration (H:M:S)</th>-->
                                                            </thead>
                                                            <tbody>
                                                              

                                                          <?php
                                                            if(isset($moving_vehicle)){


                                                              $first_mid = $moving_vehicle['0']->vehicleid; // onload first vehicle id
                                                              $first_mvehicle = $moving_vehicle['0']->vehiclename; 
                                                            foreach($moving_vehicle as $list){
                                                          ?>
                                        
                                                           
                                                                  <tr class="tr-a vid_val" id="vid_<?=$list->vehicleid;?>" onclick="selectone('<?php echo $list->vehicleid;?>', '<?php echo $list->vehiclename;?>');" >
                                                          
                                                          <input type="hidden" id="selected_vid" value=""/>
                                                          <input type="hidden" id="selected_vname" value=""/>
                                                            <!--values to access in jquery-->
                                                            <input type="hidden" class="vid" id="vid_<?=$list->vehicleid;?>" name="vid_<?=$list->vehicleid;?>" value="<?=$list->vehicleid;?>" />
                                                            <input type="hidden" id="vft_<?=$list->vehicleid;?>" name="vft_<?=$list->vehicleid;?>" value="<?=$list->fuel_ltr;?>" />
                                                            <input type="hidden" id="vf_<?=$list->vehicleid;?>" name="vf_<?=$list->vehicleid;?>" value="<?=$list->fuel_tank_capacity;?>" />
                                                            <input type="hidden" id="vsp_<?=$list->vehicleid;?>" name="vsp_<?=$list->vehicleid;?>" value="<?=$list->speed;?>" />
                                                            <input type="hidden" id="vac_<?=$list->vehicleid;?>" name="vac_<?=$list->vehicleid;?>" value="<?=$list->ac_flag;?>" />
                                                            <input type="hidden" id="vno_<?=$list->vehicleid;?>" name="vno_<?=$list->vehicleid;?>" value="<?=$list->vehiclename;?>" />
                                                            <input type="hidden" id="vs_<?=$list->vehicleid;?>" name="vs_<?=$list->vehicleid;?>" value="<?=$list->acc_on;?>" />
                                                            <input type="hidden" id="vkm_<?=$list->vehicleid;?>" name="vkm_<?=$list->vehicleid;?>" value="<?=$list->odometer;?>" />
                                                            <input type="hidden" id="vodo_<?=$list->vehicleid;?>" name="vodo_<?=$list->vehicleid;?>" value="<?=$list->ac_km;?>" />
                                                            <input type="hidden" id="vtemp_<?=$list->vehicleid;?>" name="vtemp_<?=$list->vehicleid;?>" value="<?=$list->temperature;?>" />
                                                            <td class="tdth text-truncate" >
                                                    <input type="hidden" id="single_<?php echo $list->vehicleid;?>" name="singlecheckbox" class="singlecheckbox" value="<?= $list->vehicleid;?>" disabled>
                                                                    </td>
                                                                <td class="tdth text-center status_running" id="vehic_status1<?=$list->vehicleid;?>"> </td>
                                                          
                                                                <td style='text-align: left !important;font-size: 12px;' class="tdth text-center">
                                                                    <p id="vehic_reg1<?=$list->vehicleid;?>" style='margin-bottom:0px'></p>
                                                                    <small id="vehic_upt1<?=$list->vehicleid;?>"></small>
                                                                    <!--<p id="parker_status<?=$list->vehicleid;?>" style='margin-bottom:-5px'></p>-->
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                                                                                <div class="btn-group" role="group">
                                                                                    <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style='font-size: 10px;'>
                                                                                        <a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style='padding-left: 10px;'><i class='fa fa-play'></i>&nbsp;Playback</a>
                                                                                        <a class="dropdown-item" href="component-buttons-extended.html" style='padding-left: 10px;'><i class='fa fa-share-alt'></i>&nbsp; Share position</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </td>
                                                                <!-- <td><?=$list->vehicle_register_number;?></td> -->

                                                                <!--<td class="text-center" ></td>-->
                                                          
                                                                <!--<td class="text-center"></td>-->
                                                                  </tr>
                                                                  
                                                    
                                                                  <?php }}?>
                                                            </tbody>
                                                          </table>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab23" role="tabpanel" aria-labelledby="base-tab23">
                                    
                                       <div class="">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div id="daily-activity" class="table-responsive" style="height: 485px;">
                                                           <table id="data" class="table table-hover mb-0" style="color: black"_id="table1">
                                                            <thead>
                                                                 <th class='tdth'>
                                                                        <input type="hidden" id="icheck-input-all " class="allcheckbox" value="all">
                                                                         <input type="hidden" id="pre_lat" value=""/>
                                                                         <input type="hidden" id="pre_lng" value=""/>
                                                                          <input type="hidden" id="pre_angle" value=""/>
                                                                    </th>
                                                              <th class='tdth'></th>
                                                                  <th class='tdth'><?php echo $this->lang->line('vehiclename'); ?> 
                                                                  </th>
                                                                  <!--<th>Last Updated</th>-->
                                                                  <!--<th>Duration (H:M:S)</th>-->
                                                            </thead>
                                                            <tbody>
                                                              

                                                          <?php
                                                            if(isset($idle_vehicle)){


                                                              $first_iid = $idle_vehicle['0']->vehicleid; // onload first vehicle id
                                                              $first_ivehicle = $idle_vehicle['0']->vehiclename; 
                                                            foreach($idle_vehicle as $list){
                                                          ?>
                                        
                                                           
                                                                  <tr class="tr-a vid_val" id="vid_<?=$list->vehicleid;?>" onclick="selectone('<?php echo $list->vehicleid;?>', '<?php echo $list->vehiclename;?>');" >
                                                          
                                                          <input type="hidden" id="selected_vid" value=""/>
                                                          <input type="hidden" id="selected_vname" value=""/>
                                                            <!--values to access in jquery-->
                                                            <input type="hidden" class="vid" id="vid_<?=$list->vehicleid;?>" name="vid_<?=$list->vehicleid;?>" value="<?=$list->vehicleid;?>" />
                                                            <input type="hidden" id="vft_<?=$list->vehicleid;?>" name="vft_<?=$list->vehicleid;?>" value="<?=$list->fuel_ltr;?>" />
                                                            <input type="hidden" id="vf_<?=$list->vehicleid;?>" name="vf_<?=$list->vehicleid;?>" value="<?=$list->fuel_tank_capacity;?>" />
                                                            <input type="hidden" id="vsp_<?=$list->vehicleid;?>" name="vsp_<?=$list->vehicleid;?>" value="<?=$list->speed;?>" />
                                                            <input type="hidden" id="vac_<?=$list->vehicleid;?>" name="vac_<?=$list->vehicleid;?>" value="<?=$list->ac_flag;?>" />
                                                            <input type="hidden" id="vno_<?=$list->vehicleid;?>" name="vno_<?=$list->vehicleid;?>" value="<?=$list->vehiclename;?>" />
                                                            <input type="hidden" id="vs_<?=$list->vehicleid;?>" name="vs_<?=$list->vehicleid;?>" value="<?=$list->acc_on;?>" />
                                                            <input type="hidden" id="vkm_<?=$list->vehicleid;?>" name="vkm_<?=$list->vehicleid;?>" value="<?=$list->odometer;?>" />
                                                            <input type="hidden" id="vodo_<?=$list->vehicleid;?>" name="vodo_<?=$list->vehicleid;?>" value="<?=$list->ac_km;?>" />
                                                            <input type="hidden" id="vtemp_<?=$list->vehicleid;?>" name="vtemp_<?=$list->vehicleid;?>" value="<?=$list->temperature;?>" />
                                                            <td class="tdth text-truncate" >
                                                    <input type="hidden" id="single_<?php echo $list->vehicleid;?>" name="singlecheckbox" class="singlecheckbox" value="<?= $list->vehicleid;?>" disabled>
                                                                    </td>
                                                                <td class="tdth text-center status_running" id="vehic_status2<?=$list->vehicleid;?>"> </td>
                                                          
                                                                <td style='text-align: left !important;font-size: 12px;' class="tdth text-center">
                                                                    <p id="vehic_reg2<?=$list->vehicleid;?>" style='margin-bottom:0px'></p>
                                                                    <small id="vehic_upt2<?=$list->vehicleid;?>"></small>
                                                                    <!--<p id="parker_status<?=$list->vehicleid;?>" style='margin-bottom:-5px'></p>-->
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                                                                                <div class="btn-group" role="group">
                                                                                    <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style='font-size: 10px;'>
                                                                                        <a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style='padding-left: 10px;'><i class='fa fa-play'></i>&nbsp;Playback</a>
                                                                                        <a class="dropdown-item" href="component-buttons-extended.html" style='padding-left: 10px;'><i class='fa fa-share-alt'></i>&nbsp; Share position</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </td>
                                                                <!-- <td><?=$list->vehicle_register_number;?></td> -->

                                                                <!--<td class="text-center" ></td>-->
                                                          
                                                                <!--<td class="text-center"></td>-->
                                                                  </tr>
                                                                  
                                                    
                                                                  <?php }}?>
                                                            </tbody>
                                                          </table>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab24" role="tabpanel" aria-labelledby="base-tab24">
                                      
                                         <div class="">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div id="daily-activity" class="table-responsive" style="height: 485px;">
                                                           <table id="data" class="table table-hover mb-0" style="color: black"_id="table1">
                                                            <thead>
                                                                 <th class='tdth'>
                                                                        <input type="hidden" id="icheck-input-all " class="allcheckbox" value="all">
                                                                         <input type="hidden" id="pre_lat" value=""/>
                                                                         <input type="hidden" id="pre_lng" value=""/>
                                                                          <input type="hidden" id="pre_angle" value=""/>
                                                                    </th>
                                                              <th class='tdth'></th>
                                                                  <th class='tdth'><?php echo $this->lang->line('vehiclename'); ?> 
                                                                  </th>
                                                                  <!--<th>Last Updated</th>-->
                                                                  <!--<th>Duration (H:M:S)</th>-->
                                                            </thead>
                                                            <tbody>
                                                              

                                                          <?php
                                                            if(isset($parking_vehicle)){


                                                              $first_pid = $parking_vehicle['0']->vehicleid; // onload first vehicle id
                                                              $first_pvehicle = $parking_vehicle['0']->vehiclename; 
                                                            foreach($parking_vehicle as $list){
                                                          ?>
                                        
                                                           
                                                                  <tr class="tr-a vid_val" id="vid_<?=$list->vehicleid;?>" onclick="selectone('<?php echo $list->vehicleid;?>', '<?php echo $list->vehiclename;?>');" >
                                                          
                                                          <input type="hidden" id="selected_vid" value=""/>
                                                          <input type="hidden" id="selected_vname" value=""/>
                                                            <!--values to access in jquery-->
                                                            <input type="hidden" class="vid" id="vid_<?=$list->vehicleid;?>" name="vid_<?=$list->vehicleid;?>" value="<?=$list->vehicleid;?>" />
                                                            <input type="hidden" id="vft_<?=$list->vehicleid;?>" name="vft_<?=$list->vehicleid;?>" value="<?=$list->fuel_ltr;?>" />
                                                            <input type="hidden" id="vf_<?=$list->vehicleid;?>" name="vf_<?=$list->vehicleid;?>" value="<?=$list->fuel_tank_capacity;?>" />
                                                            <input type="hidden" id="vsp_<?=$list->vehicleid;?>" name="vsp_<?=$list->vehicleid;?>" value="<?=$list->speed;?>" />
                                                            <input type="hidden" id="vac_<?=$list->vehicleid;?>" name="vac_<?=$list->vehicleid;?>" value="<?=$list->ac_flag;?>" />
                                                            <input type="hidden" id="vno_<?=$list->vehicleid;?>" name="vno_<?=$list->vehicleid;?>" value="<?=$list->vehiclename;?>" />
                                                            <input type="hidden" id="vs_<?=$list->vehicleid;?>" name="vs_<?=$list->vehicleid;?>" value="<?=$list->acc_on;?>" />
                                                            <input type="hidden" id="vkm_<?=$list->vehicleid;?>" name="vkm_<?=$list->vehicleid;?>" value="<?=$list->odometer;?>" />
                                                            <input type="hidden" id="vodo_<?=$list->vehicleid;?>" name="vodo_<?=$list->vehicleid;?>" value="<?=$list->ac_km;?>" />
                                                            <input type="hidden" id="vtemp_<?=$list->vehicleid;?>" name="vtemp_<?=$list->vehicleid;?>" value="<?=$list->temperature;?>" />
                                                            <td class="tdth text-truncate" >
                                                    <input type="hidden" id="single_<?php echo $list->vehicleid;?>" name="singlecheckbox" class="singlecheckbox" value="<?= $list->vehicleid;?>" disabled>
                                                                    </td>
                                                                <td class="tdth text-center status_running" id="vehic_status3<?=$list->vehicleid;?>"> </td>
                                                          
                                                                <td style='text-align: left !important;font-size: 12px;' class="tdth text-center">
                                                                    <p id="vehic_reg3<?=$list->vehicleid;?>" style='margin-bottom:0px'></p>
                                                                    <small id="vehic_upt3<?=$list->vehicleid;?>"></small>
                                                                    <!--<p id="parker_status<?=$list->vehicleid;?>" style='margin-bottom:-5px'></p>-->
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                                                                                <div class="btn-group" role="group">
                                                                                    <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style='font-size: 10px;'>
                                                                                        <a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style='padding-left: 10px;'><i class='fa fa-play'></i>&nbsp;Playback</a>
                                                                                        <a class="dropdown-item" href="component-buttons-extended.html" style='padding-left: 10px;'><i class='fa fa-share-alt'></i>&nbsp; Share position</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </td>
                                                                <!-- <td><?=$list->vehicle_register_number;?></td> -->

                                                                <!--<td class="text-center" ></td>-->
                                                          
                                                                <!--<td class="text-center"></td>-->
                                                                  </tr>
                                                                  
                                                    
                                                                  <?php }}?>
                                                            </tbody>
                                                          </table>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div class="tab-pane" id="tab25" role="tabpanel" aria-labelledby="base-tab25">
                                        <div class="">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div id="daily-activity" class="table-responsive" style="height: 485px;">
                                                           <table id="data" class="table table-hover mb-0" style="color: black"_id="table1">
                                                            <thead>
                                                                 <th class='tdth'>
                                                                        <input type="hidden" id="icheck-input-all " class="allcheckbox" value="all">
                                                                         <input type="hidden" id="pre_lat" value=""/>
                                                                         <input type="hidden" id="pre_lng" value=""/>
                                                                          <input type="hidden" id="pre_angle" value=""/>
                                                                    </th>
                                                              <th class='tdth'></th>
                                                                  <th class='tdth'><?php echo $this->lang->line('vehiclename'); ?> 
                                                                  </th>
                                                                  <!--<th>Last Updated</th>-->
                                                                  <!--<th>Duration (H:M:S)</th>-->
                                                            </thead>
                                                            <tbody>
                                                              

                                                          <?php
                                                            if(isset($ooc_vehicle)){


                                                              $first_oid = $ooc_vehicle['0']->vehicleid; // onload first vehicle id
                                                              $first_ovehicle = $ooc_vehicle['0']->vehiclename; 
                                                            foreach($ooc_vehicle as $list){
                                                          ?>
                                        
                                                           
                                                                  <tr class="tr-a vid_val" id="vid_<?=$list->vehicleid;?>" onclick="selectone('<?php echo $list->vehicleid;?>', '<?php echo $list->vehiclename;?>');" >
                                                          
                                                          <input type="hidden" id="selected_vid" value=""/>
                                                          <input type="hidden" id="selected_vname" value=""/>
                                                            <!--values to access in jquery-->
                                                            <input type="hidden" class="vid" id="vid_<?=$list->vehicleid;?>" name="vid_<?=$list->vehicleid;?>" value="<?=$list->vehicleid;?>" />
                                                            <input type="hidden" id="vft_<?=$list->vehicleid;?>" name="vft_<?=$list->vehicleid;?>" value="<?=$list->fuel_ltr;?>" />
                                                            <input type="hidden" id="vf_<?=$list->vehicleid;?>" name="vf_<?=$list->vehicleid;?>" value="<?=$list->fuel_tank_capacity;?>" />
                                                            <input type="hidden" id="vsp_<?=$list->vehicleid;?>" name="vsp_<?=$list->vehicleid;?>" value="<?=$list->speed;?>" />
                                                            <input type="hidden" id="vac_<?=$list->vehicleid;?>" name="vac_<?=$list->vehicleid;?>" value="<?=$list->ac_flag;?>" />
                                                            <input type="hidden" id="vno_<?=$list->vehicleid;?>" name="vno_<?=$list->vehicleid;?>" value="<?=$list->vehiclename;?>" />
                                                            <input type="hidden" id="vs_<?=$list->vehicleid;?>" name="vs_<?=$list->vehicleid;?>" value="<?=$list->acc_on;?>" />
                                                            <input type="hidden" id="vkm_<?=$list->vehicleid;?>" name="vkm_<?=$list->vehicleid;?>" value="<?=$list->odometer;?>" />
                                                            <input type="hidden" id="vodo_<?=$list->vehicleid;?>" name="vodo_<?=$list->vehicleid;?>" value="<?=$list->ac_km;?>" />
                                                            <input type="hidden" id="vtemp_<?=$list->vehicleid;?>" name="vtemp_<?=$list->vehicleid;?>" value="<?=$list->temperature;?>" />
                                                            <td class="tdth text-truncate" >
                                                    <input type="hidden" id="single_<?php echo $list->vehicleid;?>" name="singlecheckbox" class="singlecheckbox" value="<?= $list->vehicleid;?>" disabled>
                                                                    </td>
                                                                <td class="tdth text-center status_running" id="vehic_status4<?=$list->vehicleid;?>"> </td>
                                                          
                                                                <td style='text-align: left !important;font-size: 12px;' class="tdth text-center">
                                                                    <p id="vehic_reg4<?=$list->vehicleid;?>" style='margin-bottom:0px'></p>
                                                                    <small id="vehic_upt4<?=$list->vehicleid;?>"></small>
                                                                    <!--<p id="parker_status<?=$list->vehicleid;?>" style='margin-bottom:-5px'></p>-->
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                                                                                <div class="btn-group" role="group">
                                                                                    <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style='font-size: 10px;'>
                                                                                        <a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style='padding-left: 10px;'><i class='fa fa-play'></i>&nbsp;Playback</a>
                                                                                        <a class="dropdown-item" href="component-buttons-extended.html" style='padding-left: 10px;'><i class='fa fa-share-alt'></i>&nbsp; Share position</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                </td>
                                                                <!-- <td><?=$list->vehicle_register_number;?></td> -->

                                                                <!--<td class="text-center" ></td>-->
                                                          
                                                                <!--<td class="text-center"></td>-->
                                                                  </tr>
                                                                  
                                                    
                                                                  <?php }}?>
                                                            </tbody>
                                                          </table>



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
            </div>
            <!-- BEGIN: Vendor JS-->
        </div>
    </div>
</div>
 
<script type="text/javascript">
$('#data tr').click(function(e) {
    $('#data tr').removeClass('highlighted');
    $(this).addClass('highlighted');
});

 $('.allcheckbox').click(function(){
      if($('.allcheckbox').is(':checked')==true) {

       // alert('hi');
        $(".singlecheckbox").prop('checked', true);
           update_all_data();
    }
    else
    {
        //$('.single_vehicle_status').hide();          
          $(".singlecheckbox").prop('checked', false);

           //  console.log(markers.length);
            for(var i = 0; i <markers.length; i++){
                    map.removeLayer(markers[i]);
                }
    }
 });

 function selectone(id,name)
    {
//        $('#vid_'+id).click(function(){
//    if ($(this).css("background-color") === "#333333") {
//        $(this).css("background-color", "#1796cf");
//    } else {
//        $(this).css("background-color", "#333333");
//    }
//
//});

//$('#vid_'+id).on('click', function(){
//    
//    $('#vid_'+id).removeClass('background_selected');
//    $(this).addClass('background_selected');
//});


     $('#selected_vid').val(id);
     $('#selected_vname').val(name);
     $('#vehiclename').empty().append('<h2>'+name+'</h2>');
   //  update_graph();
     update_all_data();
     
    }

      $( document ).ready(function() {

      var vid = '<?php echo $first_vid; ?>';
      var vname = '<?php echo $first_vehicle; ?>';
    //  alert(vid);
     $('#vid_'+vid).addClass('highlighted');
    
      $('#selected_vid').val(vid);
       $('#selected_vname').val(vname);
     $('#vehiclename').empty().append('<h2>'+vname+'</h2>');

      update_all_data();
       
});

</script>