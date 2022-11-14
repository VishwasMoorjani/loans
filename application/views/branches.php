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
          Company Branches
          <!--<small>Optional description</small>-->
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Company Branches</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="row">
          <?php if (in_array('addBranch', $permissions)) { ?>
            <div class="col-md-4">
              <?php if (!empty($this->session->flashdata('error_msg'))) { ?>
                <center><label class="label label-danger"><?php echo $this->session->flashdata('error_msg'); ?></label></center>
              <?php } ?>
              <?php if (!empty($this->session->flashdata('success_msg'))) { ?>
                <center><label class="label label-success"><?php echo $this->session->flashdata('success_msg'); ?></label></center>
              <?php } ?>
              <div class="box box-primary">
                <div class="box-header">
                  <h4 class="box-title">New Branch</h4>
                </div>
                <div class="box-body">
                  <form method="post" action="branches/NewBranch">
                    <div class="form-group">
                      <label>Branch Name:</label>
                      <input type="text" name="branch" placeholder="Branch Name" class="form-control" required pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet" />
                    </div>
                    <div class="form-group">
                      <label>Branch Location:</label>
                      <input type="text" name="location" placeholder="Branch Location" class="form-control" required pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet">
                    </div>
                    <button type="submit" class="btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="col-md-8">
            <?php if (!empty($this->session->flashdata('BranchSuccess_msg'))) { ?>
              <center><label class="label label-success"><?php echo $this->session->flashdata('BranchSuccess_msg'); ?></label></center>
            <?php } ?>
            <?php if (!empty($this->session->flashdata('BranchInactive_msg'))) { ?>
              <center><label class="label label-warning"><?php echo $this->session->flashdata('BranchInactive_msg'); ?></label></center>
            <?php } ?>
            <div class="box box-primary">
              <div class="box-header">
                <h4 class="box-title">All Branches</h4>
              </div>
              <div class="box-body table-responsive">
                <table id="table" class="table table-bordered">
                  <thead class="bg-primary">
                    <th>S.No.</th>
                    <th>Branch Name</th>
                    <th>Branch Location</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php $i = 0;
                    $branches = $this->db->get('tbl_branches')->result_array();
                    foreach ($branches as $branch) : $i++; ?>
                      <tr>
                        <td><?php echo $i; ?>.</td>
                        <td><?php echo $branch['branch_name']; ?></td>
                        <td><?php echo $branch['branch_location']; ?></td>
                        <td>
                          <?php if ($branch['branch_status'] > 0) { ?>
                            <label class="label label-success">Active</label>
                          <?php } else { ?>
                            <label class="label label-danger">Inactive</label>
                          <?php } ?>
                        </td>
                        <td><?php echo $branch['branch_date']; ?></td>
                        <td>
                          <?php if (in_array('blockBranch', $permissions)) { ?>
                            <?php if ($branch['branch_status'] == 1) { ?>
                              <a href="<?php echo base_url(); ?>main/branches/Status/<?php echo $branch['branch_id']; ?>/<?php echo $branch['branch_status']; ?>"><button class="btn-warning" title="Inactive Now"><i class="fa fa-ban"></i></button></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url(); ?>main/branches/Status/<?php echo $branch['branch_id']; ?>/<?php echo $branch['branch_status']; ?>"><button class="btn-success" title="Activate Now"><i class="fa fa-check"></i></button></a>
                            <?php } ?>
                          <?php } ?>
                          <?php if (in_array('editBranch', $permissions)) { ?>
                            <button data-toggle="modal" data-target="#EditBranch<?php echo $branch['branch_id']; ?>" class="btn-primary"><i class="fa fa-pencil"></i></button>
                          <?php } ?>
                          <?php if (in_array('deleteBranch', $permissions)) { ?>
                            <a href="<?php echo base_url(); ?>main/branches/Delete/<?php echo $branch['branch_id']; ?>"> <button class="btn-danger"><i class="fa fa-trash"></i></button></a>
                          <?php } ?>
                        </td>
                        <div class="modal modal-primary fade" id="EditBranch<?php echo $branch['branch_id']; ?>">
                          <div class="modal-dialog">
                            <form method="post" action="branches/UpdateBranch">
                              <input type="hidden" name="branch_id" value="<?php echo $branch['branch_id']; ?>">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Update Branch</h4>
                                </div>
                                <div class="modal-body" style="background: #fff !important; color: #000 !important;">

                                  <div class="form-group">
                                    <label>Branch Name:</label>
                                    <input type="text" name="branch" placeholder="Branch Name" class="form-control" value="<?php echo $branch['branch_name']; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Branch Location:</label>
                                    <input type="text" name="location" placeholder="Branch Location" class="form-control" value="<?php echo $branch['branch_location']; ?>" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-outline pull-right"><i class="fa fa-save"></i> Update</button>
                                </div>
                            </form>
                          </div>
                        </div>
              </div>
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
          'ordering': false,
          'info': true,
          'autoWidth': false
        })
      })
    </script>