<?php
	if ($message) {
		echo '<div class="alert alert-danger">' . $message . '</div>';
	}
?>
<div class="portlet light" style="height:45px">
	<div class="row">
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a class="tooltips" data-original-title="Home" href="<?php echo site_url('admin')?>" class="tooltips" data-original-title="<?php echo $this->lang->line('Home'); ?>" data-placement="top" data-container="body">Home</a>
				<i class="fa fa-arrow-right"></i>
			</li>			
			<li>
				Website setting
			</li>	
			<li style="float:right;">
				<a class="btn red tooltips" href="<?php echo base_url('admin'); ?>" style="float:right;margin-right:3px;margin-top: -7px;" data-original-title="Go Back" data-placement="top" data-container="body">Go Back<i class="m-icon-swapleft m-icon-white"></i>
				</a>
			</li>					
		</ul>			
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings"></i>
					<span class="caption-subject bold uppercase">Website setting</span>
				</div>
			</div>
			<div class="portlet-body form">				
				   <?php 
					echo form_open_multipart('', array('class'=>"ajax_form"));
					?>
					<div class="form-body">						
						<div class="portlet portlet-sortable box green-haze">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings"></i>SMTP details</div>
                                    <div class="tools">
                                        <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                                        <a class="fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                        <a class="remove" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-empty"> 
                                	<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="smtp_host" class="form-control" id="smtp_host" placeholder="Enter smtp host" value="<?php echo $options_content->smtp_host ?>">		
												<label for="form_control_smtp_host">SMTP host <span style="color:red">*</span></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="smtp_port" class="form-control" id="smtp_port" placeholder="Enter smtp port number" value="<?php echo $options_content->smtp_port ?>">
												<label for="form_control_smtp_port">SMTP port number <span style="color:red">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="smtp_user" class="form-control" id="smtp_user" placeholder="Enter smtp port number" value="<?php echo $options_content->smtp_user ?>">
												<label for="form_control_smtp_user">SMTP username <span style="color:red">*</span></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="smtp_pass" class="form-control" id="smtp_pass" placeholder="Enter smtp password" value="<?php echo $options_content->smtp_pass ?>">
												<label for="form_control_smtp_pass">SMTP password <span style="color:red">*</span></label>
											</div>
										</div>

                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" name="clear_med_amount" class="form-control" id="clear_med_amount" placeholder="Enter ClearMed amount" value="<?php echo $options_content->clear_med_amount ?>">
                                                <label for="form_control_smtp_pass">ClearMed Amount<span style="color:red">*</span></label>
                                            </div>
                                        </div>
									</div>
                                </div>
                             </div>                         

                            <!-- <div class="portlet portlet-sortable box green-haze">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class="icon-settings"></i>Contact email</div>
	                                    <div class="tools">
	                                        <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
	                                        <a class="fullscreen" href="javascript:;" data-original-title="" title=""> </a>
	                                        <a class="remove" href="javascript:;" data-original-title="" title=""> </a>
	                                    </div>
	                                </div>	                                
	                                <div class="portlet-body portlet-empty"> 
	                                	<div class="row">
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
												<textarea name="address" placeholder="Enter address" id="address" class="form-control"><?php echo $options_content->address; ?>
                            					</textarea>
                            					<label for="form_control_smtp_pass">Address<span style="color:red">*</span></label></div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
												<input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Enter contact number" value="<?php echo $options_content->contact_number ?>">
                            					<label for="form_control_smtp_pass">Contact number<span style="color:red">*</span></label></div>
											</div>						
										</div>
	                                </div>	                               
	                                                                
	                                <div class="portlet-body portlet-empty"> 
	                                	<div class="row">
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
												<input type="text" name="website" class="form-control" id="website" placeholder="Enter website" value="<?php echo $options_content->website ?>">
                            					<label for="form_control_smtp_pass">Website<span style="color:red">*</span></label></div>
											</div>	
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
												<input type="text" name="contact_email" class="form-control" id="contact_email" placeholder="Enter contact email" value="<?php echo $options_content->contact_email ?>">
                            					<label for="form_control_smtp_pass">Contact email<span style="color:red">*</span></label></div>
											</div>						
										</div>
	                                </div>	 
	                                                              
	                        </div>   -->	


	                        <!-- <div class="portlet portlet-sortable box green-haze">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings"></i>Social links URLs</div>
                                    <div class="tools">
                                        <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                                        <a class="fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                        <a class="remove" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-empty"> 
                                	<div class="row">
                                	    <div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="facebook_link" class="form-control" id="facebook_link" placeholder="Enter facebook link" value="<?php echo $options_content->facebook_link ?>">
												<label for="form_control_smtp_port">Facebook link<span style="color:red">*</span></label>
											</div>
										</div>	
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="google_plus_link" class="form-control" id="google_plus_link" placeholder="Enter google plus link" value="<?php echo $options_content->google_plus_link ?>">
												<label for="form_control_smtp_port">Google plus link<span style="color:red">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="pinterest_link" class="form-control" id="pinterest_link" placeholder="Enter pinterest link" value="<?php echo $options_content->pinterest_link ?>">
												<label for="form_control_smtp_port">Pinterest link <span style="color:red">*</span></label>
											</div>
										</div>	
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="youtube_link" class="form-control" id="youtube_link" placeholder="Enter youtube link" value="<?php echo $options_content->youtube_link ?>">
												<label for="form_control_smtp_port">Youtube link <span style="color:red">*</span></label>
											</div>
										</div>
									</div>	
									<div class="row">
									    <div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="instagram_link" class="form-control" id="instagram_link" placeholder="Enter instagram link" value="<?php echo $options_content->instagram_link ?>">
												<label for="form_control_smtp_port">Instagram link <span style="color:red">*</span></label>
											</div>
										</div>
									    <div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="twitter_link" class="form-control" id="twitter_link" placeholder="Enter twitter link" value="<?php echo $options_content->twitter_link ?>">
												<label for="form_control_smtp_port">Twitter link <span style="color:red">*</span></label>
											</div>
										</div>											
									</div>									
								</div>
                            </div>  -->

	                        <div class="portlet portlet-sortable box green-haze">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class="icon-settings"></i>Copyright text</div>
	                                    <div class="tools">
	                                        <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
	                                        <a class="fullscreen" href="javascript:;" data-original-title="" title=""> </a>
	                                        <a class="remove" href="javascript:;" data-original-title="" title=""> </a>
	                                    </div>
	                                </div>
	                                <div class="portlet-body portlet-empty"> 
	                                	<div class="row">
	                                	    <div class="col-md-6">
												<div class="form-group form-md-line-input">
												<textarea name="site_title" placeholder="Enter copy right text" id="site_title" class="form-control"><?php echo $site_title; ?>
                            					</textarea>
                            					<label for="form_control_smtp_pass">Website title<span style="color:red">*</span></label></div>
											</div>	
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
												<textarea name="copyright_text" placeholder="Enter copy right text" id="copyright_text" class="form-control"><?php echo $copyright_text; ?>
                            					</textarea>
                            					<label for="form_control_smtp_pass">Copyright text<span style="color:red">*</span></label></div>
											</div>	
																						
	                                </div>
	                            </div>
                            </div>
                                                                                                                               
	                    </div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green">Submit</button>
					</div>
				<?php 
					echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
</script>