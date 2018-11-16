<?php
session_start();
$username=$_SESSION['username'];
if($username!='admin'){
	echo "<script>location='home.php';</script>";
}
$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

$id=$_GET['id'];

$fetch_qry="SELECT * FROM `songs` WHERE id=$id";
$row=mysqli_fetch_row(mysqli_query($con,$fetch_qry));
?>

<html>
<head>
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

td{
	padding-top:25px;
	padding-left:15px;
}
input[type='submit']{
	padding:5px;
	background:white;
	color:black;
	cursor: pointer;
}
</style>
</head>
<body style='color:white;background: black'>
<div id="nav_bar">
      <div id="logo" style="padding-right: 55%;float:left;margin-top:10px"><font face="Bunch Blossoms Personal Use" size="6px"><a href="test3.php">Muzikk&hearts;</a></font></div>
      <a class="logout"style="float:right;margin-top:15px;font-size:125%;margin-right:10px" href="logout.php">Log Out</a>
</div>
<div style='padding:15px'><a href='admin_home.php'>Back</a></div>
<div style='font-size:125%'><a href='admin_home.php'><center>Add Songs</center></a></div><br>
<table style='margin-left:35%'>
<form name='add_song_form' method='POST'>
 <tr><td>Song Title</td>	<td><input type='text' placeholder='Song Title' name='title' value="<?php echo $row[1];?>"/></td></tr>
 
 <tr><td>Song link</td>	<td><textarea placeholder='Song Link' name='link'><?php echo $row[2];?></textarea></td></tr>
 
 <tr><td>Artists</td>	<td><input type='text' placeholder='Artists' name='artist' value="<?php echo $row[3];?>"/></td></tr>
 
 <tr><td>Album Art Link</td>	<td><textarea placeholder='Album Art Link' name='album_art'><?php echo $row[4];?></textarea></td></tr>
  
 <tr><td>Tags</td>	<td><textarea placeholder='Search Tags' name='tags'><?php echo $row[5];?></textarea></td></tr>
 
 
</form>
</table>
<br>
<center><input type='submit' value='Save Changes'></center>
</body>
</html>

<?php

@$title=addslashes($_POST['title']);
@$link=$_POST['link'];
@$artist=addslashes($_POST['artist']);
@$album_art=$_POST['album_art'];
@$tags=addslashes($_POST['tags']);
if($album_art==''){
	$album_art='https://media.wired.com/photos/5a0cf8167d6fd0312d8bba0a/master/w_2400,c_limit/AlienMusic-TA.jpg';
}

if($title!='' and $link!=''){
	$insert_qry="UPDATE `songs` SET title='$title', link='$link', artist='$artist', album_art='$album_art', tags='$tags' WHERE id=$id";
	if(mysqli_query($con,$insert_qry)){
		echo "<script>alert('Song editted successfully.');location='admin_home.php';</script>";
	}
	else{
		echo "<script>alert('Cannot edit song.');</script>";
	}
}

?>