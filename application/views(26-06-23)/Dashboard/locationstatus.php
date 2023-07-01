<div class="app-content content">
      <div class="content-wrapper">
         <div class="content-body">
             <div class="card">
             <div class="card-header">
<div class="container">
    <h4 class="text-center">Location Packet Status Check</h4><br>
	<form action="<?php echo site_url(); ?>Statuscheck" method="post">
	  <div class="row">
			<div class="col-md-3">
                 <div class="col-xl-10 col-lg-6 col-md-12 mb-1">
                     <fieldset class="form-group">
                         <label for="basicInput">IMEI</label>
                       <input type="text" placeholder="Enter IMEI Number"class="form-control" pattern=^[a-zA-Z0-9]*$ minlength="6" maxlength="20" id="imei" name="imei" value="<?php echo $imei;?>"/>
                    </fieldset>
                </div>
            </div>
			   <div class="col-md-2" style="margin-top:25px;">
			       <button class="btn btn-primary" id="search">Search <i class="fa fa-search"></i></button>
			    </div>
	  </div><br>
	  </form>
       <table class="table table-striped table-bordered table-responsive file-export" id="myTable">
          <thead>
          <tr class="text-center">
			  <th>S.No</th>
              <th>IMEI</th>
              <th>ACC Status</th>
              <th>Lat</th>
              <th>Lng</th>
              <th>Speed</th>
              <th>Angle</th>
              <th>Created Date</th>
              <th>Modified Date</th>
              <th>Odometer(KM)</th>
              <th>Digital Output</th>
			  <th>Packet Type</th>
          </tr>
        
          </thead>
          <tbody id="body">
              <?php
                 if($data){
					 $i=1;
                     foreach($data as $value){?>
                    <tr>
						<td><?php echo $i;?></td>
						<td><?php echo $value->running_no; ?></td>
                        <td><?php echo $value->acc_status;?></td>
                        <td><?php echo $value->lat_message;?></td>
                        <td><?php echo $value->lon_message;?></td>
                        <td><?php echo $value->speed;?></td>
                        <td><?php echo $value->angle;?></td>
                        <td><?php echo $value->created_date;?></td>
                        <td><?php echo $value->modified_date;?></td>
                        <td><?php echo $value->distance_travelled;?></td>
                        <td><?php echo $value->digital_output;?></td>
                        <td><?php echo $value->packettype;?></td>

                    </tr>                         
                    <?php  $i++;    }
                      } ?> 
               
                   </tbody>
                   </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
   </div>
</div>

<script>
   	$(document).ready(function() {
        $('#myTable').DataTable({
                "ordering": false
            });
        });

// Datewise
// $('#search').click(function(){
//    var st_date = $('#start_date').val();
//    var en_date = $('#end_date').val();
//    var imei = $('#imei').val();
//     if(st_date == '' && en_date == '' && imei !== ''){
// 		$.ajax({
//               type:"post",
// 			  url:"<?php echo site_url();?>Statuscheck/fuel_imei_result",
// 			  data:{
// 				  imei:imei
// 			  },
// 			  success:function(response){
// 				  var data = JSON.parse(response);
// 				  for(i=0;i<=data.length;i++){
//                          $('#body').append("<tr><td>"+data[i].running_no+"</td><td>"+data[i].lat+"</td><td>"+data[i].lng+"</td><td>"+data[i].speed+"</td><td>"+data[i].flag+"</td><td>"+data[i].modified_data+"</td><td>"+data[i].odometer+"</td><td>"+data[i].litres+"</td><td>"+data[i].raw_value+"</td><td>"+data[i].packettype+"</td><td>"+data[i].packetdata+"</td></tr>");
//                      }			  },
// 			  error:function(){
// 				  alert("err");
// 			  }
// 		});
// 	}
// 	else{
// 		alert('hii');
// 	}
// });
</script>