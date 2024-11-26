<?php
header("content-type:application/json");
header("access-control-allow-origin:*");
header("access-control-allow-methods:Delete");
header("access-conrol-allow-headers:Content-Type , access-control-allow-origin , access-control-allow-methods, Authorization ,X-Requested-With");

include("config.php");

$data = json_decode(file_get_contents("php://input") , true);
$sid=$data["sid"];



 $query = "DELETE From  student  Where id ={$sid}";

if(mysqli_query($conn ,$query))
{

    $output=array(
        "message" => " Student record Deleted",
        "status"=>true
    );
    echo json_encode($output);
}else
{
    $output=array(
        "message" => "Student record Not Deleted",
        "status"=>false
    );
    echo json_encode($output);
}
?>