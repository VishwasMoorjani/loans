<?php include('inc/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
    Update Role
    <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Update Role</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content container-fluid">
    <form method="post" action="<?php echo base_url(); ?>main/editRole/updateRole">
      <input type="hidden" value="<?php echo $role_id; ?>" name="roleId" />
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Branch:</label>
                    <select class="form-control" id="select3" name="branch" onchange="getDepartments(this.value);" required>
                      <option value="">Select Branch</option>
                      <?php $branches = $this->db->get_where('tbl_branches', array('branch_status' => 1))->result_array();
                      foreach ($branches as $branch) : ?>
                      <option value="<?php echo $branch['branch_id']; ?>" <?php if ($branch['branch_id'] == $role_branch) {
                        echo 'selected';
                      } ?>><?php echo $branch['branch_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Department:</label>
                    <select class="form-control" id="department" name="department" required>
                      <?php $dept = $this->db->get_where('tbl_departments', array('department_branch' => $role_branch))->result_array();
                      foreach ($dept as $dpt) : ?>
                      <option value="<?php echo $dpt['department_id']; ?>" <?php if ($dpt['department_id'] == $role_department) {
                        echo 'selected';
                      } ?>><?php echo $dpt['department_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>User Type:</label>
                    <select class="form-control" id="select4" name="user_type" required>
                      <option value="">Select user type</option>
                      
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Employee Role:</label>
                    <input type="text" name="role" placeholder="Employee Role" class="form-control" value="<?php echo $role_name; ?>" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h4 class="box-title">Set Permission</h4>
            </div>
            <div class="box-body">
              <div class="conatainer">
                <label class="label label-primary">Branch:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="viewBranch" <?php if (in_array('viewBranch', $UserPermissions)) {
                        echo 'checked';
                        } ?>> View
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="addBranch" <?php if (in_array('addBranch', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Add
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="editBranch" <?php if (in_array('editBranch', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Edit
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="deleteBranch" <?php if (in_array('deleteBranch', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Delete
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="blockBranch" <?php if (in_array('blockBranch', $UserPermissions)) {
                        echo 'checked';
                        } ?>> DeActivate
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Department:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="viewDepartment" <?php if (in_array('viewDepartment', $UserPermissions)) {
                        echo 'checked';
                        } ?>> View
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="addDepartment" <?php if (in_array('addDepartment', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Add
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="editDepartment" <?php if (in_array('editDepartment', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Edit
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="deleteDepartment" <?php if (in_array('deleteDepartment', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Delete
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="blockDepartment" <?php if (in_array('blockDepartment', $UserPermissions)) {
                        echo 'checked';
                        } ?>> DeActivate
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Role:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="viewRole" <?php if (in_array('viewRole', $UserPermissions)) {
                        echo 'checked';
                        } ?>> View
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="addRole" <?php if (in_array('addRole', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Add
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="editRole" <?php if (in_array('editRole', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Edit
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="deleteRole" <?php if (in_array('deleteRole', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Delete
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="blockRole" <?php if (in_array('blockRole', $UserPermissions)) {
                        echo 'checked';
                        } ?>> DeActivate
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Loan Settings:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="loanSettings" <?php if (in_array('loanSettings', $UserPermissions)) {
                        echo 'checked';
                        } ?>> View/Update
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Daily Payments:</label>
                <div class="row">
                  <div class="col-md-3 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="dailyPayments" <?php if (in_array('dailyPayments', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Update Daily Payment
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Employee:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="viewEmployee" <?php if (in_array('viewEmployee', $UserPermissions)) {
                        echo 'checked';
                        } ?>> View
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="addEmployee" <?php if (in_array('addEmployee', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Add
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="editEmployee" <?php if (in_array('editEmployee', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Edit
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="deleteEmployee" <?php if (in_array('deleteEmployee', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Delete
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="blockEmployee" <?php if (in_array('blockEmployee', $UserPermissions)) {
                        echo 'checked';
                        } ?>> DeActivate
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Customer:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="viewCustomer" <?php if (in_array('viewCustomer', $UserPermissions)) {
                        echo 'checked';
                        } ?>> View
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="addCustomer" <?php if (in_array('addCustomer', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Add
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="editCustomer" <?php if (in_array('editCustomer', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Edit
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="deleteCustomer" <?php if (in_array('deleteCustomer', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Delete
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="blockCustomer" <?php if (in_array('blockCustomer', $UserPermissions)) {
                        echo 'checked';
                        } ?>> DeActivate
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Loan Permissions:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="editLoan" <?php if (in_array('editLoan', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Edit Loan
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="rejectLoan" <?php if (in_array('rejectLoan', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Reject Loan
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="approveLoan" <?php if (in_array('approveLoan', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Approve Loan
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="disburseLoan" <?php if (in_array('disburseLoan', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Disburse Loan
                      </label>
                    </div>
                  </div>
                </div>
                <label class="label label-primary">Loan Settlement:</label>
                <div class="row">
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="topUp" <?php if (in_array('topUp', $UserPermissions)) {
                        echo 'checked';
                        } ?>> TopUp Loan
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="loanSettlement" <?php if (in_array('loanSettlement', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Loan Settlement
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="penaltySettlement" <?php if (in_array('penaltySettlement', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Penalty Settlement
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="permimssion[]" value="cashBook" <?php if (in_array('cashBook', $UserPermissions)) {
                        echo 'checked';
                        } ?>> Cash Book
                      </label>
                    </div>
                  </div>

                </div>
                                     <label class="label label-primary">Other Sources:</label>

                      <div class="row">
                     <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="viewBank" <?php if (in_array('ViewBank', $UserPermissions)) {
                        echo 'checked';
                        } ?>  > View 

                            </label>

                          </div>

                        </div>
                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="addBank" <?php if (in_array('addBank', $UserPermissions)) {
                        echo 'checked';
                        } ?>  > Add 

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="bankEdit" <?php if (in_array('bankEdit', $UserPermissions)) {
                        echo 'checked';
                        } ?>  >Edit

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="BankActiveInactive" <?php if (in_array('BankActiveInactive', $UserPermissions)) {
                        echo 'checked';
                        } ?>  > Active/Inactive

                            </label>

                          </div>

                        </div>

                      </div>
                <br />
                <br />
                <?php if (in_array('editRole', $permissions)) { ?>
                <center><button type="submit" class="btn-primary"><i class="fa fa-save"></i>&nbsp; Update Role</button></center>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<?php include('inc/footer.php'); ?>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
function getDepartments(val) {
var baseURL = "<?php echo base_url(); ?>";
$.ajax({
type: "POST",
url: baseURL + "main/getDepartments",
data: 'branch_id=' + val,
success: function(data) {
const obj = JSON.parse(data);
$("#department").html(obj.html1);
$("#select4").html(obj.html2);
}
});
}
$(function() {
$('#table').DataTable({
'paging': true,
'lengthChange': true,
'searching': true,
'ordering': false,
'info': true,
'autoWidth': false
})
})
$('#select3').select2()
$('#select4').select2()
$('#department').select2()
</script>