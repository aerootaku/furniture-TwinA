<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/25/2018
 * Time: 9:01 AM
 */ ?>

<?php

include '../controller/action.php';

if(isset($_POST['ratingSubmit'])){
    $data = array(
            "prod_id"=>$_GET['id'],
        "rating"=>$_POST['rating'],
        "comment"=>$_POST['comment']
    );

    $insert = db_insert('tbl_rating', $data);
    $where = array(
        "rating_status" => "0"
    );
    $edit = db_update('tbl_orders', $where, $id = array("product_id" => $_GET['id']));
    if(isset($insert)){

        $_SESSION['toastr'] = array(
            'type'=>'success',
            'message'=>'Order rated Successfully',
            'title'=>'Congratulations'
        );
        redirect('pending-order.php');
        exit();
    }
    else{
        $error[] = '';
    }

}

if(isset($_POST['cancel'])){
    $id = array("id"=>$_GET['id']);
    $data = array(
            "status"=>"Cancelled"
    );
    $edit = db_update('tbl_orders', $data, $id = array("id"=>$_GET['id']));
    if(isset($edit)){

        $_SESSION['toastr'] = array(
            'type'=>'warning',
            'message'=>'Order canceled Successfully',
            'title'=>'Congratulations'
        );
    }
    else{
        $error[] = '';
    }
}

if(isset($_POST['upload'])) {

    $filetmp = $_FILES["proof"]["tmp_name"];
    $filename = $_FILES["proof"]["name"];
    $filepath = $_FILES["proof"]["type"];
    $path  = "../uploads/".$filename;
    move_uploaded_file($filetmp,$path);
    $id = array("id" => $_GET['id']);
    $data = array(
        "payment_proof" =>$path,
        "status" => "Paid"
    );
    $edit = db_update('tbl_orders', $data, $id = array("id" => $_GET['id']));
    if (isset($edit)) {

        $_SESSION['toastr'] = array(
            'type' => 'warning',
            'message' => 'Order Has been Paid Successfully',
            'title' => 'Congratulations'
        );
    } else {
        $error[] = '';
    }
}

if(isset($_POST['uploadAgreement'])) {

    $filetmp = $_FILES["dp"]["tmp_name"];
    $filename = $_FILES["dp"]["name"];
    $filepath = $_FILES["dp"]["type"];
    $path  = "../uploads/".$filename;
    move_uploaded_file($filetmp,$path);

    $filetmp = $_FILES["terms"]["tmp_name"];
    $filename = $_FILES["terms"]["name"];
    $filepath = $_FILES["terms"]["type"];
    $terms  = "../uploads/".$filename;
    move_uploaded_file($filetmp,$terms);

    $id = array("id" => $_GET['id']);
    $data = array(
        "reservation_proof" =>$path,
        "terms"=>$terms,
        "status"=>"Processing"
    );
    $edit = db_update('tbl_orders', $data, $id = array("id" => $_GET['id']));
    if (isset($edit)) {

        $_SESSION['toastr'] = array(
            'type' => 'warning',
            'message' => 'Agreement and Downpayment is Sent Successfully',
            'title' => 'Congratulations'
        );
    } else {
        $error[] = '';
    }
}

?>

