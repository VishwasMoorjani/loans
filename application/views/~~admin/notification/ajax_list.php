<?php if ($notification) {
    foreach ($notification as $key => $value) { ?>
<tr>
    <td><?php echo $value->mobile ?></td>
    <td><?php echo $value->name ?></td>
    <td><?php echo $value->email ?></td>
    <td><?php echo $value->status ?></td>
    <td><?php echo date('M d, Y H:i:s', strtotime($value->created_at)); ?></td>
</tr>
<?php }} else {?>
<tr><td colspan="5" align="center">No records found !!</td></tr>
<?php }?>