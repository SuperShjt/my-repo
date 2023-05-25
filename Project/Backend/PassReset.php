<?php

include("DB_connection.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$pass = $_POST['password'];
	echo "PASSED PASS: $pass";
	$plain_email = $_SESSION['u_email'];

	$ciphering = "AES-128-CTR";
	$options = 0;
	$iv = '1234235491011121';
	$key = "3k83RaZkn7Ls";
	$email = openssl_decrypt($plain_email, $ciphering, $key, $options, $iv);
	$id = "";

	$qx="SELECT * FROM users WHERE Email = '$email'";
	$output= mysqli_query($conn,$qx);
	if($output){
		if(mysqli_num_rows($output)>0){
			$hashedpass=password_hash($pass,PASSWORD_DEFAULT);
			echo "HASHED PASSWORD IS $hashedpass  .";

			while($row = mysqli_fetch_assoc($output)) {
				$id = $row["Name"];
                $old_pass = trim(substr($row["Password"], -8), '/');
              }
			
			$old_dir_name = "/srv/http/uploads/".$id.$old_pass;
			echo "old dir is: ".$old_dir_name."  ";

			$newpass="UPDATE users SET Password = '$hashedpass' WHERE Email = '$email'";
			mysqli_query($conn,$newpass);

			$new_dir_name = "/srv/http/uploads/".$id.(trim(substr($hashedpass, -8), '/'));
			echo "new_dir_name: ".$new_dir_name;
			//Rename Directory
			$shell_cmd = "mv ". $old_dir_name." ".$new_dir_name;
			echo $shell_cmd;
			shell_exec($shell_cmd);
			
			header("Location: $DOMAIN_NAME/loginpage.php");
			die;
			}
	
		}
		else{
			echo "2nd if";
		}

	}
	else{
		echo "1st if";
	}

 ?>