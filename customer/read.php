<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: GET'); 
header('Access-Control-Allow-Headers: Authorization, X-Requested-With'); 
include('function.php');
$RequestMethod = $_SERVER['REQUEST_METHOD'];

if ($RequestMethod === 'GET') {

    if(isset($_GET['id'])){
        $customer = getCustomer($_GET);
        echo $customer;

    }else{
        $customerList = getCustomerList();
        echo $customerList;
    
    }
   
    
}else{
    $data = [
        'status' => 405,
        'message' => $RequestMethod . " Method Not Allowed"
    ];
    
    header("HTTP/1.1 405  Method Not Allowed");
    header('Content-Type: application/json');
    echo json_encode($data);
}    
?>