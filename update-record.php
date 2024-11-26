<?php
header("content-type:application/json");
header("access-control-allow-origin:*");
header("access-control-allow-methods:PUT");
header("access-conrol-allow-headers:Content-Type , access-control-allow-origin , access-control-allow-methods, Authorization ,X-Requested-With");

include("config.php");

$data = json_decode(file_get_contents("php://input") , true);
$sid=$data["sid"];
$sname=$data["sname"];
$sage = $data["sage"];
$scity =$data["scity"];


 $query = "Update  student Set 
name = '{$sname}',
age = {$sage},
city = '{$scity}' Where id ={$sid}";

if(mysqli_query($conn ,$query))
{

    $output=array(
        "message" => " Student record Updated",
        "status"=>true
    );
    echo json_encode($output);
}else
{
    $output=array(
        "message" => "Student record Not updated",
        "status"=>false
    );
    echo json_encode($output);
}
?>