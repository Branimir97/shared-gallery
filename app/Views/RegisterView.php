<!doctype html>
<html lang="en">
  <head>
      
    <!-- CSS -->
    <style>
          <?php include "css/auth.css"?>
    </style>
    
    <title>
      Register
    </title>
  </head>
  <body>
  
    <div class="container text-center pt-2 mb-3">
      <?php
        if(isset($_SESSION['errors'])) {
          foreach($_SESSION['errors'] as $error) {
            echo '
              <p class="bg-danger text-white p-2 mb-2">
                '.$error.'
              </p>
            ';
          }
          session_unset();
        }
      ?>
      <h2 class="p-3">
        Register form
      </h2>
      <i class="fas fa-user-plus"></i>
      <form action="/register/save" method="POST">
        <div class="form-group">
          <label for="username">
            Username
          </label>
          <input type="text" class="form-control" id="username" name="username"
                placeholder="e.g. Branimir97" required>
        </div>
        <div class="form-group">
          <label for="email">
            Email address
          </label>
          <input type="email" class="form-control" id="email" name="email"
                placeholder="e.g. branimir@gmail.com" required>
        </div>
        <div class="form-group">
          <label for="address">
            Address
          </label>
          <input type="text" class="form-control" id="address" name="address"
                placeholder="e.g. Novska" required>
        </div>
        <div class="form-group">
          <label for="password">
            Password
          </label>
          <input type="password" class="form-control" id="password" name="password"
                placeholder="e.g. 123A4123" required>
          <small>
            Password must contain min. 8 characters, 1 uppercase letter & 1 number.
          </small>
        </div>
        <div class="form-group">
          <label for="repeatPassword">
            Repeat password
          </label>
          <input type="password" class="form-control" id="repeatPassword" name="repeatPassword"
                placeholder="e.g. 123A4123" required>
          <small>
            Passwords must match.
          </small>
        </div>
        <button type="submit" name="submit" class="btn btn-success mt-2 mb-1">
          Register
        </button>
      </form>
    </div>
  </body>
</html>