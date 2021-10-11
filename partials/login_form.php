<div class="customBox container my-5  col-md-6">
    <h1 class="text-center">
        Please Login to continue
    </h1>
    <!--  -->
    <form id="form" method="POST" action="./login.php">
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

            <div id="passwordHelp" class="form-text text-light">We'll never share your credentials
                with anyone else.</div>

            <div class="form-text text-light">New User ? <a href="./signup.php"
                    style="color : rgb(1, 253, 1); text-decoration : none;"><strong>Click Here</strong></a> to
                register now !</div>

            <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && !$login_success){
                        echo '<div class="form-text" style = "color : red ;"> UserName or Password is incorrect. Please try again. </div>';
                    }
                ?>
        </div>
        <button id="submitBtn" type="submit" class="btn btn-dark ">Login</button>
    </form>
</div>