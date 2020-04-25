<?
@session_start();
if(!isset($_SESSION["login"])){
	yenile("giris.php");
}else{
	include('fonksiyon.php');
	function UtfDuzelt($gelen) {    
    $ajax_duzelt = array(
    '%u0131'=>'ı',
    '%u0130'=>'İ',
    '%u011F'=>'ğ',
    '%u011E'=>'Ğ',
    '%uFFFD'=>'ü',
    '%u00DC'=>'Ü',
    '%u015F'=>'ş',
    '%u015E'=>'Ş',
    '%u00F6'=>'ö',
    '%u00D6'=>'Ö',
    '%u00E7'=>'ç',
	'%u2329'=>'&amp;',
	'%3A'=>':',
    '%u00C7'=>'Ç'
    );
    $utf_duzelt = array(
    iconv("UTF-8","ISO-8859-9",'Ü')=>'Ü',
    iconv("UTF-8","ISO-8859-9",'ü')=>'ü',
    iconv("UTF-8","ISO-8859-9",'Ö')=>'Ö',
    iconv("UTF-8","ISO-8859-9",'ö')=>'ö',
    iconv("UTF-8","ISO-8859-9",'Ç')=>'Ç',
    iconv("UTF-8","ISO-8859-9",'ç')=>'ç',
    iconv("UTF-8","ISO-8859-9",'&')=>'&'
    );
    
    $gelen=strtr($gelen,$ajax_duzelt);
    return strtr($gelen,$utf_duzelt);
}

function ajax_utf_temizle($dizi) {
    return is_array($dizi) ? array_map('ajax_utf_temizle', $dizi) : UtfDuzelt($dizi);
}
	if ($_GET['islem'] == "youtube"){
		if($_POST["adi"]!=""){
			$baslik = ajax_utf_temizle($_POST["adi"]);
			$link = $_POST["flvlink"];
			$resim = $_POST["buyukresim"];
			$katt = ajax_utf_temizle($_POST["kategori"]);
			$katsor = mysql_fetch_assoc(mysql_query("select * from lynvideo_kategori WHERE kategori = '".$katt."' ORDER BY id"));
			$kategori = $katsor['id'];
			$zaman = time();
			$tarih = tarih($zaman);
			$eski_etiket = $baslik;
			$degistir= array(" " => ", ");
			$etiketler = strtr("$eski_etiket", $degistir);
			$sonuc = mysql_query("SELECT id FROM lynvideo_video WHERE resim='$resim' LIMIT 0, 1");
				if( mysql_num_rows($sonuc) ){
					echo 'Daha önceden kaydedilmiş.';
				} else {
					$ekle = mysql_query("insert into lynvideo_video (id, baslik, aciklama, etiketler, kategori, embed, resim, hit, tarih, durum, tur) values ('', '$baslik', '$baslik', '$etiketler', '$kategori', '$link', '$resim', '0', '$tarih', '1', '2')");
					if($ekle){
						   echo "Video eklendi.";	  
					}else {
							echo "Ekleme işlemi yapılamadı.";} 	
				}
			}
	}
}
?>