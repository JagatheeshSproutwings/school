<!-- Content Wrapper. Contains page content -->

<?php $role = ($this->session->userdata['role']); 
error_reporting(0);
?>

<head>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!-- <link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" > -->
<!--logo start-->
</header>
<!--header end-->
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    
    <section class="wrapper">
        <div class="w3-agile-google_map">
        <h2>Zigma Trip Plan Details</h2>
        <div class="col-lg-12 col-md-12 col-sm-12" style='padding-top: 10px;'>
          <header class="panel-heading">
            Zigma Trip Plan<a href="<?php echo site_url('/Location/edit_zigmatrip/');?>" class="btn btn-success add pull-right" >Add</a>
          </header>
          <div class="notify-w3ls  stats-info stats-last widget-shadow"  style="margin-bottom: 10px !important;padding-right:30px !important;"> 
            <table id="example1" class="table table-bordered table-striped stats-info stats-last widget-shadow"  style="margin: 15px !important; " >
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Trip Id</th>
                   <th>Poc Number</th>
                  <th>Vehicle Name</th>
                  <th>Disposal Point</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <?php    
    
              $count_sno = 1;                     
              if(isset($zigma_triplist)){                          
              foreach($zigma_triplist as $list){ 
               // print_r($route_list);exit;
              
                      ?>
                <tr>
                  <th scope="row"> <?=$count_sno++;?></th>
                    <td><?=$list->trip_id; ?></td>
                     <td><?=$list->poc_number; ?></td>
                  <td><?=$list->vehicle_name; ?></td>
                  <td><?=$list->Location_short_name; ?></td>    

                  <td><?=( $list->status == '1') ? "Active" : "Deactive"; ?></td>
                  <td><!-- <a href="<?php //echo site_url('/route/view_route/').$list->route_id; ?>" class="badge bg-blue hide" data-toggle='modal' data-target='#viewUserModel'>View</a>&nbsp; -->
                     <?php if($role >= 3){
                      echo "<a href=".site_url('/Location/edit_zigmatrip/').$list->id." class='badge bg-orange'>Edit</a>";
                     }
                  ?> 
                  <?php if($role >= 3){
                      echo "<a href='#' onclick='deleteItem(".$list->id.")' class='badge bg-red'>Delete</a>";
                     }
                  ?></td> 
                </tr>
              <?php }}?>
            </table>
          </div>
        </div>
        <div class="clearfix"></div>
    </div>
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
</body>

<script type="text/javascript">

  /*delete client*/
  function deleteItem(id) {
    if (confirm("Are you sure?")) {
        
     window.location = "<?php echo site_url()?>/Location/delete_zigmatrip/"+id;
    
    }
    return false;
  }
  /*delete client*/

</script>