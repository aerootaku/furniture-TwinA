<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/12/2018
 * Time: 7:27 AM
 */

include 'shopping.php';
$cart = new shopping();
if(isset($_GET['addCart'])){
    if($_GET['addCart'] == '1'){
        $id = $_GET['id'];
        if(!isset($_SESSION['sess_id'])){
            $_SESSION['sess_id'] = date('ymdhsa'). rand_string(10);
        }
        if(!isset($_SESSION['product_ref'])){
            $_SESSION['product_ref'] = date('ymdhsa'). rand_string(10);
        }
        if($cart->addCart($_SESSION['id'], $_SESSION['sess_id'], $_SESSION['product_ref'], $_GET['name'], $_GET['qty'], $_GET['img'], $_GET['price'], $_GET['color'], $_GET['wood_type'])){
            redirect('shop.php?Added');
        }
        else{
            redirect('shop.php?Failed');
        }
    }
}

if(isset($_GET['id'])){
    $cart->removeCart($_GET['id']);
    redirect('shop.php?Added');
}
if(isset($_POST['cartPost'])){
    if($_POST['addCart'] == '1'){
        //$id = $_GET['id'];
        if(!isset($_SESSION['sess_id'])){
            $_SESSION['sess_id'] = date('ymdhsa'). rand_string(10);
        }
        if(!isset($_SESSION['product_ref'])){
            $_SESSION['product_ref'] = date('ymdhsa'). rand_string(10);
        }
        $price = $_POST['price'];
        if($cart->addCart($_SESSION['id'], $_SESSION['sess_id'], $_SESSION['product_ref'], $_POST['name'], $_POST['qty'], $_POST['img'], $_POST['price'], $_POST['color'], $_POST['wood_type'])){
            redirect('shop.php?Added');
        }
        else{
            redirect('shop.php?Failed');
        }
    }
}

if(isset($_POST['order'])) {
    $data = "";
    $user_id = $_SESSION['id'];
    $value = custom_query("SELECT * FROM tbl_cart WHERE user_id = '$user_id' and status='Pending' ORDER BY id DESC");
    if ($value->rowCount() > 0) {
        while ($r = $value->fetch(PDO::FETCH_ASSOC)) {
            $data = array(
                "user_id" => $_SESSION['id'],
                "or_no" => rand_string(10),
                "product_id" => rand_string(10),
                "prod_img" => $r['product_image'],
                "prod_name" => $r['name'],
                "prod_price" => $r['price'],
                "prod_type" => $r['wood_type'],
                "prod_color" => $r['color'],
                "prod_qty" => $r['qty'],
                "contact" => $_SESSION['contact'],
                "email" => $_SESSION['email'],
                "status" => "Pending",
                "or_type" => "Order"
            );
            print_r($data);
            $insert = db_insert('tbl_orders', $data);
            db_update('tbl_cart', $d = array("status"=>"Ordered"), $w = array("user_id"=>$user_id));
        }

    }
    redirect('client/pending-order.php');
}