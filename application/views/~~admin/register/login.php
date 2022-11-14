<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>UDAY | Log in</title>

    <!-- Tell the browser to be responsive to screen width -->

    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <!-- Bootstrap Css -->

    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/bootstrap.min.css" type="text/css" />

    <!-- icons css -->

    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/all.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>font/flaticon.css" type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" type="text/css" />

    <!-- font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Custom Css -->

    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" />

    <link href="<?php echo $this->config->item('admin_assets'); ?>css/jquery.toast.min.css" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  </head>

  <body>

    <div class="login_bg">

      <div class="login_container d-flex align-items-center justify-content-center">

        <div class="login_form">

          <a href="#" class="login_logo">

            <img src="<?php echo site_url() ?>assets/admin/admin/<?php $record=get_admin_details(); echo  $record->logo?>" class="img-fluid">

          </a>

          <div class="form_container">

            <h3>Login to your Account</h3>

           <form class="ajax_form" action="<?php echo site_url('admin/login'); ?>" method="post">



              <div class="input_container">

                <i class="fas fa-user"></i>

                <input type="text" class="form-control" placeholder="Email" name="username">

              </div>

              <div class="input_container">

                <i class="fas fa-lock"></i>

                <input type="password" class="form-control" placeholder="Password" name="password">

              </div>

              <div class="custom-control custom-checkbox ">

                <!-- <input type="checkbox" class="custom-control-input" id="customCheck1"> -->

                <!-- <label class="custom-control-label" for="customCheck1">Remember Me</label> -->

              </div>

              <button class="login_btn" type="submit">Login</button>

            </form>

          </div>

          <!-- <a href="#">Forgot your Password?</a> -->

        </div>

      </div>

    </div>

    <script src="<?php echo $this->config->item('admin_assets') ?>js/jquery.min.js" type="text/javascript"></script>

  

    <!-- Bootstrap Js -->

    <script src="<?php echo $this->config->item('admin_assets') ?>js/popper.min.js" type="text/javascript"></script>

    <script src="<?php echo $this->config->item('admin_assets') ?>js/bootstrap.min.js" type="text/javascript"></script>

    <script src="<?php echo $this->config->item('admin_assets') ?>js/jquery.toast.min.js"></script>

    <script src="<?php echo $this->config->item('admin_assets') ?>js/jquery.form.js"></script>

    <script src="<?php echo $this->config->item('admin_assets') ?>js/corp.js"></script>

  </body>

</html>