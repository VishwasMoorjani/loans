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
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/home_middle_section/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/home_middle_section/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-2 text-left control-label col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rounded-0" id="user_name" placeholder="Enter Title Here" name="title" value="<?php echo $title ?>">
                            </div>
                            
                        </div>                  
                        <div class="form-group row">
                            <label for="fname" class="col-sm-2 text-left control-label col-form-label">Content</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rounded-0" id="percent" placeholder="Enter percent Here" name="content" value="<?php echo $content ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-2 text-left control-label col-form-label">Link Text</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rounded-0" id="percent" placeholder="Enter percent Here" name="link_text" value="<?php echo $link_text ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-2 text-left control-label col-form-label">Link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rounded-0" id="percent" placeholder="Enter percent Here" name="link" value="<?php echo $link ?>">
                            </div>
                            
                        </div>
                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image">
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
                            <a href="<?php echo site_url() ?>admin/home_middle_section" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>