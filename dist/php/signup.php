<?php

$ServerName="localhost";
$UserName="root";
$Password="";
$dbName="portal";

$connect=mysqli_connect($ServerName,$UserName,$Password,$dbName);

if($connect===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$user_name=$_POST["uname"];
	$email=$_POST["email"];
	$password=$_POST["password"];

	$sql1="select * from users where email='".$email."' ";
	$result=mysqli_query($connect,$sql1);
	$total_rows=mysqli_num_rows($result);

	if($total_rows>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			if($row["email"]==$email)
			{	
				echo '<script>alert("This email address is already used!\nPlease..Go back and change your email.")</script>';
				exit;
			}

		}
	}
	else
	{
		$sql2="INSERT INTO users (username,email,password,role) VALUES ('$user_name','$email','$password','user')";
		mysqli_query($connect,$sql2);

		session_start();
		$_SESSION["email"]=$email;
		header("location:index.php");

	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style></style>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>তেলিগাতী নিউজ পোর্টাল</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="favicon.ico" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link type="text/css" href="signup.css" rel="stylesheet" />
</head>
<body>
	<div class="signUpform">
		<form class="forom" action="signup.php" method="post" style="border:1px solid #ccc">

			<div><h2 style="text-align:center;">তেলিগাতী নিউজ পোর্টাল</h2></div>
			<div class="container">
				<p style="text-align:center;">Please fill in this form to create an account.</p>
				<hr>
				<label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" id="uname" required>

				<label for="email"><b>Email</b></label>
				<input type="email" placeholder="Enter Email" name="email" id="email" required>

				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" id="password" required>

				<!--label for="password-repeat"><b>Repeat Password</b></label>
				<input type="password" placeholder="Repeat Password" name="password-repeat" required>

				<label>
					<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
				</label>

				<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p-->

				<div class="clearfix">
					<a href="index.php"> <button type="button" class="cancelbtn">Cancel</button></a>
					<button type="submit" class="signupbtn">Sign Up</button>
				</div>
			</div>
		</form>
	</div>
	<!-- Bootstrap core JS-->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Core theme JS-->
	<script src="scripts.js"></script>
</body>
</html>