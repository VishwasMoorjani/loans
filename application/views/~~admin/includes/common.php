<script type="text/javascript">
	var site_url = '<?php echo site_url(); ?>';
	var base_url = site_url; 
	var siteurl = site_url; 
</script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap-toastr/toastr.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery-validation/cmxform.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets'); ?>global/datepicker/css/bootstrap-datepicker.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets'); ?>global/select2/select2.min.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/respond.min.js"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/scripts/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/scripts/common.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/scripts/media.js" type="text/javascript"></script>

<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap-toastr/toastr.min.js">
</script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript">
</script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript">
</script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/scripts/script.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/ckfinder/ckfinder.js"></script>

<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script src="<?php echo $this->config->item('admin_assets'); ?>global/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>

<script src="<?php echo $this->config->item('admin_assets'); ?>global/select2/select2.min.js" type="text/javascript"></script>

<script src="<?php echo $this->config->item('admin_assets'); ?>global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<!-- END CORE PLUGINS -->
<div class="modal fade bs-modal-sm" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form role="form" method="post" action="" class="ajax_form" id="DeleteForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" name="record_id" value="" id="RecordID">					
					Are You Sure! You want to delete?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn red">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade bs-modal-sm" id="RefundModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form role="form" method="post" action="" class="ajax_form" id="RefundForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Refund</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" name="record_id" value="" id="RefundId">
					<b>Once issued, a refund cannot be canceled. </b>
					<p>Are You Sure! You want to refund this transaction. </p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn red">Refund</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade bs-modal-sm" id="ReferralModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form role="form" method="post" action="" class="ajax_form" id="ReferralForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Referral transfer</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" name="record_id" value="" id="ReferralId">
					<b>Once issued, a transfer cannot be canceled. </b>
					<p>Are You Sure! You want to transfer the referral amount. </p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn red">Transfer</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--Code for Blank Multiple task -->
<div class="modal fade bs-modal-sm" id="alert_message_div" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header" id="alert_message_div_header">
				
			</div>
			<div class="modal-body" id="alert_message_div_message">
				
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Ok</button>
			</div>
		</div>
	</div>
</div>
<!--End Code for Blank Multiple task -->

<!--Code for Confirm Multiple Task-->
<div class="modal fade bs-modal-sm" id="alert_confirm_div" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<form role="form" method="post" action="" class="ajax_form" id="DeleteMultipleForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		    		<h3 id="confirm_alert_message_header">Please Confirm </h3>
				</div>
				<input type="hidden" name="ids" value="" id="multiple_Ids">
				<input type="hidden" name="task" value="" id="task">
				 <div class="modal-body">
		       		<p id="confirm_alert_message_body">Are You Sure to this <span class="confirm_task"></span> record</p>
		        </div>
				<div class="modal-footer">
		        	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    		<button class="btn confirm_btn" style="color: #fff;">Confirm</button>
		        </div>
			</form>			
		</div>
	</div>
</div>
<!--End Code for Confirm Multiple Task-->
                
<!--Modal for showing all media-->
<div class="modal fade" id="media" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Media</h4>
            </div>                    
            <div class="modal-body">
                 <div class="ajax_content_media">
                </div>
            </div>
            <div class="modal-footer">               
                <button type="button" class="btn green pull-left add_media">Upload New Media</button>                
                <button type="button" class="btn green use_media">Use Media</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--end all media modal-->

<!---upload media-->
<div class="modal fade" id="upload_media" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Media</h4>
            </div>                    
            <div class="modal-body">
            <?php echo form_open(site_url('admin/media/uploadImage'), array('class' => 'form-horizontal ajax_form','enctype'=>"multipart/form-data"));?>  
            <div class="form-group">
                <label for="Ensavoir" class="col-sm-4 control-label">
                	Title <span style="color:red">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="title" id="title" class="form-control">
                </div>
            </div>

              <div class="form-group">
                <label for="Ensavoir" class="col-sm-4 control-label">
                	Copyright Text</label>
                <div class="col-sm-8">
                	<input type="text" name="copyright_text" id="copyright_text" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="Ensavoir" class="col-sm-4 control-label">
                	Content</label>
                <div class="col-sm-8">
                	<textarea type="text" name="content" id=""  class="form-control" rows="3"></textarea>                  
                </div>
              </div> 
               <div class="form-group">
                <label for="Ensavoir" class="col-sm-4 control-label">
                	Image <span style="color:red">*</span></label>
                <div class="col-sm-8">
                	<input type="file" name="image" id="form_control_image">                  
                </div>
              </div>                   
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                  <button class="btn btn-success" type="submit">Submit</button>
                </div>
              </div>
            </form> 
            </div>
            <div class="modal-footer">               
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!---end upload media modal-->     


