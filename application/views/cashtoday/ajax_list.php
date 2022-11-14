<?php if ($products) {
    $sum = 0;
    $crsum = 0;
    foreach ($products as $key => $value) {

?>
        <tr>
            <td><?php echo ++$key ?></td>
            <td><?php echo $value->receiving_from ?></td>
            <td><?php echo $value->received_by ?></td>
            <td><?php echo $value->cash_credit; ?> <?php $sum += $value->cash_credit; ?> </td>
            <td><?php echo $value->cash_debit; ?> <?php $crsum += $value->cash_debit; ?> </td>
            <td><?php echo $value->remark; ?> </td>
           
            <td></td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="3">Total</td>
        <td colspan="2"><?php echo $sum ?></td>
        <td colspan="2"><?php echo $crsum ?></td>
    </tr>
<?php } else { ?>
    <tr>
        <td colspan="8" align="center">No records found !!</td>
    </tr>
<?php } ?>