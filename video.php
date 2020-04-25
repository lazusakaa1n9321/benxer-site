<?php
require_once('lynadmin/fonksiyon.php');
$id = intval($_GET['id']); 
$video = mysql_fetch_assoc(mysql_query("select * from lynvideo_video where durum='1' and id=".$id));
$title =  $video['baslik']." Videosu İzle";
$keywords =  $video['baslik']." videosu, ".$video['baslik']." izle, ".$video['baslik']." seyret, ".$video['baslik']." dinle, ".$video['baslik']." indir";
$description =  $video['baslik']." videosu izle, ".$video['baslik']." videosu indir";
include('ust.php');
$video_artir = mysql_query("update lynvideo_video set hit=hit+1 where durum='1' and id=".$id);
$katsor = mysql_fetch_assoc(mysql_query("select * from lynvideo_kategori WHERE id = '".$video['kategori']."' ORDER BY id"));
$link = $genel_ayarlar['site_adresi'].'/'.$video['id'].'-'.link_temizle($video['baslik']).'.html';
$vid = $video['id'];
?>
<!-- İçerik Başlar --> 
<div id="icerik">
  <!-- İçerik-Sol Başlar --> 
  <div id="sol">
  		<div class="sol_baslik"><?php echo $video['baslik']; ?></div>
	    <div class="sol_kutu" style="font-family: Arial; font-size: 13px;">
       		<div class="ivideo_cizgi"></div>
			<div class="ivideo_sol">
				<script type='text/javascript'>
                window.setTimeout("document.getElementById('videonu1').style.display = 'none';document.getElementById('videonu2').style.display = '';",<?php echo $genel_ayarlar['video_onu']; ?>000); 
                </script> 
                <div id="videonu1">
                    <font style="font-weight: bold; color: #0B57CA;">Reklamlar. Video <?php echo $genel_ayarlar['video_onu']; ?> Saniye Sonra Açılacaktır....</font><br />
                    <?php echo $reklam['video_onu']; ?><br /><br />
					<img src="images/yukleniyor.gif" alt="" /><br />
					<font style="font-size: 12px;">Video Yükleniyor..</font>
                </div>
                <div id="videonu2" style="display:none;">   
                 <?php
				 if ($video['tur'] == "1"){
				 	echo $video['embed'];
				 }elseif ($video['tur'] == "2"){
						$videoem = str_replace($genel_ayarlar['site_adresi'].'lyn_vidyou.php?id=','http://www.youtube.com/watch?v=',$video["embed"]); 
?>
<script type="text/javascript" src="<?php echo $genel_ayarlar['site_adresi'];?>/player/jwplayer.js"></script>
<div id="myElement">Yükleniyor...</div>
<script type="text/javascript">
    jwplayer("myElement").setup({
        file: "<?php echo $videoem;?>",
		width: "515",
		height: "350"
    });
</script>
<?php
				 }elseif ($video['tur'] == "3"){ 
					$vlink = str_replace('http://','',$video["embed"]);
				 ?>
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="515" height="350" id="Untitled-1" align="middle"> 
					<param name="allowScriptAccess" value="sameDomain" /> 
					<param name="allowFullScreen" value="true" /> 
					<param name="movie" value="https://www.drbvitamins.com/modules/mod_jwmedia/player.swf?file=<?php echo $genel_ayarlar['site_adresi']; ?>/lyn_vidface.php?link=<?php echo $vlink; ?>&image=<?php echo $video["resim"]; ?>&autostart=true&type=video" /> 
					<param name="quality" value="high" /> 
					<param name="bgcolor" value="#ffffff" /> 
					<embed src="https://www.drbvitamins.com/modules/mod_jwmedia/player.swf?file=<?php echo $genel_ayarlar['site_adresi']; ?>/lyn_vidface.php?link=<?php echo $vlink; ?>&image=<?php echo $video["resim"]; ?>&autostart=true&type=video" quality="high" bgcolor="#ffffff" width="515" height="350" name="mymovie" align="middle" allowFullScreen="true" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" /> 
					</object> 
				<?php }
				 ?>
                </div>  
            </div>
            <div class="ivideo_sag"><?php echo $reklam['video_yan']; ?></div>
			<ul>
                <li style="float: left;"><b>Tarih:</b>  <?php echo $video['tarih']; ?></li>
                <li style="width: 500px; text-align: right; color: #0042A6;"><b>İzlenme:</b>  <?php echo $video['hit']; ?></li>
            </ul>
			<div class="idetay_cizgi"></div>
			<b>Açıklama:</b>  <?php echo $video['baslik']." videosu, ".$video['baslik']." izle, ".$video['baslik']." seyret, ".$video['baslik']." dinle, ".$video['baslik']." indir".$video['baslik']." video izle" ?><br />
			<div class="idetay_cizgi"></div>
			<b>Kategori:</b>  <?php echo '<a href="kategori/'.$katsor['id'].'-'.link_temizle($katsor['kategori']).'">'.$katsor['kategori'].'</a>'; ?>
			<div class="idetay_cizgi"></div>
			<b>Etiketler:</b>
			<?php 
				$videoe = mysql_query("select * from lynvideo_video where durum='1' and id=".$id);
                while ($video_cek=mysql_fetch_array($videoe)){
				$etiket = $video_cek['etiketler'];
				$parcala = explode(',', $etiket);
				$say = count($parcala);
				for($i=0; $i<$say; $i++){
					$etiketle = trim($parcala[$i]);
					if (strlen($etiketle) != 1){
						echo '<a href="etiket/'.$etiketle.'">'.$etiketle.',</a> ';
					}
       	  	}} ?>
            <div class="idetay_cizgi"></div>
             <?php
            echo '
            <iframe src="http://www.facebook.com/plugins/like.php?href='.$link.'&amp;amp;layout=standard&amp;amp;show_faces=false&amp;amp;width=450&amp;amp;action=like&amp;amp;font=arial&amp;amp;colorscheme=light&amp;amp;height=35" scrolling="no" frameborder="0" style="border:none; float:left; overflow:hidden; width:260px; height:35px; margin-top:5px;"></iframe>
            ';
            ?>
           <a href="http://www.facebook.com/share.php?u=<?php echo $link;?>&amp;t=><?php echo $video['baslik']; ?>" target="_blank"><img src="images/icon/facebook.ico" alt="" /> </a>
                <a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $link;?>" target="_blank" title="Myspace"><img src="images/icon/myspace.ico" alt="" /> </a>
                <a href="http://technorati.com/faves?add=<?php echo $link;?>" target="_blank" title="Technorati"><img src="images/icon/technorati.ico" alt="" />  </a>
                <a href="http://twitter.com/home?status=İzliyorum:<?php echo $link;?>" target="_blank" title="Twitter"><img src="images/icon/twitter.ico" alt="" />  </a>
            <div class="idetay_cizgi"></div>
                         <b>Sitene Ekle:</b><br /><?php
				 if ($video['tur'] == "1"){
					echo '<textarea name="yorum" rows="20" cols="80" style="width:  520px; height: 50px; background-color: #E9E9E9; border: 1px solid #CCC;" >'.$video['embed'].'</textarea>';
				 }elseif ($video['tur'] == "2"){
					$embedwms = str_replace('watch?v=','embed/',$video["embed"]);
					echo '<textarea name="yorum" rows="20" cols="80" style="width:  520px; height: 50px; background-color: #E9E9E9; border: 1px solid #CCC;" >';
					echo '<iframe width="515" height="350" src="'.$embedwms.'?rel=0" frameborder="0" allowfullscreen></iframe></textarea>'; 
				 }elseif ($video['tur'] == "3"){ 
					$vlink = str_replace('http://','',$video["embed"]);
				 ?>
					<textarea name="yorum" rows="20" cols="80" style="width:  520px; height: 50px; background-color: #E9E9E9; border: 1px solid #CCC;" ><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="515" height="350" id="Untitled-1" align="middle"> 
					<param name="allowScriptAccess" value="sameDomain" /> 
					<param name="allowFullScreen" value="true" /> 
					<param name="movie" value="https://www.drbvitamins.com/modules/mod_jwmedia/player.swf?file=<?php echo $genel_ayarlar['site_adresi']; ?>/lyn_vidface.php?link=<?php echo $vlink; ?>&image=<?php echo $video["resim"]; ?>&autostart=true&type=video" /> 
					<param name="quality" value="high" /> 
					<param name="bgcolor" value="#ffffff" /> 
					<embed src="https://www.drbvitamins.com/modules/mod_jwmedia/player.swf?file=<?php echo $genel_ayarlar['site_adresi']; ?>/lyn_vidface.php?link=<?php echo $vlink; ?>&image=<?php echo $video["resim"]; ?>&autostart=true&type=video" quality="high" bgcolor="#ffffff" width="515" height="350" name="mymovie" align="middle" allowFullScreen="true" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" /> 
					</object> </textarea>
				<?php }
				 ?>
            <div class="idetay_cizgi"></div>
            <b>Video Linki:</b> <input type="text" style="width: 440px;" value="<?php echo $link;?>" />
            <div class="idetay_cizgi"></div>
        </div>
        <div class="sol_bosluk"></div>
        <div class="sol_kutu" style="font-family: Arial; font-size: 13px; border: 0px;">
 				<?php
				$yorum = mysql_query("select * from lynvideo_yorum where durum='1' and vid='$id'");
				while ($yorum_cek=mysql_fetch_array($yorum)){
				?>
                <div class="yorum_ust"></div>
                <div class="yorumlar"><ul>
                    <li><img src="images/avatar.png" alt="" /></li>
                    <li>Ad: <b><?php echo $yorum_cek['ad']?> </b></li><br />
                    <li>Tarih: <b><?php echo $yorum_cek['tarih']?></b></li>
					<br /><li><b><?php echo $yorum_cek['yorum']?></b></li></ul>
                    <div style="clear: both"></div>
                </div>
                <div class="yorum_alt"></div>
                <?php } ?>        
        </div>  
    <div class="sol_bosluk"></div>
        <div class="sol_baslik">Yorum Yapın</div>
        <div class="sol_kutu" style="font-family: Arial; font-size: 13px;">
        	<div class="iyorum">
            	 <?php if ($_GET['yorum'] == "gonder"){yorumekle();}?>
       		    <form action="<?php echo 'yorum-gonder/'.$video['id'].'-'.link_temizle($video['baslik']).'.html'; ?>" method="post" id="form">
                <ul>
                    <li style="width: 100px;"><b>Adınız</b> :</li>
                    <li><input type="text" name="ad"/></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>E-Mail</b> :</li>
                    <li><input type="text" name="mail"/></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Yorum </b> :</li>
                    <li><textarea name="yorum" rows="20" cols="80" style="margin-left: 25px; width: 500px; height: 100px; background-color: #E9E9E9; border: 1px solid #CCC;" ></textarea></li>
			    </ul>
                <ul>
                    <li style="width: 100px;"><b>Gönder</b> :</li>
                    <li><input type="submit" value="Gönder" class="ygonder"/>
                      <input type="reset" value="Temizle" class="ygonder" /></li>
                </ul>
                </form>
            </div>    
        </div>
    <div class="sol_bosluk"></div>
  </div>
  <!-- İçerik-Sol Biter --> 
  <!-- İçerik-Sağ Başlar --> 
  <div id="sag">
  	<?php include('lyn_video-sag.php'); ?>
  </div>
  <!-- İçerik-Sağ Biter --> 
  <div style="clear: both"></div> 
</div>
<!-- İçerik Biter -->   
<?php include('alt.php'); ?>