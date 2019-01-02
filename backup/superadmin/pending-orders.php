<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/25/2018
 * Time: 9:01 AM
 */ ?>

<?php

include '../controller/action.php';
// Required if your environment does not handle autoloading
require '../vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC18338765470d419e5bbb753d87c6dbe1';
$token = 'faeae8a3a448742ccd029cb485d4ad92';
$from='+14805265056';
$client = new Client($sid, $token);


if(isset($_POST['accept'])){
    $id = array("id"=>$_GET['id']);
    $data = array(
        "status"=>"Accepted"
    );
    $edit = db_update('tbl_orders', $data, $id = array("id"=>$_GET['id']));
    if(isset($edit)){
        $to = "+639215388860";
        $smsBody = "Hi";
        $client->messages->create($to,array('from' => $from,  'body' => $smsBody));
        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Order has been accepted',
            'title'=>'Congratulations'
        );
        redirect('orders.php');
        exit();
    }
    else{
        $error[] = '';
    }
}
if(isset($_POST['approve'])){
    $id = array("id"=>$_GET['id']);
    $data = array(
        "status"=>"Accepted"
    );

    $edit = db_update('tbl_orders', $data, $id = array("id"=>$_GET['id']));
    if(isset($edit)){
        $to = $_POST['contact'];
        $smsBody = "Your Order ". $_POST['or_no'] . "Has been Accepted, Please settle the remaining balance for us to continue and deliver your requested items";
        $client->messages->create($to,array('from' => $from,  'body' => $smsBody));
        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Order has been accepted',
            'title'=>'Congratulations'
        );
        redirect('pending-orders.php');
        exit();
    }
    else{
        $error[] = '';
    }
}
if(isset($_POST['delete'])){
    $delete = db_delete('tbl_products', $id = array("id"=>$_GET['id']));
    if(isset($delete)){

        $_SESSION['toastr'] = array(
            'type'=>'warning',
            'message'=>'Products Deleted Successfully',
            'title'=>'Congratulations'
        );
    }
    else{
        $error[] = '';
    }
}

if(isset($_POST['delivery'])){
    $id = array("id"=>$_GET['id']);
    $data = array(
        "status"=>"Delivery"
    );
    $edit = db_update('tbl_orders', $data, $id = array("id"=>$_GET['id']));
    if(isset($edit)){
        $to = $_POST['contact'];
        $smsBody = "Your Order ". $_POST['or_no'] . " is for delivery today. Please expect our delivery team & be ready";
        $client->messages->create($to,array('from' => $from,  'body' => $smsBody));
        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Order has been marked for Delivery',
            'title'=>'Congratulations'
        );
    }
    else{
        $error[] = '';
    }
}

if(isset($_POST['claimed'])){
    $id = array("id"=>$_GET['id']);
    $data = array(
        "status"=>"Claimed"
    );
    $edit = db_update('tbl_orders', $data, $id = array("id"=>$_GET['id']));
    if(isset($edit)){

        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Order has been marked as Claimed',
            'title'=>'Congratulations'
        );
    }
    else{
        $error[] = '';
    }
}
?>

<!doctype html>
<html lang="en">


