<?php  $firstname = $this->session->userdata('firstname');
       $userid = $this->session->userdata('userid');
        $role = $this->session->userdata('roleid');
      $dealer_logo = $this->session->userdata('dealer_logo');
      $dealer_color = $this->session->userdata('dealer_color');
      $dealer_id = $this->session->userdata('dealer_id');
       $dealer_company = $this->session->userdata('dealer_company');
       $subdealer_id = $this->session->userdata('subdealer_id');
     $subdealer_company = $this->session->userdata('subdealer_company');
     $subdealer_logo = $this->session->userdata('subdealer_logo');?>
     
<!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border" style="background:<?=$dealer_color;?> !important;">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block"> &copy; 2020 All rights reserved.</span>
        <span class="float-md-right d-none d-lg-block">Powered by <a class="text-bold-800 grey darken-2" href="http://sproutwings.in/" target="_blank">
        <?php if ($role=='1' || $role=='2') { ?>
           ?> Sproutwings Telematics OPC Pvt Ltd.
           <?php } elseif ($role=='3') {
                   
            echo $dealer_company;
          }
           if($role>='5') {
            if ($dealer_id!='') { 
              echo $dealer_company;

          }
          else
          { ?>
            Sproutwings Telematics OPC Pvt Ltd.
      <?php    } } ?>
        </a>
        </span>
      </p>
    </footer>
<!-- END: Footer-->
</body>
</html>

