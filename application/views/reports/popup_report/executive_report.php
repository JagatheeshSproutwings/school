  <div class="modal fade text-left" style="background:radial-gradient(black, transparent)" id="executive_reports" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
        <form action="<?php echo site_url('Executivereport');?>" method="post" target="_blank">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-tree"></i>Executive report</h4>
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
                        <select name="vehicles[]" class="select2 form-control" multiple="multiple">
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
                                <input type="date" class="form-control startLocalDate1" id="startLocalDate" name="fromdate">
                            </fieldset>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                            <fieldset class="form-group">
                                <label for="helpInputTop">End Date</label>
                                <input type="date" class="form-control endLocalDate1" id="endLocalDate" name="todate">
                               
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-warning" id="submited_data">Submit</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <script>
        
        $("#endLocalDate,#startLocalDate").change(function(){

            var startDate = $('#startLocalDate').val();
            var endDate = $('#endLocalDate').val();
            var currentdate ='<?php echo date('Y-m-d');?>';
            console.log(startDate);
            console.log(endDate);
            console.log(currentdate);
           

        if ((startDate == currentdate) || (endDate == currentdate) ){
            $("#submited_data").prop('disabled', true);
            alert('Do not Choose Current Date Please Choose Previous Days' );
        }
        else if(startDate > endDate) 
        {
            $("#submited_data").prop('disabled', true);
            alert('Start Date Should be Greater Than End date' );
        }
        else
        {
            // alert('success');
            $("#submited_data").prop('disabled', false);
        }

           });

       

    </script>