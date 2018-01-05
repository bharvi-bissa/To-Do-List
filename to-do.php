<?php
	include 'db.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_SESSION['user_session'])){
		header('Location: index.php');
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>To-Do</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<style>
		input .form-group{
			width: 340px;
		}
		.todo-container{
			
			padding-top: 2%;
		}
		li{
			list-style: none;
		}
	</style>
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
              <a class="nav-link" href="profile.php">Settings</a>
             </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Hello <?php session_start();$username=$_SESSION['user_session']; echo $username; ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


	<div class="form-container" style="">
		<div class="container">
			<div class="col-md-12 col-xs-12" >
				<form action="" id="todo-form" method="post" class="form-inline">
					<div class="form-group" >
						<input type="text" name="add" class="form-control" placeholder="Add To-do Tasks" value="" id="item" style="width: 300px;">
						
					</div>&nbsp
					<div class="form-group">
						<button type="submit" class="btn btn-primary" id="add-button">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="container todo-container" style="">
		<div class="row">
			<div class="col-md-12">
				<div id="item-list"></div>
				<div class="" id="item-todo">
				
			</div>
		</div>
	</div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="assets/scripts/main.js"></script>
		<!-- Latest compiled JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script>
				$(document).ready(function(){
					displayfromdatabase();

					

					$('#add-button').click(function(){
						var item = $('#item').val();

						if(item=="")
							{ 
								alert('Field cannot be left blank!');
							}
							else {
								$.ajax({
									url:'additem.php',
									type:'POST',
									async:'false',
									data:{
										"done":1,
										"item":item,
									},
									success:function(data){
										displayfromdatabase();
										$('#add-list').val('');
									}
								});
							}
					});
				});

					function displayfromdatabase(){
						$.ajax({
							url:'additem.php',
							type:'POST',
							async:'false',
							data:{
								"display" : 1
							},
							success:function(d){
								$('#item-list').html(d);
							}
						})
					}


			</script>

			
</body>
</html>