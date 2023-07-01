<div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Livetrack Dashboard</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                   
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="card-text">
                        <section class="cd-horizontal-timeline">

                      	

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
                      
                      
                        <!--main content start-->
                          <section id="main-content">
 
 <section class="wrapper" style="height: 85vh !important">
   <div class="market-updates">
      <div class="pull-right" style="font-size:25px;"> <span id="time"></span></div>
     <div class="col-lg-12 col-md-12 col-sm-12" style='padding-top: 5px !important;'>
              <h2 style='margin: 15px !important;'>Live Track Dashboard&nbsp;<li class="fa fa-dashboard"></li></h2>
     </div>




              <div class="notify-w3ls  stats-info stats-last widget-shadow"  style="margin-bottom: 10px !important;padding-right:30px !important;"> 
         <table id="" class="table table-bordered table-striped stats-info stats-last widget-shadow"  style="margin: 15px !important; " >
           <thead>
             <tr>
             
             </tr>

           </thead>
           <?php    
 
         
           


            $count_sno = 1;
            //print_r($livedetails);
            //  echo $livedetails[2]['liveroute_details']['vehicle_name'];
            //  echo $livedetails[3]['liveroute_details']['vehicle_name'];exit;
           
          //  $livedetails = array_unique($livedetails); // Array is now (1, 2, 3)

           for ($i=0; $i <count($livedetails) ; $i++) { 


         if ($livedetails[$i]['liveroute_details']['routename']) {
          
        
           ?>              
          
             <tr>
               <th scope="row"> <?=$count_sno++;?></th>
              <td><b><?=$livedetails[$i]['liveroute_details']['vehicle_name'];?></b></td>
               <td><b><?=$livedetails[$i]['liveroute_details']['routename'];?></b></td>
               <td><?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$livedetails[$i]['liveroute_details']['route_startid']."'");
               $ign_f = $ign_q->row();
              ?>
                  <span><b><?php echo $ign_f->Location_short_name;?></b></span><br>
               <?php
               
             
     $darrival_session=$livedetails[$i]['liveroute_details']['route_planstart_time'];
    
     $sarrival_time=date("h:i:s A",strtotime($livedetails[$i]['liveroute_details']['route_exitime']));

    $time1 = new DateTime($darrival_session);
    $time2 = new DateTime($sarrival_time);
    $timediff = $time1->diff($time2);
    $diff = $timediff->format('%h:%i:%s');
    $timesplit=explode(':',$diff);
    $route_startmin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);
