<?php include 'controller/action.php'; ?>

<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/benco-v3/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jul 2018 06:22:54 GMT -->
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
                            <div class="col-xl-3 col-lg-3 col-md-12 col-12">
                                <div class="row_products_side">
                                    <div class="product_left_sidbar">

                                        <div class="product-filter  mb-30">
                                            <h5> Product Categories </h5>
                                            <ul class="product-categories">
                                                <?php

                                                $value = custom_query("SELECT * FROM tbl_category ORDER BY id DESC");
                                                if($value->rowCount()>0)
                                                {
                                                while($r=$value->fetch(PDO::FETCH_ASSOC))
                                                {
                                                $id = $r['id'];
                                                ?>
                                                <li class="cat-item">
                                                    <a href="shop.php?category=<?= $r['title']; ?>"><?= $r['title']; ?></a>
                                                    <span class="count"><?= db_count_where('tbl_products', $where = array("category"=>$r['title'])); ?></span>
                                                </li>
                                                <?php }} else { echo "No Category"; } ?>
                                            </ul>
                                        </div>
                                        <div class="product-filter  mb-30">
                                            <h5> Product Types </h5>
                                            <ul class="product-categories">
                                                <?php

                                                $value = custom_query("SELECT * FROM tbl_types ORDER BY id DESC");
                                                if($value->rowCount()>0)
                                                {
                                                    while($r=$value->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                        $id = $r['id'];
                                                        ?>
                                                        <li class="cat-item">
                                                            <a href="shop.php?type=<?= $r['title']; ?>"><?= $r['title']; ?></a>
                                                            <span class="count"><?= db_count_where('tbl_products', $where = array("type"=>$r['title'])); ?></span>
                                                        </li>
                                                    <?php }} else { echo "No Product Types"; } ?>
                                            </ul>
                                        </div>
                                        <div class="product-filter mb-30">
                                            <h5>Top Ordered Products</h5>
                                            <ul class="product_list_widget">
                                                <?php

                                                $value = custom_query("SELECT * FROM tbl_products WHERE featured = '0' ORDER BY id DESC");
                                                if($value->rowCount()>0)
                                                {
                                                while($r=$value->fetch(PDO::FETCH_ASSOC))
                                                {
                                                $id = $r['id'];

                                                $img = substr($r['prod_img'], 3);
                                                ?>
                                                <li>

                                                    <div class="product-image">
                                                        <a title="Phasellus vel hendrerit" href="#">
                                                            <img alt="" src="<?= $img ?>" style="max-width: 90px; max-height: 180px">
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <a title="Phasellus vel hendrerit" href="#">
                                                            <span class="product-title"><?= $r['name']; ?></span>
                                                        </a>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">₱</span><?= number_format($r['price']); ?></span>
                                                    </div>
                                                </li>
                                                <?php }} else { echo "No Top Rated Products"; } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-xl-9 col-lg-9 col-md-12 col-12">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12 ">
                                        <div class="shop_top_banner">
                                            <img src="assets/img/asd.jpg" alt="" style="max-height: 500px; max-width: 1000px; width: auto; height: auto;">
                                        </div>
                                        <div class="tolbar__area">
                                            <div class="toolbar clearfix">
                                                <div class="toolbar-inner">

                                                    <div class="shop-tab view-mode nav" role=tablist>
<!--                                                        <a class="active" href="#product-grid" data-toggle="tab" role="tab" aria-selected="false">-->
<!--                                                            <i class="ion-grid"></i>-->
<!--                                                        </a>-->
<!--                                                        <a href="#product-list" data-toggle="tab" role="tab" aria-selected="true">-->
<!--                                                            <i class="ion-navicon"></i>-->
<!--                                                        </a>-->
                                                    </div>
