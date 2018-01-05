<?php
	
	include 'db.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_SESSION['user_session'])){
		header('Location: index.php');
	}

	if(isset($_POST['username']))
	{
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		
		$username=mysqli_escape_string($db,$username);
		$email=mysqli_escape_string($db,$email);
		$password=md5(mysqli_escape_string($db,$password));

		$sql="SELECT email from users where email='$email'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		if(mysqli_num_rows($result) == 1)
		{
			$msg = "Sorry...This email already exist...";
			echo $msg;
		}

		else 
		{
			$query = mysqli_query($db, "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')");
			$msg = "Thank You! you are now registered.";
				echo $msg;
		}


	}