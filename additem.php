<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		tr,td{
			
		}
	</style>
</head>

<body>

</body>
</html>

<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_SESSION['user_session'])){
		header('Location: index.php');
	}
	require 'db.php';
	$username=$_SESSION['user_session'];

	if(isset($_POST['done'])){
		$item=mysqli_escape_string($db,$_POST['item']);
		$sql=mysqli_query($db,"INSERT into todo(username,item) values('$username','$item')");
		exit();
	}

	if(isset($_POST['display'])){
		$result=mysqli_query($db,"SELECT * FROM todo where username='$username'");?>
		<br>
		<div class="col-md-12" style="text-align: center;">
		<table cellpadding="10" style=";font-size: 25px">
			 	<tr><td><b>Task</b></td><td><b>Action</b></td></tr>
		<?php while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			?>
			 

			
			 	<tr>
			 		<td style="width: 300px;"><li><?php echo $row['item']; ?></li></td><td><a href="delete.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash" aria-hidden="true" style="color: red;"></i></a></td>
			 		<td><a href="update.php?id=<?php echo $row['id']; ?>&item=<?php echo $row['item']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>

			 		
			 	</tr>
			 
			
			<?php } exit(); } ?>

</table>
	