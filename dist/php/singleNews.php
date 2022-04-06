<?php
session_start();

/*
if(!isset($_SESSION["email"]))
{
	header("location:index.php");
}
*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>তেলিগাতী নিউজ পোর্টাল</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="styles.css" rel="stylesheet" />
	<link href="index-custom.css" rel="stylesheet" />
	<link href="singleNews.css" rel="stylesheet" />
</head>
<body>
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.php">তেলিগাতী নিউজ পোর্টাল</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">

					<!--li class="nav-item"><a class="nav-link" href="whole_kuet">কুয়েট সম্পর্কিত</a></li-->
					<li class="nav-item"><a class="nav-link" href="whole_science.php">বিজ্ঞান</a></li>
					<li class="nav-item"><a class="nav-link" href="whole_religion.php">ধর্ম</a></li>
					<li class="nav-item"><a class="nav-link" href="whole_sports.php">খেলা</a></li>
					<!--li class="nav-item"><a class="nav-link" href="whole_opinion.php">মতামত</a></li-->
					<li class="line">|</li>
					<li class="nav-item">
						<?php
						$ServerName="localhost";
						$UserName="root";
						$Password="";
						$dbName="portal";

						//session_start();


						$connect=mysqli_connect($ServerName,$UserName,$Password,$dbName);

						if($connect===false)
						{
							die("connection error");
						}

						if(isset($_SESSION["email"]))
						{
							$email=$_SESSION["email"];
							$sql="select * from users where email='".$email."'  ";
							$result=mysqli_query($connect,$sql);
							$total_rows=mysqli_num_rows($result);

							if($total_rows>0)
							{

								while($row=mysqli_fetch_assoc($result))
								{
									//echo $row['email'];

									if($row["role"]=="user")
									{	
										?>
										<a class="nav-link" href="userDashboard_profile.php"><?php echo $_SESSION["email"] ?></a>
										<?php

										//$_SESSION["email"]=$email;

										//header("location:userDashboard_profile.php");
									}

									elseif($row["role"]=="admin")
									{
										?>
										<a class="nav-link" href="adminDashboard_profile.php"><?php echo $_SESSION["email"] ?></a>
										<?php
										//$_SESSION["email"]=$email;

										//header("location:adminDashboard_profile.php");
									}


								}
							}

						}	

						else
						{
							?>
							<a class="nav-link" href="login.php">লগ ইন/সাইন আপ</a>
							<?php
						}
						?>
					</li>


				</ul>
			</div>
		</div>
	</nav>




	<!-- Page Content-->




	<?php

	$ServerName="localhost";
	$UserName="root";
	$Password="";
	$dbName="portal";

	$connect=mysqli_connect($ServerName,$UserName,$Password,$dbName);


	$id=$_POST['id'];

	$sql="SELECT * from news where news_id= '$id' ";
	$query=mysqli_query($connect,$sql);

	while ($info=mysqli_fetch_array($query)) {
		?>
		<div class="content">

			<!--h5 class="category">
				<a href="#">কুয়েট সম্পর্কিত</a></h5-->

				<h3 id="page-title" class="title"><?php echo $info['news_title']; ?></h3>
				<p class="date"><span><?php
				$mydate=getdate(date("U"));
				echo "$mydate[weekday], $mydate[mday] $mydate[month] $mydate[year]";
				?></span> | <span><?php date_default_timezone_set('Asia/Dhaka');  echo date("g:i a"); ?></span></p>



				<figure>
					<img src="news_image/<?php echo $info['img']; ?>" alt="" title="<?php echo $info['news_title']; ?>" class="pic" />
				</figure>


				<div class="article-content">

					<p><?php echo $info['news_content']; ?></p>


				</div>

			</div>

			<?php
		}

		?>




		<div class="cmnt">
			<form action="user_comment.php" method="POST" enctype="multipart/form-data">
				<div  class="docmnt">মন্তব্য করুন</div>

				<p><label for="comment"></label><textarea id="comment" name="comment" placeholder="" aria-required="true"></textarea></p>

				<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="মন্তব্য প্রকাশ করুন" />
				</p></form>	
			</div>

			

			<!-- Footer-->
			<footer class="py-5 bg-dark">
				<div class="container m-0 text-center text-white"><p>সম্পাদক: খোঁজা হচ্ছে (আবেদন করুন)</p><span>এই ওয়েবসাইটের সকল লেখা ও ছবি<br>অনুমতি ছাড়া নকল করা ও অন্য কোথাও<br>প্রকাশ করা সম্পূর্ণ আইনসম্মত |<br></span><br><p>Copyright &copy; তেলিগাতী নিউজ পোর্টাল 2021</p>
				</div>
			</footer>
			<!-- Bootstrap core JS-->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
			<!-- Core theme JS-->
			<script src="js/scripts.js"></script>
		</body>
		</html>
