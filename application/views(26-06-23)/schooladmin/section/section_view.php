 	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2">Client Details</h4>
      </div>
      <div class="modal-body">
      	<br/>
   		<?php echo $this->session->flashdata('msg-client'); ?>
            <table class="table table-bordered">
              <tbody>
                <?php if(isset($client_detail)){}?>
                <tr>                  
                  <td style="width:40%"><b>Name :</b></td>
                  <td><?=$client_detail->client_name;?></td>
                </tr>
                <tr>
                  <td><b>Role :</b></td>
                  <td><?=$client_detail->role;?></td>
                </tr>
				<tr>
                  <td><b>Website :</b></td>
                  <td><?=$client_detail->website;?></td>
                </tr>	
				<tr>
                  <td><b>Contact Number :</b></td>
                  <td><?=$client_detail->phone;?></td>
                </tr>
                <tr>
                  <td><b>Primary Mobile :</b></td>
                  <td><?=$client_detail->mobile;?></td>
                </tr>
                <tr>
				<tr>
                  <td><b>Address :</b></td>
                  <td><?=$client_detail->address;?></td>
                </tr>
                <tr>
                  <td><b>Email :</b></td>
                  <td><?=$client_detail->email;?></td>
                </tr>
				<tr>
                  <td><b>SMS Title :</b></td>
                  <td><?=$client_detail->sms_title;?></td>
                </tr>
				<tr>
                  <td><b>SMS Username :</b></td>
                  <td><?=$client_detail->sms_username;?></td>
                </tr>
				<tr>
                  <td><b>SMS Password :</b></td>
                  <td><?=$client_detail->sms_password;?></td>
                </tr>
				<tr>
                  <td><b>license :</b></td>
                  <td><?=$client_detail->license;?></td>
                </tr>
				<tr>
                  <td><b>Used license :</b></td>
                  <td><?=$client_detail->license_count;?></td>
                </tr>
                <tr>
                  <td><b>Status :</b></td>                  
                  <td><?=( $client_detail->activecode == '1') ? "Active" : "Deactive"; ?></td>
                </tr>
              </tbody>
            </table>
   	
    </div>
    </br>