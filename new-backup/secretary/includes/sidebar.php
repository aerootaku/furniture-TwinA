<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/24/2018
 * Time: 11:11 AM
 */
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_users WHERE id = '$xid' ORDER BY id DESC");
if($value->rowCount()>0)
{
    while($r=$value->fetch(PDO::FETCH_ASSOC)) {
        $name = $r['firstname']. " ". $r['lastname'];
        $img = $r['profile'];
        $username = $r['username'];
    }}

?>

<div class="sidebar-scroll">
    <div class="user-account">
        <img src="<?= $img; ?>" class="rounded-circle user-photo" alt="User Profile Picture">
        <div class="dropdown">
            <span>Welcome,</span>
            <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?= $name; ?></strong></a>
            <ul class="dropdown-menu dropdown-menu-right account">
                <li><a href="profile.php"><i class="icon-user"></i>My Profile</a></li>
                <li class="divider"></li>
                <li><a href="logout.php?logout=true"><i class="icon-power"></i>Logout</a></li>
            </ul>
        </div>
        <hr>
        <ul class="row list-unstyled">
            <li class="col-4">
                <small>Sales</small>
                <h6><?= number_format(db_count_where('tbl_orders', $where = array("status"=>"Claimed")));?></h6>
            </li>
            <li class="col-4">
                <small>Order</small>
                <h6><?= number_format(db_count_all('tbl_orders')); ?></h6>
            </li>
            <li class="col-4">
                <small>Revenue</small>
                <h6>₱ <?= number_format(sum('tbl_orders', 'prod_price', $where = array("status"=>"Claimed"))); ?></h6>
            </li>
        </ul>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content p-l-0 p-r-0">
        <div class="tab-pane active" id="menu">
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="">
                        <a href="index.php" class="has-arrow"><i class="icon-home"></i> <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="" class="has-arrow"><i class="fa fa-first-order"></i> <span> Order and Sales</span></a>
                        <ul>
<!--                            <li><a href="create-single-order.php">Create Single Order</a></li>-->
<!--                            <li><a href="create-bulk-order.php">Create Bulk Order</a></li>-->
                            <li><a href="pending-payments.php">Pending Payments</a></li>
                            <li><a href="pending-orders.php">Pending Orders</a></li>
                            <li><a href="orders.php">Orders</a></li>
                        </ul>
                    </li>
<!--                    <li>-->
<!--                        <a href="" class="has-arrow"><i class="fa fa-desktop"></i> <span> Design Management</span></a>-->
<!--                        <ul>-->
<!--                            <li><a href="create-existing-design.php">New from Existing Products</a></li>-->
<!--<!--                            <li><a href="create-new-design.php">New Product and Design</a></li>-->
<!--                            <li><a href="manage-design.php">Manage Designs</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li>
                        <a href="" class="has-arrow"><i class="fa fa-info"></i> <span> Inventory</span></a>
                        <ul>
                            <li><a href="create-materials.php">Materials Inventory</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#FileManager" class="has-arrow"><i class="icon-folder"></i> <span>File Maintenance</span></a>
                        <ul>
                            <li><a href="category-listing.php">Category Listing</a></li>
                            <li><a href="type-listing.php">Type Listing</a></li>
                            <li><a href="product-listing.php">Products Listing</a></li>
                        </ul>
                    </li>
<!--                    <li class="">-->
<!--                        <a href="backup.php"><i class="fa fa-database"></i> <span>Backup</span></a>-->
<!--                    </li>-->
                    <li class="">
                        <a href="payment-options.php"><i class="glyphicon glyphicon-usd"></i> <span>Payment Options</span></a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="tab-pane p-l-15 p-r-15" id="setting">
            <h6>Choose Skin</h6>
            <ul class="choose-skin list-unstyled">
                <li data-theme="purple">
                    <div class="purple"></div>
                    <span>Purple</span>
                </li>
                <li data-theme="blue">
                    <div class="blue"></div>
                    <span>Blue</span>
                </li>
                <li data-theme="cyan" class="active">
                    <div class="cyan"></div>
                    <span>Cyan</span>
                </li>
                <li data-theme="green">
                    <div class="green"></div>
                    <span>Green</span>
                </li>
                <li data-theme="orange">
                    <div class="orange"></div>
                    <span>Orange</span>
                </li>
                <li data-theme="blush">
                    <div class="blush"></div>
                    <span>Blush</span>
                </li>
            </ul>
        </div>
    </div>
</div>
