<!-- Content Wrapper. Contains page content -->
<style>

.table-wrap {
  height: auto;
  overflow-x: auto;
}
#livetrack_report
{
  font-family: "Lucida Console", "Courier New";
}

</style>

<div class="col-md-12 col-sm-12 container">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Livetrack Report</h4>
				</div>
				<div class="card-content">
					<div class="card-body">

	<!-- Modal -->
  <div class="modal fade text-left" id="onhide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel23" aria-hidden="true">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title" id="myModalLabel23"><i class="fa fa-tree"></i> Basic Modal</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">×</span>
											</button>
										  </div>
                      <div class="modal-body">
										<div class="testClass"></div>
                        <table class="table table-bordered text-center" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Attentance</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                              </div>
										  <div class="modal-footer">
											<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-outline-primary">Save changes</button>
										  </div>
										</div>
									  </div>
									</div>
								</div>
							</div>
              
          <form role="form" action="<?php echo site_url('report/livetrackreport');?>" method="post" id="consolidate_report_overall">  
              		<div class="row">

                  <div class="col-xl-3 col-lg-3 col-md-12">
                                <fieldset class="form-group">
                                    <label for="basicSelect">Date</label>
                                    <input type="date" class="form-control" placeholder="Choose travel date" name="travel_date" autocomplete="off" value="<?php if(!empty($this->session->flashdata('travel_date'))){ echo date("Y-m-d",strtotime($this->session->flashdata('travel_date')));}?>" required>
                                </fieldset>
                  </div>

                  <div class="col-xl-3 col-lg-3 col-md-12">
                                <fieldset class="form-group">
                                    <label for="basicSelect">Shift Type</label>
                                    <select id="shift_type" name='shift_type' class="form-control"> 
                                      <option value=0 <?php if(($this->session->flashdata('shift_type')==0)){ echo "selected";}?>>ALL</option>
                                      <option value=1 <?php if(($this->session->flashdata('shift_type')==1)){ echo "selected";}?>>Morning</option>
                                      <option value=2 <?php if(($this->session->flashdata('shift_type')==2)){ echo "selected";}?>>Evening</option>
                                    </select>
                                  </fieldset>
                  </div>


                  <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class='input-group date ' style="padding:25px;">
                          <button type="submit" id='' class="btn btn-info search-button">Search</button>
                        </div>
              
                </div>

                  </div>	
              	
						  </form>
					</div>
				</div>



			</div>
		</div>




