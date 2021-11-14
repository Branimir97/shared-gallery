<!doctype html>
<html lang="en">
  <head>
    <?php include 'base/libraries.php'; ?>

    <!-- CSS -->
    <style>
      <?php include 'css/container.css'; ?>
    </style>

    <title>
      Account details
    </title>
  </head>
  <body>   
    <?php include 'base/navbar.php'; ?>    
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
        <button class="btn btn-danger mt-1" 
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
              <i class="far fa-user-circle"></i>
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
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>