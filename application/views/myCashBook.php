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
        My Cash Book
        <!--<small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Cash Details</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="box box-primary">
        <div class="box-header">
          <div class="row">
            <div class="col-md-4">
              <h5><b>Total Cash Credit:</b> 
                &#x20B9; <?php $CI =& get_instance();
                      $totalCashCredit=$CI->totalCashCredit($this->session->userdata('user_id'));
                      echo $totalCashCredit;
                    ?>
              </h5>
            </div>
            <div class="col-md-4">
              <h5><b>Total Cash Debit:</b> 
              &#x20B9; <?php $CI =& get_instance();
                      $totalCashDebit=$CI->totalCashDebit($this->session->userdata('user_id'));
                      echo $totalCashDebit;
                    ?> </h5>
            </div>
            <div class="col-md-4">
              <h5><b>Total Cash inHand:</b> 
              &#x20B9; <?php echo $totalCashCredit-$totalCashDebit;?>
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
              <th>Payment Method</th>
              <th>Transfer By</th>
              <th>Received By</th>
              <th>Status</th>
              <th>Remark</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php $i=0;
              $cash=$this->db->order_by('id', 'DESC')->get_where('tbl_cashbook', array('emp_id'=>$this->session->userdata('user_id')))->result_array();
              foreach($cash as $data):
              $i++; ?>
              <tr>
                <td><?php echo $i;?>.</td>
                <td><?php echo $data['date'];?></td>
                <td><?php echo $data['cash_credit'];?></td>
                <td><?php echo $data['cash_debit'];?></td>
                <td><?php echo $data['method'];?></td>
                <td>
                  <?php $CI =& get_instance();
                      $user=$CI->getAuthority($data['receiving_from']);
                      echo $user['user_name'];
                    ?>
                </td>
                <td>
                  <?php $CI =& get_instance();
                      $user=$CI->getAuthority($data['received_by']);
                      echo $user['user_name'];
                    ?>
                </td>
                <td>
                  <?php if($data['receiving_status']>0)
                  {
                    echo '<label class="label label-success">Approved</label>';
                  }
                  else
                    {
                      echo '<label class="label label-info">Pending</label>';
                    }?>
                </td>
                <td><?php echo $data['remark'];?></td>
                <td>
                  <?php if($data['receiving_status']<1)
                  {
                    echo '<a href="'.base_url().'/main/myCashBook/Approved/'.$data['id'].'"><button class="btn-primary" title="Approve Cash Entry"><i class="fa fa-check"></i></button>';
                  }
                  ?>
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
   