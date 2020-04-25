         <div class="sag_baslik">Sosyal Linkler</div>
         <div class="sag_kutu" style="text-align:center;">
            <a rel="nofollow" href="http://twitter.com/home?status=<?php echo $genel_ayarlar['site_adresi']; ?>" title="facebook"><img border="0" src="images/icon/twitter.png" alt="Twitter Share" title="Twitter'ta Paylaş" /></img></a> <a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php echo $genel_ayarlar['site_adresi']; ?>" title="facebook"><img border="0" src="images/icon/facebook.png" alt="Facebook Share" title="Facebook'ta Paylaş"></img></a> 
            <a rel="nofollow" href="http://friendfeed.com/?title=<?php echo $title; ?>&url=<?php echo $genel_ayarlar['site_adresi']; ?>" target="_blank" title="friend feed"><img border="0" src="images/icon/friendfeed.png"></img></a> <a rel="nofollow" href="http://technorati.com/faves?add=<?php echo $genel_ayarlar['site_adresi']; ?>" target="_blank"><img src="images/icon/technorati.png" alt="Technorati Share" title="Technorati'de Paylaş" /></img></a> <a rel="nofollow" href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo $genel_ayarlar['site_adresi']; ?>" target="_blank"><img src="images/icon/google.png" alt="Google Share" title="Google'da Paylaş" /></img></a> 
            <a rel="nofollow" href="http://delicious.com/post?url=<?php echo $genel_ayarlar['site_adresi']; ?>" target="_blank"><img src="images/icon/delicious.png" alt="Delicious Share" title="Delicious'da Paylaş" /></img></a> <a rel="nofollow" href="http://digg.com/submit?phase=2&url=<?php echo $genel_ayarlar['site_adresi']; ?>" target="_blank"><img src="images/icon/digg.png" alt="Digg Share" title="Digg'te Paylaş" /></img></a> 
        </div>
        <div class="sag_baslik">Kategoriler</div>
        <div class="sag_kutu">
            <ul>
            	<?php $kategori = mysql_query("select * from  lynvideo_kategori ORDER BY kategori ASC");
 						while ($kategori_cek=mysql_fetch_array($kategori)){
				echo '<li><a href="kategori/'.$kategori_cek['id'].'-'.link_temizle($kategori_cek['kategori']).'">'.$kategori_cek['kategori'].'</a></li>';
						}
                ?>
            </ul>
        </div>
        <div class="sag_bosluk"></div>
             <?php 
						echo '<div class="sag_baslik">Benzer Videolar</div>
						<div class="sag_kutu">	';
						$id = intval($_GET['id']); 
						$video = mysql_fetch_assoc(mysql_query("SELECT * FROM lynvideo_video WHERE durum = '1' and id=".$id));
						$benzervideo = explode(',',$video['etiketler']);	
						$benzervideo = $benzervideo[0];
						$video = mysql_query("SELECT * FROM lynvideo_video WHERE durum = '1' and etiketler LIKE '%".$benzervideo."%' ORDER BY rand() LIMIT 0,6");		
					        while ($video_cek=mysql_fetch_array($video)){
							echo '<div class="sag_videolar">
								<a href="'.$video_cek['id'].'-'.link_temizle($video_cek['baslik']).'.html">
								<img src="'.htmlspecialchars($video_cek['resim']).'" alt="" />
								'.substr($video_cek['baslik'], -0, 20).'    
							</a></div>'; }
							echo '</div>';         
				 ?>
        <div class="sag_bosluk"></div>
        <div class="sag_baslik">Reklam</div>
        <div class="sag_kutu">
        	<?php echo $reklam['sag_250']; ?>
        </div>
        <div class="sag_bosluk"></div>
        <div class="sag_baslik">Son Yorumlar</div>
        <div class="sag_kutu">
            <ul class="sag_yorum">
				<?php
                $yorum = mysql_query("SELECT * FROM lynvideo_yorum WHERE durum='1' ORDER BY id DESC limit 0,5") or die("Hata Olustu!");
                while($yorum_cek = mysql_fetch_array($yorum)){
                    $yoruml = substr($yorum_cek['yorum'], -0, 36);
                    $vid = $yorum_cek['vid'];
                    $video = mysql_fetch_assoc(mysql_query("SELECT * FROM lynvideo_video WHERE durum = '1' and  id=".$vid));
                    echo '<li><a href="'.$video['id'].'-'.link_temizle($video['baslik']).'.html">';
                    echo '<b>'.$yorum_cek['ad'].'</b> ('.$yorum_cek['tarih'].')<br />
                     '.$yoruml.'...</a></li>';
                }
                ?> 
            </ul> 
        </div>
        <div class="sag_bosluk"></div>
        <div class="sag_bosluk"></div>
        <div class="sag_baslik">Etiketler</div>
        <div class="sag_kutu">
            <div style="font-size:12px;">
			<?php 
			   $video = mysql_query("select * from lynvideo_video where durum= '1' ORDER BY id DESC limit 0,13");
                while ($video_cek=mysql_fetch_array($video)){
				$etiket = $video_cek['etiketler'];
				$parcala = explode(',', $etiket);
				$say = count($parcala);
				for($i=0; $i<$say; $i++){
					$etiketle = trim($parcala[$i]);
					if (strlen($etiketle) != 1){
						echo '<a href="etiket/'.$etiketle.'">'.$etiketle.'</a> ';
					}
       	  	 }} ?>
         <div style="float:right; margin-top: 5px;"><a href="etiket" style="color:#999;">Tümü</a></div>
           </div>
        </div>
        <div class="sag_bosluk"></div>
        <div class="sag_baslik">Istatistik</div> 
        <div class="sag_kutu"> 
            <div style="font-size:12px;"> 
                <ul> 
                	<li> 
					<?php  
                    $istatistik = mysql_query("select * from lynvideo_video");     
                    if (mysql_num_rows($istatistik)==0) { 
                        echo "Video = Hic kayit bulunamadi."; 
                    }else { 
                        echo mysql_num_rows($istatistik)." Video"; } 
                    ?> 
                	</li> 
                </ul> 
                <ul> 
                	<li> 
					<?php 
                    $istatistik3 = mysql_query("select * from lynvideo_kategori");                
                    if (mysql_num_rows($istatistik3)==0) { 
                        echo "Hic Kategori bulunamadi."; 
                    }else { 
                        echo mysql_num_rows($istatistik3)." Kategori"; }             
                    ?> 
                	</li> 
                </ul> 
                <ul> 
                	<li> 
					<?php 
                    $istatistik2 = mysql_query("select * from lynvideo_yorum"); 
					if (mysql_num_rows($istatistik2)==0){ 
                        echo "Yorum = Hic Yorum bulunamadi."; 
                    }else { 
                        echo mysql_num_rows($istatistik2)." Yorum"; }             
                    ?> 
                	</li> 
                </ul>
                <ul> 
                 	<li>
					<?php 
					$istatistik4 = mysql_query("select hit from lynvideo_video order by hit desc"); 
					while($hit_cek = mysql_fetch_assoc($istatistik4)){ 
					$toplam_hit = $toplam_hit + $hit_cek['hit']; 
					} 
					echo $toplam_hit." İzlenme";         
                    ?> 
                	</li> 
                </ul> 
            </div> 
        </div>