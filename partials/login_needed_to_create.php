<?php
    session_start();
    $login_success = false;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $uname = $_POST['username'];
        $pass = $_POST['pass'];

        $sql = "select * from `users` where `uname` = '$uname'";
        $res = mysqli_query($connection , $sql);
        $rows = mysqli_num_rows($res);

        if($rows == 1 && password_verify($pass , mysqli_fetch_assoc($res)['password'])){
            $login_success = true ;
            $_SESSION['loggedin'] = true ;
            $_SESSION['username'] = $uname;
            
            header("location: ./create_thread.php?catid=" . $category_id);
        }
        else{
            $login_success = false;
        }
    }
?>
<div class="container text-center" style="margin : 30vh auto;">
    <h1>You must be logged in to create a new Thread ! </h1>
    <h3><a href="#loginandpost" style = "text-decoration : none;"><i style="color : green ; ">Login</i></a> from here right now to post a new thread.</h3>
</div>
<div id="loginandpost" class="customBox container my-5  col-md-6  px-5 py-5" style="box-shadow : 2px 2px 10px black;">
    <h1 class="text-center">
        Login to continue
    </h1>
    <!--  -->
    <form id="form" method="POST" action="./create_thread.php?catid=<?php echo $category_id?>">
        <div class="mb-5 mt-5">
            <label for="username" class="form-label">UserName</label>
            <input name='username' maxlength="30" type="text" class="form-control inputFields" id="username"
                placeholder="fatcat" value="<?php 
                    if(isset($_POST['username']) && !$login_success){
                        echo $_POST['username'];
                    }
                ?>">

        </div>

        <div class="mb-5">
            <label for="pass" class="form-label">Password</label>
            <input name='pass' maxlength="30" type="password" class="form-control inputFields" id="pass"
                placeholder="Enter your password">

            <div id="passwordHelp" class="form-text text-light">We'll never share your credentials with anyone else.
            </div>

            <div class="form-text text-light">New User ? <a href="./signup.php?catid=<?php echo $category_id 
                ?>"> <i style="color : rgb(4, 255, 4);">Click Here</i></a> to register now !</div>

            <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && !$login_success){
                        echo '<div class="form-text" style = "color : red ;"> UserName or Password is incorrect. Please try again. </div>';
                    }
                ?>
        </div>
        <button id="submitBtn" type="submit" class="btn btn-dark ">Login</button>
    </form>
</div>