<?php
include 'controller/action.php';
if(isset($_GET['rand'])){
    $update = db_update('tbl_users', $data = array("status"=>"Active"), $where = array("reg_hash"=>$_GET['rand']));
    if(isset($update)){
        echo "<h3>You have successfully verified your account</h3>
                           <a href=\"login.php\"><strong>Click here</strong></a> to login";
    }
    else{
        echo "We're unable to process your account. please try again later";
    }
}
else {
    echo "Unable to process your request. please try again later";
}

?>
