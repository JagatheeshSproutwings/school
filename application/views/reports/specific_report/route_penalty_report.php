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
	        <h2 style="text-align: center;">Route Penalty Report</h2>

	        			<div class=" col-lg-12 col-md-12 col-sm-12 stats-info-agileits">
              				<form role="form" action="<?php echo site_url('report/route_penalty_report');?>" method="post" id="consolidate_report_overall">  
              				
              				
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
			
			<!-- <img class="loading hide" src="<?php echo base_url(); ?>/assets/dist/img/load.gif" style="padding-left: 35%;"> -->
			<?php if(isset($routetrip_report) && $routetrip_report != NULL){
				
		     			for($j=0;$j<count($routetrip_report);$j++)
				        		{
				        			
					                

				        	 ?>
	        <div class="col-lg-12 col-md-12 col-sm-12" id="consolidate_report_data" style='padding-top: 10px; margin-bottom: 10px !important;'>
	          <header class="panel-heading">
	            <?php echo $route_name= $routetrip_report[$j]['routetrip_data']->routename;?>&nbsp; -<?php echo $routetrip_report[$j]['routetrip_data']->vehicle_name;?>
	            </header>
	            

	            <div class="col-lg-12 col-md-6 col-sm-6 stats-info stats-last widget-shadow"> 
	                <table class="table table-bordered table-striped">
				        <thead>
				        	
				            <tr>
				              
				              	<th>Date</th>
				                <th>Location</th>
				                <th>Hub Delay (Rs.)</th>
				                 <th>Vehicle Delay (Rs.)</th>
				                 <th>Hub and Vehicle Delay (Rs.)</th>
				              
				               <!--  <th>Plan Hour</th>
				                <th>Actual Hour</th> -->
								
				                 
				            </tr>
				        </thead>
				        <tbody>
				        	<?php
				        	      
				        		
				        	
				        	
				            $hub_query = $this->db->query("SELECT * FROM route_penalty_details WHERE penalty_type =1");
				        	$hub_data=$hub_query->row();

				        	$veh_query = $this->db->query("SELECT * FROM route_penalty_details WHERE penalty_type =2");
				        	$veh_data=$veh_query->row();

				        	//print_r($routetrip_report[0]['routetrip_data']->route_planed_start_date);

				        	?>
				        	<tr>
				       	<td><?=date("Y-m-d",strtotime($routetrip_report[$j]['route_planstart_time']));?></td>
				       <?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$routetrip_report[$j]['route_startid']."'");
                  $ign_f = $ign_q->row();
                 ?>
				        		<td><?php echo $ign_f->Location_short_name;?></td>
				        		
				        		<td>

				        			<?php 

				        			$st_dipa=$routetrip_report[$j]['route_planstart_time'];

				        				$st_act_disp=$routetrip_report[$j]['route_exitime'];

				        				$datetime1 = new DateTime($st_dipa);
										$datetime2 = new DateTime($st_act_disp);
										$hub_de_amt='';

										if($datetime1 < $datetime2)
										{
				        			

				        			$basic_amt=$hub_data->basic_amount;
				        			$penalty=$hub_data->additional_charge;

				        			if($routetrip_report[$j]['start_min']<=10)
				        			{
				        				
				        				echo $hub_de_amt = $basic_amt;
				        				
				        			}
				        			else if($routetrip_report[$j]['start_min']>10)
				        			{
				        				$delay_min=$routetrip_report[$j]['start_min']-10;
				        				$delay_min=$delay_min/10;

				        				 $parts = explode('.', (string)$delay_min);
				        				 echo $hub_de_amt = ($parts[0]*$penalty)+$basic_amt;
				        				
				        			}
				        			else
				        			{
				        				echo "";
				        			}
				        		}
				        		else
				        		{
				        			echo "";
				        		
				        		}	?>
				        		</td>
				        
				        			<td>

				        		
				        		</td>
				        		<td><?= $hub_de_amt;?></td>
				        		
				        	</tr>

				        	<!-- stops start -->
				         	<?php $stopdata=$routetrip_report[$j]['livestop_array'];
				        	if($stopdata)
				        	{
				         	
				        	
				        		 $stop_hub_de_amt1=0;
				        		 $stop_veh_de_amt1=0;
				        		  foreach ($routetrip_report[$j]['livestop_array'] as $s_list) {

				        			

				        			$stop_hub_de_amt=0;
				        			$stop_veh_de_amt=0;

				        			 $pl_arv=$s_list['stopplaned_entry'];
				        			 $act_arv=$s_list['stopentry_time'];

				        			$pl_dip=$s_list['stopplaned_exit'];
				        			$act_dip=$s_list['stopexit_time'];
				        			?>
				        	<tr>
				        	
				        		<td></td>
				        		<?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$s_list['stop_geo_id']."'");
                  $ign_f = $ign_q->row();
                 ?>
				        		<td><?php echo $ign_f->Location_short_name;?></td>

				        	
				        		<?php if($s_list['stopentry_time']!=''){  date("h:i A",strtotime($s_list['stopentry_time'])); }?>
				        		
				        	
				        		
				        			<?php
				        			$tot_min=0; $intervalmin=0; $tot_hmin=0;
				        			 if($s_list['stopentry_time']!='')
				        			{

				        				 $datetime1 = new DateTime($pl_arv);
										 $datetime2 = new DateTime($act_arv);
									 $interval = $datetime1->diff($datetime2);
										$v_title='';
										
										if($interval->format('%H')>0)
										{	
											 $interval->format('%H:%i:%s');
											$v_title='Vehicle Delay';
											$tot_hmin=$interval->format('%H')*60;
											$intervalmin=$interval->format('%i');
										}
										else if($interval->format('%i')>0)
										{
											 $interval->format('%i:%s');
											$v_title='Vehicle Delay';

											$intervalmin=$interval->format('%i');

										}

									
									}
										   $tot_min=$tot_hmin+$intervalmin;
				        		?>
				        		
				        		
				        			<?php if($s_list['stopexit_time']!='')
				        			{
				        				$datetime1 = new DateTime($pl_dip);
										$datetime2 = new DateTime($act_dip);
										$interval = $datetime1->diff($datetime2);
										if($interval->format('%H')>0)
										{	
											 $interval->format('%H:%i:%s');
										}
										else
										{
											 $interval->format('%i:%s');
										}
									}
				        			?>

				        		
				        		
				        			<?php 

				        				$vh_title='';
				        				
				        				if($s_list['a_min']>$s_list['s_min'])
					        			{
					        				 $d=$s_list['a_min']-$s_list['s_min'];

					        				$hours = floor($d / 60);
										    $minutes = ($d % 60);
										    $delay_h = $hours.":".$minutes;
										    $vh_title='Late (Vehicle Delay & Hub Delay)';
					        			}
					        			else if($v_title=='' && ($s_list['a_min']>$s_list['s_min']))
					        			{
					        				$d=$s_list['a_min']-$s_list['s_min'];

					        				$hours = floor($d / 60);
										    $minutes = ($d % 60);
										    $delay_h = $hours.":".$minutes;
										    $vh_title='Late (Hub Delay)';
					        			}

					        			if($s_list['stopentry_time']=='')
					        			{
					        				// echo "Hub not reached";
					        			}
					        			else 
					        			{
					        				 $vh_title;
					        			}
					        			

				        			?>
				        		
				        	
				        	
				        			<?php 
				        			if($s_list['stopentry_time']!='')
					        		{

										if($datetime1 < $datetime2)
										{
					        			
					        			$basic_amt=$hub_data->basic_amount;
				        				$penalty_hub=$hub_data->additional_charge;

					        			$running_penalty=$veh_data->basic_amount;

					        			 $hub_delay=$s_list['a_min'];
					        			 $tot_min = $tot_min - $routetrip_report[$j]['start_min'];


					        		if($tot_min<=10 && $hub_delay<=10 && $tot_min > 0)
					        			{?>
					        			  <td><?php echo "--";
					        			 ?></td>

					        				<td><?php echo $stop_veh_de_amt= $running_penalty;
					        			?></td>
					        				
					        				<td>
					        				<?php 
					        				// echo "Running & Hub Delay Penalty:<br>";
					        				echo $stop_hub_de_amt + $stop_veh_de_amt;


					        				?>
					        				</td>
					        				<?php
					        			}


					        			else if($hub_delay>10 && $tot_min>10 && $tot_min > 0)
					        			{

					        				$hub_delay_min=$hub_delay-$s_list['s_min'];

					        				
				        				  $hub_delay_min=$hub_delay_min/10;
				        				  $parts = explode('.', (string)$hub_delay_min);

					        				
					        				$hub_delay_amt=($parts[0]*$penalty_hub)+$basic_amt;
					        				$v_delay_min=$tot_min-10;
					        				$v_delay_min=$v_delay_min/10;
					        				$parts = explode('.', (string)$v_delay_min);

					        				$v_delay_amt=($parts[0]*$running_penalty) + $running_penalty;
					        				 $hub_delay_amt+$v_delay_amt;


					        				
					        				?>
					        				<td><?php  echo $stop_hub_de_amt = $hub_delay_amt;
					        				 
					        				?></td>
					        				<td><?php echo $stop_veh_de_amt = $v_delay_amt;
					        				?></td>
					        				
					        					
					        				<td>
					        					<?php 
					        					echo $stop_hub_de_amt + $stop_veh_de_amt;
					        				?>
					        			</td>
					        			<?php 
					        			}

					        			else if($hub_delay>10 && $tot_min<=10 && $tot_min > 0)
					        			{
					        				$delay_min=$hub_delay-$s_list['s_min'];
					        				
					        			    	$delay_min=$delay_min/10;
                                               $parts = explode('.', (string)$delay_min);
                                    
					        				?>
					        			    <td><?php  echo $stop_hub_de_amt = ($parts[0]*$penalty_hub)+$basic_amt;
					        			  ?></td>
					        				<td><?php echo $stop_veh_de_amt = $running_penalty;
					        				?></td>
					        				<td>
					        					<?php 
					        				
					        				echo $stop_hub_de_amt + $stop_veh_de_amt;
					        				
					        				?>
					        			</td>
					        			<?php 
					        			}

					        			else if($hub_delay!=0 && $hub_delay<=10 && $tot_min>10)
					        			{
					        				
					        				
					        				 $v_delay_min=$tot_min-10;
					        				  $v_delay_min=$v_delay_min/10;
					        				  $parts = explode('.', (string)$v_delay_min);
						        				if($parts[0]!=0)
						        				{
						        					$v_delay_amt=($part[0]*$running_penalty) + $running_penalty;

						        				}
						        				else
						        				{
						        					$v_delay_amt=$running_penalty;
						        				}
					        				
					        				 $v_delay_amt;
					        			
					        				?>
					        				<td></td>
					        				<td>
					        				<?php
					        				  
					        				
					        				  $v_delay_min=$tot_min-10;
					        				 $v_delay_min=$v_delay_min/10;
					        				  $parts = explode('.', (string)$v_delay_min);
					        				 $v_delay_amt=($parts[0]*$running_penalty) + $running_penalty;
					        				echo $stop_veh_de_amt = $v_delay_amt;

					        				
					        				
					        				?>
					        				</td>
					        				<td>
					        					<?=$stop_veh_de_amt;?>
					        				</td>
					        				<?php 
					        			}
					        			else if($hub_delay==0 && $tot_min<=10)
					        			{?>
					        				<td></td>
					        				<td>
					        			    	<?php
					        				// echo "Running Delay Penalty:<br>";

					        				echo $stop_veh_de_amt = $running_penalty;
					        				
					        				?>
					        			</td>
					        			<td>
					        				<?=$stop_veh_de_amt;?>
					        			</td>
					        				<?php
					        			}

					        			else if($hub_delay > 10)
					        			{


					        				$hub_delay_min=$hub_delay-$s_list['s_min'];
					        			    $hub_delay_min=$hub_delay_min/10;
					        			    $parts = explode('.', (string)$hub_delay_min);

					        				$hub_delay_amt=($parts[0]*$penalty_hub)+ $basic_amt;
					        				 ?>
					        		
					        				<td>

					        					<?php 
					        					//print_r($hub_delay);
					        				//echo $s_list['a_min']- $s_list['s_min'];
					        				echo $stop_hub_de_amt = $hub_delay_amt;

					        			
					        				
					        				?>
					        				</td>
					        				<td></td>
					        				<td><?= $stop_hub_de_amt?></td>
					        				<?php 
					        			}
					        			else
					        			{ ?>
					        				<td></td>
					        			<td></td>
					        			<td></td>
					        		<?php	}
					        		}
					        		else
					        		{ ?>
					        			<td></td>
					        			<td></td>
					        			<td></td>

					        	<?php	}

					        	}
					        		else
					        		{?>
					        			<td></td>
					        			<td></td>
					        			<td></td>

					        		<?php

					        		}


				        			?>
				        		
				        	</tr>
				        	<?php 
				        	  $stop_hub_de_amt1=$stop_hub_de_amt1 + $stop_hub_de_amt;

				        	  $stop_veh_de_amt1=$stop_veh_de_amt1 + $stop_veh_de_amt;


				        	  }

				        	  

				        	    


				        	
				        	
				        	?>
				        <?php }?> 
				        	<!-- stops end -->

				        	<tr>
				        		<td><?=date("Y-m-d",strtotime($routetrip_report[$j]['route_planend_time']));?></td>
				        		<?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$routetrip_report[$j]['route_endid']."'");
                  $ign_f = $ign_q->row();
                 ?>
				        		<td><?php echo $ign_f->Location_short_name;?></td>
				        		<td></td>
				        		<td>
				        			<?php 
				        			$veh_de_amt='';
				        			$running_penalty=$veh_data->basic_amount;
				        			 $total_mins = $routetrip_report[$j]['end_min'] - $routetrip_report[$j]['start_min'];
				        			if($total_mins>10)
				        			{

				        				$delay_min=$total_mins-10;

				        				$delay_min=$delay_min/10;
					        			$parts = explode('.', (string)$delay_min);
				        				 if($parts[1]==0)
				        				 {
				        				 	echo $veh_de_amt = ($parts[0]*$running_penalty);

				        				 }
				        				 else
				        				 {
				        				 	echo $veh_de_amt = ($parts[0]*$running_penalty) + $running_penalty;
				        				 }
				        				
				        					

				        			}
				        			else
				        			{
				        				echo "";
				        			}
				        			?>
				        		</td>
				        		<td><?= $veh_de_amt;?></td>
				        	</tr>
				        	<?php
				            	$sum_hub_de_amt = $stop_hub_de_amt1 +  $hub_de_amt;
				        	   $sum_veh_de_amt = $stop_veh_de_amt1 +  $veh_de_amt;//hub delay amt
				        	?>
				        	<tr>
				        		<td colspan="2"></td>
				        	

				        			<td><b>Hub Total Penalty: Rs.</b><?=$sum_hub_de_amt;?></td>

				        		<td><b>Vehicle Total Penalty: Rs.</b><?php echo $sum_veh_de_amt;?></td>

				        		<td><b>Grand Total: Rs.</b><?php echo  $sum_hub_de_amt + $sum_veh_de_amt;?></td>
				        	
				        		
				        	</tr>

				     
