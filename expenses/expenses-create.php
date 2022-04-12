<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

if($_SERVER['REQUEST_METHOD']==='POST'){

// get database connection
include_once '../config/database.php';
// instantiate product object
$database = new Database();
$db = $database->getConnection();
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
$query = "INSERT INTO expenses (Date,Expense_Type,Payment_Type,Amount,month,week) VALUES ('$data->Date','$data->Expense_Type','$data->Payment_Type','$data->Amount','$data->month','$data->week')";
    // create the product
    if(mysqli_query($db,$query)){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "expenses was created."));
}                       
 // if unable to create the product, tell the user
  else{
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create expenses info."));
    }
}