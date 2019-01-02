<?php
include 'controller/action.php';

?>

<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/benco-v3/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jul 2018 06:23:40 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TwinA | Cart</title>
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
    <link rel="stylesheet" href="shop/assets/css/fontawesome-all.css">
    <link rel="stylesheet" href="shop/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="shop/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="shop/assets/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="shop/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="shop/assets/css/tippy.css">
    <link rel="stylesheet" href="shop/assets/css/bundle.css">
    <link rel="stylesheet" href="shop/assets/css/style.css">
    <link rel="stylesheet" href="shop/assets/css/responsive.css">
    <script src="shop/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include 'include/top.php'; ?>
        <!-- breadcrumbs area End -->
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="pg___title">
                            <h2>Shopping Cart</h2>
                        </div>
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="anadi-product-remove">remove</th>
                                            <th class="anadi-product-thumbnail">images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="anadi-product-price">Unit Price</th>
                                            <th class="anadi-product-quantity">Quantity</th>
                                            <th class="anadi-product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $user_id = $_SESSION['id'];

                                    $value = custom_query("SELECT * FROM tbl_cart WHERE user_id = '$user_id' ORDER BY id DESC");
                                    if($value->rowCount()>0)
                                    {
                                    while($r=$value->fetch(PDO::FETCH_ASSOC))
                                    {
                                    $id = $r['id'];
                                    $total[] = $r['price'] * $r['qty'];
                                    ?>
                                        <tr>
                                            <td class="anadi-product-remove">
                                                <a href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                            <td class="anadi-product-thumbnail">
                                                <a href="#">
<!--                                                    --><?php //echo substr($r['product_image'], 3); ?>
                                                    <img src="<?= substr($r['product_image'], 3); ?>" alt="" style="width: 150px; height: 150px">
                                                </a>
                                            </td>
                                            <td class="anadi-product-name">
                                                <a href="#"><?= $r['name']; ?></a>
                                            </td>
                                            <td class="anadi-product-price">
                                                <span class="amount">₱ <?= number_format($r['price']); ?></span>
                                            </td>
                                            <td class="anadi-product-quantity">
                                                <input value="<?= number_format($r['qty']); ?>" type="number">
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">₱ <?= number_format($r['price'] * $r['qty']); ?></span>
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon2">
                                            <input class="button" name="update_cart" value="Update cart" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart total</h2>
                                        <ul>
                                            <li>Total
                                                <span>₱ <?= number_format(array_sum($total)); ?></span>
                                            </li>
                                        </ul>
                                        <a href="#">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="ion-android-close" aria-hidden="true"></span>
                        </button>
                        <div class="qwick-view-left">
                            <div class="quick-view-learg-img">
                                <div class="quick-view-tab-content tab-content">
                                    <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                        <img src="shop/assets/img/quick-view/l1.jpg" alt="">
                                    </div>
                                    <div class="tab-pane fade" id="modal2" role="tabpanel">
                                        <img src="shop/assets/img/quick-view/l2.jpg" alt="">
                                    </div>
                                    <div class="tab-pane fade" id="modal3" role="tabpanel">
                                        <img src="shop/assets/img/quick-view/l3.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="quick-view-list nav" role="tablist">
                                <a class="active" href="#modal1" data-toggle="tab">
                                    <img src="shop/assets/img/quick-view/s1.jpg" alt="">
                                </a>
                                <a href="#modal2" data-toggle="tab">
                                    <img src="shop/assets/img/quick-view/s2.jpg" alt="">
                                </a>
                                <a href="#modal3" data-toggle="tab">
                                    <img src="shop/assets/img/quick-view/s3.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="qwick-view-right">
                            <div class="qwick-view-content">
                                <h3>Handcrafted Supper Mug</h3>
                                <div class="price">
                                    <span class="new">$90.00</span>
                                    <span class="old">$120.00 </span>
                                </div>
                                <div class="rating-number">
                                    <div class="quick-view-rating">
                                        <i class="ion-ios-star red-star"></i>
                                        <i class="ion-ios-star red-star"></i>
                                        <i class="ion-ios-star red-star"></i>
                                        <i class="ion-ios-star red-star"></i>
                                        <i class="ion-ios-star red-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do tempor incididun ut labore et dolore
                                    magna aliqua. Ut enim ad mi , quis nostrud veniam exercitation .</p>
                                <div class="quick-view-select">
                                    <div class="select-option-part">
                                        <label>Size*</label>
                                        <select class="select">
                                            <option value="">- Please Select -</option>
                                            <option value="">900</option>
                                            <option value="">700</option>
                                        </select>
                                    </div>
                                    <div class="select-option-part">
                                        <label>Color*</label>
                                        <select class="select">
                                            <option value="">- Please Select -</option>
                                            <option value="">orange</option>
                                            <option value="">pink</option>
                                            <option value="">yellow</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="quickview-plus-minus">
                                    <div class="cart-plus-minus">
                                        <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                    </div>
                                    <div class="quickview-btn-cart">
                                        <a class="btn-style cr-btn" href="#">
                                            <span>add to cart</span>
                                        </a>
                                    </div>
                                    <div class="quickview-btn-wishlist">
                                        <a class="btn-hover cr-btn" href="#">
                                            <span>
                                                <i class="ion-ios-heart-outline"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>