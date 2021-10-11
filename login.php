<?php
    session_start();
    $alreadyloggedin = false;
    if(isset($_SESSION['loggedin'])){
        $alreadyloggedin = true ;
    }
    
    $login_success = false;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require './partials/_dbconnect.php';
        
        $uname = $_POST['username'];
        $pass = $_POST['pass'];

        $sql = "select * from `users` where `uname` = '$uname'";
        $res = mysqli_query($connection , $sql);
        $rows = mysqli_num_rows($res);

        if($rows == 1 && password_verify($pass , mysqli_fetch_assoc($res)['password'])){
            $login_success = true ;
            $_SESSION['loggedin'] = true ;
            $_SESSION['username'] = $uname;
            
            header("location: ./protected.php");
        }
        else{
            $login_success = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginProject/login</title>


    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" media="all" href="./cssFiles/styles.css"  type="text/css">
    <style>
        .customBox {
            padding: 50px 30px;
            background: rgb(66, 66, 66);
            box-shadow: 5px 5px 10px black;
            color : white ;
        }
        .nav-item {

            overflow: hidden;
            position: relative;
        }
        .nav-link::before {
            content: "";
            background: black;
            height: 20px;
            width: 0%;
            position: absolute;
            z-index: -1;
            transform: translateY(140%);
            transition: width 1s ease;
        }

        .nav-link:hover::before {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php 
        require './partials/_navbar.php';
        if($alreadyloggedin){
            require './partials/already_logged_in.php';
        }
        else{
            require './partials/login_form.php';
        }
    ?>


</body>

</html>