<?php
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);

//if(!isset($_SESSION))   {    session_start();   }

function db_connect(){
    $DB_host = "localhost";
    $DB_user = "u624813367_twina";
    $DB_pass = "furniture";
    $DB_name = "u624813367_twina";
    try
    {
        $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DB_con;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        return false;
    }
}

function last_insert(){
    $db = db_connect();
    return $db->lastInsertId();
}

function db_getid($tableName,$where,$column){
    $db = db_connect();
    $stringWhere = "";
    $value = "";
    $array = array();

    foreach($where as $key => $values){
        $stringWhere .= $key. "= '".$values."' AND ";
        $array[":".$key] = $values;
    }

    $stringWhere = substr($stringWhere,0,-4);
    $query = "SELECT ".$column." FROM ".$tableName." WHERE ".$stringWhere;

    try{
        $sth = $db->query($query);
        if(!empty($sth)) {
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $value=$row[$column];

        }
        else $value="";
    }catch(PDOException $e){

    }

    return $value;
}

function db_error($e){
    echo json_encode(array("success"=>false,"message"=>$e));
}

function db_count_where($tableName, $where){
    $db = db_connect();
    $stringWhere = "";
    $array = array();
    $count = 0;

    foreach($where as $key => $values){
        $stringWhere .= $key. " = '".$values."' AND ";
        $array[":".$key] = $values;
    }
    $stringWhere = substr($stringWhere,0,-4);
    $query = "SELECT COUNT(*) as n FROM $tableName WHERE $stringWhere";
    try{
        $sth = $db->query($query);
        if(!empty($sth)){
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $count = $row['n'];
        }
    }catch(Exception $e){
        $count = 0;
    }

    return $count;
}

function db_count_whereSingle($tableName, $where){
    $db = db_connect();
    $stringWhere = "";
    $array = array();
    $count = 0;

    $query = "SELECT COUNT(*) as n FROM $tableName WHERE $where";
    try{
        $sth = $db->query($query);
        if(!empty($sth)){
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $count = $row['n'];
        }
    }catch(Exception $e){
        $count = 0;
    }

    return $count;
}

function db_count_all($tableName){
    $db = db_connect();
    $array = array();
    $count = 0;

    $query = "SELECT COUNT(*) as n FROM $tableName";
    try{
        $sth = $db->query($query);
        if(!empty($sth)){
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $count = $row['n'];
        }
    }catch(Exception $e){
        $count = 0;
    }

    return $count;
}

function getSettings($tableName, $column_name, $where){
    $value = "";
    $db = db_connect();
    $query = "SELECT $column_name FROM $tableName WHERE id = $where";
    $sth = $db->query($query);
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $value = $row[$column_name];
    }
    return $value;
}

function get_result($tableName,$data,$where){
    $db = db_connect();
    $stringValues = "";
    $stringWhere = "";
    $array = array();

    foreach($where as $key => $values){
        $stringWhere .= $key. " = '".$values."' AND ";
        $array[":".$key] = $values;
    }

    $value = "";
    $stringWhere = substr($stringWhere,0,-4);
    $stringValues = substr($stringValues,0,-1);
    $query = "SELECT $data FROM $tableName WHERE ".$stringWhere;


    try{
        $sth = $db->query($query);

        if(!empty($sth)) {
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $value=$row[$data];

        }
        else $value="";

    }catch(PDOException $e){
        $value="";
    }
    return $value;
}

function db_update($tableName,$data,$where){
    $db = db_connect();
    $stringValues = "";
    $stringWhere = "";
    $array = array();

    foreach($data as $key => $value){
        $stringValues .= $key. " = :".$key.",";
        $array[":".$key] = $value;
    }

    foreach($where as $key => $values){
        $stringWhere .= $key. "= :".$key." AND ";
        $array[":".$key] = $values;
    }

    $boolean = "";
    $stringWhere = substr($stringWhere,0,-4);
    $stringValues = substr($stringValues,0,-1);
    $query = "UPDATE $tableName SET ".$stringValues." WHERE ".$stringWhere;


    try{
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = true;
    }catch(PDOException $e){
        $boolean = false;
    }

    return $boolean;
}

