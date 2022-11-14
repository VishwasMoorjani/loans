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

          Loan Settings

          <!--<small>Optional description</small>-->

        </h1>

        <ol class="breadcrumb">

          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li class="active">Loan Settings</li>

        </ol>

      </section>

      <!-- Main content -->

      <section class="content container-fluid">

        <div class="row">

          <div class="col-md-3"></div>

          <div class="col-md-6">

            <?php if (!empty($this->session->flashdata('Response_Msg'))) { ?>

              <center><label class="label label-success"><?php echo $this->session->flashdata('Response_Msg'); ?></label></center>

            <?php } ?>

            <?php $SettingsData = $this->db->get('tbl_loan_settings')->row_array(); ?>

            <div class="box box-primary">

              <form method="post" action="<?php echo base_url(); ?>main/LoanSettings/SaveSettings">

                <div class="box-body">

                  <div class="form-group">

                    <label>Interest Rate:</label>

                    <input type="number" name="interest_rate" placeholder="Loan Interest Rate (%)" class="form-control" value="<?php echo $SettingsData['interest_rate']; ?>" required>

                  </div>



                  <div class="form-group">

                    <label>Processing Fee:</label>

                    <input type="number" name="processing_fee" placeholder="Loan Processing Fee (%)" class="form-control" value="<?php echo $SettingsData['processing_fee']; ?>" required>

                  </div>



                  <div class="form-group">

                    <label>Loan Duration:</label>

                    <input type="number" name="loan_duration" placeholder="Loan Duration" class="form-control" value="<?php echo $SettingsData['loan_duration']; ?>" required>

                  </div>



                  <div class="box-body">

                    <div class="form-group">

                      <label>Duration Unit</label>

                      <select class="form-control" name="unit" id="unit" required>

                        <option value="">Select</option>

                        <option value="Day" <?php if ($SettingsData['duration_unit'] == 'Day') {

                                              echo 'selected';

                                            } ?>>Day</option>

                        <option value="Month" <?php if ($SettingsData['duration_unit'] == 'Month') {

                                                echo 'selected';

                                              } ?>>Month</option>

                        <option value="Year" <?php if ($SettingsData['duration_unit'] == 'Year') {

                                                echo 'selected';

                                              } ?>>Year</option>

                      </select>

                    </div>

                    <div class="form-group">

                      <label>Loan Penalty:</label>

                      <input type="number" name="penalty" placeholder="Loan Penalaty" class="form-control" value="<?php echo $SettingsData['penalty']; ?>" required>

                    </div>

                  </div>

                  <center><button type="submit" class="btn-primary">Save Data</button></center>

                </div>

              </form>

            </div>

          </div>

        </div>

      </section>

      <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->



    <!-- Main Footer -->

    <?php include('inc/footer.php'); ?>