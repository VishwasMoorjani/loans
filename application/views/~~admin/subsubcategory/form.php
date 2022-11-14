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
            
            <?php if (!$id) {?>
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/Sub_sub_category/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/Sub_sub_category/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent Category</label>
                            <div class="col-sm-6"><?php //pr($parent_cat); ?>
                                <select  class="form-control input-xsmall input-inline select2" id="page_limit " name="category_id" onChange="get_sub_category(this)">
                                    <option value="">Select</option>
                                    <?php foreach ($parent_cat as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$mycate){echo "selected";} ?>>
                                    
                                        <?php echo strtoupper($value->title);?>
                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sub Category</label>
                            <div class="col-sm-6"><?php //pr($parent_cat); ?>
                                <select  class="form-control input-xsmall input-inline select2" id="sub_category" name="sub_category_id">
                                    <option value="">Select</option>
                                    <?php foreach ($sub_category as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$mysubcate){echo "selected";} ?>>
                                    
                                        <?php echo strtoupper($value->title);?>
                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Title Here" name="title" value="<?php echo $title ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Icon</label>
                            <div class="col-sm-6">
                                <input type="file" name="icon" class="form-control" />
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
                            <a href="<?php echo site_url() ?>admin/sub_sub_category" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $('.select2').select2({
    placeholder: 'Select Category',
    allowClear: true
    });
    </script>

    <script type="text/javascript">
        function get_sub_category($this) {
            var category_id = $($this).val();
            $.ajax({
            url: site_url + "admin/sub_sub_category/get_sub_category?category_id="+category_id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
              $("#sub_category").html(json.html);
            },
            error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
            });

        }
    </script>