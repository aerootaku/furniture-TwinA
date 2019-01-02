<?php
include 'controller/action.php';

if(isset($_POST['send'])){
    $ors = array(
        "or_no"=> $_POST['or_no'],
        "product_id"=>$_POST['prod_id'],
        "user_id"=>$_SESSION['id'],
        "prod_name"=>$_POST['prod_name'],
        "prod_price"=>$_POST['prod_price'],
        "or_type"=>"mto",
        "status"=>"Pending",
        "prod_type"=>$_POST['prod_type'],
        "prod_color"=>$_POST['prod_color'],
        "prod_qty"=>$_POST['prod_qty'],
        "prod_category"=>$_POST['prod_category'],
        "contact"=>$_SESSION['contact'],
        "email"=>$_SESSION['email']
    );

    $insert = db_insert('tbl_orders', $ors);
    if($insert){
        $msg = "Please go to your Recent Orders under your Dashboard to Check our Terms & Agreement to Process your Order.";
    }
    else {
        $msg = "There was an Error sending your request.";
    }

}

if(isset($_POST['addCart'])){
    $name = "Chair A1 - Dining";
    $qty = $_POST['prod_qty'];
    $img = "../Chairs/DefaultChair.png";
    $price = "1500";

    $url = "shopping-action.php?addCart=1&name=".$name."&qty=".$qty."&img=".$img."&price=".$price."&color=Natural&wood_type=Narra";
    redirect($url);
}


?>

