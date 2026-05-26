<?php 

session_start();
	
if (isset($_POST["btnSignin"]))
{
	include('connection.php');

	$email = $_POST["txtEmail"];
	$password = $_POST["txtPassword"];

	$sql = "SELECT * FROM `users` WHERE `user_email` = '$email'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_assoc($result);
		$hashed_password = $row['user_password'];

		if (password_verify($password, $hashed_password))
		{
			$_SESSION["user_id"] = $row['user_id'];
			$_SESSION["user_name"] = $row['user_name'];
			$_SESSION["user_email"] = $row['user_email'];
			
			header('Location: ../account.php');
		}
		else
		{
			echo '<script>alert("Invalid password!");</script>';
			echo '<script>window.location="../sign_in.php";</script>';
		}
	}
	else
	{
		echo '<script>alert("No user found with this email!");</script>';
		echo '<script>window.location="../sign_in.php";</script>';
	}
}
?>
