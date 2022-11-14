<?php if($users){ 

    foreach ($users as $key => $value) { 

?>

<tr>

    <td><?php echo $value->full_name; ?></td>

    <td><?php echo $value->email; ?></td>

    <td><?php echo $value->mobile_number; ?></td>

    <td>

        <div class="btn-group">

            <button type="button" class="btn btn-<?php if($value->status=="Active"){echo "success";}else{echo "danger";}?>"><?php echo $value->status; ?></button>

            <button type="button" class="btn btn-<?php if($value->status=="Active"){echo "success";}else{echo "danger";}?> dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <span class="sr-only">Toggle Dropdown</span>

            </button>

            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(75px, 35px, 0px);">

            <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/users/change_status'); ?>" data-status="Active" onClick="changeStatusCommon(this)">Active</a>



            <div class="dropdown-divider"></div>

              <a  class="dropdown-item" href="javascript:" data-id="<?php echo $value->id; ?>" data-url="<?php echo site_url('admin/users/change_status'); ?>" data-status="Inactive" onClick="changeStatusCommon(this)">Inactive</a>

            </div>

        </div>

 </td>

    <td><?php echo date('M d, Y H:i:s', strtotime($value->add_date)); ?></td>


    <td>

      <ul class="list-unstyled d-flex mb-0">

     

        <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="deleteUser(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/users/delete') ?>"><i class="far fa-trash-alt"></i></a> </li>

      </ul>

    </td>
   

</tr>

<?php } } else{ ?>

    <tr><td colspan="6" align="center"> No records Found !!</td></tr>

    <?php } ?>