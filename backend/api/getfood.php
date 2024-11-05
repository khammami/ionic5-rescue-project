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
$id=$data['userId'];

$resultUserCount = mysqli_query($con, "SELECT count(userId) AS userId FROM tb_food where userId='$id'"); 
$rowUserCount = mysqli_fetch_assoc($resultUserCount); 
$count = $rowUserCount['userId'];
    if(intval($start)<$count){
        $sql_query = "SELECT * FROM `tb_food` where userId='$id' ORDER BY created_At DESC LIMIT $start,$limit";
        $result = mysqli_query($con,$sql_query);
        if(mysqli_num_rows($result)>0){
            while($rows=mysqli_fetch_array($result)){
                $fataFood[]=array(
                    'idFood' => $rows['idFood'],
                    'name' => $rows['name'],
                    'description' => $rows['description'],
                    'price' => $rows['price'],
                    'platNumber' => $rows['platNumber'],
                    'type' => $rows['type'],
                    'max' => $count,
                    'created_At' => $rows['created_At'],
                    'img' => $rows['img'],
                    'userId' => $rows['userId'],
        
                );
            }
            $message['status'] = "succes";
            $message['data'] = $fataFood;
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

