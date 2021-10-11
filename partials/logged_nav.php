<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LoginProject</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethis">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsethis">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./protected.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./discussions.php">r/ThreadCategory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./index.php">About Me</a>
                </li>
                
            </ul>
            <form class="d-flex" action="./logout.php">
                <h5 style = "margin-right : 8px;" class = "mt-2 ">Welcome! <a id = "userHandle" href="#" style = "text-decoration : none;" ><?php echo $_SESSION['username']; ?></a>
                </h5>
                <button class="btn btn-outline-dark" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>