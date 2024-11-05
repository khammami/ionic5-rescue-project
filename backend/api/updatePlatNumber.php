<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$plat_number=$data['platNumber'];
$idFood=$data['idFood'];

$update=mysqli_query($con,"UPDATE tb_food SET platNumber='$plat_number' WHERE idFood='$idFood'") ;

  if($update)
  {$message['status'] = "Success";}
  else{
      $message['status'] = "Error";
  }
echo json_encode($message);
