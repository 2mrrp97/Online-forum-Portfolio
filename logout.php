<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        unset($_COOKIE);
        session_unset();
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" media="all" href="./cssFiles/styles.css"  type="text/css">
    <style>
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
        #footer {
            padding: 50px;
        }
    </style>
</head>
<body>
    <div class="container" style ="margin : 40vh auto;">
        <h1 class = "text-center">You Have Been Logged Out</h1>
        <h3 class = "text-center"><a href="./login.php" style = "text-decoration : none;"><i>Click Here</i></a> to Login again!</h3>
    </div>
     <?php 
        require './partials/footer.php'
    ?>
</body>
</html>