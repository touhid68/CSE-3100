<?php
session_start();


if(!isset($_SESSION["email"]))
{
	header("location:login.php");
}

?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>তেলিগাতী নিউজ পোর্টাল</title>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="adminDashboard.css" rel="stylesheet" >
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" >
    </head>
    <body>
    	<header>
    	<div class="left_area"><a href="index.php" style="text-decoration:none;"><h3><span>তেলিগাতী </span>নিউজ পোর্টাল</h3></a> </div> 
    	<div class="right_area"><a href="logout.php" class="logout_btn">Logout</a></div> 

    	</header>

    	<div class="sidebar">
		<center>
			<img src="user.png" class="profile_image" alt=""> 
			<h4>User</h4>
		</center>
		<a href="userDashboard_profile.php" style="background-color:#3399ff;"><i class="fas fa-user"></i><span>Profile</span></a>
	</div>
	<div class="content"> 
		<h1 style="color:#1DC4E7;">Your Profile</h1><br>
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
		$email=$_SESSION["email"];
		$sql="select * from users where email='".$email."' ";
		$result=mysqli_query($connect,$sql);
		$total_rows=mysqli_num_rows($result);

		if($total_rows>0)
		{
			while($row=mysqli_fetch_assoc($result))
			{
				if($row["email"]==$email)
				{
					?>
					<h1>Username : </h1>
					<p id="name"><?php echo $row["username"];?></p>
					<br>
					<?php
				}

			}
		}
		?>

		<h1>Email : </h1>
		<p id="email"><?php echo $_SESSION["email"] ?></p>
		<br>

	</div>



    </body> 
    </html>