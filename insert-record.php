<?php
header("content-type:application/json");
header("access-control-allow-origin:*");
header("access-control-allow-methods:PUT");
header("access-conrol-allow-headers:Content-Type , access-control-allow-origin , access-control-allow-methods, Authorization ,X-Requested-With");

include("config.php");

$data = json_decode(file_get_contents("php://input") , true);
$sname=$data["sname"];
$sage = $data["sage"];
$scity =$data["scity"];


$query = "INSERT INTO student( name , age, city) VALUES ('{$sname}',{$sage},'{$scity}')";

if(mysqli_query($conn ,$query))
{

    $output=array(
        "message" => "New Student record Inserted",
        "status"=>true
    );
    echo json_encode($output);
}else
{
    $output=array(
        "message" => "No Record Inserted",
        "status"=>false
    );
    echo json_encode($output);
}
?>