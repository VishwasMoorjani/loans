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
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/grocery_product/bulkupload">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/grocery_product/bulkupload/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Download Sample</label>
                            <div class="col-sm-6">
                                <a href="<?php echo site_url() ?>admin/grocery_product/samplexls" class="btn btn-secondary float-right rounded-0"><i class="fas fa-download"></i>Download Sample</a>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select Brand For Cloth</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id=" " name="brand">
                                    <option value="">Select</option>
                                    <?php foreach ($brand_records as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$brand){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php /* ?>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent Category</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id=" " name="category_id">
                                    <option value="">Select</option>
                                    <?php foreach ($categorys as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sub Category</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id=" " name="sub_category">
                                    <option value="">Select</option>
                                    <?php foreach ($sub_category as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Child Category</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id=" " name="sub_sub_category">
                                    <option value="">Select</option>
                                    <?php foreach ($sub_sub_category as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php */ ?>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Upload Data File</label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="xlsfile">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
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
                            <a href="<?php echo site_url() ?>admin/grocery_product" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <script type="text/javascript">
    $('.select2').select2({
    placeholder: 'Select',
    allowClear: true
    });
    </script>

  <script>
    CKEDITOR.replace('editor1', {
      uiColor: '#CCEAEE'
    });
  </script>

    <script type="text/javascript">
     $("#dis").change(function(){
        var mrp = $('#mrp').val();
        var drate =$(this).val();
         var sale_rate = mrp*drate/100;
         $('#sale_price').val(mrp-sale_rate); 
     });
  </script>