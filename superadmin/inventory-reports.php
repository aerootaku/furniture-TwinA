<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/25/2018
 * Time: 9:01 AM
 */ ?>

<?php

include '../controller/action.php';
include 'session.php';
if(isset($_POST['range'])){
    $from = $_POST['from'];
    $to = $_POST['to'];

    $url = "inventory-report-print.php?from=".$from."&to=".$to;
    redirect($url);
}

if(isset($_POST['create'])) {
    $inventory_name = $_POST['inventory_name'];
    $value = custom_query("SELECT * FROM tbl_inventory WHERE name='$inventory_name' ORDER BY id DESC");
    if ($value->rowCount() > 0) {
        while ($r = $value->fetch(PDO::FETCH_ASSOC)) {
            $id = $r['id'];
            $qty = $r['quantity'];
            $type = $r['type'];
            $price = $r['price'];
        }

        $quantity = $_POST['quantity'];
        $p = $quantity * $price;
        $total = $qty - $quantity;

        db_update('tbl_inventory', $s = array("quantity"=>$total), $w = array("name"=>$inventory_name));
        db_insert('tbl_inventory_reports', $data = array("name"=>$inventory_name, "type"=>$type, "quantity"=>$quantity, "price"=>$p));

    }
    db_insert('tbl_logs', $data = array("transaction"=>$_POST['inventory_name'].' Information has been created', "created_by"=>$_SESSION['username']));
    $_SESSION['toastr'] = array(
        'type'=>'info',
        'message'=>'Record Added',
        'title'=>'Success'
    );
    redirect('inventory-reports.php');
    exit();
}
?>

<!doctype html>
<html lang="en">


