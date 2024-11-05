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
$id=$data['user'];

$resultUserCount = mysqli_query($con, "SELECT count(id_user) AS id_user FROM tb_chat where id_user='$id'"); 
$rowUserCount = mysqli_fetch_assoc($resultUserCount); 
$count = $rowUserCount['id_user'];

$sql_query = "SELECT * FROM `tb_chat` where id_user ='$id' ORDER BY time DESC LIMIT $start,$limit";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $dataChat[]=array(
            'chat' => $rows['message'],
            'type' => $rows['type'],
            'time'=>substr($rows['time'], 0, -3),
            'max' =>$count

        );
    }
    $message['status'] = "succes";
    $message['data'] = $dataChat;
}
else{
    $message['status'] = "echec";
}
echo json_encode($message);  
