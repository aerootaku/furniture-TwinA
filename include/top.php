<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/25/2018
 * Time: 12:20 AM
 */ ?>
<header>
    <div class="header-topbar header-topbar-style-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="header-top-left">
                        <ul>
                            <li>Hotline: <?= cms('contact'); ?>

                            </li>
                            <li>
                                Welcome to TwinA Furniture Shop
                            </li>
                            <li>
                                <a href="" data-toggle="modal" data-target="#terms">Terms & Agreement</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6  col-xs-12 ">
                    <div class="header-top-right">
                        <ul>
                            <li>
                                <div class="switcher menu_page my_acc">

                                    <ul>
                                        <?php if (isset($_SESSION['id'])){ ?>
                                            <li class="switcher-menu-active">
                                                <a href="#">My Account:</a>
                                                <ul class="switcher__menus">
                                                    <li class="switcher-menu-item">
                                                        <a href="client/index.php">Profile</a>
                                                    </li>
                                                    <li class="switcher-menu-item">
                                                        <a href="client/pending-order.php">Orders</a>
                                                    </li>
                                                    <li class="switcher-menu-item">
                                                        <a href="designer.php">Create Design</a>
                                                    </li>
                                                </ul>
                                            </li>

                                        <?php } else{ ?>
                                            <li class="switcher-menu-active">
                                                <a href="#">My Account:</a>
                                                <ul class="switcher__menus">
                                                    <li class="switcher-menu-item">
                                                        <a href="login.php">Login</a>
                                                    </li>
                                                    <li class="switcher-menu-item">
                                                        <a href="register.php">Register</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header_area hdr_1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-xs-12">
                    <div class="logo_area">
                        <a href="index.php">
                            <img src="shop/assets/img/logo/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="main_menu_area">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="active"><a href="index.php">Home</a>
                                    </li>

                                    <li><a href="shop.php">Shop</a></li>
                                    <li><a href="designer.php">Designer</a></li>


                                    <li><a href="contact.php">Contact us</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="header-site-icon">
                        <?php
                        if(isset($_SESSION['id'])){


                        $value = custom_query("SELECT user_id, status FROM tbl_cart WHERE status = 'Pending'");
                        if($value->rowCount()>0)
                        {


                            ?>
                            <div class="header-cart same-style">
                                <div class="sidebar-trigger">
                                    <ul>
                                        <li>
                                            <a href="cart.php">
                                                <i class="zmdi zmdi-shopping-cart-plus"></i>
                                                <span class="count-style"><?= db_count_where('tbl_cart', $data = array("user_id"=>$_SESSION['id'], "status"=>"Pending" )); ?></span>
                                            </a>

                                            <ul class="ht-dropdown main-cart-box">
                                                <li>

                                                </li>
                                                <li>
                                                    <?php
                                                    $xid = $_SESSION['id'];
                                                    $value = custom_query("SELECT * FROM tbl_cart WHERE user_id = '$xid' and status = 'Pending' ORDER BY id DESC");
                                                    if($value->rowCount()>0)
                                                    {
                                                        while($r=$value->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                            $id = $r['id'];
                                                            ?>
                                                            <div class="single-cart-box">
                                                                <div class="cart-img">
                                                                    <a href="#">

                                                                        <img alt="cart-image" src="<?= $img = substr($r['product_image'], 3); ?>">
                                                                    </a>
                                                                </div>
                                                                <div class="cart-content">
                                                                    <h6>
                                                                        <a href=""><?= $r['name']; ?></a>

                                                                    </h6>
                                                                    <span class="quantitys">Qty: <?= number_format($r['qty']); ?></span>
                                                                    <span>₱ <?= number_format($r['price'] * $r['qty']); ?></span>
                                                                </div>
                                                                <a href="shopping-action.php?id=<?= $id; ?>" class="del-icone">
                                                                    <i class="zmdi zmdi-close"></i>
                                                                </a>
                                                            </div>
                                                        <?php }}?>
                                                    <div class="cart-footer fix">
                                                        <h5>Subtotal :
                                                            <?php
                                                            $value1 = custom_query("SELECT * FROM tbl_cart WHERE user_id = '$xid' and status = 'Pending' ORDER BY id DESC");
                                                            if($value1->rowCount()>0) {
                                                                while ($r1 = $value1->fetch(PDO::FETCH_ASSOC)) {
                                                                    $id = $r1['id'];
                                                                    $total[] = $r1['price'] * $r1['qty'];
                                                                    ?>
                                                                <?php } ?>
                                                                    <span class="f-right">₱ <?= number_format(array_sum($total)); ?></span>
                                                                <?php } ?>

                                                        </h5>
                                                        <div class="cart-actions">
                                                            <a href="cart.php" class="checkout">View cart</a>
                                                            <a href="cart.php" class="checkout">Checkout</a>
                                                        </div>
                                                    </div>

                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        <?php }} ?>

                    </div>
                </div>

                <div class="mobile-menu-area ">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li class="active"><a href="#">home <i class="ion-ios-arrow-down"></i></a>
                                </li>

                                <li><a href="about.php">About us </a></li>

                                <li><a href="shop.php">Shop</a></li>

                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="shopping-action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">

                <div class="modal-body">
                    <center>
                        <img src="agreement.png" />
                    </center>
                </div>

                <div class="modal-footer">
                    <a href="agreement.pdf" class="btn btn-warning">Download Terms & Agreement</a>
                </div>
            </div>
        </form>

    </div>
</div>
