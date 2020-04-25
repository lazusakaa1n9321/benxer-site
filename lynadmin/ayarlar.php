<?php
$dbhost = "localhost";
$dbuser = "kullaniciadi";
$dbpass = "sifre";
$dbdata = "veritabani";

if (!@mysql_connect($dbhost, $dbuser, $dbpass)) {
  die("Veritabanına bağlanılamadı...<br>HATA: ".mysql_error());
}

if (!@mysql_select_db($dbdata)) {
  die("Veritabanı seçilemedi<br>HATA: ".mysql_error());
}
mysql_query("SET NAMES 'utf8'");
?>	