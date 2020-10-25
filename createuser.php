<?php
require __DIR__.'/database/userTo.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: *");


$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
$contentType = explode(';', $contentType)[0];

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'OPTIONS') == 0) {
    http_response_code(200);
}
else if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    http_response_code(405);
}
else if(strcasecmp($contentType, 'application/json') != 0){
    http_response_code(415);
}
else {
    $content = trim(file_get_contents("php://input"));
 
    $decoded = json_decode($content, true);
     
    if(!is_array($decoded)){
        echo 'Falha na disposição do JSON.';
    }
    else {
        try {
            userTo::createUser($decoded);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>