<!doctype html>
<html lang="en">


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
    <style>

        .user-rating {
            direction: rtl;
            font-size: 20px;
            unicode-bidi: bidi-override;
            padding: 10px 30px;
            display: inline-block;
        }
        .user-rating input {
            opacity: 0;
            position: relative;
            left: -15px;
            z-index: 2;
            cursor: pointer;
        }
        .user-rating span.star:before {
            color: #777777;
            content:"ï€†";
            /*padding-right: 5px;*/
        }
        .user-rating span.star {
            display: inline-block;
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            position: relative;
            z-index: 1;
        }
        .user-rating span {
            margin-left: -15px;
        }
        .user-rating span.star:before {
            color: #777777;
            content:"\f006";
            /*padding-right: 5px;*/
        }
        .user-rating input:hover + span.star:before, .user-rating input:hover + span.star ~ span.star:before, .user-rating input:checked + span.star:before, .user-rating input:checked + span.star ~ span.star:before {
            color: #ffd100;
            content:"\f005";
        }

        .selected-rating{
            color: #ffd100;
            font-weight: bold;
            font-size: 3em;
        }

    </style>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Product Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Manage Products</li>
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
                            <h2>Manage Products</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                    <tr>
                                        <!--                                        <th>Thumbnail</th>-->
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
                                    $value = custom_query("SELECT * FROM tbl_orders WHERE user_id = '$xid' and status !='Paid' ORDER BY id DESC LIMIT 5");
                                    if($value->rowCount()>0)
                                    {
                                        while($r=$value->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $id = $r['id'];
                                            ?>
                                            <tr>
                                                <td><?= $r['prod_name']; ?></td>
                                                <td><?= $r['prod_category']; ?></td>
                                                <td><?= $r['prod_type']; ?></td>
                                                <td><?= $r['prod_price']; ?></td>
                                                <td><?= $r['prod_qty']; ?></td>
                                                <td><?= $r['prod_color']; ?></td>
                                                <td><?= $r['or_type']; ?></td>
                                                <td><?= $r['status']; ?></td>
                                                <td>
                                                    <?php if($r['status'] == 'Accepted'): ?>
                                                        <button type="button" data-type="confirm" class="btn btn-info js-sweetalert" title="Cancel" data-target="#upload-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-cloud-upload"></i></button>
                                                    <?php endif; ?>
                                                    <?php if($r['status'] == 'Claimed' && $r['rating_status'] == 1): ?>
                                                        <button type="button" class="btn btn-warning mr-3" title="Edit" data-target="#rate-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-star"></i></button>
                                                    <?php endif; ?>
                                                    <?php if($r['status'] == 'Pending'): ?>
                                                        <button type="button" class="btn btn-warning" title="Upload Payment" data-target="#downpayment-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-money"></i></button>
                                                        <button type="button" class="btn btn-success" title="Terms and Agreement" data-target="#terms-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-file"></i></button>
                                                        <button type="button" data-type="confirm" class="btn btn-danger js-sweetalert" title="Cancel" data-target="#delete-record<?=$id; ?>" data-toggle="modal"><i class="fa fa-times"></i></button>
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
                            <h4 class="title" id="defaultModalLabel">Terms & Agreement</h4>
                        </div>
                        <div class="modal-body">
                            <img src="terms.png" height="320" width="450" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <a href="../agreement.pdf" class="btn btn-primary" name="cancel">Download Terms</a>
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
        <div class="modal fade" id="downpayment-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Upload Down Payment & Terms & Agreement?</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Payment Proof</label>
                                <input type="file" class="form-control" name="dp" required />
                            </div>
                            <div class="form-group">
                                <label>Terms & Agreement</label>
                                <input type="file" class="form-control" name="terms" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="uploadAgreement">Upload</button>
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
        <div class="modal fade" id="rate-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $r['product_id']; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Rate this item?</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12" align="center">
                                    <Div class="form-group">
                                    <p>Please Rate our Product</p>
                                    <span class="user-rating">
                                        <input type="radio" name="rating" value="5"><span class="star"></span>

                                        <input type="radio" name="rating" value="4"><span class="star"></span>

                                        <input type="radio" name="rating" value="3"><span class="star"></span>

                                        <input type="radio" name="rating" value="2"><span class="star"></span>

                                        <input type="radio" name="rating" value="1"><span class="star"></span>
                                    </span>
                                    </Div>
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea class="form-control" name="comment" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="ratingSubmit">Save</button>
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
        <div class="modal fade" id="delete-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Cancel this order?</h4>
                        </div>
                        <div class="modal-body">Are you sure you want to cancel your order?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn btn-primary" name="cancel">YES</button>
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
        <div class="modal fade" id="upload-record<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?id=<?= $id; ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="title" id="defaultModalLabel">Upload your Second Proof of Payment</h4>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label>Proof of Payment</label>
                                    <input type="file" class="form-control" name="proof" />
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="upload">Submit</button>
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

<!--<script>-->
<!--    $('.rating input').change(function () {-->
<!--        var $radio = $(this);-->
<!--        $('.rating .selected').removeClass('selected');-->
<!--        $radio.closest('label').addClass('selected');-->
<!--    });-->
<!--</script>-->
<script src="../assets/js/pages/forms/advanced-form-elements.js"></script>
<script src="../assets/js/pages/tables/jquery-datatable.js"></script>

</body>

</html>