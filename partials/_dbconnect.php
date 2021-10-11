<?php 

$server = "remotemysql.com";
$username = "LX5hXPZNkA";
$password = "qrPAcnCNLK";
$database = "LX5hXPZNkA";

$connection = mysqli_connect($server , $username , $password , $database);

if(!$connection){
    die("Error " . mysqli_connect_error());
}

?>
