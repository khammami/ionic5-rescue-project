<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$message=array();

$id=$_GET['userId'];
$sql_query = "SELECT * FROM `tb_cmd` where cuistotId='$id' ORDER BY time DESC ";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $clientId= $rows['clientId'];
       // echo $cuistotname;
        $sql_query1 = "SELECT `your_name` FROM `tb_users` where id='$clientId'";
    $result1 = mysqli_query($con,$sql_query1);
        while ($row1 = $result1->fetch_assoc()) {
            $clientname= $row1['your_name'];
            //echo $cuistotname;
        }
        $fataFood[]=array(
            //'clientId' => $rows['clientId'],
            'clientId' => $clientname,
            'clientAddress' => $rows['adresse'],
            'time' => $rows['time'],
            'listCmd' => unserialize($rows['listCmd']) ,
            'note' => $rows['note']
            //'cuistotname' =>$cuistotname

        );
    }

    $message['status'] = "succes";
    $message['data'] = $fataFood;
}
else{
    $message['status'] = "echec";
}
echo json_encode($message);  
