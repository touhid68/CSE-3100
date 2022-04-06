<?php

$ServerName="localhost";
$UserName="root";
$Password="";
$dbName="portal";

session_start();

if(isset($_SESSION["email"]))
{
	header("location:index.php");
}


$connect=mysqli_connect($ServerName,$UserName,$Password,$dbName);

if($connect===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST["email"];
	$password=$_POST["password"];


	$sql1="select * from users where email='".$email."' AND password='".$password."' ";
	$result=mysqli_query($connect,$sql1);
	$total_rows=mysqli_num_rows($result);

	if($total_rows>0)
	{

		while($row=mysqli_fetch_assoc($result)){
			echo $row['email'];

			if($row["role"]=="user")
			{	

				$_SESSION["email"]=$email;
				setcookie("user",  time() + (86400 * 30), "/");

				header("location:index.php");
			}

			elseif($row["role"]=="admin")
			{

				$_SESSION["email"]=$email;
				setcookie("admin", time() + (86400 * 30), "/");

				header("location:index.php");
			}

			else
			{
				echo '<script>alert("Incorrect email or password.")</script>';
				exit;
			}
		}
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--style > 
<?php include 'login.css'; ?>
</style-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>তেলিগাতী নিউজ পোর্টাল</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<!-- Core theme CSS (includes Bootstrap)-->
<link type="text/css" href="login.css" rel="stylesheet" />
</head>
<body>
	<div class="logInform">
		<form class="forom" action="login.php" method="post">
  <!--div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
</div-->
<div><h2 style="text-align:center;">তেলিগাতী নিউজ পোর্টাল</h2></div>
<div class="container">

	<label for="email"><b>Email</b></label>
	<input type="email" placeholder="Enter Email" name="email" id="email" required>

	<label for="password"><b>Password</b></label>
	<input type="password" placeholder="Enter Password" name="password" id="password" required>

	<button type="submit">Login</button>
    <!--label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
  </label-->
</div>

<div class="container" style="background-color:#f1f1f1">
	<a href="index.php"><button type="button" class="cancelbtn">Cancel</button></a>
	<span class="psw"><a href="signup.php">Create an account</a></span>
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


