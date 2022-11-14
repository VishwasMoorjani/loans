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
				<?php echo form_open(current_url(), array('class' => 'ajax_form'));?>			
					<div class="form-body">						
						<div class="form-group form-md-line-input">
							<label for="form_control_first_name">Two Factor Authentication<span style="color:red">*</span></label>
							<div class="col-md-10">	
								<div class="md-radio-inline">
									<div class="md-radio">
										<input id="radio19" class="md-radiobtn" type="radio" name="two_factor_authentication" value="Yes" <?php echo ($two_factor_authentication == 'Yes')?'checked':''; ?>>
										<label for="radio19">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>Active</label>
									</div>									
									<div class="md-radio has-error">
										<input id="radio20" class="md-radiobtn" type="radio" name="two_factor_authentication" value="No" <?php echo ($two_factor_authentication == 'No')?'checked':''; ?>>
										<label for="radio20">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>Inactive</label>
									</div>
								</div>
							</div>							
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green">Submit</button>
						<a href="<?php echo base_url('admin'); ?>" class="btn default">Cancel</a>
					</div>							
				</form>
			</div>
		</div>
	</div>
</div>