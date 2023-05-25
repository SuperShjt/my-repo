<?php 
session_start();
include("DB_connection.php");

	$id = $_POST['id'];
	$filename = $_POST['filename'];
	$folder_path = $_POST['saltedID'];

	//Remove The File
	$remove_file_cmd = "unlink /srv/http/uploads/".$folder_path."/'".$filename.".zip'";
	echo $remove_file_cmd;
    shell_exec("$remove_file_cmd");

	//Clear The Database
	$filex= "DELETE FROM files WHERE UserID = '$id' AND Name = '$filename' ";
	mysqli_query($conn,$filex);
	header("Location: $DOMAIN_NAME/Userpage.php");
	die;

?>
