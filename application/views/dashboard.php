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
          Dashboard
          <!--<small>Optional description</small>-->
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Here</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="row">

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalLoan = $CI->totalLoanAmount();
                  echo $totalLoan; ?>
                </h3>
                <p>Current Loan Amount</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
              <a href="javascript:" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalDisbursed = $CI->totalDisbursed();
                  echo $totalDisbursed; ?>
                </h3>

                <p>Current Disbursed Amount</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
               <a href="javascript:" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>       

          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalFee = $CI->totalProcessingFee();
                  echo $totalFee; ?>
                </h3>
                <p>Current Processing Fee</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
               <a href="javascript:" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalRepayment = $CI->totalRepayment();
                  echo $totalRepayment; ?>
                </h3>
                <p>Current Repayment Amount</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
 <a href="javascript:" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
                   <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalDueEMI = $CI->totalDueEMI();
                  echo $totalDueEMI; ?>
                </h3>
                <p> Today's Due EMI</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
              <a href="<?php echo site_url() ?>/main/emis" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i>
              More details</a>
            </div>
          </div>
              <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalDisbursed = $CI->getDueEMITillDate();
                  echo  $totalDisbursed; ?>
                </h3>

                <p>Total Due Emi Amount</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
            </div>
            
          </div>
                    <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $emp = $CI->getTotalemp();
                  echo $emp; ?>
                </h3>
                <p>Total Employees</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="<?php echo base_url(); ?>main/employees" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i> More details</a>
            </div>
          </div>

 
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $branch = $CI->getTotalBranch();
                  echo $branch; ?>
                </h3>
                <p>Total Branches</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
              <a href="<?php echo base_url(); ?>main/branches" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i> More details</a>
            </div>
          </div>
 




          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $pendingLoan = $CI->getTotalPendingLoans();
                  echo $pendingLoan; ?>
                </h3>
                <p>From Pending Submition</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-pdf-o"></i>
              </div>
              <a href="<?php echo site_url()  ?>/main/customers?type=Pending" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;More details</a>
            </div>
          </div>

                      <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $disbursedLoan = $CI->getTotalSubmitedLoans();
                  echo $disbursedLoan; ?>
                </h3>
                <p>Total Submited Application Loan</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
              <a href="<?php echo site_url()  ?>/main/customers?type=Submitted" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;More details</a>
            </div>
          </div>
                   <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalFee = $CI->totalApprovedLoan();
                  echo $totalFee; ?>
                </h3>
                <p>Total Approved Loan</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
              <a href="<?php echo site_url()  ?>/main/customers?type=Approved" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;More details</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $disbursedLoan = $CI->getTotalDisbursedLoans();
                  echo $disbursedLoan; ?>
                </h3>
                <p>Total Disbursed Loan</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
              <a href="<?php echo site_url()  ?>/main/customers?type=Disbursed" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;More details</a>
            </div>
          </div>
        
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $disbursedLoan = $CI->getTotalRejectedLoans();
                  echo $disbursedLoan; ?>
                </h3>
                <p>Total Rejected Application</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
              <a href="<?php echo site_url()  ?>/main/customers?type=Rejected" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;More details</a>
            </div>
          </div>
             <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalDisbursed = $CI->totalProcessingFeeTillDate();
                  echo $totalDisbursed; ?>
                </h3>

                <p>Total Processing Fees</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
                    <a href="javascript:" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>

          </div>
                       <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalDisbursed = $CI->totalwaiedoffTillDate();
                  echo $totalDisbursed; ?>
                </h3>

                <p>Total Waived off Amount</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>
                    <a href="javascript:" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
            
          </div>
                       <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box  bg-danger">
              <div class="inner">
                <h3>
                  <?php $CI = &get_instance();
                  $totalDisbursed = $CI->totalwaiepenTillDate();
                  echo $totalDisbursed; ?>
                </h3>

                <p>Total Waived off penalty</p>
              </div>
              <div class="icon">
                <i class="fa fa-inr"></i>
              </div>

                  <a href="javascript:" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
                   
          <!-- ./col -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include('inc/footer.php'); ?>