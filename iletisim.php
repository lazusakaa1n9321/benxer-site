<?php
require_once('lynadmin/fonksiyon.php');
$title =  "İletisim - ".$genel_ayarlar['title'];
$keywords =  $genel_ayarlar['keywords'];
$description =  $genel_ayarlar['aciklama'];
include('ust.php');
?>
<!-- İçerik Başlar --> 
<div id="icerik">
  <!-- İçerik-Sol Başlar --> 
  <div id="sol">
	        <div class="sol_baslik">İletişim</div>
        <div class="sol_kutu" style="font-family: Arial; font-size: 13px;">
        	<div class="iyorum">
            	 <?php if ($_GET['iletisim'] == "gonder"){iletisimekle();}?>
       		    <form action="iletisim/iletisim-gonder" method="post" id="form">
                <ul>
                    <li style="width: 100px;"><b>Ad - Soyad </b> :</li>
                    <li><input type="text" name="ad" style="width: 505px;" /></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>E-Mail </b> :</li>
                    <li><input type="text" name="mail" style="width: 505px;" /></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Konu </b> :</li>
                    <li><input type="text" name="konu" style="width: 505px;" /></li>
                </ul>
                <ul>
                    <li style="width: 100px;"><b>Mesaj </b> :</li>
                    <li><textarea name="mesaj" rows="20" cols="80" style="margin-left: 25px; width: 500px; height: 100px; background-color: #E9E9E9; border: 1px solid #CCC;"></textarea></li>
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