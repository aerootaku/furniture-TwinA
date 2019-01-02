<?php
include '../controller/action.php';
include 'session.php';
?>

<!doctype html>
<html lang="en">

<head>
<title>:: TwinA :: Dashboard</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
<link rel="stylesheet" href="../assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="../assets/vendor/morrisjs/morris.min.css" />
    <link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<!-- MAIN CSS -->
<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/color_skins.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <span>Today</span>
                            <h4 style="color: black; text-align: center"><?php echo date('F d, Y', strtotime(datenow())); ?></h4>
                            <h4 id="timeNow" style="text-align: center; color: black;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3><?= number_format(db_count_where('tbl_orders', $where = array("status"=>"Claimed"))); ?> <i class="icon-basket-loaded float-right"></i></h3>
                            <span>Products Sold</span>                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3><?= number_format(db_count_where('tbl_users', $where = array("role"=>"Client"))); ?> <i class="icon-user-follow float-right"></i></h3>
                            <span>Customers</span>                    
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>₱ <?= number_format(sum('tbl_orders', 'prod_price', $where = array("status"=>"Claimed"))); ?> <i class="fa fa-dollar float-right"></i></h3>
                            <span>Net Profit</span>       
                        </div>
                    </div>
                </div>

            </div>

            <div class="row clearfix">
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Product Sold per Month</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?php
                            //index.php
                            $chart_data2 = '';
                            $query = custom_query("SELECT COUNT(product_id) as count, prod_name, dtcreated FROM tbl_orders GROUP BY MONTH(dtcreated)");
                            while($row = $query->fetch(PDO::FETCH_ASSOC))
                            {
//                                $st = strtotime($row['dt']);
//                                $rDate = date('F', $st);
                                $chart_data2 .= "{ name:'".$row['prod_name']."', value:".$row["count"]."}, ";
                            }
                            $chart_data2 = substr($chart_data2, 0, -2);
                            ?>
                            <div id="productsCol"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Material Analysis</h2>
                        </div>
                        <div class="body">
                            <?php
                            //index.php
                            $chart_data1 = '';
                            $query = custom_query("SELECT quantity as count, name FROM tbl_inventory GROUP BY name");
                            while($row = $query->fetch(PDO::FETCH_ASSOC))
                            {
//                                $st = strtotime($row['dt']);
//                                $rDate = date('F', $st);
                                $chart_data1 .= "{ material:'".$row['name']."', value:".$row["count"]."}, ";
                            }
                            $chart_data1 = substr($chart_data1, 0, -2);
                            ?>
                            <div id="materialsCol"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>Sales Income</h2>
                        </div>
                        <?php
                        //index.php
                        $chart_data = '';
                        $query = custom_query("SELECT dtcreated as dt, SUM(prod_price) as sales FROM tbl_orders WHERE status = 'Claimed' GROUP BY month(dtcreated)");
                        while($row = $query->fetch(PDO::FETCH_ASSOC))
                        {
                            $st = strtotime($row['dt']);
                            $rDate = date('F', $st);
                            $chart_data .= "{ month:'".$rDate."', value:".$row["sales"]."}, ";
                        }
                         $chart_data = substr($chart_data, 0, -2);
                        ?>
                        <div class="body">
                            <div id="salesCol"></div>
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

<script src="../assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="../assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="../assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
    <script src="../assets/vendor/toastr/toastr.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script src="../assets/js/index8.js"></script>

<script>
    new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'salesCol',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [<?php echo $chart_data; ?>],
        // The name of the data record attribute that contains x-values.
        xkey: 'month',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value'],
        barColors: ["#009988"],
        hideHover:'auto',
        resize: true,
        fillOpacity: 1,
        stacked:false
    });
</script>
    <script>
        new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'materialsCol',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [<?php echo $chart_data1; ?>],
            // The name of the data record attribute that contains x-values.
            xkey: 'material',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value'],
            barColors: ["#009988"],
            hideHover:'auto',
            resize: true,
            fillOpacity: 1,
            stacked:false
        });
    </script>
<script>
    new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'productsCol',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [<?php echo $chart_data2; ?>],
        // The name of the data record attribute that contains x-values.
        xkey: 'name',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['value'],
        barColors: ["#009dff"],
        fillOpacity: 0.6,
        hideHover: 'auto',
        behaveLikeLine: true,
        resize: true,
        pointFillColors:['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors:['gray','red']
    });
</script>
    <?php if(isset($_SESSION['welcome'])){
        ?>
        <script>
            toastr.options.timeOut = "5000";
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-right';
            toastr['success']('<?php echo "Welcome ". $_SESSION['username']; ?>');
            <?php  unset($_SESSION['welcome']); ?>
        </script>
        <?php
    }unset($_SESSION['welcome']); ?>
    <script>
        var d = new Date(<?php date_default_timezone_set('Asia/Manila'); echo strtotime('now')*1000 ?>);
        (function foo(){
            d.setTime(d.getTime()+1000);
            var clientTime = d.getHours() + ":"  + d.getMinutes() + ":" + d.getSeconds() + " " + (d.getHours() >= 12 ? 'pm' : 'am');
            //alert(clientTime);
            document.getElementById("timeNow").innerHTML = clientTime;
            setTimeout(foo, 1000); // refresh time every 1 second
        })();
    </script>
</body>

</html>
