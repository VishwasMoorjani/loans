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
                <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/product/allproduct">
                <?php } else {?>
                    <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/product/update/<?php echo $id ?>">
                    <?php }?>
                    <div class="card-body">
                       <div class="form-group row">
                        <label for="fnameid" class="col-sm-3 text-right control-label col-form-label">Product ID</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="fnameid" placeholder="Enter Here" name="custom_product_id" value="<?php echo $custom_product_id ?>">
                        </div>

                    </div>     
                    <div class="form-group row">
                        <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Product Title</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="fname2" placeholder="Enter Title Here" name="product_name" value="<?php echo $product_name ?>">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="editor1" class="col-sm-3 text-right control-label col-form-label">Product Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="editor1" placeholder="Enter Descritpion Here" name="product_description"> <?php echo $product_description ?> </textarea>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="editor2" class="col-sm-3 text-right control-label col-form-label">Product Benefits</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="editor2" placeholder="Enter Descritpion Here" name="product_benefits"> <?php echo $product_benefits ?> </textarea>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="editor3" class="col-sm-3 text-right control-label col-form-label">Product Information</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="editor3" placeholder="Enter Descritpion Here" name="product_information"> <?php echo $product_information ?> </textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="fname3" class="col-sm-3 text-right control-label col-form-label">Fetured Image</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" id="fname3" class="custom-file-input" name="product_image">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname4" class="col-sm-3 text-right control-label col-form-label">Parent Category</label>
                        <div class="col-sm-6">
                            <select  class="form-control input-xsmall input-inline select2" id="fname4 " name="category_id">
                                <option value="">Select</option>
                                <?php foreach ($categorys as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname5" class="col-sm-3 text-right control-label col-form-label">Sub Category</label>
                        <div class="col-sm-6">
                            <select  class="form-control input-xsmall input-inline select2" id="fname5 " name="sub_category">
                                <option value="">Select</option>
                                <?php foreach ($sub_category as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="fname6" class="col-sm-3 text-right control-label col-form-label">Child Category</label>
                        <div class="col-sm-6">
                            <select  class="form-control input-xsmall input-inline select2" id="fname6 " name="sub_sub_category">
                                <option value="">Select</option>
                                <?php foreach ($sub_sub_category as $key => $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id==$category_id){echo "selected";} ?>><?php echo strtoupper($value->title);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="checkSize" class="col-sm-3 text-right control-label col-form-label"></label>
                        <input type="checkbox" id="checkSize" name="size_check" value="size_checked">
                        <label for="checkSize">Allow Product Sizes</label>
                    </div>

                    <div class="uncheckedsize">
                    <hr>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Qty</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Qty Here" name="qty" value="<?php echo $qty ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">MRP</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mrp" placeholder="Enter MRP Here" name="mrp_c" value="<?php echo $mrp ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount in persent %</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="dis" placeholder="Enter discount" name="discount_c" value="<?php echo $discount ?>">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sale Price</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="sale_price" placeholder="Enter sale price" name="sale_price" value="<?php echo $sale_price ?>">
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="checkedsize">


                        <div class="form-group row">
                            <label for="fname7" class="col-sm-3 text-right control-label col-form-label">Brand</label>
                            <div class="col-sm-6">
                                <select  class="form-control input-xsmall input-inline select2" id="fname7 " name="brand">
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
                                    <label for="fname9" class="col-sm-1 text-right control-label col-form-label">Variations</label>
                                    <div class="col-md-1">
                                        <input type="text" name="size[]"   class="form-control"  placeholder="Size" id="size"  />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="qtys[]"   class="form-control kl" placeholder="Qty"  id="qtys" />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="mrp[]"  id="mrp"  class="form-control mrp"  placeholder="mrp"  />
                                    </div>                                
                                    <div class="col-md-1">
                                        <input type="text" name="discount[]"  id="discount"  class="form-control discount"  placeholder="discount"  />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="prices[]"  id="prices"  class="form-control prices"  placeholder="Price"  />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="length[]"  id="length"  class="form-control"  placeholder="length"  />
                                    </div>

                                    <div class="col-md-1">
                                        <input type="text" name="height[]"  id="height"  class="form-control"  placeholder="height"  />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="width[]"  id="width"  class="form-control"  placeholder="width"  />
                                    </div>
                                    <div class="col-md-2"> <label class="btn btn-success" id="add"><i class="fas fa-plus-circle"></i></div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="parent">
                                    <?php $i=1; foreach ($product_details as $key => $value) { ?>


                                        <div class="row">
                                            <label for="fname9" class="col-sm-1 text-right control-label col-form-label">Variations</label>
                                            <div class="col-md-1">
                                                <input type="text" name="size[]"   class="form-control"  placeholder="Size" id="size"   value="<?php echo $value->size ?>" />
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" name="qtys[]"   class="form-control kl" placeholder="Qty"  id="qtys"  value="<?php echo $value->qty ?>" />
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" name="mrp[]"  id="length"  class="form-control mrp"  placeholder="mrp"  value="<?php echo $value->mrp ?>" />
                                            </div>                                
                                            <div class="col-md-1">
                                                <input type="text" name="discount[]"  id="length"  class="form-control discount"  placeholder="discount"  value="<?php echo $value->discount ?>" />
                                            </div>

                                            <div class="col-md-1">
                                                <input type="text" name="prices[]"  id="prices"  class="form-control prices"  placeholder="Price"  value="<?php echo $value->price ?>"  />
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" name="length[]"  id="length"  class="form-control"  placeholder="length"  value="<?php echo $value->length ?>" />
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" name="height[]"  id="height"  class="form-control"  placeholder="height"  value="<?php echo $value->height ?>" />
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" name="width[]"  id="width"  class="form-control"  placeholder="width"  value="<?php echo $value->width ?>" />
                                            </div>
                                            <?php if($i==1){ ?>
                                                <div class="col-md-2"> <label class="btn btn-success" id="add"><i class="fas fa-plus-circle"></i></div>
                                                <?php } ?>
                                            </div>
                                            <?php $i++; }?>
                                        </div>
                                    <?php } ?>  

                                </div>

                                <div class="form-group row">
                                    <label for="fname10" class="col-sm-3 text-right control-label col-form-label">Measurement Units</label>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                           <input type="text" class="form-control" id="fname10" placeholder="Enter unit Here" name="unit" value="<?php echo $unit ?>">
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
                $('.parent').append('<div class="row"  id="row'+i+'"><label for="fname" class="col-sm-1 text-right control-label col-form-label"></label><div class="col-md-1"><input type="text" name="size[]"   class="form-control"  placeholder="Size" /></div><div class="col-md-1"> <input type="text" name="qtys[]"   class="form-control kl"  placeholder="Qty"  /></div><div class="col-md-1"><input type="text" name="mrp[]"  id="length"  class="form-control mrp"  placeholder="mrp"  /></div><div class="col-md-1"><input type="text" name="discount[]"  id="length"  class="form-control discount"  placeholder="discount"  /></div><div class="col-md-1"><input type="text" name="prices[]"  id="prices"  class="form-control prices"  placeholder="Price"  /></div> <div class="col-md-1"><input type="text" name="length[]"  id="prices"  class="form-control"  placeholder="length" /></div><div class="col-md-1"><input type="text" name="height[]"  id="prices"  class="form-control"  placeholder="height" /></div><div class="col-md-1"><input type="text" name="width[]"  id="prices"  class="form-control"  placeholder="width" /></div><div class="col-md-2"> <label class="btn btn-danger btn_remove" id="'+i+'">-</div></div>');   

                i++;
                $('#size').attr('required',true);
                $('#qtys').attr('required',true);
                $('#length').attr('required',true);
                $('#width').attr('required',true);
                // $('#mrp').attr('required',true);
                // $('#discount').attr('required',true);
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
                // $('#mrp').attr('required',false);
                // $('#discount').attr('required',false);
                $('#width').attr('required',false);
                $('#height').attr('required',false);
                $('#prices').removeAttr('required',false);
            })

        </script>
        <script>
            CKEDITOR.replace('editor1', {
              uiColor: '#CCEAEE'
          });
            CKEDITOR.replace('editor2', {
              uiColor: '#CCEAEE'
          });
            CKEDITOR.replace('editor3', {
              uiColor: '#CCEAEE'
          });
      </script>


 <script type="text/javascript">
    $(".checkedsize").hide();
    //$(document).ready(function(){
        $('#checkSize').change(function(){
            if(this.checked){
                $('.checkedsize').fadeIn('slow');
                $('.uncheckedsize').fadeOut('slow');
                $('#mrp').attr('required',false);
            }
            else{
                $('.uncheckedsize').fadeIn('slow');
                $('.checkedsize').fadeOut('slow');
            }

        });
    //});
</script>

<script type="text/javascript">
     $("#dis").change(function(){
        var mrp = $('#mrp').val();
        var drate =$(this).val();
         var sale_rate = mrp*drate/100;
         $('#sale_price').val(mrp-sale_rate); 
     });
  </script>