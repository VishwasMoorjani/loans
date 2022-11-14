<?php if($users){
$i=1;
foreach ($users as $key => $value) { 
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo strtoupper($value->name).' ('.$value->email.')'; ?></td>
  <td><?php echo 'Rs. '.$value->debitAmount.'/-'; ?></td>
  <td><?php echo 'Rs. '.$value->creditAmount.'/-'; ?></td>
  <td><?php echo $value->description ?></td>
 
    <td><?php echo date('M d, Y', strtotime($value->created_at)); ?></td>
    <td>
      <ul class="list-unstyled d-flex mb-0">
        <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="deleteUser(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/wallet/delete') ?>"><i class="far fa-trash-alt"></i></a> </li>
      </ul>
    </td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="6" align="center">No records found !!</td></tr>
  <?php } ?>