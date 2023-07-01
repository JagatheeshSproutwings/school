<!-- Content Wrapper. Contains page content -->

<?php $role = ($this->session->userdata['role']); 
error_reporting(0); ?>

<head>
</head>
<body>
<section id="container">
<section id="main-content">
    
    <section class="wrapper">
        <div class="w3-agile-google_map">
	        <h2 style="text-align:center;">Live Track Report</h2>

	        			<div class=" col-lg-12 col-md-12 col-sm-12 stats-info-agileits">
              				<form role="form" action="<?php echo site_url('report/livetrackreport');?>" method="post" id="consolidate_report_overall">  
              		<div class="row">
                    
                     <div class="col-md-4 col-lg-2">
                   
                        <div class='input-group'>
                             <input type="date" class="form-control" placeholder="Choose travel date" name="travel_date" autocomplete="off" value="<?php if(!empty($this->session->flashdata('travel_date'))){ echo date("Y-m-d",strtotime($this->session->flashdata('travel_date')));}?>" required>
                        </div>
                    
                </div>

                    <div class="col-sm-6 col-md-6 col-lg-2">
                   
                        <div class='input-group date '>
                          <button type="submit" id='' class="btn btn-info search-button">Search</button>
                          <input type="hidden" id="report_opt" value="<?php echo $this->session->flashdata('report_option');?>">
                        </div>
              
                </div>

                  </div>	
              	
						  </form>
			
			        <div class="col-lg-12 col-md-12 col-sm-12" style='padding-top: 5px !important;'>
                 <h2 style='margin: 15px !important;'>Live Track Report&nbsp;<li class="fa fa-dashboard"></li></h2>
             </div>




                 <div class="notify-w3ls  stats-info stats-last widget-shadow"  style="margin-bottom: 10px !important;padding-right:30px !important;"> 
            <table id="" class="table table-bordered table-striped stats-info stats-last widget-shadow"  style="margin: 15px !important; " >
              <thead>
                <tr>
                
                </tr>

              </thead>
              <?php    
    
     
               $count_sno = 1;
               for ($i=0; $i <count($livetrack_report) ; $i++) { 

            if ($livetrack_report[$i]['routename']) {
       
              ?>              
             
                <tr>
                  <th scope="row"> <?=$count_sno++;?></th>
                 <td><b><?=$livetrack_report[$i]['vehicle_name'];?></b></td>
                  <td><b><?=$livetrack_report[$i]['routename'];?></b></td>
                  <td><?php $ign_q = $this->db->query("SELECT Location_short_name FROM sch_location_list WHERE Location_id='".$livetrack_report[$i]['route_startid']."'");
                  $ign_f = $ign_q->row();
                 ?>
                     <span><b><?php echo $ign_f->Location_short_name;?></b></span><br>
                  <?php
                  
                
        $darrival_session=date("h:i:s A",strtotime($livetrack_report[$i]['route_planstart_time']));
       

        $sarrival_time=date("h:i:s A",strtotime($livetrack_report[$i]['route_exitime']));

       $time1 = new DateTime($livetrack_report[$i]['route_planstart_time']);

       $time2 = new DateTime($livetrack_report[$i]['route_exitime']);

       //     $time1 = $livetrack_report[$i]['route_planstart_time'];
       // $time2 = $livetrack_report[$i]['route_exitime'];
      $to_time = strtotime($livetrack_report[$i]['route_planstart_time']);
      $from_time = strtotime($livetrack_report[$i]['route_exitime']);
      $route_startmin =  round(abs($to_time - $from_time) / 60);

       // $timediff = $time1->diff($time2);
       // $diff = $timediff->format('%h:%i:%s');
       // $timesplit=explode(':',$diff);
       // $route_startmin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);
?> 
                  <span>P.Exit:<?php echo $darrival_session;?></span><br>
                  <span>A.Exit:<?php echo $sarrival_time;?></span><br>

                  <span style="color:#db5046;">Exit Delay:<?php  if($darrival_session > $sarrival_time){echo "--";}else{echo $route_startmin.'Mins';}?></span><br>
                  <?php if($darrival_session > $sarrival_time || $route_startmin<10){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";}?></span>
               </td>
                
                <?php
                foreach ($livetrack_report[$i]['livestop_array'] as $s_list) {

                  // for ($i=0; $i < ; $i++) { 
                  //   # code...
                  // }
              

              $ac_starttime =   date("h:i A",strtotime($s_list['stopentry_time']));
              $ac_endtime =   date("h:i A",strtotime($s_list['stopexit_time']));


                 ?>
                  <td>
                 <?php $ign_sl = $this->db->query("SELECT Location_short_name FROM sch_location_list WHERE Location_id='".$s_list['stop_geo_id']."'");
                  $ign_sf = $ign_sl->row();?>
                <b><?php echo $ign_sf->Location_short_name;?></b><br>
                  <span>ETA:<?php if($s_list['stopentry_time']){echo"<span style ='color:red;'>reach</span>";}else {echo $s_list['stop_ept_time'];}?></span><br>
                <span>P.Entry:<?php echo date("h:i A",strtotime($s_list['stopplaned_entry']));?></span><br>
                 <span>P.Exit :<?php echo date("h:i A",strtotime($s_list['stopplaned_exit']));?></span><br>
                  <span>A.Entry:<?php if($ac_starttime=='05:30 AM'){}else{echo  $ac_starttime;}?></span><br>
                 <span>A.Exit :<?php if($ac_endtime=='05:30 AM'){}else{echo  $ac_endtime;}?></span><br>

                <?php 
                  $stop_session=date("h:i:s",strtotime($s_list['stopplaned_entry']));  

              $sarrival_stop=date("h:i:s",strtotime($s_list['stopentry_time']));
              $time41=$s_list['stopentry_time'];
               $time4=new DateTime($time41);
           // stopplaned_exit
              if($sarrival_stop!='05:30:00')
              {

             $darrival_time=date("A",strtotime($stop_session));
             $time3=new DateTime($s_list['stopplaned_entry']);
         
               $timediff = $time3->diff($time4);
               $sdiff = $timediff->format('%h:%i:%s');
               $timesplit=explode(':',$sdiff);
              $stop_entrymin=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);

             }
             else
             {
              $stop_entrymin='';

             }

                
             
               $stop_exit_session= date("h:i:s",strtotime($s_list['stopplaned_exit']));
              $dispatch_stop=date("h:i:s",strtotime($s_list['stopexit_time']));
              $time51=$s_list['stopexit_time'];
               $time5=new DateTime($time51);
           // stopplaned_exit
              if($dispatch_stop!='05:30:00')
              {
      
             $time6=new DateTime($s_list['stopplaned_exit']);
       
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
                  <?php ?>
                 <?php if($s_list['a_min']){ ?>  <span style="color:green;">Hub Dur:<?php echo $s_list['a_min'].'mins';?></span><br><?php } ?>

                <span><?php if($stop_entrymin!='' && $stop_entrymin<10) { ?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}elseif ($stop_entrymin>10 || $stop_exitmin>10) {
                ?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";}elseif(($stop_entrymin<10 || $stop_exitmin<10) && $stop_exitmin!=''){ ?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid yellow;background:yellow;color:black;">Status:<?php echo "Not Reached"; }?></span>

                 </td>
              <?php } ?>
             
                  

                  <td><?php $ign_eq = $this->db->query("SELECT Location_short_name FROM sch_location_list WHERE Location_id='".$livetrack_report[$i]['route_endid']."'");
                  $ign_qf = $ign_eq->row();
                   ?>
                <span><b><?php  echo $ign_qf->Location_short_name;?></b></span><br>
                 <span>ETA:<?php if($livetrack_report[$i]['route_entry_time']) {echo"<span style ='color:red;'>reach</span>";}else{?><span style="border:1px solid yellow;background:yellow;color:black;"><?php echo "Not Reached"; }?></span><?php } ?></span><br>
            
                  <?php

       
        $darrival_session1=date("h:i:s A",strtotime($livetrack_report[$i]['route_planend_time']));
        $sarrival_time1=date("h:i:s A",strtotime($livetrack_report[$i]['route_entry_time']));

            
          $to_time1 = strtotime($livetrack_report[$i]['route_planend_time']);
        $from_time1 = strtotime($livetrack_report[$i]['route_entry_time']);
        $route_endmin =  round(abs($to_time1 - $from_time1) / 60);


         $acroute_endtime = date("h:i A",strtotime($livetrack_report[$i]['route_entry_time']));
  
?>
                   <span>P.Entry:<?php echo $darrival_session1;?></span><br>
                  <span>A.Entry:<?php if($acroute_endtime=='05:30 AM'){echo "--";}else{echo $acroute_endtime;}?></span><br>

                  <span style="color:#db5046;">Entry Delay:<?php if($livetrack_report[$i]['route_entry_time']){  if($livetrack_report[$i]['route_planend_time'] > $livetrack_report[$i]['route_entry_time']){echo "--";}else echo $route_endmin.'mins';}?></span><br>

                  <?php if($acroute_endtime!='05:30 AM'){ if($route_endmin<10 || $livetrack_report[$i]['route_planend_time'] > $livetrack_report[$i]['route_entry_time']){?><span style="border:1px solid green;background:green;color:white;">Status:<?php echo "Ontime";}else{?><span style="border:1px solid red;background:red;color:white;">Status:<?php echo "Late";} }else{?><span style="border:1px solid yellow;background:yellow;color:black;">Status:<?php echo "Not Reached";}?></span>
               
                  </td>
                 
                </tr>
              <?php      } ?>
               
            </table>

          <div>
           
                <div>
                  <?php if($nodata){ ?>
              <h4>No GPS Found Vehicles</h4>
              <ol> 
              <?php foreach ($nodata as $nlist) {
               
                ?>
                
            
             <li><b style="color:red;"><?= $nlist->vehicle_name;?></b></li>  
             <?php   } } ?> 
            
            </ol>  
            </div>
          </div>
          </div>
	        <div class="clearfix"></div>
    	</div>
 	</section>
	
</section>

<!-- main content end -->
</section>
</body>