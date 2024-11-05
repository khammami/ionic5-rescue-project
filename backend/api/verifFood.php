<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$message=array();
$id=$_GET['foodId'];
$sql_query = "SELECT * FROM `tb_food` where idFood ='$id' ";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $fataFood=array(
            'platNumber' => $rows['platNumber']
        );
    }
    $message['status'] = "succes";
    $message['data'] = $fataFood;
}
else{
    $message['status'] = "echec";
}
echo json_encode($message);  
