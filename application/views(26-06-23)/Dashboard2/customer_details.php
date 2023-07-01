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
                    <h3 class="content-header-title mb-0"> Total Customer List</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>dashboard/">Home</a></li>
                                <li class="breadcrumb-item active"> Total Customer List</li>
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
                                            <th>SELF / Dealer Name</th> 
                                            <th>Company Name</th>                                      
                                            <th>Customer Name</th>
                                            <th>Email</th>                                           
                                            <th>Contact Number</th>
                                            <th>Address</th> 
                                            <th>Status</th>
                                     </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $i=1;
                                    foreach($result as $value){ ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php if($value->dealer_name){echo $value->dealer_name;}else{echo "SELF";} ?></td>
                                            <td><?php echo $value->company_name;?></td>
                                            <td><?php echo $value->client_name;?></td>
                                            <td><?php echo $value->email;?></td>
                                            <td><?php echo $value->mobile;?></td>
                                            <td><?php echo $value->address;?></td>
                                            <td><?php if($value->status==1){echo "Active";}else{echo "Deactive";};?></td>        
                                        </tr>
                                    
                                    <?php $i++;} ?>
                                                                                                        
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