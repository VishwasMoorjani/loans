    <?php include('inc/header.php'); ?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

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

          Employees

          <!--<small>Optional description</small>-->

        </h1>

        <ol class="breadcrumb">

          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li class="active">Employees</li>

        </ol>

      </section>

      <!-- Main content -->

      <section class="content container-fluid">

        <div class="row">

          <div class="col-md-12">

            <?php if (!empty($this->session->flashdata('UserSuccess'))) { ?>

              <center><label class="label label-success"><?php echo $this->session->flashdata('UserSuccess'); ?></label></center>

            <?php } ?>

            <?php if (!empty($this->session->flashdata('UserSuspended'))) { ?>

              <center><label class="label label-warning"><?php echo $this->session->flashdata('UserSuspended'); ?></label></center>

            <?php } ?>

            <div class="box box-primary">

              <div class="box-header">

                <h4 class="box-title">All Employees</h4>

                <?php if (in_array('addEmployee', $permissions)) { ?>

                  <a href="<?php echo base_url(); ?>main/newEmployee"><button class="btn-primary pull-right"><i class="fa fa-user-plus"></i> New Employee</button></a>

                <?php } ?>

              </div>

              <div class="box-body">

                <table id="table" class="table table-bordered">

                  <thead class="bg-primary">

                    <th></th>

                    <th>Employee</th>

                    <th>Email</th>

                    <th>Mobile</th>

                    <th>Branch</th>

                    <th>Department</th>

                    <th>Role</th>

                    <th>Reporting</th>

                    <th>Password</th>

                    <th>Status</th>

                    <th>Last Login</th>

                    <th>Action</th>

                  </thead>

                  <tbody>

                    <?php

                    $CI = &get_instance();

                  //$reported_user = array();
                  //if($loginUserType=='admin'){
             
                  // print_r($reported_user); die;
                  if($this->session->userdata('user_type')=="super_admin"){
                   //   $employees = $this->db->query("SELECT * FROM `tbl_users` WHERE (`user_reporting` = '".$reported_user['user_id']."' OR `user_reporting` = '".$this->session->userdata('user_id')."') AND `user_type` != 'super_admin'")->result_array();
                               //echo $this->db->last_query();
                  $employees = $this->db->where('user_type !=', 'super_admin')->get('tbl_users')->result_array();
                  }else{
                     // $employees = $this->db->where('user_reporting', $reported_user['user_id'])->where('user_type !=', 'super_admin')->get('tbl_users')->result_array();
                      $employees = $this->db->query("SELECT * FROM `tbl_users` WHERE (`user_reporting` = '".$reported_user['user_id']."' OR `user_reporting` = '".$this->session->userdata('user_id')."') AND `user_type` != 'super_admin'")->result_array();
                      //echo $this->db->last_query();
                  }
                    
                       // echo $this->db->last_query();

                    foreach ($employees as $emp) : ?>

                      <tr>

                        <td>

                          <?php if (!empty($emp['user_image'])) { ?>

                            <img src="<?php echo base_url(); ?>uploads/employees/photo/<?php echo $emp['user_image']; ?>" class="img-circle" style="max-height: 40px;">

                          <?php } else { ?>

                            <img src="<?php echo base_url(); ?>assets/user-blank.jpg" class="img-circle" style="max-height: 40px;">

                          <?php } ?>

                        </td>

                        <td><a href="<?php echo base_url(); ?>main/employee/<?php echo $emp['user_id']; ?>"><?php echo $emp['user_name']; ?></a></td>

                        <td><?php echo $emp['user_email']; ?></td>

                        <td><?php echo $emp['user_mobile']; ?></td>

                        <td>

                          <?php $branch = $CI->getBranch($emp['user_branch']);

                          echo $branch['branch_name']; ?>

                        </td>

                        <td>

                          <?php $dept = $CI->getDepartment($emp['user_department']);

                          echo $dept['department_name']; ?>

                        </td>

                        <td>

                          <?php $role = $CI->getRole($emp['user_role']);

                          echo $role['role_name']; ?>

                        </td>

                        <td>

                          <?php $auth = $CI->getAuthority($emp['user_reporting']);

                          echo $auth['user_name']; ?>

                        </td>

                   <td><?php echo $emp['user_pass'] ?></td>

                        <td>

                          <?php if ($emp['user_status'] > 0) { ?>

                            <label class="label label-success">Active</label>

                          <?php } else { ?>

                            <label class="label label-danger">Suspended</label>

                          <?php } ?>

                        </td>

                        <td><?php echo $emp['user_login']; ?></td>

                        <td>

                          <?php if (in_array('blockEmployee', $permissions)) { ?>

                            <?php if ($emp['user_status'] > 0) { ?>

                              <a href="<?php echo base_url(); ?>main/newEmployee/Suspend/<?php echo $emp['user_id']; ?>/<?php echo $emp['user_status']; ?>"><button class="btn-warning"><i class="fa fa-ban"></i></button></a>

                            <?php } else { ?>

                              <a href="<?php echo base_url(); ?>main/newEmployee/Suspend/<?php echo $emp['user_id']; ?>/<?php echo $emp['user_status']; ?>"> <button class="btn-success"><i class="fa fa-check"></i></button></a>

                            <?php } ?>

                          <?php } ?>

                          <?php if (in_array('editEmployee', $permissions)) { ?>

                            <a href="<?php echo base_url(); ?>main/editEmployee/<?php echo $emp['user_id']; ?>"><button class="btn-primary"><i class="fa fa-pencil"></i></button></a>

                          <?php } ?>

                          <?php if (in_array('deleteEmployee', $permissions)) { ?>

                            <a href="<?php echo base_url(); ?>main/newEmployee/Delete/<?php echo $emp['user_id']; ?>"> <button class="btn-danger"><i class="fa fa-trash"></i></button></a>

                          <?php } ?>

                        </td>

                      </tr>

                    <?php endforeach; ?>

                  </tbody>

                </table>

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

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>

      $(function() {

        $('#table').DataTable({

          'paging': true,

          'lengthChange': true,

          'searching': true,

          'ordering': true,

          'info': true,

          'autoWidth': false



        });

      });

    </script>