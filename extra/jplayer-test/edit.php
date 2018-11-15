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
<body>
<a href='admin_home.php'>Admin Home</a>
<pre>
<form name='edit_song' method="POST">
 Song Title	<input type='text' placeholder='Song Title' name='title' value="<?php echo $row[1];?>"/>
 
 Song link	<textarea placeholder='Song Link' name='link'><?php echo $row[2];?></textarea>
 
 Artists	<input type='text' placeholder='Artists' name='artist' value="<?php echo $row[3];?>"/>
 
 Album Art Link	<textarea placeholder='Album Art Link' name='album_art' ><?php echo $row[4];?></textarea>
  
 Tags	<textarea placeholder='Search Tags' name='tags'><?php echo $row[5];?></textarea>
 
 <input type='submit' value='Save Changes'/>
</form>
</pre>
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