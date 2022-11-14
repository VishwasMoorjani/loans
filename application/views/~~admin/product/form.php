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
            
            <?php if (!$id) {?>
            <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/product/add">
                <?php } else {?>
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/product/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                                               <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product ID</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Here" name="custom_product_id" value="<?php echo $custom_product_id ?>">
                            </div>
                            
                        </div>     
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Title Here" name="product_name" value="<?php echo $product_name ?>">
                            </div>
                            
                        </div>
                                                <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent Category</label>
                            <div class="col-sm-6" >
                                <select  class="form-control input-xsmall input-inline select2" id="page_limit " name="category_id"  onChange="get_sub_category(this)">
                                    <option value="">Select</option>
                                    <?php foreach ($categorys as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                                                <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sub Category</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id="sub_category" name="sub_category" onChange="get_sub_sub_category(this)">
                                    <option value="">Select</option>
                                    <?php foreach ($sub_category as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Child Category</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id="sub_sub_category" name="sub_sub_category">
                                    <option value="">Select</option>
                                    <?php foreach ($sub_sub_category as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Brand</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id="page_limit " name="brand">
                                    <option value="">Select</option>
                                    <?php foreach ($brand_records as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$brand){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        
                        <?php if(!$id){ ?>
                        <div class="parent">
                            <div class="row">
                                <label for="fname" class="col-sm-1 text-right control-label col-form-label">Variations</label>
                                <div class="col-md-1">
                                    <input type="text" name="size[]"   class="form-control"  placeholder="Size" id="size"required  />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="qtys[]"   class="form-control kl" placeholder="Qty"  id="qtys"required />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="mrp[]"  id="mrps"  class="form-control mrp"  placeholder="mrp" required />
                                </div>                                
                                <div class="col-md-1">
                                    <input type="text" name="discount[]"  id="discount"  class="form-control discount"  placeholder="discount" required />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="prices[]"  id="prices"  class="form-control prices"  placeholder="Price"required  />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="length[]"  id="length"  class="form-control"  placeholder="length" required />
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="height[]"  id="height"  class="form-control"  placeholder="height" required />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="width[]"  id="width"  class="form-control"  placeholder="width" required />
                                </div>
                                <div class="col-md-2"> <label class="btn btn-success" id="add"><i class="fas fa-plus-circle"></i></div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="parent">
                            <?php $i=1; foreach ($product_details as $key => $value) { ?>
                                
                            
                            <div class="row">
                                <label for="fname" class="col-sm-1 text-right control-label col-form-label">Variations</label>
                                <div class="col-md-1">
                                    <input type="text" name="size[]"   class="form-control"  placeholder="Size" id="size" required  value="<?php echo $value->size ?>" />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="qtys[]"   class="form-control kl" placeholder="Qty"  id="qtys" required value="<?php echo $value->qty ?>" />
                                </div>
                                                                <div class="col-md-1">
                                    <input type="text" name="mrp[]"  id="length"  class="form-control mrp"  placeholder="mrp" required value="<?php echo $value->mrp ?>" />
                                </div>                                
                                <div class="col-md-1">
                                    <input type="text" name="discount[]"  id="length"  class="form-control discount"  placeholder="discount" required value="<?php echo $value->discount ?>" />
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="prices[]"  id="prices"  class="form-control prices"  placeholder="Price" required value="<?php echo $value->price ?>"  />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="length[]"  id="length"  class="form-control"  placeholder="length" required value="<?php echo $value->length ?>" />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="height[]"  id="height"  class="form-control"  placeholder="height" required value="<?php echo $value->height ?>" />
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="width[]"  id="width"  class="form-control"  placeholder="width" required value="<?php echo $value->width ?>" />
                                </div>
                                <?php if($i==1){ ?>
                                <div class="col-md-2"> <label class="btn btn-success" id="add"><i class="fas fa-plus-circle"></i></div>
                                <?php } ?>
                            </div>
                        <?php $i++; }?>
                        </div>
                     <?php } ?>   
                                             <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Description</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="editor1" placeholder="Enter Descritpion Here" name="product_description"> <?php echo $product_description ?> </textarea>
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
                            <?php if (!$id) {?>
                            <button type="submit" class="btn btn-success rounded-0">Submit</button>
                            <?php } else{ ?>
                            <button type="submit" class="btn btn-success rounded-0">Update</button>
                            <?php } ?>
                            <a href="<?php echo site_url() ?>admin/product" class="btn btn-info pull-right rounded-0 back">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <script type="text/javascript">
    $('.select2').select2({
    placeholder: 'Select',
    allowClear: true
    });
    </script>

<script type="text/javascript">
var temp=1; 
    $(document).ready(function(){      
      $('#add').click(function(){
        var i=1;  
            $('.parent').append('<div class="row"  id="row'+i+'"><label for="fname" class="col-sm-1 text-right control-label col-form-label"></label><div class="col-md-1"><input type="text" name="size[]"   class="form-control"  placeholder="Size" required /></div><div class="col-md-1"> <input type="text" name="qtys[]"   class="form-control kl"  placeholder="Qty"  required/></div><div class="col-md-1"><input type="text" name="mrp[]"  id="length"  class="form-control mrp"  placeholder="mrp" required /></div><div class="col-md-1"><input type="text" name="discount[]"  id="length"  class="form-control discount"  placeholder="discount" required /></div><div class="col-md-1"><input type="text" name="prices[]"  id="prices"  class="form-control prices"  placeholder="Price"required  /></div> <div class="col-md-1"><input type="text" name="length[]"  id="prices"  class="form-control"  placeholder="length" /></div><div class="col-md-1"><input type="text" name="height[]"  id="prices"  class="form-control"  placeholder="height" /></div><div class="col-md-1"><input type="text" name="width[]"  id="prices"  class="form-control"  placeholder="width" /></div><div class="col-md-2"> <label class="btn btn-danger btn_remove" id="'+i+'">-</div></div>');   

          i++;
          $('#size').attr('required',true);
          $('#qtys').attr('required',true);
          $('#length').attr('required',true);
          $('#width').attr('required',true);
            $('#mrp').attr('required',true);
            $('#discount').attr('required',true);
          $('#height').attr('required',true);
          $('#prices').attr('required',true);
      });
$(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
    });  

   $(document).on('click', '#1', function(){  
        $('#size').removeAttr('required',false);
        $('#qtys').removeAttr('required',false);
        $('#length').attr('required',false);
        $('#mrp').attr('required',false);
        $('#discount').attr('required',false);
        $('#width').attr('required',false);
        $('#height').attr('required',false);
        $('#prices').removeAttr('required',false);
    })

</script>
  <script>
    CKEDITOR.replace('editor1', {
      uiColor: '#CCEAEE'
    });
  </script>
<!-- 
    <script type="text/javascript">
     
        $(document).on("change", ".discount", function () {

        var mrp = $(this).closest("div.parent").find(".mrp").val();
        var drate =$(this).val();
   
         var sale_rate = mrp*drate/100;
         $(this).closest("div.parent").find(".prices").val(mrp-sale_rate);
     });
  </script> -->


      <script type="text/javascript">
        function get_sub_category($this) {
            var category_id = $($this).val();
            $.ajax({
            url: site_url + "admin/sub_sub_category/get_sub_category?category_id="+category_id,
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
            url: site_url + "admin/sub_sub_category/get_sub_sub_category?category_id="+category_id,
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