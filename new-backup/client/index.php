<?php

include '../controller/action.php';
include  'session.php';

if(isset($_POST['updateInfo'])){

    if($_FILES['profile']['size'] == 0){
        $data = array(
            "firstname"=>$_POST['firstname'],
            "middlename"=>$_POST['middlename'],
            "lastname"=>$_POST['lastname'],
            "gender"=>$_POST['gender'],
            "address"=>$_POST['address'],
            "birthday"=>$_POST['birthday'],
            "age"=>calculate_age($_POST['birthday'])
        );
    }
    else{
        $filetmp = $_FILES["profile"]["tmp_name"];
        $filename = $_FILES["profile"]["name"];
        $filepath = $_FILES["profile"]["type"];
        $profile  = "../uploads/".$filename;
        move_uploaded_file($filetmp,$profile);
        $data = array(
            "profile"=>$profile,
            "firstname"=>$_POST['firstname'],
            "middlename"=>$_POST['middlename'],
            "lastname"=>$_POST['lastname'],
            "gender"=>$_POST['gender'],
            "address"=>$_POST['address'],
            "birthday"=>$_POST['birthday'],
            "age"=>calculate_age($_POST['birthday'])
        );

    }


    $edit = db_update('tbl_users', $data, $id = array("id"=>$_SESSION['id']));
    if(isset($edit)){

        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Profile Updated Successfully. Please Login and Logout to See full changes',
            'title'=>'Congratulations'
        );
        redirect('index.php');
        exit();
    }
    else{
        $error[] = '';
    }
}
if(isset($_POST['updatepassword'])){
    $current = $_POST['currentPass'];
    $new = $_POST['newPass'];
    $confirm = $_POST['confirmPass'];

    //check if the current password is equal to the input
    $fetched = password_verify($current, $_SESSION['declared']);
    if($current != $fetched){
        $error[] = 'Old password does not matched with the current password';
    }
    else{
        if($new != $confirm){
            $error[] = 'Password does not matched';
        }
        else {
            $update = db_update('tbl_users', $datas = array("password"=>password_hash($confirm, PASSWORD_DEFAULT)), $where = array("id"=>$_SESSION['id']));
            if($update){
                $_SESSION['toastr'] = array(
                    'type'=>'info',
                    'message'=>'Password Updated Successfully',
                    'title'=>'Info'
                );
                redirect('index.php');
                exit();
            }
            else{
                $error[] = 'There was an error with the server. Please try again later';
            }
        }
    }
}
if(isset($_POST['updateAccount'])){
    $data = array(
        "email"=>$_POST['email'],
        "contact"=>$_POST['contact']
    );

    $edit = db_update('tbl_users', $data, $id = array("id"=>$_SESSION['id']));
    if(isset($edit)){

        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Profile Updated Successfully',
            'title'=>'Congratulations'
        );
        redirect('index.php');
        exit();
    }
    else{
        $error[] = '';
    }
}
?>

<!doctype html>
<html lang="en">


<head>
<title>:: TwinA :: Profile</title>
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
    <link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
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
                            <div class="profile-image"> <img src="<?= $img; ?>" style="max-height: 90px; max-width: 90px" class="rounded-circle" alt=""> </div>
                            <div>
                                <h4 class="m-b-0"><strong><?= $name ?></strong></h4>
                                <span><?= $username; ?></span>
                            </div>
                            <div class="m-t-15">
                                <a href="../shop.php" class="btn btn-primary">Shop</a>
                                <a href="../designer.php" class="btn btn-outline-secondary">Create Design</a>
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
                            <small class="text-muted">Birthday: </small>
                            <p><?= $r['birthday']; ?></p>
                            <hr>
                            <small class="text-muted">Age: </small>
                            <p><?= $r['age']; ?></p>
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
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="body">
                                        <h6>Basic Information</h6>
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <input type="file" name="profile" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?= $r['firstname']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="middlename" class="form-control" placeholder="Middle Name" value="<?= $r['middlename']; ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?= $r['lastname']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" value="<?= $r['birthday']; ?>" required name="birthday" required />
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
                                                    <textarea name="address" class="form-control" required><?= $r['address']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="updateInfo">Update</button> &nbsp;&nbsp;
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <div class="card">
                                <div class="body">
                                    <div class="col-lg-12 col-md-12">
                                        <form action="" method="POST">
                                            <h6>Account Data</h6>
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="<?= $r['username']; ?>" disabled placeholder="Username" >
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" value="<?= $r['email']; ?>" placeholder="Email" required name="email">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="<?= $r['contact']; ?>" placeholder="Phone Number" required name="contact">
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="updateAccount">Update</button> &nbsp;&nbsp;
                                            <button class="btn btn-default">Cancel</button>
                                        </form>
                                    </div>
                                    <?php }} ?>
                                    <hr />
                                    <form action="" method="POST">
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                                <h6>Change Password</h6>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Current Password" name="currentPass" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="New Password" name="newPass" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Confirm New Password" name="confirmPass" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="updatepassword">UPDATE</button> &nbsp;&nbsp;
                                        <button class="btn btn-default">CANCEL</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>

                <div class="col-lg-3 col-md-3">
                    <h3 style="text-align: center">TwinA Payment Options</h3>
                    <?php
                    $value = custom_query("SELECT * FROM tbl_payment_options ORDER BY id DESC");
                    if($value->rowCount()>0)
                    {
                    while($r=$value->fetch(PDO::FETCH_ASSOC))
                    {
                    ?>
                    <div class="card">
                        <div class="card-header " style="background-color: lightseagreen">
                            <h5 style="color: white">Mode of Payment: <?= $r['mode_of_payment']; ?></h5>
                        </div>
                        <div class="card-body">
                            <?= $r['description']; ?>
                        </div>
                    </div>
                    <?php }} ?>
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
<script src="../assets/vendor/toastr/toastr.js"></script>
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
<?php
if(isset($error))
{
    foreach($error as $error)
    {
        ?>
        <script>
            toastr.options.timeOut = "5000";
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-right';
            toastr['error']('<?php echo $error; ?>');

        </script>
    <?php }} ?>

<?php if(isset($_SESSION['toastr'])){
    ?>
    <script>
        toastr.options.timeOut = "5000";
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
        toastr['<?php echo $_SESSION['toastr']['type']; ?>']('<?php echo $_SESSION['toastr']['message']; ?>');
        <?php  unset($_SESSION['toastr']); ?>
    </script>
    <?php
}unset($_SESSION['toastr']); ?>
</body>

<!-- Mirrored from thememakker.com/templates/lucid/main/page-profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Jul 2018 03:52:23 GMT -->
</html>