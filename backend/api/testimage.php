<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$imageData=$data['file'];
$id=$data['id'];
$path = $data['path'];
$deletepath=$data['imgtodelete'];


$actualpath = "/tutoriel/api/$path";
$Sql_Query = "UPDATE tb_users SET img='$actualpath' where id ='$id'";
mysqli_query($con,$Sql_Query);
$imageData=str_replace('data:image/jpeg;base64,','',$imageData);
$imageData=str_replace('data:image/jpg;base64,','',$imageData);
$imageData=str_replace(' ','+',$imageData);
$imageData=base64_decode($imageData);
file_put_contents($path,$imageData);

if (file_exists($deletepath)) {
    if($deletepath=="images/users/photo-profil-default.png"){
    }
    else{
        unlink($deletepath);
    }
  }
echo json_encode($message);


