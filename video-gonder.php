<?php
require_once('lynadmin/fonksiyon.php');
$title =  "Video Gönderin - ".$genel_ayarlar['title'];
$keywords =  $genel_ayarlar['keywords'];
$description =  $genel_ayarlar['aciklama'];
include('ust.php');
?>
<!-- İçerik Başlar --> 
<div id="icerik">
  <!-- İçerik-Sol Başlar --> 
  <div id="sol">
	           <div class="sol_baslik">Video Gönderin</div>
        <div class="sol_kutu" style="font-family: Arial; font-size: 13px;">
        	<div class="iyorum">
            	 <?php if ($_GET['ziyaretci'] == "ekle"){videopasifekle();}?>
       		    <form action="video-gonder/ziyaretci-ekle" method="post" id="form">
                <ul>
                    <li style="width: 100px;"><b>Başlık </b> :</li>
                    <li><input type="text" name="baslik" style="width: 505px;" /></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Açıklama </b> :</li>
                    <li><textarea name="aciklama" rows="20" cols="80"  style="margin-left: 25px; width: 500px; height: 100px; background-color: #E9E9E9; border: 1px solid #CCC;"></textarea></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Etiketler </b> :</li>
                    <li><input type="text" name="etiketler" style="width: 505px;" value="Etiketler Arasına Virgül (,) Koyun Lütfen. Örneğin; video, sitesi" /></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Kategori </b> :</li>
                    <li><select name="kategori" style="width: 150px; float: right;  margin-left: 25px;">
							<?php //Eklenmiş kategorilerimizi çekiyoruz
                            $kategori = mysql_query("SELECT * FROM lynvideo_kategori");
                            while($kategori_cek =  mysql_fetch_array($kategori)){
                            echo '<option value="'.$kategori_cek['kategori'].'" >'.$kategori_cek['kategori'].'</option>';
                            }
                            ?>
                        </select></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Resim (URL) </b> :</li>
                    <li><input type="text" name="resim" style="width: 505px;" /></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Embed</b>:</li>
                    <li><textarea name="embed" rows="20" cols="80" style="margin-left: 25px; width: 500px; height: 100px; background-color: #E9E9E9; border: 1px solid #CCC;"></textarea></li>
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
  	<?php include('lyn_sag.php'); ?>
  </div>
  <!-- İçerik-Sağ Biter --> 
  <div style="clear: both"></div> 
</div>
<!-- İçerik Biter -->   
<?php include('alt.php'); ?>