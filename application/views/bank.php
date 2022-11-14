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
          Other Sources
          <!--<small>Optional description</small>-->
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Other Sources</li>
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
                  <h4 class="box-title">New Other Sources</h4>
                </div>
                <div class="box-body">
                  <form method="post" action="bank/Newbank">
                    <div class="form-group">
                      <label>Title:</label>
                      <input type="text" name="title" placeholder="Title" class="form-control" required pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet" />
                    </div>
                    <div class="form-group">
                      <label>Number:</label>
                      <input type="text" name="number" placeholder="number" class="form-control" required  >
                    </div>
                    <div class="form-group">
                      <label>Balance:</label>
                      <input type="text" name="balance" placeholder="Branch Balance" class="form-control" required >
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
                <h4 class="box-title">All Other Sources</h4>
              </div>
              <div class="box-body table-responsive">
                <table id="table" class="table table-bordered">
                  <thead class="bg-primary">
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Number</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php $i = 0;
                    $branches = $this->db->get(' tbl_bank')->result_array();
                    foreach ($branches as $branch) : $i++; ?>
                      <tr>
                        <td><?php echo $i; ?>.</td>
                        <td><a href="<?php echo site_url() ?>/main/bank_details/<?php echo $branch['id'] ?>"><?php echo $branch['title']; ?></a></td>
                        <td><?php echo $branch['number']; ?></td>
                        <td>
                          <?php if ($branch['status'] > 0) { ?>
                            <label class="label label-success">Active</label>
                          <?php } else { ?>
                            <label class="label label-danger">Inactive</label>
                          <?php } ?>
                        </td>
                        <td><?php echo $branch['add_date']; ?></td>
                        <td>
                          <?php if (in_array('BankActiveInactive', $permissions)) { ?>
                            <?php if ($branch['status'] == 1) { ?>
                              <a href="<?php echo base_url(); ?>main/bank/Status/<?php echo $branch['id']; ?>/<?php echo $branch['status']; ?>"><button class="btn-warning" title="Inactive Now"><i class="fa fa-ban"></i></button></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url(); ?>main/bank/Status/<?php echo $branch['id']; ?>/<?php echo $branch['status']; ?>"><button class="btn-success" title="Activate Now"><i class="fa fa-check"></i></button></a>
                            <?php } ?>
                          <?php } ?>
                          <?php if (in_array('bankEdit', $permissions)) { ?>
                            <button data-toggle="modal" data-target="#EditBranch<?php echo $branch['id']; ?>" class="btn-primary"><i class="fa fa-pencil"></i></button>
                          <?php } ?>
          
                        </td>
                        <div class="modal modal-primary fade" id="EditBranch<?php echo $branch['id']; ?>">
                          <div class="modal-dialog">
                            <form method="post" action="bank/UpdateBranch">
                              <input type="hidden" name="id" value="<?php echo $branch['id']; ?>">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Update Bank</h4>
                                </div>
                                <div class="modal-body" style="background: #fff !important; color: #000 !important;">

                                  <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" name="title" placeholder="Title" class="form-control" value="<?php echo $branch['title']; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Number:</label>
                                    <input type="text" name="number" placeholder="Number" class="form-control" value="<?php echo $branch['number']; ?>" required>
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