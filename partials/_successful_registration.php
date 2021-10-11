<?php
    $red_link = 'login.php';
    if(isset($_GET['catid']) && $_GET['catid'] != "")
        $red_link = './create_thread.php?catid='.$_GET['catid'];
?>

<div class="container text-center" style="margin : 30vh auto;">
    <h1>You have Successfully Created your account</h1>
    <h3><a href="<?php
        echo $red_link;
    ?>" style = "text-decoration : none;"><i>Click here</i> </a>to continue !</h3>
</div>