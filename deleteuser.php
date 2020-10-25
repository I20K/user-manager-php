<?php
include_once('/database/to/userTo.php');

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request deve ser post.');
}
 
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content-type deve ser: application/json');
}
 
$content = trim(file_get_contents("php://input"));
 
$decoded = json_decode($content, true);
 
if(!is_array($decoded)){
    throw new Exception('JSON invalido.');
}


try {
    userTo::deleteUser($decoded["id"]);
}
catch(Exception $e) {
    echo $e->getMessage();
}
?>