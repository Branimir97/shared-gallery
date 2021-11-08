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

    <!-- CSS -->
    <style>
          <?php include "css/auth.css"?>
    </style>

    <!-- Icon -->
    <link rel="icon" href="../Public/Icons/logo.png">
    
    <title>
      Login
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
          <a class="nav-item nav-link active" href="/login">
            Login
            <i class="fas fa-sign-in-alt"></i>
          </a>
          <a class="nav-item nav-link" href="/register">
            Register
            <i class="fas fa-user-plus"></i>
          </a>
        </div>
      </div>
    </nav>

    <div class="container text-center pt-2 mb-3">
      <?php
        if(isset($_SESSION['registered'])) {
          echo '
            <p class="bg-success text-white p-2 mb-2">
              '.$_SESSION['registered'].'
            </p>
          ';
        }
        if(isset($_SESSION['errors'])) {
          foreach($_SESSION['errors'] as $error) {
            echo '
              <p class="bg-danger text-white p-2 mb-2">
                '.$error.'
              </p>
            ';
          }
        }
        session_unset();
      ?>
      <h2 class="p-3">
        Login form
      </h2>
      <i class="fas fa-sign-in-alt"></i>
      <form action="/login/auth" method="POST">
        <div class="form-group">
          <label for="username">
            Username/Email
          </label>
          <input type="text" class="form-control" id="username" name="username"
                placeholder="Your username or email" required
                <?php if (isset($_COOKIE['username'])): ?>)
                  value="<?= $_COOKIE['username'] ?>"
                >
                <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="password">
            Password
          </label>
          <input type="password" class="form-control" id="password" name="password"
                placeholder="Your password" required>
        </div>
        <div class="form-check mt-2">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberMe"
          <?php if (isset($_COOKIE['username'])): ?>)
                  checked
                <?php endif; ?>
          >
          <label class="form-check-label" for="exampleCheck1">
            Remember me
          </label>
        </div>
        <button type="submit" name="submit" class="btn btn-success mt-2 mb-1">
          Login
        </button>
      </form>
      <p class="mt-2">
        No account? Register 
        <a href="/register">
          here
        </a>.
      </p>
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