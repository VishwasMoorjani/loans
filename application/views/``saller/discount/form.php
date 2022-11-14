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
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>saller/discount/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>saller/discount/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount Type</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id="page_limit " name="type">
                                    <option value="">Select</option>
                                    <option value="float" <?php if($dtype=="float"){echo "selected";} ?>>Float</option>
                                    <option value="persent" <?php if($dtype=="persent"){echo "selected";} ?>>Persent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount Value</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter  Here" name="amount" value="<?php echo $amount ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Code</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="code" placeholder="Enter Title Here" name="code" value="<?php echo $code ?>">
                            </div>
                            <div class="col-sm-2"><a href="javascript:void(0);" onclick="generateDiscountCode()" class="btn btn-xs btn-info rounded-0">Generate</a></div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Valid From Date</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control data-autoclose" id="fname" placeholder="Valid From Date" name="valid_from_date" value="<?php echo $valid_from_date ?>" readonly>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Valid To date</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control data-autoclose-end" id="fname" placeholder="Valid To date" name="valid_to_date" value="<?php echo $valid_to_date ?>" readonly>
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
                            <a href="<?php echo site_url() ?>saller/discount" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <script type="text/javascript">
    $('.select2').select2({
    placeholder: 'Select Discount Type',
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