<!-- end point end-->
				        </tbody>
				    </table>
	        	</div>
	    	</div> 

	    <?php //}elseif($this->session->flashdata('route_id')!=''){?>
	    	<!-- <div class="col-lg-12 col-md-12 col-sm-12" style='text-align: center; color: red; font-weight: bold; padding-top: 10px; margin-bottom: 10px !important;'>	
	    		No Data Found...
	    	</div> -->

	    <?php 
	}
}?>
	   

	        <div class="clearfix"></div>
    	</div>
 	</section>
	

</section>

<!-- main content end -->
</section>
</body>

	<script src="<?php echo base_url();?>/assets/plugins/moment.js"> </script>
	<script src="<?php echo base_url();?>/assets/plugins/timepicker.js"> </script>
	<link rel="stylesheet" ahref="<?php echo base_url();?>/assets/plugins/timepicker.css" type='text/css'>
    
    <script type="text/javascript">

	    $(function () {
	       $( "#datetimepicker1" ).datetimepicker({ maxDate: new Date() });
			   $( "#datetimepicker2" ).datetimepicker({  maxDate: new Date() });
	    });

	   function viewhide()
	   	{
	   		var route_id = $("#route_id").val();	

	   		if(route_id!='')
	   		{
	   			$(".vxl").removeClass('hide');
	   			
	   		}
	   		else
	   		{
	   			$(".vxl").addClass('hide');
	   		}
	   	}

	   	$("#consolidate_report_overall").submit(function(e){
    	var route_id = $("#route_id").val();	
	   	var travel_date = $("#travel_date").val();	
	   	var report_option = $("#report_option").val();


		if(travel_date!='' && route_id!='' && report_option!='')
		{
					if(report_option=='xl')
					{ 
						var url='<?php echo site_url('/report/consolidate_overallreport_excel/');?>?route_id='+route_id+'&travel_date='+travel_date;
        				window.open(url);
        				return false;
					}
					else
					{
						$(".loading").removeClass('hide');
						$("#consolidate_report_data").addClass('hide');
						return true;
					}
		}
		else
		{
			alert("Please Select All fields");
			return false;
		}
});

	 
	</script>


	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
	$( document ).ready(function() {
	$('.js-example-basic-multiple').select2();
	$(".js-example-basic-multiple").select2({
    placeholder: "Select Vehicle"
});

});

</script>


     <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.css">
  <script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url();?>/assets/plugins/datepicker1/jquery-ui.js"></script>
    
    <script type="text/javascript">
      $( function() {
      $( "#travel_date" ).datepicker();
    } );

    </script>