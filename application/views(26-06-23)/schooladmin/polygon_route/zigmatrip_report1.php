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
          				<form id="tripcancellationForm"  action="<?php echo site_url('location/polygon_area_excel')?>" method="post">  
          				
          				
          				<div class="col-sm-6 col-md-6 col-lg-2">
					        <div class="form-group">
					            <div class='input-group date' id='datetimepicker1'>
					                <input type='text' placeholder='Select From Date...' autocomplete='off'  class="form-control" name="from_Date" id="from_Date" value="<?=$this->session->flashdata('from_date');?>" required/><span id='from_Date-error' class="error" id=''></span>
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
						               <option value="1">Progressing</option>
						               <option value="2">Completed</option>
						            
		           				</select>
		           			</div>
					    </div>

					   
          				<div class="col-sm-6 col-md-6 col-lg-2">
					        <div class="form-group">
					            <div class='input-group date '>
        							<button type="button" id='polygon_report' class="btn bg-navy pull-left search-button">Search</button>
									<input type="hidden" id="current_date" value="<?php echo date("m/d/Y"); ?>">
					            </div>
					        </div>
					    </div>
					
					</div>


					 
		            <div class="col-lg-12 col-md-6 col-sm-6  stats-info stats-last widget-shadow"  style=' margin-top: 10px; overflow-y:auto; height:72vh; background-color:#ddd !important; '>
		              <header class="panel-heading">Zigma Trip Report
		          
		              </header>
		              <div style="overflow-x: auto !important; padding-right:35px !important;">

			          	<div id="load" class="hide" style="text-align: center; color: #F00;"><b> Data Loading...</b></div>
			          	<div id="no_data" class="hide" style="text-align: center; color: #F00;"><b> No Data Found!</b></div>
			          	<div id="new_table">
                    	
				          </div>

						</div>

					</div>
						
				</div>

            <div class="clearfix"></div>
		    </div>

		    <!-- Button to trigger modal -->
 


	 	</section>
	 	<!-- footer -->
	    <div class="footer clearfix">
	        <div class="wthree-copyright">
				<?php $this->load->view('components/tfooter'); ?>
	        </div>
	    </div>
	 	 <!-- / footer -->
	</section>
	<!-- main content end -->

 </section>

<script type="text/javascript">
	
$(document).ready(function(){

	$('#MybtnModal').click(function(){
			alert('hi');
			
		$('#Mymodal').modal('show')
	});
});

</script>

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

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

<script type="text/javascript">


 $("#polygon_report").click(function()
 {

	var $=jQuery;
	var status = $("#status").val();
	var from_date = $("#from_Date").val();
	var to_date = $("#to_Date").val();

	$("#e_from").val(from_date);
	$("#e_to").val(to_date);
	// $("#e_vehicle").val(vehicle);
	// $("#e_location").val(location_name);


	  var day1 = new Date(from_date);
	  var day2 = new Date(to_date);
	  var diff  = new Date(day2 - day1);
	  var days  = diff/1000/60/60/24;
	  console.log(days);
	  
	   
   
 	if(from_date == '' && to_date== '')
	{
		$("#from_Date-error").html("Required...");
		$("#to_Date-error").html("Required...");
	}
	
	if(from_date == '')
	{
		$("#from_Date-error").html("Required...");
		return false;
	}
	else
	{
		$("#from_Date-error").html("");
	}
	if(to_date == '')
	{
		$("#to_Date-error").html("Required...");
		return false;
	}

	   else
	    {
	        $("#from_Date-error").html(" ");
	        $("#to_Date-error").html(" ");
	        $("#vehicle-error").html(" ");

	        if(days > 30)
	        {
	          $("#to_Date-error").html("Please Select any 30 Days...");
	          return false;
	          //$("#submit").prop('disabled',true);
	        }
	        else if(days <= 0)
	        {
	          $("#to_Date-error").html("End Date Should be Greater...");
	          return false;
	          //$("#submit").prop('disabled',true);
	        }
	        else
	        {
	        	$("#load").removeClass('hide');
	        	$("#no_data").addClass('hide');
	        	$(".search-button").prop('disabled',true);
			//	console.log(from_date+to_date+location_name+vehicle);
				var count=1;
				$.ajax({
				    url:'<?php echo site_url('/location/zigmaplan_report_data/');?>',
				    type: 'POST',
					data: {
							'from_date': from_date,
							'to_date': to_date,
							'status': status,
					},
				
				success: function(data)
				{

					alert(data);
					console.log(data);
					jQuery('#new_table').empty();
					var obj = JSON.parse(data);
					var count = 1;
					
					if(length == '' || length == null || length == 0)
					{
						$("#load").addClass('hide');
						$("#no_data").removeClass('hide');
					}
					var table = $("	<table id='example1' class='table table-bordered table-striped stats-info stats-last widget-shadow'  style='margin: 15px !important;'><thead><tr><th style='width: 3%'>S No</th><th style='width: 5%'>Trip Id</th><th style='width: 5%'>Vehicle Name</th><th style='width: 4%'>End geo location</th><th style='width: 5%'>Start Location</th><th style='width: 5%'>End Location</th><th style='width: 5%'>Status</th></tr> <tbody class='tbody' id='tbody'></tbody>");

					$("#new_table").append(table);

					for(var i=0;i<obj.length;i++)
					{
						if(i==0)
						{
							$("#no_data").addClass('hide');
						}
						

						var row = $("<tr class='.item_red'/>");
						$("tbody").append(row);
					
						row.append("<td>" + (count++) + "</td>");
						 row.append("<td>" +obj[i].trip_id+ "</td>");
						row.append("<td>" + obj[i].vehicle_name + "</td>");
						  row.append("<td>" + obj[i].Location_short_name+ "</td>");
					  row.append("<td>" + obj[i].start_location + "</td>");
			      row.append("<td>" + obj[i].end_location+ "</td>");
			      if (obj[i].flag=='1') {
			      	row.append("<td><a href='#myModal' role='button' class='btn' data-toggle='modal'>Launch demo modal</a></td>");
			      }
			      else
			      {
			      		row.append("<td>" + obj[i].flag+ "</td>");
			      }
					   
					   
					 
					}
					$("#new_table").append('</table>');
	        		$("#load").addClass('hide');
	        		$(".search-button").prop('disabled',false);
	        		$(".export_data").removeClass('hide');

	        		var table1 = $('#example1').DataTable();
					
					
				},
				error: function()
				{
					console.log("error");
	        		$("#load").addClass('hide');
	        		$("#no_data").removeClass('hide');
				}
				});
			}
		}
	});

 $(document).ready(function(){
	$('#launchmodal').click(function(){
		$('#myModal').modal('show')
	});
});




</script>