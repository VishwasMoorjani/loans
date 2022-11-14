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

          New Role

          <!--<small>Optional description</small>-->

        </h1>

        <ol class="breadcrumb">

          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

          <li class="active">New Role</li>

        </ol>

      </section>

      <!-- Main content -->

      <section class="content container-fluid">

        <?php if (in_array('addRole', $permissions)) { ?>

          <form method="post" action="newRole/saveNewRole">

            <div class="row">

              <div class="col-md-12">



                <div class="box box-primary">

                  <div class="box-body">

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Branch:</label>

                          <select class="form-control" id="select3" name="branch" onchange="getDepartments(this.value);" required>

                            <option value="">Select Branch</option>

                            <?php $branches = $this->db->get_where('tbl_branches', array('branch_status' => 1))->result_array();

                            foreach ($branches as $branch) : ?>

                              <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['branch_name']; ?></option>

                            <?php endforeach; ?>

                          </select>

                        </div>

                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Department:</label>

                          <select class="form-control" id="department" name="department" required>

                            <option value="">Select Department</option>



                          </select>

                        </div>

                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>User Type:</label>

                          <select class="form-control" id="select4" name="user_type" required>

                            <option value="">Select User Type</option>



                          </select>

                        </div>

                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Employee Role:</label>

                          <input type="text" name="role" placeholder="Employee Role" class="form-control" required>

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

                              <input type="checkbox" name="permimssion[]" value="viewBranch"> View

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="addBranch"> Add

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="editBranch"> Edit

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="deleteBranch"> Delete

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="blockBranch"> DeActivate

                            </label>

                          </div>

                        </div>

                      </div>

                      <label class="label label-primary">Department:</label>

                      <div class="row">

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="viewDepartment"> View

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="addDepartment"> Add

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="editDepartment"> Edit

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="deleteDepartment"> Delete

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="blockDepartment"> DeActivate

                            </label>

                          </div>

                        </div>

                      </div>

                      <label class="label label-primary">Role:</label>

                      <div class="row">

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="viewRole"> View

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="addRole"> Add

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="editRole"> Edit

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="deleteRole"> Delete

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="blockRole"> DeActivate

                            </label>

                          </div>

                        </div>

                      </div>

                      <label class="label label-primary">Loan Settings:</label>

                      <div class="row">

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="loanSettings"> View/Update

                            </label>

                          </div>

                        </div>



                      </div>

                      <label class="label label-primary">Daily Payments:</label>

                      <div class="row">

                        <div class="col-md-3 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="dailyPayments"> Update Daily Payment

                            </label>

                          </div>

                        </div>



                      </div>

                      <label class="label label-primary">Employee:</label>

                      <div class="row">

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="viewEmployee"> View

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="addEmployee"> Add

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="editEmployee"> Edit

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="deleteEmployee"> Delete

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="blockEmployee"> DeActivate

                            </label>

                          </div>

                        </div>

                      </div>

                      <label class="label label-primary">Customer:</label>

                      <div class="row">

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="viewCustomer"> View

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="addCustomer"> Add

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="editCustomer"> Edit

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="deleteCustomer"> Delete

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="blockCustomer"> DeActivate

                            </label>

                          </div>

                        </div>

                      </div>

                      <label class="label label-primary">Loan Permissions:</label>

                      <div class="row">

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="editLoan"> Edit Loan

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="rejectLoan"> Reject Loan

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="approveLoan"> Approve Loan

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="disburseLoan"> Disburse Loan

                            </label>

                          </div>

                        </div>

                      </div>

                      <label class="label label-primary">Loan Settlement:</label>

                      <div class="row">

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="topUp"> TopUp Loan

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="loanSettlement"> Loan Settlement

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="penaltySettlement"> Penalty Settlement

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="cashBook"> Cash Book

                            </label>

                          </div>

                        </div>

                      </div>
                      <label class="label label-primary">Other Sources:</label>

                      <div class="row">
                          <div class="col-md-2 form-group">
                 <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="viewBank"   > View 

                            </label>

                          </div>
                        </div>
                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="addBank"> Add 

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="bankEdit">Edit

                            </label>

                          </div>

                        </div>

                        <div class="col-md-2 form-group">

                          <div class="checkbox">

                            <label>

                              <input type="checkbox" name="permimssion[]" value="BankActiveInactive"> Active/Inactive

                            </label>

                          </div>

                        </div>

                      </div>
                      <br />

                      <br />

                      <center><button type="submit" class="btn-primary"><i class="fa fa-save"></i>&nbsp; Save Role</button></center>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </form>

        <?php } ?>

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

            console.log(obj);

            $("#department").html(obj.html);

            $("#select4").html(obj.html2);

            //  $("#dept").html(data);

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