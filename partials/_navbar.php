<nav class="navbar navbar-expand-lg navbar-light bg-transparent">

  <div class=" container-fluid">
    <a class="navbar-brand" href="#">LoginProject</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethis">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsethis">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="./protected.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./discussions.php">r/ThreadCategory</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./index.php">About Me</a>
            </li>
            
          </ul>

          <div class="d-flex">
            <form class="" action = "./login.php">  
              <button class="btn btn-outline-dark" type="submit">Login</button>
            </form>
            <form class=" mx-2" action = "./signup.php">
              <button class="btn btn-outline-dark" type="submit">signUp</button>
            </form>
          </div>
    </div>
  </div>
</nav>