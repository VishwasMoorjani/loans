<?php include('inc/header.php');?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">

<style type="text/css">

  .select2-container--default .select2-selection--single

  {

    border-radius: 0px !important;

  }

  .select2-container .select2-selection--single

  {

    height: 34px !important;

  }

</style>

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

       Collection Report

        <!--<small>Optional description</small>-->

      </h1>

      <ol class="breadcrumb">

         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active">Collection Report</li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content container-fluid">

      <div class="row">

        <div class="col-md-12">

           <?php if(!empty($this->session->flashdata('PaymentMsg'))){ ?>

                <center><label class="label label-success"><?php echo $this->session->flashdata('PaymentMsg'); ?></label></center>

              <?php } ?>

          <div class="box box-primary">

                       

            <div class="box-body">

              <form method="post" action="<?php echo base_url();?>main/savePayments">

                <div class="row">

                 

          
                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Agent: </label>

                      <select class="form-control select2" name="agent" onchange="getCustomers(this.value);" required id="agent">

                        <option value="">Select All</option>

                       <?php        $CI = &get_instance();
                  $agents = $CI->report_user();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['user_id'];?>" <?php if($this->session->userdata('user_id')==$agent['user_id']){echo "selected";} ?>><?php echo $agent['user_name'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>

                  </div>
 <div class="col-md-5">
                                <div id="reportrange" class="reportrange">
                                    <div class="reportrange-inner">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="" id="hidden_start_date">
                                <input type="hidden" name="" id="hidden_end_date">
                            </div>
                  <div class="col-md-3">

                    <div class="form-group" id="sources" style="display:none">

                      <label>Other Sources: </label>
                      <br/>

                      <select class="form-control select2" name="sources" id="so"  >

                        <option value="">Select Other Sources</option>

                        <?php $agents=$this->db->get_where('tbl_bank', array('status'=>1))->result_array();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['id'];?>"><?php echo $agent['title'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>

                  </div>

                </div>

                <br/>

                <div class="row" >

                  <div class="col-md-12">                 

                      <table class="table table-bordered">

                        <thead>

                          <th>S.No.</th>
                          <th>Employee Name</th>
                          <th>Sum</th>

                        </thead>

                        <tbody id="customer">

                         

                        </tbody>

                      </table>

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

  <?php include('footer_collection.php');?>

  <script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

 <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

 <script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
function refresh(){
  var agent = $('#agent').val();
  getCustomers(agent);
}
function getCustomers(val) {

     var baseURL="<?php echo base_url();?>";


   $.ajax({

   type: "POST",

   url: baseURL +"main/collectionreport",

   
   data: {

              agent_id: val,

              start: $('#hidden_start_date').val(),

              end: $('#hidden_end_date').val(),

            },

   success: function(data){

     $("#customer").html(data);   

   }

   });

 }

  $('#datepicker').datepicker({

      autoclose: true,

    })

    $('.select2').select2()
$(document).ready(function(){
 // refresh();
})

</script>

