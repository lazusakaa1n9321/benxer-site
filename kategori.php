<?php
require_once('lynadmin/fonksiyon.php');
$id=  intval($_GET['id']);
$kategori_cek = mysql_fetch_assoc(mysql_query("select * from lynvideo_kategori where id='$id'"));
$title =  $kategori_cek['kategori']." | Videolar | ".$genel_ayarlar['kategori']. " | Videolar indir | ".$genel_ayarlar['kategori']. " | Videolar izle | ";
$keywords =  $kategori_cek['kategori'].' videoları, '.$kategori_cek['kategori'].' izle '.$kategori_cek['kategori'].' dinle ' .$kategori_cek['kategori'].' seyret '.$kategori_cek['kategori'].' dizi izle';
$description =  $kategori['kategori'].' videoları, '.$kategori['kategori'].' izle '.$kategori['kategori'].' indir';
include('ust.php');
$kategori = $kategori_cek['kategori'];
$kat_id = $kategori_cek['id'];
?>
<!-- İçerik Başlar --> 
<div id="icerik">
  <!-- İçerik-Sol Başlar --> 
  <div id="sol">
	<div class="sol_baslik"><?php echo $kategori ?> Kategorisine Ait Videolar</div>
        <div class="sol_kutu">
        	<?php
			$page = intval($_GET['ksayfa']);
			$max = $genel_ayarlar['ic_video'];
			if (!$page) $page=1;
			$alt = ($page - 1) * $max;
			$sql2 = mysql_query("select count(id) from lynvideo_video where kategori='$kat_id' and durum = '1'");
			$count=mysql_result($sql2,0);    
			$perpage=ceil($count/$max);
            $video = mysql_query("select * from lynvideo_video where kategori='$kat_id' and durum = '1' ORDER BY id DESC limit $alt,$max");		
			$video2 = mysql_query("select * from lynvideo_video where kategori='$kat_id' and durum = '1' ORDER BY id DESC");		
			$videosayi = mysql_num_rows($video2);
            while ($video_cek=mysql_fetch_array($video)){
			$yorum_sayi = mysql_num_rows(mysql_query("SELECT * FROM lynvideo_yorum WHERE vid=".$video_cek['id']." and durum='1'"));
            ?>
           <div class="videolar">
            	 <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><img src="<?php echo htmlspecialchars($video_cek['resim']); ?>" alt=""/></a>
               <div class="videolar_baslik"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html"><?php echo ucwords(strtolower(substr($video_cek['baslik'], -0, 40))); ?></a></div>
                <div class="videolar_izlenme"><a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">İzlenme: <?php echo $video_cek['hit']; ?></a></div> 
               <div class="videolar_yorum"> <a href="<?php echo $video_cek['id']; ?>-<?php echo link_temizle($video_cek['baslik']); ?>.html">Yorum: <?php echo $yorum_sayi; ?></a></div>
            </div>
       	   <?php } 
		   if ($videosayi >= $max+1){
			if($count > $perpage) :
			if($perpage<=5) {
			$x = $perpage;
			} else {
			  $x = 6;
			}
			  $lastP = $perpage;
			  echo '<div class="sayfalama">';
			  if($page==1) echo "<span class=\"acik\">1</span>";
			  else echo '<a href="kategori-'.$kat_id.'/'.link_temizle($kategori).'-1">1</a>';  
			  if($page-$x > 2) {
				echo "...";
				$i = $page-$x;
			  } else {
				$i = 2;
			  }
			  for($i; $i<=$page+$x; $i++) {
				if($i==$page) echo "<span class=\"acik\">$i</span>";
				else echo '<a href="kategori-'.$kat_id.'/'.link_temizle($kategori).'-'.$i.'">'.$i.'</a>';
				if($i==$lastP) break;
			  }
			  if($page+$x < $lastP-1) {
				echo "...";
				echo '<a href="kategori-'.$kat_id.'/'.link_temizle($kategori).'-'.$lastP.'">'.$lastP.'</a>';
			  } elseif($page+$x == $lastP-1) {
				echo '<a href="kategori-'.$kat_id.'/'.link_temizle($kategori).'-'.$lastP.'">'.$lastP.'</a>';
			  }
			  echo '</div>';
			endif;
		   }
			?>	  
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