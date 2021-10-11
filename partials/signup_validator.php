<?php 

function validate_password($pass , $cpass){
    return $pass == $cpass ;
}

function uname_isvalid($uname , $connection){
    $query =  "SELECT `uname` from `userInfo`.`users` WHERE `uname` = '$uname'";
    $res = mysqli_query($connection , $query);
    $numrows = mysqli_num_rows($res);
    return $numrows == 0 ; 
}

function validate_inputs($uname , $pass , $email , $cpass){
    return $uname == "" or $pass == "" or $email == "" or $cpass == "";
}

?>