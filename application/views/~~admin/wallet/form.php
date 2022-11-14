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
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/wallet/add">
                <?php } else {?>
                    <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/wallet/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select User</label>
                            <div class="col-sm-6"><?php //pr($parent_cat); ?>
                                <select  class="form-control input-xsmall input-inline select2" id="page_limit " name="user_id">
                                    <option value="">Select</option>
                                    <?php foreach ($users as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>">
                                    
                                        <?php echo strtoupper($value->full_name).' ( '.$value->email.' )' ;?>
                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="creditAmount" class="col-sm-3 text-right control-label col-form-label">Wallet Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="creditAmount" placeholder="Enter  Here" name="creditAmount" value="<?php echo $creditAmount ?>">
                            </div>
                            
                        </div>

                    <div class="form-group row">
                            <label for="description" class="col-sm-3 text-right control-label col-form-label">Wallet Description</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="description" placeholder="Enter Wallet description" name="description" value="<?php echo $description ?>">
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
                            <a href="<?php echo site_url() ?>admin/wallet" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.select2').select2({
            placeholder: 'Select wallet Type',
            allowClear: true
        });
    </script>
    <script type="text/javascript">
        function generateDiscountCode() {
            var length = 9;
            if (length < 3 || length == '') {
                alert('Too short discount code!');
            } else {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (var i = 0; i < length; i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                $('[name="code"]').val(text.toUpperCase());
            }
        }
    </script>

    <script type="text/javascript">
        $('.data-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            endDate: '+0d',
            format: 'yyyy-mm-dd'
        });
    </script>

    <script type="text/javascript">
        $('.data-autoclose-end').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    </script>