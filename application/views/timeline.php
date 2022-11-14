  <?php include('inc/header.php');?>
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
        Customer Timeline
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Customer Timeline</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h4 class="box-title">Timeline</h4> :
            </div>
            <div class="box-body">
               <ul class="timeline timeline-inverse">
                <?php
                foreach($message as $msg):?>
                  <li class="time-label">
                        <span class="bg-blue">
                         <?php echo $msg['timeline_date'];?>
                        </span>
                  </li>
                  <li>
                    <i class="fa fa-comments bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> <?php echo $msg['timeline_time'];?></span>
                      <?php $client=$this->db->get_where('tbl_customers', array('client_id'=>$msg['timeline_client']))->row_array();?>
                      <h3 class="timeline-header"><a><?php echo $msg['timeline_user'];?></a>(<?php
                      $CI=&get_instance();
                      $role=$CI->getRole($msg['timeline_user_role']);
                      echo $role['role_name'];?>) perform an action on <a><?php echo $client['client_name'];?>'s</a> profile</h3>
                      <div class="timeline-body">
                        <?php echo $msg['timeline_message'];?>
                      </div>                      
                    </div>
                  </li>
                  <?php endforeach;?>               
                </ul>              
                
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
  