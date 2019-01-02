<?php
include '../controller/action.php';


if(isset($_POST['login'])){

    if($action->login($_POST['username'], $_POST['password'])){

    }
    else{
        echo "Invalid username / Password";
    }
}
?>

<!doctype html>
<html lang="en">


<head>
    <title>:: DigiMed :: Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="DigiMed!">
    <meta name="author" content="Aviarthard Software Solutions">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/color_skins.css">
</head>

<body class="theme-cyan">
<!-- WRAPPER -->
    <div id="wrapper">
        <div class="row">
            <div class="col-md-6">
                <p>Sample</p>
            </div>
            <div class="col-md-6">
                <p>Sample</p>
            </div>
        </div>
    </div>

<!-- END WRAPPER -->
</body>


</html>