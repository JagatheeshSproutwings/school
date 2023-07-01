<!-- <div class="app-content content"> -->
<!--======graph view styles=======================-->
<?php 
      $data['vehicle_details']=$vehicle_details;
      $data['moving_vehicle']=$moving_vehicle;
      $data['idle_vehicle']=$idle_vehicle;
      $data['parking_vehicle']=$parking_vehicle;
      $data['ooc_vehicle']=$ooc_vehicle;
      // $data['access_menu']->
?>
  <style>
      .databottom td{
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        padding-left: 0 !important;
      }
      body.vertical-layout.vertical-menu-modern.menu-collapsed .navbar .navbar-header.expanded{
          width: 105px !important;
    z-index: 1000;
      }
      .dataTables_info{
          display: none;
      }
      .dataTables_length{
          display: none;
      }
      .dataTables_filter{
          margin: -2px 45px;
      }
      .form-control form-control-sm{
          width: 200px !important;
      }
      
.wrapper{
  background: #456173;
  display: flex;
  width: 105%;
}
.datacards {
    /*padding-top: 15px;*/
    padding-top: 0px;
  background: #fff;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  display: grid;
  grid-gap: 1rem;
  grid-auto-flow: column;
  grid-auto-columns: calc(25% - 2rem);
  /* min-height: 40vh; */
  width: 100%;
}
.datacards-content {
  /*align-items: center;*/
  background: #fff;
  border-radius: 1rem;
  color: #111;
  display: flex;
  /*font-weight: 900;*/
  /*justify-content: center;*/
  /*font-size: 5rem;*/
  /*text-transform: uppercase;*/
}
/*.datacards-content:first-child {
  margin-left: 1rem;
}*/
.datacards-content:last-child {
  margin-right: 1rem;
}
/* .menutop-icon{
    width: unset !important;
    max-width: unset !important;
    height: auto;
    border: 0;
    border-radius: 50%;
}
                                                     */
  </style>
<!--======graph view styles=======================-->
 <?php $this->load->view('Dashboard/user_dashboard/googlemap/innermenu-gmap-vehicle',$data);?>                      
