<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 9/20/2018
 * Time: 9:53 AM
 */

include '../controller/action.php';
include 'session.php';
?>

<html>
<head>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">

    <title>
        Sales Report Print
    </title>
</head>
<body onload="window.print()">
<h3 style="text-align: center">TwinA Furniture - Sales Report</h3>
<h5 style="text-align: center">From <strong><?= $_GET['from']; ?></strong> - To <strong><?= $_GET['to']; ?></strong></h5>
<center>
    <table style="text-align: center; border: 1px" border="5">
        <thead>
        <tr>
            <th>Order Number</th>
            <th width="160px">Name</th>
            <th width="120px">Type</th>
            <th width="140px">Price</th>
            <th width="120px">Quantity</th>
            <th width="140px">Color</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <tbody>
        <?php
        $xid = $_SESSION['id'];
        $from = $_GET['from'];
        $to = $_GET['to'];
        $value = custom_query("SELECT * FROM tbl_orders WHERE status = 'Claimed' and dtcreated >= '$from' and dtcreated < '$to' ORDER BY id DESC");
        if($value->rowCount()>0)
        {
            while($r=$value->fetch(PDO::FETCH_ASSOC))
            {
                $id = $r['id'];
                $total[] = $r['prod_price'] * $r['prod_qty'];
                ?>
                <tr>
                    <td><?= strtoupper($r['or_no']); ?></td>
                    <td><?= $r['prod_name']; ?></td>
                    <td><?= $r['prod_type']; ?></td>
                    <td>₱ <?= number_format($r['prod_price']); ?></td>
                    <td><?= $r['prod_qty']; ?></td>
                    <td><?= $r['prod_color']; ?></td>
                    <td><?= date('F d, Y', strtotime($r['dtcreated'])); ?></td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
    <hr />
    <p>Over All Sales: ₱ <?= number_format(array_sum($total)); ?></p>
</center>
</body>

</html>