<div class="col-md-12 col-sm-12 container">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Livetrack Report</h4>
				</div>
				<div class="card-content">
					<div class="card-body">
          <div class="table-wrap">
          <table id="livetrack_report" class="table table-bordered " >
          <thead>
            
           </thead>
           <tbody>
           <?php    
            $count_sno = 1;
            if($livetrack_report){
           for ($i=0; $i <count($livetrack_report) ; $i++) { 
         if ($livetrack_report[$i]['routename']) {
           ?>              
             <tr class="bg-warning">
               <th scope="row"> <?=$count_sno++;?></th>
              <td><b><?=$livetrack_report[$i]['vehicle_name'];?></b></td>
               <td><b><?=$livetrack_report[$i]['routename'];?></b></td>
               <td><?php $ign_q = $this->db->query("SELECT Location_short_name FROM sch_location_list WHERE Location_id='".$livetrack_report[$i]['route_startid']."'");
               $ign_f = $ign_q->row();
              ?>
                  <span><b><?php echo $ign_f->Location_short_name;?></b></span><br>
               <?php
               
             
     $darrival_session=$livetrack_report[$i]['route_planstart_time'];
     $darrival_time=date("h:i:s A",strtotime($darrival_session));


     $sarrival_time=date("h:i:s A",strtotime($livetrack_report[$i]['route_exitime']));

    $time1 = new DateTime($darrival_time);
    $time2 = new DateTime($sarrival_time);
    $timediff = $time1->diff($time2);
    $diff = $timediff->format('%h:%i:%s');
    $timesplit=explode(':',$diff);
   
    $route_startmin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);
    // print_r($route_startmin);
    // exit;
?> 
               <span>P.Exit:<?php echo $darrival_time;?></span><br>
               <span>A.Exit:<?php echo date("h:i A",strtotime($livetrack_report[$i]['route_exitime']));?></span><br>

               <span style="color:#3634b9;">Exit Delay:<?php  if($darrival_time > $sarrival_time){echo "--";}else{echo $timediff->format('%h Hours %i Minutes');}?></span><br>
               <?php if($darrival_time > $sarrival_time || $route_startmin<10){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";}?></span>
            </td>
             
             <?php
             foreach ($livetrack_report[$i]['livestop_array'] as $s_list) {
           
           $ac_starttime =   date("h:i A",strtotime($s_list['stopentry_time']));
           $ac_endtime =   date("h:i A",strtotime($s_list['stopexit_time']));

           $pl_starttime =   date("h:i A",strtotime($s_list['stopplaned_entry']));
           $pl_endtime =   date("h:i A",strtotime($s_list['stopplaned_exit']));


              ?>
               <td>
              <?php $ign_sl = $this->db->query("SELECT Location_short_name FROM sch_location_list WHERE Location_Id='".$s_list['stop_geo_id']."'");
               $ign_sf = $ign_sl->row();?>
             <b><?php echo $ign_sf->Location_short_name;?></b><br>
               <span>ETA:<?php if($s_list['stopentry_time']){echo"<span style ='color:red;'>reach</span>";}elseif($livetrack_report[$i]['route_entry_time']){echo"--:--:--"; } else{echo $s_list['stop_ept_time'];}?></span><br>
             <span>P.Entry:<?php echo $pl_starttime;?></span><br>
              <span>P.Exit :<?php echo  $pl_endtime;?></span><br>
               <span>A.Entry:<?php if($ac_starttime=='05:30 AM'){}else{echo  $ac_starttime;}?></span><br>
              <span>A.Exit :<?php if($ac_endtime=='05:30 AM'){}else{echo  $ac_endtime;}?></span><br>
             <?php 
               $stop_session=$s_list['stopplaned_entry'];
              //  $stop_session2=substr($stop_session, 0, -2);
           $sarrival_stop=date("h:i:s",strtotime($s_list['stopentry_time']));
           $time41=$s_list['stopentry_time'];
            $time4=new DateTime($time41);
        // stopplaned_exit
           if($sarrival_stop!='05:30:00')
           {

            $darrival_time=date("A",strtotime($stop_session));


          $time31 = date('Y-m-d H:i:s', strtotime($stop_session));
          $time3=new DateTime($time31);
    
              $timediff = $time3->diff($time4);
            $sdiff = $timediff->format('%h:%i:%s');
            $timesplit=explode(':',$sdiff);
           $stop_entrymin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);

          }
          else
          {

           $stop_entrymin='';

          }

             
          
            $stop_exit_session=$s_list['stopplaned_exit'];
            // $stop_exit_session2=substr($stop_exit_session, 0, -2);
          $dispatch_stop=date("h:i:s",strtotime($s_list['stopexit_time']));
           $time51=$s_list['stopexit_time'];
            $time5=new DateTime($time51);
        // stopplaned_exit
           if($dispatch_stop!='05:30:00')
           {
   
    
          $time61 = date('Y-m-d H:i:s', strtotime($stop_exit_session));
           $time6=new DateTime( $time61);
     
            $timediff = $time6->diff($time5);
            $sdiff = $timediff->format('%h:%i:%s');
            $timesplit=explode(':',$sdiff);
           $stop_exitmin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);

          }
          else
          {
           $stop_exitmin='';

          }


            


            ?>
              <span style="color:#3634b9;">Entry Delay:<?php if($time3 > $time4){echo "-";}else{ if($sarrival_stop=='05:30:00'){echo "-";}else{echo $stop_entrymin.'mins';} }?></span><br>
              
                 <span style="color:#3634b9;">Exit Delay:<?php if($time6 > $time5){echo "-";}else{ if($dispatch_stop=='05:30:00'){echo "-";}else{echo $stop_exitmin.'mins';} }?></span><br>
           
             

             <span><?php if($stop_entrymin!='') { if($stop_entrymin<10 || $time6 > $time5){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";}}else{?><span style="border:1px solid yellow;background:yellow;color:black;">Status:<?php echo "Not Reached"; }?></span>
             <button type="button" class="btn btn-outline-danger block btn-lg" onclick="myFunction(<?php echo $s_list['stop_geo_id'];?>)" data-toggle="modal" id="onhidebtn" data-target="#onhide">
										Attendance
									</button>
              </td>
           <?php } ?>
          
               

               <td><?php $ign_eq = $this->db->query("SELECT Location_short_name FROM sch_location_list WHERE Location_id='".$livetrack_report[$i]['route_endid']."'");
               $ign_qf = $ign_eq->row();
                ?>
             <span><b><?php  echo $ign_qf->Location_short_name;?></b></span><br>
              <span>ETA:<?php if($livetrack_report[$i]['route_entry_time']) {echo"<span style ='color:red;'>reach</span>";}else{echo $livetrack_report[$i]['routeend_exptime'];}?></span><br>
         
               <?php

      $darrival_session1=$livetrack_report[$i]['route_planend_time'];
      // $darrival_session2= substr($darrival_session1, 0, -2);
      $darrival_time1=date("h:i A",strtotime($darrival_session1));

     $sarrival_time1=date("h:i A",strtotime($livetrack_report[$i]['route_entry_time']));

    $time1 = new DateTime($darrival_time1);
    $time2 = new DateTime($sarrival_time1);
    $timediff = $time1->diff($time2);
    $diff1 = $timediff->format('%h:%i:%s');
    $timesplit=explode(':',$diff1);
    $route_endmin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);



      $acroute_endtime = date("H:i A",strtotime($livetrack_report[$i]['route_entry_time']));

?>
                <span>P.Entry:<?php echo $darrival_time1;?></span><br>
               <span>A.Entry:<?php if($acroute_endtime=='05:30 AM'){echo "--";}else{echo $sarrival_time1;}?></span><br>

               <span style="color:#3634b9;">Entry Delay:<?php if($livetrack_report[$i]['route_entry_time']){  if($darrival_time1 > $sarrival_time1){echo "--";}else echo $route_endmin.'mins';}?></span><br>

               <?php if($acroute_endtime!='05:30 AM'){ if($route_endmin<10 || $darrival_time1 > $sarrival_time1){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";} }else{?><span style="border:1px solid yellow;background:yellow;color:black;">Status:<?php echo "Not Reached";}?></span>
            
               </td>

               <?php
          $data = array(
            'from_date'=>$livetrack_report[$i]['route_exitime'],
            'to_date'=>$livetrack_report[$i]['route_entry_time'],
            'vehicleid'=>$livetrack_report[$i]['vehicle_id'],
            'route_id'=>$livetrack_report[$i]['live_routeid']
        );
          $alldata = json_encode($data);
          $alldata = urlencode($alldata);?>
               <td><b>Map view</b>
              <a href="<?php echo base_url('Livetrack/reportplayback_details?data='.$alldata);?>" target="_blank">
              <img class="media-object" src="<?php echo base_url();?>/app-assets\images\menuicon\29.svg" alt="image" style="background:cadetblue;">
              </a>
              </td>

              
             </tr>
           <?php     }} }else { ?>
             <div class="alert alert-danger" role="alert">
                                  No Data Found.............
              </div>
 <?php }  ?>
        </tbody>
         </table>
        </div>
					</div>
				</div>



			</div>
		</div>
    

    <script type="text/javascript">

$(document).ready(function () {
    // $('#livetrack').DataTable();
    $('#livetrack_report').DataTable({
        scrollX: true,
        pagingType: 'full_numbers'
    });

});

</script>

<script>
  
function myFunction(stop_geo_id) {

var url = '<?php echo site_url('Livetrack/get_rfid_data');?>';
                $.ajax({
                     type: "POST",
                     url: url,                                                                                                                                                                                                      
                     data:{stop_geo_id:stop_geo_id}, // serializes the form's elements.
                     dataType:'json',
                     success: function(data)
                     {
                      console.log(data);
                      var trHTML = "";
                      
                      $.each(data, function (i, item) {
                        if(item.attentance=='1'){
                        var attentance = '<i class="fa fa-check" aria-hidden="true"></i>';
                        }else{
                        var attentance = '<i class="fa fa-times" aria-hidden="true"></i>';
                        }
                          trHTML += '<tr><td>' + item.student_id + '</td><td>' + item.student_name + '</td><td>'+ attentance +'</td></tr>';
                      });
                      $('#myTable').empty().append(trHTML);
                   
                    }
}); 
}
</script>