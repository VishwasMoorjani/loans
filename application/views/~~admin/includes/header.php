<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/bootstrap.min.css" type="text/css" />
    <!-- icons css -->
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/all.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>font/flaticon.css" type="text/css" />
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/responsive.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/select2.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/jquery.toast.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/bootstrap-clockpicker.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" type="text/css" />
    <script src="<?php echo $this->config->item('admin_assets'); ?>js/jquery.min.js" type="text/javascript"></script>
    <!-- Jquery Min -->
    <script src="<?php echo $this->config->item('admin_assets'); ?>bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('admin_assets'); ?>js/select2.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('admin_assets'); ?>js/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <!-- Bootstrap Js -->
    <script src="<?php echo $this->config->item('admin_assets'); ?>js/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('admin_assets'); ?>js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('admin_assets') ?>js/jquery.toast.min.js"></script>
    <script src="<?php echo $this->config->item('admin_assets') ?>js/jquery.form.js"></script>
    <script src="<?php echo $this->config->item('admin_assets') ?>js/corp.js"></script>
      <!-- ... -->
  

    <script type="text/javascript">
      var site_url= '<?php echo site_url(); ?>';
    </script>
  </head>
  <body>
    <!-- /#header -->
    <?php $this->load->view('admin/includes/left_menu');?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
      <!-- Header-->
      <header id="header" class="header">
        <div class="top-left">
          <div class="navbar-header"> 
          <a class="navbar-brand" href="./">
            <img src="<?php echo site_url() ?>assets/admin/admin/<?php $record=get_admin_details(); echo  $record->logo?>" alt="Logo" style="height: 40px;"/>
          </a> 
          
          </div>
        </div>
        <div class="top-right">
          <div class="header-menu">
          <a class="navbar-brand hidden" href="./"></a> <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            <div class="user-area dropdown float-right"> 
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                <img class="user-avatar rounded-circle" src="<?php echo $this->config->item('admin_assets'); ?>images/dr_image.png" alt="User Avatar" /> 
                <span class="text-white"><?php echo $record->full_name  ?></span>
              </a>
            <ul class="user-menu dropdown-menu p-0">

            
              <!-- User image -->
              <li class="user-header text-center p-2 d-flex flex-column justify-content-center align-items-center" style="background:#3c8dbc">
                <img src="<?php echo $this->config->item('admin_assets'); ?>images/dr_image.png" class="img-circle" style="width:80px; margin:auto;" alt="User Image">

                <p class="text-white mb-2 mt-2" style="line-height:1"><?php echo $record->full_name  ?></p><!-- 
                <p class="text-white mb-2" style="line-height:1"><small>Member since Nov. 2012</small></p> -->
              </li>
              <!-- Menu Body -->
              <li class="user-body">
 <!--                <div class="d-flex justify-content-around">
                    <a href="#" class="text-dark" style="font-size:12px;">Followers</a>
                    <a href="#" class="text-dark" style="font-size:12px;">Sales</a>
                    <a href="#" class="text-dark" style="font-size:12px;">Friends</a>
                </div> -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer bg-light p-2 d-flex justify-content-between">
                <div class="">
                <?php if($_SESSION['user_type']=="Vendor"){ ?>
                <a class="nav-link" href="<?php echo site_url(); ?>saller/logout"><i class="fa fa-power -off"></i>Logout</a> 

             <?php  }else{ ?>
               <a class="nav-link" href="<?php echo site_url(); ?>admin/logout"><i class="fa fa-power -off"></i>Logout</a>
              <?php } ?>
                </div>
                <div class="">
                <a class="nav-link" href="<?php echo site_url(); ?>admin/update-profile"><i class="fa fa-power -off"></i>Setting</a>
                </div>
              </li>
            


            
              
              
              </ul>
          </div>
        </div>
      </div>
    </header>