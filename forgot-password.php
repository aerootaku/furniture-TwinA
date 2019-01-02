<?php

include 'controller/action.php';
//$_SESSION['success'] = 'FALSE';

if(isset($_POST['reset'])) {

    if(isExists('tbl_users', $data = array("email"=>$_POST['email'])) == 1){
        $rand = rand_string(10);
        $update = db_update('tbl_users', $data = array("password"=>password_hash($rand, PASSWORD_DEFAULT)), $where = array("email"=>$_POST['email']));
        if(isset($update)){
            $to = $_POST['email'];
            $subject = "NEW PASSWORD";
            $message = "Please use this new password to login to the system:". $rand;
            $headers = "From: no-reply@twinafurniture.com";
            mail($to,$subject,$message,$headers);
            //enter email here
//            $_SESSION['success'] = 'TRUE';
            redirect('forgot-password.php?Success');
        }
        else{
            $error[] = 'There was an error with your action';
            redirect('forgot-password.php?Error');
        }
    }
    else {
        $error[] = 'Your email address does not exist in the system';
    }

}


?>



<!doctype html>
<html lang="en">


<!-- Mirrored from thememakker.com/templates/lucid/main/page-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Jul 2018 03:53:02 GMT -->
<head>
<title>:: TwinA :: Forgot Password</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
</head>

<body class="theme-cyan">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="top">
                        <img src="assets/img/logo-white.svg" alt="Lucid">
                    </div>
					<div class="card">
                        <div class="header">
                            <p class="lead">Recover my password</p>
                        </div>
                        <div class="body">
                            <p>Please enter your email address below to receive instructions for resetting password.</p>
                            <form class="form-auth-small" action="" method="POST">
                                <div class="form-group">                                    
                                    <input type="email" class="form-control" id="signup-password" placeholder="Email" name="email">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">RESET PASSWORD</button>
                                <div class="bottom">
                                    <span class="helper-text">Know your password? <a href="login.php">Login</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

<!-- Mirrored from thememakker.com/templates/lucid/main/page-forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Jul 2018 03:53:02 GMT -->
</html>

