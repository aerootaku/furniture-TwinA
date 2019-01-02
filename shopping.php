<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 7/12/2018
 * Time: 6:50 AM
 */

include ('controller/action.php');

class shopping{

    /**
     * @param $session
     * @param $id = product reference number
     * @param $name
     * @param $color
     * @param $quantity
     * @return bool
     */
    public function addCart($user_id, $session, $id, $name, $quantity, $photo, $price, $color, $wood_type){
        try{
            $data = array(
                "user_id"=>$user_id,
                "cart_no"=>"$session",
                "product_ref"=>$id,
                "name"=>$name,
                "qty"=>$quantity,
                "color"=>$color,
                "wood_type"=>$wood_type,
                "product_image"=>$photo,
                "price"=>$price
            );
            $insert = db_insert('tbl_cart', $data);
            if($insert){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function removeCart($id){
        try{
            $where = array("id"=>$id);
            $delete = db_delete('tbl_cart', $where);
            if($delete){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

}