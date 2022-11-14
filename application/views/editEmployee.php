<?php include('inc/header.php');?>
<style type="text/css">
   .file {
   visibility: hidden;
   position: absolute;
   }
</style>
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
         Update Employee Details
         <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Update Employee Details</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content container-fluid">
      <div class="row">
         <div class="col-md-12">
            <?php if(!empty($this->session->flashdata('Emperror_msg'))){ ?>
            <center><label class="label label-danger"><?php echo $this->session->flashdata('Emperror_msg'); ?></label></center>
            <?php } ?>
            <?php if(!empty($this->session->flashdata('EmpSuccess_msg'))){ ?>
            <center><label class="label label-success"><?php echo $this->session->flashdata('EmpSuccess_msg'); ?></label></center>
            <?php } ?>        
            <div class="box box-primary">
               <div class="box-header">
                  <h4 class="box-title">Employee Information</h4>
               </div>
               <div class="box-body">
                  <form method="post" action="<?php echo base_url();?>main/editEmployee/<?php echo $user_id;?>/UpdateData" enctype="multipart/form-data">
                     <div class="row">
                      <div class="col-md-3">
                           <div class="form-group">
                              <label>Employee ID:</label>
                              <input type="text" name="emp_id" placeholder="Employee ID" value="<?php echo $employee_id;?>" class="form-control" readonly>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Name:</label>
                              <input type="text" name="name" placeholder="Employee Name" value="<?php echo $user_name;?>" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Father's Name:</label>
                              <input type="text" name="father" placeholder="Father's Name" value="<?php echo $user_father;?>" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Mother's Name:</label>
                              <input type="text" name="mother" placeholder="Mother's Name" value="<?php echo $user_mother;?>" class="form-control" required>
                           </div>
                        </div>                        
                     </div>
                     <div class="row">
                      <div class="col-md-3">
                           <div class="form-group">
                              <label>Date of Birth:</label>
                              <input type="text" name="dob" id="datepicker" placeholder="DOB" value="<?php echo $user_dob;?>" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Gender:</label>
                              <select class="form-control" name="gender" required>
                                 <option value="">Select Gender</option>
                                 <option value="Male" <?php if($user_gender=='Male'){ echo 'selected';}?>>Male</option>
                                 <option value="Female" <?php if($user_gender=='Female'){ echo 'selected';}?>>Female</option>
                                 <option value="Transgender" <?php if($user_gender=='Transgender'){ echo 'selected';}?>>Transgender</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Email:</label>
                              <input type="text" name="email" placeholder="Employee Email" value="<?php echo $user_email;?>" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Mobile:</label>
                              <input type="text" name="mobile" placeholder="Employee Mobile" value="<?php echo $user_mobile;?>" class="form-control" required>
                           </div>
                        </div>                                               
                     </div>
                     <div class="row">
                      <div class="col-md-3">
                           <div class="form-group">
                              <label>Password:</label>
                              <input type="text" name="password" placeholder="Employee Password" value="<?php echo $user_pass;?>" class="form-control" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Aadhar No.:</label>
                              <input type="text" name="aadhar" value="<?php echo $user_aadharno;?>" placeholder="Employee Aadhar No." class="form-control" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Permanent Address:</label>
                              <textarea name="paddress" placeholder="Permanent Address" class="form-control" required><?php echo $user_permanent_address;?></textarea>
                           </div>
                        </div>
                         <div class="col-md-3">
                           <div class="form-group">
                              <label>Current Address:</label>
                              <textarea name="caddress" placeholder="current Address" class="form-control" required><?php echo $user_current_address;?></textarea>
                           </div>
                        </div>
                     </div>               
                     <div class="row">
                         <div class="col-md-3">
                         <div class="form-group">
                          <label>Branch:</label>
                           <select class="form-control" name="branch" id="branch" onchange="getDepartments(this.value);" required>
                             <option>Select Branch</option>
                              <?php $CI=&get_instance();
                                $br=$CI->getBranch($user_branch);?>
                             <?php $branches=$this->db->get_where('tbl_branches', array('branch_status'=>1))->result_array();
                             foreach($branches as $branch):?>
                              <option value="<?php echo $branch['branch_id'];?>" <?php if($branch['branch_id']==$br['branch_id']){ echo 'selected';}?> ><?php echo $branch['branch_name'];?></option>
                            <?php endforeach;?>
                           </select>
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                          <label>Department:</label>
                           <select class="form-control" name="department" id="department" onchange="getRoles(this.value);" required>
                             <option>Select Department</option>
                             <?php $departments=$this->db->get_where('tbl_departments', array('department_id'=>$user_department,'department_status'=>1))->result_array();
                             foreach($departments as $dept):?>
                              <option value="<?php echo $dept['department_id'];?>" <?php if($user_department==$dept['department_id']){ echo 'selected';}?>><?php echo $dept['department_name'];?></option>
                            <?php endforeach;?>
                           </select>
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                          <label>Employee Role:</label>
                          <?php $CI=&get_instance();
                                $role=$CI->getRole($user_role);?>
                           <select class="form-control" name="role" id="role" required>
                             <option value="<?php echo $role['role_id'];?>"><?php echo $role['role_name'];?></option>
                           </select>
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                          <label>Reporting Authority:</label>
                           <select class="form-control" name="authority" id="authority" required> 
                             <option>Select Reporting Authority</option>
                             <?php $users=$this->db->get_where('tbl_users', array('user_status'=>1))->result_array();
                             foreach($users as $user):?>
                              <option value="<?php echo $user['user_id'];?>" <?php if($user_reporting==$user['user_reporting']){ echo 'selected';}?>><?php echo $user['user_name'];?></option>
                            <?php endforeach;?>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                              <div class="form-group">
                                 <label>Employee Photo:</label> <?php if(!empty($user_image)){?><label class="label label-success"><i class="fa fa-check"></i> Photo Uploaded</label><?php } else {?>
                                  <label class="label label-warning"><i class="fa fa-close"></i> Upload employee photo</label>
                                 <?php } ?>
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
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Employee Aadhar Card</label> <?php if(!empty($user_aadharcard)){?><label class="label label-success"><i class="fa fa-check"></i> Aadhar Card Uploaded</label><?php } else {?>
                                  <label class="label label-warning"><i class="fa fa-close"></i> Upload employee aadhar card</label>
                                 <?php } ?>
                                 <input type="file" name="aadharcard" class="file">
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
               <br/>
               <center><button type="submit" class="btn-primary"><i class="fa fa-save"></i> &nbsp; Update Details</button></center>             
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
<script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
function getDepartments(val) {
     var baseURL="<?php echo base_url();?>"
   $.ajax({
   type: "POST",
   url: baseURL +"main/getDepartments",
   data:'branch_id='+val,
   success: function(data){
     $("#department").html(data);  
     $("#department1").html(data);  
   }
   });
 }
 
function getRoles(val) {
     var baseURL="<?php echo base_url();?>";
   $.ajax({
   type: "POST",
   url: baseURL +"main/getRoles",
   data:'department_id='+val,
   success: function(data){
     $("#role").html(data);   
   }
   });
 }

    $('#department').select2();
    $('#role').select2();
    $('#authority').select2();

   $('#datepicker').datepicker({
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
