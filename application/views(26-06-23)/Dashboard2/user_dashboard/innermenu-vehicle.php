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
.status_running
{
width:20%;
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
                                                    <table id="innervehicles" class="table table-striped">
                                                    <thead>
                                                    <th class='tdth'>
                                                            <input type="hidden" id="icheck-input-all " class="allcheckbox" value="all">
                                                            <input type="hidden" id="pre_lat" value=""/>
                                                            <input type="hidden" id="pre_lng" value=""/>
                                                            <input type="hidden" id="pre_angle" value=""/>
                                                            <input type="hidden" id="selected_vid" value=""/>
                                                          <input type="hidden" id="selected_vname" value=""/>
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
                                                          
                                                                <td style='text-align: left !important;font-size: 15px;' class="tdth text-center">
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
                                                          
                                                                <td style='text-align: left !important;font-size: 15px;' class="tdth text-center">
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
                                                          
                                                                <td style='text-align: left !important;font-size: 15px;' class="tdth text-center">
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
                                                           <!-- <table id="data" class="table table-hover mb-0" style="color: black"_id="table1"> -->
                                                         
                                                           <table id="innervehicles1" class="table table-striped">
                                                                 <th class='tdth noborder'>
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
                                                            <!-- <td class="tdth text-truncate" >
                                                            <input type="hidden" id="single_<?php echo $list->vehicleid;?>" name="singlecheckbox" class="singlecheckbox" value="<?= $list->vehicleid;?>" disabled>
                                                                    </td> -->
                                                                <td class="tdth text-center status_running" id="vehic_status4<?=$list->vehicleid;?>"> </td>
                                                          
                                                                <td style='text-align: left !important;font-size: 15px;' class="tdth text-center">
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

divlightbox();

function divlightbox() {
    // define the $ as jQuery for multiple uses
    jQuery(function($) {
    

        
        var table = $('#innervehicles').dataTable({
                            "bProcessing": true,
                            "sAjaxSource": "<?php echo site_url();?>/Dashboard/get_allvehicles",
                            "bPaginate":false,
                            "sPaginationType":"full_numbers",
                            "responsive": true,
                            "bDestroy": true,
                            "iDisplayLength": 10,
                            "aoColumns": [
                                    { mData: 'image' } ,
                                    { mData: 'vehiclename' },
                                    { mData: 'action' }
                            ],
                            "language": 
                                {          
                                "processing": "<i class='fa fa-refresh fa-spin'></i>",
                                },
                            createdRow: function (row, data, dataIndex) {
                               // console.log(dataIndex);
                                if(dataIndex==0)
                                {
                                    $(row).addClass('highlighted');
                                }
                            }
                    });   
            
                  
    }); 

 

}

     $(document).ready(function() {

      
                    $('#innervehicles tbody').on('click', 'tr', function () {
                        var id = $(this).attr('id');
                    //    var class = $(this).attr('class');
                    var name = $(this).attr('class').split(' ')[0];

                 $('#innervehicles tr').removeClass('highlighted');
                $(this).addClass('highlighted');

                    $('#selected_vid').val(id);
                    $('#selected_vname').val(name);
                 
            //  update_graph();
                update_all_data();
                update_graph();

             
                
                   
} );


      } );
      setInterval(update_status_table, 10000);

$('#data tr').click(function(e) {
    $('#data tr').removeClass('highlighted');
    $(this).addClass('highlighted');
});
 function selectone(id,name)
    {

     $('#selected_vid').val(id);
     $('#selected_vname').val(name);
     $('#vehiclename').empty().append('<h2>'+name+'</h2>');
   //  update_graph();
     update_all_data();
     
    }

      $( document ).ready(function() {

      var vid = '<?php echo $first_vid; ?>';
     // alert(vid);
      var vname = '<?php echo $first_vehicle; ?>';

      $('#selected_vid').val(vid);
       $('#selected_vname').val(vname);
     $('#vehiclename').empty().append('<h2>'+vname+'</h2>');

      update_all_data();
       
});




function update_status_table(){
            
         

            $.ajax({
              url: '<?php echo site_url('/Dashboard/all_vehicle_loc/');?>',//get current loc of all vehicle from db
              type: 'GET',
              dataType : "json",
              success: function(data) {
                
              // $('#body-data').empty();
              // $('#selected_vid').val(data[0].vehicleid);
                
                for (var j = 0; j < data.length; j++) { 
                  var v_u_time = parseInt(data[j].update_time);
                  console.log(data[j].update_time);
                      var v_acc_on = parseInt(data[j].acc_on);
                      var v_speed = parseInt(data[j].speed);
      
                       switch(data[j].vehicle_type) {//get vehicle type
      
                      case '1':
                        var image_path = '<i class="fa fa-bicycle" aria-hidden="true"></i>';
                        break;
                      case '2':             
                        var image_path = '<i class="fa fa-car" aria-hidden="true"></i>';
                        break;
                      case '3':
                        var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                        break;
                      case '4':
                        var image_path = '<i class="fa fa-bus" aria-hidden="true"></i>';
                        break;
                      case '5':
                        var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
                        break;
                      default:
                        var image_path = '<i class="fa fa-truck" aria-hidden="true"></i>';
      
                    }
      
                    var vehicle_sleep =parseInt(data[j].vehicle_sleep);
      
                      if(v_u_time <= 10)
                      {
                        if(vehicle_sleep==3)
                        {
                            var image = '<span style="color:#147fc7">'+image_path+'</span>&nbsp;';
                                var status_cont = 'PARKING';
                        }
                        else if(v_acc_on == 1)
                        {
                          if(v_speed >0)
                          {
                               if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                              {
                                 var image = '<span style="color:green">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                 var status_cont = 'MOVING';
                              }
                              else
                              {
                                var image = '<span style="color:green">'+image_path+'</span>&nbsp;';
                                var status_cont = 'MOVING';
                              }
                          }else{
      
                               if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                              {
                                 var image = '<span style="color:#fabf2c">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                 var status_cont = 'MOVING';
                              }
                              else
                              {
                                 var image ='<span style="color:#fabf2c">'+image_path+'</span>&nbsp;'; 
                                var status_cont = 'IDLE';
                              }
                            
                          }
                        }else
                        {
                          if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                          {
                             var image = '<span style="color:blue">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                            var status_cont = 'PARKING';
                          }
                          else
                          {
                            var image = '<span style="color:blue">'+image_path+'</span>&nbsp;'; 
                            var status_cont = 'PARKING';
                          }
                           
                        }
                        //alert('hi');
                      }else
                      {
                           if(data[j].device_type == 2 || data[j].device_type == 4 || data[j].device_type == 6 || data[j].device_type == 7 || data[j].device_type == 10 || data[j].device_type == 11 || data[j].device_type == 12 || data[j].device_type == 13 || data[j].device_type == 14 || data[j].device_type == 15 )
                              {
                                 var image = '<span style="color:#a89e9e">'+image_path+'<i class="fa fa-tint"></i></span>&nbsp;'; 
                                 var status_cont = 'MOVING';
                              }
                              else
                              {
                                   var image = '<span style="color:#a89e9e">'+image_path+'</span>&nbsp;';
                                  var status_cont = 'GSM Lost';
                              }
                       
                      }
                  var img_cont = image; 
      
                
      
                  var vehic_upt = 'vehic_upt'+data[j].vehicleid;
                  if(data[j].updatedon){var update_valu = data[j].updatedon;}else{var update_valu ='____:__:__ __:__:__';}
                  $('#updatedtime_'+data[j].vehicleid).empty().html(update_valu);
                  var vehic_status = 'vehic_status'+data[j].vehicleid;
                  $('#vehicle_icon_'+data[j].vehicleid).empty().html(img_cont);
               //   alert(img_cont);
      
      
                  // var tr_row = '<tr class="tr-a vid_val" id="vid_'+data[j].vehicleid+'" onclick="selectone( '+data[j].vehicleid+');"><td class="tdth text-center status_running" id="vehic_status_'+data[j].vehicleid+'">'+img_cont+'</td><td style="text-align: left !important;font-size: 12px;" class="tdth text-center"> <p id="vehic_reg_'+data[j].vehicleid+'" style="margin-bottom:0px">'+data[j].vehiclename+'</p><small id="vehic_upt<'+data[j].vehicleid+'">'+update_valu+'</small> <td><div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown"><div class="btn-group" role="group"> <a class="dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="font-size: 10px;"><a class="dropdown-item" href="<?php echo site_url('Genericreport/playback');?>" style="padding-left: 10px;"><i class="fa fa-play"></i>&nbsp;Playback</a><a class="dropdown-item" href="component-buttons-extended.html" style="padding-left: 10px;"><i class="fa fa-share-alt"></i>&nbsp; Share position</a></div></div></div></td></tr>';
      
                  // console.log(tr_row);
      
                  //   $('#body-data').append(tr_row);
      
                  var last_off_upt = 'parker_status'+data[j].vehicleid;
      
                  var vehic_reg = 'vehic_reg'+data[j].vehicleid;
      
                  $('#single_vehiclename_'+data[j].vehicleid).empty().append(data[j].vehiclename);
        
                }
         
              // $('#vid_'+data[0].vehicleid).addClass('highlighted');
              // $("#selected_vid").val(data[0].vehicleid);
      
      
      
              },error:function(){
                console.log('error');
              }
            });
       
          }


</script>