<?php if($users){
$i=1;
foreach ($users as $key => $value) {  //pr($value);
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo ucfirst($value->name); ?></td>
  <td><?php echo $value->email; ?></td>
  <td><?php echo ucfirst($value->mobile_number); ?></td>
  <td><?php if($value->payment_status){echo "Paid";}else{echo "Not Paid";} ?></td>
  <td><?php echo $value->amount; ?></td>
      <td><?php $record = get_details($value->store_id); //pr($record);  ?><b>Name:</b> <?php echo $record->name ?><br><b>Email: </b><?php echo $record->email ?><br><b>Mobile: </b><?php echo $record->mobile_number ?></td>
  <td><?php echo $value->payment_method; ?></td>
  <td><?php $record = get_record();
          echo $value->amount*$record->commission/100;
    ?></td>
    <td><?php echo date('M d, Y', strtotime($value->created_at)); ?></td>
  </tr>
  <?php  $i++;} }else{ ?>
  <tr><td colspan="14" align="center">No records found !!</td></tr>
  <?php } ?>