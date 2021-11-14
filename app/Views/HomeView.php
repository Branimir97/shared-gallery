<!doctype html>
<html lang="en">
  <head>

    <?php include('base/libraries.php'); ?>

    <title>
      Shared gallery
    </title>
  </head>
  <body>
    <?php include('base/navbar.php'); ?>    
    <div class="container text-center mt-2">
      <?php
        if(isset($_SESSION['loggedInMessage'])) {
          echo '
            <p class="bg-success text-white p-2 mb-2">
              '.$_SESSION['loggedInMessage'].'
            </p>
          ';
          unset($_SESSION['loggedInMessage']);
        }
      ?>
      <button class="trigger p-2 btn btn-outline-success">
          Get total number of 
          <strong>
            Shared gallery
          </strong> 
          photos
      </button>
      <div class="result mt-3"></div>
    </div>
    
    <script>
      <?php include('Services/CountPhotos.js') ?>
    </script>
  </body>
</html>