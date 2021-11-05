<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
          crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/6aa1bd9ffa.js" crossorigin="anonymous"></script>

    <style>
          <?php include "css/account.css"?>
    </style>

    <title>
      Account details
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
              <a class="nav-link dropdown-toggle" href="#" 
                id="navbarDropdownMenuLink" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                Menu
                <i class="fas fa-chevron-circle-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/management">
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
      <?php
        if(isset($_SESSION['changedPassword'])) {
          echo '
            <p class="bg-success text-white p-2 mb-2">
              '.$_SESSION['changedPassword'].'
            </p>
          ';
          unset($_SESSION['changedPassword']);
        }
      ?>
      <div class="text-right mb-3">
        <a href="/account/password" class="btn btn-info mt-1">
          Change password
        </a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger mt-1" 
                data-toggle="modal" data-target="#modal">
          Delete account
        </button>    
      </div>
      <p>
        Account details
      </p>
      <div class="account-details">
          <small>
            Username:
          </small>
          <p>
            <strong>
              <?= $user->username ?>
            </strong>
          </p>
          <hr>
          <small>
            Email address:
          </small>
          <p>
            <strong>
              <?= $user->email ?>
            </strong>
          </p>
          <hr>
          <small>
            Account created:
          </small>
          <p>
            <strong>
              <?= $createdAt ?>
            </strong>
          </p>
      </div>
    </div>
   
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" 
         aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Delete account
            </h5>
            <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
              <span aria-hidden="true">
                &times;
              </span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure that you want to delete this account?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" 
                    data-dismiss="modal">
                    Close
            </button> 
            <form method="POST" action="/account/deleteAccount">
              <button name="submit" class="btn btn-danger">
                Delete account
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
            crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
            crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
            crossorigin="anonymous">
    </script>
  </body>
</html>