<!-- Mirrored from thememakker.com/templates/lucid/main/forms-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Jul 2018 03:53:08 GMT -->
<head>
    <title>:: TwinA :: </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="../assets/vendor/parsleyjs/css/parsley.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="../assets/vendor/multi-select/css/multi-select.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="../assets/vendor/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/vendor/sweetalert/sweetalert.css"/>

    <!-- Propeller Button -->
    <link href="http://propeller.in/components/button/css/button.css" type="text/css" rel="stylesheet" />

    <!-- Propeller Accordion -->
    <link href="http://propeller.in/components/floating-action-button/css/floating-action-button.css" type="text/css" rel="stylesheet" />
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/color_skins.css">
</head>
<body class="theme-cyan">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="../assets/img/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">

    <?php include 'top.php'; ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>  Reports</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Manage Reports</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Inventory Report</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $xid = $_SESSION['id'];
                                    $value = custom_query("SELECT * FROM tbl_inventory_reports ORDER BY id DESC");
                                    if($value->rowCount()>0)
                                    {
                                        while($r=$value->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $id = $r['id'];
                                            ?>
                                            <tr>
                                                <td><?= $r['name']; ?></td>
                                                <td><?= $r['type']; ?></td>
                                                <td><?= $r['quantity']; ?></td>
                                                <td><?= number_format($r['price']); ?></td>
                                                <td><?= number_format($r['price'] * $r['quantity']); ?></td>
                                                <td><?= date('F d, Y', strtotime($r['dtcreated'])); ?></td>
                                            </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="menu pmd-floating-action" role="navigation">

    <a href="" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-danger" data-title="Add New" data-target="#new-record" data-toggle="modal">
        <span class="pmd-floating-hidden">Primary</span>
        <i class="fa fa-plus"></i>
    </a>
    <a href="" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" data-title="Generate Reports" data-target="#create-record" data-toggle="modal">
        <span class="pmd-floating-hidden">Primary</span>
        <i class="fa fa-database"></i>
    </a>
    <a href="" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-success">
        <span class="pmd-floating-hidden">Primary</span>
        <i class="fa fa-cogs"></i>
    </a>
</div>

<div class="modal fade" id="create-record" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Select Report Range</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>From</label>
                        <input type="date" class="form-control" name="from" />
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input type="date" class="form-control" name="to" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="range">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="new-record" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Material Input</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="inventory_name" class="form-control">
                            <?php
                            $value = custom_query("SELECT * FROM tbl_inventory ORDER BY id DESC");
                            if($value->rowCount()>0)
                            {
                            while($r=$value->fetch(PDO::FETCH_ASSOC))
                            {
                            $id = $r['id'];
                            $name = $r['name'];
                            ?>
                            <option value="<?= $name; ?>"><?= $name; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity <span style="color: red">*</span></label>
                        <input type="number" class="form-control" name="quantity" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="create">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--modal-->
<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_orders ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $r['id'];
        ?>
        <!--modal-->

    <?php }} ?>
<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_orders ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $r['id'];
        ?>
        <!--modal-->
        <div class="modal fade" id="approve-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Accept this order?</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="contact" value="<?= $r['contact']; ?>" />
                            <input type="hidden" class="form-control" name="email" value="<?= $r['email']; ?>" />
                            <input type="hidden" class="form-control" name="or_no" value="<?= $r['or_no']; ?>" />
                            This order will be marked as approve
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" name="approve">YES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }} ?>
<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_orders ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $r['id'];
        ?>
        <!--modal-->
        <div class="modal fade" id="delivery-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Mark this order for delivery?</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="contact" value="<?= $r['contact']; ?>" />
                            <input type="hidden" class="form-control" name="email" value="<?= $r['email']; ?>" />
                            <input type="hidden" class="form-control" name="or_no" value="<?= $r['or_no']; ?>" />
                            This order will be marked for delivery today</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" name="delivery">YES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }} ?>
<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_orders ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $r['id'];
        ?>
        <!--modal-->
        <div class="modal fade" id="claim-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Mark this order as Claimed?</h4>
                        </div>
                        <div class="modal-body"> This order will be marked as Claimed</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" name="claimed">YES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }} ?>
<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_orders ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $r['id'];
        ?>
        <!--modal-->
        <div class="modal fade" id="accept-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Accept this order?</h4>
                        </div>
                        <div class="modal-body"> This order will be marked as accepted</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" name="accept">YES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }} ?>
<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_orders ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $r['id'];
        ?>
        <!--modal-->
        <div class="modal fade" id="paid-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Paid this order?</h4>
                        </div>
                        <div class="modal-body">
                            <input type="text" value="<?= $r['contact']; ?>" name="contact" />
                            <input type="text" value="<?= $r['or_no']; ?>" name="or_no" />
                            This order will be marked as paid
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" name="paid">YES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }} ?>




<!-- Javascript -->
<script src="../assets/bundles/libscripts.bundle.js"></script>
<script src="../assets/bundles/vendorscripts.bundle.js"></script>

<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="../assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="../assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="../assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="../assets/vendor/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="../assets/vendor/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js -->
<script src="../assets/vendor/toastr/toastr.js"></script>
<script src="../assets/bundles/datatablescripts.bundle.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="../assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
<script src="../assets/vendor/parsleyjs/js/parsley.min.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#prod').parsley();
    });
</script>
<!--<script>-->
<!--    toastr.options.timeOut = "5000";-->
<!--    toastr.options.closeButton = true;-->
<!--    toastr.options.positionClass = 'toast-bottom-right';-->
<!--    toastr['success']('Information has been successfully saved');-->
<!---->
<!--</script>-->
<?php
if(isset($error))
{
    foreach($error as $error)
    {
        ?>
        <script>
            toastr.options.timeOut = "5000";
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-right';
            toastr['error']('<?php echo $error; ?>');

        </script>
    <?php }} ?>

<?php if(isset($_SESSION['toastr'])){
    ?>
    <script>
        toastr.options.timeOut = "5000";
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
        toastr['<?php echo $_SESSION['toastr']['type']; ?>']('<?php echo $_SESSION['toastr']['message']; ?>');
        <?php  unset($_SESSION['toastr']); ?>
    </script>
    <?php
}unset($_SESSION['toastr']); ?>

<script src="../assets/js/pages/forms/advanced-form-elements.js"></script>
<script src="../assets/js/pages/tables/jquery-datatable.js"></script>

</body>

</html>