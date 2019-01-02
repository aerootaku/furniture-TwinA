<?php

include '../controller/action.php';

if(isset($_POST['updateInfo'])){
    $data = array(
        "firstname"=>$_POST['firstname'],
        "middlename"=>$_POST['middlename'],
        "lastname"=>$_POST['lastname'],
        "gender"=>$_POST['gender'],
        "address"=>$_POST['address'],
    );

    $edit = db_update('tbl_users', $data, $id = array("id"=>$_SESSION['id']));
    if(isset($edit)){

        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Profile Updated Successfully',
            'title'=>'Congratulations'
        );
    }
    else{
        $error[] = '';
    }
}
?>

<!doctype html>
<html lang="en">


<head>
<title>:: Lucid :: Profile</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">

<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/blog.css">
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
    <div id="main-content" class="profilepage_2 blog-page">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pages</li>
                            <li class="breadcrumb-item active">User Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-4 col-md-12">
                    <div class="card profile-header">
                        <div class="body">
                            <div class="profile-image"> <img src="../assets/img/user.png" class="rounded-circle" alt=""> </div>
                            <div>
                                <h4 class="m-b-0"><strong><?= $_SESSION['firstname']; ?></strong> <?= $_SESSION['lastname']; ?></h4>
                                <span><?= $_SESSION['username']; ?></span>
                            </div>
                            <div class="m-t-15">
                                <a href="../shop.php" class="btn btn-primary">Shop</a>
                                <a href="create-design.php" class="btn btn-outline-secondary">Create Design</a>
                            </div>                            
                        </div>
                    </div>
                    <?php
                    $xid = $_SESSION['id'];
                    $value = custom_query("SELECT * FROM tbl_users WHERE id = '$xid' ORDER BY id DESC");
                    if($value->rowCount()>0)
                    {
                    while($r=$value->fetch(PDO::FETCH_ASSOC))
                    {
                    $id = $r['id'];
                    ?>
                    <div class="card">
                        <div class="header">
                            <h2>Info</h2>
                        </div>
                        <div class="body">
                            <small class="text-muted">Address: </small>
                            <p><?= $r['address']; ?></p>
                            <hr>
                            <small class="text-muted">Email address: </small>
                            <p><?= $r['email']; ?></p>
                            <hr>
                            <small class="text-muted">Mobile: </small>
                            <p><?= $r['contact']; ?></p>
                            <hr>
                        </div>
                    </div>
                    <?php }} ?>
                    <div class="card">
                        <div class="header">
                            <h2>Recent Orders</h2>
                        </div>
                        <div class="body">
                            <ul class="right_chat list-unstyled">
                                <?php
                                $xid = $_SESSION['id'];
                                $value = custom_query("SELECT * FROM tbl_orders WHERE user_id = '$xid' ORDER BY id DESC");
                                if($value->rowCount()>0)
                                {
                                while($r=$value->fetch(PDO::FETCH_ASSOC))
                                {
                                $id = $r['id'];
                                ?>
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="<?= $r['prod_img']; ?>" alt="">
                                            <div class="media-body">
                                                <span class="name"><?= $r['prod_name']; ?></span>
                                                <span class="message">₱ <?= number_format($r['prod_price']); ?></span><br />
                                                <span class="message"><?= $r['status']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php }}  else { echo "No Recent Orders"; } ?>
                            </ul>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-5 col-md-12">

                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs-new">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings">Settings</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content padding-0">

                        <div class="tab-pane active" id="Settings">
                            <?php
                            $xid = $_SESSION['id'];
                            $value = custom_query("SELECT * FROM tbl_users WHERE id = '$xid' ORDER BY id DESC");
                            if($value->rowCount()>0)
                            {
                            while($r=$value->fetch(PDO::FETCH_ASSOC))
                            {
                            $id = $r['id'];
                            ?>
                            <div class="card">
                                <form action="" method="POST" novalidate>
                                    <div class="body">
                                        <h6>Basic Information</h6>
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?= $r['firstname']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="middlename" class="form-control" placeholder="Middle Name" value="<?= $r['middlename']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?= $r['lastname']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <label class="fancy-radio">
                                                            <input name="gender" value="Male" type="radio" <?php if($r['gender'] == 'Male'){ echo "Checked"; } ?>>
                                                            <span><i></i>Male</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input name="gender" value="Female" type="radio" <?php if($r['gender'] == 'Female'){ echo "Checked"; } ?>>
                                                            <span><i></i>Female</span>
                                                        </label>
                                                    </div>
                                                </div>

    <!--                                            <div class="form-group">-->
    <!--                                                <div class="input-group">-->
    <!--                                                    <div class="input-group-prepend">-->
    <!--                                                        <span class="input-group-text"><i class="icon-calendar"></i></span>-->
    <!--                                                    </div>-->
    <!--                                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Birthdate">-->
    <!--                                                </div>-->
    <!--                                            </div>-->
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea name="address" class="form-control"><?= $r['address']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="updateInfo">Update</button> &nbsp;&nbsp;
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <?php }} ?>
                            <div class="card">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12">
                                            <h6>Account Data</h6>
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" value="" disabled placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" value="" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Phone Number">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <h6>Change Password</h6>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Current Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Confirm New Password">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                    <button class="btn btn-default">Cancel</button>
                                </div>
                            </div>
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

<script src="../assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>

<script>
$(function () {
    $('.knob').knob({
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
});
</script>
</body>

<!-- Mirrored from thememakker.com/templates/lucid/main/page-profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Jul 2018 03:52:23 GMT -->
</html>