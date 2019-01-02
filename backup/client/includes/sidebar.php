<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/24/2018
 * Time: 11:11 AM
 */ ?>

<div class="sidebar-scroll">
    <div class="user-account">
        <img src="../assets/img/user.png" class="rounded-circle user-photo" alt="User Profile Picture">
        <div class="dropdown">
            <span>Welcome,</span>
            <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $_SESSION['firstname'] . " ". $_SESSION['lastname']; ?></strong></a>
            <ul class="dropdown-menu dropdown-menu-right account">
                <li><a href="logout.php?logout=true"><i class="icon-power"></i>Logout</a></li>
            </ul>
        </div>
        <hr>
    </div>
    <!-- Nav tabs --

    <!-- Tab panes -->
    <div class="tab-content p-l-0 p-r-0">
        <div class="tab-pane active" id="menu">
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="">
                        <a href="index.php" class="has-arrow"><i class="icon-home"></i> <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="" class="has-arrow"><i class="icon-users"></i> <span> My Orders</span></a>
                        <ul>
                            <li><a href="pending-order.php">Track Recent Orders</a></li>
                            <li><a href="order-history.php">Order History</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php?logout=true"><i class="icon-logout"></i> Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
