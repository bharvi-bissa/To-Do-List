<?php

	include 'db.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_SESSION['user_session'])){
		header('Location: index.php');
	}
	$username=$_SESSION['user_session'];
	  $sql="SELECT * from users where username='$username';";
	  $result=mysqli_query($db,$sql);
	  $row=mysqli_fetch_assoc($result);

?>	

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
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
              <a class="nav-link" href="logout.php">Settings</a>
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
	<div class="container-fluid" style="margin-top: 5%;margin-left: 20%;">
          <div class="col-md-12">
            <div><h3>Edit Profile</h3></div>
    
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              <label>Username:</label><input type="text" name="username" value="<?php echo $row['username']; ?>"> <br>
              <label>Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label> <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
              <br>
              <input type="submit" name="update" value="update" class="btn btn-primary">
            </form>
          </div>
        </div>
          
</body>
</html>

<?php
  if(isset($_POST['username'])){
    $username="";
  
    $email="";
    $uname= $_SESSION['user_session'];
    @$username=$_POST['username'];
    /*@$password=md5($_POST['password']);*/
    
    @$email=$_POST['email'];
    $username=mysqli_escape_string($db,$username);
    /*$password=mysqli_escape_string($db,$password);*/
    
    $email=mysqli_escape_string($db,$email);
  if(empty($username) || empty($firstname) || empty($lastname) || empty($email)){
    echo "<script>alert('Please fill all the fields');</script>";
  }
  $query=
  @mysqli_query($db,"UPDATE users SET username='$username',email='$email' WHERE username='$uname'");
  
  if($query){
    echo "<script> alert('Profile updated successfully !');</script>";
    header("location:to-do.php");
    
  }
  else{
    echo "<script> alert('Profile not updated !');</script>";
    $username="";
    $password="";
    $email="";
  }
}
?>