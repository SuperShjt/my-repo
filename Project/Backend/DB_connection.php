<?php

/*
$compress_cmd = "mkdir testER";
shell_exec($compress_cmd);
echo 'File Created!'; 
*/

$servername = "localhost";
$username = "root";
$pass = "root";
$dbname= "myrepo";

$conn = mysqli_connect($servername, $username, $pass, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
/* $query="INSERT INTO users (Name,Email,Password)
 VALUES ('marc','marcosda@gmail','1234')";
 if(mysqli_query($conn,$query)){
	 echo "added successfully";
 }
 mysqli_close($conn); */
?>