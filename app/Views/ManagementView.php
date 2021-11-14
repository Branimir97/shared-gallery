<!doctype html>
<html lang="en">
  <head>
    
    <!-- CSS -->
    <style>
          <?php include "css/management.css"?>
    </style>

    <title>
      Management
    </title>
  </head>
  <body>
        
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
            Upload new photo(s)
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
                                  alt="photo_<?= $photo->photo_id ?>">
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
                                      <input type="hidden" name="photo" value="<?= $photo->photo_id ?>">
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
  </body>
</html>