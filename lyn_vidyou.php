<?php
ob_start();
//--------------------------

$proxy[1] = "http://streamer.file2hd.com/y.aspx?video_id=";
$proxy[2] = "http://hxcmusic.com/testing/youtube.php?url=http://www.youtube.com/watch?v=";
$proxy[3] = "http://musicela.com/facebook/playsong.php?id=";

//---------------------------
$say = count($proxy);
$salla = $proxy[rand(1,$say)];
$videoid = $_GET['id'];
$video = $salla.$videoid;
##header("Location: $video");
?> 