<?php
require __DIR__.'/database/userTo.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: *");


if(strcasecmp($_SERVER['REQUEST_METHOD'], 'OPTIONS') == 0) {
    http_response_code(200);
}
else if(strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') != 0){
    http_response_code(405);
}
else {
    try {
        echo userTo::getUsers();
    }
    catch(Exception $e) {
        echo $e->getMessage();
    }
}
?>