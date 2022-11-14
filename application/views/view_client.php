    <style>

      .table-responsive {

        max-height: 300px;

      }

    </style>

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

          Customer Details

          <!--<small>Optional description</small>-->

        </h1>

        <ol class="breadcrumb">

          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li class="active">Customer Details</li>

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

                    <!--<div class="row">

                    <div class="col-md-4">

                      <h4>Account No: <?php //echo $client_account;

                                      ?></h4>                  

                    </div>

                    <div class="col-md-4"></div>

                    <div class="col-md-4"></div>

                  </div>-->

                    <br />

                    <div class="row">

                      <div class="col-md-3">

                        <label>Name: </label>

                        <p><?php echo $client_name; ?></p>

                      </div>

                      <div class="col-md-3">

                        <label>Father's Name: </label>

                        <p><?php echo $client_father; ?></p>

                      </div>

                      <div class="col-md-3">

                        <label>Mother's Name: </label>

                        <p><?php echo $client_mother; ?></p>

                      </div>

                      <div class="col-md-3">

                        <label>Email: </label>

                        <p><?php echo $client_email; ?></p>

                      </div>



                    </div>

                    <br />

                    <div class="row">

                      <div class="col-md-2">

                        <label>Mobile: </label>

                        <p><?php echo $client_mobile; ?></p>

                      </div>

                      <div class="col-md-2">

                        <label>Gender: </label>

                        <p><?php echo $client_gender; ?></p>

                      </div>

                      <div class="col-md-2">

                        <label>DOB: </label>

                        <p><?php echo $client_dob; ?></p>

                      </div>

                      <div class="col-md-4">

                        <label>Current Address: </label>

                        <p><?php echo $client_current_address; ?></p>

                      </div>

                      <div class="col-md-2">

                        <label>Pincode: </label>

                        <p><?php echo $client_cpincode; ?></p>

                      </div>

                    </div>

                    <br />

                    <div class="row">

                      <div class="col-md-4">

                        <label>Permanent Address: </label>

                        <p><?php echo $client_permanent_address; ?></p>

                      </div>

                      <div class="col-md-2">

                        <label>Pincode: </label>

                        <p><?php echo $client_ppincode; ?></p>

                      </div>

                      <div class="col-md-2">

                        <label>Aadhar No.: </label>

                        <p><?php echo $client_aadhar; ?></p>

                      </div>

                      <div class="col-md-2">

                        <label>Occupation: </label>

                        <p><?php echo $client_occupation; ?></p>

                      </div>

                      <div class="col-md-2">

                        <label>Anual Income: </label>

                        <p>&#x20B9; <?php echo $client_income; ?></p>

                      </div>

                      <div class="col-md-4">

                        <label>Request Date: </label>

                        <p><?php echo $client_date; ?></p>

                      </div>



                    </div>

                    <br />

                    <div class="row">

                      <div class="col-md-3">

                        <label>Gaurantor Name:</label>

                        <?php echo $client_guarantor; ?>

                      </div>

                      <div class="col-md-3">

                        <label>Mobile:</label>

                        <?php echo $client_gmobile; ?>

                      </div>

                      <div class="col-md-6">

                        <label>Gaurantor Address:</label>

                        <?php echo $client_gaddress; ?>

                      </div>

                    </div>

                    <br />

                    <div class="row">

                      <div class="col-md-4">

                        <label>Aadhar Card: </label>

                        <a href="<?php echo base_url(); ?>uploads/client_aadhar/<?php echo $client_aadhar_card; ?>" target="_blank">Click Here</a>

                      </div>

                      <div class="col-md-4">

                        <label>Guarantor Photo: </label>

                        <a href="<?php echo base_url(); ?>uploads/guarantor_photos/<?php echo $client_gphoto; ?>" target="_blank">Click Here</a>

                      </div>

                    </div>



                  </div>

                  <div class="col-md-4">

                    <center><img src="<?php echo base_url(); ?>uploads/client_photos/<?php echo $client_photo; ?>" class="img-responsive thumbnail" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;"></center>

                    <a href="<?php echo base_url(); ?>main/timeline/<?php echo $client_id; ?>">

                      <center><button class="btn-primary"><i class="fa fa-comments"></i> Process Timeline</button></center>

                    </a>

                  </div>

                </div>



              </div>

            </div>

          </div>

        </div>

        <?php $loanData = $this->db->order_by('id', 'DESC')->get_where('tbl_customers_loan', array('customer_id' => $client_id))->result_array(); ?>

        <?php  foreach ($loanData as $loanDetail) : ?>

          <div class="row">

            <div class="col-md-12">

              <div class="box box-primary">

                <div class="box-header">

                  <h4 class="box-title">Loan Account No. : <?php echo $loanDetail['loan_account']; ?></h4>

                  <a href="<?php echo base_url(); ?>uploads/application_documents/<?php echo $loanDetail['loan_application']; ?>" target="_blank"><label class="pull-right">Loan Application Document</label></a>

                </div>

                <div class="box-body">

                  <div class="row">

                    <div class="col-md-3">

                      <label>Loan Amount:</label>

                      &#x20B9; <?php echo $loanDetail['loan_amount']; ?>

                    </div>

                    <div class="col-md-2">

                      <label>Duration:</label>

                      <?php echo $loanDetail['loan_duration']; ?> <?php echo $loanDetail['duration_unit']; ?>

                    </div>

                    <div class="col-md-3">

                      <label>Processing Fee:</label> <?php echo $loanDetail['processing_fee'] ?>%

                    </div>

                    <div class="col-md-2">
                    <?php if($loanDetail['loan_status']=="Rejected"){?>
                      <label>Loan Status:</label> <label class="label label-primary" data-toggle="modal" data-target="#exampleModal"><?php echo $loanDetail['loan_status']; ?></label>
                    <?php } else { ?>
                             <label>Loan Status:</label> <label class="label label-primary"><?php echo $loanDetail['loan_status']; ?></label>
                    <?php }  ?>  
                    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rejected Reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $loanDetail['rejection_remark']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
                    <div class="col-md-2">

                      <label>Payment Method:</label> <label class="label label-success"><?php echo $loanDetail['disbursement_method']; ?></label>

                    </div>

                  </div>

                  <br />

                  <div class="row">

                    <div class="col-md-2">

                      <label>Interest:</label>

                      <?php echo $loanDetail['interest_rate']; ?>%

                    </div>

                    <div class="col-md-3">

                      <label>Repayment:</label>

                      &#x20B9; <?php echo $loanDetail['repayment_amount']; ?>

                    </div>

                    <div class="col-md-2">

                      <label>Disbursed:</label>

                      &#x20B9; <?php echo $loanDetail['disbursed_amount']; ?>

                    </div>

                    <div class="col-md-2">

                      <label>EMI Amount:</label>

                      &#x20B9; <?php echo $loanDetail['emi_amount']; ?>

                    </div>

                    <div class="col-md-2">

                      <label>EMI Starts:</label>

                      <?php echo $loanDetail['emi_start_date']; ?>

                    </div>

                  </div>
                  <div class="row">
                      <div class="col-md-3">
                          <label>Sales Agent:</label>
                            <?php 

                              $application_user = $this->db->get_where('tbl_users', array('user_id' => $loanDetail['application_user']))->row_array();

                              echo $application_user['user_name'] ?>
                      </div>
                      <div class="col-md-3">
                          <label>Collection Agent:</label>
                             <?php $collection_user = $this->db->get_where('tbl_users', array('user_id' => $loanDetail['collection_user']))->row_array();

                              echo $collection_user['user_name'] ?>
                      </div>
                  </div>
                </div>

              </div>

            </div>

          </div>

          <?php if ($loanDetail['loan_status'] == 'Disbursed' || $loanDetail['loan_status'] == 'Closed' || $loanDetail['loan_status'] == 'Loan Topup') { ?>

            <div class="row">

              <div class="col-md-12">

                <div class="box box-primary">

                  <div class="box-header">

                    <h4 class="box-title">Payment History</h4>

                    <div class="row">



                      <div class="col-md-3">

                        <h5>Repayment Amount: &#x20B9; <?php echo $loanDetail['repayment_amount']; ?> </h5>

                      </div>

                      <div class="col-md-3">

                        <h5>Paid Amount: &#x20B9;

                          <?php $receivedTotal = 0;

                          $Receive = $this->db->get_where('tbl_payments', array('pay_client' => $client_id, 'pay_loan' => $loanDetail['id']))->result_array();

                          foreach ($Receive as $Rec) :

                            $receivedTotal += $Rec['pay_amount'];

                          endforeach;

                          echo $receivedTotal; ?>

                        </h5>

                      </div>

                      <div class="col-md-3">

                        <h5>Waived Off Amount: &#x20B9;

                          <?php $totalwaivedOff = 0;

                          $waivedOff = $this->db->get_where('tbl_waived_off', array('user_id' => $client_id, 'loan_id' => $loanDetail['id']))->result_array();
                        //  echo "<pre>"; print_r($waivedOff); 
                          foreach ($waivedOff as $wo) :

                            $totalwaivedOff += $wo['waived_off'];

                          endforeach;

                          echo $totalwaivedOff; ?>

                        </h5>

                      </div>

                      <div class="col-md-3">

                        <h5>Due Amount: &#x20B9; <?php echo $loanDetail['repayment_amount'] - ($receivedTotal + $totalwaivedOff); ?> </h5>

                      </div>

                    </div>



                  </div>

                  <div class="box-body">

                    <table class="table table-bordered">

                      <thead>

                        <th>S.No.</th>

                        <th>Payment Amount</th>

                        <th>Payment Date</th>

                        <th>Collected By</th>

                        <th>Received By</th>
                        <th>Source</th>

                      </thead>

                      <tbody>

                        <?php $i = 0;

                        $payments = $this->db->get_where('tbl_payments', array('pay_client' => $client_id, 'pay_loan' => $loanDetail['id']))->result_array();

                        foreach ($payments as $pay) :
                          //echo "<pre>"; print_r($pay);
                          $i++; ?>

                          <tr>

                            <td><?php echo $i; ?>.</td>

                            <td>&#x20B9; <?php echo $pay['pay_amount']; ?></td>

                            <td><?php echo date("d-m-Y",strtotime($pay['add_date'])); ?></td>

                            <td>

                              <?php $agent = $this->db->get_where('tbl_users', array('user_id' => $pay['pay_agent']))->row_array();

                              echo $agent['user_name'] ?>

                            </td>

                            <td>

                              <?php $agent = $this->db->get_where('tbl_users', array('user_id' => $pay['pay_update_by']))->row_array();

                              echo $agent['user_name'] ?>

                            </td>
                            <td><?php if($pay['source_id']==0) {?><a href="<?php echo site_url() ?>/main/myCashBook"> Cash </a><?php } else { ?> <a href="<?php echo site_url() ?>/main/bank_details/<?php echo $pay['source_id'] ?>"> Bank </a>  <?php } ?></td>
                          </tr>

                        <?php endforeach; ?>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-12">

                <div class="box box-primary">

                  <div class="box-header">

                    <div class="row">

                      <div class="col-md-3">

                        <h4 class="box-title">

                          Penalty History

                        </h4>

                      </div>

                      <div class="col-md-3">

                        <h5>

                          Total Penalty: &#x20B9;

                          <?php

                          $CI = &get_instance();

                          $pAmount = $CI->totalPenalty($client_id, $loanDetail['id']);

                          echo $pAmount; ?>

                        </h5>

                      </div>

                      <div class="col-md-3">

                        <h5>

                          Total Paid Penalty: &#x20B9;

                          <?php $TotalPaid = 0;

                          $paidPenalty = $this->db->get_where('tbl_penalty', array('user_id' => $client_id, 'loan_id' => $loanDetail['id']))->result_array();

                          foreach ($paidPenalty as $PaidPenalty) :

                            $TotalPaid += $PaidPenalty['paid_amount'] + $PaidPenalty['waived_off'];
                           // $TotalPaid += $PaidPenalty['paid_amount'] ;

                          endforeach;

                          echo $TotalPaid; ?>

                        </h5>

                      </div>

                      <div class="col-md-3">

                        <h5>

                          Total Due Penalty: &#x20B9;

                          <?php echo $pAmount - $TotalPaid; ?>

                        </h5>

                      </div>

                    </div>

                  </div>

                  <div class="box-body">

                    <table class="table table-bordered">

                      <thead>

                        <th>S.No.</th>

                        <th>Paid Amount</th>

                        <th>Waived Off Amount</th>

                        <th>Payment Date</th>

                        <th>Collected By</th>

                        <th>Received By</th>
                        <th>Sources</th>

                      </thead>

                      <?php $penaltyH = $this->db->get_where('tbl_penalty', array('user_id' => $client_id, 'loan_id' => $loanDetail['id']))->result_array();

                      $i = 0;

                      foreach ($penaltyH as $pData) :

                        $i++; ?>

                        <tr>

                          <td><?php echo $i; ?></td>

                          <td>&#x20B9; <?php echo $pData['paid_amount']; ?></td>

                          <td>&#x20B9; <?php echo $pData['waived_off']; ?></td>

                          <td><?php echo $pData['payment_date']; ?></td>

                          <td>

                            <?php $agent = $this->db->get_where('tbl_users', array('user_id' => $pData['payment_user']))->row_array();

                            echo $agent['user_name'] ?>

                          </td>

                          <td>

                            <?php $agent = $this->db->get_where('tbl_users', array('user_id' => $pData['payment_update']))->row_array();

                            echo $agent['user_name'] ?>

                          </td>
         <td><?php if($pData['source_id']=="0") {?><a href="<?php echo site_url() ?>/main/myCashBook"> Cash </a><?php } elseif($pData['source_id']!=0) { ?> <a href="<?php echo site_url() ?>/main/bank_details/<?php echo $pData['source_id'] ?>"> Bank </a>  <?php } elseif($pData['source_id']=null) { ?>  - <?php }  ?></td>


                        </tr>

                      <?php endforeach; ?>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-12">

                <div class="box box-primary">

                  <div class="box-header">

                    <div class="card-header">

                      <h3 class="card-title">EMI Details</h3>

                      <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" id="flip">

                          <i class=" fa fa-minus"></i>

                        </button>

                        <a href="<?php echo site_url() ?>/main/dailyPayments?agent_id=<?php echo $loanDetail['collection_user'] ?>&mobile=<?php  echo $client_mobile; ?>&client_name=<?php echo $client_name ?>&mobile=<?php  echo $client_mobile; ?>&file_number=<?php echo $loanDetail['file_no'] ?>" class="btn btn-tool">Add Payment</a>

                      </div>

                    </div>

                  </div>

                  <div class="box-body table-responsive">



                    <table class="table table-bordered" id="panel">

                      <thead>

                        <th>S.no</th>
                        <th>EMI Date</th>

                        <th>EMI Amount</th>

                        <th>Paid Amount</th>

                        <th>Due Amount</th>

                        <th>Penalty</th>

                        <th>Status</th>

                        <th>Payment Date</th>

                      </thead>

                      <tbody>

                        <?php

                        $emiTotal = 0;

                        $paidAmount = 0;

                        $Balance = 0;

                        $penalty = 0;
                        $i = 1;

                        $emis = $this->db->get_where('tbl_emi', array('emi_client' => $client_id, 'emi_loan' => $loanDetail['id']))->result_array();

                        foreach ($emis as $emi) :

                          $emiTotal += $emi['emi_amount'];

                          $paidAmount += $emi['emi_paid']; ?>

                          <tr>

                            <td><?php echo $i ?></td>
                            <td><?php echo $emi['emi_date']; ?></td>

                            <td>&#x20B9; <?php echo $emi['emi_amount']; ?></td>

                            <td>&#x20B9; <?php echo $emi['emi_paid']; ?></td>

                            <td>&#x20B9; <?php echo $emi['emi_paid'] - $emi['emi_amount']; ?></td>

                            <?php

                            $CI = &get_instance();

                            $pAmount = $CI->CalculatePenalty($emi['emi_id']); ?>

                            <td>&#x20B9; <?php echo $pAmount;

                                          $penalty += $pAmount; ?></td>

                            <td>

                              <?php if ($emi['emi_status'] > 0) { ?>

                                <label class="label label-success">Paid</label>

                              <?php } else { ?>

                                <label class="label label-default">Unpaid</label>

                              <?php } ?>

                            </td>

                            <td>

                              <?php echo $emi['emi_payment_date']; ?>

                            </td>

                          </tr>

                        <?php

                          $Balance += ($emi['emi_paid'] - $emi['emi_amount']);
                            $i++;
                        endforeach; ?>

                      </tbody>

                      <tfoot>

                        <th>Total</th>

                        <th>&#x20B9; <?php echo $emiTotal; ?></th>

                        <th>&#x20B9; <?php echo $paidAmount ?></th>

                        <th>&#x20B9; <?php echo $emiTotal - $paidAmount ?></th>

                        <th>&#x20B9; <?php echo $penalty ?></th>

                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          <?php } ?>

          <center>

            <?php if ($loanDetail['loan_status'] == 'Pending' || $loanDetail['loan_status'] == 'Rejected') { ?>

              <?php if (in_array('editLoan', $permissions)) { ?>

                <a href="<?php echo base_url(); ?>main/ClientEdit/<?php echo $client_id; ?>/<?php echo $loanDetail['id']; ?>"><button class="btn-primary">Edit Application</button></a>

              <?php } ?>

            <?php } ?>

            <?php if ($loanDetail['loan_status'] == 'Pending' || $loanDetail['loan_status'] == 'Submitted') { ?>

              <?php if (in_array('rejectLoan', $permissions)) { ?>

                <button class="btn-danger" id="reject">Reject Application</button>

              <?php } ?>

            <?php } ?>

            <?php if ($loanDetail['loan_status'] == 'Rejected' || $loanDetail['loan_status'] == 'Pending') { ?>

              <a href="<?php echo base_url(); ?>main/customers/ApplicationSubmit/<?php echo $client_id; ?>/<?php echo $loanDetail['id']; ?>"><button class="btn-success">Submit Application</button></a>

            <?php } ?>

            <?php if ($loanDetail['loan_status'] == 'Submitted') { ?>

              <?php if (in_array('approveLoan', $permissions)) { ?>

                <a href="<?php echo base_url(); ?>main/customers/ApplicationApprove/<?php echo $client_id; ?>/<?php echo $loanDetail['id']; ?>"><button class="btn-info">Approve Application</button></a>

              <?php } ?>

            <?php } ?>

            <?php if ($loanDetail['loan_status'] == 'Approved') { ?>

              <?php if (in_array('disburseLoan', $permissions)) { ?>

                <button class="btn-success" id="Disburse">Disburse Loan</button>

              <?php } ?>

            <?php } ?>

          </center>

          <?php if ($loanDetail['loan_status'] == 'Disbursed') { ?>

            <center>

              <?php if (in_array('disburseLoan', $permissions)) { ?>

                <?php if (in_array('topUp', $permissions)) { ?>

                  <button class="btn-primary" id="topup">Top-Up Account</button>

                <?php } ?>

                <?php if (in_array('loanSettlement', $permissions)) { ?>

                  <button class="btn-danger" id="settelement">Loan Settelement</button>

                <?php } ?>

                <?php if (in_array('penaltySettlement', $permissions)) { ?>

                  <button class="btn-info" id="Penaltysettelement">Penalty Settelement</button>

                <?php } ?>

              <?php } ?>

            </center>





            <div class="row" id="settelePenalty" style="display: none">

              <br />

              <div class="col-md-3"></div>

              <div class="col-md-6">

                <div class="box box-primary">

                  <div class="box-header">

                    <h4 class="box-title">Penalty Settelement</h4>

                  </div>

                  <div class="box-body">

                    <form method="post" action="<?php echo base_url(); ?>main/penaltySettelement">

                      <input type="hidden" name="user_id" value="<?php echo $client_id; ?>">

                      <input type="hidden" name="loan_id" value="<?php echo $loanDetail['id']; ?>">

                      <?php $TotalPaid = 0;

                      $paidPenalty = $this->db->get_where('tbl_penalty', array('user_id' => $client_id, 'loan_id' => $loanDetail['id']))->result_array();

                      foreach ($paidPenalty as $PaidPenalty) :

                        $TotalPaid += $PaidPenalty['paid_amount'] + $PaidPenalty['waived_off'];

                      endforeach;

                      $duePenalty = $penalty - $TotalPaid; ?>

                      <label>Due Penalty:</label>

                      <input type="text" class="form-control" value="<?php echo $duePenalty ?>" name="penalty" id="DuePenalty" placeholder="Due Penalty" readonly />

                      <br />

                      <label>Waived Off Penalty:</label>

                      <input type="text" class="form-control" name="waived_off" id="waivedOffPenalty" value="0" placeholder="Waived off Amount" required />

                      <br />

                      <label>Received Penalty Amount:</label>

                      <input type="text" class="form-control" name="received" id="ReceivedPenalty" value="0" placeholder="Received Penalty Amount" required />

                      <br />

                      <label>Remaining Penalty Amount:</label>

                      <input type="text" class="form-control" id="remainPenalty" name="due" value="0" placeholder="Due Penalty Amount" readonly />

                      <br />
                    <div class="form-group">

                      <label> Payment Method</label>

                      <select class="form-control" name="payment_type" required onchange="ChechMethod(this)">

                        <option value="">Select Payment Method</option>

                        <option value="By Cash">By Cash</option>

                        <option value="other">Other</option>
<!-- 
                        <option value="PhonePe">PhonePe</option>

                        <option value="PayTM">PayTM</option>

                        <option value="UPI">UPI</option>

                        <option value="IMPS/NEFT/RTGS">IMPS/NEFT/RTGS</option> -->



                      </select>

                    </div>
                    <div class="form-group hide" id="sopenalty" >

                      <label>Other Sources: </label>


                      <select class="form-control select2" name="sources" id="sourpenalty"  >

                        <option value="">Select Other Sources</option>

                        <?php $agents=$this->db->get_where('tbl_bank', array('status'=>1))->result_array();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['id'];?>"><?php echo $agent['title'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>
                      <label>Collection Agent:</label>

                      <select class="form-control" name="user" required>

                        <option value="">Select Employee/Agent</option>

                        <?php $users = $this->db->get_where('tbl_users', array('user_status' => 1))->result_array();

                        foreach ($users as $user) : ?>

                          <option value="<?php echo $user['user_id']; ?>" <?php if ($this->session->userdata('user_id') == $user['user_id']) {

                                                                            echo 'selected';

                                                                          } ?>><?php echo $user['user_name']; ?></option>

                        <?php endforeach; ?>

                      </select>

                      <br />

                      <center><button type="submit" class="btn-primary"><i class="fa fa-save"></i> Save</button></center>

                    </form>

                  </div>

                </div>

              </div>

            </div>

            <div class="row" id="CloseLoan" style="display: none">

              <br />

              <div class="col-md-3"></div>

              <div class="col-md-6">

                <div class="box box-primary">

                  <div class="box-header">

                    <h4>Loan Account Settelement</h4>

                  </div>

                  <div class="box-body">

                    <form method="post" action="<?php echo base_url(); ?>main/loanSettelement">

                      <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

                      <input type="hidden" name="loan_id" value="<?php echo $loanDetail['id']; ?>">

                      <label>Total Outstanding Amount:</label>

                      <input type="text" class="form-control" name="amount" value="<?php echo $emiTotal - $paidAmount ?>" id="TotalOutstanding" placeholder="Total Outstanding Amount" readonly />

                      <br />

                      <label>Waived Off Amount:</label>

                      <input type="text" class="form-control" name="waived_off" value="0" placeholder="Waived Off Amount" id="waivedOffAmount" required />

                      <br />

                      <label>Received Loan Amount:</label>

                      <input type="text" class="form-control" name="ramount" value="0" placeholder="Received Loan Amount" id="ReceivedLoanAmount" required />

                      <br />

                      <label>Remaining Loan Amount:</label>

                      <input type="text" class="form-control" name="RemainingAmount" id="RemainingAmount" value="0" placeholder="Remaining Loan Amount" readonly />

                      <br />
                    <div class="form-group">

                      <label> Payment Method</label>

                      <select class="form-control" name="payment_type" required onchange="ChechMethod(this)">

                        <option value="">Select Payment Method</option>

                        <option value="By Cash">By Cash</option>

                        <option value="other">Other</option>
<!-- 
                        <option value="PhonePe">PhonePe</option>

                        <option value="PayTM">PayTM</option>

                        <option value="UPI">UPI</option>

                        <option value="IMPS/NEFT/RTGS">IMPS/NEFT/RTGS</option> -->



                      </select>

                    </div>
                    <div class="form-group hide" id="soSettelement" >

                      <label>Other Sources: </label>


                      <select class="form-control select2" name="sources" id="sourSettelement"  >

                        <option value="">Select Other Sources</option>

                        <?php $agents=$this->db->get_where('tbl_bank', array('status'=>1))->result_array();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['id'];?>"><?php echo $agent['title'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>
                      <label>Collection Agent:</label>

                      <select class="form-control" name="user" required>

                        <option value="">Select Employee/Agent</option>

                        <?php $users = $this->db->get_where('tbl_users', array('user_status' => 1))->result_array();

                        foreach ($users as $user) : ?>

                          <option value="<?php echo $user['user_id']; ?>" <?php if ($this->session->userdata('user_id') == $user['user_id']) {

                                                                            echo 'selected';

                                                                          } ?>><?php echo $user['user_name']; ?></option>

                        <?php endforeach; ?>

                      </select>

                      <br />

                      <center><button type="submit" class="btn-primary">Account Setteled </button></center>

                    </form>

                  </div>

                </div>

              </div>

            </div>

            <div class="row" id="topUp" style="display: none">

              <br />

              <div class="col-md-3"></div>

              <div class="col-md-6">

                <div class="box box-primary">

                  <div class="box-header">

                    <h4 class="box-title">TopUp Loan Account</h4>

                  </div>

                  <div class="box-body">

                    <form method="post" action="<?php echo base_url(); ?>main/topupAccount">

                      <input type="hidden" name="user_id" value="<?php echo $client_id; ?>">

                      <input type="hidden" name="loan_id" value="<?php echo $loanDetail['id']; ?>">

                      <label>Total Outstanding Amount:</label>

                      <input type="text" class="form-control" name="outstanding" id="outstanding" value="<?php echo $emiTotal - $paidAmount ?>" placeholder="Total Outstanding Amount" readonly />

                      <br />

                      <label>Waived Off Amount:</label>

                      <input type="text" class="form-control" id="loanwaived_off" value="0" name="loanwaived_off" placeholder="Waived Off Amount" required />

                      <br />

                      <label>Received Loan Amount:</label>

                      <input type="text" class="form-control" name="ramount" value="0" id="ramount" placeholder="Received Loan Amount" required />

                      <br />

                      <?php $TotalPaid = 0;

                      $paidPenalty = $this->db->get_where('tbl_penalty', array('user_id' => $client_id, 'loan_id' => $loanDetail['id']))->result_array();

                      foreach ($paidPenalty as $PaidPenalty) :

                        $TotalPaid += $PaidPenalty['paid_amount'] + $PaidPenalty['waived_off'];

                      endforeach;

                      $duePenalty = $penalty - $TotalPaid; ?>

                      <label>Due Penalty:</label>

                      <input type="text" class="form-control" value="<?php echo $duePenalty ?>" id="duePenalty" name="penalty" placeholder="Due Penalty" readonly />

                      <br />



                      <label>Waived Off Penalty:</label>

                      <input type="text" class="form-control" name="penaltywaived_off" value="0" id="penaltywaived_off" placeholder="Waived off Amount" required />

                      <br />



                      <label>Received Penalty Amount:</label>

                      <input type="text" class="form-control" name="penaltyreceived" value="0" id="penaltyreceived" placeholder="Received Penalty Amount" required />

                      <br />

                      <label>Final Due Amount:</label>

                      <input type="text" class="form-control" name="finalDue" id="finalDue" value="<?php echo $emiTotal - $paidAmount + $duePenalty; ?>" placeholder="Final Due Amount" readonly />

                      <br />


                    <div class="form-group">

                      <label> Payment Method</label>

                      <select class="form-control" name="payment_type" required onchange="ChechMethod(this)">

                        <option value="">Select Payment Method</option>

                        <option value="By Cash">By Cash</option>

                        <option value="other">Other</option>
<!-- 
                        <option value="PhonePe">PhonePe</option>

                        <option value="PayTM">PayTM</option>

                        <option value="UPI">UPI</option>

                        <option value="IMPS/NEFT/RTGS">IMPS/NEFT/RTGS</option> -->



                      </select>

                    </div>
                    <div class="form-group hide" id="sotopup" >

                      <label>Other Sources: </label>


                      <select class="form-control select2" name="sources" id="sourtopup"  >

                        <option value="">Select Other Sources</option>

                        <?php $agents=$this->db->get_where('tbl_bank', array('status'=>1))->result_array();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['id'];?>"><?php echo $agent['title'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>
                      <label>Collection Agent:</label>

                      <select class="form-control" name="user" required>

                        <option value="">Select Employee/Agent</option>

                        <?php 
                        $CI = &get_instance();
                  $users = $CI->report_user();
                //  echo $totalFee; 
                        // $users = $this->db->get_where('tbl_users', array('user_status' => 1))->result_array();

                        foreach ($users as $user) : ?>

                          <option value="<?php echo $user['user_id']; ?>" <?php if ($this->session->userdata('user_id') == $user['user_id']) {

                                                                            echo 'selected';

                                                                          } ?>><?php echo $user['user_name']; ?></option>

                        <?php endforeach; ?>

                      </select>

                      <br />

                      <center><button type="submit" class="btn-primary"><i class="fa fa-save"></i> Save</button></center>

                    </form>

                  </div>

                </div>

              </div>

            </div>

          <?php } ?>

          <center>

            <br />

            <div class="col-md-3"></div>

            <div class="col-md-6">

              <div class="box box-primary" id="reason" style="display: none">

                <div class="box-header">

                  <h4 class="box-title">Rejection Reason</h4>

                </div>

                <div class="box-body">

                  <form method="post" action="<?php echo base_url(); ?>main/customers/Reject">

                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

                    <input type="hidden" name="loan_id" value="<?php echo $loanDetail['id']; ?>">

                    <textarea class="form-control" placeholder="Reason of Rejection" name="reason"></textarea>

                    <br />

                    <button type="submit" class="btn-primary">Save Reason</button>

                  </form>

                </div>

              </div>

            </div>

          </center>

          <div class="row" id="Disbursed" style="display:none;">

            <br />

            <div class="col-md-3"></div>

            <div class="col-md-6">

              <div class="box box-primary">

                <div class="box-body">

                  <form method="post" action="<?php echo base_url(); ?>main/customers/LoanDisburse">

                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

                    <input type="hidden" name="loan_id" value="<?php echo $loanDetail['id']; ?>">

                    <div class="form-group">

                      <label> Payment Method</label>

                      <select class="form-control" name="payment_type" required onchange="ChechMethod(this)">

                        <option value="">Select Payment Method</option>

                        <option value="By Cash">By Cash</option>

                        <option value="other">Other</option>