function db_insert($tableName,$data){
    $db = db_connect();
    $stringValues = "";
    $stringInit = "";
    $stringParam = "";
    $array = array();
    foreach($data as $key => $value){
        $stringInit .= $key.",";
        $stringValues .= ":".$key.",";
        $array[":".$key] = $value;
    }
    $boolean = "";
    $stringInit = substr($stringInit,0,-1);
    $stringValues = substr($stringValues,0,-1);
    $query = "INSERT INTO $tableName (".$stringInit.") VALUES(".$stringValues.")";
    try{
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = $db->lastInsertId();

    }catch(PDOException $e){
        $boolean = $e;
    }

    return $boolean;
}

function db_delete($tableName,$data){
    $db = db_connect();
    $stringWhere="";

    $array = array();

    foreach($data as $key =>$values){
        $stringWhere .= $key. "= :".$key." AND ";
        $array[":".$key] = $values;
    }

    $boolean="";
    $stringWhere = substr($stringWhere,0,-4);
    $query = "DELETE FROM $tableName WHERE ".$stringWhere;

    try{
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean=true;
    }catch(PDOException $e){
        $boolean = $e;
    }

    return $boolean;
}

function db_response($query){
    if($query) echo json_encode(array('success' => true)); else echo json_encode(array('success' => false));
}

function db_select($tableName){
  $db = db_connect(); 
  $query = "SELECT * FROM $tableName";
  $value=$db->query($query); 
  return $value;
}

function db_select_order($tableName, $orderby, $order){
    $db = db_connect();
    $query = "SELECT * FROM $tableName ORDER BY $orderby $order";
    $value=$db->query($query);
    return $value;
}

function db_select_by_id($tableName,$where){
  $db = db_connect(); 
  $query = "SELECT * FROM $tableName WHERE ".$where;
  $value=$db->query($query); 
  return $value;
}

function isExists($tableName,$where){
    $db = db_connect();
    $boolean = "";
    $where_string = "";
    foreach($where as $key => $values){
        $where_string .= $key. " = '".$values."' OR ";
        $array[":".$key] = $values;
    }
    $where_string = substr($where_string,0,-4);

    try{
        $query = "SELECT * FROM $tableName WHERE ".$where_string;
        $sth=$db->query($query);
        if($sth->rowCount ()  > 0) $boolean = true;
        else $boolean = false;
    }catch(PDOException $e){
        $boolean = false;
    }

    return $boolean;
}

function db_select_where($tableName,$where){
  $db = db_connect(); 
  $query = "SELECT * FROM $tableName WHERE ".$where;
  $value=$db->query($query); 
  return $value;
}

function db_select_whereArray($tableName,$where){
    $db = db_connect();
    $stringWhere = "";
    $array = array();

    foreach($where as $key => $values){
        $stringWhere .= $key. " = '".$values."' AND ";
        $array[":".$key] = $values;
    }
    $stringWhere = substr($stringWhere,0,-4);

    $query = "SELECT * FROM $tableName WHERE $stringWhere";
    $value=$db->query($query);
    return $value;
}

function custom_query($mquery){
  $db = db_connect(); 
  $query = $mquery;
  $value=$db->query($query); 
  return $value;
}

function custom_echo($x, $length)
{
    if(strlen($x)<=$length)
    {
        echo $x;
    }
    else
    {
        $y=substr($x,0,$length) . '...';
        echo $y;
    }
}

function generate_age($birthday){
    $age = '';
    $dateToday = date("Y-m-d");
    $age = $dateToday->diff($birthday);
    return $age;
}

function redirect($url)
{
    header("Location: $url");
}

function rand_string( $length ) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);

}

function datenow(){
    return date('Y-m-d');
}


function phone_number_format($number) {
    // Allow only Digits, remove all other characters.
    $number = preg_replace("/[^\d]/","",$number);

    return $number;

}

function sum($tableName, $column_name, $where){
    $db = db_connect();
    $stringWhere = "";
    $array = array();
    $sum = 0;
    foreach($where as $key => $values){
        $stringWhere .= $key. " = '".$values."' AND ";
        $array[":".$key] = $values;
    }
    $stringWhere = substr($stringWhere,0,-4);

    $query = "SELECT sum($column_name) as n FROM $tableName WHERE $stringWhere";
    try{
        $sth = $db->query($query);
        if(!empty($sth)){
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $sum = $row['n'];
        }
    }catch(Exception $e){
        $sum = 0;
    }

    return $sum;
}





