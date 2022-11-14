    <?php include('inc/header.php'); ?>
    <?php $SettingsData = $this->db->get('tbl_loan_settings')->row_array(); ?>
    <style type="text/css">
      .file {
        visibility: hidden;
        position: absolute;
      }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
          New Customer
          <!--<small>Optional description</small>-->
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">New Customer</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <?php if (!empty($this->session->flashdata('ClientError_msg'))) { ?>
              <center><label class="label label-danger"><?php echo $this->session->flashdata('ClientError_msg'); ?></label></center>
            <?php } ?>
            <?php if (!empty($this->session->flashdata('ClientSuccess_msg'))) { ?>
              <center><label class="label label-success"><?php echo $this->session->flashdata('ClientSuccess_msg'); ?></label></center>
            <?php } ?>
            <div class="box box-primary">
              <div class="box-header">
                <h4 class="box-title">Personal Information</h4>
              </div>
              <div class="box-body">
                <form method="post" action="<?php echo base_url(); ?>main/NewClient/SaveData" enctype="multipart/form-data" id="cusForm">
                  <div class="row">

                    <div class="col-md-3">
                      <div class="form-group" id="customerName">
                        <label>Customer Name:</label>
                        <input type="text" name="name" id="name" placeholder="Customer Name" class="form-control" required pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet">
                        <span class="help-block" for="NameError" style="display:none">Customer Name is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="fatherName">
                        <label>Father's Name:</label>
                        <input type="text" name="father" id="father" placeholder="Father's Name" class="form-control" required pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet">
                        <span class="help-block" for="fatherError" style="display:none">Father Name is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="motherName">
                        <label>Mother's Name:</label>
                        <input type="text" name="mother" id="mother" placeholder="Mother's Name" class="form-control" required pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet">
                        <span class="help-block" for="motherError" style="display:none">Mother Name is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="DateOfBirth">
                        <label>Date of Birth:</label>
                        <input type="date" name="dob" placeholder="DOB" class="form-control" required max="<?php echo date("Y-m-d") ?>">
                        <span class="help-block" for="dobError" style="display:none">DOB is Required*</span>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" id="Gender">
                        <label>Gender:</label>
                        <select class="form-control" name="gender" id="gender" required>
                          <option value="">Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <span class="help-block" for="genderError" style="display:none">Gender is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="Customer Email" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="Mobile">
                        <label>Mobile:</label>
                        <input type="text" name="mobile" id="mobile" placeholder="Customer Mobile" class="form-control" required pattern="[0-9]+" title="Acceot Only Number">
                        <span class="help-block" for="mobileError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="Aadhar">
                        <label>Aadhar No.:</label>
                        <input type="text" name="aadhar" id="aadhar" placeholder="Customer Addhar" class="form-control" required>
                        <span class="help-block" for="aadharError" style="display:none"></span>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" id="Occupation">
                        <label>Occupation:</label>
                        <select class="form-control" name="occupation" id="occupation" required>
                          <option value="">Select</option>
                          <option value="Self Employed">Self Employed</option>
                          <option value="Salaried">Salaried</option>
                          <option value="Govt. Employee">Govt. Employee</option>
                          <option value="Other">Other</option>
                        </select>
                        <span class="help-block" for="occupationError" style="display:none">Occupation is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" id="cAddress">
                        <label>Current Address:</label>
                        <textarea name="caddress" placeholder="Current Address" class="form-control" id="caddress" required></textarea>
                        <span class="help-block" for="caddressError" style="display:none">Current Address is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="cPincode">
                        <label>Current Pincode:</label>
                        <input type="text" name="cpincode" id="cpincode" placeholder="Current Pincode" class="form-control" required>
                        <span class="help-block" for="cpincodeError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" id="pAddress">
                        <label>Permanent Address:</label>
                        <textarea name="paddress" placeholder="Permanent Address" class="form-control" id="paddress" required></textarea>
                        <span class="help-block" for="paddressError" style="display:none"> Permanent Address is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="pPincode">
                        <label>Permanent Pincode:</label>
                        <input type="text" name="ppincode" id="ppincode" placeholder="Permanent Pincode" class="form-control" required>
                        <span class="help-block" for="ppincodeError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="Income">
                        <label>Anual Income:</label>
                        <input type="text" name="income" id="income" placeholder="Anual Income" class="form-control" required>
                        <span class="help-block" for="incomeError" style="display:none">Annual Income is Required*</span>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" id="Guarentor">
                        <label>Guarentor Name:</label>
                        <input type="text" name="guarentor" id="guarentor" placeholder="Guarentor" class="form-control" required>
                        <span class="help-block" for="guarentorError" style="display:none">Guarentor Name is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="gMobile">
                        <label>Guarentor Mobile:</label>
                        <input type="text" name="gmobile" id="gmobile" placeholder="Guarentor Mobile" class="form-control" required>
                        <span class="help-block" for="gmobileError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" id="gAddress">
                        <label>Guarentor Address:</label>
                        <textarea name="gaddress" id="gaddress" placeholder="Guarentor Address" class="form-control" required></textarea>
                        <span class="help-block" for="gaddressError" style="display:none"> Guarentor Address is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group" id="gPincode">
                        <label>Pincode:</label>
                        <input type="text" name="gpincode" id="gpincode" placeholder="Pincode" class="form-control" required>
                        <span class="help-block" for="gpincodeError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="clientPhoto">
                        <label>Client Photo</label>
                        <input type="file" name="photo" id="clientphoto" class="file" required>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-image"></i></span>
                          <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                          <span class="input-group-btn">
                            <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i> Select</button>
                          </span>
                        </div>
                        <span class="help-block" for="clientPhotoError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="aadharCard">
                        <label>Aadhaar Card:</label>
                        <input type="file" name="aadhar_card" id="aadharcard" class="file" required>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-image"></i></span>
                          <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                          <span class="input-group-btn">
                            <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i> Select</button>
                          </span>
                        </div>
                        <span class="help-block" for="aadharcardError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="gPhoto">
                        <label>Guarentor Photo</label>
                        <input type="file" name="gphoto" id="gphoto" class="file" required>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-image"></i></span>
                          <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                          <span class="input-group-btn">
                            <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i> Select</button>
                          </span>
                        </div>
                        <span class="help-block" for="gphotoError" style="display:none"></span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" id="AppDoc">
                        <label>Application Documents:</label>
                        <input type="file" name="app_doc" id="appDoc" class="file" required>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                          <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                          <span class="input-group-btn">
                            <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i> Select</button>
                          </span>
                        </div>
                        <span class="help-block" for="appDocError" style="display:none"></span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" id="LoanAmount">
                        <label>Loan Amount:</label>
                        <input type="text" name="amount" id="loan_amount" value="0" placeholder="Loan Amount" class="form-control" required>
                        <span class="help-block" for="loanAmountError" style="display:none">Loan Amount is Required*</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Loan Duration:</label>
                        <input type="text" name="duration" id="duration" value="<?php echo $SettingsData['loan_duration']; ?>" placeholder="Loan Duration" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Duration Unit</label>
                        <select class="form-control" name="unit" id="unit" required>
                          <option value="">Select</option>
                          <option value="Day" <?php if ($SettingsData['duration_unit'] == 'Day') {
                                                echo 'selected';
                                              } ?>>Day</option>
                          <option value="Month" <?php if ($SettingsData['duration_unit'] == 'Month') {
                                                  echo 'selected';
                                                } ?>>Month</option>
                          <option value="Year" <?php if ($SettingsData['duration_unit'] == 'Year') {
                                                  echo 'selected';
                                                } ?>>Year</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Processing Fee:</label>
                        <input type="text" name="fee" id="fee" placeholder="Processing Fee" value="<?php echo $SettingsData['processing_fee']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Penalty Amount:</label>
                        <input type="text" name="penalty" id="penalty" placeholder="Penalty Amount" value="<?php echo $SettingsData['penalty']; ?>" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Interest Rate:</label>
                        <input type="text" name="interest" id="interest" value="<?php echo $SettingsData['interest_rate']; ?>" placeholder="Interest Rate" value="20" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Repayment Amount:</label>
                        <input type="text" name="repay" id="repay" placeholder="Repayment Amount" class="form-control" readonly>
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
                        <label>Disbused Date:</label>
                        <input type="text" name="disbursed_date" id="datepicker2" placeholder="Disbused Date" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Employee/Agent:</label>
                        <select class="form-control" name="user" required>
                          <option value="">Select Employee/Agent</option>
                          <?php                     if ($this->session->userdata('user_type') == "super_admin") {
                            $users = $this->db->get_where('tbl_users', array('user_status' => 1))->result_array();
                            } else {

                            $users = $this->db->get_where('tbl_users', array('user_status' => 1,'user_id'=> $this->session->userdata('user_id'), 'user_branch' => $this->session->userdata('user_branch')))->result_array();
                            }
                          foreach ($users as $user) : ?>
                            <option value="<?php echo $user['user_id']; ?>" <?php if ($this->session->userdata('user_id') == $user['user_id']) {
                                                                              echo 'selected';
                                                                            } ?>><?php echo $user['user_name']; ?></option>
                          <?php endforeach; ?>
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

                  <hr />
                  <center><button type="submit" class="btn-primary" id="saveData"><i class="fa fa-save"></i> Save Data</button></center>
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
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
      $('#datepicker').datepicker({
        autoclose: true,
      })
      $('#datepicker1').datepicker({
        autoclose: true,
      })
      $('#datepicker2').datepicker({
        autoclose: true,
      })

      $(document).on('click', '.browse', function() {
        var file = $(this).parent().parent().parent().find('.file');
        file.trigger('click');
      });
      $(document).on('change', '.file', function() {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#loan_amount').on('change', function() {
          var loan_amount = $('#loan_amount').val();
          var interest = $('#interest').val();
          var duration = $('#duration').val();
          var loan_interest = (loan_amount / 100) * interest;
          var repayment = parseInt(loan_amount) + parseInt(loan_interest);
          $('#repay').val(repayment);
          var emi = repayment / duration;
          $('#emi').val(emi);
          var fee = $('#fee').val();
          var processing_fee = (loan_amount / 100) * fee;
          var disbursed = loan_amount - processing_fee;
          $('#disbursed').val(disbursed);
        });
        $('#fee').on('change', function() {
          var loan_amount = $('#loan_amount').val();
          var interest = $('#interest').val();
          var duration = $('#duration').val();
          var loan_interest = (loan_amount / 100) * interest;
          var repayment = parseInt(loan_amount) + parseInt(loan_interest);
          $('#repay').val(repayment);
          var emi = repayment / duration;
          $('#emi').val(emi);
          var fee = $('#fee').val();
          var processing_fee = (loan_amount / 100) * fee;
          var disbursed = loan_amount - processing_fee;
          $('#disbursed').val(disbursed);
        });
        $('#duration').on('change', function() {
          var loan_amount = $('#loan_amount').val();
          var interest = $('#interest').val();
          var duration = $('#duration').val();
          var loan_interest = (loan_amount / 100) * interest;
          var repayment = parseInt(loan_amount) + parseInt(loan_interest);
          $('#repay').val(repayment);
          var emi = repayment / duration;
          $('#emi').val(emi);
          var fee = $('#fee').val();
          var processing_fee = (loan_amount / 100) * fee;
          var disbursed = loan_amount - processing_fee;
          $('#disbursed').val(disbursed);
        });
        $('#interest').on('change', function() {
          var loan_amount = $('#loan_amount').val();
          var interest = $('#interest').val();
          var duration = $('#duration').val();
          var loan_interest = (loan_amount / 100) * interest;
          var repayment = parseInt(loan_amount) + parseInt(loan_interest);
          $('#repay').val(repayment);
          var emi = repayment / duration;
          $('#emi').val(emi);
          var fee = $('#fee').val();
          var processing_fee = (loan_amount / 100) * fee;
          var disbursed = loan_amount - processing_fee;
          $('#disbursed').val(disbursed);
        });
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#saveData").click(function() {
          $('#saveData').attr('disabled',true);
          $('#saveData').html('Save Data <i class="fa fa-spinner fa-spin fa-1x fa-fw submit_loader"></i>');
          var error = false;
          var name = document.getElementById("name").value;
          var father = document.getElementById("father").value;
          var mother = document.getElementById("mother").value;
         // var dob = document.getElementById("datepicker").value;
          var gender = document.getElementById("gender").value;
          var mobile = document.getElementById("mobile").value;
          var aadhar = document.getElementById("aadhar").value;
          var occupation = document.getElementById("occupation").value;
          var caddress = document.getElementById("caddress").value;
          var cpincode = document.getElementById("cpincode").value;
          var paddress = document.getElementById("paddress").value;
          var ppincode = document.getElementById("ppincode").value;
          var income = document.getElementById("income").value;
          var guarentor = document.getElementById("guarentor").value;
          var gmobile = document.getElementById("gmobile").value;
          var gaddress = document.getElementById("gaddress").value;
          var gpincode = document.getElementById("gpincode").value;
          var clientphoto = document.getElementById("clientphoto").value;
          var aadharcard = document.getElementById("aadharcard").value;
          var gphoto = document.getElementById("gphoto").value;
          var appDoc = document.getElementById("appDoc").value;
          if (name == "") {
            $("#customerName").addClass("has-error");
            $('span[for="NameError"]').css('display', 'block');
            $('#name').focus();
          $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#customerName").removeClass("has-error");
            $("#customerName").addClass("has-success");
            $('span[for="NameError"]').css('display', 'none');
          }
          if (father == "") {
            $("#fatherName").addClass("has-error");
            $('span[for="fatherError"]').css('display', 'block');
            $('#father').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#fatherName").removeClass("has-error");
            $("#fatherName").addClass("has-success");
            $('span[for="fatherError"]').css('display', 'none');
          }
          if (mother == "") {
            $("#motherName").addClass("has-error");
            $('span[for="motherError"]').css('display', 'block');
            $('#mother').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#motherName").removeClass("has-error");
            $("#motherName").addClass("has-success");
            $('span[for="motherError"]').css('display', 'none');
          }
          // if (dob == "") {
          //   $("#DateOfBirth").addClass("has-error");
          //   $('span[for="dobError"]').css('display', 'block');
          // } else {
          //   $("#DateOfBirth").removeClass("has-error");
          //   $("#DateOfBirth").addClass("has-success");
          //   $('span[for="dobError"]').css('display', 'none');
          // }
          if (gender == "") {
            $("#Gender").addClass("has-error");
            $('span[for="genderError"]').css('display', 'block');
            $("#gender").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#Gender").removeClass("has-error");
            $("#Gender").addClass("has-success");
            $('span[for="genderError"]').css('display', 'none');
          }
          if (mobile == "") {
            $("#Mobile").addClass("has-error");
            $('span[for="mobileError"]').css('display', 'block');
            $('span[for="mobileError"]').text("Mobile No. is Required*");
            $("#mobile").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (mobile.length < 10 || mobile.length > 10) {
            $("#Mobile").addClass("has-error");
            $('span[for="mobileError"]').css('display', 'block');
            $('span[for="mobileError"]').text("Enter 10 Digit Mobile No.*");
            $("#mobile").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (mobile.length > 10) {
            $("#Mobile").addClass("has-error");
            $('span[for="mobileError"]').css('display', 'block');
            $('span[for="mobileError"]').text("Enter 10 Digit Mobile No.*");
            $("#mobile").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          }

          if (aadhar == "") {
            $("#Aadhar").addClass("has-error");
            $('span[for="aadharError"]').css('display', 'block');
            $('span[for="aadharError"]').text("Aadhar No. is Required*");
            $("#aadhar").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (aadhar.length < 12 || aadhar.length > 12) {
            $("#Aadhar").addClass("has-error");
            $('span[for="aadharError"]').css('display', 'block');
            $('span[for="aadharError"]').text("Enter 12 Digit Aadhar No.*");
            $("#aadhar").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#Aadhar").removeClass("has-error");
            $("#Aadhar").addClass("has-success");
            $('span[for="aadharError"]').css('display', 'none');
          }
          if (occupation == "") {
            $("#Occupation").addClass("has-error");
            $('span[for="occupationError"]').css('display', 'block');
            $('#occupation').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#Occupation").removeClass("has-error");
            $("#Occupation").addClass("has-success");
            $('span[for="occupationError"]').css('display', 'none');
          }
          if (caddress == "") {
            $("#cAddress").addClass("has-error");
            $('span[for="caddressError"]').css('display', 'block');
            $('#caddress').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#cAddress").removeClass("has-error");
            $("#cAddress").addClass("has-success");
            $('span[for="caddressError"]').css('display', 'none');
          }
          if (cpincode == "") {
            $("#cPincode").addClass("has-error");
            $('span[for="cpincodeError"]').css('display', 'block');
            $('span[for="cpincodeError"]').text("Current Pincode is Required*");
            $('#cpincode').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (cpincode.length < 6 || cpincode.length > 6) {
            $("#cPincode").addClass("has-error");
            $('span[for="cpincodeError"]').css('display', 'block');
            $('span[for="cpincodeError"]').text("Enter 6 Digit Current Pincode*");
            $("#cpincode").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#cPincode").removeClass("has-error");
            $("#cPincode").addClass("has-success");
            $('span[for="cpincodeError"]').css('display', 'none');
          }
          if (paddress == "") {
            $("#pAddress").addClass("has-error");
            $('span[for="paddressError"]').css('display', 'block');
            $('#paddress').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#pAddress").removeClass("has-error");
            $("#pAddress").addClass("has-success");
            $('span[for="paddressError"]').css('display', 'none');
          }
          if (ppincode == "") {
            $("#pPincode").addClass("has-error");
            $('span[for="ppincodeError"]').css('display', 'block');
            $('span[for="ppincodeError"]').text("Permanent Pincode is Required*");
            $('#ppincode').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (ppincode.length < 6 || ppincode.length > 6) {
            $("#pPincode").addClass("has-error");
            $('span[for="ppincodeError"]').css('display', 'block');
            $('span[for="ppincodeError"]').text("Enter 6 Digit Permanent Pincode*");
            $("#ppincode").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#pPincode").removeClass("has-error");
            $("#pPincode").addClass("has-success");
            $('span[for="ppincodeError"]').css('display', 'none');
          }
          if (income == "") {
            $("#Income").addClass("has-error");
            $('span[for="incomeError"]').css('display', 'block');
            $('#income').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#Income").removeClass("has-error");
            $("#Income").addClass("has-success");
            $('span[for="incomeError"]').css('display', 'none');
          }
          if (guarentor == "") {
            $("#Guarentor").addClass("has-error");
            $('span[for="guarentorError"]').css('display', 'block');
            $('#guarentor').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#Guarentor").removeClass("has-error");
            $("#Guarentor").addClass("has-success");
            $('span[for="guarentorError"]').css('display', 'none');
          }

          if (gmobile == "") {
            $("#gMobile").addClass("has-error");
            $('span[for="gmobileError"]').css('display', 'block');
            $('span[for="gmobileError"]').text("Mobile No. is Required*");
            $("#gmobile").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (gmobile.length < 10 || gmobile.length > 10) {
            $("#gMobile").addClass("has-error");
            $('span[for="gmobileError"]').css('display', 'block');
            $('span[for="gmobileError"]').text("Enter 10 Digit Mobile No.*");
            $("#gmobile").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#gMobile").removeClass("has-error");
            $("#gMobile").addClass("has-success");
            $('span[for="gmobileError"]').css('display', 'none');
          }
          if (gaddress == "") {
            $("#gAddress").addClass("has-error");
            $('span[for="gaddressError"]').css('display', 'block');
            $('#gaddress').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#gAddress").removeClass("has-error");
            $("#gAddress").addClass("has-success");
            $('span[for="gaddressError"]').css('display', 'none');
          }
          if (gpincode == "") {
            $("#gPincode").addClass("has-error");
            $('span[for="gpincodeError"]').css('display', 'block');
            $('span[for="gpincodeError"]').text("Gaurentor Pincode is Required*");
            $('#gpincode').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (gpincode.length < 6 || gpincode.length > 6) {
            $("#gPincode").addClass("has-error");
            $('span[for="gpincodeError"]').css('display', 'block');
            $('span[for="gpincodeError"]').text("Enter 6 Digit Gaurentor Pincode*");
            $("#gpincode").focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#gPincode").removeClass("has-error");
            $("#gPincode").addClass("has-success");
            $('span[for="gpincodeError"]').css('display', 'none');
          }
          var clientPhotExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
          if (clientphoto == "") {
            $("#clientPhoto").addClass("has-error");
            $('span[for="clientPhotoError"]').css('display', 'block');
            $('span[for="clientPhotoError"]').text("Customer Photo is Required*");
            $('#clientphoto').val('');
            $('#clientphoto').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (!clientPhotExt.exec(clientphoto)) {
            $("#clientPhoto").addClass("has-error");
            $('span[for="clientPhotoError"]').css('display', 'block');
            $('span[for="clientPhotoError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
            $('#clientphoto').val('');
            $('#clientphoto').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#clientPhoto").removeClass("has-error");
            $("#clientPhoto").addClass("has-success");
            $('span[for="clientPhotoError"]').css('display', 'none');
          }
          var clientaadharExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
          if (aadharcard == "") {
            $("#aadharCard").addClass("has-error");
            $('span[for="aadharcardError"]').css('display', 'block');
            $('span[for="aadharcardError"]').text("Aadhar Card is Required*");
            $('#aadharcard').val('');
            $('#aadharcard').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (!clientaadharExt.exec(aadharcard)) {
            $("#aadharCard").addClass("has-error");
            $('span[for="aadharcardError"]').css('display', 'block');
            $('span[for="aadharcardError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
            $('#aadharcard').val('');
            $('#aadharcard').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#aadharCard").removeClass("has-error");
            $("#aadharCard").addClass("has-success");
            $('span[for="aadharcardError"]').css('display', 'none');
          }
          var gphotoExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
          if (gphoto == "") {
            $("#gPhoto").addClass("has-error");
            $('span[for="gphotoError"]').css('display', 'block');
            $('span[for="gphotoError"]').text("Gaurentor Photo is Required*");
            $('#gphoto').val('');
            $('#gphoto').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (!gphotoExt.exec(gphoto)) {
            $("#gPhoto").addClass("has-error");
            $('span[for="gphotoError"]').css('display', 'block');
            $('span[for="gphotoError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
            $('#gphoto').val('');
            $('#gphoto').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#gPhoto").removeClass("has-error");
            $("#gPhoto").addClass("has-success");
            $('span[for="gphotoError"]').css('display', 'none');
          }
          var appDocExt = /(\.pdf)$/i;
          if (appDoc == "") {
            $("#AppDoc").addClass("has-error");
            $('span[for="appDocError"]').css('display', 'block');
            $('span[for="appDocError"]').text("Application Document is Required*");
            $('#appDoc').val('');
            $('#appDoc').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else if (!appDocExt.exec(appDoc)) {
            $("#AppDoc").addClass("has-error");
            $('span[for="appDocError"]').css('display', 'block');
            $('span[for="appDocError"]').text(".pdf format only*");
            $('#appDoc').val('');
            $('#appDoc').focus();
                      $('#saveData').attr('disabled',false);
          $('#saveData').html('<i class="fa fa-save"></i> Save Data<i>');
          error = true;
          } else {
            $("#AppDoc").removeClass("has-error");
            $("#AppDoc").addClass("has-success");
            $('span[for="appDocError"]').css('display', 'none');
          }

          if(!error){
               $('#cusForm')[0].submit();
          }
        });
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#name').on('blur', function() {
          var name = $('#name').val();
          if (name == "") {
            $("#customerName").addClass("has-error");
            $('span[for="NameError"]').css('display', 'block');
            $('#name').focus();
          } else {
            $("#customerName").removeClass("has-error");
            $("#customerName").addClass("has-success");
            $('span[for="NameError"]').css('display', 'none');
          }
        });
        $('#father').on('blur', function() {
          var father = $('#father').val();
          if (father == "") {
            $("#fatherName").addClass("has-error");
            $('span[for="fatherError"]').css('display', 'block');
            $('#father').focus();
          } else {
            $("#fatherName").removeClass("has-error");
            $("#fatherName").addClass("has-success");
            $('span[for="fatherError"]').css('display', 'none');
          }
        });
        $('#mother').on('blur', function() {
          var mother = $('#mother').val();
          if (mother == "") {
            $("#motherName").addClass("has-error");
            $('span[for="motherError"]').css('display', 'block');
            $('#mother').focus();
          } else {
            $("#motherName").removeClass("has-error");
            $("#motherName").addClass("has-success");
            $('span[for="motherError"]').css('display', 'none');
          }
        });
        $('#datepicker').on('blur', function() {
          var dob = $('#datepicker').val();
          if (dob == "") {
            $("#DateOfBirth").addClass("has-error");
            $('span[for="dobError"]').css('display', 'block');
          } else {
            $("#DateOfBirth").removeClass("has-error");
            $("#DateOfBirth").addClass("has-success");
            $('span[for="dobError"]').css('display', 'none');
          }
        });
        $('#gender').on('blur', function() {
          var gender = $('#gender').val();
          if (gender == "") {
            $("#Gender").addClass("has-error");
            $('span[for="genderError"]').css('display', 'block');
            $("#gender").focus();
          } else {
            $("#Gender").removeClass("has-error");
            $("#Gender").addClass("has-success");
            $('span[for="genderError"]').css('display', 'none');
          }
        });
        $('#mobile').on('blur', function() {
          var mobile = $('#mobile').val();
          if (mobile == "") {
            $("#Mobile").addClass("has-error");
            $('span[for="mobileError"]').css('display', 'block');
            $('span[for="mobileError"]').text("Mobile No. is Required*");
            $("#mobile").focus();
          } else if (mobile.length < 10 || mobile.length > 10) {
            $("#Mobile").addClass("has-error");
            $('span[for="mobileError"]').css('display', 'block');
            $('span[for="mobileError"]').text("Enter 10 Digit Mobile No.*");
            $("#mobile").focus();
          } else {
            var baseURL = "<?php echo base_url(); ?>"
            $.ajax({
              type: "POST",
              url: baseURL + "main/verifyMobile",
              data: 'mobile=' + mobile,
              success: function(data) {
                if (data > 0) {
                  $("#Mobile").addClass("has-error");
                  $('span[for="mobileError"]').css('display', 'block');
                  $('span[for="mobileError"]').text("Mobile No. Already Exists*");
                  $("#mobile").focus();
                } else {
                  $("#Mobile").removeClass("has-error");
                  $("#Mobile").addClass("has-success");
                  $('span[for="mobileError"]').css('display', 'none');
                }
              }
            });
          }
        });
        $('#aadhar').on('blur', function() {
          var aadhar = $('#aadhar').val();
          if (aadhar == "") {
            $("#Aadhar").addClass("has-error");
            $('span[for="aadharError"]').css('display', 'block');
            $('span[for="aadharError"]').text("Aadhar No. is Required*");
            $("#aadhar").focus();
          } else if (aadhar.length < 12 || aadhar.length > 12) {
            $("#Aadhar").addClass("has-error");
            $('span[for="aadharError"]').css('display', 'block');
            $('span[for="aadharError"]').text("Enter 12 Digit Aadhar No.*");
            $("#aadhar").focus();
          } else {
            var baseURL = "<?php echo base_url(); ?>"
            $.ajax({
              type: "POST",
              url: baseURL + "main/verifyAadhar",
              data: 'aadhar=' + aadhar,
              success: function(data) {
                if (data > 0) {
                  $("#Aadhar").addClass("has-error");
                  $('span[for="aadharError"]').css('display', 'block');
                  $('span[for="aadharError"]').text("Aadhar No. Already Exists*");
                  $("#aadhar").focus();
                } else {
                  $("#Aadhar").removeClass("has-error");
                  $("#Aadhar").addClass("has-success");
                  $('span[for="aadharError"]').css('display', 'none');
                }
              }
            });

          }
        });
        $('#occupation').on('blur', function() {
          var occupation = $('#occupation').val();
          if (occupation == "") {
            $("#Occupation").addClass("has-error");
            $('span[for="occupationError"]').css('display', 'block');
            $('#occupation').focus();
          } else {
            $("#Occupation").removeClass("has-error");
            $("#Occupation").addClass("has-success");
            $('span[for="occupationError"]').css('display', 'none');
          }
        });
        $('#caddress').on('blur', function() {
          var caddress = $('#caddress').val();
          if (caddress == "") {
            $("#cAddress").addClass("has-error");
            $('span[for="caddressError"]').css('display', 'block');
            $('#caddress').focus();
          } else {
            $("#cAddress").removeClass("has-error");
            $("#cAddress").addClass("has-success");
            $('span[for="caddressError"]').css('display', 'none');
          }
        });
        $('#cpincode').on('blur', function() {
          var cpincode = $('#cpincode').val();
          if (cpincode == "") {
            $("#cPincode").addClass("has-error");
            $('span[for="cpincodeError"]').css('display', 'block');
            $('span[for="cpincodeError"]').text("Current Pincode is Required*");
            $('#cpincode').focus();
          } else if (cpincode.length < 6 || cpincode.length > 6) {
            $("#cPincode").addClass("has-error");
            $('span[for="cpincodeError"]').css('display', 'block');
            $('span[for="cpincodeError"]').text("Enter 6 Digit Current Pincode*");
            $("#cpincode").focus();
          } else {
            $("#cPincode").removeClass("has-error");
            $("#cPincode").addClass("has-success");
            $('span[for="cpincodeError"]').css('display', 'none');
          }
        });
        $('#paddress').on('blur', function() {
          var paddress = $('#paddress').val();
          if (paddress == "") {
            $("#pAddress").addClass("has-error");
            $('span[for="paddressError"]').css('display', 'block');
            $('#paddress').focus();
          } else {
            $("#pAddress").removeClass("has-error");
            $("#pAddress").addClass("has-success");
            $('span[for="paddressError"]').css('display', 'none');
          }
        });
        $('#ppincode').on('blur', function() {
          var ppincode = $('#ppincode').val();
          if (ppincode == "") {
            $("#pPincode").addClass("has-error");
            $('span[for="ppincodeError"]').css('display', 'block');
            $('span[for="ppincodeError"]').text("Permanent Pincode is Required*");
            $('#ppincode').focus();
          } else if (ppincode.length < 6 || ppincode.length > 6) {
            $("#pPincode").addClass("has-error");
            $('span[for="ppincodeError"]').css('display', 'block');
            $('span[for="ppincodeError"]').text("Enter 6 Digit Permanent Pincode*");
            $("#ppincode").focus();
          } else {
            $("#pPincode").removeClass("has-error");
            $("#pPincode").addClass("has-success");
            $('span[for="ppincodeError"]').css('display', 'none');
          }
        });
        $('#income').on('blur', function() {
          var income = $('#income').val();
          if (income == "") {
            $("#Income").addClass("has-error");
            $('span[for="incomeError"]').css('display', 'block');
            $('#income').focus();
          } else {
            $("#Income").removeClass("has-error");
            $("#Income").addClass("has-success");
            $('span[for="incomeError"]').css('display', 'none');
          }
        });
        $('#guarentor').on('blur', function() {
          var guarentor = $('#guarentor').val();
          if (guarentor == "") {
            $("#Guarentor").addClass("has-error");
            $('span[for="guarentorError"]').css('display', 'block');
            $('#guarentor').focus();
          } else {
            $("#Guarentor").removeClass("has-error");
            $("#Guarentor").addClass("has-success");
            $('span[for="guarentorError"]').css('display', 'none');
          }
        });
        $('#gmobile').on('blur', function() {
          var gmobile = $('#gmobile').val();
          if (gmobile == "") {
            $("#gMobile").addClass("has-error");
            $('span[for="gmobileError"]').css('display', 'block');
            $('span[for="gmobileError"]').text("Mobile No. is Required*");
            $("#gmobile").focus();
          } else if (gmobile.length < 10 || gmobile.length > 10) {
            $("#gMobile").addClass("has-error");
            $('span[for="gmobileError"]').css('display', 'block');
            $('span[for="gmobileError"]').text("Enter 10 Digit Mobile No.*");
            $("#gmobile").focus();
          } else {
            $("#gMobile").removeClass("has-error");
            $("#gMobile").addClass("has-success");
            $('span[for="gmobileError"]').css('display', 'none');
          }
        });
        $('#gaddress').on('blur', function() {
          var gaddress = $('#gaddress').val();
          if (gaddress == "") {
            $("#gAddress").addClass("has-error");
            $('span[for="gaddressError"]').css('display', 'block');
            $('#gaddress').focus();
          } else {
            $("#gAddress").removeClass("has-error");
            $("#gAddress").addClass("has-success");
            $('span[for="gaddressError"]').css('display', 'none');
          }
        });
        $('#gpincode').on('blur', function() {
          var gpincode = $('#gpincode').val();
          if (gpincode == "") {
            $("#gPincode").addClass("has-error");
            $('span[for="gpincodeError"]').css('display', 'block');
            $('span[for="gpincodeError"]').text("Gaurentor Pincode is Required*");
            $('#gpincode').focus();
          } else if (gpincode.length < 6 || gpincode.length > 6) {
            $("#gPincode").addClass("has-error");
            $('span[for="gpincodeError"]').css('display', 'block');
            $('span[for="gpincodeError"]').text("Enter 6 Digit Gaurentor Pincode*");
            $("#gpincode").focus();
          } else {
            $("#gPincode").removeClass("has-error");
            $("#gPincode").addClass("has-success");
            $('span[for="gpincodeError"]').css('display', 'none');
          }
        });
        $('#clientphoto').on('change', function() {
          var clientphoto = $('#clientphoto').val();
          var clientPhotExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
          if (clientphoto == "") {
            $("#clientPhoto").addClass("has-error");
            $('span[for="clientPhotoError"]').css('display', 'block');
            $('span[for="clientPhotoError"]').text("Customer Photo is Required*");
            $('#clientphoto').val('');
            $('#clientphoto').focus();
          } else if (!clientPhotExt.exec(clientphoto)) {
            $("#clientPhoto").addClass("has-error");
            $('span[for="clientPhotoError"]').css('display', 'block');
            $('span[for="clientPhotoError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
            $('#clientphoto').val('');
            $('#clientphoto').focus();
          } else {
            $("#clientPhoto").removeClass("has-error");
            $("#clientPhoto").addClass("has-success");
            $('span[for="clientPhotoError"]').css('display', 'none');
          }
        });
        $('#aadharcard').on('change', function() {
          var aadharcard = $('#aadharcard').val();
          var clientaadharExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
          if (aadharcard == "") {
            $("#aadharCard").addClass("has-error");
            $('span[for="aadharcardError"]').css('display', 'block');
            $('span[for="aadharcardError"]').text("Aadhar Card is Required*");
            $('#aadharcard').val('');
            $('#aadharcard').focus();
          } else if (!clientaadharExt.exec(aadharcard)) {
            $("#aadharCard").addClass("has-error");
            $('span[for="aadharcardError"]').css('display', 'block');
            $('span[for="aadharcardError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
            $('#aadharcard').val('');
            $('#aadharcard').focus();
          } else {
            $("#aadharCard").removeClass("has-error");
            $("#aadharCard").addClass("has-success");
            $('span[for="aadharcardError"]').css('display', 'none');
          }
        });
        $('#gphoto').on('change', function() {
          var gphoto = $('#gphoto').val();
          var gphotoExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
          if (gphoto == "") {
            $("#gPhoto").addClass("has-error");
            $('span[for="gphotoError"]').css('display', 'block');
            $('span[for="gphotoError"]').text("Gaurentor Photo is Required*");
            $('#gphoto').val('');
            $('#gphoto').focus();
          } else if (!gphotoExt.exec(gphoto)) {
            $("#gPhoto").addClass("has-error");
            $('span[for="gphotoError"]').css('display', 'block');
            $('span[for="gphotoError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
            $('#gphoto').val('');
            $('#gphoto').focus();
          } else {
            $("#gPhoto").removeClass("has-error");
            $("#gPhoto").addClass("has-success");
            $('span[for="gphotoError"]').css('display', 'none');
          }
        });
        $('#appDoc').on('change', function() {
          var appDoc = $('#appDoc').val();
          var appDocExt = /(\.pdf)$/i;
          if (appDoc == "") {
            $("#AppDoc").addClass("has-error");
            $('span[for="appDocError"]').css('display', 'block');
            $('span[for="appDocError"]').text("Application Document is Required*");
            $('#appDoc').val('');
            $('#appDoc').focus();
          } else if (!appDocExt.exec(appDoc)) {
            $("#AppDoc").addClass("has-error");
            $('span[for="appDocError"]').css('display', 'block');
            $('span[for="appDocError"]').text(".pdf format only*");
            $('#appDoc').val('');
            $('#appDoc').focus();
          } else {
            $("#AppDoc").removeClass("has-error");
            $("#AppDoc").addClass("has-success");
            $('span[for="appDocError"]').css('display', 'none');
          }
        });
        $('#loan_amount').on('blur', function() {
          var loanAmount = $('#loan_amount').val();
          if (loanAmount == "") {
            $("#LoanAmount").addClass("has-error");
            $('span[for="loanAmountError"]').css('display', 'block');
            $('#loanAmount').focus();
          } else {
            $("#LoanAmount").removeClass("has-error");
            $("#LoanAmount").addClass("has-success");
            $('span[for="loanAmountError"]').css('display', 'none');
          }
        });
      });
    </script>