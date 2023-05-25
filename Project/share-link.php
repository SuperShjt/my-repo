<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shared File Download</title>
    <link rel="stylesheet" href="style/signin.css" />
    <link rel="stylesheet" href="style/common.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon"/>
  </head>
  <body>
    <div class="wrapper wrapper-signup">
      <div class="login-title-box">
        <h2>Shared File Download</h2>
      </div>
      <?php
          include "Backend/shared-file-details.php";
          session_start();
          echo '<p class="info-p"><strong>File name:</strong> <span id="shared-file-name">'.$_SESSION['file_name'].'</span></p>';
          echo '<p class="info-p"><strong>File Size:</strong> <span id="shared-file-size">'.$_SESSION['file_size'].' MB</span></p>';
          echo '<p class="info-p"><strong>File Owner:</strong> <span id="shared-file-Owner">'.$_SESSION['file_owner'].'</span></p>';
          session_destroy();
      ?>

      <hr></hr>
      <p class="info-p">Please insert the shared Encryption key to download the file.</p>
      <div class="login-form"action="" method="">
        <div class="form-group">
          <label>Shared Encryption Key</label>
          <input
            type="text"
            id = "shared-key"
            name="encr-key"
            class="form-control"
            placeholder="Shared Encryption Key..."
            autofocus
          />
        </div>

        <input type="checkbox" id="no-key" name="no-key" value="No Encryption Key">
        <label id="no-key-label" for="no-key"> No Encryption Key</label>

        <div class="form-group">  
          <button id="download-shared-file" type="submit" class="btns-login btn"  onclick="">Download</button>
        </div>
      </div>
    </div>

    <script src="dist/bundle-shared.js">
      
    </script>

  </body>
</html>
