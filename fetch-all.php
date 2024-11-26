<?php
header('content-type:application/json');
header('acees-control-allow-origin:*');
header('access-control-allow-methods:GET');
include('config.php');
$query = "select * from student";
$result = mysqli_query($conn ,$query);
if(mysqli_num_rows($result) > 0)
{

    $output = mysqli_fetch_all($result ,MYSQLI_ASSOC);
    echo json_encode($output);
}else
{

    $output = array(
        "message" => "no data found",
        "status" => false
    );
    echo json_encode($output);
}

?>