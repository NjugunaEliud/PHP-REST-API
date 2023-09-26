<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: GET'); 
header('Access-Control-Allow-Headers: Authorization, X-Requested-With'); 
include('function.php');
$RequestMethod = $_SERVER['REQUEST_METHOD'];
if($RequestMethod == 'POST'){
 $inputData = json_decode(file_get_contents('php://input'),true); // when not using a form 
 if(empty($inputData)){
    // $_POST['name'];
    $storeCustomer =storeCustomer( $_POST);
 }
 else{
 
    $storeCustomer =storeCustomer( $inputData);

 }
 echo $inputData['name'];
 
}
else{
    $data = [
        'status' => 405,
        'message' => $RequestMethod . " Method Not Allowed"
    ];
    
    header("HTTP/1.1 405 Method Not Allowed");
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>