    <?php include('inc/header.php'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
    <style type="text/css">
      .select2-container--default .select2-selection--single {
        border-radius: 0px !important;
      }

      .select2-container .select2-selection--single {
        height: 34px !important;
      }
    </style>
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
          Employee Roles

          <!--<small>Optional description</small>-->
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Employee Roles</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <?php if (!empty($this->session->flashdata('error_msg'))) { ?>
              <center><label class="label label-danger"><?php echo $this->session->flashdata('error_msg'); ?></label></center>
            <?php } ?>
            <?php if (!empty($this->session->flashdata('success_msg'))) { ?>
              <center><label class="label label-success"><?php echo $this->session->flashdata('success_msg'); ?></label></center>
            <?php } ?>
            <?php if (!empty($this->session->flashdata('RoleError_msg'))) { ?>
              <center><label class="label label-danger"><?php echo $this->session->flashdata('HeadError_msg'); ?></label></center>
            <?php } ?>
            <?php if (!empty($this->session->flashdata('RoleSuccess_msg'))) { ?>
              <center><label class="label label-success"><?php echo $this->session->flashdata('RoleSuccess_msg'); ?></label></center>
            <?php } ?>
            <?php if (!empty($this->session->flashdata('RoleInactive_msg'))) { ?>
              <center><label class="label label-warning"><?php echo $this->session->flashdata('RoleInactive_msg'); ?></label></center>
            <?php } ?>
            <div class="box box-primary">
              <div class="box-header">
                <h4 class="box-title">All Roles</h4>
                <?php if (in_array('addRole', $permissions)) { ?>
                  <a href="<?php echo base_url(); ?>main/newRole"><button class="btn-primary pull-right">Create New Role</button></a>
                <?php } ?>
              </div>
              <div class="box-body table-responsive">
                <table id="table" class="table table-bordered">
                  <thead class="bg-primary">
                    <th>S.No.</th>
                    <th>Branch</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>User Type</th>
                    <th>Permissions</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php $i = 0;
                    $roles = $this->db->get('tbl_roles')->result_array();
                    foreach ($roles as $role) : $i++; ?>
                      <tr>
                        <td><?php echo $i; ?>.</td>
                        <td>
                          <?php $CI = &get_instance();
                          $branch = $CI->getBranch($role['role_branch']);
                          echo $branch['branch_name']; ?>
                        </td>
                        <td>
                          <?php $dept = $this->db->get_where('tbl_departments', array('department_id' => $role['role_department']))->row_array();
                          echo $dept['department_name']; ?>
                        </td>
                        <td><?php echo $role['role_name']; ?></td>
                        <td> <?php $user_type = $this->db->get_where('tbl_user_type', array('id' => $role['user_type']))->row_array();
                              echo $user_type['title']; ?></td>
                        <td>
                          <?php $rolePermission = $this->db->get_where('tbl_permissions', array('user' => $role['role_id']))->row_array();
                          ?>
                          <?php echo implode(', ', (explode(',', $rolePermission['permissions']))); ?>
                        </td>
                        <td>
                          <?php if ($role['role_status'] > 0) { ?>
                            <label class="label label-success">Active</label>
                          <?php } else { ?>
                            <label class="label label-danger">Inactive</label>
                          <?php } ?>
                        </td>

                        <td><?php echo $role['role_date']; ?></td>
                        <td>
                          <?php if (in_array('blockRole', $permissions)) { ?>
                            <?php if ($role['role_status'] == 1) { ?>
                              <a href="<?php echo base_url(); ?>main/roles/Status/<?php echo $role['role_id']; ?>/<?php echo $role['role_status']; ?>"><button class="btn-warning" title="Inactive Now"><i class="fa fa-ban"></i></button></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url(); ?>main/roles/Status/<?php echo $role['role_id']; ?>/<?php echo $role['role_status']; ?>"><button class="btn-success" title="Activate Now"><i class="fa fa-check"></i></button></a>
                            <?php } ?>
                          <?php } ?>
                          <?php if (in_array('editRole', $permissions)) { ?>
                            <a href="<?php echo base_url(); ?>main/editRole/<?php echo $role['role_id']; ?>"> <button class="btn-success"><i class="fa fa-pencil"></i></button></a>
                          <?php } ?>

                          <?php if (in_array('deleteRole', $permissions)) { ?>
                            <a href="<?php echo base_url(); ?>main/roles/Delete/<?php echo $role['role_id']; ?>"> <button class="btn-danger"><i class="fa fa-trash"></i></button></a>
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
    <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

    <script>
      function getDepartments(val) {
        var baseURL = "<?php echo base_url(); ?>";
        $.ajax({
          type: "POST",
          url: baseURL + "main/getDepartments",
          data: 'branch_id=' + val,
          success: function(data) {
            $("#department").html(data);
            $("#dept").html(data);
          }
        });
      }

      $(function() {
        $('#table').DataTable({
          'paging': true,
          'lengthChange': true,
          'searching': true,
          'ordering': false,
          'info': true,
          'autoWidth': false
        })
      })
      $('#select3').select2()
      $('#department').select2()
    </script>