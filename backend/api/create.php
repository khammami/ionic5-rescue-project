<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$your_name=$data['name'];
$email_address=$data['email'];
$gender=$data['gender'];
$date_birth=$data['date_birth'];
$country=$data['country'];
$address=$data['address'];
$password=md5($data['password']);
$today = date("Y-m-d H:i:s"); 
if($your_name != null && $email_address != null && $gender != null && $date_birth != null 
    && $password != null && $address != null && $country != null){
    $sql_query = "select * from tb_users where email_address = '$email_address'";
    $result = mysqli_query($con,$sql_query);
    if(mysqli_num_rows($result)>0){
        $message['status'] = "Email existe";
    }
    else{
        $insert=mysqli_query($con,"INSERT INTO `tb_users` (`your_name`, `email_address`, `gender`,
         `date_birth`, `password`,`address`, `country`, `created_At`)
        VALUES ('$your_name', '$email_address', '$gender', '$date_birth','$password','$address', '$country', '$today')") ;
        if($insert)
        {$message['status'] = "succes";}
        else{
            $message['status'] = "Error";
        }
        
    }
    echo json_encode($message);
}

