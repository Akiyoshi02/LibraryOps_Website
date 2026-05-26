<?php
session_start();

if(isset($_POST["btnRegister"]))
{
    include('connection.php');

	$name = $_POST["txtName"];
	$email = $_POST["txtEmail"];
	$password = $_POST["txtPassword"];		
	$hash = password_hash($password, PASSWORD_DEFAULT);	

	$sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES ('$name', '$email', '$hash');";
    
	try {
		mysqli_query($conn, $sql);
		
		$user_id = mysqli_insert_id($conn);
		
		$_SESSION["user_id"] = $user_id;
		$_SESSION["user_name"] = $name;
		$_SESSION["user_email"] = $email;
		
		echo '<script>alert("You are now registered!");</script>';
		echo '<script>window.location="../account.php";</script>';
		
	} catch(mysqli_sql_exception $e) {

		header('location: ../join.php?error=Email already taken!');

	}
}
?>
