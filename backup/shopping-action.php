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
        if($cart->addCart($_SESSION['id'], $_SESSION['sess_id'], $_SESSION['product_ref'], $_GET['name'], $_GET['qty'], $_GET['img'], $_GET['price'])){
            redirect('shop.php?Added');
        }
        else{
            redirect('shop.php?Failed');
        }
    }
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
        if($cart->addCart($_SESSION['id'], $_SESSION['sess_id'], $_SESSION['product_ref'], $_POST['name'], $_POST['qty'], $_POST['img'], $price)){
            redirect($_SERVER['HTTP_REFERER']);
        }
        else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}