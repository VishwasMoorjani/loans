<?php if ($products) {
    foreach ($products as $key => $value) {
        $client_view = site_url() . '/main/ClientView/' . $value->customer_id;
?>
        <tr>
            <td><?php echo ++$key ?></td>
            <td><?php echo $value->file_no ?></td>
            <td><a href="<?php echo $client_view ?>"><?php echo $value->client_name; ?><br> <?php echo $value->client_mobile; ?></a> </td>
            <td><?php echo $value->client_guarantor; ?><br> <?php echo $value->client_gmobile; ?> </td>
            <td><?php echo $value->disbursed_date ?></td>
            <td><?php echo $value->loan_amount ?></td>
            <td><?php echo $value->emi_amount ?></td>
            <td></td>
        </tr>
    <?php }
} else { ?>
    <tr>
        <td colspan="8" align="center">No records found !!</td>
    </tr>
<?php } ?>