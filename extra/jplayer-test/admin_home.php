<?php
session_start();
$username=$_SESSION['username'];
if($username!='admin'){
	echo "<script>location='test3.php';</script>";
}
$con = mysqli_connect("localhost","root","") or die("Cannot connect to server.");
mysqli_select_db($con,"music") or die("Cannot Connect to db");

if(mysqli_query($con,"SELECT COUNT(*) FROM `songs`")){
	$count=mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM `songs`"));
	$count=$count[0];
}


$fetch_qry="SELECT * FROM `songs`";
$fetch_data=mysqli_query($con,$fetch_qry);
?>
<script>var quelen=-1</script>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jPlayer Jukebox add-on | Gyrocode.com</title>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- jPlayer -->
<link type="text/css" href="skin/uno/jplayer.uno.min.css" rel="stylesheet" />
<script type="text/javascript" src="jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="jplayer/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="add-on/jplayer.jukebox.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
      // Initialize jPlayerJukebox
      var jpjb = new jPlayerJukebox({
         'swfPath': 'jplayer',
         'jukeboxOptions': {
            'autoAdvance': false,
            'position': 'float-bl'
         }
      });
	  window.jpjb=jpjb;
      $('#btn-api-select-1').on('click', function(){ jpjb.select(5); });
      $('#btn-api-play').on('click', function(){ jpjb.play(); });
      $('#btn-api-play-1').on('click', function(){ jpjb.play(1); });
      $('#btn-api-pause').on('click', function(){ jpjb.pause(); });
      $('#btn-api-next').on('click', function(){ jpjb.next(); });
      $('#btn-api-previous').on('click', function(){ jpjb.previous(); });
      $('#btn-api-shuffle').on('click', function(){ jpjb.shuffle(); });
      $('#btn-api-add').on('click', function(){
         jpjb.add({
            'title': 'mp3 (New song)',
            'artist': 'Lucas Gonze',
            'mp3': 'media/mp3.mp3',
            'poster': 'media/cover2.jpg',
            'download': true,
            'buy': 'https://www.freesound.org/people/lucasgonze/sounds/58970/'
         });
      });
      $('#btn-api-remove').on('click', function(){ jpjb.remove(); });
      $('#btn-api-remove-2').on('click', function(){ jpjb.remove(2); });
      $('#btn-api-clear').on('click', function(){ jpjb.clear(); });
      $('#btn-api-parse').on('click', function(){ jpjb.parse(); });

      $('#btn-api-setViewState-minimized').on('click', function(){ jpjb.setViewState('minimized', 400); });
      $('#btn-api-setViewState-maximized').on('click', function(){ jpjb.setViewState('maximized', 400); });
      $('#btn-api-setViewState-hidden').on('click', function(){ jpjb.setViewState('hidden', 400); });

      $('#btn-api-showPlaylist').on('click', function(){ jpjb.showPlaylist(); });
      $('#btn-api-showPlaylist-false').on('click', function(){ jpjb.showPlaylist(false); });
	  
   });
   function add_to_queue(title,link,artist,album_art,play){
		  var jpjb=window.jpjb;
		  if(quelen==-1){
			  jpjb.clear();
		  }
		  jpjb.add({
			  title: title,
			  artist: artist,
			  mp3: link,
			  poster: album_art
		  });
		  document.body.style="background:url("+album_art+") fixed;background-size:100%;";
		  quelen+=1;
		  if(play==1){
			jpjb.select(quelen);
			jpjb.play();
		  }	
	  }
	function play(title,link,artist){
		var jpjb=window.jpjb;
	}
</script>
</head>

<body >

<article>


<a href='add_song.php'>Add Song</a>
<br><br>

<?php
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	echo "$row[1] <button onclick='add_to_queue(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\",0)'>Add to Queue</button> <a href='$row[2]' title='$row[1]' data-artist='$row[3]' onclick='add_to_queue(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\",1)'>Play</a> <br><br>";
	$count-=1;
}
?>

</article>

</body>
</html>
