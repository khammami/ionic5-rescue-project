<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$chat=$data['message'];
$type=$data['type'];
$user=$data['user'];

$sql = "INSERT INTO tb_chat(message,type,id_user) VALUES('$chat','$type','$user')";
$insert=mysqli_query($con,$sql); 
