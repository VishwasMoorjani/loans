    <?php include('inc/header.php'); ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">



    <aside class="main-sidebar">
        <?php include('inc/menubar.php'); ?>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Customers</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Customers</li>
            </ol>
        </section>

        <section class="content container-fluid">

            
            <div class="row">



                <div class="col-md-12">



                    <?php if (!empty($this->session->flashdata('HeadError_msg'))) { ?>



                    <center><label
                            class="label label-danger"><?php echo $this->session->flashdata('HeadError_msg'); ?></label>
                    </center>



                    <?php } ?>



                    <?php if (!empty($this->session->flashdata('HeadSuccess_msg'))) { ?>



                    <center><label
                            class="label label-success"><?php echo $this->session->flashdata('HeadSuccess_msg'); ?></label>
                    </center>



                    <?php } ?>



                    <?php if (!empty($this->session->flashdata('HeadSuspend_msg'))) { ?>



                    <center><label
                            class="label label-warning"><?php echo $this->session->flashdata('HeadSuspend_msg'); ?></label>
                    </center>



                    <?php } ?>



                    <div class="box box-primary">

                        
                    <div class="row" style="padding:10px">
                        <form method="get" id="myForm">
                            <div class="col-md-3">
                            <div class="form-group">
                                <label>Duration:</label>
                                <div id="interestreport" class="interestreport">
                                    <div class="reportrange-inner">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span id="interest"></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="start_date" id="hidden_start_date">
                                <input type="hidden" name="end_date" id="hidden_end_date">
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>





                    </div>


                        <div class="box-body table-responsive">



                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Number</th>
                                        <th>Loan Status</th>
                                        <th>Disbursement Date</th>
                                        <th>Closing Date</th>
                                        <th>Daily EMI Amount</th>
                                        <th>Daily Principal Amount</th>
                                        <th>Daily EMI Interest</th>
                                        <th>No of Installment</th>
                                        <th>Total Interest in Duration</th>
                                        <th>Processing Fees</th>
                                        <th>Total Loan Amount</th>
                                        <th>Deposited Amount Duration</th>
                                        <th>Remaining Loan Amount</th>
                                        <th>Total Penalty</th>
                                        <th>Penalty Deposit Duration</th>
                                        <th>Pending Penalty Duration</th>
                                        <th>Sales Agent</th>
                                        <th>Collection Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach($data['data'] as $entry) { ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$entry['name']?></td>
                                        <td><?=$entry['address']?></td>
                                        <td><?=$entry['mobile']?></td>
                                        <td><?=$entry['status']?></td>
                                        <td><?=$entry['disbursed_date']?></td>
                                        <td><?=(!isset($entry['closing_date'])?'':$entry['closing_date']); ?></td>
                                        <td><?=$entry['emi_amount']?></td>
                                        <td><?=$entry['emi_principal']?></td>
                                        <td><?=$entry['emi_interest']?></td>
                                        <td><?=$entry['installments']?></td>
                                        <td><?=$entry['total_interest']?></td>
                                        <td><?=$entry['processing_fee']?></td>
                                        <td><?=$entry['total_emi']?></td>
                                        <td><?=$entry['paid_emi']?></td>
                                        <td><?=$entry['rest_emi']?></td>
                                        <td><?=$entry['total_penalty']?></td>
                                        <td><?=$entry['paid_penalty']?></td>
                                        <td><?=$entry['pending_penalty']?></td>
                                        <td><?=$entry['sales_agent']?></td>
                                        <td><?=$entry['collection_agent']?></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>

                            </table>



                        </div>



                    </div>



                </div>



            </div>



        </section>
    </div>



    <div class="ajax-loader" id="loading-image" style="display:none">



        <img src="<?php echo base_url(); ?>assets/loading.gif" class="img-responsive" />



    </div>






    <?php include('inc/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
$(document).ready(function() {
    $('#table').DataTable();
});
    </script>