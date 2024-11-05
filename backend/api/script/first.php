<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$input=file_get_contents('php://input');
$data=json_decode($input,true);
$message=array();
    $qst=$data['qst'];
    $command = escapeshellcmd('python test.py '.$qst);
    $output = shell_exec($command);
    //echo $output;
    $chatbot=explode("@",$output);
    $message['chatbot'] = substr($chatbot[1],0,-1);
    echo json_encode($message);

?>