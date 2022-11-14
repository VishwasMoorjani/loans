<!-- path -->
<div class="container-fluid">
	<div class="path">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				
				<li class="breadcrumb-item" aria-current="page"> Registration</li>
			</ol>
		</nav>
	</div>
</div>
<!-- #path -->
<!-- Content -->
<div class="container-fluid">
	<div class="content_container">
		<h2>Registration</h2>
		<div class="form_container">
			
			<?php if (!$id) {?>
			<form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/users/add">
				<?php } else {?>
				<form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/users/update/<?php echo $id ?>">
					<?php }?>
					<div class="card-body">
						
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Full Name</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="text" class="form-control" id="fname" placeholder="Enter Full Name Here" name="full_name" value="<?php echo $full_name ?>">
								</div>
							</div>
							
						</div>
						<?php if($id){ ?>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Mobile</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="text" class="form-control" id="fname" placeholder="Enter Mobile Here" name="mobile_no" value="<?php echo $mobile_number ?>" readonly>
								</div>
							</div>
							
						</div>
					<?php }else{?>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Mobile</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="text" class="form-control" id="fname" placeholder="Enter Mobile Here" name="mobile_no" value="<?php echo $mobile_number ?>" >
								</div>
							</div>
							
						</div>
					<?php }?>	

						<?php if($id){ ?>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="text" class="form-control" id="fname" placeholder="Enter Email Here" name="email" value="<?php echo $email ?>" readonly>
								</div>
							</div>
							
						</div>
					<?php } else { ?>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="text" class="form-control" id="fname" placeholder="Enter Email Here" name="email" value="<?php echo $email ?>">
								</div>
							</div>
							
						</div>

					<?php } ?>	
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="password" class="form-control" id="fname" placeholder="Enter Password Here" name="password" >
								</div>
							</div>
							
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="password" class="form-control" id="fname" placeholder="Enter Confirm Password" name="cpassword" >
								</div>
							</div>
							
						</div>
						
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Type</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									
									<div class="d-flex flex-wrap mt-2">
										<div class="custom-control custom-radio w-50">
											<input type="radio" id="customRadio1" name="type" class="custom-control-input" <?php if($user_type=="school"){echo "checked";} ?> value="school">
											<label class="custom-control-label" for="customRadio1">School</label>
										</div>
										<div class="custom-control custom-radio w-50">
											<input type="radio" id="customRadio2" name="type" class="custom-control-input" <?php if($user_type=="coaching"){echo "checked";} ?> value="coaching">
											<label class="custom-control-label" for="customRadio2">Institute</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="border-top">
						<div class="card-body">
							<?php if (!$id) {?>
							<button type="submit" class="btn btn-success rounded-0">Submit</button>
							<?php } else{ ?>
							<button type="submit" class="btn btn-success rounded-0">Update</button>
							<?php } ?>
							<a href="<?php echo site_url() ?>admin/users" class="btn btn-info pull-right rounded-0 back">Back</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>