<!-- Mirrored from thememakker.com/templates/lucid/main/forms-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Jul 2018 03:53:08 GMT -->
<head>
    <title>:: Lucid :: Form Validation</title>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> My Orders</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Manage Orders</li>
                        </ul>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#00c5dc"
                                 data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
                            <span>Visitors</span>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#f4516c"
                                 data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
                            <span>Visits</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Manage Orders</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                    <tr>
                                        <!--                                        <th>Thumbnail</th>-->
                                        <th>Order Number</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Color</th>
                                        <th>Order Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <!--                                        <th>Thumbnail</th>-->
                                        <th>Order Number</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Color</th>
                                        <th>Order Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $xid = $_SESSION['id'];
                                    $value = custom_query("SELECT * FROM tbl_orders ORDER BY id DESC");
                                    if($value->rowCount()>0)
                                    {
                                        while($r=$value->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $id = $r['id'];
                                            ?>
                                            <tr>
                                                <td><?= $r['or_no']; ?></td>
                                                <td><?= $r['prod_name']; ?></td>
                                                <td><?= $r['prod_category']; ?></td>
                                                <td><?= $r['prod_type']; ?></td>
                                                <td><?= $r['prod_price']; ?></td>
                                                <td><?= $r['prod_qty']; ?></td>
                                                <td><?= $r['prod_color']; ?></td>
                                                <td><?= $r['or_type']; ?></td>
                                                <td><?= $r['status']; ?></td>
                                                <td>
                                                    <?php if($r['status'] == 'Processing'): ?>
<!--                                                        <button type="button" class="btn btn-success mr-3" title="Edit" data-target="#accept-record--><?//=$id; ?><!--" data-toggle="modal"><i class="fa fa-check"></i></button>-->
<!--                                                        <button type="button" data-type="confirm" class="btn btn-danger js-sweetalert" title="Cancel" data-target="#decline-record--><?//=$id; ?><!--" data-toggle="modal"><i class="fa fa-stop-circle-o"></i></button>-->
                                                        <button type="button" class="btn btn-success mr-3" title="Approve" data-target="#approve-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-check"></i></button>
                                                        <button type="button" class="btn btn-warning mr-3" title="View Proof" data-target="#terms-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-eye"></i></button>
                                                    <?php endif; ?>
                                                    <?php if($r['status'] == 'Paid'): ?>
                                                        <button type="button" class="btn btn-info mr-3" title="Edit" data-target="#delivery-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-bug"></i></button>
                                                    <?php endif; ?>
                                                    <?php if($r['status'] == 'Delivery'): ?>
                                                        <button type="button" class="btn btn-info mr-3" title="Edit" data-target="#claim-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-bug"></i></button>
                                                    <?php endif; ?>
                                                    <?php if($r['status'] == 'Pending'): ?>
<!--                                                        <button type="button" class="btn btn-success mr-3" title="Approve" data-target="#approve-record--><?//=$id; ?><!--" data-toggle="modal"><i class="fa fa-check"></i></button>-->
<!--                                                        <button type="button" class="btn btn-warning mr-3" title="View Proof" data-target="#terms-record--><?//=$id; ?><!--" data-toggle="modal"><i class="fa fa-eye"></i></button>-->
<!--                                                    <button type="button" data-type="confirm" class="btn btn-danger js-sweetalert" title="Cancel" data-target="#decline-record-->
                                                        <button type="button" data-type="confirm" class="btn btn-danger js-sweetalert" title="Cancel" data-target="#decline-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-stop-circle-o"></i></button>

                                                    <?php endif; ?>
                                                </td>
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
    <a href="" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" data-title="Add" data-target="#create-record" data-toggle="modal">
        <span class="pmd-floating-hidden">Primary</span>
        <i class="fa fa-plus"></i>
    </a>
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
        <div class="modal fade" id="terms-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Here are the uploaded Terms & Proof of Payment</h4>
                        </div>
                        <div class="modal-body">
<!--                            --><?php //echo $r['reservation_proof']; ?>
                            <input type="text" name="contact" value="<?= $r['contact']; ?>" />
                            <input type="text" name="email" value="<?= $r['email']; ?>" />
                            <div class="row">
                                <div class="col-md-12 offset-3">
                                    <label style="text-align: center">Proof of Payment</label>
                                    <br />
                                    <img src="<?= $r["reservation_proof"]; ?>" style="max-height: 250px; max-width: 250px" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 offset-2">
                                    <a href="<?= $r['terms']; ?>" class="btn btn-warning"><i class="fa fa-download"></i> Download Terms & Agreement Copy </a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
<!--                            <button type="submit" class="btn btn-primary" name="approve">YES</button>-->
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
        <div class="modal fade" id="decline-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Decline this order?</h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to decline this order?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" name="decline">YES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }} ?>

<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_products ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $r['id'];
        ?>
        <!--modal-->
        <div class="modal fade" id="edit-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Edit this record?</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" required name="name" value="<?= $r['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" required name="category">
                                    <option value="<?= $r['category']; ?>"><?= $r['category']; ?></option>
                                    <?php
                                    $xid = $_SESSION['id'];
                                    $value2 = custom_query("SELECT * FROM tbl_category ORDER BY id DESC");
                                    if($value2->rowCount()>0)
                                    {
                                        while($row2=$value2->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $id = $row2['id'];
                                            ?>
                                            <option value="<?= $row2['title']; ?>"><?= $row2['title']; ?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="type">
                                    <option value="<?= $r['type']; ?>"><?= $r['type']; ?></option>
                                    <?php
                                    $xid = $_SESSION['id'];
                                    $value1 = custom_query("SELECT * FROM tbl_types ORDER BY id DESC");
                                    if($value1->rowCount()>0)
                                    {
                                        while($row1=$value1->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $id = $row1['id'];
                                            ?>
                                            <option value="<?= $row1['title']; ?>"><?= $row1['title']; ?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="<?= $r['price']; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="<?= $r['quantity']; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control"><?= $r['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary" name="edit">SAVE CHANGES</button>
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