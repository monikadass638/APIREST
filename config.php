<?php
$HostName="localhost";
$UserName= "root";
$Pass="";
$DbName="Students";
$conn= mysqli_connect($HostName,$UserName,$Pass,$DbName);
if(!$conn)
{
    die("Connection error");
}

?>