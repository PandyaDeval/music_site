<?php
session_start();
$username=$_SESSION['username'];
if($username!='admin'){
	echo "<script>location='home.php';</script>";
}
$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

$id=$_GET['id'];

$delete_qry="DELETE FROM `songs` WHERE id=$id";
if(mysqli_query($con,$delete_qry)){
		echo "<script>alert('Song deleted successfully.');location='admin_home.php';</script>";
}
else{
	echo "<script>alert('Song cannot be deleted.');location='admin_home.php';</script>";
}


?>