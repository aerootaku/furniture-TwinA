<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 9/20/2018
 * Time: 11:27 AM
 */

include 'controller/action.php';
header('Content-Type: application/json');

if(isset($_GET['province'])){
    $xid = $_GET['province'];
    $value = custom_query("SELECT DISTINCT(city) FROM tbl_locations WHERE province = '$xid' ORDER BY id DESC");
    if($value->rowCount()>0) {
        while ($r = $value->fetch(PDO::FETCH_ASSOC)) {
            $result[] = array(
                'value' => $r['city'],
                'name' => $r['city'],
            );
        }
        echo json_encode($result);
    }

}
if(isset($_GET['city'])){
    $xid = $_GET['city'];
    $value = custom_query("SELECT * FROM tbl_locations WHERE city = '$xid' ORDER BY id DESC");
    if($value->rowCount()>0) {
        while ($r = $value->fetch(PDO::FETCH_ASSOC)) {
            $result[] = array(
                'value' => $r['barangay'],
                'name' => $r['barangay'],
            );
        }
        echo json_encode($result);
    }

}