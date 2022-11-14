<?php if($users){
$i=1;
foreach ($users as $key => $value) {  //pr($value);
 ?>
<tr>
  <td><?php echo $i; ?></td>
  <td><img src="<?php echo site_url()."assets/admin/product/".$value->image ?>" height="50" width="100"/></td>
<!--  <td><?php //echo site_url()."assets/admin/product/".$value->image ?></td>-->
  <td><?php echo $value->image ?></td>
  <td><?php echo date("d-m-Y",strtotime($value->add_date)); ?></td>
      <td>
      <ul class="list-unstyled d-flex mb-0">

        <li> <a href="javascript:" class="delete_btn" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="deleteUser(this)" data-id="<?php echo $value->id;  ?>" data-customer="<?php echo $value->id;  ?>" data-url="<?php echo base_url('admin/media/delete') ?>"><i class="far fa-trash-alt"></i></a> </li>


    
      </ul>
    </td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="11" align="center">No records found !!</td></tr>
  <?php } ?>