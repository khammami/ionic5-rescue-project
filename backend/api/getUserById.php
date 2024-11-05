<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$message=array();
$id=$_GET['userId'];
$sql_query = "SELECT * FROM `tb_users` where id ='$id' ";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $fataFood=array(
            'id' => $rows['id'],
            'your_name' => $rows['your_name'],
            'email_address' => $rows['email_address'],
            'gender' => $rows['gender'],
            'date_birth' => $rows['date_birth'],
            'address' => $rows['address'],
            'country' => $rows['country'],
            'rate' => $rows['rate'],
            'img' => $rows['img']
        );
    }
    $message['status'] = "succes";
    $message['data'] = $fataFood;
}
else{
    $message['status'] = "echec";
}
echo json_encode($message);  
