<?php

session_start();


if(!isset($_SESSION["email"]))
{
	//echo '<script>alert("Please..Login first")</script>';
	header("location:login.php");
	exit;
}


$ServerName="localhost";
$UserName="root";
$Password="";
$dbName="portal";

$connect=mysqli_connect($ServerName,$UserName,$Password,$dbName);

                //$nid=$_POST['nid'];
$nid=0;

if (isset($_POST['submit'])) {
	$cmnt_content=$_POST['comment'];

	$sql="INSERT INTO comment(comment_content,news_id) values('$cmnt_content','$nid')";

	$query=mysqli_query($connect,$sql);

}


?>