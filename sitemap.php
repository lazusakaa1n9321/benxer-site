<?php 
$host = "localhost"; 
$mysqladi = "kullaniciadi";
$mysqlsifre ="sifre"; 
$db = "veritabani"; 
@mysql_connect ("$host", "$mysqladi", "$mysqlsifre") or die ("MySql Baglantisinda Hata"); 
@mysql_select_db ("$db") or die ("Veritabanina Baglanilamadi"); 


$tab=0; 
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

$page = intval(mysql_real_escape_string($_GET['sayfa']));
if(! isset($page)) $sayfa='index'; else $sayfa=$page;
$date = date("20y-m-d");
$index_say=mysql_num_rows(mysql_query("SELECT id FROM lynvideo_video")); 
$index_sayi=ceil($index_say / 5000); 
if(($sayfa=="index") && ($index_say>5000)): 
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>  <sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";   
for($i=0; $i<$index_sayi; $i++){  
echo "<sitemap>  <loc>http://www.siteadresiniz.com/sitemap.php?sayfa=".($i+1)."</loc>  <lastmod>$date</lastmod>  </sitemap>\n";  
} 
echo "</sitemapindex>";  
else:  
if($sayfa=='index'){
$sayfa=1;
}
$fileout = 0; 
$out = "<?xml version=\"1.0\" encoding=\"UTF-8\"?> 
<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
 xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">"; 
$cek = mysql_query("SELECT* FROM lynvideo_video ORDER BY id ASC LIMIT ".(($sayfa-1)*5000).",5000");
		while ($rows=mysql_fetch_assoc($cek) ) { 
		
		$link = $rows['id']."-".SeoLink($rows['baslik']); 
		
		$out .= "<url> 
		<loc>http://www.siteadresiniz.com/".$link.".html</loc> 
		  <priority>0.8</priority> 
		</url>"; 
		} 
		$out .= "</urlset>"; 
		header("Content-type: application/xml"); 
		echo $out; 
	endif;
?>