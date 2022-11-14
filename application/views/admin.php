    <?php include('inc/header.php'); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <?php include('inc/menubar.php'); ?>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Employee Details
                <!--<small>Optional description</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Employee Details</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Personal Details</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php $CI = &get_instance(); ?>
                                            <h5><b>Department:</b> <?php $dept = $CI->getDepartment($user_department);
                                                                    echo $dept['department_name']; ?></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5><b>Role:</b> <?php $role = $CI->getRole($user_role);
                                                                echo $role['role_name']; ?></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5><b>Reporting:</b> <?php $auth = $CI->getAuthority($user_reporting);
                                                                    echo $auth['user_name']; ?></h5>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Name: </label>
                                            <p><?php echo $user_name; ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Father's Name: </label>
                                            <p><?php echo $user_father; ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Mother's Name: </label>
                                            <p><?php echo $user_mother; ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Email: </label>
                                            <p><?php echo $user_email; ?></p>
                                        </div>

                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Mobile: </label>
                                            <p><?php echo $user_mobile; ?></p>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Gender: </label>
                                            <p><?php echo $user_gender; ?></p>
                                        </div>
                                        <div class="col-md-2">
                                            <label>DOB: </label>
                                            <p><?php echo $user_dob; ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Permanent Address: </label>
                                            <p><?php echo $user_permanent_address; ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Current Address: </label>
                                            <p><?php echo $user_current_address; ?></p>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Aadhar No.: </label>
                                            <p><?php echo $user_aadharno; ?></p>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Employee Status: </label>
                                            <p><?php if ($user_status == 0) {
                                                    echo '<label class="label label-danger">Suspended</label>';
                                                }
                                                if ($user_status == 1) {
                                                    echo '<label class="label label-success">Active</label>';
                                                }
                                                ?></p>
                                        </div>
                                    </div>
                                    <br />

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Aadhar Card: </label>
                                            <a href="<?php echo base_url(); ?>uploads/employees/document/<?php echo $user_aadharcard; ?>" target="_blank">Click Here</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <?php if (!empty($user_image)) { ?>
                                        <center><img src="<?php echo base_url(); ?>uploads/employees/photo/<?php echo $user_image; ?>" class="img-responsive thumbnail" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;"></center>
                                    <?php } else { ?>
                                        <center><img src="<?php echo base_url(); ?>assets/user-blank.jpg" class="img-responsive thumbnail" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;"></center>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include('inc/footer.php'); ?>