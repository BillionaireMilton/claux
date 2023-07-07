<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header('Access-Control-Allow-Method: DELETE');
// header('Access-Control-Allow-Credentials', true);
// header('Access-Control-Allow-Methods', 'GET,PUT,PATCH,POST,DELETE');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization X-Request-With");

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "DELETE") {
    $deleteVustomer = deleteCustomer($_GET);
    echo $deleteVustomer;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed',
    ];
    header('HTTP/1.0 405 Method not allowed');
    echo json_encode($data);
}
