
    <div id="logintopost" class="container-fluid">
        <form id="loginform_" action="<?php echo $current_link ?>" method="post">
            <div class="customBox container my-5  col-md-6">
                <h1 class="text-center">
                    Please Login to Post a comment
                </h1>
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
                    
                    <div class="form-text text-light">New User ? <a href="./signup_and_comeback.php?catid=<?php echo $row['category_id'] ?>&tid=<?php echo $row['thread_id_'] ?>"
                    style="color : rgb(1, 253, 1); text-decoration : none;"><strong>Click Here</strong></a> to register now !</div>
                    <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST' && !$login_success){
                                echo '<div class="form-text" style = "color : red ;"> UserName or Password is incorrect. Please try again. </div>';
                            }
                        ?>
                </div>
                <button id="submitBtn" type="submit" class="btn btn-dark ">Login</button>

            </div>
        </form>
    </div>