<div class="content-right" style="width: calc(100% - 350px) !important;">
            <div class="email-app-area">
            <div class="tab-content">
              <div class="tab-pane active" id="tab112" role="tabpanel" aria-labelledby="base-tab112">
                  <div class="col-12" style="padding-left: 0px;padding-right: 3px;">
			<div class="card">
                            <ul class="nav nav-tabs nav-topline" role="tablist">
                                    <li class="nav-item">
                                            <a class="nav-link active" id="base-tab21m" data-toggle="tab" aria-controls="tab21m" href="#tab21m" role="tab" aria-selected="true">Map View</a>
                                    </li>
                                    <li class="nav-item">
                                            <a class="nav-link chart_click" id="base-tab22" data-toggle="tab" aria-controls="tab22g" href="#tab22g" role="tab" aria-selected="false">Chart</a>
                                    </li>
                                    <li class="nav-item">
                                            <a class="nav-link" id="base-tableview" data-toggle="tab" aria-controls="tableview" href="#tableview" role="tab" aria-selected="false">Table View</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab23analysis" id="base-tab23analysis" data-toggle="tab" aria-controls="tab23analysis" href="#tab23analysis" role="tab" aria-selected="false" hidden>Analysis</a>
                                    </li>
                                  
                                    
                                     <a class="nav-link pull-right" href="<?php echo site_url('Dashboard/mapview');?>">OSM Map</a>

                                   
                            </ul>
                            <div class="tab-content px-1 pt-1111 border-grey border-lighten-2 border-0-top">
                                <div class="tab-pane active" id="tab21m" role="tabpanel" aria-labelledby="base-tab21m">
                                    <?php $this->load->view('Dashboard/user_dashboard/googlemap/vehicles-gmap-view', $data); ?>
                                </div>
                                <div class="tab-pane" id="tab22g" role="tabpanel" aria-labelledby="base-tab22g">
                                    <div class="iframe-container">
                                        <div class="content-body">
                                            <div class="col-md-5 m-auto">
                                                <!-- Mixed Line Column Area Start -->
                                                <div class="bg-gradient-x-success box-bordershado card">
                                                    <div class="card-body">                                
                                                        <div id="vehiclename" style="color:white"></div>

                                                    </div>
                                                </div>
                                                <!-- mixed Line Column Area end -->

                                            </div>
                                            <?php
                                            $hour = date('H'); $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning"); ?>
                                            <div class="alert alert-primary alert-dismissible mb-2" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Good <?php echo $dayTerm;?>!</strong> Start <a href="#" class="alert-link">your day</a> with Last 7 days charts.
						</div>
                                            <section class="charts-apexcharts">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <!-- Column Basic Chart Start -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title">Parking Chart</div>
                                                                <div id="parking-basic-chart"></div>
                                                            </div>
                                                        </div>
                                                        <!-- column basic chart end -->
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- Column Basic Chart Start -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title">Distance Chart</div>
                                                                <div id="distance-basic-chart"></div>
                                                            </div>
                                                        </div>
                                                        <!-- column basic chart end -->
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- Column Basic Chart Start -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title">Idle Chart</div>
                                                                <div id="idle-basic-chart"></div>
                                                            </div>
                                                        </div>
                                                        <!-- column basic chart end -->
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- Column Basic Chart Start -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title">Trip Chart</div>
                                                                <div id="trip-basic-chart"></div>
                                                            </div>
                                                        </div>
                                                        <!-- column basic chart end -->
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- Column Basic Chart Start -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title">Fuel Consumed</div>
                                                                <div id="fuelconsume-basic-chart"></div>
                                                            </div>
                                                        </div>
                                                        <!-- column basic chart end -->
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- Column Basic Chart Start -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title">Fuel Refill</div>
                                                                <div id="fuelrefill-basic-chart"></div>
                                                            </div>
                                                        </div>
                                                        <!-- column basic chart end -->
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- Column Basic Chart Start -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card-title">Fuel Drain</div>
                                                                <div id="fueldrain-basic-chart"></div>
                                                            </div>
                                                        </div>
                                                        <!-- column basic chart end -->
                                                    </div>
                                                  
                                                </div>

                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab23analysis" role="tabpanel" aria-labelledby="base-tab23analysis">
                                   <?php $this->load->view('Dashboard/user_dashboard/vehicle_analysis'); ?>
                                </div>
                                <div class="tab-pane" id="tableview" role="tabpanel" aria-labelledby="base-tableview">
                                     <?php  $this->load->view('Dashboard/user_dashboard/vehicles-table-view');?>
                                </div>
                            </div>
					
			</div>
		</div>
                
              </div>
            </div>

          </div>

         

          <script type="text/javascript">
                     $(document).ready(function(){
                      $('a.chart_click').on('click',function(){

                        update_graph();              //  All charts are called
                        });

                    
                          $('#hideleftside').show();
                      $('.tab23analysis').click(function(){
                          $('#hideleftside').hide();
                      });
//----------------------------------------------------------------------

    $(".tab23analysis").on('click', function(){
        alert('hai');
   if (!$(this).hasClass("expanded")){
      $(".animate").animate({height: '50px',},"slow");
      $(this).addClass("expanded");
   }
   else {
      $(".animate").animate({height: '100px',},"slow");
      $(this).removeClass("expanded");
   }

});
//----------------------------------------------------------------------         

                $("input[type='button']").click(function(){
        	var radioValue = $("input[name='workspace']:checked").val();
                    if(radioValue){
                        $.ajax({ 
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('/dashboard/trackplusworkspace'); ?>',
                        data: {'from_Date' : 1, 
                                'to_Date' : 2,
                                'vehicle' : 3,
                                'radioValue' : radioValue,
                            },
                        success: function(data){
                            var obj = JSON.parse(data);
                            window.location.href = 'drilldown.html';
                            }
                });
                    }else{
                    alert('please select any one');
                    }
        });

        $('#example').DataTable();
    });

   
     
</script>