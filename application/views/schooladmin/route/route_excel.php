
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Stats -->

        <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Route Full Details</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>             
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table id="excel" class="table table-striped table-bordered">
                                        <thead class="bg-primary">
                                                    <tr>
                                                        <th>S No</th>
                                                        <th>Student Name</th>
                                                        <th>Parent Name</th>
                                                        
                                                        <th>Class</th>
                                                        <th>Route Name</th>
                                                        <th>Stop ID</th>
                                                       
                                                        <th>Stop Name</th>
                                                        <th>Primary Mobile No</th>
                                                        <th>Secondary Mobile No</th>
                                                        <th>Arrival Time</th>
                                                        <th>Stop Lat</th>
                                                       
                                                        <th>Stop Lng</th>                                                                                           
                                                    </tr>
                                                    
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $s=1;
                                            foreach($students_list as $list) { ?>
                                           <tr> 
                                            <td><?php echo $s;?></td>
                                            <td><?php echo $list['student_name'];?></td>
                                            <td><?php echo $list['parent_name'];?></td>
                                           
                                            <td><?php echo $list['class_name'];?></td>
                                            <td><?php echo $list['route_name'];?></td>
                                            <td><?php echo $list['route_no'];?></td>
                                           
                                            <td><?php echo $list['Location_short_name'];?></td>
                                            <td><?php echo $list['mobilenumber'];?></td>
                                            <td><?php echo $list['alter_mobile'];?></td>
                                            <td><?php echo $list['stop_arrival_time'];?></td>
                                            <td><?php echo $list['Lat'];?></td>
                                           
                                            <td><?php echo $list['Lng'];?></td>
                                            
                                            </tr>
                                            <?php $s++;} ?>
                                            
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
        $('#excel').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            rowGroup: {
            dataSrc: 6
        }
        } );
    } );
</script>  