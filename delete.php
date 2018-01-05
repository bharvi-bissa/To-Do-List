<?php

include 'db.php';
session_start();

	$id=$_GET['id'];
	$username=$_SESSION['user_session'];

	$sql=mysqli_query($db,"DELETE FROM todo WHERE id='$id'");
	header('Location: to-do.php');