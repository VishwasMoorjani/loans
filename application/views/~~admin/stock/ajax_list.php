<?php if($users){

$i=1;

foreach ($users as $key => $value) { 

 ?>

<tr>

  <td><?php echo $i; ?></td>

  <td><?php echo strtoupper($value->product_name); ?></td>

  <td><img src="<?php echo site_url() ?>assets/admin/product/<?php echo $value->product_image; ?>"/></td>



  <?php if($value->ptype=="garments"){ ?>

    <td>

      <table class="table table-striped table-bordered table-hover">

        <tbody><tr><td>Size</td>

        <td>Qty</td>

       </tr>

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

  <td><?php echo strtoupper($value->stock_qty); ?></td>

  <td><?php echo ($value->sold_count); ?></td>

<?php } ?>

  <td><?php echo strtoupper($value->category); ?></td>



  

    

    <td><?php echo date('M d, Y', strtotime($value->add_date)); ?></td>

    <td>

      <ul class="list-unstyled d-flex mb-0">

        <?php if($value->ptype=="grocery"){ ?>

        <li> <a href="<?php echo  site_url(); ?>admin/grocery_product/update/<?php echo $value->product_id ?>" class="edit_btn" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a> </li>

        <?php }else{ ?>

        <li> <a href="<?php echo  site_url(); ?>admin/product/update/<?php echo $value->product_id ?>" class="edit_btn" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a> </li> 

        <?php } ?>  

      </ul>

    </td>

  </tr>

  <?php  $i++;} }else{ ?>

  <tr><td colspan="9" align="center">No records found !!</td></tr>

  <?php } ?>