<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$start=$data['start'];
$limit=$data['limit'];
$country=$data['country'];



if( $start === null || $limit === null || $country === null ){}else{
$resultUserCount = mysqli_query($con, "SELECT count(id) AS id FROM tb_users "); 
$rowUserCount = mysqli_fetch_assoc($resultUserCount); 
$count = $rowUserCount['id'];
if(intval($start)<$count){
    $sql_query = "SELECT * FROM `tb_users` where country='$country' ORDER BY rate DESC LIMIT $start,$limit;";
    $result = mysqli_query($con,$sql_query);
    if(mysqli_num_rows($result)>0){
        while($rows=mysqli_fetch_array($result)){
            $dataUser[]=array(
                'id' => $rows['id'],
                'name' => $rows['your_name'],
                'email' => $rows['email_address'],
                'gender' => $rows['gender'],
                'date_birth' => $rows['date_birth'],
                'password' => $rows['password'],
                'created_At' => $rows['created_At'],
                'rate' => $rows['rate'],

            );
        }
        $message['status'] = "succes";
        $message['data'] = $dataUser;
    }
    else{
        $message['status'] = "echec";
    }
    echo json_encode($message); 
}
else{
    $message['status'] = "echeccount";
echo json_encode($message); 
}
    
    }