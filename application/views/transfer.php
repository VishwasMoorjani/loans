<?php include('inc/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

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

            Transfer

            <!--<small>Optional description</small>-->

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Transfer Collection Agent</li>

        </ol>

    </section>

    <!-- Main content -->

    <section class="content container-fluid">

        <div class="row">

            <div class="col-md-12">

                <?php if (!empty($this->session->flashdata('transfer'))) { ?>

                    <center><label class="label label-success"><?php echo $this->session->flashdata('transfer'); ?></label></center>

                <?php } ?>

                <div class="box box-primary">



                    <div class="box-body">

                        <form method="post" action="<?php echo base_url(); ?>main/savetransfer" onSubmit="if(!confirm('Are you sure ?')){return false;}">
                            <div class="row">
                                <div class="col-md-3">
                                    <?php 
                                            // echo "<pre>"; print_r($client);
                                     ?>
                                    <div class="form-group" id="sources">
                                        <label>Current Loan Account: </label>
                                        <br />
                                        <select class="form-control select2" name="sources" id="so" required onchange="getCurrentAgent(this)">
                                            <option value="">Select  Loan Account</option>
                                            <?php

                                            foreach ($client as $agent) : ?>
                                                <option value="<?php echo $agent['id']; ?>" <?php if($loan_id==$agent['id']){echo "selected";} ?>><?php echo $agent['loan_account']; ?> (<?php echo $agent['client_name']  ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                                                <div class="col-md-3">
                                    <div class="form-group" id="sources">
                                        <label>Current collection User: </label>
                                        <br />
                                        <select class="form-control select2" name="sourcesss" id="collection" required>
                                            
                                     
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>Collection Agent: </label>

                                        <select class="form-control select2" name="agent" onchange="getCustomers(this.value);" required>

                                            <option value="">Select Collection Agent</option>

                                            <?php $agents = $this->db->get_where('tbl_users', array('user_status' => 1))->result_array();

                                            foreach ($agents as $agent) : ?>

                                                <option value="<?php echo $agent['user_id']; ?>"><?php echo $agent['user_name']; ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <center> <button type="submit" class="btn-success">Transfer</button></center>
                                </div>

                            </div>

                    </div>

                    </form>

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

<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
    function getCurrentAgent() {
        //var $($this).val();
        var id = $('#so').val();
        var baseURL = "<?php echo base_url(); ?>";
        $.ajax({
            type: "POST",
            url: baseURL + "main/getLoanAccountAgent",
            data: 'loan_account=' + id,
            success: function(data) {
                $("#collection").html(data);
            }
        });
    }

  $(document).ready(function(){
    getCurrentAgent();
  })
</script>