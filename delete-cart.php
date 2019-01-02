<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/12/2018
 * Time: 11:08 PM
 */

include 'shopping.php';

$shopping = new shopping();
$id = $_GET['id'];

if($shopping->removeCart($id)){
    redirect($_SERVER['HTTP_REFERER']);
}
else{
    redirect($_SERVER['HTTP_REFERER']);
}