<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TwinA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="shop/assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="shop/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="shop/assets/css/animate.css">
    <link rel="stylesheet" href="shop/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="shop/assets/css/chosen.min.css">
    <link rel="stylesheet" href="shop/assets/css/themify-icons.css">

    <link rel="stylesheet" href="shop/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="shop/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="shop/assets/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="shop/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="shop/assets/css/tippy.css">
    <link rel="stylesheet" href="shop/assets/css/bundle.css">
    <link rel="stylesheet" href="shop/assets/css/style.css">
    <link rel="stylesheet" href="shop/assets/css/responsive.css">
    <script src="shop/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <style>
        .rating {
            unicode-bidi:bidi-override;
            direction:ltr;
            font-size:15px;
            text-align: center;
        }
        .rating span.star {
            font-family:FontAwesome;
            font-weight:normal;
            font-style:normal;
            display:inline-block;
        }
        .rating span.star:hover {
            cursor:pointer;
        }
        .rating span.star:before {
            content:"\f006";
            padding-right:5px;
            color:#999999;
        }

        span.star.filled:before{ color:#e3cf7a; content:"\f005";}

        span.star.half-filled:before{

            content: "\f089";
            color:#e3cf7a;

        }
        span.star.half-filled:after{

            content: "\f006";
            color:#e3cf7a;
            margin-left:-20px;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <!-- header start -->
    <?php include 'include/top.php'; ?>
    <!-- header end -->
    <!-- breadcrumbs area start -->
    <div class="title-breadcrumbs">
        <div class="title-breadcrumbs-inner">
            <div class="container">
                <nav class="woocommerce-breadcrumb">
                    <a href="#">Home</a>
                    <span class="separator">/</span> Shop
                </nav>
            </div>
        </div>
    </div>
    <!-- breadcrumbs area End -->
    <div class="shop-wrapper pt-100 pb-60">
        <div class="container">

            <div class="grid-list-product-wrapper">
                <div class="product-grid product-view">
                    <div class="row">
                        <div class="col-xl-3">
                                <h5> Customization </h5>
                            <?php if(isset($msg)): ?>
                                <div class="alert alert-info">
                                    <p><?= $msg; ?></p>
                                </div>
                            <?php endif; ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="or_no" value="<?= ucfirst(rand_string(10)); ?>" />
                                <input type="hidden" name="prod_id" value="<?= ucfirst(rand_string(10)); ?>" />
                                <input type="hidden" name="prod_price" value="1500" />
                                <input type="hidden" name="prod_type" value="Dining Chair" />
                                <input type="hidden" name="prod_color" value="Natural" />
                                <input type="hidden" name="wood_type" value="Narra" />
                                <input type="hidden" name="prod_category" value="Chair" />
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" value="Chair A1 - Dining" class="form-control" name="prod_name" readonly>
                                </div>
<!--                                <br />-->
<!--                                <div class="form-group">-->
<!--                                    <label>Category</label>-->
<!--                                    <br />-->
<!--                                    <select name="prod_category" class="form-control" >-->
<!--                                        <option value="Chair" selected>Chair</option>-->
<!--                                    </select>-->
<!--                                </div>-->

                                <br /><br />
                                <div class="form-group">
                                    <label>Back Design</label>
                                    <br />
                                    <select name="back" class="form-control" id="back" style="width: 100%">
                                        <option value="back1">Back Design A</option>
                                        <option value="back2">Back Design B</option>
                                        <option value="back3">Back Design C</option>
                                        <option value="back4">Back Design D</option>
                                    </select>
                                </div>
                                <br /><br />
                                <div class="form-group">
                                    <label>Feet Design</label>
                                    <br />
                                    <select name="feet" class="form-control" id="feet">
                                        <option value="feet1">Feet Design A</option>
                                        <option value="feet2">Feet Design B</option>
                                        <option value="feet3">Feet Design C</option>
                                    </select>
                                </div>
                                <br /><br />
                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-warning" type="button" id="generate">Generate</button>
                                    </center>
                                </div>
                                <div class="form-group">
                                    <p id="dimension"></p>
                                </div>
                                <div class="form-group">
                                    <p>Price: ₱ <?= number_format("1500"); ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" name="prod_qty" required />
                                </div>
                                <div class="form-group">
                                    <?php if(isset($_SESSION['id'])){ ?>
<!--                                    <button type="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="#terms">Send Customization</button>-->
                                        <button type="submit" class="btn btn-outline-danger" name="addCart">Add to Cart</button>
                                    <?php } ?>
                                    <?php if(!isset($_SESSION['id'])): ?>
                                    <p>Please Login First to send your Customization</p>
                                    <?php endif; ?>
                                </div>
                            </form>

                        </div>

                        <div class=" col-xl-9 col-lg-9 col-md-12 col-12">

                            <div class="shop-product-content tab-content">
                                <div id="product-grid" class="tab-pane fade active show">
                                    <div class="row">
                                        <h3>Customized Image</h3>
                                        <div id="Customimg"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <footer>
        <div class="footer-container">
            <!--Footer Top Area Start-->
            <div class="footer-top-area styles___1 ptb-90 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-12">
                            <!--Footer Logo Start-->
                            <div class="footer-logo">
                                <a href="index.php">
                                    <img alt="" src="shop/assets/img/logo/logo.png">
                                </a>
                            </div>
                            <!--Footer Logo End-->

                            <!--Footer Newsletter End-->
                        </div>
                    </div>
                </div>
            </div>

            <!--Footer Top Area End-->
            <!--Footer Bottom Area Start-->
            <div class="footer-bottom-area">
                <div class="container text-center">
                    <p>&copy; Copyright TwinA All Rights Reserved</p>
                </div>
            </div>
            <!--Footer Bottom Area End-->
        </div>
    </footer>
    <!-- modal -->

</div>


<!-- all js here -->
<script src="shop/assets/js/vendor/jquery-1.12.0.min.js"></script>
<script src="shop/assets/js/popper.js"></script>
<script src="shop/assets/js/bootstrap.min.js"></script>
<script src="shop/assets/js/isotope.pkgd.min.js"></script>
<script src="shop/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="shop/assets/js/jquery.counterup.min.js"></script>
<script src="shop/assets/js/waypoints.min.js"></script>
<script src="shop/assets/js/ajax-mail.js"></script>
<script src="shop/assets/js/owl.carousel.min.js"></script>
<script src="shop/assets/js/plugins.js"></script>
<script src="shop/assets/js/main.js"></script>
<script>
    $(document).ready(function() {
        $("#Customimg").html("<img src='Chairs/DefaultChair.png' style='max-width: 1000px'/>");
        $("#generate").on("click", function (e) {
            e.preventDefault();
            var back = $("#back").val();
            var feet = $("#feet").val();

            if(back == 'back1' && feet == 'feet1'){
                $("#Customimg").html("<img src='Chairs/Chi1Feet1.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back1' && feet == 'feet2'){
                $("#Customimg").html("<img src='Chairs/Chi1Feet2.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back1' && feet == 'feet3'){
                $("#Customimg").html("<img src='Chairs/Chi1Feet3.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back2' && feet == 'feet1'){
                $("#Customimg").html("<img src='Chairs/Chi2Feet1.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back2' && feet == 'feet2'){
                $("#Customimg").html("<img src='Chairs/Chi2Feet2.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back2' && feet == 'feet3'){
                $("#Customimg").html("<img src='Chairs/Chi2Feet3.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back3' && feet == 'feet1'){
                $("#Customimg").html("<img src='Chairs/Chi3Feet1.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back3' && feet == 'feet2'){
                $("#Customimg").html("<img src='Chairs/Chi3Feet2.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back3' && feet == 'feet3'){
                $("#Customimg").html("<img src='Chairs/Chi3Feet3.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back4' && feet == 'feet1'){
                $("#Customimg").html("<img src='Chairs/ChiDefaultFeet1.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back4' && feet == 'feet2'){
                $("#Customimg").html("<img src='Chairs/ChiDefaultFeet2.png' style='max-width: 1000px'/>");
            }
            else if(back == 'back4' && feet == 'feet3'){
                $("#Customimg").html("<img src='Chairs/ChiDefaultFeet3.png' style='max-width: 1000px'/>");
            }
            $("#dimension").html('Dimension: L79.2 x W50.9 x H35.43');
        })
//        $('#type').on('change', function () {
//            var type = $("#type").val();
//            $("#color").on("change", function () {
//               var color = $("#color").val();
//               if(type == 'Nara' && color == 'Natural'){
//                   $("#Customimg").html("<img src='furniture-design/naram-natural.png' />");
//               }
//               else if(type == 'Nara' && color == 'Chestnut'){
//                   $("#Customimg").html("<img src='furniture-design/naram-chestnut.png' />");
//               }
//               else if(type == 'Nara' && color == 'Merlot'){
//                   $("#Customimg").html("<img src='furniture-design/naram-merlot.png' />");
//               }
//               else if(type == 'Mahogany' && color == 'Natural'){
//                   $("#Customimg").html("<img src='furniture-design/mahogany-natural.png' />");
//               }
//               else if(type == 'Mahogany' && color == 'Chestnut'){
//                   $("#Customimg").html("<img src='furniture-design/mahogany-chesnut.png' />");
//               }
//               else if(type == 'Mahogany' && color == 'Merlot'){
//                   $("#Customimg").html("<img src='furniture-design/mahogany-merlot.png' />");
//               }
//               else if(type == 'Gemilina' && color == 'Natural'){
//                   $("#Customimg").html("<img src='furniture-design/oak-natural.png' />");
//               }
//               else if(type == 'Gemilina' && color == 'Chestnut'){
//                   $("#Customimg").html("<img src='furniture-design/gemelina-chesnut.png' />");
//               }
//               else if(type == 'Gemilina' && color == 'Merlot'){
//                   $("#Customimg").html("<img src='furniture-design/gemelina-tuscany.png' />");
//               }
//            });
//
//        });
    });
</script>
</body>


<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/benco-v3/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jul 2018 06:22:58 GMT -->
</html>