<?php

	include 'db.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_SESSION['user_session'])){
		header('Location: index.php');
	}

	$id=$_GET['id'];

	if(isset($_POST['update'])){
		$update=$_POST['update'];
		$sql=mysqli_query($db,"UPDATE todo set item='$update' where id='$id'");
		header('Location: to-do.php');
	}



?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Update List | To-Do</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
		


	</head>
	<body>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">To-Do App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            
           
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Settings</a>
             </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Hello <?php session_start();$username=$_SESSION['user_session']; echo $username; ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

		<div class="form-container well" style="margin-left: 34%;margin-top: 10%;width: 500px">
		<div class="container">
			<div class="col-md-12 col-xs-12">
				<form action="" id="todo-form" method="post" class="form-inline">
					<div class="form-group" >
						<input type="text" name="update" class="form-control" placeholder="" value="<?php echo $_GET['item']; ?>" id="item" style="width: 300px;">
						
					</div>&nbsp
					<div class="form-group">
						<button type="submit" class="btn btn-primary" id="add-button">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</body>
	</html>