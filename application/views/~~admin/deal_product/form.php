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
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/deal_product/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/deal_product/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline product" id="page_limit " name="product_id">
                                    <option value="">Select</option>
  
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Deal Price</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter  Here" name="deal_price" value="<?php echo $deal_price ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control data-autoclose" id="fname" placeholder="Start Date" name="start_date" value="<?php echo $start_date ?>" readonly>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">End date</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control data-autoclose-end" id="fname" placeholder="End date" name="end_date" value="<?php echo $end_date ?>" readonly>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label"> Start Time</label>
                            <div class="col-sm-6">
                                <div class="input-group clockpicker">
                                    <input type="text" class="form-control" placeholder="Select Start Time" name="start_time" value="<?php echo $start_time ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                    </div>                        
                    <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label"> End Time</label>
                            <div class="col-sm-6">
                                <div class="input-group clockpicker">
                                    <input type="text" class="form-control" placeholder="Select End Time" name="end_time" value="<?php echo $end_time ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
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
                            <a href="<?php echo site_url() ?>admin/deal_product" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


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


    <script type="text/javascript">

$('.clockpicker').clockpicker({

    placement: 'top',

    align: 'left',

    donetext: 'Done'

});

$(document).ready(function () {
  $('.product').select2({
    placeholder: 'Select Product',
    ajax: {
      url: site_url + 'admin/deal_product/get_all_product',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      },
      cache: true
    }
  })
});
</script>

