<style>
/*          .table td, .table th{
          padding: 10px !important;
      }*/
</style>      
<div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab1">
                            <div class="iframe-container">
                               <section id="column-selectors">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header" style="padding-bottom: 0;">
					<h4 class="card-title">All Vehicles</h4>
					<a class="heading-elements-toggle">
						<i class="fa fa-ellipsis-v font-medium-3"></i>
					</a>
<!--					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li>
								<a data-action="collapse">
									<i class="feather icon-minus"></i>
								</a>
							</li>
							<li>
								<a data-action="reload">
									<i class="feather icon-rotate-cw"></i>
								</a>
							</li>
							<li>
								<a data-action="expand">
									<i class="feather icon-maximize"></i>
								</a>
							</li>
							<li>
								<a data-action="close">
									<i class="feather icon-x"></i>
								</a>
							</li>
						</ul>
					</div>-->
				</div>
				<div class="card-content collapse show">
					<div class="card-body card-dashboard">

						<table id="allvehicles" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Vehicle Model Name</th>
									<th>Device IMEI</th>
									<th>Device Model</th>
									<th>Sim number</th>
									<th>Network</th>
									<th>Expire Date</th>
									<!--<th>Vehicle Status</th>-->
								
								</tr>
							</thead>
							<tbody>
								<?php 
 										$count = 1;
								foreach ($all_vehicle_loc as $vlist) { ?>
									
							
								<tr>
									<td><?php echo $count++;?></td>
									<td><?php echo $vlist->vehiclename;?></td>
									<td><?php echo $vlist->deviceimei;?></td>
									<?php $device_query = $this->db->query("SELECT device_model FROM devicetbl WHERE deviceimei = '".$vlist->deviceimei."'");
                                           $device_data = $device_query->row();?>
                                   
                                    <td><?php echo $device_data->device_model;?></td>
									<td><?php echo $vlist->simnumber;?></td>
									<?php $sim_query = $this->db->query("SELECT networkprovider FROM simtbl WHERE simnumber = '".$vlist->simnumber."'");
                                           $sim_data = $sim_query->row();?>

                                    <td><?php echo $sim_data->networkprovider;?></td>
									<td><?php echo $vlist->expiredate;?></td>

								
								</tr>
								
									<?php } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
                     
                            </div>
                              <!--=====================================bottom data=======================================-->         
              
                <!--=================================================================-->     
                        </div>
                 <!-- END: Content-->
    <script>

$(document).ready(function() {
        $('#allvehicles').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>           