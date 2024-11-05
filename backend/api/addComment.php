<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
$name=$data['name'];
$comment=$data['comment'];
$idFood=$data['idFood'];
$today = date("Y-m-d H:i:s"); 

        $insert=mysqli_query($con,"INSERT INTO `tb_comment` ( `createur`, `commentaire`, `time`, `idFood`)
         VALUES ('$name', '$comment', '$today', '$idFood');") ;
        if($insert)
        {$message['status'] = "success";}
        else{
            $message['status'] = "Error";
        }
    echo json_encode($message);
    
