<?php if ($users) {
$i = 1;
foreach ($users as $key => $value) {
$user_record = get_record_by_user_id($value->user_id);
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo ucfirst($user_record->full_name); ?></td>
  <td><?php echo $user_record->email; ?></td>
  <td><?php if ($value->payment_method == "Razorpay") {
    echo "Paid";
    } else {
    echo "Not Paid";
  } ?></td>
  <td><?php echo $value->transection_id; ?></td>
  <td><?php echo $value->payment_method; ?></td>
  <td><?php echo ucwords($value->order_source); ?></td>

  <td><?php echo date('M d, Y', strtotime($value->created_at)); ?></td>
  <td>
    <ul class="list-unstyled d-flex mb-0">
<!--       <li> <a href="<?php echo site_url() ?>saller/orders/view/<?php echo $value->id ?>" class="view_btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Order Details"><i class="far fa-eye"></i></a> </li> -->
      <?php if ($value->status != 2) {  ?>
      <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Cancel Order" onclick="cancleorder(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('saller/orders/cancle_order') ?>"><i class="fas fa-window-close"></i></a> </li>
      <?php }  ?>
      <!--   <li> <a href="javascript:" class="view_btn" data-toggle="tooltip" data-placement="bottom" title=""   data-original-title="assign to boy" onclick="assing_boy(this)" data-id="<?php echo $value->id;  ?>"><i class="fab fa-atlassian"></i></a> </li> -->
    </ul>
  </td>
</tr>
<?php $i++;
}
} else { ?>
<tr>
  <td colspan="15" align="center">No records found !!</td>
</tr>
<?php } ?>