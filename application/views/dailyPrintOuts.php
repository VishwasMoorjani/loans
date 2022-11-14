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

  

  @media print {

  #printPageButton {

    display: none !important;

  }

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

    Daily PrintOuts 

    <?php 

   // putenv('LC_ALL=    hi');

   // setlocale(LC_ALL, 'hi');

  //  echo gettext('Bhawani');?>

        <!--<small>Optional description</small>-->

      </h1>

      <ol class="breadcrumb">

         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active">Daily PrintOuts</li>

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

                <div class="row">

                  <div class="col-md-2"></div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Payment Date</label>

                      <input type="text" name="date" id="datepicker" placeholder="Payment Date" class="form-control" value="<?php echo date('d-m-Y');?>" required>

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Collection Agent: </label>

                      <select class="form-control select2" name="agent" onchange="getCustomers(this.value);" required id="agentid">

                        <option value="">Select All</option>

                     <?php        $CI = &get_instance();
                  $agents = $CI->report_user();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['user_id'];?>"<?php if($this->session->userdata('user_id')==$agent['user_id']){echo "selected";} ?>><?php echo $agent['user_name'];?></option>

                        <?php endforeach;?>

                      </select>

                    </div>

                  </div>

                  

                </div>

                <br/>

                <div class="row" id="printableArea">

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

                  </div>

                </div>

                <center> <button id="printPageButton" class="btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Get PrintOut</button></center>

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

function getCustomers(val) {

     var baseURL="<?php echo base_url();?>";

     var date=$('#datepicker').val();

   $.ajax({

   type: "POST",

   url: baseURL +"main/getDailyPrintOuts",

   data:'agent_id='+val+'&date='+date,

   success: function(data){

     $("#customer").html(data);   

   }

   });

 }

  $('#datepicker').datepicker({

      autoclose: true,

    })

    $('.select2').select2()

</script>

<script >

function printDiv(divName) {
     var baseURL="<?php echo base_url();?>";

     var date=$('#datepicker').val();
     var val = $('#agentid').val();
   $.ajax({

   type: "POST",

   url: baseURL +"main/getDailyPrintOutsforPrint",

   data:'agent_id='+val+'&date='+date,

   success: function(data){

     $("#customer").html(data);   

          var printContents = document.getElementById(divName).innerHTML;

     var originalContents = document.body.innerHTML;



     document.body.innerHTML = printContents;



     window.print();



     document.body.innerHTML = originalContents;

   }

   });


}
$(document).ready(function(){

  getCustomers(  $('#agentid').val());

 // $('#datepicker').Change(function(){
    $("#datepicker").change(function(){
    //alert("");
      getCustomers(  $('#agentid').val());
  });
})
</script>

