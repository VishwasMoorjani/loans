<?php if ($users) {
  $i = 1;
  foreach ($users as $key => $value) {
?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo strtoupper($value->title); ?></td>
      <td><img src="<?php echo site_url() ?>assets/admin/icon/<?php echo $value->icon ?>" /></td>

      <td><?php echo date('M d, Y', strtotime($value->add_date)); ?></td>
      <td>
        <ul class="list-unstyled d-flex mb-0">
          <li> <a href="<?php site_url(); ?>category/update/<?php echo $value->id ?>" class="edit_btn" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a> </li>
          <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="deleteUser(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/category/delete') ?>"><i class="far fa-trash-alt"></i></a> </li>
        </ul>
      </td>
    </tr>
  <?php $i++;
  }
} else { ?>
  <tr>
    <td colspan="6" align="center">No records found !!</td>
  </tr>
<?php } ?>