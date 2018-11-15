<?php
session_start();
$username=$_SESSION['username'];
if($username!='admin'){
	echo "<script>location='home.php';</script>";
}
$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

if(mysqli_query($con,"SELECT COUNT(*) FROM `users`")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `users`"));
	$count=$count[0];
}


$fetch_qry="SELECT * FROM `users`";
$fetch_data=mysqli_query($con,$fetch_qry);
?>

<html>
<body>

<a href='admin_home.php'>Admin Home</a><br><br>

<table>
<tr>
	<td>Name</td>
	<td>Email</td>
	<td>Username</td>
	<td>Password</td>
</tr>
<?php
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	echo "<tr><td>$row[1]</td><td>$row[3]</td><td>$row[2]</td><td>$row[3]</td></tr>";
	$count-=1;
}
?>
</table>
</body>
</html>