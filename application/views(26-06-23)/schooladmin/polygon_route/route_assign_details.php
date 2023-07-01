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
       <!--  <h2>Route Assign Details</h2> -->
        <div class="col-lg-12 col-md-12 col-sm-12" style='padding-top: 10px;'>
          <header class="panel-heading">
            Route Assign Details <a href="<?php echo site_url('/route/edit_routeassign/');?>" class="btn btn-success add pull-right <?php if($role == 4){?>hide<?php } ?>" >Add</a>
          </header>
          <div class="notify-w3ls  stats-info stats-last widget-shadow"  style="margin-bottom: 10px !important;padding-right:30px !important;"> 
            <table id="example1" class="table table-bordered table-striped stats-info stats-last widget-shadow"  style="margin: 15px !important; " >
              <thead>
                <tr>
                  <th>S.No</th>
                   <th>Vehicle</th>
                  <th>Route Name</th>
                  <th>Travel Start Date</th>
                  <th>Tarvel End Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php    
    
              $count_sno = 1;                     
              if(isset($route_list)){                          
              foreach($route_list as $list){ 
              
                      ?>
                <tr>
                  <th scope="row"> <?=$count_sno++;?></th>
                  <td><?=$list->vehicle_register_number; ?></td>
                  <td><?=$list->route_name; ?></td>
                 <td><?php echo date('Y-m-d',strtotime($list->travel_startdate)); ?></td>  
                 <td><?php echo date('Y-m-d',strtotime($list->travel_enddate)); ?></td>            
                  <td>
                    <?php if($role == 3){
                      echo "<a href=".site_url('/route/edit_routeassign/').$list->id." class='badge bg-orange'>Edit</a>";
                    }
                  ?>
                  <?php if($role == 3){
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
        
     window.location = "<?php echo site_url()?>/route/delete_routeassign/"+id;
    
    }
    return false;
  }
  /*delete client*/

</script>