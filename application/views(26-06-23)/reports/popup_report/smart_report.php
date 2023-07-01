  <div class="modal fade text-left" style="background:radial-gradient(black, transparent)" id="smart_report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <form action="<?php echo site_url('smartreport');?>" method="post" target="_blank">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-tree"></i>Smart report</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                             <div class="form-group">
                        <div class="text-bold-600 font-medium-2">
                            Select Vechile Number
                        </div>
                        <select name="vehicles[]" class="select2 form-control">
                            <?php foreach ($vehicle_details as $list) { ?>
                           <option value="<?php echo $list->deviceimei;?>"><?php echo $list->vehiclename;?></option>
                       <?php   } ?>
                        </select>
                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                            <fieldset class="form-group">
                                <label for="basicInput">Start Date</label>
                                <input type="datetime-local" class="form-control startLocalDate" id="startLocalDate" name="fromdate">
                            </fieldset>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                            <fieldset class="form-group">
                                <label for="helpInputTop">End Date</label>
                                <input type="datetime-local" class="form-control endLocalDate" id="endLocalDate" name="todate">
                               
                            </fieldset>
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