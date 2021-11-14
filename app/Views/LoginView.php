<!doctype html>
<html lang="en">
  <head>
    <?php include 'base/libraries.php'; ?>

    <!-- CSS -->
    <style>
          <?php include 'css/auth.css'; ?>
    </style>
    
    <title>
      Login
    </title>
  </head>
  <body>
    <?php include 'base/navbar.php'; ?>    
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
                <?php if(isset($_COOKIE['username'])):?>
                  value="<?= $_COOKIE['username'] ?>"
                <?php endif; ?> 
          >
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
          <?php if(isset($_COOKIE['username'])):?>
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
   </body>
</html>