<?php if($users){
$i=1;
foreach ($users as $key => $value) {  //pr($value);
 ?>
<tr>
  <td><?php echo strtoupper($value->category); ?></td>
  <td><?php $record =  get_sub_category_name($value->sub_category); 
  echo ($record)? $record->title : $record ; ?></td>
 <?php  /* <td><?php $records =  get_sub_sub_category_name($value->sub_sub_category); 
  echo ($records)? $records->title : $records ; ?></td>  */?>
  <td><?php echo strtoupper($value->product_name); ?></td>
  <td><img src="<?php echo site_url() ?>assets/admin/product/<?php echo $value->product_image; ?>"/></td>
              <td><?php echo  $value->mrp; ?></td>
    <td><?php echo $value->sale_price; ?></td>
    <td><?php echo $value->discount; ?></td>
          <td> <?php echo $value->custom_product_id ?></td>
    <td><?php echo date('M d, Y', strtotime($value->add_date)); ?></td>
    

  <td>
    <div class="btn-group">
      <button type="button" class="btn btn-<?php if($value->is_featured=="Yes"){echo "success";}else{echo "danger";}?>"><?php echo $value->is_featured; ?></button>
      <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span></button>
      <div class="dropdown-menu">
        
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->product_id ?>" data-url="<?php echo site_url('admin/grocery_product/change_fetured_status'); ?>" data-status="Yes" onClick="changeStatusCommon(this)">Yes</a>
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->product_id ?>" data-url="<?php echo site_url('admin/grocery_product/change_fetured_status'); ?>" data-status="No" onClick="changeStatusCommon(this)">No</a> </div>
      </div>
    </td>  

  <td>
    <div class="btn-group">
      <button type="button" class="btn btn-<?php if($value->pstatus=="Active"){echo "success";}else{echo "danger";}?>"><?php echo $value->pstatus; ?></button>
      <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span></button>
      <div class="dropdown-menu">
        
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->product_id ?>" data-url="<?php echo site_url('admin/grocery_product/change_status'); ?>" data-status="Active" onClick="changeStatusCommon(this)">Active</a>
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->product_id ?>" data-url="<?php echo site_url('admin/grocery_product/change_status'); ?>" data-status="Inactive" onClick="changeStatusCommon(this)">Inactive</a> </div>
      </div>
    </td>  



    <td>
      <ul class="list-unstyled d-flex mb-0">
                <!-- <li> <a href="javascript:" class="view_btn" title="Add Color" data-toggle="tooltip" onclick="addEditColor(<?php echo $value->product_id ?>)"><i class="far fa-calendar-alt leftmenu menu-icon"></i></a> </li> -->
        <li> <a href="<?php site_url(); ?>grocery_product/update/<?php echo $value->product_id ?>" class="edit_btn" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a> </li>
        <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="deleteUser(this)" data-id="<?php echo $value->product_id;  ?>" data-customer="<?php echo $value->product_id;  ?>" data-url="<?php echo base_url('admin/grocery_product/delete') ?>"><i class="far fa-trash-alt"></i></a> </li>

        <li> <a href="<?php echo site_url()?>admin/grocery_product/product_images/<?php echo $value->product_id ?>" class="view_btn" title="Add Images" data-toggle="tooltip"><i class="far fa-images"></i></a> </li>
    
      </ul>
    </td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="14" align="center">No records found !!</td></tr>
  <?php } ?>