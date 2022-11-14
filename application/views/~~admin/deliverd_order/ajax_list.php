<?php if($users){
$i=1;
foreach ($users as $key => $value) {  //pr($value);
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo ucfirst($value->name); ?></td>
  <td><?php echo $value->email; ?></td>
  <td><?php if($value->payment_status){echo "Paid";}else{echo "Not Paid";} ?></td>
     
  <td><?php echo $value->payment_method; ?></td>
  <td><a href="javascript:" data-address="<?php echo $value->address ?>" onClick="showAddress(this)">View Address</a></td>

  
  <td>
<span class="badge badge-success">Delivered</span>
    </td>
    <td><?php echo date('M d, Y', strtotime($value->created_at)); ?></td>
    <td>
      <ul class="list-unstyled d-flex mb-0">
        <li> <a href="<?php echo site_url() ?>admin/orders/view/<?php echo $value->id ?>" class="view_btn" data-toggle="tooltip" data-placement="bottom" title=""   data-original-title="View Order Details"><i class="far fa-eye"></i></a> </li>
        <?php if($value->status!=2){  ?>
                <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Cancel Order" onclick="cancleorder(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/orders/cancle_order') ?>"><i class="fas fa-window-close"></i></a> </li>
          <?php }  ?>      
      </ul>
    </td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="15" align="center">No records found !!</td></tr>
  <?php } ?>