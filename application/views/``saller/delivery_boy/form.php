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
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>saller/delivery_boy/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>saller/delivery_boy/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="user_name" placeholder="Enter Name Here" name="user_name" value="<?php echo $user_name ?>">
                            </div>
                            
                        </div>                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="user_email" placeholder="Enter Email Here" name="user_email" value="<?php echo $user_email ?>">
                            </div>
                            
                        </div>                        
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="user_phone" placeholder="Enter Phone Here" name="user_phone" value="<?php echo $user_phone ?>">
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
                            <a href="<?php echo site_url() ?>saller/delivery_boy" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>