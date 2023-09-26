<?php
require('../include/dbconnect.php');
function error422($message){
    $data = [
        'status' => 422,
        'message' => $message 
    ];
    
    header("HTTP/1.1 422 Unprosessable Entity");
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}
function  storeCustomer($customerInput){
    global $conn;
    $name = mysqli_real_escape_string($conn , $customerInput['name']);
    $email = mysqli_real_escape_string($conn , $customerInput['email']);
    $age = mysqli_real_escape_string($conn , $customerInput['age']);
     if(empty(trim($name))){
        return error422("Enter your name");
     }
     elseif(empty(trim($email))){
        return error422("Enter your email address");

     }
     elseif(empty(trim($age))){
        return error422("Enter your age");

     }
     else{
        $query = "insert into customer (name, email, age) values('$name', '$email','$age')";
        $result = mysqli_query($conn, $query);
        if($result){
            $data = [
                'status' => 201,
                'message' => $RequestMethod . " Customer created"
            ];
            
            header("HTTP/1.1 201 Internal Server Error");
            header('Content-Type: application/json');
            return json_encode($data);
        }
        else{
            $data = [
                'status' => 500,
                'message' => $RequestMethod . " Created"
            ];
            
            header("HTTP/1.1 500 Internal Server Error");
            header('Content-Type: application/json');
            return json_encode($data);
        }
     }

}

function getCustomerList(){
$RequestMethod = $_SERVER['REQUEST_METHOD'];
global $conn;
$query = 'select * from customer';
$sql = mysqli_query($conn,$query );
if($sql){
    if(mysqli_num_rows($sql)>0){
      $results = mysqli_fetch_all($sql , MYSQLI_ASSOC);
      $data = [
        'status' => 200,
        'message' => $RequestMethod . "Customer list fetched successfuly",
        'data'=>$results
    ];
    
    header("HTTP/1.1 200 Ok");
    header('Content-Type: application/json');
    return json_encode($data); 
    }
    else{
        $data = [
            'status' => 404,
            'message' => $RequestMethod . " No customer Found"
        ];
        
        header("HTTP/1.1 404   No customer Found");
        header('Content-Type: application/json');
        return json_encode($data); 
    }

}else{
    $data = [
        'status' => 500,
        'message' => $RequestMethod . " Internal Server Error"
    ];
    
    header("HTTP/1.1 500 Internal Server Error");
    header('Content-Type: application/json');
    return json_encode($data);
}
}

function getCustomer($customerParams) {
    global $conn;
    
    if ($customerParams == null) {
        return error422("Enter your customer id");
    }
    
    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $query = "SELECT * FROM customer WHERE id = '$customerId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => $RequestMethod . " Customer fetched",
                'data' => $res
            ];

            header("HTTP/1.1 200 Ok");
            header('Content-Type: application/json');
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => $RequestMethod . " No customer found"
            ];

            header("HTTP/1.1 404 Not Found");
            header('Content-Type: application/json');
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => $RequestMethod . " Internal Server Error"
        ];

        header("HTTP/1.1 500 Internal Server Error");
        header('Content-Type: application/json');
        return json_encode($data);
    }
}



?>