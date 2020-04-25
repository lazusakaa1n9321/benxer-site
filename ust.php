<?php @session_start();
require_once('lynadmin/fonksiyon.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<base href="<?php echo $genel_ayarlar['site_adresi']; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="TR" /> 
<meta name="robots" content="index,follow" /> 
<meta name="distribution" content="Global" />
<meta name="generator" content="Lyn Video Scripti. Versiyon 1.0" />
<link rel="alternate" type="application/rss+xml" title="<?php echo $title; ?>" href="rss.php" />
<style type="text/css">@import "css/lynstyle.css";</style>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/lynvideo_baslik.js"></script>
<script type="text/javascript" src="js/lyn_video.js"></script>
</head>
<!-- Genel Başlar --> 
<body>
<!-- Üst Başlar --> 
<div id="ust">
		<div id="ust_orta">
    	<div id="ust_orta_sol"><a href="index.html"><img src="images/logo.png" alt="" /></a></div>
        <div id="ust_orta_sag"><?php echo $reklam['ust_468']; ?></div>
    </div>
    <div id="menu">
    	<ul>
        	<li style="color: #0042A6;"><a href="<?php echo $genel_ayarlar['site_adresi']; ?>" style="color: #0042A6;">Ana Sayfa</a></li>
           <li><a href="yeni-videolar">Yeni Videolar</a></li>
           <li><a href="en-cok-izlenenler">En Çok İzlenenler</a></li>
           <li><a href="video-gonder">Video Gönder</a></li>
           <li><a href="iletisim">İletişim</a></li>
        </ul>
     	<div id="menu_sag">   
            <form action="arama" method="post">
            <input type="text" name="aranan" class="arama" value="Video Ara.." onfocus="this.value=''" />
            <input type="submit" name="ara" class="ara" value="Ara" /></form>
		</div>
    </div>
</div>
<!-- Üst Biter --> 