<?php

/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/24/2018
 * Time: 12:02 PM
 */


include '../controller/action.php';
include  'session.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $filetmp = $_FILES["prod_img"]["tmp_name"];
    $filename = $_FILES["prod_img"]["name"];
    $filepath = $_FILES["prod_img"]["type"];
    $prod_img  = "../uploads/".$filename;
    move_uploaded_file($filetmp,$prod_img);

        if(isExists('tbl_orders', $where = array("or_no"=>$_POST['or_no'])) == 1){
            $error[] = 'This order is already sent to admin. Please wait for the approval';
        }
        else{
            $data = array(
                "prod_id" => $_POST['prod_id'],
                "prod_img" => $prod_img,
                "prod_type" => $_POST['prod_type'],
                "prod_color" => $_POST['prod_color'],
                "prod_width" => $_POST['width'],
                "prod_height" => $_POST['height'],
                "prod_length" => $_POST['length'],
                "prod_price_range" => $_POST['price_range'],
                "frm"=>"User",
                "status" => "Order"
            );

            $ors = array(
                "or_no"=> $_POST['or_no'],
                "product_id"=>$_POST['prod_id'],
                "user_id"=>$_SESSION['id'],
                "prod_name"=>$_POST['prod_name'],
                "prod_img"=>$prod_img,
                "prod_description"=>$_POST['prod_description'],
                "prod_price"=>$_POST['price_range'],
                "or_type"=>"mto",
                "status"=>"Processing",
                "prod_type"=>$_POST['prod_type'],
                "prod_color"=>$_POST['prod_color'],
                "prod_qty"=>$_POST['qty'],
                "prod_category"=>$_POST['prod_category'],
                "remarks"=>$_POST['note']
            );

            $insert = db_insert('tbl_design_existing', $data);

//            print_r($insert);
            if(isset($insert)){

//                print_r($ors);
//                print $inserts;
                $_SESSION['toastr'] = array(
                    'type'=>'success',
                    'message'=>'Thank you for your order. Please wait up to 24hours for the admin(s) approval of your order in your email address',
                    'title'=>'Congratulations'
                );
                $inserts = db_insert('tbl_orders', $ors);
            }
            else{
                $error[] = '';
            }
        }
//    print_r($data);


//    redirect($_SERVER['PHP_SELF']);
//    echo  "Hello world";
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Create your own Design</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" novalidate method="POST" action="" enctype="multipart/form-data">
                                <div id="wizard_horizontal">
                                    <h2>Product Information</h2>
                                    <section>
                                        <input type="hidden" name="prod_id" value="<?= rand_string(10); ?> " />
                                        <input type="hidden" name="or_no" value="<?= rand_string(20) ?> " />
                                        <div class="form-group">
                                            <label>Order Name</label>
                                            <input type="text" class="form-control" name="prod_name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="prod_description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Materials</label>
                                            <select name="prod_type" class="form-control">
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
                                            <label>Category</label>
                                            <select name="prod_category" class="form-control">
                                                <?php
                                                $xid = $_SESSION['id'];
                                                $value2 = custom_query("SELECT * FROM tbl_category ORDER BY id DESC");
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

                                    </section>
                                    <h2>Upload Design Images</h2>
                                    <section>
                                        <div class="form-group">
                                            <h5>Product Image</h5>
                                            <div class="card">
                                                <div class="body">
                                                    <input type="file" class="dropify" name="prod_img">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h2>Design Specification</h2>
                                    <section>
                                        <div class="form-group">
                                            <label>Available Colors</label>
                                            <select name="prod_color" class="form-control" id="colors">
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
                                        <div id="col-result"></div>
                                        <div class="form-group">
                                            <label>Height</label>
                                            <input type="number" name="height" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Width</label>
                                            <input type="number" name="width" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Length</label>
                                            <input type="number" name="length" class="form-control" />
                                        </div>
                                    </section>
                                    <h2>Order</h2>
                                    <section>
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea name="note" class="form-control" rows="5" placeholder="Do you have other things you need to explain? Enter it here"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" name="qty" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Budget</label>
                                            <input type="number" name="price_range" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <span style="font-style: italic">Please be reminded to send your feedback before 5 days to avoid cancellation of your created design or order. </span>
                                        </div>
                                    </section>
                                </div>
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

<script>

    $(function () {
        //Horizontal form basic
        $('#wizard_horizontal').steps({
            headerTag: 'h2',
            bodyTag: 'section',
            transitionEffect: 'slideLeft',
            onInit: function (event, currentIndex) {
                setButtonWavesEffect(event);
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);

            },
            onFinished: function (event, currentIndex) {
                var forms = $("#basic-form");
                forms.submit();
            }
        });

        //Vertical form basic
        $('#wizard_vertical').steps({
            headerTag: 'h2',
            bodyTag: 'section',
            transitionEffect: 'slideLeft',
            stepsOrientation: 'vertical',
            onInit: function (event, currentIndex) {
                setButtonWavesEffect(event);
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);
            }
        });

        //Advanced form with validation
        var form = $('#wizard_with_validation').show();
        form.steps({
            headerTag: 'h3',
            bodyTag: 'fieldset',
            transitionEffect: 'slideLeft',
            onInit: function (event, currentIndex) {
                $.AdminInfiniO.input.activate();

                //Set tab width
                var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
                var tabCount = $tab.length;
                $tab.css('width', (100 / tabCount) + '%');

                //set button waves effect
                setButtonWavesEffect(event);
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                if (currentIndex > newIndex) { return true; }

                if (currentIndex < newIndex) {
                    form.find('.body:eq(' + newIndex + ') label.error').remove();
                    form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                }

                form.validate().settings.ignore = ':disabled,:hidden';
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ':disabled';
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                swal("Good job!", "Submitted!", "success");
            }
        });

        form.validate({
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            rules: {
                'confirm': {
                    equalTo: '#password'
                }
            }
        });
    });
    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
    }
</script>

<!--<script src="../assets/js/pages/forms/form-wizard.js"></script>-->

<script src="../assets/js/pages/forms/dropify.js"></script>
<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script src="../assets/js/pages/forms/advanced-form-elements.js"></script>


<script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();

        $('#colors').on('change', function () {
//            console.log(this.value);
            var col = this.value;
            if(col == 'Black'){
                $("#col-result").append('<img src="black.jpg" />')
            }
            else if(col == 'Walnut'){
                $("#col-result").append('<img src="walnut.jpg" />')
            }
            else if(col == '')
        });
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