<!-- Content Wrapper. Contains page content -->

<?php $role = ($this->session->userdata['role']); ?>
<?php $client_id = ($this->session->userdata['client_id']); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
<section id="container">
	
	<!--main content start-->
	<section id="main-content">
	    <section class="wrapper">
	        <div class="w3-agile-google_map">


	        	<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 15px !important;">

					<h2>Zigma Trip Report &nbsp;<i class="fa fa-road"></i></h2> 
					
					<!-- START OF SEARCH PANNEL -->
          			<div class=" col-lg-12 col-md-12 col-sm-12 stats-info-agileits">
          				<form id="tripcancellationForm"  action="<?php echo site_url('location/zigmaplan_report_data')?>" method="post">  
          				
          				
          				<div class="col-sm-6 col-md-6 col-lg-2">
					        <div class="form-group">
					            <div class='input-group date' id='datetimepicker1'>
					                <input type='text' placeholder='Select From Date...' autocomplete='off'  class="form-control" name="from_Date" id="from_Date" value="<?=$this->session->flashdata('form_date');?>" required/><span id='from_Date-error' class="error" id=''></span>
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>

          				<div class="col-sm-6 col-md-6 col-lg-2">
					        <div class="form-group">
					            <div class='input-group date ' id='datetimepicker2'>
					                <input type='text' placeholder='Select To Date...' autocomplete='off'  class="form-control" name="to_Date" id="to_Date" value="<?=$this->session->flashdata('to_date');?>" required/><span id='to_Date-error' class="error" id=''></span>
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>

          				<div class="col-sm-6 col-md-6 col-lg-2">
				        	<div class="form-group">
							<select id="status" name="status" class="form-control" required>
						              <option value="">Select Status</option>
						               <option value="1" <?php if ($this->session->flashdata('status')=='1'){echo "selected" ;} ?>>Progressing</option>
						               <option value="2" <?php if ($this->session->flashdata('status')=='2'){echo "selected" ;} ?>>Completed</option>
						            
		           				</select>
		           			</div>
					    </div>

					   
          				<div class="col-sm-6 col-md-6 col-lg-2">
					        <div class="form-group">
					            <div class='input-group date '>
        							<button type="submit" class="btn bg-navy pull-left search-button">Search</button>
									<input type="hidden" id="current_date" value="<?php echo date("m/d/Y"); ?>">
					            </div>
					        </div>
					    </div>
					
					</div>


					 
		            <div class="col-lg-7 col-md-6 col-sm-6  stats-info stats-last widget-shadow"  style=' margin-top: 10px; overflow-y:auto; height:72vh; background-color:#ddd !important; '>
		              <header class="panel-heading" style="padding-top: inherit;">Zigma Trip Report
		          
		              </header>
		              <div style="overflow-x: auto !important; padding-right:35px !important;">

			          	<div id="load" class="hide" style="text-align: center; color: #F00;"><b> Data Loading...</b></div>
			          	<div id="no_data" class="hide" style="text-align: center; color: #F00;"><b> No Data Found!</b></div>
			          	

			          		<table id='example1' class='table table-bordered table-striped stats-info stats-last widget-shadow'  style='margin: 15px !important;'>
			          			<thead>
			          				<tr>
			          					<th >S No</th>
			          					<th >Trip Id</th>
			          					<th >Vehicle Name</th>
			          					<th >End geo location</th>
			          					<th >Start Location</th>
			          					<th >End Location</th>
			          					<th >Status</th></tr>
			          					</thead>
			          					 <tbody class='tbody' id='tbody'>
			          					 	<?php  
			          					 	$count =1;
			          					 	foreach ($zigmatrip_report as $list) { ?>

			          					 		<tr>
			          					 			  <td><?=$count++;?></td>
			          					 				<td><?=$list->trip_id;?></td>
			          					 				<td><?=$list->vehicle_name;?></td>
			          					 				<td><?=$list->Location_short_name;?></td>
			          					 				<td><?=$list->start_location;?></td>
			          					 				<td><?=$list->end_location;?></td>
			          					 				<td><?php if($list->flag=='1'){ ?> <a id='MybtnModal' class='btn btn-primary' onclick="location_list('<?php echo $list->e_lat.','.$list->e_lng?>');">Progressing</a> <?php } else { ?><a  class='btn btn-success' onclick="location_list('<?php echo $list->e_lat.','.$list->e_lng?>');">Completed</a>

			          					 			<?php	} ?>
			          					 					
			          					 				</td>
			          					 		</tr>
			          				  <?php 	} ?>
			          					 </tbody>

                    	
				         </table>

						</div>

					</div>
					<div class="col-lg-5">
							 <div id="zigma_map" class="map-all" style="height:60vh !important;" ></div>
					</div>

				
	<!-- .modal -->
	<!-- <div class="modal fade" id="Mymodal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button> 
					<h4 class="modal-title">Notification</h4>                                                             
				</div> 
				<div class="modal-body">
				
				</div>   
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                               
				</div>
			</div>                                                                       
		</div>                                          
	</div> -->

						
				</div>

            <div class="clearfix"></div>
		    </div>

		    <!-- Button to trigger modal -->
 


	 	</section>
	 	<!-- footer -->
	    <div class="footer clearfix">
	        <div class="wthree-copyright">
				<?php  $this->load->view('components/tfooter'); ?>
	        </div>
	    </div>
	 	 <!-- / footer -->
	</section>
	<!-- main content end -->

 </section>
</div>



<!-- DATE PICKER PLUGINS BEGIN -->

	<script src="<?php echo base_url();?>/assets/plugins/moment.js"> </script>
	<script src="<?php echo base_url();?>/assets/plugins/timepicker.js"> </script>
	<link rel="stylesheet" ahref="<?php echo base_url();?>/assets/plugins/timepicker.css" type='text/css'>
    
    <script type="text/javascript">
	    $(function () {
	       $( "#datetimepicker1" ).datetimepicker({ maxDate: new Date() });
			   $( "#datetimepicker2" ).datetimepicker({  maxDate: new Date() });
	    });
	</script>
<!-- DATE PICKER PLUGINS END -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/osm/leaflet.css"/>
<script src="<?php echo base_url();?>assets/plugins/osm/leaflet.js"></script> 
    <script src="<?php echo base_url();?>assets/plugins/osm/leaflet.rotatedMarker.js"></script>

  <script>

var marker = {};
 var map = L.map('zigma_map').setView([12.94987505,80.23006433],6);
    L.tileLayer('http://198.204.245.190/osm/{z}/{x}/{y}.png',{maxZoom:18}).addTo(map);
   var fg = L.featureGroup().addTo(map);

   function location_list(latlng) {

   	if (marker != undefined) {
              map.removeLayer(marker);
            };

	var map_params = latlng.split(',');

	var s_lat = map_params[0] ;
	var s_lng = map_params[1];
	
   var startCoords= [s_lat,s_lng];

     var mark_img = '<?php echo base_url(); ?>assets/dist/img/icon/marker_loc.png';


		                var redIcon = new L.Icon({
				          iconUrl: mark_img
				        });

				            marker = L.marker(startCoords,{icon: redIcon}).addTo(map);


				        map.addLayer(marker);

				         var group = new L.featureGroup([marker]);

				      map.fitBounds(group.getBounds());
				     marker.bindPopup('Vehicle').openPopup();



   }
 </script>
