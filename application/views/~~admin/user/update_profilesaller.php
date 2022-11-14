<!-- path -->
<div class="container-fluid">
    <div class="path">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                
                <li class="breadcrumb-item" aria-current="page"><?php echo $page_title; ?></li>
            </ol>
        </nav>
    </div>
</div>
<!-- #path -->
<!-- Content -->
<div class="container-fluid">
    <div class="content_container">
        <h2><?php echo $page_title; ?></h2>
        <div class="form_container">
            
            <form class="form-horizontal ajax_form" action="<?php echo site_url('admin/user/changePasswordForAdmin'); ?>" method="post">
                <div class="card-body">
                    <h4 class="card-title">Personal Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="fname" placeholder="Enter Full Name Here" name="full_name" value="<?php echo $full_name ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Username</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="fname" placeholder="Enter User Name Here" name="username" value="<?php echo $username ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="lname" placeholder="Last Name Here" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Opening time</label>
                        <div class="col-sm-4">
                            <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control"  name="opening_time" id="start_at" readonly="" value="<?php echo $opening_time ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"> <i class="far fa-clock"></i></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Close time</label>
                        <div class="col-sm-4">
                            <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control"  name="close_time" id="end_at" readonly="" value="<?php echo $close_time ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"> <i class="far fa-clock"></i></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-sm-3 text-right control-label col-form-label">Intervel(Min)</label>
                        <div class="col-sm-5">
                            <select class="select2 select2-intervel" name="intervel">
                                <option value="">Select Intervel</option>
                                <option <?php   if($intervel=="05"){ echo "selected"; }?>>05</option>
                                <option <?php   if($intervel=="10"){ echo "selected"; }?>>10</option>
                                <option <?php   if($intervel=="15"){ echo "selected"; }?>>15</option>
                                <option <?php   if($intervel=="20"){ echo "selected"; }?>>20</option>
                                <option <?php   if($intervel=="25"){ echo "selected"; }?>>25</option>
                                <option <?php   if($intervel=="30"){ echo "selected"; }?>>30</option>
                                <option <?php   if($intervel=="60"){ echo "selected"; }?>>60</option>
                                <option <?php   if($intervel=="120"){ echo "selected"; }?>>120</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Current Password</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="lname" placeholder="Password Here" name="current_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="lname" placeholder="Password Here" name="new_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Confirm Password</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="lname" placeholder="Password Here" name="re_new_password">
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-success rounded-0">Update</button>
                        <a href="<?php echo site_url() ?>saller/orders" class="btn btn-info pull-right rounded-0 back">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>
<script type="text/javascript">
$('.select2-intervel').select2({
placeholder: 'Select Category',
})
</script>