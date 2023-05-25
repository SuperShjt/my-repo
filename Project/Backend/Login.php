<?php

session_start();
include("DB_connection.php");
include 'domain-name.php';

$USER_DIR_NAME = "fail";
$user_name = NULL;
$pass = NULL;

//make sure that something is been sent
if($_SERVER['REQUEST_METHOD']== "POST"){
	
	$user_name=$_POST['username'];
	$pass=$_POST['password'];

	
	if(!empty($user_name)&&!empty($pass)){
		
		// read from data base
		$query="SELECT * FROM users WHERE Name = '$user_name' limit 1";
		$output = mysqli_query($conn,$query);
		if($output){
			if($output && mysqli_num_rows($output)>0){
				$data=mysqli_fetch_assoc($output);
				if(password_verify($pass,$data['Password'])){
					$_SESSION['userid']= $data['ID'];
					$_SESSION['username']=$data['Name'];
					$USER_DIR_NAME = $user_name.substr($data['Password'], -4);
					$_SESSION['USER_DIR_NAME'] = $USER_DIR_NAME;
					header("Location: $DOMAIN_NAME/Userpage.php");
					die;
				}
				else{
					$message = "Invalid Credentials Was Entered. Please Try Again";
					echo "<script type='text/javascript'>
					alert('$message');
					location.href = '$DOMAIN_NAME/loginpage.php';
					</script>";
				}
				
			}
			else{
				$message = "Invalid Credentials Was Entered. Please Try Again";
				echo "<script type='text/javascript'>
				alert('$message');
				location.href = '$DOMAIN_NAME/loginpage.php';
				</script>";
				
			}
		}
		else{
			echo '<script>alert("Invalid Credentials Was Entered. Please Try Again.")</script>';
			header("Location: $DOMAIN_NAME/loginpage.php");
		}
		
	}
	else{
		echo '<script>alert("Invalid Credentials Was Entered. Please Try Again.")</script>';
		header("Location: $DOMAIN_NAME/loginpage.php");
		die;
	}
}

$_SESSION['USER_DIR_NAME'] = $USER_DIR_NAME;

?>