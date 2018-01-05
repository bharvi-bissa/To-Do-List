<?php

	require "db.php";
	 

      if(isset($_POST['username'])){
    	if(empty($_POST['username']) || empty($_POST['password'])){
      	echo "<script>alert('Fill all fields');</script>";
    }
   	 else
   	{
      $username=$_POST['username'];
      $password=$_POST['password'];
      // To protect from MySQL injection
      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = mysqli_real_escape_string($db, $username);
      $password = mysqli_real_escape_string($db, $password);
      $password = md5($password);
      $sql="SELECT username FROM users WHERE username ='$username' and password='$password'";
      $result=mysqli_query($db,$sql);
      $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      if(mysqli_num_rows($result) == 1)
    	{
        session_start();
        $_SESSION['user_session'] = $username; // Initializing Session
        header("location: to-do.php"); // Redirecting To Other Page
      	}
      else
      {
        $error="incorrect username or passoword ";
        echo '<script type="text/javascript">alert("' . $error . '")</script>';
      } 
    }
  
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>To-Do Login</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body style="background-color:#00bcd4">
	
	<h1 style="color: white;text-align: center;font-weight: bolder;margin-top:-11px;margin-bottom:3%;"">To-Do APP</h1>
	<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									
								</form>
								<form id="register-form" action="" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="reg-username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="reg-email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="reg-password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="reg-confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="assets/scripts/main.js"></script>
		<!-- Latest compiled JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			
</body>
</html>

<script>
	$("input#register-submit").click(function(event){
		event.preventDefault();
		var username =document.getElementById('reg-username').value;
        var email =document.getElementById('reg-email').value;
        var pass =document.getElementById('reg-password').value;
        var password=document.getElementById('reg-confirm-password').value;
        console.log(email+" "+password);
        if(username == "" || password == "" || email == "" || pass == "")
        {
        	alert("Please fill all fields");
        }

        else if(pass!=password){
        	alert("Passwords donot match");
        }
        else{
        	$.ajax({
        		type:'POST',
        		url:'register.php',
        		data:{
        			username : username,
        			email : email,
        			password : password 
        		},
        		cache:false,
        		success:function(data){
        			alert("Registered");
        			
        			document.getElementById("register-form").reset();
        		}

        	});
        }
	});
</script>