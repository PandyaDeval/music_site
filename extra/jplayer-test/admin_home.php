<?php
session_start();
$username=$_SESSION['username'];
if($username!='admin'){
	echo "<script>location='home.php';</script>";
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
</script>

<style>
#nav_bar{
    overflow: hidden;
    background-color: #554f4f85;
    width: 100%;
    z-index:0;
    padding-bottom: 25px;
}

#leftbar{
      height: 1000px;
      margin-top: 0.5%;
      width:25%;
      color: white;
      background-color: #554f4f85;
      z-index:0;
      display:inline-block;
   }

#main_content{
      height: 1000px;
      margin-top: 0.5%;
      width: 75%;
      background-color: #554f4f85;
      z-index:0;
      display:inline-block;
   }

a{
   color:white;
   text-decoration:none;
}

 a:hover{
         color:#da00aa;
   }

.queue_button{
   background-color: transparent; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.5s;
    cursor: pointer;
    border-radius: 5px;
}
.button1 {
    background-color: transparent; 
    color: white; 
    border: 2px solid white;
}

.button1:hover {
    background-color: #da00aa;
    color: black;
    border-color: transparent;
}

.button2 {
   background-color: transparent; 
    color: white; 
    border: 2px solid white;
}

.button2:hover {
    background-color: red;
    color: white;
    border-color: transparent;
}

.button3{
   background-color: transparent; 
    color: white; 
    border: 2px solid white;
}

.button3:hover {
    background-color: blue;
    color: white;
    border-color: transparent;
}

</style>

</head>

<body style="color: white;background-color: black">
<div id="nav_bar">
      <div id="logo" style="padding-right: 55%;float:left;margin-top:10px"><font face="Bunch Blossoms Personal Use" size="6px"><a href="test3.php">Muzikk&hearts;</a></font></div>
      <a class="logout"style="float:right;margin-top:15px;font-size:125%;margin-right:10px" href="logout.php">Log Out</a>
</div>
<div style='display:flex'>
<div id='leftbar'><center><br>
   <div style='font-size:150%;margin-top:25%'>Hello Admin</div><br>
   <div style='font-size: 125%'><a href='add_song.php'>Add Song</a><br></div>
   <div style="font-size:125%;margin-top:15px"><a href='users.php'>Users</a></div>
<br></center>
</div>
<div id="main_content">
   <table style='margin-top:35px;padding:10px'>
<?php
while($count>0){
	$row=mysqli_fetch_row($fetch_data);
	echo "<tr> <td style='width:20%'>$row[1]</td><td style='width:15%'>By $row[3]</td>
               <td style='width:20%'><button class='queue_button button1' onclick='add_to_queue(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\")'>Add to Queue</button></td>
                <td><a href='$row[2]' title='$row[1]' data-artist='$row[3]' onclick='add_to_queue(\"$row[1]\",\"$row[2]\",\"$row[3]\",\"$row[4]\",1)'>Play</a></td>
               <td style='width:20%;padding-left:4%'><a href='edit.php?id=$row[0]' class='queue_button button3'>Edit Song</a> </td>
               <td style='width:30%'><a href='delete.php?id=$row[0]' class='queue_button button2'>Delete Song</a></td>
         </tr>";
	$count-=1;
}
?>
</table>
</div>
</div>
</body>
</html>
