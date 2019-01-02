<?php

/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/24/2018
 * Time: 12:02 PM
 */


include '../controller/action.php';

if(isset($_POST['register'])){


    $filetmp = $_FILES["prod_image"]["tmp_name"];
    $filename = $_FILES["prod_image"]["name"];
    $filepath = $_FILES["prod_image"]["type"];
    $prod  = "../uploads/".$filename;
    move_uploaded_file($filetmp,$prod);


    foreach ($_POST['type'] as $type){
      $type_data = $type . "";
        foreach ($_POST['color'] as $colors) {
            $colors = $colors . "";

            $data = array(
                "prod_id" => $_POST['product'],
                "prod_img" => $prod,
                "prod_type" => $type_data,
                "prod_color" => $colors,
                "prod_width" => $_POST['width'],
                "prod_height" => $_POST['height'],
                "prod_length" => $_POST['length'],
                "prod_price_range" => $_POST['price_range'],
                "status" => "Active",
                "frm"=>"Admin"
            );

//    print_r($data);
            $insert = db_insert('tbl_design_existing', $data);
        }
    }

    if(isset($insert)){
        $_SESSION['toastr'] = array(
            'type'=>'success',
            'message'=>'Design Added Successfully',
            'title'=>'Congratulations'
        );
    }
    else{
        $error[] = '';
    }

//    redirect($_SERVER['PHP_SELF']);
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
    <link rel="stylesheet" href="../assets/vendor/dropify/css/dropify.min.css">
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
                            <li class="breadcrumb-item active">Create New Design from Existing Product</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Create New From Existing Product</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" method="POST" enctype="multipart/form-data" novalidate>
                                <div class="form-group">
                                    <label>Choose Product</label>
                                    <select name="product" class="form-control">
                                        <?php
                                        $xid = $_SESSION['id'];
                                        $value1 = custom_query("SELECT * FROM tbl_products ORDER BY id DESC");
                                        if($value1->rowCount()>0)
                                        {
                                            while($row1=$value1->fetch(PDO::FETCH_ASSOC))
                                            {
                                                $id = $row1['id'];
                                                ?>
                                                <option value="<?= $row1['prod_id']; ?>"> <?= $row1['name']; ?></option>
                                            <?php }} ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5>Design Image</h5>
                                    <div class="card">
                                        <div class="body">
                                            <input type="file" class="dropify" name="prod_image">
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <h5>Specifications</h5>
                                <br />
                                <div class="form-group">
                                    <label>Colors</label>
                                    <br />
                                    <select id="multiselect2" name="color[]" class="multiselect multiselect-custom" multiple>
<!--                                        <option value="Beech">Beech</option>-->
                                        <option value="Black">Black</option>
                                        <option value="Walnut">Walnut</option>
                                        <option value="Wicker">Wicker</option>
                                        <option value="Natural">Natural</option>
<!--                                        <option value="Cognac">Cognac</option>-->
<!--                                        <option value="Honey">Honey</option>-->
<!--                                        <option value="Mahogany">Mahogany</option>-->
<!--                                        <option value="Rosewood">Rosewood</option>-->
<!--                                        <option value="Silver">Silver</option>-->
<!--                                        <option value="Tea">Tea</option>-->
<!--                                        <option value="Tobacco">Tobacco</option>-->
<!--                                        <option value="Wheat">Wheat</option>-->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Material Type</label>
                                    <br />
                                    <select id="multiselect2" name="type[]" class="multiselect multiselect-custom" multiple>
                                        <?php
                                        $xid = $_SESSION['id'];
                                        $value2 = custom_query("SELECT * FROM tbl_types ORDER BY id DESC");
                                        if($value2->rowCount()>0)
                                        {
                                            while($row2=$value2->fetch(PDO::FETCH_ASSOC))
                                            {
                                                $id = $row2['id'];
                                                ?>
                                                <option value="<?= $row2['title']; ?>"> <?= $row2['title']; ?></option>
                                            <?php }} ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Width </label>
                                    <input type="number" class="form-control" name="width" />
                                </div>
                                <div class="form-group">
                                    <label>Length</label>
                                    <input type="number" class="form-control" name="length" />
                                </div>
                                <div class="form-group">
                                    <label>Height</label>
                                    <input type="number" class="form-control" name="height" />
                                </div>
                                <div class="form-group">
                                    <label>Price Range</label>
                                    <input type="number" class="form-control" name="price_range" />
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" name="register">Create Design</button>
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
<!-- Javascript -->
<script src="../assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="../assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="../assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="../assets/vendor/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="../assets/vendor/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js -->
<script src="../assets/vendor/toastr/toastr.js"></script>
<script src="../assets/vendor/parsleyjs/js/parsley.min.js"></script>
<script src="../assets/vendor/dropify/js/dropify.min.js"></script>
<script src="../assets/vendor/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js -->


<script src="../assets/js/pages/forms/form-wizard.js"></script>

<script src="../assets/js/pages/forms/dropify.js"></script>
<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script src="../assets/js/pages/forms/advanced-form-elements.js"></script>


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

<script>
    function productFunction() {
        $('#modal-content').modal({
            show: true
        });
    }
</script>

</body>

</html>

