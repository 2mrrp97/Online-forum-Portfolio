<?php
    require './partials/_dbconnect.php';

    
    session_start();
    $session_active = true;
    $user_id = "";
    if(!isset($_SESSION['loggedin'])){
        $session_active = false;
        session_destroy();
    }
    else
        $user_id = $_SESSION['username'];


    $thread_category = "all";
    $jumbo_head = "All Threads";
    $desc = "Welcome to our forum ! So , feel free to explore , create and innovate ! ALso please follow the forum rules .";
    


    // dynamically populate the jumbo tron text as per the get req
    if(isset($_GET['catid'])){
        $thread_category = $_GET['catid'];
        $sql = "select * from `threadcategory` where  `threadcategory`.`id` = '$thread_category'";
        
        $res = mysqli_query($connection , $sql);
        $row = mysqli_fetch_assoc($res);
        $jumbo_head = $row['catName'];
        $desc = $row['description'];
    }

    
    //  if we have set sort threads by type from post req to server send a get req back with the following 
    // catrgories set so we can handle them during get req .
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sort_by = isset($_POST['sort_type']) ? $_POST['sort_type'] : "" ;

        if(isset($_POST['phrase']))
            $phrase = $_POST['phrase'] ;
        else if(isset($_GET['phrase']))
            $phrase = $_GET['phrase'] ;
        else 
            $phrase = "" ;

        header("location: ./threads.php?catid=".$thread_category."&sortby=".$sort_by."&phrase=".$phrase);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginProject/
        <?php echo $thread_category?>
    </title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>


    <link rel="stylesheet" href="./partials/styles.css">
    <style>
        .questions {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding : 5px;
            min-height : 100px;
        }
        .questions:hover{
            box-shadow : 2px 2px 10px black;
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
            transition: width 1.5s ease;
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

    <div class="p-5 mb-4  rounded-3 bg-light">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Welcome to our
                <?php echo $jumbo_head ?> Forum
            </h1>
            <p class="col-md-8 fs-4">
                <?php echo $desc ?>
            </p>
            <a href="./create_thread.php?catid=<?php echo $thread_category ?>" class = "btn btn-dark">Create new Thread</a>
        </div>
    </div>

    
        <div class="container my-5">
            <form class="searchBox" method = "post" action = " <?php echo $_SERVER['REQUEST_URI']; ?>">
                <label for="categorySearch" class="fw-bold">Browse Question by phrase : </label>
                <input class="mx-3" type="text" name="phrase" id="phrase">
                <button type="submit" class="btn btn-sm btn-outline-dark">Search</button>
            </form>
        </div>
        <div class="container">
            <form class="searchBox" method = "post" action = "<?php echo $_SERVER['REQUEST_URI']; ?>">
                <label for="categorySearch" class="fw-bold">Sort by :</label>
                <select name="sort_type" id="">
                    <option value="most-recent">Most recent</option>
                    <option value="least-recent">Least recent</option>
                </select>
                <button type="submit" class="mx-2 btn btn-sm btn-outline-dark">Apply</button>
            </form>
        </div>


    <div class="container my-5">
        <h1>Threads in this Category: </h1>
        <hr>

        
        <?php
        // default sql for fetching thread from db 
            $keyword = isset($_GET['phrase']) ? $_GET['phrase'] : "" ;
            $sql = "SELECT * from `threadlist` " . ($thread_category == "all" ? "" : "where `category_id` = '$thread_category'") . ($keyword != "" ? " AND `question_` LIKE '%".$keyword."%' " : "");

            
            // check criteria of sort type  
            if(isset($_GET['sortby'])){

                if($_GET['sortby'] == 'least-recent')
                    $sql = "SELECT * from `threadlist` " . ($thread_category == "all" ? "" : "where `category_id` = '$thread_category'") . ($keyword != "" ? " AND `question_` LIKE '%".$keyword."%' " : "") . "order by `posted_on` asc " ;

                else if($_GET['sortby'] == 'most-recent')
                    $sql = "SELECT * from `threadlist` " . ($thread_category == "all" ? "" : "where `category_id` = '$thread_category'") . ($keyword != "" ? " AND `question_` LIKE '%".$keyword."%' " : "") . "order by `posted_on` desc " ;
            }
            
            $res = mysqli_query($connection , $sql);
            $num = mysqli_num_rows($res);
            
            if($num == 0){
                if($keyword != ""){
                    echo '<div class="container text-center" style="margin : 30vh auto;">
                            <h2>Oops ! No Threads found ! Please refine your search Keyword OR <a href ="./create_thread.php?catid='.$thread_category.'" style = "text-decoration : none;">
                            <i><strong>Post</strong></i></a> the First Thread with this keyword!
                            OR 
                            <a href ="./threads.php?catid='.$thread_category.'" style = "text-decoration : none;">
                            <i><strong>Go Back</strong></i></a>
                            </h2>
                        </div>';
                }
                else 
                    require './partials/no_threads_found.php';
                
                exit();
            }

            // 

            while($row = mysqli_fetch_assoc($res)){
                $question = $row['question_'];
                $question_desc = $row['description_'];
                $thread_id = $row['thread_id_'];
                $po = $row['posted_on'];
                echo '<a href="./questions.php?catid='.$thread_category.'&tid='.$thread_id.'" style = "color : black; text-decoration : none;">
                    <div class="questions container my-2 py-2 bg-light" style = "word-wrap : break-word;">
                        <div class="qpp col-md-1 col-sm-1"><img src="./images/user-default.jpg" alt="profile pic"
                                style="height :3rem;"></div>
                        <div class="content col-md-10 col-sm-8">
                            <div class = "fw-bold"> posted on : '. $po .'</div>
                            <div class="fw-bold"><i style="text-decoration : underline;">Question:</i> '
                            . substr($question , 0 , min(70 , strlen($question)))  .' ...
                            </div>
                            <div><i class="fw-bold" style="text-decoration : underline; ">Description:</i> '. 
                            substr($question_desc , 0 , min(255 , strlen($question_desc))) . ' ... </div>
                        </div>
                    </div>
                </a>';
            }
        ?>
    </div>
</body>

</html>