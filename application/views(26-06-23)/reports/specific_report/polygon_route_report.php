<?php 
    $role =$this->session->userdata['roleid']; ?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
	<style>
	.leaflet-marker-icon{
    margin-left: -30.5px !important;
    margin-top: -62.5px !important;
	}
	</style>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding-bottom: 0px;padding-top: 3px;">
<!--            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Playback Report</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a> </li>
                                <li class="breadcrumb-item active">Playback Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
              
            </div>-->
         
<form action="<?php echo site_url('Report/polygon_route_report');?>" method="post">
            <section id="form-repeater">
                    <div class="row">
                        <div class="col-12">           
                          <!--   <form action="<?php //echo site_url('Report/polygon_report1');?>" method="POST"> -->
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label>Travel Date</label>
                                        <div class="input-group">
                                            <input type='date' id="from_Date" name="travel_date" class="form-control" placeholder="Choose Travel Date" value="<?php if(!empty($this->session->flashdata('travel_date'))){ echo $this->session->flashdata('travel_date');}?>">
                                        </div>
                                    </div>                                  
                                    <div class="col-md-3">
                                         <label>Route Name</label>
                                        <div class="input-group">
                                            <select class="select2 form-control" id="route_id" name="route_id">
                                               <option>Select Route</option>
                                               <?php if ($route_details) {
                                                foreach ($route_details as $dlist) { ?>
                                                     <option value="<?php echo $dlist->route_id;?>" <?php if(!empty($this->session->flashdata('route_id'))) { echo($this->session->flashdata('route_id') == $dlist->route_id) ? 'selected' : ''; }?>><?php echo $dlist->route_name;?></option>
                                            <?php  }
                                               } ?>
                                          </select>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-3">
                                         <label>Select Vehicle</label>
                                        <div class="input-group">
                                            
                                           <select class="select2 form-control" id="vehicle_id" name="vehicle_id">
                                               <option>Select Vehicle Name</option>
                                               <?php if ($vehicle_list) {
                                                foreach ($vehicle_list as $dlist) { ?>
                                                     <option value="<?php echo $dlist->vehicleid;?>"  <?php if(!empty($this->session->flashdata('vehicle_id'))) { echo($this->session->flashdata('vehicle_id') == $dlist->vehicleid) ? 'selected' : ''; }?>><?php echo $dlist->vehiclename;?></option>
                                            <?php  }
                                               } ?>
                                          </select>
                                            
                                        </div>
                                    </div>                                  
                                    <div class="col-md-3">
                                        <label>&nbsp;</label>
                                        <div class="input-group-append" id="button-addon2">
                                         <button id='submit' class="btn btn-primary" type="submit">Search</button>&nbsp;&nbsp; &nbsp;
                                         <!--    <button class="btn btn-primary" type="submit">Clear</button> -->
                                        </div>
                                       
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            <div class="clearfix"><br></div>
        <div class="content-body">
        
                <?php if(isset($routetrip_report[0]['routetrip_data']) && $routetrip_report[0]['routetrip_data'] != NULL){
                ?>
        
            <div class="col-lg-12 col-md-12 col-sm-12" id="consolidate_report_data" style='padding-top: 10px; margin-bottom: 10px !important;'>
              <header class="panel-heading">


                 <?php

                 if($routetrip_report[0]['routetrip_data']->route_type==1){$ward = "INWARD";}
                  if($routetrip_report[0]['routetrip_data']->route_type==2){$ward = "OUTWARD" ;}
                 // echo 'WARD Type : '.$ward.'&emsp;&emsp;Total Trips : '.$routetrip_report[0]['total_tripcount'];?>&emsp;&emsp; Date:<?php //echo date("d-m-Y",strtotime($this->session->flashdata('travel_date')));?> 
                </header>
           

                <div class="col-lg-12 col-md-6 col-sm-6 stats-info stats-last widget-shadow"> 
                    <table class="table table-striped" id="example">
                        <thead>
                             <tr style="background: #87aade;">
                                <th colspan="5"><?php echo 'WARD Type : '.$ward.'&emsp;&emsp;Total Trips : '.$routetrip_report[0]['total_tripcount'];?>&emsp;&emsp;</th>
                                <th colspan="5">Date:<?php echo date("d-m-Y",strtotime($this->session->flashdata('travel_date')));?></th>
                              
                            </tr>
                            <tr style="background: burlywood;">
                                <th>Trip Count</th>
                                <th>Vehicle</th>
                                <th>Area Name</th>
                                <th>Area Intime</th>
                                <th>Area Outtime</th>
                               <th>In Duration(H:M:S)</th>
                                <!-- <th>Start Odometer</th>
                                <th>End Odometer</th>
                                <th>Distance</th>
                                <th>IDLE Duration(H:M:S)</th> -->
                               
                                
                                 
                            </tr>
                        </thead>
                          <tbody>
                                <?php 
              $a = 1;
            for($j=0;$j<count($routetrip_report);$j++)
                                {
                                    
                        
                              ?>
                      
                            
                            <tr style="background:pink;">
                                <td><?= $a;?></td>
                                <td><?=$routetrip_report[$j]['routetrip_data']->vehicle_name;?></td>
                                  <?php 
                                                    $start_loc = $this->db->query("SELECT polygon_name FROM polygon_list WHERE polygon_id = '".$routetrip_report[$j]['routetrip_data']->route_startid."'");
                                                    $start_data = $start_loc->row();
                                                ?>
                                                <td><?php echo $start_data->polygon_name;?></td>  


                                <!-- <td><?=$routetrip_report[$j]['routetrip_data']->start_polygon_name;?></td>
 -->                                <td><?=$routetrip_report[$j]['routetrip_data']->start_route_intime;?></td>
                                <td><?=$routetrip_report[$j]['routetrip_data']->start_route_outtime;?></td>
                            <td><?php echo gmdate("H:i:s", $routetrip_report[$j]['routetrip_data']->start_dur);?></td>
                            <!-- <td><?php echo $routetrip_report[$j]['start_odometer'];?></td>
                            <td><?php echo $routetrip_report[$j]['end_odometer'];?></td>
                            <td><?php echo $routetrip_report[$j]['distance'];?></td>
                            <td><?php echo $routetrip_report[$j]['idle_duration'];?></td> -->
                            </tr>

                            <!-- stops start -->
                            <?php $stopdata=$routetrip_report[$j]['routestop_data'];
                            if($stopdata)
                            {

                                for($i=0;$i<count($stopdata);$i++)
                                {
                                    

                                    ?>
                            <tr>
                                <td></td>
                                <td></td>
                                  <?php 
                                   $start_loc = $this->db->query("SELECT polygon_name FROM polygon_list WHERE polygon_id = '".$stopdata[$i]['stop_geo_id']."'");
                                                    $start_data = $start_loc->row();

                                                   
                                                ?>
                                                <td><?php echo $start_data->polygon_name;?></td>  


                              <!--   <td><?=$stopdata[$i]['geo_name'];?></td> -->
                                <td><?php if($stopdata[$i]['stopentry_time']){echo $stopdata[$i]['stopentry_time'];}else{echo "NOT REACH";}?></td>
                                <td><?=$stopdata[$i]['stopexit_time'];?></td>
                                <td><?php echo gmdate("H:i:s", $stopdata[$i]['total_dur']);?></td>
                                    <!-- <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td> -->
                            </tr>
                            <?php }?>
                        <?php }?>
                            <!-- stops end -->

                            <tr>
                                <td></td>
                                <td></td>

                            <?php

                            $end_polygon = $routetrip_report[$j]['routetrip_data']->route_endid;
 
                                                    $start_loc = $this->db->query("SELECT polygon_name FROM polygon_list WHERE polygon_id = '".$end_polygon."'");
                                                    $start_data = $start_loc->row();
                                                ?>
                                                <td><?php echo $start_data->polygon_name;?></td>  


                                <!-- <td><?=$end_polygon_name;?></td> -->
                                <td><?php if($routetrip_report[$j]['routetrip_data']->end_route_intime){echo $routetrip_report[$j]['routetrip_data']->end_route_intime;}else{echo "NOT REACH";}?></td>
                                <td><?=$routetrip_report[$j]['routetrip_data']->end_route_outtime;?></td>
                                <td><?php echo gmdate("H:i:s", $routetrip_report[$j]['routetrip_data']->end_dur);?></td>
                                <!-- <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td> -->
                                    
                     
                            </tr>


                        <?php 
                        $a++;
                    }?>
<!-- end point end-->
                        </tbody>
                    </table>
                </div>
            </div> 

        <?php //}elseif($this->session->flashdata('route_id')!=''){?>
            <!-- <div class="col-lg-12 col-md-12 col-sm-12" style='text-align: center; color: red; font-weight: bold; padding-top: 10px; margin-bottom: 10px !important;'>  
                No Data Found...
            </div> -->

        <?php } else { ?>
         <div ><h3 class="text-white bg-dark">
No data Found...........</h3></div>
      <?php  }?>

        </div>




      </div>
    </div>
    <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
        
        "paging": false,
        "ordering": false,
        "searching": false
    } );
} );
</script>