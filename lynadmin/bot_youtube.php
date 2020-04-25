<?
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';?>
<script>
function video_ekle(adi,flvlink,buyukresim,kategori){
   xmlHttp=ajax();
   if (xmlHttp==null){
	alert ('Tarayıcınız Ajax Desteklemiyor!');
	return;}
	var adi2 = adi;
	var flvlink2 = flvlink;
	var buyukresim2 = buyukresim;
	var kategori2 = kategori;
	var url='bot_kayit.php?islem=youtube';
	var sc ='adi='+adi2+'&flvlink='+flvlink2+'&buyukresim='+buyukresim2+'&kategori='+kategori2;
	xmlHttp.open('POST', url, true);
	xmlHttp.setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
	xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
	xmlHttp.setRequestHeader('Content-length', sc.length);
	xmlHttp.setRequestHeader('Connection', 'close');
	xmlHttp.onreadystatechange=Guncelle;
	xmlHttp.send(sc);}
function Guncelle(){
	if (xmlHttp.readyState==4 && xmlHttp.status == 200){
		alert(xmlHttp.responseText);}}
function ajax(){
	var xmlHttp=null;
	try{
		xmlHttp=new XMLHttpRequest();}
	catch (e){
		try{
			xmlHttp=new ActiveXObject('Msxml2.XMLHTTP');}
		catch (e){
			xmlHttp=new ActiveXObject('Microsoft.XMLHTTP');}}
	return xmlHttp;}
