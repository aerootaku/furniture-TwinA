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
        Inventory Report Print
    </title>
</head>
<body onload="window.print()">
<!--<body>-->
<h3 style="text-align: center">TwinA Furniture - Inventory Report</h3>
<h5 style="text-align: center">From <strong><?= $_GET['from']; ?></strong> - To <strong><?= $_GET['to']; ?></strong></h5>
<center>
    <table style="text-align: center; border: 1px" border="5">
        <thead>
        <tr>
            <th width="160px">Name</th>
            <th width="120px">Category</th>
            <th width="140px">Quantity</th>
            <th width="120px">Price</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <tbody>
        <?php
        $from = $_GET['from'];
        $to = $_GET['to'];
        $value = custom_query("SELECT * FROM tbl_inventory_reports WHERE dtcreated >= '$from' and dtcreated <= '$to' ORDER BY id DESC");
        if($value->rowCount()>0)
        {
            while($r=$value->fetch(PDO::FETCH_ASSOC))
            {
                $id = $r['id'];
                $tq[] = $r['quantity'];
                $tp[] = $r['price'];
                ?>
                <tr>
                    <td><?= $r['name']; ?></td>
                    <td><?= $r['type']; ?></td>
                    <td><?= number_format($r['quantity']); ?></td>
                    <td>₱ <?= number_format($r['price']); ?></td>
                    <td><?= date('F d, Y', strtotime($r['dtcreated'])); ?></td>
                </tr>
            <?php } ?>
        <tr>
            <th colspan="5">
                Total Quantity: <?= number_format(array_sum($tq)); ?> <br />
                Total Price:₱ <?= number_format(array_sum($tp)); ?>
            </th>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <hr />
<!--    <p>Over All Sales: ₱ --><?//= number_format(array_sum($total)); ?><!--</p>-->
</center>
</body>

</html>
