 <!-- sidebar: style can be found in sidebar.less -->
 <section class="sidebar">
   <br />
   <div class="user-panel">
     <div class="pull-left image">
       <?php $userPic = $this->db->get_where('tbl_users', array('user_id' => $this->session->userdata('user_id')))->row_array(); ?>
       <?php if (empty($userPic['user_image'])) { ?>
         <img src="<?php echo base_url(); ?>assets/user-blank.jpg" class="img-circle" alt="User Image">
       <?php } ?>
       <?php if (!empty($userPic['user_image'])) { ?>
         <img src="<?php echo base_url(); ?>uploads/employees/photo/<?php echo $userPic['user_image']; ?>" class="img-circle" alt="User Image">
       <?php } ?>
     </div>
     <div class="pull-left info">
       <p>Hi, <?php echo $this->session->userdata('user_name'); ?></p>
       <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $role['role_name']; ?></a>
     </div>
   </div>
   <!-- Sidebar Menu -->
   <ul class="sidebar-menu" data-widget="tree">
     <br />
     <li class="<?php if ($this->uri->segment(2) == "dashboard") {
                  echo "active";
                } ?>"><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

     <li class="treeview <?php if ($this->uri->segment(2) == "newusertype" || $this->uri->segment(2) == "roles" || $this->uri->segment(2) == "newRole" || $this->uri->segment(2) == "editRole" || $this->uri->segment(2) == "branches" || $this->uri->segment(2) == "departments" || $this->uri->segment(2) == "employees" || $this->uri->segment(2) == "newEmployee" || $this->uri->segment(2) == "employee" || $this->uri->segment(2) == "editEmployee" || $this->uri->segment(2) == "password" || $this->uri->segment(2) == "loanSettings") {
                            echo "active";
                          } ?>">
       <a>
         <i class="fa fa-cogs"></i> <span>Settings</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
         <?php if (in_array('viewBranch', $permissions)) { ?>
           <li class="<?php if ($this->uri->segment(2) == "branches") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/branches"><i class="fa fa-circle-o"></i> Branches</a></li>
           <li class="<?php if ($this->uri->segment(2) == "newusertype") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/newusertype"><i class="fa fa-circle-o"></i> User Type</a></li> <?php } ?>
         <?php if (in_array('viewDepartment', $permissions)) { ?>
           <li class="<?php if ($this->uri->segment(2) == "departments") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/departments"><i class="fa fa-circle-o"></i> Department</a></li> <?php } ?>

         <?php if (in_array('viewRole', $permissions)) { ?>
           <li class="<?php if ($this->uri->segment(2) == "roles" || $this->uri->segment(2) == "newRole" || $this->uri->segment(2) == "editRole") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/roles"><i class="fa fa-circle-o"></i> Roles</a></li> <?php } ?>

         <?php if (in_array('loanSettings', $permissions)) { ?>
           <li class="<?php if ($this->uri->segment(2) == "loanSettings") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/loanSettings"><i class="fa fa-circle-o"></i> Loan Settings</a></li> <?php } ?>

         <?php if (in_array('viewEmployee', $permissions)) { ?>
           <li class="<?php if ($this->uri->segment(2) == "employees" || $this->uri->segment(2) == "newEmployee" || $this->uri->segment(2) == "employee" || $this->uri->segment(2) == "editEmployee") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/employees"><i class="fa fa-circle-o"></i>Employees</a></li> <?php } ?>

         <li class="<?php if ($this->uri->segment(2) == "password") {
                      echo "active";
                    } ?>"><a href="<?php echo base_url(); ?>main/password"><i class="fa fa-lock"></i> Change Password</a></li>
       </ul>
     </li>
     <?php if (in_array('viewCustomer', $permissions)) { ?>
       <li class="treeview <?php if ($this->uri->segment(2) == "customers" || $this->uri->segment(2) == "NewClient" || $this->uri->segment(2) == "ClientView" || $this->uri->segment(2) == "timeline" || $this->uri->segment(2) == "ClientEdit" || $this->uri->segment(2) == "loanTopup") {
                              echo "active";
                            } ?>">
         <a>
           <i class="fa fa-users"></i> <span>Customers</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(2) == "customers" || $this->uri->segment(2) == "ClientView" || $this->uri->segment(2) == "timeline" || $this->uri->segment(2) == "ClientEdit") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/customers?type=Disbursed"><i class="fa fa-circle-o"></i>All Customers</a></li>
           <?php if (in_array('addCustomer', $permissions)) { ?>
             <li class="<?php if ($this->uri->segment(2) == "NewClient") {
                          echo "active";
                        } ?>"><a href="<?php echo base_url(); ?>main/NewClient"><i class="fa fa-circle-o"></i>New Customer</a></li>
           <?php } ?>
         </ul>
       </li>
     <?php } ?>
     <?php if (in_array('dailyPayments', $permissions)) { ?>
       <li class="treeview <?php if ($this->uri->segment(2) == "dailyPayments" || $this->uri->segment(2) == "dailyPrintOuts") {
                              echo "active";
                            } ?>">
         <a>
           <i class="fa fa-inr"></i> <span>Collection</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li class="<?php if ($this->uri->segment(2) == "dailyPayments") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/dailyPayments"><i class="fa fa-circle-o"></i>Daily Collection</a></li>
           <li class="<?php if ($this->uri->segment(2) == "dailyPrintOuts") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/dailyPrintOuts"><i class="fa fa-circle-o"></i>Daily Collection Printouts</a></li>
         </ul>
       </li>
     <?php } ?>
     <li class="treeview <?php if ($this->uri->segment(2) == "cashBook" || $this->uri->segment(2) == "cashDetails" || $this->uri->segment(2) == "myCashBook" || $this->uri->segment(2) == "myCashDetails" || $this->uri->segment(2) == "cashTransfer") {
                            echo "active";
                          } ?>">
       <a>
         <i class="fa fa-inr"></i> <span>Ledger</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
         <?php if (in_array('cashBook', $permissions)) { ?>
           <li class="<?php if ($this->uri->segment(2) == "cashBook" || $this->uri->segment(2) == "cashDetails") {
                        echo "active";
                      } ?>"><a href="<?php echo base_url(); ?>main/cashBook"><i class="fa fa-circle-o"></i>Cash Book</a></li>
         <?php } ?>
         <li class="<?php if ($this->uri->segment(2) == "myCashBook" || $this->uri->segment(2) == "myCashDetails") {
                      echo "active";
                    } ?>"><a href="<?php echo base_url(); ?>main/myCashBook"><i class="fa fa-circle-o"></i>My Cash Book</a></li>

         <li class="<?php if ($this->uri->segment(2) == "cashTransfer") {
                      echo "active";
                    } ?>"><a href="<?php echo base_url(); ?>main/cashTransfer"><i class="fa fa-circle-o"></i>Cash Transfer/Deposit</a></li>
       </ul>
     </li>
     <li class="treeview <?php if ($this->uri->segment(2) == "npaReports" || $this->uri->segment(2) == "monthlyReports" || $this->uri->segment(2) == "emis"|| $this->uri->segment(2) == "cashtoday") {
                            echo "active";
                          } ?>">
       <a>
         <i class="fa fa-calendar"></i> <span>Reports</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
         <li class="<?php if ($this->uri->segment(2) == "npaReports") {
                      echo "active";
                    } ?>"><a href="<?php echo base_url(); ?>main/npaReports"><i class="fa fa-circle-o"></i>NPA Reports</a></li>
