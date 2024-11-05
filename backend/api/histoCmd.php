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
$id=$data['clientId'];

$resultUserCount = mysqli_query($con, "SELECT count(clientId) AS clientId FROM tb_cmd where clientId='$id'"); 
$rowUserCount = mysqli_fetch_assoc($resultUserCount); 
$count = $rowUserCount['clientId'];
    if(intval($start)<$count){
        $sql_query = "SELECT * FROM `tb_cmd` where clientId='$id' ORDER BY time DESC LIMIT $start,$limit";
        $result = mysqli_query($con,$sql_query);
        if(mysqli_num_rows($result)>0){
            while($rows=mysqli_fetch_array($result)){
                $cuistotid= $rows['cuistotId'];
               // echo $cuistotname;
                $sql_query1 = "SELECT `your_name` FROM `tb_users` where id='$cuistotid'";
                $result1 = mysqli_query($con,$sql_query1);
                while ($row1 = $result1->fetch_assoc()) {
                    $cuistotname= $row1['your_name'];
                    //echo $cuistotname;
                }
                $fataFood[]=array(
                    'idCuistot' => $rows['cuistotId'],
                    'time' => $rows['time'],
                    'listCmd' => unserialize($rows['listCmd']) ,
                    'cuistotname' =>$cuistotname
        
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



