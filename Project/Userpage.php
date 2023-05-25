<?php


session_start();

include 'Backend/domain-name.php';

if(isset($_SESSION['userid'])){
	
}
else
{
	header("Location: $DOMAIN_NAME/index.php");
}

?>



<!DOCTYPE html>
<html>

  <head>

  <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Drive</title>
    <link rel="stylesheet" href="style/common.css" />
    <link rel="stylesheet" href="style/drive.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style/footer.css"/>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon"/>

    <title>MyRepo</title>
  </head>

<body>
<div id="snackbar">Link Copied To Clipboard!</div>
  <?php 
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  ?>
  <div id="loading-screen">
  <div id="loader">َ</div>
    <div id="loader-bg"></div>
    <p id="loader2">Uploading File..</p>

  </div>
   
   <div class="container">
   <div id="containerx">
              <div  class="reveal-modal">
                    <button class= "popclose" id = "close-popup">X</button>
                    <p></br></p>
                    <label id="pop-up-dec-label">Entered decryption key: <span id="pop-up-dec-key"></span></label>
                    <button class='btn btns-login popup-btn' id='download-btn-popup'>Download File</button>
                    <button class='btn btns-login popup-btn' id='share-btn-popup'>Share File</button>
                    <h4 id="shared-link-header">Link Generated!</h4>      
                    <p id="shared-link"></p>
               </div>
       </div>
      <nav>
        <div class="navbar">
          <span><h3>Welcome to MyRepo, <?php echo $_SESSION['username'] ?>!</h3></span>
          <span><button class="btn btns-login" onclick="window.location.href='Logout.php'">Logout</button></span>
        </div>

      </nav>

      

      <div class="encryption">
        <h4 style="visibility:hidden;">Hello, <?php echo $_SESSION['username'] ?>.</h4>
        <div id ="progress-bar">
          <?php 
            include("Backend/DB_connection.php");
            $useridx= $_SESSION['userid'];
            $sql = "SELECT Name, Password FROM users WHERE ID = $useridx";
            $result = mysqli_query($conn, $sql);
            $USER_DIR_NAME = "";
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $USER_DIR_NAME = $row["Name"].trim(substr($row["Password"], -8), '/');
                
              }
            }
            $directory = '/srv/http/uploads/'.$USER_DIR_NAME;
            function dirSize($directory) {
              $size = 0;
              foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
                  $size+=$file->getSize();
                }
              return $size;
              }
            $used_space = round(dirSize($directory)/1000000, 2);
            $free_space = 1000;
            echo '<strong> Storage Usage:</strong> <em>' . $used_space .'</em>/'. $free_space. ' MB ';
            echo "";
            $to_echo = '
            <progress id="storage" value="'.$used_space.'"
            max="1000"> </progress>';
            echo $to_echo;
            echo "<br><br>"
          ?>
        </div>
        <div class="encryption-key">
          <div class="encryption-key-1">
            <input id="fileupload" type="file" name="fileupload" onchange="document.getElementById('user_file_name').placeholder = document.getElementById('fileupload').files[0].name"/>
            <input id="userIdInput" type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>" />
          </div>

          <div class="form-key">
            <label class = "label-form" id = "enc_key_inp">
              Enter your encryption key: <span class="bad-css">code3zma;</span> 
            </label>

            <input
			  id="enc_key"
              type="text"
              class="form-input"
              placeholder="Enter your encryption key..."
			  name="enc_key"
            />
            <button id="generate-key" type="button" class="btn btns-login">Generate key</button>
            <p></br></p>

            <label class = "label-form" id="custom-name-field">Enter a Custom File Name (Optional):&nbsp&nbsp </label>
            <input
			  id="user_file_name"
              type="text"
              class="form-input"
              placeholder="Enter an Optional Name.."
			  name="user_file_name"
            />
            <p class="check-break"></br></p>

            <input type="checkbox" id="no-key" name="no-key" value="No Encryption Key">
            <label for="no-key"> No Encryption Key</label><br>

            <input type="checkbox" id="sharable" name="sharable" value="I will share this file">
            <label for="sharable"> I Will Share This File</label><br>

            <button id="upload-button" type="button" class="btn btns-singup">Upload</button>
            
          </div>
          
        </div>
        
      </div>
	   <div class="encryption-test">
        <div style="display: flex">
          <img src="assets/semi.svg" alt="Test" />
          <p>
            To test, try to download the file you just uploaded. The file is
            encrypted existed on our server as .ZIP file, you will now get a
            uncompressed and decrypted file
          </p>
        </div>
        <div style="margin-left: 30px">
          <label style="font-weight: bold">Enter your Decryption key:</label>
          <input
		    id="dec_key"
            type="text"
            class="form-input"
            placeholder="Enter your encryption key..."
			name="dec_key"
          />
        </div>
      </div>
    </div>

    
    <div class="container-cards">
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "myrepo");
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $useridx= $_SESSION['userid'];
        $sql = "SELECT Name, Password FROM users WHERE ID = $useridx";
        $result = mysqli_query($conn, $sql);
        $USER_DIR_NAME = "fail";
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            $USER_DIR_NAME = $row["Name"].trim(substr($row["Password"], -8), '/');
            echo '<input id="saltedID" type="hidden" name="saltedID" value="'.$USER_DIR_NAME.'" />';
          }
        }
        $path = 'uploads/'.$USER_DIR_NAME.'/';
        $files = scandir($path);
            $files = array_diff(scandir($path), array('.', '..'));
                foreach($files as $file){
                    echo "<a class='' href='#'>
                    <div class='file-card'>
                    <button id='delete' type='button' class='delete-button' name='".substr($file, 0, -4)."'><strong>x</strong></button>
                    <div class='file-image'>
                    <img src='../assets/folder.svg' alt='folder' /></div>
                    <div class='file-body download-file'>".substr($file, 0, -4)."</div>
                    </div>
                    </a>";
                }
                
    ?>
</div>

   </div>

   <footer>
        <div class="footer-content">
            <h3>MyRepo</h3>
            <p class="footer-p">MyRepo, Storage As A Service Website. MyRepo is What you looking for with our highly secure system where you can save all your files safely.</p>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy; <a href="#">MyRepo</a>  </p>
                    <div class="footer-menu">
                      <ul class="f-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Plans.php">Plans</a></li>
                        <li><a href="AboutUs.html">About Us</a></li>
                        <li><a href="Home.php">Login/Register</a></li>
                      </ul>
                    </div>
        </div>

    </footer>

    <script src="dist/bundle.js"></script>
  </body>
</html>
