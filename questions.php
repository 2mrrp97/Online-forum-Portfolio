<?php

    $login_success = false;
    $missing_inputs = true;
    $pass_match = true;
    $uname_valid = true;
    require './partials/_dbconnect.php';
    session_start();
    
    // if not logged in and post req is for login then login
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pass'])){
        $uname = $_POST['username'];
        $pass = $_POST['pass'];

        $sql = "select * from `users` where `uname` = '$uname'";
        $res = mysqli_query($connection , $sql);
        $rows = mysqli_num_rows($res);

        if($rows == 1 && password_verify($pass , mysqli_fetch_assoc($res)['password'])){
            $login_success = true ;

            // if session not already running , then run it to check session vars 
            $_SESSION['loggedin'] = true ;
            $_SESSION['username'] = $uname;
        }
    }

    /// IF REQUEST METHOD IS TO POST A COMMENT 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postComment'])){
        $owner = $_SESSION['username'];
        $thread_id = $_GET['tid'];
        $cmt_body = $_POST['postComment'];

        if($cmt_body != ""){
            $sql = "INSERT INTO `comment_table` (`comment_id` , `thread_id` , `owner_id` , `cmt_body` , `posted_on`) VALUES ('' , '$thread_id' , '$owner' , '$cmt_body' , current_timestamp())";

            $res = mysqli_query($connection , $sql);
            if($res){
                unset($_POST['postComment']);
                header("location: ".$_SERVER['REQUEST_URI']."&inserted=1");
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
    <title>LoginProject/viewCurrentThread</title>

    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>


    <link rel="stylesheet" media="all" href="./cssFiles/styles.css"  type="text/css">

    <style>
        .commentPoster {
            display: flex;
            flex-direction: column;
        }

        .customBox {
            padding: 50px 30px;
            background: rgb(66, 66, 66);
            box-shadow: 5px 5px 10px black;
            color: white;
        }

        .comment {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 15px;
            background: rgb(204, 203, 203);
            border-radius : 5px;
            min-height : 80px;
        }

        .content {
            display: inline-block;
            min-width: 70vw;
        }

        .qpp {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thread {
            background: rgb(204, 203, 203);
            padding: 20px;
            box-shadow: 5px 5px 10px black;
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
       // DECIDE WHICH NAV TO SHOW 
        if(!isset($_SESSION['loggedin'])){
            require './partials/_navbar.php';
        } 
        else {
            require './partials/logged_nav.php';
        }
        
        // WE JUST SIGNED UP SO WE CAN POST A COMMENT SO SHOW THIS ALERT 
        if(isset($_GET['signupstatus'])){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You have successfully created your account now you can login from below and post a comment !.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <?php
    // fetch the details of the current thread so we can render it dynamically 
        $tid = $_GET['tid'];
        $sql = "SELECT * FROM `threadlist` where `thread_id_` = '$tid'";
        $row = mysqli_fetch_assoc(mysqli_query($connection , $sql));
        
        // php trick to get the current url i am on 
        $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    ?>

    <!-- DYNAMICALLY POPULATE THE thread OWNER , thread AND thread DESC SECTION -->
    <div class="thread container my-5" style="word-wrap : break-word;">
        <h5 class="my-3"> Posted by :
            <a href="#">
                <?php echo $row['owner_id_']; ?>
            </a>
            on
            <?php echo $row['posted_on'] ; ?>
        </h5>
        <?php 
            echo '<h3> Question : '.$row['question_'].' ? </h3>';
            echo '<br>';
            echo $row['description_']; 
        ?>

    </div>

    <div class="container">
        <hr>
    </div>
    <div class="container">
        <?php

        // IF SUCCESS IN POSTING THEN WE SEND A GET REQ WITH INSERTED = 1 TO SHOW THIS  
            if(isset($_GET['inserted'])){
                echo '<div class="container text-center" style="margin : 30vh auto;">
                            <h3>Your comment has been succesfully posted ! </h3>
                            <h5><a href="./questions.php?catid='.$_GET['catid'].'&tid='.$_GET['tid'].'" style = "text-decoration : none;"><i>Click here</i> </a>to go back .</h5>
                        </div>';
                exit();
            }
        // ELSE IF POST IS SET BUT DIDNT INSERT SUCCESSFULLY THEN SHOW THIS ERRORM MSSG 
            else if(isset($_POST['postComment']) && !isset($_GET['inserted'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> Comment body must not be empty .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        ?>
    </div>

    <form id ="postCommentContainer" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"
        class="mb-3">
        <?php
        // WE ALLOW TO POST COMMENT ONLY IF USER IS LOGGED IN , SO CHECK IT 
            if(isset($_SESSION['loggedin'])){
                echo '<div class="container commentPoster">
                        <label for="postComment">Post a Comment: </label>
                        <textarea class = "my-2" name="postComment" id="postComment" cols="50" rows="5" placeholder = "Write your comment here..."></textarea>
                        <button class = "my-2 btn btn-dark" style = "width : 7rem;" type = "submit">Post</button>
                    </div>';
            }
            // ASK TO LOGIN FOR POSTING AND RENDER THIS INSTEAD 
            else{
                echo '<div class = "container mt-4" >You must <a href = "#logintopost">Login</a> first ,  to post a Comment in this Thread ! </div>';
                require './partials/login_to_comment.php';
            }
        ?>
    </form>
    <div class="container my-5">
        <h4>Browse Comments : </h4>
        <hr>
    </div>



    <?php
    // GET THE COMMENTS POSTED IN THIS THREAD FROM DATABSE
        $tid = $_GET['tid'];
        $sql = "SELECT * from `comment_table` where `thread_id` = '$tid'";
        $res = mysqli_query($connection , $sql);
        $num = mysqli_num_rows($res);

        if($num == 0){
            echo '<div class="container text-center" style="margin : 30vh auto;">
            <h2>Oops ! No Comments found ! Why don\'t you be the one to <a href ="#postCommentContainer" style = "text-decoration : none;"><i><strong>Post</strong></i></a> the First Comment?</h2>
            </div>';

            exit();
        }
        while($num-- > 0 && $row = mysqli_fetch_assoc($res)){
            echo '<div id="'.$row['comment_id'].'" class="comment container my-3 py-2 " style =  "word-wrap : break-word;">
                    <div class="qpp mx-2 col-md-1 col-sm-1"><img src="./images/user-default.jpg" alt="profile pic"style="height :3rem;"></div>
                    <div class="content col-md-10 col-sm-8">
                        <div class="fw-bold">By <a href = "#1" style="text-decoration : underline;">'
                        .$row['owner_id'].'</a> on '.$row['posted_on'].' </div>
                        <div>'.$row['cmt_body'].'</div>
                </div>
            </div>';
        }
    ?>
     <?php 
        require './partials/footer.php'
    ?>
</body>

</html>