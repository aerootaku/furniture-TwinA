<?php
require 'controller/action.php';
if(isset($_POST['register'])){


    if(isExists('tbl_users', $where = array("username"=>$_POST['username'], "email"=>$_POST['email'])) == 1){
        $error[] = "Username or Email address is already registered";
    }
    else{
        $_SESSION['success'] = "TRUE";
        $age = calculate_age($_POST['birthday']);
        $data = array(
            "username"=>$_POST['username'],
            "password"=>password_hash($_POST['password'], PASSWORD_DEFAULT),
            "firstname"=>$_POST['firstname'],
            "middlename"=>$_POST['middlename'],
            "lastname"=>$_POST['lastname'],
            "email"=>$_POST['email'],
            "birthday"=>$_POST['birthday'],
            "age"=>$age,
            "contact"=>"+".phone_number_format($_POST['contact']),
            "gender"=>$_POST['gender'],
            "address"=>$_POST['address'] . " " . $_POST['barangay']. " " . $_POST['city']." ". $_POST['province'],
            "status"=>"Active"
        );
        $insert = db_insert('tbl_users', $data);

//        redirect('user-create.php');
        if(isset($insert)){
            $_SESSION['toastr'] = array(
                'type'=>'success',
                'message'=>'User Registered Successfully',
                'title'=>'Congratulations'
            );
            redirect('register.php');
            exit();
        }
        else{
            $error[] = '';
        }
    }


}
?>

<!doctype html>
<html lang="en">


<head>
<title>:: Lucid :: Sign Up</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="assets/vendor/parsleyjs/css/parsley.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="assets/vendor/multi-select/css/multi-select.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">

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
                            <p class="lead">Create an account</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" method="POST" id="reg">

                                <div class="form-group">
                                    <label>User Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required name="username">
                                </div>
                                <div class="form-group">
                                    <label>Password <span style="color: red">*</span></label>
                                    <input type="password" class="form-control" title="Password must contain at least 8 characters, including UPPER/lowercase, Special characters and numbers" data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$" required name="password" autocomplete="new-password" data-parsley-minlength="8" data-parsley-pattern-message="Password must contain at least 8 characters, including UPPER/lowercase, Special characters and numbers">
                                </div>
                                <div class="form-group demo-masked-input">
                                    <label>Email Address <span style="color: red">*</span></label>
                                    <input type="text" class="form-control email" required name="email">
                                </div>
                                <div class="form-group">
                                    <label>First Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required name="firstname">
                                </div>
                                <div class="form-group">
                                    <label>Last Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required name="lastname">
                                </div>
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control" required name="middlename">
                                </div>
                                <div class="form-group demo-masked-input">
                                    <label>Contact Number <span style="color: red">*</span></label>
                                    <input type="text" class="form-control mobile-phone-number" value="+63" placeholder="Ex: +00 (000) 000-00-00" name="contact">
                                </div>
                                <div class="form-group">
                                    <label>Birthday <span style="color: red">*</span></label>
                                    <input type="date" class="form-control" name="birthday" required />
                                </div>
                                <div class="form-group">
                                    <label>Gender <span style="color: red">*</span></label>
                                    <select name="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address <span style="color: red">*</span></label>
                                    <textarea class="form-control" rows="5" cols="30" required name="address" placeholder="House Number, Building and Street Name"></textarea>
                                    <hr />
                                    <label>Province <span style="color: red">*</span></label>
                                    <select name="province" class="form-control" id="province">
                                        <option value="" selected>Select Province</option>
                                        <option value="Metro Manila - Caloocan">Metro Manila - Caloocan</option>
                                        <option value="Metro Manila - Las Pinas">Metro Manila - Las Pinas</option>
                                        <option value="Metro Manila - Makati">Metro Manila - Makati</option>
                                        <option value="Metro Manila - Malabon">Metro Manila - Malabon</option>
                                        <option value="Metro Manila - Mandaluyong">Metro Manila - Mandaluyong</option>
                                        <option value="Metro Manila - Manila">Metro Manila - Manila</option>
                                        <option value="Metro Manila - Marikina">Metro Manila - Marikina</option>
                                        <option value="Metro Manila - Muntinlupa">Metro Manila - Muntinlupa</option>
                                        <option value="Metro Manila - Navotas">Metro Manila - Navotas</option>
                                        <option value="Metro Manila - Paranaque">Metro Manila - Paranaque</option>
                                        <option value="Metro Manila - Pasay">Metro Manila - Pasay</option>
                                        <option value="Metro Manila - Pasig">Metro Manila - Pasig</option>
                                        <option value="Metro Manila - Pateros">Metro Manila - Pateros</option>
                                        <option value="Metro Manila - Quezon City">Metro Manila - Quezon City</option>
                                        <option value="Metro Manila - San Juan">Metro Manila - San Juan</option>
                                        <option value="Metro Manila - Taguig">Metro Manila - Taguig</option>
                                        <option value="Metro Manila - Valenzuela">Metro Manila - Valenzuela</option>
                                        <option value="Cavite">Cavite</option>
                                    </select>
                                    <label>City / Municipality <span style="color: red">*</span></label>
                                    <select name="city" class="form-control" id="city">
                                        <option>-- Select City --</option>
                                    </select>
                                    <label>Barangay <span style="color: red">*</span></label>
                                    <select name="barangay" class="form-control" id="barangay">
                                        <option>-- Select Barangay --</option>
                                    </select>
                                    <label>
                                        Postal Code
                                    </label>
                                    <input type="number" class="form-control" name="postal" data-parsley-maxlength="4" />
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="register">REGITER</button>
                            </form>
                            <span>Already Registered? <a href="login.php">Login</a></span>