<!-- 
                        <option value="PhonePe">PhonePe</option>

                        <option value="PayTM">PayTM</option>

                        <option value="UPI">UPI</option>

                        <option value="IMPS/NEFT/RTGS">IMPS/NEFT/RTGS</option> -->



                      </select>

                    </div>

                    <div class="form-group Details hide">

                      <textarea name="details" class="form-control" placeholder="Details"></textarea>

                    </div>
                    <div class="form-group hide" id="so" >

                      <label>Other Sources: </label>


                      <select class="form-control select2" name="sources" id="sour"  >

                        <option value="">Select Other Sources</option>

                        <?php $agents=$this->db->get_where('tbl_bank', array('status'=>1))->result_array();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['id'];?>"><?php echo $agent['title'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>
                    <div class="form-group">

                      <label>Collection Employee/Agent</label>

                      <select class="form-control" name="user" required>

                        <option value="">Select Employee/Agent</option>

                        <?php $users = $this->db->get_where('tbl_users', array('user_status' => 1))->result_array();

                        foreach ($users as $user) : ?>

                          <option value="<?php echo $user['user_id']; ?>"><?php echo $user['user_name']; ?></option>

                        <?php endforeach; ?>

                      </select>

                    </div>

                    <br />

                    <center><button type="submit" class="btn-primary">Save Data</button></center>

                  </form>

                </div>

              </div>

            </div>

          </div>

        <?php endforeach; ?>

      </section>

      <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->



    <!-- Main Footer -->

    <?php include('inc/footer.php'); ?>

    <script type="text/javascript">

      $("#flip").click(function() {

        $("#panel").slideToggle();

      });



      function ChechMethod($this) {



        if ($($this).val() == "other") {

          $('#so').removeClass('hide');
          $('#soSettelement').removeClass('hide');
          $('#sopenalty').removeClass('hide');
          $('#sotopup').removeClass('hide');
          $('#sour').attr('required',true);
          $('#sourpenalty').attr('required',true);
          $('#sourtopup').attr('required',true);
          $('#sourSettelement').attr('required',true);

        } else {

          $('#sotopup').addClass('hide');
          $('#sopenalty').addClass('hide');
          $('#so').addClass('hide');
          $('#soSettelement').addClass('hide');
$('#sourpenalty').attr('required',false);
$('#sour').attr('required',false);
$('#sourtopup').attr('required',false);
$('#sourSettelement').attr('required',false);
        }

      }

      $(document).ready(

        function() {

          $("#reject").click(function() {

            $("#reason").toggle("slow");

          });



          $("#Disburse").click(function() {

            $("#Disbursed").toggle("slow");

          });



          $("#settelement").click(function() {

            $("#settelePenalty").hide("slow");

            $("#topUp").hide("slow");

            $("#CloseLoan").toggle("slow");

          });



          $("#Penaltysettelement").click(function() {

            $("#CloseLoan").hide("slow");

            $("#topUp").hide("slow");

            $("#settelePenalty").toggle("slow");

          });



          $("#topup").click(function() {

            $("#CloseLoan").hide("slow");

            $("#settelePenalty").hide("slow");

            $("#topUp").toggle("slow");

          });

        });

    </script>

    <script type="text/javascript">

      $(document).ready(function() {

        $('#loanwaived_off').on('change', function() {

          var loan_amount = $('#outstanding').val();

          var loanwaived_off = $('#loanwaived_off').val();

          var loanReceived = $('#ramount').val();

          var duePenalty = $('#duePenalty').val();

          var penaltywaived_off = $('#penaltywaived_off').val();

          var penaltyreceived = $('#penaltyreceived').val();

          var finalDue = parseInt(loan_amount) + parseInt(duePenalty) - loanwaived_off - loanReceived - penaltywaived_off - penaltyreceived;

          $('#finalDue').val(finalDue);

        });

        $('#ramount').on('change', function() {

          var loan_amount = $('#outstanding').val();

          var loanwaived_off = $('#loanwaived_off').val();

          var loanReceived = $('#ramount').val();

          var duePenalty = $('#duePenalty').val();

          var penaltywaived_off = $('#penaltywaived_off').val();

          var penaltyreceived = $('#penaltyreceived').val();

          var finalDue = parseInt(loan_amount) + parseInt(duePenalty) - loanwaived_off - loanReceived - penaltywaived_off - penaltyreceived;

          $('#finalDue').val(finalDue);

        });



        $('#penaltywaived_off').on('change', function() {

          var loan_amount = $('#outstanding').val();

          var loanwaived_off = $('#loanwaived_off').val();

          var loanReceived = $('#ramount').val();

          var duePenalty = $('#duePenalty').val();

          var penaltywaived_off = $('#penaltywaived_off').val();

          var penaltyreceived = $('#penaltyreceived').val();

          var finalDue = parseInt(loan_amount) + parseInt(duePenalty) - loanwaived_off - loanReceived - penaltywaived_off - penaltyreceived;

          $('#finalDue').val(finalDue);

        });



        $('#penaltyreceived').on('change', function() {

          var loan_amount = $('#outstanding').val();

          var loanwaived_off = $('#loanwaived_off').val();

          var loanReceived = $('#ramount').val();

          var duePenalty = $('#duePenalty').val();

          var penaltywaived_off = $('#penaltywaived_off').val();

          var penaltyreceived = $('#penaltyreceived').val();

          var finalDue = parseInt(loan_amount) + parseInt(duePenalty) - loanwaived_off - loanReceived - penaltywaived_off - penaltyreceived;

          $('#finalDue').val(finalDue);

        });

      });

    </script>

    <script type="text/javascript">

      $(document).ready(function() {

        $('#waivedOffPenalty').on('change', function() {

          var DuePenalty = $('#DuePenalty').val();

          var waivedOffPenalty = $('#waivedOffPenalty').val();

          var finalDue = DuePenalty - waivedOffPenalty;

          $('#remainPenalty').val(finalDue);

        });

        $('#ReceivedPenalty').on('change', function() {

          var DuePenalty = $('#DuePenalty').val();

          var waivedOffPenalty = $('#waivedOffPenalty').val();

          var ReceivedPenalty = $('#ReceivedPenalty').val();

          var finalDue = DuePenalty - waivedOffPenalty - ReceivedPenalty;

          $('#remainPenalty').val(finalDue);

        });

      });

    </script>

    <script type="text/javascript">

      $(document).ready(function() {

        $('#waivedOffAmount').on('change', function() {

          var TotalOutstanding = $('#TotalOutstanding').val();

          var waivedOffAmount = $('#waivedOffAmount').val();

          var finalDue = TotalOutstanding - waivedOffAmount;

          $('#RemainingAmount').val(finalDue);

        });

        $('#ReceivedLoanAmount').on('change', function() {

          var TotalOutstanding = $('#TotalOutstanding').val();

          var waivedOffAmount = $('#waivedOffAmount').val();

          var ReceivedLoanAmount = $('#ReceivedLoanAmount').val();

          var finalDue = TotalOutstanding - waivedOffAmount - ReceivedLoanAmount;

          $('#RemainingAmount').val(finalDue);

        });

      });

    </script>

