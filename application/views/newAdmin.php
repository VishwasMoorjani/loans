<?php include('inc/header.php'); ?>
<style type="text/css">
    .file {
        visibility: hidden;
        position: absolute;
    }
</style>
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
            New Admin
            <!--<small>Optional description</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">New Admin</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($this->session->flashdata('Emperror_msg'))) { ?>
                    <center><label class="label label-danger"><?php echo $this->session->flashdata('Emperror_msg'); ?></label></center>
                <?php } ?>
                <?php if (!empty($this->session->flashdata('EmpSuccess_msg'))) { ?>
                    <center><label class="label label-success"><?php echo $this->session->flashdata('EmpSuccess_msg'); ?></label></center>
                <?php } ?>
                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">Admin Information</h4>
                    </div>
                    <div class="box-body">
                        <form method="post" name="EmpForm" action="<?php echo base_url(); ?>main/newAdmin/SaveData" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                    <?php $lastEMPid = $this->db->order_by('user_id', 'DESC')->get('tbl_users')->row_array(); ?>
                                    <div class="form-group">
                                        <label>Employee ID:</label>
                                        <input type="text" name="emp_id" value="SSMSF0<?php echo $lastEMPid['user_id'] + 1; ?>" placeholder="Admin ID" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="Name">
                                        <label>Name:</label>
                                        <input type="text" name="name" placeholder="Admin Name" class="form-control" id="name" pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet">
                                        <span class="help-block" for="NameError" style="display:none">Employee Name is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="fatherName">
                                        <label>Father's Name:</label>
                                        <input type="text" name="father" placeholder="Father's Name" class="form-control" id="fathername" pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet">
                                        <span class="help-block" for="fatherNameError" style="display:none">Father Name is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="motherName">
                                        <label>Mother's Name:</label>
                                        <input type="text" name="mother" placeholder="Mother's Name" class="form-control" id="mothername" pattern="[a-zA-Z][a-zA-Z ]+" title="Accept only alphabet">
                                        <span class="help-block" for="motherNameError" style="display:none">Mother Name is Required*</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="DateOfBirth">
                                        <label>Date of Birth:</label>
                                        <input type="date" name="dob" id="datepicker" placeholder="DOB" class="form-control" max="<?php echo date("Y-m-d") ?>">
                                        <span class="help-block" for="dobError" style="display:none">DOB is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="Gender">
                                        <label>Gender:</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <span class="help-block" for="genderError" style="display:none">Gender is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="Email">
                                        <label>Email:</label>
                                        <input type="email" name="email" placeholder="Admin Email" class="form-control" id="email">
                                        <span class="help-block" for="emailError" style="display:none">Email is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="Mobile">
                                        <label>Mobile:</label>
                                        <input type="text" name="mobile" placeholder="Admin Mobile" class="form-control" id="mobile" pattern="[0-9]+" title="Acceot Only Number">
                                        <span class="help-block" for="mobileError" style="display:none"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="Password">
                                        <label>Password:</label>
                                        <input type="password" name="password" placeholder="Admin Password" class="form-control" id="password">
                                        <span class="help-block" for="passwordError" style="display:none"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="Aadhar">
                                        <label>Aadhar No.:</label>
                                        <input type="text" name="aadhar" placeholder="Admin Aadhar No." class="form-control" id="aadhar">
                                        <span class="help-block" for="aadharError" style="display:none"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="pAddress">
                                        <label>Permanent Address:</label>
                                        <textarea name="paddress" placeholder="Permanent Address" class="form-control" id="paddress"></textarea>
                                        <span class="help-block" for="paddressError" style="display:none">Permanent Address is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="cAddress">
                                        <label>Current Address:</label>
                                        <textarea name="caddress" placeholder="Permanent Address" class="form-control" id="caddress"></textarea>
                                        <span class="help-block" for="caddressError" style="display:none">Current Address is Required*</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="Branch">
                                        <label>Branch:</label>
                                        <select class="form-control" name="branch" id="branch" onchange="getDepartments(this.value);">
                                            <option value="">Select Branch</option>
                                            <?php $branches = $this->db->get_where('tbl_branches', array('branch_status' => 1))->result_array();
                                            foreach ($branches as $branch) : ?>
                                                <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['branch_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="help-block" for="branchError" style="display:none">Branch is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="Department">
                                        <label>Department:</label>
                                        <select class="form-control" name="department" id="department" onchange="getRoles(this.value);">
                                            <option value="">Select Department</option>
                                        </select>
                                        <span class="help-block" for="departmentError" style="display:none">Department is Required*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="Role">
                                        <label>Admin Role:</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="">Select Role</option>
                                        </select>
                                        <span class="help-block" for="roleError" style="display:none">Role is Required*</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="ePhoto">
                                        <label>Admin Photo:</label>
                                        <input type="file" name="photo" id="ephoto" class="file" required>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="text" class="form-control" disabled placeholder="Upload file" name="file">
                                            <span class="input-group-btn">
                                                <button class="browse btn btn-primary" type="button"><i class="fa fa-folder-open-o"></i> Select</button>
                                            </span>
                                        </div>
                                        <span class="help-block" for="ephotoError" style="display:none"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="aadharCard">
                                        <label>Admin Aadhar Card</label>
                                        <input type="file" id="aadharcard" name="aadharcard" class="file" required>
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
                            </div>
                            <br />
                            <center><button type="submit" id="SaveData" class="btn-primary"><i class="fa fa-save"></i> Save Data</button></center>
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

<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    function getDepartments(val) {
        var baseURL = "<?php echo base_url(); ?>"
        $.ajax({
            type: "POST",
            url: baseURL + "main/getDepartments",
            data: 'branch_id=' + val,
            success: function(data) {
                $("#department").html(data);
                $("#department1").html(data);
            }
        });
    }

    function getRoles(val) {
        var baseURL = "<?php echo base_url(); ?>"
        $.ajax({
            type: "POST",
            url: baseURL + "main/getRoles",
            data: 'department_id=' + val,
            success: function(data) {
                $("#role").html(data);
            }
        });
    }

    $('#department').select2();
    $('#role').select2();
    $('#authority').select2();



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
        $("#SaveData").click(function() {
            var name = document.getElementById("name").value;
            var fathername = document.getElementById("fathername").value;
            var mothername = document.getElementById("mothername").value;
            var dob = document.getElementById("datepicker").value;
            var gender = document.getElementById("gender").value;
            var email = document.getElementById("email").value;
            var mobile = document.getElementById("mobile").value;
            var password = document.getElementById("password").value;
            var aadhar = document.getElementById("aadhar").value;
            var paddress = document.getElementById("paddress").value;
            var caddress = document.getElementById("caddress").value;
            var branch = document.getElementById("branch").value;
            var department = document.getElementById("department").value;
            var role = document.getElementById("role").value;
            var authority = document.getElementById("authority").value;
            var ephoto = document.getElementById("ephoto").value;
            var aadharcard = document.getElementById("aadharcard").value;

            if (name == "") {
                $("#Name").addClass("has-error");
                $('span[for="NameError"]').css('display', 'block');
                $('#name').focus();
            } else {
                $("#Name").removeClass("has-error");
                $("#Name").addClass("has-success");
                $('span[for="NameError"]').css('display', 'none');
            }

            if (fathername == "") {
                $("#fatherName").addClass("has-error");
                $('span[for="fatherNameError"]').css('display', 'block');
                $('#fathername').focus();
            } else {
                $("#fatherName").removeClass("has-error");
                $("#fatherName").addClass("has-success");
                $('span[for="fatherNameError"]').css('display', 'none');
            }

            if (mothername == "") {
                $("#motherName").addClass("has-error");
                $('span[for="motherNameError"]').css('display', 'block');
                $('#mothername').focus();
            } else {
                $("#motherName").removeClass("has-error");
                $("#motherName").addClass("has-success");
                $('span[for="motherNameError"]').css('display', 'none');
            }

            if (dob == "") {
                $("#DateOfBirth").addClass("has-error");
                $('span[for="dobError"]').css('display', 'block');
            } else {
                $("#DateOfBirth").removeClass("has-error");
                $("#DateOfBirth").addClass("has-success");
                $('span[for="dobError"]').css('display', 'none');
            }

            if (gender == "") {
                $("#Gender").addClass("has-error");
                $('span[for="genderError"]').css('display', 'block');
                $("#gender").focus();
            } else {
                $("#Gender").removeClass("has-error");
                $("#Gender").addClass("has-success");
                $('span[for="genderError"]').css('display', 'none');
            }

            if (email == "") {
                $("#Email").addClass("has-error");
                $('span[for="emailError"]').css('display', 'block');
                $("#email").focus();
            } else {
                $("#Email").removeClass("has-error");
                $("#Email").addClass("has-success");
                $('span[for="emailError"]').css('display', 'none');
            }

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
                $("#Mobile").removeClass("has-error");
                $("#Mobile").addClass("has-success");
                $('span[for="mobileError"]').css('display', 'none');
            }

            if (password == "") {
                $("#Password").addClass("has-error");
                $('span[for="passwordError"]').css('display', 'block');
                $('span[for="passwordError"]').text("Password is Required*");
                $("#password").focus();
            } else if (password.length < 6) {
                $("#Password").addClass("has-error");
                $('span[for="passwordError"]').css('display', 'block');
                $('span[for="passwordError"]').text("Min. 6 Digit Password is Required*");
                $("#password").focus();
            } else {
                $("#Password").removeClass("has-error");
                $("#Password").addClass("has-success");
                $('span[for="passwordError"]').css('display', 'none');
            }

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
                $("#Aadhar").removeClass("has-error");
                $("#Aadhar").addClass("has-success");
                $('span[for="aadharError"]').css('display', 'none');
            }

            if (paddress == "") {
                $("#pAddress").addClass("has-error");
                $('span[for="paddressError"]').css('display', 'block');
                $('#paddress').focus();
            } else {
                $("#pAddress").removeClass("has-error");
                $("#pAddress").addClass("has-success");
                $('span[for="paddressError"]').css('display', 'none');
            }

            if (caddress == "") {
                $("#cAddress").addClass("has-error");
                $('span[for="caddressError"]').css('display', 'block');
                $('#caddress').focus();
            } else {
                $("#cAddress").removeClass("has-error");
                $("#cAddress").addClass("has-success");
                $('span[for="caddressError"]').css('display', 'none');
            }

            if (branch == "") {
                $("#Branch").addClass("has-error");
                $('span[for="branchError"]').css('display', 'block');
                $('#branch').focus();
            } else {
                $("#Branch").removeClass("has-error");
                $("#Branch").addClass("has-success");
                $('span[for="branchError"]').css('display', 'none');
            }
            if (department == "") {
                $("#Department").addClass("has-error");
                $('span[for="departmentError"]').css('display', 'block');
                $('#department').focus();
            } else {
                $("#Department").removeClass("has-error");
                $("#Department").addClass("has-success");
                $('span[for="departmentError"]').css('display', 'none');
            }
            if (role == "") {
                $("#Role").addClass("has-error");
                $('span[for="roleError"]').css('display', 'block');
                $('#role').focus();
            } else {
                $("#Role").removeClass("has-error");
                $("#Role").addClass("has-success");
                $('span[for="roleError"]').css('display', 'none');
            }
            if (authority == "") {
                $("#auth").addClass("has-error");
                $('span[for="authError"]').css('display', 'block');
                $('#authority').focus();
            } else {
                $("#auth").removeClass("has-error");
                $("#auth").addClass("has-success");
                $('span[for="authError"]').css('display', 'none');
            }
            var ephotoExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
            if (ephoto == "") {
                $("#ePhoto").addClass("has-error");
                $('span[for="ephotoError"]').css('display', 'block');
                $('span[for="ephotoError"]').text("Admin Photo is Required*");
                $('#ephoto').val('');
                $('#ephoto').focus();
            } else if (!ephotoExt.exec(ephoto)) {
                $("#ePhoto").addClass("has-error");
                $('span[for="ephotoError"]').css('display', 'block');
                $('span[for="ephotoError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
                $('#ephoto').val('');
                $('#ephoto').focus();
            } else {
                $("#ePhoto").removeClass("has-error");
                $("#ePhoto").addClass("has-success");
                $('span[for="ephotoError"]').css('display', 'none');
            }
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
    });

    function ValidateEmail(mail) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value)) {
            return (true)
        }
        alert("You have entered an invalid email address!")
        return (false)
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#name').on('blur', function() {
            var name = $('#name').val();
            if (name == "") {
                $("#Name").addClass("has-error");
                $('span[for="NameError"]').css('display', 'block');
                $('#name').focus();
            } else {
                $("#Name").removeClass("has-error");
                $("#Name").addClass("has-success");
                $('span[for="NameError"]').css('display', 'none');
            }
        });
        $('#fathername').on('blur', function() {
            var fathername = $('#fathername').val();
            if (fathername == "") {
                $("#fatherName").addClass("has-error");
                $('span[for="fatherNameError"]').css('display', 'block');
                $('#fathername').focus();
            } else {
                $("#fatherName").removeClass("has-error");
                $("#fatherName").addClass("has-success");
                $('span[for="fatherNameError"]').css('display', 'none');
            }
        });
        $('#mothername').on('blur', function() {
            var mothername = $('#mothername').val();
            if (mothername == "") {
                $("#motherName").addClass("has-error");
                $('span[for="motherNameError"]').css('display', 'block');
                $('#mothername').focus();
            } else {
                $("#motherName").removeClass("has-error");
                $("#motherName").addClass("has-success");
                $('span[for="motherNameError"]').css('display', 'none');
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
        $('#email').on('blur', function() {
            var email = $('#email').val();
            if (email == "") {
                $("#Email").addClass("has-error");
                $('span[for="emailError"]').css('display', 'block');
                $("#email").focus();
            } else {
                $("#Email").removeClass("has-error");
                $("#Email").addClass("has-success");
                $('span[for="emailError"]').css('display', 'none');
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
                $("#Mobile").removeClass("has-error");
                $("#Mobile").addClass("has-success");
                $('span[for="mobileError"]').css('display', 'none');
            }
        });
        $('#password').on('blur', function() {
            var password = $('#password').val();
            if (password == "") {
                $("#Password").addClass("has-error");
                $('span[for="passwordError"]').css('display', 'block');
                $('span[for="passwordError"]').text("Password is Required*");
                $("#password").focus();
            } else if (password.length < 6) {
                $("#Password").addClass("has-error");
                $('span[for="passwordError"]').css('display', 'block');
                $('span[for="passwordError"]').text("Min. 6 Digit Password is Required*");
                $("#password").focus();
            } else {
                $("#Password").removeClass("has-error");
                $("#Password").addClass("has-success");
                $('span[for="passwordError"]').css('display', 'none');
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
                $("#Aadhar").removeClass("has-error");
                $("#Aadhar").addClass("has-success");
                $('span[for="aadharError"]').css('display', 'none');
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
        $('#branch').on('blur', function() {
            var branch = $('#branch').val();
            if (branch == "") {
                $("#Branch").addClass("has-error");
                $('span[for="branchError"]').css('display', 'block');
                $('#branch').focus();
            } else {
                $("#Branch").removeClass("has-error");
                $("#Branch").addClass("has-success");
                $('span[for="branchError"]').css('display', 'none');
            }
        });
        $('#department').on('blur', function() {
            var department = $('#department').val();
            if (department == "") {
                $("#Department").addClass("has-error");
                $('span[for="departmentError"]').css('display', 'block');
                $('#department').focus();
            } else {
                $("#Department").removeClass("has-error");
                $("#Department").addClass("has-success");
                $('span[for="departmentError"]').css('display', 'none');
            }
        });
        $('#role').on('blur', function() {
            var role = $('#role').val();
            if (role == "") {
                $("#Role").addClass("has-error");
                $('span[for="roleError"]').css('display', 'block');
                $('#role').focus();
            } else {
                $("#Role").removeClass("has-error");
                $("#Role").addClass("has-success");
                $('span[for="roleError"]').css('display', 'none');
            }
        });
        $('#authority').on('blur', function() {
            var authority = $('#authority').val();
            if (authority == "") {
                $("#auth").addClass("has-error");
                $('span[for="authError"]').css('display', 'block');
                $('#authority').focus();
            } else {
                $("#auth").removeClass("has-error");
                $("#auth").addClass("has-success");
                $('span[for="authError"]').css('display', 'none');
            }
        });
        $('#ephoto').on('change', function() {
            var ephoto = $('#ephoto').val();
            var ephotoExt = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
            if (ephoto == "") {
                $("#ePhoto").addClass("has-error");
                $('span[for="ephotoError"]').css('display', 'block');
                $('span[for="ephotoError"]').text("Admin Photo is Required*");
                $('#ephoto').val('');
                $('#ephoto').focus();
            } else if (!ephotoExt.exec(ephoto)) {
                $("#ePhoto").addClass("has-error");
                $('span[for="ephotoError"]').css('display', 'block');
                $('span[for="ephotoError"]').text(".jpg, .jpeg, .png, .bmp formats only*");
                $('#ephoto').val('');
                $('#ephoto').focus();
            } else {
                $("#ePhoto").removeClass("has-error");
                $("#ePhoto").addClass("has-success");
                $('span[for="ephotoError"]').css('display', 'none');
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
    });
</script>