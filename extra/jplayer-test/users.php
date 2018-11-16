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

<style>
#nav_bar{
    overflow: hidden;
    background-color: #554f4f85;
    width: 100%;
    z-index:0;
    padding-bottom: 25px;
}

a{
	color:white;
	text-decoration:none;
}

a:hover{
         color:#da00aa;
   }

</style>

<body style='background: black;color:white'>
<div id="nav_bar">
      <div id="logo" style="padding-right: 55%;float:left;margin-top:10px"><font face="Bunch Blossoms Personal Use" size="6px"><a href="test3.php">Muzikk&hearts;</a></font></div>
      <a class="logout"style="float:right;margin-top:15px;font-size:125%;margin-right:10px" href="logout.php">Log Out</a>
</div>
<div style='padding:15px;'><a href='admin_home.php'>Back</a></div>
<div style='font-size:150%'><center>All Users</center></div>
<table style='margin-left:20%;width:75%;margin-top:2%'>
<tr>
	<td style='width:20%;padding-bottom: 15px'><b>Name</b></td>
	<td style='width:30%;padding-bottom: 15px'><b>Email</b></td>
	<td style='width:20%;padding-bottom: 15px'><b>Username</b></td>
	<td style='width:30%padding-bottom: 15px'><b>Password</b></td>
</tr>
<?php
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	echo "<tr>
	<td style='padding-bottom:10px'>$row[1]</td>
	<td style='padding-bottom:10px'>$row[3]</td>
	<td style='padding-bottom:10px'>$row[2]</td>
	<td style='padding-bottom:10px'>$row[3]</td>
	</tr>";
	$count-=1;
}
?>
</table>
</body>
</html>