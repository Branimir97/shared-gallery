<!doctype html>
<html lang="en">
  <head>
    <?php include 'base/libraries.php'; ?>

    <!-- CSS -->
    <style>
          <?php include 'css/container.css'; ?>
    </style>
    
    <title>
      Change password
    </title>
  </head>
  <body>
    <?php include 'base/navbar.php'; ?>    
    <div class="container text-center mt-2"> 
      <div class="text-left">
        <a href="/account">
          <i class="fas fa-long-arrow-alt-left"></i>
          Back to account details
        </a>
      </div>
      <p>
        You're logged in as 
        <strong>
            <?php echo $_SESSION['loggedInUser']; ?>
        </strong>
      </p>
      <hr>
      <div class="changePassword-form">
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
        <form action="/account/changePassword" method="POST">
          <div class="form-group">
            <label for="currentPassword">
              Current password
            </label>
            <input type="password" class="form-control" id="currentPassword" 
                name="currentPassword" placeholder="Enter current password" required>
          </div>
          <div class="form-group">
            <label for="newPassword">
              New password
            </label>
            <input type="password" class="form-control" id="newPassword" 
                name="newPassword" placeholder="Enter new password" required>
          </div>
          <div class="form-group">
            <label for="newPasswordRepeat">
              Repeat new password
            </label>
            <input type="password" class="form-control" id="newPasswordRepeat" 
                name="newPasswordRepeat" placeholder="Enter new password again" required>
          </div>
          <button type="submit" name="submit" class="btn btn-outline-info">
            Change password
          </button>
        </form>
      </div>
    </div>
  </body>
</html>