<script type="text/javascript">
	function refundTransaction($this) {
		$('#RefundModal').modal('show');
		$('#RefundId').val($($this).data('id'));
		$('#RefundForm').attr('action', $($this).data('url'));
	}

	function transferReferral($this) {
		$('#ReferralModal').modal('show');
		$('#ReferralId').val($($this).data('id'));
		$('#ReferralForm').attr('action', $($this).data('url'));
	}

//Delete Record
	function deleteRecord($this) {
		$('#DeleteModal').modal('show');
		$('#RecordID').val($($this).data('id'));
		$('#DeleteForm').attr('action', $($this).data('url'));
	}

	function callBackCommonDelete(data)
	{
		$('#DeleteModal').modal('hide');
		$('#alert_confirm_div').modal('hide');
		// submitSearchData();
		location.reload();
	}

//Change Record Status
	function changeStatusCommon($this)  {
		var action_url = $($this).attr('data-url');
		var record_id = $($this).attr('data-id');
		var next_status = $($this).attr('data-status');
		if(action_url && record_id && next_status)
		{
			$.getJSON(action_url,{id:record_id,status:next_status},function(data){
				if(data.success)
				{
					checkTosterResponse(data);
					// submitSearchData();
					location.reload();
				}
			})
		}
	}
</script>
<script type="text/javascript">		
//Intailize Select2 Class
$(document).ready(function(){       
    $(".select2").select2({

    });
});
</script>
<script type="text/javascript">
	//Code for Check Checkbox is not Blank
function checkForNullChecked(task,$this)
{
	var selected = new Array();
	$("#sample_3 input.recordcheckbox:checked").each(function() {
			selected.push($(this).val());
	});
	if(selected.length==0)
	{
		$("#alert_message_div").modal('show');
		$("#alert_message_div").find("#alert_message_div_header").text('Ohh!');
		$("#alert_message_div").find("#alert_message_div_message").text('Please select at least one record');
	}
	else
	{
		var taskurl = $($this).attr('data-taskurl');		
		showConfirmDialogTableMultiple(task,taskurl);
	}
}

//Show Confirm Dialog Popup 
function showConfirmDialogTableMultiple(task,taskurl)
{
	$('#alert_confirm_div').modal('show');
	$('#alert_confirm_div').find('#confirm_alert_message_header').text('Please confirm');
	$('#alert_confirm_div').find('#confirm_alert_message_body').text('Are you sure want to '+task+' this record');
	$('#alert_confirm_div').find('.confirm_btn').removeClass('green');
	$('#alert_confirm_div').find('.confirm_btn').removeClass('purple');
	$('#alert_confirm_div').find('.confirm_btn').removeClass('red');
	if(task=='Active')
	$('#alert_confirm_div').find('.confirm_btn').addClass('green');

	else if(task=='Inactive')
	$('#alert_confirm_div').find('.confirm_btn').addClass('purple');

	else if(task=='Deleted')
	$('#alert_confirm_div').find('.confirm_btn').addClass('red');

	else if(task=='Completed')
	$('#alert_confirm_div').find('.confirm_btn').addClass('green');

	else if(task=='Schedule')
	$('#alert_confirm_div').find('.confirm_btn').addClass('purple');

	else if(task=='Unschedule')
	$('#alert_confirm_div').find('.confirm_btn').addClass('purple');

    else if(task=='Decline')
	$('#alert_confirm_div').find('.confirm_btn').addClass('red');

    else if(task=='Approved')
	$('#alert_confirm_div').find('.confirm_btn').addClass('green');

    else if(task=='Pending')
	$('#alert_confirm_div').find('.confirm_btn').addClass('decline_info');

    else if(task=='Approve')
	$('#alert_confirm_div').find('.confirm_btn').addClass('green');

	else if(task=='Request')
	$('#alert_confirm_div').find('.confirm_btn').addClass('purple');

	else if(task=='Delete')
	$('#alert_confirm_div').find('.confirm_btn').addClass('red');
	$('#alert_confirm_div').find('#DeleteMultipleForm').attr('action',taskurl);
	var selected = new Array();
   		$("#sample_3 input.recordcheckbox:checked").each(function() {
     		selected.push($(this).val());
 	});
 	$('#alert_confirm_div').find('#multiple_Ids').val(selected);
 	$('#alert_confirm_div').find('#task').val(task);
}	
</script>
<script type="text/javascript">
jQuery(document).on('change','#sample_3 .group-checkable',function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
        if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }                    
    });
    jQuery.uniform.update(set);
});	
jQuery(document).on('change','#sample_3 .recordcheckbox',function () {
	 var checked = jQuery(this).is(":checked");
	 if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }   
});
</script>