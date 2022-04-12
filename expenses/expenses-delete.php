<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD']='DELETE'){
include_once '../config/database.php';
$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id)){
    $id=$data->id;
    $name=$data->employee_name;

    $sql="DELETE FROM expenses where id='$id'";

    if(mysqli_query($conn,$sql)){
        echo json_encode(array("message" => "customer deleted"));
    }else {
        echo json_encode(array("message" => "customer not deleted"));
    }



}else{
    // echo json_encode(array("message" => "id not found"));
}



}

?>

