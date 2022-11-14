    <?php include('inc/header.php');?>
     <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

   <?php include('inc/menubar.php');?>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <!-- general form elements -->
          <?php if(!empty($this->session->flashdata('error_msg'))){ ?>
                <center><label class="label label-danger"><?php echo $this->session->flashdata('error_msg'); ?></label></center>
              <?php } ?>
              <?php if(!empty($this->session->flashdata('success_msg'))){ ?>
                <center><label class="label label-success"><?php echo $this->session->flashdata('success_msg'); ?></label></center>
              <?php } ?>
          <div class="box box-primary">
            <div class="box-header">
              <h4 class="box-title"> Change Password</h4>
            </div>
           
            <form role="form" method="post" action="<?php echo base_url();?>main/password/update_password">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Current Password</label>
                  <input type="password" name="cpass" class="form-control" id="exampleInputEmail1" placeholder="Current Password" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" name="npass" class="form-control" id="exampleInputPassword1" placeholder="New Password" required>
                </div> 
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" name="cnfpass" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" required>
                </div> 
                <center><button type="submit" class="btn-primary">Update Password</button></center>               
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->

        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('inc/footer.php');?>