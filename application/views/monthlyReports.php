    <?php include('inc/header.php');?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
        NPA Reports
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">NPA Reports</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
     <div class="row">
         <div class="col-md-12">
             <div class="box box-primary">
                 <div class="box-header">
                     <h4>NPA Reports</h4>
                 </div>
                 <div class="box-body table-responsive">
                     <table id="table" class="table table-bordered table-stripped">
                         <thead>
                             <th>Loan A/C</th>
                             <th>Customer Name</th>
                             <th>Mobile</th>
                             <th>Loan Amount</th>
                             <th>EMI Starting On</th>
                             <th>Disbursement Date</th>
                             <th>Loan Duration</th>
                             <th>Closing Date</th>
                             <th>NPA Days</th>
                             <th>Sales Agent</th>
                             <th>Collection Agent</th>
                         </thead>
                         <tbody>
                             <?php $loanData=$this->db->get_where('tbl_customers_loan', array('loan_status'=>'Disbursed'))->result_array();
                             
                             foreach($loanData as $Data):
                                $loanDuration=$Data['loan_duration'];
                                $loanDurationType=strtolower($Data['duration_unit']);
                                $loanEMIstarts=$Data['emi_start_date'];
                                
                                $emiLastDate=date('d-m-Y', strtotime("+".$loanDuration."$loanDurationType", strtotime($loanEMIstarts)));
                                $currentDate=date('d-m-Y');
                                
                                if(strtotime($currentDate)>strtotime($emiLastDate))
                                {
                                    $npaCustomers[]=$Data['id'];
                                }
                            endforeach;
                             ?>
                             <?php
                                for($i=0; $i<sizeof($npaCustomers); $i++):
                                  $npaAccounts=$this->db->get_where('tbl_customers_loan', array('id'=>$npaCustomers[$i]))->row_array();
                                  
                                  $startDate=$npaAccounts['emi_start_date'];
                                  $duration=$npaAccounts['loan_duration'];
                                  $durationType=strtolower($npaAccounts['duration_unit']);
                                  
                                  $closingDate=date('d-m-Y', strtotime("+".$duration."$durationType", strtotime($startDate)-1));
                                  $todayDate=date('d-m-Y');
                                  
                                  $npaDays=date_diff(date_create($closingDate), date_create($todayDate));
                            ?>
                             <tr>
                                 <td><?php echo $npaAccounts['loan_account'];?></td>
                                 <td>
                                     <?php $CI = & get_instance();
                                    $customerDetails=$CI->getCustomerDetails($npaAccounts['customer_id']); ?>
                                   <a href="<?php echo base_url();?>main/ClientView/<?php echo $npaAccounts['customer_id'];?>"> <?php echo $customerDetails['client_name'];?></a>
                                 </td>
                                 <td>
                                     <?php echo $customerDetails['client_mobile'];?>
                                 </td>
                                
                                 <td>&#8377; <?php echo $npaAccounts['loan_amount'];?></td>
                                 <td><?php echo $npaAccounts['emi_start_date'];?></td>
                                 <td><?php echo $npaAccounts['disbursed_date'];?></td>
                                  <td><?php echo $npaAccounts['loan_duration'];?> <?php echo $npaAccounts['duration_unit'];?></td>
                                 <td><?php echo $closingDate;?></td>
                                 <td style="color:red">
                                   <?php echo $npaDays->format("%a");?>
                                 </td>
                                 <?php $CI = & get_instance();
                                    $userDetails=$CI->getUserDetails($npaAccounts['application_user']); ?>
                                 <td>
                                     <?php echo $userDetails['user_name'];?>
                                 </td>
                                 <?php $CI = & get_instance();
                                    $userDetails1=$CI->getUserDetails($npaAccounts['collection_user']); ?>
                                 <td>
                                     <?php echo $userDetails1['user_name'];?>
                                 </td>
                             </tr>
                           <?php endfor; ?>  
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
  <?php include('inc/footer.php');?>
  <script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
   $(function () {
     $('#table').DataTable({
       'paging'      : true,
       'lengthChange': true,
       'searching'   : true,
       'ordering'    : true,
       'info'        : true,
       'autoWidth'   : true
             
     });
   }) ; 

</script>

   