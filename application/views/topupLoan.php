    <?php include('inc/header.php');?>
     <?php $SettingsData=$this->db->get('tbl_loan_settings')->row_array();
     $loanData=$this->db->get_where('tbl_customers_loan', array('id'=>$loan_id))->row_array();
     $customerData=$this->db->get_where('tbl_customers', array('client_id'=>$loanData['customer_id']))->row_array();?>
   <style type="text/css">
   .file {
   visibility: hidden;
   position: absolute;
   }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
       Loan TopUp
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Loan TopUp</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">       
        <div class="col-md-12"> 
        <?php if(!empty($this->session->flashdata('ClientError_msg'))){ ?>
                <center><label class="label label-danger"><?php echo $this->session->flashdata('ClientError_msg'); ?></label></center>
              <?php } ?>
              <?php if(!empty($this->session->flashdata('ClientSuccess_msg'))){ ?>
                <center><label class="label label-success"><?php echo $this->session->flashdata('ClientSuccess_msg'); ?></label></center>
              <?php } ?>        
          <div class="box box-primary">
            <div class="box-header">
              <h4 class="box-title">Personal Information</h4>
            </div>
            <div class="box-body">
             <form method="post" action="<?php echo base_url();?>main/loanTopup/SaveData" enctype="multipart/form-data">
              <input type="hidden" name="client_id" value="<?php echo $loanData['customer_id'];?>">
              <input type="hidden" name="loan_id" value="<?php echo $loanData['id'];?>">
               <div class="row">
                 <div class="col-md-3">
                 <div class="form-group">
                   <label>Customer Name:</label>
                   <input type="text" name="name" placeholder="Customer Name" value="<?php echo $customerData['client_name'];?>" class="form-control" required>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Father's Name:</label>
                   <input type="text" name="father" placeholder="Father's Name" value="<?php echo $customerData['client_father'];?>" class="form-control" required>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Mother's Name:</label>
                   <input type="text" name="mother" value="<?php echo $customerData['client_mother'];?>" placeholder="Mother's Name" class="form-control" required>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Date of Birth:</label>
                   <input type="text" name="dob" id="datepicker" value="<?php echo $customerData['client_dob'];?>" placeholder="DOB" class="form-control" required>
                 </div>
               </div>
              
               </div>
               <div class="row">
                 <div class="col-md-3">
                 <div class="form-group">
                   <label>Gender:</label>
                   <select class="form-control" name="gender" required>
                     <option value="">Select Gender</option>
                     <option value="Male" <?php if($customerData['client_gender']=='Male'){ echo 'selected';}?>>Male</option>
                     <option value="Female" <?php if($customerData['client_gender']=='Female'){ echo 'selected';}?>>Female</option>
                   </select>
                 </div>
               </div>
                 <div class="col-md-3">
                 <div class="form-group">
                   <label>Email:</label>
                   <input type="text" name="email" value="<?php echo $customerData['client_email'];?>" placeholder="Customer Email" class="form-control">
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Mobile:</label>
                   <input type="text" name="mobile" value="<?php echo $customerData['client_mobile'];?>" placeholder="Customer Mobile" class="form-control" required>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Aadhar No.:</label>
                   <input type="text" name="aadhar" value="<?php echo $customerData['client_aadhar'];?>" placeholder="Customer Addhar" class="form-control" required>
                 </div>
               </div>
               
               </div>
               <div class="row">
                <div class="col-md-3">
                 <div class="form-group">
                   <label>Occupation:</label>
                   <select class="form-control" name="occupation" required>
                     <option value="">Select</option>
                     <option value="Self Employed" <?php if($customerData['client_occupation']=='Self Employed'){ echo 'selected';}?>>Self Employed</option>
                     <option value="Salaried" <?php if($customerData['client_occupation']=='Salaried'){ echo 'selected';}?>>Salaried</option>
                     <option value="Govt. Employee" <?php if($customerData['client_occupation']=='Govt. Employee'){ echo 'selected';}?>>Govt. Employee</option>
                     <option value="Other" <?php if($customerData['client_occupation']=='Other'){ echo 'selected';}?>>Other</option>
                   </select>
                 </div>
               </div>
                <div class="col-md-6">
                 <div class="form-group">
                   <label>Current Address:</label>
                   <textarea name="caddress" placeholder="Current Address" class="form-control" required><?php echo $customerData['client_current_address'];?></textarea>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Current Pincode:</label>
                   <input type="text" name="cpincode" value="<?php echo $customerData['client_cpincode'];?>" placeholder="Current Pincode" class="form-control" required>
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label>Permanent Address:</label>
                   <textarea name="paddress" placeholder="Permanent Address" class="form-control" required><?php echo $customerData['client_permanent_address'];?></textarea>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Permanent Pincode:</label>
                   <input type="text" name="ppincode" value="<?php echo $customerData['client_ppincode'];?>" placeholder="Permanent Pincode" class="form-control" required>
                 </div>
               </div>
                 <div class="col-md-3">
                 <div class="form-group">
                   <label>Anual Income:</label>
                   <input type="text" name="income" value="<?php echo $customerData['client_income'];?>" placeholder="Anual Income" class="form-control" required>
                 </div>
               </div>              
                            
               </div>
               
              <div class="row">
                <div class="col-md-3">
                   <div class="form-group">
                     <label>Guarentor:</label>
                     <input type="text" name="guarentor" value="<?php echo $customerData['client_guarantor'];?>" placeholder="Guarentor" class="form-control" required>
                   </div>
                 </div>  
                 <div class="col-md-3">
                   <div class="form-group">
                     <label>Guarentor Mobile:</label>
                     <input type="text" name="gmobile" value="<?php echo $customerData['client_gmobile'];?>" placeholder="Guarentor Mobile" class="form-control" required>
                   </div>
                 </div>
                 <div class="col-md-4">
                   <div class="form-group">
                     <label>Guarentor Address:</label>
                     <textarea name="gaddress" placeholder="Guarentor Address" class="form-control" required><?php echo $customerData['client_gaddress'];?></textarea>
                   </div>
                 </div>
                 <div class="col-md-2">
                 <div class="form-group">
                   <label>Pincode:</label>
                   <input type="text" name="gpincode" value="<?php echo $customerData['client_gpincode'];?>" placeholder="Pincode" class="form-control" required>
                 </div>
               </div>
                <div class="col-md-3">
                 <div class="form-group">
                    <label>Client Photo</label>
                      <input type="file" name="photo" class="file">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-image"></i></span>
                            <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                            <span class="input-group-btn">
                            <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i>  Select</button>
                          </span>
                        </div>
                  </div>
                </div>
                 <div class="col-md-3">
                   <div class="form-group">
                      <label>Aadhaar Card:</label>
                        <input type="file" name="aadhar_card" class="file">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                              <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                              <span class="input-group-btn">
                              <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i>  Select</button>
                            </span>
                          </div>
                    </div>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group">
                      <label>Guarentor Photo</label>
                        <input type="file" name="gphoto" class="file">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                              <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                              <span class="input-group-btn">
                              <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i>  Select</button>
                            </span>
                          </div>
                    </div>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group">
                      <label>Application Documents:</label>
                        <input type="file" name="app_doc" class="file">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                              <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                              <span class="input-group-btn">
                              <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i>  Select</button>
                            </span>
                          </div>
                    </div>
                 </div>
               </div>
               
                 <div class="row">
                  <div class="col-md-3">
                 <div class="form-group">
                   <label>Previous Outstanding:</label>
                   <input type="text" name="previousDue" id="previousDue" value="<?php echo $loanData['previous_due'];?>" placeholder="Loan Amount" class="form-control" readonly>
                 </div>
               </div>  
                <div class="col-md-3">
                 <div class="form-group">
                   <label>Loan Amount:</label>
                   <input type="text" name="amount" id="loan_amount" value="0" placeholder="Loan Amount" class="form-control" required>
                 </div>
               </div>  
                 <div class="col-md-2">
                 <div class="form-group">
                   <label>Loan Duration:</label>
                   <input type="text" name="duration" id="duration" value="<?php echo $SettingsData['loan_duration'];?>" placeholder="Loan Duration" class="form-control" required>
                 </div>
               </div>
               <div class="col-md-2">
                 <div class="form-group">
                   <label>Duration Unit</label>
                   <select class="form-control" name="unit" id="unit" required>
                     <option value="">Select</option>
                     <option value="Day" <?php if($SettingsData['duration_unit']=='Day'){ echo 'selected';}?>>Day</option>
                     <option value="Month" <?php if($SettingsData['duration_unit']=='Month'){ echo 'selected';}?>>Month</option>
                     
                   </select>
                 </div>
               </div>             
                 <div class="col-md-2">
                   <div class="form-group">
                     <label>Processing Fee:</label>
                     <input type="text" name="fee" id="fee" placeholder="Processing Fee" value="<?php echo $SettingsData['processing_fee'];?>"  value="600" class="form-control" required>
                   </div>
                 </div> 
               </div>
               <div class="row">
                 <div class="col-md-3">
                   <div class="form-group">
                     <label>Penalty Amount:</label>
                     <input type="text" name="penalty" id="penalty" placeholder="Penalty Amount" value="<?php echo $SettingsData['penalty'];?>"  class="form-control" required>
                   </div>
                 </div> 
                 <div class="col-md-3">
                   <div class="form-group">
                     <label>Interest Rate:</label>
                     <input type="text" name="interest" id="interest" value="<?php echo $SettingsData['interest_rate'];?>" placeholder="Interest Rate" value="20" class="form-control" required>
                   </div>
                 </div> 
                 <div class="col-md-3">
                   <div class="form-group">
                     <label>Repayment Amount:</label>
                     <input type="text" name="repay"  id="repay" placeholder="Repayment Amount" class="form-control" readonly>
                   </div>
                 </div> 
                 <div class="col-md-3">
                   <div class="form-group">
                     <label>EMI Amount:</label>
                     <input type="text" name="emi" id="emi" placeholder="EMI Amount" value="" class="form-control" readonly>
                   </div>
                 </div> 
                 
                 <div class="col-md-3">
                   <div class="form-group">
                     <label>Disbursed Amount:</label>
                     <input type="text" name="damount" id="disbursed" placeholder="Disbursed Amount" value="" class="form-control" readonly>
                   </div>
                 </div>
                 <div class="col-md-3">
                 <div class="form-group">
                   <label>EMI Start Date:</label>
                   <input type="text" name="emistart" id="datepicker1" placeholder="EMI Start Date" class="form-control" required>
                 </div>
               </div> 
               <div class="col-md-3">
                       <div class="form-group">
                           <label>Employee/Agent:</label>
                           <select class="form-control" name="user"  required>
                               <option value="">Select Employee/Agent</option>
                               <?php        $CI = &get_instance();
                  $users = $CI->report_user();
                               foreach($users as $user):?>
                               <option value="<?php echo $user['user_id'];?>"<?php if($this->session->userdata('user_id')==$user['user_id']){ echo 'selected';} ?>><?php echo $user['user_name'];?></option>
                               <?php endforeach;?>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-3">
                    <label>Application Remark:</label>
                 <div class="form-group">
                   <textarea class="form-control" name="remark" placeholder="Application Remark"></textarea>
                 </div>
               </div>
               </div>
               
               <hr/>
               <center><button type="submit" class="btn-primary"><i class="fa fa-save"></i> Save Data</button></center>             
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
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript">
 
    $('#datepicker').datepicker({
      autoclose: true,
    })
     $('#datepicker1').datepicker({
      autoclose: true,
    })

   $(document).on('click', '.browse', function(){
   var file = $(this).parent().parent().parent().find('.file');
   file.trigger('click');
   });
   $(document).on('change', '.file', function(){
   $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
   });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#loan_amount').on('change', function(){
        var previousDue=$('#previousDue').val();
        var loan_amount=$('#loan_amount').val();
        var interest=$('#interest').val();
         var duration=$('#duration').val();
        var loan_interest=(loan_amount/100)*interest;
        var repayment=parseInt(loan_amount) + parseInt(loan_interest);
        $('#repay').val(repayment);      
        var emi=repayment/duration;
        $('#emi').val(emi); 
        var fee=$('#fee').val();
        var processing_fee=(loan_amount/100)*fee;
         var disbursed=loan_amount-processing_fee-previousDue;
         if(parseInt(disbursed)<0){
          alert("Your disbursed amount should be gather than zero");
          $('#loan_amount').val("");
          return false; 
         }
        $('#disbursed').val(disbursed); 
    });
    $('#fee').on('change', function(){
        var previousDue=$('#previousDue').val();
        var loan_amount=$('#loan_amount').val();
        var interest=$('#interest').val();
         var duration=$('#duration').val();
        var loan_interest=(loan_amount/100)*interest;
        var repayment=parseInt(loan_amount) + parseInt(loan_interest);
        $('#repay').val(repayment);      
        var emi=repayment/duration;
        $('#emi').val(emi); 
        var fee=$('#fee').val();
        var processing_fee=(loan_amount/100)*fee;
         var disbursed=loan_amount-processing_fee-previousDue;
        $('#disbursed').val(disbursed); 
    });
    $('#duration').on('change', function(){
      var previousDue=$('#previousDue').val();
        var loan_amount=$('#loan_amount').val();
        var interest=$('#interest').val();
         var duration=$('#duration').val();
        var loan_interest=(loan_amount/100)*interest;
        var repayment=parseInt(loan_amount) + parseInt(loan_interest);
        $('#repay').val(repayment);      
        var emi=repayment/duration;
        $('#emi').val(emi); 
        var fee=$('#fee').val();
        var processing_fee=(loan_amount/100)*fee;
         var disbursed=loan_amount-processing_fee-previousDue;
        $('#disbursed').val(disbursed); 
    });
    $('#interest').on('change', function(){
      var previousDue=$('#previousDue').val();
        var loan_amount=$('#loan_amount').val();
        var interest=$('#interest').val();
         var duration=$('#duration').val();
        var loan_interest=(loan_amount/100)*interest;
        var repayment=parseInt(loan_amount) + parseInt(loan_interest);
        $('#repay').val(repayment);      
        var emi=repayment/duration;
        $('#emi').val(emi); 
        var fee=$('#fee').val();
        var processing_fee=(loan_amount/100)*fee;
         var disbursed=loan_amount-processing_fee-previousDue;
        $('#disbursed').val(disbursed); 
    });
});


</script>
 