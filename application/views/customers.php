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



      .ajax-loader {



        width: 100%;



        height: 100%;



        top: 0;



        left: 0;



        position: fixed;



        display: block;



        opacity: 0.6;



        background-color: #000;



        z-index: 99;



        text-align: center;



      }







      .ajax-loader img {



        position: absolute;



        top: 50%;



        left: 50%;



        z-index: 100;



        height: 150px;



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
          
          
          
          Customers
          
          
          
          <!--<small>Optional description</small>-->

          
          
        </h1>

        
        
        <ol class="breadcrumb">
          
          
          
          <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          
          
          
          <li class="active">Customers</li>
          
          
          
        </ol>
        


      </section>

      

      <!-- Main content -->
      
      
      
      <section class="content container-fluid">
        
        
        
        <div class="box box-primary">
          
          
          
          <div class="box-body">
            
            
            
            <div class="row">


              
              <div class="col-md-3">

                
                
                <div class="form-group">
                  
                  
                  
                  <label>Sales Agent:</label>
                  
                  
                  
                  <select class="form-control sagent" id="sagent" name="branch">



                    <option value="">Select Sales Agent</option>

                    <?php $CI = &get_instance();
                    $agents = $CI->report_user();  ?>

                    <?php

                    if ($this->session->userdata('user_type') == "super_admin") {

                      $employee = $this->db->get_where('tbl_users', array('user_status' => 1, 'user_type' => 'sale'))->result_array();
                    } else {



                      $employee = $this->db->get_where('tbl_users', array('user_status' => 1, 'user_branch' => $this->session->userdata('user_branch'), 'user_type' => 'sale'))->result_array();
                    }

                    foreach ($agents as $emp) : ?>



                      <option value="<?php echo $emp['user_id']; ?>"><?php echo $emp['user_name']; ?></option>



                    <?php endforeach; ?>



                  </select>



                </div>



              </div>



              <div class="col-md-3">



                <div class="form-group">



                  <label>Collection Agent:</label>



                  <select class="form-control cagent" id="cagent" name="branch">



                    <option value="">Select Collection Agent</option>



                    <?php

                    if ($this->session->userdata('user_type') == "super_admin") {

                      $employee = $this->db->get_where('tbl_users', array('user_status' => 1, 'user_type' => 'collection'))->result_array();
                    } else {



                      $employee = $this->db->get_where('tbl_users', array('user_status' => 1, 'user_branch' => $this->session->userdata('user_branch'), 'user_type' => 'collection'))->result_array();
                    }



                    foreach ($agents as $emp) : ?>



                      <option value="<?php echo $emp['user_id']; ?>"><?php echo $emp['user_name']; ?></option>



                    <?php endforeach; ?>



                  </select>



                </div>



              </div>



              <div class="col-md-3">



                <div class="form-group">



                  <label>Application Status:</label>



                  <select class="form-control status" id="status" name="stage">



                    <option value="">Select Status</option>



                    <option value="Pending">Pending</option>



                    <option value="Submitted">Submitted</option>



                    <option value="Approved">Approved</option>



                    <option value="Disbursed">Disbursed</option>



                    <option value="Rejected">Rejected</option>



                    <option value="Closed">Closed</option>



                  </select>



                </div>



              </div>



              <div class="col-md-3">



                <div class="form-group">



                  <label>Search By Loan A/C:</label>



                  <input type="text" name="account" id="account" class="form-control" placeholder="Search By Loan A/C No." />



                </div>



              </div>







              <div class="col-md-3">



                <div class="form-group">



                  <label>Search By Name:</label>



                  <input type="text" name="name" id="name" class="form-control" placeholder="Search By Name" />



                </div>



              </div>



              <div class="col-md-2">



                <div class="form-group">



                  <label>Search By Mobile No.:</label>



                  <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Search By Mobile No." />



                </div>



              </div>



              <div class="col-md-2">



                <div class="form-group">



                  <label>Search By Aadhar:</label>



                  <input type="text" name="aadhar" id="aadhar" class="form-control" placeholder="Search By Aadhar No." />



                </div>



              </div>

              <div class="col-md-5">
                <div id="reportrange" class="reportrange">
                  <div class="reportrange-inner">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                  </div>
                </div>
                <input type="hidden" name="" id="hidden_start_date">
                <input type="hidden" name="" id="hidden_end_date">
              </div>





            </div>



          </div>



        </div>



        <div class="row">



          <div class="col-md-12">


            <?php if (!empty($this->session->flashdata('HeadError_msg'))) { ?>



              <center><label class="label label-danger"><?php echo $this->session->flashdata('HeadError_msg'); ?></label></center>



            <?php } ?>



            <?php if (!empty($this->session->flashdata('HeadSuccess_msg'))) { ?>



              <center><label class="label label-success"><?php echo $this->session->flashdata('HeadSuccess_msg'); ?></label></center>



            <?php } ?>



            <?php if (!empty($this->session->flashdata('HeadSuspend_msg'))) { ?>



              <center><label class="label label-warning"><?php echo $this->session->flashdata('HeadSuspend_msg'); ?></label></center>



            <?php } ?>



            <div class="box box-primary">



              <div class="box-header">



                <h4 class="box-title">Customers</h4>



                <?php if (in_array('addCustomer', $permissions)) { ?>



                  <a href="<?php echo base_url(); ?>main/NewClient"><button class="btn-primary pull-right"><i class="fa fa-user-plus"></i> New Customer</button></a>



                <?php } ?>



              </div>



              <div class="box-body table-responsive">



                <table class="table table-bordered">



                  <thead>



                    <th>Loan A/C</th>



                    <th>Name</th>



                    <th>Mobile</th>



                    <th>Addhar No.</th>



                    <th>Occupation</th>



                    <th>Income</th>



                    <th>Loan Amount</th>
                    
                    <th>Principle Amount</th>
                    
                    <th>Interest Amount</th>



                    <th>Duration</th>



                    <th>Application Date</th>



                    <th>Sales Agent</th>
                    <th>Collection Agent</th>



                    <th>Status</th>



                    <th>Action</th>



                  </thead>



                  <tbody class="tbodys">



                    <?php



                    $total_loan = 0;



                    if ($this->session->userdata('user_type') == "admin") {

                      $clients = $this->db->get('tbl_customers_loan')->result_array();

                    } else {

                      $id = $this->session->userdata('user_id');

                      $this->db->select('*');

                      $this->db->from('tbl_customers a');

                      $this->db->join('tbl_customers_loan b', 'b.customer_id=a.client_id', 'left');

                      $this->db->where('a.client_repoting', $id);

                      $this->db->or_where('a.client_created', $id);

                      $this->db->order_by('a.client_id', 'desc');

                      $clients = $this->db->get()->result_array();
                    }

                    foreach ($clients as $data) :
                      
                      
                      
                      
                      $total_loan += $data['loan_amount']; ?>




                      <tr>
                        <td><?php echo $data['loan_account']; ?></td>
                        <td><?php echo $data['loan_account']; ?></td>



                        <td><a href="<?php echo base_url(); ?>main/ClientView/<?php echo $data['customer_id']; ?>"><?php echo $data['client_name']; ?></a></td>



                        <td><?php echo $datas['client_mobile']; ?></td>



                        <td><?php echo $data['client_aadhar']; ?></td>



                        <td><?php echo $data['client_occupation']; ?></td>



                        <td>&#x20B9; <?php echo $data['client_income']; ?></td>



                        <td>&#x20B9; <?php echo $data['loan_amount']; ?></td>



                        <td><?php echo $data['loan_duration']; ?> <?php echo $data['duration_unit']; ?></td>



                        <td><?php echo $data['application_date']; ?></td>



                        <td>



                          <?php $agent = $this->db->get_where('tbl_users', array('user_id' => $data['application_user']))->row_array();



                          echo $agent['user_name']; ?>



                        </td>
                        <td>



                          <?php $collection_user = $this->db->get_where('tbl_users', array('user_id' => $data['collection_user']))->row_array();



                          echo $collection_user['user_name']; ?>



                        </td>


                        <td><label class="label label-info"><?php if ($data['loan_status'] == "Submitted") {

                                                              echo "Application Submitted";
                                                            } else if ($data['loan_status'] == "Disbursed") {

                                                              echo "Application Disbursed";
                                                            } else if ($data['loan_status'] == "Approved") {

                                                              echo "Application Approved";
                                                            } else if ($data['loan_status'] == "Pending") {

                                                              echo "Application Pending";
                                                            } ?></label></td>



                        <td>



                          <?php if (in_array('editCustomer', $permissions)) { ?>



                            <a href="<?php echo base_url(); ?>main/ClientEdit/<?php echo $data['customer_id']; ?>/<?php echo $data['id']; ?>" title="Edit"><button class="btn-primary"><i class="fa fa-pencil"></i></button></a>



                          <?php } ?>



                          <?php if (in_array('blockCustomer', $permissions)) { ?>



                            <?php if ($data1['client_status'] > 0) { ?>



                              <a href="<?php echo base_url(); ?>main/customers/Suspend/<?php echo $data['customer_id']; ?>/<?php echo $data1['client_status']; ?>" title="Suspend"><button class="btn-warning"><i class="fa fa-ban"></i></button></a>



                            <?php } else { ?>



                              <a href="<?php echo base_url(); ?>main/customers/Suspend/<?php echo $data['customer_id']; ?>/<?php echo $data1['client_status']; ?>" title="Active"><button class="btn-success"><i class="fa fa-check"></i></button></a>



                            <?php } ?>



                          <?php } ?>



                          <?php if (in_array('deleteCustomer', $permissions)) { ?>



                            <a href="<?php echo base_url(); ?>main/customers/Delete/<?php echo $data['customer_id']; ?>/<?php echo $data['id']; ?>" title="Delete"><button class="btn-danger"><i class="fa fa-trash"></i></button></a>



                          <?php } ?>



                        </td>



                      </tr>



                    <?php endforeach; ?>



                  </tbody>



                </table>



              </div>



            </div>



          </div>



        </div>



      </section>



      <div class="ajax-loader" id="loading-image" style="display:none">



        <img src="<?php echo base_url(); ?>assets/loading.gif" class="img-responsive" />



      </div>



      <!-- /.content -->



    </div>



    <!-- /.content-wrapper -->







    <!-- Main Footer -->



    <?php include('inc/footer.php'); ?>



    <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>



    <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>



    <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

    <?php if (isset($type)) {  ?>

      <script>
        $("#status").val(<?php echo "'" . $type . "'" ?>).trigger('change');



        var sagent = $('#sagent').val();



        var cagent = $('#cagent').val();



        var status = $('#status').val();



        var account = $('#account').val();



        var name = $('#name').val();



        var mobile = $('#mobile').val();



        var aadhar = $('#aadhar').val();



        $.ajax({



          url: "<?php echo base_url(); ?>main/getFilteredClient",



          type: "POST",



          beforeSend: function() {



            $('#loading-image').show();



          },



          complete: function() {



            $('#loading-image').hide();



          },



          data: {

            sagent: sagent,

            cagent: cagent,

            status: status,

            account: account,

            name: name,

            mobile: mobile,

            aadhar: aadhar,

            loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

            loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',



          },



          success: function(data) {



            $("tbody").html(data);



          }







        })
      </script>

    <?php } ?>

    $('.sagent').select2();



    $('.cagent').select2();



    $('.status').select2();



    $(function() {



    $('#table').DataTable({



    'paging': true,



    'lengthChange': true,



    'searching': true,



    'ordering': true,



    'info': true,



    'autoWidth': false







    });



    });











    function printData()



    {



    var divToPrint = document.getElementById("table");



    newWin = window.open("");



    newWin.document.write(divToPrint.outerHTML);



    newWin.print();



    newWin.close();



    }



    $('.TodayEMI').on('click', function() {



    printData();



    })

    </script>



    <script>
      $(document).ready(function() {







        $('#sagent').on('change', function() {



          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();



          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient",



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',

            },



            success: function(data) {



              $("tbody").html(data);



            }







          })



        });







        $('#cagent').on('change', function() {



          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();



          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient",



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',

            },



            success: function(data) {



              $("tbody").html(data);



            }







          })



        });







        $('#status').on('change', function() {



          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();



          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient",



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',



            },



            success: function(data) {



              $("tbody").html(data);



            }







          })



        });







        $('#account').on('change', function() {



          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();



          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient",



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',

            },



            success: function(data) {



              $("tbody").html(data);



            }







          })



        });







        $('#name').on('change', function() {



          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();





          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient",



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',

            },



            success: function(data) {



              $("tbody").html(data);



            }







          })



        });







        $('#mobile').on('change', function() {



          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();



          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient",



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',

            },



            success: function(data) {



              $("tbody").html(data);



            }







          })



        });







        $('#aadhar').on('change', function() {



          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();



          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient",



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',

            },



            success: function(data) {



              $("tbody").html(data);



            }







          })



        });







      });





      <?php if (!isset($type)) {  ?>

        $(document).ready(function() {

          var loginUserId = '<?php echo  $this->session->userdata('user_id');  ?>';

          var loginUserType = '<?php echo  $this->session->userdata('user_type');  ?>';

          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient?loginUserId=" + loginUserId + '&loginUserType=' + loginUserType,



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            success: function(data) {



              $("tbody").html(data);



            }



          });



        });

      <?php } ?>
    </script>