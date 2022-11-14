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
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/sub_category/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/sub_category/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent Category</label>
                            <div class="col-sm-6"><?php //pr($parent_cat); ?>
                                <select  class="form-control input-xsmall input-inline select2" id="page_limit " name="parent">
                                    <option value="">Select</option>
                                    <?php foreach ($parent_cat as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>>
                                    
                                        <?php echo strtoupper($value->title);?>
                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Add sub Category</label>
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
                            <a href="<?php echo site_url() ?>admin/sub_category" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $('.select2').select2({
    placeholder: 'Select Parent Category',
    allowClear: true
    });
    </script>