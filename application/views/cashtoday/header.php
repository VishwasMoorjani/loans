<!DOCTYPE html>
<html>
<head>
   <?php $role=$this->db->get_where('tbl_roles', array('role_id'=>$this->session->userdata('user_role')))->row_array();?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php echo base_url();?>assets/favicon.png"  type="image/png">
  <title><?php echo $role['role_name'];?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--bootstrap css -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/daterangepicke.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $permis=$this->db->get_where('tbl_permissions', array('user'=>$this->session->userdata('user_role')))->row_array();
            $permissions=explode(',',$permis['permissions']);
            ?>

  <!-- Main Header -->
  <header class="main-header">

    <a href="<?php echo base_url();?>main/dashboard" class="logo">
      <img src="<?php echo base_url();?>assets/logo.png" style="max-height: 50px;">
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <li>
            <a href="<?php echo base_url();?>main/password"><i class="fa fa-lock"></i> Change Password</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>main/logout"><i class="fa fa-sign-out"></i> Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
 
