<?php
session_start();
$username=$_SESSION['username'];
if($username!='admin'){
	echo "<script>location='home.php';</script>";
}
$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

?>

<html>
<body>
<a href='admin_home.php'>Admin Home</a>
<pre>
<form name='add_song_form' method='POST'>
 Song Title	<input type='text' placeholder='Song Title' name='title'/>
 
 Song link	<textarea placeholder='Song Link' name='link'></textarea>
 
 Artists	<input type='text' placeholder='Artists' name='artist'/>
 
 Album Art Link	<textarea placeholder='Album Art Link' name='album_art'></textarea>
  
 Tags	<textarea placeholder='Search Tags' name='tags'></textarea>
 
 <input type='submit'/>
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
	$insert_qry="INSERT INTO `songs`(`title`,`link`,`artist`,`album_art`,`tags`) VALUES('$title','$link','$artist','$album_art','$tags')";
	if(mysqli_query($con,$insert_qry)){
		echo "<script>alert('Song added successfully.');</script>";
	}
	else{
		echo "<script>alert('Cannot insert song.');</script>";
	}
}
?>