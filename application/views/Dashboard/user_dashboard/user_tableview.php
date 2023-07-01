   
<?php 
      $data['vehicle_details']=$vehicle_details;
      $data['moving_vehicle']=$moving_vehicle;
      $data['idle_vehicle']=$idle_vehicle;
      $data['parking_vehicle']=$parking_vehicle;
      $data['ooc_vehicle']=$ooc_vehicle;
?>
   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/osm/leaflet.css"/>
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
} */
                                                    
  </style>

    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

        <div class="app-content content" style="margin: 0px;margin-left:-15px">
            
<div class="content-right" style="width: 100% !important;">
            <div class="content-overlay"></div>
            <div class="content-wrapper" style="padding: 5px 0px 0px 18px;">
            <div class="email-app-area">
            <div class="tab-content">
              <div class="tab-pane active " id="tab2" role="tabpanel" aria-labelledby="base-tab1">
                <div class="iframe-container">
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
    });
// =================================================================================
                  
              $( document ).ready(function() {
                $('#example').DataTable();
                });
   
//=====================================================================================================       
       
            </script>     

