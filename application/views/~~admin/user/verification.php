<?php
	if ($message) {
		echo '<div class="alert alert-danger">' . $message . '</div>';
	}
?>
<div class="portlet light" style="height:45px">
	<ul class="page-breadcrumb breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a class="tooltips" data-original-title="Home" href="<?php echo site_url('admin')?>">Home</a>
			<i class="fa fa-arrow-right"></i>
		</li>		
		<li>Two Factor Authentication</li>
		<li style="float:right;">
			<a class="btn red tooltips" href="<?php echo base_url('admin'); ?>" style="float:right;margin-right:3px;margin-top: -7px;" data-original-title="Go back" data-placement="top" data-container="body">Go Back<i class="m-icon-swapleft m-icon-white"></i>
			</a>
		</li>
					
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="row">
					<div class="col-md-6">
						<div class="caption font-red-sunglo">
							<i class="fa fa-user"></i>
							<span class="caption-subject bold uppercase"><?php echo $page_title; ?></span>
						</div>
					</div>					
				</div>
			</div>			
			<div class="portlet-body form">
				<div class="pagedash_over setting-page">
				  <div class="container">
				    <div class="clearfix"></div>
				    <div class="row">
				      <div class="col-md-12">
				      <div class="col-md-3">
				      	<img src="<?php echo $qrCodeUrl; ?>" alt="image"/>
				      </div>
				      <div class="col-md-6">
				      <div class="factor-authentication-right">
				      	<label class="key-label">Key: </label><?php echo $secret; ?>
				            <form class="ajax_form" action="<?php echo current_url(); ?>" method="post">
				               <div class="form-group">
				                  <div class="form-group">
				                    <input type="text" name="verify_otp" placeholder="Verify OTP" class="form-control">
				                    <input type="hidden" name="secret_key" placeholder="secret_key" value="<?php echo $secret; ?>" class="form-control">
				                    <br><button type="submit" class="btn btn-primary btn-sm" id="add_address_btn">Validate</button>
				                  </div>
				                </div>     
				            </form>

				       </div>
				       </div>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>