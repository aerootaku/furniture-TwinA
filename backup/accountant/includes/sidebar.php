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
                <li><a href="profile.php"><i class="icon-user"></i>My Profile</a></li>
                <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
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
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#question"><i class="icon-question"></i></a></li>
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
                        <a href="" class="has-arrow"><i class="fa fa-info"></i> <span> Inventory</span></a>
                        <ul>
                            <li><a href="create-materials.php">Materials Inventory</a></li>
                        </ul>
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
            <hr>
            <h6>General Settings</h6>
            <ul class="setting-list list-unstyled">
                <li>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="checkbox">
                        <span>Report Panel Usage</span>
                    </label>
                </li>
                <li>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="checkbox" checked>
                        <span>Email Redirect</span>
                    </label>
                </li>
                <li>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="checkbox" checked>
                        <span>Notifications</span>
                    </label>
                </li>
                <li>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="checkbox">
                        <span>Auto Updates</span>
                    </label>
                </li>
                <li>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="checkbox">
                        <span>Offline</span>
                    </label>
                </li>
                <li>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="checkbox">
                        <span>Location Permission</span>
                    </label>
                </li>
            </ul>
        </div>
        <div class="tab-pane p-l-15 p-r-15" id="question">
            <form>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-magnifier"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
            </form>
            <ul class="list-unstyled question">
                <li class="menu-heading">HOW-TO</li>
                <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                <li><a href="javascript:void(0);">Website Analytics</a></li>
                <li class="menu-heading">ACCOUNT</li>
                <li><a href="javascript:void(0);">Cearet New Account</a></li>
                <li><a href="javascript:void(0);">Change Password?</a></li>
                <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                <li class="menu-heading">BILLING</li>
                <li><a href="javascript:void(0);">Payment info</a></li>
                <li><a href="javascript:void(0);">Auto-Renewal</a></li>
                <li class="menu-button m-t-30">
                    <a href="javascript:void(0);" class="btn btn-primary"><i class="icon-question"></i> Need Help?</a>
                </li>
            </ul>
        </div>
    </div>
</div>