</script>
<?php
echo'
</head><body>';
@session_start();
if(!isset($_SESSION["login"])){
	yenile("giris.php");
}else{	
include('fonksiyon.php');
function f($bas, $son, $yazi)	{ 
	@preg_match_all('/' . preg_quote($bas, '/') . '(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
	return @$m[1];
}
function aramam($q) { 
$q = str_replace("`","",$q); 
$q = str_replace("&","",$q); 
$q = str_replace("%","",$q);  
$q = str_replace("'","",$q); 
$q = str_replace(")","",$q);
$q = str_replace("(","",$q);  
$q = str_replace("<","",$q);  
$q = str_replace(">","",$q);  
$q = str_replace(" ","+",$q); 
$q=trim($q); 
$q = htmlspecialchars(strip_tags(mysql_real_escape_string($q)));
return $q; 
}
$arama_sonuc = aramam($_GET['arama_sonuc']);
$sayfa = $_GET['sayfa'];
$kategorim = $_GET['kategori'];
$kid = $_GET['kategoriid'];

if($_GET["arama_sonuc"]){
if (!$sayfa) $sayfa=1;
$url   = "http://gdata.youtube.com/feeds/api/videos?q=".urlencode($arama_sonuc)."&max-results=20&start-index=".$sayfa;	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, "http://youtube.com");
curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.11) Gecko/2009060215 Firefox/3.0.11 (.NET CLR 3.5.30729)");
$data = curl_exec($ch);
curl_close($ch);

$site   = urldecode($data);
$say = f("<entry>","</entry>",$site);
$vsayi = f("<openSearch:totalResults>","</openSearch:totalResults></span>",$site);
$videosayisi=count($say);
$vsayfa=ceil($vsayi[0]/20);
//echo $videosayisi;
echo '<form id="form1" name="form1" method="get" action="bot_youtube.php">
<div class="form"> Aranacak Kelime :<input name="arama_sonuc" type="text" id="kactan" value="'.$arama_sonuc.'" /></div>
<div class="form">Eklenecek :<select name="kategori" id="kategori">'; ?>
<option value="<?php echo $kategorim; ?>"><?php echo $kategorim; ?></option>
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
	   echo '</select></div>
	    <input name="kid" type="hidden" id="kid" size="100" value="'.$kategoriidz.'"/>
		<div class="form"><input type="submit" value="Ara :)" class="gonder"/> </div></form>';          
?>
<?php if($sayfa-1==0) { echo 'İlk Sayfa'; } else { ?>
<a href="bot_youtube.php?kategori=<?=$kategorim?>&kid=<?=$kategoriid?>&arama_sonuc=<?=$arama_sonuc?>&sayfa=<?=$sayfa-20?>"><< Onceki Sayfa</a><?php } ?> - 
<?php if($sayfa==$vsayfa) { echo 'Son Sayfa'; } else { ?>
<a href="bot_youtube.php?kategori=<?=$kategorim?>&kid=<?=$kategoriid?>&arama_sonuc=<?=$arama_sonuc?>&sayfa=<?=$sayfa+20?>">Sonraki Sayfa >></a><?php } ?><br>
<? 
for($i=0;$i<$videosayisi;$i++)
{
$visim = f("<title type='text'>","</title>",$say[$i]);
$vresim3 = f("<media:thumbnail url='","'",$say[$i]);
$vresim=$vresim3[0];
$vidx=explode("/",  $vresim);
$vid=$vidx[4];
$flvlink = 'http://www.youtube.com/watch?v='.$vid;
$resler=$vresim;
$adi=$visim[0];
?>
<form method="POST" id="gondercanim<?php echo $i ?>" name="gondercanim<?php echo $i ?>" action="javascript:void(<?php echo $i ?>)">
<img width="50" src="<?php echo $resler ?>" />
<div class="form">    
	Başlık : <input id="adi<?php echo $i ?>" type="text" name="adi<?php echo $i ?>" size="70" value="<?php echo $adi ?>"/>
</div> 
<div class="form">    
	Link : <br>
<textarea name="flvlink" name="flvlink<?php echo $i ?>" id="flvlink<?php echo $i ?>" size="70" value="<?php echo $i ?>" rows="8" cols="57"><?php echo $flvlink ?></textarea>
</div> 
<div class="form">    
	Resim : <input id="buyukresim" readonly type="text" name="buyukresim<?php echo $i?>" id="buyukresim<?php echo $i?>" size="70" value="<?php echo $resler ?>" />
</div> 
<div class="form">    
	Kategori :
    <select id="kat<?php echo $i ?>" name="kat<?php echo $i ?>">
		<option value="<?php echo $_GET['kategori'] ?>" selected><?php echo $_GET['kategori'] ?></option>
					<?
					$data = mysql_query("SELECT * FROM lynvideo_kategori");
					while($sonuc = mysql_fetch_array($data))
					{
					$id=$sonuc["id"];
					$kategori=$sonuc["kategori"]; ?>
					<option value="<?php echo $kategori; ?>"><?php echo $kategori; ?></option>
		
	<?php }echo '</select>';?>
</div> 
<div class="form">    
<input type="submit" value="Ekle" name="yolla" style="background-color:#06C; width:75px; padding:3px; color:#fff; border:1px solid #CCC" onclick="
	var adi=escape(document.gondercanim<?php echo $i ?>.adi<?php echo $i ?>.value); 
	var flvlink=escape(document.gondercanim<?php echo $i ?>.flvlink<?php echo $i ?>.value); 
	var buyukresim=escape(document.gondercanim<?php echo $i ?>.buyukresim<?php echo $i ?>.value); 
	var kategori=escape(document.gondercanim<?php echo $i ?>.kat<?php echo $i ?>.value); 
	video_ekle(adi,flvlink,buyukresim,kategori);
	">
</div> 
</form>
<?
}
?>
<br>
<?php if($sayfa-1==0) { echo '<< Onceki Sayfa'; } else { ?>
<a href="bot_youtube.php?kategori=<?=$kategorim?>&kid=<?=$kategoriid?>&arama_sonuc=<?=$arama_sonuc?>&sayfa=<?=$sayfa-20?>"><< Onceki Sayfa</a><?php } ?> - <a href="bot_youtube.php?kategori=<?=$kategorim?>&kid=<?=$kategoriid?>&arama_sonuc=<?=$arama_sonuc?>&sayfa=<?=$sayfa+20?>">Sonraki Sayfa >></a>
<br>
<?php
}else{
echo '<form id="form1" name="form1" method="get" action="bot_youtube.php">
<div class="form">Aranacak Kelime :<input name="arama_sonuc" type="text" id="kactan" /></div>
<div class="form">Eklenecek Kategori :<select name="kategori" id="kategori">'; ?>
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
	   echo '</select></div><div class="form"><input type="submit" value="Ara :)" class="gonder"/> </div></form>';
} }
echo '</body></html>'; ?>
