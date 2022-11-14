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

        Daily Payments

        <!--<small>Optional description</small>-->

      </h1>

      <ol class="breadcrumb">

         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active">Daily Payment</li>

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

                 

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Payment Date</label>

                      <input type="text" name="date" id="datepicker" placeholder="Payment Date" class="form-control" value="<?php echo date('d-m-Y');?>" required onchange="refresh()">

                    </div>

                  </div>
                  <div class="col-md-3">
                      <label>Select Type</label>
                      <br/>
                    <label class="radio-inline"><input type="radio" name="optradio" checked onchange="showOtherSorce(this)" value="cash">Cash</label>
<label class="radio-inline"><input type="radio" name="optradio" value="other" onchange="showOtherSorce(this)">Other</label>
                  </div>
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Client Name: </label>
                      <input type="text" name="client_name" class="form-control" value="<?php echo $client_name ?>" onchange="getCustomers_name(this);" id="client_name">
                      <input type="hidden" name="file_number" class="form-control" value="<?php echo $file_number ?>"  id="file_number">

                    </div>

                  </div>
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Client Mobile: </label>
                      <input type="text" name="client_mobile" value="<?php echo $mobile ?>"class="form-control" onchange="getCustomers_mobile(this);" id="client_mobiles">

                    </div>

                  </div>
                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Collection Agent: </label>

                      <select class="form-control" name="agent" onchange="getCustomers(this.value);" required id="agent">

                        <option value="">Select All</option>

                       <?php        $CI = &get_instance();
                  $agents = $CI->report_user();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['user_id'];?>" <?php if($this->session->userdata('user_id')==$agent['user_id']){echo "selected";} ?> <?php if($agent_id==$agent['user_id']){echo "selected";} ?>><?php echo $agent['user_name'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>

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

                          <th>A/C No.</th>

                          <th>Customer Details</th>

                          <th>Gaurantor Details</th>

                          <th>Disbursement Date</th>

                          <th>Loan Amount</th>                      

                          <th>Today EMI</th>                      

                          <th>Due EMI</th>

                          <th>Due Total EMI</th>
                          <th>Advance Amount</th>

                          <th>Penalty</th>

                          <th>Today Collection</th>

                        </thead>

                        <tbody id="customer">

                         

                        </tbody>

                      </table>

                      <center> <button type="submit" class="btn-primary"><i class="fa fa-inr"></i> Save Payments</button></center>

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

  <?php include('inc/footer.php');?>

  <script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

 <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

 <script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
function refresh(){
  var agent = $('#agent').val();
  var client_name = $('#client_name').val();


  getCustomers(agent);
}
function getCustomers(val) {

  var client_mobile = $('#client_mobiles').val();
   var file_number = $('#file_number').val();
     var baseURL="<?php echo base_url();?>";

     var date=$('#datepicker').val();

   $.ajax({

   type: "POST",

   url: baseURL +"main/getCustomers",

   data:'agent_id='+val+'&date='+date+'&client_mobile='+client_mobile+'&file_number='+file_number,

   success: function(data){

     $("#customer").html(data);   

   }

   });

 }
 function getCustomers_mobile($this) {
      var val  = $($this).val();
     var baseURL="<?php echo base_url();?>";

     var date=$('#datepicker').val();

   $.ajax({

   type: "POST",

   url: baseURL +"main/getCustomers",

   data:'client_mobile='+val+'&date='+date,

   success: function(data){

     $("#customer").html(data);   
     $($this).val('');
   }

   });

 }
 function getCustomers_name($this) {
      var val  = $($this).val();
     var baseURL="<?php echo base_url();?>";

     var date=$('#datepicker').val();

   $.ajax({

   type: "POST",

   url: baseURL +"main/getCustomers",

   data:'client_name='+val+'&date='+date,

   success: function(data){

     $("#customer").html(data);   
     $($this).val('');
   }

   });

 }
  $('#datepicker').datepicker({

      autoclose: true,

    })

    $('.select2').select2()

function showOtherSorce($this)
{

  if($($this).val()=="cash"){
    $('#sources').css('display','none');
     $('#so').attr('required',false);
  }else{
 $('#sources').css('display','block');
 $('#so').attr('required',true);
  }
}

$(document).ready(function(){
  refresh();
});
</script>

