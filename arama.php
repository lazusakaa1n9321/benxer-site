<?php
require_once('lynadmin/fonksiyon.php');
$title =  "Yeni Videolar - ".$genel_ayarlar['title'];
$keywords =  $genel_ayarlar['keywords'];
$description =  $genel_ayarlar['aciklama'];
$arama = $_REQUEST['aranan'];
include('ust.php');
?>
<!-- İçerik Başlar --> 
<div id="icerik">
  <!-- İçerik-Sol Başlar --> 
  <div id="sol">
	   <?php
echo '<div class="sol_baslik">Arama</div>
<div class="sol_kutu">';
if($arama==""){
	echo "Aranacak Kelimeyi Yazınız Lütfen.";
} else {
	  $sql = mysql_query("select * from lynvideo_video where durum= '1' and baslik LIKE '%$arama%' order by id DESC");
      if (mysql_num_rows($sql)=="0"){
     	 echo "Aranan Kelime Kayıtlarımızda Yok.";
      } else {
      $sql = mysql_query("select * from lynvideo_video where durum= '1' and baslik LIKE '%$arama%' order by id DESC");
      while ($video_cek=mysql_fetch_array($sql)){ 
	  $yorum_sayi = mysql_num_rows(mysql_query("SELECT * FROM lynvideo_yorum WHERE vid=".$video_cek['id']." and durum='1'"));?>
           <div class="videolar">
            	 <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><img src="<?php echo htmlspecialchars($video_cek['resim']); ?>" alt=""/></a>
               <div class="videolar_baslik"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><?php echo ucwords(strtolower(substr($video_cek['baslik'], -0, 40))); ?></a></div>
                <div class="videolar_izlenme"><a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">İzlenme: <?php echo $video_cek['hit']; ?></a></div> 
               <div class="videolar_yorum"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">Yorum: <?php echo $yorum_sayi; ?></a></div>
            </div>
			<?php
      }
      }
}
echo '</div>
<div class="sol_bosluk"></div>';
?>
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