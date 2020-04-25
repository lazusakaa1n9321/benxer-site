<?php
// Bu scripte RSS desteği wmscripti.com ekibi tarafından istek üzerine eklenmiştir.
// Veritabanı Bilgileriniz
$host = "localhost"; 
$kadi = "kullaniciadi";
$sifre = "sifre"; 
$db = "veritabani"; 

// Bağlantı
mysql_connect ("$host", "$kadi", "$sifre") or die ("Kullanıcıya bağlanılamadı."); 
mysql_select_db ("$db") or die ("Veritabanına bağlanılamadı."); 
mysql_query("SET NAMES UTF8");

// SEO Link Oluşturma
function SeoLink($s){ 
    $tr = array('Ş','ş','İ','ı','Ğ','ğ','Ü','ü','Ö','ö','Ç','ç'); 
    $eng = array('s','s','i','i','g','g','u','u','o','o','c','c'); 
    $s = str_replace($tr,$eng,$s); 
    $s = strtolower($s); 
    $s = preg_replace('/&.+?;/', '', $s); 
    $s = preg_replace('/[^%a-z0-9 _-]/', '', $s); 
    $s = preg_replace('/\s+/', '-', $s); 
    $s = preg_replace('|-+|', '-', $s); 
    $s = trim($s, '-'); 
    return $s; 
}

function Duzelt($d){ 
    $tr = array('&'); 
    $eng = array('&amp;'); 
    $d = str_replace($tr,$eng,$d); 
    return $d; 
}

// Ekrana Yazdırma
$yazdir = "<?xml version=\"1.0\" encoding=\"UTF-8\"?> 
<rss version=\"2.0\">
<channel>"; 
$cek = mysql_query("SELECT* FROM lynvideo_video ORDER BY id DESC LIMIT 10");
	while ($rows=mysql_fetch_assoc($cek) ) { 
	$baslik = Duzelt($rows['baslik']);
	$aciklama = $rows['aciklama']; 
	$link = $rows['id']."-".SeoLink($rows['baslik']); 
	$tarih = $rows['tarih'];
	$yazdir .= "
	<item>
	<title>".$baslik."</title>
	<description><![CDATA[".$aciklama."]]></description>
	<link>http://www.siteadresiniz.com/".$link.".html</link> 
	<pubDate>".$tarih."</pubDate> 
	</item>"; 
	} 
$yazdir .= "
</channel>
</rss>"; 
// wmscripti.com
header("Content-type: text/xml"); 
echo $yazdir; 
?>