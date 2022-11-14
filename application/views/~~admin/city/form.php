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

            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/city/add">

                <?php } else {?>

                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/city/update/<?php echo $id ?>">

                    <?php }?>

                    <div class="card-body">

                        

                        <div class="form-group row">

                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">State</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="state_id">
                                    <option>Select</option>
                                    <?php foreach ($state as $key => $value) { ?>
                                        `      <option value="<?php echo $value->id ?>"<?php if(isset($state_id) && $state_id == $value->id){echo "selected";} ?>><?php echo $value->name ?></option>         
                                    <?php     } ?>
                                </select>

                            </div>

                            

                        </div>
                        <div class="form-group row">

                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" id="fname" placeholder="Enter Title Here" name="title" value="<?php echo $title ?>">

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

                            <a href="<?php echo site_url() ?>admin/brand" class="btn btn-info pull-right rounded-0 back">Back</a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>