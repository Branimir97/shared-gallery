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
    <script src="https://kit.fontawesome.com/6aa1bd9ffa.js" 
        crossorigin="anonymous">
    </script>

    <!-- CSS -->
    <style>
          <?php include "css/management.css"?>
    </style>

    <!-- Icon -->
    <link rel="icon" href="../Public/Icons/logo.png">

    <title>
      Management
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
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" 
                id="navbarDropdownMenuLink" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                Menu
                <i class="fas fa-chevron-circle-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item active" href="/management">
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
         if(isset($_SESSION['uploaded'])) {
          echo '
            <p class="bg-success text-white p-2 mb-2">
              '.$_SESSION['uploaded'].'
            </p>
          ';
          }
          if(isset($_SESSION['deletedPhoto'])) {
            echo '
              <p class="bg-danger text-white p-2 mb-2">
                '.$_SESSION['deletedPhoto'].'
              </p>
            ';
          }
        unset($_SESSION['uploaded']);
        unset($_SESSION['deletedPhoto']);
      ?>
      <div class="text-right mb-3">
        <a href="/management/upload" class="btn btn-success">
            Upload new photo
        </a>
      </div>
      <?php if(count($photos) === 0):?>
        <p>
          <strong>
            No photos in database.
          </strong>
        </p>
      <?php else:?>
      <div class="table-responsive">
          <table class="table">
              <caption class="text-center">
                  <small>
                    Photos list
                  </small>
              </caption>
              <thead>
                  <tr>
                      <th>
                        Username
                      </th>
                      <th>
                        Email address
                      </th>
                      <th>
                        Address
                      </th>
                      <th>
                        Photos
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($photos as $photo): ?>
                    <tr>
                        <td>
                          <?= $photo->username?>
                        </td>
                        <td>
                          <?= $photo->email?>
                        </td>
                        <td>
                          <?= $photo->address?>
                        </td>
                        <td>
                          <div class="photo-wrapper">
                            <a href="../Public/Uploads/<?= $photo->fileName ?>"
                              target="_blank" title="Open photo in new tab">  
                              <img 
                                  src="../Public/Uploads/<?= $photo->fileName ?>"
                                  alt="photo_<?= $photo->id ?>">
                            </a>
                            <?php if ($photo->username === $_SESSION['loggedInUser']): ?>
                            <!-- Button trigger modal -->
                            <a href="/management/delete" class="btn btn-danger btn-sm delete" 
                                    data-toggle="modal" data-target="#modal">
                              &times
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" 
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                      Delete photo
                                      <i class="fas fa-camera-retro"></i>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" 
                                            aria-label="Close">
                                      <span aria-hidden="true">
                                        &times;
                                      </span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Are you sure that you want to delete this photo?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" 
                                            data-dismiss="modal">
                                            Close
                                    </button> 
                                    <form method="POST" action="/management/deletePhoto">
                                      <input type="hidden" name="photo" value="<?= $photo->id ?>">
                                      <button name="submit" class="btn btn-danger">
                                        Delete photo
                                      </a>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>    
                            <?php endif;?>
                          </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
          <?php endif;?>
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