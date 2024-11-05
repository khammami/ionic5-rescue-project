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
$id=$_GET['foodId'];

$imageData=$data['file'];
$path = $data['path'];
$imagetodelete=$data['imgtodelete'];
$verif=substr($imageData, 0, 4);
if($verif=="http"){
  $actualpath = "/tutoriel/api/$imagetodelete";
  $update=mysqli_query($con,"UPDATE tb_food SET name='$plat_name',description='$description',price='$price',
                    platNumber='$plat_number',type='$type',img='$actualpath' WHERE idFood='$id'") ;
}
else{
    $actualpath = "/tutoriel/api/$path";
    $imageData=str_replace('data:image/jpeg;base64,','',$imageData);
    $imageData=str_replace('data:image/jpg;base64,','',$imageData);
    $imageData=str_replace(' ','+',$imageData);
    $imageData=base64_decode($imageData);
    file_put_contents($path,$imageData);
    if (file_exists($imagetodelete)){
      if($imagetodelete=="images/foods/unknown-food.jpg"){}
      else{
        unlink($imagetodelete);
      }
    }
    $update=mysqli_query($con,"UPDATE tb_food SET name='$plat_name',description='$description',price='$price',
                    platNumber='$plat_number',type='$type',img='$actualpath' WHERE idFood='$id'") ;
}


  if($update)
  {
      $message['status'] = "Success";
  }
  else{
     $message['status'] = "Error";
  }
echo json_encode($message);
