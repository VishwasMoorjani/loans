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
    <div class="btn-group">
      <button type="button" class="btn btn-<?php if($value->order_status=="Received"){echo "info";}else if($value->order_status=="Dispatch"){echo "warning";} else{ echo "success"; }?>"><?php echo $value->order_status; ?></button>
      <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span></button>
      <div class="dropdown-menu">
        <?php if($value->order_status=="Received"){ ?>
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/orders/change_status'); ?>" data-status="Received" onClick="changeStatusCommon(this)">Received</a>
         <?php } ?>
        <?php if($value->order_status=="Received"){ ?>
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/orders/change_status'); ?>" data-status="Dispatch" onClick="changeStatusCommon(this)">Dispatch</a>  
      <?php } ?>
      <?php if($value->order_status=="Received" || $value->order_status=="Dispatch" ){ ?>
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/orders/change_status'); ?>" data-status="Delivered" onClick="changeStatusCommon(this)">Delivered</a> 
         <?php } ?>
      </div>
      </div>
    </td>
    <td><?php echo date('M d, Y', strtotime($value->created_at)); ?></td>
    <td>
      <ul class="list-unstyled d-flex mb-0">
        <li> <a href="<?php echo site_url() ?>admin/orders/view/<?php echo $value->id ?>" class="view_btn" data-toggle="tooltip" data-placement="bottom" title=""   data-original-title="View Order Details"><i class="far fa-eye"></i></a> </li>
        <?php if($value->status!=2){  ?>
                <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Cancle Order" onclick="cancleorder(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/orders/cancle_order') ?>"><i class="fas fa-window-close"></i></a> </li>
          <?php }  ?>      
      </ul>
    </td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="15" align="center">No records found !!</td></tr>
  <?php } ?>