?> 
               <span>P.Exit:<?php echo $darrival_session;?></span><br>
               <span>A.Exit:<?php echo date("h:i A",strtotime($livedetails[$i]['liveroute_details']['route_exitime']));?></span><br>

               <span style="color:#db5046;">Exit Delay:<?php  if($darrival_session > $sarrival_time){echo "--";}else{echo $timediff->format(' %i Minutes');}?></span><br>
               <?php if($darrival_session > $sarrival_time || $route_startmin<10){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";}?></span><br>
               
              </td>
             
             <?php
             foreach ($livedetails[$i]['livestop_details'] as $s_list) {
           

           $ac_starttime =   date("h:i A",strtotime($s_list['stopentry_time']));
           $ac_endtime =   date("h:i A",strtotime($s_list['stopexit_time']));


              ?>
               <td>
              <?php $ign_sl = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$s_list['stop_geo_id']."'");
               $ign_sf = $ign_sl->row();?>
             <b><?php echo $ign_sf->Location_short_name;?></b><br>
               <span>ETA:<?php if($s_list['stopentry_time']){echo"<span style ='color:red;'>reach</span>";}else {echo $s_list['stop_ept_time'];}?></span><br>
             <span>P.Entry:<?php echo $s_list['stopplaned_entry']?></span><br>
              <span>P.Exit :<?php echo $s_list['stopplaned_exit']?></span><br>
               <span>A.Entry:<?php if($ac_starttime=='05:30 AM'){}else{echo  $ac_starttime;}?></span><br>
              <span>A.Exit :<?php if($ac_endtime=='05:30 AM'){}else{echo  $ac_endtime;}?></span><br>
             <?php 
               $stop_session=$s_list['stopplaned_entry'];

           $sarrival_stop=date("h:i:s",strtotime($s_list['stopentry_time']));
           $time41=$s_list['stopentry_time'];
            $time4=new DateTime($time41);
        // stopplaned_exit
           if($sarrival_stop!='05:30:00')
           {
     $darrival_time=date("A",strtotime($stop_session));

     if($darrival_time=='AM')
     {
       $ct = date("A");
        if($ct=='PM')
      {
       $time31 = date('Y-m-d H:i:s',strtotime('+1 day',  strtotime($stop_session)));
       $time3=new DateTime($time31);
      }
      else
      {
        $time31 = date('Y-m-d H:i:s',strtotime($stop_session));
        
           $time3=new DateTime($time31);
      }

     
     }
     else
     {
       $ct = date("A");
      if($ct=='AM')
      {
       $time31 = date('Y-m-d H:i:s',strtotime('-1 day', strtotime($stop_session)));
          $time3=new DateTime( $time31);
      
      }
      else
      {
          $time31 = date('Y-m-d H:i:s', strtotime($stop_session));
          $time3=new DateTime($time31);
      }
     
      
     }

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
           $dispatch_stop=date("h:i:s",strtotime($s_list['stopexit_time']));
           $time51=$s_list['stopexit_time'];
            $time5=new DateTime($time51);
        // stopplaned_exit
           if($dispatch_stop!='05:30:00')
           {
     $darrival_time1=date("A",strtotime($stop_exit_session));

     if($darrival_time1=='AM')
     {
       $ct = date("A");
        if($ct=='PM')
      {
       $time61 = date('Y-m-d H:i:s',strtotime('+1 day', strtotime($stop_exit_session)));
       $time6=new DateTime($time61);
      }
      else
      {
        $time61 = date('Y-m-d H:i:s', strtotime($stop_exit_session));
        
           $time6=new DateTime( $time61);
      }

     
     }
     else
     {
       $ct = date("A");
      if($ct=='AM')
      {
       $time61 = date('Y-m-d H:i:s',strtotime('-1 day', strtotime($stop_exit_session)));
          $time6=new DateTime( $time61);
      
      }
      else
      {
          $time61 = date('Y-m-d H:i:s', strtotime($stop_exit_session));
          $time6=new DateTime($time61);
      }
     
      
     }

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
              <span style="color:#db5046;">Entry Delay:<?php if($time3 > $time4){echo "-";}else{ if($sarrival_stop=='05:30:00'){echo "-";}else{echo $stop_entrymin.'mins';} }?></span><br>
              
                 <span style="color:#db5046;">Exit Delay:<?php if($time6 > $time5){echo "-";}else{ if($dispatch_stop=='05:30:00'){echo "-";}else{echo $stop_exitmin.'mins';} }?></span><br>
           
             

             <span><?php if($stop_entrymin!='') { if($stop_entrymin<10 || $time6 > $time5){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";}}else{?><span style="border:1px solid yellow;background:yellow;color:black;">Status:<?php echo "Not Reached"; }?></span><br>
             <button type="button" class="btn btn-outline-danger block btn-lg" onclick="myFunction(<?php echo $s_list['stop_geo_id'];?>)" data-toggle="modal" id="onhidebtn" data-target="#onhide">
										Attendance
									</button>
               </td>
           <?php } ?>
          
               

               <td><?php $ign_eq = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$livedetails[$i]['liveroute_details']['route_endid']."'");
               $ign_qf = $ign_eq->row();
                ?>
             <span><b><?php  echo $ign_qf->Location_short_name;?></b></span><br>
              <span>ETA:<?php if($livedetails[$i]['liveroute_details']['route_entry_time']) {echo"<span style ='color:red;'>reach</span>";}else{echo $livedetails[$i]['liveroute_details']['routeend_exptime'];}?></span><br>
         
               <?php

      $darrival_session1=$livedetails[$i]['liveroute_details']['route_planend_time'];
     $sarrival_time1=date("h:i:s A",strtotime($livedetails[$i]['liveroute_details']['route_entry_time']));

    $time1 = new DateTime($darrival_session1);
    $time2 = new DateTime($sarrival_time1);
    $timediff = $time1->diff($time2);
    $diff1 = $timediff->format('%h:%i:%s');
    $timesplit=explode(':',$diff1);
    $route_endmin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);

      $acroute_endtime = date("h:i A",strtotime($livedetails[$i]['liveroute_details']['route_entry_time']));

?>
                <span>P.Entry:<?php echo $darrival_session1;?></span><br>
               <span>A.Entry:<?php if($acroute_endtime=='05:30 AM'){echo "--";}else{echo $acroute_endtime;}?></span><br>

               <span style="color:#db5046;">Entry Delay:<?php if($livedetails[$i]['liveroute_details']['route_entry_time']){  if($darrival_session1 > $sarrival_time1){echo "--";}else echo $route_endmin.'mins';}?></span><br>

               <?php if($acroute_endtime!='05:30 AM'){ if($route_endmin<10 || $darrival_session1 > $sarrival_time1){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";} }else{?><span style="border:1px solid yellow;background:yellow;color:black;">Status:<?php echo "Not Reached";}?></span>
            
               </td>
              
             </tr>
           <?php     } } ?>
            
         </table>

       <div>
        
             <div>
               <?php if($nodata){ ?>
           <h4>No GPS Found Vehicles</h4>
           <ol> 
           <?php for ($i=0; $i <sizeof($nodata) ; $i++) { 
             ?>
             
         
          <li><b style="color:red;"><?= $nodata[$i];?></b></li>  
          <?php   } } ?> 
         
         </ol>  
         </div>
       </div>
       </div>

 </div>  
  
 </section>

 
<!-- main content end -->
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                      //  for (var i = 0; i < data.length; i++) {
                      //    newRow += "<tr><td>" + data[i].student_id + "</td><td>" + data[i].student_name + "</td></tr>";
                      // }
                      // console.log(newRow)
                      // $("#myTable").empty().append(newRow);
                     
                      }
  }); 


}

    </script>