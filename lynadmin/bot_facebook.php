<?php
@session_start();
include("fonksiyon.php");

if(!isset($_SESSION["login"])){

echo "Bu sayfayı görüntüleme yetkiniz yoktur.";

}else{
?>
<?
function f($bas, $son, $yazi)	{ 
	@preg_match_all('/' . preg_quote($bas, '/') . '(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
	return @$m[1];
	}
$vcek=$_GET['vcek'];
function linkduzelt($degistir){
$bunu=	array ("\u00253A","\u00252F"); 
$bununla=	array (":","/"); 
$degistir = str_replace($bunu,$bununla,$degistir);
return $degistir;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
if($_GET["vcek"]){
$url   = $vcek;	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.facebook.com/login.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,'email='.urlencode($mail).'&pass='.urlencode($sifre).'&login=Login');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, "http://www.facebook.com");
curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.11) Gecko/2009060215 Firefox/3.0.11 (.NET CLR 3.5.30729)");
curl_exec($ch);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, "http://www.facebook.com");
curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.11) Gecko/2009060215 Firefox/3.0.11 (.NET CLR 3.5.30729)");
$data = curl_exec($ch);
curl_close($ch);

$site   = urldecode($data);
$adi = f('<h3 class="video_title datawrap">','</h3>',$site);
$adi = $adi[0];
$link = f('video_src", "','.mp4',$site);
$link = linkduzelt($link[0].'.mp4');
$resim = f('"thumb_url", "','"',$site);
$resim = linkduzelt($resim[0]);
$sure = f('<strong class="video_length">','</strong>',$site);
$sure = $sure[0];
$sonraki = f('class="pager_link pager_next" href="','"',$site);
$sonraki = $sonraki[0];
$kategori=$_GET["kategori"];






if($sonraki){
$sonuc = mysql_query("SELECT id FROM lynvideo_video WHERE embed='$link' LIMIT 0, 1");
if( mysql_num_rows($sonuc) ){
echo $adi.' daha önceden kayıt edilmiş.<br>';
} else {
			$katsor = mysql_fetch_assoc(mysql_query("select * from lynvideo_kategori WHERE kategori = '".$kategori."' ORDER BY id"));
			$kate = $katsor['id'];
			$zaman = time();
			$tarih = tarih($zaman);
			$eski_etiket = $adi;
			$degistir= array(" " => ", ");
			$etiketler = strtr("$eski_etiket", $degistir);
			$ekle = mysql_query("insert into lynvideo_video (id, baslik, aciklama, etiketler, kategori, embed, resim, hit, tarih, durum, tur) values ('', '$adi', '$adi', '$etiketler', '$kate', '$link', '$resim', '0', '$tarih', '1', '3')");
					if($ekle){
						   echo $adi."Video eklendi O Sayfadaki diğer videolarda ekleniyor lütfen bekleyiniz..";	
					}else {
							echo "Ekleme işlemi yapılamadı.";} 	
}

echo '<script>location.href="bot_facebook.php?vcek='. $sonraki .'&kategori='.$_GET["kategori"].'";</script>';
}else{
echo '<br><br>Bitti';
}

}else{
echo '
<form id="form1" name="form1" method="get" action="bot_facebook.php">
<table width="739" border="0" align="center" style="margin-top:5px;">
<tr>
<td width="289"><div align="right">Video linki:</div></td>
<td width="480"><label>
<input name="vcek" type="text" id="kactan" size="100" value="facebook video linki"/>
</label></td>
 </tr>
 <tr>
<td width="289"><div align="right">Kategori:</div></td>
<td width="480"><label>
        <select name="kategori" id="kategori">'; ?>
		<?
					$data = mysql_query("SELECT * FROM lynvideo_kategori");
					while($sonuc = mysql_fetch_array($data))
					{
					$id=$sonuc["id"];
					$kategori=$sonuc["kategori"];
					?>
					<option value="<?php echo $kategori; ?>"><?php echo $kategori; ?></option>
					<?
					}
					?>       
<?php        
	   echo '</select>
      </label></td>
 </tr>
';
echo '
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Ekle" id="Ekle" value="Video(ları) ekle" />
      </label><br /> Yazdığınız linkin bulunduğu sayfadaki tüm videoları sırayla çekecektir durdurmak için videolar sayfasına gidiniz.
	  </td>
    </tr>
  </table>
</form>
';


}

?>
</body>
</html>
<?php
}

?>