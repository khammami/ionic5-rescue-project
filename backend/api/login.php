<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
/*$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$email_address=$data['email'];
$password=md5($data['password']);

if( $email_address != null&& $password != null){
    $sql_query = "select * from tb_users where email_address = '$email_address' and password = '$password'";
    $result = mysqli_query($con,$sql_query);
    if(mysqli_num_rows($result)>0){
        $logindata=mysqli_fetch_array($result);
        $dataUser=array(
            'id' => $logindata['id'],
            'your_name' => $logindata['your_name'],
            'email_address' => $logindata['email_address'],
            'gender' => $logindata['gender'],
            'date_birth' => $logindata['date_birth'],
            'password' => $logindata['password'],
            'created_At' => $logindata['created_At'],
            'country' => $logindata['country'],
            'address' => $logindata['address'],
            'rate' =>$logindata['rate'],
        );

        $message['status'] = "succes";
        $message['data'] = $dataUser;
    }
    else{
        $message['status'] = "echec";
    }
    echo json_encode($message);  
    }*/
    $to = "wkbaili@gmail.com";
    $subject = "Test mail";
    $message = "Hello! This is a test message.";
    $from = "kbailimanel310@gmail.com";
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);