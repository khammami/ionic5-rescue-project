<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include "config.php";
$message=array();
$dec=array();
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$id=$data['userId'];
$time=$data['time'];
$rate=$data['rate'];
$foodId=$data['foodId'];
$sommeRate = 0;
$sql_query = "SELECT listCmd,cuistotId FROM `tb_cmd` where clientId='$id' && time='$time'  ";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_array($result)){
        $cuistotId=($rows['cuistotId']);
        $list= unserialize($rows['listCmd']);
        
        for ($index = 0; $index < count($list); $index++){
            $dec=explode("@",$list[$index]);
            if($dec[0]==$foodId){
                //$sommeRateOld=(intval(substr($list[$index], -1))) ;
                $list[$index]=substr_replace($list[$index],$rate, -1);
            }
            $sommeRate=$sommeRate+(intval(explode("@",$list[$index])[3])) ;
        }
        $sommeRate=$sommeRate/(count($list));
        //echo($sommeRate);
        $newlist=serialize($list);
        $update=mysqli_query($con,"UPDATE tb_cmd SET listCmd='$newlist' WHERE clientId='$id' && time='$time'") ;
        $updatePlus=mysqli_query($con,"UPDATE tb_cmd SET cmdRate='$sommeRate' WHERE clientId='$id' && time='$time'") ;
        $resultUser = mysqli_query($con, "SELECT SUM(cmdRate) AS cmdRate_sum FROM tb_cmd WHERE cuistotId='$cuistotId'"); 
        $rowUser = mysqli_fetch_assoc($resultUser); 
        $sum = $rowUser['cmdRate_sum'];
        //echo($sum);
        $resultUserCount = mysqli_query($con, "SELECT count(cmdRate) AS cmdRate_sum FROM tb_cmd WHERE cuistotId='$cuistotId'"); 
        $rowUserCount = mysqli_fetch_assoc($resultUserCount); 
        $count = $rowUserCount['cmdRate_sum'];
        //echo($count);
        $rate=$sum/$count;
        $updateRateCuistot=mysqli_query($con,"UPDATE tb_users SET rate='$rate' WHERE id='$cuistotId'") ;
    }
    $message['status'] = "succes";
}

else{
    $message['status'] = "echec";
}
echo json_encode($message);  
