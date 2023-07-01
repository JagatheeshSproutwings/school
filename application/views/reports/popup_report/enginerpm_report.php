  <div class="modal fade text-left" style="background:radial-gradient(black, transparent)" id="enginerpm_report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <form action="<?php echo site_url('Genericreport/rpm_report');?>" method="post" target="_blank">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-tree"></i>Engine RPM report</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="text-bold-600 font-medium-2">
                            Select Vechile Number
                        </div>
                        <select name="vehicles[]" class="select2 form-control" multiple="multiple">
                            <?php foreach ($vehicle_details as $list) { ?>
                           <option value="<?php echo $list->deviceimei;?>"><?php echo $list->vehiclename;?></option>
                       <?php   } ?>
                        </select>
                    </div>
                    <!--<h5><i class="fa fa-lightbulb-o"></i> Some More Text</h5>-->
                    <!--<p>Cupcake sugar plum dessert tart powder chocolate fruitcake jelly. Tootsie roll bonbon toffee danish. Biscuit sweet cake gummies danish. Tootsie roll cotton candy tiramisu lollipop candy cookie biscuit pie.</p>-->
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Start Date</label>
                                <input type="datetime-local" class="form-control startLocalDate" id="basicInput" name="fromdate">
                            </fieldset>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                            <fieldset class="form-group">
                                <label for="helpInputTop">End Date</label>
                                <input type="datetime-local" class="form-control endLocalDate" id="helpInputTop" name="todate">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio144" value="1">
                                        <label class="custom-control-label" for="radio144"> > 1 Minute</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio154" value="2">
                                        <label class="custom-control-label" for="radio154"> > 2 Minutes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio164" value="5">
                                        <label class="custom-control-label" for="radio164"> > 5 Minutes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio174" value="10">
                                        <label class="custom-control-label" for="radio174"> > 10 Minutes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio184" value="15">
                                        <label class="custom-control-label" for="radio184"> > 15  Minutes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio194" value="30">
                                        <label class="custom-control-label" for="radio194"> > 30 Minutes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio204" value="45">
                                        <label class="custom-control-label" for="radio204"> > 45 Minutes</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio214" value="60">
                                        <label class="custom-control-label" for="radio214"> > 1 Hour</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio224" value="120">
                                        <label class="custom-control-label" for="radio224"> > 2 Hour</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio234" value="180">
                                        <label class="custom-control-label" for="radio234"> > 3 Hour</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio244" value="240">
                                        <label class="custom-control-label" for="radio244"> > 4 Hour</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio mr-1 col-md-3">
                                        <input type="radio" class="custom-control-input" name="time" id="radio254" value="300">
                                        <label class="custom-control-label" for="radio254"> > 5 Hour</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-warning">Submit</button>
                </div>
            </div>
        </div>
        </form>
    </div>