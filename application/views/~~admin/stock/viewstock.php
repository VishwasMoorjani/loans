<?php if($users){
$i=1;
foreach ($users as $key => $value) {  //pr($value)
 ?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo strtoupper($value->product_name); ?></td>
  <td><img src="<?php echo site_url() ?>assets/admin/product/<?php echo $value->product_image; ?>"/></td>
  <td><?php echo ($value->brand)? strtoupper($value->brand) : '---'; ?></td>
  <?php if($value->ptype=="garments"){ ?>
    <td>
      <table class="table table-striped table-bordered table-hover">
        <tbody><tr><td>Size</td>
        <td>Qty</td></tr>
        <?php $records = get_product_detail($value->product_id);  ?>
        <?php foreach($records as $v){ ?>
        <tr>
          <td><?php echo $v->size ?></td>
          <td><?php echo $v->qty ?></td>
        </tr>
      <?php } ?>
      </tbody></table>
    </td>
  <?php }else{ ?>  
  <td><?php echo strtoupper($value->qty); ?></td>
<?php } ?>
  <td><?php echo strtoupper($value->category); ?></td>

  
    
    <td><?php echo date('M d, Y', strtotime($value->add_date)); ?></td>
    <td>
      <ul class="list-unstyled d-flex mb-0">

        <li> <a href="<?php site_url(); ?>product/update/<?php echo $value->product_id ?>" class="edit_btn" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a> </li>
    
      </ul>
    </td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="9" align="center">No records found !!</td></tr>
  <?php } ?>