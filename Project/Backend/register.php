<?php

session_start();
include("DB_connection.php");
include 'domain-name.php';

//make sure that something is been sent
if($_SERVER['REQUEST_METHOD']== "POST"){
	$user_name=$_POST['username'];
	$pass=$_POST['password'];
	$email=$_POST['email'];
	$hash=password_hash($pass,PASSWORD_DEFAULT);
	$userx="SELECT * FROM users WHERE Name='$user_name' ";
	$emailx="SELECT * FROM users WHERE Email='$email' ";
	$outputx = mysqli_query($conn,$userx);
	$outputy = mysqli_query($conn,$emailx);
	
	//x
		if($outputx && $outputy){
			if($outputx && mysqli_num_rows($outputx) > 0){
				$message = "Username Already Exists. Please Choose Another Username..";
				echo "<script type='text/javascript'>
				alert('$message');
				location.href = '$DOMAIN_NAME/signup.php';
				</script>";
			}

			elseif(!ctype_alnum($user_name)){
				$message = "Username cannot contain special characters or spaces. Please Choose Another Username..";
				echo "<script type='text/javascript'>
				alert('$message');
				location.href = '$DOMAIN_NAME/signup.php';
				</script>";
			}
			
			elseif($outputy && mysqli_num_rows($outputy) > 0){
				$message = "This Email Is Already Associated With Another Account. Please Choose Another Email..";
				echo "<script type='text/javascript'>
				alert('$message');
				location.href = '$DOMAIN_NAME/signup.php';
				</script>";
			}
			
			elseif(!empty($user_name)&&!empty($pass)&&!empty($email)&&!is_numeric($user_name)){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
						$query="insert into users (Name,Email,Password) values ('$user_name','$email','$hash')";
						// save in database
						mysqli_query($conn,$query);
						$upath = $user_name.substr($hash, -8);
						str_replace('/','.',$upath);
						$create_user_directory_cmd = "mkdir /srv/http/uploads/".$upath;
						shell_exec($create_user_directory_cmd);
						header("Location: $DOMAIN_NAME/loginpage.php");
						die;
					}
					else{
						$message = "Invalid Email Format. Please Try Again..";
						echo "<script type='text/javascript'>
						alert('$message');
						location.href = '$DOMAIN_NAME/signup.php';
						</script>";
					}
				}
			else{
				$message = "All records are obligatory. Please Fill Them All..";
				echo "<script type='text/javascript'>
				alert('$message');
				location.href = '$DOMAIN_NAME/signup.php';
				</script>";
				}
		}
	
}