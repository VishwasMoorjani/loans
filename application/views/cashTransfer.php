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
        Cash Transfer/Deposit
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Cash Transfer/Deposit</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
     <div class="row">
       <div class="col-md-12">
         <div class="box box-primary">
           <div class="box-header">
             <h4 class="box-title">Cash Transfer/Deposit Entry</h4>
           </div>
           <div class="box-body">
             <form method="post" action="<?php echo base_url();?>main/cashTransfer/SaveEntry">
             <div class="row">
                    <div class="col-md-2">
                    <label>Select Type</label>
                      <br/>
                    <label class="radio-inline"><input type="radio" name="optradio" checked onchange="showOtherSorce(this)" value="cash">Cash</label>
<label class="radio-inline"><input type="radio" name="optradio" value="other" onchange="showOtherSorce(this)">Other</label>
                    </div>
            
               <div class="col-md-2" id="sources" style="display:none">
                 <div class="form-group" >
                   <label>Other Sources:</label>
                    <select class="form-control" name="sources"  id="so">
                     <option value="">Select Other Sources</option>

                        <?php $agents=$this->db->get_where('tbl_bank', array('status'=>1))->result_array();

                        foreach($agents as $agent):?>

                          <option value="<?php echo $agent['id'];?>"><?php echo $agent['title'];?></option>

                        <?php endforeach;?>
                    </select>
                 </div>
               </div>
               <div class="col-md-2" id="receiver">
                 <div class="form-group">
                   <label>Cash Receiver:</label>
                    <select class="form-control" name="receiver" required id="rece">
                      <option value="">Select Receiver</option>
                      <?php $emp=$this->db->get_where('tbl_users', array('user_status'=>1))->result_array();
                      foreach($emp as $eData):?>
                        <option value="<?php echo $eData['user_id'];?>">(<?php echo $eData['employee_id'];?>)&nbsp;<?php echo $eData['user_name'];?></option>
                      <?php endforeach;?>
                    </select>
                 </div>
               </div>
               <div class="col-md-2">
                 <div class="form-group">
                   <label>Amount:</label>
                   <input type="text" name="amount" class="form-control" placeholder="Amount" required>
                 </div>
               </div>
               <div class="col-md-2">
                 <div class="form-group">
                   <label>Payment Method:</label>
                   <select class="form-control" name="method" required>
                       <option value="">Payment Method</option>
                       <option valule="CASH">CASH</option>
                       <option value="PhonePe">PhonePe</option>
                       <option value="PayTM">PayTM</option>
                       <option value="UPI">UPI</option>
                       <option value="IMPS/NEFT/RTGS">IMPS/NEFT/RTGS</option>
                   </select>
                   
                 </div>
               </div>
               <div class="col-md-2">
                 <div class="form-group">
                   <label>Remark:</label>
                   <textarea class="form-control" placeholder="Remark" name="remark" required></textarea>
                 </div>
               </div>
              </div> 
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-1"></div>
              <div class="col-md-3">

               <button type="submit" class="btn-primary" ><i class="fa fa-save"></i> Save Cash Entry</button>
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
  <script type="text/javascript">
    function showOtherSorce($this)
{

  if($($this).val()=="cash"){
    $('#sources').css('display','none');
    $('#receiver').css('display','block');
     $('#so').attr('required',false);
     $('#rece').attr('required',true);
  }else{
 $('#sources').css('display','block');
 $('#so').attr('required',true);
     $('#receiver').css('display','none');
        $('#rece').attr('required',false);
  }
}

  </script>