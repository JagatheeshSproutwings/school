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
	        <h2 style="text-align:center;">Consolidate Route Report</h2>

	        			<div class=" col-lg-12 col-md-12 col-sm-12 stats-info-agileits">
              				<form role="form" action="<?php echo site_url('report/consolidate_route_report');?>" method="post" id="consolidate_report_overall">  
              				<div class="row">
              				
              				<div class="col-sm-6 col-md-6 col-lg-2">
						        <div class="form-group">
						            <div class='input-group'>
						                 <input type="date" class="form-control" placeholder="Choose travel date" name="travel_date" autocomplete="off" value="<?php if(!empty($this->session->flashdata('travel_date'))){ echo date("Y-m-d",strtotime($this->session->flashdata('travel_date')));}?>" required>
						            </div>
						        </div>
						    </div>
 
           				

              				<div class="col-sm-6 col-md-6 col-lg-2">
						        <div class="form-group">
						            <div class='input-group date '>
            							<button type="submit" id='' class="btn btn-success">Search</button>
            							<input type="hidden" id="report_opt" value="<?php echo $this->session->flashdata('report_option');?>">
						            </div>
						        </div>
						    </div>
						</div>
						  </form>
			
			<img class="loading hidden" src="<?php echo base_url(); ?>/assets/dist/img/load.gif" style="padding-left: 35%;">

			<?php if(isset($routetrip_report) && $routetrip_report != NULL){
				?>
		
	        <div class="col-lg-12 col-md-12 col-sm-12" id="" style='padding-top: 10px; margin-bottom: 10px !important;'>
	          <header class="panel-heading">
	             <?php //echo date("d-m-Y",strtotime($this->session->flashdata('travel_date')));?> 
	            </header>
	             <div class="col-lg-12 col-md-6 col-sm-6 stats-info stats-last widget-shadow"> 
	                <table class="table table-striped table-bordered dataex-html5-export">
	                	<!-- dataex-html5-export -->
				        <thead>
				        	<tr>
				        		<th colspan="10" style="text-align: center;">Hub Dispatch</th>
				        		<th rowspan="1">Remarks</th> 
				        		<th rowspan="1" style="text-align: left;">Penalty (Rs.)</th> 
				        	</tr>
				            <tr>
				                <th>Date</th>
				                <th>Vehicle</th>
				                <th>Location</th>
				                
				                <th>Schedule Arrival Time</th>
				                <th >Actual Arrival Time</th>
				                <th width="5px">Arrival Variance (H:M:S)</th>
				                <th>Hub In Dur (mins)</th>
				                <th width="6px">Schedule Dispatch Time</th>
				                <th>Actual Dispatch Time</th>
				                <th width="5px">Dispatch Variance (H:M:S)</th>
				               <!--  <th>Plan Hour</th>
				                <th>Actual Hour</th> -->
								
				                 
				            </tr>
				        </thead>
				        <tbody>
	            	<?php 

			for($j=0;$j<count($routetrip_report);$j++)
				        		{
				        			
					                

				        	  ?>
				        	 <!--   <tr><th colspan="11" style="text-align: center;"><?php echo $route_name= $routetrip_report[$j]['routetrip_data']->route_startloc_name. '-' .$routetrip_report[$j]['routetrip_data']->route_endloc_name;?> </th></tr>  -->
	           
				        	<!-- <tr><th colspan="11" style="text-align: center;">Hub </th></tr> -->
				        	<?php echo  $hub_query = $this->db->query("SELECT * FROM route_penalty_details WHERE penalty_type =1");
				        	$hub_data=$hub_query->row();

				        	$veh_query = $this->db->query("SELECT * FROM route_penalty_details WHERE penalty_type =2");
				        	$veh_data=$veh_query->row();

				        	//print_r($routetrip_report[0]['routetrip_data']->route_planstart_time);

				        	//foreach ($routetrip_report as $rlist) 
					        	//{

				        	?>

				        	<tr>
				        		<td><?=date("Y-m-d",strtotime($routetrip_report[$j]['route_planstart_time']));?></td>
				        		<td><?=$routetrip_report[$j]['vehicle_name'];?></td>
				        		   <?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$routetrip_report[$j]['route_startid']."'");
                  $ign_f = $ign_q->row();
                 ?>
				        		<td><?php echo $ign_f->Location_short_name;?></td>
				        		<td></td>
				        		<td></td>
				        		<td></td>
				        		<td></td>
				        		<td><?=date("h:i A",strtotime($routetrip_report[$j]['route_planstart_time']));?></td>
				        		<td><?=date("h:i A",strtotime($routetrip_report[$j]['route_exitime']));?></td>
				        		<td>
				        			<?php
				        				$st_dipa=$routetrip_report[$j]['route_planstart_time'];

				        				$st_act_disp=$routetrip_report[$j]['route_exitime'];

				        				$datetime1 = new DateTime($st_dipa);
										$datetime2 = new DateTime($st_act_disp);
										if($datetime1 < $datetime2)
										{

										$interval = $datetime1->diff($datetime2);
										$title='';
										if($interval->format('%H')>0)
										{	
											echo $interval->format('%H:%i:%s');
											$title='Hub Delay';
										}
										else if($interval->format('%i')>0)
										{
											echo $interval->format('%i:%s');
											$title='Hub Delay';
										}
									}
									else
									{
										echo "--:--";
										$title =  "Advance";
									}

				        			?>
				        		</td>
				        		<td>
				        			<?php 

					        			if(strtotime($routetrip_report[$j]['route_planstart_time'])<strtotime($routetrip_report[$j]['route_exitime']))
					        			{
					        				echo "Late ($title)";
					        			}
					        			else
					        			{
					        				echo "Advance";
					        			}

				        			?>
				        		</td>
				        		<td>
				        			<?php 
				        			$basic_amt=$hub_data->basic_amount;
				        			$penalty=$hub_data->additional_charge;
				        			if($datetime1 < $datetime2)
										{
				        			if($routetrip_report[$j]['start_min']<=10)
				        			{
				        				echo "Hub Delay Penalty:<br>";
				        				echo $basic_amt;
				        			}
				        			else if($routetrip_report[$j]['start_min']>10)
				        			{
				        				$delay_min=$routetrip_report[$j]['start_min']-10;

				        				$delay_min=$delay_min/10;
					        			$parts = explode('.', (string)$delay_min);

				        				//$delay_min=round($delay_min/10);
				        				echo "Hub Delay Penalty:<br>";
				        				echo ($parts[0]*$penalty)+$basic_amt;
				        			}
				        			else
				        			{
				        				echo "No Penalty";
				        			}
				        		}
				        		else
				        		{
				        			echo "No Penalty";
				        		} ?>
				        		</td>
				        	</tr>

				        	<!-- stops start -->
				        	<?php $stopdata=$routetrip_report[$j]['livestop_array'];
				        	if($stopdata)
				        	{

				        		    foreach ($routetrip_report[$j]['livestop_array'] as $s_list) {

				        			 $pl_arv=$s_list['stopplaned_entry'];
				        			 $act_arv=$s_list['stopentry_time'];

				        			$pl_dip=$s_list['stopplaned_exit'];
				        			$act_dip=$s_list['stopexit_time'];

				        			?>
				        	<tr>
				        		<td><?=date("Y-m-d",strtotime($pl_arv));?></td>
				        		<td><?=$routetrip_report[$j]['vehicle_name'];?></td>
				        		 <?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$s_list['stop_geo_id']."'");
                  $ign_f = $ign_q->row();
                 ?>
				        		<td><?php echo $ign_f->Location_short_name;?></td>

				        		<td><?=date("h:i A",strtotime($s_list['stopplaned_entry']));?></td>
				        		<td><?php if($s_list['stopentry_time']!=''){ echo date("h:i A",strtotime($s_list['stopentry_time'])); }?></td>
				        		<td>
				        			<?php
				        			$tot_min=0;
				        			 if($s_list['stopentry_time']!='')
				        			{
				        				$datetime1 = new DateTime($pl_arv);
										$datetime2 = new DateTime($act_arv);
										 $interval = $datetime1->diff($datetime2);
										$v_title='';
										
										if($datetime1 < $datetime2)
										{
											if($interval->format('%H')>0)
											{	
												echo $interval->format('%H:%i:%s');
												$v_title='Vehicle Delay';
												$tot_hmin=$interval->format('%H')*60;
											}
											else if($interval->format('%i')>0)
											{
												echo $interval->format('%i:%s');
												$v_title='Vehicle Delay';

											}
										}
										else
										{
											echo '--:--';
											$v_title='Advance';

										}
									

									
									}
										  $tot_min=$tot_hmin+$interval->format('%i');
				        		?></td>
				        			<td><?php if($s_list['a_min']){ ?><?=$s_list['a_min'].' mins';?><?php } ?></td>
				        		<td><?=date("h:i A",strtotime($s_list['stopplaned_exit']));?></td>
				        		<td><?php if($s_list['stopexit_time']!=''){ echo date("h:i A",strtotime($s_list['stopexit_time'])); }
				        		?></td>
				        		<td>
				        			<?php if($s_list['stopexit_time']!='')
				        			{
				        				$datetime1 = new DateTime($pl_dip);
										$datetime2 = new DateTime($act_dip);
										$interval = $datetime1->diff($datetime2);

										if($datetime1 < $datetime2)
										{
										if($interval->format('%H')>0)
										{	
											echo $interval->format('%H:%i:%s');
										}
										else
										{
											echo $interval->format('%i:%s');
										}
									}
									else
									{
										echo "--:--";
										$v_title='Advance';

									}

									}
				        			?>

				        		</td>
				        		<td>
				        			<?php 

				        				$vh_title='';
				        				if($datetime1 < $datetime2)
										{

				        				if($s_list['a_min'] > $s_list['s_min'])
					        			{
					        				$d=$s_list['a_min']-$s_list['s_min'];

					        			if($s_list['a_min'] >=10)
					        			{
					        				$hours = floor($d / 60);
										    $minutes = ($d % 60);
										    $delay_h = $hours.":".$minutes;
										    $vh_title='Late (Vehicle Delay & Hub Delay)';
					        			}
					        			
					        				
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
					        				echo "Hub not reached";
					        			}
					        			
					        		}
					        		elseif ($s_list['stopentry_time']=='')
					        			{
					        				echo "Hub not reached";
					        	    	}
					        	    	else
					        		{
					        			echo "Advance";
					        		}

				        			?>
				        		</td>
				        		<td>
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
					        			{
					        				echo "Running  Delay Penalty:<br>";
					        				echo $running_penalty;
					        			}
					        			else if($hub_delay>10 && $tot_min>10 && $tot_min > 0)
					        			{
					        				$hub_delay_min=$hub_delay-$s_list['s_min'];

					        				
					        				  $hub_delay_min=$hub_delay_min/10;
					        				  $parts = explode('.', (string)$hub_delay_min);

					        				echo "Running & Hub Delay Penalty:<br>";
					        				$hub_delay_amt=($parts[0]*$penalty_hub)+$basic_amt;
					        				$v_delay_min=$tot_min-10;
					        				$v_delay_min=$v_delay_min/10;
					        				$parts = explode('.', (string)$v_delay_min);

					        				$v_delay_amt=($parts[0]*$running_penalty) + $running_penalty;
					        				echo $hub_delay_amt+$v_delay_amt;
					        			}
					        			else if($hub_delay>10 && $tot_min<=10 && $tot_min > 0)
					        			{
					        				$delay_min=$hub_delay-$s_list['s_min'];
					        				//if($delay_min<0){$delay_min=$delay_min*-1;}

					        			    	 $delay_min=$delay_min/10;
                                               $parts = explode('.', (string)$delay_min);
                                             //   print_r($parts);
					        				echo "Running & Hub Delay Penalty:<br>";
					        				echo ($parts[0]*$penalty_hub)+$basic_amt+$running_penalty;
					        			}
					        			else if($hub_delay!=0 && $hub_delay<=10 && $tot_min>10)
					        			{
					        				
					        				echo "Running Delay Penalty:<br>";
					        				// $hub_delay_amt=$basic_amt;
					        				 $v_delay_min=$tot_min-10;
					        				  $v_delay_min=$v_delay_min/10;
					        				  $parts = explode('.', (string)$v_delay_min);
					        				 // print_r($parts);
					        				//echo "<br>";
					        				if($parts[0]!=0)
					        				{
					        					$v_delay_amt=($part[0]*$running_penalty) + $running_penalty;

					        				}
					        				else
					        				{
					        					$v_delay_amt=$running_penalty;
					        				}
					        				
					        				echo $v_delay_amt;
					        			}
					        			else if($hub_delay==0 && $tot_min<=10)
					        			{
					        				echo "Running Delay Penalty:<br>";
					        				echo $running_penalty;
					        			}
					        			// else if($hub_delay<=10)
					        			// {
					        			// 	echo "Hub Delay Penalty:<br>";
					        			// 	echo $basic_amt;
					        			// }

					        			else if($hub_delay > 10)
					        			{


					        				$hub_delay_min=$hub_delay-$s_list['s_min'];
					        			    $hub_delay_min=$hub_delay_min/10;
					        			    $parts = explode('.', (string)$hub_delay_min);

					        				$hub_delay_amt=($parts[0]*$penalty_hub)+$basic_amt;
					        				echo "Hub Delay Penalty:<br>";
					        				echo $hub_delay_amt;
					        			}


					        			else
					        			{
					        				echo "No Penalty";
					        			}
					        	

					        		}
					        		else
					        		{
					        			echo "No Penalty";
					        		}
					        	}

				        			?>
				        		</td>
				        	</tr>
				        	<?php }?>
				        <?php }?>
				        	<!-- stops end -->

				        	<tr>
				        		<td><?=date("Y-m-d",strtotime($routetrip_report[$j]['route_planend_time']));?></td>
				        		<td><?=$routetrip_report[$j]['vehicle_name'];?></td>
				        		   <?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$routetrip_report[$j]['route_endid']."'");
					                  $ign_f = $ign_q->row();
					                 ?>
				        		<td><?php echo $ign_f->Location_short_name;?></td>
				        		<td><?=date("h:i A",strtotime($routetrip_report[$j]['route_planend_time']));?></td>
				        		<td><?php if(!empty($routetrip_report[$j]['route_entry_time'])){ echo date("h:i A",strtotime($routetrip_report[$j]['route_entry_time']));}?></td>
				        		<td>
				        			<?php
				        				$st_dipa=$routetrip_report[$j]['route_planend_time'];

				        				 $st_act_disp=$routetrip_report[$j]['route_entry_time'];

				        				 if(!empty($st_act_disp=$routetrip_report[$j]['route_entry_time']))
				        				 {



				        				$datetime1 = new DateTime($st_dipa);
										$datetime2 = new DateTime($st_act_disp);
									   $interval = $datetime1->diff($datetime2);

									   if($datetime1 < $datetime2)
										{

												$title='';
												if($interval->format('%H')>0)
												{	
													echo $interval->format('%H:%i:%s');
													$title='Vehicle Delay';
												}
												else if($interval->format('%i')>0)
												{
													echo $interval->format('%i:%s');
													$title='Vehicle Delay';
												}
										 }
										
										else
										{
											$title='No Penalty';
										}
									}
				        			?>
				        		</td>
				        		<td></td>
				        		<td></td>
				        		<td></td>
				        		<td></td>
				        		<td>
				        			<?php 
				        				if(($routetrip_report[$j]['route_entry_time'])=='')

											{
												echo "Hub Not reached";
											}
					        			else if(strtotime($routetrip_report[$j]['route_planend_time'])<strtotime($routetrip_report[$j]['route_entry_time']))
					        			{
					        				echo "Late ($title)";
					        			}
					        			else
					        			{
					        				echo "Advance";
					        			}

				        			?>
				        		</td>
				        		<td>
				        			<?php 
				        			$running_penalty=$veh_data->basic_amount;

				        			 $total_mins = $routetrip_report[$j]['routetrip_data']->end_min - $routetrip_report[$j]['routetrip_data']->start_min;
				        			if($total_mins>10)
				        			{
				        				$delay_min=$total_mins-10;

				        				$delay_min=$delay_min/10;
					        			$parts = explode('.', (string)$delay_min);
				        				
				        				echo "Running Delay:<br>";
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
				        				echo "No Penalty";
				        			}
				        			?>
				        		</td>
				        	</tr>
				    

				        <?php }?>
<!-- end point end-->
				        </tbody>
				    </table>
	        	</div>
	    	</div> 

	    <?php //}elseif($this->session->flashdata('route_id')!=''){?>
	    	<!-- <div class="col-lg-12 col-md-12 col-sm-12" style='text-align: center; color: red; font-weight: bold; padding-top: 10px; margin-bottom: 10px !important;'>	
	    		No Data Found...
	    	</div> -->

	    <?php }?>
	   

	        <div class="clearfix"></div>
    	</div>
 	</section>
	
</section>

<!-- main content end -->
</section>
</body>
