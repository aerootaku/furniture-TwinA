<?php
include 'controller/action.php';
?>
<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/benco-v3/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jul 2018 06:24:16 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact Us - TwinA</title>
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
        <!-- header start -->
       <?php include 'include/top.php'; ?>
        <!-- header end -->
        <!-- breadcrumbs area start -->
        <div class="title-breadcrumbs">
        </div>
        <!-- breadcrumbs area End --
        <!-- Contact page content -->
        <div class="contact-page-area ">
            <!-- contact form area -->
            <div class="contact-form-area pt-100 pb-65">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-form-inner">
                                <h2>tell us your Furniture Design</h2>
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="First name*">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Last name*">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Email*">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Subject*">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true"
                                                aria-invalid="false" placeholder="Message *"></textarea>
                                        </div>
                                    </div>
                                    <div class="contact-submit">
                                        <input type="submit" value="Send Email" class="wpcf7-form-control wpcf7-submit button">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-address-area">
                                <h2>CONTACT US</h2>
                                <p>Send us your furniture idea and we will build it for you!</p>
                                <ul>
                                    <li>
                                        <i class="fa fa-fax">&nbsp;</i> Address : <?= cms('address'); ?></li>
                                    <li>
                                        <i class="fa fa-phone">&nbsp;</i> <?= cms('email'); ?></li>
                                    <li>
                                        <i class="far fa-envelope">&nbsp;</i><?= cms('contact'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contact form area end -->
        </div>
        <!-- Contact page content end -->
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

                                <!--Footer Newsletter Start-->
                                <div class="footer-newsletter">
                                    <!-- Newsletter Form -->
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
                        <p>&copy; Copyright TwinA All Rights Reserved</p>
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
    <!-- google map js -->
    <script src="shop/assets/js/main.js"></script>
</body>


<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/benco-v3/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jul 2018 06:24:16 GMT -->
</html>