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
			<h4>Admin</h4>
		</center>
		<a href="adminDashboard_profile.php"><i class="fas fa-user"></i><span>Profile</span></a>
		<a href="adminDashboard_myposts.php"><i class="fas fa-table"></i><span>My Posts</span></a>
		<a href="adminDashboard_newpost.php" style="background-color:#3399ff;"><i class="fas fa-file"></i><span>Add New Post</span></a>
	</div>
	<div class="content"> 
		<form action="adminDashboard_newpost.php" method="POST" enctype="multipart/form-data" class="frm">
			<fieldset>
				Category Name:
				<select id="category" name="category">
					<!--option selected>কুয়েট সম্পর্কিত</option-->
					<option selected>বিজ্ঞান</option>
					<option>ধর্ম</option>
					<option>খেলা</option>
					<!--option>মতামত</option--> 
				</select>
				<br><br>
				Upload Image:
				<input type="file" id="image" name="image" value="" required><br><br>
				News Title:
				<input type="text" id="title" name="title"><br><br>

  <!--Upload Text File:
  	<input type="file" id="txt" name="txt" value=""><br><br-->
  	<textarea rows="10" cols="75" id="content" name="content">Enter News Content Here...</textarea><br><br>
  	<input type="submit" id="post" name="post" value="Post">

  </fieldset>
</form>

<?php
$ServerName="localhost";
$UserName="root";
$Password="";
$dbName="portal";

$connect=mysqli_connect($ServerName,$UserName,$Password,$dbName);

if (isset($_POST['post'])) {
	$category=$_POST['category'];
	$title=$_POST['title'];
	$content=$_POST['content'];
	$image_name=$_FILES['image']['name'];
	$image_type=$_FILES['image']['type'];
	$image_size=$_FILES['image']['size'];
	$image_tem_loc=$_FILES['image']['tmp_name'];
	$image_store="news_image/".$image_name;
	move_uploaded_file($image_tem_loc,$image_store);
	$email=$_SESSION["email"];


	$sql="INSERT INTO news(category_name, news_title, news_content, img, email) values('$category','$title','$content','$image_name','$email')";

	$query=mysqli_query($connect,$sql);

}


?>
</div>


</body> 
</html>