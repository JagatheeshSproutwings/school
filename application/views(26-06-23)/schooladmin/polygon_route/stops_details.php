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
        <h2><?php if($route_id!=''){ $ign_q = $this->db->query("SELECT route_name FROM routes WHERE route_id='".$route_id."'");
                  $ign_f = $ign_q->row();
                  echo $ign_f->route_name; }?> Route Stop Details</h2>
         <a href="<?php echo site_url('/route');?>" class="btn btn-success add pull-right" >Back to route</a>
        <div class="col-lg-12 col-md-12 col-sm-12" style='padding-top: 10px;'>
            <header class="panel-heading">
              <a href="<?php echo site_url('/route_stop/edit_routestop/');?><?php if(!empty($route_id)){ echo $route_id;}?>" class="btn btn-success add pull-right" >Add</a>
               <input type="hidden" name="route_id" value="<?php echo $route_id;?>">
          </header>
          <div class="notify-w3ls  stats-info stats-last widget-shadow"  style="margin-bottom: 10px !important; height: auto !important;"> 
             <div class="col-lg-12 col-md-12 col-sm-12">
                <table class="table table-bordered table-striped stats-info stats-last widget-shadow">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Location</th>
                      <th>Arrival Time</th>
                      <th>Start Time</th>
                      <th></th>
                    </tr>
                  </thead>
                   <?php    
    
              $count_sno = 1;                     
              if(isset($route_list)){                          
              foreach($route_list as $list){ 
              
                      ?>
                <tr>
                  <th scope="row"> <?=$count_sno++;?></th>
                  <td><?php $ign_q = $this->db->query("SELECT Location_short_name FROM location_list WHERE Location_id='".$list->stop_geo_id."'");
                  $ign_f = $ign_q->row();
                  echo $ign_f->Location_short_name;
                   ?></td>
                  <td><?=$list->stop_arrival_time; ?></td>               
                  <td><?=$list->stop_start_time; ?></td> 
                  <td><!-- <a href="<?php //echo site_url('/route/view_route/').$list->route_id; ?>" class="badge bg-blue hide" data-toggle='modal' data-target='#viewUserModel'>View</a>&nbsp; -->
                    <?php if($role >= 3){
                      echo "<a href=".site_url('/route_stop/edit_routestop/').$route_id."/".$list->stop_id." class='badge bg-orange'>Edit</a>";
                     }
                  ?>
                  <?php if($role >= 3){
                      echo "<a href='#' onclick='deleteItem(".$list->stop_id.")' class='badge bg-red'>Delete</a>";
                     }
                  ?></td> 
                </tr>
              <?php }}?>
        
                </table>
              </div>

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
        
     window.location = "<?php echo site_url()?>/route_stop/delete_stop/?id="+id+"&r="+<?php echo $route_id;?>;
    
    }
    return false;
  }
  /*delete client*/

</script>
