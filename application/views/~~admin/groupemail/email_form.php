<!-- path -->
<script src="https://cdn.ckeditor.com/4.14.1/standard-all/ckeditor.js"></script>
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
			
			<?php if (!$id) {?>
			<form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/groupemail/add">
				<?php } else {?>
				<form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/groupemail/update/<?php echo $id ?>">
					<?php }?>
					<div class="card-body">
						<a href="javascript:" data-toggle="modal" data-target="#Excel" class="btn btn-info float-right rounded-0" style="margin-right: 20px"><i class="fas fa-file-excel"></i></a>
						<div class="form-group row">
							<label class="col-sm-3 text-right control-label col-form-label">Select User Type*</label>
							<div class="col-sm-9">
								<div class="col-md-9">
									<select class="form-control" name="user_type" required="required">
										<option>Select User Type</option>
										<option value="Customer">Customer</option>
										<option value="Vendor">Vendor</option>
									</select>
								</div>
							</div>
							
						</div>

						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Email Subject*</label>
							<div class="col-sm-9">
								<div class="col-md-9">
									<input type="text" class="form-control" id="fname" placeholder="Email Subject" name="subject">
								</div>
							</div>
							
						</div>
					
						<div class="form-group row">
							<label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
							<div class="col-sm-9">
								<div class="col-md-9" data-select2-id="11">
									<input type="textarea" class="form-control" id="email" placeholder="Enter Additional Email Ids (, )" name="addOnEmail" value="<?php echo $email ?>">
								</div>
							</div>
							
						</div>

						<div class="form-group row">
                <label for="editor1" class="col-sm-3 text-right control-label col-form-label">Email Body*</label>
                <div class="col-sm-9">
                <div class="col-sm-9">
                    <textarea class="form-control" id="editor1" placeholder="Email Body" name="email_body"> <?php echo $product_description ?> </textarea>
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
							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	 <script>
    CKEDITOR.replace('editor1', {
      uiColor: '#CCEAEE'
    });
  </script>


<script type="text/javascript">
  function UploadCsv(){
  searchRecords()
  $('#Excel').modal('hide');  
  $('#questionImage').modal('hide');  
    $('#soluctionImage').modal('hide'); 
  }

</script>

 <!-- Modal -->

<div class="modal fade" id="Excel" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bulk Email Send</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/groupemail/sendbulkmail" enctype="multipart/form-data">
            
            <div class="form-group row">
              <label for="fname" class="col-sm-3 text-right control-label col-form-label">Excel file</label>
                  <div class="col-sm-5">
                      <input type="file" class="form-control" id="fname" name="emailxls">
                  </div>
                <div class="col-sm-4">
                  <a href="<?php echo site_url() ?>admin/groupemail/samplexls">Download Sample <i class="fas fa-download"></i> </a>
                </div>

             </div>

             <div class="form-group row">
              <label for="subject" class="col-sm-3 text-right control-label col-form-label">Email Subject</label>
                  <div class="col-sm-5">
                      <input type="text" class="form-control" id="subject" placeholder="Enter Subject" name="subject">
                  </div>
             </div>

             <div class="form-group row">
                  <div class="col-sm-12">
                     <textarea class="form-control" id="editor2" placeholder="Email Body" name="email_body">Email Template</textarea>
                  </div>
                 
             </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
          </form>
        </div>
        <script type="text/javascript">
        	 CKEDITOR.replace('editor2', {
      uiColor: '#CCEAEE'
    });
        </script>
    </div>
</div>
