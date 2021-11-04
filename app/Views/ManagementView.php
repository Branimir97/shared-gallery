<?php
  session_start();
  if(!isset($_SESSION['loggedIn'])){
    header('Location: /home');
  } 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/6aa1bd9ffa.js" crossorigin="anonymous"></script>

    <title>
      Shared gallery
    </title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/home">
        Shared gallery
        <i class="fas fa-camera-retro"></i>
      </a>
      <button class="navbar-toggler" type="button" 
              data-toggle="collapse" data-target="#navbarNavAltMarkup" 
              aria-controls="navbarNavAltMarkup" aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link" href="/home">
            Home
            <i class="fas fa-house-damage"></i>
          </a>
          <?php 
            if(isset($_SESSION['loggedIn'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Menu
                <i class="fas fa-chevron-circle-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">
                  Management
                  <i class="fas fa-images"></i>
                </a>
                <a class="dropdown-item" href="/account">
                  My account
                  <i class="fas fa-user-circle"></i>
                </a>
              </div>
            </li>
            <a class="nav-item nav-link" href="/logout">
              Logout
              <i class="fas fa-sign-in-alt"></i>
            </a>
            <?php else: ?>
            <a class="nav-item nav-link" href="/login">
              Login
              <i class="fas fa-sign-in-alt"></i>
            </a>
            <a class="nav-item nav-link" href="/register">
              Register
              <i class="fas fa-user-plus"></i>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
    
    <div class="container text-center mt-2">
      <p>
          You're logged in as 
          <strong>
              <?php echo $_SESSION['loggedInUser']; ?>
          </strong>
      </p>
      <hr>
      <div class="text-right">
        <a href="#" class="btn btn-success">
            Upload new photo
        </a>
      </div>
    </div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>