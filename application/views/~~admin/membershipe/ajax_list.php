<?php if($users){
$i=1;
foreach ($users as $key => $value) {
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo strtoupper($value->title); ?></td>
  <td><img src="<?php echo site_url() ?>assets/admin/icon/<?php echo $value->icon ?>"/></td>
  <td>
    <div class="btn-group">
      <button type="button" class="btn btn-<?php if($value->status=="Active"){echo "success";}else{echo "danger";}?>"><?php echo $value->status; ?></button>
      <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span></button>
      <div class="dropdown-menu">
        
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/membership/change_status'); ?>" data-status="Active" onClick="changeStatusCommon(this)">Active</a>
        <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/membership/change_status'); ?>" data-status="Inactive" onClick="changeStatusCommon(this)">Inactive</a> </div>
      </div>
    </td>
    <td><?php echo date('M d, Y', strtotime($value->add_date)); ?></td>
    <td>
      <ul class="list-unstyled d-flex mb-0">
        <li> <a href="<?php site_url(); ?>membership/update/<?php echo $value->id ?>" class="edit_btn" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a> </li>
        <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="deleteUser(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/membership/delete') ?>"><i class="far fa-trash-alt"></i></a> </li>
      </ul>
    </td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="6" align="center">No records found !!</td></tr>
  <?php } ?>