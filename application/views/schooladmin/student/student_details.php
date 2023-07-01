<!-- BEGIN: Body-->
<?php error_reporting(0);

$role = $this->session->userdata['roleid'];
$clientid = $this->session->userdata['clientid'];
// print_r($classlist);exit;
?>

<body class="vertical-layout vertical-menu-modern content-left-sidebar email-application fixed-navbar menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Student</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard/schooladmin">Home</a></li>
                                <li class="breadcrumb-item active"> Student Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary" id="showuser" type="button"> <i class="feather icon-user-plus icon-left"></i> Add Student </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="">
                    <div class="row">
                        <div class="col-md-12 adduser" style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Student </h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" id="sectionform" method="post" novalidate enctype="multipart/form-data">
                                            <div class="row">
                                                <!-- <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="client_id" class="required">School Name<span class="error">&nbsp;*</span></label>
                                        <select id='client_id' name="client_id" class="form-control">
                                            <option value="">--Select Class--</option>
                                            <?php
                                            if (!empty($school_list)) {
                                                foreach ($school_list as $list) {
                                            ?>
                                                    <option value="<?= $list->client_id; ?>"<?= (!empty($section_details->client_id) && $section_details->client_id == $list->client_id) ? 'selected' : ''; ?>><?php echo $list->client_name; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </fieldset>
                                </div> -->
                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="student_name" class="required">Student Name<span class="error">&nbsp;*</span></label>
                                                        <input type="text" class="form-control" name="student_name" id="student_name" placeholder="Enter the Student Name">
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="student_rfid_no" class="required">Student RFID Number<span class="error">&nbsp;*</span></label>
                                                        <input type="text" class="form-control" name="student_rfid_no" id="student_rfid_no" placeholder="Student RFID Number">
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="student_rollno" class="required">Student Roll Number<span class="error">&nbsp;*</span></label>
                                                        <input type="text" class="form-control" name="student_rollno" id="student_rollno" placeholder="Student Roll Number">
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="student_dob" class="required">Student DOB<span class="error">&nbsp;*</span></label>
                                                        <input type="date" class="form-control" name="student_dob" id="student_dob" placeholder="Student DOB">
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="classname" class="required requiredimei">Parent Name<span class="error">&nbsp;*</span></label>
                                                        <select id='parent_id' name="parent_id" class="form-control">
                                                            <option value="">--Select Parent--</option>
                                                            <?php if (!empty($parent_list)) {
                                                                foreach ($parent_list as $list) {
                                                            ?>
                                                                    <option value="<?= $list->userid; ?>"><?php echo $list->firstname . ' - ' . $list->lastname; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="class_id" class="required">Class Name<span class="error">&nbsp;*</span></label>
                                                        <select id='class_id' name="class_id" class="form-control">
                                                            <option value="">--Select Class--</option>
                                                            <?php if (!empty($class_list)) {
                                                                foreach ($class_list as $list) {
                                                            ?>
                                                                    <option value="<?= $list->class_id; ?>"><?php echo $list->class_name; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="sectionid" class="required">Section Name<span class="error">&nbsp;*</span></label>
                                                        <select id='sectionid' name="section_id" class="form-control">
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="route_id" class="required">Morning Route Name<span class="error">&nbsp;*</span></label>
                                                        <select id='route_id' name="route_id" class="form-control">
                                                            <option value="">--Select Route--</option>
                                                            <?php if (!empty($route_list)) {
                                                                foreach ($route_list as $list) {
                                                            ?>
                                                                    <option value="<?= $list->route_id; ?>"><?php echo $list->route_name; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="stop_id" class="required">Morning Stop Name<span class="error">&nbsp;*</span></label>
                                                        <select id='stop_id' name="stop_id" class="form-control select2">

                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                                    <fieldset class="form-group">
                                                        <label for="route_id" class="required">Evening Route Name<span class="error">&nbsp;*</span></label>
                                                        <select id='evening_route_id' name="evening_route_id" class="form-control">
                                                            <option value="">--Select Route--</option>
                                                            <?php if (!empty($route_list)) {
                                                                foreach ($route_list as $list) {
                                                            ?>
                                                                    <option value="<?= $list->route_id; ?>"><?php echo $list->route_name; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1"> 
                                                    <fieldset class="form-group">
                                                        <label for="stop_id" class="required">Evening Stop Name<span class="error">&nbsp;*</span></label>
                                                        <select id='evening_stop_id' name="evening_stop_id" class="form-control select2">

                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <!-- <div class="col-xl-4 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="gender">Status</label>
                                            <select class="form-control" id="status" name="status">                                               
                                                <option value="1">Active</option>
                                                <option value="2">Deactive</option>
                                            </select>
                                        </fieldset>
                                    </div>             -->

                                                <input type="hidden" name="student_id" id="student_id" value="">
                                                <input type="hidden" name="status" id="status" value=1>

                                                <div class="col-xl-12 col-lg-12 col-md-12">
                                                    <input type="submit" class="btn btn-primary btn-min-width mr-1 btn-next btn-next1 block-page" value="Submit" id='submit'>
                                                    <button type="button" class="btn btn-primary btn-min-width" id="closeform">Reset</button>
                                                </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>

        </div>

        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="table-responsive">

                                        <table id="studentlist" class="table table-striped table-bordered">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Student Name</th>
                                                    <th>Student Roll Number</th>
                                                    <th>Student DOB</th>
                                                    <th>Parent Name</th>
                                                    <th>Class Name</th>
                                                    <th>Section Name</th>
                                                    <th>Route name</th>
                                                    <th>Stop name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
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
    <!-- END: Content-->
    <script>
        divlightbox();

        function divlightbox() {
            // define the $ as jQuery for multiple uses
            jQuery(function($) {
                var table = $('#studentlist').dataTable({
                    "bProcessing": false,
                    "sAjaxSource": "<?php echo site_url(); ?>/Student/get_studentlist",
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "responsive": true,
                    "bDestroy": true,
                    "iDisplayLength": 10,
                    "aoColumns": [{
                            mData: 'S No'
                        },
                        {
                            mData: 'student_name'
                        },
                        {
                            mData: 'student_rollno'
                        },
                        {
                            mData: 'student_dob'
                        },
                        {
                            mData: 'parent_name'
                        },
                        {
                            mData: 'class_name'
                        },
                        {
                            mData: 'section_name'
                        },
                        {
                            mData: 'route_name'
                        },
                        {
                            mData: 'stop_name'
                        },
                        {
                            mData: 'Action'
                        },
                    ]
                });
                $.fn.dataTable.ext.errMode = 'throw';


            });
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {

            $("#sectionform").submit(function(e) {

                var student_id = $('#student_id').val();
                e.preventDefault();
                var form = $(this);


                var url = '<?php echo site_url('student/save_student/'); ?>' + student_id;
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        //    alert(data);
                        $.unblockUI();
                        if (data == 2) {
                            toastr.success("Data Updated Successfully!", "UPDATE", {
                                progressBar: !0
                            });
                        } else {
                            toastr.success("Data Insert Successfully!", "INSERT", {
                                progressBar: !0
                            });
                        }
                        divlightbox();
                        //alert(data);
                        $('.adduser').hide(); //Add userpage hide
                        $('#configuration').show();
                        //    location.reload(true);
                    }
                });
            });

            $("#class_id").click(function(e) {

                var class_id = $("#class_id").val();
                //  alert(class_id);
                $.ajax({

                    type: "POST",
                    url: "<?php echo site_url(); ?>/Student/section_list/",
                    // dataType: 'json',
                    data: {
                        class_id: class_id
                    },
                    success: function(data) {
                        console.log(data);
                        var obj = JSON.parse(data);
                        $('#sectionid').empty();
                        $.each(obj, function(key, value) {
                            $('#sectionid')
                                .append($("<option></option>")
                                    .attr("value", value.section_id)
                                    .text(value.section_name));
                        });
                    }
                });


            });



            $("#route_id").click(function(e) {

                var route_id = $("#route_id").val();
                // alert(route_id);
                $.ajax({

                    type: "POST",
                    url: "<?php echo site_url(); ?>/Student/stop_list/",
                    // dataType: 'json',
                    data: {
                        route_id: route_id
                    },
                    success: function(data) {
                        // console.log(data);
                        var obj = JSON.parse(data);
                        $('#stop_id').empty();
                        $.each(obj, function(key, value) {
                            $('#stop_id')
                                .append($("<option></option>")
                                    .attr("value", value.stop_id)
                                    .text(value.stop_name + ' - ' + value.Lat + ' ' + value.Lng));
                        });
                    }
                });


            });

            $("#evening_route_id").click(function(e) {

                var route_id = $("#evening_route_id").val();
                // alert(route_id);
                $.ajax({

                    type: "POST",
                    url: "<?php echo site_url(); ?>/Student/stop_list/",
                    // dataType: 'json',
                    data: {
                        route_id: route_id
                    },
                    success: function(data) {
                        // console.log(data);
                        var obj = JSON.parse(data);
                        $('#evening_stop_id').empty();
                        $.each(obj, function(key, value) {
                            $('#evening_stop_id')
                                .append($("<option></option>")
                                    .attr("value", value.stop_id)
                                    .text(value.stop_name + ' - ' + value.Lat + ' ' + value.Lng));
                        });
                    }
                });


            });



        });

        function editdata(thisid) {
            // alert(thisid);

            $.ajax({
                type: "POST",
                datatype: "json",
                url: "<?php echo site_url('Student/edit_student/'); ?>",
                data: {
                    thisid: thisid
                },
                success: function(response) {
                    console.log(response);
                    $('.adduser').show(1000);
                    $('#configuration').hide();
                    var obj = JSON.parse(response);
                    $("#class_id").val(obj.class_id);
                    //    $("#sectionid").val(obj.section_id);
                    // $("#class_id").val(obj.class_id);
                    $("#student_id").val(obj.student_id);
                    $("#student_name").val(obj.student_name);
                    $("#student_rfid_no").val(obj.student_rfid_no);
                    $("#student_rollno").val(obj.student_rollno);
                    $("#student_dob").val(obj.student_dob);
                    $("#parent_id").val(obj.parent_id);
                    $("#route_id").val(obj.route_id);
                    $("#evening_route_id").val(obj.evening_route_id);
                    $("#status").val(obj.status);


                    $.ajax({

                        type: "POST",
                        url: "<?php echo site_url(); ?>/Student/section_list/",
                        // dataType: 'json',
                        data: {
                            class_id: obj.class_id
                        },
                        success: function(data) {
                            // console.log(data);
                            var obj1 = JSON.parse(data);

                            $('#sectionid').empty();
                            $.each(obj1, function(key, value) {

                                if (value.section_id == obj.section_id) {
                                    $('#sectionid')
                                        .append($("<option></option>")
                                            .attr("value", value.section_id)
                                            .attr("selected", "selected")
                                            .text(value.section_name));

                                } else {
                                    $('#sectionid')
                                        .append($("<option></option>")
                                            .attr("value", value.section_id)
                                            .text(value.section_name));

                                }

                            });
                        }
                    });

                    $.ajax({

                        type: "POST",
                        url: "<?php echo site_url(); ?>/Student/stop_list/",
                        // dataType: 'json',
                        data: {
                            route_id: obj.route_id
                        },
                        success: function(data) {
                            // console.log(data);
                            var obj2 = JSON.parse(data);
                            $('#stop_id').empty();
                            $.each(obj2, function(key, value) {
                                //  alert(obj.stop_id);
                                if (value.stop_id == obj.stop_id) {
                                    // alert(value.stop_id);

                                    $('#stop_id')
                                        .append($("<option></option>")
                                            .attr("value", value.stop_id)
                                            .attr("selected", "selected")
                                            .text(value.stop_name));

                                } else {
                                    $('#stop_id')
                                        .append($("<option></option>")
                                            .attr("value", value.stop_id)
                                            .text(value.stop_name));

                                }

                            });

                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(); ?>/Student/stop_list/",
                        // dataType: 'json',
                        data: {
                            route_id: obj.evening_route_id
                        },
                        success: function(data) {
                            console.log(data);
                            var obj2 = JSON.parse(data);
                            $('#evening_stop_id').empty();
                            $.each(obj2, function(key, value) {
                                //  alert(obj.stop_id);
                                if (value.stop_id == obj.evening_stop_id) {
                                    //alert(value.stop_id);

                                    $('#evening_stop_id')
                                        .append($("<option></option>")
                                            .attr("value", value.stop_id)
                                            .attr("selected", "selected")
                                            .text(value.stop_name));

                                } else {
                                    $('#stop_id')
                                        .append($("<option></option>")
                                            .attr("value", value.stop_id)
                                            .text(value.stop_name));

                                }

                            });


                        }
                    });






                },
                error: function() {
                    console.log('Error While Request User Edit List..');
                }

            });
        }
        //
        function deletedata(thisid) {

            if (confirm("Are you sure you want to delete this?")) {

                $.ajax({
                    type: "POST",
                    datatype: "json",
                    url: "<?php echo site_url('Student/delete_student/'); ?>",
                    data: {
                        thisid: thisid
                    },
                    success: function(response) {
                        //alert(response);
                        toastr.warning("Data Deleted Successfully", "Progress Bar", {
                            progressBar: !0
                        });
                        divlightbox();
                        $('#configuration').show();
                    },
                    error: function() {
                        console.log('Error While Request User Delete List..');
                    }

                });
            } else {
                return false;
            }

        }

        $("#showuser").click(function() {
            $('#sectionform')[0].reset();
            $('#sectionid').empty();
            $('#stop_id').empty();
            $('#class_id').val("");

            $('.adduser').show(2000); //Add userpage hide
            $('#configuration').hide(); // hide view page
        });
        $("#closeform").click(function() {

            location.reload();
        });
    </script>