<!--                            <div class="separator-linethrough"><span>OR</span></div>-->
<!--                            <button class="btn btn-signin-social"><i class="fa fa-facebook-official facebook-color"></i> Sign in with Facebook</button>-->
<!--                            <button class="btn btn-signin-social"><i class="fa fa-twitter twitter-color"></i> Sign in with Twitter</button>-->
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="assets/vendor/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js -->
<script src="assets/vendor/toastr/toastr.js"></script>

<script src="assets/vendor/parsleyjs/js/parsley.min.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script>
    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#reg').parsley();

        $('#province').change(function() {
            var select = $('#city').empty();
            $.get('api.php', {province: $('#province').val()}, function(result) {
                console.log(result);
                $("<option value=''>-- Select City --</option>").appendTo(select);
                $.each(result, function(i, item) {
                    $('<option value="' + item.value + '">' + item.name + '</option>').
                    appendTo(select);
                });
            });
        });

        $('#city').change(function() {
            var select1 = $('#barangay').empty();
            $.get('api.php', {city: $('#city').val()}, function(result) {
                console.log(result);
                $.each(result, function(i, item) {
                    $('<option value="' + item.value + '">' + item.name + '</option>').
                    appendTo(select1);
                });
            });
        });
//        $('#room').change(function() {
//            var select1 = $('#bed').empty();
//            var rm = $('#room').val();
//            console.log(rm);
//            $.get('api.php', {room: $('#room').val()}, function(result) {
//                console.log(result);
//                $.each(result, function(i, item) {
//                    $('<option value="' + item.value + '">' + item.name + '</option>').
//                    appendTo(select1);
//                });
//            });
//        });
    });
</script>
<!--<script>-->
<!--    toastr.options.timeOut = "5000";-->
<!--    toastr.options.closeButton = true;-->
<!--    toastr.options.positionClass = 'toast-bottom-right';-->
<!--    toastr['success']('Information has been successfully saved');-->
<!---->
<!--</script>-->
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
        toastr['success']('<?php echo $_SESSION['toastr']['message']; ?>');
        <?php  unset($_SESSION['toastr']); ?>
    </script>
    <?php
} ?>

<script src="assets/js/pages/forms/advanced-form-elements.js"></script>
</html>
