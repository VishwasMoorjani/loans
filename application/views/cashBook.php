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

        Cash Book

        <!--<small>Optional description</small>-->

      </h1>

      <ol class="breadcrumb">

         <li><a href="<?php echo base_url();?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active">Cash Book</li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content container-fluid">

     <div class="row">

       <div class="col-md-12">

         <div class="box box-primary">

           <div class="box-header">

             <h4 class="box-title">Cash Book</h4>            

           </div>

           <div class="box-body">

             <table class="table table-bordered">

               <thead>

                 <th>S.No.</th>

                 <th>Employee Name</th>

                 <th>Total Cash Credit (&#x20B9;)</th>

                 <th>Total Cash Debit (&#x20B9;)</th>

                 <th>Total Cash inHand (&#x20B9;)</th>

               </thead>

               <tbody>

                <?php $i=0;

             //    if($this->session->userdata('user_type')=="super_admin"){
             //         // $empData = $this->db->query("SELECT * FROM `tbl_users` WHERE (`user_reporting` = '".$reported_user['user_id']."' OR `user_reporting` = '".$this->session->userdata('user_id')."') AND `user_type` != 'super_admin'")->result_array();
             // $empData=$this->db->get_where('tbl_users', array('user_status'=>1))->result_array();
             //      }else{
             //         // $employees = $this->db->where('user_reporting', $reported_user['user_id'])->where('user_type !=', 'super_admin')->get('tbl_users')->result_array();
             //          $empData = $this->db->query("SELECT * FROM `tbl_users` WHERE (`user_reporting` = '".$reported_user['user_id']."' OR `user_reporting` = '".$this->session->userdata('user_id')."') AND `user_type` != 'super_admin'")->result_array();
             //          //echo $this->db->last_query();
             //      }

                foreach($empData as $data): $i++; ?>

                 <tr>

                   <td><?php echo $i;?>.</td>

                   <td><a href="<?php echo base_url();?>main/cashDetails/<?php echo $data['user_id'];?>"><?php echo $data['user_name'];?></a></td>

                   <td>

                    <?php $CI =& get_instance();

                      $totalCashCredit=$CI->totalCashCredit($data['user_id']);

                      echo $totalCashCredit;

                    ?>

                   </td>

                   <td>

                    <?php $CI =& get_instance();

                      $totalCashDebit=$CI->totalCashDebit($data['user_id']);

                      echo $totalCashDebit;

                    ?>

                   </td>

                   <td><?php echo $totalCashCredit-$totalCashDebit;?></td>

                 </tr>

               <?php endforeach;?>

               </tbody>

             </table>

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

  