<?php

session_start();
include 'Backend/domain-name.php';


if(!isset($_POST['id'])){
    header("Location: $DOMAIN_NAME/index.php ", true, 401);
    return;
}

error_reporting(E_ALL);
ini_set("display_errors", 1);

$conn = mysqli_connect("localhost", "root", "root", "myrepo");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

  $useridx= $_POST['id'];
  $USER_DIR_NAME = "fail";

  /*
  $sql = "SELECT Name, Password FROM users WHERE ID = $useridx";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $USER_DIR_NAME = $row["Name"].trim(substr($row["Password"], -8), '/');
    }
  }
  */
  $USER_DIR_NAME = $_POST["saltedID"]; 

  /* Get the name of the uploaded file */
  $filename = basename($_FILES["file"]["name"]);
 
  /* Choose where to save the uploaded file */
  $location = "uploads/".$USER_DIR_NAME.'/'.$filename;
 
  /* Save the uploaded file to the local filesystem */
    if ( move_uploaded_file($_FILES['file']['tmp_name'],$location)) { 
	
      //echo 'Upload Success';
		$uploadedfile = "insert into files (Name,UserID) values ('$filename','$useridx')";
		mysqli_query($conn,$uploadedfile);
		echo " file is uploaded to database happily :)";

      // compression:
      $zip = new ZipArchive;
      if ($zip->open('uploads/'.$USER_DIR_NAME.'/'.$filename.'.zip', ZipArchive::CREATE) === TRUE)
      {
          // Add files to the zip file
          $zip->addFile($location ,basename($filename));
          //$zip->addFile('test.pdf');

          // All files are added, so close the zip file.
          $zip->close();

          // Remove the uncompressed file - To save space
          unlink($location);
      }
      
      echo 'Compression Success';

  } else { 
    echo 'Upload Failure'; 
}