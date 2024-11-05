<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$plat_name=$data['plat_name'];
$description=$data['description'];
$price=$data['price'];
$type=$data['type'];
$plat_number=$data['plat_number'];
$id_cuistot=$data['id_cuistot'];
$today = date("Y-m-d H:i:s"); 

$imageData=$data['file'];
$path = $data['path'];

if($imageData == "assets/icon/unknown-food.jpg"){
    $insert=mysqli_query($con,"INSERT INTO `tb_food` ( `name`, `description`, `price`, `platNumber`,
    `type`, `created_At`, `userId`)
    VALUES ('$plat_name', '$description', '$price', '$plat_number', '$type', '$today', '$id_cuistot');") ;
}
else{
    $actualpath = "/tutoriel/api/$path";
    $imageData=str_replace('data:image/jpeg;base64,','',$imageData);
    $imageData=str_replace('data:image/jpg;base64,','',$imageData);
    $imageData=str_replace(' ','+',$imageData);
    $imageData=base64_decode($imageData);
    file_put_contents($path,$imageData);
            $insert=mysqli_query($con,"INSERT INTO `tb_food` ( `name`, `description`, `price`, `platNumber`,
            `type`, `created_At`, `userId`, `img`)
            VALUES ('$plat_name', '$description', '$price', '$plat_number', '$type', '$today', '$id_cuistot','$actualpath');") ;
}
        if($insert)
        {$message['status'] = "Success";}
        else{
            $message['status'] = "Error";
        }
    echo json_encode($message);
    
