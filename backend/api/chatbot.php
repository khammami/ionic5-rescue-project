<?php 
$command = escapeshellcmd('C:\xampp\htdocs\tutoriel\api\script\test.py'); 
$output = shell_exec($command); 
echo $output; 
?> 