<!--          <li class="<?php if ($this->uri->segment(2) == "monthlyReports") {
                      echo "active";
                    } ?>"><a href="<?php echo base_url(); ?>main/monthlyReports"><i class="fa fa-circle-o"></i>Monthly Reports</a></li> -->
         <li class="<?php if ($this->uri->segment(2) == "emis") {
                      echo "active";
                    } ?>"><a href="<?php echo base_url(); ?>main/emis"><i class="fa fa-circle-o"></i>Emis</a></li>


                     <li class="<?php if($this->uri->segment(2)== "emis"){echo "active";}?>"><a href="<?php echo base_url();?>main/emis"><i class="fa fa-circle-o"></i>Today Due Emi</a></li>

            <li class="<?php if($this->uri->segment(2)== "cashtoday"){echo "active";}?>"><a href="<?php echo base_url();?>main/cashtoday"><i class="fa fa-circle-o"></i>Collection</a></li>

     <li class="<?php if($this->uri->segment(2)== "customers"){echo "active";}?>"><a href="<?php echo base_url();?>main/customers?type=Pending"><i class="fa fa-circle-o"></i>Today Pending Loan</a></li> 

     <li class="<?php if($this->uri->segment(2)== "customers"){echo "active";}?>"><a href="<?php echo base_url();?>main/customers?type=Submitted"><i class="fa fa-circle-o"></i>Today Submitted Loan</a></li>

          <li class="<?php if($this->uri->segment(2)== "customers"){echo "active";}?>"><a href="<?php echo base_url();?>main/customers?type=Approved"><i class="fa fa-circle-o"></i>Total Approved Loan</a></li>  

        

            <li class="<?php if($this->uri->segment(2)== "customers"){echo "active";}?>"><a href="<?php echo base_url();?>main/customers?type=Disbursed"><i class="fa fa-circle-o"></i>Total Disbursed Loan</a></li>

       
        <li class="<?php if($this->uri->segment(2)== "customers"){echo "active";}?>"><a href="<?php echo base_url();?>main/customers?type=Rejected"><i class="fa fa-circle-o"></i>Total Rejected Loan</a></li>
       </ul>
     </li>
   </ul>
   <!-- /.sidebar-menu -->
 </section>