<?php
    session_start();
    $session_active = true;
    if(!isset($_SESSION['loggedin'])){
        $session_active = false;
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginProject/discussions</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>


    <link rel="stylesheet" media="all" href="./cssFiles/styles.css"  type="text/css">
    <style>
        .card:hover {
            box-shadow: 2px 2px 15px black;
        }

        .popThreads {
            display: inline-block;
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
        #footer {
            padding: 50px;
        }
    </style>
</head>

<body>
    <?php 
        if(!$session_active){
            require './partials/_navbar.php';
        }
        else {
            require './partials/logged_nav.php';
        }
    ?>
    <h1 class='text-center my-5' style="text-decoration : underline ;"> -: Select a Thread Category :-</h1>

    <div class="container my-3" style="padding-left: 3rem;">
        <h5 style=" display : inline-block;">Popular Categories : </h5>
        <a href="./threads.php?catid=webDev" class="btn btn-sm btn-success" >Web Development</a>
        <a href="./threads.php?catid=androidDev" class="btn btn-sm btn-success">Android Development</a>
        <a href="./threads.php?catid=ml" class="btn btn-sm btn-success">Machine Learning</a>
    </div>

    <div id="cardContainer" class="container-fluid"
        style="display : flex ; flex-direction : row ; flex-wrap : wrap ; justify-content : center;">
    </div>
     <?php 
        require './partials/footer.php'
    ?>
</body>
<script src="./js_scripts/populate_cards.js"></script>
</html>