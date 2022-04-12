<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD']='POST'){
include_once '../config/database.php';
$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->id) 
){
   $sql="SELECT * FROM expenses WHERE id='$data->id'";
   $result=mysqli_query($conn,$sql);

   if(mysqli_num_rows($result)>0){
       $rows=array();

   while ($r = mysqli_fetch_assoc($result)) {
    $rows["result"][]=$r;
   }

   echo json_encode($rows);

   }else {
      // echo json_encode(array("message" => "data incomplete"));
   }
}
//   echo json_encode(array("message" => "data incomplete"));
}

?>