<!--                                                    <p class="woocommerce-result-count">-->
<!--                                                        Showing 1&ndash;20 of 52 results-->
<!--                                                    </p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="shop-product-content tab-content">
                                    <div id="product-grid" class="tab-pane fade active show">
                                        <div class="row">
                                            <?php
                                            if(isset($_GET['category'])){
                                                $cat = $_GET['category'];
                                                $value = custom_query("SELECT * FROM tbl_products WHERE category = '$cat' ORDER BY id DESC");
                                            }
                                            else if(isset($_GET['type'])){
                                                $type = $_GET['type'];
                                                $value = custom_query("SELECT * FROM tbl_products WHERE type = '$type' ORDER BY id DESC");
                                            }
                                            else{
                                                $value = custom_query("SELECT * FROM tbl_products ORDER BY id DESC");
                                            }
                                            if($value->rowCount()>0)
                                            {
                                            while($r=$value->fetch(PDO::FETCH_ASSOC))
                                            {
                                            $id = $r['id'];

                                            $img = substr($r['prod_img'], 3);
                                            ?>
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="product-wrapper mb-60">
                                                    <div class="product-img" align="center">
                                                        <a href="">
                                                            <img alt="" src="<?= $img ; ?>" class="img-thumbnail" style="max-height: 180px; max-width: 180px; width: auto; height: auto;" align="center">
                                                        </a>
                                                        <div class="product-action-2">
                                                            <a href="#" title="Quick View" data-target="#exampleModal<?= $id; ?>" data-toggle="modal" class="action-plus-2 tooltip">
                                                                <i class="zmdi zmdi-search"></i>
                                                            </a>
                                                            <a href="shopping-action.php?addCart=1&name=<?= $r['name']; ?>&qty=1&img=<?= $r['prod_img']; ?>&price=<?= $r['price']; ?>&color=<?= $r['color']; ?>&wood_type=<?= $r['type']; ?>" title="Add To Cart"  class="action-plus-2 tooltip">
                                                                <i class="zmdi zmdi-shopping-cart-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-content text-center">
                                                        <h4>
                                                            <a href=""><?= $r['name']; ?></a>
                                                        </h4>
                                                        <div class="product-price-2">
                                                            <div class="price-box">
                                                                <ins>
                                                                    <span class="amount">
                                                                        <span class="Price-currencySymbol">₱ </span><?= number_format($r['price']); ?></span>
                                                                </ins>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }} ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <?php

        $value = custom_query("SELECT * FROM tbl_products ORDER BY id DESC");
        if($value->rowCount()>0)
        {
        while($r=$value->fetch(PDO::FETCH_ASSOC))
        {
        $id = $r['id'];
        $prod_id = $r['prod_id'];
        $name = $r['name'];
        $img = substr($r['prod_img'], 3);
        ?>
        <div class="modal fade" id="exampleModal<?= $id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="shopping-action.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="qwick-view-left">
                                <div class="quick-view-learg-img">
                                    <div class="quick-view-tab-content tab-content">
                                        <div class="tab-pane active show fade" id="modal1" role="tabpanel" align="center">
                                            <img src="<?= $img; ?>" alt="" class="img-thumbnail" style="max-height: 350px; max-width: 350px; width: auto; height: auto;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <br /><br />
                                        <h5 style="text-align: center">User Comments</h5>
                                        <?php

                                        $value3 = custom_query("SELECT * FROM tbl_rating WHERE prod_id = '$name' ORDER BY id DESC LIMIT 5");
                                        if($value3->rowCount()>0)
                                        {
                                            while($r3=$value3->fetch(PDO::FETCH_ASSOC))
                                            {
                                                ?>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p><?= $r3['comment']; ?></p>
                                                    </div>
                                                </div>
                                            <?php }} ?>
                                    </div>
                                </div>

                            </div>
                            <div class="qwick-view-right">
                                <div class="qwick-view-content">
                                    <h3><?= $r['name']; ?></h3>
                                    <?php

                                    $value1 = custom_query("SELECT sum(rating) as rate FROM tbl_rating WHERE prod_id = '$name' ORDER BY id DESC");
                                    if($value1->rowCount()>0)
                                    {
                                        while($r1=$value1->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $value2 = custom_query("SELECT COUNT(prod_id) as prod_count FROM tbl_rating WHERE prod_id = '$name' ORDER BY id DESC");
                                            if($value2->rowCount()>0)
                                            {
                                                while($r2=$value2->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    $rate = round($r1['rate'] / max($r2['prod_count'], 1));

                                                    ?>

                                                <?php }}}} ?>
                                    <br />
                                    <span class="rating" rating="<?= $rate; ?>">
                                            <span class="star "></span>
                                            <span class="star "></span>
                                            <span class="star"></span>
                                            <span class="star"></span>
                                            <span class="star"></span>
                                </span>
                                    <div class="price">
                                        <span class="new">₱ <?= number_format($r['price']); ?> </span>
                                    </div>
                                    <p><?= $r['description']; ?></p>
                                    <div class="quick-view-select">
                                        <div class="select-option-part">
                                            <label>Category</label>
                                            <p class="text-black"><?= nl2br($r['category']); ?></p>
                                        </div>
                                        <div class="select-option-part">
                                            <label>Type</label>
                                            <p class="text-black"><?= $r['type']; ?></p>
                                        </div>
                                    </div>
                                    <div class="quickview-plus-minus">
                                        <div class="cart-plus-minus">
                                            <input type="text" value="1" name="qty" class="cart-plus-minus-box">
                                        </div>
                                        <div class="quickview-btn-cart">
                                            <button class="btn-style cr-btn" name="cart" type="submit">
                                                <span style="color: white">add to cart</span>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="name" value="<?= $r['name']; ?>" />
                                    <input type="hidden" name="img" value="<?= $r['prod_img']; ?>" />
                                    <input type="hidden" name="price" value="<?= $r['price']; ?>" />
                                    <input type="hidden" name="color" value="<?= $r['color']; ?>" />
                                    <input type="hidden" name="wood_type" value="<?= $r['type']; ?>" />
                                    <input type="hidden" name="cartPost" />
                                    <input type="hidden" name="addCart" value="1" />

                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
        <?php }} ?>
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
            $('.rating').each(function (event) {

                var rating = $(this).attr('rating');
                var i;
                for(i = 0; (i < rating); i++)
                {
                    $(this).find('span.star').eq(i).addClass('filled');
                }
                if(rating % 1>0)
                    $(this).find('span.star').eq(i-1).addClass('half-filled');
            });

            setInterval(function () {
                $('#check').load('book-check.php')
            }, 2000);
        });
    </script>
</body>


<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/benco-v3/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Jul 2018 06:22:58 GMT -->
</html>