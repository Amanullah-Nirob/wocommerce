<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD']='PUT'){
include_once '../config/database.php';
$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id)){
    $id=$data->id;
    $Date=$data->Date;
    $Expense_Type=$data->Expense_Type;
    $Payment_Type=$data->Payment_Type	;
    $Amount=$data->Amount;

    $sql="UPDATE expenses SET Date='$Date',Expense_Type='$Expense_Type',Payment_Type='$Payment_Type',Amount='$Amount' where id='$id'";
    if(mysqli_query($conn,$sql)){
        echo json_encode(array("message" => "expenses data updated"));
    
    }else {
        echo json_encode(array("message" => "expenses data not updated"));
    }
}else{
    echo json_encode(array("message" => "id not found"));
}
}

?>

