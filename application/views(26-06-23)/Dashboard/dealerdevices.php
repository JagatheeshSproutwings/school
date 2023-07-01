<!-- BEGIN: Body-->
<?php error_reporting(0);  

	$role =$this->session->userdata['role'];
	$clientid=$this->session->userdata['clientid'];

?>
<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0"> Total Vehicle List</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> Total Vehicle List</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    
                    </div>
                </div>
                <span id="waitmsg"></span>
            </div>
        </section>

        </div>


        <div class="content-body">
            <section id="configuration">
            <div class="row" >
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Configuration option</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload"><istates class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                             
                                <div class="table-responsive">

                                <table id="dealer_customer" class="table table-striped table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                    <th>S.No</th>
                                    <th>Self/Dealername</th>
                                    <th>Client Name</th>
                                    <th>Mobile</th>
                                    <th>Vehicle Reg No</th>
                                    <th>Device IMEI</th>
                                    <th>Device Model</th>
                                    <th>SIM Number</th>
                                    <th>Network</th>
                                    <th>Updated Time</th>
                                    <th>Installation Date</th>
                                    <th>Expire Date</th>
                                    <th>Status</th>
                                   <th>Location</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                            foreach($d_result as $value){ ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                        <?php $dealer_query = $this->db->query("SELECT dealer_name FROM dealertbl WHERE dealer_id = '".$value->dealer_id."'");
                                           $dealer_data = $dealer_query->row();?>
                                   
                                    <td><?php if($dealer_data->dealer_name){echo $dealer_data->dealer_name;}else{echo "SELF";}?></td>
                                    <td><?php echo $value->client_name;?></td>
                                    <td><?php echo $value->mobile;?></td>
                                    <td><?php echo $value->vehiclename;?></td>
                                    <td><?php echo $value->deviceimei;?> </td>
                                        <?php $device_query = $this->db->query("SELECT device_model FROM devicetbl WHERE deviceimei = '".$value->deviceimei."'");
                                           $device_data = $device_query->row();?>
                                   
                                    <td><?php echo $device_data->device_model;?></td>
                                    <td><?php echo $value->simnumber;?></td>
                                    <?php $sim_query = $this->db->query("SELECT networkprovider FROM simtbl WHERE simnumber = '".$value->simnumber."'");
                                           $sim_data = $sim_query->row();?>

                                    <td><?php echo $sim_data->networkprovider;?></td>
                                    <td><?php echo $value->updatedon;?></td>
                                    <td><?php echo $value->installationdate;?></td>
                                    <td><?php echo $value->expiredate;?></td>
                                    <td>
                                <?php             
                                        if($value->update_time >= 10){ 
                                        echo '<span style="color:#F00;font-weight: bold;">NoNetwork</span>';
                                        }else if($value->speed == '0' && $value->acc_on == '1'){
                                        echo '<span style="color:#e8720d;font-weight: bold;">Idle</span>';
                                        }else if($value->speed == '0' && $value->acc_on == '0'){
                                        echo '<span style="color:blue;font-weight: bold;">Parking</span>';
                                        }else if($value->speed > '0'  && $value->acc_on == '1'){ 
                                        echo '<span style="color:green;font-weight: bold;">Moving</span>';
                                        }else{
                                        echo '<span style="color:#F00;font-weight: bold;">NoNetwork</span>';
                                        }
                                    ?>
                                </td>
                                <td><?php echo "<a href='http://map.google.com/maps?q=".$value->lat.",".$value->lng; echo "'target='_blank' class='badge bg-green'>Location</a>";?></td>
                                 
                                                        
                                </tr>

                            <?php $i++;} 
                           
                            ?>
                                                                    
                                    </tbody>
                                </table>   
                              </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>
        </div>

      </div>
    </div>
    <script>

$(document).ready(function() {
        $('#dealer_customer').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>           