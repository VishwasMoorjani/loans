<!-- path -->
<div class="container-fluid">
    <div class="path">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                
                <li class="breadcrumb-item" aria-current="page"> <?php echo $page_title;?></li>
            </ol>
        </nav>
    </div>
</div>
<!-- #path -->
<!-- Content -->
<div class="container-fluid">
    <div class="content_container">
        <h2><?php echo $page_title;?></h2>
        <div class="form_container">
            
            <?php if(!$id){ ?>
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/slider/add">
                <?php } else  {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/slider/update/<?php echo $id ?>">
                    <?php } ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="Title" placeholder="Title" name="title" value="<?php echo $title ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type</label>
                            <div class="col-sm-6">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="type" <?php if($type=="web"){echo "checked";}  ?> value="web">Website
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="type" <?php if($type=="mobile"){echo "checked";}  ?> value="mobile">Mobile
                                    </label>
                                </div>
                                <div class="form-check-inline disabled">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="type" <?php if($type=="home"){echo "checked";}  ?> value="home">Home
                                    </label>
                                </div>
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
                            <a href="<?php echo site_url() ?>admin/slider" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>