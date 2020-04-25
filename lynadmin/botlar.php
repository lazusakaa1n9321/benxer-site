<?php
/*
	Yazılım: Lyn Video v1
	Son Güncelleme: 04.02.2011
	www.leventayan.com - twitter.com/LvntAyn
	o@leventayan.com
*/
if(!isset($_SESSION["login"])){
	yenile("giris.php");
}else{
?>	
<div id="icerik">
    <div id="icerik_sag">
    	<div id="icerik_sag_baslik"></div>
        <div id="sag_menu">
           <a href="index.php?sayfa=botlar&bot=youtube"> - Youtube</a>
           <div class="cizgi"></div>
           <a href="index.php?sayfa=botlar&bot=facebook"> - Facebook</a>
           <div class="cizgi"></div>
        </div> 
    </div>
          	
<?php
switch($_GET['bot']){
	default:
	echo '<div id="icerik_sol_baslik">Botlar</div>
        	<div id="icerik_sol">';
	echo 'Menüden Bot Seçin Lütfen';
	echo '</div>';
	break;
	
	case "youtube":
	echo '<div id="icerik_sol_baslik">Youtube</div>
        	<div id="icerik_sol">';
	echo '	<iframe src="bot_youtube.php" frameborder="0" width="700px" height="950px"></iframe>
';
	echo '</div>';
	break;
	
	case "facebook":
	echo '<div id="icerik_sol_baslik">facebook</div>
        	<div id="icerik_sol">';
	echo '	<iframe src="bot_facebook.php" frameborder="0" width="700px" height="950px"></iframe>
';
	echo '</div>';
	break;
}
?>
</div>             
<?php } ?>
	