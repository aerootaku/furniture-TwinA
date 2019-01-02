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
    );

    $insert = db_insert('tbl_orders', $ors);
    if($insert){
        $msg = "Please go to your Recent Orders under your Dashboard to Check our Terms & Agreement to Process your Order.";
    }
    else {
        $msg = "There was an Error sending your request.";
    }

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
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" value="Chair A1 - Dining" class="form-control" name="prod_name" readonly>
                                </div>
                                <br />
                                <div class="form-group">
                                    <label>Category</label>
                                    <br />
                                    <select name="prod_category" class="form-control" >
                                        <option value="Chair" selected>Chair</option>
                                    </select>
                                </div>
                                <br /><br />
                                <Div class="form-group">
                                    <label>Wood Type</label>
                                    <br />
                                    <select name="wood_type" class="form-control" style="width: 100%" id="type">
                                        <option value="Narra">Narra</option>
                                        <option value="Mahogany">Mahogany</option>
                                        <option value="Gemilina">Gemilina</option>
                                    </select>
                                </Div>
                                <br />
                                <br/>
                                <div class="form-group">
                                    <label>Color</label>
                                    <br />
                                    <select name="prod_color" class="form-control" id="color">
                                        <option value="Natural">Natural</option>
                                        <option value="Chestnut">Chestnut</option>
                                        <option value="Merlot">Merlot</option>
                                    </select>
                                </div>
                                <br />
                                <br />
                                <div class="form-group">
                                    <p>Dimension: L79.2″ x W50.9″ x H35.43″</p>
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
                                    <button type="submit" class="btn btn-outline-danger" name="send">Send Customization</button>
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
                                <a href="index.html">
                                    <img alt="" src="shop/assets/img/logo/logo.png">
                                </a>
                            </div>
                            <!--Footer Logo End-->
                            <!--Footer Nav Start-->
                            <div class="footer-nav">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="#">Home</a>
                                        </li>
                                        <li>
                                            <a href="#">Shop</a>
                                        </li>
                                        <li>
                                            <a href="#">Policies</a>
                                        </li>
                                        <li>
                                            <a href="#">About Us</a>
                                        </li>
                                        <li>
                                            <a href="#">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!--Footer Nav End-->
                            <!--Footer Social Icon Start-->
                            <div class="footer-social">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-rss"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!--Footer Social Icon End-->
                            <!--Footer Newsletter Start-->
                            <div class="footer-newsletter">
                                <!-- Newsletter Form -->
                                <form novalidate="" target="_blank" class="popup-subscribe-form validate" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form"
                                      method="post" action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                                    <div id="mc_embed_signup_scroll">
                                        <div class="mc-form subscribe-form" id="mc-form">
                                            <input type="email" placeholder="Enter your email here" autocomplete="off" id="mc-email">
                                            <button id="mc-submit"> Subscribe! </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--Footer Newsletter End-->
                        </div>
                    </div>
                </div>
            </div>

            <!--Footer Top Area End-->
            <!--Footer Bottom Area Start-->
            <div class="footer-bottom-area">
                <div class="container text-center">
                    <p>&copy; Copyright Banco All Rights Reserved</p>
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
        $("#Customimg").html("<img src='furniture-design/naram-natural.png' />");
        $('#type').on('change', function () {
            var type = $("#type").val();
            $("#color").on("change", function () {
               var color = $("#color").val();
               if(type == 'Nara' && color == 'Natural'){
                   $("#Customimg").html("<img src='furniture-design/naram-natural.png' />");
               }
               else if(type == 'Nara' && color == 'Chestnut'){
                   $("#Customimg").html("<img src='furniture-design/naram-chestnut.png' />");
               }
               else if(type == 'Nara' && color == 'Merlot'){
                   $("#Customimg").html("<img src='furniture-design/naram-merlot.png' />");
               }
               else if(type == 'Mahogany' && color == 'Natural'){
                   $("#Customimg").html("<img src='furniture-design/mahogany-natural.png' />");
               }
               else if(type == 'Mahogany' && color == 'Chestnut'){
                   $("#Customimg").html("<img src='furniture-design/mahogany-chesnut.png' />");
               }
               else if(type == 'Mahogany' && color == 'Merlot'){
                   $("#Customimg").html("<img src='furniture-design/mahogany-merlot.png' />");
               }
               else if(type == 'Gemilina' && color == 'Natural'){
                   $("#Customimg").html("<img src='furniture-design/oak-natural.png' />");
               }
               else if(type == 'Gemilina' && color == 'Chestnut'){
                   $("#Customimg").html("<img src='furniture-design/gemelina-chesnut.png' />");
               }
               else if(type == 'Gemilina' && color == 'Merlot'){
                   $("#Customimg").html("<img src='furniture-design/gemelina-tuscany.png' />");
               }
            });

        });
    });
</script>
</body>


<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/benco-v3/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jul 2018 06:22:58 GMT -->
</html>