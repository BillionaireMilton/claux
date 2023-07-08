<?php
error_reporting(0); //

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header('Access-Control-Allow-Method: POST');
// header('Access-Control-Allow-Credentials', true);
// header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization X-Request-With");

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST"){

    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)){
        $storeCustomer = storeCustomer($_POST); // form data
    } else {
        $storeCustomer = storeCustomer($inputData); // raw data
    }

    echo  $storeCustomer;

} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method not allowed',
    ];
    header('HTTP/1.0 405 Method not allowed');
    echo json_encode($data);
}