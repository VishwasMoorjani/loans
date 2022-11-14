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

            <?php if (!$id) { ?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>saller/grocery_product/add">
                <?php } else { ?>
                    <form class="ajax_form" method="post" action="<?php echo site_url() ?>saller/grocery_product/update/<?php echo $id ?>">
                    <?php } ?>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product ID</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Here" name="custom_product_id" value="<?php echo $custom_product_id ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">HSN Number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Here" name="hsn" value="<?php echo $hsn ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Title Here" name="product_name" value="<?php echo $product_name ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Description</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="editor1" placeholder="Enter Descritpion Here" name="product_description"> <?php echo $product_description ?> </textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Stock Qty</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="editor1" placeholder="Enter Stock Qty" name="stock_qty" value="<?php echo $stock_qty ?>" />
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Fetured Image</label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="product_image">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent Category</label>
                            <div class="col-sm-6">
                                <select class="form-control input-xsmall input-inline select2" id="page_limit " name="category_id" onChange="get_sub_category(this)">
                                    <option value="">Select</option>
                                    <?php foreach ($categorys as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>" <?php if ($value->id == $category_id) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo strtoupper($value->title); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sub Category</label>
                            <div class="col-sm-6">
                                <select class="form-control input-xsmall input-inline select2" id="sub_category" name="sub_category" onChange="get_sub_sub_category(this)">
                                    <option value="">Select</option>
                                    <?php foreach ($sub_category as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>" <?php if ($value->id == $sub_category_id) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo strtoupper($value->title); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <? php // echo $sub_sub_category_id; 
                        ?>
                        <!--                         <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Child Category</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id="sub_sub_category" name="sub_sub_category" >
                                    <option value="">Select</option>
                                    <?php foreach ($sub_sub_category as $key => $value) { ?>
                                    <option value="<?php //echo $value->id;
                                                    ?>" <?php if ($value->id == $sub_sub_category_id) {
                                                            echo "selected";
                                                        } ?>><?php echo strtoupper($value->title); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Brand</label>
                            <div class="col-sm-6">
                                <select class="form-control input-xsmall input-inline select2" id="brand" name="brand">
                                    <option value="">Select</option>
                                    <?php foreach ($brand_records as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>" <?php if ($value->id == $brand) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo strtoupper($value->title); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Taxes</label>
                            <div class="col-sm-6">
                                <select class="form-control input-xsmall input-inline select2" id="taxes_id" name="taxes_id">
                                    <option value="">Select</option>
                                    <?php foreach ($taxes as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>" <?php if ($value->id == $taxes_id) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo strtoupper($value->title); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Qty</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Qty Here" name="qty" value="<?php echo $qty ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Is Cap product</label>
                            <div class="col-sm-6">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="Yes" name="is_cap_product" <?php if ($is_cap_product == "Yes") {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="No" name="is_cap_product" <?php if ($is_cap_product == "No") {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>No
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Cap Qty</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Cap Qty Here" name="cap_qty" value="<?php echo $cap_qty ?>">
                            </div>

                        </div>
                        <!--                         <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">V1</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter v1 Here" name="v_one" value="<?php echo $v_one ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">v2</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter v2 Here" name="v_two" value="<?php echo $v_two ?>">
                            </div>
                            
                        </div> -->
                        <?php $record = get_record(); ?>
                        <?php if (!$id) { ?>
                            <div class="parent">
                                <div class="row">
                                    <label for="fname" class="col-sm-1 text-right control-label col-form-label">Variations</label>
                                    <div class="col-md-1">
                                        <input type="text" name="size[]" class="form-control" placeholder="<?php echo $record->varient_key; ?>" id="size" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="color[]" id="color" class="form-control" placeholder="<?php echo $record->varient_key2; ?>" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="mr[]" id="mrp" class="form-control mrp" placeholder="mrp" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="dis[]" id="discount" class="form-control discount" onChange="calcu(this)" placeholder="discount" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="prices[]" id="prices" class="form-control prices" placeholder="Price" />
                                    </div>
                                    <div class="col-md-2"> <label class="btn btn-success" id="add"><i class="fas fa-plus-circle"></i></div>
                                </div>
                            </div>
                        <?php } else if (count($product_details) > 0) { ?>
                            <div class="parent">
                                <?php $i = 1;
                                foreach ($product_details as $key => $value) { ?>


                                    <div class="row">
                                        <label for="fname" class="col-sm-1 text-right control-label col-form-label">Variations</label>
                                        <div class="col-md-1">
                                            <input type="text" name="size[]" class="form-control" placeholder="<?php echo $record->varient_key; ?>" id="size" value="<?php echo $value->size ?>" />
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" name="color[]" id="color" class="form-control" placeholder="<?php echo $record->varient_key2; ?>" value="<?php echo $value->color ?>" />
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" name="mr[]" id="mrps" class="form-control mrp" placeholder="mrp" value="<?php echo $value->mrp ?>" />
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" name="dis[]" id="discount" class="form-control discount" placeholder="discount" value="<?php echo $value->discount ?>" />
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" name="prices[]" id="prices" class="form-control prices" placeholder="Price" value="<?php echo $value->price ?>" />
                                        </div>
                                        <?php if ($i == 1) { ?>
                                            <div class="col-md-2"> <label class="btn btn-success" id="add"><i class="fas fa-plus-circle"></i></div>
                                        <?php } ?>
                                    </div>
                                <?php $i++;
                                } ?>
                            </div>
                        <?php } else { ?>
                            <div class="parent">
                                <div class="row">
                                    <label for="fname" class="col-sm-1 text-right control-label col-form-label">Variations</label>
                                    <div class="col-md-1">
                                        <input type="text" name="size[]" class="form-control" placeholder="<?php echo $record->varient_key; ?>" id="size" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="color[]" id="color" class="form-control" placeholder="<?php echo $record->varient_key2; ?>" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="mr[]" id="mrps" class="form-control mrp" placeholder="mrp" value="<?php echo $value->mrp ?>" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="dis[]" id="discount" class="form-control discount" placeholder="discount" value="<?php echo $value->discount ?>" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="prices[]" id="prices" class="form-control prices" placeholder="Price" />
                                    </div>
                                    <div class="col-md-2"> <label class="btn btn-success" id="add"><i class="fas fa-plus-circle"></i></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">MRP</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="actualmrp" placeholder="Enter MRP Here" name="mrp" value="<?php echo $mrp ?>">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount in persent %</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="dis" placeholder="Enter discount" name="discount" value="<?php echo $discount ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sale Price</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="sale_price" placeholder="Enter sale price" name="sale_price" value="<?php echo $sale_price ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Measurement Units</label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="text" class="form-control" id="fname" placeholder="Enter unit Here" name="unit" value="<?php echo $unit ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <?php if (!$id) { ?>
                                <button type="submit" class="btn btn-success rounded-0">Submit</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-success rounded-0">Update</button>
                            <?php } ?>
                            <a href="<?php echo site_url() ?>saller/grocery_product" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                    </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function calcu($this) {
        console.log($(this).closest('.row').find('.mrp').val());
    }
    var temp = 1;
    $(document).ready(function() {
        $('#add').click(function() {
            var i = 1;
            $('.parent').append('<div class="row"  id="row' + i + '"><label for="fname" class="col-sm-1 text-right control-label col-form-label"></label><div class="col-md-1"><input type="text" name="size[]"   class="form-control"  placeholder="<?php echo $record->varient_key; ?>" required /></div><div class="col-md-1"><input type="text" name="color[]"  id="color"  class="form-control"  placeholder="color" /></div><div class="col-md-1"><input type="text" name="mr[]"  id="length"  class="form-control mrp"  placeholder="mrp" required /></div><div class="col-md-1"><input type="text" name="dis[]"  id="length"  class="form-control discount"  placeholder="discount" required /></div><div class="col-md-1"><input type="text" name="prices[]"  id="prices"  class="form-control prices"  placeholder="Price"required  /></div> <div class="col-md-2"> <label class="btn btn-danger btn_remove" id="' + i + '">-</div></div>');
            i++;
            // $('#size').attr('required',true);
            // $('#qtys').attr('required',true);
            // $('#color').attr('required',true);
            //   $('#mrp').attr('required',true);
            //   $('#discount').attr('required',true);
            // $('#prices').attr('required',true);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
    $(document).on('click', '#1', function() {
        // $('#size').removeAttr('required',false);
        // $('#qtys').removeAttr('required',false);
        // $('#color').attr('required',false);
        // $('#mrp').attr('required',false);
        // $('#discount').attr('required',false);
        $('#prices').removeAttr('required', false);
    })
</script>
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
    $("#dis").change(function() {
        var mrp = $('#actualmrp').val();
        var drate = $(this).val();
        var sale_rate = mrp * drate / 100;
        $('#sale_price').val(mrp - sale_rate);
    });
</script>
<script type="text/javascript">
    $("#sale_price").change(function() {
        var mrp = $('#actualmrp').val();
        var sale_price = $(this).val();
        var discount = mrp - sale_price;
        var discount_in_percent = (discount / mrp) * 100
        $('#dis').val(discount_in_percent);
        //  (MRP-SALEPRICE)/MRP*100
    });
</script>

<script type="text/javascript">
    function get_sub_category($this) {
        var category_id = $($this).val();
        $.ajax({
            url: site_url + "saller/sub_category/get_sub_category?category_id=" + category_id,
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

<script type="text/javascript">
    function get_sub_sub_category($this) {
        var category_id = $($this).val();
        $.ajax({
            url: site_url + "saller/sub_sub_category/get_sub_sub_category?category_id=" + category_id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                $("#sub_sub_category").html(json.html);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
</script>