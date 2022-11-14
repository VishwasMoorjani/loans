    <?php include('inc/header.php');?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
     <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

   <?php 
   include('inc/menubar.php');
    //echo "<pre>"; print_r($bank_detail);
   ?>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $bank_detail->title; ?>
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> <?php echo $bank_detail->title; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="box box-primary">
        <div class="box-header">
          <h4><?php echo $bank_detail->title; ?></h4>
          <div class="row">
            <div class="col-md-4">
              <h5><b>Credit:</b> 
                &#x20B9; <?php 
                      
                      echo number_format($credit_amt->sum,0);
                    ?>
              </h5>
            </div>
            <div class="col-md-4">
              <h5><b>Debit:</b> 
              &#x20B9; <?php 
                      
                      echo number_format($debit_amt->sum,0);
                    ?> </h5>
            </div>
            <div class="col-md-4">
              <b>InAccount:: </b> 
              &#x20B9; <?php echo number_format($credit_amt->sum-$debit_amt->sum);?>
            </h5>
            </div>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <thead>
              <th>S.No.</th>
              <th>Date</th>
              <th>Cash Credit</th>
              <th>Cash Debit</th>
              <th>Collection by</th>
              <th>Added by</th>
              <th>Remark</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php $i=0;
           
              foreach($records as $data):
              $i++; ?>
              <tr>
                <td><?php echo $i;?>.</td>
                <td><?php echo $data->add_date;?></td>
                <td><?php echo $data->credit_amt;?></td>
                <td><?php echo $data->debit;?></td>
                <td><?php 
                if(isset($data->collect_by)){
                 $agents=$this->db->get_where('tbl_users', array('user_id'=>$data->collect_by))->row();
                
                 echo $agents->user_name;
               } else{
                echo "-";
               }?></td>
                <td><?php 
                if(isset($data->auth_id)){
                 $agents=$this->db->get_where('tbl_users', array('user_id'=>$data->auth_id))->row();
                
                 echo $agents->user_name;
               } else{
                echo "-";
               }?></td>

                <td><?php echo $data->remark;?></td>
                <td>
                       <?php if ($data->received_status == 1) { ?>
        
          <?php } else {
              if($this->session->userdata('user_type')=="super_admin"){


           ?>
            <a href="<?php echo base_url(); ?>main/change_bank_status/<?php echo $data->id; ?>"><button class="btn-success" title="Activate Now"><i class="fa fa-check"></i></button></a>
          <?php } } ?>
                </td>
              <?php endforeach;?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('inc/footer.php');?>
 