<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "userinfo";

$connection = mysqli_connect($server , $username , $password , $database);

if(!$connection){
    die("Error " . mysqli_connect_error());
}

?>
