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
$foodId=$data['foodId'];

if( $start === null || $limit === null || $foodId === null ){}else{

        $resultUserCount = mysqli_query($con, "SELECT count(createur) AS createur FROM tb_comment WHERE idFood='$foodId'"); 
        $rowUserCount = mysqli_fetch_assoc($resultUserCount); 
        $count = $rowUserCount['createur'];
    if(intval($start)<$count){

    $sql_query = "SELECT * FROM `tb_comment` where idFood ='$foodId' ORDER BY time DESC LIMIT $start,$limit;";
    $result = mysqli_query($con,$sql_query);
    if(mysqli_num_rows($result)>0){
        while($rows=mysqli_fetch_array($result)){
            $dataUser[]=array(
                'id' =>$rows['id_comment'],
                'createur' => $rows['createur'],
                'time' => $rows['time'],
                'commentaire' => $rows['commentaire'],
                'max' => $count
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