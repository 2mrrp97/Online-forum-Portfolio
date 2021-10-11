<?php
    $pass_match = true ;
    $uname_valid = true ; 
    $register_success = false;
    $error = "";
    $missing_inputs = true;



    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require './partials/_dbconnect.php';
        require './partials/signup_validator.php';

        $uname = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $cpass = $_POST['confirm_pass'];

        $missing_inputs = validate_inputs($uname , $email , $pass , $cpass);
        $pass_match = validate_password($pass , $cpass);
        $uname_valid = uname_isvalid($uname , $connection);
        

        // insert the new user into db if validation check passes
        if($pass_match && $uname_valid && !$missing_inputs){
            $phash = password_hash($pass , PASSWORD_DEFAULT);
            $query = "INSERT INTO `users` (`uname` , `email` , `password` , `dt`) VALUES ('$uname' , '$email' , '$phash' , current_timestamp())";
            
            $res = mysqli_query($connection , $query);
            if($res){
                $register_success = true ;
            }
            else{
                $error = mysqli_error($connection);
                echo $error ;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginProject/signup</title>

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
        #footer {
            padding: 50px;
        }
    </style>
</head>
<body>
    <?php 
        require './partials/_navbar.php';
        
        session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            require './partials/already_logged_in_cant_signup.php';
            exit();
        }

        if($register_success){
            require './partials/_successful_registration.php';
            exit();
        }
        
    ?>

    <div class="customBox container my-5  col-md-6">
        <h1 class="text-center">
            Please enter your credentials to Register
        </h1>
        <!--  -->
        <form id="form" method="POST" action="./signup.php?catid=<?php
            echo isset($_GET['catid']) ? $_GET['catid'] : "";
        ?>" enctype = "multipart/form-data">

            <div class="mb-5 mt-5">
                <label for="username" class="form-label">UserName</label>
                <input name='username' maxlength = "30" type="text" class="form-control inputFields" id="username" placeholder="fatcat"
                    value="<?php 
                    if(isset($_POST['username']) && !$register_success){
                        echo $_POST['username'];
                    }
                ?>">
                <?php 
                    if(!$uname_valid){
                        echo '<div class="form-text" style = "color : red ;"> UserName already exists . Please use a different UserName. </div>';
                    }
                ?>
            </div>

            <div class="mb-5 mt-5">
                <label for="email" class="form-label">Email address</label>
                <input name='email' maxlength = "30" type="email" class="form-control inputFields" id="email"
                    placeholder="abcd@gmail.com" value="<?php 
                    if(isset($_POST['email']) && !$register_success){
                        echo $_POST['email'];
                    }
                ?>">

            </div>

            <div class="mb-5 mt-5">
                <label for="pass" class="form-label">Password</label>
                <input name='pass' maxlength = "30" type="password" class="form-control inputFields" id="pass"
                    placeholder="Enter your password" value="<?php 
                        if(isset($_POST['pass']) && !$register_success){
                            echo $_POST['pass'];
                        }
                    ?>">

                <div id="passwordHelp" class="form-text text-light">We'll never share your credentials with anyone else.</div>
            </div>

            <div class="mt-5">
                <label for="pass" class="form-label">Confirm Password</label>
                <input name='confirm_pass' maxlength =  "30" type="password" class="form-control inputFields" id="confirm_pass"
                    placeholder="Re-Enter your password" value="<?php 
                        if(isset($_POST['confirm_pass']) && !$register_success){
                            echo $_POST['confirm_pass'];
                        }
                    ?>">
                <div id="passwordHelp" class="form-text text-light">Make sure to enter the same password!</div>
                <?php 
                    if(!$pass_match){
                        echo '<div class="form-text" style = "color : red ;"> Passwords do not match ! Please re-enter the passwords carefully. </div>';
                    }
                ?>
            </div>
            
            <div class="mt-5">
                <label for="image" class="form-label">Upload Image</label>
                <input name='image' type="file" class="form-control inputFields" id="image">
                <div id="imageHelp" class="form-text text-light">Supported formats : jpg , jpeg , png (this does not work yet)</div>
        
                <img src="<?php 
                    if(isset($_POST['confirm_pass']) && !$register_success)
                    echo './images/user-default.jpg';
                ?>" alt="" height = " 100px" class = "my-2" onChange = "showimg()">
            </div>

            <div class = "mb-5">
                <?php
                    if($missing_inputs && $_SERVER['REQUEST_METHOD'] == 'POST'){
                        echo '<div class="form-text" style = "color : red ;"> Some fields are empty please fill them first to continue . </div>';
                    }
                ?> 
            </div>
            <button id="submitBtn" type="submit" class="btn btn-dark ">SignUp</button>
        </form>
    </div>
     <?php 
        require './partials/footer.php'
    ?>
</body>
</html>