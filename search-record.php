<?php
header("content-type:application/json");
header("access-control-allow-origin:*");

include("config.php");

$data = json_decode(file_get_contents("php://input") , true);

$stu_search = $data["search"];
$query= "SELECT * from student Where name Like '%{$stu_search}%'";
$result = mysqli_query($conn ,$query);
if(mysqli_num_rows($result) > 0)
{

    $output = mysqli_fetch_all( $result ,MYSQLI_ASSOC);
    echo json_encode($output);
}else
{
    $output=array(
        "message" => "No search Found",
        "status"=>false
    );
    echo json_encode($output);
}
?>