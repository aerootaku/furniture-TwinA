<?php

/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/24/2018
 * Time: 12:02 PM
 */


include '../controller/action.php';

if(isset($_POST['updateCMS'])){

        $_SESSION['success'] = "TRUE";
        $data = array(
                "app_name"=>$_POST['app_name'],
            "contact"=>$_POST['contact'],
            "email"=>$_POST['email'],
            "address"=>$_POST['address'],
            "about"=>$_POST['about']
        );
        $where = array("id"=>"1");
        $insert = db_update('tbl_cms', $data, $where);

//        redirect('user-create.php');
        if(isset($insert)){
            $_SESSION['toastr'] = array(
                'type'=>'success',
                'message'=>'Content Updated Successfully',
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
    <title>:: TwinA :: CMS</title>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Content Management System</li>
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
                            <!--                            --><?php //echo $_SESSION['success']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Content Management System</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" method="post" novalidate>
                                <?php
                                $xid = $_SESSION['id'];
                                $value = custom_query("SELECT * FROM tbl_cms ORDER BY id DESC");
                                if($value->rowCount()>0)
                                {
                                while($r=$value->fetch(PDO::FETCH_ASSOC))
                                {
                                $id = $r['id'];
                                ?>
                                <div class="form-group">
                                    <label>Website Title</label>
                                    <input type="text" class="form-control" name="app_name" value="<?= $r['app_name']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    <input type="text" class="form-control" name="contact" value="<?= $r['contact']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $r['email']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address" rows="4"><?= $r['address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>About us</label>
                                    <textarea class="form-control" name="about" rows="4"><?= $r['about']; ?></textarea>
                                </div>
                                <?php }} ?>
                                <br>
                                <button type="submit" class="btn btn-primary" name="updateCMS">Update Website Content</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

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

<script src="../assets/vendor/parsleyjs/js/parsley.min.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();
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
        toastr['success']('<?php echo $_SESSION['toastr']['message']; ?>');
        <?php  unset($_SESSION['toastr']); ?>
    </script>
    <?php
} ?>

<script src="../assets/js/pages/forms/advanced-form-elements.js"></script>
</body>

</html>

