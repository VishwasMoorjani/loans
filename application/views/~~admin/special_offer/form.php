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
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/delivery_boy/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/delivery_boy/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-2 text-left control-label col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rounded-0" id="user_name" placeholder="Enter Title Here" name="title" value="<?php echo $title ?>">
                            </div>
                            
                        </div>                  
                        <div class="form-group row">
                            <label for="fname" class="col-sm-2 text-left control-label col-form-label">Percent</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control rounded-0" id="percent" placeholder="Enter percent Here" name="percent" value="<?php echo $percent ?>">
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
                            <a href="<?php echo site_url() ?>admin/special_offer" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>