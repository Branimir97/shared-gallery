<!doctype html>
<html lang="en">
  <head>
    <?php include 'base/libraries.php'; ?>

    <!-- CSS -->
    <style>
          <?php include "css/container.css"?>
    </style>

    <title>
      Upload photo(s)
    </title>
  </head>
  <body>
    <?php include 'base/navbar.php'; ?>    
    <div class="container text-center mt-2"> 
      <div class="text-left">
        <a href="/management">
          <i class="fas fa-long-arrow-alt-left"></i>
          Back to management
        </a>
      </div>
      <p>
        You're logged in as 
        <strong>
            <?php echo $_SESSION['loggedInUser']; ?>
        </strong>
      </p>
      <hr>
      <div class="uploadPhoto-form">
        <?php
          if(isset($_SESSION['errors'])) {
            foreach($_SESSION['errors'] as $error) {
              echo '
                <p class="bg-danger text-white p-2 mb-2">
                  '.$error.'
                </p>
              ';
            }
            unset($_SESSION['errors']);
          }
        ?>       
        <form action="/management/uploadPhoto" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="file">
              Select file
            </label>
            <input type="file" class="form-control" id="file" 
                name="files[]" multiple required>
            <small>
              Allowed extensions: [.jpg, .png]
            </small>
          </div>
          <button type="submit" name="submit" class="btn btn-outline-primary">
            Upload photo(s)
          </button>
        </form>
      </div>
    </div>
  </body>
</html>