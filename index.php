<?php
require_once('lynadmin/fonksiyon.php');
$title =  $genel_ayarlar['title']." | Video İzle | Video İndir | Video Seyret | Müzik Dinle | Müzik İndir";
$keywords =  $genel_ayarlar['keywords'];
$description =  $genel_ayarlar['aciklama'];
include('ust.php');
?>
<!-- İçerik Başlar --> 
<div id="icerik">
  <!-- İçerik-Sol Başlar --> 
  <div id="sol">
  		  		<div class="sol_baslik">Yeni Videolar</div>
        <div class="sol_kutu">
			<?php 
			$as_video = $genel_ayarlar['as_video'];
            $video = mysql_query("select * from lynvideo_video where durum= '1' ORDER BY id DESC limit 0,".$as_video."");
            while ($video_cek=mysql_fetch_array($video)){
			$yorum_sayi = mysql_num_rows(mysql_query("SELECT * FROM lynvideo_yorum WHERE vid=".$video_cek['id']." and durum='1'"));
            ?>
           <div class="videolar">
            	 <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><img src="<?php echo htmlspecialchars($video_cek['resim']); ?>" alt=""/></a>
               <div class="videolar_baslik"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><?php echo ucwords(strtolower(substr($video_cek['baslik'], -0, 40))); ?></a></div>
                <div class="videolar_izlenme"><a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">İzlenme: <?php echo $video_cek['hit']; ?></a></div> 
               <div class="videolar_yorum"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">Yorum: <?php echo $yorum_sayi; ?></a></div>
            </div>
       	   <?php } ?>
        </div>
    <div class="sol_bosluk"></div>
    <div class="sol_baslik">Rastgele Videolar</div>
        <div class="sol_kutu">
        			<?php 
            $video = mysql_query("select * from lynvideo_video where durum= '1' order by rand() DESC limit 0,".$as_video."");
            while ($video_cek=mysql_fetch_array($video)){
			$yorum_sayi = mysql_num_rows(mysql_query("SELECT * FROM lynvideo_yorum WHERE vid=".$video_cek['id']." and durum='1'"));
            ?>
           <div class="videolar">
            	 <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><img src="<?php echo htmlspecialchars($video_cek['resim']); ?>" alt=""/></a>
               <div class="videolar_baslik"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><?php echo ucwords(strtolower(substr($video_cek['baslik'], -0, 40))); ?></a></div>
                <div class="videolar_izlenme"><a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">İzlenme: <?php echo $video_cek['hit']; ?></a></div> 
               <div class="videolar_yorum"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">Yorum: <?php echo $yorum_sayi; ?></a></div>
            </div>
       	   <?php } ?>
        </div>
        <div class="sol_bosluk"></div>
</div>		
  <!-- İçerik-Sol Biter --> 
  <!-- İçerik-Sağ Başlar --> 
  <div id="sag">
  	<?php include('lyn_sag.php'); ?>
  </div>
  <!-- İçerik-Sağ Biter --> 
  <div style="clear: both"></div> 
</div>
<!-- İçerik Biter -->   
<?php include('alt.php'); ?>