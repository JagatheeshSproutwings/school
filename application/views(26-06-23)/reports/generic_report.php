<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Generic Report</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Home</a> </li>
                <li class="breadcrumb-item active">Report</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <section class="<?= $vehicle_basic_report == '0' ? 'displaynone' : '' ?>">
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Vehicle Basic Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->trip_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(1);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\66.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Trip Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->idle_report == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(2);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\32.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Idle Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->parking_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(3);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\69.svg" width="43px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Parking Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->distance_report == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(4);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\67.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Distance Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->over_spead_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(5);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Over spead Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->ac_report == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(6);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">AC Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="<?php echo site_url('Genericreport/playback'); ?>" target="_blank" class="card-link">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\68.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Playback History</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5" style="background: #d3d3d326">
                            <div class="media" style="margin-left: 15px">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(7);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\4.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Alert Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="<?= $vehicle_geo_report == '0' ? 'displaynone' : '' ?>">
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Vehicle GEOFENCE & HUB Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->geo_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(8);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\61.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">GEOFENCE Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->hub_report == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(9);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\59.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Hub Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="">
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Livetrack Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="<?php echo site_url('Report/livetrackreport'); ?>" target="_blank">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Livetrack Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="<?= $vehicle_engine_RPM_report == '0' ? 'displaynone' : '' ?>">
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Vehicle Engine RPM Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-4 col-sm-4 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->engine_rpm_report == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(10);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Engine RPM Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <section class="<?= $vehicle_fuel_report == '0' ? 'displaynone' : '' ?>">
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Vehicle Fuel Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-3 col-sm-3 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->fuel_refill_drain_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(11);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Fuel refill/drain Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-2 col-sm-2 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->millage_report == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(12);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Millage Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->fuel_comparision_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(13);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Fuel Comparision Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->fuel_consumption_eng_rpm == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(14);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Fuel Consumption with Engine RPM Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="<?= $auxilary_report == '0' ? 'displaynone' : '' ?>">
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Auxilary Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->bucket_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(15);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Bucket Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->drum_rotational_report == '0' ? 'displaynone' : '' ?>" style="background: #d3d3d326">
                            <div class="media">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(16);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Drum Rotational Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="">
          <div class="row">
            <div class="col-xxl-12 col-xl-6 col-lg-6 col-md-6 col-6 <?= $temperature_report == '0' ? 'displaynone' : '' ?>">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Temperature Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->temperature_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(17);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Temperature Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-12 col-xl-6 col-lg-6 col-md-6 col-6 <?= $vehicle_obd == '0' ? 'displaynone' : '' ?>">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">OBD Report</h4>
                        <span class="pr-2">
                          <!--                <i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->obd_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(18);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>/app-assets\images\menuicon\home.svg" width="25px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">OBD Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-12 col-xl-6 col-lg-6 col-md-6 col-6 <?= $polygonreport == '0' ? 'displaynone' : '' ?>">
              <div class="card info-time-tracking">
                <div class="card-content">
                  <div class="row">
                    <div class="col-12 pt-2 pb-2 border-bottom-blue-grey border-bottom-lighten-5">
                      <div class="info-time-tracking-title d-flex justify-content-between align-items-center">
                        <h4 class="pl-2 mb-0 title-info-time-heading text-bold-500">Area & Route Report</h4>
                        <span class="pr-2">
                          <!--<i class="icon icon-settings"></i>-->
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="info-time-tracking-content">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->polygon_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="#" onClick="genericreport(19);" class="card-link" data-backdrop="false" data-toggle="modal">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\43.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Area Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->polygon_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="<?php echo site_url(); ?>Report/polygon_route_report">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\35.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Route Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                          <div class="col-md-6 col-sm-6 border-right-blue-grey border-right-lighten-5 <?php echo $executive_access->polygon_report == '0' ? 'displaynone' : '' ?>">
                            <div class="media" style="margin-left: 15px;">
                              <div class="media-left pr-1">
                                <a href="<?php echo site_url(); ?>Route/trip_plan">
                                  <img class="media-object" src="<?php echo base_url(); ?>app-assets\images\menuicon\twings_svg\35.svg" width="35px" height="43px" alt="image">
                              </div>
                              <div class="media-body">
                                <h6 class="text-bold-500 pt-1 mb-0">Trip Plan Report</h6>
                              </div>
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
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

  <!-- BEGIN Vendor JS-->
  <?php
  $this->load->view('reports/popup_report/trip_report', $data);
  $this->load->view('reports/popup_report/parking_report', $data);
  $this->load->view('reports/popup_report/idle_report', $data);
  $this->load->view('reports/popup_report/ac_report', $data);
  $this->load->view('reports/popup_report/distance_report', $data);
  $this->load->view('reports/popup_report/fuelfilldip_report', $data);
  $this->load->view('reports/popup_report/millage_report', $data);
  $this->load->view('reports/popup_report/fuel_compare_report', $data);
  $this->load->view('reports/popup_report/hubpoint_report', $data);
  $this->load->view('reports/popup_report/geofence_report', $data);
  $this->load->view('reports/popup_report/enginerpm_report', $data);
  $this->load->view('reports/popup_report/polygon_report', $data);
  $this->load->view('reports/popup_report/alert_report', $data);

  ?>


  <script type="text/javascript">
    function genericreport(gid) {
      //alert(gid);
      if (gid == 1) {
        jQuery('#trip_report').modal('show');
        $('.modal-body #tripid').val(gid);
      } else if (gid == 2) {
        jQuery('#idle_report').modal('show');
        $('.modal-body #idle').val(gid);
      } else if (gid == 3) {
        jQuery('#parking_report').modal('show');
        $('.modal-body #parking').val(gid);
      } else if (gid == 4) {
        jQuery('#distance_report').modal('show');
        $('.modal-body #distance').val(gid);
      } else if (gid == 5) {
        jQuery('#overspead_report').modal('show');
        $('.modal-body #overspead').val(gid);
      } else if (gid == 6) {
        jQuery('#ac_report').modal('show');
        $('.modal-body #ac').val(gid);
      } else if (gid == 7) {
        jQuery('#alert_report').modal('show');
        $('.modal-body #alert').val(gid);
      } else if (gid == 8) {
        jQuery('#geofence_report').modal('show');
        $('.modal-body #geo').val(gid);
      } else if (gid == 9) {
        jQuery('#hub_report').modal('show');
        $('.modal-body #hub').val(gid);
      } else if (gid == 10) {
        jQuery('#enginerpm_report').modal('show');
        $('.modal-body #rpm').val(gid);
      } else if (gid == 11) {
        jQuery('#fuelrefil_report').modal('show');
        $('.modal-body #fuelrefil').val(gid);
      } else if (gid == 12) {
        jQuery('#millage_report').modal('show');
        $('.modal-body #millage').val(gid);
      } else if (gid == 13) {
        jQuery('#fuel_compare_report').modal('show');
        $('.modal-body #fuelcomparision').val(gid);
      } else if (gid == 14) {
        jQuery('#fuelconsumption_report').modal('show');
        $('.modal-body #fuelconsumption').val(gid);
      } else if (gid == 15) {
        jQuery('#bucket_report').modal('show');
        $('.modal-body #bucket').val(gid);
      } else if (gid == 16) {
        jQuery('#drumrotational_report').modal('show');
        $('.modal-body #drumrotational').val(gid);
      } else if (gid == 17) {
        jQuery('#temperature_report').modal('show');
        $('.modal-body #temperature').val(gid);
      } else if (gid == 18) {
        jQuery('#obd_report').modal('show');
        $('.modal-body #obd').val(gid);
      } else if (gid == 19) {
        jQuery('#polygon_report').modal('show');
        $('.modal-body #obd').val(gid);
      }
    }
  </script>