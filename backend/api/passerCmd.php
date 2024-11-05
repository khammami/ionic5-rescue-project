<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$client=$data['client'];
$cuistot=$data['cuistot'];
$notes=$data['notes'];
$adresse=$data['addresse'];
$list=$data['list'];
//$today = date("Y-m-d H:i:s"); 
// Serialize the Array
$list_str = serialize($list);

// Insert record
$sql = "INSERT INTO tb_cmd(listCmd,note,clientId,cuistotId,adresse) VALUES('".$list_str."','$notes','$client','$cuistot','$adresse')";
$insert=mysqli_query($con,$sql); 
if($insert)
        {$message['status'] = "Success";}
        else{
            $message['status'] = "Error";
        }
    echo json_encode($message);

// Read record
/*$sql = mysqli_query($con,"SELECT * FROM tb_cmd");
while($row = mysqli_fetch_assoc($sql)){
   
   // Unserialize
   $arr_unserialize1 = unserialize($row['listCmd']);
   
   // Display
   echo "<pre>";
   print_r($arr_unserialize1);
   echo "</pre>";
}*/