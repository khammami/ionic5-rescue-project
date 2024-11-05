<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$message=array();
$id=$_GET['foodId'];
$sql_query = "DELETE FROM `tb_food` where idFood ='$id' ";
$result = mysqli_query($con,$sql_query);
if($result)
        {$message['status'] = "Success";}
        else{
            $message['status'] = "Error";
        }
    echo json_encode($message);