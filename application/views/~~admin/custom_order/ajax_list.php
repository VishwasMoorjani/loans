<?php if($products){
$i=1;
foreach ($products as $key => $value) { 
?>
<tr>
    <td><?php echo $i; ?></td>
      <td><?php $record = get_record_by_user_id($value->user_id); echo $record->full_name; echo " (".$record->email.")"; echo " (".$record->mobile_number.")"; ?></td>
         <td><img src="<?php echo site_url() ?>assets/admin/docunment/<?php echo $value->document; ?>"/></td>
     
    <td>

        <div class="btn-group">
                  <button type="button" class="btn btn-<?php if($value->status=="Active"){echo "success";}else{echo "danger";}?>"><?php echo $value->status; ?></button>
                  <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span></button>
                  <div class="dropdown-menu">
                  
                     <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/custom_order/change_status'); ?>" data-status="Active" onClick="changeStatusCommon(this)">Active</a>

                     <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/custom_order/change_status'); ?>" data-status="Inactive" onClick="changeStatusCommon(this)">Inactive</a> </div>
                </div>
    </td>
    <td><?php echo date('M d, Y H:i:s', strtotime($value->add_date)); ?></td>
    <td>
        <ul class="list-unstyled d-flex mb-0">

          <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="deleteUser(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/custom_order/delete') ?>"><i class="far fa-trash-alt"></i></a> </li>
        </ul>
    </td>
</tr>
<?php  $i++;} }else{ ?>
<tr><td colspan="6" align="center">No records found !!</td></tr>
<?php } ?>